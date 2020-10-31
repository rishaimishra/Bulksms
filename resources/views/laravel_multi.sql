-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 31, 2020 at 03:18 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `laravel_multi`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2020_10_17_163645_create_roles_table', 1),
(5, '2020_10_17_165340_create_role_user_table', 1),
(6, '2020_10_18_085321_add_phone_field_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-10-18 03:31:03', '2020-10-18 03:31:03'),
(2, 'staff', '2020-10-18 03:31:03', '2020-10-18 03:31:03'),
(3, 'user', '2020-10-18 03:31:03', '2020-10-18 03:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, NULL, NULL),
(4, 2, 3, NULL, NULL),
(5, 3, 4, NULL, NULL),
(6, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` bigint(20) NOT NULL,
  `guest` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `guest`) VALUES
(1, 'rishav', 'rishimishra@techions.com', NULL, '$2y$10$YwDyR8K/GiO8htQKjgB1nOI1pSp80zFI.sEjN3E4L117O7aBC9uG2', NULL, '2020-10-18 03:31:44', '2020-10-18 03:56:25', 7872306302, 0),
(2, 'vikrant', 'vikrant@srv.com', NULL, '$2y$10$i/U1I8hDkHTJyDra3fdxAuCRBDaKU3WatfXlaSda8/Cnbh2cuopsW', NULL, '2020-10-18 03:32:32', '2020-10-18 03:32:32', 7738171654, 0),
(3, 'anaya', 'anaya@vikku.com', NULL, '$2y$10$I/W4nStD2nETML62tHIMnur7NGW3OqJ.a4oRHD..s7NRjI7b88l7e', NULL, '2020-10-18 03:37:03', '2020-10-18 03:37:03', 7689876543, 0),
(4, 'manish', 'maniahs@gmail.com', NULL, '$2y$10$xhg.RkCeICuCppJUcH//LOuDYb0JjFfuGgeby2LyPab98Wb.ktAn2', NULL, '2020-10-18 03:39:55', '2020-10-18 03:39:55', 6543786789, 0),
(5, 'anisha kumar', 'ani@gmail.com', NULL, '$2y$10$E38ldeFe5Jouas/ilpXsUOqtr7g5eHZoHYHN6H59.Cn8nkqfxNIH2', NULL, '2020-10-21 01:54:30', '2020-10-21 01:54:30', 7876542345, 1),
(7, 'avinash kumar', 'avi@gmail.com', NULL, '$2y$10$vtio9EkGHKeKAUvhmEVhluMT/RoQH8RDlw94AKf2rkbCORYLdDtx6', NULL, '2020-10-21 01:54:30', '2020-10-21 01:54:30', 9876546789, 1),
(8, 'RUPESH kumai', 'chotu@gmail.com', NULL, '$2y$10$NZyMZn5KRMwOvjHxssV1gOvdJs8/7230rykuaNAadtvzLi26K/MAq', NULL, '2020-10-21 01:54:31', '2020-10-21 01:54:31', 897987798, 1),
(9, 'avi singh', 'rohit@gmail.com', NULL, '$2y$10$cNDDu8LVEDtqh745GuBceOarepPEJX1.AjkUK24E9ZGshTqwerRbq', NULL, '2020-10-21 02:03:03', '2020-10-21 02:03:03', 7063821662, 1),
(40, 'ranuat akumar', 'rassd4521344143212rrdt@gmail.com', NULL, '$2y$10$BTochRk28nP7lAgrRB/aXeCO8WqGg1RtIdAY7G2YOJRlXxIuR/yWi', NULL, '2020-10-21 02:58:36', '2020-10-21 02:58:36', 70890977688, 1),
(41, 'vikrant singh', 'srvinfo73@gmail.com', NULL, '$2y$10$rlfe.M5OUDhvbP1BwfO0x.VVIulCpNSbI2pT0rm4JjTkKAqxecNcu', NULL, '2020-10-21 03:39:38', '2020-10-22 11:49:47', 917063821662, 1);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
