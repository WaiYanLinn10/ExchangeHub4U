-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 02:26 AM
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
-- Database: `exchangehub4u`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `created_time`, `user_id`) VALUES
(1, 'ExchangeHub4U', '2025-03-30 23:21:57', 1),
(7, 'Test', '2025-04-01 19:15:34', 2),
(9, 'test2', '2025-04-01 19:44:27', 4),
(15, 'admin3', '2025-04-01 23:38:13', 5);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_img`) VALUES
(1, 'Asus', 'asus.jpg'),
(2, 'Apple', 'apple.jpg\r\n'),
(3, 'MSI', 'msi.jpg'),
(5, 'Alienware', 'alienware.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Laptop', 'A laptop is a portable computer that can be easily carried around. It\'s a device designed for personal use and can perform various functions such as browsing the internet, creating documents, playing games, etc. Laptops are generally smaller in size than desktop computers and are battery powered.'),
(2, 'Phone', 'a device that uses either a system of wires along which electrical signals are sent or a system of radio signals to make it possible for you to speak to someone in another place who has a similar device');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` double NOT NULL,
  `created_time` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`, `customer_phone`, `created_time`, `user_id`) VALUES
(8, 'Test', 'Testing', 1234567891, '2025-04-02', 2),
(11, 'aaaaaaa', 'dddddddddddd', 111111111, '2025-04-02', 22),
(16, 'ddd', 'ddddd', 12123123213, '2025-04-02', 45),
(17, 'avaa', 'avaaa', 12312312312, '2025-04-02', 49),
(18, 'ffff', 'ffffffffffff', 121312312312, '2025-04-02', 47),
(19, 'eeee', 'eeeeeeeeeeee', 5555555555, '2025-03-31', 46),
(21, 'aaaaaa', 'aaaaaaaaaaaa', 22222111111, '2025-04-02', 22),
(22, 'admin', 'admin', 999888888777, '2025-04-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `faq_question` text NOT NULL,
  `faq_answer` text NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `answer_time` datetime DEFAULT current_timestamp(),
  `admin_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `posted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `shipping_address` varchar(255) NOT NULL,
  `delivered` tinyint(1) NOT NULL,
  `delivery_name` varchar(255) NOT NULL,
  `phone_no` double NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_date`, `shipping_address`, `delivered`, `delivery_name`, `phone_no`, `customer_id`) VALUES
(3, '2025-03-27', 'ahlone asdfasf', 0, 'dsaf dsfs', 1231231, 11),
(6, '2025-03-31', 'bahan sdfdsaf', 0, 'ddddd ddddd', 2222222222, 16),
(9, '2025-03-31', 'bahan dddddddddddddddd', 0, 'eeeee 22', 1111133333333, 19);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_product_id` int(11) NOT NULL,
  `order_product_quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_product_id`, `order_product_quantity`, `order_id`, `product_id`) VALUES
(1, 2, 3, 1),
(6, 2, 6, 1),
(13, 1, 9, 1),
(14, 1, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_time` date NOT NULL,
  `total_amount` float NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_time`, `total_amount`, `payment_type_id`, `customer_id`, `order_id`, `transaction_no`) VALUES
(3, '0000-00-00', 9879400, 2, 11, 3, ''),
(5, '0000-00-00', 9879400, 1, 16, 6, '2233223122311'),
(8, '0000-00-00', 4940700, 1, 19, 9, '1222222222222222');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_type_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `payment_type`, `payment_type_description`) VALUES
(1, 'Bank Transfer', 'Trasfer Via Bank '),
(2, 'Cash On Delivery', 'Payment on the day of recieving Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_description` longtext NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_add_date` datetime NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) NOT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_rating` int(11) DEFAULT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_description`, `product_quantity`, `product_add_date`, `category_id`, `product_img`, `product_rating`, `brand_id`) VALUES
(1, 'ASUS TUF Gaming A17 (2023)', 4938700, '-Windows 11 Home\r\n-Up to GeForce RTX™ 4070 Laptop GPU\r\n-AMD Ryzen™ 7040 Series Processor\r\n-90W battery\r\n-Type C Fast Charging\r\n-84 blades Arc-Flow Fans & 4 exhaust vents\r\n-Mux Switch with NVIDIA Advanced Optimus\r\n-MIL-STD-810H Standards', 8, '2025-04-01 02:30:10', 1, 'laptop.jpg', 5, 1),
(2, 'iPhone 16 Pro', 4454000, '- Apple A18 (3 nm)\r\n- 512GB 8GB RAM\r\n- Super Retina XDR OLED, HDR10, Dolby Vision, 1000 nits (typ), 2000 nits (HBM)\r\n- 170 g (6.00 oz)\r\n- 48 MP, f/1.6, 26mm (wide), 1/1.56\", 1.0µm, dual pixel PDAF, sensor-shift OIS\r\n12 MP, f/2.2, 13mm, 120˚ (ultrawide), 0.7µm, dual pixel PDAF\r\n- Li-Ion 3561 mAh', 10, '2025-04-01 02:30:10', 2, 'iphone.jpg', 5, 2),
(3, 'test', 1000000, 'test', 2, '2025-04-01 03:11:42', 1, '67eb1037480754.18277136.png', NULL, 1),
(4, 'test3', 30000, 'test3', 8, '2025-04-01 03:13:45', 1, '67eb1468b3c286.93432737.jpg', NULL, 1),
(5, 'test2', 20000, 'test2', 7, '2025-04-01 03:31:56', 1, '67eb107108fed5.08701141.jpeg', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_reveiw`
--

