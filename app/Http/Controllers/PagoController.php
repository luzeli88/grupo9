<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Producto;
use App\Models\ProductoTalle;
use App\Services\ConfiguracionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PagoController extends Controller
{
    public function procesar(Request $request)
    {
        $request->validate([
            'metodo' => 'required|in:debito,credito,transferencia,mercadopago',
            'cuotas' => 'required_if:metodo,credito|nullable|integer|in:3,6,9,12',
            'numero_tarjeta' => 'required_if:metodo,debito,credito|nullable|digits:16',
            'nombre_tarjeta' => [
                'required_if:metodo,debito,credito',
                'nullable',
                'string',
                'max:80',
                'regex:/^[\pL\s]+$/u'
            ],
            'vencimiento' => [
                'required_if:metodo,debito,credito',
                'nullable',
                'regex:/^((0[1-9]|1[0-2])\/\d{2}|\d{4}-(0[1-9]|1[0-2]))$/'
            ],
            'cvv' => 'required_if:metodo,debito,credito|nullable|digits_between:3,4',
            'comprobante' => 'required_if:metodo,transferencia,mercadopago|nullable|digits:6',
        ], [
            'numero_tarjeta.digits' => 'El número de tarjeta debe tener 16 números.',
            'comprobante.digits' => 'El número de operación debe tener 6 números.',
            'vencimiento.regex' => 'El vencimiento debe tener formato MM/AA o seleccionarse desde el calendario.',
        ]);

        // Validar vencimiento de tarjeta
        if (in_array($request->metodo, ['debito', 'credito'], true)) {
            if (str_contains($request->vencimiento, '-')) {
                [$anio, $mes] = explode('-', $request->vencimiento);
            } else {
                [$mes, $anio] = explode('/', $request->vencimiento);
                $anio = 2000 + (int) $anio;
            }

            $vencimiento = Carbon::createFromDate(
                (int) $anio,
                (int) $mes,
                1
            )->endOfMonth();

            if ($vencimiento->lt(now()->startOfDay())) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'vencimiento' => 'La tarjeta está vencida.'
                    ])
                    ->withInput();
            }
        }

        $usuario = auth()->user();
        $items = Carrito::where('usuario_id', $usuario->id)->with('producto')->get();

        if ($items->isEmpty()) {
            return redirect()->route('carrito')
                ->with('mensaje', 'Tu carrito está vacío.');
        }

        $subtotal = $items->sum('total');
        
        // Calcular descuentos y recargos usando el servicio
        $ajustes = ConfiguracionService::calcularAjuste(
            $subtotal,
            $request->metodo,
            $request->metodo === 'credito' ? (int) $request->cuotas : null
        );
        
        $descuento = $ajustes['descuento'];
        $recargo = $ajustes['recargo'];
        $totalFinal = $subtotal - $descuento + $recargo;

    try {

        $pedido = DB::transaction(function () use (
            $usuario,
            $items,
            $subtotal,
            $descuento,
            $recargo,
            $totalFinal,
            $request
        ) {

            // ==========================
            // CREAR PEDIDO
            // ==========================

            $numeroFactura = 'FAC-' . strtoupper(uniqid());

            $pedido = Pedido::create([
                'usuario_id'     => $usuario->id,
                'subtotal'       => $subtotal,
                'total'          => $totalFinal,
                'descuento'      => $descuento,
                'recargo'        => $recargo,
                'metodo_pago'    => $request->metodo,
                'cuotas'         => $request->metodo === 'credito'
                    ? (int) $request->cuotas
                    : null,
                'estado'         => 'finalizada',
                'numero_factura' => $numeroFactura,
            ]);

            // ==========================
            // DETALLE DEL PEDIDO
            // ==========================

            foreach ($items as $item) {

                $productoTalle = ProductoTalle::where(
                    'producto_id',
                    $item->producto_id
                )
                    ->where('talle', $item->talle)
                    ->lockForUpdate()
                    ->first();

                if (
                    !$productoTalle ||
                    $productoTalle->stock < $item->cantidad
                ) {
                    throw ValidationException::withMessages([
                        'stock' => "No hay stock suficiente para {$item->producto->nombre} talle {$item->talle}.",
                    ]);
                }

                PedidoItem::create([
                    'pedido_id'       => $pedido->id,
                    'producto_id'     => $item->producto_id,
                    'talle'           => $item->talle,
                    'cantidad'        => $item->cantidad,
                    'precio_unitario' => $item->precio_unitario,
                    'total'           => $item->total,
                ]);

                $stockNuevo = $productoTalle->stock - $item->cantidad;

                $productoTalle->update([
                    'stock' => $stockNuevo
                ]);

                $producto = Producto::find($item->producto_id);

                if ($producto) {

                    $producto->stock = ProductoTalle::where(
                        'producto_id',
                        $item->producto_id
                    )->sum('stock');

                    $producto->save();
                }
            }

            // ==========================
            // VACIAR CARRITO
            // ==========================

            Carrito::where(
                'usuario_id',
                $usuario->id
            )->delete();

            return $pedido;
        });

    } catch (ValidationException $exception) {

        $errores = $exception->errors();

        $mensaje = $errores['stock'][0]
            ?? 'No hay stock suficiente para completar la compra.';

        return redirect()
            ->route('carrito')
            ->with('error', $mensaje);
    }

    return redirect()
        ->route('factura', $pedido->id)
        ->with([
            'subtotal'    => $subtotal,
            'descuento'   => $descuento,
            'recargo'     => $recargo,
            'total_final' => $totalFinal,
        ]);
}
   
}