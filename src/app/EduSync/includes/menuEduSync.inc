
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
            <img src="../../../imagenes/LogoEduSyncBlanco.png" alt="Logotipo">
        </a>
        <nav>
            <ul>
                <input type="button" value="CONTACTO" onclick="location.href='./Contacto.php'">
            </ul>
        </nav>
        
        <button popovertarget="menu-usuario"><img src="../../../imagenes/vik.jpg" alt=""></button>
        <div id="menu-usuario" popover>
            <div>Bienvenido <?php echo $userdata['nombre'] . " " . $userdata['apellidos'];?>!</div>
            <div><a href="./mis-herramietas.php">Mis herramientas</a></div>
            <div><a href="../../../">Salir</a></div>
        </div>
    </header>