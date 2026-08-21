<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

function render_static_page(string $source): void
{
    $path = project_path($source);

    if (!is_file($path)) {
        http_response_code(404);
        $fallback = project_path('404.html');
        if (is_file($fallback)) {
            header('Content-Type: text/html; charset=UTF-8');
            readfile($fallback);
            return;
        }

        echo 'Page introuvable.';
        return;
    }

    header('Content-Type: text/html; charset=UTF-8');
    readfile($path);
}
