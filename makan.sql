-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2025 at 03:20 PM
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
  `developer_name` varchar(255) NOT NULL,
  `related_properties` longtext DEFAULT NULL,
  `developer_email` varchar(255) DEFAULT NULL,
  `developer_landline` varchar(255) DEFAULT NULL,
  `developer_mobile` varchar(255) DEFAULT NULL,
  `developer_whatsapp` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `builders`
--

INSERT INTO `builders` (`id`, `developer_name`, `related_properties`, `developer_email`, `developer_landline`, `developer_mobile`, `developer_whatsapp`, `image`, `address`, `property_id`, `created_at`, `updated_at`, `user_id`) VALUES
(34, 'Keerthi Estate', '46,44', 'keerthi@gmail.com', '9999911111', '9999911111', '9999911111', '3-1756536979.png', 'Hyderabad, India', NULL, '2025-01-04 03:58:23', '2025-08-30 01:26:19', 4),
(42, 'Dobariya & Company', '46,44', 'info@dobariya.com', '089-1234567', '9978812345', '9978812345', '41_Sanghani Infrastructure.png', 'Vejalpur', NULL, '2025-01-10 23:28:06', '2025-08-14 05:23:53', 2),
(43, 'Swastik Group', '46,44', 'info@dobariya.com', '089-1234567', '9978812345', '9978812345', '41_Sanghani Infrastructure.png', 'Vejalpur', NULL, '2025-01-10 23:28:06', '2025-08-14 05:23:53', 3);

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
(59, '2025_08_28_082917_add_builder_id_to_propeties_table', 51),
(60, '2025_09_01_085703_create_visited_properties_table', 52),
(61, '2025_09_02_123106_add_property_id_to_temp_images_table', 53);

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
  `rooms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '2_bhks',
  `bathrooms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '2_baths',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `builder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `property_age` enum('1_year','3_years','5_years','6_years') DEFAULT '1_year',
  `facings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'east',
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `view_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `rera` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `year_build` text DEFAULT NULL,
  `total_area` varchar(50) DEFAULT NULL,
  `towers` int(20) DEFAULT 1,
  `units` int(20) DEFAULT 1,
  `related_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `amenities` longtext DEFAULT NULL,
  `possession_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `slug`, `category`, `property_types`, `sale_types`, `construction_types`, `rooms`, `bathrooms`, `user_id`, `builder_id`, `property_age`, `facings`, `city_id`, `area_id`, `view_id`, `description`, `keywords`, `location`, `rera`, `year_build`, `total_area`, `towers`, `units`, `related_properties`, `amenities`, `possession_date`, `status`, `created_at`, `updated_at`, `is_featured`) VALUES
(44, 'Shlok Heights', 'shlok-heights', 'buy', '[\"apartment\",\"plot\"]', 'resale', 'under', '[{\"id\":1,\"title\":\"4_bhk\",\"price\":\"7500000\",\"size\":\"1200\"},{\"id\":2,\"title\":\"5_bhk\",\"price\":\"9500000\",\"size\":\"1500\"}]', '[\"2_baths\",\"3_baths\"]', 1, 34, '6_years', '[\"north\",\"south\"]', 1, 1, NULL, 'Shlok Heights', '3 BHK Apartment', 'Mansarovar Road', '13', NULL, '13', NULL, NULL, '[\"51\",\"53\",\"55\"]', '[]', '2025-12-31', 1, '2025-01-06 05:12:07', '2025-09-01 03:18:36', 'Yes'),
(57, 'Navami Funique', 'navami-funique', 'rent', '[]', 'new', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"7500000\",\"size\":\"1000\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"9500000\",\"size\":\"1500\"}]', '[]', 3, 43, '1_year', '[]', 1, 1, NULL, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', NULL, NULL, NULL, 5, 300, '[]', '[]', NULL, 1, '2025-08-16 05:12:07', '2025-09-01 01:46:49', 'Yes'),
(63, 'Shlok 99 - Gota', 'shlok-99-gota', 'buy', '[\"apartment\"]', 'resale', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"7500000\",\"size\":\"1200\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"9500000\",\"size\":\"1500\"}]', '[\"2_baths\",\"3_baths\",\"4_baths\"]', 1, 34, '6_years', '[\"north\",\"south\"]', 1, 20, NULL, 'Shlok Heights', '3 BHK Apartment', 'Mansarovar Road', '13', NULL, '13', NULL, NULL, '[\"51\",\"53\",\"55\"]', '[]', '2025-12-31', 1, '2025-01-06 05:12:07', '2025-09-01 03:18:36', 'Yes'),
(64, 'Om Elegance', 'om-elegance', 'buy', '[\"apartment\"]', 'resale', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"7500000\",\"size\":\"1200\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"9500000\",\"size\":\"1500\"}]', '[\"2_baths\",\"3_baths\",\"4_baths\"]', 1, 34, '6_years', '[\"north\",\"south\"]', 1, 1, NULL, 'Shlok Heights', '3 BHK Apartment', 'Mansarovar Road', '13', NULL, '13', NULL, NULL, '[\"51\",\"53\",\"55\"]', '[]', '2025-12-31', 1, '2025-01-06 05:12:07', '2025-09-01 03:18:36', 'Yes'),
(65, 'Swastik Marvella', 'swastik-marvella', 'buy', '[\"apartment\"]', 'resale', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"7500000\",\"size\":\"1200\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"9500000\",\"size\":\"1500\"}]', '[\"2_baths\",\"3_baths\",\"4_baths\"]', 3, 42, '6_years', '[\"north\",\"south\"]', 1, 1, NULL, 'Shlok Heights', '3 BHK Apartment', 'Mansarovar Road', '13', NULL, '13', NULL, NULL, '[\"51\",\"53\",\"55\"]', '[]', '2025-12-31', 1, '2025-01-06 05:12:07', '2025-09-01 03:18:36', 'Yes'),
(76, 'Samarthya Status', 'samarthya-status', 'buy', '[\"apartment\"]', 'new', 'under', '[{\"id\":1,\"title\":\"1_bhk\",\"price\":\"\",\"size\":\"\"},{\"id\":2,\"title\":\"2_bhk\",\"price\":\"\",\"size\":\"\"}]', '[\"1_bath\",\"2_baths\"]', 1, 42, '1_year', '[\"east\"]', 1, 1, NULL, 'test', '3 BHK Apartment', 'Mansarovar Road', 'Yes', '200', '124567', 5, 300, '[\"44\",\"57\"]', '[\"3\"]', NULL, 1, '2025-09-02 06:39:16', '2025-09-02 07:33:30', 'Yes'),
(84, 'testing 112', 'testing-112', 'buy', '[]', 'new', 'under', '[]', '[]', 1, 42, '1_year', '[]', 1, 19, NULL, 'test', '3 BHK Apartment', 'Mansarovar Road', NULL, NULL, NULL, NULL, NULL, '[\"44\"]', '[]', NULL, 1, '2025-09-02 07:40:15', '2025-09-02 07:40:15', 'Yes'),
(85, 'testes', 'testes', 'buy', '[]', 'new', 'under', '[]', '[]', 1, 42, '1_year', '[]', 1, 11, NULL, 'etst', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[\"44\"]', '[]', NULL, 1, '2025-09-02 07:49:04', '2025-09-02 07:49:04', 'Yes');

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
(118, 44, 3, '2025-09-01 07:53:39', '2025-09-01 07:53:39');

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
(264, '1756819103.JPG', '2025-09-02 07:48:23', '2025-09-02 07:48:23'),
(265, '1756819105.JPG', '2025-09-02 07:48:25', '2025-09-02 07:48:25'),
(266, '1756819108.JPG', '2025-09-02 07:48:28', '2025-09-02 07:48:28'),
(267, '1756819110.JPG', '2025-09-02 07:48:30', '2025-09-02 07:48:30');

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
  `role` enum('Admin','User','Builder') NOT NULL DEFAULT 'User',
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `mobile`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mukesh Bhavsar', 'mukeshbhavsar210@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '1-1756555979.webp', '9978835005', 'Admin', 1, NULL, '2024-12-28 05:49:21', '2025-08-30 06:43:00'),
(2, 'Sona Bhavsar', 'sona@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '', '9978835005', 'User', 1, NULL, '2024-12-28 05:49:21', '2025-01-10 23:42:25'),
(3, 'Dhruv Bhavsar', 'dhruvbhavsar210@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '3-1756448900.JPG', '9916235005', 'User', 1, NULL, '2024-12-28 05:49:21', '2025-08-29 07:00:36'),
(4, 'Gaurav', 'gaurav@gmail.com', NULL, '$2y$12$1SpADjHEpzBJ2OTXEQkwd.GNrM1Hrn.vGo7NyPsqXiaYBGTZwj3.C', '4-1736168601.png', '9978812345', 'Builder', 1, NULL, '2024-12-28 05:51:32', '2025-01-06 07:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `visited_properties`
--

CREATE TABLE `visited_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visited_properties`
--

INSERT INTO `visited_properties` (`id`, `property_id`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 44, 1, '2025-09-01 04:01:29', '2025-09-01 04:01:29'),
(10, 44, 3, '2025-09-01 04:02:29', '2025-09-01 04:02:29'),
(14, 57, 3, '2025-09-01 07:52:31', '2025-09-01 07:52:31'),
(15, 44, NULL, '2025-09-01 08:26:37', '2025-09-01 08:26:37'),
(16, 63, NULL, '2025-09-01 08:28:33', '2025-09-01 08:28:33'),
(18, 64, NULL, '2025-09-01 08:30:26', '2025-09-01 08:30:26'),
(20, 65, NULL, '2025-09-01 08:33:12', '2025-09-01 08:33:12'),
(21, 63, 3, '2025-09-01 23:28:50', '2025-09-01 23:28:50');

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
-- Indexes for table `visited_properties`
--
ALTER TABLE `visited_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visited_properties_property_id_foreign` (`property_id`),
  ADD KEY `visited_properties_user_id_foreign` (`user_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `property_applications`
--
ALTER TABLE `property_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1083;

--
-- AUTO_INCREMENT for table `saved_properties`
--
ALTER TABLE `saved_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visited_properties`
--
ALTER TABLE `visited_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  ADD CONSTRAINT `properties_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `visited_properties`
--
ALTER TABLE `visited_properties`
  ADD CONSTRAINT `visited_properties_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visited_properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
