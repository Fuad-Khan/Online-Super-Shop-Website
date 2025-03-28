-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2025 at 07:44 PM
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
-- Database: `online_super_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(1, 2, 1, 2),
(2, 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`category_id`, `name`) VALUES
(1, 'Electronics'),
(2, 'Clothing'),
(3, 'Books'),
(4, 'Home & Kitchen'),
(5, 'Beauty & Personal Care'),
(6, 'Sports & Outdoors'),
(7, 'Toys & Games'),
(8, 'Groceries'),
(9, 'Automotive'),
(10, 'Pet Supplies'),
(11, 'Dairy & Eggs'),
(12, 'Bakery'),
(13, 'Fruits'),
(14, 'Vegetables'),
(15, 'Beverages'),
(16, 'Personal Care'),
(17, 'Household Supplies'),
(18, 'Snacks'),
(19, 'Baby Care');

-- --------------------------------------------------------

--
-- Table structure for table `OrderItems`
--

CREATE TABLE `OrderItems` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `OrderItems`
--

INSERT INTO `OrderItems` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 3, 2, 799.99),
(2, 1, 1, 1, 29999.99),
(3, 2, 2, 4, 89999.99),
(4, 2, 4, 1, 499.99),
(5, 2, 3, 1, 799.99),
(6, 3, 33, 2, 220.00),
(7, 4, 41, 1, 89999.00),
(8, 5, 13, 1, 2800.00),
(9, 5, 6, 2, 3500.00),
(10, 5, 33, 1, 220.00),
(11, 5, 28, 1, 250.00),
(12, 5, 50, 1, 34999.00);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered') DEFAULT 'pending',
  `shipping_address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`order_id`, `user_id`, `total_price`, `status`, `shipping_address`, `created_at`) VALUES