CREATE TABLE `product_reveiw` (
  `review_id` int(11) NOT NULL,
  `review_title` varchar(255) NOT NULL,
  `review_description` text NOT NULL,
  `rating` float NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `shoppingcart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`shoppingcart_id`, `customer_id`) VALUES
(1, 11),
(3, 16),
(4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart_product`
--

CREATE TABLE `shoppingcart_product` (
  `shoppingcart_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `shoppingcart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(255) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `user_type`) VALUES
(1, 'admin1', 'admin1@gmail.com', '$2y$10$MUEamTFIX/SQVelNDynmAejXdW4iOJzO/PFhvKu26pTHmHnt.1lTm', 0),
(2, 'Test', 'test1@gmail.com', '$2y$10$j0btMMF3w4EwDQkayF5yDuyFmV6ERzzLCOJbrs4FZY3qnNqstf1.u', 0),
(4, 'test2', 'test2@gmail.com', '$2y$10$XQpw/if2GXq3Z.qj0KLzP.Jyv25hsCodJ.rt8WWEEbGHsyByNNLf.', 0),
(5, 'admin3', 'admin3@gmail.com', '$2y$10$Z6RvcNNYX8CjxHWSiB8nX.gqsDru0Kdp9AE/gDDKawj2zk5S1gqpC', 0),
(22, 'aaaa', 'aaaa@gmail.com', '$2y$10$86z9ROUh53QzIBzvMY2qveE/m1lQnX8aI72kKjn7GFPoEw8bpVGES', 1),
(43, 'bbbb', 'bbbb@gmail.com', '$2y$10$eNMj1vG12UWYr62O163OteP8nTEPIb499Ex7rGxsRj/s5cPTH80gu', 1),
(44, 'cccc', 'cccc@gmail.com', '$2y$10$yGV5d0Zwkv68GBJIYI4zr.EFEQ.BSibglZ.P6ctkXSxe3/xaGiXXq', 1),
(45, 'dddd', 'dddd@gmail.com', '$2y$10$XqHUB4gtXpR7TsfnPnwKMuALRXxXfZbZ2w.7Li1oyLmRkMxq6lI/K', 1),
(46, 'eeee', 'eeee@gmail.com', '$2y$10$5nHf.N7YCv4LMWVgorrTKufmKAsUOwrZr4maz2i8Q2HcPybxGpuDa', 1),
(47, 'ffff', 'ffff@gmail.com', '$2y$10$dpvoM6f26h0MMdzSDHmRGO8aXOV5KKp8MDil/J4aCJbfMGDaCSROG', 1),
(48, 'gggg', 'gggg@gmail.com', '$2y$10$MCgUJMG/mLBOi3FnjhNNWer.nQpmfsl0MucWeRoSAnUzWLAbnmxtO', 1),
(49, 'avaa', 'avaa@gmail.com', '$2y$10$H3/zqC7F1CIaSGK5UeeR5uDgnqLkV/blFnRm0o78lRanXCeGQsDiu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `customer_id`) VALUES
(7, 11),
(8, 16);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_product`
--

CREATE TABLE `wishlist_product` (
  `wishlist_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `wishlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist_product`
--

INSERT INTO `wishlist_product` (`wishlist_product_id`, `product_id`, `wishlist_id`) VALUES
(11, 2, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `payment_id` (`payment_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_type_id` (`payment_type_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_reveiw`
--
ALTER TABLE `product_reveiw`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`shoppingcart_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `shoppingcart_product`
--
ALTER TABLE `shoppingcart_product`
  ADD PRIMARY KEY (`shoppingcart_product_id`),
  ADD KEY `shoppingcart_id` (`shoppingcart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email_idx` (`email`) USING BTREE;

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `wishlist_product`
--
ALTER TABLE `wishlist_product`
  ADD PRIMARY KEY (`wishlist_product_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `wishlist_id` (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_reveiw`
--
ALTER TABLE `product_reveiw`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `shoppingcart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shoppingcart_product`
--
ALTER TABLE `shoppingcart_product`
  MODIFY `shoppingcart_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist_product`
--
ALTER TABLE `wishlist_product`
  MODIFY `wishlist_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faq_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`payment_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_reveiw`
--
ALTER TABLE `product_reveiw`
  ADD CONSTRAINT `product_reveiw_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_reveiw_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shoppingcart_product`
--
ALTER TABLE `shoppingcart_product`
  ADD CONSTRAINT `shoppingcart_product_ibfk_1` FOREIGN KEY (`shoppingcart_id`) REFERENCES `shoppingcart` (`shoppingcart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shoppingcart_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist_product`
--
ALTER TABLE `wishlist_product`
  ADD CONSTRAINT `wishlist_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_product_ibfk_2` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlist` (`wishlist_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
