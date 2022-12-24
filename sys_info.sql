-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2022 at 09:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sys_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(2, 'shine', '$2y$10$VzZXMSEJihD9jdRi1SWdxeGQEYa48zaIHuBsJyz7VXhyaVTdXctpi');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(100) NOT NULL,
  `course_name` varchar(30) NOT NULL,
  `course_desc` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_desc`, `status`) VALUES
(9, 'aa', 'aa', 0),
(10, 'ss', 'ss', 0),
(11, 'ww', 'ww', 0),
(14, 'aaa', 'aaa', 1),
(15, 'vvv', 'vvv', 1),
(16, 'bbb', 'bbb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_student`
--

CREATE TABLE `course_student` (
  `course_id` int(100) NOT NULL,
  `course_name` varchar(30) NOT NULL,
  `course_desc` varchar(30) NOT NULL,
  `enroll_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_student`
--

INSERT INTO `course_student` (`course_id`, `course_name`, `course_desc`, `enroll_date`, `status`, `user_id`) VALUES
(14, 'aaa', 'aaa', '2022-12-24', 1, 3),
(16, 'bbb', 'bbb', '2022-12-24', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stdname` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `nrc` varchar(30) NOT NULL,
  `phone` int(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `image` blob NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stdname`, `gender`, `mail`, `nrc`, `phone`, `address`, `image`, `user_id`) VALUES
('Mg Mg', 'Male', 'mgmg123@gmail.com', '9/MHM(C)092022', 2147483647, 'Yangon', 0x646f672e6a7067, 3),
('Ag Ag', 'Male', 'agag@gmail.com', '8/MCK(C)929312', 2147483647, 'Chaung', 0x626f792e6a7067, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(3, 'mg mg', '$2y$10$tfNhBA1PR3ceXtLSx5D0iecyPqs7WKmRx.5tZdbJdtLQfuQ5HvGhW'),
(4, 'ag ag', '$2y$10$cEwgys.BFhB93BM8KRQ.Z./vjR3kFYqW.dREy0VfWRo4nm8oabWIG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_student`
--
ALTER TABLE `course_student`
  ADD KEY `userid` (`user_id`),
  ADD KEY `courseid` (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD KEY `userid` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_student`
--
ALTER TABLE `course_student`
  ADD CONSTRAINT `courseid` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
