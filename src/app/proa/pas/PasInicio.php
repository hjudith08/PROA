<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// conexión usando el archivo de inclusión
include '../../includes/conexion.inc';

// Consulta base de datos todas las asignaturas
$sql = "SELECT * FROM asignaturas WHERE 1=1";
$condiciones = [];

// Filtrado por tipo de titulación
if (!empty($_GET['tipo_titulacion'])) {
    $tipos = array_map([$conn_proa, 'real_escape_string'], $_GET['tipo_titulacion']);
    $condiciones[] = "tipo_titulacion IN ('" . implode("','", $tipos) . "')";
}

// Filtrado por curso
if (!empty($_GET['curso'])) {
    $cursos = array_map('intval', $_GET['curso']);
    $condiciones[] = "curso IN (" . implode(",", $cursos) . ")";
}

// Filtrado por cuatrimestre
if (!empty($_GET['cuatrimestre'])) {
    $cuatris = array_map('intval', $_GET['cuatrimestre']);
    $condiciones[] = "cuatrimestre IN (" . implode(",", $cuatris) . ")";
}

// Añadir condiciones a la consulta si hay alguna
if (!empty($condiciones)) {
    $sql .= " AND " . implode(" AND ", $condiciones);
}

// Ejecutar la consulta final
$resultado = $conn_proa->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asignaturas</title>
    <link rel="icon" href="../../../imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/proaCSS/basePas.css" />
    <link rel="stylesheet" href="../../../css/proaCSS/estilos-pas-ap.css" />
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // POPUP GUARDADO/ERROR
            <?php if (isset($_GET['msg'])): ?>
                var popup = document.getElementById('popup-msg');
                var titulo = document.getElementById('popup-titulo');
                var texto = document.getElementById('popup-texto');
                <?php if ($_GET['msg'] === 'ok'): ?>
                    titulo.textContent = "¡Guardado correctamente!";
                    texto.textContent = "Se ha guardado correctamente tu selección.";
                <?php else: ?>
                    titulo.textContent = "Error";
                    texto.textContent = "Ha ocurrido un error al guardar los cambios.";
                <?php endif; ?>
                popup.classList.add('mostrar');
            <?php endif; ?>

            const filtrosForm = document.getElementById("form-filtros");
            if (filtrosForm) {
                filtrosForm.querySelectorAll("input[type=checkbox]").forEach(function (input) {
                    input.addEventListener("change", function () {
                        filtrosForm.submit();
                    });
                });
            }

            const input = document.getElementById("input-busqueda");
            const lista = document.getElementById("lista-asignaturas");
            if (input && lista) {
                function normalizarTexto(texto) {
                    return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                }

                input.addEventListener("input", function () {
                    const filtro = normalizarTexto(input.value);
                    const items = lista.querySelectorAll(".asignatura-item");

                    items.forEach(function (item) {
                        const texto = normalizarTexto(item.textContent || "");
                        item.style.display = texto.includes(filtro) ? "block" : "none";
                    });
                });
            }

            const botonBorrar = document.getElementById("boton-borrar");
            if (botonBorrar) {
                botonBorrar.addEventListener("click", function () {
                    window.location.href = window.location.pathname;
                });
            }
        });

        function redirigir(destino) {
            const seleccionada = document.querySelector('input[name="asignatura_seleccionada"]:checked');
            if (!seleccionada) {
                document.getElementById('popup-seleccion').style.display = 'flex';
                return;
            }
            const id = seleccionada.value;
            window.location.href = `${destino}?id=${encodeURIComponent(id)}`;
        }

        function cerrarPopupSeleccion() {
            document.getElementById('popup-seleccion').style.display = 'none';
        }

        function cerrarPopup() {
            document.getElementById('popup-msg').classList.remove('mostrar');
        }

        function toggleFiltros() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('activo');
            const botonFiltros = document.querySelector('.boton-filtros-mobile');
            botonFiltros.innerHTML = sidebar.classList.contains('activo')
                ? '<span>Ocultar filtros</span><img src="../../../imagenes/filtroBlanco.png" alt="Filtros" class="icono-filtros">'
                : '<span>Filtros</span><img src="../../../imagenes/filtroBlanco.png" alt="Filtros" class="icono-filtros">';
        }
    </script>
</head>

