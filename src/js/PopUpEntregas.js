document.addEventListener('DOMContentLoaded', function () {
    const botones = document.querySelectorAll('.boton-revisar');
    const popup = document.getElementById('popup');
    const tituloEl = document.getElementById('popup-titulo');
    const estudianteEl = document.getElementById('popup-estudiante');

    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            const titulo = boton.getAttribute('data-titulo');
            const estudiante = boton.getAttribute('data-estudiante');
            tituloEl.textContent = titulo;
            estudianteEl.textContent = estudiante;
            popup.classList.remove('oculto');
        });
    });
});

function cerrarPopup() {
    document.getElementById('popup').classList.add('oculto');
}
