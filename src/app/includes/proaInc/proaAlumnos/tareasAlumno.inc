<?php
include __DIR__ . '/../../conexion.inc';

// Recoger datos desde la URL
$id_asignatura = isset($_GET['id']) ? intval($_GET['id']) : 0;
$dni_alumno = '1100112';

if ($id_asignatura <= 0 || empty($dni_alumno)) {
    die("Datos inválidos.");
}

// Consulta para obtener las tareas y las entregas del alumno
$stmt = $conn_proa->prepare("
    SELECT 
        t.id_tarea,
        t.titulo,
        t.fecha_apertura,
        t.fecha_entrega,
        e.nota,
        e.fecha_entrega AS fecha_entregada
    FROM tareas t
    LEFT JOIN entregas e ON t.id_tarea = e.id_tarea AND e.dni_alumno = ?
    WHERE t.id_asignatura = ?
    ORDER BY t.fecha_entrega DESC
");

$stmt->bind_param("si", $dni_alumno, $id_asignatura);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<div class="contenedor-tareasAlumno">
    <!-- Filtros -->
    <div class="contenedor-filtros">
        <select id="filtro-tareas-estado">
            <option value="todas">Todas las tareas</option>
            <option value="completado">Tareas completadas</option>
            <option value="pendiente">Tareas pendientes</option>
        </select>
    </div>

    <!-- Tabla de tareas -->
    <table>
        <thead class="encabezado-tabla-tareasAlumno">
            <tr class="fila">
                <th class="nombre-tarea-encabezado">Nombre Tarea</th>
                <th class="estado-tarea">Estado</th>
                <th class="fecha-apertura">Fecha de apertura</th>
                <th class="fecha-entrega">Fecha de entrega</th>
                <th class="calificacion-encabezado">Calificación</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado->num_rows > 0): ?>
                <?php while ($row = $resultado->fetch_assoc()): 
                    $estado = $row['fecha_entregada'] ? "Completada" : "Pendiente";
                    $nota = is_null($row['nota']) ? "-" : $row['nota'];
                ?>
                <tr class="fila" data-estado="<?= strtolower($estado) ?>" data-id="<?= $row['id_tarea'] ?>">
                    <td class="nombre-tarea"><?= htmlspecialchars($row['titulo']) ?></td>
                    <td class="estado-tarea"><?= $estado ?></td>
                    <td class="fecha-apertura"><?= date('d/m/Y', strtotime($row['fecha_apertura'])) ?></td>
                    <td class="fecha-entrega"><?= date('d/m/Y', strtotime($row['fecha_entrega'])) ?></td>
                    <td class="calificacion"><?= $nota ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No hay tareas disponibles.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
// JS para filtro de tareas
document.getElementById('filtro-tareas-estado').addEventListener('change', function () {
    const estadoSeleccionado = this.value;
    const filas = document.querySelectorAll('tbody .fila');

    filas.forEach(fila => {
        const estado = fila.getAttribute('data-estado');
        if (estadoSeleccionado === 'todas' || estado === estadoSeleccionado) {
            fila.style.display = '';
        } else {
            fila.style.display = 'none';
        }
    });
});

// click en la fila y redirigir
document.querySelectorAll('tbody .fila').forEach(fila => {
    fila.style.cursor = 'pointer';  // para que se note que es clicable
    fila.addEventListener('click', () => {
        const idTarea = fila.getAttribute('data-id');
        if (idTarea) {
            // Redirigir a verTarea.php con el id_tarea como parámetro GET
            window.location.href = `verTarea.php?id_tarea=${idTarea}&dni=<?= urlencode($dni_alumno) ?>`;
        }
    });
});

</script>