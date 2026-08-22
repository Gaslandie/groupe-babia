document.documentElement.classList.add("js");

// Le <head> arme un garde-fou qui revele tout le contenu si ce script ne
// demarre pas. Il est desamorce ici, en toute premiere instruction.
window.clearTimeout(window.__babiaReveal);

const CONTACT_EMAIL = "infobabiaguinee@gmail.com";
const WHATSAPP_NUMBER = "224620903333";
const SLIDE_DURATION = 5000;
const MEDIA_CAROUSEL_DURATION = 4200;

const reduceMotionQuery = window.matchMedia("(prefers-reduced-motion: reduce)");

// Langue de la page : les libelles rendus par le JS (slider, devis, toasts)
// doivent suivre le <html lang> et non rester figes en francais.
const isEnglishPage = document.documentElement.lang?.startsWith("en");

/* ------------------------------------------------------------------ */
/* Utilitaires partages                                                */
/* ------------------------------------------------------------------ */

let toastNode;
let toastTimer;

function showToast(message) {
  if (!toastNode) {
    toastNode = document.createElement("div");
    toastNode.className = "toast";
    toastNode.setAttribute("role", "status");
    toastNode.setAttribute("aria-live", "polite");
    document.body.append(toastNode);
  }

  toastNode.textContent = message;
  toastNode.classList.add("is-visible");
  window.clearTimeout(toastTimer);
  toastTimer = window.setTimeout(() => toastNode.classList.remove("is-visible"), 2600);
}

/* ------------------------------------------------------------------ */
/* En-tete et navigation                                               */
/* ------------------------------------------------------------------ */

const header = document.querySelector(".site-header");
const navToggle = document.querySelector("[data-nav-toggle]");
const nav = document.querySelector("[data-nav]");

function syncHeader() {
  header?.classList.toggle("is-scrolled", window.scrollY > 24);
}

syncHeader();
window.addEventListener("scroll", syncHeader, { passive: true });

if (navToggle && nav) {
  const navItems = Array.from(nav.querySelectorAll("a"));

  function setNavigation(isOpen) {
    nav.classList.toggle("is-open", isOpen);
    navToggle.setAttribute("aria-expanded", String(isOpen));
    navToggle.setAttribute("aria-label", isOpen ? "Fermer le menu" : "Ouvrir le menu");
    document.body.classList.toggle("nav-open", isOpen);
  }

  function closeNavigation({ restoreFocus = false } = {}) {
    if (!nav.classList.contains("is-open")) {
      return;
    }
    setNavigation(false);
    if (restoreFocus) {
      navToggle.focus();
    }
  }

  setNavigation(false);

  navToggle.addEventListener("click", () => {
    const isOpen = !nav.classList.contains("is-open");
    setNavigation(isOpen);
    if (isOpen) {
      navItems[0]?.focus();
    }
  });

  nav.addEventListener("click", (event) => {
    if (event.target instanceof HTMLAnchorElement) {
      closeNavigation();
    }
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeNavigation({ restoreFocus: true });
      return;
    }

    // Le focus reste dans le menu tant qu'il est ouvert (menu plein ecran mobile).
    if (event.key !== "Tab" || !nav.classList.contains("is-open")) {
      return;
    }

    const focusable = [navToggle, ...navItems];
    const first = focusable[0];
    const last = focusable[focusable.length - 1];

    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault();
      first.focus();
    }
  });

  document.addEventListener("click", (event) => {
    if (!nav.contains(event.target) && !navToggle.contains(event.target)) {
      closeNavigation();
    }
  });

  nav.querySelectorAll(".is-active").forEach((link) => {
    link.setAttribute("aria-current", "page");
  });
}

/* ------------------------------------------------------------------ */
/* Hero anime de la page d'accueil                                     */
/* ------------------------------------------------------------------ */

const slidesFr = [
  {
    kicker: "Agroalimentaire",
    title: "Exportation et importation agroalimentaire",
    text: "Export : cacao, café, cajou, soja, karité, miel, sésame et fruits. Import : jus, riz, tomates, oignons et huile alimentaire."
  },
  {
    kicker: "Construction / BTP",
    title: "Infrastructures modernes et durables",
    text: "Bâtiments, travaux publics et projets d'infrastructures conçus pour soutenir le développement régional."
  },
  {
    kicker: "Secteur minier",
    title: "Valorisation des ressources locales",
    text: "Exploration, logistique et approvisionnement au service d'opérations minières responsables et structurées."
  },
  {
    kicker: "Pêche",
    title: "Une filière halieutique structurée",
    text: "Approvisionnement et commercialisation de produits de la pêche dans une démarche responsable et adaptée aux marchés."
  },
  {
    kicker: "Agro-industrie",
    title: "Transformer pour créer plus de valeur",
    text: "Transformation, contrôle qualité et conditionnement des matières premières agricoles pour les marchés locaux et internationaux."
  }
];

