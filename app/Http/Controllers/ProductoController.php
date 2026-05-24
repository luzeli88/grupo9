<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::withTrashed()->get();
        return view('backend.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('backend.productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'categoria'     => 'required|string',
            'precio_venta'  => 'required|numeric',
            'precio_compra' => 'nullable|numeric',
            'stock'         => 'nullable|integer',
            'stock_minimo'  => 'nullable|integer',
            'descuento'     => 'nullable|numeric',
            'imagen'        => 'nullable|image|max:2048',
        ]);

        $datos = $request->only([
            'nombre', 'descripcion', 'categoria',
            'precio_venta', 'precio_compra',
            'stock', 'stock_minimo', 'descuento'
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($datos);

        return redirect()->route('productos.index')
            ->with('mensaje', 'Producto guardado correctamente.');
    }

    public function edit(Producto $producto)
    {
        return view('backend.productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $datos = $request->only([
            'nombre', 'descripcion', 'categoria',
            'precio_venta', 'precio_compra',
            'stock', 'stock_minimo', 'descuento'
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($datos);

        return redirect()->route('productos.index')
            ->with('mensaje', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('mensaje', 'Producto inactivado correctamente.');
    }

    public function restore($id)
    {
        Producto::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('productos.index')
            ->with('mensaje', 'Producto activado correctamente.');
    }

    public function forceDelete($id)
    {
        Producto::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('productos.index')
            ->with('mensaje', 'Producto eliminado permanentemente.');
    }
}
