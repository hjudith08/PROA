
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
        <!-- IZQUIERDA: Información Asignatura -->
        <div class="contenedor-tareas">
            <div class="cabecera-tareas">
                <h1>INFORMACIÓN ASIGNATURA</h1>
            </div>
            <div class="tabla-flex-container">
                <ul class="asignaturas informacionAsig">
                    <li>
                        <h3>Objetivo asignatura</h3>
                        <p><?= htmlspecialchars($asignatura['objetivo_asignatura']) ?></p>
                    </li>
                    <li>
                        <h3>Profesor</h3>
                        <p><?= htmlspecialchars($profesor['nombre'] . ' ' . $profesor['apellido1'] . ' ' . $profesor['apellido2']) ?></p>

                        <h3>Email</h3>
                        <p><?= htmlspecialchars($profesor['email']) ?></p>

                        <h3>Despacho</h3>
                        <p><?= htmlspecialchars($profesor['despacho']) ?></p>
                    </li>

                    <li>
                        <h3>Extra</h3>
                        <p><?= htmlspecialchars($asignatura['informacion_extra']) ?></p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- DERECHA: Lista de Tareas -->
        <div class="contenedor-tareas">
            <div class="cabecera-tareas">
                <h1>TAREAS</h1>
            </div>
            <div class="tabla-flex-container">
                <ul class="tareas">
                    <?php foreach ($tareas as $tarea): ?>
                        <li>
                            <div>
                                <p class="texto-lista-tareas"><?= htmlspecialchars($tarea['descripcion']) ?></p>
                                <div class="encabezado-item">
                                    <div class="rectangulo-fecha"><?= strtoupper(date('d M', strtotime($tarea['fecha_entrega']))) ?></div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</main>