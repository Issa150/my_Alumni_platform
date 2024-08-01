-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 août 2024 à 11:02
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app`
--
CREATE DATABASE IF NOT EXISTS `app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `app`;

-- --------------------------------------------------------

--
-- Structure de la table `emploi`
--

CREATE TABLE `emploi` (
  `id` int(11) NOT NULL,
  `user_id_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `entreprise` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`skills`)),
  `field` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`field`)),
  `publication_date` date NOT NULL,
  `limit_offer` date DEFAULT NULL,
  `teleworking` varchar(255) DEFAULT NULL,
  `contract` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`contract`)),
  `link` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emploi`
--

INSERT INTO `emploi` (`id`, `user_id_id`, `name`, `description`, `entreprise`, `zipcode`, `city`, `skills`, `field`, `publication_date`, `limit_offer`, `teleworking`, `contract`, `link`, `logo`, `status`) VALUES
(1, NULL, 'Developpeur DEVOPS', '<div>Votre Mission :<br><br>En tant que Développeur DevOps en CDI, vous jouerez un rôle clé dans la mise en place et l’optimisation des infrastructures et des processus de déploiement pour nos projets innovants :<br>• Infrastructure as Code (IaC) avec Terraform et Ansible pour une gestion efficace des configurations.<br>• CI/CD avec Jenkins, GitLab et Azure DevOps pour automatiser les pipelines de déploiement.<br>• Docker et Kubernetes pour le déploiement et la gestion des applications en conteneur.<br>• Monitoring et Logging avec Prometheus, Grafana, et ELK Stack pour assurer la performance et la stabilité des systèmes.<br>• Cloud (AWS, Azure, GCP) pour l’hébergement et la scalabilité des applications.<br><br>Vos projets comprendront :<br>• Des plateformes d’infrastructures cloud<br>• Des solutions de déploiement automatisé<br>• Des systèmes de surveillance et de logging avancés<br>• Des environnements de développement intégrés</div>', 'Web-Atrio', NULL, 'Paris', '[\"cpp\"]', '[\"web\"]', '2024-07-15', '2024-08-12', 'OnSite', '[\"cdi\"]', '', '', 'pending'),
(2, NULL, 'Développeur Web en Alternance (H/F)', '<div>E-Do Studio est une société de services B2B innovante basée à Saint-Ouen, spécialisée dans la production de contenu vidéo et photographique pour l\'industrie de la mode, du e-commerce et du digital. Nous mettons à disposition un espace de création comprenant des technologies de pointe ainsi qu\'un cyclorama classique, complété par des pôles de retouche et de production.<br><br>Notre mission est de faciliter la création de contenu digital pour nos clients, tout en les accompagnant dans leur transformation numérique. Dans le cadre du développement de notre offre de création de contenus digitaux (applications web, social media content, brand identity), nous recherchons un(e) développeur(se) web en alternance.<br><br>Missions principales :<br><br>- Participer à la maintenance et au développement de notre site internet<br><br>- Contribuer au développement et à l\'amélioration de nos applications web et mobile<br><br>- Collaborer avec l\'équipe sur des projets de création de contenu digital pour nos clients<br><br>- Assister dans l\'intégration de contenu en ligne et la digitalisation des entreprises clientes<br><br>- Participer à la veille technologique et proposer des solutions innovantes<br><br></div>', 'E-Do Studio', '93400', 'Saint-Ouen', '[\"cpp\"]', '[\"web\"]', '2024-07-22', '2024-08-26', 'OnSite', '[\"cdi\"]', '', '', 'pending'),
(3, NULL, 'Développeur.euse confirmée node.js/react', '<div>Au sein d\'une équipe technique d\'une quinzaine de personnes (développeurs, QA, PO...), tes missions seront les suivantes :<br>• Amélioration de la performance des plateformes clients et candidats<br>• Ajout de nouvelles fonctionnalités<br>• Mise en pratique des bonnes pratiques (tests, CI, CD...)<br>• Etre force de proposition sur le fonctionnement du produit<br><br>La stack est la suivante :<br>• Node.js ExpressJS<br>• React ES6<br>• AWS<br>• Kubernetes, Docker, micro-services<br>• ElasticSearch<br>• PostGreSQL<br>• RabbitMQ</div>', 'Urban Linker', NULL, 'Paris', '[\"cpp\"]', '[\"web\"]', '2024-09-16', '2024-11-29', 'OnSite', '[\"cdi\"]', '', '', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `begin_at` date NOT NULL COMMENT '(DC2Type:date_immutable)',
  `end_at` date NOT NULL COMMENT '(DC2Type:date_immutable)',
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `user_id_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `begin_at` date NOT NULL COMMENT '(DC2Type:date_immutable)',
  `end_at` date DEFAULT NULL COMMENT '(DC2Type:date_immutable)',
  `degree` varchar(255) NOT NULL,
  `funding` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`funding`)),
  `teleworking` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `required_level` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `user_id_id`, `name`, `description`, `zipcode`, `city`, `begin_at`, `end_at`, `degree`, `funding`, `teleworking`, `link`, `required_level`, `logo`, `status`) VALUES
(2, NULL, 'Concepteur développeur d\'application', '<div>Préparez-vous à devenir un Concepteur Développeur d’Applications compétent, certifié et recruté !<br><br></div><div>Grâce à un programme innovant, alliant conception, programmation et gestion de projet, vous menant à un Titre Professionnel niveau bac+4 reconnu par l’État.<br><br></div>', '75010', 'paris', '2024-09-16', '2025-06-16', 'bac +4', '[\"autre\"]', 'OnSite', '', 'Level3', '', ''),
(3, NULL, 'Administrateur d’infrastructures sécurisées (AIS) en alternance', '<div>Administrer et sécuriser les infrastructures.<br>Concevoir et mettre en oeuvre une solution en réponse à un besoin d’évolution.<br>Participer à la gestion de la cybersécurité.</div>', '75010', 'paris', '2024-09-23', '2025-06-23', 'bac +4', '[\"autre\"]', 'OnSite', '', 'Level3', '', ''),
(4, NULL, 'Concepteur Designer UX/UI en Alternance', '<div>Concevoir les éléments graphiques d’une<br>interface et de supports de communication.<br>Contribuer à la gestion et au suivi d’un projet de communication numérique.<br>Réaliser, améliorer et animer des sites web.</div>', '75010', 'paris', '2024-10-14', '2025-07-28', 'bac +4', '[\"autre\"]', 'OnSite', '', 'Level3', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `social_links`
--

INSERT INTO `social_links` (`id`, `user_id`, `url`) VALUES
(1, 6, 'https://github.com/BottiEmma'),
(2, 6, 'http://www.linkedin.com/in/emma-botti-a09aaa2b6'),
(3, 4, 'https://github.com/BottiEmma'),
(5, 4, 'https://www.linkedin.com/in/emma-botti-a09aaa2b6/');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `bio` longtext DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `study_field` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `last_connected_at` date DEFAULT NULL COMMENT '(DC2Type:date_immutable)',
  `picture` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `certificate_obtention` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `phone_number`, `bio`, `cv`, `date_of_birth`, `study_field`, `gender`, `last_connected_at`, `picture`, `cover`, `city`, `country`, `certificate_obtention`) VALUES
(1, 'admin@colombbus.org', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$fU1nX5ORO4GCD.Ns4k/oiuqj6uXJYCbE1AO8kgTSF99tEFOKN.mA2', 'Admin', NULL, NULL, 'Je suis un administrateur.', NULL, NULL, NULL, NULL, '2024-07-25', NULL, NULL, NULL, NULL, 2020),
(2, 'emma.botti@10mentionweb.org', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$.RYBGwr/XgIMk8Jbgnut2.0oRfs0FKYin9nzqILYrzb11NyzBw1NG', 'User', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2022),
(3, 'partner@colombbus.org', '[\"ROLE_PARTNER\"]', '$2y$13$fU1nX5ORO4GCD.Ns4k/oiuqj6uXJYCbE1AO8kgTSF99tEFOKN.mA2', 'Partner', NULL, NULL, 'Je suis partenaire.', NULL, NULL, NULL, NULL, '2024-07-24', NULL, NULL, NULL, NULL, 2022),
(4, 'alumni@colombbus.org', '[\"ROLE_USER\"]', '$2y$13$Wv8DfmHZR3bJakabcYtrNOkabFCAslhqmki/1jpWx7XlCEStl7WoC', 'Jean', 'Dupont', NULL, NULL, NULL, NULL, 'Web', 'Woman', '2024-07-26', NULL, NULL, 'Paris', 'France', 2023),
(5, 'emmbotti@gmail.com', '[]', '$2y$13$WSNdSS.sZlJXZW.d4wlnD.q3FrT5dHwBe.LT6HOkStjE3Dwz0heSy', 'User', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-03', NULL, NULL, NULL, NULL, NULL),
(6, 'test@colombbus.org', '[]', '$2y$13$uG/ar9TSBqLx8aECjF5ax..RsQI9f5g7TZJnivoLpG3EoJgmKFbrK', 'Emma', 'Botti', '0612345678', 'Je suis en alternance chez 10MentionWeb.', NULL, NULL, 'Web', 'Woman', '2024-07-24', NULL, NULL, 'Paris', 'France', 2023);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `emploi`
--
ALTER TABLE `emploi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_74A0B0FA9D86650F` (`user_id_id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_404021BF9D86650F` (`user_id_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9B12158AA76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `emploi`
--
ALTER TABLE `emploi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emploi`
--
ALTER TABLE `emploi`
  ADD CONSTRAINT `FK_74A0B0FA9D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_404021BF9D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `social_links`
--
ALTER TABLE `social_links`
  ADD CONSTRAINT `FK_9B12158AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
