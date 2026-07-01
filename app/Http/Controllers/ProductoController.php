<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductoTalle;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::withTrashed()->with('talles');

        if ($request->filled('buscar')) {
            $query->buscaPorNombre($request->buscar);
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('precio_min')) {
            $query->where('precio_venta', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio_venta', '<=', $request->precio_max);
        }

        if ($request->filled('stock_min')) {
            $query->where('stock', '>=', $request->stock_min);
        }

        if ($request->filled('stock_max')) {
            $query->where('stock', '<=', $request->stock_max);
        }

        if ($request->filled('estado')) {
            if ($request->estado === 'inactivo') {
                $query->onlyTrashed();
            } elseif ($request->estado === 'activo') {
                $query->whereNull('deleted_at');
            }
        }

        $productos = $query->paginate(15)->withQueryString();
        return view('backend.productos.index', compact('productos'));
    }
    public function create()
    {
        return view('backend.productos.create');
    }

    public function store(Request $request)
    {
        // Validación del producto, incluyendo tipo y tamaño de imagen.
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'categoria'     => 'required|string',
            'precio_venta'  => 'required|numeric',
            'precio_compra' => 'nullable|numeric',
            'stock'         => 'nullable|integer',
            'stock_minimo'  => 'nullable|integer',
            'descuento'     => 'nullable|numeric',
            'imagen'        => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Solo procesamos los campos esperados del formulario.
        $datos = $request->only([
            'nombre', 'descripcion', 'categoria',
            'precio_venta', 'precio_compra',
            'stock', 'stock_minimo', 'descuento'
        ]);

        if ($request->hasFile('imagen')) {
        $categoria = $datos['categoria'];
        $extension = $request->file('imagen')->getClientOriginalExtension();
        $nombreUnico = uniqid('producto_', true) . '.' . $extension;
        $ruta = "img/{$categoria}/{$nombreUnico}";

        $request->file('imagen')->move(public_path("img/{$categoria}"), $nombreUnico);
        $datos['imagen'] = $ruta;
        }

        $producto = Producto::create($datos);

        if ($request->has('talles')) {
            $stockTotal = 0;
            foreach ($request->talles as $talle => $stock) {
                $stockTalle = $stock ?? 0;
                ProductoTalle::create([
                    'producto_id' => $producto->id,
                    'talle'       => $talle,
                    'stock'       => $stockTalle,
                ]);
                $stockTotal += $stockTalle;
            }
            $producto->stock = $stockTotal;
            $producto->save();
        }

        return redirect()->route('productos.index')
            ->with('mensaje', 'Producto guardado correctamente.');
    }

    public function edit(Producto $producto)
    {
        $talles = $producto->talles->keyBy('talle');
        return view('backend.productos.edit', compact('producto', 'talles'));
    }

    public function update(Request $request, Producto $producto)
{
    $request->validate([
        'nombre'        => 'required|string|max:255',
        'categoria'     => 'required|string',
        'precio_venta'  => 'required|numeric',
        'precio_compra' => 'nullable|numeric',
        'stock'         => 'nullable|integer',
        'stock_minimo'  => 'nullable|integer',
        'descuento'     => 'nullable|numeric',
        'imagen'        => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $datos = $request->only([
        'nombre', 'descripcion', 'categoria',
        'precio_venta', 'precio_compra',
        'stock', 'stock_minimo', 'descuento'
    ]);

    $datos['descuento']    = $datos['descuento']    ?? 0;
    $datos['stock']        = $datos['stock']         ?? 0;
    $datos['stock_minimo'] = $datos['stock_minimo']  ?? 0;

    if ($request->hasFile('imagen')) {
    $categoria = $datos['categoria'];
    $extension = $request->file('imagen')->getClientOriginalExtension();
    $nombreUnico = uniqid('producto_', true) . '.' . $extension;
    $ruta = "img/{$categoria}/{$nombreUnico}";
    
    $request->file('imagen')->move(public_path("img/{$categoria}"), $nombreUnico);
    $datos['imagen'] = $ruta;
    }

    if ($request->has('talles')) {
        $stockTotal = 0;

        foreach ($request->talles as $talle => $stock) {
            $cantidad = (int)($stock ?? 0);
            $stockTotal += $cantidad;

            $existe = ProductoTalle::where('producto_id', $producto->id)
                                   ->where('talle', $talle)
                                   ->first();

            if ($existe) {
                ProductoTalle::where('producto_id', $producto->id)
                             ->where('talle', $talle)
                             ->update(['stock' => $cantidad]);
            } else {
                ProductoTalle::insert([
                    'producto_id' => $producto->id,
                    'talle'       => $talle,
                    'stock'       => $cantidad,
                ]);
            }
        }

        $datos['stock'] = $stockTotal;
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
