<header>
    <a href="./">
        <img src="imagenes/LogosProaMorado.png" alt="Logotipo">
    </a>
    <nav>
        <ul>
            <!--<div>Bienvenido <?php echo $userdata['nombre'] . " " . $userdata['apellidos'];?>!</div> -->
            <p>Bienvenido xexi mexi</p>
        </ul>
    </nav>

    <button popovertarget="menu-usuario"><img src="imagenes/user_1.png" alt=""></button>
    <div id="menu-usuario" popover>
        <!--<div><?php echo $userdata['nombre'] . " " . $userdata['apellidos'];?>!</div> -->
        <p>xexi mexi</p>
        <div><button popovertarget="confirmar-cierre">Salir</button></div>
    </div>
</header>

<!-- Popover de confirmación -->
<div id="confirmar-cierre" popover>
    <p>¿Estás seguro que quieres cerrar sesión?</p>
    <button onclick="cerrarSesion()">Sí</button>
    <button onclick="document.getElementById('confirmar-cierre').hidePopover()">No</button>
</div>

<script>
    function cerrarSesion() {
        // Redirige al script de cierre de sesión real
        window.location.href = "../../../"; // o el archivo PHP que uses
    }
</script>