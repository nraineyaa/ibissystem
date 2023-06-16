-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 06:10 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibis_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `checkIn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkOut` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `checkIn`, `checkOut`, `status`, `userID`, `created_at`, `updated_at`) VALUES
(1, '2023-06-09', '22:00:23', '22:02:12', 'Available', 46, NULL, NULL),
(2, '2023-06-10', '22:05:44', '22:19:30', 'Available', 43, NULL, NULL),
(3, '2023-06-10', '23:54:43', '23:55:12', 'Available', 41, NULL, NULL),
(4, '2023-06-12', '02:52:38', '17:04:40', 'Available', 60, NULL, NULL),
(5, '2023-06-12', '02:52:50', '17:04:42', 'On-Site', 60, NULL, NULL),
(6, '2023-06-12', '02:53:24', '02:54:10', 'On-Leave', 41, NULL, NULL),
(7, '2023-06-12', '02:54:06', '02:54:15', 'On-Site', 41, NULL, NULL),
(8, '2023-06-12', '17:08:36', '01:13:59', 'Available', 43, NULL, NULL),
(9, '2023-06-15', '20:25:04', '04:11:17', 'Available', 42, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claimType` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `svName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `claimType`, `date`, `amount`, `svName`, `status`, `remark`, `userID`, `created_at`, `updated_at`) VALUES
(1, 'Fuel', '2023-05-11', '40.00', 'Huda Ramli', 'Successful', NULL, 41, NULL, '2023-06-10 06:59:23'),
(2, 'Fuel', '2023-06-02', '250.00', 'Huda Ramli', 'Pending', NULL, 60, NULL, NULL),
(3, 'Medical', '2023-06-03', '300.00', 'Huda Ramli', 'Reviewed', 'Can Proceed', 41, NULL, '2023-06-15 04:38:29'),
(4, 'Overtime', '2023-06-14', '300.00', 'Nurin Azyyati', 'Successful', 'Can Proceed', 41, NULL, '2023-06-15 04:35:14'),
(5, 'Overtime', '2023-06-11', '300.00', 'Nurin Azyyati', 'Pending', NULL, 46, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issueDate` date NOT NULL,
  `dueDate` date NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `issueDate`, `dueDate`, `address`, `payment`, `remark`, `userID`, `created_at`, `updated_at`) VALUES
(1, '2023-06-11', '2023-06-14', 'Ump Perthkan', 'FPX', 'Can Proceed', 41, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bil` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `bil`, `itemName`, `quantity`, `price`, `amount`, `userID`, `created_at`, `updated_at`) VALUES
(1, '1', 'test', '1', '20.00', '40.00', 41, NULL, NULL),
(2, '2', 'kayu', '2', '80.00', '160.00', 41, NULL, NULL),
(3, '3', 'batu', '1', '10.00', '10.00', 41, NULL, NULL),
(4, '4', 'batu', '2', '11.00', '22.00', 41, NULL, NULL),
(5, '5', 'test', '1', '20.00', '200.00', 41, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jobTitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobDesc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workersName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `jobTitle`, `date`, `location`, `jobDesc`, `workersName`, `remark`, `status`, `userID`, `created_at`, `updated_at`) VALUES
(1, 'titleeeeeeeeeeeeeee', '2023-06-16', 'Test Location', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Farra Alia', 'aaaaaaaaaaaaaaaaaaa', 'Accepted', 46, NULL, '2023-06-15 09:38:09'),
(2, 'Maintenance PS Kuala', '2023-06-16', 'PS Bayam', '- Pipe Leaking\r\n-Jubin Pecah', 'Alia Hidayah', NULL, 'Assigned', 42, NULL, '2023-06-15 10:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_16_160635_create_activity_table', 2),
(6, '2023_06_01_171252_create_claims_table', 3),
(13, '2023_06_10_130020_create_attendance_table', 7),
(16, '2023_06_10_142801_create_claims_table', 8),
(25, '2023_06_08_202716_create_item_table', 11),
(26, '2023_06_10_130836_create_invoice_table', 12),
(28, '2023_06_10_152239_create_jobs_table', 13),
(29, '2023_06_10_172919_create_report_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reportTitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `file` blob NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `reportTitle`, `date`, `file`, `remark`, `status`, `userID`, `created_at`, `updated_at`) VALUES
(1, 'Reporttttttttttttttt', '2023-06-15', 0x313638363835393435342e706466, 'qqqqqqqqqqqqqqqqqqqqqqqqq', 'Pending', 42, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ic` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffID` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmPass` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNum` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employmentType` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankType` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accName` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accNo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `ic`, `name`, `staffID`, `password`, `confirmPass`, `phoneNum`, `remember_token`, `category`, `employmentType`, `salary`, `picture`, `address`, `bankType`, `accName`, `accNo`, `last_login_at`, `created_at`, `updated_at`) VALUES
(40, 'Huda@gmail.com', '', 'Huda Ramli', 'CA20166', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '012391283', NULL, 'Supervisor', 'Contract', '5000', 'pp.png', 'Kg Ubai', 'Bank Islam', '', '123123123123123', NULL, '2023-06-05 18:06:17', '2023-06-05 10:06:17'),
(41, 'Mai@gmail.com', '', 'Maisarah Faisal', 'CA20155', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '012391233', NULL, 'Accountant', 'Contract', '30001', '41.jpeg', 'Ump Gambang', 'Maybank', '', '01239282828999', NULL, '2023-06-09 13:21:32', '2023-06-09 05:21:32'),
(42, 'Nurin@gmail.com', '000213101658', 'Nurin Azyyati', 'CB20155', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '$2y$10$LQarMbFA/ecXRLPlcg7bt.wGuCXarZC9r7Ih3wQCrSn1CsAm9Z9j.', '01110109615', NULL, 'Supervisor', 'Contract', '2000', '42.jfif', 'Ump Pekan', 'Maybank', '', '01239282828999', NULL, '2023-06-05 18:38:15', '2023-06-05 10:38:15'),
(43, 'Alia@gmail.com', '', 'Alia Hidayah', 'CB20153', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '$2y$10$eecikI8y6b3JSTtoCdDSH.IpT6sKR/W196yOCmy/OqR7cbFEqfId.', '0123912221', NULL, 'Worker', 'Contract', '3000', '43.jfif', 'Kb', 'Bank Islam', '', '03139020118932', NULL, '2023-06-10 15:42:47', '2023-06-10 15:42:47'),
(46, 'Farra@gmail.com', '', 'Farra Alia', 'CB20120', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '01129363638', NULL, 'Worker', 'Contract', '3000', '46.jpeg', 'Ukm', 'MAYBANK', '', '123456789', NULL, '2023-06-05 17:25:20', '2023-06-05 09:25:20'),
(60, 'kashfi@gmail.com', '9292292992', 'Muhammad Izzat', 'CQ10292', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '$2y$10$ikxD3O63fb83q2Rl/Udxv.KJ6suRrmGUAWpf6srQNR.nJagEA6wcu', '0129993322', NULL, 'Human Resource', 'Contract', '5000', 'pp.png', 'Pulau Pisang', 'CIMB Bank', 'Izzat Kashfi', '23123232332', NULL, '2023-06-11 18:51:16', '2023-06-11 18:51:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
