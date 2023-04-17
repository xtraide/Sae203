-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 avr. 2023 à 12:59
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae203`
--

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_souhait_client` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materiel_souhait_client_FK` (`id_souhait_client`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id`, `nom`, `type`, `reference`, `description`, `id_souhait_client`) VALUES
(1, 'camera', 'cameraa', 'camera', 'balbla', NULL),
(2, 'x1', 'camera', 'ref1', 'description', NULL),
(3, 'x2', 'camera', 'ref2', 'description', NULL),
(4, 'x3', 'camera', 'ref3', 'description', NULL),
(5, 'x4', 'camera', 'ref4', 'description', NULL),
(6, 'x5', 'camera', 'ref5', 'description', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateD` datetime NOT NULL,
  `dateF` datetime NOT NULL,
  `statut` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT 'En attente',
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_utilisateur_FK` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `dateD`, `dateF`, `statut`, `id_utilisateur`) VALUES
(2, '2023-04-13 18:00:00', '2023-04-20 20:00:00', 'En attente', 1),
(25, '2023-03-29 18:00:00', '2023-04-05 20:00:00', 'En attente', 1);

-- --------------------------------------------------------

--
-- Structure de la table `souhait_client`
--

DROP TABLE IF EXISTS `souhait_client`;
CREATE TABLE IF NOT EXISTS `souhait_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_materiel` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `souhait_client_AK` (`id_materiel`),
  KEY `souhait_client_reservation_FK` (`id_reservation`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `souhait_client`
--

INSERT INTO `souhait_client` (`id`, `id_materiel`, `id_reservation`) VALUES
(13, 1, 25),
(14, 2, 25),
(15, 3, 25);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `date`, `email`, `mdp`, `role`) VALUES
(1, 'the', 'admin', '2023-04-12', 'admin@gmail.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin'),
(2, 'hamelin', 'remy', '2023-04-19', 'remy@gmail.com', '215ff2f0dcba41ff7d75d56cf1fe51e7a0f803787902ceaee453303713576c93', 'utilisateur');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD CONSTRAINT `materiel_souhait_client_FK` FOREIGN KEY (`id_souhait_client`) REFERENCES `souhait_client` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `souhait_client`
--
ALTER TABLE `souhait_client`
  ADD CONSTRAINT `souhait_client_reservation_FK` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
