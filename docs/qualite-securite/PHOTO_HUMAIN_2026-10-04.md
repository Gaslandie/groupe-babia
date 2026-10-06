# Photo « L’humain d’abord » — 4 octobre 2026

La photo choisie par Gassama remplace celle du bloc Vision & valeurs, en français et en anglais. Le cadrage complet conserve les deux visages. La capture d’origine est conservée intacte ; la version WebP passe de 1 397 643 à 176 392 octets, soit environ 87 % de moins.

## Fichiers

- Deux fragments `app/pages/fr/vision-valeurs.html` et `app/pages/en/vision-values.html`.
- Trois sorties générées : `vision-valeurs.html`, `en/vision-values.html`, `en/vision-values.php`.
- Nouvelle image : `assets/images/humain-agriculteurs-20261004.webp`.
- Contexte, journal et comparaison de références mis à jour.

La hauteur automatique s’applique uniquement à cette photo. Aucune modification de la feuille CSS commune. Comparaison avec HEAD : remplacer uniquement la ligne `<img>` restitue chacun des cinq fichiers de page initial à l’identique. Les titres, chiffres et textes sont donc conservés.

## Vérifications réelles

- Pillow : décodage de l’original et du WebP validé, dimensions 1080 × 601.
- `php scripts/generate-fr-pages.php`, `php scripts/generate-en-pages.php`, `php build.php --with-php`, `php scripts/verify-build.php`, `git diff --check` : réussis.
- Hash SHA-256 de l’image source et de celle du build identique.
- `node /tmp/babia-photo-humain-check.cjs` : huit cas Chrome headless locaux, FR/EN à 320, 390, 768 et 1440 px. Pages HTTP 200, nouvelle photo chargée, ratio complet conservé, description accessible présente, aucun débordement horizontal ni erreur JavaScript.
- Captures FR ordinateur et téléphone consultées visuellement : deux personnes visibles, texte lisible. Captures dans `/tmp/babia-humain-{fr,en}-{1440,390}.png`, résultats dans `/tmp/babia-photo-humain-results.json`.

## Sécurité et limites

Le fichier reçu est une image décodée et réencodée en WebP, sans copie des métadonnées de la capture. Aucun secret visible sur la capture. L’image est locale au site et utilise un nouveau nom pour éviter le cache de l’ancienne photo. Les protections serveur, sessions, droits, formulaires et données privées ne sont pas modifiés. Aucun changement de dépendances.

Les premiers tests utilisent le serveur PHP local ; ils ne prouvent pas les protections Apache de production. Aucun test de changement de compte ou de révocation : aucun parcours connecté n’est touché. Aucun commit ni push Git ; la publication demandée ensuite par Gassama est détaillée ci-dessous.

## Publication demandée et réalisée

Le 4 octobre 2026, six fichiers publiés par FTPS avec certificat vérifié et TLS exigé : nouvelle photo, deux fragments et trois sorties. La destination est reconnue par comparaison exacte de `.htaccess`, `index.php` et du logo. Avant écriture, les cinq fichiers distants existants correspondaient à HEAD et ont été sauvegardés. Les six fichiers envoyés ont été relus identiques à leurs empreintes SHA-256. Aucun fichier supprimé, aucun secret, fichier admin ou donnée de base envoyé.

Sauvegarde de session : `/tmp/babia-humain-ftps-20261004-barsokdo/backup`. Archive durable privée, hors Git : `../.livraisons/20261004-photo-humain-avant-publication.tar.gz`. Les cinq contenus archivés ont été vérifiés par hash. Retour arrière : restaurer ces cinq fichiers par FTPS vérifié ; la nouvelle image peut rester inutilisée. Fichier privé temporaire cURL supprimé après transfert. Permissions de la configuration locale des identifiants resserrées à 0600.

`python3 /tmp/babia-humain-production-check.py` : douze contrôles HTTP production réussis. Pages FR/EN et anciennes URL HTML accessibles, photo identique au build en `image/webp`. Accès directs à `.env`, configuration et fragment `app/`, base et documentation refusés en 403/404. Messages admin sans connexion renvoyés au login. Résultats : `/tmp/babia-humain-http-results.json`.

`BABIA_PHOTO_BASE=https://www.groupebabia.com node /tmp/babia-photo-humain-check.cjs` : huit cas Chrome headless production FR/EN, 320/390/768/1440 px, réussis. Photo chargée, cadrage intégral, description accessible, aucun débordement ni exception JavaScript. Captures production FR ordinateur et téléphone consultées visuellement. Aucun test sur téléphone physique ni Safari. Niveau atteint : publié et vérifié sur le site public. Prochaine étape : retour visuel du client.

## Enregistrement Git — 6 octobre 2026

À la demande de Gassama de commiter, pousser et déployer les changements, cette photo déjà en ligne est enregistrée dans le commit `09ad228`, poussé sur `main`. Ses six fichiers sont identiques à la production et n'ont pas été renvoyés. Les pages Vision & valeurs FR/EN répondent 200 et la photo publique reste identique au build. Voir `LIVRAISON_PHOTOS_2026-10-06.md`.

## Questions de suivi du projet

1. Quand publier cette photo sur le site public ?
2. D’autres photos des équipes sont-elles prévues pour les prochains remplacements ?
3. Qui validera le rendu final côté client ?

Ces questions sont des points de suivi ; elles ne bloquent pas la modification locale demandée.
