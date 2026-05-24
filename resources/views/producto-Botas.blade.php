@extends('plantilla')

@section('content')

<h1 class="text-center mb-4">👢 Botas</h1>

@if(session('mensaje'))
    <div class="alert alert-success text-center">{{ session('mensaje') }}</div>
@endif

<div class="row g-4 px-4">
    @forelse($productos as $producto)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" style="height:250px; object-fit:cover;">
            @else
                <img src="{{ asset('img/bota1.webp') }}" class="card-img-top" style="height:250px; object-fit:cover;">
            @endif
            <div class="card-body text-center">
                <h5 class="card-title">{{ $producto->nombre }}</h5>
                <p class="card-text">${{ number_format($producto->precio_venta, 0, ',', '.') }}</p>

                @auth
                    <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark w-100">🛒 Comprar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark w-100">Iniciar sesión para comprar</a>
                @endauth
            </div>
        </div>
    </div>
    @empty
        <p class="text-center">No hay botas disponibles por el momento.</p>
    @endforelse
</div>

@endsection