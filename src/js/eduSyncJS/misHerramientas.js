
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
    

