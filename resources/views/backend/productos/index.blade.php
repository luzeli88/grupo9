@extends('plantilla')

@section('content')

<div class="container my-5">

    <h1 class="mb-4">Productos cargados</h1>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
<a href="{{ route('admin') }}" class="btn btn-secondary mb-3">← Volver al panel</a>
<a href="{{ route('productos.create') }}" class="btn btn-dark mb-3">+ Agregar producto</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio venta</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" width="60">
                    @else
                        Sin imagen
                    @endif
                </td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria }}</td>
                <td>${{ number_format($producto->precio_venta, 0, ',', '.') }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    @if($producto->deleted_at)
                        <span class="badge bg-danger">Inactivo</span>
                    @else
                        <span class="badge bg-success">Activo</span>
                    @endif
                </td>
                <td>
                    {{-- Editar --}}
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning">Editar</a>

                    {{-- Inactivar/Activar --}}
                    @if($producto->deleted_at)
                        <form action="{{ route('productos.restore', $producto->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Activar</button>
                        </form>
                    @else
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-secondary">Inactivar</button>
                        </form>
                    @endif

                    {{-- Eliminar permanente --}}
                    <form action="{{ route('productos.forceDelete', $producto->id) }}" method="POST" style="display:inline"
                          onsubmit="return confirm('¿Eliminar permanentemente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
