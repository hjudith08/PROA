<?php
session_start();
session_unset();
session_destroy();
session_start();

require_once '../includes/conexion.inc'; // Ajusta ruta según tu estructura

// Recoger parámetros
$rol = $_GET['rol'] ?? '';
$usuario = $_GET['usuario'] ?? '';

// Validar rol (según los roles válidos que manejas)
$roles_validos = ['alumno', 'profesor', 'pas'];
if (!in_array($rol, $roles_validos)) {
    die("Rol inválido.");
}

// Definir la conexión correcta según dónde esté la tabla usuarios
// Ajusta aquí según dónde esté la tabla usuarios: en $conn_proa o en $conn_edusync
// Supongo que está en PROA
$conn = $conn_proa; 

// Preparar consulta según si usuario es enviado o no
if ($usuario) {
    // Buscamos usuario exacto con rol
    $sql = "SELECT dni, nombre, apellido1, apellido2, email, rol_id FROM usuarios WHERE dni = ? AND rol_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("ss", $usuario, $rol);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuarioDatos = $resultado->fetch_assoc();

    if (!$usuarioDatos) {
        die("No se encontró el usuario con DNI $usuario y rol $rol.");
    }
} else {
    // Seleccionar usuario aleatorio del rol
    $sql = "SELECT dni, nombre, apellido1, apellido2, email, rol_id FROM usuarios WHERE rol_id = ? ORDER BY RAND() LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $rol);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuarioDatos = $resultado->fetch_assoc();

    if (!$usuarioDatos) {
        die("No se encontró ningún usuario con el rol: $rol");
    }
}

// Guardar datos en sesión
$_SESSION['dni'] = $usuarioDatos['dni'];
$_SESSION['nombre'] = $usuarioDatos['nombre'];
$_SESSION['apellido1'] = $usuarioDatos['apellido1'];
$_SESSION['apellido2'] = $usuarioDatos['apellido2'];
$_SESSION['email'] = $usuarioDatos['email'];
$_SESSION['rol'] = $usuarioDatos['rol_id'];

// Redirigir según rol
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