const slidesEn = [
  {
    kicker: "Agri-food",
    title: "Agri-food export and import",
    text: "Export: cocoa, coffee, cashew, soya, shea, honey, sesame and fruits. Import: juice, rice, tomatoes, onions and edible oil."
  },
  {
    kicker: "Construction",
    title: "Modern and durable infrastructure",
    text: "Buildings, public works and infrastructure projects designed to support regional development."
  },
  {
    kicker: "Mining sector",
    title: "Adding value to local resources",
    text: "Exploration, logistics and supply serving responsible, well-structured mining operations."
  },
  {
    kicker: "Fishing",
    title: "A structured fisheries value chain",
    text: "Supply and marketing of fishing products, handled responsibly and adapted to each market."
  },
  {
    kicker: "Agro-industry",
    title: "Processing to create more value",
    text: "Processing, quality control and packaging of agricultural raw materials for local and international markets."
  }
];

const slides = isEnglishPage ? slidesEn : slidesFr;

const slideNodes = Array.from(document.querySelectorAll("[data-slide]"));
const dotNodes = Array.from(document.querySelectorAll("[data-dot]"));
const kickerNode = document.querySelector("[data-slide-kicker]");
const titleNode = document.querySelector("[data-slide-title]");
const textNode = document.querySelector("[data-slide-text]");
const nextButton = document.querySelector("[data-next]");
const prevButton = document.querySelector("[data-prev]");
const playButton = document.querySelector("[data-slide-play]");

if (slideNodes.length && kickerNode) {
  const hero = document.querySelector(".hero");
  let activeSlide = 0;
  let slideTimer;
  let isPaused = false;

  hero?.style.setProperty("--slide-duration", `${SLIDE_DURATION}ms`);

  /* Les visuels des diapositives 2 a 5 sont retires du balisage et rebranches
     ici : positionnes dans la fenetre mais invisibles, `loading="lazy"` ne les
     differait pas, et ils pesaient sur le premier affichage sans etre vus. */
  function chargerVisuel(slide) {
    const img = slide?.querySelector("img[data-src]");
    if (img) {
      img.src = img.dataset.src;
      delete img.dataset.src;
    }
  }

  function chargerVisuelsDifferes() {
    slideNodes.forEach(chargerVisuel);
  }

  if (document.readyState === "complete") {
    chargerVisuelsDifferes();
  } else {
    window.addEventListener("load", chargerVisuelsDifferes, { once: true });
  }

  function updateSlide(index) {
    activeSlide = (index + slides.length) % slides.length;

    // L'utilisateur peut devancer le chargement differe en cliquant une puce.
    chargerVisuel(slideNodes[activeSlide]);

    slideNodes.forEach((slide, slideIndex) => {
      slide.classList.toggle("is-active", slideIndex === activeSlide);
      slide.setAttribute("aria-hidden", String(slideIndex !== activeSlide));
    });

    dotNodes.forEach((dot, dotIndex) => {
      const isActive = dotIndex === activeSlide;
      dot.classList.toggle("is-active", isActive);
      dot.setAttribute("aria-pressed", String(isActive));
    });

    kickerNode.textContent = slides[activeSlide].kicker;

    // Presents seulement si le gabarit affiche un panneau descriptif.
    if (titleNode) {
      titleNode.textContent = slides[activeSlide].title;
    }
    if (textNode) {
      textNode.textContent = slides[activeSlide].text;
    }
  }

  function canAutoplay() {
    return !isPaused && !reduceMotionQuery.matches && !document.hidden;
  }

  function startSlider() {
    window.clearInterval(slideTimer);
    hero?.classList.remove("is-playing");

    if (!canAutoplay()) {
      return;
    }

    // Redemarrage force de l'animation de progression du point actif.
    void hero?.offsetWidth;
    hero?.classList.add("is-playing");
    slideTimer = window.setInterval(() => updateSlide(activeSlide + 1), SLIDE_DURATION);
  }

  function stopSlider() {
    window.clearInterval(slideTimer);
    hero?.classList.remove("is-playing");
  }

  function goTo(index) {
    updateSlide(index);
    startSlider();
  }

  nextButton?.addEventListener("click", () => goTo(activeSlide + 1));
  prevButton?.addEventListener("click", () => goTo(activeSlide - 1));
  dotNodes.forEach((dot) => dot.addEventListener("click", () => goTo(Number(dot.dataset.dot))));

  // WCAG 2.2.2 : un contenu qui defile seul doit pouvoir etre mis en pause,
  // y compris au doigt (le survol ne suffit pas sur mobile).
  if (playButton) {
    if (reduceMotionQuery.matches) {
      playButton.hidden = true;
    }

    playButton.addEventListener("click", () => {
      isPaused = !isPaused;
      playButton.setAttribute("aria-label", isPaused ? "Reprendre le défilement" : "Mettre le défilement en pause");
      playButton.setAttribute("data-state", isPaused ? "paused" : "playing");
      if (isPaused) {
        stopSlider();
      } else {
        startSlider();
      }
    });
  }

  hero?.addEventListener("mouseenter", stopSlider);
  hero?.addEventListener("mouseleave", startSlider);
  hero?.addEventListener("focusin", stopSlider);
  hero?.addEventListener("focusout", startSlider);
  hero?.addEventListener("keydown", (event) => {
    if (event.key === "ArrowRight") {
      goTo(activeSlide + 1);
    }
    if (event.key === "ArrowLeft") {
      goTo(activeSlide - 1);
    }
  });

  // Balayage horizontal sur mobile : les fleches sont petites au doigt.
  let touchStartX = null;
  hero?.addEventListener("touchstart", (event) => {
    touchStartX = event.changedTouches[0].clientX;
    stopSlider();
  }, { passive: true });

  hero?.addEventListener("touchend", (event) => {
    if (touchStartX === null) {
      return;
    }
    const delta = event.changedTouches[0].clientX - touchStartX;
    touchStartX = null;
    if (Math.abs(delta) > 45) {
      goTo(activeSlide + (delta < 0 ? 1 : -1));
    } else {
      startSlider();
    }
  }, { passive: true });

  document.addEventListener("visibilitychange", () => {
    if (document.hidden) {
      stopSlider();
    } else {
      startSlider();
    }
  });

  reduceMotionQuery.addEventListener?.("change", () => {
    if (playButton) {
      playButton.hidden = reduceMotionQuery.matches;
    }
    startSlider();
  });

  updateSlide(0);
  startSlider();
}

