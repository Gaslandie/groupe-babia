# Noms des secteurs : correction de traduction — 30 septembre 2026

## Résultat

Le code demande aux outils de traduction de conserver les titres et les liens des activités 02 et 03. Cela évite qu'un traducteur qui respecte ces consignes remplace les deux titres par « Agribusiness ». Les descriptions restent traduisibles. Le bouton EN donne accès aux textes anglais du site.

La capture client confirme l'affichage identique des titres. Elle ne suffit pas à prouver quel outil les a traduits. Aucun moteur de traduction du téléphone client n'a été testé.

## Comparaison des références avant modification

Consultation le 30 septembre 2026, pour cette correction :

| Référence | Observation documentaire réelle | Adaptation au site |
| --- | --- | --- |
| [W3C — Using HTML’s translate attribute](https://www.w3.org/International/questions/qa-translate-flag.en) | `translate="no"` protège un élément et ses descendants sans changer son rendu. Le document décrit aussi `class="notranslate"` comme convention historique de Google et Microsoft. | Ajouter les deux indications sur les titres et liens concernés uniquement. |
| [MDN — translate](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Global_attributes/translate) | L'attribut exprime si le contenu doit être traduit ; tous les outils ne le respectent pas. | Conserver le sélecteur FR/EN et annoncer la limite, sans promettre un résultat universel. |

Le blocage de toute la page aurait empêché les autres visiteurs de traduire les descriptions. Il n'est pas retenu. Ces sources documentent le mécanisme ; elles ne remplacent pas un essai dans le navigateur client.

## Fichiers concernés

Six sources : `app/pages/fr/{index,secteurs,agroalimentaire}.html` et `app/pages/en/{index,sectors,agri-food}.html`. Neuf sorties générées : trois HTML FR et trois paires HTML/PHP EN. Documentation : contexte, journal et ce rapport.

## Vérifications réalisées

- Commandes : `php scripts/generate-fr-pages.php`, `php scripts/generate-en-pages.php`, `php build.php --with-admin`, `php scripts/verify-build.php`, `git diff --check` : succès.
- Comparaison exacte des 15 fichiers avec HEAD après retrait des seuls attributs ajoutés : identiques. Aucun texte, lien, image, style ou script modifié.
- Analyse HTML des six pages produites : deux titres protégés par page ; `lang` FR/EN correct ; lien de changement de langue présent ; aucune interdiction de traduire la page entière.
- Sécurité : aucun changement aux contrôles serveur, aux droits, aux sessions, aux fichiers téléversés, aux données privées, aux secrets ni aux dépendances. Pas de requête en base ou de soumission de formulaire. Tests de comptes et droits révoqués non exécutés : hors du changement de balisage public.
- `cua.getState()` ne fournit aucun navigateur : recette visuelle mobile/desktop et traduction automatique réelle non exécutées.

Niveau atteint : code généré et contrôlé localement. Aucun commit ni push. Livré par FTPS avec le menu mobile ; l’accueil et la page secteurs FR/EN présentent les titres distincts en production. Aucun test du traducteur automatique du téléphone client.

## Suite et trois questions de suivi

Publier les seules pages concernées en conservant les protections du serveur, puis ouvrir l'accueil sur le téléphone client avec la traduction activée.

1. Quel navigateur le client utilise-t-il pour ouvrir le lien WhatsApp ?
2. Après publication, les cartes 02 et 03 restent-elles distinctes avec sa traduction activée ?
3. Le client accède-t-il facilement au bouton EN dans le menu mobile ?

Ces questions ne bloquent pas la préparation du correctif.
