-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 09 juil. 2021 à 11:23
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
  KEY `vendeur` (`id_vendeur`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `description`, `date_ajout`, `date_vente`, `photo`, `prix`, `etat_objet`, `signal`, `id_categorie`, `ouvert_negociation`, `status`, `id_vendeur`, `id_acheteur`, `visible`, `categorie_suggeree`) VALUES
(1, 'Tableau minimaliste', 'Lorem ipsum dolor sit amet. Et doloremque nesciunt ut voluptas blanditiis eum ratione earum. Non voluptas esse sit odit porro et animi fuga est placeat dicta. Aut nulla quae sit expedita quaerat aut explicabo itaque et rerum quaerat non quasi nihil. Ut expedita accusantium cum consequatur maxime qui aperiam dignissimos.\n\nUt amet voluptatum et magnam corporis qui iusto dolorum qui quae voluptas rem consequatur molestiae. Est voluptatem consectetur eum iste galisum et porro quod quo sunt quibusdam sit laboriosam consequuntur ut animi laboriosam. Aut dolorem quam hic officia amet 33 eligendi eveniet ea velit sequi et perspiciatis exercitationem eum enim neque aut Quis labore. ', '2021-07-08 13:46:07', NULL, '2_1_080721.png', 250, 'neuf', NULL, 2, 'oui', 'disponible', 2, NULL, 1, NULL),
(2, 'Bague ciselure', 'Lorem ipsum dolor sit amet. Et doloremque nesciunt ut voluptas blanditiis eum ratione earum. Non voluptas esse sit odit porro et animi fuga est placeat dicta. Aut nulla quae sit expedita quaerat aut explicabo itaque et rerum quaerat non quasi nihil. Ut expedita accusantium cum consequatur maxime qui aperiam dignissimos. ', '2021-07-08 13:57:00', NULL, '2_2_080721.jpg', 500, 'très bon état', NULL, 1, 'non', 'disponible', 2, NULL, 1, NULL),
(3, 'Mustang Bullit', 'Ut amet voluptatum et magnam corporis qui iusto dolorum qui quae voluptas rem consequatur molestiae. Est voluptatem consectetur eum iste galisum et porro quod quo sunt quibusdam sit laboriosam consequuntur ut animi laboriosam. Aut dolorem quam hic officia amet 33 eligendi eveniet ea velit sequi et perspiciatis exercitationem eum enim neque aut Quis labore. ', '2021-07-08 14:09:46', NULL, '2_3_080721.jpg', 60000, 'bon état', NULL, 4, 'non', 'disponible', 2, NULL, 1, NULL),
(4, 'Miroir design', 'In odit soluta aut ducimus nisi qui quia expedita ut numquam ipsa et veritatis quasi nam exercitationem quia. Qui debitis facere est dolorem vitae sit dolor eveniet eum ipsum rerum aut quisquam distinctio non officia quia. Sed repudiandae dolores aut quae odio est beatae voluptatibus non voluptatem ipsum quo neque consectetur ex quod consequatur ad quidem molestiae. Ut aliquam nulla qui unde voluptatibus et facilis in veniam voluptates. ', '2021-07-08 14:47:23', NULL, '2_4_080721.jpg', 500, 'neuf', NULL, 5, 'oui', 'disponible', 2, NULL, 1, NULL),
(5, 'Mini console rétro', 'In odit soluta aut ducimus nisi qui quia expedita ut numquam ipsa et veritatis quasi nam exercitationem quia. Qui debitis facere est dolorem vitae sit dolor eveniet eum ipsum rerum aut quisquam distinctio non officia quia. Sed repudiandae dolores aut quae odio est beatae voluptatibus non voluptatem ipsum quo neque consectetur ex quod consequatur ad quidem molestiae. Ut aliquam nulla qui unde voluptatibus et facilis in veniam voluptates. ', '2021-07-08 14:49:08', NULL, '2_5_080721.jpg', 150, 'bon état', NULL, NULL, 'non', 'disponible', 2, NULL, 0, 'Retro Pop');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `nom` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`nom`, `id`) VALUES
('Bijoux', 1),
('Tableaux', 2),
('Vetements', 3),
('Voitures', 4),
('Meubles', 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `date`, `contenu`, `id_expediteur`) VALUES
(1, '2021-07-08 14:58:09', 'Bonjour, je suis intéressée. Pourriez-vous m\'en dire plus SVP ?', 3),
(2, '2021-07-08 15:09:19', 'J\'avais oublié, c\'est pour le tableau. Merci', 3),
(3, '2021-07-08 15:19:32', 'Bonjour. Bien sûr, il s\'agit d\'un tableau contemporain, réalisé à l\'encre sur une toile tendue blanche. L\'encadrement est', 2),
(4, '2021-07-08 15:25:31', '... réalisé en bois de cèdre.', 2);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_vendeur` int(255) NOT NULL,
  `note` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `identifiant`, `mdp`, `mail`, `status`, `droit`, `zip`, `date_inscription`, `nb_articles_vendus`) VALUES
(1, 'admin', '$2y$10$19ZWyVfquuHA7NP2NvteO.NmEcWoKhQ5W3yKeq9e7Po0U3MC49s42', 'admin@admin.fr', 'vendeur', 1, 13001, '2021-07-08 11:15:13', 0),
(2, 'vendeur', '$2y$10$6ilP/896xnfnzVi0BVmQyetNbRQL2j8XGXmklrysbpxgZoai/sBge', 'vendeur@vendeur.fr', 'vendeur', 0, 13001, '2021-07-08 13:32:28', 0),
(3, 'client', '$2y$10$NkY40cLSkUNW999tJckwi.kb4f4zh25la9suUeKx8CwgN8zbYjrMO', 'client@client.fr', 'client', 0, 13001, '2021-07-08 13:34:02', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur_article`
--

INSERT INTO `utilisateur_article` (`id`, `id_client`, `id_article`, `id_vendeur`) VALUES
(1, NULL, 1, 2),
(2, NULL, 2, 2),
(3, NULL, 3, 2),
(4, NULL, 4, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur_message`
--

INSERT INTO `utilisateur_message` (`id`, `id_message`, `id_destinataire`, `notification`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 3, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `id_expediteur` FOREIGN KEY (`id_expediteur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `utilisateur_article`
--
ALTER TABLE `utilisateur_article`
  ADD CONSTRAINT `article_suppr` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_vente` FOREIGN KEY (`id_client`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_article_ibfk_1` FOREIGN KEY (`id_vendeur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
