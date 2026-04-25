@extends('plantilla')
@section('content')
<h1 class="text-center mb-4">👠 Zapatos</h1>

 @php
    $productos = [
        ['id'=>1,'nombre'=>'Zapatos','precio'=>20000,'imagen'=>'img/zapato1.webp'],
        ['id'=>2,'nombre'=>'Zapatos','precio'=>35000,'imagen'=>'img/zapato9.webp'],
        ['id'=>3,'nombre'=>'Zapatos','precio'=>40000,'imagen'=>'img/zapato3.webp'],
        ['id'=>4,'nombre'=>'Zapatos','precio'=>20000,'imagen'=>'img/zapato4.webp'],
        ['id'=>5,'nombre'=>'Zapatos','precio'=>35000,'imagen'=>'img/zapato5.webp'],
        ['id'=>6,'nombre'=>'Zapatos','precio'=>40000,'imagen'=>'img/zapato6.webp'],
        ['id'=>7,'nombre'=>'Zapatos','precio'=>35000,'imagen'=>'img/zapato7.webp'],
        ['id'=>8,'nombre'=>'Zapatos','precio'=>40000,'imagen'=>'img/zapato8.webp'],
    ];
    @endphp
@include('partials.productos', ['productos' => $productos])
@endsection