-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2021 at 09:14 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sonaro`
--

-- --------------------------------------------------------

--
-- Table structure for table `pokes`
--

DROP TABLE IF EXISTS `pokes`;
CREATE TABLE IF NOT EXISTS `pokes` (
  `poke_from` int(11) NOT NULL,
  `poke_to` int(11) NOT NULL,
  `date` date NOT NULL,
  KEY `poke_from` (`poke_from`,`poke_to`),
  KEY `poke_to` (`poke_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `pokes` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`, `pokes`, `created_at`) VALUES
(12, 'user1', '$2y$10$rLTVXYN6YSVYPS3uKm6eGON.zLsVT0Ym9GDPE3lMM4j8LBNfexJ5K', 'viens@lt.lt', 'viens', 'vienss', 0, '2021-12-10 20:36:16'),
(13, 'user2', '$2y$10$nMsxWRG7Owt9ACIWYNh1nu9n6A9nhGPzcCBLT0hfIkNFYvmO19LWi', 'du@lt.lt', 'du', 'duu', 0, '2021-12-10 20:36:46'),
(14, 'user3', '$2y$10$ngbsUgGzYD3yql32.nGIH.X.3HMdSRXfpfO6eYIqWORPgvMNXHrCC', 'trys@lt.lt', 'trys', 'tryss', 0, '2021-12-10 20:37:06'),
(15, 'user4', '$2y$10$iJQll10lOEiTGNo/QksZHeTc80hDqzhgGeHNh0/67je5tMExxLG3S', 'keturi@lt.lt', 'keturi', 'keturii', 0, '2021-12-10 20:37:25'),
(16, 'user5', '$2y$10$Zg06BF2JpSZciiNVwUrY5e0sKtdhkuvahAN1CUHARk5M34mXoYtfO', 'penki@lt.lt', 'penki', 'penkii', 0, '2021-12-10 20:41:51');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pokes`
--
ALTER TABLE `pokes`
  ADD CONSTRAINT `pokes_ibfk_1` FOREIGN KEY (`poke_from`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pokes_ibfk_2` FOREIGN KEY (`poke_to`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
