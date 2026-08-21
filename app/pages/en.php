<?php

declare(strict_types=1);

$site = [
    'lang' => 'en',
    'name' => 'Groupe Babia Guinea',
    'og_locale' => 'en_US',
    'home_href' => 'index.php',
    'home_label' => 'Groupe Babia Guinea home',
    'skip_label' => 'Skip to main content',
    'menu_label' => 'Open menu',
    'direct_contacts_label' => 'Direct contacts',
    'email_label' => 'Email Groupe Babia',
    'phone_label' => 'Call +224 655 903 333',
    'whatsapp_label' => 'WhatsApp +224 620 903 333',
    'footer_nav_label' => 'Footer navigation',
    'footer_text' => 'A Guinean multisector group active in agriculture, agri-food, construction, fishing and mining-related services for local and international partners.',
    'copyright' => '© 2026 Groupe Babia Guinea. All rights reserved.',
    'nav_items' => [
        'home' => ['label' => 'Home', 'href' => 'index.php'],
        'company' => ['label' => 'Company', 'href' => 'company.php'],
        'agri-food' => ['label' => 'Agri-food', 'href' => 'agri-food.php'],
        'construction' => ['label' => 'Construction', 'href' => 'construction.php'],
        'mining' => ['label' => 'Mining', 'href' => 'mining.php'],
        'catalog' => ['label' => 'Catalog', 'href' => 'catalog.php'],
        'projects' => ['label' => 'Projects', 'href' => 'projects.php'],
        'contact' => ['label' => 'Contact', 'href' => 'contact.php'],
    ],
];

