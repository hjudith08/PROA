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
                        <a href="#sobre-nosotros" class="boton-flecha" id="boton-flecha">
                            <span class="flecha"><img src="imagenes/down-arrow.png" alt="Boton bajar"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- sección "sobre nosotros" con información descriptiva -->
        <section class="sobre-nosotros" id="sobre-nosotros">

            <div class="seccion-gti">
                <h2>Sobre nosotros</h2>
                <div class="logo-texto-gti">
                    <img src="imagenes/LogoGTI_Landing.png" alt="logo gti" class="logo-gti">
                    <p>
                        Somos una empresa emergente llamada EduSync.
                        Provenimos de una empresa matriz llamada GTI.
                    </p>
                </div>
            </div>
            <div class="seccion-edusync">
                <div class="overlay-sn">
                    <p>
                        En EduSync nos dedicamos a mejorar la experiencia educativa dentro 
                         de las instituciones, diseñando módulos educativos para 
                        que la interacción entre alumnos y profesores sea más simple y fluida.
                    </p>
                    <img src="imagenes/LogoEduSyncBlanco.png" alt="logo edusync" class="logo-edusync">
                </div>
            </div>
        </section>

        <?php
        if (!isset($_SESSION['usuario_nombre'])) {
            ?>
            <section class="registrarse-landing">
                
                <p> Ayudanos a que las plataformas educativas no solo funcionen, 
                    sino que realmente conecten con quienes las usan.
        </p>    
        <div class="titulos-registrarse">
                <h3>Ahora que ya sabes algo sobre nosotros</h3>
                <h2>¿Estas listo para unirte a nuestra comunidad?</h2>
                </div>
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
        <img src="imagenes/high-arrowb.png" alt="Subir inicio pagina">
    </a>
</body>

</html>