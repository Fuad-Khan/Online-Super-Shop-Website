-- Sample Data
INSERT INTO `Users` (`name`, `email`, `password`, `role`) VALUES
('Admin User', 'admin@example.com', '$2y$10$ExampleHashForAdmin', 'admin'),
('Regular User', 'user@example.com', '$2y$10$ExampleHashForUser', 'user');

INSERT INTO `Categories` (`name`) VALUES
('Electronics'),
('Clothing'),
('Books'),
('Home & Kitchen');

INSERT INTO `Products` (`name`, `description`, `price`, `image`, `category_id`) VALUES
('Smartphone', 'Latest model smartphone', 29999.99, 'phone.jpg', 1),
('Laptop', 'High performance laptop', 89999.99, 'laptop.jpg', 1),
('T-Shirt', 'Cotton crew-neck t-shirt', 799.99, 'tshirt.jpg', 2),
('Cookbook', 'Best selling recipe book', 499.99, 'cookbook.jpg', 3);

-- Sample Cart Entry
INSERT INTO `Cart` (`user_id`, `product_id`, `quantity`) VALUES
(2, 1, 2),
(2, 3, 1);