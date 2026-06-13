@extends('plantilla')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5">Panel de Administración</h1>
    <p class="text-center mb-4">
        Bienvenido, {{ Auth::user()->nombre ?? 'Administrador' }}.
    </p>
    

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <div class="row justify-content-center g-4">
        
        <!-- Usuarios -->
        <div class="col-md-6">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3">Usuarios</h5>

                    <p class="card-text mb-1">
                        Activos: <strong>{{ $usuariosActivos ?? 0 }}</strong>
                    </p>

                    <p class="card-text mb-3">
                        Inactivos: <strong>{{ $usuariosInactivos ?? 0 }}</strong>
                    </p>

                    <a href="{{ route('admin.usuarios.index') }}"
                       class="btn btn-dark btn-lg w-100 mt-auto py-3">
                        Ver y gestionar usuarios
                    </a>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-6">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3">Productos</h5>

                    <p class="card-text mb-3">
                        Total: <strong>{{ $productosCount ?? 0 }}</strong>
                    </p>

                    <a href="{{ route('productos.index') }}"
                       class="btn btn-dark btn-lg w-100 mt-auto py-3">
                        Ver y gestionar productos
                    </a>
                </div>
            </div>
        </div>


        <!-- Pedidos -->
        <div class="col-md-6">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3">Pedidos</h5>

                    <p class="card-text mb-3">
                        Ver todos los pedidos realizados.
                    </p>

                    <a href="{{ route('admin.pedidos.index') }}"
                       class="btn btn-dark btn-lg w-100 mt-auto py-3">
                        Ver pedidos
                    </a>
                </div>
            </div>
        </div>
        <!-- Configuraciones Comerciales -->
        <div class="col-md-6">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3">Configuraciones Comerciales</h5>

                    <p class="card-text mb-3">
                        Configurar descuentos y recargos.
                    </p>

                    <a href="{{ route('admin.configuracion') }}"
                       class="btn btn-dark btn-lg w-100 mt-auto py-3">
                        Ver Configuraciones comerciales
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection