-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 30-05-2025 a les 03:37:46
-- Versió del servidor: 10.4.32-MariaDB
-- Versió de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `proa`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `alumnos_asignaturas`
--

CREATE TABLE `alumnos_asignaturas` (
  `dni_alumno` varchar(10) NOT NULL,
  `id_asignatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `alumnos_asignaturas`
--

INSERT INTO `alumnos_asignaturas` (`dni_alumno`, `id_asignatura`) VALUES
('1320191', 101),
('1320191', 102),
('1320191', 103),
('1320191', 104),
('1320191', 105),
('1320191', 106),
('1320191', 107),
('1320191', 108),
('1320191', 109),
('9218611', 101),
('9218611', 102),
('9218611', 103),
('9218611', 104),
('9218611', 105),
('9218611', 106),
('9218611', 107),
('9218611', 108),
('9218611', 109),
('9971924', 101),
('9971924', 102),
('9971924', 103),
('9971924', 104),
('9971924', 105),
('9971924', 106),
('9971924', 107),
('9971924', 108),
('9971924', 109);

-- --------------------------------------------------------

--
-- Estructura de la taula `archivos`
--

CREATE TABLE `archivos` (
  `id` int(11) NOT NULL,
  `nombre_original` varchar(255) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `fecha_subida` datetime DEFAULT current_timestamp(),
  `dni_alumno` varchar(10) NOT NULL,
  `id_tarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `archivos`
--

INSERT INTO `archivos` (`id`, `nombre_original`, `ruta`, `fecha_subida`, `dni_alumno`, `id_tarea`) VALUES
(1, 'filtroBlanco.png', 'entrega_9218611_16_1748563922.png', '2025-05-30 02:12:02', '9218611', 16);

-- --------------------------------------------------------

--
-- Estructura de la taula `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id_asignatura` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo_titulacion` enum('Grado','Doble Grado','Máster') DEFAULT NULL,
  `curso` enum('1','2','3','4') DEFAULT NULL,
  `cuatrimestre` enum('1','2') DEFAULT NULL,
  `objetivo_asignatura` text DEFAULT NULL,
  `informacion_extra` text DEFAULT NULL,
  `grupo_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `asignaturas`
--

INSERT INTO `asignaturas` (`id_asignatura`, `nombre`, `codigo`, `descripcion`, `tipo_titulacion`, `curso`, `cuatrimestre`, `objetivo_asignatura`, `informacion_extra`, `grupo_id`) VALUES
(101, 'Programación 1', 'PROG101', 'Introducción a la programación.', 'Grado', '1', '1', NULL, NULL, '001'),
(102, 'Electrónica básica', 'ELEC102', 'Fundamentos de electrónica.', 'Grado', '1', '1', NULL, NULL, '001'),
(103, 'Fundamentos físicos', 'FISI103', 'Bases de la física aplicada.', 'Grado', '1', '1', NULL, NULL, '001'),
(104, 'Álgebra Matricial', 'ALG104', 'Matrices y álgebra lineal.', 'Grado', '1', '2', NULL, NULL, '001'),
(105, 'Proyecto CDIO', 'PROJ105', 'Proyecto integrador CDIO.', 'Grado', '2', '2', NULL, NULL, '001'),
(106, 'Proyecto de Diseño', 'PROJ106', 'Proyecto de diseño técnico.', 'Grado', '2', '1', NULL, NULL, '001'),
(107, 'Redes y Comunicación', 'RED107', 'Introducción a redes de datos.', 'Grado', '2', '1', NULL, NULL, '001'),
(108, 'Diseño de Interfaces', 'DISE108', 'Diseño centrado en el usuario.', 'Grado', '2', '2', NULL, NULL, '001'),
(109, 'Programación 2', 'PROG109', 'Programación avanzada.', 'Grado', '2', '2', NULL, NULL, '001');

-- --------------------------------------------------------

--
-- Estructura de la taula `entregas`
--

CREATE TABLE `entregas` (
  `id_entrega` int(11) NOT NULL,
  `id_tarea` int(11) DEFAULT NULL,
  `dni_alumno` varchar(10) DEFAULT NULL,
  `archivo_entregado` varchar(255) DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `nota` decimal(5,2) DEFAULT NULL,
  `comentarios_profesor` text DEFAULT NULL,
  `grupo_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `entregas`
--

INSERT INTO `entregas` (`id_entrega`, `id_tarea`, `dni_alumno`, `archivo_entregado`, `fecha_entrega`, `nota`, `comentarios_profesor`, `grupo_id`) VALUES
(1, 1, '9218611', 'practica1_9218611.zip', '2025-01-10 15:00:00', 9.50, 'Muy buen trabajo.', '001'),
(2, 1, '1320191', 'practica1_1320191.zip', '2025-01-11 11:30:00', NULL, 'Bien, pero faltan detalles.', '001'),
(3, 2, '9971924', 'practica2_9971924.zip', '2025-02-12 16:30:00', 8.00, NULL, '001'),
(4, 3, '1100111', 'practica3_1100111.zip', '2025-03-14 14:45:00', NULL, 'Falta mejorar la optimización.', '001'),
(5, 2, '1100112', 'practica2_1100112.zip', '2025-02-13 10:15:00', 6.50, 'Correcto, pero incompleto.', '001'),
(6, 3, '1100113', 'practica3_1100113.zip', '2025-03-15 10:00:00', 10.00, 'Excelente trabajo.', '001'),
(7, 16, '9218611', 'entrega_9218611_16_1748563922.png', '2025-05-30 02:12:02', 5.00, NULL, '001');

-- --------------------------------------------------------

--
-- Estructura de la taula `grupos`
--

CREATE TABLE `grupos` (
  `grupo_id` varchar(10) NOT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `grupos`
--

INSERT INTO `grupos` (`grupo_id`, `nombre_grupo`, `descripcion`, `fecha_creacion`) VALUES
('001', 'Grupo para sprint', 'Grupo inicial de PROA para el sprint', '2025-05-29');

-- --------------------------------------------------------

--
-- Estructura de la taula `historial_visitas`
--

CREATE TABLE `historial_visitas` (
  `id_historial` int(11) NOT NULL,
  `dni_usuario` varchar(10) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `fecha_visita` datetime DEFAULT NULL,
  `grupo_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `profesores_asignaturas`
--

CREATE TABLE `profesores_asignaturas` (
  `dni_profesor` varchar(10) NOT NULL,
  `id_asignatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `profesores_asignaturas`
--

INSERT INTO `profesores_asignaturas` (`dni_profesor`, `id_asignatura`) VALUES
('4525956', 101),
('4525956', 104),
('4525956', 105),
('6055365', 102),
('6055365', 106),
('6055365', 107),
('6738133', 103),
('6738133', 108),
('6738133', 109);

-- --------------------------------------------------------

--
-- Estructura de la taula `rol`
--

CREATE TABLE `rol` (
  `rol_id` varchar(10) NOT NULL,
  `nombre_rol` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre_rol`, `descripcion`, `fecha_creacion`) VALUES
('alumno', 'Alumno', 'Estudiante matriculado', '2025-05-29'),
('pas', 'PAS', 'Personal de administración y servicios', '2025-05-29'),
('profesor', 'Profesor', 'Personal docente', '2025-05-29');

-- --------------------------------------------------------

--
-- Estructura de la taula `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_apertura` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `puntuacion_maxima` decimal(5,2) DEFAULT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `creado_por` varchar(10) DEFAULT NULL,
  `grupo_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `id_asignatura`, `titulo`, `descripcion`, `fecha_apertura`, `fecha_entrega`, `puntuacion_maxima`, `archivo_adjunto`, `creado_por`, `grupo_id`) VALUES
(1, 101, 'Práctica 3. STL y Algoritmos', 'Utiliza la Standard Template Library para resolver problemas comunes.', '2025-03-01', '2025-03-15', 10.00, NULL, '4525956', '001'),
(2, 101, 'Práctica 2. Concurrencia y Hilos', 'Gestiona múltiples hilos y sincronización de datos en C++.', '2025-02-01', '2025-02-15', 10.00, NULL, '4525956', '001'),
(3, 101, 'Práctica 1. Asíncronía y Filtros', 'Explora programación asíncrona y diseño de filtros en C++.', '2025-01-01', '2025-01-15', 10.00, NULL, '4525956', '001'),
(4, 104, 'Práctica 3. Aplicaciones del Álgebra Lineal', 'Aplica álgebra matricial en problemas reales.', '2025-03-01', '2025-03-15', 10.00, NULL, '4525956', '001'),
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
(16, 107, 'Práctica 3. Seguridad en Redes', 'Aplica conceptos básicos de seguridad de red.', '2025-03-01', '2025-03-15', 10.00, NULL, '6055365', '001'),
(17, 107, 'Práctica 2. Configuración de Equipos', 'Configura routers y switches básicos.', '2025-02-01', '2025-02-15', 10.00, NULL, '6055365', '001'),
(19, 103, 'Práctica 3. Termodinámica Básica', 'Estudia la energía, trabajo y calor en sistemas físicos.', '2025-03-01', '2025-03-15', 10.00, NULL, '6738133', '001'),
(20, 103, 'Práctica 2. Dinámica y Cinemática', 'Analiza movimiento de partículas y sistemas de cuerpos.', '2025-02-01', '2025-02-15', 10.00, NULL, '6738133', '001'),
(21, 103, 'Práctica 1. Leyes de Newton', 'Aplica las leyes de Newton en problemas físicos fundamentales.', '2025-01-01', '2025-01-15', 10.00, NULL, '6738133', '001'),
(22, 108, 'Práctica 3. Evaluación de Usabilidad', 'Realiza tests de usabilidad y mejora interfaces.', '2025-03-01', '2025-03-15', 10.00, NULL, '6738133', '001'),
(23, 108, 'Práctica 2. Prototipado de Interfaces', 'Crea prototipos funcionales con herramientas UI.', '2025-02-01', '2025-02-15', 10.00, NULL, '6738133', '001'),
(24, 108, 'Práctica 1. Principios de Diseño UI', 'Analiza principios básicos de diseño de interfaces.', '2025-01-01', '2025-01-15', 10.00, NULL, '6738133', '001'),
(25, 109, 'Práctica 3. Optimización de Código', 'Aplica técnicas para optimizar el rendimiento.', '2025-03-01', '2025-03-15', 10.00, NULL, '6738133', '001'),
(26, 109, 'Práctica 2. Plantillas y Excepciones', 'Implementa plantillas y manejo de excepciones.', '2025-02-01', '2025-02-15', 10.00, NULL, '6738133', '001'),
(27, 109, 'Práctica 1. Programación Orientada a Objetos', 'Desarrolla conceptos avanzados de POO en C++.', '2025-01-01', '2025-01-15', 10.00, NULL, '6738133', '001');

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
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
  `grupo_id` varchar(10) NOT NULL,
  `despacho` varchar(50) DEFAULT NULL,
  `departamento_profesor` enum('Informática','Matemáticas','Física','Diseño') DEFAULT NULL,
  `carrera_alumno` enum('Informática','Matemáticas','Física','Diseño') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellido1`, `apellido2`, `email`, `password`, `rol_id`, `telefono`, `grupo_id`, `despacho`, `departamento_profesor`, `carrera_alumno`) VALUES
('1100111', 'Carla', 'Navarro', 'Gómez', 'c.navgom@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123464', '001', NULL, NULL, 'Diseño'),
('1100112', 'Iván', 'Torres', 'Sánchez', 'i.torsan@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123465', '001', NULL, NULL, 'Informática'),
('1100113', 'Lucía', 'Martínez', 'Rubio', 'l.marrub@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123466', '001', NULL, NULL, 'Matemáticas'),
('1100114', 'Sergio', 'Ortega', 'López', 's.ortlop@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123467', '001', NULL, NULL, 'Física'),
('1100115', 'Ana', 'Gil', 'Molina', 'a.gilmol@epsg.upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'alumno', '600123468', '001', NULL, NULL, 'Diseño'),
('1316390', 'Ondrea', 'Brezlaw', 'Sherwill', 'o.breshe@upv.es', 'bb851090dcc953ef26cae58f00c3c8aa50170e667ef57b076271a96851d7c598', 'pas', '600123462', '001', NULL, NULL, NULL),
('1320191', 'Merline', 'Kirdsch', 'Kampshell', 'm.kirkam@epsg.upv.es', '08536a0e845bc337e4eabe7f11cdc060db8762b72f6ea3759191e6acb4b0ac8d', 'alumno', '600123457', '001', NULL, NULL, 'Matemáticas'),
('1970980', 'Brooke', 'Malimoe', 'Thomerson', 'b.maltho@upv.es', '8ef036a12431278a81500e463d247a9712e798be4870848f21703c847bf1f0a8', 'pas', '600123463', '001', NULL, NULL, NULL),
('2200221', 'David', 'Ramírez', 'Soria', 'd.ramsor@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123469', '001', 'DES126', 'Diseño', NULL),
('2200222', 'Elena', 'Pérez', 'Navas', 'e.pernav@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123470', '001', 'DES127', 'Informática', NULL),
('2200223', 'Marcos', 'Herrera', 'Vidal', 'm.hervid@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123471', '001', 'DES128', 'Matemáticas', NULL),
('2200224', 'Nuria', 'Castillo', 'Paredes', 'n.caspar@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123472', '001', 'DES129', 'Física', NULL),
('2200225', 'Jorge', 'Gallego', 'Blanco', 'j.galbla@upv.es', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'profesor', '600123473', '001', 'DES130', 'Diseño', NULL),
('4525956', 'Kevan', 'Pounds', 'Mainston', 'k.poumai@upv.es', 'f64fa63b2e00256c04262c7d08df6071b768719cd0ef86b38a8735a67472569d', 'profesor', '600123459', '001', 'DES123', 'Informática', NULL),
('6055365', 'Luelle', 'Pridmore', 'Starsmeare', 'l.prista@upv.es', '3c6dcef0938cfaceeb3ad106f0fa6f282369719f6be74f003067cb02a49e684d', 'profesor', '600123460', '001', 'DES124', 'Matemáticas', NULL),
('6738133', 'Eolande', 'Merriton', 'Mizzi', 'e.mermiz@upv.es', '973b8ce9ecabbfc63328c93601bfed364e25036e5d1da3ae0f222adf4d54513b', 'profesor', '600123461', '001', 'DES125', 'Física', NULL),
('9218611', 'Lief', 'Simants', 'Dredge', 'l.simdre@epsg.upv.es', '8dfc2f2f0b4ba9ed2bcc2c0d3eacac63a8a7afde2cbf04e00c1ac5c9b0be7c1a', 'alumno', '600123456', '001', NULL, NULL, 'Informática'),
('9971924', 'Debora', 'Rawstorne', NULL, 'd.rawabc@epsg.upv.es', 'ccfa9b051d91b247edaf003a3252c61ddd76b272cba6b8aed343f8425eae684f', 'alumno', '600123458', '001', NULL, NULL, 'Física');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `alumnos_asignaturas`
--
ALTER TABLE `alumnos_asignaturas`
  ADD PRIMARY KEY (`dni_alumno`,`id_asignatura`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Índexs per a la taula `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dni_alumno` (`dni_alumno`),
  ADD KEY `id_tarea` (`id_tarea`);

--
-- Índexs per a la taula `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Índexs per a la taula `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id_entrega`),
  ADD KEY `id_tarea` (`id_tarea`),
  ADD KEY `dni_alumno` (`dni_alumno`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Índexs per a la taula `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`grupo_id`);

--
-- Índexs per a la taula `historial_visitas`
--
ALTER TABLE `historial_visitas`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `dni_usuario` (`dni_usuario`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Índexs per a la taula `profesores_asignaturas`
--
ALTER TABLE `profesores_asignaturas`
  ADD PRIMARY KEY (`dni_profesor`,`id_asignatura`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Índexs per a la taula `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Índexs per a la taula `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Índexs per a la taula `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `grupo_id` (`grupo_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la taula `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT per la taula `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la taula `historial_visitas`
--
ALTER TABLE `historial_visitas`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `alumnos_asignaturas`
--
ALTER TABLE `alumnos_asignaturas`
  ADD CONSTRAINT `alumnos_asignaturas_ibfk_1` FOREIGN KEY (`dni_alumno`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `alumnos_asignaturas_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_ibfk_1` FOREIGN KEY (`dni_alumno`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `archivos_ibfk_2` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `asignaturas_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE,
  ADD CONSTRAINT `entregas_ibfk_2` FOREIGN KEY (`dni_alumno`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `entregas_ibfk_3` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `historial_visitas`
--
ALTER TABLE `historial_visitas`
  ADD CONSTRAINT `historial_visitas_ibfk_1` FOREIGN KEY (`dni_usuario`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `historial_visitas_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE CASCADE,
  ADD CONSTRAINT `historial_visitas_ibfk_3` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `profesores_asignaturas`
--
ALTER TABLE `profesores_asignaturas`
  ADD CONSTRAINT `profesores_asignaturas_ibfk_1` FOREIGN KEY (`dni_profesor`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `profesores_asignaturas_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE CASCADE,
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`dni`) ON DELETE SET NULL,
  ADD CONSTRAINT `tareas_ibfk_3` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
