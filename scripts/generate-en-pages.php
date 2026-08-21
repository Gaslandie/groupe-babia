<?php

declare(strict_types=1);

require dirname(__DIR__) . '/app/helpers.php';

$pages = [
    'index' => [
        'file' => 'index.php',
        'fr' => '../index.php',
        'title' => 'Groupe Babia Guinea | Agriculture, Construction, Mining and Fishing',
        'description' => 'Groupe Babia Guinea is a multisector partner based in Conakry, active in agricultural trade, food imports, construction, mining services, fishing and agro-industry.',
        'active' => 'home',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => <<<HTML
          <section class="page-hero" aria-label="Groupe Babia Guinea overview">
            <img class="page-hero-media" src="../assets/images/hero-agro-export-import.webp" alt="Agricultural products ready for international trade" width="1600" height="900" fetchpriority="high" decoding="async">
            <div class="page-hero-overlay"></div>
            <div>
              <p class="eyebrow">Trade, projects and partnerships from Conakry</p>
              <h1>Groupe Babia Guinea</h1>
              <p>We export agricultural products, import food commodities and support construction, mining, fishing and agro-industrial projects for buyers, distributors, institutions and companies.</p>
              <div class="hero-actions">
                <a class="button button-primary" href="catalog.php">Explore products</a>
                <a class="button button-secondary" href="contact.php#formulaire">Request a quotation</a>
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
              <article class="activity-card"><img src="../assets/images/agro-cajou.webp" alt="Raw cashew nuts" width="800" height="1000" loading="lazy" decoding="async"><div><small>Export</small><h3>Agricultural products</h3><p>Cocoa beans, coffee beans, raw cashew nuts, soya beans, shea butter, honey, sesame seeds and fruits.</p><a href="agri-food.php">View agri-food trade</a></div></article>
              <article class="activity-card"><img src="../assets/images/btp.webp" alt="Construction site" width="626" height="417" loading="lazy" decoding="async"><div><small>Projects</small><h3>Construction and public works</h3><p>Support for construction and infrastructure projects with attention to scope, deadlines and coordination.</p><a href="construction.php">View construction</a></div></article>
              <article class="activity-card"><img src="../assets/images/mines.webp" alt="Mining operations" width="1600" height="1064" loading="lazy" decoding="async"><div><small>Mining</small><h3>Mining services and partnerships</h3><p>Operational support, supply and partnership opportunities for responsible mining activities.</p><a href="mining.php">View mining</a></div></article>
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
        'file' => 'company.php',
        'fr' => '../groupe.php',
        'title' => 'Company | Groupe Babia Guinea',
        'description' => 'Discover Groupe Babia Guinea, a multisector company based in Conakry serving local and international partners.',
        'active' => 'company',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => <<<HTML
          <section class="page-hero">
            <img class="page-hero-media" src="../assets/images/hero-agro-export-import.webp" alt="Groupe Babia business environment" width="1600" height="900" fetchpriority="high" decoding="async">
            <div class="page-hero-overlay"></div>
            <div><p class="eyebrow">Company</p><h1>A Guinean group open to international partnerships</h1><p>Groupe Babia brings together trading, project and operational activities with a practical approach: understand the need, qualify the request, mobilize the right business unit and follow through.</p></div>
          </section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Positioning</p><h2>Built around useful sectors</h2><p>The group is active in agriculture, agri-food imports, construction and public works, mining support, fishing and agro-industrial opportunities.</p></div><div class="content-questions"><article><h3>Local roots</h3><p>Based in Conakry, Groupe Babia works from Guinea while addressing both local and international needs.</p></article><article><h3>Business clarity</h3><p>The company structures requests by sector so buyers, partners and institutions know where to start.</p></article><article><h3>Long-term view</h3><p>The website is designed to grow with verified projects, references, official documents and a future back office.</p></article></div></section>
          <section class="section soft-section"><div class="section-heading"><p class="eyebrow">Working method</p><h2>A request is first qualified, then directed</h2></div><div class="timeline"><article><span>01</span><h3>Need received</h3><p>Product, volume, project type, destination and timing are collected.</p></article><article><span>02</span><h3>Scope clarified</h3><p>The team checks whether the request belongs to trade, construction, mining, fishing or agro-industry.</p></article><article><span>03</span><h3>Commercial response</h3><p>The visitor receives a targeted follow-up instead of a generic answer.</p></article></div></section>
HTML,
    ],
    'agri-food' => [
        'file' => 'agri-food.php',
        'fr' => '../agroalimentaire.php',
        'title' => 'Agri-food Export and Import | Groupe Babia Guinea',
        'description' => 'Agricultural exports and food imports: cocoa beans, coffee beans, raw cashew nuts, soya beans, shea butter, honey, sesame seeds, fruits, rice, juice, tomatoes, onions and edible oil.',
        'active' => 'agri-food',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => <<<HTML
          <section class="page-hero"><img class="page-hero-media" src="../assets/images/hero-agro-export-import.webp" alt="Agri-food export and import products" width="1600" height="900" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><p class="eyebrow">Agri-food trade</p><h1>Agricultural exports and food imports</h1><p>Groupe Babia supports buyers and distributors looking for agricultural products from Guinea and food commodities for the local market.</p><div class="hero-actions"><a class="button button-primary" href="catalog.php">View products</a><a class="button button-secondary" href="contact.php#formulaire">Request a quotation</a></div></div></section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Exports</p><h2>Agricultural products confirmed by the client</h2></div><div class="product-grid"><article class="product-card"><h3>Cocoa beans</h3><p>Requests are qualified by quantity, destination, timing and documentation needs.</p></article><article class="product-card"><h3>Coffee beans</h3><p>Supply discussions can include volumes, quality expectations and logistics.</p></article><article class="product-card"><h3>Raw cashew nuts</h3><p>Commercial requests should specify crop, quantity, packaging and destination.</p></article><article class="product-card"><h3>Soya beans</h3><p>Structured requests help prepare a relevant first response.</p></article><article class="product-card"><h3>Shea butter, honey and sesame seeds</h3><p>Available as part of the confirmed agricultural export range.</p></article><article class="product-card"><h3>Fruits</h3><p>Requests must include destination, freshness constraints and desired timing.</p></article></div></section>
          <section class="section soft-section"><div class="section-heading"><p class="eyebrow">Imports</p><h2>Food products for local demand</h2><p>Juice, rice, tomatoes, onions and edible oil are part of the import scope shared by the client.</p></div></section>
HTML,
    ],
    'construction' => [
        'file' => 'construction.php',
        'fr' => '../btp.php',
        'title' => 'Construction and Public Works | Groupe Babia Guinea',
        'description' => 'Groupe Babia supports construction and public works opportunities in Guinea through project qualification, coordination and partner follow-up.',
        'active' => 'construction',
        'hero' => 'assets/images/btp.webp',
        'body' => <<<HTML
          <section class="page-hero"><img class="page-hero-media" src="../assets/images/btp.webp" alt="Construction and public works" width="626" height="417" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><p class="eyebrow">Construction</p><h1>Construction and public works</h1><p>For construction and infrastructure requests, Groupe Babia helps clarify the scope, location, timing, constraints and available documents before commercial follow-up.</p><div class="hero-actions"><a class="button button-primary" href="contact.php?need=construction#formulaire">Discuss a project</a></div></div></section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Project requests</p><h2>What helps the team respond faster</h2></div><div class="service-grid"><article class="service-card"><small>01</small><h3>Scope</h3><p>Type of work, expected result, location and responsibilities.</p></article><article class="service-card"><small>02</small><h3>Timing</h3><p>Target dates, urgency, available plans or site information.</p></article><article class="service-card"><small>03</small><h3>Partners</h3><p>Organizations involved and documents already available.</p></article></div></section>
HTML,
    ],
    'mining' => [
        'file' => 'mining.php',
        'fr' => '../mines.php',
        'title' => 'Mining Services and Partnerships | Groupe Babia Guinea',
        'description' => 'Mining-related support, supply and partnership opportunities handled with attention to reliability, safety and responsible local value.',
        'active' => 'mining',
        'hero' => 'assets/images/mines.webp',
        'body' => <<<HTML
          <section class="page-hero"><img class="page-hero-media" src="../assets/images/mines.webp" alt="Mining operations in an open pit environment" width="1600" height="1064" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><p class="eyebrow">Mining</p><h1>Mining services and partnerships</h1><p>Groupe Babia positions itself as a practical partner for mining-related requests, operational support, supply needs and cooperation opportunities.</p></div></section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Approach</p><h2>Responsible support starts with a clear perimeter</h2></div><div class="content-questions"><article><h3>Operational needs</h3><p>Describe the service, supply or support required and the site context.</p></article><article><h3>Compliance and safety</h3><p>Requests must identify the constraints, stakeholders and documentation required.</p></article><article><h3>Local value</h3><p>The objective is to support useful partnerships while respecting operational realities.</p></article></div></section>
HTML,
    ],
    'catalog' => [
        'file' => 'catalog.php',
        'fr' => '../catalogue.php',
        'title' => 'Product Catalog | Groupe Babia Guinea',
        'description' => 'Browse the confirmed agri-food export and import product scope of Groupe Babia Guinea.',
        'active' => 'catalog',
        'hero' => 'assets/images/agro-cajou.webp',
        'body' => <<<HTML
          <section class="page-hero"><img class="page-hero-media" src="../assets/images/agro-cajou.webp" alt="Agricultural products catalog" width="800" height="1000" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><p class="eyebrow">Catalog</p><h1>Products handled by Groupe Babia</h1><p>The catalog presents the agricultural export products and food import products confirmed by the client. For a quotation, share product, volume, destination and timing.</p><div class="hero-actions"><a class="button button-primary" href="contact.php#formulaire">Request a quotation</a></div></div></section>
          <section class="section" id="products">
            <div class="section-heading">
              <p class="eyebrow">Product selection</p>
              <h2>A catalog structured by operation</h2>
              <p>Filter the confirmed scope, select the products you need and send a clearer quotation request.</p>
            </div>
            <div class="product-toolbar" role="group" aria-label="Filter products by operation">
              <button class="filter-button is-active" type="button" data-filter="all">All</button>
              <button class="filter-button" type="button" data-filter="export">Exports</button>
              <button class="filter-button" type="button" data-filter="import">Imports</button>
            </div>
            <p class="filter-result" role="status" aria-live="polite" data-filter-result>13 products shown</p>
            <p class="quote-hint">Add the products you are interested in: your selection is automatically included in the contact form.</p>
            <div class="catalogue-note" role="note">
              <strong>For an actionable quotation</strong>
              <span>Please include quantity, destination, timeline, expected packaging and required documents whenever possible.</span>
            </div>
            <div class="empty-state" data-filter-empty hidden>
              <h3>No products in this filter</h3>
              <p>Return to the full catalog or describe your request directly.</p>
              <a class="button button-primary" href="contact.php#formulaire">Describe my request</a>
            </div>
            <div class="product-grid">
              <article class="product-card" data-category="export"><img src="../assets/images/agro-cacao.webp" alt="Cocoa beans" width="1080" height="656" loading="lazy" decoding="async"><div><small>Export</small><h3>Cocoa beans</h3><p>Cocoa requests are qualified by drying, sorting, packaging, quantity, destination and timing.</p><ul class="tag-list"><li>Agricultural product</li><li>Sorting</li><li>Export</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Cocoa beans">Add to quote</button></div></div></article>
              <article class="product-card" data-category="export"><img src="../assets/images/cafe.webp" alt="Coffee beans" width="765" height="573" loading="lazy" decoding="async"><div><small>Export</small><h3>Coffee beans</h3><p>Coffee beans for buyers looking for traceable supply, quality information and reliable follow-up.</p><ul class="tag-list"><li>Agricultural product</li><li>Quality</li><li>Quotation</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Coffee beans">Add to quote</button></div></div></article>
              <article class="product-card" data-category="export"><img src="../assets/images/agro-cajou.webp" alt="Raw cashew nuts" width="736" height="736" loading="lazy" decoding="async"><div><small>Export</small><h3>Raw cashew nuts</h3><p>Requests should specify origin, grade, humidity, packaging, volume and expected shipping window.</p><ul class="tag-list"><li>Agricultural product</li><li>Export bags</li><li>Volume quote</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Raw cashew nuts">Add to quote</button></div></div></article>
              <article class="product-card" data-category="export"><img src="../assets/images/soja.webp" alt="Soya beans" width="1080" height="796" loading="lazy" decoding="async"><div><small>Export</small><h3>Soya beans</h3><p>Soya beans for processors, food markets and volume buyers requiring a structured offer.</p><ul class="tag-list"><li>Agricultural product</li><li>Volume</li><li>Traceability</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Soya beans">Add to quote</button></div></div></article>
              <article class="product-card" data-category="export"><img src="../assets/images/karité.webp" alt="Shea butter" width="1200" height="800" loading="lazy" decoding="async"><div><small>Export</small><h3>Shea butter</h3><p>Shea butter requests are prepared around quality, processing level, packaging and target volume.</p><ul class="tag-list"><li>Processed</li><li>Packaging</li><li>Export</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Shea butter">Add to quote</button></div></div></article>
              <article class="product-card" data-category="export"><img src="../assets/images/miel.webp" alt="Honey" width="800" height="600" loading="lazy" decoding="async"><div><small>Export</small><h3>Honey</h3><p>Natural honey can be discussed by origin, packaging format, quality expectations and available volume.</p><ul class="tag-list"><li>Agricultural product</li><li>Packaging</li><li>Wholesale</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Honey">Add to quote</button></div></div></article>
              <article class="product-card" data-category="export"><img src="../assets/images/sesame.webp" alt="Sesame seeds" width="765" height="573" loading="lazy" decoding="async"><div><small>Export</small><h3>Sesame seeds</h3><p>Sesame seed requests should include purity, humidity, packaging and available or required volume.</p><ul class="tag-list"><li>Seeds</li><li>Quality</li><li>Volume quote</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Sesame seeds">Add to quote</button></div></div></article>
              <article class="product-card" data-category="export"><img src="../assets/images/fruits.jpeg" alt="Fresh fruits" width="570" height="350" loading="lazy" decoding="async"><div><small>Export</small><h3>Fruits</h3><p>Fruit requests depend on seasonality, availability, grade, packaging, freshness constraints and destination.</p><ul class="tag-list"><li>Seasonal</li><li>Fresh</li><li>Quotation</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Fruits">Add to quote</button></div></div></article>
              <article class="product-card" data-category="import"><img src="../assets/images/boissons.webp" alt="Juice products" width="486" height="365" loading="lazy" decoding="async"><div><small>Import</small><h3>Juice</h3><p>Juice supply for distributors, retail channels and specialized food circuits.</p><ul class="tag-list"><li>Beverages</li><li>Distribution</li><li>Import</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Juice">Add to quote</button></div></div></article>
              <article class="product-card" data-category="import"><img src="../assets/images/riz.jpeg" alt="Rice" width="554" height="554" loading="lazy" decoding="async"><div><small>Import</small><h3>Rice</h3><p>Rice for distribution, wholesale and food supply needs in the local market.</p><ul class="tag-list"><li>Cereal</li><li>Volume</li><li>Supply</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Rice">Add to quote</button></div></div></article>
              <article class="product-card" data-category="import"><img src="../assets/images/tomates.jpeg" alt="Tomatoes" width="640" height="479" loading="lazy" decoding="async"><div><small>Import</small><h3>Tomatoes</h3><p>Tomatoes are handled according to availability, formats and food distribution requirements.</p><ul class="tag-list"><li>Fresh</li><li>Volume</li><li>Distribution</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Tomatoes">Add to quote</button></div></div></article>
              <article class="product-card" data-category="import"><img src="../assets/images/oignons.jpeg" alt="Onions" width="640" height="480" loading="lazy" decoding="async"><div><small>Import</small><h3>Onions</h3><p>Onions for volume buyers, retailers and food distributors.</p><ul class="tag-list"><li>Fresh</li><li>Packaging</li><li>Import</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Onions">Add to quote</button></div></div></article>
              <article class="product-card" data-category="import"><img src="../assets/images/huile.webp" alt="Edible oil" width="696" height="522" loading="lazy" decoding="async"><div><small>Import</small><h3>Edible oil</h3><p>Edible oil for trade, distribution and professional food supply.</p><ul class="tag-list"><li>Food product</li><li>Packaging</li><li>Quote</li></ul><div class="card-actions"><button class="button button-ghost" type="button" data-quote-product="Edible oil">Add to quote</button></div></div></article>
            </div>
          </section>
          <aside class="quote-dock" aria-label="Your product selection" data-quote-dock data-empty="true">
            <div><p class="quote-dock-title"><span class="quote-count" data-quote-count aria-hidden="true">0</span><span data-selected-products role="status" aria-live="polite">No product selected</span><button class="quote-clear" type="button" data-quote-clear>Clear selection</button></p><p class="quote-dock-list" data-quote-list hidden></p></div>
            <div class="quote-dock-actions"><a class="button button-primary" href="contact.php#formulaire" data-quote-contact>Send request</a><a class="button button-secondary" href="https://wa.me/224620903333" data-quote-whatsapp>WhatsApp</a></div>
          </aside>
HTML,
    ],
    'projects' => [
        'file' => 'projects.php',
        'fr' => '../realisations.php',
        'title' => 'Projects | Groupe Babia Guinea',
        'description' => 'Future verified projects and company references from Groupe Babia Guinea.',
        'active' => 'projects',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => <<<HTML
          <section class="page-hero"><img class="page-hero-media" src="../assets/images/hero-agro-export-import.webp" alt="Groupe Babia projects" width="1600" height="900" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><p class="eyebrow">Projects</p><h1>Verified company projects</h1><p>Client-approved projects and references will be published here when Groupe Babia provides the official information, images and authorization to display them.</p></div></section>
          <section class="section"><div class="section-heading"><p class="eyebrow">Coming next</p><h2>No invented references</h2><p>This English page is ready for real projects, but it does not publish unverified client names, figures or achievements.</p></div></section>
HTML,
    ],
    'contact' => [
        'file' => 'contact.php',
        'fr' => '../contact.php',
        'title' => 'Contact | Groupe Babia Guinea',
        'description' => 'Contact Groupe Babia Guinea for agri-food trade, construction, mining, fishing and partnership requests.',
        'active' => 'contact',
        'hero' => 'assets/images/btp.webp',
        'body' => <<<HTML
          <section class="page-hero"><img class="page-hero-media" src="../assets/images/btp.webp" alt="Preparing a business request" width="1600" height="900" fetchpriority="high" decoding="async"><div class="page-hero-overlay"></div><div><p class="eyebrow">Contact</p><h1>Send a clear business request</h1><p>Share your product, quantity, project scope, destination and timing. The team will direct your message to the right business area.</p></div></section>
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
        'file' => 'legal.php',
        'fr' => '../mentions-legales.php',
        'title' => 'Legal Notice | Groupe Babia Guinea',
        'description' => 'Legal notice for the Groupe Babia Guinea website.',
        'active' => '',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => '<section class="section legal-page"><div class="section-heading"><p class="eyebrow">Legal notice</p><h1>Legal notice</h1><p>This English version is provided for convenience. The French legal version remains the reference version.</p></div><div class="content-questions"><article><h3>Website publisher</h3><p>Groupe Babia Guinea, Conakry, Guinea. Email: infobabiaguinee@gmail.com. Phone: +224 655 903 333.</p></article><article><h3>Hosting</h3><p>The website is hosted on Bluehost infrastructure for the domain groupebabia.com.</p></article><article><h3>Intellectual property</h3><p>Texts, structure, visuals and brand elements may not be reused without authorization.</p></article></div></section>',
    ],
    'privacy' => [
        'file' => 'privacy.php',
        'fr' => '../confidentialite.php',
        'title' => 'Privacy Policy | Groupe Babia Guinea',
        'description' => 'Privacy policy for contact requests sent through the Groupe Babia Guinea website.',
        'active' => '',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => '<section class="section legal-page"><div class="section-heading"><p class="eyebrow">Privacy</p><h1>Privacy policy</h1><p>This English version is provided for convenience. The French privacy policy remains the reference version.</p></div><div class="content-questions"><article><h3>Data collected</h3><p>The contact form may collect name, company, email, phone number, request type, destination, timing and message.</p></article><article><h3>Purpose</h3><p>Data is used only to process commercial requests and follow up with the sender.</p></article><article><h3>Retention</h3><p>Archived contact messages are permanently deleted after 30 days.</p></article></div></section>',
    ],
    '404' => [
        'file' => '404.php',
        'fr' => '../404.php',
        'title' => 'Page Not Found | Groupe Babia Guinea',
        'description' => 'The requested page could not be found.',
        'active' => '',
        'hero' => 'assets/images/hero-agro-export-import.webp',
        'body' => '<section class="section legal-page"><div class="section-heading"><p class="eyebrow">404</p><h1>Page not found</h1><p>The page you requested does not exist or has moved.</p><div class="hero-actions"><a class="button button-primary" href="index.php">Back to home</a><a class="button button-secondary" href="contact.php">Contact the team</a></div></div></section>',
    ],
];

