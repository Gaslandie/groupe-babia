const slides = [
  {
    kicker: "Agroalimentaire",
    title: "Export de produits agricoles",
    text: "Noix de cajou, cacao, café, sésame, soja, miel et boissons, avec une logique de qualité, traçabilité et conditionnement export.",
    copy: "Un partenaire de confiance pour l'export agroalimentaire, les infrastructures durables et la valorisation responsable des ressources locales."
  },
  {
    kicker: "Construction / BTP",
    title: "Infrastructures modernes et durables",
    text: "Bâtiments, travaux publics et projets d'infrastructures conçus pour soutenir le développement régional.",
    copy: "Des solutions BTP adaptées aux besoins de la Guinée et de l'Afrique de l'Ouest, avec une exigence de fiabilité et de durabilité."
  },
  {
    kicker: "Secteur minier",
    title: "Valorisation des ressources locales",
    text: "Exploration, logistique et approvisionnement au service d'opérations minières responsables et structurées.",
    copy: "Un accompagnement minier orienté sécurité, partenariats et contribution à la croissance économique nationale."
  }
];

const slideNodes = Array.from(document.querySelectorAll("[data-slide]"));
const dotNodes = Array.from(document.querySelectorAll("[data-dot]"));
const kickerNode = document.querySelector("[data-slide-kicker]");
const titleNode = document.querySelector("[data-slide-title]");
const textNode = document.querySelector("[data-slide-text]");
const copyNode = document.querySelector("[data-hero-copy]");
const nextButton = document.querySelector("[data-next]");
const prevButton = document.querySelector("[data-prev]");
const navToggle = document.querySelector("[data-nav-toggle]");
const nav = document.querySelector("[data-nav]");

let activeSlide = 0;
let slideTimer;

function updateSlide(index) {
  activeSlide = (index + slides.length) % slides.length;

  slideNodes.forEach((slide, slideIndex) => {
    slide.classList.toggle("is-active", slideIndex === activeSlide);
  });

  dotNodes.forEach((dot, dotIndex) => {
    dot.classList.toggle("is-active", dotIndex === activeSlide);
  });

  kickerNode.textContent = slides[activeSlide].kicker;
  titleNode.textContent = slides[activeSlide].title;
  textNode.textContent = slides[activeSlide].text;
  copyNode.textContent = slides[activeSlide].copy;
}

function startSlider() {
  window.clearInterval(slideTimer);
  slideTimer = window.setInterval(() => {
    updateSlide(activeSlide + 1);
  }, 3000);
}

nextButton.addEventListener("click", () => {
  updateSlide(activeSlide + 1);
  startSlider();
});

prevButton.addEventListener("click", () => {
  updateSlide(activeSlide - 1);
  startSlider();
});

dotNodes.forEach((dot) => {
  dot.addEventListener("click", () => {
    updateSlide(Number(dot.dataset.dot));
    startSlider();
  });
});

navToggle.addEventListener("click", () => {
  const isOpen = nav.classList.toggle("is-open");
  navToggle.setAttribute("aria-expanded", String(isOpen));
});

nav.addEventListener("click", (event) => {
  if (event.target instanceof HTMLAnchorElement) {
    nav.classList.remove("is-open");
    navToggle.setAttribute("aria-expanded", "false");
  }
});

startSlider();
