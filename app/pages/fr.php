<?php

declare(strict_types=1);

$site = [
    'lang' => 'fr',
    'name' => 'Groupe Babia Guinée',
    'og_locale' => 'fr_FR',
    'asset_prefix' => '',
    'content_id' => 'contenu',
    'brand_small' => 'Guinée',
    'home_href' => '/',
    'home_label' => 'Accueil Groupe Babia Guinée',
    'skip_label' => 'Aller au contenu principal',
    'menu_label' => 'Ouvrir le menu',
    'direct_contacts_label' => 'Contacts directs',
    'email_label' => 'Nous écrire par e-mail',
    'email_title' => 'E-mail',
    'phone_label' => 'Appeler le +224 655 903 333',
    'phone_title' => 'Téléphone',
    'whatsapp_label' => 'Écrire sur WhatsApp au +224 620 903 333',
    'whatsapp_title' => 'WhatsApp',
    'footer_nav_label' => 'Navigation pied de page',
    'footer_text' => 'Groupe multisectoriel guinéen actif dans l\'agriculture, l\'agro-industrie, le BTP, la pêche et les services au secteur minier, au service de partenaires locaux et internationaux.',
    'copyright' => '© 2026 Groupe Babia Guinée. Tous droits réservés.',
    'nav_items' => [
        'home' => ['label' => 'Accueil', 'href' => '/'],
        'groupe' => ['label' => 'Le groupe', 'href' => 'groupe.php'],
        'agroalimentaire' => ['label' => 'Agroalimentaire', 'href' => 'agroalimentaire.php'],
        'btp' => ['label' => 'BTP', 'href' => 'btp.php'],
        'mines' => ['label' => 'Mines', 'href' => 'mines.php'],
        'catalogue' => ['label' => 'Catalogue', 'href' => 'catalogue.php'],
        'realisations' => ['label' => 'Réalisations', 'href' => 'realisations.php'],
        'contact' => ['label' => 'Contact', 'href' => 'contact.php'],
    ],
    'footer_columns' => [
        [
            'title' => 'Groupe',
            'links' => [
                ['label' => 'Accueil', 'href' => '/'],
                ['label' => 'Le groupe', 'href' => 'groupe.php'],
                ['label' => 'Contact', 'href' => 'contact.php'],
            ],
        ],
        [
            'title' => 'Activités',
            'links' => [
                ['label' => 'Agroalimentaire', 'href' => 'agroalimentaire.php'],
                ['label' => 'BTP', 'href' => 'btp.php'],
                ['label' => 'Mines', 'href' => 'mines.php'],
                ['label' => 'Catalogue', 'href' => 'catalogue.php'],
                ['label' => 'Réalisations', 'href' => 'realisations.php'],
            ],
        ],
        [
            'title' => 'Contact',
            'links' => [
                ['label' => 'E-mail', 'href' => 'mailto:infobabiaguinee@gmail.com'],
                ['label' => '+224 655 903 333', 'href' => 'tel:+224655903333'],
                ['label' => 'WhatsApp', 'href' => 'https://wa.me/224620903333'],
                ['label' => 'Demander un devis', 'href' => 'contact.php'],
                ['label' => 'Sélection produits', 'href' => 'catalogue.php'],
            ],
        ],
    ],
    'footer_bottom_links' => [
        ['label' => 'Mentions légales', 'href' => 'mentions-legales.php'],
        ['label' => 'Confidentialité', 'href' => 'confidentialite.php'],
    ],
];

$structuredData = <<<'HTML'
    <script type="application/ld+json">
    {
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Groupe Babia Guinée",
  "url": "https://www.groupebabia.com/",
  "logo": "https://www.groupebabia.com/assets/images/logo.png",
  "image": "https://www.groupebabia.com/assets/images/partage-social.jpg",
  "description": "Groupe multisectoriel guinéen actif dans l'agriculture, l'agro-industrie, le BTP, les mines et la pêche.",
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
      "name": "Guinée"
    },
    {
      "@type": "Place",
      "name": "Afrique de l'Ouest"
    }
  ]
}
    </script>
HTML;

