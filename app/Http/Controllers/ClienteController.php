<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function actualizar(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . auth()->id(),
            'telefono'  => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'ciudad'    => 'nullable|string|max:100',
        ]);

        auth()->user()->update($request->only([
            'nombre', 'email', 'telefono', 'direccion', 'ciudad'
        ]));

        return redirect()->route('cliente')
            ->with('mensaje', 'Datos actualizados correctamente.');
    }
}
