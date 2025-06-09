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
    <!-- para el calendario -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
        <h2>Crear Tarea</h2>
        <!--  recorrido de donde te situas -->
        <div class="migas">
            <a href="inicioGeneral.php">Inicio General / </a>
            <a href="asignaturas.php">Asignaturas / </a>
            <a href="inicioAsignatura.php">Inicio Asignatura / </a>
            <a href="tareas.php">Tareas / </a>
            <a href="#">Crear Tarea /</a>
        </div>
        <!-- Contenido de la seccion-->
        <div class="contenido-interior">
            <?php
            include '../../includes/proaInc/proaProfesores/crearTareaProfesor.inc';
            ?>
        </div>
    </div>
    <!-- Footer de Proa -->
    <?php include '../../includes/proaInc/footerProa.inc'; ?>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
    flatpickr("#dateRange", {
        mode: "range",
        dateFormat: "d-m-Y",
        locale: "es",
        onChange: function(selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
                // Rellenar los campos ocultos
                document.getElementById('fechaApertura').value = selectedDates[0].toISOString().split('T')[0];
                document.getElementById('fechaEntrega').value = selectedDates[1].toISOString().split('T')[0];
            }
        }
    });
    </script>
</body>

</html>