<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConsultasController extends Controller
{
    public function procesar(Request $request)
    {
        $request->validate([
            'nombre'  => 'required|string',
            'email'   => 'required|email',
            'mensaje' => 'required|string',
        ]);

        $nombre  = $request->input('nombre');
        $email   = $request->input('email');
        $mensaje = $request->input('mensaje');

        // Guardar consulta en la base de datos
        Consulta::create([
            'nombre'  => $nombre,
            'email'   => $email,
            'mensaje' => $mensaje,
            'estado'  => 'pendiente',
        ]);

        Mail::raw(
            "Nueva consulta recibida:\n\nNombre: $nombre\nEmail: $email\n\nMensaje:\n$mensaje",
            function ($mail) use ($nombre, $email) {
                $mail->to('anfran06@gmail.com')
                     ->subject('Nueva consulta de ' . $nombre)
                     ->replyTo($email, $nombre);
            }
        );

        return view('exito', [
            'nombre'  => $nombre,
            'email'   => $email,
            'mensaje' => $mensaje,
        ]);
    }
}
