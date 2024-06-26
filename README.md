# Projet Plateforme PACS

-  [Cahier des charges](https://docs.google.com/document/d/180JOUNCo4_jzBkek-JFCUXFFabEzrM3o/edit?pli=1)
-  [Gantt](https://docs.google.com/spreadsheets/d/16DjTfLwqH-vK7sKKc6DJYYvVggpnn4S9ldSixgz56y4/edit#gid=0)
-  [Maquette](https://www.figma.com/design/u6wt6sdBeTkP5bvQhDNZFc/Untitled?node-id=237-224&t=6LIfo7RgihLw8v4t-0)
-  [Présentation](https://docs.google.com/presentation/d/1W34K8pxT4teb89EdLcWEExjdoN-cgQk8kLQ822LqXPk/edit)

## Lancer le serveur interne

```bash
symfony serve -d
```

## XAMPP

Exécuter les actions "Start" pour Apache et MySQL au démarage du travail, et "Stop" à la fin.

## Première initialisation après pull

Après le tout premier pull du projet, il est important que le composer soit bien initialisé, sinon le serveur ne pourra pas se lancer
```bash
composer install
```

# Commandes git

Commandes de base pour l'utilisation de Git

## Modification du projet

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
Optionnel : Vérifier l'état de vos fichiers avant git add
```bash
git status
```

## Gestion des branches

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
