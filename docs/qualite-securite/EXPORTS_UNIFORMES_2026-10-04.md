# Produits exportés : une seule présentation — 4 octobre 2026

## Ce qui change

Les huit produits exportés ont la même carte sur le catalogue et la page secteurs, FR/EN : photo, catégorie, titre, résumé, étiquettes, « Informations produit » à déplier, « Demander un prix » et WhatsApp. Les deux fiches séparées hévéa/coton en bas du catalogue sont supprimées. Leurs caractéristiques client et les quatre photos restent dans les cartes. Les liens d’accueil et anciens liens `#hevea` / `#cotton` arrivent désormais sur les cartes.

Le formulaire prépare le produit choisi pour les huit exports. Aucune information commerciale nouvelle n’a été inventée pour les six autres produits ; leur volet demande les précisions nécessaires à la cotation.

## Comparaison avant correction

Références reconnues relues le 4 octobre 2026, pour vérifier la pertinence de la comparaison du 3 octobre :

| Source | Observation réelle | Adaptation |
| --- | --- | --- |
| [Olam Agri — Cotton](https://www.olamagri.com/products-services/cotton) | Présente le réseau de producteurs, les origines et le contact commercial. | Garder l’origine et le contact dans la présentation du produit. |
| [Socfin — Rubber](https://socfin.com/en/rubber/) | Distingue latex, cup lumps et transformation TSR. | Conserver les informations spécifiques à l’hévéa dans sa carte. |
| [MDN — details](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/details) | L’élément natif masque les informations jusqu’à activation du résumé ; ouverture par clic ou clavier. | Le même volet accessible sur les huit cartes, sans dépendance ni nouveau script d’ouverture. |

Accès textuels réussis ; aucun audit visuel des références. La présentation uniforme suit la correction explicite de Gassama et le patron des cartes du site. Les chiffres et garanties restent uniquement ceux du client.

## Fichiers concernés

Fragments catalogue/secteurs dans `app/pages/fr/` et `app/pages/en/`, CSS/JS, version des ressources dans `app/partials/site.php`, `realisation.php`, `realisations.php`, miroirs HTML/PHP régénérés et documentation de suivi. Aucun changement d’image. Version publiée : `20261004-export-uniform`.

## Vérifications

- Génération FR/EN, `php build.php --with-admin`, comparaison du build (77 fichiers), `node --check assets/js/main.js`, `git diff --check` réussis.
- Liens publics et dimensions de 217 images contrôlés : aucun défaut. Caractéristiques hévéa/coton conservées dans les deux langues.
- 24 cas Chrome locaux : catalogue FR ordinateur/mobile, catalogue EN mobile, secteurs EN ordinateur, demandes des huit produits dans les deux langues, valeurs inconnues `constructor` et script refusées. Une navigation réelle cacao → formulaire réussie ; aucun message envoyé.
- Les huit cartes ont les mêmes éléments et deux boutons chacune ; aucun bloc de fiche séparé. Volets testés au clavier et par clic ; aucun débordement, image manquante ou exception JavaScript.
- Captures ordinateur des cartes et mobile du coton déplié consultées. Les captures longues hors écran peuvent omettre la peinture de photos pourtant chargées ; le contrôle visuel utilise aussi le cadre réellement visible et attend le décodage des images.

## Sécurité et limites

Préremplissage limité aux noms de produits autorisés, avec `Object.hasOwn` et `textarea.value`. Pas d’injection de HTML issu de l’URL. Validation et protections serveur conservées. Aucun changement de compte, droit, propriétaire, session, base, téléversement ou dépendance. Révocation de droits et changement de compte non testés car ces parcours ne changent pas. Originaux des photos conservés ; retouche IA déjà expliquée dans le rapport du 3 octobre.

## Livraison

Niveau atteint : livré. Commit `fa89187` poussé sur `main`. Destination confirmée par trois fichiers existants. Les tentatives Python FTPS ont échoué avant toute écriture (délais TLS, route réseau indisponible), y compris avec réutilisation de session TLS. Livraison réussie avec cURL, certificat et chiffrement exigés, reprises des erreurs réseau, sans option d’affaiblissement TLS.

47 fichiers sauvegardés dans `/tmp/babia-uniform-ftps-20261004-4s3wzdiz/backup`, puis 47/47 envoyés et relus identiques au SHA-256. Aucun fichier supprimé et aucun secret modifié. Les identifiants n’ont pas été placés dans les arguments du processus ; leur configuration temporaire privée a été retirée après le transfert.

22 contrôles HTTP après livraison réussis : huit pages publiques, six ressources et huit accès publics/protégés. Huit volets produit présents sur catalogue et secteurs FR/EN, anciens blocs et boutons « Voir la fiche produit » absents. Données client conservées, ressources identiques au build. Secrets/dossiers privés en 403 ou 404 ; messages admin renvoyés vers la connexion sans authentification. Quatre cas Chrome production à 390 / 1440 px réussis, avec volets clavier/clic, commandes identiques, aucune image manquante ni débordement ni erreur JS. Capture mobile du coton déplié consultée en production.

Retour arrière : restaurer les 47 fichiers sauvegardés en FTPS vérifié. Le dossier de sauvegarde `/tmp` est une sauvegarde de session à archiver pour une conservation durable.

Références techniques relues le 4 octobre : [Python SSLSession](https://docs.python.org/3/library/ssl.html#ssl.SSLSocket.session) et [cURL](https://curl.se/docs/manpage.html#--ssl-reqd), pour conserver un transfert chiffré et authentifié et reprendre les erreurs réseau.

## Suite et questions de suivi

Le client peut ouvrir les informations des produits et essayer « Demander un prix ».

1. Qui centralise les retours sur la présentation ?
2. Quand les fiches techniques des six autres exports seront-elles disponibles ?
3. Qui actualise les disponibilités commerciales ?
