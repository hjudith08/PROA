
<?php
// apaño temporal para evitar el login
$userdata = [
    'rol' => 'profesor',
    'nombre' => 'Xexi',
    'apellidos' => 'Mexi',
    'id' => 3,
  ];

$asignatura = [
    'nombre' => 'Matemáticas Avanzadas',
    'id' => 1,
  ];

?>

<!-- Cabecera de las páginas de proa-->
<header>   
    <!-- Elementos a la izquierda del header -->
    <div class="elementos-izquierda">
        <!-- Logo de la herramienta educativa -->
        <a class="logo-header" href ="inicioGeneral.php"> <img src="../../../imagenes/LogosProaBlanco.png" alt="Logotipo"> </a>
        <!-- Nombre de la asignatura en la q se encuentra (en caso de q no este en ninguna no saldrá nada) -->
        <h3 class="titulo-asignatura"> <?php echo $asignatura['nombre'] ?> </h3>
    </div>

 
    <!-- Elementos a la derecha del header -->
    <div class="elementos-derecha">
        <p class="bienvenido bnv-exterior"> Bienvenido, <strong> <?php echo $userdata['nombre'] . " " . $userdata['apellidos']; ?> </strong> <?php echo " (" . $userdata['rol'] . ")"; ?> </p>
        
        <!-- botón del menu de usuario -->
        <button popovertarget="menu-usuario"><img src="../../../imagenes/user_1b.png" alt="Icono de Perfil"></button>
        <!-- texto de bienvenida-->
        <div id="menu-usuario" popover>
            <p class="bienvenido bnv-interior"><strong> <?php echo $userdata['nombre'] . " " . $userdata['apellidos']; ?> </strong> <?php echo " (" . $userdata['rol'] . ")"; ?> </p>
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
