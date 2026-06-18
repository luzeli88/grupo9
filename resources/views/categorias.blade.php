
@extends('plantilla')

@section('content')
@php
    $productos = $productos ?? collect();
    $categoria = $categoria ?? 'Productos';
@endphp
<div class="container-fluid px-4">
    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show mt-3">
            {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show mt-3">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

  <div class="categoria-banner mb-5">

    <div class="categoria-acento"></div>

    <span class="categoria-etiqueta">
        NUEVA COLECCIÓN
    </span>

    <h1 class="categoria-titulo">
        {{ ucfirst($categoria) }}
    </h1>

    <p class="categoria-descripcion">
        @if($categoria === 'botas')
            Diseños exclusivos que combinan elegancia y personalidad.
        @elseif($categoria === 'sandalias')
            Comodidad y sofisticación para acompañarte en cada paso.
        @else
            Calzado seleccionado para destacar tu estilo.
        @endif
    </p>

</div>


    <div class="full-width-section productos-full">
         <div class="d-flex justify-content-end mb-3">
    <button class="btn btn-outline-dark"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#panelFiltros"
            aria-expanded="false">

        <i class="bi bi-funnel"></i> Filtros
    </button>
</div>
        <div class="collapse mb-4 {{ request()->hasAny(['categoria','talle','precio_min','precio_max','orden']) ? 'show' : '' }}"
     id="panelFiltros">

    <form method="GET" action="{{ route('categorias') }}">

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="row g-3">

                {{-- Categoría --}}
                <div class="col-12 col-md-3">
                    <select name="categoria" class="form-select">
                        <option value="">Todas las categorías</option>
                        <option value="botas" {{ request('categoria') == 'botas' ? 'selected' : '' }}>
                            Botas
                        </option>
                        <option value="sandalias" {{ request('categoria') == 'sandalias' ? 'selected' : '' }}>
                            Sandalias
                        </option>
                        <option value="zapatos" {{ request('categoria') == 'zapatos' ? 'selected' : '' }}>
                            Zapatos
                        </option>
                    </select>
                </div>

                {{-- Talle --}}
                <div class="col-12 col-md-2">
                    <select name="talle" class="form-select">
                        <option value="">Todos los talles</option>

                        @foreach(range(35,45) as $t)
                            <option value="{{ $t }}"
                                {{ request('talle') == $t ? 'selected' : '' }}>
                                {{ $t }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Precio mínimo --}}
                <div class="col-6 col-md-2">
                    <input type="number"
                           name="precio_min"
                           class="form-control"
                           placeholder="Precio mín"
                           value="{{ request('precio_min') }}">
                </div>

                {{-- Precio máximo --}}
                <div class="col-6 col-md-2">
                    <input type="number"
                           name="precio_max"
                           class="form-control"
                           placeholder="Precio máx"
                           value="{{ request('precio_max') }}">
                </div>

                {{-- Orden --}}
                <div class="col-12 col-md-2">
                    <select name="orden" class="form-select">
                        <option value="">Ordenar</option>

                        <option value="asc"
                            {{ request('orden') == 'asc' ? 'selected' : '' }}>
                            Más barato
                        </option>

                        <option value="desc"
                            {{ request('orden') == 'desc' ? 'selected' : '' }}>
                            Más caro
                        </option>
                    </select>
                </div>

              
                {{-- Botones --}}
<div class="col-6 col-md-1 d-grid">
    <button class="btn btn-dark">
        Filtrar
    </button>
</div>

<div class="col-6 col-md-1 d-grid">
    <a href="{{ route('categorias') }}"
       class="btn btn-outline-secondary">
        Limpiar
    </a>
</div>

            </div>

        </div>
    </div>

</form> 

    </form>
</div>
@include('partials.productos')
    </div>

</div>
@endsection