function nav(array $page): string
{
    $items = [
        'home' => ['Home', 'index.php'],
        'company' => ['Company', 'company.php'],
        'agri-food' => ['Agri-food', 'agri-food.php'],
        'construction' => ['Construction', 'construction.php'],
        'mining' => ['Mining', 'mining.php'],
        'catalog' => ['Catalog', 'catalog.php'],
        'projects' => ['Projects', 'projects.php'],
        'contact' => ['Contact', 'contact.php'],
    ];
    $html = '';
    foreach ($items as $key => [$label, $href]) {
        $class = $page['active'] === $key ? ' class="is-active"' : '';
        $html .= "        <a{$class} href=\"{$href}\">{$label}</a>\n";
    }
    $html .= "        <a class=\"language-link\" href=\"{$page['fr']}\" hreflang=\"fr\">FR</a>\n";
    $html .= "        <a class=\"nav-cta\" href=\"contact.php#formulaire\">Request a quote</a>\n";

    return $html;
}

function page_html(array $page): string
{
    $canonical = 'https://www.groupebabia.com/en/' . $page['file'];
    if ($page['file'] === 'index.php') {
        $canonical = 'https://www.groupebabia.com/en/';
    }
    $frenchPath = ltrim((string) $page['fr'], './');
    if (str_starts_with($frenchPath, '../')) {
        $frenchPath = substr($frenchPath, 3);
    }
    if ($frenchPath === 'index.php') {
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
      <a class="brand" href="index.php" aria-label="Groupe Babia Guinea home">
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
            <a class="footer-logo" href="index.php" aria-label="Groupe Babia Guinea home"><img src="../assets/images/logo.webp" alt="" width="128" height="128" decoding="async"><strong>Groupe Babia</strong></a>
            <p>A Guinean multisector group active in agriculture, agri-food, construction, fishing and mining-related services for local and international partners.</p>
            <div class="footer-socials" aria-label="Direct contacts"><a href="mailto:infobabiaguinee@gmail.com" aria-label="Email Groupe Babia" title="Email"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4.2-8 5-8-5V6l8 5 8-5Z"/></svg></a><a href="tel:+224655903333" aria-label="Call +224 655 903 333" title="Phone"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24 11.4 11.4 0 0 0 3.6.58 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.4 11.4 0 0 0 .57 3.6 1 1 0 0 1-.25 1Z"/></svg></a><a href="https://wa.me/224620903333" aria-label="WhatsApp +224 620 903 333" title="WhatsApp"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2Zm5.1 14.1c-.2.6-1.2 1.2-1.7 1.2-.5.1-1 .1-1.6-.1a13.6 13.6 0 0 1-5.3-4.6c-.4-.6-.9-1.4-.9-2.3 0-.9.5-1.3.7-1.5.2-.2.4-.3.6-.3h.4c.2 0 .4 0 .6.4l.7 1.7c.1.2 0 .4-.1.5l-.3.4c-.1.1-.2.3-.1.5a8 8 0 0 0 3.4 3c.2.1.4.1.5 0l.7-.8c.2-.2.3-.2.5-.1l1.7.8c.2.1.4.2.4.3.1.2.1.6 0 .9Z"/></svg></a></div>
          </div>
          <nav class="footer-columns" aria-label="Footer navigation">
            <div><strong>Company</strong><a href="index.php">Home</a><a href="company.php">Company</a><a href="contact.php">Contact</a></div>
            <div><strong>Activities</strong><a href="agri-food.php">Agri-food</a><a href="construction.php">Construction</a><a href="mining.php">Mining</a><a href="catalog.php">Catalog</a><a href="projects.php">Projects</a></div>
            <div><strong>Contact</strong><a href="mailto:infobabiaguinee@gmail.com">Email</a><a href="tel:+224655903333">+224 655 903 333</a><a href="https://wa.me/224620903333">WhatsApp</a><a href="contact.php#formulaire">Request a quote</a><a href="legal.php">Legal notice</a></div>
          </nav>
        </div>
        <div class="footer-bottom"><p>© 2026 Groupe Babia Guinea. All rights reserved.</p><div><a href="legal.php">Legal notice</a><a href="privacy.php">Privacy</a></div></div>
      </div>
    </footer>
    <script src="../assets/js/main.js"></script>
  </body>
</html>
HTML;
}

function local_preview_html(string $html): string
{
    $preview = strtr($html, [
        'contact.php?need=construction#formulaire' => 'contact.html?need=construction#formulaire',
        'contact.php#formulaire' => 'contact.html#formulaire',
        'index.php' => 'index.html',
        'company.php' => 'company.html',
        'agri-food.php' => 'agri-food.html',
        'construction.php' => 'construction.html',
        'mining.php' => 'mining.html',
        'catalog.php' => 'catalog.html',
        'projects.php' => 'projects.html',
        'contact.php' => 'contact.html',
        'legal.php' => 'legal.html',
        'privacy.php' => 'privacy.html',
        '../404.php' => '../404.html',
        '../groupe.php' => '../groupe.html',
        '../agroalimentaire.php' => '../agroalimentaire.html',
        '../btp.php' => '../btp.html',
        '../mines.php' => '../mines.html',
        '../catalogue.php' => '../catalogue.html',
        '../realisations.php' => '../realisations.html',
        '../mentions-legales.php' => '../mentions-legales.html',
        '../confidentialite.php' => '../confidentialite.html',
        '../contact.php' => '../contact.html',
        '../index.php' => '../index.html',
    ]);

    return strtr($preview, [
        'https://www.groupebabia.com/en/404.html' => 'https://www.groupebabia.com/en/404.php',
        'https://www.groupebabia.com/en/agri-food.html' => 'https://www.groupebabia.com/en/agri-food.php',
        'https://www.groupebabia.com/en/catalog.html' => 'https://www.groupebabia.com/en/catalog.php',
        'https://www.groupebabia.com/en/company.html' => 'https://www.groupebabia.com/en/company.php',
        'https://www.groupebabia.com/en/construction.html' => 'https://www.groupebabia.com/en/construction.php',
        'https://www.groupebabia.com/en/contact.html' => 'https://www.groupebabia.com/en/contact.php',
        'https://www.groupebabia.com/en/legal.html' => 'https://www.groupebabia.com/en/legal.php',
        'https://www.groupebabia.com/en/mining.html' => 'https://www.groupebabia.com/en/mining.php',
        'https://www.groupebabia.com/en/privacy.html' => 'https://www.groupebabia.com/en/privacy.php',
        'https://www.groupebabia.com/en/projects.html' => 'https://www.groupebabia.com/en/projects.php',
    ]);
}

$directory = project_path('en');
if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
    throw new RuntimeException('Unable to create English directory.');
}

foreach ($pages as $page) {
    $html = page_html($page);
    write_file($directory . DIRECTORY_SEPARATOR . $page['file'], $html);
    echo 'Generated en/' . $page['file'] . PHP_EOL;

    $previewFile = preg_replace('/\.php$/', '.html', $page['file']);
    if ($previewFile === null) {
        throw new RuntimeException('Unable to create preview filename.');
    }
    write_file($directory . DIRECTORY_SEPARATOR . $previewFile, local_preview_html($html));
    echo 'Generated en/' . $previewFile . PHP_EOL;
}
