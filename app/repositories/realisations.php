<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/database.php';

function realisation_sectors(): array
{
    return [
        'agroalimentaire' => 'Agroalimentaire',
        'btp' => 'BTP',
        'mines' => 'Mines',
        'peche' => 'Pêche',
        'agro-industrie' => 'Agro-industrie',
        'corporate' => 'Corporate',
    ];
}

function realisation_statuses(): array
{
    return [
        'draft' => 'Brouillon',
        'published' => 'Publié',
        'archived' => 'Archivé',
    ];
}

function list_realisations(?string $status = null, int $limit = 30): array
{
    $limit = max(1, min($limit, 100));
    $sql = 'SELECT * FROM realisations';
    $params = [];

    if ($status !== null) {
        $sql .= ' WHERE status = :status';
        $params['status'] = $status;
    }

    $sql .= ' ORDER BY is_featured DESC, COALESCE(published_at, created_at) DESC, id DESC LIMIT ' . $limit;

    $statement = db()->prepare($sql);
    $statement->execute($params);

    return $statement->fetchAll();
}

function count_realisations_by_status(): array
{
    $statement = db()->query('SELECT status, COUNT(*) AS total FROM realisations GROUP BY status');
    $counts = [
        'draft' => 0,
        'published' => 0,
        'archived' => 0,
    ];

    foreach ($statement->fetchAll() as $row) {
        $counts[(string) $row['status']] = (int) $row['total'];
    }

    return $counts;
}
