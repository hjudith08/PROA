<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../includes/conexion.inc';

$idAsignatura = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sqlAlumnos = "SELECT dni, nombre, apellido1, apellido2 FROM usuarios WHERE rol_id = 'alumno'";
if (!empty($_GET['carrera_alumno'])) {
    $carreras = array_map([$conn_proa, 'real_escape_string'], $_GET['carrera_alumno']);
    if (count($carreras) > 0) {
        $sqlAlumnos .= " AND carrera_alumno IN ('" . implode("','", $carreras) . "')";
    }
}
$resultadoAlumnos = $conn_proa->query($sqlAlumnos);

$sqlAsociados = "SELECT dni_alumno FROM alumnos_asignaturas WHERE id_asignatura = ?";
$stmt = $conn_proa->prepare($sqlAsociados);
$stmt->bind_param("i", $idAsignatura);
$stmt->execute();
$resultadoAsociados = $stmt->get_result();

$alumnosAsociados = [];
while ($fila = $resultadoAsociados->fetch_assoc()) {
    $stmtDatos = $conn_proa->prepare("SELECT nombre, apellido1, apellido2 FROM usuarios WHERE dni = ?");
    $stmtDatos->bind_param("s", $fila['dni_alumno']);
    $stmtDatos->execute();
    $resDatos = $stmtDatos->get_result();
    $datos = $resDatos->fetch_assoc();
    $alumnosAsociados[] = [
        'dni' => $fila['dni_alumno'],
        'nombre' => $datos['nombre'] ?? '',
        'apellido1' => $datos['apellido1'] ?? '',
        'apellido2' => $datos['apellido2'] ?? ''
    ];
    $stmtDatos->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Asignaturas - Alumnos</title>
    <link rel="icon" href="../../../imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/proaCSS/basePas.css">
    <link rel="stylesheet" href="../../../css/proaCSS/estilos-pas-ap.css" />
    <script src="../../../js/proaJS/funcionesBase.js" defer></script>
</head>
<body>
    <?php include '../../includes/proaInc/menuProa.inc'; ?>

    <?php if (isset($_GET['msg'])): ?>
        <div class="mensaje-accion <?= $_GET['msg'] === 'ok' ? 'exito' : 'error' ?>">
            <?= $_GET['msg'] === 'ok' ? '¡Cambios guardados correctamente!' : 'Ha ocurrido un error al guardar los cambios.' ?>
        </div>
    <?php endif; ?>

    <div class="contenedor-principal">
        <button class="boton-filtros-mobile" onclick="toggleFiltros()">
            <span>Filtros</span>
            <img src="../../../imagenes/filtroBlanco.png" alt="Filtros" class="icono-filtros" />
        </button>

        <aside class="sidebar scrollbar">
            <h2 class="titulo-filtro">FILTRAR POR</h2>
            <button class="boton-limpiar" id="boton-borrar">Borrar todo</button>
            <form method="GET" action="" id="form-filtros">
                <input type="hidden" name="id" value="<?= htmlspecialchars($idAsignatura) ?>" />
                <div class="seccion-filtro">
                    <h3 class="subtitulo-filtro">Carrera</h3>
                    <div class="opcion-filtro">
                        <input type="checkbox" name="carrera_alumno[]" value="Informática" id="informática"
                            <?= in_array("Informática", $_GET['carrera_alumno'] ?? []) ? 'checked' : '' ?> />
                        <label for="informática">Grado Informática</label>
                    </div>
                    <div class="opcion-filtro">
                        <input type="checkbox" name="carrera_alumno[]" value="Matemáticas" id="matematicas"
                            <?= in_array("Matemáticas", $_GET['carrera_alumno'] ?? []) ? 'checked' : '' ?> />
                        <label for="matematicas">Grado Matemáticas</label>
                    </div>
                    <div class="opcion-filtro">
                        <input type="checkbox" name="carrera_alumno[]" value="Física" id="fisica"
                            <?= in_array("Física", $_GET['carrera_alumno'] ?? []) ? 'checked' : '' ?> />
                        <label for="fisica">Grado Física</label>
                    </div>
                </div>
            </form>
        </aside>

        <main class="contenido scrollbar">
            <div class="cabecera-tareas">
                <h1>Alumnos</h1>
            </div>
            <div class="recuadro-asignaturas">
                <div class="barra-busqueda">
                    <input type="text" class="input-busqueda" placeholder="Nombre:" id="input-busqueda" />
                    <img src="../../../imagenes/loupe.png" alt="Buscar" class="icono-busqueda" />
                </div>
                <div class="bloque-asignaturas">
                    <div class="alumnos-layout">
                        <div class="tarjeta" style="flex:2;">
                            <div class="contenido-tarjeta">
                                <form method="POST" action="asociarAlumnos.php" id="form-alumnos">
                                    <input type="hidden" name="id_asignatura" value="<?= htmlspecialchars($idAsignatura) ?>" />
                                    <div class="lista-asignaturas scrollbar" id="lista-asignaturas">
                                        <?php
                                        if ($resultadoAlumnos && $resultadoAlumnos->num_rows > 0) {
                                            while ($alumno = $resultadoAlumnos->fetch_assoc()) {
                                                $dni = $alumno['dni'];
                                                $checked = false;
                                                foreach ($alumnosAsociados as $asociado) {
                                                    if ($asociado['dni'] === $dni) {
                                                        $checked = true;
                                                        break;
                                                    }
                                                }
                                                echo "<div class='tarjeta-profesor'>";
                                                echo "<input type='checkbox' name='alumnos[]' value='" . htmlspecialchars($dni) . "' " . ($checked ? 'checked' : '') . ">";
                                                echo "<span class='nombre-profesor'>" .
                                                    htmlspecialchars($alumno['nombre'] ?? '') . " " .
                                                    htmlspecialchars($alumno['apellido1'] ?? '') . " " .
                                                    htmlspecialchars($alumno['apellido2'] ?? '') .
                                                    "</span>";
                                                echo "<span class='dni-profesor'>(" . htmlspecialchars($dni ?? '') . ")</span>";
                                                echo "</div>";
                                            }
                                        } else {
                                            echo "<div class='tarjeta-alumno'>No hay alumnos disponibles.</div>";
                                        }
                                        ?>
                                    </div>
                                </form>
                                <div class="botones-accion">
                                    <button type="submit" class="boton-accion" form="form-alumnos">Guardar cambios</button>
                                    <a href="PasInicio.php" class="boton-accion" style="text-decoration:none;line-height:38px;">Volver</a>
                                </div>
                            </div>
                        </div>
                        <div class="seleccionados-lista" style="flex:1;">
                            <h3>Alumnos seleccionados</h3>
                            <ul id="lista-seleccionados">
                                <!-- Se rellena por JS -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include '../../includes/proaInc/footerProa.inc'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("input-busqueda");
            const lista = document.getElementById("lista-asignaturas");
            function normalizarTexto(texto) {
                return texto
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .toLowerCase();
            }
            input.addEventListener("input", function () {
                const filtro = normalizarTexto(input.value);
                const items = lista.querySelectorAll(".tarjeta-profesor");
                items.forEach(function (item) {
                    const texto = normalizarTexto(item.textContent || "");
                    item.style.display = texto.includes(filtro) ? "block" : "none";
                });
            });

            // Filtros auto-submit
            document.querySelectorAll('#form-filtros input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    document.getElementById('form-filtros').submit();
                });
            });

            // boton borrar filtros
            document.getElementById('boton-borrar').addEventListener('click', () => {
                window.location.href = window.location.pathname + "?id=<?= htmlspecialchars($idAsignatura) ?>";
            });

            // Lista seleccionados en tiempo real
            function actualizarSeleccionados() {
                const checkboxes = document.querySelectorAll('input[name="alumnos[]"]');
                const lista = document.getElementById('lista-seleccionados');
                lista.innerHTML = '';
                let haySeleccionados = false;
                checkboxes.forEach(function (cb) {
                    if (cb.checked) {
                        haySeleccionados = true;
                        const nombre = cb.parentElement.querySelector('.nombre-profesor').textContent.trim();
                        const dni = cb.parentElement.querySelector('.dni-profesor').textContent.trim();
                        const li = document.createElement('li');
                        li.textContent = nombre + ' ' + dni;
                        lista.appendChild(li);
                    }
                });
                if (!haySeleccionados) {
                    lista.innerHTML = '<span style="color:#888;">Ningún alumno seleccionado.</span>';
                }
            }
            document.querySelectorAll('input[name="alumnos[]"]').forEach(function (cb) {
                cb.addEventListener('change', actualizarSeleccionados);
            });
            actualizarSeleccionados();
        });

        function toggleFiltros() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('activo');
            const botonFiltros = document.querySelector('.boton-filtros-mobile');
            if (sidebar.classList.contains('activo')) {
                botonFiltros.innerHTML = '<span>Ocultar filtros</span>' +
                    '<img src="../../../imagenes/filtroBlanco.png" alt="Filtros" class="icono-filtros">';
            } else {
                botonFiltros.innerHTML = '<span>Filtros</span>' +
                    '<img src="../../../imagenes/filtroBlanco.png" alt="Filtros" class="icono-filtros">';
            }
        }
    </script>
</body>
</html>