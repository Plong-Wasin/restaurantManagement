-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 01:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `check_in`
--

CREATE TABLE `check_in` (
  `check_in_id` int(11) NOT NULL,
  `table_id` int(3) NOT NULL,
  `code` varchar(5) NOT NULL COMMENT 'รหัสที่ให้ลูกค้า',
  `paid_timestamp` timestamp NULL DEFAULT NULL,
  `check_in_timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `check_in`
--

INSERT INTO `check_in` (`check_in_id`, `table_id`, `code`, `paid_timestamp`, `check_in_timestamp`) VALUES
(5, 1, '4321', '2020-10-04 14:35:47', '2020-09-14 17:15:31'),
(6, 2, '4259', NULL, '2020-09-15 14:48:35'),
(7, 5, '4177', NULL, '2020-09-15 16:58:21'),
(8, 5, '1613', NULL, '2020-09-15 16:58:47'),
(9, 8, '7014', NULL, '2020-09-15 17:07:53'),
(10, 8, '5858', NULL, '2020-09-15 17:08:08'),
(11, 6, '7237', NULL, '2020-09-15 17:08:24'),
(12, 9, '3072', NULL, '2020-09-15 17:14:42'),
(13, 11, '8226', NULL, '2020-09-15 17:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(5) NOT NULL,
  `food_type_id` int(5) NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_price` int(5) NOT NULL,
  `food_have` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=ไม่มี\r\n1=มี',
  `food_image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_type_id`, `food_name`, `food_price`, `food_have`, `food_image`) VALUES
(1, 1, 'ลูกชิ้นหมู', 203, 1, 'img_5f65f581ca957.jpg'),
(9, 5, 'ลูกชิ้นปลา', 50, 1, NULL),
(10, 4, 'เนื้อสไลด์', 65, 1, 'img_5f664b7e7111d.jpg'),
(12, 1, 'หมูสับ', 50, 1, 'img_5f64dd7127824.jpg'),
(18, 1, 'หมูเป็นๆ', 2000, 1, 'img_5f64dd2c808cf.jpg'),
(19, 1, 'หมูเป็นๆ', 2000, 1, 'img_5f64dd4b8e2f4.jpg'),
(20, 1, 'หมูน้อย', 1000, 1, 'img_5f64dd570c538.jpg'),
(26, 1, 'หมูสับ', 10, 1, 'img_5f65f2dcac9cb.jpg'),
(33, 2, '1112', 111, 1, NULL),
(34, 11, 'คอม', 199, 1, 'img_5f7971e6b1acf.png');

-- --------------------------------------------------------

--
-- Table structure for table `food_type`
--

CREATE TABLE `food_type` (
  `food_type_id` int(5) NOT NULL,
  `food_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_type`
--

INSERT INTO `food_type` (`food_type_id`, `food_type_name`) VALUES
(52, '12'),
(12, '123'),
(15, '2'),
(13, '321'),
(30, '5'),
(11, 'Google'),
(8, 'ของหวาน'),
(9, 'ติ่มซำ'),
(5, 'ปลา'),
(6, 'ผัก'),
(10, 'พิเศษ'),
(1, 'หมู'),
(7, 'เครื่องดื่ม'),
(4, 'เนื้อ'),
(2, 'ไก่');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_list_id` int(11) NOT NULL,
  `order_time_id` int(11) NOT NULL,
  `food_id` int(5) DEFAULT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_cook` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=ยังไม่ทำ\r\n1=ทำอยู่\r\n2=รอการจัดส่ง\r\n3=เสร็จสิ้น\r\n4=ยกเลิก',
  `food_price` int(5) NOT NULL,
  `food_amount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_list_id`, `order_time_id`, `food_id`, `food_name`, `food_cook`, `food_price`, `food_amount`) VALUES
