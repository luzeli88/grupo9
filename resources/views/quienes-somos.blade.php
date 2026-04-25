@extends('plantilla')
@section('content')

<div class="contenedor text-justify">

  <h1>Quiénes somos</h1>

  <p>
    En <strong>Step & Style</strong> nos dedicamos a ofrecer calzado de calidad,
    combinando comodidad, estilo y tendencias actuales.
  </p>

  <p>
  Somos un minorista online global de moda y estilo de vida comprometido con hacer que la belleza 
  de la moda sea accesible a todo el mundo. Utilizamos tecnología de fabricación bajo demanda, para 
  conectar a los proveedores con nuestra ágil cadena de suministro, reduciendo el desperdicio de 
  inventario y permitiéndonos entregar una variedad de productos accesibles a clientes de todo el
   pais. Nuestro objetivo es que cada paso que des refleje tu personalidad.
  </p>

</div>

    <div class="team-chart mt-5">
        <div class="text-center mb-4">
            <h2>Integrantes de la empresa</h2>
            <p class="lead text-secondary">Conocé a las personas que están detrás de Step & Style y sus responsabilidades principales.</p>
        </div>

        <div class="org-chart">
            <div class="org-row justify-content-center">
                <div class="team-node root-node">
                    <div class="team-avatar">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <h3>Andrea Francini</h3>
                    <p class="role">Gerente General</p>
                    <p class="description">Supervisa la estrategia de la empresa, coordina equipos y aprueba nuevas colecciones y campañas.</p>
                    <p class="small text-secondary">5 años en la empresa</p>
                </div>
            </div>

            <div class="org-row org-row-children justify-content-center flex-wrap gap-4">
                <div class="team-node">
                    <div class="team-avatar team-avatar-secondary">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    <h3>Lucas Méndez</h3>
                    <p class="role">Marketing</p>
                    <p class="description">Diseña campañas digitales, gestiona redes sociales y atrae nuevos clientes con contenido creativo.</p>
                    <p class="small text-secondary">3 años en la empresa</p>
                </div>
                <div class="team-node">
                    <div class="team-avatar team-avatar-secondary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3>Valentina Ríos</h3>
                    <p class="role">Atención al Cliente</p>
                    <p class="description">Responde consultas, gestiona pedidos y garantiza una experiencia de compra fluida y amable.</p>
                    <p class="small text-secondary">2 años en la empresa</p>
                </div>
                <div class="team-node">
                    <div class="team-avatar team-avatar-secondary">
                        <i class="bi bi-cart-fill"></i>
                    </div>
                    <h3>Matías Alonso</h3>
                    <p class="role">Ventas Online</p>
                    <p class="description">Administra la tienda web, procesa pedidos y mejora la conversión de clientes en la plataforma online.</p>
                    <p class="small text-secondary">4 años en la empresa</p>
                </div>
            </div>
        </div>
    </div>
@endsection