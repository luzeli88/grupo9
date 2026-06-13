@extends('plantilla')

@section('content')
<div class="container my-5">

    <h1 class="mb-1 fw-light">Carrito de {{ $usuario->nombre }}</h1>
    <p class="text-muted mb-4">Productos pendientes de compra</p>

    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i> Volver a usuarios
    </a>

    @if($items->count() > 0)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-cart3 me-2"></i>Productos en carrito</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark" style="opacity: 0.85">
                        <tr>
                            <th style="width:80px">Imagen</th>
                            <th>Producto</th>
                            <th>Talle</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-end">Precio unit.</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>
                                @if($item->producto?->imagen)
                                    <img src="{{ asset(str_starts_with($item->producto->imagen, 'img/') ? $item->producto->imagen : 'storage/' . $item->producto->imagen) }}"
                                         width="55" height="55"
                                         class="rounded object-fit-cover">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                         style="width:55px;height:55px">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $item->producto?->nombre ?? 'Producto eliminado' }}</td>
                            <td>
                                @if($item->talle)
                                    <span class="badge text-bg-light border">{{ $item->talle }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">{{ $item->cantidad }}</td>
                            <td class="text-end">${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                            <td class="text-end fw-bold">${{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="5" class="text-end fw-bold">Total a pagar:</td>
                            <td class="text-end fw-bold">${{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="alert alert-info border-0 shadow-sm">
            <i class="bi bi-info-circle me-2"></i>
            El usuario <strong>{{ $usuario->nombre }}</strong> tiene
            <strong>{{ $items->count() }}</strong> producto(s) en el carrito sin comprar aún.
        </div>

    @else
        <div class="alert alert-info border-0 shadow-sm">
            <i class="bi bi-cart-x me-2"></i>
            El usuario <strong>{{ $usuario->nombre }}</strong> no tiene productos en el carrito.
        </div>
    @endif

</div>
@endsection