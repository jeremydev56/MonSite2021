# MonSite2021

## Statuts des fichiers git sur vs code :

```
M = Modified
U = Untracked = nouveau fichier
A = Added
D = Deleted
```

Staged changes = les changements "ajoutés dans la boite" (=commit)
Changes = changements ajoutés/modifiés non ajoutés dans le commit

## Commandes Git

Pour récup un repo :

```bash
git clone <url>
```

M = Modified
U = Untracked = nouveau fichier
A = Added
D = Deleted


Dans l'ordre, puis travailler en local avec git :

```bash
git add . # ajoutes les fichiers
git commit -m "message" # sauvegarde une version des fichiers ajoutés
```

pour récup des versions :

```bash
# si aucuns fichiers modifiés
git pull origin main # récupère, si il y a, des changements sur la branche 'main"`
# si conflit :
git add .
git commit -m "message si changement"
git push
```