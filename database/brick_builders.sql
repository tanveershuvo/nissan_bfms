-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2020 at 01:27 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brick_builders`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `com_id` int(10) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`com_id`, `company_name`, `image`) VALUES
(1, 'JOYA BRICKS', 'joya.png'),
(2, 'A.M.C BRICKS', 'amc.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `cus_id` varchar(50) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `cus_address` varchar(100) NOT NULL,
  `cus_phone` varchar(20) NOT NULL,
  `com_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`cus_id`, `cus_name`, `cus_address`, `cus_phone`, `com_id`) VALUES
('213197', 'Shanto', 'dhaka', '01683182337', 1),
('216190', 'Tanveer', 'north nilkhet', '01683182331', 1),
('33669', 'Tanveer', 'dhaka', '01683182337', 1),
('507308', 'Tanveer', 'ss', '01683182338', 1),
('600458', 'Rahman', 'dhaka', '01683182337', 2),
('754690', 'Koli', 'dhaka', '01683182338', 2),
('829696', 'talukdar', '25/f,Dhaka Unievrsity staff quarter, north nilkhet', '01683182338', 1),
('905753', 'shetu', 'dhaka', '01683182338', 2),
('927949', 'Khilu', 'ss', '01683189657', 1),
('936631', 'Test 1', 'Dhaka', '01683182337', 1),
('964394', 'nahian', 'dhaka', '01683182337', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `emp_id` varchar(50) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_phone` varchar(50) NOT NULL,
  `emp_des` varchar(50) NOT NULL,
  `emp_salary` int(20) NOT NULL,
  `com_id` int(20) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0 = active, 1= resigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`emp_id`, `emp_name`, `emp_email`, `emp_address`, `emp_phone`, `emp_des`, `emp_salary`, `com_id`, `status`) VALUES
('118249', 'Test', 'test@gmail.com', 'dhaka', '01683182337', 'Manager', 10000, 1, 0),
('264977', 'Niss', 'nis@gmail.com', 'dhaka', '01683182331', 'manager', 5000, 2, 0),
('652575', 'TANVEER', 'tanveershuvos@gmail.com', 'north nilkhet', '01683182331', 'manager', 12000, 2, 0),
('772195', 'Shanto', 'shanto@gmail.com', 'dhaka', '01683182331', 'Manager', 12500, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_payment`
--

CREATE TABLE `employee_payment` (
  `emp_pay_id` int(50) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `date` varchar(20) NOT NULL,
  `salary` int(20) NOT NULL,
  `bonus` int(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_payment`
--

INSERT INTO `employee_payment` (`emp_pay_id`, `emp_id`, `date`, `salary`, `bonus`, `payment_status`) VALUES
(119069, '118249', '25/08/20', 10000, 0, 'paid'),
(169368, '168350', '25/10/18', 12000, 0, 'unpaid'),
(265797, '264977', '25/08/20', 5000, 0, 'paid'),
(265995, '264977', '25/10/18', 5000, 0, 'paid'),
(266095, '264977', '02/11/18', 5000, 0, 'paid'),
(280242, '279224', '25/10/18', 12000, 0, 'paid'),
(365292, '364274', '25/10/18', 12500, 0, 'unpaid'),
(365392, '364274', '25/11/18', 12500, 0, 'paid'),
(653395, '652575', '25/08/20', 12000, 0, 'paid'),
(653593, '652575', '25/10/18', 12000, 0, 'paid'),
(653693, '652575', '02/11/18', 12000, 0, 'paid'),
(773213, '772195', '25/10/18', 12355, 0, 'paid'),
(773313, '772195', '02/11/18', 12500, 0, 'unpaid'),
(782386, '781268', '21/11/18', 12500, 0, 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `jalani_details`
--

CREATE TABLE `jalani_details` (
  `j_id` int(20) NOT NULL,
  `rate` int(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `quantity` int(20) NOT NULL,
  `rental` int(20) NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jalani_details`
--

INSERT INTO `jalani_details` (`j_id`, `rate`, `type`, `quantity`, `rental`, `receipt`, `date`) VALUES
(1, 12, 'Koyla', 100, 1200, '45df', ''),
(2, 12, 'Koyla', 100, 1200, '45df2', ''),
(3, 12, 'Koyla', 100, 1200, '45df12', ''),
(4, 12, 'Koyla', 100, 1200, '45df122', ''),
(5, 12, 'Koyla', 12, 1200, '45df2211', ''),
(6, 122, 'Koyla', 100, 1200, '45df111', ''),
(7, 23, 'Lakri', 100, 1200, '45dfwe', ''),
(8, 1123, 'Koyla', 100, 1200, '45df1231', ''),
(9, 1232, 'Lakri', 12, 1200, '4125df', ''),
(10, 123, 'Vushi', 100, 1200, '45dfwee', ''),
(11, 123, 'Vushi', 100, 1200, '45dfs', ''),
(12, 12321, 'Vushi', 100, 1200, '4s5df', ''),
(13, 1111, 'Koyla', 111, 1200, '11', '2018-09-17'),
(14, 10000, 'Vushi', 12, 1200, '123321', '2018-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `log_id` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL DEFAULT '25d55ad283aa400af464c76d713c07ad',
  `role` varchar(20) NOT NULL DEFAULT 'emp',
  `access_level` int(10) NOT NULL,
  `OTP` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`log_id`, `email`, `password`, `role`, `access_level`, `OTP`) VALUES
('1', 'tanveershuvos@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 1, ''),
('118249', 'test@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'emp', 2, ''),
('264977', 'nis@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'manager', 2, ''),
('772195', 'shanto@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'emp', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `mechinaries_details`
--

CREATE TABLE `mechinaries_details` (
  `m_id` int(20) NOT NULL,
  `rate` int(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `receipt` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `com_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mechinaries_details`
--

INSERT INTO `mechinaries_details` (`m_id`, `rate`, `type`, `quantity`, `name`, `receipt`, `date`, `com_id`) VALUES
(1, 12000, 'Mechine', '12', 'Polythin', '122d12', '2018-09-28', 1),
(2, 12000, 'Parts', '20 kg', 'Polythen', 'ddd232', '2018-09-27', 1),
(3, 10000, 'Mechine', '10', 'Polythen', '123321d', '2018-09-27', 1),
(4, 12000, 'Mechine', '20 kg', 'Ilastic', '122d12	', '2018-10-02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(100) NOT NULL,
  `cus_id` varchar(50) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `quantity` int(20) NOT NULL,
  `total_price` int(100) NOT NULL,
  `paid` int(100) NOT NULL,
  `order_date` varchar(20) NOT NULL,
  `sea_id` int(50) NOT NULL,
  `inserted_by` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `cus_id`, `pro_name`, `pro_id`, `unit_price`, `quantity`, `total_price`, `paid`, `order_date`, `sea_id`, `inserted_by`) VALUES
(2, '936631', '', 12, 5.00, 300, 1500, 1200, '25/08/2020', 1, 'tanveershuvos@gmail.com'),
(3, '936631', '', 5, 11.65, 1500, 17475, 16000, '25/08/2020', 1, 'tanveershuvos@gmail.com'),
(4, '213197', '', 12, 5.00, 240, 1200, 1000, '25/08/2020', 1, 'tanveershuvos@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `others_details`
--

CREATE TABLE `others_details` (
  `rate` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `receipt` int(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `o_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `others_details`
--

INSERT INTO `others_details` (`rate`, `quantity`, `name`, `receipt`, `date`, `o_id`) VALUES
(12, 12, 'saa', 1111, '2018-09-17', 1),
(12000, 10, 'Polythen', 122, '2018-11-18', 2),
(222, 22, 'ss', 2, '2018-09-30', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `pro_id` int(20) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `available` int(20) NOT NULL,
  `com_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`pro_id`, `pro_name`, `unit_price`, `available`, `com_id`) VALUES
(5, 'Quality 1', 11.65, 562, 1),
(10, 'Quality 1', 7.50, 100, 2),
(11, 'Quality 2', 5.00, 1, 2),
(12, 'Quality 2', 5.00, 8, 1),
(13, 'Quality test', 2.37, 2000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `season`
--

CREATE TABLE `season` (
  `sea_id` int(50) NOT NULL,
  `com_id` int(10) NOT NULL,
  `sea_name` varchar(50) NOT NULL,
  `sea_start_time` varchar(50) NOT NULL,
  `sea_end_time` varchar(20) NOT NULL,
  `sea_budget` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `season`
--

INSERT INTO `season` (`sea_id`, `com_id`, `sea_name`, `sea_start_time`, `sea_end_time`, `sea_budget`) VALUES
(1, 1, 'Summer', '08/26/2020', '09/30/2020', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `sordar_delivery_status`
--

CREATE TABLE `sordar_delivery_status` (
  `receipt_no` varchar(50) NOT NULL,
  `delivery_date` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `rate` int(50) NOT NULL,
  `total_bill` int(50) NOT NULL,
  `inserted_by` varchar(50) NOT NULL,
  `sea_id` int(50) NOT NULL,
  `sor_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sordar_delivery_status`
--

INSERT INTO `sordar_delivery_status` (`receipt_no`, `delivery_date`, `amount`, `rate`, `total_bill`, `inserted_by`, `sea_id`, `sor_id`) VALUES
('WB074664', '2020-08-25', 5000, 3, 15000, 'tanveershuvos@gmail.com', 1, '969620');

-- --------------------------------------------------------

--
-- Table structure for table `sordar_details`
--

CREATE TABLE `sordar_details` (
  `sor_id` varchar(50) NOT NULL,
  `sor_name` varchar(50) NOT NULL,
  `sor_address` varchar(100) NOT NULL,
  `sor_type` varchar(50) NOT NULL,
  `sor_phone` varchar(20) NOT NULL,
  `com_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sordar_details`
--

INSERT INTO `sordar_details` (`sor_id`, `sor_name`, `sor_address`, `sor_type`, `sor_phone`, `com_id`) VALUES
('287501', 'Test 2', 'Dhaka', 'Unload Sordar', '01683182337', 1),
('969620', 'Test 1', 'Dhaka', 'Load Sordar', '01683182337', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sordar_payment`
--

CREATE TABLE `sordar_payment` (
  `sor_id` varchar(50) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `advance` int(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `sea_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sordar_payment`
--

INSERT INTO `sordar_payment` (`sor_id`, `pay_id`, `advance`, `date`, `sea_id`) VALUES
('969620', '11479812', 5000, '2020-08-25', 1),
('287501', '83169525', 10000, '2020-08-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sordar_weekly_bill`
--

CREATE TABLE `sordar_weekly_bill` (
  `weekly_bill_id` int(20) NOT NULL,
  `sor_id` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `weekly_bill` int(50) NOT NULL,
  `paid_by` varchar(50) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sea_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sordar_weekly_bill`
--

INSERT INTO `sordar_weekly_bill` (`weekly_bill_id`, `sor_id`, `date`, `weekly_bill`, `paid_by`, `pay_id`, `sea_id`) VALUES
(1, '969620', '2020-08-25', 2000, 'tanveershuvos@gmail.com', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employee_payment`
--
ALTER TABLE `employee_payment`
  ADD PRIMARY KEY (`emp_pay_id`);

--
-- Indexes for table `jalani_details`
--
ALTER TABLE `jalani_details`
  ADD PRIMARY KEY (`j_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `mechinaries_details`
--
ALTER TABLE `mechinaries_details`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `others_details`
--
ALTER TABLE `others_details`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`sea_id`);

--
-- Indexes for table `sordar_delivery_status`
--
ALTER TABLE `sordar_delivery_status`
  ADD PRIMARY KEY (`receipt_no`);

--
-- Indexes for table `sordar_details`
--
ALTER TABLE `sordar_details`
  ADD PRIMARY KEY (`sor_id`);

--
-- Indexes for table `sordar_payment`
--
ALTER TABLE `sordar_payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `sordar_weekly_bill`
--
ALTER TABLE `sordar_weekly_bill`
  ADD PRIMARY KEY (`weekly_bill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `com_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_payment`
--
ALTER TABLE `employee_payment`
  MODIFY `emp_pay_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=782387;

--
-- AUTO_INCREMENT for table `jalani_details`
--
ALTER TABLE `jalani_details`
  MODIFY `j_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mechinaries_details`
--
ALTER TABLE `mechinaries_details`
  MODIFY `m_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `others_details`
--
ALTER TABLE `others_details`
  MODIFY `o_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `pro_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `season`
--
ALTER TABLE `season`
  MODIFY `sea_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sordar_weekly_bill`
--
ALTER TABLE `sordar_weekly_bill`
  MODIFY `weekly_bill_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
