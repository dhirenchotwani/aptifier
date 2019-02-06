-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2019 at 08:42 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_handlers`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `chapter_id` int(11) NOT NULL,
  `chapter_name` varchar(255) NOT NULL,
  `chapter_subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `questions_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_image` int(11) NOT NULL,
  `question_options` text NOT NULL,
  `question_correct_answer` varchar(255) NOT NULL,
  `question_difficulty_level` int(11) NOT NULL,
  `is_question_image` int(11) NOT NULL,
  `question_chapter_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_class_id` varchar(10) NOT NULL,
  `student_division` varchar(10) NOT NULL,
  `student_branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `user_id`, `student_class_id`, `student_division`, `student_branch`) VALUES
(1, 1, '12', 'B', 1),
(2, 4, '11', 'A', 3);

-- --------------------------------------------------------

--
-- Table structure for table `student_branch`
--

CREATE TABLE `student_branch` (
  `student_branch_id` int(11) NOT NULL,
  `student_branch_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_branch`
--

INSERT INTO `student_branch` (`student_branch_id`, `student_branch_name`) VALUES
(1, 'CMPN'),
(2, 'IT'),
(3, 'EXTC'),
(4, 'ETRX'),
(5, 'IS'),
(6, 'MCA');

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `student_class_id` int(11) NOT NULL,
  `student_class` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`student_class_id`, `student_class`) VALUES
(1, 'D1'),
(2, 'D2'),
(3, 'D3'),
(4, 'D4'),
(5, 'D5'),
(6, 'D6'),
(7, 'D7'),
(8, 'D8'),
(9, 'D9'),
(10, 'D10'),
(11, 'D11'),
(12, 'D12'),
(13, 'D13'),
(14, 'D14'),
(15, 'D15'),
(16, 'D16'),
(17, 'D17'),
(18, 'D18'),
(19, 'D19'),
(20, 'D20');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_semester` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `test_question_id` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `test_class_id` int(11) NOT NULL,
  `test_division` varchar(10) NOT NULL,
  `test_level` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_question`
--

CREATE TABLE `test_question` (
  `test_question_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_student`
--

CREATE TABLE `test_student` (
  `test_student_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(255) DEFAULT NULL,
  `user_last_name` varchar(255) DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` text,
  `user_flat` varchar(10) DEFAULT NULL,
  `user_building` varchar(255) DEFAULT NULL,
  `user_street` varchar(255) DEFAULT NULL,
  `user_city` varchar(255) DEFAULT NULL,
  `user_state` varchar(255) DEFAULT NULL,
  `user_pincode` varchar(10) DEFAULT NULL,
  `user_nationality` varchar(255) DEFAULT NULL,
  `user_token` text,
  `user_role_id` int(11) DEFAULT NULL,
  `user_profile_pic` text NOT NULL,
  `is_email_verified` int(2) DEFAULT NULL,
  `is_first_login` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `is_deleted` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_dob`, `user_email`, `user_password`, `user_flat`, `user_building`, `user_street`, `user_city`, `user_state`, `user_pincode`, `user_nationality`, `user_token`, `user_role_id`, `user_profile_pic`, `is_email_verified`, `is_first_login`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `is_deleted`) VALUES
(1, 'Dhiren', 'Chotwani', '1998-05-16', 'dhirenchotwani@gmail.com', 'abc123', '202', 'Parth Sarthi', 'Jai Mata Di Nagar', 'Ulhasnagar', 'Maharashtra', '421003', 'Indian', '', 5, '', 1, 0, '2019-02-04 16:31:40', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(4, 'Nikhil', 'Ghind', NULL, 'ghind20@gmail.com', 'abc123', '202', 'Ghind Parivar', 'Bunflow Colony', 'Ulhasnagar', 'Maharashtra', NULL, 'Indian', NULL, 5, '', 1, 0, '2019-02-06 11:30:48', 4, '0000-00-00 00:00:00', 4, '0000-00-00 00:00:00', NULL, 0),
(7, 'Chotwani', 'Dhiren', NULL, 'chotwanidhirendc@gmail.com', 'abc123', '305', 'Satuguru Hrights', 'BB More Colony', 'Ulhasnagar', 'Maharashtra', NULL, 'Indian', NULL, 5, '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', 1, 0, '2019-02-06 12:17:20', 7, '0000-00-00 00:00:00', 7, '0000-00-00 00:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`) VALUES
(1, 'ADMIN'),
(2, 'INVIGILITOR'),
(3, 'TEACHER'),
(4, 'LAB ASSISTANT'),
(5, 'STUDENT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`chapter_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questions_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_branch`
--
ALTER TABLE `student_branch`
  ADD PRIMARY KEY (`student_branch_id`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`student_class_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `test_question`
--
ALTER TABLE `test_question`
  ADD PRIMARY KEY (`test_question_id`);

--
-- Indexes for table `test_student`
--
ALTER TABLE `test_student`
  ADD PRIMARY KEY (`test_student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `questions_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_branch`
--
ALTER TABLE `student_branch`
  MODIFY `student_branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `student_class`
--
ALTER TABLE `student_class`
  MODIFY `student_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test_question`
--
ALTER TABLE `test_question`
  MODIFY `test_question_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test_student`
--
ALTER TABLE `test_student`
  MODIFY `test_student_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
