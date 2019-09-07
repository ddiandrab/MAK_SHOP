-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2017 at 10:21 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectakhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `parent`) VALUES
(1, 'Men', 0),
(2, 'Woman', 0),
(3, 'Boys', 0),
(4, 'Girls', 0),
(5, 'Shirts', 1),
(6, 'Shoes', 1),
(7, 'Pants', 1),
(8, 'Accessories', 1),
(9, 'Shirts', 2),
(10, 'Shoes', 2),
(11, 'Pants', 2),
(12, 'Dresses', 2),
(13, 'Pants', 3),
(14, 'Shirts', 3),
(15, 'Shoes', 4),
(16, 'Dresses', 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `categories` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `featured` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `categories`, `image`, `description`, `featured`) VALUES
(25, 'Tas Cantik', '129999.99', '210000.00', '8', '/pemweb/projectakhir/img/tas.jpg', 'sfhsdjvxzksakfs', 1),
(26, 'Sepatu Cantik', '129999.99', '210000.00', '15', '/pemweb/projectakhir/img/sepatu.jpg', 'berkualitas lohh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `birth_date` date NOT NULL,
  `no_hp` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` enum('admin','member') NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `birth_date`, `no_hp`, `image`, `email`, `password`, `type`) VALUES
(1, 'admin', '0000-00-00', '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Rafiqah Majidah', '1998-02-06', '085288539828', '/pemweb/projectakhir/img/fiqah.jpg', 'fiqah.majidah@gmail', '1bb0b1a9044fd397f134ece41efe26e5', 'member'),
(24, 'Desy DB', '1998-02-06', '089693272811', '/pemweb/projectakhir/img/desy.jpg', 'desy.diandra@gmail.com', 'c8a5d4c406066b42d094ca9ced3e6722', 'member'),
(25, 'Fitri Febriyani', '1998-02-06', '08976151110', '/pemweb/projectakhir/img/yani.jpg', 'fitri.yani@gmail.com', '1bb0b1a9044fd397f134ece41efe26e5', 'member'),
(26, 'Tria Melia M S', '1977-10-13', '089693272811', '/pemweb/projectakhir/img/meli.jpg', 'tria.melia@gmail.com', '1bb0b1a9044fd397f134ece41efe26e5', 'member'),
(29, 'Rafiqah Majidah', '1998-06-06', '085288539828', '/pemweb/projectakhir/img/fiqah.jpg', 'fiqah.majida@yahoo.com', '1bb0b1a9044fd397f134ece41efe26e5', 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
