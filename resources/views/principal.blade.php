@extends('plantilla')

@section('content')

<!-- BANNER -->
<section class="text-center banner">
    <h1>Step & Style</h1>
    <p>Elegancia en cada paso</p>
</section>

<<div class="container">
    <div id="carouselExample" class="carousel slide mx-auto carrusel-chico">

        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ asset('img/aryna_1_.webp') }}" class="d-block w-100">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('img/ascaril_14.webp') }}" class="d-block w-100">
            </div>

        </div>

        <!-- BOTONES AFUERA -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
</div>

<!-- PRODUCTOS -->
<div class="row text-center">

    <div class="col-md-4">
        <div class="card producto-card">
            <img src="{{ asset('img/leia_35_cho-.webp') }}" class="card-img-top">
            <div class="card-body">
                <h5>Zapatillas</h5>
                <p>$20.000</p>
                <button class="btn btn-dark">Comprar</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card producto-card">
            <img src="{{ asset('img/nimra_1_neg-463cbd3a2898fb797417761915838877-1024-1024.webp') }}" class="card-img-top">
            <div class="card-body">
                <h5>Zapatos</h5>
                <p>$35.000</p>
                <button class="btn btn-dark">Comprar</button>
            </div>
        </div>
    </div>

</div>

@endsection
