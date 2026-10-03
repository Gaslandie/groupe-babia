# Hévéa et coton — comparaison du 3 octobre 2026

Sources primaires consultées avant réalisation :

| Référence | Observation réelle | Adaptation à Babia |
| --- | --- | --- |
| [Socfin — Rubber](https://socfin.com/en/rubber/) | Présente la collecte de latex, les cup lumps, la transformation TSR et un contact. | Montrer plantation et produit, distinguer Cup Lump / TSR / RSS et demander les spécifications de l’acheteur. |
| [Olam Agri — USA / Cotton Sourcing & Supply](https://www.olamagri.com/locations/usa) | Sépare les origines, l’approvisionnement, la logistique et l’accompagnement des acheteurs. | Origine, réseau agricole, formes du coton et conditions d’expédition dans une fiche lisible. |

Pages accessibles en lecture textuelle. Aucun audit visuel de ces références. Comparaison récente, adaptée au site existant sans reprendre leurs chiffres, certifications ou images.

Les chiffres 800+ / 500+, pays, saisons, qualité et documents sont fournis par le client dans la demande du 3 octobre 2026. Ils ne sont pas prouvés par le benchmark. Hévéa : Guinée, Côte d’Ivoire, Liberia ; coton : 100 % Guinée. Huit produits exportés et six produits importés.

## Photos

Quatre photos WhatsApp fournies par le client, clarifiées avec l’outil intégré imagegen. Originaux conservés dans Downloads. Les versions WebP optimisées vivent dans `assets/images/` : `cotton-bales.webp`, `cotton-field.webp`, `hevea-plantation.webp`, `hevea-cup-lump.webp`.

Contrôle visuel des quatre résultats : sujet et composition reconnaissables, pas de texte ajouté, icônes de recherche retirées. La restauration par IA reconstruit des textures, surtout sur les balles de coton très floues. Ces versions servent d’illustrations ; elles ne prouvent pas le stock ou une qualité mesurée.

## Prompts exacts

+## cotton-bales

Use case: precise-object-edit. Edit target: the attached original photo of stacked compressed cotton bales inside a warehouse. Asset type: product photograph for Groupe Babia's export catalog. Restore clarity, gently reduce JPEG artifacts and blur, improve natural contrast and exposure, preserve realistic colors. Keep the same subject, objects, camera angle and composition, recognizable as the original photograph. Remove the small camera/search UI icon overlay at lower left where present by restoring the background. No added objects, writing, logos or invented labels, no exaggerated texture, no change of product. Security requirement: preserve private data and do not expose secrets. Benchmarking requirement: follow restrained natural commodity photography observed on Socfin rubber and Olam Agri cotton references on 2026-10-03; do not copy their images or claims. Explain results to Gassama in simple French, short clear sentences, without an infantilizing tone.

## cotton-field

Use case: precise-object-edit. Edit target: the attached original photo of a cotton field with open white cotton bolls. Asset type: product photograph for Groupe Babia's export catalog. Restore clarity, gently reduce JPEG artifacts and blur, improve natural contrast and exposure, preserve realistic colors. Keep the same subject, objects, camera angle and composition, recognizable as the original photograph. Remove the small camera/search UI icon overlay at lower left where present by restoring the background. No added objects, writing, logos or invented labels, no exaggerated texture, no change of product. Security requirement: preserve private data and do not expose secrets. Benchmarking requirement: follow restrained natural commodity photography observed on Socfin rubber and Olam Agri cotton references on 2026-10-03; do not copy their images or claims. Explain results to Gassama in simple French, short clear sentences, without an infantilizing tone.

## hevea-plantation

Use case: precise-object-edit. Edit target: the attached original photo of a rubber plantation with a tapped tree and a latex collection cup. Asset type: product photograph for Groupe Babia's export catalog. Restore clarity, gently reduce JPEG artifacts and blur, improve natural contrast and exposure, preserve realistic colors. Keep the same subject, objects, camera angle and composition, recognizable as the original photograph. Remove the small camera/search UI icon overlay at lower left where present by restoring the background. No added objects, writing, logos or invented labels, no exaggerated texture, no change of product. Security requirement: preserve private data and do not expose secrets. Benchmarking requirement: follow restrained natural commodity photography observed on Socfin rubber and Olam Agri cotton references on 2026-10-03; do not copy their images or claims. Explain results to Gassama in simple French, short clear sentences, without an infantilizing tone.

## hevea-cup-lump

Use case: precise-object-edit. Edit target: the attached original photo of a close-up pile of cup lump natural rubber. Asset type: product photograph for Groupe Babia's export catalog. Restore clarity, gently reduce JPEG artifacts and blur, improve natural contrast and exposure, preserve realistic colors. Keep the same subject, objects, camera angle and composition, recognizable as the original photograph. Remove the small camera/search UI icon overlay at lower left where present by restoring the background. No added objects, writing, logos or invented labels, no exaggerated texture, no change of product. Security requirement: preserve private data and do not expose secrets. Benchmarking requirement: follow restrained natural commodity photography observed on Socfin rubber and Olam Agri cotton references on 2026-10-03; do not copy their images or claims. Explain results to Gassama in simple French, short clear sentences, without an infantilizing tone.


Comparaison technique avant livraison : [Python — FTP_TLS](https://docs.python.org/3/library/ftplib.html#ftplib.FTP_TLS), consulté le 3 octobre 2026. La documentation demande `prot_p()` pour protéger le canal de données. Application : TLS vérifié, `prot_p()`, sauvegarde avant remplacement et relecture au hash SHA-256. Aucun accès impossible sur ces trois références.
