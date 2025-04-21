-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 07:47 AM
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
('Lê Hải Đăng', 'dang@gmail.com', '', '2003', 'Nam'),
('sdfdsfds', 'fdfndkfk@gmail.com', '045dff077d8acb3f6c99926c796f4e7dafe572e8', '1975', 'Nam'),
('vcvcxvcx', 'fdfndxcvcxvxkfk@gmail.com', '045dff077d8acb3f6c99926c796f4e7dafe572e8', '1975', NULL),
('vcvcxvcx', 'fdfndxczxcxzvcxvxkfk@gmail.com', '8e8d18f20fe575548957c14ebeb374d8ed492ddd', '1975', NULL),
('vcvcxvcx', 'fdfndzvcxvxkfk@gmail.com', 'baf93c3394f2642163697372d36ba3d5fc3c8702', '1975', 'Nam'),
('le hai dang', 'hai@gmail.com', '8d813378c294d9c43ea7cbe34e05c65cfa43b630', '2003', 'Nam');

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
