@extends('plantilla')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="card-title mb-3">Iniciar sesión</h3>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <form method="POST" action="/autenticar">
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <input type="checkbox" id="remember" name="remember">
              <label for="remember" class="form-check-label">Recordarme</label>
            </div>
            <a href="#">Olvidé mi contraseña</a>
          </div>

          <button type="submit" class="btn btn-primary">Entrar</button>
          <button type="reset" class="btn btn-secondary ms-2">Limpiar</button>
          <a href="/registro" class="btn btn-link">Crear cuenta</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection