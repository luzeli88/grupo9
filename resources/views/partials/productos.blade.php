
<div class="row g-4">
    @forelse($productos as $producto)
        @php
            $talles = $producto->talles ?? collect();
            $stockTotal = $talles->isNotEmpty() ? $talles->sum('stock') : $producto->stock;
            $tallesDisponibles = $talles->where('stock', '>', 0);
        @endphp

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 producto-card">
                <div class="ratio ratio-4x3 bg-light">
                    @if($producto->imagen)
                    <img src="{{ asset(str_starts_with($producto->imagen, 'img/') 
                    ? $producto->imagen : 'storage/' . $producto->imagen) }}"
                             class="card-img-top object-fit-contain p-3"
                             alt="{{ $producto->nombre }}">
                    @else
                        <img src="{{ asset('img/default.webp') }}"
                             class="card-img-top object-fit-contain p-3"
                             alt="{{ $producto->nombre }}">
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                        <h5 class="card-title mb-0 text-start">{{ $producto->nombre }}</h5>

                        @if($talles->isEmpty())
                             @if($stockTotal > 0)
                                 <span class="badge text-bg-success">Stock {{ $stockTotal }}</span>
                             @else
                                 <span class="badge text-bg-secondary">Sin stock</span>
                            @endif
                        @endif
                    </div>

                    @if($producto->descripcion)
                        <p class="card-text text-muted small mb-3">
                            {{ \Illuminate\Support\Str::limit($producto->descripcion, 90) }}
                        </p>
                    @endif

                    <p class="fs-5 fw-bold mb-3">
                        ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                    </p>


                    <div class="mt-auto">
                        @auth
                            @if($stockTotal > 0 && $tallesDisponibles->isNotEmpty())
                                <button type="button"
                                        class="btn btn-dark w-100"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalTalle{{ $producto->id }}">
                                    Comprar
                                </button>
                            @else
                                <form action="{{ route('notificacion.suscribirse', $producto->id) }}"
                                      method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-dark w-100">
                                        Avisarme cuando haya stock
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-dark w-100">
                                Iniciar sesión para comprar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        @auth
            @if($stockTotal > 0 && $tallesDisponibles->isNotEmpty())
                <div class="modal fade"
                     id="modalTalle{{ $producto->id }}"
                     tabindex="-1"
                     aria-labelledby="modalTalleLabel{{ $producto->id }}"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTalleLabel{{ $producto->id }}">
                                    Elegí talle para {{ $producto->nombre }}
                                </h5>
                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Cerrar"></button>
                            </div>

                            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                                @csrf

                                <div class="modal-body">
                                    <label class="form-label fw-semibold">Talle</label>
                                    <select name="talle" class="form-select" required>
                                        <option value="">Seleccioná un talle</option>
                                        @foreach($talles->sortBy('talle') as $productoTalle)
                                            <option value="{{ $productoTalle->talle }}"
                                                    @disabled($productoTalle->stock <= 0)>
                                                Talle {{ $productoTalle->talle }}
                                                @if($productoTalle->stock > 0)
                                                    - {{ $productoTalle->stock }} disponible(s)
                                                @else
                                                    - sin stock
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-dark">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center mb-0">
                No hay productos disponibles por el momento.
            </div>
        </div>
    @endforelse
</div>