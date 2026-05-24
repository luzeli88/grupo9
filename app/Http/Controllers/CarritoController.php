<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request, $producto_id)
    {
        $producto = Producto::findOrFail($producto_id);

        $itemExistente = Carrito::where('usuario_id', auth()->id())
                                ->where('producto_id', $producto_id)
                                ->first();

        if ($itemExistente) {
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

        return redirect()->back()->with('mensaje', 'Producto agregado al carrito.');
    }

    public function index()
    {
        $items = Carrito::where('usuario_id', auth()->id())->with('producto')->get();
        $total = $items->sum('total');

        return view('usuarios.carrito', compact('items', 'total'));
    }
}
