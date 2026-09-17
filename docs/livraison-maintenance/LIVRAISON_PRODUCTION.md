# Livraison production

## Livraison du 2026-09-17 (2) - correctifs mobile et adresse officielle

- Deux envois FTPS successifs, meme procedure que la livraison precedente : identite du
  repertoire distant verifiee, `.env` exclu, sauvegarde avant ecrasement, aucune suppression,
  ressources avant pages, `.htaccess` en dernier, relecture de chaque fichier apres envoi.
  - Correctifs mobile : **43 / 43 envoyes, 0 echec, 43 / 43 relus identiques**. 43 fichiers
    distants sauvegardes.
  - Adresse officielle : **53 / 53 envoyes, 0 echec, 53 / 53 relus identiques**. 53 fichiers
    distants sauvegardes.
- Commit `c8688f0`, pousse sur `main`.

### Verification en production

- 22 pages publiques FR et EN en **200**, contact inclus avec le cookie `humans_21909=1`.
- Protections inchangees : `/docs/` en **404**, `/app/config.php`, `/database/`, `/uploads/` et
  `/.env` en **403**, `/espace-gb/login.php` en **200**, URL inconnue en **404**.
- Correctifs servis : `height: auto` present sur les vignettes du mur produits, regle
  `.dark-section .product-card h3` presente, `window.scrollTo(0, 0)` present dans `main.js`.
- Adresse : `contact@groupebabia.com` presente sur l'accueil, les deux pages contact, les pages
  legales FR et EN, dans `main.js` et dans les donnees structurees. **`infobabiaguinee@gmail.com`
  ne figure plus nulle part** (0 occurrence sur chacune des pages controlees).
- Version d'assets servie : `20260917-contact-email` pour `styles.css` et `main.js`.
- Les 10 visuels ajoutes repondent 200.

### Reserves ouvertes sur l'adresse

- La boite `contact@groupebabia.com` doit exister chez OVH. Le domaine est en formule MX Plan a
  une seule boite ; un **alias** suffirait et ne consommerait pas cette boite. Non verifiable
  d'ici sans envoyer un message reel.
- Le `.env` du serveur peut porter `CONTACT_RECIPIENT_EMAIL` avec l'ancienne valeur : il
  ecraserait alors la valeur par defaut du code. **Le `.env` distant n'a pas ete touche**, aucune
  modification n'ayant ete demandee ; il porte aussi les acces MySQL et le mot de passe admin.
- Consequence si l'une des deux reserves n'est pas levee : les notifications e-mail partent
  ailleurs ou rebondissent. Les demandes restent enregistrees en base et consultables dans
  `espace-gb/messages.php` : aucune demande n'est perdue.

### Limites

- Aucune verification visuelle en navigateur : elle reste a faire cote utilisateur, sur les
  ecrans qui avaient revele les trois defauts.
- Aucun formulaire soumis, aucune operation en base, aucun message de test envoye.
- Les visuels restent temporaires, a remplacer par les medias du client.
- Rollback : restaurer les fichiers des deux sauvegardes FTP de session, ou revenir au commit
  `ac9b108`, rebatir `dist/` et renvoyer.

## Livraison du 2026-09-17 - produits visibles, contact et allegement

- Demande utilisateur : commit, push et deploiement, apres correction du signalement client
  (« je n'ai pas vu cacao, je n'ai pas vu cafe ») et l'audit de la page d'accueil.
- Commit `ac9b108` sur `sauvegarde/pc-ubuntu-2026-09-08`, puis `main` avance en avance rapide
  jusqu'a ce commit. Les deux branches poussees sur `origin`. Aucun historique reecrit.
- Verification avant push : le declenchement automatique de `.github/workflows/deploy.yml` est
  commente (seul `workflow_dispatch` subsiste). Pousser sur `main` ne declenche donc pas le
  workflow qui, en l'etat, supprimerait les points d'entree PHP du serveur.

### Faille corrigee dans la meme livraison

