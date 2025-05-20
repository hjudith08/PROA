 document.addEventListener("DOMContentLoaded", () => {
    const boton = document.querySelector(".hamburguesa");
    const menu = document.querySelector(".menu-movil");

    boton.addEventListener("click", () => {
    menu.style.display = menu.style.display === "block" ? "none" : "block";
});

    // Opcional: cerrar el menú al hacer clic en un enlace
    menu.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", () => {
    menu.style.display = "none";
});
});
});
