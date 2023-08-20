function showMessage(element) {
  element.innerHTML = "¡Mensaje!";
}

function hideMessage(element) {
  element.innerHTML = "";
}

// Obtén todos los elementos de imagen
const imagenes = document.querySelectorAll('.elemento');

let currentIndex = 0;

function mostrarSiguienteImagen() {
    imagenes[currentIndex].style.display = 'none'; // Oculta la imagen actual
    currentIndex = (currentIndex + 1) % imagenes.length; // Calcula el índice de la siguiente imagen
    imagenes[currentIndex].style.display = 'block'; // Muestra la siguiente imagen
}

// Llama a la función para mostrar la siguiente imagen cada 3 segundos
const interval = setInterval(mostrarSiguienteImagen, 3000); // Cambia la imagen cada 3 segundos

// Detén el intervalo cuando el mouse está sobre la galería
const carrusel = document.querySelector('.carrusel');
carrusel.addEventListener('mouseenter', () => clearInterval(interval));

// Reanuda el intervalo cuando el mouse sale de la galería
carrusel.addEventListener('mouseleave', () => {
    interval = setInterval(mostrarSiguienteImagen, 3000);
});
