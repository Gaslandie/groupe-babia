<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/helpers.php';

function babia_render_nav(array $page, array $items): string
{
    $html = '';

    foreach ($items as $key => $item) {
        $class = ($page['active'] ?? '') === $key ? ' class="is-active"' : '';
        $html .= sprintf("        <a%s href=\"%s\">%s</a>\n", $class, e((string) $item['href']), e((string) $item['label']));
    }

    return $html;
}

function babia_render_page(array $page, array $site): string
{
    $canonical = (string) $page['canonical'];
    $alternateHref = (string) $page['alternate_canonical'];
    $navItems = $site['nav_items'];
    $assetPrefix = (string) ($site['asset_prefix'] ?? '../');
    $assetVersion = (string) ($site['asset_version'] ?? '20260822-client-copy');
    $stylesheetHref = e($assetPrefix . 'assets/css/styles.css?v=' . rawurlencode($assetVersion));
    $brandSmall = (string) ($site['brand_small'] ?? 'Guinea');
    $contentId = (string) ($site['content_id'] ?? 'content');
    $bodyClass = isset($page['body_class']) && $page['body_class'] !== '' ? ' class="' . e((string) $page['body_class']) . '"' : '';
    $extraHead = (string) ($page['extra_head'] ?? '');
    $body = (string) $page['body'];
    $footerColumns = babia_render_footer_columns($site['footer_columns']);
    $footerBottomLinks = babia_render_footer_bottom_links($site['footer_bottom_links']);

    return <<<HTML
<!doctype html>
<html lang="{$site['lang']}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>(function (root) { root.classList.add("js"); window.__babiaReveal = window.setTimeout(function () { root.classList.add("no-reveal"); }, 2000); })(document.documentElement);</script>
    <meta name="description" content="{$page['description']}">
    <title>{$page['title']}</title>
    <link rel="icon" href="{$assetPrefix}assets/images/favicon.png" sizes="32x32">
    <link rel="preload" href="{$assetPrefix}assets/fonts/Montserrat-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{$assetPrefix}assets/fonts/Montserrat-SemiBold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{$stylesheetHref}">
    <link rel="canonical" href="{$canonical}">
    <link rel="alternate" hreflang="{$page['alternate_lang']}" href="{$alternateHref}">
    <link rel="alternate" hreflang="{$site['lang']}" href="{$canonical}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{$site['name']}">
    <meta property="og:locale" content="{$site['og_locale']}">
    <meta property="og:url" content="{$canonical}">
    <meta property="og:title" content="{$page['title']}">
    <meta property="og:description" content="{$page['description']}">
    <meta property="og:image" content="https://www.groupebabia.com/assets/images/partage-social.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{$page['title']}">
    <meta name="twitter:description" content="{$page['description']}">
    <meta name="twitter:image" content="https://www.groupebabia.com/assets/images/partage-social.jpg">
{$extraHead}
  </head>
  <body{$bodyClass}>
    <a class="skip-link" href="#{$contentId}">{$site['skip_label']}</a>
    <header class="site-header" data-header>
      <a class="brand" href="{$site['home_href']}" aria-label="{$site['home_label']}">
        <img src="{$assetPrefix}assets/images/logo.webp" alt="" class="brand-logo" width="128" height="128" decoding="async">
        <span><strong>Groupe Babia</strong><small>{$brandSmall}</small></span>
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="{$site['menu_label']}" data-nav-toggle><span></span><span></span><span></span></button>
      <nav class="site-nav" id="site-nav" data-nav>
HTML
    . babia_render_nav($page, $navItems) .
    <<<HTML
      </nav>
    </header>
    <main id="{$contentId}" tabindex="-1">
{$body}
    </main>
    <footer class="site-footer">
      <div class="footer-card">
        <div class="footer-main">
          <div class="footer-brand">
            <a class="footer-logo" href="{$site['home_href']}" aria-label="{$site['home_label']}"><img src="{$assetPrefix}assets/images/logo.webp" alt="" width="128" height="128" decoding="async"><strong>Groupe Babia</strong></a>
            <p>{$site['footer_text']}</p>
            <div class="footer-socials" aria-label="{$site['direct_contacts_label']}"><a href="mailto:infobabiaguinee@gmail.com" aria-label="{$site['email_label']}" title="{$site['email_title']}"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4.2-8 5-8-5V6l8 5 8-5Z"/></svg></a><a href="tel:+224655903333" aria-label="{$site['phone_label']}" title="{$site['phone_title']}"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24 11.4 11.4 0 0 0 3.6.58 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.4 11.4 0 0 0 .57 3.6 1 1 0 0 1-.25 1Z"/></svg></a><a href="https://wa.me/224620903333" aria-label="{$site['whatsapp_label']}" title="{$site['whatsapp_title']}"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2Zm5.1 14.1c-.2.6-1.2 1.2-1.7 1.2-.5.1-1 .1-1.6-.1a13.6 13.6 0 0 1-5.3-4.6c-.4-.6-.9-1.4-.9-2.3 0-.9.5-1.3.7-1.5.2-.2.4-.3.6-.3h.4c.2 0 .4 0 .6.4l.7 1.7c.1.2 0 .4-.1.5l-.3.4c-.1.1-.2.3-.1.5a8 8 0 0 0 3.4 3c.2.1.4.1.5 0l.7-.8c.2-.2.3-.2.5-.1l1.7.8c.2.1.4.2.4.3.1.2.1.6 0 .9Z"/></svg></a></div>
          </div>
          <nav class="footer-columns" aria-label="{$site['footer_nav_label']}">
{$footerColumns}
          </nav>
        </div>
        <div class="footer-bottom"><p>{$site['copyright']}</p><p>{$site['credit']}</p><div>{$footerBottomLinks}</div></div>
      </div>
    </footer>
    <script src="{$assetPrefix}assets/js/main.js"></script>
  </body>
</html>
HTML;
}

