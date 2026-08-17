# Audit UI/UX

Passe UX du 2026-08-17 sur la version statique. Correctifs appliques et points restants.

## Anomalies corrigees

| Gravite | Constat | Correctif |
| --- | --- | --- |
| Bloquant | Les 8 heros de pages internes s'affichaient sans image : `url()` place dans une custom property etait resolu par rapport a `assets/css/`, donc 404 sur chaque visuel. | Le visuel est un `<img class="page-hero-media">` reel, avec calque de contraste separe. |
| Fort | Le panneau de devis du catalogue etait toujours affiche et recouvrait les fiches produits, meme sans selection. | Panneau visible seulement a partir d'un produit, compteur, puces retirables, `--dock-space` reserve la place en bas de page. |
| Fort | Le formulaire de contact ne donnait aucun retour : un `mailto:` sans client mail configure ne produisait rien de visible. | Validation en ligne, zone de statut, repli « copier le message » et adresse en clair. |
| Fort | La selection du catalogue etait perdue en changeant de page. | Selection persistee en `sessionStorage` et reprise dans le message du formulaire. |
| Moyen | Titres a taille fixe (`6rem` / `3.7rem`) : le hero occupait tout l'ecran entre 1024 et 1280 px. | Tailles fluides en `clamp()` sur hero, titres de section et bande de reperes. |
| Moyen | Defilement automatique du hero toutes les 3 s, sans pause possible au doigt, et le paragraphe principal changeait sous les yeux du lecteur. | Cadence a 7 s, bouton pause/lecture (WCAG 2.2.2), texte d'accroche stable, balayage tactile, barre de progression. |
| Moyen | Pas de lien d'evitement ; 8 entrees de navigation a traverser au clavier sur chaque page. | Lien « Aller au contenu principal » et `main#contenu` focusable. |
| Moyen | Cibles tactiles sous le seuil : puces du slider en 34x4 px. | 44 px de hauteur utile sur les puces, fleches et icones du pied de page. |
| Moyen | `scroll-padding-top` fige a 92 px alors que l'en-tete se reduisait a 70/68 px : les ancres tombaient sous l'en-tete. | Hauteur d'en-tete stable via `--header-height`, reprise par `scroll-padding-top`. |
| Faible | Icones sociales rendues en texte « @ » et « wa ». | Icones SVG e-mail, telephone et WhatsApp avec intitules explicites. |
| Faible | Fil d'Ariane en `<div>`, sans semantique. | `<nav aria-label="Fil d'Ariane">` + liste ordonnee + `aria-current`. |
| Faible | Aucune page 404. | `404.html` avec acces rapides catalogue / groupe / contact. |
| Faible | Images sans dimensions ni chargement differe : sauts de mise en page au defilement. | `width`/`height`, `loading="lazy"`, `decoding="async"`, priorite haute sur le premier visuel. |

## Etats

- Chargement : images dimensionnees, pas de reserve d'espace vide a prevoir sur le statique.
- Vide : catalogue filtre sans resultat, panneau de devis sans selection, message d'aide sous les filtres.
- Erreur : champs de formulaire invalides signales en ligne, resume au-dessus des actions, page 404.
- Succes : confirmation apres envoi, notification courte a chaque ajout ou retrait de produit.
- Hors ligne : non applicable sur cette version statique.

## Points restants

- `btp.jpg` fait 626x417 px pour un usage plein ecran : visuel flou sur grand ecran, a remplacer par un media officiel.
- Cinq produits du catalogue n'ont pas de photo et s'affichent en pastille de couleur.
- Les metriques « GN » et « AO » de la page Groupe restent difficiles a interpreter.
- Version anglaise et balises de partage (Open Graph) non traitees dans cette passe.

