<?php
require './bd/conexion.php';

$sql = "SELECT id_asignatura, nombre, curso, cuatrimestre FROM asignaturas";
$result = $conn->query($sql);

$asignaturas = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $asignaturas[] = $row;
    }
}

echo json_encode($asignaturas);
?>
