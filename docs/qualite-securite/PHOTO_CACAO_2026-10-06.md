# Photo cacao — 6 octobre 2026

La photo envoyée par Gassama remplace celle des fèves de cacao sur l'accueil, les secteurs et le catalogue, en français et en anglais. Original intact. Nouvelle URL pour éviter l'ancienne photo en cache. Niveau atteint : intégré, construit et testé localement ; pas publié, aucun commit ni push.

## Fichiers touchés

- Nouveau visuel `assets/images/agro-cacao-20261006.webp` : 1065 × 1280 pixels, 200 392 octets, contre 239 797 pour le JPEG fourni.
- Six fragments : `app/pages/fr/{index,secteurs,catalogue}.html` et `app/pages/en/{index,sectors,catalog}.html`.
- Neuf sorties régénérées : `{index,secteurs,catalogue}.html` et `en/{index,sectors,catalog}.{html,php}`.
- Contexte, journal, benchmark et ce rapport. Modifications préexistantes de Vision & valeurs conservées.

## Vérifications réelles

- `php scripts/generate-fr-pages.php` et `php scripts/generate-en-pages.php` : pages régénérées.
- `php build.php --with-php` et `php scripts/verify-build.php` : réussis, 61 fichiers contrôlés par le vérificateur.
- Contrôle Python du décodage JPEG/WebP, dimensions, absence d'EXIF et identité SHA-256 de la nouvelle image dans `dist/` : réussi.
- Contrôle ciblé des 15 références produit : nouvelle URL et dimensions exactes. Le premier contrôle trop large incluait le bandeau décoratif des mentions légales ; périmètre corrigé sans modifier ce bandeau.
- `node /tmp/babia-cocoa-check.cjs` : 12 cas Chrome locaux, six pages PHP FR/EN à 390 et 1440 pixels. HTTP 200, image décodée et visible dans la fenêtre, description présente, pas de débordement horizontal ni exception JavaScript. URL de demande de prix et de WhatsApp conservées ; volets produit ouverts et refermés par le script.
- Captures `/tmp/babia-cocoa-390.png` et `/tmp/babia-cocoa-1440.png` consultées : nouvelle photo affichée dans la carte « Agricultural commodity / Cocoa beans ». Le cadrage des cartes masque le pictogramme d'appareil photo présent en bas de l'original. Premier jeu de captures refait après attente des animations et défilement instantané pour montrer la photo dans la fenêtre.

## Sécurité et limites

Comparaison préalable : [benchmark photo cacao](../design-ux/BENCHMARK_PHOTO_CACAO_2026-10-06.md), sources W3C et web.dev relues le 6 octobre 2026. Le JPEG est décodé puis réencodé en fichier raster sans EXIF. Aucun accès aux secrets, aucun changement aux sessions, droits, données privées, formulaires ou dépendances. Aucun test d'autorisation serveur ou de compte nécessaire à ce changement d'image ; ces mécanismes ne sont pas modifiés. Aucune promesse de sécurité absolue.

Les tests portent sur Chrome local, sans téléphone physique ni Safari. Pas de vérification en production ni d'envoi réel de demande de prix. La prochaine étape est la publication des seuls fichiers nécessaires, avec sauvegarde préalable et contrôles publics/protégés.

## Trois questions de suivi

1. Qui valide le rendu côté client ?
2. Quel créneau retenir pour la publication ?
3. D'autres photos produit seront-elles fournies ?
