document.addEventListener("DOMContentLoaded", () => {
    const botonesEditar = document.querySelectorAll(".fila-objetivo .editar");

    botonesEditar.forEach((boton) => {
        boton.addEventListener("click", () => {
            const fila = boton.closest(".fila-objetivo");
            const divTexto = fila.querySelector(".texto-desplegable");

            // Buscar si ya existe textarea
            let textarea = fila.querySelector("textarea");

            if (boton.textContent === "Editar") {
                if (!textarea) {
                    // Crear textarea solo si no existe
                    textarea = document.createElement("textarea");
                    textarea.className = "texto-desplegable";
                    textarea.style.width = "100%";
                    textarea.style.minHeight = "60px";
                    textarea.style.fontFamily = "inherit";
                    textarea.style.fontSize = "inherit";
                    textarea.style.padding = "4px";
                    fila.insertBefore(textarea, divTexto.nextSibling);
                }
                // Rellenar textarea con el texto actual
                textarea.value = divTexto.textContent.trim();

                // Ocultar el div y mostrar textarea
                divTexto.style.display = "none";
                textarea.style.display = "block";
                textarea.focus();

                boton.textContent = "Guardar";

            } else {
                // Guardar el texto en el div
                divTexto.textContent = textarea.value;

                // Ocultar textarea y mostrar div
                textarea.style.display = "none";
                divTexto.style.display = "block";

                boton.textContent = "Editar";
            }
        });
    });
});
