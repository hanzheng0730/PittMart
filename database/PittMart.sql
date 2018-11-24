-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2018 at 04:56 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PittMart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `c_id` int(10) NOT NULL,
  `qty` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `home_or_business` varchar(8) NOT NULL,
  `business_category` varchar(20) DEFAULT NULL,
  `annual_income` varchar(20) DEFAULT NULL,
  `married` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `birth_year` smallint(6) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `password`, `phone_number`, `email`, `street`, `city`, `state`, `zip`, `home_or_business`, `business_category`, `annual_income`, `married`, `gender`, `birth_year`) VALUES
(1, 'Ping', 'Li', 'e10adc3949ba59abbe56e057f20f883e', '4125679848', 'pingli76@gmail.com', '32 Forbes Ave', 'Pittsburgh', 'PA', '15220', 'home', NULL, '35000', 'yes', 'female', 1976),
(2, 'Rui', 'Hu', 'e10adc3949ba59abbe56e057f20f883e', '4125678900', 'ruihu28@yahoo.com', '24 main st', 'Philadelphia', 'PA', '19050', 'home', NULL, '87000', 'no', 'male', 1988),
(3, 'Ju', 'Wang', 'e10adc3949ba59abbe56e057f20f883e', '2017889499', 'juwang@hotmail.com', '22 5th ave', 'new york', 'NY', '10010', 'business', 'IT', NULL, NULL, NULL, NULL),
(4, 'Haiping', 'Jiang', 'e10adc3949ba59abbe56e057f20f883e', '3028890710', 'hpjianga@icloud.com', '302 murray ave', 'Pittsburgh', 'PA', '15217', 'home', NULL, '50000', 'yes', 'male', 1980),
(5, 'Dan', 'Huang', 'e10adc3949ba59abbe56e057f20f883e', '2018984544', 'dhuang@gmail.com', '23 Lincoln Ave', 'New York', 'NY', '10001', 'home', 'Finance', NULL, NULL, NULL, NULL),
(6, 'Mei', 'Lin', 'e10adc3949ba59abbe56e057f20f883e', '2013992929', 'meilin@yahoo.com', '377 24th st', 'Long Island', 'NY', '11101', 'business', NULL, NULL, NULL, NULL, NULL),
(7, 'Xiang', 'Lin', 'e10adc3949ba59abbe56e057f20f883e', '5067888009', 'xianglin@gmail.com', '34 rainbow ave', 'Coal City', 'IL', '60416', 'home', NULL, '120000', 'yes', 'female', 1982),
(8, 'Yaya', 'Gao', 'e10adc3949ba59abbe56e057f20f883e', '5060988767', 'yayagao@gmail.com', '15 Dunky st', 'Chicago Ridge', 'IL', '60415', 'business', 'Manufacturing', NULL, NULL, NULL, NULL),
(9, 'Siming', 'Li', 'e10adc3949ba59abbe56e057f20f883e', '5067889000', 'sili@yahoo.com', '566 mayfair st', 'Coal City', 'IL', '60416', 'home', NULL, '89000', 'no', 'female', 1987),
(10, 'Qian', 'Liu', 'e10adc3949ba59abbe56e057f20f883e', '5061234432', 'qianliu@icloud.com', '233 mayer ave', 'Diamond', 'IL', '60416', 'business', 'IT', NULL, NULL, NULL, NULL),
(11, 'Qiao', 'Wang', 'e10adc3949ba59abbe56e057f20f883e', '7245678898', 'qiaowang@yahoo.com', '12 cranberry st', 'Pittsburgh', 'PA', '15086', 'business', 'Finance', NULL, NULL, NULL, NULL),
(12, 'Li', 'Li', 'e10adc3949ba59abbe56e057f20f883e', '9178997676', 'lili@yahoo.com', '23 Blooming st', 'Los Angeles', 'CA', '90001', 'business', 'IT', NULL, NULL, NULL, NULL),
(13, 'Tian', 'Wang', 'e10adc3949ba59abbe56e057f20f883e', '9178893939', 'tianwang@hotmail.com', '87 Shannon ave', 'San Francisco', 'CA', '94016', 'business', 'Finance', NULL, NULL, NULL, NULL),
(14, 'Meng', 'Tian', 'e10adc3949ba59abbe56e057f20f883e', '9178678767', 'mengtian@outlook.com', '34 Dave st', 'Los Angeles', 'CA', '90002', 'home', NULL, '156000', 'yes', 'male', 1984),
(15, 'Xiao', 'Kong', 'e10adc3949ba59abbe56e057f20f883e', '9170908978', 'xiaokong@gmail.com', '23 duke st', 'San Francisco', 'CA', '94016', 'home', NULL, '123000', 'no', 'male', 1988),
(16, 'Di', 'Li', 'e10adc3949ba59abbe56e057f20f883e', '9178890001', 'dili@gmail.com', '11 brook st', 'Los Angeles', 'CA', '90002', 'home', NULL, '76000', 'yes', 'female', 1984),
(17, 'Jiang', 'Liu', 'e10adc3949ba59abbe56e057f20f883e', '9172089876', 'jiangliu@yahoo.com', '765 apple rd', 'San Francisco', 'CA', '94105', 'business', 'manufactoring', NULL, NULL, NULL, NULL),
(18, 'Yu', 'Lin', 'e10adc3949ba59abbe56e057f20f883e', '7134567765', 'yulin@yahoo.com', '66 main st', 'Austin', 'TX', '73301', 'home', NULL, '56000', 'yes', 'male', 1987),
(19, 'Qiong', 'Liu', 'e10adc3949ba59abbe56e057f20f883e', '7134567777', 'qiongl@outlook.com', '24 Tiffany rd', 'Austin', 'TX', '73301', 'home', NULL, '78000', 'no', 'female', 1986),
(20, 'Xiaoyu', 'Wang', 'e10adc3949ba59abbe56e057f20f883e', '7139008890', 'xiaoyuwang@yahoo.com', '77 Levis St', 'Irving', 'TX', '75014', 'business', 'IT', NULL, NULL, NULL, NULL),
(21, 'Junbo', 'Wang', 'e10adc3949ba59abbe56e057f20f883e', '7134567790', 'junbowang@gmail.com', '23 Oakland rd', 'Austin', 'TX', '73344', 'business', 'Finance', NULL, NULL, NULL, NULL),
(22, 'Dandan', 'Li', 'e10adc3949ba59abbe56e057f20f883e', '7139008889', 'dandanli@icloud.com', '34 Tumi ave', 'Austin', 'TX', '73301', 'business', 'Manufacturing', NULL, NULL, NULL, NULL),
(23, 'Bo', 'Liu', 'e10adc3949ba59abbe56e057f20f883e', '7134707790', 'boliu@hotmail.com', '12 main st', 'Austin', 'TX', '73344', 'home', NULL, '89000', 'yes', 'female', 1986);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `salary` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `store_id`, `first_name`, `last_name`, `email`, `job_title`, `salary`) VALUES
(11, 1, 'James', 'Smith', 'jamth11@pittmart.com', 'manager', '$68482'),
(12, 1, 'Linda', 'Hall', 'linll12@pittmart.com', 'sale assistant', '$44246'),
(13, 1, 'paul', 'Allen', 'pauen13@pittmart.com', 'sale assistant', '$44246'),
(21, 2, 'Lisa', 'Stewart', 'lisrt21@pittmart.com', 'manager', '$110477'),
(22, 2, 'Steven', 'Harries', 'stees22@pittmart.com', 'sale assistant', '$49558'),
(23, 2, 'Kevin', 'Perez', 'kevez@pittmart.com', 'sale assistant', '$49558'),
(31, 3, 'Joseph', 'Hill', 'josll31@pittmart.com', 'manager', '$70877'),
(32, 3, 'Brian', 'Cox', 'briox32@pittmart.com', 'sale assistant', '$40845'),
(33, 3, 'Susan', 'Clark', 'susrk33@pittmart.com', 'sale assitant', '$40845'),
(41, 4, 'Laura', 'Kelly', 'lauly41@pittmart.com', 'manager', '$81804'),
(42, 4, 'Jason', 'Lopez', 'kasez42@pittmart.com', 'sale assitant', '$42080'),
(43, 4, 'Larry', 'Nelson', 'laron43@pittmart.com', 'sale assitant', '$42080'),
(51, 5, 'Alice', 'Jenkins', 'alins51@pittmart.com', 'manager', '$62792'),
(52, 5, 'Judy', 'Butler', 'juder52@pittmart.com', 'sale assitant', '$36288'),
(53, 5, 'Scotte', 'Bryant', 'scont53@pittmart.com', 'sale assitant', '$36288');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `shipping_st` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL,
  `product_kind_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `keywords` text,
  `image` text,
  `inventory_amount` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_kind_id`, `name`, `keywords`, `image`, `inventory_amount`, `price`, `cost`) VALUES
