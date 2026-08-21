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
            <p class="muted">Ajoutez, modifiez, publiez ou archivez les activités réalisées par l'entreprise.</p>
          </div>
          <a class="button" href="realisation-new.php">Ajouter une réalisation</a>
        </header>

        <?php if (!database_is_configured()): ?>
          <p class="notice">MySQL n'est pas encore configuré. Le module sera activé après création de la base et application de la migration.</p>
        <?php elseif ($databaseError !== null): ?>
          <p class="notice"><?= e($databaseError) ?></p>
        <?php elseif (isset($_GET['created'])): ?>
          <p class="notice success">Réalisation ajoutée.</p>
        <?php elseif (isset($_GET['updated'])): ?>
          <p class="notice success">Réalisation mise à jour.</p>
        <?php elseif (isset($_GET['deleted'])): ?>
          <p class="notice success">Réalisation supprimée.</p>
        <?php elseif (isset($_GET['missing'])): ?>
          <p class="notice">Réalisation introuvable.</p>
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
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($items as $item): ?>
                <tr>
                  <td>
                    <strong><?= e((string) $item['title']) ?></strong>
                    <div class="muted"><?= e((string) $item['summary']) ?></div>
                    <?php if (!empty($item['client_partner'])): ?>
                      <div class="muted">Client / partenaire : <?= e((string) $item['client_partner']) ?></div>
                    <?php endif; ?>
                  </td>
                  <td><?= e($sectors[(string) $item['sector']] ?? (string) $item['sector']) ?></td>
                  <td><?= e($statuses[(string) $item['status']] ?? (string) $item['status']) ?></td>
                  <td><?= e((string) ($item['realised_at'] ?? $item['published_at'] ?? '-')) ?></td>
                  <td><?= ((int) $item['is_featured']) === 1 ? 'Oui' : 'Non' ?></td>
                  <td class="actions-cell">
                    <div class="button-row">
                      <?php if ((string) $item['status'] === 'published'): ?>
                        <a class="button secondary" href="../realisations/<?= e(rawurlencode((string) $item['slug'])) ?>">Voir</a>
                      <?php endif; ?>
                      <a class="button secondary" href="realisation-edit.php?id=<?= e((string) $item['id']) ?>">Modifier</a>
                      <a class="button danger" href="realisation-delete.php?id=<?= e((string) $item['id']) ?>">Supprimer</a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
<?php admin_shell_end(); ?>
