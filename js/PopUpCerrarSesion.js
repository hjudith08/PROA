// Función para mostrar el popup de confirmación al hacer clic en "Salir"
document.addEventListener('DOMContentLoaded', function() {
    const btnSalir = document.querySelector('#menu-usuario div button[popovertarget]');

    if (btnSalir) {
        btnSalir.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('popupCerrarSesion').style.display = 'block';
        });
    }
});

// Función para cerrar el popup
function cerrarPopup() {
    document.getElementById('popupCerrarSesion').style.display = 'none';
}

// Función para cerrar sesión (redirige al inicio de sesión)
function cerrarSesion() {
    window.location.href = "IniciarSesionPROA.html";
}