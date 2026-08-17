# Migration PHP avec generation statique — plan d'execution

Decision du 2026-08-17 : le site est ecrit en PHP, mais **publie sous forme de HTML
genere**, afin que le lien de demonstration client reste disponible sur GitHub Pages tant
que l'hebergement n'est pas arbitre. Ce document est le plan d'execution destine a Codex.

## 1. Le probleme et la solution retenue

### 1.1 Contrainte

GitHub Pages **n'execute pas PHP**. Il ne sert que des fichiers statiques. Un `.php` depose
sur Pages est renvoye en texte brut ou en 404, jamais interprete.

Or le client dispose aujourd'hui d'un lien actif :
**<https://gaslandie.github.io/groupe-babia/>** (publie depuis la branche `main`, racine du
depot, avec `404.html` deja pris en compte). Renommer les pages en `.php` casserait ce lien.

### 1.2 Solution

On separe **le langage d'ecriture** du **format de publication** :

- on ecrit en PHP : gabarits, partials, donnees, traductions ;
- un script `build.php` genere le HTML de toutes les pages, dans les deux langues ;
- une GitHub Action reconstruit et republie a chaque `push` ;
- le lien client reste a jour sans intervention manuelle.

Le jour ou l'hebergeur PHP est choisi, **les memes fichiers sont servis directement**, sans
generation. Aucun travail n'est jete : la generation devient simplement inutile, et le
formulaire de contact passe en envoi serveur reel.

### 1.3 Ce que cette voie ne permet pas encore

**Le formulaire de contact reste en `mailto:` + WhatsApp**, comme aujourd'hui. Un site
statique ne peut pas traiter un `POST`. Les replis mis en place lors de la passe UX du
2026-08-17 (statut d'envoi, copie du message, WhatsApp) restent donc necessaires.

C'est le seul point ou l'on n'avance pas. Tout le reste — factorisation, catalogue en
donnees, version anglaise — se fait normalement.

### 1.4 Ce que cette voie debloque

| Sujet | Aujourd'hui | Apres |
| --- | --- | --- |
| En-tete et pied de page | Dupliques 11 fois | Un seul fichier `partials/` |
| Version anglaise | 22 fichiers HTML a maintenir | 11 gabarits + 2 fichiers de traduction |
| Catalogue | 11 fiches ecrites en dur | Un tableau de donnees, une boucle |
| Actualites | Cartes ecrites a la main | Un tableau trie par date |
| Publication | Manuelle | Automatique a chaque `push` |

Mesure sur le depot actuel : le pied de page est identique sur 9 pages (2 variantes de
simple formatage), l'en-tete ne differe que par le lien actif. **Environ 40 % des
1 885 lignes de HTML sont de la duplication pure.**

## 2. Prerequis poste de travail

**PHP n'est pas installe sur la machine de developpement** (verifie le 2026-08-17 :
`php: command not found`). Sans lui, ni le build ni le test de non-regression ne tournent.

```bash
sudo apt install php-cli
php -v
```

Fait le 2026-08-17 : **PHP 8.5.4** installe et fonctionnel.

**Ecrire le code en visant PHP 8.1**, pas 8.5. Les hebergements mutualises tournent
couramment en 8.1 ou 8.2 ; du code utilisant une nouveaute de 8.3+ passerait en local et
echouerait a la mise en ligne. Concretement : pas de constantes typees dans les traits, pas
de `json_validate()`, pas de nouveaux modificateurs de propriete. En cas de doute, s'en
tenir a la syntaxe 8.0.

## 3. Architecture cible

Pas de framework, pas de Composer, pas de dependance — conforme a `AGENTS.md`.

```text
site-web/
  build.php                <- genere dist/ ; unique point d'entree du build
  app/
    config.php             <- URL de base, e-mail, WhatsApp, langues
    helpers.php            <- e(), t(), asset(), url(), alternate()
    lang/
      fr.php  en.php
    data/
      products.php         <- catalogue, source unique de verite
      news.php             <- actualites datees
      navigation.php       <- structure du menu
    pages/
      accueil.php  groupe.php  agroalimentaire.php  btp.php  mines.php
      catalogue.php  actualites.php  contact.php
      mentions-legales.php  confidentialite.php  erreur-404.php
    partials/
      head.php  header.php  footer.php
      page-hero.php  product-card.php  news-card.php  quote-dock.php
  assets/                  <- inchange : css, js, images
  dist/                    <- SORTIE GENEREE, dans .gitignore
  docs/
.github/workflows/build.yml
```

