-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 12:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mylogbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `institution_supervisor_table`
--

CREATE TABLE `institution_supervisor_table` (
  `super_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `super_name` varchar(100) NOT NULL,
  `super_email` varchar(100) NOT NULL,
  `super_mobile` bigint(11) NOT NULL,
  `super_address` varchar(100) NOT NULL,
  `email_verified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution_supervisor_table`
--

INSERT INTO `institution_supervisor_table` (`super_id`, `student_id`, `super_name`, `super_email`, `super_mobile`, `super_address`, `email_verified`) VALUES
(1, 1, 'Dr. Tobiloba Odule', 'tobilobaodule@gmail.com', 2347015281103, '17, Adetunji Adebajo, Lucky Fibres, Ikorodu', '');

-- --------------------------------------------------------

--
-- Table structure for table `institution_table`
--

CREATE TABLE `institution_table` (
  `institution_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `institution_name` varchar(100) NOT NULL,
  `institution_email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `course_of_study` text NOT NULL,
  `level` int(5) NOT NULL,
  `programme` varchar(9) NOT NULL,
  `faculty` text NOT NULL,
  `department` text NOT NULL,
  `email_verified` varchar(3) NOT NULL,
  `account_updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution_table`
--

INSERT INTO `institution_table` (`institution_id`, `student_id`, `institution_name`, `institution_email`, `image`, `address`, `course_of_study`, `level`, `programme`, `faculty`, `department`, `email_verified`, `account_updated_at`) VALUES
(1, 1, 'Olabisi Onabanjo University', 'oouagoiwoyeedu@gmail.com', 'oou_image.png', 'Olabisi Onabanjo University, P.M.B 2013, Ago-Iwoye, Ogun state', 'Computer Science', 3, 'Bsc', 'Science', 'Mathematical/Computer Science', '', '2023-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `internship_table`
--

CREATE TABLE `internship_table` (
  `internship_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `organization_id` int(10) NOT NULL,
  `institution_id` int(10) NOT NULL,
  `institution_super_id` int(10) NOT NULL,
  `organization_super_id` int(10) NOT NULL,
  `role_played` text NOT NULL,
  `cum_alawee` int(8) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `account_updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `internship_table`
--

INSERT INTO `internship_table` (`internship_id`, `student_id`, `organization_id`, `institution_id`, `institution_super_id`, `organization_super_id`, `role_played`, `cum_alawee`, `duration`, `start_date`, `end_date`, `account_updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 'Frontend Developer', 10000, '+6 months', '2023-03-09', '2023-09-09', '2023-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `log_entries_table`
--

CREATE TABLE `log_entries_table` (
  `log_entry_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `internship_id` int(10) NOT NULL,
  `log_title` varchar(100) NOT NULL,
  `log_image` varchar(100) NOT NULL,
  `log_body` varchar(535) NOT NULL,
  `supervisor_log_remark` varchar(100) NOT NULL,
  `log_date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_table`
--

CREATE TABLE `notifications_table` (
  `notification_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `header` varchar(100) NOT NULL,
  `body` varchar(250) NOT NULL,
  `notification_date` date NOT NULL DEFAULT current_timestamp(),
  `notification_time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications_table`
--

INSERT INTO `notifications_table` (`notification_id`, `student_id`, `header`, `body`, `notification_date`, `notification_time`) VALUES
(1, 1, 'You edited your general information', 'You successfully edited your general information  2023-03-03 at the  time of the day. Some of the other activities might be listed below', '2023-03-03', '20:31:32'),
(2, 0, 'You logged in on 2023-03-04', 'You logged in 2023-03-04 at the time  and performed some activities whose notifications and what you did will be listed below.', '2023-03-04', '14:26:08'),
(3, 1, 'You logged in on 2023-03-04', 'You logged in 2023-03-04 at the time  and performed some activities whose notifications and what you did will be listed below.', '2023-03-04', '14:26:10'),
(4, 0, 'You logged in on 2023-03-05', 'You logged in 2023-03-05 at the time  and performed some activities whose notifications and what you did will be listed below.', '2023-03-05', '16:29:07'),
(5, 1, 'You logged in on 2023-03-05', 'You logged in 2023-03-05 at the time  and performed some activities whose notifications and what you did will be listed below.', '2023-03-05', '16:29:09'),
(6, 1, 'You added your institution supervisor details', 'You successfully added your institution supervisor details 2023-03-05 at the  time of the day. Some of the other activities might be listed below', '2023-03-05', '16:54:37'),
(7, 0, 'You logged in on 2023-03-07', 'You logged in 2023-03-07 at the time  and performed some activities whose notifications and what you did will be listed below.', '2023-03-07', '15:11:04'),
(8, 1, 'You logged in on 2023-03-07', 'You logged in 2023-03-07 at the time  and performed some activities whose notifications and what you did will be listed below.', '2023-03-07', '15:11:04'),
(9, 0, 'You logged in on 2023-03-08', 'You logged in 2023-03-08 at the time  and performed some activities whose notifications and what you did will be listed below.', '2023-03-08', '13:51:59'),
(10, 1, 'You added your organization supervisor details', 'You successfully added your organization supervisor details 2023-03-08 at the  time of the day. Some of the other activities might be listed below', '2023-03-08', '13:58:30'),
(11, 1, 'You edited your organization supervisor details', 'You successfully edited your organization supervisor details 2023-03-08 at the  time of the day. Some of the other activities might be listed below', '2023-03-08', '13:58:33'),
(12, 1, 'You added your organization supervisor details', 'You successfully added your organization supervisor details 2023-03-08 at the  time of the day. Some of the other activities might be listed below', '2023-03-08', '14:08:42'),
(13, 1, 'You edited your organization supervisor details', 'You successfully edited your organization supervisor details 2023-03-08 at the  time of the day. Some of the other activities might be listed below', '2023-03-08', '14:08:43'),
(14, 0, 'You logged in on 2023-03-09', 'You logged in 2023-03-09 at the time  and performed some activities whose notifications and what you did will be listed below.', '2023-03-09', '13:42:56'),
(15, 0, 'You logged in on 2023-03-10', 'You logged in 2023-03-10 at the time  and performed some activities whose notifications and what you did will be listed below.', '2023-03-10', '07:43:29'),
(16, 0, 'You logged in on 2023-03-10', 'You logged in 2023-03-10 at the time 1678438336 and performed some activities whose notifications and what you did will be listed below.', '2023-03-10', '09:52:17'),
(17, 1, 'You added a log', 'You added a log for the date of 2023-03-09', '2023-03-10', '09:54:40'),
(18, 1, 'You added a log', 'You added a log for the date of 2023-03-09', '2023-03-10', '09:57:38'),
(19, 0, 'You logged in on 2023-03-10', 'You logged in 2023-03-10 at the time 1678448862 and performed some activities whose notifications and what you did will be listed below.', '2023-03-10', '12:47:43'),
(20, 0, 'You logged in on 2023-03-11', 'You logged in 2023-03-11 at the time 1678533418 and performed some activities whose notifications and what you did will be listed below.', '2023-03-11', '12:16:58'),
(21, 0, 'You logged in on 2023-03-13', 'You logged in 2023-03-13 at the time 1678722999 and performed some activities whose notifications and what you did will be listed below.', '2023-03-13', '16:56:39'),
(22, 0, 'You logged in on 2023-03-16', 'You logged in 2023-03-16 at the time 1678977448 and performed some activities whose notifications and what you did will be listed below.', '2023-03-16', '15:37:28'),
(23, 0, 'You logged in on 2023-03-27', 'You logged in 2023-03-27 at the time 1679912543 and performed some activities whose notifications and what you did will be listed below.', '2023-03-27', '11:22:23'),
(24, 0, 'You logged in on 2023-03-28', 'You logged in 2023-03-28 at the time 1679984814 and performed some activities whose notifications and what you did will be listed below.', '2023-03-28', '07:26:54'),
(25, 0, 'You logged in on 2023-03-28', 'You logged in 2023-03-28 at the time 1679997748 and performed some activities whose notifications and what you did will be listed below.', '2023-03-28', '11:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `organization_supervisor_table`
--

CREATE TABLE `organization_supervisor_table` (
  `super_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `super_name` varchar(100) NOT NULL,
  `super_email` varchar(100) NOT NULL,
  `super_mobile` bigint(11) NOT NULL,
  `role_played` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `internship_signature_image` varchar(100) NOT NULL,
  `email_verified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization_supervisor_table`
--

INSERT INTO `organization_supervisor_table` (`super_id`, `student_id`, `super_name`, `super_email`, `super_mobile`, `role_played`, `address`, `internship_signature_image`, `email_verified`) VALUES
(1, 1, 'Alaja Ayokunle', 'alajaayokunle123@gmail.com', 2348035021995, 'General Manager', '17, FKC Farm Ave, Osota Bus stop, Ijede Road, Ikorodu', 'signature.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `organization_table`
--

CREATE TABLE `organization_table` (
  `organization_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `organization_email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `organization_mobile` bigint(11) NOT NULL,
  `department_posted` varchar(50) NOT NULL,
  `account_updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization_table`
--

INSERT INTO `organization_table` (`organization_id`, `student_id`, `organization_name`, `organization_email`, `image`, `address`, `organization_mobile`, `department_posted`, `account_updated_at`) VALUES
(1, 1, 'HiiT Plc', 'hiitplc@gmail.com', 'hiit_image.png', '28, Oba Akran street, Off Siwes Office, Ikeja, Lagos', 700123456789, 'Web services', '2023-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `students_table`
--

CREATE TABLE `students_table` (
  `student_id` int(11) NOT NULL,
  `students_name` varchar(70) NOT NULL,
  `students_email` varchar(40) NOT NULL,
  `students_phone` bigint(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `institution_id` int(10) NOT NULL,
  `organization_id` int(10) NOT NULL,
  `gender` text NOT NULL,
  `student_image` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email_verified` text NOT NULL,
  `account_updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_table`
--

INSERT INTO `students_table` (`student_id`, `students_name`, `students_email`, `students_phone`, `address`, `institution_id`, `organization_id`, `gender`, `student_image`, `password`, `email_verified`, `account_updated_at`) VALUES
(1, 'Timilehin Amu', 'amuoladipupo@gmail.com', 2348181107488, '17, Adetunji Adebajo, Lucky Fibres, Ikorodu', 1, 1, 'Male', 'mypic.jpg', '$2y$10$i5Eo1NwfwWQT8lIKGOh6EuWT4lxpBtiy8jnJc896ZY1iVKV/MGdeG', '', '2023-02-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `institution_supervisor_table`
--
ALTER TABLE `institution_supervisor_table`
  ADD PRIMARY KEY (`super_id`);

--
-- Indexes for table `institution_table`
--
ALTER TABLE `institution_table`
  ADD PRIMARY KEY (`institution_id`);

--
-- Indexes for table `internship_table`
--
ALTER TABLE `internship_table`
  ADD PRIMARY KEY (`internship_id`);

--
-- Indexes for table `log_entries_table`
--
ALTER TABLE `log_entries_table`
  ADD PRIMARY KEY (`log_entry_id`);

--
-- Indexes for table `notifications_table`
--
ALTER TABLE `notifications_table`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `organization_supervisor_table`
--
ALTER TABLE `organization_supervisor_table`
  ADD PRIMARY KEY (`super_id`);

--
-- Indexes for table `organization_table`
--
ALTER TABLE `organization_table`
  ADD PRIMARY KEY (`organization_id`);

--
-- Indexes for table `students_table`
--
ALTER TABLE `students_table`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `institution_supervisor_table`
--
ALTER TABLE `institution_supervisor_table`
  MODIFY `super_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institution_table`
--
ALTER TABLE `institution_table`
  MODIFY `institution_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `internship_table`
--
ALTER TABLE `internship_table`
  MODIFY `internship_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_entries_table`
--
ALTER TABLE `log_entries_table`
  MODIFY `log_entry_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications_table`
--
ALTER TABLE `notifications_table`
  MODIFY `notification_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `organization_supervisor_table`
--
ALTER TABLE `organization_supervisor_table`
  MODIFY `super_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organization_table`
--
ALTER TABLE `organization_table`
  MODIFY `organization_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students_table`
--
ALTER TABLE `students_table`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
