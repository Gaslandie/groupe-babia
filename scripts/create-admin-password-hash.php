<?php

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$password = (string) ($argv[1] ?? '');

if ($password === '') {
    fwrite(STDERR, "Usage: php scripts/create-admin-password-hash.php \"mot-de-passe\"\n");
    exit(1);
}

echo password_hash($password, PASSWORD_DEFAULT), PHP_EOL;
