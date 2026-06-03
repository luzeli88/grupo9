@extends('plantilla')

@section('content')
@if(session('mensaje'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('mensaje') }}
    </div>
@endif

<div class="container my-5">

    <h1 class="text-center mb-4">
        Bienvenido/a, {{ auth()->user()?->nombre ?? auth()->user()?->name }}
    </h1>

    <div class="row justify-content-center g-4">

    <div class="col-md-4">
        <div class="panel-card">

            <h2>Mis datos</h2>

            <p>
                Ver o modificar mis datos personales.
            </p>

            <a href="{{ route('edita') }}" class="btn-panel">Ingresar</a>

        </div>
    </div>

    <div class="col-md-4">
        <div class="panel-card">
              <h2>Ver productos</h2>

            <p>
                Explorar productos disponibles.
            </p>

            <a href="{{ route('categorias') }}" class="btn-panel">
                Ver productos
            </a>

        </div>
    </div>

    <div class="col-md-4">
         <div class="panel-card">

            <h2>Carrito</h2>

            <p>
                Ver productos agregados para comprar.
            </p>

            <a href="{{ route('carrito') }}" class="btn-panel">
                Ir al carrito
            </a>

        </div>
    </div>

</div>
</div>
@endsection