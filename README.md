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
## Migrations : général
A chaque fois qu'un changement est fait dans la base de données, il faut migrer les changements avec les deux lignes suivantes :
```bash
symfony console make:migration
```
```bash
symfony console doctrine:migrations:migrate
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
Ajouter ces lignes dans la table Formatin sur PHPMyAdmin :
```sql
INSERT INTO `formation` (`id`, `user_id_id`, `name`, `description`, `zipcode`, `city`, `begin_at`, `end_at`, `degree`, `funding`, `teleworking`) VALUES

(2, NULL, 'Concepteur développeur d\'application', '<div>Préparez-vous à devenir un Concepteur Développeur d’Applications compétent, certifié et recruté !<br><br></div><div>Grâce à un programme innovant, alliant conception, programmation et gestion de projet, vous menant à un Titre Professionnel niveau bac+4 reconnu par l’État.<br><br></div>', '75010', 'paris', '2024-09-16 14:05:00', '2025-06-16 14:05:00', 'bac +4', NULL, 1),

(3, NULL, 'Administrateur d’infrastructures sécurisées (AIS) en alternance', '<div>Administrer et sécuriser les infrastructures.<br>Concevoir et mettre en oeuvre une solution en réponse à un besoin d’évolution.<br>Participer à la gestion de la cybersécurité.</div>', '75010', 'paris', '2024-09-23 14:13:00', '2025-06-23 14:13:00', 'bac +4', NULL, 1),

(4, NULL, 'Concepteur Designer UX/UI en Alternance', '<div>Concevoir les éléments graphiques d’une<br>interface et de supports de communication.<br>Contribuer à la gestion et au suivi d’un projet de communication numérique.<br>Réaliser, améliorer et animer des sites web.</div>', '75010', 'paris', '2024-10-14 14:16:00', '2025-07-28 14:16:00', 'bac +4', NULL, 1);
```
Ajouter ces lignes dans la table Emploi sur PHPMyAdmin :
```sql
INSERT INTO `emploi` (`id`, `user_id_id`, `name`, `description`, `entreprise`, `zipcode`, `city`, `skills`, `field`, `publication_date`, `limit_offer`, `teleworking`, `contract`) VALUES

(1, NULL, 'Developpeur DEVOPS', '<div>Votre Mission :<br><br>En tant que Développeur DevOps en CDI, vous jouerez un rôle clé dans la mise en place et l’optimisation des infrastructures et des processus de déploiement pour nos projets innovants :<br>• Infrastructure as Code (IaC) avec Terraform et Ansible pour une gestion efficace des configurations.<br>• CI/CD avec Jenkins, GitLab et Azure DevOps pour automatiser les pipelines de déploiement.<br>• Docker et Kubernetes pour le déploiement et la gestion des applications en conteneur.<br>• Monitoring et Logging avec Prometheus, Grafana, et ELK Stack pour assurer la performance et la stabilité des systèmes.<br>• Cloud (AWS, Azure, GCP) pour l’hébergement et la scalabilité des applications.<br><br>Vos projets comprendront :<br>• Des plateformes d’infrastructures cloud<br>• Des solutions de déploiement automatisé<br>• Des systèmes de surveillance et de logging avancés<br>• Des environnements de développement intégrés</div>', 'Web-Atrio', NULL, 'Paris', NULL, 'Developpement web', '2024-07-15 14:23:00', '2024-08-12 14:24:00', 0, 'CDI'),

(2, NULL, 'Développeur Web en Alternance (H/F)', '<div>E-Do Studio est une société de services B2B innovante basée à Saint-Ouen, spécialisée dans la production de contenu vidéo et photographique pour l\'industrie de la mode, du e-commerce et du digital. Nous mettons à disposition un espace de création comprenant des technologies de pointe ainsi qu\'un cyclorama classique, complété par des pôles de retouche et de production.<br><br>Notre mission est de faciliter la création de contenu digital pour nos clients, tout en les accompagnant dans leur transformation numérique. Dans le cadre du développement de notre offre de création de contenus digitaux (applications web, social media content, brand identity), nous recherchons un(e) développeur(se) web en alternance.<br><br>Missions principales :<br><br>- Participer à la maintenance et au développement de notre site internet<br><br>- Contribuer au développement et à l\'amélioration de nos applications web et mobile<br><br>- Collaborer avec l\'équipe sur des projets de création de contenu digital pour nos clients<br><br>- Assister dans l\'intégration de contenu en ligne et la digitalisation des entreprises clientes<br><br>- Participer à la veille technologique et proposer des solutions innovantes<br><br></div>', 'E-Do Studio', '93400', 'Saint-Ouen', '<div>Compétences recherchées&nbsp;<br><br>- Formation en cours dans le domaine du développement web (Bac+3 à Bac+5)<br><br>- Maîtrise des langages de programmation web : HTML, CSS, JavaScript<br><br>- Connaissance des frameworks front-end (ex: React, Vue.', NULL, '2024-07-22 14:27:00', '2024-08-26 14:28:00', 0, 'Alternance en contrat d\'apprentissage'),

(3, NULL, 'Développeur.euse confirmée node.js/react', '<div>Au sein d\'une équipe technique d\'une quinzaine de personnes (développeurs, QA, PO...), tes missions seront les suivantes :<br>• Amélioration de la performance des plateformes clients et candidats<br>• Ajout de nouvelles fonctionnalités<br>• Mise en pratique des bonnes pratiques (tests, CI, CD...)<br>• Etre force de proposition sur le fonctionnement du produit<br><br>La stack est la suivante :<br>• Node.js ExpressJS<br>• React ES6<br>• AWS<br>• Kubernetes, Docker, micro-services<br>• ElasticSearch<br>• PostGreSQL<br>• RabbitMQ</div>', 'Urban Linker', NULL, 'Paris', NULL, NULL, '2024-09-16 14:31:00', '2024-11-29 14:32:00', 0, 'CDD');
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
