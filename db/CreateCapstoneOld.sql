-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2024 at 04:36 PM
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
  `Cart_id` int NOT NULL,
  `User_id` int DEFAULT NULL,
  `incart_product` int DEFAULT NULL,
  `Amount` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comments_id` int NOT NULL,
  `Comments_info` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Comments_members_id` int DEFAULT NULL,
  `Comments_fishs_id` int DEFAULT NULL,
  `Comments_heaters_id` int DEFAULT NULL,
  `Comments_plants_id` int DEFAULT NULL,
  `Comments_tanks_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `decorations`
--

CREATE TABLE `decorations` (
  `Decorations_Id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Cost` float DEFAULT NULL,
  `Decoration_comment_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `decorations`
--

INSERT INTO `decorations` (`Decorations_Id`, `Name`, `Cost`, `Decoration_comment_id`) VALUES
(1, 'Rocks', 2.99, NULL),
(2, 'Underwater Tree', 4.99, NULL),
(3, 'SpongeBob house', 12.99, NULL),
(4, 'Large Rocks', 4.99, NULL),
(5, 'Hollow Rocks And Tree Set', 19.99, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fishs`
--

CREATE TABLE `fishs` (
  `Fishs_id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Cost` float DEFAULT NULL,
  `Fish_comment_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `fishs`
--

INSERT INTO `fishs` (`Fishs_id`, `Name`, `Cost`, `Fish_comment_id`) VALUES
(1, 'Mickey Mouse Platy', 12.99, NULL),
(2, 'Guppies', 12.99, NULL),
(3, 'Zebra Danio', 13.99, NULL),
(4, 'Neon Tetra', 13.99, NULL),
(5, 'White Cloud Mountain Minnow', 10.99, NULL),
(6, 'Tiger Barb', 9.99, NULL);

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
  `Heaters_id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Cost` float DEFAULT NULL,
  `Heater_comments_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `heaters`
--

INSERT INTO `heaters` (`Heaters_id`, `Name`, `Cost`, `Heater_comments_id`) VALUES
(1, 'Jonny Hang-On-Back Heater', 12.99, NULL),
(2, 'Jones Submersible Heater', 14.99, NULL),
(3, 'Stones Inline Heater', 9.99, NULL),
(4, 'Luther Canister Heater', 15.99, NULL),
(5, 'Carrys Infrared Heater', 12.99, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `incartproduct`
--

CREATE TABLE `incartproduct` (
  `Incart_product_id` int NOT NULL,
  `Fish_id` int DEFAULT NULL,
  `Plant_id` int DEFAULT NULL,
  `Tank_id` int DEFAULT NULL,
  `Heater_id` int DEFAULT NULL,
  `Decoration_id` int DEFAULT NULL,
  `Cart_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Members_Id` int NOT NULL,
  `Name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Password` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Comment_id` int DEFAULT NULL,
  `address` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Members_Id`, `Name`, `Password`, `Comment_id`, `address`, `email`) VALUES
(1, 'James', 'JJmes', NULL, '123 James St', 'James@mail.vom'),
(2, 'Sython', 'SS', NULL, '3452 Syth Street', 'Sython@mail.com');

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
  `Plants_id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Cost` float DEFAULT NULL,
  `Plants_comment_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`Plants_id`, `Name`, `Cost`, `Plants_comment_id`) VALUES
