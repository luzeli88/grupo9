@extends('plantilla')
@section('content')
<h1 class="text-center mb-4">👠 Sandalias</h1>

 @php
    $productos = [
        ['id'=>1,'nombre'=>'Sandalia','precio'=>20000,'imagen'=>'img/sandalia1.webp'],
        ['id'=>2,'nombre'=>'Sandalia','precio'=>35000,'imagen'=>'img/sandalia2.webp'],
        ['id'=>3,'nombre'=>'Sandalia','precio'=>40000,'imagen'=>'img/sandalia3.webp'],
        ['id'=>4,'nombre'=>'Sandalia','precio'=>20000,'imagen'=>'img/sandalia4.webp'],
        ['id'=>5,'nombre'=>'Sandalia','precio'=>35000,'imagen'=>'img/sandalia5.webp'],
        ['id'=>6,'nombre'=>'Sandalia','precio'=>40000,'imagen'=>'img/sandalia6.webp'],
        ['id'=>7,'nombre'=>'Sandalia','precio'=>35000,'imagen'=>'img/sandalia7.webp'],
        ['id'=>8,'nombre'=>'Sandalia','precio'=>40000,'imagen'=>'img/sandalia8.webp'],
    ];
    @endphp
@include('partials.productos', ['productos' => $productos])
@endsection 