$pages = [
    'home' => [
        'file' => 'index.html',
        'php' => 'index.php',
        'title' => 'Groupe Babia Guinée | Agriculture, BTP, Mines et Pêche',
        'description' => 'Groupe Babia Guinée, partenaire multisectoriel en agriculture, agro-industrie, BTP, mines et pêche en Guinée et en Afrique de l\'Ouest.',
        'active' => 'home',
        'alternate_href' => 'en/',
        'alternate_canonical' => 'https://www.groupebabia.com/en/',
        'body_class' => 'hero-overlay',
        'extra_head' => '    <link rel="preload" href="assets/images/hero-agro-export-import.webp" as="image" type="image/webp" fetchpriority="high">' . "\n" . $structuredData,
        'body' => file_get_contents(__DIR__ . '/fr/index.html') ?: '',
    ],
    'groupe' => [
        'file' => 'groupe.html',
        'php' => 'groupe.php',
        'title' => 'Le groupe | Groupe Babia Guinée',
        'description' => 'Découvrez Groupe Babia Guinée, groupe multisectoriel actif dans l\'agriculture, l\'agro-industrie, le BTP, les mines et la pêche.',
        'active' => 'groupe',
        'alternate_href' => 'en/company.php',
        'alternate_canonical' => 'https://www.groupebabia.com/en/company.php',
        'body' => file_get_contents(__DIR__ . '/fr/groupe.html') ?: '',
    ],
    'agroalimentaire' => [
        'file' => 'agroalimentaire.html',
        'php' => 'agroalimentaire.php',
        'title' => 'Agroalimentaire, export & import | Groupe Babia Guinée',
        'description' => 'Pôle agroalimentaire de Groupe Babia Guinée : exportation de cacao, café, cajou, soja, karité, miel et sésame, importation de riz, huile et jus.',
        'active' => 'agroalimentaire',
        'alternate_href' => 'en/agri-food.php',
        'alternate_canonical' => 'https://www.groupebabia.com/en/agri-food.php',
        'body' => file_get_contents(__DIR__ . '/fr/agroalimentaire.html') ?: '',
    ],
    'btp' => [
        'file' => 'btp.html',
        'php' => 'btp.php',
        'title' => 'Construction & BTP | Groupe Babia Guinée',
        'description' => 'Pôle Construction et BTP de Groupe Babia Guinée : bâtiments professionnels, infrastructures durables et travaux publics en Guinée et dans la sous-région.',
        'active' => 'btp',
        'alternate_href' => 'en/construction.php',
        'alternate_canonical' => 'https://www.groupebabia.com/en/construction.php',
        'body' => file_get_contents(__DIR__ . '/fr/btp.html') ?: '',
    ],
    'mines' => [
        'file' => 'mines.html',
        'php' => 'mines.php',
        'title' => 'Secteur minier | Groupe Babia Guinée',
        'description' => 'Pôle minier de Groupe Babia Guinée : logistique, approvisionnement, partenariats et valorisation responsable des ressources.',
        'active' => 'mines',
        'alternate_href' => 'en/mining.php',
        'alternate_canonical' => 'https://www.groupebabia.com/en/mining.php',
        'body' => file_get_contents(__DIR__ . '/fr/mines.html') ?: '',
    ],
    'catalogue' => [
        'file' => 'catalogue.html',
        'php' => 'catalogue.php',
        'title' => 'Catalogue agroalimentaire | Groupe Babia Guinée',
        'description' => 'Catalogue agroalimentaire de Groupe Babia Guinée : produits agricoles à l\'exportation et denrées à l\'importation, avec demande de cotation directe.',
        'active' => 'catalogue',
        'alternate_href' => 'en/catalog.php',
        'alternate_canonical' => 'https://www.groupebabia.com/en/catalog.php',
        'body' => file_get_contents(__DIR__ . '/fr/catalogue.html') ?: '',
    ],
    'contact' => [
        'file' => 'contact.html',
        'php' => 'contact.php',
        'title' => 'Contact & devis | Groupe Babia Guinée',
        'description' => 'Contact Groupe Babia Guinée : agriculture, agro-industrie, projet BTP, partenariat minier, pêche ou information corporate.',
        'active' => 'contact',
        'alternate_href' => 'en/contact.php',
        'alternate_canonical' => 'https://www.groupebabia.com/en/contact.php',
        'body' => file_get_contents(__DIR__ . '/fr/contact.html') ?: '',
    ],
    'mentions-legales' => [
        'file' => 'mentions-legales.html',
        'php' => 'mentions-legales.php',
        'title' => 'Mentions légales | Groupe Babia Guinée',
        'description' => 'Mentions légales de Groupe Babia Guinée : éditeur du site, hébergement, propriété intellectuelle et limites de responsabilité des informations publiées.',
        'active' => '',
        'alternate_href' => 'en/legal.php',
        'alternate_canonical' => 'https://www.groupebabia.com/en/legal.php',
        'body' => file_get_contents(__DIR__ . '/fr/mentions-legales.html') ?: '',
    ],
    'confidentialite' => [
        'file' => 'confidentialite.html',
        'php' => 'confidentialite.php',
        'title' => 'Confidentialité | Groupe Babia Guinée',
        'description' => 'Politique de confidentialité de Groupe Babia Guinée : données collectées via le formulaire de contact, finalités, durée de conservation et vos droits.',
        'active' => '',
        'alternate_href' => 'en/privacy.php',
        'alternate_canonical' => 'https://www.groupebabia.com/en/privacy.php',
        'body' => file_get_contents(__DIR__ . '/fr/confidentialite.html') ?: '',
    ],
    '404' => [
        'file' => '404.html',
        'php' => '404.php',
        'title' => 'Page introuvable | Groupe Babia Guinée',
        'description' => 'Page introuvable sur le site de Groupe Babia Guinée.',
        'active' => '',
        'alternate_href' => 'en/404.php',
        'alternate_canonical' => 'https://www.groupebabia.com/en/404.php',
        'body' => file_get_contents(__DIR__ . '/fr/404.html') ?: '',
    ],
];

foreach ($pages as &$page) {
    $php = (string) $page['php'];
    $page['canonical'] = $php === 'index.php'
        ? 'https://www.groupebabia.com/'
        : 'https://www.groupebabia.com/' . $php;
    $page['alternate_lang'] = 'en';
    $page['alternate_label'] = 'EN';
    $page['cta_href'] = 'contact.php#formulaire';
    $page['cta_label'] = 'Demander un devis';
}
unset($page);

return [
    'site' => $site,
    'pages' => $pages,
];
