-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 21 jan. 2021 à 17:51
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
-- Base de données : `lokisalle`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(14, 'Réunion'),
(15, 'Conférence');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C54177093` (`room_id`),
  KEY `IDX_9474526CF675F31B` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `room_id`, `content`, `score`, `created_at`, `author_id`) VALUES
(87, 79, 'Ravie de cette location, spacieuse et agréable! Je recommande!', 3, '2021-01-17 11:29:34', 5),
(88, 79, 'C\'est toujours agréable de revenir à cet endroit!', 5, '2021-01-17 11:31:26', 5),
(89, 79, 'top!!', 4, '2021-01-17 11:34:39', 5),
(90, 84, 'Salle agréable et épurée, on a une vue magnifique!', 3, '2021-01-19 18:15:39', 5),
(91, 81, 'Dans ce lieu atypique,  j\'ai adoré le cadre, vraiment idéal pour  vos conférences!!', 4, '2021-01-19 18:20:02', 5),
(92, 82, 'Salle agréable et bien agencée!', 4, '2021-01-21 13:35:39', 5);

-- --------------------------------------------------------

--
-- Structure de la table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reduction` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `discount`
--

INSERT INTO `discount` (`id`, `discount_code`, `reduction`) VALUES
(1, '123', 10),
(3, '157', 15),
(4, '178', 50),
(5, '100', 0),
(6, '145', 25),
(7, '135', 30);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210102150935', '2021-01-02 15:13:23', 99),
('DoctrineMigrations\\Version20210103202337', '2021-01-03 20:25:44', 492),
('DoctrineMigrations\\Version20210103210036', '2021-01-03 21:06:07', 265),
('DoctrineMigrations\\Version20210103214434', '2021-01-03 21:45:11', 188),
('DoctrineMigrations\\Version20210105195125', '2021-01-05 19:53:07', 270),
('DoctrineMigrations\\Version20210105221715', '2021-01-05 22:17:24', 125),
('DoctrineMigrations\\Version20210108203839', '2021-01-08 20:40:01', 446),
('DoctrineMigrations\\Version20210109104653', '2021-01-09 10:56:31', 622),
('DoctrineMigrations\\Version20210109111726', '2021-01-09 11:24:34', 192),
('DoctrineMigrations\\Version20210109141740', '2021-01-09 14:18:06', 719),
('DoctrineMigrations\\Version20210110085603', '2021-01-10 08:57:52', 373),
('DoctrineMigrations\\Version20210113211812', '2021-01-13 21:19:02', 600),
('DoctrineMigrations\\Version20210120142209', '2021-01-20 14:22:52', 282);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `user_id`, `total_amount`, `created_at`) VALUES
(1, 5, 0, '2021-01-11 22:04:39'),
(3, 5, 0, '2021-01-15 09:44:52'),
(4, 2, 0, '2021-01-15 12:12:28'),
(5, 5, 1990, '2021-01-16 16:53:19');

-- --------------------------------------------------------

