-- Disable FK checks to avoid constraint errors
SET FOREIGN_KEY_CHECKS = 0;

-- Truncate tables in the correct order (child → parent)
TRUNCATE TABLE order_items;
TRUNCATE TABLE orders;
TRUNCATE TABLE product_variant_attributes;
TRUNCATE TABLE product_variants;
TRUNCATE TABLE product_attributes;
TRUNCATE TABLE attribute_values;
TRUNCATE TABLE attributes;
TRUNCATE TABLE products;
TRUNCATE TABLE contact_messages;
TRUNCATE TABLE users;

-- Re-enable FK checks
SET FOREIGN_KEY_CHECKS = 1;

-- Seed users
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `nonce`, `nonce_expiry`, `created`, `modified`)
VALUES
    (1, 'John', 'Doe', 'john.doe@example.com', '$2y$10$xxxxxxxxxxxxxxxxxxxxxxxxxxxxx', '0412 345 678', NULL, NULL, NOW(), NOW()),
    (2, 'Jane', 'Smith', 'jane.smith@example.com', '$2y$10$yyyyyyyyyyyyyyyyyyyyyyyyyyyyy', '0423 456 789', NULL, NULL, NOW(), NOW()),
    (3, 'Peter', 'Jones', 'peter.jones@example.com', '$2y$10$zzzzzzzzzzzzzzzzzzzzzzzzzzz', '0434 567 890', NULL, NULL, NOW(), NOW()),
    (4, 'Emily', 'Brown', 'emily.brown@webmail.com', '$2y$10$aaaaaaaaaaaaaaaaaaaaaaaaaaa', '0455 678 901', NULL, NULL, NOW(), NOW()),
    (5, 'Liam', 'Wilson', 'liam.wilson@mailservice.com', '$2y$10$bbbbbbbbbbbbbbbbbbbbbbbbbbb', '0466 789 012', NULL, NULL, NOW(), NOW()),
    (6, 'Chloe', 'Taylor', 'chloe.taylor@fastmail.com', '$2y$10$ccccccccccccccccccccccccccc', '0477 890 123', NULL, NULL, NOW(), NOW()),
    (7, 'Noah', 'Lee', 'noah.lee@inbox.net', '$2y$10$ddddddddddddddddddddddddddd', '0488 901 234', NULL, NULL, NOW(), NOW()),
    (8, 'Olivia', 'Martin', 'olivia.martin@email.com', '$2y$10$eeeeeeeeeeeeeeeeeeeeeeeeeee', '0499 012 345', NULL, NULL, NOW(), NOW()),
    (9, 'Jack', 'White', 'jack.white@provider.com', '$2y$10$fffffffffffffffffffffffffff', '02 9123 4567', NULL, NULL, NOW(), NOW()),
    (10, 'Ava', 'Walker', 'ava.walker@domain.com', '$2y$10$ggggggggggggggggggggggggggg', '03 9876 5432', NULL, NULL, NOW(), NOW()),
    (11, 'Lucas', 'Hall', 'lucas.hall@australiamail.com', '$2y$10$hhhhhhhhhhhhhhhhhhhhhhhhhhh', '0410 234 567', NULL, NULL, NOW(), NOW()),
    (12, 'Zoe', 'Adams', 'zoe.adams@samplemail.com', '$2y$10$iiiiiiiiiiiiiiiiiiiiiiiiiii', '0409 345 678', NULL, NULL, NOW(), NOW()),
    (13, 'Ethan', 'Campbell', 'ethan.campbell@ozmail.net', '$2y$10$jjjjjjjjjjjjjjjjjjjjjjjjjjj', '0401 456 789', NULL, NULL, NOW(), NOW());

-- Seed attributes
INSERT INTO attributes (id, name, created_at, modified_at)
VALUES (1, 'Material', NOW(), NOW()),
       (2, 'Color', NOW(), NOW()),
       (3, 'Size', NOW(), NOW());

-- Seed attribute values
INSERT INTO attribute_values (id, attribute_id, value, created_at, modified_at)
VALUES (1, 1, 'Gold', NOW(), NOW()),
       (2, 1, 'Silver', NOW(), NOW()),
       (3, 1, 'Wood', NOW(), NOW()),
       (4, 1, 'Ceramic', NOW(), NOW()),
       (5, 2, 'Red', NOW(), NOW()),
       (6, 2, 'Blue', NOW(), NOW()),
       (7, 2, 'White', NOW(), NOW()),
       (8, 2, 'Black', NOW(), NOW()),
       (9, 3, 'Small', NOW(), NOW()),
       (10, 3, 'Medium', NOW(), NOW()),
       (11, 3, 'Large', NOW(), NOW()),
       (12, 1, 'Platinum', NOW(), NOW()),
       (13, 2, 'Green', NOW(), NOW()),
       (14, 2, 'Yellow', NOW(), NOW()),
       (15, 3, 'Extra Large', NOW(), NOW()),
       (16, 1, 'Diamond',NOW(),NOW()),
       (17,1,'Sapphire',NOW(),NOW()),
       (18, 1,'Emerald',NOW(),NOW());


