<?php

declare(strict_types=1);

require_once __DIR__ . '/app/public/realisations.php';

$publicationState = public_fetch_realisations(12);
$realisations = $publicationState['items'];
$databaseAvailable = $publicationState['available'];
$publicReadError = $publicationState['error'];
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
      (function (racine) {
        racine.classList.add("js");
        window.__babiaReveal = window.setTimeout(function () {
          racine.classList.add("no-reveal");
        }, 2000);
      })(document.documentElement);
    </script>
    <meta name="description" content="Découvrez les réalisations de Groupe Babia Guinée dans l'agroalimentaire, le BTP, les mines, la pêche et l'agro-industrie.">
    <title>Réalisations | Groupe Babia Guinée</title>
    <link rel="icon" href="assets/images/favicon.png" sizes="32x32">
    <link rel="stylesheet" href="assets/css/styles.css?v=20260822-media-height">
    <link rel="canonical" href="https://www.groupebabia.com/realisations.php">
    <link rel="alternate" hreflang="en" href="https://www.groupebabia.com/en/projects.php">
    <link rel="alternate" hreflang="fr" href="https://www.groupebabia.com/realisations.php">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Groupe Babia Guinée">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:url" content="https://www.groupebabia.com/realisations.php">
    <meta property="og:title" content="Réalisations | Groupe Babia Guinée">
    <meta property="og:description" content="Activités réalisées et références publiées par Groupe Babia Guinée.">
    <meta property="og:image" content="https://www.groupebabia.com/assets/images/partage-social.jpg">
    <meta name="twitter:card" content="summary_large_image">
  </head>
  <body>
    <a class="skip-link" href="#contenu">Aller au contenu principal</a>
    <header class="site-header" data-header>
      <a class="brand" href="index.html" aria-label="Accueil Groupe Babia Guinée">
        <img src="assets/images/logo.webp" alt="" class="brand-logo" width="128" height="128" decoding="async">
        <span><strong>Groupe Babia</strong><small>Guinée</small></span>
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Ouvrir le menu" data-nav-toggle><span></span><span></span><span></span></button>
      <nav class="site-nav" id="site-nav" data-nav>
        <a href="index.html">Accueil</a>
        <a href="groupe.html">Le groupe</a>
        <a href="agroalimentaire.html">Agroalimentaire</a>
        <a href="btp.html">BTP</a>
        <a href="mines.html">Mines</a>
        <a href="catalogue.html">Catalogue</a>
        <a class="is-active" href="realisations.php">Réalisations</a>
        <a href="contact.html">Contact</a>
        <a class="language-link" href="en/projects.php" hreflang="en">EN</a>
        <a class="nav-cta" href="contact.html#formulaire">Demander un devis</a>
      </nav>
    </header>

    <main id="contenu" tabindex="-1">
      <section class="page-hero">
        <img class="page-hero-media" src="assets/images/agro-industrie.webp" alt="" width="1704" height="923" fetchpriority="high" decoding="async">
        <div class="page-hero-overlay"></div>
        <div>
          <nav class="breadcrumb" aria-label="Fil d'Ariane"><ol><li><a href="index.html">Accueil</a></li><li><span aria-current="page">Réalisations</span></li></ol></nav>
          <p class="eyebrow">Références & activités</p>
          <h1>Réalisations publiées</h1>
          <p>Cette page rassemble les opérations, références et activités que Groupe Babia Guinée choisit de rendre publiques dans ses pôles agroalimentaire, BTP, mines, pêche et agro-industrie.</p>
          <div class="page-actions">
            <a class="button button-primary" href="contact.html#formulaire">Présenter un projet</a>
            <a class="button button-secondary" href="catalogue.html">Voir le catalogue</a>
          </div>
        </div>
        <aside class="page-hero-card">
          <strong>Mise à jour</strong>
          <p>Les contenus publiés ici proviennent du back office et restent visibles uniquement après validation.</p>
        </aside>
      </section>

      <section class="section soft-section">
        <div class="section-heading">
          <p class="eyebrow">Publications</p>
          <h2>Activités réalisées</h2>
          <p>Un aperçu structuré des références que l'entreprise souhaite partager avec ses partenaires.</p>
        </div>

        <?php if ($realisations !== []): ?>
          <?php public_render_realisations_grid($realisations); ?>
        <?php else: ?>
          <div class="empty-state">
            <p class="eyebrow">Bientôt</p>
            <h3>Les premières réalisations publiques seront ajoutées depuis le back office.</h3>
            <p>
              <?php if ($publicReadError): ?>
                Les contenus ne peuvent pas être chargés pour le moment. La page reste disponible et sera alimentée dès que la connexion MySQL sera rétablie.
              <?php elseif (!$databaseAvailable): ?>
                La base MySQL n'est pas encore configurée sur cet environnement. Les publications apparaîtront ici après la mise en service du back office.
              <?php else: ?>
                Aucune réalisation n'est encore publiée. Les brouillons restent invisibles jusqu'à validation.
              <?php endif; ?>
            </p>
            <div class="page-actions">
              <a class="button button-primary" href="contact.html#formulaire">Contacter l'équipe</a>
              <a class="button button-secondary" href="groupe.html">Découvrir le groupe</a>
            </div>
          </div>
        <?php endif; ?>
      </section>

      <section class="contact-band">
        <div>
          <p class="eyebrow">Partenariat</p>
          <h2>Vous souhaitez présenter une opération ou qualifier une demande ?</h2>
          <p>L'équipe Groupe Babia oriente chaque échange vers le pôle métier concerné.</p>
        </div>
        <a class="button button-primary" href="contact.html#formulaire">Demander un échange</a>
      </section>
    </main>

    <footer class="site-footer">
      <div class="footer-card">
        <div class="footer-main">
          <div class="footer-brand">
            <a class="footer-logo" href="index.html" aria-label="Accueil Groupe Babia Guinée">
              <img src="assets/images/logo.webp" alt="" width="128" height="128" decoding="async">
              <strong>Groupe Babia</strong>
            </a>
            <p>Groupe multisectoriel guinéen actif dans l'agriculture, l'agro-industrie, le BTP, la pêche et les services au secteur minier, au service de partenaires locaux et internationaux.</p>
            <div class="footer-socials" aria-label="Contacts directs"><a href="mailto:infobabiaguinee@gmail.com" aria-label="Nous écrire par e-mail" title="E-mail"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4.2-8 5-8-5V6l8 5 8-5Z"/></svg></a><a href="tel:+224655903333" aria-label="Appeler le +224 655 903 333" title="Téléphone"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24 11.4 11.4 0 0 0 3.6.58 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.4 11.4 0 0 0 .57 3.6 1 1 0 0 1-.25 1Z"/></svg></a><a href="https://wa.me/224620903333" aria-label="Écrire sur WhatsApp au +224 620 903 333" title="WhatsApp"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2Zm5.1 14.1c-.2.6-1.2 1.2-1.7 1.2-.5.1-1 .1-1.6-.1a13.6 13.6 0 0 1-5.3-4.6c-.4-.6-.9-1.4-.9-2.3 0-.9.5-1.3.7-1.5.2-.2.4-.3.6-.3h.4c.2 0 .4 0 .6.4l.7 1.7c.1.2 0 .4-.1.5l-.3.4c-.1.1-.2.3-.1.5a8 8 0 0 0 3.4 3c.2.1.4.1.5 0l.7-.8c.2-.2.3-.2.5-.1l1.7.8c.2.1.4.2.4.3.1.2.1.6 0 .9Z"/></svg></a></div>
          </div>
          <nav class="footer-columns" aria-label="Navigation pied de page">
            <div>
              <strong>Groupe</strong>
              <a href="index.html">Accueil</a>
              <a href="groupe.html">Le groupe</a>
              <a href="contact.html">Contact</a>
            </div>
            <div>
              <strong>Activités</strong>
              <a href="agroalimentaire.html">Agroalimentaire</a>
              <a href="btp.html">BTP</a>
              <a href="mines.html">Mines</a>
              <a href="catalogue.html">Catalogue</a>
              <a href="realisations.php">Réalisations</a>
            </div>
            <div>
              <strong>Contact</strong>
              <a href="mailto:infobabiaguinee@gmail.com">E-mail</a>
              <a href="tel:+224655903333">+224 655 903 333</a>
              <a href="https://wa.me/224620903333">WhatsApp</a>
              <a href="contact.html">Demander un devis</a>
              <a href="catalogue.html">Sélection produits</a>
            </div>
          </nav>
        </div>
        <div class="footer-bottom">
          <p>© 2026 Groupe Babia Guinée. Tous droits réservés.</p>
          <div>
            <a href="mentions-legales.html">Mentions légales</a>
            <a href="confidentialite.html">Confidentialité</a>
          </div>
        </div>
      </div>
    </footer>
    <script src="assets/js/main.js"></script>
  </body>
</html>
