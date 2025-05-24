<?php
require './bd/conexion.php';

$sql = "SELECT dni, CONCAT(nombre, ' ', apellido1, ' ', apellido2) AS nombre, email FROM usuarios WHERE rol = 'profesor'";
$result = $conn->query($sql);

$profesores = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $profesores[] = $row;
    }
}

echo json_encode($profesores);
?>
