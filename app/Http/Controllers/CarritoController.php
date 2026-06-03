<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\NotificacionReingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    public function agregar(Request $request, $producto_id)
    {
        // Solo clientes pueden agregar productos al carrito.
        if (auth()->user()->rol?->nombre !== 'cliente') {
            return redirect()->route('admin')->with('mensaje', 'No estás autorizado para acceder al carrito.');
        }

        $producto = Producto::findOrFail($producto_id);

        // Validar stock disponible
        if ($producto->stock <= 0) {
            return redirect()->back()->with('error', '❌ Producto sin stock disponible por el momento.');
        }

        $itemExistente = Carrito::where('usuario_id', auth()->id())
                                ->where('producto_id', $producto_id)
                                ->first();

        $cantidadReservada = Carrito::where('producto_id', $producto_id)
            ->sum('cantidad');

        $cantidadUsuario = $itemExistente ? $itemExistente->cantidad : 0;
        $reservadoOtros = $cantidadReservada - $cantidadUsuario;
        $disponible = $producto->stock - $reservadoOtros;

        if ($disponible <= 0) {
            return redirect()->back()->with('error', '❌ Ya no quedan unidades disponibles de este producto.');
        }

        if ($itemExistente) {
            if ($itemExistente->cantidad + 1 > $disponible) {
                return redirect()->back()->with('error', "❌ No puedes agregar más unidades. Quedan {$disponible} disponible(s) para este producto.");
            }

            $itemExistente->cantidad += 1;
            $itemExistente->total = $itemExistente->cantidad * $itemExistente->precio_unitario;
            $itemExistente->save();
        } else {
            Carrito::create([
                'usuario_id'      => auth()->id(),
                'producto_id'     => $producto_id,
                'cantidad'        => 1,
                'precio_unitario' => $producto->precio_venta,
                'total'           => $producto->precio_venta,
            ]);
        }

        return redirect()->back()->with('mensaje', '✅ Producto agregado al carrito.');
    }

    public function index()
    {
        // Solo los clientes pueden ver el carrito.
        if (auth()->user()->rol?->nombre !== 'cliente') {
            return redirect()->route('admin')->with('mensaje', 'No estás autorizado para acceder al carrito.');
        }

        $items = Carrito::where('usuario_id', auth()->id())->with('producto')->get();
        $total = $items->sum('total');

        // La vista está ubicada en resources/views/backend/usuarios/carrito.blade.php
        return view('backend.usuarios.carrito', compact('items', 'total'));
    }

    public function pago()
    {
        // Solo clientes pueden proceder al pago
        if (auth()->user()->rol?->nombre !== 'cliente') {
            return redirect()->route('admin')->with('mensaje', 'No estás autorizado para acceder al pago.');
        }

        $items = Carrito::where('usuario_id', auth()->id())->with('producto')->get();
        $total = $items->sum('total');

        if ($items->count() === 0) {
            return redirect()->route('carrito')->with('error', 'Tu carrito está vacío.');
        }

        return view('backend.usuarios.pago', compact('items', 'total'));
    }

    public function eliminar($id)
    {
        $item = Carrito::findOrFail($id);

        // Verificar que el item pertenezca al usuario autenticado
        if ($item->usuario_id !== auth()->id()) {
            return redirect()->back()->with('error', 'No estás autorizado para eliminar este item.');
        }

        $item->delete();

        return redirect()->back()->with('mensaje', '✅ Producto eliminado del carrito.');
    }

    public function procesarPago(Request $request)
    {
        // Validar que el usuario tenga items en el carrito
        $items = Carrito::where('usuario_id', auth()->id())->get();

        if ($items->count() === 0) {
            return redirect()->route('carrito')->with('error', 'Tu carrito está vacío.');
        }

        // Obtener el método de pago
        $metodo = $request->input('metodo');
        $total = $items->sum('total');

        // Aquí iría la lógica real de procesamiento de pagos
        // Por ahora, solo confirmamos y limpiamos el carrito

        // Verificar stock para cada producto antes de procesar.
        foreach ($items as $item) {
            $producto = Producto::find($item->producto_id);
            if (!$producto || $producto->stock < $item->cantidad) {
                $stockDisponible = $producto ? $producto->stock : 0;
                return redirect()->route('carrito')->with('error', "❌ No hay suficiente stock para {$item->producto->nombre}. Quedan {$stockDisponible} unidad(es).");
            }
        }

        DB::transaction(function () use ($items) {
            foreach ($items as $item) {
                $producto = Producto::find($item->producto_id);
                $producto->stock -= $item->cantidad;
                if ($producto->stock < 0) {
                    $producto->stock = 0;
                }
                $producto->save();
            }

            Carrito::where('usuario_id', auth()->id())->delete();
        });

        // Simular procesamiento exitoso
        $mensaje = '✅ Pago procesado exitosamente por ' . $metodo . '. Realizaste una compra de $' . number_format($total, 0, ',', '.');

        return redirect()->route('cliente')->with('mensaje', $mensaje);
    }
}
