<main class="content">
    <button class="hamburguesa" aria-label="Abrir menú">☰</button>
    <nav class="menu-movil">
        <ul>
            <li>
                <a href="#">
                    <img src="images/homeb.png" alt="Inicio" />
                    Inicio General
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="images/bookb.png" alt="Asignaturas" />
                    Asignaturas
                </a>
            </li>
        </ul>
    </nav>
    <div class="contenedor-flex-principal">

        <!-- IZQUIERDA: Información Asignatura -->
        <div class="contenedor-tareas">
            <div class="cabecera-tareas">
                <h1>INFORMACIÓN ASIGNATURA</h1>
            </div>
            <div class="tabla-flex-container">
                <ul class="asignaturas">
                    <li class="fila-objetivo">
                        <div class="encabezado-item">
                            <h3>Objetivo asignatura</h3>
                            <button class="editar">Editar</button>
                        </div>
                        <div class="texto-desplegable">
                            Este curso tiene como objetivo introducir los fundamentos del álgebra lineal y el cálculo diferencial.
                        </div>
                    </li>
                    <li class="fila-objetivo">
                        <div class="encabezado-item">
                            <h3>Datos profesor</h3>
                            <button class="editar">Editar</button>
                        </div>
                        <div class="texto-desplegable">
                            Prof. Juan Pérez - juan.perez@proa.edu - Oficina 204
                        </div>
                    </li>
                    <li class="fila-objetivo">
                        <div class="encabezado-item">
                            <h3>Extra</h3>
                            <button class="editar">Editar</button>
                        </div>
                        <div class="texto-desplegable">
                            Material de apoyo disponible en la plataforma virtual. Clases grabadas cada viernes.
                        </div>
                    </li>
                </ul>

            </div>
        </div>

        <!-- DERECHA: Lista de Tareas -->
        <div class="contenedor-tareas">
            <div class="cabecera-tareas">
                <h1>TAREAS</h1>
            </div>
            <div class="tabla-flex-container">
                <ul class="tareas">
                    <li>
                        <div>
                            <p class="texto-lista-tareas">Análisis forense</p>
                            <div class="encabezado-item">
                                <div class="rectangulo-fecha">20 MAYO</div>
                                <div class="botonesEditaryVer">
                                    <button class="editar" onclick="window.location.href='EditarTarea.html'">Editar entrega</button>
                                    <button class="editar" onclick="window.location.href='VerEntregas.html'">Ver entregas</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <p class="texto-lista-tareas">Docker Compose</p>
                            <div class="encabezado-item">
                                <div class="rectangulo-fecha">25 MAYO</div>
                                <div class="botonesEditaryVer">
                                    <button class="editar" onclick="window.location.href='EditarTarea.html'">Editar entrega</button>
                                    <button class="editar" onclick="window.location.href='VerEntregas.html'">Ver entregas</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <p class="texto-lista-tareas">Análisis de funciones y estudio de sus gráficos</p>
                            <div class="encabezado-item">
                                <div class="rectangulo-fecha">25 MAYO</div>
                                <div class="botonesEditaryVer">
                                    <button class="editar" onclick="window.location.href='EditarTarea.html'">Editar entrega</button>
                                    <button class="editar" onclick="window.location.href='VerEntregas.html'">Ver entregas</button>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>

    </div>
</main>