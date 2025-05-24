document.addEventListener('DOMContentLoaded', function() {
    const filtroSelect = document.getElementById('filtro-tareas');
    const filasTabla = document.querySelectorAll('.tabla-entregas tbody tr');

    filtroSelect.addEventListener('change', function() {
        const valorFiltro = this.value;

        filasTabla.forEach(fila => {
            const celdaNota = fila.querySelector('td:nth-child(3)');
            const textoNota = celdaNota.textContent.trim();

            switch(valorFiltro) {
                case 'puntuadas':
                    fila.style.display = textoNota.includes('/') ? '' : 'none';
                    break;
                case 'no-puntuadas':
                    fila.style.display = textoNota.includes('Sin puntuar') ? '' : 'none';
                    break;
                default: // 'todos'
                    fila.style.display = '';
            }
        });
    });
});