<?php

use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\NotificacionReingresoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Carrito;
use App\Models\Pedido;
use Illuminate\Http\Request;

// ══════════════════════════════════════════════
//  RUTAS PÚBLICAS
// ══════════════════════════════════════════════

Route::get('/', fn() => view('principal'));

Route::get('/quienes-somos', fn() => view('quienes-somos'))->name('quienes');
Route::get('/comercializacion', fn() => view('comercializacion'))->name('comercializacion');
Route::get('/contacto', fn() => view('contacto'))->name('contacto');
Route::get('/terminos', fn() => view('terminos'))->name('terminos');
Route::get('/envio', fn() => view('envio'))->name('envio');
Route::get('/construccion', fn() => view('construccion'))->name('construccion');
Route::get('/categorias', fn() => view('categorias'))->name('categorias');

Route::get('/consultas', fn() => view('consultas'))->name('consultas');
Route::post('/consultas', [ConsultasController::class, 'procesar']);

Route::get('/producto-sandalias', function () {
    return view('producto-sandalias', ['productos' => Producto::where('categoria', 'sandalias')->get()]);
})->name('sandalias');

Route::get('/producto-botas', function () {
    return view('producto-Botas', ['productos' => Producto::where('categoria', 'botas')->get()]);
})->name('botas');

Route::get('/producto-zapatos', function () {
    return view('producto-zapatos', ['productos' => Producto::where('categoria', 'zapatos')->get()]);
})->name('zapatos');
// ── Página informativa de formas de pago (pública) ──
Route::get('/pago', fn() => view('pago'))->name('pago');
// ══════════════════════════════════════════════
//  AUTENTICACIÓN
// ══════════════════════════════════════════════

Route::get('/registro', [AuthController::class, 'formularioRegistro'])->name('registro');
Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');
Route::post('/registrar', [AuthController::class, 'registrar'])->name('registrar');
Route::post('/autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Recuperación de contraseña ────────────────
Route::get('/forgot-password', [PasswordResetController::class, 'formulario'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'enviar'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'formularioReset'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

// ══════════════════════════════════════════════
//  RUTAS AUTENTICADAS
// ══════════════════════════════════════════════

Route::middleware('auth')->group(function () {
    // ── Notificaciones ────────────────────────
    Route::get('/notificaciones', [NotificacionReingresoController::class, 'index'])
        ->name('notificaciones');
    Route::post('/notificacion/suscribirse/{producto_id}', [NotificacionReingresoController::class, 'suscribirse'])
        ->name('notificacion.suscribirse');
    // ── Dashboards ────────────────────────────
    Route::get('/cliente', fn() => view('backend.usuarios.cliente'))->name('cliente');

    Route::get('/admin', function () {
        
        if (Auth::user()->rol?->nombre !== 'admin') {
            return redirect('/cliente');
        }
        return view('backend.admin.dashboard', [
            'productosCount'    => Producto::count(),
            'usuariosActivos'   => Usuario::whereNull('deleted_at')->count(),
            'usuariosInactivos' => Usuario::onlyTrashed()->count(),
        ]);

    })->name('admin');

    // ── Perfil cliente ────────────────────────
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

    // ── Pago ──────────────────────────────────
    Route::get('/usuario/pago', function () {
        $items = Carrito::where('usuario_id', auth()->id())->with('producto')->get();
        $total = $items->sum('total');
        return view('backend.usuarios.pago', compact('items', 'total'));
    })->name('usuario.pago');

    Route::post('/pago/procesar', [PagoController::class, 'procesar'])->name('pago.procesar');

    // ── Factura ───────────────────────────────
    Route::get('/factura/{id}', function ($id) {
        $pedido = Pedido::with(['items.producto', 'usuario'])->findOrFail($id);
        return view('backend.usuarios.factura', compact('pedido'));
    })->name('factura');

    

    // ── Productos (admin) ─────────────────────
    Route::resource('productos', ProductoController::class)
         ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::post('/productos/{id}/restore', [ProductoController::class, 'restore'])
         ->name('productos.restore');
    Route::delete('/productos/{id}/force-delete', [ProductoController::class, 'forceDelete'])
         ->name('productos.forceDelete');

    // ── Administración de usuarios ────────────
    Route::prefix('admin/usuarios')->name('admin.usuarios.')->group(function () {
        Route::get('/', [AdminUsuarioController::class, 'index'])->name('index');
        Route::post('/{id}/inactivar', [AdminUsuarioController::class, 'inactivar'])->name('inactivar');
        Route::post('/{id}/activar', [AdminUsuarioController::class, 'activar'])->name('activar'); // ✅ corregido
        Route::post('/{id}/rol', [AdminUsuarioController::class, 'actualizarRol'])->name('rol');
        Route::get('/{id}/carrito', [AdminUsuarioController::class, 'verCarrito'])->name('carrito');
    });

    // ── Pedidos (admin) ───────────────────────
    Route::get('/admin/pedidos', function () {
        $pedidos = Pedido::with('usuario')->orderBy('created_at', 'desc')->get();
        return view('backend.admin.pedidos', compact('pedidos'));
    })->name('admin.pedidos.index');

    Route::post('/admin/pedidos/{id}/estado', function ($id, Request $request) {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->save();
        return redirect()->route('admin.pedidos.index')->with('mensaje', 'Estado actualizado.');
    })->name('admin.pedidos.estado');
});