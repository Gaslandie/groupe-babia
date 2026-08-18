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
node -e "const fs=require('fs');const path=require('path');let ok=true;for(const file of fs.readdirSync('.').filter(f=>f.endsWith('.html'))){const html=fs.readFileSync(file,'utf8');for(const m of html.matchAll(/(?:href|src)=\\\"([^\\\"]+)\\\"/g)){let u=m[1];if(/^(https?:|mailto:|tel:|#|data:)/.test(u)) continue;u=u.split('#')[0].split('?')[0];if(!u) continue;const target=path.join(path.dirname(file),u);if(!fs.existsSync(target)){console.log(file+' -> missing '+m[1]);ok=false;}}}process.exit(ok?0:1)"

# Builder
Aucun build requis.
```

## Pages du site

- `index.html` : accueil avec hero slider 5 secondes.
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

## Maintenance

- Plan de maintenance : `docs/livraison-maintenance/PLAN_MAINTENANCE.md`
- Livraison production : `docs/livraison-maintenance/LIVRAISON_PRODUCTION.md`
- Suivi incident : `docs/livraison-maintenance/SUIVI_INCIDENT.md`
- Rythme conseille : revue mensuelle des contenus, des coordonnees, des liens et
  des images ; publication immediate lorsqu'une disponibilite produit, un
  partenariat ou une annonce importante est confirmee par le client.
