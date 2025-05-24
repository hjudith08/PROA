document.addEventListener('DOMContentLoaded', function() {
    // Efecto de scroll suave para todos los enlaces
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Efecto hover mejorado para el botón demo
    const botonDemo = document.querySelector('.botonDemo_misHerramientas');
    if (botonDemo) {
        botonDemo.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });
        botonDemo.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    }

    // Resto de tu código original para el header...
    const dropdownUsuario = document.getElementById('dropdownUsuario');
    const imagenUsuario = document.querySelector('.imagenBotonHeader_edusync');
    const popupCerrarSesion = document.getElementById('popupCerrarSesion');

    if (imagenUsuario && dropdownUsuario) {
        imagenUsuario.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownUsuario.classList.toggle('active');
        });
    }

    // ... (mantener el resto de tu código JS original)
});