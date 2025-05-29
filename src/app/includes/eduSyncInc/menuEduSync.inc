<?php
$pagina_actual = basename($_SERVER['PHP_SELF']);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Cabecera de las páginas de EduSync-->
<header class="header-eduSync">   
    <!-- Elementos a la izquierda del header -->
    <div class="elementos-izquierda">
        <!-- Logo de la Empresa -->
        <?php
        if ($pagina_actual == 'index.php') {
        ?>
            <a class="logo-header" href="#"><img src="imagenes/LogoEduSyncAzul.png" alt="Logotipo"></a>
        <?php
        } else {
        ?>
            <a class="logo-header" href="../../"><img src="../../imagenes/LogoEduSyncAzul.png" alt="Logotipo"></a>
        <?php
        }
        ?>
    </div>

    <?php
    // Sesión iniciada
    if (isset($_SESSION['usuario_id'])) {
    ?>
        <!-- Elementos a la derecha del header -->
        <div class="elementos-derecha">
            <?php
            if ($pagina_actual == 'index.php') {
            ?>
                <!-- Contacto -->
                <button id="contacto" onclick="location.href='app/eduSync/contacto.php'">CONTACTO</button>
                <!-- Bienvenida y menú usuario -->
                <span class="bienvenido">
                    Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong>
                </span>
                <button popovertarget="menu-usuario"><img src="imagenes/user_1azul.png" alt="Icono de Perfil"></button>
            <?php
            } else {
            ?>
                <!-- Contacto -->
                <button id="contacto" onclick="location.href='contacto.php'">CONTACTO</button>
                <!-- Bienvenida y menú usuario -->
                <span class="bienvenido">
                    Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong>
                </span>
                <button popovertarget="menu-usuario"><img src="../../imagenes/user_1azul.png" alt="Icono de Perfil"></button>
            <?php
            }
            ?>

            <!-- Menú desplegable usuario -->
            <div id="menu-usuario" popover>
                <p class="bienvenido bnv-interior">
                    <strong>
                        <?php
                        echo htmlspecialchars($_SESSION['usuario_nombre'] . " " . $_SESSION['usuario_apellidos']);
                        ?>
                    </strong>
                </p>
                <hr>
                <!-- Botón para ir a mis herramientas -->
                <?php
                if ($pagina_actual == 'index.php') {
                ?>
                    <button id="boton-mis-herramientas" onclick="location.href='app/eduSync/misHerramientas.php'">Mis Herramientas</button>
                <?php
                } else {
                ?>
                    <button id="boton-mis-herramientas" onclick="location.href='misHerramientas.php'">Mis Herramientas</button>
                <?php
                }
                ?>
                <hr>
                <!-- Botón para cerrar sesión -->
                <button id="boton-cerrar-sesion">Salir</button>
            </div>
        </div>

        <!-- PopUp Cerrar Sesión -->
        <div id="fondo-popup" class="fondo-popup oculto"></div>
        <div id="popupCerrarSesion" class="popup oculto">
            <div class="popup-contenido-C">
                <p class="popup-texto">¿Estás seguro que quieres cerrar sesión?</p>
                <div class="popup-botones">
                    <?php
                    // Determina la ruta correcta para logOut.php según la página actual
                    $logoutRuta = ($pagina_actual == 'index.php') ? 'app/eduSync/logOut.php' : 'logOut.php';
                    ?>
                    <button id="btn-si" class="boton-si" onclick="location.href='<?php echo $logoutRuta; ?>'">Sí</button>
                    <button id="btn-no" class="boton-no">No</button>
                </div>
            </div>
        </div>
    <?php
    // Sesión NO iniciada
    } else {
    ?>
        <div class="elementos-derecha">
            <?php
            if ($pagina_actual == 'index.php') {
            ?>
                <button id="contacto" onclick="location.href='app/eduSync/contacto.php'">CONTACTO</button>
                <button id="boton-login" onclick="location.href='app/eduSync/loginRegistro.php'">LOGIN</button>
            <?php
            } else {
            ?>
                <button id="contacto" onclick="location.href='contacto.php'">CONTACTO</button>
                <button id="boton-login" onclick="location.href='loginRegistro.php'">LOGIN</button>
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
</header>