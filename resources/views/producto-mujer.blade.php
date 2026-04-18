@extends('plantilla')
@section('content')
<h1 class="text-center mb-4">👠 Productos para Mujer</h1>

<div class="row justify-content-center">

    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ asset('img/zapatilla-color.png') }}" class="card-img-top">
            <div class="card-body text-center">
                <p class="fw-bold">$22.000</p>
                <a href="/carrito" class="btn btn-danger">Comprar</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ asset('img/leia_35_cho-.webp') }}" class="card-img-top">
            <div class="card-body text-center">
                <p class="fw-bold">$40.000</p>
                <a href="/carrito" class="btn btn-danger">Comprar</a>
            </div>
        </div>
    </div>

</div>

<div class="text-center mt-3">
    <a href="/" class="btn btn-secondary">⬅ Volver</a>
</div>
@endsection 