<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asignaturas</title>
    <link rel="icon" href="../../../../imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/estilos-pas-ap.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../../../../imagenes/LogosProaBlanco.png" alt="Logo Proa" class="logo">
        </div>
        <div class="usuario">
            <span>¡Bienvenido [Nombre del Usuario]!</span>
            <a href="../loginProa.html"><img src="../../../../imagenes/user_1b.png" alt="Usuario" class="icono-usuario"></a>
        </div>
    </header>
    
    <!-- Contenedor principal -->
    <div class="contenedor-principal">
        <!-- Sidebar -->
         <button class="boton-filtros-mobile" onclick="toggleFiltros()">
            <span>Filtros</span>
            <img src="../../../../imagenes/pngwing.com.png" alt="Filtros" class="icono-filtros">
        </button>
        
        <aside class="sidebar scrollbar">
            <h2 class="titulo-filtro">FILTRAR POR</h2>
            <button class="boton-limpiar">Borrar todo</button>
            
            <!-- Filtro por tipo -->
            <div class="seccion-filtro">
                <h3 class="subtitulo-filtro">Tipo</h3>
                <div class="opcion-filtro">
                    <input type="checkbox" id="tipo-doble-grado">
                    <label for="tipo-doble-grado">Doble Grado</label>
                </div>
                <div class="opcion-filtro">
                    <input type="checkbox" id="tipo-grado">
                    <label for="tipo-grado">Grado</label>
                </div>
                <div class="opcion-filtro">
                    <input type="checkbox" id="tipo-master">
                    <label for="tipo-master">Master</label>
                </div>
            </div>
            
            <!-- Filtro por curso -->
            <div class="seccion-filtro">
                <h3 class="subtitulo-filtro">Curso</h3>
                <div class="opcion-filtro">
                    <input type="checkbox" id="curso-1">
                    <label for="curso-1">1º</label>
                </div>
                <div class="opcion-filtro">
                    <input type="checkbox" id="curso-2">
                    <label for="curso-2">2º</label>
                </div>
                <div class="opcion-filtro">
                    <input type="checkbox" id="curso-3">
                    <label for="curso-3">3º</label>
                </div>
            </div>
            
            <!-- Filtro por cuatrimestre -->
            <div class="seccion-filtro">
                <h3 class="subtitulo-filtro">Cuatrimestre</h3>
                <div class="opcion-filtro">
                    <input type="checkbox" id="cuatrimestre-1">
                    <label for="cuatrimestre-1">1º</label>
                </div>
                <div class="opcion-filtro">
                    <input type="checkbox" id="cuatrimestre-2">
                    <label for="cuatrimestre-2">2º</label>
                </div>
            </div>
        </aside>
        
        <!-- Contenido principal -->
        <main class="contenido scrollbar">
    
        <div class="cabecera-tareas">
            <h1>Profesores</h1>
        </div>
        <div class="recuadro-asignaturas">
        <!-- Aquí va el resto de tu contenido principal -->
        <div class="barra-busqueda">
    <input type="text" class="input-busqueda" placeholder="Nombre:">
    <img src="../../../../imagenes/loupe.png" alt="Buscar" class="icono-busqueda">
</div>
<div class="bloque-asignaturas">
    <div class="tarjeta">
        <div class="contenido-tarjeta">
            <div class="lista-asignaturas scrollbar" id="lista-asignaturas">
                <!-- Las asignaturas se cargarán aquí con JavaScript -->
            </div>
        </div>
    </div>
    <div class="botones-accion">
         <a href="PasInicio.php" id="inicio PAS" class="boton-accion">Editar</a>
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

    <script src="/PROA/src/js/profesPAS.js"></script>

<script>
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

</script>

</body>
</html>