@extends('plantilla')

@section('content')

<div class="container my-5">
    <h1 class="mb-4">Agregar producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control">
        </div>

        <div class="mb-3">
            <label>Categoría</label>
            <select name="categoria" class="form-control" required>
                <option value="botas">Botas</option>
                <option value="sandalias">Sandalias</option>
                <option value="zapatos">Zapatos</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Precio compra</label>
            <input type="number" id="precioCompra" name="precio_compra" class="form-control" step="0.01">
            <small class="form-text text-muted">Ingresa el precio de compra para calcular automáticamente el precio de venta.</small>
        </div>

        <div class="mb-3">
            <label>Precio venta</label>
            <input type="number" id="precioVenta" name="precio_venta" class="form-control" step="0.01" required>
            <small class="form-text text-muted">Se calcula automáticamente con 230% de ganancia.</small>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control">
        </div>

        <div class="mb-3">
            <label>Stock mínimo</label>
            <input type="number" name="stock_minimo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Descuento %</label>
            <input type="number" name="descuento" class="form-control">
        </div>

        <div class="mb-3">
            <label>Imagen</label>
            <input type="file" name="imagen" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
            <div class="form-text">Formatos permitidos: jpeg, png, jpg, gif, webp. Máx 2 MB.</div>
        </div>

        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-dark">Guardar producto</button>
    </form>
</div>

<script>
    // Cálculo automático de precio de venta con 30% de ganancia
    // Fórmula: precio_venta = precio_compra * 1.30
    document.getElementById('precioCompra').addEventListener('input', function() {
        const precioCompra = parseFloat(this.value) || 0;
        const ganancia = 0.30; // 30% de ganancia
        const precioVenta = precioCompra * (1 + ganancia);
        document.getElementById('precioVenta').value = precioVenta.toFixed(2);
    });
</script>
@endsection
