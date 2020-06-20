-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2020 at 11:02 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestionpointage`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `code` varchar(20) NOT NULL,
  `libelle` text NOT NULL,
  `salaire` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`code`, `libelle`, `salaire`) VALUES
('C1', 'Ingenieur', 350),
('C2', 'Technicien Specialisé', 300),
('C3', 'Technicien', 280);

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `Num` varchar(50) NOT NULL DEFAULT '',
  `Nom` varchar(50) NOT NULL,
  `Descr` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`Num`, `Nom`, `Descr`) VALUES
('D1', 'Recherche', 'désigne l\'ensemble des activités entreprises « de façon systématique en vue d’accroître la somme des connaissances, y compris la connaissance de l’homme, de la culture et de la société.'),
('D2', 'Developpement informatique', 'Participer à la définition de la stratégie et des objectifs en matière de développement informatique...'),
('D3', 'ressources humaines', ' La Gestion des Ressources Humaines souhaite se démarquer de la Gestion du personnel traditionnelle par son accent sur une vision stratégique');

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `CIN` varchar(30) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `sexe` varchar(15) DEFAULT NULL,
  `adresse` varchar(250) DEFAULT NULL,
  `nbrEnfant` int(11) DEFAULT NULL,
  `passwd` varchar(150) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `dateRecrutement` date DEFAULT NULL,
  `codeF` varchar(30) DEFAULT NULL,
  `codeC` varchar(30) DEFAULT NULL,
  `num` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`CIN`, `nom`, `prenom`, `dateNaissance`, `tel`, `email`, `sexe`, `adresse`, `nbrEnfant`, `passwd`, `photo`, `role`, `dateRecrutement`, `codeF`, `codeC`, `num`) VALUES
('EE1111', 'Jokhakh', 'amine', '1997-09-25', '0611223344', 'medmainejokhakh@gmail.com', 'Homme', 'Marrakech', 2, '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 'avatar-01.jpg', 'Super Admin', '2020-01-01', 'F1', 'C1', 'D1'),
('EE2222', 'Oubouhou', 'El Mahdi', '1999-04-17', '0644332211', 'Oubouhou1@gmail.com', 'Homme', 'marrakech', 2, '315f166c5aca63a157f7d41007675cb44a948b33', 'Untitled-1.jpg', 'Super Admin', '2020-02-01', 'F2', 'C1', 'D2'),
('EE3333', 'said', 'fakhita', '1990-02-19', '06555555', 'fes@gmail.com', 'Femme', 'fes', 3, 'b444ac06613fc8d63795be9ad0beaf55011936ac', 'avatar-02.jpg', 'Employe', '2020-05-11', 'F3', 'C2', 'D3');

-- --------------------------------------------------------

--
-- Table structure for table `fonction`
--

CREATE TABLE `fonction` (
  `code` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fonction`
--

INSERT INTO `fonction` (`code`, `nom`, `description`) VALUES
('F1', 'Génie  logiciel', 'est une science de génie industriel qui étudie les méthodes de travail et les bonnes pratiques des ingénieurs qui développent des logiciels.'),
('F2', 'Développeur informatique', 'est programmeur et un informaticien qui réalise des logiciels et les met en œuvre à l\'aide de langages de programmation.'),
('F3', 'Administrateur réseau', 'est une personne chargée de la gestion du réseau, c\'est-à-dire de gérer les comptes et les machines d\'un réseau informatique');

-- --------------------------------------------------------

--
-- Table structure for table `pointage`
--

CREATE TABLE `pointage` (
  `idP` int(11) NOT NULL,
  `dateP` date NOT NULL,
  `heureP` time NOT NULL,
  `typeP` varchar(30) NOT NULL,
  `cinE` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pointage`
--

INSERT INTO `pointage` (`idP`, `dateP`, `heureP`, `typeP`, `cinE`) VALUES
(16, '2006-06-06', '06:06:00', 'Entrée', 'EE3333'),
(15, '2018-08-08', '08:08:00', 'Sortie', 'EE3333'),
(14, '2000-01-01', '12:00:00', 'Sortie', 'EE1111'),
(13, '2000-01-01', '08:00:00', 'Entrée', 'EE2222'),
(12, '2000-01-01', '08:00:00', 'Entrée', 'EE1111'),
(17, '2006-01-16', '16:16:00', 'Sortie', 'EE3333'),
(18, '2012-12-12', '12:12:00', 'Entrée', 'EE1111'),
(19, '2009-09-09', '09:09:00', 'Entrée', 'EE2222'),
(20, '2111-11-11', '11:11:00', 'Sortie', 'EE2222');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`Num`);

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`CIN`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_empCat` (`codeC`),
  ADD KEY `fk_empDept` (`num`),
  ADD KEY `fk_empFonct` (`codeF`);

--
-- Indexes for table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `pointage`
--
ALTER TABLE `pointage`
  ADD PRIMARY KEY (`idP`) USING BTREE,
  ADD KEY `FK_emp_point` (`cinE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pointage`
--
ALTER TABLE `pointage`
  MODIFY `idP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
gestionpointage