/* ------------------------------------------------------------------ */
/* Carousels visuels de section                                        */
/* ------------------------------------------------------------------ */

const mediaCarousels = Array.from(document.querySelectorAll("[data-media-carousel]"));

mediaCarousels.forEach((carousel) => {
  const slides = Array.from(carousel.querySelectorAll("[data-media-slide]"));
  const dots = Array.from(carousel.querySelectorAll("[data-media-dot]"));

  if (slides.length < 2) {
    return;
  }

  let activeMedia = 0;
  let mediaTimer;
  let isPaused = false;

  function updateMedia(index) {
    activeMedia = (index + slides.length) % slides.length;

    slides.forEach((slide, slideIndex) => {
      const isActive = slideIndex === activeMedia;
      slide.classList.toggle("is-active", isActive);
      slide.setAttribute("aria-hidden", String(!isActive));
    });

    dots.forEach((dot, dotIndex) => {
      const isActive = dotIndex === activeMedia;
      dot.classList.toggle("is-active", isActive);
      dot.setAttribute("aria-pressed", String(isActive));
    });
  }

  function canPlayMedia() {
    return !isPaused && !reduceMotionQuery.matches && !document.hidden;
  }

  function stopMedia() {
    window.clearInterval(mediaTimer);
  }

  function startMedia() {
    stopMedia();
    if (canPlayMedia()) {
      mediaTimer = window.setInterval(() => updateMedia(activeMedia + 1), MEDIA_CAROUSEL_DURATION);
    }
  }

  function goToMedia(index) {
    updateMedia(index);
    startMedia();
  }

  dots.forEach((dot) => {
    dot.addEventListener("click", () => goToMedia(Number(dot.dataset.mediaDot)));
  });

  carousel.addEventListener("mouseenter", stopMedia);
  carousel.addEventListener("mouseleave", startMedia);
  carousel.addEventListener("focusin", () => {
    isPaused = true;
    stopMedia();
  });
  carousel.addEventListener("focusout", (event) => {
    if (carousel.contains(event.relatedTarget)) {
      return;
    }
    isPaused = false;
    startMedia();
  });

  document.addEventListener("visibilitychange", () => {
    if (document.hidden) {
      stopMedia();
    } else {
      startMedia();
    }
  });

  reduceMotionQuery.addEventListener?.("change", startMedia);

  updateMedia(0);
  startMedia();
});

/* ------------------------------------------------------------------ */
/* Catalogue : contact direct par produit                              */
/* ------------------------------------------------------------------ */

const productWhatsAppLinks = Array.from(document.querySelectorAll("[data-product-whatsapp]"));

