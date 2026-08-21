<?php

declare(strict_types=1);

require __DIR__ . '/../app/admin/auth.php';
require __DIR__ . '/../app/admin/layout.php';

if (admin_is_authenticated()) {
    header('Location: index.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if (admin_attempt_login($username, $password)) {
        header('Location: index.php');
        exit;
    }

    $error = admin_credentials_configured()
        ? 'Identifiants incorrects.'
        : 'Administration non configurée. Renseigner ADMIN_USERNAME et ADMIN_PASSWORD_HASH dans .env.';
}

admin_header('Connexion');
?>
    <main class="login-page">
      <form class="login-card" method="post" action="login.php">
        <p class="eyebrow">Administration</p>
        <h1>Connexion</h1>
        <p class="muted">Accès réservé à l'équipe autorisée de Groupe Babia.</p>
        <?php if ($error !== null): ?>
          <p class="notice"><?= e($error) ?></p>
        <?php endif; ?>
        <label>
          Identifiant
          <input name="username" type="text" autocomplete="username" required>
        </label>
        <label>
          Mot de passe
          <input name="password" type="password" autocomplete="current-password" required>
        </label>
        <button class="button" type="submit">Se connecter</button>
      </form>
    </main>
<?php admin_footer(); ?>
