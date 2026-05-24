Necesitás crear la vista resources/views/backend/productos/edit.blade.php:

blade
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
            <label>Precio venta</label>
            <input type="number" name="precio_venta" class="form-control" value="{{ $producto->precio_venta }}" required>
        </div>

        <div class="mb-3">
            <label>Precio compra</label>
            <input type="number" name="precio_compra" class="form-control" value="{{ $producto->precio_compra }}">
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
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>

        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-dark">Guardar cambios</button>
    </form>
</div>

@endsection



