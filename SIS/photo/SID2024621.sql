-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 07:04 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicdetails`
--

CREATE TABLE `academicdetails` (
  `AID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Batch` year(4) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Achievements` varchar(100) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DID` int(11) NOT NULL,
  `CID` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academicdetails`
--

INSERT INTO `academicdetails` (`AID`, `SID`, `Batch`, `Type`, `Status`, `Achievements`, `CreatedOn`, `DID`, `CID`) VALUES
(14, 'SID2024504', 2024, 'College', 'InActive', '', '2024-01-06 08:21:44', 1, 'CID2302'),
(16, 'SID2024905', 2024, 'College', 'active', '', '2024-01-06 08:45:05', 3, 'CID2302'),
(17, 'SID2024525', 2024, 'College', 'Active', '', '2024-01-24 09:58:45', 1, 'CID2302'),
(18, 'SID2024704', 2024, 'College', 'Active', '', '2024-01-24 10:01:44', 1, 'CID2302');

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
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMINID`, `Name`, `Email`, `Level`, `Password`, `CreatedOn`) VALUES
('ADMIN24101', 'Muthukrishnan', 'muthuabi292@gmail.com', 'Primary', 'Muthu123', '2024-01-19 08:59:29'),
('ADMIN24102', 'Sukas', 'sukas@gmail.com', 'Secondary', 'Sukas123', '2024-01-19 08:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `CID` varchar(7) NOT NULL,
  `CName` varchar(50) NOT NULL,
  `CLocation` varchar(70) NOT NULL,
  `Pincode` int(6) NOT NULL,
  `Established` date NOT NULL,
  `Principal` varchar(30) NOT NULL,
  `ContactNumber` bigint(11) NOT NULL,
  `ContactMail` varchar(50) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`CID`, `CName`, `CLocation`, `Pincode`, `Established`, `Principal`, `ContactNumber`, `ContactMail`, `CreatedOn`) VALUES
('CID1102', 'St John\'s College', 'Palayamkottai, Tirunelveli.', 627002, '1911-12-11', 'John Britto', 9334562345, 'johnsprince@gmail.com', '2023-12-14 12:01:03'),
('CID2302', 'St Xavier\'s College of Arts and Science', 'Palayamkottai, Tirnunelveli', 627002, '1923-12-11', 'Mariadoss S', 9034562345, 'sxcprince@gmail.com', '2023-12-14 11:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `communication`
--

CREATE TABLE `communication` (
  `CommunID` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `TID` varchar(10) NOT NULL,
  `MessageType` varchar(20) NOT NULL,
  `ChatTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DID` int(11) NOT NULL,
  `DName` varchar(30) NOT NULL,
  `DHead` varchar(30) NOT NULL,
  `DStartDate` date NOT NULL,
  `NoStudents` int(3) NOT NULL,
  `NoTeachers` int(3) NOT NULL,
  `CID` varchar(7) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DID`, `DName`, `DHead`, `DStartDate`, `NoStudents`, `NoTeachers`, `CID`, `CreatedOn`) VALUES
(1, 'BSC COMPUTER SCIENCE', 'Rajakumar T C', '2013-12-05', 50, 6, 'CID2302', '2023-12-14 12:04:38'),
(2, 'BSC COMPUTER SCIENCE', 'Johnson', '2012-12-13', 45, 7, 'CID1102', '2023-12-14 12:04:38'),
(3, 'BSC CHEMISTRY', 'Ruban', '2011-12-05', 50, 6, 'CID2302', '2023-12-14 12:06:29'),
(4, 'BSC PHYSICS', 'John', '2015-12-13', 45, 7, 'CID1102', '2023-12-14 12:06:29');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `Document_ID` int(11) NOT NULL,
  `Document_Name` varchar(20) NOT NULL,
  `Document_Path` varchar(70) NOT NULL,
  `SID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE `password` (
  `PID` int(11) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Passtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password`
--

