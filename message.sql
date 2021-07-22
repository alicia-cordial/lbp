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
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contenu` text NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_expediteur` (`id_expediteur`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `date`, `contenu`, `id_expediteur`) VALUES
(1, '2021-07-08 14:58:09', 'Bonjour, je suis intéressée. Pourriez-vous m\'en dire plus SVP ?', 3),
(2, '2021-07-08 15:09:19', 'J\'avais oublié, c\'est pour le tableau. Merci', 3),
(3, '2021-07-08 15:19:32', 'Bonjour. Bien sûr, il s\'agit d\'un tableau contemporain, réalisé à l\'encre sur une toile tendue blanche. L\'encadrement est', 2),
(4, '2021-07-08 15:25:31', '... réalisé en bois de cèdre.', 2),
(5, '2021-07-16 17:49:49', 'Merci beaucoup pour le tableau, il est superbe !', 3),
(6, '2021-07-16 17:50:39', 'En fait, je souhaite acheter la bague.', 3),
(7, '2021-07-17 16:59:01', 'Bonjour, je suis très intéressée par le sac Louis Vuitton. Possible envoi ?', 6),
(9, '2021-07-17 17:05:03', 'Je peux prendre en charge les frais de port, bien entendu.', 6),
(10, '2021-07-17 17:06:12', 'Bien sûr ! Faites moi un virement paypal au xxxx@gmail.com svp.', 4),
(11, '2021-07-17 17:18:05', 'Bonjour, je suis l\'administrateur de Cave of Wonders. Je souhaite vous féliciter pour votre première vente ! Bonne chance pour la suite et n\'hésitez pas à m\'écrire.', 1),
(13, '2021-07-17 17:29:38', 'N\'oubliez pas de liker notre page linkedIn !', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `id_expediteur` FOREIGN KEY (`id_expediteur`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
