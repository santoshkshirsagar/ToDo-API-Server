-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2020 at 09:07 AM
-- Server version: 10.2.13-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todoitem`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_title` varchar(80) NOT NULL,
  `item_status` enum('Pending','Done') NOT NULL DEFAULT 'Pending',
  `item_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `item_added_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `item_updated_time` timestamp NULL DEFAULT NULL,
  `item_added_by` int(8) NOT NULL,
  `item_updated_by` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_title`, `item_status`, `item_deleted`, `item_added_time`, `item_updated_time`, `item_added_by`, `item_updated_by`) VALUES
(1, 'first item update', 'Pending', 1, '2020-04-18 08:38:25', NULL, 0, 0),
(2, 'second update item', 'Done', 0, '2020-04-18 08:43:42', NULL, 0, 0),
(3, 'new 3 item', 'Done', 1, '2020-04-18 08:44:02', NULL, 0, 0),
(4, 'fourth item', 'Pending', 0, '2020-04-18 08:44:15', NULL, 0, 0),
(5, 'new  item', 'Pending', 0, '2020-04-18 09:01:24', NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
