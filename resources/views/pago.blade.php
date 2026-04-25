@extends('plantilla')
@section('content')
<div class="container my-5">
    <div class="payment-card rounded-4 shadow-sm p-4">
        <h2 class="titulo mb-4">Formas de pago</h2>
        <p class="text-muted mb-4">Pagá de forma segura con las alternativas más usadas en Argentina, siempre protegidas por nuestra pasarela.</p>
        <ul class="payment-list list-unstyled mb-4">
            <li><i class="bi bi-credit-card-fill text-primary me-2"></i>Tarjetas de crédito y débito</li>
            <li><i class="bi bi-bank2 text-success me-2"></i>Transferencia bancaria</li>
            <li><i class="bi bi-wallet2 text-warning me-2"></i>Mercado Pago</li>
            <li><i class="bi bi-cash-stack text-dark me-2"></i>Pago en efectivo en puntos habilitados</li>
        </ul>
        <div class="payment-note rounded-4 p-3 bg-light border">
            <p class="mb-0">Todas las transacciones están protegidas y se procesan por plataformas seguras. Si necesitás ayuda con el pago, escribinos a nuestro contacto.</p>
        </div>
    </div>
</div>
@endsection