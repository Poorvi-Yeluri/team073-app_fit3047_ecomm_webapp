-- Insert data for the 'users' table (using SHA256 for password)
INSERT INTO users (first_name, last_name, email, password, phone)
VALUES ('Olivia', 'Wilson', 'olivia.wilson@example.com', SHA2('password', 256), '0412 345 678'),
       ('William', 'Taylor', 'william.taylor@example.com', SHA2('Secure2!', 256), '0423 456 789'),
       ('Isabella', 'Clark', 'isabella.clark@example.com', SHA2('MyP@ss!', 256), '0434 567 890'),
       ('James', 'Lewis', 'james.lewis@example.com', SHA2('N3wP@$$', 256), '0445 678 901'),
       ('Sophia', 'Hall', 'sophia.hall@example.com', SHA2('P@$$word9', 256), '0456 789 012'),
       ('Benjamin', 'Young', 'benjamin.young@example.com', SHA2('S0m3P@$$', 256), '0467 890 123'),
       ('Mia', 'Wright', 'mia.wright@example.com', SHA2('P@$$wOrd0', 256), '0478 901 234'),
       ('Elijah', 'King', 'elijah.king@example.com', SHA2('V@ryS3cure', 256), '0489 012 345'),
       ('Charlotte', 'Scott', 'charlotte.scott@example.com', SHA2('P@$$wOrdA', 256), '0490 123 456'),
       ('Daniel', 'Green', 'daniel.green@example.com', SHA2('T0ughP@$$', 256), '0401 234 567'),
       ('Amelia', 'Adams', 'amelia.adams@example.com', SHA2('AnotherP@$$', 256), '0411 223 344'),
       ('Joseph', 'Baker', 'joseph.baker@example.com', SHA2('P@$$wOrdB', 256), '0422 334 455'),
       ('Harper', 'Hill', 'harper.hill@example.com', SHA2('M@yTh1sW0rk', 256), '0433 445 566'),
       ('Samuel', 'Ross', 'samuel.ross@example.com', SHA2('P@$$wOrdC', 256), '0444 556 677'),
       ('Abigail', 'Gray', 'abigail.gray@example.com', SHA2('Wh@t1sTh1s', 256), '0455 667 788'),
       ('Matthew', 'Foster', 'matthew.foster@example.com', SHA2('P@$$wOrdD', 256), '0466 778 899'),
       ('Emily', 'Ellis', 'emily.ellis@example.com', SHA2('Th3P@$$w0rd', 256), '0477 889 900'),
       ('David', 'Stewart', 'david.stewart@example.com', SHA2('P@$$wOrdE', 256), '0488 990 011'),
       ('Elizabeth', 'Sullivan', 'elizabeth.sullivan@example.com', SHA2('Y3tAnother', 256), '0499 001 122'),
       ('Andrew', 'Murphy', 'andrew.murphy@example.com', SHA2('P@$$wOrdF', 256), '0400 112 233'),
       ('Chloe', 'Rivera', 'chloe.rivera@example.com', SHA2('S0m3th1ngN3w', 256), '0410 223 344'),
       ('Owen', 'Cook', 'owen.cook@example.com', SHA2('P@$$wOrdG', 256), '0420 334 455'),
       ('Grace', 'Rogers', 'grace.rogers@example.com', SHA2('Th1s1s1t', 256), '0430 445 566'),
       ('Jackson', 'Price', 'jackson.price@example.com', SHA2('P@$$wOrdH', 256), '0440 556 677'),
       ('Lily', 'Reed', 'lily.reed@example.com', SHA2('N@m3dP@$$', 256), '0450 667 788'),
       ('Aiden', 'Sanders', 'aiden.sanders@example.com', SHA2('P@$$wOrdI', 256), '0460 778 899'),
       ('Ella', 'Bailey', 'ella.bailey@example.com', SHA2('F1n@lP@$$', 256), '0470 889 900'),
       ('Caleb', 'Powell', 'caleb.powell@example.com', SHA2('P@$$wOrdJ', 256), '0480 990 011'),
       ('Victoria', 'Jenkins', 'victoria.jenkins@example.com', SHA2('Th3Last0ne', 256), '0490 001 122'),
       ('Gabriel', 'Perry', 'gabriel.perry@example.com', SHA2('P@$$wOrdK', 256), '0401 112 233'),
       ('Natalie', 'Long', 'natalie.long@example.com', SHA2('M@yb3Th1s', 256), '0411 223 344'),
       ('Isaac', 'Cox', 'isaac.cox@example.com', SHA2('P@$$wOrdL', 256), '0421 334 455');

