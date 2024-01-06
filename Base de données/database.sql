-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 06 jan. 2024 à 14:34
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `Mail` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Tel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`Id`, `Nom`, `Prenom`, `Mail`, `Password`, `Tel`) VALUES
(1, 'Admin1', 'John', 'admin1@example.com', 'admin123', '123-456-7890'),
(2, 'Admin2', 'Jane', 'admin2@example.com', 'admin456', '987-654-3210');

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `Num` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `Nationalite` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`Num`, `Nom`, `Prenom`, `DateNaissance`, `Nationalite`) VALUES
(1, 'Rowling', 'J.K.', '1965-07-31', 'British'),
(2, 'Tolkien', 'J.R.R.', '1892-01-03', 'British'),
(3, 'Martin', 'George R.R.', '1948-09-20', 'American'),
(4, 'Atwood', 'Margaret', '1939-11-18', 'Canadian'),
(5, 'King', 'Stephen', '1947-09-21', 'American');

-- --------------------------------------------------------

--
-- Structure de la table `ecrit`
--

CREATE TABLE `ecrit` (
  `Id` int(11) NOT NULL,
  `Auteur_Num` int(11) DEFAULT NULL,
  `Livre_ISSN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ecrit`
--

INSERT INTO `ecrit` (`Id`, `Auteur_Num`, `Livre_ISSN`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 1, 6),
(7, 2, 6),
(8, 4, 10),
(9, 5, 11);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `ISSN` int(11) NOT NULL,
  `Titre` varchar(255) DEFAULT NULL,
  `Resume` text DEFAULT NULL,
  `Nbpages` int(11) DEFAULT NULL,
  `Domaine` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`ISSN`, `Titre`, `Resume`, `Nbpages`, `Domaine`) VALUES
(1, "Harry Potter and the Philosopher\'s Stone", "A young wizard\'s journey at Hogwarts.", 332, 'Fantasy'),
(2, 'The Lord of the Rings', 'Epic fantasy adventure in Middle-earth.', 1178, 'Fantasy'),
(3, 'A Game of Thrones', 'Political intrigue in the Seven Kingdoms.', 694, 'Fantasy'),
(4, "The Handmaid\'s Tale", 'Dystopian novel exploring gender roles.', 311, 'Dystopia'),
(5, 'The Shining', 'Psychological horror in an isolated hotel.', 447, 'Horror'),
(6, 'The Magical Fellowship', 'A collaboration between Rowling and Tolkien.', 500, 'Fantasy'),
(7, 'The Testaments', "Sequel to The Handmaid\'s Tale.", 432, 'Dystopia'),
(8, 'It', 'A group of friends battles an evil entity in their hometown.', 1138, 'Horror');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`Num`);

--
-- Index pour la table `ecrit`
--
ALTER TABLE `ecrit`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Auteur_Num` (`Auteur_Num`),
  ADD KEY `Livre_ISSN` (`Livre_ISSN`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`ISSN`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ecrit`
--
ALTER TABLE `ecrit`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `ISSN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ecrit`
--
ALTER TABLE `ecrit`
  ADD CONSTRAINT `ecrit_ibfk_1` FOREIGN KEY (`Auteur_Num`) REFERENCES `auteur` (`Num`),
  ADD CONSTRAINT `ecrit_ibfk_2` FOREIGN KEY (`Livre_ISSN`) REFERENCES `livre` (`ISSN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
