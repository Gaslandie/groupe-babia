# Tache — Lot A : mise en ligne sur www.groupebabia.com

Contexte complet : `docs/technique/MISE_EN_LIGNE_BLUEHOST.md`.

## Objectif

Preparer le depot pour la mise en ligne du site **statique actuel** sur
`https://www.groupebabia.com/`, heberge chez Bluehost, le domaine et la zone DNS restant
chez OVH.

Ce lot ne touche ni au contenu, ni au design, ni a la structure des pages. Il ne fait pas
non plus la migration PHP, qui reste le lot 0.

## Perimetre inclus

1. Basculer l'URL de reference du site de `https://gaslandie.github.io/groupe-babia/` vers
   `https://www.groupebabia.com/`.
2. Corriger la mention d'hebergeur dans `mentions-legales.html`.
3. Ecrire un `.htaccess` a la racine.
4. Ajouter le deploiement FTP par GitHub Actions.

## Perimetre exclu

- La migration PHP (`docs/taches/LOT-0-SOCLE-PHP.md`).
- Le passage du formulaire en envoi serveur : il reste en `mailto:`.
- Toute modification de contenu, de design ou de structure.
- La creation de comptes e-mail : la messagerie reste chez OVH.

## 1. URL de reference

Remplacer partout `https://gaslandie.github.io/groupe-babia/` par
`https://www.groupebabia.com/` :

- `<link rel="canonical">` des 10 pages indexees ;
- `og:url` des 10 pages indexees ;
- `<loc>` de `sitemap.xml` ;
- ligne `Sitemap:` de `robots.txt` ;
- champs `url`, `logo` et `image` des donnees structurees JSON-LD, sur `index.html` comme
  sur les `BreadcrumbList` des pages internes ;
- `og:image` et `twitter:image`.

`404.html` reste en dehors : elle porte `noindex`, sans canonique ni apercu de partage.

**Verification :**

```bash
grep -rl "gaslandie.github.io" --include="*.html" --include="*.xml" --include="*.txt" .
# doit ne rien retourner
grep -c "www.groupebabia.com" sitemap.xml robots.txt index.html
```

## 2. Mention legale d'hebergement

`mentions-legales.html`, section « Hebergement », annonce aujourd'hui GitHub Pages. La
remplacer par l'hebergeur reel. **C'est une obligation legale.**

Texte a poser :

> Le site est heberge par Bluehost, marque de Newfold Digital Inc., 5335 Gate Parkway,
> Jacksonville, FL 32256, Etats-Unis.

Si l'utilisateur fournit une raison sociale ou une adresse differente au moment de
l'execution, utiliser la sienne : ne pas inventer.

## 3. Fichier `.htaccess`

A creer a la racine du site. Bluehost tourne sous Apache, `mod_rewrite` est disponible.

Contenu attendu, dans cet ordre :

1. **HTTPS et `www`** — rediriger en 301 vers `https://www.groupebabia.com/`, en une seule
   redirection quand c'est possible plutot qu'en chaine.
2. **Anciennes URL** — redirections 301 permanentes :

   | Ancienne | Nouvelle |
   | --- | --- |
   | `/index.php` | `/` |
   | `/apropos.php` | `/groupe.html` |
   | `/agriculture.php` | `/agroalimentaire.html` |
   | `/agrobusiness.php` | `/agroalimentaire.html` |
   | `/produits.php` | `/catalogue.html` |
   | `/construction.php` | `/btp.html` |
   | `/mine.php` | `/mines.html` |
   | `/contact.php` | `/contact.html` |
   | `/actualites.php` | `/` |

3. **Page d'erreur** — `ErrorDocument 404 /404.html`.
4. **En-tetes de securite** — `X-Content-Type-Options: nosniff`,
   `Referrer-Policy: strict-origin-when-cross-origin`, `X-Frame-Options: SAMEORIGIN`.
5. **Listage de repertoires** — `Options -Indexes`.
6. **Cache** — `mod_expires` sur les images, le CSS et le JS. Duree modeste sur le CSS et le
   JS, qui changent a chaque livraison ; longue sur les images.

**Verification apres mise en ligne :**

```bash
for u in http://groupebabia.com/ https://groupebabia.com/ https://www.groupebabia.com/apropos.php; do
  curl -s -o /dev/null -w "%{http_code} -> %{redirect_url}\n" "$u"
done
# attendu : 301 vers https://www.groupebabia.com/... puis 200
```

## 4. Deploiement automatique

Creer `.github/workflows/deploy.yml` : a chaque `push` sur `main`, envoyer le site par FTP
vers Bluehost.

Contraintes :

- N'envoyer que ce qui doit etre publie : les `*.html`, `assets/`, `sitemap.xml`,
  `robots.txt`, `.htaccess`. **Exclure** `docs/`, `.git/`, `README.md`, `AGENTS.md`,
  `CLAUDE.md`, `scripts/`.
- Identifiants en **secrets GitHub** — jamais dans le depot :
  `FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`.
- Prevoir un declenchement manuel (`workflow_dispatch`) en plus du `push`.

L'action `SamKirkland/FTP-Deploy-Action` couvre ce besoin. C'est une dependance de chaine
de publication, pas une dependance du site : elle ne modifie pas le code livre.

**Ne pas pousser le workflow avant que l'utilisateur ait cree les trois secrets** — sinon
chaque `push` produira un echec bruyant.

## Criteres d'acceptation

1. Aucune occurrence de `gaslandie.github.io` dans les fichiers publies.
2. `sitemap.xml` valide, 9 URL, toutes en `https://www.groupebabia.com/`.
3. `mentions-legales.html` nomme l'hebergeur reel.
4. `.htaccess` present, couvrant les 9 redirections et les 4 points de securite.
5. Workflow de deploiement present, sans aucun identifiant en clair.
6. Les 10 pages repondent toujours en 200 en local, sans lien interne casse.

## Verification locale avant livraison

```bash
python3 -m http.server 4173
node --check assets/js/main.js
grep -rn "gaslandie.github.io" --include="*.html" --include="*.xml" --include="*.txt" .
python3 -c "import xml.dom.minidom as m; m.parse('sitemap.xml'); print('sitemap OK')"
grep -rn "FTP_PASSWORD\|password" .github/workflows/deploy.yml   # doit n'exposer que des references a secrets
```

## Rapport de fin

Conformement a `AGENTS.md` : resume, fichiers touches, commandes lancees, verification
reelle, limites, prochaine etape, et 3 questions de gestion de projet. Indiquer le niveau
reel atteint : code, compile, teste ou livre.
