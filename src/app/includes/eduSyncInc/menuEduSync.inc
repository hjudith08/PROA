<?php
$pagina_actual = basename($_SERVER['PHP_SELF']);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="header-eduSync">   
    <div class="elementos-izquierda">
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
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <div class="elementos-derecha">
            <?php if ($pagina_actual == 'index.php'): ?>
                <button id="contacto" onclick="location.href='app/eduSync/contacto.php'">CONTACTO</button>
                <span class="bienvenido">
                    Hola, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']); ?></strong>
                </span>
                <button popovertarget="menu-usuario"><img src="imagenes/user_1azul.png" alt="Icono de Perfil"></button>
            <?php else: ?>
                <button id="contacto" onclick="location.href='contacto.php'">CONTACTO</button>
                <span class="bienvenido">
                    Hola, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']); ?></strong>
                </span>
                <button popovertarget="menu-usuario"><img src="../../imagenes/user_1azul.png" alt="Icono de Perfil"></button>
            <?php endif; ?>
            <div id="menu-usuario" popover>
                <p class="bienvenido bnv-interior">
                    <strong>
                        <?= htmlspecialchars($_SESSION['usuario_nombre'] . " " . $_SESSION['usuario_apellidos']); ?>
                    </strong>
                </p>
                <hr>
                <?php if ($pagina_actual == 'index.php'): ?>
                    <button id="boton-mis-herramientas" onclick="location.href='app/eduSync/misHerramientas.php'">Mis Herramientas</button>
                <?php else: ?>
                    <button id="boton-mis-herramientas" onclick="location.href='misHerramientas.php'">Mis Herramientas</button>
                <?php endif; ?>
                <hr>
                <button id="boton-cerrar-sesion">Salir</button>
            </div>
        </div>
        <div id="fondo-popup" class="fondo-popup oculto"></div>
        <div id="popupCerrarSesion" class="popup oculto">
            <div class="popup-contenido-C">
                <p class="popup-texto">¿Estás seguro que quieres cerrar sesión?</p>
                <div class="popup-botones">
                    <?php
                    $logoutRuta = ($pagina_actual == 'index.php') ? 'app/eduSync/logout.php' : 'logOut.php';
                    ?>
                    <button id="btn-si" class="boton-si" onclick="location.href='<?php echo $logoutRuta; ?>'">Sí</button>
                    <button id="btn-no" class="boton-no">No</button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="elementos-derecha">
            <?php if ($pagina_actual == 'index.php'): ?>
                <button id="contacto" onclick="location.href='app/eduSync/contacto.php'">CONTACTO</button>
                <button id="boton-login" onclick="location.href='app/eduSync/loginRegistro.php'">LOGIN</button>
            <?php else: ?>
                <button id="contacto" onclick="location.href='contacto.php'">CONTACTO</button>
                <button id="boton-login" onclick="location.href='loginRegistro.php'">LOGIN</button>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</header>