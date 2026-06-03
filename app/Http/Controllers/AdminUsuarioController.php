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

    public function index()
    {
        $this->ensureAdmin();

        // Cargamos usuarios con su rol y contamos items en carrito.
        $usuarios = Usuario::withTrashed()->with('rol')->get();
        // Para cada usuario, agregamos el conteo de items en carrito.
        $usuarios = $usuarios->map(function ($usuario) {
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
}
