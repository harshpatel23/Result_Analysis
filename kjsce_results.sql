-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2019 at 05:18 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kjsce_results`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `credit_points` int(11) NOT NULL,
  `semester_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `credit_points`, `semester_no`) VALUES
('', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_total_marks`
--

CREATE TABLE `course_total_marks` (
  `course_id` text NOT NULL,
  `ese_passing_marks` int(11) NOT NULL,
  `ese_outof_marks` int(11) NOT NULL,
  `ca_passing_marks` int(11) NOT NULL,
  `ca_outof_marks` int(11) NOT NULL,
  `tw_passing_marks` int(11) DEFAULT NULL,
  `tw_outof_marks` int(11) DEFAULT NULL,
  `oral_passing_marks` int(11) DEFAULT NULL,
  `oral_outof_marks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marks_mapping`
--

CREATE TABLE `marks_mapping` (
  `lower_limit` int(11) NOT NULL,
  `upper_limit` int(11) NOT NULL,
  `letter_grades` varchar(2) NOT NULL,
  `grade_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks_mapping`
--

INSERT INTO `marks_mapping` (`lower_limit`, `upper_limit`, `letter_grades`, `grade_point`) VALUES
(95, 100, 'AP', 10),
(85, 95, 'AA', 10),
(75, 85, 'AB', 9),
(70, 75, 'BB', 8),
(60, 70, 'BC', 7),
(50, 60, 'CC', 6),
(45, 50, 'CD', 5),
(40, 45, 'CD', 4),
(0, 40, 'FF', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_cgpa`
--

CREATE TABLE `student_cgpa` (
  `seat_no` text NOT NULL,
  `credit_points` int(11) NOT NULL,
  `total_semester_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_practical_marks`
--

CREATE TABLE `student_practical_marks` (
  `seat_no` text NOT NULL,
  `course_id` text NOT NULL,
  `tw_marks` int(11) DEFAULT NULL,
  `oral_marks` int(11) DEFAULT NULL,
  `total_practical_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_theory_marks`
--

CREATE TABLE `student_theory_marks` (
  `seat_no` text NOT NULL,
  `course_id` text NOT NULL,
  `ese_marks` int(11) NOT NULL,
  `ca_marks` int(11) NOT NULL,
  `total_theory_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_to_courses`
--

CREATE TABLE `teacher_to_courses` (
  `teacher_id` varchar(15) NOT NULL,
  `course_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
