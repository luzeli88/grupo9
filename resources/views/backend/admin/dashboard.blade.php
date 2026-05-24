@extends('plantilla')

@section('content')

<div class="container my-5">

    <h1 class="text-center mb-5">Panel de administración</h1>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <div class="row justify-content-center g-4">

        <div class="col-md-4">
            <div class="panel-card text-center">
                <h2>🛍️ Productos</h2>
                <p>Gestionar productos, agregar, editar o inactivar.</p>
                <a href="{{ route('productos.index') }}" class="btn btn-dark mb-3">Ver productos</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel-card text-center">
                <h2>👥 Clientes</h2>
                <p>Ver y gestionar los clientes registrados.</p>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-dark mb-3">Ver clientes</a>
            </div>
        </div>

    </div>
</div>

@endsection





