<?php
include __DIR__ . '/../../conexion.inc';

$dni_usuario = $_SESSION['dni'];
$grupo_id = $_SESSION['grupo_id'] ?? 'G1';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_asignatura_visitada = intval($_GET['id']);
    if ($id_asignatura_visitada > 0 && !empty($dni_usuario)) {
        $sql_visita = "
            INSERT INTO historial_visitas (dni_usuario, id_asignatura, fecha_visita, grupo_id)
            VALUES (?, ?, NOW(), ?)
            ON DUPLICATE KEY UPDATE fecha_visita = NOW()
        ";
        $stmt_visita = $conn_proa->prepare($sql_visita);
        $stmt_visita->bind_param("sis", $dni_usuario, $id_asignatura_visitada, $grupo_id);
        $stmt_visita->execute();
    }
}

$asignaturas = [];
$stmt_asignaturas = $conn_proa->prepare("
    SELECT a.id_asignatura, a.nombre, a.codigo
    FROM historial_visitas h
    JOIN asignaturas a ON h.id_asignatura = a.id_asignatura
    WHERE h.dni_usuario = ?
    ORDER BY h.fecha_visita DESC
    LIMIT 4
");
$stmt_asignaturas->bind_param("s", $dni_usuario);
$stmt_asignaturas->execute();
$result_asignaturas = $stmt_asignaturas->get_result();

while ($fila = $result_asignaturas->fetch_assoc()) {
    $asignaturas[] = $fila;
}

if (count($asignaturas) === 0) {
    $result_asignaturas_alt = $conn_proa->query("
        SELECT id_asignatura, nombre, codigo
        FROM asignaturas
        ORDER BY nombre ASC
        LIMIT 4
    ");
    if ($result_asignaturas_alt) {
        while ($fila = $result_asignaturas_alt->fetch_assoc()) {
            $asignaturas[] = $fila;
        }
    }
}

$tareas = [];
$result_tareas = $conn_proa->query("
    SELECT t.id_tarea, t.fecha_entrega, t.descripcion, a.nombre AS nombre_asignatura
    FROM tareas t
    JOIN asignaturas a ON t.id_asignatura = a.id_asignatura
    ORDER BY t.fecha_entrega ASC
    LIMIT 5
");

if ($result_tareas) {
    while ($fila = $result_tareas->fetch_assoc()) {
        $tareas[] = $fila;
    }
}
?>

<main class="content">
    <section class="bloque-info">
        <div class="cabecera-tareas">
            <h1>ASIGNATURAS RECIENTES VISITADAS</h1>
        </div>
        <div class="tabla-flex-container inicioGenAsig">
            <ul class="asignaturas">
                <?php foreach ($asignaturas as $asignatura): ?>
                    <li onclick="location.href='inicioAsignatura.php?id=<?= urlencode($asignatura['id_asignatura']) ?>'">
                        <span class="nombre-asignatura"><?= htmlspecialchars($asignatura['nombre']) ?></span>
                        <span class="codigo-asignatura"><?= htmlspecialchars($asignatura['codigo']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="bloque-info">
        <div class="cabecera-tareas">
            <h1>TAREAS POR REALIZAR</h1>
        </div>
        <div class="tabla-container">
            <table class="tabla-asignaturas">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Asignatura</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tareas as $tarea): ?>
                    <tr onclick="window.location='verTarea.php?id_tarea=<?= urlencode($tarea['id_tarea']) ?>&dni=<?= urlencode($dni_usuario) ?>'">
                        <td><?= date('d M', strtotime($tarea['fecha_entrega'])) ?></td>
                        <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                        <td><?= htmlspecialchars($tarea['nombre_asignatura']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
