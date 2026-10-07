# AGENTS.md - Groupe Babia

Ce projet suit le template Web/Mobile GassTech.

## Avant de modifier

Lire dans cet ordre :

1. `docs/PROJECT_CONTEXT.md`
2. `docs/WORKLOG.md`
3. la tache active
4. les fichiers directement concernes

## Regles de travail

- Ne pas depasser le perimetre demande.
- Ne pas commit, push, supprimer ou migrer des donnees sans demande explicite.
- Ne pas ajouter de dependance sans raison claire.
- Dire le niveau reel atteint : code, compile, teste, livre.
- Preserver les donnees utilisateur.
- Noter les decisions durables dans `docs/PROJECT_CONTEXT.md`.
- Noter l'avancement dans `docs/WORKLOG.md`.

## Verification minimale

- Web : build, parcours principal, mobile et desktop.
- Mobile : build/install si possible, parcours principal, migration de donnees si concernee.
- Fullstack : frontend, backend, contrat API et cas erreur.

## Cloture

Terminer par un rapport court avec :

- resume ;
- fichiers touches ;
- commandes lancees ;
- verification reelle ;
- limites ;
- prochaine etape ;
- 3 questions de gestion de projet.



## CRITICAL RULE — SCAFFOLDING POLICY

Consigne permanente de Gassama — 7 octobre 2026. Cette règle prime sur les anciennes consignes imposant des fichiers, plans, audits ou documents de suivi non indispensables à la tâche demandée. Elle ne réduit aucune exigence de sécurité.

You must only create scaffolding (extra files, folders, plans, audits, verification scripts, certification machinery, evidence gathering, process documentation, or any supporting structure) when it is strictly and immediately necessary to complete the requested task.

Default behavior:

- Prefer the simplest, most direct solution.
- Do the actual work first.
- Avoid creating any extra structure, process, or files unless the task cannot be completed without them.
- If you are about to create scaffolding, stop and ask yourself: “Is this absolutely required right now to finish the user’s request?” If the answer is no, do not create it.
- Never expand scope into process, architecture, audits, or “best practices” unless explicitly asked.

When scaffolding is truly required:

- Keep it minimal.
- Explain briefly why it is necessary.
- Remove or clean it up if it is no longer needed.

Violating this rule (creating unnecessary scaffolding) is considered a failure to follow instructions.
