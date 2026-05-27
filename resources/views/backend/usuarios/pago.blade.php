@extends('plantilla')

@section('content')
<div class="container my-5">

    <h1 class="text-center mb-4">💳 Proceso de pago</h1>

    {{-- Resumen del carrito --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header table-dark text-white"><h5 class="mb-0">Resumen de tu pedido</h5></div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->producto->nombre }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>${{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-end fw-bold">Total a pagar:</td>
                        <td class="fw-bold">${{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Opciones de pago --}}
    <h4 class="mb-3">Seleccioná tu método de pago:</h4>

    <div class="row g-4">

        {{-- Tarjeta --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">💳 Tarjeta de crédito/débito</h5>
                    <form action="{{ route('pago.procesar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="metodo" value="tarjeta">
                        <div class="mb-3">
                            <label>Número de tarjeta</label>
                            <input type="text" name="numero_tarjeta" class="form-control" placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
                        </div>
                        <div class="mb-3">
                            <label>Nombre en la tarjeta</label>
                            <input type="text" name="nombre_tarjeta" class="form-control" placeholder="Como figura en la tarjeta">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Vencimiento</label>
                                <input type="text" name="vencimiento" class="form-control" placeholder="MM/AA">
                            </div>
                            <div class="col">
                                <label>CVV</label>
                                <input type="text" name="cvv" class="form-control" placeholder="XXX" maxlength="3">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 mt-3">Pagar con tarjeta</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Mercado Pago --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">💙 Mercado Pago</h5>
                    <p class="text-muted">Pagá con tu cuenta de Mercado Pago de forma rápida y segura.</p>
                    <form action="{{ route('pago.procesar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="metodo" value="mercadopago">
                        <button type="submit" class="btn btn-primary w-100 mt-3">Pagar con Mercado Pago</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Transferencia --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">🏦 Transferencia bancaria</h5>
                    <p class="text-muted">Realizá la transferencia a los siguientes datos:</p>
                    <ul class="list-unstyled">
                        <li><strong>Banco:</strong> Banco Nación</li>
                        <li><strong>CBU:</strong> 0110000000000000000000</li>
                        <li><strong>Alias:</strong> STEP.STYLE.PAGO</li>
                        <li><strong>Titular:</strong> Step & Style</li>
                    </ul>
                    <form action="{{ route('pago.procesar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="metodo" value="transferencia">
                        <div class="mb-3">
                            <label>Número de comprobante</label>
                            <input type="text" name="comprobante" class="form-control" placeholder="Ingresá el número de comprobante">
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Confirmar transferencia</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4">
        <a href="{{ route('carrito') }}" class="btn btn-secondary">← Volver al carrito</a>
    </div>

</div>

@endsection