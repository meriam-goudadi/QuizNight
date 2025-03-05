-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 14 fév. 2025 à 18:46
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiznight`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `id_quiz` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_quiz` (`id_quiz`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `description`, `id_quiz`) VALUES
(1, 'Quelle est la Capitale de la Serbie ?', 1),
(2, 'Quel est le plus petit os du corps humain ?', 1),
(3, 'Combien y a-t-il de pays dans l\'Union Européenne ?', 1),
(4, 'Quelle est la plus grande planète dans notre système solaire ?', 1),
(5, 'Quel est l\'animal le plus rapide au monde ?', 1),
(6, 'Qui a chanté \"Jailhouse Rock\" en 1957 ?', 2),
(7, 'Qui est la/le chanteur(se) le/la plus titré(e) depuis 2010 ?', 2),
(8, 'De quelle origine était le célèbre compositeur Beethoven ?', 2),
(9, 'Quelle est la 1ère musique composée découverte il y a plus de 2000 ans ?', 2),
(10, 'Quelle artiste est connue pour sa célèbre chanson \"Whenever, Wherever\" sorti en 2002 ?', 2),
(16, '\"Shining\" est inspiré d\'un roman écrit par ?', 3),
(17, 'Sur combien de jour se déroule le Festival de Cannes ?', 3),
(18, 'De quelle année date Blanche neige et les sept nains ?', 3),
(19, 'De quel film est tirée la chanson \"My heart will go on\"', 3),
(20, 'Qui est l\'acteur principal dans la saga Harry Potter ?', 3),
(21, 'Que signifie \"CSS\" en informatique ?', 4),
(22, 'Quelle est l\'unité fondamentale en informatique ?', 4),
(23, 'Quel est le protocole sécurisé utilisé sur internet ?', 4),
(24, 'Quelle est la principale différence entre un clavier français et un clavier anglais ?', 4),
(25, 'Quels sont les 3 types principaux de parcours d\'un arbre binaire ?', 4);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_user_2` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id`, `nom`, `image`, `description`, `id_user`) VALUES
(1, 'Culture G', 'cultureG.jpg', 'Testez votre culture générale, pour savoir si vous avez de bonnes connaissances. Un QCM de 5 questions avec 1 réponse possible à chaque question !', 0),
(2, 'Musique', 'musique.jpg', 'Testez votre culture en musique, pour savoir si vous avez de bonnes connaissances. Un QCM de 5 questions avec 1 réponse possible à chaque question !', 0),
(3, 'Cinéma', 'cinéma.jpg', 'Testez votre culture cinématographique, pour savoir si vous avez de bonnes connaissances. Un QCM de 5 questions avec 1 réponse possible à chaque question !', 0),
(4, 'Informatique', 'informatique.jpg', 'Testez votre culture informatique, pour savoir si vous avez de bonnes connaissances. Un QCM de 5 questions avec 1 réponse possible à chaque question !', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `id_questions` int NOT NULL,
  `is_correct` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_questions` (`id_questions`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id`, `description`, `id_questions`, `is_correct`) VALUES
(1, 'L\'étrier', 2, 1),
(2, 'Le scaphoïde', 2, 0),
(3, 'Le coccyx', 2, 0),
(4, 'Le fémur', 2, 0),
(5, '28', 3, 0),
(6, '29', 3, 0),
(7, '26', 3, 0),
(8, '27', 3, 1),
(9, 'Uranus', 4, 0),
(10, 'Mercure', 4, 0),
(11, 'Jupiter', 4, 1),
(12, 'Neptune', 4, 0),
(13, 'Le léopard', 5, 0),
(14, 'La hyène', 5, 0),
(15, 'Le puma', 5, 0),
(16, 'Le guépard', 5, 1),
(17, 'Aretha Franklin', 6, 0),
(18, 'Elvis Presley', 6, 1),
(19, 'Mickael Jackson', 6, 0),
(20, 'Whitney Houston', 6, 0),
(21, 'Mickael Jackson', 7, 0),
(22, 'Taylor Swift', 7, 0),
(23, 'Aretha Franklin', 7, 1),
(24, 'Céline Dion', 7, 0),
(25, 'Allemand', 8, 1),
(26, 'Hongroie', 8, 0),
(27, 'Russe', 8, 0),
(28, 'Suédois', 8, 0),
(29, 'L\'hymne hourrite', 9, 0),
(30, 'Epitaphe de Seikilos', 9, 1),
(31, 'Cantilène de Ste Eulalie', 9, 0),
(32, 'La vie en Rose', 9, 0),
(33, 'Beyoncé', 10, 0),
(34, 'Ariana Grande', 10, 0),
(35, 'Rihanna', 10, 0),
(36, 'Shakira', 10, 1),
(37, 'Stephen King', 16, 1),
(38, 'Steven Spielberg', 16, 0),
(39, 'Quentin Tarantino', 16, 0),
(40, 'Martin Scorcese', 16, 0),
(41, '5 jours', 17, 0),
(42, '17 jours', 17, 0),
(43, '30 jours', 17, 0),
(44, '12 jours', 17, 1),
(45, '1947', 18, 0),
(46, '1957', 18, 0),
(47, '1927', 18, 0),
(48, '1937', 18, 1),
(49, 'Coup de foudre à Nothing Hill', 19, 0),
(50, 'Forrest Gump', 19, 0),
(51, 'Titanic', 19, 1),
(52, 'N\'oublie jamais', 19, 0),
(53, 'Daniel Craig', 20, 0),
(54, 'Daniel Radcliff', 20, 1),
(55, 'Daniel Ezra', 20, 0),
(56, 'Daniel Kim', 20, 0),
(57, 'Cascading Style Sheets', 21, 1),
(58, 'Complémentaire Santé Solidaire', 21, 0),
(59, 'Cascade de Style Stylés', 21, 0),
(60, 'Cascading Some Style', 21, 0),
(61, 'Le binaire', 22, 0),
(62, 'Le bit', 22, 1),
(63, 'L\'octet', 22, 0),
(64, 'Le gigabit', 22, 0),
(65, 'Fr', 23, 0),
(66, 'Http', 23, 0),
(67, 'Https', 23, 1),
(68, 'Com', 23, 0),
(69, 'Le clavier français contient plus de touches que le clavier anglais', 24, 0),
(70, 'La disposition des lettres et des symboles', 24, 1),
(71, 'Le clavier français coûte plus cher que le clavier anglais', 24, 0),
(72, 'Aucune différence', 24, 0),
(73, 'Croissant, décroissant et aléatoire', 25, 0),
(74, 'Lenteur, rapidité et efficacité', 25, 0),
(75, 'Aller, retour et fixe', 25, 0),
(76, 'Préfixe, infixe et postfixe', 25, 1),
(77, 'Beyrouth', 1, 0),
(78, 'Belgrade', 1, 1),
(79, 'Bogota', 1, 0),
(80, 'Berne', 1, 0),
(142, 'Ronaldo', 26, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`) VALUES
(0, '', 'meriam.goudadi@laplateforme.io', '1234'),
(2, '', 'ines.charfi@laplateforme.io', '1234'),
(3, '', 'alex.bachir@laplateforme.io', '1234');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`);

--
-- Contraintes pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`id_questions`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
