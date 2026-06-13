@if(session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
        {{ session('warning') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <div>{{ session('error') }}</div>

        @auth
            @if(session('notificar_producto_id'))
                <div class="mt-2">
                    <span>¿Querés que te avisemos por correo cuando vuelva a haber stock?</span>
                    <form action="{{ route('notificacion.suscribirse', session('notificar_producto_id')) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger ms-2">
                            Avisarme
                        </button>
                    </form>
                </div>
            @endif
        @endauth

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
