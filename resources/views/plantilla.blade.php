<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Step & Style</title>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>

@include('partes.header')

<main class="container mt-4">
    @yield('content')
</main>

@include('partes.footer')

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>

