<?php

declare(strict_types=1);

$site = [
    'lang' => 'en',
    'name' => 'Groupe Babia Guinea',
    'og_locale' => 'en_US',
    'asset_prefix' => '../',
    'content_id' => 'content',
    'brand_small' => 'Guinea',
    'home_href' => '/en/',
    'home_label' => 'Groupe Babia Guinea home',
    'skip_label' => 'Skip to main content',
    'menu_label' => 'Open menu',
    'direct_contacts_label' => 'Direct contacts',
    'email_label' => 'Email Groupe Babia',
    'email_title' => 'Email',
    'phone_label' => 'Call +224 655 903 333',
    'phone_title' => 'Phone',
    'whatsapp_label' => 'WhatsApp +224 620 903 333',
    'whatsapp_title' => 'WhatsApp',
    'footer_nav_label' => 'Footer navigation',
    'footer_text' => 'A Guinean multisector group active in agriculture, agri-food, construction, fishing and mining-related services for local and international partners.',
    'copyright' => '© 2026 Groupe Babia Guinea. All rights reserved.',
    'nav_items' => [
        'home' => ['label' => 'Home', 'href' => '/en/'],
        'company' => ['label' => 'Company', 'href' => 'company.php'],
        'agri-food' => ['label' => 'Agri-food', 'href' => 'agri-food.php'],
        'construction' => ['label' => 'Construction', 'href' => 'construction.php'],
        'mining' => ['label' => 'Mining', 'href' => 'mining.php'],
        'catalog' => ['label' => 'Catalog', 'href' => 'catalog.php'],
        'projects' => ['label' => 'Projects', 'href' => 'projects.php'],
        'contact' => ['label' => 'Contact', 'href' => 'contact.php'],
    ],
    'footer_columns' => [
        [
            'title' => 'Company',
            'links' => [
                ['label' => 'Home', 'href' => '/en/'],
                ['label' => 'Company', 'href' => 'company.php'],
                ['label' => 'Contact', 'href' => 'contact.php'],
            ],
        ],
        [
            'title' => 'Activities',
            'links' => [
                ['label' => 'Agri-food', 'href' => 'agri-food.php'],
                ['label' => 'Construction', 'href' => 'construction.php'],
                ['label' => 'Mining', 'href' => 'mining.php'],
                ['label' => 'Catalog', 'href' => 'catalog.php'],
                ['label' => 'Projects', 'href' => 'projects.php'],
            ],
        ],
        [
            'title' => 'Contact',
            'links' => [
                ['label' => 'Email', 'href' => 'mailto:infobabiaguinee@gmail.com'],
                ['label' => '+224 655 903 333', 'href' => 'tel:+224655903333'],
                ['label' => 'WhatsApp', 'href' => 'https://wa.me/224620903333'],
                ['label' => 'Request a quote', 'href' => 'contact.php#formulaire'],
                ['label' => 'Product selection', 'href' => 'catalog.php'],
            ],
        ],
    ],
    'footer_bottom_links' => [
        ['label' => 'Legal notice', 'href' => 'legal.php'],
        ['label' => 'Privacy', 'href' => 'privacy.php'],
    ],
];

$structuredData = <<<'HTML'
    <script type="application/ld+json">
    {
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Groupe Babia Guinea",
  "url": "https://www.groupebabia.com/en/",
  "logo": "https://www.groupebabia.com/assets/images/logo.png",
  "image": "https://www.groupebabia.com/assets/images/partage-social.jpg",
  "description": "A Guinean multisector group active in agriculture, agri-food, construction, mining and fishing.",
  "email": "infobabiaguinee@gmail.com",
  "telephone": "+224655903333",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Kaloum",
    "addressLocality": "Conakry",
    "addressCountry": "GN"
  },
  "areaServed": [
    {
      "@type": "Country",
      "name": "Guinea"
    },
    {
      "@type": "Place",
      "name": "West Africa"
    }
  ]
}
    </script>
HTML;

/**
 * Les corps de page anglais sont des fichiers miroir de `app/pages/fr/`.
 * Un ecart de structure entre les deux dossiers se voit immediatement et
 * evite le retour de deux sites differents sous un meme habillage.
 */
$body = static function (string $file): string {
    return file_get_contents(__DIR__ . '/en/' . $file) ?: '';
};

