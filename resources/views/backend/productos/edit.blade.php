@extends('plantilla')

@section('content')

<div class="container my-5">
    <h1 class="mb-4">Editar producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ $producto->descripcion }}">
        </div>

        <div class="mb-3">
            <label>Categoría</label>
            <select name="categoria" class="form-control" required>
                <option value="botas" {{ $producto->categoria == 'botas' ? 'selected' : '' }}>Botas</option>
                <option value="sandalias" {{ $producto->categoria == 'sandalias' ? 'selected' : '' }}>Sandalias</option>
                <option value="zapatos" {{ $producto->categoria == 'zapatos' ? 'selected' : '' }}>Zapatos</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Precio compra</label>
            <input type="number" id="precioCompra" name="precio_compra" class="form-control" step="0.01" value="{{ $producto->precio_compra }}">
            <small class="form-text text-muted">Ingresa el precio de compra para calcular automáticamente el precio de venta.</small>
        </div>

        <div class="mb-3">
            <label>Precio venta</label>
            <input type="number" id="precioVenta" name="precio_venta" class="form-control" step="0.01" value="{{ $producto->precio_venta }}" required>
            <small class="form-text text-muted">Se calcula automáticamente con 230% de ganancia.</small>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}">
        </div>

        <div class="mb-3">
            <label>Stock mínimo</label>
            <input type="number" name="stock_minimo" class="form-control" value="{{ $producto->stock_minimo }}">
        </div>

        <div class="mb-3">
            <label>Descuento %</label>
            <input type="number" name="descuento" class="form-control" value="{{ $producto->descuento }}">
        </div>

        <div class="mb-3">
            <label>Imagen actual</label><br>
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" width="100" class="mb-2"><br>
            @else
                Sin imagen<br>
            @endif
            <label>Cambiar imagen</label>
            <input type="file" name="imagen" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
            <div class="form-text">Formatos permitidos: jpeg, png, jpg, gif, webp. Máx 2 MB.</div>
        </div>

         <div class="mb-3">
            <label class="fw-bold">Stock por talle</label>
            <div class="row g-2 mt-1">
                @foreach([35, 36, 37, 38, 39, 40] as $talle)
                <div class="col-md-2">
                    <label>Talle {{ $talle }}</label>
                    <input type="number" name="talles[{{ $talle }}]" class="form-control" min="0"
                        value="{{ $talles[$talle]->stock ?? 0 }}">
                </div>
                @endforeach
            </div>
        </div>

        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-dark">Guardar cambios</button>

    </form>
</div>

<script>
    // Cálculo automático de precio de venta con 230% de ganancia
    // Fórmula: precio_venta = precio_compra * 3.30
    document.getElementById('precioCompra').addEventListener('input', function() {
        const precioCompra = parseFloat(this.value) || 0;
        const ganancia = 2.30; // 230% de ganancia
        const precioVenta = precioCompra * (1 + ganancia);
        document.getElementById('precioVenta').value = precioVenta.toFixed(2);
    });
</script>
@endsection



