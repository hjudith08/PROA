<?php
session_start();
require_once '../includes/conexion.inc';

header('Content-Type: application/json');

if (!$conn_proa) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión a la base de datos.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn_proa->prepare("SELECT dni, nombre, apellido1, apellido2, email, password, rol_id FROM usuarios WHERE email = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Error en la consulta']);
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($dni, $nombre, $apellido1, $apellido2, $emailDB, $hash, $rol_id);
        $stmt->fetch();

        // Validación usando SHA-256
        if (hash('sha256', $password) === $hash) {
            session_regenerate_id(true);

            $_SESSION['dni'] = $dni;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido1'] = $apellido1;
            $_SESSION['apellido2'] = $apellido2;
            $_SESSION['email'] = $emailDB;
            $_SESSION['rol'] = $rol_id;

            $redirect = '';
            switch ($rol_id) {
                case 'alumno':
                case 'profesor':
                    $redirect = '../Proa/profeAlumno/inicioGeneral.php';
                    break;
                case 'pas':
                    $redirect = '../Proa/pas/PasInicio.php';
                    break;
                default:
                    $redirect = '../Proa/loginProa.php';
            }

            echo json_encode(['success' => true, 'redirect' => $redirect]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Contraseña incorrecta']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
    }

    $stmt->close();
    $conn_proa->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Acceso no permitido']);
}
