@extends('plantilla')

@section('content')
<div class="container my-5">

    <h1 class="mb-1 fw-light">Gestión de Usuarios</h1>
    <p class="text-muted mb-4">Administrá clientes y administradores</p>

    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
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
            <form method="GET" action="{{ route('admin.usuarios.index') }}">
                <div class="row g-2">

                    <div class="col-12 col-md-4">
                        <input type="text"
                               name="buscar"
                               class="form-control form-control-sm"
                               placeholder="Buscar por nombre o email..."
                               value="{{ request('buscar') }}">
                    </div>

                    <div class="col-6 col-md-2">
                        <select name="rol" class="form-select form-select-sm">
                            <option value="">Todos los roles</option>
                            <option value="cliente"  {{ request('rol') === 'cliente'  ? 'selected' : '' }}>Cliente</option>
                            <option value="admin"    {{ request('rol') === 'admin'    ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-2">
                        <select name="estado" class="form-select form-select-sm">
                            <option value="">Todos los estados</option>
                            <option value="activo"   {{ request('estado') === 'activo'   ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ request('estado') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-2 d-flex gap-1">
                        <button type="submit" class="btn btn-dark btn-sm w-100">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>

                    <div class="col-12 col-md-2 d-flex align-items-center">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Mostrando <strong>{{ $usuarios->count() }}</strong> de <strong>{{ $usuarios->total() }}</strong> usuario(s)
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
                    <th>Nombre / Email</th>
                    <th>Teléfono</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>Carrito</th>
                    <th>Rol</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td class="text-muted small">{{ $usuario->id }}</td>
                    <td>
                        <div class="fw-semibold">{{ $usuario->nombre }}</div>
                        <small class="text-muted">{{ $usuario->email }}</small>
                    </td>
                    <td class="small">{{ $usuario->telefono ?? '-' }}</td>
                    <td class="small">{{ $usuario->ciudad ?? '-' }}</td>
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
                            <a href="{{ route('admin.usuarios.carrito', $usuario->id) }}" class="btn btn-sm btn-outline-info ms-1">Ver</a>
                        @else
                            <span class="badge bg-secondary">Vacío</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST"
                              action="{{ route('admin.usuarios.rol', $usuario->id) }}"
                              class="form-cambio-rol"
                              data-nombre="{{ $usuario->nombre }}">
                            @csrf
                            <div class="input-group input-group-sm">
                                <select name="rol_id" class="form-select form-select-sm">
                                    @foreach($roles as $rol)
                                        <option value="{{ $rol->id }}" {{ $usuario->rol_id === $rol->id ? 'selected' : '' }}>
                                            {{ $rol->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline-primary btn-sm">Guardar</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <div class="d-flex flex-column gap-1">
                            <button type="button"
                                    class="btn btn-sm btn-warning btn-editar"
                                    data-id="{{ $usuario->id }}"
                                    data-nombre="{{ $usuario->nombre }}"
                                    data-email="{{ $usuario->email }}"
                                    data-telefono="{{ $usuario->telefono }}"
                                    data-direccion="{{ $usuario->direccion }}"
                                    data-ciudad="{{ $usuario->ciudad }}">
                                <i class="bi bi-pencil me-1"></i>Editar
                            </button>

                            @if($usuario->rol?->nombre === 'admin')
                                <span class="badge bg-dark text-center py-2">Administrador</span>
                            @elseif($usuario->deleted_at)
                                <form action="{{ route('admin.usuarios.activar', $usuario->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success w-100">
                                        <i class="bi bi-check-lg me-1"></i>Activar
                                    </button>
                                </form>
                            @else
                                <form id="form-inactivar-{{ $usuario->id }}"
                                      action="{{ route('admin.usuarios.inactivar', $usuario->id) }}"
                                      method="POST">
                                    @csrf
                                    <button type="button"
                                            class="btn btn-sm btn-secondary w-100 btn-inactivar"
                                            data-form="form-inactivar-{{ $usuario->id }}"
                                            data-nombre="{{ $usuario->nombre }}"
                                            data-admin="0">
                                        <i class="bi bi-pause-circle me-1"></i>Inactivar
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
                            No se encontraron usuarios con ese criterio.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- CARDS — mobile y tablet --}}
    <div class="d-xl-none">
        @forelse($usuarios as $usuario)
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body">

                    {{-- CABECERA --}}
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $usuario->nombre }}</h6>
                            <small class="text-muted">{{ $usuario->email }}</small>
                        </div>
                        @if($usuario->deleted_at)
                            <span class="badge bg-danger">Inactivo</span>
                        @else
                            <span class="badge bg-success">Activo</span>
                        @endif
                    </div>

                    <hr class="my-2">

                    {{-- DATOS --}}
                    <div class="row g-1 small mb-2">
                        <div class="col-6">
                            <span class="text-muted">Teléfono:</span>
                            {{ $usuario->telefono ?? '-' }}
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Ciudad:</span>
                            {{ $usuario->ciudad ?? '-' }}
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Rol:</span>
                            {{ $usuario->rol?->nombre ?? '-' }}
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Carrito:</span>
                            @if($usuario->carritoCount > 0)
                                <span class="badge bg-warning text-dark">{{ $usuario->carritoCount }} items</span>
                                <a href="{{ route('admin.usuarios.carrito', $usuario->id) }}" class="small">Ver</a>
                            @else
                                <span class="badge bg-secondary">Vacío</span>
                            @endif
                        </div>
                    </div>

                    <hr class="my-2">

                    {{-- ROL --}}
                    <form method="POST"
                          action="{{ route('admin.usuarios.rol', $usuario->id) }}"
                          class="form-cambio-rol mb-2"
                          data-nombre="{{ $usuario->nombre }}">
                        @csrf
                        <div class="input-group input-group-sm">
                            <select name="rol_id" class="form-select form-select-sm">
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ $usuario->rol_id === $rol->id ? 'selected' : '' }}>
                                        {{ $rol->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Guardar rol</button>
                        </div>
                    </form>

                    {{-- ACCIONES --}}
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button"
                                class="btn btn-sm btn-warning btn-editar"
                                data-id="{{ $usuario->id }}"
                                data-nombre="{{ $usuario->nombre }}"
                                data-email="{{ $usuario->email }}"
                                data-telefono="{{ $usuario->telefono }}"
                                data-direccion="{{ $usuario->direccion }}"
                                data-ciudad="{{ $usuario->ciudad }}">
                            <i class="bi bi-pencil me-1"></i>Editar
                        </button>

                        @if($usuario->deleted_at)
                            <form action="{{ route('admin.usuarios.activar', $usuario->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Activar</button>
                            </form>
                        @elseif($usuario->rol?->nombre !== 'admin')
                            <form id="form-inactivar-mobile-{{ $usuario->id }}"
                                  action="{{ route('admin.usuarios.inactivar', $usuario->id) }}"
                                  method="POST">
                                @csrf
                                <button type="button"
                                        class="btn btn-sm btn-secondary btn-inactivar"
                                        data-form="form-inactivar-mobile-{{ $usuario->id }}"
                                        data-nombre="{{ $usuario->nombre }}"
                                        data-admin="0">
                                    <i class="bi bi-pause-circle me-1"></i>Inactivar
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                <i class="bi bi-search me-2"></i>
                No se encontraron usuarios con ese criterio.
            </div>
        @endforelse
    </div>

    {{-- PAGINACIÓN --}}
    @if($usuarios->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $usuarios->links() }}
        </div>
    @endif

</div>

{{-- MODAL CONFIRMAR INACTIVAR --}}
<div class="modal fade" id="modalInactivar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirmar inactivación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que querés inactivar a <strong id="nombreUsuario"></strong>?</p>
                <div id="bloqueClaveAdmin" class="d-none">
                    <div class="alert alert-warning">
                        <i class="bi bi-shield-lock me-2"></i>
                        Este usuario es <strong>administrador</strong>. Ingresá tu contraseña para confirmar.
                    </div>
                    <input type="password" id="claveAdmin" class="form-control" placeholder="Tu contraseña actual">
                    <div id="errorClave" class="text-danger small mt-1 d-none">Contraseña incorrecta.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarInactivar">Inactivar</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDITAR USUARIO --}}
<div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-pencil me-2"></i>Editar usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditar" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" name="nombre" id="editNombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Teléfono</label>
                        <input type="text" name="telefono" id="editTelefono" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Dirección</label>
                        <input type="text" name="direccion" id="editDireccion" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ciudad</label>
                        <input type="text" name="ciudad" id="editCiudad" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script>
document.querySelectorAll('.form-cambio-rol').forEach(form => {
    form.addEventListener('submit', function (e) {
        const nombre   = this.dataset.nombre;
        const select   = this.querySelector('select');
        const rolNuevo = select.options[select.selectedIndex].text;
        if (!confirm(`¿Seguro que querés cambiar el rol de "${nombre}" a "${rolNuevo}"?`)) {
            e.preventDefault();
        }
    });
});

let formInactivar = null;

document.querySelectorAll('.btn-inactivar').forEach(btn => {
    btn.addEventListener('click', function () {
        formInactivar = document.getElementById(this.dataset.form);
        document.getElementById('nombreUsuario').textContent = this.dataset.nombre;

        const esAdmin = this.dataset.admin === '1';
        document.getElementById('bloqueClaveAdmin').classList.toggle('d-none', !esAdmin);
        document.getElementById('claveAdmin').value = '';
        document.getElementById('errorClave').classList.add('d-none');

        new bootstrap.Modal(document.getElementById('modalInactivar')).show();
    });
});

document.getElementById('btnConfirmarInactivar').addEventListener('click', async function () {
    const bloqueAdmin = document.getElementById('bloqueClaveAdmin');
    const esAdmin = !bloqueAdmin.classList.contains('d-none');

    if (esAdmin) {
        const clave = document.getElementById('claveAdmin').value;
        if (!clave) {
            document.getElementById('errorClave').textContent = 'Ingresá tu contraseña.';
            document.getElementById('errorClave').classList.remove('d-none');
            return;
        }

        const res = await fetch('{{ route("admin.verificar.clave") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ password: clave })
        });

        const data = await res.json();
        if (!data.ok) {
            document.getElementById('errorClave').textContent = 'Contraseña incorrecta.';
            document.getElementById('errorClave').classList.remove('d-none');
            return;
        }
    }

    if (formInactivar) formInactivar.submit();
});

document.querySelectorAll('.btn-editar').forEach(btn => {
    btn.addEventListener('click', function () {
        document.getElementById('editNombre').value    = this.dataset.nombre    ?? '';
        document.getElementById('editEmail').value     = this.dataset.email     ?? '';
        document.getElementById('editTelefono').value  = this.dataset.telefono  ?? '';
        document.getElementById('editDireccion').value = this.dataset.direccion ?? '';
        document.getElementById('editCiudad').value    = this.dataset.ciudad    ?? '';

        document.getElementById('formEditar').action = `/admin/usuarios/${this.dataset.id}/editar`;

        new bootstrap.Modal(document.getElementById('modalEditar')).show();
    });
});
</script>

@endsection
