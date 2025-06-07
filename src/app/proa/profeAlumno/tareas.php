<?php
$id_asignatura = $_GET['id'] ?? null;

if (!$id_asignatura) {
    die("No se ha seleccionado ninguna asignatura.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROA | Herramienta Educativa</title>
    <!-- imagen de pestaña -->
    <link rel="icon" href="imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/proaCSS/estilosBaseProa.css">
    <link rel="stylesheet" href="../../../css/proaCSS/tareasProfesor.css">
    <link rel="stylesheet" href="../../../css/proaCSS/tareasAlumno.css">
    <script src="../../../js/proaJS/funcionesBase.js" defer></script>
    <script src="../../../js/proaJS/filtroEstado.js" defer></script>
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
    <h2>Tareas</h2>
<!--  recorrido de donde te situas -->
    <div class="migas">
        <a href="inicioGeneral.php">Inicio General / </a>
        <a href="asignaturas.php">Asignaturas / </a>
        <a class="ubicacion-actual" href="inicioAsignatura.php?id=<?= urlencode($_GET['id'] ?? '') ?>">Inicio Asignatura / </a>
        <a href="#">Tareas /</a>
    </div>
<!-- Contenido de la seccion-->
    <div class="contenido-interior">
        
        <?php 
        if($userdata['rol'] == 'alumno'){
            include '../../includes/proaInc/proaAlumnos/tareasAlumno.inc';
        }elseif($userdata['rol'] == 'profesor'){
            include '../../includes/proaInc/proaProfesores/tareasProfesor.inc';
        }
        ?>
      
    </div>
</div>
<!-- Footer de Proa -->
<?php include '../../includes/proaInc/footerProa.inc'; ?>

</body>
</html>