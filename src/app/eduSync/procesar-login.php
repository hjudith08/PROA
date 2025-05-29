<?php
session_start();
require_once '../includes/eduSyncInc/MySQL.inc';

// Mostrar errores para depuración (puedes quitar esto en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Buscar usuario por email
    $stmt = $conn->prepare("SELECT id, nombre, apellidos, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $nombre, $apellidos, $hash);
        $stmt->fetch();

        // Comprobar contraseña (SHA2 en registro)
        if (hash('sha256', $password) === $hash) {
            // Guardar datos en la sesión
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nombre'] = $nombre;
            $_SESSION['usuario_apellidos'] = $apellidos;
            $_SESSION['usuario_email'] = $email;

            // Redirigir a la página principal (ajusta si tienes otra)
            header("Location: /PROA/src/index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
    $stmt->close();
    $conn->close();
} else {
    $error = "Acceso no permitido";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error de inicio de sesión</title>
    <link rel="stylesheet" href="../../css/edusyncCSS/loginEduSync.css">
</head>
<body>
    <div class="contenedor" style="text-align:center; margin-top:50px;">
        <h2>Inicio de sesión fallido</h2>
        <p><?= htmlspecialchars($error ?? 'Error desconocido') ?></p>
        <a href="loginRegistro.php" class="btn-volver">Volver al login</a>
    </div>
</body>
</html>