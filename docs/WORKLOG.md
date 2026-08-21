# Worklog

## En cours

| Date | Sujet | Responsable | Niveau atteint | Prochaine etape |
| --- | --- | --- | --- | --- |
| 2026-08-16 | Preparation du dossier projet | Codex | Depot vide clone dans `site-web/`, template GassTech copie, contexte initial documente | Attendre les consignes pour le cadrage ou le choix technique |
| 2026-08-16 | Page d'accueil | Codex | Page statique creee, hero slider ajuste ; cadence actuelle : 5 secondes | Publie sur GitHub |
| 2026-08-16 | Version multi-pages | Codex | Pages internes, catalogue interactif et contact ajoutés, vérifiés et prêts à pousser | Pousser sur GitHub |
| 2026-08-16 | Footer type carte blanche | Codex | Footer remplace sur toutes les pages selon la reference fournie | Pousser si demande |
| 2026-08-16 | Produits agroalimentaires | Codex | Liste client traduite en francais et integree au catalogue agroalimentaire | Attendre validation visuelle client |
| 2026-08-16 | Experience institutionnelle internationale | Codex | Systeme visuel, contenus, navigation, accessibilite, contact et pages legales renforces | Publier sur GitHub |
| 2026-08-17 | Passe UX | Claude | Correctifs UX codes, verifies en local sur 11 pages, pousses sur `main` | Recette visuelle client, puis remplacement des medias |
| 2026-08-17 | Benchmark SGS | Claude | Analyse structurelle et plan priorise redige dans `docs/design-ux/BENCHMARK_SGS.md` | Debloquer les contenus client pour les lots P0 |
| 2026-08-17 | Migration PHP + version EN | Claude | Plan d'execution redige dans `docs/technique/MIGRATION_PHP.md`. Voie retenue : PHP ecrit, HTML genere, publie par GitHub Actions. Tache du lot 0 cadree | Codex execute `docs/taches/LOT-0-SOCLE-PHP.md` |
| 2026-08-21 | Renforcement credibilite vitrine | Codex | Blocs de preuve commerciale, qualification BTP/mines/agro, formulaire enrichi et contenus de confiance ajoutes en statique | Verifier puis deployer sur Bluehost |
| 2026-08-21 | Migration PHP progressive | Codex | Lot 0A cree : config PHP, registre des pages, build `dist/` identique et script de verification | Extraire les premiers partials sans changer le rendu |
| 2026-08-21 | Back office MySQL | Codex | CRUD realisations ajoute hors production : creation, edition, suppression, statuts, mise en avant, CSRF | Brancher le front public sur les realisations publiees |
| 2026-08-21 | Front public realisations | Codex | Page PHP `realisations.php` branchee sur les realisations publiees, avec repli propre sans MySQL | Creer la base Bluehost et activer les secrets avant de deployer PHP |
| 2026-08-21 | Fiches realisations et upload | Codex | Fiche detail publique, apercu accueil PHP et upload image admin ajoutes hors deploiement FTP | Tester avec une vraie base MySQL Bluehost |
| 2026-08-21 | URLs propres realisations | Codex | URL `/realisations/{slug}` et champ client/partenaire ajoutes | Appliquer les migrations 001 puis 002 sur Bluehost |
| 2026-08-21 | Activation back office | Codex | Runner migrations CLI, generateur de hash admin et build `--with-admin` ajoutes | Creer la base MySQL Bluehost et le `.env` serveur |
| 2026-08-21 | Chemin back office prive | Codex | Dossier `admin/` renomme en `espace-gb/`, identifiant conserve `admin` | Tester `/espace-gb/login.php` sur Bluehost avant bascule |
| 2026-08-21 | Durcissement PHP | Codex | Acces direct a `.env`, `app/`, `database/`, SQL/logs et scripts uploades bloque | Valider ces protections sur Apache Bluehost |
| 2026-08-21 | Formulaire serveur | Codex | Stockage MySQL des demandes et ecran admin messages deployes | Ajouter notification e-mail et purge automatique |
| 2026-08-21 | Version anglaise | Codex | Pages publiques `/en/` en cours de generation et integration | Verifier, deployer et pousser |
| 2026-08-21 | Bascule PHP publique | Codex | Pages publiques basculees en URLs PHP canoniques en local | Deployer, verifier production et pousser |
| 2026-08-21 | Correction version anglaise | Codex | Miroirs `.html` locaux avec liens `.html`, pages PHP production conservees, catalogue anglais illustre et JS catalogue/formulaire bilingue | Continuer l'enrichissement editorial page par page |

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
- Creation d'une premiere page d'accueil statique avec hero a images defilantes ; cadence actuelle : 5 secondes.
- Verification syntaxe JS avec `node --check assets/js/main.js`.
- Verification visuelle avec Chrome headless en desktop, mobile et slide Mines apres defilement du hero.
- Optimisation du logo de 1024 px vers 256 px.
- Ajout des pages Groupe, Agroalimentaire, BTP, Mines, Catalogue, Actualites et Contact.
- Ajout des filtres catalogue, boutons de selection devis et liens e-mail/WhatsApp prepares automatiquement.
- Verification HTTP locale : 8 pages en statut 200.
- Verification visuelle Chrome headless : accueil desktop/mobile, catalogue, catalogue long et contact mobile.
- Correction des chemins d'images de hero internes apres detection de requetes 404.
- Footer harmonise sur toutes les pages selon la reference fournie : carte blanche arrondie, colonnes de liens, reseaux et liens legaux.
- Verification footer : 8 pages en HTTP 200, capture Chrome headless desktop/mobile sur `contact.html`.
- Nettoyage des formulations internes pour aligner le depot sur une version publiable.
- Integration des produits client : exportation agricole et importation alimentaire.
- Evolution du systeme visuel global : typographie editoriale, palette, espacements, cartes, hero et responsive.
- Reecriture des contenus auto-referentiels en discours institutionnel destine aux partenaires.
- Amelioration de la navigation mobile, de l'accessibilite clavier et des interactions du catalogue.
- Ajout des pages de mentions legales et de confidentialite.
- Passe UX 2026-08-17 : correction des heros internes casses (image en `<img>` au lieu d'un `url()` en custom property), typographie fluide, lien d'evitement, fil d'Ariane semantique, menu mobile avec piege de focus et icone d'etat.
- Passe UX 2026-08-17 : hero d'accueil avec bouton pause, balayage tactile, barre de progression et texte d'accroche stable ; cadence actuelle : 5 secondes.
- Passe UX 2026-08-17 : catalogue avec compteurs de filtres, etat vide, panneau de devis conditionnel a puces retirables et selection persistee entre pages.
- Passe UX 2026-08-17 : formulaire de contact avec champs obligatoires marques, validation en ligne, statut d'envoi, repli copier/WhatsApp et pre-remplissage par `?besoin=`.
- Passe UX 2026-08-17 : page `404.html`, bouton retour en haut, icones SVG au pied de page, dimensions et chargement differe sur les images.
- Verifications 2026-08-17 : `node --check assets/js/main.js`, 11 pages en HTTP 200, aucune requete 404, structure HTML equilibree, parcours catalogue/contact et slider pilotes via Chrome DevTools Protocol.
- Mise en ligne Bluehost 2026-08-21 : FTP GitHub Actions fonctionnel, domaine `https://www.groupebabia.com/` servi en HTTPS, apex redirige vers `www`.
- Renforcement 2026-08-21 : ajout de preuves de methode, informations attendues pour cotation, champs destination/calendrier et nettoyage des commentaires canoniques.
- Migration PHP 2026-08-21 : ajout du build statique PHP initial, generation de `dist/`, verification byte a byte des pages et fichiers publies.
- Back office 2026-08-21 : MySQL retenu ; premier perimetre admin limite aux activites/realisations publiees par l'entreprise.
- Back office 2026-08-21 : ajout de `database/migrations/001_create_realisations.sql`, configuration MySQL par `.env`, login admin par hash et ecrans de lecture.
- Back office 2026-08-21 : CRUD realisations ajoute avec validation serveur, slug automatique, statut publie/brouillon/archive et protection CSRF.
- Front PHP 2026-08-21 : ajout de `realisations.php`, affichage public des realisations `published`, repli sans erreur si MySQL n'est pas encore configure.
- Front PHP 2026-08-21 : ajout de `realisation.php?slug=...`, apercu des 3 dernieres realisations dans `index.php` lorsque MySQL est disponible, upload image admin vers `uploads/realisations/`.
- Front PHP 2026-08-21 : URL propre `/realisations/{slug}`, canonical associe et champ `client_partner` administrable puis affichable.
- Back office 2026-08-21 : ajout de `database/migrate.php`, `scripts/create-admin-password-hash.php` et du build explicite `php build.php --with-admin`.
- Back office 2026-08-21 : chemin public retenu `/espace-gb/login.php`; bascule PHP/admin uniquement apres test manuel Bluehost.
- Securite 2026-08-21 : protections `.htaccess` ajoutees pour secrets, dossiers techniques, migrations, uploads et back office.
- Contact 2026-08-21 : formulaire branche sur `contact-submit.php`, stockage MySQL `contact_messages`, consultation et changement de statut dans `espace-gb/messages.php`.
- Contact 2026-08-21 : notification e-mail vers `infobabiaguinee@gmail.com`, suppression logique par archivage, puis purge automatique des archives apres 30 jours.
- Version anglaise 2026-08-21 : creation de pages publiques `/en/`, liens de langue FR/EN, sitemap anglophone et formulaire anglais branche sur le meme endpoint.
- Bascule PHP 2026-08-21 : `DirectoryIndex index.php`, liens internes, canoniques, sitemap et redirections mis a jour pour servir PHP comme version publique principale.
