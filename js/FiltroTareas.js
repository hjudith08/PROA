document.addEventListener("DOMContentLoaded", () => {
    const filtro = document.getElementById("filtro-tareas");
    const filas = document.querySelectorAll(".tabla-flex-container .fila-flex:not(.encabezado-flex)");

    filtro.addEventListener("change", () => {
        const valor = filtro.value;

        filas.forEach(fila => {
            const estado = fila.querySelector(".columna-flex:nth-child(2) span")?.className || "";
            const calificacion = fila.querySelector(".columna-flex:nth-child(5)")?.textContent.trim();

            if (
                valor === "todas" ||
                (valor === "pendiente" && estado.includes("estado-pendiente")) ||
                (valor === "completado" && estado.includes("estado-completado")) ||
                (valor === "calificada" && calificacion !== "-" && calificacion !== "")
            ) {
                fila.style.display = "flex";
            } else {
                fila.style.display = "none";
            }
        });
    });
});
