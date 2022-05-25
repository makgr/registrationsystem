-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 08:06 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registrationsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_credit` int(11) NOT NULL,
  `program` varchar(255) NOT NULL,
  `prerequisite_course` int(11) NOT NULL DEFAULT 0,
  `course_teacher` varchar(255) NOT NULL,
  `course_semester` int(11) NOT NULL,
  `deletion_status` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `course_credit`, `program`, `prerequisite_course`, `course_teacher`, `course_semester`, `deletion_status`) VALUES
(1, 'Object Oriented Programming', 'CSI 211', 3, 'CSE', 5, 'Md Shahedul Islam', 1, 0),
(2, 'Database Management System', 'CSI 223', 3, 'CSE', 0, 'Shakila Sultana', 0, 0),
(3, 'Operating System', 'CSI 313', 3, 'CSE', 0, 'Dr Md Tauhid Bin Iqbal', 0, 0),
(4, 'Data Structure and Algorithm', 'CSI 227', 3, 'CSE', 0, 'Tamanna Haque Nipa', 0, 0),
(5, 'Structured Programming Language', 'CSI 121', 3, 'CSE', 0, 'Fahmida Sharmin', 0, 0),
(6, 'Web Computing and Mining', 'MCSE 541', 3, 'CSE', 0, 'Israt Jahan Mouri', 0, 0),
(7, 'Structured Query Language', 'MCSE 542', 3, 'CSE', 0, 'Shifat Sharmin Shapla', 0, 0),
(8, 'E-Commerce and Internet Programming', 'MCSE 543', 3, 'CSE', 1, 'Mahfida Amjad Dipa', 0, 0),
(9, 'Software Design and Integration', 'MCSE 544', 3, 'CSE', 0, 'Md Shahinur Islam', 0, 0),
(10, 'Query Optimization and Control', 'MCSE 546', 3, 'CSE', 2, 'Tanveer Ahmed', 0, 0),
(11, 'Software Project Management', 'MCSE 585', 3, 'CSE', 0, 'Adnan Ferdous Ashrafi', 0, 0),
(12, 'System Security Management', 'MCSE 586', 3, 'CSE', 0, 'Ahmed Abdal Shafi Rasel', 0, 0),
(13, 'Electrical Circuit and Devices', 'EEE 193', 3, 'CSE', 0, 'Aiasha Siddika', 0, 0),
(14, 'Electronics', 'CSE 123', 3, 'CSE', 13, 'Md Towhidul Islam Robin', 0, 0),
(15, 'Digital Electronics & Pulse Technique', 'CSE 213', 3, 'CSE', 14, 'Samia Sultana', 0, 0),
(16, 'Differential and Integral Calculas', 'MATH 131', 3, 'CSE', 0, 'Mohidul Islam', 0, 0),
(17, 'Coordinate Geometry & Vector Calculus', 'MATH 225', 3, 'CSE', 16, 'Bahar Alam', 0, 0),
(18, 'Discrete Mathematics', 'MATH 135', 3, 'CSE', 0, 'Rina sultana', 0, 0),
(19, 'Ordinary & Partial Differential Equation', 'MATH 235', 3, 'CSE', 17, 'Noor A Alam', 0, 0),
(20, 'Matrix & Differential Equation', 'MATH 237', 3, 'CSE', 16, 'Audity Ahmed', 0, 0),
(21, 'Fourier Analysis & Laplace Transformation', 'MATH 319', 3, 'CSE', 19, 'Nusrat Ali kayra', 0, 0),
(22, 'Numerical Methods', 'MATH 327', 3, 'CSE', 21, 'Mahrin Samdani', 0, 0),
(23, 'Mathematical Analysis for Computer Science', 'MATH 337', 3, 'CSE', 16, 'Hasib noor', 0, 0),
(24, 'Bangladesh Studies', 'SOC 113', 3, 'CSE', 0, 'Rashed shahriar', 0, 0),
(25, 'Physics', 'PHY 113', 3, 'CSE', 0, 'Abul Kaiwum', 0, 0),
(26, 'Freshman Orientation', 'ORE 101', 3, 'CSE', 0, 'Momtaz moonmoon', 0, 0),
(27, 'Professional Orientation', 'ORE 103', 1, 'CSE', 0, 'Jihan sakin', 0, 0),
(28, 'English Fundamentals', 'ENGL 100', 3, 'CSE', 0, 'Shimu Rahman', 0, 0),
(29, 'Composition', 'ENGL 101', 3, 'CSE', 0, 'Papiya Tanni', 0, 0),
(30, 'Public Speaking', 'ENGL 102', 3, 'CSE', 0, 'Tushar Ahmed', 0, 0),
(31, 'Fundamental of Business Finance', 'FIN 325', 3, 'CSE', 0, 'Shanjay Kumar', 0, 0),
(32, 'Artificial Intelligence', 'CSI 431', 3, 'CSE', 0, 'Md Samiul Islam', 0, 0),
(33, 'Graph Theory', 'CSI 427', 3, 'CSE', 0, 'Mehedi Hasan', 0, 0),
(34, 'Graph Theory Sessional', 'CSI 428', 2, 'CSE', 0, 'Mehedi Hasan', 0, 0),
(35, 'Computer Graphics', 'CSI 413', 3, 'CSE', 0, 'Nusrat Jahan Farin', 0, 0),
(36, 'Computer Graphics Sessional', 'CSI 414', 2, 'CSE', 0, 'Nusrat Jahan Farin', 0, 0),
(37, 'Compiler', 'CSI 411', 3, 'CSE', 1, 'Saiful Islam', 0, 0),
(38, 'Compiler Sessional', 'CSI 412', 2, 'CSE', 1, 'Saiful Islam', 0, 0),
(39, 'Software Engineering', 'CSI 331', 3, 'CSE', 0, 'Santa Maria Shithil', 0, 0),
(40, 'Software Engineering Sessional', 'CSI 332', 3, 'CSE', 0, 'Santa Maria Shithil', 0, 0),
(41, 'System Analysis & Design', 'CSI 323', 3, 'CSE', 0, 'Muhammed Yaseen Morshed Adib', 0, 0),
(42, 'System Analysis & Design Sessional', 'CSI 324', 2, 'CSE', 0, 'Muhammed Yaseen Morshed Adib', 0, 0),
(43, 'Theory of Computing', 'CSI 315', 3, 'CSE', 0, 'Lomat Haider Chowdhury', 0, 0),
(44, 'Visual & Internet Programming', 'CSI 311', 3, 'CSE', 1, 'Dr Md Humayun Kabir', 0, 0),
(45, 'Algorithms', 'CSI 231', 3, 'CSE', 5, 'Ahmed Al Marouf', 0, 0),
(46, 'Algorithms Sessional', 'CSI 232', 2, 'CSE', 4, 'Ahmed Al Marouf', 0, 0),
(47, 'Computer Networks', 'CSE 415', 3, 'CSE', 50, 'Shaheena Sultana', 0, 0),
(48, 'Computer Networks Sessional', 'CSE 416', 2, 'CSE', 50, 'Shaheena Sultana', 0, 0),
(49, 'Project & Thesis', 'CSE 500', 4, 'CSE', 0, 'Any', 0, 0),
(50, 'Data Communication', 'CSE 335', 3, 'CSE', 0, 'Dr Rabindra Nath Mondal', 0, 0),
(51, 'Computer Concepts', 'CSI 111', 3, 'CSE', 0, 'Shifat Sharmin Shapla', 0, 0),
(52, 'Digital Signal Process', 'CSE 433', 3, 'CSE', 0, 'Tanveer Ahmed', 0, 0),
(53, 'Computer Peripherals & Interfacing', 'CSE 333', 3, 'CSE', 0, 'Aiasha Siddika', 0, 0),
(54, 'Computer Peripherals & Interfacing Sessional', 'CSE 334', 1, 'CSE', 0, 'Aiasha Siddika', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `offered_courses`
--

CREATE TABLE `offered_courses` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `common_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offered_courses`
--

INSERT INTO `offered_courses` (`id`, `course_id`, `common_id`, `user_id`, `added`, `deletion_status`) VALUES
(1, 4, 1, 8, '2022-05-24 10:08:34', 0),
(2, 5, 1, 8, '2022-05-24 10:08:34', 0),
(3, 6, 1, 8, '2022-05-24 10:08:34', 0),
(4, 7, 1, 8, '2022-05-24 10:08:34', 0),
(5, 8, 1, 8, '2022-05-24 10:08:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `offered_courses_info`
--

CREATE TABLE `offered_courses_info` (
  `id` int(11) NOT NULL,
  `program` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  `semester` varchar(200) NOT NULL,
  `offer_date` varchar(100) NOT NULL,
  `registration_end` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deletion_status` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offered_courses_info`
--

INSERT INTO `offered_courses_info` (`id`, `program`, `batch`, `semester`, `offer_date`, `registration_end`, `user_id`, `deletion_status`) VALUES
(1, 'CSE', 4456, '1', '2022-05-24', '2022-05-31', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `registered_course`
--

CREATE TABLE `registered_course` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `courseCredit` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=pending, 1= approved',
  `withdraw_status` int(11) NOT NULL DEFAULT 0 COMMENT '1=pending, 2 = approved',
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `deletion_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registration_info`
--

CREATE TABLE `registration_info` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL DEFAULT 0,
  `student_ID` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0= pending, 1= approved',
  `apply_date` varchar(50) NOT NULL,
  `deletion_status` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL DEFAULT '0',
  `student_password` varchar(255) NOT NULL,
  `student_dob` varchar(20) NOT NULL,
  `program` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL DEFAULT 0,
  `student_email` varchar(255) NOT NULL,
  `student_contact` varchar(255) NOT NULL,
  `student_address` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `joining_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `student_id`, `student_password`, `student_dob`, `program`, `batch`, `student_email`, `student_contact`, `student_address`, `status`, `joining_date`) VALUES
