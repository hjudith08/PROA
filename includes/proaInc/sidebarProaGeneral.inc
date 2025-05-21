<!-- Pie de página de las páginas de proa-->
 
<?php
$pagina_actual = basename($_SERVER['PHP_SELF']);

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
        </aside>';
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
        </aside>';
    };

}

// -- EN CASO DE QUE ESTE DENTRO DE ALGUNA ASIGNATURA SE MOSTRARÁ EN LA SIDEBAR INICIO ASIGNATURA Y TAREAS
else{
 //-- SideBar en inicioAginatura--
    if ($pagina_actual == 'inicioAsignatura.php') {
        echo '
        <aside class="sidebar sidebar-ordenador">
            <nav>
                <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                    <img src="../../../imagenes/home.png" class="icono-menu"/>
                    <span>Inicio Asignatura</span>
                </button>
            
                <button class="sidebar-btn" onclick="window.location.href=\'tareas.php\';">
                    <img src="../../../imagenes/bookb.png" class="icono-menu"/>
                    <span>Tareas</span>
                </button>
            </nav>
        </aside>';
    } 

    //-- SideBar en Tareas y todo lo demas--
    else {
        echo '
        <aside class="sidebar sidebar-ordenador">
            <nav>
                <button class="sidebar-btn" onclick="window.location.href=\'inicioAsignatura.php\';">
                    <img src="../../../imagenes/homeb.png" class="icono-menu"/>
                    <span>Inicio Asignatura</span>
                </button>
            
                <button class="sidebar-btn seccion-activa" onclick="window.location.href=\'#\';">
                    <img src="../../../imagenes/book.png" class="icono-menu"/>
                    <span>Tareas</span>
                </button>
            </nav>
        </aside>';
    };
}
    
?>


