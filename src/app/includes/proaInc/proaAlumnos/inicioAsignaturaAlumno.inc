<?php
include __DIR__ . '/../../conexion.inc';  // Ajusta la ruta a tu conexión

if (!isset($_GET['codigo'])) {
    die('Asignatura no especificada.');
}

$codigo_asignatura = $_GET['codigo'];

// Obtener datos asignatura
$stmt = $conn->prepare("SELECT nombre, descripcion, tipo_titulacion, curso, cuatrimestre, objetivo_asignatura, informacion_extra, grupo_id FROM asignaturas WHERE codigo = ?");
$stmt->bind_param("s", $codigo_asignatura);
$stmt->execute();
$result = $stmt->get_result();
$asignatura = $result->fetch_assoc();

if (!$asignatura) {
    die('Asignatura no encontrada.');
}

// Obtener profesor que corresponde a ese grupo y es profesor
$rol_profesor = 'profesor';  // Cambia si el rol tiene otro id
$stmt_profesor = $conn->prepare("SELECT nombre, apellido1, apellido2, email, despacho FROM usuarios WHERE grupo_id = ? AND rol_id = ? LIMIT 1");
$stmt_profesor->bind_param("ss", $asignatura['grupo_id'], $rol_profesor);
$stmt_profesor->execute();
$result_profesor = $stmt_profesor->get_result();
$profesor = $result_profesor->fetch_assoc();

// Obtener tareas
$tareas = [];
$stmt_tareas = $conn->prepare("SELECT descripcion, fecha_entrega FROM tareas WHERE id_asignatura = (SELECT id_asignatura FROM asignaturas WHERE codigo = ?) ORDER BY fecha_entrega ASC");
$stmt_tareas->bind_param("s", $codigo_asignatura);
$stmt_tareas->execute();
$result_tareas = $stmt_tareas->get_result();
while ($fila = $result_tareas->fetch_assoc()) {
    $tareas[] = $fila;
}
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
                <ul class="asignaturas">
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


