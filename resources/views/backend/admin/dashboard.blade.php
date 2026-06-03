@extends('plantilla')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5">Panel de administracion</h1>
    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
    <div class="row justify-content-center g-4">
        <div class="col-md-4">
            <div class="panel-card text-center">
                <h2>Productos</h2>
                <p>Gestionar productos, agregar, editar o inactivar.</p>
                <a href="{{ route('productos.index') }}" class="btn btn-dark mb-3">Ver productos</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-card text-center">
                <h2>Clientes</h2>
                <p>Ver y gestionar los clientes registrados.</p>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-dark mb-3">Ver clientes</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-card text-center">
                <h2>Pedidos</h2>
                <p>Ver todos los pedidos realizados por los clientes.</p>
                <a href="{{ route('admin.pedidos.index') }}" class="btn btn-dark mb-3">Ver pedidos</a>
            </div>
        </div>
    </div>
</div>
@endsection