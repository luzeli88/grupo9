@extends('plantilla')

@section('content')
<div class="container my-5">

    <h1 class="mb-1 fw-light">Gestión de Pedidos</h1>
    <p class="text-muted mb-4">Administrá y filtrá todos los pedidos de la tienda</p>

    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ACCIONES --}}
    <div class="mb-4">
        <a href="{{ route('admin') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver al panel
        </a>
    </div>

    {{-- FILTROS --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-semibold mb-3"><i class="bi bi-funnel me-2"></i>Filtros</h6>
            <form method="GET" action="{{ route('admin.pedidos.index') }}">
                <div class="row g-2">

                    {{-- Buscar cliente --}}
                    <div class="col-12 col-md-3">
                        <input type="text"
                               name="buscar"
                               class="form-control form-control-sm"
                               placeholder="Buscar por cliente..."
                               value="{{ request('buscar') }}">
                    </div>

                    {{-- Método de pago --}}
                    <div class="col-6 col-md-2">
                        <select name="metodo_pago" class="form-select form-select-sm">
                            <option value="">Todos los métodos</option>
                            <option value="debito"       {{ request('metodo_pago') === 'debito'       ? 'selected' : '' }}>Débito</option>
                            <option value="credito"      {{ request('metodo_pago') === 'credito'      ? 'selected' : '' }}>Crédito</option>
                            <option value="transferencia"{{ request('metodo_pago') === 'transferencia'? 'selected' : '' }}>Transferencia</option>
                            <option value="mercadopago"  {{ request('metodo_pago') === 'mercadopago'  ? 'selected' : '' }}>MercadoPago</option>
                        </select>
                    </div>

                    {{-- Estado --}}
                    <div class="col-6 col-md-2">
                        <select name="estado" class="form-select form-select-sm">
                            <option value="">Todos los estados</option>
                            <option value="pendiente"  {{ request('estado') === 'pendiente'  ? 'selected' : '' }}>Pendiente</option>
                            <option value="finalizado" {{ request('estado') === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="col-12 col-md-1 d-flex gap-1">
                        <button type="submit" class="btn btn-dark btn-sm w-100">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('admin.pedidos.index') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>

                </div>

                {{-- Segunda fila: fechas y totales --}}
                <div class="row g-2 mt-1">

                    {{-- Fecha desde --}}
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date"
                                   name="fecha_desde"
                                   class="form-control form-control-sm"
                                   value="{{ request('fecha_desde') }}">
                        </div>
                    </div>

                    {{-- Fecha hasta --}}
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date"
                                   name="fecha_hasta"
                                   class="form-control form-control-sm"
                                   value="{{ request('fecha_hasta') }}">
                        </div>
                    </div>

                    {{-- Total mín --}}
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                   name="total_min"
                                   class="form-control form-control-sm"
                                   placeholder="Total mín"
                                   value="{{ request('total_min') }}">
                        </div>
                    </div>

                    {{-- Total máx --}}
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                   name="total_max"
                                   class="form-control form-control-sm"
                                   placeholder="Total máx"
                                   value="{{ request('total_max') }}">
                        </div>
                    </div>

                    {{-- Contador --}}
                    <div class="col-12 col-md-4 d-flex align-items-center">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Mostrando <strong>{{ $pedidos->count() }}</strong> pedido(s)
                            @if($pedidos->isNotEmpty())
                                — Total: <strong>${{ number_format($pedidos->sum('total'), 0, ',', '.') }}</strong>
                            @endif
                        </small>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- TABLA — desktop --}}
    <div class="d-none d-xl-block">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nro Factura</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Método de pago</th>
                    <th>Cuotas</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedidos as $pedido)
                <tr>
                    <td class="fw-semibold">{{ $pedido->numero_factura }}</td>
                    <td>{{ $pedido->usuario->nombre }}</td>
                    <td class="fw-bold">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                    <td>
                        @php
                            $iconos = [
                                'debito'        => 'bi-credit-card',
                                'credito'       => 'bi-credit-card-2-front',
                                'transferencia' => 'bi-bank',
                                'mercadopago'   => 'bi-phone',
                            ];
                            $icono = $iconos[$pedido->metodo_pago] ?? 'bi-cash';
                        @endphp
                        <i class="bi {{ $icono }} me-1"></i>
                        {{ ucfirst($pedido->metodo_pago) }}
                    </td>
                    <td>
                        @if($pedido->cuotas > 1)
                            {{ $pedido->cuotas }} cuotas
                        @else
                            Contado
                        @endif
                    </td>
                    <td>
                        @if($pedido->estado === 'pendiente')
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @else
                            <span class="badge bg-success">Finalizado</span>
                        @endif
                    </td>
                    <td class="small">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('factura', $pedido->id) }}"
                               class="btn btn-sm btn-dark">
                                <i class="bi bi-receipt me-1"></i>Factura
                            </a>
                            @if($pedido->estado === 'pendiente')
                                <form action="{{ route('admin.pedidos.estado', $pedido->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="estado" value="finalizado">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-check-lg me-1"></i>Finalizar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="bi bi-search me-2"></i>
                            No se encontraron pedidos con ese criterio.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- CARDS — mobile y tablet --}}
    <div class="d-xl-none">
        @forelse($pedidos as $pedido)
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body">

                    {{-- CABECERA --}}
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="fw-bold mb-0">{{ $pedido->numero_factura }}</h6>
                            <small class="text-muted">{{ $pedido->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        @if($pedido->estado === 'pendiente')
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @else
                            <span class="badge bg-success">Finalizado</span>
                        @endif
                    </div>

                    <hr class="my-2">

                    {{-- DATOS --}}
                    <div class="row g-1 small mb-3">
                        <div class="col-6">
                            <span class="text-muted">Cliente:</span>
                            <strong>{{ $pedido->usuario->nombre }}</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Total:</span>
                            <strong>${{ number_format($pedido->total, 0, ',', '.') }}</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Método:</span>
                            {{ ucfirst($pedido->metodo_pago) }}
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Cuotas:</span>
                            {{ $pedido->cuotas > 1 ? $pedido->cuotas . ' cuotas' : 'Contado' }}
                        </div>
                    </div>

                    {{-- ACCIONES --}}
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('factura', $pedido->id) }}"
                           class="btn btn-sm btn-dark">
                            <i class="bi bi-receipt me-1"></i>Ver factura
                        </a>
                        @if($pedido->estado === 'pendiente')
                            <form action="{{ route('admin.pedidos.estado', $pedido->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="estado" value="finalizado">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-check-lg me-1"></i>Finalizar
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                <i class="bi bi-search me-2"></i>
                No se encontraron pedidos con ese criterio.
            </div>
        @endforelse
    </div>

</div>
@endsection