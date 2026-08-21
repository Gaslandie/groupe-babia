<?php

declare(strict_types=1);

require __DIR__ . '/../app/admin/auth.php';
require __DIR__ . '/../app/admin/layout.php';
require __DIR__ . '/../app/repositories/realisations.php';
require __DIR__ . '/../app/admin/realisations_form.php';

admin_require_auth();

$errors = [];
$databaseError = null;
$values = [
    'title' => '',
    'sector' => 'corporate',
    'summary' => '',
    'body' => '',
    'location' => '',
    'realised_at' => '',
    'cover_image' => '',
    'cover_alt' => '',
    'status' => 'draft',
    'is_featured' => '0',
];

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

        if ($errors === []) {
            try {
                create_realisation($validation['data']);
                header('Location: realisations.php?created=1');
                exit;
            } catch (Throwable $exception) {
                $databaseError = $exception->getMessage();
            }
        }
    }
}

admin_shell_start('Ajouter une réalisation');
?>
        <header class="admin-topbar">
          <div>
            <p class="eyebrow">Réalisations</p>
            <h1>Ajouter une réalisation</h1>
            <p class="muted">Créez une activité réalisée, puis publiez-la quand le contenu est validé.</p>
          </div>
        </header>

        <?php if (isset($errors['_form'])): ?>
          <p class="notice"><?= e((string) $errors['_form']) ?></p>
        <?php elseif ($databaseError !== null): ?>
          <p class="notice"><?= e($databaseError) ?></p>
        <?php endif; ?>

        <?php render_realisation_form('realisation-new.php', $values, $errors); ?>
<?php admin_shell_end(); ?>