-- Seed products
INSERT INTO products (id, name, slug, description, category, base_price,  created_at)
VALUES
    (1, 'Elegant Gold Necklace', 'elegant-gold-necklace', 'A beautifully crafted gold necklace.', 'jewellery', 120.00, NOW()),
    (2, 'Modern Ceramic Vase', 'modern-ceramic-vase', 'Stylish ceramic vase for home decor.', 'home-decor', 45.00,  NOW()),
    (3, 'Fun Gift Mug', 'fun-gift-mug', 'A quirky mug for gifting.', 'gifts', 15.00, NOW()),
    (4, 'Clearance Candle Set', 'clearance-candle-set', 'Discounted candle set.', 'clearance', 10.00,  NOW()),
    (5, 'Wooden Vase', 'wooden-vase', 'Wooden vase for home decor.', 'home-decor', 45.00,  NOW());


-- Seed product_attributes
INSERT INTO product_attributes (product_id, attribute_id)
VALUES
-- Jewellery: uses Size and Color
(1, 2),  -- Color
(1, 3),  -- Size


-- Home-decor: uses Material and Color
(2, 2),  -- Color

-- Gifts: anything (we use Color and Size here)
(3, 2),
(3, 3),

-- Clearance: anything (Material and Color here)
(4, 1),
(4, 2),

-- Home-decor: uses Material and Color
(5, 2);  -- Color


-- Seed product_variants
INSERT INTO product_variants (id, product_id, name, slug, price, stock_quantity, sku, created_at)
VALUES
-- Jewellery: only Color (Size is now a shared product-level attribute)
(1, 1, 'Gold Necklace - Red', 'gold-necklace-red', 120.00, 25, 'NECK-GOLD-RED', NOW()),
(2, 1, 'Gold Necklace - Blue', 'gold-necklace-blue', 120.00, 25, 'NECK-GOLD-BLUE', NOW()),
(3, 1, 'Gold Necklace - Black', 'gold-necklace-black', 120.00, 25, 'NECK-GOLD-BLACK', NOW()),
(4, 1, 'Gold Necklace - White', 'gold-necklace-white', 120.00, 25, 'NECK-GOLD-WHITE', NOW()),

-- Home-decor
(5, 2, 'Ceramic Vase - Red', 'ceramic-vase-red', 45.00, 12, 'VASE-CERAMIC-RED', NOW()),
(6, 2, 'Ceramic Vase - Blue', 'ceramic-vase-blue', 45.00, 12, 'VASE-CERAMIC-BLUE', NOW()),
(7, 5, 'Wood Vase - Red', 'wood-vase-red', 45.00, 13, 'VASE-WOOD-RED', NOW()),
(8, 5, 'Wood Vase - Blue', 'wood-vase-blue', 45.00, 13, 'VASE-WOOD-BLUE', NOW()),

-- Gifts
(9, 3, 'Gift Mug - Blue / Medium', 'gift-mug-blue-medium', 15.00, 35, 'MUG-BLUE-MEDIUM', NOW()),
(10, 3, 'Gift Mug - Green / Large', 'gift-mug-green-large', 15.00, 35, 'MUG-GREEN-LARGE', NOW()),

-- Clearance
(11, 4, 'Candle Set - White / Small', 'candle-set-white-small', 10.00, 15, 'CANDLE-WHITE-SMALL', NOW()),
(12, 4, 'Candle Set - Yellow / Medium', 'candle-set-yellow-medium', 10.00, 15, 'CANDLE-YELLOW-MEDIUM', NOW());



-- Seed product_variant_attributes
-- Jewellery: Only Color (Size comes from product attributes)

INSERT INTO product_variant_attributes (product_variant_id, attribute_value_id)
VALUES
    -- Red Gold Necklace (Small, Medium, Large, XL)
    (1, 5), -- Red
    (1, 9), -- Small
    (1, 10), -- Medium
    (1, 11), -- Large
    (1, 15), -- Extra Large

    -- Blue Gold Necklace (Small, Medium, Large, XL)
    (2, 6), -- Blue
    (2, 9), -- Small
    (2, 10), -- Medium
    (2, 11), -- Large
    (2, 15), -- Extra Large

    -- Black Gold Necklace (Small, Medium, Large, XL)
    (3, 8), -- Black
    (3, 9), -- Small
    (3, 10), -- Medium
    (3, 11), -- Large
    (3, 15), -- Extra Large

    -- White Gold Necklace (Small, Medium, Large, XL)
    (4, 7), -- White
    (4, 9), -- Small
    (4, 10), -- Medium
    (4, 11), -- Large
    (4, 15), -- Extra Large


