<?php
require './bd/conexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$response = ['profesores' => [], 'alumnos' => []];

if ($id > 0) {
    // Profesores
    $sql_prof = "SELECT u.dni, CONCAT(u.nombre, ' ', u.apellido1, ' ', u.apellido2) AS nombre, u.email
                 FROM profesores_asignaturas pa
                 JOIN usuarios u ON u.dni = pa.dni_profesor
                 WHERE pa.id_asignatura = ?";
    $stmt_prof = $conn->prepare($sql_prof);
    $stmt_prof->bind_param("i", $id);
    $stmt_prof->execute();
    $res_prof = $stmt_prof->get_result();
    while ($row = $res_prof->fetch_assoc()) {
        $response['profesores'][] = $row;
    }

    // Alumnos
    $sql_alum = "SELECT u.dni, CONCAT(u.nombre, ' ', u.apellido1, ' ', u.apellido2) AS nombre, u.email
                 FROM alumnos_asignaturas aa
                 JOIN usuarios u ON u.dni = aa.dni_alumno
                 WHERE aa.id_asignatura = ?";
    $stmt_alum = $conn->prepare($sql_alum);
    $stmt_alum->bind_param("i", $id);
    $stmt_alum->execute();
    $res_alum = $stmt_alum->get_result();
    while ($row = $res_alum->fetch_assoc()) {
        $response['alumnos'][] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
