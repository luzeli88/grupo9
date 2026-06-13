@extends('plantilla')

@section('content')
<div class="container my-5">

    <h1 class="mb-1 fw-light">Configuración de pagos</h1>
    <p class="text-muted mb-4">Ajustá los porcentajes de descuento y recargo por método de pago</p>

    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <a href="{{ route('admin') }}" class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i> Volver al panel
    </a>

    <form method="POST" action="{{ route('admin.configuracion.guardar') }}">
        @csrf

        <div class="row g-4">

            {{-- TRANSFERENCIA --}}
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-dark text-white">
                        <i class="bi bi-bank me-2"></i>Transferencia bancaria
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Se aplica un descuento al pagar por transferencia.</p>
                        <label class="form-label fw-semibold">Descuento (%)</label>
                        <div class="input-group">
                            <input type="number"
                                   name="descuento_transferencia"
                                   class="form-control"
                                   value="{{ $configs['descuento_transferencia'] }}"
                                   min="0" max="100" step="0.1">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CRÉDITO HASTA 6 CUOTAS --}}
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-dark text-white">
                        <i class="bi bi-credit-card me-2"></i>Crédito hasta 6 cuotas
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Recargo para pagos en hasta 6 cuotas con tarjeta de crédito.</p>
                        <label class="form-label fw-semibold">Recargo (%)</label>
                        <div class="input-group">
                            <input type="number"
                                   name="recargo_credito_6"
                                   class="form-control"
                                   value="{{ $configs['recargo_credito_6'] }}"
                                   min="0" max="100" step="0.1">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CRÉDITO MÁS DE 6 CUOTAS --}}
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-dark text-white">
                        <i class="bi bi-credit-card-2-front me-2"></i>Crédito más de 6 cuotas
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Recargo para pagos en más de 6 cuotas con tarjeta de crédito.</p>
                        <label class="form-label fw-semibold">Recargo (%)</label>
                        <div class="input-group">
                            <input type="number"
                                   name="recargo_credito_mas6"
                                   class="form-control"
                                   value="{{ $configs['recargo_credito_mas6'] }}"
                                   min="0" max="100" step="0.1">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark px-5">
                <i class="bi bi-save me-2"></i>Guardar configuración
            </button>
        </div>

    </form>

</div>
@endsection