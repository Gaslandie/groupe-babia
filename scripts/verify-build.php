<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$pages = require $root . '/app/data/pages.php';
$files = array_map(
    static fn (array $page): string => (string) $page['target'],
    $pages
);
$files = array_merge($files, ['.htaccess', 'robots.txt', 'sitemap.xml']);

$hasDiff = false;

foreach ($files as $file) {
    $source = $root . DIRECTORY_SEPARATOR . $file;
    $target = $root . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR . $file;

    if (!is_file($source)) {
        echo "SOURCE MANQUANTE {$file}\n";
        $hasDiff = true;
        continue;
    }

    if (!is_file($target)) {
        echo "DIST MANQUANT {$file}\n";
        $hasDiff = true;
        continue;
    }

    if (hash_file('sha256', $source) !== hash_file('sha256', $target)) {
        echo "DIFF {$file}\n";
        $hasDiff = true;
        continue;
    }

    echo "OK   {$file}\n";
}

if ($hasDiff) {
    exit(1);
}
