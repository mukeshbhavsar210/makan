-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2025 at 03:14 PM
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
(1, 'Chandkheda', 'chandkheda', 1, 1, '2024-12-30 06:14:19', '2025-08-21 01:44:44'),
(2, 'Electronic City', NULL, 2, 1, '2024-12-30 06:14:44', '2025-08-21 01:38:25'),
(11, 'Bopal', 'bopal', 1, 1, '2025-01-07 04:46:24', '2025-01-07 04:46:24'),
(12, 'HSR Layout', 'hsr-layout', 2, 1, '2025-01-07 04:46:34', '2025-01-07 04:46:34'),
(13, 'BTM Layout', 'btm-layout', 2, 1, '2025-01-07 04:46:49', '2025-01-07 04:46:49'),
(15, 'Bapunagar', 'bapunagar', 1, 1, '2025-01-08 07:01:48', '2025-01-08 07:01:48'),
(17, 'Bannergatta', 'bannergatta', 2, 1, '2025-01-27 06:28:39', '2025-01-27 06:28:39'),
(18, 'Nikol', 'nikol', 1, 1, '2025-08-21 00:45:49', '2025-08-21 00:45:49'),
(19, 'Gota', 'gota', 1, 1, '2025-08-21 00:46:32', '2025-08-21 00:46:32'),
(20, 'Vastral', 'vastral', 1, 1, '2025-08-21 00:58:08', '2025-08-21 00:58:08'),
(21, 'Devenhalli', 'devenhalli', 2, 1, '2025-08-22 02:39:14', '2025-08-22 02:39:14'),
(22, 'Naroda', 'naroda', 1, 1, '2025-08-22 02:42:28', '2025-08-22 02:42:28');

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
  `address` text DEFAULT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `builders`
--

