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
php -r 'echo password_hash("votre-mot-de-passe", PASSWORD_DEFAULT), PHP_EOL;'
```

Ne jamais committer le vrai `.env`.

## Migration initiale

Appliquer le fichier :

```text
database/migrations/001_create_realisations.sql
```

Table creee : `realisations`.

## Statuts

- `draft` : brouillon non publie ;
- `published` : visible lorsque le front sera branche ;
- `archived` : conserve en admin, retire de l'affichage public.

## Etat actuel

- Connexion admin par variables d'environnement.
- Tableau de bord admin.
- Liste des realisations lue depuis MySQL si la base est configuree.
- Ajout, modification et suppression des realisations.
- Page publique `realisations.php` : lit les contenus `published` si MySQL est configure, sinon affiche un etat d'attente propre.
- Page detail `realisation.php?slug=...` : affiche uniquement les realisations publiees.
- Accueil PHP `index.php` : affiche les 3 dernieres realisations publiees si MySQL est disponible, sinon conserve la section statique.
- Upload d'image implemente : JPG, PNG ou WebP, 3 Mo maximum, stockage dans `uploads/realisations/`.
- Le workflow FTP exclut encore `*.php`, `admin/`, `app/` et `database/` : cette page n'est pas publiee sur Bluehost tant que la bascule PHP n'est pas validee.
