<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step & Style</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Permite utilizar esta fuente geométrica sans-serif moderna, específicamente en sus pesos 300 (ligera), 400 (regular) y 600 (semibold) -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<!-- min-vh-100 obliga a que el cuerpo ocupe al menos el 100% del viewport en altura -->
<!-- d-flex flex-column organiza los elementos (header, contenido y footer) en columna -->
<body class="d-flex flex-column min-vh-100">
@include('partes.header')
@include('partes.navbar')

<!-- flex-grow-1 permite que el contenido se expanda para llenar el espacio disponible -->
<main class="flex-grow-1 container mt-4">
    @yield('content')
    
</main>

@include('partes.footer')

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>