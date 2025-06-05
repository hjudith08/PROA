<?php
include __DIR__ . '/../../conexion.inc';

if (!isset($_SESSION['dni']) || empty($_SESSION['dni'])) {
    die("Acceso denegado: no hay DNI de alumno en sesión");
}

$dniAlumno = $_SESSION['dni'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if (!$data) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Datos no válidos']);
        exit;
    }

    $id = intval($data['id'] ?? 0);
    $campo = $data['campo'] ?? '';
    $valor = $data['valor'] ?? '';

    $camposPermitidos = ['objetivo_asignatura', 'datos_profesor', 'informacion_extra'];
    if (!in_array($campo, $camposPermitidos) || $id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Campo o ID no válido']);
        exit;
    }

    if ($valor === '') {
        $query = "UPDATE asignaturas SET $campo = NULL WHERE id_asignatura = ?";
        $stmt = $conn_proa->prepare($query);
        $stmt->bind_param("i", $id);
    } else {
        $query = "UPDATE asignaturas SET $campo = ? WHERE id_asignatura = ?";
        $stmt = $conn_proa->prepare($query);
        $stmt->bind_param("si", $valor, $id);
    }

    $success = $stmt->execute();
    echo json_encode(['success' => $success]);
    $stmt->close();
    $conn_proa->close();
    exit;
}

$idAsignatura = intval($_GET['id'] ?? 0);
if ($idAsignatura <= 0) {
    die("ID inválido");
}

$sql = "
    SELECT objetivo_asignatura, informacion_extra
    FROM asignaturas
    WHERE id_asignatura = ?
";
$stmt = $conn_proa->prepare($sql);
$stmt->bind_param("i", $idAsignatura);
$stmt->execute();
$asignatura = $stmt->get_result()->fetch_assoc() ?: [];
$stmt->close();

$sqlProf = "
    SELECT u.nombre, u.apellido1, u.apellido2, u.email, u.despacho
    FROM profesores_asignaturas pa
    JOIN usuarios u ON pa.dni_profesor = u.dni
    WHERE pa.id_asignatura = ?
    LIMIT 1
";
$stmt = $conn_proa->prepare($sqlProf);
$stmt->bind_param("i", $idAsignatura);
$stmt->execute();
$profesor = $stmt->get_result()->fetch_assoc() ?: [];
$stmt->close();

$tareas = [];
$sqlTareas = "
    SELECT id_tarea, fecha_entrega, descripcion
    FROM tareas
    WHERE id_asignatura = ?
    ORDER BY fecha_entrega ASC
    LIMIT 7
";
$stmt = $conn_proa->prepare($sqlTareas);
$stmt->bind_param("i", $idAsignatura);
$stmt->execute();
$resultTareas = $stmt->get_result();
while ($fila = $resultTareas->fetch_assoc()) {
    $tareas[] = $fila;
}
$stmt->close();
?>

<main class="content">
    <button class="hamburguesa" aria-label="Abrir menú">☰</button>
    <nav class="menu-movil">
        <ul>
            <li>
                <a href="inicioGeneral.php">
                    <img src="images/homeb.png" alt="Inicio" />
                    Inicio General
                </a>
            </li>
            <li>
                <a href="EditarInicioAsignaturas.php">
                    <img src="images/bookb.png" alt="Asignaturas" />
                    Asignaturas
                </a>
            </li>
        </ul>
    </nav>

    <div class="contenedor-flex-principal">
        <div class="contenedor-tareas">
            <div class="cabecera-tareas">
                <h1>INFORMACIÓN ASIGNATURA</h1>
            </div>
            <div class="tabla-flex-container">
                <ul class="asignaturas informacionAsig">
                    <li>
                        <h3>Objetivo asignatura</h3>
                        <p><?= htmlspecialchars($asignatura['objetivo_asignatura'] ?? 'No definido') ?></p>
                    </li>
                    <li>
                        <h3>Profesor</h3>
                        <p><?= htmlspecialchars(trim(($profesor['nombre'] ?? '') . ' ' . ($profesor['apellido1'] ?? '') . ' ' . ($profesor['apellido2'] ?? ''))) ?></p>

                        <h3>Email</h3>
                        <p><?= htmlspecialchars($profesor['email'] ?? 'No disponible') ?></p>

                        <h3>Despacho</h3>
                        <p><?= htmlspecialchars($profesor['despacho'] ?? 'No disponible') ?></p>
                    </li>

                    <li>
                        <h3>Extra</h3>
                        <p><?= htmlspecialchars($asignatura['informacion_extra'] ?? 'Sin información adicional') ?></p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="contenedor-tareas">
            <div class="cabecera-tareas">
                <h1>TAREAS</h1>
            </div>
            <div class="tabla-flex-container">
                <?php if (count($tareas) > 0): ?>
                    <table class="tabla-tareas">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha de Entrega</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tareas as $tarea): ?>
                            <tr onclick="location.href='verTarea.php?id_tarea=<?= $tarea['id_tarea'] ?>&dni=<?= urlencode($dniAlumno) ?>';" style="cursor:pointer;">
                                <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                                <td><?= date('d/m/Y', strtotime($tarea['fecha_entrega'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay tareas asignadas.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