(10, 5, NULL, 'หมูสับ', 3, 50, 2),
(11, 8, NULL, 'ลูกชิ้นหมู', 3, 201, 2),
(12, 9, NULL, 'ลูกชิ้นไก่', 3, 50, 50),
(13, 31, NULL, 'เนื้อสไลด์', 3, 65, 4),
(14, 32, NULL, 'ลูกชิ้นหมู', 3, 201, 1),
(16, 34, NULL, 'ลูกชิ้นหมู', 3, 201, 5),
(17, 35, NULL, 'ลูกชิ้นหมู', 3, 201, 8),
(18, 36, NULL, 'ลูกชิ้นหมู', 3, 203, 1),
(19, 36, NULL, 'หมูสับ', 3, 50, 2),
(20, 36, NULL, 'หมูเป็นๆ', 3, 2000, 4),
(21, 37, NULL, 'หมูเป็นๆ', 3, 2000, 2),
(22, 37, NULL, 'หมูน้อย', 3, 1000, 2),
(23, 38, 1, 'ลูกชิ้นหมู', 4, 203, 3),
(24, 38, 20, 'หมูน้อย', 0, 1000, 4),
(25, 38, 1, 'ลูกชิ้นหมู', 4, 203, 3),
(26, 38, 20, 'หมูน้อย', 0, 1000, 3),
(27, 38, 12, 'หมูสับ', 0, 50, 3),
(28, 39, 20, 'หมูน้อย', 0, 1000, 3),
(29, 39, 12, 'หมูสับ', 0, 50, 3),
(30, 40, 1, 'ลูกชิ้นหมู', 4, 203, 3),
(31, 40, 1, 'ลูกชิ้นหมู', 4, 203, 5),
(32, 40, 12, 'หมูสับ', 0, 50, 5),
(33, 40, 26, 'หมูสับ', 0, 10, 4),
(34, 40, 18, 'หมูเป็นๆ', 0, 2000, 3),
(35, 40, 19, 'หมูเป็นๆ', 0, 2000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_time`
--

CREATE TABLE `order_time` (
  `order_time_id` int(11) NOT NULL,
  `check_in_id` int(11) NOT NULL,
  `order_time_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_time`
--

INSERT INTO `order_time` (`order_time_id`, `check_in_id`, `order_time_timestamp`) VALUES
(1, 5, '2020-09-15 07:00:59'),
(2, 5, '2020-09-15 07:03:33'),
(3, 5, '2020-09-15 07:07:13'),
(4, 5, '2020-09-15 07:07:26'),
(5, 5, '2020-09-15 07:08:23'),
(8, 6, '2020-09-15 14:48:42'),
(9, 5, '2020-09-15 16:27:39'),
(10, 5, '2020-09-15 16:27:40'),
(11, 5, '2020-09-15 16:27:41'),
(12, 5, '2020-09-15 16:27:42'),
(13, 5, '2020-09-15 16:27:43'),
(14, 5, '2020-09-15 16:27:44'),
(15, 5, '2020-09-15 16:27:45'),
(16, 5, '2020-09-15 16:27:46'),
(17, 5, '2020-09-15 16:27:47'),
(18, 5, '2020-09-15 16:27:48'),
(19, 5, '2020-09-15 16:27:49'),
(20, 5, '2020-09-15 16:27:50'),
(21, 5, '2020-09-15 16:27:51'),
(22, 5, '2020-09-15 16:27:52'),
(23, 5, '2020-09-15 16:27:53'),
(24, 5, '2020-09-15 16:27:54'),
(25, 5, '2020-09-15 16:27:55'),
(26, 5, '2020-09-15 16:27:56'),
(27, 5, '2020-09-15 16:27:57'),
(28, 5, '2020-09-15 16:27:58'),
(29, 5, '2020-09-15 16:27:59'),
(30, 5, '2020-09-15 16:28:00'),
(31, 5, '2020-09-15 16:29:06'),
(32, 8, '2020-09-16 09:46:09'),
(33, 8, '2020-09-16 09:46:32'),
(34, 8, '2020-09-16 10:56:47'),
(35, 10, '2020-09-16 10:58:21'),
(36, 8, '2020-09-20 03:54:59'),
(37, 12, '2020-09-20 06:46:37'),
(38, 13, '2020-10-04 05:42:36'),
(39, 12, '2020-10-04 05:42:43'),
(40, 11, '2020-10-04 05:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `queue_id` int(5) NOT NULL,
  `queue_name` varchar(50) NOT NULL,
  `queue_people` int(3) NOT NULL,
  `queue_book_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `queue_in_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`queue_id`, `queue_name`, `queue_people`, `queue_book_timestamp`, `queue_in_timestamp`) VALUES
(6, 'wasin', 2, '2020-08-23 03:10:38', '2020-08-23 03:10:47'),
(7, 'Plong', 1, '2020-08-23 03:22:21', '2020-08-23 04:38:17'),
(8, 'P', 5, '2020-08-24 12:22:32', '2020-08-24 15:08:35'),
(9, 'Not', 5, '2020-08-24 15:06:56', '2020-09-15 16:13:38'),
(10, 'sd', 4, '2020-08-24 15:07:13', '2020-10-04 05:49:41'),
(11, 'น็อต', 4, '2020-10-04 05:52:22', '2020-10-04 05:52:30'),
(12, 'น็อต', 3, '2020-10-04 05:56:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `table_id` int(3) NOT NULL,
  `table_people` int(3) NOT NULL,
  `table_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=ว่าง\r\n1=ไม่ว่าง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`table_id`, `table_people`, `table_status`) VALUES
