-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2022 at 12:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims_fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(7) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `media` int(11) DEFAULT 0,
  `quantity` int(3) DEFAULT NULL,
  `buy_price` int(5) DEFAULT NULL,
  `sell_price` int(10) NOT NULL,
  `vendor_id` int(7) UNSIGNED NOT NULL,
  `Status` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `name`, `media`, `quantity`, `buy_price`, `sell_price`, `vendor_id`, `Status`, `date`) VALUES
(1, 'Chocojar', 0, 427, 20, 23, 1, 'Discontinued', '2022-07-06'),
(2, 'RGB ink', 0, 3, 30, 40, 2, 'Discontinued', '2022-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `ID` int(7) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `customer` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `quantity` int(5) NOT NULL,
  `total` int(6) NOT NULL,
  `payment` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`ID`, `product_id`, `customer`, `date`, `description`, `quantity`, `total`, `payment`, `status`) VALUES
(1, 1, 'Amir Bakar', '2022-07-07', 'delivery to taman indah', 4, 92, 'Online Bankin', 'Approved'),
(2, 2, 'Iman', '2022-07-09', 'packed', 1, 40, 'Online Bankin', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` varchar(7) NOT NULL,
  `name` text NOT NULL,
  `age` int(2) NOT NULL,
  `position` varchar(20) NOT NULL,
  `salary` int(5) NOT NULL,
  `employment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `name`, `age`, `position`, `salary`, `employment_date`) VALUES
('AA0001', 'Amalina Hassan', 22, 'Clerk', 1500, '2022-06-09'),
('AA0002', 'Amir Bakar', 21, 'Sales Director', 1700, '2022-06-09'),
('AA0003', 'Fatin Rusydi', 21, 'Accountant', 1700, '2022-05-15'),
('AA0004', 'Fadhlina', 22, 'Clerk 1', 1500, '2022-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `status`, `last_login`) VALUES
(1, 'Nur Fadhlina', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1, '2022-06-07 22:05:55'),
(2, 'Natasya', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 1, '2022-06-07 22:06:45'),
(3, 'Iman', 'user', '12dea96fec20593566ab75692c9949596833adc9', 3, 1, '2022-06-07 22:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'admin', 1, 1),
(2, 'special', 2, 1),
(3, 'user', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `ID` int(7) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `PIC` text NOT NULL,
  `contact` int(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`ID`, `Name`, `PIC`, `contact`, `address`) VALUES
(1, 'Food Trading', 'Chua', 145607761, 'kempas'),
(2, 'Aik Seng Trading', 'Ming', 145607761, 'kempas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `media` (`media`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_level` (`user_level`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_level` (`group_level`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `ID` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `ID` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_Sales` FOREIGN KEY (`product_id`) REFERENCES `product` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_group` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
