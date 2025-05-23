<header class="header_edusync">
    <a href="./">
        <img class="logoHeader_edusync" src="/PROA/src/css/imagenes/LogoEduSyncAzul.png" alt="Logotipo">
    </a>
    <nav class="navPrincipal_edusync">
        <ul class="listaNav_edusync">
            <li class="itemNav_edusync">
                <a href="/PROA/src/app/EduSync/NoSesion/noSesionContacto.php" class="enlaceContacto_edusync">CONTACTO</a>
            </li>
            <li class="itemNav_edusync">
                <a href="/PROA/src/app/EduSync/NoSesion/noSesionRegistroLogin.php" class="enlaceContacto_edusync">LOGIN</a>
            </li>
            
            <!-- Menú desplegable usuario -->
            <div class="dropdownUsuario_edusync" id="dropdownUsuario">
                <button class="botonDropdown_edusync"><a href="mis-herramientas.html" class="textoDropdown_edusync">Mis herramientas</a></button>
                <button class="botonDropdown_edusync boton-cerrar-sesion" onclick="mostrarPopupCerrarSesion()">Cerrar sesión</button>
            </div>

            <!-- Popup de confirmación -->
            <div class="popupFondo_edusync" id="popupCerrarSesion">
                <div class="popupContenido_edusync">
                    <p class="popupTexto_edusync">¿Estás seguro que quieres cerrar sesión?</p>
                    <div class="popupBotones_edusync">
                        <button class="botonPopup_edusync" onclick="cerrarSesion()">Sí</button>
                        <button class="botonPopup_edusync" onclick="ocultarPopupCerrarSesion()">No</button>
                    </div>
                </div>
            </div>
        </ul>
    </nav>
</header>