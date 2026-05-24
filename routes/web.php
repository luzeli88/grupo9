<?php

// Importamos el controlador para manejar el formulario de consultas.
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AdminUsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use Illuminate\Http\Request;

Route::get('/botas', function () {
    $productos = Producto::where('categoria', 'botas')->get();
    return view('producto-Botas', compact('productos'));
});

Route::get('/sandalias', function () {
    $productos = Producto::where('categoria', 'sandalias')->get();
    return view('producto-sandalias', compact('productos'));
});

Route::get('/zapatos', function () {
    $productos = Producto::where('categoria', 'zapatos')->get();
    return view('producto-zapatos', compact('productos'));
});

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

Route::post('/consultas', [ConsultasController::class, 'procesar']);

Route::get('/terminos', function () {
    return view('terminos');
})->name('terminos');

Route::get('/producto-sandalias', function () {
    $productos = Producto::where('categoria', 'sandalias')->get();
    return view('producto-sandalias', compact('productos'));
})->name('sandalias');

Route::get('/producto-botas', function () {
    $productos = Producto::where('categoria', 'botas')->get();
    return view('producto-Botas', compact('productos'));
})->name('botas');

Route::get('/producto-zapatos', function () {
    $productos = Producto::where('categoria', 'zapatos')->get();
    return view('producto-zapatos', compact('productos'));
})->name('zapatos');

Route::get('/registro', [AuthController::class, 'formularioRegistro'])->name('registro');
Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');

Route::post('/registrar', [AuthController::class, 'registrar'])->name('registrar');
Route::post('/autenticar', [AuthController::class, 'autenticar'])->name('autenticar');

Route::get('/admin', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    if (Auth::user()->rol?->nombre !== 'admin') {
        return redirect('/cliente');
    }
    $productos = Producto::withTrashed()->get();
    return view('backend.admin.dashboard', compact('productos'));
})->name('admin');

Route::get('/cliente', function () {
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

Route::resource('productos', ProductoController::class)
     ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
     ->middleware('auth');

Route::post('/productos/{id}/restore', [ProductoController::class, 'restore'])
    ->middleware('auth')
    ->name('productos.restore');

Route::delete('/productos/{id}/force-delete', [ProductoController::class, 'forceDelete'])
    ->middleware('auth')
    ->name('productos.forceDelete');

Route::get('/edita', function () {
    return view('backend.usuarios.edita');
})->middleware('auth')->name('edita');

Route::post('/mis-datos/actualizar', [ClienteController::class, 'actualizar'])
    ->middleware('auth')
    ->name('mis-datos.actualizar');

Route::post('/carrito/agregar/{producto_id}', [CarritoController::class, 'agregar'])
    ->middleware('auth')
    ->name('carrito.agregar');

Route::get('/carrito', [CarritoController::class, 'index'])
    ->middleware('auth')
    ->name('carrito');
Route::get('/admin/usuarios', [AdminUsuarioController::class, 'index'])
    ->middleware('auth')
    ->name('admin.usuarios.index');

Route::post('/admin/usuarios/{id}/inactivar', [AdminUsuarioController::class, 'inactivar'])
    ->middleware('auth')
    ->name('admin.usuarios.inactivar');

Route::post('/admin/usuarios/{id}/activar', [AdminUsuarioController::class, 'activar'])
    ->middleware('auth')
    ->name('admin.usuarios.activar');