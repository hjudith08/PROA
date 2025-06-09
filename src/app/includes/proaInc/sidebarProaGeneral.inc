<!-- Sidebar de las páginas de proa-->

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$pagina_actual = basename($_SERVER['PHP_SELF']);
$id_asignatura = $_GET['id'] ?? null;

if ($pagina_actual == 'inicioGeneral.php' || $pagina_actual == 'asignaturas.php' ) {
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
              <!-- botón del menu de hamburguesa -->
            <button popovertarget="menu-hamburguesa"><img src="../../../imagenes/menu-hamburguesa.png" class="icono-hamburguesa"/></button>
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
              <!-- botón del menu de hamburguesa -->
            <button popovertarget="menu-hamburguesa"><img src="../../../imagenes/menu-hamburguesa.png" class="icono-hamburguesa"/></button>
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
    };

}

// -- EN CASO DE QUE ESTE DENTRO DE ALGUNA ASIGNATURA SE MOSTRARÁ EN LA SIDEBAR INICIO ASIGNATURA Y TAREAS
else {
 //-- SideBar en inicioAginatura--
    if ($pagina_actual == 'inicioAsignatura.php') {
        echo '
        <aside class="sidebar sidebar-ordenador">
            <nav>
                <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                    <img src="../../../imagenes/home.png" class="icono-menu"/>
                    <span>Inicio Asignatura</span>
                </button>
            
                <button class="sidebar-btn" id="btn-tareas">
                    <img src="../../../imagenes/bookb.png" class="icono-menu"/>
                    <span>Tareas</span>
                </button>

                <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'alumnos.php?id=' . $id_asignatura . '\';">
                    <img src="../../../imagenes/usuariob.psd.png" class="icono-menu"/>
                    <span>Lista alumnos</span>
                </button>
            </nav>
        </aside>
        
        <div class="menu-movil">
              <!-- botón del menu de hamburguesa -->
            <button popovertarget="menu-hamburguesa"><img src="../../../imagenes/menu-hamburguesa.png" class="icono-hamburguesa"/></button>
            <div id="menu-hamburguesa" popover>
                 <nav>
                    <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                        <img src="../../../imagenes/home.png" class="icono-menu"/>
                        <span>Inicio Asignatura</span>
                    </button>
                
                    <button class="sidebar-btn" onclick="window.location.href=\'tareas.php\';">
                        <img src="../../../imagenes/bookb.png" class="icono-menu"/>
                        <span>Tareas</span>
                    </button>

                    <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'alumnos.php?id=' . $id_asignatura . '\';">
                        <img src="../../../imagenes/usuariob.psd.png" class="icono-menu"/>
                        <span>Lista alumnos</span>
                    </button>
                </nav>
            </div>
        </div>';
    } 

    //-- SideBar en Tareas y todo lo demas--
        elseif (in_array($pagina_actual, ['tareas.php', 'crearTarea.php', 'editarTarea.php', 'verTarea.php', 'verEntregas.php'])) {
        echo '
        <aside class="sidebar sidebar-ordenador">
            <nav>
                <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'inicioAsignatura.php?id=' . $id_asignatura . '\';">
                    <img src="../../../imagenes/homeb.png" class="icono-menu"/>
                    <span>Inicio Asignatura</span>
                </button>
            
                <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                    <img src="../../../imagenes/book.png" class="icono-menu"/>
                    <span>Tareas</span>
                </button>

                <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'alumnos.php?id=' . $id_asignatura . '\';">
                    <img src="../../../imagenes/usuariob.psd.png" class="icono-menu"/>
                    <span>Lista alumnos</span>
                </button>
            </nav>
        </aside>
        
        <div class="menu-movil">
              <!-- botón del menu de hamburguesa -->
            <button popovertarget="menu-hamburguesa"><img src="../../../imagenes/menu-hamburguesa.png" class="icono-hamburguesa"/></button>
            <div id="menu-hamburguesa" popover>
                 <nav>
                    <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'inicioAsignatura.php?id=' . $id_asignatura . '\';">
                        <img src="../../../imagenes/homeb.png" class="icono-menu"/>
                        <span>Inicio Asignatura</span>
                    </button>
                
                    <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                        <img src="../../../imagenes/book.png" class="icono-menu"/>
                        <span>Tareas</span>
                    </button>
                    <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'alumnos.php?id=' . $id_asignatura . '\';">
                        <img src="../../../imagenes/usuariob.psd.png" class="icono-menu"/>
                        <span>Lista alumnos</span>
                    </button>
                </nav>
            </div>
        </div>';
    }
    elseif ($pagina_actual == 'alumnos.php') {
    echo '
            <aside class="sidebar sidebar-ordenador">
            <nav>
                <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'inicioAsignatura.php?id=' . $id_asignatura . '\';">
                    <img src="../../../imagenes/homeb.png" class="icono-menu"/>
                    <span>Inicio Asignatura</span>
                </button>
            
                <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'tareas.php?id=' . $id_asignatura . '\';">
                    <img src="../../../imagenes/bookb.png" class="icono-menu"/>
                    <span>Tareas</span>
                </button>

                <button class="sidebar-btn  seccion-activa" id="btn-tareas">
                    <img src="../../../imagenes/usuarios.png" class="icono-menu"/>
                    <span>Lista alumnos</span>
                </button>
            </nav>
        </aside>
        
        <div class="menu-movil">
              <!-- botón del menu de hamburguesa -->
            <button popovertarget="menu-hamburguesa"><img src="../../../imagenes/menu-hamburguesa.png" class="icono-hamburguesa"/></button>
            <div id="menu-hamburguesa" popover>
                 <nav>
                    <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'inicioAsignatura.php?id=' . $id_asignatura . '\';">
                        <img src="../../../imagenes/homeb.png" class="icono-menu"/>
                        <span>Inicio Asignatura</span>
                    </button>
                
                    <button class="sidebar-btn" id="btn-tareas" onclick="window.location.href=\'tareas.php?id=' . $id_asignatura . '\';">
                        <img src="../../../imagenes/bookb.png" class="icono-menu"/>
                        <span>Tareas</span>
                    </button>
                    <button class="sidebar-btn seccion-activa" id="btn-tareas">
                        <img src="../../../imagenes/usuarios.png" class="icono-menu"/>
                        <span>Lista alumnos</span>
                    </button>
                </nav>
            </div>
        </div>';
    } 
}
    
?>