<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync | Venta de Modulos Educativos</title>
    <link rel="icon" href="../../../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/estilos-landing-sesion.css">
</head>

<body>

<!-- header -->
  <header>
    <a href="./">
      <img src="../../../../imagenes/LogoEduSyncAzul.png" alt="Logotipo">
    </a>
    <nav>
      <ul>
        <input type="button" value="CONTACTO" onclick="location.href='contacto.html'">
        <img class="logo-user" src="../../../../imagenes/user_1.png" alt="user">
        <!-- Dentro del <nav> antes de cerrar el </ul> -->
        <div class="dropdown-usuario" id="dropdownUsuario">
        <button><a href="mis-herramientas.html" class="nombre-usuario">Mis herramientas</a></button>
        <button class="boton-cerrar-sesion" onclick="mostrarPopupCerrarSesion()">Cerrar sesión</button>
        </div>

        <!-- Popup de confirmación -->
        <div class="popup" id="popupCerrarSesion">
        <div class="popup-contenido">
            <p class="popup-texto">¿Estás seguro que quieres cerrar sesión?</p>
            <div class="popup-botones">
            <button onclick="cerrarSesion()">Sí</button>
            <button onclick="ocultarPopupCerrarSesion()">No</button>
            </div>
        </div>
        </div>

      </ul>
    </nav>
  </header>

<!-- sección principal -->
<section class="hero">
    <div class="overlay">
        <div class="hero-content">
            <div class="text-content">
                <h2>Transforma tu institución con<br> módulos inteligentes y a tu medida</h2>
                <p>Prueba nuestra primear herramienta educativa gratis!</p>
                <!-- logo de PROA -->
                <img src="../../../../imagenes/LogosProaBlanco.png" alt="Logo PROA" class="logo-proa"><br>
                
                <!-- botón que simula una llamada a la demo -->
                <a href="desc-herramienta.html" class="boton-demo">DEMO PROA</a>

                <p>Descubre cómo podemos ayudarte a modernizar tu institución<br> hoy mismo con nuestras herramientas educativas.</p>
            </div>

            <!-- flecha que baja a la siguiente sección -->
            <div class="flecha-bajar">
                <a href="#sobre-nosotros" class="boton-flecha">
                    <span class="flecha"><img src="../../../../imagenes/down-arrow.png" alt="Boton bajar"></span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- sección "sobre nosotros" con información descriptiva -->
<section class="sobre-nosotros" id="sobre-nosotros">
    <h2>Sobre nosotros</h2>
    <p>
        Somos una empresa proveniente de una matriz de GTI (Grado en Tecnologías Interactivas) dedicada a mejorar la experiencia educativa dentro de las instituciones, diseñamos módulos educativos que hacen que la interacción entre alumnos y profesores sea más simple, fluida y agradable. Queremos que las plataformas educativas no solo funcionen, sino que realmente conecten con quienes las usan.
    </p>
    <!-- icono -->
    <img src="../../../../imagenes/usuariosazul.png" alt="Icono personas" class="icono-ns">
</section>

<!-- footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-col">
            <p>Contáctanos: edusync@gti.com</p>
        </div>
        <div class="footer-col">
            <p>© 2025 - EduSync | Matriz de GTI</p>
        </div>
        <div class="footer-col">
            <img src="../../../../imagenes/GTIBlancosdsds.png" alt="Logo GTI">
        </div>
    </div>
</footer>


<!-- botón para volver arriba -->
<a href="#" class="scroll-to-top" aria-label="Subir al inicio">
    <img src="../../../../imagenes/high-arrowb.png" alt="Subir inicio pagina">
</a>

<!-- script para mostrar/ocultar el botón al hacer scroll -->
<script>
    const scrollBtn = document.querySelector('.scroll-to-top');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollBtn.classList.add('visible'); // muestra el botón
        } else {
            scrollBtn.classList.remove('visible'); // oculta el botón
        }
    });
</script>
<script src="../../../js/misherramientas.js"></script>
<!-- fin del script -->

</body>
</html>
