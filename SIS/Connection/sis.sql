-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 06:44 AM
-- Server version: 10.4.28-MariaDB-log
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicdetails`
--

CREATE TABLE `academicdetails` (
  `AID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Batch` year(4) NOT NULL,
  `Year` int(2) NOT NULL,
  `Join_Date` date NOT NULL DEFAULT '2024-04-01',
  `Type` varchar(20) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Achievements` varchar(100) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `DID` int(11) NOT NULL,
  `CID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `academicdetails`
--

INSERT INTO `academicdetails` (`AID`, `SID`, `Batch`, `Year`, `Join_Date`, `Type`, `Status`, `Achievements`, `CreatedOn`, `DID`, `CID`) VALUES
(14, 'SID2024504', '2021', 1, '2024-04-01', 'Government', 'InActive', '', '2024-01-06 08:21:44', 1, 1),
(16, 'SID2024905', '2021', 1, '2024-04-01', 'Government', 'active', '', '2024-01-06 08:45:05', 1, 1),
(26, 'SID2024507', '2021', 3, '2024-04-01', 'Government-Aided', 'Active', '', '2024-02-08 12:45:07', 1, 1),
(28, 'SID2024729', '2021', 1, '2024-04-01', 'Government-Aided', 'Active', '', '2024-02-19 11:52:09', 4, 2),
(29, 'SID2024528', '2021', 2, '2024-04-01', 'Government-Aided', 'Active', '', '2024-03-13 09:32:08', 1, 1),
(30, 'SID2024234', '2021', 1, '2024-04-01', 'Government-Aided', 'Active', '', '2024-03-13 10:00:34', 1, 1),
(32, 'SID2024851', '2021', 2, '2024-04-01', 'Government-Aided', 'Active', '', '2024-03-19 12:50:51', 1, 1),
(33, 'SID2024027', '2022', 1, '2024-04-01', 'Government', 'Active', '', '2024-03-19 12:53:47', 1, 1),
(34, 'SID2024963', '2021', 3, '2024-04-01', 'Government-Aided', 'Active', '', '2024-03-20 08:36:03', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMINID` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Level` varchar(10) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `Who` varchar(10) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMINID`, `Name`, `Email`, `Level`, `Password`, `CreatedOn`, `Who`) VALUES
('ADMIN24101', 'Muthukrishnan', 'muthuabi292@gmail.com', 'Primary', 'Muthu123', '2024-01-19 08:59:29', 'admin'),
('ADMIN24102', 'Sukas', 'sukas@gmail.com', 'Secondary', 'Sukas123', '2024-01-19 08:59:29', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `Attendance_ID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Year` int(2) NOT NULL,
  `DID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Hour` int(11) NOT NULL,
  `AttStatus` varchar(7) NOT NULL DEFAULT 'Present',
  `TakenAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`Attendance_ID`, `SID`, `Year`, `DID`, `Date`, `Hour`, `AttStatus`, `TakenAt`) VALUES
(1, 'SID2024504', 1, 1, '2024-03-14', 1, 'Present', '2024-03-14 11:47:47'),
(2, 'SID2024905', 1, 1, '2024-03-14', 1, 'Absent', '2024-03-14 11:47:47'),
(6, 'SID2024234', 1, 1, '2024-03-14', 1, 'Present', '2024-03-14 11:47:47'),
(8, 'SID2024504', 1, 1, '2024-03-14', 2, 'Present', '2024-03-14 11:52:39'),
(9, 'SID2024905', 1, 1, '2024-03-14', 2, 'Present', '2024-03-14 11:52:39'),
(13, 'SID2024234', 1, 1, '2024-03-14', 2, 'Absent', '2024-03-14 11:52:39'),
(15, 'SID2024504', 1, 1, '2024-03-14', 3, 'Present', '2024-03-14 11:53:49'),
(16, 'SID2024905', 1, 1, '2024-03-14', 3, 'Present', '2024-03-14 11:53:49'),
(20, 'SID2024234', 1, 1, '2024-03-14', 3, 'Absent', '2024-03-14 11:53:49'),
(21, 'SID2024504', 1, 1, '2024-03-16', 1, 'Absent', '2024-03-16 11:24:00'),
(22, 'SID2024905', 1, 1, '2024-03-16', 1, 'Absent', '2024-03-16 11:24:00'),
(24, 'SID2024234', 1, 1, '2024-03-16', 1, 'Present', '2024-03-16 11:24:00'),
(25, 'SID2024504', 1, 1, '2024-03-16', 2, 'Present', '2024-03-16 11:24:28'),
(26, 'SID2024905', 1, 1, '2024-03-16', 2, 'Present', '2024-03-16 11:24:28'),
(28, 'SID2024234', 1, 1, '2024-03-16', 2, 'Present', '2024-03-16 11:24:28'),
(29, 'SID2024507', 3, 1, '2024-03-20', 1, 'Absent', '2024-03-20 08:38:49'),
(30, 'SID2024963', 3, 1, '2024-03-20', 1, 'Present', '2024-03-20 08:38:49'),
(32, 'SID2024504', 1, 1, '2024-03-20', 2, 'Present', '2024-03-20 09:39:34'),
(33, 'SID2024905', 1, 1, '2024-03-20', 2, 'Absent', '2024-03-20 09:39:34'),
(34, 'SID2024234', 1, 1, '2024-03-20', 2, 'Present', '2024-03-20 09:39:34'),
(35, 'SID2024027', 1, 1, '2024-03-20', 2, 'Present', '2024-03-20 09:39:34'),
(36, 'SID2024504', 1, 1, '2024-03-21', 4, 'Absent', '2024-03-21 12:59:24'),
(37, 'SID2024905', 1, 1, '2024-03-21', 4, 'Absent', '2024-03-21 12:59:24'),
(38, 'SID2024234', 1, 1, '2024-03-21', 4, 'Absent', '2024-03-21 12:59:24'),
(39, 'SID2024027', 1, 1, '2024-03-21', 4, 'Absent', '2024-03-21 12:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `CID` int(11) NOT NULL,
  `CollegeName` varchar(50) NOT NULL,
  `Location` varchar(70) NOT NULL,
  `CollegeType` varchar(30) NOT NULL DEFAULT 'Government',
  `EstablishedDate` date NOT NULL,
  `PrincipalName` varchar(30) NOT NULL,
  `ContactNumber` bigint(11) NOT NULL,
  `ContactMail` varchar(50) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`CID`, `CollegeName`, `Location`, `CollegeType`, `EstablishedDate`, `PrincipalName`, `ContactNumber`, `ContactMail`, `CreatedOn`) VALUES
(1, 'St Xavier\'s College of Arts and Science', 'Palayamkottai, Tirnunelveli', 'Government', '1923-12-11', 'Mariadoss S', 9034562345, 'sxcprince@gmail.com', '2023-12-14 11:57:38'),
(2, 'St John\'s College', 'Palayamkottai, Tirunelveli.', 'Government', '1911-12-11', 'John Britto', 9334562345, 'johnsprince@gmail.com', '2023-12-14 12:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `communication`
--

CREATE TABLE `communication` (
  `CommunID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `TID` varchar(10) NOT NULL,
  `MessageType` varchar(20) NOT NULL,
  `ChatTime` datetime NOT NULL DEFAULT current_timestamp(),
  `Content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DID` int(11) NOT NULL,
  `DName` varchar(50) NOT NULL,
  `Head` varchar(30) NOT NULL,
  `Started` date NOT NULL,
  `NoStudent` int(3) NOT NULL,
  `NoTeacher` int(3) NOT NULL,
  `HeadNo` bigint(10) NOT NULL,
  `HeadMail` varchar(50) NOT NULL,
  `CID` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DID`, `DName`, `Head`, `Started`, `NoStudent`, `NoTeacher`, `HeadNo`, `HeadMail`, `CID`, `CreatedOn`) VALUES
(1, 'BSC COMPUTER SCIENCE', 'Rajakumar T C', '2013-12-05', 50, 6, 0, '', 1, '2023-12-14 12:04:38'),
(2, 'BSC COMPUTER SCIENCE', 'Johnson', '2012-12-13', 45, 7, 0, '', 2, '2023-12-14 12:04:38'),
(3, 'BSC CHEMISTRY', 'Ruban', '2011-12-05', 50, 6, 0, '', 1, '2023-12-14 12:06:29'),
(4, 'BSC PHYSICS', 'John', '2015-12-13', 45, 7, 0, '', 2, '2023-12-14 12:06:29');

-- --------------------------------------------------------

--
-- Table structure for table `dept_subjects`
--

CREATE TABLE `dept_subjects` (
  `Subject_ID` int(11) NOT NULL,
  `Subject_Title` varchar(50) NOT NULL,
  `Subject_Type` varchar(15) NOT NULL,
  `DID` int(11) NOT NULL,
  `Semester` int(2) NOT NULL,
  `Batch` year(4) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dept_subjects`
--

INSERT INTO `dept_subjects` (`Subject_ID`, `Subject_Title`, `Subject_Type`, `DID`, `Semester`, `Batch`, `CreatedOn`) VALUES
(1, 'Java', 'Theory', 1, 1, '2021', '2024-03-14 12:50:13'),
(2, 'Python', 'Theory', 1, 2, '2021', '2024-03-14 12:50:13'),
(3, 'Momentum', 'Theory', 4, 1, '2020', '2024-03-19 12:39:20');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `Document_ID` int(11) NOT NULL,
  `Document_Name` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL DEFAULT 'No Description',
  `Document_Path` varchar(200) NOT NULL,
  `Document_Type` varchar(10) NOT NULL,
  `Document_Size` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `UploadOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`Document_ID`, `Document_Name`, `Description`, `Document_Path`, `Document_Type`, `Document_Size`, `SID`, `UploadOn`) VALUES
(22, 'SSLC_Grades.html', '\r\n                ', 'documents/SSLC_Grades.html', 'html', 7117, 'SID2024504', '2024-02-20 10:26:27'),
(23, 'navcollapse.js', '\r\n                ', 'documents/navcollapse.js', 'js', 884, 'SID2024504', '2024-02-20 10:27:36'),
(24, 'MIndex.html', '\r\n                ', 'documents/MIndex.html', 'html', 3122, 'SID2024504', '2024-02-27 09:05:26'),
(25, 'HSE_Grades.html', '\r\n                ', 'documents/HSE_Grades.html', 'html', 2453, 'SID2024504', '2024-02-28 11:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `hse`
--

CREATE TABLE `hse` (
  `Mark_ID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Subject_ID` int(11) NOT NULL,
  `Mark` int(3) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hse`
--

INSERT INTO `hse` (`Mark_ID`, `SID`, `Subject_ID`, `Mark`, `CreatedOn`) VALUES
(19, 'SID2024504', 1, 88, '2024-02-19 11:53:32'),
(20, 'SID2024504', 2, 87, '2024-02-19 11:53:32'),
(21, 'SID2024504', 4, 87, '2024-02-19 11:53:32'),
(22, 'SID2024504', 3, 44, '2024-02-19 11:53:32'),
(23, 'SID2024504', 5, 68, '2024-02-19 11:53:32'),
(24, 'SID2024504', 7, 90, '2024-02-19 11:53:32'),
(32, 'SID2024729', 1, 88, '2024-03-16 11:20:13'),
(33, 'SID2024729', 2, 87, '2024-03-16 11:20:13'),
(34, 'SID2024729', 3, 44, '2024-03-16 11:20:13'),
(35, 'SID2024729', 4, 87, '2024-03-16 11:20:13'),
(36, 'SID2024729', 5, 33, '2024-03-16 11:20:13'),
(37, 'SID2024729', 6, 66, '2024-03-16 11:20:13'),
(38, 'SID2024851', 1, 80, '2024-03-20 08:40:51'),
(39, 'SID2024851', 2, 90, '2024-03-20 08:40:51'),
(40, 'SID2024851', 3, 80, '2024-03-20 08:40:51'),
(41, 'SID2024851', 4, 70, '2024-03-20 08:40:51'),
(42, 'SID2024851', 5, 75, '2024-03-20 08:40:51'),
(43, 'SID2024851', 7, 90, '2024-03-20 08:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `Message_ID` int(11) NOT NULL,
  `Sender` varchar(10) NOT NULL,
  `Sender_Type` varchar(10) NOT NULL,
  `Receiver` varchar(10) NOT NULL,
  `Receiver_Type` varchar(10) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `Notice_ID` int(11) NOT NULL,
  `Notice` varchar(500) NOT NULL,
  `Notice_From` varchar(100) NOT NULL,
  `Notice_To` varchar(100) NOT NULL,
  `Notice_Link` varchar(500) NOT NULL,
  `Notice_File` varchar(200) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`Notice_ID`, `Notice`, `Notice_From`, `Notice_To`, `Notice_Link`, `Notice_File`, `CreatedOn`) VALUES
(1, 'Test Notice', 'Principal', 'student', 'https://sxc.in/cs/register.php', '', '2024-04-17 22:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE `password` (
  `PID` int(11) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Passtime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `password`
--

INSERT INTO `password` (`PID`, `Password`, `SID`, `Passtime`) VALUES
(2, 'Muthu123', 'SID2024504', '2024-01-09 12:51:45'),
(6, '12345', 'SID2024905', '2024-01-09 12:53:12'),
(16, '12345', 'SID2024507', '2024-02-08 12:45:07'),
(18, 'PD65d2f391', 'SID2024729', '2024-02-19 11:52:09'),
(19, 'PD65f12540', 'SID2024528', '2024-03-13 09:32:08'),
(20, 'PD65f12bea', 'SID2024234', '2024-03-13 10:00:34'),
(22, 'PD65f93cd3', 'SID2024851', '2024-03-19 12:50:51'),
(23, 'PD65f93d83', 'SID2024027', '2024-03-19 12:53:47'),
(24, 'PD65fa529b', 'SID2024963', '2024-03-20 08:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `Request_ID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Field_Name` varchar(30) NOT NULL,
  `Old_Value` text NOT NULL,
  `New_Value` text NOT NULL,
  `Status` enum('Submitted','Accepted','Updated','Rejected') NOT NULL,
  `TID` varchar(10) NOT NULL,
  `Message` varchar(200) NOT NULL DEFAULT 'No Messages Specified',
  `Reason` varchar(200) NOT NULL DEFAULT 'No Reason Specified',
  `Request_Date` date NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`Request_ID`, `SID`, `Field_Name`, `Old_Value`, `New_Value`, `Status`, `TID`, `Message`, `Reason`, `Request_Date`, `CreatedAt`) VALUES
(1, 'SID2024504', 'Name', 'Muthu', 'Krishnan', 'Updated', 'TID2024101', 'No Messages Specified', 'No Reason Specified', '2024-02-28', '2024-02-28 11:53:06'),
(2, 'SID2024905', 'Gender', 'Male', 'Female', 'Updated', 'TID2024101', 'No Messages Specified', 'No Reason Specified', '2024-02-28', '2024-02-28 11:59:54'),
(3, 'SID2024504', 'Name', 'Muthu', 'Muthukrishnan', 'Updated', 'TID2024101', 'Please Update Mam', 'No Reason Specified', '2024-03-05', '2024-03-05 11:47:56'),
(4, 'SID2024504', 'Gender', 'Female', 'Male', 'Updated', 'TID2024101', 'I want to change my gender ', 'No Reason Specified', '2024-03-05', '2024-03-05 12:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `request2`
--

CREATE TABLE `request2` (
  `Request_ID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Field_Name` varchar(30) NOT NULL,
  `Old_Value` text NOT NULL,
  `New_Value` text NOT NULL,
  `Status` enum('Submitted','Accepted','Updated','Rejected') NOT NULL,
  `TID` varchar(10) NOT NULL,
  `Message` varchar(200) NOT NULL DEFAULT 'No Messages Specified',
  `Reason` varchar(200) NOT NULL DEFAULT 'No Reason Specified',
  `Request_Date` date NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residential`
--

CREATE TABLE `residential` (
  `RID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Address` text NOT NULL,
  `Taluk` varchar(30) NOT NULL,
  `District` varchar(25) NOT NULL,
  `State` varchar(25) NOT NULL,
  `Country` varchar(30) NOT NULL DEFAULT 'INDIA',
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `residential`
--

INSERT INTO `residential` (`RID`, `SID`, `Address`, `Taluk`, `District`, `State`, `Country`, `CreatedOn`) VALUES
(3, 'SID2024504', '22, North Street,\r\nSrivai', 'Srivaikuntam', 'Thoothukudi', 'Tamil Nadu', 'INDIA', '2024-01-06 08:21:44'),
(5, 'SID2024905', '11232', '132321', 'Andhra1', 'Andhra Pradesh', 'INDIA', '2024-01-06 08:45:05'),
(15, 'SID2024507', '757, 19th Cross Street,\r\nKodeeshwaran nagar.', 'Tirunelveli', 'Tirunelveli', 'Tamil Nadu', 'INDIA', '2024-02-08 12:45:07'),
(17, 'SID2024729', '22, North Street.', 'Srivai', 'Chennai', 'Tamil Nadu', 'INDIA', '2024-02-19 11:52:09'),
(18, 'SID2024528', '22, North Street, Xavier\'s', 'Srivaikuntam', 'Tirunelveli', 'Tamil Nadu', 'INDIA', '2024-03-13 09:32:08'),
(19, 'SID2024234', '22, Palayamkottai', 'Srivaikuntam', 'Chennai', 'Tamil Nadu', 'INDIA', '2024-03-13 10:00:34'),
(21, 'SID2024851', '22, North Srivai.', 'Srivai', 'Thoothukudi', 'Tamil Nadu', 'INDIA', '2024-03-19 12:50:51'),
(22, 'SID2024027', '22, North Street.', 'Srivaikuntam', 'Thoothukudi', 'Tamil Nadu', 'INDIA', '2024-03-19 12:53:47'),
(23, 'SID2024963', '11/A Nesanainar street palayamkottai tirunelveli 627002', 'kattanayapuram', 'Tirunelveli', 'Tamil Nadu', 'INDIA', '2024-03-20 08:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE `scholarship` (
  `ScholarshipID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `ScholarshipName` varchar(50) NOT NULL,
  `Amount` bigint(7) NOT NULL,
  `IssuedDate` date NOT NULL,
  `ScholarshipType` varchar(20) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`ScholarshipID`, `SID`, `ScholarshipName`, `Amount`, `IssuedDate`, `ScholarshipType`, `CreatedOn`) VALUES
(3, 'SID2024504', 'Adi-Dravidar Scholarhip', 3308, '2024-01-09', 'Government', '2024-01-06 08:21:44'),
(5, 'SID2024905', 'Adi-Dravidar Scholarhip', 12345, '2024-01-03', 'Government', '2024-01-06 08:45:05'),
(15, 'SID2024507', 'Post-Matric Scholarship', 2000, '2024-02-02', 'Government', '2024-02-08 12:45:07'),
(17, 'SID2024729', 'Post-Matric Scholarship', 20000, '2024-02-07', 'Government', '2024-02-19 11:52:09'),
(18, 'SID2024528', 'Post-Matric Scholarship', 20000, '2024-03-07', 'Government', '2024-03-13 09:32:08'),
(19, 'SID2024234', 'Post-Matric Scholarship', 200000, '2024-03-07', 'Government', '2024-03-13 10:00:34'),
(21, 'SID2024851', 'Post-Matric Scholarship', 20000, '2024-03-07', 'Government', '2024-03-19 12:50:51'),
(22, 'SID2024027', 'Post-Matric Scholarship', 20000, '2024-03-13', 'Government', '2024-03-19 12:53:47'),
(23, 'SID2024963', 'Adi-Dravidar Scholarhip', 50000, '2023-01-01', 'Government', '2024-03-20 08:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `school_subjects`
--

CREATE TABLE `school_subjects` (
  `Subject_ID` int(11) NOT NULL,
  `Subject_Title` varchar(50) NOT NULL,
  `Subject_Type` varchar(15) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `school_subjects`
--

INSERT INTO `school_subjects` (`Subject_ID`, `Subject_Title`, `Subject_Type`, `CreatedOn`) VALUES
(1, 'Tamil', 'Theory', '2024-02-06 10:23:34'),
(2, 'English', 'Theory', '2024-02-06 10:23:34'),
(3, 'Mathematics', 'Theory', '2024-02-06 10:23:34'),
(4, 'Physics', 'Theory', '2024-02-06 10:23:34'),
(5, 'Chemistry', 'Theory', '2024-02-06 10:23:34'),
(6, 'Biology', 'Theory', '2024-02-06 10:23:34'),
(7, 'Computer Science', 'Theory', '2024-02-06 10:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `sem_marks`
--

CREATE TABLE `sem_marks` (
  `Mark_ID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `DID` int(11) NOT NULL,
  `Semester` int(2) NOT NULL,
  `Marks` varchar(530) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sem_marks`
--

INSERT INTO `sem_marks` (`Mark_ID`, `SID`, `DID`, `Semester`, `Marks`, `CreatedOn`) VALUES
(16, 'SID2024905', 1, 1, '{\"Java-Theory\":\"67\"}', '2024-03-16 10:54:01'),
(19, 'SID2024504', 1, 2, '{\"Python-Theory\":\"88\"}', '2024-03-16 11:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `sslc`
--

CREATE TABLE `sslc` (
  `Mark_ID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Tamil` int(3) NOT NULL,
  `English` int(3) NOT NULL,
  `Mathematics` int(3) NOT NULL,
  `Science` int(3) NOT NULL,
  `Social_Science` int(3) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sslc`
--

INSERT INTO `sslc` (`Mark_ID`, `SID`, `Tamil`, `English`, `Mathematics`, `Science`, `Social_Science`, `CreatedOn`) VALUES
(5, 'SID2024905', 78, 8, 66, 55, 78, '2024-02-06 10:04:24'),
(7, 'SID2024504', 77, 88, 78, 90, 89, '2024-02-20 09:19:07'),
(8, 'SID2024729', 80, 80, 80, 80, 80, '2024-03-20 08:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `SID` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Dob` date NOT NULL,
  `Gender` varchar(12) NOT NULL,
  `Aadhaar` bigint(20) NOT NULL,
  `Phone` bigint(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `FatherName` varchar(30) NOT NULL,
  `MotherName` varchar(30) NOT NULL,
  `FatherOccupation` varchar(30) NOT NULL,
  `MotherOccupation` varchar(30) NOT NULL,
  `FPhone` bigint(11) NOT NULL,
  `MPhone` bigint(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(10) NOT NULL DEFAULT 'Admin',
  `Who` varchar(10) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`SID`, `Name`, `File`, `Dob`, `Gender`, `Aadhaar`, `Phone`, `Email`, `FatherName`, `MotherName`, `FatherOccupation`, `MotherOccupation`, `FPhone`, `MPhone`, `CreatedOn`, `CreatedBy`, `Who`) VALUES
('SID2024027', 'Krishnan', 'SID2024027.png', '2009-03-14', 'Male', 343232322322, 9988888442, 'krishnam@gmail.com', 'Muthu', 'Mother', 'Driver', 'Driver', 8098088998, 6545455454, '2024-03-19 12:53:47', 'TID2024102', 'student'),
('SID2024234', 'Muthukrishnan M', 'SID2024234.jpg', '2005-02-09', 'Male', 767676838889, 7577776777, 'muths@gmail.com', 'Father', 'Mother', 'Driver', 'Mother', 9089080985, 9800808086, '2024-03-13 10:00:34', 'TID2024101', 'student'),
('SID2024504', 'Krishnan', 'SID2024504.png', '2004-01-04', 'Male', 798794879843, 1244234124, 'muthu@gmail.com', 'Muthuvinayagam M', 'Thamarai Selvi M', 'Driver', 'Thamarai Selvi M', 9443584007, 9489004987, '2024-01-06 08:21:44', 'Admin', 'student'),
('SID2024507', 'Fathima Hena', 'SID2024507.jpg', '2003-08-18', 'Female', 748382323232, 1244223232, 'hena2@gmail.com', 'Ismail', 'Thanu', 'Business', 'Thanu', 9789140233, 9443584034, '2024-02-08 12:45:07', 'Admin', 'student'),
('SID2024528', 'Muthukrishnan M', 'SID2024528.png', '2009-03-13', 'Male', 908098090800, 4324324324, 'muthus@gmail.com', 'Muthuvinayagam', 'Thamarai selvi', 'Driver', 'Thamarai selvi', 9089080980, 9800808086, '2024-03-13 09:32:08', 'TID2024101', 'student'),
('SID2024729', 'NewOne', 'SID2024729.jpg', '2009-02-06', 'Male', 342131231231, 9090909090, 'm@gmail.com', 'Father', 'Mother', 'Driver', 'Driver', 978914023, 1244234123, '2024-02-19 11:52:09', 'TID2024101', 'student'),
('SID2024851', 'Krishnan', 'SID2024851.png', '2009-03-06', 'Male', 343213123123, 9090090023, 'krish@gmail.com', 'Muthu', 'Mother', 'Driver', 'Driver', 8098088998, 6545455454, '2024-03-19 12:50:51', 'TID2024101', 'student'),
('SID2024905', 'Krish', 'SID2024905.png', '2009-01-01', 'Female', 748388643432, 1244233423, 'muthuabi@gmail.com1', 'ge', 'rte', 'None', 'rte', 2312443243, 2343124432, '2024-01-06 08:45:05', 'Admin', 'student'),
('SID2024963', 'Sukas A S', 'SID2024963.jpg', '2003-09-24', 'Male', 878795785749, 9847594857, 'sukas123@gmail.com', 'John', 'Stella', 'Collector', 'Collector', 8475687457, 9847983579, '2024-03-20 08:36:03', 'TID2024101', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TID` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Photo` varchar(30) NOT NULL,
  `Dob` date NOT NULL,
  `Gender` varchar(12) NOT NULL,
  `Aadhar` bigint(12) NOT NULL,
  `Phone` bigint(11) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Pincode` int(6) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `Who` varchar(10) NOT NULL DEFAULT 'teacher'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`TID`, `Name`, `Photo`, `Dob`, `Gender`, `Aadhar`, `Phone`, `Address`, `Pincode`, `Email`, `Password`, `CreatedOn`, `Who`) VALUES
('TID2024101', 'Sukas', 'TID2024101.jpg', '1984-02-08', 'Male', 809839080933, 9054672311, '', 0, 'sukas@gmail.com', 'teacher', '2024-01-18 10:33:03', 'teacher'),
('TID2024102', 'Sukas', 'TID2024102.jpg', '1984-02-08', 'Male', 809839080933, 9054672311, '', 0, 'sukas@gmail.com', '54321', '2024-01-18 10:33:03', 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `teacherdetails`
--

CREATE TABLE `teacherdetails` (
  `TDetailsID` int(10) NOT NULL,
  `TID` varchar(10) NOT NULL,
  `Degree` varchar(30) NOT NULL,
  `DoR` date NOT NULL,
  `Maritial_Status` varchar(10) NOT NULL,
  `Salary` bigint(10) NOT NULL,
  `Designation` varchar(20) NOT NULL,
  `DID` int(11) NOT NULL,
  `CID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teacherdetails`
--

INSERT INTO `teacherdetails` (`TDetailsID`, `TID`, `Degree`, `DoR`, `Maritial_Status`, `Salary`, `Designation`, `DID`, `CID`) VALUES
(1, 'TID2024101', 'Bsc', '2024-02-01', 'Unmarried', 2000, 'Professor', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `year_update`
--

CREATE TABLE `year_update` (
  `Batch` year(4) NOT NULL,
  `First` date NOT NULL,
  `Second` date NOT NULL,
  `Third` date NOT NULL,
  `CreatedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicdetails`
--
ALTER TABLE `academicdetails`
  ADD PRIMARY KEY (`AID`),
  ADD KEY `fk_aid_did` (`DID`),
  ADD KEY `fk_student_academic` (`SID`),
  ADD KEY `fk_aid_cid` (`CID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMINID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`Attendance_ID`),
  ADD UNIQUE KEY `unique_keys` (`SID`,`Date`,`Hour`,`Year`),
  ADD KEY `fk_attendance_department` (`DID`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `communication`
--
ALTER TABLE `communication`
  ADD PRIMARY KEY (`CommunID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DID`),
  ADD UNIQUE KEY `uniq_ness` (`DName`,`CID`),
  ADD KEY `fk_dept_cid` (`CID`);

--
-- Indexes for table `dept_subjects`
--
ALTER TABLE `dept_subjects`
  ADD PRIMARY KEY (`Subject_ID`),
  ADD KEY `fk_dept_department` (`DID`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`Document_ID`),
  ADD KEY `Student-Document` (`SID`);

--
-- Indexes for table `hse`
--
ALTER TABLE `hse`
  ADD PRIMARY KEY (`Mark_ID`),
  ADD UNIQUE KEY `unique_ids` (`SID`,`Subject_ID`),
  ADD KEY `fk_hse_sub` (`Subject_ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Message_ID`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`Notice_ID`);

--
-- Indexes for table `password`
--
ALTER TABLE `password`
  ADD PRIMARY KEY (`PID`),
  ADD KEY `fk_student_pass` (`SID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`Request_ID`),
  ADD UNIQUE KEY `unique_request` (`SID`,`Field_Name`,`Request_Date`),
  ADD KEY `fk_request_teacher` (`TID`);

--
-- Indexes for table `request2`
--
ALTER TABLE `request2`
  ADD PRIMARY KEY (`Request_ID`),
  ADD UNIQUE KEY `unique_request` (`SID`,`Field_Name`,`Request_Date`),
  ADD KEY `fk_request_teacher` (`TID`);

--
-- Indexes for table `residential`
--
ALTER TABLE `residential`
  ADD PRIMARY KEY (`RID`),
  ADD KEY `fk_student_resident` (`SID`);

--
-- Indexes for table `scholarship`
--
ALTER TABLE `scholarship`
  ADD PRIMARY KEY (`ScholarshipID`),
  ADD KEY `fk_student_scholar` (`SID`);

--
-- Indexes for table `school_subjects`
--
ALTER TABLE `school_subjects`
  ADD PRIMARY KEY (`Subject_ID`);

--
-- Indexes for table `sem_marks`
--
ALTER TABLE `sem_marks`
  ADD PRIMARY KEY (`Mark_ID`),
  ADD UNIQUE KEY `uniq_ness` (`SID`,`Semester`);

--
-- Indexes for table `sslc`
--
ALTER TABLE `sslc`
  ADD PRIMARY KEY (`Mark_ID`),
  ADD UNIQUE KEY `SID` (`SID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`SID`) USING BTREE,
  ADD UNIQUE KEY `UN1` (`Aadhaar`) USING BTREE,
  ADD UNIQUE KEY `UN2` (`Email`) USING BTREE,
  ADD UNIQUE KEY `UN3` (`Phone`) USING BTREE;

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TID`);

--
-- Indexes for table `teacherdetails`
--
ALTER TABLE `teacherdetails`
  ADD PRIMARY KEY (`TDetailsID`),
  ADD KEY `fk_teacher_college` (`CID`),
  ADD KEY `fk_dept_teacher` (`DID`),
  ADD KEY `fk_teacher_tdetails` (`TID`);

--
-- Indexes for table `year_update`
--
ALTER TABLE `year_update`
  ADD PRIMARY KEY (`Batch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicdetails`
--
ALTER TABLE `academicdetails`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `Attendance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `communication`
--
ALTER TABLE `communication`
  MODIFY `CommunID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dept_subjects`
--
ALTER TABLE `dept_subjects`
  MODIFY `Subject_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `Document_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hse`
--
ALTER TABLE `hse`
  MODIFY `Mark_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `Notice_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password`
--
ALTER TABLE `password`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request2`
--
ALTER TABLE `request2`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residential`
--
ALTER TABLE `residential`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `ScholarshipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `school_subjects`
--
ALTER TABLE `school_subjects`
  MODIFY `Subject_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sem_marks`
--
ALTER TABLE `sem_marks`
  MODIFY `Mark_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sslc`
--
ALTER TABLE `sslc`
  MODIFY `Mark_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teacherdetails`
--
ALTER TABLE `teacherdetails`
  MODIFY `TDetailsID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academicdetails`
--
ALTER TABLE `academicdetails`
  ADD CONSTRAINT `fk_aid_cid` FOREIGN KEY (`CID`) REFERENCES `college` (`CID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aid_did` FOREIGN KEY (`DID`) REFERENCES `department` (`DID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_academic` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_department` FOREIGN KEY (`DID`) REFERENCES `department` (`DID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_attendance_student` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `fk_dept_cid` FOREIGN KEY (`CID`) REFERENCES `college` (`CID`) ON UPDATE CASCADE;

--
-- Constraints for table `dept_subjects`
--
ALTER TABLE `dept_subjects`
  ADD CONSTRAINT `fk_dept_department` FOREIGN KEY (`DID`) REFERENCES `department` (`DID`) ON UPDATE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `Student-Document` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON UPDATE CASCADE;

--
-- Constraints for table `hse`
--
ALTER TABLE `hse`
  ADD CONSTRAINT `fk_hse_student` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hse_sub` FOREIGN KEY (`Subject_ID`) REFERENCES `school_subjects` (`Subject_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `password`
--
ALTER TABLE `password`
  ADD CONSTRAINT `fk_student_pass` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `fk_request_student` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_teacher` FOREIGN KEY (`TID`) REFERENCES `teacher` (`TID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `residential`
--
ALTER TABLE `residential`
  ADD CONSTRAINT `fk_student_resident` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scholarship`
--
ALTER TABLE `scholarship`
  ADD CONSTRAINT `fk_student_scholar` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sslc`
--
ALTER TABLE `sslc`
  ADD CONSTRAINT `fk_sslc_student` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacherdetails`
--
ALTER TABLE `teacherdetails`
  ADD CONSTRAINT `fk_dept_teacher` FOREIGN KEY (`DID`) REFERENCES `department` (`DID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teacher_college` FOREIGN KEY (`CID`) REFERENCES `college` (`CID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teacher_tdetails` FOREIGN KEY (`TID`) REFERENCES `teacher` (`TID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