### 3.1 Sortie generee

```text
dist/
  index.html  groupe.html  agroalimentaire.html  btp.html  mines.html
  catalogue.html  actualites.html  contact.html
  mentions-legales.html  confidentialite.html  404.html
  assets/                <- copie de assets/
  en/
    index.html  group.html  ...   <- memes pages, en anglais
```

Les URLs publiques restent donc **exactement celles d'aujourd'hui** en francais. Aucun lien
deja partage ne casse. L'anglais s'ajoute sous `/en/`.

### 3.2 Chemins relatifs — point de vigilance

GitHub Pages sert le site depuis le sous-chemin **`/groupe-babia/`**, pas depuis la racine
du domaine. Toute URL absolue commencant par `/` sera cassee.

- Les chemins d'assets doivent rester **relatifs** : `assets/css/styles.css` a la racine,
  `../assets/css/styles.css` depuis `/en/`.
- Un helper `asset($chemin)` doit calculer le prefixe selon la profondeur de la page
  generee. Ne pas ecrire les chemins a la main dans les gabarits.
- Les `hreflang` exigent en revanche des URLs **absolues** : les construire a partir d'une
  constante `BASE_URL` dans `config.php`, qui vaudra
  `https://gaslandie.github.io/groupe-babia/` aujourd'hui et le domaine final plus tard.

C'est le piege le plus probable de cette migration. Un test de chargement d'assets depuis
`/en/` fait partie des criteres d'acceptation du lot 3.

## 4. Les lots

### Lot 0 — Socle PHP a rendu identique

**Regle absolue : aucun changement visuel.** La passe UX du 2026-08-17 (heros corriges,
parcours de devis, validation du formulaire, accessibilite, pied de page pleine largeur)
vit dans la structure HTML. Ce lot deplace du code, il n'en modifie pas le rendu.

**A faire :**

1. Creer l'arborescence de la section 3. Ne pas toucher a `assets/`.
2. Extraire `partials/head.php` — parametres : titre, description, langue, page courante.
3. Extraire `partials/header.php` — parametre : page courante, pour `is-active` et
   `aria-current="page"`.
4. Extraire `partials/footer.php` — aucun parametre.
5. Extraire `partials/page-hero.php` — parametres : image, largeur, hauteur, fil d'Ariane,
   surtitre, titre, texte, boutons, encart lateral.
6. Convertir les 11 pages en `app/pages/*.php` : le contenu de `<main>` uniquement.
7. Ecrire `build.php` : pour chaque page, `ob_start()`, inclusion, ecriture dans `dist/`.
   Copier `assets/` dans `dist/assets/`. Le script doit etre **idempotent** : deux
   executations successives produisent des fichiers identiques.
8. Ajouter `dist/` a `.gitignore`.

**Critere d'acceptation — automatisable et non negociable :** le HTML genere doit etre
identique au HTML actuel, aux espaces pres.

```bash
php build.php

for p in index groupe agroalimentaire btp mines catalogue actualites contact \
         mentions-legales confidentialite 404; do
  a=$(tr -s ' \n\t' ' ' < "${p}.html"      | sed 's/> </></g')
  b=$(tr -s ' \n\t' ' ' < "dist/${p}.html" | sed 's/> </></g')
  if [ "$a" = "$b" ]; then echo "OK   ${p}"; else
    echo "DIFF ${p}"
    diff <(echo "$a" | fold -w120) <(echo "$b" | fold -w120) | head -20
  fi
done
```

Tant que ce test ne passe pas sur les 11 pages, le lot 0 n'est pas termine. **Les `.html`
d'origine ne sont pas supprimes dans ce lot** — ils servent de reference et maintiennent le
lien client en ligne.

**A ne pas faire ici :** ameliorer quoi que ce soit, renommer des classes, « nettoyer » le
balisage. Toute amelioration rend le test de non-regression inutilisable, et c'est lui qui
garantit qu'aucun acquis UX n'est perdu.

### Lot 1 — Publication automatique

**Depend de :** lot 0 vert.

Objectif : que le client ne voie jamais le site tomber pendant la bascule.

**Ordre imperatif — le respecter evite une coupure :**

1. Ajouter `.github/workflows/build.yml` :

```yaml
name: Build et publication
on:
  push:
    branches: [main]
  workflow_dispatch:

permissions:
  contents: read
  pages: write
  id-token: write

concurrency:
  group: pages
  cancel-in-progress: true

jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Version de PHP
        run: php -v
      - name: Generer le site
        run: php build.php
      - uses: actions/configure-pages@v5
      - uses: actions/upload-pages-artifact@v3
        with:
          path: dist
  deploy:
    needs: build
    runs-on: ubuntu-latest
    environment:
      name: github-pages
      url: ${{ steps.deployment.outputs.page_url }}
    steps:
      - id: deployment
        uses: actions/deploy-pages@v4
```

   PHP est preinstalle sur les runners `ubuntu-latest` : inutile d'ajouter une action de
   configuration tant que la version convient. L'etape `php -v` sert a le tracer.

2. Committer et pousser. Le workflow echouera au deploiement tant que l'etape 3 n'est pas
   faite — c'est attendu. Verifier que **l'etape de build, elle, passe**.
3. Basculer la source de GitHub Pages de la branche vers GitHub Actions :
   `Settings > Pages > Source > GitHub Actions`.
4. Relancer le workflow et **verifier la page en ligne**.
5. **Seulement alors**, supprimer les `*.html` de la racine du depot.

