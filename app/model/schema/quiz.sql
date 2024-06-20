-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 20 juin 2024 à 07:41
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Pokémon', 'Questions sur les Pokémon'),
(2, 'Jeux Vidéo', 'Questions sur les jeux vidéo'),
(3, 'Film', 'Questions sur les films'),
(4, 'Manga', 'Questions sur les mangas');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `difficulty` enum('easy','medium','hard') NOT NULL,
  `options` json NOT NULL,
  `correctAnswer` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `name`, `difficulty`, `options`, `correctAnswer`, `category_id`) VALUES
(1, 'Quel Pokémon est une souris électrique ?', 'medium', '[\"Salamèche\", \"Pikachu\", \"Bulbizarre\", \"Carapuce\"]', 2, 1),
(2, 'Quel type est le Pokémon Rondoudou ?', 'medium', '[\"Eau\", \"Feu\", \"Fée\", \"Électrique\"]', 3, 1),
(3, 'Quel Pokémon évolue en Dracaufeu ?', 'medium', '[\"Reptincel\", \"Bulbizarre\", \"Carapuce\", \"Roucoups\"]', 1, 1),
(4, 'Quel Pokémon est numéro 1 dans le Pokédex ?', 'medium', '[\"Bulbizarre\", \"Herbizarre\", \"Florizarre\", \"Salamèche\"]', 1, 1),
(5, 'De quelle couleur est Léviator shiny ?', 'medium', '[\"Bleu\", \"Rouge\", \"Vert\", \"Jaune\"]', 2, 1),
(6, 'Quel Pokémon est connu pour dire \"Carapuce, à l\'attaque\" ?', 'medium', '[\"Salamèche\", \"Pikachu\", \"Bulbizarre\", \"Carapuce\"]', 4, 1),
(7, 'Quel est le type principal de Dracolosse ?', 'medium', '[\"Dragon\", \"Vol\", \"Eau\", \"Feu\"]', 1, 1),
(8, 'Quelle est l\'évolution de Pikachu ?', 'medium', '[\"Raichu\", \"Evoli\", \"Voltali\", \"Roucarnage\"]', 1, 1),
(9, 'Quel Pokémon est le partenaire principal de Sacha dans l\'anime ?', 'medium', '[\"Bulbizarre\", \"Pikachu\", \"Carapuce\", \"Salamèche\"]', 2, 1),
(10, 'Quel type de Pokémon est Arcanin ?', 'medium', '[\"Feu\", \"Eau\", \"Électrique\", \"Plante\"]', 1, 1),
(11, 'Quel est le héros principal de la série The Legend of Zelda ?', 'medium', '[\"Mario\", \"Link\", \"Zelda\", \"Samus\"]', 2, 2),
(12, 'Quel jeu vidéo met en scène des voitures jouant au football ?', 'medium', '[\"FIFA\", \"Gran Turismo\", \"Rocket League\", \"Need for Speed\"]', 3, 2),
(13, 'Dans quel jeu vidéo trouve-t-on l\'île de Banoi ?', 'medium', '[\"Far Cry\", \"Dead Island\", \"The Witcher\", \"Assassin\'s Creed\"]', 2, 2),
(14, 'Quel est le nom du personnage principal de la série Halo ?', 'medium', '[\"Master Chief\", \"Cortana\", \"Marcus Fenix\", \"Gordon Freeman\"]', 1, 2),
(15, 'Quel jeu vidéo a popularisé le genre Battle Royale ?', 'medium', '[\"Minecraft\", \"Call of Duty\", \"PUBG\", \"Fortnite\"]', 4, 2),
(16, 'Dans quel jeu incarne-t-on un tueur à gages nommé Agent 47 ?', 'medium', '[\"Hitman\", \"Splinter Cell\", \"Metal Gear Solid\", \"Max Payne\"]', 1, 2),
(17, 'Quel est le studio de développement derrière le jeu The Witcher 3 ?', 'medium', '[\"BioWare\", \"Bethesda\", \"CD Projekt Red\", \"Ubisoft\"]', 3, 2),
(18, 'Dans quel jeu vidéo peut-on explorer une version fictive de l\'Amérique post-apocalyptique appelée Appalachia ?', 'medium', '[\"Fallout 76\", \"Metro Exodus\", \"The Last of Us\", \"Days Gone\"]', 1, 2),
(19, 'Quel jeu vidéo met en scène une civilisation futuriste attaquée par des créatures extraterrestres appelées les Zergs ?', 'medium', '[\"Warcraft\", \"Halo\", \"Mass Effect\", \"Starcraft\"]', 4, 2),
(20, 'Quel jeu vidéo met en scène des robots géants pilotés par des humains dans des combats intenses ?', 'medium', '[\"Overwatch\", \"Titanfall\", \"Apex Legends\", \"Destiny\"]', 2, 2),
(21, 'Quel film a remporté l\'Oscar du meilleur film en 2020 ?', 'medium', '[\"Joker\", \"1917\", \"Parasite\", \"Once Upon a Time in Hollywood\"]', 3, 3),
(22, 'Qui a réalisé le film \"Inception\" sorti en 2010 ?', 'medium', '[\"Steven Spielberg\", \"Christopher Nolan\", \"James Cameron\", \"Quentin Tarantino\"]', 2, 3),
(23, 'Dans quel film trouve-t-on le personnage de Jack Dawson ?', 'medium', '[\"Titanic\", \"Avatar\", \"Gladiator\", \"The Revenant\"]', 1, 3),
(24, 'Quel est le premier film de la saga Star Wars sorti en 1977 ?', 'medium', '[\"Le Retour du Jedi\", \"L\'Empire contre-attaque\", \"La Menace fantôme\", \"Un nouvel espoir\"]', 4, 3),
(25, 'Quel film met en scène un T-Rex et un parc à thème préhistorique ?', 'medium', '[\"King Kong\", \"Jurassic Park\", \"Le Monde perdu\", \"Dinotopia\"]', 2, 3),
(26, 'Qui joue le rôle principal dans le film \"Forrest Gump\" ?', 'medium', '[\"Tom Hanks\", \"Leonardo DiCaprio\", \"Brad Pitt\", \"Johnny Depp\"]', 1, 3),
(27, 'Quel film d\'animation de Disney met en scène un lion nommé Simba ?', 'medium', '[\"Le Roi Lion\", \"Bambi\", \"Mulan\", \"Tarzan\"]', 1, 3),
(28, 'Quel film de Quentin Tarantino raconte l\'histoire de deux gangsters, un boxeur et un couple de braqueurs ?', 'medium', '[\"Pulp Fiction\", \"Kill Bill\", \"Reservoir Dogs\", \"Django Unchained\"]', 1, 3),
(29, 'Dans quel film trouve-t-on le personnage de Neo, interprété par Keanu Reeves ?', 'medium', '[\"John Wick\", \"Constantine\", \"The Matrix\", \"Speed\"]', 3, 3),
(30, 'Quel film est basé sur l\'histoire vraie du naufrage du Titanic ?', 'medium', '[\"A Night to Remember\", \"Poseidon\", \"Titanic\", \"The Abyss\"]', 3, 3),
(31, 'Quel est le nom du héros principal de \"One Piece\" ?', 'medium', '[\"Monkey D. Luffy\", \"Naruto Uzumaki\", \"Ichigo Kurosaki\", \"Natsu Dragnir\"]', 1, 4),
(32, 'Dans \"Naruto\", quel est le démon renard à neuf queues scellé en Naruto ?', 'medium', '[\"Shukaku\", \"Gyuki\", \"Kurama\", \"Matatabi\"]', 3, 4),
(33, 'Quel manga met en scène des chasseurs de titans ?', 'medium', '[\"Bleach\", \"Attack on Titan\", \"Tokyo Ghoul\", \"Hunter x Hunter\"]', 2, 4),
(34, 'Qui est le créateur du manga \"Dragon Ball\" ?', 'medium', '[\"Eiichiro Oda\", \"Masashi Kishimoto\", \"Tite Kubo\", \"Akira Toriyama\"]', 4, 4),
(35, 'Dans \"Death Note\", quel est le nom du dieu de la mort qui accompagne Light Yagami ?', 'medium', '[\"Rem\", \"Ryuk\", \"Sidoh\", \"Zellogi\"]', 2, 4),
(36, 'Quel manga suit les aventures d\'un groupe de lycéens piégés dans un jeu mortel appelé \"Gantz\" ?', 'medium', '[\"Gantz\", \"Berserk\", \"Parasyte\", \"Tokyo Ghoul\"]', 1, 4),
(37, 'Dans \"My Hero Academia\", quel est le véritable nom de l\'héroïne Uravity ?', 'medium', '[\"Ochaco Uraraka\", \"Momo Yaoyorozu\", \"Tsuyu Asui\", \"Mina Ashido\"]', 1, 4),
(38, 'Quel manga se déroule dans le monde des alchimistes et suit les frères Elric ?', 'medium', '[\"Fullmetal Alchemist\", \"One Piece\", \"Fairy Tail\", \"Bleach\"]', 1, 4),
(39, 'Dans \"Hunter x Hunter\", quel est le nom du meilleur ami de Gon ?', 'medium', '[\"Kurapika\", \"Leorio\", \"Hisoka\", \"Killua\"]', 4, 4),
(40, 'Quel manga met en scène un jeune homme nommé Eren Jaeger qui veut éliminer tous les titans ?', 'medium', '[\"Attack on Titan\", \"Naruto\", \"Dragon Ball\", \"One Punch Man\"]', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`) VALUES
(1, 'Quiz Pokémon', 'Quiz sur les Pokémon'),
(2, 'Quiz Jeux Vidéo', 'Quiz sur les jeux vidéo'),
(3, 'Quiz Film', 'Quiz sur les films'),
(4, 'Quiz Manga', 'Quiz sur les mangas');

-- --------------------------------------------------------

--
-- Structure de la table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `question_id` int NOT NULL,
  `quiz_id` int NOT NULL,
  PRIMARY KEY (`question_id`,`quiz_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quiz_questions`
--

INSERT INTO `quiz_questions` (`question_id`, `quiz_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `quiz_questions_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
