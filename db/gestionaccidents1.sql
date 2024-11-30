-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 07:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestionaccidents1`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id_agent` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` enum('administrateur','expert','agent') NOT NULL,
  `statut` enum('actif','inactif') DEFAULT 'actif',
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id_agent`, `nom`, `prenom`, `email`, `role`, `statut`, `date_creation`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', 'agent', 'actif', '2024-11-26 17:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `archivage`
--

CREATE TABLE `archivage` (
  `id_archive` int(11) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `date_cloture` date NOT NULL,
  `nom_agent` varchar(100) DEFAULT NULL,
  `documents_archives` text DEFAULT NULL,
  `date_archive` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archivage`
--

INSERT INTO `archivage` (`id_archive`, `reference`, `date_cloture`, `nom_agent`, `documents_archives`, `date_archive`) VALUES
(1, 'ACC-001', '2024-11-26', 'Jean Dupont', 'http://example.com/photo1.jpg', '2024-11-26 17:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `clintes`
--

CREATE TABLE `clintes` (
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `CIN` varchar(25) NOT NULL,
  `IMG_CIN` varchar(50) NOT NULL,
  `CG` varchar(25) NOT NULL,
  `IMG_GC` varchar(50) NOT NULL,
  `IMG_CIN_VERSO` varchar(50) NOT NULL,
  `IMG_GC_VERSO` varchar(50) NOT NULL,
  `agent_assurance` varchar(25) NOT NULL,
  `date_permis` date NOT NULL,
  `date_assurance_payment` date NOT NULL,
  `IMG_PIRMI` varchar(50) NOT NULL,
  `IMG_PIRMI_VERSO` varchar(50) NOT NULL,
  `reference_dos` varchar(50) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clintes`
--

INSERT INTO `clintes` (`first_name`, `last_name`, `phone`, `email`, `CIN`, `IMG_CIN`, `CG`, `IMG_GC`, `IMG_CIN_VERSO`, `IMG_GC_VERSO`, `agent_assurance`, `date_permis`, `date_assurance_payment`, `IMG_PIRMI`, `IMG_PIRMI_VERSO`, `reference_dos`, `id_client`) VALUES
('Driss', 'Khalfaoui', '015510206620', 'firaas.alzubair@gmail.com', 'CD328739', '../Stock/documents/F301124DK0/CIN_R_301124DK0.jpg', 'DD232313', '../Stock/documents/F301124DK0/CG_R_301124DK0.jpg', '../Stock/documents/F301124DK0/CIN_V_301124DK0.jpg', '../Stock/documents/F301124DK0/CG_V_301124DK0.jpg', 'agent2', '2024-11-12', '2024-11-13', '../Stock/documents/F301124DK0/PERMIS_R_301124DK0.j', '../Stock/documents/F301124DK0/PERMIS_V_301124DK0.j', '301124DK0', 26),
('Firaas', 'Deyab', '015510206620', 'firaas.alzubair@gmail.com', 'CD328739', '../Stock/documents/F301124FD1/CIN_R_301124FD1.jpg', 'DD232313', '../Stock/documents/F301124FD1/CG_R_301124FD1.jpg', '../Stock/documents/F301124FD1/CIN_V_301124FD1.jpg', '../Stock/documents/F301124FD1/CG_V_301124FD1.jpg', 'agent2', '2024-11-12', '2024-11-13', '../Stock/documents/F301124FD1/PERMIS_R_301124FD1.j', '../Stock/documents/F301124FD1/PERMIS_V_301124FD1.j', '301124FD1', 27),
('omar', 'janati‬‎', '015510206620', 'drisspaca4@gmail.com', 'CD328739', '../Stock/documents/F301124OJ2/CIN_R_301124OJ2.jpg', 'DD232313', '../Stock/documents/F301124OJ2/CG_R_301124OJ2.jpg', '../Stock/documents/F301124OJ2/CIN_V_301124OJ2.jpg', '../Stock/documents/F301124OJ2/CG_V_301124OJ2.jpg', 'agent1', '2024-11-14', '2024-11-20', '../Stock/documents/F301124OJ2/PERMIS_R_301124OJ2.j', '../Stock/documents/F301124OJ2/PERMIS_V_301124OJ2.j', '301124OJ2', 28);

-- --------------------------------------------------------

--
-- Table structure for table `devis`
--

CREATE TABLE `devis` (
  `id_devis` int(11) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `date_devis` date NOT NULL,
  `statut` enum('accepté','refusé','en attente') DEFAULT 'en attente',
  `niveau_accord` enum('Accord 1','Accord 2','Accord 3','Non accepté') DEFAULT 'Non accepté',
  `remarque` text DEFAULT NULL,
  `id_dossier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id_document` int(11) NOT NULL,
  `type_document` enum('photo','devis','facture','rapport','autre') NOT NULL,
  `url_document` text NOT NULL,
  `date_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_dossier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dossiers`
--

CREATE TABLE `dossiers` (
  `id_dossier` int(11) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `statut` varchar(25) NOT NULL DEFAULT 'en cours',
  `progress` int(25) NOT NULL DEFAULT 20,
  `consulté` varchar(255) DEFAULT 'Null',
  `date_derniere_consultation` timestamp NULL DEFAULT NULL,
  `id_agent` int(11) NOT NULL,
  `charts` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dossiers`
--

INSERT INTO `dossiers` (`id_dossier`, `reference`, `date_creation`, `statut`, `progress`, `consulté`, `date_derniere_consultation`, `id_agent`, `charts`) VALUES
(25, '301124DK0', '2024-11-30', 'en cours', 20, 'good', NULL, 1, '11/24'),
(26, '301124FD1', '2024-11-30', 'en cours', 20, 'good', NULL, 1, '11/24'),
(27, '301124OJ2', '2024-11-30', 'en cours', 20, 'nice', NULL, 1, '11/24');

-- --------------------------------------------------------

--
-- Table structure for table `horaires`
--

CREATE TABLE `horaires` (
  `id_horaire` int(11) NOT NULL,
  `id_dossier` int(11) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `reglé` tinyint(1) DEFAULT 0,
  `date_paiement` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rapports_expertise`
--

CREATE TABLE `rapports_expertise` (
  `id_rapport` int(11) NOT NULL,
  `id_dossier` int(11) NOT NULL,
  `validé` tinyint(1) DEFAULT 0,
  `signature_expert` varchar(255) DEFAULT NULL,
  `signature_assistant` varchar(255) DEFAULT NULL,
  `remarques` text DEFAULT NULL,
  `date_validation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reformes`
--

CREATE TABLE `reformes` (
  `id_reforme` int(11) NOT NULL,
  `id_dossier` int(11) NOT NULL,
  `valeur_venale` decimal(10,2) NOT NULL,
  `valeur_epave` decimal(10,2) NOT NULL,
  `decision_client` enum('Garde épave','Cède épave') DEFAULT 'Cède épave',
  `remarque` text DEFAULT NULL,
  `date_reforme` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reparations`
--

CREATE TABLE `reparations` (
  `id_reparation` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `nom_garagiste` varchar(150) NOT NULL,
  `facture` decimal(10,2) DEFAULT NULL,
  `etat` enum('Réparé','Non réparé','Renoncé') DEFAULT 'Non réparé',
  `remarques` text DEFAULT NULL,
  `id_dossier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicules`
--

CREATE TABLE `vehicules` (
  `id_vehicule` int(11) NOT NULL,
  `marque` varchar(100) NOT NULL,
  `modele` varchar(100) NOT NULL,
  `immatriculation` varchar(20) NOT NULL,
  `ref_dossier` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicules`
--

INSERT INTO `vehicules` (`id_vehicule`, `marque`, `modele`, `immatriculation`, `ref_dossier`) VALUES
(12, 'dacia', '2012', '0000-b-01', '301124DK0'),
(13, 'dacia', '2012', '0000-b-01', '301124FD1'),
(14, 'dacia', '2012', '0000-b-01', '301124OJ2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id_agent`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `archivage`
--
ALTER TABLE `archivage`
  ADD PRIMARY KEY (`id_archive`);

--
-- Indexes for table `clintes`
--
ALTER TABLE `clintes`
  ADD PRIMARY KEY (`id_client`,`last_name`);

--
-- Indexes for table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`id_devis`),
  ADD KEY `id_dossier` (`id_dossier`),
  ADD KEY `idx_devis_statut` (`statut`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id_document`),
  ADD KEY `id_dossier` (`id_dossier`),
  ADD KEY `idx_type_document` (`type_document`);

--
-- Indexes for table `dossiers`
--
ALTER TABLE `dossiers`
  ADD PRIMARY KEY (`id_dossier`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `id_agent` (`id_agent`),
  ADD KEY `idx_reference_dossier` (`reference`);

--
-- Indexes for table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id_horaire`),
  ADD KEY `id_dossier` (`id_dossier`);

--
-- Indexes for table `rapports_expertise`
--
ALTER TABLE `rapports_expertise`
  ADD PRIMARY KEY (`id_rapport`),
  ADD KEY `id_dossier` (`id_dossier`);

--
-- Indexes for table `reformes`
--
ALTER TABLE `reformes`
  ADD PRIMARY KEY (`id_reforme`),
  ADD KEY `id_dossier` (`id_dossier`),
  ADD KEY `idx_reforme_decision` (`decision_client`);

--
-- Indexes for table `reparations`
--
ALTER TABLE `reparations`
  ADD PRIMARY KEY (`id_reparation`),
  ADD KEY `id_dossier` (`id_dossier`),
  ADD KEY `idx_reparation_etat` (`etat`);

--
-- Indexes for table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id_vehicule`),
  ADD KEY `ref_dossier` (`ref_dossier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `archivage`
--
ALTER TABLE `archivage`
  MODIFY `id_archive` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clintes`
--
ALTER TABLE `clintes`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `devis`
--
ALTER TABLE `devis`
  MODIFY `id_devis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id_document` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dossiers`
--
ALTER TABLE `dossiers`
  MODIFY `id_dossier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id_horaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rapports_expertise`
--
ALTER TABLE `rapports_expertise`
  MODIFY `id_rapport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reformes`
--
ALTER TABLE `reformes`
  MODIFY `id_reforme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reparations`
--
ALTER TABLE `reparations`
  MODIFY `id_reparation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `id_vehicule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `devis_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossiers` (`id_dossier`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossiers` (`id_dossier`) ON DELETE CASCADE;

--
-- Constraints for table `dossiers`
--
ALTER TABLE `dossiers`
  ADD CONSTRAINT `dossiers_ibfk_1` FOREIGN KEY (`id_agent`) REFERENCES `agents` (`id_agent`) ON DELETE CASCADE;

--
-- Constraints for table `horaires`
--
ALTER TABLE `horaires`
  ADD CONSTRAINT `horaires_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossiers` (`id_dossier`) ON DELETE CASCADE;

--
-- Constraints for table `rapports_expertise`
--
ALTER TABLE `rapports_expertise`
  ADD CONSTRAINT `rapports_expertise_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossiers` (`id_dossier`) ON DELETE CASCADE;

--
-- Constraints for table `reformes`
--
ALTER TABLE `reformes`
  ADD CONSTRAINT `reformes_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossiers` (`id_dossier`) ON DELETE CASCADE;

--
-- Constraints for table `reparations`
--
ALTER TABLE `reparations`
  ADD CONSTRAINT `reparations_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossiers` (`id_dossier`) ON DELETE CASCADE;

--
-- Constraints for table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `vehicules_ibfk_1` FOREIGN KEY (`ref_dossier`) REFERENCES `dossiers` (`reference`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;