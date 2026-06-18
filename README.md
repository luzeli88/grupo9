# Step & Style 👟

Plataforma de e-commerce de calzado desarrollada con **Laravel 13** y **PHP 8.4**. Permite a los clientes explorar productos por categoría, gestionar un carrito de compras y realizar pagos con distintos métodos. 
Los administradores cuentan con un panel completo para gestionar productos, usuarios, pedidos (ventas) y configuración de precios (porcentajes de descuentos o recargos segun el método de pago).

---

## Tecnologías utilizadas

- PHP 8.4
- Laravel 13
- MariaDB (base de datos local)
- Bootstrap 
- Blade (motor de plantillas)

---

## Requisitos previos

Antes de instalar el proyecto asegurate de tener instalado:

- [PHP 8.4](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [Laravel Herd](https://herd.laravel.com/) o cualquier servidor local compatible (XAMPP, Laragon, etc.)
- [MariaDB](https://mariadb.org/download/) o MySQL
- [HeidiSQL](https://www.heidisql.com/) o cualquier cliente de base de datos

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone  https://github.com/luzeli88/grupo9.git 
cd grupo9.git
```

### 2. Configurar el archivo de entorno `.env`

El proyecto incluye un archivo `.env.example` que contiene la estructura de configuración necesaria. El `.env` real **no se sube al repositorio** por seguridad, ya que contiene credenciales sensibles como contraseñas de base de datos y claves de la aplicación.

```bash
cp .env.example .env
```

Luego editá el `.env` con tus datos locales:

```env
APP_NAME=Laravel
APP_URL=http://grupo9.test

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=grupo9
DB_USERNAME=root
DB_PASSWORD= 1234
```

### 3. Instalar dependencias con Composer

```bash
composer install
```

Si el comando falla o da errores de versión, probá con:

```bash
composer install --ignore-platform-reqs
```

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Crear el enlace de almacenamiento público

```bash
php artisan storage:link
```

---

(Si mi compañera es la que desea abrir el proyecto y traer los últimos cambios, solo necesita ejecutar en la terminal dentro de la carpeta del proyecto:
```bash
git pull
```
Y si en los nuevos cambios se agregaron dependencias nuevas:
```bash
composer install
```
Para la base de datos depende de qué cambió:
Si solo se agregaron o modificaron datos (no la estructura) → importa el grupo9.sql nuevamente desde HeidiSQL como la primera vez, reemplazando la base de datos existente.
Si se agregaron migraciones nuevas → en lugar de reimportar todo el .sql puede correr solo:
```bash
php artisan migrate
```)
## Base de datos

El proyecto usa **MariaDB como base de datos local**. Al ser local, cada desarrollador debe crearla manualmente en su entorno.

### Cómo acceder a la base de datos

1. Abrí HeidiSQL y conectate al servidor local
2. Clic derecho en el panel izquierdo → Crear nueva base de datos → nombre grupo9
3. Seleccioná la base de datos grupo9 haciendo doble clic
4. Arriba en el menú → Archivo → Ejecutar archivo SQL
5. Navegá hasta la carpeta del proyecto → database/ → seleccioná grupo9.sql
Clic en Abrir y esperá que termine la importación

Listo, con eso tiene toda la estructura y los datos. No necesita correr php artisan migrate ni nada extra porque el .sql ya contiene todo.

## Uso

### Roles disponibles

| Rol | Acceso |
|-----|--------|
| `cliente` | Panel de cliente, carrito, compras, historial |
| `admin` | Panel de administración completo |

### Funcionalidades principales

**Clientes:**
- Explorar productos por categoría (botas, sandalias, zapatos)
- Agregar productos al carrito seleccionando talle
- Realizar pagos con débito, crédito, transferencia o MercadoPago
- Ver historial de compras y facturas
- Recibir notificaciones cuando un producto sin stock vuelve a estar disponible

**Administradores:**
- Gestión completa de productos (crear, editar, activar/inactivar)
- Gestión de usuarios con filtros y edición de datos
- Visualización y seguimiento de pedidos
- Configuración de porcentajes de descuento y recargo por método de pago

---
## Equipo

Desarrollado por el **Grupo 9** — 2026




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
