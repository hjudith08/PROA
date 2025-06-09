document.addEventListener('DOMContentLoaded', () => {
    const botones = document.querySelectorAll('.boton-revisar');
    const popup = document.getElementById('popup');
    const tituloEl = document.getElementById('popup-titulo');
    const estudianteEl = document.getElementById('popup-estudiante');
    const descargarBtn = document.getElementById('boton-descargar');
    const notaInput = document.getElementById('nota');
    const puntuarBtn = document.querySelector('.puntuar-boton');
    const entregaIdInput = document.getElementById('entrega-id');
    const archivoEl = document.getElementById('popup-archivo');

    // Abrir popup y rellenar datos
    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            const titulo = boton.getAttribute('data-titulo') || 'Tarea';
            const estudiante = boton.getAttribute('data-estudiante') || 'Estudiante';
            const archivo = boton.getAttribute('data-archivo');
            const nota = boton.getAttribute('data-nota') || '';
            const entregaId = boton.getAttribute('data-id');

            tituloEl.textContent = titulo;
            estudianteEl.textContent = estudiante;
            entregaIdInput.value = entregaId;
            notaInput.value = nota;

            const nombreArchivo = archivo ? archivo.split('/').pop() : 'No hay archivo';
            archivoEl.textContent = nombreArchivo;

            if (archivo) {
                const rutaDescarga = '../../../../docs/uploads/' + archivo;
                descargarBtn.onclick = () => window.open(rutaDescarga, '_blank');
                descargarBtn.disabled = false;
            } else {
                descargarBtn.onclick = null;
                descargarBtn.disabled = true;
            }

            popup.classList.remove('oculto');
        });
    });

    // Guardar nota
puntuarBtn.addEventListener('click', () => {
    const entregaId = entregaIdInput.value;
    const nota = notaInput.value.trim();

    // Validación más clara y segura
    const notaNum = parseFloat(nota);
    if (nota === '' || isNaN(notaNum) || notaNum < 0 || notaNum > 10) {
        alert('Por favor, introduce una nota válida entre 0 y 10.');
        return;
    }

    fetch('guardarNota.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id_entrega=${encodeURIComponent(entregaId)}&nota=${encodeURIComponent(notaNum)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Nota guardada correctamente.');

            // Actualiza el botón y la celda correspondiente
            const boton = Array.from(botones).find(b => b.getAttribute('data-id') === entregaId);
            if (boton) {
                boton.setAttribute('data-nota', notaNum);
                const fila = boton.closest('tr');
                if (fila) {
                    const celdaNota = fila.querySelector('td:nth-child(3)');
                    if (celdaNota) {
                        celdaNota.textContent = notaNum.toFixed(1) + ' / 10';
                    }
                }
            }

            cerrarPopup();
        } else {
            alert('Error al guardar la nota: ' + (data.message || 'Error desconocido.'));
        }
    })
    .catch(() => {
        alert('Error al comunicarse con el servidor.');
    });
});


    // Cerrar popup al hacer clic fuera
    window.addEventListener('click', (e) => {
        if (e.target === popup) {
            cerrarPopup();
        }
    });

    // Función global para cerrar
    window.cerrarPopup = function () {
        if (popup) {
            popup.classList.add('oculto');
        }
    };
});
