<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    public function procesar(Request $request)
    {
        // Capturamos los datos enviados desde el formulario de consultas.
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $mensaje = $request->input('mensaje');

        // Enviamos los datos a la vista de éxito para mostrarlos al usuario.
        return view('exito', [
            'nombre' => $nombre,
            'email' => $email,
            'mensaje' => $mensaje,
        ]);
    }
}
