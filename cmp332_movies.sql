-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2021 at 09:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

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
-- Table structure for table `tblmovies`
--

CREATE TABLE `tblmovies` (
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
-- Dumping data for table `tblmovies`
--

INSERT INTO `tblmovies` (`id`, `title`, `ageRating`, `movieRating`, `releaseDate`, `description`, `genre`, `director`, `createdAt`, `updatedAt`) VALUES
(2, 'Test', 18, 4.5, '20-12-12', 'Test', 'Test', 'Test', '2021-07-25', '2021-07-25'),
(5, 'This is a test title', 6, 5, '12-12-2020', 'This is the best test movie you can imagine', 'A Cool one', 'Mr Dad', '2021-09-11', '2021-09-11'),
(6, 'This is a test title', 6, 5, '12-12-2020', 'This is the best test movie you can imagine', 'A Cool one', 'Mr Dad', '2021-09-11', '2021-09-11'),
(8, 'This is a test title', 6, 5, '12-12-2020', 'This is the best test movie you can imagine', 'A Cool one', 'Mr Dad', '2021-09-11', '2021-09-11'),
(12, 'This is a test title', 6, 5, '12-12-2020', 'This is the best test movie you can imagine', 'A Cool one', 'Mr Dad', '2021-09-11', '2021-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `createdAt`, `updatedAt`) VALUES
('1', 'sean4755', 'seam4755@gmail.com', 'Password99!', '2021-09-11 19:50:52.418', '0000-00-00 00:00:00.000'w);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblmovies`
--
ALTER TABLE `tblmovies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `User.username_unique` (`username`),
  ADD UNIQUE KEY `User.email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblmovies`
--
ALTER TABLE `tblmovies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
