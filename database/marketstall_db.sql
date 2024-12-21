-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 10:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketstall_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE `account_tbl` (
  `AccountID` int(11) NOT NULL,
  `StallholderID` int(11) DEFAULT NULL,
  `Roles` int(11) UNSIGNED NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`AccountID`, `StallholderID`, `Roles`, `Username`, `Password`, `Token`) VALUES
(1, 1, 2, 'hozwe', '$2y$10$YTZkNmUzZTg3ZmU3NjJlMux1DEMWM3o/n/Lv2pkTJFhJYTt41AL52', 'Y2FhMjVjYjM1NTM5MTcyNDljYzI3M2Y4MjUwYzY0MGVkODI5NWU3ZGUyZjFhM2RkNTYwN2IwMzYzOWM1N2ExMA=='),
(2, 2, 2, 'chi', '$2y$10$Y2IzYTk5YThhZjIxNzMzOONcpYtG.SWIZbPnk3TJTgm6v68/fz4kC', 'ZDk4YjQyMTAwZjFhMzYzYWJmNGVlNDlmOTA3ODU5MDRmN2M1NzEzNTkwNzg0MTFlYjNiMjE0YmIzZTk0MGRkZg=='),
(3, 3, 1, 'noteltel', '$2y$10$MGUzYTQzY2Q1ZmJlMWJiYu4Ul4Lx6sKuWse.tTgEyTQTLitFjuSQe', 'YjQ3MzI3NzI2NDNlZTE4N2UwODAwY2QzNzVlMDVjOWFmMmM1NDVjNmE1YjQ0YjNlMGY5MDBiYWNmMWZkN2U2NA=='),
(4, 4, 1, 'chuchi', 'chuchi123', NULL),
(7, 6, 2, 'anna', '$2y$10$ZWUxMDdlMDlhZTQyODgyYOvggsAXnc3OIjZgRBqLhDV/CyzajdeAi', 'MmM3MmFlZjM1NDljZmY0Mzk1NWZhNmI1YjU1NWM2ODYzMDhkNGIwNmJkMGNhODY4MmNjNmY1OWM4YmY0YmNmMg=='),
(15, NULL, 1, 'aid3', '$2y$10$M2I2NTllMmY3ZWM2OWNkNeDB0MoXyr6gmafe7GceX0BJPwxCCtAOu', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImFwcCI6Ik1hcmtldCBTdGFsbCBSZXNlcnZhdGlvbiBNYW5hZ2VtZW50IFN5c3RlbSJ9.eyJ1c2VyX2lkIjoiMTUiLCJ1c2VybmFtZSI6ImFpZDMifQ==.YjBiNjZhODk5OWY0M2YxMDQ4NzI1OGNhZDA2ODMwMWVkNzg0NWE0ZmI3YzliNjIwZjdjMDI2N2E4YzBkNGYzMw=='),
(16, NULL, 2, 'diego', '$2y$10$Njg1ZGIxZGM0NTljMWM0ZOCllI1baCp/dvqQesXbTFcwdKjGu/Yoe', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImFwcCI6Ik1hcmtldCBTdGFsbCBSZXNlcnZhdGlvbiBNYW5hZ2VtZW50IFN5c3RlbSJ9.eyJ1c2VyX2lkIjoiMTYiLCJ1c2VybmFtZSI6ImRpZWdvIn0=.ZTgxZjE0MWU5MmJhYWJlNzAzN2ViZmNiMjI2ZTE4N2FhYzU5NDg5MThmMGVlN2Y5NDgyMzI5Yjc5ODkwZmMxNw==');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_tbl`
--

CREATE TABLE `reservation_tbl` (
  `ReservationID` int(11) NOT NULL,
  `StallholderID` int(11) NOT NULL,
  `StallID` int(11) NOT NULL,
  `ReservationStartDate` date DEFAULT NULL,
  `ReservationEndDate` date DEFAULT NULL,
  `ReservationStatus` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reservation_tbl`
--

INSERT INTO `reservation_tbl` (`ReservationID`, `StallholderID`, `StallID`, `ReservationStartDate`, `ReservationEndDate`, `ReservationStatus`) VALUES
(1, 1, 1, '2024-01-08', '2024-02-23', '0'),
(2, 2, 2, '2024-03-10', '2024-03-19', '0'),
(3, 3, 3, '2024-04-03', '2024-04-20', '0'),
(4, 4, 4, '2024-05-17', '2024-05-24', '0'),
(5, 5, 5, '2024-06-17', '2024-06-24', '0'),
(6, 6, 6, '2024-07-01', '2024-07-20', '1'),
(7, 7, 7, '2024-08-01', '2024-09-01', '1'),
(8, 8, 8, '2024-10-13', '2024-10-27', '1'),
(9, 9, 9, '2024-10-28', '2024-11-10', '2'),
(10, 10, 10, '2024-11-17', '2024-11-29', '2');

-- --------------------------------------------------------

--
-- Table structure for table `roles_tbl`
--

CREATE TABLE `roles_tbl` (
  `RolesID` int(11) UNSIGNED NOT NULL,
  `RoleName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles_tbl`
--

INSERT INTO `roles_tbl` (`RolesID`, `RoleName`) VALUES
(1, 'admin'),
(2, 'stallholder');

-- --------------------------------------------------------

--
-- Table structure for table `stallholder_tbl`
--

CREATE TABLE `stallholder_tbl` (
  `StallholderID` int(11) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `StallNo` varchar(100) DEFAULT NULL,
  `isActive` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stallholder_tbl`
--

INSERT INTO `stallholder_tbl` (`StallholderID`, `FirstName`, `LastName`, `StallNo`, `isActive`) VALUES
(1, 'Chi', 'Balong', '01', '0'),
(2, 'Paolo', 'Rayala', '02', '0'),
(3, 'Allynson', 'Ibanez', '03', '0'),
(4, 'Jerald', 'Pangan', '04', '0'),
(5, 'Stephanie', 'Caseja', '05', '0'),
(6, 'Allyson', 'Soritcho', '06', '1'),
(7, 'Jeff Lyrio', 'Dela Rea', '07', '1'),
(8, 'Cristina', 'Alipio', '08', '1'),
(9, 'Rick', 'Consignado', '09', '1'),
(10, 'Marlene', 'Consibido', '010', '1'),
(12, 'Mathhew', 'Francia', '011', '0'),
(13, 'Anna', 'Sabanal', '012', '0');

-- --------------------------------------------------------

--
-- Table structure for table `stall_tbl`
--

CREATE TABLE `stall_tbl` (
  `StallID` int(11) NOT NULL,
  `StallholderID` int(11) DEFAULT NULL,
  `StallName` varchar(100) DEFAULT NULL,
  `StallNumber` varchar(100) DEFAULT NULL,
  `isAvailable` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stall_tbl`
--

INSERT INTO `stall_tbl` (`StallID`, `StallholderID`, `StallName`, `StallNumber`, `isAvailable`) VALUES
(1, 1, 'AlingNenaKakanin', '01', '1'),
(2, 2, 'FreshMelon', '02', '1'),
(3, 3, 'BukoJuice', '03', '1'),
(4, 4, 'SagingSaba', '04', '1'),
(5, 5, 'FreshNiyog', '05', '1'),
(6, 6, 'HotdogMainit', '06', '1'),
(7, NULL, NULL, '07', '0'),
(8, NULL, NULL, '08', '0'),
(9, NULL, NULL, '09', '0'),
(10, NULL, NULL, '010', '0'),
(11, NULL, NULL, '011', '0'),
(12, NULL, NULL, '012', '0'),
(13, NULL, NULL, '013', '0'),
(14, NULL, NULL, '014', '0'),
(15, NULL, NULL, '015', '0'),
(16, NULL, NULL, '016', '0'),
(17, NULL, NULL, '017', '0'),
(18, NULL, NULL, '018', '0'),
(19, NULL, NULL, '019', '0'),
(20, NULL, NULL, '020', '0'),
(21, NULL, NULL, '021', '0');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_tbl`
--

CREATE TABLE `transaction_tbl` (
  `TransactionID` int(11) NOT NULL,
  `StallholderID` int(11) NOT NULL,
  `Amount` decimal(10,0) NOT NULL,
  `Status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction_tbl`
--

INSERT INTO `transaction_tbl` (`TransactionID`, `StallholderID`, `Amount`, `Status`) VALUES
(1, 1, 1000, '0'),
(2, 2, 1500, '0'),
(3, 3, 2000, '0'),
(4, 4, 3000, '0'),
(5, 5, 3500, '0'),
(6, 6, 4000, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD PRIMARY KEY (`AccountID`),
  ADD KEY `role` (`Roles`);

--
-- Indexes for table `reservation_tbl`
--
ALTER TABLE `reservation_tbl`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `StallholderID` (`StallholderID`),
  ADD KEY `StallID` (`StallID`);

--
-- Indexes for table `roles_tbl`
--
ALTER TABLE `roles_tbl`
  ADD PRIMARY KEY (`RolesID`);

--
-- Indexes for table `stallholder_tbl`
--
ALTER TABLE `stallholder_tbl`
  ADD PRIMARY KEY (`StallholderID`),
  ADD UNIQUE KEY `StallNo` (`StallNo`),
  ADD KEY `StallNo_3` (`StallNo`);
ALTER TABLE `stallholder_tbl` ADD FULLTEXT KEY `StallNo_2` (`StallNo`);

--
-- Indexes for table `stall_tbl`
--
ALTER TABLE `stall_tbl`
  ADD PRIMARY KEY (`StallID`),
  ADD UNIQUE KEY `StallNumber` (`StallNumber`),
  ADD KEY `StallholderID` (`StallholderID`);

--
-- Indexes for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `StallholderID` (`StallholderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_tbl`
--
ALTER TABLE `account_tbl`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reservation_tbl`
--
ALTER TABLE `reservation_tbl`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles_tbl`
--
ALTER TABLE `roles_tbl`
  MODIFY `RolesID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stallholder_tbl`
--
ALTER TABLE `stallholder_tbl`
  MODIFY `StallholderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stall_tbl`
--
ALTER TABLE `stall_tbl`
  MODIFY `StallID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD CONSTRAINT `role` FOREIGN KEY (`Roles`) REFERENCES `roles_tbl` (`RolesID`);

--
-- Constraints for table `reservation_tbl`
--
ALTER TABLE `reservation_tbl`
  ADD CONSTRAINT `reservation_tbl_ibfk_1` FOREIGN KEY (`StallholderID`) REFERENCES `stallholder_tbl` (`StallholderID`),
  ADD CONSTRAINT `reservation_tbl_ibfk_2` FOREIGN KEY (`StallID`) REFERENCES `stall_tbl` (`StallID`);

--
-- Constraints for table `stall_tbl`
--
ALTER TABLE `stall_tbl`
  ADD CONSTRAINT `stall_tbl_ibfk_1` FOREIGN KEY (`StallholderID`) REFERENCES `stallholder_tbl` (`StallholderID`);

--
-- Constraints for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  ADD CONSTRAINT `transaction_tbl_ibfk_1` FOREIGN KEY (`StallholderID`) REFERENCES `stallholder_tbl` (`StallholderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
