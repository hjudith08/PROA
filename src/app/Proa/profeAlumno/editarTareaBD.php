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

// Obtener el nombre actual del archivo en la base de datos
$stmt = $conn_proa->prepare("SELECT archivo_adjunto FROM tareas WHERE id_tarea = ?");
$stmt->bind_param("i", $id_tarea);
$stmt->execute();
$resultado = $stmt->get_result();
$archivo_actual = $resultado->fetch_assoc()['archivo_adjunto'] ?? null;
$stmt->close();

// Inicializar el nombre del archivo final
$archivo_nombre = $archivo_actual;

// ¿Se quiere eliminar el archivo actual?
if (isset($_POST['eliminar_archivo']) && $archivo_actual) {
    $ruta_archivo = __DIR__ . "/../../uploads/tareas/" . $archivo_actual;
    if (file_exists($ruta_archivo)) {
        unlink($ruta_archivo);
    }
    $archivo_nombre = null;
}

// ¿Se subió uno nuevo?
if (isset($_FILES['archivo_adjunto']) && $_FILES['archivo_adjunto']['error'] === UPLOAD_ERR_OK) {
    $nombre_original = $_FILES['archivo_adjunto']['name'];
    $archivo_tmp = $_FILES['archivo_adjunto']['tmp_name'];
    $archivo_nombre = uniqid() . "_" . basename($nombre_original);

    $ruta_destino = __DIR__ . "/../../uploads/tareas/" . $archivo_nombre;
    if (!is_dir(dirname($ruta_destino))) {
        mkdir(dirname($ruta_destino), 0777, true);
    }

    if (!move_uploaded_file($archivo_tmp, $ruta_destino)) {
        die("Error al subir el nuevo archivo.");
    }

    // Eliminar el archivo anterior si existía
    if ($archivo_actual && file_exists(__DIR__ . "/../../uploads/tareas/" . $archivo_actual)) {
        unlink(__DIR__ . "/../../uploads/tareas/" . $archivo_actual);
    }
}

// Actualizar los datos en la base de datos
$stmt = $conn_proa->prepare("UPDATE tareas SET titulo = ?, descripcion = ?, fecha_apertura = ?, fecha_entrega = ?, puntuacion_maxima = ?, archivo_adjunto = ? WHERE id_tarea = ?");
$stmt->bind_param("ssssdsi", $titulo, $descripcion, $fecha_apertura, $fecha_entrega, $puntuacion_maxima, $archivo_nombre, $id_tarea);

// Ejecutar y comprobar
if ($stmt->execute()) {
    header("Location: tareas.php?id=$id_asignatura&editado=ok");
    exit();
} else {
    echo "Error al editar la tarea: " . $stmt->error;
}

$stmt->close();
$conn_proa->close();
?>
