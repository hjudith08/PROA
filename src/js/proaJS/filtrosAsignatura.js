
    // Filtro tareas (select)
    const filtroSelect = document.getElementById('filtro-tareas');
    const filasTabla = document.querySelectorAll('.tabla-entregas tbody tr');

    if (filtroSelect) {
        filtroSelect.addEventListener('change', function() {
            const valorFiltro = this.value;

            filasTabla.forEach(fila => {
                const celdaNota = fila.querySelector('td:nth-child(3)');
                const textoNota = celdaNota ? celdaNota.textContent.trim() : '';

                switch(valorFiltro) {
                    case 'puntuadas':
                        // Mostrar si tiene '/' en texto (p.ej. "8/10")
                        fila.style.display = textoNota.includes('/') ? '' : 'none';
                        break;
                    case 'no-puntuadas':
                        // Mostrar si texto contiene "Sin puntuar"
                        fila.style.display = textoNota.includes('Sin puntuar') ? '' : 'none';
                        break;
                    default: // 'todos'
                        fila.style.display = '';
                }
            });
        });
    }

    // Filtro asignaturas (checkboxes)
    const cursoCheckboxes = document.querySelectorAll('.filtros-curso input[type="checkbox"]');
    const cuatriCheckboxes = document.querySelectorAll('.filtros-cuatrimestre input[type="checkbox"]');
    const filasAsignaturas = document.querySelectorAll('#asignaturas tbody tr');

    function filtrarAsignaturas() {
        // Obtenemos los valores seleccionados en cursos y cuatrimestres
        const cursosSeleccionados = Array.from(cursoCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        const cuatriSeleccionados = Array.from(cuatriCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        filasAsignaturas.forEach(fila => {
            const cursoFila = fila.getAttribute('data-curso');
            const cuatriFila = fila.getAttribute('data-cuatrimestre');

            // Comprobar que ambos valores están dentro de los seleccionados
            const mostrar = cursosSeleccionados.includes(cursoFila) && cuatriSeleccionados.includes(cuatriFila);
            fila.style.display = mostrar ? '' : 'none';
        });
    }

    if (cursoCheckboxes.length > 0 && cuatriCheckboxes.length > 0) {
        cursoCheckboxes.forEach(cb => cb.addEventListener('change', filtrarAsignaturas));
        cuatriCheckboxes.forEach(cb => cb.addEventListener('change', filtrarAsignaturas));

        // Ejecutamos filtro al cargar la página
        filtrarAsignaturas();
    }
