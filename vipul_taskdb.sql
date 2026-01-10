-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2026 at 05:47 AM
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
-- Database: `vipul_taskdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_approved_tasks`
--

CREATE TABLE `tbl_approved_tasks` (
  `approved_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `approved_task_name` text DEFAULT NULL,
  `approval_status` enum('approved','rejected') DEFAULT 'approved',
  `approved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_approved_tasks`
--

INSERT INTO `tbl_approved_tasks` (`approved_id`, `task_id`, `rid`, `approved_by`, `approved_task_name`, `approval_status`, `approved_at`) VALUES
(1, 1, 1, 'Vipul Manager', NULL, 'approved', '2026-01-09 13:12:26'),
(2, 2, 1, 'Vipul Manager', NULL, 'approved', '2026-01-09 13:12:26'),
(4, 0, 2, 'vipul', 'go to home early,go to college ', 'approved', '2026-01-09 13:20:07'),
(5, 0, 2, 'vipul', 'go to home early,go to college ', 'approved', '2026-01-09 13:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_register`
--

CREATE TABLE `tbl_register` (
  `rid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_register`
--

INSERT INTO `tbl_register` (`rid`, `name`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'Vipul', 'vipul@example.com', 'dGVzdDEyMw==', '9876543210', '2026-01-09 13:07:17'),
(2, 'vipul', 'u@gmail.com', 'MTIzNA==', '09664619523', '2026-01-09 13:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `task_id` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','completed','in_progress') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`task_id`, `rid`, `task_name`, `task_description`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Complete PHP Project', 'Finish the complete daily task management system with login/register', 'Finish daily task web application', 'pending', '2026-01-09 13:08:38', '2026-01-09 13:11:46'),
(2, 1, 'Database Setup', 'Setup vipul_taskdb database with all required tables and test data', 'Create all required tables', 'completed', '2026-01-09 13:08:38', '2026-01-09 13:11:46'),
(3, 1, 'Test Login/Register', NULL, 'Verify user authentication works', 'pending', '2026-01-09 13:08:38', '2026-01-09 13:08:38'),
(4, 2, 'go to home early', 'beacause of kite festivel', NULL, 'pending', '2026-01-09 13:11:52', '2026-01-09 13:11:52'),
(5, 2, 'go to college ', 'for the attendence', NULL, 'pending', '2026-01-09 13:17:05', '2026-01-09 13:17:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_approved_tasks`
--
ALTER TABLE `tbl_approved_tasks`
  ADD PRIMARY KEY (`approved_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `tbl_register`
--
ALTER TABLE `tbl_register`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `rid` (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_approved_tasks`
--
ALTER TABLE `tbl_approved_tasks`
  MODIFY `approved_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_register`
--
ALTER TABLE `tbl_register`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_approved_tasks`
--
ALTER TABLE `tbl_approved_tasks`
  ADD CONSTRAINT `tbl_approved_tasks_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `tbl_register` (`rid`);

--
-- Constraints for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD CONSTRAINT `tbl_task_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `tbl_register` (`rid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
