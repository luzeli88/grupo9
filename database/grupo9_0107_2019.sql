/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `grupo9` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `grupo9`;

CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `carrito` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `talle` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precio_unitario` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carrito_usuario_id_foreign` (`usuario_id`),
  KEY `carrito_producto_id_foreign` (`producto_id`),
  CONSTRAINT `carrito_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carrito_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `carrito` (`id`, `usuario_id`, `producto_id`, `talle`, `cantidad`, `precio_unitario`, `total`, `created_at`, `updated_at`) VALUES
	(25, 2, 16, 37, 1, 123500.00, 123500.00, '2026-06-13 23:32:09', '2026-06-13 23:32:09'),
	(27, 1, 13, 37, 1, 65000.00, 65000.00, '2026-06-19 07:11:45', '2026-06-19 07:11:45');

CREATE TABLE IF NOT EXISTS `configuraciones` (
  `clave` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `configuraciones` (`clave`, `valor`, `descripcion`, `created_at`, `updated_at`) VALUES
	('descuento_transferencia', '10', 'Descuento por transferencia (%)', '2026-06-13 09:41:41', '2026-07-02 01:59:59'),
	('recargo_credito_6', '6', 'Recargo crédito hasta 6 cuotas (%)', '2026-06-13 09:41:41', '2026-07-02 01:59:59'),
	('recargo_credito_mas6', '10', 'Recargo crédito más de 6 cuotas (%)', '2026-06-13 09:41:41', '2026-07-02 01:59:59');

CREATE TABLE IF NOT EXISTS `consultas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `consultas` (`id`, `nombre`, `email`, `mensaje`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'Luz Eliana Espindola', 'lu.eliana.88@gmail.com', 'hola', 'pendiente', '2026-06-19 05:36:32', '2026-06-19 05:36:32'),
	(3, 'Juan Perez', 'juan@example.com', 'Envian a resistencia chaco?', 'pendiente', '2026-06-19 22:16:19', '2026-06-19 22:16:19'),
	(4, 'laura gomez', 'lauragomez@gmail.com', 'Hacen envios cordoba?', 'pendiente', '2026-07-02 01:02:49', '2026-07-02 01:02:49');

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(21, '0001_01_01_000000_create_users_table', 1),
	(22, '0001_01_01_000001_create_cache_table', 1),
	(23, '0001_01_01_000002_create_jobs_table', 1),
	(24, '2026_05_13_015453_create_productos_table', 1),
	(25, '2026_05_15_185017_create_rols_table', 1),
	(26, '2026_05_15_185141_create_usuarios_table', 1),
	(27, '2026_05_22_182602_add_campos_to_users_table', 1),
	(28, '2026_05_22_184746_add_campos_to_users_table', 1),
	(29, '2026_05_24_175213_create_carrito_table', 1),
	(30, '2026_05_24_180623_add_imagen_to_productos_table', 1),
	(31, '2026_05_25_233142_add_campos_to_usuarios_table', 1),
	(32, '2026_05_25_234122_agregar_campos_a_productos_table', 1),
	(33, '2026_06_03_032059_create_notificacion_reingresos_table', 2),
	(36, '2026_05_28_212902_add_talle_to_carrito_table', 3),
	(37, '2026_05_28_221847_create_pedidos_table', 3),
	(38, '2026_05_28_221848_create_pedido_items_table', 3),
	(40, '2026_06_03_create_notificacion_reingresos_table', 4),
	(41, '2026_05_28_212548_create_producto_talles_table', 5),
	(42, '2026_06_08_210000_add_pago_detalles_to_pedidos_table', 6),
	(43, '2026_06_13_061557_create_configuraciones_table', 7),
	(44, '2026_06_12_191409_create_consultas_table', 8);

