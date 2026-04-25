@extends('plantilla')

@section('content')
<div class="container my-5">
    <div class="text-center construccion-card rounded-4 shadow-sm p-5">
        <h1 class="mb-3">🚧 Página en construcción</h1>
        <p class="text-muted mb-4">Estamos mejorando esta sección para ofrecerte una experiencia más completa. Volvé al inicio y seguí explorando nuestras novedades.</p>
        <a href="{{ url('/') }}" class="btn btn-outline-primary btn-lg">Volver al inicio</a>
    </div>
</div>
@endsection