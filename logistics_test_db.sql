-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 12:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics_test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `supplier_id`, `price`) VALUES
(1, 'iphone', 1, 200),
(3, 'lenuvo l3', 1, 400),
(4, 'Airpods apple ss2', 2, 100),
(8, 'ipohonexx', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`) VALUES
(1, 'amazon'),
(2, 'noon'),
(3, 'Jumia'),
(4, 'amazon.egp'),
(5, 'alibaba'),
(6, 'souq');

-- --------------------------------------------------------

--
-- Table structure for table `trucks`
--

CREATE TABLE `trucks` (
  `truck_model` varchar(100) NOT NULL,
  `truck_type` varchar(100) NOT NULL,
  `truck_capacity` varchar(100) NOT NULL,
  `truck_id` int(11) NOT NULL,
  `truck_shipping_price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `trucks`
--

INSERT INTO `trucks` (`truck_model`, `truck_type`, `truck_capacity`, `truck_id`, `truck_shipping_price`) VALUES
('Chevorlet', 'Box truck', '20 meter cupe', 2, '50'),
('Toyota', 'Box truck', '30 meter cupe', 3, '80'),
('Ford F', 'Trailer', '60 meter cupe', 4, '100');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(10213, 'eeew', 'ee'),
(11600, 'assr', '1212'),
(22109, 'ahmed2', '666666'),
(23459, 'lol', '22'),
(32347, 'eeer', '4444'),
(32432, 'ahmd', '1111'),
(32866, 'eer', 'fff'),
(38738, 'ahmed2', '111222'),
(39875, '44', '33'),
(41803, 'ahmedd', '22'),
(43109, 'dd', 'dd'),
(52769, 'mostafa', '666666'),
(53516, 'mostafa', '123123'),
(56500, 'ffff', '123'),
(58578, '44', '33'),
(59873, 'dd3', '23'),
(65456, 'css', '11'),
(73095, 'mohamed', '123'),
(78264, 'sss', '3333'),
(82149, '33', '33'),
(88105, 'ss', 'ss'),
(88769, 'ahmedd', '666666'),
(89452, 'ahmed3', '666666'),
(91228, 'nigur', '4444'),
(95133, 'ssd', '3344'),
(96232, 'ahmed3', '3333'),
(1128900157, 'sss', '5554454554'),
(1791174998, 'vv', '12345'),
(2147483647, 'aaad', '123'),
(2274477836, 'fff', 'fff'),
(2572808278, 'fff', '123'),
(2706540801, 'ahmed', '123456'),
(2802614627, 'llnnn', 'jkjkjkjkjk'),
(3392934193, 'errr', 'fdsfsfsdfsdfds'),
(3400541286, 'fgfgfgf', 'gfdgdfgdfgd'),
(3673626993, 'ttttt', 'gggggg'),
(4294967295, 'eeee', '2223');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `trucks`
--
ALTER TABLE `trucks`
  ADD PRIMARY KEY (`truck_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trucks`
--
ALTER TABLE `trucks`
  MODIFY `truck_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4294967296;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
