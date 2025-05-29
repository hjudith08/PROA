<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduSync | Mis herramientas</title>
  <link rel="icon" href="../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
  <link rel="stylesheet" href="../../css/edusyncCSS/estilosBaseEduSync.css">
  <link rel="stylesheet" href="../../css/edusyncCSS/misHerramientasEduSync.css">
  <script src="../../js/eduSyncJS/funcionesBaseEduSync.js" defer></script>
  <script src="../../js/eduSyncJS/misHerramientas.js"></script>
</head>

<body>
  <?php include '../includes/eduSyncInc/menuEduSync.inc'; ?>

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
                <a href="../proa/loginProa.php" class="botonDemo_misHerramientas">Entrar demo PROA</a>
              </div>

              <!-- Logo centrado -->
              <img class="logoProaDegradado_misHerramientas" src="../../imagenes/LogosProaBlanco.png"
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
            <a href="../proa/loginProa.php" class="botonDemo_misHerramientas">Entrar demo PROA</a>
          </div>
        </div>
      </main>

    </div>
  </div>


  <!-- Footer -->
    <?php include '../includes/eduSyncInc/footerEduSync.inc'; ?>

</body>

</html>