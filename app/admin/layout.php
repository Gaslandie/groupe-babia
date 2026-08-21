<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/helpers.php';

function admin_header(string $title): void
{
    ?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title><?= e($title) ?> | Administration Groupe Babia</title>
    <style>
      :root { --ink: #0b1914; --muted: #596660; --line: rgba(11,25,20,.14); --forest: #064b35; --gold: #d4a63a; --paper: #f3f5f2; --surface: #fff; }
      * { box-sizing: border-box; }
      body { margin: 0; background: var(--paper); color: var(--ink); font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; line-height: 1.5; }
      a { color: inherit; }
      .admin-shell { min-height: 100vh; display: grid; grid-template-columns: 260px 1fr; }
      .admin-sidebar { padding: 28px; color: #fff; background: var(--ink); }
      .admin-sidebar strong { display: block; font-size: 1.1rem; }
      .admin-sidebar span { display: block; margin-top: 4px; color: rgba(255,255,255,.68); font-size: .9rem; }
      .admin-nav { display: grid; gap: 8px; margin-top: 34px; }
      .admin-nav a { padding: 10px 12px; border-radius: 8px; color: rgba(255,255,255,.82); text-decoration: none; }
      .admin-nav a:hover { background: rgba(255,255,255,.08); color: #fff; }
      .admin-main { padding: clamp(24px, 4vw, 48px); }
      .admin-topbar { display: flex; align-items: start; justify-content: space-between; gap: 20px; margin-bottom: 28px; }
      h1 { margin: 0; font-size: clamp(1.8rem, 3vw, 2.7rem); line-height: 1.05; }
      .eyebrow { margin: 0 0 8px; color: var(--forest); font-size: .78rem; font-weight: 800; text-transform: uppercase; }
      .panel { padding: 24px; background: var(--surface); border: 1px solid var(--line); border-radius: 8px; }
      .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
      .metric strong { display: block; color: var(--forest); font-size: 2.4rem; line-height: 1; }
      .metric span { color: var(--muted); }
      .notice { padding: 16px 18px; border: 1px solid rgba(173,79,53,.28); border-radius: 8px; background: #fff8f5; color: #703322; }
      .notice.success { border-color: rgba(6,75,53,.22); background: #f1faf5; color: var(--forest); }
      .button { display: inline-flex; min-height: 42px; align-items: center; justify-content: center; padding: 0 16px; border: 1px solid var(--forest); border-radius: 8px; color: #fff; background: var(--forest); font-weight: 700; text-decoration: none; }
      .button.secondary { color: var(--forest); background: #fff; }
      .button.danger { border-color: #ad4f35; background: #ad4f35; }
      .button-row { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
      table { width: 100%; border-collapse: collapse; background: var(--surface); border: 1px solid var(--line); }
      th, td { padding: 12px 14px; border-bottom: 1px solid var(--line); text-align: left; vertical-align: top; }
      th { color: var(--forest); font-size: .78rem; text-transform: uppercase; }
      .muted { color: var(--muted); }
      .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
      .field-full { grid-column: 1 / -1; }
      .login-page { min-height: 100vh; display: grid; place-items: center; padding: 24px; }
      .login-card { width: min(420px, 100%); padding: 28px; background: #fff; border: 1px solid var(--line); border-radius: 8px; box-shadow: 0 20px 60px rgba(11,25,20,.12); }
      label { display: grid; gap: 8px; margin-bottom: 16px; color: var(--forest); font-weight: 750; }
      input, select, textarea { width: 100%; min-height: 44px; padding: 0 12px; border: 1px solid var(--line); border-radius: 8px; font: inherit; background: #fff; }
      input[type="checkbox"] { width: auto; min-height: 0; margin-right: 8px; }
      textarea { min-height: 180px; padding: 12px; resize: vertical; }
      .field-error { margin: -8px 0 14px; color: #ad4f35; font-size: .9rem; font-weight: 700; }
      .actions-cell { white-space: nowrap; }
      .inline-form { display: inline; }
      @media (max-width: 800px) { .admin-shell { grid-template-columns: 1fr; } .admin-sidebar { position: static; } .grid, .form-grid { grid-template-columns: 1fr; } .field-full { grid-column: auto; } .admin-topbar { display: grid; } }
    </style>
  </head>
  <body>
<?php
}

function admin_footer(): void
{
    ?>
  </body>
</html>
<?php
}

function admin_shell_start(string $title): void
{
    admin_header($title);
    ?>
    <div class="admin-shell">
      <aside class="admin-sidebar">
        <strong>Groupe Babia</strong>
        <span>Back office</span>
        <nav class="admin-nav" aria-label="Navigation administration">
          <a href="index.php">Tableau de bord</a>
          <a href="realisations.php">Réalisations</a>
          <a href="logout.php">Déconnexion</a>
        </nav>
      </aside>
      <main class="admin-main">
<?php
}

function admin_shell_end(): void
{
    ?>
      </main>
    </div>
<?php
    admin_footer();
}
