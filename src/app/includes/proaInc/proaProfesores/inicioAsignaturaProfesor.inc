<?php
include __DIR__ . '/../../conexion.inc';

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
        // Guardar NULL si el campo está vacío
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

$idAsignatura = $_GET['id'] ?? 0;
if ($idAsignatura <= 0) die("ID inválido");

// Obtener info de la asignatura
$sql = "
SELECT a.objetivo_asignatura, a.informacion_extra,
       GROUP_CONCAT(CONCAT(u.nombre, ' ', u.apellido1, ' ', IFNULL(u.apellido2, '')) SEPARATOR ', ') AS datos_profesor
FROM asignaturas a
JOIN profesores_asignaturas pa ON a.id_asignatura = pa.id_asignatura
JOIN usuarios u ON pa.dni_profesor = u.dni
WHERE a.id_asignatura = ?
GROUP BY a.id_asignatura
";
$stmt = $conn_proa->prepare($sql);
$stmt->bind_param("i", $idAsignatura);
$stmt->execute();
$datos = $stmt->get_result()->fetch_assoc();
$stmt->close();

$campos = [
    'objetivo_asignatura' => $datos['objetivo_asignatura'] ?? '',
    'datos_profesor' => $datos['datos_profesor'] ?? '',
    'informacion_extra' => $datos['informacion_extra'] ?? ''
];

// Obtener tareas
$tareas = [];
$sqlTareas = "
SELECT t.fecha_entrega, t.descripcion
FROM tareas t
WHERE t.id_asignatura = ?
ORDER BY t.fecha_entrega ASC
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
<!-- HTML A PARTIR DE AQUÍ -->
<main class="content">
    <nav class="menu-movil">
        <ul>
            <li><a href="#"><img src="images/homeb.png" alt="Inicio" />Inicio General</a></li>
            <li><a href="#"><img src="images/bookb.png" alt="Asignaturas" />Asignaturas</a></li>
        </ul>
    </nav>

    <div class="contenedor-flex-principal">

        <!-- IZQUIERDA: Información Asignatura -->
        <div class="contenedor-tareas">
            <div class="cabecera-tareas"><h1>INFORMACIÓN ASIGNATURA</h1></div>
            <div class="tabla-flex-container">
                <ul class="asignaturas">
                    <?php foreach ($campos as $campo => $valor): ?>
                        <li class="fila-objetivo">
                            <div class="encabezado-item">
                                <h3><?= ucfirst(str_replace('_', ' ', $campo)) ?></h3>
                            </div>
                            <div class="texto-contenedor" data-id="<?= $idAsignatura ?>" data-campo="<?= $campo ?>">
                                <div class="texto-visible"><?= htmlspecialchars($valor) ?></div>
                                <textarea class="textarea-edicion" style="display: none;"></textarea>
                                <button class="btn-guardar" style="display: none;">Guardar</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- DERECHA: Lista de Tareas -->
        <div class="contenedor-tareas">
            <div class="cabecera-tareas"><h1>TAREAS</h1></div>
            <div class="tabla-flex-container">
                <ul class="tareas">
                    <?php foreach ($tareas as $tarea):
                        $fecha = DateTime::createFromFormat('Y-m-d', $tarea['fecha_entrega']);
                        $dia = $fecha ? $fecha->format('d') : '';
                        $mes = $fecha ? $fecha->format('m') : '';
                        ?>
                        <li>
                            <div>
                                <p class="texto-lista-tareas"><?= htmlspecialchars($tarea['descripcion']) ?></p>
                                <div class="encabezado-item">
                                    <div class="rectangulo-fecha"><?= $dia ?> <?= $mes ?></div>
                                    <div class="botonesEditaryVer">
                                        <button class="editar" onclick="window.location.href='EditarTarea.html'">Editar entrega</button>
                                        <button class="editar" onclick="window.location.href='VerEntregas.html'">Ver entregas</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    </div>
</main>