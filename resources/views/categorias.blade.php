@extends('plantilla')

@section('content')

<div class="container my-5">
    <h1 class="text-center mb-5">👟 Selecciona una categoría</h1>

    <div class="row g-4 justify-content-center">
        
        <!-- Botas -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 text-center">
                <div class="card-body py-5">
                    <h2 class="mb-3">👢 Botas</h2>
                    <p class="text-muted mb-4">Descubre nuestra colección de botas cómodas y elegantes.</p>
                    <a href="{{ route('botas') }}" class="btn btn-dark w-100">
                        Ver botas →
                    </a>
                </div>
            </div>
        </div>

        <!-- Sandalias -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 text-center">
                <div class="card-body py-5">
                    <h2 class="mb-3">👡 Sandalias</h2>
                    <p class="text-muted mb-4">Explora nuestras sandalias frescas y cómodas para el verano.</p>
                    <a href="{{ route('sandalias') }}" class="btn btn-dark w-100">
                        Ver sandalias →
                    </a>
                </div>
            </div>
        </div>

        <!-- Zapatos -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 text-center">
                <div class="card-body py-5">
                    <h2 class="mb-3">👞 Zapatos</h2>
                    <p class="text-muted mb-4">Encuentra los zapatos perfectos para cualquier ocasión.</p>
                    <a href="{{ route('zapatos') }}" class="btn btn-dark w-100">
                        Ver zapatos →
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Botón para volver al panel -->
    <div class="text-center mt-5">
        <a href="{{ route('cliente') }}" class="btn btn-secondary">
            ← Volver al panel
        </a>
    </div>

</div>

@endsection
