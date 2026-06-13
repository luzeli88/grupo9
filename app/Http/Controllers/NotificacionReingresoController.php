<?php

namespace App\Http\Controllers;

use App\Models\NotificacionReingreso;
use Illuminate\Http\Request;

class NotificacionReingresoController extends Controller
{
    public function suscribirse(Request $request, $producto_id)
    {
        $existente = NotificacionReingreso::where('usuario_id', auth()->id())
                                          ->where('producto_id', $producto_id)
                                          ->where('notificado', 0)
                                          ->first();

        if ($existente) {
            return redirect()->back()->with('warning', '📧 Ya estás suscrito para recibir notificaciones de este producto.');
        }

        NotificacionReingreso::create([
        'usuario_id'  => auth()->id(),
        'producto_id' => $producto_id,
        'email'       => auth()->user()->email, // ✅ tomamos el email del usuario
        'notificado'  => 0,
        ]);

        return redirect()->back()->with('mensaje', '✅ ¡Te notificaremos cuando el producto vuelva a estar disponible!');
    }

    public function index()
    {
        $notificaciones = NotificacionReingreso::where('usuario_id', auth()->id())
                                               ->with('producto')
                                               ->get();

        return view('backend.usuarios.notificaciones', compact('notificaciones'));
    }
}