-- Insert data for the 'products' table with specified categories
INSERT INTO products (name, description, category, base_price, stock_quantity, image_url)
VALUES ('Elegant Glass Vase', 'A tall and elegant glass vase for displaying flowers.', 'home-decor', 49.99, 100,
        'https://picsum.photos/id/10/200/300'),
       ('Modern Ceramic Vase', 'A contemporary ceramic vase with a unique design.', 'home-decor', 39.99, 150,
        'https://picsum.photos/id/11/200/300'),
       ('Sculpted Metal Vase', 'A hand-sculpted metal vase, a true piece of art.', 'home-decor', 79.99, 50,
        'https://picsum.photos/id/12/200/300'),
       ('Wooden Photo Frame', 'A rustic wooden frame to showcase your memories.', 'home-decor', 19.99, 250,
        'https://picsum.photos/id/14/200/300'),
       ('Decorative Throw Pillow', 'A soft and decorative throw pillow to enhance your sofa.', 'home-decor', 29.99, 160,
        'https://picsum.photos/id/20/200/300'),
       ('Scented Candle', 'A relaxing scented candle to create a calming ambiance.', 'home-decor', 14.99, 190,
        'https://picsum.photos/id/24/200/300'),
       ('Artificial Plant', 'A lifelike artificial plant to add greenery to your space.', 'home-decor', 34.99, 130,
        'https://picsum.photos/id/28/200/300'),
       ('Wall Clock', 'A stylish wall clock to keep track of time.', 'home-decor', 39.99, 90,
        'https://picsum.photos/id/32/200/300'),
       ('Picture Frame Set', 'A set of assorted picture frames to display your photos.', 'home-decor', 59.99, 70,
        'https://picsum.photos/id/36/200/300'),
       ('Floor Lamp', 'A modern floor lamp to illuminate your living space.', 'home-decor', 89.99, 50,
        'https://picsum.photos/id/40/200/300'),
       ('Silk Scarf Collection', 'A beautiful collection of silk scarves in various patterns.', 'gifts', 29.99, 200,
        'https://picsum.photos/id/13/200/300'),
       ('Leather Wallet', 'A classic leather wallet with multiple compartments.', 'gifts', 59.99, 120,
        'https://picsum.photos/id/16/200/300'),
       ('Stainless Steel Water Bottle', 'A durable stainless steel water bottle to keep you hydrated.', 'gifts', 24.99,
        180, 'https://picsum.photos/id/17/200/300'),
       ('Canvas Tote Bag', 'A reusable canvas tote bag for shopping.', 'gifts', 12.99, 280,
        'https://picsum.photos/id/22/200/300'),
       ('Sunglasses', 'Stylish sunglasses to protect your eyes.', 'gifts', 79.99, 80,
        'https://picsum.photos/id/34/200/300'),
       ('Scarf', 'A soft and warm scarf for winter.', 'gifts', 29.99, 150, 'https://picsum.photos/id/38/200/300'),
       ('Belt', 'A classic leather belt to complete your outfit.', 'gifts', 39.99, 100,
        'https://picsum.photos/id/42/200/300'),
       ('Ceramic Coffee Mug', 'A simple and stylish ceramic coffee mug.', 'clearance', 9.99, 400,
        'https://picsum.photos/id/18/200/300'),
       ('Cotton T-Shirt', 'A comfortable cotton t-shirt for everyday wear.', 'clearance', 15.99, 300,
        'https://picsum.photos/id/15/200/300'),
       ('Winter Beanie Hat', 'A warm and cozy winter beanie hat.', 'clearance', 19.99, 220,
        'https://picsum.photos/id/21/200/300'),
       ('Running Shoes', 'Comfortable and supportive running shoes for athletes.', 'clearance', 99.99, 140,
        'https://picsum.photos/id/25/200/300'),
       ('Hoodie', 'A comfortable hoodie for casual wear.', 'clearance', 39.99, 120,
        'https://picsum.photos/id/37/200/300'),
       ('Sweater', 'A warm and cozy sweater for chilly days.', 'clearance', 49.99, 140,
        'https://picsum.photos/id/33/200/300'),
       ('Gold Plated Necklace', 'A delicate gold plated necklace with a pendant.', 'jewellery', 69.99, 80,
        'https://picsum.photos/id/44/200/300'),
       ('Silver Hoop Earrings', 'Classic silver hoop earrings, perfect for everyday wear.', 'jewellery', 39.99, 120,
        'https://picsum.photos/id/45/200/300'),
       ('Gemstone Bracelet', 'A beautiful bracelet adorned with colorful gemstones.', 'jewellery', 89.99, 60,
        'https://picsum.photos/id/46/200/300'),
       ('Pearl Stud Earrings', 'Elegant pearl stud earrings, a timeless piece.', 'jewellery', 59.99, 90,
        'https://picsum.photos/id/47/200/300'),
       ('Fashion Ring Set', 'A set of trendy fashion rings for different occasions.', 'jewellery', 29.99, 150,
        'https://picsum.photos/id/48/200/300'),
       ('Throw Blanket', 'A soft and cozy throw blanket for your living room.', 'home-decor', 45.99, 110,
        'https://picsum.photos/id/49/200/300'),
       ('Set of Coasters', 'A stylish set of coasters to protect your furniture.', 'home-decor', 19.99, 180,
        'https://picsum.photos/id/50/200/300'),
       ('Decorative Bowl', 'An artistic decorative bowl for displaying fruits or ornaments.', 'home-decor', 55.99, 75,
        'https://picsum.photos/id/51/200/300'),
       ('Tea Infuser Mug', 'A convenient mug with a built-in tea infuser.', 'gifts', 22.99, 160,
        'https://picsum.photos/id/52/200/300'),
       ('Notebook and Pen Set', 'A stylish notebook and pen set, perfect for gifting.', 'gifts', 35.99, 100,
        'https://picsum.photos/id/53/200/300'),
       ('Travel Mug', 'An insulated travel mug to keep your drinks hot or cold.', 'gifts', 28.99, 130,
        'https://picsum.photos/id/54/200/300'),
       ('Desk Organizer', 'A practical desk organizer to keep your workspace tidy.', 'gifts', 17.99, 200,
        'https://picsum.photos/id/55/200/300'),
       ('Oversized T-Shirt', 'A comfortable oversized t-shirt.', 'clearance', 25.99, 180,
        'https://picsum.photos/id/56/200/300'),
       ('Lightweight Jacket', 'A casual lightweight jacket.', 'clearance', 59.99, 90,
        'https://picsum.photos/id/57/200/300'),
       ('Basic Sweatpants', 'Comfortable basic sweatpants for lounging.', 'clearance', 30.99, 150,
        'https://picsum.photos/id/58/200/300'),
       ('Fashion Ring Set', 'Stylish set of rings for everyday wear.', 'accessories', 29.99, 150,
        'https://picsum.photos/id/101/200/300'),
       ('Throw Blanket', 'Soft and cozy throw blanket for any room.', 'home', 45.99, 120,
        'https://picsum.photos/id/102/200/300'),
       ('Set of Coasters', 'Durable and stylish coasters to protect your furniture.', 'home', 19.99, 180,
        'https://picsum.photos/id/103/200/300'),
       ('Decorative Bowl', 'Elegant bowl to accent your decor.', 'home', 55.99, 90,
        'https://picsum.photos/id/104/200/300'),
       ('Tea Infuser Mug', 'Modern mug with built-in tea infuser.', 'kitchen', 22.99, 160,
        'https://picsum.photos/id/105/200/300'),
       ('Notebook and Pen Set', 'Premium notebook with matching pen.', 'stationery', 35.99, 110,
        'https://picsum.photos/id/106/200/300'),
       ('Travel Mug', 'Insulated mug for hot and cold drinks on the go.', 'kitchen', 28.99, 135,
        'https://picsum.photos/id/107/200/300'),
       ('Desk Organizer', 'Keep your workspace tidy and efficient.', 'office', 17.99, 200,
        'https://picsum.photos/id/108/200/300'),
       ('Oversized T-Shirt', 'Comfortable oversized T-shirt with relaxed fit.', 'apparel', 25.99, 175,
        'https://picsum.photos/id/109/200/300'),
       ('Lightweight Jacket', 'Stylish and breathable jacket for layering.', 'apparel', 59.99, 100,
        'https://picsum.photos/id/110/200/300'),
       ('Alder Sweatpants', 'Comfortable alder sweatpants for lounge wear.', 'clearance', 30.99, 150,
        'https://picsum.photos/id/58/200/300');

