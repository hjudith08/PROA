<!-- Sidebar de las páginas de proa-->
<?php
$idAsignatura = isset($_GET['id']) ? $_GET['id'] : '';
$pagina_actual = basename($_SERVER['PHP_SELF']);

if ($pagina_actual == 'inicioGeneral.php' || $pagina_actual == 'asignaturas.php') {

    //-- SideBar en inicioGeneral--
    if ($pagina_actual == 'inicioGeneral.php') {
        echo '
        <aside class="sidebar sidebar-ordenador">
            <nav>
                <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                    <img src="../../../imagenes/home.png" class="icono-menu"/>
                    <span>Inicio General</span>
                </button>

                <button class="sidebar-btn" onclick="window.location.href=\'asignaturas.php\';">
                    <img src="../../../imagenes/bookb.png" class="icono-menu"/>
                    <span>Asignaturas</span>
                </button>
            </nav>
        </aside>

        <div class="menu-movil">
            <button popovertarget="menu-hamburguesa">
                <img src="../../../imagenes/menu-hamburguesa.png" class="icono-hamburguesa"/>
            </button>
            <div id="menu-hamburguesa" popover>
                <nav>
                    <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                        <img src="../../../imagenes/home.png" class="icono-menu"/>
                        <span>Inicio General</span>
                    </button>

                    <button class="sidebar-btn" onclick="window.location.href=\'asignaturas.php\';">
                        <img src="../../../imagenes/bookb.png" class="icono-menu"/>
                        <span>Asignaturas</span>
                    </button>
                </nav>
            </div>
        </div>';
    }

    //-- SideBar en Asignaturas--
    elseif ($pagina_actual == 'asignaturas.php') {
        echo '
        <aside class="sidebar sidebar-ordenador">
            <nav>
                <button class="sidebar-btn" onclick="window.location.href=\'inicioGeneral.php\';">
                    <img src="../../../imagenes/homeb.png" class="icono-menu"/>
                    <span>Inicio General</span>
                </button>

                <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                    <img src="../../../imagenes/book.png" class="icono-menu"/>
                    <span>Asignaturas</span>
                </button>
            </nav>
        </aside>

        <div class="menu-movil">
            <button popovertarget="menu-hamburguesa">
                <img src="../../../imagenes/menu-hamburguesa.png" class="icono-hamburguesa"/>
            </button>
            <div id="menu-hamburguesa" popover>
                <nav>
                    <button class="sidebar-btn" onclick="window.location.href=\'inicioGeneral.php\';">
                        <img src="../../../imagenes/homeb.png" class="icono-menu"/>
                        <span>Inicio General</span>
                    </button>

                    <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                        <img src="../../../imagenes/book.png" class="icono-menu"/>
                        <span>Asignaturas</span>
                    </button>
                </nav>
            </div>
        </div>';
    }

} else {
    //-- SideBar en inicioAsignatura--
    if ($pagina_actual == 'inicioAsignatura.php') {
        echo '
        <aside class="sidebar sidebar-ordenador">
            <nav>
                <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                    <img src="../../../imagenes/home.png" class="icono-menu"/>
                    <span>Inicio Asignatura</span>
                </button>

                <button class="sidebar-btn" onclick="window.location.href=\'tareas.php?id=' . htmlspecialchars($idAsignatura) . '\';" id="btn-tareas">
                    <img src="../../../imagenes/bookb.png" class="icono-menu"/>
                    <span>Tareas</span>
                </button>
            </nav>
        </aside>

        <div class="menu-movil">
            <button popovertarget="menu-hamburguesa">
                <img src="../../../imagenes/menu-hamburguesa.png" class="icono-hamburguesa"/>
            </button>
            <div id="menu-hamburguesa" popover>
                <nav>
                    <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                        <img src="../../../imagenes/home.png" class="icono-menu"/>
                        <span>Inicio Asignatura</span>
                    </button>

                    <button class="sidebar-btn" onclick="window.location.href=\'tareas.php?id=' . htmlspecialchars($idAsignatura) . '\';">
                        <img src="../../../imagenes/bookb.png" class="icono-menu"/>
                        <span>Tareas</span>
                    </button>
                </nav>
            </div>
        </div>';
    }

    //-- SideBar en Tareas y demás páginas relacionadas--
    else {
        echo '
        <aside class="sidebar sidebar-ordenador">
            <nav>
                <button class="sidebar-btn" onclick="window.location.href=\'inicioAsignatura.php?id=' . htmlspecialchars($idAsignatura) . '\';">
                    <img src="../../../imagenes/homeb.png" class="icono-menu"/>
                    <span>Inicio Asignatura</span>
                </button>

                <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                    <img src="../../../imagenes/book.png" class="icono-menu"/>
                    <span>Tareas</span>
                </button>
            </nav>
        </aside>

        <div class="menu-movil">
            <button popovertarget="menu-hamburguesa">
                <img src="../../../imagenes/menu-hamburguesa.png" class="icono-hamburguesa"/>
            </button>
            <div id="menu-hamburguesa" popover>
                <nav>
                    <button class="sidebar-btn" onclick="window.location.href=\'inicioAsignatura.php?id=' . htmlspecialchars($idAsignatura) . '\';">
                        <img src="../../../imagenes/homeb.png" class="icono-menu"/>
                        <span>Inicio Asignatura</span>
                    </button>

                    <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                        <img src="../../../imagenes/book.png" class="icono-menu"/>
                        <span>Tareas</span>
                    </button>
                </nav>
            </div>
        </div>';
    }
}
?>