$pages = [
    'index' => [
        'file' => 'index.php',
        'fr' => '../index.php',
        'title' => 'Groupe Babia Guinea | Agriculture, Construction, Mining and Fishing',
        'description' => 'Groupe Babia Guinea is a multisector partner based in Conakry, active in agricultural trade, food imports, construction, mining services, fishing and agro-industry.',
        'active' => 'home',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => <<<'HTML'
      <section class="page-hero" aria-label="Groupe Babia Guinea overview">
        <img class="page-hero-media" src="../assets/images/hero-agro-export-import.webp" alt="" width="1600" height="900" fetchpriority="high" decoding="async">
        <div class="page-hero-overlay"></div>
        <div>
          <p class="eyebrow">Trade, projects and partnerships from Conakry</p>
          <h1>Groupe Babia Guinea</h1>
          <p>We export agricultural products, import food commodities and support construction, mining, fishing and agro-industrial projects for buyers, distributors, institutions and companies.</p>
          <div class="page-actions">
            <a class="button button-primary" href="catalog.php">Explore products</a>
            <a class="button button-secondary" href="contact.php#formulaire">Request a quotation</a>
          </div>
        </div>
        <aside class="page-hero-card">
          <strong>One entry point</strong>
          <p>A clear route for buyers and partners looking for agricultural products, project support or institutional contact in Guinea.</p>
        </aside>
      </section>

      <section class="trust-strip" aria-label="Groupe Babia focus areas">
        <div><strong>Guinea</strong><span>Conakry-based coordination</span></div>
        <div><strong>5</strong><span>Business areas</span></div>
        <div><strong>Export</strong><span>Agricultural products</span></div>
        <div><strong>Import</strong><span>Food commodities</span></div>
      </section>

      <section class="section proof-section" aria-labelledby="proof-title">
        <div class="section-heading">
          <p class="eyebrow">Commercial clarity</p>
          <h2 id="proof-title">A practical qualification path before any quotation</h2>
          <p>The English version mirrors the French experience with the same emphasis on clear sectors, reliable request handling and no invented achievements.</p>
        </div>
        <div class="proof-grid">
          <article><span>01</span><h3>Sector routing</h3><p>Each request is directed to agriculture, agri-food import, construction, mining, fishing or agro-industry.</p></article>
          <article><span>02</span><h3>Useful details first</h3><p>Product, volume, project location, destination, timing and documents make the first response more actionable.</p></article>
          <article><span>03</span><h3>Verified information only</h3><p>References, certificates and achievements will be published only after official client validation.</p></article>
          <article><span>04</span><h3>Direct contact</h3><p>The form, email and WhatsApp remain available for buyers and partners who need a fast first exchange.</p></article>
        </div>
      </section>

      <section class="section activities-section" id="activities">
        <div class="section-heading">
          <p class="eyebrow">Activities</p>
          <h2>A multisector partner for practical business needs</h2>
          <p>Groupe Babia works across complementary sectors where reliability, sourcing capacity and operational follow-up matter.</p>
        </div>
        <div class="activity-grid">
          <article class="activity-card"><img src="../assets/images/agro-cajou.webp" alt="" width="800" height="1000" loading="lazy" decoding="async"><div><small>Export</small><h3>Agricultural products</h3><p>Cocoa beans, coffee beans, raw cashew nuts, soya beans, shea butter, honey, sesame seeds and fruits.</p><a href="agri-food.php">View agri-food trade</a></div></article>
          <article class="activity-card"><img src="../assets/images/btp.webp" alt="" width="626" height="417" loading="lazy" decoding="async"><div><small>Projects</small><h3>Construction and public works</h3><p>Support for construction and infrastructure projects with attention to scope, deadlines and coordination.</p><a href="construction.php">View construction</a></div></article>
          <article class="activity-card"><img src="../assets/images/mines.webp" alt="" width="1600" height="1064" loading="lazy" decoding="async"><div><small>Mining</small><h3>Mining services and partnerships</h3><p>Operational support, supply and partnership opportunities for responsible mining activities.</p><a href="mining.php">View mining</a></div></article>
        </div>
      </section>

      <section class="contact-band" id="contact">
        <div>
          <p class="eyebrow">Business request</p>
          <h2>Share the product, project scope, destination and timing.</h2>
          <p>The team will qualify your message and direct it to the right business area.</p>
        </div>
        <a class="button button-primary" href="contact.php#formulaire">Prepare a request</a>
      </section>
HTML,
    ],
    'company' => [
        'file' => 'company.php',
        'fr' => '../groupe.php',
        'title' => 'Company | Groupe Babia Guinea',
        'description' => 'Discover Groupe Babia Guinea, a multisector company based in Conakry serving local and international partners.',
        'active' => 'company',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => <<<'HTML'
      <section class="page-hero">
        <img class="page-hero-media" src="../assets/images/agro-cacao.webp" alt="" width="1080" height="656" fetchpriority="high" decoding="async">
        <div class="page-hero-overlay"></div>
        <div>
          <nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="index.php">Home</a></li><li><span aria-current="page">Company</span></li></ol></nav>
          <p class="eyebrow">Vision and positioning</p>
          <h1>A Guinean group open to regional and international markets</h1>
          <p>Groupe Babia brings together agriculture, agro-industry, construction, mining and fishing activities with one requirement: create trust and lasting value.</p>
          <div class="page-actions">
            <a class="button button-primary" href="contact.php?need=corporate#formulaire">Start a conversation</a>
            <a class="button button-secondary" href="catalog.php">View the catalog</a>
          </div>
        </div>
        <aside class="page-hero-card">
          <strong>Our direction</strong>
          <p>Connect Guinean opportunities with the needs of companies, buyers and institutions in West Africa and beyond.</p>
        </aside>
      </section>

      <section class="section two-column">
        <div class="section-heading"><p class="eyebrow">Identity</p><h2>A diversified group, one shared vision</h2></div>
        <div class="content-panel">
          <h3>Groupe Babia Guinea</h3>
          <p>Groupe Babia brings together five complementary business areas. Agriculture connects supply chains and markets; agro-industry adds value to raw materials; construction supports infrastructure; mining and fishing develop services and partnerships adapted to field realities.</p>
          <p>A common governance approach supports consistent commitments, shared expertise and durable relationships with partners.</p>
        </div>
      </section>

      <section class="section soft-section">
        <div class="section-heading"><p class="eyebrow">At a glance</p><h2>Local roots, regional ambition</h2></div>
        <div class="metric-grid">
          <article class="metric-card"><strong>5</strong><h3>Business areas</h3><p>Agriculture, agro-industry, construction, mining and fishing under one vision.</p></article>
          <article class="metric-card"><strong>GN</strong><h3>Guinean base</h3><p>Knowledge of local economic, logistics and operational realities.</p></article>
          <article class="metric-card"><strong>WA</strong><h3>Regional outlook</h3><p>An ambition oriented toward West Africa and international partners.</p></article>
        </div>
      </section>

      <section class="section media-band soft-section" id="fishing">
        <img src="../assets/images/peche.webp" alt="" width="1536" height="1024" loading="lazy" decoding="async">
        <div><p class="eyebrow">Fishing</p><h2>Structuring a responsible fisheries value chain</h2><p>Groupe Babia develops its fishing activity around supply, quality, conservation and commercialization of fishery products.</p><ul class="tag-list"><li>Supply</li><li>Quality</li><li>Cold chain</li><li>Commercialization</li></ul><div class="page-actions"><a class="button button-primary" href="contact.php?need=fishing#formulaire">Present a fishing request</a></div></div>
      </section>

      <section class="section media-band" id="agro-industry">
        <img src="../assets/images/agro-industrie.webp" alt="" width="1704" height="923" loading="lazy" decoding="async">
        <div><p class="eyebrow">Agro-industry</p><h2>Turning agricultural resources into durable value</h2><p>The agro-industrial area covers processing, quality control, packaging and preparation of products for local, regional and international markets.</p><ul class="tag-list"><li>Processing</li><li>Packaging</li><li>Quality control</li><li>Local value</li></ul><div class="page-actions"><a class="button button-primary" href="contact.php?need=agro-industry#formulaire">Discuss an agro-industrial project</a></div></div>
      </section>

      <section class="section dark-section">
        <div class="section-heading"><p class="eyebrow">How we work</p><h2>From listening to value creation</h2></div>
        <div class="timeline">
          <article><strong>01. Understand</strong><div><h3>Start with the real need</h3><p>We qualify expectations, context, volumes and constraints for each request.</p></div></article>
          <article><strong>02. Structure</strong><div><h3>Mobilize useful expertise</h3><p>Each business area prepares a response adapted to commercial and operational requirements.</p></div></article>
          <article><strong>03. Support</strong><div><h3>Build a durable relationship</h3><p>We prioritize follow-up, clarity and continuity in partner relationships.</p></div></article>
        </div>
      </section>

      <section class="contact-band">
        <div><p class="eyebrow">Contact</p><h2>A direct access point to Groupe Babia Guinea.</h2><p>Our commercial team routes each request to the relevant business area and contact person.</p></div>
        <a class="button button-primary" href="contact.php?need=corporate#formulaire">Prepare a request</a>
      </section>
HTML,
    ],
    'agri-food' => [
        'file' => 'agri-food.php',
        'fr' => '../agroalimentaire.php',
        'title' => 'Agri-food Export and Import | Groupe Babia Guinea',
        'description' => 'Agricultural exports and food imports handled by Groupe Babia Guinea: cocoa, coffee, raw cashew nuts, soya beans, shea butter, honey, sesame seeds, fruits, rice, juice, tomatoes, onions and edible oil.',
        'active' => 'agri-food',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => <<<'HTML'
      <section class="page-hero"><img class="page-hero-media" src="../assets/images/agro-cajou.webp" alt="" width="736" height="736" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="index.php">Home</a></li><li><span aria-current="page">Agri-food</span></li></ol></nav><p class="eyebrow">Agri-food trade</p><h1>Agricultural exports and food imports</h1><p>Groupe Babia supports buyers and distributors looking for agricultural products from Guinea and food commodities for the local market.</p><div class="page-actions"><a class="button button-primary" href="catalog.php">View products</a><a class="button button-secondary" href="contact.php#formulaire">Request a quotation</a></div></div><aside class="page-hero-card"><strong>Confirmed scope</strong><p>The product list is limited to the export and import scope shared by the client.</p></aside></section>
      <section class="section two-column"><div class="section-heading"><p class="eyebrow">Export and import</p><h2>A structured route for buyers and distributors</h2></div><div class="content-panel"><h3>Clear requests, useful responses</h3><p>The team qualifies product, volume, destination, timing, packaging expectations and documentation needs before commercial follow-up.</p><p>No quality grade, certification or supply volume is displayed unless it has been officially validated.</p></div></section>
      <section class="section proof-section" aria-labelledby="agro-proof-title"><div class="section-heading"><p class="eyebrow">Buyer preparation</p><h2 id="agro-proof-title">What makes a request actionable</h2></div><div class="proof-grid"><article><span>01</span><h3>Product</h3><p>Name the product, expected quality and any required document.</p></article><article><span>02</span><h3>Volume</h3><p>Share quantity, order frequency and target timing.</p></article><article><span>03</span><h3>Destination</h3><p>Indicate country, port, market or delivery area.</p></article><article><span>04</span><h3>Packaging</h3><p>Specify bags, cartons, drums, pallets or other logistics expectations.</p></article></div></section>
      <section class="section soft-section"><div class="section-heading"><p class="eyebrow">Product families</p><h2>Confirmed agri-food scope</h2></div><div class="product-grid"><article class="product-card"><h3>Agricultural exports</h3><p>Cocoa beans, coffee beans, raw cashew nuts, soya beans, shea butter, honey, sesame seeds and fruits.</p></article><article class="product-card"><h3>Food imports</h3><p>Juice, rice, tomatoes, onions and edible oil are part of the import scope shared by the client.</p></article><article class="product-card"><h3>Quotation details</h3><p>Useful details include volume, timing, destination, packaging and documentation expectations.</p></article></div></section>
      <section class="section dark-section"><div class="section-heading"><p class="eyebrow">Method</p><h2>From sourcing discussion to commercial coordination</h2></div><div class="timeline"><article><strong>01. Sourcing</strong><div><h3>Local products and partners</h3><p>Selection discussions start from identified agricultural supply chains.</p></div></article><article><strong>02. Quality</strong><div><h3>Sorting, control and packaging</h3><p>Buyer expectations are clarified before any useful offer.</p></div></article><article><strong>03. Exchange</strong><div><h3>Quotation and coordination</h3><p>Volumes, destination and conditions are qualified before the commercial response.</p></div></article></div></section>
      <section class="contact-band"><div><p class="eyebrow">Agri-food request</p><h2>Send a clear product, volume and destination request.</h2><p>The catalog can prefill your product selection before you submit the form.</p></div><a class="button button-primary" href="catalog.php">Select products</a></section>
HTML,
    ],
    'construction' => [
        'file' => 'construction.php',
        'fr' => '../btp.php',
        'title' => 'Construction and Public Works | Groupe Babia Guinea',
        'description' => 'Groupe Babia supports construction and public works opportunities in Guinea through project qualification, coordination and partner follow-up.',
        'active' => 'construction',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => <<<'HTML'
      <section class="page-hero"><img class="page-hero-media" src="../assets/images/btp.webp" alt="" width="626" height="417" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="index.php">Home</a></li><li><span aria-current="page">Construction</span></li></ol></nav><p class="eyebrow">Construction and public works</p><h1>Modern, useful and durable infrastructure</h1><p>Groupe Babia supports construction and infrastructure requests by clarifying scope, location, timing, constraints and available documents before commercial follow-up.</p><div class="page-actions"><a class="button button-primary" href="contact.php?need=construction#formulaire">Present a project</a><a class="button button-secondary" href="#services">View services</a></div></div><aside class="page-hero-card"><strong>Project owners and partners</strong><p>A structured approach around location, usage, timing and the requirements specific to each project.</p></aside></section>
      <section class="section" id="services"><div class="section-heading"><p class="eyebrow">Construction services</p><h2>A business area structured around field needs</h2></div><div class="service-grid"><article class="service-card"><small>01</small><h3>Professional buildings</h3><p>Design and delivery discussions for administrative, commercial and operational buildings.</p></article><article class="service-card"><small>02</small><h3>Durable infrastructure</h3><p>Development works, economic-use structures and community-scale projects.</p></article><article class="service-card"><small>03</small><h3>Public works</h3><p>Project coordination, execution follow-up and operational constraint management.</p></article></div></section>
      <section class="section media-band soft-section"><img src="../assets/images/btp.webp" alt="" width="626" height="417" loading="lazy" decoding="async"><div><p class="eyebrow">Method</p><h2>Projects better qualified from the first exchange</h2><p>Each exchange starts with the nature of the works, location, timing, available documents and constraints. These elements help mobilize the right expertise.</p><ul class="tag-list"><li>Needs review</li><li>Planning</li><li>Site follow-up</li><li>Delivery</li></ul><div class="page-actions"><a class="button button-primary" href="contact.php?need=construction#formulaire">Describe my project</a></div></div></section>
      <section class="section"><div class="section-heading"><p class="eyebrow">Project file</p><h2>Information that helps evaluate a construction request</h2></div><div class="service-grid"><article class="service-card"><small>01</small><h3>Location and use</h3><p>City, site, future use, access constraints and operating needs.</p></article><article class="service-card"><small>02</small><h3>Available documents</h3><p>Plans, sketches, specifications, site photos or any useful technical indication.</p></article><article class="service-card"><small>03</small><h3>Budget and timing</h3><p>Priority level, desired deadline, possible phases and project urgency.</p></article></div></section>
      <section class="section dark-section"><div class="section-heading"><p class="eyebrow">Site commitments</p><h2>Clear commitments for every project</h2></div><div class="commitment-grid"><article><h3>Compliance</h3><p>Respect for project requirements, execution quality and defined responsibilities.</p></article><article><h3>Durability</h3><p>Works designed for real usage, maintenance and long-term value.</p></article><article><h3>Transparency</h3><p>Structured exchanges around scope, timing and constraints.</p></article><article><h3>Coordination</h3><p>Careful follow-up of partners, schedule and site stages.</p></article></div></section>
      <section class="contact-band"><div><p class="eyebrow">Construction project</p><h2>Describe your need, location and timeline.</h2><p>Send the first useful information so the team can study the project.</p></div><a class="button button-primary" href="contact.php?need=construction#formulaire">Contact construction</a></section>
HTML,
    ],
    'mining' => [
        'file' => 'mining.php',
        'fr' => '../mines.php',
        'title' => 'Mining Services and Partnerships | Groupe Babia Guinea',
        'description' => 'Mining-related support, supply and partnership opportunities handled with attention to reliability, safety and responsible local value.',
        'active' => 'mining',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => <<<'HTML'
      <section class="page-hero"><img class="page-hero-media" src="../assets/images/mines.webp" alt="" width="1600" height="1064" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="index.php">Home</a></li><li><span aria-current="page">Mining</span></li></ol></nav><p class="eyebrow">Mining sector</p><h1>Supporting local resources with method and responsibility</h1><p>Groupe Babia develops partnerships and services around logistics, supply and operational support adapted to mining-sector requirements.</p><div class="page-actions"><a class="button button-primary" href="contact.php?need=mining#formulaire">Contact mining</a><a class="button button-secondary" href="#approach">View approach</a></div></div><aside class="page-hero-card"><strong>Our priority</strong><p>Build responsible collaborations attentive to safety, compliance and local value creation.</p></aside></section>
      <section class="section two-column" id="approach"><div class="section-heading"><p class="eyebrow">Mining approach</p><h2>A rigorous and responsible approach</h2></div><div class="content-panel"><h3>Partnership, logistics and reliability</h3><p>Groupe Babia works through services and partnerships, with attention to safety, compliance and local value.</p><p>Each opportunity is qualified around scope, partners, responsibilities and operational constraints.</p></div></section>
      <section class="section soft-section"><div class="section-heading"><p class="eyebrow">Areas of support</p><h2>Services structured around field realities</h2></div><div class="service-grid"><article class="service-card"><small>01</small><h3>Operational logistics</h3><p>Organization, supply and coordination around field needs.</p></article><article class="service-card"><small>02</small><h3>Strategic partnerships</h3><p>Collaboration with local and international actors according to validated opportunities.</p></article><article class="service-card"><small>03</small><h3>Responsible value</h3><p>An approach attentive to communities, standards and the environment.</p></article></div></section>
      <section class="section"><div class="section-heading"><p class="eyebrow">Partnership qualification</p><h2>A clear framework before any operational commitment</h2></div><div class="proof-grid"><article><span>01</span><h3>Scope</h3><p>Nature of need, site, expected responsibilities and identified stakeholders.</p></article><article><span>02</span><h3>Compliance</h3><p>Available documents, contractual requirements, regulatory constraints and safety rules.</p></article><article><span>03</span><h3>Logistics</h3><p>Supply, access, timing, equipment and field intervention conditions.</p></article><article><span>04</span><h3>Local value</h3><p>Community contribution, economic impact and coordination with local partners.</p></article></div></section>
      <section class="section dark-section"><div class="section-heading"><p class="eyebrow">Responsibility</p><h2>Trust at the center of every partnership</h2></div><div class="timeline"><article><strong>Safety</strong><div><h3>Controlled operations first</h3><p>Compliance, caution and field follow-up guide the operational approach.</p></div></article><article><strong>Communities</strong><div><h3>Local contribution</h3><p>Value economic benefits and integration into regional development.</p></div></article><article><strong>Transparency</strong><div><h3>Controlled information</h3><p>Responsibilities, scopes and commitments are clarified with relevant partners.</p></div></article></div></section>
      <section class="contact-band"><div><p class="eyebrow">Mining partnership</p><h2>Present your need, scope and available documents.</h2><p>The team reviews service, supply and strategic collaboration requests.</p></div><a class="button button-primary" href="contact.php?need=mining#formulaire">Contact mining</a></section>
HTML,
    ],
    'catalog' => [
        'file' => 'catalog.php',
        'fr' => '../catalogue.php',
        'title' => 'Product Catalog | Groupe Babia Guinea',
        'description' => 'Browse the confirmed agri-food export and import product scope of Groupe Babia Guinea.',
        'active' => 'catalog',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => file_get_contents(dirname(__DIR__, 2) . '/app/pages/en-catalog-body.html') ?: '',
    ],
    'projects' => [
        'file' => 'projects.php',
        'fr' => '../realisations.php',
        'title' => 'Projects | Groupe Babia Guinea',
        'description' => 'Future verified projects and company references from Groupe Babia Guinea.',
        'active' => 'projects',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => <<<'HTML'
      <section class="page-hero"><img class="page-hero-media" src="../assets/images/hero-agro-export-import.webp" alt="" width="1600" height="900" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="index.php">Home</a></li><li><span aria-current="page">Projects</span></li></ol></nav><p class="eyebrow">Projects</p><h1>Verified company projects</h1><p>Client-approved projects and references will be published here when Groupe Babia provides the official information, images and authorization to display them.</p></div><aside class="page-hero-card"><strong>No invented references</strong><p>This page is ready for official content without presenting unverified client names, figures or achievements.</p></aside></section>
      <section class="section soft-section"><div class="section-heading"><p class="eyebrow">Coming next</p><h2>Prepared for the future back office</h2><p>The French and English public pages will later be connected to verified projects published from the back office.</p></div></section>
HTML,
    ],
    'contact' => [
        'file' => 'contact.php',
        'fr' => '../contact.php',
        'title' => 'Contact | Groupe Babia Guinea',
        'description' => 'Contact Groupe Babia Guinea for agri-food trade, construction, mining, fishing and partnership requests.',
        'active' => 'contact',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => <<<'HTML'
      <section class="page-hero"><img class="page-hero-media" src="../assets/images/btp.webp" alt="" width="626" height="417" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="index.php">Home</a></li><li><span aria-current="page">Contact</span></li></ol></nav><p class="eyebrow">Contact and qualification</p><h1>Tell us about your need and objectives</h1><p>Agricultural products, agro-industrial project, construction, mining services, fishing or institutional partnership: share the essential information and the team will orient your request.</p><div class="page-actions"><a class="button button-primary" href="#formulaire">Fill in the form</a><a class="button button-secondary" href="catalog.php">Select products</a></div></div><aside class="page-hero-card"><strong>Commercial contact</strong><p>One entry point for commercial, operational and institutional requests.</p></aside></section>
      <section class="section form-layout" id="formulaire"><div><p class="eyebrow">Contact details</p><h2>Reach Groupe Babia Guinea</h2><p>Choose the channel that suits you. For a more precise response, include your company, need, volume or expected timing.</p><div class="contact-list"><div class="contact-item"><strong>Address</strong><span>Kaloum, Conakry, Republic of Guinea</span></div><div class="contact-item"><strong>Phone</strong><a href="tel:+224655903333">+224 655 903 333</a></div><div class="contact-item"><strong>WhatsApp</strong><a href="https://wa.me/224620903333">+224 620 903 333</a></div><div class="contact-item"><strong>Email</strong><a href="mailto:infobabiaguinee@gmail.com">infobabiaguinee@gmail.com</a></div><div class="contact-item"><strong>Location</strong><span>Kaloum, Conakry</span><div style="margin-top: 14px; overflow: hidden; border: 1px solid var(--line); border-radius: 8px;"><iframe title="Groupe Babia location in Kaloum, Conakry" src="https://www.google.com/maps?q=Kaloum%2C%20Conakry%2C%20Guin%C3%A9e&output=embed" width="600" height="320" style="display: block; width: 100%; border: 0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div><a class="button button-primary" style="margin-top: 14px;" href="https://www.google.com/maps/search/?api=1&query=Kaloum%2C%20Conakry%2C%20Guin%C3%A9e" target="_blank" rel="noopener">Open directions</a></div></div></div>
        <form class="form-card" method="post" action="../contact-submit.php" data-contact-form><p class="form-prefill" data-form-prefill hidden><span data-form-prefill-text></span><a href="catalog.php">Edit selection</a></p><p class="form-legend">Fields marked with <span class="required-mark">*</span> are required.</p><div class="field-grid"><div class="field"><label for="name">Contact name <span class="required-mark" aria-hidden="true">*</span></label><input id="name" name="name" type="text" autocomplete="name" placeholder="Your name" required><p class="field-error" id="name-error"></p></div><div class="field"><label for="company">Company <span class="required-mark" aria-hidden="true">*</span></label><input id="company" name="company" type="text" autocomplete="organization" placeholder="Company name" required><p class="field-error" id="company-error"></p></div></div><div class="field-grid"><div class="field"><label for="email">Email <span class="required-mark" aria-hidden="true">*</span></label><input id="email" name="email" type="email" autocomplete="email" placeholder="contact@company.com" required><p class="field-error" id="email-error"></p></div><div class="field"><label for="phone">Phone / WhatsApp <span class="optional">(optional)</span></label><input id="phone" name="phone" type="tel" autocomplete="tel" placeholder="+224 ..."><p class="field-error" id="phone-error"></p></div></div><div class="field"><label for="need">Request type</label><select id="need" name="need"><option value="Agri-food export/import request">Agri-food export/import request</option><option value="Construction project">Construction project</option><option value="Mining partnership">Mining partnership</option><option value="Fishing activity">Fishing activity</option><option value="Agro-industrial project">Agro-industrial project</option><option value="Corporate information">Corporate information</option></select></div><div class="field-grid"><div class="field"><label for="destination">Country / destination <span class="optional">(optional)</span></label><input id="destination" name="destination" type="text" autocomplete="country-name" placeholder="Guinea, destination country or project site"><p class="field-error" id="destination-error"></p></div><div class="field"><label for="timeline">Expected timing <span class="optional">(optional)</span></label><input id="timeline" name="timeline" type="text" placeholder="Urgent, this month, quarter, target date..."><p class="field-error" id="timeline-error"></p></div></div><div class="field"><label for="message">Message <span class="required-mark" aria-hidden="true">*</span></label><textarea id="message" name="message" placeholder="Describe the product, quantity, project, destination or timing." required></textarea><p class="field-error" id="message-error"></p></div><input type="hidden" name="lang" value="en"><div class="visually-hidden" aria-hidden="true"><label for="website">Website</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div><div class="form-actions"><button class="button button-primary" type="submit">Send request</button><a class="button button-dark" href="https://wa.me/224620903333" data-contact-whatsapp>Send on WhatsApp</a></div><div class="form-status" role="status" aria-live="polite" data-form-status hidden><strong data-form-status-title></strong><span data-form-status-text></span><span class="status-actions"><button class="link-button" type="button" data-copy-message>Copy message</button><a class="link-button" href="mailto:infobabiaguinee@gmail.com">infobabiaguinee@gmail.com</a></span></div></form></section>
      <section class="section soft-section"><div class="section-heading"><p class="eyebrow">Useful information</p><h2>A good message accelerates commercial follow-up</h2></div><div class="service-grid"><article class="service-card"><small>Agro</small><h3>Product, quantity, destination</h3><p>Add volumes, timing, country and packaging expectations.</p></article><article class="service-card"><small>Build</small><h3>Project type and location</h3><p>Specify the work type, city, target deadline and available documents.</p></article><article class="service-card"><small>Mining</small><h3>Scope and context</h3><p>Describe the need, partners involved and operational constraints.</p></article></div><div class="content-questions" aria-label="Request preparation help"><article><h3>Agri-food request</h3><p>Product, volume, packaging, destination, purchasing frequency and expected documents make the quotation more useful.</p></article><article><h3>Construction or mining project</h3><p>Location, scope, timing, responsibilities, plans or site photos help establish a serious first frame.</p></article><article><h3>Partnership</h3><p>Present the company, the expected role of Groupe Babia and known commercial or operational constraints.</p></article></div></section>
HTML,
    ],
    'legal' => [
        'file' => 'legal.php',
        'fr' => '../mentions-legales.php',
        'title' => 'Legal Notice | Groupe Babia Guinea',
        'description' => 'Legal notice for the Groupe Babia Guinea website.',
        'active' => '',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => '<section class="section legal-page"><div class="section-heading"><p class="eyebrow">Legal notice</p><h1>Legal notice</h1><p>This English version is provided for convenience. The French legal version remains the reference version.</p></div><div class="content-questions"><article><h3>Website publisher</h3><p>Groupe Babia Guinea, Conakry, Guinea. Email: infobabiaguinee@gmail.com. Phone: +224 655 903 333.</p></article><article><h3>Hosting</h3><p>The website is hosted on Bluehost infrastructure for the domain groupebabia.com.</p></article><article><h3>Intellectual property</h3><p>Texts, structure, visuals and brand elements may not be reused without authorization.</p></article></div></section>',
    ],
    'privacy' => [
        'file' => 'privacy.php',
        'fr' => '../confidentialite.php',
        'title' => 'Privacy Policy | Groupe Babia Guinea',
        'description' => 'Privacy policy for contact requests sent through the Groupe Babia Guinea website.',
        'active' => '',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => '<section class="section legal-page"><div class="section-heading"><p class="eyebrow">Privacy</p><h1>Privacy policy</h1><p>This English version is provided for convenience. The French privacy policy remains the reference version.</p></div><div class="content-questions"><article><h3>Data collected</h3><p>The contact form may collect name, company, email, phone number, request type, destination, timing and message.</p></article><article><h3>Purpose</h3><p>Data is used only to process commercial requests and follow up with the sender.</p></article><article><h3>Retention</h3><p>Archived contact messages are permanently deleted after 30 days.</p></article></div></section>',
    ],
    '404' => [
        'file' => '404.php',
        'fr' => '../404.php',
        'title' => 'Page Not Found | Groupe Babia Guinea',
        'description' => 'The requested page could not be found.',
        'active' => '',
        'cta_href' => 'contact.php#formulaire',
        'cta_label' => 'Request a quote',
        'body' => '<section class="section legal-page"><div class="section-heading"><p class="eyebrow">404</p><h1>Page not found</h1><p>The page you requested does not exist or has moved.</p><div class="hero-actions"><a class="button button-primary" href="index.php">Back to home</a><a class="button button-secondary" href="contact.php">Contact the team</a></div></div></section>',
    ],
];

foreach ($pages as &$page) {
    $file = (string) $page['file'];
    $canonicalPath = $file === 'index.php' ? 'en/' : 'en/' . $file;
    $frenchPath = ltrim((string) $page['fr'], './');
    if (str_starts_with($frenchPath, '../')) {
        $frenchPath = substr($frenchPath, 3);
    }
    if ($frenchPath === 'index.php') {
        $frenchPath = '';
    }

    $page['canonical'] = 'https://www.groupebabia.com/' . $canonicalPath;
    $page['alternate_href'] = (string) $page['fr'];
    $page['alternate_lang'] = 'fr';
    $page['alternate_label'] = 'FR';
    $page['alternate_canonical'] = 'https://www.groupebabia.com/' . $frenchPath;
}
unset($page);

return [
    'site' => $site,
    'pages' => $pages,
];
