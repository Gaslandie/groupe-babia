<?php

declare(strict_types=1);

require __DIR__ . '/../app/admin/auth.php';
require __DIR__ . '/../app/admin/layout.php';
require __DIR__ . '/../app/repositories/contact_messages.php';

admin_require_auth();

$items = [];
$databaseError = null;
$statuses = contact_message_statuses();
$requestedStatus = isset($_GET['status']) ? (string) $_GET['status'] : null;
$statusFilter = $requestedStatus !== null && array_key_exists($requestedStatus, $statuses) ? $requestedStatus : null;
$purged = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && database_is_configured()) {
    $id = (int) ($_POST['id'] ?? 0);
    $action = (string) ($_POST['action'] ?? 'status');
    try {
        if ($action === 'archive') {
            archive_contact_message($id);
        } else {
            $status = (string) ($_POST['status'] ?? '');
            update_contact_message_status($id, $status);
        }
        header('Location: messages.php?updated=1');
        exit;
    } catch (Throwable $exception) {
        $databaseError = $exception->getMessage();
    }
}

if (database_is_configured()) {
    try {
        $purged = purge_old_archived_contact_messages(30);
        $items = list_contact_messages($statusFilter, 100);
    } catch (Throwable $exception) {
        $databaseError = $exception->getMessage();
    }
}

admin_shell_start('Messages');
?>
        <header class="admin-topbar">
          <div>
            <p class="eyebrow">Messages</p>
            <h1>Demandes reçues depuis le site</h1>
            <p class="muted">Consultez les demandes de devis, contacts commerciaux et premiers échanges transmis par le formulaire.</p>
          </div>
          <a class="button secondary" href="../contact.php">Voir le formulaire</a>
        </header>

        <?php if (!database_is_configured()): ?>
          <p class="notice">MySQL n'est pas encore configuré. Les messages seront disponibles après configuration de la base.</p>
        <?php elseif ($databaseError !== null): ?>
          <p class="notice"><?= e($databaseError) ?></p>
        <?php elseif (isset($_GET['updated'])): ?>
          <p class="notice success">Statut du message mis à jour.</p>
        <?php endif; ?>
        <?php if ($purged > 0): ?>
          <p class="notice success"><?= e((string) $purged) ?> message<?= $purged > 1 ? 's' : '' ?> archivé<?= $purged > 1 ? 's' : '' ?> depuis plus de 30 jours supprimé<?= $purged > 1 ? 's' : '' ?> définitivement.</p>
        <?php endif; ?>

        <div class="button-row" style="margin-bottom: 18px;">
          <a class="button secondary" href="messages.php">Tous</a>
          <?php foreach ($statuses as $key => $label): ?>
            <a class="button secondary" href="messages.php?status=<?= e(rawurlencode($key)) ?>"><?= e($label) ?></a>
          <?php endforeach; ?>
        </div>

        <?php if (database_is_configured() && $databaseError === null && $items === []): ?>
          <p class="notice">Aucun message reçu pour le moment.</p>
        <?php elseif ($items !== []): ?>
          <table>
            <thead>
              <tr>
                <th>Contact</th>
                <th>Besoin</th>
                <th>Message</th>
                <th>Reçu le</th>
                <th>Statut</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($items as $item): ?>
                <tr>
                  <td>
                    <strong><?= e((string) $item['name']) ?></strong>
                    <div class="muted"><?= e((string) $item['company']) ?></div>
                    <div><a href="mailto:<?= e((string) $item['email']) ?>"><?= e((string) $item['email']) ?></a></div>
                    <?php if (!empty($item['phone'])): ?>
                      <div><a href="tel:<?= e((string) $item['phone']) ?>"><?= e((string) $item['phone']) ?></a></div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <strong><?= e((string) $item['need']) ?></strong>
                    <?php if (!empty($item['destination'])): ?>
                      <div class="muted">Destination : <?= e((string) $item['destination']) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($item['timeline'])): ?>
                      <div class="muted">Calendrier : <?= e((string) $item['timeline']) ?></div>
                    <?php endif; ?>
                  </td>
                  <td><?= nl2br(e((string) $item['message'])) ?></td>
                  <td><?= e((string) $item['created_at']) ?></td>
                  <td>
                    <form class="inline-form" method="post" action="messages.php">
                      <input type="hidden" name="action" value="status">
                      <input type="hidden" name="id" value="<?= e((string) $item['id']) ?>">
                      <select name="status" aria-label="Statut du message">
                        <?php foreach ($statuses as $key => $label): ?>
                          <option value="<?= e($key) ?>" <?= (string) $item['status'] === $key ? 'selected' : '' ?>><?= e($label) ?></option>
                        <?php endforeach; ?>
                      </select>
                      <button class="button secondary" type="submit" style="margin-top: 8px;">Mettre à jour</button>
                    </form>
                    <?php if ((string) $item['status'] !== 'archived'): ?>
                      <form class="inline-form" method="post" action="messages.php">
                        <input type="hidden" name="action" value="archive">
                        <input type="hidden" name="id" value="<?= e((string) $item['id']) ?>">
                        <button class="button danger" type="submit" style="margin-top: 8px;">Supprimer</button>
                      </form>
                    <?php elseif (!empty($item['archived_at'])): ?>
                      <div class="muted" style="margin-top: 8px;">Suppression définitive après 30 jours.</div>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
<?php admin_shell_end(); ?>
