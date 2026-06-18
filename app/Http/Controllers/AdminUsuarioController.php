<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminUsuarioController extends Controller
{
    private function ensureAdmin()
    {
        if (auth()->user()->rol?->nombre !== 'admin') {
            abort(403, 'No autorizado.');
        }
    }

    public function index(Request $request)
    {
        $this->ensureAdmin();

        $query = Usuario::withTrashed()->with('rol');

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

        $usuarios = $query->get()->map(function ($usuario) {
            $usuario->carritoCount = Carrito::where('usuario_id', $usuario->id)->count();
            return $usuario;
        });

        $roles = Rol::all();
    return view('backend.usuarios.index', compact('usuarios', 'roles'));
}

    public function verCarrito($usuarioId)
    {
        $this->ensureAdmin();

        // El admin puede ver qué productos tiene en carrito cada usuario.
        $usuario = Usuario::withTrashed()->findOrFail($usuarioId);
        $items = Carrito::where('usuario_id', $usuarioId)->with('producto')->get();
        $total = $items->sum('total');

        return view('backend.usuarios.carrito-admin', compact('usuario', 'items', 'total'));
    }

    public function actualizarRol(Request $request, $id)
    {
        $this->ensureAdmin();

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
        $this->ensureAdmin();

        Usuario::findOrFail($id)->delete();
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario inactivado correctamente.');
    }

    public function activar($id)
    {
        $this->ensureAdmin();

        Usuario::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario activado correctamente.');
    }
    public function editar(Request $request, $id)
{
    $this->ensureAdmin();

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
