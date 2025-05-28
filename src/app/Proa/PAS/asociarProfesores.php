<?php
$conexion = new mysqli("localhost:3306", "jcivapo_proa", "proa1234!", "jcivapo_proa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$idAsignatura = intval($_POST['id_asignatura']);
$profesoresSeleccionados = $_POST['profesores'] ?? [];

// 1. Eliminar todas las asociaciones actuales
$stmtDelete = $conexion->prepare("DELETE FROM profesores_asignaturas WHERE id_asignatura = ?");
$stmtDelete->bind_param("i", $idAsignatura);
$stmtDelete->execute();

// 2. Insertar los seleccionados
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
