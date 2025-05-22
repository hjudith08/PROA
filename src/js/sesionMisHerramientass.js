// ======================================
// FUNCIONALIDAD HEADER - MENÚ USUARIO
// ======================================

document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const dropdownUsuario = document.getElementById('dropdownUsuario');
    const imagenUsuario = document.querySelector('.imagenBotonHeader_edusync');
    const popupCerrarSesion = document.getElementById('popupCerrarSesion');
    const enlaceContacto = document.querySelector('.enlaceContacto_edusync');

    // ======================================
    // MENÚ DESPLEGABLE DEL USUARIO
    // ======================================
    
    // Mostrar/ocultar menú al hacer clic en el icono de usuario
    if (imagenUsuario && dropdownUsuario) {
        imagenUsuario.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleDropdown();
        });
    }

    // Función para alternar la visibilidad del dropdown
    function toggleDropdown() {
        const estaVisible = window.getComputedStyle(dropdownUsuario).display === 'block';
        dropdownUsuario.style.display = estaVisible ? 'none' : 'block';
    }

    // Ocultar menú al hacer clic fuera de él
    document.addEventListener('click', function(e) {
        if (dropdownUsuario && !dropdownUsuario.contains(e.target) && e.target !== imagenUsuario) {
            dropdownUsuario.style.display = 'none';
        }
    });

    // ======================================
    // POPUP DE CERRAR SESIÓN
    // ======================================
    
    // Mostrar popup de confirmación
    window.mostrarPopupCerrarSesion = function() {
        if (popupCerrarSesion) {
            popupCerrarSesion.style.display = 'flex';
            if (dropdownUsuario) {
                dropdownUsuario.style.display = 'none';
            }
        }
    };

    // Ocultar popup
    window.ocultarPopupCerrarSesion = function() {
        if (popupCerrarSesion) {
            popupCerrarSesion.style.display = 'none';
        }
    };

    // Función para cerrar sesión
    window.cerrarSesion = function() {
        // Aquí iría la lógica real de cierre de sesión
        console.log('Sesión cerrada - Redirigiendo...');
        // Ejemplo de redirección:
        window.location.href = '/login.html';
    };

    // Cerrar popup al hacer clic fuera del contenido
    if (popupCerrarSesion) {
        popupCerrarSesion.addEventListener('click', function(e) {
            if (e.target === popupCerrarSesion) {
                ocultarPopupCerrarSesion();
            }
        });
    }

    // ======================================
    // BOTÓN DE CONTACTO
    // ======================================
    
    if (enlaceContacto) {
        enlaceContacto.addEventListener('click', function(e) {
            // Comportamiento por defecto ya redirige a contacto.html
            console.log('Navegando a contacto');
            // Puedes añadir aquí tracking o lógica adicional si es necesario
        });
    }

    // ======================================
    // INICIALIZACIÓN
    // ======================================
    
    // Asegurar que los elementos están ocultos al cargar
    if (dropdownUsuario) dropdownUsuario.style.display = 'none';
    if (popupCerrarSesion) popupCerrarSesion.style.display = 'none';
});