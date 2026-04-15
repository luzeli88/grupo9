<!DOCTYPE html>
<html>
<head>
  <title>Hombre</title>

  <style>
    body {
      font-family: Arial;
      background: #f5f5f5;
      text-align: center;
    }

    .productos {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 40px;
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      width: 220px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }

    .card img {
      width: 150px;
    }

    .btn {
      background: black;
      color: white;
      padding: 10px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>

<body>

<h1>👞 Productos para Hombre</h1>

<div class="productos">

  <div class="card">
    <img src="{{ asset('Images/zapatilla-color.jpg') }}">
    
    <p>$20.000</p>
    <a href="/carrito">
  <button class="btn">Comprar</button>
</a>
  </div>

  <div class="card">
    <img src="{{ asset('Images/zapatilla-color.jpg') }}">
    
    <p>$35.000</p>
    <a href="/carrito">
  <button class="btn">Comprar</button>
</a>
  </div>

</div>

<a href="/">⬅ Volver</a>

</body>