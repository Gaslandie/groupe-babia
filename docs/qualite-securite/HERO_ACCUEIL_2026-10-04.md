# Texte client du bandeau d’accueil — 4 octobre 2026

## Ce qui change

Le bandeau anglais reprend exactement les trois lignes demandées, avec leur casse et leur ponctuation :

> GROUPE BABIA GUINÉE SARLU
>
> Diversified Group. Driving Guinea’s Growth and building Guinea Future today.
>
> Operating in 7 strategic sectors to build infrastructure, ensure food security, and create jobs across Guinea and Africa

La version française traduit le sens :

> GROUPE BABIA GUINÉE SARLU
>
> Un groupe diversifié. Stimuler la croissance de la Guinée et bâtir son avenir dès aujourd’hui.
>
> Présent dans 7 secteurs stratégiques pour développer les infrastructures, assurer la sécurité alimentaire et créer des emplois en Guinée et en Afrique.

Les cinq images continuent de défiler. Le message reste visible sur chacune : sa source unique est le HTML de chaque langue. Les anciennes phrases JavaScript sont retirées. Sur tablette, un espace est réservé aux commandes du diaporama pour éviter qu’elles ne couvrent le titre plus long. La version des ressources passe à `20261004-home-hero-client` pour renouveler le cache.

## Comparaison avant adaptation

Pages officielles consultées le 4 octobre 2026, avant modification :

| Référence | Observation réellement accessible | Adaptation au périmètre |
| --- | --- | --- |
| [Dangote](https://www.dangote.com/) | Plusieurs messages d’ambition industrielle et de construction de l’avenir, avec une action vers les activités du groupe. | Conserver le titre institutionnel, l’explication et les actions du bandeau existant. |
| [Olam Agri](https://www.olamagri.com/) | Des titres accompagnés d’un court texte et d’une action dans les mises en avant. | Garder trois niveaux de lecture : nom, promesse, activités et impact. |

Lecture textuelle réussie ; aucun audit visuel de ces références. Les mots du client font autorité. Les références servent à vérifier la structure, sans remplacer sa demande.

## Fichiers et commandes

Sources : `app/pages/fr/index.html`, `app/pages/en/index.html`, `assets/js/main.js`, `assets/css/styles.css`. Version des ressources : `app/partials/site.php`, `realisation.php`, `realisations.php`. Miroirs publics régénérés, documentation de suivi mise à jour. La mise à jour de cache touche les pages publiques qui partagent le JavaScript.

Commandes : `php scripts/generate-fr-pages.php`, `php scripts/generate-en-pages.php`, `php build.php --with-admin`, `php scripts/verify-build.php`, `node --check assets/js/main.js`, `php -l` sur les trois sources PHP modifiées et `git diff --check`.

## Vérification réelle

Build et comparaison de 77 fichiers réussis. Syntaxe PHP et JavaScript valide. Huit cas Chrome locaux FR/EN : 1440 × 900, 768 × 1024, 390 × 844 et 320 × 568. Les trois textes sont comparés mot pour mot ; les cinq images, les puces, les flèches clavier et le retour à la première/dernière image fonctionnent. Défilement automatique testé dans les deux langues : l’image tourne, le texte reste identique. Aucun texte coupé, chevauchement avec les commandes, débordement horizontal, image du bandeau manquante ou exception JavaScript. Captures réelles téléphone FR et ordinateur EN consultées.

24 cas Chrome de non-régression réussis sur le parcours produits : cartes et volets, demandes des huit produits dans les deux langues, valeurs inconnues `constructor` et script refusées, navigation cacao → contact. Aucun message envoyé.

## Sécurité et limites

Contenu public fixe, sans nouvelle entrée utilisateur ni insertion de HTML provenant de l’URL. Contrôles serveur, sessions, droits, données, secrets et dépendances conservés. Aucune soumission de formulaire ni écriture dans la base. Les changements de compte et la révocation des droits ne sont pas testés : ces parcours ne changent pas. Chrome est utilisé dans un profil isolé ; pas de validation sur le téléphone physique du client ou dans Safari.

## Livraison

Niveau atteint : testé localement, livraison en préparation. Plan limité à 45 fichiers publics du build avec leurs empreintes SHA-256. Livraison prévue par FTPS chiffré avec certificat vérifié, destination reconnue par trois fichiers existants, sauvegarde de tous les fichiers remplacés et relecture après chaque envoi. Aucune suppression. Le workflow historique n’est pas lancé.

## Suite et questions de suivi

Le client peut lire le bandeau français et anglais, puis laisser les images changer pour vérifier que son message reste affiché.

1. Qui centralise le retour final du client sur les textes ?
2. Quelle date retenir pour sa recette sur téléphone ?
3. Qui fournira les prochains contenus institutionnels validés ?
