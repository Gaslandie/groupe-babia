<?php

declare(strict_types=1);

require __DIR__ . '/app/helpers.php';
require __DIR__ . '/app/public/realisations.php';

$path = project_path('index.html');
if (!is_file($path)) {
    http_response_code(404);
    echo 'Page introuvable.';
    exit;
}

$html = (string) file_get_contents($path);
$publicationState = public_fetch_realisations(3);
$realisations = $publicationState['items'];

if ($realisations !== []) {
    ob_start();
    ?>
      <section class="section soft-section">
        <div class="section-heading">
          <p class="eyebrow">Actualités</p>
          <h2>Dernières publications</h2>
          <p>Quelques actualités et mises à jour rendues publiques par Groupe Babia Guinée.</p>
        </div>
        <?php public_render_realisations_grid($realisations); ?>
        <div class="section-more">
          <a class="button button-primary" href="realisations.php">Voir toutes les actualités</a>
        </div>
      </section>
<?php
    $dynamicSection = (string) ob_get_clean();
    $sectionStart = strpos($html, '<section class="section soft-section">');
    $sectionEnd = $sectionStart === false ? false : strpos($html, '</section>', $sectionStart);

    if ($sectionStart !== false && $sectionEnd !== false) {
        $html = substr_replace($html, $dynamicSection, $sectionStart, $sectionEnd + strlen('</section>') - $sectionStart);
    }
}

header('Content-Type: text/html; charset=UTF-8');
echo $html;
