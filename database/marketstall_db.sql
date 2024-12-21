-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 08:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `Roles` int(11) UNSIGNED NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`AccountID`, `Roles`, `Username`, `Password`, `Token`) VALUES
(16, 2, 'diego', '$2y$10$Njg1ZGIxZGM0NTljMWM0ZOCllI1baCp/dvqQesXbTFcwdKjGu/Yoe', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImFwcCI6Ik1hcmtldCBTdGFsbCBSZXNlcnZhdGlvbiBNYW5hZ2VtZW50IFN5c3RlbSJ9.eyJ1c2VyX2lkIjoiMTYiLCJ1c2VybmFtZSI6ImRpZWdvIn0=.ZTgxZjE0MWU5MmJhYWJlNzAzN2ViZmNiMjI2ZTE4N2FhYzU5NDg5MThmMGVlN2Y5NDgyMzI5Yjc5ODkwZmMxNw=='),
(17, 1, 'kristel', '$2y$10$OTYxNzU4NzgwM2RiYzMyYuUrRKREHiQiGtO6zsom.735/p07Uz4d2', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImFwcCI6Ik1hcmtldCBTdGFsbCBSZXNlcnZhdGlvbiBNYW5hZ2VtZW50IFN5c3RlbSJ9.eyJ1c2VyX2lkIjoiMTciLCJ1c2VybmFtZSI6ImtyaXN0ZWwifQ==.MzVhYjBkNzI4OTUwNTkyNWMyMjhjNWMwMDU5ZmYyN2ViMDZhNGM2YTRhMWU5ODUzYTU0ZjhjNzBkMTc2YjQzYQ=='),
(21, 2, 'josh', '$2y$10$ZThlOGJlOWVhYmNiNGZmNepdZ8Qh3yBBYs7XKnvPNgOYhO3Wv2tSW', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImFwcCI6Ik1hcmtldCBTdGFsbCBSZXNlcnZhdGlvbiBNYW5hZ2VtZW50IFN5c3RlbSJ9.eyJ1c2VyX2lkIjoiMjEiLCJ1c2VybmFtZSI6Impvc2gifQ==.MTZjZDdhNzM5NjAzN2MyNmI2YWZkZjM0ZWQ3OTRlMzdhMDNjODc5OTQ4OTUwYWIwYWYwYjk3OWY4NjFkZTc5YQ=='),
(22, 2, 'Paolo', '$2y$10$YTE2ODg5YjU0NzBiZmYwO.aopPbzhnGUpw5WDHhOFKd4wPVDFms5m', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImFwcCI6Ik1hcmtldCBTdGFsbCBSZXNlcnZhdGlvbiBNYW5hZ2VtZW50IFN5c3RlbSJ9.eyJ1c2VyX2lkIjoiMjIiLCJ1c2VybmFtZSI6IlBhb2xvIn0=.ZjhhN2RhYWFhNWFkODRlNGY2MTRmOGE1N2VjYTE4NmNiODZlNDlhNDJlZDNiMTQ3NzA4YjQ0OWE1NzMxMjI3NQ==');

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
(8, 8, 7, '2025-08-01', '2025-09-01', '2');

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
(8, 'Allyson', 'Soritcho', '08', '0'),
(18, 'Josh', 'Mojica', '06', '0'),
(19, 'Paolo', 'Bleh', '07', '0');

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
(6, NULL, NULL, NULL, '0'),
(7, NULL, NULL, NULL, '0'),
(8, 8, 'FriedChimken', '08', '1'),
(35, 18, 'PutoBlengBlong', '06', '1');

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
(5, 5, 3500, '0');

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
ALTER TABLE `stallholder_tbl` ADD FULLTEXT KEY `StallNo_4` (`StallNo`);

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
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reservation_tbl`
--
ALTER TABLE `reservation_tbl`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles_tbl`
--
ALTER TABLE `roles_tbl`
  MODIFY `RolesID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stallholder_tbl`
--
ALTER TABLE `stallholder_tbl`
  MODIFY `StallholderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stall_tbl`
--
ALTER TABLE `stall_tbl`
  MODIFY `StallID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
