-- Add New Categories
INSERT INTO `Categories` (`name`) VALUES
('Beauty & Personal Care'),
('Sports & Outdoors'),
('Toys & Games'),
('Groceries'),
('Automotive'),
('Pet Supplies');

-- Add New Products Across Categories
INSERT INTO `Products` (`name`, `description`, `price`, `image`, `category_id`) VALUES
-- Electronics (category_id = 1)
('Wireless Gaming Mouse', 'RGB 16000DPI gaming mouse', 2500.00, 'gaming_mouse.jpg', 1),
('Bluetooth Speaker', 'Portable 20W waterproof speaker', 3500.00, 'bluetooth_speaker.jpg', 1),
('DSLR Camera', '24MP 4K video camera', 85000.00, 'dslr_camera.jpg', 1),

-- Clothing (category_id = 2)
('Leather Jacket', 'Premium genuine leather jacket', 8500.00, 'leather_jacket.jpg', 2),
('Winter Scarf', 'Woolen knit winter scarf', 650.00, 'winter_scarf.jpg', 2),
('Formal Trousers', 'Office wear slim-fit trousers', 2200.00, 'formal_trousers.jpg', 2),

-- Beauty & Personal Care (category_id = 5)
('Men\'s Shaving Kit', '5-blade razor with shaving cream', 1200.00, 'shaving_kit.jpg', 5),
('Perfume Set', '3pc luxury fragrance collection', 4500.00, 'perfume_set.jpg', 5),
('Hair Dryer', '2000W ionic hair dryer', 2800.00, 'hair_dryer.jpg', 5),

-- Sports & Outdoors (category_id = 6)
('Yoga Mat', 'Eco-friendly 6mm thick mat', 1500.00, 'yoga_mat.jpg', 6),
('Camping Tent', '4-person waterproof tent', 9500.00, 'camping_tent.jpg', 6),
('Cycling Helmet', 'Ventilated bike helmet', 2200.00, 'cycling_helmet.jpg', 6),

-- Groceries (category_id = 7)
('Extra Virgin Olive Oil', '1L cold-pressed olive oil', 1200.00, 'olive_oil.jpg', 7),
('Organic Honey', 'Pure 500g natural honey', 850.00, 'organic_honey.jpg', 7),
('Basmati Rice', '5kg premium quality rice', 950.00, 'basmati_rice.jpg', 7),

-- Automotive (category_id = 8)
('Car Vacuum Cleaner', '12V portable car vacuum', 2500.00, 'car_vacuum.jpg', 8),
('Jump Starter', '2000A peak car jump starter', 12500.00, 'jump_starter.jpg', 8),
('Car Seat Covers', 'Universal fit neoprene covers', 4500.00, 'seat_covers.jpg', 8),

-- Pet Supplies (category_id = 9)
('Cat Tree House', 'Multi-level cat condo', 7500.00, 'cat_tree.jpg', 9),
('Dog Leash', 'Retractable 5m dog leash', 1500.00, 'dog_leash.jpg', 9),
('Aquarium Kit', '20L complete fish tank set', 6500.00, 'aquarium_kit.jpg', 9);