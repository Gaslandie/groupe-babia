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

function find_realisation(int $id): ?array
{
    $statement = db()->prepare('SELECT * FROM realisations WHERE id = :id LIMIT 1');
    $statement->execute(['id' => $id]);
    $item = $statement->fetch();

    return $item === false ? null : $item;
}

function realisation_slugify(string $value): string
{
    $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value) ?: $value;
    $value = strtolower($value);
    $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? '';
    $value = trim($value, '-');

    return $value === '' ? 'realisation' : $value;
}

function realisation_unique_slug(string $baseSlug, ?int $ignoreId = null): string
{
    $slug = realisation_slugify($baseSlug);
    $candidate = $slug;
    $index = 2;

    while (realisation_slug_exists($candidate, $ignoreId)) {
        $candidate = $slug . '-' . $index;
        $index++;
    }

    return $candidate;
}

function realisation_slug_exists(string $slug, ?int $ignoreId = null): bool
{
    $sql = 'SELECT id FROM realisations WHERE slug = :slug';
    $params = ['slug' => $slug];

    if ($ignoreId !== null) {
        $sql .= ' AND id <> :id';
        $params['id'] = $ignoreId;
    }

    $sql .= ' LIMIT 1';
    $statement = db()->prepare($sql);
    $statement->execute($params);

    return $statement->fetch() !== false;
}

function realisation_validate(array $input): array
{
    $errors = [];
    $sectors = array_keys(realisation_sectors());
    $statuses = array_keys(realisation_statuses());

    $title = trim((string) ($input['title'] ?? ''));
    $sector = trim((string) ($input['sector'] ?? 'corporate'));
    $summary = trim((string) ($input['summary'] ?? ''));
    $body = trim((string) ($input['body'] ?? ''));
    $location = trim((string) ($input['location'] ?? ''));
    $realisedAt = trim((string) ($input['realised_at'] ?? ''));
    $coverImage = trim((string) ($input['cover_image'] ?? ''));
    $coverAlt = trim((string) ($input['cover_alt'] ?? ''));
    $status = trim((string) ($input['status'] ?? 'draft'));
    $isFeatured = isset($input['is_featured']) && (string) $input['is_featured'] === '1' ? 1 : 0;

    if ($title === '') {
        $errors['title'] = 'Le titre est obligatoire.';
    } elseif (mb_strlen($title) > 180) {
        $errors['title'] = 'Le titre ne doit pas dépasser 180 caractères.';
    }

    if (!in_array($sector, $sectors, true)) {
        $errors['sector'] = 'Secteur invalide.';
    }

    if ($summary === '') {
        $errors['summary'] = 'Le résumé est obligatoire.';
    } elseif (mb_strlen($summary) > 320) {
        $errors['summary'] = 'Le résumé ne doit pas dépasser 320 caractères.';
    }

    if ($body === '') {
        $errors['body'] = 'Le contenu est obligatoire.';
    }

    if ($realisedAt !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $realisedAt)) {
        $errors['realised_at'] = 'La date doit être au format AAAA-MM-JJ.';
    }

    if (!in_array($status, $statuses, true)) {
        $errors['status'] = 'Statut invalide.';
    }

    return [
        'errors' => $errors,
        'data' => [
            'title' => $title,
            'sector' => $sector,
            'summary' => $summary,
            'body' => $body,
            'location' => $location === '' ? null : $location,
            'realised_at' => $realisedAt === '' ? null : $realisedAt,
            'cover_image' => $coverImage === '' ? null : $coverImage,
            'cover_alt' => $coverAlt === '' ? null : $coverAlt,
            'status' => $status,
            'is_featured' => $isFeatured,
        ],
    ];
}

function create_realisation(array $data): int
{
    $slug = realisation_unique_slug((string) $data['title']);
    $publishedAt = $data['status'] === 'published' ? date('Y-m-d H:i:s') : null;

    $statement = db()->prepare(
        'INSERT INTO realisations
        (title, slug, sector, summary, body, location, realised_at, cover_image, cover_alt, is_featured, status, published_at)
        VALUES
        (:title, :slug, :sector, :summary, :body, :location, :realised_at, :cover_image, :cover_alt, :is_featured, :status, :published_at)'
    );

    $statement->execute([
        'title' => $data['title'],
        'slug' => $slug,
        'sector' => $data['sector'],
        'summary' => $data['summary'],
        'body' => $data['body'],
        'location' => $data['location'],
        'realised_at' => $data['realised_at'],
        'cover_image' => $data['cover_image'],
        'cover_alt' => $data['cover_alt'],
        'is_featured' => $data['is_featured'],
        'status' => $data['status'],
        'published_at' => $publishedAt,
    ]);

    return (int) db()->lastInsertId();
}

function update_realisation(int $id, array $data): void
{
    $current = find_realisation($id);
    if ($current === null) {
        throw new RuntimeException('Réalisation introuvable.');
    }

    $publishedAt = $current['published_at'];
    if ($data['status'] === 'published' && $publishedAt === null) {
        $publishedAt = date('Y-m-d H:i:s');
    }
    if ($data['status'] !== 'published') {
        $publishedAt = null;
    }

    $statement = db()->prepare(
        'UPDATE realisations SET
          title = :title,
          slug = :slug,
          sector = :sector,
          summary = :summary,
          body = :body,
          location = :location,
          realised_at = :realised_at,
          cover_image = :cover_image,
          cover_alt = :cover_alt,
          is_featured = :is_featured,
          status = :status,
          published_at = :published_at
        WHERE id = :id'
    );

    $statement->execute([
        'id' => $id,
        'title' => $data['title'],
        'slug' => realisation_unique_slug((string) $data['title'], $id),
        'sector' => $data['sector'],
        'summary' => $data['summary'],
        'body' => $data['body'],
        'location' => $data['location'],
        'realised_at' => $data['realised_at'],
        'cover_image' => $data['cover_image'],
        'cover_alt' => $data['cover_alt'],
        'is_featured' => $data['is_featured'],
        'status' => $data['status'],
        'published_at' => $publishedAt,
    ]);
}

function delete_realisation(int $id): void
{
    $statement = db()->prepare('DELETE FROM realisations WHERE id = :id');
    $statement->execute(['id' => $id]);
}
