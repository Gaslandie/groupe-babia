# Groupe Babia

Site web institutionnel de Groupe Babia Guinee, entreprise multisectorielle active
dans l'agroalimentaire, le BTP et le secteur minier en Guinee et en Afrique de
l'Ouest.

Le projet suit le template Web/Mobile GassTech et fournit une experience statique,
responsive et directement publiable sur GitHub Pages ou un hebergement classique.

## Sources initiales

- Depot GitHub : https://github.com/Gaslandie/groupe-babia.git
- Site actuel : https://www.groupebabia.com/
- Cahier des charges client :
  `/home/mohamed-gassama/Desktop/Cahier des charges clients/Audit-et-Proposition-Refonte-Groupe-Babia.pdf`

## Commandes

```bash
# Installer
Aucune installation requise pour le site statique.

# Lancer en local
python3 -m http.server 4173

# Tester
node --check assets/js/main.js

# Builder
Aucun build requis.
```

## Pages du site

- `index.html` : accueil avec hero slider 3 secondes.
- `groupe.html` : presentation institutionnelle.
- `agroalimentaire.html` : pole agroalimentaire et logique export.
- `btp.html` : pole Construction / BTP.
- `mines.html` : pole minier.
- `catalogue.html` : catalogue agroalimentaire avec filtres et selection devis.
- `actualites.html` : rubrique actualites.
- `contact.html` : contact et demande de devis.
- `mentions-legales.html` : informations legales de l'editeur.
- `confidentialite.html` : politique de confidentialite et traitement des demandes.

## Structure recommandee

```text
docs/
  PROJECT_CONTEXT.md
  WORKLOG.md
  cadrage/
  design-ux/
  technique/
  qualite-securite/
  livraison-maintenance/
  templates/
scripts/
src/ ou frontend/ + backend/ ou app/
public/ ou assets/
```

## A remplir

- Objectif : proposer une presence institutionnelle credible, orientee export, projets et partenaires.
- Public : acheteurs internationaux, partenaires, institutions, prospects BTP/mines/agroalimentaire.
- Stack : HTML/CSS/JS statique pret pour GitHub Pages ou hebergement web classique.
- Environnements : GitHub / GitHub Pages possible.
- Methode de livraison : push GitHub, puis activation GitHub Pages si souhaitee.
