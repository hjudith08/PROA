<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// conexion al servidor
include __DIR__ . '../../../includes/conexion.inc';

// id guardado de la pagina de inicio para mostrar los alumnos de la asignatura que tenga ese id
$idAsignatura = isset($_GET['id']) ? intval($_GET['id']) : 0;

// consulta base de datos para alumnos con filtro
$sqlAlumnos = "SELECT dni, nombre, apellido1, apellido2 FROM usuarios WHERE rol_id = 'alumno'";

if (!empty($_GET['carrera_alumno'])) {
    $carreras = array_map([$conn_proa, 'real_escape_string'], $_GET['carrera_alumno']);
    if (count($carreras) > 0) {
        $sqlAlumnos .= " AND carrera_alumno IN ('" . implode("','", $carreras) . "')";
    }
}

// ejecutar la consulta final
$resultadoAlumnos = $conn_proa->query($sqlAlumnos);

// obtener alumnos ya asociados a esta asignatura
$sqlAsociados = "SELECT dni_alumno FROM alumnos_asignaturas WHERE id_asignatura = ?";
$stmt = $conn_proa->prepare($sqlAsociados);
$stmt->bind_param("i", $idAsignatura);
$stmt->execute();
$resultadoAsociados = $stmt->get_result();

$alumnosAsociados = [];
while ($fila = $resultadoAsociados->fetch_assoc()) {
    $alumnosAsociados[] = $fila['dni_alumno'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Asignaturas - Alumnos</title>
    <!-- imagen de pestaña -->
    <link rel="icon" href="../../../imagenes/LogosProaBlancoV3.png" type="image/png">
        <link rel="stylesheet" href="../../../css/proaCSS/basePas.css">
    <link rel="stylesheet" href="../../../css/proaCSS/estilos-pas-ap.css" />
    <script src="../../../js/proaJS/funcionesBase.js" defer></script>
</head>
<body>
    <!-- Header de Proa (móvil y ordenador) -->
    <?php include '../../includes/proaInc/menuProa.inc'; ?>

    <!-- contenedor principal donde va a ir toda el contenido -->
     
    <div class="contenedor-principal">
        <!-- boton toggle que va a aparecer solo en version movil -->
        <button class="boton-filtros-mobile" onclick="toggleFiltros()">
            <span>Filtros</span>
            <img src="../../../imagenes/filtroBlanco.png" alt="Filtros" class="icono-filtros" />
        </button>

        <!-- sidebar donde se encuentran los filtros -->
        <aside class="sidebar scrollbar">
            <h2 class="titulo-filtro">FILTRAR POR</h2>
            <!-- botón borrar todo que sirve para borrar los checkbox seleccionados -->
            <button class="boton-limpiar" id="boton-borrar">Borrar todo</button>

            <!-- filtro con formulario para obtener los datos de la base de datos y poder usar los filtros -->
            <form method="GET" action="" id="form-filtros">
                <input type="hidden" name="id" value="<?= htmlspecialchars($idAsignatura) ?>" />
                <div class="seccion-filtro">
                    <!-- filtramos por carrera -->
                    <h3 class="subtitulo-filtro">Carrera</h3>

                    <!-- checkboxs para el filtro obteniendo de la base de datos -->
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
        <!-- fin del menu aside filtros -->

        <!-- contenido de los alumnos -->
        <main class="contenido scrollbar">
            <div class="cabecera-tareas">
                <h1>Alumnos</h1>
            </div>
            <div class="recuadro-asignaturas">
                <!-- barra de busqueda -->
                <div class="barra-busqueda">
                    <input type="text" class="input-busqueda" placeholder="Nombre:" id="input-busqueda" />
                    <img src="../../../imagenes/loupe.png" alt="Buscar" class="icono-busqueda" />
                </div>

                <!-- aqui se muestran todos los alumnos -->
                <div class="bloque-asignaturas">
                    <div class="tarjeta">
                        <div class="contenido-tarjeta">
                            <!-- el form hace que una vez editado los alumnos de la asignatura te lleva a otro documento
                             php que es el que se encarga de añadir o eliminar un alumno de la asignatura -->
                            <form method="POST" action="asociarAlumnos.php">
                                <input type="hidden" name="id_asignatura" value="<?= htmlspecialchars($idAsignatura) ?>" />
                                <div class="lista-asignaturas scrollbar" id="lista-asignaturas">
                                    <!-- aqui es donde se muestra la lista de alumnos -->
                                    <?php
                                    if ($resultadoAlumnos && $resultadoAlumnos->num_rows > 0) {
                                        while ($alumno = $resultadoAlumnos->fetch_assoc()) {
                                            $dni = $alumno['dni'];
                                            $checked = in_array($dni, $alumnosAsociados) ? 'checked' : '';
                                            echo "<div class='tarjeta-profesor'>";
                                            echo "<input type='checkbox' name='alumnos[]' value='" . htmlspecialchars($dni) . "' $checked>";
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

                                <div class="botones-accion">
                                    <button type="submit" class="boton-accion">Guardar cambios</button>
                                    <a href="PasInicio.php" class="boton-accion">Volver</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<!-- Footer de Proa -->
<?php include '../../includes/proaInc/footerProa.inc'; ?>

    <script>
        // buscador
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("input-busqueda");
            const lista = document.getElementById("lista-asignaturas");

            // hace que la busqueda no importe mayusculas, accentos etc
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
        });

        // que al seleccionar un checkbox se actualize automaticamente
        document.querySelectorAll('#form-filtros input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                document.getElementById('form-filtros').submit();
            });
        });

        // boton borrar filtros
        document.getElementById('boton-borrar').addEventListener('click', () => {
            window.location.href = window.location.pathname + "?id=<?= htmlspecialchars($idAsignatura) ?>";
        });

        // toggle filtros móvil
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
