<?php

declare(strict_types=1);

require __DIR__ . '/../app/admin/auth.php';
require __DIR__ . '/../app/admin/layout.php';
require __DIR__ . '/../app/repositories/realisations.php';

admin_require_auth();

$items = [];
$databaseError = null;
$sectors = realisation_sectors();
$statuses = realisation_statuses();

if (database_is_configured()) {
    try {
        $items = list_realisations(null, 50);
    } catch (Throwable $exception) {
        $databaseError = $exception->getMessage();
    }
}

admin_shell_start('Réalisations');
?>
        <header class="admin-topbar">
          <div>
            <p class="eyebrow">Réalisations</p>
            <h1>Activités réalisées par l'entreprise</h1>
            <p class="muted">Cette liste prépare le futur CRUD : ajout, modification, publication et mise en avant.</p>
          </div>
          <a class="button" href="#">Ajouter bientôt</a>
        </header>

        <?php if (!database_is_configured()): ?>
          <p class="notice">MySQL n'est pas encore configuré. Le module sera activé après création de la base et application de la migration.</p>
        <?php elseif ($databaseError !== null): ?>
          <p class="notice"><?= e($databaseError) ?></p>
        <?php elseif ($items === []): ?>
          <p class="notice">Aucune réalisation enregistrée pour le moment.</p>
        <?php else: ?>
          <table>
            <thead>
              <tr>
                <th>Titre</th>
                <th>Secteur</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Mise en avant</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($items as $item): ?>
                <tr>
                  <td>
                    <strong><?= e((string) $item['title']) ?></strong>
                    <div class="muted"><?= e((string) $item['summary']) ?></div>
                  </td>
                  <td><?= e($sectors[(string) $item['sector']] ?? (string) $item['sector']) ?></td>
                  <td><?= e($statuses[(string) $item['status']] ?? (string) $item['status']) ?></td>
                  <td><?= e((string) ($item['realised_at'] ?? $item['published_at'] ?? '-')) ?></td>
                  <td><?= ((int) $item['is_featured']) === 1 ? 'Oui' : 'Non' ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
<?php admin_shell_end(); ?>