(1, 'Shafik Ullah', 'CSE00101227', '827ccb0eea8a706c4c34a16891f84e7b', '2012-01-01', 'CSE', 1, 'Shafik@mail.com', '111111', '', 1, '2021-12-25 07:56:52'),
(2, 'Kawsar Hossain', 'CSE00101237', '827ccb0eea8a706c4c34a16891f84e7b', '', 'CSE', 1, 'kawsar@mail.com', '', '', 1, '2021-12-25 07:57:53'),
(3, 'Khaled Mohammad Faisal', 'CSE00101247', '827ccb0eea8a706c4c34a16891f84e7b', '', 'CSE', 1, 'khaled@mail.com', '', '', 1, '2021-12-25 07:58:55'),
(4, 'Antil Khushbu', 'CSE00202227', '827ccb0eea8a706c4c34a16891f84e7b', '', 'CSE', 1, 'khushbu@mail.com', '', '', 1, '2021-12-25 08:00:10'),
(5, 'Mehedi Hasan Maruf', 'CSE00202237', '827ccb0eea8a706c4c34a16891f84e7b', '', 'CSE', 2, 'maruf@mail.com', '', '', 1, '2021-12-25 08:05:41'),
(6, 'Anjali Juthy', 'CSE00202247', '827ccb0eea8a706c4c34a16891f84e7b', '', 'CSE', 2, 'juthy@mail.com', '', '', 1, '2021-12-25 08:08:25'),
(7, 'Nasrin Akter', 'CSE00303227', '827ccb0eea8a706c4c34a16891f84e7b', '', 'CSE', 3, 'nasrin@mail.com', '', '', 1, '2021-12-25 08:10:36'),
(8, 'Al Mahmud Saifullah', 'CSE00303237', '827ccb0eea8a706c4c34a16891f84e7b', '', 'CSE', 3, 'mahmud@mail.com', '', '', 1, '2021-12-25 08:12:02'),
(9, 'Samin talukdar', 'CSE00303247', '827ccb0eea8a706c4c34a16891f84e7b', '', 'CSE', 3, 'samin@mail.com', '', '', 1, '2021-12-25 08:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=admin, 2 = chairmen, 3 = advisor',
  `user_designation` varchar(255) NOT NULL,
  `advisor_batch` varchar(20) NOT NULL DEFAULT '0',
  `joining_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_fullname`, `user_email`, `user_password`, `user_type`, `user_designation`, `advisor_batch`, `joining_date`, `deletion_status`) VALUES
(1, 'Super Admin', 'admin@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Superadmin', '0', '2021-10-27 14:16:44', 0),
(7, 'Dr Farahnaaz Feroz', 'chairman@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'Professor', '0', '2021-12-25 08:15:59', 0),
(8, 'Dr Mehedi Hasan', 'advisor@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 'Professor', '0', '2021-12-25 08:16:53', 0),
(9, 'sss', 'g@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 'gg', '46', '2022-05-25 17:31:22', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offered_courses`
--
ALTER TABLE `offered_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offered_courses_info`
--
ALTER TABLE `offered_courses_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_course`
--
ALTER TABLE `registered_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_info`
--
ALTER TABLE `registration_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `offered_courses`
--
ALTER TABLE `offered_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offered_courses_info`
--
ALTER TABLE `offered_courses_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registered_course`
--
ALTER TABLE `registered_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_info`
--
ALTER TABLE `registration_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
