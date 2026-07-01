@extends('plantilla')

@section('content')
<div class="container my-5">

    <h1 class="mb-1 fw-light">Gestión de Productos</h1>
    <p class="text-muted mb-4">Administrá el catálogo de la tienda</p>

    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ACCIONES --}}
    <div class="d-flex gap-2 mb-4">
        <a href="{{ route('admin') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver al panel
        </a>
        <a href="{{ route('productos.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-lg"></i> Agregar producto
        </a>
    </div>

    {{-- FILTROS --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-semibold mb-3"><i class="bi bi-funnel me-2"></i>Filtros</h6>
            <form method="GET" action="{{ route('productos.index') }}">
                <div class="row g-2">

                    {{-- Nombre --}}
                    <div class="col-12 col-md-3">
                        <input type="text"
                               name="buscar"
                               class="form-control form-control-sm"
                               placeholder="Buscar por nombre..."
                               value="{{ request('buscar') }}">
                    </div>

                    {{-- Categoría --}}
                    <div class="col-6 col-md-2">
                        <select name="categoria" class="form-select form-select-sm">
                            <option value="">Todas las categorías</option>
                            <option value="botas"     {{ request('categoria') === 'botas'     ? 'selected' : '' }}>Botas</option>
                            <option value="sandalias" {{ request('categoria') === 'sandalias' ? 'selected' : '' }}>Sandalias</option>
                            <option value="zapatos"   {{ request('categoria') === 'zapatos'   ? 'selected' : '' }}>Zapatos</option>
                        </select>
                    </div>

                    {{-- Estado --}}
                    <div class="col-6 col-md-2">
                        <select name="estado" class="form-select form-select-sm">
                            <option value="">Todos los estados</option>
                            <option value="activo"   {{ request('estado') === 'activo'   ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ request('estado') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    {{-- Precio --}}
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                   name="precio_min"
                                   class="form-control form-control-sm"
                                   placeholder="Precio mín"
                                   value="{{ request('precio_min') }}">
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                   name="precio_max"
                                   class="form-control form-control-sm"
                                   placeholder="Precio máx"
                                   value="{{ request('precio_max') }}">
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="col-12 col-md-1 d-flex gap-1">
                        <button type="submit" class="btn btn-dark btn-sm w-100">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>

                </div>

                {{-- Stock (segunda fila) --}}
                <div class="row g-2 mt-1">
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-box"></i></span>
                            <input type="number"
                                   name="stock_min"
                                   class="form-control form-control-sm"
                                   placeholder="Stock mín"
                                   value="{{ request('stock_min') }}">
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-box"></i></span>
                            <input type="number"
                                   name="stock_max"
                                   class="form-control form-control-sm"
                                   placeholder="Stock máx"
                                   value="{{ request('stock_max') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 d-flex align-items-center">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Mostrando <strong>{{ $productos->count() }}</strong> de <strong>{{ $productos->total() }}</strong> producto(s)
                        </small>
                    </div>
                </div>

            </form>
        </div>
    </div>

    {{-- TABLA — desktop --}}
    <div class="d-none d-xl-block">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width:50px">ID</th>
                    <th style="width:80px">Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio venta</th>
                    <th>Stock</th>
                    <th>Talles</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                <tr>
                    <td class="text-muted small">{{ $producto->id }}</td>
                    <td>
                        @if($producto->imagen)
                            <img src="{{ asset(str_starts_with($producto->imagen, 'img/') 
                            ? $producto->imagen : 'storage/' . $producto->imagen) }}"
                                 width="55" height="55"
                                 class="rounded object-fit-cover">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                 style="width:55px;height:55px">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $producto->nombre }}</td>
                    <td>
                        <span class="badge text-bg-light border">
                            {{ ucfirst($producto->categoria) }}
                        </span>
                    </td>
                    <td class="fw-bold">${{ number_format($producto->precio_venta, 0, ',', '.') }}</td>
                    <td>
                        @if($producto->stock > 0)
                            <span class="badge text-bg-success">{{ $producto->stock }}</span>
                        @else
                            <span class="badge text-bg-danger">Sin stock</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($producto->talles as $t)
                                <span class="badge {{ $t->stock > 0 ? 'text-bg-dark' : 'text-bg-secondary' }}">
                                    {{ $t->talle }}: {{ $t->stock }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        @if($producto->deleted_at)
                            <span class="badge text-bg-danger">Inactivo</span>
                        @else
                            <span class="badge text-bg-success">Activo</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex flex-column gap-1">
                            <a href="{{ route('productos.edit', $producto->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil me-1"></i>Editar
                            </a>
                            @if($producto->deleted_at)
                                <form action="{{ route('productos.restore', $producto->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success w-100">
                                        <i class="bi bi-check-lg me-1"></i>Activar
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-secondary w-100"
                                            onclick="return confirm('¿Inactivar este producto?')">
                                        <i class="bi bi-pause-circle me-1"></i>Inactivar
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('productos.forceDelete', $producto->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100"
                                        onclick="return confirm('¿Eliminar permanentemente? Esta acción no se puede deshacer.')">
                                    <i class="bi bi-trash me-1"></i>Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            <i class="bi bi-search me-2"></i>
                            No se encontraron productos con ese criterio.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- CARDS — mobile y tablet --}}
    <div class="d-xl-none">
        @forelse($productos as $producto)
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body">

                    {{-- CABECERA --}}
                    <div class="d-flex gap-3 align-items-start mb-3">
                        @if($producto->imagen)
                            <img src="{{ asset(str_starts_with($producto->imagen, 'img/') ? 
                            $producto->imagen : 'storage/' . $producto->imagen) }}"

                                 width="70" height="70"
                                 class="rounded object-fit-cover flex-shrink-0">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:70px;height:70px">
                                <i class="bi bi-image text-muted fs-4"></i>
                            </div>
                        @endif
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="fw-bold mb-1">{{ $producto->nombre }}</h6>
                                @if($producto->deleted_at)
                                    <span class="badge text-bg-danger">Inactivo</span>
                                @else
                                    <span class="badge text-bg-success">Activo</span>
                                @endif
                            </div>
                            <span class="badge text-bg-light border me-1">{{ ucfirst($producto->categoria) }}</span>
                            <span class="fw-bold">${{ number_format($producto->precio_venta, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- TALLES --}}
                    @if($producto->talles->isNotEmpty())
                        <div class="mb-3">
                            <small class="text-muted fw-semibold d-block mb-1">Talles</small>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($producto->talles as $t)
                                    <span class="badge {{ $t->stock > 0 ? 'text-bg-dark' : 'text-bg-secondary' }}">
                                        {{ $t->talle }}: {{ $t->stock }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- ACCIONES --}}
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('productos.edit', $producto->id) }}"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil me-1"></i>Editar
                        </a>
                        @if($producto->deleted_at)
                            <form action="{{ route('productos.restore', $producto->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-check-lg me-1"></i>Activar
                                </button>
                            </form>
                        @else
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-secondary"
                                        onclick="return confirm('¿Inactivar este producto?')">
                                    <i class="bi bi-pause-circle me-1"></i>Inactivar
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('productos.forceDelete', $producto->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar permanentemente? Esta acción no se puede deshacer.')">
                                <i class="bi bi-trash me-1"></i>Eliminar
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                <i class="bi bi-search me-2"></i>
                No se encontraron productos con ese criterio.
            </div>
        @endforelse
    </div>

    {{-- PAGINACIÓN --}}
    @if($productos->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $productos->links() }}
        </div>
    @endif

</div>
@endsection