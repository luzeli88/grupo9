@extends('plantilla')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Mi Carrito</h1>

    @if(session('mensaje') && !str_contains(session('mensaje'), 'vacio'))
        <div class="alert alert-success text-center">{{ session('mensaje') }}</div>
    @endif

    @if($items->isEmpty())
        <p class="text-center">Tu carrito esta vacio.</p>
    @else
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Talle</th>
                    <th>Precio unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->producto->nombre }}</td>
                    <td>{{ $item->talle ?? '-' }}</td>
                    <td>${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('carrito.actualizar', $item->id) }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                            @csrf
                            <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" class="form-control" style="width: 80px;">
                            <button type="submit" class="btn btn-sm btn-dark">OK</button>
                        </form>
                    </td>
                    <td>${{ number_format($item->total, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">X</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end fw-bold">Total general:</td>
                    <td class="fw-bold">${{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('cliente') }}" class="btn btn-secondary px-5">Volver</a>
            <a href="{{ route('usuario.pago') }}" class="btn btn-dark px-5">Finalizar compra</a>
        </div>
    @endif

</div>
@endsection