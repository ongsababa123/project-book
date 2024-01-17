-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2024 at 11:08 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

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
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `id_category` int NOT NULL COMMENT 'ไอดีหมวดหนังสือ',
  `name_category` varchar(255) NOT NULL COMMENT 'ชื่อหมวดหมู่',
  `details` varchar(255) NOT NULL COMMENT 'รายละเอียดหมวดหมู่',
  `status` int NOT NULL COMMENT 'สถานะหมวดหมู่ เปิด/ปิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`id_category`, `name_category`, `details`, `status`) VALUES
(1, 'วรรณกรรม', 'นิยาย, นวนิยาย, และกำนันเป็นต้น เน้นการเล่าเรื่องและพัฒนาตัวละคร.', 1),
(2, 'วิทยาศาสตร์', 'หนังสือที่เกี่ยวกับวิทยาศาสตร์ แบ่งออกเป็นหลายหมวด เช่น ฟิสิกส์, เคมี, ชีววิทยา.', 1),
(3, 'นวนิยายสืบสวน', 'เรื่องสืบสวนและอาชญากรรม.', 1),
(4, 'ประวัติศาสตร์', 'เล่าเรื่องราวที่เกี่ยวข้องกับเหตุการณ์ประวัติศาสตร์ที่สำคัญ.', 1),
(5, 'การศึกษา', 'หนังสือเกี่ยวกับกระบวนการการเรียนรู้ และการพัฒนาทักษะ.', 1),
(6, 'บริหารธุรกิจ', 'เกี่ยวกับการจัดการธุรกิจ และทฤษฎีทางธุรกิจ.', 1),
(7, 'สุขภาพและการดูแล', 'เกี่ยวกับการดูแลสุขภาพทั้งกายและใจ.', 1),
(8, 'ศาสนา', 'หนังสือที่เกี่ยวกับศาสนาและการศึกษาทางศาสนา.', 1),
(9, 'ศิลปะและบันเทิง', 'เล่น, ภาพวาด, ดนตรี, และวรรณกรรมศิลป์.', 1),
(10, 'เทคโนโลยีและคอมพิวเตอร์', ' หนังสือเกี่ยวกับเทคโนโลยี, โปรแกรม, และคอมพิวเตอร์.', 1),
(11, 'การเดินทางและผจญภัย', 'การเรื่องราวเกี่ยวกับการ', 1),
(12, ' จิตวิทยา การพัฒนาตัวเอง', '', 1),
(13, 'นิยายแปล', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`id_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT COMMENT 'ไอดีหมวดหนังสือ', AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
