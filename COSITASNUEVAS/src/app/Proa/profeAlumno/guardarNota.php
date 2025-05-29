<?php
include __DIR__ . '/../../includes/conexion.inc';


header('Content-Type: application/json');

// Comprobar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$id_entrega = $_POST['id_entrega'] ?? null;
$nota = $_POST['nota'] ?? null;

if (!$id_entrega || !is_numeric($nota) || $nota < 0 || $nota > 10) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    exit;
}

// Preparar y ejecutar la actualización
$stmt = $conn->prepare("UPDATE entregas SET nota = ? WHERE id_entrega = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la consulta']);
    exit;
}

$stmt->bind_param('di', $nota, $id_entrega);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar en la base de datos']);
}