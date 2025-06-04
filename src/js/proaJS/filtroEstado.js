const filtroEstado = document.getElementById('filtro-tareas-estado');
if (filtroEstado) {
    filtroEstado.addEventListener('change', e => {
        const sel = e.target.value;
        document.querySelectorAll('tbody .fila').forEach(f => {
            f.style.display = (sel === 'todas' || f.dataset.estado === sel) ? '' : 'none';
        });
    });

    document.querySelectorAll('tbody .fila').forEach(f => {
        f.style.cursor = 'pointer';
        f.onclick = () => {
            location.href = `verTarea.php?id_tarea=${f.dataset.id}&dni=${encodeURIComponent(dniAlumno)}`;
        };
    });

    const dir = {};
    const ths = document.querySelectorAll('th.sortable');
    ths.forEach(th => {
        dir[th.dataset.sort] = 1;
        th.onclick = () => sortTable(th);
    });

    function parseDate(s) {
        const [dd, mm, yy] = s.split('/');
        return new Date(`${yy}-${mm}-${dd}`).getTime();
    }

    function sortTable(th) {
        const key = th.dataset.sort;
        const asc = dir[key];
        const idx = [...th.parentNode.children].indexOf(th);
        const filas = [...document.querySelectorAll('tbody tr')].sort((a, b) => {
            let va = a.children[idx].innerText.trim();
            let vb = b.children[idx].innerText.trim();

            if (key === 'apertura' || key === 'entrega') {
                va = parseDate(va);
                vb = parseDate(vb);
            } else {
                va = va.toLowerCase();
                vb = vb.toLowerCase();
            }

            return (va > vb ? 1 : -1) * asc;
        });

        dir[key] *= -1;

        const tbody = document.querySelector('tbody');
        filas.forEach(row => tbody.appendChild(row));

        ths.forEach(h => h.querySelector('.flecha').textContent = '');
        th.querySelector('.flecha').textContent = asc === 1 ? '▲' : '▼';
    }
}
