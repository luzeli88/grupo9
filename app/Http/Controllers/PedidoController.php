<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::with('usuario')->orderBy('created_at', 'desc');

        if ($request->filled('buscar')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->buscaPorNombre($request->buscar);
            });
        }

        if ($request->filled('metodo_pago')) {
            $query->where('metodo_pago', $request->metodo_pago);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        if ($request->filled('total_min')) {
            $query->where('total', '>=', $request->total_min);
        }

        if ($request->filled('total_max')) {
            $query->where('total', '<=', $request->total_max);
        }

        $pedidos = $query->paginate(15)->withQueryString();
        return view('backend.admin.pedidos', compact('pedidos'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->save();
        return redirect()->route('admin.pedidos.index')->with('mensaje', 'Estado actualizado.');
    }

    public function factura($id)
    {
        $pedido = Pedido::with([
            'items.producto' => fn($q) => $q->withTrashed(),
            'usuario',
        ])->findOrFail($id);
        return view('backend.usuarios.factura', compact('pedido'));
    }

    public function misCompras(Request $request)
    {
        $query = Pedido::with(['items.producto'])
            ->where('usuario_id', auth()->id())
            ->orderBy('created_at', 'desc');

        if ($request->filled('metodo_pago')) {
            $query->where('metodo_pago', $request->metodo_pago);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        $pedidos = $query->get();
        return view('backend.usuarios.compras', compact('pedidos'));
    }
}
