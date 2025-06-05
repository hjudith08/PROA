<?php
$conexion = new mysqli("localhost:3306", "fuseriv_proa3", "123proa321", "fuseriv_proa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$idAsignatura = intval($_POST['id_asignatura']);
$profesoresSeleccionados = $_POST['profesores'] ?? [];

// eliminar los alumnos de esta asignatura
$stmtDelete = $conexion->prepare("DELETE FROM profesores_asignaturas WHERE id_asignatura = ?");
$stmtDelete->bind_param("i", $idAsignatura);
$stmtDelete->execute();

// insertar alumnos a una asignatura
if (!empty($profesoresSeleccionados)) {
    $stmtInsert = $conexion->prepare("INSERT INTO profesores_asignaturas (dni_profesor, id_asignatura) VALUES (?, ?)");
    foreach ($profesoresSeleccionados as $dni) {
        $stmtInsert->bind_param("si", $dni, $idAsignatura);
        $stmtInsert->execute();
    }
}

$conexion->close();
header("Location: PasInicio.php");
exit;
?>