INSERT INTO `password` (`PID`, `Password`, `SID`, `Passtime`) VALUES
(2, '12345', 'SID2024504', '2024-01-09 12:51:45'),
(6, '12345', 'SID2024905', '2024-01-09 12:53:12'),
(7, 'PD65b091fd', 'SID2024525', '2024-01-24 09:58:45'),
(8, 'PD65b092b0', 'SID2024704', '2024-01-24 10:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `SID` varchar(10) NOT NULL,
  `Field_Name` varchar(30) NOT NULL,
  `New_Value` text NOT NULL,
  `Status` varchar(20) NOT NULL,
  `TID` varchar(10) NOT NULL,
  `Reason` text NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `residential`
--

INSERT INTO `residential` (`RID`, `SID`, `Address`, `Taluk`, `District`, `State`, `Country`, `CreatedOn`) VALUES
(3, 'SID2024504', '22, North Street,\r\nSrivai', 'Srivaikuntam', 'Thoothukudi', 'Tamil Nadu', 'INDIA', '2024-01-06 08:21:44'),
(5, 'SID2024905', '11232', '132321', 'Andhra1', 'Andhra Pradesh', 'INDIA', '2024-01-06 08:45:05'),
(6, 'SID2024525', '22, North', 'Srivaikuntam', 'Andhra1', 'Andhra Pradesh', 'INDIA', '2024-01-24 09:58:45'),
(7, 'SID2024704', 'North', 'Samana', 'Thiruvanathapuram', 'Kerala', 'INDIA', '2024-01-24 10:01:44');

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
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`ScholarshipID`, `SID`, `ScholarshipName`, `Amount`, `IssuedDate`, `ScholarshipType`, `CreatedOn`) VALUES
(3, 'SID2024504', 'Adi-Dravidar Scholarhip', 3308, '2024-01-09', 'Government', '2024-01-06 08:21:44'),
(5, 'SID2024905', 'Adi-Dravidar Scholarhip', 12345, '2024-01-03', 'Government', '2024-01-06 08:45:05'),
(6, 'SID2024525', 'Pre-Matric Scholarship', 2000, '2024-01-19', 'Government', '2024-01-24 09:58:45'),
(7, 'SID2024704', 'Pre-Matric Scholarship', 20000, '2024-01-19', 'Government', '2024-01-24 10:01:44');

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
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(10) NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`SID`, `Name`, `File`, `Dob`, `Gender`, `Aadhaar`, `Phone`, `Email`, `FatherName`, `MotherName`, `FatherOccupation`, `MotherOccupation`, `FPhone`, `MPhone`, `CreatedOn`, `CreatedBy`) VALUES
('SID2024504', 'Muthukrishnan M', 'SID2024504.jpg', '2004-04-01', 'Male', 798794879843, 1244234124, 'muthuabi@gmail.com', 'Muthuvinayagam M', 'Thamarai Selvi M', 'Driver', 'Thamarai Selvi M', 9443584008, 9489004987, '2024-01-06 08:21:44', 'Admin'),
('SID2024525', 'Krishnan', 'SID2024525.tif', '2009-01-09', 'Male', 809809809808, 8008098080, 'muthuai@gmail.com', 'Vionayah', 'Thamarai', 'Driver', 'Driver', 8080988080, 2343243124, '2024-01-24 09:58:45', 'Admin'),
('SID2024704', 'Krishnan', 'SID2024704.tif', '0000-00-00', 'Male', 809804809808, 8008122808, 'muthua@gmail.com', 'Vionayah', 'Thamarai', 'Driver', 'Driver', 8080988080, 2343243124, '2024-01-24 10:01:44', 'Admin'),
('SID2024905', 'Krish', 'SID2024905.png', '2009-01-01', 'Male', 7483886, 1244233, 'muthuabi@gmail.com1', 'ge', 'rte', 'None', 'None', 23124, 2343124, '2024-01-06 08:45:05', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TID` varchar(10) NOT NULL,
  `TName` varchar(30) NOT NULL,
  `Dob` date NOT NULL,
  `Gender` varchar(12) NOT NULL,
  `Aadhar` bigint(12) NOT NULL,
  `Phone` bigint(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `FatherName` varchar(30) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`TID`, `TName`, `Dob`, `Gender`, `Aadhar`, `Phone`, `Email`, `FatherName`, `Password`, `CreatedOn`) VALUES
('TID2024101', 'Sukas', '1984-02-08', 'Male', 809839080933, 9054672311, 'sukas@gmail.com', 'Sukas Father', '12345', '2024-01-18 10:33:03'),
('TID2024102', 'Sukas', '1984-02-08', 'Male', 809839080933, 9054672311, 'sukas@gmail.com', 'Sukas Father', '54321', '2024-01-18 10:33:03');

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
  `CID` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicdetails`
--
ALTER TABLE `academicdetails`
  ADD PRIMARY KEY (`AID`),
  ADD KEY `fk_aid_did` (`DID`),
  ADD KEY `fk_aid_cid` (`CID`),
  ADD KEY `fk_student_academic` (`SID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMINID`);

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
  ADD KEY `fk_dept_college` (`CID`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`Document_ID`),
  ADD KEY `Student-Document` (`SID`);

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
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_request_student` (`SID`),
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
  ADD KEY `fk_teacher_college` (`CID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicdetails`
--
ALTER TABLE `academicdetails`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `Document_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password`
--
ALTER TABLE `password`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residential`
--
ALTER TABLE `residential`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `ScholarshipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacherdetails`
--
ALTER TABLE `teacherdetails`
  MODIFY `TDetailsID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academicdetails`
--
ALTER TABLE `academicdetails`
  ADD CONSTRAINT `fk_aid_cid` FOREIGN KEY (`CID`) REFERENCES `college` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aid_did` FOREIGN KEY (`DID`) REFERENCES `department` (`DID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_academic` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `fk_dept_college` FOREIGN KEY (`CID`) REFERENCES `college` (`CID`);

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `Student-Document` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON UPDATE CASCADE;

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
-- Constraints for table `teacherdetails`
--
ALTER TABLE `teacherdetails`
  ADD CONSTRAINT `fk_teacher_college` FOREIGN KEY (`CID`) REFERENCES `college` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
