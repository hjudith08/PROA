<?php

$pagina_actual = basename($_SERVER['PHP_SELF']);

// apaño temporal para evitar el login

/*$dataEdu = [
    'nombre' => 'Jose Luis',
    'apellidos' => 'Gimenez Lopez',
    'id' => 2,
];
*/
?>


<!-- Cabecera de las páginas de EduSync-->
<header class="header-eduSync">   
    <!-- Elementos a la izquierda del header -->
    <div class="elementos-izquierda">
        <!-- Logo de la Empresa -->
         <?php
         /* En la landing page el link es distinto*/ 
        if ($pagina_actual == 'index.php') {
        ?>
        <a class="logo-header" href="#"><img src="imagenes/LogoEduSyncAzul.png" alt="Logotipo"></a>
         <?php
         } /* direccion de la landing web de todas las demas paginas*/ 
        else{
        ?>
        <a class="logo-header" href="../../"><img src="../../imagenes/LogoEduSyncAzul.png" alt="Logotipo"></a>
         <?php
         }
        ?>
    </div>

<?php
/* Sesion iniciada*/ 
if (isset($dataEdu['id'])) {
?>

    <!-- Elementos a la derecha del header -->
    <div class="elementos-derecha">    
        <!-- botón del menu de usuario y de contacto -->
        <?php
         /* En la landing page el link es distinto*/ 
        if ($pagina_actual == 'index.php') {
        ?>
        <!-- Contacto -->
        <button id="contacto" onclick="location.href='app/eduSync/contacto.php'">CONTACTO</button>
        <!-- menu de usuario -->
        <button popovertarget="menu-usuario"><img src="imagenes/user_1azul.png" alt="Icono de Perfil"></button>
         <?php
         } /* direccion de la landing web de todas las demas paginas*/ 
        else{
        ?>
        <!-- Contacto -->
        <button id="contacto" onclick="location.href='contacto.php'">CONTACTO</button>
        <!-- menu de usuario -->
        <button popovertarget="menu-usuario"><img src="../../imagenes/user_1azul.png" alt="Icono de Perfil"></button>
         <?php
         }
        ?>
        
        <!-- texto de bienvenida-->

        <div id="menu-usuario" popover>
            <p class="bienvenido bnv-interior"><strong><?php echo $dataEdu['nombre'] . " " . $dataEdu['apellidos'];?></strong></p>
            <!-- separador -->
            <hr>
            <!--Boton para ir a mis herramientas-->
             <?php
            /* En la landing page el link es distinto*/ 
            if ($pagina_actual == 'index.php') {
            ?>
            <button id="boton-mis-herramientas" onclick="location.href='app/eduSync/misHerramientas.php'">Mis Herramientas</button>
            <?php
            } /* direccion de la landing web de todas las demas paginas*/ 
            else{
            ?>
             <button id="boton-mis-herramientas" onclick="location.href='misHerramientas.php'">Mis Herramientas</button>
            <?php
            }
            ?>
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
/* Sesion no iniciada*/ 
}
else {
?>
    <!-- Elementos a la derecha del header -->
    <div class="elementos-derecha">
        <?php
         /* En la landing page el link es distinto*/ 
        if ($pagina_actual == 'index.php') {
        ?>
        <!-- Contacto -->
        <button id="contacto" onclick="location.href='app/eduSync/contacto.php'">Contacto</button>
        <!-- Boton para ir al login -->
        <button id="boton-login" onclick="location.href='app/eduSync/loginRegistro.php'">Login</button>
         <?php
         } /* direccion de la landing web de todas las demas paginas*/ 
        else{
        ?>
        <!-- Contacto -->
        <button id="contacto" onclick="location.href='contacto.php'">CONTACTO</button>
          <!-- Boton para ir al login -->
        <button id="boton-login" onclick="location.href='loginRegistro.php'">LOGIN</button>
         <?php
         }
        ?>    
        </div>
    </div>
</header>

<?php
}
?>



