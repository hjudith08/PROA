<?php
include '../../includes/conexion.inc';

// Validar si vino el id de tarea
if (!isset($_POST['id_tarea'])) {
    die("ID de tarea no proporcionado.");
}

// Recoger los datos del formulario
$id_tarea = intval($_POST['id_tarea']);
$id_asignatura = intval($_POST['id_asignatura'] ?? 0);
$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$fecha_apertura = $_POST['fecha_apertura'] ?? '';
$fecha_entrega = $_POST['fecha_entrega'] ?? '';
$puntuacion_maxima = isset($_POST['puntuacion_maxima']) ? floatval($_POST['puntuacion_maxima']) : 0;

// Verificar si se subió archivo
$archivo = null;
if (!empty($_FILES['archivo_adjunto']['tmp_name'])) {
    $archivo = file_get_contents($_FILES['archivo_adjunto']['tmp_name']);
}

if ($archivo !== null) {
    // Actualizar con archivo
    $stmt = $conn->prepare("UPDATE tareas SET titulo = ?, descripcion = ?, fecha_apertura = ?, fecha_entrega = ?, puntuacion_maxima = ?, archivo_adjunto = ? WHERE id_tarea = ?");
    $stmt->bind_param("ssssdsi", $titulo, $descripcion, $fecha_apertura, $fecha_entrega, $puntuacion_maxima, $archivo, $id_tarea);
} else {
    // Actualizar sin archivo
    $stmt = $conn->prepare("UPDATE tareas SET titulo = ?, descripcion = ?, fecha_apertura = ?, fecha_entrega = ?, puntuacion_maxima = ? WHERE id_tarea = ?");
    $stmt->bind_param("ssssdi", $titulo, $descripcion, $fecha_apertura, $fecha_entrega, $puntuacion_maxima, $id_tarea);
}

// Ejecutar y comprobar
if ($stmt->execute()) {
    header("Location: tareas.php?id=$id_asignatura");
    exit();
} else {
    echo "Error al editar la tarea: " . $stmt->error;
}

$stmt->close();
$conn->close();
