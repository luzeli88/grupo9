<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\ProductoTalle;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request, $producto_id)
    {
        $producto = Producto::findOrFail($producto_id);
        $talle = $request->talle;

        $productoTalle = ProductoTalle::where('producto_id', $producto_id)
                                      ->where('talle', $talle)
                                      ->first();

        if ($productoTalle && $productoTalle->stock > 0) {
            $productoTalle->stock -= 1;
            $productoTalle->save();
        }

        $itemExistente = Carrito::where('usuario_id', auth()->id())
                                ->where('producto_id', $producto_id)
                                ->where('talle', $talle)
                                ->first();

        if ($itemExistente) {
            $itemExistente->cantidad += 1;
            $itemExistente->total = $itemExistente->cantidad * $itemExistente->precio_unitario;
            $itemExistente->save();
        } else {
            Carrito::create([
                'usuario_id'      => auth()->id(),
                'producto_id'     => $producto_id,
                'talle'           => $talle,
                'cantidad'        => 1,
                'precio_unitario' => $producto->precio_venta,
                'total'           => $producto->precio_venta,
            ]);
        }

        return redirect()->back()->with('mensaje', 'Producto agregado al carrito.');
    }

    public function index()
    {
        $items = Carrito::where('usuario_id', auth()->id())->with('producto')->get();
        $total = $items->sum('total');

        return view('backend.usuarios.carrito', compact('items', 'total'));
    }

    public function actualizar(Request $request, $id)
    {
        $item = Carrito::findOrFail($id);
        $item->cantidad = $request->cantidad;
        $item->total = $item->cantidad * $item->precio_unitario;
        $item->save();

        return redirect()->route('carrito')->with('mensaje', 'Carrito actualizado.');
    }

    public function eliminar($id)
    {
        $item = Carrito::findOrFail($id);
        $item->delete();

        return redirect()->route('carrito')->with('mensaje', 'Producto eliminado del carrito.');
    }
}