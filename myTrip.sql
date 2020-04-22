-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2020 at 11:58 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myTrip`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_num` bigint(20) NOT NULL,
  `card_cvc` int(5) NOT NULL,
  `card_exp_month` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `card_exp_year` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `item_price_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'usd',
  `paid_amount` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `card_num`, `card_cvc`, `card_exp_month`, `card_exp_year`, `item_name`, `item_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `created`, `modified`) VALUES
(1, 'Amitoj', 'amitojsingh95@gmail.com', 4242424242424242, 123, '05', '22', 'Premium Script CodexWorld', 'PS123456', 55.00, 'usd', '55', 'usd', 'txn_1GRzaWJgtzK0ZQtnSBawgRRQ', 'succeeded', '2012-02-20 00:00:00', '2012-02-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `role`) VALUES
(1, 'ab', 'ab12', '123456', 'user'),
(2, 'ab12', '123456', 'av', 'user'),
(3, 'abcd', '123456', 'av', 'user'),
(4, '1234', '123456', 'av', 'user'),
(5, 'wow1', 'password_hash(123456, PASSWORD_DEFAULT)', 'wow', 'user'),
(6, 'afga', '$2y$10$yCCxUoRYE90GMadYYIJcW.jI9TwInYCnmtc0SEThjrAuce3sJF2I2', 'adfad', 'user'),
(7, 'rupinder@gmail.com', '$2y$10$EhQQbcJL0fvZ2U9fI3uuwuUtm.OjtsrKru4z.lgZ9hFKjmOA9wHNW', 'Rupinder', 'user'),
(8, 'admin', '$2y$10$CL8bi92XXiW1Oce6KmqTduUY16vVJsxEUqihdJftPeHeH5DVFgRMe', 'admin', 'admin'),
(9, 'ab@gmail.com', '$2y$10$CL8bi92XXiW1Oce6KmqTduUY16vVJsxEUqihdJftPeHeH5DVFgRMe', 'ab', 'user'),
(10, 'rupinder123@gmail.com', '$2y$10$/Q5GcOC.6HQbC7YH2pcZYumDX.bn/tjgp3SxmIZzj1VGYRqECHyY6', 'rupinder', 'user'),
(11, 'rupinderk@gmail.com', '$2y$10$bsn.gUUUpqykTy155Pscv.A.W7Zt5CXIwx.Ne3lKenlQ84iruAnV.', 'rupinder', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `vacationpack`
--

CREATE TABLE `vacationpack` (
  `pk_id` int(11) NOT NULL,
  `pk_title` varchar(255) NOT NULL,
  `pk_image` varchar(255) NOT NULL,
  `pk_destination` text NOT NULL,
  `pk_region` text NOT NULL,
  `pk_description` varchar(255) NOT NULL,
  `pk_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacationpack`
--

INSERT INTO `vacationpack` (`pk_id`, `pk_title`, `pk_image`, `pk_destination`, `pk_region`, `pk_description`, `pk_price`) VALUES
(1, 'The place resembles love', 'https://thumbs-prod.si-cdn.com/rtkp3HcECC3xlPiOGvSnR1M5Rag=/fit-in/1600x0/filters:focal(1471x1061:1472x1062)/https://public-media.si-cdn.com/filer/b6/30/b630b48b-7344-4661-9264-186b70531bdc/istock-478831658.jpg', 'Agra', 'India', '', 1200),
(2, 'Greenery of India', 'https://moderndiplomacy.eu/wp-content/uploads/2019/03/tamil-nadu.jpg', 'Tamil Nadu', 'India', '', 1024),
(3, 'Heart of United States', 'https://media4.s-nbcnews.com/j/newscms/2019_11/2786381/190314-lake-elsinore-california-poppies-ew-336p_bda344d57f86841bbde9a27de95b1229.fit-760w.jpg', 'California', 'USA', 'Luxury on The Strip.\r\nElegant and stylish suites.\r\nDaily food and beverage credit.', 993),
(4, 'The Grand at Moon Place Package', 'https://media-cdn.tripadvisor.com/media/photo-s/06/28/dd/3f/hotel-riu-cancun.jpg', 'Cancun', 'Mexico', 'This new beachfront, all-inclusive resort features expansive pools, two water slides, spacious suites, numerous restaurants and bars, a kids’ club and a spa.', 1005),
(5, 'Jamaica: Jewel Runaway Bay Beach & Golf Resort Package', 'https://rccl-h.assetsadobe.com/is/image/content/dam/royal/data/ports/falmouth-jamaica/falmouth-jamaica-port-aerial-coast.jpg?$750x320$', 'Jamaica', 'Carabian', 'Jamaica: Jewel Runaway Bay Beach & Golf Resort Package\r\n\r\nFrom the white sand to the sparkling Caribbean waters, Jewel Runaway Bay Beach Resort is designed with families in mind.', 999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`username`);

--
-- Indexes for table `vacationpack`
--
ALTER TABLE `vacationpack`
  ADD PRIMARY KEY (`pk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vacationpack`
--
ALTER TABLE `vacationpack`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
