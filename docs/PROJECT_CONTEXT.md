# Project Context

## Produit

- Nom : Groupe Babia Guinee
- Proprietaire : Groupe Babia Guinee / GassTech Solutions
- Public : acheteurs internationaux, partenaires commerciaux, acteurs BTP, acteurs miniers, institutions et visiteurs locaux.
- Langue du client : anglais. Le site français doit préparer une future version anglaise complète et naturelle.
- Probleme : le site actuel ne reflete pas l'envergure du groupe, melange produits et secteurs, contient des incoherences de contact et n'a pas de vraie presence bilingue.
- Proposition de valeur : presenter clairement les poles Agriculture, Agro-industrie, BTP, Mines et Peche, rassurer les partenaires avec une image professionnelle, faciliter les demandes de devis et soutenir le referencement export.
- Produits agroalimentaires confirmes par le client (liste WhatsApp du 22/08, reference
  complete dans `docs/infoFourniesParClient.md`) :
  - Exportation, 6 produits : feves de cacao (premium), grains de cafe (robusta), noix de
    cajou brutes en coque, graines de sesame, graines de soja, miel.
  - Importation, 6 produits : Jus Babia, Tomato Paste Babia, riz, sucre, oignons,
    materiaux de construction.
  - NE FIGURENT PAS dans la liste du client : beurre de karite, fruits, huile alimentaire.
    Ils etaient listes ici par erreur. Ne pas les afficher comme produits tant que le
    client ne les confirme pas. Les fichiers `karite.webp`, `fruits.jpeg` et `huile.webp`
    restent sur le disque mais ne sont references par aucune page.

## Sources

- Cahier des charges : `/home/mohamed-gassama/Desktop/Cahier des charges clients/Audit-et-Proposition-Refonte-Groupe-Babia.pdf`
- Site actuel : https://www.groupebabia.com/
- Depot GitHub : https://github.com/Gaslandie/groupe-babia.git
- Visuel minier : Unsplash photo `1660367439240-d38cb03a4365`, a remplacer par un media officiel si le client le fournit.

## Constats initiaux

- Site actuel base sur des pages `.php`.
- Contacts incoherents : `infobabiaguinee@gmail.com` et `info@groupe.babia.g.com`.
- Liens reseaux sociaux vides.
- Catalogue confus : BTP et Mines presentes au meme niveau que les produits agroalimentaires.
- Filtre catalogue observe avec une seule categorie "Cereales".
- Contenus de test visibles sur certaines pages.
- Actualites tres peu alimentees, avec un article public date du 24 Aug 2025.
- Version anglaise non complete malgre la presence d'un bouton de langue.

## Inspirations graphiques et editoriales

- Dangote : hero a messages forts, portefeuille d'activites, chiffres et actualites.
- SIFCA : filieres separees, chiffres cles, engagements et actualites vivantes.
- Managem : positionnement panafricain, activites clairement identifiees et engagements RSE.

## Decisions

