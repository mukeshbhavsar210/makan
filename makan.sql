-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 02:02 PM
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
-- Database: `makan`
--

-- --------------------------------------------------------

--
-- Table structure for table `ages`
--

CREATE TABLE `ages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ages`
--

INSERT INTO `ages` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Less than 1 year', 1, '2025-08-15 11:26:26', '2025-08-15 11:26:26'),
(2, 'Less than 3 years', 1, '2025-08-15 11:26:26', '2025-08-15 11:26:26'),
(3, 'Less than 5 years', 1, '2025-08-15 11:26:26', '2025-08-15 11:26:26'),
(4, 'More than 5 years', 1, '2025-08-15 11:26:26', '2025-08-15 11:26:26');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `title`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gated Community', 'icon', 1, '2023-12-25 00:29:49', '2025-01-07 01:23:02'),
(2, 'Lift', 'icon', 1, '2025-01-07 01:34:02', '2025-01-07 01:34:02'),
(3, 'Swimming Pool', 'icon', 1, '2025-01-07 01:36:52', '2025-01-07 01:36:52'),
(4, 'Gym', 'gym', 1, '2025-01-10 23:26:52', '2025-01-10 23:26:52'),
(5, 'Parking', 'gym', 1, '2025-01-10 23:26:52', '2025-01-10 23:26:52'),
(6, 'Gas Pipeline', 'gym', 1, '2025-01-10 23:26:52', '2025-01-10 23:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `slug`, `city_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chandkheda', 'chandkheda', 1, 1, '2024-12-30 06:14:19', '2024-12-30 06:14:19'),
(2, 'Electronic City', 'electronic-city', 2, 1, '2024-12-30 06:14:44', '2024-12-30 06:14:44'),
(11, 'Bopal', 'bopal', 1, 1, '2025-01-07 04:46:24', '2025-01-07 04:46:24'),
(12, 'HSR Layout', 'hsr-layout', 2, 1, '2025-01-07 04:46:34', '2025-01-07 04:46:34'),
(13, 'BTM Layout', 'btm-layout', 2, 1, '2025-01-07 04:46:49', '2025-01-07 04:46:49'),
(15, 'Bapunagar', 'bapunagar', 1, 1, '2025-01-08 07:01:48', '2025-01-08 07:01:48'),
(17, 'Bannergatta', 'bannergatta', 2, 1, '2025-01-27 06:28:39', '2025-01-27 06:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `bathrooms`
--

CREATE TABLE `bathrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bathrooms`
--

INSERT INTO `bathrooms` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, '1 Bath', 1, '2024-12-31 09:14:46', '2024-12-31 09:14:46'),
(2, '2 Baths', 1, '2024-12-31 09:14:57', '2024-12-31 09:14:57'),
(3, '3 Baths', 1, '2024-12-31 09:14:57', '2024-12-31 09:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `builders`
--

CREATE TABLE `builders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `related_properties` longtext DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `landline` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `year_estd` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `builders`
--

INSERT INTO `builders` (`id`, `name`, `related_properties`, `email`, `landline`, `mobile`, `whatsapp`, `logo`, `year_estd`, `address`, `property_id`, `status`, `created_at`, `updated_at`) VALUES
(34, 'Keerthi Estate', '46,44', 'info@keerthiestate.com', '079-15478598', '9978835115', '9987754875', '34_Keerthi Estate.JPG', '1985', 'Hyderabad', NULL, 1, '2025-01-04 03:58:23', '2025-01-04 03:58:23'),
(41, 'Sanghani Infrastructure', '46,44', 'mukeshbhavsar210@gmail.com', '9978812345', '09978835005', '99788251478', '41_Sanghani Infrastructure.png', '1975', 'Keerthi Royal Palms,', NULL, 1, '2025-01-08 07:26:20', '2025-01-08 07:26:20'),
(42, 'Dobariya & Company', '46,44', 'info@dobariya.com', '089-1234567', '9978812345', '9978812345', NULL, '1990', 'Vejalpur', NULL, 1, '2025-01-10 23:28:06', '2025-08-14 05:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `buysell`
--

CREATE TABLE `buysell` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(21, 'Buy', 1, '2025-01-01 05:48:27', '2025-01-01 05:48:27'),
(27, 'Rent', 1, '2025-01-04 04:59:56', '2025-01-04 04:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ahmedabad', 'ahmedabad', 1, '2024-12-30 06:13:43', '2024-12-30 06:13:43'),
(2, 'Banglore', 'banglore', 1, '2024-12-30 06:13:43', '2024-12-30 06:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `constructions`
--

CREATE TABLE `constructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `constructions`
--

INSERT INTO `constructions` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ready to move', 1, '2025-08-15 10:49:09', '2025-08-15 10:49:09'),
(2, 'Under construction', 1, '2025-08-15 10:49:09', '2025-08-15 10:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Mukesh Bhavsar', '', 'mukeshbhavsar210@gmail.com', 'This is my first message', '2025-01-06 23:47:52', '2025-01-06 23:47:52'),
(2, 'Dhruv Bhavsar', '', 'dhruvbhavsar210@gmail.com', 'This is message from Dhruv', '2025-01-06 23:48:54', '2025-01-06 23:48:54'),
(3, 'Mukesh Bhavsar', '9978835005', 'mukeshbhavsar210@gmail.com', 'This is my second message', '2025-01-06 23:52:53', '2025-01-06 23:52:53'),
(4, 'Priyanka', '9538135005', 'priyanka@gmail.com', 'This is my messge', '2025-01-07 00:04:58', '2025-01-07 00:04:58'),
(5, 'Mukesh Bhavsar2', '9978835001', 'mukeshbhavsar210@gmail.com', 'dfsfdsfdsfsdfsdf', '2025-01-07 00:06:02', '2025-01-07 00:06:02'),
(6, 'Sona Bhavsar', '9978835005', 'mukeshbhavsar210@gmail.com', 'This is Sona Bhavar', '2025-01-07 00:22:26', '2025-01-07 00:22:26'),
(7, 'Mukesh Bhavsar', '9978835005', 'mukeshbhavsar210@gmail.com', 'New Message', '2025-01-07 00:41:45', '2025-01-07 00:41:45');

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
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `applied_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Swimming Pool', 1, '2023-12-25 00:29:50', '2023-12-25 00:29:50'),
(2, 'Gym', 1, '2023-12-25 00:29:50', '2023-12-25 00:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `listed_types`
--

CREATE TABLE `listed_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listed_types`
--

INSERT INTO `listed_types` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Agent', 1, '2025-08-15 11:51:54', '2025-08-15 11:51:54'),
(2, 'Owner', 1, '2025-08-15 11:51:54', '2025-08-15 11:51:54'),
(3, 'Developer', 1, '2025-08-15 11:51:54', '2025-08-15 11:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_25_054112_create_categories_table', 2),
(6, '2023_12_25_054145_create_job_types_table', 2),
(7, '2023_12_25_054227_create_jobs_table', 2),
(8, '2024_01_14_055559_create_job_applications_table', 3),
(9, '2024_01_24_110511_create_saved_jobs_table', 3),
(10, '2024_02_06_115213_alter_users_table', 4),
(11, '2024_12_28_112632_create_jobs_table', 5),
(12, '2024_12_28_113027_create_jobs_table', 6),
(13, '2024_12_28_115835_create_cities_table', 7),
(14, '2024_12_28_115928_create_amenities_table', 7),
(15, '2024_12_28_115959_create_bhk_types_table', 7),
(16, '2024_12_28_120113_create_sale_type_table', 8),
(17, '2024_12_29_155209_create_cities_table', 9),
(18, '2024_12_29_155455_create_areas_table', 10),
(19, '2024_12_29_155603_create_developers_table', 11),
(20, '2024_12_29_155857_create_property_types_table', 12),
(21, '2024_12_29_160022_create_bhk_types_table', 13),
(22, '2024_12_29_160046_create_sale_types_table', 14),
(23, '2024_12_29_160127_create_construction_status_table', 15),
(24, '2024_12_29_160204_create_listings_table', 16),
(25, '2024_12_29_160244_create_facings_table', 17),
(26, '2024_12_29_160330_create_ages_table', 18),
(27, '2024_12_29_160832_create_buy_sell_table', 19),
(28, '2024_12_29_160854_create_properties_table', 20),
(29, '2024_12_30_064105_alter_jobs_table', 21),
(30, '2024_12_30_065158_alter_jobs_table', 22),
(31, '2024_12_30_070432_create_jobs_table', 23),
(32, '2024_12_31_084527_create_properties_table', 24),
(33, '2024_12_31_091246_create_baths_table', 25),
(34, '2024_12_31_091530_alter_proprties_table', 26),
(35, '2024_12_31_110918_create_saved_properties_table', 27),
(36, '2024_12_31_122143_alter_job_applications_table', 28),
(37, '2025_01_01_071645_create_property_applications_table', 29),
(38, '2025_01_01_084641_create_property_images_table', 30),
(39, '2025_01_01_084728_create_temp_images_table', 31),
(40, '2025_01_02_044951_create_developers_table', 32),
(41, '2025_01_02_121843_alter_properties_table', 33),
(42, '2025_01_07_050956_create_contacts_table', 34),
(43, '2025_01_17_073955_create_property_documents_table', 35),
(44, '2025_08_15_104747_create_constructions_table', 36),
(45, '2025_08_15_105152_add_construction_id_to_properties_table', 37),
(46, '2025_08_15_112907_add_age_id_to_properties_table', 38),
(47, '2025_08_15_114233_add_amenity_id_to_properties_table', 39),
(48, '2025_08_15_115103_create_listed_types_table', 40),
(49, '2025_08_15_115424_add_listed_type_id_to_properties_table', 41);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('mukeshbhavsar210@gmail.com', 'wiZ9QTZ3diRk6ZcKkN2WMbRGEtkwmuPWUSgV5aOuI68TWfACw5Pfs4oHxrsl', '2024-03-03 00:01:24');

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
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `builder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `property_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `view_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `rera` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `year_build` varchar(100) DEFAULT NULL,
  `total_area` varchar(50) DEFAULT NULL,
  `related_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `related_amenities` longtext DEFAULT NULL,
  `related_facings` longtext DEFAULT NULL,
  `related_documents` longtext NOT NULL,
  `possession_date` date DEFAULT NULL,
  `handover_status` enum('Under Construction','Ready to Move') NOT NULL DEFAULT 'Under Construction',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bathroom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `construction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `age_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amenity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `listed_type_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `slug`, `user_id`, `category_id`, `room_id`, `city_id`, `area_id`, `builder_id`, `sale_type_id`, `property_type_id`, `view_id`, `price`, `compare_price`, `description`, `keywords`, `location`, `size`, `rera`, `year_build`, `total_area`, `related_properties`, `related_amenities`, `related_facings`, `related_documents`, `possession_date`, `handover_status`, `status`, `created_at`, `updated_at`, `bathroom_id`, `is_featured`, `construction_id`, `age_id`, `amenity_id`, `listed_type_id`) VALUES
