<?php
include __DIR__ . '/../../conexion.inc';

$dni_usuario   = $_SESSION['dni'] ?? '';

// Primero obtenemos el rol del usuario
$stmt = $conn_proa->prepare("SELECT rol_id FROM usuarios WHERE dni = ?");
$stmt->bind_param("s", $dni_usuario);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    die("Usuario no encontrado");
}
$row = $res->fetch_assoc();
$rol = $row['rol_id'];

if ($rol === 'profesor') {
    // Consultamos asignaturas donde es profesor, incluyendo curso y cuatrimestre
    $query = "
        SELECT a.id_asignatura, a.nombre, a.codigo, a.descripcion, a.curso, a.cuatrimestre
        FROM asignaturas a
        JOIN profesores_asignaturas pa ON a.id_asignatura = pa.id_asignatura
        WHERE pa.dni_profesor = ?
        ORDER BY a.nombre
    ";
} else if ($rol === 'alumno') {
    // Consultamos asignaturas donde es alumno, incluyendo curso y cuatrimestre
    $query = "
        SELECT a.id_asignatura, a.nombre, a.codigo, a.descripcion, a.curso, a.cuatrimestre
        FROM asignaturas a
        JOIN alumnos_asignaturas aa ON a.id_asignatura = aa.id_asignatura
        WHERE aa.dni_alumno = ?
        ORDER BY a.nombre
    ";
} else {
    die("Rol no válido para consultar asignaturas");
}

$stmt = $conn_proa->prepare($query);
$stmt->bind_param("s", $dni_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="filtros-asignaturas">
    <div class="filtros-cuatrimestre">
        <label class="textofiltros">Cuatrimestre</label>
        <label><input type="checkbox" name="cuatrimestre" value="1" checked> Primer cuatrimestre</label>
        <label><input type="checkbox" name="cuatrimestre" value="2" checked> Segundo cuatrimestre</label>
    </div>
    <div class="filtros-curso">
        <label class="textofiltros">Curso</label>
        <label><input type="checkbox" name="curso" value="1" checked> 1º</label>
        <label><input type="checkbox" name="curso" value="2" checked> 2º</label>
        <label><input type="checkbox" name="curso" value="3" checked> 3º</label>
        <label><input type="checkbox" name="curso" value="4" checked> 4º</label>
    </div>
</div>

<table class="tabla-entregas" id="asignaturas">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Código</th>
        <th>Descripción</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr
                    data-curso="<?= htmlspecialchars($row['curso']) ?>"
                    data-cuatrimestre="<?= htmlspecialchars($row['cuatrimestre']) ?>"
                    onclick="window.location.href='inicioAsignatura.php?id=<?= urlencode($row['id_asignatura']) ?>'"
                    style="cursor:pointer;"
            >
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= htmlspecialchars($row['codigo']) ?></td>
                <td><?= htmlspecialchars($row['descripcion']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="3">No tienes asignaturas asignadas.</td></tr>
    <?php endif; ?>
    </tbody>
</table>