-- Insert data for the 'product_variants' table (linking to the products above)
-- Variants for 'Elegant Glass Vase' (product_id: 1)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (1, 'Color', 'Clear', 49.99, 50, 'EGV-CLR'),
       (1, 'Color', 'Smoked', 54.99, 30, 'EGV-SMK'),
       (1, 'Size', 'Large', 49.99, 60, 'EGV-LRG'),
       (1, 'Size', 'Medium', 44.99, 40, 'EGV-MED');

-- Variants for 'Modern Ceramic Vase' (product_id: 2)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (2, 'Color', 'Matte Black', 39.99, 75, 'MCV-BLK'),
       (2, 'Color', 'Gloss White', 42.99, 65, 'MCV-WHT'),
       (2, 'Color', 'Gray', 41.99, 70, 'MCV-GRY');

-- Variants for 'Sculpted Metal Vase' (product_id: 3)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (3, 'Finish', 'Brushed Gold', 79.99, 25, 'SMV-GLD'),
       (3, 'Finish', 'Antique Silver', 84.99, 20, 'SMV-SLV');

-- Variants for 'Wooden Photo Frame' (product_id: 5)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (5, 'Size', '4x6', 19.99, 120, 'WPF-4X6'),
       (5, 'Size', '5x7', 22.99, 100, 'WPF-5X7'),
       (5, 'Color', 'Brown', 21.99, 110, 'WPF-BRN');