**Retour arriere :** si l'etape 4 echoue, remettre `Settings > Pages > Source > Deploy from
a branch > main / (root)`. Les `.html` sont encore la, le site revient immediatement. C'est
pour cela qu'on ne les supprime qu'a l'etape 5.

**Critere d'acceptation :** un `push` sur `main` met a jour
<https://gaslandie.github.io/groupe-babia/> sans aucune action manuelle, et la page 404
fonctionne toujours.

### Lot 2 — Donnees centralisees

**Depend de :** lot 0.

1. `app/data/products.php` retourne les 13 produits. Champs : `id`, `slug`, `categorie`
   (`exportation` / `importation`), `image`, `largeur`, `hauteur`, `cle_nom`,
   `cle_description`, `tags`. **Les libelles sont des cles de traduction, pas du texte** —
   c'est ce qui rendra le lot 3 mecanique.
2. `app/data/news.php` : actualites avec date ISO, triees du plus recent au plus ancien.
3. `app/data/navigation.php` : entrees de menu.
4. `partials/product-card.php` et `partials/news-card.php` rendent une entree.
5. `catalogue.php` et `actualites.php` bouclent sur les donnees.

**Critere d'acceptation :** le test du lot 0 passe toujours. Ajouter un produit au tableau
le fait apparaitre dans la grille **et** dans les compteurs de filtres, sans toucher au
balisage.

**Piege connu :** les compteurs `.filter-count` sont aujourd'hui calcules en JavaScript au
chargement, une seule fois. Ils doivent venir de PHP, sinon ils resteront justes par hasard
et mentiront des que le catalogue evoluera.

### Lot 3 — Internationalisation et version anglaise

**Depend de :** lots 0 et 2.

1. `app/lang/fr.php` et `app/lang/en.php` retournent un tableau plat.
   Convention de cle : `page.section.element`, par exemple `catalogue.hero.titre`.
2. `t($cle)` retourne la traduction. Cle manquante : retourner la cle **et emettre un
   avertissement qui fait echouer le build**. Ne jamais retomber silencieusement sur le
   francais, sinon des fragments francais partiront en production sans que personne ne le
   voie.
3. Remplacer le texte des gabarits par des appels a `t()`.
4. `build.php` genere chaque page dans les deux langues : racine pour le francais, `en/`
   pour l'anglais.
5. Selecteur de langue dans l'en-tete, avant « Demander un devis », et repris en pied de
   page. Deux liens `FR` / `EN`, celui de la langue courante avec `aria-current="true"`,
   cible tactile de 44 px minimum. **Le selecteur doit mener a la page equivalente**, pas a
   l'accueil.
6. Dans `<head>` : `<html lang="fr|en">` et les `<link rel="alternate" hreflang>` en URLs
   absolues construites depuis `BASE_URL`.
7. **Chaines JavaScript.** `assets/js/main.js` contient une quinzaine de chaines francaises
   en dur : notifications, erreurs de formulaire, libelles « Ajouter au devis » /
   « Ajoute au devis », resume de selection, corps des messages e-mail et WhatsApp. Les
   faire emettre par le build dans la langue de la page :

```php
<script>window.BABIA = <?= json_encode([
  'lang'     => $lang,
  'messages' => $messages['js'],
], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?>;</script>
```

   `JSON_HEX_TAG` est obligatoire : sans lui, une chaine contenant `</script>` casse la
   page. Dans `main.js`, remplacer les litteraux par `window.BABIA.messages.*` avec un repli
   si l'objet est absent.
8. Pages legales traduites en anglais comme le reste du site. **Ajouter en fin de page une
   mention indiquant que la version francaise prevaut en cas de divergence** — une ligne,
   dans les deux langues. C'est la pratique courante et cela evite qu'une nuance de
   traduction devienne opposable.

### 3 bis — Detection de la langue du navigateur

**Decision du 2026-08-17 : suggerer la langue, ne jamais la forcer.**

L'intention — eviter qu'un acheteur anglophone tombe sur une page francaise — est juste.
Mais une redirection automatique sur la langue du navigateur pose quatre problemes reels,
d'autant plus sur un site statique ou la detection ne peut se faire qu'en JavaScript, apres
chargement :

- **Referencement.** Google deconseille explicitement la redirection automatique fondee sur
  la langue percue : elle empeche les utilisateurs et les robots de voir toutes les versions
  du site. Sur un site dont l'enjeu est la visibilite export, c'est un cout direct.
- **Piege du bouton retour.** L'utilisateur clique sur `FR`, la redirection le ramene en
  `EN`, il ne peut plus en sortir. C'est le defaut classique de ce mecanisme.
- **Scintillement.** La page francaise s'affiche, puis bascule : mauvaise impression et
  aller-retour inutile.
- **`navigator.language` n'est pas une preference de contenu.** C'est la langue de
  l'interface du navigateur. Un acheteur guineen sous Windows anglophone peut vouloir lire
  en francais, et l'inverse est tout aussi frequent.

**Comportement retenu :**

1. La langue par defaut du site reste le **francais**. `hreflang="x-default"` pointe vers la
   version francaise.
2. Aucune redirection automatique, jamais. L'URL demandee est servie telle quelle.
3. Au **premier chargement seulement**, si la langue preferee du navigateur differe de celle
   de la page, afficher une **banniere discrete et non bloquante** sous l'en-tete :
   « This page is also available in English → View in English ».
4. La banniere lit l'URL de destination dans la balise `hreflang` deja presente en `<head>`
   — aucune logique d'URL dupliquee.
5. Tout choix explicite — clic sur la banniere, sur sa fermeture, ou sur le selecteur de
   langue — est memorise dans `localStorage` et la banniere ne reapparait plus.

```js
const CHOIX = "babia:lang";
if (!localStorage.getItem(CHOIX)) {
  const languePage = document.documentElement.lang;
  const preferees = (navigator.languages || [navigator.language]).map((l) => l.split("-")[0]);
  const trouvee = preferees.find((l) => ["fr", "en"].includes(l));
  if (trouvee && trouvee !== languePage) {
    const alt = document.querySelector(`link[rel="alternate"][hreflang="${trouvee}"]`);
    if (alt) afficherBanniere(trouvee, alt.href);
  }
}
```

**Criteres d'acceptation :**

- ouvrir `/en/catalogue` avec un navigateur configure en francais **ne redirige pas** ;
- apres un clic sur le selecteur de langue, la banniere ne reapparait sur aucune page ;
- la banniere possede un bouton de fermeture, cible tactile de 44 px, et sa fermeture vaut
  choix explicite ;
- JavaScript desactive : aucune banniere, aucune degradation, le selecteur reste utilisable.

**Criteres d'acceptation :**

```bash
# 1. Aucune chaine francaise residuelle en anglais
grep -riE "devis|produit|sélection|Ajouter|Accueil" dist/en/ && echo "ECHEC" || echo "OK"

# 2. Les assets se chargent bien depuis /en/ (chemins relatifs)
grep -o 'href="[^"]*styles.css"' dist/en/index.html   # attendu : ../assets/css/styles.css

# 3. Aucune URL absolue de type "/assets" qui casserait le sous-chemin Pages
grep -rn 'src="/\|href="/assets' dist/ && echo "ECHEC" || echo "OK"
```

Et manuellement : depuis n'importe quelle page FR, le selecteur mene a la page equivalente
EN, et inversement.

### Lot 4 — Formulaire serveur (differe)

**Bloque par l'hebergement.** A traiter le jour ou un hebergeur PHP est retenu. Le contenu
de ce lot est conserve ici pour memoire :

POST-redirect-GET, validation serveur complete, jeton CSRF, anti-spam sans service externe
(champ leurre + controle de duree), suppression de `\r` et `\n` dans tout champ repris en
en-tete de mail (sans quoi le formulaire devient un relais a spam), et **jamais l'adresse du
visiteur en `From`** — `Reply-To` seulement, sinon rejet SPF/DKIM et passage en spam.

En attendant, le `mailto:` et ses replis restent en place.

### Lot 5 — Mise en ligne sur hebergeur PHP (differe)

Servir `app/` directement au lieu de generer, corriger la mention d'hebergeur dans les
mentions legales — **c'est une obligation legale**, le site annonce aujourd'hui GitHub Pages
—, redirections 301, en-tetes de securite, `display_errors = Off`, et verification que
`app/` n'est pas accessible en HTTP.

## 5. Ordre conseille

1. Lot 0 — socle PHP, rendu identique
2. Lot 1 — publication automatique
3. Lot 2 — donnees centralisees
4. P0 du benchmark SGS (actualites datees, preuves verifiables, pied de page utilitaire) —
   devient beaucoup plus simple une fois le lot 2 fait
5. Lot 3 — version anglaise
6. Lots 4 et 5 quand l'hebergement est arbitre

## 6. Ce qui ne doit pas se perdre en route

La passe UX du 2026-08-17 a corrige des defauts invisibles dans un diff de code. A verifier
explicitement apres migration :

- les heros des pages internes affichent leur image — le bug venait d'une URL relative
  resolue par rapport a la feuille de style ;
- le panneau de devis n'apparait qu'a partir d'un produit selectionne ;
- la selection du catalogue survit au passage vers la page contact ;
- lien d'evitement, piege de focus du menu mobile, cibles tactiles de 44 px ;
- bouton pause du hero et cadence de 7 secondes ;
- pied de page pleine largeur, identique sur toutes les pages.

Detail dans `docs/design-ux/AUDIT_UI_UX.md`.

## 7. Articulation avec le benchmark SGS

`docs/design-ux/BENCHMARK_SGS.md` decrit les evolutions de contenu et de parcours. Sa
priorite **P1-2 « Version anglaise » est remplacee par le lot 3 du present document** : elle
y etait decrite en duplication de fichiers HTML, ce qui n'a plus lieu d'etre.

Ses priorites P0 restent valables et deviennent plus simples apres le lot 2.

## 8. Decisions encore ouvertes

Aucune ne bloque les lots 0 a 3.

| # | Decision | Impact | Recommandation |
| --- | --- | --- | --- |
| 1 | Qui traduit | Une traduction automatique sur un site export institutionnel se voit | Traducteur humain, ou au minimum relecture |
| 2 | Hebergeur PHP | Bloque les lots 4 et 5 uniquement | A arbitrer plus tard, comme convenu |
| 3 | Adresse e-mail officielle | L'expediteur devra etre sur le domaine ; `infobabiaguinee@gmail.com` ne conviendra pas en `From` | `contact@groupebabia.com` |

### Decisions prises le 2026-08-17

- **Langue par defaut : francais**, avec suggestion non bloquante si le navigateur est
  configure autrement. Detail au lot 3, section « Detection de la langue du navigateur ».
- **Pages legales bilingues**, avec mention que la version francaise prevaut en cas de
  divergence.
- **Cible PHP 8.1** malgre un PHP 8.5 en local, pour ne pas dependre de l'hebergeur.
