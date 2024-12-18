-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 19, 2024 alle 03:21
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydbpdo`
--
CREATE DATABASE IF NOT EXISTS `mydbpdo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mydbpdo`;

-- --------------------------------------------------------

--
-- Struttura della tabella `myguests`
--

CREATE TABLE `myguests` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `myguests`
--

INSERT INTO `myguests` (`id`, `firstname`, `lastname`, `email`, `reg_date`) VALUES
(1, 'John', 'Doe', 'john@example.com', '2024-12-19 01:45:48'),
(2, 'John', 'Verdi', 'johnverdi@example.com', '2024-12-19 01:46:21'),
(3, 'Vittorio', 'Bussano', 'vittoriobussano@example.com', '2024-12-19 01:48:30'),
(4, 'Mary', 'Doe', 'mary@example.com', '2024-12-19 02:15:39'),
(5, 'Mario', 'Rossi', '', '2024-12-19 01:51:11'),
(6, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 01:51:11'),
(7, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:00:41'),
(8, 'Mario', 'Rossi', '', '2024-12-19 02:00:41'),
(9, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 02:00:41'),
(10, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:01:18'),
(11, 'Mario', 'Rossi', '', '2024-12-19 02:01:18'),
(13, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:02:47'),
(14, 'Mario', 'Rossi', '', '2024-12-19 02:02:47'),
(15, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 02:02:47'),
(16, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:03:29'),
(17, 'Mario', 'Rossi', '', '2024-12-19 02:03:29'),
(18, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 02:03:29'),
(19, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:04:00'),
(20, 'Mario', 'Rossi', '', '2024-12-19 02:04:00'),
(21, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 02:04:00'),
(22, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:11:45'),
(23, 'Mario', 'Rossi', '', '2024-12-19 02:11:45'),
(24, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 02:11:45'),
(25, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:12:51'),
(26, 'Mario', 'Rossi', '', '2024-12-19 02:12:51'),
(27, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 02:12:51'),
(28, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:13:15'),
(29, 'Mario', 'Rossi', '', '2024-12-19 02:13:15'),
(30, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 02:13:15'),
(31, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:13:18'),
(32, 'Mario', 'Rossi', '', '2024-12-19 02:13:18'),
(33, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 02:13:18'),
(34, 'Mary', 'Moe', 'mary@example.com', '2024-12-19 02:15:39'),
(35, 'Mario', 'Rossi', '', '2024-12-19 02:15:39'),
(36, 'Luigi', 'Verdi', 'luigiverdi@example.com', '2024-12-19 02:15:39');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `myguests`
--
ALTER TABLE `myguests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `myguests`
--
ALTER TABLE `myguests`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
