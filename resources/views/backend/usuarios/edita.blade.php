@extends('plantilla')

@section('content')

<div class="container my-5">

    <h1 class="text-center mb-4">Mis datos</h1>

    @if(session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <form action="{{ route('mis-datos.actualizar') }}" method="POST">
         @csrf

        <div class="mb-3">
            <label>Nombre</label>
           <input type="text" name="nombre" class="form-control"
       value="{{ auth()->user()->nombre }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
       value="{{ auth()->user()->email }}">
        </div>
        <div class="mb-3">
    <label>Teléfono</label>
    <input type="text" name="telefono" class="form-control"
       value="{{ auth()->user()->telefono }}">
</div>

<div class="mb-3">
    <label>Dirección</label>
    <input type="text" name="direccion" class="form-control"
       value="{{ auth()->user()->direccion }}">
</div>
<div class="mb-3">
    <label>Ciudad</label>
   <input type="text" name="ciudad" class="form-control"
       value="{{ auth()->user()->ciudad }}">
</div>

        <button type="submit" class="btn btn-dark">
            Guardar cambios
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-dark"">
            Volver
        </a>
    </form>

</div>
@endsection