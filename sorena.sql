-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2022 at 05:36 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sorena`
--

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

DROP TABLE IF EXISTS `reserve`;
CREATE TABLE IF NOT EXISTS `reserve` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_uid` int(11) DEFAULT NULL,
  `r_code_meli` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_name` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_fname` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_tel` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_code_posti` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_date_vorod` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_date_khoroj` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_meghdar_eghamat` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_tedad_otagh` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_tedad_kodak` char(32) COLLATE utf8_persian_ci NOT NULL,
  `r_adres` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `foreign_key_r_uid_uid` (`r_uid`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`r_id`, `r_uid`, `r_code_meli`, `r_name`, `r_fname`, `r_tel`, `r_code_posti`, `r_date_vorod`, `r_date_khoroj`, `r_meghdar_eghamat`, `r_tedad_otagh`, `r_tedad_kodak`, `r_adres`) VALUES
(33, 1, '6598565264', 'ناهید', 'شجاعی', '09233659887', '545452112', '1393/202/25', '1393/202/30', '2 ماه', '1', '5', 'تبریز خیابان ملک کوچه باقری پلاک 21'),
(26, 1, '32151515656', 'سعید', 'حکیمی', '09132026598', '54545151515', '1393/08/05', '1393/08/12', '7 روز', '1', '5', 'تهران خیابان همدانیان کوچه شهید باقری پلاک 241'),
(37, 53, '0021699321', 'مهدی', 'zand', '09140461178', '1564449887', '1400/05/05', '1400/07/01', '156', '5', '15', 'اصفهان'),
(38, 53, '0355555555', 'مهدی', 'ایروانی', '25555555', '5555599999', '1400/05/05', '1400/07/01', '5', '15', '50', 'german'),
(39, 45, '1554848448', 'reza', 'sohrabi', '55588888', '5554444454', '1400/05/02', '1400/07/01', '60', '2', '1', 'آلمان'),
(40, 45, '0101565646', 'رضا', 'محمدی', '03132326484', '8199883645', '1400/05/05', '1400/07/01', '4', '595', '1', 'اصفهانم'),
(41, 45, '1554848448', 'reza', 'sohrabi', '55588888', '5554444454', '1400/05/02', '1400/07/01', '60', '2', '1', 'آلمان'),
(42, 45, '0021555555', 'مهدی', 'ایمانی', '55588888', '5554444454', '1400/10/10', '1400/10/01', '10', '10', '10', 'اروپا');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(255) NOT NULL DEFAULT '',
  `u_email` varchar(255) NOT NULL DEFAULT '',
  `u_password` varchar(255) NOT NULL DEFAULT '',
  `u_usertype` varchar(25) NOT NULL DEFAULT 'register',
  `u_activation` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `username` (`u_username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_username`, `u_email`, `u_password`, `u_usertype`, `u_activation`) VALUES
(1, 'admin', 'admin@sorena.com', '123456', 'admin', b'1'),
(54, 'mahdizand', 'mahdizand@sorena.com', 'mahdi', 'register', b'1'),
(53, 'mahdi', 'admin@sorena.com', 'mahdi', 'register', b'1'),
(56, 'soh', 'mrso@gmail.com', '123', 'register', b'1'),
(58, 'aliz', 'aliz@gmail.com', '1234', 'register', b'1'),
(59, 'rira', 'rae@gmail.com', 'rira', 'register', b'1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
