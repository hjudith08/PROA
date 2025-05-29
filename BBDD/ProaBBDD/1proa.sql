-- Crear base de datos
CREATE DATABASE IF NOT EXISTS proa;
USE proa;

-- Tabla grupos
CREATE TABLE grupos (
    grupo_id VARCHAR(10) PRIMARY KEY,
    nombre_grupo VARCHAR(100),
    descripcion TEXT,
    fecha_creacion DATE DEFAULT CURRENT_DATE
);

-- Tabla rol
CREATE TABLE rol (
    rol_id VARCHAR(10) PRIMARY KEY,
    nombre_rol VARCHAR(100),
    descripcion TEXT,
    fecha_creacion DATE DEFAULT CURRENT_DATE
);

-- Tabla usuarios
CREATE TABLE usuarios (
    dni VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido1 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50),
    email VARCHAR(254) UNIQUE NOT NULL,
    password VARCHAR(64) NOT NULL,
    rol_id VARCHAR(10) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    grupo_id VARCHAR(10) NOT NULL,
    despacho VARCHAR(50),
    FOREIGN KEY (grupo_id) REFERENCES grupos(grupo_id) ON DELETE CASCADE,
    FOREIGN KEY (rol_id) REFERENCES rol(rol_id)
);

-- Tabla asignaturas
CREATE TABLE asignaturas (
    id_asignatura INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    codigo VARCHAR(20) UNIQUE,
    descripcion TEXT,
    tipo_titulacion ENUM('Grado', 'Doble Grado', 'Máster'),
    curso ENUM('1', '2', '3', '4'),
    cuatrimestre ENUM('1', '2'),
    objetivo_asignatura TEXT,
    informacion_extra TEXT,
    grupo_id VARCHAR(10) NOT NULL,
    FOREIGN KEY (grupo_id) REFERENCES grupos(grupo_id) ON DELETE CASCADE
);

-- Tabla profesores_asignaturas
CREATE TABLE profesores_asignaturas (
    dni_profesor VARCHAR(10),
    id_asignatura INT,
    PRIMARY KEY (dni_profesor, id_asignatura),
    FOREIGN KEY (dni_profesor) REFERENCES usuarios(dni) ON DELETE CASCADE,
    FOREIGN KEY (id_asignatura) REFERENCES asignaturas(id_asignatura) ON DELETE CASCADE
);

-- Tabla alumnos_asignaturas
CREATE TABLE alumnos_asignaturas (
    dni_alumno VARCHAR(10),
    id_asignatura INT,
    PRIMARY KEY (dni_alumno, id_asignatura),
    FOREIGN KEY (dni_alumno) REFERENCES usuarios(dni) ON DELETE CASCADE,
    FOREIGN KEY (id_asignatura) REFERENCES asignaturas(id_asignatura) ON DELETE CASCADE
);

-- Tabla tareas
CREATE TABLE tareas (
    id_tarea INT AUTO_INCREMENT PRIMARY KEY,
    id_asignatura INT,
    titulo VARCHAR(100),
    descripcion TEXT,
    fecha_apertura DATE,
    fecha_entrega DATE,
    puntuacion_maxima DECIMAL(5,2),
    archivo_adjunto VARCHAR(255),
    creado_por VARCHAR(10),
    grupo_id VARCHAR(10) NOT NULL,
    FOREIGN KEY (id_asignatura) REFERENCES asignaturas(id_asignatura) ON DELETE CASCADE,
    FOREIGN KEY (creado_por) REFERENCES usuarios(dni) ON DELETE SET NULL,
    FOREIGN KEY (grupo_id) REFERENCES grupos(grupo_id) ON DELETE CASCADE
);

-- Tabla entregas
CREATE TABLE entregas (
    id_entrega INT AUTO_INCREMENT PRIMARY KEY,
    id_tarea INT,
    dni_alumno VARCHAR(10),
    archivo_entregado VARCHAR(255),
    fecha_entrega DATETIME,
    nota DECIMAL(5,2),
    comentarios_profesor TEXT,
    grupo_id VARCHAR(10) NOT NULL,
    FOREIGN KEY (id_tarea) REFERENCES tareas(id_tarea) ON DELETE CASCADE,
    FOREIGN KEY (dni_alumno) REFERENCES usuarios(dni) ON DELETE CASCADE,
    FOREIGN KEY (grupo_id) REFERENCES grupos(grupo_id) ON DELETE CASCADE
);

-- Tabla historial_visitas
CREATE TABLE historial_visitas (
    id_historial INT PRIMARY KEY AUTO_INCREMENT,
    dni_usuario VARCHAR(10),
    id_asignatura INT,
    fecha_visita DATETIME,
    grupo_id VARCHAR(10) NOT NULL,
    FOREIGN KEY (dni_usuario) REFERENCES usuarios(dni) ON DELETE CASCADE,
    FOREIGN KEY (id_asignatura) REFERENCES asignaturas(id_asignatura) ON DELETE CASCADE,
    FOREIGN KEY (grupo_id) REFERENCES grupos(grupo_id) ON DELETE CASCADE
);