-- Variants for 'Decorative Throw Pillow' (product_id: 11)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (11, 'Color', 'Gray', 29.99, 80, 'DTP-GRY'),
       (11, 'Color', 'Beige', 31.99, 70, 'DTP-BEI'),
       (11, 'Size', 'Square', 30.99, 75, 'DTP-SQR');

-- Variants for 'Scented Candle' (product_id: 15)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (15, 'Scent', 'Lavender', 14.99, 95, 'SC-LAV'),
       (15, 'Scent', 'Vanilla', 15.99, 85, 'SC-VAN'),
       (15, 'Size', 'Small', 16.99, 80, 'SC-SML');

-- Variants for 'Wall Clock' (product_id: 23)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (23, 'Shape', 'Round', 39.99, 45, 'WC-RND'),
       (23, 'Color', 'Silver', 42.99, 40, 'WC-SIL');

-- Variants for 'Floor Lamp' (product_id: 31)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (31, 'Finish', 'Black', 89.99, 25, 'FL-BLK'),
       (31, 'Finish', 'Chrome', 94.99, 20, 'FL-CHR');

-- Variants for 'Silk Scarf Collection' (product_id: 4)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (4, 'Pattern', 'Floral', 29.99, 100, 'SSC-FLO'),
       (4, 'Pattern', 'Geometric', 32.99, 90, 'SSC-GEO'),
       (4, 'Pattern', 'Paisley', 31.99, 95, 'SSC-PAI');

-- Variants for 'Leather Wallet' (product_id: 7)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (7, 'Color', 'Black', 59.99, 40, 'LW-BLK'),
       (7, 'Color', 'Brown', 62.99, 35, 'LW-BRN');

-- Variants for 'Stainless Steel Water Bottle' (product_id: 8)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (8, 'Capacity', '500ml', 24.99, 90, 'SWB-500'),
       (8, 'Capacity', '750ml', 27.99, 80, 'SWB-750');

-- Variants for 'Canvas Tote Bag' (product_id: 13)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (13, 'Size', 'Large', 12.99, 140, 'CTB-LRG'),
       (13, 'Size', 'Small', 10.99, 160, 'CTB-SML');

