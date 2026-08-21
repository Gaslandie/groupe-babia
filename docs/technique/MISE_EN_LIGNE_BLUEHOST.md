# Mise en ligne — domaine OVH, hebergement Bluehost

Decision du 2026-08-18 : `groupebabia.com` est recupere sur le compte OVH de GassTech.
Le **nom de domaine et la zone DNS restent chez OVH**, l'**hebergement passe chez Bluehost**,
selon le meme montage que `cipsarlu.com` et `ecgplusgn.com`.

## 1. Etat constate le 2026-08-18

| Point | Constat |
| --- | --- |
| Enregistrement A | `51.91.236.255` (OVH), sur l'apex et sur `www` |
| MX | `mx1/mx2/mx3.mail.ovh.net` — **messagerie hebergee chez OVH** |
| Site en ligne | Page « Site en construction » d'OVH, en `noindex` |
| Anciennes pages `.php` | Toutes en **404** — l'ancien site n'existe plus |

**Consequence directe : ne pas deleguer les serveurs de noms a Bluehost.** Les MX pointent
vers la messagerie OVH ; changer les NS casserait les e-mails du domaine. On ne modifie que
les enregistrements A.

## 2. Ce que la decision debloque

Bluehost execute PHP. Les lots 4 et 5 du plan de migration, jusqu'ici differes faute
d'hebergeur, redeviennent realisables : **le formulaire de contact pourra enfin envoyer un
message cote serveur**, au lieu du `mailto:` qui echoue silencieusement quand le visiteur n'a
pas de client mail configure.

Cela rend aussi **inutile la generation statique vers GitHub Pages** decrite dans
`MIGRATION_PHP.md` : Bluehost sert le PHP directement. Voir la section 7.

## 3. Redirections des anciennes URL — a ne pas perdre

L'ancien site a disparu, mais sa structure a ete recuperee dans les archives du web. Ces
URL peuvent encore etre indexees ou figurer dans des liens externes. Sans redirection, elles
resteront en 404 et le referencement acquis sera perdu.

| Ancienne URL | Nouvelle destination |
| --- | --- |
| `/index.php` | `/` |
| `/apropos.php` | `/groupe.html` |
| `/agriculture.php` | `/agroalimentaire.html` |
| `/agrobusiness.php` | `/agroalimentaire.html` |
| `/produits.php` | `/catalogue.html` |
| `/construction.php` | `/btp.html` |
| `/mine.php` | `/mines.html` |
| `/contact.php` | `/contact.html` |
| `/actualites.php` | `/` (rubrique retiree le 2026-08-18) |

## 4. A faire cote OVH — espace client, zone DNS

**Prerequis :** recuperer l'adresse IP du serveur Bluehost. Elle figure dans le cPanel
Bluehost, encadre « Shared IP Address » ou dans les informations du compte.

1. Espace client OVH → `groupebabia.com` → **Zone DNS**.
2. Modifier l'enregistrement **A** de `groupebabia.com` : remplacer `51.91.236.255` par l'IP
   Bluehost.
3. Modifier l'enregistrement **A** de `www` de la meme facon.
4. **Ne toucher a rien d'autre.** En particulier, laisser les **MX** et l'eventuel
   enregistrement **SPF** en place : la messagerie reste chez OVH.
5. Ne pas changer les serveurs de noms.

Propagation : quelques minutes a 24 h. Verifier avec `dig +short A www.groupebabia.com`.

### Point de vigilance pour plus tard — envoi de mail depuis PHP

Quand le formulaire passera en envoi serveur (lot 4), les messages partiront des serveurs
**Bluehost** avec une adresse `@groupebabia.com`, alors que le SPF du domaine autorise
**OVH**. Resultat probable : classement en indesirable.

Trois issues, a arbitrer a ce moment-la :
1. ajouter Bluehost a l'enregistrement SPF du domaine chez OVH ;
2. envoyer via SMTP authentifie sur la messagerie OVH ;
3. utiliser une adresse d'expedition technique hebergee chez Bluehost, avec `Reply-To` sur
   l'adresse commerciale.

Ce point ne bloque pas la mise en ligne : le formulaire reste en `mailto:` d'ici la.

## 5. A faire cote Bluehost — cPanel

### 5.1 Contrainte majeure : le compte heberge deja d'autres sites

Le compte Bluehost heberge deja d'autres sites clients, dont `cipsarlu.com` et
`ecgplusgn.com`. `groupebabia.com` sera donc un **domaine additionnel**, et toute erreur de
chemin lors d'un deploiement automatique ecrirait dans le repertoire d'un autre client.

