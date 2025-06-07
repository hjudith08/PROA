
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROA | Herramienta Educativa</title>
    <!-- imagen de pestaña -->
    <link rel="icon" href="../../../imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/proaCSS/estilosBaseProa.css">
    <link rel="stylesheet" href="../../../css/proaCSS/verTarea.css">
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
    <h2>Informacion Tarea</h2>
<!--  recorrido de donde te situas -->
    <div class="migas">
        <a href="inicioGeneral.php">Inicio General / </a>
        <a href="asignaturas.php">Asignaturas / </a>
        <a class="ubicacion-actual" href="inicioAsignatura.php?id=<?= urlencode($_GET['id'] ?? '') ?>">Inicio Asignatura / </a>
        <a href="#">Tareas / </a>
        <a href="#">Tarea X /</a>
    </div>
<!-- Contenido de la seccion-->
    <div class="contenido-interior">
        
        <?php 
            include '../../includes/proaInc/proaAlumnos/informacionTarea.inc';
        ?>
      
    </div>
</div>
<!-- Footer de Proa -->
<?php include '../../includes/proaInc/footerProa.inc'; ?>

</body>
</html>