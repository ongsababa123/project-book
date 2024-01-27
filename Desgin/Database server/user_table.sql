-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 26, 2024 at 10:43 PM
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
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id_user` int NOT NULL,
  `email_user` varchar(255) NOT NULL COMMENT 'อีเมล user',
  `name` varchar(255) NOT NULL COMMENT 'ชื่อ user',
  `lastname` varchar(255) NOT NULL COMMENT 'สกุล user',
  `phone` varchar(10) NOT NULL COMMENT 'เบอร์โทร',
  `password` longtext NOT NULL COMMENT 'รหัสผ่าน (hash)',
  `key_pass` longtext NOT NULL COMMENT 'รหัสกุญแจกรณีลืมรหัส',
  `status_user` int NOT NULL COMMENT 'สถานะการเช่า',
  `status_rental` int NOT NULL,
  `type_user` int NOT NULL COMMENT 'ประเภทสมาชิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id_user`, `email_user`, `name`, `lastname`, `phone`, `password`, `key_pass`, `status_user`, `status_rental`, `type_user`) VALUES
(20, 'bookbanglem1@gmail.com', 'สิรินยา', 'หมุดทอง', '1234567890', '$2y$10$wP6qEJ4JoKP9V.vRsCnfze3tRtaj2tJ5R2ViHS2Fl2Py2COs.oJcq', '123456', 1, 1, 1),
(21, 'bookbanglem2@gmail.com', 'book', 'book', '1234567890', '$2y$10$MBbHgPpzF.PqNkiFymjWcuoUOfSH2yL93Fz5nIHU60reRx.ewnR1.', '123456', 1, 1, 2),
(22, 'bookbanglem3@gmail.com', 'book3', 'book3', '1234567890', '$2y$10$79GYPL9IGLvjxcMjGU2CR.3mSNxtNC6tBM9Xy5PLwCddD2o8dQJDu', '123456', 1, 1, 3),
(23, 'bookbanglem4@gmail.com', 'สมมุติ1', 'แสนดี', '1234567890', '$2y$10$KENX.HT97dKxfVr3vvv66OLCl0TYr9Zsvf4dTDAq08iiS.1/gZtV.', '123456', 1, 3, 4),
(24, 'bookbanglemtest@gmail.com', 'booktest', 'booktest', '1234567890', '$2y$10$HqDl9LYcwpPxZY2j.BuYAeUcZqPfuBTnaZ7KPxdIoViHdnOVKsm7S', '123456', 1, 1, 3),
(25, '2204.si@gmail.com', 'สายทอง', 'ซน', '1234567890', '$2y$10$pYw8rFvKUozIbKCQAEuw6OmhTGpEUFsfCUdbIqXxYenZMURpv.gn2', '123456', 1, 1, 4),
(26, '2204.sirinya@gmail.com', 'สิรินยยา', 'หมุดทอง', '0991159509', '$2y$10$hdnIH9k7xyITdF.T9705P.nr4lnVfHELj7WOHGfsWBOi5s5VeCMt.', '123456', 1, 1, 4),
(27, 'book@gmail.com', 'สาย', 'แล้วนะ', '1235546879', '$2y$10$64H9iqcGa9Vs.AHumVyIO.Bg8uaBTRQ4f33yUMWSL2nKKBVjRxzOa', '123456', 1, 1, 4),
(28, 'chanidawilaikarn@gmail.com', 'ชนิดา', 'วิลัยการ', '0955069384', '$2y$10$K6lQogzR0fzA56fuJh0d0upF7aS8Sy0OTvXWRephKeLOQNNI877Xu', '123456', 1, 2, 4),
(29, '646051800175@mail.rmutk.ac.th', 'Chanida', 'Wilaikarn', '0955069384', '$2y$10$Y84SOhMMgR7XHQRMCExKaOE8yKY0A7cbmNMfPaQtQ1/HtjqMEbVTG', '123456', 1, 1, 4),
(30, 'knatsuda264@gmail.com', 'Natsuda', 'Kamyu', '0954735401', '$2y$10$ti6tPa6u.vLpbaVeHmCVReqk27xskm7SRmyclaDuM99i5dHI6Pmv6', '123456', 1, 1, 4),
(31, 'ab@mail.com', 'aaa', 'bbb', '0987654321', '$2y$10$cRA.Vua04FV2nafGRuUFwOBh/43sIX/hCMwwxQ74T2LBWYRsTv/.2', '123456', 1, 1, 4),
(32, 'admin@gmail.com', 'admin', 'admin', '0987654321', '$2y$10$d9GSFQuf1M.YvfGJiQsoPO2ZPgRh8PoZEmv9klPYV3NcspqM5op5S', '123456', 1, 1, 4),
(33, '22.sirinya@gmail.com', 'สม', 'แสน', '0991159509', '$2y$10$S59dfci3QbtrVHeEUcuAu.k6B173wbr1wIoG9tstgE5H5uwxR11KC', '123456', 1, 3, 4),
(34, 'test@hotmail.com', '@!#$%^', '!@#$$%', 'ffffffffff', '$2y$10$Nvs1XneNjbb4iVj33rzrFOB3127cMoMBacddJPXx5X5NRuyw4Faz2', '123456', 1, 1, 4),
(35, 'bookbanglem@gmail.com', 'bo', 'ระบบ', '1234567890', '$2y$10$OXl.MmskQ3S7JqjxVys4M.9TBv/x/VBPr5smJs3H1.Csdr642538G', '123456', 1, 1, 4),
(36, 'book2@gmail.com', 'ผู้จัดการ', 'ซน', '1235546879', '$2y$10$46eguAdYssFfTff3qqJOoO0dj6P.mRU9gK0XAAgVwMqG9mW5Ig9QO', '123456', 1, 1, 4),
(37, 'test@gmail.com', 'Ratthaburee', 'Taennil', '1234sadasd', '$2y$10$tehykmxsrNZ2j611zwJ9QuJv5/sFjJ.MO.9qCiOb6qE/VZPy4/Uvm', '123456', 1, 1, 4),
(38, '646051800134@mail.rmutk.ac.th', 'สิรินยา', 'หมุด', '0991159509', '$2y$10$QKCkXjxx7jyIx2tKt38npujiAfdEbC1RFmIJpBkAKzBqIZpbOqTkq', '885071', 1, 1, 4),
(39, '6406021421171@fitm.kmutnb.ac.th', 'root', 'ๆไำๆไำ', '0123123123', '$2y$10$nF6pSN9hlLtShex04VEjvehc1KAO37547n1905oxsm7EY/cATXjj6', '123456', 1, 1, 4),
(40, 'jailyootbandit@gmail.com', 'jriayut', 'bandit', '0972654762', '$2y$10$cZkHtL82I6mUCvoFQWRoLuY7R7BJrmCkJdkhqiQ7wgTyYDG.4QQma', '883417', 1, 1, 4),
(41, 'bookbanglem17@gmail.com', 'ทดสอบ', 'ทดสอบ', '0879546328', '$2y$10$gnJioJ5p9ZpRQuCUqRBGpu1fGzt8gZlaEGje4K8VJncYhlmbksQhK', '179941', 1, 1, 4),
(42, 'test@gmai.com', 'test', 'test', '1235546879', '$2y$10$vlqCkHJzIra7URUQ5veiSuzkkTJb4ZGa1kjsQfNgxXGN3s1m2PTsG', '400788', 1, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
