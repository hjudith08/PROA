<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../includes/conexion.inc';

$idAsignatura = intval($_POST['id_asignatura']);
$profesorSeleccionado = $_POST['profesor'] ?? null; // Solo uno, tipo radio

try {
    // Eliminar los profesores de esta asignatura
    $stmtDelete = $conn_proa->prepare("DELETE FROM profesores_asignaturas WHERE id_asignatura = ?");
    $stmtDelete->bind_param("i", $idAsignatura);
    $stmtDelete->execute();

    // Insertar profesor a una asignatura (solo uno)
    if (!empty($profesorSeleccionado)) {
        $stmtInsert = $conn_proa->prepare("INSERT INTO profesores_asignaturas (dni_profesor, id_asignatura) VALUES (?, ?)");
        $stmtInsert->bind_param("si", $profesorSeleccionado, $idAsignatura);
        $stmtInsert->execute();
    }

    $conn_proa->close();
    header("Location: PasInicio.php?msg=ok");
    exit;
} catch (Exception $e) {
    $conn_proa->close();
    header("Location: PasInicio.php?msg=error");
    exit;
}
?>