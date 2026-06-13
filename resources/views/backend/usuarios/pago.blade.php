@extends('plantilla')

@section('content')
<style>
    .payment-card .card-body {
        min-height: 100%;
    }

    .payment-card form {
        display: flex;
        flex-direction: column;
    }

    .payment-submit {
        margin-top: auto;
    }

    .payment-card .tab-content,
    .payment-card .tab-pane {
        flex: 1;
    }
</style>

<div class="container my-5">

    <h1 class="text-center mb-4">Proceso de pago</h1>

    @include('mensaje')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="alert alert-info text-center">
    <strong>Promociones vigentes</strong><br>
    💰 Transferencia bancaria: {{ $descuentoTransferencia }}% de descuento<br>
    💳 Crédito hasta 6 cuotas:
        @if($recargoCreditoHasta6 > 0)
            {{ $recargoCreditoHasta6 }}% de recargo
        @else
            sin interés
        @endif
    <br>
    💳 Crédito más de 6 cuotas: {{ $recargoCreditoMas6 }}% de recargo
</div>

    <div class="row g-4">

        <!-- TARJETA -->
        <div class="col-md-4">
            <div class="card payment-card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">

                    <h5 class="card-title">Tarjeta</h5>

                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active"
                                    data-bs-toggle="tab"
                                    data-bs-target="#debito"
                                    type="button"
                                    role="tab">
                                Débito
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#credito"
                                    type="button"
                                    role="tab">
                                Crédito
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content d-flex flex-column">
                        <div class="tab-pane fade show active" id="debito" role="tabpanel">
                            <form action="{{ route('pago.procesar') }}" method="POST" class="h-100">
                                @csrf
                                <input type="hidden" name="metodo" value="debito">

                                @include('backend.usuarios.partials.campos-tarjeta')

                                <button type="submit" class="btn btn-dark w-100 payment-submit">
                                    Pagar con débito
                                </button>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="credito" role="tabpanel">
                            <form action="{{ route('pago.procesar') }}" method="POST" class="h-100">
                                @csrf
                                <input type="hidden" name="metodo" value="credito">

                                <div class="mb-3">
                                    <label class="form-label">Cuotas</label>
                                    <select name="cuotas" class="form-select" required>
                                        <option value="3">3 cuotas
                                        @if($recargoCreditoHasta6 > 0)(+{{ $recargoCreditoHasta6 }}%)@endif
                                        </option>
                                        <option value="6">6 cuotas
                                            @if($recargoCreditoHasta6 > 0)(+{{ $recargoCreditoHasta6 }}%)@endif
                                        </option>
                                        <option value="9">9 cuotas (+{{ $recargoCreditoMas6 }}%)</option>
                                        <option value="12">12 cuotas (+{{ $recargoCreditoMas6 }}%)</option>
                                    </select>
                                </div>

                                @include('backend.usuarios.partials.campos-tarjeta')

                                <button type="submit" class="btn btn-dark w-100 payment-submit">
                                    Pagar con crédito
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- MERCADO PAGO -->
        <div class="col-md-4">
            <div class="card payment-card h-100 shadow-sm">
                <div class="card-body text-center d-flex flex-column">

                    <h5 class="card-title">Mercado Pago</h5>

                    <p class="text-muted">Ingresá el número de operación para confirmar el pago.</p>

                    <form action="{{ route('pago.procesar') }}" method="POST" class="h-100">
                        @csrf

                        <input type="hidden" name="metodo" value="mercadopago">

                        <div class="mb-3 text-start">
                            <label class="form-label">Número de operación</label>
                            <input type="text"
                                   name="comprobante"
                                   class="form-control"
                                   value="{{ old('comprobante') }}"
                                   inputmode="numeric"
                                   pattern="[0-9]{6}"
                                   minlength="6"
                                   maxlength="6"
                                   placeholder="6 números"
                                   title="Ingresá 6 números"
                                   required>
                            <div class="form-text">Debe tener 6 números.</div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 payment-submit">
                            Pagar con Mercado Pago
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <!-- TRANSFERENCIA -->
        <div class="col-md-4">
            <div class="card payment-card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">

                    <h5 class="card-title">Transferencia bancaria</h5>

                    <div class="alert alert-success">
                    💰 {{ $descuentoTransferencia }}% de descuento por transferencia
                    </div>

                    <ul class="list-unstyled">
                        <li><strong>Banco:</strong> Banco Nación</li>
                        <li><strong>CBU:</strong> 0110000000000000000000</li>
                        <li><strong>Alias:</strong> STEP.STYLE.PAGO</li>
                        <li><strong>Titular:</strong> Step & Style</li>
                    </ul>

                    <form action="{{ route('pago.procesar') }}" method="POST" class="h-100">
                        @csrf

                        <input type="hidden"
                               name="metodo"
                               value="transferencia">

                        <div class="mb-3">
                            <label class="form-label">
                                Número de operación
                            </label>

                            <input type="text"
                                   name="comprobante"
                                   class="form-control"
                                   value="{{ old('comprobante') }}"
                                   inputmode="numeric"
                                   pattern="[0-9]{6}"
                                   minlength="6"
                                   maxlength="6"
                                   placeholder="6 números"
                                   title="Ingresá 6 números"
                                   required>
                            <div class="form-text">Debe tener 6 números.</div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 payment-submit">
                            Confirmar transferencia
                        </button>

                    </form>

                </div>
            </div>
        </div>

    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('carrito') }}"
           class="btn btn-secondary px-5">
            Volver al carrito
        </a>
    </div>

</div>

<script>
    document.querySelectorAll('.vencimiento-tarjeta').forEach((input) => {
        input.addEventListener('input', () => {
            let valor = input.value.replace(/\D/g, '').slice(0, 4);

            if (valor.length >= 3) {
                valor = valor.slice(0, 2) + '/' + valor.slice(2);
            }

            input.value = valor;
        });
    });

</script>
@endsection