productWhatsAppLinks.forEach((link) => {
  const product = link.dataset.productWhatsapp;
  if (!product) {
    return;
  }

  const message = isEnglishPage
    ? `Hello Groupe Babia, I would like information about ${product}. Please contact me.`
    : `Bonjour Groupe Babia, je souhaite avoir des informations sur ${product}. Merci de me recontacter.`;

  link.setAttribute("href", `https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(message)}`);
});

/* ------------------------------------------------------------------ */
/* Catalogue : filtres                                                 */
/* ------------------------------------------------------------------ */

const filterButtons = Array.from(document.querySelectorAll("[data-filter]"));
const productCards = Array.from(document.querySelectorAll("[data-category]"));
const filterResult = document.querySelector("[data-filter-result]");
const filterEmpty = document.querySelector("[data-filter-empty]");

if (filterButtons.length && productCards.length) {
  function countFor(filter) {
    return filter === "all"
      ? productCards.length
      : productCards.filter((card) => card.dataset.category === filter).length;
  }

  function applyFilter(filter, { announce = true } = {}) {
    let visible = 0;

    productCards.forEach((card) => {
      const shouldShow = filter === "all" || card.dataset.category === filter;
      card.hidden = !shouldShow;
      if (shouldShow) {
        visible += 1;
      }
    });

    filterButtons.forEach((item) => {
      const isActive = item.dataset.filter === filter;
      item.classList.toggle("is-active", isActive);
      item.setAttribute("aria-pressed", String(isActive));
    });

    if (filterEmpty) {
      filterEmpty.hidden = visible > 0;
    }

    if (filterResult && announce) {
      filterResult.textContent = isEnglishPage
        ? `${visible} product${visible > 1 ? "s" : ""} shown`
        : `${visible} produit${visible > 1 ? "s" : ""} affiché${visible > 1 ? "s" : ""}`;
    }
  }

  // Compteurs affiches sur chaque filtre : l'utilisateur sait ce qu'il va obtenir.
  filterButtons.forEach((button) => {
    const filter = button.dataset.filter;
    const badge = document.createElement("span");
    badge.className = "filter-count";
    badge.textContent = String(countFor(filter));
    badge.setAttribute("aria-hidden", "true");
    button.append(badge);

    button.addEventListener("click", () => applyFilter(filter));
  });

  const initial = filterButtons.find((button) => button.classList.contains("is-active"));
  applyFilter(initial?.dataset.filter ?? "all", { announce: false });
}

/* ------------------------------------------------------------------ */
/* Formulaire de contact                                               */
/* ------------------------------------------------------------------ */

const contactForm = document.querySelector("[data-contact-form]");

