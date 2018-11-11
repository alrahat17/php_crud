-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2018 at 03:23 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `teacher_id` int(10) NOT NULL,
  `teacher_name` varchar(20) NOT NULL,
  `teacher_email` varchar(100) NOT NULL,
  `teacher_id_card_no` int(20) NOT NULL,
  `teacher_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teacher_id`, `teacher_name`, `teacher_email`, `teacher_id_card_no`, `teacher_password`) VALUES
(1, 'Rahat', 'rahat@gmail.com', 123456, 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Rifat', 'rifat@gmail.com', 123456, 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE `tbl_test` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(11) NOT NULL,
  `user_gender` varchar(11) NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `user_class` int(10) NOT NULL,
  `user_section` int(10) NOT NULL,
  `user_roll` int(10) NOT NULL,
  `user_hobby` varchar(100) NOT NULL,
  `user_course` varchar(200) NOT NULL,
  `user_photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`user_id`, `user_name`, `user_gender`, `user_email`, `user_class`, `user_section`, `user_roll`, `user_hobby`, `user_course`, `user_photo`) VALUES
(131, 'Tamim', 'male', 'tamim@gmail.com', 7, 6, 9, 'Reading,Singing', 'Bangla,Physics', 'Jonas-Paul-Kids-Glasses-Solomon-Navy_grande.jpg'),
(133, 'Tasnim', 'female', 'tasnim@gmail.com', 9, 8, 7, 'Reading,Singing', 'Bangla,Chemistry', 'Cute-Little-Girl-Haircuts.jpg'),
(134, 'Lamia', 'female', 'lamia@gmail.com', 6, 7, 6, 'Singing,Debating', 'English,Physics,Chemistry', 'ae3d696b197ac013acc16cbc040a098c.jpg'),
(135, 'Afnan', 'male', 'afnan@gmail.com', 4, 4, 5, 'Reading,Singing', 'Bangla,English,Physics,Chemistry', 'Edward-black-boys-glasses-jonas-paul-eyewear2_ea907d16-125c-4345-93cb-cb3a10f108a2_grande.jpg'),
(136, 'Tanvir', 'male', 'tanvir@gmail.com', 7, 8, 6, 'Singing,Debating', 'Bangla,Chemistry', 'Paul-clear-boys-glasses-jonas-paul-eyewear_grande.jpg'),
(137, 'Taki', 'male', 'taki@gmail.com', 6, 6, 4, 'Reading,Singing', 'Bangla,Physics', 'Edward-Cream-Tortoise-Rectangular-Boys-Glasses-by-Jonas-Paul-Eyewear.jpg'),
(138, 'Tanha', 'female', 'tanha@gmail.com', 6, 6, 2, 'Reading,Singing', 'Bangla,Physics', '-.jpg'),
(139, 'Jamal', 'male', 'jamal@gmail.com', 7, 6, 7, 'Reading,Singing', 'Bangla,Physics', 'Paul-clear-boys-glasses-jonas-paul-eyewear_grande.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `teacher_email` (`teacher_email`);

--
-- Indexes for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teacher_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_test`
--
ALTER TABLE `tbl_test`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