(1, 4, 0),
(2, 4, 1),
(3, 4, 1),
(4, 6, 1),
(5, 6, 1),
(6, 6, 1),
(7, 6, 0),
(8, 6, 1),
(9, 6, 1),
(10, 6, 0),
(11, 6, 1),
(12, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `temp_order`
--

CREATE TABLE `temp_order` (
  `temp_order_id` int(11) NOT NULL,
  `table_id` int(3) NOT NULL,
  `food_id` int(5) NOT NULL,
  `food_amount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_order`
--

INSERT INTO `temp_order` (`temp_order_id`, `table_id`, `food_id`, `food_amount`) VALUES
(48, 8, 20, 3),
(49, 8, 20, 3),
(50, 8, 12, 3),
(52, 8, 26, 4),
(53, 8, 18, 4),
(54, 8, 19, 4),
(56, 9, 12, 4),
(57, 6, 20, 3),
(58, 11, 20, 3),
(59, 11, 12, 3),
(61, 11, 18, 3),
(62, 11, 12, 3),
(63, 11, 19, 3),
(65, 11, 19, 4),
(66, 11, 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password`) VALUES
(586, '7', 'admin', '7'),
(588, '2', 'KitchenStaff', '2'),
(589, '1', 'CashierStaff', '1'),
(590, 'Plong', 'ServiceStaff', '1'),
(592, '1150', 'WelcomeStaff', '1150');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`check_in_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `food_type_id` (`food_type_id`);

--
-- Indexes for table `food_type`
--
ALTER TABLE `food_type`
  ADD PRIMARY KEY (`food_type_id`),
  ADD UNIQUE KEY `food_type_name` (`food_type_name`) USING BTREE;

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_list_id`),
  ADD KEY `order_time_id` (`order_time_id`);

--
-- Indexes for table `order_time`
--
ALTER TABLE `order_time`
  ADD PRIMARY KEY (`order_time_id`),
  ADD KEY `check_in_id` (`check_in_id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`queue_id`);

--
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `temp_order`
--
ALTER TABLE `temp_order`
  ADD PRIMARY KEY (`temp_order_id`),
  ADD KEY `table_id` (`table_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `check_in`
--
ALTER TABLE `check_in`
  MODIFY `check_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
  MODIFY `food_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `order_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_time`
--
ALTER TABLE `order_time`
  MODIFY `order_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `queue_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `temp_order`
--
ALTER TABLE `temp_order`
  MODIFY `temp_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=593;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`food_type_id`) REFERENCES `food_type` (`food_type_id`);

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`order_time_id`) REFERENCES `order_time` (`order_time_id`);

--
-- Constraints for table `order_time`
--
ALTER TABLE `order_time`
  ADD CONSTRAINT `order_time_ibfk_1` FOREIGN KEY (`check_in_id`) REFERENCES `check_in` (`check_in_id`);

--
-- Constraints for table `temp_order`
--
ALTER TABLE `temp_order`
  ADD CONSTRAINT `temp_order_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `table` (`table_id`),
  ADD CONSTRAINT `temp_order_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
