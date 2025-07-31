// Sélectionne toutes les images du slider
const slides = document.querySelectorAll(".slide");
let currentSlide = 0;

// Affiche l'image correspondant à l'index
function showSlide(index) {
  slides.forEach((img, i) => {
    img.classList.remove("active");
    if (i === index) {
      img.classList.add("active");
    }
  });
}

// Passe à la slide suivante toutes les 6 secondes
function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

// Initialise le slider
showSlide(currentSlide);
setInterval(nextSlide, 6000);
