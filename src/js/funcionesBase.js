<<<<<<< Updated upstream:src/js/funcionesBase.js
document.addEventListener("DOMContentLoaded", () => {
    const botonSalir = document.getElementById("boton-cerrar-sesion");
    const popup = document.getElementById("popupCerrarSesion");
    const overlay = document.getElementById("fondo-popup");
    const botonSi = document.getElementById("btn-si");
    const botonNo = document.getElementById("btn-no");
=======
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
>>>>>>> Stashed changes:src/js/eduSyncJS/funcionesBaseEduSync.js

    botonNo.addEventListener("click", () => {
        popup.classList.add("oculto");
        overlay.classList.add("oculto");
    });

<<<<<<< Updated upstream:src/js/funcionesBase.js
        botonNo.addEventListener("click", () => {
            popup.classList.add("oculto");
            overlay.classList.add("oculto");
        });

        botonSi.addEventListener("click", () => {
            window.location.href = "../loginProa.php";
        });
    }
});
=======
    // El botón "Sí" ya tiene el atributo onclick en el HTML/PHP, así que NO pongas aquí ningún addEventListener para botonSi
}
>>>>>>> Stashed changes:src/js/eduSyncJS/funcionesBaseEduSync.js
