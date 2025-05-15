document.addEventListener("DOMContentLoaded", () => {
    const botonSalir = document.querySelector('[popovertarget="confirmar-cierre"]');
    const popup = document.getElementById("popupCerrarSesion");
    const botonSi = document.getElementById("btn-si");
    const botonNo = document.getElementById("btn-no");

    if (botonSalir) {
        botonSalir.addEventListener("click", () => {
            popup.classList.remove("oculto");
        });
    }

    botonSi.addEventListener("click", () => {
        window.location.href = "LoginProa.html";
    });

    botonNo.addEventListener("click", () => {
        popup.classList.add("oculto");
    });
});
