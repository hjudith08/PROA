<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio general - PROA</title>
    <script src="../../../js/InicioAsignatura.js" defer></script>
    <script src="../../../js/PopUpCerrarSesion.js" defer></script>
    <script src="../../../js/Responsive.js" defer></script>



    <link rel="stylesheet" href="../../../css/sergi.css" />
</head>
<body>

<header>
    <a href="inicioGeneralAlumno.html">
        <img src="../../../../imagenes/LogosProaBlanco.png" alt="Logotipo">
    </a>
    <nav>
        <h3 class="titulo-asignatura">Álgebra Matricial</h3>
        <p class="usuario-bienvenida">Bienvenido xexi mexi</p>
    </nav>

    <button popovertarget="menu-usuario" id="boton-usuario">
        <img src="../../../../imagenes/user_1b.png" alt="Usuario">
    </button>
    <div id="menu-usuario" popover anchor="boton-usuario">
        <p class="nombre-menu">Nombre Apellido</p>
        <div class="separador"></div>
        <div><button popovertarget="confirmar-cierre">Salir</button></div>
    </div>
</header>

<aside class="sidebar">
    <nav class="menu-container ">
        <button class="menu-btn activo" >
            <img src="../../../../imagenes/home.png" class="icono-menu" />
            <span class="texto-activo">Inicio Asignatura</span>
        </button>
        <button class="menu-btn" onclick="window.location.href='Tareas.html';">
            <img src="../../../../imagenes/bookb.png" class="icono-menu icono-activo" />
            <span >Tareas</span>
        </button>
    </nav>
</aside>

<main class="content">
    <button class="hamburguesa" aria-label="Abrir menú">☰</button>
    <nav class="menu-movil">
        <ul>
            <li>
                <a href="#">
                    <img src="../../../../imagenes/homeb.png" alt="Inicio" />
                    Inicio General
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="../../../../imagenes/bookb.png" alt="Asignaturas" />
                    Asignaturas
                </a>
            </li>
        </ul>
    </nav>
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="inicioGeneralAlumno.html">Inicio General</a> &gt;
        <a href="Asignaturas.html">Asignaturas</a>
    </div>
    <div class="contenedor-flex-principal">

        <!-- IZQUIERDA: Información Asignatura -->
        <div class="contenedor-tareas">
            <div class="cabecera-tareas">
                <h1>Información Asignatura</h1>
            </div>
            <div class="tabla-flex-container">
                <ul class="asignaturas">
                    <li>
                        <h3>Objetivo asignatura</h3>
                        <div class="texto-desplegable">
                            Este curso tiene como objetivo introducir los fundamentos del álgebra lineal y el cálculo diferencial.
                        </div>
                    </li>
                    <li>
                        <h3>Datos profesor</h3>
                        <div class="texto-desplegable">
                            Prof. Juan Pérez - juan.perez@proa.edu - Oficina 204
                        </div>
                    </li>
                    <li>
                        <h3>Extra</h3>
                        <div class="texto-desplegable">
                            Material de apoyo disponible en la plataforma virtual. Clases grabadas cada viernes.
                        </div>
                    </li>
                </ul>

            </div>
        </div>

        <!-- DERECHA: Lista de Tareas -->
        <div class="contenedor-tareas">
            <div class="cabecera-tareas">
                <h1>Tareas</h1>
            </div>
            <div class="tabla-flex-container">
                <ul class="tareas">
                    <li>
                        <div>
                            <p class="texto-lista-tareas">Análisis forense</p>
                            <div class="encabezado-item">
                                <div class="rectangulo-fecha">20 MAYO</div>

                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <p class="texto-lista-tareas">Docker Compose</p>
                            <div class="encabezado-item">
                                <div class="rectangulo-fecha">25 MAYO</div>

                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <p class="texto-lista-tareas">Análisis de funciones y estudio de sus gráficos</p>
                            <div class="encabezado-item">
                                <div class="rectangulo-fecha">25 MAYO</div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            </div>

    </div>

</main>




<footer class="footer-anclado">
    <div class="footer-contenido">
        <div class="footer-poweredby">
            <span class="footer-texto">Powered by</span>
            <img src="../../../../imagenes/LogoEduSyncBlanco.png" alt="Logo Edusync" class="footer-logo">
        </div>
    </div>
</footer>
<!-- Fondo oscuro -->
<div id="fondoOscuro" class="fondo-oscuro oculto"></div>
<!-- PopUp Cerrar Sesión -->
<div id="popupCerrarSesion" class="popup oculto">
    <div class="popup-contenido-C">
        <p class="popup-texto">¿Estás seguro que quieres cerrar sesión?</p>
        <div class="popup-botones">
            <button id="btn-si" class="boton-si">Sí</button>
            <button id="btn-no" class="boton-no">No</button>
        </div>
    </div>
</div>

</body>
</html>
