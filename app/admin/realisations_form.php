<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/helpers.php';
require_once __DIR__ . '/auth.php';

function realisation_form_value(array $values, string $key): string
{
    return (string) ($values[$key] ?? '');
}

function realisation_form_error(array $errors, string $key): void
{
    if (!isset($errors[$key])) {
        return;
    }
    ?>
    <p class="field-error"><?= e((string) $errors[$key]) ?></p>
<?php
}

function render_realisation_form(string $action, array $values, array $errors = []): void
{
    $sectors = realisation_sectors();
    $statuses = realisation_statuses();
    ?>
    <form class="panel" method="post" action="<?= e($action) ?>">
      <?= admin_csrf_field() ?>
      <div class="form-grid">
        <label class="field-full">
          Titre
          <input name="title" type="text" maxlength="180" value="<?= e(realisation_form_value($values, 'title')) ?>" required>
        </label>
        <?php realisation_form_error($errors, 'title'); ?>

        <label>
          Secteur
          <select name="sector">
            <?php foreach ($sectors as $value => $label): ?>
              <option value="<?= e($value) ?>" <?= realisation_form_value($values, 'sector') === $value ? 'selected' : '' ?>><?= e($label) ?></option>
            <?php endforeach; ?>
          </select>
        </label>
        <?php realisation_form_error($errors, 'sector'); ?>

        <label>
          Statut
          <select name="status">
            <?php foreach ($statuses as $value => $label): ?>
              <option value="<?= e($value) ?>" <?= realisation_form_value($values, 'status') === $value ? 'selected' : '' ?>><?= e($label) ?></option>
            <?php endforeach; ?>
          </select>
        </label>
        <?php realisation_form_error($errors, 'status'); ?>

        <label class="field-full">
          Résumé
          <input name="summary" type="text" maxlength="320" value="<?= e(realisation_form_value($values, 'summary')) ?>" required>
        </label>
        <?php realisation_form_error($errors, 'summary'); ?>

        <label>
          Localisation
          <input name="location" type="text" maxlength="160" value="<?= e(realisation_form_value($values, 'location')) ?>" placeholder="Conakry, Guinée...">
        </label>

        <label>
          Date de réalisation
          <input name="realised_at" type="date" value="<?= e(realisation_form_value($values, 'realised_at')) ?>">
        </label>
        <?php realisation_form_error($errors, 'realised_at'); ?>

        <label>
          Image de couverture
          <input name="cover_image" type="text" value="<?= e(realisation_form_value($values, 'cover_image')) ?>" placeholder="assets/images/nom-image.webp">
        </label>

        <label>
          Texte alternatif image
          <input name="cover_alt" type="text" value="<?= e(realisation_form_value($values, 'cover_alt')) ?>">
        </label>

        <label class="field-full">
          Contenu
          <textarea name="body" required><?= e(realisation_form_value($values, 'body')) ?></textarea>
        </label>
        <?php realisation_form_error($errors, 'body'); ?>

        <label class="field-full">
          <span><input name="is_featured" type="checkbox" value="1" <?= realisation_form_value($values, 'is_featured') === '1' ? 'checked' : '' ?>> Mettre en avant</span>
        </label>
      </div>
      <div class="button-row">
        <button class="button" type="submit">Enregistrer</button>
        <a class="button secondary" href="realisations.php">Annuler</a>
      </div>
    </form>
<?php
}
