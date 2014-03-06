-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 05 Mars 2014 à 15:10
-- Version du serveur: 5.1.66
-- Version de PHP: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet_gl`
--

-- --------------------------------------------------------

--
-- Structure de la table `blacklist`
--

DROP TABLE IF EXISTS `blacklist`;
CREATE TABLE IF NOT EXISTS `blacklist` (
  `Tel` varchar(10) NOT NULL,
  PRIMARY KEY (`Tel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `blacklist`
--

INSERT INTO `blacklist` (`Tel`) VALUES
('0102030405');

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `NomVille` varchar(50) NOT NULL,
  `CP` int(11) NOT NULL,
  `NbKm` int(11) DEFAULT '0',
  PRIMARY KEY (`NomVille`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cities`
--

INSERT INTO `cities` (`NomVille`, `CP`, `NbKm`) VALUES
('Du Terou', 696969, 200),
('Mi Louis', 212121, 300),
('Jackson', 252525, 400);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `NomVille` varchar(50) NOT NULL,
  `NomEvent` varchar(50) DEFAULT NULL,
  `HeureMeeting` time DEFAULT NULL,
  `DebutEvenement` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FinEvenement` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Adresse` varchar(250) NOT NULL,
  `Organisateur` varchar(10) DEFAULT '',
  `NbCoureurs` int(11) DEFAULT '0',
  `Infos` varchar(250) DEFAULT '',
  PRIMARY KEY (`NomVille`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `events`
--
INSERT INTO `events` (`NomVille`, `NomEvent`, `HeureMeeting`, `DebutEvenement`, `FinEvenement`, `Adresse`, `Organisateur`, `NbCoureurs`, `Infos`) VALUES
('Jackson', 'La course de la vie', '00:00:00', '2014-01-06 15:35:50', '2014-01-22 15:30:00', 'coucou tu veux voir ma bite', '0102030405', 0, ''),
('Mi Louis', NULL, NULL, '2014-01-06 15:35:50', '2014-01-22 15:30:00', 'coucou tu veux voir ma bite', '0607080910', 0, '');


-- --------------------------------------------------------

--
-- Structure de la table `parcours`
--

DROP TABLE IF EXISTS `parcours`;
CREATE TABLE IF NOT EXISTS `parcours` (
  `IdParcours` int(11) NOT NULL AUTO_INCREMENT,
  `NomVille` varchar(50) NOT NULL,
  `Longueur` double NOT NULL,
  `DureeMax` int(11) NOT NULL,
  `DureeMin` int(11) NOT NULL,
  `Latitude` float NOT NULL,
  `Longitude` float NOT NULL,
  PRIMARY KEY (`IdParcours`),
  KEY `NomVille` (`NomVille`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `parcours`
--

INSERT INTO `parcours` (`IdParcours`, `NomVille`, `Longueur`, `DureeMax`, `DureeMin`, `Latitude`, `Longitude`) VALUES
(1, 'Jackson', 1, 100, 20, 125, 53.25),
(2, 'Mi Louis', 1, 100, 20, 125, 53.25);

-- --------------------------------------------------------

--
-- Structure de la table `pendingBlacklist`
--

DROP TABLE IF EXISTS `pendingBlacklist`;
CREATE TABLE `pendingBlacklist` (
  `Tel` varchar(10) NOT NULL,
  `Organisateur` varchar(10) NOT NULL,
  `Raison` char(50) DEFAULT NULL,
  PRIMARY KEY (`Tel`,`Organisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pendingBlacklist
-- ----------------------------
INSERT INTO `pendingBlacklist` VALUES ('0607080910', '0356684868', 'Le beau gosse');

-- --------------------------------------------------------

--
-- Structure de la table `sponsors`
--

DROP TABLE IF EXISTS `sponsors`;
CREATE TABLE IF NOT EXISTS `sponsors` (
  `Nom` varchar(50) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Logo` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sponsors`
--

INSERT INTO `sponsors` (`Nom`, `URL`, `Logo`) VALUES

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE users (
  Tel varchar(10) NOT NULL,
  Nom varchar(40) NOT NULL,
  Prenom varchar(40) NOT NULL,
  Email varchar(100) NOT NULL,
  Pass varchar(64) NOT NULL,
  VilleOrigine varchar(50) NOT NULL,
  VilleEvent varchar(50) default NULL,
  NbKm int default 0,
  Confirmation varchar(20)NOT NULL,
  Etat int default 0,
  PRIMARY KEY (Tel),
  FOREIGN KEY (VilleEvent) REFERENCES events(NomVille),
  FOREIGN KEY (VilleOrigine) REFERENCES cities(NomVille)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`Tel`, `Nom`, `Prenom`, `Email`, `Pass`, `VilleOrigine`, `VilleEvent`, `NbKm`) VALUES
('0102030405', 'Cresson', 'Thomas', 'thomas.cresson@laposte.net', PASSWORD('coco'), 'Mi Louis', 'Mi Louis', 0),
('0607080910', 'Besancon', 'Lonnie', 'lonnie.besancon@u-psud.fr', PASSWORD('coco'), 'Du Terou', 'Du Terou', 0),
('0000000000', 'Admin', 'Admin', '', PASSWORD('admin'), '', NULL, 0),
('0356684868', 'TESTU', 'Benoit', 'benoit.testu@u-psud.fr', PASSWORD('coco'), 'Du Terou', 'Du Terou', 0);

-- ----------------------------
-- Table structure for `variables`
-- ----------------------------
DROP TABLE IF EXISTS `variables`;
CREATE TABLE `variables` (
  `id` char(20) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of variables
-- ----------------------------
INSERT INTO `variables` VALUES ('texte_accueil', 'Coucou tu veux voir la tour eiffel ? Moi je veux bien. Parce que c\'est beau.');
