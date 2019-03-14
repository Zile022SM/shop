-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2018 at 02:45 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `last_name`, `email`, `password`, `role`) VALUES
(4, 'Zile', 'Kuzminac', 'zile.zile@gmail.com', 'ZileZile', 'Admin'),
(6, 'Zdravko', 'Surlan', 'sule.sule@gmail.com', 'SuleSule', 'Moderator');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `blog_text` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `user_name`, `title`, `time`, `date`, `blog_text`, `image`) VALUES
(4, 'Test User', 'Test blog', '01:33:20', '2018-10-29', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', '3894133980_7e38f821fa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`) VALUES
(1, 'MEN\'S FASHION'),
(2, 'WOMEN\'S FASHION'),
(3, 'KIDS FASHION');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `orderItemId` int(11) NOT NULL,
  `orderItems` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`orderItemId`, `orderItems`) VALUES
(108, 'a:4:{i:71;a:7:{s:10:\"id_product\";s:2:\"71\";s:4:\"name\";s:10:\"Adidas cap\";s:5:\"price\";s:3:\"100\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:100;s:8:\"discount\";N;s:5:\"image\";s:100:\"yrc3t7-l-610x610-hat-adidas-adidas+originals-adidas+original-adidaswomen-adidas+men-cap-snapback.jpg\";}i:63;a:7:{s:10:\"id_product\";s:2:\"63\";s:4:\"name\";s:18:\"Under armour shoes\";s:5:\"price\";s:3:\"300\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:300;s:8:\"discount\";N;s:5:\"image\";s:115:\"Under-Armour-UA-clhtchfit-drive-men-Running-Shoes-Outdoor-Sports-Shoes-Sneakers-men-s-Running-Shoes.jpg_640x640.jpg\";}i:14;a:7:{s:10:\"id_product\";s:2:\"14\";s:4:\"name\";s:12:\"Adidas shoes\";s:5:\"price\";s:3:\"290\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:290;s:8:\"discount\";N;s:5:\"image\";s:27:\"MambaRank-adidas-KB8-II.jpg\";}i:13;a:7:{s:10:\"id_product\";s:2:\"13\";s:4:\"name\";s:21:\"Nike Air jordan shoes\";s:5:\"price\";s:3:\"225\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:225;s:8:\"discount\";s:2:\"10\";s:5:\"image\";s:16:\"9GIep8bl-537.jpg\";}}'),
(109, 'a:3:{i:10;a:7:{s:10:\"id_product\";s:2:\"10\";s:4:\"name\";s:21:\"Nike Air jordan shoes\";s:5:\"price\";s:3:\"315\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:315;s:8:\"discount\";s:2:\"30\";s:5:\"image\";s:29:\"shoes_nike_air_jordan_13c.jpg\";}i:63;a:7:{s:10:\"id_product\";s:2:\"63\";s:4:\"name\";s:18:\"Under armour shoes\";s:5:\"price\";s:3:\"300\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:300;s:8:\"discount\";N;s:5:\"image\";s:115:\"Under-Armour-UA-clhtchfit-drive-men-Running-Shoes-Outdoor-Sports-Shoes-Sneakers-men-s-Running-Shoes.jpg_640x640.jpg\";}i:11;a:7:{s:10:\"id_product\";s:2:\"11\";s:4:\"name\";s:21:\"Nike Air jordan shoes\";s:5:\"price\";s:3:\"270\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:270;s:8:\"discount\";s:2:\"10\";s:5:\"image\";s:36:\"e0831cba60801afc279c3c7786f5df84.jpg\";}}'),
(110, 'a:3:{i:68;a:7:{s:10:\"id_product\";s:2:\"68\";s:4:\"name\";s:11:\"Adidas kids\";s:5:\"price\";s:3:\"150\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:150;s:8:\"discount\";N;s:5:\"image\";s:15:\"adidas kids.jpg\";}i:67;a:7:{s:10:\"id_product\";s:2:\"67\";s:4:\"name\";s:21:\"Adidas sweatsuit kids\";s:5:\"price\";s:3:\"150\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:150;s:8:\"discount\";N;s:5:\"image\";s:65:\"6966_ORIG_DA_adicolorKids-TC_D2-desktop_640x480_tcm221-271957.jpg\";}i:70;a:7:{s:10:\"id_product\";s:2:\"70\";s:4:\"name\";s:21:\"Adidas sweatsuit kids\";s:5:\"price\";s:3:\"100\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:100;s:8:\"discount\";N;s:5:\"image\";s:36:\"51b293ee3e15dfbdd161cec0323a814a.jpg\";}}'),
(111, 'a:5:{i:15;a:7:{s:10:\"id_product\";s:2:\"15\";s:4:\"name\";s:12:\"Adidas shoes\";s:5:\"price\";s:3:\"225\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:225;s:8:\"discount\";s:2:\"10\";s:5:\"image\";s:10:\"s-l300.jpg\";}i:10;a:7:{s:10:\"id_product\";s:2:\"10\";s:4:\"name\";s:21:\"Nike Air jordan shoes\";s:5:\"price\";s:3:\"315\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:315;s:8:\"discount\";s:2:\"30\";s:5:\"image\";s:29:\"shoes_nike_air_jordan_13c.jpg\";}i:6;a:7:{s:10:\"id_product\";s:1:\"6\";s:4:\"name\";s:8:\"Nike cap\";s:5:\"price\";s:3:\"135\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:135;s:8:\"discount\";s:2:\"10\";s:5:\"image\";s:87:\"kisspng-baseball-cap-nike-hat-fullcap-snapback-5ad75821366dc8.307631221524062241223.jpg\";}i:11;a:7:{s:10:\"id_product\";s:2:\"11\";s:4:\"name\";s:21:\"Nike Air jordan shoes\";s:5:\"price\";s:3:\"270\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:270;s:8:\"discount\";s:2:\"10\";s:5:\"image\";s:36:\"e0831cba60801afc279c3c7786f5df84.jpg\";}i:12;a:7:{s:10:\"id_product\";s:2:\"12\";s:4:\"name\";s:21:\"Nike Air jordan shoes\";s:5:\"price\";s:3:\"245\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:245;s:8:\"discount\";s:2:\"30\";s:5:\"image\";s:29:\"shoes_nike_air_jordan_12c.jpg\";}}'),
(112, 'a:3:{i:69;a:7:{s:10:\"id_product\";s:2:\"69\";s:4:\"name\";s:10:\"Nike shoes\";s:5:\"price\";s:3:\"100\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:100;s:8:\"discount\";N;s:5:\"image\";s:23:\"1495780-p-MULTIVIEW.jpg\";}i:63;a:7:{s:10:\"id_product\";s:2:\"63\";s:4:\"name\";s:18:\"Under armour shoes\";s:5:\"price\";s:3:\"300\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:300;s:8:\"discount\";N;s:5:\"image\";s:115:\"Under-Armour-UA-clhtchfit-drive-men-Running-Shoes-Outdoor-Sports-Shoes-Sneakers-men-s-Running-Shoes.jpg_640x640.jpg\";}i:25;a:7:{s:10:\"id_product\";s:2:\"25\";s:4:\"name\";s:18:\"Under armour shoes\";s:5:\"price\";s:3:\"200\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:200;s:8:\"discount\";N;s:5:\"image\";s:72:\"speedform-gemini-9-under-armour-black-red-original-imaewh7vtwekbfse.jpeg\";}}'),
(118, 'a:1:{i:77;a:7:{s:10:\"id_product\";s:2:\"77\";s:4:\"name\";s:12:\"Dior t-shirt\";s:5:\"price\";s:3:\"100\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:100;s:8:\"discount\";N;s:5:\"image\";s:29:\"t-shirt-it-s-dior-darling.jpg\";}}'),
(120, 'a:1:{i:71;a:7:{s:10:\"id_product\";s:2:\"71\";s:4:\"name\";s:10:\"Adidas cap\";s:5:\"price\";s:3:\"100\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:100;s:8:\"discount\";N;s:5:\"image\";s:100:\"yrc3t7-l-610x610-hat-adidas-adidas+originals-adidas+original-adidaswomen-adidas+men-cap-snapback.jpg\";}}'),
(121, 'a:1:{i:71;a:7:{s:10:\"id_product\";s:2:\"71\";s:4:\"name\";s:10:\"Adidas cap\";s:5:\"price\";s:3:\"100\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:100;s:8:\"discount\";N;s:5:\"image\";s:100:\"yrc3t7-l-610x610-hat-adidas-adidas+originals-adidas+original-adidaswomen-adidas+men-cap-snapback.jpg\";}}'),
(122, 'a:1:{i:71;a:7:{s:10:\"id_product\";s:2:\"71\";s:4:\"name\";s:10:\"Adidas cap\";s:5:\"price\";s:3:\"100\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:100;s:8:\"discount\";N;s:5:\"image\";s:100:\"yrc3t7-l-610x610-hat-adidas-adidas+originals-adidas+original-adidaswomen-adidas+men-cap-snapback.jpg\";}}'),
(123, 'a:3:{i:71;a:7:{s:10:\"id_product\";s:2:\"71\";s:4:\"name\";s:10:\"Adidas cap\";s:5:\"price\";s:3:\"100\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:100;s:8:\"discount\";N;s:5:\"image\";s:100:\"yrc3t7-l-610x610-hat-adidas-adidas+originals-adidas+original-adidaswomen-adidas+men-cap-snapback.jpg\";}i:63;a:7:{s:10:\"id_product\";s:2:\"63\";s:4:\"name\";s:18:\"Under armour shoes\";s:5:\"price\";s:3:\"300\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:300;s:8:\"discount\";N;s:5:\"image\";s:115:\"Under-Armour-UA-clhtchfit-drive-men-Running-Shoes-Outdoor-Sports-Shoes-Sneakers-men-s-Running-Shoes.jpg_640x640.jpg\";}i:66;a:7:{s:10:\"id_product\";s:2:\"66\";s:4:\"name\";s:12:\"Adidas shoes\";s:5:\"price\";s:3:\"200\";s:8:\"quantity\";s:1:\"1\";s:11:\"totalByItem\";i:200;s:8:\"discount\";N;s:5:\"image\";s:14:\"adiasWomen.jpg\";}}');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `time` date NOT NULL,
  `orderStatus` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `user_id`, `name`, `last_name`, `address`, `email`, `phone`, `time`, `orderStatus`) VALUES
(108, 7, 'Zile', 'Kuzminac', 'Mihajla pupina', 'zile.zile@gmail.com', '0645678321', '2018-11-03', 'delivered'),
(109, 7, 'Zile', 'Kuzminac', 'Mihajla pupina', 'zile.zile@gmail.com', '0645678321', '2018-11-03', 'delivered'),
(110, 7, 'Zile', 'Kuzminac', 'Mihajla pupina', 'zile.zile@gmail.com', '0645678321', '2018-11-03', 'delivered'),
(111, 7, 'Zile', 'Kuzminac', 'Mihajla pupina', 'zile.zile@gmail.com', '0645678321', '2018-11-03', 'delivered'),
(112, 7, 'Zile', 'Kuzminac', 'Mihajla pupina', 'zile.zile@gmail.com', '0645678321', '2018-11-04', 'delivered'),
(118, 10, 'Sima', 'Milosevic', 'Palmoticeva 22', 'sima.sima@gmail.com', '0637435399', '2018-11-04', 'delivered'),
(120, 10, 'Sima', 'Milosevic', 'Palmoticeva 22', 'sima.sima@gmail.com', '0637435399', '2018-11-04', 'delivered'),
(121, 10, 'Sima', 'Milosevic', 'Palmoticeva 22', 'sima.sima@gmail.com', '+381112225540', '2018-11-04', 'delivered'),
(122, 7, 'Zile', 'Kuzminac', 'Mihajla pupina', 'zile.zile@gmail.com', '0645678321', '2018-11-05', 'delivered'),
(123, 7, 'Zile', 'Kuzminac', 'Mihajla pupina', 'zile.zile@gmail.com', '0645678321', '2018-11-05', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `discount_price` double DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `cart_quantity` int(11) NOT NULL DEFAULT '1',
  `type` varchar(255) NOT NULL COMMENT 't-shirt,watch...',
  `sub_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name`, `price`, `discount_price`, `discount`, `img`, `description`, `cart_quantity`, `type`, `sub_cat_id`) VALUES
(1, 'Nike t-shirt', 200, 140, 30, '12119100ot_12_f.jpg', 'T-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirtT-shirt', 1, 't-shirt', 1),
(2, 'Nike t-shirt 01', 250, 225, 10, 'nike01.jpg', 'Nike t-shirtNike t-shirtNike t-shirtNike t-shirt', 1, 't-shirt', 1),
(3, 'Nike t-shirt', 150, 135, 10, 's-l225.jpg', 't-shirtt-shirtt-shirtt-shirtt-shirtt-shirtt-shirtt-shirtt-shirt', 1, 't-shirt', 1),
(5, 'Nike cap', 100, 50, 50, 'U_NSW_PRO_CAP_NIKE_AIR-BLACK_BLACK_WHITE-1.jpg', 'Nike capNike capNike capNike capNike capNike capNike capNike cap', 1, 'cap', 1),
(6, 'Nike cap', 150, 135, 10, 'kisspng-baseball-cap-nike-hat-fullcap-snapback-5ad75821366dc8.307631221524062241223.jpg', 'Nike capNike capNike capNike capNike capNike capNike cap', 1, 'cap', 1),
(9, 'Adidas sweatsuit', 350, 245, 30, '5a698eaeef39fAdidas-sweats_t-cy3483_-1_Front_website.jpg', 'Adidas sweatsuitAdidas sweatsuitAdidas sweatsuitAdidas sweatsuit', 1, 'sweatsuit', 3),
(10, 'Nike Air jordan shoes', 450, 315, 30, 'shoes_nike_air_jordan_13c.jpg', 'air jordanair jordanair jordanair jordanair jordanair jordan', 1, 'shoes', 1),
(11, 'Nike Air jordan shoes', 300, 270, 10, 'e0831cba60801afc279c3c7786f5df84.jpg', 'Nike Air jordan shoes', 1, 'shoes', 1),
(12, 'Nike Air jordan shoes', 350, 245, 30, 'shoes_nike_air_jordan_12c.jpg', 'Nike Air jordan shoes', 1, 'shoes', 1),
(13, 'Nike Air jordan shoes', 250, 225, 10, '9GIep8bl-537.jpg', 'Nike Air jordan shoes', 1, 'shoes', 1),
(14, 'Adidas shoes', 290, NULL, NULL, 'MambaRank-adidas-KB8-II.jpg', 'adidas shoesadidas shoesadidas shoesadidas shoesadidas shoesadidas shoesadidas shoes', 1, 'shoes', 3),
(15, 'Adidas shoes', 250, 225, 10, 's-l300.jpg', 'Adidas shoes', 1, 'shoes', 3),
(16, 'Puma shoes', 200, NULL, NULL, 'shoes_ia75212.jpg', 'puma shoespuma shoespuma shoespuma shoespuma shoespuma shoespuma shoespuma shoespuma shoes', 1, 'shoes', 4),
(17, 'Puma shoes', 200, 180, 10, '415QKLO5YcL._US500_.jpg', 'puma shoespuma shoespuma shoespuma shoespuma shoes', 1, 'shoes', 4),
(18, 'Adidas switsuit', 300, 270, 10, 'Screenshot_20180308-202548_1200x1200.jpg', 'adidas tresaadidas tresaadidas tresaadidas tresaadidas tresa', 1, 'sweatsuit', 3),
(19, 'Puma sweatsuit', 400, 360, 10, '09102012 combo 6 copy.jpg', 'puma sweatsuit', 1, 'sweatsuit', 4),
(20, 'Nike sweatsuit', 400, 280, 30, '0306f_uKAXdZk3nB4Hy5eyidcJ7gDF.jpeg', 'nike tresanike tresanike tresanike tresanike tresa', 1, 'sweatsuit', 1),
(21, 'Puma sweatsuit', 300, 210, 30, 'puma.jpg', 'PumaPumaPumaPumaPumaPumaPumaPumaPuma', 1, 'sweatsuit', 4),
(22, 'Adidas sweatsuit', 300, 270, 10, '1c9e2409285bbfc69106cf2f07a88e25.jpg', 'adidasadidasadidasadidasadidasadidasadidas', 1, 'sweatsuit', 3),
(25, 'Under armour shoes', 200, NULL, NULL, 'speedform-gemini-9-under-armour-black-red-original-imaewh7vtwekbfse.jpeg', 'bls blsbls blsbls blsbls bls', 1, 'shoes', 2),
(26, 'Under Armour', 200, NULL, NULL, '59063201_xxl-1400x1400.jpg', 't shirtt shirtt shirtt shirtt shirt', 1, 't-shirt', 2),
(27, 'Under Armour cap', 150, NULL, NULL, '36809003_l.jpg', 'capcapcapcapcap', 1, 'cap', 2),
(28, 'Under Armour sweatsuit', 200, NULL, NULL, '81DSiszE1WL._UY445_.jpg', 'sweatsuitsweatsuitsweatsuitsweatsuitsweatsuit', 1, 'sweatsuit', 2),
(29, 'Under Armour t-shirt', 150, NULL, NULL, '59063203_l.jpg', 'bla blabla blabla blabla bla', 1, 't-shirt', 2),
(30, 'Under Armour t-shirt', 100, 90, 10, 'ps1271828-300_f.jpg', '', 1, 't-shirt', 2),
(31, 'Under Armour cap', 150, NULL, NULL, 'images.jpg', 'capcapcapcapcapcap', 1, 'cap', 2),
(33, 'Adidas cap', 100, 70, 30, '$_35.JPG', 'capcapcapcap', 1, 'cap', 3),
(34, 'Adidas cap', 100, NULL, NULL, '3534522.jpg', 'capcapcapcapcap', 1, 'cap', 3),
(35, 'Nike cap', 120, NULL, NULL, '1.jpg', 'capcapcapcap', 1, 'cap', 1),
(36, 'Puma cap', 180, 162, 10, '053233-01.jpg', 'capcapcap', 1, 'cap', 4),
(37, 'Puma cap', 150, NULL, NULL, '$_3.JPG', 'cap', 1, 'cap', 4),
(38, 'Fendi cap', 150, 105, 30, 'fendi-black-multi-monster-wool-baseball-cap-black-product-1-892828619-normal.jpeg', 'capcapcapcapcap', 1, 'cap', 6),
(39, 'Fendi Cap', 150, 135, 10, 'fendi-women-hats-brown.jpg', 'capcapcap', 1, 'cap', 6),
(40, 'Fendi cap', 100, NULL, NULL, 'o_fendi-men-women-baseball-hat-casquette-leisure-cap-0d37.jpg', 'capcapcapcap', 1, 'cap', 6),
(41, 'Fendi sweatsuit', 350, 315, 10, 'fendi-little-monster-sweat-suit-zip-hoodie-biker-jacket-a-fendi-shirt-dhgate.jpg', 'sweatsuitsweatsuitsweatsuitsweatsuitsweatsuit', 1, 'sweatsuit', 6),
(43, 'Pollino shoes', 250, 225, 10, 'originalslika_Pollino-cizme-br-28-169568117.jpg', 'polinopolinopolinopolinopolino', 1, 'shoes', 14),
(44, 'Nike shoes', 300, NULL, NULL, 'Nike-Air-Pegasus-33-Running-SDL852438294-1-4a4d4.jpeg', 'Nike shoesNike shoesNike shoesNike shoesNike shoesv', 1, 'shoes', 1),
(45, 'Fendi shoes', 260, NULL, NULL, 'multiple-colors-leather-fendi-shoes-new-more-size-flats.jpg', 'Fendi shoesFendi shoesFendi shoesFendi shoesFendi shoes', 1, 'shoes', 6),
(46, 'Nike shoes', 280, NULL, NULL, '10-best-nike-2017-10.jpg', 'Nike shoesNike shoesNike shoesNike shoesNike shoes', 1, 'shoes', 1),
(47, 'Dior sweatsuit women', 200, NULL, NULL, '20131176571694656.jpg', 'Dior sweatsuit womenDior sweatsuit womenDior sweatsuit womenDior sweatsuit womenDior sweatsuit womenDior sweatsuit womenDior sweatsuit womenDior sweatsuit womenDior sweatsuit womenDior sweatsuit womenDior sweatsuit women', 1, 'sweatsuit', 9),
(57, 'Nike t-shirt', 150, NULL, NULL, '9702363_fpx.tif.jpg', 't-shirtt-shirtt-shirtt-shirtt-shirt', 1, 't-shirt', 1),
(58, 'Nike shoes', 150, NULL, NULL, 'odyssey-react-mens-running-shoe-ODEY0A.jpg', 'nike shoes', 1, 'shoes', 1),
(61, 'fendi t shirt', 80, NULL, NULL, '2083753_0.jpg', 't shirtt shirtt shirtt shirtt shirtt shirt', 1, 't-shirt', 6),
(62, 'Under armour shoes', 250, NULL, NULL, '81aHTRpPt1L._UX395_.jpg', '', 1, 'shoes', 2),
(63, 'Under armour shoes', 300, NULL, NULL, 'Under-Armour-UA-clhtchfit-drive-men-Running-Shoes-Outdoor-Sports-Shoes-Sneakers-men-s-Running-Shoes.jpg_640x640.jpg', '', 1, 'shoes', 2),
(64, 'Adidas sweatsuit', 300, NULL, NULL, '81DXqfqUV8L._SY355_.jpg', '', 1, 'sweatsuit', 3),
(65, 'Adidas sweatsuit', 200, NULL, NULL, '8d303718a4987df4cd08389824b62ab3.jpg', '', 1, 'sweatsuit', 15),
(66, 'Adidas shoes', 200, NULL, NULL, 'adiasWomen.jpg', '', 1, 'shoes', 15),
(67, 'Adidas sweatsuit kids', 150, NULL, NULL, '6966_ORIG_DA_adicolorKids-TC_D2-desktop_640x480_tcm221-271957.jpg', '', 1, 'sweatsuit', 16),
(68, 'Adidas kids', 150, NULL, NULL, 'adidas kids.jpg', '', 1, 'shoes', 16),
(69, 'Nike shoes', 100, NULL, NULL, '1495780-p-MULTIVIEW.jpg', '', 1, 'shoes', 17),
(70, 'Adidas sweatsuit kids', 100, NULL, NULL, '51b293ee3e15dfbdd161cec0323a814a.jpg', '', 1, 'sweatsuit', 16),
(71, 'Adidas cap', 100, NULL, NULL, 'yrc3t7-l-610x610-hat-adidas-adidas+originals-adidas+original-adidaswomen-adidas+men-cap-snapback.jpg', '', 1, 'cap', 3),
(72, 'Adidas sweatsuit', 200, NULL, NULL, '229d0ba632596412ee2d5d00a0b42a99.jpg', '', 1, 'sweatsuit', 15),
(74, 'Dior cap', 250, NULL, NULL, 'dior-baseball-cap.jpg', '', 1, 'cap', 9),
(77, 'Dior t-shirt', 100, NULL, NULL, 't-shirt-it-s-dior-darling.jpg', '', 1, 't-shirt', 9),
(80, 'nike kids sweatsuit', 100, NULL, NULL, '3edc0e390948454cfcc0f839feca9ae7.jpg', '', 1, 'sweatsuit', 17),
(83, 'Puma t-shirt', 100, NULL, NULL, 'sporty-navy-glossy-women-s-puma-t-shirt-.jpg', '', 1, 't-shirt', 18);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`sub_id`, `sub_name`, `category_id`) VALUES
(1, 'NIKE', 1),
(2, 'UNDER ARMOUR', 1),
(3, 'ADIDAS', 1),
(4, 'PUMA', 1),
(6, 'FENDI', 2),
(9, 'DIOR', 2),
(14, 'POLLINO', 3),
(15, 'ADIDAS', 2),
(16, 'ADIDAS ', 3),
(17, 'NIKE', 3),
(18, 'PUMA', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `name`, `last_name`, `address`, `email`, `password`, `phone`) VALUES
(7, 'Zile', 'Kuzminac', 'Mihajla pupina', 'zile.zile@gmail.com', 'ZileZile', '0645678321'),
(8, 'Zdravko', 'Surlan', 'Savska', 'sule.sule@gmail.com', 'SuleSUle89', '0647435399'),
(10, 'Sima', 'Milosevic', 'Palmoticeva 22', 'sima.sima@gmail.com', 'SimaSimaSima', '0637435399');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD KEY `orderItemId` (`orderItemId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `sub_cat_id` (`sub_cat_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_3` FOREIGN KEY (`orderItemId`) REFERENCES `orders` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`sub_cat_id`) REFERENCES `subcategories` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
