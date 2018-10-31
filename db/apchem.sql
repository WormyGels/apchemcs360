-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2018 at 06:15 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apchem`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `class_name` text NOT NULL,
  `join_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `instructor_id`, `class_name`, `join_key`) VALUES
(1, 3, 'Dr Galloway Section 1', 'FZnzD1RYKXohVO5ug83b9U0faAwHvQJd'),
(2, 3, 'Dr Galloway Section 2', 'G4UmvRsDwc1nrOMEpHF90We6NyabYgIJ'),
(3, 5, 'Jeremy Section 1', 'PwOEA1y93Ir8YsgaGkBVb6HCjvdxDqzZ'),
(4, 3, 'Dr Galloway Section 3', '69CaASmkotlDN5K7xFBvwzduWy8Tre4b'),
(5, 3, 'Dr Galloway Section 4', '8lCuST3jsqQ7imxPAfVo1beZkWJzOIDa'),
(6, 5, 'Jeremy Section 2', 'AgONsPIj24hSkEyYKHrqwXDQMJxeafTl'),
(7, 8, 'Clown School', 'VrI6awW4X0nR5eJHE3mhpjbc2idSuFQY');

-- --------------------------------------------------------

--
-- Table structure for table `in_class`
--

CREATE TABLE `in_class` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `quiz_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_type` tinyint(1) NOT NULL,
  `ans1_text` text NOT NULL,
  `ans2_text` text NOT NULL,
  `ans3_text` text NOT NULL,
  `ans4_text` text NOT NULL,
  `ans5_text` text NOT NULL,
  `ans6_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `username`, `password`) VALUES
(1, 1, 'test1', '5e52fee47e6b070565f74372468cdc699de89107'),
(2, 3, 'test2', '013bc84affed0fd19721ff66c561db7f63c2d6aa'),
(3, 2, 'DrGalloway', 'f5c0d36011b4e62ef307fb730529517efb7b4473'),
(4, 1, 'DrAtici', '76fec56b10f61c595c4d638ef0a41f1476cb3f19'),
(5, 2, 'InstructorJeremy', 'b17d52e132dd23769847e73e18fcf885c8415181'),
(6, 2, 'InstructorAustin', '94804f3c9409fdde61b83714a50d376a84a72f50'),
(7, 3, 'StudentJeremy', '013bc84affed0fd19721ff66c561db7f63c2d6aa'),
(8, 2, 'NewBoy', '013bc84affed0fd19721ff66c561db7f63c2d6aa'),
(9, 2, 'EvenNewerBoy', '013bc84affed0fd19721ff66c561db7f63c2d6aa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `instructor` (`instructor_id`);

--
-- Indexes for table `in_class`
--
ALTER TABLE `in_class`
  ADD KEY `student` (`student_id`),
  ADD KEY `class` (`class_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `quiz` (`quiz_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `instructor` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `in_class`
--
ALTER TABLE `in_class`
  ADD CONSTRAINT `class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `student` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
