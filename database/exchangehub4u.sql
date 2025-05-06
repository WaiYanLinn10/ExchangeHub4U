/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL,
  `brand_img` varchar(255) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` longtext DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` double NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_question` text NOT NULL,
  `faq_answer` text DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `answer_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `posted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`faq_id`),
  KEY `admin_id` (`admin_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `faq_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `shipping_address` varchar(255) NOT NULL,
  `delivered` tinyint(1) NOT NULL,
  `delivery_name` varchar(255) NOT NULL,
  `phone_no` double NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `order_product` (
  `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_product_quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`order_product_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_time` datetime NOT NULL DEFAULT current_timestamp(),
  `total_amount` float NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `payment_id` (`payment_id`),
  KEY `order_id` (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `payment_type_id` (`payment_type_id`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`payment_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(255) NOT NULL,
  `payment_type_description` text NOT NULL,
  PRIMARY KEY (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_description` longtext NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_add_date` datetime NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) NOT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_rating` int(11) DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `shoppingcart` (
  `shoppingcart_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`shoppingcart_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `shoppingcart_product` (
  `shoppingcart_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `shoppingcart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`shoppingcart_product_id`),
  KEY `shoppingcart_id` (`shoppingcart_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `shoppingcart_product_ibfk_1` FOREIGN KEY (`shoppingcart_id`) REFERENCES `shoppingcart` (`shoppingcart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `shoppingcart_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_idx` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`wishlist_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `wishlist_product` (
  `wishlist_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `wishlist_id` int(11) NOT NULL,
  PRIMARY KEY (`wishlist_product_id`),
  KEY `product_id` (`product_id`),
  KEY `wishlist_id` (`wishlist_id`),
  CONSTRAINT `wishlist_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wishlist_product_ibfk_2` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlist` (`wishlist_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`admin_id`, `admin_name`, `created_time`, `user_id`) VALUES
(1, 'ExchangeHub4U', '2025-03-30 23:21:57', 1);
INSERT INTO `admin` (`admin_id`, `admin_name`, `created_time`, `user_id`) VALUES
(17, 'Wai Yam Lin', '2025-05-05 21:58:33', 51);


INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_img`) VALUES
(1, 'Asus', 'asus.jpg');
INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_img`) VALUES
(2, 'Apple', 'apple.jpg\r\n');
INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_img`) VALUES
(3, 'MSI', 'msi.jpg');
INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_img`) VALUES
(5, 'Alienware', 'alienware.jpg'),
(6, 'Samsung', 'samsung.png'),
(7, 'Simplus', 'simplus.png'),
(8, 'Razer Gaming', 'razer.png'),
(9, 'FanTech', 'fantech.png'),
(10, 'Nike', 'nike.png'),
(12, 'Adidas', 'adidas.jpg'),
(13, 'LEGO', 'lego.png'),
(14, 'COSRX', 'cosrx.jpg'),
(15, 'CENTELLA', 'centella.png'),
(16, 'Swiss Military', 'swiss.png');

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Laptop', 'A laptop is a portable computer that can be easily carried around. It\'s a device designed for personal use and can perform various functions such as browsing the internet, creating documents, playing games, etc. Laptops are generally smaller in size than desktop computers and are battery powered.');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(2, 'Phone', 'a device that uses either a system of wires along which electrical signals are sent or a system of radio signals to make it possible for you to speak to someone in another place who has a similar device');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(3, 'Clothing', 'Clothes, Shoes, Hats and so on\r\n');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(7, 'Kitchen Appliance', 'Refrigerator, toaster, kettle, microwave, blender. The domestic application attached to home appliance is tied to the definition of appliance as \"an instrument or device designed for a particular use or function\".'),
(8, 'Eletronic', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident, modi molestiae. Explicabo illum non quo expedita! Libero, dolore cupiditate possimus amet voluptatum sit mollitia neque voluptate nisi, iure quam aliquam.'),
(9, 'Travel Essentials', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident, modi molestiae. Explicabo illum non quo expedita! Libero, dolore cupiditate possimus amet voluptatum sit mollitia neque voluptate nisi, iure quam aliquam.'),
(10, 'Toy', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident, modi molestiae. Explicabo illum non quo expedita! Libero, dolore cupiditate possimus amet voluptatum sit mollitia neque voluptate nisi, iure quam aliquam.'),
(11, 'Skin Care', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident, modi molestiae. Explicabo illum non quo expedita! Libero, dolore cupiditate possimus amet voluptatum sit mollitia neque voluptate nisi, iure quam aliquam.');

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`, `customer_phone`, `created_time`, `user_id`) VALUES
(22, 'ExchangeHub4U', 'Yangon', 9123456789, '2025-04-02 00:00:00', 1);
INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`, `customer_phone`, `created_time`, `user_id`) VALUES
(23, 'Sylvie', 'Yangon', 9123456789, '2025-05-05 22:00:33', 52);
INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`, `customer_phone`, `created_time`, `user_id`) VALUES
(24, 'Rio21', 'Yangon', 9123456789, '2025-05-05 22:04:11', 53);
INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`, `customer_phone`, `created_time`, `user_id`) VALUES
(26, 'Testing Account', 'No.123, Abc Road, Yangon', 9123456789, '2025-05-06 15:19:42', 63);

INSERT INTO `faq` (`faq_id`, `faq_question`, `faq_answer`, `created_time`, `answer_time`, `admin_id`, `customer_id`, `posted`) VALUES
(9, 'What\'s ExchangeHub4U?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates explicabo distinctio facilis necessitatibus repellat eveniet, pariatur, laboriosam culpa ipsam magnam hic? Repudiandae quasi rerum voluptate necessitatibus, accusamus autem et illum.', '2025-04-03 02:20:27', '2025-05-06 12:10:31', 1, NULL, 1);
INSERT INTO `faq` (`faq_id`, `faq_question`, `faq_answer`, `created_time`, `answer_time`, `admin_id`, `customer_id`, `posted`) VALUES
(11, 'Delivery ', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est expedita hic quasi velit cum dolorem quod ipsam unde in dignissimos reprehenderit nesciunt, laboriosam quis saepe tempore nam! Autem, dolor voluptas?', '2025-05-06 12:17:17', '2025-05-06 12:17:17', 1, NULL, 1);
INSERT INTO `faq` (`faq_id`, `faq_question`, `faq_answer`, `created_time`, `answer_time`, `admin_id`, `customer_id`, `posted`) VALUES
(12, 'Refund Policy', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est expedita hic quasi velit cum dolorem quod ipsam unde in dignissimos reprehenderit nesciunt, laboriosam quis saepe tempore nam! Autem, dolor voluptas?', '2025-05-06 12:19:37', '2025-05-06 12:19:37', 1, NULL, 1);

INSERT INTO `order` (`order_id`, `order_date`, `shipping_address`, `delivered`, `delivery_name`, `phone_no`, `customer_id`) VALUES
(15, '2025-05-06 00:50:09', 'sanchaung No123, Abc Road Yangon', 1, 'Sylvie ', 9123456789, 23);


INSERT INTO `order_product` (`order_product_id`, `order_product_quantity`, `order_id`, `product_id`) VALUES
(26, 1, 15, 16);
INSERT INTO `order_product` (`order_product_id`, `order_product_quantity`, `order_id`, `product_id`) VALUES
(27, 2, 15, 15);


INSERT INTO `payment` (`payment_id`, `payment_time`, `total_amount`, `payment_type_id`, `customer_id`, `order_id`, `transaction_no`) VALUES
(14, '2025-05-06 00:50:09', 322000, 1, 23, 15, '12312321321');


INSERT INTO `payment_type` (`payment_type_id`, `payment_type`, `payment_type_description`) VALUES
(1, 'Bank Transfer', 'Trasfer Via Bank ');
INSERT INTO `payment_type` (`payment_type_id`, `payment_type`, `payment_type_description`) VALUES
(2, 'Cash On Delivery', 'Payment on the day of recieving Delivery');


INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_description`, `product_quantity`, `product_add_date`, `category_id`, `product_img`, `product_rating`, `brand_id`) VALUES
(1, 'ASUS TUF Gaming A17 (2023)', 4938700, '-Windows 11 Home\r\n-Up to GeForce RTX™ 4070 Laptop GPU\r\n-AMD Ryzen™ 7040 Series Processor\r\n-90W battery\r\n-Type C Fast Charging\r\n-84 blades Arc-Flow Fans & 4 exhaust vents\r\n-Mux Switch with NVIDIA Advanced Optimus\r\n-MIL-STD-810H Standards', 3, '2025-04-01 02:30:10', 1, 'laptop.jpg', 5, 1);
INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_description`, `product_quantity`, `product_add_date`, `category_id`, `product_img`, `product_rating`, `brand_id`) VALUES
(2, 'iPhone 16 Pro', 4454000, '- Apple A18 (3 nm)\r\n- 512GB 8GB RAM\r\n- Super Retina XDR OLED, HDR10, Dolby Vision, 1000 nits (typ), 2000 nits (HBM)\r\n- 170 g (6.00 oz)\r\n- 48 MP, f/1.6, 26mm (wide), 1/1.56\", 1.0µm, dual pixel PDAF, sensor-shift OIS\r\n12 MP, f/2.2, 13mm, 120˚ (ultrawide), 0.7µm, dual pixel PDAF\r\n- Li-Ion 3561 mAh', 5, '2025-04-01 02:30:10', 2, 'iphone.jpg', 5, 2);
INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_description`, `product_quantity`, `product_add_date`, `category_id`, `product_img`, `product_rating`, `brand_id`) VALUES
(10, 'Samsung Z Flip', 6000000, '-Unfolded: 165.1 x 71.9 x 6.9 mm \r\n-187 g (6.60 oz)\r\n-128GB 12GB RAM, 256GB 12GB RAM, 512GB 12GB RAM\r\n', 3, '2025-05-02 14:24:41', 2, '68147339722bd3.26714450.jpeg', NULL, 6);
INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_description`, `product_quantity`, `product_add_date`, `category_id`, `product_img`, `product_rating`, `brand_id`) VALUES
(11, 'Simplus Air Fryer', 150000, '1. Simplus Exclusive Design, Round and Smooth Outlines\r\n2. Visual Cooking Window, Top-mounted Holographic LCD Touch Screen\r\n3. 5L Large Capacity\r\n4. 1450W High Power\r\n5. 360° Hot Air Circulation\r\n6. NTC Precise Electronic Temperature Control\r\n5. Adjustable Temperature 80-200 ℃; Adjustable Time 0-60 Minutes\r\n6. Imported Teflon Non-stick Coating\r\n7. Upgraded Cooling System', 8, '2025-05-02 14:48:21', 7, '681478c5cae0d3.80500897.jpg', NULL, 7),
(12, 'Simplus Electric Pot', 100000, 'Capacity 1.5 liters\r\nElectrical power 600 watts\r\nFunctions: steamed, boiled, simmered, stir-fried, fried, hot pot sukiyaki\r\n2 cooking programs\r\nThe inner pot is coated with ceramic.', 9, '2025-05-02 14:50:15', 7, '681479379c7a52.30711323.jpg', NULL, 7),
(13, 'Adidas Samba OG', 500000, 'From soccer field to everyday staple, the Samba’s low-profile design, gum sole, and premium details seamlessly blend iconic sports heritage with effortless style.', 6, '2025-05-05 20:01:09', 3, '6818b7f2918c90.12549513.jpg', NULL, 12),
(14, 'Air Jordan 1 Low SE', 800000, 'Step into greatness with the AJ1. This special edition is made from quality leather, infused with comfortable Nike Air cushioning and decked out with signature Jordan details—just check out that embroidered Wings logo.', 6, '2025-05-05 20:02:40', 3, '6818b7fb3b7626.56057111.jpg', NULL, 10),
(15, 'COSRX Advanced Snail 92 All in One Cream', 120000, 'Type: Jar\r\nSize: 100 ml\r\n• Nourishes & plumps\r\n• Anti-aging\r\n• Repairs damaged skin\r\n• Long lasting hydration', 4, '2025-05-05 21:26:32', 11, '6818ca98e04376.52337578.jpg', NULL, 14),
(16, 'Centella Ampoule', 80000, '- SKIN1004\'s signature ampoule offers hydrating, anti-inflammatory, barrier strengthening, soothing and antioxidant properties\r\n- Madagascan Centella asiatica contains 7 times more soothing actives than other centella asiatica\r\n- Immediately calms and hydrates sensitive skin', 2, '2025-05-05 21:28:47', 11, '6818cb1f8af9a2.06670273.jpg', NULL, 15),
(17, 'Mario Kart™ – Mario & Standard Kart', 850000, 'H: 9\" (22cm)\r\nDimensions: W: 8\" (19cm)\r\nW: 8\" (19cm)\r\nDimensions: D: 13\" (32cm)\r\nD: 13\" (32cm)\r\n1972 Pieces', 2, '2025-05-05 21:31:15', 10, '6818cbb398a094.39803236.jpg', NULL, 13),
(18, 'Razer BlackWidow V4 Pro 75', 1100000, 'Compatible with 3 or 5-pin switches, the keyboard’s socketed PCB allows you to easily swap out its pre-loaded switches for custom ones to achieve your desired key feel.', 3, '2025-05-05 21:34:17', 8, '6818cf52bb7d51.88158012.jpg', NULL, 8),
(19, 'Gym bag', 60000, 'Unisex 29L Gym/Duffle Bag With Adjustable Shoulder Strap, Black | DB8', 1, '2025-05-05 21:37:40', 9, '6818cd344a5a17.66234834.jpg', NULL, 16),
(20, 'Fantech GROOVE', 80000, 'DUAL MODE GAMING SPEAKER\r\n2\" Tuned Driver\r\n6 W Speakers\r\nRGB Lighting\r\nDual Mode (BT & 3.5mm)', 2, '2025-05-05 21:39:58', 8, '6818cdbe9e8266.12579379.jpg', NULL, 9),
(21, 'Alienware 16 Area-51 Gaming Laptop', 12000000, 'Intel® Core™ Ultra 9 275HX, 24 cores\r\nWindows 11 Home\r\nNVIDIA® GeForce RTX™ 5070 Ti\r\n32 GB DDR5\r\n2 TB SSD\r\n16\" QHD+', 2, '2025-05-05 21:42:10', 1, '6818ce425e0a72.02296840.png', NULL, 5);

INSERT INTO `shoppingcart` (`shoppingcart_id`, `customer_id`) VALUES
(6, 23);
INSERT INTO `shoppingcart` (`shoppingcart_id`, `customer_id`) VALUES
(5, 24);


INSERT INTO `shoppingcart_product` (`shoppingcart_product_id`, `quantity`, `shoppingcart_id`, `product_id`) VALUES
(43, 1, 5, 1);


INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `user_type`) VALUES
(1, 'ExchangeHub4U', 'exchangehub4u@gmail.com', '$2y$10$gRc0ifwVd4KPzcdM3TXPKe3BiB7W2jthjqkFMbkpVSgHhZu.Q7.oa', 0);
INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `user_type`) VALUES
(51, 'Wai', 'wyl123@gmail.com', '$2y$10$sgi2s1Z3qoBhAJpnb/OI4On1qbkgNrlQouS35HD99Z8V4AUFdwN3u', 0);
INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `user_type`) VALUES
(52, 'Sylvie', 'sylvie123@gmail.com', '$2y$10$PAk1rEN46iv0lhaVDDESCeZQqlxcNTNNR6AYUovbO96yR3ohmPiPi', 1);
INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `user_type`) VALUES
(53, 'Rio', 'rio123@gmail.com', '$2y$10$iIR6UfHCMFg5IN/61evfGOI9cfZ5I/19Gw94twGnBGYIJCmWHH1Be', 1),
(54, 'Stella', 'stella123@gmail.com', '$2y$10$XkK5MohRKmzLSJRPJ7ZMMurSyw8HwXdTfhaNM0gjw9vllI5PngpBC', 1),
(55, 'Pai', 'pai123@gmail.com', '$2y$10$O7FyQ590h/GQ2JEag7dWLuMb8tUxLAo5CfqqF8qyxJ1bZgtwILYpC', 1),
(56, 'Alice', 'alice123@gmail.com', '$2y$10$NehKl/4K24vzBV4q0Q3Jsed5TEZ96hezMmAw8kl6glZ.jvJtH8.s6', 1),
(57, 'Saw', 'saw123@gmail.com', '$2y$10$eD4RShR1zF3ETDBg2EzXNu63wwvI7RJpSxJ0sJwWvxq1RHEjMXh72', 1),
(58, 'Aung', 'aung123@gmail.com', '$2y$10$/MXWF42jCmJhVRYyufoYO.gDIgdJFLTdoMLfEQo7N1OwIHNKXTEq6', 1),
(59, 'Myat', 'myat123@gmail.com', '$2y$10$x9DavtYx0ZvCGnITxh.E5O1FbrshsipPAzexGoWmrx2AE.ro7sJxK', 1),
(62, 'Testing', 'test12345@gmail.com', '$2y$10$V2HgoxhNaQxA5RcM0cekQ.PcTq.kpzhOH6YrP71ABpQKm3TFs6jlO', 1),
(63, 'Test Account', 'test@gmail.com', '$2y$10$stCdo.H5CpnzvhDXxdjti.OOI8UkwNrkeTGhu9S5UHYyhH.mcyDJG', 1);

INSERT INTO `wishlist` (`wishlist_id`, `customer_id`) VALUES
(9, 24);


INSERT INTO `wishlist_product` (`wishlist_product_id`, `product_id`, `wishlist_id`) VALUES
(20, 20, 9);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;