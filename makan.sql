-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2025 at 01:53 PM
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
(18, 'Nikol', 'nikol', 1, 1, '2025-08-21 00:45:49', '2025-08-21 00:45:49'),
(19, 'Gota', 'gota', 1, 1, '2025-08-21 00:46:32', '2025-08-21 00:46:32'),
(20, 'Vastral', 'vastral', 1, 1, '2025-08-21 00:58:08', '2025-08-21 00:58:08'),
(23, 'Shilaj', 'shilaj', 1, 1, '2025-09-11 02:57:24', '2025-09-11 02:57:24');

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
  `estd` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `builders`
--

INSERT INTO `builders` (`id`, `developer_name`, `related_properties`, `developer_email`, `developer_landline`, `developer_mobile`, `developer_whatsapp`, `estd`, `image`, `address`, `about`, `property_id`, `created_at`, `updated_at`, `user_id`) VALUES
(34, 'Keerthi Estate', '46,44', 'keerthi@gmail.com', '9999911111', '9999911111', '9999911111', '2000', '3-swastik-group-1756906031.png', 'Hyderabad, India', NULL, NULL, '2025-01-04 03:58:23', '2025-08-30 01:26:19', 4),
(42, 'Dobariya & Company', '46,44', 'info@dobariya.com', '089-1234567', '9978812345', '9978812345', '2010', '41_Sanghani Infrastructure.png', 'Vejalpur', 'Dobariya Group is among the most renowned name in Real Estate. It is backed by professional team which provide good and luxurious homes to their entire clientele. They put in their maximum efforts to place their delivery of construction on time and have always been succ', NULL, '2025-01-10 23:28:06', '2025-08-14 05:23:53', 2),
(43, 'Swastik Group', '46,44', 'info@dobariya.com', '089-1234567', '9978812345', '9978812345', '2020', '3-swastik-group-1756906031.png', 'Vejalpur', 'Swastik Group is among the most renowned name in Real Estate. It is backed by professional team which provide good and luxurious homes to their entire clientele. They put in their maximum efforts to place their delivery of construction on time and have always been succ', NULL, '2025-01-10 23:28:06', '2025-09-03 07:57:11', 3);

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
(61, '2025_09_02_123106_add_property_id_to_temp_images_table', 53),
(62, '2025_09_03_095244_create_building_images_table', 54),
(63, '2025_09_03_100520_create_property_images_table', 55),
(64, '2025_09_12_050141_create_plans_table', 56),
(65, '2025_09_12_051730_add_construction_id_to_properties_table', 57),
(66, '2025_09_12_052856_create_plans_table', 58),
(67, '2025_09_12_053803_create_plans_table', 59),
(68, '2025_09_12_090839_create_orders_table', 60);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `razorpay_order_id` varchar(255) DEFAULT NULL,
  `razorpay_payment_id` varchar(255) DEFAULT NULL,
  `razorpay_signature` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `property_id`, `plan_id`, `razorpay_order_id`, `razorpay_payment_id`, `razorpay_signature`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(5, 125, 2, 'order_RGhjK4UQ1Y74J6', 'pay_RGhjYEH2AIciYB', 'b10c386595bd4abe22ba5ed813e8ae56df3463c70d69c12828717c7758fdc7dc', 299.00, 'paid', '2025-09-12 07:49:41', '2025-09-12 07:50:06'),
