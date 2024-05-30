-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 03:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kyle`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(6) UNSIGNED NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street_address`, `city`, `state`, `postal_code`, `country`, `created_at`) VALUES
(4, 'sayre highway', 'manolo', 'Bukidnon', '8703', 'Philippines', '2024-05-30 01:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(6) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `product_name`, `price`, `payment_method`, `created_at`) VALUES
(3, 'kyle', 5.00, 'GCash', '2024-05-30 01:05:23'),
(4, '', 0.00, 'PayMaya', '2024-05-30 01:05:24'),
(5, '', 0.00, 'PayMaya', '2024-05-30 01:05:27'),
(6, '', 0.00, 'PayMaya', '2024-05-30 01:05:27'),
(7, '', 0.00, 'PayMaya', '2024-05-30 01:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `rrp` decimal(10,0) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(10, 'Pandesal', 'soft and fluffy', 7, 5, 100, 'https://i.pinimg.com/236x/77/2f/56/772f5646441f660ad014a864f3193273.jpg', '2024-05-29 15:04:48'),
(11, 'Pan de Coco', 'soft bread roll stuffed with sweetened grated coco...', 7, 5, 100, 'https://i.pinimg.com/236x/fb/c8/bd/fbc8bdfae91793b9ada58e49b87aa66b.jpg', '2024-05-29 15:05:33'),
(12, 'Ensaymada', 'soft and fluffy brioche, oozing with cream cheese filling', 7, 5, 100, 'https://i.pinimg.com/236x/e1/a8/66/e1a866ca2d326e32f63d26df8f66c329.jpg', '2024-05-29 15:06:18'),
(13, 'Monay', 'slightly sweet taste and dense texture', 7, 5, 100, 'https://i.pinimg.com/236x/9d/b2/ea/9db2ea2ceb43873f4cfe735a027c455d.jpg', '2024-05-29 15:06:52'),
(14, 'Star bread', 'sweet, dense bread with a unique crown shape on top', 7, 5, 100, 'https://i.pinimg.com/236x/fe/61/a4/fe61a48b718ea6b13e9b004f09229823.jpg', '2024-05-29 15:07:27'),
(15, 'Buko pie', 'made out of semi flaky pastry filled with custard made out of young coconut meat and condensed milk', 12, 10, 100, 'https://i.pinimg.com/736x/60/c8/ed/60c8ed18fabe056b2febb5e47cb1c414.jpg', '2024-05-30 09:19:12'),
(16, 'Hopia', 'A crusty flaky treat filled with sweet mongo bean paste', 7, 5, 100, 'https://i.pinimg.com/236x/72/88/b7/7288b7ab3700d39eec8a679a30db45ae.jpg', '2024-05-30 09:21:19'),
(17, 'Cheese bread', 'basic bread that is flavored with cheese', 7, 5, 100, 'https://i.pinimg.com/236x/7a/42/3f/7a423fcefa9cb8cec7128ac5703449ac.jpg', '2024-05-30 09:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'grabe', '$2y$10$o3pwtlOOmaZYgVXf9dT8KOa0itmURxU1lpy6txDbPnw1FzmldVna.', '2024-05-30 09:07:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
