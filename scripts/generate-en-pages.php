<?php

declare(strict_types=1);

require dirname(__DIR__) . '/app/helpers.php';

$pages = [
    'index' => [
        'file' => 'index.html',
        'fr' => '../index.html',
        'title' => 'Groupe Babia Guinea | Agriculture, Construction, Mining and Fishing',
        'description' => 'Groupe Babia Guinea is a multisector partner based in Conakry, active in agricultural trade, food imports, construction, mining services, fishing and agro-industry.',
        'active' => 'home',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => <<<HTML
          <section class="hero inner-hero" aria-label="Groupe Babia Guinea overview">
            <img class="inner-hero-image" src="../assets/images/hero-agro-export-import.webp" alt="Agricultural products ready for international trade" width="1600" height="900" fetchpriority="high" decoding="async">
            <div class="inner-hero-overlay"></div>
            <div class="inner-hero-content">
              <p class="eyebrow">Trade, projects and partnerships from Conakry</p>
              <h1>Groupe Babia Guinea</h1>
              <p>We export agricultural products, import food commodities and support construction, mining, fishing and agro-industrial projects for buyers, distributors, institutions and companies.</p>
              <div class="hero-actions">
                <a class="button button-primary" href="catalog.html">Explore products</a>
                <a class="button button-secondary" href="contact.html#formulaire">Request a quotation</a>
              </div>
            </div>
          </section>

          <section class="section" id="activities">
            <div class="section-heading">
              <p class="eyebrow">Activities</p>
              <h2>A multisector partner for practical business needs</h2>
              <p>Groupe Babia works across complementary sectors where reliability, sourcing capacity and operational follow-up matter.</p>
            </div>
            <div class="activity-grid">
              <article class="activity-card"><img src="../assets/images/agro-cajou.webp" alt="Raw cashew nuts" width="800" height="1000" loading="lazy" decoding="async"><div><small>Export</small><h3>Agricultural products</h3><p>Cocoa beans, coffee beans, raw cashew nuts, soya beans, shea butter, honey, sesame seeds and fruits.</p><a href="agri-food.html">View agri-food trade</a></div></article>
              <article class="activity-card"><img src="../assets/images/btp.webp" alt="Construction site" width="626" height="417" loading="lazy" decoding="async"><div><small>Projects</small><h3>Construction and public works</h3><p>Support for construction and infrastructure projects with attention to scope, deadlines and coordination.</p><a href="construction.html">View construction</a></div></article>
              <article class="activity-card"><img src="../assets/images/mines.webp" alt="Mining operations" width="1600" height="1064" loading="lazy" decoding="async"><div><small>Mining</small><h3>Mining services and partnerships</h3><p>Operational support, supply and partnership opportunities for responsible mining activities.</p><a href="mining.html">View mining</a></div></article>
            </div>
          </section>

          <section class="section soft-section">
            <div class="section-heading">
              <p class="eyebrow">For international buyers</p>
              <h2>Clear information before any quotation</h2>
            </div>
            <div class="service-grid">
              <article class="service-card"><small>01</small><h3>Products and quantities</h3><p>Share the product, requested volume, packaging expectations, destination and timing.</p></article>
              <article class="service-card"><small>02</small><h3>Reliable follow-up</h3><p>The team qualifies each request before directing it to the relevant business area.</p></article>
              <article class="service-card"><small>03</small><h3>Direct contact</h3><p>Requests can be sent through the form, by email or directly through WhatsApp.</p></article>
            </div>
          </section>
HTML,
    ],
    'company' => [
        'file' => 'company.html',
        'fr' => '../groupe.html',
        'title' => 'Company | Groupe Babia Guinea',
        'description' => 'Discover Groupe Babia Guinea, a multisector company based in Conakry serving local and international partners.',
        'active' => 'company',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => <<<HTML
          <section class="hero inner-hero">
            <img class="inner-hero-image" src="../assets/images/hero-agro-export-import.webp" alt="Groupe Babia business environment" width="1600" height="900" fetchpriority="high" decoding="async">
            <div class="inner-hero-overlay"></div>
            <div class="inner-hero-content"><p class="eyebrow">Company</p><h1>A Guinean group open to international partnerships</h1><p>Groupe Babia brings together trading, project and operational activities with a practical approach: understand the need, qualify the request, mobilize the right business unit and follow through.</p></div>
          </section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Positioning</p><h2>Built around useful sectors</h2><p>The group is active in agriculture, agri-food imports, construction and public works, mining support, fishing and agro-industrial opportunities.</p></div><div class="content-questions"><article><h3>Local roots</h3><p>Based in Conakry, Groupe Babia works from Guinea while addressing both local and international needs.</p></article><article><h3>Business clarity</h3><p>The company structures requests by sector so buyers, partners and institutions know where to start.</p></article><article><h3>Long-term view</h3><p>The website is designed to grow with verified projects, references, official documents and a future back office.</p></article></div></section>
          <section class="section soft-section"><div class="section-heading"><p class="eyebrow">Working method</p><h2>A request is first qualified, then directed</h2></div><div class="timeline"><article><span>01</span><h3>Need received</h3><p>Product, volume, project type, destination and timing are collected.</p></article><article><span>02</span><h3>Scope clarified</h3><p>The team checks whether the request belongs to trade, construction, mining, fishing or agro-industry.</p></article><article><span>03</span><h3>Commercial response</h3><p>The visitor receives a targeted follow-up instead of a generic answer.</p></article></div></section>
HTML,
    ],
    'agri-food' => [
        'file' => 'agri-food.html',
        'fr' => '../agroalimentaire.html',
        'title' => 'Agri-food Export and Import | Groupe Babia Guinea',
        'description' => 'Agricultural exports and food imports: cocoa beans, coffee beans, raw cashew nuts, soya beans, shea butter, honey, sesame seeds, fruits, rice, juice, tomatoes, onions and edible oil.',
        'active' => 'agri-food',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => <<<HTML
          <section class="hero inner-hero"><img class="inner-hero-image" src="../assets/images/hero-agro-export-import.webp" alt="Agri-food export and import products" width="1600" height="900" fetchpriority="high" decoding="async"><div class="inner-hero-overlay"></div><div class="inner-hero-content"><p class="eyebrow">Agri-food trade</p><h1>Agricultural exports and food imports</h1><p>Groupe Babia supports buyers and distributors looking for agricultural products from Guinea and food commodities for the local market.</p><div class="hero-actions"><a class="button button-primary" href="catalog.html">View products</a><a class="button button-secondary" href="contact.html#formulaire">Request a quotation</a></div></div></section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Exports</p><h2>Agricultural products confirmed by the client</h2></div><div class="product-grid"><article class="product-card"><h3>Cocoa beans</h3><p>Requests are qualified by quantity, destination, timing and documentation needs.</p></article><article class="product-card"><h3>Coffee beans</h3><p>Supply discussions can include volumes, quality expectations and logistics.</p></article><article class="product-card"><h3>Raw cashew nuts</h3><p>Commercial requests should specify crop, quantity, packaging and destination.</p></article><article class="product-card"><h3>Soya beans</h3><p>Structured requests help prepare a relevant first response.</p></article><article class="product-card"><h3>Shea butter, honey and sesame seeds</h3><p>Available as part of the confirmed agricultural export range.</p></article><article class="product-card"><h3>Fruits</h3><p>Requests must include destination, freshness constraints and desired timing.</p></article></div></section>
          <section class="section soft-section"><div class="section-heading"><p class="eyebrow">Imports</p><h2>Food products for local demand</h2><p>Juice, rice, tomatoes, onions and edible oil are part of the import scope shared by the client.</p></div></section>
HTML,
    ],
    'construction' => [
        'file' => 'construction.html',
        'fr' => '../btp.html',
        'title' => 'Construction and Public Works | Groupe Babia Guinea',
        'description' => 'Groupe Babia supports construction and public works opportunities in Guinea through project qualification, coordination and partner follow-up.',
        'active' => 'construction',
        'hero' => 'assets/images/btp.webp',
        'body' => <<<HTML
          <section class="hero inner-hero"><img class="inner-hero-image" src="../assets/images/btp.webp" alt="Construction and public works" width="626" height="417" fetchpriority="high" decoding="async"><div class="inner-hero-overlay"></div><div class="inner-hero-content"><p class="eyebrow">Construction</p><h1>Construction and public works</h1><p>For construction and infrastructure requests, Groupe Babia helps clarify the scope, location, timing, constraints and available documents before commercial follow-up.</p><div class="hero-actions"><a class="button button-primary" href="contact.html?need=construction#formulaire">Discuss a project</a></div></div></section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Project requests</p><h2>What helps the team respond faster</h2></div><div class="service-grid"><article class="service-card"><small>01</small><h3>Scope</h3><p>Type of work, expected result, location and responsibilities.</p></article><article class="service-card"><small>02</small><h3>Timing</h3><p>Target dates, urgency, available plans or site information.</p></article><article class="service-card"><small>03</small><h3>Partners</h3><p>Organizations involved and documents already available.</p></article></div></section>
HTML,
    ],
    'mining' => [
        'file' => 'mining.html',
        'fr' => '../mines.html',
        'title' => 'Mining Services and Partnerships | Groupe Babia Guinea',
        'description' => 'Mining-related support, supply and partnership opportunities handled with attention to reliability, safety and responsible local value.',
        'active' => 'mining',
        'hero' => 'assets/images/mines.webp',
        'body' => <<<HTML
          <section class="hero inner-hero"><img class="inner-hero-image" src="../assets/images/mines.webp" alt="Mining operations in an open pit environment" width="1600" height="1064" fetchpriority="high" decoding="async"><div class="inner-hero-overlay"></div><div class="inner-hero-content"><p class="eyebrow">Mining</p><h1>Mining services and partnerships</h1><p>Groupe Babia positions itself as a practical partner for mining-related requests, operational support, supply needs and cooperation opportunities.</p></div></section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Approach</p><h2>Responsible support starts with a clear perimeter</h2></div><div class="content-questions"><article><h3>Operational needs</h3><p>Describe the service, supply or support required and the site context.</p></article><article><h3>Compliance and safety</h3><p>Requests must identify the constraints, stakeholders and documentation required.</p></article><article><h3>Local value</h3><p>The objective is to support useful partnerships while respecting operational realities.</p></article></div></section>
HTML,
    ],
    'catalog' => [
        'file' => 'catalog.html',
        'fr' => '../catalogue.html',
        'title' => 'Product Catalog | Groupe Babia Guinea',
        'description' => 'Browse the confirmed agri-food export and import product scope of Groupe Babia Guinea.',
        'active' => 'catalog',
        'hero' => 'assets/images/agro-cajou.webp',
        'body' => <<<HTML
          <section class="hero inner-hero"><img class="inner-hero-image" src="../assets/images/agro-cajou.webp" alt="Agricultural products catalog" width="800" height="1000" fetchpriority="high" decoding="async"><div class="inner-hero-overlay"></div><div class="inner-hero-content"><p class="eyebrow">Catalog</p><h1>Products handled by Groupe Babia</h1><p>The catalog presents the agricultural export products and food import products confirmed by the client. For a quotation, share product, volume, destination and timing.</p><div class="hero-actions"><a class="button button-primary" href="contact.html#formulaire">Request a quotation</a></div></div></section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Exports</p><h2>Agricultural products</h2></div><div class="product-grid"><article class="product-card"><h3>Cocoa beans</h3><p>Export request</p></article><article class="product-card"><h3>Coffee beans</h3><p>Export request</p></article><article class="product-card"><h3>Raw cashew nuts</h3><p>Export request</p></article><article class="product-card"><h3>Soya beans</h3><p>Export request</p></article><article class="product-card"><h3>Shea butter</h3><p>Export request</p></article><article class="product-card"><h3>Honey</h3><p>Export request</p></article><article class="product-card"><h3>Sesame seeds</h3><p>Export request</p></article><article class="product-card"><h3>Fruits</h3><p>Export request</p></article></div></section>
          <section class="section soft-section"><div class="section-heading"><p class="eyebrow">Imports</p><h2>Food commodities</h2></div><div class="product-grid"><article class="product-card"><h3>Juice</h3><p>Import request</p></article><article class="product-card"><h3>Rice</h3><p>Import request</p></article><article class="product-card"><h3>Tomatoes</h3><p>Import request</p></article><article class="product-card"><h3>Onions</h3><p>Import request</p></article><article class="product-card"><h3>Edible oil</h3><p>Import request</p></article></div></section>
HTML,
    ],
    'projects' => [
        'file' => 'projects.html',
        'fr' => '../realisations.php',
        'title' => 'Projects | Groupe Babia Guinea',
        'description' => 'Future verified projects and company references from Groupe Babia Guinea.',
        'active' => 'projects',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => <<<HTML
          <section class="hero inner-hero"><img class="inner-hero-image" src="../assets/images/hero-agro-export-import.webp" alt="Groupe Babia projects" width="1600" height="900" fetchpriority="high" decoding="async"><div class="inner-hero-overlay"></div><div class="inner-hero-content"><p class="eyebrow">Projects</p><h1>Verified company projects</h1><p>Client-approved projects and references will be published here when Groupe Babia provides the official information, images and authorization to display them.</p></div></section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Coming next</p><h2>No invented references</h2><p>This English page is ready for real projects, but it does not publish unverified client names, figures or achievements.</p></div></section>
HTML,
    ],
    'contact' => [
        'file' => 'contact.html',
        'fr' => '../contact.html',
        'title' => 'Contact | Groupe Babia Guinea',
        'description' => 'Contact Groupe Babia Guinea for agri-food trade, construction, mining, fishing and partnership requests.',
        'active' => 'contact',
        'hero' => 'assets/images/btp.webp',
        'body' => <<<HTML
          <section class="hero inner-hero"><img class="inner-hero-image" src="../assets/images/btp.webp" alt="Preparing a business request" width="1600" height="900" fetchpriority="high" decoding="async"><div class="inner-hero-overlay"></div><div class="inner-hero-content"><p class="eyebrow">Contact</p><h1>Send a clear business request</h1><p>Share your product, quantity, project scope, destination and timing. The team will direct your message to the right business area.</p></div></section>
          <section class="section contact-section" id="formulaire"><div class="section-heading"><p class="eyebrow">Request</p><h2>Contact form</h2></div>
            <form class="form-card" method="post" action="../contact-submit.php" data-contact-form>
              <div class="field-grid"><div class="field"><label for="name">Name <span class="required-mark" aria-hidden="true">*</span></label><input id="name" name="name" type="text" autocomplete="name" required><p class="field-error" id="name-error"></p></div><div class="field"><label for="company">Company <span class="required-mark" aria-hidden="true">*</span></label><input id="company" name="company" type="text" autocomplete="organization" required><p class="field-error" id="company-error"></p></div></div>
              <div class="field-grid"><div class="field"><label for="email">Email <span class="required-mark" aria-hidden="true">*</span></label><input id="email" name="email" type="email" autocomplete="email" required><p class="field-error" id="email-error"></p></div><div class="field"><label for="phone">Phone / WhatsApp <span class="optional">(optional)</span></label><input id="phone" name="phone" type="tel" autocomplete="tel"><p class="field-error" id="phone-error"></p></div></div>
              <div class="field"><label for="need">Request type</label><select id="need" name="need"><option value="Agri-food export/import request">Agri-food export/import request</option><option value="Construction project">Construction project</option><option value="Mining partnership">Mining partnership</option><option value="Fishing activity">Fishing activity</option><option value="Agro-industrial project">Agro-industrial project</option><option value="Corporate information">Corporate information</option></select></div>
              <div class="field-grid"><div class="field"><label for="destination">Country / destination <span class="optional">(optional)</span></label><input id="destination" name="destination" type="text" autocomplete="country-name"><p class="field-error" id="destination-error"></p></div><div class="field"><label for="timeline">Expected timing <span class="optional">(optional)</span></label><input id="timeline" name="timeline" type="text"><p class="field-error" id="timeline-error"></p></div></div>
              <div class="field"><label for="message">Message <span class="required-mark" aria-hidden="true">*</span></label><textarea id="message" name="message" placeholder="Describe the product, quantity, project, destination or timing." required></textarea><p class="field-error" id="message-error"></p></div>
              <input type="hidden" name="lang" value="en">
              <div class="visually-hidden" aria-hidden="true"><label for="website">Website</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
              <div class="form-actions"><button class="button button-primary" type="submit" data-loading-text="Sending...">Send request</button><a class="button button-dark" href="https://wa.me/224620903333" data-contact-whatsapp>Send on WhatsApp</a></div>
              <div class="form-status" role="status" aria-live="polite" data-form-status hidden><strong data-form-status-title></strong><span data-form-status-text></span><span class="status-actions"><button class="link-button" type="button" data-copy-message>Copy message</button><a class="link-button" href="mailto:infobabiaguinee@gmail.com">infobabiaguinee@gmail.com</a></span></div>
            </form>
          </section>
HTML,
    ],
    'legal' => [
        'file' => 'legal.html',
        'fr' => '../mentions-legales.html',
        'title' => 'Legal Notice | Groupe Babia Guinea',
        'description' => 'Legal notice for the Groupe Babia Guinea website.',
        'active' => '',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => '<section class="section legal-page"><div class="section-heading"><p class="eyebrow">Legal notice</p><h1>Legal notice</h1><p>This English version is provided for convenience. The French legal version remains the reference version.</p></div><div class="content-questions"><article><h3>Website publisher</h3><p>Groupe Babia Guinea, Conakry, Guinea. Email: infobabiaguinee@gmail.com. Phone: +224 655 903 333.</p></article><article><h3>Hosting</h3><p>The website is hosted on Bluehost infrastructure for the domain groupebabia.com.</p></article><article><h3>Intellectual property</h3><p>Texts, structure, visuals and brand elements may not be reused without authorization.</p></article></div></section>',
    ],
    'privacy' => [
        'file' => 'privacy.html',
        'fr' => '../confidentialite.html',
        'title' => 'Privacy Policy | Groupe Babia Guinea',
        'description' => 'Privacy policy for contact requests sent through the Groupe Babia Guinea website.',
        'active' => '',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => '<section class="section legal-page"><div class="section-heading"><p class="eyebrow">Privacy</p><h1>Privacy policy</h1><p>This English version is provided for convenience. The French privacy policy remains the reference version.</p></div><div class="content-questions"><article><h3>Data collected</h3><p>The contact form may collect name, company, email, phone number, request type, destination, timing and message.</p></article><article><h3>Purpose</h3><p>Data is used only to process commercial requests and follow up with the sender.</p></article><article><h3>Retention</h3><p>Archived contact messages are permanently deleted after 30 days.</p></article></div></section>',
    ],
    '404' => [
        'file' => '404.html',
        'fr' => '../404.html',
        'title' => 'Page Not Found | Groupe Babia Guinea',
        'description' => 'The requested page could not be found.',
        'active' => '',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => '<section class="section legal-page"><div class="section-heading"><p class="eyebrow">404</p><h1>Page not found</h1><p>The page you requested does not exist or has moved.</p><div class="hero-actions"><a class="button button-primary" href="index.html">Back to home</a><a class="button button-secondary" href="contact.html">Contact the team</a></div></div></section>',
    ],
];

