
@extends('plantilla')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card consulta-card shadow-sm rounded-4 p-4">
                <div class="text-center mb-4">
                    <h1 class="mb-2">Consultas</h1>
                    <p class="text-muted mb-0">Escribí tu consulta y te responderemos cuanto antes. Queremos ayudarte con tu compra.</p>
                </div>

                <form action="{{ url('/consultas') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Escribí tu nombre y apellido" autocomplete="name" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Tu correo electrónico" autocomplete="email" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Mensaje</label>
                        <textarea name="mensaje" class="form-control" rows="6" placeholder="¿En qué te podemos ayudar?" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">Enviar consulta</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection