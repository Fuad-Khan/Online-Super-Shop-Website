-- Add New Categories if needed
INSERT IGNORE INTO Categories (name) VALUES
('Dairy & Eggs'),
('Bakery'),
('Fruits'),
('Vegetables'),
('Beverages'),
('Personal Care'),
('Household Supplies'),
('Snacks'),
('Baby Care');

-- Add Products with Category Mapping
INSERT INTO Products (name, description, price, image, category_id) VALUES
('Fresh Strawberries', 'Premium quality fresh strawberries', 450.00, '1280px-Strawberries.jpg', 
 (SELECT category_id FROM Categories WHERE name='Fruits')),
 
('Thai Pineapple', 'Sweet imported pineapple', 300.00, '14552307-pineapple-is-a-fruit-for-export-of-thailand.jpg', 
 (SELECT category_id FROM Categories WHERE name='Fruits')),
 
('Red Apples', 'Crispy fresh apples', 250.00, 'apples.jpg', 
 (SELECT category_id FROM Categories WHERE name='Fruits')),
 
('Banana Bunch', 'Ripe yellow bananas', 150.00, 'bananas.jpg', 
 (SELECT category_id FROM Categories WHERE name='Fruits')),
 
('Electric Blender', '500W kitchen blender', 3499.00, 'Blender.png', 
 (SELECT category_id FROM Categories WHERE name='Home & Kitchen')),
 
('Fresh Bread', 'Whole wheat bread loaf', 85.00, 'bread.jpg', 
 (SELECT category_id FROM Categories WHERE name='Bakery')),
 
('Butter 500g', 'Pure dairy butter', 550.00, 'butter.jpg', 
 (SELECT category_id FROM Categories WHERE name='Dairy & Eggs')),
 
('Dairy Milk Chocolate', '200g milk chocolate bar', 220.00, 'CadburyDairyMilk.jpg', 
 (SELECT category_id FROM Categories WHERE name='Snacks')),
 
('Cheddar Cheese', '200g block cheese', 450.00, 'cheddar_cheese.jpg', 
 (SELECT category_id FROM Categories WHERE name='Dairy & Eggs')),
 
('Coffee Maker', '4-cup drip coffee machine', 2999.00, 'coffee-maker.jpg', 
 (SELECT category_id FROM Categories WHERE name='Home & Kitchen')),
 
('Dove Shampoo', '600ml hair shampoo', 650.00, 'Dove_shampoo.jpg', 
 (SELECT category_id FROM Categories WHERE name='Personal Care')),
 
('Fresh Eggs', '10pc farm eggs', 150.00, 'eggs.jpg', 
 (SELECT category_id FROM Categories WHERE name='Dairy & Eggs')),
 
('Floor Cleaner', '1L floor cleaning liquid', 350.00, 'floor_deaner.jpeg', 
 (SELECT category_id FROM Categories WHERE name='Household Supplies')),
 
('Glass Cleaner', '500ml spray cleaner', 280.00, 'glass_deaner.jpg', 
 (SELECT category_id FROM Categories WHERE name='Household Supplies')),
 
('Denim Jeans', 'Regular fit blue jeans', 2299.00, 'jeans.jpg', 
 (SELECT category_id FROM Categories WHERE name='Clothing')),
 
('Laptop', 'Core i5 11th Gen laptop', 89999.00, 'laptop.jpg', 
 (SELECT category_id FROM Categories WHERE name='Electronics')),
 
('Fresh Mangoes', 'Seasonal ripe mangoes', 400.00, 'mangoes.jpg', 
 (SELECT category_id FROM Categories WHERE name='Fruits')),
 
('Fresh Milk', '1L pasteurized milk', 100.00, 'milk.jpg', 
 (SELECT category_id FROM Categories WHERE name='Dairy & Eggs')),
 
('Olive Oil', 'Extra virgin 500ml', 1200.00, 'olive_oil.jpg', 
 (SELECT category_id FROM Categories WHERE name='Groceries')),
 
('Orange Juice', '1L fresh juice', 180.00, 'orange_juice.jpg', 
 (SELECT category_id FROM Categories WHERE name='Beverages')),
 
('Pampers Diapers', 'Size 5 baby diapers', 1440.00, 'Pampers-Baby-Dry-5-Nappy-Pants-3-44.jpg', 
 (SELECT category_id FROM Categories WHERE name='Baby Care')),
 
('Potato Crackers', '200g salted snacks', 120.00, 'potato-crackers.jpg', 
 (SELECT category_id FROM Categories WHERE name='Snacks')),
 
('Premium Rice', '5kg basmati rice', 950.00, 'rice.jpg', 
 (SELECT category_id FROM Categories WHERE name='Groceries')),
 
('Fresh Carrots', '500g organic carrots', 80.00, 'skynews-carrots-stock_6750668.jpg', 
 (SELECT category_id FROM Categories WHERE name='Vegetables')),
 
('Smartphone', '6.5" AMOLED display', 34999.00, 'smartphone.jpg', 
 (SELECT category_id FROM Categories WHERE name='Electronics')),
 
('Toothpaste Pack', '3x100g toothpaste', 300.00, 'Toothpastes.jpg', 
 (SELECT category_id FROM Categories WHERE name='Personal Care')),
 
('Cotton T-Shirt', 'Premium quality crew neck', 799.00, 'tshirt.jpg', 
 (SELECT category_id FROM Categories WHERE name='Clothing'));