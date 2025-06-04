<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../conexion.inc';

$id_asignatura = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$dni_alumno    = $_SESSION['dni'] ?? '';

if ($id_asignatura <= 0 || empty($dni_alumno)) {
    exit('Datos inválidos.');
}

// ---------------------------------------------------------------------------------
//  Consulta: tareas de la asignatura + última entrega (si existe) del alumno
// ---------------------------------------------------------------------------------

$sql = "
SELECT
    t.id_tarea,
    t.titulo,
    t.fecha_apertura,
    t.fecha_entrega  AS fecha_limite,
    e.fecha_entrega  AS fecha_entrega_real,
    e.nota
FROM tareas t
LEFT JOIN (
    SELECT id_tarea, dni_alumno,
           MAX(fecha_entrega) AS fecha_entrega,
           MAX(nota) AS nota
    FROM entregas
    WHERE dni_alumno = ?
    GROUP BY id_tarea, dni_alumno
) e ON t.id_tarea = e.id_tarea
WHERE t.id_asignatura = ?
ORDER BY t.fecha_entrega DESC";

$stmt = $conn_proa->prepare($sql) or exit('Error en la consulta: ' . $conn_proa->error);
$stmt->bind_param('si', $dni_alumno, $id_asignatura);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tareas asignatura</title>
    <link rel="stylesheet" href="../../../css/proaCSS/tareasAlumno.css">
    <style>
        th.sortable{cursor:pointer;user-select:none}
        .flecha{font-size:.75em;margin-left:.25em}
    </style>
</head>
<body>
<div class="contenedor-tareasAlumno">
    <div class="contenedor-filtros">
        <select id="filtro-tareas-estado">
            <option value="todas">Todas las tareas</option>
            <option value="completado">Tareas completadas</option>
            <option value="pendiente">Tareas pendientes</option>
        </select>
    </div>

    <table>
        <thead>
        <tr>
            <th class="sortable" data-sort="nombre">Nombre Tarea<span class="flecha"></span></th>
            <th class="sortable" data-sort="estado">Estado<span class="flecha"></span></th>
            <th class="sortable" data-sort="apertura">Fecha de apertura<span class="flecha"></span></th>
            <th class="sortable" data-sort="entrega">Fecha límite<span class="flecha"></span></th>
            <th>Calificación</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows):
            while ($row = $result->fetch_assoc()):
                $estado = empty($row['fecha_entrega_real']) ? 'pendiente' : 'completado';
                $nota   = (!empty($row['fecha_entrega_real']) && $row['nota'] !== null) ? $row['nota'] : '-';
                ?>
                <tr class="fila" data-estado="<?= $estado ?>" data-id="<?= $row['id_tarea'] ?>">
                    <td><?= htmlspecialchars($row['titulo']) ?></td>
                    <td><?= ucfirst($estado) ?></td>
                    <td><?= date('d/m/Y', strtotime($row['fecha_apertura'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($row['fecha_limite'])) ?></td>
                    <td><?= htmlspecialchars($nota) ?></td>
                </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="5">No hay tareas.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('filtro-tareas-estado').addEventListener('change', e=>{
        const sel=e.target.value;
        document.querySelectorAll('tbody .fila').forEach(f=>{
            f.style.display = (sel==='todas'||f.dataset.estado===sel)?'':'none';
        });
    });

    document.querySelectorAll('tbody .fila').forEach(f=>{
        f.style.cursor='pointer';
        f.onclick=()=>location.href=`verTarea.php?id_tarea=${f.dataset.id}&dni=<?php echo rawurlencode($dni_alumno); ?>`;
    });

    const dir={},ths=document.querySelectorAll('th.sortable');
    ths.forEach(th=>{dir[th.dataset.sort]=1;th.onclick=()=>sort(th);});
    function d(s){const[dd,mm,yy]=s.split('/');return new Date(`${yy}-${mm}-${dd}`).getTime();}
    function sort(th){const key=th.dataset.sort,asc=dir[key];const idx=[...th.parentNode.children].indexOf(th);
        const filas=[...document.querySelectorAll('tbody tr')].sort((a,b)=>{
            let va=a.children[idx].innerText.trim();let vb=b.children[idx].innerText.trim();
            if(key==='apertura'||key==='entrega'){va=d(va);vb=d(vb);} else {va=va.toLowerCase();vb=vb.toLowerCase();}
            return (va>vb?1:-1)*asc;
        });
        dir[key]*=-1;const tb=document.querySelector('tbody');filas.forEach(r=>tb.appendChild(r));
        ths.forEach(h=>h.querySelector('.flecha').textContent='');th.querySelector('.flecha').textContent=asc===1?'▲':'▼';
    }
</script>
</body>
</html>