-- Variants for 'Sunglasses' (product_id: 25)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (25, 'Style', 'Aviator', 79.99, 35, 'SG-AVI'),
       (25, 'Color', 'Black', 84.99, 30, 'SG-BLK');

-- Variants for 'Scarf' (product_id: 29)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (29, 'Material', 'Wool', 29.99, 80, 'SF-WOL'),
       (29, 'Color', 'Gray', 31.99, 70, 'SF-GRY');

-- Variants for 'Belt' (product_id: 30)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (30, 'Size', '32', 39.99, 50, 'BLT-SZ32'),
       (30, 'Size', '34', 39.99, 55, 'BLT-SZ34'),
       (30, 'Color', 'Brown', 42.99, 45, 'BLT-BRN');

-- Variants for 'Ceramic Coffee Mug' (product_id: 9)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (9, 'Color', 'White', 9.99, 100, 'CCM-WHT'),
       (9, 'Color', 'Black', 10.99, 90, 'CCM-BLK');

-- Variants for 'Cotton T-Shirt' (product_id: 6)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (6, 'Color', 'Red', 15.99, 60, 'CTS-RED'),
       (6, 'Color', 'Blue', 15.99, 70, 'CTS-BLU');

-- Variants for 'Winter Beanie Hat' (product_id: 12)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (12, 'Color', 'Black', 19.99, 90, 'WBH-BLK'),
       (12, 'Color', 'Navy', 21.99, 80, 'WBH-NAV');

-- Variants for 'Running Shoes' (product_id: 16)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (16, 'Size', '7', 99.99, 60, 'RS-SZ7'),
       (16, 'Size', '8', 99.99, 70, 'RS-SZ8');

-- Variants for 'Hoodie' (product_id: 28)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (28, 'Size', 'M', 39.99, 70, 'HD-SZM'),
       (28, 'Size', 'L', 39.99, 75, 'HD-SZL');

-- Variants for 'Sweater' (product_id: 24)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (24, 'Size', 'M', 49.99, 65, 'SW-SZM'),
       (24, 'Size', 'L', 49.99, 70, 'SW-SZL');

-- Variants for 'Gold Plated Necklace' (product_id: 35)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (35, 'Pendant Shape', 'Heart', 69.99, 40, 'GPN-HRT'),
       (35, 'Pendant Shape', 'Star', 74.99, 35, 'GPN-STR'),
       (35, 'Length', '18 inch', 69.99, 45, 'GPN-18');

-- Variants for 'Silver Hoop Earrings' (product_id: 36)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (36, 'Size', 'Small', 39.99, 60, 'SHE-SML'),
       (36, 'Size', 'Medium', 44.99, 55, 'SHE-MED'),
       (36, 'Finish', 'Polished', 39.99, 65, 'SHE-POL');

-- Variants for 'Gemstone Bracelet' (product_id: 37)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (37, 'Stone Type', 'Amethyst', 89.99, 20, 'GB-AMT'),
       (37, 'Stone Type', 'Rose Quartz', 94.99, 18, 'GB-RQT'),
       (37, 'Size', 'Adjustable', 89.99, 22, 'GB-ADJ');

-- Variants for 'Pearl Stud Earrings' (product_id: 38)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (38, 'Pearl Size', '6mm', 59.99, 45, 'PSE-6MM'),
       (38, 'Pearl Size', '8mm', 64.99, 40, 'PSE-8MM'),
       (38, 'Metal', 'Sterling Silver', 59.99, 50, 'PSE-SLV');

-- Variants for 'Fashion Ring Set' (product_id: 39)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (39, 'Ring Count', '3', 29.99, 75, 'FRS-3PC'),
       (39, 'Style', 'Boho', 32.99, 70, 'FRS-BHO'),
       (39, 'Size', 'Assorted', 29.99, 80, 'FRS-AST');

-- Variants for 'Throw Blanket' (product_id: 40)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (40, 'Color', 'Navy', 45.99, 55, 'TB-NAV'),
       (40, 'Color', 'Cream', 48.99, 50, 'TB-CRM'),
       (40, 'Size', 'Large', 45.99, 60, 'TB-LRG');

-- Variants for 'Set of Coasters' (product_id: 41)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (41, 'Material', 'Wood', 19.99, 90, 'SC-WOD'),
       (41, 'Material', 'Stone', 24.99, 85, 'SC-STN'),
       (41, 'Pieces', '4', 19.99, 95, 'SC-4PC');