CREATE TABLE IF NOT EXISTS `notificacion_reingresos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned DEFAULT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_notificado` timestamp NULL DEFAULT NULL,
  `notificado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notificacion_reingresos_usuario_id_foreign` (`usuario_id`),
  KEY `notificacion_reingresos_producto_id_foreign` (`producto_id`),
  CONSTRAINT `notificacion_reingresos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notificacion_reingresos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `notificacion_reingresos` (`id`, `usuario_id`, `producto_id`, `email`, `fecha_solicitud`, `fecha_notificado`, `notificado`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(5, 1, 23, 'lu.eliana.88@gmail.com', '2026-06-19 02:44:43', NULL, 0, '2026-06-19 05:44:43', '2026-06-19 05:44:43', NULL),
	(6, 1, 15, 'lu.eliana.88@gmail.com', '2026-06-19 03:54:47', NULL, 0, '2026-06-19 06:54:47', '2026-06-19 06:54:47', NULL),
	(7, 1, 14, 'lu.eliana.88@gmail.com', '2026-06-19 03:55:08', NULL, 0, '2026-06-19 06:55:08', '2026-06-19 06:55:08', NULL),
	(8, 1, 22, 'lu.eliana.88@gmail.com', '2026-06-19 03:59:34', NULL, 0, '2026-06-19 06:59:34', '2026-06-19 06:59:34', NULL),
	(9, 1, 13, 'lu.eliana.88@gmail.com', '2026-06-19 04:00:01', NULL, 0, '2026-06-19 07:00:01', '2026-06-19 07:00:01', NULL),
	(10, 3, 13, 'anfran06@gmail.com', '2026-06-19 17:58:38', NULL, 0, '2026-06-19 20:58:38', '2026-06-19 20:58:38', NULL);

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
	('juan@example.com', '$2y$12$kEp58jYZuecoT3q8Rm8ICOAhwmQOY.Gsi.7mEC4ZJZSaR4bBsfMRy', '2026-06-24 02:27:57'),
	('lu.eliana.88@gmail.com', '$2y$12$eU7.UqR/kPUxKgrPW4iH8OIeqyAszxdv2CCydQgxMMSWMB897Xy6i', '2026-06-04 05:29:14');

CREATE TABLE IF NOT EXISTS `pedido_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `talle` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_items_pedido_id_foreign` (`pedido_id`),
  KEY `pedido_items_producto_id_foreign` (`producto_id`),
  CONSTRAINT `pedido_items_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pedido_items_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pedido_items` (`id`, `pedido_id`, `producto_id`, `talle`, `cantidad`, `precio_unitario`, `total`, `created_at`, `updated_at`) VALUES
	(1, 1, 12, 36, 1, 104000.00, 104000.00, '2026-06-19 23:34:40', '2026-06-19 23:34:40'),
	(2, 1, 17, 36, 1, 71500.00, 71500.00, '2026-06-19 23:34:40', '2026-06-19 23:34:40'),
	(3, 2, 20, 37, 1, 78000.00, 78000.00, '2026-06-19 23:36:48', '2026-06-19 23:36:48'),
	(4, 3, 15, 37, 1, 117000.00, 117000.00, '2026-06-19 23:39:54', '2026-06-19 23:39:54'),
	(5, 4, 14, 36, 1, 65000.00, 65000.00, '2026-06-20 00:01:01', '2026-06-20 00:01:01'),
	(6, 5, 21, 37, 1, 91000.00, 91000.00, '2026-06-20 00:09:49', '2026-06-20 00:09:49'),
	(7, 6, 12, 37, 1, 104000.00, 104000.00, '2026-06-20 00:25:38', '2026-06-20 00:25:38'),
	(8, 7, 26, 36, 1, 104000.00, 104000.00, '2026-06-20 00:54:12', '2026-06-20 00:54:12'),
	(9, 8, 12, 36, 1, 104000.00, 104000.00, '2026-06-24 00:59:48', '2026-06-24 00:59:48'),
	(10, 9, 14, 36, 1, 65000.00, 65000.00, '2026-06-24 22:26:10', '2026-06-24 22:26:10'),
	(11, 9, 16, 37, 1, 123500.00, 123500.00, '2026-06-24 22:26:10', '2026-06-24 22:26:10'),
	(12, 10, 12, 37, 2, 104000.00, 208000.00, '2026-07-02 01:05:58', '2026-07-02 01:05:58'),
	(13, 11, 14, 37, 1, 65000.00, 65000.00, '2026-07-02 01:07:09', '2026-07-02 01:07:09');

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL DEFAULT 0.00,
  `recargo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `metodo_pago` varchar(255) NOT NULL,
  `cuotas` int(11) DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'pendiente',
  `numero_factura` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pedidos_numero_factura_unique` (`numero_factura`),
  KEY `pedidos_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `pedidos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pedidos` (`id`, `usuario_id`, `subtotal`, `total`, `descuento`, `recargo`, `metodo_pago`, `cuotas`, `estado`, `numero_factura`, `created_at`, `updated_at`) VALUES
	(1, 4, 175500.00, 157950.00, 17550.00, 0.00, 'transferencia', NULL, 'finalizada', 'FAC-6A35A7E0D3A8B', '2026-06-19 23:34:40', '2026-06-19 23:34:40'),
	(2, 4, 78000.00, 81900.00, 0.00, 3900.00, 'credito', 3, 'finalizada', 'FAC-6A35A860CC231', '2026-06-19 23:36:48', '2026-06-19 23:36:48'),
	(3, 7, 117000.00, 117000.00, 0.00, 0.00, 'mercadopago', NULL, 'finalizada', 'FAC-6A35A91A047FF', '2026-06-19 23:39:54', '2026-06-19 23:39:54'),
	(4, 7, 65000.00, 58500.00, 6500.00, 0.00, 'transferencia', NULL, 'finalizada', 'FAC-6A35AE0D81BD7', '2026-06-20 00:01:01', '2026-06-20 00:01:01'),
	(5, 4, 91000.00, 91000.00, 0.00, 0.00, 'mercadopago', NULL, 'finalizada', 'FAC-6A35B01D3F5D1', '2026-06-20 00:09:49', '2026-06-20 00:09:49'),
	(6, 4, 104000.00, 93600.00, 10400.00, 0.00, 'transferencia', NULL, 'finalizada', 'FAC-6A35B3D270860', '2026-06-20 00:25:38', '2026-06-20 00:25:38'),
	(7, 7, 104000.00, 104000.00, 0.00, 0.00, 'mercadopago', NULL, 'finalizada', 'FAC-6A35BA84A66CA', '2026-06-20 00:54:12', '2026-06-20 00:54:12'),
	(8, 8, 104000.00, 93600.00, 10400.00, 0.00, 'transferencia', NULL, 'finalizada', 'FAC-6A3B01D49A421', '2026-06-24 00:59:48', '2026-06-24 00:59:48'),
	(9, 4, 188500.00, 169650.00, 18850.00, 0.00, 'transferencia', NULL, 'finalizada', 'FAC-6A3C2F528624C', '2026-06-24 22:26:10', '2026-06-24 22:26:10'),
	(10, 4, 208000.00, 208000.00, 0.00, 0.00, 'mercadopago', NULL, 'finalizado', 'FAC-6A458F469A3FB', '2026-07-02 01:05:58', '2026-07-02 01:40:21'),
	(11, 4, 65000.00, 58500.00, 6500.00, 0.00, 'transferencia', NULL, 'pendiente', 'FAC-6A458F8D8D61D', '2026-07-02 01:07:09', '2026-07-02 01:07:09');

