@extends('plantilla')

@section('content')
<div class="container my-5">
    <h1 class="mb-1 fw-light">Mi carrito de compras</h1>
    <p class="text-muted mb-4">Revisá tus productos antes de finalizar la compra</p>

    @include('mensaje')

    @if($items->isEmpty())
        <div class="alert alert-info text-center border-0 shadow-sm">
            <h5>Tu carrito está vacío</h5>
            <p>Explorá nuestros productos y agregá lo que te interese.</p>
            <a href="{{ route('categorias') }}" class="btn btn-dark">Ver productos</a>
        </div>
    @else
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-cart3 me-2"></i>Productos en tu carrito</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark" style="opacity:0.85">
                            <tr>
                                <th style="width:80px">Imagen</th>
                                <th>Producto</th>
                                <th class="text-center">Talle</th>
                                <th class="text-end">Precio unit.</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>
                                    @if($item->producto?->imagen)
                                        <img src="{{ asset(str_starts_with($item->producto->imagen, 'img/') ? $item->producto->imagen : 'storage/' . $item->producto->imagen) }}"
                                             width="55" height="55"
                                             class="rounded object-fit-cover">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                             style="width:55px;height:55px">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $item->producto?->nombre ?? 'Producto eliminado' }}</td>
                                <td class="text-center">
                                    @if($item->talle)
                                        <span class="badge text-bg-light border">{{ $item->talle }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-end">${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('carrito.actualizar', $item->id) }}" method="POST"
                                          class="d-flex justify-content-center align-items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="cantidad" value="{{ $item->cantidad }}"
                                               min="1" class="form-control form-control-sm" style="width:75px">
                                        <button type="submit" class="btn btn-sm btn-dark">OK</button>
                                    </form>
                                </td>
                                <td class="text-end fw-bold">${{ number_format($item->total, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('¿Eliminar producto?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr class="fw-bold">
                                <td colspan="5" class="text-end">Total a pagar:</td>
                                <td class="text-end fs-5">${{ number_format($total, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <a href="{{ route('cliente') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('usuario.pago') }}" class="btn btn-dark w-100">
                    <i class="bi bi-credit-card me-1"></i> Finalizar compra
                </a>
            </div>
        </div>
    @endif
</div>
@endsection