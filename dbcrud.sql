-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 07:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcrud`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `salary`) VALUES
(5, 'Joel Smith', 'No.38,C5 Block, PWD Quarters\r\nTodd Hunter Nagar, Saidapet', 34567),
(6, 'Murali Kumar', 'chennai', 12000),
(7, 'catherine', 'hight court', 56770),
(8, 'jude immanuel', 'monfort', 100),
(9, 'ebi', 'kodambakkam', 46456);

-- --------------------------------------------------------

--
-- Table structure for table `reaction_times`
--

CREATE TABLE `reaction_times` (
  `id` int(11) NOT NULL,
  `reaction_time` float NOT NULL,
  `test_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reaction_times`
--

INSERT INTO `reaction_times` (`id`, `reaction_time`, `test_date`) VALUES
(1, 0.22, '2024-10-11 18:05:50'),
(2, 0.256, '2024-10-11 19:20:56'),
(3, 9.52, '2024-10-12 03:51:43'),
(4, 0.293, '2024-10-12 03:51:52'),
(5, 0.417, '2024-10-12 04:08:16'),
(6, 0.342, '2024-10-12 04:08:27'),
(7, 0.344, '2024-10-13 07:56:56'),
(8, 0.285, '2024-10-13 08:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Register_Number` varchar(255) NOT NULL,
  `ID_Number` varchar(20) NOT NULL,
  `Age` int(3) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Dominant_Hand` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `Name`, `Register_Number`, `ID_Number`, `Age`, `Gender`, `Department`, `Dominant_Hand`) VALUES
(5, 'joel smith', '005', '111', 21, 'male', 'CS', 'right'),
(7, 'jude', '007', '113', 14, 'male', '9th', 'right'),
(11, 'catherine', '008', '114', 49, 'female', 'economics', 'right'),
(12, 'murali kumar', '006', '112', 53, 'male', 'Commerce', 'right');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `address`, `mobile`) VALUES
(8, ' Joel Smith', ' No.38,C5 Block, PWD Quarters, Todd Hunter Nagar, Saidapet', ' 9940124782'),
(17, '  murali', '  5/26 ramapuram chennai-15', '  7397231158'),
(18, '   murali kumar', '   5/26 ramapuram chennai-15', '   739723115');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `register_number` varchar(100) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `age` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `department` varchar(100) NOT NULL,
  `dominant_hand` enum('Left','Right') NOT NULL,
  `vr1` float DEFAULT NULL,
  `vr2` float DEFAULT NULL,
  `vr3` float DEFAULT NULL,
  `ar1` float DEFAULT NULL,
  `ar2` float DEFAULT NULL,
  `ar3` float DEFAULT NULL,
  `vrm` float GENERATED ALWAYS AS ((`vr1` + `vr2` + `vr3`) / 3) STORED,
  `arm` float GENERATED ALWAYS AS ((`ar1` + `ar2` + `ar3`) / 3) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reaction_times`
--
ALTER TABLE `reaction_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reaction_times`
--
ALTER TABLE `reaction_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
