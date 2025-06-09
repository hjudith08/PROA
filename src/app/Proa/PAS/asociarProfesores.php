<?php
include __DIR__ . '../../../includes/conexion.inc';

$idAsignatura = intval($_POST['id_asignatura']);
$profesoresSeleccionados = $_POST['profesores'] ?? [];

// eliminar los alumnos de esta asignatura
$stmtDelete = $conn_proa->prepare("DELETE FROM profesores_asignaturas WHERE id_asignatura = ?");
$stmtDelete->bind_param("i", $idAsignatura);
$stmtDelete->execute();

// insertar alumnos a una asignatura
if (!empty($profesoresSeleccionados)) {
    $stmtInsert = $conn_proa->prepare("INSERT INTO profesores_asignaturas (dni_profesor, id_asignatura) VALUES (?, ?)");
    foreach ($profesoresSeleccionados as $dni) {
        $stmtInsert->bind_param("si", $dni, $idAsignatura);
        $stmtInsert->execute();
    }
}

$conn_proa->close();
header("Location: PasInicio.php");
exit;
?>
