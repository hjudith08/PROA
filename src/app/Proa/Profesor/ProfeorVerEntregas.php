<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROA</title>
    <!-- imagen de pestaña -->
    <link rel="icon" href="imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/estilosJOAN.css">
    <script src="../../../js/PopUpEntregas.js" defer></script>
    <script src="../../../js/FiltroTareas.js" defer></script>
    <script src="../../../js/PopUpCerrarSesion.js" defer></script>
    <script src="../../../js/Responsive.js" defer></script>
    <script src="../../../js/InicioAsignatura.js" defer></script>
    <script src="../../../js/EditarTextoDesplegable.js" defer></script>
</head>
<body>
    
<header>
    <a href="inicioGeneralProfesor(sergi).html">
        <img src="../../../../imagenes/LogosProaBlanco.png" alt="Logotipo">
    </a>
    <nav>
        <h3 class="titulo-asignatura">MATEMATICAS</h3>
        <p class="usuario-bienvenida">Bienvenido Xexi Mexi</p>
    </nav>
    <button popovertarget="menu-usuario" id="boton-usuario">
        <img src="../../../../imagenes/user_1b.png" alt="Usuario">
    </button>
    <div id="menu-usuario" popover anchor="boton-usuario">
        <p class="nombre-menu">Xexi Mexi</p>
        <div class="separador"></div>
        <div><button popovertarget="confirmar-cierre">Salir</button></div>
    </div>
</header>

<aside class="sidebar">
    <nav class="menu-container">
        <button class="menu-btn" onclick="window.location.href='InicioAsignaturaProfesor.html';">
            <img src="../../../../imagenes/homeb.png" class="icono-menu"/>
            <span>Inicio asignatura</span>
        </button>
        <button class="menu-btn activo">
            <img src="../../../../imagenes/libro-alt.png" class="icono-menu icono-activo"/>
            <span class="texto-activo">Tareas</span>
        </button>
    </nav>
</aside>
<main class="contenido-principal">
    <div class="capa-fondo"></div>
    <div class="botones-container">
        <div class="botonatras" onclick="window.location.href='Tareas.html'">
            <p> Tareas</p>
        </div>
    </div>
    <div class="contenedor-tareas">
        <div class="cabecera-tareas">
            <h1>VER ENTREGAS</h1>
            <div class="filtros-tareas">
                <select id="filtro-tareas">
                    <option value="todas">Todas las tareas</option>
                    <option value="completado">Tareas completadas</option>
                    <option value="pendiente">Tareas pendientes</option>
                </select>
            </div>
        </div>
        <div class="tabla-flex-container">
            <div class="lista-usuarios">
                <div class="tarjeta-usuario estado-pendiente">
                    <div class="cabecera-usuario">
                        <div class="nombre-usuario">Barceló Lloret, Pablo</div>
                        <div class="zona-puntuacion-boton">
                            <div class="puntuacion">Puntuación: 7.2/10</div>
                            <button class="boton-revisar" data-titulo="Sprint 3" data-estudiante="Barceló Lloret, Pablo">Revisar</button>
                        </div>
                    </div>
                </div>

                <div class="tarjeta-usuario estado-completado">
                    <div class="cabecera-usuario">
                        <div class="nombre-usuario">Martínez García, Laura</div>
                        <div class="zona-puntuacion-boton">
                            <div class="puntuacion">Puntuación: 8.5/10</div>
                            <button class="boton-revisar" data-titulo="Sprint 3" data-estudiante="Martínez García, Laura">Revisar</button>
                        </div>
                    </div>
                </div>

                <div class="tarjeta-usuario estado-pendiente">
                    <div class="cabecera-usuario">
                        <div class="nombre-usuario">Puig Biosca, Sergi</div>
                        <div class="zona-puntuacion-boton">
                            <div class="puntuacion">Puntuación: 6.9/10</div>
                            <button class="boton-revisar" data-titulo="Sprint 3" data-estudiante="Puig Biosca, Sergi">Revisar</button>
                        </div>
                    </div>
                </div>

                <div class="tarjeta-usuario estado-completado">
                    <div class="cabecera-usuario">
                        <div class="nombre-usuario">Gómez Díaz, Clara</div>
                        <div class="zona-puntuacion-boton">
                            <div class="puntuacion">Puntuación: 9.1/10</div>
                            <button class="boton-revisar" data-titulo="Sprint 3" data-estudiante="Gómez Díaz, Clara">Revisar</button>
                        </div>
                    </div>
                </div>

                <div class="tarjeta-usuario estado-pendiente">
                    <div class="cabecera-usuario">
                        <div class="nombre-usuario">Navarro Pérez, Iván</div>
                        <div class="zona-puntuacion-boton">
                            <div class="puntuacion">Puntuación: 5.8/10</div>
                            <button class="boton-revisar" data-titulo="Sprint 3" data-estudiante="Navarro Pérez, Iván">Revisar</button>
                        </div>
                    </div>
                </div>

                <div class="tarjeta-usuario estado-pendiente">
                    <div class="cabecera-usuario">
                        <div class="nombre-usuario">Romero Torres, Lucía</div>
                        <div class="zona-puntuacion-boton">
                            <div class="puntuacion">Puntuación: -/10</div>
                            <button class="boton-revisar" data-titulo="Sprint 3" data-estudiante="Romero Torres, Lucía">Revisar</button>
                        </div>
                    </div>
                </div>

                <div class="tarjeta-usuario estado-pendiente">
                    <div class="cabecera-usuario">
                        <div class="nombre-usuario">Fernández Ruiz, David</div>
                        <div class="zona-puntuacion-boton">
                            <div class="puntuacion">Puntuación: -/10</div>
                            <button class="boton-revisar" data-titulo="Sprint 3" data-estudiante="Fernández Ruiz, David">Revisar</button>
                        </div>
                    </div>
                </div>
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
<!---------PopUp Revisar----------------->
<div id="popup" class="modal oculto">
    <div class="popup-contenido">
        <!-- Título y descripción -->
        <div class="popup-fila">
            <span class="titulo">Título:</span>
            <span class="descripcion" id="popup-titulo">Sprint 3</span>
        </div>

        <div class="popup-fila">
            <span class="titulo">Estudiante:</span>
            <span class="descripcion" id="popup-estudiante">Nombre Estudiante</span>
        </div>

        <!-- Descargar adjunto y botón -->
        <div class="descargar-linea">
            <span class="titulo">Descargar adjunto</span>
            <button class="boton-descargar">DESCARGAR</button>
        </div>

        <!-- Campo para la nota y botón Puntuar en línea -->
        <div class="nota-linea">
            <input type="text" class="input-nota" id="nota" placeholder="Nota">
            <span class="sobre-diez">/10</span>
            <button class="puntuar-boton">PUNTUAR</button>
        </div>

        <button class="cerrar" onclick="cerrarPopup()">×</button>
    </div>
</div>
<!--------------------------------------->
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
