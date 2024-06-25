# Projet Plateforme PACS

-  [Cahier des charges](https://docs.google.com/document/d/180JOUNCo4_jzBkek-JFCUXFFabEzrM3o/edit?pli=1)
-  [Gantt](https://docs.google.com/spreadsheets/d/16DjTfLwqH-vK7sKKc6DJYYvVggpnn4S9ldSixgz56y4/edit#gid=0)

## Lancer le serveur interne

```bash
symfony serve -d
```
## Commandes git

Commandes de base pour l'utilisation de Git

# Modification du projet

A faire tout le temps avant de travailler : Met le dépot local à jour

```bash
git pull origin nom_branche
```

A faire pour envoyer toutes nos modifications sur le dépot distant :
```bash
git add .
```
```bash
git commit -m “Modifications”
```
```bash
git push origin nom_branche
```

# Gestion des branches

Lister les branches existantes
```bash
git branch
```
Changer de branche
```bash
git checkout nom_branche
```
Créer une nouvelle branche
```bash
git branch nom_branche
```
Fusionner la branche nom_branche depuis la branche principale
```bash
git merge nom_branche
```
