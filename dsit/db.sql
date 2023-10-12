-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla carrera_senek.answers: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.categories: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.configs: ~2 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.failed_jobs: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.fondos: ~2.325 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.id_types: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.inscriptions: ~61 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.migrations: ~0 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2013_04_20_155401_create_states_table', 1),
	(2, '2014_10_12_000000_create_users_table', 1),
	(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(5, '2019_08_19_000000_create_failed_jobs_table', 1),
	(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(7, '2023_04_11_213934_create_sessions_table', 1),
	(8, '2023_04_28_170429_create_permission_tables', 1),
	(9, '2023_05_02_144901_create_questions_table', 1),
	(10, '2023_05_02_144919_create_modalities_table', 1),
	(11, '2023_05_02_145005_create_answers_table', 1),
	(12, '2023_05_02_145149_create_categories_table', 1),
	(13, '2023_05_02_145217_create_sizes_table', 1),
	(14, '2023_05_02_145245_create_transports_table', 1),
	(15, '2023_05_02_145246_create_inscriptions_table', 1),
	(16, '2023_05_03_191116_create_id_types_table', 1),
	(17, '2023_09_11_192423_create_configs_table', 1),
	(18, '2023_09_19_153628_create_fondos_table', 1),
	(19, '2024_04_20_195502_create_relationships_table', 1);

-- Volcando datos para la tabla carrera_senek.modalities: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.model_has_permissions: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.model_has_roles: ~0 rows (aproximadamente)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1);

-- Volcando datos para la tabla carrera_senek.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.permissions: ~41 rows (aproximadamente)
INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin.dashboard', 'Ver dashboard del Admin y Empresa', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(2, 'admin.states.index', 'Lista de Estados Disponibles', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(3, 'admin.states.create', 'Creacion de Estados', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(4, 'admin.states.edit', 'Edicion de Estados', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(5, 'admin.states.show', 'Ver detalles de Estado', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(6, 'admin.states.destroy', 'Eliminar Estados', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(7, 'admin.roles.index', 'Lista de Estados Disponibles', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(8, 'admin.roles.create', 'Creacion de Estados', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(9, 'admin.roles.edit', 'Edicion de Estados', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(10, 'admin.roles.show', 'Ver detalles de Estado', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(11, 'admin.roles.destroy', 'Eliminar Estados', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(12, 'admin.users.index', 'Lista de Usuarios', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(13, 'admin.users.create', 'Creacion de Usuarios', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(14, 'admin.users.edit', 'Edicion de Usuarios', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(15, 'admin.users.show', 'Ver detalles de Usuario', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(16, 'admin.users.destroy', 'Eliminar Usuario', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(17, 'admin.products.index', 'Lista de Productos', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(18, 'admin.products.create', 'Crear Producto', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(19, 'admin.products.edit', 'Editar Producto', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(20, 'admin.products.show', 'Ver detalles del Producto', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(21, 'admin.products.destroy', 'Eliminar Producto', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(22, 'admin.menus.index', 'Lista de Menus', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(23, 'admin.menus.create', 'Crear Menu', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(24, 'admin.menus.edit', 'Editar Menu', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(25, 'admin.menus.show', 'Ver detalle del  Menu', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(26, 'admin.menus.destroy', 'Eliminar Menu', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(27, 'admin.pays.index', 'Lista de metodos de Pago', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(28, 'admin.pays.create', 'Crear metodos de pago', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(29, 'admin.pays.edit', 'editar metodo de pago', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(30, 'admin.pays.show', 'ver metodo de pago', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(31, 'admin.pays.destroy', 'eliminar metodo de pago', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(32, 'admin.salereports.index', 'Listar reporte de ventas', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(33, 'admin.salereports.create', 'Crear reporte de venta', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(34, 'admin.salereports.edit', 'Editar reporte de venta', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(35, 'admin.salereports.show', 'Ver detalle del reporte de venta', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(36, 'admin.salereports.destroy', 'Eliminar reporte de venta', 'web', '2023-09-21 20:30:59', '2023-09-21 20:30:59'),
	(37, 'admin.companies.index', 'Lista de empresas', 'web', '2023-09-21 20:31:00', '2023-09-21 20:31:00'),
	(38, 'admin.companies.create', 'Crear empresa', 'web', '2023-09-21 20:31:00', '2023-09-21 20:31:00'),
	(39, 'admin.companies.edit', 'Editar empresa', 'web', '2023-09-21 20:31:00', '2023-09-21 20:31:00'),
	(40, 'admin.companies.show', 'Ver detalle de la empresa', 'web', '2023-09-21 20:31:00', '2023-09-21 20:31:00'),
	(41, 'admin.companies.destroy', 'Eliminar empresa', 'web', '2023-09-21 20:31:00', '2023-09-21 20:31:00');

-- Volcando datos para la tabla carrera_senek.personal_access_tokens: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.questions: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.roles: ~2 rows (aproximadamente)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(2, 'Empresa', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58'),
	(3, 'Usuario', 'web', '2023-09-21 20:30:58', '2023-09-21 20:30:58');

-- Volcando datos para la tabla carrera_senek.role_has_permissions: ~62 rows (aproximadamente)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(1, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(20, 2),
	(21, 2),
	(22, 2),
	(23, 2),
	(24, 2),
	(25, 2),
	(26, 2),
	(27, 2),
	(28, 2),
	(29, 2),
	(30, 2),
	(31, 2),
	(32, 2),
	(33, 2),
	(34, 2),
	(35, 2),
	(36, 2);

-- Volcando datos para la tabla carrera_senek.sessions: ~3 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.sizes: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.states: ~0 rows (aproximadamente)
INSERT INTO `states` (`id`, `color`, `nombre_estado`, `created_at`, `updated_at`) VALUES
	(1, '#000000', 'Disponible', '2023-09-21 20:31:00', '2023-09-21 20:31:00');

-- Volcando datos para la tabla carrera_senek.transports: ~0 rows (aproximadamente)

-- Volcando datos para la tabla carrera_senek.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `identity_card`, `avatar`, `external_id`, `external_auth`, `estado_id`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Daniel', 'admin@uniandes.edu.co', '$2y$10$gXbcMIN.xeb6evUv90Y7lupEsNgEUFfjR6uNuDISYw.wyg.oZXEhq', NULL, NULL, NULL, '123456', NULL, NULL, NULL, 1, '2023-09-21 20:31:00', '2023-09-21 20:31:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
