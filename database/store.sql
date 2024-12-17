-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 11:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `added_at` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `status`, `image`, `added_at`) VALUES
(1, 'Kalia', 'This is kalisa brand', 'Allow', './img/categories/675a9cb7b7978.png', '2024-12-12 13:20:28'),
(2, 'brand2', 'desc', 'Allow', './img/categories/675a9e3621871.png', '2024-12-12 13:26:30'),
(3, 'Local', 'This is local brand', 'Allow', './img/categories/675ab56fe6e1a.jpg', '2024-12-12 15:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(50) NOT NULL,
  `Product_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `sizes` varchar(255) NOT NULL,
  `colors` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(110) NOT NULL,
  `name` varchar(100) NOT NULL,
  `add_time` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `status_of` varchar(255) NOT NULL DEFAULT 'block',
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `add_time`, `image_path`, `status_of`, `description`) VALUES
(26, 'category 1', '2024-12-10 12:45:03', './img/categories/6757f17f6ddea.png', 'Allow', 'this is a grey shirt with high quality productuin'),
(27, 'category 2', '2024-12-10 12:45:17', './img/categories/6757f18d20bff.png', 'Allow', 'terr'),
(28, 'category 3', '2024-12-10 12:45:32', './img/categories/6757f19ce5632.png', 'Allow', 'female dress'),
(29, 'category 4', '2024-12-10 12:45:57', './img/categories/6757f1b5cf6a4.png', 'Allow', 'male shirt'),
(30, 'category 5', '2024-12-10 12:46:16', './img/categories/6757f1c87b2b2.png', 'Allow', 'grey male shirt');

-- --------------------------------------------------------

--
-- Table structure for table `live_messages`
--

CREATE TABLE `live_messages` (
  `id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `time` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `role` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `live_messages`
--

INSERT INTO `live_messages` (`id`, `user_id`, `message`, `time`, `role`) VALUES
(1, 1, 'Hi this is test', 'current_timestamp()', 2),
(2, 1, 'hi this is admin', 'current_timestamp()', 1),
(3, 1, 'hi this is at 1:46', 'current_timestamp()', 2),
(4, 1, 'this is test', '2024-12-17 13:54:34', 2),
(5, 1, 'this is user message', '2024-12-17 13:55:48', 2),
(6, 1, 'its 2:12\r\n', '2024-12-17 14:12:43', 2),
(7, 1, 'this is latest msg\r\n', '2024-12-17 14:14:51', 2),
(8, 1, 'hi', '2024-12-17 14:16:18', 2),
(9, 1, 'hey this is test', '2024-12-17 14:37:25', 2),
(10, 1, 'hi', '2024-12-17 15:40:21', 1),
(11, 1, 'hello', '2024-12-17 15:47:57', 1),
(12, 1, 'hi', '2024-12-17 15:48:41', 2),
(13, 1, 'helo', '2024-12-17 15:48:53', 1),
(14, 5, 'hi this is test', '2024-12-17 15:52:16', 2),
(15, 5, 'this is reply', '2024-12-17 15:54:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `user_id`, `status`) VALUES
(1, 'Muhammad Khateeb', 'khateebfareed114582@gmail.com', 'test', 'test', 1, 'read');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_exp` varchar(255) NOT NULL,
  `card_cvc` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `items` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `tracking_id` varchar(255) NOT NULL,
  `added_at` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `colors` varchar(255) NOT NULL,
  `sizes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `f_name`, `l_name`, `phone_number`, `email`, `country`, `address`, `city`, `zip`, `card_name`, `card_number`, `card_exp`, `card_cvc`, `amount`, `items`, `user_id`, `status`, `tracking_id`, `added_at`, `quantity`, `colors`, `sizes`) VALUES
(3, 'Muhammad', 'Khateeb', '03481156978', 'khateebfareed114582@gmail.com', 'Pakistan', 'Flat 14, faimly Plaza Humak', 'Islamabad ', '45700', 'Muhammad Khateeb', '4596610023654587', '122028', '', 240, '[\"33\"]', 1, 'Pending', '675c2a3106147', '2024-12-13 17:36:01', 3, '', ''),
(4, 'Muhammad', 'Khateeb', '03481156978', 'khateebfareed114582@gmail.com', 'Pakistan', 'Flat 14, faimly Plaza Humak', 'Islamabad ', '45700', 'Muhammad Khateeb', '653265236523', '5', '5', 240, '[\"33\"]', 1, 'Delivered', '675c2a5066833', '2024-12-13 17:36:32', 3, '', ''),
(5, 'Muhammad', 'Khateeb', '03481156978', 'khateebfareed114582@gmail.com', 'Pakistan', 'Flat 14, faimly Plaza Humak', 'Islamabad ', '45700', 'Muhammad Khateeb', '4596610023652365', '122025', '123', 220, '[\"33\"]', 1, 'Confirmed', '675c2bad8883b', '2024-12-13 17:42:21', 3, '', ''),
(8, 'Muhammad', 'Khateeb', '03481156978', 'khateebfareed114582@gmail.com', 'Pakistan', 'Flat 14, faimly Plaza Humak', 'Islamabad ', '45700', 'Muhammad ', '5404', '21', '545', 250, '[\"34\",\"33\"]', 1, 'Delivered', 'TRACK675c33619b8bev', '2024-12-13 18:15:13', 2, '', ''),
(9, 'Muhammad', 'haseeb', '03481156978', 'khateebfareed114582@gmail.com', 'Pakistan', 'Flat 14, faimly Plaza Humak', 'Islamabad ', '45700', '45', '45', '45', '45', 800, '[\"33\"]', 1, 'Confirmed', 'TRACK675e99d6be5fav', '2024-12-15 13:56:54', 10, '', ''),
(10, 'Muhammad', 'Khateeb', '03481156978', 'khateebfareed114582@gmail.com', 'Pakistan', 'Flat 14, faimly Plaza Humak', 'Islamabad ', '45700', 'Muhammad Khateeb', '65405', '704', '056', 980, '[\"23\"]', 1, 'pending', 'T675eff3a580fdv', '2024-12-15 21:09:30', 1, 'Blue', 'M'),
(11, 'Muhammad', 'Khateeb', '03481156978', 'khateebfareed114582@gmail.com', 'Pakistan', 'Flat 14, faimly Plaza Humak', 'Islamabad ', '45700', 'Muhammad Khateeb', '555', '55', '55', 70, '[\"32\"]', 4, 'pending', 'T675ff20c0b3b3v', '2024-12-16 14:25:32', 1, 'Green', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` varchar(11) NOT NULL,
  `images` varchar(500) NOT NULL,
  `orignal_price` varchar(255) NOT NULL,
  `review_id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `added_at` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `quantity` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `discounted_price` varchar(255) NOT NULL,
  `specification` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `colors` varchar(500) NOT NULL,
  `sizes` varchar(500) NOT NULL,
  `promotion` varchar(500) DEFAULT NULL,
  `show` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `images`, `orignal_price`, `review_id`, `description`, `added_at`, `quantity`, `status`, `discounted_price`, `specification`, `brand_id`, `colors`, `sizes`, `promotion`, `show`) VALUES
(23, 'Shirt', '26', '[\"./img/products/67596b76802d0.png\",\"./img/products/67596b7680560.png\",\"./img/products/675961258793b.png\",\"./img/products/6759612587baa.png\"]', '1000', '', 'This is a good quality product', '2024-12-11 14:53:41', '1', 'Allow', '980', 'Available in different size and colors', 2, '{\"colorBlack\":false,\"colorBlue\":true,\"colorGreen\":false,\"colorRed\":true,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":true,\"XL\":true,\"XXL\":false}', '{\"promotionPercentage\":\"\",\"promotionName\":\"\"}', 'Hot'),
(24, 'shirt', '26', '[\"./img/products/6759932743c9e.png\"]', '100', '', 'Description', '2024-12-11 18:27:03', '1', 'Allow', '90', 'specification', 3, '{\"colorBlack\":false,\"colorBlue\":true,\"colorGreen\":false,\"colorRed\":false,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":false,\"XL\":false,\"XXL\":false}', '{\"promotionPercentage\":\"10\",\"promotionName\":\"Summer Deal\"}', 'Hot'),
(25, 'frok', '27', '[\"./img/products/67599637acf77.png\"]', '500', '', 'desc', '2024-12-11 18:40:07', '12', 'Allow', '490', 'spec', 1, '{\"colorBlack\":false,\"colorBlue\":true,\"colorGreen\":false,\"colorRed\":false,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":false,\"XL\":true,\"XXL\":false}', '{\"promotionPercentage\":\"5\",\"promotionName\":\"Winter Deal\"}', 'Hot'),
(26, 'prod4', '27', '[\"./img/products/6759993e9a214.png\"]', '1000', '', 'desc', '2024-12-11 18:53:02', '10', 'Allow', '980', 'desc', 2, '{\"colorBlack\":false,\"colorBlue\":false,\"colorGreen\":false,\"colorRed\":true,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":false,\"L\":true,\"XL\":false,\"XXL\":false}', '{\"promotionPercentage\":\"\",\"promotionName\":\"\"}', 'Best'),
(27, 'shirt', '28', '[\"./img/products/675a95de9de7f.png\"]', '10', '', 'disc', '2024-12-12 12:50:54', '10', 'Allow', '9', 'spec', 3, '{\"colorBlack\":false,\"colorBlue\":false,\"colorGreen\":false,\"colorRed\":false,\"colorYellow\":true,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":false,\"XL\":false,\"XXL\":false}', '{\"promotionPercentage\":\"10\",\"promotionName\":\"Winter Deal\"}', 'Best'),
(28, 'shirt', '28', '[\"./img/products/675a96095827e.png\"]', '100', '', 'disc', '2024-12-12 12:51:37', '10', 'Allow', '98', 'spec', 3, '{\"colorBlack\":false,\"colorBlue\":false,\"colorGreen\":false,\"colorRed\":true,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":true,\"XL\":false,\"XXL\":false}', '{\"promotionPercentage\":\"2\",\"promotionName\":\"Winter Deal\"}', 'Best'),
(29, 'shirt', '29', '[\"./img/products/675a963856436.jpg\"]', '100', '', 'desc', '2024-12-12 12:52:24', '5', 'Allow', '95', 'spec', 3, '{\"colorBlack\":false,\"colorBlue\":true,\"colorGreen\":false,\"colorRed\":true,\"colorYellow\":true,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":false,\"XL\":true,\"XXL\":false}', '{\"promotionPercentage\":\"5\",\"promotionName\":\"Winter Deal\"}', 'Featured'),
(30, 'shirt', '29', '[\"./img/products/675a9667a4222.jpg\"]', '100', '', 'desc', '2024-12-12 12:53:11', '5', 'Allow', '90', 'spec', 3, '{\"colorBlack\":true,\"colorBlue\":true,\"colorGreen\":false,\"colorRed\":false,\"colorYellow\":false,\"colorBrown\":true}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":false,\"XL\":false,\"XXL\":true}', '{\"promotionPercentage\":\"10\",\"promotionName\":\"Winter Deal\"}', 'Featured'),
(31, 'shirt', '30', '[\"./img/products/675a96941ae24.jpg\"]', '120', '', 'desc', '2024-12-12 12:53:56', '10', 'Allow', '90', 'spec', 2, '{\"colorBlack\":true,\"colorBlue\":false,\"colorGreen\":true,\"colorRed\":true,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":true,\"S\":false,\"M\":false,\"L\":false,\"XL\":true,\"XXL\":false}', '{\"promotionPercentage\":\"20\",\"promotionName\":\"Winter Deal\"}', 'Featured'),
(32, 'prod1', '30', '[\"./img/products/675aa5ae209b3.jpg\"]', '100', '', 'desc', '2024-12-12 13:58:22', '1', 'Allow', '90', 'spec', 1, '{\"colorBlack\":false,\"colorBlue\":false,\"colorGreen\":true,\"colorRed\":false,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":false,\"L\":true,\"XL\":false,\"XXL\":false}', '{\"promotionPercentage\":\"10\",\"promotionName\":\"Winter Deal\"}', 'New'),
(33, 'prod2', '29', '[\"./img/products/675aa5cf81394.png\"]', '100', '', 'desc', '2024-12-12 13:58:55', '5', 'Allow', '80', 'spec', 2, '{\"colorBlack\":false,\"colorBlue\":true,\"colorGreen\":false,\"colorRed\":false,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":false,\"XL\":false,\"XXL\":false}', '{\"promotionPercentage\":\"20\",\"promotionName\":\"Winter Deal\"}', 'New'),
(34, 'prod310', '27', '[\"./img/products/675aa605cb70a.png\"]', '100', '', 'descspec', '2024-12-12 13:59:49', '10', 'Allow', '90', 'spec', 1, '{\"colorBlack\":false,\"colorBlue\":true,\"colorGreen\":false,\"colorRed\":false,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":false,\"XL\":false,\"XXL\":false}', '{\"promotionPercentage\":\"10\",\"promotionName\":\"Winter Deal\"}', 'New'),
(35, 'prod', '28', '[\"./img/products/675aa6342c9f9.jpg\"]', '100', '', 'desc', '2024-12-12 14:00:36', '10', 'Allow', '90', 'spec', 2, '{\"colorBlack\":true,\"colorBlue\":true,\"colorGreen\":true,\"colorRed\":true,\"colorYellow\":true,\"colorBrown\":true}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":false,\"XL\":false,\"XXL\":false}', '{\"promotionPercentage\":\"10\",\"promotionName\":\"Winter Deal\"}', 'New'),
(36, 'mr brand', '26', '[\"./img/products/675aa9d7af33f.png\"]', '100', '', 'desc', '2024-12-12 14:16:07', '10', 'Allow', '90', 'spec', 1, '{\"colorBlack\":true,\"colorBlue\":false,\"colorGreen\":false,\"colorRed\":false,\"colorYellow\":false,\"colorBrown\":false}', '{\"XS\":false,\"S\":false,\"M\":true,\"L\":false,\"XL\":false,\"XXL\":false}', '{\"promotionPercentage\":\"5\",\"promotionName\":\"Winter Deal\"}', 'New'),
(37, 'test product', '27', '[\"./img/products/675ecccc36020.png\",\"./img/products/675ecccc362bf.png\",\"./img/products/675ecccc36506.jpg\"]', '100', '', 'desc', '2024-12-15 17:34:20', '10', 'Allow', '99', 'spec\r\n', 2, '{\"colorBlack\":true,\"colorBlue\":true,\"colorGreen\":true,\"colorRed\":true,\"colorYellow\":true,\"colorBrown\":true}', '{\"XS\":true,\"S\":true,\"M\":true,\"L\":true,\"XL\":true,\"XXL\":true}', '{\"promotionPercentage\":\"1\",\"promotionName\":\"Overall\"}', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(11) NOT NULL,
  `role` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `email`, `number`, `role`, `password`) VALUES
(1, 'Muhammad', 'hamza', 'khateebfareed114582@gmail.com', '03481156978', '1', '$2y$10$RJh2xFNuj.H.Jak17P4kVu1H7Hy3uQfgK86IRDvg6f6LmiLEITrf6'),
(3, 'Muhammad', 'hamza', 'khateebfareed114582@gmail.com', '03481156978', '', '$2y$10$ZJUGy5PHq/t.eL3/Rin5leGex79um0jqMruYNF4TZer8flpWUnPO2'),
(4, 'Muhammad', 'Khateeb', 'khateebfareed@gmail.com', '07354678688', '', '$2y$10$8LjNWh3mA6VaEIna/jabcuQUEg2x9A0BAgIY61cxGaaBZFgKdn98G'),
(5, 'Muhammad', 'Khateeb', 'cghf@hn.com', '07354678688', '', '$2y$10$qu/BqJjyw6VPkKHVs0RPUeWHSqpN39ZVS3wVq2cy/Lc4RYlfZPGUG');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `voucher` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `voucher`, `discount`) VALUES
(1, 'xyz', 20);

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL,
  `Product_id` int(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`id`, `Product_id`, `user_id`) VALUES
(13, 32, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `live_messages`
--
ALTER TABLE `live_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `live_messages`
--
ALTER TABLE `live_messages`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
