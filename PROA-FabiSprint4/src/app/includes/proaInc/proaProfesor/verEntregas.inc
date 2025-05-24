<?php
include __DIR__ . '/../../conexion.php';

// Por ahora usamos el id_tarea fijo para probar.
// Cuando tengas la pantalla para seleccionar la tarea, cambia esta línea para obtenerlo vía GET, por ejemplo:
// $id_tarea = $_GET['id_tarea'] ?? null;
$id_tarea = 1;

if ($id_tarea) {
    $stmt = $conn->prepare("
        SELECT 
            e.id_entrega,
            e.dni_alumno,
            u.nombre,
            u.apellido1,
            u.apellido2,
            e.archivo_entregado,
            e.fecha_entrega,
            e.nota,
            e.comentarios_profesor
        FROM entregas e
        JOIN usuarios u ON e.dni_alumno = u.dni
        WHERE e.id_tarea = ?
        ORDER BY u.apellido1, u.apellido2
    ");
    $stmt->bind_param("i", $id_tarea);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Aquí podrías manejar el error o mostrar un mensaje si no hay id_tarea
    $result = null;
}
?>
<div class="contenedor-filtros">
    <select class="filtros-tareas" id="filtro-tareas">
        <option value="todos">Todas las entregas</option>
        <option value="puntuadas">Entregas puntuadas</option>
        <option value="no-puntuadas">Entregas sin puntuar</option>
    </select>
</div>
<table class="tabla-entregas">
    <thead>
    <tr>
        <th>Nombre del Alumno</th>
        <th>Fecha de Entrega</th>
        <th>Puntuación</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($result) && $result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre'] . ' ' . $row['apellido1'] . ' ' . $row['apellido2']) ?></td>
                <td><?= htmlspecialchars($row['fecha_entrega']) ?></td>
                <td>
                    <?= is_null($row['nota']) ? 'Sin puntuar' : number_format($row['nota'], 1) . ' / 10' ?>
                </td>
                <td>
                    <button
                            class="boton-revisar"
                            data-id="<?= $row['id_entrega'] ?>"
                            data-titulo="<?= htmlspecialchars($row['titulo'] ?? 'Tarea') ?>"
                            data-estudiante="<?= htmlspecialchars($row['nombre'] . ' ' . $row['apellido1'] . ' ' . $row['apellido2']) ?>"
                            data-archivo="<?= htmlspecialchars($row['archivo_entregado']) ?>"
                            data-nota="<?= is_null($row['nota']) ? '' : $row['nota'] ?>"
                    >
                        Revisar
                    </button>

                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="4">No hay entregas para esta tarea.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
<!-- PopUp Revisar -->
<div id="popup" class="modal oculto">
    <div class="popup-contenido">
        <button class="cerrar" onclick="cerrarPopup()">×</button>

        <div class="popup-fila">
            <span class="titulo">Título:</span>
            <span class="descripcion" id="popup-titulo">Sprint 3</span>
        </div>

        <div class="popup-fila">
            <span class="titulo">Estudiante:</span>
            <span class="descripcion" id="popup-estudiante">Nombre Estudiante</span>
        </div>

        <div class="popup-fila">
            <span class="titulo">Adjunto:</span>
            <button class="boton-descargar" id="boton-descargar">DESCARGAR</button>
        </div>

        <div class="popup-fila nota">
            <input type="number" class="input-nota" id="nota" placeholder="Nota" min="0" max="10" step="0.1">
            <span class="sobre-diez">/10</span>
            <button class="puntuar-boton">PUNTUAR</button>
        </div>
        <input type="hidden" id="entrega-id" value="">
    </div>
</div>

<script>
    function revisarTarea(dniAlumno) {
        // Aquí se redirige a la página para revisar la entrega de ese alumno
        // Luego cuando tengas el id_tarea dinámico, añade parámetro id_tarea a la url si lo necesitas
        window.location.href = `revisarEntrega.php?alumno=${encodeURIComponent(dniAlumno)}`;
    }
</script>

<style>
    .tabla-entregas {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1em;
        font-size: 16px;
    }

    .tabla-entregas th,
    .tabla-entregas td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        text-align: left;
    }

    .tabla-entregas th {
        background-color: #f5f5f5;
    }

    .boton-revisar {
        padding: 6px 12px;
        cursor: pointer;
        transition: background-color 0.2s;
        width: 135px;
        height: 38px;
        background: #FEFEFF;
        border: 1px solid #75619E;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.25);
        border-radius: 15px;
        color: #3F2A52;
    }


    .boton-revisar:hover {
        background-color: rgba(99, 45, 200, 0.2);
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .oculto {
        display: none;
    }

    .popup-contenido {
        background: white;
        padding: 25px 30px;
        border-radius: 15px;
        width: 500px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .cerrar {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
    }

    .popup-fila {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 20px;
    }

    .titulo {
        font-weight: bold;
        color: #3F2A52;
    }

    .descripcion {
        color: #000;
    }

    .boton-descargar,
    .puntuar-boton {
        padding: 8px 20px;
        background: #3F2A52;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }
    .puntuar-boton {
        width: 130px;
    }

    .input-nota {
        width: 70px;
        height: 40px;
        font-size: 18px;
        text-align: center;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .nota {
        gap: 10px;
    }
    /* Estilo para los filtros */
    /* Contenedor de filtros (para posicionamiento relativo) */
    .contenedor-filtros {
        position: relative;
        margin-bottom: 1rem;
        width: 100%;
    }

    /* Estilo para el select de filtros */
    .filtros-tareas {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        border: 1px solid #75619E;
        background-color: white;
        font-size: 0.9rem;
        margin-left: auto; /* Esto lo empuja a la derecha */
        display: block; /* Para que ocupe su propia línea */
        width: fit-content; /* Para que no ocupe todo el ancho */
    }

    /* Estilo para quitar el borde del select cuando no está enfocado */
    #filtro-tareas {
        border: 1px solid #75619E;
    }

    #filtro-tareas:focus {
        outline: none;
        border-color: #75619E;
    }
    /* ==================== RESPONSIVE DESIGN ==================== */

    /* ---------- Pantallas medianas (hasta 777px) ---------- */
    @media screen and (max-width: 777px) {
        /* Contenedor principal */
        .contenido-interior {
            padding: 0.8rem;
        }

        /* Filtro de tareas - Versión móvil */
        .contenedor-filtros {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1.2rem;
        }

        .filtros-tareas {
            width: auto;
            min-width: 240px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            border-radius: 25px;
            box-shadow: 0 2px 6px rgba(117, 97, 158, 0.15);
            transition: all 0.3s ease;
        }

        /* Tabla de entregas - Versión compacta */
        .tabla-entregas {
            width: 100%;
            display: block;
        }

        .tabla-entregas thead {
            display: none;
        }

        .tabla-entregas tbody,
        .tabla-entregas tr,
        .tabla-entregas td {
            display: block;
            width: 100%;
            text-align: center;
        }

        .tabla-entregas tr {
            margin-bottom: 1rem;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 1rem;
        }

        .tabla-entregas td {
            padding: 0.5rem 0;
            position: relative;
        }

        /* Etiquetas antes de cada campo */
        .tabla-entregas td:nth-child(1)::before {
            content: "Nombre";
            font-weight: bold;
            display: block;
            color: #444;
            margin-bottom: 0.25rem;
        }

        .tabla-entregas td:nth-child(2)::before {
            content: "Fecha entrega"; /* << ESTA LÍNEA ES LA QUE FALTA */
            font-weight: bold;
            display: block;
            color: #444;
            margin-bottom: 0.25rem;
        }

        .tabla-entregas td:nth-child(3)::before {
            content: "Nota";
            font-weight: bold;
            display: block;
            color: #444;
            margin-bottom: 0.25rem;
        }

        .tabla-entregas td:nth-child(4)::before {
            content: "";
            font-weight: bold;
            display: block;
            color: #444;
            margin-bottom: 0.25rem;
        }

        .boton-revisar {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        /* Popup de revisión - Versión móvil */
        .popup-contenido {
            width: 85%;
            max-width: 400px;
            padding: 1rem;
            border-radius: 18px;
            margin: auto;
            gap: 1px;
        }

        .popup-fila {
            flex-direction: column;
            align-items: center;
            gap: 0.1rem;
            margin-bottom: 1rem;
        }

        .popup-fila.nota {
            flex-direction: row;
            align-items: center;
            gap: 0.8rem;
        }

        .input-nota {
            width: 70px;
            height: 40px;
            font-size: 1rem;
        }

    }

    /* ---------- Pantallas pequeñas (hasta 480px) ---------- */
    @media screen and (max-width: 480px) {
        /* Contenedor con scroll horizontal */
        .contenido-interior {
            overflow-x: auto;
            padding: 0.5rem;
            -webkit-overflow-scrolling: touch;
        }

        /* Tabla con ancho mínimo */
        .tabla-entregas {
            min-width: 100%;
            font-size: 0.9rem;
        }

        .tabla-entregas th,
        .tabla-entregas td {
            padding: 0.6rem 0.4rem;
            white-space: nowrap;
            text-align: center;
        }

        /* Filtro optimizado */
        .filtros-tareas {
            min-width: 200px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        /* Popup más compacto */
        .popup-contenido {
            width: 90%;
            padding: 1.2rem;
        }

        .popup-fila {
            font-size: 0.95rem;
        }

        .popup-fila.nota {
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .input-nota {
            order: 1;
            width: 60px;
        }

        .sobre-diez {
            order: 2;
            margin-right: auto;
            padding-left: 0.5rem;
        }

        .puntuar-boton {
            order: 3;
            width: 50%;
            margin-top: 0.5rem;
        }



        /* Botones más táctiles */
        .boton-descargar,
        .puntuar-boton {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }



        table {
            width: 100%;
            border-collapse: collapse;
            display: block;
        }

        thead {
            display: none;
        }

        tbody {
            display: block;
        }

        tr {
            display: block;
            margin-bottom: 1rem;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
        }

        td {
            display: block;
            width: 100%;
            padding: 0.5rem 0;
            border: none;
            position: relative;
        }

        td:nth-child(1)::before {
            content: "Nombre";
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 0.25rem;
        }

        td:nth-child(2)::before {
            content: "Fecha entrega";
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 0.25rem;
        }

        td:nth-child(3)::before {
            content: "Nota";
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 0.25rem;
        }

        td:nth-child(4)::before {
            content: "";
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 0.25rem;
        }

        .puntuar-boton {
            width: 50%;
            margin-top: 0.5rem;

        }
    }

    /* ---------- Ajustes para tablets en modo portrait ---------- */
    @media screen and (min-width: 481px) and (max-width: 777px) {
        .tabla-entregas {
            width: 100%;
        }

        .boton-revisar {
            min-width: 110px;
        }
    }
</style>
