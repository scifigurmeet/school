-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2019 at 04:38 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `ID` int(11) NOT NULL,
  `admission_no` text NOT NULL,
  `description` text NOT NULL,
  `admission_date` text NOT NULL,
  `admission_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ID`, `date`, `student_id`, `section_id`, `status`) VALUES
(1, '2019-06-11', 7, 1, 'PRESENT'),
(2, '2019-06-11', 4, 1, 'PRESENT'),
(3, '2019-06-11', 2, 1, 'PRESENT'),
(4, '2019-06-11', 1, 1, 'ABSENT'),
(5, '2019-06-11', 5, 1, 'ABSENT'),
(6, '2019-06-11', 6, 1, 'ABSENT'),
(7, '2019-06-11', 8, 1, 'ABSENT'),
(8, '2019-06-11', 9, 1, 'ABSENT'),
(9, '2019-06-11', 10, 1, 'ABSENT'),
(28, '2019-06-30', 7, 1, 'PRESENT'),
(29, '2019-06-30', 5, 1, 'PRESENT'),
(30, '2019-06-30', 4, 1, 'PRESENT'),
(31, '2019-06-30', 8, 1, 'PRESENT'),
(32, '2019-06-30', 9, 1, 'PRESENT'),
(33, '2019-06-30', 10, 1, 'PRESENT'),
(34, '2019-06-30', 2, 1, 'PRESENT'),
(35, '2019-06-30', 6, 1, 'PRESENT'),
(36, '2019-06-30', 1, 1, 'PRESENT');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ID` int(11) NOT NULL,
  `book_categories` text NOT NULL,
  `book_name` text NOT NULL,
  `book_authors` text NOT NULL,
  `book_isbn` text NOT NULL,
  `book_publisher` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ID`, `book_categories`, `book_name`, `book_authors`, `book_isbn`, `book_publisher`, `quantity`, `description`, `comments`) VALUES
(5, '2', 'Kenyon Baird', 'Yael Montgomery', 'Price Dunlap', 'Venus Mcintosh', 5, 'Est dolore repellend', 'Voluptate et error q'),
(6, '2', 'Carly Vang', 'Lenore Vance', 'Destiny Evans', 'Kristen Bryan', 3, 'Consequatur autem hi', 'Sit est voluptatib'),
(7, '2', 'Dieter Simmons', 'Colorado Oneill', 'Kiara Gregory', 'Clare Koch', 3, 'Rerum quis ex pariat', 'Blanditiis quis quia'),
(9, '2', 'Allen Wade', 'Rina Webster', 'Omar Morgan', 'Graiden Navarro', 831, 'Ad aut sint reprehe', 'Corrupti omnis exce'),
(10, '21,22', 'Tashya Ray', 'Eaton Gallagher', 'Yoko Navarro', 'Megan Bishop', 371, 'Molestiae aut commod', 'Totam quam dolorem v');

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `ID` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `description` text,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`ID`, `category_name`, `description`, `comments`) VALUES
(1, 'English', 'All books in English Language.', 'No Comments.'),
(2, 'Hindi', 'All books in Hindi Language.', 'No Comments.'),
(21, 'Punjabi', 'All Books in Punjabi Language.', 'No Comments.'),
(22, 'Science', 'All Books of Science Subject', 'No Comments.');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `ID` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` longtext NOT NULL,
  `status` text NOT NULL,
  `send_to` text,
  `students_ids` text,
  `section_ids` text,
  `standard_ids` text,
  `employee_ids` text,
  `user_ID` int(11) NOT NULL,
  `signatures` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`ID`, `dateTime`, `content`, `status`, `send_to`, `students_ids`, `section_ids`, `standard_ids`, `employee_ids`, `user_ID`, `signatures`) VALUES
(63, '2019-06-02 07:09:32', 'sss', 'Sent', 'employees', NULL, NULL, NULL, '2,4', 2, ''),
(64, '2019-06-02 07:09:47', 'ss', 'Sent', 'employees', NULL, NULL, NULL, '2,4', 2, ''),
(66, '2019-06-02 08:08:30', 'First Message Test', 'Sent', 'students', NULL, '1', NULL, NULL, 2, ''),
(68, '2019-06-02 08:22:31', 'ff', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, ''),
(69, '2019-06-02 08:24:20', 'hola', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 10, ''),
(70, '2019-06-02 08:40:18', '77', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(71, '2019-06-14 12:13:27', 'Hello, how are you beta?', 'Sent', 'students', '1', NULL, NULL, NULL, 2, NULL),
(72, '2019-06-14 12:14:34', '<img src=\"http://localhost/school/images/icon/logo.png\" alt=\"\"><p>Hello didi?</p>', 'Sent', 'students', '1', NULL, NULL, NULL, 2, 'ADMIN 1'),
(75, '2019-06-22 06:01:36', 'Hello, 22 33 44 55', 'Sent', 'all', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(76, '2019-06-22 06:05:37', 'ggg6677', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(77, '2019-06-22 06:07:07', 'Hello', 'Sent', 'all', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(78, '2019-06-22 06:07:55', 'Hello', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(79, '2019-06-22 06:10:53', '<p>Hello Notice</p><img src=\"http://localhost/school/images/icon/logo.png\" alt=\"\">', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(80, '2019-06-22 09:01:38', 'Test Message', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(81, '2019-06-22 09:18:24', '\'\'', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(82, '2019-06-22 09:18:56', '\'G\'', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(83, '2019-06-30 08:32:51', 'Hello, employees.', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(84, '2019-06-30 08:41:30', 'Hello OLA', 'Sent', 'allEmployees', NULL, NULL, NULL, NULL, 2, 'ADMIN 1'),
(85, '2019-06-30 10:08:13', 'U', 'Sent', 'all', NULL, NULL, NULL, NULL, 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `mobile_no` text NOT NULL,
  `type` text NOT NULL,
  `dob` date NOT NULL,
  `email` text NOT NULL,
  `description` text,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID`, `first_name`, `last_name`, `mobile_no`, `type`, `dob`, `email`, `description`, `comments`) VALUES
