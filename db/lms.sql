-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2023 at 04:32 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `an_id` int(5) NOT NULL,
  `an_topic` varchar(100) NOT NULL,
  `an_desc` varchar(500) NOT NULL,
  `an_date` date NOT NULL,
  `an_cid` int(5) NOT NULL,
  `value` int(1) NOT NULL DEFAULT 0,
  `an_sid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`an_id`, `an_topic`, `an_desc`, `an_date`, `an_cid`, `value`, `an_sid`) VALUES
(9, 'pattanilla', 'dasdasdsa', '2023-08-01', 11, 1, 150),
(10, 'dasdad', 'dasdad', '2023-08-01', 11, 0, 0),
(11, 'fd', 'sdf', '2023-08-01', 12, 0, 0),
(12, 'pattanilla', 'asddasd', '2023-08-03', 10, 1, 149);

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `as_id` int(11) NOT NULL,
  `as_name` varchar(50) NOT NULL,
  `as_file` varchar(30) NOT NULL,
  `as_duedate` date NOT NULL,
  `as_desc` varchar(200) NOT NULL,
  `as_subid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`as_id`, `as_name`, `as_file`, `as_duedate`, `as_desc`, `as_subid`) VALUES
(6, 'fsdfsd', '', '2023-08-23', '', 11),
(7, 'fffff', '1691075061.pdf', '2023-08-29', 'fsdfsdf', 9);

-- --------------------------------------------------------

--
-- Table structure for table `att`
--

CREATE TABLE `att` (
  `at_id` int(5) NOT NULL,
  `at_sid` int(5) NOT NULL,
  `at_p1` int(2) NOT NULL,
  `at_p2` int(2) NOT NULL,
  `at_p3` int(2) NOT NULL,
  `at_p4` int(2) NOT NULL,
  `at_p5` int(2) NOT NULL,
  `at_p6` int(2) NOT NULL,
  `at_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `att`
--

INSERT INTO `att` (`at_id`, `at_sid`, `at_p1`, `at_p2`, `at_p3`, `at_p4`, `at_p5`, `at_p6`, `at_date`) VALUES
(1, 149, 0, 0, 0, 0, 0, 0, '2023-07-29'),
(2, 149, 1, 1, 1, 1, 1, 1, '2023-08-03'),
(3, 149, 0, 0, 1, 1, 1, 1, '2023-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(25) NOT NULL,
  `c_batch` varchar(2) NOT NULL,
  `c_yoa` int(4) NOT NULL,
  `c_tid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`c_id`, `c_name`, `c_batch`, `c_yoa`, `c_tid`) VALUES
(10, 'MCA', 'A', 2023, 23),
(11, 'A batch', 'A', 2021, 1),
(12, 'Bridge', 'A', 2023, 1),
(13, 'MCA', 'A', 2021, 25);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `d_did` int(5) NOT NULL,
  `d_sid` int(5) NOT NULL,
  `d_asid` int(5) NOT NULL,
  `d_name` varchar(30) NOT NULL,
  `d_date` date NOT NULL,
  `d_comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`d_did`, `d_sid`, `d_asid`, `d_name`, `d_date`, `d_comment`) VALUES
(9, 150, 6, '1690900515.pdf', '2023-08-01', '');

-- --------------------------------------------------------

--
-- Table structure for table `internal`
--

CREATE TABLE `internal` (
  `i_id` int(11) NOT NULL,
  `i_first` int(3) NOT NULL,
  `i_second` int(3) NOT NULL,
  `i_subid` int(5) NOT NULL,
  `i_sid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `m_id` int(5) NOT NULL,
  `m_sid` int(5) NOT NULL,
  `m_msg` varchar(500) NOT NULL,
  `m_cid` int(5) NOT NULL,
  `m_date` datetime(5) NOT NULL,
  `m_tid` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`m_id`, `m_sid`, `m_msg`, `m_cid`, `m_date`, `m_tid`) VALUES
