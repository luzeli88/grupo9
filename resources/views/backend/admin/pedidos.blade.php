@extends('plantilla')

@section('content')
<div class="container my-5">

    <h1 class="text-center mb-4">Pedidos</h1>

    <a href="{{ route('admin') }}" class="btn btn-secondary mb-3">Volver</a>

    @if($pedidos->isEmpty())
        <p class="text-center">No hay pedidos registrados.</p>
    @else
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nro Factura</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Metodo de pago</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->numero_factura }}</td>
                    <td>{{ $pedido->usuario->nombre }}</td>
                    <td>${{ number_format($pedido->total, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($pedido->metodo_pago) }}</td>
                    <td>
                        <span class="badge {{ $pedido->estado == 'pendiente' ? 'bg-warning text-dark' : 'bg-success' }}">
                            {{ ucfirst($pedido->estado) }}
                        </span>
                    </td>
                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                   <td class="d-flex gap-1 justify-content-center">
                        <a href="{{ route('factura', $pedido->id) }}" class="btn btn-sm btn-dark">Ver factura</a>
                        @if($pedido->estado == 'pendiente')
                            <form action="{{ route('admin.pedidos.estado', $pedido->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="estado" value="enviado">
                                <button type="submit" class="btn btn-sm btn-success">Marcar enviado</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection

