-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 05:25 AM
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
  `check_in_timestamp` timestamp NULL DEFAULT current_timestamp(),
  `paid_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=ยังไม่จ่าย\r\n1=จ่ายแล้ว\r\n2=ชักดาบ',
  `cash` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `check_in`
--

INSERT INTO `check_in` (`check_in_id`, `table_id`, `code`, `paid_timestamp`, `check_in_timestamp`, `paid_status`, `cash`) VALUES
(20, 7, '0393', '2020-10-27 18:22:54', '2020-10-27 16:32:43', 2, NULL),
(21, 3, '4993', '2020-10-29 05:20:21', '2020-10-27 16:32:50', 1, 1000),
(22, 1, '9460', '2020-10-27 17:43:02', '2020-10-27 16:33:00', 1, 10000),
(23, 1, '9987', '2020-10-27 18:27:01', '2020-09-02 18:28:54', 1, 700),
(24, 5, '0487', '2020-10-27 19:32:15', '2020-10-27 18:58:21', 2, NULL),
(25, 3, '3951', '2020-10-29 06:24:57', '2020-10-27 19:34:31', 1, 300),
(26, 2, '1981', '2020-10-29 05:45:49', '2020-10-29 05:26:21', 2, NULL),
(27, 3, '9357', '2020-10-29 05:51:49', '2020-10-29 05:49:09', 1, 800),
(28, 4, '5817', '2020-10-29 05:54:07', '2020-10-29 05:52:31', 1, 400),
(29, 3, '1805', '2020-10-29 16:48:16', '2020-10-29 06:03:33', 1, 2300),
(30, 1, '9035', NULL, '2020-10-29 16:54:00', 0, NULL),
(31, 2, '8445', '2020-10-30 05:40:21', '2020-10-30 05:22:54', 1, 500),
(32, 5, '1867', NULL, '2020-10-30 05:23:21', 0, NULL);

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
  `food_image` varchar(50) DEFAULT NULL,
  `food_recommend` tinyint(4) NOT NULL COMMENT '1=แนะนำ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_type_id`, `food_name`, `food_price`, `food_have`, `food_image`, `food_recommend`) VALUES
