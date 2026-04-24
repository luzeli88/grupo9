@extends('plantilla')

@section('content')
<div class="container-fluid px-4">
<div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/aryna_1_.webp') }}" class="d-block w-100" alt="Aryna 1.webp">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/kat_10.webp') }}" class="d-block w-100" alt="Kat 10.webp">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/leia_38.webp') }}" class="d-block w-100" alt="Leia 38.webp">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



<!-- PRODUCTOS -->
    @php
    $productos = [
        ['nombre' => 'Zapatillas', 'precio' => 20000, 'imagen' => 'img/leia_35_cho-.webp'],
        ['nombre' => 'Zapatos', 'precio' => 35000, 'imagen' => 'img/nimra_1_neg-463cbd3a2898fb797417761915838877-1024-1024.webp'],
        ['nombre' => 'Botas', 'precio' => 40000, 'imagen' => 'img/leia_38.webp'],
        ['nombre' => 'Zapatillas', 'precio' => 20000, 'imagen' => 'img/leia_35_cho-.webp'],
        ['nombre' => 'Zapatos', 'precio' => 35000, 'imagen' => 'img/nimra_1_neg-463cbd3a2898fb797417761915838877-1024-1024.webp'],
        ['nombre' => 'Botas', 'precio' => 40000, 'imagen' => 'img/leia_38.webp'],
    ];
    @endphp

    @include('partials.productos', ['productos' => $productos])

</div>
<!-- <div class="row text-center g-4 mt-3">

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

</div> -->

@endsection
