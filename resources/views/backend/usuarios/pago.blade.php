@extends('plantilla')

@section('content')
<div class="container my-5">

    <h1 class="text-center mb-4">Proceso de pago</h1>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tarjeta de credito/debito</h5>
                    <form action="{{ route('pago.procesar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="metodo" value="tarjeta">
                        <div class="mb-3">
                            <label class="form-label">Numero de tarjeta</label>
                            <input type="text" name="numero_tarjeta" class="form-control" placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre en la tarjeta</label>
                            <input type="text" name="nombre_tarjeta" class="form-control" placeholder="Como figura en la tarjeta">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Vencimiento</label>
                                <input type="text" name="vencimiento" class="form-control" placeholder="MM/AA">
                            </div>
                            <div class="col">
                                <label class="form-label">CVV</label>
                                <input type="text" name="cvv" class="form-control" placeholder="XXX" maxlength="3">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 mt-3">Pagar con tarjeta</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Mercado Pago</h5>
                    <p class="text-muted">Paga con tu cuenta de Mercado Pago de forma rapida y segura.</p>
                    <a href="https://www.mercadopago.com.ar" target="_blank" class="btn btn-primary w-100 mt-3">
                        Pagar con Mercado Pago
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Transferencia bancaria</h5>
                    <p class="text-muted">Realiza la transferencia a los siguientes datos:</p>
                    <ul class="list-unstyled mb-3">
                        <li><strong>Banco:</strong> Banco Nacion</li>
                        <li><strong>CBU:</strong> 0110000000000000000000</li>
                        <li><strong>Alias:</strong> STEP.STYLE.PAGO</li>
                        <li><strong>Titular:</strong> Step & Style</li>
                    </ul>
                    <form action="{{ route('pago.procesar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="metodo" value="transferencia">
                        <div class="mb-3">
                            <label class="form-label">Numero de comprobante</label>
                            <input type="text" name="comprobante" class="form-control" placeholder="Ingresa el numero de comprobante">
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Confirmar transferencia</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('carrito') }}" class="btn btn-secondary px-5">Volver al carrito</a>
    </div>

</div>
@endsection