function nav(array $page): string
{
    $items = [
        'home' => ['Home', 'index.html'],
        'company' => ['Company', 'company.html'],
        'agri-food' => ['Agri-food', 'agri-food.html'],
        'construction' => ['Construction', 'construction.html'],
        'mining' => ['Mining', 'mining.html'],
        'catalog' => ['Catalog', 'catalog.html'],
        'projects' => ['Projects', 'projects.html'],
        'contact' => ['Contact', 'contact.html'],
    ];
    $html = '';
    foreach ($items as $key => [$label, $href]) {
        $class = $page['active'] === $key ? ' class="is-active"' : '';
        $html .= "        <a{$class} href=\"{$href}\">{$label}</a>\n";
    }
    $html .= "        <a class=\"language-link\" href=\"{$page['fr']}\" hreflang=\"fr\">FR</a>\n";
    $html .= "        <a class=\"nav-cta\" href=\"contact.html#formulaire\">Request a quote</a>\n";

    return $html;
}

function page_html(array $page): string
{
    $canonical = 'https://www.groupebabia.com/en/' . $page['file'];
    if ($page['file'] === 'index.html') {
        $canonical = 'https://www.groupebabia.com/en/';
    }
    $frenchPath = ltrim((string) $page['fr'], './');
    if (str_starts_with($frenchPath, '../')) {
        $frenchPath = substr($frenchPath, 3);
    }
    if ($frenchPath === 'index.html') {
        $frenchPath = '';
    }
    $frenchCanonical = 'https://www.groupebabia.com/' . $frenchPath;

    return <<<HTML
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>(function (root) { root.classList.add("js"); window.__babiaReveal = window.setTimeout(function () { root.classList.add("no-reveal"); }, 2000); })(document.documentElement);</script>
    <meta name="description" content="{$page['description']}">
    <title>{$page['title']}</title>
    <link rel="icon" href="../assets/images/favicon.png" sizes="32x32">
    <link rel="preload" href="../assets/fonts/Montserrat-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="../assets/fonts/Montserrat-SemiBold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="canonical" href="{$canonical}">
    <link rel="alternate" hreflang="fr" href="{$frenchCanonical}">
    <link rel="alternate" hreflang="en" href="{$canonical}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Groupe Babia Guinea">
    <meta property="og:locale" content="en_US">
    <meta property="og:url" content="{$canonical}">
    <meta property="og:title" content="{$page['title']}">
    <meta property="og:description" content="{$page['description']}">
    <meta property="og:image" content="https://www.groupebabia.com/assets/images/partage-social.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{$page['title']}">
    <meta name="twitter:description" content="{$page['description']}">
    <meta name="twitter:image" content="https://www.groupebabia.com/assets/images/partage-social.jpg">
  </head>
  <body>
    <a class="skip-link" href="#content">Skip to main content</a>
    <header class="site-header" data-header>
      <a class="brand" href="index.html" aria-label="Groupe Babia Guinea home">
        <img src="../assets/images/logo.webp" alt="" class="brand-logo" width="128" height="128" decoding="async">
        <span><strong>Groupe Babia</strong><small>Guinea</small></span>
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Open menu" data-nav-toggle><span></span><span></span><span></span></button>
      <nav class="site-nav" id="site-nav" data-nav>
HTML
    . nav($page) .
    <<<HTML
      </nav>
    </header>
    <main id="content" tabindex="-1">
{$page['body']}
    </main>
    <footer class="site-footer">
      <div class="footer-card">
        <div class="footer-main">
          <div class="footer-brand">
            <a class="footer-logo" href="index.html" aria-label="Groupe Babia Guinea home"><img src="../assets/images/logo.webp" alt="" width="128" height="128" decoding="async"><strong>Groupe Babia</strong></a>
            <p>A Guinean multisector group active in agriculture, agri-food, construction, fishing and mining-related services for local and international partners.</p>
            <div class="footer-socials" aria-label="Direct contacts"><a href="mailto:infobabiaguinee@gmail.com" aria-label="Email Groupe Babia" title="Email"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4.2-8 5-8-5V6l8 5 8-5Z"/></svg></a><a href="tel:+224655903333" aria-label="Call +224 655 903 333" title="Phone"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24 11.4 11.4 0 0 0 3.6.58 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.4 11.4 0 0 0 .57 3.6 1 1 0 0 1-.25 1Z"/></svg></a><a href="https://wa.me/224620903333" aria-label="WhatsApp +224 620 903 333" title="WhatsApp"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2Zm5.1 14.1c-.2.6-1.2 1.2-1.7 1.2-.5.1-1 .1-1.6-.1a13.6 13.6 0 0 1-5.3-4.6c-.4-.6-.9-1.4-.9-2.3 0-.9.5-1.3.7-1.5.2-.2.4-.3.6-.3h.4c.2 0 .4 0 .6.4l.7 1.7c.1.2 0 .4-.1.5l-.3.4c-.1.1-.2.3-.1.5a8 8 0 0 0 3.4 3c.2.1.4.1.5 0l.7-.8c.2-.2.3-.2.5-.1l1.7.8c.2.1.4.2.4.3.1.2.1.6 0 .9Z"/></svg></a></div>
          </div>
          <nav class="footer-columns" aria-label="Footer navigation">
            <div><strong>Company</strong><a href="index.html">Home</a><a href="company.html">Company</a><a href="contact.html">Contact</a></div>
            <div><strong>Activities</strong><a href="agri-food.html">Agri-food</a><a href="construction.html">Construction</a><a href="mining.html">Mining</a><a href="catalog.html">Catalog</a><a href="projects.html">Projects</a></div>
            <div><strong>Contact</strong><a href="mailto:infobabiaguinee@gmail.com">Email</a><a href="tel:+224655903333">+224 655 903 333</a><a href="https://wa.me/224620903333">WhatsApp</a><a href="contact.html#formulaire">Request a quote</a><a href="legal.html">Legal notice</a></div>
          </nav>
        </div>
        <div class="footer-bottom"><p>© 2026 Groupe Babia Guinea. All rights reserved.</p><div><a href="legal.html">Legal notice</a><a href="privacy.html">Privacy</a></div></div>
      </div>
    </footer>
    <script src="../assets/js/main.js"></script>
  </body>
</html>
HTML;
}

$directory = project_path('en');
if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
    throw new RuntimeException('Unable to create English directory.');
}

foreach ($pages as $page) {
    write_file($directory . DIRECTORY_SEPARATOR . $page['file'], page_html($page));
    echo 'Generated en/' . $page['file'] . PHP_EOL;
}
