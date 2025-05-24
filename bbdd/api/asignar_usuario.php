<?php
require './bd/conexion.php';

$id_asignatura = $_POST['id_asignatura'] ?? null;
$usuarios = $_POST['usuarios'] ?? [];
$rol = $_POST['rol'] ?? '';

if ($id_asignatura && $usuarios && in_array($rol, ['alumno', 'profesor'])) {
    foreach ($usuarios as $dni) {
        if ($rol === 'alumno') {
            $stmt = $conn->prepare("INSERT IGNORE INTO alumnos_asignaturas (dni_alumno, id_asignatura) VALUES (?, ?)");
        } else {
            $stmt = $conn->prepare("INSERT IGNORE INTO profesores_asignaturas (dni_profesor, id_asignatura) VALUES (?, ?)");
        }
        $stmt->bind_param("si", $dni, $id_asignatura);
        $stmt->execute();
    }
    header("Location: asignatura.php?id=$id_asignatura");
    exit;
} else {
    echo "Error: datos incompletos o inválidos.";
}
?>