(1, 1, 'bacon', 'meat bacon', '1.jpg', 21543, '2.00', '0.99'),
(2, 1, 'beef', 'meat beef', '2.jpg', 10353, '3.27', '1.50'),
(3, 1, 'chicken', 'meat chicken poutry', '3.jpg', 15003, '2.19', '1.30'),
(4, 1, 'lamb', 'meat lamb goat', '4.jpg', 15894, '2.53', '1.34'),
(5, 1, 'sausage', 'meat sausage', '5.jpg', 13592, '1.51', '0.81'),
(6, 2, 'lettuce', 'vegetable lettuce', '6.jpg', 18343, '0.52', '0.21'),
(7, 2, 'cucumber', 'vegetable cucumber', '7.jpg', 170340, '1.83', '0.62'),
(8, 2, 'onion', 'vegetable onion', '8.jpg', 34232, '0.58', '0.24'),
(9, 2, 'broccoli', 'vegetable broccoli', '9.jpg', 19342, '0.48', '0.15'),
(10, 2, 'celery', 'vegetable celery', '10.jpg', 13531, '0.35', '0.11'),
(11, 3, 'apple', 'fruit apple', '11.jpg', 24258, '0.88', '0.61'),
(12, 3, 'cherry', 'fruit cherry', '12.jpg', 22453, '0.97', '0.63'),
(13, 3, 'banana', 'fruit banana', '13.jpg', 39424, '0.35', '0.20'),
(14, 3, 'strawberry', 'fruit strawberry', '14.jpg', 10895, '1.63', '1.01'),
(15, 3, 'mango', 'fruit mango', '15.jpg', 30241, '2.21', '1.12'),
(16, 4, 'biscuit', 'snack biscuit', '16.jpg', 242256, '0.38', '0.15'),
(17, 4, 'chocolate', 'snack chocolate', '17.jpg', 342564, '0.41', '0.17'),
(18, 4, 'chips', 'snack chips', '18.jpg', 23428, '1.09', '0.28'),
(19, 4, 'nuts', 'snack nut nuts', '19.jpg', 104953, '0.61', '0.14'),
(20, 4, 'candy', 'snack candy', '20.jpg', 540231, '0.26', '0.07'),
(21, 5, 'butter', 'dairy butter', '21.jpg', 145431, '0.89', '0.31'),
(22, 5, 'cheese', 'dairy cheese', '22.jpg', 46836, '0.90', '0.29'),
(23, 5, 'yogurt', 'dairy yogurt', '23.jpg', 13456, '1.19', '0.33'),
(24, 5, 'milk', 'dairy milk', '24.jpg', 67890, '3.99', '1.56'),
(25, 5, 'ice cream', 'dairy ice cream', '25.jpg', 35678, '1.69', '0.59');

