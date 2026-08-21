<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$pages = require $root . '/app/data/pages.php';
$phpPages = require $root . '/app/data/php_pages.php';
$files = array_map(
    static fn (array $page): string => (string) $page['target'],
    $pages
);
$files = array_merge($files, ['.htaccess', 'robots.txt', 'sitemap.xml']);

if (is_dir($root . '/dist/app')) {
    foreach ($pages as $page) {
        if (isset($page['php'])) {
            $files[] = (string) $page['php'];
        }
    }

    foreach ($phpPages as $phpPage) {
        $files[] = (string) $phpPage;
    }

    $files[] = 'uploads/.htaccess';
    $files[] = 'uploads/realisations/.gitkeep';

    if (is_dir($root . '/dist/espace-gb')) {
        $files[] = '.env.example';

        foreach (['espace-gb', 'database'] as $directory) {
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($root . DIRECTORY_SEPARATOR . $directory, FilesystemIterator::SKIP_DOTS)
            );

            foreach ($iterator as $item) {
                if ($item->isFile()) {
                    $files[] = $directory . '/' . $iterator->getSubPathName();
                }
            }
        }
    }
}

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
