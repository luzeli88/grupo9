# Step & Style

Plataforma de e-commerce de calzado desarrollada con **Laravel 13** y **PHP 8.4**. Permite a los clientes explorar productos por categoría, gestionar un carrito de compras y realizar pagos con distintos métodos.
Los administradores cuentan con un panel completo para gestionar productos, usuarios, pedidos (ventas) y configuración de precios (porcentajes de descuentos o recargos según el método de pago).

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
git clone https://github.com/luzeli88/grupo9.git
cd grupo9
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
DB_PASSWORD=
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

## Base de datos

El proyecto usa **MariaDB como base de datos local**. Al ser local, cada desarrollador debe crearla manualmente en su entorno.

El dump de la base de datos se encuentra en la carpeta `database/` del proyecto, con el archivo `grupo9_0107_2019.sql`. Este archivo contiene toda la estructura y los datos de prueba necesarios para ejecutar la aplicación.

### Cómo importar la base de datos (HeidiSQL)

1. Abrí HeidiSQL y conectate al servidor local
2. Clic derecho en el panel izquierdo → Crear nueva base de datos → nombre `grupo9`
3. Seleccioná la base de datos `grupo9` haciendo doble clic
4. Arriba en el menú → Archivo → Ejecutar archivo SQL
5. Navegá hasta la carpeta del proyecto → `database/` → seleccioná `grupo9_0107_2019.sql`
6. Clic en Abrir y esperá que termine la importación

Listo, con eso tiene toda la estructura y los datos. No necesita correr `php artisan migrate` ni nada extra porque el `.sql` ya contiene todo.

---

## Actualizar el entorno de trabajo

Si otro integrante del equipo quiere traer los últimos cambios, solo necesita ejecutar dentro de la carpeta del proyecto:

```bash
git pull
```

Si en los nuevos cambios se agregaron dependencias:

```bash
composer install
```

Para la base de datos, depende de qué cambió:

- Si solo se modificaron datos → importar `grupo9_0107_2019.sql` nuevamente desde HeidiSQL, reemplazando la base de datos existente.
- Si se agregaron migraciones nuevas → correr solo:

```bash
php artisan migrate
```

---

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

## Solución de problemas frecuentes

### Error: `No application encryption key has been specified`

Ocurre cuando `APP_KEY` está vacío en el `.env`. Solucioná corriendo:

```bash
php artisan key:generate
```

### Error de conexión a la base de datos

Verificá que en el `.env` tengas:

```env
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=grupo9
DB_USERNAME=root
DB_PASSWORD=
```

Asegurate de que MariaDB esté corriendo y de que la base de datos `grupo9` exista antes de importar el dump.

### Error: `Class "PDO" not found` o `could not find driver`

La extensión `pdo_mysql` de PHP no está habilitada. En XAMPP/Laragon habilitala desde el `php.ini` descomentando:

```
extension=pdo_mysql
```

### Error: `Target class [SomeClass] does not exist` o 500 al arrancar

Probá limpiar la caché de configuración:

```bash
php artisan config:clear
php artisan cache:clear
```

### Las imágenes no se ven / Error en `storage/`

El enlace simbólico de almacenamiento no está creado. Corré:

```bash
php artisan storage:link
```

### Error de Composer: `Your requirements could not be resolved`

Si hay conflictos de versiones de PHP, usá:

```bash
composer install --ignore-platform-reqs
```

---

## Equipo

Desarrollado por el **Grupo 9** — 2026
