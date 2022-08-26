CREATE DATABASE IF NOT EXISTS `PRODUCTS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `PRODUCTS`;

CREATE TABLE `PRODUCT` (
  `product_name` VARCHAR(42),
  `description` VARCHAR(42),
  `picture` VARCHAR(42),
  `price` VARCHAR(42),
  `rate` VARCHAR(42),
  `status` VARCHAR(42),
  `brand_name` VARCHAR(42),
  `category_name` VARCHAR(42),
  `type_name` VARCHAR(42),
  PRIMARY KEY (`product_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `BRAND` (
  `brand_name` VARCHAR(42),
  `footer_order` VARCHAR(42),
  PRIMARY KEY (`brand_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `TYPE` (
  `type_name` VARCHAR(42),
  `footer_order` VARCHAR(42),
  PRIMARY KEY (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `CATEGORY` (
  `category_name` VARCHAR(42),
  `subtitle` VARCHAR(42),
  `picture` VARCHAR(42),
  `home_order` VARCHAR(42),
  PRIMARY KEY (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `PRODUCT` ADD FOREIGN KEY (`type_name`) REFERENCES `TYPE` (`type_name`);
ALTER TABLE `PRODUCT` ADD FOREIGN KEY (`category_name`) REFERENCES `CATEGORY` (`category_name`);
ALTER TABLE `PRODUCT` ADD FOREIGN KEY (`brand_name`) REFERENCES `BRAND` (`brand_name`);