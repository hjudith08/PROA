<?php
// apaño temporal para evitar el login
//llamo al archivo json de usuarios y lo guardo en una variable
$usuarios = file_get_contents('src/api/v0.0/data/usuariosProa.json');
//decodifico el json y lo guardo en una variable
$usuarios = json_decode($usuarios, true);
//busco el usuario que tenga el id 0 y lo guardo en una variable
$userdata = $usuarios[0];

// require_once 'control-ventas.inc.php';

?>

<header>
    <a href="index.php">
        <img src="imagenes/LogosProaBlanco.png" alt="Logotipo">
    </a>
    <nav>
        <!--<h3 class="titulo-asignatura"><?php echo $asignaturas['seleccion']; ?></h3>-->
        <h3 class="titulo-asignatura">Algebra Matricial y Geometría</h3>

        <ul>
            <!--<div>Bienvenido <?php echo $userdata['nombre'] . " " . $userdata['apellidos'];?>!</div> -->
            <p class="usuario-bienvenida">Bienvenido xexi mexi</p>
        </ul>
    </nav>
    <button popovertarget="menu-usuario"><img src="imagenes/user_1b.png" alt=""></button>
    <div id="menu-usuario" popover>
        <!--<div><?php echo $userdata['nombre'] . " " . $userdata['apellidos'];?>!</div> -->
        <p class="nombre-menu">xexi mexi</p>
        <div><button popovertarget="confirmar-cierre">Salir</button></div>
    </div>
</header>
<aside class="sidebar">
    <nav class="menu-container">
        <button class="menu-btn" onclick="window.location.href='InicioAsignatura.php';">
            <img src="imagenes/homeb.png" class="icono-menu" />
            <span>Inicio asignatura</span>
        </button>
        <button class="menu-btn activo">
            <img src="imagenes/libro-alt.png" class="icono-menu icono-activo" />
            <span class="texto-activo">Tareas</span>
        </button>
    </nav>
</aside>
<main class="contenido-principal">
    <div class="capa-fondo"></div>

    <div class="contenedor-tareas">
        <div class="cabecera-tareas">
            <h1>TAREAS</h1>
            <div class="filtros-tareas">
                <select id="filtro-tareas">
                    <option value="todas">Todas las tareas</option>
                    <option value="pendiente">Pendientes</option>
                    <option value="completado">Completadas</option>
                    <option value="calificada">Calificadas</option>
                </select>
            </div>
        </div>

        <div class="tabla-flex-container">
            <!-- Encabezados -->
            <div class="fila-flex encabezado-flex">
                <div class="columna-flex">Nombre tarea</div>
                <div class="columna-flex">Estado</div>
                <div class="columna-flex">Fecha apertura</div>
                <div class="columna-flex">Fecha entrega</div>
                <div class="columna-flex">Calificación</div>
            </div>

            <!-- Filas de datos -->
            <div class="fila-flex">
                <div class="columna-flex">Análisis de sucesiones y series de números reales</div>
                <div class="columna-flex"><span class="estado-pendiente">Pendiente</span></div>
                <div class="columna-flex">08/04/25</div>
                <div class="columna-flex">10/04/25</div>
                <div class="columna-flex">-</div>
            </div>

            <div class="fila-flex">
                <div class="columna-flex">Resolución de sistemas de ecuaciones lineales</div>
                <div class="columna-flex"><span class="estado-completado">Completado</span></div>
                <div class="columna-flex">04/04/25</div>
                <div class="columna-flex">15/04/25</div>
                <div class="columna-flex">8</div>
            </div>

            <div class="fila-flex">
                <div class="columna-flex">Análisis de funciones y estudio de sus gráficos</div>
                <div class="columna-flex"><span class="estado-pendiente">Pendiente</span></div>
                <div class="columna-flex">08/04/25</div>
                <div class="columna-flex">20/04/25</div>
                <div class="columna-flex">-</div>
            </div>

            <div class="fila-flex">
                <div class="columna-flex">Estudio de espacios vectoriales y subespacios</div>
                <div class="columna-flex"><span class="estado-pendiente">Pendiente</span></div>
                <div class="columna-flex">08/04/25</div>
                <div class="columna-flex">26/04/25</div>
                <div class="columna-flex">-</div>
            </div>
        </div>
    </div>
</main>

<footer class="footer-anclado">
    <div class="footer-contenido">
        <div class="footer-poweredby">
            <span class="footer-texto">Powered by</span>
            <img src="imagenes/LogoEduSyncBlanco.png" alt="Logo Edusync" class="footer-logo">
        </div>
    </div>
</footer>

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
<script src="js/FiltroTareas.js"></script>