# Migration PHP et version anglaise — plan d'execution

Decision du 2026-08-17 : le site passe de HTML statique a PHP, et la version anglaise
demarre. Ce document est le plan d'execution destine a Codex.

## 1. Ce que la decision change

### 1.1 Ce qu'elle debloque

| Sujet | Aujourd'hui | Avec PHP |
| --- | --- | --- |
| En-tete et pied de page | Dupliques 11 fois | Un seul fichier `partials/` |
| Formulaire de contact | `mailto:` qui echoue silencieusement si aucun client mail | Envoi serveur reel, avec accuse de reception |
| Version anglaise | 11 fichiers HTML a dupliquer, soit 22 a maintenir | 11 gabarits + 2 fichiers de traduction |
| Catalogue | 11 fiches ecrites en dur dans le HTML | Un tableau de donnees, une seule boucle |
| Actualites | Cartes ecrites a la main | Un tableau trie par date |

Mesure sur le depot actuel : le pied de page est identique sur 9 pages (2 variantes de
simple formatage), l'en-tete ne differe que par le lien actif. **Environ 40 % des
1 885 lignes de HTML sont de la duplication pure.**

### 1.2 Ce qu'elle casse — a arbitrer avant la mise en ligne

**GitHub Pages ne sert pas PHP.** C'est la consequence principale. Le depot peut rester sur
GitHub, mais l'hebergement doit changer pour un hebergeur PHP (mutualise cPanel type
o2switch, LWS, PlanetHoster, Hostinger, ou un VPS). Deux effets induits :

- `mentions-legales.html` annonce aujourd'hui un hebergement GitHub Pages : la mention
  legale devra etre corrigee avec le vrai hebergeur, son adresse et sa raison sociale.
  C'est une obligation legale, pas un detail.
- Le deploiement ne sera plus un `git push`. Il faudra choisir : FTP/SFTP manuel, `git pull`
  sur le serveur, ou GitHub Actions vers FTP.

**Nouvelle surface d'attaque.** Un formulaire qui traite des donnees cote serveur expose a
l'injection d'en-tetes mail, au XSS, au CSRF et au spam. Le lot 3 traite ces points ; ils ne
sont pas optionnels.

## 2. Ordre impose : PHP d'abord, anglais ensuite

C'est le point le plus important de ce plan.

La tentation est de lancer la version anglaise en parallele de la migration. **Il ne faut
pas.** En dupliquant les 11 pages HTML en anglais maintenant, on produit 22 fichiers qui
seront jetes des que les gabarits PHP existeront — et toute traduction faite entre-temps
sera a refaire.

L'anglais devient bon marche une fois le socle PHP en place : on traduit des chaines dans
`app/lang/en.php`, pas du balisage. **La migration PHP est donc un prerequis de la version
anglaise, pas un chantier concurrent.**

Le lot 0 doit etre court et purement mecanique. Il n'y a donc pas d'attente reelle.

## 3. Architecture cible

Pas de framework, pas de Composer, pas de dependance externe — conforme a `AGENTS.md`.

```text
site-web/
  public/                  <- racine web (document root)
    index.php              <- routeur unique (front controller)
    .htaccess
    assets/
      css/styles.css       <- inchange
      js/main.js           <- inchange sauf les chaines traduites
      images/
  app/
    config.php             <- e-mail, WhatsApp, langues, URL de base
    router.php             <- correspondance URL -> page + langue
    helpers.php            <- e(), t(), url(), asset(), current_lang(), alternate()
    i18n.php               <- chargement des traductions
    lang/
      fr.php
      en.php
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
  docs/
```

**`app/` doit etre hors de la racine web.** Sur un hebergement mutualise, pointer le domaine
sur `public/`. Si l'hebergeur ne le permet pas, ajouter un `app/.htaccess` contenant
`Require all denied` — et le verifier, ne pas le supposer.

### URL cibles

| Page | URL |
| --- | --- |
| Accueil FR | `/fr/` |
| Catalogue FR | `/fr/catalogue` |
| Catalogue EN | `/en/catalogue` |
| Racine | `/` redirige vers `/fr/` |

`.htaccess` :

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

Cela suppose Apache avec `mod_rewrite` — standard sur les mutualises cPanel. **A verifier
sur l'hebergement retenu avant de coder le routeur.** En cas d'hebergement Nginx, la
reecriture se fait dans la configuration du serveur et non dans un `.htaccess`.

Les anciennes URL `.html` doivent etre redirigees en 301 vers les nouvelles, sinon les liens
deja partages tombent en 404.

## 3 bis. Prerequis poste de travail

**PHP n'est pas installe sur la machine de developpement** (verifie le 2026-08-17 :
`php: command not found`). Sans lui, le serveur de test et le test de non-regression du
lot 0 ne peuvent pas tourner. A installer avant de commencer :

```bash
sudo apt install php-cli
php -v            # attendu : PHP 8.1 ou superieur
```

Verifier au passage la version de PHP de l'hebergeur retenu et s'aligner dessus : du code
ecrit en 8.3 qui tourne sur un serveur en 7.4 echouera a la mise en ligne.

## 4. Les lots

### Lot 0 — Socle PHP a rendu identique

**Regle absolue : aucun changement visuel.** La passe UX du 2026-08-17 (heros corriges,
parcours de devis, validation du formulaire, accessibilite) est dans le CSS, le JS et la
structure HTML. Ce lot deplace du code, il n'en modifie pas le rendu.

**A faire :**

1. Creer l'arborescence ci-dessus. Deplacer `assets/` dans `public/` sans y toucher.
2. Extraire `partials/head.php` — parametres : titre, description, image de hero eventuelle.
3. Extraire `partials/header.php` — parametre : page courante, pour poser `is-active` et
   `aria-current="page"`.
4. Extraire `partials/footer.php` — aucun parametre.
5. Extraire `partials/page-hero.php` — parametres : image, largeur, hauteur, fil d'Ariane,
   surtitre, titre, texte, boutons, encart lateral.
6. Convertir les 11 pages en `app/pages/*.php`, le corps de `<main>` seulement.
7. Ecrire `router.php` : `/fr/catalogue` -> `pages/catalogue.php` avec `$lang = 'fr'`.
   URL inconnue -> `pages/erreur-404.php` avec un vrai `http_response_code(404)`.
8. Rediriger `/` vers `/fr/` en 302, et chaque ancien `*.html` vers son equivalent en 301.

**Critere d'acceptation — automatisable :** le HTML rendu par PHP doit etre identique au
HTML actuel, aux espaces pres.

```bash
# Depuis la racine du depot, AVANT de supprimer les .html
php -S localhost:8080 -t public &
mkdir -p /tmp/diff

for p in index groupe agroalimentaire btp mines catalogue actualites contact \
         mentions-legales confidentialite; do
  url="/fr/${p}"; [ "$p" = "index" ] && url="/fr/"
  curl -s "http://localhost:8080${url}" > "/tmp/diff/new-${p}.html"
  # normalisation : espaces multiples et sauts de ligne
  for f in "${p}.html" "/tmp/diff/new-${p}.html"; do
    tr -s ' \n\t' ' ' < "$f" | sed 's/> </></g' > "${f}.norm"
  done
  if diff -q "${p}.html.norm" "/tmp/diff/new-${p}.html.norm" > /dev/null; then
    echo "OK   ${p}"
  else
    echo "DIFF ${p}"; diff "${p}.html.norm" "/tmp/diff/new-${p}.html.norm" | head -20
  fi
done
```

Tant que ce test ne passe pas sur les 10 pages, le lot 0 n'est pas termine. Les `.html`
d'origine ne sont supprimes qu'apres. C'est ce qui garantit qu'aucun acquis UX n'est perdu
en route.

**A ne pas faire dans ce lot :** ameliorer quoi que ce soit, renommer des classes CSS,
« nettoyer » le balisage. Toute amelioration ici rend le test de non-regression inutilisable.

### Lot 1 — Donnees centralisees

**Depend de :** lot 0.

1. `app/data/products.php` retourne un tableau des 11 produits. Champs :
   `id`, `slug`, `categorie` (`exportation` / `importation`), `image`, `largeur`, `hauteur`,
   `cle_nom`, `cle_description`, `tags`. **Les libelles sont des cles de traduction, pas du
   texte** — c'est ce qui rendra le lot 2 mecanique.
2. `app/data/news.php` retourne les actualites avec une date ISO, triees du plus recent au
   plus ancien.
