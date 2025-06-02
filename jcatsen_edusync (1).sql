-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-06-2025 a las 20:03:27
-- Versión del servidor: 8.0.42-0ubuntu0.20.04.1
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jcatsen_edusync`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientas`
--

CREATE TABLE `herramientas` (
  `id` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `herramientas`
--

INSERT INTO `herramientas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'PROA', 'bblblblblblblblblblblblblbblblblblblblbl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `validez_token` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `estado`, `token`, `validez_token`) VALUES
(1, 'Daniel', 'Palacio', 'dapasa@har.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, NULL, NULL),
(2, 'José Luis', 'Gimenez', 'jogilo@upvnet.upv.es', 'db2e7f1bd5ab9968ae76199b7cc74795ca7404d5a08d78567715ce532f9d2669', 1, NULL, NULL),
(32, 'asdasd', 'asdasd', '1234@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, '683ddc90bb721', '2025-06-02 20:17:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_herramientas`
--

CREATE TABLE `usuarios_herramientas` (
  `usuario_id` int NOT NULL,
  `herramienta_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_herramientas`
--

INSERT INTO `usuarios_herramientas` (`usuario_id`, `herramienta_id`) VALUES
(1, 1),
(2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_herramientas`
--
ALTER TABLE `usuarios_herramientas`
  ADD PRIMARY KEY (`usuario_id`,`herramienta_id`),
  ADD KEY `herramienta_id` (`herramienta_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios_herramientas`
--
ALTER TABLE `usuarios_herramientas`
  ADD CONSTRAINT `usuarios_herramientas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_herramientas_ibfk_2` FOREIGN KEY (`herramienta_id`) REFERENCES `herramientas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
