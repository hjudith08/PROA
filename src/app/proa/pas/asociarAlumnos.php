<?php
$conexion = new mysqli("localhost:3306", "jcivapo_proa", "proa1234!", "jcivapo_proa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$idAsignatura = intval($_POST['id_asignatura']);
$alumnosSeleccionados = $_POST['alumnos'] ?? [];

// eliminar los profesores de esta asignatura
$stmtDelete = $conexion->prepare("DELETE FROM alumnos_asignaturas WHERE id_asignatura = ?");
$stmtDelete->bind_param("i", $idAsignatura);
$stmtDelete->execute();

// insertar profesores a una asignatura
if (!empty($alumnosSeleccionados)) {
    $stmtInsert = $conexion->prepare("INSERT INTO alumnos_asignaturas (dni_alumno, id_asignatura) VALUES (?, ?)");
    foreach ($alumnosSeleccionados as $dni) {
        $stmtInsert->bind_param("si", $dni, $idAsignatura);
        $stmtInsert->execute();
    }
}

$conexion->close();
header("Location: PasInicio.php");
exit;
?>
