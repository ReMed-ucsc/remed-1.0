-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: fdb1030.awardspace.net
-- Generation Time: Apr 20, 2025 at 06:02 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4510132_remed`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int NOT NULL,
  `DriverID` int NOT NULL,
  `DeliveryID` int NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `DriverID`, `DeliveryID`, `comment`) VALUES
(1, 123, 1001, 'done'),
(3, 1, 342, 'Special condition medications contained'),
(5, 1, 10, 'updated from mobile'),
(9, 1, 10, 'testing comment'),
(13, 1, 9, 'new comment'),
(14, 1, 9, 'delayed due to trafic'),
(16, 1, 10, 'new coment'),
(18, 1, 10, 'new comment from app'),
(19, 1, 10, 'new coment'),
(20, 1, 10, 'new coment');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `DeliveryID` int NOT NULL,
  `region` int NOT NULL,
  `contact` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `orderId` int NOT NULL,
  `driverId` int NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `date` date NOT NULL,
  `deliveredTime` time NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`DeliveryID`, `region`, `contact`, `orderId`, `driverId`, `address`, `longitude`, `latitude`, `date`, `deliveredTime`, `status`) VALUES
(0, 0, '', 0, 0, '', 0, 0, '0000-00-00', '00:00:00', ''),
(1, 1, '0771112233', 0, 0, '', 0, 0, '0000-00-00', '00:00:00', ''),
(2, 2, '0712223344', 0, 0, '', 0, 0, '0000-00-00', '00:00:00', ''),
(3, 3, '0753334455', 0, 0, '', 0, 0, '0000-00-00', '00:00:00', ''),
(4, 1, '0774445566', 0, 0, '', 0, 0, '0000-00-00', '00:00:00', ''),
(5, 4, '0715556677', 0, 0, '', 0, 0, '0000-00-00', '00:00:00', ''),
(6, 5, '0756667788', 0, 0, '', 0, 0, '0000-00-00', '00:00:00', ''),
(7, 6, '0777778899', 0, 0, '', 0, 0, '0000-00-00', '00:00:00', ''),
(8, 7, '0718889900', 0, 2, '', 0, 0, '0000-00-00', '00:00:00', ''),
(9, 8, '0759990011', 0, 1, '', 0, 0, '0000-00-00', '00:00:00', 'delivered'),
(10, 4, '0770001122', 0, 1, '', 0, 0, '0000-00-00', '00:00:00', 'breakdown');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryold`
--

CREATE TABLE `deliveryold` (
  `DeliveryID` int NOT NULL,
  `deliveryName` varchar(10) NOT NULL,
  `region` int NOT NULL,
  `contact` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveryold`
--

INSERT INTO `deliveryold` (`DeliveryID`, `deliveryName`, `region`, `contact`) VALUES
(0, 'Unassigned', 0, 'N/A'),
(1, 'Kamal', 1, '0771112233'),
(2, 'Ruwan', 2, '0712223344'),
(3, 'Sunil', 3, '0753334455'),
(4, 'Nimal', 1, '0774445566'),
(5, 'Kumara', 4, '0715556677'),
(6, 'Tharindu', 5, '0756667788'),
(7, 'Asela', 6, '0777778899'),
(8, 'Suresh', 7, '0718889900'),
(9, 'Pradeep', 8, '0759990011'),
(10, 'Ravi', 4, '0770001122');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverId` int NOT NULL,
  `driverName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `token` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fcmToken` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telNo` text COLLATE utf8mb4_general_ci,
  `NIC` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deliveryTime` text COLLATE utf8mb4_general_ci,
  `vehicalLicenseNo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `status` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverId`, `driverName`, `email`, `password`, `dob`, `token`, `fcmToken`, `telNo`, `NIC`, `deliveryTime`, `vehicalLicenseNo`, `status`) VALUES
