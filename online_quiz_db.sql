-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 07:01 AM
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
-- Database: `online_quiz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `test_questionnaire`
--

CREATE TABLE `test_questionnaire` (
  `id` int(5) NOT NULL,
  `question_no` text NOT NULL,
  `question` text NOT NULL,
  `opt1` text NOT NULL,
  `opt2` text NOT NULL,
  `opt3` text NOT NULL,
  `opt4` text NOT NULL,
  `answer` text NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_questionnaire`
--

INSERT INTO `test_questionnaire` (`id`, `question_no`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `answer`, `category`) VALUES
(32, '1', 'Define the term \"hypothesis\" and explain its role in scientific research.', 'A tentative explanation; guides the experiment', 'Final conclusion; summarizes results', 'Random guess; has no impact', 'Opinion; varies between scientists', 'A tentative explanation; guides the experiment', 'Verbal Ability'),
(33, '2', 'Discuss the importance of clear and concise communication in conveying experimental procedures', 'Clarity helps no one', 'Conciseness aids understanding', 'Complexity is crucial', 'Ambiguity fosters collaboration', 'Conciseness aids understanding', 'Verbal Ability'),
(34, '3', 'Interpret the meaning of the term \"correlation\" in a scientific context.', 'Random connection', 'Strong relationship', 'No significance', 'Overcomplication', 'Strong relationship', 'Verbal Ability'),
(35, '4', 'Describe the elements of a well-structured scientific report.', 'Chaotic organization', 'Clear structure and key components', 'Random information placement', 'No need for structure', 'Clear structure and key components', 'Verbal Ability'),
(36, '5', 'Analyze and critique a scientific article\'s argumentation and evidence.', 'Blind acceptance is key', 'Evaluate the logical flow and evidence', 'Critique is unnecessary', 'Opinions don\'t matter', 'Evaluate the logical flow and evidence', 'Verbal Ability'),
(37, '1', 'If a scientist conducts an experiment five times and records the following results: 15, 18, 20, 17, and 19, what is the average of these values?', '16.5', '18.2', '19.5', '20.3', '19.5', 'Numerical Ability'),
(40, '2', 'If an experiment involves measuring the growth of plants over time, how could you represent this data numerically?', 'Calculate the color intensity', 'Use statistical measures like mean height', 'Measure plant weight only', 'Ignore numerical representation', 'Use statistical measures like mean height', 'Numerical Ability'),
(41, '3', 'Given a set of data points representing the temperature of a chemical reaction at different time intervals, calculate the rate of change.', 'Evaluate slope between points', 'Choose random values', 'Average all temperatures', 'Use only initial temperature', 'Evaluate slope between points', 'Numerical Ability'),
(43, '4', 'If a research paper includes statistical data, explain how this enhances the credibility of the findings.', 'Statistics are irrelevant', 'Adds complexity without value', 'Demonstrates the robustness of findings', 'Data should be avoided', 'Demonstrates the robustness of findings', 'Numerical Ability'),
(44, '5', 'Evaluate the significance of outliers in experimental data.', 'Outliers are irrelevant', 'They should be emphasized', 'They may indicate errors or important phenomena', 'Ignore outliers completely', 'They may indicate errors or important phenomena', 'Numerical Ability'),
(45, '1', 'How might a scientist use statistical analysis, such as calculating averages, to interpret experimental results?', 'To confuse readers', 'To manipulate data', 'To identify patterns and trends', 'To avoid presenting results', 'To identify patterns and trends', 'Science Test'),
(46, '2', 'Explain the role of control variables in ensuring the validity of experimental results.', 'To introduce chaos', 'To keep everything the same', 'To confuse participants', 'To test only one variable', 'To keep everything the same', 'Science Test'),
(47, '3', 'How does understanding mathematical relationships, such as rates of change, contribute to the interpretation of experimental data?', 'It adds unnecessary complexity', 'It helps identify patterns and trends', 'It confuses researchers', 'Math has no role in science', 'It helps identify patterns and trends', 'Science Test'),
(48, '4', 'Discuss the importance of effective communication in disseminating scientific knowledge and discoveries.', 'It hinders progress', 'Facilitates collaboration and understanding', 'Communication is unnecessary', 'Scientists should keep knowledge to themselves', 'Facilitates collaboration and understanding', 'Science Test'),
(49, '5', 'How can a combination of verbal reasoning and numerical analysis strengthen the overall scientific inquiry process?', 'Verbal reasoning is enough', 'Numerical analysis adds complexity', 'Both contribute to a comprehensive understanding', 'Separate them for clarity', 'Both contribute to a comprehensive understanding', 'Science Test');

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `test_id` bigint(150) NOT NULL,
  `user_email` text NOT NULL,
  `user_name` text NOT NULL,
  `user_score` int(50) NOT NULL,
  `test_category` text NOT NULL,
  `taken_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_results`
--

INSERT INTO `test_results` (`test_id`, `user_email`, `user_name`, `user_score`, `test_category`, `taken_at`) VALUES
(20532631, 'rd@uvca.edu.ph', 'Ron Danielle Orlain', 4, 'Numerical Ability', '2023-12-01 11:19:06'),
(48295841, 'rd@uvca.edu.ph', 'Ron Danielle Orlain', 5, 'Verbal Ability', '2023-12-01 10:32:11'),
(99841991, 'rd@uvca.edu.ph', 'Ron Danielle Orlain', 2, 'Science Test', '2023-12-01 11:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `users_accounts`
--

CREATE TABLE `users_accounts` (
  `user_id` bigint(150) NOT NULL,
  `user_email` text NOT NULL,
  `user_name` text NOT NULL,
  `user_password` text NOT NULL,
  `user_status` text NOT NULL,
  `user_type` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_accounts`
--

INSERT INTO `users_accounts` (`user_id`, `user_email`, `user_name`, `user_password`, `user_status`, `user_type`, `created_at`) VALUES
(12145311, 'admin@admin.com', 'admin', 'dGVzdDEyMy4=', 'Offline', 'admin', '2023-10-31 09:27:55'),
(18305192, 'qwe@gmail.com', 'qqwe oiqwe', 'dGVzdDEyMy4=', 'Offline', 'student', '2023-11-26 08:51:37'),
(18552366, 'rd@uvca.edu.ph', 'Ron Danielle Orlain', 'dGVzdDEyMy4=', 'Offline', 'student', '2023-11-04 03:35:54'),
(20100340, 'jeric@uvca.edu.ph', 'Jeric Buenaventura', 'dGVzdDEyMy4=', 'Offline', 'student', '2023-10-30 17:33:19'),
(55826652, 'miko@uvca.edu.ph', 'Victor Michael Royandoyan', 'dGVzdDEyMy4=', 'Online', 'student', '2023-11-04 03:36:10'),
(91395180, 'sean@uvca.edu.ph', 'Sean Patrick Orlain', 'dGVzdDEyMy4=', 'Online', 'student', '2023-11-04 03:43:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `test_questionnaire`
--
ALTER TABLE `test_questionnaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `users_accounts`
--
ALTER TABLE `users_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `test_questionnaire`
--
ALTER TABLE `test_questionnaire`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
