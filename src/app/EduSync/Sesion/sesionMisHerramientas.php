<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduSync | Mis herramientas</title>
  <link rel="icon" href="/PROA/src/css/imagenes/LogoEduSyncBlancoV3.png" type="image/png">
  <link rel="stylesheet" href="/PROA/src/css/Edusync/estilo-mis-herramientas.css">
  <link rel="stylesheet" href="/PROA/src/css/Includes/estilo-headerEdusyncSesion.css">
  <script src="PROA/src/js/sesionMisHerramientass.js"></script>
</head>

<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/PROA/includes/edusyncSesionHeaderInclude.php'; ?>

  <div class="contenedorFondo_misHerramientas">
    <div class="contenedorPrincipal_misHerramientas">
      <main class="contenidoPrincipal_misHerramientas">
        <!-- Cabecera de la página -->
        <h1 class="tituloPrincipal_misHerramientas">Mis herramientas</h1>
        <p class="descripcionPrincipal_misHerramientas">Aquí encontrarás las herramientas que hayas probado
          anteriormente</p>

        <!-- Contenedor principal -->
        <div class="contenedorHerramientas_misHerramientas">
          <!-- Imagen de fondo con logo y contenido -->
          <div class="contenedorDegradado_misHerramientas">
            <div class="contenidoDegradado_misHerramientas">
              <!-- Texto y botón solo visibles en desktop -->
              <div class="textoBoton_misHerramientas soloDesktop">
                <p class="textoHerramienta_misHerramientas">
                  App con un diseño intuitivo y adaptable y una interfaz clara
                  y moderna que facilita la navegación en cualquier
                  dispositivo. Su experiencia visual es atractiva y optimizada
                  para un uso cómodo y eficiente.
                </p>
                <a href="../../Proa/loginProa.html" class="botonDemo_misHerramientas">Entrar demo PROA</a>
              </div>

              <!-- Logo centrado -->
              <img class="logoProaDegradado_misHerramientas" src="/PROA/src/css/imagenes/LogosProaBlanco.png"
                alt="Logo PROA">
            </div>
          </div>

          <!-- Texto y botón fuera del fondo para responsive -->
          <div class="contenedorTextoBoton_misHerramientas soloResponsive">
            <p class="textoHerramienta_misHerramientas">
              App con un diseño intuitivo y adaptable y una interfaz clara y moderna que facilita la navegación en
              cualquier
              dispositivo. Su experiencia visual es atractiva y optimizada para un uso cómodo y eficiente.
            </p>
            <a href="../../Proa/loginProa.html" class="botonDemo_misHerramientas">Entrar demo PROA</a>
          </div>
        </div>
      </main>

    </div>
  </div>

  <!-- Footer -->
  <footer class="footer_misHerramientas">
    <div class="footerContainer_misHerramientas">
      <div class="footerCol_misHerramientas">
        <p>Contáctanos: edusync@gti.com</p>
      </div>
      <div class="footerCol_misHerramientas">
        <p>© 2025 - EduSync | Matriz de GTI</p>
      </div>
      <div class="footerCol_misHerramientas">
        <img src="/PROA/src/css/imagenes/GTIBlancosdsds.png" alt="Logo GTI">
      </div>
    </div>
  </footer>

</body>

</html>