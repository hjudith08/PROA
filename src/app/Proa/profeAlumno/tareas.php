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
    <link rel="icon" href="../../../imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/proaCSS/estilosBaseProa.css">
    <link rel="stylesheet" href="../../../css/proaCSS/tareasProfesor.css">
    <link rel="stylesheet" href="../../../css/proaCSS/tareasAlumno.css">
    <script src="../../../js/proaJS/funcionesBase.js" defer></script>
</head>
<body>

<!-- Header de Proa -->  
<?php include '../../includes/proaInc/menuProa.inc'; ?>
<!-- Sidebar -->
<?php include '../../includes/proaInc/sidebarProaGeneral.inc'; ?>

<!-- Contenido principal -->
<div class="contenido">
    <h2>Tareas</h2>
    <div class="migas">
        <a href="inicioGeneral.php">Inicio General / </a>
        <a href="asignaturas.php">Asignaturas / </a>
        <a href="inicioAsignatura.php">Inicio Asignatura / </a>
        <a href="#">Tareas /</a>
    </div>

    <div class="contenido-interior">
        <?php 
        if($userdata['rol'] == 'alumno'){
            include '../../includes/proaInc/proaAlumnos/tareasAlumno.inc';
        } elseif($userdata['rol'] == 'profesor'){
            include '../../includes/proaInc/proaProfesores/tareasProfesor.inc';
        }
        ?>
    </div>
</div>

<!-- Footer -->
<?php include '../../includes/proaInc/footerProa.inc'; ?>

<!-- POPUP de edición exitosa -->
<?php if ((isset($_GET['editado']) && $_GET['editado'] === 'ok') || (isset($_GET['creado']) && $_GET['creado'] === 'ok')): ?>
    <div id="popup-guardado" class="popup-guardado">
        <div class="popup-contenido">
            <p>
                <?php 
                    if (isset($_GET['editado']) && $_GET['editado'] === 'ok') echo 'Cambios guardados correctamente';
                    elseif (isset($_GET['creado']) && $_GET['creado'] === 'ok') echo 'Tarea creada correctamente';
                ?>
            </p>
            <button onclick="cerrarPopup()">Cerrar</button>
        </div>
    </div>
<?php endif; ?>


<script>
let idEliminar = null;
let idAsignatura = <?= json_encode($id_asignatura) ?>;

function mostrarPopupEliminar(idTarea) {
    idEliminar = idTarea;
    document.getElementById("modalEliminar").classList.remove("oculto");
}

document.getElementById("cancelarEliminar").addEventListener("click", function () {
    document.getElementById("modalEliminar").classList.add("oculto");
});

document.getElementById("confirmarEliminar").addEventListener("click", function () {
    if (idEliminar) {
        window.location.href = `eliminarTarea.php?id_tarea=${idEliminar}&id_asignatura=${idAsignatura}`;
    }
});

// Función para cerrar el popup
function cerrarPopup() {
    const popup = document.getElementById("popup-guardado");
    if (popup) popup.style.display = "none";

    // Quitar el parámetro de la URL
    const url = new URL(window.location.href);
    url.searchParams.delete("editado");
    url.searchParams.delete("creado");
    window.history.replaceState(null, '', url);
}

// Cierre automático después de 3 segundos
setTimeout(cerrarPopup, 3000);
</script>

</body>
</html>