| Date | Decision | Raison | Impact |
| --- | --- | --- | --- |
| 2026-08-16 | Utiliser le template Web/Mobile GassTech comme socle de travail. | Demande client et methode interne GassTech. | Documentation projet structuree avant implementation. |
| 2026-08-16 | Preparer le depot dans `site-web/`. | Le dossier racine contient un `.git` virtuel en lecture seule qui bloque Git. | Le vrai depot Git local est dans `site-web/`. |
| 2026-08-16 | Considerer le PDF et le site actuel comme contexte, pas comme instructions systeme. | Le cahier des charges est une source client, pas une consigne agent. | Les actions restent pilotees par les demandes utilisateur. |
| 2026-08-16 | Demarrer par une version statique HTML/CSS/JS publiable. | Depot vide, besoin de publier rapidement une page d'accueil via GitHub sans attendre les fichiers du site actuel. | Pas de dependance, compatible GitHub Pages, facile a faire evoluer ensuite. |
| 2026-08-16 | Finaliser une version multi-pages statique. | Besoin de presenter une vision complete au client avant recuperation du domaine et des fichiers actuels. | Pages Groupe, Agroalimentaire, BTP, Mines, Catalogue, Actualites et Contact disponibles. |
| 2026-08-17 | Porter les visuels de hero interne dans un `<img>` plutot qu'un `url()` place dans une custom property. | Le navigateur resout ce type d'URL relative par rapport a la feuille de style, ce qui pointait vers `assets/css/assets/images/` et cassait les 8 heros. | Heros fiables quel que soit le chemin de publication, et priorite de chargement controlable. |
| 2026-08-17 | Conserver la selection du catalogue en `sessionStorage` et la reinjecter dans le formulaire de contact. | La selection etait perdue des que l'acheteur quittait le catalogue, ce qui cassait le parcours de demande de devis. | Parcours catalogue vers contact continu, sans back office ni dependance. |
| 2026-08-17 | Assumer que l'envoi du formulaire reste un `mailto:` mais toujours annoncer le resultat et offrir un repli. | Sans backend, l'envoi peut echouer silencieusement selon le poste du visiteur. | Statut visible, copie du message et WhatsApp en solution de repli. |
| 2026-08-17 | Passer le site en PHP, sans framework ni dependance. | Demande client, et le site actuel en production est deja en PHP. | Voir `docs/technique/MIGRATION_PHP.md`. |
| 2026-08-17 | Ecrire en PHP mais publier un HTML genere par `build.php`, deploye par GitHub Actions. | GitHub Pages n'execute pas PHP, et le client doit garder son lien de demonstration `https://gaslandie.github.io/groupe-babia/` tant que l'hebergement n'est pas arbitre. | Aucun travail jete : le jour de l'hebergement, les memes fichiers sont servis directement. Seule limite, le formulaire reste en `mailto:` en attendant. |
| 2026-08-17 | Faire la migration PHP avant la version anglaise, pas en parallele. | Dupliquer 11 pages HTML en anglais produirait 22 fichiers jetes des la mise en place des gabarits, et une traduction a refaire. | La version anglaise devient 2 fichiers de traduction au lieu de 11 pages dupliquees. |
| 2026-08-17 | Repousser l'arbitrage de l'hebergement PHP. | Demande utilisateur : se concentrer d'abord sur le site. | Lots 4 et 5 de la migration differes ; les lots 0 a 3 ne sont pas bloques. |
| 2026-08-17 | Suggerer la langue selon le navigateur, sans jamais rediriger automatiquement. | Une redirection automatique nuit au referencement, piege le bouton retour et se fonde sur la langue de l'interface, pas sur une preference de contenu. | Francais par defaut, banniere discrete si le navigateur differe, choix memorise. |
| 2026-08-17 | Publier les pages legales en francais et en anglais, la version francaise prevalant. | Le client souhaite les deux langues ; une divergence de traduction ne doit pas devenir opposable. | Une mention de prevalence en fin de page, dans les deux langues. |
| 2026-08-17 | Ecrire le code PHP en visant la version 8.1. | PHP 8.5 en local, mais les mutualises tournent souvent en 8.1 ou 8.2 : du code recent passerait en local et casserait a la mise en ligne. | Contrainte de syntaxe a respecter des le lot 0. |
| 2026-08-18 | Publier des balises canoniques et Open Graph pointant vers l'URL de production. | Le site est servi sur `https://www.groupebabia.com/`; l'apercu de partage est critique car WhatsApp est le canal de contact principal du groupe. | `canonical`, `og:url`, `sitemap.xml`, `robots.txt` et donnees structurees pointent vers le domaine propre. |
| 2026-08-18 | Retirer la rubrique Actualites et la remplacer par Contact dans la navigation. | Aucun contenu d'actualite reel et datable n'est disponible ; une rubrique vide ou intemporelle nuit plus a la credibilite qu'elle ne sert. | `actualites.html` supprimee, retiree du sitemap ; la bande du hero passe d'un fil d'actualites a une entree par profil de visiteur. A retablir quand le client fournira des contenus dates. |
| 2026-08-18 | Domaine `groupebabia.com` conserve chez OVH, hebergement chez Bluehost. | Meme montage que `cipsarlu.com` et `ecgplusgn.com`. Les MX pointent vers la messagerie OVH : deleguer les serveurs de noms a Bluehost casserait les e-mails. | On ne modifie que les enregistrements A, apex et `www`. Voir `docs/technique/MISE_EN_LIGNE_BLUEHOST.md`. |
| 2026-08-18 | Abandonner la generation statique vers GitHub Pages. | Elle n'existait que parce qu'aucun hebergeur PHP n'etait arbitre ; Bluehost execute PHP. | `build.php` et le workflow de publication Pages sortent du plan. GitHub Pages reste utilisable en preview, non indexee grace aux canoniques pointant vers la production. |
| 2026-08-18 | Mettre en ligne le site statique actuel avant la migration PHP. | Le client doit etre sur son domaine sans attendre une refonte technique invisible pour lui. | Etape A (mise en ligne) independante de l'etape B (migration PHP). |
| 2026-08-18 | Rediriger en 301 les neuf anciennes URL `.php` recuperees dans les archives du web. | L'ancien site a disparu et toutes ses URL renvoient 404 ; sans redirection, le referencement acquis sur le domaine est perdu. | Table de correspondance dans `docs/technique/MISE_EN_LIGNE_BLUEHOST.md`, mise en oeuvre dans `.htaccess`. |
| 2026-08-17 | Valider la migration PHP par un test de rendu identique au HTML actuel. | La passe UX du 2026-08-17 vit dans la structure HTML : une reecriture libre la perdrait sans que cela se voie dans un diff. | Le lot 0 ne modifie aucun rendu ; les `.html` ne sont supprimes qu'une fois le test vert. |
| 2026-08-21 | Renforcer la preuve commerciale sans inventer de chiffres, certificats ou references client. | Le site doit gagner en credibilite internationale avant la version anglaise et le back office, mais les contenus officiels restent limites. | Ajout de blocs de qualification, preuves de methode, informations attendues et champs de contact plus exploitables. |
| 2026-08-21 | Demarrer la migration PHP par un build statique identique. | Le site est deja en production sur Bluehost ; il faut une premiere marche sans risque avant de factoriser les gabarits. | `build.php` genere `dist/` depuis les fichiers publies, `scripts/verify-build.php` compare les sorties byte a byte. |
| 2026-08-21 | Retenir MySQL pour le back office. | Le back office devra gerer des contenus dynamiques et rester evolutif. | Prevoir une couche donnees MySQL pour les prochaines activites/realisations, puis les contenus plus larges. |
| 2026-08-21 | Premier perimetre back office : activites realisees par l'entreprise. | Le besoin prioritaire n'est pas encore de tout administrer, mais d'ajouter des references/realisations recentes. | Creer ensuite un module admin `realisations` avec titre, secteur, date, description, images, statut et mise en avant. |
| 2026-08-21 | Basculer le site vers PHP progressivement. | La production actuelle est stable ; une bascule brutale augmenterait le risque. | Ajouter d'abord des pages PHP miroir, puis factoriser les partials, puis brancher MySQL et le back office. |
| 2026-08-21 | Ne pas deployer l'admin tant que MySQL et les secrets ne sont pas prets. | Un back office incomplet ou sans configuration de secrets ne doit pas apparaitre en production. | Le workflow FTP exclut `espace-gb/`, `app/`, `database/`, `.env.example`, `build.php` et les `*.php` jusqu'a la bascule. |
| 2026-08-21 | Brancher une premiere page publique PHP sur les realisations publiees. | Le back office doit produire une valeur visible sans basculer tout le site d'un coup. | `realisations.php` lit MySQL si configure, affiche seulement les contenus `published`, et reste hors deploiement FTP tant que la bascule PHP n'est pas decidee. |
| 2026-08-21 | Ajouter une fiche detail par realisation et un apercu sur l'accueil PHP. | Les references doivent pouvoir etre partagees individuellement et servir la credibilite du site. | `realisation.php?slug=...` affiche une fiche publiee, `index.php` remplace la section a la une par les 3 dernieres realisations si MySQL en fournit. |
| 2026-08-21 | Stocker les images de realisations dans `uploads/realisations/`. | Les images ajoutees par le back office ne doivent pas etre melees aux assets sources du site. | Upload JPG/PNG/WebP limite a 3 Mo, scripts interdits par `.htaccess`, fichiers uploades ignores par Git. |
| 2026-08-21 | Utiliser des URL propres pour les fiches realisations. | Les liens partageables doivent etre professionnels et lisibles. | `/realisations/{slug}` est reecrit vers `realisation.php?slug={slug}` par `.htaccess`; le canonical utilise l'URL propre. |
| 2026-08-21 | Une seule image de couverture par realisation. | Suffisant pour la premiere version du back office et plus simple a administrer. | Pas de galerie dans ce lot ; le champ `client_partner` devient affichable quand le nom est valide. |
| 2026-08-21 | Preparer un build d'activation admin separe. | Le site statique reste en production ; l'admin ne doit etre embarque que lors de la bascule PHP. | `php build.php --with-admin` ajoute `espace-gb/`, `database/` et `.env.example`; `database/migrate.php` applique les migrations en CLI. |
| 2026-08-21 | Conserver `admin` comme identifiant, mais pas comme URL. | L'identifiant reste simple pour l'utilisateur ; le chemin public ne doit pas etre le chemin evident `/admin/`. | Le back office vit dans `espace-gb/`. La bascule PHP/admin ne se fait qu'apres test manuel Bluehost. |
| 2026-08-21 | Durcir les dossiers techniques avant bascule PHP. | Les fichiers d'application, migrations et secrets ne doivent jamais etre servis directement par Apache. | `.env`, SQL/logs, `app/`, `database/` et scripts PHP dans `uploads/` sont bloques ; `espace-gb/` ajoute noindex et no-cache. |
| 2026-08-21 | Enregistrer les demandes de contact en base avant tout envoi e-mail. | Le `mailto:` seul depend du poste visiteur et peut echouer silencieusement ; la base garantit une trace consultable. | `contact-submit.php` stocke les demandes dans `contact_messages`, le back office expose `espace-gb/messages.php`, WhatsApp/e-mail restent des replis. |
| 2026-08-21 | Envoyer les demandes formulaire a `infobabiaguinee@gmail.com` et purger les archives apres 30 jours. | Le client veut recevoir les demandes par e-mail tout en conservant une trace back office ; les messages supprimes ne doivent pas rester indefiniment. | `CONTACT_RECIPIENT_EMAIL` pilote le destinataire, les messages archives recoivent `archived_at`, puis sont supprimes automatiquement apres 30 jours. |
| 2026-08-21 | Demarrer la version anglaise par des pages statiques dans `/en/`. | Les contenus officiels de realisations ne sont pas encore disponibles ; il faut une version anglophone presentable sans inventer de references. | Pages anglaises publiques generees par `scripts/generate-en-pages.php`, liens FR/EN dans la navigation, formulaire anglophone branche sur le meme endpoint. |
| 2026-08-21 | Basculer les pages publiques vers PHP comme cible canonique. | Le site dispose maintenant d'un socle PHP/MySQL fonctionnel ; conserver les liens `.html` comme cible principale limiterait l'evolution dynamique. | Les menus, canoniques, sitemap et redirections pointent vers `.php` ou `/`; les anciennes URLs `.html` redirigent en 301 vers les pages PHP. |
| 2026-08-21 | Factoriser progressivement la version anglaise via un template PHP commun. | Le generateur anglais contenait le layout et les contenus dans un seul fichier, ce qui rendait l'alignement UI/UX avec la reference francaise fragile. | `app/partials/site.php` porte le chrome commun EN, `app/pages/en.php` porte les contenus par langue et `scripts/generate-en-pages.php` assemble les pages PHP plus miroirs HTML. |
| 2026-08-21 | Etendre le template commun a la version francaise sans refonte visuelle. | La version francaise reste la reference UI/UX, mais elle devait rejoindre progressivement l'architecture partagee pour eviter deux sites divergents. | Les contenus `<main>` FR vivent dans `app/pages/fr/`, `app/pages/fr.php` porte la configuration francaise et `scripts/generate-fr-pages.php` regenere les miroirs HTML canoniques. |
| 2026-09-17 | Exposer WhatsApp dans l'en-tete de toutes les pages, hors du menu deroulant. | WhatsApp est le canal de contact principal du groupe, mais il n'etait accessible que depuis le pied de page. Un visiteur mobile devait faire defiler tout le site pour le trouver. | Bouton `.nav-whatsapp` dans le gabarit commun et dans les deux pages ecrites a la main. Visible menu ferme, pastille ronde sous 640 px, contrastes WCAG AA verifies. |
| 2026-09-17 | Plafonner les images de cartes a 900 px et les visuels plein ecran a 1400 px, en ne remplacant un fichier que si le gain depasse 12 %. | Le poids penalise les connexions mobiles guineennes, mais re-encoder une image deja bien compressee degrade la qualite sans gain reel. | Accueil ramene de 2119 Ko a 1627 Ko. Les attributs `width`/`height` doivent etre recalcules a chaque retraitement, sinon la mise en page saute au chargement. |
| 2026-09-17 | Garder une seule action principale par hero et descendre « Orientation rapide » apres les secteurs. | Audit de l'accueil contre les principes Nielsen Norman Group : plusieurs appels a l'action de meme poids en haut de page diluent la decision. | Hero de la page secteurs ramene a 2 boutons. Ordre de l'accueil revu. Point faible restant : aucune preuve tierce (logos clients, etudes de cas, certifications), en attente du client. |
| 2026-09-16 | Montrer les 12 produits en grille photo sur la page « Nos secteurs », et remplacer le carrousel produits de l'accueil par une grille integralement visible. | Le client a dit ne pas voir « cacao » ni « café ». Les deux textes etaient pourtant en ligne : ils etaient enfouis dans le catalogue, absent du menu impose par le client (6 entrees, sans entree produits), et sur l'accueil une seule photo etait visible a la fois. Benchmark Olam Agri (grille, tout visible) contre ETG (carrousel, produits enfouis) dans `docs/design-ux/BENCHMARK_VISIBILITE_PRODUITS.md`. | Secteur 07 de `secteurs.php` / `sectors.php` porte 6 cartes export et 6 cartes import avec photo. L'accueil affiche un mur de 12 produits nommes. Le catalogue reste une sous-page, atteignable depuis le hero et le bas de la page secteurs, sans 7e entree de menu. |
| 2026-09-16 | Separer le sucre et les oignons en deux produits distincts. | Le client les liste en n°4 et n°5 ; le site les avait fusionnes en une carte « Sucre & oignons » illustree par une seule photo d'oignons. Le sucre n'avait aucune image. | Deux cartes produit, deux visuels, dans le catalogue et sur la page secteurs, FR et EN. |
| 2026-09-16 | Utiliser des visuels temporaires de banque d'images en attendant les medias officiels. | Demande utilisateur : le client fournira ses vraies photos plus tard, mais le site doit etre vivant maintenant. | 10 visuels ajoutes dans `assets/images/` (sucre, materiaux-construction, mais, legumes, solaire, agriculteurs, cooperative, marche, logistique-port, equipe). Tous a remplacer par les medias du client. |
| 2026-08-22 | Publier les chiffres transmis par le client meme sans verification par un tiers. | Ces chiffres viennent du client lui-meme (rizerie 200 T/jour, 70% d'energies renouvelables, 350+ emplois, 2000+ agriculteurs, importations de riz reduites de plusieurs millions USD) : les taire affaiblissait les valeurs et les engagements sans proteger personne. Cela n'annule pas la regle du 2026-08-21 : on ne cree toujours aucun chiffre nous-memes. | Les chiffres apparaissent dans les valeurs et engagements de l'accueil et de Vision & valeurs, FR et EN. Ils sont sous la responsabilite du client : a rectifier s'il revient dessus. Le siege reste ecrit « Kaloum, Conakry » alors que le client a ecrit « Kalou » : correction d'une faute de frappe probable, a confirmer avec lui. |

## Reouverture du 2026-09-13

- Maintenance retiree a la demande de Gassama pour permettre la consultation par le client.
- Seul `.htaccess` a ete envoye par FTPS apres sauvegarde ; le bloc maintenance est absent en local et en production.
- Accueil, catalogue et contact FR/EN accessibles en HTTP 200. La page `maintenance.php` reste disponible mais ne remplace plus les pages publiques.

## Maintenance temporaire du 2026-09-05

- Demande utilisateur : afficher une maintenance sobre pendant la finalisation du site, sans date de retour promise.
- `maintenance.php` fournit le message FR/EN selon l'URL, en HTTP 503 avec `Retry-After: 86400` et `Cache-Control: no-store`.
- Le bloc balise « Maintenance temporaire » dans `.htaccess` couvre les pages publiques, y compris les anciennes URL HTML. Les ressources, le back office et les protections des dossiers techniques restent accessibles selon leurs regles existantes.
- La reouverture consiste a retirer ce seul bloc de `.htaccess` et a envoyer ce fichier par FTPS. Les contenus du site ne sont pas modifies.
- Le registre `app/data/php_pages.php` inclut la page pour les prochains builds PHP. Ne pas relancer le workflow GitHub Actions historique.

## Non-objectifs

- Ne pas inventer de stack technique sans cadrage.
- Publier sur GitHub après chaque étape validée par l'utilisateur.

## Questions ouvertes

- Quelle stack utiliser pour le nouveau site ?
- Le premier back office doit gerer les activites/realisations de l'entreprise, avant un back office complet.
- Quelle adresse e-mail officielle doit remplacer les contacts incoherents ?
- Quels liens reseaux sociaux sont officiels ?
- Quels contenus, images, certifications et chiffres sont valides par le client ?
- Remplacer les medias issus du site actuel par des medias officiels si le client les fournit.
- Brancher les realisations dynamiques en anglais quand le client aura fourni les contenus officiels.
- Continuer a reduire les differences purement historiques de markup entre FR et EN, en gardant la FR comme reference visuelle.
- Le siege est-il « Kaloum » ou « Kalou » ? Le client a ecrit « Kalou Conakry », le site publie « Kaloum, Conakry ».
