@extends('plantilla')

@section('content')

<div class="container my-5">
    <h1 class="mb-4">Clientes</h1>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <a href="{{ route('admin') }}" class="btn btn-secondary mb-3">← Volver al panel</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Carrito</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->telefono ?? '-' }}</td>
                <td>{{ $usuario->ciudad ?? '-' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.usuarios.rol', $usuario->id) }}">
                        @csrf
                        <div class="input-group input-group-sm">
                            <select name="rol_id" class="form-select form-select-sm">
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ $usuario->rol_id === $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Guardar</button>
                        </div>
                    </form>
                </td>
                <td>
                    @if($usuario->deleted_at)
                        <span class="badge bg-danger">Inactivo</span>
                    @else
                        <span class="badge bg-success">Activo</span>
                    @endif
                </td>
                <td>
                    @if($usuario->carritoCount > 0)
                        <span class="badge bg-warning text-dark">{{ $usuario->carritoCount }} items</span>
                        <a href="{{ route('admin.usuarios.carrito', $usuario->id) }}" class="btn btn-sm btn-outline-info">Ver</a>
                    @else
                        <span class="badge bg-secondary">Vacío</span>
                    @endif
                </td>
                <td>
                    @if($usuario->deleted_at)
                        <form action="{{ route('admin.usuarios.activar', $usuario->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Activar</button>
                        </form>
                    @else
                        <form action="{{ route('admin.usuarios.inactivar', $usuario->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-secondary">Inactivar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection