# Tache — Lot 0 : socle PHP a rendu identique

Reference : `docs/technique/MIGRATION_PHP.md`, section « Lot 0 ».

## Objectif

Transformer les 11 pages HTML en gabarits PHP generant un HTML **strictement identique** a
l'actuel, et mettre en place `build.php` qui produit `dist/`.

Ce lot deplace du code. Il n'en modifie pas le rendu. C'est une migration mecanique.

## Perimetre inclus

- Creation de `app/` : `config.php`, `helpers.php`, `pages/`, `partials/`.
- Extraction des parties dupliquees : `head.php`, `header.php`, `footer.php`,
  `page-hero.php`.
- Conversion des 11 pages en `app/pages/*.php` (contenu de `<main>` uniquement).
- `build.php` : generation de `dist/` et copie de `assets/`.
- Ajout de `dist/` dans `.gitignore`.

## Perimetre exclu

Explicitement hors sujet dans ce lot, meme si l'occasion se presente :

- toute amelioration visuelle, de contenu ou d'accessibilite ;
- tout renommage de classe CSS ou nettoyage de balisage ;
- la centralisation des donnees catalogue et actualites — c'est le lot 2 ;
- l'internationalisation — c'est le lot 3 ;
- la GitHub Action et la bascule de Pages — c'est le lot 1 ;
- **la suppression des `*.html` de la racine** : ils servent de reference au test et
  maintiennent le lien client en ligne.

Toute amelioration introduite ici rend le test de non-regression inutilisable, et c'est lui
qui garantit qu'aucun acquis de la passe UX du 2026-08-17 n'est perdu.

## Fichiers / zones concernees

- Cree : `build.php`, `app/**`, `.gitignore` (ajout de `dist/`).
- Lu sans modification : les 11 `*.html` de la racine.
- **Ne pas toucher** : `assets/css/styles.css`, `assets/js/main.js`, `assets/images/`.

## Contraintes techniques

- PHP **cible 8.1**, bien que la machine ait PHP 8.5.4. Pas de syntaxe posterieure a 8.0 en
  cas de doute.
- Aucune dependance, aucun Composer, aucun framework.
- `build.php` doit etre **idempotent** : deux executions successives produisent des fichiers
  identiques.
- Les chemins d'assets restent **relatifs**. GitHub Pages sert le site depuis le sous-chemin
  `/groupe-babia/` : toute URL absolue commencant par `/` serait cassee. Prevoir des
  maintenant un helper `asset($chemin)` calculant le prefixe selon la profondeur, meme si
  toutes les pages sont a la racine dans ce lot — le lot 3 ajoutera `/en/`.

## Criteres d'acceptation

1. `php build.php` s'execute sans erreur ni avertissement.
2. Le HTML genere est identique a l'actuel, aux espaces pres, sur les **11 pages**.
3. `dist/assets/` contient une copie fidele de `assets/`.
4. Les 11 `*.html` de la racine sont toujours presents et inchanges.
5. Aucune ligne de `styles.css` ni de `main.js` n'a ete modifiee.

## Verification attendue

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

# Les assets n'ont pas bouge
git diff --stat assets/            # doit etre vide

# Idempotence
php build.php && cp -r dist dist-1 && php build.php && diff -r dist-1 dist && rm -rf dist-1
```

Les 11 lignes doivent afficher `OK`. Tant que ce n'est pas le cas, le lot n'est pas termine.

## Rapport de fin attendu

Conformement a `AGENTS.md` : resume, fichiers touches, commandes lancees, verification
reelle, limites, prochaine etape, et 3 questions de gestion de projet.

Indiquer explicitement le **niveau atteint** : code, compile, teste, ou livre.
