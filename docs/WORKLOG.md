# Worklog

## En cours

| Date | Sujet | Responsable | Niveau atteint | Prochaine etape |
| --- | --- | --- | --- | --- |
| 2026-08-16 | Preparation du dossier projet | Codex | Depot vide clone dans `site-web/`, template GassTech copie, contexte initial documente | Attendre les consignes pour le cadrage ou le choix technique |
| 2026-08-16 | Page d'accueil | Codex | Page statique creee, hero slider 3 secondes, rendu desktop/mobile verifie | Publie sur GitHub |
| 2026-08-16 | Version multi-pages | Codex | Pages internes, catalogue interactif et contact ajoutés, vérifiés et prêts à pousser | Pousser sur GitHub |
| 2026-08-16 | Footer type carte blanche | Codex | Footer remplace sur toutes les pages selon la reference fournie | Pousser si demande |

## A faire

- Cadrer le perimetre du premier lot.
- Choisir la stack technique.
- Definir l'arborescence cible du site FR/EN.
- Valider les coordonnees officielles, reseaux sociaux, contenus et medias.
- Remplacer les medias par des visuels officiels lorsque le client les transmet.
- Activer GitHub Pages si le site doit etre partage par URL publique.

## Fait

- Lecture du cahier des charges client.
- Analyse rapide du site actuel et des pages principales.
- Verification du depot GitHub : depot accessible mais vide au demarrage.
- Installation du squelette `modele-projet` du template Web/Mobile GassTech.
- Ajout des modeles de cadrage, UX, technique, qualite/securite et livraison dans `docs/`.
- Creation d'une premiere page d'accueil statique avec hero a images defilantes toutes les 3 secondes.
- Verification syntaxe JS avec `node --check assets/js/main.js`.
- Verification visuelle avec Chrome headless en desktop, mobile et slide Mines apres 7 secondes.
- Optimisation du logo de 1024 px vers 256 px.
- Ajout des pages Groupe, Agroalimentaire, BTP, Mines, Catalogue, Actualites et Contact.
- Ajout des filtres catalogue, boutons de selection devis et liens e-mail/WhatsApp prepares automatiquement.
- Verification HTTP locale : 8 pages en statut 200.
- Verification visuelle Chrome headless : accueil desktop/mobile, catalogue, catalogue long et contact mobile.
- Correction des chemins d'images de hero internes apres detection de requetes 404.
- Footer harmonise sur toutes les pages selon la reference fournie : carte blanche arrondie, colonnes de liens, reseaux et liens legaux.
- Verification footer : 8 pages en HTTP 200, capture Chrome headless desktop/mobile sur `contact.html`.
- Nettoyage des formulations internes pour aligner le depot sur une version publiable.
