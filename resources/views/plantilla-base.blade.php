<!DOCTYPE html>
<html>
<head>
    <title>Mi Sitio</title>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Mi Empresa</a>

        <div class="navbar-nav">
            <a class="nav-link" href="/">Inicio</a>
            <a class="nav-link" href="/quienes">Quiénes somos</a>
            <a class="nav-link" href="/catalogo">Catálogo</a>
            <a class="nav-link" href="/comercializacion">Comercialización</a>
            <a class="nav-link" href="/contacto">Contacto</a>
        </div>
    </div>
</nav>

<!-- CONTENIDO -->
<div class="container mt-4">
    @yield('contenido')
</div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>