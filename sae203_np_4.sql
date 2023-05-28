-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 28 mai 2023 à 14:47
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
-- Base de données : `sae203_np`
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
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imghead` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id`, `nom`, `type`, `reference`, `description`, `img`, `imghead`) VALUES
(165, 'thieblemont', 'vert', 'testimg', 'testimg', '983f167bac425df0f61f6a11662da46b', '8f6bba6eaf4dc10d77a63c985d2886d1.jpg'),
(166, 'The', 'pied', 'testimg', 'testimg', 'b31b070514802c103255f86dd2c1c98e', 'efa3ed8f946e83c1346bee094f43d5a1.jpg'),
(167, 'The', 'invalid', 'testimg', 'testimg', '0ab26bfbdc42a4743558f6c5c9a3c37a', '06868294adbe4ed14e5ea01239032f0c.jpg'),
(168, 'g', 'ggggg', '4f4ff55', 'ttttttttt', '56a9b7d761127edd9b517471a2e1ad90', '25d529eddc659dfe515db6a9eb9f78ea.jpg'),
(169, 'g', 'pied', 'testimg', 'testimg', '1db0873fc886adc63ab801b4f58ec698', 'df3bd332dc667a7a180b38dba65f5530.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `quantite`
--

DROP TABLE IF EXISTS `quantite`;
CREATE TABLE IF NOT EXISTS `quantite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `id_materiel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quantite_materiel_AK` (`id_materiel`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `quantite`
--

INSERT INTO `quantite` (`id`, `quantite`, `id_materiel`) VALUES
(7, 6, 165),
(8, 1, 166),
(9, 5, 167),
(10, 5, 168),
(11, 28, 169);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `horraire_debut` time NOT NULL,
  `horraire_fin` time NOT NULL,
  `statut` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT 'en attente',
  `id_utilisateur` int(11) NOT NULL,
  `id_materiel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_utilisateur_FK` (`id_utilisateur`),
  KEY `reservation_materiel_AK` (`id_materiel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `date`, `horraire_debut`, `horraire_fin`, `statut`, `id_utilisateur`, `id_materiel`) VALUES
(53, '1111-02-17', '16:00:00', '18:00:00', 'en attente', 1, 165),
(54, '1111-02-17', '16:00:00', '18:00:00', 'en attente', 1, 165),
(55, '1111-02-17', '16:00:00', '18:00:00', 'en attente', 1, 165),
(56, '1111-02-17', '16:00:00', '18:00:00', 'en attente', 1, 165),
(57, '1111-02-17', '16:00:00', '18:00:00', 'en attente', 1, 165),
(58, '1111-02-17', '16:00:00', '18:00:00', 'en attente', 1, 165);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `date`, `email`, `mdp`, `role`, `verified`) VALUES
(1, 'the', 'admin', '2023-04-12', 'admin@gmail.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin', 1),
(18, 'thieblemont', 'nicolas', '2023-05-23', 'thieblemontnicolas@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'utilisateur', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `quantite`
--
ALTER TABLE `quantite`
  ADD CONSTRAINT `quantite_materiel_FK` FOREIGN KEY (`id_materiel`) REFERENCES `materiel` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_materiel0_FK` FOREIGN KEY (`id_materiel`) REFERENCES `materiel` (`id`),
  ADD CONSTRAINT `reservation_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
