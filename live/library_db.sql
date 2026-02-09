-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2026 at 05:58 PM
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
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `assign_date` date NOT NULL,
  `status` enum('assigned','returned') DEFAULT 'assigned',
  `return_condition` enum('Excellent','Good','Poor','Damaged') DEFAULT NULL,
  `return_notes` text DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `student_id`, `book_id`, `assign_date`, `status`, `return_condition`, `return_notes`, `return_date`, `created_at`) VALUES
(1, 1, 1, '2026-02-01', 'assigned', NULL, NULL, NULL, '2026-02-06 16:32:23'),
(2, 2, 2, '2026-02-02', 'assigned', NULL, NULL, NULL, '2026-02-06 16:32:23'),
(3, 3, 3, '2026-02-03', 'assigned', NULL, NULL, NULL, '2026-02-06 16:32:23'),
(4, 4, 4, '2026-01-25', 'returned', 'Good', 'Book in excellent condition', '2026-02-05', '2026-02-06 16:32:23'),
(5, 5, 5, '2026-01-28', 'returned', 'Poor', 'Some pages torn, cover damaged', '2026-02-06', '2026-02-06 16:32:23'),
(6, 6, 6, '2026-01-30', 'returned', 'Excellent', 'Perfect condition', '2026-02-04', '2026-02-06 16:32:23'),
(7, 9, 8, '2026-02-06', 'returned', 'Damaged', 'sorry accidentlly my dog chew it', '2026-02-06', '2026-02-06 16:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `available` int(11) NOT NULL DEFAULT 1,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `quantity`, `available`, `category`, `created_at`) VALUES
(1, 'PHP & MySQL Web Development', 'Luke Welling', '978-0321833890', 5, 3, 'Technology', '2026-02-06 16:32:23'),
(2, 'JavaScript: The Definitive Guide', 'David Flanagan', '978-0596805524', 8, 2, 'Technology', '2026-02-06 16:32:23'),
(3, 'Clean Code: A Handbook', 'Robert C. Martin', '978-0132350884', 4, 1, 'Technology', '2026-02-06 16:32:23'),
(4, 'The Great Gatsby', 'F. Scott Fitzgerald', '978-0743273565', 10, 8, 'Fiction', '2026-02-06 16:32:23'),
(5, 'To Kill a Mockingbird', 'Harper Lee', '978-0061120084', 6, 4, 'Fiction', '2026-02-06 16:32:23'),
(6, '1984', 'George Orwell', '978-0451524935', 7, 5, 'Fiction', '2026-02-06 16:32:23'),
(7, 'Database System Concepts', 'Abraham Silberschatz', '978-0078022159', 3, 0, 'Science', '2026-02-06 16:32:23'),
(8, 'life of jinku', 'barad vipul', '23434', 100, 100, 'Fiction', '2026-02-06 16:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`, `created_at`) VALUES
(1, 'Rahul Patel', 'rahul.patel@email.com', '9876543210', '2026-02-06 16:32:23'),
(2, 'Priya Sharma', 'priya.sharma@email.com', '9876543201', '2026-02-06 16:32:23'),
(3, 'Amit Kumar', 'amit.kumar@email.com', '9876543202', '2026-02-06 16:32:23'),
(4, 'Sneha Gupta', 'sneha.gupta@email.com', '9876543203', '2026-02-06 16:32:23'),
(5, 'Vikram Singh', 'vikram.singh@email.com', '9876543204', '2026-02-06 16:32:23'),
(6, 'Neha Desai', 'neha.desai@email.com', '9876543205', '2026-02-06 16:32:23'),
(7, 'Rohan Mehta', 'rohan.mehta@email.com', '9876543206', '2026-02-06 16:32:23'),
(8, 'Divya Joshi', 'divya.joshi@email.com', '9876543207', '2026-02-06 16:32:23'),
(9, 'vipul', 'v@gmail.com', '09664619523', '2026-02-06 16:46:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_student` (`student_id`),
  ADD KEY `idx_book` (`book_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `idx_title` (`title`),
  ADD KEY `idx_author` (`author`),
  ADD KEY `idx_available` (`available`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_name` (`name`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
