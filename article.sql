-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 juil. 2021 à 12:10
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `description`, `date_ajout`, `date_vente`, `photo`, `prix`, `etat_objet`, `signal`, `id_categorie`, `ouvert_negociation`, `status`, `id_vendeur`, `id_acheteur`, `visible`, `categorie_suggeree`) VALUES
(1, 'Tableau minimaliste', 'Lorem ipsum dolor sit amet. Et doloremque nesciunt ut voluptas blanditiis eum ratione earum. Non voluptas esse sit odit porro et animi fuga est placeat dicta. Aut nulla quae sit expedita quaerat aut explicabo itaque et rerum quaerat non quasi nihil. Ut expedita accusantium cum consequatur maxime qui aperiam dignissimos.\n\nUt amet voluptatum et magnam corporis qui iusto dolorum qui quae voluptas rem consequatur molestiae. Est voluptatem consectetur eum iste galisum et porro quod quo sunt quibusdam sit laboriosam consequuntur ut animi laboriosam. Aut dolorem quam hic officia amet 33 eligendi eveniet ea velit sequi et perspiciatis exercitationem eum enim neque aut Quis labore. ', '2021-07-08 13:46:07', '2021-07-09 11:26:52', '2_1_080721.png', 250, 'neuf', NULL, 2, 'oui', 'vendu', 2, 3, 0, NULL),
(2, 'Bague ciselure', 'Lorem ipsum dolor sit amet. Et doloremque nesciunt ut voluptas blanditiis eum ratione earum. Non voluptas esse sit odit porro et animi fuga est placeat dicta. Aut nulla quae sit expedita quaerat aut explicabo itaque et rerum quaerat non quasi nihil. Ut expedita accusantium cum consequatur maxime qui aperiam dignissimos. ', '2021-07-08 13:57:00', NULL, '2_2_080721.jpg', 500, 'très bon état', NULL, 1, 'non', 'disponible', 2, NULL, 1, NULL),
(3, 'Mustang Bullit', 'Ut amet voluptatum et magnam corporis qui iusto dolorum qui quae voluptas rem consequatur molestiae. Est voluptatem consectetur eum iste galisum et porro quod quo sunt quibusdam sit laboriosam consequuntur ut animi laboriosam. Aut dolorem quam hic officia amet 33 eligendi eveniet ea velit sequi et perspiciatis exercitationem eum enim neque aut Quis labore. ', '2021-07-08 14:09:46', NULL, '2_3_080721.jpg', 60000, 'bon état', NULL, 4, 'non', 'disponible', 2, NULL, 1, NULL),
(4, 'Miroir design', 'In odit soluta aut ducimus nisi qui quia expedita ut numquam ipsa et veritatis quasi nam exercitationem quia. Qui debitis facere est dolorem vitae sit dolor eveniet eum ipsum rerum aut quisquam distinctio non officia quia. Sed repudiandae dolores aut quae odio est beatae voluptatibus non voluptatem ipsum quo neque consectetur ex quod consequatur ad quidem molestiae. Ut aliquam nulla qui unde voluptatibus et facilis in veniam voluptates. ', '2021-07-08 14:47:23', NULL, '2_4_080721.jpg', 500, 'neuf', NULL, 5, 'oui', 'disponible', 2, NULL, 1, NULL),
(5, 'Mini console rétro', 'In odit soluta aut ducimus nisi qui quia expedita ut numquam ipsa et veritatis quasi nam exercitationem quia. Qui debitis facere est dolorem vitae sit dolor eveniet eum ipsum rerum aut quisquam distinctio non officia quia. Sed repudiandae dolores aut quae odio est beatae voluptatibus non voluptatem ipsum quo neque consectetur ex quod consequatur ad quidem molestiae. Ut aliquam nulla qui unde voluptatibus et facilis in veniam voluptates. ', '2021-07-08 14:49:08', NULL, '2_5_080721.jpg', 150, 'bon état', NULL, NULL, 'non', 'disponible', 2, NULL, 0, 'Retro Pop'),
(6, 'Foulard Hermès', 'Aut quasi incidunt eum pariatur ipsa et modi laudantium nam repudiandae molestias ad unde minima. Et optio consectetur ea dolores beatae qui earum suscipit sed mollitia necessitatibus ex illum officiis et doloremque rerum At quaerat doloribus! Cum Quis voluptas sed cumque consequuntur non similique tempora rem quaerat galisum et consequatur magni ab aspernatur quisquam et voluptatem natus. ', '2021-07-09 13:37:11', NULL, '2_5_090721.jpg', 550, 'neuf', NULL, 7, 'oui', 'disponible', 2, NULL, 1, NULL),
(7, 'Sac Louis Vuitton', 'Lorem ipsum dolor sit amet. Ut dolore aperiam et rerum perspiciatis et quidem aperiam aut fugit delectus ea quia saepe et excepturi voluptatem 33 libero omnis. Eos modi numquam sit esse reprehenderit vel repellat molestias qui quia necessitatibus et perferendis quisquam. Est alias est ipsum enim nam doloribus ducimus! In consequatur sapiente ut nihil enim et error placeat ut totam quam est beatae tempora. ', '2021-07-16 15:36:46', '2021-07-17 15:06:31', '4_1_160721.jpg', 1110, 'neuf', NULL, 7, 'oui', 'vendu', 4, 6, 0, NULL),
(8, 'Sac channel', 'Id doloremque illo qui doloribus fugiat sed deserunt perspiciatis. Ut libero soluta ad labore voluptate est possimus molestias est dolor error qui sequi iusto id rerum assumenda qui blanditiis galisum. Sit maxime nihil At facere maxime qui laborum velit et incidunt voluptas. Qui ullam facere aut fugiat rerum et ipsa necessitatibus non dolorem quaerat et dignissimos optio aut accusamus possimus. ', '2021-07-16 15:36:48', NULL, '4_2_160721.jpg', 2000, 'très bon état', NULL, 7, 'non', 'disponible', 4, NULL, 1, NULL),
(9, 'Sac burberry', 'Est minima rerum ex debitis dolor sit odio soluta sit consequatur sunt a quaerat facilis hic mollitia velit eum enim omnis. Et eaque nesciunt et quia quidem id omnis consequatur aut adipisci unde et dolorem dolore nam reiciendis aliquam. Sed odio non nulla eligendi qui consectetur velit ut voluptatum explicabo qui recusandae iste. ', '2021-07-16 15:44:59', NULL, '4_3_160721.jpg', 10500, 'très bon état', NULL, 7, 'oui', 'disponible', 4, NULL, 1, NULL),
(10, 'Sac de luxe pour chien', 'Est minima rerum ex debitis dolor sit odio soluta sit consequatur sunt a quaerat facilis hic mollitia velit eum enim omnis. Et eaque nesciunt et quia quidem id omnis consequatur aut adipisci unde et dolorem dolore nam reiciendis aliquam. Sed odio non nulla eligendi qui consectetur velit ut voluptatum explicabo qui recusandae iste. ', '2021-07-16 15:51:41', NULL, '4_4_160721.jpg', 4500, 'neuf', NULL, 7, 'oui', 'disponible', 4, NULL, 1, NULL),
(11, 'Sac luxe pour chien', 'Est minima rerum ex debitis dolor sit odio soluta sit consequatur sunt a quaerat facilis hic mollitia velit eum enim omnis. Et eaque nesciunt et quia quidem id omnis consequatur aut adipisci unde et dolorem dolore nam reiciendis aliquam. Sed odio non nulla eligendi qui consectetur velit ut voluptatum explicabo qui recusandae iste. ', '2021-07-16 15:52:44', NULL, '4_5_160721.jpg', 2000, 'très bon état', NULL, 7, 'oui', 'disponible', 4, NULL, 1, NULL),
(12, 'Chaise design industriel', 'Lorem ipsum dolor sit amet. 33 incidunt iure sed labore deserunt est adipisci maiores qui harum quia hic quisquam repellendus. Sed porro soluta id dolores quia et neque magnam qui blanditiis molestias et doloremque suscipit qui rerum velit eum sapiente quia. Sit galisum accusamus id minima nihil in quod quia ut amet modi et veniam voluptatem. ', '2021-07-17 15:59:20', NULL, '5_1_170721.png', 1500, 'très bon état', NULL, 5, 'non', 'disponible', 5, NULL, 1, NULL),
(13, 'Collier dinh van', 'Est labore inventore qui quae ratione est iusto facere et tenetur vero est labore unde. Non possimus vitae est consequatur inventore qui pariatur nisi non natus corrupti a rerum eveniet. Ab similique aliquid et quia nihil et molestiae quae non incidunt voluptatem eum galisum veniam non molestiae veniam. Ut maxime inventore et quod eveniet non autem sint sed odit dolores ea temporibus quasi a nulla molestiae et galisum dolores. ', '2021-07-17 16:05:42', NULL, '5_2_170721.jpg', 2040, 'très bon état', NULL, 1, 'non', 'disponible', 5, NULL, 1, NULL),
(14, 'Boucles d\'oreilles Swarovski', 'Est labore inventore qui quae ratione est iusto facere et tenetur vero est labore unde. Non possimus vitae est consequatur inventore qui pariatur nisi non natus corrupti a rerum eveniet. Ab similique aliquid et quia nihil et molestiae quae non incidunt voluptatem eum galisum veniam non molestiae veniam. Ut maxime inventore et quod eveniet non autem sint sed odit dolores ea temporibus quasi a nulla molestiae et galisum dolores. ', '2021-07-17 16:07:09', NULL, '5_3_170721.jpg', 300000, 'neuf', NULL, 1, 'non', 'disponible', 5, NULL, 1, NULL),
(15, 'Van volkswagen', 'Non sapiente ullam est nemo quos est enim eligendi qui similique ratione. Ab quaerat dolor et veritatis cumque et minus dolorem cum internos delectus est officiis quia. Et consequatur ratione eum provident quia At vitae facere eum repellendus dolorem aut recusandae eius est adipisci fugit. ', '2021-07-17 16:35:06', NULL, '5_4_170721.png', 300000, 'bon état', NULL, 4, 'non', 'disponible', 5, NULL, 1, NULL),
(16, 'Table design industriel', 'Non sapiente ullam est nemo quos est enim eligendi qui similique ratione. Ab quaerat dolor et veritatis cumque et minus dolorem cum internos delectus est officiis quia. Et consequatur ratione eum provident quia At vitae facere eum repellendus dolorem aut recusandae eius est adipisci fugit. ', '2021-07-17 16:54:55', NULL, '5_5_170721.png', 20030, 'neuf', NULL, 5, 'oui', 'disponible', 5, NULL, 1, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
