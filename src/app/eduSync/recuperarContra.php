<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync | Recuperar Contraseña</title>
    <link rel="icon" href="../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../css/edusyncCSS/recuperarContra.css">
</head>
<body>
    <div class="fondo-recuperacion">
        <header class="encabezado-recuperacion">
            <a class="logo-header" href="../../"><img src="../../imagenes/LogoEduSyncAzul.png" alt="Logotipo"></a>
                <img src="../../imagenes/LogoEduSyncAzul.png" alt="Logo EduSync" class="logo">
            </a>
        </header>

        <main class="contenido-principal">
            <div class="tarjeta-recuperacion">
                <h1>Recuperar contraseña</h1>
                <h2>Ingresa tu correo electrónico para recibir instrucciones</h2>
                
                <form id="formularioRecuperacion" class="formulario-recuperacion">
                    <div class="grupo-formulario">
                        <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required>
                    </div>
                    
                    <button type="submit" class="boton-recuperacion">Enviar instrucciones</button>
                </form>
            </div>
        </main>

        <footer class="pie-recuperacion">
            <a href="loginRegistro.php" class="boton-volver">← Volver al inicio de sesión</a>
        </footer>
    </div>

    <script src="../../js/eduSyncJS/recuperarContra.js"></script>
</body>
</html>