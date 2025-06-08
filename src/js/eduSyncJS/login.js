// =============================================
// SECCIÓN 1: ELEMENTOS DEL DOM Y VARIABLES GLOBALES
// =============================================
const loginForm = document.getElementById("login-form");
const registroForm = document.getElementById("registro-form");
const registerBtn = document.getElementById("registrarse");
const loginBtn = document.getElementById("iniciar-sesion");
const contenedor = document.getElementById("contenedor");

// Array para almacenar los usuarios cargados
// =============================================
// SECCIÓN 2: FUNCIONES DE MANEJO DE MENSAJES
// =============================================
/**

 * Muestra un mensaje de error en el formulario activo
 * @param {string} mensaje - Mensaje de error a mostrar
 */
function mostrarError(mensaje) {
    eliminarMensajesAnteriores();

    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-mensaje';
    errorDiv.textContent = mensaje;

    if (loginForm.contains(document.activeElement)) {
        loginForm.appendChild(errorDiv);
    } else {
        registroForm.appendChild(errorDiv);
    }

    setTimeout(() => errorDiv.remove(), 3000);
}

/**
 * Muestra un mensaje de éxito/informativo en el formulario activo
 * @param {string} mensaje - Mensaje a mostrar
 */
function mostrarMensaje(mensaje) {
    eliminarMensajesAnteriores();

    const mensajeDiv = document.createElement('div');
    mensajeDiv.className = 'exito-mensaje';
    mensajeDiv.textContent = mensaje;

    if (loginForm.contains(document.activeElement)) {
        loginForm.appendChild(mensajeDiv);
    } else {
        registroForm.appendChild(mensajeDiv);
    }

    setTimeout(() => mensajeDiv.remove(), 3000);
}

/**
 * Elimina todos los mensajes de error/éxito previos
 */
function eliminarMensajesAnteriores() {
    const mensajes = document.querySelectorAll('.error-mensaje, .exito-mensaje');
    mensajes.forEach(e => e.remove());
}

// CAMBIO ENTRE FORMULARIOS

loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    contenedor.classList.add("panel-derecho-activo");
});

registerBtn.addEventListener("click", (e) => {
    e.preventDefault();
    contenedor.classList.remove("panel-derecho-activo");
});

// Detectar si hay un error en la URL y forzar vista de login

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('error')) {
    contenedor.classList.add("panel-derecho-activo");
}


/* validacion del registro*/

registroForm.addEventListener("submit", function (e) {
    const password = document.getElementById("passwordRegistro").value;
    const confirmPassword = document.getElementById("confirmar-password").value;

    console.log("Validando contraseñas...");
    console.log(`Password: "${password}"`);
    console.log(`Confirm: "${confirmPassword}"`);

    if (password !== confirmPassword) {
        console.log("Error: Las contraseñas no coinciden");
        e.preventDefault();
        mostrarError("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");

        // Resaltar campos
        const passwordFields = document.querySelectorAll("#passwordRegistro, #confirmar-password");
        passwordFields.forEach(field => {
            field.style.borderColor = "#dc3545";
            field.addEventListener('input', function () {
                this.style.borderColor = "";
            }, { once: true });
        });

        document.getElementById("password").focus();
    } else {
        console.log("Contraseñas coinciden - formulario puede enviarse");
    }
});

