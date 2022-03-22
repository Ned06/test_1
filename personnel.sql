-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 20 mai 2021 à 21:59
-- Version du serveur :  5.7.34
-- Version de PHP :  7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `personnel`
--

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `refCont` int(11) NOT NULL,
  `refUti` int(9) NOT NULL,
  `datedebutCont` date DEFAULT NULL,
  `datefinCont` date DEFAULT NULL,
  `reftypCont` int(9) NOT NULL,
  `descripCont` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contrat`
--

INSERT INTO `contrat` (`refCont`, `refUti`, `datedebutCont`, `datefinCont`, `reftypCont`, `descripCont`) VALUES
(1, 2, '2021-05-28', '2021-05-19', 1, 'rien');

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

CREATE TABLE `presence` (
  `presenceId` int(11) NOT NULL,
  `jourPresence` date DEFAULT NULL,
  `heureArriveePresence` time DEFAULT NULL,
  `heureDepartPresence` time DEFAULT NULL,
  `refUti` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `presence`
--

INSERT INTO `presence` (`presenceId`, `jourPresence`, `heureArriveePresence`, `heureDepartPresence`, `refUti`) VALUES
(1, '2006-05-21', '10:17:53', '06:08:05', 4),
(2, '2006-05-21', '10:23:40', '05:34:04', 4),
(3, '2006-05-21', '10:36:48', NULL, 5),
(4, '2006-05-21', '10:45:17', '10:47:24', 2),
(5, '2006-05-21', '10:47:24', '10:47:24', 2),
(6, '2006-05-21', '10:52:03', NULL, 2),
(7, '2006-05-21', '11:00:42', NULL, 2),
(8, '2006-05-21', '11:03:25', NULL, 2),
(9, '2006-05-21', '11:23:28', NULL, 3),
(10, '2007-05-21', '10:13:55', NULL, 6),
(11, '2007-05-21', '05:12:16', '12:20:12', 6),
(12, '2007-05-21', '05:20:39', NULL, 3),
(13, '2007-05-21', '05:21:19', NULL, 3),
(14, '2007-05-21', '05:21:55', NULL, 3),
(15, '2007-05-21', '05:28:56', NULL, 2),
(16, '2007-05-21', '05:58:35', NULL, 2),
(17, '2007-05-21', '06:03:16', NULL, 4),
(18, '2007-05-21', '06:07:58', NULL, 4),
(19, '2007-05-21', '06:08:53', '06:35:17', 4),
(20, '2007-05-21', '06:48:06', '06:48:12', 3),
(21, '2008-05-21', '11:07:50', '11:22:34', 8),
(22, '2008-05-21', '11:22:47', '11:25:18', 8),
(23, '2019-05-21', '09:20:36', '11:48:30', 2),
(24, '2019-05-21', '11:48:52', NULL, 2),
(25, '2020-05-21', '06:15:13', '07:10:02', 2),
(26, '2020-05-21', '07:10:17', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `refServices` int(9) NOT NULL,
  `descripServices` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`refServices`, `descripServices`) VALUES
(1, 'Livraison'),
(2, 'Stock'),
(3, 'Marketing'),
(4, 'Marketing'),
(5, 'Commercial'),
(6, 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `idTache` int(11) NOT NULL,
  `descripTache` varchar(30) NOT NULL,
  `dateTache` date NOT NULL,
  `refUti` int(9) NOT NULL,
  `natureTache` varchar(255) DEFAULT NULL,
  `detailTache` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`idTache`, `descripTache`, `dateTache`, `refUti`, `natureTache`, `detailTache`) VALUES
(1, 'Lorem', '2021-05-21', 2, 'TERMINEE', 'gg'),
(2, ';b', '2021-05-21', 2, 'TERMINEE', 'dddddddd');

-- --------------------------------------------------------

--
-- Structure de la table `type_contrat`
--

CREATE TABLE `type_contrat` (
  `reftypCont` int(9) NOT NULL,
  `descriptypCont` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_contrat`
--

