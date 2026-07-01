<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\NotificacionReingresoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;

// ══════════════════════════════════════════════
//  RUTAS PÚBLICAS
// ══════════════════════════════════════════════

Route::get('/', function () {
    $productos = Producto::with('talles')->get();
    return view('principal', compact('productos'));
});

Route::get('/quienes-somos', fn() => view('quienes-somos'))->name('quienes');
Route::get('/comercializacion', fn() => view('comercializacion'))->name('comercializacion');
Route::get('/contacto', fn() => view('contacto'))->name('contacto');
Route::get('/terminos', fn() => view('terminos'))->name('terminos');
Route::get('/envio', fn() => view('envio'))->name('envio');
Route::get('/construccion', fn() => view('construccion'))->name('construccion');

Route::get('/categorias', [ProductoController::class, 'categorias'])->name('categorias');

Route::get('/consultas', fn() => view('consultas'))->name('consultas');
Route::post('/consultas', [ConsultasController::class, 'procesar']);

foreach (['sandalias', 'botas', 'zapatos'] as $categoria) {
    Route::get('/producto-' . $categoria, function () use ($categoria) {
        return view('categorias', [
            'productos' => Producto::with('talles')->where('categoria', $categoria)->get(),
            'categoria' => $categoria,
        ]);
    })->name($categoria);
}

Route::get('/pago', fn() => view('pago'))->name('pago');

// ══════════════════════════════════════════════
//  AUTENTICACIÓN
// ══════════════════════════════════════════════

Route::get('/registro', [AuthController::class, 'formularioRegistro'])->name('registro');
Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');
Route::post('/registrar', [AuthController::class, 'registrar'])->name('registrar');
Route::post('/autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [PasswordResetController::class, 'formulario'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'enviar'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'formularioReset'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

// ══════════════════════════════════════════════
//  RUTAS AUTENTICADAS — clientes y admins
// ══════════════════════════════════════════════

Route::middleware('auth')->group(function () {

    // ── Notificaciones ────────────────────────
    Route::get('/notificaciones', [NotificacionReingresoController::class, 'index'])
        ->name('notificaciones');
    Route::post('/notificacion/suscribirse/{producto_id}', [NotificacionReingresoController::class, 'suscribirse'])
        ->name('notificacion.suscribirse');

    // ── Dashboard cliente ─────────────────────
    Route::get('/cliente', fn() => view('backend.usuarios.cliente'))->name('cliente');

    // ── Perfil ────────────────────────────────
    Route::get('/edita', fn() => view('backend.usuarios.edita'))->name('edita');
    Route::post('/mis-datos/actualizar', [ClienteController::class, 'actualizar'])
        ->name('mis-datos.actualizar');

    // ── Carrito ───────────────────────────────
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
    Route::post('/carrito/agregar/{producto_id}', [CarritoController::class, 'agregar'])
        ->name('carrito.agregar');
    Route::patch('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])
        ->name('carrito.actualizar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])
        ->name('carrito.eliminar');

    // ── Pago y compras ────────────────────────
    Route::get('/usuario/pago', [CarritoController::class, 'pago'])->name('usuario.pago');
    Route::post('/pago/procesar', [PagoController::class, 'procesar'])->name('pago.procesar');
    Route::get('/factura/{id}', [PedidoController::class, 'factura'])->name('factura');
    Route::get('/mis-compras', [PedidoController::class, 'misCompras'])->name('compras');

    // ══════════════════════════════════════════
    //  RUTAS EXCLUSIVAS DE ADMINISTRADOR
    // ══════════════════════════════════════════

    Route::middleware('admin')->group(function () {

        // ── Dashboard y configuración ─────────
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');
        Route::post('/admin/verificar-clave', [AdminController::class, 'verificarClave'])
            ->name('admin.verificar.clave');
        Route::get('/admin/configuracion', [AdminController::class, 'configuracion'])
            ->name('admin.configuracion');
        Route::post('/admin/configuracion', [AdminController::class, 'guardarConfiguracion'])
            ->name('admin.configuracion.guardar');

        // ── Gestión de usuarios ───────────────
        Route::prefix('admin/usuarios')->name('admin.usuarios.')->group(function () {
            Route::get('/', [AdminUsuarioController::class, 'index'])->name('index');
            Route::post('/{id}/inactivar', [AdminUsuarioController::class, 'inactivar'])->name('inactivar');
            Route::post('/{id}/activar', [AdminUsuarioController::class, 'activar'])->name('activar');
            Route::post('/{id}/rol', [AdminUsuarioController::class, 'actualizarRol'])->name('rol');
            Route::get('/{id}/carrito', [AdminUsuarioController::class, 'verCarrito'])->name('carrito');
        });
        Route::patch('/admin/usuarios/{id}/editar', [AdminUsuarioController::class, 'editar'])
            ->name('admin.usuarios.editar');

        // ── Gestión de productos ──────────────
        Route::resource('productos', ProductoController::class)
             ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::post('/productos/{id}/restore', [ProductoController::class, 'restore'])
             ->name('productos.restore');
        Route::delete('/productos/{id}/force-delete', [ProductoController::class, 'forceDelete'])
             ->name('productos.forceDelete');

        // ── Gestión de pedidos ────────────────
        Route::get('/admin/pedidos', [PedidoController::class, 'index'])->name('admin.pedidos.index');
        Route::post('/admin/pedidos/{id}/estado', [PedidoController::class, 'actualizarEstado'])
            ->name('admin.pedidos.estado');
    });
});
