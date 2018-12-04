-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2018 at 06:45 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

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
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`student_id`, `quiz_id`, `correct`, `total`, `comments`) VALUES
(14, 1, 1, 2, ''),
(14, 2, 0, 4, ''),
(14, 3, 1, 1, ''),
(7, 4, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `in_class`
--

CREATE TABLE `in_class` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `in_class`
--

INSERT INTO `in_class` (`student_id`, `class_id`) VALUES
(11, 1),
(12, 1),
(7, 2),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `quiz_name` text NOT NULL,
  `quiz_category` text NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `class_id`, `quiz_name`, `quiz_category`, `points`) VALUES
(1, 1, 'Test Quiz 1', 'Chapter 1', 2),
(2, 1, 'Test Quiz 2', 'Chapter 1', 4),
(3, 1, 'Chemistry', 'Chapter', 10),
(4, 2, 'Introduction to Chemistry', 'Chapter 1', 5);

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
  `ans6_text` text NOT NULL,
  `correct_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`question_id`, `quiz_id`, `question_text`, `question_type`, `ans1_text`, `ans2_text`, `ans3_text`, `ans4_text`, `ans5_text`, `ans6_text`, `correct_answer`) VALUES
(1, 1, 'Question 1', 0, 'A', 'B', 'C', 'D', 'E', 'F', 1),
(2, 1, 'Question 2', 0, 'G', 'H', 'I', 'J', 'K', 'L', 2),
(3, 2, 'Question 1', 0, 'A', 'B', 'C', 'D', 'E', 'F', 2),
(4, 2, 'Question 2', 0, 'G', 'H', 'I', 'J', 'K', 'L', 1),
(5, 2, 'Question 3', 0, 'M', 'N', 'O', 'P', 'Q', 'R', 1),
(6, 2, 'Question 4', 0, 'S', 'T', 'U', 'V', 'W', 'X', 5),
(7, 3, 'What is your favorite thing about chemistry?', 0, 'The smell', 'Cancer risk', 'Bonds', 'Atoms', 'The popular IDE', 'spongebob', 6),
(8, 4, 'Eugen Goldtein discovered in 1886 that atoms also have...', 0, 'A negative charge', 'No charge', 'A positive charge', 'Movement', 'Temperature', 'Gold', 1);

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
(9, 2, 'EvenNewerBoy', '013bc84affed0fd19721ff66c561db7f63c2d6aa'),
(10, 2, 'Aticiland', '013bc84affed0fd19721ff66c561db7f63c2d6aa'),
(11, 3, 'StudentAustin', '013bc84affed0fd19721ff66c561db7f63c2d6aa'),
(12, 3, 'StudentStephen', '013bc84affed0fd19721ff66c561db7f63c2d6aa'),
(13, 2, 'DrOliver', '5e52fee47e6b070565f74372468cdc699de89107'),
(14, 3, 'JeffBrown', '5e52fee47e6b070565f74372468cdc699de89107');

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
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
