<?php

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once dirname(__DIR__) . '/app/database.php';

if (!database_is_configured()) {
    fwrite(STDERR, "Configuration MySQL incomplete. Verifiez .env.\n");
    exit(1);
}

$pdo = db();
$pdo->exec(
    'CREATE TABLE IF NOT EXISTS schema_migrations (
      migration VARCHAR(190) PRIMARY KEY,
      applied_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
);

$applied = [];
$statement = $pdo->query('SELECT migration FROM schema_migrations');
foreach ($statement->fetchAll() as $row) {
    $applied[(string) $row['migration']] = true;
}

$migrationFiles = glob(__DIR__ . '/migrations/*.sql') ?: [];
sort($migrationFiles);

foreach ($migrationFiles as $path) {
    $name = basename($path);
    if (isset($applied[$name])) {
        echo "SKIP {$name}\n";
        continue;
    }

    $sql = file_get_contents($path);
    if ($sql === false || trim($sql) === '') {
        fwrite(STDERR, "Migration vide ou illisible: {$name}\n");
        exit(1);
    }

    $pdo->beginTransaction();
    try {
        $pdo->exec($sql);
        $insert = $pdo->prepare('INSERT INTO schema_migrations (migration) VALUES (:migration)');
        $insert->execute(['migration' => $name]);
        $pdo->commit();
        echo "OK   {$name}\n";
    } catch (Throwable $exception) {
        $pdo->rollBack();
        fwrite(STDERR, "ERREUR {$name}: " . $exception->getMessage() . "\n");
        exit(1);
    }
}

echo "Migrations terminees.\n";
