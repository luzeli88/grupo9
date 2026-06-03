@extends('plantilla')

@section('content')

<div class="container my-5">
    <h1 class="mb-4">🛒 Mi carrito de compras</h1>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($items->count() > 0)
        <!-- Tabla de productos en el carrito -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header table-dark text-white">
                <h5 class="mb-0">Productos en tu carrito</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio Unitario</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->producto->nombre }}</strong><br>
                                    <small class="text-muted">{{ $item->producto->descripcion ?? 'Sin descripción' }}</small>
                                </td>
                                <td class="text-center">
                                    {{ $item->cantidad }}
                                </td>
                                <td class="text-end">
                                    ${{ number_format($item->precio_unitario, 0, ',', '.') }}
                                </td>
                                <td class="text-end fw-bold">
                                    ${{ number_format($item->total, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-light fw-bold">
                                <td colspan="3" class="text-end">TOTAL A PAGAR:</td>
                                <td class="text-end" style="font-size: 1.2em;">
                                    ${{ number_format($total, 0, ',', '.') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Opciones de acción -->
        <div class="row g-3">
            <div class="col-md-6">
                <a href="{{ route('sandalias') }}" class="btn btn-outline-secondary w-100">
                    ← Seguir comprando
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('pago') }}" class="btn btn-dark w-100">
                    💳 Proceder al pago →
                </a>
            </div>
        </div>

    @else
        <!-- Carrito vacío -->
        <div class="alert alert-info text-center">
            <h5>Tu carrito está vacío</h5>
            <p>Explora nuestros productos y agrega lo que te interese.</p>
            <a href="{{ route('sandalias') }}" class="btn btn-dark">
                Ver productos disponibles
            </a>
        </div>
    @endif

</div>

@endsection
