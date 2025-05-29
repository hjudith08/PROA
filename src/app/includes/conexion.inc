<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proa";

// Crear conexión usando mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Establecer codificación de caracteres
if (!$conn->set_charset('utf8mb4')) {
    die("Error al establecer la codificación de caracteres: " . $conn->error);
}

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

