@extends('plantilla')

@section('content')
<div class="container mt-5">
    <h1>Panel del Cliente</h1>
    <p>Bienvenido, {{ Auth::user()->nombre ?? 'Cliente' }}. Esta es tu área personal.</p>
    <p>Aquí podrás ver tus datos y compras cuando el sistema lo implemente.</p>
</div>
@endsection
