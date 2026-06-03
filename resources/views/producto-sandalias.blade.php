@extends('plantilla')

@section('content')

<h1 class="text-center mb-4">👠 Sandalias</h1>

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
                <img src="{{ asset('img/sandalia1.webp') }}" class="card-img-top" style="height:250px; object-fit:cover;">
            @endif
            <div class="card-body text-center">
                <h5 class="card-title">{{ $producto->nombre }}</h5>
                <p class="card-text">${{ number_format($producto->precio_venta, 0, ',', '.') }}</p>

                @if($producto->stock > 0)
                    <!-- Producto con stock disponible -->
                    <p class="text-success fw-bold">✅ Stock: {{ $producto->stock }} unidades</p>
                    @auth
                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark w-100">🛒 Comprar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark w-100">Iniciar sesión para comprar</a>
                    @endauth
                @else
                    <!-- Producto sin stock -->
                    <p class="text-danger fw-bold">❌ Sin stock</p>
                    <p class="text-muted small mb-2">Déjanos tu correo y te avisaremos cuando vuelva a estar disponible.</p>
                    <form action="{{ route('notificacion.suscribirse', $producto->id) }}" method="POST" class="mb-0">
                        @csrf
                        <div class="input-group input-group-sm">
                            @auth
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                <button type="submit" class="btn btn-outline-primary btn-sm w-100">📧 Notificarme</button>
                            @else
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="tu@correo.com" required>
                                <button type="submit" class="btn btn-outline-primary btn-sm">Notificarme</button>
                            @endauth
                        </div>
                        @error('email')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </form>
                @endif
            </div>
        </div>
    </div>
    @empty
        <p class="text-center">No hay sandalias disponibles por el momento.</p>
    @endforelse
</div>

@endsection
