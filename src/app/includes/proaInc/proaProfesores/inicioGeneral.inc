<?php
include __DIR__ . '/../../conexion.inc';  

$asignaturas = [];
// Ahora seleccionamos también id_asignatura
$result_asignaturas = $conn_proa->query("SELECT id_asignatura, nombre, codigo FROM asignaturas ORDER BY codigo DESC LIMIT 5");
if ($result_asignaturas) {
    while ($fila = $result_asignaturas->fetch_assoc()) {
        $asignaturas[] = $fila;
    }
} else {
    echo "Error en asignaturas: " . $conn_proa->error;
}

// Obtener tareas con JOIN correcto
$tareas = [];
$result_tareas = $conn_proa->query("SELECT t.fecha_entrega, t.descripcion, a.nombre AS nombre_asignatura, a.codigo
FROM tareas t
JOIN asignaturas a ON t.id_asignatura = a.id_asignatura
ORDER BY t.fecha_entrega ASC
");

if ($result_tareas) {
    while ($fila = $result_tareas->fetch_assoc()) {
        $tareas[] = $fila;
    }
} else {
    echo "Error en tareas: " . $conn_proa->error;
}
?>

<main class="content">
    <!-- Sección de Asignaturas Recientes -->
    <section class="bloque-info">
        <div class="cabecera-tareas">
            <h1>ASIGNATURAS RECIENTES VISITADAS</h1>
        </div>
        <div class="tabla-flex-container inicioGenAsig">
            <ul class="asignaturas">
                <?php foreach ($asignaturas as $asignatura): ?>
                    <li>
                        <a href="inicioAsignatura.php?id=<?= urlencode($asignatura['id_asignatura']) ?>">
                            <span class="nombre-asignatura"><?= htmlspecialchars($asignatura['nombre']) ?></span>
                            <span class="codigo-asignatura"><?= htmlspecialchars($asignatura['codigo']) ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- Sección de Tareas por Realizar -->
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
                    <tr>
                        <td><?= date('d M', strtotime($tarea['fecha_entrega'])) ?></td>
                        <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                        <td>
                            <a class="asignatura-link" href="tarea.php?codigo=<?= urlencode($tarea['codigo']) ?>">
                                <?= htmlspecialchars($tarea['nombre_asignatura']) ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
?>