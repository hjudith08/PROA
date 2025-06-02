-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-06-2025 a las 10:28:00
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
-- Base de datos: `jcatsen_proa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_asignaturas`
--

CREATE TABLE `alumnos_asignaturas` (
  `dni_alumno` varchar(10) NOT NULL,
  `id_asignatura` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `alumnos_asignaturas`
--

INSERT INTO `alumnos_asignaturas` (`dni_alumno`, `id_asignatura`) VALUES
('1100112', 101),
('1100113', 101),
('1320191', 101),
('9218611', 101),
('9971924', 101),
('1320191', 102),
('9218611', 102),
('9971924', 102),
('1320191', 103),
('9218611', 103),
('9971924', 103),
('1320191', 104),
('9218611', 104),
('9971924', 104),
('1320191', 105),
('9218611', 105),
('9971924', 105),
('1320191', 106),
('9218611', 106),
('9971924', 106),
('1320191', 107),
('9218611', 107),
('9971924', 107),
('1320191', 108),
('9218611', 108),
('9971924', 108),
('1320191', 109),
('9218611', 109),
('9971924', 109);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int NOT NULL,
  `nombre_original` varchar(255) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `fecha_subida` datetime DEFAULT CURRENT_TIMESTAMP,
  `dni_alumno` varchar(10) NOT NULL,
  `id_tarea` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `nombre_original`, `ruta`, `fecha_subida`, `dni_alumno`, `id_tarea`) VALUES
(1, '8añadirTreas.sql', 'entrega_9218611_16_1748605138.sql', '2025-05-30 13:38:58', '9218611', 16),
(2, 'fuseriv_proa.sql', 'entrega_9218611_32_1748607759.sql', '2025-05-30 14:22:39', '9218611', 32),
(3, 'Práctica 4.pdf', 'entrega_9218611_6_1748686214.pdf', '2025-05-31 12:10:14', '9218611', 6),
(4, 'conexion.inc', 'entrega_9218611_5_1748688097.inc', '2025-05-31 12:41:37', '9218611', 5),
(5, 'ordenador-proa.png', 'entrega_9218611_4_1748808165.png', '2025-06-01 22:02:45', '9218611', 4),
(6, 'ordenador-proa.png', 'entrega_9218611_4_1748808507.png', '2025-06-01 22:08:27', '9218611', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id_asignatura` int NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` text,
  `tipo_titulacion` enum('Grado','Doble Grado','Máster') DEFAULT NULL,
  `curso` enum('1','2','3','4') DEFAULT NULL,
  `cuatrimestre` enum('1','2') DEFAULT NULL,
  `objetivo_asignatura` text,
  `informacion_extra` text,
  `grupo_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id_asignatura`, `nombre`, `codigo`, `descripcion`, `tipo_titulacion`, `curso`, `cuatrimestre`, `objetivo_asignatura`, `informacion_extra`, `grupo_id`) VALUES
