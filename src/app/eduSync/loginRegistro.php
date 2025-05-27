<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync | Venta de Modulos Educativos</title>
    <!-- imagen de pestaña -->
    <link rel="icon" href="../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../css/edusyncCSS/estilosBaseEduSync.css">
    <link rel="stylesheet" href="../../css/edusyncCSS/loginEduSync.css">
    <script src="../../js/eduSyncJS/login.js" defer></script>
</head>

<body>
    <!-- contenedor para el general-->
    <div class="contenedor" id="contenedor">
        <!-- contenedor para el formulario de inicio de sesión-->
        <div class="formulario-contenedor login">
            <!-- cabecera del login-->
            <header class="header header-login">
                <a href="../../" class="logo">
                    <img src="../../imagenes/LogoEduSyncAzul.png" alt="Logotipo">
                </a>
                <!-- Boton para ir a la pagina de contacto-->
                <nav>
                    <ul>
                        <input type="button" value="CONTACTO" onclick="location.href='contacto.php'">
                    </ul>
                </nav>
            </header>
            <!-- formulario de inicio de sesión-->
            <form id="login-form" action="index.php" method="get">
                <h1>Iniciar sesión</h1>
                <p>Por favor introduce tus datos para iniciar sesión</p>

                <!-- Grupo de los inputs del formulario del inicio de sesión-->
                <div class="inputs grupo-inputs-login">

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Introduce tu correo electrónico" required>

                    <!-- el pattern segura que la contraseña tenga al menos 4 caracteres, una mayúscula, una minúscula y un número -->
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required
                        pattern=".{4,}">

                </div>

                <!-- link para recuperar la contraseña-->
                <a href="recuperarContra.php" class="link">¿Has olvidado tu contraseña?</a>
                <!-- boton de inicio de sesión-->
                <button type="submit" class="btn-login">INICIAR SESIÓN</button>
            </form>
            <!-- link para volver a la landing-->
            <a href="../../" class="btn-volver"> <-- Volver</a>
        </div>


        <!-- contenedor para el formulario de registro-->
        <div class="formulario-contenedor registro">
            <!-- cabecera del registro-->
            <header class="header header-registro">
                <a href="../../" class="logo">
                    <img src="../../imagenes/LogoEduSyncAzul.png" alt="Logotipo">
                </a>
                <!-- Boton para ir a la pagina de contacto-->
                <nav>
                    <ul>
                        <input type="button" value="CONTACTO" onclick="location.href='contacto.php'">
                    </ul>
                </nav>
            </header>
            <!-- formulario de registro-->
            <form id="registro-form" action="#" method="post">
                <h1>Registro</h1>
                <p>Por favor introduce tus datos </p>
                <!-- Grupo de los inputs del formulario de registro-->
                <div class="inputs grupo-inputs-registro">
        
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required pattern="[^0-9]+"
                        title="No puede contener numeros">

                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required
                        pattern="[^0-9]+" title="No puede contener numeros">

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="ejemplo@ejemplo.com" required>

                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="1234567890" required>

                    <!-- el pattern segura que la contraseña tenga al menos 4 caracteres, una mayúscula, una minúscula y un número -->

                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="TuContraseña123" required
                        pattern=".{4,}">

                    <label for="confirmar-password">Repetir Contraseña</label>
                    <input type="password" id="confirmar-password" name="confirmar-password"
                        placeholder="TuContraseña123" required pattern=".{4,}">
                </div>
                <!-- boton de registro-->
                <button type="submit" class="btn-registro">CREAR CUENTA</button>
            </form>
            <!-- link para volver a la landing-->
            <a href="../../" class="btn-volver"> <-- Volver</a>
        </div>


        <!-- contenedor del overlay donde se elegira ir de un formulario a otro-->
        <div class="overlay-contenedor">
            <div class="overlay">
                <!-- overlay del formulario de inicio de sesión-->
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenido a EduSync!</h1>
                    <p>¿Aún no tienes tu cuenta? ¡Crea una ahora y forma parte de EduSync!</p>
                    <button class="trigger" id="registrarse">CREAR CUENTA</button>
                </div>
                <!-- overlay del formulario de registro-->
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