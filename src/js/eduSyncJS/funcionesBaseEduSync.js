const botonSalir = document.getElementById("boton-cerrar-sesion");
const popup = document.getElementById("popupCerrarSesion");
const overlay = document.getElementById("fondo-popup");
const botonSi = document.getElementById("btn-si");
const botonNo = document.getElementById("btn-no");

if (botonSalir && popup && overlay && botonSi && botonNo) {
    botonSalir.addEventListener("click", () => {
        popup.classList.remove("oculto");
        overlay.classList.remove("oculto");
    });

    botonNo.addEventListener("click", () => {
        popup.classList.add("oculto");
        overlay.classList.add("oculto");
    });
    // NO pongas ningún addEventListener para botonSi, el onclick del HTML lo gestiona
}

const scrollBtn = document.querySelector('.scroll-to-top');

    // Mostrar u ocultar el botón al hacer scroll
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            scrollBtn.classList.add('visible');
        } else {
            scrollBtn.classList.remove('visible');
        }
    });

    // Volver al inicio al hacer clic en el botón
    scrollBtn.addEventListener('click', (e) => {
        e.preventDefault(); 
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });