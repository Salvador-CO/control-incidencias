-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2026 a las 19:21:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_incidencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('sicip-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:21:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"ver-dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"ver-incidencias\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"crear-incidencias\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:18:\"editar-incidencias\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:20:\"eliminar-incidencias\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"ver-empleados\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"crear-empleados\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:16:\"editar-empleados\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:18:\"dar-baja-empleados\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"ver-reportes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"exportar-reportes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:13:\"ver-catalogos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:19:\"gestionar-catalogos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:18:\"gestionar-usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"gestionar-roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:11:\"ver-oficios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"crear-oficios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:14:\"editar-oficios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:16:\"cancelar-oficios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:17:\"ver-oficios-todos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:24:\"gestionar-oficios-config\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"Administrador\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"Capturista\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:4:\"Jefe\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:9:\"Asistente\";s:1:\"c\";s:3:\"web\";}}}', 1786464421);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direccion_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `clave` varchar(20) DEFAULT NULL COMMENT 'Clave corta del departamento para el folio del oficio, ej: DASE',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jefe_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `direccion_id`, `nombre`, `clave`, `activo`, `created_at`, `updated_at`, `jefe_id`) VALUES
(1, 1, 'Bibliotecas', NULL, 1, '2026-08-06 22:15:34', '2026-08-06 22:15:34', NULL),
(2, 1, 'Laboratorios', NULL, 1, '2026-08-06 22:15:34', '2026-08-06 22:15:34', NULL),
(3, 1, 'Departamento de Servicios de  Apoyo a la Modalidad no  Escolarizada (SEA)', NULL, 1, '2026-08-06 22:15:34', '2026-08-07 01:44:20', NULL),
(4, 1, 'Subdirección de Administración  Escolar (SAE)', NULL, 1, '2026-08-06 22:15:34', '2026-08-07 01:44:38', NULL),
(5, 1, 'Departamento de Servicios de  Evaluación para la Certificación (EXACER)', NULL, 1, '2026-08-06 22:15:34', '2026-08-07 01:44:57', NULL),
(6, 1, 'Departamento de Servicios  Escolares (SAE)', NULL, 1, '2026-08-06 23:42:56', '2026-08-07 01:45:12', NULL),
(7, 1, 'DASE', 'DASE', 1, '2026-08-07 01:03:17', '2026-08-10 22:23:27', NULL),
(8, 2, 'SSI', NULL, 1, '2026-08-07 02:11:50', '2026-08-07 02:11:50', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jefe_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `nombre`, `activo`, `created_at`, `updated_at`, `jefe_id`) VALUES
(1, 'Dirección de Administración y Servicios Escolares (DASE)', 1, '2026-08-06 22:15:34', '2026-08-06 22:15:34', 1),
(2, 'Secretaria de Servicios Institucionales (SSI)', 1, '2026-08-07 02:11:16', '2026-08-07 02:11:29', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_empleado` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido_paterno` varchar(255) DEFAULT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `curp` varchar(255) DEFAULT NULL,
  `rfc` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `puesto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departamento_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direccion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fotografia` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `numero_empleado`, `nombre`, `apellido_paterno`, `apellido_materno`, `curp`, `rfc`, `correo`, `telefono`, `fecha_ingreso`, `puesto_id`, `departamento_id`, `direccion_id`, `activo`, `fotografia`, `created_at`, `updated_at`) VALUES
