<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function formularioRegistro(){
        return view('backend.usuarios.registro');
    }

    public function formularioLogin(){
        return view('backend.usuarios.login');
    }

    public function registrar(Request $request){

        // Validación
        $validated = $request->validate([
            'nombre' => 'required|string|max:255', // El nombre es obligatorio
            'apellido' => 'required|string|max:255', // El apellido es obligatorio
            'email' => 'required|email|unique:usuarios', // El email es obligatorio, válido y único
            'password' => 'required|min:6|confirmed', // La contraseña es obligatoria y debe confirmarse
        ], [
            'email.unique' => 'Este correo ya está registrado. Por favor, usá otro o iniciá sesión.',
        ]);

        $fullName = trim($validated['nombre'] . ' ' . $validated['apellido']);

        $rol = Rol::firstOrCreate(
            ['nombre' => 'cliente'],
            ['descripcion' => 'Cliente registrado']
        );

        // Creación del usuario en la base de datos
        $usuario = Usuario::create([
            'nombre' => $fullName,
            'email' => $validated['email'],
            'password' => $validated['password'],
            'rol_id' => $rol->id,
        ]);

        // Loguear automáticamente al usuario recién registrado
        Auth::login($usuario);

        // Redirigir a la página de inicio tras el registro
        return redirect('/');
    }

    // Valida email y password
    public function autenticar(Request $request){

        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Intenta iniciar sesión
        if (Auth::attempt($credenciales, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->rol?->nombre === 'admin') {
                return redirect('/admin'); // Redirige al admin después del login exitoso
            }

            return redirect('/cliente'); // Redirige al cliente después del login exitoso
        }

        // Si falla el login
        return back()->withErrors([
            'email' => 'Email o contraseña incorrectos'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();// Cierra la sesión del usuario autenticado

        $request->session()->invalidate();// Invalida la sesión actual
        $request->session()->regenerateToken();// Regenera el token CSRF para evitar ataques de falsificación de solicitudes

        return redirect('/'); // Redirige a la página de inicio después del logout
    }

}