CREATE TABLE IF NOT EXISTS `producto_talles` (
  `producto_id` bigint(20) unsigned NOT NULL,
  `talle` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  UNIQUE KEY `producto_talles_producto_id_talle_unique` (`producto_id`,`talle`),
  CONSTRAINT `producto_talles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `producto_talles` (`producto_id`, `talle`, `stock`) VALUES
	(12, 35, 3),
	(12, 36, 2),
	(12, 37, 1),
	(12, 38, 3),
	(12, 39, 3),
	(12, 40, 3),
	(13, 35, 3),
	(13, 36, 3),
	(13, 37, 3),
	(13, 38, 3),
	(13, 39, 3),
	(13, 40, 3),
	(14, 35, 3),
	(14, 36, 2),
	(14, 37, 2),
	(14, 38, 3),
	(14, 39, 3),
	(14, 40, 3),
	(15, 35, 2),
	(15, 36, 3),
	(15, 37, 3),
	(15, 38, 3),
	(15, 39, 3),
	(15, 40, 3),
	(16, 35, 3),
	(16, 36, 3),
	(16, 37, 2),
	(16, 38, 3),
	(16, 39, 3),
	(16, 40, 3),
	(17, 35, 3),
	(17, 36, 3),
	(17, 37, 3),
	(17, 38, 3),
	(17, 39, 3),
	(17, 40, 3),
	(18, 35, 3),
	(18, 36, 3),
	(18, 37, 3),
	(18, 38, 3),
	(18, 39, 3),
	(18, 40, 3),
	(20, 35, 3),
	(20, 36, 3),
	(20, 37, 3),
	(20, 38, 3),
	(20, 39, 3),
	(20, 40, 3),
	(21, 35, 3),
	(21, 36, 3),
	(21, 37, 3),
	(21, 38, 3),
	(21, 39, 3),
	(21, 40, 3),
	(22, 35, 3),
	(22, 36, 3),
	(22, 37, 3),
	(22, 38, 3),
	(22, 39, 3),
	(22, 40, 3),
	(23, 35, 3),
	(23, 36, 3),
	(23, 37, 3),
	(23, 38, 3),
	(23, 39, 3),
	(23, 40, 3),
	(25, 35, 3),
	(25, 36, 3),
	(25, 37, 3),
	(25, 38, 3),
	(25, 39, 3),
	(25, 40, 3),
	(26, 35, 3),
	(26, 36, 2),
	(26, 37, 3),
	(26, 38, 3),
	(26, 39, 3),
	(26, 40, 3),
	(27, 35, 3),
	(27, 36, 3),
	(27, 37, 3),
	(27, 38, 3),
	(27, 39, 3),
	(27, 40, 3),
	(28, 35, 3),
	(28, 36, 3),
	(28, 37, 3),
	(28, 38, 3),
	(28, 39, 3),
	(28, 40, 3),
	(29, 35, 3),
	(29, 36, 3),
	(29, 37, 3),
	(29, 38, 3),
	(29, 39, 3),
	(29, 40, 3),
	(30, 35, 3),
	(30, 36, 3),
	(30, 37, 3),
	(30, 38, 3),
	(30, 39, 3),
	(30, 40, 3);

CREATE TABLE IF NOT EXISTS `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `precio_venta` decimal(8,2) NOT NULL,
  `precio_compra` decimal(8,2) NOT NULL,
  `stock` int(10) unsigned NOT NULL DEFAULT 0,
  `stock_minimo` int(10) unsigned NOT NULL DEFAULT 1,
  `descuento` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `categoria`, `precio_venta`, `precio_compra`, `stock`, `stock_minimo`, `descuento`, `created_at`, `updated_at`, `deleted_at`, `imagen`) VALUES
	(12, 'Bota Esparta Negro', 'Bota caña corta color negro', 'botas', 52000.00, 40000.00, 15, 2, 0.00, '2026-06-13 10:41:13', '2026-07-02 01:36:47', NULL, 'img/botas/producto_6a2d0999065833.08065565.png'),
	(13, 'Sandalia Naina Beige', 'sandalia beige', 'sandalias', 65000.00, 50000.00, 18, 2, 0.00, '2026-06-13 10:47:30', '2026-06-20 00:15:56', NULL, 'img/sandalias/producto_6a2d0b12690bc9.41273642.png'),
	(14, 'Zapato Cordoba Negro', 'mocasin negro', 'zapatos', 65000.00, 50000.00, 16, 2, 0.00, '2026-06-13 10:49:43', '2026-07-02 01:07:09', NULL, 'img/zapatos/producto_6a35a44b62cdb0.07904595.png'),
	(15, 'Bota Isadora negra', 'bota alta negra', 'botas', 117000.00, 90000.00, 17, 2, 0.00, '2026-06-13 10:51:10', '2026-06-20 00:17:10', NULL, 'img/botas/producto_6a35a1dd3334b8.54461016.png'),
	(16, 'Borcego Berlin Negro', 'Borcego negro', 'botas', 123500.00, 95000.00, 17, 2, 0.00, '2026-06-13 10:54:02', '2026-06-24 22:26:10', NULL, 'img/botas/producto_6a2d0cb47f6283.23432277.png'),
	(17, 'Sandalia Naina Marron', 'Sandalia marron', 'sandalias', 71500.00, 55000.00, 18, 2, 0.00, '2026-06-13 10:56:09', '2026-06-20 00:18:03', NULL, 'img/sandalias/producto_6a2d0d19681863.00800881.png'),
	(18, 'Sandalia Sofia plata', 'Sandalia plateada', 'sandalias', 97500.00, 75000.00, 18, 2, 0.00, '2026-06-13 10:58:28', '2026-06-19 23:54:19', NULL, 'img/sandalias/producto_6a35a3373af378.10088531.png'),
	(20, 'Sandalia Perla Beige', 'Sandalia beige', 'sandalias', 78000.00, 60000.00, 18, 2, 0.00, '2026-06-13 11:26:50', '2026-06-19 23:36:48', NULL, 'img/sandalias/producto_6a35a3a641d605.70990477.png'),
	(21, 'Bota Lara Marron', 'bota marron', 'botas', 91000.00, 70000.00, 18, 2, 0.00, '2026-06-13 11:29:19', '2026-06-20 00:19:16', NULL, 'img/botas/producto_6a2d14f17d93c2.16054532.png'),
	(22, 'Zapato Lina Marron', 'Zapato mocasin marron', 'zapatos', 65000.00, 50000.00, 18, 2, 0.00, '2026-06-13 11:33:26', '2026-06-20 00:19:46', NULL, 'img/zapatos/producto_6a2d15fc56c035.28635464.png'),
	(23, 'Zapato Lina Rosa', 'Zapato mocasin rosa', 'zapatos', 65000.00, 50000.00, 18, 2, 0.00, '2026-06-13 11:37:12', '2026-06-20 00:20:29', NULL, 'img/zapatos/producto_6a2d16d3182fd2.76514680.png'),
	(25, 'Bota Norte Camel', 'Bota camel de cuero', 'botas', 91000.00, 70000.00, 18, 2, 0.00, '2026-06-13 11:45:45', '2026-06-20 00:21:26', NULL, 'img/botas/producto_6a2d18b9afc201.91996995.png'),
	(26, 'Stiletto Violeta Negro', 'Stiletto negro', 'zapatos', 104000.00, 80000.00, 17, 2, 0.00, '2026-06-13 22:27:32', '2026-06-24 01:03:16', '2026-06-24 01:03:16', 'img/zapatos/producto_6a2daf24ae3f87.72137828.png'),
	(27, 'Stiletto Diva Rojo', 'Stiletto Rojo', 'zapatos', 91000.00, 70000.00, 18, 2, 0.00, '2026-06-13 22:31:39', '2026-06-20 00:22:31', NULL, 'img/zapatos/producto_6a2db01b3d06b8.88064072.png'),
	(28, 'Zapato Nara Beige', 'Zapato tacos beige', 'zapatos', 58500.00, 45000.00, 18, 2, 0.00, '2026-06-13 22:48:32', '2026-06-20 00:23:30', NULL, 'img/zapatos/producto_6a2db41057e987.53911249.png'),
	(29, 'Bota Norte Negro', 'bota negra', 'botas', 84500.00, 65000.00, 18, 2, 0.00, '2026-06-19 23:45:07', '2026-06-20 00:24:07', NULL, 'img/botas/producto_6a35aa53acb454.15119786.webp'),
	(30, 'Sandalia Maria', 'Sandalia blanca', 'sandalias', 19500.00, 15000.00, 18, 2, 0.00, '2026-07-02 01:35:42', '2026-07-02 01:35:42', NULL, 'img/sandalias/producto_6a45963e10b590.22516141.webp');

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'cliente', 'Cliente registrado', '2026-05-26 03:15:06', '2026-05-26 03:15:06', NULL),
	(2, 'admin', 'Administrador', '2026-05-26 03:18:44', '2026-05-26 03:18:44', NULL);

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('EpmMmbWnyYUBlJcFp7H0WrmEAVxpFDJa1E39sXj6', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJKeXduTmF6RkVVaWZrdENuSE9BMTYyajhEcUZGc1V1S25veEVVWTRrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2dydXBvOS50ZXN0XC9hZG1pbiIsInJvdXRlIjoiYWRtaW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=', 1782947060);

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` bigint(20) unsigned NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  KEY `usuarios_rol_id_foreign` (`rol_id`),
  CONSTRAINT `usuarios_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `telefono`, `direccion`, `ciudad`) VALUES
	(1, 'Luz Eliana Espindola', 'lu.eliana.88@gmail.com', '$2y$12$KU3BXOICjXJBs79R8mkjmOQ0DXSeXVPVF/yago435nZnq236wgjcK', 1, NULL, '2026-05-26 03:15:06', '2026-06-19 05:44:01', NULL, '03794112233', 'Junin 980', 'Corrientes'),
	(2, 'Maria Gomez', 'mariaG@gmail.com', '$2y$12$8N9Gf1CrfI1jzu2jlIlfxOZD2S4wKI60H3FKbyMuGg4VOXEda4Y9S', 1, NULL, '2026-05-26 03:16:34', '2026-06-11 04:37:26', NULL, '03794112244', 'San Martin', 'Corrientes'),
	(3, 'Administrador', 'anfran06@gmail.com', '$2y$12$RJr3ghvyQYprxy326dFwkuVPSaxXstDTi3e6SwE0zaLIUql/m4HNm', 2, NULL, '2026-05-26 03:18:45', '2026-05-26 03:18:45', NULL, NULL, NULL, NULL),
	(4, 'Juan Perez', 'juan@example.com', '$2y$12$lcNNdAWCfeoP69diGpiEruvsPJzHObUV/wr35DA78hBiCRRKbY/Pa', 1, NULL, '2026-05-26 03:22:40', '2026-07-02 01:04:28', NULL, '3795677689', 'Cuba 5446', 'Corrientes'),
	(5, 'Maria Garcia', 'maria@example.com', '$2y$12$OLyc7/Flw5ccNOVavCxgbOSMDxVK7vtXh5lTWTpO8m1jWW38jQekm', 1, NULL, '2026-05-26 03:22:41', '2026-06-19 23:41:16', '2026-06-19 23:41:16', NULL, NULL, NULL),
	(6, 'Carlos Lopez', 'carlos@example.com', '$2y$12$/HVYW8eQVm2vX2ZGkr2JS.fgeXY6CBnHxSJTDAebaJ4cY7fbCi1bK', 1, NULL, '2026-05-26 03:22:41', '2026-06-19 23:41:07', '2026-06-19 23:41:07', NULL, NULL, NULL),
	(7, 'Laura Laura Gomez', 'lauragomez@gmail.com', '$2y$12$PyT7mvrSXGz5AscRqxVryeyM4nlaB2mhg1owRN1b3lceRxJ9mXS12', 1, NULL, '2026-06-19 23:38:56', '2026-06-19 23:38:56', NULL, '3782343456', 'Junin 879', 'Corrientes'),
	(8, 'Maria Gonzalez', 'mariagonzalez@gmail.com', '$2y$12$p5zs6J/ved318o7BPBjklueCnIA4GV.7lXwNYHDDvna.YGLj8ZvUi', 1, NULL, '2026-06-24 00:57:35', '2026-06-24 00:58:53', NULL, '3794343456', 'españa 769', 'Corrientes');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
