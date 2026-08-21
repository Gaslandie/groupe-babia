<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/env.php';

load_env_file(project_path('.env'));

function database_config(): array
{
    return [
        'host' => env_value('DB_HOST', 'localhost'),
        'port' => env_value('DB_PORT', '3306'),
        'name' => env_value('DB_NAME'),
        'user' => env_value('DB_USER'),
        'password' => env_value('DB_PASSWORD'),
    ];
}

function database_is_configured(): bool
{
    $config = database_config();

    return (string) $config['name'] !== ''
        && (string) $config['user'] !== ''
        && (string) $config['password'] !== '';
}

function db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $config = database_config();
    if (!database_is_configured()) {
        throw new RuntimeException('Configuration MySQL incomplète. Renseigner DB_NAME, DB_USER et DB_PASSWORD.');
    }

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $config['host'],
        $config['port'],
        $config['name']
    );

    $pdo = new PDO($dsn, (string) $config['user'], (string) $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}