(4, 149, 'hi', 12, '2023-08-02 10:27:26.00000', 0),
(5, 149, 'dada', 12, '2023-08-02 10:27:30.00000', 0),
(6, 149, 'sdsd', 12, '2023-08-02 10:27:34.00000', 0),
(7, 149, 'dsada', 12, '2023-08-02 10:27:35.00000', 0),
(8, 149, 'dasdasd', 12, '2023-08-02 10:27:36.00000', 0),
(9, 149, 'dasda', 12, '2023-08-02 10:27:39.00000', 0),
(10, 149, 'hhh', 12, '2023-08-02 10:27:43.00000', 0),
(11, 149, 'podaa', 12, '2023-08-02 10:27:58.00000', 0),
(12, 149, 'jdd', 12, '2023-08-05 14:40:55.00000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `n_id` int(11) NOT NULL,
  `n_name` varchar(50) NOT NULL,
  `n_fname` varchar(50) NOT NULL,
  `n_date` date NOT NULL,
  `n_subid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`n_id`, `n_name`, `n_fname`, `n_date`, `n_subid`) VALUES
(5, '16_EricsAntony_SRS_ppt.pdf', '1690898507.pdf', '2023-08-01', 11);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `q_id` int(5) NOT NULL,
  `q_title` varchar(30) NOT NULL,
  `q_desc` varchar(500) NOT NULL,
  `q_timer` varchar(10) NOT NULL,
  `q_qlimit` int(5) NOT NULL,
  `q_createdate` date NOT NULL,
  `q_cid` int(5) NOT NULL,
  `q_publish` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`q_id`, `q_title`, `q_desc`, `q_timer`, `q_qlimit`, `q_createdate`, `q_cid`, `q_publish`) VALUES
(4, 'quiz', 'qwertryuiop', '00:10', 0, '2023-08-01', 11, 0),
(5, 'quiz', 'hkjh', '00:10', 0, '2023-08-02', 12, 0),
(6, 'q2', 'asdfghnjkl', '01:00', 0, '2023-08-03', 12, 1),
(7, 'q2', 'eqwewqe', '00:12', 0, '2023-08-03', 13, 0),
(8, 'q2', 'eqweqweqwe', '00:25', 0, '2023-08-03', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `qa_id` int(5) NOT NULL,
  `qa_qtid` int(5) NOT NULL,
  `qa_sid` int(5) NOT NULL,
  `qa_subans` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`qa_id`, `qa_qtid`, `qa_sid`, `qa_subans`) VALUES
(6, 8, 149, 'ks'),
(7, 9, 149, 'vijayan'),
(8, 10, 149, 'ks'),
(9, 11, 149, 'antony'),
(10, 12, 149, 'shaji'),
(11, 13, 149, 'shaji'),
(12, 14, 149, 'ravi'),
(13, 15, 149, 'shabu'),
(14, 16, 149, 'ps');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempted`
--

CREATE TABLE `quiz_attempted` (
  `qat_id` int(5) NOT NULL,
  `qat_qid` int(5) NOT NULL,
  `qat_sid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_attempted`
--

INSERT INTO `quiz_attempted` (`qat_id`, `qat_qid`, `qat_sid`) VALUES
(6, 5, 149);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `qt_id` int(5) NOT NULL,
  `qt_question` varchar(500) NOT NULL,
  `qt_ans1` varchar(300) NOT NULL,
  `qt_ans2` varchar(300) NOT NULL,
  `qt_ans3` varchar(300) NOT NULL,
  `qt_ans4` varchar(300) NOT NULL,
  `qt_crct` varchar(300) NOT NULL,
  `qt_eid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`qt_id`, `qt_question`, `qt_ans1`, `qt_ans2`, `qt_ans3`, `qt_ans4`, `qt_crct`, `qt_eid`) VALUES
(8, 'aswin', 'ks', 'antony', 'vijayan', 'shaji', 'ks', 5),
(9, 'anandhu', 'ks', 'vijayan', 'shaji', 'antony', 'vijayan', 5),
(10, 'aswin', 'ks', 'shaji', 'vijayan', 'antony', 'ks', 8),
(11, 'erics', 'antony', 'shaji', 'shibu', 'vijayan', 'antony', 8),
(12, 'haripriya', 'shaji', 'vijayan', 'anil', 'shyam', 'shaji', 8),
(13, 'akhil', 'shaji', 'shibu', 'vijayan', 'antony', 'shaji', 8),
(14, 'aravind', 'ravi', 'shaji', 'antony', 'vijayan', 'ravi', 8),
(15, 'gokul', 'shabu', '123', 'ravi', 'shaji', 'shabu', 8),
(16, 'manu', 'ps', 'ks', 'ss', 'ls', 'ps', 8);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `qr_id` int(11) NOT NULL,
  `qr_sid` int(5) NOT NULL,
  `qr_qid` int(5) NOT NULL,
  `qr_result` int(5) NOT NULL,
  `qr_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`qr_id`, `qr_sid`, `qr_qid`, `qr_result`, `qr_date`) VALUES
(6, 149, 5, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `r_id` int(5) NOT NULL,
  `r_name` varchar(30) NOT NULL,
  `r_subid` int(5) NOT NULL,
  `r_file` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` int(5) NOT NULL,
  `s_name` varchar(30) NOT NULL,
  `s_email` varchar(40) NOT NULL,
  `s_admno` varchar(10) NOT NULL,
  `s_phn` bigint(10) NOT NULL,
  `s_batch` varchar(2) NOT NULL,
  `s_yoa` int(4) NOT NULL,
  `s_pass` varchar(20) NOT NULL,
  `s_del` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `s_name`, `s_email`, `s_admno`, `s_phn`, `s_batch`, `s_yoa`, `s_pass`, `s_del`) VALUES
(149, 'ABC', 'test@test.co', '1234', 1234098768, 'A', 2023, 'MTIzNA==', 0),
(151, 'Erics', 'ericsantony123@gmail.com', '1000', 9497775002, 'A', 2021, 'RXJpY3NANzc3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(4) NOT NULL,
  `sub_name` varchar(25) NOT NULL,
  `sub_cid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_name`, `sub_cid`) VALUES
(9, 'Java', 10),
(11, 'ADV', 11),
(12, 'java', 13);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_id` int(5) NOT NULL,
  `t_name` varchar(30) NOT NULL,
  `t_email` varchar(50) NOT NULL,
  `t_pass` varchar(30) NOT NULL,
  `t_del` int(1) NOT NULL DEFAULT 0,
  `t_phn` bigint(10) NOT NULL,
  `t_role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `t_name`, `t_email`, `t_pass`, `t_del`, `t_phn`, `t_role`) VALUES
(1, 'Sherna  Mohan', 'hod@gmail.com', 'MTIzNA==', 0, 9497775002, 1),
(23, 'dijo', 'dijo@gmail.com', 'MTIzNA==', 0, 1234567890, 0),
(24, 'djkas', 'erics@gmail.com', 'MTIzNA==', 0, 1234456789, 0),
(25, 'joe', 'joe@gmail.com', 'MTIzNA==', 0, 1111111111, 0),
(26, 'haripriya', 'haripriyashaji16@gmail.com', 'SGFyaXByaXlhQDc3Nw==', 0, 9497775002, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`an_id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`as_id`);

--
-- Indexes for table `att`
--
ALTER TABLE `att`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`d_did`);

--
-- Indexes for table `internal`
--
ALTER TABLE `internal`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`qa_id`);

--
-- Indexes for table `quiz_attempted`
--
ALTER TABLE `quiz_attempted`
  ADD PRIMARY KEY (`qat_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`qt_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`qr_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `an_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `as_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `att`
--
ALTER TABLE `att`
  MODIFY `at_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `d_did` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `internal`
--
ALTER TABLE `internal`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `m_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `q_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `qa_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quiz_attempted`
--
ALTER TABLE `quiz_attempted`
  MODIFY `qat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `qt_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `qr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `r_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `s_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
