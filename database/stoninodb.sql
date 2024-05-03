-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 12:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stoninodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `fullname`, `username`, `password`, `timestamp`, `usertype`) VALUES
(7, 'Hannah Uvas', 'Hannah1', 'dc647eb65e6711e155375218212b3964', '2023-09-12 07:05:41', 'Admin'),
(8, 'James Ortega', 'James1', 'dc647eb65e6711e155375218212b3964', '2023-08-27 16:11:04', 'Admin'),
(10, 'Mary Rose Banawa', 'Rose1', '$2y$10$HyVZ7uPbV8Z0S/cAXitnVuK2n4I5BE/lRDaSHUPzwaUU0c5BmzoGm', '2024-03-26 15:38:47', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `baptism`
--

CREATE TABLE `baptism` (
  `id` int(11) NOT NULL,
  `record_no` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `present_address` varchar(222) DEFAULT NULL,
  `spouse` varchar(222) NOT NULL,
  `minister_name` varchar(255) DEFAULT NULL,
  `church_name` varchar(255) DEFAULT NULL,
  `page` varchar(222) NOT NULL,
  `cath` varchar(15) NOT NULL,
  `book` varchar(22) NOT NULL,
  `rev` varchar(222) NOT NULL,
  `spo` varchar(222) NOT NULL,
  `line` varchar(222) NOT NULL,
  `date_of_baptism` date DEFAULT NULL,
  `place_of_baptism` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baptism`
--

INSERT INTO `baptism` (`id`, `record_no`, `name`, `date_of_birth`, `gender`, `place_of_birth`, `father_name`, `mother_name`, `present_address`, `spouse`, `minister_name`, `church_name`, `page`, `cath`, `book`, `rev`, `spo`, `line`, `date_of_baptism`, `place_of_baptism`) VALUES
(2, '3', 'mary', '0012-03-12', 'Female', 'bulalacao', 'dad', 'mom', 'roxas', '', 'Fr. Edwin Semilla', 'Sto. Nino', '', '', '', '0', '0', '0', '0123-03-12', 'Bulalacao'),
(3, '4', 'Charles Darwin Fabila Canja', '1997-12-10', 'Male', 'Libtong Roxas', 'Darwin  Canja', 'Mia Khalifda', 'Libtong Roxas', '', 'Fr. Edwin Semilla', '', '', '', '', '0', '0', '0', '2023-10-28', 'Mansalay'),
(6, 'aw', 'awd', '2023-11-30', 'Male', 'adw', 'awd', 'awd', 'adw', '', 'adw', '', '', '', '', '0', '0', '0', '2023-12-30', 'awd'),
(7, 'aw', 'Charles Darwin Fabila Canja', '2023-12-08', 'Male', 'Libtong Roxas', 'Jhonny Sins', 'Mia Khalifda', 'Libtong RoxAS', 'Farmerd', 'Charles Darwin Fabila Canja', 'Miles Church of God', '12', '2024-04-21', '12', '12', 'charles darwin', '1', '2023-12-21', 'libtong Roxas'),
(8, '211', 'Charles Darwin Fabila Canja', '2002-01-14', 'Male', 'Libtong Roxas', 'Jhonny Sins', 'Mia Khalifda', 'Libtong RoxAS', '', 'Jordi Poala Proche', 'Miles Church of God', '14', '2002-12-12', '14', 'Charles Miles Canja', 'Miles Morales', '14', '2024-04-06', 'Roxas Oriental Mindor0');

-- --------------------------------------------------------

--
-- Table structure for table `communion`
--

CREATE TABLE `communion` (
  `id` int(11) NOT NULL,
  `record_no` varchar(255) DEFAULT NULL,
  `child_name` varchar(255) DEFAULT NULL,
  `date_of_baptism` date DEFAULT NULL,
  `place_of_baptism` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `date_of_communion` date DEFAULT NULL,
  `place_of_communion` varchar(255) DEFAULT NULL,
  `rev` varchar(225) NOT NULL,
  `line` varchar(225) NOT NULL,
  `book` varchar(201) NOT NULL,
  `spo` varchar(250) NOT NULL,
  `church` varchar(15) NOT NULL,
  `page` varchar(255) NOT NULL,
  `minister_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communion`
--

INSERT INTO `communion` (`id`, `record_no`, `child_name`, `date_of_baptism`, `place_of_baptism`, `father_name`, `mother_name`, `date_of_communion`, `place_of_communion`, `rev`, `line`, `book`, `spo`, `church`, `page`, `minister_name`) VALUES
(3, '0032', 'Charles Darwin Canja', '2224-02-22', 'Roxas Oriental Mindor0', 'Jhonny Sins', 'Mia Khalifda', '2222-02-22', 'Here', 'Charles Miles Canja', '14', '12', 'Miles Morales', '2024-04-04', '14', 'Father Jorde Paola'),
(4, '211', 'Charles Darwin Canja', '2024-04-20', 'Roxas Oriental Mindor0', 'Jhonny Sins', 'Mia Khalifda', '2024-04-17', 'Oriental Mindoro', 'Charles Miles Canja', '14', '14', 'Miles Morales', '2024-04-12', '14', 'Father Jorde Paola');

-- --------------------------------------------------------

--
-- Table structure for table `conversion`
--

CREATE TABLE `conversion` (
  `id` int(11) NOT NULL,
  `record_no` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_of_rite` date DEFAULT NULL,
  `place_of_reception` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `name_of_father` varchar(255) DEFAULT NULL,
  `name_of_mother` varchar(255) DEFAULT NULL,
  `receiving_minister` varchar(255) DEFAULT NULL,
  `date_of_baptism` date DEFAULT NULL,
  `place_of_baptism` varchar(255) DEFAULT NULL,
  `denomination` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversion`
--

INSERT INTO `conversion` (`id`, `record_no`, `name`, `date_of_rite`, `place_of_reception`, `date_of_birth`, `place_of_birth`, `name_of_father`, `name_of_mother`, `receiving_minister`, `date_of_baptism`, `place_of_baptism`, `denomination`) VALUES
(2, '', '123213', '0000-00-00', 'awdawd', '1312-02-23', 'awdaw', 'dawd', 'awdawd', 'awdawd', '2121-03-21', 'awdaw', 'dawdaw'),
(3, '221', '2211112', '0222-02-22', '2222', '0222-02-22', '2222', '22', '222', '222', '0222-02-22', '2222', '222'),
(4, 'awd', 'awd', '2023-12-16', NULL, '2023-12-22', 'awdawd', 'awd', 'awd', 'awd', '2023-12-21', 'awdawd', 'awdawd');

-- --------------------------------------------------------

--
-- Table structure for table `death`
--

CREATE TABLE `death` (
  `id` int(11) NOT NULL,
  `record_no` varchar(50) NOT NULL,
  `name_of_deceased` varchar(100) NOT NULL,
  `name1` varchar(100) NOT NULL,
  `residence` varchar(100) NOT NULL,
  `date_of_death` date NOT NULL,
  `date_of_burial` date NOT NULL,
  `age` int(11) NOT NULL,
  `place_of_burial` varchar(100) NOT NULL,
  `sacraments` varchar(100) NOT NULL,
  `name_of_priest` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `spouse` varchar(100) NOT NULL,
  `line` varchar(222) NOT NULL,
  `book` varchar(222) NOT NULL,
  `page` varchar(222) NOT NULL,
  `name2` varchar(222) NOT NULL,
  `name3` varchar(222) NOT NULL,
  `barrio` varchar(222) NOT NULL,
  `municipal` varchar(100) NOT NULL,
  `death` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `death`
--

INSERT INTO `death` (`id`, `record_no`, `name_of_deceased`, `name1`, `residence`, `date_of_death`, `date_of_burial`, `age`, `place_of_burial`, `sacraments`, `name_of_priest`, `province`, `spouse`, `line`, `book`, `page`, `name2`, `name3`, `barrio`, `municipal`, `death`, `status`, `date_created`) VALUES
(1, '12', 'Mario Chart', 'Jhonhy Sins', 'Libtong Roxas', '2024-04-14', '2024-04-20', 21, 'Roxas Cemetary', 'Hebrew', 'Jordi de Pola', 'Oriental Mindoro', 'Driver NG Truck', '', '', '', '', '', '', 'Calapan', 'Pagmamanyak', 'Single', '2024-04-20'),
(2, '211', 'darwin canja charles', 'Charles Darwin Fabila Canja', 'Libtong Roxas', '2024-04-27', '2024-04-16', 21, 'Roxas Cemetary', 'Hebrew12', 'Jordi de Pola', 'Oriental Mindoro', 'Farmerd', '14', '14', '14', 'Charles Darwin Fabila Canja', 'Miles Jets', 'Libtong', 'Calapan', 'Pagmamanyak', 'Single', '2024-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marriage`
--

CREATE TABLE `marriage` (
  `id` int(11) NOT NULL,
  `record_no` varchar(255) DEFAULT NULL,
  `priest_name` varchar(255) DEFAULT NULL,
  `groom_name` varchar(255) DEFAULT NULL,
  `groom_legal_status` varchar(255) DEFAULT NULL,
  `groom_age` int(11) DEFAULT NULL,
  `groom_place_of_birth` varchar(255) DEFAULT NULL,
  `groom_address` varchar(255) DEFAULT NULL,
  `groom_father` varchar(255) DEFAULT NULL,
  `groom_mother` varchar(255) DEFAULT NULL,
  `bride_name` varchar(255) DEFAULT NULL,
  `bride_legal_status` varchar(255) DEFAULT NULL,
  `bride_age` int(11) DEFAULT NULL,
  `bride_place_of_birth` varchar(255) DEFAULT NULL,
  `bride_address` varchar(255) DEFAULT NULL,
  `bride_father` varchar(255) DEFAULT NULL,
  `bride_mother` varchar(255) DEFAULT NULL,
  `date_of_marriage` date DEFAULT NULL,
  `native` varchar(255) DEFAULT NULL,
  `natives` varchar(255) DEFAULT NULL,
  `church` varchar(255) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `book` int(11) DEFAULT NULL,
  `issue` varchar(112) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `rev` varchar(255) DEFAULT NULL,
  `presence1` varchar(255) DEFAULT NULL,
  `presence2` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `bride_date_of_birth` varchar(222) NOT NULL,
  `groom_date_of_birth` varchar(222) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marriage`
--

INSERT INTO `marriage` (`id`, `record_no`, `priest_name`, `groom_name`, `groom_legal_status`, `groom_age`, `groom_place_of_birth`, `groom_address`, `groom_father`, `groom_mother`, `bride_name`, `bride_legal_status`, `bride_age`, `bride_place_of_birth`, `bride_address`, `bride_father`, `bride_mother`, `date_of_marriage`, `native`, `natives`, `church`, `line`, `page`, `book`, `issue`, `license`, `rev`, `presence1`, `presence2`, `address1`, `address2`, `bride_date_of_birth`, `groom_date_of_birth`, `created_at`) VALUES
(1, '12', 'jhnoy sins', 'Charles Darwin Canja', 'Single', 22, 'Libtong Roxas', 'Libtong RoxAS', 'CHarles CANJA', 'MiA kHALIFA', 'Charles Darwin Canja', 'Single', 22, 'Libtong Roxas ', 'Libtong RoxAS', 'Canja Charles', 'Lexi Lore', '2002-01-14', 'Libtong Roxas', 'Libtong Roxas', 'eGLISHA NO CHORISTO', 14, 14, 12, 'libtong', '9833248', 'Charles Miles Canja', 'cHARLES daRWIN', 'DARWIN CHARLES', 'Libtong RoxAS', 'Roxas Libtong', '2002-01-14', '2002-01-14', '2024-04-20 21:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `certification` varchar(255) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fullname`, `age`, `phone`, `address`, `purpose`, `certification`, `timestamp`) VALUES
(7, 'Mary Rose Banawa', 232, 9694123456, 'Roxas', '', '', '2023-10-13');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `payment_date` date NOT NULL DEFAULT current_timestamp(),
  `contributions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `fullname`, `address`, `amount`, `payment_date`, `contributions`) VALUES
(4, 'Kyle', 'Mansalay', 500, '2023-10-14', 'Baptism'),
(7, 'Mary Rose', 'Roxas, Oriental Mindoro', 1000, '2024-02-01', 'Donation');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `priest` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `name`, `datetime`, `priest`, `client_name`, `timestamp`) VALUES
(1, 'Birthday Party', '2023-09-12 10:00:00', '', '', '2023-09-12'),
(0, 'BAPTISM', '2023-10-15 19:58:00', 'ninong', 'james', '2023-10-15'),
(0, '', '2024-03-30 09:00:00', ' ', 'Mary Banawa', '2024-03-23'),
(0, '', '2024-04-27 08:30:00', ' ', 'Mary Banawa', '2024-04-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baptism`
--
ALTER TABLE `baptism`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communion`
--
ALTER TABLE `communion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversion`
--
ALTER TABLE `conversion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `death`
--
ALTER TABLE `death`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marriage`
--
ALTER TABLE `marriage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `baptism`
--
ALTER TABLE `baptism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `communion`
--
ALTER TABLE `communion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `conversion`
--
ALTER TABLE `conversion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `death`
--
ALTER TABLE `death`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marriage`
--
ALTER TABLE `marriage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
