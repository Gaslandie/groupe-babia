# Photo « L’humain d’abord » — 4 octobre 2026

Comparaison effectuée avant adaptation, sur deux références reconnues :

| Source consultée | Observation réelle | Application à Babia |
| --- | --- | --- |
| [W3C WAI — Informative Images](https://www.w3.org/WAI/tutorials/images/informative/) | Une description courte transmet le contenu de l’image ; une photo illustrative ne doit pas identifier les personnes comme membres de l’entreprise sans preuve. | Décrire deux agriculteurs souriants dans un champ, sans les présenter comme salariés du groupe. |
| [Chrome / web.dev — Learn Images](https://web.dev/learn/images/) | Le cours distingue formats raster, WebP, compression et images adaptées à l’affichage. | Encoder la capture en WebP, conserver ses dimensions et son cadrage, charger la photo à l’approche du bloc. |

Lecture textuelle des deux références le 4 octobre 2026. Le lien initial `https://web.dev/learn/images/performance` a renvoyé une erreur ; le cours principal était accessible. Aucun audit visuel de ces références.

Photo choisie explicitement par Gassama : `/home/mohamed-gassama/Pictures/Screenshots/Screenshot From 2026-10-04 19-26-52.png`. Capture contrôlée visuellement : deux personnes dans un champ, pouces levés. Aucun élément d’interface ou secret visible. L’image fournie sert d’illustration ; elle ne prouve ni les effectifs, ni l’appartenance des personnes à Babia. Les textes et chiffres client sont conservés.

L’original reste intact. Une nouvelle URL d’image évite de réutiliser l’ancienne photo depuis le cache. La hauteur automatique est limitée à cette photo FR/EN pour préserver les visages à toutes les largeurs. Aucun changement aux sessions, droits, formulaires, données privées, dépendances ou protections serveur.

Publication demandée ensuite par Gassama. Comparaison technique avant livraison : [cURL — `--ssl-reqd`](https://curl.se/docs/manpage.html#--ssl-reqd), consulté le 4 octobre 2026. La documentation exige TLS et termine la connexion si le transfert ne peut pas être chiffré. Application : certificat vérifié, TLS exigé pour les transferts FTPS, sauvegarde privée vérifiée avant écriture et relecture SHA-256 après chaque envoi. Aucun recours à `--insecure`.