if (contactForm) {
  const contactWhatsApp = document.querySelector("[data-contact-whatsapp]");
  const statusNode = document.querySelector("[data-form-status]");
  const statusTitle = document.querySelector("[data-form-status-title]");
  const statusText = document.querySelector("[data-form-status-text]");
  const copyButton = document.querySelector("[data-copy-message]");
  const submitButton = contactForm.querySelector('button[type="submit"]');
  const submitDefaultText = submitButton?.textContent ?? "";
  const isEnglishContact = document.documentElement.lang.toLowerCase().startsWith("en");
  const needField = contactForm.elements.namedItem("need");
  const messageField = contactForm.elements.namedItem("message");

  const NEED_BY_PARAM = {
    agro: isEnglishContact ? "Agri-food export/import request" : "Demande agroalimentaire export/import",
    construction: isEnglishContact ? "Construction project" : "Projet BTP",
    btp: isEnglishContact ? "Construction project" : "Projet BTP",
    mines: isEnglishContact ? "Mining partnership" : "Partenariat minier",
    mining: isEnglishContact ? "Mining partnership" : "Partenariat minier",
    peche: isEnglishContact ? "Fishing activity" : "Activité de pêche",
    fishing: isEnglishContact ? "Fishing activity" : "Activité de pêche",
    "agro-industrie": isEnglishContact ? "Agro-industrial project" : "Projet agro-industriel",
    "agro-industry": isEnglishContact ? "Agro-industrial project" : "Projet agro-industriel",
    corporate: isEnglishContact ? "Corporate information" : "Information corporate"
  };

  const ERROR_MESSAGES = {
    valueMissing: isEnglishContact ? "This field is required to process your request." : "Ce champ est nécessaire pour traiter votre demande.",
    typeMismatch: isEnglishContact ? "The format entered does not look valid." : "Le format saisi ne semble pas valide."
  };

  contactForm.setAttribute("novalidate", "");

  function fieldWrapper(control) {
    return control.closest(".field");
  }

  function clearError(control) {
    const wrapper = fieldWrapper(control);
    wrapper?.classList.remove("is-invalid");
    control.removeAttribute("aria-invalid");
  }

  function showError(control, message) {
    const wrapper = fieldWrapper(control);
    if (!wrapper) {
      return;
    }

    const errorNode = wrapper.querySelector(".field-error");
    if (errorNode) {
      errorNode.textContent = message || (control.validity.valueMissing
        ? ERROR_MESSAGES.valueMissing
        : ERROR_MESSAGES.typeMismatch);
      control.setAttribute("aria-describedby", errorNode.id);
    }

    wrapper.classList.add("is-invalid");
    control.setAttribute("aria-invalid", "true");
  }

  function validate({ focusFirst = false } = {}) {
    const controls = Array.from(contactForm.querySelectorAll("input, select, textarea"));
    let firstInvalid = null;

    controls.forEach((control) => {
      if (control.checkValidity()) {
        clearError(control);
      } else {
        showError(control);
        firstInvalid = firstInvalid ?? control;
      }
    });

    if (firstInvalid && focusFirst) {
      firstInvalid.focus();
      firstInvalid.scrollIntoView({ block: "center", behavior: reduceMotionQuery.matches ? "auto" : "smooth" });
    }

    return !firstInvalid;
  }

  function showServerErrors(errors) {
    if (!errors || typeof errors !== "object") {
      return false;
    }

    let firstInvalid = null;

    Object.entries(errors).forEach(([name, message]) => {
      const control = contactForm.elements.namedItem(name);
      if (!(control instanceof HTMLElement)) {
        return;
      }

      showError(control, String(message));
      firstInvalid = firstInvalid ?? control;
    });

    if (firstInvalid) {
      firstInvalid.focus();
      firstInvalid.scrollIntoView({ block: "center", behavior: reduceMotionQuery.matches ? "auto" : "smooth" });
    }

    return Boolean(firstInvalid);
  }

  function messageBody() {
    const data = new FormData(contactForm);
    const value = (key) => String(data.get(key) ?? "").trim() || "-";

    return [
      isEnglishContact ? "Hello Groupe Babia," : "Bonjour Groupe Babia,",
      "",
      `${isEnglishContact ? "Name" : "Nom"} : ${value("name")}`,
      `${isEnglishContact ? "Company" : "Entreprise"} : ${value("company")}`,
      `${isEnglishContact ? "Email" : "E-mail"} : ${value("email")}`,
      `${isEnglishContact ? "Phone" : "Téléphone"} : ${value("phone")}`,
      `${isEnglishContact ? "Request type" : "Besoin"} : ${value("need")}`,
      `${isEnglishContact ? "Country / destination" : "Pays / destination"} : ${value("destination")}`,
      `${isEnglishContact ? "Expected timing" : "Calendrier souhaité"} : ${value("timeline")}`,
      "",
      `${isEnglishContact ? "Message" : "Message"} :`,
      value("message"),
      "",
      isEnglishContact ? "Please contact me back." : "Merci de me recontacter."
    ].join("\n");
  }

  function mailtoLink() {
    return `mailto:${CONTACT_EMAIL}?subject=${encodeURIComponent("Contact Groupe Babia")}&body=${encodeURIComponent(messageBody())}`;
  }

  function syncWhatsApp() {
    if (!contactWhatsApp) {
      return;
    }
    contactWhatsApp.setAttribute("href", `https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(messageBody())}`);
  }

  function setStatus(title, text, variant) {
    if (!statusNode || !statusTitle || !statusText) {
      return;
    }
    statusTitle.textContent = title;
    statusText.textContent = text;
    statusNode.classList.toggle("is-error", variant === "error");
    statusNode.hidden = false;
    statusNode.scrollIntoView({ block: "nearest", behavior: reduceMotionQuery.matches ? "auto" : "smooth" });
  }

  contactForm.addEventListener("input", (event) => {
    syncWhatsApp();
    const control = event.target;
    if (control instanceof HTMLElement && fieldWrapper(control)?.classList.contains("is-invalid") && control.checkValidity()) {
      clearError(control);
    }
  });

  contactForm.addEventListener(
    "blur",
    (event) => {
      const control = event.target;
      if (!(control instanceof HTMLElement) || !("checkValidity" in control)) {
        return;
      }
      if (control.value === "" && !control.hasAttribute("required")) {
        return;
      }
      if (control.checkValidity()) {
        clearError(control);
      } else {
        showError(control);
      }
    },
    true
  );

  function fallbackToEmail() {
    // mailto: peut ne rien declencher si aucun client mail n'est configure :
    // on annonce ce qui vient de se passer et on laisse deux solutions de repli.
    setStatus(
      isEnglishContact ? "Your message is ready" : "Votre message est prêt",
      isEnglishContact
        ? `Your email software should open with a pre-filled message to ${CONTACT_EMAIL}. If it does not open, copy the message or use WhatsApp.`
        : `Votre logiciel de messagerie doit s'ouvrir avec le message pré-rempli, à destination de ${CONTACT_EMAIL}. S'il ne s'ouvre pas, copiez le message ou passez par WhatsApp.`
    );

    window.location.href = mailtoLink();
  }

  contactForm.addEventListener("submit", async (event) => {
    event.preventDefault();

    if (!validate({ focusFirst: true })) {
      setStatus(
        isEnglishContact ? "Some information is missing" : "Quelques informations manquent",
        isEnglishContact ? "Please correct the highlighted fields, then send your request again." : "Corrigez les champs signalés en rouge, puis renvoyez votre demande.",
        "error"
      );
      return;
    }

    syncWhatsApp();

    if (submitButton) {
      submitButton.disabled = true;
      submitButton.textContent = submitButton.dataset.loadingText || (isEnglishContact ? "Sending..." : "Envoi en cours...");
    }

    try {
      const response = await fetch(contactForm.action || "contact-submit.php", {
        method: "POST",
        body: new FormData(contactForm),
        headers: { Accept: "application/json" }
      });
      const payload = await response.json();

      if (response.ok && payload.ok) {
        setStatus(
          payload.title || (isEnglishContact ? "Request received" : "Demande reçue"),
          payload.message || (isEnglishContact ? "Your request has been recorded. Our team will get back to you shortly." : "Votre demande a été enregistrée. Notre équipe vous recontactera rapidement.")
        );
        return;
      }

      if (payload.errors && showServerErrors(payload.errors)) {
        setStatus(
          payload.title || (isEnglishContact ? "Some information is missing" : "Quelques informations manquent"),
          payload.message || (isEnglishContact ? "Please correct the highlighted fields, then send your request again." : "Corrigez les champs signalés, puis renvoyez votre demande."),
          "error"
        );
        return;
      }

      setStatus(
        payload.title || (isEnglishContact ? "Submission temporarily unavailable" : "Envoi momentanément indisponible"),
        payload.message || (isEnglishContact ? "Please use email or WhatsApp to send your request." : "Utilisez l'e-mail ou WhatsApp pour transmettre votre demande."),
        "error"
      );
      fallbackToEmail();
    } catch {
      fallbackToEmail();
    } finally {
      if (submitButton) {
        submitButton.disabled = false;
        submitButton.textContent = submitDefaultText;
      }
    }
  });

  copyButton?.addEventListener("click", async () => {
    const text = `${isEnglishContact ? "To" : "À"} : ${CONTACT_EMAIL}\n\n${messageBody()}`;
    try {
      await navigator.clipboard.writeText(text);
      showToast(isEnglishContact ? "Message copied to clipboard" : "Message copié dans le presse-papiers");
    } catch {
      showToast(isEnglishContact ? `Copy failed. Email us at ${CONTACT_EMAIL}` : `Copie impossible. Écrivez-nous à ${CONTACT_EMAIL}`);
    }
  });

  // Pre-remplissage : pole d'origine (?besoin=btp).
  const params = new URLSearchParams(window.location.search);
  const requestedNeed = NEED_BY_PARAM[params.get("besoin") ?? params.get("need") ?? ""];

  if (requestedNeed && needField instanceof HTMLSelectElement) {
    needField.value = requestedNeed;
  }

  syncWhatsApp();
}

