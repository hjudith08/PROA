<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROA | Inicio PAS</title>
    <link rel="icon" href="../../../imagenes/LogosProaBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../../css/estilo-inicio-pas.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../../../../imagenes/LogosProaBlanco.png" alt="Logo Proa" class="logo">
        </div>
        <h1 class="titulo-header">Asignaturas</h1>
        <div class="usuario">
            <span>¡Bienvenido [Nombre del Usuario]!</span>
            <a href="../loginProa.html"><img src="../../../../imagenes/user_1b.png" alt="Usuario" class="icono-usuario"></a>
        </div>
    </header>
    
    <!-- Contenedor principal -->
    <div class="contenedor-principal">
        <!-- Botón para móvil (nuevo) -->
        <button class="boton-filtros-mobile" onclick="toggleFiltros()">
            <span>Filtros</span>
            <img src="../../../../imagenes/pngwing.com.png" alt="Filtros" class="icono-filtros">
        </button>
        
        <!-- Sidebar -->
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
            <div class="barra-titulo">
                <h2 class="titulo-contenido">Asignaturas</h2>
            </div>
            <div class="recuadro-asignaturas">
                <div class="barra-busqueda">
                    <input type="text" class="input-busqueda" placeholder="Nombre:" id="input-busqueda">
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
                        <a href="pas-profesores.html" class="boton-accion">Asociar profesores</a>
                        <a href="pas-alumnos.html" class="boton-accion">Asociar alumnos matriculados</a>
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

    <script src="../../../js/InicioPAS.js"></script>
</body>
</html>