<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PROA</title>
    <link rel="icon" href="imagenes/LogosProaBlancoV3.png" type="image/png" />
    <link rel="stylesheet" href="../../../css/estilos2.css" />
    <link rel="stylesheet" href="../../../css/estilosJOAN.css" />
    <link rel="stylesheet" href="../../../css/estiloscreartarea.css" />
    <script src="../../../js/PopUpEntregas.js" defer></script>
    <script src="../../../js/FiltroTareas.js" defer></script>
    <script src="../../../js/PopUpCerrarSesion.js" defer></script>
    <script src="../../../js/Responsive.js" defer></script>
    <script src="../../../js/InicioAsignatura.js" defer></script>
    <script src="../../../js/EditarTextoDesplegable.js" defer></script>
    <script src="../../../js/creartarea.js" defer></script>
</head>
<body>
<header>
    <a href="inicioGeneralProfesor(sergi).html">
        <img src="../../../../imagenes/LogosProaBlanco.png" alt="Logotipo" />
    </a>
    <nav>
        <h3 class="titulo-asignatura">MATEMATICAS</h3>
        <p class="usuario-bienvenida">Bienvenido Xexi Mexi</p>
    </nav>
    <button popovertarget="menu-usuario" id="boton-usuario" aria-label="Menú usuario">
        <img src="../../../../imagenesuser_1b.png" alt="Usuario" />
    </button>
    <div id="menu-usuario" popover anchor="boton-usuario">
        <p class="nombre-menu">Xexi Mexi</p>
        <div class="separador"></div>
        <div><button popovertarget="confirmar-cierre">Salir</button></div>
    </div>
</header>
<aside class="sidebar">
    <nav class="menu-container">
        <button class="menu-btn" onclick="window.location.href='InicioAsignatura.html';">
            <img src="../../../../imagenes/homeb.png" class="icono-menu" alt="Inicio asignatura" />
            <span>Inicio asignatura</span>
        </button>
        <button class="menu-btn activo">
            <img src="../../../../imagenes/libro-alt.png" class="icono-menu icono-activo" alt="Tareas" />
            <span class="texto-activo">Tareas</span>
        </button>
    </nav>
</aside>
<main class="contenido-principal">
    <div class="capa-fondo"></div>
    <button class="hamburguesa" aria-label="Abrir menú">☰</button>
    <nav class="menu-movil">
        <ul>
            <li>
                <a href="inicioGeneralAlumno.html">
                    <img src="../../../../imagenes/homeb.png" alt="Inicio" />
                    Inicio General
                </a>
            </li>
            <li>
                <a href="InicioAsignaturas.html">
                    <img src="../../../../imagenes/bookb.png" alt="Asignaturas" />
                    Asignaturas
                </a>
            </li>
        </ul>
    </nav>
    <div class="botones-container">
        <div class="botonatras" onclick="window.location.href='InicioGeneral.html'">
            <p>Inicio General</p>
        </div>
        <div class="botonatras" onclick="window.location.href='Asignaturas.html'">
            <p>< Asignaturas</p>
        </div>
    </div>
    <div class="contenedor-tareas">
        <div class="cabecera-tareas">
            <h1>CREAR TAREA</h1>
        </div> <!-- <- Cierre que faltaba -->
        <div class="tabla-flex-container">
            <div class="card-content">
                <form class="form" id="taskForm">
                    <!-- Programar tarea para -->
                    <label class="form-label" for="scheduleDate">Programar tarea para:</label>
                    <div class="input-date-wrapper">
                        <input type="date" class="input-date" id="scheduleDate" required />
                    </div>

                    <!-- Título tarea -->
                    <label class="form-label" for="taskTitle">Título tarea:</label>
                    <input type="text" class="input-text" id="taskTitle" placeholder="Ingrese el título" required />

                    <!-- Descripción de la tarea -->
                    <div class="form-row">
                        <label class="form-label" for="taskDescription">Descripción de la tarea:</label>
                        <textarea class="textarea" id="taskDescription" placeholder="Describa la tarea aquí" required></textarea>
                    </div>

                    <!-- Adjuntar archivos -->
                    <label class="form-label" for="taskFile">Adjuntar archivos:</label>
                    <div class="file-input-wrapper">
                        <input type="file" class="file-input" id="taskFile" />
                        <button type="button" class="file-input-button" onclick="document.getElementById('taskFile').click();">
                            <span>Subir archivo</span>
                        </button>
                    </div>

                    <!-- Fecha entrega -->
                    <label class="form-label" for="dueDate">Fecha entrega:</label>
                    <div class="input-date-wrapper">
                        <input type="date" class="input-date" id="dueDate" required />
                    </div>

                    <!-- Puntuación sobre -->
                    <label class="form-label" for="taskScore">Puntuación sobre:</label>
                    <input type="number" class="input-text" id="taskScore" placeholder="100" min="1" required />

                    <!-- Submit button -->
                    <div class="submit-button">
                        <button type="submit">CREAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<footer class="footer-anclado">
    <div class="footer-contenido">
        <div class="footer-poweredby">
            <span class="footer-texto">Powered by</span>
            <img src="../../../../imagenes/LogoEduSyncBlanco.png" alt="Logo Edusync" class="footer-logo" />
        </div>
    </div>
</footer>
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
