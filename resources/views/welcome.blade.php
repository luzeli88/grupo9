<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Step & Style</title>

<style>
body {
  font-family: Arial;
  margin: 0;
  background: #f5f5f5;
}

/* Header */
header {
  background: black;
  color: white;
  padding: 15px;
  text-align: center;
}

/* Banner */
.banner {
  text-align: center;
  padding: 50px;
  background: #ddd;
}

.banner h2 {
  font-size: 30px;
}

/* Productos */
.productos {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.card {
  background: white;
  margin: 15px;
  padding: 15px;
  width: 200px;
  text-align: center;
  border-radius: 10px;
}

.card img {
  width: 100%;
}

button {
  background: black;
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
}

button:hover {
  background: gray;
}
</style>

</head>

<body>

<header>
  <h1>👟 Step & Style</h1>
  <p>Estilo en cada paso</p>
</header>

<div class="banner">
  <h2>Descubrí tu estilo</h2>
  <p>Zapatillas y calzado formal al mejor precio</p>
</div>

<div class="productos">

  <div class="card">
    <img src="https://via.placeholder.com/200" alt="zapatillas">
    <h3>Zapatillas Urbanas</h3>
    <p>$20.000</p>
    <button>Comprar</button>
  </div>

  <div class="card">
    <img src="https://via.placeholder.com/200" alt="zapatos">
    <h3>Zapatos Formales</h3>
    <p>$35.000</p>
    <button>Comprar</button>
  </div>

  <div class="card">
    <img src="https://via.placeholder.com/200" alt="botas">
    <h3>Botas de Cuero</h3>
    <p>$40.000</p>
    <button>Comprar</button>
  </div>

</div>

</body>
</html>
