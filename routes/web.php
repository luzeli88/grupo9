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

Route::get('/terminos', function () {
    return view('terminos');
})->name('terminos');

Route::get('/consultas', function () {
    return view('consultas');
})->name('consultas');
Route::get('/carrito', function () {
    return view('carrito');
})->name('carrito');

Route::get('/hombre', function () {
    return view('producto-hombre');
})->name('hombre');

Route::get('/mujer', function () {
    return view('producto-mujer');
})->name('mujer');

Route::get('/login', function () {
    return view('login');
})->name('login');