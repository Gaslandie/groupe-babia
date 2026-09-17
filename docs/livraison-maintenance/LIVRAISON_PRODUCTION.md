# Livraison production

## Reouverture du 2026-09-13

- Demande utilisateur : retirer la maintenance pour permettre au client de voir son site.
- Comparaison technique verifiee le 2026-09-13 : la [documentation Apache 2.4](https://httpd.apache.org/docs/2.4/rewrite/flags.html#flag_end) confirme que `[END]` arrete les reecritures dans `.htaccess`. Le [guide Google Search Central sur les interruptions](https://developers.google.com/search/blog/2011/01/how-to-deal-with-planned-site-downtime) reserve le statut 503 a une indisponibilite temporaire. Ces references restent pertinentes pour le mecanisme existant ; aucune adaptation graphique n'est necessaire.
- Application au projet : retirer uniquement le bloc qui envoie les pages publiques vers `maintenance.php`, puis verifier le retour des pages normales en 200.
- Sauvegarde avant intervention : `/tmp/babia-reopen-20260913/backup/.htaccess`. Identite du repertoire distant confirmee par comparaison exacte de `.htaccess` et `index.php` avec les fichiers locaux avant modification.
- Controle local : `php build.php --with-admin`, `php scripts/verify-build.php`, `node --check assets/js/main.js` reussis. Difference verifiee : seul le bloc maintenance est retire.

- Niveau atteint : livre. `.htaccess` envoye par FTPS puis relu, identique au fichier valide. Aucun autre fichier publie.
- Verification production : 12 controles reussis. Accueil FR/EN, catalogue FR/EN et contact FR/EN en 200 ; ancienne URL catalogue redirige correctement ; login en 200 ; dossiers techniques en 403 ; URL inconnue en 404. Les contacts necessitent le cookie antirobot documente ci-dessous pour curl.
- Fichiers touches : `.htaccess`, `docs/PROJECT_CONTEXT.md`, `docs/WORKLOG.md`, ce rapport ; `dist/` regenere en local.
- Limites : aucun navigateur disponible pour verifier de nouveau le rendu mobile et ordinateur ; aucun message de test envoye.
- Prochaine etape : le client peut consulter https://www.groupebabia.com/ ou https://www.groupebabia.com/en/.
- Questions de suivi, sans blocage de cette livraison : qui regroupe les retours du client ? Quelle date vise-t-on pour ses retours ? Quelles pages souhaite-t-il verifier en premier ?

## Maintenance du 2026-09-05

- Activation demandee par l'utilisateur : page de finalisation des travaux, invitation a revenir plus tard, FR et EN.
- Livraison FTPS limitee a `maintenance.php`, puis `.htaccess` (activation en dernier). Les deux fichiers ont ete relus par FTP et compares au build apres envoi. Aucune suppression distante.
- Le repertoire du compte FTP a ete confirme par comparaison exacte du logo et de `index.php` avec le projet avant toute ecriture.
- Sauvegarde avant activation : `/tmp/babia-maintenance/backup/.htaccess` ; le fichier distant etait identique au fichier local avant ajout du bloc maintenance.
- Reouverture : supprimer de `.htaccess` les six lignes entre « Maintenance temporaire » et « Fin de la maintenance temporaire » incluses, puis envoyer uniquement `.htaccess` par FTPS. Verifier ensuite `/`, `/en/`, le catalogue et le contact. La page `maintenance.php` peut rester presente sans etre appelee par les pages publiques.
- Le delai `Retry-After` est une indication de nouvelle tentative HTTP, pas une date de reouverture annoncee aux visiteurs.
- Ne pas utiliser le workflow GitHub Actions historique pour rouvrir le site.

## Version

- Projet : Groupe Babia Guinee
- Version : site vitrine statique HTML/CSS/JS
- Date : a renseigner a chaque livraison
- Responsable : equipe web / maintenance

## Pre-check

- Build valide : `php build.php --with-admin`, puis `php scripts/verify-build.php` (aucune ligne autre que `OK`).
- JavaScript verifie : `node --check assets/js/main.js`.
- Liens locaux verifies : commande de controle dans `PLAN_MAINTENANCE.md`.
- Recette validee : accueil, catalogue, contact, menu mobile et footer, en francais et en anglais.
- Sauvegarde effectuee : recuperer par FTP les fichiers qui vont etre ecrases avant de les remplacer.
- Variables d'environnement verifiees : le `.env` vit sur le serveur uniquement. Il n'est pas dans
  le build et ne doit jamais etre efface ni ecrase : il porte les acces MySQL et le mot de passe admin.
- Rollback identifie : revenir au commit Git precedent, rebatir `dist/`, renvoyer ; ou restaurer la
  sauvegarde FTP prise juste avant.

## Deploiement

- Environnement : Bluehost, domaine `https://www.groupebabia.com/`.
- Procedure : `php build.php --with-admin`, puis envoi FTPS du contenu de `dist/` vers la racine du
  compte FTP cloisonne. On ecrase, on n'efface jamais.
- Heure de debut :
- Heure de fin :
- URL / artefact : https://www.groupebabia.com/

### Ne pas lancer le workflow GitHub Actions en l'etat

`.github/workflows/deploy.yml` date de l'epoque ou le site etait purement statique. Il envoie la
racine du depot en excluant `*.php` et `app/**`, et il synchronise les suppressions via
`.ftp-deploy-sync-state.json`. Or les pages publiques sont desormais servies par PHP et `app/` est
requis a l'execution : le lancer supprimerait du serveur les points d'entree PHP, `app/`, `database/`
et `espace-gb/`, donc casserait le site en ligne. A corriger (envoyer `dist/`, revoir la liste
d'exclusion) avant toute reactivation.

### Verification apres envoi

Les pages contact repondent `409` a `curl` : l'hebergeur y applique un challenge anti-robot qui pose
un cookie `humans_*` en JavaScript. Ce n'est pas une panne. Pour controler ces deux pages en ligne,
rejouer la requete avec `curl -b "humans_21909=1"`.

## Post-check

- Page / app accessible :
- Parcours principal OK : menu, catalogue, selection produit, contact, WhatsApp.
- Logs critiques OK : console navigateur sans erreur bloquante.
- Retours client :

## Rollback

- Condition de rollback : page inaccessible, navigation bloquee, erreur formulaire, mauvaise information client.
- Procedure : restaurer le commit stable precedent puis pousser.
- Responsable : equipe web / maintenance.
