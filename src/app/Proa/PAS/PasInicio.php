<?php
$conexion = new mysqli("localhost:3306", "jcivapo_proa", "proa1234!", "jcivapo_proa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM asignaturas WHERE 1=1";
$condiciones = [];

if (!empty($_GET['tipo_titulacion'])) {
    $tipos = array_map([$conexion, 'real_escape_string'], $_GET['tipo_titulacion']);
    $condiciones[] = "tipo_titulacion IN ('" . implode("','", $tipos) . "')";
}

if (!empty($_GET['curso'])) {
    $cursos = array_map('intval', $_GET['curso']);
    $condiciones[] = "curso IN (" . implode(",", $cursos) . ")";
}

if (!empty($_GET['cuatrimestre'])) {
    $cuatris = array_map('intval', $_GET['cuatrimestre']);
    $condiciones[] = "cuatrimestre IN (" . implode(",", $cuatris) . ")";
}

if (!empty($condiciones)) {
    $sql .= " AND " . implode(" AND ", $condiciones);
}

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
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="PasInicio.php"><img src="../../../../imagenes/LogosProaBlanco.png" alt="Logo Proa" class="logo"></a>
        </div>
        <div class="usuario">
            <span>¡Bienvenido [Nombre del Usuario]!</span>
            <a href="../loginProa.html"><img src="../../../../imagenes/user_1b.png" alt="Usuario" class="icono-usuario"></a>
        </div>
    </header>
    
    <!-- Contenedor principal -->
 <div class="contenedor-principal">
    <button class="boton-filtros-mobile" onclick="toggleFiltros()">
        <span>Filtros</span>
        <img src="../../../../imagenes/pngwing.com.png" alt="Filtros" class="icono-filtros">
    </button>

    <!-- Sidebar con filtros -->
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

    <!-- Contenido principal -->
    <main class="contenido scrollbar">
        <div class="cabecera-tareas">
            <h1>Asignaturas</h1>
        </div>

        <div class="recuadro-asignaturas">
            <div class="barra-busqueda">
                <input type="text" class="input-busqueda" placeholder="Nombre:" id="input-busqueda">
                <img src="../../../../imagenes/loupe.png" alt="Buscar" class="icono-busqueda">
            </div>

            <div class="bloque-asignaturas">
                <div class="tarjeta">
                    <div class="contenido-tarjeta">
                        <form method="POST" action="procesarSeleccion.php">
                            <div class="lista-asignaturas scrollbar" id="lista-asignaturas">
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

<!-- Footer -->
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

        function normalizarTexto(texto) {
            return texto
                .normalize("NFD")               // separar acentos
                .replace(/[\u0300-\u036f]/g, "") // eliminar acentos
                .toLowerCase();                 // convertir a minúsculas
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

    // Botón borrar filtros que recarga la página sin parámetros GET excepto id asignatura
    document.getElementById("boton-borrar").addEventListener("click", function () {
        window.location.href = window.location.pathname;
    });

    function toggleFiltros() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('activo');
        
        
        // Ajustar el botón cuando los filtros están visibles
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

    //por si se selecciona uno de los botones sin haber seleccionado una asignatura
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