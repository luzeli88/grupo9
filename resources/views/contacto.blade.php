
@extends('plantilla')

@section('content')

<h1 class="titulo">Contacto</h1>

<div class="container text-center mt-4">

    <h4>Seguinos en nuestras redes</h4>

    <div class="mt-4">

        <a href="{{ route('construccion') }}" class="btn btn-primary m-2">
            Facebook
             </a>

        <a href="{{ route('construccion') }}" class="btn btn-danger m-2">
            Instagram
        </a>

        <a href="{{ route('construccion') }}" class="btn btn-success m-2">
            WhatsApp
        </a>

    </div>

</div>

@endsection