-- Home-decor: Only Material and Color
    (5, 4), (5, 5),   -- Ceramic, Red
    (6, 4), (6, 6),   -- Ceramic, Blue
    (7, 3), (7, 5),   -- Wood, Red
    (8, 3), (8, 6),   -- Wood, Blue

-- Gifts: Anything (both color and size stay)
    (9, 6), (9, 10),  -- Blue, Medium
    (10, 13), (10, 11), -- Green, Large

-- Clearance: Anything
    (11, 7), (11, 9),  -- White, Small
    (12, 14), (12, 10); -- Yellow, Medium


INSERT INTO product_images (product_id, image_url, is_main, created_at, modified_at)
VALUES (1, 'https://images.unsplash.com/photo-1602752250055-5ebb552fc3ae?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 'https://images.unsplash.com/photo-1713004539634-a6694a83f3d9?q=80&w=3042&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (3, 'https://cdn11.bigcommerce.com/s-79hupch4/images/stencil/1920w/products/9777/59303/floyd-wooden-wall-art-geometric-uttermost-04160___44646.1719669011.jpg?c=2', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (4, 'https://plus.unsplash.com/premium_photo-1670475872881-6ac52730b6ee?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (5, 'https://plus.unsplash.com/premium_photo-1663841374540-47180f85ed42?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (6, 'https://images.unsplash.com/photo-1713950920412-97799efdf870?q=80&w=3276&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (7, 'https://images.unsplash.com/photo-1671663906664-9586041c3aa1?q=80&w=3191&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (8, 'https://images.unsplash.com/photo-1638370714788-2424881f92f4?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (9, 'https://plus.unsplash.com/premium_photo-1680244047219-18b61a7c3649?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (10, 'https://images.unsplash.com/photo-1614846967953-d8e56e6082b0?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (11, 'https://plus.unsplash.com/premium_photo-1661626873080-7bc10e208d9d?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (12,'https://plus.unsplash.com/premium_photo-1678730056371-eff9c5356a48?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (13,'https://images.unsplash.com/photo-1677316733466-515d38dca7ed?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (14,'https://images.unsplash.com/photo-1657426057065-34972f108e4e?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (15,'https://images.unsplash.com/photo-1724937721228-f7bf3df2a4d8?q=80&w=4315&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (16,'https://images.unsplash.com/photo-1743127187686-e6145b08658b?q=80&w=4112&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (17,'https://images.unsplash.com/photo-1667013878745-e95d52596ab4?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (18,'https://images.unsplash.com/photo-1663243818736-2b7148eeb2f5?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (19,'https://images.unsplash.com/photo-1724937798223-720f8956cb12?q=80&w=4102&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (20,'https://images.unsplash.com/photo-1689367436414-7acc3fdc3e2a?q=80&w=3840&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (21,'https://images.unsplash.com/photo-1718312267215-58bbba315a15?q=80&w=4344&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (22,'https://images.unsplash.com/photo-1693212793204-bcea856c75fe?q=80&w=2362&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
       (23,'https://images.unsplash.com/photo-1612392549386-b6969764af6f?q=80&w=3173&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (24,'https://images.unsplash.com/photo-1584594768835-fc5cedbc1337?q=80&w=4341&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (25,'https://images.unsplash.com/photo-1724230758611-7cb93468d7d6?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (26,'https://images.unsplash.com/photo-1720156351990-67afa28e4aca?q=80&w=4142&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (27,'https://images.unsplash.com/photo-1589079065352-37640fc29721?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (28,'https://plus.unsplash.com/premium_photo-1739841783786-bd6ee1c4155e?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (29,'https://images.unsplash.com/photo-1617695615794-a5abcece0f48?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (30,'https://plus.unsplash.com/premium_photo-1661777863705-d3232b7c8088?q=80&w=4000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (31,'https://images.unsplash.com/photo-1571283600608-f18b62590b2b?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (32,'https://plus.unsplash.com/premium_photo-1714841548008-6e488c6b4016?q=80&w=4138&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (33,'https://images.unsplash.com/photo-1552832036-5ce6f9568f9f?q=80&w=4142&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (34,'https://images.unsplash.com/photo-1720534195942-d55d1760df95?q=80&w=3841&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (35,'https://images.unsplash.com/photo-1739912061342-280525e3c20f?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (36,'https://images.unsplash.com/photo-1646587191447-11425def78f7?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (37,'https://images.unsplash.com/photo-1523575708161-ad0fc2a9b951?q=80&w=3828&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (38,'https://images.unsplash.com/photo-1639738491156-3bed044f1678?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (39,'https://images.unsplash.com/photo-1654700194977-a1f7cc4d7884?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (40,'https://images.unsplash.com/photo-1652377846018-60b546480e28?q=80&w=3706&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (41,'https://images.unsplash.com/photo-1540159528267-8a9f6af2633e?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (42,'https://images.unsplash.com/photo-1656923844940-74867a782c6c?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp),
       (43,'https://images.unsplash.com/photo-1647505173643-93ed97eed1be?q=80&w=4138&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,current_timestamp,current_timestamp);

INSERT INTO product_variant_images (variant_id, image_url, is_main, created_at, modified_at)
VALUES (1, 'https://images.unsplash.com/photo-1601121141461-9d6647bca1ed?q=80&w=4137&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 'https://images.unsplash.com/photo-1721808084849-c2a9e3691ce0?q=80&w=3500&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (3, 'https://images.unsplash.com/photo-1611583027838-515a1087afdb?q=80&w=3502&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (4, 'https://images.unsplash.com/photo-1707222609386-218e77b400ca?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (5, 'https://images.unsplash.com/photo-1644328986176-0d2d6af69314?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (6, 'https://images.unsplash.com/photo-1720351505368-b76f8d25752f?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (7, 'https://images.unsplash.com/photo-1531452454767-de8511addfdf?q=80&w=4367&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (8, 'https://images.unsplash.com/photo-1738053473109-0536f918f4c3?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (9, 'https://images.unsplash.com/photo-1530234827832-13cbf19d109f?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (10, 'https://images.unsplash.com/photo-1587499726408-c65533ed62c4?q=80&w=4146&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (11, 'https://images.unsplash.com/photo-1652419675274-d120bb8e8c71?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (12, 'https://images.unsplash.com/photo-1669465006376-7b5f1b777921?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



-- Seed contact_messages
INSERT INTO `contact_messages` (`id`, `message_type`, `description`, `customer_name`, `customer_email`, `customer_phone`, `created_at`)
VALUES
    (1, 'General Inquiry', 'Interested in your gold necklace.', 'Alice Brown', 'alice.brown@gmail.com', '0411 223 344', NOW()),
    (2, 'Complaint', 'The wooden vase arrived damaged.', 'Bob Green', 'bob.green@live.com.au', '0422 334 455', NOW()),
    (3, 'Feedback', 'Love the quality of the silver earrings!', 'Charlie White', 'charlie.white@outlook.com', '0433 445 566', NOW()),
    (4, 'Support', 'Having trouble logging into my account.', 'Diana King', 'diana.king@outlook.com', '0412 345 678', NOW()),
    (5, 'Feedback', 'Your gift wrapping was lovely!', 'Ethan Clark', 'ethan.clark@mail.com', '0423 456 789', NOW()),
    (6, 'Complaint', 'Received the wrong item in my order.', 'Fiona Scott', 'fiona.scott@gmail.com', '0434 567 890', NOW()),
    (7, 'General Inquiry', 'Do you ship to New Zealand?', 'George Young', 'george.young@webmail.com', '0445 678 901', NOW()),
    (8, 'Support', 'Need help updating my delivery address.', 'Holly Adams', 'holly.adams@yahoo.com', '0456 789 012', NOW()),
    (9, 'Complaint', 'Mirror arrived shattered. Requesting replacement.', 'Ian Lee', 'ian.lee@example.com', '0467 890 123', NOW()),
    (10, 'Feedback', 'Impressed by your eco-friendly packaging.', 'Jasmine Rose', 'jasmine.rose@mailbox.com', '0478 901 234', NOW()),
    (11, 'Support', 'Can’t apply the promo code.', 'Kevin Baker', 'kevin.baker@provider.com', '0489 012 345', NOW()),
    (12, 'General Inquiry', 'Are custom engravings available?', 'Laura Turner', 'laura.turner@aol.com', '0490 123 456', NOW()),
    (13, 'Feedback', 'Loved the hand-painted candle holder!', 'Max Harris', 'max.harris@ozmail.com', '0401 234 567', NOW()),
    (14, 'General Inquiry', 'Do you offer gift cards?', 'Nina Wells', 'nina.wells@gmail.com', '0402 345 678', NOW()),
    (15, 'Complaint', 'Received a faulty lamp, need a replacement.', 'Oscar Blake', 'oscar.blake@mail.com', '0413 456 789', NOW()),
    (16, 'Support', 'Order history not showing on my account.', 'Paula Reid', 'paula.reid@live.com.au', '0424 567 890', NOW()),
    (17, 'Feedback', 'Fantastic experience at your store!', 'Quentin Hall', 'quentin.hall@outlook.com', '0435 678 901', NOW()),
    (18, 'Support', 'Can I change the delivery date for my order?', 'Rachel Moore', 'rachel.moore@yahoo.com', '0446 789 012', NOW()),
    (19, 'Complaint', 'Received a refund but still got charged.', 'Samuel Doyle', 'samuel.doyle@provider.com', '0457 890 123', NOW());