INSERT INTO `type_contrat` (`reftypCont`, `descriptypCont`) VALUES
(1, 'CDD'),
(2, 'CDI'),
(3, 'STAGE'),
(4, 'ALTERNANT');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `codeTypeUti` int(9) NOT NULL,
  `descripTypeUti` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`codeTypeUti`, `descripTypeUti`) VALUES
(1, 'Administrateur'),
(2, 'Informaticien'),
(3, 'Commercial'),
(4, 'Gestionnaire de stocks'),
(5, 'Assistant de direction');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `refUti` int(9) NOT NULL,
  `nomUti` varchar(15) NOT NULL,
  `pnomUti` varchar(35) NOT NULL,
  `mailUti` varchar(40) NOT NULL,
  `motpassUti` varchar(60) NOT NULL,
  `contUti` varchar(16) NOT NULL,
  `adressUti` varchar(50) NOT NULL,
  `statutUti` varchar(50) DEFAULT NULL,
  `codeTypeUti` int(9) NOT NULL,
  `refServices` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`refUti`, `nomUti`, `pnomUti`, `mailUti`, `motpassUti`, `contUti`, `adressUti`, `statutUti`, `codeTypeUti`, `refServices`) VALUES
(1, 'Test', 'test', 'test@test.fr', '$2y$10$J6h7aJ56yryZRtR1fhBkieXuFgzUFiXJyx4vEzKu77Ts8hPH38ewy', '', '', NULL, 1, 1),
(2, 'Anga', 'Herman', 'anga@live.fr', '$2y$10$6wkpfZ/wO1hq6iAB9wyE3uKBF7AdZyH57jPVushd/1/RgIthoPOQC', '+225 66 99 88 44', 'Abobo Baoule', 'DISPONIBLE', 2, 4),
(3, 'lool', 'oll', 'oil@live.fr', '$2y$10$Ory9k46J6Qiv7Xmn28XKFOSIot/00/xzwYOkQwjljLZ6Yv9pxEMzW', '+225 88 77 43 22', 'fshrb', 'DISPONIBLE', 3, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`refCont`),
  ADD KEY `refUti` (`refUti`),
  ADD KEY `reftypCont` (`reftypCont`);

--
-- Index pour la table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`presenceId`),
  ADD KEY `refUti` (`refUti`),
  ADD KEY `refUti_2` (`refUti`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`refServices`);

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`idTache`),
  ADD KEY `refUti` (`refUti`);

--
-- Index pour la table `type_contrat`
--
ALTER TABLE `type_contrat`
  ADD PRIMARY KEY (`reftypCont`);

--
-- Index pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  ADD PRIMARY KEY (`codeTypeUti`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`refUti`),
  ADD UNIQUE KEY `mailUti` (`mailUti`),
  ADD KEY `codeTypeUti` (`codeTypeUti`),
  ADD KEY `refServices` (`refServices`),
  ADD KEY `refServices_2` (`refServices`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `refCont` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `presence`
--
ALTER TABLE `presence`
  MODIFY `presenceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `refServices` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `idTache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_contrat`
--
ALTER TABLE `type_contrat`
  MODIFY `reftypCont` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `codeTypeUti` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `refUti` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `contrat_ibfk_1` FOREIGN KEY (`refUti`) REFERENCES `utilisateur` (`refUti`),
  ADD CONSTRAINT `contrat_ibfk_2` FOREIGN KEY (`reftypCont`) REFERENCES `type_contrat` (`reftypCont`);

--
-- Contraintes pour la table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `presence_ibfk_1` FOREIGN KEY (`refUti`) REFERENCES `utilisateur` (`refUti`);

--
-- Contraintes pour la table `taches`
--
ALTER TABLE `taches`
  ADD CONSTRAINT `taches_ibfk_1` FOREIGN KEY (`refUti`) REFERENCES `utilisateur` (`refUti`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`codeTypeUti`) REFERENCES `type_utilisateur` (`codeTypeUti`),
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`refServices`) REFERENCES `services` (`refServices`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
