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


const logoUser = document.querySelector('.logo-user');
  const dropdown = document.getElementById('dropdownUsuario');
  const popup = document.getElementById('popupCerrarSesion');

  logoUser.addEventListener('click', () => {
    dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
  });

  document.addEventListener('click', function (e) {
    if (!logoUser.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = 'none';
    }
  });

  function mostrarPopupCerrarSesion() {
    popup.style.display = 'flex';
    dropdown.style.display = 'none';
  }

  function ocultarPopupCerrarSesion() {
    popup.style.display = 'none';
  }

  function cerrarSesion() {
    // Aquí puedes limpiar cookies, localStorage o redirigir
    window.location.href = '../../../index.html'; // o la ruta que corresponda
  }