
@extends('plantilla')
@section('content')
<h1>Consultas</h1>

<formaction="" method="POST">
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" class="form-control">
    </div>

    <button class="btn btn-primary">Enviar</button>
</form>

@endsection