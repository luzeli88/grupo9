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
            <label>Precio venta</label>
            <input type="number" name="precio_venta" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Precio compra</label>
            <input type="number" name="precio_compra" class="form-control">
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
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>

        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-dark">Guardar producto</button>
    </form>
</div>

@endsection
