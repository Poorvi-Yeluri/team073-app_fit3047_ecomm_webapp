-- Create database for the business
DROP DATABASE IF EXISTS fit3047_app;
CREATE DATABASE fit3047_app;
USE fit3047_app;

-- Users table
DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    first_name   VARCHAR(255) NOT NULL,
    last_name    VARCHAR(255) DEFAULT NULL,
    email        VARCHAR(255) NOT NULL UNIQUE,
    password     VARCHAR(255) NOT NULL,
    phone        VARCHAR(255) DEFAULT NULL,
    nonce        VARCHAR(255),
    nonce_expiry DATETIME,
    created      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Products table (for base product information)
DROP TABLE IF EXISTS products;
CREATE TABLE products
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(255) NOT NULL,
    description     TEXT,
    category        VARCHAR(255) NOT NULL,   -- E.g., 'Home Decor', 'Jewelry', etc.
    base_price      DECIMAL(10, 2) NOT NULL,
    stock_quantity  INT NOT NULL,            -- Total stock across all variants
    created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Product Variants table (for different sizes, colors, materials, etc.)
DROP TABLE IF EXISTS product_variants;
CREATE TABLE product_variants
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    product_id      INT NOT NULL,
    variant_name    VARCHAR(255) NOT NULL,  -- E.g., 'Size', 'Color', 'Material'
    variant_value   VARCHAR(255) NOT NULL,  -- E.g., 'Small', 'Red', 'Gold'
    price           DECIMAL(10, 2) NOT NULL,  -- Variant-specific price (can be different)
    stock_quantity  INT NOT NULL,            -- Stock for this specific variant
    sku             VARCHAR(255) NOT NULL UNIQUE,  -- Unique SKU for the variant
    created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Cart Items table (to track items added to the cart by users)
DROP TABLE IF EXISTS cart_items;
CREATE TABLE cart_items
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT NOT NULL,
    variant_id     INT NOT NULL,  -- References product_variant table
    quantity       INT NOT NULL DEFAULT 1,
    added_at       DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (variant_id) REFERENCES product_variants(id)
);

-- Orders table (to track placed orders by users)
DROP TABLE IF EXISTS orders;
CREATE TABLE orders
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT NOT NULL,
    order_date     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total_price    DECIMAL(10, 2) NOT NULL,
    status         ENUM('Pending', 'Shipped', 'Delivered', 'Cancelled') NOT NULL DEFAULT 'Pending',
    shipping_address TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Order Items table (to track which items are included in an order)
DROP TABLE IF EXISTS order_items;
CREATE TABLE order_items
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    order_id       INT NOT NULL,
    variant_id     INT NOT NULL,  -- References product_variant table
    quantity       INT NOT NULL DEFAULT 1,
    price          DECIMAL(10, 2) NOT NULL,  -- Price at the time of purchase
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (variant_id) REFERENCES product_variants(id)
);

-- Contact Messages table (for customer inquiries, complaints, feedback, etc.)
DROP TABLE IF EXISTS contact_messages;
CREATE TABLE contact_messages
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    message_type   ENUM ('General Inquiry', 'Complaint', 'Feedback', 'Support') NOT NULL,
    description    TEXT                                                         NOT NULL,
    customer_name  VARCHAR(255)                                                 NOT NULL,
    customer_email VARCHAR(255)                                                 NOT NULL,
    customer_phone VARCHAR(255)                                                 NOT NULL,
    created_at     DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample users
INSERT INTO users (first_name, last_name, email, phone, password, nonce, nonce_expiry)
VALUES
    ('Alice', 'Smith', 'alice@example.com', '+61400111222', SHA2('password123', 256), NULL, NULL),
    ('Bob', 'Johnson', 'bob@example.com', '+61400333444', SHA2('securepass456', 256), 'abc123xyz', '2025-04-14 10:00:00'),
    ('Charlie', NULL, 'charlie@example.com', NULL, SHA2('hunter2', 256), NULL, NULL);


-- Insert sample contact messages
INSERT INTO contact_messages (message_type, description, customer_name, customer_email, customer_phone)
VALUES
    ('General Inquiry', 'I would like to know more about your home decor products.', 'John Doe', 'john.doe@example.com', '555-1234'),
    ('Complaint', 'My jewelry arrived damaged and I am unhappy with the quality.', 'Jane Smith', 'jane.smith@example.com', '555-5678'),
    ('Feedback', 'The new collection of home decor is fantastic!', 'Alice Johnson', 'alice.johnson@example.com', '555-8765'),
    ('Support', 'I need help with processing my return for an item.', 'Bob Brown', 'bob.brown@example.com', '555-4321');

-- Inserting sample products
INSERT INTO products (name, description, category, base_price, stock_quantity)
VALUES
    ('Decorative Vase', 'A beautiful ceramic vase for your living room.', 'Home Decor', 39.99, 150),
    ('Gold Necklace', 'Elegant gold necklace with a heart-shaped pendant.', 'Jewelry', 149.99, 100),
    ('Wall Art', 'Abstract modern art for your home or office.', 'Home Decor', 79.99, 200),
    ('Silver Bracelet', 'Sterling silver bracelet with intricate design.', 'Jewelry', 89.99, 120);

-- Inserting product variants for "Decorative Vase" (Size and Color)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES
    (1, 'Color', 'Red', 39.99, 50, 'VASE-RED'),
    (1, 'Color', 'Blue', 39.99, 50, 'VASE-BLUE'),
    (1, 'Color', 'White', 39.99, 50, 'VASE-WHITE');

-- Inserting product variants for "Gold Necklace" (Material and Length)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES
    (2, 'Material', 'Gold', 149.99, 50, 'NECKLACE-GOLD'),
    (2, 'Length', '18 inches', 149.99, 50, 'NECKLACE-18'),
    (2, 'Length', '24 inches', 159.99, 50, 'NECKLACE-24');

-- Inserting product variants for "Wall Art" (Size)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES
    (3, 'Size', 'Small', 79.99, 100, 'ART-SMALL'),
    (3, 'Size', 'Large', 119.99, 100, 'ART-LARGE');

-- Inserting product variants for "Silver Bracelet" (Size and Color)
INSERT INTO product_variants (product_id, variant_name, variant_value, price, stock_quantity, sku)
VALUES
    (4, 'Color', 'Silver', 89.99, 60, 'BRACELET-SILVER'),
    (4, 'Size', 'Small', 89.99, 60, 'BRACELET-S'),
    (4, 'Size', 'Medium', 89.99, 60, 'BRACELET-M');
