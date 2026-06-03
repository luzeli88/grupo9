@extends('plantilla')

@section('content')
<div class="container mt-5">
    <h1>Panel de Administración</h1>
    <p>Bienvenido, {{ Auth::user()->nombre ?? 'Administrador' }}.</p>

    <div class="row g-4 mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text mb-1">Activos: <strong>{{ $usuariosActivos ?? 0 }}</strong></p>
                    <p class="card-text mb-3">Inactivos: <strong>{{ $usuariosInactivos ?? 0 }}</strong></p>
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-dark">Ver y gestionar usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text mb-3">Total de productos: <strong>{{ $productosCount ?? 0 }}</strong></p>
                    <a href="{{ route('productos.index') }}" class="btn btn-dark">Ver y gestionar productos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection