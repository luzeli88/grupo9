<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminUsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Usuario::withTrashed()
            ->with('rol')
            ->withCount(['carrito as carritoCount']);

        if ($request->filled('buscar')) {
            $query->buscaPorNombreOEmail($request->buscar);
        }

        if ($request->filled('rol')) {
            $query->whereHas('rol', fn($q) => $q->where('nombre', $request->rol));
        }

        if ($request->filled('estado')) {
            if ($request->estado === 'inactivo') {
                $query->onlyTrashed();
            } elseif ($request->estado === 'activo') {
                $query->whereNull('deleted_at');
            }
        }

        $usuarios = $query->paginate(15)->withQueryString();
        $roles = Rol::all();
        return view('backend.usuarios.index', compact('usuarios', 'roles'));
    }

    public function verCarrito($usuarioId)
    {
        $usuario = Usuario::withTrashed()->findOrFail($usuarioId);
        $items = Carrito::where('usuario_id', $usuarioId)->with('producto')->get();
        $total = $items->sum('total');

        return view('backend.usuarios.carrito-admin', compact('usuario', 'items', 'total'));
    }

    public function actualizarRol(Request $request, $id)
    {
        $request->validate([
            'rol_id' => 'required|exists:roles,id',
        ]);

        $usuario = Usuario::withTrashed()->findOrFail($id);
        $usuario->rol_id = $request->rol_id;
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Rol actualizado correctamente.');
    }

    public function inactivar($id)
    {
        Usuario::findOrFail($id)->delete();
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario inactivado correctamente.');
    }

    public function activar($id)
    {
        Usuario::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario activado correctamente.');
    }

    public function editar(Request $request, $id)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'telefono'  => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'ciudad'    => 'nullable|string|max:100',
        ]);

        $usuario = Usuario::withTrashed()->findOrFail($id);
        $usuario->update($request->only(['nombre', 'email', 'telefono', 'direccion', 'ciudad']));

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Datos del usuario actualizados correctamente.');
    }
}
