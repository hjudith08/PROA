<div class="tabla-flex-container">
    <div class="card-content">
        <form class="form" id="taskForm" action="editarTareaBD.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_tarea" value="<?= htmlspecialchars($tarea['id_tarea'] ?? '') ?>">
            <input type="hidden" name="id_asignatura" value="<?= htmlspecialchars($tarea['id_asignatura'] ?? $_GET['id']) ?>">

            <!-- Título tarea -->
            <label class="form-label" for="taskTitle">Título tarea:</label>
            <input class="input-date" type="text" name="titulo" value="<?= htmlspecialchars($tarea['titulo'] ?? '') ?>" required>

            <!-- Descripción de la tarea -->
            <div class="form-row">
                <label class="descripcionTarea" for="taskDescription">Descripción de la tarea:</label>
                <textarea class="textarea" name="descripcion"><?= htmlspecialchars($tarea['descripcion'] ?? '') ?></textarea>
            </div>

            <!-- Selector de rango de fechas -->
            <label class="form-label" for="dateRange">Fecha apertura y entrega:</label>
            <input type="text" id="dateRange" class="input-text" placeholder="Selecciona el rango" required />

            <!-- Campos ocultos que se envían al backend -->
            <input type="hidden" name="fecha_apertura" id="fechaApertura" value="<?= htmlspecialchars($tarea['fecha_apertura'] ?? '') ?>">
            <input type="hidden" name="fecha_entrega" id="fechaEntrega" value="<?= htmlspecialchars($tarea['fecha_entrega'] ?? '') ?>">

            <!-- Adjuntar archivos -->
            <label class="form-label" for="taskFile">Adjuntar archivos:</label>
            <div class="file-input-wrapper">
                <input type="file" class="file-input" id="taskFile" name="archivo_adjunto" />
                <button type="button" class="file-input-button" onclick="document.getElementById('taskFile').click();">
                    <span>Subir archivo</span>
                </button>
            </div>

            <?php if (!empty($tarea['archivo_adjunto'])): ?>
                <div class="archivo-actual">
                    <p>Archivo actual: 
                        <a href="../../../../../docs/uploads/tareas/<?= htmlspecialchars($tarea['archivo_adjunto']) ?>" target="_blank">
                            <?= htmlspecialchars($tarea['archivo_adjunto']) ?>
                        </a>
                    </p>
                </div>
            <?php endif; ?><br>

            <!-- Puntuación -->
            <label class="form-label" for="taskScore">Puntuación sobre:</label>
            <input class="input-date" type="number" name="puntuacion_maxima" value="<?= htmlspecialchars($tarea['puntuacion_maxima'] ?? '') ?>" required>

            <!-- Botón enviar -->
            <div class="submit-button">
                <button type="submit">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
