<?php
// Simulación de datos para esta fase inicial
// $_SESSION['id_tarea'] = 1; // ID tarea actual
// $_SESSION['id_asignatura'] = 2; // ID asignatura
// $_SESSION['dni'] = '12345678A'; // DNI del profesor

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proa");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener datos actuales de la tarea
$id_tarea = $_SESSION['id_tarea'];
$sql = "SELECT * FROM tareas WHERE id_tarea = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_tarea);
$stmt->execute();
$resultado = $stmt->get_result();
$tarea = $resultado->fetch_assoc();

// Actualizar tarea si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['taskTitle'];
    $descripcion = $_POST['taskDescription'];
    $fecha_apertura = $_POST['scheduleDate'];
    $fecha_entrega = $_POST['dueDate'];
    $puntuacion = $_POST['taskScore'];

    // Manejar archivo
    $archivo_nombre = $tarea['archivo_adjunto']; // valor anterior por defecto
    if (isset($_FILES['taskFile']) && $_FILES['taskFile']['error'] === UPLOAD_ERR_OK) {
        $archivo_tmp = $_FILES['taskFile']['tmp_name'];
        $archivo_nombre = basename($_FILES['taskFile']['name']);
        move_uploaded_file($archivo_tmp, "uploads/" . $archivo_nombre);
    }

    // Actualizar tarea
    $update = $conexion->prepare("UPDATE tareas SET titulo=?, descripcion=?, fecha_apertura=?, fecha_entrega=?, puntuacion_maxima=?, archivo_adjunto=? WHERE id_tarea=?");
    $update->bind_param("ssssssi", $titulo, $descripcion, $fecha_apertura, $fecha_entrega, $puntuacion, $archivo_nombre, $id_tarea);
    $update->execute();

    echo "<script>alert('Tarea actualizada correctamente');</script>";
    // Opcional: redireccionar
    // header('Location: pagina_exito.php');
}
?>

<div class="tabla-flex-container">
    <div class="card-content">
        <form class="form" id="taskForm">
            <!-- Programar tarea para -->
            <label class="form-label" for="scheduleDate">Programar tarea para:</label>
            <div class="input-date-wrapper">
                <input type="date" class="input-date" id="scheduleDate" required />
            </div>
        
            <!-- Título tarea -->
            <label class="form-label" for="taskTitle">Título tarea:</label>
            <input type="text" class="input-text" id="taskTitle" placeholder="Ingrese el título" required />

            <!-- Descripción de la tarea -->
            <div class="form-row">
                <label class="descripcionTarea" for="taskDescription">Descripción de la tarea:</label>
                <textarea class="textarea" id="taskDescription" placeholder="Describa la tarea aquí" required></textarea>
            </div>

            <!-- Adjuntar archivos -->
            <label class="form-label" for="taskFile">Adjuntar archivos:</label>
            <div class="file-input-wrapper">
                <input type="file" class="file-input" id="taskFile" />
                <button type="button" class="file-input-button" onclick="document.getElementById('taskFile').click();">
                    <span>Subir archivo</span>
                </button>
            </div>

            <!-- Fecha entrega -->
            <label class="form-label" for="dueDate">Fecha entrega:</label>
            <div class="input-date-wrapper">
                <input type="date" class="input-date" id="dueDate" required />
            </div>

            <!-- Puntuación sobre -->
            <label class="form-label" for="taskScore">Puntuación sobre:</label>
            <input type="number" class="input-text" id="taskScore" placeholder="100" min="1" required />

            <!-- Submit button -->
            <div class="submit-button">
                <button type="submit">CREAR</button>
            </div>
        </form>
    </div>
</div>