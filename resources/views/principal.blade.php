@extends('plantilla')

@section('content')
<div class="container-fluid px-4">

    <div class="promo mb-4">
        <p class="mb-0 fs-5"><i class="bi bi-fire-fill"></i>🔥 No te pierdas los mejores descuentos en calzado y envíos rápidos.🔥</p>
    </div>

    <div class="full-width-section">

        <div class="carrusel-pro">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/Carrusel1.png') }}" class="d-block w-100 img-fluid" alt="Carrusel1.png">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/Carrusel2.png') }}" class="d-block w-100 img-fluid" alt="Carrusel2.png">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/Carrusel3.png') }}" class="d-block w-100 img-fluid" alt="Carrusel3.png">
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
        </div>

        <div class="promo mb-4">
            <p class="mb-0 fs-5"><i class="bi bi-lightning-charge-fill"></i> Estas promociones vuelan: descubrí las mejores ofertas antes de que se agoten.</p>
        </div>

        <div class="full-width-section productos-full">
            @include('partials.productos')
        </div>

    </div>

</div>
@endsection