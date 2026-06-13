@extends('plantilla')

@section('content')
@if(session('mensaje'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('mensaje') }}
    </div>
@endif

<div class="container my-5">

    <h1 class="text-center mb-5">
        Bienvenido/a, {{ auth()->user()?->nombre ?? auth()->user()?->name }}
    </h1>

    <div class="row justify-content-center g-4">

        <!-- Mis datos -->
        <div class="col-md-6">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3">Mis datos</h5>

                    <p class="card-text">
                        Ver y actualizar tu información personal.
                    </p>

                    <a href="{{ route('edita') }}"
                       class="btn btn-dark btn-lg w-100 mt-auto py-3">
                        Ingresar
                    </a>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-6">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3">Productos</h5>

                    <p class="card-text">
                        Explorar todos los productos disponibles.
                    </p>

                    <a href="{{ route('categorias') }}"
                       class="btn btn-dark btn-lg w-100 mt-auto py-3">
                        Ver productos
                    </a>
                </div>
            </div>
        </div>

        <!-- Carrito -->
        <div class="col-md-6">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3">Carrito</h5>

                    <p class="card-text">
                        Ver los productos agregados para comprar.
                    </p>

                    <a href="{{ route('carrito') }}"
                       class="btn btn-dark btn-lg w-100 mt-auto py-3">
                        Ir al carrito
                    </a>
                </div>
            </div>
        </div>

        <!-- Compras -->
        <div class="col-md-6">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3">Mis compras</h5>

                    <p class="card-text">
                        Consultar el historial de compras realizadas.
                    </p>

                    <a href="{{ route('compras') }}"
                       class="btn btn-dark btn-lg w-100 mt-auto py-3">
                        Ver compras
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection