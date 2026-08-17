# Benchmark SGS France — et plan d'execution pour Groupe Babia

Reference analysee : <https://www.sgs.com/fr-fr> (SGS France, leader mondial du testing,
inspection et certification). Analyse du 2026-08-17.

## Methode et limites

Le site refuse les requetes automatisees simples (HTTP 403). L'analyse a ete faite sur le
DOM rendu par un navigateur, puis sur les donnees de page (`__NEXT_DATA__`) qui exposent
l'arborescence reelle des composants. Ce qui est decrit ci-dessous est donc **structurel et
verifie**, pas suppose.

Ce qui n'a **pas** pu etre mesure : les valeurs exactes de la charte (echelle typographique,
couleurs, grille), la feuille de style n'ayant pas ete servie au navigateur automatise. Les
recommandations visuelles restent donc au niveau des principes, pas des pixels.

Point de vigilance avant de lire la suite : **SGS n'est pas un modele a copier tel quel**.
C'est un groupe de plus de 90 000 personnes, present dans 92 pays, avec un catalogue de
plusieurs milliers de services et une redaction permanente. Groupe Babia a 8 pages et trois
poles. Reprendre l'architecture de SGS a l'identique produirait une coquille vide. La section
« Ce qu'il ne faut pas reprendre » est aussi importante que le reste.

## 1. Ce que fait SGS

### 1.1 Architecture de navigation

En-tete, dans l'ordre :

| Element | Type | Detail |
| --- | --- | --- |
| Services | Bouton (mega-menu) | Entree par metier |
| Secteurs | Bouton (mega-menu) | Entree par industrie du client |
| Megatendances | Bouton (mega-menu) | Entree editoriale (durabilite, transition, etc.) |
| Notre entreprise | Bouton (mega-menu) | Corporate, carrieres, gouvernance |
| Investisseurs | Lien direct | `/fr-fr/investors` |
| Actualites | Lien direct | `/fr-fr/actualites-et-ressources` |
| Nous contacter | Lien direct | `/fr-fr/contact-form` |
| Rechercher | Bouton | Ouvre une surcouche de recherche plein ecran |
| Changer de lieu | Bouton | Selecteur pays/langue |

Le principe fort : **on entre par son besoin, pas par l'organigramme du groupe**. « Services »
et « Secteurs » sont deux portes vers le meme catalogue — l'une pour qui sait ce qu'il veut,
l'autre pour qui sait seulement dans quelle industrie il travaille.

### 1.2 Structure de la page d'accueil

De haut en bas :

1. **Hero rotatif pilote par l'actualite.** Cinq teasers, tous des actualites reelles et
   datees : extension d'un laboratoire, nouvelles lignes directrices PPWR de la Commission
   europeenne, exigences de surete portuaire, extension d'accreditation COFRAC, remboursement
   des protections menstruelles reutilisables. Un seul CTA transverse : « A propos de SGS ».
   Le hero n'est pas decoratif — c'est la preuve que l'entreprise bouge.
2. **« Solutions Adaptees ».** Sept cartes de services concrets et nommes : analyse des huiles
   usagees, biosimilaires, certification Qualicert, ISO 9001/14001, tracabilite alimentaire,
   evaluation des risques produit, Qualiopi. Aucun slogan — que des offres identifiables.
3. **« Nos Activites ».** Second bloc de teasers, entree par domaine.
4. **Bandeau recrutement pleine largeur.** Image de fond, accroche « Travaillons ensemble »,
   texte « Rechercher des offres, s'inscrire aux alertes-emploi et postuler », CTA « Offres
   d'emploi ». Le recrutement est traite comme une conversion a part entiere.
5. **« Vous cherchez quelque chose de precis ? »** Recherche pre-filtree en bas de page, pour
   rattraper le visiteur qui n'a rien trouve dans le parcours guide.

### 1.3 Recherche

Deux points d'entree : l'icone d'en-tete (surcouche plein ecran, champ « Que cherchez-vous ? »
avec suggestions « Rubriques qui pourraient vous interesser ») et le bloc de bas de page.
La recherche est traitee comme une navigation de premier rang, pas comme un utilitaire.

### 1.4 International

**92 couples pays/langue**, 23 langues distinctes, exposes par un selecteur present a la fois
en en-tete et en pied de page. Chaque marche a son URL (`/fr-fr`, `/en-au`, `/pt-ao`…).

### 1.5 Pied de page

Deux niveaux nettement separes :

- **Services utilitaires** : Carrieres chez SGS, **Verifiez les documents SGS**, **Annuaire des
  bureaux**, S'abonner (newsletter).
- **Legal** : Mentions Legales, Conditions Generales, Conditions d'Acces, Politique cookies,
  Confidentialite.

« Verifiez les documents SGS » est le detail le plus instructif : c'est un outil anti-fraude
qui permet a un acheteur de verifier l'authenticite d'un certificat. Toute la valeur de SGS
tient a la confiance, et le pied de page l'outille concretement.

## 2. Ecarts avec le site Groupe Babia

Etat du site apres la passe UX du 2026-08-17.

| Sujet | SGS | Groupe Babia | Ecart |
| --- | --- | --- | --- |
| Entree dans l'offre | Par service **et** par secteur client | Par pole interne uniquement | Fort |
| Preuve d'activite | Hero pilote par 5 actualites datees | 3 cartes evergreen sans date | **Critique** |
| Preuve de fiabilite | COFRAC, ISO, Qualiopi cites nommement | Engagements en prose, aucune reference verifiable | **Critique** |
| Recherche | Deux points d'entree, suggestions | Aucune | Moyen |
| International | 92 marches, selecteur en-tete + pied | FR uniquement, aucun selecteur | Fort |
| Recrutement | Bandeau dedie + alertes-emploi | Absent | Moyen |
| Contact | Formulaire + annuaire des bureaux | Formulaire + coordonnees | Faible |
| Legal | 5 pages | 2 pages | Faible |
| Newsletter | Abonnement en pied de page | Absent | Faible |

## 3. Ce qu'il faut reprendre

1. **Le hero comme preuve de vie**, pas comme decor. Aujourd'hui le hero de Babia fait defiler
   trois images de secteur. Chez SGS il fait defiler cinq faits datables. C'est ce qui separe
   une plaquette d'une entreprise active.
2. **La double entree service / secteur.** Pour Babia : entree par produit (cacao, cafe, cajou)
   **et** par profil d'acheteur (importateur, distributeur, transformateur, maitre d'ouvrage).
3. **La preuve nommee.** Remplacer « Tracabilite » et « Fiabilite » par des elements
   verifiables : numero RCCM, agrement d'exportateur, incoterms pratiques, ports de depart,
   capacite mensuelle, references de chantiers livres.
4. **Le bilingue traite comme une porte, pas comme un bouton.** Le cahier des charges signale
   deja une version anglaise incomplete sur le site actuel. Les acheteurs export lisent en
   anglais.
5. **Le pied de page utilitaire.** Un acheteur doit pouvoir, depuis le pied de page, trouver
   ou est l'entreprise et comment verifier qu'elle est reelle.

## 4. Ce qu'il ne faut pas reprendre

- **Le mega-menu a quatre entrees.** Avec 8 pages, un mega-menu donne l'impression d'un site
  vide. La navigation actuelle a plat est adaptee et doit le rester tant que le catalogue ne
  depasse pas une vingtaine de pages.
- **Le moteur de recherche.** Sur 11 pages statiques, une recherche coute cher (index, JS) et
  ne sert personne. A reconsiderer seulement si le catalogue depasse ~50 fiches.
- **Les 92 marches.** Deux langues suffisent : FR et EN.
- **La rubrique Investisseurs.** Babia n'est pas cotee.
- **Le ton institutionnel neutre de SGS.** SGS vend de la neutralite d'expertise. Babia vend
  un ancrage guineen et un acces a des filieres locales. Copier le ton effacerait le seul
  avantage differenciant.

## 5. Plan d'execution pour Codex

Contraintes a respecter (voir `AGENTS.md`) : ne pas depasser le perimetre, aucune dependance
nouvelle, site statique HTML/CSS/JS, pas de commit ni de push sans demande explicite.

Ordre impose : **P0 avant P1 avant P2.** Chaque lot est livrable seul.

### P0-1 — Actualites reelles et datees

**Pourquoi :** c'est l'ecart le plus couteux en credibilite. Le site actuel affiche trois
cartes intemporelles ; le site actuel en production affiche un unique article d'aout 2025.

**Fichiers :** `actualites.html`, `index.html`, `assets/css/styles.css`

**A faire :**
1. Dans `actualites.html`, transformer chaque `.news-card` en `<article>` portant une date
   machine : `<time datetime="2026-07-14">14 juillet 2026</time>` placee au-dessus du `<h3>`,
   dans le meme bloc que le `<small>` de rubrique.
2. Ajouter une classe `.news-date` (couleur `var(--muted)`, `font-size: .82rem`,
   `font-weight: 700`) et l'inserer dans `styles.css` a cote des regles `.news-card`.
3. Trier les articles du plus recent au plus ancien.
4. Ajouter en tete de `actualites.html` un encart `.quote-hint` indiquant la frequence de
   publication visee, tant que le volume est faible.
5. Sur `index.html`, la section « A la une » doit reprendre les **trois articles les plus
   recents** avec leur date, et non des liens generiques vers `catalogue.html` / `btp.html`.

**Critere d'acceptation :** chaque carte d'actualite porte un `<time datetime>` valide ;
l'accueil et la page actualites affichent les memes trois articles en tete.

**Bloquant :** les contenus reels doivent venir du client. Si indisponibles, produire la
structure avec trois articles explicitement marques `<!-- CONTENU A VALIDER CLIENT -->` et
le signaler dans le rapport de fin — ne pas inventer de faits datables.

### P0-2 — Preuves verifiables a la place des engagements en prose

**Fichiers :** `groupe.html`, `agroalimentaire.html`, `btp.html`, `mines.html`, `index.html`

**A faire :**
1. Sur `groupe.html`, remplacer les metriques `GN` et `AO` de `.metric-grid` — illisibles pour
   un acheteur — par des donnees factuelles : annee de creation, nombre de collaborateurs,
   nombre de pays servis, capacite d'expedition mensuelle.
2. Creer une section `.section` « References et conformite » sur `groupe.html` listant, en
   `.tag-list`, les elements verifiables fournis par le client : RCCM, NIF, agrement
   exportateur, appartenance a une chambre de commerce, certifications produits.
3. Sur `agroalimentaire.html`, ajouter dans `.content-panel` les informations qu'un
   importateur cherche en premier : incoterms pratiques (FOB, CIF), ports de depart
   (Conakry), delais indicatifs, conditionnements standards.
4. Remplacer, dans `.commitment-grid` de `index.html`, les quatre intitules abstraits par des
   engagements chiffres ou datables (delai de reponse a une demande, delai de cotation).

**Critere d'acceptation :** aucune affirmation de la section engagements n'est invérifiable ;
tout element non fourni par le client est marque `<!-- A VALIDER CLIENT -->` plutot qu'invente.

### P0-3 — Pied de page utilitaire

**Fichiers :** les 11 pages `.html`, `assets/css/styles.css`

**A faire :**
1. Ajouter une quatrieme colonne `.footer-columns` « Informations » : adresse postale
   complete, horaires d'ouverture, lien « Nous situer » (carte statique ou lien Google Maps).
2. Le pied de page etant desormais pleine largeur, verifier que `.footer-columns` passe bien
   a `repeat(4, ...)` au-dessus de 980 px et reste lisible entre 640 et 980 px.
3. Modifier le pied de page **sur les 11 pages** — il est duplique. Utiliser un script Python
   ponctuel plutot que 11 editions manuelles, comme pour la passe UX precedente.

**Critere d'acceptation :** les 11 pages ont un pied de page identique au caractere pres.

### P1-1 — Entree par profil d'acheteur

**Fichiers :** `index.html`, `catalogue.html`, `assets/js/main.js`, `assets/css/styles.css`

**A faire :**
1. Sur `index.html`, inserer entre `.trust-strip` et `.intro-section` une section
   « Vous etes… » avec quatre cartes : Importateur / distributeur, Transformateur
   industriel, Maitre d'ouvrage BTP, Operateur minier. Chaque carte pointe vers la page de
   pole avec le parametre de besoin deja en place :
   `contact.html?besoin=agro|btp|mines|corporate`.
2. Sur `catalogue.html`, ajouter un second axe de filtre a cote du filtre operation existant :
   filtrer par usage (`data-usage="transformation|distribution|detail"`) sur les
   `article.product-card`.
3. Dans `main.js`, la fonction `applyFilter` gere aujourd'hui un seul axe. La generaliser pour
   croiser deux criteres : une carte est visible si elle satisfait **les deux** filtres actifs.
   Conserver le compteur `.filter-count` et l'etat vide `[data-filter-empty]` deja en place.

**Critere d'acceptation :** croiser « Exportation » et « Transformation » n'affiche que les
cartes correspondantes ; l'etat vide s'affiche quand le croisement ne donne rien ; le compteur
annonce le bon total.

**Attention :** les compteurs par filtre sont actuellement calcules une fois au chargement
(`countFor`). Avec deux axes ils doivent etre recalcules a chaque changement, sinon ils
mentiront.

### P1-2 — Version anglaise

**Fichiers :** nouveau dossier `en/`, les 11 pages `.html`, `assets/css/styles.css`

**A faire :**
1. Creer `en/` avec les 11 pages traduites. Les chemins d'assets deviennent `../assets/…`.
2. Ajouter dans chaque `<head>` les alternances de langue :
   `<link rel="alternate" hreflang="fr" href="…">`, `hreflang="en"`, `hreflang="x-default"`.
3. Ajouter dans `.site-header`, avant `.nav-cta`, un selecteur `FR | EN` : deux liens, celui
   de la langue courante portant `aria-current="true"`. Cible tactile de 44 px minimum, comme
   le reste de la barre.
4. Le meme selecteur en pied de page.
5. Traduire aussi les chaines de `main.js` — elles sont aujourd'hui en dur en francais
   (messages de notification, erreurs de formulaire, libelles « Ajouter au devis »). Les
   regrouper dans un objet `MESSAGES` en tete de fichier, choisi selon
   `document.documentElement.lang`.

**Critere d'acceptation :** depuis n'importe quelle page FR, un clic sur EN mene a la page
equivalente en anglais, et inversement ; aucune chaine francaise ne subsiste sur `/en/`,
y compris dans les notifications JavaScript.

**Charge :** c'est le lot le plus lourd. Ne pas le demarrer avant validation des contenus FR
definitifs, sinon la traduction sera a refaire.

### P1-3 — Bandeau recrutement

**Fichiers :** `index.html`, `groupe.html`, `assets/css/styles.css`

**A faire :** ajouter une section reprenant le style `.contact-band` existant, avec accroche,
description et CTA vers `contact.html?besoin=corporate`. Ne pas creer de page carrieres tant
qu'il n'y a pas d'offres reelles a publier.

### P2-1 — Newsletter

Bloc d'abonnement en pied de page. **Sans backend, cela ne peut pas fonctionner** : prevoir
soit un `mailto:` avec objet pre-rempli, soit differer ce lot jusqu'a l'arbitrage sur la
stack. Ne pas livrer un champ qui ne collecte rien.

### P2-2 — Pages legales complementaires

Ajouter `conditions-generales.html` (conditions generales de vente/prestation) sur le modele
de `mentions-legales.html`. Contenu a fournir par le client — ne pas rediger de clauses
juridiques sans validation.

## 6. Verification attendue a chaque lot

```bash
# Syntaxe JS
node --check assets/js/main.js

# Serveur local
python3 -m http.server 4173

# Toutes les pages en 200 et aucune requete 404
# (verifier le journal du serveur apres avoir charge chaque page)
```

Points a controler manuellement :

- rendu mobile (390 px), tablette (768 px) et desktop (1440 px) ;
- parcours complet catalogue → selection → contact avec la selection reprise ;
- navigation au clavier seul, du lien d'evitement jusqu'au pied de page ;
- pied de page identique sur les 11 pages.

## 7. Ce qui reste bloque cote client

Ces points bloquent P0 et doivent etre remontes avant de commencer :

- contenus d'actualites reels et datables ;
- elements de conformite verifiables (RCCM, NIF, agrements, certifications) ;
- adresse postale complete et horaires ;
- adresse e-mail officielle unique — le site utilise encore `infobabiaguinee@gmail.com`,
  signale comme incoherent des l'audit initial ;
- comptes reseaux sociaux officiels ;
- medias haute definition : `btp.jpg` fait 626x417 px pour un usage plein ecran, et cinq
  produits du catalogue n'ont aucune photo.
