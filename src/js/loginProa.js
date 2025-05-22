// =============================================
// SECCIÓN 1: DECLARACIÓN DE VARIABLES Y ELEMENTOS DEL DOM
// =============================================
const loginForm = document.getElementById("login");
const loginBtn = document.getElementById("iniciar-sesion");

// Array para almacenar usuarios cargados
let usuarios = [];

// =============================================
// SECCIÓN 2: FUNCIONES DE CARGA DE DATOS
// =============================================
/**
 * Carga los usuarios desde el archivo JSON
 * @async
 * @throws {Error} Si hay un problema al cargar los datos
 */
async function cargarUsuarios() {
    try {
        const response = await fetch('../../api/v0.0/data/usuariosProa.json');
        if (!response.ok) throw new Error("Respuesta no válida del servidor");
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
 * Muestra un mensaje de error en el formulario
 * @param {string} mensaje - Mensaje de error a mostrar
 */
function mostrarError(mensaje) {
    eliminarMensajesAnteriores();

    const errorDiv = document.createElement('div');
    errorDiv.className = 'mensaje error-mensaje';
    errorDiv.textContent = mensaje;

    loginForm.appendChild(errorDiv);
    setTimeout(() => errorDiv.remove(), 3000);
}

/**
 * Muestra un mensaje de éxito en el formulario
 * @param {string} mensaje - Mensaje a mostrar
 */
function mostrarMensaje(mensaje) {
    eliminarMensajesAnteriores();

    const mensajeDiv = document.createElement('div');
    mensajeDiv.className = 'mensaje exito-mensaje';
    mensajeDiv.textContent = mensaje;

    loginForm.appendChild(mensajeDiv);
    setTimeout(() => mensajeDiv.remove(), 3000);
}

/**
 * Elimina todos los mensajes existentes del formulario
 */
function eliminarMensajesAnteriores() {
    const mensajes = document.querySelectorAll('.mensaje');
    mensajes.forEach(e => e.remove());
}

// =============================================
// SECCIÓN 4: MANEJADOR DE LOGIN (FUNCIÓN PRINCIPAL)
// =============================================
loginForm.addEventListener("submit", async function(e) {
    e.preventDefault();

    // Obtener y limpiar los valores del formulario
    const email = loginForm.querySelector("#email").value.trim();
    const password = loginForm.querySelector("#password").value.trim(); 

    // Cargar usuarios disponibles
    await cargarUsuarios();

    // Buscar coincidencia de usuario
    const usuario = usuarios.find(u => u.email === email && u.password === password);

    if (usuario) {
        // Mostrar mensaje de éxito
        mostrarMensaje("Inicio de sesión exitoso. Redirigiendo...");

        // Guardar sesión en localStorage
        localStorage.setItem("usuarioActivo", usuario.email);

        // Redirigir según el rol del usuario
        setTimeout(() => {
            switch(usuario.rol) {
                case "pas":
                    window.location.href = "PAS/inicioPas.html";
                    break;
                case "alumno":
                    window.location.href = "Alumno/InicioGeneralAlumno.html";
                    break;
                case "profesor":
                    window.location.href = "Profesor/inicioGeneralProfesor(sergi).html";
                    break;
                default:
                    console.error("Rol de usuario no reconocido");
            }
        }, 500);
    } else {
        mostrarError("Email o contraseña incorrectos");
    }
});