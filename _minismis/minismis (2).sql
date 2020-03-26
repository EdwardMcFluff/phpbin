-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2020 at 02:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minismis`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrolledstud`
--

CREATE TABLE `enrolledstud` (
  `ID` int(10) NOT NULL,
  `subjName` varchar(50) NOT NULL,
  `subjID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrolledstud`
--

INSERT INTO `enrolledstud` (`ID`, `subjName`, `subjID`) VALUES
(7, 'rizal', 41),
(7, 'data structures', 40),
(16, 'data structures', 44),
(16, 'data structures', 42),
(16, 'data structures', 40),
(16, 'data structures', 40),
(16, 'data structures', 42),
(16, 'data structures', 42),
(16, 'rizal', 49),
(16, 'web development', 45),
(7, 'networking', 48);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `subjName` varchar(50) NOT NULL,
  `subjID` int(10) NOT NULL,
  `tday` enum('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `tstart` int(11) NOT NULL,
  `tend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`subjName`, `subjID`, `tday`, `tstart`, `tend`) VALUES
('networking', 36, 'Monday', 27000, 30600),
('networking', 37, 'Monday', 27000, 30600),
('networking', 38, 'Monday', 30600, 34200),
('networking', 39, 'Monday', 27000, 34200),
('data structures', 40, 'Wednesday', 36000, 43200),
('rizal', 41, 'Wednesday', 30600, 45000),
('data structures', 42, 'Friday', 41400, 48600),
('data structures', 43, 'Friday', 27000, 30600),
('data structures', 44, 'Wednesday', 41400, 52200),
('Web Development', 45, 'Wednesday', 48600, 52200),
('Web Development', 46, 'Wednesday', 59400, 63000),
('networking', 47, 'Monday', 27000, 30600),
('networking', 48, 'Monday', 50400, 57600),
('rizal', 49, 'Monday', 37800, 43200),
('rizal', 50, 'Wednesday', 43200, 50400);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjName`) VALUES
('data structures'),
('networking'),
('rizal'),
('web development');

-- --------------------------------------------------------

--
-- Table structure for table `teachersched`
--

CREATE TABLE `teachersched` (
  `ID` int(10) NOT NULL,
  `subjName` varchar(50) NOT NULL,
  `subjID` int(10) NOT NULL,
  `studPop` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachersched`
--

INSERT INTO `teachersched` (`ID`, `subjName`, `subjID`, `studPop`) VALUES
(8, 'networking', 36, 5),
(9, 'networking', 37, 5),
(10, 'networking', 38, 5),
(11, 'networking', 39, 5),
(11, 'data structures', 40, 40),
(10, 'rizal', 41, 40),
(8, 'data structures', 42, 40),
(14, 'data structures', 43, 40),
(9, 'data structures', 44, 40),
(14, 'Web Development', 45, 40),
(10, 'Web Development', 46, 40),
(12, 'networking', 47, 40),
(10, 'networking', 48, 30),
(11, 'rizal', 49, 40),
(12, 'rizal', 50, 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `usertype` enum('student','teacher','admin') NOT NULL,
  `ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `email`, `pass`, `usertype`, `ID`) VALUES
('kyle', 'go', 'kyle@gmail.com', '123', 'student', 2),
('mako', 'young', 'mako@gmail.com', '123', 'student', 3),
('jack', 'ma', 'jack@gmail.com', '123', 'student', 4),
('isma', 'francisco', 'isma@gmail.com', '123', 'student', 5),
('maggie', 'oquias', 'maggie@gmail.com', '123', 'student', 6),
('irie', 'aldana', 'irie@gmail.com', '123', 'student', 7),
('keenan', 'mendiola', 'engrkeens@gmail.com', '123', 'teacher', 8),
('patrick', 'star', 'patrick@gmail.com', '123', 'teacher', 9),
('christian', 'maderazo', 'christian@gmail.com', '123', 'teacher', 10),
('chris', 'pena', 'chris@gmail.com', '123', 'teacher', 11),
('bucky', 'barnes', 'bucky@gmail.com', '123', 'teacher', 12),
('admin', 'admin', 'admin@gmail.com', '123', 'admin', 13),
('dante', 'inferno', 'dante@gmail.com', '123', 'teacher', 14),
('Irie', 'Doe', 'makobobin@YAHOO.com', '123', 'student', 15),
('daniel', 'lim', 'daniel@gmail.com', '123', 'student', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrolledstud`
--
ALTER TABLE `enrolledstud`
  ADD KEY `subjID` (`subjID`),
  ADD KEY `subjName` (`subjName`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD KEY `subjID` (`subjID`),
  ADD KEY `subjName` (`subjName`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjName`),
  ADD KEY `subjName` (`subjName`);

--
-- Indexes for table `teachersched`
--
ALTER TABLE `teachersched`
  ADD PRIMARY KEY (`subjID`),
  ADD KEY `subjID` (`subjID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `subjName` (`subjName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teachersched`
--
ALTER TABLE `teachersched`
  MODIFY `subjID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolledstud`
--
ALTER TABLE `enrolledstud`
  ADD CONSTRAINT `enrolledstud_ibfk_1` FOREIGN KEY (`subjName`) REFERENCES `subjects` (`subjName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolledstud_ibfk_2` FOREIGN KEY (`subjID`) REFERENCES `teachersched` (`subjID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolledstud_ibfk_3` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`subjName`) REFERENCES `subjects` (`subjName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`subjID`) REFERENCES `teachersched` (`subjID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachersched`
--
ALTER TABLE `teachersched`
  ADD CONSTRAINT `teachersched_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachersched_ibfk_3` FOREIGN KEY (`subjName`) REFERENCES `subjects` (`subjName`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
