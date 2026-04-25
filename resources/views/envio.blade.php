@extends('plantilla')
@section("content")
<div class="container mt-5">
    <!-- container: contenedor centrado con padding horizontal -->
    <div class="row align-items-start gy-4">
        <div class="col-lg-6">
            <!-- card principal con sombra suave y bordes redondeados -->
            <div class="card envio-card shadow-sm rounded-4 p-4 h-100">
                <h2 class="titulo mb-3">Medios de Envío</h2>
                <p class="text-muted mb-4">Seleccioná la opción de envío ideal para tu pedido, con información clara de tiempos y costos.</p>

                <div class="mb-4">
                    <h5 class="mb-2">Plazo de despacho</h5>
                    <p class="mb-0">Una vez acreditado el pago, el pedido se despacha dentro de <strong>3 días hábiles</strong>.</p>
                </div>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="shipping-card border rounded-4 p-3 h-100 bg-white shadow-sm">
                            <span class="badge bg-primary shipping-badge">Norte y Centro</span>
                            <p class="mb-1 mt-3"><strong>Envío a domicilio:</strong> $12.990</p>
                            <p class="mb-0"><strong>Envío a sucursal:</strong> $8.990</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="shipping-card border rounded-4 p-3 h-100 bg-white shadow-sm">
                            <span class="badge bg-success shipping-badge">Sur</span>
                            <p class="mb-1 mt-3"><strong>Envío a domicilio:</strong> $14.990</p>
                            <p class="mb-0"><strong>Envío a sucursal:</strong> $10.990</p>
                        </div>
                    </div>
                </div>

                <div class="envio-banner mt-4 rounded-4 p-3 text-center text-white">
                    ENVÍO GRATIS EN COMPRAS SUPERIORES A $149.990
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card envio-card shadow-sm rounded-4 p-4 h-100">
                <h4 class="mb-3">Modalidades de envío</h4>
                <p class="text-muted">Usamos correo o mensajería privada para que tu pedido llegue con seguridad y rápido.</p>

                <ul class="list-unstyled shipping-list mt-4">
                    <li class="d-flex align-items-start mb-3">
                        <span class="me-3"><i class="bi bi-truck fs-4 text-primary"></i></span>
                        <div>
                            <h5 class="mb-1">Envío a domicilio</h5>
                            <p class="mb-0 text-muted">Ideal si querés recibir tu pedido directamente en tu casa u oficina.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-3">
                        <span class="me-3"><i class="bi bi-shop fs-4 text-success"></i></span>
                        <div>
                            <h5 class="mb-1">Envío a sucursal</h5>
                            <p class="mb-0 text-muted">Retirá tu compra en la sucursal más cercana cuando te resulte cómodo.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start">
                        <span class="me-3"><i class="bi bi-clock-history fs-4 text-warning"></i></span>
                        <div>
                            <h5 class="mb-1">Plazo estimado</h5>
                            <p class="mb-0 text-muted">El tiempo total depende del procesamiento del pago y la distancia a tu destino.</p>
                        </div>
                    </li>
                </ul>

                <div class="mt-4 p-3 rounded-4 bg-light border border-dashed">
                    <h5 class="mb-2">Recomendación</h5>
                    <p class="mb-0 text-muted">Si necesitás el pedido rápido, elegí envío a domicilio. Si querés ahorrar, elegí retiro en sucursal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
