# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.50)
# Database: just_eat
# Generation Time: 2021-11-13 15:02:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(256) NOT NULL DEFAULT '',
  `last_name` varchar(256) NOT NULL DEFAULT '',
  `email` varchar(254) NOT NULL DEFAULT '',
  `phonenumber` varchar(11) NOT NULL DEFAULT '',
  `address` varchar(256) NOT NULL DEFAULT '',
  `city` varchar(256) NOT NULL DEFAULT '',
  `postcode` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_number` (`phonenumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `phonenumber`, `address`, `city`, `postcode`)
VALUES
	(1,'sadio','mane','sadio@mane.com','2147483647','123 liverpool street','liverpool','an4 li9'),
	(6,'jame','mill','jame@mill.com','07898765432','64 zoo lane','zoo','z11 oo2'),
	(7,'Friedrich','Hartmann','Clovis.Kassulke20@yahoo.com','07123456789','4717 Bode Haven','Pagacfurt','bd8 9nr'),
	(8,'Deondre','Wintheiser','Allie_Ullrich@hotmail.com','3423424234','6996 Adella Station','Allenetown','bd16 1tz');

/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table delivery_methods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `delivery_methods`;

CREATE TABLE `delivery_methods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(254) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `delivery_methods` WRITE;
/*!40000 ALTER TABLE `delivery_methods` DISABLE KEYS */;

INSERT INTO `delivery_methods` (`id`, `name`)
VALUES
	(1,'collection'),
	(2,'delivery');

/*!40000 ALTER TABLE `delivery_methods` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table extra_toppings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `extra_toppings`;

CREATE TABLE `extra_toppings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `extra_toppings` WRITE;
/*!40000 ALTER TABLE `extra_toppings` DISABLE KEYS */;

INSERT INTO `extra_toppings` (`id`, `name`, `price`)
VALUES
	(1,'cheese',0.90),
	(2,'chicken',1.00),
	(3,'donner',1.00),
	(4,'chillies',0.50);

/*!40000 ALTER TABLE `extra_toppings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_item_extras
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_item_extras`;

CREATE TABLE `order_item_extras` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `extra_toppings_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order_item_extras` WRITE;
/*!40000 ALTER TABLE `order_item_extras` DISABLE KEYS */;

INSERT INTO `order_item_extras` (`id`, `order_id`, `extra_toppings_id`)
VALUES
	(41,11,4),
	(42,12,4),
	(43,13,2),
	(44,13,3),
	(45,14,2),
	(46,16,4),
	(47,17,4),
	(48,18,2),
	(49,18,3),
	(50,19,2),
	(51,21,4),
	(52,22,4),
	(53,23,2),
	(54,23,3),
	(55,24,2),
	(56,26,2),
	(57,26,3),
	(58,28,4),
	(59,32,2),
	(60,32,3),
	(61,34,3),
	(62,34,4),
	(63,36,1),
	(64,36,2),
	(65,36,3),
	(66,36,4),
	(67,38,2),
	(68,38,3),
	(69,41,1),
	(70,41,2),
	(71,41,4);