-- --------------------------------------------------------

--
-- Table structure for table `product_kinds`
--

CREATE TABLE IF NOT EXISTS `product_kinds` (
  `product_kind_id` int(11) NOT NULL,
  `product_kind_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_kinds`
--

INSERT INTO `product_kinds` (`product_kind_id`, `product_kind_name`) VALUES
(1, 'Meat'),
(2, 'Vegetable'),
(3, 'Fruit'),
(4, 'Snack'),
(5, 'Dairy');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `no_of_employees` int(11) NOT NULL,
  `street` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `phone_number`, `no_of_employees`, `street`, `city`, `state`, `zip`) VALUES
(1, '4126667800', 3, '135 N Bellefield Ave', 'Pittsburgh', 'PA', '15213'),
(2, '9173004988', 3, '221 S Grand Ave', 'Los Angeles', 'CA', '90012'),
(3, '7136660909', 3, '6723 Weslayan St', 'Houston', 'TX', '77005'),
(4, '2019990876', 3, '36 W 56th St', 'New York', 'NY', '10019'),
(5, '5067778999', 3, '720 SW Jackson St', 'Chicago', 'IL', '60641');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_kind_id` (`product_kind_id`);

--
-- Indexes for table `product_kinds`
--
ALTER TABLE `product_kinds`
  ADD PRIMARY KEY (`product_kind_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `product_kinds`
--
ALTER TABLE `product_kinds`
  MODIFY `product_kind_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_kind_id`) REFERENCES `product_kinds` (`product_kind_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
