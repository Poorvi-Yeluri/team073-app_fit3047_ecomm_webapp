-- Disable FK checks to avoid constraint errors
SET FOREIGN_KEY_CHECKS = 0;

-- Truncate tables in the correct order (child → parent)
TRUNCATE TABLE order_items;
TRUNCATE TABLE orders;
TRUNCATE TABLE cart_items;
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
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `nonce`, `nonce_expiry`, `created`,
                     `modified`)
VALUES (1, 'John', 'Doe', 'john.doe@example.com', '$2y$10$xxxxxxxxxxxxxxxxxxxxxxxxxxxxx', '123-456-7890', NULL, NULL,
        NOW(), NOW()),
       (2, 'Jane', 'Smith', 'jane.smith@example.com', '$2y$10$yyyyyyyyyyyyyyyyyyyyyyyyyyyyy', '987-654-3210', NULL,
        NULL, NOW(), NOW()),
       (3, 'Peter', 'Jones', 'peter.jones@example.com', '$2y$10$zzzzzzzzzzzzzzzzzzzzzzzzzzz', '111-222-3333', NULL,
        NULL, NOW(), NOW());

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
       (15, 3, 'Extra Large', NOW(), NOW());

-- Seed products
INSERT INTO products (id, name, slug, description, category, base_price, stock_quantity, image_url, created_at)
VALUES (1, 'Gold Pendant Necklace', 'gold-pendant-necklace', 'Elegant 18K gold necklace.', 'jewellery', 150.00, 10,
        'https://images.unsplash.com/photo-1602752250055-5ebb552fc3ae?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (2, 'Silver Hoop Earrings', 'silver-hoop-earrings', 'Trendy silver hoops.', 'jewellery', 80.00, 20,
        'https://images.unsplash.com/photo-1713004539634-a6694a83f3d9?q=80&w=3042&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (3, 'Wooden Wall Art', 'wooden-wall-art', 'Rustic wood decor piece.', 'home-decor', 120.00, 5,
        'https://cdn11.bigcommerce.com/s-79hupch4/images/stencil/1920w/products/9777/59303/floyd-wooden-wall-art-geometric-uttermost-04160___44646.1719669011.jpg?c=2',
        NOW()),
       (4, 'Ceramic Vase', 'ceramic-vase', 'Handmade vase.', 'home-decor', 60.00, 15,
        'https://plus.unsplash.com/premium_photo-1670475872881-6ac52730b6ee?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (5, 'Festive Gift Box', 'festive-gift-box', 'Perfect for special occasions.', 'gifts', 40.00, 30,
        'https://plus.unsplash.com/premium_photo-1663841374540-47180f85ed42?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (6, 'Clearance: Gold Ring', 'clearance-gold-ring', 'Last chance jewellery item.', 'clearance', 100.00, 2,
        'https://images.unsplash.com/photo-1713950920412-97799efdf870?q=80&w=3276&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (7, 'Platinum Necklace', 'platinum-necklace', 'Elegant platinum necklace.', 'jewellery', 500.00, 5,
        'https://images.unsplash.com/photo-1671663906664-9586041c3aa1?q=80&w=3191&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (8, 'Green Ceramic Bowl', 'green-ceramic-bowl', 'Beautiful green ceramic bowl.', 'home-decor', 40.00, 12,
        'https://images.unsplash.com/photo-1638370714788-2424881f92f4?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (9, 'Yellow Decorative Pillow', 'yellow-decorative-pillow', 'Stylish yellow pillow for home decor.','home-decor', 25.00, 20,
        'https://plus.unsplash.com/premium_photo-1680244047219-18b61a7c3649?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (10, 'Large Wooden Dining Table', 'large-wooden-dining-table', 'Sturdy large wooden dining table.', 'furniture',
        350.00, 8, 'https://images.unsplash.com/photo-1614846967953-d8e56e6082b0?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (11, 'Festive Gift Basket', 'festive-gift-basket', 'Gourmet gift basket perfect for celebrations.', 'gifts',
        60.00, 30, 'https://plus.unsplash.com/premium_photo-1661626873080-7bc10e208d9d?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW());

-- Seed product_attributes
INSERT INTO product_attributes (product_id, attribute_value_id)
VALUES (1, 1),
       (1, 5),
       (2, 2),
       (2, 6),
       (3, 3),
       (3, 7),
       (4, 4),
       (4, 8),
       (5, 7),
       (6, 1),
       (7, 12),
       (7, 5),
       (8, 4),
       (8, 13),
       (9, 4),
       (9, 14),
       (10, 3),
       (10, 15),
       (11, 7);

-- Seed product_variants
INSERT INTO product_variants (id, product_id, price, stock_quantity, sku, created_at)
VALUES (1, 1, 150.00, 5, 'NECK-GOLD-SM', NOW()),
       (2, 1, 155.00, 5, 'NECK-GOLD-MD', NOW()),
       (3, 2, 80.00, 10, 'EAR-SIL-SM', NOW()),
       (4, 2, 85.00, 10, 'EAR-SIL-LG', NOW()),
       (5, 3, 120.00, 2, 'WALL-WOOD', NOW()),
       (6, 4, 60.00, 5, 'VASE-CER-BLK', NOW()),
       (7, 5, 40.00, 30, 'GIFT-FEST', NOW()),
       (8, 6, 100.00, 2, 'CLR-GOLD-RING', NOW()),
       (9, 7, 500.00, 5, 'NECK-PLAT-RED', NOW()),
       (10, 7, 510.00, 5, 'NECK-PLAT-GREEN', NOW()),
       (11, 8, 40.00, 12, 'BOWL-GREEN', NOW()),
       (12, 9, 25.00, 15, 'PILLOW-YELLOW', NOW()),
       (13, 10, 350.00, 8, 'TABLE-WOOD-LG', NOW()),
       (14, 11, 60.00, 30, 'BASKET-FESTIVE', NOW());

-- Seed product_variant_attributes
INSERT INTO product_variant_attributes (product_variant_id, attribute_value_id)
VALUES (1, 1),
       (1, 5),
       (1, 9),
       (2, 1),
       (2, 5),
       (2, 10),
       (3, 2),
       (3, 6),
       (3, 9),
       (4, 2),
       (4, 6),
       (4, 11),
       (5, 3),
       (5, 7),
       (6, 4),
       (6, 8),
       (7, 7),
       (8, 1),
       (9, 12),
       (9, 5),
       (10, 12),
       (10, 13),
       (11, 4),
       (11, 13),
       (12, 14),
       (12, 4),
       (13, 3),
       (13, 15),
       (14, 7);

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
       (12, 'https://picsum.photos/id/250/800/600', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO product_variant_images (variant_id, image_url, created_at, modified_at)
VALUES (1, 'https://picsum.photos/id/237/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (1, 'https://picsum.photos/id/238/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (1, 'https://picsum.photos/id/239/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (2, 'https://picsum.photos/id/240/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (3, 'https://picsum.photos/id/241/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (4, 'https://picsum.photos/id/242/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (5, 'https://picsum.photos/id/243/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (6, 'https://picsum.photos/id/244/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (7, 'https://picsum.photos/id/245/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (8, 'https://picsum.photos/id/246/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (9, 'https://picsum.photos/id/247/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (10, 'https://picsum.photos/id/248/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (11, 'https://picsum.photos/id/249/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       (12, 'https://picsum.photos/id/250/800/600', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Seed cart_items
INSERT INTO `cart_items` (`id`, `user_id`, `variant_id`, `quantity`, `added_at`)
VALUES (1, 1, 1, 1, NOW()),
       (2, 2, 2, 2, NOW()),
       (3, 1, 5, 1, NOW());

-- Seed contact_messages
INSERT INTO `contact_messages` (`id`, `message_type`, `description`, `customer_name`, `customer_email`,
                                `customer_phone`, `created_at`)
VALUES (1, 'General Inquiry', 'Interested in your gold necklace.', 'Alice Brown', 'alice.brown@example.com',
        '555-123-4567', NOW()),
       (2, 'Complaint', 'The wooden vase arrived damaged.', 'Bob Green', 'bob.green@example.com', '555-987-6543',
        NOW()),
       (3, 'Feedback', 'Love the quality of the silver earrings!', 'Charlie White', 'charlie.white@example.com',
        '555-111-2222', NOW());

-- Seed orders
INSERT INTO `orders` (`id`, `user_id`, `order_date`, `total_price`, `status`, `shipping_address`)
VALUES (1, 1, NOW(), 150.00, 'Delivered', '123 Main St, Anytown, USA'),
       (2, 2, NOW(), 90.00, 'Shipped', '456 Oak Ave, Someville, USA'),
       (3, 1, NOW(), 25.00, 'Pending', '123 Main St, Anytown, USA');

-- Seed order_items
INSERT INTO `order_items` (`id`, `order_id`, `variant_id`, `quantity`, `price`)
VALUES (1, 1, 1, 1, 150.00),
       (2, 2, 2, 2, 45.00),
       (3, 3, 5, 1, 25.00);