(1, 'alex david', 'test123@gmail.com', '$2y$10$XQaVKhJfko78VFslJKrdR./fYhQuyYV38Pzi.rt9Ni1LK/HUc1Sri', NULL, 'e60910d7692c0682c44b235e70382b357b1b7e01932b15bf832cb94a6cc4a8adade8b78fb9cbb9ec6bda92a05f59edfd', '', NULL, NULL, '', '', '0'),
(7, 'John Doe', 'john@email.com', '$2y$10$PbhILncqmn5BZ4wJYJewleKWq2gPYdeoYoRuLovXmDLz9x1NLviPS', NULL, NULL, NULL, '20014232448', '20014232448', 'full time', '', 'pending'),
(32, 'Ruwan kumara', 'ruwan@gmail.com', '$2y$10$G7KK2CsZc8Kehl7BK3O6m.Pyf6JeyEgsOLr9O1ssZYVTMpLMX82xK', '2001-12-09', NULL, NULL, NULL, '20028743749', 'part time', '', 'pending'),
(35, 'Alex David', 'alex123@gmail.com', '$2y$10$J5lP4KKX/VHOyrhvuMPH6OfFJKv9VEm3X3SAE0BqpIvwwQ7GIXhai', '2001-12-09', '498e3be2e541c9390e913288f7748a07869c37901142bcda3b2cc8108e346b02b21e5011b46139e42e3effade5dd7d4d', 'ezzyssgQT2yxRqKHZYBIVC:APA91bFTxtdhkXV22jkNXwVvkYm9_Vgwf-BAIbtJvkIgfS7GWOC4euLp2Wlio42TmJd2AUad7sSZ79d6bOBRQ4GH0hFzh7OHzDA2GVPxv6xRMwR-dTml0YM', NULL, '20028743749', 'part time', '', 'active'),
(36, 'Ruwan Kumara', 'ruwan1@gmail.com', '$2y$10$6YobmqS82IiR4F5SSQXV7upgDwCsVE82rKIIjuW7pH4KGtIvISucu', '1998-12-05', NULL, NULL, '0763242342332', '983423423v', 'part time', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE `drug` (
  `DrugID` int NOT NULL,
  `genericName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `overTheCounter` char(1) NOT NULL,
  `form` varchar(10) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drug`
--

INSERT INTO `drug` (`DrugID`, `genericName`, `overTheCounter`, `form`, `category`) VALUES
(1, 'Ibuprofen', 'Y', 'Tablet', 'Pain Reliever'),
(2, 'Amoxicillin', 'N', 'Capsule', 'Antibiotic'),
(3, 'Loratadine', 'Y', 'Tablet', 'Antihistamine'),
(4, 'Metformin', 'N', 'Tablet', 'Antidiabetic'),
(5, 'Omeprazole', 'N', 'Capsule', 'Antacid'),
(6, 'Cetirizine', 'Y', 'Tablet', 'Antihistamine'),
(7, 'Aspirin', 'Y', 'Tablet', 'Pain Reliever'),
(8, 'Hydrochlorothiazide', 'N', 'Tablet', 'Diuretic'),
(9, 'Prednisone', 'N', 'Tablet', 'Anti-inflammatory'),
(10, 'Diphenhydramine', 'Y', 'Tablet', 'Antihistamine'),
(11, 'Acetaminophen', 'Y', 'Tablet', 'Pain Reliever'),
(12, 'Ciprofloxacin', 'N', 'Tablet', 'Antibiotic'),
(13, 'Fexofenadine', 'Y', 'Tablet', 'Antihistamine'),
(14, 'Atorvastatin', 'N', 'Tablet', 'Antilipemic'),
(15, 'Lansoprazole', 'N', 'Capsule', 'Proton Pump Inhibito'),
(16, 'Pseudoephedrine', 'Y', 'Tablet', 'Decongestant'),
(17, 'Naproxen', 'Y', 'Tablet', 'Pain Reliever'),
(18, 'Lisinopril', 'N', 'Tablet', 'Antihypertensive'),
(19, 'Fluticasone', 'N', 'Inhaler', 'Corticosteroid'),
(20, 'Citalopram', 'N', 'Tablet', 'Antidepressant'),
(21, 'Amlodipine', 'N', 'Tablet', 'Antihypertensive'),
(22, 'Simvastatin', 'N', 'Tablet', 'Antilipemic'),
(23, 'Albuterol', 'N', 'Inhaler', 'Bronchodilator'),
(24, 'Sertraline', 'N', 'Tablet', 'Antidepressant'),
(25, 'Levofloxacin', 'N', 'Tablet', 'Antibiotic'),
(26, 'Montelukast', 'N', 'Tablet', 'Antiasthmatic'),
(27, 'Losartan', 'N', 'Tablet', 'Antihypertensive'),
(28, 'Famotidine', 'Y', 'Tablet', 'Antacid'),
(29, 'Warfarin', 'N', 'Tablet', 'Anticoagulant'),
(30, 'Furosemide', 'N', 'Tablet', 'Diuretic'),
(31, 'Methylprednisolone', 'N', 'Tablet', 'Anti-inflammatory'),
(32, 'Escitalopram', 'N', 'Tablet', 'Antidepressant'),
(33, 'Pantoprazole', 'N', 'Tablet', 'Proton Pump Inhibito'),
(34, 'Paracetamol', 'Y', 'Tablet', 'Pain Reliever'),
(35, 'Lorazepam', 'N', 'Tablet', 'Anxiolytic'),
(36, 'Doxycycline', 'N', 'Capsule', 'Antibiotic'),
(37, 'Clonazepam', 'N', 'Tablet', 'Anticonvulsant'),
(38, 'Tramadol', 'N', 'Tablet', 'Pain Reliever'),
(39, 'Fluconazole', 'N', 'Capsule', 'Antifungal'),
(40, 'Ranitidine', 'Y', 'Tablet', 'Antacid');

-- --------------------------------------------------------

--
-- Table structure for table `drugInventory`
--

CREATE TABLE `drugInventory` (
  `InventoryId` int NOT NULL,
  `ProductID` int NOT NULL,
  `PharmacyID` int NOT NULL,
  `unitPrice` double NOT NULL,
  `ongoingOrder` tinyint(1) NOT NULL,
  `availableCount` int NOT NULL,
  `thresholdLimit` int NOT NULL,
  `storageLocation` varchar(10) NOT NULL,
  `storageConditions` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugInventory`
--

INSERT INTO `drugInventory` (`InventoryId`, `ProductID`, `PharmacyID`, `unitPrice`, `ongoingOrder`, `availableCount`, `thresholdLimit`, `storageLocation`, `storageConditions`) VALUES
(1, 1, 1, 12.5, 0, 50, 10, '', ''),
(2, 2, 1, 12.5, 0, 30, 5, '', ''),
(3, 3, 1, 12.5, 0, 100, 15, '', ''),
(4, 4, 2, 12, 0, 20, 5, '', ''),
(5, 5, 2, 12, 0, 15, 3, '', ''),
(6, 6, 2, 12, 0, 40, 8, '', ''),
(7, 7, 3, 18.75, 0, 25, 7, '', ''),
(8, 8, 3, 12.5, 0, 50, 10, '', ''),
(9, 9, 4, 11.5, 0, 60, 12, '', ''),
(10, 10, 4, 11.5, 0, 35, 6, '', ''),
(11, 1, 5, 12, 0, 45, 10, '', ''),
(12, 2, 5, 12, 0, 25, 5, '', ''),
(13, 4, 6, 12.5, 0, 30, 7, '', ''),
(14, 6, 6, 12.5, 0, 50, 10, '', ''),
(15, 7, 7, 17.25, 0, 20, 5, '', ''),
(16, 9, 7, 11.5, 0, 40, 10, '', ''),
(17, 8, 8, 12.5, 0, 30, 6, '', ''),
(18, 10, 8, 12.5, 0, 25, 7, '', ''),
(19, 3, 9, 12, 0, 70, 15, '', ''),
(20, 5, 9, 12, 0, 20, 5, '', ''),
(21, 11, 1, 12.5, 0, 55, 10, 'Shelf-A1', 'Room temperature'),
(22, 12, 1, 25, 0, 25, 5, 'Shelf-B2', 'Room temperature'),
(23, 13, 1, 25, 0, 85, 12, 'Shelf-C3', 'Room temperature'),
(24, 14, 2, 12, 0, 30, 6, 'Shelf-A2', 'Room temperature'),
(25, 15, 2, 18, 0, 18, 5, 'Shelf-B1', 'Room temperature'),
(26, 16, 3, 16.25, 0, 60, 15, 'Shelf-C1', 'Room temperature'),
(27, 17, 3, 6.25, 0, 40, 8, 'Shelf-A3', 'Room temperature'),
(28, 18, 4, 9.2, 0, 35, 7, 'Shelf-B3', 'Room temperature'),
(29, 19, 4, 2.3, 0, 45, 9, 'Shelf-C2', 'Keep dry'),
(30, 20, 5, 8.4, 0, 50, 10, 'Shelf-A4', 'Room temperature'),
(31, 11, 6, 12.5, 0, 42, 8, 'Shelf-B4', 'Room temperature'),
(32, 13, 6, 25, 0, 70, 12, 'Shelf-C4', 'Room temperature'),
(33, 15, 7, 17.25, 0, 22, 5, 'Shelf-A5', 'Room temperature'),
(34, 17, 7, 5.75, 0, 33, 7, 'Shelf-B5', 'Room temperature'),
(35, 19, 8, 2.5, 0, 48, 10, 'Shelf-C5', 'Keep dry'),
(36, 12, 9, 24, 0, 28, 6, 'Shelf-A6', 'Room temperature'),
(37, 14, 9, 12, 0, 32, 8, 'Shelf-B6', 'Room temperature'),
(38, 16, 10, 14.95, 0, 55, 12, 'Shelf-C6', 'Room temperature'),
(39, 18, 10, 9.2, 0, 38, 8, 'Shelf-A7', 'Room temperature'),
(40, 20, 1, 8.75, 0, 45, 10, 'Shelf-B7', 'Room temperature'),
(41, 1, 11, 11.5, 1, 59, 12, 'Shelf-A1', 'Room temperature'),
(42, 3, 11, 11.5, 0, 90, 15, 'Shelf-B1', 'Room temperature'),
(43, 5, 11, 11.5, 0, 25, 5, 'Shelf-C1', 'Room temperature'),
(44, 7, 11, 17.25, 0, 30, 6, 'Shelf-D1', 'Room temperature'),
(45, 9, 11, 11.5, 0, 45, 10, 'Shelf-E1', 'Keep dry'),
(46, 11, 11, 11.5, 0, 50, 12, 'Shelf-F1', 'Room temperature'),
(47, 13, 11, 23, 1, 74, 15, 'Shelf-G1', 'Room temperature'),
(48, 15, 11, 17.25, 0, 20, 4, 'Shelf-H1', 'Room temperature'),
(49, 17, 11, 5.75, 0, 35, 7, 'Shelf-I1', 'Room temperature'),
(50, 19, 11, 2.3, 1, 39, 8, 'Shelf-J1', 'Keep dry'),
(51, 2, 12, 11.5, 0, 35, 7, 'Shelf-A1', 'Cool and dry'),
(52, 4, 12, 11.5, 0, 25, 5, 'Shelf-B1', 'Room temperature'),
(53, 6, 12, 11.5, 0, 50, 10, 'Shelf-C1', 'Room temperature'),
(54, 8, 12, 11.5, 0, 45, 9, 'Shelf-D1', 'Room temperature'),
(55, 10, 12, 11.5, 0, 40, 8, 'Shelf-E1', 'Room temperature'),
(56, 12, 12, 23, 0, 30, 6, 'Shelf-F1', 'Cool and dry'),
(57, 14, 12, 11.5, 0, 22, 5, 'Shelf-G1', 'Room temperature'),
(58, 16, 12, 14.95, 0, 55, 11, 'Shelf-H1', 'Room temperature'),
(59, 18, 12, 9.2, 0, 42, 8, 'Shelf-I1', 'Room temperature'),
(60, 20, 12, 8.05, 0, 38, 8, 'Shelf-J1', 'Room temperature'),
(61, 1, 13, 11.5, 0, 48, 10, 'Shelf-A2', 'Room temperature'),
(62, 2, 13, 11.5, 0, 32, 7, 'Shelf-B2', 'Cool and dry'),
(63, 3, 13, 11.5, 0, 95, 18, 'Shelf-C2', 'Room temperature'),
(64, 4, 13, 11.5, 0, 18, 4, 'Shelf-D2', 'Room temperature'),
(65, 5, 13, 11.5, 0, 20, 5, 'Shelf-E2', 'Room temperature'),
(66, 6, 13, 11.5, 0, 45, 10, 'Shelf-F2', 'Room temperature'),
(67, 7, 13, 17.25, 0, 38, 8, 'Shelf-G2', 'Room temperature'),
(68, 8, 13, 11.5, 0, 46, 10, 'Shelf-H2', 'Room temperature'),
(69, 9, 13, 11.5, 0, 55, 12, 'Shelf-I2', 'Keep dry'),
(70, 10, 13, 11.5, 0, 42, 9, 'Shelf-J2', 'Room temperature'),
(71, 1, 14, 11.5, 0, 52, 12, 'Shelf-A1', 'Room temperature'),
(72, 5, 14, 11.5, 0, 22, 5, 'Shelf-B1', 'Room temperature'),
(73, 9, 14, 11.5, 0, 58, 12, 'Shelf-C1', 'Keep dry'),
(74, 13, 14, 23, 0, 82, 18, 'Shelf-D1', 'Room temperature'),
(75, 17, 14, 5.75, 0, 36, 8, 'Shelf-E1', 'Room temperature'),
(76, 2, 15, 11.5, 0, 28, 6, 'Shelf-A1', 'Cool and dry'),
(77, 6, 15, 11.5, 0, 42, 10, 'Shelf-B1', 'Room temperature'),
(78, 10, 15, 11.5, 0, 38, 8, 'Shelf-C1', 'Room temperature'),
(79, 14, 15, 11.5, 0, 25, 6, 'Shelf-D1', 'Room temperature'),
(80, 18, 15, 9.2, 0, 40, 9, 'Shelf-E1', 'Room temperature'),
(81, 3, 16, 11.5, 0, 88, 15, 'Shelf-A1', 'Room temperature'),
(82, 7, 16, 17.25, 0, 32, 7, 'Shelf-B1', 'Room temperature'),
(83, 11, 16, 11.5, 0, 46, 10, 'Shelf-C1', 'Room temperature'),
(84, 15, 16, 17.25, 0, 19, 4, 'Shelf-D1', 'Room temperature'),
(85, 19, 16, 2.3, 0, 42, 9, 'Shelf-E1', 'Keep dry'),
(86, 4, 17, 11.5, 0, 26, 6, 'Shelf-A1', 'Room temperature'),
(87, 8, 17, 11.5, 0, 48, 10, 'Shelf-B1', 'Room temperature'),
(88, 12, 17, 23, 0, 24, 5, 'Shelf-C1', 'Cool and dry'),
(89, 16, 17, 14.95, 0, 52, 12, 'Shelf-D1', 'Room temperature'),
(90, 20, 17, 8.05, 0, 44, 10, 'Shelf-E1', 'Room temperature'),
(91, 1, 18, 11.5, 0, 55, 12, 'Shelf-A1', 'Room temperature'),
(92, 3, 18, 11.5, 0, 92, 20, 'Shelf-B1', 'Room temperature'),
(93, 5, 18, 11.5, 0, 18, 4, 'Shelf-C1', 'Room temperature'),
(94, 7, 18, 17.25, 0, 28, 6, 'Shelf-D1', 'Room temperature'),
(95, 9, 18, 11.5, 0, 48, 10, 'Shelf-E1', 'Keep dry'),
(96, 2, 19, 11.5, 0, 26, 6, 'Shelf-A1', 'Cool and dry'),
(97, 6, 19, 11.5, 0, 38, 8, 'Shelf-B1', 'Room temperature'),
(98, 10, 19, 11.5, 0, 36, 8, 'Shelf-C1', 'Room temperature'),
(99, 16, 19, 14.95, 0, 48, 10, 'Shelf-D1', 'Room temperature'),
(100, 20, 19, 8.05, 0, 42, 10, 'Shelf-E1', 'Room temperature'),
(101, 3, 20, 11.5, 0, 85, 15, 'Shelf-A1', 'Room temperature'),
(102, 7, 20, 17.25, 0, 30, 7, 'Shelf-B1', 'Room temperature'),
(103, 11, 20, 11.5, 1, 47, 10, 'Shelf-C1', 'Room temperature'),
(104, 15, 20, 17.25, 0, 16, 4, 'Shelf-D1', 'Room temperature'),
(105, 19, 20, 2.3, 0, 38, 8, 'Shelf-E1', 'Keep dry'),
(106, 21, 1, 19.38, 0, 40, 8, 'Shelf-A10', 'Room temperature'),
(107, 24, 1, 31.25, 0, 35, 7, 'Shelf-B10', 'Room temperature'),
(108, 27, 1, 56.25, 0, 20, 5, 'Shelf-C10', 'Room temperature'),
(109, 30, 1, 28.44, 0, 38, 8, 'Shelf-D10', 'Room temperature'),
(110, 33, 1, 47.81, 0, 25, 5, 'Shelf-E10', 'Room temperature'),
(111, 22, 2, 22.5, 0, 42, 9, 'Shelf-A11', 'Room temperature'),
(112, 25, 2, 39, 0, 30, 6, 'Shelf-B11', 'Room temperature'),
(113, 28, 2, 47.94, 0, 18, 4, 'Shelf-C11', 'Room temperature'),
(114, 31, 2, 35.99, 0, 45, 9, 'Shelf-D11', 'Room temperature'),
(115, 34, 2, 51.36, 0, 22, 5, 'Shelf-E11', 'Room temperature'),
(116, 23, 3, 15.31, 0, 60, 12, 'Shelf-A12', 'Room temperature'),
(117, 26, 3, 23.74, 0, 38, 8, 'Shelf-B12', 'Room temperature'),
(118, 29, 3, 65.63, 0, 50, 10, 'Shelf-C12', 'Room temperature'),
(119, 32, 3, 20.63, 0, 45, 9, 'Shelf-D12', 'Room temperature'),
(120, 35, 3, 38, 0, 28, 6, 'Shelf-E12', 'Room temperature'),
(121, 36, 4, 32.78, 0, 30, 6, 'Shelf-A13', 'Room temperature'),
(122, 39, 4, 30.19, 0, 35, 7, 'Shelf-B13', 'Room temperature'),
(123, 42, 4, 17.24, 0, 48, 10, 'Shelf-C13', 'Room temperature'),
(124, 45, 4, 17.54, 0, 40, 8, 'Shelf-D13', 'Room temperature'),
(125, 48, 4, 19.84, 0, 32, 7, 'Shelf-E13', 'Keep dry'),
(126, 37, 5, 26.1, 0, 42, 9, 'Shelf-A14', 'Room temperature'),
(127, 40, 5, 42, 0, 25, 5, 'Shelf-B14', 'Room temperature'),
(128, 43, 5, 22.2, 0, 38, 8, 'Shelf-C14', 'Room temperature'),
(129, 46, 5, 15, 0, 55, 12, 'Shelf-D14', 'Room temperature'),
(130, 49, 5, 16.56, 0, 42, 8, 'Shelf-E14', 'Cool and dry'),
(131, 38, 6, 24.99, 0, 46, 10, 'Shelf-A15', 'Room temperature'),
(132, 41, 6, 24.38, 0, 38, 8, 'Shelf-B15', 'Room temperature'),
(133, 44, 6, 13.44, 0, 60, 12, 'Shelf-C15', 'Room temperature'),
(134, 47, 6, 24.99, 0, 35, 7, 'Shelf-D15', 'Cool and dry'),
(135, 50, 6, 28.13, 0, 30, 6, 'Shelf-E15', 'Room temperature'),
(136, 21, 7, 17.83, 0, 38, 8, 'Shelf-A16', 'Room temperature'),
(137, 25, 7, 37.38, 0, 32, 7, 'Shelf-B16', 'Room temperature'),
(138, 29, 7, 60.38, 0, 45, 9, 'Shelf-C16', 'Room temperature'),
(139, 33, 7, 43.99, 0, 22, 5, 'Shelf-D16', 'Room temperature'),
(140, 37, 7, 25.01, 0, 40, 8, 'Shelf-E16', 'Room temperature'),
(141, 22, 8, 23.44, 0, 44, 9, 'Shelf-A17', 'Room temperature'),
(142, 26, 8, 23.74, 0, 35, 7, 'Shelf-B17', 'Room temperature'),
(143, 30, 8, 28.44, 0, 32, 7, 'Shelf-C17', 'Room temperature'),
(144, 34, 8, 53.5, 0, 20, 4, 'Shelf-D17', 'Room temperature'),
(145, 38, 8, 24.99, 0, 42, 9, 'Shelf-E17', 'Room temperature'),
(146, 23, 9, 14.7, 0, 55, 12, 'Shelf-A18', 'Room temperature'),
(147, 27, 9, 54, 0, 22, 5, 'Shelf-B18', 'Room temperature'),
(148, 31, 9, 35.99, 0, 40, 8, 'Shelf-C18', 'Room temperature'),
(149, 35, 9, 36.48, 0, 30, 6, 'Shelf-D18', 'Room temperature'),
(150, 39, 9, 31.5, 0, 38, 8, 'Shelf-E18', 'Room temperature'),
(151, 24, 10, 28.75, 0, 32, 7, 'Shelf-A19', 'Room temperature'),
(152, 28, 10, 45.94, 0, 20, 4, 'Shelf-B19', 'Room temperature'),
(153, 32, 10, 18.98, 0, 48, 10, 'Shelf-C19', 'Room temperature'),
(154, 36, 10, 32.78, 0, 35, 7, 'Shelf-D19', 'Room temperature'),
(155, 40, 10, 40.25, 0, 28, 6, 'Shelf-E19', 'Room temperature'),
(156, 21, 11, 17.83, 0, 45, 9, 'Shelf-F1', 'Room temperature'),
(157, 25, 11, 37.38, 0, 30, 6, 'Shelf-G1', 'Room temperature'),
(158, 29, 11, 60.38, 0, 48, 10, 'Shelf-H1', 'Room temperature'),
(159, 34, 11, 49.22, 0, 24, 5, 'Shelf-I1', 'Room temperature'),
(160, 39, 11, 30.19, 0, 35, 7, 'Shelf-J1', 'Room temperature'),
(161, 22, 12, 21.56, 0, 40, 8, 'Shelf-F1', 'Room temperature'),
(162, 26, 12, 21.84, 0, 42, 9, 'Shelf-G1', 'Room temperature'),
(163, 30, 12, 26.16, 0, 36, 8, 'Shelf-H1', 'Room temperature'),
(164, 35, 12, 34.96, 0, 28, 6, 'Shelf-I1', 'Room temperature'),
(165, 40, 12, 40.25, 0, 30, 6, 'Shelf-J1', 'Room temperature'),
(166, 23, 13, 14.09, 0, 58, 12, 'Shelf-F2', 'Room temperature'),
(167, 27, 13, 51.75, 0, 18, 4, 'Shelf-G2', 'Room temperature'),
(168, 31, 13, 34.49, 0, 42, 9, 'Shelf-H2', 'Room temperature'),
(169, 36, 13, 32.78, 0, 32, 7, 'Shelf-I2', 'Room temperature'),
(170, 41, 13, 22.43, 0, 40, 8, 'Shelf-J2', 'Room temperature'),
(171, 24, 14, 28.75, 0, 38, 8, 'Shelf-F1', 'Room temperature'),
(172, 28, 14, 45.94, 0, 22, 5, 'Shelf-G1', 'Room temperature'),
(173, 32, 14, 18.98, 0, 50, 10, 'Shelf-H1', 'Room temperature'),
(174, 36, 14, 32.78, 0, 34, 7, 'Shelf-I1', 'Room temperature'),
(175, 40, 14, 40.25, 0, 28, 6, 'Shelf-J1', 'Room temperature'),
(176, 25, 15, 37.38, 0, 32, 7, 'Shelf-F1', 'Room temperature'),
(177, 29, 15, 60.38, 0, 45, 9, 'Shelf-G1', 'Room temperature'),
(178, 33, 15, 43.99, 0, 20, 4, 'Shelf-H1', 'Room temperature'),
(179, 37, 15, 25.01, 0, 38, 8, 'Shelf-I1', 'Room temperature'),
(180, 41, 15, 22.43, 0, 44, 9, 'Shelf-J1', 'Room temperature'),
(181, 26, 16, 21.84, 0, 40, 8, 'Shelf-F1', 'Room temperature'),
(182, 30, 16, 26.16, 0, 36, 8, 'Shelf-G1', 'Room temperature'),
(183, 34, 16, 49.22, 0, 22, 5, 'Shelf-H1', 'Room temperature'),
(184, 38, 16, 22.99, 0, 48, 10, 'Shelf-I1', 'Room temperature'),
(185, 42, 16, 17.24, 0, 55, 12, 'Shelf-J1', 'Room temperature'),
(186, 27, 17, 51.75, 0, 18, 4, 'Shelf-F1', 'Room temperature'),
(187, 31, 17, 34.49, 0, 45, 9, 'Shelf-G1', 'Room temperature'),
(188, 35, 17, 34.96, 0, 30, 6, 'Shelf-H1', 'Room temperature'),
(189, 39, 17, 30.19, 0, 42, 9, 'Shelf-I1', 'Room temperature'),
(190, 43, 17, 21.28, 0, 38, 8, 'Shelf-J1', 'Room temperature'),
(191, 28, 18, 45.94, 0, 20, 4, 'Shelf-F1', 'Room temperature'),
(192, 32, 18, 18.98, 0, 52, 12, 'Shelf-G1', 'Room temperature'),
(193, 36, 18, 32.78, 0, 35, 7, 'Shelf-H1', 'Room temperature'),
(194, 40, 18, 40.25, 0, 28, 6, 'Shelf-I1', 'Room temperature'),
(195, 44, 18, 12.36, 0, 65, 15, 'Shelf-J1', 'Room temperature'),
(196, 29, 19, 60.38, 0, 48, 10, 'Shelf-F1', 'Room temperature'),
(197, 33, 19, 43.99, 0, 24, 5, 'Shelf-G1', 'Room temperature'),
(198, 37, 19, 25.01, 0, 40, 8, 'Shelf-H1', 'Room temperature'),
(199, 41, 19, 22.43, 0, 45, 9, 'Shelf-I1', 'Room temperature'),
(200, 45, 19, 17.54, 0, 42, 9, 'Shelf-J1', 'Room temperature'),
(201, 30, 20, 26.16, 0, 38, 8, 'Shelf-F1', 'Room temperature'),
(202, 34, 20, 49.22, 0, 20, 4, 'Shelf-G1', 'Room temperature'),
(203, 38, 20, 22.99, 0, 48, 10, 'Shelf-H1', 'Room temperature'),
(204, 42, 20, 17.24, 0, 60, 12, 'Shelf-I1', 'Room temperature'),
(205, 46, 20, 14.38, 0, 52, 12, 'Shelf-J1', 'Room temperature');

-- --------------------------------------------------------

--
-- Stand-in structure for view `InventoryView`
-- (See below for the actual view)
--
CREATE TABLE `InventoryView` (
`PharmacyID` int
,`name` varchar(30)
,`address` varchar(100)
,`contactNo` char(10)
,`latitude` double
,`longitude` double
,`InventoryId` int
,`ProductID` int
,`ProductName` varchar(50)
,`genericName` varchar(30)
,`strength` varchar(10)
,`unitPrice` double
,`availableCount` int
);

-- --------------------------------------------------------

--
-- Table structure for table `manufacture`
--

CREATE TABLE `manufacture` (
  `ManufactureID` int NOT NULL,
  `ManufactureName` varchar(50) NOT NULL,
  `country` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacture`
--

INSERT INTO `manufacture` (`ManufactureID`, `ManufactureName`, `country`) VALUES
(1, 'Pfizer', 'USA'),
(2, 'Novartis', 'Switzerland'),
(3, 'Sanofi', 'France'),
(4, 'GlaxoSmithKline', 'UK'),
(5, 'Johnson & Johnson', 'USA'),
(6, 'Bayer', 'Germany'),
(7, 'Roche', 'Switzerland'),
(8, 'AstraZeneca', 'UK'),
(9, 'Merck & Co.', 'USA'),
(10, 'AbbVie', 'USA'),
(11, 'Teva', 'Israel'),
(12, 'Mylan', 'USA'),
(13, 'Amgen', 'USA'),
(14, 'Bristol-Myers Squibb', 'USA'),
(15, 'Takeda', 'Japan'),
(16, 'Eli Lilly', 'USA'),
(17, 'Gilead Sciences', 'USA'),
(18, 'Boehringer Ingelheim', 'Germany'),
(19, 'Novo Nordisk', 'Denmark'),
(20, 'Biogen', 'USA'),
(21, 'Allergan', 'Ireland'),
(22, 'Regeneron', 'USA'),
(23, 'Vertex', 'USA'),
(24, 'Sun Pharma', 'India'),
(25, 'Cipla', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturedDrug`
--

CREATE TABLE `manufacturedDrug` (
  `ProductID` int NOT NULL,
  `ProductName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DrugID` int NOT NULL,
  `ManufactureID` int NOT NULL,
  `strength` varchar(10) NOT NULL,
  `price` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturedDrug`
--

INSERT INTO `manufacturedDrug` (`ProductID`, `ProductName`, `DrugID`, `ManufactureID`, `strength`, `price`) VALUES
(1, 'Pfizer Ibuprofen 200mg', 1, 1, '200mg', 10.00),
(2, 'Novartis Amoxicillin 500mg', 2, 2, '500mg', 10.00),
(3, 'Sanofi Loratadine 10mg', 3, 3, '10mg', 10.00),
(4, 'GSK Metformin 850mg', 4, 4, '850mg', 10.00),
(5, 'J&J Omeprazole 20mg', 5, 5, '20mg', 10.00),
(6, 'Bayer Cetirizine 10mg', 6, 6, '10mg', 10.00),
(7, 'Roche Aspirin 100mg', 7, 7, '100mg', 15.00),
(8, 'AstraZeneca Hydrochlorothiazide 25mg', 8, 8, '25mg', 10.00),
(9, 'Merck Prednisone 5mg', 9, 9, '5mg', 10.00),
(10, 'AbbVie Diphenhydramine 25mg', 10, 10, '25mg', 10.00),
(11, 'Teva Ibuprofen 400mg', 1, 1, '400mg', 10.00),
(12, 'Mylan Amoxicillin 875mg', 2, 2, '875mg', 20.00),
(13, 'Sanofi Loratadine 5mg', 3, 3, '5mg', 20.00),
(14, 'BMS Metformin 500mg', 4, 4, '500mg', 10.00),
(15, 'Takeda Omeprazole 40mg', 5, 5, '40mg', 15.00),
(16, 'Bayer Cetirizine 5mg', 6, 6, '5mg', 13.00),
(17, 'Pfizer Aspirin 81mg', 7, 1, '81mg', 5.00),
(18, 'AstraZeneca Hydrochlorothiazide 50mg', 8, 8, '50mg', 8.00),
(19, 'Merck Prednisone 10mg', 9, 9, '10mg', 2.00),
(20, 'J&J Diphenhydramine 50mg', 10, 5, '50mg', 7.00),
(21, 'Eli Lilly Amlodipine 5mg', 21, 16, '5mg', 15.50),
(22, 'Pfizer Amlodipine 10mg', 21, 1, '10mg', 18.75),
(23, 'Sun Pharma Amlodipine 2.5mg', 21, 24, '2.5mg', 12.25),
(24, 'Merck Simvastatin 20mg', 22, 9, '20mg', 25.00),
(25, 'Teva Simvastatin 40mg', 22, 11, '40mg', 32.50),
(26, 'Cipla Simvastatin 10mg', 22, 25, '10mg', 18.99),
(27, 'GSK Albuterol Inhaler 100mcg', 23, 4, '100mcg', 45.00),
(28, 'Teva Albuterol Inhaler 90mcg', 23, 11, '90mcg', 39.95),
(29, 'Mylan Albuterol Inhaler 200mcg', 23, 12, '200mcg', 52.50),
(30, 'Pfizer Sertraline 50mg', 24, 1, '50mg', 22.75),
(31, 'Sun Pharma Sertraline 100mg', 24, 24, '100mg', 29.99),
(32, 'Cipla Sertraline 25mg', 24, 25, '25mg', 16.50),
(33, 'Johnson & Johnson Levofloxacin 500mg', 25, 5, '500mg', 38.25),
(34, 'Sanofi Levofloxacin 750mg', 25, 3, '750mg', 42.80),
(35, 'Cipla Levofloxacin 250mg', 25, 25, '250mg', 30.40),
(36, 'Merck Montelukast 10mg', 26, 9, '10mg', 28.50),
(37, 'Teva Montelukast 5mg', 26, 11, '5mg', 21.75),
(38, 'Sun Pharma Montelukast 4mg', 26, 24, '4mg', 19.99),
(39, 'Merck Losartan 50mg', 27, 9, '50mg', 26.25),
(40, 'Novartis Losartan 100mg', 27, 2, '100mg', 35.00),
(41, 'Cipla Losartan 25mg', 27, 25, '25mg', 19.50),
(42, 'Pfizer Famotidine 20mg', 28, 1, '20mg', 14.99),
(43, 'J&J Famotidine 40mg', 28, 5, '40mg', 18.50),
(44, 'Sun Pharma Famotidine 10mg', 28, 24, '10mg', 10.75),
(45, 'Bristol-Myers Squibb Warfarin 5mg', 29, 14, '5mg', 15.25),
(46, 'Teva Warfarin 2mg', 29, 11, '2mg', 12.50),
(47, 'Novartis Warfarin 7.5mg', 29, 2, '7.5mg', 19.99),
(48, 'Sanofi Furosemide 40mg', 30, 3, '40mg', 17.25),
(49, 'Teva Furosemide 20mg', 30, 11, '20mg', 13.80),
(50, 'Mylan Furosemide 80mg', 30, 12, '80mg', 22.50);

-- --------------------------------------------------------

--
-- Table structure for table `medicineOrder`
--

CREATE TABLE `medicineOrder` (
  `OrderID` int NOT NULL,
  `date` datetime NOT NULL,
  `status` char(1) NOT NULL,
  `pickup` tinyint(1) NOT NULL,
  `paymentMethod` varchar(4) NOT NULL COMMENT 'card, cash, cod',
  `totalBill` decimal(10,2) NOT NULL,
  `destination` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `destinationLat` double NOT NULL,
  `destinationLong` double NOT NULL,
  `prescription` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PatientID` int NOT NULL,
  `PharmacyID` int NOT NULL,
  `DeliveryID` int DEFAULT NULL
) ;

--
-- Dumping data for table `medicineOrder`
--

INSERT INTO `medicineOrder` (`OrderID`, `date`, `status`, `pickup`, `paymentMethod`, `totalBill`, `destination`, `destinationLat`, `destinationLong`, `prescription`, `PatientID`, `PharmacyID`, `DeliveryID`) VALUES
(1, '2024-08-10 00:00:00', 'P', 0, '', 162.00, '123 Galle Road, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 1),
(2, '2024-08-12 00:00:00', 'C', 0, '', 0.00, '45 Kandy Street, Kandy', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 2, 2, 2),
(3, '2024-08-14 00:00:00', 'D', 0, '', 0.00, '12 Lake Drive, Nuwara Eliya', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 3, 3, 3),
(4, '2024-08-16 00:00:00', 'P', 0, '', 0.00, '123 Galle Road, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 4, 4),
(5, '2024-08-18 00:00:00', 'D', 1, '', 0.00, '98 Beach Road, Galle', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 4, 5, 5),
(6, '2024-08-19 00:00:00', 'C', 0, '', 0.00, '5 Temple Road, Anuradhapura', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 5, 6, 6),
(7, '2024-08-20 00:00:00', 'P', 0, '', 0.00, '56 Main Street, Jaffna', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 6, 7, 7),
(8, '2024-08-21 00:00:00', 'D', 0, '', 0.00, '123 Galle Road, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 8, 8),
(9, '2024-08-22 00:00:00', 'C', 0, '', 0.00, '22 Park Avenue, Kurunegala', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 8, 9, 9),
(10, '2024-08-23 00:00:00', 'P', 0, '', 0.00, '32 Temple Lane, Anuradhapura', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 5, 10, 10),
(11, '2024-11-17 08:32:41', 'W', 0, '', 0.00, 'No 5, Galle Rd, Kandy.', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 5, 0),
(12, '0000-00-00 00:00:00', 'P', 0, '', 0.00, 'No 5, Galle Rd, Kandy.', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 3, 0),
(13, '2024-11-17 10:56:42', 'W', 0, '', 0.00, 'No 5, Galle Rd, Kandy.', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 5, 0),
(14, '2024-11-17 11:03:45', 'W', 0, '', 0.00, 'No 19, Main Rd, Hambanthota.', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 1, 0),
(15, '2024-11-17 15:06:22', 'W', 0, '', 0.00, 'nugegoda ', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 3, 0),
(16, '2024-11-17 16:00:02', 'W', 0, '', 0.00, 'maharagama', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(17, '2024-11-17 16:26:06', 'W', 0, '', 0.00, 'kotuwa', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 6, 0),
(18, '2024-11-18 03:26:57', 'W', 0, '', 0.00, 'ucsc', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 3, 0),
(19, '2024-11-18 04:32:41', 'W', 0, '', 0.00, 'ucsc', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(20, '2024-11-21 07:09:15', 'W', 0, '', 0.00, 'ucscs', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 3, 0),
(21, '2024-11-21 07:11:47', 'W', 0, '', 0.00, 'ifgfghg', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 3, 0),
(22, '2024-11-22 09:13:10', 'W', 0, '', 0.00, '1', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 5, 0),
(23, '2024-11-22 09:13:54', 'W', 1, '', 0.00, '', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(24, '2024-11-22 10:02:05', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 5, 0),
(25, '2024-11-22 10:20:46', 'W', 1, '', 0.00, 'Pickup', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(26, '2024-11-22 10:47:52', 'W', 1, '', 0.00, 'Pickup', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(27, '2024-11-22 15:26:15', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 5, 0),
(28, '2024-11-22 15:29:38', 'W', 1, '', 0.00, 'Pickup', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(29, '2024-11-22 16:01:20', 'W', 1, '', 0.00, 'Pickup', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(30, '2024-11-22 16:32:49', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 7, 0),
(31, '2024-11-22 16:38:01', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 6, 0),
(32, '2024-11-22 16:47:05', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 2, 0),
(33, '2024-11-22 17:41:27', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 2, 0),
(34, '2024-11-22 18:27:35', 'W', 1, '', 0.00, 'Pickup', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(35, '2024-11-22 18:33:22', 'W', 1, '', 0.00, 'Pickup', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(36, '2024-11-22 18:36:53', 'W', 1, '', 0.00, 'Pickup', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(37, '2024-11-23 20:08:37', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 12, 2, 0),
(48, '2024-11-29 04:48:10', 'W', 1, '', 0.00, 'Pickup', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 1, 0),
(50, '2024-11-29 05:45:23', 'Q', 1, '', 0.00, 'ucsc', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 6, 0),
(51, '2025-04-13 04:00:15', 'W', 1, '', 0.00, 'Pickup', 0, 0, 'https://res.cloudinary.com/dqbnwumwy/image/upload/v1732391462/prescriptions/11_1732391460.png.png', 11, 6, 0),
(52, '2025-04-13 05:53:41', 'W', 1, '', 0.00, 'Pickup', 0, 0, '/srv/disk7/4510132/www/remed.atwebpages.com/uploads/prescriptions/11_1744523621.jpg', 11, 3, 0),
(55, '2025-04-13 10:13:09', 'W', 1, '', 0.00, 'Pickup', 0, 0, '/srv/disk7/4510132/www/remed.atwebpages.com/uploads/prescriptions/11_1744539189.jpg', 11, 1, 0),
(67, '2025-04-13 13:03:33', 'W', 1, '', 0.00, 'Pickup', 0, 0, '/srv/disk7/4510132/www/remed.atwebpages.com/uploads/prescriptions/11_1744549413.jpg', 11, 3, 0),
(68, '2025-04-13 13:11:37', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, '', 12, 5, 0),
(69, '2025-04-13 13:15:11', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, '', 12, 5, 0),
(70, '2025-04-13 13:18:44', 'W', 1, '', 0.00, 'Pickup', 0, 0, '', 11, 3, 0),
(71, '2025-04-13 13:20:09', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, '', 12, 5, 0),
(72, '2025-04-13 13:21:21', 'W', 0, '', 0.00, 'No 19, Main Rd, Colombo', 0, 0, '', 12, 5, 0),
(73, '2025-04-14 01:16:18', 'W', 1, '', 0.00, 'Pickup', 0, 0, '', 11, 8, 0),
(74, '2025-04-16 14:06:17', 'W', 1, '', 0.00, 'Kottawa Town', 0, 0, '', 11, 3, 0),
(75, '2025-04-17 08:29:29', 'W', 1, 'card', 0.00, 'Pickup', 0, 0, '', 11, 3, 0),
(76, '2025-04-17 08:30:47', 'W', 1, '', 0.00, 'Pickup', 0, 0, '', 11, 3, 0),
(77, '2025-04-17 08:54:21', 'W', 1, '', 0.00, 'Pickup', 0, 0, '', 11, 3, 0),
(78, '2025-04-17 08:54:46', 'A', 1, '', 0.00, 'Pickup', 0, 0, '', 11, 3, 0),
(79, '2025-04-17 09:03:28', 'A', 0, '', 0.00, 'Pickup', 0, 0, '', 11, 3, 0),
(80, '2025-04-17 09:05:41', 'Q', 1, '', 0.00, 'Pickup', 0, 0, '', 11, 3, 0),
(81, '2025-04-18 16:12:24', 'Q', 1, '', 0.00, 'Pickup', 0, 0, '', 11, 20, 0),
(82, '2025-04-18 16:14:55', 'Q', 1, '', 11.50, 'Pickup', 0, 0, '', 11, 20, 0),
(83, '2025-04-19 01:43:51', 'Q', 1, '', 36.80, 'Pickup', 0, 0, '', 11, 11, 0),
(84, '2025-04-19 01:43:57', 'W', 1, '', 0.00, 'Pickup', 0, 0, '', 11, 11, 0),
(85, '2025-04-19 01:44:07', 'A', 0, 'cod', 0.00, 'Pickup', 0, 0, '', 11, 11, 0),
(86, '2025-04-19 01:44:52', 'W', 1, '', 0.00, 'Pickup', 0, 0, '', 11, 15, 0),
(87, '2025-04-19 01:50:10', 'A', 1, 'cash', 25.01, 'Pickup', 0, 0, '', 11, 15, 0),
(88, '2025-04-19 04:44:16', 'R', 1, '', 12.50, 'Pickup', 0, 0, '', 11, 6, 0),
(89, '2025-04-20 12:04:17', 'W', 1, '', 0.00, 'Homagama', 0, 0, '', 11, 18, 0),
(90, '2025-04-20 12:18:33', 'W', 1, '', 0.00, 'Maharagama', 0, 0, '', 11, 15, 0),
(91, '2025-04-20 14:10:17', 'W', 0, '', 0.00, 'Upeka Super (Pvt) Ltd', 0, 0, '11_1745158217.jpg', 11, 12, 0),
(92, '2025-04-20 14:23:10', 'W', 0, '', 0.00, 'Upeka Super (Pvt) Ltd', 0, 0, '11_1745158990.jpg', 11, 14, 0);

--
-- Triggers `medicineOrder`
--
DELIMITER $$
CREATE TRIGGER `calculate_total_bill` BEFORE UPDATE ON `medicineOrder` FOR EACH ROW BEGIN
    -- Declare all variables first, at the beginning of the block
    DECLARE total DECIMAL(10,2) DEFAULT 0;
    
    -- Then place the logic statements
    IF NEW.status = 'Q' AND OLD.status != 'Q' THEN
        -- Calculate the total bill by joining orderList with drugInventory
        SELECT COALESCE(SUM(di.unitPrice * ol.quantity), 0) INTO total
        FROM orderList ol
        JOIN drugInventory di ON ol.InventoryID = di.InventoryId
        WHERE ol.OrderID = NEW.OrderID;
        
        -- Set the totalBill value in the medicineOrder table
        SET NEW.totalBill = total;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_inventory_on_order_queue` AFTER UPDATE ON `medicineOrder` FOR EACH ROW BEGIN
    -- Declare all variables first, at the beginning of the block
    DECLARE done INT DEFAULT 0;
    DECLARE inventory_id INT;
    DECLARE qty INT;
    
    -- Create a cursor to fetch all inventory items in this order
    DECLARE order_items CURSOR FOR
        SELECT InventoryID, quantity 
        FROM orderList
        WHERE OrderID = NEW.OrderID;
        
    -- Continue handler for when the cursor is done
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    
    -- Only run when status changes to 'Q'
    IF NEW.status = 'Q' AND OLD.status != 'Q' THEN
        -- Open the cursor
        OPEN order_items;
        
        -- Start reading the items
        read_loop: LOOP
            -- Fetch the next item
            FETCH order_items INTO inventory_id, qty;
            
            -- Exit if no more items
            IF done THEN
                LEAVE read_loop;
            END IF;
            
            -- Update the inventory
            UPDATE drugInventory
            SET availableCount = availableCount - qty,
                ongoingOrder = 1
            WHERE InventoryId = inventory_id;
            
        END LOOP;
        
        -- Close the cursor
        CLOSE order_items;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_inventory_on_order_status_change` AFTER UPDATE ON `medicineOrder` FOR EACH ROW BEGIN
    -- Declare all variables first
    DECLARE done INT DEFAULT 0;
    DECLARE inventory_id INT;
    DECLARE qty INT;
    
    -- Create a cursor to fetch all inventory items in this order
    DECLARE order_items CURSOR FOR
        SELECT InventoryID, quantity 
        FROM orderList
        WHERE OrderID = NEW.OrderID;
        
    -- Continue handler for when the cursor is done
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    
    -- Check if status changes to 'A' (Approved)
    IF NEW.status = 'A' AND OLD.status != 'A' THEN
        -- Open the cursor
        OPEN order_items;
        
        -- Start reading the items
        read_loop_a: LOOP
            -- Fetch the next item
            FETCH order_items INTO inventory_id, qty;
            
            -- Exit if no more items
            IF done THEN
                LEAVE read_loop_a;
            END IF;
            
            -- Just set ongoingOrder to false, keep the reduced inventory
            UPDATE drugInventory
            SET ongoingOrder = 0
            WHERE InventoryId = inventory_id;
            
        END LOOP;
        
        -- Close the cursor
        CLOSE order_items;
        
    -- Check if status changes to 'R' (Rejected)
    ELSEIF NEW.status = 'R' AND OLD.status != 'R' THEN
        -- Reset done flag
        SET done = 0;
        
        -- Open the cursor
        OPEN order_items;
        
        -- Start reading the items
        read_loop_r: LOOP
            -- Fetch the next item
            FETCH order_items INTO inventory_id, qty;
            
            -- Exit if no more items
            IF done THEN
                LEAVE read_loop_r;
            END IF;
            
            -- Set ongoingOrder to false AND restore the inventory count
            UPDATE drugInventory
            SET ongoingOrder = 0,
                availableCount = availableCount + qty
            WHERE InventoryId = inventory_id;
            
        END LOOP;
        
        -- Close the cursor
        CLOSE order_items;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `MedicineProducts`
-- (See below for the actual view)
--
CREATE TABLE `MedicineProducts` (
`ProductID` int
,`ProductName` varchar(50)
,`genericName` varchar(30)
,`ManufactureName` varchar(50)
,`strength` varchar(10)
,`unitPrice` decimal(7,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `medicineReminder`
--

CREATE TABLE `medicineReminder` (
  `PatientID` int NOT NULL,
  `drugName` int NOT NULL,
  `dosage` int NOT NULL,
  `time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderComments`
--

CREATE TABLE `orderComments` (
  `commentID` int NOT NULL,
  `OrderID` int DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `sender` char(1) DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderComments`
--

INSERT INTO `orderComments` (`commentID`, `OrderID`, `comments`, `sender`, `createdAt`) VALUES
(1, 8, 'Test', 'u', '2025-02-22 17:53:11'),
(2, 8, 'Test 2', 'p', '2025-02-22 19:04:37'),
(3, 8, 'hiii', 'p', '2025-02-23 08:40:46'),
(4, 8, 'hiiii', 'u', '2025-02-23 10:06:04'),
(5, 8, 'is this available ', 'u', '2025-02-23 11:32:32'),
(6, 8, 'Yes sir', 'p', '2025-02-23 11:40:03'),
(7, 8, 'thnks', 'u', '2025-04-05 08:42:04'),
(8, 50, 'hii', 'u', '2025-04-13 08:46:17'),
(9, 50, 'hii', 'u', '2025-04-13 08:46:18'),
(10, 50, 'bye', 'u', '2025-04-13 08:46:31'),
(11, 73, 'hii', 'u', '2025-04-14 01:16:28'),
(12, 81, 'hi', 'u', '2025-04-19 06:00:14'),
(13, 88, 'hi', 'u', '2025-04-19 06:01:38'),
(14, 88, 'HI sir', 'p', '2025-04-19 06:03:26'),
(15, 8, 'hiii', 'u', '2025-04-20 11:42:21'),
(16, 8, 'test', 'u', '2025-04-20 11:42:51'),
(17, 8, 'bye', 'u', '2025-04-20 11:47:29'),
(18, 92, 'i need for 2 weeks', 'u', '2025-04-20 14:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `orderList`
--

CREATE TABLE `orderList` (
  `OrderID` int NOT NULL,
  `ProductID` int NOT NULL,
  `InventoryID` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderList`
--

INSERT INTO `orderList` (`OrderID`, `ProductID`, `InventoryID`, `quantity`) VALUES
(1, 1, 0, 2),
(1, 2, 0, 1),
(1, 7, 0, 5),
(2, 3, 0, 1),
(3, 4, 0, 3),
(4, 1, 0, 1),
(4, 5, 0, 2),
(5, 6, 0, 1),
(6, 7, 0, 4),
(7, 8, 0, 1),
(8, 9, 0, 4),
(8, 10, 0, 1),
(9, 3, 0, 2),
(10, 5, 0, 1),
(10, 6, 0, 3),
(13, 3, 0, 5),
(13, 8, 0, 2),
(14, 8, 0, 12),
(14, 13, 0, 5),
(15, 3, 0, 4),
(15, 8, 0, 1),
(16, 3, 0, 1),
(16, 9, 0, 3),
(18, 2, 0, 3),
(18, 8, 0, 3),
(19, 1, 0, 3),
(19, 4, 0, 2),
(20, 1, 0, 2),
(20, 8, 0, 3),
(21, 6, 0, 1),
(22, 2, 0, 1),
(22, 6, 0, 4),
(24, 2, 0, 1),
(24, 6, 0, 4),
(25, 8, 0, 1),
(26, 1, 0, 2),
(27, 2, 0, 1),
(27, 6, 0, 4),
(28, 1, 0, 1),
(28, 8, 0, 1),
(29, 2, 0, 2),
(30, 2, 0, 1),
(30, 6, 0, 4),
(31, 2, 0, 1),
(31, 6, 0, 4),
(32, 2, 0, 1),
(32, 6, 0, 4),
(33, 2, 0, 1),
(33, 6, 0, 4),
(34, 1, 0, 1),
(34, 5, 0, 1),
(34, 8, 0, 3),
(34, 9, 0, 4),
(35, 1, 0, 1),
(36, 1, 0, 3),
(36, 6, 0, 3),
(37, 1, 0, 3),
(37, 2, 0, 5),
(64, 2, 0, 1),
(64, 6, 0, 4),
(65, 2, 0, 1),
(65, 6, 0, 4),
(66, 8, 0, 3),
(68, 2, 0, 1),
(68, 6, 0, 4),
(69, 2, 0, 1),
(69, 6, 0, 4),
(70, 7, 0, 2),
(71, 2, 0, 1),
(71, 6, 0, 4),
(72, 2, 0, 1),
(72, 6, 0, 4),
(73, 4, 0, 2),
(73, 9, 0, 2),
(74, 8, 0, 2),
(75, 8, 8, 1),
(78, 8, 0, 1),
(79, 8, 8, 1),
(81, 11, 103, 1),
(81, 46, 205, 1),
(82, 11, 103, 1),
(83, 1, 41, 1),
(83, 13, 47, 1),
(83, 19, 50, 1),
(86, 29, 177, 1),
(87, 37, 179, 1),
(88, 11, 31, 1),
(90, 6, 77, 4),
(90, 10, 78, 5),
(91, 4, 52, 1),
(91, 18, 59, 1),
(92, 9, 73, 1),
(92, 32, 173, 1);

--
-- Triggers `orderList`
--
DELIMITER $$
CREATE TRIGGER `before_order_insert` BEFORE INSERT ON `orderList` FOR EACH ROW BEGIN
    DECLARE inventory_id INT;

    -- Fetch the InventoryID from drugInventory based on ProductID and PharmacyID
    SELECT InventoryID
    INTO inventory_id
    FROM drugInventory
    WHERE ProductID = NEW.ProductID 
      AND PharmacyID = (SELECT PharmacyID FROM medicineOrder WHERE OrderID = NEW.OrderID)
    LIMIT 1;

    -- Set the InventoryID for the new row
    SET NEW.InventoryID = inventory_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `OrderView`
-- (See below for the actual view)
--
CREATE TABLE `OrderView` (
`OrderID` int
,`date` datetime
,`status` char(1)
,`pickup` tinyint(1)
,`destination` varchar(100)
,`PatientID` int
,`patientName` varchar(30)
,`prescription` varchar(100)
,`totalBill` decimal(10,2)
,`paymentMethod` varchar(4)
,`PharmacyID` int
,`name` varchar(30)
,`ProductID` int
,`ProductName` varchar(50)
,`genericName` varchar(30)
,`ManufactureName` varchar(50)
,`strength` varchar(10)
,`unitPrice` double
,`quantity` int
);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` int NOT NULL,
  `patientName` varchar(30) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` char(1) NOT NULL,
  `contact` char(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `token` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `patientName`, `email`, `dob`, `gender`, `contact`, `address`, `password`, `token`) VALUES
(1, 'Nimal Perera', 'nimal@gmail.com', '1980-05-15', 'M', '0771234567', '123 Galle Road, Colombo', '', '899ee78d5debedb426cfb1a1883d234b743bf8e335ab08f731f67a626fd07c89a4664250a3a44844cdd6cda0146b9dc0'),
(2, 'Sunil Fernando', 'sunil@hmail.com', '1975-08-20', 'M', '0712345678', '45 Kandy Street, Kandy', '', ''),
(3, 'Kamalini Silva', 'kam@hmail.com', '1990-02-10', 'F', '0779876543', '12 Lake Drive, Nuwara Eliya', '', ''),
(4, 'Amara Wijesinghe', 'amara@hmail.com', '1985-11-25', 'F', '0756543210', '98 Beach Road, Galle', '', ''),
(5, 'Saman Kumara', 'saman@hmail.com', '1995-03-18', 'M', '0723456789', '32 Temple Lane, Anuradhapura', '', ''),
(6, 'Nalini Jayawardena', 'nalini@hmail.com', '1988-07-07', 'F', '0777654321', '56 Main Street, Jaffna', '', ''),
(7, 'Ruwan Wickramasinghe', 'ruwan@hmail.com', '1992-12-30', 'M', '0718765432', '78 Hilltop Road, Matara', '', ''),
(8, 'Chathuri De Silva', 'chathu@hmail.com', '2000-04-12', 'F', '0771122334', '22 Park Avenue, Kurunegala', '', ''),
(9, 'Pradeep Senanayake', 'pradeep@hmail.com', '1979-09-14', 'M', '0755432198', '44 Riverbank Road, Batticaloa', '', ''),
(10, 'Anjali Bandara', 'anjali@hmail.com', '1993-06-21', 'F', '0719988776', '67 Mountain Pass, Badulla', '', ''),
(11, 'hansaja kithmal', 'hkd@gmail.com', '2002-08-14', 'M', '', '', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '0708d9f2625d9794ec813789f4b862294fc39da8b294aed33ee23311e35e859ed3d5381ae06cc6118ea14e24fa3809b0'),
(12, 'test', 'test@gmail.com', '0000-00-00', '', '', '', '$2y$10$uprdmsjhlRlajZ0c2PQK.OsJT7rrAw.NWS.O52OaPI5oMGZIja2gu', 'f923e64aaf101cf3a3d10e93ad661efdd68b1c59eca53d65d482c4d8059f72ff4a2cefbf75d7c950a7966f6b5fb843eb'),
(13, '', 'han1@gmail.com', '0000-00-00', '', '', '', '$2y$10$F0fzFKqXcg/RCob4DmMQNOE/n3cHMKHOpLHx9Zua/Z8PH9.RC.TaO', '7f92e0019c5867bd22dcd178cf4fe5428bda12901ca3d3f0fc6c884f02dfa456b8fb30fb5018489d8c6f472481343cf3'),
(14, '', 'han2@gmail.com', '0000-00-00', '', '', '', '$2y$10$Ic.5.k7k0sepU93ix09YmuDqYxwpRaS0akh2OheFxzO0jwsLKM7wO', '8cdf57a5c4b0cba14f2261302a81ad3bbab8e1d97c72d2855b4a2891c843516c097c3584fcfc832e8584d4303f44c0ad'),
(15, 'nadiya', 'nad@gmail.com', '0000-00-00', '', '', '', '$2y$10$xy0dnr42psFQtuBKqSB/N.xdzPkpnQT1e9mhI6M7zfESMDj58FIoO', 'f3b2d5cb8cee23c45011bfdd864914d44c7e78e4767c820bdb19cc56e59258f5fd5053fec72bf95b002f13afa63a1cc6'),
(16, 'anji', 'anji@gmail.com', '0000-00-00', '', '', '', '$2y$10$6zPLKktFZkNzyvHPKTpe6eJfoRJ5EPlkw7ebeyEy2QMuohs2VoiHO', ''),
(17, 'hirun', 'hiru@gmail.com', '0000-00-00', '', '', '', '$2y$10$oQaGO52sLBCW/eYIjZnrhOlvUJ0wWyx4HlsP3VSuBIpEsDKtaceeW', ''),
(18, 'hiru', 'hiru123@gmail.com', '0000-00-00', '', '', '', '$2y$10$5QVR6vY6AnTu1a8PYD34QeLrhFxwhowxOUBopXVO.HIlCQQzv0Y22', '480f52e7d8155f5c0a41c0f5bc42f71bc42ab5046e30cfdeca9d244dbd0aee92c3a8c720904fefafe8b6ee89a3f1a906'),
(19, 'hansaja ', 'hansa@gmail.com', '0000-00-00', '', '', '', '$2y$10$TeI93nE1qE6y57Ggfle75uIP0sCKtQIyZv4NB36D.b0Cd6NSNViAO', ''),
(20, 'hansja Kithmal ', 'hans12@gmail.com', '0000-00-00', '', '', '', '$2y$10$9LSssA89Ky7YKx1evpEA6.NmFHYKDxPAR8VPFXyKXV7kKT.TwF7Fe', '');

-- --------------------------------------------------------

--
-- Table structure for table `patientAllergy`
--

CREATE TABLE `patientAllergy` (
  `PatientID` int NOT NULL,
  `Allergy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `PharmacyID` int NOT NULL,
  `RegNo` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `token` varchar(500) NOT NULL DEFAULT '',
  `pharmacistName` varchar(50) NOT NULL DEFAULT '',
  `contactNo` char(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `location` point DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `license` varchar(100) NOT NULL DEFAULT '',
  `document` varchar(100) NOT NULL DEFAULT '',
  `approvedDate` date NOT NULL DEFAULT '2025-04-01',
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`PharmacyID`, `RegNo`, `name`, `email`, `password`, `token`, `pharmacistName`, `contactNo`, `address`, `location`, `latitude`, `longitude`, `license`, `document`, `approvedDate`, `status`) VALUES
(1, 'REG001', 'City Pharmacy', 'citypharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. City Perera', '0772345678', '125 Galle Road, Colombo', 0x0000000001010000004f7974232cf9534000000000187f1b40, 6.874114990234375, 79.893319, 'LICENSE-REG001.pdf', 'DOC-REG001.pdf', '2025-03-02', 1),
(2, 'REG002', 'HealthPlus Pharmacy', 'healthpluspharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. HealthPlus Perera', '0719876543', '50 Peradeniya Road, Kandy', 0x00000000010100000017354ef946c8534070253b3602511b40, 6.82911, 79.1293319, 'LICENSE-REG002.pdf', 'DOC-REG002.pdf', '2025-01-31', 1),
(3, 'REG003', 'Medicare Pharmacy', 'medicarepharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Medicare Perera', '0751234567', '10 Church Street, Dehiwala', 0x00000000010100000057b08d7832fb53407164746dfd641b40, 6.8486229994097, 79.9249555, 'LICENSE-REG003.pdf', 'DOC-REG003.pdf', '2025-01-01', 1),
(4, 'REG004', 'Wellness Pharmacy', 'wellnesspharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Wellness Fernando', '0778765432', '30 Main Street, Jaffna', 0x00000000010100000000000000000000000000000000000000, 0, 0, 'LICENSE-REG004.pdf', 'DOC-REG004.pdf', '2024-12-02', 1),
(5, 'REG005', 'CareWell Pharmacy', 'carewellpharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. CareWell Fernando', '0723456789', '5 Temple Road, Anuradhapura', 0x00000000010100000000000000000000000000000000000000, 0, 0, 'LICENSE-REG005.pdf', 'DOC-REG005.pdf', '2024-11-02', 1),
(6, 'REG006', 'PharmaLife', 'pharmalife@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. PharmaLife Fernando', '0717654321', '80 Beach Road, Dehiwala', 0x000000000101000000d044d8f0f4fa53409d8026c286671b40, 6.8511, 79.9212, 'LICENSE-REG006.pdf', 'DOC-REG006.pdf', '2024-10-03', 1),
(7, 'REG007', 'Sri Lanka Pharmacy', 'srilankapharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Sri Silva', '0756543210', '22 Hill Street, Nuwara Eliya', 0x00000000010100000000000000000000000000000000000000, 0, 0, 'LICENSE-REG007.pdf', 'DOC-REG007.pdf', '2024-09-03', 1),
(8, 'REG008', 'LifeCare Pharmacy', 'lifecarepharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. LifeCare Silva', '0779988776', '70 Market Street, Nugegoda', 0x000000000101000000d044d8f0f4fa53409d8026c286671b40, 6.8511, 79.9212, 'LICENSE-REG008.pdf', 'DOC-REG008.pdf', '2024-08-04', 1),
(9, 'REG009', 'Ceylon Pharmacy', 'ceylonpharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Ceylon Silva', '0711122334', '45 River Road, Kurunegala', 0x00000000010100000000000000000000000000000000000000, 0, 0, 'LICENSE-REG009.pdf', 'DOC-REG009.pdf', '2024-07-05', 1),
(10, 'REG010', 'Royal Pharmacy', 'royalpharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Royal Jayawardena', '0774433221', '15 Central Road, Badulla', 0x00000000010100000000000000000000000000000000000000, 0, 0, 'LICENSE-REG010.pdf', 'DOC-REG010.pdf', '2024-06-05', 1),
(11, 'REG011', 'MediCare Plus', 'medicareplus@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. MediCare Jayawardena', '0771234590', '45 Duplication Road, Colombo 03', 0x0000000001010000004260e5d022f75340a3923a014d841b40, 6.8792, 79.8615, 'LICENSE-REG011.pdf', 'DOC-REG011.pdf', '2024-05-06', 1),
(12, 'REG012', 'Union Pharmacy', 'unionpharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Union Jayawardena', '0712345677', '78 Reid Avenue, Colombo 07', 0x000000000101000000107a36ab3ef75340ed9e3c2cd49a1b40, 6.9012, 79.8632, 'LICENSE-REG012.pdf', 'DOC-REG012.pdf', '2024-04-06', 1),
(13, 'REG013', 'Health First Pharmacy', 'healthfirstpharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Health Jayawardena', '0752345633', '22 Marine Drive, Dehiwala', 0x00000000010100000097ff907efbfa534012a5bdc117661b40, 6.8497, 79.9216, 'LICENSE-REG013.pdf', 'DOC-REG013.pdf', '2024-03-07', 1),
(14, 'REG014', 'New City Pharmacy', 'newcitypharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. New Jayawardena', '0773456788', '130 Galle Road, Bambalapitiya', 0x000000000101000000d712f241cff65340eb73b515fb8b1b40, 6.8867, 79.8564, 'LICENSE-REG014.pdf', 'DOC-REG014.pdf', '2024-02-06', 1),
(15, 'REG015', 'Colombo Pharmacy', 'colombopharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Colombo Jayawardena', '0722345612', '55 High Level Road, Maharagama', 0x0000000001010000008104c58f31fb5340f931e6ae25641b40, 6.8478, 79.9249, 'LICENSE-REG015.pdf', 'DOC-REG015.pdf', '2024-01-07', 1),
(16, 'REG016', 'Green Cross Pharmacy', 'greencrosspharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Green Jayawardena', '0715678901', '92 Beach Road, Dehiwala', 0x0000000001010000003b014d840dfb534063ee5a423e681b40, 6.8518, 79.9227, 'LICENSE-REG016.pdf', 'DOC-REG016.pdf', '2023-12-08', 1),
(17, 'REG017', 'Central Drugs', 'centraldrugs@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Central Jayawardena', '0753214567', '17 Park Road, Nugegoda', 0x000000000101000000bd5296218ef953404bea043411761b40, 6.8653, 79.8993, 'LICENSE-REG017.pdf', 'DOC-REG017.pdf', '2023-11-08', 1),
(18, 'REG018', 'Wellcare Pharmacy', 'wellcarepharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Wellcare Jayawardena', '0778901234', '85 Market Street, Nugegoda', 0x0000000001010000007b14ae47e1fa5340d49ae61da7681b40, 6.8522, 79.92, 'LICENSE-REG018.pdf', 'DOC-REG018.pdf', '2023-10-09', 1),
(19, 'REG019', 'Family Pharmacy', 'familypharmacy@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Family Jayawardena', '0712223344', '32 Temple Road, Colombo 10', 0x0000000001010000009eefa7c64bf75340ddb5847cd0b31b40, 6.9256, 79.864, 'LICENSE-REG019.pdf', 'DOC-REG019.pdf', '2023-09-09', 1),
(20, 'REG020', 'Lanka Medicals', 'lankamedicals@pharmacy.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', '', 'Dr. Lanka Jayawardena', '0779090909', '12 Hospital Road, Dehiwala', 0x000000000101000000c217265305fb5340f4fdd478e9661b40, 6.8505, 79.9222, 'LICENSE-REG020.pdf', 'DOC-REG020.pdf', '2023-08-10', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `StockInventoryDetails`
-- (See below for the actual view)
--
CREATE TABLE `StockInventoryDetails` (
`InventoryId` int
,`PharmacyID` int
,`PharmacyName` varchar(30)
,`ProductID` int
,`ProductName` varchar(50)
,`genericName` varchar(30)
,`category` varchar(20)
,`strength` varchar(10)
,`Manufacturer` varchar(50)
,`SellingPrice` double
,`availableCount` int
,`thresholdLimit` int
,`storageLocation` varchar(10)
,`storageConditions` varchar(50)
,`LastStockID` int
,`LastStockQuantity` int
,`manufacturingDate` date
,`expiryDate` date
,`purchaseDate` date
,`purchaseCost` double
,`batchNumber` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `stockPurchase`
--

CREATE TABLE `stockPurchase` (
  `StockID` int NOT NULL,
  `InventoryID` int NOT NULL,
  `stockQuantity` int NOT NULL,
  `manufacturingDate` date DEFAULT NULL,
  `expiryDate` date NOT NULL,
  `purchaseCost` double NOT NULL,
  `purchaseDate` date NOT NULL,
  `batchNumber` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockPurchase`
--

INSERT INTO `stockPurchase` (`StockID`, `InventoryID`, `stockQuantity`, `manufacturingDate`, `expiryDate`, `purchaseCost`, `purchaseDate`, `batchNumber`) VALUES
(1, 1, 25, '2024-10-10', '2026-10-15', 7500, '2024-10-15', 'BATCH-P1001'),
(2, 1, 35, '2024-11-15', '2026-11-20', 10500, '2024-11-20', 'BATCH-P1002'),
(3, 2, 15, '2024-08-31', '2026-03-05', 7125, '2024-09-05', 'BATCH-N5001'),
(4, 2, 20, '2024-12-05', '2026-06-10', 9500, '2024-12-10', 'BATCH-N5002'),
(5, 3, 60, '2024-08-13', '2026-08-18', 6000, '2024-08-18', 'BATCH-S1001'),
(6, 3, 50, '2024-10-20', '2026-10-25', 5000, '2024-10-25', 'BATCH-S1002'),
(7, 4, 10, '2024-07-25', '2026-01-30', 7000, '2024-07-30', 'BATCH-G8501'),
(8, 4, 15, '2024-11-07', '2026-05-12', 10500, '2024-11-12', 'BATCH-G8502'),
(9, 5, 8, '2024-09-17', '2026-03-22', 4800, '2024-09-22', 'BATCH-J2001'),
(10, 5, 10, '2024-11-30', '2026-06-05', 6000, '2024-12-05', 'BATCH-J2002'),
(11, 21, 30, '2024-08-10', '2026-08-15', 9750, '2024-08-15', 'BATCH-T4001'),
(12, 21, 35, '2024-11-05', '2026-11-10', 11375, '2024-11-10', 'BATCH-T4002'),
(13, 25, 10, '2024-09-13', '2026-03-18', 6000, '2024-09-18', 'BATCH-T4003'),
(14, 25, 15, '2024-12-17', '2026-06-22', 9000, '2024-12-22', 'BATCH-T4004'),
(15, 30, 25, '2024-06-30', '2025-07-05', 3750, '2024-07-05', 'BATCH-J5001'),
(16, 30, 35, '2024-10-07', '2025-10-12', 5250, '2024-10-12', 'BATCH-J5002'),
(17, 35, 15, '2024-08-23', '2026-02-28', 9750, '2024-08-28', 'BATCH-J5003'),
(18, 35, 20, '2024-11-25', '2026-05-30', 13000, '2024-11-30', 'BATCH-J5004'),
(19, 40, 30, '2024-09-10', '2026-09-15', 4500, '2024-09-15', 'BATCH-P8001'),
(20, 40, 20, '2024-12-13', '2026-12-18', 3000, '2024-12-18', 'BATCH-P8002'),
(21, 42, 50, '2024-08-15', '2026-08-20', 5250, '2024-08-20', 'BATCH-S1005'),
(22, 42, 55, '2024-11-20', '2026-11-25', 5775, '2024-11-25', 'BATCH-S1006'),
(23, 45, 25, '2024-09-05', '2026-03-10', 8500, '2024-09-10', 'BATCH-M5005'),
(24, 45, 30, '2024-12-10', '2026-06-15', 10200, '2024-12-15', 'BATCH-M5006'),
(25, 51, 20, '2024-07-17', '2026-01-22', 9350, '2024-07-22', 'BATCH-N5005'),
(26, 51, 25, '2024-10-23', '2026-04-28', 11675, '2024-10-28', 'BATCH-N5006'),
(27, 55, 15, '2024-07-31', '2026-08-05', 2400, '2024-08-05', 'BATCH-A2505'),
(28, 55, 35, '2024-11-03', '2026-11-08', 5600, '2024-11-08', 'BATCH-A2506'),
(29, 61, 30, '2024-09-20', '2026-03-25', 9150, '2024-09-25', 'BATCH-P2007'),
(30, 61, 25, '2024-12-25', '2026-06-30', 7625, '2024-12-30', 'BATCH-P2008'),
(31, 7, 15, '2025-03-08', '2027-03-10', 2550, '2025-03-10', 'BATCH-R1003'),
(32, 8, 30, '2025-03-13', '2027-03-15', 3900, '2025-03-15', 'BATCH-A2507'),
(33, 11, 25, '2025-03-03', '2027-03-05', 7750, '2025-03-05', 'BATCH-T4005'),
(34, 13, 40, '2025-03-20', '2027-03-22', 4800, '2025-03-22', 'BATCH-G8503'),
(35, 16, 30, '2025-03-16', '2027-03-18', 10500, '2025-03-18', 'BATCH-M5007'),
(36, 31, 22, '2025-03-06', '2027-03-08', 7370, '2025-03-08', 'BATCH-T4006'),
(37, 45, 18, '2025-03-23', '2027-03-25', 6120, '2025-03-25', 'BATCH-M5008'),
(38, 52, 24, '2025-03-10', '2027-03-12', 16080, '2025-03-12', 'BATCH-G8504'),
(39, 67, 35, '2025-03-18', '2027-03-20', 4200, '2025-03-20', 'BATCH-S1009'),
(40, 78, 28, '2025-03-28', '2027-03-30', 4368, '2025-03-30', 'BATCH-T4010'),
(41, 3, 40, '2025-04-01', '2027-04-02', 4000, '2025-04-02', 'BATCH-S1010'),
(42, 6, 25, '2025-04-04', '2027-04-05', 1875, '2025-04-05', 'BATCH-B1001'),
(43, 17, 18, '2025-04-07', '2027-04-08', 3060, '2025-04-08', 'BATCH-A5001'),
(44, 22, 30, '2025-04-02', '2027-04-03', 12000, '2025-04-03', 'BATCH-P1010'),
(45, 28, 15, '2025-04-09', '2027-04-10', 2400, '2025-04-10', 'BATCH-A2510'),
(46, 36, 22, '2025-04-11', '2027-04-12', 13420, '2025-04-12', 'BATCH-M1001'),
(47, 48, 30, '2025-04-06', '2027-04-07', 9000, '2025-04-07', 'BATCH-E1001'),
(48, 54, 25, '2025-04-08', '2027-04-09', 3250, '2025-04-09', 'BATCH-A5002'),
(49, 65, 20, '2025-04-10', '2027-04-11', 12000, '2025-04-11', 'BATCH-T4011'),
(50, 73, 35, '2025-04-13', '2027-04-14', 29750, '2025-04-14', 'BATCH-G8510'),
(51, 5, 5, '2025-04-15', '2027-04-15', 3000, '2025-04-15', 'BATCH-T4015'),
(52, 9, 10, '2025-04-16', '2027-04-16', 3500, '2025-04-16', 'BATCH-M5015'),
(53, 14, 12, '2025-04-15', '2027-04-15', 960, '2025-04-15', 'BATCH-B1015'),
(54, 18, 8, '2025-04-16', '2027-04-16', 1360, '2025-04-16', 'BATCH-A2515'),
(55, 23, 6, '2025-04-15', '2027-04-15', 1530, '2025-04-15', 'BATCH-S1015');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `token` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `token`) VALUES
(14, 'www.hansaja@gmail.com', '$2y$10$S4ODbC7S6qNgvAY1HLnhQeTAMj3atP1Smz7V97cGFwWFlAWqgTVmO', 'hansaja', '37d651e33b65784177c1c5b4c1925bc7f33a937a88481996737af3221348e1175c77b05e332dd6d5a80e8bc2c67b3dda'),
(15, 'hkd@gmail.com', '$2y$10$K7aiI6LdFxeaXDRJoPlVHOKYEWaMknYFARj5fsxV7RZ0G/w9WArdq', 'hansaja', 'eafb5072b5a50eef3d6848b3351d919b516a9047ff18a921fcddaf078abfe61e8bde493c1d1309162f885fa6938a0a3a'),
(16, 'test@gmail.com', '$2y$10$tfmubxRXj5ME1ni74TjBqOnCMmpDnstymGIUJ6x0zetfCSIHStFii', 'hansaja test', NULL),
(21, 'han@gmail.com', '$2y$10$nMvKCQVD7OSRvfVx2oowdOA4YR3kDGzAjpuMnADXUV.pU6gCtvTwO', 'hansaja', NULL);

-- --------------------------------------------------------

--
-- Structure for view `InventoryView`
--
DROP TABLE IF EXISTS `InventoryView`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `InventoryView`  AS SELECT `drugInventory`.`PharmacyID` AS `PharmacyID`, `pharmacy`.`name` AS `name`, `pharmacy`.`address` AS `address`, `pharmacy`.`contactNo` AS `contactNo`, `pharmacy`.`latitude` AS `latitude`, `pharmacy`.`longitude` AS `longitude`, `drugInventory`.`InventoryId` AS `InventoryId`, `drugInventory`.`ProductID` AS `ProductID`, `MedicineProducts`.`ProductName` AS `ProductName`, `MedicineProducts`.`genericName` AS `genericName`, `MedicineProducts`.`strength` AS `strength`, `drugInventory`.`unitPrice` AS `unitPrice`, `drugInventory`.`availableCount` AS `availableCount` FROM ((`drugInventory` join `pharmacy` on((`pharmacy`.`PharmacyID` = `drugInventory`.`PharmacyID`))) left join `MedicineProducts` on((`MedicineProducts`.`ProductID` = `drugInventory`.`ProductID`))) ORDER BY `drugInventory`.`PharmacyID` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `MedicineProducts`
--
DROP TABLE IF EXISTS `MedicineProducts`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `MedicineProducts`  AS SELECT `manufacturedDrug`.`ProductID` AS `ProductID`, `manufacturedDrug`.`ProductName` AS `ProductName`, `drug`.`genericName` AS `genericName`, `manufacture`.`ManufactureName` AS `ManufactureName`, `manufacturedDrug`.`strength` AS `strength`, `manufacturedDrug`.`price` AS `unitPrice` FROM ((`manufacturedDrug` join `drug` on((`drug`.`DrugID` = `manufacturedDrug`.`DrugID`))) join `manufacture` on((`manufacture`.`ManufactureID` = `manufacturedDrug`.`ManufactureID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `OrderView`
--
DROP TABLE IF EXISTS `OrderView`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `OrderView`  AS SELECT `mo`.`OrderID` AS `OrderID`, `mo`.`date` AS `date`, `mo`.`status` AS `status`, `mo`.`pickup` AS `pickup`, `mo`.`destination` AS `destination`, `mo`.`PatientID` AS `PatientID`, `p`.`patientName` AS `patientName`, `mo`.`prescription` AS `prescription`, `mo`.`totalBill` AS `totalBill`, `mo`.`paymentMethod` AS `paymentMethod`, `mo`.`PharmacyID` AS `PharmacyID`, `ph`.`name` AS `name`, `ol`.`ProductID` AS `ProductID`, `mp`.`ProductName` AS `ProductName`, `mp`.`genericName` AS `genericName`, `mp`.`ManufactureName` AS `ManufactureName`, `mp`.`strength` AS `strength`, `di`.`unitPrice` AS `unitPrice`, `ol`.`quantity` AS `quantity` FROM (((((`medicineOrder` `mo` join `pharmacy` `ph` on((`ph`.`PharmacyID` = `mo`.`PharmacyID`))) join `patient` `p` on((`p`.`PatientID` = `mo`.`PatientID`))) left join `orderList` `ol` on((`ol`.`OrderID` = `mo`.`OrderID`))) left join `drugInventory` `di` on((`di`.`InventoryId` = `ol`.`InventoryID`))) left join `MedicineProducts` `mp` on((`mp`.`ProductID` = `ol`.`ProductID`))) ORDER BY `mo`.`OrderID` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `StockInventoryDetails`
--
DROP TABLE IF EXISTS `StockInventoryDetails`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `StockInventoryDetails`  AS SELECT `di`.`InventoryId` AS `InventoryId`, `di`.`PharmacyID` AS `PharmacyID`, `p`.`name` AS `PharmacyName`, `di`.`ProductID` AS `ProductID`, `md`.`ProductName` AS `ProductName`, `d`.`genericName` AS `genericName`, `d`.`category` AS `category`, `md`.`strength` AS `strength`, `m`.`ManufactureName` AS `Manufacturer`, `di`.`unitPrice` AS `SellingPrice`, `di`.`availableCount` AS `availableCount`, `di`.`thresholdLimit` AS `thresholdLimit`, `di`.`storageLocation` AS `storageLocation`, `di`.`storageConditions` AS `storageConditions`, `sp`.`StockID` AS `LastStockID`, `sp`.`stockQuantity` AS `LastStockQuantity`, `sp`.`manufacturingDate` AS `manufacturingDate`, `sp`.`expiryDate` AS `expiryDate`, `sp`.`purchaseDate` AS `purchaseDate`, `sp`.`purchaseCost` AS `purchaseCost`, `sp`.`batchNumber` AS `batchNumber` FROM (((((`drugInventory` `di` join `manufacturedDrug` `md` on((`di`.`ProductID` = `md`.`ProductID`))) join `drug` `d` on((`md`.`DrugID` = `d`.`DrugID`))) join `manufacture` `m` on((`md`.`ManufactureID` = `m`.`ManufactureID`))) join `pharmacy` `p` on((`di`.`PharmacyID` = `p`.`PharmacyID`))) left join (select `sp1`.`StockID` AS `StockID`,`sp1`.`InventoryID` AS `InventoryID`,`sp1`.`stockQuantity` AS `stockQuantity`,`sp1`.`manufacturingDate` AS `manufacturingDate`,`sp1`.`expiryDate` AS `expiryDate`,`sp1`.`purchaseCost` AS `purchaseCost`,`sp1`.`purchaseDate` AS `purchaseDate`,`sp1`.`batchNumber` AS `batchNumber` from (`stockPurchase` `sp1` join (select `stockPurchase`.`InventoryID` AS `InventoryID`,max(`stockPurchase`.`purchaseDate`) AS `LatestPurchaseDate` from `stockPurchase` group by `stockPurchase`.`InventoryID`) `sp2` on(((`sp1`.`InventoryID` = `sp2`.`InventoryID`) and (`sp1`.`purchaseDate` = `sp2`.`LatestPurchaseDate`))))) `sp` on((`di`.`InventoryId` = `sp`.`InventoryID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`DeliveryID`);

--
-- Indexes for table `deliveryold`
--
ALTER TABLE `deliveryold`
  ADD PRIMARY KEY (`DeliveryID`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverId`);

--
-- Indexes for table `drug`
--
ALTER TABLE `drug`
  ADD PRIMARY KEY (`DrugID`);

--
-- Indexes for table `drugInventory`
--
ALTER TABLE `drugInventory`
  ADD PRIMARY KEY (`InventoryId`),
  ADD KEY `FK_PharmacyInventory` (`PharmacyID`),
  ADD KEY `FK_ProductInventory` (`ProductID`);

--
-- Indexes for table `manufacture`
--
ALTER TABLE `manufacture`
  ADD PRIMARY KEY (`ManufactureID`);

--
-- Indexes for table `manufacturedDrug`
--
ALTER TABLE `manufacturedDrug`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `DrugID` (`DrugID`),
  ADD KEY `ManufactureID` (`ManufactureID`);

--
-- Indexes for table `medicineOrder`
--
ALTER TABLE `medicineOrder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_Patient` (`PatientID`),
  ADD KEY `FK_Driver` (`DeliveryID`),
  ADD KEY `FK_Pharmacy` (`PharmacyID`);

--
-- Indexes for table `medicineReminder`
--
ALTER TABLE `medicineReminder`
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexes for table `orderComments`
--
ALTER TABLE `orderComments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `orderList`
--
ALTER TABLE `orderList`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `FK_Product` (`ProductID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patientAllergy`
--
ALTER TABLE `patientAllergy`
  ADD KEY `FK_Allergy` (`PatientID`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`PharmacyID`);

--
-- Indexes for table `stockPurchase`
--
ALTER TABLE `stockPurchase`
  ADD PRIMARY KEY (`StockID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `DeliveryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `deliveryold`
--
ALTER TABLE `deliveryold`
  MODIFY `DeliveryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driverId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `drug`
--
ALTER TABLE `drug`
  MODIFY `DrugID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `drugInventory`
--
ALTER TABLE `drugInventory`
  MODIFY `InventoryId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `manufacture`
--
ALTER TABLE `manufacture`
  MODIFY `ManufactureID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `manufacturedDrug`
--
ALTER TABLE `manufacturedDrug`
  MODIFY `ProductID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `medicineOrder`
--
ALTER TABLE `medicineOrder`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderComments`
--
ALTER TABLE `orderComments`
  MODIFY `commentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PatientID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `PharmacyID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stockPurchase`
--
ALTER TABLE `stockPurchase`
  MODIFY `StockID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drugInventory`
--
ALTER TABLE `drugInventory`
  ADD CONSTRAINT `FK_PharmacyInventory` FOREIGN KEY (`PharmacyID`) REFERENCES `pharmacy` (`PharmacyID`),
  ADD CONSTRAINT `FK_ProductInventory` FOREIGN KEY (`ProductID`) REFERENCES `manufacturedDrug` (`ProductID`);

--
-- Constraints for table `manufacturedDrug`
--
ALTER TABLE `manufacturedDrug`
  ADD CONSTRAINT `manufacturedDrug_ibfk_1` FOREIGN KEY (`DrugID`) REFERENCES `drug` (`DrugID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacturedDrug_ibfk_2` FOREIGN KEY (`ManufactureID`) REFERENCES `manufacture` (`ManufactureID`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `medicineOrder`
--
ALTER TABLE `medicineOrder`
  ADD CONSTRAINT `FK_Patient` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`),
  ADD CONSTRAINT `FK_Pharmacy` FOREIGN KEY (`PharmacyID`) REFERENCES `pharmacy` (`PharmacyID`) ON DELETE CASCADE;

--
-- Constraints for table `medicineReminder`
--
ALTER TABLE `medicineReminder`
  ADD CONSTRAINT `medicineReminder_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`);

--
-- Constraints for table `patientAllergy`
--
ALTER TABLE `patientAllergy`
  ADD CONSTRAINT `FK_Allergy` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
