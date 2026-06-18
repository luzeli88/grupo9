@extends('plantilla')

@section('content')
@php
    use App\Services\ConfiguracionService;
    $pcts = ConfiguracionService::obtenerPorcentajes();
    $pctDescuentoTransferencia = $pcts['descuento_transferencia'];
    $pctRecargo6               = $pcts['recargo_credito_6'];
    $pctRecargoMas6            = $pcts['recargo_credito_mas6'];

    $subtotal  = $pedido->subtotal > 0 ? $pedido->subtotal : $pedido->items->sum('total');
    $descuento = $pedido->descuento ?? 0;
    $recargo   = $pedido->recargo   ?? 0;

    $descripcionPago = match ($pedido->metodo_pago) {
        'transferencia' => "Transferencia bancaria - {$pctDescuentoTransferencia}% de descuento aplicado.",
        'credito' => $pedido->cuotas
            ? ($pedido->cuotas > 6
                ? "Tarjeta de crédito en {$pedido->cuotas} cuotas - {$pctRecargoMas6}% de recargo aplicado."
                : "Tarjeta de crédito en {$pedido->cuotas} cuotas sin interés.")
            : 'Tarjeta de crédito.',
        'debito'      => 'Tarjeta de débito - sin descuento ni recargo.',
        'mercadopago' => 'Mercado Pago - sin descuento ni recargo.',
        default       => ucfirst($pedido->metodo_pago),
    };
@endphp

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
                    <td>{{ ($item->producto->nombre ?? "Producto eliminado") }}</td>
                    <td>{{ $item->talle ?? '-' }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                    <td>${{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Subtotal:</td>
                    <td class="fw-bold">${{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                @if($descuento > 0)
                <tr class="table-success">
                    <td colspan="4" class="text-end fw-bold">Descuento:</td>
                    <td class="fw-bold">-${{ number_format($descuento, 0, ',', '.') }}</td>
                </tr>
                @endif
                @if($recargo > 0)
                <tr class="table-warning">
                    <td colspan="4" class="text-end fw-bold">Recargo:</td>
                    <td class="fw-bold">${{ number_format($recargo, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="4" class="text-end fw-bold">Total final:</td>
                    <td class="fw-bold">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <hr>

        <p><strong>Metodo de pago:</strong> {{ ucfirst($pedido->metodo_pago) }}</p>
        <p><strong>Detalle:</strong> {{ $descripcionPago }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>

        <div class="d-flex justify-content-center gap-3 mt-4">
    @if(auth()->user()->rol?->nombre === 'admin')
        <a href="{{ route('admin') }}" class="btn btn-dark px-5">Volver al Panel</a>
    @else
        <a href="{{ route('cliente') }}" class="btn btn-dark px-5">Volver al Panel</a>
    @endif
    <button onclick="window.print()" class="btn btn-secondary px-5">Imprimir factura</button>
</div>

    </div>

</div>
@endsection