$pages = [
    'index' => [
        'file' => 'index.php',
        'fr' => '../',
        'title' => 'Groupe Babia Guinea | Agriculture, Construction, Mining and Fishing',
        'description' => 'Groupe Babia Guinea, a multisector partner in agriculture, agri-food, construction, mining and fishing in Guinea and West Africa.',
        'active' => 'home',
        'body_class' => 'hero-overlay',
        'extra_head' => '    <link rel="preload" href="../assets/images/hero-agro-export-import.webp" as="image" type="image/webp" fetchpriority="high">' . "\n" . $structuredData,
        'body' => $body('index.html'),
    ],
    'company' => [
        'file' => 'company.php',
        'fr' => '../groupe.php',
        'title' => 'The group | Groupe Babia Guinea',
        'description' => 'Discover Groupe Babia Guinea, a multisector group active in agriculture, agri-food, construction, mining and fishing.',
        'active' => 'company',
        'body' => $body('company.html'),
    ],
    'agri-food' => [
        'file' => 'agri-food.php',
        'fr' => '../agroalimentaire.php',
        'title' => 'Agri-food, export & import | Groupe Babia Guinea',
        'description' => 'Agri-food business area of Groupe Babia Guinea: export of cocoa, coffee, cashew, soya, shea, honey and sesame, import of rice, oil and juice.',
        'active' => 'agri-food',
        'body' => $body('agri-food.html'),
    ],
    'construction' => [
        'file' => 'construction.php',
        'fr' => '../btp.php',
        'title' => 'Construction & public works | Groupe Babia Guinea',
        'description' => 'Construction business area of Groupe Babia Guinea: professional buildings, durable infrastructure and public works in Guinea and the wider region.',
        'active' => 'construction',
        'body' => $body('construction.html'),
    ],
    'mining' => [
        'file' => 'mining.php',
        'fr' => '../mines.php',
        'title' => 'Mining sector | Groupe Babia Guinea',
        'description' => 'Mining business area of Groupe Babia Guinea: logistics, supply, partnerships and responsible development of resources.',
        'active' => 'mining',
        'body' => $body('mining.html'),
    ],
    'catalog' => [
        'file' => 'catalog.php',
        'fr' => '../catalogue.php',
        'title' => 'Agri-food catalog | Groupe Babia Guinea',
        'description' => 'Agri-food catalog of Groupe Babia Guinea: agricultural products for export and food commodities for import, with a direct quotation request.',
        'active' => 'catalog',
        'body' => $body('catalog.html'),
    ],
    'projects' => [
        'file' => 'projects.php',
        'fr' => '../realisations.php',
        'title' => 'Projects | Groupe Babia Guinea',
        'description' => 'References and activities published by Groupe Babia Guinea across agri-food, construction, mining, fishing and agro-industry.',
        'active' => 'projects',
        'body' => $body('projects.html'),
    ],
    'contact' => [
        'file' => 'contact.php',
        'fr' => '../contact.php',
        'title' => 'Contact & quotation | Groupe Babia Guinea',
        'description' => 'Contact Groupe Babia Guinea: agriculture, agri-food, construction project, mining partnership, fishing or corporate information.',
        'active' => 'contact',
        'body' => $body('contact.html'),
    ],
    'legal' => [
        'file' => 'legal.php',
        'fr' => '../mentions-legales.php',
        'title' => 'Legal notice | Groupe Babia Guinea',
        'description' => 'Legal notice of Groupe Babia Guinea: website publisher, hosting, intellectual property and limits of liability for the information published.',
        'active' => '',
        'body' => $body('legal.html'),
    ],
    'privacy' => [
        'file' => 'privacy.php',
        'fr' => '../confidentialite.php',
        'title' => 'Privacy | Groupe Babia Guinea',
        'description' => 'Privacy policy of Groupe Babia Guinea: data collected through the contact form, purposes, retention period and your rights.',
        'active' => '',
        'body' => $body('privacy.html'),
    ],
    '404' => [
        'file' => '404.php',
        'fr' => '../404.php',
        'title' => 'Page not found | Groupe Babia Guinea',
        'description' => 'Page not found on the Groupe Babia Guinea website.',
        'active' => '',
        'status_code' => 404,
        'body' => $body('404.html'),
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
    $page['cta_href'] = 'contact.php#formulaire';
    $page['cta_label'] = 'Request a quote';
}
unset($page);

return [
    'site' => $site,
    'pages' => $pages,
];
