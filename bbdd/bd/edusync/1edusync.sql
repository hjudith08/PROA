-- Crear base de datos y seleccionarla
CREATE DATABASE IF NOT EXISTS edusync;
USE edusync;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    apellidos VARCHAR(60) NOT NULL,
    email VARCHAR(254) NOT NULL,
    password VARCHAR(64) NOT NULL,
    estado TINYINT(1) NOT NULL DEFAULT 0,
    token VARCHAR(36) DEFAULT NULL,
    validez_token DATETIME DEFAULT NULL,
    PRIMARY KEY (id)
);

-- Tabla de herramientas
CREATE TABLE herramientas (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    PRIMARY KEY (id)
);

-- Tabla intermedia: herramientas compradas por usuarios
CREATE TABLE usuarios_herramientas (
    usuario_id INT(11) NOT NULL,
    herramienta_id INT(11) NOT NULL,
    PRIMARY KEY (usuario_id, herramienta_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (herramienta_id) REFERENCES herramientas(id) ON DELETE CASCADE
);
