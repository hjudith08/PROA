<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> PROA | Inicio de Sesión</title>
    <link rel="icon" href="../../imagenes/LogosProaBlancoV3.png" type="image/png" />
    <link rel="stylesheet" href="../../css/proaCSS/estilosBaseProa.css" />
    <link rel="stylesheet" href="../../css/proaCSS/loginProa.css" />

</head>
<body>

<?php include '../includes/proaInc/menuProa.inc'; ?>

<div class="contenido">
    <div class="panel">
        <img src="../../imagenes/LogosProaBlanco.png" alt="" />
        <div class="textos">
            <h1>INICIO DE SESIÓN</h1>
            <p>Por favor introduce tus datos para iniciar sesión</p>
        </div>
        <form id="login" action="procesar-loginProa.php" method="POST" novalidate>
            <label for="email">Correo</label>
            <input id="email" type="email" name="email" required placeholder="Escribe tu correo" />
            <label for="password">Contraseña</label>
            <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="Escribe tu contraseña"
                    pattern=".{4,}"
            />
            <input id="iniciar-sesion" type="submit" value="INICIAR SESIÓN" />
        </form>
    </div>
</div>
<script defer src="../../js/proaJS/loginProa.js"></script>
<?php include '../includes/proaInc/footerProa.inc'; ?>
</body>
</html>