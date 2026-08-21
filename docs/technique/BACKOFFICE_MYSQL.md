# Back office MySQL

## Perimetre initial

Le premier module admin gere les activites/realisations publiees par Groupe Babia.
Le reste du site reste vitrine tant que la bascule PHP n'est pas terminee.

## Configuration

1. Creer une base MySQL dans Bluehost/cPanel.
2. Copier `.env.example` vers `.env` sur le serveur.
3. Renseigner :
   - `DB_HOST`
   - `DB_PORT`
   - `DB_NAME`
   - `DB_USER`
   - `DB_PASSWORD`
   - `ADMIN_USERNAME`
   - `ADMIN_PASSWORD_HASH`
4. Generer le hash admin avec :

```bash
php scripts/create-admin-password-hash.php "votre-mot-de-passe"
```

Ne jamais committer le vrai `.env`.

## Migration initiale

Appliquer le fichier :

```text
database/migrations/001_create_realisations.sql
```

Table creee : `realisations`.

Puis appliquer :

```text
database/migrations/002_add_realisation_client_partner.sql
```

Colonne ajoutee : `client_partner`.

En CLI serveur, le runner applique uniquement les migrations non encore passees :

```bash
php database/migrate.php
```

Le fichier `database/.htaccess` interdit l'acces web au dossier des migrations.

## Build d'activation

Le build statique courant reste :

```bash
php build.php
```

Le paquet de future bascule PHP sans admin :

```bash
php build.php --with-php
```

Le paquet de future bascule avec back office et migrations :

```bash
php build.php --with-admin
```

`--with-admin` implique `--with-php` et ajoute `espace-gb/`, `database/` et `.env.example` dans `dist/`.
Le vrai `.env` doit toujours etre cree directement sur le serveur.

## Statuts

- `draft` : brouillon non publie ;
- `published` : visible lorsque le front sera branche ;
- `archived` : conserve en admin, retire de l'affichage public.

## Etat actuel

- Connexion admin par variables d'environnement.
- Identifiant retenu : `admin`.
- URL de back office retenue : `/espace-gb/login.php`.
- Tableau de bord admin.
- Liste des realisations lue depuis MySQL si la base est configuree.
- Ajout, modification et suppression des realisations.
- Page publique `realisations.php` : lit les contenus `published` si MySQL est configure, sinon affiche un etat d'attente propre.
- Page detail `/realisations/{slug}` : affiche uniquement les realisations publiees via reecriture `.htaccess`.
- Accueil PHP `index.php` : affiche les 3 dernieres realisations publiees si MySQL est disponible, sinon conserve la section statique.
- Upload d'image implemente : JPG, PNG ou WebP, 3 Mo maximum, stockage dans `uploads/realisations/`.
- Une seule image de couverture par realisation dans cette version.
- Champ `client_partner` affichable publiquement quand le nom du client ou partenaire est valide.
- Le workflow FTP exclut encore `*.php`, `espace-gb/`, `app/` et `database/` : cette page n'est pas publiee sur Bluehost tant que la bascule PHP n'est pas validee.
- La bascule PHP/admin ne doit etre activee qu'apres test manuel sur Bluehost.

## Protections HTTP

- `.env`, fichiers SQL et logs sont refuses par le `.htaccess` racine.
- `app/` est refuse en acces web direct.
- `database/` est refuse en acces web direct.
- `uploads/` refuse les scripts PHP et interdit l'indexation de dossier.
- `espace-gb/` ajoute `X-Robots-Tag: noindex` et des en-tetes no-cache.
