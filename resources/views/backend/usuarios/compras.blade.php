@extends('plantilla')

@section('content')
<div class="container my-5">

    <h1 class="mb-1 fw-light">Mis compras</h1>
    <p class="text-muted mb-4">Historial de todos tus pedidos</p>

    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('cliente') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver al panel
        </a>
    </div>

    {{-- FILTROS --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-semibold mb-3"><i class="bi bi-funnel me-2"></i>Filtros</h6>
            <form method="GET" action="{{ route('compras') }}">
                <div class="row g-2">

                    {{-- Método de pago --}}
                    <div class="col-6 col-md-3">
                        <select name="metodo_pago" class="form-select form-select-sm">
                            <option value="">Todos los métodos</option>
                            <option value="debito"        {{ request('metodo_pago') === 'debito'        ? 'selected' : '' }}>Débito</option>
                            <option value="credito"       {{ request('metodo_pago') === 'credito'       ? 'selected' : '' }}>Crédito</option>
                            <option value="transferencia" {{ request('metodo_pago') === 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                            <option value="mercadopago"   {{ request('metodo_pago') === 'mercadopago'   ? 'selected' : '' }}>MercadoPago</option>
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

                    {{-- Fecha desde --}}
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="fecha_desde"
                                   class="form-control form-control-sm"
                                   value="{{ request('fecha_desde') }}">
                        </div>
                    </div>

                    {{-- Fecha hasta --}}
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="fecha_hasta"
                                   class="form-control form-control-sm"
                                   value="{{ request('fecha_hasta') }}">
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="col-12 col-md-2 d-flex gap-1">
                        <button type="submit" class="btn btn-dark btn-sm w-100">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('compras') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>

                </div>

                {{-- Contador --}}
                <div class="mt-2">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Mostrando <strong>{{ $pedidos->count() }}</strong> pedido(s)
                        @if($pedidos->isNotEmpty())
                            — Total gastado: <strong>${{ number_format($pedidos->sum('total'), 0, ',', '.') }}</strong>
                        @endif
                    </small>
                </div>

            </form>
        </div>
    </div>

    {{-- TABLA — desktop --}}
    <div class="d-none d-xl-block">
        @forelse($pedidos as $pedido)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-receipt me-2"></i>
                        <strong>{{ $pedido->numero_factura }}</strong>
                        <span class="ms-3 small opacity-75">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        @if($pedido->estado === 'pendiente')
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @else
                            <span class="badge bg-success">Finalizado</span>
                        @endif
                        <strong>${{ number_format($pedido->total, 0, ',', '.') }}</strong>
                    </div>
                </div>

                <div class="card-body">
                    {{-- INFO PAGO --}}
                    <div class="row g-2 mb-3 small">
                        <div class="col-md-3">
                            <span class="text-muted">Método de pago:</span>
                            @php
                                $iconos = [
                                    'debito'        => 'bi-credit-card',
                                    'credito'       => 'bi-credit-card-2-front',
                                    'transferencia' => 'bi-bank',
                                    'mercadopago'   => 'bi-phone',
                                ];
                            @endphp
                            <i class="bi {{ $iconos[$pedido->metodo_pago] ?? 'bi-cash' }} ms-1"></i>
                            {{ ucfirst($pedido->metodo_pago) }}
                        </div>
                        <div class="col-md-3">
                            <span class="text-muted">Cuotas:</span>
                            {{ $pedido->cuotas > 1 ? $pedido->cuotas . ' cuotas' : 'Contado' }}
                        </div>
                        @if($pedido->descuento > 0)
                            <div class="col-md-3">
                                <span class="text-muted">Descuento:</span>
                                ${{ number_format($pedido->descuento, 0, ',', '.') }}
                            </div>
                        @endif
                        @if($pedido->recargo > 0)
                            <div class="col-md-3">
                                <span class="text-muted">Recargo:</span>
                                ${{ number_format($pedido->recargo, 0, ',', '.') }}
                            </div>
                        @endif
                    </div>

                    {{-- PRODUCTOS --}}
                    <table class="table table-sm table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th>Talle</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio unit.</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->items as $item)
                                <tr>
                                    <td>
                                        @if($item->producto?->imagen)
                                            <img src="{{ asset('storage/' . $item->producto->imagen) }}"
                                                 width="40" height="40"
                                                 class="rounded object-fit-cover me-2">
                                        @endif
                                        {{ $item->producto?->nombre ?? 'Producto eliminado' }}
                                    </td>
                                    <td>{{ $item->talle ?? '-' }}</td>
                                    <td class="text-center">{{ $item->cantidad }}</td>
                                    <td class="text-end">${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                                    <td class="text-end fw-semibold">${{ number_format($item->total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total</td>
                                <td class="text-end fw-bold">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    {{-- FACTURA --}}
                    <div class="mt-3">
                        <a href="{{ route('factura', $pedido->id) }}" class="btn btn-sm btn-dark">
                            <i class="bi bi-receipt me-1"></i>Ver factura completa
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                <i class="bi bi-bag-x me-2"></i>
                Todavía no realizaste ninguna compra.
            </div>
        @endforelse
    </div>

    {{-- CARDS — mobile y tablet --}}
    <div class="d-xl-none">
        @forelse($pedidos as $pedido)
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-receipt me-1"></i>
                            <strong>{{ $pedido->numero_factura }}</strong>
                        </div>
                        @if($pedido->estado === 'pendiente')
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @else
                            <span class="badge bg-success">Finalizado</span>
                        @endif
                    </div>
                    <small class="opacity-75">{{ $pedido->created_at->format('d/m/Y H:i') }}</small>
                </div>

                <div class="card-body">
                    {{-- INFO --}}
                    <div class="row g-1 small mb-3">
                        <div class="col-6">
                            <span class="text-muted">Método:</span>
                            {{ ucfirst($pedido->metodo_pago) }}
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Cuotas:</span>
                            {{ $pedido->cuotas > 1 ? $pedido->cuotas . ' cuotas' : 'Contado' }}
                        </div>
                        @if($pedido->descuento > 0)
                            <div class="col-6">
                                <span class="text-muted">Descuento:</span>
                                ${{ number_format($pedido->descuento, 0, ',', '.') }}
                            </div>
                        @endif
                        @if($pedido->recargo > 0)
                            <div class="col-6">
                                <span class="text-muted">Recargo:</span>
                                ${{ number_format($pedido->recargo, 0, ',', '.') }}
                            </div>
                        @endif
                        <div class="col-12 mt-1">
                            <span class="text-muted">Total:</span>
                            <strong>${{ number_format($pedido->total, 0, ',', '.') }}</strong>
                        </div>
                    </div>

                    {{-- PRODUCTOS --}}
                    <div class="mb-3">
                        <small class="fw-semibold text-muted d-block mb-2">Productos</small>
                        @foreach($pedido->items as $item)
                            <div class="d-flex justify-content-between align-items-center py-1 border-bottom small">
                                <div>
                                    {{ $item->producto?->nombre ?? 'Producto eliminado' }}
                                    @if($item->talle)
                                        <span class="badge text-bg-light border ms-1">T{{ $item->talle }}</span>
                                    @endif
                                </div>
                                <div class="text-end">
                                    <span class="text-muted">x{{ $item->cantidad }}</span>
                                    <strong class="ms-2">${{ number_format($item->total, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- FACTURA --}}
                    <a href="{{ route('factura', $pedido->id) }}" class="btn btn-sm btn-dark w-100">
                        <i class="bi bi-receipt me-1"></i>Ver factura completa
                    </a>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                <i class="bi bi-bag-x me-2"></i>
                Todavía no realizaste ninguna compra.
            </div>
        @endforelse
    </div>

</div>
@endsection