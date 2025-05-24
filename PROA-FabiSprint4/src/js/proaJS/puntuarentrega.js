document.addEventListener('DOMContentLoaded', () => {
    const botones = document.querySelectorAll('.boton-revisar');
    const popup = document.getElementById('popup');
    const tituloEl = document.getElementById('popup-titulo');
    const estudianteEl = document.getElementById('popup-estudiante');
    const descargarBtn = document.getElementById('boton-descargar');
    const notaInput = document.getElementById('nota');
    const puntuarBtn = document.querySelector('.puntuar-boton');
    const entregaIdInput = document.getElementById('entrega-id');

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

            // Mostrar nota si existe
            notaInput.value = nota;

            // Configurar descarga
            if (archivo) {
                descargarBtn.onclick = () => window.open(archivo, '_blank');
                descargarBtn.disabled = false;
            } else {
                descargarBtn.onclick = null;
                descargarBtn.disabled = true;
            }

            popup.classList.remove('oculto');
        });
    });

    puntuarBtn.addEventListener('click', () => {
        const entregaId = entregaIdInput.value;
        const nota = notaInput.value.trim();

        // Validar nota
        if (nota === '' || isNaN(nota) || nota < 0 || nota > 10) {
            alert('Por favor, introduce una nota válida entre 0 y 10.');
            return;
        }

        // Enviar AJAX para guardar la nota
        fetch('guardarNota.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_entrega=${encodeURIComponent(entregaId)}&nota=${encodeURIComponent(nota)}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Nota guardada correctamente.');

                    // Actualizar la tabla visible
                    const boton = Array.from(botones).find(b => b.getAttribute('data-id') === entregaId);
                    if (boton) {
                        boton.setAttribute('data-nota', nota);
                        // Actualizamos la celda correspondiente (puedes modificarlo para que se actualice mejor)
                        const fila = boton.closest('tr');
                        const celdaNota = fila.querySelector('td:nth-child(3)');
                        celdaNota.textContent = parseFloat(nota).toFixed(1) + ' / 10';
                    }
                    cerrarPopup();
                } else {
                    alert('Error al guardar la nota: ' + (data.message || 'Error desconocido.'));
                }
            })
            .catch(() => alert('Error al comunicarse con el servidor.'));
    });
});

function cerrarPopup() {
    document.getElementById('popup').classList.add('oculto');
}
