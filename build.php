<?php

declare(strict_types=1);

require __DIR__ . '/app/helpers.php';

$config = require project_path('app/config.php');
$pages = require project_path('app/data/pages.php');

$dist = project_path('dist');
$withPhp = in_array('--with-php', $argv, true);

ensure_empty_directory($dist);

copy_directory(project_path('assets'), $dist . DIRECTORY_SEPARATOR . 'assets');

foreach (['.htaccess', 'robots.txt', 'sitemap.xml'] as $staticFile) {
    copy_file(project_path($staticFile), $dist . DIRECTORY_SEPARATOR . $staticFile);
}

foreach ($pages as $page) {
    if (!isset($page['source'], $page['target'])) {
        throw new RuntimeException('Chaque page doit définir source et target.');
    }

    $source = project_path((string) $page['source']);
    $target = $dist . DIRECTORY_SEPARATOR . (string) $page['target'];
    copy_file($source, $target);

    if ($withPhp && isset($page['php'])) {
        copy_file(project_path((string) $page['php']), $dist . DIRECTORY_SEPARATOR . (string) $page['php']);
    }
}

if ($withPhp) {
    copy_directory(project_path('app'), $dist . DIRECTORY_SEPARATOR . 'app');
}

echo sprintf(
    "Build terminé: %d pages générées dans %s pour %s%s\n",
    count($pages),
    $dist,
    $config['base_url'],
    $withPhp ? ' avec les points d’entrée PHP' : ''
);
