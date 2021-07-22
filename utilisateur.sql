-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 juil. 2021 à 13:10
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lbp`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `status` enum('client','vendeur','supprimé') NOT NULL,
  `droit` int(1) DEFAULT '0',
  `zip` int(5) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nb_articles_vendus` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `identifiant`, `mdp`, `mail`, `status`, `droit`, `zip`, `date_inscription`, `nb_articles_vendus`) VALUES
(1, 'admin', '$2y$10$19ZWyVfquuHA7NP2NvteO.NmEcWoKhQ5W3yKeq9e7Po0U3MC49s42', 'admin@admin.fr', 'vendeur', 1, 13001, '2021-07-08 11:15:13', 0),
(2, 'vendeur', '$2y$10$6ilP/896xnfnzVi0BVmQyetNbRQL2j8XGXmklrysbpxgZoai/sBge', 'vendeur@vendeur.fr', 'vendeur', 0, 13001, '2021-07-08 13:32:28', 1),
(3, 'client', '$2y$10$NkY40cLSkUNW999tJckwi.kb4f4zh25la9suUeKx8CwgN8zbYjrMO', 'client@client.fr', 'client', 0, 13001, '2021-07-08 13:34:02', 0),
(4, 'vendeur2', '$2y$10$beSUUniEXm/rTtQSPU2g5uEknB03OZEuxV7.n8ZvHgssAtASPs0oK', 'vendeur2@vendeur.fr', 'vendeur', 0, 34000, '2021-07-16 15:00:05', 1),
(5, 'vendeur3', '$2y$10$fAj1dGpRiuYGlNohhOtheO/1x3SQanbKeaFtaQ/swjYPuHb5sQrGO', 'vendeur3@vendeur.fr', 'vendeur', 0, 75000, '2021-07-16 16:00:58', 0),
(6, 'client2', '$2y$10$NkY40cLSkUNW999tJckwi.kb4f4zh25la9suUeKx8CwgN8zbYjrMO', 'client2@client.fr', 'client', 0, 69001, '2021-07-17 16:55:41', 0),
(7, 'client3', '$2y$10$mL0LmkiMFxnQKEz9wZeS0e2VWrSHXeJXTze8yySXjYC60nwpYkbQu', 'client3@client.fr', 'client', 0, 69005, '2021-07-17 17:12:44', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
