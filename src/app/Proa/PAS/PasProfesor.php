<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = new mysqli("localhost:3306", "jcivapo_proa", "proa1234!", "jcivapo_proa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$idAsignatura = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sqlProfesores = "SELECT * FROM usuarios WHERE rol_id = 'profesor'";

if (!empty($_GET['departamento_profesor'])) {
    $valores = array_map([$conexion, 'real_escape_string'], $_GET['departamento_profesor']);
    if (count($valores) > 0) {
        $sqlProfesores .= " AND departamento_profesor IN ('" . implode("','", $valores) . "')";
    }
}

$resultadoProfesores = $conexion->query($sqlProfesores);

$sqlAsociados = "SELECT dni_profesor FROM profesores_asignaturas WHERE id_asignatura = ?";
$stmt = $conexion->prepare($sqlAsociados);
$stmt->bind_param("i", $idAsignatura);
$stmt->execute();
$resultadoAsociados = $stmt->get_result();

$profesoresAsociados = [];
while ($fila = $resultadoAsociados->fetch_assoc()) {
    $profesoresAsociados[] = $fila['dni_profesor'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Asignaturas</title>
    <link rel="icon" href="../../../../imagenes/LogosProaBlancoV3.png" type="image/png" />
    <link rel="stylesheet" href="../../../css/estilos-pas-ap.css" />
</head>
<body>
    <header>
        <div class="logo">
            <a href="PasInicio.php"><img src="../../../../imagenes/LogosProaBlanco.png" alt="Logo Proa" class="logo" /></a>
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
            <button type="button" class="boton-limpiar" id="boton-borrar">Borrar todo</button>
            <form method="GET" action="" id="form-filtros">
                <input type="hidden" name="id" value="<?= htmlspecialchars($idAsignatura) ?>">
                <div class="seccion-filtro">
                    <h3 class="subtitulo-filtro">Departamento</h3>

                    <div class="opcion-filtro">
                        <input type="checkbox" name="departamento_profesor[]" value="Informática" id="informatica"
                            <?= in_array("Informática", $_GET['departamento_profesor'] ?? []) ? 'checked' : '' ?> />
                        <label for="informatica">Informática</label>
                    </div>

                    <div class="opcion-filtro">
                        <input type="checkbox" name="departamento_profesor[]" value="Matemáticas" id="matematicas"
                            <?= in_array("Matemáticas", $_GET['departamento_profesor'] ?? []) ? 'checked' : '' ?> />
                        <label for="matematicas">Matemáticas</label>
                    </div>

                    <div class="opcion-filtro">
                        <input type="checkbox" name="departamento_profesor[]" value="Física" id="fisica"
                            <?= in_array("Física", $_GET['departamento_profesor'] ?? []) ? 'checked' : '' ?> />
                        <label for="fisica">Física</label>
                    </div>
                </div>
                <!-- Quitamos botón aplicar filtro porque no será necesario -->
            </form>
        </aside>

        <main class="contenido scrollbar">
            <div class="cabecera-tareas">
                <h1>Profesores</h1>
            </div>
            <div class="recuadro-asignaturas">
                <div class="barra-busqueda">
                    <input type="text" class="input-busqueda" placeholder="Nombre:" id="input-busqueda">
                    <img src="../../../../imagenes/loupe.png" alt="Buscar" class="icono-busqueda">
                </div>

                <div class="bloque-asignaturas">
                    <div class="tarjeta">
                        <div class="contenido-tarjeta">
                            <form method="POST" action="asociarProfesores.php">
                                <input type="hidden" name="id_asignatura" value="<?= htmlspecialchars($idAsignatura) ?>" />

                                <div class="lista-asignaturas scrollbar" id="lista-asignaturas">
                                    <?php
                                    if ($resultadoProfesores && $resultadoProfesores->num_rows > 0) {
                                        while ($profesor = $resultadoProfesores->fetch_assoc()) {
                                            $dni = $profesor['dni'];
                                            $checked = in_array($dni, $profesoresAsociados) ? 'checked' : '';
                                            echo "<div class='tarjeta-profesor'>";
                                            echo "<input type='checkbox' name='profesores[]' value='" . htmlspecialchars($dni) . "' $checked />";
                                            echo "<span class='nombre-profesor'>" . htmlspecialchars($profesor['nombre']) . " " . htmlspecialchars($profesor['apellido1']) . " " . htmlspecialchars($profesor['apellido2']) . "</span>";
                                            echo "<span class='dni-profesor'>(" . htmlspecialchars($dni) . ")</span>";
                                            echo "</div>";
                                        }
                                    } else {
                                        echo "<div class='tarjeta-profesor'>No hay profesores disponibles.</div>";
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
        //buscador
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("input-busqueda");
            const lista = document.getElementById("lista-asignaturas");

            function normalizarTexto(texto) {
                return texto
                    .normalize("NFD")               // separar acentos
                    .replace(/[\u0300-\u036f]/g, "") // eliminar acentos
                    .toLowerCase();                 // convertir a minúsculas
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

        // Función para enviar el formulario de filtros automáticamente al cambiar cualquier checkbox
        document.querySelectorAll('#form-filtros input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                document.getElementById('form-filtros').submit();
            });
        });

        // Botón borrar filtros que recarga la página sin parámetros GET excepto id asignatura
        document.getElementById("boton-borrar").addEventListener("click", function () {
            window.location.href = window.location.pathname + "?id=<?= htmlspecialchars($idAsignatura) ?>";
        });

        //sidebar
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