(1, '2210088', 'EDUARDO', 'CARRILLO', 'SANTILLÁN', NULL, NULL, NULL, NULL, NULL, 1, 7, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(2, '2110261', 'ISABEL', 'OLIVERA', 'RAMIREZ', NULL, NULL, NULL, NULL, NULL, 6, 7, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(3, '2200102', 'NORMA DE LOS ANGELES', 'HERNANDEZ', 'SANTILLAN', NULL, NULL, NULL, NULL, NULL, 2, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-08 05:50:49'),
(4, '2110059', 'GUADALUPE KARINA', 'MAGALLANES', 'VELAZQUEZ', NULL, NULL, NULL, NULL, NULL, 4, 7, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(5, '2130128', 'DANIELA', 'JIMENEZ', 'NOGUEDA', NULL, NULL, NULL, NULL, NULL, 6, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-08 05:51:13'),
(6, '2180140', 'MARISOL', 'LEAL', 'MARTINEZ', NULL, NULL, NULL, NULL, NULL, 8, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(7, '2100494', 'DAVID', 'ZAMORA', 'DIAZ', NULL, NULL, NULL, NULL, NULL, 8, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(8, '2090249', 'HANSEL', 'PANTALEON', 'RAMIREZ', NULL, NULL, NULL, NULL, NULL, 9, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(9, '2240329', 'MANUEL ALEJANDRO', 'ZAVALA', 'DE AVILA', NULL, NULL, NULL, NULL, NULL, 10, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(10, '2020131', 'KARLA', 'CHAVEZ', 'AVINA', NULL, NULL, NULL, NULL, NULL, 11, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(11, '2120123', 'FERNANDO', 'SALAZAR', 'TORRES', NULL, NULL, NULL, NULL, NULL, 12, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(12, '2010001', 'HUGO', 'HERNANDEZ', 'RUEDA', NULL, NULL, NULL, NULL, NULL, 14, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(13, '2230372', 'LIZBETH', 'RANGEL', 'VEGA', NULL, NULL, NULL, NULL, NULL, 15, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(14, '2060327', 'CARLOS', 'TAPIA', 'MENDOZA', NULL, NULL, NULL, NULL, NULL, 17, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(15, '2060313', 'ERICK GILBERTO', 'CORREA', 'AREVALO', NULL, NULL, NULL, NULL, NULL, 18, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(16, '2000326', 'MARICARMEN', 'HERNANDEZ', 'RUEDA', NULL, NULL, NULL, NULL, NULL, 19, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(17, '2020209', 'OSVALDO', 'ROMERO', 'MARTINEZ', NULL, NULL, NULL, NULL, NULL, 18, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(18, '2100172', 'OMAR', 'RANGEL', 'LEVARIC', NULL, NULL, NULL, NULL, NULL, 19, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(19, '2090305', 'XOCHIQUETZAL ITZEL', 'HERNANDEZ', 'JUAREZ', NULL, NULL, NULL, NULL, NULL, 21, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(20, '2080347', 'MARIA DEL ROSARIO', 'ANGULO', 'GUERRA', NULL, NULL, NULL, NULL, NULL, 20, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(21, '2150314', 'ANGEL', 'RODRIGUEZ', 'GALINDO', NULL, NULL, NULL, NULL, NULL, 23, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(22, '2150453', 'MARIO ANTONIO', 'CALLEJAS', 'LINARES', NULL, NULL, NULL, NULL, NULL, 24, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(23, '2100157', 'NINEL', 'ESTRADA', 'PEREZ', NULL, NULL, NULL, NULL, NULL, 25, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(24, '2100264', 'NASHIELI', 'JAU', 'MEXIA', NULL, NULL, NULL, NULL, NULL, 26, 2, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(25, '2090047', 'ADDIEL', 'AMADOR', 'PEREZ', NULL, NULL, NULL, NULL, NULL, 27, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(26, '2010486', 'GERARDO', 'NEGRTE', 'HERNANDEZ', NULL, NULL, NULL, NULL, NULL, 28, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(27, '2030170', 'VERONICA ESTELA', 'ARANA', 'HERNANDEZ', NULL, NULL, NULL, NULL, NULL, 29, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(28, '2090048', 'OLGA PATRICIA', 'ABAD', 'DIAZ', NULL, NULL, NULL, NULL, NULL, 29, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(29, '2080292', 'MA. GUADALUPE', 'BARRIENTOS', 'SERRATO', NULL, NULL, NULL, NULL, NULL, 29, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(30, '9900411', 'ROSA MARIA', 'CONTRERAS', 'RODRIGUEZ', NULL, NULL, NULL, NULL, NULL, 29, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(31, '2130283', 'JUANA YOLANDA', 'JIMENEZ', 'SANCHEZ', NULL, NULL, NULL, NULL, NULL, 20, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(32, '9500328', 'LETICIA', 'SOLIS', 'ARGUMEDO', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(33, '2070023', 'FRANCISCO JAVIER', 'BAUTISTA', 'HERNANDEZ', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(34, '2150008', 'MARIA MAURA NOEMI', 'JASSO', 'ALCANTARA', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(35, '2160330', 'MIGUEL ANGEL', 'JIMENEZ', 'GALICIA', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(36, '2150009', 'JOSELIN', 'AQUINO', 'AMADOR', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(37, '2130100', 'RUFINA', 'NORIEGA', 'PIMENTEL', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(38, '2080248', 'MARIA EMMA', 'SOLIS', 'ARGUMEDC', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(39, '2110226', 'MARTHA', 'REGALADO', 'VILLANUEVA', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(40, '8500020', 'PATRICIA', 'ESQUIVEL', 'DIAZ', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(41, '2020348', 'RITA', 'ROSAS', 'PASTRANA', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(42, '2150138', 'LAURA BELEN', 'RAMOS', 'PEREREZ', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(43, '2250169', 'MARIA DEL ROCIO', 'IGLESIAS', 'VIRUEL', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(44, '2130254', 'JOSE MANUEL', 'DE LA HUERTA', 'VALENCIA', NULL, NULL, NULL, NULL, NULL, 30, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(45, '2160044', 'ANTONIO', 'HERNANDEZ', 'VALENTIN', NULL, NULL, NULL, NULL, NULL, 31, 1, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(46, '2040019', 'RAUL LEONARDO', 'ZAVALA', 'DE AVILA', NULL, NULL, NULL, NULL, NULL, 32, 4, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(47, '2000230', 'MARCELA', 'PENA', 'ORDONEZ', NULL, NULL, NULL, NULL, NULL, 8, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(48, '2060227', 'MARCO POLO', 'RODRIGUEZ', 'ROSAS', NULL, NULL, NULL, NULL, NULL, 36, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(49, '2110265', 'HECTOR NOE', 'FERNANDEZ', 'RAMIREZ', NULL, NULL, NULL, NULL, NULL, 37, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(50, '2040391', 'YOLANDA', 'RODRIGUEZ', 'MONTERO', NULL, NULL, NULL, NULL, NULL, 39, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(51, '2190385', 'ARLETTE', 'VELASCO', 'CHAVEZ', NULL, NULL, NULL, NULL, NULL, 40, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(52, '2160110', 'GERARDO', 'SESMA', 'ESPINOSA', NULL, NULL, NULL, NULL, NULL, 41, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(53, '9400528', 'ALFREDO', 'BARRERA', 'HERNANDEZ', NULL, NULL, NULL, NULL, NULL, 42, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(54, '2220128', 'SALVADOR', 'CAMPOS', 'ORIHUELA', NULL, NULL, NULL, NULL, NULL, 43, 7, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(55, '2160380', 'ADRIANA', 'OROPEZA', 'TORRES', NULL, NULL, NULL, NULL, NULL, 43, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(56, '2240042', 'PABLO', 'ABAD', 'BEDOLLA', NULL, NULL, NULL, NULL, NULL, 45, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(57, '9400687', 'FABIOLA', 'SALAS', 'VAZQUEZ', NULL, NULL, NULL, NULL, NULL, 46, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(58, '2220127', 'LUIS ENRIQUE', 'SMILOVITZ', 'BALDERAS', NULL, NULL, NULL, NULL, NULL, 47, 7, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(59, '9500024', 'EUGENIA ESPERANZA', 'MARTINEZ', 'CRUZ', NULL, NULL, NULL, NULL, NULL, 48, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(60, '2030265', 'LETICIA', 'GALLEGOS', 'MEDINA', NULL, NULL, NULL, NULL, NULL, 20, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(61, '9900222', 'MOISES', 'VAZQUEZ', 'CALIXTO', NULL, NULL, NULL, NULL, NULL, 51, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(62, '2100650', 'FABIAN ALBERTO', 'TORRES', 'ESQUIVEL', NULL, NULL, NULL, NULL, NULL, 52, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(63, '2160140', 'GRISEL', 'LICEA', 'SANDOVAL', NULL, NULL, NULL, NULL, NULL, 8, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(64, '2240019', 'NANCY', 'MARTINEZ', 'DE LOS SANTOS', NULL, NULL, NULL, NULL, NULL, 55, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(65, '2120216', 'ANGELICA', 'MORALES', 'RODRIGUEZ', NULL, NULL, NULL, NULL, NULL, 56, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(66, '9700398', 'MIGUEL ANGEL', 'LOPEZ', 'CONTRERAS', NULL, NULL, NULL, NULL, NULL, 35, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(67, '2100127', 'ALINE ANALLELI', 'GONZALEZ', 'SANCHEZ', NULL, NULL, NULL, NULL, NULL, 39, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(68, '9600427', 'MARIA DE LOS ANGELES', 'SANCHEZ', 'ESPINOSA', NULL, NULL, NULL, NULL, NULL, 39, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(69, '2090035', 'ARACELI', 'CALZADA', 'PACHECO', NULL, NULL, NULL, NULL, NULL, 39, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(70, '2080348', 'BLANCA ROCIO', 'DE LA ROSA', 'SOLIS', NULL, NULL, NULL, NULL, NULL, 58, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(71, '2110098', 'ALEJANDRO', 'LANDA', 'SALINAS', NULL, NULL, NULL, NULL, NULL, 58, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(72, '2060005', 'CATALINA', 'SANCHEZ', 'MUNGUIA', NULL, NULL, NULL, NULL, NULL, 58, 6, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(73, '9200526', 'MARIA DEL CONSUELO', 'QUIÑONES', 'VALENZUELA', NULL, NULL, NULL, NULL, NULL, 59, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(74, '9100053', 'SALVADOR JOSE LUIS', 'OLGUIN', 'MOLINA', NULL, NULL, NULL, NULL, NULL, 60, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(75, '2180068', 'YETZIN XIOMARA', 'MATA', 'ORDUÑA', NULL, NULL, NULL, NULL, NULL, 61, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(76, '2190235', 'MONTSERRAT', 'SANCHEZ', 'CENTENO', NULL, NULL, NULL, NULL, NULL, 62, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(77, '2240332', 'KAREN ADRIANA', 'MAYA', 'GUTIERREZ', NULL, NULL, NULL, NULL, NULL, 21, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(78, '2100786', 'SULEYMA', 'COLIN', 'RODRIGUEZ', NULL, NULL, NULL, NULL, NULL, 21, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(79, '2230006', 'EDUARDO', 'URIOSTEGUI', 'GARCIA', NULL, NULL, NULL, NULL, NULL, 21, 7, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(80, '9200024', 'MA. ELENA', 'SANCHEZ', 'LEDEZMA', NULL, NULL, NULL, NULL, NULL, 3, 3, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(81, '2150154', 'MARGARITA', 'FLORES', 'SUAZO', NULL, NULL, NULL, NULL, NULL, 21, 5, 1, 1, NULL, '2026-08-06 19:42:22', '2026-08-06 19:42:22'),
(82, '22201', 'JUAN LUIS', 'MARMOLEJO', 'MACIAS', NULL, NULL, 'juan.marmolejo@bachilleres.edu.mx', NULL, NULL, 65, 8, 2, 1, NULL, '2026-08-07 02:13:02', '2026-08-07 02:14:55'),
(83, '2090307', 'GUADALUPE', 'BARRAGAN', 'BARRAGAN', NULL, NULL, 'guadalupe.barragan@bachilleres.edu.mx', NULL, NULL, 58, 3, 1, 1, NULL, '2026-08-07 20:50:37', '2026-08-07 20:50:37'),
(84, '2130130', 'EVA ISABEL', 'RAMIREZ', 'GONZALEZ', NULL, NULL, 'evaisabel.ramirez@bachilleres.edu.mx', NULL, NULL, 63, 5, 1, 1, NULL, '2026-08-07 22:14:50', '2026-08-07 22:14:50'),
(85, '9700017', 'DANIEL', 'DORANTES', 'MORALES', NULL, NULL, 'daniel.dorantes@bachilleres.edu.mx', NULL, NULL, 19, 2, 1, 1, NULL, '2026-08-07 23:22:52', '2026-08-07 23:22:52'),
(86, '2120027', 'MILDRED', 'HERNANDEZ', 'SOLIS', NULL, NULL, 'mildred.hernandez1@bachilleres.edu.mx', NULL, NULL, 18, 2, 1, 1, NULL, '2026-08-07 23:24:51', '2026-08-07 23:24:51'),
(87, '2260113', 'GLORIA ESTER', 'MARTINEZ', 'MEJIA', NULL, NULL, NULL, NULL, NULL, 3, 5, 1, 1, NULL, '2026-08-08 04:41:04', '2026-08-08 04:41:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `departamento_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direccion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo_incidencia_id` bigint(20) UNSIGNED NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `recibido_por` varchar(255) DEFAULT NULL,
  `capturado_por` bigint(20) UNSIGNED NOT NULL,
  `estatus` varchar(255) NOT NULL DEFAULT 'Pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `fecha`, `empleado_id`, `departamento_id`, `direccion_id`, `tipo_incidencia_id`, `motivo`, `observaciones`, `recibido_por`, `capturado_por`, `estatus`, `created_at`, `updated_at`) VALUES
(1, '2025-12-19', 20, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 20:29:15', '2026-08-07 20:29:15'),
(2, '2026-01-07', 83, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 20:52:03', '2026-08-07 20:52:03'),
(3, '2026-01-07', 60, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 20:52:58', '2026-08-07 20:52:58'),
(4, '2026-01-07', 69, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:10:23', '2026-08-07 22:10:23'),
(5, '2026-01-08', 12, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:10:50', '2026-08-07 22:10:50'),
(6, '2026-01-07', 35, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:11:20', '2026-08-07 22:11:20'),
(7, '2026-01-08', 10, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:11:48', '2026-08-07 22:11:48'),
(8, '2025-12-19', 84, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:15:27', '2026-08-07 22:15:27'),
(9, '2026-01-08', 26, 1, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:15:52', '2026-08-07 22:15:52'),
(10, '2025-12-19', 36, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:16:28', '2026-08-07 22:16:28'),
(11, '2026-01-08', 70, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:17:41', '2026-08-07 22:17:41'),
(12, '2026-01-08', 70, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:18:04', '2026-08-07 22:18:04'),
(13, '2025-12-19', 78, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:18:33', '2026-08-07 22:18:33'),
(14, '2026-01-08', 67, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:19:05', '2026-08-07 22:19:05'),
(15, '2026-01-07', 71, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:19:37', '2026-08-07 22:19:37'),
(16, '2026-01-07', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:20:05', '2026-08-07 22:20:05'),
(17, '2026-01-07', 48, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:20:30', '2026-08-07 22:20:30'),
(18, '2025-12-19', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:20:57', '2026-08-07 22:20:57'),
(19, '2026-01-08', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:23:21', '2026-08-07 22:23:21'),
(20, '2026-01-07', 3, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:23:43', '2026-08-07 22:23:43'),
(21, '2026-01-07', 3, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 22:23:53', '2026-08-07 22:23:53'),
(22, '2026-01-08', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:14:09', '2026-08-07 23:14:09'),
(23, '2026-01-09', 14, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:14:34', '2026-08-07 23:14:34'),
(24, '2026-01-09', 21, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:15:10', '2026-08-07 23:15:10'),
(25, '2026-01-09', 23, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:15:25', '2026-08-07 23:15:25'),
(26, '2026-01-09', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:16:33', '2026-08-07 23:16:33'),
(27, '2026-01-09', 71, 5, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:17:06', '2026-08-07 23:17:06'),
(28, '2026-01-12', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:18:53', '2026-08-07 23:18:53'),
(29, '2026-01-12', 51, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:19:23', '2026-08-07 23:19:23'),
(30, '2026-01-13', 4, 7, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:19:55', '2026-08-07 23:19:55'),
(31, '2026-01-09', 85, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:23:25', '2026-08-07 23:23:25'),
(32, '2026-01-13', 86, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:26:17', '2026-08-07 23:26:17'),
(33, '2026-01-12', 28, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:26:38', '2026-08-07 23:26:38'),
(34, '2026-01-13', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:27:17', '2026-08-07 23:27:17'),
(35, '2026-01-13', 74, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:27:44', '2026-08-07 23:27:44'),
(36, '2026-01-13', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:28:07', '2026-08-07 23:28:07'),
(37, '2026-01-13', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:33:42', '2026-08-07 23:33:42'),
(38, '2026-01-13', 48, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:36:53', '2026-08-07 23:36:53'),
(39, '2026-01-13', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:37:12', '2026-08-07 23:37:12'),
(40, '2026-01-14', 76, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:37:55', '2026-08-07 23:37:55'),
(41, '2026-01-07', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:38:47', '2026-08-07 23:38:47'),
(42, '2026-01-14', 78, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:39:17', '2026-08-07 23:39:17'),
(43, '2026-01-09', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:39:44', '2026-08-07 23:39:44'),
(44, '2026-01-13', 71, 5, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:40:10', '2026-08-07 23:40:10'),
(45, '2026-01-12', 34, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:41:04', '2026-08-07 23:41:04'),
(46, '2026-01-12', 35, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:41:35', '2026-08-07 23:41:35'),
(47, '2026-01-16', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:42:02', '2026-08-07 23:42:02'),
(48, '2026-01-15', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:42:25', '2026-08-07 23:42:25'),
(49, '2026-01-13', 42, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:42:41', '2026-08-07 23:42:41'),
(50, '2026-01-13', 42, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:44:08', '2026-08-07 23:44:08'),
(51, '2026-01-12', 33, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:44:33', '2026-08-07 23:44:33'),
(52, '2026-01-14', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:45:06', '2026-08-07 23:45:06'),
(53, '2026-01-13', 3, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:45:28', '2026-08-07 23:45:28'),
(54, '2026-01-15', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:46:15', '2026-08-07 23:46:15'),
(55, '2026-01-14', 71, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:46:31', '2026-08-07 23:46:31'),
(56, '2026-01-16', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:47:02', '2026-08-07 23:47:02'),
(57, '2026-01-15', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:47:28', '2026-08-07 23:47:28'),
(58, '2026-01-19', 60, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:48:04', '2026-08-07 23:48:04'),
(59, '2026-01-15', 60, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:48:29', '2026-08-07 23:48:29'),
(60, '2026-01-19', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:49:34', '2026-08-07 23:49:34'),
(61, '2026-01-15', 81, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:50:05', '2026-08-07 23:50:05'),
(62, '2026-01-19', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:50:45', '2026-08-07 23:50:45'),
(63, '2026-01-20', 79, 7, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:51:11', '2026-08-07 23:51:11'),
(64, '2026-01-16', 79, 7, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:51:33', '2026-08-07 23:51:33'),
(65, '2026-01-20', 71, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:51:50', '2026-08-07 23:51:50'),
(66, '2026-01-20', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:52:09', '2026-08-07 23:52:09'),
(67, '2026-01-21', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:52:32', '2026-08-07 23:52:32'),
(68, '2026-01-19', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:52:49', '2026-08-07 23:52:49'),
(69, '2026-01-16', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:53:21', '2026-08-07 23:53:21'),
(70, '2026-01-16', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:53:59', '2026-08-07 23:53:59'),
(71, '2026-01-15', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:54:30', '2026-08-07 23:54:30'),
(72, '2026-01-20', 22, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-07 23:59:36', '2026-08-07 23:59:36'),
(73, '2026-01-16', 44, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:00:06', '2026-08-08 00:00:06'),
(74, '2026-01-26', 39, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:00:33', '2026-08-08 00:00:33'),
(75, '2026-01-07', 32, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:00:49', '2026-08-08 00:00:49'),
(76, '2026-01-19', 35, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:01:35', '2026-08-08 00:01:35'),
(77, '2026-01-16', 33, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:02:01', '2026-08-08 00:02:01'),
(78, '2026-01-19', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:02:16', '2026-08-08 00:02:16'),
(79, '2026-01-21', 84, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:02:35', '2026-08-08 00:02:35'),
(80, '2026-01-21', 84, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:02:48', '2026-08-08 00:02:48'),
(81, '2026-01-22', 30, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:03:08', '2026-08-08 00:03:08'),
(82, '2026-01-22', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:03:25', '2026-08-08 00:03:25'),
(83, '2026-01-22', 83, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:03:40', '2026-08-08 00:03:40'),
(84, '2026-01-21', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:04:12', '2026-08-08 00:04:12'),
(85, '2026-01-21', 69, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:04:28', '2026-08-08 00:04:28'),
(86, '2026-01-20', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:04:49', '2026-08-08 00:04:49'),
(87, '2026-01-22', 4, 7, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:05:05', '2026-08-08 00:05:05'),
(88, '2026-01-20', 73, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:05:26', '2026-08-08 00:05:26'),
(89, '2026-01-26', 83, 3, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:09:08', '2026-08-08 00:09:08'),
(90, '2026-01-23', 73, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:09:24', '2026-08-08 00:09:24'),
(91, '2026-01-27', 78, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:09:41', '2026-08-08 00:09:41'),
(92, '2026-01-28', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:09:55', '2026-08-08 00:09:55'),
(93, '2026-01-26', 71, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:10:06', '2026-08-08 00:10:06'),
(94, '2026-01-26', 35, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:10:30', '2026-08-08 00:10:30'),
(95, '2026-01-28', 32, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:10:55', '2026-08-08 00:10:55'),
(96, '2026-01-28', 35, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:11:07', '2026-08-08 00:11:07'),
(97, '2026-01-28', 40, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:11:17', '2026-08-08 00:11:17'),
(98, '2026-01-29', 38, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:11:34', '2026-08-08 00:11:34'),
(99, '2026-01-28', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:11:46', '2026-08-08 00:11:46'),
(100, '2026-01-28', 52, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:11:58', '2026-08-08 00:11:58'),
(101, '2026-01-29', 74, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:12:09', '2026-08-08 00:12:09'),
(102, '2026-01-28', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:12:17', '2026-08-08 00:12:17'),
(103, '2026-01-26', 60, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:12:28', '2026-08-08 00:12:28'),
(104, '2026-01-29', 69, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:12:40', '2026-08-08 00:12:40'),
(105, '2026-01-30', 50, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:12:51', '2026-08-08 00:12:51'),
(106, '2026-01-26', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:13:20', '2026-08-08 00:13:20'),
(107, '2026-01-23', 27, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:13:32', '2026-08-08 00:13:32'),
(108, '2026-01-19', 84, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:13:48', '2026-08-08 00:13:48'),
(109, '2026-01-22', 36, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:14:03', '2026-08-08 00:14:03'),
(110, '2026-01-22', 34, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:14:30', '2026-08-08 00:14:30'),
(111, '2026-01-23', 20, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:14:42', '2026-08-08 00:14:42'),
(112, '2026-01-23', 19, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:14:53', '2026-08-08 00:14:53'),
(113, '2026-01-22', 59, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:15:15', '2026-08-08 00:15:15'),
(114, '2026-01-26', 59, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:15:26', '2026-08-08 00:15:26'),
(115, '2026-01-26', 49, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:15:43', '2026-08-08 00:15:43'),
(116, '2026-01-27', 50, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:15:56', '2026-08-08 00:15:56'),
(117, '2026-01-26', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:16:08', '2026-08-08 00:16:08'),
(118, '2026-01-23', 60, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:16:19', '2026-08-08 00:16:19'),
(119, '2026-01-22', 67, 5, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:16:31', '2026-08-08 00:16:31'),
(120, '2026-01-26', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:16:46', '2026-08-08 00:16:46'),
(121, '2026-01-22', 62, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:16:58', '2026-08-08 00:16:58'),
(122, '2026-01-29', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:17:48', '2026-08-08 00:17:48'),
(123, '2026-02-03', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:18:04', '2026-08-08 00:18:04'),
(124, '2026-02-04', 64, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:18:12', '2026-08-08 00:18:12'),
(125, '2026-01-28', 57, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:18:27', '2026-08-08 00:18:27'),
(126, '2026-02-03', 57, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:18:34', '2026-08-08 00:18:34'),
(127, '2026-02-03', 57, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:18:47', '2026-08-08 00:18:47'),
(128, '2026-02-03', 69, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:18:59', '2026-08-08 00:18:59'),
(129, '2026-02-04', 68, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:19:09', '2026-08-08 00:19:09'),
(130, '2026-02-05', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:19:20', '2026-08-08 00:19:20'),
(131, '2026-02-06', 74, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:19:33', '2026-08-08 00:19:33'),
(132, '2026-02-06', 74, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:19:42', '2026-08-08 00:19:42'),
(133, '2026-02-06', 69, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:19:51', '2026-08-08 00:19:51'),
(134, '2026-02-05', 80, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:20:11', '2026-08-08 00:20:11'),
(135, '2026-02-06', 23, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:20:20', '2026-08-08 00:20:20'),
(136, '2026-02-06', 24, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:20:45', '2026-08-08 00:20:45'),
(137, '2026-02-06', 37, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:20:53', '2026-08-08 00:20:53'),
(138, '2026-02-03', 35, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:21:02', '2026-08-08 00:21:02'),
(139, '2026-02-04', 38, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:21:16', '2026-08-08 00:21:16'),
(140, '2026-02-05', 21, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:21:27', '2026-08-08 00:21:27'),
(141, '2026-01-24', 78, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:21:39', '2026-08-08 00:21:39'),
(142, '2026-01-28', 70, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:21:52', '2026-08-08 00:21:52'),
(143, '2026-01-26', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:22:09', '2026-08-08 00:22:09'),
(144, '2026-01-30', 14, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:22:22', '2026-08-08 00:22:22'),
(145, '2026-01-29', 39, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:22:42', '2026-08-08 00:22:42'),
(146, '2026-01-29', 44, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:23:45', '2026-08-08 00:23:45'),
(147, '2026-02-03', 78, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:23:54', '2026-08-08 00:23:54'),
(148, '2026-02-04', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:24:05', '2026-08-08 00:24:05'),
(149, '2026-02-02', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:24:18', '2026-08-08 00:24:18'),
(150, '2026-02-03', 70, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:24:31', '2026-08-08 00:24:31'),
(151, '2026-02-04', 71, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:24:40', '2026-08-08 00:24:40'),
(152, '2026-02-03', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:24:53', '2026-08-08 00:24:53'),
(153, '2026-02-04', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:25:04', '2026-08-08 00:25:04'),
(154, '2026-02-03', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:25:13', '2026-08-08 00:25:13'),
(155, '2026-02-03', 69, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:25:25', '2026-08-08 00:25:25'),
(156, '2026-02-03', 69, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:25:33', '2026-08-08 00:25:33'),
(157, '2026-02-03', 60, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:25:47', '2026-08-08 00:25:47'),
(158, '2026-02-03', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:25:57', '2026-08-08 00:25:57'),
(159, '2026-02-05', 40, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:26:09', '2026-08-08 00:26:09'),
(160, '2026-02-03', 32, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:26:26', '2026-08-08 00:26:26'),
(161, '2026-01-30', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:26:36', '2026-08-08 00:26:36'),
(162, '2026-02-28', 16, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:40:47', '2026-08-08 00:40:47'),
(163, '2026-02-05', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:40:56', '2026-08-08 00:40:56'),
(164, '2026-02-09', 26, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:42:47', '2026-08-08 00:42:47'),
(165, '2026-02-06', 76, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:43:03', '2026-08-08 00:43:03'),
(166, '2026-02-09', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:43:14', '2026-08-08 00:43:14'),
(167, '2026-01-13', 28, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:47:01', '2026-08-08 00:47:01'),
(168, '2026-02-09', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:47:19', '2026-08-08 00:47:19'),
(169, '2026-02-09', 28, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:47:30', '2026-08-08 00:47:30'),
(170, '2026-02-06', 20, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:47:42', '2026-08-08 00:47:42'),
(171, '2026-02-09', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:47:52', '2026-08-08 00:47:52'),
(172, '2026-02-10', 14, 2, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:48:04', '2026-08-08 00:48:04'),
(173, '2026-02-15', 29, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:48:23', '2026-08-08 00:48:23'),
(174, '2026-02-10', 79, 7, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:48:34', '2026-08-08 00:48:34'),
(175, '2026-02-06', 81, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:48:45', '2026-08-08 00:48:45'),
(176, '2026-02-11', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:49:00', '2026-08-08 00:49:00'),
(177, '2026-02-05', 42, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:49:17', '2026-08-08 00:49:17'),
(178, '2026-02-06', 35, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:49:48', '2026-08-08 00:49:48'),
(179, '2026-02-10', 35, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:53:52', '2026-08-08 00:53:52'),
(180, '2026-02-03', 60, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:54:04', '2026-08-08 00:54:04'),
(181, '2026-02-06', 73, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:54:19', '2026-08-08 00:54:19'),
(182, '2026-02-10', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:54:38', '2026-08-08 00:54:38'),
(183, '2026-02-11', 4, 7, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:54:52', '2026-08-08 00:54:52'),
(184, '2026-02-11', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:55:05', '2026-08-08 00:55:05'),
(185, '2026-02-10', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:55:18', '2026-08-08 00:55:18'),
(186, '2026-02-06', 16, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:55:33', '2026-08-08 00:55:33'),
(187, '2026-02-06', 33, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:55:44', '2026-08-08 00:55:44'),
(188, '2026-02-09', 33, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:56:04', '2026-08-08 00:56:04'),
(189, '2026-02-09', 33, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:56:13', '2026-08-08 00:56:13'),
(190, '2026-02-13', 40, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:56:29', '2026-08-08 00:56:29'),
(191, '2026-02-11', 42, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:56:42', '2026-08-08 00:56:42'),
(192, '2026-02-13', 32, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:57:01', '2026-08-08 00:57:01'),
(193, '2026-02-09', 36, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:57:12', '2026-08-08 00:57:12'),
(194, '2026-02-09', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:57:26', '2026-08-08 00:57:26'),
(195, '2026-02-11', 30, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:57:41', '2026-08-08 00:57:41'),
(196, '2026-02-11', 28, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:57:55', '2026-08-08 00:57:55'),
(197, '2026-02-13', 81, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:58:09', '2026-08-08 00:58:09'),
(198, '2026-02-16', 30, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:58:21', '2026-08-08 00:58:21'),
(199, '2026-02-17', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:58:36', '2026-08-08 00:58:36'),
(200, '2026-02-18', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:58:49', '2026-08-08 00:58:49'),
(201, '2026-02-19', 56, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:59:03', '2026-08-08 00:59:03'),
(202, '2026-02-19', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:59:44', '2026-08-08 00:59:44'),
(203, '2026-02-19', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 00:59:56', '2026-08-08 00:59:56'),
(204, '2026-02-19', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:00:21', '2026-08-08 01:00:21'),
(205, '2026-02-19', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:00:32', '2026-08-08 01:00:32'),
(206, '2026-02-18', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:00:49', '2026-08-08 01:00:49'),
(207, '2026-02-18', 78, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:00:59', '2026-08-08 01:00:59'),
(208, '2026-02-19', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:01:08', '2026-08-08 01:01:08'),
(209, '2026-02-16', 40, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:01:27', '2026-08-08 01:01:27'),
(210, '2026-02-20', 34, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:01:45', '2026-08-08 01:01:45'),
(211, '2026-02-17', 35, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:01:59', '2026-08-08 01:01:59'),
(212, '2026-02-17', 33, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:02:09', '2026-08-08 01:02:09'),
(213, '2026-02-17', 39, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:02:21', '2026-08-08 01:02:21'),
(214, '2026-02-12', 3, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:03:46', '2026-08-08 01:03:46'),
(215, '2026-02-16', 40, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:04:29', '2026-08-08 01:04:29'),
(216, '2026-02-16', 40, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:04:40', '2026-08-08 01:04:40'),
(217, '2026-02-16', 74, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:04:52', '2026-08-08 01:04:52'),
(218, '2026-02-13', 50, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:05:07', '2026-08-08 01:05:07'),
(219, '2026-02-16', 57, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:05:18', '2026-08-08 01:05:18'),
(220, '2026-02-16', 61, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:05:28', '2026-08-08 01:05:28'),
(221, '2026-02-16', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:05:40', '2026-08-08 01:05:40'),
(222, '2026-02-17', 24, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:05:56', '2026-08-08 01:05:56'),
(223, '2026-02-17', 22, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:06:07', '2026-08-08 01:06:07'),
(224, '2026-02-16', 20, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:06:18', '2026-08-08 01:06:18'),
(225, '2026-02-13', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:08:27', '2026-08-08 01:08:27'),
(226, '2026-02-13', 34, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:08:44', '2026-08-08 01:08:44'),
(227, '2026-02-16', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:08:54', '2026-08-08 01:08:54'),
(228, '2026-02-17', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:09:06', '2026-08-08 01:09:06'),
(229, '2026-02-13', 81, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:09:19', '2026-08-08 01:09:19'),
(230, '2026-02-18', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:09:28', '2026-08-08 01:09:28'),
(231, '2026-02-18', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:09:44', '2026-08-08 01:09:44'),
(232, '2026-02-25', 67, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:10:00', '2026-08-08 01:10:00'),
(233, '2026-02-24', 75, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:10:12', '2026-08-08 01:10:12'),
(234, '2026-02-26', 23, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:10:29', '2026-08-08 01:10:29'),
(235, '2026-02-26', 43, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:10:40', '2026-08-08 01:10:40'),
(236, '2026-02-26', 34, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:10:53', '2026-08-08 01:10:53'),
(237, '2026-02-26', 38, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:11:06', '2026-08-08 01:11:06'),
(238, '2026-02-25', 73, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:11:26', '2026-08-08 01:11:26'),
(239, '2026-02-26', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:11:36', '2026-08-08 01:11:36'),
(240, '2026-02-25', 53, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:11:45', '2026-08-08 01:11:45'),
(241, '2026-02-26', 71, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:12:11', '2026-08-08 01:12:11'),
(242, '2026-02-18', 12, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:12:25', '2026-08-08 01:12:25'),
(243, '2026-02-26', 40, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:12:34', '2026-08-08 01:12:34'),
(244, '2026-02-26', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:12:43', '2026-08-08 01:12:43'),
(245, '2026-02-26', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:12:55', '2026-08-08 01:12:55'),
(246, '2026-02-27', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:13:10', '2026-08-08 01:13:10'),
(247, '2026-02-20', 5, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:13:23', '2026-08-08 01:13:23'),
(248, '2026-02-24', 5, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:13:34', '2026-08-08 01:13:34'),
(249, '2026-02-18', 36, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:14:05', '2026-08-08 01:14:05'),
(250, '2026-02-20', 23, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:15:18', '2026-08-08 01:15:18'),
(251, '2026-02-20', 60, 3, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:15:29', '2026-08-08 01:15:29'),
(252, '2026-02-19', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:15:44', '2026-08-08 01:15:44'),
(253, '2026-02-20', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:15:56', '2026-08-08 01:15:56'),
(254, '2026-02-23', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:16:06', '2026-08-08 01:16:06'),
(255, '2026-02-26', 29, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:16:32', '2026-08-08 01:16:32'),
(256, '2026-02-23', 9, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:16:49', '2026-08-08 01:16:49'),
(257, '2026-02-18', 62, 5, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:25:45', '2026-08-08 01:25:45'),
(258, '2026-02-24', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:26:22', '2026-08-08 01:26:22'),
(259, '2026-02-24', 23, 2, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:26:34', '2026-08-08 01:26:34'),
(260, '2026-02-22', 41, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:26:54', '2026-08-08 01:26:54'),
(261, '2026-02-24', 8, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:27:19', '2026-08-08 01:27:19'),
(262, '2026-02-20', 42, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:27:33', '2026-08-08 01:27:33'),
(263, '2026-02-25', 39, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:28:00', '2026-08-08 01:28:00'),
(264, '2026-02-16', 19, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:28:16', '2026-08-08 01:28:16'),
(265, '2026-02-18', 12, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:28:26', '2026-08-08 01:28:26'),
(266, '2026-02-25', 57, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 01:28:36', '2026-08-08 01:28:36'),
(267, '2026-02-03', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:09:01', '2026-08-08 02:09:01'),
(268, '2026-03-27', 60, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:09:20', '2026-08-08 02:09:20'),
(269, '2026-03-04', 66, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:09:37', '2026-08-08 02:09:37'),
(270, '2026-02-26', 35, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:10:04', '2026-08-08 02:10:04'),
(271, '2026-02-27', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:10:24', '2026-08-08 02:10:24'),
(272, '2026-03-03', 81, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:10:42', '2026-08-08 02:10:42'),
(273, '2026-03-11', 81, 5, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:11:11', '2026-08-08 02:11:11'),
(274, '2026-03-04', 71, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:11:27', '2026-08-08 02:11:27'),
(275, '2026-03-03', 42, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:11:43', '2026-08-08 02:11:43'),
(276, '2026-03-05', 10, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:12:14', '2026-08-08 02:12:14'),
(277, '2026-03-05', 35, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:12:40', '2026-08-08 02:12:40'),
(278, '2026-05-07', 29, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:13:09', '2026-08-08 02:13:09'),
(279, '2026-03-06', 19, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:13:25', '2026-08-08 02:13:25'),
(280, '2026-03-02', 40, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:13:40', '2026-08-08 02:13:40'),
(281, '2026-03-05', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:13:59', '2026-08-08 02:13:59'),
(282, '2026-03-06', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:14:19', '2026-08-08 02:14:19'),
(283, '2026-03-06', 74, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:14:41', '2026-08-08 02:14:41'),
(284, '2026-03-06', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:15:03', '2026-08-08 02:15:03'),
(285, '2026-03-06', 50, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:15:25', '2026-08-08 02:15:25'),
(286, '2026-03-02', 24, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:20:09', '2026-08-08 02:20:09'),
(287, '2026-02-26', 32, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:20:21', '2026-08-08 02:20:21'),
(288, '2026-02-27', 73, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:20:38', '2026-08-08 02:20:38'),
(289, '2026-02-26', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:21:00', '2026-08-08 02:21:00'),
(290, '2026-03-02', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:23:45', '2026-08-08 02:23:45'),
(291, '2026-02-26', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:24:15', '2026-08-08 02:24:15'),
(292, '2026-02-26', 35, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:24:24', '2026-08-08 02:24:24'),
(293, '2026-03-02', 29, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:24:51', '2026-08-08 02:24:51'),
(294, '2026-03-02', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:25:18', '2026-08-08 02:25:18'),
(295, '2026-03-03', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:25:31', '2026-08-08 02:25:31'),
(296, '2026-03-03', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:25:42', '2026-08-08 02:25:42'),
(297, '2026-03-03', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:25:51', '2026-08-08 02:25:51'),
(298, '2026-02-27', 68, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:26:15', '2026-08-08 02:26:15'),
(299, '2026-03-04', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:26:25', '2026-08-08 02:26:25'),
(300, '2026-03-04', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:26:38', '2026-08-08 02:26:38'),
(301, '2026-03-04', 3, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:26:54', '2026-08-08 02:26:54'),
(302, '2026-03-04', 20, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:27:07', '2026-08-08 02:27:07'),
(303, '2026-02-25', 19, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:27:19', '2026-08-08 02:27:19'),
(304, '2026-03-10', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:28:00', '2026-08-08 02:28:00'),
(305, '2026-03-09', 78, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:28:12', '2026-08-08 02:28:12'),
(306, '2026-03-10', 60, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:28:21', '2026-08-08 02:28:21'),
(307, '2026-03-10', 68, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:28:35', '2026-08-08 02:28:35'),
(308, '2026-03-10', 73, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:28:48', '2026-08-08 02:28:48'),
(309, '2026-03-10', 73, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:29:19', '2026-08-08 02:29:19'),
(310, '2026-03-12', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:29:34', '2026-08-08 02:29:34'),
(311, '2026-03-11', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:29:48', '2026-08-08 02:29:48'),
(312, '2026-03-13', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:30:01', '2026-08-08 02:30:01'),
(313, '2026-03-13', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:30:13', '2026-08-08 02:30:13'),
(314, '2026-03-13', 78, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:30:24', '2026-08-08 02:30:24'),
(315, '2026-03-12', 67, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:30:45', '2026-08-08 02:30:45'),
(316, '2026-03-13', 62, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:30:57', '2026-08-08 02:30:57'),
(317, '2026-03-17', 52, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:31:35', '2026-08-08 02:31:35'),
(318, '2026-03-17', 57, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:31:54', '2026-08-08 02:31:54'),
(319, '2026-03-17', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:32:05', '2026-08-08 02:32:05'),
(320, '2026-03-17', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:32:18', '2026-08-08 02:32:18'),
(321, '2026-03-17', 60, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:32:29', '2026-08-08 02:32:29'),
(322, '2026-03-06', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:32:56', '2026-08-08 02:32:56'),
(323, '2026-03-06', 69, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:33:06', '2026-08-08 02:33:06'),
(324, '2026-03-06', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:33:16', '2026-08-08 02:33:16'),
(325, '2026-03-06', 39, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:33:33', '2026-08-08 02:33:33'),
(326, '2026-03-06', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:33:46', '2026-08-08 02:33:46'),
(327, '2026-03-06', 34, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:33:56', '2026-08-08 02:33:56'),
(328, '2026-03-13', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:34:21', '2026-08-08 02:34:21'),
(329, '2026-03-06', 36, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:34:32', '2026-08-08 02:34:32'),
(330, '2026-03-09', 35, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:34:51', '2026-08-08 02:34:51'),
(331, '2026-03-10', 35, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:35:16', '2026-08-08 02:35:16'),
(332, '2026-03-11', 19, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:35:33', '2026-08-08 02:35:33'),
(333, '2026-03-10', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:35:48', '2026-08-08 02:35:48'),
(334, '2026-03-02', 61, 6, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:36:03', '2026-08-08 02:36:03'),
(335, '2026-03-10', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:36:16', '2026-08-08 02:36:16'),
(336, '2026-03-10', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:36:31', '2026-08-08 02:36:31'),
(337, '2026-03-11', 12, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:36:44', '2026-08-08 02:36:44'),
(338, '2026-03-06', 42, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:36:55', '2026-08-08 02:36:55'),
(339, '2026-03-10', 39, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:37:05', '2026-08-08 02:37:05'),
(340, '2026-03-09', 20, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:37:24', '2026-08-08 02:37:24'),
(341, '2026-02-13', 29, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:38:18', '2026-08-08 02:38:18'),
(342, '2026-03-10', 39, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:38:31', '2026-08-08 02:38:31'),
(343, '2026-03-25', 40, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:38:43', '2026-08-08 02:38:43'),
(344, '2026-03-17', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:39:00', '2026-08-08 02:39:00'),
(345, '2026-03-25', 28, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:39:11', '2026-08-08 02:39:11'),
(346, '2026-03-25', 35, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:39:30', '2026-08-08 02:39:30'),
(347, '2026-03-26', 35, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:39:38', '2026-08-08 02:39:38'),
(348, '2026-03-25', 60, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:39:55', '2026-08-08 02:39:55'),
(349, '2026-03-18', 50, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:40:05', '2026-08-08 02:40:05'),
(350, '2026-03-25', 69, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:40:16', '2026-08-08 02:40:16'),
(351, '2026-03-25', 50, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:40:26', '2026-08-08 02:40:26'),
(352, '2026-03-25', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:40:38', '2026-08-08 02:40:38'),
(353, '2026-03-25', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:40:54', '2026-08-08 02:40:54'),
(354, '2026-03-26', 70, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:41:11', '2026-08-08 02:41:11'),
(355, '2026-03-26', 70, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:41:18', '2026-08-08 02:41:18'),
(356, '2026-03-26', 34, 1, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:41:38', '2026-08-08 02:41:38'),
(357, '2026-03-27', 34, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:41:50', '2026-08-08 02:41:50'),
(358, '2026-03-17', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:42:14', '2026-08-08 02:42:14'),
(359, '2026-03-17', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:42:23', '2026-08-08 02:42:23'),
(360, '2026-03-17', 67, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:42:33', '2026-08-08 02:42:33'),
(361, '2026-03-17', 62, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:42:44', '2026-08-08 02:42:44'),
(362, '2026-03-17', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:42:54', '2026-08-08 02:42:54'),
(363, '2026-03-17', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:43:02', '2026-08-08 02:43:02'),
(364, '2026-03-17', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:43:15', '2026-08-08 02:43:15'),
(365, '2026-03-17', 78, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:43:25', '2026-08-08 02:43:25'),
(366, '2026-03-17', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:43:35', '2026-08-08 02:43:35'),
(367, '2026-03-18', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:43:59', '2026-08-08 02:43:59'),
(368, '2026-03-18', 49, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:47:48', '2026-08-08 02:47:48'),
(369, '2026-03-17', 56, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:48:01', '2026-08-08 02:48:01'),
(370, '2026-03-18', 33, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:48:13', '2026-08-08 02:48:13'),
(371, '2026-03-12', 10, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:48:29', '2026-08-08 02:48:29'),
(372, '2026-03-18', 10, 1, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:48:39', '2026-08-08 02:48:39'),
(373, '2026-03-18', 10, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:48:48', '2026-08-08 02:48:48'),
(374, '2026-03-18', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:49:11', '2026-08-08 02:49:11'),
(375, '2026-03-18', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:49:41', '2026-08-08 02:49:41'),
(376, '2026-03-26', 28, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:50:01', '2026-08-08 02:50:01'),
(377, '2026-03-27', 40, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:50:13', '2026-08-08 02:50:13'),
(378, '2026-04-13', 8, 2, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:50:31', '2026-08-08 02:50:31'),
(379, '2026-04-13', 34, 1, 1, 12, 'Defuncion', NULL, NULL, 1, 'Pendiente', '2026-08-08 02:52:21', '2026-08-08 02:52:21'),
(380, '2026-03-26', 38, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:52:35', '2026-08-08 02:52:35'),
(381, '2026-04-13', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:52:51', '2026-08-08 02:52:51'),
(382, '2026-03-27', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:53:05', '2026-08-08 02:53:05'),
(383, '2026-03-26', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:53:14', '2026-08-08 02:53:14'),
(384, '2026-03-27', 35, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:53:27', '2026-08-08 02:53:27'),
(385, '2026-03-27', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:53:38', '2026-08-08 02:53:38'),
(386, '2026-03-27', 50, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:53:47', '2026-08-08 02:53:47'),
(387, '2026-03-27', 60, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:54:02', '2026-08-08 02:54:02'),
(388, '2026-03-27', 78, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:54:11', '2026-08-08 02:54:11'),
(389, '2026-03-27', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:54:21', '2026-08-08 02:54:21'),
(390, '2026-04-14', 9, 5, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:54:35', '2026-08-08 02:54:35'),
(391, '2026-04-14', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:54:45', '2026-08-08 02:54:45'),
(392, '2026-04-14', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:55:01', '2026-08-08 02:55:01'),
(393, '2026-04-14', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:55:12', '2026-08-08 02:55:12'),
(394, '2026-04-14', 69, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:55:28', '2026-08-08 02:55:28'),
(395, '2026-03-27', 34, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:55:40', '2026-08-08 02:55:40'),
(396, '2026-03-27', 30, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:55:50', '2026-08-08 02:55:50'),
(397, '2026-03-27', 43, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:56:12', '2026-08-08 02:56:12'),
(398, '2026-03-27', 36, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:56:23', '2026-08-08 02:56:23'),
(399, '2026-03-27', 42, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:56:34', '2026-08-08 02:56:34'),
(400, '2026-03-26', 36, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:56:56', '2026-08-08 02:56:56'),
(401, '2026-04-15', 73, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:57:08', '2026-08-08 02:57:08'),
(402, '2026-04-14', 74, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:57:16', '2026-08-08 02:57:16'),
(403, '2026-04-16', 73, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:57:26', '2026-08-08 02:57:26'),
(404, '2026-04-14', 69, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:57:37', '2026-08-08 02:57:37'),
(405, '2026-04-13', 20, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:57:53', '2026-08-08 02:57:53'),
(406, '2026-04-25', 33, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:58:08', '2026-08-08 02:58:08'),
(407, '2026-04-25', 33, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:58:43', '2026-08-08 02:58:43'),
(408, '2026-04-14', 84, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:58:55', '2026-08-08 02:58:55'),
(409, '2026-04-16', 42, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:59:10', '2026-08-08 02:59:10'),
(410, '2026-04-16', 84, 5, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:59:21', '2026-08-08 02:59:21'),
(411, '2026-04-17', 22, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:59:32', '2026-08-08 02:59:32'),
(412, '2026-04-16', 18, 2, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:59:45', '2026-08-08 02:59:45'),
(413, '2026-04-14', 14, 2, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 02:59:58', '2026-08-08 02:59:58'),
(414, '2026-04-20', 64, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:07:45', '2026-08-08 04:07:45'),
(415, '2026-04-21', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:08:06', '2026-08-08 04:08:06'),
(416, '2026-04-24', 29, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:08:39', '2026-08-08 04:08:39'),
(417, '2026-04-22', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:08:57', '2026-08-08 04:08:57'),
(418, '2026-04-21', 16, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:09:24', '2026-08-08 04:09:24'),
(419, '2026-04-21', 20, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:09:41', '2026-08-08 04:09:41'),
(420, '2026-04-17', 62, 5, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:09:54', '2026-08-08 04:09:54'),
(421, '2026-04-23', 60, 3, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:10:11', '2026-08-08 04:10:11'),
(422, '2026-04-25', 66, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:10:34', '2026-08-08 04:10:34'),
(423, '2026-04-22', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:10:56', '2026-08-08 04:10:56'),
(424, '2026-04-23', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:11:13', '2026-08-08 04:11:13'),
(425, '2026-04-23', 69, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:12:45', '2026-08-08 04:12:45'),
(426, '2026-04-23', 50, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:13:07', '2026-08-08 04:13:07'),
(427, '2026-04-22', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:13:53', '2026-08-08 04:13:53'),
(428, '2026-04-22', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:14:20', '2026-08-08 04:14:20'),
(429, '2026-04-22', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:14:36', '2026-08-08 04:14:36'),
(430, '2026-04-22', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:14:49', '2026-08-08 04:14:49'),
(431, '2026-04-16', 66, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:15:59', '2026-08-08 04:15:59'),
(432, '2026-04-16', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:16:25', '2026-08-08 04:16:25'),
(433, '2026-04-15', 3, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:16:53', '2026-08-08 04:16:53'),
(434, '2026-04-17', 3, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:18:19', '2026-08-08 04:18:19'),
(435, '2026-04-16', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:18:40', '2026-08-08 04:18:40'),
(436, '2026-04-17', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:19:00', '2026-08-08 04:19:00'),
(437, '2026-04-15', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:19:17', '2026-08-08 04:19:17'),
(438, '2026-04-17', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:19:33', '2026-08-08 04:19:33'),
(439, '2026-04-15', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:19:56', '2026-08-08 04:19:56'),
(440, '2026-04-17', 3, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:20:41', '2026-08-08 04:20:41'),
(441, '2026-04-17', 3, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:21:06', '2026-08-08 04:21:06'),
(442, '2026-04-14', 12, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:21:35', '2026-08-08 04:21:35'),
(443, '2026-04-20', 37, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:21:51', '2026-08-08 04:21:51'),
(444, '2026-04-17', 73, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:22:20', '2026-08-08 04:22:20'),
(445, '2026-04-20', 80, 3, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:22:41', '2026-08-08 04:22:41');
INSERT INTO `incidencias` (`id`, `fecha`, `empleado_id`, `departamento_id`, `direccion_id`, `tipo_incidencia_id`, `motivo`, `observaciones`, `recibido_por`, `capturado_por`, `estatus`, `created_at`, `updated_at`) VALUES
(446, '2026-04-20', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:23:02', '2026-08-08 04:23:02'),
(447, '2026-04-21', 21, 2, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:23:32', '2026-08-08 04:23:32'),
(448, '2026-04-27', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:24:09', '2026-08-08 04:24:09'),
(449, '2026-04-30', 80, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:24:39', '2026-08-08 04:24:39'),
(450, '2026-04-27', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:24:54', '2026-08-08 04:24:54'),
(451, '2026-04-27', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:25:07', '2026-08-08 04:25:07'),
(452, '2026-04-28', 44, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:25:18', '2026-08-08 04:25:18'),
(453, '2026-04-28', 10, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:25:27', '2026-08-08 04:25:27'),
(454, '2026-04-28', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:25:37', '2026-08-08 04:25:37'),
(455, '2026-04-23', 80, 3, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:25:51', '2026-08-08 04:25:51'),
(456, '2026-04-30', 60, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:26:02', '2026-08-08 04:26:02'),
(457, '2026-04-27', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:26:14', '2026-08-08 04:26:14'),
(458, '2026-04-27', 73, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:26:27', '2026-08-08 04:26:27'),
(459, '2026-04-29', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:26:54', '2026-08-08 04:26:54'),
(460, '2026-04-29', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:27:05', '2026-08-08 04:27:05'),
(461, '2026-04-30', 39, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:27:17', '2026-08-08 04:27:17'),
(462, '2026-04-28', 36, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:27:27', '2026-08-08 04:27:27'),
(463, '2026-04-21', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:27:43', '2026-08-08 04:27:43'),
(464, '2026-04-23', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:27:55', '2026-08-08 04:27:55'),
(465, '2026-04-22', 27, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:28:11', '2026-08-08 04:28:11'),
(466, '2026-04-23', 22, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:28:21', '2026-08-08 04:28:21'),
(467, '2026-04-23', 35, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:28:32', '2026-08-08 04:28:32'),
(468, '2026-04-21', 34, 1, 1, 12, 'Defuncion', NULL, NULL, 1, 'Pendiente', '2026-08-08 04:29:07', '2026-08-08 04:29:07'),
(469, '2026-04-21', 10, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:29:33', '2026-08-08 04:29:33'),
(470, '2026-04-23', 61, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:29:43', '2026-08-08 04:29:43'),
(471, '2026-04-23', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:29:54', '2026-08-08 04:29:54'),
(472, '2026-04-27', 21, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:30:03', '2026-08-08 04:30:03'),
(473, '2026-04-21', 16, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:30:14', '2026-08-08 04:30:14'),
(474, '2026-04-22', 30, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:30:26', '2026-08-08 04:30:26'),
(475, '2026-04-24', 29, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:30:38', '2026-08-08 04:30:38'),
(476, '2026-04-27', 26, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:30:57', '2026-08-08 04:30:57'),
(477, '2026-04-24', 37, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:31:13', '2026-08-08 04:31:13'),
(478, '2026-04-27', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:31:26', '2026-08-08 04:31:26'),
(479, '2026-04-27', 55, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:31:38', '2026-08-08 04:31:38'),
(480, '2026-04-27', 57, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:31:49', '2026-08-08 04:31:49'),
(481, '2026-04-29', 69, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:32:01', '2026-08-08 04:32:01'),
(482, '2026-04-29', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:32:14', '2026-08-08 04:32:14'),
(483, '2026-04-29', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:32:22', '2026-08-08 04:32:22'),
(484, '2026-04-30', 50, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:32:35', '2026-08-08 04:32:35'),
(485, '2026-04-28', 67, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:32:43', '2026-08-08 04:32:43'),
(486, '2026-04-29', 45, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:32:53', '2026-08-08 04:32:53'),
(487, '2026-04-29', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:33:02', '2026-08-08 04:33:02'),
(488, '2026-04-30', 76, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:33:14', '2026-08-08 04:33:14'),
(489, '2026-04-29', 68, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:33:24', '2026-08-08 04:33:24'),
(490, '2026-04-27', 84, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:33:34', '2026-08-08 04:33:34'),
(491, '2026-04-28', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:33:44', '2026-08-08 04:33:44'),
(492, '2026-04-29', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:33:53', '2026-08-08 04:33:53'),
(493, '2026-04-29', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:34:04', '2026-08-08 04:34:04'),
(494, '2026-05-04', 23, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:34:16', '2026-08-08 04:34:16'),
(495, '2026-04-30', 33, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:34:27', '2026-08-08 04:34:27'),
(496, '2026-05-04', 38, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:34:39', '2026-08-08 04:34:39'),
(497, '2026-05-04', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:34:50', '2026-08-08 04:34:50'),
(498, '2026-05-04', 66, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:35:02', '2026-08-08 04:35:02'),
(499, '2026-05-04', 10, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:35:15', '2026-08-08 04:35:15'),
(500, '2026-05-04', 26, 1, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:35:29', '2026-08-08 04:35:29'),
(501, '2026-05-06', 35, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:35:38', '2026-08-08 04:35:38'),
(502, '2026-05-04', 35, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:35:49', '2026-08-08 04:35:49'),
(503, '2026-05-08', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:36:06', '2026-08-08 04:36:06'),
(504, '2026-05-06', 69, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:36:17', '2026-08-08 04:36:17'),
(505, '2026-05-06', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:36:28', '2026-08-08 04:36:28'),
(506, '2026-04-30', 32, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:36:54', '2026-08-08 04:36:54'),
(507, '2026-04-30', 32, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:37:13', '2026-08-08 04:37:13'),
(508, '2026-05-04', 84, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:37:22', '2026-08-08 04:37:22'),
(509, '2026-05-06', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:37:34', '2026-08-08 04:37:34'),
(510, '2026-05-06', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:37:47', '2026-08-08 04:37:47'),
(511, '2026-05-06', 3, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:38:02', '2026-08-08 04:38:02'),
(512, '2026-05-06', 78, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:38:14', '2026-08-08 04:38:14'),
(513, '2026-05-06', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:38:47', '2026-08-08 04:38:47'),
(514, '2026-05-11', 5, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:38:56', '2026-08-08 04:38:56'),
(515, '2026-05-12', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:39:06', '2026-08-08 04:39:06'),
(516, '2026-05-06', 20, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:39:19', '2026-08-08 04:39:19'),
(517, '2026-05-08', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:39:31', '2026-08-08 04:39:31'),
(518, '2026-05-12', 87, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:41:27', '2026-08-08 04:41:27'),
(519, '2026-05-11', 10, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:41:40', '2026-08-08 04:41:40'),
(520, '2026-05-14', 50, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:41:57', '2026-08-08 04:41:57'),
(521, '2026-05-14', 69, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:42:08', '2026-08-08 04:42:08'),
(522, '2026-05-13', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:42:21', '2026-08-08 04:42:21'),
(523, '2026-05-13', 60, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:42:32', '2026-08-08 04:42:32'),
(524, '2026-05-13', 50, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:42:44', '2026-08-08 04:42:44'),
(525, '2026-05-14', 67, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:42:56', '2026-08-08 04:42:56'),
(526, '2026-05-14', 67, 5, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:43:04', '2026-08-08 04:43:04'),
(527, '2026-05-13', 55, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:43:21', '2026-08-08 04:43:21'),
(528, '2026-05-13', 57, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:43:33', '2026-08-08 04:43:33'),
(529, '2026-05-08', 16, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:43:49', '2026-08-08 04:43:49'),
(530, '2026-05-06', 27, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:44:04', '2026-08-08 04:44:04'),
(531, '2026-05-07', 33, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:44:20', '2026-08-08 04:44:20'),
(532, '2026-05-08', 74, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:44:42', '2026-08-08 04:44:42'),
(533, '2026-05-08', 56, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:44:56', '2026-08-08 04:44:56'),
(534, '2026-05-08', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:45:07', '2026-08-08 04:45:07'),
(535, '2026-05-07', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:45:25', '2026-08-08 04:45:25'),
(536, '2026-05-08', 78, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:45:35', '2026-08-08 04:45:35'),
(537, '2026-05-08', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:45:48', '2026-08-08 04:45:48'),
(538, '2026-05-11', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:46:01', '2026-08-08 04:46:01'),
(539, '2026-05-06', 36, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:46:18', '2026-08-08 04:46:18'),
(540, '2026-05-08', 40, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:46:31', '2026-08-08 04:46:31'),
(541, '2026-05-11', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:46:41', '2026-08-08 04:46:41'),
(542, '2026-05-08', 81, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:46:56', '2026-08-08 04:46:56'),
(543, '2026-05-12', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:47:08', '2026-08-08 04:47:08'),
(544, '2026-05-12', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:47:21', '2026-08-08 04:47:21'),
(545, '2026-05-14', 41, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:47:33', '2026-08-08 04:47:33'),
(546, '2026-05-14', 33, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:47:49', '2026-08-08 04:47:49'),
(547, '2026-05-18', 22, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:48:22', '2026-08-08 04:48:22'),
(548, '2026-05-18', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:48:37', '2026-08-08 04:48:37'),
(549, '2026-05-18', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:48:47', '2026-08-08 04:48:47'),
(550, '2026-05-18', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:48:55', '2026-08-08 04:48:55'),
(551, '2026-05-18', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:49:05', '2026-08-08 04:49:05'),
(552, '2026-05-19', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:49:17', '2026-08-08 04:49:17'),
(553, '2026-05-14', 27, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:49:27', '2026-08-08 04:49:27'),
(554, '2026-05-14', 23, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:49:38', '2026-08-08 04:49:38'),
(555, '2026-05-13', 17, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:49:52', '2026-08-08 04:49:52'),
(556, '2026-05-14', 15, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:50:01', '2026-08-08 04:50:01'),
(557, '2026-05-18', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:50:12', '2026-08-08 04:50:12'),
(558, '2026-05-19', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:50:21', '2026-08-08 04:50:21'),
(559, '2026-05-19', 70, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:50:33', '2026-08-08 04:50:33'),
(560, '2026-05-18', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:51:07', '2026-08-08 04:51:07'),
(561, '2026-05-20', 66, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:51:27', '2026-08-08 04:51:27'),
(562, '2026-05-20', 73, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:51:37', '2026-08-08 04:51:37'),
(563, '2026-05-19', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:51:48', '2026-08-08 04:51:48'),
(564, '2026-05-21', 20, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:52:04', '2026-08-08 04:52:04'),
(565, '2026-05-21', 27, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:52:15', '2026-08-08 04:52:15'),
(566, '2026-05-20', 35, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:52:26', '2026-08-08 04:52:26'),
(567, '2026-05-19', 84, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:52:34', '2026-08-08 04:52:34'),
(568, '2026-05-20', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:52:46', '2026-08-08 04:52:46'),
(569, '2026-05-21', 37, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:52:56', '2026-08-08 04:52:56'),
(570, '2026-05-21', 35, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:53:05', '2026-08-08 04:53:05'),
(571, '2026-05-19', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:53:15', '2026-08-08 04:53:15'),
(572, '2026-05-19', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:53:24', '2026-08-08 04:53:24'),
(573, '2026-05-25', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:53:35', '2026-08-08 04:53:35'),
(574, '2026-05-25', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:53:45', '2026-08-08 04:53:45'),
(575, '2026-05-20', 73, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:53:57', '2026-08-08 04:53:57'),
(576, '2026-05-22', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:54:09', '2026-08-08 04:54:09'),
(577, '2026-05-22', 69, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:54:20', '2026-08-08 04:54:20'),
(578, '2026-05-22', 69, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:54:28', '2026-08-08 04:54:28'),
(579, '2026-05-20', 61, 6, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:54:37', '2026-08-08 04:54:37'),
(580, '2026-05-21', 64, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:54:46', '2026-08-08 04:54:46'),
(581, '2026-05-21', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:54:56', '2026-08-08 04:54:56'),
(582, '2026-05-21', 42, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:55:09', '2026-08-08 04:55:09'),
(583, '2026-05-21', 35, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:55:21', '2026-08-08 04:55:21'),
(584, '2026-05-25', 27, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:55:37', '2026-08-08 04:55:37'),
(585, '2026-05-20', 12, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:55:57', '2026-08-08 04:55:57'),
(586, '2026-05-21', 20, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:56:06', '2026-08-08 04:56:06'),
(587, '2026-05-22', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:56:22', '2026-08-08 04:56:22'),
(588, '2026-05-25', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:56:36', '2026-08-08 04:56:36'),
(589, '2026-05-28', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:56:51', '2026-08-08 04:56:51'),
(590, '2026-05-26', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:57:00', '2026-08-08 04:57:00'),
(591, '2026-05-26', 56, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:57:10', '2026-08-08 04:57:10'),
(592, '2026-05-26', 57, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:57:22', '2026-08-08 04:57:22'),
(593, '2026-05-26', 9, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:57:50', '2026-08-08 04:57:50'),
(594, '2026-05-26', 57, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:58:02', '2026-08-08 04:58:02'),
(595, '2026-05-27', 14, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:58:17', '2026-08-08 04:58:17'),
(596, '2026-05-27', 38, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:58:28', '2026-08-08 04:58:28'),
(597, '2026-05-26', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:58:38', '2026-08-08 04:58:38'),
(598, '2026-05-25', 3, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:58:49', '2026-08-08 04:58:49'),
(599, '2026-05-27', 60, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:59:03', '2026-08-08 04:59:03'),
(600, '2026-05-27', 50, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:59:14', '2026-08-08 04:59:14'),
(601, '2026-05-27', 55, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:59:26', '2026-08-08 04:59:26'),
(602, '2026-05-28', 56, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:59:36', '2026-08-08 04:59:36'),
(603, '2026-05-28', 32, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:59:45', '2026-08-08 04:59:45'),
(604, '2026-05-28', 34, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 04:59:57', '2026-08-08 04:59:57'),
(605, '2026-06-01', 10, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:00:15', '2026-08-08 05:00:15'),
(606, '2026-05-27', 27, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:00:25', '2026-08-08 05:00:25'),
(607, '2026-05-20', 12, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:00:34', '2026-08-08 05:00:34'),
(608, '2026-06-01', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:00:48', '2026-08-08 05:00:48'),
(609, '2026-06-01', 60, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:00:58', '2026-08-08 05:00:58'),
(610, '2026-06-01', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:01:10', '2026-08-08 05:01:10'),
(611, '2026-05-28', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:01:24', '2026-08-08 05:01:24'),
(612, '2026-05-27', 62, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:02:01', '2026-08-08 05:02:01'),
(613, '2026-05-28', 78, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:02:10', '2026-08-08 05:02:10'),
(614, '2026-05-29', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 05:02:21', '2026-08-08 05:02:21'),
(615, '2026-06-04', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:16:08', '2026-08-08 06:16:08'),
(616, '2026-06-03', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:16:38', '2026-08-08 06:16:38'),
(617, '2026-06-04', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:17:26', '2026-08-08 06:17:26'),
(618, '2026-06-04', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:17:34', '2026-08-08 06:17:34'),
(619, '2026-06-04', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:17:42', '2026-08-08 06:17:42'),
(620, '2026-06-04', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:17:51', '2026-08-08 06:17:51'),
(621, '2026-06-02', 12, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:18:00', '2026-08-08 06:18:00'),
(622, '2026-06-04', 19, 2, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:18:13', '2026-08-08 06:18:13'),
(623, '2026-06-02', 39, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:18:23', '2026-08-08 06:18:23'),
(624, '2026-06-04', 35, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:18:34', '2026-08-08 06:18:34'),
(625, '2026-06-05', 69, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:18:44', '2026-08-08 06:18:44'),
(626, '2026-06-05', 80, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:19:07', '2026-08-08 06:19:07'),
(627, '2026-06-05', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:19:15', '2026-08-08 06:19:15'),
(628, '2026-06-04', 81, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:19:30', '2026-08-08 06:19:30'),
(629, '2026-06-09', 26, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:19:38', '2026-08-08 06:19:38'),
(630, '2026-06-05', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:19:50', '2026-08-08 06:19:50'),
(631, '2026-06-08', 39, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:20:03', '2026-08-08 06:20:03'),
(632, '2026-05-28', 16, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:20:27', '2026-08-08 06:20:27'),
(633, '2026-06-02', 27, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:20:38', '2026-08-08 06:20:38'),
(634, '2026-04-28', 36, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:21:07', '2026-08-08 06:21:07'),
(635, '2026-06-01', 70, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:21:22', '2026-08-08 06:21:22'),
(636, '2026-06-02', 74, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:21:32', '2026-08-08 06:21:32'),
(637, '2026-05-29', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:21:44', '2026-08-08 06:21:44'),
(638, '2026-06-01', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:21:54', '2026-08-08 06:21:54'),
(639, '2026-06-02', 59, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:22:06', '2026-08-08 06:22:06'),
(640, '2026-06-01', 51, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:22:19', '2026-08-08 06:22:19'),
(641, '2026-06-02', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:22:28', '2026-08-08 06:22:28'),
(642, '2026-05-28', 29, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:22:42', '2026-08-08 06:22:42'),
(643, '2026-06-03', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:22:56', '2026-08-08 06:22:56'),
(644, '2026-05-29', 73, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:23:07', '2026-08-08 06:23:07'),
(645, '2026-06-02', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:23:17', '2026-08-08 06:23:17'),
(646, '2026-06-04', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:23:27', '2026-08-08 06:23:27'),
(647, '2026-06-04', 73, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:23:38', '2026-08-08 06:23:38'),
(648, '2026-06-15', 77, 5, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:23:51', '2026-08-08 06:23:51'),
(649, '2026-06-05', 80, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:24:03', '2026-08-08 06:24:03'),
(650, '2026-06-10', 80, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:24:11', '2026-08-08 06:24:11'),
(651, '2026-06-15', 69, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:24:22', '2026-08-08 06:24:22'),
(652, '2026-06-17', 74, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:24:31', '2026-08-08 06:24:31'),
(653, '2026-06-16', 60, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:24:41', '2026-08-08 06:24:41'),
(654, '2026-06-16', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:24:51', '2026-08-08 06:24:51'),
(655, '2026-06-17', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:25:00', '2026-08-08 06:25:00'),
(656, '2026-06-16', 77, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:25:09', '2026-08-08 06:25:09'),
(657, '2026-06-18', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:25:20', '2026-08-08 06:25:20'),
(658, '2026-06-18', 50, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:25:30', '2026-08-08 06:25:30'),
(659, '2026-06-18', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:25:39', '2026-08-08 06:25:39'),
(660, '2026-06-17', 74, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:25:52', '2026-08-08 06:25:52'),
(661, '2026-06-22', 40, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:26:00', '2026-08-08 06:26:00'),
(662, '2026-06-19', 39, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:26:14', '2026-08-08 06:26:14'),
(663, '2026-06-09', 12, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:26:26', '2026-08-08 06:26:26'),
(664, '2026-06-22', 8, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:26:36', '2026-08-08 06:26:36'),
(665, '2026-06-19', 11, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:26:46', '2026-08-08 06:26:46'),
(666, '2026-06-22', 23, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:26:55', '2026-08-08 06:26:55'),
(667, '2026-06-08', 87, 5, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:27:09', '2026-08-08 06:27:09'),
(668, '2026-06-09', 57, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:27:20', '2026-08-08 06:27:20'),
(669, '2026-06-05', 3, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:27:31', '2026-08-08 06:27:31'),
(670, '2026-06-09', 55, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:27:41', '2026-08-08 06:27:41'),
(671, '2026-06-09', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:27:52', '2026-08-08 06:27:52'),
(672, '2026-06-09', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:28:04', '2026-08-08 06:28:04'),
(673, '2026-06-09', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:28:11', '2026-08-08 06:28:11'),
(674, '2026-06-04', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:28:22', '2026-08-08 06:28:22'),
(675, '2026-06-09', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:28:33', '2026-08-08 06:28:33'),
(676, '2026-06-10', 43, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:28:46', '2026-08-08 06:28:46'),
(677, '2026-06-10', 24, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:29:04', '2026-08-08 06:29:04'),
(678, '2026-06-12', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:29:14', '2026-08-08 06:29:14'),
(679, '2026-06-12', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:29:24', '2026-08-08 06:29:24'),
(680, '2026-06-09', 12, 2, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:29:35', '2026-08-08 06:29:35'),
(681, '2026-06-12', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:29:49', '2026-08-08 06:29:49'),
(682, '2026-06-12', 78, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:29:58', '2026-08-08 06:29:58'),
(683, '2026-06-29', 75, 5, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:30:11', '2026-08-08 06:30:11'),
(684, '2026-06-29', 78, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:30:21', '2026-08-08 06:30:21'),
(685, '2026-06-29', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:30:34', '2026-08-08 06:30:34'),
(686, '2026-06-29', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:30:46', '2026-08-08 06:30:46'),
(687, '2026-06-29', 24, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:30:56', '2026-08-08 06:30:56'),
(688, '2026-06-29', 25, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:31:08', '2026-08-08 06:31:08'),
(689, '2026-06-29', 35, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:31:21', '2026-08-08 06:31:21'),
(690, '2026-06-29', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:31:31', '2026-08-08 06:31:31'),
(691, '2026-07-01', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:31:45', '2026-08-08 06:31:45'),
(692, '2026-07-01', 64, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:32:15', '2026-08-08 06:32:15'),
(693, '2026-07-01', 57, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:32:23', '2026-08-08 06:32:23'),
(694, '2026-06-29', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:32:34', '2026-08-08 06:32:34'),
(695, '2026-07-01', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:32:44', '2026-08-08 06:32:44'),
(696, '2026-07-01', 19, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:32:58', '2026-08-08 06:32:58'),
(697, '2026-07-02', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:33:10', '2026-08-08 06:33:10'),
(698, '2026-07-02', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:33:22', '2026-08-08 06:33:22'),
(699, '2026-07-01', 3, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:33:31', '2026-08-08 06:33:31'),
(700, '2026-06-22', 69, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:33:51', '2026-08-08 06:33:51'),
(701, '2026-06-22', 83, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:34:01', '2026-08-08 06:34:01'),
(702, '2026-06-22', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:34:08', '2026-08-08 06:34:08'),
(703, '2026-06-22', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:34:17', '2026-08-08 06:34:17'),
(704, '2026-06-16', 67, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:34:26', '2026-08-08 06:34:26'),
(705, '2026-06-19', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:34:34', '2026-08-08 06:34:34'),
(706, '2026-06-22', 77, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:34:45', '2026-08-08 06:34:45'),
(707, '2026-06-22', 3, 6, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:34:54', '2026-08-08 06:34:54'),
(708, '2026-06-22', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:35:04', '2026-08-08 06:35:04'),
(709, '2026-06-22', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:35:12', '2026-08-08 06:35:12'),
(710, '2026-06-25', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:35:21', '2026-08-08 06:35:21'),
(711, '2026-06-22', 8, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:35:30', '2026-08-08 06:35:30'),
(712, '2026-06-19', 81, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:35:38', '2026-08-08 06:35:38'),
(713, '2026-06-23', 9, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:35:49', '2026-08-08 06:35:49'),
(714, '2026-06-19', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:35:59', '2026-08-08 06:35:59'),
(715, '2026-06-23', 33, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:36:08', '2026-08-08 06:36:08'),
(716, '2026-06-26', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:36:19', '2026-08-08 06:36:19'),
(717, '2026-06-26', 78, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:36:30', '2026-08-08 06:36:30'),
(718, '2026-07-02', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:36:48', '2026-08-08 06:36:48'),
(719, '2026-07-02', 44, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:36:58', '2026-08-08 06:36:58'),
(720, '2026-07-02', 29, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:37:07', '2026-08-08 06:37:07'),
(721, '2026-07-06', 45, 1, 1, 4, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:37:16', '2026-08-08 06:37:16'),
(722, '2026-07-01', 26, 1, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:37:28', '2026-08-08 06:37:28'),
(723, '2026-07-06', 68, 3, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:37:39', '2026-08-08 06:37:39'),
(724, '2026-07-03', 50, 3, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:37:48', '2026-08-08 06:37:48'),
(725, '2026-07-03', 73, 3, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:37:59', '2026-08-08 06:37:59'),
(726, '2026-06-29', 73, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:38:08', '2026-08-08 06:38:08'),
(727, '2026-07-03', 60, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:38:18', '2026-08-08 06:38:18'),
(728, '2026-07-06', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:38:26', '2026-08-08 06:38:26'),
(729, '2026-07-06', 69, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:38:34', '2026-08-08 06:38:34'),
(730, '2026-07-06', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:38:44', '2026-08-08 06:38:44'),
(731, '2026-07-06', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:38:52', '2026-08-08 06:38:52'),
(732, '2026-07-02', 51, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:39:00', '2026-08-08 06:39:00'),
(733, '2026-07-06', 49, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:39:08', '2026-08-08 06:39:08'),
(734, '2026-07-07', 59, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:39:17', '2026-08-08 06:39:17'),
(735, '2026-07-06', 67, 5, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:39:27', '2026-08-08 06:39:27'),
(736, '2026-07-08', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:39:44', '2026-08-08 06:39:44'),
(737, '2026-07-07', 53, 6, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:39:56', '2026-08-08 06:39:56'),
(738, '2026-07-06', 30, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:40:09', '2026-08-08 06:40:09'),
(739, '2026-07-08', 10, 1, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:40:18', '2026-08-08 06:40:18'),
(740, '2026-07-08', 35, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:40:31', '2026-08-08 06:40:31'),
(741, '2026-07-08', 34, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:40:50', '2026-08-08 06:40:50'),
(742, '2026-07-08', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:41:05', '2026-08-08 06:41:05'),
(743, '2026-07-08', 78, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:41:18', '2026-08-08 06:41:18'),
(744, '2026-07-09', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:41:29', '2026-08-08 06:41:29'),
(745, '2026-07-08', 3, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:41:41', '2026-08-08 06:41:41'),
(746, '2026-07-09', 84, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:41:51', '2026-08-08 06:41:51'),
(747, '2026-07-08', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:42:02', '2026-08-08 06:42:02'),
(748, '2026-07-09', 83, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:42:15', '2026-08-08 06:42:15'),
(749, '2026-07-27', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:42:30', '2026-08-08 06:42:30'),
(750, '2026-07-27', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:42:40', '2026-08-08 06:42:40'),
(751, '2026-07-09', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:42:51', '2026-08-08 06:42:51'),
(752, '2026-07-09', 84, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:43:02', '2026-08-08 06:43:02'),
(753, '2026-07-09', 68, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:43:12', '2026-08-08 06:43:12'),
(754, '2026-07-27', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:43:24', '2026-08-08 06:43:24'),
(755, '2026-07-30', 83, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:43:36', '2026-08-08 06:43:36'),
(756, '2026-07-09', 83, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:43:46', '2026-08-08 06:43:46'),
(757, '2026-07-08', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:43:56', '2026-08-08 06:43:56'),
(758, '2026-07-09', 48, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:44:09', '2026-08-08 06:44:09'),
(759, '2026-07-08', 3, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:44:19', '2026-08-08 06:44:19'),
(760, '2026-07-09', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:44:43', '2026-08-08 06:44:43'),
(761, '2026-07-06', 20, 1, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:44:59', '2026-08-08 06:44:59'),
(762, '2026-07-27', 40, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:45:12', '2026-08-08 06:45:12'),
(763, '2026-07-27', 28, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:45:32', '2026-08-08 06:45:32'),
(764, '2026-07-06', 70, 5, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:45:44', '2026-08-08 06:45:44'),
(765, '2026-07-27', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:45:53', '2026-08-08 06:45:53'),
(766, '2026-07-27', 67, 5, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:46:01', '2026-08-08 06:46:01'),
(767, '2026-07-27', 87, 5, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:46:10', '2026-08-08 06:46:10'),
(768, '2026-07-09', 41, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:46:19', '2026-08-08 06:46:19'),
(769, '2026-07-28', 43, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:46:31', '2026-08-08 06:46:31'),
(770, '2026-07-30', 69, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:46:45', '2026-08-08 06:46:45'),
(771, '2026-07-29', 14, 2, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:46:54', '2026-08-08 06:46:54'),
(772, '2026-07-07', 61, 6, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:47:03', '2026-08-08 06:47:03'),
(773, '2026-07-29', 74, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:47:12', '2026-08-08 06:47:12'),
(774, '2026-07-29', 60, 3, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:47:21', '2026-08-08 06:47:21'),
(775, '2026-07-28', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:47:31', '2026-08-08 06:47:31'),
(776, '2026-07-29', 73, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:47:40', '2026-08-08 06:47:40'),
(777, '2026-07-29', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:47:50', '2026-08-08 06:47:50'),
(778, '2026-07-09', 50, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:47:59', '2026-08-08 06:47:59'),
(779, '2026-07-29', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:48:07', '2026-08-08 06:48:07'),
(780, '2026-07-31', 50, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:48:15', '2026-08-08 06:48:15'),
(781, '2026-07-29', 78, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:48:23', '2026-08-08 06:48:23'),
(782, '2026-07-30', 81, 5, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:48:32', '2026-08-08 06:48:32'),
(783, '2026-07-30', 72, 6, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:48:45', '2026-08-08 06:48:45'),
(784, '2026-07-29', 3, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:48:54', '2026-08-08 06:48:54'),
(785, '2026-07-30', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:49:02', '2026-08-08 06:49:02'),
(786, '2026-07-30', 5, 6, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:49:10', '2026-08-08 06:49:10'),
(787, '2026-07-30', 21, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:49:20', '2026-08-08 06:49:20'),
(788, '2026-07-30', 42, 1, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:49:31', '2026-08-08 06:49:31'),
(789, '2026-07-28', 33, 1, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:49:39', '2026-08-08 06:49:39'),
(790, '2026-07-31', 23, 2, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:49:50', '2026-08-08 06:49:50'),
(791, '2026-07-27', 19, 2, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:50:06', '2026-08-08 06:50:06'),
(792, '2026-07-30', 75, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:50:18', '2026-08-08 06:50:18'),
(793, '2026-07-31', 65, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:50:27', '2026-08-08 06:50:27'),
(794, '2026-07-31', 78, 5, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:50:34', '2026-08-08 06:50:34'),
(795, '2026-07-31', 87, 5, 1, 2, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:50:43', '2026-08-08 06:50:43'),
(796, '2026-07-31', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:50:58', '2026-08-08 06:50:58'),
(797, '2026-07-30', 60, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:51:08', '2026-08-08 06:51:08'),
(798, '2026-07-30', 60, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:51:23', '2026-08-08 06:51:23'),
(799, '2026-07-30', 76, 3, 1, 1, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:51:31', '2026-08-08 06:51:31'),
(800, '2026-08-03', 83, 3, 1, 3, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:51:46', '2026-08-08 06:51:46'),
(801, '2026-07-30', 68, 3, 1, 5, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:51:56', '2026-08-08 06:51:56'),
(802, '2026-07-30', 69, 3, 1, 6, NULL, NULL, NULL, 1, 'Pendiente', '2026-08-08 06:52:07', '2026-08-08 06:52:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_06_154506_create_permission_tables', 1),
(5, '2026_08_06_154701_create_direccions_table', 2),
(6, '2026_08_06_154702_create_departamentos_table', 2),
(7, '2026_08_06_154703_create_puestos_table', 2),
(8, '2026_08_06_154704_create_tipo_incidencias_table', 2),
(9, '2026_08_06_155925_create_empleados_table', 3),
(10, '2026_08_06_161227_add_jefe_id_to_catalogs_table', 4),
(11, '2026_08_06_161344_make_fields_nullable_on_empleados_table', 5),
(12, '2026_08_06_161607_create_incidencias_table', 6),
(13, '2026_08_06_172148_add_activo_to_users_table', 7),
(14, '2026_08_06_195603_add_empleado_id_to_users_table', 8),
(15, '2026_08_10_000001_add_clave_to_departamentos_table', 9),
(16, '2026_08_10_000002_create_oficios_table', 9),
(17, '2026_08_10_000003_create_onedrive_configs_table', 9),
(18, '2026_08_10_000004_make_registrado_por_nullable_in_oficios', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficios`
--

CREATE TABLE `oficios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_oficio` varchar(50) NOT NULL COMMENT 'Folio generado: CLAVE/NNN/AAAA, ej. DASE/283/2026',
  `consecutivo` int(10) UNSIGNED NOT NULL COMMENT 'Número secuencial por departamento + año',
  `anio` smallint(5) UNSIGNED NOT NULL COMMENT 'Año del oficio',
  `departamento_id` bigint(20) UNSIGNED NOT NULL,
  `registrado_por_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_registro` date NOT NULL COMMENT 'Fecha en que se toma el registro',
  `jefe_referencia` varchar(255) NOT NULL COMMENT 'Nombre del jefe/subdirector que necesita la referencia',
  `registrado_por_nombre` varchar(255) NOT NULL COMMENT 'Nombre de la persona que registra (auto, editable)',
  `asunto` text NOT NULL COMMENT 'Asunto del oficio',
  `dirigido_a` varchar(255) NOT NULL COMMENT 'Nombre completo + institución del destinatario',
  `estatus` enum('Pendiente','Entregado','Cancelado') NOT NULL DEFAULT 'Pendiente',
  `cancelado_por` varchar(255) DEFAULT NULL,
  `motivo_cancelacion` text DEFAULT NULL,
  `acuse_url` varchar(500) DEFAULT NULL COMMENT 'URL del archivo de acuse almacenado en OneDrive',
  `acuse_nombre` varchar(255) DEFAULT NULL COMMENT 'Nombre descriptivo del archivo de acuse',
  `fecha_acuse` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `onedrive_configs`
--

CREATE TABLE `onedrive_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departamento_id` bigint(20) UNSIGNED NOT NULL,
  `onedrive_url` varchar(500) NOT NULL COMMENT 'Enlace base de la carpeta compartida en OneDrive del departamento',
  `descripcion` varchar(255) DEFAULT NULL COMMENT 'Descripción o nombre de la carpeta',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `onedrive_configs`
--

INSERT INTO `onedrive_configs` (`id`, `departamento_id`, `onedrive_url`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 7, 'https://bachilleresedu-my.sharepoint.com/:f:/g/personal/dase_bachilleres_edu_mx/IgC_TXblsapVSKpZEbfiXSzwAZj6f0X7aKWFgUH3weBcu30?e=9gC7A9', 'Acuses DASE', '2026-08-10 22:18:32', '2026-08-10 22:18:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ver-dashboard', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(2, 'ver-incidencias', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(3, 'crear-incidencias', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(4, 'editar-incidencias', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(5, 'eliminar-incidencias', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(6, 'ver-empleados', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(7, 'crear-empleados', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(8, 'editar-empleados', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(9, 'dar-baja-empleados', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(10, 'ver-reportes', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(11, 'exportar-reportes', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(12, 'ver-catalogos', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(13, 'gestionar-catalogos', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(14, 'gestionar-usuarios', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(15, 'gestionar-roles', 'web', '2026-08-07 01:56:52', '2026-08-07 01:56:52'),
(16, 'ver-oficios', 'web', '2026-08-10 22:01:08', '2026-08-10 22:01:08'),
(17, 'crear-oficios', 'web', '2026-08-10 22:01:08', '2026-08-10 22:01:08'),
(18, 'editar-oficios', 'web', '2026-08-10 22:01:08', '2026-08-10 22:01:08'),
(19, 'cancelar-oficios', 'web', '2026-08-10 22:01:08', '2026-08-10 22:01:08'),
(20, 'ver-oficios-todos', 'web', '2026-08-10 22:01:08', '2026-08-10 22:01:08'),
(21, 'gestionar-oficios-config', 'web', '2026-08-10 22:01:08', '2026-08-10 22:01:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`id`, `nombre`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'DIRECTOR DE ADMINISTRACIÓN Y SERVICIOS ESCOLARES', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(2, 'COORDINADOR DE PROYECTOS', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(3, 'TAQUIMECANÓGRAFA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(4, 'ANALISTA DE ORIENTACIÓN ESCOLAR', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(5, 'RESPONSABLE DE ARCHIVO DE ADMINISTRACIÓN ESCOLAR', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(6, 'SECRETARIA DE SUBDIRECTOR', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(7, 'JEFE DEL DEPARTAMENTO DE LABORATORIOS', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(8, 'JEFE DEL DEPARTAMENTO', 1, '2026-08-06 18:17:05', '2026-08-07 00:56:03'),
(9, 'JEFE DE DISEÑO Y FABRICACIÓN DE EQUIPO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(10, 'RESPONSABLE DE PROMOCIÓN Y DIFUSIÓN', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(11, 'TÉCNICO EN INFORMÁTICA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(12, 'RESPONSABLE DE SERVICIO PARA LABORATORIO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(13, 'AYUDANTE DE TALLER DE LABORATORIO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(14, 'TÉCNICO LABORATORIO CENTRAL DE CECAT', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(15, 'TÉCNICO LABORATORIO CENTRAL DE FÍSICA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(16, 'TÉCNICO LABORATORIO CENTRAL DE BIOLOGÍA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(17, 'TÉCNICO LABORATORIO CENTRAL DE QUÍMICA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(18, 'AUXILIAR DE TALLER DE LABORATORIO CENTRAL', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(19, 'LABORATORISTA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(20, 'TAQUIMECANÓGRAFA \"A\"', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(21, 'TAQUIMECANÓGRAFA \"B\"', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(22, 'AUXILIAR DE ALMACÉN DE LABORATORIO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(23, 'COORDINADOR DE PROYECTOS DEL LAB. DE QUÍMICA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(24, 'COORDINADOR DE PROYECTOS DEL LAB. DE FÍSICA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(25, 'COORDINADOR DE PROYECTOS DEL LAB. DE BIOLOGÍA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(26, 'COORDINADOR DE PROYECTOS DEL LAB. DE FORMACIÓN LABORAL', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(27, 'BIBLIÓGRAFO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(28, 'RESPONSABLE DE ALMACÉN DE LIBROS', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(29, 'PROCESADOR TÉCNICO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(30, 'AUXILIAR DE PROCESO TÉCNICO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(31, 'AUXILIAR DE SERVICIOS BIBLIOTECARIOS', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(32, 'SUBDIRECTOR DE ADMINISTRACIÓN ESCOLAR', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(33, 'JEFE DEL DEPARTAMENTO DE SERVICIOS ESCOLARES', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(34, 'COORDINADOR DE PROYECTOS DE REVALIDACIÓN', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(35, 'DISEÑADOR DE SISTEMAS SEA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(36, 'COORDINADOR DE ACREDITACIÓN', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(37, 'COORDINADOR DE ANALISTAS', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(38, 'ANALISTA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(39, 'ASESOR PSICOPEDAGÓGICO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(40, 'RESPONSABLE DE PRIMER INGRESO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(41, 'RESPONSABLE DE SUPERVISIÓN DE SERVICIOS ESCOLARES', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(42, 'RESPONSABLE DE PLAZAS COMUNITARIAS', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(43, 'RESPONSABLE DE SERVICIOS ESCOLARES', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(44, 'RESPONSABLE TÉCNICO DEL DEPARTAMENTO DE PLANEACIÓN Y SUPERVISIÓN', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(45, 'RESPONSABLE DE INGRESO POR EQUIVALENCIA O REVALIDACIÓN', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(46, 'PROGRAMADOR', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(47, 'CAPTURISTA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(48, 'AUXILIAR DE ACREDITACIÓN SEA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(49, 'AUXILIAR DEL DEPARTAMENTO DE EVALUACIÓN', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(50, 'AUXILIAR DE CENTRO DE ESTUDIOS RECONOCIDOS', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(51, 'AUXILIAR DEL DEPARTAMENTO DE REVALIDACIÓN DE ESTUDIOS', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(52, 'AUXILIAR DE CORRESPONDENCIA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(53, 'ARCHIVISTA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(54, 'JEFE DEL DEPARTAMENTO DE SERVICIOS EDUCATIVOS A DISTANCIA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(55, 'RESPONSABLE DE SERVICIOS ESCOLARES Y CENTROS DE ESTUDIO RECONOCIDOS', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(56, 'RESPONSABLE DE GESTIÓN Y SEGUIMIENTO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(57, 'COORDINADOR DE ASESORÍA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(58, 'ASESOR DE CONTENIDO', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(59, 'PROFESOR HORAS CLASE CB.I', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(60, 'RESPONSABLE DE PROGRAMAS ESPECIALES', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(61, 'RESPONSABLE DE APLICACIÓN Y GESTORÍA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(62, 'RESPONSABLE DE ATENCIÓN A INSTITUCIONES', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(63, 'AUXILIAR DE COMUNICACIONES', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(64, 'GRABADOR DE CORRESPONDENCIA', 1, '2026-08-06 18:17:05', '2026-08-06 18:17:05'),
(65, 'SECRETARIO DE SERVICIOS INSTITUCIONALES', 1, '2026-08-07 02:14:32', '2026-08-07 02:14:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'web', '2026-08-06 21:45:55', '2026-08-06 21:45:55'),
(2, 'Capturista', 'web', '2026-08-06 21:45:55', '2026-08-06 21:45:55'),
(3, 'Jefe', 'web', '2026-08-06 21:45:55', '2026-08-06 21:45:55'),
(4, 'Asistente', 'web', '2026-08-10 22:01:08', '2026-08-10 22:01:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 3),
(5, 1),
(6, 1),
(6, 3),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 3),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(16, 3),
(16, 4),
(17, 1),
(17, 4),
(18, 1),
(18, 4),
(19, 1),
(19, 4),
(20, 1),
(20, 3),
(21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('YrqRtVRDAesPfyT1JWCyAIDaBnXduhUU58TcPx1M', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidXVKbHc0bWhGN0FjMGdEWEY0Q0dyRUY2ZU41ZUQ0SmdmWTVuUlJmTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9taXMtb2ZpY2lvcy8yIjtzOjU6InJvdXRlIjtzOjEyOiJvZmljaW9zLnNob3ciO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1786381258);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_incidencias`
--

CREATE TABLE `tipo_incidencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `requiere_motivo` tinyint(1) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_incidencias`
--

INSERT INTO `tipo_incidencias` (`id`, `nombre`, `requiere_motivo`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Omisión de Entrada', 0, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(2, 'Omisión de Salida', 0, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(3, 'Inasistencia', 0, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(4, 'Nota Buena', 0, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(5, 'Permiso Económico', 1, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(6, 'Quinquenio', 0, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(7, 'Retardo', 0, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(8, 'Vacaciones', 0, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(9, 'Incapacidad', 1, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(10, 'Cambio de Horario', 1, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(11, 'Comisión', 1, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(12, 'Justificante', 1, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01'),
(13, 'Suspensión', 1, 1, '2026-08-06 22:23:01', '2026-08-06 22:23:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `empleado_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `activo`, `empleado_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador del Sistema', 'admin@sicip.com', 1, NULL, NULL, '$2y$12$pyMXbKZpfeFJB0Rt2Ah7C.DRRTGcPGRbkxJABhmHtCCY43wegsjVK', NULL, '2026-08-06 21:45:55', '2026-08-06 21:45:55'),
(2, 'ISABEL OLIVERA RAMIREZ', 'isabel.olivera@bachilleres.edu.mx', 1, 2, NULL, '$2y$12$UDsOu3bGAgpwrHgAGkElB.BZjpX6e30kfFsW2E7eC2NWBhOddxiMO', NULL, '2026-08-07 02:07:08', '2026-08-07 02:17:29'),
(3, 'JUAN LUIS MARMOLEJO MACIAS', 'juan.marmolejo@bachilleres.edu.mx', 1, 82, NULL, '$2y$12$TwUU3kSrdGSOAEhcXt0hxONrM1WCUHNM1oErYtEhXgkJNT09Fpng.', NULL, '2026-08-07 02:17:16', '2026-08-07 02:17:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamentos_direccion_id_foreign` (`direccion_id`),
  ADD KEY `departamentos_jefe_id_foreign` (`jefe_id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `direcciones_nombre_unique` (`nombre`),
  ADD KEY `direcciones_jefe_id_foreign` (`jefe_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empleados_numero_empleado_unique` (`numero_empleado`),
  ADD KEY `empleados_puesto_id_foreign` (`puesto_id`),
  ADD KEY `empleados_departamento_id_foreign` (`departamento_id`),
  ADD KEY `empleados_direccion_id_foreign` (`direccion_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidencias_empleado_id_foreign` (`empleado_id`),
  ADD KEY `incidencias_departamento_id_foreign` (`departamento_id`),
  ADD KEY `incidencias_direccion_id_foreign` (`direccion_id`),
  ADD KEY `incidencias_tipo_incidencia_id_foreign` (`tipo_incidencia_id`),
  ADD KEY `incidencias_capturado_por_foreign` (`capturado_por`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `oficios`
--
ALTER TABLE `oficios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_folio` (`departamento_id`,`anio`,`consecutivo`),
  ADD UNIQUE KEY `oficios_numero_oficio_unique` (`numero_oficio`),
  ADD KEY `oficios_registrado_por_user_id_foreign` (`registrado_por_user_id`);

--
-- Indices de la tabla `onedrive_configs`
--
ALTER TABLE `onedrive_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `onedrive_configs_departamento_id_unique` (`departamento_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `puestos_nombre_unique` (`nombre`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tipo_incidencias`
--
ALTER TABLE `tipo_incidencias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo_incidencias_nombre_unique` (`nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_empleado_id_foreign` (`empleado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=803;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `oficios`
--
ALTER TABLE `oficios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `onedrive_configs`
--
ALTER TABLE `onedrive_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_incidencias`
--
ALTER TABLE `tipo_incidencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_direccion_id_foreign` FOREIGN KEY (`direccion_id`) REFERENCES `direcciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `departamentos_jefe_id_foreign` FOREIGN KEY (`jefe_id`) REFERENCES `empleados` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_jefe_id_foreign` FOREIGN KEY (`jefe_id`) REFERENCES `empleados` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `empleados_direccion_id_foreign` FOREIGN KEY (`direccion_id`) REFERENCES `direcciones` (`id`),
  ADD CONSTRAINT `empleados_puesto_id_foreign` FOREIGN KEY (`puesto_id`) REFERENCES `puestos` (`id`);

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `incidencias_capturado_por_foreign` FOREIGN KEY (`capturado_por`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `incidencias_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `incidencias_direccion_id_foreign` FOREIGN KEY (`direccion_id`) REFERENCES `direcciones` (`id`),
  ADD CONSTRAINT `incidencias_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`),
  ADD CONSTRAINT `incidencias_tipo_incidencia_id_foreign` FOREIGN KEY (`tipo_incidencia_id`) REFERENCES `tipo_incidencias` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `oficios`
--
ALTER TABLE `oficios`
  ADD CONSTRAINT `oficios_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `oficios_registrado_por_user_id_foreign` FOREIGN KEY (`registrado_por_user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `onedrive_configs`
--
ALTER TABLE `onedrive_configs`
  ADD CONSTRAINT `onedrive_configs_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
