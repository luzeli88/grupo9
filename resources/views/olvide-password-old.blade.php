@extends('plantilla')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Restablecer contraseña</h3>

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

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">Volver al login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection