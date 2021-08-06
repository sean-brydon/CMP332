-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2021 at 03:28 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmp332_movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblMovies`
--

CREATE TABLE `tblMovies` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `ageRating` int(11) NOT NULL,
  `movieRating` float NOT NULL,
  `releaseDate` text NOT NULL,
  `description` text NOT NULL,
  `genre` text NOT NULL,
  `director` text NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `updatedAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblMovies`
--

INSERT INTO `tblMovies` (`id`, `title`, `ageRating`, `movieRating`, `releaseDate`, `description`, `genre`, `director`, `createdAt`, `updatedAt`) VALUES
(1, 'This is a test title', 0, 4.6, '2021-07-03', 'This is an amazing description', 'Nerd', 'Mr. Robot', '2021-07-24', '2021-07-24'),
(2, 'Test', 18, 4.5, '20-12-12', 'Test', 'Test', 'Test', '2021-07-25', '2021-07-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblMovies`
--
ALTER TABLE `tblMovies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblMovies`
--
ALTER TABLE `tblMovies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
