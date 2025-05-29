    <!--Aquí empiezan los filtros-->
    <div class="contenedor-tareasAlumno">
    <div class="contenedor-filtros">
            <select id="filtro-tareas-estado">
                <option value="todas">Todas las tareas</option>
                <option value="completado">Tareas completadas</option>
                <option value="pendiente">Tareas pendientes</option>
            </select>
    </div>
    <!--Aquí terminan los filtros-->

    <table>
        <!--Aquí empieza el encabezado de la tabla-->
        <thead class="encabezado-tabla-tareasAlumno">
            <tr class="fila"> <!--Esto es una fila de la tabla-->
                <th class="nombre-tarea-encabezado">Nombre Tarea</th>
                <th class="estado-tarea">Estado</th>
                <th class="fecha-apertura">Fecha de apertura</th>
                <th class="fecha-entrega">Fecha de entrega</th>
                <th class="calificacion-encabezado">Calificación</th>
            </tr>
        </thead>
         <!--Aquí termina el encabezado de la tabla-->
        <!--Aquí empieza el contenido-->
        <tbody>
            <tr class="fila">
                <td class="nombre-tarea">Sprint 4</td>
                <td class="estado-tarea">Pendiente</td>
                <td class="fecha-apertura">20/05/2025</td>
                <td class="fecha-entrega">30/05/2025</td>
                <td class="calificacion">-</td>
            </tr>

            <tr class="fila">
                <td class="nombre-tarea">Sprint 3</td>
                <td class="estado-tarea">Completada</td>
                <td class="fecha-apertura">30/04/2025</td>
                <td class="fecha-entrega">17/05/2025</td>
                <td class="calificacion">6.5</td>
            </tr>

            <tr class="fila">
                <td class="nombre-tarea">Sprint 2</td>
                <td class="estado-tarea">Completada</td>
                <td class="fecha-apertura">10/04/2025</td>
                <td class="fecha-entrega">27/04/2025</td>
                <td class="calificacion">3</td>
            </tr>
        </tbody>
    </table>
    </div>