- Constate le 2026-09-17 en production : `/docs/WORKLOG.md` et `/docs/PROJECT_CONTEXT.md`
  repondaient **200**. La documentation interne etait donc publiquement lisible : hebergeur,
  domaine, chemin du back office `/espace-gb/login.php`, adresse e-mail du client, cookie
  antirobot et decisions internes. `/docs/technique/...` repondait deja 404 : seule une copie
  partielle, issue d'un ancien envoi, se trouvait sur le serveur. `docs/` n'est pas dans le build.
- Correction : `RedirectMatch 404 ^/docs(/|$)` ajoute en tete de `.htaccess`. Le 404 est prefere
  au 403 car il ne revele pas l'existence du repertoire.
- **Les fichiers restent physiquement sur le serveur.** Rien n'a ete supprime a distance, aucune
  suppression n'ayant ete demandee. La suppression reste souhaitable : a arbitrer avec Gassama.

### Deploiement

- Procedure : `php build.php --with-admin`, puis envoi FTPS du contenu de `dist/` vers la racine
  du compte FTP cloisonne. On ecrase, on ne supprime jamais.
- Identite du repertoire distant confirmee avant toute ecriture : `index.php` et `.htaccess`
  distants portent bien la marque `groupebabia`, taille du logo identique au fichier local.
- `.env` present a distance, explicitement exclu de l'envoi : il porte les acces MySQL et le mot
  de passe admin. Il n'est pas dans le build.
- Comparaison prealable des 158 fichiers du build avec la production : 72 identiques, 86 a envoyer.
  Seuls ces 86 ont ete transmis.
- Sauvegarde avant ecrasement : 76 fichiers distants recuperes par FTP (2,2 Mo), conserves dans le
  repertoire de session, hors depot. Les 10 autres fichiers etaient nouveaux, sans version a sauver.
- Ordre d'envoi : ressources (CSS, JS, images) d'abord, pages ensuite, `.htaccess` en dernier.
  Une coupure en cours d'envoi laisse ainsi le site servable, et une erreur de `.htaccess` ne
  survient qu'apres que tout le reste soit en place.
- Resultat : **86 / 86 envoyes, 0 echec**. Chaque fichier relu apres envoi : 86 / 86 identiques a
  la source au hash SHA-256.

### Verification en production

- 22 pages publiques FR et EN en **200**, y compris les deux pages contact (avec le cookie
  antirobot `humans_21909=1`, sans lequel Bluehost repond 409).
- Protections : `/docs/` et `/docs/WORKLOG.md` en **404** (etaient en 200 avant la livraison) ;
  `/app/config.php`, `/database/`, `/uploads/` et `/.env` en **403** ; `/.deploy.local` en 404 ;
  `/espace-gb/login.php` toujours en **200** ; URL inconnue en **404**.
- Contenu : `secteurs.php` et `en/sectors.php` portent chacun **12 cartes produit**, les douze
  produits du client nommes ; l'accueil porte **12 vignettes** dans le mur produits ; le bandeau
  defilant est absent (`hero-marquee` : 0) ; le bouton WhatsApp est present sur l'accueil FR et EN ;
  la mention « les realisations arrivent » est en ligne dans les deux langues ; la version d'assets
  servie est bien `20260917-contact-header-images`.
- Les 10 nouveaux visuels repondent 200.

### Niveau atteint, limites, rollback

- Niveau atteint : **livre et verifie par requetes HTTP**.
- Limite : **aucune verification visuelle en navigateur**, aucun navigateur disponible ici. Le rendu
  mobile et ordinateur reste a controler cote utilisateur, en priorite l'en-tete a 360 px de large
  (marque + bouton WhatsApp + bouton menu sur une seule ligne) et le mur produits de l'accueil.
- Limite : aucun formulaire de contact soumis, aucune operation en base, aucun message de test.
- Limite : les visuels sont temporaires (banque d'images libre), a remplacer par les medias du client.
- Rollback : restaurer les 76 fichiers de la sauvegarde FTP de session, ou revenir au commit
  `9521a38`, rebatir `dist/` et renvoyer.

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
