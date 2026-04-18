@extends('plantilla')
@section('content')
<h1 class="text-center mb-4">👞 Productos para Hombre</h1>

<div class="row justify-content-center">

    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ asset('img/kat_10.webp') }}" class="card-img-top">
            <div class="card-body text-center">
                <p class="fw-bold">$20.000</p>
                <a href="/carrito" class="btn btn-dark">Comprar</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ asset('img/leia_38.webp') }}" class="card-img-top">
            <div class="card-body text-center">
                <p class="fw-bold">$35.000</p>
                <a href="/carrito" class="btn btn-dark">Comprar</a>
            </div>
        </div>
    </div>

</div>

<div class="text-center mt-3">
    <a href="/" class="btn btn-secondary">⬅ Volver</a>
</div>
@endsection 
