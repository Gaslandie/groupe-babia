# Menu mobile : garder la position de lecture — 30 septembre 2026

## Correction

Sur téléphone et tablette, le bouton menu doit ouvrir le panneau latéral à la position de lecture actuelle. Le menu doit se fermer sans remonter la page. Le fond reste immobile pendant l'ouverture, mais les liens du menu restent utilisables et son panneau peut défiler.

Cause probable dans les sources : la règle `body.nav-open { overflow: hidden; }` crée une zone de défilement au moment du clic. Cela peut modifier le repère de l'en-tête `sticky`. Le focus automatique sur le premier lien pouvait aussi provoquer un défilement. La règle est retirée ; les gestes sur le fond sont bloqués par JavaScript et le focus utilise `preventScroll`.

## Comparaison de référence avant correction

Sources consultées le 30 septembre 2026 :

| Source | Observation vérifiée | Adaptation |
| --- | --- | --- |
| [MDN : overflow](https://developer.mozilla.org/en-US/docs/Web/CSS/Reference/Properties/overflow) | `overflow: hidden` crée un conteneur de défilement ; un élément recevant le focus peut provoquer un défilement. | Éviter ce changement sur `body` lorsque le menu s'ouvre. |
| [MDN : focus()](https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/focus) | `focus()` fait défiler par défaut ; `preventScroll: true` conserve la position. | L'utiliser sur le premier lien et au retour du focus au bouton. |
| [MDN : overscroll-behavior](https://developer.mozilla.org/en-US/docs/Web/CSS/Reference/Properties/overscroll-behavior) | `overscroll-behavior: contain` évite que le défilement d'un panneau se propage au parent dans les navigateurs compatibles. | Garder cette règle existante sur `.site-nav`. |

Ces documents expliquent les mécanismes ; le défaut exact du téléphone client reste à confirmer après publication.

## Contrôles effectués

- `node --check assets/js/main.js`, génération des pages FR/EN, `php build.php --with-admin`, `php scripts/verify-build.php`, `git diff --check` : réussis.
- Simulation locale des événements JavaScript à `scrollY = 1400` : ouverture et fermeture sans modification de la position, `aria-expanded` correct, blocage de `touchmove` et `wheel` hors du menu, gestes dans le menu non bloqués, retour du focus sans défilement.
- Aucun navigateur connecté n'est disponible : contrôle visuel réel à 390 px et sur tablette non effectué.
- Sécurité : aucun changement d'authentification, droits, propriétaire des données, session, entrée, fichier téléversé, donnée privée, secret, dépendance ou sauvegarde. Aucun test d'accès direct, de changement de compte ou de droits révoqués : ces parcours serveur ne sont pas modifiés. Les protections existantes n'ont pas été affaiblies.

Niveau atteint : code, génération, vérification locale et livraison. Aucun commit ni push. Aucun essai visuel sur le téléphone client.

## Livraison production

- FTPS vers `box4100.bluehost.com` avec vérification complète du certificat TLS. Dossier distant confirmé par correspondance exacte de `.htaccess`, `index.php` et `assets/images/logo.webp`.
- 49 fichiers publics concernés ; 49 sauvegardés avant écriture dans `/tmp/babia-menu-20260930-047kkh0a`, puis 49 envoyés et relus identiques au hash SHA-256. Aucun fichier supprimé ; `.env`, `app/`, `database/` et le back office non envoyés.
- Contrôles HTTP en production : `/`, `/en/`, `/secteurs.php`, `/en/sectors.php`, CSS et JS versionnés en 200 avec le contenu attendu ; `/.env` et `/app/config.php` en 403 ; `/docs/WORKLOG.md` et une URL inconnue en 404 ; login admin en 200.
- Les titres distincts des secteurs sont aussi vérifiés en ligne. Le comportement précis du navigateur mobile reste à essayer sur l'appareil du client.


## Suite et questions de gestion de projet

Sur téléphone et tablette, ouvrir une page longue sur téléphone et tablette, descendre au milieu, ouvrir le menu puis le fermer par Échap ou un clic extérieur. Vérifier aussi un menu dont les liens dépassent la hauteur de l'écran.

1. Quel appareil et navigateur le client utilise-t-il ?
2. À quelle position de page et dans quelle rubrique le saut se produit-il le plus souvent ?
3. Le client peut-il vérifier l'accueil FR et EN après la mise en ligne ?
