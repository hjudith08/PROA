<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync | Venta de Modulos Educativos</title>
    <link rel="icon" href="../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../css/edusyncCSS/estilosBaseEduSync.css">
    <link rel="stylesheet" href="../../css/edusyncCSS/loginEduSync.css">
    <script src="../../js/eduSyncJS/login.js" defer></script>
</head>

<body>
    <div class="contenedor" id="contenedor">
        <!-- Login -->
        <div class="formulario-contenedor login">
            <header class="header header-login">
                <a href="../../" class="logo">
                    <img src="../../imagenes/LogoEduSyncAzul.png" alt="Logotipo">
                </a>
            </header>
            <?php if (isset($_GET['error'])): ?>
                <div class="mensaje error-mensaje"><?= htmlspecialchars($_GET['error']) ?></div>
            <?php endif; ?>
            <form id="login-form" action="procesar-login.php" method="post">
                <h1>Iniciar sesión</h1>
                <p>Por favor introduce tus datos para iniciar sesión</p>
                <div class="inputs grupo-inputs-login">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Introduce tu correo electrónico" required>
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required pattern=".{4,}">
                </div>
                <a href="recuperarContra.php" class="link">¿Has olvidado tu contraseña?</a>
                <button type="submit" class="btn-login">INICIAR SESIÓN</button>
            </form>
            <a href="../../" class="btn-volver"> ← Volver</a>
        </div>

        <!-- Registro -->
        <div class="formulario-contenedor registro">
            <header class="header header-registro">
                <a href="../../" class="logo">
                    <img src="../../imagenes/LogoEduSyncAzul.png" alt="Logotipo">
                </a>
            </header>
            <form id="registro-form" action="registro-usuario.php" method="post">
                <h1>Registro</h1>
                <p>Por favor introduce tus datos </p>
                <div class="inputs grupo-inputs-registro">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required pattern="[^0-9]+" title="No puede contener numeros">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required pattern="[^0-9]+" title="No puede contener numeros">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="ejemplo@ejemplo.com" required>
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="1234567890" required>
                    <label for="password">Contraseña</label>
                    <input type="password" id="passwordRegistro" name="password" placeholder="TuContraseña123" required pattern=".{4,}">
                    <label for="confirmar-password">Repetir Contraseña</label>
                    <input type="password" id="confirmar-password" name="confirmar-password" placeholder="TuContraseña123" required pattern=".{4,}">
                </div>
                <button class="btn-registro">CREAR CUENTA</button>
            </form>
            <a href="../../" class="btn-volver"> ← Volver</a>
        </div>

        <!-- Overlay -->
        <div class="overlay-contenedor">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenido a EduSync!</h1>
                    <p>¿Aún no tienes tu cuenta? ¡Crea una ahora y forma parte de EduSync!</p>
                    <button class="trigger" id="registrarse">CREAR CUENTA</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¡Bienvenido a EduSync!</h1>
                    <p>¿Ya tienes cuenta? ¡Ingresa a tu cuenta para acceder a una variedad de herramientas!</p>
                    <button class="trigger" id="iniciar-sesion">INICIAR SESIÓN</button>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/eduSyncInc/footerEduSync.inc'; ?>
</body>
</html>