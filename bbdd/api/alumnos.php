<?php
require './bd/conexion.php';

$sql = "SELECT dni, CONCAT(nombre, ' ', apellido1, ' ', apellido2) AS nombre, email FROM usuarios WHERE rol = 'alumno'";
$result = $conn->query($sql);

$alumnos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $alumnos[] = $row;
    }
}

echo json_encode($alumnos);
?>
