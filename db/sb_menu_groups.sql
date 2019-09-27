-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2019 at 11:56 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attaullah`
--

-- --------------------------------------------------------

--
-- Table structure for table `sb_menu_groups`
--

CREATE TABLE `sb_menu_groups` (
  `sb_group` varchar(32) NOT NULL,
  `link_href` varchar(255) NOT NULL,
  `link_title` varchar(255) NOT NULL,
  `link_icon` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sb_menu_groups`
--

INSERT INTO `sb_menu_groups` (`sb_group`, `link_href`, `link_title`, `link_icon`) VALUES
('paid_data', 'paid-data/ceo-compensation', 'CEO compensation data', 'fa-link'),
('paid_data', 'paid-data/director-qualification', 'Directors Qualification', 'fa-link'),
('paid_data', 'paid-data/earning-announcements', 'Earning Announcements', 'fa-link'),
('paid_data', 'paid-data/financial', 'Financial data', 'fa-link'),
('paid_data', 'paid-data/ipo', 'Initial Public Offering (IPO)', 'fa-link'),
('paid_data', 'paid-data/ownership-structure', 'Ownership structure data', 'fa-link'),
('paid_data', 'paid-data/share-prices', 'Share prices data', 'fa-link');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_menu_groups`
--
ALTER TABLE `sb_menu_groups`
  ADD UNIQUE KEY `sb_group` (`sb_group`,`link_href`,`link_title`,`link_icon`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
