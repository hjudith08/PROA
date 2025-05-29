<?php
session_start();
session_unset();
session_destroy();
session_start();

require_once '../includes/conexion.inc'; // Asegúrate que este archivo contiene $conn

$rol = $_GET['rol'] ?? '';

if (!in_array($rol, ['alumno', 'profesor', 'pas'])) {
    die("Rol inválido.");
}

// Buscar usuario aleatorio con ese rol
$sql = "SELECT dni, nombre, apellido1, apellido2, email, rol_id FROM usuarios WHERE rol_id = ? ORDER BY RAND() LIMIT 1";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("s", $rol);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if ($usuario) {
    $_SESSION['dni'] = $usuario['dni'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['apellido1'] = $usuario['apellido1'];
    $_SESSION['apellido2'] = $usuario['apellido2'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['rol'] = $usuario['rol_id']; // Guardar el rol para uso posterior
} else {
    die("No se encontró ningún usuario con el rol: $rol");
}

// Redirigir según el rol
switch ($rol) {
    case 'alumno':
    case 'profesor':
        header("Location: profeAlumno/inicioGeneral.php");
        break;
    case 'pas':
        header("Location: pas/PasInicio.php");
        break;
    default:
        header("Location: loginProa.php");
        break;
}
exit;
?>
