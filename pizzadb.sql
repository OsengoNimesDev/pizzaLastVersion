-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 21 avr. 2022 à 07:18
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
-- Base de données : `pizzadb`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandesetpaiements`
--

DROP TABLE IF EXISTS `commandesetpaiements`;
CREATE TABLE IF NOT EXISTS `commandesetpaiements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numeroDeCommande` varchar(50) DEFAULT NULL,
  `_date` date DEFAULT NULL,
  `ref_pizza` varchar(50) DEFAULT NULL,
  `ref_produit` varchar(50) DEFAULT NULL,
  `ref_paiement` varchar(50) DEFAULT NULL,
  `date_transaction` datetime DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `moyenDePaiement` varchar(50) DEFAULT NULL,
  `id_1` int(11) NOT NULL,
  `id_2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_1` (`id_1`),
  KEY `id_2` (`id_2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comptesclients`
--

DROP TABLE IF EXISTS `comptesclients`;
CREATE TABLE IF NOT EXISTS `comptesclients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_client` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `noCarteVip` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `constituee`
--

DROP TABLE IF EXISTS `constituee`;
CREATE TABLE IF NOT EXISTS `constituee` (
  `id` int(11) NOT NULL,
  `id_1` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_1`),
  KEY `id_1` (`id_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `listingredient`
--

DROP TABLE IF EXISTS `listingredient`;
CREATE TABLE IF NOT EXISTS `listingredient` (
  `id` int(11) NOT NULL,
  `id_1` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_1`),
  KEY `id_1` (`id_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pizza`
--

DROP TABLE IF EXISTS `pizza`;
CREATE TABLE IF NOT EXISTS `pizza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `description` varchar(155) DEFAULT NULL,
  `prixGrande` int(11) DEFAULT NULL,
  `prixPetite` int(11) DEFAULT NULL,
  `prixPart` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pizza`
--

INSERT INTO `pizza` (`id`, `nom`, `description`, `prixGrande`, `prixPetite`, `prixPart`) VALUES
(1, 'Margarita', 'Sauce tomate, fromage, origan', 1350, 900, 450),
(2, 'Regina', 'Sauce tomate, fromage, jambon blanc, origan', 1400, 1000, 500),
(3, 'Reine', 'Sauce tomate, fromage, jambon blanc, champignon, origan', 1550, 1100, 600),
(4, 'Napolitaine', 'Sauce tomate, fromage, anchois, olive, origan', 1350, 1100, 600),
(6, 'Quatre fromages ', 'Sauce tomate, fromage, chèvre, bleu, mizotte, origan', 1300, 1000, 500),
(7, 'Savoyarde', 'Base crème, fromage, jambon cru, pomme de terre, reblochon, origan', 1600, 1200, 650),
(8, 'Pitchouns', 'Sauce tomate, jambon, fromage', 1200, 900, 400),
(9, 'Hawaïenne', 'Sauce tomate, fromage, poulet au curry, ananas, origan\r\n', 1500, 1150, 700),
(10, 'Tartiflette', 'Base crème, fromage, pomme de terre, lardons, oignons, reblochon, origan', 1600, 1200, 650),
(11, 'Pantagruel', 'Base crème, fromage, viande hachée, camembert, origan', 1600, 1250, 650);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `nombreEnStock` int(11) DEFAULT NULL,
  `stockMinimum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandesetpaiements`
--
ALTER TABLE `commandesetpaiements`
  ADD CONSTRAINT `commandesetpaiements_ibfk_1` FOREIGN KEY (`id_1`) REFERENCES `comptesclients` (`id`),
  ADD CONSTRAINT `commandesetpaiements_ibfk_2` FOREIGN KEY (`id_2`) REFERENCES `stock` (`id`);

--
-- Contraintes pour la table `constituee`
--
ALTER TABLE `constituee`
  ADD CONSTRAINT `constituee_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pizza` (`id`),
  ADD CONSTRAINT `constituee_ibfk_2` FOREIGN KEY (`id_1`) REFERENCES `commandesetpaiements` (`id`);

--
-- Contraintes pour la table `listingredient`
--
ALTER TABLE `listingredient`
  ADD CONSTRAINT `listingredient_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pizza` (`id`),
  ADD CONSTRAINT `listingredient_ibfk_2` FOREIGN KEY (`id_1`) REFERENCES `stock` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
