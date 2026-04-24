<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
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
                    <a class="nav-link" href="{{ route('quienes') }}">Quienes somos</a>
                </li>
                <li class="nav-item">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"#" role="button" data-bs-toggle="dropdown">
                        Comercializacion
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('envio') }}">Medios de Envios</a></li>
                        <li><a class="dropdown-item" href="{{ route('pago') }}">Formas de Pago</a></li>
                    </ul> 
                </li>
                    <a class="nav-link" href="{{ route('consultas') }}">Consultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"#" role="button" data-bs-toggle="dropdown" >
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('sandalias') }}">Sandalias</a></li>
                        <li><a class="dropdown-item" href="{{ route('botas') }}">Botas</a></li>
                        <li><a class="dropdown-item" href="{{ route('zapatos') }}">Zapatos</a></li>
                    </ul>                                                       
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('construccion') }}">🛒</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('construccion') }}">👤</a>
                </li>

            </ul>
        </div>

    </div>
</nav>