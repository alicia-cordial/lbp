-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 07 juin 2021 à 08:18
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
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_vente` datetime DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `prix` int(20) NOT NULL,
  `etat_objet` enum('neuf','très bon état','bon état') NOT NULL,
  `signal` int(1) DEFAULT NULL,
  `id_categorie` int(1) DEFAULT NULL,
  `ouvert_negociation` enum('oui','non') NOT NULL,
  `status` enum('disponible','vendu') NOT NULL,
  `id_vendeur` int(11) NOT NULL,
  `id_acheteur` int(11) DEFAULT NULL,
  `visible` int(255) NOT NULL DEFAULT '1',
  `categorie_suggeree` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `acheteur` (`id_acheteur`),
  KEY `vendeur` (`id_vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `description`, `date_ajout`, `date_vente`, `photo`, `prix`, `etat_objet`, `signal`, `id_categorie`, `ouvert_negociation`, `status`, `id_vendeur`, `id_acheteur`, `visible`, `categorie_suggeree`) VALUES
(47, 'lala', 'lala', '2021-06-05 22:02:16', NULL, 'lala', 20, 'bon état', NULL, 3, 'non', 'disponible', 4, NULL, 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
