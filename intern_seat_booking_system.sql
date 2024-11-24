-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 07:23 AM
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
-- Database: `intern_seat_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `training_id` varchar(255) NOT NULL,
  `seat_no` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `is_present` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `training_id`, `seat_no`, `booking_date`, `is_present`, `created_at`, `updated_at`) VALUES
(3, '2368', 'S-003', '2024-10-09', 1, '2024-10-07 23:20:23', '2024-10-09 10:52:23'),
(5, '2368', 'S-004', '2024-10-10', 1, '2024-10-08 03:54:26', '2024-10-09 23:06:11'),
(9, '2368', 'S-002', '2024-10-16', 0, '2024-10-14 09:52:00', '2024-10-14 09:52:00'),
(10, '2368', 'S-008', '2024-10-18', 0, '2024-10-14 23:31:38', '2024-10-14 23:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dep_no` varchar(255) NOT NULL,
  `dep_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dep_no`, `dep_name`, `created_at`, `updated_at`) VALUES
(1, 'D001', 'Human Resources', '2024-10-07 23:09:32', '2024-10-07 23:09:32'),
(2, 'D002', 'Marketing', '2024-10-07 23:09:32', '2024-10-07 23:09:32'),
(3, 'D003', 'IT', '2024-10-07 23:09:32', '2024-10-07 23:09:32'),
(4, 'D004', 'Finance', '2024-10-07 23:09:32', '2024-10-07 23:09:32'),
(5, 'D005', 'Accounting', '2024-10-07 23:09:32', '2024-10-07 23:09:32'),
(6, 'D006', 'Administration', '2024-10-07 23:09:32', '2024-10-07 23:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_08_042730_create_user_email_codes_table', 1),
(6, '2024_10_08_042919_create_users_table', 2),
(7, '2024_10_08_043051_create_departments_table', 3),
(8, '2024_10_08_043230_create_seats_table', 4),
(9, '2024_10_08_043339_create_notifications_table', 5),
(10, '2024_10_08_043515_create_bookings_table', 6),
(11, '2024_10_08_061423_add_last_active_to_users_table', 7),
(12, '2024_10_14_050537_add_facebook_id_to_users_table', 8),
(13, '2024_10_14_055817_add_google_id_to_users_table', 9),
(14, '2024_10_17_034526_add_google_id_to_users_table', 10),
(15, '2024_11_22_161545_add_university_name_to_users_table', 10),
(16, '2024_11_22_162018_create_universities_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('06fab464-0c1e-479c-8aa2-8da494849714', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"New user register\",\"user_id\":8}', '2024-11-22 12:41:32', '2024-11-22 12:36:53', '2024-11-22 12:41:32'),
('13b65f8e-e15f-4735-9fb2-5e653dca6c87', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"New user register\",\"user_id\":4}', '2024-11-22 12:41:37', '2024-10-13 23:40:19', '2024-11-22 12:41:37'),
('3f4f90d6-1edd-4c4f-a048-50eb369c70a9', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"New user registered: \",\"user_id\":3}', '2024-10-10 09:57:13', '2024-10-07 23:19:43', '2024-10-10 09:57:13'),
('45466304-88dd-4ad0-8670-aa21f2d658d5', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"New user register\",\"user_id\":7}', '2024-11-22 12:41:43', '2024-11-22 12:30:32', '2024-11-22 12:41:43'),
('7c8e2860-fd47-42f4-9ef4-4f4e76a8b7dd', 'App\\Notifications\\NewUserRegistered', 'App\\Models\\User', 1, '{\"message\":\"New user registered: \",\"user_id\":2}', '2024-10-07 23:16:27', '2024-10-07 23:14:30', '2024-10-07 23:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seat_no` varchar(255) NOT NULL,
  `is_booked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `seat_no`, `is_booked`, `created_at`, `updated_at`) VALUES
(1, 'S-001', 0, '2024-10-07 23:11:52', '2024-10-16 00:15:06'),
(2, 'S-002', 0, '2024-10-07 23:11:53', '2024-11-22 12:47:27'),
(3, 'S-003', 0, '2024-10-07 23:11:53', '2024-11-22 12:47:27'),
(4, 'S-004', 0, '2024-10-07 23:11:53', '2024-11-22 12:47:27'),
(5, 'S-005', 0, '2024-10-07 23:11:53', '2024-10-13 22:44:51'),
(6, 'S-006', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(7, 'S-007', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(8, 'S-008', 0, '2024-10-07 23:11:53', '2024-11-22 12:47:27'),
(9, 'S-009', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(10, 'S-010', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(11, 'S-011', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(12, 'S-012', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(13, 'S-013', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(14, 'S-014', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(15, 'S-015', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(16, 'S-016', 0, '2024-10-07 23:11:53', '2024-10-07 23:11:53'),
(17, 'S-017', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(18, 'S-018', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(19, 'S-019', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(20, 'S-020', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(21, 'S-021', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(22, 'S-022', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(23, 'S-023', 0, '2024-10-07 23:11:54', '2024-10-08 11:28:01'),
(24, 'S-024', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(25, 'S-025', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(26, 'S-026', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(27, 'S-027', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(28, 'S-028', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(29, 'S-029', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(30, 'S-030', 0, '2024-10-07 23:11:54', '2024-10-07 23:11:54'),
(31, 'S-031', 0, '2024-10-10 11:16:30', '2024-10-10 11:16:30'),
(32, 'S-032', 0, '2024-10-10 11:16:31', '2024-10-10 11:16:31'),
(33, 'S-033', 0, '2024-10-10 11:16:31', '2024-10-10 11:16:31'),
(34, 'S-034', 0, '2024-10-10 11:16:31', '2024-10-10 11:16:31'),
(35, 'S-035', 0, '2024-10-10 11:16:31', '2024-10-10 11:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sri Lanka Institute of Information Technology (SLIIT)', NULL, NULL),
(2, 'Informatics Institute of Technology (IIT)', NULL, NULL),
(3, 'NSBM', NULL, NULL),
(4, ' Sri Lanka Institute of Advanced Technological Education (SLIATE)', NULL, NULL),
(5, 'ICBT Campus', NULL, NULL),
(6, 'University of Kelaniya', NULL, NULL),
(7, 'University of Sri Jayewardenepura', NULL, NULL),
(8, 'South Eastern University of Sri Lanka', NULL, NULL),
(9, 'The Open University of Sri Lanka', NULL, NULL),
(10, 'Sabaragamuwa University of Sri Lanka', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `training_id` varchar(255) NOT NULL,
  `dep_no` varchar(255) NOT NULL,
  `dep_name` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_active` timestamp NULL DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `university_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `training_id`, `dep_no`, `dep_name`, `phone_number`, `email`, `email_verified_at`, `password`, `is_admin`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `last_active`, `facebook_id`, `google_id`, `university_name`) VALUES
(1, 'Admin', 'User', '1234', '01', 'Administration', '0123456789', 'sudarik992@gmail.com', NULL, '$2y$10$52qxa1zWuijisyZBbkykGOWxG4g2PyWBhu4FXERHWzv8Tc/AlAdRS', 1, NULL, NULL, '2024-10-07 23:08:39', '2024-11-22 12:47:22', '2024-11-22 12:47:22', NULL, NULL, NULL),
(3, 'sudarshani', 'kumari', '2368', 'D003', 'IT', '0714514235', 'sudarshanikumari925@gmail.com', NULL, '$2y$10$Lr6KI7fTtiZE/1zp2rP/Ku2AhGWQS6c/eaaw1O1lrxr1jO1WvYbPy', 0, NULL, NULL, '2024-10-07 23:19:43', '2024-10-14 23:31:56', '2024-10-14 23:31:56', NULL, NULL, NULL),
(6, 'sudari', 'kumudhi', '2361', 'D003', 'IT', '0789653242', 'kumarisudarshani412@gmail.com', NULL, '$2y$10$z0VTab/C3RmDW9r/fwZx7.MiidFssP6v58aA/9q5IXXv6.wtavxF2', 0, NULL, NULL, '2024-11-22 12:28:48', '2024-11-22 12:28:48', NULL, NULL, NULL, 'Informatics Institute of Technology (IIT)'),
(8, 'sudarshani', 'vithanage', '2360', 'D003', 'IT', '0789653240', 'sudarshanivithanage138@gmail.com', NULL, '$2y$10$AsBa2iR8LiYidS2YSr6miOpVGF7Mqu309UHAnMAEwAhuzW/PDlj02', 0, NULL, NULL, '2024-11-22 12:36:53', '2024-11-22 12:37:06', '2024-11-22 12:37:06', NULL, NULL, 'Informatics Institute of Technology (IIT)');

-- --------------------------------------------------------

--
-- Table structure for table `user_email_codes`
--

CREATE TABLE `user_email_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_email_codes`
--

INSERT INTO `user_email_codes` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 3, '8758', '2024-10-07 23:21:20', '2024-10-08 03:52:27'),
(2, 2, '4009', '2024-10-07 23:22:30', '2024-10-13 22:45:08'),
(3, 4, '3542', '2024-10-13 23:54:41', '2024-10-16 00:20:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_training_id_seat_no_booking_date_unique` (`training_id`,`seat_no`,`booking_date`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_dep_no_unique` (`dep_no`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seats_seat_no_unique` (`seat_no`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_training_id_unique` (`training_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_facebook_id_unique` (`facebook_id`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- Indexes for table `user_email_codes`
--
ALTER TABLE `user_email_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_email_codes`
--
ALTER TABLE `user_email_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `users` (`training_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