-- Variants for 'Decorative Bowl' (product_id: 42)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (42, 'Color', 'Blue', 55.99, 30, 'DB-BLU'),
       (42, 'Color', 'Gold', 60.99, 28, 'DB-GLD'),
       (42, 'Size', 'Medium', 55.99, 35, 'DB-MED');

-- Variants for 'Tea Infuser Mug' (product_id: 43)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (43, 'Color', 'Green', 22.99, 80, 'TIM-GRN'),
       (43, 'Color', 'Gray', 24.99, 75, 'TIM-GRY'),
       (43, 'Material', 'Ceramic', 22.99, 85, 'TIM-CRM');

-- Variants for 'Notebook and Pen Set' (product_id: 44)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (44, 'Color', 'Black', 35.99, 50, 'NPS-BLK'),
       (44, 'Color', 'Brown', 38.99, 48, 'NPS-BRN'),
       (44, 'Type', 'Lined', 35.99, 52, 'NPS-LND');

-- Variants for 'Travel Mug' (product_id: 45)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (45, 'Color', 'Silver', 28.99, 65, 'TM-SLV'),
       (45, 'Color', 'Black', 30.99, 60, 'TM-BLK'),
       (45, 'Capacity', '16oz', 28.99, 70, 'TM-16OZ');

-- Variants for 'Desk Organizer' (product_id: 46)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (46, 'Material', 'Wood', 17.99, 100, 'DO-WOD'),
       (46, 'Material', 'Metal', 20.99, 95, 'DO-MTL'),
       (46, 'Color', 'Black', 17.99, 105, 'DO-BLK');

-- Variants for 'Oversized T-Shirt' (product_id: 47)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (47, 'Color', 'Black', 25.99, 90, 'OTS-BLK'),
       (47, 'Color', 'White', 25.99, 85, 'OTS-WHT'),
       (47, 'Size', 'L', 25.99, 95, 'OTS-SZL');

-- Variants for 'Lightweight Jacket' (product_id: 48)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (48, 'Color', 'Navy', 59.99, 40, 'LWJ-NAV'),
       (48, 'Color', 'Gray', 62.99, 38, 'LWJ-GRY'),
       (48, 'Size', 'M', 59.99, 42, 'LWJ-SZM');

-- Variants for 'Basic Sweatpants' (product_id: 49)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES (49, 'Color', 'Gray', 30.99, 70, 'BSP-GRY'),
       (49, 'Color', 'Black', 32.99, 65, 'BSP-BLK'),
       (49, 'Size', 'M', 30.99, 75, 'BSP-SZM');

