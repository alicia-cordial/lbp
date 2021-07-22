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
-- Structure de la table `utilisateur_article`
--

DROP TABLE IF EXISTS `utilisateur_article`;
CREATE TABLE IF NOT EXISTS `utilisateur_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `id_article` int(11) NOT NULL,
  `id_vendeur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client` (`id_client`),
  KEY `vendeur` (`id_vendeur`),
  KEY `article_suppression` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur_article`
--

INSERT INTO `utilisateur_article` (`id`, `id_client`, `id_article`, `id_vendeur`) VALUES
(1, 3, 1, 2),
(2, NULL, 2, 2),
(3, NULL, 3, 2),
(4, NULL, 4, 2),
(5, NULL, 6, 2),
(6, 6, 7, 4),
(7, NULL, 8, 4),
(8, NULL, 9, 4),
(9, NULL, 10, 4),
(10, NULL, 11, 4),
(11, NULL, 12, 5),
(12, NULL, 13, 5),
(13, NULL, 14, 5),
(14, NULL, 15, 5),
(15, NULL, 16, 5);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateur_article`
--
ALTER TABLE `utilisateur_article`
  ADD CONSTRAINT `article_suppr` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_vente` FOREIGN KEY (`id_client`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_article_ibfk_1` FOREIGN KEY (`id_vendeur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