(11, 132, 2, 'order_RGxSGJz6irefJ3', 'pay_RGxSL4b1ykqrlg', '344bbd01b9e16a5c1b0687e1d5a75a0f942de6c78e4e5fa9ca3abde739b9f4d5', 299.00, 'paid', '2025-09-12 23:12:37', '2025-09-12 23:12:55'),
(14, 135, 2, 'order_RH5fNrpJAZlzXn', 'pay_RH5fTFZAPnuTuy', '77cdbe8964fd6868fd393a54585faec08e42e30d9ff9938c83b3bb44ea8356ed', 299.00, 'paid', '2025-09-13 07:14:35', '2025-09-13 07:14:55'),
(15, 136, 2, 'order_RHP34ViUjhGZmq', 'pay_RHP3IhNwxGhfnH', '461c56c59b7528375410c0155c76250cdf5ea1767f0e8700a07334a52853a2a3', 299.00, 'paid', '2025-09-14 02:12:12', '2025-09-14 02:12:37');

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
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duration` int(100) DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `duration`, `features`, `created_at`, `updated_at`) VALUES
(1, 'Free', 0.00, 30, '[\"Basic Listing\",\"30 days visibility\",\"Standard Support\"]', NULL, NULL),
(2, 'Gold', 299.00, 60, '[\"Highlighted Listing\",\"60 days visibility\",\"Priority Support\",\"Top search placement\"]', NULL, NULL),
(3, 'Diamond', 499.00, 90, '[\"Premium Listing\",\"90 days visibility\",\"Dedicated Support\",\"Top search placement\",\"Feature Highlight\"]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `residence_types` enum('residential','commercial') NOT NULL DEFAULT 'residential',
  `property_types` varchar(100) NOT NULL DEFAULT 'apartment',
  `category` enum('buy','rent') DEFAULT 'buy',
  `furnish_types` enum('fully_furnished','semi_furnished','unfurnished') NOT NULL DEFAULT 'unfurnished',
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
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `rent` int(20) DEFAULT NULL,
  `available` date DEFAULT NULL,
  `deposit` int(20) DEFAULT NULL,
  `rera` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `year_build` text DEFAULT NULL,
  `total_area` varchar(50) DEFAULT NULL,
  `towers` int(20) DEFAULT 1,
  `units` int(20) DEFAULT 1,
  `related_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `amenities` longtext DEFAULT NULL,
  `furnishing` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`furnishing`)),
  `possession_date` date DEFAULT NULL,
  `brokerage` int(11) NOT NULL DEFAULT 0,
  `verification` enum('approved','pending','expired') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `plan_id`, `start_date`, `end_date`, `slug`, `residence_types`, `property_types`, `category`, `furnish_types`, `sale_types`, `construction_types`, `rooms`, `bathrooms`, `user_id`, `builder_id`, `property_age`, `facings`, `city_id`, `area_id`, `description`, `keywords`, `location`, `rent`, `available`, `deposit`, `rera`, `year_build`, `total_area`, `towers`, `units`, `related_properties`, `amenities`, `furnishing`, `possession_date`, `brokerage`, `verification`, `created_at`, `updated_at`) VALUES
