-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 juil. 2021 à 13:11
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
-- Structure de la table `utilisateur_message`
--

DROP TABLE IF EXISTS `utilisateur_message`;
CREATE TABLE IF NOT EXISTS `utilisateur_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_message` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `notification` int(255) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `message` (`id_message`),
  KEY `id_destinataire` (`id_destinataire`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur_message`
--

INSERT INTO `utilisateur_message` (`id`, `id_message`, `id_destinataire`, `notification`) VALUES
(1, 1, 2, 0),
(2, 2, 2, 0),
(3, 3, 3, 1),
(4, 4, 3, 1),
(5, 5, 2, 0),
(6, 6, 2, 0),
(7, 7, 4, 0),
(9, 9, 4, 0),
(10, 10, 6, 0),
(12, 11, 2, 0),
(13, 13, 2, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateur_message`
--
ALTER TABLE `utilisateur_message`
  ADD CONSTRAINT `message` FOREIGN KEY (`id_message`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_message_ibfk_1` FOREIGN KEY (`id_destinataire`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
