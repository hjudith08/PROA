<<<<<<< Updated upstream
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
=======
document.addEventListener("DOMContentLoaded", () => {
    const botonSalir = document.querySelector('[popovertarget="confirmar-cierre"]');
    const popup = document.getElementById("popupCerrarSesion");
    const fondoOscuro = document.getElementById("fondoOscuro");
    const botonSi = document.getElementById("btn-si");
    const botonNo = document.getElementById("btn-no");

    const menuUsuario = document.getElementById("menu-usuario");
    const menuHamburguesa = document.querySelector(".menu-movil");

    if (botonSalir) {
        botonSalir.addEventListener("click", () => {
            popup.classList.remove("oculto");
            fondoOscuro.classList.remove("oculto");
            document.body.style.overflow = "hidden";

            // Ocultar menús para que no se pueda interactuar con ellos
            if (menuUsuario) menuUsuario.style.display = "none";
            if (menuHamburguesa) menuHamburguesa.style.display = "none";
        });
    }

    function cerrarPopup() {
        popup.classList.add("oculto");
        fondoOscuro.classList.add("oculto");
        document.body.style.overflow = "auto";

        // Volver a mostrar los menús
        if (menuUsuario) menuUsuario.style.display = "";
        if (menuHamburguesa) menuHamburguesa.style.display = "";
    }

    botonSi.addEventListener("click", () => {
        cerrarPopup();
        window.location.href = "LoginProa.html";
    });

    botonNo.addEventListener("click", () => {
        cerrarPopup();
    });
});
>>>>>>> Stashed changes
