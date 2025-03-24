-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 06:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `year_old` varchar(50) DEFAULT NULL,
  `sex` char(50) DEFAULT NULL COMMENT '1 là nam, 0 là nữ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `pwd`, `year_old`, `sex`) VALUES
('', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '1975', NULL),
('cuc@', 'cuc@gmail.com', 'b092d34568624322087448e4bf7e32f2e91ca4de', '1990', 'Nam'),
('haidang', 'd@gmail.com', '3c363836cf4e16666669a25da280a1865c2d2874', '1980', 'male'),
('Lê Hải Đăng', 'dang@gmail.com', '', '2003', 'Nam'),
('le', 'dat@gmail.com', '', '1975', 'Nam'),
('haidang', 'dfdsf@gmail.com', '483a64fa956ad1c848328c52f15dcc0bce1ca232', '1978', 'male'),
('adasd', 'dfsf@gmail.com', 'b131915ccb231b19fc3efdca94084b538b799096', '1989', 'male'),
('sdfdsfds', 'fdfndkfk@gmail.com', '045dff077d8acb3f6c99926c796f4e7dafe572e8', '1975', 'Nam'),
('vcvcxvcx', 'fdfndxcvcxvxkfk@gmail.com', '045dff077d8acb3f6c99926c796f4e7dafe572e8', '1975', NULL),
('vcvcxvcx', 'fdfndxczxcxzvcxvxkfk@gmail.com', '8e8d18f20fe575548957c14ebeb374d8ed492ddd', '1975', NULL),
('vcvcxvcx', 'fdfndzvcxvxkfk@gmail.com', 'baf93c3394f2642163697372d36ba3d5fc3c8702', '1975', 'Nam'),
('haidang', 'hai@gmail.com', '', '1985', 'Nữ'),
('sadf', 'sdfads@gmail.com', 'e9a08769c9578b42be52de2bafcaad0fb0e91191', '1975', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
