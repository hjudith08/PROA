<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync | Venta de Modulos Educativos</title>
    <link rel="icon" href="imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="css/edusyncCSS/estilosBaseEduSync.css">
    <link rel="stylesheet" href="css/edusyncCSS/estilos.css">
    <script src="js/eduSyncJS/funcionesBaseEduSync.js" defer></script>
</head>

<body>

    <!-- header -->
    <?php include 'app/includes/eduSyncInc/menuEduSync.inc'; ?>
    <div class="contenido">
        <!-- sección principal -->
        <section class="hero">
            <div class="overlay">
                <div class="hero-content">
                    <div class="text-content">
                        <h2>Transforma tu institución con<br> módulos inteligentes y a tu medida</h2>

                        <!-- botón que simula una llamada a la demo -->
                        <a href="app/eduSync/descripcionHerramienta.php" class="boton-demo">Demo PROA</a>
                        <p>Prueba nuestra primear herramienta educativa gratis!</p>
                    </div>

                    <!-- flecha que baja a la siguiente sección -->
                    <div class="flecha-bajar">
                        <a href="#sobre-nosotros" class="boton-flecha">
                            <span class="flecha"><img src="imagenes/down-arrow.png" alt="Boton bajar"></span>
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
                    <img src="css/imagenes/GTIBlancosdsds.png" alt="logo gti" class="logo-gti">
                    <h2>x</h2>
                    <img src="css/imagenes/LogoEduSyncBlanco.png" alt="logo edusync" class="logo-edusync">
                </div>
                <p>
                    Somos una empresa proveniente de una matriz de GTI (Grado en Tecnologías Interactivas) dedicada a
                    mejorar la experiencia educativa dentro de las instituciones, diseñamos módulos educativos que hacen
                    que
                    la interacción entre alumnos y profesores sea más simple, fluida y agradable. Queremos que las
                    plataformas educativas no solo funcionen, sino que realmente conecten con quienes las usan.
                </p>
            </div>
        </section>

        <?php
        if (!isset($dataEdu['id'])) {
            ?>
            <section class="registrarse-landing">
                <h2>¿Listo para unirte a nuestra comunidad?</h2>
                <p>Registrate en EduSync para acceder a todas nuestras demos de las mejores herramientas a tu disposicion.
                </p>
                <a href="app/eduSync/loginRegistro.php" class="boton-demo">Registrate</a>
            </section>
            <?php
        }
        ?>

    </div>
    <!-- footer -->
    <?php include 'app/includes/eduSyncInc/footerEduSync.inc'; ?>


    <!-- botón para volver arriba -->
    <a href="#" class="scroll-to-top" aria-label="Subir al inicio">
        <img src="css/imagenes/high-arrowb.png" alt="Subir inicio pagina">
    </a>
</body>
</html>