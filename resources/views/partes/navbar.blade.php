<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    
    <div class="container">

        <a class="navbar-brand" href="/"> Step & Style</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('quienes') }}">Quiénes somos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Comercialización
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('envio') }}">Medios de envíos</a></li>
                        <li><a class="dropdown-item" href="{{ route('pago') }}">Formas de pago</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('consultas') }}">Consultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('sandalias') }}">Sandalias</a></li>
                        <li><a class="dropdown-item" href="{{ route('botas') }}">Botas</a></li>
                        <li><a class="dropdown-item" href="{{ route('zapatos') }}">Zapatos</a></li>
                    </ul>                                                       
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon" href="{{ route('construccion') }}" aria-label="Carrito">
                        <i class="bi bi-cart3"></i>
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon dropdown-toggle" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Iniciar sesión</a></li>
                        <li><a class="dropdown-item" href="{{ route('registro') }}">Registro</a></li>
                    </ul>
                </li>

            </ul>
        </div>

    </div>
</nav>