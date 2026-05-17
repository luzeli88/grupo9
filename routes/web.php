<?php

// Importamos el controlador para manejar el formulario de consultas.
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\AuthController;
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

// Rutas de autenticación (formularios)
Route::get('/registro', [AuthController::class, 'formularioRegistro'])->name('registro');
Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');

// Rutas de procesamiento de formularios de autenticación
Route::post('/registrar', [AuthController::class, 'registrar'])->name('registrar');
Route::post('/autenticar', [AuthController::class, 'autenticar'])->name('autenticar');

// Rutas de destino después del login
Route::get('/admin', function () {
    return 'Panel de administración (ruta activa).';
})->name('admin');

Route::get('/cliente', function () {
    return 'Panel del cliente (ruta activa).';
})->name('cliente');

Route::get('/envio', function () {
    return view('envio');
})->name('envio');

Route::get('/pago', function () {
    return view('pago');
})->name('pago');

Route::get('/construccion', function () {
    return view('construccion');
})->name('construccion');


