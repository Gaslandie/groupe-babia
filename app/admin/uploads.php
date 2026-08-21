<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/helpers.php';

function admin_handle_realisation_upload(string $fieldName, array &$errors): ?string
{
    if (!isset($_FILES[$fieldName]) || !is_array($_FILES[$fieldName])) {
        return null;
    }

    $file = $_FILES[$fieldName];
    $error = (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE);
    if ($error === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($error !== UPLOAD_ERR_OK) {
        $errors['cover_image'] = 'Le téléversement de l\'image a échoué.';
        return null;
    }

    $tmpName = (string) ($file['tmp_name'] ?? '');
    if ($tmpName === '' || !is_uploaded_file($tmpName)) {
        $errors['cover_image'] = 'Image téléversée invalide.';
        return null;
    }

    $maxSize = 3 * 1024 * 1024;
    if ((int) ($file['size'] ?? 0) > $maxSize) {
        $errors['cover_image'] = 'L\'image ne doit pas dépasser 3 Mo.';
        return null;
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = (string) $finfo->file($tmpName);
    $extensions = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];

    if (!isset($extensions[$mimeType])) {
        $errors['cover_image'] = 'Format image non autorisé. Utilisez JPG, PNG ou WebP.';
        return null;
    }

    $directory = project_path('uploads/realisations');
    if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
        $errors['cover_image'] = 'Impossible de créer le dossier des images.';
        return null;
    }

    $filename = date('Ymd-His') . '-' . bin2hex(random_bytes(6)) . '.' . $extensions[$mimeType];
    $target = $directory . DIRECTORY_SEPARATOR . $filename;

    if (!move_uploaded_file($tmpName, $target)) {
        $errors['cover_image'] = 'Impossible d\'enregistrer l\'image.';
        return null;
    }

    return 'uploads/realisations/' . $filename;
}