INSERT INTO `builders` (`id`, `name`, `related_properties`, `email`, `landline`, `mobile`, `whatsapp`, `logo`, `address`, `property_id`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(34, 'Keerthi Estate', '46,44', 'info@keerthiestate.com', '079-15478598', '9978835115', '9987754875', '34_Keerthi Estate.JPG', 'Hyderabad', NULL, 1, '2025-01-04 03:58:23', '2025-01-04 03:58:23', 3),
(42, 'Dobariya & Company', '46,44', 'info@dobariya.com', '089-1234567', '9978812345', '9978812345', '41_Sanghani Infrastructure.png', 'Vejalpur', NULL, 1, '2025-01-10 23:28:06', '2025-08-14 05:23:53', 3),
(43, 'Swastik Group', '46,44', 'info@dobariya.com', '089-1234567', '9978812345', '9978812345', '41_Sanghani Infrastructure.png', 'Vejalpur', NULL, 1, '2025-01-10 23:28:06', '2025-08-14 05:23:53', 3);

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
(1, 'Ahmedabad', 'ahmedabad', 1, '2024-12-30 06:13:43', '2025-08-21 01:28:10'),
(2, 'Banglore', 'banglore', 1, '2024-12-30 06:13:43', '2025-08-21 01:28:52');

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
(49, '2025_08_15_115424_add_listed_type_id_to_properties_table', 41),
(50, '2025_08_18_101609_create_interested_properties_table', 42),
(51, '2025_08_19_061019_create_amenity_property_table', 43),
(52, '2025_08_25_131608_remove_old_foreignid_from_properties_table', 44),
(53, '2025_08_25_131753_remove_old_foreignid_from_properties_table', 45),
(54, '2025_08_25_131839_remove_old_foreignid_from_properties_table', 46),
(55, '2025_08_25_132126_remove_old_foreignid_from_properties_table', 47),
(56, '2025_08_25_132510_remove_old_foreignid_from_properties_table', 48),
(57, '2025_08_26_103835_remove_old_foreignid_from_properties_table', 49),
(58, '2025_08_28_070218_add_user_id_to_builders_table', 50),
(59, '2025_08_28_082917_add_builder_id_to_propeties_table', 51);

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
  `category` enum('buy','rent') DEFAULT 'buy',
  `property_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `sale_types` enum('new','resale') NOT NULL DEFAULT 'new',
  `construction_types` enum('under','ready') NOT NULL DEFAULT 'under',
  `rooms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`rooms`)),
  `bathrooms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bathrooms`)),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `builder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `property_age` enum('1_year','3_years','5_years','6_years') DEFAULT '1_year',
  `facings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `view_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `rera` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `year_build` text DEFAULT NULL,
  `total_area` varchar(50) DEFAULT NULL,
  `related_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `amenities` longtext NOT NULL,
  `possession_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `slug`, `category`, `property_types`, `sale_types`, `construction_types`, `rooms`, `bathrooms`, `user_id`, `builder_id`, `property_age`, `facings`, `city_id`, `area_id`, `view_id`, `description`, `keywords`, `location`, `size`, `rera`, `year_build`, `total_area`, `related_properties`, `amenities`, `possession_date`, `status`, `created_at`, `updated_at`, `is_featured`) VALUES
(44, 'Shlok Heights', 'shlok-heights', 'buy', '[\"apartment\",\"independent_house\",\"plot\"]', 'resale', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"7500000\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"9500000\"}]', '[\"2_baths\",\"3_baths\",\"4_baths\"]', 1, 43, '6_years', '[\"north\",\"south\"]', 1, 1, NULL, 'Shlok Heights', '3 BHK Apartment', 'Mansarovar Road', '13', '13', NULL, '13', '[\"50\",\"51\",\"52\",\"53\",\"55\"]', '[]', '2027-08-31', 1, '2025-01-06 05:12:07', '2025-08-28 00:25:53', 'Yes'),
(50, 'Global Techie Town', 'global-techie-town', 'buy', '[]', 'new', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"7500000\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"9500000\"}]', '[]', 3, 34, '1_year', '[]', 2, 2, NULL, 'Details', '3 BHK Apartment', 'Electronic City', '1800', '123', '0000-00-00', '20000', '[]', '[]', '2027-08-31', 1, '2025-01-10 23:30:34', '2025-08-27 07:25:27', 'No'),
(51, 'Samarthya Status', 'samarthya_status', 'rent', NULL, 'new', 'under', NULL, NULL, 2, NULL, '1_year', NULL, 1, 1, NULL, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', '1000', NULL, NULL, NULL, '', '', NULL, 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 'Yes'),
(53, 'Swastik Marvella', 'swastik_marvella', 'buy', '[\"apartment\",\"studio\"]', 'resale', 'ready', '[\r\n    {\"id\": 4, \"title\": \"3_bhk\", \"price\": \"9500000\"},\r\n    {\"id\": 5, \"title\": \"4_bhk\", \"price\": \"10000000\"}\r\n]', '[\"3_baths\",\"4_baths\"]', 4, 42, '5_years', '[\"west\",\"east\"]', 1, 1, 1, 'Swastik Marvella', '3 BHK Apartment', 'IOC Road', '1000', NULL, NULL, NULL, '', '[\"gym\",\"security\"]', NULL, 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 'Yes'),
(55, 'Sattva', 'sattva', 'buy', NULL, 'new', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"7500000\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"9500000\"}]', NULL, 3, 42, '1_year', NULL, 2, 12, NULL, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', '1000', NULL, NULL, NULL, '', '', NULL, 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 'Yes'),
(57, 'Navami Funique', 'navami_funique', 'buy', NULL, 'new', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"7500000\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"9500000\"}]', NULL, 3, 43, '1_year', NULL, 2, 2, NULL, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', '1000', NULL, NULL, NULL, '', '', NULL, 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 'Yes'),
(58, 'Swastik Harmony', 'swastik_harmony', 'buy', NULL, 'new', '', NULL, NULL, 4, NULL, '1_year', NULL, 1, 11, 2, 'Swastik Harmony', '3 BHK Apartment', 'IOC Road', '1000', NULL, NULL, NULL, '', '', NULL, 1, '2025-01-06 05:12:07', '2025-01-08 06:19:22', 'Yes'),
(61, 'Dharti Exotica', 'dharti-exotica', 'buy', '[\"apartment\"]', 'new', 'ready', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"4520000\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"6500000\"}]', '[]', 1, 34, '1_year', '[\"east\"]', 1, 1, NULL, 'hello', '3 BHK Apartment', 'Mansarovar Road', '1800', NULL, NULL, '20000', '[\"44\"]', '[\"1\",\"2\"]', NULL, 1, '2025-08-28 00:42:09', '2025-08-28 00:42:09', 'Yes');

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

--
-- Dumping data for table `property_applications`
--

INSERT INTO `property_applications` (`id`, `property_id`, `user_id`, `posted_id`, `applied_date`, `created_at`, `updated_at`) VALUES
(8, 44, 4, 4, '2025-08-18 11:23:46', '2025-08-18 05:17:25', '2025-08-18 05:17:25'),
(10, 55, 1, 3, '2025-08-18 07:25:29', '2025-08-18 07:25:29', '2025-08-18 07:25:29'),
(13, 44, 3, 4, '2025-08-18 08:16:54', '2025-08-18 08:16:54', '2025-08-18 08:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `label` enum('Main','Video','Elevation','Bedroom','Living','Balcony','Amenities','Floor','Location','Cluster') NOT NULL DEFAULT 'Main',
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `property_id`, `image`, `label`, `sort_order`, `created_at`, `updated_at`) VALUES
(53, 44, '44-ShlokHeights-Main.avif', 'Main', NULL, '2025-01-08 06:27:18', '2025-01-08 06:27:18'),
(64, 44, '44-ShlokHeights-Bedroom.avif', 'Bedroom', NULL, '2025-01-08 06:27:25', '2025-01-08 06:27:25'),
(71, 44, '44-ShlokHeights-Living.avif', 'Living', NULL, '2025-01-08 06:43:44', '2025-01-08 06:43:44'),
(72, 44, '44-Shlok Heights-1736338426.jpg', 'Amenities', NULL, '2025-01-08 06:43:46', '2025-01-08 06:43:46'),
(80, 50, '50-Shayamal Row House-1736571634.jpg', 'Elevation', NULL, '2025-01-10 23:30:34', '2025-01-10 23:30:34'),
(81, 50, '50-Shayamal Row House-1736571635.jpg', 'Elevation', NULL, '2025-01-10 23:30:35', '2025-01-10 23:30:35'),
(82, 50, '50-Shayamal Row House-1736571636.jpg', 'Elevation', NULL, '2025-01-10 23:30:35', '2025-01-10 23:30:36'),
(83, 50, '50-Shayamal Row House-1736571636.jpg', 'Elevation', NULL, '2025-01-10 23:30:36', '2025-01-10 23:30:36'),
(84, 50, '50-Shayamal Row House-1736574384.JPG', 'Elevation', NULL, '2025-01-11 00:16:24', '2025-01-11 00:16:24'),
(85, 50, '50-Shayamal Row House-1736574385.JPG', 'Elevation', NULL, '2025-01-11 00:16:25', '2025-01-11 00:16:25'),
(86, 50, '50-Shayamal Row House-1736574387.JPG', 'Elevation', NULL, '2025-01-11 00:16:27', '2025-01-11 00:16:27'),
(87, 50, '50-Shayamal Row House-1736574389.JPG', 'Elevation', NULL, '2025-01-11 00:16:29', '2025-01-11 00:16:29'),
(88, 50, '50-Shayamal Row House-1736574459.JPG', 'Elevation', NULL, '2025-01-11 00:17:39', '2025-01-11 00:17:39'),
(89, 50, '50-Shayamal Row House-1736574460.JPG', 'Elevation', NULL, '2025-01-11 00:17:40', '2025-01-11 00:17:40'),
(90, 50, '50-Shayamal Row House-1736574462.JPG', 'Elevation', NULL, '2025-01-11 00:17:42', '2025-01-11 00:17:42'),
(91, 50, '50-Shayamal Row House-1736574464.JPG', 'Elevation', NULL, '2025-01-11 00:17:44', '2025-01-11 00:17:44'),
(92, 50, '50-Shayamal Row House-1736574465.JPG', 'Elevation', NULL, '2025-01-11 00:17:45', '2025-01-11 00:17:45'),
(93, 50, '50-Shayamal Row House-1736574466.JPG', 'Elevation', NULL, '2025-01-11 00:17:46', '2025-01-11 00:17:46'),
(94, 50, '50-Shayamal Row House-1736574468.JPG', 'Elevation', NULL, '2025-01-11 00:17:48', '2025-01-11 00:17:48'),
(95, 50, '50-Shayamal Row House-1736574469.JPG', 'Elevation', NULL, '2025-01-11 00:17:49', '2025-01-11 00:17:49'),
(96, 50, '50-Shayamal Row House-1737091154.JPG', 'Elevation', NULL, '2025-01-16 23:49:14', '2025-01-16 23:49:14'),
(97, 50, '50-Shayamal Row House-1737091155.JPG', 'Elevation', NULL, '2025-01-16 23:49:15', '2025-01-16 23:49:15'),
(98, 50, '50-Shayamal Row House-1737091157.JPG', 'Elevation', NULL, '2025-01-16 23:49:17', '2025-01-16 23:49:17'),
(99, 50, '50-Shayamal Row House-1737091158.JPG', 'Elevation', NULL, '2025-01-16 23:49:18', '2025-01-16 23:49:18'),
(100, 50, '50-Shayamal Row House-1737091160.JPG', 'Elevation', NULL, '2025-01-16 23:49:20', '2025-01-16 23:49:20'),
(101, 50, '50-Shayamal Row House-1737091161.JPG', 'Elevation', NULL, '2025-01-16 23:49:21', '2025-01-16 23:49:21'),
(102, 50, '50-Shayamal Row House-1737091163.JPG', 'Elevation', NULL, '2025-01-16 23:49:23', '2025-01-16 23:49:23'),
(103, 50, '50-Shayamal Row House-1737091164.JPG', 'Elevation', NULL, '2025-01-16 23:49:24', '2025-01-16 23:49:24'),
(104, 50, '50-Shayamal Row House-1737091167.JPG', 'Elevation', NULL, '2025-01-16 23:49:27', '2025-01-16 23:49:27'),
(105, 50, '50-Shayamal Row House-1737091168.JPG', 'Elevation', NULL, '2025-01-16 23:49:28', '2025-01-16 23:49:28'),
(106, 50, '50-Shayamal Row House-1737091169.JPG', 'Elevation', NULL, '2025-01-16 23:49:29', '2025-01-16 23:49:29'),
(107, 50, '50-Shayamal Row House-1737091171.JPG', 'Elevation', NULL, '2025-01-16 23:49:31', '2025-01-16 23:49:31'),
(108, 50, '50-Shayamal Row House-1737091173.JPG', 'Elevation', NULL, '2025-01-16 23:49:33', '2025-01-16 23:49:33'),
(109, 50, '50-Shayamal Row House-1737091174.JPG', 'Elevation', NULL, '2025-01-16 23:49:34', '2025-01-16 23:49:34'),
(110, 50, '50-Shayamal Row House-1737091175.JPG', 'Elevation', NULL, '2025-01-16 23:49:35', '2025-01-16 23:49:35'),
(111, 50, '50-Shayamal Row House-1737091176.JPG', 'Elevation', NULL, '2025-01-16 23:49:36', '2025-01-16 23:49:36'),
(112, 44, '44-Shlok Heights-1736337438.JPG', 'Video', NULL, '2025-01-08 06:27:18', '2025-01-08 06:27:18'),
(113, 44, '44-ShlokHeights-Elevation.avif', 'Elevation', NULL, '2025-01-08 06:43:44', '2025-01-08 06:43:44'),
(115, 44, '44-Shlok Heights-1736337438.JPG', 'Floor', NULL, '2025-01-08 06:27:18', '2025-01-08 06:27:18'),
(116, 44, '44-ShlokHeights-Location.avif', 'Location', NULL, '2025-01-08 06:43:44', '2025-01-08 06:43:44'),
(117, 44, '44-ShlokHeights-Cluster.avif', 'Cluster', NULL, '2025-01-08 06:27:18', '2025-01-08 06:27:18'),
(118, 44, '44-Shlok Heights-1755950903.JPG', 'Main', NULL, '2025-08-23 06:38:23', '2025-08-23 06:38:23'),
(119, 44, '44-Shlok Heights-1755950908.jpg', 'Main', NULL, '2025-08-23 06:38:28', '2025-08-23 06:38:28'),
(120, 44, '44-Shlok Heights-1755950909.jpg', 'Main', NULL, '2025-08-23 06:38:29', '2025-08-23 06:38:29'),
(121, 44, '44-Shlok Heights-1755950909.jpg', 'Main', NULL, '2025-08-23 06:38:29', '2025-08-23 06:38:29'),
(122, 44, '44-Shlok Heights-1755950910.JPG', 'Main', NULL, '2025-08-23 06:38:30', '2025-08-23 06:38:30'),
(125, 44, '44-Shlok Heights-1755950913.JPG', 'Main', NULL, '2025-08-23 06:38:33', '2025-08-23 06:38:33'),
(126, 44, '44-Shlok Heights-1755950913.JPG', 'Main', NULL, '2025-08-23 06:38:33', '2025-08-23 06:38:33'),
(127, 44, '44-Shlok Heights-1755950914.JPG', 'Main', NULL, '2025-08-23 06:38:34', '2025-08-23 06:38:34'),
(128, 44, '44-Shlok Heights-1755950928.JPG', 'Main', NULL, '2025-08-23 06:38:48', '2025-08-23 06:38:48'),
(129, 44, '44-Shlok Heights-1755950930.jpg', 'Main', NULL, '2025-08-23 06:38:50', '2025-08-23 06:38:50'),
(130, 44, '44-Shlok Heights-1755950931.jpg', 'Main', NULL, '2025-08-23 06:38:50', '2025-08-23 06:38:51'),
(131, 44, '44-Shlok Heights-1755950931.jpg', 'Main', NULL, '2025-08-23 06:38:51', '2025-08-23 06:38:51'),
(132, 44, '44-Shlok Heights-1755950932.JPG', 'Main', NULL, '2025-08-23 06:38:52', '2025-08-23 06:38:52'),
(133, 44, '44-Shlok Heights-1755950933.JPG', 'Main', NULL, '2025-08-23 06:38:53', '2025-08-23 06:38:53'),
(134, 44, '44-Shlok Heights-1755950934.JPG', 'Main', NULL, '2025-08-23 06:38:54', '2025-08-23 06:38:54'),
(135, 44, '44-Shlok Heights-1755950934.JPG', 'Main', NULL, '2025-08-23 06:38:54', '2025-08-23 06:38:54'),
(136, 44, '44-Shlok Heights-1755950935.JPG', 'Main', NULL, '2025-08-23 06:38:55', '2025-08-23 06:38:55'),
(137, 44, '44-Shlok Heights-1755950936.JPG', 'Main', NULL, '2025-08-23 06:38:56', '2025-08-23 06:38:56'),
(138, 44, '44-Shlok Heights-1755950936.JPG', 'Main', NULL, '2025-08-23 06:38:56', '2025-08-23 06:38:56'),
(139, 44, '44-Shlok Heights-1755950937.JPG', 'Main', NULL, '2025-08-23 06:38:57', '2025-08-23 06:38:57'),
(140, 44, '44-Shlok Heights-1755950937.JPG', 'Main', NULL, '2025-08-23 06:38:57', '2025-08-23 06:38:57'),
(141, 44, '44-Shlok Heights-1755950938.jpg', 'Main', NULL, '2025-08-23 06:38:58', '2025-08-23 06:38:58'),
(142, 44, '44-Shlok Heights-1755950938.jpg', 'Main', NULL, '2025-08-23 06:38:58', '2025-08-23 06:38:58'),
(143, 44, '44-Shlok Heights-1755950939.jpg', 'Main', NULL, '2025-08-23 06:38:59', '2025-08-23 06:38:59'),
(144, 44, '44-Shlok Heights-1755950939.jpg', 'Main', NULL, '2025-08-23 06:38:59', '2025-08-23 06:38:59'),
(145, 44, '44-Shlok Heights-1755950940.jpg', 'Main', NULL, '2025-08-23 06:39:00', '2025-08-23 06:39:00'),
(146, 44, '44-Shlok Heights-1755950940.jpg', 'Main', NULL, '2025-08-23 06:39:00', '2025-08-23 06:39:00'),
(147, 44, '44-Shlok Heights-1755950941.jpg', 'Main', NULL, '2025-08-23 06:39:00', '2025-08-23 06:39:01'),
(148, 44, '44-Shlok Heights-1755950958.JPG', 'Main', NULL, '2025-08-23 06:39:17', '2025-08-23 06:39:18'),
(149, 44, '44-Shlok Heights-1755950960.jpg', 'Main', NULL, '2025-08-23 06:39:19', '2025-08-23 06:39:20'),
(150, 44, '44-Shlok Heights-1755950960.jpg', 'Main', NULL, '2025-08-23 06:39:20', '2025-08-23 06:39:20'),
(151, 44, '44-Shlok Heights-1755950961.jpg', 'Main', NULL, '2025-08-23 06:39:21', '2025-08-23 06:39:21'),
(152, 44, '44-Shlok Heights-1755950961.JPG', 'Main', NULL, '2025-08-23 06:39:21', '2025-08-23 06:39:21'),
(153, 44, '44-Shlok Heights-1755950963.JPG', 'Main', NULL, '2025-08-23 06:39:23', '2025-08-23 06:39:23'),
(154, 44, '44-Shlok Heights-1755950964.JPG', 'Main', NULL, '2025-08-23 06:39:24', '2025-08-23 06:39:24'),
(155, 44, '44-Shlok Heights-1755950964.JPG', 'Main', NULL, '2025-08-23 06:39:24', '2025-08-23 06:39:24'),
(156, 44, '44-Shlok Heights-1755950965.JPG', 'Main', NULL, '2025-08-23 06:39:25', '2025-08-23 06:39:25'),
(157, 44, '44-Shlok Heights-1755950965.JPG', 'Main', NULL, '2025-08-23 06:39:25', '2025-08-23 06:39:25'),
(158, 44, '44-Shlok Heights-1755950966.JPG', 'Main', NULL, '2025-08-23 06:39:26', '2025-08-23 06:39:26'),
(159, 44, '44-Shlok Heights-1755950966.JPG', 'Main', NULL, '2025-08-23 06:39:26', '2025-08-23 06:39:26'),
(160, 44, '44-Shlok Heights-1755950967.JPG', 'Main', NULL, '2025-08-23 06:39:27', '2025-08-23 06:39:27'),
(161, 44, '44-Shlok Heights-1755950967.jpg', 'Main', NULL, '2025-08-23 06:39:27', '2025-08-23 06:39:27'),
(162, 44, '44-Shlok Heights-1755950968.jpg', 'Main', NULL, '2025-08-23 06:39:28', '2025-08-23 06:39:28'),
(163, 44, '44-Shlok Heights-1755950969.jpg', 'Main', NULL, '2025-08-23 06:39:29', '2025-08-23 06:39:29'),
(164, 44, '44-Shlok Heights-1755950969.jpg', 'Main', NULL, '2025-08-23 06:39:29', '2025-08-23 06:39:29'),
(165, 44, '44-Shlok Heights-1755950970.jpg', 'Main', NULL, '2025-08-23 06:39:30', '2025-08-23 06:39:30'),
(166, 44, '44-Shlok Heights-1755950970.jpg', 'Main', NULL, '2025-08-23 06:39:30', '2025-08-23 06:39:30'),
(167, 44, '44-Shlok Heights-1755950970.jpg', 'Main', NULL, '2025-08-23 06:39:30', '2025-08-23 06:39:30'),
(168, 44, '44-Shlok Heights-1755950971.jpg', 'Main', NULL, '2025-08-23 06:39:31', '2025-08-23 06:39:31'),
(169, 44, '44-Shlok Heights-1755950971.jpg', 'Main', NULL, '2025-08-23 06:39:31', '2025-08-23 06:39:31'),
(170, 44, '44-Shlok Heights-1755950971.JPG', 'Main', NULL, '2025-08-23 06:39:31', '2025-08-23 06:39:31'),
(171, 44, '44-Shlok Heights-1755950972.JPG', 'Main', NULL, '2025-08-23 06:39:32', '2025-08-23 06:39:32'),
(172, 44, '44-Shlok Heights-1755950973.JPG', 'Main', NULL, '2025-08-23 06:39:33', '2025-08-23 06:39:33'),
(173, 44, '44-Shlok Heights-1755950973.JPG', 'Main', NULL, '2025-08-23 06:39:33', '2025-08-23 06:39:33'),
(174, 44, '44-Shlok Heights-1755950974.JPG', 'Main', NULL, '2025-08-23 06:39:34', '2025-08-23 06:39:34'),
(175, 44, '44-Shlok Heights-1755950975.JPG', 'Main', NULL, '2025-08-23 06:39:35', '2025-08-23 06:39:35'),
(176, 44, '44-Shlok Heights-1755950975.JPG', 'Main', NULL, '2025-08-23 06:39:35', '2025-08-23 06:39:35'),
(177, 44, '44-Shlok Heights-1755950976.JPG', 'Main', NULL, '2025-08-23 06:39:36', '2025-08-23 06:39:36'),
(178, 44, '44-Shlok Heights-1755950977.JPG', 'Main', NULL, '2025-08-23 06:39:37', '2025-08-23 06:39:37'),
(179, 44, '44-Shlok Heights-1755950978.JPG', 'Main', NULL, '2025-08-23 06:39:38', '2025-08-23 06:39:38'),
(180, 44, '44-Shlok Heights-1755950980.JPG', 'Main', NULL, '2025-08-23 06:39:40', '2025-08-23 06:39:40'),
(181, 44, '44-Shlok Heights-1755950982.JPG', 'Main', NULL, '2025-08-23 06:39:42', '2025-08-23 06:39:42'),
(182, 44, '44-Shlok Heights-1755950983.JPG', 'Main', NULL, '2025-08-23 06:39:43', '2025-08-23 06:39:43'),
(183, 44, '44-Shlok Heights-1755950985.png', 'Main', NULL, '2025-08-23 06:39:45', '2025-08-23 06:39:45'),
(184, 44, '44-Shlok Heights-1755950986.jpg', 'Main', NULL, '2025-08-23 06:39:46', '2025-08-23 06:39:46'),
(185, 44, '44-Shlok Heights-1755950986.jpg', 'Main', NULL, '2025-08-23 06:39:46', '2025-08-23 06:39:46'),
(186, 44, '44-Shlok Heights-1755950986.jpg', 'Main', NULL, '2025-08-23 06:39:46', '2025-08-23 06:39:46'),
(187, 44, '44-Shlok Heights-1755950987.jpg', 'Main', NULL, '2025-08-23 06:39:47', '2025-08-23 06:39:47'),
(188, 44, '44-Shlok Heights-1755951043.JPG', 'Main', NULL, '2025-08-23 06:40:43', '2025-08-23 06:40:43'),
(189, 44, '44-Shlok Heights-1755951045.jpg', 'Main', NULL, '2025-08-23 06:40:45', '2025-08-23 06:40:45'),
(190, 44, '44-Shlok Heights-1755951046.jpg', 'Main', NULL, '2025-08-23 06:40:46', '2025-08-23 06:40:46'),
(191, 44, '44-Shlok Heights-1755951047.jpg', 'Main', NULL, '2025-08-23 06:40:47', '2025-08-23 06:40:47'),
(192, 44, '44-Shlok Heights-1755951047.JPG', 'Main', NULL, '2025-08-23 06:40:47', '2025-08-23 06:40:47'),
(193, 44, '44-Shlok Heights-1755951049.JPG', 'Main', NULL, '2025-08-23 06:40:49', '2025-08-23 06:40:49'),
(194, 44, '44-Shlok Heights-1755951050.JPG', 'Main', NULL, '2025-08-23 06:40:49', '2025-08-23 06:40:50'),
(195, 44, '44-Shlok Heights-1755951050.JPG', 'Main', NULL, '2025-08-23 06:40:50', '2025-08-23 06:40:50'),
(196, 44, '44-Shlok Heights-1755951051.JPG', 'Main', NULL, '2025-08-23 06:40:51', '2025-08-23 06:40:51'),
(197, 44, '44-Shlok Heights-1755951051.JPG', 'Main', NULL, '2025-08-23 06:40:51', '2025-08-23 06:40:51'),
(198, 44, '44-Shlok Heights-1755951052.JPG', 'Main', NULL, '2025-08-23 06:40:52', '2025-08-23 06:40:52'),
(199, 44, '44-Shlok Heights-1755951052.JPG', 'Main', NULL, '2025-08-23 06:40:52', '2025-08-23 06:40:52'),
(200, 44, '44-Shlok Heights-1755951053.JPG', 'Main', NULL, '2025-08-23 06:40:53', '2025-08-23 06:40:53'),
(201, 44, '44-Shlok Heights-1755951053.jpg', 'Main', NULL, '2025-08-23 06:40:53', '2025-08-23 06:40:53'),
(202, 44, '44-Shlok Heights-1755951054.jpg', 'Main', NULL, '2025-08-23 06:40:54', '2025-08-23 06:40:54'),
(203, 44, '44-Shlok Heights-1755951054.jpg', 'Main', NULL, '2025-08-23 06:40:54', '2025-08-23 06:40:54'),
(204, 44, '44-Shlok Heights-1755951055.jpg', 'Main', NULL, '2025-08-23 06:40:55', '2025-08-23 06:40:55'),
(205, 44, '44-Shlok Heights-1755951055.jpg', 'Main', NULL, '2025-08-23 06:40:55', '2025-08-23 06:40:55'),
(206, 44, '44-Shlok Heights-1755951055.jpg', 'Main', NULL, '2025-08-23 06:40:55', '2025-08-23 06:40:55'),
(207, 44, '44-Shlok Heights-1755951056.jpg', 'Main', NULL, '2025-08-23 06:40:56', '2025-08-23 06:40:56'),
(208, 44, '44-Shlok Heights-1755951056.JPG', 'Main', NULL, '2025-08-23 06:40:56', '2025-08-23 06:40:56'),
(209, 44, '44-Shlok Heights-1755951057.JPG', 'Main', NULL, '2025-08-23 06:40:56', '2025-08-23 06:40:57'),
(210, 44, '44-Shlok Heights-1755951057.JPG', 'Main', NULL, '2025-08-23 06:40:57', '2025-08-23 06:40:57'),
(211, 44, '44-Shlok Heights-1755951058.JPG', 'Main', NULL, '2025-08-23 06:40:58', '2025-08-23 06:40:58'),
(212, 44, '44-Shlok Heights-1755951059.JPG', 'Main', NULL, '2025-08-23 06:40:59', '2025-08-23 06:40:59'),
(213, 44, '44-Shlok Heights-1755951059.JPG', 'Main', NULL, '2025-08-23 06:40:59', '2025-08-23 06:40:59'),
(214, 44, '44-Shlok Heights-1755951060.JPG', 'Main', NULL, '2025-08-23 06:41:00', '2025-08-23 06:41:00'),
(215, 44, '44-Shlok Heights-1755951061.JPG', 'Main', NULL, '2025-08-23 06:41:00', '2025-08-23 06:41:01'),
(216, 44, '44-Shlok Heights-1755951061.JPG', 'Main', NULL, '2025-08-23 06:41:01', '2025-08-23 06:41:01'),
(217, 44, '44-Shlok Heights-1755951062.JPG', 'Main', NULL, '2025-08-23 06:41:02', '2025-08-23 06:41:02'),
(218, 44, '44-Shlok Heights-1755951064.JPG', 'Main', NULL, '2025-08-23 06:41:04', '2025-08-23 06:41:04'),
(219, 44, '44-Shlok Heights-1755951065.JPG', 'Main', NULL, '2025-08-23 06:41:05', '2025-08-23 06:41:05'),
(220, 44, '44-Shlok Heights-1755951067.JPG', 'Main', NULL, '2025-08-23 06:41:07', '2025-08-23 06:41:07'),
(221, 44, '44-Shlok Heights-1755951068.png', 'Main', NULL, '2025-08-23 06:41:08', '2025-08-23 06:41:08'),
(222, 44, '44-Shlok Heights-1755951069.jpg', 'Main', NULL, '2025-08-23 06:41:09', '2025-08-23 06:41:09'),
(223, 44, '44-Shlok Heights-1755951069.jpg', 'Main', NULL, '2025-08-23 06:41:09', '2025-08-23 06:41:09'),
(224, 44, '44-Shlok Heights-1755951070.jpg', 'Main', NULL, '2025-08-23 06:41:09', '2025-08-23 06:41:10'),
(225, 44, '44-Shlok Heights-1755951070.jpg', 'Main', NULL, '2025-08-23 06:41:10', '2025-08-23 06:41:10'),
(226, 44, '44-Shlok Heights-1755951070.png', 'Main', NULL, '2025-08-23 06:41:10', '2025-08-23 06:41:10'),
(227, 44, '44-Shlok Heights-1755951071.png', 'Main', NULL, '2025-08-23 06:41:11', '2025-08-23 06:41:11'),
(228, 44, '44-Shlok Heights-1755951071.png', 'Main', NULL, '2025-08-23 06:41:11', '2025-08-23 06:41:11'),
(229, 44, '44-Shlok Heights-1755951072.jpg', 'Main', NULL, '2025-08-23 06:41:12', '2025-08-23 06:41:12'),
(230, 44, '44-Shlok Heights-1755951072.jpg', 'Main', NULL, '2025-08-23 06:41:12', '2025-08-23 06:41:12'),
(231, 44, '44-Shlok Heights-1755951073.jpg', 'Main', NULL, '2025-08-23 06:41:13', '2025-08-23 06:41:13'),
(232, 44, '44-Shlok Heights-1755951074.jpg', 'Main', NULL, '2025-08-23 06:41:13', '2025-08-23 06:41:14'),
(233, 44, '44-Shlok Heights-1755951074.jpg', 'Main', NULL, '2025-08-23 06:41:14', '2025-08-23 06:41:14'),
(234, 44, '44-Shlok Heights-1755951074.jpg', 'Main', NULL, '2025-08-23 06:41:14', '2025-08-23 06:41:14'),
(235, 44, '44-Shlok Heights-1755951075.jpg', 'Main', NULL, '2025-08-23 06:41:15', '2025-08-23 06:41:15'),
(236, 44, '44-Shlok Heights-1755951075.jpg', 'Main', NULL, '2025-08-23 06:41:15', '2025-08-23 06:41:15'),
(237, 44, '44-Shlok Heights-1755951075.jpg', 'Main', NULL, '2025-08-23 06:41:15', '2025-08-23 06:41:15'),
(238, 44, '44-Shlok Heights-1755951076.jpg', 'Main', NULL, '2025-08-23 06:41:16', '2025-08-23 06:41:16'),
(239, 44, '44-Shlok Heights-1755951076.jpg', 'Main', NULL, '2025-08-23 06:41:16', '2025-08-23 06:41:16'),
(240, 44, '44-Shlok Heights-1755951076.jpg', 'Main', NULL, '2025-08-23 06:41:16', '2025-08-23 06:41:16'),
(241, 44, '44-Shlok Heights-1755951077.png', 'Main', NULL, '2025-08-23 06:41:17', '2025-08-23 06:41:17'),
(242, 44, '44-Shlok Heights-1755951077.jpg', 'Main', NULL, '2025-08-23 06:41:17', '2025-08-23 06:41:17'),
(243, 44, '44-Shlok Heights-1755951077.jpg', 'Main', NULL, '2025-08-23 06:41:17', '2025-08-23 06:41:17'),
(244, 44, '44-Shlok Heights-1755951078.png', 'Main', NULL, '2025-08-23 06:41:18', '2025-08-23 06:41:18'),
(245, 44, '44-Shlok Heights-1755951078.png', 'Main', NULL, '2025-08-23 06:41:18', '2025-08-23 06:41:18'),
(246, 44, '44-Shlok Heights-1755951079.jpg', 'Main', NULL, '2025-08-23 06:41:19', '2025-08-23 06:41:19'),
(247, 44, '44-Shlok Heights-1755951079.jpg', 'Main', NULL, '2025-08-23 06:41:19', '2025-08-23 06:41:19'),
(248, 44, '44-Shlok Heights-1755951080.pdf', 'Main', NULL, '2025-08-23 06:41:20', '2025-08-23 06:41:20'),
(249, 44, '44-Shlok Heights-1755951179.JPG', 'Main', NULL, '2025-08-23 06:42:59', '2025-08-23 06:42:59'),
(250, 44, '44-Shlok Heights-1755951182.jpg', 'Main', NULL, '2025-08-23 06:43:01', '2025-08-23 06:43:02'),
(251, 44, '44-Shlok Heights-1755951182.jpg', 'Main', NULL, '2025-08-23 06:43:02', '2025-08-23 06:43:02'),
(252, 44, '44-Shlok Heights-1755951183.jpg', 'Main', NULL, '2025-08-23 06:43:03', '2025-08-23 06:43:03'),
(253, 44, '44-Shlok Heights-1755951183.JPG', 'Main', NULL, '2025-08-23 06:43:03', '2025-08-23 06:43:03'),
(254, 44, '44-Shlok Heights-1755951185.JPG', 'Main', NULL, '2025-08-23 06:43:05', '2025-08-23 06:43:05'),
(255, 44, '44-Shlok Heights-1755951185.JPG', 'Main', NULL, '2025-08-23 06:43:05', '2025-08-23 06:43:05'),
(256, 44, '44-Shlok Heights-1755951186.JPG', 'Main', NULL, '2025-08-23 06:43:06', '2025-08-23 06:43:06'),
(257, 44, '44-Shlok Heights-1755951187.JPG', 'Main', NULL, '2025-08-23 06:43:07', '2025-08-23 06:43:07'),
(258, 44, '44-Shlok Heights-1755951187.JPG', 'Main', NULL, '2025-08-23 06:43:07', '2025-08-23 06:43:07'),
(259, 44, '44-Shlok Heights-1755951188.JPG', 'Main', NULL, '2025-08-23 06:43:08', '2025-08-23 06:43:08'),
(260, 44, '44-Shlok Heights-1755951189.JPG', 'Main', NULL, '2025-08-23 06:43:08', '2025-08-23 06:43:09'),
(261, 44, '44-Shlok Heights-1755951189.JPG', 'Main', NULL, '2025-08-23 06:43:09', '2025-08-23 06:43:09'),
(262, 44, '44-Shlok Heights-1755951190.jpg', 'Main', NULL, '2025-08-23 06:43:10', '2025-08-23 06:43:10'),
(263, 44, '44-Shlok Heights-1755951190.jpg', 'Main', NULL, '2025-08-23 06:43:10', '2025-08-23 06:43:10'),
(264, 44, '44-Shlok Heights-1755951191.jpg', 'Main', NULL, '2025-08-23 06:43:11', '2025-08-23 06:43:11'),
(265, 44, '44-Shlok Heights-1755951191.jpg', 'Main', NULL, '2025-08-23 06:43:11', '2025-08-23 06:43:11'),
(266, 44, '44-Shlok Heights-1755951191.jpg', 'Main', NULL, '2025-08-23 06:43:11', '2025-08-23 06:43:11'),
(267, 44, '44-Shlok Heights-1755951192.jpg', 'Main', NULL, '2025-08-23 06:43:12', '2025-08-23 06:43:12'),
(268, 44, '44-Shlok Heights-1755951192.jpg', 'Main', NULL, '2025-08-23 06:43:12', '2025-08-23 06:43:12'),
(269, 44, '44-Shlok Heights-1755951192.JPG', 'Main', NULL, '2025-08-23 06:43:12', '2025-08-23 06:43:12'),
(270, 44, '44-Shlok Heights-1755951193.JPG', 'Main', NULL, '2025-08-23 06:43:13', '2025-08-23 06:43:13'),
(271, 44, '44-Shlok Heights-1755951194.JPG', 'Main', NULL, '2025-08-23 06:43:14', '2025-08-23 06:43:14'),
(272, 44, '44-Shlok Heights-1755951194.JPG', 'Main', NULL, '2025-08-23 06:43:14', '2025-08-23 06:43:14'),
(273, 44, '44-Shlok Heights-1755951195.JPG', 'Main', NULL, '2025-08-23 06:43:15', '2025-08-23 06:43:15'),
(274, 44, '44-Shlok Heights-1755951196.JPG', 'Main', NULL, '2025-08-23 06:43:16', '2025-08-23 06:43:16'),
(275, 44, '44-Shlok Heights-1755951196.JPG', 'Main', NULL, '2025-08-23 06:43:16', '2025-08-23 06:43:16'),
(276, 44, '44-Shlok Heights-1755951197.JPG', 'Main', NULL, '2025-08-23 06:43:17', '2025-08-23 06:43:17'),
(277, 44, '44-Shlok Heights-1755951197.JPG', 'Main', NULL, '2025-08-23 06:43:17', '2025-08-23 06:43:17'),
(278, 44, '44-Shlok Heights-1755951199.JPG', 'Main', NULL, '2025-08-23 06:43:19', '2025-08-23 06:43:19'),
(279, 44, '44-Shlok Heights-1755951201.JPG', 'Main', NULL, '2025-08-23 06:43:21', '2025-08-23 06:43:21'),
(280, 44, '44-Shlok Heights-1755951202.JPG', 'Main', NULL, '2025-08-23 06:43:22', '2025-08-23 06:43:22'),
(281, 44, '44-Shlok Heights-1755951204.JPG', 'Main', NULL, '2025-08-23 06:43:24', '2025-08-23 06:43:24'),
(282, 44, '44-Shlok Heights-1755951206.png', 'Main', NULL, '2025-08-23 06:43:25', '2025-08-23 06:43:26'),
(283, 44, '44-Shlok Heights-1755951206.jpg', 'Main', NULL, '2025-08-23 06:43:26', '2025-08-23 06:43:26'),
(284, 44, '44-Shlok Heights-1755951206.jpg', 'Main', NULL, '2025-08-23 06:43:26', '2025-08-23 06:43:26'),
(285, 44, '44-Shlok Heights-1755951206.jpg', 'Main', NULL, '2025-08-23 06:43:26', '2025-08-23 06:43:26'),
(286, 44, '44-Shlok Heights-1755951207.jpg', 'Main', NULL, '2025-08-23 06:43:27', '2025-08-23 06:43:27'),
(287, 44, '44-Shlok Heights-1755951207.png', 'Main', NULL, '2025-08-23 06:43:27', '2025-08-23 06:43:27'),
(288, 44, '44-Shlok Heights-1755951207.png', 'Main', NULL, '2025-08-23 06:43:27', '2025-08-23 06:43:27'),
(289, 44, '44-Shlok Heights-1755951208.png', 'Main', NULL, '2025-08-23 06:43:28', '2025-08-23 06:43:28'),
(290, 44, '44-Shlok Heights-1755951208.jpg', 'Main', NULL, '2025-08-23 06:43:28', '2025-08-23 06:43:28'),
(291, 44, '44-Shlok Heights-1755951209.jpg', 'Main', NULL, '2025-08-23 06:43:29', '2025-08-23 06:43:29'),
(292, 44, '44-Shlok Heights-1755951210.jpg', 'Main', NULL, '2025-08-23 06:43:29', '2025-08-23 06:43:30'),
(293, 44, '44-Shlok Heights-1755951210.jpg', 'Main', NULL, '2025-08-23 06:43:30', '2025-08-23 06:43:30'),
(294, 44, '44-Shlok Heights-1755951211.jpg', 'Main', NULL, '2025-08-23 06:43:31', '2025-08-23 06:43:31'),
(295, 44, '44-Shlok Heights-1755951211.jpg', 'Main', NULL, '2025-08-23 06:43:31', '2025-08-23 06:43:31'),
(296, 44, '44-Shlok Heights-1755951211.jpg', 'Main', NULL, '2025-08-23 06:43:31', '2025-08-23 06:43:31'),
(297, 44, '44-Shlok Heights-1755951212.jpg', 'Main', NULL, '2025-08-23 06:43:31', '2025-08-23 06:43:32'),
(298, 44, '44-Shlok Heights-1755951212.jpg', 'Main', NULL, '2025-08-23 06:43:32', '2025-08-23 06:43:32'),
(299, 44, '44-Shlok Heights-1755951212.jpg', 'Main', NULL, '2025-08-23 06:43:32', '2025-08-23 06:43:32'),
(300, 44, '44-Shlok Heights-1755951212.jpg', 'Main', NULL, '2025-08-23 06:43:32', '2025-08-23 06:43:32'),
(301, 44, '44-Shlok Heights-1755951213.jpg', 'Main', NULL, '2025-08-23 06:43:33', '2025-08-23 06:43:33'),
(302, 44, '44-Shlok Heights-1755951213.png', 'Main', NULL, '2025-08-23 06:43:33', '2025-08-23 06:43:33'),
(303, 44, '44-Shlok Heights-1755951214.jpg', 'Main', NULL, '2025-08-23 06:43:34', '2025-08-23 06:43:34'),
(304, 44, '44-Shlok Heights-1755951214.jpg', 'Main', NULL, '2025-08-23 06:43:34', '2025-08-23 06:43:34'),
(305, 44, '44-Shlok Heights-1755951214.png', 'Main', NULL, '2025-08-23 06:43:34', '2025-08-23 06:43:34'),
(306, 44, '44-Shlok Heights-1755951215.png', 'Main', NULL, '2025-08-23 06:43:35', '2025-08-23 06:43:35'),
(307, 44, '44-Shlok Heights-1755951216.jpg', 'Main', NULL, '2025-08-23 06:43:36', '2025-08-23 06:43:36'),
(308, 44, '44-Shlok Heights-1755951216.jpg', 'Main', NULL, '2025-08-23 06:43:36', '2025-08-23 06:43:36'),
(309, 44, '44-Shlok Heights-1755951217.pdf', 'Main', NULL, '2025-08-23 06:43:36', '2025-08-23 06:43:37'),
(310, 44, '44-Shlok Heights new-1755951232.JPG', 'Main', NULL, '2025-08-23 06:43:52', '2025-08-23 06:43:52'),
(311, 44, '44-Shlok Heights new-1755951234.jpg', 'Main', NULL, '2025-08-23 06:43:54', '2025-08-23 06:43:54'),
(312, 44, '44-Shlok Heights new-1755951235.jpg', 'Main', NULL, '2025-08-23 06:43:54', '2025-08-23 06:43:55'),
(313, 44, '44-Shlok Heights new-1755951235.jpg', 'Main', NULL, '2025-08-23 06:43:55', '2025-08-23 06:43:55'),
(314, 44, '44-Shlok Heights new-1755951236.JPG', 'Main', NULL, '2025-08-23 06:43:56', '2025-08-23 06:43:56'),
(315, 44, '44-Shlok Heights new-1755951237.JPG', 'Main', NULL, '2025-08-23 06:43:57', '2025-08-23 06:43:57'),
(316, 44, '44-Shlok Heights new-1755951238.JPG', 'Main', NULL, '2025-08-23 06:43:58', '2025-08-23 06:43:58'),
(317, 44, '44-Shlok Heights new-1755951238.JPG', 'Main', NULL, '2025-08-23 06:43:58', '2025-08-23 06:43:58'),
(318, 44, '44-Shlok Heights new-1755951239.JPG', 'Main', NULL, '2025-08-23 06:43:59', '2025-08-23 06:43:59'),
(319, 44, '44-Shlok Heights new-1755951240.JPG', 'Main', NULL, '2025-08-23 06:44:00', '2025-08-23 06:44:00'),
(320, 44, '44-Shlok Heights new-1755951240.JPG', 'Main', NULL, '2025-08-23 06:44:00', '2025-08-23 06:44:00'),
(321, 44, '44-Shlok Heights new-1755951241.JPG', 'Main', NULL, '2025-08-23 06:44:01', '2025-08-23 06:44:01'),
(322, 44, '44-Shlok Heights new-1755951241.JPG', 'Main', NULL, '2025-08-23 06:44:01', '2025-08-23 06:44:01'),
(323, 44, '44-Shlok Heights new-1755951242.jpg', 'Main', NULL, '2025-08-23 06:44:02', '2025-08-23 06:44:02'),
(324, 44, '44-Shlok Heights new-1755951242.jpg', 'Main', NULL, '2025-08-23 06:44:02', '2025-08-23 06:44:02'),
(325, 44, '44-Shlok Heights new-1755951243.jpg', 'Main', NULL, '2025-08-23 06:44:03', '2025-08-23 06:44:03'),
(326, 44, '44-Shlok Heights new-1755951244.jpg', 'Main', NULL, '2025-08-23 06:44:03', '2025-08-23 06:44:04'),
(327, 44, '44-Shlok Heights new-1755951244.jpg', 'Main', NULL, '2025-08-23 06:44:04', '2025-08-23 06:44:04'),
(328, 44, '44-Shlok Heights new-1755951244.jpg', 'Main', NULL, '2025-08-23 06:44:04', '2025-08-23 06:44:04'),
(329, 44, '44-Shlok Heights new-1755951244.jpg', 'Main', NULL, '2025-08-23 06:44:04', '2025-08-23 06:44:04'),
(330, 44, '44-Shlok Heights new-1755951245.JPG', 'Main', NULL, '2025-08-23 06:44:05', '2025-08-23 06:44:05'),
(331, 44, '44-Shlok Heights new-1755951245.JPG', 'Main', NULL, '2025-08-23 06:44:05', '2025-08-23 06:44:05'),
(332, 44, '44-Shlok Heights new-1755951246.JPG', 'Main', NULL, '2025-08-23 06:44:06', '2025-08-23 06:44:06'),
(333, 44, '44-Shlok Heights new-1755951247.JPG', 'Main', NULL, '2025-08-23 06:44:07', '2025-08-23 06:44:07'),
(334, 44, '44-Shlok Heights new-1755951247.JPG', 'Main', NULL, '2025-08-23 06:44:07', '2025-08-23 06:44:07'),
(335, 44, '44-Shlok Heights new-1755951248.JPG', 'Main', NULL, '2025-08-23 06:44:08', '2025-08-23 06:44:08'),
(336, 44, '44-Shlok Heights new-1755951249.JPG', 'Main', NULL, '2025-08-23 06:44:09', '2025-08-23 06:44:09'),
(337, 44, '44-Shlok Heights new-1755951249.JPG', 'Main', NULL, '2025-08-23 06:44:09', '2025-08-23 06:44:09'),
(338, 44, '44-Shlok Heights new-1755951250.JPG', 'Main', NULL, '2025-08-23 06:44:10', '2025-08-23 06:44:10'),
(339, 44, '44-Shlok Heights new-1755951251.JPG', 'Main', NULL, '2025-08-23 06:44:11', '2025-08-23 06:44:11'),
(340, 44, '44-Shlok Heights new-1755951253.JPG', 'Main', NULL, '2025-08-23 06:44:13', '2025-08-23 06:44:13'),
(341, 44, '44-Shlok Heights new-1755951254.JPG', 'Main', NULL, '2025-08-23 06:44:14', '2025-08-23 06:44:14'),
(342, 44, '44-Shlok Heights new-1755951256.JPG', 'Main', NULL, '2025-08-23 06:44:16', '2025-08-23 06:44:16'),
(343, 44, '44-Shlok Heights new-1755951258.png', 'Main', NULL, '2025-08-23 06:44:18', '2025-08-23 06:44:18'),
(344, 44, '44-Shlok Heights new-1755951258.jpg', 'Main', NULL, '2025-08-23 06:44:18', '2025-08-23 06:44:18'),
(345, 44, '44-Shlok Heights new-1755951259.jpg', 'Main', NULL, '2025-08-23 06:44:18', '2025-08-23 06:44:19'),
(346, 44, '44-Shlok Heights new-1755951259.jpg', 'Main', NULL, '2025-08-23 06:44:19', '2025-08-23 06:44:19'),
(347, 44, '44-Shlok Heights new-1755951259.jpg', 'Main', NULL, '2025-08-23 06:44:19', '2025-08-23 06:44:19'),
(348, 44, '44-Shlok Heights new-1755951259.png', 'Main', NULL, '2025-08-23 06:44:19', '2025-08-23 06:44:19'),
(349, 44, '44-Shlok Heights new-1755951260.png', 'Main', NULL, '2025-08-23 06:44:20', '2025-08-23 06:44:20'),
(350, 44, '44-Shlok Heights new-1755951260.png', 'Main', NULL, '2025-08-23 06:44:20', '2025-08-23 06:44:20'),
(351, 44, '44-Shlok Heights new-1755951261.jpg', 'Main', NULL, '2025-08-23 06:44:21', '2025-08-23 06:44:21'),
(352, 44, '44-Shlok Heights new-1755951261.jpg', 'Main', NULL, '2025-08-23 06:44:21', '2025-08-23 06:44:21'),
(353, 44, '44-Shlok Heights new-1755951262.jpg', 'Main', NULL, '2025-08-23 06:44:22', '2025-08-23 06:44:22'),
(354, 44, '44-Shlok Heights new-1755951262.jpg', 'Main', NULL, '2025-08-23 06:44:22', '2025-08-23 06:44:22'),
(355, 44, '44-Shlok Heights new-1755951263.jpg', 'Main', NULL, '2025-08-23 06:44:23', '2025-08-23 06:44:23'),
(356, 44, '44-Shlok Heights new-1755951263.jpg', 'Main', NULL, '2025-08-23 06:44:23', '2025-08-23 06:44:23'),
(357, 44, '44-Shlok Heights new-1755951263.jpg', 'Main', NULL, '2025-08-23 06:44:23', '2025-08-23 06:44:23'),
(358, 44, '44-Shlok Heights new-1755951264.jpg', 'Main', NULL, '2025-08-23 06:44:24', '2025-08-23 06:44:24'),
(359, 44, '44-Shlok Heights new-1755951264.jpg', 'Main', NULL, '2025-08-23 06:44:24', '2025-08-23 06:44:24'),
(360, 44, '44-Shlok Heights new-1755951264.jpg', 'Main', NULL, '2025-08-23 06:44:24', '2025-08-23 06:44:24'),
(361, 44, '44-Shlok Heights new-1755951265.jpg', 'Main', NULL, '2025-08-23 06:44:25', '2025-08-23 06:44:25'),
(362, 44, '44-Shlok Heights new-1755951265.jpg', 'Main', NULL, '2025-08-23 06:44:25', '2025-08-23 06:44:25'),
(363, 44, '44-Shlok Heights new-1755951265.png', 'Main', NULL, '2025-08-23 06:44:25', '2025-08-23 06:44:25'),
(364, 44, '44-Shlok Heights new-1755951266.jpg', 'Main', NULL, '2025-08-23 06:44:26', '2025-08-23 06:44:26'),
(365, 44, '44-Shlok Heights new-1755951266.jpg', 'Main', NULL, '2025-08-23 06:44:26', '2025-08-23 06:44:26'),
(366, 44, '44-Shlok Heights new-1755951266.png', 'Main', NULL, '2025-08-23 06:44:26', '2025-08-23 06:44:26'),
(367, 44, '44-Shlok Heights new-1755951267.png', 'Main', NULL, '2025-08-23 06:44:27', '2025-08-23 06:44:27'),
(368, 44, '44-Shlok Heights new-1755951268.jpg', 'Main', NULL, '2025-08-23 06:44:28', '2025-08-23 06:44:28'),
(369, 44, '44-Shlok Heights new-1755951268.jpg', 'Main', NULL, '2025-08-23 06:44:28', '2025-08-23 06:44:28'),
(370, 44, '44-Shlok Heights new-1755951268.pdf', 'Main', NULL, '2025-08-23 06:44:28', '2025-08-23 06:44:28'),
(371, 44, '44-Shlok Heights-1755951294.JPG', 'Main', NULL, '2025-08-23 06:44:54', '2025-08-23 06:44:54'),
(372, 44, '44-Shlok Heights-1755951296.jpg', 'Main', NULL, '2025-08-23 06:44:56', '2025-08-23 06:44:56'),
(373, 44, '44-Shlok Heights-1755951297.jpg', 'Main', NULL, '2025-08-23 06:44:57', '2025-08-23 06:44:57'),
(374, 44, '44-Shlok Heights-1755951297.jpg', 'Main', NULL, '2025-08-23 06:44:57', '2025-08-23 06:44:57'),
(375, 44, '44-Shlok Heights-1755951298.JPG', 'Main', NULL, '2025-08-23 06:44:58', '2025-08-23 06:44:58'),
(376, 44, '44-Shlok Heights-1755951299.JPG', 'Main', NULL, '2025-08-23 06:44:59', '2025-08-23 06:44:59'),
(377, 44, '44-Shlok Heights-1755951300.JPG', 'Main', NULL, '2025-08-23 06:45:00', '2025-08-23 06:45:00'),
(378, 44, '44-Shlok Heights-1755951301.JPG', 'Main', NULL, '2025-08-23 06:45:01', '2025-08-23 06:45:01'),
(379, 44, '44-Shlok Heights-1755951301.JPG', 'Main', NULL, '2025-08-23 06:45:01', '2025-08-23 06:45:01'),
(380, 44, '44-Shlok Heights-1755951302.JPG', 'Main', NULL, '2025-08-23 06:45:02', '2025-08-23 06:45:02'),
(381, 44, '44-Shlok Heights-1755951302.JPG', 'Main', NULL, '2025-08-23 06:45:02', '2025-08-23 06:45:02'),
(382, 44, '44-Shlok Heights-1755951303.JPG', 'Main', NULL, '2025-08-23 06:45:03', '2025-08-23 06:45:03'),
(383, 44, '44-Shlok Heights-1755951304.JPG', 'Main', NULL, '2025-08-23 06:45:03', '2025-08-23 06:45:04'),
(384, 44, '44-Shlok Heights-1755951304.jpg', 'Main', NULL, '2025-08-23 06:45:04', '2025-08-23 06:45:04'),
(385, 44, '44-Shlok Heights-1755951305.jpg', 'Main', NULL, '2025-08-23 06:45:05', '2025-08-23 06:45:05'),
(386, 44, '44-Shlok Heights-1755951305.jpg', 'Main', NULL, '2025-08-23 06:45:05', '2025-08-23 06:45:05'),
(387, 44, '44-Shlok Heights-1755951306.jpg', 'Main', NULL, '2025-08-23 06:45:06', '2025-08-23 06:45:06'),
(388, 44, '44-Shlok Heights-1755951306.jpg', 'Main', NULL, '2025-08-23 06:45:06', '2025-08-23 06:45:06'),
(389, 44, '44-Shlok Heights-1755951306.jpg', 'Main', NULL, '2025-08-23 06:45:06', '2025-08-23 06:45:06'),
(390, 44, '44-Shlok Heights-1755951307.jpg', 'Main', NULL, '2025-08-23 06:45:07', '2025-08-23 06:45:07'),
(391, 44, '44-Shlok Heights-1755951307.JPG', 'Main', NULL, '2025-08-23 06:45:07', '2025-08-23 06:45:07'),
(392, 44, '44-Shlok Heights-1755951308.JPG', 'Main', NULL, '2025-08-23 06:45:08', '2025-08-23 06:45:08'),
(393, 44, '44-Shlok Heights-1755951308.JPG', 'Main', NULL, '2025-08-23 06:45:08', '2025-08-23 06:45:08'),
(394, 44, '44-Shlok Heights-1755951309.JPG', 'Main', NULL, '2025-08-23 06:45:09', '2025-08-23 06:45:09'),
(395, 44, '44-Shlok Heights-1755951310.JPG', 'Main', NULL, '2025-08-23 06:45:10', '2025-08-23 06:45:10'),
(396, 44, '44-Shlok Heights-1755951311.JPG', 'Main', NULL, '2025-08-23 06:45:11', '2025-08-23 06:45:11'),
(397, 44, '44-Shlok Heights-1755951311.JPG', 'Main', NULL, '2025-08-23 06:45:11', '2025-08-23 06:45:11'),
(398, 44, '44-Shlok Heights-1755951312.JPG', 'Main', NULL, '2025-08-23 06:45:12', '2025-08-23 06:45:12'),
(399, 44, '44-Shlok Heights-1755951312.JPG', 'Main', NULL, '2025-08-23 06:45:12', '2025-08-23 06:45:12'),
(400, 44, '44-Shlok Heights-1755951314.JPG', 'Main', NULL, '2025-08-23 06:45:14', '2025-08-23 06:45:14'),
(401, 44, '44-Shlok Heights-1755951315.JPG', 'Main', NULL, '2025-08-23 06:45:15', '2025-08-23 06:45:15'),
(402, 44, '44-Shlok Heights-1755951317.JPG', 'Main', NULL, '2025-08-23 06:45:17', '2025-08-23 06:45:17'),
(403, 44, '44-Shlok Heights-1755951318.JPG', 'Main', NULL, '2025-08-23 06:45:18', '2025-08-23 06:45:18'),
(404, 44, '44-Shlok Heights-1755951320.png', 'Main', NULL, '2025-08-23 06:45:20', '2025-08-23 06:45:20'),
(405, 44, '44-Shlok Heights-1755951320.jpg', 'Main', NULL, '2025-08-23 06:45:20', '2025-08-23 06:45:20'),
(406, 44, '44-Shlok Heights-1755951321.jpg', 'Main', NULL, '2025-08-23 06:45:21', '2025-08-23 06:45:21'),
(407, 44, '44-Shlok Heights-1755951321.jpg', 'Main', NULL, '2025-08-23 06:45:21', '2025-08-23 06:45:21'),
(408, 44, '44-Shlok Heights-1755951321.jpg', 'Main', NULL, '2025-08-23 06:45:21', '2025-08-23 06:45:21'),
(409, 44, '44-Shlok Heights-1755951322.png', 'Main', NULL, '2025-08-23 06:45:22', '2025-08-23 06:45:22'),
(410, 44, '44-Shlok Heights-1755951322.png', 'Main', NULL, '2025-08-23 06:45:22', '2025-08-23 06:45:22'),
(411, 44, '44-Shlok Heights-1755951322.png', 'Main', NULL, '2025-08-23 06:45:22', '2025-08-23 06:45:22'),
(412, 44, '44-Shlok Heights-1755951323.jpg', 'Main', NULL, '2025-08-23 06:45:23', '2025-08-23 06:45:23'),
(413, 44, '44-Shlok Heights-1755951324.jpg', 'Main', NULL, '2025-08-23 06:45:24', '2025-08-23 06:45:24'),
(414, 44, '44-Shlok Heights-1755951324.jpg', 'Main', NULL, '2025-08-23 06:45:24', '2025-08-23 06:45:24'),
(415, 44, '44-Shlok Heights-1755951325.jpg', 'Main', NULL, '2025-08-23 06:45:25', '2025-08-23 06:45:25'),
(416, 44, '44-Shlok Heights-1755951325.jpg', 'Main', NULL, '2025-08-23 06:45:25', '2025-08-23 06:45:25'),
(417, 44, '44-Shlok Heights-1755951326.jpg', 'Main', NULL, '2025-08-23 06:45:26', '2025-08-23 06:45:26'),
(418, 44, '44-Shlok Heights-1755951326.jpg', 'Main', NULL, '2025-08-23 06:45:26', '2025-08-23 06:45:26'),
(419, 44, '44-Shlok Heights-1755951326.jpg', 'Main', NULL, '2025-08-23 06:45:26', '2025-08-23 06:45:26'),
(420, 44, '44-Shlok Heights-1755951327.jpg', 'Main', NULL, '2025-08-23 06:45:27', '2025-08-23 06:45:27'),
(421, 44, '44-Shlok Heights-1755951327.jpg', 'Main', NULL, '2025-08-23 06:45:27', '2025-08-23 06:45:27'),
(422, 44, '44-Shlok Heights-1755951327.jpg', 'Main', NULL, '2025-08-23 06:45:27', '2025-08-23 06:45:27'),
(423, 44, '44-Shlok Heights-1755951328.jpg', 'Main', NULL, '2025-08-23 06:45:28', '2025-08-23 06:45:28'),
(424, 44, '44-Shlok Heights-1755951328.png', 'Main', NULL, '2025-08-23 06:45:28', '2025-08-23 06:45:28'),
(425, 44, '44-Shlok Heights-1755951328.jpg', 'Main', NULL, '2025-08-23 06:45:28', '2025-08-23 06:45:28'),
(426, 44, '44-Shlok Heights-1755951329.jpg', 'Main', NULL, '2025-08-23 06:45:29', '2025-08-23 06:45:29'),
(427, 44, '44-Shlok Heights-1755951329.png', 'Main', NULL, '2025-08-23 06:45:29', '2025-08-23 06:45:29'),
(428, 44, '44-Shlok Heights-1755951330.png', 'Main', NULL, '2025-08-23 06:45:30', '2025-08-23 06:45:30'),
(429, 44, '44-Shlok Heights-1755951331.jpg', 'Main', NULL, '2025-08-23 06:45:30', '2025-08-23 06:45:31'),
(430, 44, '44-Shlok Heights-1755951331.jpg', 'Main', NULL, '2025-08-23 06:45:31', '2025-08-23 06:45:31'),
(431, 44, '44-Shlok Heights-1755951331.pdf', 'Main', NULL, '2025-08-23 06:45:31', '2025-08-23 06:45:31'),
(432, 44, '44-Shlok Heights-1755951357.JPG', 'Main', NULL, '2025-08-23 06:45:57', '2025-08-23 06:45:57'),
(433, 44, '44-Shlok Heights-1755951360.jpg', 'Main', NULL, '2025-08-23 06:45:59', '2025-08-23 06:46:00'),
(434, 44, '44-Shlok Heights-1755951360.jpg', 'Main', NULL, '2025-08-23 06:46:00', '2025-08-23 06:46:00'),
(435, 44, '44-Shlok Heights-1755951361.jpg', 'Main', NULL, '2025-08-23 06:46:01', '2025-08-23 06:46:01'),
(436, 44, '44-Shlok Heights-1755951361.JPG', 'Main', NULL, '2025-08-23 06:46:01', '2025-08-23 06:46:01'),
(437, 44, '44-Shlok Heights-1755951363.JPG', 'Main', NULL, '2025-08-23 06:46:03', '2025-08-23 06:46:03'),
(438, 44, '44-Shlok Heights-1755951364.JPG', 'Main', NULL, '2025-08-23 06:46:04', '2025-08-23 06:46:04'),
(439, 44, '44-Shlok Heights-1755951364.JPG', 'Main', NULL, '2025-08-23 06:46:04', '2025-08-23 06:46:04'),
(440, 44, '44-Shlok Heights-1755951365.JPG', 'Main', NULL, '2025-08-23 06:46:05', '2025-08-23 06:46:05'),
(441, 44, '44-Shlok Heights-1755951366.JPG', 'Main', NULL, '2025-08-23 06:46:06', '2025-08-23 06:46:06'),
(442, 44, '44-Shlok Heights-1755951366.JPG', 'Main', NULL, '2025-08-23 06:46:06', '2025-08-23 06:46:06'),
(443, 44, '44-Shlok Heights-1755951367.JPG', 'Main', NULL, '2025-08-23 06:46:07', '2025-08-23 06:46:07'),
(444, 44, '44-Shlok Heights-1755951367.JPG', 'Main', NULL, '2025-08-23 06:46:07', '2025-08-23 06:46:07'),
(445, 44, '44-Shlok Heights-1755951368.jpg', 'Main', NULL, '2025-08-23 06:46:08', '2025-08-23 06:46:08'),
(446, 44, '44-Shlok Heights-1755951368.jpg', 'Main', NULL, '2025-08-23 06:46:08', '2025-08-23 06:46:08'),
(447, 44, '44-Shlok Heights-1755951369.jpg', 'Main', NULL, '2025-08-23 06:46:09', '2025-08-23 06:46:09'),
(448, 44, '44-Shlok Heights-1755951369.jpg', 'Main', NULL, '2025-08-23 06:46:09', '2025-08-23 06:46:09'),
(449, 44, '44-Shlok Heights-1755951370.jpg', 'Main', NULL, '2025-08-23 06:46:10', '2025-08-23 06:46:10'),
(450, 44, '44-Shlok Heights-1755951370.jpg', 'Main', NULL, '2025-08-23 06:46:10', '2025-08-23 06:46:10'),
(451, 44, '44-Shlok Heights-1755951371.jpg', 'Main', NULL, '2025-08-23 06:46:11', '2025-08-23 06:46:11'),
(452, 44, '44-Shlok Heights-1755951371.JPG', 'Main', NULL, '2025-08-23 06:46:11', '2025-08-23 06:46:11'),
(453, 44, '44-Shlok Heights-1755951372.JPG', 'Main', NULL, '2025-08-23 06:46:12', '2025-08-23 06:46:12'),
(454, 44, '44-Shlok Heights-1755951372.JPG', 'Main', NULL, '2025-08-23 06:46:12', '2025-08-23 06:46:12'),
(455, 44, '44-Shlok Heights-1755951373.JPG', 'Main', NULL, '2025-08-23 06:46:13', '2025-08-23 06:46:13'),
(456, 44, '44-Shlok Heights-1755951374.JPG', 'Main', NULL, '2025-08-23 06:46:14', '2025-08-23 06:46:14'),
(457, 44, '44-Shlok Heights-1755951374.JPG', 'Main', NULL, '2025-08-23 06:46:14', '2025-08-23 06:46:14'),
(458, 44, '44-Shlok Heights-1755951375.JPG', 'Main', NULL, '2025-08-23 06:46:15', '2025-08-23 06:46:15'),
(459, 44, '44-Shlok Heights-1755951376.JPG', 'Main', NULL, '2025-08-23 06:46:16', '2025-08-23 06:46:16'),
(460, 44, '44-Shlok Heights-1755951376.JPG', 'Main', NULL, '2025-08-23 06:46:16', '2025-08-23 06:46:16'),
(461, 44, '44-Shlok Heights-1755951378.JPG', 'Main', NULL, '2025-08-23 06:46:18', '2025-08-23 06:46:18'),
(462, 44, '44-Shlok Heights-1755951379.JPG', 'Main', NULL, '2025-08-23 06:46:19', '2025-08-23 06:46:19'),
(463, 44, '44-Shlok Heights-1755951381.JPG', 'Main', NULL, '2025-08-23 06:46:21', '2025-08-23 06:46:21'),
(464, 44, '44-Shlok Heights-1755951382.JPG', 'Main', NULL, '2025-08-23 06:46:22', '2025-08-23 06:46:22'),
(465, 44, '44-Shlok Heights-1755951384.png', 'Main', NULL, '2025-08-23 06:46:24', '2025-08-23 06:46:24'),
(466, 44, '44-Shlok Heights-1755951384.jpg', 'Main', NULL, '2025-08-23 06:46:24', '2025-08-23 06:46:24'),
(467, 44, '44-Shlok Heights-1755951385.jpg', 'Main', NULL, '2025-08-23 06:46:25', '2025-08-23 06:46:25'),
(468, 44, '44-Shlok Heights-1755951385.jpg', 'Main', NULL, '2025-08-23 06:46:25', '2025-08-23 06:46:25'),
(469, 44, '44-Shlok Heights-1755951385.jpg', 'Main', NULL, '2025-08-23 06:46:25', '2025-08-23 06:46:25'),
(470, 44, '44-Shlok Heights-1755951386.png', 'Main', NULL, '2025-08-23 06:46:26', '2025-08-23 06:46:26'),
(471, 44, '44-Shlok Heights-1755951386.png', 'Main', NULL, '2025-08-23 06:46:26', '2025-08-23 06:46:26'),
(472, 44, '44-Shlok Heights-1755951386.png', 'Main', NULL, '2025-08-23 06:46:26', '2025-08-23 06:46:26'),
(473, 44, '44-Shlok Heights-1755951387.jpg', 'Main', NULL, '2025-08-23 06:46:27', '2025-08-23 06:46:27'),
(474, 44, '44-Shlok Heights-1755951387.jpg', 'Main', NULL, '2025-08-23 06:46:27', '2025-08-23 06:46:27'),
(475, 44, '44-Shlok Heights-1755951388.jpg', 'Main', NULL, '2025-08-23 06:46:28', '2025-08-23 06:46:28'),
(476, 44, '44-Shlok Heights-1755951389.jpg', 'Main', NULL, '2025-08-23 06:46:29', '2025-08-23 06:46:29'),
(477, 44, '44-Shlok Heights-1755951389.jpg', 'Main', NULL, '2025-08-23 06:46:29', '2025-08-23 06:46:29'),
(478, 44, '44-Shlok Heights-1755951389.jpg', 'Main', NULL, '2025-08-23 06:46:29', '2025-08-23 06:46:29'),
(479, 44, '44-Shlok Heights-1755951390.jpg', 'Main', NULL, '2025-08-23 06:46:30', '2025-08-23 06:46:30'),
(480, 44, '44-Shlok Heights-1755951390.jpg', 'Main', NULL, '2025-08-23 06:46:30', '2025-08-23 06:46:30'),
(481, 44, '44-Shlok Heights-1755951390.jpg', 'Main', NULL, '2025-08-23 06:46:30', '2025-08-23 06:46:30'),
(482, 44, '44-Shlok Heights-1755951391.jpg', 'Main', NULL, '2025-08-23 06:46:31', '2025-08-23 06:46:31'),
(483, 44, '44-Shlok Heights-1755951391.jpg', 'Main', NULL, '2025-08-23 06:46:31', '2025-08-23 06:46:31'),
(484, 44, '44-Shlok Heights-1755951391.jpg', 'Main', NULL, '2025-08-23 06:46:31', '2025-08-23 06:46:31'),
(485, 44, '44-Shlok Heights-1755951391.png', 'Main', NULL, '2025-08-23 06:46:31', '2025-08-23 06:46:31'),
(486, 44, '44-Shlok Heights-1755951392.jpg', 'Main', NULL, '2025-08-23 06:46:32', '2025-08-23 06:46:32'),
(487, 44, '44-Shlok Heights-1755951392.jpg', 'Main', NULL, '2025-08-23 06:46:32', '2025-08-23 06:46:32'),
(488, 44, '44-Shlok Heights-1755951392.png', 'Main', NULL, '2025-08-23 06:46:32', '2025-08-23 06:46:32'),
(489, 44, '44-Shlok Heights-1755951393.png', 'Main', NULL, '2025-08-23 06:46:33', '2025-08-23 06:46:33'),
(490, 44, '44-Shlok Heights-1755951394.jpg', 'Main', NULL, '2025-08-23 06:46:34', '2025-08-23 06:46:34'),
(491, 44, '44-Shlok Heights-1755951394.jpg', 'Main', NULL, '2025-08-23 06:46:34', '2025-08-23 06:46:34'),
(492, 44, '44-Shlok Heights-1755951395.pdf', 'Main', NULL, '2025-08-23 06:46:34', '2025-08-23 06:46:35'),
(493, 44, '44-Shlok Heights-1755951869.JPG', 'Main', NULL, '2025-08-23 06:54:28', '2025-08-23 06:54:29'),
(494, 44, '44-Shlok Heights-1755951871.jpg', 'Main', NULL, '2025-08-23 06:54:30', '2025-08-23 06:54:31'),
(495, 44, '44-Shlok Heights-1755951871.jpg', 'Main', NULL, '2025-08-23 06:54:31', '2025-08-23 06:54:31'),
(496, 44, '44-Shlok Heights-1755951872.jpg', 'Main', NULL, '2025-08-23 06:54:32', '2025-08-23 06:54:32'),
(497, 44, '44-Shlok Heights-1755951872.JPG', 'Main', NULL, '2025-08-23 06:54:32', '2025-08-23 06:54:32'),
(498, 44, '44-Shlok Heights-1755951874.JPG', 'Main', NULL, '2025-08-23 06:54:34', '2025-08-23 06:54:34'),
(499, 44, '44-Shlok Heights-1755951874.JPG', 'Main', NULL, '2025-08-23 06:54:34', '2025-08-23 06:54:34'),
(500, 44, '44-Shlok Heights-1755951875.JPG', 'Main', NULL, '2025-08-23 06:54:35', '2025-08-23 06:54:35'),
(501, 44, '44-Shlok Heights-1755951876.JPG', 'Main', NULL, '2025-08-23 06:54:36', '2025-08-23 06:54:36'),
(502, 44, '44-Shlok Heights-1755951876.JPG', 'Main', NULL, '2025-08-23 06:54:36', '2025-08-23 06:54:36'),
(503, 44, '44-Shlok Heights-1755951889.JPG', 'Main', NULL, '2025-08-23 06:54:48', '2025-08-23 06:54:49'),
(504, 44, '44-Shlok Heights-1755951890.jpg', 'Main', NULL, '2025-08-23 06:54:50', '2025-08-23 06:54:50'),
(505, 44, '44-Shlok Heights-1755951891.jpg', 'Main', NULL, '2025-08-23 06:54:51', '2025-08-23 06:54:51'),
(506, 44, '44-Shlok Heights-1755951892.jpg', 'Main', NULL, '2025-08-23 06:54:52', '2025-08-23 06:54:52'),
(507, 44, '44-Shlok Heights-1755951892.JPG', 'Main', NULL, '2025-08-23 06:54:52', '2025-08-23 06:54:52'),
(508, 44, '44-Shlok Heights-1755951894.JPG', 'Main', NULL, '2025-08-23 06:54:54', '2025-08-23 06:54:54'),
(509, 44, '44-Shlok Heights-1755951894.JPG', 'Main', NULL, '2025-08-23 06:54:54', '2025-08-23 06:54:54'),
(510, 44, '44-Shlok Heights-1755951895.JPG', 'Main', NULL, '2025-08-23 06:54:55', '2025-08-23 06:54:55'),
(511, 44, '44-Shlok Heights-1755951896.JPG', 'Main', NULL, '2025-08-23 06:54:56', '2025-08-23 06:54:56'),
(512, 44, '44-Shlok Heights-1755951896.JPG', 'Main', NULL, '2025-08-23 06:54:56', '2025-08-23 06:54:56'),
(513, 44, '44-Shlok Heights-1755951909.JPG', 'Main', NULL, '2025-08-23 06:55:09', '2025-08-23 06:55:09'),
(514, 44, '44-Shlok Heights-1755951911.jpg', 'Main', NULL, '2025-08-23 06:55:11', '2025-08-23 06:55:11'),
(515, 44, '44-Shlok Heights-1755951912.jpg', 'Main', NULL, '2025-08-23 06:55:12', '2025-08-23 06:55:12'),
(516, 44, '44-Shlok Heights-1755951912.jpg', 'Main', NULL, '2025-08-23 06:55:12', '2025-08-23 06:55:12'),
(517, 44, '44-Shlok Heights-1755951913.JPG', 'Main', NULL, '2025-08-23 06:55:13', '2025-08-23 06:55:13'),
(518, 44, '44-Shlok Heights-1755951915.JPG', 'Main', NULL, '2025-08-23 06:55:15', '2025-08-23 06:55:15'),
(519, 44, '44-Shlok Heights-1755951915.JPG', 'Main', NULL, '2025-08-23 06:55:15', '2025-08-23 06:55:15'),
(520, 44, '44-Shlok Heights-1755951916.JPG', 'Main', NULL, '2025-08-23 06:55:16', '2025-08-23 06:55:16'),
(521, 44, '44-Shlok Heights-1755951917.JPG', 'Main', NULL, '2025-08-23 06:55:17', '2025-08-23 06:55:17'),
(522, 44, '44-Shlok Heights-1755951917.JPG', 'Main', NULL, '2025-08-23 06:55:17', '2025-08-23 06:55:17'),
(523, 44, '44-Shlok Heights-1755952026.JPG', 'Main', NULL, '2025-08-23 06:57:06', '2025-08-23 06:57:06'),
(524, 44, '44-Shlok Heights-1755952028.jpg', 'Main', NULL, '2025-08-23 06:57:08', '2025-08-23 06:57:08'),
(525, 44, '44-Shlok Heights-1755952029.jpg', 'Main', NULL, '2025-08-23 06:57:08', '2025-08-23 06:57:09'),
(526, 44, '44-Shlok Heights-1755952029.jpg', 'Main', NULL, '2025-08-23 06:57:09', '2025-08-23 06:57:09'),
(527, 44, '44-Shlok Heights-1755952030.JPG', 'Main', NULL, '2025-08-23 06:57:10', '2025-08-23 06:57:10'),
(528, 44, '44-Shlok Heights-1755952031.JPG', 'Main', NULL, '2025-08-23 06:57:11', '2025-08-23 06:57:11'),
(529, 44, '44-Shlok Heights-1755952032.JPG', 'Main', NULL, '2025-08-23 06:57:12', '2025-08-23 06:57:12'),
(530, 44, '44-Shlok Heights-1755952032.JPG', 'Main', NULL, '2025-08-23 06:57:12', '2025-08-23 06:57:12'),
(531, 44, '44-Shlok Heights-1755952033.JPG', 'Main', NULL, '2025-08-23 06:57:13', '2025-08-23 06:57:13'),
(532, 44, '44-Shlok Heights-1755952034.JPG', 'Main', NULL, '2025-08-23 06:57:14', '2025-08-23 06:57:14'),
(533, 44, '44-Shlok Heights-1755952104.JPG', 'Main', NULL, '2025-08-23 06:58:24', '2025-08-23 06:58:24'),
(534, 44, '44-Shlok Heights-1755952106.jpg', 'Main', NULL, '2025-08-23 06:58:26', '2025-08-23 06:58:26'),
(535, 44, '44-Shlok Heights-1755952107.jpg', 'Main', NULL, '2025-08-23 06:58:27', '2025-08-23 06:58:27'),
(536, 44, '44-Shlok Heights-1755952107.jpg', 'Main', NULL, '2025-08-23 06:58:27', '2025-08-23 06:58:27'),
(537, 44, '44-Shlok Heights-1755952108.JPG', 'Main', NULL, '2025-08-23 06:58:28', '2025-08-23 06:58:28'),
(538, 44, '44-Shlok Heights-1755952109.JPG', 'Main', NULL, '2025-08-23 06:58:29', '2025-08-23 06:58:29'),
(539, 44, '44-Shlok Heights-1755952110.JPG', 'Main', NULL, '2025-08-23 06:58:30', '2025-08-23 06:58:30'),
(540, 44, '44-Shlok Heights-1755952110.JPG', 'Main', NULL, '2025-08-23 06:58:30', '2025-08-23 06:58:30'),
(541, 44, '44-Shlok Heights-1755952111.JPG', 'Main', NULL, '2025-08-23 06:58:31', '2025-08-23 06:58:31'),
(542, 44, '44-Shlok Heights-1755952112.JPG', 'Main', NULL, '2025-08-23 06:58:32', '2025-08-23 06:58:32'),
(543, 44, '44-Shlok Heights-1755952120.JPG', 'Main', NULL, '2025-08-23 06:58:39', '2025-08-23 06:58:40'),
(544, 44, '44-Shlok Heights-1755952122.jpg', 'Main', NULL, '2025-08-23 06:58:41', '2025-08-23 06:58:42'),
(545, 44, '44-Shlok Heights-1755952122.jpg', 'Main', NULL, '2025-08-23 06:58:42', '2025-08-23 06:58:42'),
(546, 44, '44-Shlok Heights-1755952123.jpg', 'Main', NULL, '2025-08-23 06:58:43', '2025-08-23 06:58:43'),
(547, 44, '44-Shlok Heights-1755952123.JPG', 'Main', NULL, '2025-08-23 06:58:43', '2025-08-23 06:58:43'),
(548, 44, '44-Shlok Heights-1755952125.JPG', 'Main', NULL, '2025-08-23 06:58:45', '2025-08-23 06:58:45'),
(549, 44, '44-Shlok Heights-1755952125.JPG', 'Main', NULL, '2025-08-23 06:58:45', '2025-08-23 06:58:45'),
(550, 44, '44-Shlok Heights-1755952126.JPG', 'Main', NULL, '2025-08-23 06:58:46', '2025-08-23 06:58:46'),
(551, 44, '44-Shlok Heights-1755952127.JPG', 'Main', NULL, '2025-08-23 06:58:46', '2025-08-23 06:58:47'),
(552, 44, '44-Shlok Heights-1755952127.JPG', 'Main', NULL, '2025-08-23 06:58:47', '2025-08-23 06:58:47');
INSERT INTO `property_images` (`id`, `property_id`, `image`, `label`, `sort_order`, `created_at`, `updated_at`) VALUES
(553, 44, '44-Shlok Heights-1755952147.JPG', 'Main', NULL, '2025-08-23 06:59:07', '2025-08-23 06:59:07'),
(554, 44, '44-Shlok Heights-1755952149.jpg', 'Main', NULL, '2025-08-23 06:59:09', '2025-08-23 06:59:09'),
(555, 44, '44-Shlok Heights-1755952150.jpg', 'Main', NULL, '2025-08-23 06:59:10', '2025-08-23 06:59:10'),
(556, 44, '44-Shlok Heights-1755952150.jpg', 'Main', NULL, '2025-08-23 06:59:10', '2025-08-23 06:59:10'),
(557, 44, '44-Shlok Heights-1755952151.JPG', 'Main', NULL, '2025-08-23 06:59:11', '2025-08-23 06:59:11'),
(558, 44, '44-Shlok Heights-1755952152.JPG', 'Main', NULL, '2025-08-23 06:59:12', '2025-08-23 06:59:12'),
(559, 44, '44-Shlok Heights-1755952153.JPG', 'Main', NULL, '2025-08-23 06:59:13', '2025-08-23 06:59:13'),
(560, 44, '44-Shlok Heights-1755952154.JPG', 'Main', NULL, '2025-08-23 06:59:14', '2025-08-23 06:59:14'),
(561, 44, '44-Shlok Heights-1755952154.JPG', 'Main', NULL, '2025-08-23 06:59:14', '2025-08-23 06:59:14'),
(562, 44, '44-Shlok Heights-1755952155.JPG', 'Main', NULL, '2025-08-23 06:59:15', '2025-08-23 06:59:15'),
(563, 44, '44-Shlok Heights-1755952171.JPG', 'Main', NULL, '2025-08-23 06:59:31', '2025-08-23 06:59:31'),
(564, 44, '44-Shlok Heights-1755952173.jpg', 'Main', NULL, '2025-08-23 06:59:33', '2025-08-23 06:59:33'),
(565, 44, '44-Shlok Heights-1755952174.jpg', 'Main', NULL, '2025-08-23 06:59:34', '2025-08-23 06:59:34'),
(566, 44, '44-Shlok Heights-1755952174.jpg', 'Main', NULL, '2025-08-23 06:59:34', '2025-08-23 06:59:34'),
(567, 44, '44-Shlok Heights-1755952175.JPG', 'Main', NULL, '2025-08-23 06:59:35', '2025-08-23 06:59:35'),
(568, 44, '44-Shlok Heights-1755952176.JPG', 'Main', NULL, '2025-08-23 06:59:36', '2025-08-23 06:59:36'),
(569, 44, '44-Shlok Heights-1755952177.JPG', 'Main', NULL, '2025-08-23 06:59:37', '2025-08-23 06:59:37'),
(570, 44, '44-Shlok Heights-1755952178.JPG', 'Main', NULL, '2025-08-23 06:59:38', '2025-08-23 06:59:38'),
(571, 44, '44-Shlok Heights-1755952178.JPG', 'Main', NULL, '2025-08-23 06:59:38', '2025-08-23 06:59:38'),
(572, 44, '44-Shlok Heights-1755952179.JPG', 'Main', NULL, '2025-08-23 06:59:39', '2025-08-23 06:59:39'),
(573, 44, '44-Shlok Heights-1755952243.JPG', 'Main', NULL, '2025-08-23 07:00:43', '2025-08-23 07:00:43'),
(574, 44, '44-Shlok Heights-1755952245.jpg', 'Main', NULL, '2025-08-23 07:00:45', '2025-08-23 07:00:45'),
(575, 44, '44-Shlok Heights-1755952246.jpg', 'Main', NULL, '2025-08-23 07:00:46', '2025-08-23 07:00:46'),
(576, 44, '44-Shlok Heights-1755952246.jpg', 'Main', NULL, '2025-08-23 07:00:46', '2025-08-23 07:00:46'),
(577, 44, '44-Shlok Heights-1755952247.JPG', 'Main', NULL, '2025-08-23 07:00:47', '2025-08-23 07:00:47'),
(578, 44, '44-Shlok Heights-1755952248.JPG', 'Main', NULL, '2025-08-23 07:00:48', '2025-08-23 07:00:48'),
(579, 44, '44-Shlok Heights-1755952249.JPG', 'Main', NULL, '2025-08-23 07:00:49', '2025-08-23 07:00:49'),
(580, 44, '44-Shlok Heights-1755952249.JPG', 'Main', NULL, '2025-08-23 07:00:49', '2025-08-23 07:00:49'),
(581, 44, '44-Shlok Heights-1755952250.JPG', 'Main', NULL, '2025-08-23 07:00:50', '2025-08-23 07:00:50'),
(582, 44, '44-Shlok Heights-1755952251.JPG', 'Main', NULL, '2025-08-23 07:00:51', '2025-08-23 07:00:51'),
(583, 44, '44-Shlok Heights-1755952268.JPG', 'Main', NULL, '2025-08-23 07:01:08', '2025-08-23 07:01:08'),
(584, 44, '44-Shlok Heights-1755952270.jpg', 'Main', NULL, '2025-08-23 07:01:10', '2025-08-23 07:01:10'),
(585, 44, '44-Shlok Heights-1755952271.jpg', 'Main', NULL, '2025-08-23 07:01:11', '2025-08-23 07:01:11'),
(586, 44, '44-Shlok Heights-1755952272.jpg', 'Main', NULL, '2025-08-23 07:01:12', '2025-08-23 07:01:12'),
(587, 44, '44-Shlok Heights-1755952272.JPG', 'Main', NULL, '2025-08-23 07:01:12', '2025-08-23 07:01:12'),
(588, 44, '44-Shlok Heights-1755952274.JPG', 'Main', NULL, '2025-08-23 07:01:14', '2025-08-23 07:01:14'),
(589, 44, '44-Shlok Heights-1755952274.JPG', 'Main', NULL, '2025-08-23 07:01:14', '2025-08-23 07:01:14'),
(590, 44, '44-Shlok Heights-1755952275.JPG', 'Main', NULL, '2025-08-23 07:01:15', '2025-08-23 07:01:15'),
(591, 44, '44-Shlok Heights-1755952276.JPG', 'Main', NULL, '2025-08-23 07:01:16', '2025-08-23 07:01:16'),
(592, 44, '44-Shlok Heights-1755952276.JPG', 'Main', NULL, '2025-08-23 07:01:16', '2025-08-23 07:01:16'),
(593, 44, '44-Shlok Heights-1755952497.JPG', 'Main', NULL, '2025-08-23 07:04:57', '2025-08-23 07:04:57'),
(594, 44, '44-Shlok Heights-1755952499.jpg', 'Main', NULL, '2025-08-23 07:04:59', '2025-08-23 07:04:59'),
(595, 44, '44-Shlok Heights-1755952500.jpg', 'Main', NULL, '2025-08-23 07:05:00', '2025-08-23 07:05:00'),
(596, 44, '44-Shlok Heights-1755952500.jpg', 'Main', NULL, '2025-08-23 07:05:00', '2025-08-23 07:05:00'),
(597, 44, '44-Shlok Heights-1755952501.JPG', 'Main', NULL, '2025-08-23 07:05:01', '2025-08-23 07:05:01'),
(598, 44, '44-Shlok Heights-1755952502.JPG', 'Main', NULL, '2025-08-23 07:05:02', '2025-08-23 07:05:02'),
(599, 44, '44-Shlok Heights-1755952503.JPG', 'Main', NULL, '2025-08-23 07:05:03', '2025-08-23 07:05:03'),
(600, 44, '44-Shlok Heights-1755952504.JPG', 'Main', NULL, '2025-08-23 07:05:04', '2025-08-23 07:05:04'),
(601, 44, '44-Shlok Heights-1755952504.JPG', 'Main', NULL, '2025-08-23 07:05:04', '2025-08-23 07:05:04'),
(602, 44, '44-Shlok Heights-1755952505.JPG', 'Main', NULL, '2025-08-23 07:05:05', '2025-08-23 07:05:05'),
(603, 44, '44-Shlok Heights-1755952527.JPG', 'Main', NULL, '2025-08-23 07:05:27', '2025-08-23 07:05:27'),
(604, 44, '44-Shlok Heights-1755952529.jpg', 'Main', NULL, '2025-08-23 07:05:29', '2025-08-23 07:05:29'),
(605, 44, '44-Shlok Heights-1755952529.jpg', 'Main', NULL, '2025-08-23 07:05:29', '2025-08-23 07:05:29'),
(606, 44, '44-Shlok Heights-1755952530.jpg', 'Main', NULL, '2025-08-23 07:05:30', '2025-08-23 07:05:30'),
(607, 44, '44-Shlok Heights-1755952530.JPG', 'Main', NULL, '2025-08-23 07:05:30', '2025-08-23 07:05:30'),
(608, 44, '44-Shlok Heights-1755952532.JPG', 'Main', NULL, '2025-08-23 07:05:32', '2025-08-23 07:05:32'),
(609, 44, '44-Shlok Heights-1755952532.JPG', 'Main', NULL, '2025-08-23 07:05:32', '2025-08-23 07:05:32'),
(610, 44, '44-Shlok Heights-1755952533.JPG', 'Main', NULL, '2025-08-23 07:05:33', '2025-08-23 07:05:33'),
(611, 44, '44-Shlok Heights-1755952534.JPG', 'Main', NULL, '2025-08-23 07:05:34', '2025-08-23 07:05:34'),
(612, 44, '44-Shlok Heights-1755952534.JPG', 'Main', NULL, '2025-08-23 07:05:34', '2025-08-23 07:05:34'),
(613, 44, '44-Shlok Heights-1755952551.JPG', 'Main', NULL, '2025-08-23 07:05:51', '2025-08-23 07:05:51'),
(614, 44, '44-Shlok Heights-1755952553.jpg', 'Main', NULL, '2025-08-23 07:05:52', '2025-08-23 07:05:53'),
(615, 44, '44-Shlok Heights-1755952553.jpg', 'Main', NULL, '2025-08-23 07:05:53', '2025-08-23 07:05:53'),
(616, 44, '44-Shlok Heights-1755952554.jpg', 'Main', NULL, '2025-08-23 07:05:54', '2025-08-23 07:05:54'),
(617, 44, '44-Shlok Heights-1755952554.JPG', 'Main', NULL, '2025-08-23 07:05:54', '2025-08-23 07:05:54'),
(618, 44, '44-Shlok Heights-1755952556.JPG', 'Main', NULL, '2025-08-23 07:05:56', '2025-08-23 07:05:56'),
(619, 44, '44-Shlok Heights-1755952556.JPG', 'Main', NULL, '2025-08-23 07:05:56', '2025-08-23 07:05:56'),
(620, 44, '44-Shlok Heights-1755952557.JPG', 'Main', NULL, '2025-08-23 07:05:57', '2025-08-23 07:05:57'),
(621, 44, '44-Shlok Heights-1755952558.JPG', 'Main', NULL, '2025-08-23 07:05:57', '2025-08-23 07:05:58'),
(622, 44, '44-Shlok Heights-1755952558.JPG', 'Main', NULL, '2025-08-23 07:05:58', '2025-08-23 07:05:58'),
(623, 44, '44-Shlok Heights-1755952569.JPG', 'Main', NULL, '2025-08-23 07:06:09', '2025-08-23 07:06:09'),
(624, 44, '44-Shlok Heights-1755952571.jpg', 'Main', NULL, '2025-08-23 07:06:11', '2025-08-23 07:06:11'),
(625, 44, '44-Shlok Heights-1755952572.jpg', 'Main', NULL, '2025-08-23 07:06:12', '2025-08-23 07:06:12'),
(626, 44, '44-Shlok Heights-1755952572.jpg', 'Main', NULL, '2025-08-23 07:06:12', '2025-08-23 07:06:12'),
(627, 44, '44-Shlok Heights-1755952573.JPG', 'Main', NULL, '2025-08-23 07:06:13', '2025-08-23 07:06:13'),
(628, 44, '44-Shlok Heights-1755952574.JPG', 'Main', NULL, '2025-08-23 07:06:14', '2025-08-23 07:06:14'),
(629, 44, '44-Shlok Heights-1755952575.JPG', 'Main', NULL, '2025-08-23 07:06:15', '2025-08-23 07:06:15'),
(630, 44, '44-Shlok Heights-1755952576.JPG', 'Main', NULL, '2025-08-23 07:06:16', '2025-08-23 07:06:16'),
(631, 44, '44-Shlok Heights-1755952577.JPG', 'Main', NULL, '2025-08-23 07:06:17', '2025-08-23 07:06:17'),
(632, 44, '44-Shlok Heights-1755952577.JPG', 'Main', NULL, '2025-08-23 07:06:17', '2025-08-23 07:06:17'),
(633, 44, '44-Shlok Heights-1755952622.JPG', 'Main', NULL, '2025-08-23 07:07:02', '2025-08-23 07:07:02'),
(634, 44, '44-Shlok Heights-1755952624.jpg', 'Main', NULL, '2025-08-23 07:07:04', '2025-08-23 07:07:04'),
(635, 44, '44-Shlok Heights-1755952625.jpg', 'Main', NULL, '2025-08-23 07:07:05', '2025-08-23 07:07:05'),
(636, 44, '44-Shlok Heights-1755952625.jpg', 'Main', NULL, '2025-08-23 07:07:05', '2025-08-23 07:07:05'),
(637, 44, '44-Shlok Heights-1755952626.JPG', 'Main', NULL, '2025-08-23 07:07:06', '2025-08-23 07:07:06'),
(638, 44, '44-Shlok Heights-1755952627.JPG', 'Main', NULL, '2025-08-23 07:07:07', '2025-08-23 07:07:07'),
(639, 44, '44-Shlok Heights-1755952628.JPG', 'Main', NULL, '2025-08-23 07:07:08', '2025-08-23 07:07:08'),
(640, 44, '44-Shlok Heights-1755952629.JPG', 'Main', NULL, '2025-08-23 07:07:09', '2025-08-23 07:07:09'),
(641, 44, '44-Shlok Heights-1755952629.JPG', 'Main', NULL, '2025-08-23 07:07:09', '2025-08-23 07:07:09'),
(642, 44, '44-Shlok Heights-1755952630.JPG', 'Main', NULL, '2025-08-23 07:07:10', '2025-08-23 07:07:10'),
(644, 44, '44-Shlok Heights-1755956037.JPG', 'Main', NULL, '2025-08-23 08:03:57', '2025-08-23 08:03:57'),
(645, 44, '44-Shlok Heights-1755956040.jpg', 'Main', NULL, '2025-08-23 08:03:59', '2025-08-23 08:04:00'),
(646, 44, '44-Shlok Heights-1755956040.jpg', 'Main', NULL, '2025-08-23 08:04:00', '2025-08-23 08:04:00'),
(647, 44, '44-Shlok Heights-1755956041.jpg', 'Main', NULL, '2025-08-23 08:04:01', '2025-08-23 08:04:01'),
(648, 44, '44-Shlok Heights-1755956041.JPG', 'Main', NULL, '2025-08-23 08:04:01', '2025-08-23 08:04:01'),
(649, 44, '44-Shlok Heights-1755956043.JPG', 'Main', NULL, '2025-08-23 08:04:03', '2025-08-23 08:04:03'),
(650, 44, '44-Shlok Heights-1755956043.JPG', 'Main', NULL, '2025-08-23 08:04:03', '2025-08-23 08:04:03'),
(651, 44, '44-Shlok Heights-1755956044.JPG', 'Main', NULL, '2025-08-23 08:04:04', '2025-08-23 08:04:04'),
(652, 44, '44-Shlok Heights-1755956045.JPG', 'Main', NULL, '2025-08-23 08:04:05', '2025-08-23 08:04:05'),
(653, 44, '44-Shlok Heights-1755956046.JPG', 'Main', NULL, '2025-08-23 08:04:06', '2025-08-23 08:04:06'),
(654, 44, '44-Shlok Heights-1755956251.JPG', 'Main', NULL, '2025-08-23 08:07:31', '2025-08-23 08:07:31'),
(655, 44, '44-Shlok Heights-1755956253.jpg', 'Main', NULL, '2025-08-23 08:07:33', '2025-08-23 08:07:33'),
(656, 44, '44-Shlok Heights-1755956254.jpg', 'Main', NULL, '2025-08-23 08:07:34', '2025-08-23 08:07:34'),
(657, 44, '44-Shlok Heights-1755956255.jpg', 'Main', NULL, '2025-08-23 08:07:34', '2025-08-23 08:07:35'),
(658, 44, '44-Shlok Heights-1755956255.JPG', 'Main', NULL, '2025-08-23 08:07:35', '2025-08-23 08:07:35'),
(659, 44, '44-Shlok Heights-1755956257.JPG', 'Main', NULL, '2025-08-23 08:07:37', '2025-08-23 08:07:37'),
(660, 44, '44-Shlok Heights-1755956257.JPG', 'Main', NULL, '2025-08-23 08:07:37', '2025-08-23 08:07:37'),
(661, 44, '44-Shlok Heights-1755956258.JPG', 'Main', NULL, '2025-08-23 08:07:38', '2025-08-23 08:07:38'),
(662, 44, '44-Shlok Heights-1755956258.JPG', 'Main', NULL, '2025-08-23 08:07:38', '2025-08-23 08:07:38'),
(663, 44, '44-Shlok Heights-1755956259.JPG', 'Main', NULL, '2025-08-23 08:07:39', '2025-08-23 08:07:39'),
(664, 44, '44-Shlok Heights-1755956266.JPG', 'Main', NULL, '2025-08-23 08:07:46', '2025-08-23 08:07:46'),
(665, 44, '44-Shlok Heights-1755956268.jpg', 'Main', NULL, '2025-08-23 08:07:48', '2025-08-23 08:07:48'),
(666, 44, '44-Shlok Heights-1755956269.jpg', 'Main', NULL, '2025-08-23 08:07:49', '2025-08-23 08:07:49'),
(667, 44, '44-Shlok Heights-1755956269.jpg', 'Main', NULL, '2025-08-23 08:07:49', '2025-08-23 08:07:49'),
(668, 44, '44-Shlok Heights-1755956270.JPG', 'Main', NULL, '2025-08-23 08:07:50', '2025-08-23 08:07:50'),
(669, 44, '44-Shlok Heights-1755956271.JPG', 'Main', NULL, '2025-08-23 08:07:51', '2025-08-23 08:07:51'),
(670, 44, '44-Shlok Heights-1755956272.JPG', 'Main', NULL, '2025-08-23 08:07:52', '2025-08-23 08:07:52'),
(671, 44, '44-Shlok Heights-1755956273.JPG', 'Main', NULL, '2025-08-23 08:07:52', '2025-08-23 08:07:53'),
(672, 44, '44-Shlok Heights-1755956273.JPG', 'Main', NULL, '2025-08-23 08:07:53', '2025-08-23 08:07:53'),
(673, 44, '44-Shlok Heights-1755956274.JPG', 'Main', NULL, '2025-08-23 08:07:54', '2025-08-23 08:07:54'),
(674, 44, '44-Shlok Heights 5-1756295435.JPG', 'Main', NULL, '2025-08-27 06:20:35', '2025-08-27 06:20:35'),
(675, 44, '44-Shlok Heights 5-1756295440.jpg', 'Main', NULL, '2025-08-27 06:20:40', '2025-08-27 06:20:40'),
(676, 44, '44-Shlok Heights 5-1756295441.jpg', 'Main', NULL, '2025-08-27 06:20:41', '2025-08-27 06:20:41'),
(677, 44, '44-Shlok Heights 5-1756295441.jpg', 'Main', NULL, '2025-08-27 06:20:41', '2025-08-27 06:20:41'),
(678, 44, '44-Shlok Heights 5-1756295442.JPG', 'Main', NULL, '2025-08-27 06:20:42', '2025-08-27 06:20:42'),
(679, 44, '44-Shlok Heights 5-1756295444.JPG', 'Main', NULL, '2025-08-27 06:20:44', '2025-08-27 06:20:44'),
(680, 44, '44-Shlok Heights 5-1756295444.JPG', 'Main', NULL, '2025-08-27 06:20:44', '2025-08-27 06:20:44'),
(681, 44, '44-Shlok Heights 5-1756295445.JPG', 'Main', NULL, '2025-08-27 06:20:45', '2025-08-27 06:20:45'),
(682, 44, '44-Shlok Heights 5-1756295445.JPG', 'Main', NULL, '2025-08-27 06:20:45', '2025-08-27 06:20:45'),
(683, 44, '44-Shlok Heights 5-1756295446.JPG', 'Main', NULL, '2025-08-27 06:20:46', '2025-08-27 06:20:46'),
(684, 44, '44-Shlok Heights-1756295469.JPG', 'Main', NULL, '2025-08-27 06:21:09', '2025-08-27 06:21:09'),
(685, 44, '44-Shlok Heights-1756295471.jpg', 'Main', NULL, '2025-08-27 06:21:11', '2025-08-27 06:21:11'),
(686, 44, '44-Shlok Heights-1756295472.jpg', 'Main', NULL, '2025-08-27 06:21:12', '2025-08-27 06:21:12'),
(687, 44, '44-Shlok Heights-1756295473.jpg', 'Main', NULL, '2025-08-27 06:21:12', '2025-08-27 06:21:13'),
(688, 44, '44-Shlok Heights-1756295473.JPG', 'Main', NULL, '2025-08-27 06:21:13', '2025-08-27 06:21:13'),
(689, 44, '44-Shlok Heights-1756295475.JPG', 'Main', NULL, '2025-08-27 06:21:15', '2025-08-27 06:21:15'),
(690, 44, '44-Shlok Heights-1756295475.JPG', 'Main', NULL, '2025-08-27 06:21:15', '2025-08-27 06:21:15'),
(691, 44, '44-Shlok Heights-1756295476.JPG', 'Main', NULL, '2025-08-27 06:21:16', '2025-08-27 06:21:16'),
(692, 44, '44-Shlok Heights-1756295477.JPG', 'Main', NULL, '2025-08-27 06:21:17', '2025-08-27 06:21:17'),
(693, 44, '44-Shlok Heights-1756295477.JPG', 'Main', NULL, '2025-08-27 06:21:17', '2025-08-27 06:21:17'),
(694, 44, '44-Shlok Heights-1756295659.JPG', 'Main', NULL, '2025-08-27 06:24:18', '2025-08-27 06:24:19'),
(695, 44, '44-Shlok Heights-1756295661.jpg', 'Main', NULL, '2025-08-27 06:24:20', '2025-08-27 06:24:21'),
(696, 44, '44-Shlok Heights-1756295661.jpg', 'Main', NULL, '2025-08-27 06:24:21', '2025-08-27 06:24:21'),
(697, 44, '44-Shlok Heights-1756295662.jpg', 'Main', NULL, '2025-08-27 06:24:22', '2025-08-27 06:24:22'),
(698, 44, '44-Shlok Heights-1756295662.JPG', 'Main', NULL, '2025-08-27 06:24:22', '2025-08-27 06:24:22'),
(699, 44, '44-Shlok Heights-1756295664.JPG', 'Main', NULL, '2025-08-27 06:24:24', '2025-08-27 06:24:24'),
(700, 44, '44-Shlok Heights-1756295665.JPG', 'Main', NULL, '2025-08-27 06:24:25', '2025-08-27 06:24:25'),
(701, 44, '44-Shlok Heights-1756295665.JPG', 'Main', NULL, '2025-08-27 06:24:25', '2025-08-27 06:24:25'),
(702, 44, '44-Shlok Heights-1756295666.JPG', 'Main', NULL, '2025-08-27 06:24:26', '2025-08-27 06:24:26'),
(703, 44, '44-Shlok Heights-1756295667.JPG', 'Main', NULL, '2025-08-27 06:24:26', '2025-08-27 06:24:27'),
(704, 44, '44-Shlok Heights-1756295718.JPG', 'Main', NULL, '2025-08-27 06:25:18', '2025-08-27 06:25:18'),
(705, 44, '44-Shlok Heights-1756295720.jpg', 'Main', NULL, '2025-08-27 06:25:20', '2025-08-27 06:25:20'),
(706, 44, '44-Shlok Heights-1756295721.jpg', 'Main', NULL, '2025-08-27 06:25:21', '2025-08-27 06:25:21'),
(707, 44, '44-Shlok Heights-1756295722.jpg', 'Main', NULL, '2025-08-27 06:25:21', '2025-08-27 06:25:22'),
(708, 44, '44-Shlok Heights-1756295722.JPG', 'Main', NULL, '2025-08-27 06:25:22', '2025-08-27 06:25:22'),
(709, 44, '44-Shlok Heights-1756295724.JPG', 'Main', NULL, '2025-08-27 06:25:24', '2025-08-27 06:25:24'),
(710, 44, '44-Shlok Heights-1756295724.JPG', 'Main', NULL, '2025-08-27 06:25:24', '2025-08-27 06:25:24'),
(711, 44, '44-Shlok Heights-1756295725.JPG', 'Main', NULL, '2025-08-27 06:25:25', '2025-08-27 06:25:25'),
(712, 44, '44-Shlok Heights-1756295726.JPG', 'Main', NULL, '2025-08-27 06:25:26', '2025-08-27 06:25:26'),
(713, 44, '44-Shlok Heights-1756295726.JPG', 'Main', NULL, '2025-08-27 06:25:26', '2025-08-27 06:25:26'),
(714, 44, '44-Shlok Heights-1756295774.JPG', 'Main', NULL, '2025-08-27 06:26:14', '2025-08-27 06:26:14'),
(715, 44, '44-Shlok Heights-1756295776.jpg', 'Main', NULL, '2025-08-27 06:26:16', '2025-08-27 06:26:16'),
(716, 44, '44-Shlok Heights-1756295777.jpg', 'Main', NULL, '2025-08-27 06:26:17', '2025-08-27 06:26:17'),
(717, 44, '44-Shlok Heights-1756295777.jpg', 'Main', NULL, '2025-08-27 06:26:17', '2025-08-27 06:26:17'),
(718, 44, '44-Shlok Heights-1756295778.JPG', 'Main', NULL, '2025-08-27 06:26:18', '2025-08-27 06:26:18'),
(719, 44, '44-Shlok Heights-1756295779.JPG', 'Main', NULL, '2025-08-27 06:26:19', '2025-08-27 06:26:19'),
(720, 44, '44-Shlok Heights-1756295780.JPG', 'Main', NULL, '2025-08-27 06:26:20', '2025-08-27 06:26:20'),
(721, 44, '44-Shlok Heights-1756295781.JPG', 'Main', NULL, '2025-08-27 06:26:21', '2025-08-27 06:26:21'),
(722, 44, '44-Shlok Heights-1756295781.JPG', 'Main', NULL, '2025-08-27 06:26:21', '2025-08-27 06:26:21'),
(723, 44, '44-Shlok Heights-1756295782.JPG', 'Main', NULL, '2025-08-27 06:26:22', '2025-08-27 06:26:22'),
(724, 44, '44-Shlok Heights-1756295835.JPG', 'Main', NULL, '2025-08-27 06:27:15', '2025-08-27 06:27:15'),
(725, 44, '44-Shlok Heights-1756295837.jpg', 'Main', NULL, '2025-08-27 06:27:17', '2025-08-27 06:27:17'),
(726, 44, '44-Shlok Heights-1756295838.jpg', 'Main', NULL, '2025-08-27 06:27:17', '2025-08-27 06:27:18'),
(727, 44, '44-Shlok Heights-1756295838.jpg', 'Main', NULL, '2025-08-27 06:27:18', '2025-08-27 06:27:18'),
(728, 44, '44-Shlok Heights-1756295839.JPG', 'Main', NULL, '2025-08-27 06:27:19', '2025-08-27 06:27:19'),
(729, 44, '44-Shlok Heights-1756295840.JPG', 'Main', NULL, '2025-08-27 06:27:20', '2025-08-27 06:27:20'),
(730, 44, '44-Shlok Heights-1756295841.JPG', 'Main', NULL, '2025-08-27 06:27:21', '2025-08-27 06:27:21'),
(731, 44, '44-Shlok Heights-1756295842.JPG', 'Main', NULL, '2025-08-27 06:27:21', '2025-08-27 06:27:22'),
(732, 44, '44-Shlok Heights-1756295842.JPG', 'Main', NULL, '2025-08-27 06:27:22', '2025-08-27 06:27:22'),
(733, 44, '44-Shlok Heights-1756295843.JPG', 'Main', NULL, '2025-08-27 06:27:23', '2025-08-27 06:27:23'),
(734, 44, '44-Shlok Heights-1756295858.JPG', 'Main', NULL, '2025-08-27 06:27:38', '2025-08-27 06:27:38'),
(735, 44, '44-Shlok Heights-1756295860.jpg', 'Main', NULL, '2025-08-27 06:27:40', '2025-08-27 06:27:40'),
(736, 44, '44-Shlok Heights-1756295861.jpg', 'Main', NULL, '2025-08-27 06:27:41', '2025-08-27 06:27:41'),
(737, 44, '44-Shlok Heights-1756295861.jpg', 'Main', NULL, '2025-08-27 06:27:41', '2025-08-27 06:27:41'),
(738, 44, '44-Shlok Heights-1756295862.JPG', 'Main', NULL, '2025-08-27 06:27:42', '2025-08-27 06:27:42'),
(739, 44, '44-Shlok Heights-1756295863.JPG', 'Main', NULL, '2025-08-27 06:27:43', '2025-08-27 06:27:43'),
(740, 44, '44-Shlok Heights-1756295864.JPG', 'Main', NULL, '2025-08-27 06:27:44', '2025-08-27 06:27:44'),
(741, 44, '44-Shlok Heights-1756295865.JPG', 'Main', NULL, '2025-08-27 06:27:45', '2025-08-27 06:27:45'),
(742, 44, '44-Shlok Heights-1756295865.JPG', 'Main', NULL, '2025-08-27 06:27:45', '2025-08-27 06:27:45'),
(743, 44, '44-Shlok Heights-1756295866.JPG', 'Main', NULL, '2025-08-27 06:27:46', '2025-08-27 06:27:46'),
(744, 44, '44-Shlok Heights-1756295896.JPG', 'Main', NULL, '2025-08-27 06:28:16', '2025-08-27 06:28:16'),
(745, 44, '44-Shlok Heights-1756295898.jpg', 'Main', NULL, '2025-08-27 06:28:18', '2025-08-27 06:28:18'),
(746, 44, '44-Shlok Heights-1756295898.jpg', 'Main', NULL, '2025-08-27 06:28:18', '2025-08-27 06:28:18'),
(747, 44, '44-Shlok Heights-1756295899.jpg', 'Main', NULL, '2025-08-27 06:28:19', '2025-08-27 06:28:19'),
(748, 44, '44-Shlok Heights-1756295899.JPG', 'Main', NULL, '2025-08-27 06:28:19', '2025-08-27 06:28:19'),
(749, 44, '44-Shlok Heights-1756295901.JPG', 'Main', NULL, '2025-08-27 06:28:21', '2025-08-27 06:28:21'),
(750, 44, '44-Shlok Heights-1756295902.JPG', 'Main', NULL, '2025-08-27 06:28:21', '2025-08-27 06:28:22'),
(751, 44, '44-Shlok Heights-1756295902.JPG', 'Main', NULL, '2025-08-27 06:28:22', '2025-08-27 06:28:22'),
(752, 44, '44-Shlok Heights-1756295903.JPG', 'Main', NULL, '2025-08-27 06:28:23', '2025-08-27 06:28:23'),
(753, 44, '44-Shlok Heights-1756295903.JPG', 'Main', NULL, '2025-08-27 06:28:23', '2025-08-27 06:28:23'),
(754, 44, '44-Shlok Heights-1756295928.JPG', 'Main', NULL, '2025-08-27 06:28:48', '2025-08-27 06:28:48'),
(755, 44, '44-Shlok Heights-1756295930.jpg', 'Main', NULL, '2025-08-27 06:28:50', '2025-08-27 06:28:50'),
(756, 44, '44-Shlok Heights-1756295931.jpg', 'Main', NULL, '2025-08-27 06:28:51', '2025-08-27 06:28:51'),
(757, 44, '44-Shlok Heights-1756295932.jpg', 'Main', NULL, '2025-08-27 06:28:51', '2025-08-27 06:28:52'),
(758, 44, '44-Shlok Heights-1756295932.JPG', 'Main', NULL, '2025-08-27 06:28:52', '2025-08-27 06:28:52'),
(759, 44, '44-Shlok Heights-1756295934.JPG', 'Main', NULL, '2025-08-27 06:28:54', '2025-08-27 06:28:54'),
(760, 44, '44-Shlok Heights-1756295934.JPG', 'Main', NULL, '2025-08-27 06:28:54', '2025-08-27 06:28:54'),
(761, 44, '44-Shlok Heights-1756295935.JPG', 'Main', NULL, '2025-08-27 06:28:55', '2025-08-27 06:28:55'),
(762, 44, '44-Shlok Heights-1756295935.JPG', 'Main', NULL, '2025-08-27 06:28:55', '2025-08-27 06:28:55'),
(763, 44, '44-Shlok Heights-1756295936.JPG', 'Main', NULL, '2025-08-27 06:28:56', '2025-08-27 06:28:56'),
(764, 44, '44-Shlok Heights-1756295944.JPG', 'Main', NULL, '2025-08-27 06:29:04', '2025-08-27 06:29:04'),
(765, 44, '44-Shlok Heights-1756295947.jpg', 'Main', NULL, '2025-08-27 06:29:07', '2025-08-27 06:29:07'),
(766, 44, '44-Shlok Heights-1756295947.jpg', 'Main', NULL, '2025-08-27 06:29:07', '2025-08-27 06:29:07'),
(767, 44, '44-Shlok Heights-1756295948.jpg', 'Main', NULL, '2025-08-27 06:29:08', '2025-08-27 06:29:08'),
(768, 44, '44-Shlok Heights-1756295949.JPG', 'Main', NULL, '2025-08-27 06:29:08', '2025-08-27 06:29:09'),
(769, 44, '44-Shlok Heights-1756295950.JPG', 'Main', NULL, '2025-08-27 06:29:10', '2025-08-27 06:29:10'),
(770, 44, '44-Shlok Heights-1756295951.JPG', 'Main', NULL, '2025-08-27 06:29:11', '2025-08-27 06:29:11'),
(771, 44, '44-Shlok Heights-1756295951.JPG', 'Main', NULL, '2025-08-27 06:29:11', '2025-08-27 06:29:11'),
(772, 44, '44-Shlok Heights-1756295952.JPG', 'Main', NULL, '2025-08-27 06:29:12', '2025-08-27 06:29:12'),
(773, 44, '44-Shlok Heights-1756295953.JPG', 'Main', NULL, '2025-08-27 06:29:13', '2025-08-27 06:29:13'),
(774, 44, '44-Shlok Heights-1756296332.JPG', 'Main', NULL, '2025-08-27 06:35:32', '2025-08-27 06:35:32'),
(775, 44, '44-Shlok Heights-1756296334.jpg', 'Main', NULL, '2025-08-27 06:35:34', '2025-08-27 06:35:34'),
(776, 44, '44-Shlok Heights-1756296335.jpg', 'Main', NULL, '2025-08-27 06:35:35', '2025-08-27 06:35:35'),
(777, 44, '44-Shlok Heights-1756296335.jpg', 'Main', NULL, '2025-08-27 06:35:35', '2025-08-27 06:35:35'),
(778, 44, '44-Shlok Heights-1756296336.JPG', 'Main', NULL, '2025-08-27 06:35:36', '2025-08-27 06:35:36'),
(779, 44, '44-Shlok Heights-1756296337.JPG', 'Main', NULL, '2025-08-27 06:35:37', '2025-08-27 06:35:37'),
(780, 44, '44-Shlok Heights-1756296338.JPG', 'Main', NULL, '2025-08-27 06:35:38', '2025-08-27 06:35:38'),
(781, 44, '44-Shlok Heights-1756296339.JPG', 'Main', NULL, '2025-08-27 06:35:38', '2025-08-27 06:35:39'),
(782, 44, '44-Shlok Heights-1756296339.JPG', 'Main', NULL, '2025-08-27 06:35:39', '2025-08-27 06:35:39'),
(783, 44, '44-Shlok Heights-1756296340.JPG', 'Main', NULL, '2025-08-27 06:35:40', '2025-08-27 06:35:40'),
(784, 44, '44-Shlok Heights-1756296352.JPG', 'Main', NULL, '2025-08-27 06:35:52', '2025-08-27 06:35:52'),
(785, 44, '44-Shlok Heights-1756296354.jpg', 'Main', NULL, '2025-08-27 06:35:54', '2025-08-27 06:35:54'),
(786, 44, '44-Shlok Heights-1756296355.jpg', 'Main', NULL, '2025-08-27 06:35:55', '2025-08-27 06:35:55'),
(787, 44, '44-Shlok Heights-1756296355.jpg', 'Main', NULL, '2025-08-27 06:35:55', '2025-08-27 06:35:55'),
(788, 44, '44-Shlok Heights-1756296356.JPG', 'Main', NULL, '2025-08-27 06:35:56', '2025-08-27 06:35:56'),
(789, 44, '44-Shlok Heights-1756296357.JPG', 'Main', NULL, '2025-08-27 06:35:57', '2025-08-27 06:35:57'),
(790, 44, '44-Shlok Heights-1756296358.JPG', 'Main', NULL, '2025-08-27 06:35:58', '2025-08-27 06:35:58'),
(791, 44, '44-Shlok Heights-1756296359.JPG', 'Main', NULL, '2025-08-27 06:35:59', '2025-08-27 06:35:59'),
(792, 44, '44-Shlok Heights-1756296359.JPG', 'Main', NULL, '2025-08-27 06:35:59', '2025-08-27 06:35:59'),
(793, 44, '44-Shlok Heights-1756296360.JPG', 'Main', NULL, '2025-08-27 06:36:00', '2025-08-27 06:36:00'),
(794, 44, '44-Shlok Heights-1756296568.JPG', 'Main', NULL, '2025-08-27 06:39:28', '2025-08-27 06:39:28'),
(795, 44, '44-Shlok Heights-1756296570.jpg', 'Main', NULL, '2025-08-27 06:39:30', '2025-08-27 06:39:30'),
(796, 44, '44-Shlok Heights-1756296571.jpg', 'Main', NULL, '2025-08-27 06:39:31', '2025-08-27 06:39:31'),
(797, 44, '44-Shlok Heights-1756296572.jpg', 'Main', NULL, '2025-08-27 06:39:31', '2025-08-27 06:39:32'),
(798, 44, '44-Shlok Heights-1756296572.JPG', 'Main', NULL, '2025-08-27 06:39:32', '2025-08-27 06:39:32'),
(799, 44, '44-Shlok Heights-1756296574.JPG', 'Main', NULL, '2025-08-27 06:39:34', '2025-08-27 06:39:34'),
(800, 44, '44-Shlok Heights-1756296574.JPG', 'Main', NULL, '2025-08-27 06:39:34', '2025-08-27 06:39:34'),
(801, 44, '44-Shlok Heights-1756296575.JPG', 'Main', NULL, '2025-08-27 06:39:35', '2025-08-27 06:39:35'),
(802, 44, '44-Shlok Heights-1756296576.JPG', 'Main', NULL, '2025-08-27 06:39:36', '2025-08-27 06:39:36'),
(803, 44, '44-Shlok Heights-1756296576.JPG', 'Main', NULL, '2025-08-27 06:39:36', '2025-08-27 06:39:36'),
(804, 44, '44-Shlok Heights-1756296592.JPG', 'Main', NULL, '2025-08-27 06:39:51', '2025-08-27 06:39:52'),
(805, 44, '44-Shlok Heights-1756296594.jpg', 'Main', NULL, '2025-08-27 06:39:54', '2025-08-27 06:39:54'),
(806, 44, '44-Shlok Heights-1756296594.jpg', 'Main', NULL, '2025-08-27 06:39:54', '2025-08-27 06:39:54'),
(807, 44, '44-Shlok Heights-1756296595.jpg', 'Main', NULL, '2025-08-27 06:39:55', '2025-08-27 06:39:55'),
(808, 44, '44-Shlok Heights-1756296596.JPG', 'Main', NULL, '2025-08-27 06:39:56', '2025-08-27 06:39:56'),
(809, 44, '44-Shlok Heights-1756296597.JPG', 'Main', NULL, '2025-08-27 06:39:57', '2025-08-27 06:39:57'),
(810, 44, '44-Shlok Heights-1756296598.JPG', 'Main', NULL, '2025-08-27 06:39:58', '2025-08-27 06:39:58'),
(811, 44, '44-Shlok Heights-1756296599.JPG', 'Main', NULL, '2025-08-27 06:39:59', '2025-08-27 06:39:59'),
(812, 44, '44-Shlok Heights-1756296599.JPG', 'Main', NULL, '2025-08-27 06:39:59', '2025-08-27 06:39:59'),
(813, 44, '44-Shlok Heights-1756296600.JPG', 'Main', NULL, '2025-08-27 06:40:00', '2025-08-27 06:40:00'),
(814, 44, '44-Shlok Heights-1756296791.JPG', 'Main', NULL, '2025-08-27 06:43:11', '2025-08-27 06:43:11'),
(815, 44, '44-Shlok Heights-1756296793.jpg', 'Main', NULL, '2025-08-27 06:43:13', '2025-08-27 06:43:13'),
(816, 44, '44-Shlok Heights-1756296794.jpg', 'Main', NULL, '2025-08-27 06:43:14', '2025-08-27 06:43:14'),
(817, 44, '44-Shlok Heights-1756296794.jpg', 'Main', NULL, '2025-08-27 06:43:14', '2025-08-27 06:43:14'),
(818, 44, '44-Shlok Heights-1756296795.JPG', 'Main', NULL, '2025-08-27 06:43:15', '2025-08-27 06:43:15'),
(819, 44, '44-Shlok Heights-1756296797.JPG', 'Main', NULL, '2025-08-27 06:43:17', '2025-08-27 06:43:17'),
(820, 44, '44-Shlok Heights-1756296797.JPG', 'Main', NULL, '2025-08-27 06:43:17', '2025-08-27 06:43:17'),
(821, 44, '44-Shlok Heights-1756296798.JPG', 'Main', NULL, '2025-08-27 06:43:18', '2025-08-27 06:43:18'),
(822, 44, '44-Shlok Heights-1756296799.JPG', 'Main', NULL, '2025-08-27 06:43:19', '2025-08-27 06:43:19'),
(823, 44, '44-Shlok Heights-1756296799.JPG', 'Main', NULL, '2025-08-27 06:43:19', '2025-08-27 06:43:19'),
(824, 44, '44-Shlok Heights-1756296964.JPG', 'Main', NULL, '2025-08-27 06:46:04', '2025-08-27 06:46:04'),
(825, 44, '44-Shlok Heights-1756296966.jpg', 'Main', NULL, '2025-08-27 06:46:06', '2025-08-27 06:46:06'),
(826, 44, '44-Shlok Heights-1756296967.jpg', 'Main', NULL, '2025-08-27 06:46:06', '2025-08-27 06:46:07'),
(827, 44, '44-Shlok Heights-1756296967.jpg', 'Main', NULL, '2025-08-27 06:46:07', '2025-08-27 06:46:07'),
(828, 44, '44-Shlok Heights-1756296968.JPG', 'Main', NULL, '2025-08-27 06:46:08', '2025-08-27 06:46:08'),
(829, 44, '44-Shlok Heights-1756296970.JPG', 'Main', NULL, '2025-08-27 06:46:10', '2025-08-27 06:46:10'),
(830, 44, '44-Shlok Heights-1756296970.JPG', 'Main', NULL, '2025-08-27 06:46:10', '2025-08-27 06:46:10'),
(831, 44, '44-Shlok Heights-1756296971.JPG', 'Main', NULL, '2025-08-27 06:46:11', '2025-08-27 06:46:11'),
(832, 44, '44-Shlok Heights-1756296972.JPG', 'Main', NULL, '2025-08-27 06:46:11', '2025-08-27 06:46:12'),
(833, 44, '44-Shlok Heights-1756296972.JPG', 'Main', NULL, '2025-08-27 06:46:12', '2025-08-27 06:46:12'),
(834, 44, '44-Shlok Heights-1756297115.JPG', 'Main', NULL, '2025-08-27 06:48:35', '2025-08-27 06:48:35'),
(835, 44, '44-Shlok Heights-1756297117.jpg', 'Main', NULL, '2025-08-27 06:48:37', '2025-08-27 06:48:37'),
(836, 44, '44-Shlok Heights-1756297117.jpg', 'Main', NULL, '2025-08-27 06:48:37', '2025-08-27 06:48:37'),
(837, 44, '44-Shlok Heights-1756297118.jpg', 'Main', NULL, '2025-08-27 06:48:38', '2025-08-27 06:48:38'),
(838, 44, '44-Shlok Heights-1756297118.JPG', 'Main', NULL, '2025-08-27 06:48:38', '2025-08-27 06:48:38'),
(839, 44, '44-Shlok Heights-1756297120.JPG', 'Main', NULL, '2025-08-27 06:48:40', '2025-08-27 06:48:40'),
(840, 44, '44-Shlok Heights-1756297121.JPG', 'Main', NULL, '2025-08-27 06:48:41', '2025-08-27 06:48:41'),
(841, 44, '44-Shlok Heights-1756297121.JPG', 'Main', NULL, '2025-08-27 06:48:41', '2025-08-27 06:48:41'),
(842, 44, '44-Shlok Heights-1756297122.JPG', 'Main', NULL, '2025-08-27 06:48:42', '2025-08-27 06:48:42'),
(843, 44, '44-Shlok Heights-1756297123.JPG', 'Main', NULL, '2025-08-27 06:48:43', '2025-08-27 06:48:43'),
(844, 44, '44-Shlok Heights-1756297172.JPG', 'Main', NULL, '2025-08-27 06:49:32', '2025-08-27 06:49:32'),
(845, 44, '44-Shlok Heights-1756297174.jpg', 'Main', NULL, '2025-08-27 06:49:34', '2025-08-27 06:49:34'),
(846, 44, '44-Shlok Heights-1756297175.jpg', 'Main', NULL, '2025-08-27 06:49:35', '2025-08-27 06:49:35'),
(847, 44, '44-Shlok Heights-1756297175.jpg', 'Main', NULL, '2025-08-27 06:49:35', '2025-08-27 06:49:35'),
(848, 44, '44-Shlok Heights-1756297176.JPG', 'Main', NULL, '2025-08-27 06:49:36', '2025-08-27 06:49:36'),
(849, 44, '44-Shlok Heights-1756297177.JPG', 'Main', NULL, '2025-08-27 06:49:37', '2025-08-27 06:49:37'),
(850, 44, '44-Shlok Heights-1756297178.JPG', 'Main', NULL, '2025-08-27 06:49:38', '2025-08-27 06:49:38'),
(851, 44, '44-Shlok Heights-1756297178.JPG', 'Main', NULL, '2025-08-27 06:49:38', '2025-08-27 06:49:38'),
(852, 44, '44-Shlok Heights-1756297179.JPG', 'Main', NULL, '2025-08-27 06:49:39', '2025-08-27 06:49:39'),
(853, 44, '44-Shlok Heights-1756297180.JPG', 'Main', NULL, '2025-08-27 06:49:40', '2025-08-27 06:49:40'),
(854, 44, '44-Shlok Heights-1756297364.JPG', 'Main', NULL, '2025-08-27 06:52:44', '2025-08-27 06:52:44'),
(855, 44, '44-Shlok Heights-1756297366.jpg', 'Main', NULL, '2025-08-27 06:52:46', '2025-08-27 06:52:46'),
(856, 44, '44-Shlok Heights-1756297367.jpg', 'Main', NULL, '2025-08-27 06:52:47', '2025-08-27 06:52:47'),
(857, 44, '44-Shlok Heights-1756297368.jpg', 'Main', NULL, '2025-08-27 06:52:48', '2025-08-27 06:52:48'),
(858, 44, '44-Shlok Heights-1756297368.JPG', 'Main', NULL, '2025-08-27 06:52:48', '2025-08-27 06:52:48'),
(859, 44, '44-Shlok Heights-1756297370.JPG', 'Main', NULL, '2025-08-27 06:52:50', '2025-08-27 06:52:50'),
(860, 44, '44-Shlok Heights-1756297371.JPG', 'Main', NULL, '2025-08-27 06:52:51', '2025-08-27 06:52:51'),
(861, 44, '44-Shlok Heights-1756297371.JPG', 'Main', NULL, '2025-08-27 06:52:51', '2025-08-27 06:52:51'),
(862, 44, '44-Shlok Heights-1756297372.JPG', 'Main', NULL, '2025-08-27 06:52:52', '2025-08-27 06:52:52'),
(863, 44, '44-Shlok Heights-1756297373.JPG', 'Main', NULL, '2025-08-27 06:52:53', '2025-08-27 06:52:53'),
(864, 44, '44-Shlok Heights-1756297592.JPG', 'Main', NULL, '2025-08-27 06:56:32', '2025-08-27 06:56:32'),
(865, 44, '44-Shlok Heights-1756297594.jpg', 'Main', NULL, '2025-08-27 06:56:34', '2025-08-27 06:56:34'),
(866, 44, '44-Shlok Heights-1756297595.jpg', 'Main', NULL, '2025-08-27 06:56:34', '2025-08-27 06:56:35'),
(867, 44, '44-Shlok Heights-1756297595.jpg', 'Main', NULL, '2025-08-27 06:56:35', '2025-08-27 06:56:35'),
(868, 44, '44-Shlok Heights-1756297596.JPG', 'Main', NULL, '2025-08-27 06:56:36', '2025-08-27 06:56:36'),
(869, 44, '44-Shlok Heights-1756297597.JPG', 'Main', NULL, '2025-08-27 06:56:37', '2025-08-27 06:56:37'),
(870, 44, '44-Shlok Heights-1756297598.JPG', 'Main', NULL, '2025-08-27 06:56:38', '2025-08-27 06:56:38'),
(871, 44, '44-Shlok Heights-1756297599.JPG', 'Main', NULL, '2025-08-27 06:56:39', '2025-08-27 06:56:39'),
(872, 44, '44-Shlok Heights-1756297599.JPG', 'Main', NULL, '2025-08-27 06:56:39', '2025-08-27 06:56:39'),
(873, 44, '44-Shlok Heights-1756297600.JPG', 'Main', NULL, '2025-08-27 06:56:40', '2025-08-27 06:56:40'),
(874, 44, '44-Shlok Heights-1756297995.JPG', 'Main', NULL, '2025-08-27 07:03:15', '2025-08-27 07:03:15'),
(875, 44, '44-Shlok Heights-1756297997.jpg', 'Main', NULL, '2025-08-27 07:03:17', '2025-08-27 07:03:17'),
(876, 44, '44-Shlok Heights-1756297998.jpg', 'Main', NULL, '2025-08-27 07:03:18', '2025-08-27 07:03:18'),
(877, 44, '44-Shlok Heights-1756297998.jpg', 'Main', NULL, '2025-08-27 07:03:18', '2025-08-27 07:03:18'),
(878, 44, '44-Shlok Heights-1756297999.JPG', 'Main', NULL, '2025-08-27 07:03:19', '2025-08-27 07:03:19'),
(879, 44, '44-Shlok Heights-1756298000.JPG', 'Main', NULL, '2025-08-27 07:03:20', '2025-08-27 07:03:20'),
(880, 44, '44-Shlok Heights-1756298001.JPG', 'Main', NULL, '2025-08-27 07:03:21', '2025-08-27 07:03:21'),
(881, 44, '44-Shlok Heights-1756298002.JPG', 'Main', NULL, '2025-08-27 07:03:22', '2025-08-27 07:03:22'),
(882, 44, '44-Shlok Heights-1756298002.JPG', 'Main', NULL, '2025-08-27 07:03:22', '2025-08-27 07:03:22'),
(883, 44, '44-Shlok Heights-1756298003.JPG', 'Main', NULL, '2025-08-27 07:03:23', '2025-08-27 07:03:23'),
(884, 44, '44-Shlok Heights-1756298109.JPG', 'Main', NULL, '2025-08-27 07:05:09', '2025-08-27 07:05:09'),
(885, 44, '44-Shlok Heights-1756298111.jpg', 'Main', NULL, '2025-08-27 07:05:11', '2025-08-27 07:05:11'),
(886, 44, '44-Shlok Heights-1756298112.jpg', 'Main', NULL, '2025-08-27 07:05:12', '2025-08-27 07:05:12'),
(887, 44, '44-Shlok Heights-1756298112.jpg', 'Main', NULL, '2025-08-27 07:05:12', '2025-08-27 07:05:12'),
(888, 44, '44-Shlok Heights-1756298113.JPG', 'Main', NULL, '2025-08-27 07:05:13', '2025-08-27 07:05:13'),
(889, 44, '44-Shlok Heights-1756298114.JPG', 'Main', NULL, '2025-08-27 07:05:14', '2025-08-27 07:05:14'),
(890, 44, '44-Shlok Heights-1756298115.JPG', 'Main', NULL, '2025-08-27 07:05:15', '2025-08-27 07:05:15'),
(891, 44, '44-Shlok Heights-1756298116.JPG', 'Main', NULL, '2025-08-27 07:05:16', '2025-08-27 07:05:16'),
(892, 44, '44-Shlok Heights-1756298116.JPG', 'Main', NULL, '2025-08-27 07:05:16', '2025-08-27 07:05:16'),
(893, 44, '44-Shlok Heights-1756298117.JPG', 'Main', NULL, '2025-08-27 07:05:17', '2025-08-27 07:05:17'),
(894, 50, '50-Global Techie Town-1756299327.JPG', 'Main', NULL, '2025-08-27 07:25:27', '2025-08-27 07:25:27'),
(895, 44, '44-Shlok Heights3-1756351500.JPG', 'Main', NULL, '2025-08-27 21:55:00', '2025-08-27 21:55:00'),
(896, 44, '44-Shlok Heights3-1756351506.jpg', 'Main', NULL, '2025-08-27 21:55:06', '2025-08-27 21:55:06'),
(897, 44, '44-Shlok Heights3-1756351506.jpg', 'Main', NULL, '2025-08-27 21:55:06', '2025-08-27 21:55:06'),
(898, 44, '44-Shlok Heights3-1756351507.jpg', 'Main', NULL, '2025-08-27 21:55:07', '2025-08-27 21:55:07'),
(899, 44, '44-Shlok Heights3-1756351508.JPG', 'Main', NULL, '2025-08-27 21:55:08', '2025-08-27 21:55:08'),
(900, 44, '44-Shlok Heights3-1756351510.JPG', 'Main', NULL, '2025-08-27 21:55:10', '2025-08-27 21:55:10'),
(901, 44, '44-Shlok Heights3-1756351511.JPG', 'Main', NULL, '2025-08-27 21:55:11', '2025-08-27 21:55:11'),
(902, 44, '44-Shlok Heights3-1756351511.JPG', 'Main', NULL, '2025-08-27 21:55:11', '2025-08-27 21:55:11'),
(903, 44, '44-Shlok Heights3-1756351512.JPG', 'Main', NULL, '2025-08-27 21:55:12', '2025-08-27 21:55:12'),
(904, 44, '44-Shlok Heights3-1756351513.JPG', 'Main', NULL, '2025-08-27 21:55:13', '2025-08-27 21:55:13'),
(905, 44, '44-Shlok Heights-1756351547.JPG', 'Main', NULL, '2025-08-27 21:55:47', '2025-08-27 21:55:47'),
(906, 44, '44-Shlok Heights-1756351549.jpg', 'Main', NULL, '2025-08-27 21:55:49', '2025-08-27 21:55:49'),
(907, 44, '44-Shlok Heights-1756351550.jpg', 'Main', NULL, '2025-08-27 21:55:50', '2025-08-27 21:55:50'),
(908, 44, '44-Shlok Heights-1756351551.jpg', 'Main', NULL, '2025-08-27 21:55:51', '2025-08-27 21:55:51'),
(909, 44, '44-Shlok Heights-1756351552.JPG', 'Main', NULL, '2025-08-27 21:55:51', '2025-08-27 21:55:52'),
(910, 44, '44-Shlok Heights-1756351553.JPG', 'Main', NULL, '2025-08-27 21:55:53', '2025-08-27 21:55:53'),
(911, 44, '44-Shlok Heights-1756351554.JPG', 'Main', NULL, '2025-08-27 21:55:54', '2025-08-27 21:55:54'),
(912, 44, '44-Shlok Heights-1756351555.JPG', 'Main', NULL, '2025-08-27 21:55:55', '2025-08-27 21:55:55'),
(913, 44, '44-Shlok Heights-1756351556.JPG', 'Main', NULL, '2025-08-27 21:55:56', '2025-08-27 21:55:56'),
(914, 44, '44-Shlok Heights-1756351557.JPG', 'Main', NULL, '2025-08-27 21:55:56', '2025-08-27 21:55:57'),
(915, 44, '44-Shlok Heights 55-1756351655.JPG', 'Main', NULL, '2025-08-27 21:57:35', '2025-08-27 21:57:35'),
(916, 44, '44-Shlok Heights 55-1756351657.jpg', 'Main', NULL, '2025-08-27 21:57:37', '2025-08-27 21:57:37'),
(917, 44, '44-Shlok Heights 55-1756351658.jpg', 'Main', NULL, '2025-08-27 21:57:38', '2025-08-27 21:57:38'),
(918, 44, '44-Shlok Heights 55-1756351658.jpg', 'Main', NULL, '2025-08-27 21:57:38', '2025-08-27 21:57:38'),
(919, 44, '44-Shlok Heights 55-1756351659.JPG', 'Main', NULL, '2025-08-27 21:57:39', '2025-08-27 21:57:39'),
(920, 44, '44-Shlok Heights 55-1756351660.JPG', 'Main', NULL, '2025-08-27 21:57:40', '2025-08-27 21:57:40'),
(921, 44, '44-Shlok Heights 55-1756351661.JPG', 'Main', NULL, '2025-08-27 21:57:41', '2025-08-27 21:57:41'),
(922, 44, '44-Shlok Heights 55-1756351662.JPG', 'Main', NULL, '2025-08-27 21:57:42', '2025-08-27 21:57:42'),
(923, 44, '44-Shlok Heights 55-1756351662.JPG', 'Main', NULL, '2025-08-27 21:57:42', '2025-08-27 21:57:42'),
(924, 44, '44-Shlok Heights 55-1756351663.JPG', 'Main', NULL, '2025-08-27 21:57:43', '2025-08-27 21:57:43'),
(925, 44, '44-Shlok Heights 55-1756352017.JPG', 'Main', NULL, '2025-08-27 22:03:37', '2025-08-27 22:03:37'),
(926, 44, '44-Shlok Heights 55-1756352019.jpg', 'Main', NULL, '2025-08-27 22:03:39', '2025-08-27 22:03:39'),
(927, 44, '44-Shlok Heights 55-1756352020.jpg', 'Main', NULL, '2025-08-27 22:03:40', '2025-08-27 22:03:40'),
(928, 44, '44-Shlok Heights 55-1756352021.jpg', 'Main', NULL, '2025-08-27 22:03:41', '2025-08-27 22:03:41'),
(929, 44, '44-Shlok Heights 55-1756352021.JPG', 'Main', NULL, '2025-08-27 22:03:41', '2025-08-27 22:03:41'),
(930, 44, '44-Shlok Heights 55-1756352023.JPG', 'Main', NULL, '2025-08-27 22:03:43', '2025-08-27 22:03:43'),
(931, 44, '44-Shlok Heights 55-1756352024.JPG', 'Main', NULL, '2025-08-27 22:03:44', '2025-08-27 22:03:44'),
(932, 44, '44-Shlok Heights 55-1756352025.JPG', 'Main', NULL, '2025-08-27 22:03:45', '2025-08-27 22:03:45'),
(933, 44, '44-Shlok Heights 55-1756352025.JPG', 'Main', NULL, '2025-08-27 22:03:45', '2025-08-27 22:03:45'),
(934, 44, '44-Shlok Heights 55-1756352026.JPG', 'Main', NULL, '2025-08-27 22:03:46', '2025-08-27 22:03:46'),
(935, 44, '44-Shlok Heights 55-1756352129.JPG', 'Main', NULL, '2025-08-27 22:05:29', '2025-08-27 22:05:29'),
(936, 44, '44-Shlok Heights 55-1756352131.jpg', 'Main', NULL, '2025-08-27 22:05:31', '2025-08-27 22:05:31'),
(937, 44, '44-Shlok Heights 55-1756352132.jpg', 'Main', NULL, '2025-08-27 22:05:32', '2025-08-27 22:05:32'),
(938, 44, '44-Shlok Heights 55-1756352133.jpg', 'Main', NULL, '2025-08-27 22:05:32', '2025-08-27 22:05:33'),
(939, 44, '44-Shlok Heights 55-1756352133.JPG', 'Main', NULL, '2025-08-27 22:05:33', '2025-08-27 22:05:33'),
(940, 44, '44-Shlok Heights 55-1756352135.JPG', 'Main', NULL, '2025-08-27 22:05:35', '2025-08-27 22:05:35'),
(941, 44, '44-Shlok Heights 55-1756352135.JPG', 'Main', NULL, '2025-08-27 22:05:35', '2025-08-27 22:05:35'),
(942, 44, '44-Shlok Heights 55-1756352136.JPG', 'Main', NULL, '2025-08-27 22:05:36', '2025-08-27 22:05:36'),
(943, 44, '44-Shlok Heights 55-1756352137.JPG', 'Main', NULL, '2025-08-27 22:05:37', '2025-08-27 22:05:37'),
(944, 44, '44-Shlok Heights 55-1756352137.JPG', 'Main', NULL, '2025-08-27 22:05:37', '2025-08-27 22:05:37'),
(945, 44, '44-Shlok Heights 55-1756352215.JPG', 'Main', NULL, '2025-08-27 22:06:55', '2025-08-27 22:06:55'),
(946, 44, '44-Shlok Heights 55-1756352217.jpg', 'Main', NULL, '2025-08-27 22:06:57', '2025-08-27 22:06:57'),
(947, 44, '44-Shlok Heights 55-1756352218.jpg', 'Main', NULL, '2025-08-27 22:06:58', '2025-08-27 22:06:58'),
(948, 44, '44-Shlok Heights 55-1756352218.jpg', 'Main', NULL, '2025-08-27 22:06:58', '2025-08-27 22:06:58'),
(949, 44, '44-Shlok Heights 55-1756352219.JPG', 'Main', NULL, '2025-08-27 22:06:59', '2025-08-27 22:06:59'),
(950, 44, '44-Shlok Heights 55-1756352221.JPG', 'Main', NULL, '2025-08-27 22:07:01', '2025-08-27 22:07:01'),
(951, 44, '44-Shlok Heights 55-1756352221.JPG', 'Main', NULL, '2025-08-27 22:07:01', '2025-08-27 22:07:01'),
(952, 44, '44-Shlok Heights 55-1756352222.JPG', 'Main', NULL, '2025-08-27 22:07:02', '2025-08-27 22:07:02'),
(953, 44, '44-Shlok Heights 55-1756352222.JPG', 'Main', NULL, '2025-08-27 22:07:02', '2025-08-27 22:07:02'),
(954, 44, '44-Shlok Heights 55-1756352223.JPG', 'Main', NULL, '2025-08-27 22:07:03', '2025-08-27 22:07:03'),
(955, 44, '44-Shlok Heights-1756352301.JPG', 'Main', NULL, '2025-08-27 22:08:21', '2025-08-27 22:08:21'),
(956, 44, '44-Shlok Heights-1756352303.jpg', 'Main', NULL, '2025-08-27 22:08:23', '2025-08-27 22:08:23'),
(957, 44, '44-Shlok Heights-1756352304.jpg', 'Main', NULL, '2025-08-27 22:08:23', '2025-08-27 22:08:24'),
(958, 44, '44-Shlok Heights-1756352304.jpg', 'Main', NULL, '2025-08-27 22:08:24', '2025-08-27 22:08:24'),
(959, 44, '44-Shlok Heights-1756352305.JPG', 'Main', NULL, '2025-08-27 22:08:25', '2025-08-27 22:08:25'),
(960, 44, '44-Shlok Heights-1756352306.JPG', 'Main', NULL, '2025-08-27 22:08:26', '2025-08-27 22:08:26'),
(961, 44, '44-Shlok Heights-1756352307.JPG', 'Main', NULL, '2025-08-27 22:08:27', '2025-08-27 22:08:27'),
(962, 44, '44-Shlok Heights-1756352307.JPG', 'Main', NULL, '2025-08-27 22:08:27', '2025-08-27 22:08:27'),
(963, 44, '44-Shlok Heights-1756352308.JPG', 'Main', NULL, '2025-08-27 22:08:28', '2025-08-27 22:08:28'),
(964, 44, '44-Shlok Heights-1756352309.JPG', 'Main', NULL, '2025-08-27 22:08:29', '2025-08-27 22:08:29'),
(965, 44, '44-Shlok Heights-1756352322.JPG', 'Main', NULL, '2025-08-27 22:08:42', '2025-08-27 22:08:42'),
(966, 44, '44-Shlok Heights-1756352324.jpg', 'Main', NULL, '2025-08-27 22:08:44', '2025-08-27 22:08:44'),
(967, 44, '44-Shlok Heights-1756352325.jpg', 'Main', NULL, '2025-08-27 22:08:45', '2025-08-27 22:08:45'),
(968, 44, '44-Shlok Heights-1756352325.jpg', 'Main', NULL, '2025-08-27 22:08:45', '2025-08-27 22:08:45'),
(969, 44, '44-Shlok Heights-1756352326.JPG', 'Main', NULL, '2025-08-27 22:08:46', '2025-08-27 22:08:46'),
(970, 44, '44-Shlok Heights-1756352327.JPG', 'Main', NULL, '2025-08-27 22:08:47', '2025-08-27 22:08:47'),
(971, 44, '44-Shlok Heights-1756352328.JPG', 'Main', NULL, '2025-08-27 22:08:48', '2025-08-27 22:08:48'),
(972, 44, '44-Shlok Heights-1756352329.JPG', 'Main', NULL, '2025-08-27 22:08:49', '2025-08-27 22:08:49'),
(973, 44, '44-Shlok Heights-1756352329.JPG', 'Main', NULL, '2025-08-27 22:08:49', '2025-08-27 22:08:49'),
(974, 44, '44-Shlok Heights-1756352330.JPG', 'Main', NULL, '2025-08-27 22:08:50', '2025-08-27 22:08:50'),
(975, 44, '44-Shlok Heights-1756352368.JPG', 'Main', NULL, '2025-08-27 22:09:28', '2025-08-27 22:09:28'),
(976, 44, '44-Shlok Heights-1756352370.jpg', 'Main', NULL, '2025-08-27 22:09:30', '2025-08-27 22:09:30'),
(977, 44, '44-Shlok Heights-1756352370.jpg', 'Main', NULL, '2025-08-27 22:09:30', '2025-08-27 22:09:30'),
(978, 44, '44-Shlok Heights-1756352371.jpg', 'Main', NULL, '2025-08-27 22:09:31', '2025-08-27 22:09:31'),
(979, 44, '44-Shlok Heights-1756352371.JPG', 'Main', NULL, '2025-08-27 22:09:31', '2025-08-27 22:09:31'),
(980, 44, '44-Shlok Heights-1756352373.JPG', 'Main', NULL, '2025-08-27 22:09:33', '2025-08-27 22:09:33'),
(981, 44, '44-Shlok Heights-1756352374.JPG', 'Main', NULL, '2025-08-27 22:09:34', '2025-08-27 22:09:34'),
(982, 44, '44-Shlok Heights-1756352374.JPG', 'Main', NULL, '2025-08-27 22:09:34', '2025-08-27 22:09:34'),
(983, 44, '44-Shlok Heights-1756352375.JPG', 'Main', NULL, '2025-08-27 22:09:35', '2025-08-27 22:09:35'),
(984, 44, '44-Shlok Heights-1756360554.JPG', 'Main', NULL, '2025-08-28 00:25:54', '2025-08-28 00:25:54'),
(985, 44, '44-Shlok Heights-1756360557.jpg', 'Main', NULL, '2025-08-28 00:25:57', '2025-08-28 00:25:57'),
(986, 44, '44-Shlok Heights-1756360557.jpg', 'Main', NULL, '2025-08-28 00:25:57', '2025-08-28 00:25:57'),
(987, 44, '44-Shlok Heights-1756360558.jpg', 'Main', NULL, '2025-08-28 00:25:58', '2025-08-28 00:25:58'),
(988, 44, '44-Shlok Heights-1756360559.JPG', 'Main', NULL, '2025-08-28 00:25:59', '2025-08-28 00:25:59'),
(989, 44, '44-Shlok Heights-1756360561.JPG', 'Main', NULL, '2025-08-28 00:26:01', '2025-08-28 00:26:01'),
(990, 44, '44-Shlok Heights-1756360561.JPG', 'Main', NULL, '2025-08-28 00:26:01', '2025-08-28 00:26:01'),
(991, 44, '44-Shlok Heights-1756360562.JPG', 'Main', NULL, '2025-08-28 00:26:02', '2025-08-28 00:26:02'),
(992, 44, '44-Shlok Heights-1756360563.JPG', 'Main', NULL, '2025-08-28 00:26:03', '2025-08-28 00:26:03'),
(993, 61, '61-Dharti Exotica-1756361529.JPG', 'Main', NULL, '2025-08-28 00:42:09', '2025-08-28 00:42:09'),
(994, 61, '61-Dharti Exotica-1756361530.JPG', 'Elevation', NULL, '2025-08-28 00:42:10', '2025-08-28 00:42:10'),
(995, 61, '61-Dharti Exotica-1756361532.JPG', 'Bedroom', NULL, '2025-08-28 00:42:12', '2025-08-28 00:42:12'),
(996, 61, '61-Dharti Exotica-1756361533.JPG', 'Living', NULL, '2025-08-28 00:42:13', '2025-08-28 00:42:13'),
(997, 61, '61-Dharti Exotica-1756361535.JPG', 'Balcony', NULL, '2025-08-28 00:42:15', '2025-08-28 00:42:15'),
(998, 61, '61-Dharti Exotica-1756361537.JPG', 'Amenities', NULL, '2025-08-28 00:42:17', '2025-08-28 00:42:17'),
(999, 61, '61-Dharti Exotica-1756361539.JPG', 'Floor', NULL, '2025-08-28 00:42:19', '2025-08-28 00:42:19'),
(1000, 61, '61-Dharti Exotica-1756361541.JPG', 'Location', NULL, '2025-08-28 00:42:21', '2025-08-28 00:42:21');

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
(45, 44, 2, '2025-08-18 06:08:57', '2025-08-18 06:08:57'),
(50, 53, 3, '2025-08-18 07:43:37', '2025-08-18 07:43:37'),
(51, 44, 1, '2025-08-18 07:47:19', '2025-08-18 07:47:19'),
(52, 55, 3, '2025-08-18 08:11:46', '2025-08-18 08:11:46'),
(53, 44, 3, '2025-08-18 08:17:26', '2025-08-18 08:17:26'),
(54, 50, 3, '2025-08-18 08:17:26', '2025-08-18 08:17:26'),
(55, 50, 2, '2025-08-18 08:17:26', '2025-08-18 08:17:26');

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
(184, '1755169007.png', '2025-08-14 05:26:47', '2025-08-14 05:26:47'),
(185, '1755939029.png', '2025-08-23 03:20:29', '2025-08-23 03:20:29'),
(186, '1755939230.png', '2025-08-23 03:23:50', '2025-08-23 03:23:50'),
(187, '1755939241.png', '2025-08-23 03:24:01', '2025-08-23 03:24:01'),
(188, '1755939326.png', '2025-08-23 03:25:26', '2025-08-23 03:25:26'),
(189, '1755939332.png', '2025-08-23 03:25:32', '2025-08-23 03:25:32'),
(190, '1755953102.jpeg', '2025-08-23 07:15:02', '2025-08-23 07:15:02'),
(191, '1755953525.jpeg', '2025-08-23 07:22:05', '2025-08-23 07:22:05'),
(192, '1756361489.JPG', '2025-08-28 00:41:29', '2025-08-28 00:41:29'),
(193, '1756361491.JPG', '2025-08-28 00:41:31', '2025-08-28 00:41:31'),
(194, '1756361494.JPG', '2025-08-28 00:41:34', '2025-08-28 00:41:34'),
(195, '1756361496.JPG', '2025-08-28 00:41:36', '2025-08-28 00:41:36'),
(196, '1756361499.JPG', '2025-08-28 00:41:39', '2025-08-28 00:41:39'),
(197, '1756361501.JPG', '2025-08-28 00:41:41', '2025-08-28 00:41:41'),
(198, '1756361503.JPG', '2025-08-28 00:41:43', '2025-08-28 00:41:43'),
(199, '1756361504.JPG', '2025-08-28 00:41:44', '2025-08-28 00:41:44');

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
(1, 'Mukesh Bhavsar', 'mukeshbhavsar210@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '1-1755756872.jpeg', '9978835005', 'admin', 1, NULL, '2024-12-28 05:49:21', '2025-08-21 00:44:32'),
(2, 'Sona Bhavsar', 'sona@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '', '9978835005', 'user', 1, NULL, '2024-12-28 05:49:21', '2025-01-10 23:42:25'),
(3, 'Dhruv Bhavsar', 'dhruvbhavsar210@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '1-1755756872.jpeg', '9916235005', 'builder', 1, NULL, '2024-12-28 05:49:21', '2025-01-10 23:42:25'),
(4, 'Gaurav', 'gaurav@gmail.com', NULL, '$2y$12$1SpADjHEpzBJ2OTXEQkwd.GNrM1Hrn.vGo7NyPsqXiaYBGTZwj3.C', '4-1736168601.png', '9978812345', 'builder', 1, NULL, '2024-12-28 05:51:32', '2025-01-06 07:33:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_city_id_foreign` (`city_id`);

--
-- Indexes for table `builders`
--
ALTER TABLE `builders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `developers_property_id_foreign` (`property_id`),
  ADD KEY `builders_user_id_foreign` (`user_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
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
  ADD KEY `properties_city_id_foreign` (`city_id`),
  ADD KEY `properties_area_id_foreign` (`area_id`),
  ADD KEY `properties_view_id_foreign` (`view_id`) USING BTREE,
  ADD KEY `properties_builder_id_foreign` (`builder_id`);

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
  ADD KEY `product_images_product_id_foreign` (`property_id`) USING BTREE;

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `builders`
--
ALTER TABLE `builders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `property_applications`
--
ALTER TABLE `property_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `saved_properties`
--
ALTER TABLE `saved_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `builders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `developers_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_builder_id_foreign` FOREIGN KEY (`builder_id`) REFERENCES `builders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_facing_id_foreign` FOREIGN KEY (`view_id`) REFERENCES `views` (`id`) ON DELETE CASCADE,
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
