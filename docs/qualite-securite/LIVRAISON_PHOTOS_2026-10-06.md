# Livraison des photos client — 6 octobre 2026

Gassama demande explicitement le commit, la publication GitHub et le déploiement des changements. Le commit `09ad228` est poussé sur `main` : photos du cacao et de « 01 Agriculture » FR/EN, plus enregistrement Git de la photo « L'humain d'abord » déjà publiée le 4 octobre. Aucun texte commercial modifié.

## Comparaison avant livraison

Références officielles relues le 6 octobre 2026 :

| Source | Observation réelle | Application |
| --- | --- | --- |
| [cURL — `--ssl-reqd`](https://curl.se/docs/manpage.html#--ssl-reqd) | `--ssl` peut revenir à une connexion non chiffrée ; `--ssl-reqd` arrête le transfert si TLS ne peut pas être établi. | FTPS explicite avec TLS exigé, certificat et nom d'hôte vérifiés ; pas de `--insecure`. Hôte Bluehost déjà validé, identité du dossier contrôlée avant écriture. |
| [Git — git-push](https://git-scm.com/docs/git-push) | Un push normal refuse de remplacer une branche par un historique qui ne contient pas l'historique distant. | `git fetch origin main`, branches identiques avant commit ; `git push origin main`, sans force. |

Les deux pages sont accessibles. Lecture technique, pas de comparaison graphique supplémentaire : les benchmarks des photos du 6 octobre restent pertinents. Le workflow historique a été inspecté : seuls les déclenchements manuels subsistent ; il n'est pas lancé, car son déploiement statique ne convient pas au site PHP.

## Préparation réellement vérifiée

- `php build.php --with-admin` et `php scripts/verify-build.php` : 77 fichiers vérifiés.
- `node --check assets/js/main.js`, `php -l` sur les quatre pages PHP anglaises concernées et `git diff --check` : réussis.
- Recette locale déjà effectuée : 12 cas Chrome cacao et huit cas Agriculture FR/EN ; captures téléphone/ordinateur consultées. Voir les rapports de chaque photo.
- Index Git contrôlé : aucun secret, `.deploy.local`, sauvegarde, fichier utilisateur ou administration sélectionné. Configuration privée ignorée par Git.
- Neuf contrôles HTTP avant envoi : accès à `.env`, configuration, base, uploads refusés ; documentation et configuration de livraison en 404 ; URL inconnue en 404 ; messages admin sans connexion redirigés au login ; login accessible.
- Destination FTPS confirmée par identité exacte de `.htaccess`, `index.php` et du logo avec le projet. Aucun de ces trois fichiers n'est envoyé.
- 23 fichiers candidats comparés : 17 à livrer, dont deux nouvelles images ; six fichiers « L'humain d'abord » déjà identiques, non renvoyés.
- 15 fichiers distants sauvegardés. Archive privée durable vérifiée par SHA-256, hors Git : `../.livraisons/20261006-photos-avant-publication.tar.gz`. Permissions 0600. Manifeste et session indiqués dans `/tmp/babia-photo-release-state.json`, sans identifiants.

## Déploiement

Terminé : **17 / 17 fichiers livrés et relus identiques au SHA-256**, aucune erreur de transfert. Script de session : `python3 /tmp/babia-photo-release.py deploy`. Liste fermée de fichiers publics et fragments nécessaires ; vérification que les fichiers distants n'ont pas changé depuis leur sauvegarde ; ressources envoyées et relues avant les pages. Connexion réutilisée par cURL avec les mêmes exigences TLS pour chaque transfert. Configuration FTPS transmise à cURL par son entrée standard, sans mot de passe dans la commande ou dans un nouveau fichier temporaire.

## Vérifications en production

- **20 contrôles HTTP réussis** : huit pages FR/EN en 200 avec les nouvelles références ; trois photos publiques identiques au build ; sept accès privés ou inconnus refusés ; messages admin renvoyés au login ; login accessible. Les trois images comprennent la photo « L'humain d'abord » dont la conservation est confirmée.
- `node /tmp/babia-agriculture-production-check.cjs` : **huit cas Chrome réussis**, pages secteurs FR/EN à 320, 390, 768 et 1440 pixels ; photo visible et décodée, cadrage 50% 40%, description correcte, aucun débordement ni exception JavaScript.
- `node /tmp/babia-cocoa-production-check.cjs` : **12 cas photo Chrome réussis**, accueil, secteurs et catalogue FR/EN à 390 et 1440 pixels. Photo visible, dimensions réelles, liens et volets produit conservés, aucun débordement ni exception JavaScript. Deux parcours contact avec cacao prérempli ont également réussi.
- Une assertion supplémentaire attendait un formulaire vide sur `need=__proto__` ; elle a échoué car l'hébergeur refuse cette URL. Diagnostic séparé : HTTP 403, titre « Access Denied ». Le test a été corrigé pour distinguer ce refus de l'hébergeur du traitement de l'application, sans changement du site. `node /tmp/babia-contact-production-check.cjs` : **trois cas réussis**, deux préremplissages cacao FR/EN et refus 403 du paramètre de test. Aucun formulaire envoyé. Les 12 cas photo déjà réussis n'ont pas été répétés.
- Quatre captures consultées : `/tmp/babia-agriculture-production-{390,1440}.png` et `/tmp/babia-cocoa-production-{390,1440}.png`. Agriculteur et tête visibles dans « 01 Agriculture », nouvelle photo du cacao dans sa carte. Une capture ordinateur a été demandée avant la fin du test puis consultée une fois créée.

Niveau atteint : **commité, poussé, déployé et vérifié sur le site public**. Prochaine étape : retour visuel du client sur [Our sectors](https://www.groupebabia.com/en/sectors.php) et son catalogue.

## Sécurité, limites et retour arrière

Aucun secret, donnée privée, fichier de base ou administration envoyé ; aucun fichier distant supprimé. Aucun changement aux protections serveur, sessions, droits ou formulaires. Tests d'accès sans connexion ; aucun test de changement de compte ou de droits révoqués, car aucun parcours connecté n'est modifié. Aucun message réel envoyé et aucune opération en base.

Chrome vérifié avec des largeurs simulées, sans téléphone physique ni Safari. Le refus du paramètre de test par l'hébergeur ne prouve pas le traitement d'une valeur inconnue par l'application en production. Les accès protégés testés restent refusés ; cela ne constitue pas une promesse de sécurité absolue.

Retour arrière : restaurer les 15 fichiers archivés par FTPS vérifié. Les deux nouvelles images peuvent rester présentes mais inutilisées ; aucune suppression nécessaire. Après restauration, relire les fichiers et vérifier les pages publiques et les accès refusés.

## Trois questions de suivi

1. Qui regroupe les retours visuels du client ?
2. Quand souhaite-t-il vérifier les deux nouvelles photos ?
3. D'autres photos de secteurs ou de produits seront-elles fournies ?
