-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 07:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arcane-reads`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `genre` (
  `GenreID` int(11) NOT NULL,
  `GenreName` varchar(50) NOT NULL,
  `GenreCoverImg` varchar(255) NOT NULL,
  `GenreDescription` varchar(255) NOT NULL,
  `GenreCatchPhrase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` float NOT NULL,
  `OrderDate` date NOT NULL,
  `OrderStatus` varchar(50) NOT NULL,
  `PaymentMethod` varchar(50) NOT NULL,
  `PaymentStatus` varchar(50) NOT NULL, -- Added missing comma
  `DeliveryAddress` varchar(255) NOT NULL, -- Added missing comma
  `DeliveryDate` date NOT NULL,
  `AuthorID` int(11) DEFAULT NULL,
  `ReaderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--
CREATE TABLE `payments` (
  `OrderID` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `AuthorID` int(11) DEFAULT NULL,
  `Amount` float NOT NULL,
  `PaymentDate` date  NOT NULL,
  `PaymentStatus`varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `novel`
--

CREATE TABLE `novel` (
  `NovelID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Price` float NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Summary` varchar(255) DEFAULT NULL,
  `CoverImgPath` varchar(255) DEFAULT NULL,
  `AuthorID` int(11) DEFAULT NULL,
  `GenreID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--


-- --------------------------------------------------------

--
-- Table structure for table `novelorder`
--

CREATE TABLE `novelorder` (
  `NovelID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--


-- --------------------------------------------------------


--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `ReviewID` int(11) NOT NULL,
  `ReviewDesc` varchar(255) NOT NULL,
  `ReaderID` int(11) DEFAULT NULL,
  `NovelID` int(11) DEFAULT NULL,
  `AuthorID` int(11) DEFAULT NULL,
  `OrderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--


-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `AuthorID` int(11) NOT NULL,
  `AuthorName` varchar(100) NOT NULL,
  `AuthorAddress` varchar(255) NOT NULL,
  `AuthorEmail` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--

-- --------------------------------------------------------

--
-- Table structure for table `reader`
--

CREATE TABLE `reader` (
  `ReaderID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `RegisterDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--



-- --------------------------------------------------------


--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`GenreID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `ReaderID` (`ReaderID`),
  ADD KEY `AuthorID` (`AuthorID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `novel`
--
ALTER TABLE `novel`
  ADD PRIMARY KEY (`NovelID`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- Indexes for table `novelorder`
--
ALTER TABLE `novelorder`
  ADD PRIMARY KEY (`NovelID`,`OrderID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `NovelID` (`NovelID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `seller`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`AuthorID`),
  ADD UNIQUE KEY `AuthorEmail` (`AuthorEmail`);

--
-- Indexes for table `user`
--
ALTER TABLE `reader`
  ADD PRIMARY KEY (`ReaderID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ReaderID`) REFERENCES `reader` (`ReaderID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`AuthorID`) REFERENCES `author` (`AuthorID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `author` (`AuthorID`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);

--
-- Constraints for table `novel`
--
ALTER TABLE `novel`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `author` (`AuthorID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `genre` (`GenreID`);

--
-- Constraints for table `productorder`
--
ALTER TABLE `novelorder`
  ADD CONSTRAINT `productorder_ibfk_1` FOREIGN KEY (`NovelID`) REFERENCES `novel` (`NovelID`),
  ADD CONSTRAINT `productorder_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);


--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`ReaderID`) REFERENCES `reader` (`ReaderID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`NovelID`) REFERENCES `novel` (`NovelID`),
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
