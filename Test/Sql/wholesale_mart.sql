-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 04, 2023 at 08:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wholesale_mart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Processing','Shipped','Delivered','Cancelled') NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `product_description` text NOT NULL,
  `stock` int(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `product_image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_description`, `stock`, `status`, `created`, `product_image`, `price`, `dealer_id`) VALUES
(44, 'Mobile', 'lknlknnlk', 0, 1, '2023-10-03 20:59:17', '651c2fc9077ba.jpg', 123, 4),
(45, 'Messi', 'asdfweqr', 89, 1, '2023-10-03 20:59:43', '651c2fe3e06d4.jpg', 1234, 4),
(46, 'Biscuit', 'The aklsdflhaslkfjad', 1, 1, '2023-10-04 14:08:29', '651d210117aec.jpg', 1300, 4),
(47, 'Bottle', 'Hello', 100, 1, '2023-10-04 20:21:17', '651d786101758.jpg', 130, 4);

-- --------------------------------------------------------

--
-- Table structure for table `requested_price`
--

CREATE TABLE `requested_price` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `retailer_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requested_price`
--

INSERT INTO `requested_price` (`id`, `dealer_id`, `retailer_id`, `status`, `created`) VALUES
(30, 4, 9, 1, '2023-10-04 20:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `acc_type` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `store_name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `f_name`, `l_name`, `email`, `phone_no`, `password`, `acc_type`, `address`, `store_name`, `image`, `active`, `created_at`) VALUES
(2, 'Eaton Jimenez', 'Deborah Lambert', 'nucyx@mailinator.com', '9815100588', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'Retailer', 'Non officia quo mole', 'Jenna Melton', '354754407_278541934592342_8113638702573633599_n.jpg', 1, '2023-07-17 22:53:48'),
(4, 'Bishal', 'Shrestha', 'playerboy478@gmail.com', '9815100588', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dealer', 'Syangja', 'Kamala Stores', '355212690_565680785642904_5827797170606900152_n.jpg', 1, '2023-07-18 00:52:05'),
(5, 'Saugat ', 'Poudel', 'saugatpoudel@gmail.com', '9846012345', '4b6ed35f0ebe7e6348e718fc44b65738', 'Dealer', 'Pokhara', 'Birauta', '355054003_225718886929287_5428582139209606995_n.jpg', 1, '2023-07-18 20:37:26'),
(6, 'Anushka', 'Thapa', 'anushkathapa@gmail.com', '9811223344', 'b714801b96f39a72bb28e8e70946c3a3', 'Dealer', 'Syangja', 'Anushki Stores', 'wallpaper-mania.com_High_resolution_wallpaper_background_ID_77700724738.jpg', 1, '2023-07-18 22:41:22'),
(7, 'saugat', 'paudel', 'be2020se711@gces.edu.np', '9815100588', 'e87c5fcfbc99dd425dc0c436bd6e5840', 'Dealer', 'Syangja', 'Kamala Stores', '355201941_1725108184606675_2569594426410329000_n.jpg', 1, '2023-07-19 06:50:28'),
(8, 'Success', 'Chhantyal', 'success@gmail.com', '9846072189', '260ca9dd8a4577fc00b7bd5810298076', 'Dealer', 'Pokhara', 'Success', 'Screenshot_20230714_220343.png', 1, '2023-07-19 07:30:02'),
(9, 'Sujit', 'Khanal', 'sujit@gmail.com', '9815100588', '900150983cd24fb0d6963f7d28e17f72', 'Retailer', 'Pokhara', 'Bishal', 'wallpaperflare.com_wallpaper.jpg', 1, '2023-09-26 21:06:45'),
(10, 'Anushka', 'Thapa', 'anushka@gmail.com', '9819111086', 'cd0acfe085eeb0f874391fb9b8009bed', 'Dealer', 'Pokhara', 'store', 'wallpaperflare.com_wallpaper (1).jpg', 1, '2023-09-30 21:03:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requested_price`
--
ALTER TABLE `requested_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `requested_price`
--
ALTER TABLE `requested_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
