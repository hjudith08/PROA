<?php
session_start();
require_once '../includes/conexion.inc';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$conn_proa) {
    die("Error de conexión a la base de datos.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn_proa->prepare("SELECT dni, nombre, apellido1, apellido2, email, password, rol_id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($dni, $nombre, $apellido1, $apellido2, $emailDB, $hash, $rol_id);
        $stmt->fetch();

        // ✅ Comparar la contraseña en texto plano con el hash usando password_verify
        if (password_verify($password, $hash)) {
            session_regenerate_id(true);

            $_SESSION['dni'] = $dni;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido1'] = $apellido1;
            $_SESSION['apellido2'] = $apellido2;
            $_SESSION['email'] = $emailDB;
            $_SESSION['rol'] = $rol_id;

            switch ($rol_id) {
                case 'alumno':
                case 'profesor':
                    header("Location: ../profeAlumno/inicioGeneral.php");
                    break;
                case 'pas':
                    header("Location: ../pas/PasInicio.php");
                    break;
                default:
                    header("Location: ../loginProa.php");
            }
            exit;
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }

    $stmt->close();
    $conn_proa->close();
} else {
    $error = "Acceso no permitido";
}

header("Location: ../proa/loginProa.php?error=" . urlencode($error));
exit;
?>