3. `app/data/navigation.php` retourne les entrees de menu.
4. `partials/product-card.php` et `partials/news-card.php` rendent une entree.
5. `catalogue.php` et `actualites.php` bouclent sur les donnees.

**Critere d'acceptation :** le test de rendu identique du lot 0 passe toujours. Ajouter un
produit au tableau le fait apparaitre dans la grille **et** dans les compteurs de filtres,
sans toucher au balisage.

**Piege connu :** les compteurs `.filter-count` sont calcules en JavaScript au chargement.
Ils doivent maintenant venir de PHP, sinon ils resteront justes par hasard.

### Lot 2 — Internationalisation et version anglaise

**Depend de :** lots 0 et 1.

1. `app/lang/fr.php` et `app/lang/en.php` retournent un tableau plat de cles.
   Convention : `page.section.element`, par exemple `catalogue.hero.titre`.
2. `t($cle)` retourne la traduction ; en cas de cle manquante, retourner la cle elle-meme
   **et journaliser** — ne jamais retomber silencieusement sur le francais, sinon des
   fragments de francais passeront inapercus en production.
3. Remplacer tout le texte des gabarits par des appels a `t()`.
4. Selecteur de langue dans l'en-tete, avant le bouton « Demander un devis », et repris en
   pied de page. Deux liens `FR` / `EN`, celui de la langue courante avec
   `aria-current="true"`. Cible tactile de 44 px minimum, comme le reste de la barre.
   **Le selecteur doit mener a la page equivalente**, pas a l'accueil.
5. Dans `<head>` : `<link rel="alternate" hreflang="fr">`, `hreflang="en"`,
   `hreflang="x-default">`, et `<html lang="fr|en">`.
6. **Chaines JavaScript.** `assets/js/main.js` contient aujourd'hui une quinzaine de chaines
   francaises en dur : notifications, messages d'erreur du formulaire, libelles
   « Ajouter au devis » / « Ajoute au devis », resume de selection, corps des messages
   e-mail et WhatsApp. Les extraire et les faire emettre par PHP dans la langue courante :

   ```php
   <script>window.BABIA = <?= json_encode([
     'lang' => $lang,
     'messages' => $messages['js'],
   ], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?>;</script>
   ```

   Puis dans `main.js`, remplacer les litteraux par `window.BABIA.messages.*` avec un repli
   si l'objet est absent. `JSON_HEX_TAG` est requis : sans lui, une chaine contenant `</script>`
   casse la page.
7. Traduire les pages legales avec prudence : **mentions legales et politique de
   confidentialite ont une portee juridique.** Une traduction approximative cree un risque.
   Les faire valider, ou publier la version anglaise avec un renvoi vers la version francaise
   faisant foi.

**Critere d'acceptation :** depuis n'importe quelle page FR, le selecteur mene a la page
equivalente EN et inversement. Aucune chaine francaise ne subsiste sous `/en/`, y compris
dans les notifications JavaScript et le contenu du message WhatsApp. Verification :

```bash
curl -s http://localhost:8080/en/catalogue | grep -niE "devis|produit|sélection|Ajouter"
# doit ne rien retourner
```

### Lot 3 — Formulaire de contact serveur

**Depend de :** lot 0. Peut avancer en parallele du lot 2.

C'est le gain fonctionnel principal de la migration : aujourd'hui le formulaire ouvre un
`mailto:` qui ne produit rien si le poste du visiteur n'a pas de client mail configure.

1. `contact.php` traite `POST` sur lui-meme, puis **redirige** (schema POST-redirect-GET)
   vers `/fr/contact?envoye=1` — sans quoi un rafraichissement renvoie le message.
2. Validation cote serveur de tous les champs. **Le JavaScript ne valide rien de fiable** :
   la validation client actuelle reste, mais comme confort, pas comme securite.
3. Anti-injection d'en-tetes : supprimer `\r` et `\n` de tout champ repris dans les en-tetes
   du mail (nom, e-mail, objet). Une seule ligne oubliee permet a un spammeur d'utiliser le
   formulaire comme relais.
4. Echappement systematique a l'affichage via un helper `e()`.
5. Jeton CSRF en session, verifie a la reception.
6. Anti-spam sans service externe : champ leurre masque en CSS (rempli = rejet silencieux) et
   controle de duree (soumission en moins de 3 secondes = rejet).
7. Envoi : `mail()` avec un en-tete `From` sur le domaine du site et `Reply-To` sur l'adresse
   du visiteur. **Ne jamais mettre l'adresse du visiteur en `From`** : le message serait
   rejete par SPF/DKIM et finirait en spam.
8. En cas d'echec d'envoi, conserver les valeurs saisies et afficher le repli WhatsApp deja
   en place. L'utilisateur ne doit jamais perdre son message.
9. Reafficher les valeurs saisies apres une erreur de validation.

**Critere d'acceptation :** formulaire vide -> erreurs affichees, aucun mail. Formulaire
valide -> mail recu, message de confirmation, rafraichissement sans reenvoi. Champ leurre
rempli -> aucun mail, aucune erreur visible. `Nom: test\r\nBcc: x@y.z` -> l'en-tete injecte
n'apparait pas dans le mail recu.

**Reserve :** `mail()` sur mutualise part souvent en spam. Prevoir de passer a un envoi SMTP
authentifie si le taux de delivrabilite est mauvais. Cela impliquerait d'embarquer PHPMailer
— a arbitrer a ce moment-la, pas maintenant.

### Lot 4 — Mise en ligne

**Depend de :** tous les lots.

1. Corriger la mention d'hebergeur dans les mentions legales, en francais et en anglais.
2. `.htaccess` : redirections 301 des anciennes `*.html`, page 404, en-tetes de securite
   (`X-Content-Type-Options`, `Referrer-Policy`), desactivation du listage de repertoires,
   forcage HTTPS.
3. `php.ini` ou `.htaccess` : `display_errors = Off` en production. Une erreur PHP affichee
   revele des chemins serveur.
4. Verifier que `/app/` n'est pas accessible en HTTP.
5. Mettre a jour `README.md` : commandes PHP, procedure de deploiement.

## 5. Decisions attendues

| # | Decision | Pourquoi elle bloque | Recommandation |
| --- | --- | --- | --- |
| 1 | Hebergeur PHP retenu | Determine `.htaccess` vs configuration Nginx, la faisabilite de la racine sur `public/`, et la mention legale | Mutualise cPanel avec Apache : le plan est ecrit pour ce cas |
| 2 | Mode de deploiement | FTP manuel, `git pull` serveur, ou GitHub Actions | `git pull` sur le serveur si SSH disponible |
| 3 | Adresse e-mail officielle | L'expediteur doit etre sur le domaine du site ; `infobabiaguinee@gmail.com` ne conviendra pas en `From` | `contact@groupebabia.com` |
| 4 | Qui traduit | Une traduction automatique sur un site institutionnel export se voit | Traducteur humain, au minimum relecture |
| 5 | Portee juridique des pages legales EN | Risque si traduction approximative | Version francaise faisant foi, mention explicite |

Les decisions 1 et 3 bloquent le lot 4 uniquement. **Les lots 0 a 3 peuvent demarrer sans
attendre.**

## 6. Ce qui ne doit pas se perdre en route

La passe UX du 2026-08-17 a corrige des defauts qui ne se voient pas dans un diff de code.
A verifier explicitement apres la migration :

- les heros des pages internes affichent bien leur image — le bug d'origine venait d'une
  URL relative resolue par rapport a la feuille de style ;
- le panneau de devis n'apparait qu'a partir d'un produit selectionne et ne recouvre plus
  les fiches ;
- la selection du catalogue survit au passage vers la page contact ;
- le lien d'evitement, le piege de focus du menu mobile et les cibles tactiles de 44 px ;
- le bouton pause du hero et la cadence de 7 secondes ;
- le pied de page pleine largeur, identique sur toutes les pages.

Voir `docs/design-ux/AUDIT_UI_UX.md` pour le detail.

## 7. Articulation avec le benchmark SGS

`docs/design-ux/BENCHMARK_SGS.md` decrit les evolutions de contenu et de parcours. Sa
priorite P1-2 « Version anglaise » est **remplacee par le lot 2 du present document** : elle
y etait decrite en duplication de fichiers HTML, ce qui n'a plus lieu d'etre.

Les priorites P0 du benchmark (actualites datees, preuves verifiables, pied de page
utilitaire) restent valables et deviennent **plus simples** apres le lot 1 : les actualites
sont un tableau de donnees, plus des cartes ecrites a la main.

Ordre conseille : lot 0, lot 1, puis P0 du benchmark, puis lots 2 et 3.
