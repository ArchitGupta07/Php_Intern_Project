-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2023 at 03:30 PM
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
-- Database: `scratch`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `cid` int(150) NOT NULL,
  `student_id` int(150) NOT NULL,
  `attended` tinyint(1) NOT NULL DEFAULT 0,
  `reason` varchar(300) NOT NULL DEFAULT 'Attended the class'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`cid`, `student_id`, `attended`, `reason`) VALUES
(1, 0, 0, 'check ajax'),
(1, 11, 0, 'cccc'),
(3, 0, 0, 'cccc'),
(4, 11, 0, ''),
(6, 0, 0, 'qq'),
(6, 11, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `cid` int(150) NOT NULL,
  `course_code` int(150) NOT NULL,
  `module` int(150) NOT NULL,
  `session_no` int(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `creator` varchar(150) NOT NULL,
  `mode` varchar(150) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `down_pdf` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cid`, `course_code`, `module`, `session_no`, `title`, `creator`, `mode`, `date`, `down_pdf`) VALUES
(1, 101, 1, 1, 'Php Tutorial', 'aastha', 'online', '2023-07-05', ''),
(3, 101, 2, 1, 'classHq', 'aastha', 'online', '2023-07-08', ''),
(4, 101, 2, 2, 'hlo', 'aastha', 'online', '2023-07-08', 'Archit(1).pdf'),
(2, 102, 1, 1, 'Mediline', 'aastha', 'online', '2023-07-07', ''),
(5, 103, 1, 1, 'trial', 'aastha', 'online', '2023-07-10', 'file.pdf'),
(6, 104, 1, 1, '1trial', 'aastha', 'online', '2023-07-10', 'OfferLetter_Archit.pdf'),
(7, 105, 1, 1, 'first', 'archit', 'online', '2023-07-16', 'OfferLetter_Archit.pdf'),
(10, 105, 2, 1, 'trial2', 'archit', 'online', '2023-07-17', 'OfferLetter_Archit.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `com_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `comment` varchar(500) NOT NULL,
  `commenter_id` int(150) NOT NULL,
  `commenter` varchar(150) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discussions`
--

INSERT INTO `discussions` (`com_id`, `parent_id`, `comment`, `commenter_id`, `commenter`, `date`) VALUES
(1, NULL, 'Nice ', 11, 'aastha', '2023-07-18'),
(3, NULL, 'Hello ', 11, 'aastha', '2023-07-18'),
(4, 1, 'hlo ', 11, 'aastha', '2023-07-18'),
(5, 3, 'great ', 11, 'aastha', '2023-07-18'),
(6, NULL, 'Trail_30 ', 11, 'aastha', '2023-07-30'),
(7, 6, 'replyon30 ', 11, 'aastha', '2023-07-30'),
(8, NULL, 'Trail_30_2\r\n ', 11, 'aastha', '2023-07-30'),
(9, 8, 'reply ', 11, 'aastha', '2023-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `course` int(150) NOT NULL,
  `module` int(150) NOT NULL,
  `eid` int(150) NOT NULL,
  `type` varchar(150) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `deadline` date NOT NULL,
  `documents` varchar(150) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`course`, `module`, `eid`, `type`, `start_date`, `deadline`, `documents`, `marks`) VALUES
(101, 1, 1, 'Assignment', '2023-07-12', '2023-07-13', 'Archit(1).pdf', 0),
(101, 1, 2, 'Quiz', '2023-07-12', '2023-07-14', 'Archit(1).pdf', 1),
(105, 1, 3, 'quiz', '2023-07-17', '2023-07-18', 'Archit(1).pdf', 0),
(105, 2, 7, 'assignment', '2023-07-17', '0000-00-00', 'OfferLetter_Archit.pdf', 0),
(105, 1, 8, 'assignment', '2023-07-17', '0000-00-00', 'file.pdf', 0),
(105, 2, 9, 'assignment', '2023-07-17', '0000-00-00', 'OfferLetter_Archit.pdf', 0),
(105, 1, 10, 'quiz', '2023-07-17', '2023-07-22', 'Assignment_Content_Intern (1).pdf', 0),
(105, 2, 11, 'quiz', '2023-07-17', '2023-07-22', 'Assign.pdf', 0),
(105, 1, 12, 'quiz', '2023-07-17', '2023-07-19', 'Assign_c.pdf', 0),
(105, 1, 13, 'assignment', '2023-07-17', '0000-00-00', 'file.pdf', 0),
(105, 1, 14, 'quiz', '2023-07-17', '0000-00-00', 'Common PHP Test.pdf', 0),
(105, 1, 15, 'quiz', '2023-07-17', '2023-07-28', 'Assign.docx', 0),
(101, 2, 16, 'quiz', '2023-07-17', '0000-00-00', 'Assign.pdf', 0),
(101, 2, 17, 'quiz', '2023-07-17', '0000-00-00', 'Assign.pdf', 0),
(101, 1, 18, 'assignment', '2023-07-17', '0000-00-00', 'Assign_c.pdf', 0),
(101, 1, 19, 'quiz', '2023-08-02', '2023-08-31', 'Archit(1).pdf', 0),
(101, 1, 20, 'Quiz', '2023-08-02', '0000-00-00', 'Archit(1).pdf', 0),
(101, 1, 21, 'Quiz', '2023-08-03', '0000-00-00', 'Archit(1).pdf', 0),
(101, 1, 22, 'Quiz', '2023-08-03', '2023-08-31', 'Archit(1).pdf', 0),
(101, 1, 23, 'Assignment', '2023-08-03', '2023-08-31', 'Archit(1).pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `uid` int(150) NOT NULL,
  `cid` int(150) NOT NULL,
  `feedback` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`uid`, `cid`, `feedback`) VALUES
(9, 9, 'hgjmjhmvm'),
(11, 1, 'great lecture'),
(11, 1, 'qwqwqw'),
(11, 4, 'dcdscsdcds'),
(11, 6, 'vfrfvr'),
(0, 1, 'hlo_ajax'),
(0, 1, 'sdsdsvds');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `marks_id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `action` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`marks_id`, `eid`, `cid`, `student_id`, `marks`, `action`) VALUES
(1, 1, 1, 1, 5, 'submitted');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `permission` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `uid` int(150) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `location` varchar(200) NOT NULL DEFAULT 'India',
  `role` varchar(100) NOT NULL DEFAULT 'guest',
  `mobile_no` varchar(100) DEFAULT NULL,
  `profile_photo` varchar(300) NOT NULL DEFAULT 'avatar.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`uid`, `first_name`, `last_name`, `username`, `email`, `password`, `location`, `role`, `mobile_no`, `profile_photo`) VALUES
(1, 'archit', 'Gupta', 'archit', 'gupta.archit01@gmail.com', 'archit', 'India', 'student', '', 'avatar.jpg'),
(11, 'aastha', 'gupta', 'aastha', 'ag214@snu.edu.in', 'aastha', 'Roorkee', 'admin', '8077413601', 'IMG20220610122817.jpg'),
(23, 'shikha', 'Gupta', 'shikha', 'gupta.archit01@gmail.com', 'shikha', 'Roorkee', 'guest', NULL, 'avatar.jpg'),
(40, 'Ekansh', 'Panwar', 'Panwar', 'ekansh_panwar@gmail.com', 'check1', '', 'faculty', '', 'avatar.jpg'),
(41, 'check1', '', '', '', 'check1', '', 'guest', NULL, 'avatar.jpg'),
(42, 'check1', '', '', '', 'check1', '', 'guest', NULL, 'avatar.jpg'),
(43, 'check1', '', '', '', 'check1', '', 'guest', NULL, 'avatar.jpg'),
(44, 'check1', '', '', '', 'check1', '', 'guest', NULL, 'avatar.jpg'),
(45, 'check1', '', '', '', 'check1', '', 'guest', NULL, 'avatar.jpg'),
(46, 'check1', '', '', '', 'check1', '', 'guest', NULL, 'avatar.jpg'),
(47, 'naman', 'naman', 'naman', 'naman@gmail.com', 'naman', 'India', 'guest', '980000000', 'avatar.jpg'),
(48, 'White', 'White', 'White', 'architrockstar8@gmail.com', 'White', 'India', 'guest', NULL, 'avatar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `pid` int(150) NOT NULL,
  `pname` varchar(150) NOT NULL,
  `creator` int(150) NOT NULL DEFAULT 1,
  `note` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`pid`, `pname`, `creator`, `note`) VALUES
(1, 'Mediline', 11, 11),
(2, 'Chess Engine', 11, 12);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `qid` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `correct` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`qid`, `course`, `module`, `cid`, `eid`, `question`, `correct`) VALUES
(22, 101, 1, 0, 22, 1, 'a'),
(23, 101, 1, 0, 22, 2, 'c'),
(24, 101, 1, 0, 22, 3, 'd'),
(25, 101, 1, 0, 22, 4, 'c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`cid`,`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_code`,`module`,`session_no`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`marks_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`uid`,`cid`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `check` (`creator`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`qid`,`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `cid` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `eid` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `marks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `uid` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `pid` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `check` FOREIGN KEY (`creator`) REFERENCES `profile` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
