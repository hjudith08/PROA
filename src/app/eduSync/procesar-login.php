<?php
session_start();
require_once '../includes/conexion.inc';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn_edusync->prepare("SELECT id, nombre, apellidos, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $nombre, $apellidos, $hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nombre'] = $nombre;
            $_SESSION['usuario_apellidos'] = $apellidos;
            $_SESSION['usuario_email'] = $email;
            header("Location: ../../index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
    $stmt->close();
    $conn_edusync->close();
} else {
    $error = "Acceso no permitido";
}
header("Location: loginRegistro.php?error=" . urlencode($error));
exit;
?>