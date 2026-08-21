<?php

declare(strict_types=1);

require __DIR__ . '/../app/admin/auth.php';
require __DIR__ . '/../app/admin/layout.php';
require __DIR__ . '/../app/repositories/realisations.php';

admin_require_auth();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$item = null;
$databaseError = null;

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!admin_verify_csrf()) {
        $databaseError = 'Session expirée. Réessayez.';
    } elseif (!database_is_configured()) {
        $databaseError = 'MySQL n\'est pas encore configuré.';
    } else {
        try {
            delete_realisation((int) $id);
            header('Location: realisations.php?deleted=1');
            exit;
        } catch (Throwable $exception) {
            $databaseError = $exception->getMessage();
        }
    }
}

admin_shell_start('Supprimer une réalisation');
?>
        <header class="admin-topbar">
          <div>
            <p class="eyebrow">Réalisations</p>
            <h1>Supprimer une réalisation</h1>
            <p class="muted">Cette action retire définitivement l'entrée de la base.</p>
          </div>
        </header>

        <?php if (!database_is_configured()): ?>
          <p class="notice">MySQL n'est pas encore configuré.</p>
        <?php elseif ($databaseError !== null): ?>
          <p class="notice"><?= e($databaseError) ?></p>
        <?php elseif ($item === null): ?>
          <p class="notice">Réalisation introuvable.</p>
        <?php else: ?>
          <section class="panel">
            <h2><?= e((string) $item['title']) ?></h2>
            <p class="muted"><?= e((string) $item['summary']) ?></p>
            <form class="button-row" method="post" action="realisation-delete.php?id=<?= e((string) $id) ?>">
              <?= admin_csrf_field() ?>
              <button class="button danger" type="submit">Confirmer la suppression</button>
              <a class="button secondary" href="realisations.php">Annuler</a>
            </form>
          </section>
        <?php endif; ?>
<?php admin_shell_end(); ?>
