<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname_edusync = "edusync";
$dbname_proa = "proa";

// Conexión a EduSync (base de datos principal)
$conn_edusync = new mysqli($servername, $username, $password, $dbname_edusync);

// Verificar conexión EduSync
if ($conn_edusync->connect_error) {
    die("Conexión fallida a EduSync: " . $conn_edusync->connect_error);
}

// Conexión a PROA (base de datos secundaria)
$conn_proa = new mysqli($servername, $username, $password, $dbname_proa);

// Verificar conexión PROA
if ($conn_proa->connect_error) {
    die("Conexión fallida a PROA: " . $conn_proa->connect_error);
}

// Establecer codificación de caracteres para ambas conexiones
if (!$conn_edusync->set_charset('utf8mb4')) {
    die("Error al establecer la codificación en EduSync: " . $conn_edusync->error);
}

if (!$conn_proa->set_charset('utf8mb4')) {
    die("Error al establecer la codificación en PROA: " . $conn_proa->error);
}
