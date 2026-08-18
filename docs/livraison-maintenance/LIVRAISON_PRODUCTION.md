# Livraison production

## Version

- Projet : Groupe Babia Guinee
- Version : site vitrine statique HTML/CSS/JS
- Date : a renseigner a chaque livraison
- Responsable : equipe web / maintenance

## Pre-check

- Build valide : aucun build requis pour la version statique.
- JavaScript verifie : `node --check assets/js/main.js`.
- Liens locaux verifies : commande de controle dans `PLAN_MAINTENANCE.md`.
- Recette validee : accueil, catalogue, contact, menu mobile et footer.
- Sauvegarde effectuee si donnees existantes : non applicable pour le site statique.
- Variables d'environnement verifiees : non applicable tant que le site reste statique.
- Rollback identifie : revenir au commit Git precedent ou republier la derniere version stable.

## Deploiement

- Environnement : GitHub Pages ou hebergement web classique.
- Commande ou procedure : commit puis `git push origin main`.
- Heure de debut :
- Heure de fin :
- URL / artefact : https://gaslandie.github.io/groupe-babia/

## Post-check

- Page / app accessible :
- Parcours principal OK : menu, catalogue, selection produit, contact, WhatsApp.
- Logs critiques OK : console navigateur sans erreur bloquante.
- Retours client :

## Rollback

- Condition de rollback : page inaccessible, navigation bloquee, erreur formulaire, mauvaise information client.
- Procedure : restaurer le commit stable precedent puis pousser.
- Responsable : equipe web / maintenance.
