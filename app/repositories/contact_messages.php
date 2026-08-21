<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/database.php';

function contact_message_statuses(): array
{
    return [
        'new' => 'Nouveau',
        'processed' => 'Traité',
        'archived' => 'Archivé',
    ];
}

function contact_text_length(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
}

function contact_limit_text(string $value, int $limit): string
{
    return contact_text_length($value) <= $limit ? $value : substr($value, 0, $limit);
}

function contact_message_validate(array $input): array
{
    $errors = [];

    $name = trim((string) ($input['name'] ?? ''));
    $company = trim((string) ($input['company'] ?? ''));
    $email = trim((string) ($input['email'] ?? ''));
    $phone = trim((string) ($input['phone'] ?? ''));
    $need = trim((string) ($input['need'] ?? ''));
    $destination = trim((string) ($input['destination'] ?? ''));
    $timeline = trim((string) ($input['timeline'] ?? ''));
    $message = trim((string) ($input['message'] ?? ''));

    if ($name === '') {
        $errors['name'] = 'Le nom est obligatoire.';
    } elseif (contact_text_length($name) > 160) {
        $errors['name'] = 'Le nom ne doit pas dépasser 160 caractères.';
    }

    if ($company === '') {
        $errors['company'] = "Le nom de l'entreprise est obligatoire.";
    } elseif (contact_text_length($company) > 180) {
        $errors['company'] = "Le nom de l'entreprise ne doit pas dépasser 180 caractères.";
    }

    if ($email === '') {
        $errors['email'] = "L'e-mail est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'e-mail ne semble pas valide.";
    } elseif (contact_text_length($email) > 190) {
        $errors['email'] = "L'e-mail ne doit pas dépasser 190 caractères.";
    }

    if ($phone !== '' && contact_text_length($phone) > 80) {
        $errors['phone'] = 'Le téléphone ne doit pas dépasser 80 caractères.';
    }

    if ($need === '') {
        $errors['need'] = 'Le type de demande est obligatoire.';
    } elseif (contact_text_length($need) > 120) {
        $errors['need'] = 'Le type de demande ne doit pas dépasser 120 caractères.';
    }

    if ($destination !== '' && contact_text_length($destination) > 160) {
        $errors['destination'] = 'La destination ne doit pas dépasser 160 caractères.';
    }

    if ($timeline !== '' && contact_text_length($timeline) > 160) {
        $errors['timeline'] = 'Le calendrier ne doit pas dépasser 160 caractères.';
    }

    if ($message === '') {
        $errors['message'] = 'Le message est obligatoire.';
    } elseif (contact_text_length($message) > 5000) {
        $errors['message'] = 'Le message ne doit pas dépasser 5000 caractères.';
    }

    return [
        'errors' => $errors,
        'data' => [
            'name' => $name,
            'company' => $company,
            'email' => $email,
            'phone' => $phone === '' ? null : $phone,
            'need' => $need,
            'destination' => $destination === '' ? null : $destination,
            'timeline' => $timeline === '' ? null : $timeline,
            'message' => $message,
        ],
    ];
}

function create_contact_message(array $data): int
{
    $statement = db()->prepare(
        'INSERT INTO contact_messages
        (name, company, email, phone, need, destination, timeline, message, source_page, ip_address, user_agent)
        VALUES
        (:name, :company, :email, :phone, :need, :destination, :timeline, :message, :source_page, :ip_address, :user_agent)'
    );

    $statement->execute([
        'name' => $data['name'],
        'company' => $data['company'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'need' => $data['need'],
        'destination' => $data['destination'],
        'timeline' => $data['timeline'],
        'message' => $data['message'],
        'source_page' => $data['source_page'] ?? null,
        'ip_address' => $data['ip_address'] ?? null,
        'user_agent' => isset($data['user_agent']) ? contact_limit_text((string) $data['user_agent'], 255) : null,
    ]);

    return (int) db()->lastInsertId();
}

function list_contact_messages(?string $status = null, int $limit = 80): array
{
    $limit = max(1, min($limit, 200));
    $sql = 'SELECT * FROM contact_messages';
    $params = [];

    if ($status !== null) {
        $sql .= ' WHERE status = :status';
        $params['status'] = $status;
    }

    $sql .= ' ORDER BY created_at DESC, id DESC LIMIT ' . $limit;

    $statement = db()->prepare($sql);
    $statement->execute($params);

    return $statement->fetchAll();
}

function count_contact_messages_by_status(): array
{
    $statement = db()->query('SELECT status, COUNT(*) AS total FROM contact_messages GROUP BY status');
    $counts = [
        'new' => 0,
        'processed' => 0,
        'archived' => 0,
    ];

    foreach ($statement->fetchAll() as $row) {
        $counts[(string) $row['status']] = (int) $row['total'];
    }

    return $counts;
}

function update_contact_message_status(int $id, string $status): void
{
    if (!array_key_exists($status, contact_message_statuses())) {
        throw new RuntimeException('Statut de message invalide.');
    }

    $statement = db()->prepare('UPDATE contact_messages SET status = :status WHERE id = :id');
    $statement->execute([
        'id' => $id,
        'status' => $status,
    ]);
}
