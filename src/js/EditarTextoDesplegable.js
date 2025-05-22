document.addEventListener("DOMContentLoaded", () => {
    const botones = document.querySelectorAll(".boton-revisar");

    botones.forEach(boton => {
        boton.addEventListener("click", () => {
            const li = boton.closest(".fila-objetivo");
            const contenedorTexto = li.querySelector(".texto-desplegable");

            if (boton.textContent === "Guardar") {
                const textarea = li.querySelector("textarea");
                const nuevoTexto = textarea.value.trim();
                contenedorTexto.textContent = nuevoTexto;
                contenedorTexto.style.display = "block";
                textarea.remove();
                boton.textContent = "Editar";
            } else {
                const textoActual = contenedorTexto.textContent.trim();
                const textarea = document.createElement("textarea");
                textarea.value = textoActual;
                textarea.classList.add("textarea-edicion");

                contenedorTexto.style.display = "none";
                // Insertar después del contenedor de texto
                contenedorTexto.insertAdjacentElement("afterend", textarea);
                boton.textContent = "Guardar";
            }
        });
    });
});
