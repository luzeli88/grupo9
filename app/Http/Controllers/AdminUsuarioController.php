<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminUsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::withTrashed()->get();
        return view('backend.usuarios.index', compact('usuarios'));
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
}
