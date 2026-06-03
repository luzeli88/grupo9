@extends('plantilla')

@section('content')

<div class="d-flex justify-content-center align-items-center gap-3 mb-4">
    <h1 class="mb-0">Sandalias</h1>
    <a href="{{ route('cliente') }}" class="btn btn-dark">Volver</a>
</div>

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

                @auth
                    <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label fw-bold">Talle</label>
                            <select name="talle" class="form-select" required>
                                <option value="">Selecciona un talle</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Comprar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark w-100">Iniciar sesion para comprar</a>
                @endauth
            </div>
        </div>
    </div>
    @empty
        <p class="text-center">No hay sandalias disponibles por el momento.</p>
    @endforelse
</div>

@endsection

