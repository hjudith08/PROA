<?php
include __DIR__ . '/conexion.inc';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos recibidos
    $dni_alumno = $_POST['dni_alumno'] ?? '';
    $id_tarea = $_POST['id_tarea'] ?? '';
    $grupo_id = $_POST['grupo_id'] ?? '';
    $archivo = $_FILES['archivo'] ?? null;

    // Validaciones básicas
    if (empty($dni_alumno) || empty($id_tarea) || empty($grupo_id)) {
        die("Error: Datos incompletos");
    }

    if (!$archivo || $archivo['error'] !== UPLOAD_ERR_OK) {
        die("Error: Problema con la subida del archivo. Código: " . ($archivo['error'] ?? 'N/A'));
    }

    // Validar tamaño del archivo (máximo 10MB)
    if ($archivo['size'] > 10 * 1024 * 1024) {
        die("Error: El archivo no puede superar los 10MB");
    }

    // Obtener la extensión del archivo subido
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);

    $ruta_subida = __DIR__ . '/../../../docs/uploads';

    if (!file_exists($ruta_subida)) {
        mkdir($ruta_subida, 0777, true);
    }

    $ruta_subida = realpath($ruta_subida) . DIRECTORY_SEPARATOR;


// Generar nombre único para el archivo
    $nombre_archivo = 'entrega_' . $dni_alumno . '_' . $id_tarea . '_' . time();
    if (!empty($extension)) {
        $nombre_archivo .= '.' . $extension;
    }

    $ruta_destino = $ruta_subida . $nombre_archivo;

    // Mover el archivo subido
    if (!move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
        die("Error: No se pudo guardar el archivo en el servidor");
    }

    // Insertar en la base de datos
    try {
        $conn_proa->begin_transaction();

        // 1. Insertar en la tabla entregas
        $sqlEntrega = "INSERT INTO entregas (
                        id_tarea, dni_alumno, archivo_entregado, 
                        fecha_entrega, grupo_id
                    ) VALUES (?, ?, ?, NOW(), ?)
                    ON DUPLICATE KEY UPDATE 
                        archivo_entregado = VALUES(archivo_entregado),
                        fecha_entrega = VALUES(fecha_entrega)";

        $stmtEntrega = $conn_proa->prepare($sqlEntrega);
        $stmtEntrega->bind_param("isss", $id_tarea, $dni_alumno, $nombre_archivo, $grupo_id);
        $stmtEntrega->execute();

        // 2. Insertar en la tabla archivos (histórico)
        $sqlArchivo = "INSERT INTO archivos (
                        nombre_original, ruta, dni_alumno, id_tarea
                    ) VALUES (?, ?, ?, ?)";

        $stmtArchivo = $conn_proa->prepare($sqlArchivo);
        $stmtArchivo->bind_param("sssi", $archivo['name'], $nombre_archivo, $dni_alumno, $id_tarea);
        $stmtArchivo->execute();

        $conn_proa->commit();

        // Redireccionar a la página de la tarea
        header("Location: ../proa/profeAlumno/verTarea.php?id_tarea=" . urlencode($id_tarea));
        exit;

    } catch (Exception $e) {
        $conn_proa->rollback();

        // Eliminar el archivo si hubo error
        if (file_exists($ruta_destino)) {
            unlink($ruta_destino);
        }

        die("Error al guardar en la base de datos: " . $e->getMessage());
    }
} else {
    header("Location: verTarea.php");
    exit;
}
?>