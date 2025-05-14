DROP DATABASE IF EXISTS fit3047_app;
CREATE DATABASE fit3047_app;
USE fit3047_app;


--
-- Table structure for table `attribute_values`
--

DROP TABLE IF EXISTS `attribute_values`;
CREATE TABLE `attribute_values` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `attribute_id` int(11) NOT NULL,
    `value` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL,
    `modified_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `attribute_id` (`attribute_id`,`value`),
    CONSTRAINT `attribute_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE
);

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE `attributes` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL,
    `modified_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
);


--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `message_type` enum('General Inquiry','Complaint','Feedback','Support') NOT NULL,
    `description` text NOT NULL,
    `customer_name` varchar(255) NOT NULL,
    `customer_email` varchar(255) NOT NULL,
    `customer_phone` varchar(255) NOT NULL,
    `created_at` datetime DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
);

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `order_id` int(11) NOT NULL,
       `variant_id` int(11) NOT NULL,
       `quantity` int(11) NOT NULL DEFAULT 1,
       `price` decimal(10,2) NOT NULL,
       PRIMARY KEY (`id`),
       KEY `order_id` (`order_id`),
       KEY `variant_id` (`variant_id`),
       CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
       CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`)
);

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `order_date` datetime NOT NULL DEFAULT current_timestamp(),
      `total_price` decimal(10,2) NOT NULL,
      `status` enum('Pending','Shipped','Delivered','Cancelled') NOT NULL DEFAULT 'Pending',
      `shipping_address` text NOT NULL,
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`),
      CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);


--
-- Table structure for table `product_attributes`
--

DROP TABLE IF EXISTS `product_attributes`;
CREATE TABLE `product_attributes` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `product_id` int(11) NOT NULL,
      `attribute_id` int(11) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `product_id` (`product_id`),
      KEY `attribute_id` (`attribute_id`),
      CONSTRAINT `product_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
      CONSTRAINT `product_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`)
);

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `product_id` int(11) NOT NULL,
      `image_url` varchar(255) NOT NULL,
      `is_main` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicates if this is the main product image',
      `created_at` datetime NOT NULL DEFAULT current_timestamp(),
      `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `product_id` (`product_id`)
);

--
-- Table structure for table `product_variant_attributes`
--

DROP TABLE IF EXISTS `product_variant_attributes`;
CREATE TABLE `product_variant_attributes` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `product_variant_id` int(11) NOT NULL,
      `attribute_value_id` int(11) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `product_variant_id` (`product_variant_id`),
      KEY `attribute_value_id` (`attribute_value_id`),
      CONSTRAINT `product_variant_attributes_ibfk_1` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
      CONSTRAINT `product_variant_attributes_ibfk_2` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE
);

--
-- Table structure for table `product_variant_images`
--

DROP TABLE IF EXISTS `product_variant_images`;
CREATE TABLE `product_variant_images` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `variant_id` int(11) NOT NULL,
      `image_url` varchar(255) NOT NULL,
      `created_at` datetime NOT NULL DEFAULT current_timestamp(),
      `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `variant_id` (`variant_id`)
);

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
CREATE TABLE `product_variants` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `price` decimal(10,2) NOT NULL,
        `stock_quantity` int(11) NOT NULL,
        `sku` varchar(255) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `modified_at` datetime DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `sku` (`sku`),
        KEY `product_id` (`product_id`),
        FULLTEXT KEY `sku_2` (`sku`),
        FULLTEXT KEY `variant_name` (`name`),
        FULLTEXT KEY `product_variants_fulltext` (`name`, `sku`),
        CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
);

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `slug` varchar(255) NOT NULL,
        `description` text DEFAULT NULL,
        `category` varchar(255) NOT NULL,
        `base_price` decimal(10,2) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `image_url` varchar(255) NOT NULL,
        PRIMARY KEY (`id`),
        FULLTEXT KEY `name` (`name`,`description`,`category`),
        FULLTEXT KEY `products_fulltext` (`name`,`description`,`category`)
);

--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `first_name` varchar(255) NOT NULL,
         `last_name` varchar(255) DEFAULT NULL,
         `email` varchar(255) NOT NULL,
         `password` varchar(255) NOT NULL,
         `phone` varchar(255) DEFAULT NULL,
         `nonce` varchar(255) DEFAULT NULL,
         `nonce_expiry` datetime DEFAULT NULL,
         `created` datetime NOT NULL DEFAULT current_timestamp(),
         `modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
         PRIMARY KEY (`id`),
         UNIQUE KEY `email` (`email`)
);

