-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 06 Janvier 2021 à 13:49
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_p_prod`
--

create database db_P_PROD;
use db_P_PROD;

-- --------------------------------------------------------

--
-- Structure de la table `t_belong`
--

CREATE TABLE `t_belong` (
  `idProject` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_belong`
--

INSERT INTO `t_belong` (`idProject`, `idStudent`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_comment`
--

CREATE TABLE `t_comment` (
  `idComment` int(11) NOT NULL,
  `comContent` varchar(200) NOT NULL,
  `comDate` date NOT NULL,
  `idProject` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_project`
--

CREATE TABLE `t_project` (
  `idProject` int(11) NOT NULL,
  `proName` varchar(50) NOT NULL,
  `proDescription` varchar(200) NOT NULL,
  `proStartingDate` date NOT NULL,
  `proEndingDate` date NOT NULL,
  `idCoordinator` int(11) DEFAULT NULL,
  `idInitiator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_project`
--

INSERT INTO `t_project` (`idProject`, `proName`, `proDescription`, `proStartingDate`, `proEndingDate`, `idCoordinator`, `idInitiator`) VALUES
(1, 'Projet 1', 'Description du projet 1', '0000-00-00', '0000-00-00', NULL, 1),
(2, 'Projet 2', 'Description du projet 2', '0000-00-00', '0000-00-00', NULL, 1),
(3, 'Projet 3', 'Description du projet 3', '0000-00-00', '0000-00-00', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_student`
--

CREATE TABLE `t_student` (
  `idStudent` int(11) NOT NULL,
  `stuFirstName` varchar(50) NOT NULL,
  `stuLastName` varchar(50) NOT NULL,
  `stuUserName` varchar(50) NOT NULL,
  `stuPassword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_student`
--

INSERT INTO `t_student` (`idStudent`, `stuFirstName`, `stuLastName`, `stuUserName`, `stuPassword`) VALUES
(1, 'Student', 'Test', 'STT', '$2y$10$UqpPCefjmclTg7X7VCr/Ke/n3o58d9VJM50DWqtrIXp8XJD3R4/8G');

-- --------------------------------------------------------

--
-- Structure de la table `t_teach`
--

CREATE TABLE `t_teach` (
  `idProject` int(11) NOT NULL,
  `idTeacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_teacher`
--

CREATE TABLE `t_teacher` (
  `idTeacher` int(11) NOT NULL,
  `teaFirstName` varchar(50) NOT NULL,
  `teaLastName` varchar(50) NOT NULL,
  `teaUserName` varchar(50) NOT NULL,
  `teaPassword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_teacher`
--

INSERT INTO `t_teacher` (`idTeacher`, `teaFirstName`, `teaLastName`, `teaUserName`, `teaPassword`) VALUES
(1, 'Enseignant', 'Test', 'ETT', '$2y$10$UqpPCefjmclTg7X7VCr/Ke/n3o58d9VJM50DWqtrIXp8XJD3R4/8G');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_belong`
--
ALTER TABLE `t_belong`
  ADD PRIMARY KEY (`idStudent`,`idProject`),
  ADD UNIQUE KEY `ID_t_belong_IND` (`idStudent`,`idProject`),
  ADD KEY `FKt_b_t_p_IND` (`idProject`);

--
-- Index pour la table `t_comment`
--
ALTER TABLE `t_comment`
  ADD PRIMARY KEY (`idComment`),
  ADD UNIQUE KEY `ID_t_comment_IND` (`idComment`),
  ADD KEY `FKt_describe_IND` (`idProject`),
  ADD KEY `FKt_write_IND` (`idStudent`);

--
-- Index pour la table `t_project`
--
ALTER TABLE `t_project`
  ADD PRIMARY KEY (`idProject`),
  ADD UNIQUE KEY `ID_t_project_IND` (`idProject`),
  ADD KEY `FKt_p_t_c_FK` (`idCoordinator`),
  ADD KEY `FKt_p_t_i_FK` (`idInitiator`);

--
-- Index pour la table `t_student`
--
ALTER TABLE `t_student`
  ADD PRIMARY KEY (`idStudent`),
  ADD UNIQUE KEY `ID_t_student_IND` (`idStudent`);

--
-- Index pour la table `t_teach`
--
ALTER TABLE `t_teach`
  ADD PRIMARY KEY (`idTeacher`,`idProject`),
  ADD UNIQUE KEY `ID_t_teach_IND` (`idTeacher`,`idProject`),
  ADD KEY `FKt_t_t_p_IND` (`idProject`);

--
-- Index pour la table `t_teacher`
--
ALTER TABLE `t_teacher`
  ADD PRIMARY KEY (`idTeacher`),
  ADD UNIQUE KEY `ID_t_teacher_IND` (`idTeacher`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_comment`
--
ALTER TABLE `t_comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_project`
--
ALTER TABLE `t_project`
  MODIFY `idProject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_student`
--
ALTER TABLE `t_student`
  MODIFY `idStudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `t_teacher`
--
ALTER TABLE `t_teacher`
  MODIFY `idTeacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_belong`
--
ALTER TABLE `t_belong`
  ADD CONSTRAINT `FKt_b_t_p_FK` FOREIGN KEY (`idProject`) REFERENCES `t_project` (`idProject`),
  ADD CONSTRAINT `FKt_b_t_s` FOREIGN KEY (`idStudent`) REFERENCES `t_student` (`idStudent`);

--
-- Contraintes pour la table `t_comment`
--
ALTER TABLE `t_comment`
  ADD CONSTRAINT `FKt_describe_FK` FOREIGN KEY (`idProject`) REFERENCES `t_project` (`idProject`),
  ADD CONSTRAINT `FKt_write_FK` FOREIGN KEY (`idStudent`) REFERENCES `t_student` (`idStudent`);

--
-- Contraintes pour la table `t_project`
--
ALTER TABLE `t_project`
  ADD CONSTRAINT `FKt_p_t_c_FK` FOREIGN KEY (`idCoordinator`) REFERENCES `t_teacher` (`idTeacher`),
  ADD CONSTRAINT `FKt_p_t_i_FK` FOREIGN KEY (`idInitiator`) REFERENCES `t_teacher` (`idTeacher`);

--
-- Contraintes pour la table `t_teach`
--
ALTER TABLE `t_teach`
  ADD CONSTRAINT `FKt_t_t_p_FK` FOREIGN KEY (`idProject`) REFERENCES `t_project` (`idProject`),
  ADD CONSTRAINT `FKt_t_t_t` FOREIGN KEY (`idTeacher`) REFERENCES `t_teacher` (`idTeacher`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
