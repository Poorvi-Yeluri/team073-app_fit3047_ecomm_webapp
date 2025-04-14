DROP DATABASE IF EXISTS fit3047_app;
CREATE DATABASE fit3047_app;
USE fit3047_app;

-- Drop existing tables
DROP TABLE IF EXISTS cart_items;
DROP TABLE IF EXISTS contact_messages;
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS product_variants;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

-- Users table
CREATE TABLE users
(
    id           INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name   VARCHAR(255) NOT NULL,
    last_name    VARCHAR(255),
    email        VARCHAR(255) NOT NULL UNIQUE,
    password     VARCHAR(255) NOT NULL,
    phone        VARCHAR(255),
    nonce        VARCHAR(255),
    nonce_expiry DATETIME,
    created      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE products
(
    id             INT            NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(255)   NOT NULL,
    description    TEXT,
    category       VARCHAR(255)   NOT NULL,
    base_price     DECIMAL(10, 2) NOT NULL,
    stock_quantity INT            NOT NULL,
    created_at     DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    image_url      VARCHAR(255)   NOT NULL,

    FULLTEXT KEY (name, description, category)
);

-- Product variants table
CREATE TABLE product_variants
(
    id             INT            NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id     INT            NOT NULL,
    variant_name   VARCHAR(255)   NOT NULL,
    variant_value  VARCHAR(255)   NOT NULL,
    price          DECIMAL(10, 2) NOT NULL,
    stock_quantity INT            NOT NULL,
    sku            VARCHAR(255)   NOT NULL UNIQUE,
    created_at     DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FULLTEXT KEY (variant_name, variant_value),
    FULLTEXT KEY (sku),
    FULLTEXT KEY (variant_name, variant_value, sku),
    KEY (product_id),
    CONSTRAINT FOREIGN KEY (product_id) REFERENCES products (id)
);

-- Orders table
CREATE TABLE orders
(
    id               INT                                                   NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id          INT                                                   NOT NULL,
    order_date       DATETIME                                              NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total_price      DECIMAL(10, 2)                                        NOT NULL,
    status           ENUM ('Pending', 'Shipped', 'Delivered', 'Cancelled') NOT NULL DEFAULT 'Pending',
    shipping_address TEXT                                                  NOT NULL,

    KEY (user_id),
    CONSTRAINT FOREIGN KEY (user_id) REFERENCES users (id)
);

-- Order items table
CREATE TABLE order_items
(
    id         INT            NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_id   INT            NOT NULL,
    variant_id INT            NOT NULL,
    quantity   INT            NOT NULL DEFAULT 1,
    price      DECIMAL(10, 2) NOT NULL,

    KEY (order_id),
    KEY (variant_id),
    CONSTRAINT FOREIGN KEY (order_id) REFERENCES orders (id),
    CONSTRAINT FOREIGN KEY (variant_id) REFERENCES product_variants (id)
);

-- Cart items table
CREATE TABLE cart_items
(
    id         INT      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id    INT      NOT NULL,
    variant_id INT      NOT NULL,
    quantity   INT      NOT NULL DEFAULT 1,
    added_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    KEY (user_id),
    KEY (variant_id),
    CONSTRAINT FOREIGN KEY (user_id) REFERENCES users (id),
    CONSTRAINT FOREIGN KEY (variant_id) REFERENCES product_variants (id)
);

-- Contact messages table
CREATE TABLE contact_messages
(
    id             INT                                                          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    message_type   ENUM ('General Inquiry', 'Complaint', 'Feedback', 'Support') NOT NULL,
    description    TEXT                                                         NOT NULL,
    customer_name  VARCHAR(255)                                                 NOT NULL,
    customer_email VARCHAR(255)                                                 NOT NULL,
    customer_phone VARCHAR(255)                                                 NOT NULL,
    created_at     DATETIME DEFAULT CURRENT_TIMESTAMP
);
