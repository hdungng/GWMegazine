-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 05:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gw-megazine`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `closure_date` timestamp NULL DEFAULT NULL,
  `final_closure_date` timestamp NULL DEFAULT NULL,
  `status` int(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `name`, `closure_date`, `final_closure_date`, `status`, `created_at`, `updated_at`) VALUES
('8fe21273-9133-4417-8e0b-122122a912d0', 'Fall 2024', '2024-07-01 05:00:00', '2024-09-01 05:00:00', 1, '2024-03-25 08:19:15', '2024-03-27 02:14:09'),
('e8b4763a-cd97-43ce-a364-a2b07fa4013a', 'Autumn 2024', '2024-08-01 05:00:00', '2024-09-30 15:00:00', 0, '2024-03-25 03:26:58', '2024-03-27 02:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` char(36) NOT NULL,
  `content` varchar(255) NOT NULL,
  `user_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
('204ac4fd-6617-4230-bd7d-3b774de060d8', 'Academic Year Summer 2024 updated successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-25 08:42:16', '2024-03-25 08:42:16'),
('285fec03-7080-4f45-87b1-59e51ec46213', 'Academic Year Autumn 2024 selected successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-25 19:39:33', '2024-03-25 19:39:33'),
('30c7e023-27bf-4e00-a468-4f20867ec245', 'Academic Year Fall 2024 selected successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-27 02:14:09', '2024-03-27 02:14:09'),
('372e14db-199d-4d45-8a7d-2c10eff3f386', 'Academic Year Summer 2024 created successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-25 03:12:46', '2024-03-25 03:12:46'),
('3d0fe02b-6184-4022-880c-93e7c8ccf825', 'Academic Year Fall 2024 selected successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-27 02:13:48', '2024-03-27 02:13:48'),
('4cccd1cc-4762-4373-810b-e10a31a5d757', 'Academic Year Autumn 2024 updated successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-25 08:45:57', '2024-03-25 08:45:57'),
('5799fd81-ef3f-4e56-83d4-acd323382b4d', 'Academic Year Summer 2024 deleted successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-25 08:52:24', '2024-03-25 08:52:24'),
('686e929d-b577-48a9-92fe-9575884c387a', 'Academic Year Autumn 2024 created successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-25 03:26:58', '2024-03-25 03:26:58'),
('693479ae-69b5-47e2-83e9-83286fbb7909', 'User coordinatorTest5 updated successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-27 01:57:35', '2024-03-27 01:57:35'),
('695a049f-fa97-459f-9728-6bb2db07ebf1', 'Academic Year Autumn 2024 selected successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-27 02:13:43', '2024-03-27 02:13:43'),
('70668914-449f-46a6-ae60-441d3d394058', 'Academic Year Fall 2024 created successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-25 08:19:15', '2024-03-25 08:19:15'),
('822729af-6a08-42b5-851c-0058683547dc', 'Assign coordinatorTest5 to Marketing successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-27 01:57:35', '2024-03-27 01:57:35'),
('99e88f85-7fb2-4869-95e0-3070ab7514dd', 'Academic Year Autumn 2024 selected successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-27 02:14:02', '2024-03-27 02:14:02'),
('d471af73-9173-4fd4-8ceb-8ac84ccc8797', 'Academic Year Fall 2024 selected successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-25 19:39:37', '2024-03-25 19:39:37'),
('d9522db9-233c-464e-b6e1-ba098dc2aa32', 'Academic Year Fall 2024 selected successfully!', '37de1f3c-77c8-456e-aa68-35ec1d9d1a61', '2024-03-25 19:14:38', '2024-03-25 19:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `coordinator_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `short_name`, `coordinator_id`, `created_at`, `updated_at`) VALUES
('f99f4a2b-e9a2-11ee-9ab6-dc21486e292b', 'Business Administration', 'Business', '082f20e6-964c-46c0-a2f6-e8a11a74f43f', '2024-03-24 05:54:27', '2024-03-25 00:17:11'),
('f99f5750-e9a2-11ee-9ab6-dc21486e292b', 'Information Technology', 'IT', 'eead02aa-0239-4385-b82a-070c499e3ef7', '2024-03-24 05:54:27', '2024-03-24 22:11:05'),
('f99f6413-e9a2-11ee-9ab6-dc21486e292b', 'Graphic Design', 'Design', '1b4950eb-f987-4578-b1c3-67f6815b8040', '2024-03-24 05:54:27', '2024-03-25 00:15:19'),
('f99f7051-e9a2-11ee-9ab6-dc21486e292b', 'Marketing', 'Marketing', 'b835ba7b-1ff6-4cf6-8c14-8253799e7d28', '2024-03-24 05:54:27', '2024-03-27 01:57:35'),
('f99f7cc2-e9a2-11ee-9ab6-dc21486e292b', 'Event Management', 'Event', NULL, '2024-03-24 05:54:27', '2024-03-27 01:57:35');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_21_091200_create_roles_table', 1),
(6, '2024_03_21_091327_create_faculties_table', 1),
(9, '2024_03_21_091945_create_permissions_table', 2),
(10, '2024_03_21_092209_create_permission_role_table', 2),
(16, '2024_03_25_054349_create_activity_logs_table', 3),
(17, '2024_03_25_054422_create_academic_years_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nguyentuankhaia4@gmail.com', '$2y$10$h54niJtUPsFRp/K.Lvxp2ugL.u/6lNBHBU8laGx8nCqxtpe4.GP0m', '2024-03-23 01:00:21'),
('root@gmail.com', '$2y$10$kDgaLG7IoopEr0.dzh9WFOE9d6Gk06Fln1rwdydOXcmazWC366Z2m', '2024-03-23 18:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` char(36) NOT NULL,
  `permission_id` char(36) NOT NULL,
  `role_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
('200e9da4-e7e8-11ee-b3b3-dc21486e292b', 'Coordinator', '2024-03-22 01:04:26', '2024-03-22 01:04:25'),
('200eab09-e7e8-11ee-b3b3-dc21486e292b', 'Student', '2024-03-22 01:04:27', '2024-03-22 01:04:25'),
('200eb6b6-e7e8-11ee-b3b3-dc21486e292b', 'Guest', '2024-03-22 01:04:28', '2024-03-22 01:04:25'),
('cba83423-e7e7-11ee-b3b3-dc21486e292b', 'Root', '2024-03-22 01:02:03', '2024-03-22 01:02:03'),
('f98fd3df-e7e7-11ee-b3b3-dc21486e292b', 'Admin', '2024-03-22 01:03:20', '2024-03-22 01:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `role_id` char(36) NOT NULL,
  `faculty_id` char(36) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `email_verified_at`, `password`, `avatar`, `role_id`, `faculty_id`, `remember_token`, `created_at`, `updated_at`) VALUES
('082f20e6-964c-46c0-a2f6-e8a11a74f43f', 'coordinatorTest4', 'Coordinator Test 4', 'coordinatorTest4@gmail.com', NULL, '$2y$10$Va7LkidBoYTasKLjKTJOTecVDIAoh3YMngXuWJGmiKjFa8EgS65p.', 'public/uploads/images/users/default-user.jpg', '200e9da4-e7e8-11ee-b3b3-dc21486e292b', NULL, NULL, '2024-03-24 23:36:08', '2024-03-25 00:17:11'),
('1b4950eb-f987-4578-b1c3-67f6815b8040', 'coordinatorTest3', 'Coordinator Test 3', 'coordinatorTest3@gmail.com', NULL, '$2y$10$xlr73xEtfzmJPX9pmjpbOetQfraTuwE0zMnEwbSDOQRTHrnocHNgS', 'public/uploads/images/users/default-user.jpg', '200e9da4-e7e8-11ee-b3b3-dc21486e292b', NULL, NULL, '2024-03-24 08:53:56', '2024-03-25 00:15:19'),
('2b95bca5-6276-4004-9208-a53a3b104527', 'studentTest1', 'Student Test 1', 'studentTest1@gmail.com', NULL, '$2y$10$0JsdXKxnaU3wLdsFRqEhN.0Wp0/z2GkvWx1BlqXmnugE4JoCKsqFm', 'public/uploads/images/users/default-user.jpg', '200eab09-e7e8-11ee-b3b3-dc21486e292b', 'f99f6413-e9a2-11ee-9ab6-dc21486e292b', NULL, '2024-03-24 23:31:15', '2024-03-24 23:34:32'),
('2c65d62b-4a6d-4a97-ad8b-e62c4777272b', 'studentTest', 'Student Test', 'studentTest@gmail.com', NULL, '$2y$10$CBFz1blSrzCI7G87DvDfgOMU.fcIJwSmxOD3Q6IBamvzg7vTBWYq2', 'public/uploads/images/users/default-user.jpg', '200eab09-e7e8-11ee-b3b3-dc21486e292b', 'f99f5750-e9a2-11ee-9ab6-dc21486e292b', NULL, '2024-03-24 23:33:37', '2024-03-24 23:33:37'),
('37de1f3c-77c8-456e-aa68-35ec1d9d1a61', 'root', 'Root', 'root@gmail.com', NULL, '$2y$10$dq7SWcEgQI3RwImepoDzG.1Ixxs2DEL1qdiZL3GMkS/3nhxwVlOHi', 'public/uploads/images/users/avatar-1.jpg', 'cba83423-e7e7-11ee-b3b3-dc21486e292b', NULL, 'UhSXJ384pWjlyBgd7snsAJ5wgYrojP2If227VKkZHw2WAFy7Mvn9U27eJg4c', '2024-03-21 18:50:23', '2024-03-23 00:03:20'),
('482d2466-810e-44e3-8086-ac4af869b474', 'root1', 'Root1', 'root1@gmail.com', NULL, '$2y$10$LTiW9SL2yfIIGjYeQIZCbOxnrWxa9U2GzAYkyf9uo0ylyij1KJGMO', 'public/uploads/images/users/avatar-3.jpg', 'cba83423-e7e7-11ee-b3b3-dc21486e292b', NULL, NULL, '2024-03-21 18:31:59', '2024-03-21 18:31:59'),
('5735fb25-3479-41e5-b0c5-e93d750d8862', 'coordinatorTest', 'Coordinator Test', 'coordinatorTest@gmail.com', NULL, '$2y$10$RdG4wSu0nc.Calx2uPOLJeYul2RfDT3oMY8qBdKRWNzGiTA6/AZYO', 'public/uploads/images/users/default-user.jpg', '200e9da4-e7e8-11ee-b3b3-dc21486e292b', NULL, NULL, '2024-03-24 08:14:52', '2024-03-25 00:39:48'),
('a65a2a8e-098b-4d18-bc45-c824d38a6ce2', 'root2', 'Root2', 'root2@gmail.com', NULL, '$2y$10$VtqMF9Ok3XhMm47JRCuNuOnyBuKGe1GVGUy4RZvXYqkUSy8MYAp2i', 'public/uploads/images/users/avatar-2.jpg', 'cba83423-e7e7-11ee-b3b3-dc21486e292b', NULL, NULL, '2024-03-21 18:35:54', '2024-03-21 18:35:54'),
('b835ba7b-1ff6-4cf6-8c14-8253799e7d28', 'coordinatorTest5', 'Coordinator Test 5', 'coordinatorTest5@gmail.com', NULL, '$2y$10$T4Z1a4964Yi/eUkHc1a9.OTUlH6WLZus/5GY9SFyNk3uzgz5hil5y', 'public/uploads/images/users/default-user.jpg', '200e9da4-e7e8-11ee-b3b3-dc21486e292b', 'f99f7051-e9a2-11ee-9ab6-dc21486e292b', NULL, '2024-03-25 00:24:58', '2024-03-27 01:57:35'),
('eead02aa-0239-4385-b82a-070c499e3ef7', 'coordinatorTest2', 'Coordinator Test 2', 'coordinatorTest2@gmail.com', NULL, '$2y$10$WsVvrPNykZo9QwzzGrmhkOuG0viYOD30TwVS6Xi9IqWKO3dO8I5TS', 'public/uploads/images/users/default-user.jpg', '200e9da4-e7e8-11ee-b3b3-dc21486e292b', NULL, NULL, '2024-03-24 22:11:05', '2024-03-24 22:11:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faculties_coordinator_id_unique` (`coordinator_id`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_user` (`role_id`),
  ADD KEY `faculty_user` (`faculty_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_coordinator_id_foreign` FOREIGN KEY (`coordinator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `faculty_user` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `role_user` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
