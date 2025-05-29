<?php
<!-- filepath: c:\xampp\htdocs\PROA\src\app\includes\conexion.inc -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proa";

// Crear conexión usando mysqli
$connProa = new mysqli($servername, $username, $password, $dbname);

// Establecer codificación de caracteres
if (!$connProa->set_charset('utf8mb4')) {
    die("Error al establecer la codificación de caracteres: " . $connProa->error);
}

// Verificar conexión
if ($connProa->connect_error) {
    die("Conexión fallida: " . $connProa->connect_error);
}
?>