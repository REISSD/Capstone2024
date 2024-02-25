-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 21, 2024 at 11:20 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_Id` int NOT NULL,
  `User_Id` int DEFAULT NULL,
  `Poduct_Id` int DEFAULT NULL,
  `Amount` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `decorations`
--

CREATE TABLE `decorations` (
  `Decorations_Id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Cost` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `decorations`
--

INSERT INTO `decorations` (`Decorations_Id`, `Name`, `Cost`) VALUES
(1, 'Rocks', 2.99),
(2, 'Underwater Tree', 4.99),
(3, 'SpongeBob house', 12.99),
(4, 'Large Rocks', 4.99),
(5, 'Hollow Rocks And Tree Set', 19.99);

-- --------------------------------------------------------

--
-- Table structure for table `fishs`
--

CREATE TABLE `fishs` (
  `Fishs_Id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Cost` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `fishs`
--

INSERT INTO `fishs` (`Fishs_Id`, `Name`, `Cost`) VALUES
(1, 'Mickey Mouse Platy', 12.99),
(2, 'Guppies', 12.99),
(3, 'Zebra Danio', 13.99),
(4, 'Neon Tetra', 13.99),
(5, 'White Cloud Mountain Minnow', 10.99),
(6, 'Tiger Barb', 9.99);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `Guest` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `heaters`
--

CREATE TABLE `heaters` (
  `Heaters_Id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Cost` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `heaters`
--

INSERT INTO `heaters` (`Heaters_Id`, `Name`, `Cost`) VALUES
(1, 'Jonny Hang-On-Back Heater', 12.99),
(2, 'Jones Submersible Heater', 14.99),
(3, 'Stone\'s Inline Heater', 9.99),
(4, 'Luther Canister Heater', 15.99),
(5, 'Carry\'s Infrared Heater', 12.99);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Members_Id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_Id` int NOT NULL,
  `Cart_Id` int DEFAULT NULL,
  `Status` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `Plants_Id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Cost` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`Plants_Id`, `Name`, `Cost`) VALUES
(1, 'Dwarf Anubias', 2.99),
(2, 'Java Fern', 3.99),
(3, 'Moneywort', 2.99),
(4, 'Parrot\'s Feather', 3.99),
(5, 'Marimo Moss Balls', 4.99);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_Id` int NOT NULL,
  `Fish_Id` int DEFAULT NULL,
  `Plant_Id` int DEFAULT NULL,
  `Tank_Id` int DEFAULT NULL,
  `Heater_Id` int DEFAULT NULL,
  `Decoration_Id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tanks`
--

CREATE TABLE `tanks` (
  `Tanks_Id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Length` int DEFAULT NULL,
  `Width` int DEFAULT NULL,
  `Height` int DEFAULT NULL,
  `Measurement` varchar(45) NOT NULL,
  `Cost` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tanks`
--

INSERT INTO `tanks` (`Tanks_Id`, `Name`, `Length`, `Width`, `Height`, `Measurement`, `Cost`) VALUES
(1, 'Jones Special Tanks', 4, 5, 12, 'Inches', 40.99),
(2, 'Jaxs Tanks', 5, 6, 10, 'Inches', 62.99),
(3, 'Westward Tanks', 6, 6, 8, 'Inches', 51.99),
(4, 'Jonny\'s Medium Tanks', 5, 10, 12, 'Inches', 40.99),
(5, 'Steel Max Maga Tanks', 25, 10, 20, 'Inches', 60.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_Id` int NOT NULL,
  `Members_Id` int DEFAULT NULL,
  `Guest` tinyint NOT NULL,
  `Order_Id` int DEFAULT NULL,
  `Cart_Id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_Id`),
  ADD UNIQUE KEY `Cart_Id_UNIQUE` (`Cart_Id`),
  ADD KEY `User_Id_idx` (`User_Id`),
  ADD KEY `Product_Id_idx` (`Poduct_Id`);

--
-- Indexes for table `decorations`
--
ALTER TABLE `decorations`
  ADD PRIMARY KEY (`Decorations_Id`),
  ADD UNIQUE KEY `Decorations_Id_UNIQUE` (`Decorations_Id`);

--
-- Indexes for table `fishs`
--
ALTER TABLE `fishs`
  ADD PRIMARY KEY (`Fishs_Id`),
  ADD UNIQUE KEY `Fishs_Id_UNIQUE` (`Fishs_Id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`Guest`);

--
-- Indexes for table `heaters`
--
ALTER TABLE `heaters`
  ADD PRIMARY KEY (`Heaters_Id`),
  ADD UNIQUE KEY `Heaters_Id_UNIQUE` (`Heaters_Id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Members_Id`),
  ADD UNIQUE KEY `Members_Id_UNIQUE` (`Members_Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_Id`),
  ADD UNIQUE KEY `Order_Id_UNIQUE` (`Order_Id`),
  ADD KEY `Cart_Id_idx` (`Cart_Id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`Plants_Id`),
  ADD UNIQUE KEY `Plants_Id_UNIQUE` (`Plants_Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_Id`),
  ADD UNIQUE KEY `Product_Id_UNIQUE` (`Product_Id`),
  ADD KEY `Fish_Id_idx` (`Fish_Id`),
  ADD KEY `Plant_Id_idx` (`Plant_Id`),
  ADD KEY `Tank_Id_idx` (`Tank_Id`),
  ADD KEY `Heater_Id_idx` (`Heater_Id`),
  ADD KEY `Decoration_Id_idx` (`Decoration_Id`);

--
-- Indexes for table `tanks`
--
ALTER TABLE `tanks`
  ADD PRIMARY KEY (`Tanks_Id`),
  ADD UNIQUE KEY `Tanks_Id_UNIQUE` (`Tanks_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD UNIQUE KEY `Members_Id_UNIQUE` (`Members_Id`),
  ADD KEY `Order_Id` (`Order_Id`),
  ADD KEY `Member_Id` (`Members_Id`) INVISIBLE,
  ADD KEY `Guest` (`Guest`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `Members_Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `Product_Id` FOREIGN KEY (`Poduct_Id`) REFERENCES `product` (`Product_Id`),
  ADD CONSTRAINT `User_Id` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Cart_Id` FOREIGN KEY (`Cart_Id`) REFERENCES `cart` (`Cart_Id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Decoration_Id` FOREIGN KEY (`Decoration_Id`) REFERENCES `decorations` (`Decorations_Id`),
  ADD CONSTRAINT `Fish_Id` FOREIGN KEY (`Fish_Id`) REFERENCES `fishs` (`Fishs_Id`),
  ADD CONSTRAINT `Heater_Id` FOREIGN KEY (`Heater_Id`) REFERENCES `heaters` (`Heaters_Id`),
  ADD CONSTRAINT `Plant_Id` FOREIGN KEY (`Plant_Id`) REFERENCES `plants` (`Plants_Id`),
  ADD CONSTRAINT `Tank_Id` FOREIGN KEY (`Tank_Id`) REFERENCES `tanks` (`Tanks_Id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Guest` FOREIGN KEY (`Guest`) REFERENCES `guest` (`Guest`),
  ADD CONSTRAINT `Member_Id` FOREIGN KEY (`Members_Id`) REFERENCES `members` (`Members_Id`),
  ADD CONSTRAINT `Order_Id` FOREIGN KEY (`Order_Id`) REFERENCES `orders` (`Order_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
