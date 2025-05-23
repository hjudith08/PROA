<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync | Venta de Modulos Educativos</title>
    <link rel="icon" href="../../../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/estilos.css">
    <link rel="stylesheet" href="../../../css/Includes/estilo-headerEduSyncSesion.css">
</head>

<body>

<!-- header -->
<?php include '../../../../includes/edusyncNoSesionHeaderInclude.php'; ?>
<!-- sección principal -->
<section class="hero">
    <div class="overlay">
        <div class="hero-content">
            <div class="text-content">
                <h2>Transforma tu institución con<br> módulos inteligentes y a tu medida</h2>
                
                <!-- botón que simula una llamada a la demo -->
                <a href="noSesionDescHerramienta.php" class="boton-demo">Demo PROA</a>
                <p>Prueba nuestra primear herramienta educativa gratis!</p>
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
    <div class="overlay-sn">
        <h2>Sobre nosotros</h2>
        <div class="sobre-nosotros-logos">
            <img src="../../../../imagenes/GTIBlancosdsds.png" alt="logo gti" class="logo-gti">
            <h2>x</h2>
            <img src="../../../../imagenes/LogoEduSyncBlanco.png" alt="logo edusync" class="logo-edusync">
        </div>
        <p>
            Somos una empresa proveniente de una matriz de GTI (Grado en Tecnologías Interactivas) dedicada a mejorar la experiencia educativa dentro de las instituciones, diseñamos módulos educativos que hacen que la interacción entre alumnos y profesores sea más simple, fluida y agradable. Queremos que las plataformas educativas no solo funcionen, sino que realmente conecten con quienes las usan.
        </p>
    </div>
</section>

<section class="registrarse-landing">
    <h2>¿Listo para unirte a nuestra comunidad?</h2>
    <p>Registrate en EduSync para acceder a todas nuestras demos de las mejores herramientas a tu disposicion.</p>
    <a href="noSesionRegistroLogin.php" class="boton-demo">Registrate</a>
</section>

<!-- footer -->
<?php include '../../../../includes/edusyncFooterInclude.php'; ?>


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
<!-- fin del script -->

</body>
</html>
