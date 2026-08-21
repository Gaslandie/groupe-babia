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

function contact_is_english_request(): bool
{
    return strtolower(trim((string) ($_POST['lang'] ?? ''))) === 'en';
}

function contact_response_text(string $key): string
{
    $english = contact_is_english_request();
    $messages = [
        'method_title' => ['Méthode non autorisée', 'Method not allowed'],
        'method_message' => ['Ce point de contact accepte uniquement les envois du formulaire.', 'This contact endpoint only accepts form submissions.'],
        'success_title' => ['Demande reçue', 'Request received'],
        'success_short' => ['Merci. Votre demande a bien été reçue.', 'Thank you. Your request has been received.'],
        'success_message' => ["Votre demande a été enregistrée. L'équipe Groupe Babia vous recontactera avec les informations transmises.", 'Your request has been recorded. The Groupe Babia team will get back to you using the information provided.'],
        'validation_title' => ['Quelques informations manquent', 'Some information is missing'],
        'validation_message' => ['Corrigez les champs signalés, puis renvoyez votre demande.', 'Please correct the highlighted fields, then send your request again.'],
        'unavailable_title' => ['Envoi momentanément indisponible', 'Submission temporarily unavailable'],
        'unavailable_config' => ["La réception serveur n'est pas encore configurée. Utilisez l'e-mail ou WhatsApp pour transmettre votre demande.", 'Server-side reception is not configured yet. Please use email or WhatsApp to send your request.'],
        'unavailable_message' => ["Votre demande n'a pas pu être enregistrée. Utilisez l'e-mail ou WhatsApp pour transmettre votre message.", 'Your request could not be saved. Please use email or WhatsApp to send your message.'],
    ];

    return $messages[$key][$english ? 1 : 0] ?? $key;
}

function contact_translate_errors(array $errors): array
{
    if (!contact_is_english_request()) {
        return $errors;
    }

    $english = [
        'name' => 'Name is required.',
        'company' => 'Company name is required.',
        'email' => 'A valid email address is required.',
        'phone' => 'Phone number must not exceed 80 characters.',
        'need' => 'Request type is required.',
        'destination' => 'Destination must not exceed 160 characters.',
        'timeline' => 'Timing must not exceed 160 characters.',
        'message' => 'Message is required and must not exceed 5000 characters.',
    ];

    foreach ($errors as $field => $message) {
        $errors[$field] = $english[$field] ?? (string) $message;
    }

    return $errors;
}

function contact_recipient_email(): string
{
    $email = env_value('CONTACT_RECIPIENT_EMAIL', 'infobabiaguinee@gmail.com');

    return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : 'infobabiaguinee@gmail.com';
}

function contact_email_body(array $data): string
{
    $value = static fn (string $key): string => trim((string) ($data[$key] ?? '')) !== '' ? trim((string) $data[$key]) : '-';

    return implode("\n", [
        'Nouvelle demande reçue depuis groupebabia.com',
        '',
        'Nom : ' . $value('name'),
        'Entreprise : ' . $value('company'),
        'E-mail : ' . $value('email'),
        'Téléphone : ' . $value('phone'),
        'Besoin : ' . $value('need'),
        'Pays / destination : ' . $value('destination'),
        'Calendrier souhaité : ' . $value('timeline'),
        '',
        'Message :',
        $value('message'),
        '',
        'Ce message est aussi enregistré dans l’espace privé du site.',
    ]);
}

function notify_contact_recipient(array $data): bool
{
    $recipient = contact_recipient_email();
    $subject = 'Nouvelle demande Groupe Babia - ' . (string) $data['need'];
    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'From: Groupe Babia <no-reply@groupebabia.com>',
        'Reply-To: ' . (string) $data['name'] . ' <' . (string) $data['email'] . '>',
    ];

    return mail($recipient, $subject, contact_email_body($data), implode("\r\n", $headers));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    contact_json(405, [
        'ok' => false,
        'title' => contact_response_text('method_title'),
        'message' => contact_response_text('method_message'),
    ]);
}

if (trim((string) ($_POST['website'] ?? '')) !== '') {
    contact_json(200, [
        'ok' => true,
        'title' => contact_response_text('success_title'),
        'message' => contact_response_text('success_short'),
    ]);
}

$validation = contact_message_validate($_POST);
if ($validation['errors'] !== []) {
    contact_json(422, [
        'ok' => false,
        'title' => contact_response_text('validation_title'),
        'message' => contact_response_text('validation_message'),
        'errors' => contact_translate_errors($validation['errors']),
    ]);
}

if (!database_is_configured()) {
    contact_json(503, [
        'ok' => false,
        'title' => contact_response_text('unavailable_title'),
        'message' => contact_response_text('unavailable_config'),
    ]);
}

try {
    $messageData = array_merge($validation['data'], [
        'source_page' => isset($_SERVER['HTTP_REFERER']) ? substr((string) $_SERVER['HTTP_REFERER'], 0, 255) : null,
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
    ]);
    create_contact_message($messageData);
    notify_contact_recipient($messageData);
} catch (Throwable $exception) {
    contact_json(500, [
        'ok' => false,
        'title' => contact_response_text('unavailable_title'),
        'message' => contact_response_text('unavailable_message'),
    ]);
}

contact_json(200, [
    'ok' => true,
    'title' => contact_response_text('success_title'),
    'message' => contact_response_text('success_message'),
]);
