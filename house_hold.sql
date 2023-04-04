-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2023 at 10:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `house_hold`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashflows`
--

CREATE TABLE `cashflows` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `income` double NOT NULL,
  `expense` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashflows`
--

INSERT INTO `cashflows` (`id`, `date`, `description`, `income`, `expense`, `user_id`, `created_at`, `updated_at`) VALUES
(6, '2023-04-06', 'salary', 1000000, 0, 2, '2023-04-02 11:27:08', '2023-04-02 11:27:08'),
(7, '2023-04-05', 'salary', 0, 40000, 2, '2023-04-02 11:27:50', '2023-04-02 11:27:50'),
(8, '2023-04-05', 'salary', 500000, 0, 2, '2023-04-02 11:27:53', '2023-04-02 11:27:53'),
(9, '2023-04-05', 'salary', 500000, 0, 2, '2023-04-02 11:27:53', '2023-04-02 11:27:53'),
(10, '2023-04-05', 'salary', 500000, 0, 2, '2023-04-02 11:27:54', '2023-04-02 11:27:54'),
(11, '2023-04-05', 'salary', 500000, 0, 2, '2023-04-02 11:27:54', '2023-04-02 11:27:54'),
(12, '2023-04-05', 'salary', 500000, 0, 2, '2023-04-02 11:27:54', '2023-04-02 11:27:54'),
(13, '2023-04-05', 'salary', 500000, 0, 2, '2023-04-02 11:27:55', '2023-04-02 11:27:55'),
(14, '2023-04-06', 'pocket money', 500000, 0, 2, '2023-04-02 11:28:20', '2023-04-02 11:28:20'),
(15, '2023-04-13', 'expenses for bagan trip', 0, 500000, 2, '2023-04-02 11:28:22', '2023-04-02 11:28:22'),
(16, '2023-04-01', 'salary', 1000000, 0, 2, '2023-04-02 11:28:22', '2023-04-02 11:28:22'),
(17, '2023-04-06', 'shopping', 230000, 0, 2, '2023-04-02 11:28:22', '2023-04-02 11:28:22'),
(18, '2023-04-06', 'shopping', 230000, 0, 2, '2023-04-02 11:28:23', '2023-04-02 11:28:23'),
(19, '2023-04-06', 'shopping', 230000, 0, 2, '2023-04-02 11:28:23', '2023-04-02 11:28:23'),
(21, '2023-04-05', 'shopping', 0, 2000000, 2, '2023-04-03 02:54:14', '2023-04-03 02:54:14'),
(22, '2023-04-04', 'buying refrigerator', 0, 350000, 2, '2023-04-03 03:22:34', '2023-04-03 03:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Rose', 'rose@gmail.com', '$2y$10$BGfNT1s2uksWvefhBcS.q.R4OANjRvtTtx3Mvyn9YZzirLmDISRUu', '2023-03-31 06:15:54', '2023-03-31 06:15:54'),
(2, 'Clark', 'clark@gmail.com', '$2y$10$8zmBFnUc8PeiZeN6yz57GO7GolNaAUVllyhhSOuDT./SVJ2rtUvAO', '2023-04-01 15:00:05', '2023-04-01 15:00:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashflows`
--
ALTER TABLE `cashflows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashflows`
--
ALTER TABLE `cashflows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
