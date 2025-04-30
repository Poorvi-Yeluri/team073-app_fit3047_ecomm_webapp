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
       (15, 3, 'Extra Large', NOW(), NOW()),
       (16, 1, 'Diamond',NOW(),NOW()),
       (17,1,'Sapphire',NOW(),NOW()),
       (18, 1,'Emerald',NOW(),NOW());


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
        60.00, 30, 'https://plus.unsplash.com/premium_photo-1661626873080-7bc10e208d9d?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),


       (12, '18K Gold Cuban Necklace', '18k-gold-cuban-necklace', 'A luxurious necklace featuring lustrous premium craftsmanship set in 18K gold. This timeless piece adds an elegant touch to any evening ensemble.', 'Jewellery', 250.00, 20,
        'https://plus.unsplash.com/premium_photo-1678730056371-eff9c5356a48?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (13, 'Solitaire Ring', 'solitaire-ring', 'A stunning solitaire ring set on a classic platinum band perfect for engagements or special occasions. The diamonds brilliance will captivate everyone.', 'Jewellery', 1200.00, 15,
        'https://images.unsplash.com/photo-1677316733466-515d38dca7ed?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (14, 'Platinum Cushion Cut Ring', 'platinum-cushion-cut-ring', 'This exquisite platinum ring features a cushion cut diamond exuding both modern sophistication and timeless elegance. Perfect for a special occasion or engagement.', 'Jewellery', 1800.00, 10,
        'https://images.unsplash.com/photo-1657426057065-34972f108e4e?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (15, 'Ruby and Diamond Pendant', 'ruby-diamond-pendant', 'A stunning ruby pendant surrounded by sparkling diamonds set in white gold. This luxurious pendant is an exquisite gift for someone special.', 'Jewellery', 900.00, 8,
        'https://images.unsplash.com/photo-1724937721228-f7bf3df2a4d8?q=80&w=4315&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (16, 'Sapphire Eternity Band', 'sapphire-eternity-band', 'This eternity band features deep blue sapphires encircled by diamonds set in 18K white gold. A timeless symbol of love and commitment.', 'Jewellery', 1100.00, 12,
        'https://images.unsplash.com/photo-1743127187686-e6145b08658b?q=80&w=4112&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (17, 'Emerald Drop Earrings', 'emerald-drop-earrings', 'Elegant drop earrings featuring vibrant emeralds set in 14K yellow gold. The perfect addition to any elegant evening wear.', 'Jewellery', 650.00, 14,
        'https://images.unsplash.com/photo-1667013878745-e95d52596ab4?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (18, 'Gold and Diamond Tennis Bracelet', 'gold-diamond-tennis-bracelet', 'This classic tennis bracelet features alternating diamonds and 14K gold links offering a sophisticated look. Perfect for both everyday wear and special occasions.', 'Jewellery', 1300.00, 10,
        'https://images.unsplash.com/photo-1663243818736-2b7148eeb2f5?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (19, 'Chandelier Diamond Earrings', 'chandelier-diamond-earrings', 'These dazzling chandelier earrings are adorned with round and marquise-cut diamonds set in 18K white gold. A show-stopping accessory for a luxurious evening event.', 'Jewellery', 2000.00, 7,
        'https://images.unsplash.com/photo-1724937798223-720f8956cb12?q=80&w=4102&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (20, 'Gold Mesh Bracelet', 'gold-mesh-bracelet', 'A refined 18K gold mesh bracelet that exudes elegance and sophistication. Perfect for both casual and formal occasions making a statement with its unique design.', 'Jewellery', 750.00, 15,
        'https://images.unsplash.com/photo-1689367436414-7acc3fdc3e2a?q=80&w=3840&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (21, 'Pearl and Diamond Choker', 'pearl-diamond-choker', 'This opulent choker features lustrous pearls intertwined with dazzling diamonds set in white gold. A stunning piece that adds glamour to any evening look.', 'Jewellery', 1700.00, 5,
        'https://images.unsplash.com/photo-1718312267215-58bbba315a15?q=80&w=4344&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (22, 'Vintage Diamond Brooch', 'vintage-diamond-brooch', 'A vintage-inspired brooch featuring intricate diamond detailing set in 18K gold. Perfect for adding a touch of sophistication to any outfit.', 'Jewellery', 950.00, 6,
        'https://images.unsplash.com/photo-1693212793204-bcea856c75fe?q=80&w=2362&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),




       (23, 'Gold Edge Mirror', 'gold-edge-mirror', 'Framed wall mirror with a refined gold trim finish. Designed to bring luxury and light to any interior.', 'home-decor', 180.00, 10,
        'https://images.unsplash.com/photo-1612392549386-b6969764af6f?q=80&w=3173&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (24, 'Black Marble Tray', 'black-marble-tray', 'Elegant black marble tray for serving or display. Adds sophistication to modern tabletops.', 'home-decor', 85.00, 15,
        'https://images.unsplash.com/photo-1584594768835-fc5cedbc1337?q=80&w=4341&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (25, 'Rustic Wooden Clock', 'rustic-wooden-clock', 'Handcrafted wall clock made from aged wood. Brings a timeless rustic charm to your space.', 'home-decor', 140.00, 7,
        'https://images.unsplash.com/photo-1724230758611-7cb93468d7d6?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (26, 'Green Glass Candle Holder', 'green-glass-candle-holder', 'Vintage style candle holder in deep green glass. Creates a calm and ambient glow when lit.', 'home-decor', 45.00,
        20, 'https://images.unsplash.com/photo-1720156351990-67afa28e4aca?q=80&w=4142&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (27, 'White Ceramic Lamp', 'white-ceramic-lamp', 'Soft white ceramic table lamp with linen shade. Offers a clean and classic lighting solution.', 'home-decor', 130.00, 12,
        'https://images.unsplash.com/photo-1589079065352-37640fc29721?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (28, 'Red Velvet Cushion', 'red-velvet-cushion', 'Lush red velvet cushion with piped edges. A bold accent piece for your lounge or bedroom.', 'home-decor', 55.00, 18,
        'https://plus.unsplash.com/premium_photo-1739841783786-bd6ee1c4155e?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (29, 'Wooden Serving Board', 'wooden-serving-board', 'Premium wood grain board for serving appetisers or cheese. Rustic design ideal for entertaining.', 'home-decor', 60.00, 25,
        'https://images.unsplash.com/photo-1617695615794-a5abcece0f48?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (30, 'Extra Large Wall Frame', 'extra-large-wall-frame', 'Oversized wooden frame ideal for statement art or photos. Offers a bold visual anchor.', 'home-decor', 90.00, 5,
        'https://plus.unsplash.com/premium_photo-1661777863705-d3232b7c8088?q=80&w=4000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (31, 'Yellow Accent Stool', 'yellow-accent-stool', 'Bright yellow wooden stool perfect as extra seating or decor. Adds vibrancy to minimalist interiors.', 'home-decor', 70.00, 10,
        'https://images.unsplash.com/photo-1571283600608-f18b62590b2b?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (32, 'Small Ceramic Dish Set', 'small-ceramic-dish-set', 'Set of handmade ceramic dishes in a clean white tone. Suits small portions or decorative use.', 'home-decor', 35.00, 16,
        'https://plus.unsplash.com/premium_photo-1714841548008-6e488c6b4016?q=80&w=4138&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (33, 'Gold Framed Vincent Artwork', 'gold-framed-artwork', 'Abstract Vincent Creo Artwork in a brushed gold frame. Designed to elevate luxury interiors.', 'home-decor', 220.00, 6,
        'https://images.unsplash.com/photo-1552832036-5ce6f9568f9f?q=80&w=4142&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),






       (34, 'Personalized Leather Journal', 'personalized-leather-journal', 'A beautifully crafted leather journal, perfect for personal thoughts, sketches, or notes. Customizable with your initials.', 'gifts', 180.00, 12,
        'https://images.unsplash.com/photo-1720534195942-d55d1760df95?q=80&w=3841&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (35, 'Handmade Scented Candles', 'handmade-scented-candles', 'A set of three handcrafted scented candles that bring a relaxing ambiance to any room. Choose from lavender, vanilla, and citrus scents.', 'gifts', 150.00, 18,
        'https://images.unsplash.com/photo-1739912061342-280525e3c20f?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (36, 'Crystal Wine Glass Set', 'crystal-wine-glass-set', 'An elegant set of 4 crystal wine glasses that are perfect for any occasion. Lead-free and dishwasher safe.', 'gifts', 250.00, 10,
        'https://images.unsplash.com/photo-1646587191447-11425def78f7?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (37, 'Mini Indoor Plant Collection', 'mini-indoor-plant-collection', 'A delightful collection of mini indoor plants, including succulents and air plants. A perfect gift for plant lovers.', 'gifts', 120.00, 20,
        'https://images.unsplash.com/photo-1523575708161-ad0fc2a9b951?q=80&w=3828&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (38, 'Gold-Plated Heart Necklace', 'gold-plated-heart-necklace', 'A delicate gold-plated necklace with a heart-shaped pendant, perfect for a romantic gift or special occasion.', 'jewellery', 320.00, 25,
        'https://images.unsplash.com/photo-1639738491156-3bed044f1678?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),
       (39, 'Silver Hoop Earrings', 'silver-hoop-earrings', 'Classic silver hoop earrings that add a touch of elegance to any outfit. Perfect for daily wear or evening events.', 'jewellery', 150.00, 40,
        'https://images.unsplash.com/photo-1654700194977-a1f7cc4d7884?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),


       (40, 'Clearance: Woven Rattan Basket', 'clearance-woven-rattan-basket', 'Handwoven rattan storage basket, ideal for organising living spaces. Natural finish with sturdy handles.', 'clearance', 100.00, 8,
        'https://images.unsplash.com/photo-1652377846018-60b546480e28?q=80&w=3706&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (41, 'Clearance: Velvet Throw Blanket', 'clearance-velvet-throw-blanket', 'Luxuriously soft velvet throw in deep emerald. Perfect for cozy nights or as a decorative accent.', 'clearance', 90.00, 12,
        'https://images.unsplash.com/photo-1540159528267-8a9f6af2633e?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (42, 'Clearance: Brass Wall Hooks', 'clearance-brass-wall-hooks', 'Set of 5 polished brass wall hooks. Stylish and functional for entryways or wardrobes.', 'clearance', 105.00, 15,
        'https://images.unsplash.com/photo-1656923844940-74867a782c6c?q=80&w=4140&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW()),

       (43, 'Clearance: Marble Coaster Set', 'clearance-marble-coaster-set', 'Elegant white marble coasters with gold accents. Set of 4 for protecting surfaces in style.', 'clearance', 115.00, 10,
        'https://images.unsplash.com/photo-1647505173643-93ed97eed1be?q=80&w=4138&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', NOW());


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
       (9, 14),
       (10, 3),
       (10, 15),
       (11, 7),
       (12,1 ),
       (13, 12),
       (14, 12),
       (15,16 ),
       (16,17),
       (17,18),
       (18, 1),
       (18, 16),
       (19, 16),
       (20, 1),
       (21,16),
       (22, 16),
       (23, 1),
       (23, 7),
       (24, 8),
       (25, 3),
       (25, 11),
       (26, 13),
       (27, 4),
       (27, 7),
       (28, 5),
       (29, 3),
       (30, 3),
       (30, 15),
       (31, 14),
       (32, 4),
       (32, 9),
       (33, 1);


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


-- Seed contact_messages
INSERT INTO `contact_messages` (`id`, `message_type`, `description`, `customer_name`, `customer_email`,
                                `customer_phone`, `created_at`)
VALUES (1, 'General Inquiry', 'Interested in your gold necklace.', 'Alice Brown', 'alice.brown@example.com',
        '555-123-4567', NOW()),
       (2, 'Complaint', 'The wooden vase arrived damaged.', 'Bob Green', 'bob.green@example.com', '555-987-6543',
        NOW()),
       (3, 'Feedback', 'Love the quality of the silver earrings!', 'Charlie White', 'charlie.white@example.com',
        '555-111-2222', NOW());


