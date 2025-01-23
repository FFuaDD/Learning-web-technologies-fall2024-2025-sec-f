-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 06:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'completed',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `user_id`, `package`, `payment_method`, `amount`, `payment_status`, `created_at`) VALUES
(1, 1, 'premium', 'nagad', 100.00, 'completed', '2025-01-06 14:39:51'),
(2, 1, 'ultimate', 'debit_card', 200.00, 'completed', '2025-01-06 14:42:31'),
(3, 1, 'premium', 'nagad', 100.00, 'completed', '2025-01-06 14:53:44'),
(4, 1, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-06 15:17:19'),
(5, 1, 'ultimate', 'debit_card', 200.00, 'completed', '2025-01-06 16:16:57'),
(6, 1, 'premium', 'debit_card', 100.00, 'completed', '2025-01-17 15:52:22'),
(7, 1, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-17 16:00:36'),
(8, 1, 'premium', 'bkash', 100.00, 'completed', '2025-01-17 16:46:31'),
(9, 1, 'premium', 'debit_card', 100.00, 'completed', '2025-01-17 16:53:29'),
(10, 1, 'ultimate', 'debit_card', 200.00, 'completed', '2025-01-17 16:53:43'),
(11, 1, 'basic', 'bkash', 50.00, 'completed', '2025-01-17 16:56:04'),
(12, 1, 'ultimate', 'debit_card', 200.00, 'completed', '2025-01-17 16:58:22'),
(13, 1, 'premium', 'nagad', 100.00, 'completed', '2025-01-17 17:15:08'),
(14, 1, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-17 17:52:14'),
(15, 1, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-17 17:52:53'),
(16, 1, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-17 17:55:34'),
(30, 1, 'ultimate', 'bkash', 200.00, 'completed', '2025-01-17 17:58:23'),
(31, 1, 'basic', 'nagad', 50.00, 'completed', '2025-01-17 17:58:49'),
(32, 1, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-17 21:51:44'),
(33, 1, 'ultimate', 'bkash', 200.00, 'completed', '2025-01-17 22:22:11'),
(34, 1, 'ultimate', 'nagad', 200.00, 'completed', '2025-01-18 02:27:27'),
(35, 1, 'premium', 'nagad', 100.00, 'completed', '2025-01-18 02:30:54'),
(36, 1, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-18 15:28:04'),
(37, 1, 'basic', 'credit_card', 50.00, 'completed', '2025-01-18 15:51:24'),
(38, 1, 'basic', 'nagad', 50.00, 'completed', '2025-01-18 16:20:14'),
(39, 9, 'basic', 'bkash', 50.00, 'completed', '2025-01-18 17:06:09'),
(40, 10, 'ultimate', 'nagad', 200.00, 'completed', '2025-01-18 17:21:11'),
(41, 10, 'premium', 'bkash', 100.00, 'completed', '2025-01-18 17:21:27'),
(42, 18, 'basic', 'bkash', 50.00, 'completed', '2025-01-23 23:49:40'),
(43, 18, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-23 23:49:59'),
(44, 18, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-23 23:50:06'),
(45, 18, 'ultimate', 'nagad', 200.00, 'completed', '2025-01-23 23:50:10'),
(46, 18, 'ultimate', 'bkash', 200.00, 'completed', '2025-01-23 23:50:13'),
(47, 18, 'ultimate', 'debit_card', 200.00, 'completed', '2025-01-23 23:50:17'),
(48, 18, 'ultimate', 'credit_card', 200.00, 'completed', '2025-01-23 23:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `advertiser_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `target_age` varchar(50) DEFAULT NULL,
  `target_gender` enum('All','Male','Female') DEFAULT 'All',
  `target_interests` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `advertiser_id`, `title`, `description`, `image_path`, `video_path`, `start_date`, `end_date`, `target_age`, `target_gender`, `target_interests`, `status`, `feedback`, `created_at`, `updated_at`) VALUES
(1, 9, 'fariha', 'is very good', '../uploads/Screenshot (402).png', NULL, '2025-01-17', '2025-01-17', '12', 'Female', 'ijiouj', 'rejected', 'ok', '2025-01-17 15:26:20', '2025-01-17 17:09:10'),
(2, 9, 'fariha', 'khiuhiluh', NULL, NULL, '2025-01-17', '2025-01-17', '12', 'All', 'ijiouj', 'approved', NULL, '2025-01-17 16:00:45', '2025-01-17 17:09:14'),
(3, 9, 'lalalal', 'alallal', NULL, NULL, '2025-01-17', '2025-01-17', '12', 'All', 'ijiouj', 'rejected', 'no ok', '2025-01-17 16:17:58', '2025-01-17 17:09:23'),
(4, 9, 'rin', 'cloth', '../uploads/logo.png', NULL, '2025-01-17', '2025-01-17', '13', 'Male', 'wash', 'rejected', '', '2025-01-17 17:10:35', '2025-01-18 08:30:32'),
(5, 9, 'mehu', 'hjh', '../uploads/images/1737139323_logo.png', NULL, '2025-01-18', '2025-01-18', NULL, 'All', NULL, 'approved', NULL, '2025-01-17 18:42:03', '2025-01-17 18:44:10'),
(6, 2, 'hehhehehe', 'jhuuhuhuh', NULL, NULL, '2025-01-18', '2025-01-18', NULL, 'All', NULL, 'rejected', '', '2025-01-18 08:32:53', '2025-01-18 08:33:14'),
(7, 2, 'lalalalla', 'sllslslsl', NULL, NULL, '2025-01-18', '2025-01-18', NULL, 'All', NULL, 'rejected', '', '2025-01-18 08:36:18', '2025-01-18 08:36:50'),
(8, 2, 'idonnowhattodo', 'kjdjhejh', NULL, NULL, '2025-01-18', '2025-01-18', NULL, 'All', NULL, 'approved', NULL, '2025-01-18 08:36:33', '2025-01-18 09:13:50'),
(9, 2, 'alvie', 'lyguygh', NULL, NULL, '2025-01-18', '2025-01-18', NULL, 'All', NULL, 'approved', NULL, '2025-01-18 08:47:27', '2025-01-18 08:47:57'),
(10, 2, 'wheel', 'for cleaning clothes', NULL, NULL, '2025-01-11', '2025-01-18', NULL, 'All', NULL, 'approved', NULL, '2025-01-18 11:01:55', '2025-01-18 11:02:32'),
(11, 2, 'boots', 'moisturizer', '../uploads/images/1737199786_logo.png', NULL, '2025-01-18', '2025-01-18', NULL, 'All', NULL, 'rejected', '', '2025-01-18 11:29:46', '2025-01-18 12:44:15'),
(12, 18, 'mobile', 'new', '../uploads/images/1737654550_picture.jpg', NULL, '2025-01-23', '2025-02-23', NULL, 'All', NULL, 'approved', NULL, '2025-01-23 17:49:10', '2025-01-23 17:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `contact_method` enum('Call','Email') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `name`, `email`, `phone`, `message`, `contact_method`, `created_at`) VALUES
(1, 'Turna', 'TT@gmail.com', '01810137026', 'asdfgfdsadfgdsa', 'Email', '2025-01-06 13:21:58'),
(2, 'Turna', 'TT@gmail.com', '01810137026', 'sdfghkjljhvjgcfhxdttfyghj', 'Email', '2025-01-06 13:54:36'),
(3, 'Turna', 'gg@gmail.com', '01810137026', 'evetbynumi,mnbgvfdcxs', 'Email', '2025-01-06 16:15:27'),
(4, 'nazeef', 'nn@gmail.com', '01810137026', 'feragthyjukjyhtgrfds', 'Email', '2025-01-06 16:17:33'),
(5, 'nazeef', 'nn@gmail.com', '01810137026', 'feragthyjukjyhtgrfds', '', '2025-01-06 16:17:58'),
(6, 'ABC', 'abc1@gmail.com', '01810137026', 'what do u sell', 'Email', '2025-01-17 15:54:06'),
(7, 'ABC', 'abc1@gmail.com', '01810137026', 'sdhjsgygrhtejrytkuliurgefwd', 'Email', '2025-01-17 17:02:24'),
(8, 'ABC', 'abc1@gmail.com', '01810137026', 'sdhjsgygrhtejrytkuliurgefwd', 'Email', '2025-01-17 17:03:44'),
(9, 'ABC', 'abc1@gmail.com', '01810137026', 'sdhjsgygrhtejrytkuliurgefwd', 'Email', '2025-01-17 17:04:12'),
(10, 'xy', 'xy@gmail.com', '01810137026', 'srdtfguhijkjbhvgcfdsedfghj', 'Email', '2025-01-17 17:15:58'),
(11, 'mm', 'mm@gmail.com', '01810137026', 'sdsfghjkuilouytredsa', 'Email', '2025-01-17 19:39:13'),
(12, 'abc', 'abc1@gmail.com', '01810137026', 'sdfghjk,ili,ujmhngfbdvsc', 'Email', '2025-01-18 19:02:20'),
(13, 'pp', 'p@gmail.com', '01810137026', 'fghjkulikuyjgefwdwefgrhtjykulimhng c', 'Email', '2025-01-19 19:12:14'),
(14, 'qwe', 'fuadshahriar202@gmail.com', '01840394184', 'asdfjhdsfas', 'Email', '2025-01-19 20:36:01'),
(15, 'ad', 'ad@gmail.com', '01840394184', 'asdadsasff', 'Email', '2025-01-23 23:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `role` enum('admin','advertiser','viewer') NOT NULL,
  `status` enum('pending','answered') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ijoij', 'kjhkh', 'viewer', 'answered', '2025-01-17 13:55:33', '2025-01-17 13:56:37'),
(2, 'uhihiuhihiu', 'hiuhiuhiu', 'advertiser', 'answered', '2025-01-17 13:56:09', '2025-01-17 13:56:34'),
(3, 'what\'s your name', NULL, 'advertiser', 'pending', '2025-01-17 14:00:59', '2025-01-17 14:00:59'),
(4, 'what', NULL, 'advertiser', 'pending', '2025-01-17 14:01:05', '2025-01-17 14:01:05'),
(5, 'hi how are you', 'finee', 'advertiser', 'answered', '2025-01-17 14:11:49', '2025-01-23 17:53:58'),
(6, 'what is advertisement', NULL, 'advertiser', 'pending', '2025-01-17 14:15:05', '2025-01-17 14:15:05'),
(7, 'hello', 'hi', 'viewer', 'answered', '2025-01-17 14:21:44', '2025-01-18 08:56:02'),
(8, 'hi', 'good', 'viewer', 'answered', '2025-01-17 14:24:54', '2025-01-17 14:32:33'),
(9, 'lala', 'good', 'viewer', 'answered', '2025-01-17 14:28:48', '2025-01-17 14:32:28'),
(10, 'hey', 'hello', 'viewer', 'answered', '2025-01-18 08:57:36', '2025-01-18 12:53:41'),
(11, 'what', 'assd', 'advertiser', 'answered', '2025-01-18 14:09:10', '2025-01-18 14:10:10'),
(12, 'is this trustworthy', 'yes', 'viewer', 'answered', '2025-01-20 07:27:46', '2025-01-23 17:54:11'),
(13, 'asdf', NULL, 'viewer', 'pending', '2025-01-20 07:47:50', '2025-01-20 07:47:50'),
(14, 'sadff', 'saddd', 'viewer', 'answered', '2025-01-20 07:50:05', '2025-01-23 17:54:29'),
(15, 'asd', NULL, 'viewer', 'pending', '2025-01-20 07:50:46', '2025-01-20 07:50:46'),
(16, 'qwe', 'qwe', 'viewer', 'answered', '2025-01-20 07:51:59', '2025-01-23 17:54:15'),
(17, 'qwer', 'qwer', 'viewer', 'answered', '2025-01-20 07:55:19', '2025-01-23 17:54:20'),
(18, 'hello', 'hii', 'advertiser', 'answered', '2025-01-23 17:50:43', '2025-01-23 17:54:25'),
(19, 'is this trustworthy\n', NULL, 'viewer', 'pending', '2025-01-23 17:55:21', '2025-01-23 17:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `advertiser_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `advertiser_id`, `ad_id`, `message`, `created_at`) VALUES
(1, 9, 4, 'Your ad \'rin\' has been rejected. Feedback: ', '2025-01-18 03:58:13'),
(2, 9, 7, 'Your ad \'kkkk\' has been approved.', '2025-01-18 03:59:12'),
(3, 9, 8, 'Your ad \'alvie\' has been rejected. Feedback: ', '2025-01-18 04:10:55'),
(4, 9, 9, 'Your ad \'mehnaz\' has been approved.', '2025-01-18 04:46:26'),
(5, 2, 8, 'Your ad \'akkakaka\' has been approved.', '2025-01-18 14:41:18'),
(6, 2, 9, 'Your ad \'alvie\' has been approved.', '2025-01-18 14:47:57'),
(7, 2, 10, 'Your ad \'wheel\' has been approved.', '2025-01-18 17:02:32'),
(8, 2, 11, 'Your ad \'boots\' has been rejected. Feedback: ', '2025-01-18 18:48:17'),
(9, 18, 12, 'Your ad \'mobile\' has been approved.', '2025-01-23 23:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `user_type` enum('Admin','Advertiser','Viewer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `dob`, `gender`, `user_type`) VALUES
(2, 'abc', 'fuadshahriar100@gmail.com', '12345678', '01840394100', '2005-12-17', 'Male', 'Advertiser'),
(3, 'fuad', 'fuadshahriar200@gmail.com', '12345678', '01840394184', '2009-12-31', 'Male', 'Viewer'),
(5, 'fuad', 'fuad@gmail.com', '123', '01840394184', '1990-01-01', 'Male', 'Admin'),
(6, 'turna', 'turna@gmail.com', '123', '0123456789', '2000-01-01', 'Female', 'Admin'),
(7, 'alvi', 'alvi@gmail.com', '123456789', '01234567000', '1980-01-01', 'Male', 'Admin'),
(8, 'fariha', 'fariha@gmail.com', '123', '0123456789', '2000-01-01', 'Female', 'Admin'),
(9, 'asd', 'fuadshahriar1000@gmail.com', '12345678', '01840394184', '2015-09-12', 'Male', 'Advertiser'),
(10, 'abcd', 'fuadshahriar101@gmail.com', '12345678', '01840394184', '2024-10-18', 'Male', 'Advertiser'),
(11, 'abdullah', 'fuadshahriar201@gmail.com', '123456789', '01840394184', '2000-03-30', 'Male', 'Viewer'),
(12, 'fuad', 'fuadshahriar10@gmail.com', '12345678', '01840394184', '2000-12-29', 'Male', 'Advertiser'),
(13, 'turna', 'fuadshahriar10000@gmail.com', '12345678', '01840394111', '2024-12-29', 'Female', 'Advertiser'),
(18, 'ad', 'ad@gmail.com', '12345678', '01840394111', '2012-01-12', 'Male', 'Advertiser'),
(19, 'v', 'v@gmail.com', '12345678', '01840394199', '2000-12-06', 'Male', 'Viewer');

-- --------------------------------------------------------

--
-- Table structure for table `user_favourite`
--

CREATE TABLE `user_favourite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_favourite`
--

INSERT INTO `user_favourite` (`id`, `user_id`, `ad_id`, `created_at`) VALUES
(1, 4, 1, '2025-01-18 11:17:41'),
(2, 4, 2, '2025-01-18 11:17:47'),
(4, 4, 3, '2025-01-18 11:55:32'),
(6, 6, 1, '2025-01-18 15:41:13'),
(7, 6, 2, '2025-01-18 15:41:18'),
(8, 6, 5, '2025-01-18 16:39:04'),
(9, 4, 9, '2025-01-19 07:23:31'),
(10, 4, 13, '2025-01-19 07:23:58'),
(11, 9, 1, '2025-01-19 07:57:24'),
(12, 9, 5, '2025-01-19 07:57:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertiser_id` (`advertiser_id`);

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertiser_id` (`advertiser_id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_favourite`
--
ALTER TABLE `user_favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_favourite`
--
ALTER TABLE `user_favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
