# Hévéa et coton — 3 octobre 2026

## Résultat

Deux produits exportés ajoutés en français et anglais : accueil, secteurs et catalogue. Le catalogue affiche les formes disponibles, origines, réseaux agricoles, quantités minimales, ports, saisons et documents fournis par le client. Quatre photos clarifiées avec imagegen, puis optimisées en WebP (697 016 octets au total). Les boutons préparent une demande de prix adaptée au produit sur le formulaire existant ou WhatsApp.

## Fichiers et commandes

- Sources : `app/pages/fr/` et `app/pages/en/` (accueil, secteurs, catalogue), `app/pages/fr.php`, `app/pages/en.php`, `app/partials/site.php`.
- Ressources : quatre images dans `assets/images/`, `assets/css/styles.css`, `assets/js/main.js`.
- Miroirs publics HTML/EN PHP régénérés. Version CSS/JS : `20261003-hevea-cotton`, y compris `realisation.php` et `realisations.php`.
- Documentation : contexte, journal et [benchmark avec prompts exacts](../design-ux/BENCHMARK_HEVEA_COTON_2026-10-03.md).
- Commandes : génération FR/EN, `php build.php --with-admin`, `php scripts/verify-build.php`, `node --check assets/js/main.js`, `php -l`, `git diff --check` ; Chrome headless piloté par son protocole de test local.

## Vérifications réelles avant livraison

- 77 fichiers du build conformes ; syntaxe de 18 fichiers PHP et JavaScript valide.
- 217 balises image des pages publiques contrôlées : fichiers existants, dimensions exactes. Liens locaux des pages publiques : zéro référence manquante. Les fragments internes ne sont pas des pages autonomes et sont exclus de ce contrôle.
- Onze cas dans Chrome réel à 390 et 1440 px : catalogue, secteurs et accueil FR/EN ; formulaires des deux produits ; paramètres inconnus et contenu ressemblant à un script. Aucun débordement horizontal, image cassée ou exception JavaScript. Catalogues et secteurs : 14 cartes (8 export, 6 import) ; accueil : 14 vignettes ; catalogue : 2 fiches détaillées.
- Captures consultées : fiche hévéa ordinateur et fiche coton mobile anglais. Photos améliorées consultées avant intégration.
- Demandes reconnues : type import/export et texte technique préparés. Paramètres inconnus ignorés. Le paramètre `constructor` révélait une lecture de propriété héritée du dictionnaire existant : correction par `Object.hasOwn`, puis reprise des onze contrôles réussie.

## Sécurité et limites

Le préremplissage utilise une liste fermée et `textarea.value` ; aucun HTML issu de l’URL n’est injecté. Validation serveur et protections contre les robots conservées. Aucun changement d’authentification, de droits, de propriétaire, de session, de téléversement, de base ou de dépendance. Changement de compte et révocation de droits non testés : ces parcours ne sont pas modifiés. Aucun formulaire soumis et aucun message envoyé.

La retouche par IA reconstruit des textures ; les photos ne prouvent pas le stock. Les affirmations commerciales viennent du client. Contrôle à 390 et 1440 px ; aucun essai sur le téléphone physique du client.

## Livraison

En préparation. Envoi limité aux fichiers concernés du build, par FTPS avec certificat vérifié. Destination confirmée par `.htaccess`, `index.php` et le logo. Sauvegarde des fichiers remplacés avant écriture, relecture après transfert ; aucune suppression ni modification du `.env` serveur. Le workflow historique GitHub Actions reste désactivé.

## Suivi sans blocage

1. Qui centralise les retours du client sur les deux fiches ?
2. À quelle date souhaite-t-il fournir ses fiches techniques types ?
3. Qui actualisera les disponibilités et saisons si elles changent ?