/* ------------------------------------------------------------------ */
/* Retour en haut de page                                              */
/* ------------------------------------------------------------------ */

const toTop = document.createElement("button");
toTop.type = "button";
toTop.className = "to-top";
toTop.setAttribute("aria-label", "Revenir en haut de la page");
toTop.innerHTML = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 19V5m0 0-6 6m6-6 6 6"/></svg>';
document.body.append(toTop);

toTop.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: reduceMotionQuery.matches ? "auto" : "smooth" });
  document.querySelector(".skip-link")?.focus();
});

function syncToTop() {
  toTop.classList.toggle("is-visible", window.scrollY > window.innerHeight);
}

syncToTop();
window.addEventListener("scroll", syncToTop, { passive: true });

/* ------------------------------------------------------------------ */
/* Apparitions au defilement                                           */
/* ------------------------------------------------------------------ */

/* L'etat cache vient du CSS. Ce script ne fait que deux choses : calculer le
   decalage de chaque element au sein de son groupe, et poser `is-visible`
   quand le groupe entre dans le champ. */

// Conteneurs dont les enfants apparaissent en cascade.
const REVEAL_GROUPES = [
  ".activity-grid",
  ".service-grid",
  ".metric-grid",
  ".news-grid",
  ".product-grid",
  ".commitment-grid",
  ".trust-strip",
  ".timeline",
  ".contact-list"
].join(", ");

