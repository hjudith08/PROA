<?php
require_once 'app/includes/conexion.inc';

if (!isset($conn_edusync)) {
    die("Error de conexión");
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conn_edusync->prepare("SELECT id, validez_token FROM usuarios WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $validez_token);
        $stmt->fetch();

        if (strtotime($validez_token) >= time()) {
            $update = $conn_edusync->prepare("UPDATE usuarios SET estado = 1, token = NULL, validez_token = NULL WHERE id = ?");
            $update->bind_param("i", $id);
            $update->execute();
            $update->close();

            header("Location: app/eduSync/mensaje.php?tipo=exito");
            exit;
        } else {
            header("Location: app/eduSync/mensaje.php?tipo=expirado");
            exit;
        }
    } else {
        header("Location: app/eduSync/mensaje.php?tipo=invalido");
        exit;
    }

    $stmt->close();
} else {
    header("Location: app/eduSync/mensaje.php?tipo=sin_token");
    exit;
}

$conn_edusync->close();
?>
