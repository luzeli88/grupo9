<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function procesar(Request $request)
    {
        $usuario = auth()->user();
        $items = Carrito::where('usuario_id', $usuario->id)->with('producto')->get();

        if ($items->isEmpty()) {
            return redirect()->route('carrito')->with('mensaje', 'Tu carrito esta vacio.');
        }

        $total = $items->sum('total');
        $numeroFactura = 'FAC-' . strtoupper(uniqid());

        $pedido = Pedido::create([
            'usuario_id'      => $usuario->id,
            'total'           => $total,
            'metodo_pago'     => $request->metodo,
            'estado'          => 'pendiente',
            'numero_factura'  => $numeroFactura,
        ]);

        foreach ($items as $item) {
            PedidoItem::create([
                'pedido_id'       => $pedido->id,
                'producto_id'     => $item->producto_id,
                'talle'           => $item->talle,
                'cantidad'        => $item->cantidad,
                'precio_unitario' => $item->precio_unitario,
                'total'           => $item->total,
            ]);

            // Descontar stock del talle
            $productoTalle = \App\Models\ProductoTalle::where('producto_id', $item->producto_id)
                                                      ->where('talle', $item->talle)
                                                      ->first();
            if ($productoTalle) {
                $productoTalle->stock = max(0, $productoTalle->stock - $item->cantidad);
                $productoTalle->save();
            }

            // Actualizar stock general
            $producto = \App\Models\Producto::find($item->producto_id);
            if ($producto) {
                $producto->stock = \App\Models\ProductoTalle::where('producto_id', $item->producto_id)->sum('stock');
                $producto->save();
            }
        }

        Carrito::where('usuario_id', $usuario->id)->delete();

        return redirect()->route('factura', $pedido->id);
    }
}