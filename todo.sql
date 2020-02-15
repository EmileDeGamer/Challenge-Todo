-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2020 at 05:09 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `listitems`
--

CREATE TABLE `listitems` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `listItem` longblob NOT NULL,
  `listID` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listitems`
--

INSERT INTO `listitems` (`id`, `username`, `listItem`, `listID`, `status`) VALUES
(174, 'EmileDeGamer2', 0x2f2f2f2f2f7a787978797a2f2f2f2f2f6d6c6b316e2f2f2f2f2f7a787978797a2f2f2f2f2f6a6e64312f2f2f2f2f7a787978797a2f2f2f2f2f326a6e, 85, 0),
(175, 'EmileDeGamer2', 0x2f2f2f2f2f7a787978797a2f2f2f2f2f6b316b6e642f2f2f2f2f7a787978797a2f2f2f2f2f6a31326a2f2f2f2f2f7a787978797a2f2f2f2f2f6e3164, 85, 0),
(176, 'EmileDeGamer2', 0x646b31326e6b2f2f2f2f2f7a787978797a2f2f2f2f2f6d, 85, 0),
(177, 'EmileDeGamer2', 0x642f2f2f2f2f7a787978797a2f2f2f2f2f316c33326d326b2f2f2f2f2f7a787978797a2f2f2f2f2f6666332f2f2f2f2f7a787978797a2f2f2f2f2f32, 86, 0),
(178, 'EmileDeGamer2', 0x2f2f2f2f2f7a787978797a2f2f2f2f2f6631322f2f2f2f2f7a787978797a2f2f2f2f2f6e2f2f2f2f2f7a787978797a2f2f2f2f2f716b2f2f2f2f2f7a787978797a2f2f2f2f2f, 86, 0),
(179, 'EmileDeGamer2', 0x2f2f2f2f2f7a787978797a2f2f2f2f2f6c3b2f2f2f2f2f7a787978797a2f2f2f2f2f666e77716573, 86, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `listName` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `username`, `listName`) VALUES
(85, 'EmileDeGamer2', 0x6b2f2f2f2f2f7a787978797a2f2f2f2f2f6432316a642f2f2f2f2f7a787978797a2f2f2f2f2f31326e642f2f2f2f2f7a787978797a2f2f2f2f2f31),
(86, 'EmileDeGamer2', 0x32312f2f2f2f2f7a787978797a2f2f2f2f2f64776d652f2f2f2f2f7a787978797a2f2f2f2f2f32657765);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(169, 'Emile Mol', 'EmileDeGamer', 'emilemolzoho@gmail.com', '$2y$10$ouilgmpVTdGqrYPJ7MYO4.W0PWr8gbNYDucSRW0Bw88b2Wh972.Oe'),
(170, 'Emile Mol', 'EmileDeGamer2', 'emilemolzoho@gmail.com', '$2y$10$o.HZfqaXpO6qq2DHbZjvounz/oBeCKw8fZSiwQZrEAEnCpved5z1G'),
(171, 'Emile Mol', 'EmileDeGamer10', 'emilemolzoho@gmail.com', '$2y$10$MHWX4EE0wQ5wcYIKce4yWu09nNed8v0xVQClaJOsvQ1U3.Y2PE4OK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `listitems`
--
ALTER TABLE `listitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `listitems`
--
ALTER TABLE `listitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
