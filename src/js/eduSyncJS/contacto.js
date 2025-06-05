// =============================================
// SECCIÓN 1: ELEMENTOS DEL DOM
// =============================================
const contactoForm = document.getElementById("formulario-contacto");

// =============================================
// SECCIÓN 2: FUNCIONES DE MANEJO DE MENSAJES
// =============================================
/**
 * Muestra un mensaje de éxito en el formulario de contacto
 * @param {string} mensaje - Mensaje a mostrar
 */
function mostrarMensajeExito(mensaje) {
    eliminarMensajesAnteriores();

    const mensajeDiv = document.createElement('div');
    mensajeDiv.className = 'exito-mensaje';
    mensajeDiv.textContent = mensaje;

    contactoForm.parentNode.insertBefore(mensajeDiv, contactoForm);

    setTimeout(() => {
        mensajeDiv.style.opacity = '0';
        setTimeout(() => mensajeDiv.remove(), 300);
    }, 3000);
}

/**
 * Elimina todos los mensajes de error/éxito previos
 */
function eliminarMensajesAnteriores() {
    const mensajes = document.querySelectorAll('.exito-mensaje');
    mensajes.forEach(e => e.remove());
}

// =============================================
// SECCIÓN 3: MANEJADORES DE EVENTOS - CONTACTO
// =============================================
if (contactoForm) {
    contactoForm.addEventListener("submit", function(e) {
        e.preventDefault();
        
        // Simular envío del formulario
        mostrarMensajeExito("¡Tu solicitud se ha enviado correctamente! Responderemos pronto.");
        
        // Opcional: Resetear el formulario después de mostrar el mensaje
        setTimeout(() => {
            contactoForm.reset();
        }, 1000);
    });
}