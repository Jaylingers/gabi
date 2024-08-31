-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 02:45 PM
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
-- Database: `gabi`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `body`, `created_at`) VALUES
(2, 'wew', 'wew', '2024-08-25 08:30:11'),
(3, 'general meeting', 'dasdas', '2024-08-28 03:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `assistance`
--

CREATE TABLE `assistance` (
  `id` int(11) NOT NULL,
  `assistance_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assistance`
--

INSERT INTO `assistance` (`id`, `assistance_name`, `date`, `location`, `created_at`) VALUES
(1, 'tupad', '2024-09-09', 'gabi', '2024-08-24 17:14:00'),
(2, 'tupad', '2024-09-09', 'gabi', '2024-08-24 17:14:35'),
(3, 'AKAP', '2024-08-30', 'gabi', '2024-08-28 03:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `assistance_residents`
--

CREATE TABLE `assistance_residents` (
  `id` int(11) NOT NULL,
  `assistance_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assistance_residents`
--

INSERT INTO `assistance_residents` (`id`, `assistance_id`, `resident_id`, `added_at`, `status`) VALUES
(4, 3, 5, '2024-08-28 03:43:43', 'Pending'),
(5, 3, 2, '2024-08-28 03:43:47', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `gym_schedule`
--

CREATE TABLE `gym_schedule` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `who` varchar(100) NOT NULL,
  `hours` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_schedule`
--

INSERT INTO `gym_schedule` (`id`, `date`, `time`, `who`, `hours`, `created_at`) VALUES
(2, '2024-08-26', '18:00:00', 'me', 2, '2024-08-25 08:29:53'),
(3, '2024-08-27', '07:00:00', 'you', 2, '2024-08-25 08:30:08'),
(4, '2024-09-01', '18:00:00', 'sk', 4, '2024-08-25 08:35:47'),
(5, '2024-09-01', '18:00:00', 'sk', 4, '2024-08-25 08:40:20'),
(6, '2024-08-30', '20:00:00', 'bosnic', 4, '2024-08-28 03:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `indigency`
--

CREATE TABLE `indigency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `year_living` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `date_issued` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `extension_name` varchar(10) DEFAULT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `marital_status` enum('Single','Married','Lived in Partner','Widower/Widow','Single Parent') NOT NULL,
  `partner_name` varchar(50) DEFAULT NULL,
  `children_count` int(11) DEFAULT NULL,
  `purok` varchar(50) NOT NULL,
  `source_of_income` enum('None','Private','Government','Driver','Business') NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `government_work` varchar(100) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `business_type` varchar(100) DEFAULT NULL,
  `house_ownership` enum('Own','Rent') NOT NULL,
  `light_source` enum('MECO','Solar','Gas Lamp') NOT NULL,
  `water_source` enum('Deep well','Puso','MCWD') NOT NULL,
  `pets` varchar(100) DEFAULT NULL,
  `beneficiaries` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `last_name`, `first_name`, `middle_name`, `extension_name`, `birthday`, `age`, `marital_status`, `partner_name`, `children_count`, `purok`, `source_of_income`, `company_name`, `government_work`, `vehicle_type`, `business_type`, `house_ownership`, `light_source`, `water_source`, `pets`, `beneficiaries`) VALUES
(1, 'Doe', 'John', 'A', 'Jr.', '1990-01-15', 34, 'Single', NULL, NULL, '1', 'Private', NULL, NULL, NULL, NULL, 'Own', 'Solar', 'Deep well', 'Dog', 'None'),
(2, 'Smith', 'Jane', 'B', 'N/A', '1985-03-22', 39, 'Married', NULL, NULL, '2', 'Government', NULL, NULL, NULL, NULL, 'Rent', 'MECO', 'MCWD', 'Cat', '4PS'),
(3, 'Johnson', 'Emily', 'C', 'N/A', '1995-05-12', 29, 'Single', NULL, NULL, '3', 'Private', NULL, NULL, NULL, NULL, 'Own', 'Gas Lamp', 'Puso', 'Fish', 'PWD'),
(4, 'Williams', 'Michael', 'D', 'N/A', '1980-07-30', 44, 'Lived in Partner', NULL, NULL, '4', 'Business', NULL, NULL, NULL, NULL, 'Own', 'Solar', 'Deep well', 'Bird', 'None'),
(5, 'Jones', 'Sophia', 'E', 'N/A', '1992-11-19', 31, 'Single Parent', NULL, NULL, '5', 'Private', NULL, NULL, NULL, NULL, 'Rent', 'MECO', 'MCWD', 'None', 'Single Parents'),
(6, 'Brown', 'Olivia', 'F', 'N/A', '1988-09-14', 35, '', NULL, NULL, '1', 'Government', NULL, NULL, NULL, NULL, 'Own', 'Gas Lamp', 'Deep well', 'Dog', 'Senior Citizen'),
(7, 'Davis', 'James', 'G', 'N/A', '1975-12-25', 48, 'Married', NULL, NULL, '2', 'Private', NULL, NULL, NULL, NULL, 'Rent', 'Solar', 'Puso', 'Cat', 'None'),
(8, 'Miller', 'Isabella', 'H', 'N/A', '1993-02-07', 31, 'Single', NULL, NULL, '3', 'Business', NULL, NULL, NULL, NULL, 'Own', 'MECO', 'MCWD', 'Dog', '4PS'),
(9, 'Wilson', 'Ethan', 'I', 'N/A', '1991-06-05', 33, 'Single', NULL, NULL, '4', 'Private', NULL, NULL, NULL, NULL, 'Rent', 'Gas Lamp', 'Deep well', 'None', 'PWD'),
(10, 'Moore', 'Liam', 'J', 'N/A', '1982-04-10', 42, 'Married', NULL, NULL, '5', 'Government', NULL, NULL, NULL, NULL, 'Own', 'Solar', 'MCWD', 'Cat', 'Single Parents'),
(11, 'Taylor', 'Ava', 'K', 'N/A', '1987-08-22', 36, 'Single Parent', NULL, NULL, '1', 'Private', NULL, NULL, NULL, NULL, 'Rent', 'Gas Lamp', 'Deep well', 'None', 'Senior Citizen'),
(12, 'Anderson', 'Sophia', 'L', 'N/A', '1994-09-15', 30, 'Married', NULL, NULL, '2', 'Private', NULL, NULL, NULL, NULL, 'Own', 'MECO', 'Puso', 'Dog', '4PS'),
(13, 'Thomas', 'Charlotte', 'M', 'N/A', '1998-03-30', 26, 'Single', NULL, NULL, '3', 'Government', NULL, NULL, NULL, NULL, 'Rent', 'Solar', 'MCWD', 'None', 'PWD'),
(14, 'Jackson', 'William', 'N', 'N/A', '1983-07-04', 41, '', NULL, NULL, '4', 'Private', NULL, NULL, NULL, NULL, 'Own', 'Gas Lamp', 'Deep well', 'Cat', 'Senior Citizen'),
(15, 'White', 'Lucas', 'O', 'N/A', '1990-01-18', 34, 'Single', NULL, NULL, '5', 'Business', NULL, NULL, NULL, NULL, 'Rent', 'MECO', 'Puso', 'Fish', 'None'),
(16, 'Harris', 'Mia', 'P', 'N/A', '1986-10-28', 37, 'Single Parent', NULL, NULL, '1', 'Government', NULL, NULL, NULL, NULL, 'Own', 'Solar', 'MCWD', 'Dog', '4PS'),
(17, 'Martin', 'Henry', 'Q', 'N/A', '1995-05-22', 29, 'Married', NULL, NULL, '2', 'Private', NULL, NULL, NULL, NULL, 'Rent', 'Gas Lamp', 'Deep well', 'None', 'PWD'),
(18, 'Thompson', 'Ella', 'R', 'N/A', '1991-11-05', 32, 'Single', NULL, NULL, '3', 'Government', NULL, NULL, NULL, NULL, 'Own', 'Solar', 'Puso', 'Bird', 'Single Parents'),
(19, 'Garcia', 'Aiden', 'S', 'N/A', '1984-02-12', 40, 'Single', NULL, NULL, '4', 'Private', NULL, NULL, NULL, NULL, 'Rent', 'MECO', 'MCWD', 'None', 'Senior Citizen'),
(20, 'Martinez', 'Chloe', 'T', 'N/A', '1999-02-11', 25, 'Single', NULL, NULL, '5', 'Government', NULL, NULL, NULL, NULL, 'Own', 'Gas Lamp', 'Deep well', 'Fish', '4PS');

-- --------------------------------------------------------

--
-- Table structure for table `seminars`
--

CREATE TABLE `seminars` (
  `id` int(11) NOT NULL,
  `seminar_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seminars`
--

INSERT INTO `seminars` (`id`, `seminar_name`, `date`, `time`, `location`) VALUES
(1, 'BADAC', '2024-09-09', '09:00:00', 'gabi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'captain', '$2y$10$EZLY6Am4.tCFUBJNFfRow.o/AHLBWxXdyMTsAN83/uwHWHm.qGU.S', 'captain'),
(2, 'secretary', '$2y$10$vCal9sDeglHStm5f3w407.qfmk7cn0pDaOf.mNmxBIiIL3h57lmvS', 'secretary'),
(3, 'treasurer', '$2y$10$8RYBJtmRhkm2GL2bnKZkKu1PyGe7XKdr7oStv2Hd.RZXoU2zxrcv.', 'treasurer'),
(4, 'pio', '$2y$10$JC94fnQdIBK4YModHL3zZuW0I0YImgANhsQtJFSm6P1h3WQktwTCW', 'pio'),
(5, 'councilor', '$2y$10$wLr.AFWXomqhENmJKT5Z..C9IZ5hdnQ0/JGS3JC30SDIDYhgT1IOm', 'councilor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assistance`
--
ALTER TABLE `assistance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assistance_residents`
--
ALTER TABLE `assistance_residents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assistance_id` (`assistance_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `gym_schedule`
--
ALTER TABLE `gym_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indigency`
--
ALTER TABLE `indigency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assistance`
--
ALTER TABLE `assistance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assistance_residents`
--
ALTER TABLE `assistance_residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gym_schedule`
--
ALTER TABLE `gym_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `indigency`
--
ALTER TABLE `indigency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `seminars`
--
ALTER TABLE `seminars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assistance_residents`
--
ALTER TABLE `assistance_residents`
  ADD CONSTRAINT `assistance_residents_ibfk_1` FOREIGN KEY (`assistance_id`) REFERENCES `assistance` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistance_residents_ibfk_2` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