-- Insert data for the 'contact_messages' table
INSERT INTO contact_messages (message_type, description, customer_name, customer_email, customer_phone)
VALUES ('General Inquiry', 'I have a question about one of your products.', 'Peter Jones', 'peter.jones@example.com',
        '111-222-3333'),
       ('Feedback', 'I really enjoyed your recent purchase!', 'Susan White', 'susan.white@example.com', '444-555-6666'),
       ('Complaint', 'My order arrived damaged.', 'Michael Brown', 'michael.brown@example.com', '555-123-4567'),
       ('Support', 'I need help with a return.', 'Linda Davis', 'linda.davis@example.com', '666-789-0123'),
       ('General Inquiry', 'What are your store hours?', 'Robert Wilson', 'robert.wilson@example.com', '777-234-5678'),
       ('Feedback', 'The website is very easy to use.', 'Karen Garcia', 'karen.garcia@example.com', '888-901-2345'),
       ('Complaint', 'I was overcharged for my order.', 'David Rodriguez', 'david.rodriguez@example.com',
        '999-345-6789'),
       ('Support', 'I cannot log in to my account.', 'Ashley Williams', 'ashley.williams@example.com', '000-456-7891'),
       ('General Inquiry', 'Do you offer gift wrapping?', 'Christopher Martinez', 'christopher.martinez@example.com',
        '123-567-8902'),
       ('Feedback', 'Your customer service is excellent.', 'Jessica Anderson', 'jessica.anderson@example.com',
        '234-678-9013'),
       ('Complaint', 'The color of the item was different than expected.', 'Matthew Thomas',
        'matthew.thomas@example.com', '345-789-0124'),
       ('Support', 'Where is my order?', 'Sarah Jackson', 'sarah.jackson@example.com', '456-890-1235'),
       ('General Inquiry', 'Are your products eco-friendly?', 'Kevin White', 'kevin.white@example.com', '567-901-2346'),
       ('Feedback', 'I loved the packaging of my order.', 'Brittany Harris', 'brittany.harris@example.com',
        '678-012-3457'),
       ('Complaint', 'One of the items was missing from my shipment.', 'Jason Martin', 'jason.martin@example.com',
        '789-012-4568'),
       ('Support', 'How do I track my order?', 'Stephanie Thompson', 'stephanie.thompson@example.com', '890-123-5679'),
       ('General Inquiry', 'What is your return policy?', 'Brandon Garcia', 'brandon.garcia@example.com',
        '901-234-6780'),
       ('Feedback', 'The quality of the products is great.', 'Nicole Martinez', 'nicole.martinez@example.com',
        '012-345-7891'),
       ('Complaint', 'The sizing of the apparel was inaccurate.', 'Ryan Anderson', 'ryan.anderson@example.com',
        '123-456-7892'),
       ('Support', 'I want to cancel my order.', 'Amanda Thomas', 'amanda.thomas@example.com', '234-567-8903'),
       ('General Inquiry', 'Do you ship internationally?', 'Tyler Jackson', 'tyler.jackson@example.com',
        '345-678-9014'),
       ('Feedback', 'I appreciated the quick delivery.', 'Samantha White', 'samantha.white@example.com',
        '456-789-0125'),
       ('Complaint', 'The material of the product was not as described.', 'Joshua Harris', 'joshua.harris@example.com',
        '567-890-1236'),
       ('Support', 'I received the wrong item.', 'Melissa Martin', 'melissa.martin@example.com', '678-901-2347'),
       ('General Inquiry', 'Where are your products manufactured?', 'Andrew Thompson', 'andrew.thompson@example.com',
        '789-012-3458'),
       ('Feedback', 'Your website is very user-friendly.', 'Lauren Garcia', 'lauren.garcia@example.com',
        '890-123-4569'),
       ('Complaint', 'The product broke after only a few uses.', 'Justin Martinez', 'justin.martinez@example.com',
        '901-234-5670'),
       ('Support', 'I need to change my shipping address.', 'Emily Anderson', 'emily.anderson@example.com',
        '012-345-6781'),
       ('General Inquiry', 'Do you offer discounts for bulk orders?', 'Jacob Thomas', 'jacob.thomas@example.com',
        '123-456-7893'),
       ('Feedback', 'I loved the variety of your products.', 'Olivia Jackson', 'olivia.jackson@example.com',
        '234-567-8904'),
       ('Complaint', 'The stitching on the garment came undone.', 'Ethan White', 'ethan.white@example.com',
        '345-678-9015'),
       ('Support', 'I forgot my password.', 'Madison Harris', 'madison.harris@example.com', '456-789-0126'),
       ('General Inquiry', 'What payment methods do you accept?', 'Noah Martin', 'noah.martin@example.com',
        '567-890-1237'),
       ('Feedback', 'I will definitely shop here again.', 'Ava Thompson', 'ava.thompson@example.com', '678-901-2348'),
       ('Complaint', 'The zipper on the bag is stuck.', 'William Garcia', 'william.garcia@example.com', '789-012-3459'),
       ('Support', 'How can I contact you directly?', 'Sophia Martinez', 'sophia.martinez@example.com', '890-123-4570'),
       ('General Inquiry', 'Do you have any sales going on?', 'James Anderson', 'james.anderson@example.com',
        '901-234-5671'),
       ('Feedback', 'The order arrived much faster than I expected.', 'Isabella Thomas', 'isabella.thomas@example.com',
        '012-345-6782'),
       ('Complaint', 'The packaging was not sufficient.', 'Benjamin Jackson', 'benjamin.jackson@example.com',
        '123-456-7894'),
       ('Support', 'My coupon code is not working.', 'Mia White', 'mia.white@example.com', '234-567-8905');
