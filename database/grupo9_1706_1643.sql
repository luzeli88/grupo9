-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- VersiÃ³n del servidor:         12.2.2-MariaDB - MariaDB Server
-- SO del servidor:              Win64
-- HeidiSQL VersiÃ³n:             12.14.0.7165
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para grupo9

-- Volcando estructura para tabla grupo9.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla grupo9.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla grupo9.carrito
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.carrito: ~1 rows (aproximadamente)
INSERT INTO `carrito` (`id`, `usuario_id`, `producto_id`, `talle`, `cantidad`, `precio_unitario`, `total`, `created_at`, `updated_at`) VALUES
	(25, 2, 16, 37, 1, 123500.00, 123500.00, '2026-06-13 23:32:09', '2026-06-13 23:32:09');

-- Volcando estructura para tabla grupo9.configuraciones
CREATE TABLE IF NOT EXISTS `configuraciones` (
  `clave` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.configuraciones: ~3 rows (aproximadamente)
INSERT INTO `configuraciones` (`clave`, `valor`, `descripcion`, `created_at`, `updated_at`) VALUES
	('descuento_transferencia', '10', 'Descuento por transferencia (%)', '2026-06-13 09:41:41', '2026-06-17 19:19:24'),
	('recargo_credito_6', '5', 'Recargo crÃ©dito hasta 6 cuotas (%)', '2026-06-13 09:41:41', '2026-06-17 19:19:24'),
	('recargo_credito_mas6', '10', 'Recargo crÃ©dito mÃ¡s de 6 cuotas (%)', '2026-06-13 09:41:41', '2026-06-17 19:19:24');

-- Volcando estructura para tabla grupo9.failed_jobs
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

-- Volcando datos para la tabla grupo9.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla grupo9.job_batches
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

-- Volcando datos para la tabla grupo9.job_batches: ~0 rows (aproximadamente)

-- Volcando estructura para tabla grupo9.jobs
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

-- Volcando datos para la tabla grupo9.jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla grupo9.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.migrations: ~20 rows (aproximadamente)
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
	(43, '2026_06_13_061557_create_configuraciones_table', 7);

-- Volcando estructura para tabla grupo9.notificacion_reingresos
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.notificacion_reingresos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla grupo9.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.password_reset_tokens: ~1 rows (aproximadamente)
INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
	('lu.eliana.88@gmail.com', '$2y$12$eU7.UqR/kPUxKgrPW4iH8OIeqyAszxdv2CCydQgxMMSWMB897Xy6i', '2026-06-04 05:29:14');

-- Volcando estructura para tabla grupo9.pedido_items
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.pedido_items: ~5 rows (aproximadamente)
INSERT INTO `pedido_items` (`id`, `pedido_id`, `producto_id`, `talle`, `cantidad`, `precio_unitario`, `total`, `created_at`, `updated_at`) VALUES
	(21, 18, 18, 36, 1, 97500.00, 97500.00, '2026-06-13 23:05:03', '2026-06-13 23:05:03'),
	(22, 18, 21, 38, 1, 91000.00, 91000.00, '2026-06-13 23:05:03', '2026-06-13 23:05:03'),
	(23, 19, 13, 37, 1, 65000.00, 65000.00, '2026-06-13 23:30:50', '2026-06-13 23:30:50'),
	(24, 20, 14, 36, 1, 65000.00, 65000.00, '2026-06-17 19:33:11', '2026-06-17 19:33:11'),
	(25, 21, 17, 35, 1, 71500.00, 71500.00, '2026-06-17 22:08:20', '2026-06-17 22:08:20');

-- Volcando estructura para tabla grupo9.pedidos
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.pedidos: ~20 rows (aproximadamente)
INSERT INTO `pedidos` (`id`, `usuario_id`, `subtotal`, `total`, `descuento`, `recargo`, `metodo_pago`, `cuotas`, `estado`, `numero_factura`, `created_at`, `updated_at`) VALUES
	(1, 1, 0.00, 195000.00, 0.00, 0.00, 'transferencia', NULL, 'enviado', 'FAC-6A20E2C4E6EFF', '2026-06-04 05:28:20', '2026-06-04 05:44:02'),
	(2, 1, 0.00, 945000.00, 0.00, 0.00, 'transferencia', NULL, 'enviado', 'FAC-6A274B9E15B00', '2026-06-09 02:09:18', '2026-06-10 22:02:52'),
	(3, 1, 0.00, 945000.00, 0.00, 0.00, 'tarjeta', NULL, 'enviado', 'FAC-6A274BB6ECC94', '2026-06-09 02:09:42', '2026-06-10 22:02:47'),
	(4, 1, 0.00, 945000.00, 0.00, 0.00, 'debito', NULL, 'enviado', 'FAC-6A27536B331C5', '2026-06-09 02:42:35', '2026-06-10 22:02:42'),
	(5, 1, 0.00, 945000.00, 0.00, 0.00, 'debito', NULL, 'enviado', 'FAC-6A27545819C0C', '2026-06-09 02:46:32', '2026-06-10 22:02:38'),
	(6, 1, 0.00, 945000.00, 0.00, 0.00, 'debito', NULL, 'enviado', 'FAC-6A27547556822', '2026-06-09 02:47:01', '2026-06-10 22:02:33'),
	(7, 1, 0.00, 945000.00, 0.00, 0.00, 'debito', NULL, 'enviado', 'FAC-6A27616B8CEBF', '2026-06-09 03:42:19', '2026-06-10 21:59:43'),
	(8, 1, 0.00, 70200.00, 0.00, 0.00, 'transferencia', NULL, 'enviado', 'FAC-6A27621DC89FD', '2026-06-09 03:45:17', '2026-06-10 21:59:40'),
	(10, 1, 0.00, 70200.00, 0.00, 0.00, 'transferencia', NULL, 'enviado', 'FAC-6A276B3397D14', '2026-06-09 04:24:03', '2026-06-10 21:59:36'),
	(11, 1, 0.00, 70200.00, 0.00, 0.00, 'transferencia', NULL, 'enviado', 'FAC-6A276B532A25F', '2026-06-09 04:24:35', '2026-06-10 21:59:28'),
	(12, 1, 78000.00, 78000.00, 0.00, 0.00, 'debito', NULL, 'finalizada', 'FAC-6A27717279B9A', '2026-06-09 04:50:42', '2026-06-09 04:50:42'),
	(13, 1, 78000.00, 89700.00, 0.00, 11700.00, 'credito', 9, 'finalizada', 'FAC-6A2771B8C2FE7', '2026-06-09 04:51:52', '2026-06-09 04:51:52'),
	(14, 1, 78000.00, 70200.00, 7800.00, 0.00, 'transferencia', NULL, 'finalizada', 'FAC-6A27737F2EB45', '2026-06-09 04:59:27', '2026-06-09 04:59:27'),
	(15, 1, 292500.00, 292500.00, 0.00, 0.00, 'credito', 3, 'finalizada', 'FAC-6A29B09F6E1C5', '2026-06-10 21:44:47', '2026-06-10 21:44:47'),
	(16, 1, 97500.00, 87750.00, 9750.00, 0.00, 'transferencia', NULL, 'finalizada', 'FAC-6A29B0D0A9DFF', '2026-06-10 21:45:36', '2026-06-10 21:45:36'),
	(17, 2, 165000.00, 165000.00, 0.00, 0.00, 'mercadopago', NULL, 'finalizada', 'FAC-6A29B88D35131', '2026-06-10 22:18:37', '2026-06-10 22:18:37'),
	(18, 1, 188500.00, 188500.00, 0.00, 0.00, 'credito', 6, 'finalizada', 'FAC-6A2DB7EF33127', '2026-06-13 23:05:03', '2026-06-13 23:05:03'),
	(19, 2, 65000.00, 58500.00, 6500.00, 0.00, 'transferencia', NULL, 'finalizada', 'FAC-6A2DBDFAED744', '2026-06-13 23:30:50', '2026-06-13 23:30:50'),
	(20, 1, 65000.00, 58500.00, 6500.00, 0.00, 'transferencia', NULL, 'finalizada', 'FAC-6A32CC477721B', '2026-06-17 19:33:11', '2026-06-17 19:33:11'),
	(21, 1, 71500.00, 71500.00, 0.00, 0.00, 'mercadopago', NULL, 'finalizada', 'FAC-6A32F0A4BC355', '2026-06-17 22:08:20', '2026-06-17 22:08:20');

-- Volcando estructura para tabla grupo9.producto_talles
CREATE TABLE IF NOT EXISTS `producto_talles` (
  `producto_id` bigint(20) unsigned NOT NULL,
  `talle` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  UNIQUE KEY `producto_talles_producto_id_talle_unique` (`producto_id`,`talle`),
  CONSTRAINT `producto_talles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.producto_talles: ~96 rows (aproximadamente)
INSERT INTO `producto_talles` (`producto_id`, `talle`, `stock`) VALUES
	(12, 35, 0),
	(12, 36, 0),
	(12, 37, 0),
	(12, 38, 0),
	(12, 39, 0),
	(12, 40, 0),
	(13, 35, 0),
	(13, 36, 0),
	(13, 37, 0),
	(13, 38, 0),
	(13, 39, 0),
	(13, 40, 0),
	(14, 35, 0),
	(14, 36, 0),
	(14, 37, 0),
	(14, 38, 0),
	(14, 39, 0),
	(14, 40, 0),
	(15, 35, 0),
	(15, 36, 0),
	(15, 37, 0),
	(15, 38, 0),
	(15, 39, 0),
	(15, 40, 0),
	(16, 35, 0),
	(16, 36, 0),
	(16, 37, 0),
	(16, 38, 0),
	(16, 39, 0),
	(16, 40, 0),
	(17, 35, 0),
	(17, 36, 0),
	(17, 37, 0),
	(17, 38, 0),
	(17, 39, 0),
	(17, 40, 0),
	(18, 35, 0),
	(18, 36, 0),
	(18, 37, 0),
	(18, 38, 0),
	(18, 39, 0),
	(18, 40, 0),
	(20, 35, 0),
	(20, 36, 0),
	(20, 37, 0),
	(20, 38, 0),
	(20, 39, 0),
	(20, 40, 0),
	(21, 35, 0),
	(21, 36, 0),
	(21, 37, 0),
	(21, 38, 0),
	(21, 39, 0),
	(21, 40, 0),
	(22, 35, 0),
	(22, 36, 0),
	(22, 37, 0),
	(22, 38, 0),
	(22, 39, 0),
	(22, 40, 0),
	(23, 35, 0),
	(23, 36, 0),
	(23, 37, 0),
	(23, 38, 0),
	(23, 39, 0),
	(23, 40, 0),
	(24, 35, 0),
	(24, 36, 0),
	(24, 37, 0),
	(24, 38, 0),
	(24, 39, 0),
	(24, 40, 0),
	(25, 35, 0),
	(25, 36, 0),
	(25, 37, 0),
	(25, 38, 0),
	(25, 39, 0),
	(25, 40, 0),
	(26, 35, 0),
	(26, 36, 0),
	(26, 37, 0),
	(26, 38, 0),
	(26, 39, 0),
	(26, 40, 0),
	(27, 35, 0),
	(27, 36, 0),
	(27, 37, 0),
	(27, 38, 0),
	(27, 39, 0),
	(27, 40, 0),
	(28, 35, 0),
	(28, 36, 0),
	(28, 37, 0),
	(28, 38, 0),
	(28, 39, 0),
	(28, 40, 0);

-- Volcando estructura para tabla grupo9.productos
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.productos: ~16 rows (aproximadamente)
INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `categoria`, `precio_venta`, `precio_compra`, `stock`, `stock_minimo`, `descuento`, `created_at`, `updated_at`, `deleted_at`, `imagen`) VALUES
	(12, 'Bota', 'Bota caÃ±a corta color negro', 'botas', 104000.00, 80000.00, 10, 2, 0.00, '2026-06-13 10:41:13', '2026-06-17 20:17:41', '2026-06-17 20:17:41', 'img/botas/producto_6a2d0999065833.08065565.png'),
	(13, 'Sandalia', 'sandalia', 'sandalias', 65000.00, 50000.00, 9, 2, 0.00, '2026-06-13 10:47:30', '2026-06-13 23:30:50', NULL, 'img/sandalias/producto_6a2d0b12690bc9.41273642.png'),
	(14, 'Zapato', 'mocasin negro', 'zapatos', 65000.00, 50000.00, 6, 2, 0.00, '2026-06-13 10:49:43', '2026-06-17 19:33:12', NULL, 'img/botas/producto_6a2d0b97d62159.61098135.png'),
	(15, 'Bota', 'bota alta negra', 'botas', 117000.00, 90000.00, 10, 10, 0.00, '2026-06-13 10:51:10', '2026-06-13 10:51:10', NULL, 'img/botas/producto_6a2d0bee7d42c5.08419006.png'),
	(16, 'Borcego', 'Borsego negro', 'botas', 123500.00, 95000.00, 10, 2, 0.00, '2026-06-13 10:54:02', '2026-06-13 10:54:28', NULL, 'img/botas/producto_6a2d0cb47f6283.23432277.png'),
	(17, 'Sandalia', 'Sandalia', 'sandalias', 71500.00, 55000.00, 0, 2, 0.00, '2026-06-13 10:56:09', '2026-06-17 22:08:58', '2026-06-17 22:08:58', 'img/sandalias/producto_6a2d0d19681863.00800881.png'),
	(18, 'Sandalia', 'Sansalia plateada', 'sandalias', 97500.00, 75000.00, 9, 2, 0.00, '2026-06-13 10:58:28', '2026-06-13 23:05:03', NULL, 'img/zapatos/producto_6a2d0da49a4be5.67424439.png'),
	(20, 'Sandalia', 'Sansalia', 'sandalias', 78000.00, 60000.00, 10, 2, 0.00, '2026-06-13 11:26:50', '2026-06-13 11:27:36', NULL, 'img/sandalias/producto_6a2d147804fc24.77426341.png'),
	(21, 'Bota', 'Bota', 'botas', 91000.00, 70000.00, 9, 2, 0.00, '2026-06-13 11:29:19', '2026-06-13 23:05:03', NULL, 'img/botas/producto_6a2d14f17d93c2.16054532.png'),
	(22, 'mocasines', 'Zapato', 'zapatos', 65000.00, 50000.00, 10, 2, 0.00, '2026-06-13 11:33:26', '2026-06-13 11:34:04', NULL, 'img/zapatos/producto_6a2d15fc56c035.28635464.png'),
	(23, 'mocasines', 'Zapato', 'zapatos', 65000.00, 50000.00, 10, 2, 0.00, '2026-06-13 11:37:12', '2026-06-13 11:37:39', NULL, 'img/zapatos/producto_6a2d16d3182fd2.76514680.png'),
	(24, 'Sandalia', 'Sandalia', 'sandalias', 78000.00, 60000.00, 10, 2, 0.00, '2026-06-13 11:40:51', '2026-06-13 11:40:51', NULL, 'img/sandalias/producto_6a2d1793149068.54965203.png'),
	(25, 'Bota', 'Bota marron de cuero', 'botas', 91000.00, 70000.00, 10, 2, 0.00, '2026-06-13 11:45:45', '2026-06-13 11:45:45', NULL, 'img/botas/producto_6a2d18b9afc201.91996995.png'),
	(26, 'Stileto', 'Estileto negro', 'zapatos', 104000.00, 80000.00, 10, 2, 0.00, '2026-06-13 22:27:32', '2026-06-13 22:27:32', NULL, 'img/zapatos/producto_6a2daf24ae3f87.72137828.png'),
	(27, 'Stileto', 'Estileto Rojo', 'zapatos', 91000.00, 70000.00, 10, 2, 0.00, '2026-06-13 22:31:39', '2026-06-13 22:31:39', NULL, 'img/zapatos/producto_6a2db01b3d06b8.88064072.png'),
	(28, 'Zapato', 'Zapato', 'zapatos', 58500.00, 45000.00, 10, 2, 0.00, '2026-06-13 22:48:32', '2026-06-13 22:48:32', NULL, 'img/zapatos/producto_6a2db41057e987.53911249.png');

-- Volcando estructura para tabla grupo9.roles
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

-- Volcando datos para la tabla grupo9.roles: ~2 rows (aproximadamente)
INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'cliente', 'Cliente registrado', '2026-05-26 03:15:06', '2026-05-26 03:15:06', NULL),
	(2, 'admin', 'Administrador', '2026-05-26 03:18:44', '2026-05-26 03:18:44', NULL);

-- Volcando estructura para tabla grupo9.sessions
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

-- Volcando datos para la tabla grupo9.sessions: ~2 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('ipUWqs4ExRiB1ZkiljpagKzS1cWMtcLNZGSwpNZL', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJQM2Z2cHphSlQ5UlhtV0Zaek43MmUxRW0yS3pCektCMUtKcTBnOVZUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2dydXBvOS50ZXN0XC9mYWN0dXJhXC8yMSIsInJvdXRlIjoiZmFjdHVyYSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjozfQ==', 1781723474),
	('NG0IJBJ9Kg4FrfaBUjWQPqsLOaej3xkc9PRQRcE8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ0a3Z5VWxVWmo5MGxsMFZqb2V2NHBKdTJCWmdEMDUxOTkyUVphdVJvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2dydXBvOS50ZXN0XC9sb2dvdXQiLCJyb3V0ZSI6ImxvZ291dCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1781716576);

-- Volcando estructura para tabla grupo9.users
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

-- Volcando datos para la tabla grupo9.users: ~0 rows (aproximadamente)

-- Volcando estructura para tabla grupo9.usuarios
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla grupo9.usuarios: ~6 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `telefono`, `direccion`, `ciudad`) VALUES
	(1, 'Luz', 'lu.eliana.88@gmail.com', '$2y$12$KU3BXOICjXJBs79R8mkjmOQ0DXSeXVPVF/yago435nZnq236wgjcK', 1, NULL, '2026-05-26 03:15:06', '2026-06-11 04:39:50', NULL, '03794112233', 'Junin 980', 'Corrientes'),
	(2, 'Maria Gomez', 'mariaG@gmail.com', '$2y$12$8N9Gf1CrfI1jzu2jlIlfxOZD2S4wKI60H3FKbyMuGg4VOXEda4Y9S', 1, NULL, '2026-05-26 03:16:34', '2026-06-11 04:37:26', NULL, '03794112244', 'San Martin', 'Corrientes'),
	(3, 'Administrador', 'anfran06@gmail.com', '$2y$12$RJr3ghvyQYprxy326dFwkuVPSaxXstDTi3e6SwE0zaLIUql/m4HNm', 2, NULL, '2026-05-26 03:18:45', '2026-05-26 03:18:45', NULL, NULL, NULL, NULL),
	(4, 'Juan PÃ©rez', 'juan@example.com', '$2y$12$lcNNdAWCfeoP69diGpiEruvsPJzHObUV/wr35DA78hBiCRRKbY/Pa', 1, NULL, '2026-05-26 03:22:40', '2026-05-26 03:22:40', NULL, NULL, NULL, NULL),
	(5, 'MarÃ­a GarcÃ­a', 'maria@example.com', '$2y$12$OLyc7/Flw5ccNOVavCxgbOSMDxVK7vtXh5lTWTpO8m1jWW38jQekm', 1, NULL, '2026-05-26 03:22:41', '2026-05-26 03:22:41', NULL, NULL, NULL, NULL),
	(6, 'Carlos LÃ³pez', 'carlos@example.com', '$2y$12$/HVYW8eQVm2vX2ZGkr2JS.fgeXY6CBnHxSJTDAebaJ4cY7fbCi1bK', 1, NULL, '2026-05-26 03:22:41', '2026-05-26 03:22:41', NULL, NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
