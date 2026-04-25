@extends('plantilla')

@section('content')
<div class="container my-5">
    <div class="success-card rounded-4 p-5 shadow-sm text-center">
        <div class="mb-4">
            <span class="success-icon d-inline-flex align-items-center justify-content-center mb-3">
                <i class="bi bi-check-circle-fill"></i>
            </span>
            <h1 class="mb-3">¡Gracias por tu consulta!</h1>
        </div>
        <p class="lead mb-4">Hola <strong>{{ $nombre }}</strong>, recibimos tu mensaje y te escribiremos al correo <strong>{{ $email }}</strong> muy pronto.</p>
        <p class="mb-4">Nuestro equipo está preparando una respuesta personalizada para ayudarte con tu compra.</p>
        <a href="{{ url('/') }}" class="btn btn-outline-primary btn-lg">Volver al inicio</a>
        <div class="signature-box mt-5 pt-3 border-top">
            <p class="mb-1 fw-bold">Step & Style</p>
            <p class="text-muted mb-0">Tu estilo en cada paso</p>
        </div>
    </div>
</div>
@endsection