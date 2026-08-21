<?php

declare(strict_types=1);

require __DIR__ . '/../app/admin/auth.php';
require __DIR__ . '/../app/admin/layout.php';
require __DIR__ . '/../app/repositories/realisations.php';
require __DIR__ . '/../app/repositories/contact_messages.php';

admin_require_auth();

$counts = null;
$messageCounts = null;
$databaseError = null;

if (database_is_configured()) {
    try {
        $counts = count_realisations_by_status();
        $messageCounts = count_contact_messages_by_status();
    } catch (Throwable $exception) {
        $databaseError = $exception->getMessage();
    }
}

admin_shell_start('Tableau de bord');
?>
        <header class="admin-topbar">
          <div>
            <p class="eyebrow">Tableau de bord</p>
            <h1>Activités et contacts</h1>
            <p class="muted">Suivez les réalisations publiées et les demandes reçues depuis le site.</p>
          </div>
          <div class="button-row">
            <a class="button" href="realisations.php">Voir les réalisations</a>
            <a class="button secondary" href="messages.php">Voir les messages</a>
          </div>
        </header>

        <?php if (!database_is_configured()): ?>
          <p class="notice">MySQL n'est pas encore configuré. Copier `.env.example` en `.env`, renseigner la base, puis appliquer `database/migrations/001_create_realisations.sql`.</p>
        <?php elseif ($databaseError !== null): ?>
          <p class="notice"><?= e($databaseError) ?></p>
        <?php endif; ?>

        <section class="grid" aria-label="Statistiques réalisations">
          <article class="panel metric"><strong><?= e((string) ($counts['published'] ?? 0)) ?></strong><span>Publiées</span></article>
          <article class="panel metric"><strong><?= e((string) ($counts['draft'] ?? 0)) ?></strong><span>Brouillons</span></article>
          <article class="panel metric"><strong><?= e((string) ($messageCounts['new'] ?? 0)) ?></strong><span>Nouveaux messages</span></article>
        </section>
<?php admin_shell_end(); ?>
