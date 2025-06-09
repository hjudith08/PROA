<?php
include __DIR__ . '/../../conexion.inc';  

if ($id_tarea > 0) {
    $stmt = $conn_proa->prepare("
        SELECT 
            e.id_entrega,
            e.dni_alumno,
            u.nombre,
            u.apellido1,
            u.apellido2,
            e.archivo_entregado,
            e.fecha_entrega,
            e.nota,
            e.comentarios_profesor,
            t.titulo AS titulo_tarea
        FROM entregas e
        JOIN usuarios u ON e.dni_alumno = u.dni
        JOIN tareas t ON e.id_tarea = t.id_tarea
        WHERE e.id_tarea = ?
        ORDER BY u.apellido1, u.apellido2
    ");
    $stmt->bind_param("i", $id_tarea);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = null;
}
?>

<div class="contenedor-filtros">
    <select class="filtros-tareas" id="filtro-tareas">
        <option value="todos">Todas las entregas</option>
        <option value="puntuadas">Entregas puntuadas</option>
        <option value="no-puntuadas">Entregas sin puntuar</option>
    </select>
</div>

<table class="tabla-entregas">
    <thead>
        <tr>
            <th>Nombre del Alumno</th>
            <th>Fecha y Hora de Entrega</th>
            <th>Puntuación</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($result) && $result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nombre'] . ' ' . $row['apellido1'] . ' ' . $row['apellido2']) ?></td>
                    <td><?= htmlspecialchars($row['fecha_entrega']) ?></td>
                    <td>
                        <?= is_null($row['nota']) ? 'Sin puntuar' : number_format($row['nota'], 1) . ' / 10' ?>
                    </td>
                    <td>
                        <button
                            class="boton-revisar"
                            data-id="<?= $row['id_entrega'] ?>"
                            data-titulo="<?= htmlspecialchars($row['titulo_tarea'] ?? 'Tarea') ?>"
                            data-estudiante="<?= htmlspecialchars($row['nombre'] . ' ' . $row['apellido1'] . ' ' . $row['apellido2']) ?>"
                            data-archivo="<?= htmlspecialchars($row['archivo_entregado'] ?? '') ?>"
                            data-nota="<?= is_null($row['nota']) ? '' : $row['nota'] ?>"
                        >
                            Revisar
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay entregas para esta tarea.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- PopUp Revisar -->
<div id="popup" class="modal oculto">
    <div class="popup-contenido">
        <button class="cerrar" onclick="cerrarPopup()">×</button>

        <div class="popup-fila-titulo">
            <span class="titulo">Título:</span>
            <span class="descripcion" id="popup-titulo"></span>
        </div>

        <div class="popup-fila-titulo">
            <span class="titulo">Estudiante:</span>
            <span class="descripcion" id="popup-estudiante"></span>
        </div>

        <div class="popup-fila-adj">
            <span class="titulo">Adjunto:</span>
            <span id="popup-archivo"></span>
            <button class="boton-descargar" id="boton-descargar">DESCARGAR</button>
        </div>

        <div class="popup-fila nota">
            <input type="number" class="input-nota" id="nota" placeholder="-" min="0" max="10" step="0.1">
            <span class="sobre-diez">/10</span>
            <button class="puntuar-boton">PUNTUAR</button>
        </div>
        <input type="hidden" id="entrega-id" value="">
		<div id="mensaje-toast" class="toast oculto">Nota guardada correctamente.</div>
    </div>
</div>