// Elements qui apparaissent seuls.
const REVEAL_SEULS = [
  ".section-heading",
  ".intro-copy",
  ".content-panel",
  ".export-content",
  ".export-media",
  ".media-band > img",
  ".media-band > .media-carousel",
  ".form-card"
].join(", ");

const REVEAL_PAS = 70;
const REVEAL_PAS_MAX = 5;

if (!("IntersectionObserver" in window)) {
  // Navigateur trop ancien : on affiche tout plutot que de risquer du contenu
  // invisible.
  document.documentElement.classList.add("no-reveal");
} else if (!reduceMotionQuery.matches) {
  const reveler = (element) => element.classList.add("is-visible");

  const observateur = new IntersectionObserver(
    (entrees, observer) => {
      entrees.forEach((entree) => {
        if (!entree.isIntersecting) {
          return;
        }

        const cible = entree.target;
        observer.unobserve(cible);

        // Un groupe revele tous ses enfants d'un coup : la cascade se lit comme
        // un seul geste, au lieu de dependre du moment ou chaque carte entre.
        if (cible.dataset.revealGroupe !== undefined) {
          Array.from(cible.children).forEach(reveler);
        } else {
          reveler(cible);
        }
      });
    },
    // Seuil a 0 et marge fixe plutot qu'en pourcentage : le declenchement ne
    // depend plus de la hauteur de l'element. Avec un seuil en pourcentage, une
    // grille tres haute attendait qu'une grande partie soit visible, et un titre
    // arrete dans la bande basse de l'ecran pouvait rester invisible.
    { rootMargin: "0px 0px -64px 0px", threshold: 0 }
  );

  document.querySelectorAll(REVEAL_GROUPES).forEach((groupe) => {
    Array.from(groupe.children).forEach((enfant, index) => {
      // Le decalage est plafonne : au-dela de quelques elements, attendre plus
      // longtemps ne se lit plus comme une cascade mais comme une lenteur.
      const rang = Math.min(index, REVEAL_PAS_MAX);
      enfant.style.setProperty("--rv-delay", `${rang * REVEAL_PAS}ms`);
    });

    groupe.dataset.revealGroupe = "";
    observateur.observe(groupe);
  });

  document.querySelectorAll(REVEAL_SEULS).forEach((element) => {
    observateur.observe(element);
  });
}

/* ------------------------------------------------------------------ */
/* Chargement de page                                                  */
/* ------------------------------------------------------------------ */

/* Le site sert des pages completes : entre le clic et l'arrivee, le navigateur
   n'affiche rien et l'ancienne page reste figee. On rend cette attente lisible
   sans la rallonger — la barre demarre au depart, le voile ne vient qu'apres un
   delai, et l'arrivee referme la boucle par un balayage court. */

// En-deca de ce delai, la page suivante arrive avant le voile : l'afficher
// produirait un clignotement plus genant que l'attente qu'il masque.
const ROUTE_VEIL_DELAY = reduceMotionQuery.matches ? 420 : 220;
// Navigation abandonnee par le navigateur (telechargement, protocole inconnu,
// annulation) : sans ce filet, le voile resterait affiche indefiniment.
const ROUTE_SAFETY_DELAY = 12000;
const ROUTE_PROGRESS_CEILING = 92;

const routeText = isEnglishPage ? "Loading…" : "Chargement en cours…";

let routeProgressNode;
let routeBarNode;
let routeVeilNode;
let routeVeilTimer;
let routeCreepTimer;
let routeSafetyTimer;
let routeResetTimer;
let routeValue = 0;
let routeIsRunning = false;

function buildRouteIndicator() {
  const progress = document.createElement("div");
  progress.className = "route-progress";
  progress.setAttribute("aria-hidden", "true");

  const bar = document.createElement("span");
  bar.className = "route-progress-bar";
  progress.append(bar);

  const veil = document.createElement("div");
  veil.className = "route-veil";
  veil.setAttribute("role", "status");
  veil.setAttribute("aria-live", "polite");

  const card = document.createElement("div");
  card.className = "route-veil-card";

  // Le logo est repris de l'en-tete : sa source est deja correcte pour le
  // contexte de la page (racine, /en/, ou fiche servie sous <base href>).
  const headerLogo = document.querySelector(".brand-logo");
  const logoSource = headerLogo?.getAttribute("src");

  if (logoSource) {
    const mark = document.createElement("img");
    mark.className = "route-veil-mark";
    mark.src = logoSource;
    mark.alt = "";
    mark.width = 128;
    mark.height = 128;
    mark.decoding = "async";
    card.append(mark);
  }

  const title = document.createElement("p");
  title.className = "route-veil-title";
  title.textContent = "Groupe Babia";

  const text = document.createElement("p");
  text.className = "route-veil-text";
  text.textContent = routeText;

  const line = document.createElement("span");
  line.className = "route-veil-line";

  card.append(title, text, line);
  veil.append(card);
  document.body.append(progress, veil);

  routeProgressNode = progress;
  routeBarNode = bar;
  routeVeilNode = veil;
}

