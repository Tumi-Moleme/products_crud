-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 18, 2022 at 08:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
-- Creation: Jun 07, 2022 at 04:48 PM
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(2048) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image`, `price`, `create_date`) VALUES
(1, 'iPhone 11', 'Description for IPhone 11', 'assets/images/s4BBgQG4/13.png', '32679.98', '2022-06-07 18:39:26'),
(2, 'Galaxy 6 edge', '                ', 'assets/images/I1TGTWhb/12.png', '8090.85', '2022-06-07 18:39:26'),
(6, 'IPhone 4', 'desc        ', 'assets/images/8GC2s251/14.png', '6000.99', '2022-08-16 09:06:57'),
(9, 'xiami', 'des                ', 'assets/images/dMz033jX/8.png', '2080.90', '2022-08-16 20:49:00'),
(10, 'Samsung', '        desc        ', 'assets/images/VAiolwvc/1.png', '2100.99', '2022-08-17 16:27:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