Trois garde-fous, dans cet ordre d'importance :

1. **Compte FTP cloisonne.** Creer un compte FTP dont le repertoire de base est celui de
   `groupebabia.com`, et non `public_html`. C'est le seul garde-fou qui tient meme si le
   workflow est mal configure : un compte cloisonne ne peut physiquement pas ecrire ailleurs.
   Ne jamais utiliser le compte FTP principal du compte d'hebergement.
2. **`server-dir` explicite** dans le workflow de deploiement. Jamais `/`.
3. **Jamais d'option d'effacement prealable** du repertoire distant. Sur
   `SamKirkland/FTP-Deploy-Action`, cela signifie ne jamais activer `dangerous-clean-slate`.

### 5.2 Le fichier `.htaccess` ne doit jamais remonter d'un cran

Le `.htaccess` prevu contient une redirection vers `https://www.groupebabia.com/`. Depose
par erreur dans `public_html/`, il redirigerait **tous les sites du compte** vers
Groupe Babia. Il doit rester dans le repertoire du domaine additionnel.

Verifier egalement qu'un `.htaccess` existant dans `public_html/`, appartenant au site
principal, ne perturbe pas le nouveau domaine.

### 5.3 Duplication d'adresse — deja couverte

Sur Bluehost, le repertoire d'un domaine additionnel est generalement cree **a l'interieur**
de `public_html`. Le site devient alors aussi accessible via
`domaine-principal.com/groupebabia.com/`, ce qui constitue un contenu duplique.

Les balises canoniques posees le 2026-08-18 pointent vers `https://www.groupebabia.com/` :
le probleme est deja neutralise, sans action supplementaire.

### 5.4 Marche a suivre

1. **Domaines** → ajouter `groupebabia.com` en domaine additionnel. Noter le **repertoire
   racine** cree et **verifier qu'il est vide**.
2. **MultiPHP Manager** → passer **ce domaine** en PHP 8.1 ou superieur. Verifier que le
   reglage est bien applique par domaine et non au compte entier, sous peine de modifier la
   version PHP des autres sites.
3. **Comptes FTP** → creer le compte cloisonne decrit en 5.1.
4. Une fois le DNS propage : **SSL/TLS Status** → **Run AutoSSL**. Cette etape echoue tant
   que le domaine ne pointe pas sur Bluehost.
5. **Ne pas** creer de compte e-mail chez Bluehost : la messagerie reste chez OVH.

## 6. A faire dans le depot

Detail d'execution dans `docs/taches/LOT-A-MISE-EN-LIGNE.md`.

1. Remplacer l'URL de reference `https://gaslandie.github.io/groupe-babia/` par
   `https://www.groupebabia.com/` dans les canoniques, `og:url`, `sitemap.xml`, `robots.txt`
   et les donnees structurees.
2. Corriger la mention d'hebergeur dans `mentions-legales.html` : elle annonce aujourd'hui
   GitHub Pages. **C'est une obligation legale**, pas un detail.
3. Ecrire le `.htaccess` : redirections du tableau de la section 3, apex vers `www`,
   HTTP vers HTTPS, page 404 personnalisee, en-tetes de securite.
4. Mettre en place le deploiement automatique par FTP depuis GitHub Actions.

**Choix `www` :** le site retenu est `https://www.groupebabia.com/`, avec redirection de
l'apex vers `www`. C'est la forme qu'utilisait l'ancien site, donc celle susceptible d'etre
connue des moteurs et des liens existants.

## 7. Consequence sur le plan de migration PHP

`MIGRATION_PHP.md` decrivait une generation statique publiee sur GitHub Pages, choisie
uniquement parce qu'aucun hebergeur PHP n'etait arbitre. **Ce detour n'a plus lieu d'etre.**

Nouvelle trajectoire :

- **Etape A — mise en ligne du site statique actuel** sur `www.groupebabia.com`. Rapide, sans
  risque, sans dependance a la migration. Le client est sur son domaine immediatement.
- **Etape B — migration PHP** (lots 0 a 3), deployee ensuite par le meme canal FTP.
- **Etape C — formulaire serveur** (lot 4), avec l'arbitrage SPF de la section 4.

Ne pas coupler A et B : la mise en ligne ne doit pas attendre la refonte technique.

GitHub Pages peut rester actif comme environnement de preview. Les canoniques pointant
desormais vers le domaine de production, la copie `github.io` ne sera pas indexee — c'est
exactement le comportement souhaite pour un environnement de recette.
