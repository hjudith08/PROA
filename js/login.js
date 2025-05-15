// =============================================
// SECCIÓN 1: ELEMENTOS DEL DOM Y VARIABLES GLOBALES
// =============================================
const loginForm = document.getElementById("login-form");
const registroForm = document.getElementById("registro-form");
const registerBtn = document.getElementById("registrarse");
const loginBtn = document.getElementById("iniciar-sesion");
const contenedor = document.getElementById("contenedor");

// Array para almacenar los usuarios cargados
let usuarios = [];

// =============================================
// SECCIÓN 2: FUNCIONES DE CARGA DE DATOS
// =============================================
/**
 * Carga los usuarios desde el archivo JSON
 * @async
 */
async function cargarUsuarios() {
    try {
        const response = await fetch('../../api/v0.0/data/usuariosEduSync.json');
        usuarios = await response.json();
    } catch (error) {
        console.error("Error cargando usuarios:", error);
        mostrarError("Error al cargar la base de datos");
    }
}

// =============================================
// SECCIÓN 3: FUNCIONES DE MANEJO DE MENSAJES
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

// =============================================
// SECCIÓN 4: MANEJADORES DE EVENTOS - LOGIN
// =============================================
loginForm.addEventListener("submit", async function(e) {
    e.preventDefault();

    const email = loginForm.querySelector("#email").value;
    const password = loginForm.querySelector("#password").value;

    await cargarUsuarios();

    const usuario = usuarios.find(u => u.email === email && u.password === password);

    if (usuario) {
        mostrarMensaje("Inicio de sesión exitoso. Redirigiendo...");

        // Guardar email en localStorage (opcional)
        localStorage.setItem("usuarioActivo", usuario.email);

        setTimeout(() => {
            window.location.href = "index.html";
        }, 500);
    } else {
        mostrarError("Email o contraseña incorrectos");
    }
});

// =============================================
// SECCIÓN 5: MANEJADORES DE EVENTOS - REGISTRO
// =============================================
registroForm.addEventListener("submit", async function(e) {
    e.preventDefault();

    const email = registroForm.querySelector("#email").value;
    const password = registroForm.querySelector("#password").value;

    await cargarUsuarios();

    if (usuarios.some(u => u.email === email)) {
        mostrarError("Este email ya está registrado");
        return;
    }

    if (password.length < 4) {
        mostrarError("La contraseña debe tener al menos 4 caracteres");
        return;
    }

    // Mostrar confirmación de registro exitoso
    mostrarMensaje("Registro exitoso");

    registroForm.reset();

    setTimeout(() => {
        contenedor.classList.remove("panel-derecho-activo");
    }, 2000);
});

// =============================================
// SECCIÓN 6: MANEJADORES DE INTERFAZ - CAMBIO ENTRE FORMULARIOS
// =============================================
registerBtn.addEventListener("click", (e) => {
    e.preventDefault();
    contenedor.classList.add("panel-derecho-activo");
});

loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    contenedor.classList.remove("panel-derecho-activo");
});
