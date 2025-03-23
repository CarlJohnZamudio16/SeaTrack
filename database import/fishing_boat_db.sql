-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2025 at 10:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fishing_boat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `boats`
--

CREATE TABLE `boats` (
  `id` int(11) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `boat_name` varchar(100) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `registration_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `boat_type` varchar(50) NOT NULL,
  `length` float NOT NULL,
  `hull_material` varchar(50) NOT NULL,
  `year_built` int(11) NOT NULL,
  `home_port` varchar(100) NOT NULL,
  `crew_capacity` int(11) NOT NULL,
  `engine_type` varchar(50) NOT NULL,
  `engine_model` varchar(100) NOT NULL,
  `power` int(11) NOT NULL,
  `fuel_type` varchar(50) NOT NULL,
  `fuel_capacity` int(11) NOT NULL,
  `boat_equipment` text NOT NULL,
  `permit_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boats`
--

INSERT INTO `boats` (`id`, `registration_number`, `boat_name`, `owner_name`, `contact_email`, `registration_date`, `status`, `boat_type`, `length`, `hull_material`, `year_built`, `home_port`, `crew_capacity`, `engine_type`, `engine_model`, `power`, `fuel_type`, `fuel_capacity`, `boat_equipment`, `permit_details`) VALUES
(6, 'FV-20255252', 'kaiser', 'CJZ', 'carljohnzamudio562@gmail.com', '2025-03-23', 'Active', 'pump boat', 20, 'wood', 2010, 'Pontevedra', 4, 'Inboard', 'y4000', 60, 'diesel', 50, 'fishing net, fishing rod', 'area 4'),
(9, 'FV-20253714', 'weakieee', 'EA', '', '2025-03-23', 'Active', 'fishing boat', 20, 'wood', 2011, 'Pontevedra', 3, 'Inboard', 'f8000', 40, 'diesel', 50, 'fishing net, fishing rod', 'area 3 fishing permit'),
(10, 'FV-20258972', 'wew', 'carl john', 'carljohnzamudio562@gmail.com', '2025-03-23', 'Active', 'fishing boat', 15, 'wood', 2008, 'recreo', 3, 'Inboard', 'E1000', 40, 'diesel', 50, 'fishing nets, fishing rods', 'area 7 fishing perrmit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(2, 'Carl John Zamudio', 'carljohnzamudio562@gmail.com', '$2y$10$11k4HfGxDfSZhZw.W4k7h.LkcmUNSXzef7ovK4nt.LHDoFRAoLO7q', '2025-03-23 08:55:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boats`
--
ALTER TABLE `boats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boats`
--
ALTER TABLE `boats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
