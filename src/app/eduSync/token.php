<?php
$tipo = $_GET['tipo'] ?? 'desconocido';

switch ($tipo) {
    case 'exito':
        $titulo = "¡Éxito!";
        $mensaje = "Tu cuenta ha sido activada correctamente.";
        $clase = "exito";
        break;
    case 'expirado':
        $titulo = "Token expirado";
        $mensaje = "El token ha expirado. Por favor, solicita un nuevo registro.";
        $clase = "error";
        break;
    case 'invalido':
        $titulo = "Token inválido";
        $mensaje = "El token no es válido o ya fue utilizado.";
        $clase = "error";
        break;
    case 'sin_token':
        $titulo = "Error";
        $mensaje = "No se proporcionó un token.";
        $clase = "error";
        break;
    case 'registro_enviado':
        $email = $_GET['email'] ?? '';
        $titulo = "Registro en proceso";
        $mensaje = "Se ha enviado un correo de confirmación a <b>" . htmlspecialchars($email) . "</b>. Revisa tu bandeja de entrada.<br><br>"
            . '<a href="https://ethereal.email/" target="_blank">Ir a Ethereal.email</a>';
        $clase = "info";
        break;
    default:
        $titulo = "Mensaje";
        $mensaje = "Ha ocurrido un error inesperado.";
        $clase = "error";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titulo) ?></title>
    <link rel="icon" href="../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../css/edusyncCSS/estilosToken.css">
</head>
<body class="fondo-recuperacion">
    <div class="encabezado-recuperacion">
        <img src="../../imagenes/LogoEduSyncAzul.png" alt="Logotipo">
    </div>
    
    <div class="contenido-principal">
        <div class="mensaje <?= htmlspecialchars($clase) ?>">
            <h1><?= htmlspecialchars($titulo) ?></h1>
            <p><?= $mensaje ?></p>
        </div>
    </div>
    
    <div class="pie-recuperacion">
    </div>
</body>
</html>