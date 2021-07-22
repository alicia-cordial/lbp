-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2021 at 11:51 AM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lbp`
--

-- --------------------------------------------------------

--
-- Table structure for table `signalement`
--

CREATE TABLE `signalement` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_acheteur` int(11) NOT NULL,
  `signal` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signalement`
--

INSERT INTO `signalement` (`id`, `id_article`, `id_acheteur`, `signal`) VALUES
(1, 2, 3, 1),
(10, 3, 2, 1),
(11, 3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signalement`
--
ALTER TABLE `signalement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vendeur` (`id_article`,`id_acheteur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signalement`
--
ALTER TABLE `signalement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
