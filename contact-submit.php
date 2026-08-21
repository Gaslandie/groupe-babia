<?php

declare(strict_types=1);

require __DIR__ . '/app/repositories/contact_messages.php';

header('Content-Type: application/json; charset=utf-8');
header('X-Robots-Tag: noindex, nofollow');

function contact_json(int $status, array $payload): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    contact_json(405, [
        'ok' => false,
        'title' => 'Méthode non autorisée',
        'message' => 'Ce point de contact accepte uniquement les envois du formulaire.',
    ]);
}

if (trim((string) ($_POST['website'] ?? '')) !== '') {
    contact_json(200, [
        'ok' => true,
        'title' => 'Demande reçue',
        'message' => 'Merci. Votre demande a bien été reçue.',
    ]);
}

$validation = contact_message_validate($_POST);
if ($validation['errors'] !== []) {
    contact_json(422, [
        'ok' => false,
        'title' => 'Quelques informations manquent',
        'message' => 'Corrigez les champs signalés, puis renvoyez votre demande.',
        'errors' => $validation['errors'],
    ]);
}

if (!database_is_configured()) {
    contact_json(503, [
        'ok' => false,
        'title' => 'Envoi momentanément indisponible',
        'message' => "La réception serveur n'est pas encore configurée. Utilisez l'e-mail ou WhatsApp pour transmettre votre demande.",
    ]);
}

try {
    create_contact_message(array_merge($validation['data'], [
        'source_page' => isset($_SERVER['HTTP_REFERER']) ? substr((string) $_SERVER['HTTP_REFERER'], 0, 255) : null,
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
    ]));
} catch (Throwable $exception) {
    contact_json(500, [
        'ok' => false,
        'title' => 'Envoi momentanément indisponible',
        'message' => "Votre demande n'a pas pu être enregistrée. Utilisez l'e-mail ou WhatsApp pour transmettre votre message.",
    ]);
}

contact_json(200, [
    'ok' => true,
    'title' => 'Demande reçue',
    'message' => "Votre demande a été enregistrée. L'équipe Groupe Babia vous recontactera avec les informations transmises.",
]);
