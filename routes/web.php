<?php

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

Route::post('/contacto', [ContactoController::class, 'procesar']);

Route::get('/terminos', function () {
    return view('terminos');
})->name('terminos');

Route::get('/consultas', function () {
    return view('consultas');
})->name('consultas');
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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/envio', function () {
    return view('envio');
})->name('envio');

Route::get('/pago', function () {
    return view('pago');
})->name('pago');
Route::get('/construccion', function () {
    return view('construccion');
})->name('construccion');

Route::post('/consultas-enviar', function () {
    return redirect()->route('construccion');
})->name('consultas.enviar');