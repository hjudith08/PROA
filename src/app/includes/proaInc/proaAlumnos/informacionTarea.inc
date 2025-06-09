<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../../conexion.inc';

$dni_alumno = $_SESSION['dni'] ?? '';

$id_tarea = isset($_GET['id_tarea']) ? intval($_GET['id_tarea']) : 0;
if ($id_tarea <= 0) {
    die("Error: ID de tarea no válido.");
}

if (empty($dni_alumno)) {
    die("Error: Usuario no autenticado.");
}

// Obtener información de la tarea y asignatura
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
if (!$stmtTarea) die("Error en la consulta: " . $conn_proa->error);

$stmtTarea->bind_param("i", $id_tarea);
$stmtTarea->execute();
$resultTarea = $stmtTarea->get_result();

if ($resultTarea->num_rows === 0) die("Error: Tarea no encontrada.");

$tarea = $resultTarea->fetch_assoc();
$GLOBALS['titulo_tarea'] = $tarea['titulo'];

// Obtener grupo del alumno
$sqlGrupo = "SELECT grupo_id FROM usuarios WHERE dni = ?";
$stmtGrupo = $conn_proa->prepare($sqlGrupo);
if (!$stmtGrupo) die("Error en la consulta: " . $conn_proa->error);

$stmtGrupo->bind_param("s", $dni_alumno);
$stmtGrupo->execute();
$resultGrupo = $stmtGrupo->get_result();
$grupo = $resultGrupo->fetch_assoc();
$grupo_id = $grupo['grupo_id'] ?? null;

// Verificar matrícula
$sqlMatricula = "SELECT 1 FROM alumnos_asignaturas WHERE dni_alumno = ? AND id_asignatura = ?";
$stmtMatricula = $conn_proa->prepare($sqlMatricula);
if (!$stmtMatricula) die("Error en la consulta: " . $conn_proa->error);

$stmtMatricula->bind_param("si", $dni_alumno, $tarea['id_asignatura']);
$stmtMatricula->execute();
$resultMatricula = $stmtMatricula->get_result();

if ($resultMatricula->num_rows === 0) die("Error: No estás matriculado en esta asignatura.");

// Obtener entrega
$sqlEntrega = "SELECT archivo_entregado, fecha_entrega, nota, comentarios_profesor
               FROM entregas
               WHERE id_tarea = ? AND dni_alumno = ?";
$stmtEntrega = $conn_proa->prepare($sqlEntrega);
if (!$stmtEntrega) die("Error en la consulta: " . $conn_proa->error);

$stmtEntrega->bind_param("is", $id_tarea, $dni_alumno);
$stmtEntrega->execute();
$resultEntrega = $stmtEntrega->get_result();
$entrega = $resultEntrega->fetch_assoc();

// Comprobar fecha límite
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
                    <?= isset($entrega['nota']) && $entrega['nota'] !== null ? htmlspecialchars($entrega['nota']) . ' / ' . htmlspecialchars($tarea['puntuacion_maxima']) : 'Pendiente de corrección' ?>
                <?php else: ?>
                    Sin entregar
                <?php endif; ?>
            </p>
        </div>

        <?php if (!empty($entrega['comentarios_profesor'])): ?>
            <div>
                <p class="titulo">Comentarios del profesor:</p>
                <p class="informacion"><?= nl2br(htmlspecialchars($entrega['comentarios_profesor'])) ?></p>
            </div>
        <?php endif; ?>

        <div class="descripcion-tarea">
            <p class="titulo">Descripción de la tarea:</p>
            <p class="informacion"><?= nl2br(htmlspecialchars($tarea['descripcion'])) ?></p>
        </div>

        <?php if (!empty($tarea['archivo_adjunto'])): ?>
            <div>
                <p class="titulo">Archivo adjunto:</p>
                <p class="informacion">
                    <a href="../../../../docs/uploads/<?= rawurlencode(basename($tarea['archivo_adjunto'])) ?>" target="_blank" rel="noopener noreferrer">
                        <?= htmlspecialchars(basename($tarea['archivo_adjunto'])) ?>
                    </a>
                </p>
            </div>
        <?php endif; ?>

        <?php if (!empty($entrega['archivo_entregado'])): ?>
            <?php
            $ruta_archivo = __DIR__ . '/../../../../docs/uploads/' . basename($entrega['archivo_entregado']);
            $tamano_legible = "Tamaño no disponible";
            if (file_exists($ruta_archivo)) {
                $tamano_archivo = filesize($ruta_archivo);
                if ($tamano_archivo >= 1048576) {
                    $tamano_legible = number_format($tamano_archivo / 1048576, 2) . ' MB';
                } elseif ($tamano_archivo >= 1024) {
                    $tamano_legible = number_format($tamano_archivo / 1024, 2) . ' KB';
                } else {
                    $tamano_legible = $tamano_archivo . ' B';
                }
            }
            ?>
            <div>
                <p class="titulo">Archivo entregado:</p>
                <p class="informacion">
                    <a href="../../../../docs/uploads/<?= rawurlencode(basename($entrega['archivo_entregado'])) ?>" target="_blank" rel="noopener noreferrer">
                        <?= htmlspecialchars(basename($entrega['archivo_entregado'])) ?>
                    </a> (<?= $tamano_legible ?>)
                </p>
            </div>
            <div>
                <p class="titulo">Entregado el:</p>
                <p class="informacion"><?= date('d/m/Y H:i', strtotime($entrega['fecha_entrega'])) ?></p>
            </div>
        <?php elseif (!$plazo_vencido): ?>
            <form action="../../includes/subir.php" method="post" enctype="multipart/form-data" novalidate>
                <label class="form-label titulo" for="taskFile">Adjuntar archivo:</label>
                <input type="file" name="archivo" id="taskFile" accept=".pdf,.doc,.docx,.zip" required>
                <input type="hidden" name="dni_alumno" value="<?= htmlspecialchars($dni_alumno) ?>">
                <input type="hidden" name="id_tarea" value="<?= htmlspecialchars($id_tarea) ?>">
                <input type="hidden" name="grupo_id" value="<?= htmlspecialchars($grupo_id) ?>">
                <br><br>
                <input class="boton-revisar boton-centro" type="submit" name="submit" value="ENTREGAR">
            </form>
        <?php else: ?>
            <div>
                <p class="titulo">Entrega deshabilitada:</p>
                <p class="informacion" style="color: red;">
                    La fecha límite para entregar esta tarea ya ha pasado (<?= date('d/m/Y', strtotime($tarea['fecha_entrega'])) ?>).
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
