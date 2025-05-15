// Lista de profesores
const profesores = [
    { nombre: "Ana López", departamento: "Grado en Ciencias Ambientales", selected: true },
    { nombre: "Carlos García", departamento: "Grado en Comunicación Audiovisual", selected: false },
    { nombre: "Lucía Martínez", departamento: "Grado en Tecnologías Interactivas", selected: false },
    { nombre: "Pedro Sánchez", departamento: "Grado en Ingeniería de Sistemas de Telecomunicación", selected: true },
    { nombre: "Marta Díaz", departamento: "Grado en Ciencias Ambientales", selected: false },
    { nombre: "Javier Torres", departamento: "Grado en Comunicación Audiovisual", selected: false },
    { nombre: "Martín Fernandez", departamento: "Grado en Comunicación Audiovisual", selected: false }
];

// Cargar al iniciar
document.addEventListener("DOMContentLoaded", () => {
    aplicarFiltros();
    configurarEventos();
    document.querySelector('.input-busqueda').addEventListener('input', aplicarFiltros);
});

function cargarProfesores(lista = profesores) {
    const contenedor = document.getElementById("lista-asignaturas");
    contenedor.innerHTML = '';

    lista.forEach(profesor => {
        const item = document.createElement("div");
        item.className = "item-asignatura";
        item.innerHTML = `
            <div>
            </div>
            <div class="nombre-asignatura">${profesor.nombre}</div>
            <div style="margin-left: auto;">
                <input type="checkbox" ${profesor.selected ? 'checked' : ''}>
            </div>
        `;
        contenedor.appendChild(item);
    });
}

function configurarEventos() {
    document.querySelectorAll(".opcion-filtro input[type='checkbox']").forEach(cb => {
        cb.addEventListener("change", aplicarFiltros);
    });

    const btnLimpiar = document.querySelector(".boton-limpiar");
    if (btnLimpiar) {
        btnLimpiar.addEventListener("click", () => {
            document.querySelectorAll(".opcion-filtro input[type='checkbox']").forEach(cb => cb.checked = false);
            aplicarFiltros();
        });
    }
}

function aplicarFiltros() {
    const checkboxes = document.querySelectorAll(".opcion-filtro input[type='checkbox']");
    const seleccionados = Array.from(checkboxes).filter(cb => cb.checked);
    const departamentos = seleccionados.map(cb => cb.nextElementSibling.textContent.trim());

    // Obtener y normalizar el texto de búsqueda (sin acentos y en minúsculas)
    const textoBusqueda = document.querySelector('.input-busqueda').value
        .trim()
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");


    let filtrados = profesores;

    // Filtrar por departamento si hay alguno seleccionado
    if (departamentos.length > 0) {
        filtrados = filtrados.filter(p => departamentos.includes(p.departamento));
    }

    // Filtrar por nombre
    if (textoBusqueda !== '') {
        filtrados = filtrados.filter(p => 
        p.nombre.toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .includes(textoBusqueda)
        );
    }

    cargarProfesores(filtrados);
}

