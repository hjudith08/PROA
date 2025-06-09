<?php
include __DIR__ . '/../../conexion.inc';

$idAsignatura = $_GET['id'] ?? 0;
if ($idAsignatura <= 0) die("ID inválido");

// Procesar actualización antes de cualquier salida
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['objetivo'])) {
    $nuevoObjetivo = $_POST['objetivo'];
    $sqlUpdate = "UPDATE asignaturas SET objetivo_asignatura = ? WHERE id_asignatura = ?";
    $stmtUpdate = $conn_proa->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $nuevoObjetivo, $idAsignatura);
    $stmtUpdate->execute();
    $stmtUpdate->close();

   // Redirige para refrescar y evitar repost de formulario con JS
    echo '<script>
        window.location.href = "?id=' . htmlspecialchars($idAsignatura, ENT_QUOTES, 'UTF-8') . '";
    </script>';
    exit;
}

// Obtener objetivo
$objetivo = 'Objetivo no disponible';
$sqlObjetivo = "SELECT objetivo_asignatura FROM asignaturas WHERE id_asignatura = ?";
$stmt = $conn_proa->prepare($sqlObjetivo);
if ($stmt) {
    $stmt->bind_param("i", $idAsignatura);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $fila = $result->fetch_assoc()) {
        $objetivo = trim($fila['objetivo_asignatura']);
        if (!mb_detect_encoding($objetivo, 'UTF-8', true)) {
            $objetivo = utf8_encode($objetivo);
        }
        if ($objetivo === '') {
            $objetivo = 'Este objetivo aún no ha sido definido.';
        }
    }
    $stmt->close();
}

// Obtener datos de los profesores
$sqlProfesor = "SELECT u.nombre, u.apellido1, u.apellido2, u.email, u.despacho
                FROM profesores_asignaturas pa
                JOIN usuarios u ON pa.dni_profesor = u.dni
                WHERE pa.id_asignatura = ?";
$stmt = $conn_proa->prepare($sqlProfesor);
$stmt->bind_param("i", $idAsignatura);
$stmt->execute();
$resultProfesores = $stmt->get_result();

$profesores = [];
while ($fila = $resultProfesores->fetch_assoc()) {
    $profesores[] = $fila;
}
$stmt->close();

// Obtener tareas asociadas
$tareas = [];
$sqlTareas = "SELECT t.fecha_entrega, t.titulo, t.descripcion, a.nombre
              FROM tareas t
              JOIN asignaturas a ON t.id_asignatura = a.id_asignatura
              WHERE t.id_asignatura = ?
              ORDER BY t.fecha_entrega ASC";
$stmt = $conn_proa->prepare($sqlTareas);
$stmt->bind_param("i", $idAsignatura);
$stmt->execute();
$resultTareas = $stmt->get_result();
while ($fila = $resultTareas->fetch_assoc()) {
    $tareas[] = $fila;
}
$stmt->close();
?>

<!-- HTML con los datos -->
<main class="content">
    <nav class="menu-movil">
        <ul>
            <li><a href="#"><img src="images/homeb.png" alt="Inicio" />Inicio General</a></li>
            <li><a href="#"><img src="images/bookb.png" alt="Asignaturas" />Asignaturas</a></li>
        </ul>
    </nav>

    <div class="contenedor-asignatura">
        <div class="info-asignatura">
            <div class="card card-con-boton">
                <h3>Objetivo asignatura</h3>

                <form method="post" action="" id="form-objetivo">
                    <!-- Texto visible -->
                    <p id="texto-objetivo"><?= nl2br(htmlspecialchars($objetivo)) ?></p>

                    <!-- Textarea oculto inicialmente -->
                    <textarea name="objetivo" id="textarea-objetivo" style="display:none; width:100%; height:120px;"><?= htmlspecialchars($objetivo) ?></textarea>

                    <div class="card-boton">
                        <button type="button" id="btn-editar" class="boton-revisar-profesor">Editar</button>
                        <button type="submit" id="btn-guardar" style="display:none;" class="boton-revisar-profesor">Guardar</button>
                        <button type="button" id="btn-cancelar" style="display:none;" class="boton-revisar-profesor">Cancelar</button>
                    </div>
                </form>

            </div>

            <div class="card">
                <h3>Datos profesor</h3>
                <?php if (!empty($profesores)): ?>
                    <?php foreach ($profesores as $prof): ?>
                        <p>
                            <?= htmlspecialchars($prof['nombre'] . ' ' . $prof['apellido1'] . ' ' . $prof['apellido2']) ?><br>
                            Despacho <?= htmlspecialchars($prof['despacho']) ?><br>
                            <a href="mailto:<?= htmlspecialchars($prof['email']) ?>"><?= htmlspecialchars($prof['email']) ?></a>
                        </p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay profesores asignados a esta asignatura.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tareas -->
        <section class="bloque-info">
            <div class="cabecera-tareas">
                <h1>TAREAS POR REALIZAR</h1>
            </div>
            <div class="tabla-container">
                <table class="tabla-asignaturas">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Título</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tareas as $tarea): ?>
                            <tr>
                                <td><?= date('d M', strtotime($tarea['fecha_entrega'])) ?></td>
                                <td><?= htmlspecialchars($tarea['titulo']) ?></td>
                                <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnEditar = document.getElementById('btn-editar');
    const btnGuardar = document.getElementById('btn-guardar');
    const btnCancelar = document.getElementById('btn-cancelar');
    const textoObjetivo = document.getElementById('texto-objetivo');
    const textareaObjetivo = document.getElementById('textarea-objetivo');

    btnEditar.addEventListener('click', function() {
        textoObjetivo.style.display = 'none';
        textareaObjetivo.style.display = 'block';
        btnEditar.style.display = 'none';
        btnGuardar.style.display = 'inline-block';
        btnCancelar.style.display = 'inline-block';
    });

    btnCancelar.addEventListener('click', function() {
        textareaObjetivo.style.display = 'none';
        textoObjetivo.style.display = 'block';
        btnEditar.style.display = 'inline-block';
        btnGuardar.style.display = 'none';
        btnCancelar.style.display = 'none';
        // Reset textarea al valor original para evitar cambios no guardados
        textareaObjetivo.value = textoObjetivo.textContent.replace(/\n/g, "\n");
    });
});
</script>