(44, 'Shlok Heights', 'shlok-heights', 3, 21, 4, 1, 1, 41, 1, 2, 2, 4500000.00, 450000.00, 'Shlok Heights', '3 BHK Apartment Mukesh', 'Mansarovar Road', '1000', NULL, NULL, NULL, '', '', NULL, '', '2027-08-31', 'Ready to Move', 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 2, 'Yes', 1, 1, NULL, 3),
(50, 'Global Techie Town', 'global-techie-town', 3, 27, 2, 2, 2, 42, 2, 2, NULL, 9000000.00, 8800000.00, 'Details', '3 BHK Apartment', 'Electronic City', '1800', '123', '2024', '20000', '', '1,7,8,11', '1', '', '2027-08-31', 'Under Construction', 1, '2025-01-10 23:30:34', '2025-01-16 23:49:13', 2, 'Yes', NULL, NULL, NULL, NULL),
(51, 'Samarthya Status', 'samarthya_status', 3, 27, 1, 1, 11, 34, NULL, 2, NULL, 5500000.00, 5000000.00, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', '1000', NULL, NULL, NULL, '', '', NULL, '', NULL, 'Under Construction', 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 1, 'Yes', NULL, NULL, NULL, NULL),
(52, 'Manavnagar', 'samarthya_status', 3, 21, 1, 1, 11, 34, NULL, 2, NULL, 9800000.00, 8500000.00, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', '1000', NULL, NULL, NULL, '', '', NULL, '', NULL, 'Under Construction', 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 1, 'Yes', NULL, NULL, NULL, NULL),
(53, 'Swastik Marvella', 'swastik_marvella', 3, 21, 3, 1, 1, 34, 2, 3, 1, 11000000.00, 8500000.00, 'Swastik Marvella', '3 BHK Apartment', 'IOC Road', '1000', NULL, NULL, NULL, '', '', NULL, '', NULL, 'Under Construction', 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 3, 'Yes', 2, 4, NULL, 1),
(54, 'Saijpur Bogha', 'saigpur-bogha', 3, 21, 4, 1, 1, 34, NULL, 2, NULL, 9800000.00, 8500000.00, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', '1000', NULL, NULL, NULL, '', '', NULL, '', NULL, 'Under Construction', 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 1, 'Yes', 1, NULL, NULL, NULL),
(55, 'Sattva', 'sattva', 3, 21, 4, 2, 12, 34, NULL, 2, NULL, 9800000.00, 8500000.00, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', '1000', NULL, NULL, NULL, '', '', NULL, '', NULL, 'Under Construction', 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 1, 'Yes', NULL, NULL, NULL, NULL),
(56, 'Brigade', 'brigade', 3, 21, 4, 2, 2, 34, NULL, 2, NULL, 9800000.00, 8500000.00, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', '1000', NULL, NULL, NULL, '', '', NULL, '', NULL, 'Under Construction', 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 1, 'Yes', NULL, NULL, NULL, NULL),
(57, 'Navami Funique', 'navami_funique', 3, 21, 4, 2, 2, 42, NULL, 2, NULL, 9800000.00, 8500000.00, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', '1000', NULL, NULL, NULL, '', '', NULL, '', NULL, 'Under Construction', 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 1, 'Yes', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_applications`
--

CREATE TABLE `property_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `posted_id` bigint(20) UNSIGNED NOT NULL,
  `applied_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_documents`
--

CREATE TABLE `property_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `property_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(53, 44, '44-Shlok Heights-1736337438.JPG', NULL, '2025-01-08 06:27:18', '2025-01-08 06:27:18'),
(64, 44, '44-Shlok Heights-1736337445.JPG', NULL, '2025-01-08 06:27:25', '2025-01-08 06:27:25'),
(71, 44, '44-Shlok Heights-1736338424.JPG', NULL, '2025-01-08 06:43:44', '2025-01-08 06:43:44'),
(72, 44, '44-Shlok Heights-1736338426.jpg', NULL, '2025-01-08 06:43:46', '2025-01-08 06:43:46'),
(80, 50, '50-Shayamal Row House-1736571634.jpg', NULL, '2025-01-10 23:30:34', '2025-01-10 23:30:34'),
(81, 50, '50-Shayamal Row House-1736571635.jpg', NULL, '2025-01-10 23:30:35', '2025-01-10 23:30:35'),
(82, 50, '50-Shayamal Row House-1736571636.jpg', NULL, '2025-01-10 23:30:35', '2025-01-10 23:30:36'),
(83, 50, '50-Shayamal Row House-1736571636.jpg', NULL, '2025-01-10 23:30:36', '2025-01-10 23:30:36'),
(84, 50, '50-Shayamal Row House-1736574384.JPG', NULL, '2025-01-11 00:16:24', '2025-01-11 00:16:24'),
(85, 50, '50-Shayamal Row House-1736574385.JPG', NULL, '2025-01-11 00:16:25', '2025-01-11 00:16:25'),
(86, 50, '50-Shayamal Row House-1736574387.JPG', NULL, '2025-01-11 00:16:27', '2025-01-11 00:16:27'),
(87, 50, '50-Shayamal Row House-1736574389.JPG', NULL, '2025-01-11 00:16:29', '2025-01-11 00:16:29'),
(88, 50, '50-Shayamal Row House-1736574459.JPG', NULL, '2025-01-11 00:17:39', '2025-01-11 00:17:39'),
(89, 50, '50-Shayamal Row House-1736574460.JPG', NULL, '2025-01-11 00:17:40', '2025-01-11 00:17:40'),
(90, 50, '50-Shayamal Row House-1736574462.JPG', NULL, '2025-01-11 00:17:42', '2025-01-11 00:17:42'),
(91, 50, '50-Shayamal Row House-1736574464.JPG', NULL, '2025-01-11 00:17:44', '2025-01-11 00:17:44'),
(92, 50, '50-Shayamal Row House-1736574465.JPG', NULL, '2025-01-11 00:17:45', '2025-01-11 00:17:45'),
(93, 50, '50-Shayamal Row House-1736574466.JPG', NULL, '2025-01-11 00:17:46', '2025-01-11 00:17:46'),
(94, 50, '50-Shayamal Row House-1736574468.JPG', NULL, '2025-01-11 00:17:48', '2025-01-11 00:17:48'),
(95, 50, '50-Shayamal Row House-1736574469.JPG', NULL, '2025-01-11 00:17:49', '2025-01-11 00:17:49'),
(96, 50, '50-Shayamal Row House-1737091154.JPG', NULL, '2025-01-16 23:49:14', '2025-01-16 23:49:14'),
(97, 50, '50-Shayamal Row House-1737091155.JPG', NULL, '2025-01-16 23:49:15', '2025-01-16 23:49:15'),
(98, 50, '50-Shayamal Row House-1737091157.JPG', NULL, '2025-01-16 23:49:17', '2025-01-16 23:49:17'),
(99, 50, '50-Shayamal Row House-1737091158.JPG', NULL, '2025-01-16 23:49:18', '2025-01-16 23:49:18'),
(100, 50, '50-Shayamal Row House-1737091160.JPG', NULL, '2025-01-16 23:49:20', '2025-01-16 23:49:20'),
(101, 50, '50-Shayamal Row House-1737091161.JPG', NULL, '2025-01-16 23:49:21', '2025-01-16 23:49:21'),
(102, 50, '50-Shayamal Row House-1737091163.JPG', NULL, '2025-01-16 23:49:23', '2025-01-16 23:49:23'),
(103, 50, '50-Shayamal Row House-1737091164.JPG', NULL, '2025-01-16 23:49:24', '2025-01-16 23:49:24'),
(104, 50, '50-Shayamal Row House-1737091167.JPG', NULL, '2025-01-16 23:49:27', '2025-01-16 23:49:27'),
(105, 50, '50-Shayamal Row House-1737091168.JPG', NULL, '2025-01-16 23:49:28', '2025-01-16 23:49:28'),
(106, 50, '50-Shayamal Row House-1737091169.JPG', NULL, '2025-01-16 23:49:29', '2025-01-16 23:49:29'),
(107, 50, '50-Shayamal Row House-1737091171.JPG', NULL, '2025-01-16 23:49:31', '2025-01-16 23:49:31'),
(108, 50, '50-Shayamal Row House-1737091173.JPG', NULL, '2025-01-16 23:49:33', '2025-01-16 23:49:33'),
(109, 50, '50-Shayamal Row House-1737091174.JPG', NULL, '2025-01-16 23:49:34', '2025-01-16 23:49:34'),
(110, 50, '50-Shayamal Row House-1737091175.JPG', NULL, '2025-01-16 23:49:35', '2025-01-16 23:49:35'),
(111, 50, '50-Shayamal Row House-1737091176.JPG', NULL, '2025-01-16 23:49:36', '2025-01-16 23:49:36');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Villa', 1, '2024-12-31 08:56:55', '2024-12-31 08:56:55'),
(2, 'Flat', 1, '2024-12-31 09:20:05', '2024-12-31 09:20:05'),
(3, 'Individual Home', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, '1 RK', 1, '2024-12-29 17:55:12', '2024-12-29 17:55:12'),
(2, '1 BHK', 1, '2024-12-29 17:55:31', '2024-12-29 17:55:31'),
(3, '2 BHK', 1, '2024-12-29 17:55:43', '2024-12-29 17:55:43'),
(4, '3 BHK', 1, '2024-12-29 17:55:43', '2024-12-29 17:55:43'),
(5, '4 BHK', 1, '2024-12-29 17:55:43', '2024-12-29 17:55:43'),
(6, '5 BHK', 1, '2024-12-29 17:55:43', '2024-12-29 17:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `sale_types`
--

CREATE TABLE `sale_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Sell',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_types`
--

INSERT INTO `sale_types` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New Booking', 1, '2024-12-31 08:57:22', '2024-12-31 08:57:22'),
(2, 'Resale', 1, '2024-12-31 09:09:33', '2024-12-31 09:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `saved_properties`
--

CREATE TABLE `saved_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saved_properties`
--

INSERT INTO `saved_properties` (`id`, `property_id`, `user_id`, `created_at`, `updated_at`) VALUES
(33, 50, 4, '2025-01-17 01:55:45', '2025-01-17 01:55:45'),
(34, 44, 3, '2025-01-27 06:31:10', '2025-01-27 06:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_images`
--

INSERT INTO `temp_images` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '1735723223.JPG', '2025-01-01 03:50:23', '2025-01-01 03:50:23'),
(2, '1735725693.JPG', '2025-01-01 04:31:33', '2025-01-01 04:31:33'),
(3, '1735726653.JPG', '2025-01-01 04:47:33', '2025-01-01 04:47:33'),
(4, '1735726825.JPG', '2025-01-01 04:50:25', '2025-01-01 04:50:25'),
(5, '1735726941.JPG', '2025-01-01 04:52:21', '2025-01-01 04:52:21'),
(6, '1735727389.JPG', '2025-01-01 04:59:49', '2025-01-01 04:59:49'),
(7, '1735727439.jpg', '2025-01-01 05:00:39', '2025-01-01 05:00:39'),
(8, '1735727560.jpg', '2025-01-01 05:02:40', '2025-01-01 05:02:40'),
(9, '1735727616.jpg', '2025-01-01 05:03:36', '2025-01-01 05:03:36'),
(10, '1735728174.jpg', '2025-01-01 05:12:54', '2025-01-01 05:12:54'),
(11, '1735728255.jpg', '2025-01-01 05:14:15', '2025-01-01 05:14:15'),
(12, '1735728343.jpg', '2025-01-01 05:15:43', '2025-01-01 05:15:43'),
(13, '1735728377.JPG', '2025-01-01 05:16:17', '2025-01-01 05:16:17'),
(14, '1735728794.JPG', '2025-01-01 05:23:14', '2025-01-01 05:23:14'),
(15, '1735728887.JPG', '2025-01-01 05:24:47', '2025-01-01 05:24:47'),
(16, '1735728950.JPG', '2025-01-01 05:25:50', '2025-01-01 05:25:50'),
(17, '1735729067.JPG', '2025-01-01 05:27:47', '2025-01-01 05:27:47'),
(18, '1735729088.JPG', '2025-01-01 05:28:08', '2025-01-01 05:28:08'),
(19, '1735729142.JPG', '2025-01-01 05:29:02', '2025-01-01 05:29:02'),
(20, '1735730196.JPG', '2025-01-01 05:46:36', '2025-01-01 05:46:36'),
(21, '1735730306.JPG', '2025-01-01 05:48:26', '2025-01-01 05:48:26'),
(22, '1735730433.JPG', '2025-01-01 05:50:33', '2025-01-01 05:50:33'),
(23, '1735732384.JPG', '2025-01-01 06:23:04', '2025-01-01 06:23:04'),
(24, '1735733732.JPG', '2025-01-01 06:45:32', '2025-01-01 06:45:32'),
(25, '1735735732.JPG', '2025-01-01 07:18:52', '2025-01-01 07:18:52'),
(26, '1735796550.JPG', '2025-01-02 00:12:30', '2025-01-02 00:12:30'),
(27, '1735796671.JPG', '2025-01-02 00:14:31', '2025-01-02 00:14:31'),
(28, '1735796802.JPG', '2025-01-02 00:16:42', '2025-01-02 00:16:42'),
(29, '1735796882.JPG', '2025-01-02 00:18:02', '2025-01-02 00:18:02'),
(30, '1735797088.JPG', '2025-01-02 00:21:28', '2025-01-02 00:21:28'),
(31, '1735797156.JPG', '2025-01-02 00:22:36', '2025-01-02 00:22:36'),
(32, '1735797246.JPG', '2025-01-02 00:24:06', '2025-01-02 00:24:06'),
(33, '1735797351.JPG', '2025-01-02 00:25:51', '2025-01-02 00:25:51'),
(34, '1735881178.jpg', '2025-01-02 23:42:58', '2025-01-02 23:42:58'),
(35, '1735882029.jpg', '2025-01-02 23:57:09', '2025-01-02 23:57:09'),
(36, '1735882078.jpeg', '2025-01-02 23:57:58', '2025-01-02 23:57:58'),
(37, '1735965155.jpg', '2025-01-03 23:02:35', '2025-01-03 23:02:35'),
(38, '1735975296.jpg', '2025-01-04 01:51:36', '2025-01-04 01:51:36'),
(39, '1735975405.jpg', '2025-01-04 01:53:25', '2025-01-04 01:53:25'),
(40, '1735975490.jpeg', '2025-01-04 01:54:50', '2025-01-04 01:54:50'),
(41, '1735975549.jpg', '2025-01-04 01:55:49', '2025-01-04 01:55:49'),
(42, '1735975798.JPG', '2025-01-04 01:59:58', '2025-01-04 01:59:58'),
(43, '1735975875.JPG', '2025-01-04 02:01:15', '2025-01-04 02:01:15'),
(44, '1735975926.JPG', '2025-01-04 02:02:06', '2025-01-04 02:02:06'),
(45, '1735975982.JPG', '2025-01-04 02:03:02', '2025-01-04 02:03:02'),
(46, '1735976027.JPG', '2025-01-04 02:03:47', '2025-01-04 02:03:47'),
(47, '1735976032.JPG', '2025-01-04 02:03:52', '2025-01-04 02:03:52'),
(48, '1735976094.JPG', '2025-01-04 02:04:54', '2025-01-04 02:04:54'),
(49, '1735976149.JPG', '2025-01-04 02:05:49', '2025-01-04 02:05:49'),
(50, '1735982845.JPG', '2025-01-04 03:57:25', '2025-01-04 03:57:25'),
(51, '1735982866.JPG', '2025-01-04 03:57:46', '2025-01-04 03:57:46'),
(52, '1735983303.JPG', '2025-01-04 04:05:03', '2025-01-04 04:05:03'),
(53, '1735995462.JPG', '2025-01-04 07:27:42', '2025-01-04 07:27:42'),
(54, '1735995717.JPG', '2025-01-04 07:31:57', '2025-01-04 07:31:57'),
(55, '1735998566.JPG', '2025-01-04 08:19:26', '2025-01-04 08:19:26'),
(56, '1735998629.JPG', '2025-01-04 08:20:29', '2025-01-04 08:20:29'),
(57, '1735999281.JPG', '2025-01-04 08:31:21', '2025-01-04 08:31:21'),
(58, '1736072753.jpg', '2025-01-05 04:55:53', '2025-01-05 04:55:53'),
(59, '1736072915.jpg', '2025-01-05 04:58:35', '2025-01-05 04:58:35'),
(60, '1736072982.jpg', '2025-01-05 04:59:42', '2025-01-05 04:59:42'),
(61, '1736073029.jpg', '2025-01-05 05:00:29', '2025-01-05 05:00:29'),
(62, '1736073109.jpg', '2025-01-05 05:01:49', '2025-01-05 05:01:49'),
(63, '1736073234.jpg', '2025-01-05 05:03:54', '2025-01-05 05:03:54'),
(64, '1736073303.jpg', '2025-01-05 05:05:03', '2025-01-05 05:05:03'),
(65, '1736073575.jpg', '2025-01-05 05:09:35', '2025-01-05 05:09:35'),
(66, '1736073575.jpg', '2025-01-05 05:09:35', '2025-01-05 05:09:35'),
(67, '1736073576.jpg', '2025-01-05 05:09:36', '2025-01-05 05:09:36'),
(68, '1736073576.jpg', '2025-01-05 05:09:36', '2025-01-05 05:09:36'),
(69, '1736073685.jpg', '2025-01-05 05:11:25', '2025-01-05 05:11:25'),
(70, '1736073685.jpg', '2025-01-05 05:11:25', '2025-01-05 05:11:25'),
(71, '1736073686.jpg', '2025-01-05 05:11:26', '2025-01-05 05:11:26'),
(72, '1736073686.jpg', '2025-01-05 05:11:26', '2025-01-05 05:11:26'),
(73, '1736073994.jpg', '2025-01-05 05:16:34', '2025-01-05 05:16:34'),
(74, '1736074035.jpg', '2025-01-05 05:17:15', '2025-01-05 05:17:15'),
(75, '1736074124.jpg', '2025-01-05 05:18:44', '2025-01-05 05:18:44'),
(76, '1736074188.jpg', '2025-01-05 05:19:48', '2025-01-05 05:19:48'),
(77, '1736146707.jpg', '2025-01-06 01:28:27', '2025-01-06 01:28:27'),
(78, '1736146710.jpg', '2025-01-06 01:28:30', '2025-01-06 01:28:30'),
(79, '1736146710.jpg', '2025-01-06 01:28:30', '2025-01-06 01:28:30'),
(80, '1736147283.JPG', '2025-01-06 01:38:03', '2025-01-06 01:38:03'),
(81, '1736147286.JPG', '2025-01-06 01:38:06', '2025-01-06 01:38:06'),
(82, '1736147288.JPG', '2025-01-06 01:38:08', '2025-01-06 01:38:08'),
(83, '1736147290.JPG', '2025-01-06 01:38:10', '2025-01-06 01:38:10'),
(84, '1736147400.JPG', '2025-01-06 01:40:00', '2025-01-06 01:40:00'),
(85, '1736147451.JPG', '2025-01-06 01:40:51', '2025-01-06 01:40:51'),
(86, '1736147508.JPG', '2025-01-06 01:41:48', '2025-01-06 01:41:48'),
(87, '1736147623.JPG', '2025-01-06 01:43:43', '2025-01-06 01:43:43'),
(88, '1736147696.JPG', '2025-01-06 01:44:56', '2025-01-06 01:44:56'),
(89, '1736147698.JPG', '2025-01-06 01:44:58', '2025-01-06 01:44:58'),
(90, '1736147701.JPG', '2025-01-06 01:45:01', '2025-01-06 01:45:01'),
(91, '1736147703.JPG', '2025-01-06 01:45:03', '2025-01-06 01:45:03'),
(92, '1736147749.JPG', '2025-01-06 01:45:49', '2025-01-06 01:45:49'),
(93, '1736147752.JPG', '2025-01-06 01:45:52', '2025-01-06 01:45:52'),
(94, '1736147832.JPG', '2025-01-06 01:47:12', '2025-01-06 01:47:12'),
(95, '1736147899.JPG', '2025-01-06 01:48:19', '2025-01-06 01:48:19'),
(96, '1736147972.JPG', '2025-01-06 01:49:32', '2025-01-06 01:49:32'),
(97, '1736147973.JPG', '2025-01-06 01:49:33', '2025-01-06 01:49:33'),
(98, '1736148112.JPG', '2025-01-06 01:51:52', '2025-01-06 01:51:52'),
(99, '1736148145.JPG', '2025-01-06 01:52:25', '2025-01-06 01:52:25'),
(100, '1736148262.JPG', '2025-01-06 01:54:22', '2025-01-06 01:54:22'),
(101, '1736148263.JPG', '2025-01-06 01:54:23', '2025-01-06 01:54:23'),
(102, '1736148540.JPG', '2025-01-06 01:59:00', '2025-01-06 01:59:00'),
(103, '1736148540.JPG', '2025-01-06 01:59:00', '2025-01-06 01:59:00'),
(104, '1736148541.JPG', '2025-01-06 01:59:01', '2025-01-06 01:59:01'),
(105, '1736148567.JPG', '2025-01-06 01:59:27', '2025-01-06 01:59:27'),
(106, '1736148571.JPG', '2025-01-06 01:59:31', '2025-01-06 01:59:31'),
(107, '1736148698.JPG', '2025-01-06 02:01:38', '2025-01-06 02:01:38'),
(108, '1736148700.JPG', '2025-01-06 02:01:40', '2025-01-06 02:01:40'),
(109, '1736148859.JPG', '2025-01-06 02:04:19', '2025-01-06 02:04:19'),
(110, '1736148860.JPG', '2025-01-06 02:04:20', '2025-01-06 02:04:20'),
(111, '1736149305.JPG', '2025-01-06 02:11:45', '2025-01-06 02:11:45'),
(112, '1736149307.JPG', '2025-01-06 02:11:47', '2025-01-06 02:11:47'),
(113, '1736149471.JPG', '2025-01-06 02:14:31', '2025-01-06 02:14:31'),
(114, '1736149472.JPG', '2025-01-06 02:14:32', '2025-01-06 02:14:32'),
(115, '1736149473.JPG', '2025-01-06 02:14:33', '2025-01-06 02:14:33'),
(116, '1736149473.JPG', '2025-01-06 02:14:33', '2025-01-06 02:14:33'),
(117, '1736150446.JPG', '2025-01-06 02:30:46', '2025-01-06 02:30:46'),
(118, '1736150446.JPG', '2025-01-06 02:30:46', '2025-01-06 02:30:46'),
(119, '1736150447.JPG', '2025-01-06 02:30:47', '2025-01-06 02:30:47'),
(120, '1736150448.JPG', '2025-01-06 02:30:48', '2025-01-06 02:30:48'),
(121, '1736150682.jpg', '2025-01-06 02:34:42', '2025-01-06 02:34:42'),
(122, '1736150682.jpg', '2025-01-06 02:34:42', '2025-01-06 02:34:42'),
(123, '1736150683.jpg', '2025-01-06 02:34:43', '2025-01-06 02:34:43'),
(124, '1736150683.jpg', '2025-01-06 02:34:43', '2025-01-06 02:34:43'),
(125, '1736150689.jpg', '2025-01-06 02:34:49', '2025-01-06 02:34:49'),
(126, '1736150691.jpg', '2025-01-06 02:34:51', '2025-01-06 02:34:51'),
(127, '1736152662.jpg', '2025-01-06 03:07:42', '2025-01-06 03:07:42'),
(128, '1736152663.jpg', '2025-01-06 03:07:43', '2025-01-06 03:07:43'),
(129, '1736152664.jpg', '2025-01-06 03:07:44', '2025-01-06 03:07:44'),
(130, '1736160120.JPG', '2025-01-06 05:12:00', '2025-01-06 05:12:00'),
(131, '1736160123.JPG', '2025-01-06 05:12:03', '2025-01-06 05:12:03'),
(132, '1736160124.JPG', '2025-01-06 05:12:04', '2025-01-06 05:12:04'),
(133, '1736160124.JPG', '2025-01-06 05:12:04', '2025-01-06 05:12:04'),
(134, '1736162090.JPG', '2025-01-06 05:44:50', '2025-01-06 05:44:50'),
(135, '1736162091.JPG', '2025-01-06 05:44:51', '2025-01-06 05:44:51'),
(136, '1736162092.JPG', '2025-01-06 05:44:52', '2025-01-06 05:44:52'),
(137, '1736162092.JPG', '2025-01-06 05:44:52', '2025-01-06 05:44:52'),
(138, '1736162247.JPG', '2025-01-06 05:47:27', '2025-01-06 05:47:27'),
(139, '1736162249.JPG', '2025-01-06 05:47:29', '2025-01-06 05:47:29'),
(140, '1736162251.JPG', '2025-01-06 05:47:31', '2025-01-06 05:47:31'),
(141, '1736163956.JPG', '2025-01-06 06:15:56', '2025-01-06 06:15:56'),
(142, '1736163958.JPG', '2025-01-06 06:15:58', '2025-01-06 06:15:58'),
(143, '1736167782.png', '2025-01-06 07:19:42', '2025-01-06 07:19:42'),
(144, '1736168006.jpg', '2025-01-06 07:23:26', '2025-01-06 07:23:26'),
(145, '1736168006.jpg', '2025-01-06 07:23:26', '2025-01-06 07:23:26'),
(146, '1736168446.jpg', '2025-01-06 07:30:46', '2025-01-06 07:30:46'),
(147, '1736233064.jpg', '2025-01-07 01:27:44', '2025-01-07 01:27:44'),
(148, '1736340330.png', '2025-01-08 07:15:30', '2025-01-08 07:15:30'),
(149, '1736340975.png', '2025-01-08 07:26:15', '2025-01-08 07:26:15'),
(150, '1736571483.png', '2025-01-10 23:28:03', '2025-01-10 23:28:03'),
(151, '1736571600.jpg', '2025-01-10 23:30:00', '2025-01-10 23:30:00'),
(152, '1736571601.jpg', '2025-01-10 23:30:01', '2025-01-10 23:30:01'),
(153, '1736571602.jpg', '2025-01-10 23:30:02', '2025-01-10 23:30:02'),
(154, '1736571602.jpg', '2025-01-10 23:30:02', '2025-01-10 23:30:02'),
(155, '1737099020.jpg', '2025-01-17 02:00:20', '2025-01-17 02:00:20'),
(156, '1737099023.jpg', '2025-01-17 02:00:23', '2025-01-17 02:00:23'),
(157, '1737099057.jpg', '2025-01-17 02:00:57', '2025-01-17 02:00:57'),
(158, '1737099057.jpg', '2025-01-17 02:00:57', '2025-01-17 02:00:57'),
(159, '1737099078.jpg', '2025-01-17 02:01:18', '2025-01-17 02:01:18'),
(160, '1737099078.jpg', '2025-01-17 02:01:18', '2025-01-17 02:01:18'),
(161, '1737099296.jpg', '2025-01-17 02:04:56', '2025-01-17 02:04:56'),
(162, '1737099296.jpg', '2025-01-17 02:04:56', '2025-01-17 02:04:56'),
(163, '1737099300.png', '2025-01-17 02:05:00', '2025-01-17 02:05:00'),
(164, '1737099387.jpg', '2025-01-17 02:06:27', '2025-01-17 02:06:27'),
(165, '1737099388.jpg', '2025-01-17 02:06:28', '2025-01-17 02:06:28'),
(166, '1737099391.png', '2025-01-17 02:06:31', '2025-01-17 02:06:31'),
(167, '1737099391.png', '2025-01-17 02:06:31', '2025-01-17 02:06:31'),
(168, '1737100092.jpg', '2025-01-17 02:18:12', '2025-01-17 02:18:12'),
(169, '1737100244.jpg', '2025-01-17 02:20:44', '2025-01-17 02:20:44'),
(170, '1737100245.pdf', '2025-01-17 02:20:45', '2025-01-17 02:20:45'),
(171, '1737100420.jpg', '2025-01-17 02:23:40', '2025-01-17 02:23:40'),
(172, '1737100489.pdf', '2025-01-17 02:24:49', '2025-01-17 02:24:49'),
(173, '1737100494.jpg', '2025-01-17 02:24:54', '2025-01-17 02:24:54'),
(174, '1737100590.jpg', '2025-01-17 02:26:30', '2025-01-17 02:26:30'),
(175, '1737100597.pdf', '2025-01-17 02:26:37', '2025-01-17 02:26:37'),
(176, '1737100664.pdf', '2025-01-17 02:27:44', '2025-01-17 02:27:44'),
(177, '1737100719.pdf', '2025-01-17 02:28:39', '2025-01-17 02:28:39'),
(178, '1737100724.jpg', '2025-01-17 02:28:44', '2025-01-17 02:28:44'),
(179, '1737100796.pdf', '2025-01-17 02:29:56', '2025-01-17 02:29:56'),
(180, '1737100938.pdf', '2025-01-17 02:32:18', '2025-01-17 02:32:18'),
(181, '1737101095.jpg', '2025-01-17 02:34:55', '2025-01-17 02:34:55'),
(182, '1737979225.jpg', '2025-01-27 06:30:25', '2025-01-27 06:30:25'),
(183, '1755168994.png', '2025-08-14 05:26:34', '2025-08-14 05:26:34'),
(184, '1755169007.png', '2025-08-14 05:26:47', '2025-08-14 05:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `role` enum('admin','user','builder') NOT NULL DEFAULT 'user',
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `mobile`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Dhruv Bhavsar', 'dhruvbhavsar210@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '3-1736572345.png', NULL, 'admin', 1, NULL, '2024-12-28 05:49:21', '2025-01-10 23:42:25'),
(4, 'Gaurav', 'gaurav@gmail.com', NULL, '$2y$12$1SpADjHEpzBJ2OTXEQkwd.GNrM1Hrn.vGo7NyPsqXiaYBGTZwj3.C', '4-1736168601.png', '9978812345', 'builder', 1, NULL, '2024-12-28 05:51:32', '2025-01-06 07:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'North', 1, '2024-12-31 08:57:55', '2024-12-31 08:57:55'),
(2, 'East', 1, NULL, NULL),
(3, 'West', 1, NULL, NULL),
(4, 'South', 1, NULL, NULL),
(5, 'North - East', 1, NULL, NULL),
(6, 'North - West', 1, NULL, NULL),
(7, 'South - East', 1, NULL, NULL),
(8, 'South - West', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ages`
--
ALTER TABLE `ages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_city_id_foreign` (`city_id`);

--
-- Indexes for table `bathrooms`
--
ALTER TABLE `bathrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `builders`
--
ALTER TABLE `builders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `developers_property_id_foreign` (`property_id`);

--
-- Indexes for table `buysell`
--
ALTER TABLE `buysell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `constructions`
--
ALTER TABLE `constructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_user_id_foreign` (`user_id`),
  ADD KEY `job_applications_employer_id_foreign` (`employer_id`),
  ADD KEY `job_applications_property_id_foreign` (`property_id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listed_types`
--
ALTER TABLE `listed_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_user_id_foreign` (`user_id`),
  ADD KEY `properties_category_id_foreign` (`category_id`),
  ADD KEY `properties_city_id_foreign` (`city_id`),
  ADD KEY `properties_area_id_foreign` (`area_id`),
  ADD KEY `properties_sale_type_id_foreign` (`sale_type_id`),
  ADD KEY `properties_property_type_id_foreign` (`property_type_id`),
  ADD KEY `properties_room_id_foreign` (`room_id`) USING BTREE,
  ADD KEY `properties_bathroom_id_foreign` (`bathroom_id`) USING BTREE,
  ADD KEY `properties_view_id_foreign` (`view_id`) USING BTREE,
  ADD KEY `properties_builder_id_foreign` (`builder_id`) USING BTREE,
  ADD KEY `properties_construction_id_foreign` (`construction_id`),
  ADD KEY `properties_age_id_foreign` (`age_id`),
  ADD KEY `properties_amenity_id_foreign` (`amenity_id`),
  ADD KEY `properties_listed_type_id_foreign` (`listed_type_id`);

--
-- Indexes for table `property_applications`
--
ALTER TABLE `property_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_applications_property_id_foreign` (`property_id`),
  ADD KEY `property_applications_user_id_foreign` (`user_id`),
  ADD KEY `property_applications_posted_id_foreign` (`posted_id`);

--
-- Indexes for table `property_documents`
--
ALTER TABLE `property_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_documents_property_id_foreign` (`property_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`property_id`) USING BTREE;

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_types`
--
ALTER TABLE `sale_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_properties`
--
ALTER TABLE `saved_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_properties_property_id_foreign` (`property_id`),
  ADD KEY `saved_properties_user_id_foreign` (`user_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ages`
--
ALTER TABLE `ages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bathrooms`
--
ALTER TABLE `bathrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `builders`
--
ALTER TABLE `builders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `buysell`
--
ALTER TABLE `buysell`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `constructions`
--
ALTER TABLE `constructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `listed_types`
--
ALTER TABLE `listed_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `property_applications`
--
ALTER TABLE `property_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_documents`
--
ALTER TABLE `property_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_types`
--
ALTER TABLE `sale_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saved_properties`
--
ALTER TABLE `saved_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `builders`
--
ALTER TABLE `builders`
  ADD CONSTRAINT `developers_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_age_id_foreign` FOREIGN KEY (`age_id`) REFERENCES `ages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_bath_id_foreign` FOREIGN KEY (`bathroom_id`) REFERENCES `bathrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_bhk_type_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_construction_id_foreign` FOREIGN KEY (`construction_id`) REFERENCES `constructions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_developer_id_foreign` FOREIGN KEY (`builder_id`) REFERENCES `builders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_facing_id_foreign` FOREIGN KEY (`view_id`) REFERENCES `views` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_listed_type_id_foreign` FOREIGN KEY (`listed_type_id`) REFERENCES `listed_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_property_type_id_foreign` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_sale_type_id_foreign` FOREIGN KEY (`sale_type_id`) REFERENCES `sale_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_applications`
--
ALTER TABLE `property_applications`
  ADD CONSTRAINT `property_applications_posted_id_foreign` FOREIGN KEY (`posted_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_applications_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_documents`
--
ALTER TABLE `property_documents`
  ADD CONSTRAINT `property_documents_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `saved_properties`
--
ALTER TABLE `saved_properties`
  ADD CONSTRAINT `saved_properties_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
