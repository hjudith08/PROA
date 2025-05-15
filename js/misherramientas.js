let indiceActual = 0;
const slides = document.querySelectorAll('.slide-carrusel');
const indicadores = document.querySelectorAll('.indicador');

function mostrarSlide(indice) {
  const contenedor = document.querySelector('.slides-carrusel');
  const anchoSlide = 100 / slides.length;
  contenedor.style.transform = `translateX(-${indice * anchoSlide}%)`;

  indicadores.forEach(ind => ind.classList.remove('indicador-activo'));
  if (indicadores[indice]) indicadores[indice].classList.add('indicador-activo');
  indiceActual = indice;
}

function moverCarrusel(direccion) {
  let nuevoIndice = indiceActual + direccion;
  if (nuevoIndice < 0) nuevoIndice = slides.length - 1;
  if (nuevoIndice >= slides.length) nuevoIndice = 0;
  mostrarSlide(nuevoIndice);
}

function irASlide(indice) {
  mostrarSlide(indice);
}

// Inicializar carrusel
document.addEventListener('DOMContentLoaded', () => {
  mostrarSlide(0);
});
