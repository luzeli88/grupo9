# Especificación de Requisitos de Software
## Proyecto: Step & Style
**Revisión:** 1.0  
**Fecha:** Junio 2026  
**Grupo 9**

---

## Ficha del documento

| Fecha | Revisión | Autor | Descripción |
|-------|----------|-------|-------------|
| Junio 2026 | 1.0 | Grupo 9 | Versión inicial |

---

## Contenido

1. [Introducción](#1-introducción)
2. [Descripción general](#2-descripción-general)
3. [Requisitos específicos](#3-requisitos-específicos)
4. [Apéndices](#4-apéndices)

---

## 1 Introducción

Este documento constituye la Especificación de Requisitos de Software (SRS) del sistema **Step & Style**, una plataforma de comercio electrónico de calzado. Se describe el comportamiento esperado del sistema, sus funcionalidades y las restricciones bajo las cuales debe operar, siguiendo el estándar IEEE Std 830-1998.

### 1.1 Propósito

El propósito de este documento es describir de manera completa y precisa los requisitos funcionales y no funcionales del sistema Step & Style.

Está dirigido a:
- El equipo de desarrollo (Grupo 9), como guía de implementación.
- Docentes evaluadores, como instrumento de validación del proyecto.

### 1.2 Alcance

**Step & Style** es una plataforma de e-commerce de calzado desarrollada como proyecto académico. Permite a clientes explorar y comprar productos, y a administradores gestionar el catálogo, los usuarios y los pedidos.

El sistema cubre:
- Catálogo público de productos con filtros por categoría, precio y talle.
- Registro, autenticación y recuperación de contraseña de usuarios.
- Carrito de compras y proceso de pago con múltiples métodos.
- Generación de factura digital por compra.
- Notificaciones de reingreso de stock.
- Panel de administración para productos, usuarios, pedidos y configuración de precios.

Queda fuera del alcance: integración real con pasarelas de pago externas (los pagos son simulados), envíos físicos y facturación electrónica fiscal.

### 1.3 Personal involucrado

| Campo | Detalle |
|-------|---------|
| **Nombre** | Grupo 9 |
| **Rol** | Equipo de desarrollo |
| **Categoría profesional** | Estudiantes de desarrollo de software |
| **Responsabilidades** | Análisis, diseño, desarrollo, pruebas y documentación |
| **Información de contacto** | anfran06@gmail.com |
| **Aprobación** | Docentes de la materia |

### 1.4 Definiciones, acrónimos y abreviaturas

| Término | Definición |
|---------|-----------|
| **SRS** | Software Requirements Specification (Especificación de Requisitos de Software) |
| **RF** | Requisito Funcional |
| **RNF** | Requisito No Funcional |
| **Admin** | Usuario con rol de administrador del sistema |
| **Cliente** | Usuario registrado con acceso al panel de compras |
| **Visitante** | Usuario no autenticado que navega el sitio |
| **Soft delete** | Eliminación lógica: el registro no se borra físicamente de la base de datos |
| **Carrito** | Colección temporal de productos seleccionados por el cliente antes de confirmar la compra |
| **Pedido** | Orden de compra confirmada y registrada en el sistema |
| **Talle** | Número de calzado disponible para cada producto |
| **Stock** | Cantidad disponible de un producto por talle |
| **MercadoPago** | Plataforma de pagos digitales simulada en el sistema |
| **ORM** | Object-Relational Mapper (Eloquent en este proyecto) |
| **CSRF** | Cross-Site Request Forgery, ataque web que el sistema previene mediante tokens |
| **MariaDB** | Sistema de gestión de base de datos relacional utilizado |
| **Herd** | Entorno de desarrollo local para PHP/Laravel |

### 1.5 Referencias

| Referencia | Título | Fecha |
|-----------|--------|-------|
| IEEE Std 830-1998 | IEEE Recommended Practice for Software Requirements Specifications | 1998 |
| Laravel 13 Docs | Documentación oficial de Laravel | 2025 |
| README.md | Documentación de instalación del proyecto | Junio 2026 |

### 1.6 Resumen

El documento está organizado en cuatro secciones:
- **Sección 2**: Descripción general del sistema, funcionalidad de alto nivel y características de los usuarios.
- **Sección 3**: Requisitos específicos: interfaces, requisitos funcionales numerados y requisitos no funcionales.
- **Sección 4**: Apéndices con información complementaria.

---

## 2 Descripción general

### 2.1 Perspectiva del producto

Step & Style es un sistema independiente de comercio electrónico orientado a la venta minorista de calzado. No forma parte de un sistema mayor preexistente.

El sistema se compone de:
- Una **interfaz pública** (frontend) accesible por cualquier visitante.
- Un **panel de cliente** para usuarios registrados.
- Un **panel de administración** exclusivo para administradores.
- Una **base de datos relacional** (MariaDB) como capa de persistencia.
- Un **servidor web local** (Laravel Herd o equivalente) como entorno de ejecución.

```
[Visitante / Cliente / Admin]
         |
    [Navegador Web]
         |
   [Laravel 13 - PHP 8.4]
         |
      [MariaDB]
```

### 2.2 Funcionalidad del producto

Las funcionalidades principales del sistema son:

**Para visitantes (sin autenticación):**
- Navegar el catálogo de productos con filtros por categoría, precio y talle.
- Ver el detalle de cada producto.
- Registrarse o iniciar sesión.
- Recuperar contraseña por correo electrónico.
- Enviar consultas a través del formulario de contacto.

**Para clientes autenticados:**
- Gestionar el carrito de compras (agregar, modificar cantidad, eliminar ítems).
- Realizar compras con cuatro métodos de pago: débito, crédito (con cuotas), transferencia bancaria y MercadoPago.
- Consultar el historial de compras con filtros.
- Ver y descargar la factura de cada pedido.
- Suscribirse a notificaciones de reingreso de stock para productos sin disponibilidad.
- Editar sus datos personales (nombre, email, teléfono, dirección, ciudad).

**Para administradores:**
- Dashboard con métricas del sistema (productos, usuarios activos e inactivos).
- Gestión completa de productos: crear, editar, activar/inactivar (soft delete), restaurar y eliminar definitivamente.
- Gestión de usuarios: listar con filtros, cambiar rol, activar/inactivar, editar datos.
- Seguimiento de pedidos: listar con filtros avanzados, actualizar estado.
- Configurar porcentajes de descuento y recargo por método de pago.
- Ver el carrito actual de cualquier cliente.

### 2.3 Características de los usuarios

| Tipo de usuario | Formación | Habilidades | Actividades principales |
|----------------|-----------|-------------|------------------------|
| **Visitante** | Ninguna requerida | Uso básico de navegador web | Explorar catálogo, registrarse |
| **Cliente** | Ninguna requerida | Uso básico de navegador y formularios web | Comprar, ver historial, gestionar carrito |
| **Administrador** | Conocimientos básicos de administración de sistemas web | Manejo de paneles de gestión | Gestionar productos, usuarios y pedidos |

### 2.4 Restricciones

- El sistema debe ejecutarse sobre **PHP 8.4** y **Laravel 13**.
- La base de datos debe ser **MariaDB** (o MySQL compatible).
- El entorno de desarrollo es local; no está previsto despliegue en producción en la nube.
- Los pagos son **simulados**: no se integra con pasarelas reales.
- El sistema utiliza **soft delete** para usuarios y productos; no se eliminan registros físicamente salvo mediante "eliminar definitivamente" en productos.
- La autenticación es exclusivamente por email y contraseña; no se contempla autenticación por redes sociales ni OAuth.
- Las imágenes de productos se almacenan en el sistema de archivos local del servidor.

### 2.5 Suposiciones y dependencias

- Se asume que cada instalador dispone de un servidor local con PHP 8.4, Composer y MariaDB operativos.
- El archivo `.sql` de la base de datos debe importarse manualmente antes del primer uso (no se usa migraciones + seeders como flujo principal).
- Se asume que el servidor de correo está configurado en el `.env` para que la recuperación de contraseña funcione; en entorno local puede usarse `MAIL_MAILER=log`.
- El sistema depende de Bootstrap 5 (CDN) para la interfaz visual; requiere conexión a internet para cargarlo correctamente en desarrollo.

### 2.6 Evolución previsible del sistema

- Integración con una pasarela de pagos real (MercadoPago API).
- Sistema de reseñas y calificaciones de productos.
- Envío de facturas por correo electrónico al cliente.
- Gestión de múltiples administradores con permisos granulares.
- Módulo de reportes y estadísticas de ventas con gráficos.
- Internacionalización (soporte multi-idioma).
- Despliegue en servidor en la nube.

---

## 3 Requisitos específicos

Los requisitos se identifican con el formato **RF-XX** (funcionales) y **RNF-XX** (no funcionales).

Prioridades: **Alta/Esencial** | **Media/Deseado** | **Baja/Opcional**

### 3.1 Requisitos comunes de los interfaces

#### 3.1.1 Interfaces de usuario

El sistema provee una interfaz web accesible desde cualquier navegador moderno. Se adapta a distintos tamaños de pantalla mediante diseño **responsivo**:
- En pantallas grandes (≥ 1200px): se muestran tablas de datos.
- En pantallas pequeñas (< 1200px): se muestran tarjetas (cards) equivalentes.

La interfaz utiliza el framework **Bootstrap 5**, con navegación superior, formularios validados y modales de confirmación para acciones críticas (inactivar usuario, eliminar producto).

#### 3.1.2 Interfaces de hardware

No se requiere hardware específico más allá de un equipo con:
- Procesador compatible con PHP 8.4.
- Memoria RAM suficiente para ejecutar un servidor web local.
- Conexión a red local para acceder desde el navegador.

#### 3.1.3 Interfaces de software

| Software | Versión | Propósito |
|----------|---------|-----------|
| PHP | 8.4 | Lenguaje de programación del backend |
| Laravel | 13 | Framework principal |
| MariaDB | Compatible MySQL | Base de datos relacional |
| Composer | ≥ 2.x | Gestor de dependencias PHP |
| Bootstrap | 5 (CDN) | Framework CSS para la interfaz |
| Laravel Herd | Última | Servidor de desarrollo local (o equivalente) |

#### 3.1.4 Interfaces de comunicación

- El sistema se comunica a través de **HTTP/HTTPS** mediante el protocolo estándar de Laravel con rutas web.
- Los formularios usan **POST** con protección **CSRF** (token generado por Laravel en cada sesión).
- El envío de correos (recuperación de contraseña, notificaciones de stock) se realiza mediante el sistema de Mail de Laravel, configurable con cualquier driver SMTP o `log`.
- No se expone ninguna API REST pública en la versión actual.

---

### 3.2 Requisitos funcionales

#### RF-01 Registro de usuario

| Campo | Detalle |
|-------|---------|
| **Número** | RF-01 |
| **Nombre** | Registro de usuario |
| **Tipo** | Requisito |
| **Fuente** | Visitante |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir que un visitante cree una cuenta proporcionando nombre, email y contraseña. El email debe ser único en el sistema. La contraseña se almacena hasheada con bcrypt. Al registrarse, el usuario recibe el rol "cliente" automáticamente.

---

#### RF-02 Inicio de sesión

| Campo | Detalle |
|-------|---------|
| **Número** | RF-02 |
| **Nombre** | Inicio de sesión |
| **Tipo** | Requisito |
| **Fuente** | Cliente / Admin |
| **Prioridad** | Alta/Esencial |

El sistema debe autenticar usuarios mediante email y contraseña. Si las credenciales son correctas, redirige al panel correspondiente según el rol (cliente → `/cliente`, admin → `/admin`). Si son incorrectas, muestra un mensaje de error sin revelar cuál campo falló.

---

#### RF-03 Recuperación de contraseña

| Campo | Detalle |
|-------|---------|
| **Número** | RF-03 |
| **Nombre** | Recuperación de contraseña |
| **Tipo** | Requisito |
| **Fuente** | Cliente / Admin |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir restablecer la contraseña mediante un enlace enviado al email registrado. El enlace tiene vigencia limitada. El usuario puede ingresar y confirmar una nueva contraseña mediante el formulario en `/reset-password/{token}`.

---

#### RF-04 Cierre de sesión

| Campo | Detalle |
|-------|---------|
| **Número** | RF-04 |
| **Nombre** | Cierre de sesión |
| **Tipo** | Requisito |
| **Fuente** | Cliente / Admin |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir al usuario autenticado cerrar su sesión desde cualquier página del sitio, invalidando la sesión activa.

---

#### RF-05 Catálogo de productos público

| Campo | Detalle |
|-------|---------|
| **Número** | RF-05 |
| **Nombre** | Catálogo público de productos |
| **Tipo** | Requisito |
| **Fuente** | Visitante / Cliente |
| **Prioridad** | Alta/Esencial |

El sistema debe mostrar en la página principal (`/`) todos los productos activos con imagen, nombre, precio y categoría. Debe permitir filtrar por categoría (botas, sandalias, zapatos), precio mínimo, precio máximo y talle disponible, y ordenar por precio ascendente o descendente.

---

#### RF-06 Detalle de producto

| Campo | Detalle |
|-------|---------|
| **Número** | RF-06 |
| **Nombre** | Vista de detalle de producto |
| **Tipo** | Requisito |
| **Fuente** | Visitante / Cliente |
| **Prioridad** | Alta/Esencial |

El sistema debe mostrar la información completa de un producto: nombre, descripción, categoría, precio, imagen y talles disponibles con su stock. Si un talle tiene stock 0, debe mostrarse como no disponible.

---

#### RF-07 Gestión del carrito de compras

| Campo | Detalle |
|-------|---------|
| **Número** | RF-07 |
| **Nombre** | Carrito de compras |
| **Tipo** | Requisito |
| **Fuente** | Cliente |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir al cliente autenticado:
- Agregar un producto seleccionando talle y cantidad.
- Ver el carrito con todos los ítems, precios unitarios y totales.
- Modificar la cantidad de un ítem.
- Eliminar un ítem del carrito.
- Ver el subtotal actualizado dinámicamente.

---

#### RF-08 Proceso de pago

| Campo | Detalle |
|-------|---------|
| **Número** | RF-08 |
| **Nombre** | Proceso de pago |
| **Tipo** | Requisito |
| **Fuente** | Cliente |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir al cliente confirmar la compra seleccionando un método de pago. Los métodos disponibles son:

- **Débito**: requiere número de tarjeta (16 dígitos), nombre del titular, fecha de vencimiento y CVV.
- **Crédito**: mismos datos que débito, más selección de cuotas (3, 6, 9 o 12). Aplica recargo configurable.
- **Transferencia bancaria**: requiere número de operación de 6 dígitos.
- **MercadoPago**: requiere número de operación de 6 dígitos. Aplica descuento configurable.

El sistema debe validar que la tarjeta no esté vencida. El pago se procesa dentro de una transacción de base de datos que verifica y descuenta el stock con bloqueo de fila (`lockForUpdate`). Si el stock es insuficiente durante el pago, se cancela la operación y se informa al cliente.

---

#### RF-09 Generación de factura

| Campo | Detalle |
|-------|---------|
| **Número** | RF-09 |
| **Nombre** | Factura de compra |
| **Tipo** | Requisito |
| **Fuente** | Cliente |
| **Prioridad** | Alta/Esencial |

Al confirmar el pago, el sistema debe generar un pedido con número de factura único (formato `FAC-XXXXXXXX`) y redirigir al cliente a la vista de factura, mostrando: ítems comprados, subtotal, descuento o recargo aplicado y total final.

---

#### RF-10 Historial de compras del cliente

| Campo | Detalle |
|-------|---------|
| **Número** | RF-10 |
| **Nombre** | Historial de compras |
| **Tipo** | Requisito |
| **Fuente** | Cliente |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir al cliente ver todos sus pedidos ordenados por fecha descendente. Debe poder filtrarlos por método de pago, estado y rango de fechas. Desde el historial debe poder acceder a la factura de cada pedido.

---

#### RF-11 Notificación de reingreso de stock

| Campo | Detalle |
|-------|---------|
| **Número** | RF-11 |
| **Nombre** | Suscripción a notificación de stock |
| **Tipo** | Requisito |
| **Fuente** | Cliente |
| **Prioridad** | Media/Deseado |

El sistema debe permitir al cliente suscribirse para recibir una notificación cuando un producto sin stock vuelva a estar disponible. El sistema debe enviar la notificación automáticamente al reingresarse stock del producto. El cliente puede ver sus notificaciones pendientes en `/notificaciones`.

---

#### RF-12 Edición de perfil del cliente

| Campo | Detalle |
|-------|---------|
| **Número** | RF-12 |
| **Nombre** | Edición de perfil |
| **Tipo** | Requisito |
| **Fuente** | Cliente |
| **Prioridad** | Media/Deseado |

El sistema debe permitir al cliente actualizar su nombre, email, teléfono, dirección y ciudad desde su panel personal.

---

#### RF-13 Formulario de contacto

| Campo | Detalle |
|-------|---------|
| **Número** | RF-13 |
| **Nombre** | Consultas / contacto |
| **Tipo** | Requisito |
| **Fuente** | Visitante |
| **Prioridad** | Media/Deseado |

El sistema debe permitir a cualquier visitante enviar una consulta a través del formulario en `/contacto`. Las consultas se almacenan en la tabla `consultas`.

---

#### RF-14 Dashboard de administración

| Campo | Detalle |
|-------|---------|
| **Número** | RF-14 |
| **Nombre** | Dashboard del administrador |
| **Tipo** | Requisito |
| **Fuente** | Admin |
| **Prioridad** | Alta/Esencial |

El sistema debe mostrar al administrador en `/admin` un panel con las siguientes métricas: cantidad total de productos, cantidad de usuarios activos y cantidad de usuarios inactivos.

---

#### RF-15 Gestión de productos (admin)

| Campo | Detalle |
|-------|---------|
| **Número** | RF-15 |
| **Nombre** | ABM de productos |
| **Tipo** | Requisito |
| **Fuente** | Admin |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir al administrador:
- **Crear** un producto con nombre, descripción, categoría, precio de venta, precio de compra, stock mínimo, descuento propio e imagen.
- **Editar** todos los campos de un producto existente.
- **Inactivar** un producto (soft delete): deja de mostrarse en el catálogo público.
- **Restaurar** un producto inactivo.
- **Eliminar definitivamente** un producto (force delete).
- Gestionar los talles y el stock por talle de cada producto.

---

#### RF-16 Gestión de usuarios (admin)

| Campo | Detalle |
|-------|---------|
| **Número** | RF-16 |
| **Nombre** | Gestión de usuarios |
| **Tipo** | Requisito |
| **Fuente** | Admin |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir al administrador:
- Listar todos los usuarios (activos e inactivos) con filtros por nombre/email, rol y estado.
- Cambiar el rol de un usuario (con confirmación).
- **Inactivar** un usuario (soft delete). Si el usuario tiene rol admin, se requiere que el administrador confirme con su propia contraseña.
- **Activar** un usuario inactivo.
- Editar los datos personales de un usuario (nombre, email, teléfono, dirección, ciudad).
- Ver el contenido del carrito de un usuario.

Los usuarios con rol "admin" no deben poder ser inactivados desde la interfaz sin autenticación adicional.

---

#### RF-17 Gestión de pedidos (admin)

| Campo | Detalle |
|-------|---------|
| **Número** | RF-17 |
| **Nombre** | Seguimiento de pedidos |
| **Tipo** | Requisito |
| **Fuente** | Admin |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir al administrador ver todos los pedidos con filtros por nombre de cliente, método de pago, estado, rango de fechas y rango de total. Debe poder cambiar el estado de cada pedido.

---

#### RF-18 Configuración de precios por método de pago

| Campo | Detalle |
|-------|---------|
| **Número** | RF-18 |
| **Nombre** | Configuración de descuentos y recargos |
| **Tipo** | Requisito |
| **Fuente** | Admin |
| **Prioridad** | Alta/Esencial |

El sistema debe permitir al administrador configurar los porcentajes de descuento o recargo aplicables a cada método de pago (débito, crédito por cantidad de cuotas, transferencia, MercadoPago). Estos valores se aplican automáticamente al calcular el total de cada compra.

---

### 3.3 Requisitos no funcionales

#### 3.3.1 Requisitos de rendimiento

| Campo | Detalle |
|-------|---------|
| **Número** | RNF-01 |
| **Nombre** | Rendimiento de respuesta |
| **Tipo** | Restricción |
| **Prioridad** | Media/Deseado |

El sistema debe responder a las solicitudes del usuario en menos de 3 segundos en condiciones normales de uso (entorno local, un usuario concurrente). Las consultas a la base de datos deben estar optimizadas mediante el uso del ORM Eloquent con relaciones eager loading (`with()`).

---

#### 3.3.2 Seguridad

| Campo | Detalle |
|-------|---------|
| **Número** | RNF-02 |
| **Nombre** | Seguridad del sistema |
| **Tipo** | Restricción |
| **Prioridad** | Alta/Esencial |

- Todas las contraseñas se almacenan con hash **bcrypt** (nunca en texto plano).
- Todos los formularios están protegidos con tokens **CSRF**.
- El acceso al panel de administración está restringido por rol (`ensureAdmin()`); cualquier intento sin autorización devuelve HTTP 403.
- Las rutas de cliente están protegidas con el middleware `auth`.
- Los datos de tarjeta ingresados por el usuario no se almacenan en la base de datos.
- Las transacciones de compra utilizan `lockForUpdate` para evitar condiciones de carrera en el stock.
- La acción de inactivar un usuario administrador requiere verificación adicional de contraseña.

---

#### 3.3.3 Fiabilidad

| Campo | Detalle |
|-------|---------|
| **Número** | RNF-03 |
| **Nombre** | Fiabilidad en el proceso de compra |
| **Tipo** | Restricción |
| **Prioridad** | Alta/Esencial |

El proceso de compra se ejecuta dentro de una transacción de base de datos (`DB::transaction`). Si ocurre cualquier error durante el proceso (stock insuficiente, fallo de escritura), la transacción se revierte completamente, garantizando la integridad de los datos.

---

#### 3.3.4 Disponibilidad

| Campo | Detalle |
|-------|---------|
| **Número** | RNF-04 |
| **Nombre** | Disponibilidad en entorno local |
| **Tipo** | Restricción |
| **Prioridad** | Media/Deseado |

El sistema debe estar disponible durante el horario de uso académico y de evaluación. Al tratarse de un entorno local, la disponibilidad depende del equipo del desarrollador. No se especifica un SLA de uptime para esta etapa del proyecto.

---

#### 3.3.5 Mantenibilidad

| Campo | Detalle |
|-------|---------|
| **Número** | RNF-05 |
| **Nombre** | Mantenibilidad del código |
| **Tipo** | Restricción |
| **Prioridad** | Media/Deseado |

- El sistema sigue la arquitectura **MVC** de Laravel, separando lógica de negocio (Controllers/Services), modelos (Models) y presentación (Blade Views).
- La lógica de configuración de precios está centralizada en `ConfiguracionService`, facilitando su modificación sin afectar otras partes del sistema.
- El sistema utiliza **soft deletes** para usuarios y productos, permitiendo recuperar datos sin intervención directa en la base de datos.

---

#### 3.3.6 Portabilidad

| Campo | Detalle |
|-------|---------|
| **Número** | RNF-06 |
| **Nombre** | Portabilidad del entorno de desarrollo |
| **Tipo** | Restricción |
| **Prioridad** | Media/Deseado |

- El sistema puede ejecutarse en cualquier sistema operativo que soporte PHP 8.4 y MariaDB (Windows, macOS, Linux).
- Las dependencias del proyecto se gestionan exclusivamente mediante **Composer**, lo que permite reproducir el entorno en cualquier máquina con `composer install`.
- La configuración del entorno está aislada en el archivo `.env`, no hardcodeada en el código.

---

### 3.4 Otros requisitos

#### Requisitos de interfaz visual

El sistema debe mantener coherencia visual entre las vistas del frontend (catálogo, carrito, pago) y el panel de administración, utilizando Bootstrap 5 como framework de estilos en toda la aplicación.

#### Requisitos de datos iniciales

El sistema requiere una base de datos inicial (`grupo9.sql`) que incluye la estructura de tablas, roles del sistema (admin, cliente) y datos de prueba. Debe importarse manualmente antes del primer uso.

#### Requisitos de accesibilidad

Las páginas deben funcionar correctamente en los navegadores modernos más utilizados: Chrome, Firefox, Edge y Safari (versiones actuales).

---

## 4 Apéndices

### Apéndice A: Modelo de datos (entidades principales)

| Entidad | Campos principales |
|---------|--------------------|
| `usuarios` | id, nombre, email, password, rol_id, telefono, direccion, ciudad, deleted_at |
| `roles` | id, nombre |
| `productos` | id, nombre, descripcion, categoria, precio_venta, precio_compra, stock, stock_minimo, descuento, imagen, deleted_at |
| `producto_talles` | id, producto_id, talle, stock |
| `carritos` | id, usuario_id, producto_id, talle, cantidad, precio_unitario, total |
| `pedidos` | id, usuario_id, subtotal, total, descuento, recargo, metodo_pago, cuotas, estado, numero_factura |
| `pedido_items` | id, pedido_id, producto_id, talle, cantidad, precio_unitario, total |
| `notificacion_reingresos` | id, usuario_id, producto_id, deleted_at |
| `configuraciones` | id, clave, valor |
| `consultas` | id, (datos del formulario de contacto) |

### Apéndice B: Roles y permisos

| Acción | Visitante | Cliente | Admin |
|--------|-----------|---------|-------|
| Ver catálogo | ✅ | ✅ | ✅ |
| Ver detalle de producto | ✅ | ✅ | ✅ |
| Registrarse / iniciar sesión | ✅ | — | — |
| Gestionar carrito | ❌ | ✅ | ❌ |
| Realizar compra | ❌ | ✅ | ❌ |
| Ver historial de compras | ❌ | ✅ | ❌ |
| Editar perfil | ❌ | ✅ | ✅ |
| Suscribirse a notificaciones | ❌ | ✅ | ❌ |
| Gestionar productos | ❌ | ❌ | ✅ |
| Gestionar usuarios | ❌ | ❌ | ✅ |
| Ver y gestionar pedidos | ❌ | ❌ | ✅ |
| Configurar precios | ❌ | ❌ | ✅ |
| Ver dashboard | ❌ | ❌ | ✅ |

### Apéndice C: Métodos de pago y reglas de validación

| Método | Campos requeridos | Lógica adicional |
|--------|------------------|-----------------|
| Débito | número tarjeta (16 dígitos), titular, vencimiento, CVV | Tarjeta no debe estar vencida |
| Crédito | ídem débito + cuotas (3/6/9/12) | Aplica recargo según cuotas (configurable) |
| Transferencia | número de operación (6 dígitos) | Sin validación adicional |
| MercadoPago | número de operación (6 dígitos) | Aplica descuento (configurable) |

---

*Documento generado para el Proyecto Step & Style — Grupo 9 — Junio 2026*
