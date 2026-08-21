<?php

declare(strict_types=1);

require dirname(__DIR__) . '/app/helpers.php';
require project_path('app/partials/site.php');

$english = require project_path('app/pages/en.php');
$site = $english['site'];
$pages = $english['pages'];

$directory = project_path('en');
if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
    throw new RuntimeException('Unable to create English directory.');
}

foreach ($pages as $page) {
    $html = babia_render_page($page, $site);
    write_file($directory . DIRECTORY_SEPARATOR . $page['file'], $html);
    echo 'Generated en/' . $page['file'] . PHP_EOL;

    $previewFile = preg_replace('/\.php$/', '.html', (string) $page['file']);
    if ($previewFile === null) {
        throw new RuntimeException('Unable to create preview filename.');
    }

    write_file($directory . DIRECTORY_SEPARATOR . $previewFile, babia_local_preview_html($html));
    echo 'Generated en/' . $previewFile . PHP_EOL;
}
