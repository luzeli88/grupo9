<div class="row g-3 mt-3">

    @foreach($productos as $producto)

    <!-- 📱 RESPONSIVE: 2 / 3 / 4 columnas -->
    <div class="col-6 col-md-4 col-lg-3">

        <div class="card producto-card h-100">

            <!-- 🖼 IMAGEN + BOTÓN -->
            <div class="img-container">

                <a href="{{ route('construccion') }}">
                    <img src="{{ asset($producto['imagen']) }}" alt="{{ $producto['nombre'] }}" onerror="window.location='{{ route('construccion') }}'">
                </a>

                <!-- BOTÓN SOBRE IMAGEN -->
                <a href="{{ route('construccion') }}" class="btn btn-dark btn-hover">
                    Comprar
                </a>

            </div>

            <!-- 📝 INFO -->
            <div class="card-body p-2 text-start">

                <!-- NOMBRE -->
                <h6 class="nombre-producto">
                    {{ $producto['nombre'] }}
                </h6>

                <!-- PRECIO -->
                <p class="precio mb-1">
                    ${{ number_format($producto['precio'], 0, ',', '.') }}
                </p>

                <!-- 🎨 COLORES (simulados por ahora) -->
                <div class="colores">
                    <span style="background:black"></span>
                    <span style="background:brown"></span>
                    <span style="background:beige"></span>
                </div>

            </div>

        </div>

    </div>

    @endforeach

</div>
<!-- <div class="row text-center g-2 mt-3">
    @foreach($productos as $producto)
    <div class="col-md-4">
        <div class="card producto-card">
            <img src="{{ asset($producto['imagen']) }}" class="card-img-top">
            <div class="card-body">
                <h5>{{ $producto['nombre'] }}</h5>
                <p>${{ $producto['precio'] }}</p>
                <button class="btn btn-dark">Comprar</button>
            </div>
        </div>
    </div>
    @endforeach
</div>  -->