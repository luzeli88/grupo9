@extends('plantilla')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5">Panel de Administración</h1>
    <p class="text-center mb-4">Bienvenido, {{ Auth::user()->nombre ?? 'Administrador' }}.</p>
    
    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
    
    <div class="row justify-content-center g-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text mb-1">Activos: <strong>{{ $usuariosActivos ?? 0 }}</strong></p>
                    <p class="card-text mb-3">Inactivos: <strong>{{ $usuariosInactivos ?? 0 }}</strong></p>
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-dark">Ver y gestionar usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text mb-3">Total: <strong>{{ $productosCount ?? 0 }}</strong></p>
                    <a href="{{ route('productos.index') }}" class="btn btn-dark">Ver y gestionar productos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Pedidos</h5>
                    <p class="card-text mb-3">Ver todos los pedidos realizados.</p>
                    <a href="{{ route('admin.pedidos.index') }}" class="btn btn-dark">Ver pedidos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection