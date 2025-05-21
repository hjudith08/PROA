document.addEventListener("DOMContentLoaded", () => {
    const botonSalir = document.getElementById("boton-cerrar-sesion");
    const popup = document.getElementById("popupCerrarSesion");
    const overlay = document.getElementById("fondo-popup");
    const botonSi = document.getElementById("btn-si");
    const botonNo = document.getElementById("btn-no");

    if (botonSalir && popup && overlay && botonSi && botonNo) {
        botonSalir.addEventListener("click", () => {
            popup.classList.remove("oculto");
            overlay.classList.remove("oculto");
        });

        botonNo.addEventListener("click", () => {
            popup.classList.add("oculto");
            overlay.classList.add("oculto");
        });

        botonSi.addEventListener("click", () => {
            window.location.href = "../loginProa.php";
        });
    }
});