@extends('plantilla')

@section('content')

<div class="d-flex justify-content-center align-items-center gap-3 mb-4">
    <h1 class="mb-0">Botas</h1>
    <a href="{{ route('cliente') }}" class="btn btn-dark">Volver</a>
</div>

@include('mensaje')

<div class="row g-4 px-4">
    @forelse($productos as $producto)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" style="height:250px; object-fit:contain; background:#f8f8f8;">
            @else
                <img src="{{ asset('img/bota1.webp') }}" class="card-img-top" style="height:250px; object-fit:contain; background:#f8f8f8;">
            @endif
            <div class="card-body text-center">
                <h5 class="card-title">{{ $producto->nombre }}</h5>
                <p class="card-text">${{ number_format($producto->precio_venta, 0, ',', '.') }}</p>

                @auth
                    @if($producto->stock > 0)
                        <p class="text-success fw-bold">✅ Stock: {{ $producto->stock }} unidades</p>
                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label fw-bold">Talle</label>
                                <select name="talle" class="form-select" required>
                                    <option value="">Seleccioná un talle</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">🛒 Comprar</button>
                        </form>
                    @else
                        <p class="text-danger fw-bold">❌ Sin stock</p>
                        <p class="text-muted small mb-2">Te avisaremos cuando vuelva a estar disponible.</p>
                        <form action="{{ route('notificacion.suscribirse', $producto->id) }}" method="POST" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm w-100">📧 Notificarme</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark w-100 mb-2">Iniciar sesión para comprar</a>
                    @if($producto->stock === 0)
                        <p class="text-danger fw-bold">❌ Sin stock</p>
                        <p class="text-muted small mb-2">Iniciá sesión para recibir una notificación cuando vuelva a estar disponible.</p>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100">📧 Notificarme</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    @empty
        <p class="text-center">No hay botas disponibles por el momento.</p>
    @endforelse
</div>

@endsection