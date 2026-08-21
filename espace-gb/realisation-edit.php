<?php

declare(strict_types=1);

require __DIR__ . '/../app/admin/auth.php';
require __DIR__ . '/../app/admin/layout.php';
require __DIR__ . '/../app/repositories/realisations.php';
require __DIR__ . '/../app/admin/realisations_form.php';
require __DIR__ . '/../app/admin/uploads.php';

admin_require_auth();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$errors = [];
$databaseError = null;
$item = null;

if (!$id) {
    header('Location: realisations.php');
    exit;
}

if (database_is_configured()) {
    try {
        $item = find_realisation((int) $id);
    } catch (Throwable $exception) {
        $databaseError = $exception->getMessage();
    }
}

if ($item === null && $databaseError === null && database_is_configured()) {
    header('Location: realisations.php?missing=1');
    exit;
}

$values = $item ?? [
    'title' => '',
    'sector' => 'corporate',
    'summary' => '',
    'body' => '',
    'client_partner' => '',
    'location' => '',
    'realised_at' => '',
    'cover_image' => '',
    'cover_alt' => '',
    'status' => 'draft',
    'is_featured' => 0,
];
$values['is_featured'] = ((int) ($values['is_featured'] ?? 0)) === 1 ? '1' : '0';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = array_merge($values, $_POST);

    if (!admin_verify_csrf()) {
        $errors['_form'] = 'Session expirée. Réessayez.';
    } elseif (!database_is_configured()) {
        $errors['_form'] = 'MySQL n\'est pas encore configuré.';
    } else {
        $validation = realisation_validate($_POST);
        $errors = $validation['errors'];
        $values = array_merge($values, $validation['data']);
        $values['is_featured'] = (string) $validation['data']['is_featured'];

        if ($errors === []) {
            $uploadPath = admin_handle_realisation_upload('cover_upload', $errors);
            if ($uploadPath !== null) {
                $validation['data']['cover_image'] = $uploadPath;
                $values['cover_image'] = $uploadPath;
            }
        }

        if ($errors === []) {
            try {
                update_realisation((int) $id, $validation['data']);
                header('Location: realisations.php?updated=1');
                exit;
            } catch (Throwable $exception) {
                $databaseError = $exception->getMessage();
            }
        }
    }
}

admin_shell_start('Modifier une réalisation');
?>
        <header class="admin-topbar">
          <div>
            <p class="eyebrow">Réalisations</p>
            <h1>Modifier une réalisation</h1>
            <p class="muted">Mettez à jour les informations avant publication ou archivage.</p>
          </div>
        </header>

        <?php if (!database_is_configured()): ?>
          <p class="notice">MySQL n'est pas encore configuré.</p>
        <?php elseif (isset($errors['_form'])): ?>
          <p class="notice"><?= e((string) $errors['_form']) ?></p>
        <?php elseif ($databaseError !== null): ?>
          <p class="notice"><?= e($databaseError) ?></p>
        <?php endif; ?>

        <?php render_realisation_form('realisation-edit.php?id=' . (string) $id, $values, $errors); ?>
<?php admin_shell_end(); ?>
