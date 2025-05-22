// ======================================
// FUNCIONALIDAD HEADER - MENÚ USUARIO
// ======================================

// Variables globales
const dropdownUsuario = document.getElementById('dropdownUsuario');
const imagenUsuario = document.querySelector('.imagenBotonHeader_edusync');
const popupCerrarSesion = document.getElementById('popupCerrarSesion');

// Mostrar/ocultar menú desplegable al hacer clic en el icono de usuario
imagenUsuario.addEventListener('click', function(e) {
    e.stopPropagation();
    const estaVisible = dropdownUsuario.style.display === 'block';
    dropdownUsuario.style.display = estaVisible ? 'none' : 'block';
});

// Ocultar menú al hacer clic fuera de él
document.addEventListener('click', function() {
    dropdownUsuario.style.display = 'none';
});

// Evitar que el menú se cierre al hacer clic dentro de él
dropdownUsuario.addEventListener('click', function(e) {
    e.stopPropagation();
});

// ======================================
// FUNCIONALIDAD POPUP CERRAR SESIÓN
// ======================================

// Mostrar popup de confirmación
function mostrarPopupCerrarSesion() {
    popupCerrarSesion.style.display = 'flex';
    dropdownUsuario.style.display = 'none'; // Ocultar dropdown al mostrar popup
}

// Ocultar popup
function ocultarPopupCerrarSesion() {
    popupCerrarSesion.style.display = 'none';
}

// Función para cerrar sesión (simulada)
function cerrarSesion() {
    // Aquí iría la lógica real de cierre de sesión
    console.log('Sesión cerrada');
    // Redirección a la página de login (ejemplo)
    window.location.href = '/login.html';
}

// Cerrar popup al hacer clic fuera del contenido
popupCerrarSesion.addEventListener('click', function(e) {
    if (e.target === popupCerrarSesion) {
        ocultarPopupCerrarSesion();
    }
});

// ======================================
// FUNCIONALIDAD BOTÓN CONTACTO
// ======================================

const enlaceContacto = document.querySelector('.enlaceContacto_edusync');

// Opcional: Si necesitas manejar el clic de contacto con JS
enlaceContacto.addEventListener('click', function(e) {
    // Comportamiento por defecto ya redirige a contacto.html
    // Aquí puedes añadir lógica adicional si es necesario
    console.log('Navegando a contacto');
    // Ejemplo: e.preventDefault(); si necesitas manejar la navegación manualmente
});

// ======================================
// INICIALIZACIÓN
// ======================================

document.addEventListener('DOMContentLoaded', function() {
    // Asegurar que los elementos están ocultos al cargar
    dropdownUsuario.style.display = 'none';
    popupCerrarSesion.style.display = 'none';
    
    // Otros inicializaciones que necesites...
});