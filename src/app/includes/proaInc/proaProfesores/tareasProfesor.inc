<?php
include __DIR__ . '/../../conexion.inc';

// Recoger el id_asignatura de la URL y validar
$id_asignatura = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id_asignatura <= 0) {
    die("ID de asignatura no válido.");
}

// Consulta para obtener las tareas de esa asignatura
$stmt = $conn->prepare("SELECT id_tarea, titulo, fecha_apertura, fecha_entrega FROM tareas WHERE id_asignatura = ? ORDER BY fecha_entrega DESC");
$stmt->bind_param("i", $id_asignatura);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="contenedor-tareasProfesor">
    <!-- Aquí empiezan los filtros -->
    <div class="contenedor-botones">
        <button class="boton-revisar-profesor" onclick="window.location.href='../../Proa/profeAlumno/crearTarea.php?id=<?= $id_asignatura ?>'">
            <img class="imgMas" src="../../../../images/pluspurple.png" alt="">
            Nueva Tarea
        </button>
    </div>
    <!-- Aquí terminan los filtros -->

    <table>
        <thead class="encabezado-tabla-tareasProfesor">
            <tr class="fila-tabla-profesorTareas">
                <th class="nombre-tarea-encabezado-vProfesor">Nombre Tarea</th>
                <th class="fecha-apertura-vProfesor">Fecha de apertura</th>
                <th class="fecha-entrega-vProfesor">Fecha de entrega</th>
                <th class="acciones-vProfesor">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="fila">
                    <td class="nombre-tarea-vProfesor"><?= htmlspecialchars($row['titulo']) ?></td>
                    <td class="fecha-apertura-vProfesor"><?= date('d/m/Y', strtotime($row['fecha_apertura'])) ?></td>
                    <td class="fecha-entrega-vProfesor"><?= date('d/m/Y', strtotime($row['fecha_entrega'])) ?></td>
                    <td class="acciones">
                        <button class="boton-revisar-profesor" onclick="window.location.href='editarTarea.php?id=<?= urlencode($id_asignatura) ?>&id_tarea=<?= $row['id_tarea'] ?>'">Editar</button>
                        <button class="boton-revisar-profesor" onclick="window.location.href='verEntregas.php?id=<?= urlencode($id_asignatura) ?>&id_tarea=<?= $row['id_tarea'] ?>'">Ver Entregas</button>
                        <button class="boton-revisar-profesor" onclick="if(confirm('¿Seguro que quieres eliminar esta tarea?')) { window.location.href='eliminarTarea.php?id_tarea=<?= $row['id_tarea'] ?>&id_asignatura=<?= $id_asignatura ?>'; }">Eliminar</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">No hay tareas para esta asignatura.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
