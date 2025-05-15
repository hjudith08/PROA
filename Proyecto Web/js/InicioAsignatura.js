    document.querySelectorAll('.asignaturas li').forEach(item => {
    item.addEventListener('click', () => {
        const texto = item.querySelector('.texto-desplegable');
        if (texto) {
            texto.style.display = (texto.style.display === 'block') ? 'none' : 'block';
        }
    });
});

