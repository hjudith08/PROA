<?php
include __DIR__ . '/../../conexion.inc';

$idAsignatura = $_GET['id'] ?? 0;
if ($idAsignatura <= 0) die("ID inválido");

// Obtener el objetivo de la asignatura
$objetivo = 'Objetivo no disponible';

$sqlObjetivo = "SELECT objetivo_asignatura FROM asignaturas WHERE id_asignatura = ?";
$stmt = $conn_proa->prepare($sqlObjetivo);

if ($stmt) {
    $stmt->bind_param("i", $idAsignatura);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $fila = $result->fetch_assoc()) {
        $objetivo = trim($fila['objetivo_asignatura']);

        // Asegura codificación correcta
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
$sqlTareas = "SELECT t.fecha_entrega, t.descripcion, a.nombre
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
                <p><?= nl2br(htmlspecialchars($objetivo)) ?></p>
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
                            <th>Descripción</th>
                            <th>Asignatura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tareas as $tarea): ?>
                            <tr>
                                <td><?= date('d M', strtotime($tarea['fecha_entrega'])) ?></td>
                                <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                                <td><?= htmlspecialchars($tarea['nombre']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>
