-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2019 at 10:48 PM
-- Server version: 10.3.17-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `okryjfsu_twibbon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$AKJOGe7ydYnouxfo0SG6Xeu8tILzzX11ny5ljxuSzyWad5fFTle2C', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `photo_file`
--

CREATE TABLE `photo_file` (
  `id` int(11) NOT NULL,
  `file_location` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `date` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo_file`
--

INSERT INTO `photo_file` (`id`, `file_location`, `file_name`, `date`) VALUES
(191, './photos/47691905_129706301386585_5514683827229863119_n.jpg', '47691905_129706301386585_5514683827229863119_n.jpg', '04/09/2019');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_title` text NOT NULL,
  `site_description` text NOT NULL,
  `site_author` text NOT NULL,
  `site_keywords` text NOT NULL,
  `home_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_title`, `site_description`, `site_author`, `site_keywords`, `home_title`) VALUES
(1, 'Twibbon Generator ', 'Twibbon Generator akan memudahkan anda dalam menggabungkan foto dengan twibbon!', 'Izzeldin Addarda', 'Twibbon Generator akan memudahkan anda dalam menggabungkan foto dengan twibbon!', 'Twibbon Maker By @_zelsaddr');

-- --------------------------------------------------------

--
-- Table structure for table `twibbon_file`
--

CREATE TABLE `twibbon_file` (
  `id` int(11) NOT NULL,
  `file_location` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL,
  `judul` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `twibbon_file`
--

INSERT INTO `twibbon_file` (`id`, `file_location`, `file_name`, `date`, `judul`) VALUES
(20, '../twibbon/17agustus.png', '17agustus.png', '04/09/2019', '17 Agustus 1945 ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_file`
--
ALTER TABLE `photo_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `twibbon_file`
--
ALTER TABLE `twibbon_file`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photo_file`
--
ALTER TABLE `photo_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `twibbon_file`
--
ALTER TABLE `twibbon_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
