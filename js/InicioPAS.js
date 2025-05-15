// Datos de las asignaturas
const asignaturas = [
    { id: "13898", nombre: "Álgebra matricial y geometría", tipo: "grado", curso: 1, cuatrimestre: 1, selected: true },
    { id: "13924", nombre: "Desarrollo de un proyecto electrónico utilizando metodología CDIO", tipo: "doble-grado", curso: 2, cuatrimestre: 2, selected: false },
    { id: "13938", nombre: "Diseño de interfaces y experiencia de usuario", tipo: "grado", curso: 3, cuatrimestre: 1, selected: false },
    { id: "13923", nombre: "Electrónica básica", tipo: "grado", curso: 1, cuatrimestre: 2, selected: false },
    { id: "13922", nombre: "Fundamentos físicos", tipo: "master", curso: 1, cuatrimestre: 1, selected: false },
    { id: "13928", nombre: "Programación 1", tipo: "grado", curso: 2, cuatrimestre: 1, selected: false },
    { id: "13929", nombre: "Programación 2", tipo: "doble-grado", curso: 2, cuatrimestre: 2, selected: false },
    { id: "13949", nombre: "Proyecto diseño y programación Web", tipo: "grado", curso: 3, cuatrimestre: 2, selected: false },
    { id: "13933", nombre: "Redes y servicios telemáticos", tipo: "master", curso: 3, cuatrimestre: 1, selected: false }
];

// Cargar asignaturas al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    aplicarFiltros();
    configurarEventos();
});

// Función para cargar las asignaturas en la lista
function cargarAsignaturas(lista = asignaturas) {
    const listaHtml = document.getElementById('lista-asignaturas');
    listaHtml.innerHTML = '';

    lista.forEach(asignatura => {
        const item = document.createElement('div');
        item.className = 'item-asignatura';
        item.innerHTML = `
            <div>
                ${asignatura.selected ? 
                    '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>' : 
                    ''}
            </div>
            <div class="nombre-asignatura">${asignatura.id} ${asignatura.nombre}</div>
            <div style="margin-left: auto;">
                <input type="checkbox" ${asignatura.selected ? 'checked' : ''}>
            </div>
        `;
        listaHtml.appendChild(item);
    });
}

// Función para configurar los eventos
function configurarEventos() {
    // Filtros automáticos al cambiar cualquier checkbox
    document.querySelectorAll('.opcion-filtro input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', aplicarFiltros);
    });

    // Botón borrar todo
    const btnLimpiar = document.querySelector('.boton-limpiar');
    if (btnLimpiar) {
        btnLimpiar.addEventListener('click', function() {
            document.querySelectorAll('.opcion-filtro input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            aplicarFiltros();
        });
    }
}

// Función para aplicar los filtros
function aplicarFiltros() {
    // Filtros de tipo
    const tipos = [];
    if (document.getElementById('tipo-doble-grado')?.checked) tipos.push('doble-grado');
    if (document.getElementById('tipo-grado')?.checked) tipos.push('grado');
    if (document.getElementById('tipo-master')?.checked) tipos.push('master');

    // Filtros de curso
    const cursos = [];
    if (document.getElementById('curso-1')?.checked) cursos.push(1);
    if (document.getElementById('curso-2')?.checked) cursos.push(2);
    if (document.getElementById('curso-3')?.checked) cursos.push(3);

    // Filtros de cuatrimestre
    const cuatrimestres = [];
    if (document.getElementById('cuatrimestre-1')?.checked) cuatrimestres.push(1);
    if (document.getElementById('cuatrimestre-2')?.checked) cuatrimestres.push(2);

    // Filtrar asignaturas
    let filtradas = asignaturas.filter(a =>
        (tipos.length === 0 || tipos.includes(a.tipo)) &&
        (cursos.length === 0 || cursos.includes(a.curso)) &&
        (cuatrimestres.length === 0 || cuatrimestres.includes(a.cuatrimestre))
    );

    cargarAsignaturas(filtradas);
}