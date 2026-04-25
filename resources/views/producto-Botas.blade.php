@extends('plantilla')
@section('content')
<h1 class="text-center mb-4">👞 Botas</h1>

 @php
    $productos = [

        ['id'=>1,'nombre'=>'Bota','precio'=>60000,'imagen'=>'img/bota1.webp'],
        ['id'=>2,'nombre'=>'Bota','precio'=>55000,'imagen'=>'img/bota2.webp'],
        ['id'=>3,'nombre'=>'Bota','precio'=>40000,'imagen'=>'img/bota3.webp'],
        ['id'=>4,'nombre'=>'Bota','precio'=>30000,'imagen'=>'img/bota4.webp'],
        ['id'=>5,'nombre'=>'Bota','precio'=>35000,'imagen'=>'img/bota5.webp'],
        ['id'=>6,'nombre'=>'Bota','precio'=>40000,'imagen'=>'img/bota6.webp'],
        ['id'=>7,'nombre'=>'Bota','precio'=>40000,'imagen'=>'img/bota8.webp'],
        ['id'=>8,'nombre'=>'Bota','precio'=>35000,'imagen'=>'img/bota9.webp'],
        ['id'=>9,'nombre'=>'Bota','precio'=>50000,'imagen'=>'img/bota10.webp'],
    ];
    @endphp
@include('partials.productos', ['productos' => $productos])
@endsection 
