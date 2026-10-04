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

## Vérifications

- Génération FR/EN, `php build.php --with-admin`, comparaison du build (77 fichiers), `node --check assets/js/main.js`, `git diff --check` réussis.
- Liens publics et dimensions de 217 images contrôlés : aucun défaut. Caractéristiques hévéa/coton conservées dans les deux langues.
- 24 cas Chrome locaux : catalogue FR ordinateur/mobile, catalogue EN mobile, secteurs EN ordinateur, demandes des huit produits dans les deux langues, valeurs inconnues `constructor` et script refusées. Une navigation réelle cacao → formulaire réussie ; aucun message envoyé.
- Les huit cartes ont les mêmes éléments et deux boutons chacune ; aucun bloc de fiche séparé. Volets testés au clavier et par clic ; aucun débordement, image manquante ou exception JavaScript.
- Captures ordinateur des cartes et mobile du coton déplié consultées. Les captures longues hors écran peuvent omettre la peinture de photos pourtant chargées ; le contrôle visuel utilise aussi le cadre réellement visible et attend le décodage des images.

## Sécurité et limites

Préremplissage limité aux noms de produits autorisés, avec `Object.hasOwn` et `textarea.value`. Pas d’injection de HTML issu de l’URL. Validation et protections serveur conservées. Aucun changement de compte, droit, propriétaire, session, base, téléversement ou dépendance. Révocation de droits et changement de compte non testés car ces parcours ne changent pas. Originaux des photos conservés ; retouche IA déjà expliquée dans le rapport du 3 octobre.

## Livraison

En cours : sauvegarde avant remplacement, FTPS avec certificat vérifié, relecture SHA-256 après chaque envoi, aucune suppression ni modification des secrets. Le premier essai FTPS de lecture a dépassé son délai ; aucun fichier n’avait été envoyé. Le deuxième essai confirme la destination avec `.htaccess`, `index.php` et le logo.

## Suite et questions de suivi

Le client peut ouvrir les informations des produits et essayer « Demander un prix ».

1. Qui centralise les retours sur la présentation ?
2. Quand les fiches techniques des six autres exports seront-elles disponibles ?
3. Qui actualise les disponibilités commerciales ?
