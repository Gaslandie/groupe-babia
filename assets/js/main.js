document.documentElement.classList.add("js");

// Le <head> arme un garde-fou qui revele tout le contenu si ce script ne
// demarre pas. Il est desamorce ici, en toute premiere instruction.
window.clearTimeout(window.__babiaReveal);

const CONTACT_EMAIL = "infobabiaguinee@gmail.com";
const WHATSAPP_NUMBER = "224620903333";
const SELECTION_KEY = "babia:selection";
const SLIDE_DURATION = 5000;

const reduceMotionQuery = window.matchMedia("(prefers-reduced-motion: reduce)");

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

function readSelection() {
  try {
    const raw = window.sessionStorage.getItem(SELECTION_KEY);
    return raw ? JSON.parse(raw) : [];
  } catch {
    return [];
  }
}

function writeSelection(products) {
  try {
    window.sessionStorage.setItem(SELECTION_KEY, JSON.stringify(products));
  } catch {
    /* navigation privee ou stockage indisponible : la selection reste en memoire. */
  }
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

const slides = [
  {
    kicker: "Agroalimentaire",
    title: "Exportation et importation agroalimentaire",
    text: "Fèves de cacao, grains de café, noix de cajou brutes, graines de soja, beurre de karité, miel, graines de sésame et fruits."
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

const slideNodes = Array.from(document.querySelectorAll("[data-slide]"));
const dotNodes = Array.from(document.querySelectorAll("[data-dot]"));
const kickerNode = document.querySelector("[data-slide-kicker]");
const titleNode = document.querySelector("[data-slide-title]");
const textNode = document.querySelector("[data-slide-text]");
const nextButton = document.querySelector("[data-next]");
const prevButton = document.querySelector("[data-prev]");
const playButton = document.querySelector("[data-slide-play]");

if (slideNodes.length && kickerNode && titleNode && textNode) {
  const hero = document.querySelector(".hero");
  let activeSlide = 0;
  let slideTimer;
  let isPaused = false;

  hero?.style.setProperty("--slide-duration", `${SLIDE_DURATION}ms`);

  function updateSlide(index) {
    activeSlide = (index + slides.length) % slides.length;

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
    titleNode.textContent = slides[activeSlide].title;
    textNode.textContent = slides[activeSlide].text;
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
/* Catalogue : selection produits et panneau de devis                  */
/* ------------------------------------------------------------------ */

const quoteButtons = Array.from(document.querySelectorAll("[data-quote-product]"));
const quoteDock = document.querySelector("[data-quote-dock]");
const quoteChips = document.querySelector("[data-quote-chips]");
const quoteCount = document.querySelector("[data-quote-count]");
const quoteSummary = document.querySelector("[data-selected-products]");
const quoteClear = document.querySelector("[data-quote-clear]");
const quoteMail = document.querySelector("[data-quote-mail]");
const quoteWhatsApp = document.querySelector("[data-quote-whatsapp]");
const selectedProducts = new Set(readSelection());

function quoteBody(products) {
  return products.length
    ? `Bonjour,\n\nJe souhaite recevoir une offre pour :\n- ${products.join("\n- ")}\n\nMerci de me préciser la disponibilité, le conditionnement et les conditions commerciales.`
    : "Bonjour,\n\nJe souhaite recevoir une offre commerciale.\n\nMerci de me contacter.";
}

function updateDockSpace() {
  if (!quoteDock) {
    return;
  }
  const isEmpty = quoteDock.dataset.empty === "true";
  const space = isEmpty ? 0 : quoteDock.offsetHeight + 32;
  document.body.style.setProperty("--dock-space", `${space}px`);
}

function syncQuoteButtons() {
  quoteButtons.forEach((button) => {
    const isSelected = selectedProducts.has(button.dataset.quoteProduct);
    button.classList.toggle("is-selected", isSelected);
    button.setAttribute("aria-pressed", String(isSelected));
    button.textContent = isSelected ? "Ajouté au devis" : "Ajouter au devis";
  });
}

function renderChips(products) {
  if (!quoteChips) {
    return;
  }

  quoteChips.replaceChildren(
    ...products.map((product) => {
      const item = document.createElement("li");
      const button = document.createElement("button");
      button.type = "button";
      button.textContent = product;
      button.setAttribute("aria-label", `Retirer ${product} de la sélection`);
      button.addEventListener("click", () => toggleProduct(product));
      item.append(button);
      return item;
    })
  );
}

function syncQuoteActions() {
  const products = Array.from(selectedProducts);
  writeSelection(products);
  syncQuoteButtons();

  if (quoteSummary) {
    quoteSummary.textContent = products.length
      ? `${products.length} produit${products.length > 1 ? "s" : ""} sélectionné${products.length > 1 ? "s" : ""}`
      : "Aucun produit sélectionné";
  }

  if (quoteCount) {
    quoteCount.textContent = String(products.length);
  }

  renderChips(products);

  if (quoteDock) {
    quoteDock.dataset.empty = String(products.length === 0);
    updateDockSpace();
  }

  if (quoteMail) {
    const subject = encodeURIComponent("Demande de devis - Groupe Babia Guinée");
    quoteMail.setAttribute(
      "href",
      `mailto:${CONTACT_EMAIL}?subject=${subject}&body=${encodeURIComponent(quoteBody(products))}`
    );
  }

  if (quoteWhatsApp) {
    const whatsappText = encodeURIComponent(
      products.length
        ? `Bonjour Groupe Babia, je souhaite un devis pour : ${products.join(", ")}.`
        : "Bonjour Groupe Babia, je souhaite recevoir un devis."
    );
    quoteWhatsApp.setAttribute("href", `https://wa.me/${WHATSAPP_NUMBER}?text=${whatsappText}`);
  }
}

function toggleProduct(product) {
  if (selectedProducts.has(product)) {
    selectedProducts.delete(product);
    showToast(`${product} retiré de la sélection`);
  } else {
    selectedProducts.add(product);
    showToast(`${product} ajouté au devis`);
  }
  syncQuoteActions();
}

quoteButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const product = button.dataset.quoteProduct;
    if (product) {
      toggleProduct(product);
    }
  });
});

quoteClear?.addEventListener("click", () => {
  selectedProducts.clear();
  syncQuoteActions();
  showToast("Sélection vidée");
});

if (quoteButtons.length || quoteDock) {
  syncQuoteActions();
  window.addEventListener("resize", updateDockSpace);
}

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
      filterResult.textContent = `${visible} produit${visible > 1 ? "s" : ""} affiché${visible > 1 ? "s" : ""}`;
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
  const prefillNode = document.querySelector("[data-form-prefill]");
  const prefillText = document.querySelector("[data-form-prefill-text]");
  const needField = contactForm.elements.namedItem("need");
  const messageField = contactForm.elements.namedItem("message");

  const NEED_BY_PARAM = {
    agro: "Demande agroalimentaire export/import",
    btp: "Projet BTP",
    mines: "Partenariat minier",
    peche: "Activité de pêche",
    "agro-industrie": "Projet agro-industriel",
    corporate: "Information corporate"
  };

  const ERROR_MESSAGES = {
    valueMissing: "Ce champ est nécessaire pour traiter votre demande.",
    typeMismatch: "Le format saisi ne semble pas valide."
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

  function showError(control) {
    const wrapper = fieldWrapper(control);
    if (!wrapper) {
      return;
    }

    const errorNode = wrapper.querySelector(".field-error");
    if (errorNode) {
      errorNode.textContent = control.validity.valueMissing
        ? ERROR_MESSAGES.valueMissing
        : ERROR_MESSAGES.typeMismatch;
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

  function messageBody() {
    const data = new FormData(contactForm);
    const value = (key) => String(data.get(key) ?? "").trim() || "-";

    return [
      "Bonjour Groupe Babia,",
      "",
      `Nom : ${value("name")}`,
      `Entreprise : ${value("company")}`,
      `E-mail : ${value("email")}`,
      `Téléphone : ${value("phone")}`,
      `Besoin : ${value("need")}`,
      "",
      "Message :",
      value("message"),
      "",
      "Merci de me recontacter."
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

  contactForm.addEventListener("submit", (event) => {
    event.preventDefault();

    if (!validate({ focusFirst: true })) {
      setStatus(
        "Quelques informations manquent",
        "Corrigez les champs signalés en rouge, puis renvoyez votre demande.",
        "error"
      );
      return;
    }

    syncWhatsApp();

    // mailto: peut ne rien declencher si aucun client mail n'est configure :
    // on annonce ce qui vient de se passer et on laisse deux solutions de repli.
    setStatus(
      "Votre message est prêt",
      `Votre logiciel de messagerie doit s'ouvrir avec le message pré-rempli, à destination de ${CONTACT_EMAIL}. S'il ne s'ouvre pas, copiez le message ou passez par WhatsApp.`
    );

    window.location.href = mailtoLink();
  });

  copyButton?.addEventListener("click", async () => {
    const text = `À : ${CONTACT_EMAIL}\n\n${messageBody()}`;
    try {
      await navigator.clipboard.writeText(text);
      showToast("Message copié dans le presse-papiers");
    } catch {
      showToast(`Copie impossible. Écrivez-nous à ${CONTACT_EMAIL}`);
    }
  });

  // Pre-remplissage : pole d'origine (?besoin=btp) et selection du catalogue.
  const params = new URLSearchParams(window.location.search);
  const requestedNeed = NEED_BY_PARAM[params.get("besoin") ?? ""];

  if (requestedNeed && needField instanceof HTMLSelectElement) {
    needField.value = requestedNeed;
  }

  const savedSelection = readSelection();

  if (savedSelection.length && messageField instanceof HTMLTextAreaElement && !messageField.value) {
    messageField.value = `Produits qui m'intéressent :\n- ${savedSelection.join("\n- ")}\n\nVolumes, destination et calendrier : `;

    if (prefillNode && prefillText) {
      prefillText.textContent = `${savedSelection.length} produit${savedSelection.length > 1 ? "s" : ""} repris depuis le catalogue.`;
      prefillNode.hidden = false;
    }
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
