-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 13 mai 2022 à 12:51
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pizzadb`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandespaiements`
--

DROP TABLE IF EXISTS `commandespaiements`;
CREATE TABLE IF NOT EXISTS `commandespaiements` (
  `num_com` int(11) NOT NULL AUTO_INCREMENT,
  `dateCom` date DEFAULT NULL,
  `date_trans` date DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `moy_pai` varchar(50) DEFAULT NULL,
  `ref_cli` int(11) NOT NULL,
  PRIMARY KEY (`num_com`),
  KEY `ref_cli` (`ref_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commandespaiements`
--

INSERT INTO `commandespaiements` (`num_com`, `dateCom`, `date_trans`, `montant`, `moy_pai`, `ref_cli`) VALUES
(1, '2022-04-25', '2022-04-25', 3000, 'CB', 1),
(2, '2022-04-26', '2022-04-26', 2790, 'Espèces', 1),
(3, NULL, NULL, NULL, NULL, 1),
(4, NULL, NULL, NULL, NULL, 1),
(5, NULL, NULL, NULL, NULL, 1),
(6, NULL, NULL, NULL, NULL, 1),
(7, NULL, NULL, NULL, NULL, 1),
(8, NULL, NULL, NULL, NULL, 1),
(9, NULL, NULL, NULL, NULL, 1),
(10, '2022-05-24', '2022-05-24', 3000, 'test', 1),
(11, '2022-05-13', '2022-05-13', NULL, NULL, 1),
(12, '2022-05-13', '2022-05-13', NULL, NULL, 1),
(13, '2022-05-13', '2022-05-13', NULL, NULL, 1),
(14, '2022-05-13', '2022-05-13', NULL, NULL, 1),
(15, '2022-05-13', '2022-05-13', NULL, NULL, 1),
(16, '2022-05-13', '2022-05-13', NULL, NULL, 1),
(17, '2022-05-13', '2022-05-13', 0, 'Au camion', 1),
(18, '2022-05-13', '2022-05-13', 0, 'Au camion', 1),
(19, '2022-05-13', '2022-05-13', 0, 'Au camion', 1),
(20, '2022-05-13', '2022-05-13', 0, 'Au camion', 1),
(21, '2022-05-13', '2022-05-13', 0, 'Au camion', 1),
(22, '2022-05-13', '2022-05-13', 0, 'Au camion', 1),
(23, '2022-05-13', '2022-05-13', 3000, 'Au camion', 1);

-- --------------------------------------------------------

--
-- Structure de la table `com_cli`
--

DROP TABLE IF EXISTS `com_cli`;
CREATE TABLE IF NOT EXISTS `com_cli` (
  `ref_cli` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `tel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ref_cli`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `com_cli`
--

INSERT INTO `com_cli` (`ref_cli`, `nom`, `prenom`, `adresse`, `email`, `password`, `tel`) VALUES
(1, 'Martin', 'Jean', '10 rue du panier, 75000 PARIS', 'j.martin@gmail.com', '$2y$10$aOvDZ44JEkhe4w49udfFv.pPYdXbXruN7ltiNFKrS2/wFs1dGr/7K', '0606060606'),
(6, 'Test', 'Test', 'Test', 'Test@gmail.com', '$2y$10$aOvDZ44JEkhe4w49udfFv.pPYdXbXruN7ltiNFKrS2/wFs1dGr/7K', '0606060606'),
(22, 'sqdqsd', 'sdqs', 'sdqdqs', 'Test25@gmail.com', '$2y$10$nfUlZ6tXopINK3OQdC70Ae6O/zYL2CZRg/lLpVmhwYltgs9oIWiXS', '0606060606'),
(23, 'Alves', 'Alexandre', '2 Avenue Du Grand Mail', 'a.alves1337@gmail.com', '$2y$10$MOtz89cX/ZaIY94cACuyS.rEoVQX9rzRTNj0PLiDsV6OZF745dB06', '+33782324340'),
(24, 'sdsqqs', 'sqdsqdsq', 'sdqsdqsd', 'Testmdp@gmail.com', '$2y$10$GOmeRlxaenOePkqxSR6qV.vYqqk83w0zOw2QbGiYN3Bbi7odH1lNO', '0606060606');

-- --------------------------------------------------------

--
-- Structure de la table `constituee`
--

DROP TABLE IF EXISTS `constituee`;
CREATE TABLE IF NOT EXISTS `constituee` (
  `ref_pro` int(11) NOT NULL,
  `num_com` int(11) NOT NULL,
  PRIMARY KEY (`ref_pro`,`num_com`),
  KEY `num_com` (`num_com`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

DROP TABLE IF EXISTS `ligne_commande`;
CREATE TABLE IF NOT EXISTS `ligne_commande` (
  `id` int(11) NOT NULL,
  `ref_ligne` int(11) NOT NULL AUTO_INCREMENT,
  `num_com` int(11) NOT NULL,
  `taille` int(11) NOT NULL COMMENT '0 pour part, 1 pour petite, 2 pour grande',
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`ref_ligne`),
  KEY `num_com` (`num_com`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`id`, `ref_ligne`, `num_com`, `taille`, `quantite`) VALUES
(1, 1, 0, 0, 2),
(1, 2, 0, 1, 2),
(1, 3, 0, 0, 2),
(1, 4, 0, 1, 2),
(1, 5, 0, 1, 2),
(1, 6, 0, 0, 2),
(1, 7, 7, 1, 2),
(1, 8, 7, 0, 2),
(1, 9, 8, 1, 2),
(1, 10, 8, 0, 2),
(1, 11, 9, 1, 2),
(1, 12, 9, 0, 2),
(1, 13, 11, 1, 2),
(1, 14, 11, 0, 2),
(1, 15, 12, 1, 2),
(1, 16, 12, 0, 2),
(1, 17, 13, 1, 2),
(1, 18, 13, 0, 2),
(1, 19, 14, 1, 2),
(1, 20, 14, 0, 2),
(1, 21, 15, 1, 2),
(1, 22, 15, 0, 2),
(1, 23, 16, 1, 2),
(1, 24, 16, 0, 2),
(1, 25, 18, 1, 2),
(1, 26, 18, 0, 2),
(1, 27, 19, 1, 2),
(1, 28, 19, 0, 2),
(1, 29, 20, 1, 2),
(1, 30, 20, 0, 2),
(1, 31, 21, 1, 2),
(1, 32, 21, 0, 2),
(1, 33, 22, 1, 2),
(1, 34, 22, 0, 2),
(1, 35, 23, 1, 2),
(1, 36, 23, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `list_ing`
--

DROP TABLE IF EXISTS `list_ing`;
CREATE TABLE IF NOT EXISTS `list_ing` (
  `id` int(11) NOT NULL,
  `ref_pro` int(11) NOT NULL,
  PRIMARY KEY (`id`,`ref_pro`),
  KEY `ref_pro` (`ref_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pizza`
--

DROP TABLE IF EXISTS `pizza`;
CREATE TABLE IF NOT EXISTS `pizza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `description` text,
  `prixGrande` int(11) DEFAULT NULL,
  `prixPetite` int(11) DEFAULT NULL,
  `prixPart` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pizza`
--

INSERT INTO `pizza` (`id`, `nom`, `description`, `prixGrande`, `prixPetite`, `prixPart`) VALUES
(1, 'L\'orientale', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus, ea veniam velit sed harum qui perferendis debitis cumque obcaecati.', 1500, 1000, 500),
(2, 'La saumon', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1500, 1000, 500),
(17, 'La savoyarde', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus, ea veniam velit sed harum qui perferendis debitis cumque obcaecati.', 1500, 1000, 500),
(61, 'La campagnarde', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus, ea veniam velit sed harum qui perferendis debitis cumque obcaecati.', 1500, 1000, 500),
(62, 'La grecque', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus, ea veniam velit sed harum qui perferendis debitis cumque obcaecati.', 1500, 1000, 500),
(63, 'La fruits de mers', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus, ea veniam velit sed harum qui perferendis debitis cumque obcaecati.', 1500, 1000, 500),
(64, 'L\'authentique', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus, ea veniam velit sed harum qui perferendis debitis cumque obcaecati.', 1500, 1000, 500),
(65, 'La deluxe', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus, ea veniam velit sed harum qui perferendis debitis cumque obcaecati.', 1500, 1000, -1);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `ref_pro` int(11) NOT NULL AUTO_INCREMENT,
  `stockMin` int(11) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `type` smallint(6) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `enStock` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ref_pro`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandespaiements`
--
ALTER TABLE `commandespaiements`
  ADD CONSTRAINT `commandespaiements_ibfk_1` FOREIGN KEY (`ref_cli`) REFERENCES `com_cli` (`ref_cli`);

--
-- Contraintes pour la table `constituee`
--
ALTER TABLE `constituee`
  ADD CONSTRAINT `constituee_ibfk_1` FOREIGN KEY (`ref_pro`) REFERENCES `stock` (`ref_pro`),
  ADD CONSTRAINT `constituee_ibfk_2` FOREIGN KEY (`num_com`) REFERENCES `commandespaiements` (`num_com`);

--
-- Contraintes pour la table `list_ing`
--
ALTER TABLE `list_ing`
  ADD CONSTRAINT `list_ing_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pizza` (`id`),
  ADD CONSTRAINT `list_ing_ibfk_2` FOREIGN KEY (`ref_pro`) REFERENCES `stock` (`ref_pro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
