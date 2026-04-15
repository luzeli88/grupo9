<!DOCTYPE html>
<html>
<head>

<!-- MENÚ SUPERIOR -->
<div class="menu-top">

  <!-- PRODUCTOS (dropdown) -->
  <div class="dropdown">
    <a href="#">Productos</a>

    <div class="dropdown-content">
      <a href="/hombre">👞 Hombre</a>
      <a href="/mujer">👠 Mujer</a>
    </div>
  </div>

  <!-- BOTONES -->
  <a href="/quienes-somos">Quiénes somos</a>
  <a href="/pagos">Medios de pago</a>

</div>


<!-- BANNER -->
<div class="banner">
  <img src="{{ asset('Images/logo.png') }}" alt="banner">
  <div class="texto-banner">
    
  </div>
</div>

      <meta charset="UTF-8">
  <title>Step & Style</title>

  <style>
    .logo-centro img {
  width: 100%;      /* ocupa todo el ancho */
  height: auto;     /* mantiene proporción */
}
    .footer {
  display: flex;
  justify-content: center;
  gap: 40px;
  padding: 15px;
  background: black;
}

.footer a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  transition: 0.3s;
}

.footer a:hover {
  color: #ff6600;
}
    .dropdown {
  position: relative;
}

.dropdown-content {
  display: none;
  position: absolute;
  background: white;
  min-width: 150px;
  border-radius: 8px;
  padding: 10px;
}

.dropdown-content a {
  display: block;
  color: black;
  text-decoration: none;
  padding: 5px;
}

.dropdown-content a:hover {
  background: #f5f5f5;
}

.dropdown:hover .dropdown-content {
  display: block;
}
    /* Mostrar menú al pasar el mouse */
.nav-item.dropdown:hover .dropdown-menu {
  display: block;
  margin-top: 0;
}

/* Opcional: mejora visual */
.dropdown-menu {
  border-radius: 10px;
  padding: 10px;
}
.nav-item.dropdown .dropdown-menu {
  display: none;
}

.nav-item.dropdown:hover .dropdown-menu {
  display: block !important;
  margin-top: 0;
}

.dropdown-item:hover {
  background-color: #f5f5f5;
}
    .logo-centro img {
  width: 100%;
  max-width: 200px;  /* tamaño máximo */
  height: auto;
}
    .logo-centro {
  text-align: center;
  margin-top: 30px;
}
    body {
  font-family: Arial;
  margin: 0;
  background: #f5f5f5;
}

/* Título */
h1 {
  text-align: center;
  margin-top: 30px;
}

/* Contenedor de productos */
.productos {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin-top: 40px;
}

/* Tarjeta */
.card {
  background: white;
  padding: 20px;
  border-radius: 15px;
  text-align: center;
  width: 250px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  transition: 0.3s;
}

.card:hover {
  transform: translateY(-10px);
}

/* Imagen */
.card img {
  width: 180px;
  border-radius: 10px;
}

/* Precio */
.card p {
  font-size: 18px;
  font-weight: bold;
}

/* Botón */
.btn {
  background: linear-gradient(45deg, #ff6600, #ff3300);
  color: white;
  padding: 12px 20px;
  border-radius: 25px;
  border: none;
  cursor: pointer;
  font-weight: bold;
}

.btn:hover {
  opacity: 0.8;
}
    .carrito {
  position: fixed;   /* 👈 queda fijo aunque bajes la página */
  top: 20px;         /* distancia desde arriba */
  right: 20px;       /* distancia desde la derecha */
  font-size: 28px;
  text-decoration: none;
}
    .card {
  background: white;
  padding: 20px;
  margin: 30px auto; /* 👈 centra la tarjeta */
  border-radius: 10px;
  text-align: center;
  width: 250px;
}

.card img {
  width: 150px;
  display: block;
  margin: 0 auto; /* 👈 centra la imagen */
}
    body {

      font-family: Arial;
      margin: 0;
      background: #f5f5f5;
    }

    .btn {
      background: black;
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background: gray;
      transform: scale(1.05);
    }
    .logo-full img {
  width: 100%;
  height: 300px;
  object-fit: contain; /* no recorta */
}
   
   
/* MENÚ CENTRADO */
.menu-top {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 40px;
  padding: 15px;
  background: black;
}

/* BOTONES */
.menu-top a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  transition: 0.3s;
}

.menu-top a:hover {
  color: #ff6600;
}

/* DROPDOWN */
.dropdown {
  position: relative;
}

.dropdown-content {
  display: none;
  position: absolute;
  background: white;
  padding: 10px;
  border-radius: 8px;
  min-width: 150px;
}

.dropdown-content a {
  display: block;
  color: black;
  padding: 5px;
}

.dropdown-content a:hover {
  background: #f5f5f5;
}

/* MOSTRAR AL PASAR EL MOUSE */
.dropdown:hover .dropdown-content {
  display: block;

  </style>
  


    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    
</head>

<body>
  <a href="/carrito" class="carrito">🛒</a>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

</nav>

<!-- CONTENIDO -->
<div class="container mt-4">
    @yield('contenido')
</div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 

</div>
    
<footer class="footer">
  <a href="/terminos">Términos y usos</a>
  <a href="/contacto">Contacto</a>
</footer>
</body>
 
</a>
</html>