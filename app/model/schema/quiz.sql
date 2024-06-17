-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 juin 2024 à 13:08
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Pokémon', 'Questions sur les Pokémon.'),
(2, 'Type', 'Questions sur les types de Pokémon.'),
(3, 'Évolution', 'Questions sur les évolutions des Pokémon.'),
(4, 'Pokédex', 'Questions sur le Pokédex.'),
(5, 'Shiny', 'Questions sur les Pokémon shiny.'),
(6, 'Anime', 'Questions sur l\'anime Pokémon.');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `name`, `difficulty`, `options`, `correctAnswer`, `category_id`) VALUES
(1, 'Quel Pokémon est une souris électrique ?', 'easy', '[\"Salamèche\", \"Pikachu\", \"Bulbizarre\", \"Carapuce\"]', 2, 1),
(2, 'Quel type est le Pokémon Rondoudou ?', 'easy', '[\"Eau\", \"Feu\", \"Fée\", \"Électrique\"]', 3, 2),
(3, 'Quel Pokémon évolue en Dracaufeu ?', 'easy', '[\"Reptincel\", \"Bulbizarre\", \"Carapuce\", \"Roucoups\"]', 1, 3),
(4, 'Quel Pokémon est numéro 1 dans le Pokédex ?', 'easy', '[\"Bulbizarre\", \"Herbizarre\", \"Florizarre\", \"Salamèche\"]', 1, 4),
(5, 'De quelle couleur est Léviator shiny ?', 'easy', '[\"Bleu\", \"Rouge\", \"Vert\", \"Jaune\"]', 2, 5),
(6, 'Quel Pokémon est connu pour dire \'Carapuce, à l\'attaque\' ?', 'easy', '[\"Salamèche\", \"Pikachu\", \"Bulbizarre\", \"Carapuce\"]', 4, 6),
(7, 'Quel est le type principal de Dracolosse ?', 'easy', '[\"Dragon\", \"Vol\", \"Eau\", \"Feu\"]', 1, 2),
(8, 'Quelle est l\'évolution de Pikachu ?', 'easy', '[\"Raichu\", \"Evoli\", \"Voltali\", \"Roucarnage\"]', 1, 3),
(9, 'Quel Pokémon est le partenaire principal de Sacha dans l\'anime ?', 'easy', '[\"Bulbizarre\", \"Pikachu\", \"Carapuce\", \"Salamèche\"]', 2, 6),
(10, 'Quel type de Pokémon est Arcanin ?', 'easy', '[\"Feu\", \"Eau\", \"Électrique\", \"Plante\"]', 1, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`) VALUES
(1, 'Pokemon Quiz', 'Test your knowledge about Pokemon.');

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
(10, 1);

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
