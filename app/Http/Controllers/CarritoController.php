<?php
namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\ProductoTalle;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // ─── Helper privado para verificar rol ───────────────────────────────────
    private function soloClientes(string $redireccion = 'admin')
    {
        if (auth()->user()->rol?->nombre !== 'cliente') {
            return redirect()->route($redireccion)
                             ->with('mensaje', 'No estás autorizado para acceder aquí.');
        }
        return null;
    }

    private function stockDisponibleParaTalle(int $productoId, int $talle, ?int $carritoId = null): int
    {
        $productoTalle = ProductoTalle::where('producto_id', $productoId)
            ->where('talle', $talle)
            ->first();

        if (!$productoTalle) {
            return 0;
        }

        $reservas = Carrito::where('producto_id', $productoId)
            ->where('talle', $talle);

        if ($carritoId) {
            $reservas->where('id', '!=', $carritoId);
        }

        return max(0, $productoTalle->stock - $reservas->sum('cantidad'));
    }

    private function actualizarStockGeneral(Producto $producto): void
    {
        $producto->stock = ProductoTalle::where('producto_id', $producto->id)->sum('stock');
        $producto->save();
    }

    private function respuestaSinStock(Producto $producto, string $mensaje)
    {
        return redirect()->back()->with([
            'error' => $mensaje,
            'notificar_producto_id' => $producto->id,
            'notificar_producto_nombre' => $producto->nombre,
        ]);
    }

    // ─── Agregar producto al carrito ──────────────────────────────────────────
    public function agregar(Request $request, $producto_id)
    {
        // 1. Autorización primero
        if ($redir = $this->soloClientes()) return $redir;

        // 2. Validar que venga el talle desde el formulario
        $request->validate(['talle' => 'required|integer']);
        $talle = (int) $request->talle;

        // 3. Buscar el producto
        $producto = Producto::findOrFail($producto_id);
        $this->actualizarStockGeneral($producto);

        // 4. Verificar stock general
        if ($producto->stock <= 0) {
            return $this->respuestaSinStock($producto, '❌ Producto sin stock disponible.');
        }

        // 5. Calcular unidades realmente disponibles descontando reservas de otros
        $itemExistente = Carrito::where('usuario_id', auth()->id())
                                ->where('producto_id', $producto_id)
                                ->where('talle', $talle)
                                ->first();

        $disponible = $this->stockDisponibleParaTalle(
            $producto_id,
            $talle,
            $itemExistente?->id
        );

        if ($disponible <= 0) {
            return $this->respuestaSinStock(
                $producto,
                "❌ No quedan unidades disponibles para {$producto->nombre} en talle {$talle}."
            );
        }

        // 6. Actualizar o crear el item
        if ($itemExistente) {
            if ($itemExistente->cantidad + 1 > $disponible) {
                return $this->respuestaSinStock(
                    $producto,
                    "❌ Solo hay {$disponible} unidad(es) disponible(s) para {$producto->nombre} en talle {$talle}."
                );
            }
            $itemExistente->cantidad += 1;
            $itemExistente->total    = $itemExistente->cantidad * $itemExistente->precio_unitario;
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

    // ─── Ver el carrito ───────────────────────────────────────────────────────
    public function index()
    {
        if ($redir = $this->soloClientes()) return $redir;

        $items = Carrito::where('usuario_id', auth()->id())->with('producto')->get();
        $total = $items->sum('total');

        return view('backend.usuarios.carrito', compact('items', 'total'));
    }

    // ─── Vista de pago ────────────────────────────────────────────────────────
   public function pago()
{
    if ($redir = $this->soloClientes()) return $redir;

    $items = Carrito::where('usuario_id', auth()->id())->with('producto')->get();
    $total = $items->sum('total');

    $descuentoTransferencia = (float) \App\Models\Configuracion::get('descuento_transferencia', 10);
    $recargoCreditoMas6     = (float) \App\Models\Configuracion::get('recargo_credito_mas6', 15);
    $recargoCreditoHasta6   = (float) \App\Models\Configuracion::get('recargo_credito_6', 0);

    return view('backend.usuarios.pago', compact(
        'items', 'total',
        'descuentoTransferencia', 'recargoCreditoMas6', 'recargoCreditoHasta6'
    ));
}

    // ─── Actualizar cantidad ──────────────────────────────────────────────────
    public function actualizar(Request $request, $id)
    {
        if ($redir = $this->soloClientes()) return $redir;

        $request->validate(['cantidad' => 'required|integer|min:1']);

        $item = Carrito::where('usuario_id', auth()->id())->findOrFail($id);
        $producto = $item->producto;

        if ($producto) {
            $this->actualizarStockGeneral($producto);
        }

        // Verificar stock antes de actualizar
        $disponible = $this->stockDisponibleParaTalle(
            $item->producto_id,
            (int) $item->talle,
            $item->id
        );

        if ($request->cantidad > $disponible) {
            if ($producto) {
                return $this->respuestaSinStock(
                    $producto,
                    "❌ Solo hay {$disponible} unidad(es) disponible(s) para {$producto->nombre} en talle {$item->talle}."
                );
            }

            return redirect()->back()->with('error', "❌ Solo hay {$disponible} unidad(es) disponibles.");
        }

        $item->cantidad = $request->cantidad;
        $item->total    = $item->cantidad * $item->precio_unitario;
        $item->save();

        return redirect()->route('carrito')->with('mensaje', '✅ Carrito actualizado.');
    }

    // ─── Eliminar item ────────────────────────────────────────────────────────
    public function eliminar($id)
    {
        if ($redir = $this->soloClientes()) return $redir;

        $item = Carrito::where('usuario_id', auth()->id())->findOrFail($id);
        $item->delete();

        return redirect()->route('carrito')->with('mensaje', 'Producto eliminado del carrito.');
    }
}
