<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// conexion al servidor
$conexion = new mysqli("localhost:3306", "jcivapo_proa", "proa1234!", "jcivapo_proa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

/* consulta base de datos todas las asignaturas, 1=1
se usa para evitar problemas de sintaxis al construir 
dinámicamente la cláusula WHERE en PHP */
$sql = "SELECT * FROM asignaturas WHERE 1=1";

// array para almacenar condiciones (filtros)
$condiciones = [];

// fFiltrado por tipo de titulación
if (!empty($_GET['tipo_titulacion'])) {
    $tipos = array_map([$conexion, 'real_escape_string'], $_GET['tipo_titulacion']);
    $condiciones[] = "tipo_titulacion IN ('" . implode("','", $tipos) . "')";
}

// filtrado por curso
if (!empty($_GET['curso'])) {
    $cursos = array_map('intval', $_GET['curso']);
    $condiciones[] = "curso IN (" . implode(",", $cursos) . ")";
}

// filtrado por cuatrimestre
if (!empty($_GET['cuatrimestre'])) {
    $cuatris = array_map('intval', $_GET['cuatrimestre']);
    $condiciones[] = "cuatrimestre IN (" . implode(",", $cuatris) . ")";
}

// añadir condiciones a la consulta si hay alguna
if (!empty($condiciones)) {
    $sql .= " AND " . implode(" AND ", $condiciones);
}

// ejecutar la consulta final
$resultado = $conexion->query($sql);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asignaturas</title>
    <link rel="icon" href="../../../../imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/estilos-pas-ap.css">
    <script>
        // Cuando se cambie un checkbox, se envía el formulario automáticamente
        document.addEventListener("DOMContentLoaded", function() {
            const filtrosForm = document.getElementById("form-filtros");
            filtrosForm.querySelectorAll("input[type=checkbox]").forEach(function(input) {
                input.addEventListener("change", function() {
                    filtrosForm.submit();
                });
            });
        });
    </script>
</head>
<body>
    <!-- header -->
    <header>
        <!-- logo -->
        <div class="logo">
            <a href="PasInicio.php"><img src="../../../../imagenes/LogosProaBlanco.png" alt="Logo Proa" class="logo"></a>
        </div>
        <!-- mostrar el nombre del usuario que ha iniciado sesión -->
        <div class="usuario">
            <span>¡Bienvenido [Nombre del Usuario]!</span>
            <a href="../loginProa.html"><img src="../../../../imagenes/user_1b.png" alt="Usuario" class="icono-usuario"></a>
        </div>
    </header>
    
    <!-- contenedor principal donde va a ir toda el contenido -->
    <div class="contenedor-principal">
        <!-- boton toggle que va a aparecer solo en version movil -->
        <button class="boton-filtros-mobile" onclick="toggleFiltros()">
            <span>Filtros</span>
            <img src="../../../../imagenes/pngwing.com.png" alt="Filtros" class="icono-filtros">
        </button>

    <!-- sidebar donde se encuentran los filtros -->
    <aside class="sidebar scrollbar">
        <h2 class="titulo-filtro">FILTRAR POR</h2>
        <!-- botón borrar todo que sirve para borrar los checkbox seleccionados -->
        <button type="button" class="boton-limpiar" id="boton-borrar">Borrar todo</button>
        
        <!-- filtro con formulario para obtener los datos de la base de datos y poder usar los filtros -->
        <form method="GET" action="" id="form-filtros">
            <div class="seccion-filtro">
                <!-- filtramos por carrera -->
                <h3 class="subtitulo-filtro">Tipo</h3>

                <!-- checkboxs para el filtro obteniendo de la base de datos -->
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
                            <?= in_array((string)$i, $_GET['curso'] ?? []) ? 'checked' : '' ?>>
                        <label for="curso-<?= $i ?>"><?= $i ?>º</label>
                    </div>
                <?php endfor; ?>
            </div>

            <div class="seccion-filtro">
                <h3 class="subtitulo-filtro">Cuatrimestre</h3>
                <?php for ($i = 1; $i <= 2; $i++): ?>
                    <div class="opcion-filtro">
                        <input type="checkbox" name="cuatrimestre[]" value="<?= $i ?>" id="cuatri-<?= $i ?>"
                            <?= in_array((string)$i, $_GET['cuatrimestre'] ?? []) ? 'checked' : '' ?>>
                        <label for="cuatri-<?= $i ?>"><?= $i ?>º</label>
                    </div>
                <?php endfor; ?>
            </div>
        </form>
    </aside>
    <!-- fin del menu aside filtros -->

    <!-- contenido de los profesores -->
    <main class="contenido scrollbar">
        <div class="cabecera-tareas">
            <h1>Asignaturas</h1>
        </div>
        <div class="recuadro-asignaturas">
            <!-- barra de busqueda -->
            <div class="barra-busqueda">
                <input type="text" class="input-busqueda" placeholder="Nombre:" id="input-busqueda">
                <img src="../../../../imagenes/loupe.png" alt="Buscar" class="icono-busqueda">
            </div>

            <!-- aqui se muestran todas las asignaturas -->
            <div class="bloque-asignaturas">
                <div class="tarjeta">
                    <div class="contenido-tarjeta">
                        <form method="POST" action="procesarSeleccion.php">
                            <div class="lista-asignaturas scrollbar" id="lista-asignaturas">
                                <!-- aqui es donde se muestra la lista de asignaturas -->
                                <?php
                                if ($resultado && $resultado->num_rows > 0) {
                                    while ($fila = $resultado->fetch_assoc()) {
                                        echo "<div class='asignatura-item'>";
                                        echo "<label>";
                                        echo "<input type='radio' name='asignatura_seleccionada' value='" . htmlspecialchars($fila['id_asignatura']) . "'>";
                                        echo "<strong>Nombre:</strong> " . htmlspecialchars($fila['nombre']) . "<br>";
                                        echo "<strong>Código:</strong> " . htmlspecialchars($fila['codigo']) . "<br>";
                                        echo "<strong>Titulación:</strong> " . htmlspecialchars($fila['tipo_titulacion']) . "<br>";
                                        echo "<strong>Curso:</strong> " . htmlspecialchars($fila['curso']) . "<br>";
                                        echo "<strong>Cuatrimestre:</strong> " . htmlspecialchars($fila['cuatrimestre']);
                                        echo "</label></div>";
                                    }
                                } else {
                                    echo "<p>No se encontraron asignaturas.</p>";
                                }
                                $conexion->close();
                                ?>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="botones-accion">
                    <button type="button" class="boton-accion" onclick="redirigir('PasProfesor.php')">Asociar profesores</button>
                    <button type="button" class="boton-accion" onclick="redirigir('PasAlumnos.php')">Asociar alumnos matriculados</button>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- footer -->
<footer>
    <span class="texto-footer">powered by</span>
    <div class="logo-footer">
        <img src="../../../../imagenes/LogoEduSyncBlanco.png" alt="Logo Proa" class="logofooter">
    </div>
</footer>

<script>
    //buscador
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
            const items = lista.querySelectorAll(".asignatura-item");

            items.forEach(function (item) {
                const texto = normalizarTexto(item.textContent || "");
                item.style.display = texto.includes(filtro) ? "block" : "none";
            });
        });
    });

    //sidebar
    const boton = document.getElementById("toggle-filtro");
    const sidebar = document.querySelector(".sidebar");

    boton.addEventListener("click", () => {
        sidebar.classList.toggle("oculto");
        if(sidebar.classList.contains("oculto")) {
            boton.textContent = "Mostrar filtro";
        } else {
            boton.textContent = "Ocultar filtro";
        }
    });

   // boton borrar filtros
    document.getElementById("boton-borrar").addEventListener("click", function () {
        window.location.href = window.location.pathname;
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

    // por si se selecciona uno de los botones sin haber seleccionado una asignatura
    function redirigir(destino) {
        const seleccionada = document.querySelector('input[name="asignatura_seleccionada"]:checked');
        if (!seleccionada) {
            alert("Por favor selecciona una asignatura primero.");
            return;
        }
        const id = seleccionada.value;
        window.location.href = `${destino}?id=${encodeURIComponent(id)}`;
    }

</script>

</body>
</html>