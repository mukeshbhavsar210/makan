-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 08:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.0

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Swimming Pool', 1, '2023-12-25 00:29:49', '2023-12-25 00:29:49'),
(2, 'Gym', 1, '2023-12-25 00:29:49', '2023-12-25 00:29:49'),
(3, 'Garden', 1, '2023-12-25 00:29:50', '2023-12-25 00:29:50'),
(4, 'Security', 1, '2023-12-25 00:29:50', '2023-12-25 00:29:50'),
(5, 'Studio', 1, '2023-12-25 00:29:50', '2023-12-25 00:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(4, 'Gota', 'gota', 1, 1, '2025-01-04 00:36:44', '2025-01-04 00:36:44'),
(6, 'Nikol', 'nikol', 1, 1, '2025-01-04 00:45:34', '2025-01-04 00:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `bathrooms`
--

CREATE TABLE `bathrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bathrooms`
--

INSERT INTO `bathrooms` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', 1, '2024-12-31 09:14:46', '2024-12-31 09:14:46'),
(2, '3', 1, '2024-12-31 09:14:57', '2024-12-31 09:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `builders`
--

CREATE TABLE `builders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_estd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `builders`
--

INSERT INTO `builders` (`id`, `name`, `email`, `landline`, `mobile`, `whatsapp`, `logo`, `photo`, `year_estd`, `address`, `property_id`, `status`, `created_at`, `updated_at`) VALUES
(29, 'Dhruv Bhavsar', 'dhruvbhavsar210@gmail.com', '12457899', '09978835005', NULL, '29.JPG', NULL, '1985', 'Keerthi Royal Palms, Keerthi Royal Palms, Keerthi Royal Palms, Keerthi Royal Palms,', 17, 1, '2025-01-04 02:02:08', '2025-01-04 02:02:08'),
(31, 'Dhruv Bhavsar', 'dhruvbhavsar210@gmail.com', '12457899', '09916235005', '99788251478', '31.JPG', NULL, '1995', 'Keerthi Royal Palms, Keerthi Royal Palms, Keerthi Royal Palms, Keerthi Royal Palms,', 17, 1, '2025-01-04 02:03:54', '2025-01-04 02:03:54'),
(32, 'Mukesh Bhavsar', 'mukeshbhavsar210@gmail.com', '11111', '09978835005', '99788251478', '32Mukesh Bhavsar.JPG', NULL, NULL, 'Keerthi Royal Palms,', 17, 1, '2025-01-04 02:05:00', '2025-01-04 02:05:00'),
(33, 'Mukesh Bhavsar', 'mukeshbhavsar210@gmail.com', '12457899', '09978835005', '99788251478', '33_Mukesh Bhavsar.JPG', NULL, '1985', 'Keerthi Royal Palms,', 17, 1, '2025-01-04 02:05:57', '2025-01-04 02:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `buysell`
--

CREATE TABLE `buysell` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(21, 'For Rent', '21.JPG', 1, '2025-01-01 05:48:27', '2025-01-01 05:48:27'),
(26, 'Mukesh Bhavsar', '26.jpg', 1, '2025-01-04 01:53:26', '2025-01-04 01:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ahmedabad', 'ahmedabad', 1, '2024-12-30 06:13:43', '2024-12-30 06:13:43'),
(2, 'Banglore', 'banglore', 1, '2024-12-30 06:13:43', '2024-12-30 06:13:43'),
(3, 'Hyderabad', 'hyderabad', 1, '2025-01-01 06:08:45', '2025-01-01 06:08:45'),
(4, 'Delhi', 'delhi', 1, '2025-01-01 06:09:37', '2025-01-01 06:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `construction_status`
--

CREATE TABLE `construction_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(41, '2025_01_02_121843_alter_properties_table', 33);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amenities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rera` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `year_build` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_area` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bathroom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `slug`, `user_id`, `category_id`, `room_id`, `city_id`, `area_id`, `builder_id`, `sale_type_id`, `property_type_id`, `view_id`, `price`, `compare_price`, `description`, `keywords`, `amenities`, `location`, `size`, `rera`, `year_build`, `total_area`, `related_properties`, `status`, `created_at`, `updated_at`, `bathroom_id`, `is_featured`) VALUES
(17, 'Keerthi Royal Palms', 'keerthi-royal-palms', 3, 21, 1, 2, 2, 33, 1, 1, 1, 9800000.00, NULL, 'asdfasfdfsd', '3 BHK Apartment', '3', 'Banglore', NULL, NULL, '1987', '124567', '15', 1, '2025-01-03 00:02:05', '2025-01-03 00:02:05', NULL, 'No');

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
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Villa', 'villa', 1, '2024-12-31 08:56:55', '2024-12-31 08:56:55'),
(2, 'Apartment', 'apartment', 1, '2024-12-31 09:20:05', '2024-12-31 09:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', 1, '2024-12-29 17:55:12', '2024-12-29 17:55:12'),
(2, '3', 1, '2024-12-29 17:55:31', '2024-12-29 17:55:31'),
(3, '4', 1, '2024-12-29 17:55:43', '2024-12-29 17:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `sale_types`
--

CREATE TABLE `sale_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sell',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_types`
--

INSERT INTO `sale_types` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sell', 'sell', 1, '2024-12-31 08:57:22', '2024-12-31 08:57:22'),
(2, 'Rent', 'rent', 1, '2024-12-31 09:09:33', '2024-12-31 09:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `saved_jobs`
--

CREATE TABLE `saved_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saved_jobs`
--

INSERT INTO `saved_jobs` (`id`, `property_id`, `user_id`, `created_at`, `updated_at`) VALUES
(17, 3, 4, '2024-12-28 05:51:55', '2024-12-28 05:51:55'),
(18, 1, 4, '2024-12-28 06:03:15', '2024-12-28 06:03:15'),
(19, 2, 4, '2024-12-30 05:14:38', '2024-12-30 05:14:38');

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

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(49, '1735976149.JPG', '2025-01-04 02:05:49', '2025-01-04 02:05:49');

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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `mobile`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Dhruv Bhavsar', 'dhruvbhavsar210@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', NULL, NULL, 'admin', 1, NULL, '2024-12-28 05:49:21', '2024-12-28 05:49:21'),
(4, 'Gaurav', 'gaurav@gmail.com', NULL, '$2y$12$1SpADjHEpzBJ2OTXEQkwd.GNrM1Hrn.vGo7NyPsqXiaYBGTZwj3.C', NULL, '9978812345', 'user', 1, NULL, '2024-12-28 05:51:32', '2024-12-28 06:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'North', 'north', 1, '2024-12-31 08:57:55', '2024-12-31 08:57:55');

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
-- Indexes for table `construction_status`
--
ALTER TABLE `construction_status`
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
  ADD KEY `properties_builder_id_foreign` (`builder_id`) USING BTREE;

--
-- Indexes for table `property_applications`
--
ALTER TABLE `property_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_applications_property_id_foreign` (`property_id`),
  ADD KEY `property_applications_user_id_foreign` (`user_id`),
  ADD KEY `property_applications_posted_id_foreign` (`posted_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_images_property_id_foreign` (`property_id`);

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
-- Indexes for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_jobs_user_id_foreign` (`user_id`),
  ADD KEY `saved_properties_job_id_foreign` (`property_id`) USING BTREE;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bathrooms`
--
ALTER TABLE `bathrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `builders`
--
ALTER TABLE `builders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `buysell`
--
ALTER TABLE `buysell`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `construction_status`
--
ALTER TABLE `construction_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `property_applications`
--
ALTER TABLE `property_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sale_types`
--
ALTER TABLE `sale_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `saved_properties`
--
ALTER TABLE `saved_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `properties_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_bath_id_foreign` FOREIGN KEY (`bathroom_id`) REFERENCES `bathrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_bhk_type_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_developer_id_foreign` FOREIGN KEY (`builder_id`) REFERENCES `builders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_facing_id_foreign` FOREIGN KEY (`view_id`) REFERENCES `views` (`id`) ON DELETE CASCADE,
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
