<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/repositories/realisations.php';

function public_realisation_date(?string $date): string
{
    if ($date === null || $date === '') {
        return '';
    }

    $timestamp = strtotime($date);
    if ($timestamp === false) {
        return '';
    }

    return date('d/m/Y', $timestamp);
}

function public_realisation_cover(?string $path): string
{
    $path = trim((string) $path);

    return $path === '' ? 'assets/images/agro-industrie.webp' : $path;
}

function public_realisation_excerpt(string $body, int $limit = 220): string
{
    $body = trim(strip_tags($body));
    $length = function_exists('mb_strlen') ? mb_strlen($body) : strlen($body);

    if ($length <= $limit) {
        return $body;
    }

    $excerpt = function_exists('mb_substr') ? mb_substr($body, 0, $limit) : substr($body, 0, $limit);

    return rtrim($excerpt, " \t\n\r\0\x0B.,;:") . '...';
}

function public_fetch_realisations(int $limit): array
{
    if (!database_is_configured()) {
        return ['items' => [], 'available' => false, 'error' => false];
    }

    try {
        return ['items' => list_published_realisations($limit), 'available' => true, 'error' => false];
    } catch (Throwable) {
        return ['items' => [], 'available' => true, 'error' => true];
    }
}

function public_fetch_realisation_by_slug(string $slug): ?array
{
    if (!database_is_configured()) {
        return null;
    }

    try {
        return find_published_realisation_by_slug($slug);
    } catch (Throwable) {
        return null;
    }
}

function public_realisation_url(string $slug): string
{
    return 'realisations/' . rawurlencode($slug);
}

function public_render_realisation_card(array $realisation, array $sectors): void
{
    $sector = (string) ($realisation['sector'] ?? 'corporate');
    $date = public_realisation_date((string) ($realisation['realised_at'] ?? $realisation['published_at'] ?? ''));
    $location = trim((string) ($realisation['location'] ?? ''));
    $cover = public_realisation_cover((string) ($realisation['cover_image'] ?? ''));
    $alt = trim((string) ($realisation['cover_alt'] ?? ''));
    $title = (string) $realisation['title'];
    $slug = (string) $realisation['slug'];
    $url = public_realisation_url($slug);
    $clientPartner = trim((string) ($realisation['client_partner'] ?? ''));
    ?>
              <article class="news-card realisation-card">
                <img src="<?= e($cover) ?>" alt="<?= e($alt) ?>" width="720" height="460" loading="lazy" decoding="async">
                <div>
                  <small><?= e($sectors[$sector] ?? 'Groupe') ?></small>
                  <h3><a href="<?= e($url) ?>"><?= e($title) ?></a></h3>
                  <?php if ($date !== '' || $location !== ''): ?>
                    <p class="realisation-meta">
                      <?php if ($date !== ''): ?><span><?= e($date) ?></span><?php endif; ?>
                      <?php if ($location !== ''): ?><span><?= e($location) ?></span><?php endif; ?>
                    </p>
                  <?php endif; ?>
                  <?php if ($clientPartner !== ''): ?>
                    <p class="realisation-client">Client / partenaire : <?= e($clientPartner) ?></p>
                  <?php endif; ?>
                  <p><?= e((string) $realisation['summary']) ?></p>
                  <a class="button button-ghost" href="<?= e($url) ?>">Voir le détail</a>
                </div>
              </article>
<?php
}

function public_render_realisations_grid(array $items): void
{
    $sectors = realisation_sectors();
    ?>
          <div class="news-grid realisations-grid">
            <?php foreach ($items as $realisation): ?>
              <?php public_render_realisation_card($realisation, $sectors); ?>
            <?php endforeach; ?>
          </div>
<?php
}
