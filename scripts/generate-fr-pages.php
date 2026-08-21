<?php

declare(strict_types=1);

require dirname(__DIR__) . '/app/helpers.php';
require project_path('app/partials/site.php');

$french = require project_path('app/pages/fr.php');
$site = $french['site'];
$pages = $french['pages'];

foreach ($pages as $page) {
    $html = babia_render_page($page, $site);
    write_file(project_path((string) $page['file']), $html);
    echo 'Generated ' . $page['file'] . PHP_EOL;
}
