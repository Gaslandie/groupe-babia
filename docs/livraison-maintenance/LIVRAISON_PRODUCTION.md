# Livraison production

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
