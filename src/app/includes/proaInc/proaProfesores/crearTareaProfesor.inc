<div class="tabla-flex-container">
    <div class="card-content">
        <form class="form" id="taskForm" action="crearTareaBD.php" method="POST" enctype="multipart/form-data">
            <!-- Programar tarea para -->
            <label class="form-label" for="scheduleDate">Programar tarea para:</label>
            <div class="input-date-wrapper">
               <input type="date" class="input-date" id="scheduleDate" name="fecha_apertura" required />
            </div>
        
            <!-- Título tarea -->
            <label class="form-label" for="taskTitle">Título tarea:</label>
            <input type="text" class="input-text" id="taskTitle" name="titulo" placeholder="Ingrese el título" required />

            <!-- Descripción de la tarea -->
            <div class="form-row">
                <label class="descripcionTarea" for="taskDescription">Descripción de la tarea:</label>
                <textarea class="textarea" id="taskDescription" name="descripcion" placeholder="Describa la tarea aquí" required></textarea>
            </div>

            <!-- Adjuntar archivos -->
            <label class="form-label" for="taskFile">Adjuntar archivos:</label>
            <div class="file-input-wrapper">
                <input type="file" class="file-input" id="taskFile" name="archivo_adjunto" />
                <button type="button" class="file-input-button" onclick="document.getElementById('taskFile').click();">
                    <span>Subir archivo</span>
                </button>
            </div>

            <!-- Fecha entrega -->
            <label class="form-label" for="dueDate">Fecha entrega:</label>
            <div class="input-date-wrapper">
                <input type="date" class="input-date" id="dueDate" name="fecha_entrega" required />
            </div>

            <!-- Puntuación sobre -->
            <label class="form-label" for="taskScore">Puntuación sobre:</label>
            <input type="number" class="input-text" id="taskScore" name="puntuacion_maxima" placeholder="10" min="1" required />

            <!-- Submit button -->
            <div class="submit-button">
                <button type="submit">CREAR</button>
            </div>
        </form>
    </div>
</div>