function babia_render_footer_columns(array $columns): string
{
    $html = '';
    foreach ($columns as $column) {
        $html .= '            <div><strong>' . e((string) $column['title']) . '</strong>';
        foreach ($column['links'] as $link) {
            $html .= '<a href="' . e((string) $link['href']) . '">' . e((string) $link['label']) . '</a>';
        }
        $html .= "</div>\n";
    }

    return rtrim($html, "\n");
}

function babia_render_footer_bottom_links(array $links): string
{
    $html = '';
    foreach ($links as $link) {
        $html .= '<a href="' . e((string) $link['href']) . '">' . e((string) $link['label']) . '</a>';
    }

    return $html;
}

function babia_local_preview_html(string $html): string
{
    $preview = strtr($html, [
        'contact.php?need=construction#formulaire' => 'contact.html?need=construction#formulaire',
        'contact.php?need=mining#formulaire' => 'contact.html?need=mining#formulaire',
        'contact.php?need=corporate#formulaire' => 'contact.html?need=corporate#formulaire',
        'contact.php?need=fishing#formulaire' => 'contact.html?need=fishing#formulaire',
        'contact.php?need=agro-industry#formulaire' => 'contact.html?need=agro-industry#formulaire',
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
        'https://www.groupebabia.com/404.html' => 'https://www.groupebabia.com/404.php',
        'https://www.groupebabia.com/agroalimentaire.html' => 'https://www.groupebabia.com/agroalimentaire.php',
        'https://www.groupebabia.com/btp.html' => 'https://www.groupebabia.com/btp.php',
        'https://www.groupebabia.com/catalogue.html' => 'https://www.groupebabia.com/catalogue.php',
        'https://www.groupebabia.com/confidentialite.html' => 'https://www.groupebabia.com/confidentialite.php',
        'https://www.groupebabia.com/contact.html' => 'https://www.groupebabia.com/contact.php',
        'https://www.groupebabia.com/groupe.html' => 'https://www.groupebabia.com/groupe.php',
        'https://www.groupebabia.com/mentions-legales.html' => 'https://www.groupebabia.com/mentions-legales.php',
        'https://www.groupebabia.com/mines.html' => 'https://www.groupebabia.com/mines.php',
        'https://www.groupebabia.com/realisations.html' => 'https://www.groupebabia.com/realisations.php',
    ]);
}
