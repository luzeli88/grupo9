<?php

namespace App\Http\Controllers;

use App\Models\NotificacionReingreso;
use Illuminate\Http\Request;

class NotificacionReingresoController extends Controller
{
    // Guardar suscripción a notificación de reingreso
    public function suscribirse(Request $request, $producto_id)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Evitar duplicados: una misma persona no puede suscribirse dos veces al mismo producto
        $existente = NotificacionReingreso::where('email', $request->email)
                                          ->where('producto_id', $producto_id)
                                          ->where('notificado', false)
                                          ->first();

        if ($existente) {
            return redirect()->back()->with('warning', '📧 Ya estás suscrito para recibir notificaciones de este producto.');
        }

        // Crear nueva suscripción
        NotificacionReingreso::create([
            'usuario_id'   => auth()->id() ?? null,
            'producto_id'  => $producto_id,
            'email'        => $request->email,
            'notificado'   => false,
        ]);

        return redirect()->back()->with('mensaje', '✅ ¡Te notificaremos cuando el producto vuelva a estar disponible!');
    }
}

