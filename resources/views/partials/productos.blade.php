<div class="row g-3 mt-3">

    @foreach($productos as $producto)

    <!-- 📱 RESPONSIVE: 2 / 3 / 4 columnas -->
    <div class="col-6 col-md-4 col-lg-3">

        <div class="card producto-card h-100">

            <!-- 🖼 IMAGEN + BOTÓN -->
            <div class="img-container">

                <a href="#">
                    <img src="{{ asset($producto['imagen']) }}" alt="{{ $producto['nombre'] }}">
                </a>

                <!-- BOTÓN SOBRE IMAGEN -->
                <button class="btn btn-dark btn-hover" onclick="irAProducto('{{ $producto['nombre'] }}')">
                    Comprar
                </button>

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

<script>
function irAProducto(nombre) {
    const categoria = nombre.toLowerCase();
    let ruta = '#';
    
    if (categoria === 'bota') {
        ruta = '{{ route("botas") }}';
    } else if (categoria === 'sandalia' || categoria === 'sandalias') {
        ruta = '{{ route("sandalias") }}';
    } else if (categoria === 'zapato' || categoria === 'zapatos') {
        ruta = '{{ route("zapatos") }}';
    }
    
    if (ruta !== '#') {
        window.location.href = ruta;
    }
}
</script>