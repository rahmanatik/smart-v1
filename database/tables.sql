CREATE TABLE `user` (
  `id` int(10) NOT null AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_status_type` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `hash_version` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `customer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `customer_status_type` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `category` (
  `id` int(10) NOT null AUTO_INCREMENT,
  `parent_id` int(10),
  `category_name` varchar(255) NOT NULL,
  `level` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`),
  KEY `category_name` (`category_name`),
  KEY `parent_id` (`parent_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `item` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_number` varchar(255),
  `description` varchar(255) NOT NULL,
  `purchase_price` decimal(15, 2) NOT NULL,
  `sale_price` decimal(15, 2) NOT NULL,
  `quantity` decimal(15, 3) NOT NULL DEFAULT '0',
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `online` char(1) NOT NULL DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`),
  KEY `item_name` (`item_name`),
  KEY `category_id` (`category_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `image` (
  `id` int(10) NOT null AUTO_INCREMENT,
  `item_id` int(10) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `image_type` varchar(10) NOT NULL DEFAULT 'FRONT',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_address` varchar(255) NULL,
  `delivery_type` varchar(10) NOT NULL DEFAULT 'HOME',
  `comment` text DEFAULT NULL,
  `order_type` varchar(10) NOT NULL DEFAULT 'SALE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `user_id` (`user_id`),
  KEY `created_at` (`created_at`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `order_item` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `quantity_purchased` decimal(15, 3) NOT NULL DEFAULT '0',
  `purchase_price` decimal(15, 2) NOT NULL,
  `sale_price` decimal(15, 2) NOT NULL,
  `discount` decimal(15, 2) NOT NULL DEFAULT '0',
  `discount_type` varchar(10) NOT NULL DEFAULT 'PRICE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `item_id` (`item_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `order_status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL DEFAULT '0',
  `status_type` varchar(10) NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `session` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10),
  `ip_address` varchar(45) NOT NULL,
  `data` blob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `login_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10),
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(30),
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


-- Constrains
ALTER TABLE `customer`
 ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `item`
 ADD CONSTRAINT FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
ALTER TABLE `image`
 ADD CONSTRAINT FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);
ALTER TABLE `order`
 ADD CONSTRAINT FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
 ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `order_item`
 ADD CONSTRAINT FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
 ADD CONSTRAINT FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);
ALTER TABLE `order_status`
 ADD CONSTRAINT FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);


