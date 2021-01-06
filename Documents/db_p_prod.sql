-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 06 Janvier 2021 à 13:57
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
(2, 1),
(2, 2),
(3, 1);

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
  `proArchive` tinyint(1) NOT NULL DEFAULT '0',
  `idCoordinator` int(11) DEFAULT NULL,
  `idInitiator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_project`
--

INSERT INTO `t_project` (`idProject`, `proName`, `proDescription`, `proStartingDate`, `proEndingDate`, `proArchive`, `idCoordinator`, `idInitiator`) VALUES
(2, '1', '1', '2020-12-01', '2020-12-31', 1, 1, 2),
(3, 'nom du projet', 'une description', '2020-12-01', '2020-12-31', 1, NULL, 1),
(4, 'projet 3', 'hfhrthrthrtrth', '2020-12-01', '2020-12-05', 0, NULL, 2),
(5, 'rtjhthrt', 'rezretretete', '0000-00-00', '0000-00-00', 0, NULL, 1),
(6, 'Simon', 'GUGISBEGRGEGR GEGSGEDRGES GGUGISBE GRGEGRGEGS GEDRGES GGUGISBEGRGE', '0000-00-00', '0000-00-00', 0, NULL, 1),
(7, 'FSFW', 'EFWEFWEF', '0000-00-00', '0000-00-00', 0, NULL, 1),
(8, 'onmi', 'ubh', '0000-00-00', '0000-00-00', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_student`
--

CREATE TABLE `t_student` (
  `idStudent` int(11) NOT NULL,
  `stuFirstName` varchar(50) NOT NULL,
  `stuLastName` varchar(50) NOT NULL,
  `stuUserName` varchar(50) NOT NULL,
  `stuPassword` varchar(200) NOT NULL,
  `stuClass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_student`
--

INSERT INTO `t_student` (`idStudent`, `stuFirstName`, `stuLastName`, `stuUserName`, `stuPassword`, `stuClass`) VALUES
(1, 'studprénom1', 'studnom1', 'studusername1', 'a', 'FIN1'),
(2, 'studprénom2', 'studnom2', 'studusername2', 'b', 'FIN1'),
(3, 'test', 'test', 'test', 'test', 'FIN1'),
(4, 'test2', 'test2', 'test2', 'test2', 'FIN2');

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
(1, 'prénom1', 'nom1', 'username1', '$2y$10$UqpPCefjmclTg7X7VCr/Ke/n3o58d9VJM50DWqtrIXp8XJD3R4/8G'),
(2, 'prénom2', 'nom2', 'username2', '222222');

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
  MODIFY `idProject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_student`
--
ALTER TABLE `t_student`
  MODIFY `idStudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_teacher`
--
ALTER TABLE `t_teacher`
  MODIFY `idTeacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
