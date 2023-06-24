-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2023 at 06:03 PM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scandiweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `attrs` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `type`, `attrs`) VALUES
(1, 'GGEZ202822', 'Valorant Disc', 2000, 'dvd', '{\"size\": 700}'),
(2, 'GGEZ201332', 'Fortnite Disc', 3500, 'dvd', '{\"size\": 200}'),
(3, 'GGEZ206566', 'Apex Disc', 7999, 'dvd', '{\"size\": 700}'),
(4, 'GGEZ209007', 'Fortnite Disc', 9999, 'dvd', '{\"size\": 900}'),
(5, 'GJWP202899', 'The Alchemist', 10000, 'book', '{\"weight\": 2}'),
(6, 'GJWP208705', 'Atomic Habits', 13000, 'book', '{\"weight\": 1}'),
(7, 'GJWP203912', 'It Ends With Us', 8000, 'book', '{\"weight\": 2}'),
(8, 'GJWP207689', 'The Da Vinci Code', 15000, 'book', '{\"weight\": 1}'),
(9, 'IKEA200631', 'Sofa', 70000, 'furniture', '{\"width\": 400, \"height\": 50, \"length\": 100}'),
(10, 'IKEA207772', 'Chair', 20000, 'furniture', '{\"width\": 50, \"height\": 100, \"length\": 50}'),
(11, 'IKEA204540', 'Bed', 40000, 'furniture', '{\"width\": 100, \"height\": 50, \"length\": 250}'),
(12, 'IKEA206124', 'Table', 50000, 'furniture', '{\"width\": 250, \"height\": 100, \"length\": 80}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