(36, 54, 'ข้าวมันไก่ต้ม', 35, 0, 'img_5f98500b9346a.jpg', 0),
(37, 54, 'ข้าวมันไก่ทอด', 35, 1, 'img_5f98503c74762.jpg', 0),
(38, 57, 'ข้าวขาหมู', 40, 1, 'img_5f98508d3b0c9.jpg', 0),
(39, 54, 'ข้าวผัด', 30, 0, 'img_5f9851512fa07.jpg', 0),
(40, 54, 'ข้าวผัด (พิเศษ)', 40, 0, 'img_5f98517e094d3.jpg', 0),
(43, 56, 'Pepsi (กระป๋อง)', 29, 1, 'img_5f98597287abe.gif', 0),
(44, 56, 'น้ำเปล่า', 10, 1, 'img_5f9859b9a9a89.jpg', 0),
(45, 56, 'น้ำส้ม', 39, 1, 'img_5f9859cb15a4e.jpg', 0),
(49, 54, 'ข้าวผัดทะเล', 80, 0, 'img_5f9920715d919.gif', 0),
(50, 57, 'หมูกระเทียม', 30, 1, 'img_5f9ba1fca2e89.jpg', 0);

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
(57, 'อาหารจานด่วน'),
(54, 'อาหารจานเดียว'),
(56, 'เครื่องดื่ม');

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
(41, 43, 38, 'ข้าวขาหมู', 3, 35, 2),
(42, 43, 48, 'Chu Toro', 3, 159, 2),
(43, 43, 43, 'Pepsi (กระป๋อง)', 3, 29, 3),
(46, 43, 40, 'ข้าวผัด (พิเศษ)', 3, 40, 1),
(47, 43, 37, 'ข้าวมันไก่ทอด', 3, 35, 2),
(51, 45, 46, 'Maguro No Akami', 3, 119, 6),
(52, 46, 46, 'Maguro No Akami', 3, 119, 4),
(53, 46, 38, 'ข้าวขาหมู', 3, 35, 4),
(54, 47, 38, 'ข้าวขาหมู', 3, 35, 4),
(55, 47, 39, 'ข้าวผัด', 3, 30, 2),
(56, 48, 38, 'ข้าวขาหมู', 3, 35, 2),
(59, 50, 46, 'Maguro No Akami', 3, 119, 1),
(60, 50, 43, 'Pepsi (กระป๋อง)', 3, 29, 1),
(61, 50, 38, 'ข้าวขาหมู', 3, 35, 1),
(62, 50, 49, 'ข้าวผัดทะเล', 3, 80, 1),
(63, 51, 46, 'Maguro No Akami', 3, 119, 1),
(64, 51, 43, 'Pepsi (กระป๋อง)', 3, 29, 3),
(65, 51, 38, 'ข้าวขาหมู', 3, 35, 3),
(66, 52, 46, 'Maguro No Akami', 3, 119, 6),
(67, 52, 43, 'Pepsi (กระป๋อง)', 3, 29, 3),
(68, 52, 38, 'ข้าวขาหมู', 3, 35, 1),
(69, 52, 49, 'ข้าวผัดทะเล', 3, 80, 2),
(70, 52, 38, 'ข้าวขาหมู', 3, 35, 1),
(71, 52, 39, 'ข้าวผัด', 3, 30, 2),
(72, 52, 40, 'ข้าวผัด (พิเศษ)', 3, 40, 2),
(73, 52, 49, 'ข้าวผัดทะเล', 3, 80, 2),
(74, 52, 36, 'ข้าวมันไก่ต้ม', 3, 35, 2),
(75, 52, 37, 'ข้าวมันไก่ทอด', 3, 35, 2),
(76, 52, 48, 'Chu Toro', 3, 159, 1),
(77, 52, 41, 'Engawa', 3, 89, 1),
(78, 52, 47, 'Ikura', 3, 89, 2),
(79, 52, 46, 'Maguro No Akami', 3, 119, 2),
(80, 52, 43, 'Pepsi (กระป๋อง)', 3, 29, 2),
(81, 52, 44, 'น้ำเปล่า', 3, 10, 2),
(82, 110, 46, 'Maguro No Akami', 4, 119, 2),
(83, 110, 46, 'Maguro No Akami', 4, 119, 2),
(84, 111, 43, 'Pepsi (กระป๋อง)', 3, 29, 2),
(85, 111, 36, 'ข้าวมันไก่ต้ม', 3, 35, 2),
(86, 112, 36, 'ข้าวมันไก่ต้ม', 3, 35, 3),
(88, 112, 40, 'ข้าวผัด (พิเศษ)', 3, 40, 2),
(89, 113, 43, 'Pepsi (กระป๋อง)', 3, 29, 4),
(92, 115, 44, 'น้ำเปล่า', 3, 10, 1),
(93, 115, 37, 'ข้าวมันไก่ทอด', 3, 35, 2),
(94, 115, 43, 'Pepsi (กระป๋อง)', 3, 29, 2),
(95, 115, 45, 'น้ำส้ม', 3, 39, 2),
(96, 115, 44, 'น้ำเปล่า', 3, 10, 2);

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
(43, 22, '2020-10-27 17:37:08'),
(44, 22, '2020-10-27 17:40:03'),
(45, 21, '2020-10-27 18:13:16'),
(46, 23, '2020-10-27 18:24:05'),
(47, 25, '2020-10-29 05:22:09'),
(48, 25, '2020-10-29 05:23:08'),
(49, 26, '2020-10-29 05:27:49'),
(50, 27, '2020-10-29 05:51:13'),
(51, 28, '2020-10-29 05:52:42'),
(52, 29, '2020-10-29 16:47:20'),
(53, 29, '2020-10-29 16:51:12'),
(54, 29, '2020-10-29 16:51:13'),
(55, 29, '2020-10-29 16:51:14'),
(56, 29, '2020-10-29 16:51:14'),
(57, 29, '2020-10-29 16:51:14'),
(58, 30, '2020-10-29 16:54:14'),
(59, 30, '2020-10-29 16:54:15'),
(60, 30, '2020-10-29 16:54:15'),
(61, 30, '2020-10-29 16:54:16'),
(62, 30, '2020-10-29 16:55:20'),
(63, 30, '2020-10-29 16:55:21'),
(64, 30, '2020-10-29 16:55:21'),
(65, 30, '2020-10-29 16:55:25'),
(66, 30, '2020-10-29 16:55:26'),
(67, 30, '2020-10-29 16:55:26'),
(68, 30, '2020-10-29 16:55:52'),
(69, 30, '2020-10-29 16:55:52'),
(70, 30, '2020-10-29 16:55:53'),
(71, 30, '2020-10-29 16:55:53'),
(72, 30, '2020-10-29 16:55:54'),
(73, 30, '2020-10-29 16:55:54'),
(74, 30, '2020-10-29 16:55:55'),
(75, 30, '2020-10-29 16:55:56'),
(76, 30, '2020-10-29 16:56:03'),
(77, 30, '2020-10-29 16:56:03'),
(78, 30, '2020-10-29 16:56:04'),
(79, 30, '2020-10-29 16:56:05'),
(80, 30, '2020-10-29 16:56:05'),
(81, 30, '2020-10-29 16:56:06'),
(82, 30, '2020-10-29 16:56:06'),
(83, 30, '2020-10-29 16:56:07'),
(84, 30, '2020-10-29 16:56:07'),
(85, 30, '2020-10-29 16:56:14'),
(86, 30, '2020-10-29 16:56:14'),
(87, 30, '2020-10-29 16:56:14'),
(88, 30, '2020-10-29 16:56:16'),
(89, 30, '2020-10-29 16:56:16'),
(90, 30, '2020-10-29 16:56:17'),
(91, 30, '2020-10-29 16:56:19'),
(92, 30, '2020-10-29 16:56:20'),
(93, 30, '2020-10-29 16:56:21'),
(94, 30, '2020-10-29 16:57:57'),
(95, 30, '2020-10-29 16:58:33'),
(96, 30, '2020-10-29 16:58:37'),
(97, 30, '2020-10-29 16:58:39'),
(98, 30, '2020-10-29 16:58:42'),
(99, 30, '2020-10-29 16:58:45'),
(100, 30, '2020-10-29 16:58:48'),
(101, 30, '2020-10-29 16:58:48'),
(102, 30, '2020-10-29 16:58:50'),
(103, 30, '2020-10-29 17:00:06'),
(104, 30, '2020-10-29 17:00:08'),
(105, 30, '2020-10-29 17:00:10'),
(106, 30, '2020-10-29 17:00:11'),
(107, 30, '2020-10-29 17:00:13'),
(108, 30, '2020-10-29 17:00:17'),
(109, 30, '2020-10-29 17:00:20'),
(110, 30, '2020-10-29 17:16:00'),
(111, 31, '2020-10-30 05:26:05'),
(112, 31, '2020-10-30 05:27:04'),
(113, 32, '2020-10-30 05:31:13'),
(114, 31, '2020-10-30 05:37:30'),
(115, 30, '2020-11-15 05:23:06');

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
(15, 'ปลา', 6, '2020-10-29 16:49:56', '2020-10-30 05:23:25'),
(16, 'หมู', 3, '2020-10-29 16:50:05', NULL),
(17, 'สมพง', 1, '2020-10-29 16:50:10', NULL),
(18, 'ปลาหยุด', 2, '2020-10-29 16:50:19', NULL),
(19, 'ปลารีนา', 1, '2020-10-29 16:50:27', NULL),
(20, 'ปลาทูน่า', 4, '2020-10-29 16:50:41', NULL),
(21, 'น็อต', 1, '2020-10-29 16:50:49', NULL),
(22, 'ปล้อง', 2, '2020-10-29 16:50:53', NULL),
(23, 'หมู', 4, '2020-10-30 05:21:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`name`, `value`) VALUES
('background', 'logo.png'),
('recommend', '1'),
('restaurant_name', 'Next Door');

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
(1, 4, 1),
(2, 2, 0),
(3, 2, 0),
(4, 2, 0),
(5, 6, 1),
(6, 2, 0),
(7, 2, 0),
(8, 2, 0),
(9, 4, 0),
(10, 4, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `contact_number` varchar(10) DEFAULT NULL,
  `title` varchar(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=ทำอยู่\r\n0=ออกแล้ว',
  `date_leavework` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password`, `Email`, `first_name`, `last_name`, `birthdate`, `contact_number`, `title`, `status`, `date_leavework`) VALUES
(600, 'adminA', 'admin', 'admin', 'komson.Ss@gmail.com', 'คมสัน', 'ซ่อนกลิ่น', '1991-04-11', '0830743330', 'Miss', 0, '2020-11-05'),
(605, 'komsonAA', 'admin', 'komson', 'komson.sornklin@gmail.com', 'คมสัน', 'ซ่อนกลิ่น', '1997-03-21', '0644895915', 'Mr', 0, '2020-11-05'),
(608, 'aaaaaa', 'ServiceStaff', 'aaaaaa', 'komson.sornklinA@gmail.com', 'คมสัน', 'ซ่อนกลิ่น', '1998-10-02', '0639100704', 'Miss', 0, '2020-11-05'),
(609, 'sudteenzzd', 'CashierStaff', '0295466455', 'not@hotmail.com', 'คมสัน', 'ซ่อนกลิ่น', NULL, '0888888888', 'Miss', 0, '2020-11-05'),
(610, 'komsonS', 'KitchenStaff', '0295466455', 'sudteenzzd@gmail.com', 'คมสัน', 'ซ่อนกลิ่น', '1987-09-30', '0889591507', 'Mrs', 1, NULL),
(611, 'komsonz', 'KitchenStaff', '0295466455', 'komson.s@gmail.com', 'คมสัน', 'ซ่อนกลิ่น', '1999-09-02', '0634562784', 'Mrs', 1, NULL),
(614, 'nottoo', 'admin', 'nottoo', 'komson@gmail.com', 'คมสัน', 'ซ่อนกลิ่น', '1995-11-03', '0639100704', 'Mr', 0, '2020-11-08'),
(615, 'tsunamini', 'WelcomeStaff', 'tsunamini', 'mana@gmail.com', 'มานา', 'มาแน่', '1982-09-03', '0639100704', 'Mrs', 1, NULL),
(616, 'Kindeew', 'KitchenStaff', 'admink', 'mana@hotmail.com', 'จินดา', 'มานา', '1977-03-30', '0887894567', 'Mrs', 1, NULL),
(617, 'Somluk', 'WelcomeStaff', 'adminw', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(619, 'Adesia', 'ServiceStaff', 'admins', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(622, 'adminA', 'admin', '0295466455', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-11-03'),
(623, 'Wasine', 'CashierStaff', 'adminc', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

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
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`name`);

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
  MODIFY `check_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
  MODIFY `food_type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `order_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `order_time`
--
ALTER TABLE `order_time`
  MODIFY `order_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `queue_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `temp_order`
--
ALTER TABLE `temp_order`
  MODIFY `temp_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=624;

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
