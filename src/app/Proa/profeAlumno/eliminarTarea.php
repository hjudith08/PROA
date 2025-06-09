<?php
include '../../includes/conexion.inc';

$id_tarea = isset($_GET['id_tarea']) ? intval($_GET['id_tarea']) : 0;
$id_asignatura = isset($_GET['id_asignatura']) ? intval($_GET['id_asignatura']) : 0;

if ($id_tarea <= 0 || $id_asignatura <= 0) {
    die("Parámetros inválidos.");
}

// Eliminar la tarea (y opcionalmente sus entregas si la tabla entregas existe)
$stmt = $conn_proa->prepare("DELETE FROM tareas WHERE id_tarea = ?");
$stmt->bind_param("i", $id_tarea);
$stmt->execute();

// Redirigir de vuelta a la lista de tareas
header("Location: tareas.php?id=$id_asignatura");
exit;