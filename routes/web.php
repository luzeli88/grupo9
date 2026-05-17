<?php

// Importamos el controlador para manejar el formulario de consultas.
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('principal');
});

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
})->name('quienes');

Route::get('/comercializacion', function () {
    return view('comercializacion');
})->name('comercializacion');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/consultas', function () {
    return view('consultas');
})->name('consultas');

// La ruta POST envía los datos del formulario a ConsultasController@procesar.
Route::post('/consultas', [ConsultasController::class, 'procesar']);

Route::get('/terminos', function () {
    return view('terminos');
})->name('terminos');

Route::get('/carrito', function () {
    return view('carrito');
})->name('carrito');

Route::get('/producto-sandalias', function () {
    return view('producto-sandalias');
})->name('sandalias');

Route::get('/producto-botas', function () {
    return view('producto-botas');
})->name('botas');

Route::get('/producto-zapatos', function () {
    return view('producto-zapatos');
})->name('zapatos');

// Paso 4: Rutas de autenticación - formularios
// Estas rutas muestran los formularios de registro y login.
Route::get('/registro', [AuthController::class, 'formularioRegistro'])->name('registro');
Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');

// Paso 5: Rutas de autenticación - procesamiento
// Estas rutas reciben los datos del formulario y ejecutan la lógica de registro/login.
Route::post('/registrar', [AuthController::class, 'registrar'])->name('registrar');
Route::post('/autenticar', [AuthController::class, 'autenticar'])->name('autenticar');

// Rutas de destino después del login
Route::get('/admin', function () {
    // Protege la ruta: el usuario debe estar autenticado y ser admin.
    if (!Auth::check()) {
        return redirect('/login');
    }

    if (Auth::user()->rol?->nombre !== 'admin') {
        return redirect('/cliente');
    }

    return view('backend.admin.dashboard');
})->name('admin');

Route::get('/cliente', function () {
    // Protege la ruta: el usuario debe estar autenticado.
    if (!Auth::check()) {
        return redirect('/login');
    }

    return view('backend.usuarios.cliente');
})->name('cliente');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/envio', function () {
    return view('envio');
})->name('envio');

Route::get('/pago', function () {
    return view('pago');
})->name('pago');

Route::get('/construccion', function () {
    return view('construccion');
})->name('construccion');


