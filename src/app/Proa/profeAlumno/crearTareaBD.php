<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../includes/conexion.inc';

    // Recogemos el id_asignatura de la URL (GET)
    $id_asignatura = isset($_POST['id_asignatura']) ? intval($_POST['id_asignatura']) : 0;
    if ($id_asignatura <= 0) {
        die("ID de asignatura no válido.");
    }

    $fecha_apertura = $_POST['fecha_apertura'] ?? null;
    $titulo = $_POST['titulo'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $fecha_entrega = $_POST['fecha_entrega'] ?? null;
    $puntuacion_maxima = $_POST['puntuacion_maxima'] ?? null;

    $creado_por = '9971924'; // Puedes cambiarlo si tienes sesión con usuario

    // No veo que definas $grupo_id, si no lo tienes, déjalo en null o 0
    $grupo_id = null;


    if (!$fecha_apertura || !$titulo || !$descripcion || !$fecha_entrega || !$puntuacion_maxima) {
        die("Faltan datos obligatorios para crear la tarea.");
    }

    $archivo_nombre = null;

    if (isset($_FILES['archivo_adjunto']) && $_FILES['archivo_adjunto']['error'] === UPLOAD_ERR_OK) {
        $nombre_original = $_FILES['archivo_adjunto']['name'];
        $archivo_tmp = $_FILES['archivo_adjunto']['tmp_name'];
        $archivo_nombre = uniqid() . "_" . basename($nombre_original);

        $ruta_destino = __DIR__ . "/../../uploads/tareas/" . $archivo_nombre;

        if (!is_dir(dirname($ruta_destino))) {
            mkdir(dirname($ruta_destino), 0777, true);
        }

        if (!move_uploaded_file($archivo_tmp, $ruta_destino)) {
            die("Error al mover el archivo subido.");
        }
    }

    $stmt = $conn->prepare("INSERT INTO tareas (id_asignatura, titulo, descripcion, fecha_apertura, fecha_entrega, puntuacion_maxima, archivo_adjunto, creado_por, grupo_id) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("isssssisi", $id_asignatura, $titulo, $descripcion, $fecha_apertura, $fecha_entrega, $puntuacion_maxima, $archivo_nombre, $creado_por, $grupo_id);

    if ($stmt->execute()) {
        echo "<script>
            alert('¡Tarea creada con éxito!');
            window.location.href = 'crearTarea.php?id=$id_asignatura';
        </script>";
        exit;
    } else {
        echo "Error al crear la tarea: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>
