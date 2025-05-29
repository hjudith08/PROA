<?php

session_start();
require_once '../includes/conexion.inc';

// Mostrar errores para depuración (puedes quitar esto en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Buscar usuario por email
    $stmt = $connProa->prepare("SELECT dni, nombre, apellido1, apellido2, password, rol_id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($dni, $nombre, $apellido1, $apellido2, $hash, $rol_id);
        $stmt->fetch();

        // Comprobar contraseña (SHA2 en registro)
        if (hash('sha256', $password) === $hash) {
            // Guardar datos en la sesión
            $_SESSION['proa_dni'] = $dni;
            $_SESSION['proa_nombre'] = $nombre;
            $_SESSION['proa_apellido1'] = $apellido1;
            $_SESSION['proa_apellido2'] = $apellido2;
            $_SESSION['proa_email'] = $email;
            $_SESSION['proa_rol'] = $rol_id;

            // Redirigir según el rol
            switch ($rol_id) {
                case 'alumno':
                    header("Location: profeAlumno/inicioGeneral.php");
                    break;
                case 'profesor':
                    header("Location: profesores/inicioGeneral.php");
                    break;
                case 'pas':
                    header("Location: pas/PasInicio.php");
                    break;
                default:
                    header("Location: index.php");
            }
            exit;
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
    $stmt->close();
    $connProa->close();
} else {
    $error = "Acceso no permitido";
}

// Si hay error, vuelve al login con mensaje
header("Location: LoginProa.php?error=" . urlencode($error));
exit;
?>