(1, 3, 31599.97, 'pending', 'dhaka', '2025-02-23 20:03:48'),
(2, 3, 361299.94, 'pending', 'dhaka', '2025-02-23 20:05:58'),
(3, 3, 440.00, 'pending', 'dhaka', '2025-03-13 15:14:18'),
(4, 3, 89999.00, 'pending', 'dhaka', '2025-03-13 15:14:36'),
(5, 4, 45269.00, 'pending', 'ggg', '2025-03-28 10:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`product_id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
(1, 'Smartphone', 'Latest model smartphone', 29999.99, 'phone.jpg', 1),
(2, 'Laptop', 'High performance laptop', 89999.99, 'laptop.jpg', 1),
(3, 'T-Shirt', 'Cotton crew-neck t-shirt', 799.99, 'tshirt.jpg', 2),
(4, 'Cookbook', 'Best selling recipe book', 499.99, 'cookbook.jpg', 3),
(5, 'Wireless Gaming Mouse', 'RGB 16000DPI gaming mouse', 2500.00, 'gaming_mouse.jpg', 1),
(6, 'Bluetooth Speaker', 'Portable 20W waterproof speaker', 3500.00, 'bluetooth_speaker.jpg', 1),
(7, 'DSLR Camera', '24MP 4K video camera', 85000.00, 'dslr_camera.jpg', 1),
(8, 'Leather Jacket', 'Premium genuine leather jacket', 8500.00, 'leather_jacket.jpg', 2),
(9, 'Winter Scarf', 'Woolen knit winter scarf', 650.00, 'winter_scarf.jpg', 2),
(10, 'Formal Trousers', 'Office wear slim-fit trousers', 2200.00, 'formal_trousers.jpg', 2),
(11, 'Men\'s Shaving Kit', '5-blade razor with shaving cream', 1200.00, 'shaving_kit.jpg', 5),
(12, 'Perfume Set', '3pc luxury fragrance collection', 4500.00, 'perfume_set.jpg', 5),
(13, 'Hair Dryer', '2000W ionic hair dryer', 2800.00, 'hair_dryer.jpg', 5),
(14, 'Yoga Mat', 'Eco-friendly 6mm thick mat', 1500.00, 'yoga_mat.jpg', 6),
(15, 'Camping Tent', '4-person waterproof tent', 9500.00, 'camping_tent.jpg', 6),
(16, 'Cycling Helmet', 'Ventilated bike helmet', 2200.00, 'cycling_helmet.jpg', 6),
(17, 'Extra Virgin Olive Oil', '1L cold-pressed olive oil', 1200.00, 'olive_oil.jpg', 8),
(18, 'Organic Honey', 'Pure 500g natural honey', 850.00, 'organic_honey.jpg', 8),
(19, 'Basmati Rice', '5kg premium quality rice', 950.00, 'basmati_rice.jpg', 8),
(20, 'Car Vacuum Cleaner', '12V portable car vacuum', 2500.00, 'car_vacuum.jpg', 9),
(21, 'Jump Starter', '2000A peak car jump starter', 12500.00, 'jump_starter.jpg', 9),
(22, 'Car Seat Covers', 'Universal fit neoprene covers', 4500.00, 'seat_covers.jpg', 9),
(23, 'Cat Tree House', 'Multi-level cat condo', 7500.00, 'cat_tree.jpg', 10),
(24, 'Dog Leash', 'Retractable 5m dog leash', 1500.00, 'dog_leash.jpg', 10),
(25, 'Aquarium Kit', '20L complete fish tank set', 6500.00, 'aquarium_kit.jpg', 10),
(26, 'Fresh Strawberries', 'Premium quality fresh strawberries', 450.00, '1280px-Strawberries.jpg', 13),
(27, 'Thai Pineapple', 'Sweet imported pineapple', 300.00, '14552307-pineapple-is-a-fruit-for-export-of-thailand.jpg', 13),
(28, 'Red Apples', 'Crispy fresh apples', 250.00, 'apples.jpg', 13),
(29, 'Banana Bunch', 'Ripe yellow bananas', 150.00, 'bananas.jpg', 13),
(30, 'Electric Blender', '500W kitchen blender', 3499.00, 'Blender.png', 4),
(31, 'Fresh Bread', 'Whole wheat bread loaf', 85.00, 'bread.jpg', 12),
(32, 'Butter 500g', 'Pure dairy butter', 550.00, 'butter.jpg', 11),
(33, 'Dairy Milk Chocolate', '200g milk chocolate bar', 220.00, 'CadburyDairyMilk.jpg', 18),
(34, 'Cheddar Cheese', '200g block cheese', 450.00, 'cheddar_cheese.jpg', 11),
(35, 'Coffee Maker', '4-cup drip coffee machine', 2999.00, 'coffee-maker.jpg', 4),
(36, 'Dove Shampoo', '600ml hair shampoo', 650.00, 'Dove_shampoo.jpg', 16),
(37, 'Fresh Eggs', '10pc farm eggs', 150.00, 'eggs.jpg', 11),
(38, 'Floor Cleaner', '1L floor cleaning liquid', 350.00, 'floor_cleaner.jpeg', 17),
(39, 'Glass Cleaner', '500ml spray cleaner', 280.00, 'glass_cleaner.jpg', 17),
(40, 'Denim Jeans', 'Regular fit blue jeans', 2299.00, 'jeans.jpg', 2),
(41, 'Laptop', 'Core i5 11th Gen laptop', 89999.00, 'laptop.jpg', 1),
(42, 'Fresh Mangoes', 'Seasonal ripe mangoes', 400.00, 'mangoes.jpg', 13),
(43, 'Fresh Milk', '1L pasteurized milk', 100.00, 'milk.jpg', 11),
(44, 'Olive Oil', 'Extra virgin 500ml', 1200.00, 'olive_oil.jpg', 8),
(45, 'Orange Juice', '1L fresh juice', 180.00, 'orange_juice.jpg', 15),
(46, 'Pampers Diapers', 'Size 5 baby diapers', 1440.00, 'Pampers-Baby-Dry-5-Nappy-Pants-3-44.jpeg', 19),
(47, 'Potato Crackers', '200g salted snacks', 120.00, 'potato-crackers.jpg', 18),
(48, 'Premium Rice', '5kg basmati rice', 950.00, 'rice.jpg', 8),
(49, 'Fresh Carrots', '500g organic carrots', 80.00, 'skynews-carrots-stock_6750668.jpg', 14),
(50, 'Smartphone', '6.5\" AMOLED display', 34999.00, 'smartphone.jpg', 1),
(51, 'Toothpaste Pack', '3x100g toothpaste', 300.00, 'Toothpastes.jpg', 16),
(52, 'Cotton T-Shirt', 'Premium quality crew neck', 799.00, 'tshirt.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE `Reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`review_id`, `user_id`, `product_id`, `rating`, `review_text`, `created_at`) VALUES
(1, 3, 3, 1, 'lllllllll', '2025-02-23 20:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `name`, `email`, `password`, `address`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$10$ExampleHashForAdmin', NULL, 'admin', '2025-02-23 19:46:42'),
(2, 'Regular User', 'user@example.com', '$2y$10$ExampleHashForUser', NULL, 'user', '2025-02-23 19:46:42'),
(3, 'MK', 'khan35-883@diu.edu.bd', '$2y$10$Mc2Knc5UG2kvm20G5hAlYOnaLZN1d2Lq/40zzXl4s.DSCV49VS09W', 'dhaka', 'user', '2025-02-23 20:01:30'),
(4, 'mm', 'fuadkhan183@gmail.com', '$2y$10$ztIk5CWw30DEngYomBlWu.bYng8A48z.yVGfxV0bC2M/ZnUrut5DO', 'ggg', 'user', '2025-03-01 11:48:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `OrderItems`
--
ALTER TABLE `OrderItems`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Products` (`product_id`);

--
-- Constraints for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD CONSTRAINT `OrderItems_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`),
  ADD CONSTRAINT `OrderItems_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Products` (`product_id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `Products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `Categories` (`category_id`);

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `Reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
