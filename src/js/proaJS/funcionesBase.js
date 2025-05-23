/* PopUp para cerrar Sesion*/

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


/* selector de perfil web*/ 
function redirectToView(select) {
    const value = select.value;
    if (!value) return;

    switch(value) {
        case 'alumno':
            window.location.href = '../profeAlumno/inicioGeneral.php?rol=alumno';
            break;
        case 'profesor':
            window.location.href = '../profeAlumno/inicioGeneral.php?rol=profesor';
            break;
        case 'pas':
            window.location.href = '../pas/inicioPas.php';
            break;
    }
}

/* selector de perfil login*/ 
function seleccionDeVista(select) {
    const value = select.value;
    if (!value) return;
    
    switch(value) {
        case 'alumno':
            window.location.href = 'profeAlumno/inicioGeneral.php?rol=alumno';
            break;
        case 'profesor':
            window.location.href = 'profeAlumno/inicioGeneral.php?rol=profesor';
            break;
        case 'pas':
            window.location.href = 'pas/inicioPas.php';
            break;
    }
}