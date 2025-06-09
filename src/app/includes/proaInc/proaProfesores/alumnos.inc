<?php
include __DIR__ . '/../../conexion.inc';  

// Obtener id_asignatura desde la URL
$id_asignatura = $_GET['id'] ?? null;

if (!$id_asignatura) {
    die("ID de asignatura no proporcionado.");
}

// Obtener listado de alumnos
$query = "
    SELECT u.dni, u.nombre, u.apellido1, u.apellido2
    FROM alumnos_asignaturas aa
    JOIN usuarios u ON aa.dni_alumno = u.dni
    WHERE aa.id_asignatura = ?
    ORDER BY u.apellido1, u.apellido2, u.nombre
";

$stmt = $conn_proa->prepare($query);
$stmt->bind_param("i", $id_asignatura);
$stmt->execute();
$result = $stmt->get_result();
?>


<table class="tabla-entregas" id="alumnos">
    <thead>
        <tr>
            <th>DNI</th>
            <th>Nombre completo</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['dni']) ?></td>
                    <td><?= htmlspecialchars($row['apellido1'] . ' ' . $row['apellido2'] . ', ' . $row['nombre']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="2">No hay alumnos registrados en esta asignatura.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
