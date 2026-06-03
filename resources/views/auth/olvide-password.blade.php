@extends('plantilla')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Restablecer contrasena</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Correo electronico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Enviar link</button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">Volver al login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection