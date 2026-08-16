# Architecture Web/Mobile

## Vue d'ensemble

- Type de projet :
- Frontend :
- Mobile :
- Backend :
- Base de donnees :
- Hebergement :

## Structure recommandee

### Projet web simple

```text
src/
  app/ ou pages/
  components/
  lib/
  services/
  styles/
  types/
public/
docs/
scripts/
```

### Projet fullstack

```text
frontend/
  src/
  public/
backend/
  src/
  tests/
docs/
scripts/
```

### Projet mobile Android

```text
app/
  src/main/
docs/
scripts/
gradle/
```

## Regles

- Isoler les appels API dans `services/` ou equivalent.
- Garder les composants UI sans logique metier lourde.
- Centraliser les types et contrats partages.
- Documenter toute decision structurante dans un ADR.
- Fournir une commande claire pour installer, tester, builder et lancer.

