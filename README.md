# Groupe Babia

Refonte du site web de Groupe Babia Guinee, entreprise multisectorielle active
dans l'agroalimentaire, le BTP et le secteur minier en Guinee et en Afrique de
l'Ouest.

Le projet suit le template Web/Mobile GassTech et demarre par une phase de
cadrage avant implementation.

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

- Objectif : refondre le site avec une image credible, bilingue FR/EN, orientee export et partenaires.
- Public : acheteurs internationaux, partenaires, institutions, prospects BTP/mines/agroalimentaire.
- Stack : HTML/CSS/JS statique pret pour GitHub Pages ou hebergement web classique.
- Environnements : GitHub / GitHub Pages possible.
- Methode de livraison : push GitHub, puis activation GitHub Pages si souhaitee.
