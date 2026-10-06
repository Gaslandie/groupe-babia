# Photo « 01 Agriculture » — 6 octobre 2026

La photo choisie par Gassama remplace celle de la carte Agriculture dans Nos secteurs / Our sectors FR/EN. Le cadrage garde la tête visible. Textes inchangés, original intact. Niveau final : publié le 6 octobre, commit `09ad228` poussé. Livraison, sauvegarde et contrôles production : [rapport commun](LIVRAISON_PHOTOS_2026-10-06.md). Les vérifications ci-dessous décrivent la préparation locale.

## Fichiers touchés

- Nouvelle image `assets/images/agriculture-champ-client-20261006.webp` : 765 × 1020 pixels, 168 282 octets, contre 176 709 pour le JPEG fourni.
- Sources `app/pages/fr/secteurs.html` et `app/pages/en/sectors.html` ; sorties `secteurs.html`, `en/sectors.html` et `en/sectors.php` régénérées.
- Contexte, journal, benchmark et ce rapport. Travaux précédents, dont la photo du cacao, conservés.

## Vérifications réelles

- `php scripts/generate-fr-pages.php` et `php scripts/generate-en-pages.php` : réussis.
- `php build.php --with-php` et `php scripts/verify-build.php` : réussis, 61 fichiers vérifiés.
- Python : JPEG/WebP décodables, dimensions exactes, EXIF vide, copie de l'image dans `dist/` identique par SHA-256. Cinq références Agriculture et conservation de la nouvelle photo cacao vérifiées.
- `node /tmp/babia-agriculture-check.cjs` : huit cas Chrome locaux, deux pages PHP FR/EN à 320, 390, 768 et 1440 pixels. HTTP 200, image visible et décodée, dimensions et description correctes, cadrage 50% 40%, pas de débordement horizontal ni exception JavaScript. Lien agroalimentaire/agri-food conservé.
- Captures `/tmp/babia-agriculture-390.png` et `/tmp/babia-agriculture-1440.png` consultées : agriculteur et tête visibles, carte « 01 Agriculture » avec le texte client. `git diff --check` réussi.

## Sécurité et limites

[Benchmark préalable](../design-ux/BENCHMARK_PHOTO_AGRICULTURE_2026-10-06.md) : références W3C et Google web.dev relues le 6 octobre 2026. Décodage du fichier fourni puis réencodage raster sans métadonnées EXIF. Aucune modification des droits, sessions, secrets, formulaires, données privées, dépendances ou protections serveur. Aucun test de compte ou de droits révoqués effectué : ces mécanismes sont hors du périmètre du changement et restent inchangés.

Vérification locale puis huit cas Chrome production FR/EN à 320, 390, 768 et 1440 pixels réussis ; captures téléphone/ordinateur consultées. Les 20 contrôles HTTP communs à la livraison comprennent les accès publics et refusés. Pas de téléphone physique ni de Safari. Aucun nouvel envoi de formulaire. La photo ne prouve ni l'identité de la personne ni une relation d'emploi avec Babia. Prochaine étape : retour visuel du client.

## Trois questions de suivi

1. Qui valide le rendu côté client ?
2. Quel créneau retenir pour publier les changements ?
3. D'autres photos de secteurs seront-elles fournies ?
