<div class="tabla-flex-container">
    <div class="card-content">
        <form class="form" id="taskForm" action="editarTareaBD.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_tarea" value="<?= htmlspecialchars($tarea['id_tarea'] ?? '') ?>">
        <input type="hidden" name="id_asignatura" value="<?= htmlspecialchars($tarea['id_asignatura'] ?? $_GET['id']) ?>">
        
            <!-- Programar tarea para -->
            <label class="form-label" for="scheduleDate">Programar tarea para:</label>
            <div class="input-date-wrapper">
               <input class="input-date" type="date" name="fecha_apertura" value="<?= htmlspecialchars($tarea['fecha_apertura'] ?? '') ?>" required>
            </div>
        
            <!-- Título tarea -->
            <label class="form-label" for="taskTitle">Título tarea:</label>
            <input class="input-date" type="text" name="titulo" value="<?= htmlspecialchars($tarea['titulo'] ?? '') ?>" required>

            <!-- Descripción de la tarea -->
            <div class="form-row">
                <label class="descripcionTarea" for="taskDescription">Descripción de la tarea:</label>
                <textarea class="textarea" name="descripcion"><?= htmlspecialchars($tarea['descripcion'] ?? '') ?></textarea>
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
                <input class="input-date" type="date" name="fecha_entrega" value="<?= htmlspecialchars($tarea['fecha_entrega'] ?? '') ?>" required>
            </div>

            <!-- Puntuación sobre -->
            <label class="form-label" for="taskScore">Puntuación sobre:</label>
            <input class="input-date" type="number" name="puntuacion_maxima" value="<?= htmlspecialchars($tarea['puntuacion_maxima'] ?? '') ?>" required>

            <!-- Submit button -->
            <div class="submit-button">
                <button type="submit">EDITAR</button>
            </div>
        </form>
    </div>
</div>