/*!40000 ALTER TABLE `order_item_extras` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(20) NOT NULL DEFAULT '0',
  `pizza_type_id` int(20) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;

INSERT INTO `order_items` (`id`, `order_id`, `pizza_type_id`, `qty`)
VALUES
	(11,17,4,1),
	(12,17,3,1),
	(13,17,7,1),
	(14,17,1,2),
	(15,17,2,1),
	(16,18,4,1),
	(17,18,3,1),
	(18,18,7,1),
	(19,18,1,2),
	(20,18,2,1),
	(21,19,4,1),
	(22,19,3,1),
	(23,19,7,1),
	(24,19,1,2),
	(25,19,2,1),
	(26,20,2,1),
	(27,20,5,1),
	(28,21,7,1),
	(29,21,2,1),
	(30,22,3,1),
	(31,23,8,1),
	(32,24,5,1),
	(33,25,2,1),
	(34,26,6,1),
	(35,26,1,1),
	(36,27,8,1),
	(37,27,1,1),
	(38,28,8,1),
	(39,28,4,2),
	(40,28,6,1),
	(41,29,2,1);

/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT '1',
  `delivery_method_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `paid` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;

INSERT INTO `orders` (`id`, `hash`, `customer_id`, `status_id`, `delivery_method_id`, `total`, `paid`, `created_at`, `updated_at`)
VALUES
	(17,NULL,7,1,NULL,64.50,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(18,NULL,7,1,NULL,64.50,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(19,NULL,7,1,NULL,64.50,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(20,NULL,8,1,NULL,16.50,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(21,'ee93394843cfc58d22c9e396579bc5645c2edf977028a853301bcb390e38a39c',7,1,NULL,17.00,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(22,'722284548873dae6bba33d3dad7bad7f2d88a3f6aea362e19beee6fddba5c057',8,1,NULL,8.50,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(23,'775b47bc5a2c853c79c5ed58a0929a11f5c2eccd8835877c29aba11f97147266',8,1,NULL,9.50,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(24,'bad0f88a92905aed34f9ce1c94e00c5bec23a6eae29687037bd0c92732246d04',7,1,NULL,9.50,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(25,'783b5812553fae755b228b1916ec7a46d1baf9de21128644c90b9bd1f1cef240',7,1,NULL,7.00,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(26,'646282ef334c4ad40076e6cfcd3479ebbfa15fedf3008ff6b77b71e241dbaba2',8,1,NULL,15.50,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(27,'69cf3c281549c6f13954197d17d6ede4d56c1380e766db87811d9c3295642724',7,1,NULL,21.30,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(28,'ef878ada47d36a97792c39e62be0d772c0bb080b41654529ae892cefa103197e',8,1,NULL,39.00,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(29,'63acd4303992afa58d6808f140d4cba03dfd4ec8d04ea4168801e00148920feb',8,1,NULL,11.80,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(30,'65b972befca8eb9aa56f740e99b6625abe63b52e6d8609a5f15d36223bb1357f',8,1,NULL,0.00,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(31,'c109d3dfa933e98b8c93a3c2e184c2e1da144377557b8bae5349af1287f3a158',8,1,NULL,0.00,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(32,'c4c12c0dfe6df77ce59c49e196db51477f73525c131f258c8454c65ed97fcc24',8,1,NULL,0.00,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(33,'1e616936aecd7569f1bc26b1123637ace59ae6b5d544af1d6e76e2e8e93075f6',8,1,NULL,0.00,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(34,'823e320d7a6451a7beda7ebad552a83713000266da092080d13164d893e98dbe',8,1,NULL,0.00,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table payments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `successfull` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_At` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;

INSERT INTO `payments` (`id`, `order_id`, `transaction_id`, `successfull`, `created_at`, `updated_At`)
VALUES
	(1,20,0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,21,0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,22,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,23,5,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(5,24,85,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(6,25,41,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(7,26,0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(8,27,0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(9,28,40,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(10,29,0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pizza_sizes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pizza_sizes`;

CREATE TABLE `pizza_sizes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `size` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pizza_sizes` WRITE;
/*!40000 ALTER TABLE `pizza_sizes` DISABLE KEYS */;

INSERT INTO `pizza_sizes` (`id`, `size`)
VALUES
	(1,'12\" Deep'),
	(2,'12\" Stuffed Crust'),
	(3,'16\" Thin Family'),
	(4,'12\" Stuffed Calzone');

/*!40000 ALTER TABLE `pizza_sizes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pizza_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pizza_types`;

CREATE TABLE `pizza_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pizza_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pizza_types` WRITE;
/*!40000 ALTER TABLE `pizza_types` DISABLE KEYS */;

INSERT INTO `pizza_types` (`id`, `pizza_id`, `size_id`, `price`, `created_at`, `updated_at`)
VALUES
	(1,1,1,5.00,'2021-09-10 07:08:45',NULL),
	(2,1,2,7.00,'2021-09-10 07:09:06',NULL),
	(3,1,3,8.50,'2021-09-10 07:09:20',NULL),
	(4,1,4,9.00,'2021-09-10 07:09:34',NULL),
	(5,2,1,5.50,'2021-09-13 08:14:07',NULL),
	(6,2,2,7.50,'2021-09-13 08:14:21',NULL),
	(7,2,3,9.00,'2021-09-13 08:15:11',NULL),
	(8,2,4,9.50,'2021-09-13 08:15:14',NULL);

/*!40000 ALTER TABLE `pizza_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pizzas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pizzas`;

CREATE TABLE `pizzas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pizzas` WRITE;
/*!40000 ALTER TABLE `pizzas` DISABLE KEYS */;

INSERT INTO `pizzas` (`id`, `name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Queen Margherita Pizza','Mozzarella cheese, tomato sauce & herbs','2021-09-10 07:05:59',NULL),
	(2,'Cheese & Onion Pizza','Mozzarella cheese, tomato sauce, onions & herbs','2021-09-13 08:13:43',NULL);

/*!40000 ALTER TABLE `pizzas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;

INSERT INTO `status` (`id`, `name`)
VALUES
	(1,'recived'),
	(2,'accepted'),
	(3,'ready for collection'),
	(4,'out for delivery'),
	(5,'rejected');

/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
