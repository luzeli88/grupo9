@extends('plantilla')

@section('content')

<div class="container my-5">
    <h1 class="mb-4">Carrito de {{ $usuario->nombre }}</h1>

    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary mb-3">← Volver a usuarios</a>

    @if($items->count() > 0)
        <!-- Resumen del carrito del usuario -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header table-dark text-white">
                <h5 class="mb-0">Productos en carrito</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->producto->nombre }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                            <td>${{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total a pagar:</td>
                            <td class="fw-bold">${{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="alert alert-info">
            El usuario <strong>{{ $usuario->nombre }}</strong> tiene {{ $items->count() }} producto(s) en el carrito sin comprar aún.
        </div>
    @else
        <div class="alert alert-info">
            El usuario <strong>{{ $usuario->nombre }}</strong> no tiene productos en el carrito.
        </div>
    @endif
</div>

@endsection
