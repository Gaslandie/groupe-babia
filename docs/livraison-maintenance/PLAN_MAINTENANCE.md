# Plan de maintenance

## Objectif

Maintenir le site Groupe Babia Guinee fiable, rapide, a jour et coherent avec
les informations validees par le client.

## Routine mensuelle

- Verifier les pages principales : accueil, groupe, agroalimentaire, BTP, mines,
  catalogue, actualites et contact.
- Controler les coordonnees : telephone, WhatsApp, e-mail, adresse et carte.
- Ajouter ou actualiser au moins une information dans `actualites.html` lorsque
  le client transmet une disponibilite produit, un partenariat, une annonce ou
  une presence terrain.
- Verifier que les images nouvellement ajoutees sont compressees avant commit.
- Tester le parcours principal : catalogue, selection produits, formulaire,
  liens WhatsApp, liens e-mail et navigation mobile.
- Controler les liens locaux avec la commande documentee dans ce fichier.

## Routine avant publication

```bash
git status -sb
node --check assets/js/main.js
node -e "const fs=require('fs');const path=require('path');let ok=true;for(const file of fs.readdirSync('.').filter(f=>f.endsWith('.html'))){const html=fs.readFileSync(file,'utf8');for(const m of html.matchAll(/(?:href|src)=\\\"([^\\\"]+)\\\"/g)){let u=m[1];if(/^(https?:|mailto:|tel:|#|data:)/.test(u)) continue;u=u.split('#')[0].split('?')[0];if(!u) continue;const target=path.join(path.dirname(file),u);if(!fs.existsSync(target)){console.log(file+' -> missing '+m[1]);ok=false;}}}process.exit(ok?0:1)"
git diff --check
```

## Gestion des contenus

- Une actualite doit avoir une date visible avec une balise `<time datetime="">`.
- Les textes doivent rester clairs pour un acheteur, un partenaire institutionnel
  ou une entreprise qui ne connait pas encore Groupe Babia.
- Les produits du catalogue doivent reprendre les informations confirmees par le
  client : nom, categorie export/import, description, conditionnement et besoin
  de cotation.
- Les informations non confirmees doivent rester hors ligne ou etre formulees de
  maniere prudente.

## Gestion des images

- Preferer WebP pour les grandes images de contenu.
- Garder une image hero sous 250 Ko lorsque c'est possible.
- Garder les images de cartes sous 200 Ko lorsque c'est possible.
- Verifier les tailles avec :

```bash
find assets/images -type f -printf '%s %p\n' | sort -nr | head -30
```

## Incidents

- Noter tout incident dans `docs/livraison-maintenance/SUIVI_INCIDENT.md`.
- Corriger d'abord le parcours touche : accueil, catalogue, contact ou menu.
- Apres correction, relancer les controles avant publication.
- Documenter la cause racine et l'action de prevention.

## Responsabilites

- Contenu client : informations produits, photos, annonces, coordonnees.
- Maintenance site : integration, verification, optimisation, publication.
- Validation finale : verification visuelle et accord de publication.
