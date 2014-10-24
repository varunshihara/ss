-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2014 at 12:57 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `steelshoppers_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ss_category`
--

CREATE TABLE IF NOT EXISTS `ss_category` (
  `id` int(10) NOT NULL,
  `category` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ss_groups`
--

CREATE TABLE IF NOT EXISTS `ss_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ss_groups`
--

INSERT INTO `ss_groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', ''),
(2, 'Administrator', '{\r\n"admin": 1,\r\n"moderator": 1\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `ss_item`
--

CREATE TABLE IF NOT EXISTS `ss_item` (
  `id` int(50) NOT NULL,
  `name` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `category` varchar(200) NOT NULL,
  `seller_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ss_user`
--

CREATE TABLE IF NOT EXISTS `ss_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ss_user`
--

INSERT INTO `ss_user` (`id`, `username`, `password`, `salt`, `name`, `joined`, `group`, `email`, `mobile`) VALUES
(15, 'admin', '9d3a8fc707b7e20b7fcfa794edb57456bf1dd85c6339e15005e2d290653245cd', 'h‘¦Ð¶Â‡¢»j<Áj¨Ë×ŽÄjÊ ^–ƒ§pLa/>/', 'Varun', '2014-10-20 21:32:23', 2, 'varunshihara@gmail.com', '9638113178'),
(16, 'root', '58debc7f06ab564c547c3236b79c26b1736049a75094f0c33e46fc52acad91a6', 'Šf\0·¥·?õ}\nç±QDÖjðÅzxˆz''´Ø', 'Root', '2014-10-22 12:56:08', 1, 'neohackd@gmail.com', '9638113178'),
(17, 'user', 'a412b6c588d7bb12634be22e2cbc5199e7355e071f0f870a2803e50f98fce26c', 'gkTU „•cuK‹½[?{JBR~N”ý5Iˆ«†L ,', 'Customer Name', '2014-10-24 02:06:06', 1, 'user@email.com', '1234567890'),
(18, 'seller', '9600a0b6216e4184f0c9ddc01599311d5b5a1984d34c5f6c5eb063b99b5c4d10', 'èÝ	"BÑ¸lôÐ5Èø¸l±¶0¤`6GÏ{½#Ä', 'Seller Name', '2014-10-24 02:18:41', 1, 'seller@email.com', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `ss_user_session`
--

CREATE TABLE IF NOT EXISTS `ss_user_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;