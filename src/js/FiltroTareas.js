document.addEventListener("DOMContentLoaded", () => {
    const filtro = document.getElementById("filtro-tareas");
    const filas = document.querySelectorAll(".tabla-flex-container .fila-flex:not(.encabezado-flex)");
    const tarjetas = document.querySelectorAll(".tarjeta-usuario");

    filtro.addEventListener("change", () => {
        const valor = filtro.value;

        // Filtrado de filas de la tabla
        filas.forEach(fila => {
            const estado = fila.querySelector(".columna-flex:nth-child(2) span")?.className || "";
            const calificacion = fila.querySelector(".columna-flex:nth-child(5)")?.textContent.trim();

            if (
                valor === "todas" ||
                (valor === "pendiente" && estado.includes("estado-pendiente")) ||
                (valor === "completado" && estado.includes("estado-completado"))
            ) {
                fila.style.display = "flex";
            } else {
                fila.style.display = "none";
            }
        });

        // Filtrado de tarjetas de usuario
        tarjetas.forEach(tarjeta => {
            const puntuacion = tarjeta.querySelector(".puntuacion")?.textContent.trim() || "";

            const esPendiente = puntuacion === "Puntuación: -/10";
            const esCompletado = !esPendiente;

            if (
                valor === "todas" ||
                (valor === "pendiente" && esPendiente) ||
                (valor === "completado" && esCompletado)
            ) {
                tarjeta.style.display = "flex";
            } else {
                tarjeta.style.display = "none";
            }
        });
    });
});
