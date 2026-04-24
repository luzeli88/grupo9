
@extends('plantilla')

@section('content')

<h1>Consultas</h1>
<form action="{{ route('consultas.enviar') }}" method="POST">
    @csrf


    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Mensaje</label>
        <textarea name="mensaje" class="form-control" rows="5"></textarea>
    </div>

    <button class="btn btn-primary">Enviar</button>
</form>

@endsection