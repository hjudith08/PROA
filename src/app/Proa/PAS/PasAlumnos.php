<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = new mysqli("localhost:3306", "jcivapo_proa", "proa1234!", "jcivapo_proa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$idAsignatura = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Construir consulta base para alumnos con filtro carrera_alumno
$sqlAlumnos = "SELECT dni, nombre, apellido1, apellido2 FROM usuarios WHERE rol_id = 'alumno'";

if (!empty($_GET['carrera_alumno'])) {
    // Escapar valores y preparar IN para filtro
    $carreras = array_map([$conexion, 'real_escape_string'], $_GET['carrera_alumno']);
    if (count($carreras) > 0) {
        $sqlAlumnos .= " AND carrera_alumno IN ('" . implode("','", $carreras) . "')";
    }
}

$resultadoAlumnos = $conexion->query($sqlAlumnos);

// Obtener alumnos ya asociados a esta asignatura
$sqlAsociados = "SELECT dni_alumno FROM alumnos_asignaturas WHERE id_asignatura = ?";
$stmt = $conexion->prepare($sqlAsociados);
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
    <link rel="icon" href="../../../../imagenes/LogosProaBlancoV3.png" type="image/png" />
    <link rel="stylesheet" href="../../../css/estilos-pas-ap.css" />
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../../../imagenes/LogosProaBlanco.png" alt="Logo Proa" class="logo" />
        </div>
        <div class="usuario">
            <span>¡Bienvenido [Nombre del Usuario]!</span>
            <a href="../loginProa.html"><img src="../../../../imagenes/user_1b.png" alt="Usuario" class="icono-usuario" /></a>
        </div>
    </header>

    <div class="contenedor-principal">
        <button class="boton-filtros-mobile" onclick="toggleFiltros()">
            <span>Filtros</span>
            <img src="../../../../imagenes/pngwing.com.png" alt="Filtros" class="icono-filtros" />
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
                    <img src="../../../../imagenes/loupe.png" alt="Buscar" class="icono-busqueda" />
                </div>

                <div class="bloque-asignaturas">
                    <div class="tarjeta">
                        <div class="contenido-tarjeta">
                            <form method="POST" action="asociarAlumnos.php">
                                <input type="hidden" name="id_asignatura" value="<?= htmlspecialchars($idAsignatura) ?>" />

                                <div class="lista-asignaturas scrollbar" id="lista-asignaturas">
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

    <footer>
        <span class="texto-footer">powered by</span>
        <div class="logo-footer">
            <img src="../../../../imagenes/LogoEduSyncBlanco.png" alt="Logo Proa" class="logofooter" />
        </div>
    </footer>

    <script>
        // buscador
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("input-busqueda");
            const lista = document.getElementById("lista-asignaturas");

            // hace que la busqueda no importe mayusculas, accentos etx
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
                    '<svg class="icono-filtro" viewBox="0 0 24 24" fill="none" stroke="currentColor">' +
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />' +
                    '</svg>';
            } else {
                botonFiltros.innerHTML = '<span>Filtros</span>' +
                    '<svg class="icono-filtro" viewBox="0 0 24 24" fill="none" stroke="currentColor">' +
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />' +
                    '</svg>';
            }
        }
    </script>
</body>
</html>
