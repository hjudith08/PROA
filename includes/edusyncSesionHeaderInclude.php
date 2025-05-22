    <header>
        <a href="./">
            <img src="../../../../imagenes/LogoEduSyncAzul.png" alt="Logotipo">
        </a>
        <nav>
            <ul>
                <input type="button" value="CONTACTO" onclick="location.href='contacto.html'">
                <img class="logo-user" src="../../../../imagenes/user_1.png" alt="user">
                <!-- Dentro del <nav> antes de cerrar el </ul> -->
                <div class="dropdown-usuario" id="dropdownUsuario">
                    <button><a href="mis-herramientas.html" class="nombre-usuario">Mis herramientas</a></button>
                    <button class="boton-cerrar-sesion" onclick="mostrarPopupCerrarSesion()">Cerrar sesión</button>
                </div>

            <!-- Popup de confirmación -->
                <div class="popup" id="popupCerrarSesion">
                <div class="popup-contenido">
                    <p class="popup-texto">¿Estás seguro que quieres cerrar sesión?</p>
                    <div class="popup-botones">
                    <button onclick="cerrarSesion()">Sí</button>
                    <button onclick="ocultarPopupCerrarSesion()">No</button>
                    </div>
                </div>
                </div>

            </ul>
        </nav>
    </header>