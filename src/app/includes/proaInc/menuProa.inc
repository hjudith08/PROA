
<?php

$pagina_actual = basename($_SERVER['PHP_SELF']);

// apaño temporal para evitar el login

$dataEdu = [
    'nombre' => 'Jose',
    'apellidos' => 'Luis',
    'id' => 2,
  ];

$userdata = [
    'rol' => 'alumno',
    'nombre' => 'Xexi',
    'apellidos' => 'Mexi',
    'id' => 3,
  ];

$asignatura = [
    'nombre' => 'Matemáticas Avanzadas',
    'id' => 1,
  ];

?>

<?php
if ($pagina_actual == 'loginProa.php') {
?>

<!-- Cabecera de seleccion de usuario -->
<header class="header-selector-usuario">
    <a class="logo-edusync" href="../../"><img src="../../imagenes/LogoEduSyncAzulV3.png" alt="logo de EduSync"></a>
    <span> Hola <strong><?php echo $dataEdu['nombre'] . " " . $dataEdu['apellidos']; ?></strong>, selecciona la vista que desees.</span>
    
    <!-- Versión para ordenador -->
    <div class="botones-selector-ordenador">
        <button id="vista-alumno" onclick="location.href='profeAlumno/inicioGeneral.php'">Alumno</button>
<button id="vista-profesor" onclick="location.href='profeAlumno/inicioGeneral.php'">Profesor</button>
<button id="vista-pas" onclick="location.href='pas/PasInicio.php'">Pas</button>
    </div>
    
    <!-- Versión para móvil -->
    <div class="botones-selector-movil">
        <select name="selector-vista" id="selector-vista" onchange="seleccionDeVista(this)">
            <option value="" <?php echo ($userdata['rol'] == 'alumno' || $userdata['rol'] == 'profesor' || $userdata['rol'] == 'pas') ? 'disabled' : ''; ?>>
            Vistas</option>
            <option value="alumno" <?php echo ($userdata['rol'] == 'alumno') ? 'selected' : ''; ?>>Alumno</option>
            <option value="profesor"<?php echo ($userdata['rol'] == 'profesor') ? 'selected' : ''; ?>>Profesor</option>
            <option value="pas" <?php echo ($userdata['rol'] == 'pas') ? 'selected' : ''; ?>>Pas</option>
        </select>        
    </div>
</header>


<?php
}
elseif ($pagina_actual != 'loginProa.php') {
?>

<!-- Cabecera de seleccion de usuario -->
<header class="header-selector-usuario">
    <a class="logo-edusync" href="../../../"><img src="../../../imagenes/LogoEduSyncAzulV3.png" alt="logo de EduSync"></a>
    <span> Hola <strong><?php echo $dataEdu['nombre'] . " " . $dataEdu['apellidos']; ?></strong>, selecciona la vista que desees.</span>
    
    <!-- Versión para ordenador -->
    <div class="botones-selector-ordenador">
        <button <?php echo ($userdata['rol'] == 'alumno') ? 'class="vista-seleccionada" disabled' : ''; ?> id="vista-alumno" onclick="location.href='../profeAlumno/inicioGeneral.php'">Alumno</button>
        <button <?php echo ($userdata['rol'] == 'profesor') ? 'class="vista-seleccionada" disabled' : ''; ?>  id="vista-profesor" onclick="location.href='../profeAlumno/inicioGeneral.php'">Profesor</button>
        <button <?php echo ($userdata['rol'] == 'pas') ? 'class="vista-seleccionada" disabled' : ''; ?> id="vista-pas" onclick="location.href='../pas/inicioPas.php'">Pas</button>
    </div>
    
    <!-- Versión para móvil -->
    <div class="botones-selector-movil">
        <select name="selector-vista" id="selector-vista" onchange="redirectToView(this)">
            <option value="" <?php echo ($userdata['rol'] == 'alumno' || $userdata['rol'] == 'profesor' || $userdata['rol'] == 'pas') ? 'disabled' : ''; ?>>
            Vistas</option>
            <option value="alumno" <?php echo ($userdata['rol'] == 'alumno') ? 'selected' : ''; ?>>Alumno</option>
            <option value="profesor"<?php echo ($userdata['rol'] == 'profesor') ? 'selected' : ''; ?>>Profesor</option>
            <option value="pas" <?php echo ($userdata['rol'] == 'pas') ? 'selected' : ''; ?>>Pas</option>
        </select>        
    </div>
</header>

<!-- Cabecera de las páginas de proa-->
<header class="header-proa">   
    <!-- Elementos a la izquierda del header -->
    <div class="elementos-izquierda">
        <!-- Logo de la herramienta educativa -->
        <?php if($userdata['rol'] == 'pas'){ ?>
            <a class="logo-header" href="PasInicio.php"><img src="../../../imagenes/LogosProaBlanco.png" alt="Logotipo"></a>
        <?php }else{ ?>
            <a class="logo-header" href="inicioGeneral.php"><img src="../../../imagenes/LogosProaBlanco.png" alt="Logotipo"></a>
       <?php } ?>

        <!-- Nombre de la asignatura en la q se encuentra (en caso de q no este en ninguna no saldrá nada) -->
        <h3 class="titulo-asignatura"><?php echo $asignatura['nombre'] ?></h3>
    </div>

    <!-- Elementos a la derecha del header -->
    <div class="elementos-derecha">
        <p class="bienvenido bnv-exterior">Bienvenido, <strong><?php echo $userdata['nombre'] . " " . $userdata['apellidos']; ?></strong> <?php echo " (" . $userdata['rol'] . ")"; ?></p>
        
        <!-- botón del menu de usuario -->
        <button popovertarget="menu-usuario"><img src="../../../imagenes/user_1b.png" alt="Icono de Perfil"></button>
        <!-- texto de bienvenida-->
        <div id="menu-usuario" popover>
            <p class="bienvenido bnv-interior"><strong><?php echo $userdata['nombre'] . " " . $userdata['apellidos']; ?></strong> <?php echo " (" . $userdata['rol'] . ")"; ?></p>
            <!-- separador -->
            <hr>
            <!-- botón para cerrar sesión -->
            <button id="boton-cerrar-sesion">Salir</button>
        </div>
    </div>
  
    <!-- PopUp Cerrar Sesión -->
    <div id="fondo-popup" class="fondo-popup oculto"></div> <!-- fondo para el popup -->
    <div id="popupCerrarSesion" class="popup oculto">
        <div class="popup-contenido-C">
            <p class="popup-texto">¿Estás seguro que quieres cerrar sesión?</p>
            <div class="popup-botones">
                <button id="btn-si" class="boton-si">Sí</button>
                <button id="btn-no" class="boton-no">No</button>
            </div>
        </div>
    </div>
</header>
<?php
}
?>