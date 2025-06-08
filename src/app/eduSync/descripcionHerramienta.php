<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync | Venta de Modulos Educativos</title>
    <link rel="icon" href="../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../css/edusyncCSS/estilosBaseEduSync.css">
    <link rel="stylesheet" href="../../css/edusyncCSS/estilos.css">
    <script src="../../js/eduSyncJS/funcionesBaseEduSync.js" defer></script>
</head>

<body>

    <!-- header -->
    <?php include '../includes/eduSyncInc/menuEduSync.inc'; ?>

    <!-- primera sección información PROA -->
    <div class="contenido">
        <section class="desc-section1">
            <div class="sec1-div">
                <div class="informacion-sec1">
                    <!-- logo, informacion y boton PROA -->
                    <img src="../../imagenes/LogosProaBlanco.png" alt="Logo PROA" class="logo-proa"><br>
                    <p><strong>PROA </strong> es una aplicación educativa que ayuda a las instituciones a
                        mejorar la interacción entre alumnos y profesores a través de módulos con una interfaz moderna,
                        intuitiva y agradable.
                        Al formar parte de EduSync, tendrás acceso a pruebas exclusivas y herramientas
                        diseñadas para transformar la enseñanza.

                    </p>
                </div>
                <!-- imagen proa ordenador -->
                <div class="informacion-sec2">
                    <img src="../../imagenes/ordenador-proa.png" alt="Ordenador PROA" class="ordenador-proa">
                </div>
                <!-- flecha para bajar a la sección de como funciona la demo -->
                <div class="flecha-bajar">
                    <a href="#desc-section2" class="boton-flecha">
                        <span class="flecha"><img src="../../imagenes/down-arrow.png" alt="Boton bajar"></span>
                    </a>
                </div>
            </div>
        </section>
        <!-- fin de la primera sección -->

        <!-- segunda sección de como funciona la demo -->
        <section class="desc-section2" id="desc-section2">
            <div class="container-sec2">
                <h2>¿Cómo funciona la demo?</h2>
                <div class="pasos-demo">
                    <!-- 3 diferentes iconos y información -->
                    <div class="paso">
                        <div class="icono">
                            <img src="../../imagenes/keyb.png" alt="Icono Credenciales">
                        </div>
                        <h3>Solicita las credenciales</h3>
                        <p>Te facilitaremos credenciales temporales para que puedas 
                            explorar nuestro módulo con diferentes vistas.</p>
                    </div>
                    <div class="paso">
                        <div class="icono">
                            <img src="../../imagenes/demob.png" alt="Icono Demo">
                        </div>
                        <h3>Prueba la DEMO</h3>
                        <p>Explora todas las funcionalidades que tu plataforma educativa podría integrar.</p>
                    </div>
                    <div class="paso">
                        <div class="icono">
                            <img src="../../imagenes/cartb.png" alt="Icono Compra">
                        </div>
                        <h3>Compra PROA</h3>
                        <p>Si te ha gustado ponte en contacto con nosotros para más información.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- fin de la segunda sección -->

        <!-- tercera sección información de PROA, imagen de fondo y texto -->
        <section class="desc-section3">
            <div class="overlay-s3">
                <img src="../../imagenes/fotobg.png" alt="">
                <p>Nuestra demo educativa ofrece una experiencia interactiva y personalizada para estudiantes,
                    permitiéndoles explorar conceptos de manera práctica y a su propio ritmo.<br><br>
                    Con tecnología de vanguardia y simulaciones inmersivas, facilita un aprendizaje profundo y
                    atractivo. <br>

                    Además, su fácil integración en plataformas educativas existentes mejora la enseñanza sin
                    complicaciones.<br>

                    Los educadores pueden hacer un seguimiento detallado del progreso de los estudiantes, optimizando la
                    enseñanza en tiempo real. <br><br>

                    ¡Descubre cómo esta herramienta puede transformar la educación de manera eficiente y accesible!</p>
            </div>
        </section>
        <!-- fin de la tercera sección -->

        <!-- cuarta sección información funcionalidad multiplataforma -->
        <section class="desc-section4">
            <div class="contenedor-flex">
                <!-- imagen movil -->

                <!-- titulo y texto -->
                <div class="texto-multiplataforma">
                    <h2><strong>Funcionalidad multiplataforma</strong></h2>
                    <p>
                        App educativa multiplataforma accesible desde móvil, tablet y ordenador.<br>
                        Sincronización en tiempo real y experiencia fluida para alumnos, docentes y familias.
                    </p><br><br>
                    <p>
                        La app tiene un diseño intuitivo y adaptable, con una interfaz clara y moderna que facilita la
                        navegación en cualquier dispositivo.<br>
                        Su experiencia visual es atractiva y optimizada para un uso cómodo y eficiente.
                    </p>
                </div>
                <!-- imagenes -->
                <div class="imagenes-mt">
                    <div class="img-tablet">
                        <img src="../../imagenes/tablet-proa.png" alt="Vista tablet/ordenador">
                    </div>
                    <div class="img-movil">
                        <img src="../../imagenes/movil-proa.png" alt="Vista móvil">
                    </div>
                </div>
                <?php
                if (isset($_SESSION['usuario_id'])) {
                    // Usuario logueado: lleva a la demo de PROA
                    ?>
                    <a href="../proa/LoginProa.php" class="boton-demo">¡Prueba PROA Gratis!</a>
                    <?php
                } else {
                    // Usuario NO logueado: lleva al registro/login de EduSync
                    ?>
                    <a href="loginRegistro.php" class="boton-demo">¡Prueba PROA Gratis!</a>
                    <?php
                }
                ?>
            </div>

        </section>
        <!-- fin de la cuarta sección -->

        <!-- quinta sección información funcionalidad multiplataforma -->
        <section class="desc-section5">
            <div class="contenedor-flex">

            </div>
        </section>
        <!-- fin de la quinta sección -->
        <!-- footer -->
    </div>
    <?php include '../includes/eduSyncInc/footerEduSync.inc'; ?>

    <!-- botón para volver arriba -->
    <a href="#" class="scroll-to-top" aria-label="Subir al inicio">
        <img src="../../imagenes/high-arrowb.png" alt="Subir inicio pagina">
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