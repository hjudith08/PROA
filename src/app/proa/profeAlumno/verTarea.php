<?php
session_start();

include '../../includes/conexion.inc';

$id_tarea = isset($_GET['id_tarea']) ? intval($_GET['id_tarea']) : 0;
$id_asignatura = isset($_GET['id']) ? intval($_GET['id']) : 0;

$titulo_tarea = '';
$nombre_asignatura = '';

if ($id_tarea > 0) {
    $stmt = $conn_proa->prepare("SELECT titulo, id_asignatura FROM tareas WHERE id_tarea = ?");
    if (!$stmt) {
        die("Error en la consulta: " . $conn_proa->error);
    }
    $stmt->bind_param("i", $id_tarea);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($fila = $result->fetch_assoc()) {
        $titulo_tarea = $fila['titulo'];
        // Si $id_asignatura no viene, lo obtenemos de la tabla tareas
        if ($id_asignatura === 0) {
            $id_asignatura = (int) $fila['id_asignatura'];
        }
    } else {
        die("Tarea no encontrada.");
    }
    $stmt->close();
} else {
    die("ID de tarea no válido.");
}

// Obtenemos el nombre de la asignatura si tenemos su id
if ($id_asignatura > 0) {
    $stmt2 = $conn_proa->prepare("SELECT nombre FROM asignaturas WHERE id_asignatura = ?");
    if ($stmt2) {
        $stmt2->bind_param("i", $id_asignatura);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if ($fila2 = $result2->fetch_assoc()) {
            $nombre_asignatura = $fila2['nombre'];
        }
        $stmt2->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PROA | Herramienta Educativa</title>
    <link rel="icon" href="../../../imagenes/LogosProaBlancoV3.png" type="image/png" />
    <link rel="stylesheet" href="../../../css/proaCSS/estilosBaseProa.css" />
    <link rel="stylesheet" href="../../../css/proaCSS/verTarea.css" />
    <script src="../../../js/proaJS/funcionesBase.js" defer></script>
</head>
<body>

<!-- Header y Sidebar -->
<?php include '../../includes/proaInc/menuProa.inc'; ?>
<?php include '../../includes/proaInc/sidebarProaGeneral.inc'; ?>

<!-- Contenido -->
<div class="contenido">
    <h2>Información Tarea</h2>

    <nav class="migas" aria-label="Breadcrumb">
        <a href="inicioGeneral.php">Inicio General /</a>
        <a href="asignaturas.php">Asignaturas /</a>
        <?php if ($id_asignatura > 0): ?>
            <a href="inicioAsignatura.php?id=<?= $id_asignatura ?>">Inicio <?= htmlspecialchars($nombre_asignatura) ?> /</a>
            <a href="tareas.php?id=<?= $id_asignatura ?>">Tareas /</a>
        <?php endif; ?>
        <span class="ubicacion-actual">Tarea <?= htmlspecialchars($titulo_tarea) ?></span>
    </nav>

    <div class="contenido-interior">
        <?php include '../../includes/proaInc/proaAlumnos/informacionTarea.inc'; ?>
    </div>
</div>

<!-- Footer -->
<?php include '../../includes/proaInc/footerProa.inc'; ?>

</body>
</html>
