<?php
include __DIR__ . '/../../conexion.inc';

$dni_alumno    = $_SESSION['dni'] ?? '';

$id_tarea = isset($_GET['id_tarea']) ? intval($_GET['id_tarea']) : 0;
if ($id_tarea <= 0) {
    die("Error: ID de tarea no válido");
}

// Obtener información de la tarea
$sqlTarea = "SELECT 
                t.id_tarea, t.titulo, t.descripcion, 
                t.fecha_apertura, t.fecha_entrega, 
                t.puntuacion_maxima, t.archivo_adjunto,
                a.nombre AS nombre_asignatura, a.id_asignatura,
                t.grupo_id
            FROM tareas t
            JOIN asignaturas a ON t.id_asignatura = a.id_asignatura
            WHERE t.id_tarea = ?";

$stmtTarea = $conn_proa->prepare($sqlTarea);
$stmtTarea->bind_param("i", $id_tarea);
$stmtTarea->execute();
$resultTarea = $stmtTarea->get_result();

if ($resultTarea->num_rows === 0) {
    die("Error: Tarea no encontrada");
}

$tarea = $resultTarea->fetch_assoc();

// Obtener grupo del alumno
$sqlGrupo = "SELECT grupo_id FROM usuarios WHERE dni = ?";
$stmtGrupo = $conn_proa->prepare($sqlGrupo);
$stmtGrupo->bind_param("s", $dni_alumno);
$stmtGrupo->execute();
$grupo = $stmtGrupo->get_result()->fetch_assoc();
$grupo_id = $grupo['grupo_id'] ?? null;

// Verificar que el alumno está matriculado en la asignatura
$sqlMatricula = "SELECT 1 FROM alumnos_asignaturas 
                 WHERE dni_alumno = ? AND id_asignatura = ?";
$stmtMatricula = $conn_proa->prepare($sqlMatricula);
$stmtMatricula->bind_param("si", $dni_alumno, $tarea['id_asignatura']);
$stmtMatricula->execute();
$matriculado = $stmtMatricula->get_result()->num_rows > 0;

if (!$matriculado) {
    die("Error: No estás matriculado en esta asignatura");
}

// Obtener entrega del alumno
$sqlEntrega = "SELECT 
                archivo_entregado, fecha_entrega, nota, comentarios_profesor
               FROM entregas 
               WHERE id_tarea = ? AND dni_alumno = ?";
$stmtEntrega = $conn_proa->prepare($sqlEntrega);
$stmtEntrega->bind_param("is", $id_tarea, $dni_alumno);
$stmtEntrega->execute();
$entrega = $stmtEntrega->get_result()->fetch_assoc();

// Verificar si ya venció el plazo
$fecha_actual = new DateTime();
$fecha_limite = new DateTime($tarea['fecha_entrega']);
$plazo_vencido = $fecha_actual > $fecha_limite;
?>

<div class="contenido-informacionTarea">
    <div class="div-verTarea">
        <div><p class="titulo">Asignatura:</p><p class="informacion"><?= htmlspecialchars($tarea['nombre_asignatura']) ?></p></div>
        <div><p class="titulo">Título:</p><p class="informacion"><?= htmlspecialchars($tarea['titulo']) ?></p></div>
        <div><p class="titulo">Fecha de apertura:</p><p class="informacion"><?= date('d/m/Y', strtotime($tarea['fecha_apertura'])) ?></p></div>
        <div><p class="titulo">Fecha de entrega:</p><p class="informacion"><?= date('d/m/Y', strtotime($tarea['fecha_entrega'])) ?></p></div>

        <div>
            <p class="titulo">Calificación:</p>
            <p class="informacion">
                <?php if ($entrega): ?>
                    <?= isset($entrega['nota']) ? htmlspecialchars($entrega['nota']) . '/' . htmlspecialchars($tarea['puntuacion_maxima']) : 'Pendiente de corrección' ?>
                <?php else: ?>
                    Sin entregar
                <?php endif; ?>
            </p>
        </div>

        <?php if (!empty($entrega['comentarios_profesor'])): ?>
            <div>
                <p class="titulo">Comentarios del profesor:</p>
                <p class="informacion"><?= htmlspecialchars($entrega['comentarios_profesor']) ?></p>
            </div>
        <?php endif; ?>

        <div class="descripcion-tarea">
            <p class="titulo">Descripción de la tarea:</p>
            <textarea id="descripcionTarea" class="informacion" readonly><?= htmlspecialchars($tarea['descripcion']) ?></textarea>
        </div>

        <?php if (!empty($tarea['archivo_adjunto'])): ?>
            <div>
                <p class="titulo">Archivo adjunto:</p>
                <p class="informacion">
                    <a href="/uploads/<?= htmlspecialchars($tarea['archivo_adjunto']) ?>" target="_blank">
                        <?= htmlspecialchars(basename($tarea['archivo_adjunto'])) ?>
                    </a>
                </p>
            </div>
        <?php endif; ?>

        <?php if (!empty($entrega['archivo_entregado'])): ?>
            <div>
                <p class="titulo">Archivo entregado:</p>
                <p class="informacion">
                    <a href="../../../../docs/uploads/<?= htmlspecialchars($entrega['archivo_entregado']) ?>" target="_blank">
                        <?= htmlspecialchars(basename($entrega['archivo_entregado'])) ?>
                    </a>
                </p>
            </div>
            <div>
                <p class="titulo">Entregado el:</p>
                <p class="informacion"><?= date('d/m/Y H:i', strtotime($entrega['fecha_entrega'])) ?></p>
            </div>
        <?php elseif (!$plazo_vencido): ?>
            <!-- Formulario para entregar archivo solo si NO se venció el plazo -->
            <form action="../../includes/subir.php" method="post" enctype="multipart/form-data">
                <label class="form-label titulo" for="taskFile">Adjuntar archivos:</label>
                <input type="file" name="archivo" required>
                <input type="hidden" name="dni_alumno" value="<?= htmlspecialchars($dni_alumno) ?>">
                <input type="hidden" name="id_tarea" value="<?= htmlspecialchars($id_tarea) ?>">
                <input type="hidden" name="grupo_id" value="<?= htmlspecialchars($grupo_id) ?>">
                <br><br>
                <input class="boton-revisar boton-centro" type="submit" name="submit" value="ENTREGAR">
            </form>
        <?php else: ?>
            <div>
                <p class="titulo">Entrega deshabilitada:</p>
                <p class="informacion" style="color: red;">La fecha límite para entregar esta tarea ya ha pasado (<?= date('d/m/Y', strtotime($tarea['fecha_entrega'])) ?>).</p>
            </div>
        <?php endif; ?>
    </div>
</div>
