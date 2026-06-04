@extends('plantilla')

@section('content')
<div class="container my-5">

    <div class="card shadow-sm p-4">

        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('img/logo.png') }}" style="height: 80px;" class="mb-2">
                <h4 class="fw-bold mb-1">Step & Style</h4>
                <p class="mb-0">Av. Sta. Fe 438, Palermo, Ciudad de Buenos Aires</p>
                <p class="mb-0">Tel: +54 11 1234-5678</p>
                <p class="mb-0">Email: contacto@stepandstyle.com.ar</p>
                <p class="mb-0">CUIT: 30-xxxxxxxx-1</p>
            </div>
            <div class="col-md-6 text-end">
                <h2 class="fw-bold">Factura de compra</h2>
                <p class="mb-0"><strong>Numero:</strong> {{ $pedido->numero_factura }}</p>
                <p class="mb-0"><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <hr>

        <h5>Datos del cliente</h5>
        <p><strong>Nombre:</strong> {{ $pedido->usuario->nombre }}</p>
        <p><strong>Email:</strong> {{ $pedido->usuario->email }}</p>

        <hr>

        <h5>Detalle del pedido</h5>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Talle</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->items as $item)
                <tr>
                    <td>{{ $item->producto->nombre }}</td>
                    <td>{{ $item->talle ?? '-' }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                    <td>${{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Total pagado:</td>
                    <td class="fw-bold">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <hr>

        <p><strong>Metodo de pago:</strong> {{ ucfirst($pedido->metodo_pago) }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('cliente') }}" class="btn btn-dark px-5">Volver al inicio</a>
            <button onclick="window.print()" class="btn btn-secondary px-5">Imprimir factura</button>
        </div>

    </div>

</div>
@endsection