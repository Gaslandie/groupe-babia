<?php

declare(strict_types=1);

// Le serveur PHP local n'applique pas les protections des fichiers .htaccess.
$root = dirname(__DIR__);
$path = rawurldecode((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
$host = $_SERVER['HTTP_HOST'] ?? '';
if (!preg_match('/^(?:localhost|127\.0\.0\.1):4173$/D', $host)
    || preg_match('/[\\\\\x00-\x1f%]/', $path)
    || preg_match('~(?:^|/)\.{1,2}(?:/|$)|(?:^|/)\.~', $path)) {
    http_response_code(403);
    return true;
}

header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-Frame-Options: SAMEORIGIN');

if (preg_match('~^/realisations/([A-Za-z0-9-]+)/?$~D', $path, $match)) {
    $_GET['slug'] = $match[1];
    require $root . '/realisation.php';
    return true;
}

$path = ['/' => '/index.php', '/en/' => '/en/index.php', '/espace-gb/' => '/espace-gb/index.php'][$path] ?? $path;
$allowed = ['/robots.txt', '/sitemap.xml'];
foreach (require $root . '/app/data/pages.php' as $page) {
    $allowed[] = '/' . $page['target'];
    $allowed[] = '/' . $page['php'];
}
foreach (require $root . '/app/data/php_pages.php' as $page) {
    $allowed[] = '/' . $page;
}
foreach (glob($root . '/en/*.{php,html}', GLOB_BRACE) ?: [] as $file) {
    $allowed[] = '/en/' . basename($file);
}
foreach (glob($root . '/espace-gb/*.php') ?: [] as $file) {
    $allowed[] = '/espace-gb/' . basename($file);
}
$asset = preg_match('~^/(?:assets/|uploads/realisations/)[A-Za-z0-9/_-]+\.(?:css|js|webp|png|jpe?g|gif|svg|ico|woff2?|ttf)$~Di', $path);
$file = realpath($root . $path);
if ((!in_array($path, $allowed, true) && !$asset)
    || $file === false || !is_file($file)
    || strpos($file, $root . DIRECTORY_SEPARATOR) !== 0) {
    http_response_code(404);
    require $root . '/404.php';
    return true;
}

if (substr($file, -4) === '.php') {
    require $file;
    return true;
}

return false;