(44, 'Shlok Heights', 3, NULL, NULL, 'shlok-heights', 'residential', 'studio', 'buy', 'unfurnished', 'resale', 'under', '[{\"id\":1,\"title\":\"4_bhk\",\"price\":\"7500000\",\"size\":\"1200\"},{\"id\":2,\"title\":\"5_bhk\",\"price\":\"9500000\",\"size\":\"1500\"}]', '[\"2_baths\",\"3_baths\"]', 2, 34, '6_years', '[\"north\",\"south\"]', 1, 1, 'Shlok Heights', '3 BHK Apartment', 'Mansarovar Road', NULL, NULL, NULL, '13', NULL, '13', NULL, NULL, '[\"51\",\"53\",\"55\"]', '[]', NULL, '2025-12-31', 1, 'approved', '2025-01-06 05:12:07', '2025-09-14 01:59:48'),
(57, 'Navami Funique', 2, NULL, NULL, 'navami-funique', 'residential', 'apartment', 'rent', 'unfurnished', 'new', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"1500000\",\"size\":\"2000\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"2500000\",\"size\":\"3000\"}]', '[]', 2, 43, '1_year', '[]', 1, 1, 'Shlok Heights', '3 BHK Apartment', 'Ahmedabad', NULL, NULL, NULL, NULL, NULL, NULL, 5, 300, '[]', '[]', NULL, NULL, 0, 'approved', '2025-08-16 05:12:07', '2025-09-14 02:08:50'),
(64, 'Om Elegance', 2, NULL, NULL, 'om-elegance', 'residential', 'apartment', 'buy', 'unfurnished', 'resale', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"7500000\",\"size\":\"1200\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"9500000\",\"size\":\"1500\"}]', '[\"2_baths\",\"3_baths\",\"4_baths\"]', 3, 42, '6_years', '[\"north\",\"south\"]', 1, 1, 'Shlok Heights', '3 BHK Apartment', 'Mansarovar Road', NULL, NULL, NULL, '13', NULL, '13', NULL, NULL, '[\"51\",\"53\",\"55\"]', '[]', NULL, '2025-12-31', 0, 'approved', '2025-01-06 05:12:07', '2025-09-14 02:10:44'),
(65, 'Swastik Marvella', 3, NULL, NULL, 'swastik-marvella', 'commercial', 'retail_shop', 'buy', 'fully_furnished', 'resale', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"6350000\",\"size\":\"1200\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"7810000\",\"size\":\"1500\"}]', '[\"3_baths\"]', 3, 34, '6_years', '[\"north\",\"south\"]', 1, 1, 'Shlok Heights', '3 BHK Apartment', 'Mansarovar Road', NULL, NULL, NULL, '13', NULL, '13', 5, 400, '[\"44\",\"57\",\"63\",\"64\",\"110\"]', '[\"gated_community\",\"lift\"]', NULL, '2025-12-31', 1, 'approved', '2025-01-06 05:12:07', '2025-09-14 01:26:37'),
(110, 'Nilyam Parmeshwar', 3, NULL, NULL, 'nilyam-parmeshwar', 'residential', 'plot', 'buy', 'unfurnished', 'resale', 'ready', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"6500000\",\"size\":\"1200\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"1200000\",\"size\":\"100\"},\r\n{\"id\":3,\"title\":\"4_bhk\",\"price\":\"9000000\",\"size\":\"1000\"}]', '[\"3_baths\"]', 1, 34, '5_years', '[\"east\"]', 1, 1, 'test 333', 'hellow', 'IOC Road', NULL, NULL, NULL, 'hellow 2', '2', '5800', 5, 300, '[\"44\"]', '[\"gated_community\",\"lift\",\"swimming_pool\",\"gym\",\"security\",\"parking\",\"gas_pipeline\",\"play_area\",\"waste_management\",\"surveillance\",\"fire\",\"electrification\",\"water\",\"jogging\"]', '[\"gated_community\",\"lift\",\"swimming_pool\",\"gym\",\"security\",\"parking\",\"gas_pipeline\",\"play_area\",\"waste_management\",\"surveillance\",\"fire\",\"electrification\",\"water\",\"jogging\"]', '2025-09-10', 1, 'approved', '2025-09-04 01:12:44', '2025-09-13 08:07:10'),
(125, 'Keerthi Royal Palms', 2, '2025-09-12', '2025-11-11', 'keerthi-royal-palms', 'residential', 'apartment', 'buy', 'unfurnished', 'new', 'under', '[{\"id\":1,\"title\":\"2_bhks\",\"price\":\"\"},{\"id\":2,\"title\":\"3_bhks\",\"price\":\"\"}]', '[\"3_bath\"]', 3, 43, '1_year', '[\"east\"]', 1, 19, 'test', '2 BHK', 'Electronic city', NULL, NULL, NULL, 'test', '1', '1', 1, 1, '[]', '[\"gated_community\"]', '[\"dining_table\"]', NULL, 1, 'approved', '2025-09-12 07:49:40', '2025-09-14 02:10:44'),
(132, 'Kalash Complex', 2, '2025-09-13', '2025-11-12', 'kalash-complex', 'commercial', 'showroom', 'buy', 'unfurnished', 'new', 'under', '[{\"id\":1,\"title\":\"2_bhks\",\"price\":\"\"},{\"id\":2,\"title\":\"3_bhks\",\"price\":\"\"}]', '[]', 3, 43, '1_year', '[\"east\"]', 1, 1, 'test', '2 BHK', 'Mansarovar road', NULL, NULL, NULL, 'test', '1', '1', 1, 1, '[]', '[\"gated_community\"]', '[\"dining_table\"]', NULL, 1, 'approved', '2025-09-12 23:12:36', '2025-09-14 02:10:44'),
(135, 'Ratilal', 1, '2025-08-13', '2025-09-13', 'ratilal', 'residential', 'apartment', 'buy', 'unfurnished', 'new', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"2500000\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"\"}]', '[]', 3, 43, '1_year', '[\"east\"]', 1, 1, 'test', '2 BHK', 'Mansarovar', NULL, NULL, NULL, 'test', '1', '1', 1, 1, '[]', '[\"gated_community\"]', '[\"dining_table\"]', NULL, 1, 'pending', '2025-09-13 07:14:33', '2025-09-14 05:44:59'),
(136, 'Ashok', 2, '2025-09-14', '2025-11-13', 'ashok', 'residential', 'apartment', 'buy', 'unfurnished', 'new', 'under', '[{\"id\":1,\"title\":\"2_bhk\",\"price\":\"2500000\"},{\"id\":2,\"title\":\"3_bhk\",\"price\":\"3500000\"}]', '[\"4_bath\"]', 3, 43, '1_year', '[\"east\"]', 1, 1, 'test', '2 bhk', 'Sindhi', NULL, NULL, NULL, 'test', '1', '1', 1, 1, '[]', '[\"gated_community\"]', '[\"dining_table\"]', NULL, 1, 'approved', '2025-09-14 02:12:09', '2025-09-14 02:15:03');

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
(8, 44, 4, 3, '2025-09-11 06:33:15', '2025-08-18 05:17:25', '2025-08-18 05:17:25'),
(13, 44, 3, 4, '2025-08-18 08:16:54', '2025-08-18 08:16:54', '2025-08-18 08:16:54'),
(15, 110, 3, 1, '2025-09-11 01:16:46', '2025-09-11 01:16:46', '2025-09-11 01:16:46'),
(16, 64, 3, 1, '2025-09-11 01:17:08', '2025-09-11 01:17:08', '2025-09-11 01:17:08'),
(17, 64, 2, 3, '2025-09-11 05:20:00', '2025-09-11 05:20:00', '2025-09-11 05:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `label` enum('Main','Video','Elevation','Bedroom','Living','Balcony','Amenities','Floor','Location','Cluster','2D','3D','Brochure') DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `property_id`, `image`, `label`, `order`, `created_at`, `updated_at`) VALUES
(1135, 110, '110-1135-1756989081.avif', 'Video', 2, '2025-09-04 07:01:21', '2025-09-04 07:09:26'),
(1136, 110, '110-1136-1756989087.avif', 'Living', 5, '2025-09-04 07:01:27', '2025-09-04 07:10:02'),
(1137, 110, '110-1137-1756989092.avif', 'Location', 9, '2025-09-04 07:01:32', '2025-09-04 07:02:28'),
(1138, 110, '110-1138-1756989098.avif', 'Elevation', 3, '2025-09-04 07:01:38', '2025-09-04 07:02:28'),
(1139, 110, '110-1139-1756989102.avif', 'Bedroom', 4, '2025-09-04 07:01:42', '2025-09-04 07:02:28'),
(1140, 110, '110-1140-1756989107.avif', 'Amenities', 7, '2025-09-04 07:01:47', '2025-09-04 07:02:28'),
(1141, 110, '110-1141-1756989111.avif', 'Floor', 8, '2025-09-04 07:01:51', '2025-09-04 07:10:36'),
(1142, 110, '110-1142-1756989115.avif', 'Main', 1, '2025-09-04 07:01:55', '2025-09-04 07:02:28'),
(1143, 110, '110-1143-1756991706.JPG', 'Cluster', 10, '2025-09-04 07:45:06', '2025-09-04 07:45:21'),
(1144, 110, 'ganesh-park_110_1756991994.JPG', 'Balcony', 6, '2025-09-04 07:49:54', '2025-09-04 07:50:04'),
(1145, 110, 'ganesh-park_110_1757048748.JPG', NULL, NULL, '2025-09-04 23:35:48', '2025-09-09 04:35:19'),
(1146, 110, 'ganesh-park_110_1757048897.JPG', NULL, NULL, '2025-09-04 23:38:17', '2025-09-09 04:35:19'),
(1161, 110, 'ganesh-park_110_1757051106.pdf', NULL, NULL, '2025-09-05 00:15:06', '2025-09-09 04:35:19'),
(1175, 125, 'keerthi-royal-palms_125_1757683180.JPG', 'Main', NULL, '2025-09-12 07:49:40', '2025-09-12 07:49:40'),
(1181, 132, 'kalash-complex_132_1757738557.JPG', 'Video', NULL, '2025-09-12 23:12:36', '2025-09-12 23:12:37'),
(1184, 135, 'ratilal_135_1757767473.JPG', 'Main', NULL, '2025-09-13 07:14:33', '2025-09-13 07:14:33'),
(1185, 136, 'ashok_136_1757835729.JPG', 'Main', NULL, '2025-09-14 02:12:09', '2025-09-14 02:12:09');

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
(131, 110, 1, '2025-09-04 07:26:01', '2025-09-04 07:26:01'),
(132, 110, 3, '2025-09-04 07:26:01', '2025-09-04 07:26:01'),
(134, 64, 1, '2025-09-04 07:26:01', '2025-09-04 07:26:01'),
(135, 65, 3, '2025-09-04 07:26:01', '2025-09-04 07:26:01'),
(136, 44, 3, '2025-09-11 01:16:01', '2025-09-11 01:16:01'),
(137, 64, 3, '2025-09-11 01:16:17', '2025-09-11 01:16:17'),
(138, 64, 2, '2025-09-11 05:19:43', '2025-09-11 05:19:43');

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
(319, '1756968126.JPG', '2025-09-04 01:12:06', '2025-09-04 01:12:06'),
(320, '1756968126.JPG', '2025-09-04 01:12:06', '2025-09-04 01:12:06'),
(321, '1756968128.JPG', '2025-09-04 01:12:08', '2025-09-04 01:12:08'),
(322, '1756968128.JPG', '2025-09-04 01:12:08', '2025-09-04 01:12:08'),
(323, '1756968129.JPG', '2025-09-04 01:12:09', '2025-09-04 01:12:09'),
(324, '1756968130.JPG', '2025-09-04 01:12:10', '2025-09-04 01:12:10'),
(325, '1756968131.JPG', '2025-09-04 01:12:11', '2025-09-04 01:12:11'),
(326, '1757329890.png', '2025-09-08 05:41:30', '2025-09-08 05:41:30'),
(327, '1757330389.png', '2025-09-08 05:49:49', '2025-09-08 05:49:49'),
(328, '1757330518.png', '2025-09-08 05:51:58', '2025-09-08 05:51:58'),
(329, '1757330671.png', '2025-09-08 05:54:31', '2025-09-08 05:54:31'),
(330, '1757331466.png', '2025-09-08 06:07:46', '2025-09-08 06:07:46'),
(331, '1757331706.png', '2025-09-08 06:11:46', '2025-09-08 06:11:46'),
(332, '1757332048.png', '2025-09-08 06:17:28', '2025-09-08 06:17:28'),
(333, '1757332332.png', '2025-09-08 06:22:12', '2025-09-08 06:22:12'),
(334, '1757334018.png', '2025-09-08 06:50:18', '2025-09-08 06:50:18'),
(335, '1757423210.png', '2025-09-09 07:36:50', '2025-09-09 07:36:50'),
(336, '1757423263.png', '2025-09-09 07:37:43', '2025-09-09 07:37:43'),
(337, '1757423346.png', '2025-09-09 07:39:06', '2025-09-09 07:39:06'),
(338, '1757423374.png', '2025-09-09 07:39:34', '2025-09-09 07:39:34'),
(339, '1757423419.JPG', '2025-09-09 07:40:19', '2025-09-09 07:40:19'),
(340, '1757423422.JPG', '2025-09-09 07:40:22', '2025-09-09 07:40:22'),
(341, '1757423424.JPG', '2025-09-09 07:40:24', '2025-09-09 07:40:24'),
(342, '1757423427.JPG', '2025-09-09 07:40:27', '2025-09-09 07:40:27'),
(343, '1757423431.JPG', '2025-09-09 07:40:31', '2025-09-09 07:40:31'),
(344, '1757423435.JPG', '2025-09-09 07:40:35', '2025-09-09 07:40:35'),
(345, '1757423437.JPG', '2025-09-09 07:40:37', '2025-09-09 07:40:37'),
(346, '1757423439.JPG', '2025-09-09 07:40:39', '2025-09-09 07:40:39'),
(347, '1757423439.JPG', '2025-09-09 07:40:39', '2025-09-09 07:40:39'),
(348, '1757423441.JPG', '2025-09-09 07:40:41', '2025-09-09 07:40:41'),
(349, '1757424195.png', '2025-09-09 07:53:15', '2025-09-09 07:53:15'),
(350, '1757424472.png', '2025-09-09 07:57:52', '2025-09-09 07:57:52'),
(351, '1757424481.png', '2025-09-09 07:58:01', '2025-09-09 07:58:01'),
(352, '1757425022.png', '2025-09-09 08:07:02', '2025-09-09 08:07:02'),
(353, '1757425127.png', '2025-09-09 08:08:47', '2025-09-09 08:08:47'),
(354, '1757425234.png', '2025-09-09 08:10:34', '2025-09-09 08:10:34'),
(355, '1757425278.png', '2025-09-09 08:11:18', '2025-09-09 08:11:18'),
(356, '1757425354.png', '2025-09-09 08:12:34', '2025-09-09 08:12:34'),
(357, '1757425566.png', '2025-09-09 08:16:06', '2025-09-09 08:16:06'),
(358, '1757425912.png', '2025-09-09 08:21:52', '2025-09-09 08:21:52'),
(359, '1757481925.png', '2025-09-09 23:55:25', '2025-09-09 23:55:25'),
(360, '1757482122.png', '2025-09-09 23:58:42', '2025-09-09 23:58:42'),
(361, '1757482160.png', '2025-09-09 23:59:20', '2025-09-09 23:59:20'),
(362, '1757482221.png', '2025-09-10 00:00:21', '2025-09-10 00:00:21'),
(363, '1757482235.png', '2025-09-10 00:00:35', '2025-09-10 00:00:35'),
(364, '1757483237.png', '2025-09-10 00:17:17', '2025-09-10 00:17:17'),
(365, '1757662031.JPG', '2025-09-12 01:57:11', '2025-09-12 01:57:11'),
(366, '1757662037.JPG', '2025-09-12 01:57:17', '2025-09-12 01:57:17'),
(367, '1757662039.JPG', '2025-09-12 01:57:19', '2025-09-12 01:57:19'),
(368, '1757662043.JPG', '2025-09-12 01:57:23', '2025-09-12 01:57:23'),
(369, '1757662045.JPG', '2025-09-12 01:57:25', '2025-09-12 01:57:25'),
(370, '1757662048.JPG', '2025-09-12 01:57:28', '2025-09-12 01:57:28'),
(371, '1757662050.JPG', '2025-09-12 01:57:30', '2025-09-12 01:57:30'),
(372, '1757662114.JPG', '2025-09-12 01:58:34', '2025-09-12 01:58:34'),
(373, '1757662116.JPG', '2025-09-12 01:58:36', '2025-09-12 01:58:36'),
(374, '1757662163.JPG', '2025-09-12 01:59:23', '2025-09-12 01:59:23'),
(375, '1757662165.JPG', '2025-09-12 01:59:25', '2025-09-12 01:59:25'),
(376, '1757662210.JPG', '2025-09-12 02:00:10', '2025-09-12 02:00:10'),
(377, '1757662212.JPG', '2025-09-12 02:00:12', '2025-09-12 02:00:12'),
(378, '1757662237.JPG', '2025-09-12 02:00:37', '2025-09-12 02:00:37'),
(379, '1757662274.JPG', '2025-09-12 02:01:14', '2025-09-12 02:01:14'),
(380, '1757662308.JPG', '2025-09-12 02:01:48', '2025-09-12 02:01:48'),
(381, '1757662341.JPG', '2025-09-12 02:02:21', '2025-09-12 02:02:21'),
(382, '1757662375.JPG', '2025-09-12 02:02:55', '2025-09-12 02:02:55'),
(383, '1757662411.JPG', '2025-09-12 02:03:31', '2025-09-12 02:03:31'),
(384, '1757662424.JPG', '2025-09-12 02:03:44', '2025-09-12 02:03:44'),
(385, '1757664075.JPG', '2025-09-12 02:31:15', '2025-09-12 02:31:15'),
(386, '1757664077.JPG', '2025-09-12 02:31:17', '2025-09-12 02:31:17'),
(387, '1757664079.JPG', '2025-09-12 02:31:19', '2025-09-12 02:31:19'),
(388, '1757664286.JPG', '2025-09-12 02:34:46', '2025-09-12 02:34:46'),
(389, '1757664288.JPG', '2025-09-12 02:34:48', '2025-09-12 02:34:48'),
(390, '1757664421.JPG', '2025-09-12 02:37:01', '2025-09-12 02:37:01'),
(391, '1757664423.JPG', '2025-09-12 02:37:03', '2025-09-12 02:37:03'),
(392, '1757666141.JPG', '2025-09-12 03:05:41', '2025-09-12 03:05:41'),
(393, '1757666142.JPG', '2025-09-12 03:05:42', '2025-09-12 03:05:42'),
(394, '1757666143.JPG', '2025-09-12 03:05:43', '2025-09-12 03:05:43'),
(395, '1757666193.JPG', '2025-09-12 03:06:33', '2025-09-12 03:06:33'),
(396, '1757666194.JPG', '2025-09-12 03:06:34', '2025-09-12 03:06:34'),
(397, '1757666195.JPG', '2025-09-12 03:06:35', '2025-09-12 03:06:35'),
(398, '1757666195.JPG', '2025-09-12 03:06:35', '2025-09-12 03:06:35'),
(399, '1757670517.JPG', '2025-09-12 04:18:37', '2025-09-12 04:18:37'),
(400, '1757670518.JPG', '2025-09-12 04:18:38', '2025-09-12 04:18:38'),
(401, '1757670519.JPG', '2025-09-12 04:18:39', '2025-09-12 04:18:39'),
(402, '1757670521.JPG', '2025-09-12 04:18:41', '2025-09-12 04:18:41'),
(403, '1757670522.JPG', '2025-09-12 04:18:42', '2025-09-12 04:18:42'),
(404, '1757672299.JPG', '2025-09-12 04:48:19', '2025-09-12 04:48:19'),
(405, '1757672300.JPG', '2025-09-12 04:48:20', '2025-09-12 04:48:20'),
(406, '1757672971.JPG', '2025-09-12 04:59:31', '2025-09-12 04:59:31'),
(407, '1757672972.JPG', '2025-09-12 04:59:32', '2025-09-12 04:59:32'),
(408, '1757672973.JPG', '2025-09-12 04:59:33', '2025-09-12 04:59:33'),
(409, '1757672974.JPG', '2025-09-12 04:59:34', '2025-09-12 04:59:34'),
(410, '1757682556.JPG', '2025-09-12 07:39:16', '2025-09-12 07:39:16'),
(411, '1757682561.JPG', '2025-09-12 07:39:21', '2025-09-12 07:39:21'),
(412, '1757682565.JPG', '2025-09-12 07:39:25', '2025-09-12 07:39:25'),
(413, '1757682695.JPG', '2025-09-12 07:41:35', '2025-09-12 07:41:35'),
(414, '1757682696.JPG', '2025-09-12 07:41:36', '2025-09-12 07:41:36'),
(415, '1757682697.JPG', '2025-09-12 07:41:37', '2025-09-12 07:41:37'),
(416, '1757682697.JPG', '2025-09-12 07:41:37', '2025-09-12 07:41:37'),
(417, '1757682698.JPG', '2025-09-12 07:41:38', '2025-09-12 07:41:38'),
(418, '1757682736.JPG', '2025-09-12 07:42:16', '2025-09-12 07:42:16'),
(419, '1757682736.JPG', '2025-09-12 07:42:16', '2025-09-12 07:42:16'),
(420, '1757682833.JPG', '2025-09-12 07:43:53', '2025-09-12 07:43:53'),
(421, '1757682859.JPG', '2025-09-12 07:44:19', '2025-09-12 07:44:19'),
(422, '1757683120.JPG', '2025-09-12 07:48:40', '2025-09-12 07:48:40'),
(423, '1757683171.JPG', '2025-09-12 07:49:31', '2025-09-12 07:49:31'),
(424, '1757683512.JPG', '2025-09-12 07:55:12', '2025-09-12 07:55:12'),
(425, '1757737173.JPG', '2025-09-12 22:49:33', '2025-09-12 22:49:33'),
(426, '1757737388.JPG', '2025-09-12 22:53:08', '2025-09-12 22:53:08'),
(427, '1757737538.JPG', '2025-09-12 22:55:38', '2025-09-12 22:55:38'),
(428, '1757737926.JPG', '2025-09-12 23:02:06', '2025-09-12 23:02:06'),
(429, '1757738058.JPG', '2025-09-12 23:04:18', '2025-09-12 23:04:18'),
(430, '1757738549.JPG', '2025-09-12 23:12:29', '2025-09-12 23:12:29'),
(431, '1757766445.JPG', '2025-09-13 06:57:25', '2025-09-13 06:57:25'),
(432, '1757766528.JPG', '2025-09-13 06:58:48', '2025-09-13 06:58:48'),
(433, '1757766659.JPG', '2025-09-13 07:00:59', '2025-09-13 07:00:59'),
(434, '1757766700.JPG', '2025-09-13 07:01:40', '2025-09-13 07:01:40'),
(435, '1757766747.JPG', '2025-09-13 07:02:27', '2025-09-13 07:02:27'),
(436, '1757767028.JPG', '2025-09-13 07:07:08', '2025-09-13 07:07:08'),
(437, '1757767467.JPG', '2025-09-13 07:14:27', '2025-09-13 07:14:27'),
(438, '1757835718.JPG', '2025-09-14 02:11:58', '2025-09-14 02:11:58');

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
  `role` enum('Admin','User','Agent','Builder') NOT NULL DEFAULT 'User',
  `preferred_view` varchar(100) NOT NULL DEFAULT 'card',
  `avatar_color` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `mobile`, `role`, `preferred_view`, `avatar_color`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mukesh Bhavsar', 'mukeshbhavsar210@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '1-mukesh-bhavsar-1757149004.webp', '9978835005', 'Admin', 'card', NULL, 1, NULL, '2024-12-28 05:49:21', '2025-09-14 00:12:53'),
(2, 'Sona Bhavsar', 'sona@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '', '9978835005', 'User', 'card', NULL, 1, NULL, '2024-12-28 05:49:21', '2025-01-10 23:42:25'),
(3, 'Dhruv Bhavsar', 'dhruvbhavsar210@gmail.com', NULL, '$2y$12$Iy5Wh1TVAkCYAvaefrR71OEKD4QDjhnnWBxknqjwnioSSM6sAJMnO', '3-dhruv-bhavsar-1757226175.JPG', '9916235005', 'Agent', 'card', NULL, 1, NULL, '2024-12-28 05:49:21', '2025-09-14 00:46:38'),
(4, 'Gaurav', 'gaurav@gmail.com', NULL, '$2y$12$1SpADjHEpzBJ2OTXEQkwd.GNrM1Hrn.vGo7NyPsqXiaYBGTZwj3.C', '', '9978812345', 'Builder', 'card', '#33B5E5', 1, NULL, '2024-12-28 05:51:32', '2025-01-06 07:33:21'),
(5, 'Priyanka', 'priyanka@gmail.com', NULL, '$2y$12$iQH/lmv1OmW/h8q3J6nlUOuL9A8uYw.4AQ1R2ruQckdV6u2l.eJZC', '5-priyanka-1757224247.JPG', '9913535005', 'Builder', 'card', NULL, 1, NULL, '2025-09-07 00:19:42', '2025-09-10 23:19:44');

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
(22, 64, 3, '2025-09-04 06:32:11', '2025-09-04 06:32:11'),
(23, 110, 3, '2025-09-04 07:02:38', '2025-09-04 07:02:38'),
(24, 65, 3, '2025-09-04 07:18:23', '2025-09-04 07:18:23'),
(25, 110, NULL, '2025-09-05 05:57:04', '2025-09-05 05:57:04'),
(26, 44, NULL, '2025-09-06 00:10:18', '2025-09-06 00:10:18'),
(27, 64, NULL, '2025-09-06 00:10:34', '2025-09-06 00:10:34'),
(28, 65, NULL, '2025-09-06 00:37:21', '2025-09-06 00:37:21'),
(31, 64, 2, '2025-09-11 05:19:56', '2025-09-11 05:19:56');

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_property_id_foreign` (`property_id`),
  ADD KEY `orders_plan_id_foreign` (`plan_id`);

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
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_user_id_foreign` (`user_id`),
  ADD KEY `properties_city_id_foreign` (`city_id`),
  ADD KEY `properties_area_id_foreign` (`area_id`),
  ADD KEY `properties_builder_id_foreign` (`builder_id`) USING BTREE,
  ADD KEY `properties_plan_id_foreign` (`plan_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `property_applications`
--
ALTER TABLE `property_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1186;

--
-- AUTO_INCREMENT for table `saved_properties`
--
ALTER TABLE `saved_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=439;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visited_properties`
--
ALTER TABLE `visited_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_builder_id_foreign` FOREIGN KEY (`builder_id`) REFERENCES `builders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
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
