<?php
include '../../includes/conexion.inc';

$tarea = null;
if (isset($_GET['id_tarea'])) {
    $id_tarea = intval($_GET['id_tarea']);
    $stmt = $conn_proa->prepare("SELECT * FROM tareas WHERE id_tarea = ?");
    $stmt->bind_param("i", $id_tarea);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        $tarea = $resultado->fetch_assoc();
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROA | Herramienta Educativa</title>
    <!-- imagen de pestaña -->
    <link rel="icon" href="../../../imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/proaCSS/estilosBaseProa.css">
    <link rel="stylesheet" href="../../../css/proaCSS/crearEditarTarea.css">
    <script src="../../../js/proaJS/funcionesBase.js" defer></script>
    <script src="../../../js/proaJS/funcionesBase.js" defer></script>
</head>
<!-- Cuerpo de la página web -->
<body>

<!-- Header de Proa (móvil y ordenador) -->  
<?php include '../../includes/proaInc/menuProa.inc'; ?>
<!-- Sidebar de Proa -->
<?php include '../../includes/proaInc/sidebarProaGeneral.inc'; ?>

<!-- Contenido de la página -->
<div class="contenido">
<!-- Titulo de la seccion-->
    <h2>Editar Tarea</h2>
<!--  recorrido de donde te situas -->
    <div class="migas">
        <a href="inicioGeneral.php">Inicio General / </a>
        <a href="asignaturas.php">Asignaturas / </a>
        <a href="inicioAsignatura.php">Inicio Asignatura / </a>
        <a href="tareas.php">Tareas / </a>
        <a href="#">Editar Tarea /</a>
    </div>
<!-- Contenido de la seccion-->
    <div class="contenido-interior">
        
        <?php 
       
            include '../../includes/proaInc/proaProfesores/editarTareaProfesor.inc';
           
        ?>
      
    </div>
</div>
<!-- Footer de Proa -->
<?php include '../../includes/proaInc/footerProa.inc'; ?>

</body>
</html>