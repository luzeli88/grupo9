<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
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

        $itemExistente = Carrito::where('usuario_id', auth()->id())
                                ->where('producto_id', $producto_id)
                                ->where('talle', $talle)
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
                'talle'           => $talle,
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

        return view('usuarios.carrito', compact('items', 'total'));
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