function routeSetWidth(percent) {
  routeValue = percent;
  routeBarNode.style.width = `${percent}%`;
}

/* Progression simulee : le navigateur ne publie aucun avancement pour une
   navigation de document. On approche donc le plafond sans jamais l'atteindre,
   par pas decroissants — seule l'arrivee de la page suivante termine la barre. */
function routeCreep() {
  const remaining = ROUTE_PROGRESS_CEILING - routeValue;
  routeSetWidth(routeValue + Math.max(0.4, remaining * 0.12));
  routeCreepTimer = window.setTimeout(routeCreep, 260);
}

function routeClearTimers() {
  window.clearTimeout(routeVeilTimer);
  window.clearTimeout(routeCreepTimer);
  window.clearTimeout(routeSafetyTimer);
  window.clearTimeout(routeResetTimer);
}

function routeHide() {
  routeProgressNode.classList.remove("is-active");
  routeVeilNode.classList.remove("is-active");

  // La remise a zero attend la fin du fondu : sinon on verrait la barre
  // revenir a gauche avant d'avoir disparu.
  routeResetTimer = window.setTimeout(() => {
    routeBarNode.style.transition = "none";
    routeSetWidth(0);
    window.requestAnimationFrame(() => {
      routeBarNode.style.transition = "";
    });
  }, 260);
}

function routeReset() {
  routeIsRunning = false;
  routeClearTimers();
  routeHide();
}

function routeStart() {
  if (routeIsRunning) {
    return;
  }

  routeIsRunning = true;
  routeClearTimers();

  routeBarNode.style.transition = "none";
  routeSetWidth(0);
  routeProgressNode.classList.add("is-active");

  window.requestAnimationFrame(() => {
    routeBarNode.style.transition = "";
    // Depart franc : une barre qui rampe depuis zero se lit comme un blocage.
    routeSetWidth(18);
  });

  routeCreepTimer = window.setTimeout(routeCreep, 320);
  routeVeilTimer = window.setTimeout(() => routeVeilNode.classList.add("is-active"), ROUTE_VEIL_DELAY);
  routeSafetyTimer = window.setTimeout(routeReset, ROUTE_SAFETY_DELAY);
}

/* Balayage d'arrivee : la page precedente a laisse une barre en cours, celle-ci
   la termine. Sur une premiere visite, il se lit comme une entree soignee. */
function routeComplete() {
  routeProgressNode.classList.add("is-active");

  window.requestAnimationFrame(() => routeSetWidth(100));
  routeResetTimer = window.setTimeout(routeHide, 420);
}

function routeShouldIntercept(event, link) {
  if (event.defaultPrevented || event.button !== 0) {
    return false;
  }

  // Clic modifie : le navigateur ouvre un onglet ou une fenetre, la page
  // courante reste affichee. Aucun voile a poser.
  if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
    return false;
  }

  if (link.hasAttribute("download") || (link.target && link.target !== "_self")) {
    return false;
  }

  if ((link.getAttribute("href") || "").startsWith("#")) {
    return false;
  }

  let target;

  try {
    target = new URL(link.href, window.location.href);
  } catch {
    return false;
  }

  // mailto:, tel: et les domaines externes ont une origine differente : ils ne
  // remplacent pas la page courante.
  if (target.origin !== window.location.origin) {
    return false;
  }

  // Ancre sur la meme page : defilement, pas navigation.
  return !(
    target.hash &&
    target.pathname === window.location.pathname &&
    target.search === window.location.search
  );
}

buildRouteIndicator();
routeComplete();

document.addEventListener("click", (event) => {
  const link = event.target instanceof Element ? event.target.closest("a[href]") : null;

  if (link && routeShouldIntercept(event, link)) {
    routeStart();
  }
});

document.addEventListener("keydown", (event) => {
  // Echap annule la navigation cote navigateur : sans ce rappel, le voile
  // resterait pose sur une page qui, elle, ne part plus, jusqu'au filet de
  // securite. C'est le geste naturel pour renoncer a un chargement trop long.
  if (event.key === "Escape" && routeIsRunning) {
    routeReset();
  }
});

window.addEventListener("pageshow", (event) => {
  // Retour arriere depuis le cache : la page revient telle qu'elle etait
  // partie, voile compris. Il faut la rendre a son etat normal.
  if (event.persisted) {
    routeReset();
  }
});
