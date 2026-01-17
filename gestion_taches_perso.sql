-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 17, 2026 at 11:15 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_taches_perso`
--

-- --------------------------------------------------------

--
-- Table structure for table `taches`
--

CREATE TABLE `taches` (
  `id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `description` text,
  `statut` varchar(20) DEFAULT 'todo',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taches`
--

INSERT INTO `taches` (`id`, `titre`, `categorie`, `description`, `statut`, `date_creation`, `date_deleted`) VALUES
(1, 'Terminer la session 3', 'Cours', 'Fichiers BD et table créés. \r\nAPI ?', 'done', '2026-01-16 12:08:53', NULL),
(2, '1', 'Personnel', '', 'deleted', '2026-01-16 12:39:24', '2026-01-16 21:17:00'),
(3, 'test@pwb.be', 'Administratif', 'bbo', 'deleted', '2026-01-16 12:45:38', '2026-01-16 21:17:03'),
(4, 'pouf', 'Stage', 'hihi hoho', 'done', '2026-01-16 14:51:39', NULL),
(5, 'papote', 'Personnel', 'blablabla', 'progress', '2026-01-16 18:03:23', NULL),
(6, 'Abonnement', 'Paiement', 'kejczkecjz', 'progress', '2026-01-16 18:03:48', NULL),
(7, 'Envoyer mail', 'Administratif', 'bla bla bla', 'todo', '2026-01-16 18:04:18', NULL),
(8, 'Litière', 'Personnel', 'Make the cat happy<3', 'todo', '2026-01-16 18:52:00', NULL),
(9, 'Gratter un kdo à la personne qui verra ceci ;)', 'Cours', 'Livre : \r\nÉcoconception web. Les 115 bonnes pratiques de Frédéric Bordage (Éd. Eyrolles)', 'todo', '2026-01-16 18:54:32', NULL),
(10, 'comprendre le pq du comment', 'Personnel', 'moment deeptalk w/ myself lol', 'progress', '2026-01-16 20:24:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `taches`
--
ALTER TABLE `taches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
