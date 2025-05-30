/* PopUp para cerrar Sesion*/

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

/* selector de perfil desde páginas internas como inicioGeneral o PasInicio */
function redirectToView(select) {
    const rol = select.value;
    if (!rol) return;

    // Corregido: ir a autologin.php relativo a páginas internas (subir un nivel)
    window.location.href = '../autologin.php?rol=' + rol;
}

/* selector de perfil desde loginProa */
function seleccionDeVista(select) {
    const rol = select.value;
    if (!rol) return;

    // Corregido: ir a autologin.php relativo a loginProa
    window.location.href = 'autologin.php?rol=' + rol;
}
