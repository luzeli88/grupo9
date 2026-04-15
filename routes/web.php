<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('principal');
});

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
});

Route::get('/comercializacion', function () {
    return view('comercializacion');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/terminos', function () {
    return view('terminos');
});

Route::get('/catalogo', function () {
    return view('catalogo');
});

Route::get('/consultas', function () {
    return view('consultas');
});
Route::get('/carrito', function () {
    return view('carrito');
});
Route::get('/hombre', function () {
    return "Sección Hombre";
});

Route::get('/mujer', function () {
    return "Sección Mujer";
});
Route::get('/hombre', function () {
    return view('hombre');
});

Route::get('/mujer', function () {
    return view('mujer');
});