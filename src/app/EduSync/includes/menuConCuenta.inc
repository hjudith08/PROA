
<?php
// apaño temporal para evitar el login
//llamo al archivo json de usuarios y lo guardo en una variable
$usuarios = file_get_contents('../../../src/api/v0.0/data/usuariosEduSync.json');
//decodifico el json y lo guardo en una variable
$usuarios = json_decode($usuarios, true);
//busco el usuario que tenga el id 0 y lo guardo en una variable
$userdata = $usuarios[0];

 // require_once 'control-ventas.inc.php';

?>
    
    <header>
        <a href="./">
            <img src="../../../imagenes/LogoEduSyncAzul.png" alt="Logotipo">
        </a>
        <nav>
            <ul>
                <input type="button" value="CONTACTO" onclick="location.href='../EduSync/contacto.php'">
            </ul>
        </nav>
        
        <button popovertarget="menu-usuario"><img src="../../../imagenes/user_1.png" alt=""></button>
        <div id="menu-usuario" popover>
            <div>Bienvenido <?php echo $userdata['nombre'] . " " . $userdata['apellidos'];?>!</div>
            <div><a href="../EduSync/mis-herramientas.php">Mis herramientas</a></div>
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