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

Il faut utiliser XAMPP pour gerer la base de données.  
Exécuter les actions "Start" pour Apache et MySQL au démarage du travail, et "Stop" à la fin.  
Appuyer sur "Admin" pour vous rendre sur PHPMyAdmin pour voir les données de la table (se rendre deux points en dessous pour la première initialisation de la base de données).

## Important à faire

- installer
Après le tout premier pull du projet, il est important que le composer soit bien initialisé, sinon le serveur ne pourra pas se lancer.
Quand un des contributeurs a ajouté un nouveau bundle (exemple : easyadmin) et qu'il a push son travail, le package ne sera pas installé pour les autres utilisateur même après le pull. Il faut donc faire cette commande à ce moment là également
```bash
composer install
```

## Première initialisation de base de données et migrations
Il faut déjà créer la base de données
```bash
symfony console doctrine:data:create
```
Une fois que c'est fait, il faut migrer les changements pour récupérer les entités de cette base de données
```bash
symfony console doctrine:migrations:migrate
```
Il y aura des erreurs après cette ligne : c'est normal, il faut forcer les changements du scéma avec cette ligne. Il ne faut pas hésiter à essayer cette ligne à chaque fois qu'il y a à nouveau un problème de migration
```bash
symfony console doctrine:schema:update --force
```

# Notes de test

Ajouter ces lignes dans la table User sur PHPMyAdmin :
```sql
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `phone_number`, `bio`, `cv`, `date_of_birth`, `study_field`, `gender`, `certificate_year_obtention`, `last_connected_at`) VALUES

(1, 'admin@colombbus.org', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$fU1nX5ORO4GCD.Ns4k/oiuqj6uXJYCbE1AO8kgTSF99tEFOKN.mA2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-03'),

(2, 'emma.botti@10mentionweb.org', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$.RYBGwr/XgIMk8Jbgnut2.0oRfs0FKYin9nzqILYrzb11NyzBw1NG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(3, 'partner@colombbus.org', '[\"ROLE_PARTNER\"]', '$2y$13$fU1nX5ORO4GCD.Ns4k/oiuqj6uXJYCbE1AO8kgTSF99tEFOKN.mA2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(4, 'alumni@colombbus.org', '[\"ROLE_USER\"]', '$2y$13$fU1nX5ORO4GCD.Ns4k/oiuqj6uXJYCbE1AO8kgTSF99tEFOKN.mA2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(5, 'emmbotti@gmail.com', '[]', '$2y$13$WSNdSS.sZlJXZW.d4wlnD.q3FrT5dHwBe.LT6HOkStjE3Dwz0heSy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-03');


```
Ensemble des dispositifs pour tester l'application  
Email des utilisateurs de test pour se connecter via le formulaire de connexion
- admin@colombbus.org : ROLE_ADMIN
- partner@colombbus.org: ROLE_PARTNER
- alumni@colombbus.org : ROLE_USER  
Mot de passe commun pour tous ces comptes : Colombbus2024@

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
Après déplacement sur la nouvelle branche créée, il faut la push sur le dépot distant
```bash
git push origin -u nom_branche
```
[Explications pour fusionner la branche locale à la branche principale](https://blog.mergify.com/how-to-merge-branches-in-github/)
