<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync | Recuperar Contraseña</title>
    <link rel="icon" href="/PROA/src/css/imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="/PROA/src/css/Edusync/recuperarContraseña.css">
</head>
<body>
    <div class="fondo-recuperacion">
        <header class="encabezado-recuperacion">
            <a href="index.html">
                <img src="/PROA/src/css/imagenes/LogoEduSyncAzul.png" alt="Logo EduSync" class="logo">
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
            <a href="login.html" class="boton-volver">← Volver al inicio de sesión</a>
        </footer>
    </div>

    <script src="/PROA/src/js/recuperarContrasena.js"></script>
</body>
</html>