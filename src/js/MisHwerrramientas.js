document.addEventListener('DOMContentLoaded', function() {
  // Inicializar iconos de Lucide
  lucide.createIcons();
  
  // Configurar carrusel
  const slides = document.querySelectorAll('.slide-carrusel');
  const indicadores = document.querySelectorAll('.indicador');
  let slideActual = 0;
  let intervaloAutoplay;
  
  // Función para mover el carrusel
  window.moverCarrusel = function(direccion) {
    slideActual += direccion;
    
    // Ajustar para circularidad
    if (slideActual < 0) {
      slideActual = slides.length - 1;
    } else if (slideActual >= slides.length) {
      slideActual = 0;
    }
    
    actualizarCarrusel();
    reiniciarAutoplay();
  };
  
  // Función para ir a un slide específico
  window.irASlide = function(indice) {
    slideActual = indice;
    actualizarCarrusel();
    reiniciarAutoplay();
  };
  
  // Actualizar estado del carrusel
  function actualizarCarrusel() {
    const desplazamiento = -slideActual * 100;
    document.querySelector('.slides-carrusel').style.transform = `translateX(${desplazamiento}%)`;
    
    // Actualizar clases de los slides
    slides.forEach((slide, index) => {
      if (index === slideActual) {
        slide.classList.add('slide-activo');
      } else {
        slide.classList.remove('slide-activo');
      }
    });
    
    // Actualizar indicadores
    indicadores.forEach((indicador, index) => {
      if (index === slideActual) {
        indicador.classList.add('indicador-activo');
      } else {
        indicador.classList.remove('indicador-activo');
      }
    });
  }
  
  // Configurar autoplay para el carrusel
  function iniciarAutoplay() {
    intervaloAutoplay = setInterval(() => {
      moverCarrusel(1);
    }, 5000);
  }
  
  // Reiniciar autoplay después de interacción manual
  function reiniciarAutoplay() {
    clearInterval(intervaloAutoplay);
    iniciarAutoplay();
  }
  
  // Iniciar autoplay al cargar la página
  iniciarAutoplay();
  
  // Pausar autoplay al hacer hover sobre el carrusel
  const carrusel = document.querySelector('.carrusel-herramientas');
  carrusel.addEventListener('mouseenter', () => {
    clearInterval(intervaloAutoplay);
  });
  
  carrusel.addEventListener('mouseleave', () => {
    iniciarAutoplay();
  });
  
  // Eventos para los botones
  document.querySelector('.boton-demo')?.addEventListener('click', function() {
    // Aquí iría la lógica para el botón de demo
    console.log('Botón demo PROA clickeado');
  });
  
  document.querySelector('.boton-contacto')?.addEventListener('click', function() {
    // Aquí iría la lógica para el botón de contacto
    console.log('Botón contacto clickeado');
  });
});