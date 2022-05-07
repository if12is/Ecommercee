-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2022 at 05:38 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Ordering` int DEFAULT NULL,
  `Visibility` tinyint NOT NULL DEFAULT '0',
  `Allow_Comment` tinyint NOT NULL DEFAULT '0',
  `Allow_Ads` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(1, 'Pc', '', 1, 0, 1, 0),
(2, 'Mobile', 'Mobile Acss..', 2, 1, 1, 0),
(5, 'Games', 'Games For Pc ', 1, 0, 0, 1),
(6, 'Monitor', 'Monitor for showing data ', 3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `items_comment` (`item_id`),
  KEY `comment_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(7, 'Thank You Too Match..', 1, '2022-04-16', 10, 4),
(8, 'Thank You ...', 1, '2022-04-05', 7, 4),
(9, 'Good product', 0, '2022-04-11', 11, 4),
(10, 'Not Good', 0, '2022-04-06', 8, 22);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `Item_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Imge` varchar(255) NOT NULL,
  `Status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Rating` smallint NOT NULL,
  `Approve` tinyint NOT NULL DEFAULT '0',
  `Cat_ID` int NOT NULL,
  `Member_ID` int NOT NULL,
  PRIMARY KEY (`Item_ID`),
  KEY `member_1` (`Member_ID`),
  KEY `cat_1` (`Cat_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Imge`, `Status`, `code`, `Rating`, `Approve`, `Cat_ID`, `Member_ID`) VALUES
(7, 'Dell', 'Dell Monitor', '300', '2022-04-03', 'USA', 'themes/img/products/monitor2', '1', 'Monitor', 0, 1, 6, 3),
(8, 'Samsung', 'Samsung ', '350', '2022-04-03', 'Japan', 'themes/img/products/mobile3', '1', 'Mobile', 0, 1, 6, 4),
(9, 'Oppo', 'Oppo mobile phone', '150', '2022-04-10', 'Chaina', 'themes/img/products/mobile', '1', 'Mobile', 0, 0, 2, 22),
(10, 'Vivo', 'Vivo mobile phone ', '120', '2022-04-16', 'China', 'themes/img/products/mobile1', '1', 'Mobile', 0, 0, 2, 20),
(11, 'Lenivo', 'phone company', '160', '2022-04-16', 'Japan', 'themes/img/products/mobile2', '1', 'Mobile', 0, 0, 2, 24),
(12, 'game1', 'game 1', '100', '2022-04-29', 'USA', 'themes/img/products/pngegg (1)', '1', 'Games', 0, 1, 5, 1),
(13, 'game', 'game ', '100', '2022-04-29', 'USA', 'themes/img/products/pngegg', '1', 'Games', 0, 1, 5, 1),
(14, 'game2', 'game 2', '100', '2022-04-29', 'USA', 'themes/img/products/pngegg (2)', '1', 'Games', 0, 1, 5, 1),
(15, 'game3', 'game 3', '100', '2022-04-29', 'USA', 'themes/img/products/pngegg (3)', '1', 'Games', 0, 1, 5, 1),
(16, 'game4', 'game 4', '100', '2022-04-29', 'USA', 'themes/img/products/pngegg (4)', '1', 'Games', 0, 1, 5, 1),
(17, 'game5', 'game 5', '100', '2022-04-29', 'USA', 'themes/img/products/pngegg (5)', '1', 'Games', 0, 1, 5, 1),
(18, 'game6', 'game 6', '100', '2022-04-29', 'USA', 'themes/img/products/pngegg (6)', '1', 'Games', 0, 1, 5, 1),
(19, 'Samsung', 'Samsung Monitor', '350', '2022-04-03', 'Japan', 'themes/img/products/monitor1', '1', 'Monitor', 0, 1, 6, 4),
(20, 'Samsung', 'Samsung Monitor', '350', '2022-04-03', 'Japan', 'themes/img/products/monitor3', '1', 'Monitor', 0, 1, 6, 4),
(21, 'Samsung', 'Samsung Monitor', '350', '2022-04-03', 'Japan', 'themes/img/products/monitor4', '1', 'Monitor', 0, 1, 6, 4),
(22, 'Samsung', 'Samsung Monitor', '350', '2022-04-03', 'Japan', 'themes/img/products/monitor5', '1', 'Monitor', 0, 1, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

DROP TABLE IF EXISTS `payment_info`;
CREATE TABLE IF NOT EXISTS `payment_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int NOT NULL AUTO_INCREMENT COMMENT 'User identify ',
  `Username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'User name to login',
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'password to login',
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Email to login',
  `FullName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Name OF User',
  `GroupID` int NOT NULL DEFAULT '0' COMMENT 'identify user group',
  `TrustStatus` int NOT NULL DEFAULT '0' COMMENT 'to identify the rank of object',
  `RegStatus` int NOT NULL DEFAULT '0' COMMENT 'user approval',
  `Date` date NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`) VALUES
(1, 'Ahmed', '3fd3280e5b62d32a0078c360edcb3acaa2dea131', 'ahmed0120@gmail.com', 'Ahmed Elsayed ', 1, 0, 1, '2022-01-31'),
(3, 'Osama', '3fd3280e5b62d32a0078c360edcb3acaa2dea131', 'osama_mo@gmail.info', 'Osama Mohamed', 0, 0, 0, '2022-03-11'),
(4, 'Naser', '3fd3280e5b62d32a0078c360edcb3acaa2dea131', 'naser@mail.com', 'Naser Yaser', 0, 0, 1, '2022-03-11'),
(19, 'Tamer', '3fd3280e5b62d32a0078c360edcb3acaa2dea131', 'tamer@ya.com', 'Tamer mohamed', 0, 0, 1, '2022-03-11'),
(20, 'yaseen', '3fd3280e5b62d32a0078c360edcb3acaa2dea131', 'yaseen@gmail.com', 'Yaseen bonoo', 0, 0, 1, '2022-03-11'),
(22, 'Mostafa', '3fd3280e5b62d32a0078c360edcb3acaa2dea131', 'mostafa@mail.com', 'Mostafa Goher', 0, 0, 1, '2022-03-11'),
(24, 'Sherf', '3fd3280e5b62d32a0078c360edcb3acaa2dea131', 'Sherf@mail.com', 'Sherf Sherf', 0, 0, 1, '2022-03-12'),
(25, 'sjau', '603e6907398c7e74e25c0ae8ec3a03ffac7c9bb4', 'sjau@hwu.cpo', 'sjau idnd', 0, 0, 1, '2022-03-27'),
(31, 'Ibrahim', '$2y$10$qLBRZ.GqUQ2rrwl9rXF51OXNA4OxReuCit75alRb3zDjfxr6QwQGW', 'ibrahim@gmail.com', 'Ibrahim Khaled', 0, 0, 0, '0000-00-00'),
(32, 'Fahmi', '3fd3280e5b62d32a0078c360edcb3acaa2dea131', 'Fahmi@gmail.com', 'Fahmi hamdy', 0, 0, 1, '2022-04-22'),
(33, 'Slama', '$2y$10$vKu9VEgig56Yan.jMNQUBu4mkqsDlONp7FWoK7oIFXndD9XNRh63e', 'redfxfhd@jhvjh.ot', 'ahmed iojk', 0, 0, 0, '2022-04-22');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