(101, 'Programación 1', 'PROG101', 'Introducción a la programación.', 'Grado', '1', '1', 'dfdfdf', 'extra', '001'),
(102, 'Electrónica básica', 'ELEC102', 'Fundamentos de electrónica.', 'Grado', '1', '1', 'objetivo', 'extra', '001'),
(103, 'Fundamentos físicos', 'FISI103', 'Bases de la física aplicada.', 'Grado', '1', '1', 'objetivo', 'extra', '001'),
(104, 'Álgebra Matricial', 'ALG104', 'Matrices y álgebra lineal.', 'Grado', '1', '2', 'objetivo', 'extra', '001'),
(105, 'Proyecto CDIO', 'PROJ105', 'Proyecto integrador CDIO.', 'Grado', '2', '2', 'objetivo', 'extra', '001'),
(106, 'Proyecto de Diseño', 'PROJ106', 'Proyecto de diseño técnico.', 'Grado', '2', '1', 'sadsd', 'fffff', '001'),
(107, 'Redes y Comunicación', 'RED107', 'Introducción a redes de datos.', 'Grado', '2', '1', 'objetivodccd', 'extraddcdc', '001'),
(108, 'Diseño de Interfaces', 'DISE108', 'Diseño centrado en el usuario.', 'Grado', '2', '2', 'objetivo', 'extra', '001'),
(109, 'Programación 2', 'PROG109', 'Programación avanzada.', 'Grado', '2', '2', 'objetivo', 'extra', '001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `id_entrega` int NOT NULL,
  `id_tarea` int DEFAULT NULL,
  `dni_alumno` varchar(10) DEFAULT NULL,
  `archivo_entregado` varchar(255) DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `nota` decimal(5,2) DEFAULT NULL,
  `comentarios_profesor` text,
  `grupo_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`id_entrega`, `id_tarea`, `dni_alumno`, `archivo_entregado`, `fecha_entrega`, `nota`, `comentarios_profesor`, `grupo_id`) VALUES
(13, 4, '9218611', 'entrega_9218611_4_1748808507.png', '2025-06-01 22:08:27', 2.00, NULL, '001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `grupo_id` varchar(10) NOT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `fecha_creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`grupo_id`, `nombre_grupo`, `descripcion`, `fecha_creacion`) VALUES
('001', 'Grupo para sprint', 'Grupo inicial de PROA para el sprint', '2025-05-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_visitas`
--

CREATE TABLE `historial_visitas` (
  `id_historial` int NOT NULL,
  `dni_usuario` varchar(10) DEFAULT NULL,
  `id_asignatura` int DEFAULT NULL,
  `fecha_visita` datetime DEFAULT NULL,
  `grupo_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores_asignaturas`
--

CREATE TABLE `profesores_asignaturas` (
  `dni_profesor` varchar(10) NOT NULL,
  `id_asignatura` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `profesores_asignaturas`
--

INSERT INTO `profesores_asignaturas` (`dni_profesor`, `id_asignatura`) VALUES
('2200221', 101),
('2200222', 101),
('4525956', 101),
('2200222', 102),
('2200223', 102),
('2200224', 102),
('6055365', 102),
('6738133', 103),
('4525956', 104),
('4525956', 105),
('6055365', 106),
('6055365', 107),
('6738133', 108),
('6738133', 109);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` varchar(10) NOT NULL,
  `nombre_rol` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `fecha_creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre_rol`, `descripcion`, `fecha_creacion`) VALUES
('alumno', 'Alumno', 'Estudiante matriculado', '2025-05-29'),
('pas', 'PAS', 'Personal de administración y servicios', '2025-05-29'),
('profesor', 'Profesor', 'Personal docente', '2025-05-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int NOT NULL,
  `id_asignatura` int DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `fecha_apertura` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `puntuacion_maxima` decimal(5,2) DEFAULT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `creado_por` varchar(10) DEFAULT NULL,
  `grupo_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `id_asignatura`, `titulo`, `descripcion`, `fecha_apertura`, `fecha_entrega`, `puntuacion_maxima`, `archivo_adjunto`, `creado_por`, `grupo_id`) VALUES
(2, 101, 'Práctica 2. Concurrencia y Hilos', 'Gestiona múltiples hilos y sincronización de datos en C++.', '2025-02-01', '2025-02-15', 10.00, NULL, '4525956', '001'),
(3, 101, 'Práctica 1. Asíncronía y Filtros', 'Explora programación asíncrona y diseño de filtros en C++.', '2025-01-01', '2025-01-15', 10.00, NULL, '4525956', '001'),
(4, 104, 'asdaa', 'Aplica álgebra matricial en problemas reales.', '2025-03-01', '2025-03-15', 10.00, NULL, '4525956', '001'),
(5, 104, 'Práctica 2. Sistemas de Ecuaciones Lineales', 'Resuelve sistemas usando métodos matriciales.', '2025-02-01', '2025-02-15', 10.00, NULL, '4525956', '001'),
(6, 104, 'Práctica 1. Matrices y Operaciones', 'Realiza operaciones básicas con matrices y vectores.', '2025-01-01', '2025-01-15', 10.00, NULL, '4525956', '001'),
(7, 105, 'Práctica 3. Presentación y Evaluación', 'Prepara presentaciones para evaluar el proyecto.', '2025-03-01', '2025-03-15', 10.00, NULL, '4525956', '001'),
(8, 105, 'Práctica 2. Desarrollo de Prototipos', 'Construye prototipos funcionales para el proyecto.', '2025-02-01', '2025-02-15', 10.00, NULL, '4525956', '001'),
(9, 105, 'Práctica 1. Planificación de Proyectos', 'Organiza las fases del proyecto CDIO.', '2025-01-01', '2025-01-15', 10.00, NULL, '4525956', '001'),
(10, 102, 'Práctica 3. Análisis de Señales', 'Estudia y procesa señales eléctricas con herramientas electrónicas.', '2025-03-01', '2025-03-15', 10.00, NULL, '6055365', '001'),
(11, 102, 'Práctica 2. Electrónica Digital', 'Implementa circuitos digitales usando compuertas y flip-flops.', '2025-02-01', '2025-02-15', 10.00, NULL, '6055365', '001'),
(12, 102, 'Práctica 1. Circuitos Básicos', 'Diseña y analiza circuitos eléctricos básicos y componentes electrónicos.', '2025-01-01', '2025-01-15', 10.00, NULL, '6055365', '001'),
(13, 106, 'Práctica 3. Documentación Técnica', 'Elabora documentación para diseños técnicos.', '2025-03-01', '2025-03-15', 10.00, NULL, '6055365', '001'),
(14, 106, 'Práctica 2. Herramientas de CAD', 'Usa software CAD para diseño asistido.', '2025-02-01', '2025-02-15', 10.00, NULL, '6055365', '001'),
(15, 106, 'Práctica 1. Diseño Técnico Básico', 'Realiza dibujos técnicos y bocetos de diseño.', '2025-01-01', '2025-01-15', 10.00, NULL, '6055365', '001'),
(16, 107, 'Práctica 10. Seguridad en Redes', 'Aplica conceptos básicos de seguridad de red.', '2025-03-01', '2025-03-15', 10.00, NULL, '6055365', '001'),
(17, 107, 'Práctica 2. Configuración de Equipos', 'Configura routers y switches básicos.', '2025-02-01', '2025-02-15', 10.00, NULL, '6055365', '001'),
(18, 107, 'Práctica 1. Fundamentos de Redes', 'Estudia modelos OSI y TCP/IP.', '2025-01-01', '2025-01-15', 10.00, NULL, '6055365', '001'),
(19, 103, 'Práctica 3. Termodinámica Básica', 'Estudia la energía, trabajo y calor en sistemas físicos.', '2025-03-01', '2025-03-15', 10.00, NULL, '6738133', '001'),
(20, 103, 'Práctica 2. Dinámica y Cinemática', 'Analiza movimiento de partículas y sistemas de cuerpos.', '2025-02-01', '2025-02-15', 10.00, NULL, '6738133', '001'),
(21, 103, 'Práctica 1. Leyes de Newton', 'Aplica las leyes de Newton en problemas físicos fundamentales.', '2025-01-01', '2025-01-15', 10.00, NULL, '6738133', '001'),
(22, 108, 'Práctica 3. Evaluación de Usabilidad', 'Realiza tests de usabilidad y mejora interfaces.', '2025-03-01', '2025-03-15', 10.00, NULL, '6738133', '001'),
(23, 108, 'Práctica 2. Prototipado de Interfaces', 'Crea prototipos funcionales con herramientas UI.', '2025-02-01', '2025-02-15', 10.00, NULL, '6738133', '001'),
(24, 108, 'Práctica 1. Principios de Diseño UI', 'Analiza principios básicos de diseño de interfaces.', '2025-01-01', '2025-01-15', 10.00, NULL, '6738133', '001'),
(25, 109, 'Práctica 3. Optimización de Código', 'Aplica técnicas para optimizar el rendimiento.', '2025-03-01', '2025-03-15', 10.00, NULL, '6738133', '001'),
(26, 109, 'Práctica 2. Plantillas y Excepciones', 'Implementa plantillas y manejo de excepciones.', '2025-02-01', '2025-02-15', 10.00, NULL, '6738133', '001'),
(27, 109, 'Práctica 1. Programación Orientada a Objetos', 'Desarrolla conceptos avanzados de POO en C++.', '2025-01-01', '2025-01-15', 10.00, NULL, '6738133', '001'),
(32, 107, 'adqdeº1ºº', 'eowioiweioewio', '2025-05-31', '2025-06-08', 10.00, '683921', '9971924', NULL),
(33, 106, '333', 'qweqweqwewqeqweqwe', '2025-05-01', '2025-05-13', 3.00, 'INSERT INTO entregas (id_tarea, dni_alumno, archivo_entregado, fecha_entrega, nota, comentarios_profesor, grupo_id)\r\nVALUES\r\n    -- Alumno 9218611 entrega la tarea 1\r\n    (1, \'9218611\', \'practica1_9218611.zip\', \'2025-01-10 15:00:00\', 9.5, \'Muy buen trabaj', '9971924', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(64) NOT NULL,
  `rol_id` varchar(10) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `grupo_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellido1`, `apellido2`, `email`, `password`, `rol_id`, `telefono`, `grupo_id`) VALUES
('1100111', 'Carla', 'Navarro', 'Gómez', 'c.navgom@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123464', '001'),
('1100112', 'Iván', 'Torres', 'Sánchez', 'i.torsan@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123465', '001'),
('1100113', 'Lucía', 'Martínez', 'Rubio', 'l.marrub@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123466', '001'),
('1100114', 'Sergio', 'Ortega', 'López', 's.ortlop@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123467', '001'),
('1100115', 'Ana', 'Gil', 'Molina', 'a.gilmol@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123468', '001'),
('1316390', 'Ondrea', 'Brezlaw', 'Sherwill', 'o.breshe@upv.es', 'bb851090dcc953ef26cae58f00c3c8aa50170e667ef57b076271a96851d7c598', 'pas', '600123462', '001'),
('1320191', 'Merline', 'Kirdsch', 'Kampshell', 'm.kirkam@epsg.upv.es', '08536a0e845bc337e4eabe7f11cdc060db8762b72f6ea3759191e6acb4b0ac8d', 'alumno', '600123457', '001'),
('1970980', 'Brooke', 'Malimoe', 'Thomerson', 'b.maltho@upv.es', '8ef036a12431278a81500e463d247a9712e798be4870848f21703c847bf1f0a8', 'pas', '600123463', '001'),
('2200221', 'David', 'Ramírez', 'Soria', 'd.ramsor@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123469', '001'),
('2200222', 'Elena', 'Pérez', 'Navas', 'e.pernav@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123470', '001'),
('2200223', 'Marcos', 'Herrera', 'Vidal', 'm.hervid@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123471', '001'),
('2200224', 'Nuria', 'Castillo', 'Paredes', 'n.caspar@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123472', '001'),
('2200225', 'Jorge', 'Gallego', 'Blanco', 'j.galbla@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123473', '001'),
('4525956', 'Kevan', 'Pounds', 'Mainston', 'k.poumai@upv.es', 'f64fa63b2e00256c04262c7d08df6071b768719cd0ef86b38a8735a67472569d', 'profesor', '600123459', '001'),
('6055365', 'Luelle', 'Pridmore', 'Starsmeare', 'l.prista@upv.es', '3c6dcef0938cfaceeb3ad106f0fa6f282369719f6be74f003067cb02a49e684d', 'profesor', '600123460', '001'),
('6738133', 'Eolande', 'Merriton', 'Mizzi', 'e.mermiz@upv.es', '973b8ce9ecabbfc63328c93601bfed364e25036e5d1da3ae0f222adf4d54513b', 'profesor', '600123461', '001'),
('9218611', 'Lief', 'Simants', 'Dredge', 'l.simdre@epsg.upv.es', '8dfc2f2f0b4ba9ed2bcc2c0d3eacac63a8a7afde2cbf04e00c1ac5c9b0be7c1a', 'alumno', '600123456', '001'),
('9971924', 'Debora', 'Rawstorne', NULL, 'd.rawabc@epsg.upv.es', 'ccfa9b051d91b247edaf003a3252c61ddd76b272cba6b8aed343f8425eae684f', 'alumno', '600123458', '001');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos_asignaturas`
--
ALTER TABLE `alumnos_asignaturas`
  ADD PRIMARY KEY (`dni_alumno`,`id_asignatura`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dni_alumno` (`dni_alumno`),
  ADD KEY `id_tarea` (`id_tarea`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id_entrega`),
  ADD KEY `id_tarea` (`id_tarea`),
  ADD KEY `dni_alumno` (`dni_alumno`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`grupo_id`);

--
-- Indices de la tabla `historial_visitas`
--
ALTER TABLE `historial_visitas`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `dni_usuario` (`dni_usuario`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `profesores_asignaturas`
--
ALTER TABLE `profesores_asignaturas`
  ADD PRIMARY KEY (`dni_profesor`,`id_asignatura`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `grupo_id` (`grupo_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id_asignatura` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id_entrega` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `historial_visitas`
--
ALTER TABLE `historial_visitas`
  MODIFY `id_historial` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos_asignaturas`
--
ALTER TABLE `alumnos_asignaturas`
  ADD CONSTRAINT `alumnos_asignaturas_ibfk_1` FOREIGN KEY (`dni_alumno`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `alumnos_asignaturas_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE CASCADE;

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_ibfk_1` FOREIGN KEY (`dni_alumno`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `archivos_ibfk_2` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `asignaturas_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE,
  ADD CONSTRAINT `entregas_ibfk_2` FOREIGN KEY (`dni_alumno`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `entregas_ibfk_3` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historial_visitas`
--
ALTER TABLE `historial_visitas`
  ADD CONSTRAINT `historial_visitas_ibfk_1` FOREIGN KEY (`dni_usuario`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `historial_visitas_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE CASCADE,
  ADD CONSTRAINT `historial_visitas_ibfk_3` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `profesores_asignaturas`
--
ALTER TABLE `profesores_asignaturas`
  ADD CONSTRAINT `profesores_asignaturas_ibfk_1` FOREIGN KEY (`dni_profesor`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `profesores_asignaturas_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE CASCADE,
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`dni`) ON DELETE SET NULL,
  ADD CONSTRAINT `tareas_ibfk_3` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
