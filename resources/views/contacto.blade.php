
@extends('plantilla')
@section('content')
<h1>Consultas</h1>

<form action ="/contacto” method="POST"> 
  @csrf
  <input type="text" name="nombre" placeholder="Nombre">
  <input type="email" name="email" placeholder="Email">
  <textareaname="mensaje" class="form-control" rows="3"></textarea>
  <button type="submit">Enviar</button>
</form>

@endsection