(1, 'Amandeep', 'Singh', '1234567890', '1', '2001-04-05', 'amandeepsingh@ourschool.com', 'Hindi Teacher', NULL),
(2, 'Parminder', 'Kaur', '1234567890', '1', '2001-04-05', 'parminderkaur@ourschool.com', 'Hindi Teacher', NULL),
(3, 'Manmeet', 'Singh', '7894561230', '1', '2010-08-26', 'manmeetsingh@ourschool.com', 'Punjabi Teacher', NULL),
(4, 'Simrandeep', 'Kaur', '8975461245', '2', '2009-05-14', 'simrandeepkaur@ourschool.com', 'School Principal and Mathematics Teacher', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees_types`
--

CREATE TABLE `employees_types` (
  `ID` int(11) NOT NULL,
  `type_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees_types`
--

INSERT INTO `employees_types` (`ID`, `type_name`) VALUES
(1, 'Teacher'),
(2, 'Principal'),
(3, 'Management'),
(17, 'Clerk'),
(18, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `ID` int(11) NOT NULL,
  `full_name` text NOT NULL,
  `short_name` text NOT NULL,
  `standards_involved` text NOT NULL,
  `result_status` text,
  `publish_date` datetime DEFAULT NULL,
  `description` text,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`ID`, `full_name`, `short_name`, `standards_involved`, `result_status`, `publish_date`, `description`, `comments`) VALUES
(4, 'First Term Exams', '1st TE', '2,3', 'PUBLISHED', '0000-00-00 00:00:00', NULL, NULL),
(5, 'Reappear Exams', 'RE - 1', '2,3', 'PUBLISHED', NULL, NULL, NULL),
(6, 'Rahim Conley', 'Carolyn Talley', '15,4,13', NULL, NULL, 'Velit excepteur lib', 'Nulla facilis illo d');

-- --------------------------------------------------------

--
-- Table structure for table `fee_amounts`
--

CREATE TABLE `fee_amounts` (
  `ID` int(11) NOT NULL,
  `fee_type_ID` int(11) NOT NULL,
  `fee_method` int(11) NOT NULL,
  `fee_max_amount` int(11) NOT NULL,
  `packed_structure` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_amounts`
--

INSERT INTO `fee_amounts` (`ID`, `fee_type_ID`, `fee_method`, `fee_max_amount`, `packed_structure`) VALUES
(1, 14, 2, 680, 'a:2:{s:10:\"Tution Fee\";s:3:\"650\";s:12:\"Computer Fee\";s:2:\"30\";}'),
(2, 15, 1, 500, 'N;'),
(3, 13, 1, 450, 'N;'),
(4, 16, 1, 365, 'N;'),
(11, 17, 2, 680, 'a:2:{s:10:\"Tution Fee\";s:3:\"650\";s:12:\"Computer Fee\";s:2:\"30\";}'),
(14, 18, 1, 500, 'N;'),
(15, 19, 2, 850, 'a:4:{s:10:\"Tution Fee\";s:3:\"600\";s:12:\"Computer Fee\";s:2:\"50\";s:11:\"Library Fee\";s:3:\"100\";s:15:\"Smart Class Fee\";s:3:\"100\";}'),
(26, 25, 1, 500, 'N;'),
(28, 26, 2, 650, 'a:3:{s:10:\"Tution Fee\";s:3:\"500\";s:12:\"Computer Fee\";s:2:\"50\";s:15:\"Smart Class Fee\";s:3:\"100\";}');

-- --------------------------------------------------------

--
-- Table structure for table `fee_structures`
--

CREATE TABLE `fee_structures` (
  `ID` int(11) NOT NULL,
  `standard_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `fee_entity_id` int(11) NOT NULL,
  `fee_total_amount` int(11) NOT NULL,
  `fee_structure` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_structures`
--

INSERT INTO `fee_structures` (`ID`, `standard_id`, `section_id`, `fee_entity_id`, `fee_total_amount`, `fee_structure`) VALUES
(1, NULL, 2, 1, 670, 'a:2:{i:1;s:3:\"640\";i:2;s:2:\"30\";}'),
(2, NULL, 3, 1, 680, 'a:2:{i:1;s:3:\"650\";i:2;s:2:\"30\";}'),
(3, NULL, 1, 1, 650, 'a:2:{i:1;s:3:\"620\";i:2;s:2:\"30\";}'),
(4, NULL, 4, 1, 640, 'a:2:{i:1;s:3:\"610\";i:2;s:2:\"30\";}'),
(5, 1, NULL, 2, 300, '0'),
(6, 2, NULL, 2, 400, '0'),
(11, 1, NULL, 4, 310, '0'),
(12, 2, NULL, 4, 315, '0'),
(27, 1, NULL, 11, 480, 'a:2:{i:1;s:3:\"450\";i:2;s:2:\"30\";}'),
(28, 2, NULL, 11, 500, 'a:2:{i:1;s:3:\"470\";i:2;s:2:\"30\";}'),
(33, 1, NULL, 14, 470, '0'),
(34, 2, NULL, 14, 480, '0'),
(35, 10, NULL, 15, 720, 'a:4:{i:1;s:3:\"580\";i:2;s:2:\"40\";i:3;s:2:\"50\";i:4;s:2:\"50\";}'),
(36, 1, NULL, 15, 640, 'a:4:{i:1;s:3:\"500\";i:2;s:2:\"40\";i:3;s:2:\"50\";i:4;s:2:\"50\";}'),
(37, 4, NULL, 15, 700, 'a:4:{i:1;s:3:\"560\";i:2;s:2:\"40\";i:3;s:2:\"50\";i:4;s:2:\"50\";}'),
(38, 2, NULL, 15, 660, 'a:4:{i:1;s:3:\"520\";i:2;s:2:\"40\";i:3;s:2:\"50\";i:4;s:2:\"50\";}'),
(39, 3, NULL, 15, 680, 'a:4:{i:1;s:3:\"540\";i:2;s:2:\"40\";i:3;s:2:\"50\";i:4;s:2:\"50\";}'),
(44, 1, NULL, 25, 4, 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"3\";}'),
(45, 2, NULL, 25, 7, 'a:2:{i:1;s:1:\"3\";i:2;s:1:\"4\";}'),
(59, 10, NULL, 26, 30, '0'),
(60, 15, NULL, 26, 40, '0'),
(61, 2, NULL, 26, 50, '0'),
(62, 1, NULL, 28, 630, 'a:3:{i:1;s:3:\"500\";i:2;s:2:\"30\";i:3;s:3:\"100\";}'),
(63, 2, NULL, 28, 650, 'a:3:{i:1;s:3:\"520\";i:2;s:2:\"30\";i:3;s:3:\"100\";}');

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `ID` int(11) NOT NULL,
  `fee_full_name` text NOT NULL,
  `fee_for` text NOT NULL,
  `fee_description` text NOT NULL,
  `fee_wise` text NOT NULL,
  `fee_sections` text,
  `fee_standards` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`ID`, `fee_full_name`, `fee_for`, `fee_description`, `fee_wise`, `fee_sections`, `fee_standards`) VALUES
(14, 'September 2018', '1 September 2018 To 30 September 2018', 'Monthly Fee', 'sections', '1,2,3,4', NULL),
(16, 'August 2018', '1 August 2018 To 31 August 2018', 'Monthly Fee', 'standards', NULL, '1,2'),
(17, 'October 2018', '1 October 2018 To 31 October 2018', 'Monthly Fee', 'standards', NULL, '1,2'),
(18, 'November 2018', '1 November 2018 To 30 November 2018', 'Monthly Fee', 'standards', NULL, '1,2'),
(19, 'January 2019', '1 January 2019 To 31 January 2019', 'Monthly Fee', 'standards', NULL, '1,10,2,3,4'),
(21, 'Latifah Dodson', 'Libero maxime impedi', 'Aut do praesentium s', 'standards', NULL, '15,3'),
(25, 'Sheila Olsen', 'Blanditiis incidunt', 'Enim excepteur rerum', 'standards', NULL, '10,2,15'),
(26, 'June 2019', '1 June 2019 To 31 June 2019', 'Monthly Fee', 'standards', NULL, '1,2'),
(27, 'Rina Vang', 'Fugiat et aperiam nu', 'Quia veniam dolorem', 'standards', NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `global_options`
--

CREATE TABLE `global_options` (
  `ID` int(11) NOT NULL,
  `option_name` varchar(100) NOT NULL,
  `option_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `global_options`
--

INSERT INTO `global_options` (`ID`, `option_name`, `option_value`) VALUES
(1, 'school_full_name', 'New S.M.D. Senior Secondary School'),
(2, 'school_short_name', 'New SMD School'),
(3, 'school_address', 'Street No. 8, New Shivaji Nagar, Near Hargobind Nagar Marg'),
(4, 'town_city', 'Ludhiana'),
(5, 'district', 'Ludhiana'),
(6, 'state', 'Punjab'),
(7, 'pincode', '141008');

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `ID` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `issue_date` datetime NOT NULL,
  `status` text NOT NULL,
  `return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`ID`, `book_id`, `student_id`, `issue_date`, `status`, `return_date`) VALUES
(1, 5, 1, '2019-06-16 09:53:22', 'RETURNED', '2019-06-16 10:30:46'),
(2, 5, 1, '2019-06-16 10:19:46', 'RETURNED', '2019-06-16 10:30:44'),
(3, 5, 1, '2019-06-16 10:35:21', 'RETURNED', '2019-06-16 10:35:56'),
(4, 5, 2, '2019-06-16 10:37:43', 'RETURNED', '2019-06-16 10:37:59'),
(5, 5, 1, '2019-06-16 10:40:05', 'RETURNED', '2019-06-16 10:40:24'),
(6, 5, 1, '2019-06-16 10:42:26', 'RETURNED', '2019-06-16 10:52:48'),
(7, 5, 2, '2019-06-16 10:42:37', 'RETURNED', '2019-06-17 04:27:16'),
(8, 5, 3, '2019-06-16 10:42:41', 'ISSUED', NULL),
(9, 5, 4, '2019-06-16 10:42:48', 'RETURNED', '2019-06-17 04:27:23'),
(10, 5, 5, '2019-06-16 10:42:53', 'RETURNED', '2019-06-16 10:45:58'),
(11, 5, 17, '2019-06-16 10:46:02', 'RETURNED', '2019-06-16 10:46:32'),
(12, 6, 1, '2019-06-16 10:51:10', 'RETURNED', '2019-06-16 10:53:07'),
(13, 5, 1, '2019-06-16 10:53:00', 'RETURNED', '2019-06-22 05:40:42'),
(14, 5, 1, '2019-06-30 09:12:17', 'RETURNED', '2019-06-30 09:12:24'),
(15, 7, 1, '2019-06-30 09:12:29', 'RETURNED', '2019-06-30 09:13:00'),
(16, 7, 1, '2019-06-30 09:13:44', 'ISSUED', NULL),
(17, 7, 2, '2019-06-30 09:13:59', 'ISSUED', NULL),
(18, 7, 3, '2019-06-30 09:14:05', 'ISSUED', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `student_id` int(11) NOT NULL,
  `evaluation_entity_ID` int(11) NOT NULL,
  `obtained_marks` int(11) NOT NULL,
  `marks_group` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`student_id`, `evaluation_entity_ID`, `obtained_marks`, `marks_group`) VALUES
(1, 1, 85, '0'),
(1, 4, 20, 'a:20:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"1\";i:12;s:1:\"1\";i:13;s:1:\"1\";i:14;s:1:\"1\";i:15;s:1:\"1\";i:16;s:1:\"1\";i:17;s:1:\"1\";i:18;s:1:\"1\";i:19;s:1:\"1\";i:20;s:1:\"1\";}'),
(1, 7, 6, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(1, 8, 5, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(2, 1, 68, '0'),
(2, 4, 20, 'a:20:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"1\";i:12;s:1:\"1\";i:13;s:1:\"1\";i:14;s:1:\"1\";i:15;s:1:\"1\";i:16;s:1:\"1\";i:17;s:1:\"1\";i:18;s:1:\"1\";i:19;s:1:\"1\";i:20;s:1:\"1\";}'),
(2, 7, 5, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(2, 8, 25, 'a:5:{i:1;s:2:\"11\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:2:\"11\";}'),
(3, 1, 88, '0'),
(3, 4, 20, 'a:20:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"1\";i:12;s:1:\"1\";i:13;s:1:\"1\";i:14;s:1:\"1\";i:15;s:1:\"1\";i:16;s:1:\"1\";i:17;s:1:\"1\";i:18;s:1:\"1\";i:19;s:1:\"1\";i:20;s:1:\"1\";}'),
(4, 1, 82, '0'),
(4, 4, 20, 'a:20:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"1\";i:12;s:1:\"1\";i:13;s:1:\"1\";i:14;s:1:\"1\";i:15;s:1:\"1\";i:16;s:1:\"1\";i:17;s:1:\"1\";i:18;s:1:\"1\";i:19;s:1:\"1\";i:20;s:1:\"1\";}'),
(4, 7, 5, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(4, 8, 15, 'a:5:{i:1;s:1:\"1\";i:2;s:2:\"11\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(5, 1, 70, '0'),
(5, 4, 20, 'a:20:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"1\";i:12;s:1:\"1\";i:13;s:1:\"1\";i:14;s:1:\"1\";i:15;s:1:\"1\";i:16;s:1:\"1\";i:17;s:1:\"1\";i:18;s:1:\"1\";i:19;s:1:\"1\";i:20;s:1:\"1\";}'),
(5, 7, 5, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(5, 8, 5, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(6, 1, 63, '0'),
(6, 4, 86, 'a:20:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"3\";i:7;s:1:\"3\";i:8;s:1:\"3\";i:9;s:1:\"3\";i:10;s:2:\"33\";i:11;s:1:\"3\";i:12;s:1:\"3\";i:13;s:1:\"3\";i:14;s:1:\"3\";i:15;s:1:\"3\";i:16;s:1:\"3\";i:17;s:1:\"3\";i:18;s:1:\"3\";i:19;s:1:\"3\";i:20;s:1:\"3\";}'),
(6, 7, 5, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(6, 8, 10, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"6\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(7, 1, 70, '0'),
(7, 4, 57, 'a:20:{i:1;s:1:\"3\";i:2;s:1:\"3\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"3\";i:7;s:1:\"3\";i:8;N;i:9;s:1:\"3\";i:10;s:1:\"3\";i:11;s:1:\"3\";i:12;s:1:\"3\";i:13;s:1:\"3\";i:14;s:1:\"3\";i:15;s:1:\"3\";i:16;s:1:\"3\";i:17;s:1:\"3\";i:18;s:1:\"3\";i:19;s:1:\"3\";i:20;s:1:\"3\";}'),
(7, 7, 6, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:3:\"1.5\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(7, 8, 14, 'a:5:{i:1;s:1:\"0\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:2:\"11\";i:5;s:1:\"1\";}'),
(8, 1, 55, '0'),
(8, 4, 18, 'a:20:{i:1;s:1:\"3\";i:2;s:1:\"3\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"3\";i:7;N;i:8;N;i:9;N;i:10;N;i:11;N;i:12;N;i:13;N;i:14;N;i:15;N;i:16;N;i:17;N;i:18;N;i:19;N;i:20;N;}'),
(8, 7, 5, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(8, 8, 15, 'a:5:{i:1;s:2:\"11\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(9, 1, 92, '0'),
(9, 4, 0, 'a:20:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;i:10;N;i:11;N;i:12;N;i:13;N;i:14;N;i:15;N;i:16;N;i:17;N;i:18;N;i:19;N;i:20;N;}'),
(9, 7, 5, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(9, 8, 15, 'a:5:{i:1;s:1:\"1\";i:2;s:2:\"11\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(10, 1, 72, '0'),
(10, 4, 0, 'a:20:{i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;i:7;N;i:8;N;i:9;N;i:10;N;i:11;N;i:12;N;i:13;N;i:14;N;i:15;N;i:16;N;i:17;N;i:18;N;i:19;N;i:20;N;}'),
(10, 7, 5, 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}'),
(10, 8, 15, 'a:5:{i:1;s:1:\"1\";i:2;s:2:\"11\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}');

-- --------------------------------------------------------

--
-- Table structure for table `paid_fees`
--

CREATE TABLE `paid_fees` (
  `ID` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee_entity_id` int(11) NOT NULL,
  `fee_amount` int(11) NOT NULL,
  `payment_date` datetime NOT NULL,
  `fee_status` text NOT NULL,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paid_fees`
--

INSERT INTO `paid_fees` (`ID`, `student_id`, `fee_entity_id`, `fee_amount`, `payment_date`, `fee_status`, `comments`) VALUES
(2, 1, 1, 650, '2019-06-08 10:04:09', 'PAID', NULL),
(3, 1, 4, 310, '2019-06-08 10:04:18', 'PAID', NULL),
(4, 2, 1, 650, '2019-06-08 10:07:13', 'PAID', NULL),
(5, 11, 1, 680, '2019-06-08 10:09:14', 'PAID', NULL),
(6, 1, 11, 480, '2019-06-08 10:36:29', 'PAID', NULL),
(7, 1, 15, 640, '2019-06-09 09:26:45', 'PAID', NULL),
(8, 4, 15, 640, '2019-06-09 09:28:56', 'PAID', NULL),
(9, 6, 4, 310, '2019-06-10 10:22:14', 'PAID', NULL),
(10, 6, 15, 640, '2019-06-10 10:25:23', 'PAID', NULL),
(13, 6, 14, 470, '2019-06-10 10:35:17', 'PAID', NULL),
(14, 4, 4, 310, '2019-06-10 10:35:33', 'PAID', NULL),
(15, 4, 14, 470, '2019-06-10 10:35:53', 'PAID', NULL),
(16, 4, 11, 480, '2019-06-10 10:40:22', 'PAID', NULL),
(17, 1, 28, 630, '2019-06-11 06:14:03', 'PAID', NULL),
(18, 1, 14, 470, '2019-06-16 12:04:28', 'PAID', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `read_messages`
--

CREATE TABLE `read_messages` (
  `user_ID` int(11) NOT NULL,
  `message_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `read_messages`
--

INSERT INTO `read_messages` (`user_ID`, `message_ID`) VALUES
(2, 63),
(2, 69),
(2, 72),
(2, 85),
(9, 72);

-- --------------------------------------------------------

--
-- Table structure for table `registered_evaluations`
--

CREATE TABLE `registered_evaluations` (
  `ID` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `evaluation_method` int(11) NOT NULL,
  `maximum_marks` int(11) NOT NULL,
  `packedMarks` longtext NOT NULL,
  `description` text,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_evaluations`
--

INSERT INTO `registered_evaluations` (`ID`, `evaluation_id`, `standard_id`, `subject_id`, `evaluation_method`, `maximum_marks`, `packedMarks`, `description`, `comments`) VALUES
(7, 4, 1, 5, 2, 21, 'a:5:{i:1;s:1:\"2\";i:2;s:1:\"4\";i:3;s:1:\"5\";i:4;s:1:\"5\";i:5;s:1:\"5\";}', NULL, NULL),
(8, 4, 1, 9, 2, 15, 'a:5:{s:1:\"A\";s:1:\"1\";s:1:\"B\";s:1:\"2\";s:1:\"C\";s:1:\"3\";s:1:\"D\";s:1:\"4\";s:1:\"E\";s:1:\"5\";}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
  `ID` int(11) NOT NULL,
  `VIEW_attendance_sections` text,
  `VIEW_marksheet_entities` text,
  `VIEW_sections` text,
  `VIEW_standards` text,
  `VIEW_students` text,
  `VIEW_employees` text,
  `VIEW_employeesTypes` text,
  `VIEW_evaluations` text,
  `VIEW_evaluationEntities` text,
  `VIEW_subjects` text,
  `VIEW_subjectTypes` text,
  `VIEW_admissions` text,
  `EDIT_attendance_sections` text,
  `EDIT_marksheet_entities` text,
  `EDIT_sections` text,
  `EDIT_standards` text,
  `EDIT_students` text,
  `EDIT_employees` text,
  `EDIT_employeesTypes` text,
  `EDIT_evaluations` text,
  `EDIT_evaluationEntities` text,
  `EDIT_subjects` text,
  `EDIT_subjectTypes` text,
  `EDIT_admissions` text,
  `DELETE_attendance_sections` text,
  `DELETE_marksheet_entities` text,
  `DELETE_sections` text,
  `DELETE_standards` text,
  `DELETE_students` text,
  `DELETE_employees` text,
  `DELETE_employeesTypes` text,
  `DELETE_evaluations` text,
  `DELETE_evaluationEntities` text,
  `DELETE_subjects` text,
  `DELETE_subjectTypes` text,
  `DELETE_admissions` text,
  `ADD_attendance_sections` text,
  `ADD_marksheet_entities` text,
  `ADD_sections` text,
  `ADD_standards` text,
  `ADD_students` text,
  `ADD_employees` text,
  `ADD_employeesTypes` text,
  `ADD_evaluations` text,
  `ADD_evaluationEntities` text,
  `ADD_subjects` text,
  `ADD_subjectTypes` text,
  `ADD_admissions` text,
  `VIEW_fee_types` text,
  `EDIT_fee_types` text,
  `DELETE_fee_types` text,
  `ADD_fee_types` text,
  `ADD_fee_entities` text,
  `EDIT_fee_entities` text,
  `VIEW_fee_entities` text,
  `DELETE_fee_entities` text,
  `ADD_fee_charges` text,
  `EDIT_fee_charges` text,
  `VIEW_fee_charges` text,
  `DELETE_fee_charges` text,
  `OTHER_fee_payment` text,
  `OTHER_roll_numbers_assignment` text,
  `VIEW_books` text,
  `EDIT_books` text,
  `ADD_books` text,
  `DELETE_books` text,
  `OTHER_issue_books` text NOT NULL,
  `OTHER_return_books` text NOT NULL,
  `OTHER_school_information` text,
  `OTHER_change_background` text,
  `ADD_book_categories` text,
  `EDIT_book_categories` text,
  `VIEW_book_categories` text,
  `DELETE_book_categories` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`ID`, `VIEW_attendance_sections`, `VIEW_marksheet_entities`, `VIEW_sections`, `VIEW_standards`, `VIEW_students`, `VIEW_employees`, `VIEW_employeesTypes`, `VIEW_evaluations`, `VIEW_evaluationEntities`, `VIEW_subjects`, `VIEW_subjectTypes`, `VIEW_admissions`, `EDIT_attendance_sections`, `EDIT_marksheet_entities`, `EDIT_sections`, `EDIT_standards`, `EDIT_students`, `EDIT_employees`, `EDIT_employeesTypes`, `EDIT_evaluations`, `EDIT_evaluationEntities`, `EDIT_subjects`, `EDIT_subjectTypes`, `EDIT_admissions`, `DELETE_attendance_sections`, `DELETE_marksheet_entities`, `DELETE_sections`, `DELETE_standards`, `DELETE_students`, `DELETE_employees`, `DELETE_employeesTypes`, `DELETE_evaluations`, `DELETE_evaluationEntities`, `DELETE_subjects`, `DELETE_subjectTypes`, `DELETE_admissions`, `ADD_attendance_sections`, `ADD_marksheet_entities`, `ADD_sections`, `ADD_standards`, `ADD_students`, `ADD_employees`, `ADD_employeesTypes`, `ADD_evaluations`, `ADD_evaluationEntities`, `ADD_subjects`, `ADD_subjectTypes`, `ADD_admissions`, `VIEW_fee_types`, `EDIT_fee_types`, `DELETE_fee_types`, `ADD_fee_types`, `ADD_fee_entities`, `EDIT_fee_entities`, `VIEW_fee_entities`, `DELETE_fee_entities`, `ADD_fee_charges`, `EDIT_fee_charges`, `VIEW_fee_charges`, `DELETE_fee_charges`, `OTHER_fee_payment`, `OTHER_roll_numbers_assignment`, `VIEW_books`, `EDIT_books`, `ADD_books`, `DELETE_books`, `OTHER_issue_books`, `OTHER_return_books`, `OTHER_school_information`, `OTHER_change_background`, `ADD_book_categories`, `EDIT_book_categories`, `VIEW_book_categories`, `DELETE_book_categories`) VALUES
(2, '1', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', '', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', '', '', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(3, '1,9', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'all', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'all', 'all', 'all', 'allowed', 'allowed', 'all', 'all', 'all', 'allowed', 'all', 'all', 'all', 'allowed', 'allowed', 'all', 'all', 'allowed', 'all', 'allowed', 'allowed', 'allowed', 'allowed', 'allowed', 'all', 'all', 'all');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `ID` int(11) NOT NULL,
  `room_name` text NOT NULL,
  `no_of_rows` int(11) NOT NULL,
  `no_of_seats_per_row` int(11) NOT NULL,
  `description` text,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`ID`, `room_name`, `no_of_rows`, `no_of_seats_per_row`, `description`, `comments`) VALUES
(3, 'G-101', 6, 5, NULL, NULL),
(4, 'G-102', 6, 5, NULL, NULL),
(5, 'G-103', 6, 7, NULL, NULL),
(6, 'G-104', 6, 10, NULL, NULL),
(7, 'G-105', 6, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `ID` int(11) NOT NULL,
  `standard_ID` int(11) NOT NULL,
  `section_full_name` text NOT NULL,
  `section_short_name` text NOT NULL,
  `section_code` text NOT NULL,
  `section_incharge_id` int(11) NOT NULL,
  `section_description` text,
  `section_comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`ID`, `standard_ID`, `section_full_name`, `section_short_name`, `section_code`, `section_incharge_id`, `section_description`, `section_comments`) VALUES
(1, 1, 'Red', 'A', '1A', 1, NULL, NULL),
(2, 1, 'Blue', 'B', '1B', 1, NULL, NULL),
(3, 2, 'Green', 'A', '2A', 2, NULL, NULL),
(4, 2, 'Yellow', 'B', '2B', 2, NULL, NULL),
(5, 3, 'Purple', 'A', '3A', 3, NULL, NULL),
(6, 3, 'Voilet', 'B', '3B', 3, NULL, NULL),
(7, 4, 'Magenta', 'A', '4A', 4, NULL, NULL),
(8, 1, 'White', 'B', '4B', 4, NULL, NULL),
(9, 10, 'Smart', '5th A', '5A', 1, NULL, NULL),
(20, 10, 'Dolan Alvarado', 'Ruth Gonzales', 'Zenaida Chase', 2, 'Officia pariatur Vo', 'Voluptatem enim dist'),
(21, 10, 'Dolan Alvarado', 'Ruth Gonzales', 'Zenaida Chase', 2, 'Officia pariatur Vo', 'Voluptatem enim dist'),
(25, 10, 'Dolan Alvarado', 'Ruth Gonzales', 'Zenaida Chase', 2, 'Officia pariatur Vo', 'Voluptatem enim dist'),
(26, 10, 'Dolan Alvarado', 'Ruth Gonzales', 'Zenaida Chase', 2, 'Officia pariatur Vo', 'Voluptatem enim dist'),
(27, 10, 'Dolan Alvarado', 'Ruth Gonzales', 'Zenaida Chase', 2, 'Officia pariatur Vo', 'Voluptatem enim dist'),
(35, 3, 'Clio Stuart', 'Cullen Tran', 'Summer Harvey', 3, 'Amet fugit magnam', 'Inventore natus cons'),
(41, 4, 'Ignatius Douglas', 'Hadassah Ross', 'Plato Wilkerson', 4, 'Similique vel quo po', 'Aliquam doloremque p'),
(43, 4, 'Ignatius Douglas', 'Hadassah Ross', 'Plato Wilkerson', 4, 'Similique vel quo po', 'Aliquam doloremque p'),
(44, 4, 'Ignatius Douglas', 'Hadassah Ross', 'Plato Wilkerson', 4, 'Similique vel quo po', 'Aliquam doloremque p'),
(45, 4, 'Ignatius Douglas', 'Hadassah Ross', 'Plato Wilkerson', 4, 'Similique vel quo po', 'Aliquam doloremque p'),
(46, 4, 'Ignatius Douglas', 'Hadassah Ross', 'Plato Wilkerson', 4, 'Similique vel quo po', 'Aliquam doloremque p'),
(48, 4, 'Ignatius Douglas', 'Hadassah Ross', 'Plato Wilkerson', 4, 'Similique vel quo po', 'Aliquam doloremque p'),
(49, 4, 'Ignatius Douglas', 'Hadassah Ross', 'Plato Wilkerson', 4, 'Similique vel quo po', 'Aliquam doloremque p'),
(50, 4, 'Ignatius Douglas', 'Hadassah Ross', 'Plato Wilkerson', 4, 'Similique vel quo po', 'Aliquam doloremque p'),
(51, 4, 'Ignatius Douglas', 'Hadassah Ross', 'Plato Wilkerson', 4, 'Similique vel quo po', 'Aliquam doloremque p'),
(52, 2, 'Aidan Bryant', 'Leah Elliott', 'Reed Kelly', 2, 'Est maxime lorem neq', 'Delectus quia disti'),
(53, 2, 'Aidan Bryant', 'Leah Elliott', 'Reed Kelly', 2, 'Est maxime lorem neq', 'Delectus quia disti'),
(61, 4, 'Chandler Mejia', 'Ainsley Henderson', 'Drew Sparks', 3, 'Aut fugiat reprehend', 'Sint aliquip ab labo'),
(62, 3, 'Wayne Gallegos', 'Brittany Walker', 'Dorian Boyd', 3, 'Quia omnis at repell', 'Quibusdam perferendi'),
(63, 2, 'Kitra Mcdaniel', 'Justine Goodman', 'Barrett Mendez', 3, 'Natus tempora est o', 'Odio dolor eligendi'),
(66, 10, 'Len Delaney', 'Leigh Weeks', 'Linus Valencia', 2, 'Molestias aut in ut', 'Recusandae Qui culp'),
(67, 10, 'Len Delaney', 'Leigh Weeks', 'Linus Valencia', 2, 'Molestias aut in ut', 'Recusandae Qui culp'),
(68, 10, 'Len Delaney', 'Leigh Weeks', 'Linus Valencia', 2, 'Molestias aut in ut', 'Recusandae Qui culp'),
(69, 3, 'Colby Christian', 'Alfonso Anderson', 'Finn Stevenson', 3, 'Qui nisi ab voluptat', 'Sunt quo maiores au'),
(70, 10, 'India Richard', 'Lionel Stein', 'Cleo Pruitt', 3, 'Doloremque fugiat do', 'Reprehenderit commod'),
(71, 3, 'Russell Ball', 'Sybil Gordon', 'Wanda Vaughan', 3, 'In consequat Invent', 'Fugiat obcaecati sit'),
(72, 2, 'Timothy Casey', 'Jasper Henson', 'Yvette Gaines', 3, 'Molestias ex proiden', 'Irure perspiciatis'),
(73, 2, 'Lilah Lynch', 'Grant Bush', 'Tiger Moore', 3, 'Soluta provident ve', 'Consequuntur quo sol'),
(74, 14, 'Hanae Wilder', 'Gannon Dillard', 'Faith Kelley', 2, 'Ut est aut voluptat', 'Pariatur Velit dict'),
(77, 10, 'Stella Tanner', 'Danielle Cervantes', 'Beau Espinoza', 3, 'Enim harum autem sun', 'Quidem aliquid aliqu'),
(78, 10, 'Baker Blackwell', 'Anastasia Becker', 'Kieran Webb', 4, 'Quas provident dele', 'Rerum facilis suscip'),
(79, 10, 'Hyacinth Pittman', 'Ashton Hurst', 'Gareth Obrien', 2, 'Eaque voluptas sint', 'Quibusdam dolor itaq'),
(80, 4, 'Thomas Rowland', 'Armand Ward', 'Delilah Edwards', 2, 'Quae qui sapiente de', 'Atque aut ipsum magn'),
(81, 13, 'Cole Vaughn', 'Anjolie Barrera', 'Kerry Joseph', 3, 'Proident deleniti n', 'Non minim nobis exce'),
(83, 10, 'Fulton Roth', 'Ursa Weber', 'Chancellor Fields', 3, 'Reiciendis rerum tem', 'Sed in sed occaecat'),
(86, 4, 'shakira', 'Rigel Sharp', 'Ryder Rivers', 4, 'Voluptatem tempora u', 'Modi nobis saepe vol'),
(88, 4, 'Delilah Sawyer', 'Penelope Pena', 'Hashim Bruce', 5, 'Nihil sed velit ame', 'Est tempore nobis a'),
(89, 4, 'Ezra Macias', 'Malachi Hayden', 'Libby Leon', 2, 'Ad beatae reiciendis', 'Quae aliquid sint ex'),
(90, 2, 'Kermit Harrington', 'Tashya Stevenson', 'Patrick Griffin', 4, 'Repellendus Ipsum', 'Adipisicing quae non'),
(91, 15, 'Troy Cooley', 'Keaton Landry', 'Brody Kirby', 3, 'Et placeat consequa', 'Sed consequatur eum'),
(92, 15, 'Troy Cooley', 'Keaton Landry', 'Brody Kirby', 3, 'Et placeat consequa', 'Sed consequatur eum'),
(93, 15, 'Troy Cooley', 'Keaton Landry', 'Brody Kirby', 3, 'Et placeat consequa', 'Sed consequatur eum'),
(94, 3, 'Marny Downs', 'Angela Stevens', 'Myles Hall', 5, 'Pariatur Voluptas o', 'Voluptatem in neque');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `username` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`username`, `token`) VALUES
('test', '2Xu0hHhkqYMEDfwQpUu52yPbGO0R7L3fW5vGAO7hho5Mp55ZKy7eNXFrcJHSqV3mpcHaDYQ45BVayO0gH9LY1e62wi9dBJfqBwn2'),
('admin2', '6PcDsn3CmgG2jorYeaUOBHpmWmxt6VFaAtVo0KK1EcjumihLTt80xfeNKx8DGdeus01bul5gSwcUtjptt3ra0dZlYzwLeA9dSecx'),
('student', 'e4fNL7rQGKJMdtgC6G0SdtljQ3YcbPnWFnh88kvvYkAv9K9ZCdwGSvcKzGZ15I2cLB8tksHE3Bm2Lc0FbHhX2hcXPZRNglhgpfJ5'),
('student3', 'LIMIJ9gms9Zw9FwPs2nvNPEEz28jUH0m5ZHXna9au0Irknbn49IprW7DAyEXoCtwwXagq0miSi1n1j0Lg1PurzOm5h1uV1VlZuol'),
('amandeep', 't7gRNC4LE4Dpj0sLgwuR6zds2F0SjqQZClMhhMHK3rR1rrHEVIeW0KOpX99VKruZVA5bb1BCwlM46061lNmLO3fQEAPZCgYVEBkC'),
('admin', 'WosRPqoE0VSXzWItUDlnVpnYItXrTjbIlvpDiwyN31qCEQyT4lEodBRv4rr5IcwjoAWTmOw4h7heHBJhzySpV7oswC8o3R1UZaDR'),
('student4', 'yEtHbAyUiaf16PHUrLzf2vSeEZ8wE9oYyWmsIH67Wgic7RKWhEMHtFCTa4yahEnI2RFW3JVm2ucw05uUWUSIIZmWKdouOmajywnl');

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `ID` int(11) NOT NULL,
  `standard_full_name` text NOT NULL,
  `standard_short_name` text NOT NULL,
  `standard_code` varchar(100) NOT NULL,
  `standard_incharge_id` int(11) DEFAULT NULL,
  `standard_description` text,
  `standard_comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`ID`, `standard_full_name`, `standard_short_name`, `standard_code`, `standard_incharge_id`, `standard_description`, `standard_comments`) VALUES
(1, 'First', '1st', '1', 1, NULL, NULL),
(2, 'Second', '2nd', '2', 2, NULL, NULL),
(3, 'Third', '3rd', '3', 3, NULL, NULL),
(4, 'Fourth', '4th', '4', 4, NULL, NULL),
(10, 'Fifth', '5th', '5', 1, NULL, NULL),
(13, 'Kibo Macdonald', 'August Munoz', 'Camilla Rollins', 4, 'Amet voluptatibus c', 'Corrupti labore eli'),
(15, 'Karly Beard', 'Nora Chandler', 'Maxine Hester', 2, 'Ab rerum pariatur F', 'Deleniti inventore t');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `school_roll_no` int(11) DEFAULT NULL,
  `section_roll_no` int(11) DEFAULT NULL,
  `standard_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `student_first_name` text NOT NULL,
  `student_last_name` text,
  `gender` text NOT NULL,
  `dob` date DEFAULT NULL,
  `father_name` text,
  `mother_name` text,
  `father_mobile` text,
  `mother_mobile` text,
  `admission_no` text,
  `home_address` text,
  `landline_contact` text,
  `guardian_full_name` text,
  `guardian_mobile` text,
  `aadhar_no` text NOT NULL,
  `description` text,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `school_roll_no`, `section_roll_no`, `standard_id`, `section_id`, `student_first_name`, `student_last_name`, `gender`, `dob`, `father_name`, `mother_name`, `father_mobile`, `mother_mobile`, `admission_no`, `home_address`, `landline_contact`, `guardian_full_name`, `guardian_mobile`, `aadhar_no`, `description`, `comments`) VALUES
(1, 9, 9, 1, 1, 'Reed', 'Macey', '', '2012-02-05', 'Isabelle', 'Callum', 'Sylvester', 'Malcolm', 'Felix', 'Nyssa', 'Quamar', 'Michael', 'Kuame', 'Ainsley', 'Vero vitae assumenda', 'Ex est quasi cupidat'),
(2, 7, 7, 1, 1, 'Gary', 'Kiayada', '', '2006-10-03', 'Kenneth', 'Yuli', 'India', 'Sharon', 'Maya', 'Fallon', 'Joshua', 'Latifah', 'Uriel', 'Leilani', 'Sunt aut ex ut molli', 'Et aut nesciunt tot'),
(3, 14, 2, 4, 7, 'Teegan', 'Ronan', '', '2011-06-15', 'Ralph', 'Kelsey', 'Macey', 'Mira', 'Amanda', 'Ciara', 'Clinton', 'Neil', 'Ginger', 'Kimberley', 'Dolore id ducimus', 'Deserunt qui nulla m'),
(4, 3, 3, 1, 1, 'Calista', 'Julian', '', '2013-09-21', 'Jana', 'Chastity', 'Finn', 'Chandler', 'Lareina', 'Marvin', 'Kai', 'Malcolm', 'Unity', 'Herman', 'Ex similique et sunt', 'Sit do ex nesciunt'),
(5, 2, 2, 1, 1, 'Anjolie', 'Scarlet', '', '1986-12-12', 'Martina', 'Amos', 'Claudia', 'Charlotte', 'Vincent', 'Shea', 'Neville', 'Aubrey', 'Cynthia', 'Adrian', 'Porro tempore conse', 'Ut sunt nihil accusa'),
(6, 8, 8, 1, 1, 'Irene', 'Uma', '', '1998-07-27', 'Elliott', 'Joshua', 'Athena', 'Sade', 'Hanae', 'Francis', 'Bruce', 'Ina', 'Ima', 'Genevieve', 'Est quis id explicab', 'Dolorem amet ration'),
(7, 1, 1, 1, 1, 'Abraham', 'Andrew', '', '2006-06-22', 'Buckminster', 'Quamar', 'Dean', 'Nero', 'Shana', 'Rae', 'Liberty', 'Kenneth', 'Ignatius', 'MacKenzie', 'Iste eum lorem quo e', 'Facilis nobis et per'),
(8, 4, 4, 1, 1, 'Cleo', 'Lucas', '', '2012-04-12', 'Jasmine', 'Meredith', 'Sawyer', 'Sierra', 'Catherine', 'Tanya', 'Sybil', 'Lionel', 'Blake', 'Igor', 'Sint nesciunt et e', 'Sunt eligendi sint f'),
(9, 5, 5, 1, 1, 'Deborah', 'Mallory', '', '1987-11-25', 'Maris', 'Austin', 'Neville', 'Chancellor', 'Kibo', 'Emery', 'Adena', 'Alyssa', 'Jennifer', 'Hiroko', 'Ducimus quas et ill', 'Architecto qui ut no'),
(10, 6, 6, 1, 1, 'Denton', 'Wyoming', '', '1995-10-24', 'Josiah', 'Halee', 'Cody', 'Ira', 'Warren', 'Sage', 'Gretchen', 'Quemby', 'Juliet', 'Dahlia', 'Voluptates aut moles', 'Minus pariatur Ulla'),
(11, 11, 1, 2, 3, 'Kelly', 'Amy', '', '2012-05-10', 'Reuben', 'Doris', 'Georgia', 'Victor', 'Andrew', 'Wayne', 'Mikayla', 'Gareth', 'Isadora', 'Brittany', 'Ducimus et voluptat', 'Quas recusandae Est'),
(12, 15, 3, 4, 7, 'Trevor', 'Meredith', '', '2003-06-04', 'Kendall', 'Jamal', 'Wilma', 'Lynn', 'Keefe', 'Glenna', 'Lyle', 'Chantale', 'Wanda', 'Sacha', 'Dolores quo sit impe', 'Non aliquam ea ex pa'),
(13, 16, 1, 10, 9, 'Allen', 'Jamalia', '', '2018-11-16', 'Chancellor', 'Jillian', 'Alexander', 'Kermit', 'Kaseem', 'Calvin', 'Erin', 'Ethan', 'Allistair', 'Macey', 'Rerum quasi voluptat', 'Fuga Dolore non qui'),
(14, 13, 1, 4, 7, 'Allen', 'Gay', '', '2017-11-18', 'Maxwell', 'Drake', 'Gwendolyn', 'Ashton', 'Adele', 'Zephr', 'Callum', 'Adele', 'Ainsley', 'Alma', 'Explicabo Laboris n', 'Molestias minima odi'),
(15, 17, 2, 10, 9, 'William', 'Brianna', '', '1980-07-14', 'Molly', 'Maxwell', 'Yoko', 'Alea', 'Michael', 'Tiger', 'Yvette', 'Jemima', 'Rana', 'Audra', 'Fuga Molestiae offi', 'Ut sit reprehenderi'),
(16, 12, 2, 2, 3, 'Philip', 'Jeanette', 'Female', '1976-08-19', 'Cameron', 'Destiny', 'Jenette', 'Kendall', 'Alexa', 'Katell', 'Kelly', 'Charles', 'Jameson', 'Jordan', 'Vel rerum sint est v', 'Et ad voluptates qui'),
(17, 10, NULL, 2, 3, 'Damon', 'Clio', 'Others', '1990-07-22', 'Echo', 'Laurel', 'Samuel', 'Devin', 'Katelyn', 'Althea', 'Aretha', 'Rama', 'Minerva', 'Charissa', 'Id aliqua Placeat', 'Laborum qui quia eiu'),
(18, 18, NULL, 15, 91, 'Noelani', 'Moana', 'Others', '2008-11-14', 'Sean', 'Phelan', 'Kane', 'Gil', 'Brennan', 'Ruth', 'Uriel', 'Ignacia', 'Anjolie', 'Bevis', 'Eum rerum aliquam et', 'Culpa natus et opti');

-- --------------------------------------------------------

--
-- Table structure for table `student_dues`
--

CREATE TABLE `student_dues` (
  `ID` int(11) NOT NULL,
  `student_id` text NOT NULL,
  `due_title` text NOT NULL,
  `due_description` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `ID` int(11) NOT NULL,
  `subject_code` text NOT NULL,
  `subject_full_name` text NOT NULL,
  `subject_short_name` text NOT NULL,
  `subject_type_id` int(11) NOT NULL,
  `description` text,
  `comments` text,
  `subject_incharge_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`ID`, `subject_code`, `subject_full_name`, `subject_short_name`, `subject_type_id`, `description`, `comments`, `subject_incharge_id`, `standard_id`) VALUES
(1, 'E1', 'English', 'Eng', 1, NULL, NULL, 1, 1),
(2, 'E2', 'English', 'Eng', 1, NULL, NULL, 1, 2),
(3, 'E3', 'English', 'Eng', 1, NULL, NULL, 1, 3),
(4, 'E4', 'English', 'Eng', 1, NULL, NULL, 1, 4),
(5, 'H1', 'Hindi', 'Hi', 1, NULL, NULL, 2, 1),
(6, 'H2', 'Hindi', 'Hi', 1, NULL, NULL, 2, 2),
(7, 'H3', 'Hindi', 'Hi', 1, NULL, NULL, 2, 3),
(8, 'H4', 'Hindi', 'Hi', 1, NULL, NULL, 2, 4),
(9, 'PB1', 'Punjabi', 'Pb', 1, NULL, NULL, 1, 1),
(10, 'Rowan Lane', 'Clark Duke', 'Hop Hughes', 2, 'Dolor veniam anim i', 'Nihil laudantium sa', 3, 15),
(11, 'Dora Guy', 'Chastity Burks', 'Asher Boyle', 2, 'Earum sit pariatur', 'Cum voluptate dolor', 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `subject_types`
--

CREATE TABLE `subject_types` (
  `ID` int(11) NOT NULL,
  `type_full_name` text NOT NULL,
  `type_short_name` text NOT NULL,
  `description` text,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_types`
--

INSERT INTO `subject_types` (`ID`, `type_full_name`, `type_short_name`, `description`, `comments`) VALUES
(1, 'Theory', 'T', NULL, NULL),
(2, 'Practical', 'P', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `relation_id` int(11) NOT NULL DEFAULT '0',
  `token` varchar(500) NOT NULL,
  `userType` varchar(100) NOT NULL,
  `type_ID` int(11) NOT NULL,
  `signatures` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `relation_id`, `token`, `userType`, `type_ID`, `signatures`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'trpi5TSUvOX5IGuuq7iarSbEXChpjnClWeuVHIJFn78EQlQOnWx2XYNj1KuRCtqMQt70PDKgfBA9eud97ep53Q0j6jWTlAfA8wXn', 'master', 0, 'ADMIN 1'),
(9, 'student', 'cd73502828457d15655bbd7a63fb0bc8', 0, '7bR4dQRKhUUs83WKCILkJsQ4CXq8TxPsIK10DM0KMDQUwRfoVJYXrZ4iOEed35Y6clKVPb1BeUjJT2vJ3sZepjRfXrERlLVuLH2y', 'student', 1, NULL),
(10, 'amandeep', '21232f297a57a5a743894a0e4a801fc3', 0, 'OdGoH4ZmfucER80cyietrhWAjT9vhBPeWFQhmavoCAtEIsJ3IeH3zODOZaQ9KBP0vm8AHbO6tKLertEykr1FWqulEqTgmPK5H48Q', 'employee', 1, NULL),
(11, 'student3', '21232f297a57a5a743894a0e4a801fc3', 0, 'coTG3fBwoY7obThz7DciFkIJbCJKfNRTFkGy5302dJsK4V2fYYipnZT9a5JTR5it5gtnFUcV8qfeexvgOq5ANUQ9CpCDW22r8Af3', 'student', 3, 'student'),
(12, 'student4', '21232f297a57a5a743894a0e4a801fc3', 3, 'Hpmps5zHxn5gRmNrU7w3uQGkch1FTACmE5Gv7RO06OvS96p4IpgJ42EU8xRz6WHyB25KUnQyzqR2lmNNnUBlmKKeZWSH7VBgJu7Z', 'student', 4, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `date` (`date`,`student_id`,`section_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employees_types`
--
ALTER TABLE `employees_types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `fee_amounts`
--
ALTER TABLE `fee_amounts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `fee_type_ID` (`fee_type_ID`);

--
-- Indexes for table `fee_structures`
--
ALTER TABLE `fee_structures`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `standard_id` (`standard_id`,`fee_entity_id`),
  ADD UNIQUE KEY `section_id` (`section_id`,`fee_entity_id`);

--
-- Indexes for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `global_options`
--
ALTER TABLE `global_options`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD UNIQUE KEY `student_id` (`student_id`,`evaluation_entity_ID`);

--
-- Indexes for table `paid_fees`
--
ALTER TABLE `paid_fees`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `student_id` (`student_id`,`fee_entity_id`);

--
-- Indexes for table `read_messages`
--
ALTER TABLE `read_messages`
  ADD UNIQUE KEY `user_ID` (`user_ID`,`message_ID`);

--
-- Indexes for table `registered_evaluations`
--
ALTER TABLE `registered_evaluations`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `evaluation_id` (`evaluation_id`,`standard_id`,`subject_id`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `standard_code` (`standard_code`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subject_types`
--
ALTER TABLE `subject_types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `userType` (`userType`,`type_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees_types`
--
ALTER TABLE `employees_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fee_amounts`
--
ALTER TABLE `fee_amounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `fee_structures`
--
ALTER TABLE `fee_structures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `global_options`
--
ALTER TABLE `global_options`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `paid_fees`
--
ALTER TABLE `paid_fees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `registered_evaluations`
--
ALTER TABLE `registered_evaluations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `relations`
--
ALTER TABLE `relations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subject_types`
--
ALTER TABLE `subject_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
