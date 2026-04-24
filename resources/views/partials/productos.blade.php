<div class="row text-center g-2 mt-3">
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
</div>