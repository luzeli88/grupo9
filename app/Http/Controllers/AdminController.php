<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Usuario;
use App\Services\ConfiguracionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('backend.admin.dashboard', [
            'productosCount'    => Producto::count(),
            'usuariosActivos'   => Usuario::whereNull('deleted_at')->count(),
            'usuariosInactivos' => Usuario::onlyTrashed()->count(),
        ]);
    }

    public function verificarClave(Request $request)
    {
        $ok = Hash::check($request->password, Auth::user()->password);
        return response()->json(['ok' => $ok]);
    }

    public function configuracion()
    {
        $configs = ConfiguracionService::obtenerPorcentajes();
        return view('backend.admin.configuracion', compact('configs'));
    }

    public function guardarConfiguracion(Request $request)
    {
        ConfiguracionService::actualizar($request->all());
        return redirect()->route('admin.configuracion')
            ->with('mensaje', 'Configuración guardada correctamente.');
    }
}