(1, 'Dwarf Anubias', 2.99, NULL),
(2, 'Java Fern', 3.99, NULL),
(3, 'Moneywort', 2.99, NULL),
(4, 'Parrots Feather', 3.99, NULL),
(5, 'Marimo Moss Balls', 4.99, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tanks`
--

CREATE TABLE `tanks` (
  `Tanks_id` int NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Length` int DEFAULT NULL,
  `Width` int DEFAULT NULL,
  `Height` int DEFAULT NULL,
  `Measurement` varchar(45) NOT NULL,
  `Cost` float DEFAULT NULL,
  `Tanks_comment_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tanks`
--

INSERT INTO `tanks` (`Tanks_id`, `Name`, `Length`, `Width`, `Height`, `Measurement`, `Cost`, `Tanks_comment_id`) VALUES
(1, 'Jones Special Tanks', 4, 5, 12, 'Inches', 40.99, NULL),
(2, 'Jaxs Tanks', 5, 6, 10, 'Inches', 62.99, NULL),
(3, 'Westward Tanks', 6, 6, 8, 'Inches', 51.99, NULL),
(4, 'Jonnys Medium Tanks', 5, 10, 12, 'Inches', 40.99, NULL),
(5, 'Steel Max Maga Tanks', 25, 10, 20, 'Inches', 60.99, NULL);

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
  ADD PRIMARY KEY (`Cart_id`),
  ADD UNIQUE KEY `Cart_Id_UNIQUE` (`Cart_id`),
  ADD KEY `User_Id_idx` (`User_id`),
  ADD KEY `Product_Id_idx` (`incart_product`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comments_id`),
  ADD KEY `Comments_members_id_idx` (`Comments_members_id`),
  ADD KEY `Comments_heaters_id_idx` (`Comments_heaters_id`) INVISIBLE,
  ADD KEY `Comments_plants_id_idx` (`Comments_plants_id`) INVISIBLE,
  ADD KEY `Comments_tanks_id_idx` (`Comments_tanks_id`),
  ADD KEY `Coments_fishs_id_idx` (`Comments_fishs_id`) INVISIBLE;

--
-- Indexes for table `decorations`
--
ALTER TABLE `decorations`
  ADD PRIMARY KEY (`Decorations_Id`),
  ADD KEY `Decorations_comment_Id_idx` (`Decoration_comment_id`) USING BTREE;

--
-- Indexes for table `fishs`
--
ALTER TABLE `fishs`
  ADD PRIMARY KEY (`Fishs_id`),
  ADD KEY `Fish_comments_id_idx` (`Fish_comment_id`) INVISIBLE;

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`Guest`);

--
-- Indexes for table `heaters`
--
ALTER TABLE `heaters`
  ADD PRIMARY KEY (`Heaters_id`),
  ADD KEY `Heater_comments_id_idx` (`Heater_comments_id`);

--
-- Indexes for table `incartproduct`
--
ALTER TABLE `incartproduct`
  ADD PRIMARY KEY (`Incart_product_id`),
  ADD UNIQUE KEY `Product_Id_UNIQUE` (`Incart_product_id`),
  ADD KEY `Fish_Id_idx` (`Fish_id`),
  ADD KEY `Plant_Id_idx` (`Plant_id`),
  ADD KEY `Tank_Id_idx` (`Tank_id`),
  ADD KEY `Heater_Id_idx` (`Heater_id`),
  ADD KEY `Decoration_Id_idx` (`Decoration_id`),
  ADD KEY `Cart_id_idx` (`Cart_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Members_Id`),
  ADD UNIQUE KEY `Members_Id_UNIQUE` (`Members_Id`),
  ADD KEY `comment_id_idx` (`Comment_id`);

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
  ADD PRIMARY KEY (`Plants_id`),
  ADD UNIQUE KEY `Plants_Id_UNIQUE` (`Plants_id`),
  ADD KEY `Plant_comments_id_idx` (`Plants_comment_id`);

--
-- Indexes for table `tanks`
--
ALTER TABLE `tanks`
  ADD PRIMARY KEY (`Tanks_id`),
  ADD UNIQUE KEY `Tanks_Id_UNIQUE` (`Tanks_id`),
  ADD KEY `Tanks_comments_id_idx` (`Tanks_comment_id`);

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
  MODIFY `Cart_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incartproduct`
--
ALTER TABLE `incartproduct`
  MODIFY `Incart_product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `Members_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_Id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `incart_product_id` FOREIGN KEY (`incart_product`) REFERENCES `incartproduct` (`Incart_product_id`),
  ADD CONSTRAINT `User_Id` FOREIGN KEY (`User_id`) REFERENCES `users` (`User_Id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Comment_member_id` FOREIGN KEY (`Comments_members_id`) REFERENCES `members` (`Members_Id`),
  ADD CONSTRAINT `Comments_fish_id` FOREIGN KEY (`Comments_fishs_id`) REFERENCES `fishs` (`Fishs_id`),
  ADD CONSTRAINT `Comments_heaters_id` FOREIGN KEY (`Comments_heaters_id`) REFERENCES `heaters` (`Heaters_id`),
  ADD CONSTRAINT `Comments_members_id` FOREIGN KEY (`Comments_members_id`) REFERENCES `members` (`Members_Id`),
  ADD CONSTRAINT `Comments_plants_id` FOREIGN KEY (`Comments_plants_id`) REFERENCES `plants` (`Plants_id`),
  ADD CONSTRAINT `Comments_tanks_id` FOREIGN KEY (`Comments_tanks_id`) REFERENCES `tanks` (`Tanks_id`);

--
-- Constraints for table `fishs`
--
ALTER TABLE `fishs`
  ADD CONSTRAINT `Fish_comments_id` FOREIGN KEY (`Fish_comment_id`) REFERENCES `comments` (`Comments_id`);

--
-- Constraints for table `heaters`
--
ALTER TABLE `heaters`
  ADD CONSTRAINT `Heater_comments_id` FOREIGN KEY (`Heater_comments_id`) REFERENCES `comments` (`Comments_id`);

--
-- Constraints for table `incartproduct`
--
ALTER TABLE `incartproduct`
  ADD CONSTRAINT `Decoration_Id` FOREIGN KEY (`Decoration_id`) REFERENCES `decorations` (`Decorations_Id`),
  ADD CONSTRAINT `Fish_Id` FOREIGN KEY (`Fish_id`) REFERENCES `fishs` (`Fishs_id`),
  ADD CONSTRAINT `Heater_Id` FOREIGN KEY (`Heater_id`) REFERENCES `heaters` (`Heaters_id`),
  ADD CONSTRAINT `Plant_iId` FOREIGN KEY (`Plant_id`) REFERENCES `plants` (`Plants_id`),
  ADD CONSTRAINT `Tank_Id` FOREIGN KEY (`Tank_id`) REFERENCES `tanks` (`Tanks_id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `Comment_id` FOREIGN KEY (`Comment_id`) REFERENCES `comments` (`Comments_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Cart_Id` FOREIGN KEY (`Cart_Id`) REFERENCES `cart` (`Cart_id`);

--
-- Constraints for table `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `Plant_comments_id` FOREIGN KEY (`Plants_comment_id`) REFERENCES `comments` (`Comments_id`);

--
-- Constraints for table `tanks`
--
ALTER TABLE `tanks`
  ADD CONSTRAINT `Tanks_comments_id` FOREIGN KEY (`Tanks_comment_id`) REFERENCES `comments` (`Comments_id`);

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
