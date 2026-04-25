
@extends('plantilla')

@section('content')

<div class="container mt-4">
    <div class="text-center mb-4">
        <h1 class="titulo">Contacto</h1>
        <p class="lead text-secondary">Escribinos o visitanos en nuestra local. Estamos disponibles para ayudarte.</p>
    </div>

    <div class="row gy-4">
        <div class="col-lg-5">
            <div class="contact-card p-4 h-100">
                <h2 class="mb-3">Información de contacto</h2>

                <p class="mb-4">Te esperamos en nuestro local, donde podés conocer más sobre Step & Style y resolver tus dudas.</p>

                <ul class="list-unstyled mb-4 contact-list">
                    <li class="mb-3">
                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                        Av. Sta. Fe 438, Palermo, Ciudad de Buenos Aires
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-telephone-fill me-2 text-primary"></i>
                        +54 9 11 1234-5678
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-envelope-fill me-2 text-primary"></i>
                        contacto@stepandstyle.com.ar
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-clock-fill me-2 text-primary"></i>
                        Lun - Vie: 09:00 - 18:00
                    </li>
                </ul>

                <h3 class="h5 mb-3">Seguinos en redes</h3>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('construccion') }}" class="btn btn-outline-dark contact-social">
                        <i class="bi bi-facebook me-2"></i> Facebook 
                    </a>
                    <a href="{{ route('construccion') }}" class="btn btn-outline-dark contact-social">
                        <i class="bi bi-instagram me-2"></i> Instagram
                    </a>
                    <a href="{{ route('construccion') }}" class="btn btn-outline-dark contact-social">
                        <i class="bi bi-whatsapp me-2"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="contact-card overflow-hidden h-100">
                <iframe class="contact-map" src="https://maps.google.com/maps?q=Av.%20Sta.%20Fe%20438%2C%20Palermo%2C%20Buenos%20Aires&t=&z=15&ie=UTF8&iwloc=&output=embed" allowfullscreen="" loading="lazy"></iframe>
                <div class="p-4">
                    <h3 class="h5 mb-3">Nuestra ubicación</h3>
                    <p> ¡Te esperamos!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