<body>
    <?php include '../../includes/proaInc/menuProa.inc'; ?>

    <!-- POPUP GUARDADO/ERROR -->
    <div class="popup-overlay" id="popup-msg">
        <div class="popup-contenido">
            <h2 id="popup-titulo"></h2>
            <p id="popup-texto"></p>
            <button class="boton-cerrar-popup" onclick="cerrarPopup()">Cerrar</button>
        </div>
    </div>

    <div class="contenedor-principal">
        <button class="boton-filtros-mobile" onclick="toggleFiltros()">
            <span>Filtros</span>
            <img src="../../../imagenes/filtroBlanco.png" alt="Filtros" class="icono-filtros">
        </button>

        <aside class="sidebar scrollbar">
            <h2 class="titulo-filtro">FILTRAR POR</h2>
            <button type="button" class="boton-limpiar" id="boton-borrar">Borrar todo</button>
            <form method="GET" action="" id="form-filtros">
                <div class="seccion-filtro">
                    <h3 class="subtitulo-filtro">Tipo</h3>
                    <div class="opcion-filtro">
                        <input type="checkbox" name="tipo_titulacion[]" value="Grado" id="tipo-grado"
                            <?= in_array("Grado", $_GET['tipo_titulacion'] ?? []) ? 'checked' : '' ?>>
                        <label for="tipo-grado">Grado</label>
                    </div>
                    <div class="opcion-filtro">
                        <input type="checkbox" name="tipo_titulacion[]" value="Doble Grado" id="tipo-doble"
                            <?= in_array("Doble Grado", $_GET['tipo_titulacion'] ?? []) ? 'checked' : '' ?>>
                        <label for="tipo-doble">Doble Grado</label>
                    </div>
                    <div class="opcion-filtro">
                        <input type="checkbox" name="tipo_titulacion[]" value="Master" id="tipo-master"
                            <?= in_array("Master", $_GET['tipo_titulacion'] ?? []) ? 'checked' : '' ?>>
                        <label for="tipo-master">Máster</label>
                    </div>
                </div>
                <div class="seccion-filtro">
                    <h3 class="subtitulo-filtro">Curso</h3>
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <div class="opcion-filtro">
                            <input type="checkbox" name="curso[]" value="<?= $i ?>" id="curso-<?= $i ?>"
                                <?= in_array((string) $i, $_GET['curso'] ?? []) ? 'checked' : '' ?>>
                            <label for="curso-<?= $i ?>"><?= $i ?>º</label>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="seccion-filtro">
                    <h3 class="subtitulo-filtro">Cuatrimestre</h3>
                    <?php for ($i = 1; $i <= 2; $i++): ?>
                        <div class="opcion-filtro">
                            <input type="checkbox" name="cuatrimestre[]" value="<?= $i ?>" id="cuatri-<?= $i ?>"
                                <?= in_array((string) $i, $_GET['cuatrimestre'] ?? []) ? 'checked' : '' ?>>
                            <label for="cuatri-<?= $i ?>"><?= $i ?>º</label>
                        </div>
                    <?php endfor; ?>
                </div>
            </form>
        </aside>

        <main class="contenido scrollbar">
            <div class="cabecera-tareas">
                <h1>Asignaturas</h1>
            </div>
            <div class="recuadro-asignaturas">
                <div class="barra-busqueda">
                    <input type="text" class="input-busqueda" placeholder="Nombre:" id="input-busqueda">
                    <img src="../../../imagenes/loupe.png" alt="Buscar" class="icono-busqueda">
                </div>
                <div class="bloque-asignaturas">
                    <div class="tarjeta">
                        <div class="contenido-tarjeta">
                            <form id="form-asignaturas">
                                <div class="lista-asignaturas scrollbar" id="lista-asignaturas">
                                    <?php
                                    if ($resultado && $resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) {
                                            echo "<div class='asignatura-item'>";
                                            echo "  <label class='asignatura-label'>";
                                            echo "    <input type='radio' name='asignatura_seleccionada' value='" . htmlspecialchars($fila['id_asignatura']) . "'>";
                                            echo "    <div class='info-asignatura'>";
                                            echo "      <div class='fila-info'><span class='titulo-info'>Nombre:</span><span class='valor-info'>" . htmlspecialchars($fila['nombre']) . "</span></div>";
                                            echo "      <div class='fila-info'><span class='titulo-info'>Código:</span><span class='valor-info'>" . htmlspecialchars($fila['codigo']) . "</span></div>";
                                            echo "      <div class='fila-info'><span class='titulo-info'>Titulación:</span><span class='valor-info'>" . htmlspecialchars($fila['tipo_titulacion']) . "</span></div>";
                                            echo "      <div class='fila-info'><span class='titulo-info'>Curso:</span><span class='valor-info'>" . htmlspecialchars($fila['curso']) . "</span></div>";
                                            echo "      <div class='fila-info'><span class='titulo-info'>Cuatrimestre:</span><span class='valor-info'>" . htmlspecialchars($fila['cuatrimestre']) . "</span></div>";
                                            echo "    </div>";
                                            echo "  </label>";
                                            echo "</div>";
                                        }
                                    } else {
                                        echo "<p>No se encontraron asignaturas.</p>";
                                    }
                                    $conn_proa->close();
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="botones-asignar">
                        <button type="button" class="boton-asignar" onclick="redirigir('PasProfesor.php')">
                            Asociar profesores
                        </button>
                        <button type="button" class="boton-asignar" onclick="redirigir('PasAlumnos.php')">
                            Asociar alumnos matriculados
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Popup de selección de asignatura -->
    <div id="popup-seleccion" class="popup-overlay">
        <div class="popup-contenido">
            <p>Por favor selecciona una asignatura primero.</p>
            <button onclick="cerrarPopupSeleccion()" class="boton-cerrar-popup">Cerrar</button>
        </div>
    </div>

    <?php include '../../includes/proaInc/footerProa.inc'; ?>
</body>

</html>