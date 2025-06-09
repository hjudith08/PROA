<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../includes/conexion.inc';

$idAsignatura = intval($_POST['id_asignatura']);
$alumnosSeleccionados = $_POST['alumnos'] ?? [];

try {
    // Eliminar los alumnos de esta asignatura
    $stmtDelete = $conn_proa->prepare("DELETE FROM alumnos_asignaturas WHERE id_asignatura = ?");
    $stmtDelete->bind_param("i", $idAsignatura);
    $stmtDelete->execute();

    // Insertar alumnos a una asignatura
    if (!empty($alumnosSeleccionados)) {
        $stmtInsert = $conn_proa->prepare("INSERT INTO alumnos_asignaturas (dni_alumno, id_asignatura) VALUES (?, ?)");
        foreach ($alumnosSeleccionados as $dni) {
            $stmtInsert->bind_param("si", $dni, $idAsignatura);
            $stmtInsert->execute();
        }
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