--
-- Structure de la table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `associated_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_52EA1F094584665A` (`product_id`),
  KEY `IDX_52EA1F09FC35A14E` (`associated_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_item`
--

INSERT INTO `order_item` (`id`, `associated_order_id`, `product_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(5, 3, 2),
(6, 4, 4),
(7, 5, 12),
(8, 5, 18);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `checkin_at` datetime NOT NULL,
  `checkout_at` datetime NOT NULL,
  `is_sold_out` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD54177093` (`room_id`),
  KEY `IDX_D34A04AD4C7C611F` (`discount_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `room_id`, `discount_id`, `checkin_at`, `checkout_at`, `is_sold_out`, `price`) VALUES
(1, 85, 3, '2021-03-18 07:00:00', '2021-03-19 19:00:00', 1, 560),
(2, 79, 3, '2021-03-13 09:00:00', '2021-03-14 18:00:00', 1, 280),
(3, 82, 3, '2021-02-01 07:00:00', '2021-02-02 19:00:00', 1, 160),
(4, 85, 1, '2021-05-07 09:00:00', '2021-05-09 18:00:00', 1, 450),
(5, 79, 1, '2021-05-01 09:00:00', '2021-05-03 18:00:00', 0, 250),
(6, 84, 3, '2021-03-12 09:00:00', '2021-03-15 18:00:00', 0, 300),
(7, 84, 3, '2021-04-05 09:00:00', '2021-04-09 18:00:00', 0, 350),
(8, 80, 1, '2021-02-13 09:00:00', '2021-02-15 18:00:00', 0, 1200),
(9, 80, 1, '2021-03-17 08:00:00', '2021-03-19 18:00:00', 0, 1300),
(10, 80, 6, '2021-04-05 08:00:00', '2021-04-08 18:00:00', 0, 1500),
(11, 80, 1, '2021-06-19 08:00:00', '2021-06-20 18:00:00', 0, 1400),
(12, 80, 1, '2021-07-11 08:00:00', '2021-07-13 18:00:00', 1, 1600),
(13, 83, 1, '2021-05-17 09:00:00', '2021-05-19 18:00:00', 0, 560),
(14, 81, 5, '2021-02-08 08:00:00', '2021-02-10 18:00:00', 0, 350),
(15, 81, 1, '2021-03-03 09:00:00', '2021-03-05 11:00:00', 0, 360),
(16, 81, 5, '2021-04-15 08:00:00', '2021-04-17 18:00:00', 0, 380),
(17, 79, 1, '2021-06-18 08:00:00', '2021-06-20 18:00:00', 0, 450),
(18, 81, 5, '2021-07-04 08:00:00', '2021-01-06 18:00:00', 1, 390),
(19, 82, 5, '2021-02-06 08:00:00', '2021-02-08 18:00:00', 0, 360),
(20, 82, 1, '2021-04-12 08:00:00', '2021-04-14 18:00:00', 0, 450),
(21, 82, 1, '2021-06-11 08:00:00', '2021-06-13 18:00:00', 0, 360),
(22, 83, 1, '2021-07-08 08:00:00', '2021-07-10 18:00:00', 0, 560),
(23, 86, 5, '2021-02-03 08:00:00', '2021-02-05 18:00:00', 0, 640);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(2, 'ROLE_ADMIN'),
(3, 'ROLE_MEMBER');

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_729F519B12469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`id`, `country`, `city`, `address`, `zip_code`, `title`, `description`, `photo`, `capacity`, `category_id`) VALUES
(79, 'France', 'Paris', '9, boulevard de Lopes', '75011', 'Salle Turin', 'Vous trouverez une salle pratique et fonctionnelle pour accueillir vos réunions ou petites formations.\r\nCette salle de formation, particulièrement adaptée pour une formation, une réunion, une AG, peut accueillir 4 à 8 personnes.\r\n\r\nProfitez de cette salle de réunion pleine de charme à la lumière du jour, pratique et bien située pour organiser vos évènements professionnels.\r\n\r\nLa salle peut être équipée avec un vidéoprojecteur, paperboard, du wifi. Nous pouvons proposer également des accueil petit déjeuner et des pauses café à disposition dans la salle.\r\nLokisalle vous propose des salles de formation équipées et modulables selon vos besoins pour former vos collaborateurs.', '/uploads/photos/salle-turin-60097ca76aeb2.png', 8, 14),
(80, 'France', 'Massy', 'place du Grand Ouest', '91300', 'Salle Massy', 'Ce nouveau cinéma offre pour la première fois en France la toute dernière innovation développée par Dolby Laboratories, Inc. : la salle Dolby Cinema qui combine design et confort avec le système de projection laser Dolby Vision et le son Dolby Atmos.\r\nAvec ses 9 salles et 1 844 fauteuils, ce cinéma designé par Ora-ïto, a été conçu selon nos standards de qualité pour offrir la meilleure expérience aux spectateurs : fauteuils solos et duos, numérotation, services digitaux et espaces conviviaux avec prestations variées comme un stand Häagen-Dazs, un Starbucks on the go et une offre confiserie en libre-service.', '/img/room/salle_massy.jpg', 581, 15),
(81, 'France', 'Lyon', '73, impasse Guerin', '69000', 'Salle Casablanca', 'La salle Casablanca est un endroit intimiste, décoré avec sobriété et raffinement. Situé dans le 7e arrondissement de Paris, à deux pas du centre d’affaires, du Triangle d’Or et de la gare Saint-Lazare, l’espace Bellechasse se distingue par son esthétisme prestigieux et son immeuble haussmannien. C’est dans ce lieu unique que se situe la salle cette salle. D’une superficie de 25 m2, elle se veut particulièrement intimiste. Elle pourra réunir jusqu’à 11 collaborateurs en configuration U ou en salle de réunion. Pour louer cette salle de location, vous pourrez vous adresser directement à notre équipe qui se fera un plaisir de répondre à votre demande. Vous pourrez également choisir d’utiliser cet endroit atypique comme une salle de sous-commission avec la location de l’auditorium de l’espace Bellechasse.', '/uploads/photos/salle-casablanca-600981db0e30a.png', 259, 15),
(82, 'France', 'Paris', '605, place Claudine Bouvet', '75015', 'Salle Dublin', 'Venez découvrir ce lieu d\'exception, situé en bordure de la capitale à Boulogne Billancourt et donc très facile d\'accès ! Il vous accueille dans un esprit professionnel et décontracté, pour une ambiance \"chic et jungle\"\r\n\r\nLe lieu est composé d\'un grand espace de réunion de 170m2 avec du mobilier modulable afin de répondre au mieux à vos besoins. Vous trouverez tables, chaises, canapés, fauteuils et tables basses ainsi qu\'une grande terrasse aménagée avec espace lounge pour se détendre.\r\n\r\nVous trouverez de l\'équipement à disposition : 2 vidéos projecteurs, 1 écran led, click and share, tableaux Véléda, smart marker, paper board, sonorisation, micros sans fils, Wifi très haut débit. Lieu éco responsale avec fontaine à eau Brita, zéro plastique et vaisselle bio dégradable !', '/uploads/photos/salle-dublin-6009823a5aaf1.jpg', 15, 14),
(83, 'France', 'Marseille', '30, place Lopez', '13000', 'Salle Lisbonne', 'Nous accueillons vos réunions de travail en mettant à votre disposition notre espace ouvert sur une terrasse et un jardin harmonieux. D\'une capacité d\'accueil de 12 personnes, cet espace de travail lumineux et climatisé de 29m2 est pourvu des derniers équipements technologiques: connexions informatiques, wi-fi, écran plat...\r\n\r\nEau et café seront à votre discrétion lors de votre séjour chez nous.Des ordinateurs portables, un fax et une photocopieuse sont aussi disponibles sur demande à l\'accueil. Avec une cuisine aménagée pour créer une atmosphère chaleureuse, notre salle de réunion vous promet des événements professionnels sereins et productifs.', '/uploads/photos/salle-lisbonne-6009b86832dab.jpg', 12, 14),
(84, 'France', 'Marseille', 'chemin Thierry Briand', '13000', 'Salle Moscou', 'Découvrez un lieu de prestige pour l\'organisation d\'un séminaire d\'entreprise à Cassis, proche de Marseille (45minutes de l\'aéroport, 35min de la gare).\r\nLa privatisation inclut :\r\n- 3 pièces de réception vue mer\r\n- 9 chambres 1 dortoir\r\n- 8 salles de bain\r\n- 1 salon cinéma avec vidéo projecteur et grand écran\r\n- 1 orangerie avec ping pong et babyfoot et 1 boulodrome\r\n- 1 piscine chauffée de 13 mètres vue mer\r\n- 1 chef cuisinier\r\nLa situation de la maison est exceptionnelle, située sur un terrain privé de 60 hectares, dans le parc national des calanques. La maison dispose d\'une terrasse de 500 m² surplombant une plage aux eaux turquoises, accessible à pieds en quelques minutes.', '/uploads/photos/salle-moscou-6009b8b1d0385.jpg', 15, 14),
(85, 'France', 'Lyon', '72 rue Lucy Bouvet', '69000', 'Salle Luxembourg', 'Parmi les lieux atypiques de Paris : Découvrez cet espace de travail de 30m² à la décoration cosy et décalée. Mobilier dépareillé, mur floral, nombreuses fenêtres pour une grande luminosité.\r\n\r\nHoraires d\'ouvertures : Lundi - Vendredi entre 8heures et 18heures. Minimum de réservation de 2heures.\r\n\r\nCapacités : 15 en U et salle de classe, 14 en réunion, 20 en théâtre et réception cocktail.', '/uploads/photos/salle-luxembourg-6009b8fe8a087.jpg', 20, 14),
(86, 'France', 'Paris', '84, boulevard Colas', '75011', 'Salle Prague', 'A proximité de l’Hôtel de Ville, la location de cet amphithéâtre répondra à tous types de présentations ou formations. Profitez de ce vaste espace de travail pour organiser une conférence jusqu\'à 120 personnes.\r\n\r\nCette vaste salle de 120m² peut répondre à tous types de besoin, allant de la présentation à la conférence ou encore une formation ou un séminaire.\r\n\r\nLa salle est tout équipée:\r\n- prises électriques\r\n- tableau\r\n- vidéo-projecteur\r\n- climatisation', '/uploads/photos/salle-prague-6009b93c4d70d.jpg', 450, 15),
(87, 'France', 'Lyon', '60 rue des Martyres', '69005', 'Salle Turin', 'Cette salle de réunion de prestige située à Paris près des Grands Boulevards n\'attend que vous ! Dans cette pièce aux moulures typiquement parisiennes, située en plein cœur du 8ème arrondissement, vous pourrez retrouver la quiétude d\'un chez-soi, sa superficie et sa lumière offrant un espace aéré et confortable.\r\n\r\nIdéal pour une session de brainstorming suivie d\'une pause détente dans l\'espace lounge, cet espace vous plongera dans une ambiance \"comme à la maison\". Nous pourrons par ailleurs vous proposer de quoi vous restaurer selon vos besoins.\r\n\r\nNotre établissement est ouvert 7 jours sur 7 de 7heures du matin à 23heures.', '/img/room/salle_turin.png', 30, 14),
(88, 'France', 'Lyon', '56 rue des jonquilles', '69000', 'Salle Cannes', 'La salle Cannes est une vaste salle totalement aménageable selon vos besoins. Vous pouvez ainsi demander à ce que soient installés des matériels techniques de grande qualité, particulièrement utiles pour exposer vos idées et afficher vos présentations. Un vidéo projecteur, un paper board pour vos brainstormings, un système de sonorisation ou encore le réseau Internet Wifi en haut débit sont autant d’outils techniques qui pourront être installés dans cette salle aménageable à volonté.', '/uploads/photos/salle-cannes-600739c55138f.jpg', 30, 14),
(89, 'France', 'Marseilles', '71 rue des paupiettes', '13000', 'Salle Rio', 'Dans le cadre de l’organisation de vos futures réunions professionnelles, la salle Rio sera parfaite pour réunir tous vos invités autour d’une grande table moderne et dans un décor prestigieux. En outre, ce lieu unique est situé à proximité directe des transports en commun et est très facile d’accès depuis la station de gare de Viroflay Rive Droite.', '/uploads/photos/salle-rio-6009b96e7989c.jpg', 25, 14),
(90, 'France', 'paris', '25 rue de la résistance', '75016', 'Salle Paris', 'La salle Dufrenoy est un endroit intimiste, décoré avec sobriété et raffinement. Situé dans le 7e arrondissement de Paris, à deux pas du centre d’affaires, du Triangle d’Or et de la gare Saint-Lazare, l’espace Bellechasse se distingue par son esthétisme prestigieux et son immeuble haussmannien. C’est dans ce lieu unique que se situe la salle Paris. D’une superficie de 25 m2, elle se veut particulièrement intimiste. Elle pourra réunir jusqu’à 11 collaborateurs en configuration U ou en salle de réunion. Pour louer cette salle de location, vous pourrez vous adresser directement à notre équipe qui se fera un plaisir de répondre à votre demande.', '/uploads/photos/salle-paris-6009bb43a5951.jpg', 11, 14),
(91, 'France', 'Marseille', '33 rue dumont', '13000', 'Salle Pékin', 'Pour l’organisation de votre événement professionnel à Paris, choisir de louer la salle Pékin vous permettra de réunir jusqu’à 32 personnes dans un endroit spacieux et doté de tout le matériel nécessaire. Entièrement aménageable, votre salle de réunion deviendra rapidement l’espace de travail dont vous avez besoin pour mener à bien votre événement.', '/uploads/photos/salle-pekin-6009bc3a93988.png', 32, 14);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `accept_newletter` tinyint(1) NOT NULL,
  `reset_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `lastname`, `firstname`, `email`, `gender`, `city`, `zip_code`, `address`, `enabled`, `accept_newletter`, `reset_code`) VALUES
(1, 'mei', 'loulouloulou', 'Michaux', 'Marc', 'user1@mlcreation.fr', 'm', 'laval', '53000', 'rue du bas des bois', 1, 0, NULL),
(2, 'nono', '$2y$13$62vfSGTKivTmSe8oZTCXbusfIt2PTj8JGswzzHfQDw2hbKvaiISpW', 'flechard', 'arnaud', 'nono@kleverware.com', 'm', 'perpignan', '85000', 'rue de madrid', 1, 1, NULL),
(3, 'meilan', 'totototo', 'Marie', 'Filou', 'user2@mlcreation.fr', 'f', 'bordeaux', '52545', 'rue des', 1, 0, NULL),
(4, 'agathe', '$2y$13$Sneme3RbY6wL19jdbwMpkuBsDLsZwm.jx.tMQlH/cqvK3y7/iUQE2', 'Chauchis', 'agathe', 'user3@mlcreation.fr', 'f', 'Lyon', '69000', 'rue les vachettes', 1, 1, NULL),
(5, 'carine', '$2y$13$XAjXsAJ25XM9EnSd.4VStO9e2PhCyg8w1TQx/ddqtuetgJ88J/eTm', 'raimbeau', 'carine', 'mouylang.flechard@gmail.com', 'f', 'laval', '53000', 'rue des champions', 1, 0, NULL),
(6, 'arnaud', '$2y$13$kKEPtVNesrbm/Uy9SGbMpuNSz.hC9KflDY.UPGAq8aEB6qWeMRCuK', 'flechard', 'arnaud', 'arnaud.flechard@free.fr', 'm', 'paris', '75014', '15 rue des batignolles', 1, 1, '33f116e068c20af1e4d89e3a304f2880'),
(7, 'arnaud1', '$2y$13$HAjUX.yujd16JRzlKSRp3eEMg0wXSOnuYPqrEY6SXMcMQaD0pCgvq', 'thefleche', 'Hacker', 'arnaud@flechard.fr', 'f', 'toto', '12345', 'rue des pâquerettes', 1, 1, NULL),
(8, 'alain', '$2y$13$IhXaSXtksen1bx8d9ktmOubxEhrn/U8pAiH5cXc2j7kHc/l/c6yxC', 'souchon', 'alain', 'user6@mlcreation.fr', 'm', 'Paris', '75011', '58 rue des pruniers', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 2),
(5, 3),
(6, 2),
(6, 3),
(7, 3),
(8, 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C54177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `FK_52EA1F094584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_52EA1F09FC35A14E` FOREIGN KEY (`associated_order_id`) REFERENCES `order` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD4C7C611F` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`),
  ADD CONSTRAINT `FK_D34A04AD54177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`);

--
-- Contraintes pour la table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_729F519B12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
