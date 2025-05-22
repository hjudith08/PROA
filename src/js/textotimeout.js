document.addEventListener("DOMContentLoaded", function () {
    const botonEnviar = document.getElementById("btn-enviar");
    const mensaje = document.getElementById("mensaje-subida");

    botonEnviar.addEventListener("click", function () {
        mensaje.style.display = "block";

        // Opcional: Ocultar el mensaje después de 3 segundos
        setTimeout(() => {
            mensaje.style.display = "none";
        }, 3000);
    });
});
