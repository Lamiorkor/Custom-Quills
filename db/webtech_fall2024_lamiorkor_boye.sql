-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2024 at 11:41 PM
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
-- Database: `webtech_fall2024_lamiorkor_boye`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'birthday'),
(2, 'anniversary'),
(3, 'special event'),
(5, 'school'),
(8, 'honeymoon'),
(13, 'funeral');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `reply` text DEFAULT 'No reply yet',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `time_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `user_id`, `message`, `reply`, `is_read`, `time_sent`) VALUES
(1, 4, 'Hi! How do I order?', 'Just click the order service button under the service you want!', 1, '2024-12-03 22:14:56'),
(2, 4, 'Can I shoot a video here?', 'No please', 1, '2024-12-03 22:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `user_id`, `country`, `city`, `phone_number`) VALUES
(2, 2, 'Ghana', 'Accra', '+233206112706'),
(3, 3, 'Ghana', 'Accra', '+233206112706'),
(4, 4, 'Ghana', 'Accra', '+233206112706'),
(5, 5, 'Ghana', 'Accra', '+233206112706'),
(6, 6, 'Ghana', 'Accra', '+233206112706'),
(7, 7, 'Ghana', 'Accra', '+233206112706');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `date_ordered` datetime NOT NULL DEFAULT current_timestamp(),
  `receive_by_date` datetime NOT NULL,
  `express_delivery` tinyint(1) DEFAULT 0,
  `express_charge` decimal(10,2) DEFAULT 0.00,
  `base_total_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_status` enum('pending','in progress','completed','cancelled','paid') NOT NULL DEFAULT 'pending',
  `instructions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `invoice_no`, `date_ordered`, `receive_by_date`, `express_delivery`, `express_charge`, `base_total_amount`, `total_amount`, `order_status`, `instructions`) VALUES
(13, 4, 35084, '2024-12-03 15:27:09', '2024-12-08 00:00:00', 0, 0.00, 20.00, 20.00, 'completed', 'happy birthday to me'),
(14, 4, 71426, '2024-12-03 19:10:07', '2024-12-05 00:00:00', 1, 30.00, 20.00, 50.00, 'cancelled', 'My fish died....please write something sweet'),
(15, 4, 10019, '2024-12-03 19:24:08', '2024-12-11 00:00:00', 0, 0.00, 20.00, 20.00, 'pending', 'I just love food!'),
(16, 4, 93800, '2024-12-03 21:18:20', '2024-12-05 00:00:00', 1, 30.00, 25.00, 55.00, 'pending', 'Ashesi is celebrating 23 years!');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `service_id`, `writer_id`, `qty`) VALUES
(9, 13, 1, 5, 1),
(11, 15, 10, 6, 1),
(12, 16, 15, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `amt` decimal(10,2) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `currency` text NOT NULL,
  `reference` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_requests`
--

CREATE TABLE `role_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_requested` enum('administrator','writer','customer') NOT NULL,
  `status` enum('pending','approved','denied') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(3) NOT NULL,
  `service_name` varchar(45) NOT NULL,
  `service_category` int(3) NOT NULL,
  `service_price` float NOT NULL,
  `service_desc` text NOT NULL,
  `service_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_category`, `service_price`, `service_desc`, `service_keywords`) VALUES
(1, 'Birthday poem', 1, 20, 'Happy birthday poem', 'Birthday, Happy, Hurray'),
(3, 'Retirement poem', 3, 20, 'Congratulations poem', 'Retirement, Happy, Hurray'),
(6, 'Funeral poem', 3, 20, 'Sad poem', 'Funeral, Sad, Mourning'),
(10, 'Food Poem', 1, 20, 'For the love of food', 'Food, Banku, Party, KFC'),
(15, 'Celebration Poem', 3, 25, 'Just something small to celebrate!', 'celebrate, happy, special');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('administrator','writer','customer','pending') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`) VALUES
(2, 'Naa Lamiorkor Boye', 'naalboye@gmail.com', '$2y$10$yNgzsq1cUT8Seg5baBxiruuYjRTaidJfP.4bvQ06jChlMhgsxLC02', 'administrator'),
(3, 'LamBo Ghini', 'boye.lamiorkornaa2018@gmail.com', '$2y$10$GM3e9YW0T4.XkIOv3t4d6uThTW2yn3Vq1osm8XOckASk6yYJ21kXO', 'writer'),
(4, 'Henry Hart', 'hartinator@gmail.com', '$2y$10$1TNYWczSE/GG.613Ba/OZ.MKO4Cje/yjD1HYrMMJdmwsgL1uBV3l6', 'customer'),
(5, 'Yeoni Lamptey', 'yeoniisthebest@gmail.com', '$2y$10$g/nDJy3VDHhYeKlQ7qatdON9Ir1yL0aQq4vh9Fa/mXw3WjqzGRSAO', 'writer'),
(6, 'Bene Lomo', 'bene.lomo@ashesi.edu.gh', '$2y$10$ZhMA2s2FHptyU6CpEOm4HeeKpzCOti6OUxEbitLM6w69qjCKwenLq', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `writers`
--

CREATE TABLE `writers` (
  `writer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `years_of_experience` int(11) NOT NULL,
  `speciality` varchar(100) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `availability_status` enum('available','unavailable') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `writers`
--

INSERT INTO `writers` (`writer_id`, `user_id`, `years_of_experience`, `speciality`, `rating`, `availability_status`) VALUES
(5, 3, 6, 'birthday poems; holiday poems', 4.8, 'available'),
(6, 2, 15, 'Everything', 3.5, 'available'),
(7, 5, 2, 'Love Poems', 5.0, 'unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `writer_requests`
--

CREATE TABLE `writer_requests` (
  `request_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `status` enum('pending','in progress','completed','cancelled') NOT NULL DEFAULT 'pending',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `writer_requests`
--

INSERT INTO `writer_requests` (`request_id`, `order_id`, `writer_id`, `status`, `date_created`) VALUES
(1, 13, 5, 'completed', '2024-12-03 16:27:09'),
(2, 14, 5, 'pending', '2024-12-03 20:10:07'),
(3, 15, 6, 'pending', '2024-12-03 20:24:08'),
(4, 16, 6, 'pending', '2024-12-03 22:18:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`service_id`),
  ADD KEY `writer_id` (`writer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `role_requests`
--
ALTER TABLE `role_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `Foreign Key` (`service_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `writers`
--
ALTER TABLE `writers`
  ADD PRIMARY KEY (`writer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `writer_requests`
--
ALTER TABLE `writer_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `writer_id` (`writer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_requests`
--
ALTER TABLE `role_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `writers`
--
ALTER TABLE `writers`
  MODIFY `writer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `writer_requests`
--
ALTER TABLE `writer_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`writer_id`) REFERENCES `writers` (`writer_id`) ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `role_requests`
--
ALTER TABLE `role_requests`
  ADD CONSTRAINT `role_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `writers`
--
ALTER TABLE `writers`
  ADD CONSTRAINT `writers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `writer_requests`
--
ALTER TABLE `writer_requests`
  ADD CONSTRAINT `writer_requests_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `writer_requests_ibfk_2` FOREIGN KEY (`writer_id`) REFERENCES `writers` (`writer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
