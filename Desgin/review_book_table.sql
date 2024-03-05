-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 05:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_banglem`
--

-- --------------------------------------------------------

--
-- Table structure for table `review_book_table`
--

CREATE TABLE `review_book_table` (
  `id_review_book` int(10) NOT NULL,
  `id_book` int(10) NOT NULL,
  `id_history` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `rating_value` int(10) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `review_book_table`
--

INSERT INTO `review_book_table` (`id_review_book`, `id_book`, `id_history`, `id_user`, `rating_value`, `comment`, `date_time`) VALUES
(3, 33, 31, 40, 1, 'asdasd', '2024-03-05 21:38:58'),
(4, 5, 31, 40, 5, '', '2024-03-05 22:08:16'),
(5, 33, 34, 40, 3, 'asdsadasd', '2024-03-05 22:27:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `review_book_table`
--
ALTER TABLE `review_book_table`
  ADD PRIMARY KEY (`id_review_book`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `review_book_table`
--
ALTER TABLE `review_book_table`
  MODIFY `id_review_book` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
