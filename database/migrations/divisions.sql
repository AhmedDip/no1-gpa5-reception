-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2026 at 04:33 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gpa5`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lfcl_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `name_bn`, `code`, `lfcl_id`, `created_at`, `updated_at`) VALUES
(1, 'Barisal', 'বরিশাল ', '10', 1, '2026-07-11 04:30:36', '2026-07-11 04:30:36'),
(2, 'Chittagong', 'চট্টগ্রাম', '20', 1, '2026-07-11 04:30:36', '2026-07-11 04:30:36'),
(3, 'Dhaka', 'ঢাকা', '30', 1, '2026-07-11 04:30:36', '2026-07-11 04:30:36'),
(4, 'Khulna', 'খুলনা', '40', 1, '2026-07-11 04:30:36', '2026-07-11 04:30:36'),
(5, 'Rajshahi', 'রাজশাহী', '50', 1, '2026-07-11 04:30:36', '2026-07-11 04:30:36'),
(6, 'Rangpur', 'রংপুর', '55', 1, '2026-07-11 04:30:36', '2026-07-11 04:30:36'),
(7, 'Sylhet', 'সিলেট', '60', 1, '2026-07-11 04:30:36', '2026-07-11 04:30:36'),
(8, 'Mymensingh', 'ময়মনসিংহ', '70', 1, '2026-07-11 04:30:36', '2026-07-11 04:30:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `divisions_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
