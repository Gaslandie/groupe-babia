const navToggle = document.querySelector("[data-nav-toggle]");
const nav = document.querySelector("[data-nav]");

if (navToggle && nav) {
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
}

const slides = [
  {
    kicker: "Agroalimentaire",
    title: "Exportation et importation agroalimentaire",
    text: "Fèves de cacao, grains de café, noix de cajou brutes, graines de soja, miel, fruits, riz, tomates, oignons, jus et huile alimentaire.",
    copy: "Un partenaire de confiance pour le commerce agroalimentaire, les infrastructures durables et la valorisation responsable des ressources locales."
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

if (slideNodes.length && kickerNode && titleNode && textNode && copyNode) {
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

  nextButton?.addEventListener("click", () => {
    updateSlide(activeSlide + 1);
    startSlider();
  });

  prevButton?.addEventListener("click", () => {
    updateSlide(activeSlide - 1);
    startSlider();
  });

  dotNodes.forEach((dot) => {
    dot.addEventListener("click", () => {
      updateSlide(Number(dot.dataset.dot));
      startSlider();
    });
  });

  startSlider();
}

const quoteButtons = Array.from(document.querySelectorAll("[data-quote-product]"));
const selectedList = document.querySelector("[data-selected-products]");
const quoteMail = document.querySelector("[data-quote-mail]");
const quoteWhatsApp = document.querySelector("[data-quote-whatsapp]");
const selectedProducts = new Set();

function syncQuoteActions() {
  if (!selectedList || !quoteMail || !quoteWhatsApp) {
    return;
  }

  const products = Array.from(selectedProducts);
  selectedList.textContent = products.length ? products.join(", ") : "Aucun produit sélectionné";

  const subject = encodeURIComponent("Demande de devis - Groupe Babia Guinée");
  const body = encodeURIComponent(
    products.length
      ? `Bonjour,\n\nJe souhaite recevoir une offre pour : ${products.join(", ")}.\n\nMerci de me contacter.`
      : "Bonjour,\n\nJe souhaite recevoir une offre commerciale.\n\nMerci de me contacter."
  );
  const whatsappText = encodeURIComponent(
    products.length
      ? `Bonjour Groupe Babia, je souhaite un devis pour : ${products.join(", ")}.`
      : "Bonjour Groupe Babia, je souhaite recevoir un devis."
  );

  quoteMail.setAttribute("href", `mailto:infobabiaguinee@gmail.com?subject=${subject}&body=${body}`);
  quoteWhatsApp.setAttribute("href", `https://wa.me/224629335733?text=${whatsappText}`);
}

quoteButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const product = button.dataset.quoteProduct;
    if (!product) {
      return;
    }

    if (selectedProducts.has(product)) {
      selectedProducts.delete(product);
      button.classList.remove("is-selected");
      button.textContent = "Ajouter au devis";
    } else {
      selectedProducts.add(product);
      button.classList.add("is-selected");
      button.textContent = "Ajouté au devis";
    }

    syncQuoteActions();
  });
});

syncQuoteActions();

const filterButtons = Array.from(document.querySelectorAll("[data-filter]"));
const productCards = Array.from(document.querySelectorAll("[data-category]"));

filterButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const filter = button.dataset.filter;

    filterButtons.forEach((item) => item.classList.toggle("is-active", item === button));
    productCards.forEach((card) => {
      const shouldShow = filter === "all" || card.dataset.category === filter;
      card.hidden = !shouldShow;
    });
  });
});

const contactForm = document.querySelector("[data-contact-form]");
const contactMail = document.querySelector("[data-contact-mail]");
const contactWhatsApp = document.querySelector("[data-contact-whatsapp]");

function buildContactMessage() {
  if (!contactForm || !contactMail || !contactWhatsApp) {
    return;
  }

  const formData = new FormData(contactForm);
  const name = formData.get("name") || "";
  const company = formData.get("company") || "";
  const need = formData.get("need") || "";
  const message = formData.get("message") || "";

  const body = encodeURIComponent(
    `Bonjour Groupe Babia,\n\nNom : ${name}\nEntreprise : ${company}\nBesoin : ${need}\n\nMessage :\n${message}\n\nMerci de me contacter.`
  );
  const whatsappText = encodeURIComponent(
    `Bonjour Groupe Babia, je suis ${name} (${company}). Besoin : ${need}. ${message}`
  );

  contactMail.setAttribute("href", `mailto:infobabiaguinee@gmail.com?subject=Contact%20Groupe%20Babia&body=${body}`);
  contactWhatsApp.setAttribute("href", `https://wa.me/224629335733?text=${whatsappText}`);
}

if (contactForm) {
  contactForm.addEventListener("input", buildContactMessage);
  contactForm.addEventListener("submit", (event) => {
    event.preventDefault();
    buildContactMessage();
    contactMail?.click();
  });
  buildContactMessage();
}
