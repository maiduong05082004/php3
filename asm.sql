-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2024 at 09:11 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asm`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `description`, `url`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Mùa hè 2024', NULL, 'banners/uB2HshxTdoddlpb5qxWAKjlo5CkpNzskObFMf23k.webp', 1, '2024-08-06 01:35:02', '2024-08-06 01:36:24'),
(5, 'Bát', NULL, 'banners/LCImDrQnGa0V8FnfVx1djyicUmUZUc6DXFfrOLRk.webp', 1, '2024-08-06 03:37:43', '2024-08-06 03:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `bill_detail_id` bigint UNSIGNED NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `status` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_details`
--

CREATE TABLE `bill_details` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1: Active, 2: Inactive, 3: Trashed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(0, 'Chưa phân loại', NULL, 1, '2024-08-09 21:26:26', '2024-08-09 21:35:53'),
(42, 'Nội thất', NULL, 1, '2024-08-09 22:02:13', '2024-08-10 01:11:21'),
(43, 'Phòng Bếp', NULL, 1, '2024-08-09 22:02:19', '2024-08-09 22:02:19'),
(44, 'Nhà ăn', NULL, 1, '2024-08-09 22:02:25', '2024-08-09 22:02:25'),
(45, 'Chăn ga gối đệm', NULL, 1, '2024-08-09 22:02:37', '2024-08-09 22:02:37'),
(46, 'Trang trí', NULL, 1, '2024-08-09 22:02:52', '2024-08-09 22:14:26'),
(53, 'Ghế Sofa', '42', 1, '2024-08-10 05:15:35', '2024-08-10 05:15:35'),
(55, 'PHÒNG KHÁCH', '42', 1, '2024-08-10 05:16:22', '2024-08-10 05:16:22'),
(56, 'PHÒNG ĂN & BẾP', '42', 1, '2024-08-10 05:16:41', '2024-08-10 05:16:41'),
(57, 'PHÒNG LÀM VIỆC', '42', 1, '2024-08-10 05:16:57', '2024-08-10 05:16:57'),
(58, 'DỤNG CỤ NẤU ĂN', '43', 1, '2024-08-10 05:19:39', '2024-08-10 05:19:39'),
(59, 'lọ hoa', '55', 1, NULL, NULL),
(60, 'nước lau kính', '55', 1, NULL, NULL),
(61, 'Ghế sofa lông cừu', '53', 1, '2024-08-10 05:15:35', '2024-08-10 05:15:35'),
(62, 'KHUNG GIƯỜNG', '45', 1, NULL, NULL),
(63, 'Khung Sivaus', '62', 1, NULL, NULL),
(64, 'Khung Queen', '62', 1, NULL, NULL),
(65, 'Phụ kiện để bàn', '46', 1, '2024-08-24 23:23:05', '2024-08-24 23:23:05'),
(66, 'Khai đựng phụ kiện', '46', 1, '2024-08-24 23:24:53', '2024-08-24 23:35:32'),
(67, 'Cây giả và bình hoa', '65', 1, '2024-08-24 23:25:12', '2024-08-24 23:25:12'),
(68, 'vc vc', '66', 1, '2024-08-24 23:32:02', '2024-08-25 01:19:23'),
(69, 'kkk', '46', 3, '2024-08-24 23:34:34', '2024-08-25 08:15:09'),
(73, 'dfdfdfdfff', '71', 1, '2024-08-25 01:08:16', '2024-08-25 01:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Màu trắng', '#F0F0F0', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(2, 'Màu đen', 'black', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(3, 'Màu nâu', 'brown', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(4, 'Màu vàng', 'yellow', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(5, 'màu xanh', 'green', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(6, 'Màu xanh da trời', 'skyblue', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(8, 'Màu đỏ', 'red', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(9, 'Màu hồng', 'pink', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(10, 'Màu xám', 'gray', '2024-08-05 03:48:10', '2024-08-05 03:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount`, `valid_from`, `valid_until`, `created_at`, `updated_at`) VALUES
(1, '17245MYSTERY', '120000.00', NULL, NULL, '2024-08-05 23:37:51', '2024-08-05 23:38:05'),
(2, '13098MYSTERY', '30000.00', '2024-08-12', '2025-08-05', '2024-08-05 23:40:14', '2024-08-05 23:40:14'),
(3, '14236MYSTERY', '12000.00', '2024-08-05', '2024-08-12', '2024-08-05 23:40:46', '2024-08-05 23:40:46'),
(4, '14236MYSTERY1', '1212.00', '1212-12-12', '1213-12-12', '2024-08-05 23:44:18', '2024-08-05 23:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_libraries`
--

CREATE TABLE `image_libraries` (
  `id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_libraries`
--

INSERT INTO `image_libraries` (`id`, `url`, `created_at`, `updated_at`) VALUES
(1, 'https://via.placeholder.com/640x480.png/002277?text=autem', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(2, 'https://via.placeholder.com/640x480.png/00cccc?text=praesentium', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(3, 'https://via.placeholder.com/640x480.png/006677?text=pariatur', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(5, 'https://via.placeholder.com/640x480.png/003311?text=accusantium', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(6, 'https://via.placeholder.com/640x480.png/007744?text=perferendis', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(7, 'https://via.placeholder.com/640x480.png/00ff33?text=qui', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(8, 'https://via.placeholder.com/640x480.png/0044dd?text=et', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(9, 'https://via.placeholder.com/640x480.png/0022ff?text=maiores', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(10, 'https://via.placeholder.com/640x480.png/0066ff?text=pariatur', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(11, 'images/3vkEe6oRK0MJMPVqRuXcK1YnngZxXetbFuJwnOJw.jpg', '2024-08-05 03:48:58', '2024-08-05 03:48:58'),
(12, 'images/Emzrb76easMMK8JKnA6AwhZCNBjXGpleDZNF0dRD.jpg', '2024-08-05 03:49:19', '2024-08-05 03:49:19'),
(14, 'images/PD45bHtaV9NZTpXtwNhPHZ8TVzzrQCUUZfow6FhN.jpg', '2024-08-05 04:14:14', '2024-08-05 04:14:14'),
(15, 'images/UbFIfCfpq2YXG06iyktXZun336YpfOnKp8x1e5vP.jpg', '2024-08-05 04:15:48', '2024-08-05 04:15:48'),
(16, 'images/qItcLaZGyk7X0mLgra3nmVWzEMzQUF9ndySUoOaI.jpg', '2024-08-05 04:16:46', '2024-08-05 04:16:46'),
(17, 'images/zaRJDIKK8kbeHRIxwPQ2xqbECIx5xLLrTRUIKWuG.jpg', '2024-08-05 04:18:04', '2024-08-05 04:18:04'),
(18, 'images/F703r8DMINPGdRBAfUB0SXYmVJE1PaGZfgwwT6ke.jpg', '2024-08-05 04:21:59', '2024-08-05 04:21:59'),
(19, 'images/hqFRgqO5V73JOwW0eyTsyGWAAKThyAehezbFWRoy.jpg', '2024-08-05 04:22:16', '2024-08-05 04:22:16'),
(20, 'images/pbImEywmX8uHiQF6kkNPZJ0rYExwFVAUxWJuzGlg.jpg', '2024-08-05 04:22:28', '2024-08-05 04:22:28'),
(21, 'images/yuVfLunZoPPwj0iFMS3otCTwxvo5iRx7z7O4YXmW.jpg', '2024-08-05 04:54:32', '2024-08-05 04:54:32'),
(22, 'images/U0MTMhpkoMxeAxHXoui1JYmyb8VQ6NLbl5QpiOXU.jpg', '2024-08-05 04:54:53', '2024-08-05 04:54:53'),
(23, 'images/9gjCPUlzBWbSBhEFp3yjKFueJ5cACom1qsUaBzY3.jpg', '2024-08-05 04:55:06', '2024-08-05 04:55:06'),
(24, 'images/0aHXPNV0uzRJnYS4fBBPO3i1uHIIiZcExLeAwrMN.jpg', '2024-08-05 05:00:40', '2024-08-05 05:00:40'),
(25, 'images/ryVsqgFVNF8SrzPwteA91oHtNJLIdhCBlGzaNe4x.jpg', '2024-08-05 22:32:05', '2024-08-05 22:32:05'),
(26, 'images/fi6lY1oX3YsQVDzE4eG9ayLmCEMgIrYjOL3ii7an.jpg', '2024-08-05 22:32:13', '2024-08-05 22:32:13'),
(27, 'images/KK23rzoyHQ92hIqBHFow7TJRoko1XI7fRtnNRfVm.webp', '2024-08-06 01:24:06', '2024-08-06 01:24:06'),
(28, 'images/nRt1S2Y5W5bbOCc9TywMxyhNsGWi55HAhKJnMtVE.webp', '2024-08-06 01:25:57', '2024-08-06 01:25:57'),
(29, 'images/BCXOkog74qxpQN4PnkuCqW3FO2r5rh5kfgePQAwg.webp', '2024-08-06 01:26:06', '2024-08-06 01:26:06'),
(30, 'images/C1TpoycLvdp2uCdKGGejZ94KhAVtQQh8yj4aVjV5.webp', '2024-08-06 01:26:14', '2024-08-06 01:26:14'),
(31, 'images/YMXUgtINLQnh9ZPou3wfY7vpDDhM97PBFmWdX5zc.webp', '2024-08-10 20:33:21', '2024-08-10 20:33:21'),
(32, 'images/MvQZoqmJuay509mqSOI38YQCV1qtIMUsHsGQxaMg.webp', '2024-08-10 20:33:26', '2024-08-10 20:33:26'),
(33, 'images/Mh8xqoH4aDzIl9dFqarzlo0lxwDOrL2Zipr7vxqt.webp', '2024-08-10 20:33:33', '2024-08-10 20:33:33'),
(34, 'images/WKY8LfD0dGUhVjSWDGc9j2xfiDLh5NJvKYvzSH2U.jpg', '2024-08-10 20:33:39', '2024-08-10 20:33:39'),
(35, 'images/cJQlisc8SDsOYEMY8tB9A3hUIRR6A6nmogJpeMSQ.webp', '2024-08-10 20:33:46', '2024-08-10 20:33:46'),
(36, 'images/fbzTTbzIZGzlNzbEAFK5e6H1zSWU50bpDaDPPqj5.webp', '2024-08-10 20:33:52', '2024-08-10 20:33:52'),
(37, 'images/1TOQVKkDWiVrrHnOOQr2pfq2geiS3xlFTW70ALYf.jpg', '2024-08-10 20:35:08', '2024-08-10 20:35:08'),
(38, 'images/6T8TFtnkGcsDz4P35g22EWliTpnXLJG0ynbqpOT9.webp', '2024-08-10 20:35:17', '2024-08-10 20:35:17'),
(39, 'images/1iaHM48br3OgBwl5Xj0o83cZpEOoj1qmivh7IM0e.webp', '2024-08-10 20:35:23', '2024-08-10 20:35:23'),
(40, 'images/uJL7q50OkQhQP2GoX8Phc0fjjz5jocq794bODt9t.webp', '2024-08-10 20:35:29', '2024-08-10 20:35:29'),
(41, 'images/1NY3ro4elulnbBBXmCBjiYrH9w4lzFCsyFHiYcGY.jpg', '2024-08-11 10:33:31', '2024-08-11 10:33:31'),
(42, 'images/csX4RyZ24ElBAX0Fi9RLtDVVkCLhaAC2W98cyfVY.jpg', '2024-08-27 05:10:21', '2024-08-27 05:10:21'),
(43, 'images/Rp6P05b5ntF1SfVI7cFKdAGfVQXQpGcSbFYE3kfI.webp', '2024-08-27 05:11:14', '2024-08-27 05:11:14'),
(44, 'images/M5XSiP3KkBTJiagbs3WTwImyKpv078xFqnz4MPCd.webp', '2024-08-27 05:11:19', '2024-08-27 05:11:19'),
(45, 'images/wtLujVyb8bYYzsKErhohFCWVFVbFlTaLqtRPTyY1.webp', '2024-08-27 05:11:26', '2024-08-27 05:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(121, '2014_10_12_000000_create_users_table', 1),
(122, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(123, '2019_08_19_000000_create_failed_jobs_table', 1),
(124, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(125, '2024_07_16_000002_create_colors_table', 1),
(126, '2024_07_16_000003_create_sizes_table', 1),
(127, '2024_07_16_000005_create_image_libraries_table', 1),
(128, '2024_07_16_000006_create_categories_table', 1),
(129, '2024_07_16_000007_create_products_table', 1),
(130, '2024_07_16_023433_create_product_variants_table', 1),
(131, '2024_07_16_062803_create_bill_details_table', 1),
(132, '2024_07_16_062804_create_bills_table', 1),
(133, '2024_07_18_083929_create_reviews_table', 1),
(134, '2024_07_18_084107_create_wishlists_table', 1),
(135, '2024_07_18_084120_create_coupons_table', 1),
(136, '2024_07_18_085314_create_banners_table', 1),
(137, '2024_08_06_060736_change_users_table', 2),
(138, '2024_08_06_074721_change_users_table', 3),
(139, '2024_08_08_092347_change_products_table', 4),
(140, '2024_08_08_092501_change_product_variants_table', 4),
(141, '2024_08_27_110129_create_comments_table', 5),
(142, '2024_08_27_110133_create_carts_table', 5),
(143, '2024_08_27_175651_add_code_to_colors_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `priceSale` decimal(8,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1: Active, 2: Inactive, 3: Trashed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `priceSale`, `image`, `description`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(52, 'mai duong', '32.00', NULL, 'images/mh65ub4qlwRst9zge0ohmNpnP7t7M2hksiu4VU2s.jpg', 'Hoàn thiện nơi ẩn náu hiện đại của bạn với giường bọc nệm Maloken cỡ lớn có thanh cuộn. Đây là điểm nhấn táo bạo cho phòng ngủ của bạn, tạo nên tuyên bố màu sắc hiện đại với toàn bộ lớp bọc. Và những đêm ấm cúng trở nên thoải mái hơn nhiều với thiết kế tựa lưng hình cánh chim, khuyến khích bạn cuộn tròn và ổn định một cách đầy phong cách.\r\n\r\nĐược làm bằng khung gỗ kỹ thuật bền và thanh cuộn\r\n\r\nVải bọc polyester\r\n\r\nThiết kế mái che có cánh\r\n\r\nGiường không cần thêm đế/lò xo hộp; phù hợp với hầu hết các đế có thể điều chỉnh khoảng hở bằng không\r\n\r\nCó nệm, bán riêng\r\n\r\nYêu cầu lắp ráp\r\n\r\nThời gian lắp ráp ước tính: 30 phút', 0, 1, '2024-08-06 01:18:06', '2024-08-10 05:21:07'),
(53, 'Giường bệ bọc nệm Maloken Queen Wingback', '990.00', '880.00', 'images/qCqGbSiXEnnQrxCp7koSIzKRodzEnElueP6kal5Z.webp', 'Hoàn thiện nơi ẩn náu hiện đại của bạn với giường bọc nệm Maloken cỡ lớn có thanh cuộn. Đây là điểm nhấn táo bạo cho phòng ngủ của bạn, tạo nên tuyên bố màu sắc hiện đại với toàn bộ lớp bọc. Và những đêm ấm cúng trở nên thoải mái hơn nhiều với thiết kế tựa lưng hình cánh chim, khuyến khích bạn cuộn tròn và ổn định một cách đầy phong cách.\r\n\r\nĐược làm bằng khung gỗ kỹ thuật bền và thanh cuộn\r\n\r\nVải bọc polyester\r\n\r\nThiết kế mái che có cánh\r\n\r\nGiường không cần thêm đế/lò xo hộp; phù hợp với hầu hết các đế có thể điều chỉnh khoảng hở bằng không\r\n\r\nCó nệm, bán riêng\r\n\r\nYêu cầu lắp ráp\r\n\r\nThời gian lắp ráp ước tính: 30 phút', 45, 1, '2024-08-06 01:19:14', '2024-08-10 20:27:25'),
(54, 'mai duong', '32.00', '12.00', 'images/CUCRHF3OTpdDIDj77KKYfJBVIteh6lSZOwaiAhvo.jpg', '132313', 0, 3, '2024-08-08 02:28:58', '2024-08-10 05:21:08'),
(55, 'mai duong', '32.00', NULL, 'images/QXoqKjXwb8jODX2eifgZZ640oImz4ZLY47ziN6pP.jpg', 'ghụ', 0, 3, '2024-08-09 21:32:39', '2024-08-09 22:29:54'),
(56, 'mai duong', '32.00', NULL, 'images/hpEYU7Nrg5EtNPOoT2pe8HnR5EuNStYrAx5oa714.jpg', 'fsdsfds', 0, 1, '2024-08-09 22:29:27', '2024-08-09 22:29:42'),
(57, 'ĐỆM LÓT GHẾ DÀI N-COOL SP NV S', '269.00', NULL, 'images/1NupkKzBlW96Edi9LBjzW13Nan8m2Q4h6jFPQKrB.webp', 'Mã sản phẩm: 250780678400 <br/>\r\nMàu: HẢI QUÂN <br/>\r\nKích thước: W45 x D135 x H2cm <br/>\r\nChất liệu: NI LÔNG <br/>\r\nTrọng lượng: 0,42kg <br/>\r\nBảo hành - 12 tháng <br/>\r\nLoại lắp ráp: Hỗ trợ Lắp ráp tại nhà <br/>\r\nThời gian lắp ráp	- 2 giờ <br/>\r\nHình thức giao hàng: GIAO HÀNG KHÔNG LẮP ĐẶT <br/>\r\nKích thước đóng gói: W45 x D13 x H13cm <br/>\r\nTrọng lượng gói hàng: 0,75kg <br/>\r\nSản xuất tại: TRUNG QUỐC <br/>', 53, 1, '2024-08-10 20:31:29', '2024-08-10 21:06:37'),
(58, 'mai duong', '32.00', NULL, 'images/sitbCrhc80i8hnnj1MMQdkOUfbxx3c0kem2Cwynk.jpg', 'eweqe', 42, 0, '2024-08-11 10:32:47', '2024-08-11 10:32:47'),
(59, 'mai duong', '32.00', NULL, 'images/Gl7n1KN1Gn7SUyJiODzsoBgMzblzN8Ygi9g98joV.jpg', 'ad', 44, 0, '2024-08-14 22:50:21', '2024-08-24 09:38:55'),
(60, 'KHUNG GIƯỜNG QUEEN KAITO3 MBR D31', '9900.00', NULL, 'images/2y46NDgBwNd0mqrHh5jYLD6rAAlRn7Y8GzlK3QMb.png', 'Màu	MÀU NÂU TRUNG\r\nKích thước	171 x 210 x 90cm\r\nChất liệu	MDF\r\nTrọng lượng	107kg\r\nBảo hành	5 năm\r\nLoại lắp ráp	Lắp ráp\r\nThời gian lắp ráp	30 phút\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT\r\nKích thước đóng gói	Gói 1: W 103 × D 69 × H 65cm\r\nGói 2: W 95 × D 97 × H 9cm\r\nGói 3: W 178 × D 38 × H 9cm\r\nGói 4: W 178 × D 24 × H 92cm', 64, 1, '2024-08-24 09:47:10', '2024-08-24 09:47:10'),
(61, 'KHUNG GIƯỜNG QUEEN EB-001 MBR', '12900.00', NULL, 'images/Op9tuFscsQt6x95uFpCV2ZweOByQd8mN3JF1WxGe.png', 'Product Code	250236771000\r\nColor	Middle Brown\r\nSize	W 171 x D 209 x H 87cm\r\nMaterials	Synthetic resin decorative fiberboard (PVC)\r\nWeight	about 73kg\r\nWarranty	5 Year\r\nAssembly Type	Assembled\r\nAssembly Time	-\r\nDelivery Type	DeliveryWithAssembly\r\nPackage Size	Packing 1：W203 × D17 × H15cm　\r\nPacking 2：W170 × D100 × H20cm\r\nPacking 3：W178 × D32 × H5cm\r\nPacking 4：W173 × D88 × H14cm', 64, 1, '2024-08-24 09:49:04', '2024-08-24 09:49:04'),
(62, 'KHUNG GIƯỜNG QUEEN EB-001 LBR', '10999.00', NULL, 'images/IsAFME8a6vrNQewsxf88oZwGKQydaPr9BdpeWC3p.png', 'Mã sản phẩm	250236772000\r\nMàu	Màu nâu nhạt\r\nKích thước	W 171 x D 209 x H 87cm\r\nChất liệu	Ván sợi trang trí nhựa tổng hợp (PVC)\r\nTrọng lượng	khoảng 73kg\r\nBảo hành	5 năm\r\nLoại lắp ráp	Lắp ráp\r\nThời gian lắp ráp	-\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT\r\nKích thước đóng gói	Đóng gói 1: W203 × D17 × H15cm\r\nĐóng gói 2: W170 × D100 × H20cm\r\nĐóng gói 3: W178 × D32 × H5cm\r\nĐóng gói 4: W173 × D88 × H14cm\r\nTrọng lượng gói hàng	khoảng 75kg\r\nSản xuất tại	VIỆT NAM', 64, 1, '2024-08-24 09:49:43', '2024-08-24 09:49:43'),
(63, 'KHUNG GIƯỜNG QUEEN LBR DR BOX-E', '12900.00', NULL, 'images/ZxTqQ0edbjTHgJG66gHbX7rut0pVvbjm2o7iTyPp.png', 'Mã sản phẩm	250236775000\r\nMàu	Màu nâu nhạt\r\nKích thước	W 171 x D 209 x H 87cm\r\nChất liệu	Ván sợi trang trí nhựa tổng hợp (PVC)\r\nTrọng lượng	khoảng 81kg\r\nBảo hành	5 năm\r\nLoại lắp ráp	Lắp ráp\r\nThời gian lắp ráp	-\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT\r\nKích thước đóng gói	Đóng gói 1: W102 × D67 × H54cm\r\nĐóng gói 2: W97 × D115 × H10cm\r\nĐóng gói 3: W177 × D32 × H9cm\r\nĐóng gói 4: W173 × D88 × H14cm\r\nTrọng lượng gói hàng	khoảng 83kg\r\nSản xuất tại	VIỆT NAM', 64, 1, '2024-08-24 09:50:15', '2024-08-24 09:50:15'),
(64, 'KHUNG BÊN KHÔNG CÓ TAY CẮM N-SHIELD BK OY003', '2190.00', NULL, 'images/3pFYZUne2xrmK1BtfxRpEhKZUjeUcN3xly1aF5lu.png', 'Mã sản phẩm	250203125700\r\nMàu	ĐEN\r\nKích thước	W113 x D14 x H62cm\r\nChất liệu	PU\r\nTrọng lượng	9,1kg\r\nBảo hành	5 Năm\r\nLoại lắp ráp	Lắp ráp\r\nThời gian lắp ráp	30phút\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT\r\nKích thước đóng gói	W117 x D63.5 x H16cm\r\nTrọng lượng gói hàng	10,5kg\r\nSản xuất tại	TRUNG QUỐC', 62, 1, '2024-08-24 09:54:58', '2024-08-24 09:54:58'),
(65, 'KHUNG Sivaus CÓ CÁNH TAY CẮM N-SHIELD BE OY003', '1900.00', NULL, 'images/2Kk2relFM5HEv8JexfvZldIksCYYXMrGtY9ONQqN.png', 'Mã sản phẩm	250203126700<br/>\r\nMàu	MÀU BE<br/>\r\nKích thước	W113 x D14 x H62cm<br/>\r\nChất liệu	PU<br/>\r\nTrọng lượng	9,1kg<br/>\r\nBảo hành	5 Năm<br/>\r\nLoại lắp ráp	Lắp ráp<br/>\r\nThời gian lắp ráp	30phút<br/>\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT<br/>\r\nKích thước đóng gói	W117 x D63.5 x H16cm<br/>\r\nTrọng lượng gói hàng	10,5kg<br/>\r\nSản xuất tại	TRUNG QUỐC<br/>', 63, 1, '2024-08-24 09:55:45', '2024-08-27 04:16:13'),
(66, 'KHUNG GIƯỜNG QUEEN KAITO3 MBR', '8930.00', NULL, 'images/UYpIyL1ZEXlil4S9NAgxp4XNgDQiNsA10fM8h23I.webp', 'Mã sản phẩm	250233322000<br/>\r\nMàu	MÀU NÂU TRUNG<br/>\r\nKích thước	171 x 210 x 90cm<br/>\r\nChất liệu	MDF<br/>\r\nTrọng lượng	77kg<br/>\r\nBảo hành	5 năm<br/>\r\nLoại lắp ráp	Lắp ráp<br/>\r\nThời gian lắp ráp	30 phút<br/>\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT<br/>\r\nKích thước đóng gói	<br/>\r\nĐóng gói 1:\r\nW 203 x D 17 x H 15 cm<br/>\r\nĐóng gói 2:\r\nW 98 x D 87 x H 19 cm<br/>\r\nĐóng gói 3:\r\nW 178 x D 32 x H 5 cm<br/>\r\nĐóng gói 4:\r\nW 178 x D 14 x H 98 cm<br/>\r\nTrọng lượng gói hàng	90kg<br/>\r\nSản xuất tại	VIỆT NAM', 64, 1, '2024-08-24 12:51:40', '2024-08-27 04:15:51'),
(67, 'KHUNG GIƯỜNG QUEEN KAITO3 LBR2 D31', '11200.00', NULL, 'images/YbdA3fBnVYZIJHAFBu6qpTYul6Bb04QhDgPVxojk.webp', 'Mã sản phẩm	250231020000<br/>\r\nMàu	MÀU NÂU NHẠT<br/>\r\nKích thước	171 x 210 x 90cm<br/>\r\nChất liệu	MDF<br/>\r\nTrọng lượng	107kg<br/>\r\nBảo hành	5 năm<br/>\r\nLoại lắp ráp	Lắp ráp<br/>\r\nThời gian lắp ráp	30 phút<br/>\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT<br/>\r\nKích thước đóng gói	Đóng gói 1: W104 x D70 x H65 cm<br/>\r\nĐóng gói 2: W177 x D38 x H9 cm<br/>\r\nĐóng gói 3: W95 x D97 x H9 cm<br/>\r\nĐóng gói 4: W179 x D14 x H98 cm<br/>\r\nTrọng lượng gói hàng	118,34kg<br/>\r\nSản xuất tại	VIỆT NAM<br/>', 64, 1, '2024-08-24 12:54:52', '2024-08-27 04:14:59'),
(68, 'Q FRAME MELISSA3 H85 LBR2 D31', '7800.00', NULL, 'images/ax0MQdyJxImIFdkpp8bLQ0ShKpA081zcfPyORlLr.webp', 'Mã sản phẩm	250230557000<br/>\r\nMàu	MÀU NÂU NHẠT<br/>\r\nKích thước	170 x 201 x 85cm<br/>\r\nChất liệu	MDF<br/>\r\nTrọng lượng	84kg<br/>\r\nBảo hành	5 năm<br/>\r\nLoại lắp ráp	Lắp ráp<br/>\r\nThời gian lắp ráp	30 phút<br/>\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT<br/>\r\nKích thước đóng gói	Gói 1: W104 × D70 × H65cm<br/>\r\nGói 2: W177 × D38 × H9cm<br/>\r\nGói 3: W95 × D97 × H9cm<br/>\r\nGói 4: W178 × D90 × H6cm<br/>\r\nTrọng lượng gói hàng	96,34kg<br/>\r\nSản xuất tại	VIỆT NAM<br/>', 64, 1, '2024-08-24 12:55:36', '2024-08-27 04:14:40'),
(69, 'KHUNG GIƯỜNG QUEEN KAITO3 WH D31', '9900.00', NULL, 'images/Md2YRrp0maNbGXEgiL7J805s0v5fu2tIGP6aBQuT.webp', 'Mã sản phẩm	250230303000<br/>\r\nMàu	TRẮNG<br/>\r\nKích thước	171 x 210 x 90cm<br/>\r\nChất liệu	MDF<br/>\r\nTrọng lượng	107kg<br/>\r\nBảo hành	5 năm<br/>\r\nLoại lắp ráp	Lắp ráp<br/>\r\nThời gian lắp ráp	30 phút<br/>\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT<br/>\r\nKích thước đóng gói	Gói 1: W102 × D68 × H65cm<br/>\r\nGói 2: W95 × D97 × H9cm<br/>\r\nGói 3: W178 × D33 × H6cm<br/>\r\nGói 4: W178 × D24 × H92cm<br/>\r\nTrọng lượng gói hàng	116kg<br/>\r\nSản xuất tại	VIỆT NAM<br/>', 64, 1, '2024-08-24 12:56:19', '2024-08-27 04:14:23'),
(70, 'KHUNG GIƯỜNG QUEEN TUỲ CHỈNH 2 ĐỘ CAO KAITO3 LBR2', '8990.00', NULL, 'images/7vgHF6gmq6EaDOZyQ7qC5YUwNOSuv7EaPtyPw4ZR.webp', 'Mã sản phẩm	250233323000 <br/> \r\nMàu	Màu nâu nhạt <br/>\r\nKích thước	W 171 x D 210 x H 90cm<br/>\r\nChất liệu	Giấy in ván sợi trang trí<br/>\r\nTrọng lượng	khoảng 77kg<br/>\r\nBảo hành	5Năm<br/>\r\nLoại lắp ráp	Lắp ráp<br/>\r\nThời gian lắp ráp	-<br/>\r\nHình thức giao hàng	GIAO HÀNG VÀ LẮP ĐẶT<br/>\r\nKích thước đóng gói	Đóng gói 1: W 203 × D 17 × H 15cm<br/>\r\nĐóng gói 2: W 98 × D 87 × H 19cm<br/>\r\nĐóng gói 3: W 178 × D 32 × H 5cm<br/>\r\nĐóng gói 4: W 178 × D 14 × H 98cm<br/>\r\nTrọng lượng gói hàng	77,5kg<br/>\r\nSản xuất tại	VIỆT NAM<br/>', 64, 1, '2024-08-24 12:59:55', '2024-08-27 04:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `color_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL,
  `priceSale` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `color_id`, `size_id`, `stock`, `price`, `priceSale`, `created_at`, `updated_at`) VALUES
(104, 53, 1, 1, 120, '990.00', '870.00', '2024-08-06 01:24:06', '2024-08-06 01:24:06'),
(105, 57, 6, 1, 122, '269.00', NULL, '2024-08-10 20:33:08', '2024-08-10 20:33:08'),
(106, 57, 1, 1, 121, '299.00', NULL, '2024-08-10 20:35:08', '2024-08-10 20:35:08'),
(107, 58, 2, 3, 12, '12.00', NULL, '2024-08-11 10:33:31', '2024-08-11 10:33:31'),
(108, 57, 3, 4, 1223, '335.00', NULL, '2024-08-27 05:10:21', '2024-08-27 05:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_image_library`
--

CREATE TABLE `product_variant_image_library` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `image_library_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variant_image_library`
--

INSERT INTO `product_variant_image_library` (`id`, `product_variant_id`, `image_library_id`, `created_at`, `updated_at`) VALUES
(18, 104, 27, NULL, NULL),
(19, 104, 28, NULL, NULL),
(20, 104, 29, NULL, NULL),
(21, 104, 30, NULL, NULL),
(22, 105, 31, NULL, NULL),
(23, 105, 32, NULL, NULL),
(24, 105, 33, NULL, NULL),
(25, 105, 34, NULL, NULL),
(26, 105, 35, NULL, NULL),
(27, 105, 36, NULL, NULL),
(28, 106, 37, NULL, NULL),
(29, 106, 38, NULL, NULL),
(30, 106, 39, NULL, NULL),
(31, 106, 40, NULL, NULL),
(32, 107, 41, NULL, NULL),
(33, 108, 42, NULL, NULL),
(34, 108, 43, NULL, NULL),
(35, 108, 44, NULL, NULL),
(36, 108, 45, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `rating` tinyint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'XS', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(2, 'S', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(3, 'X', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(4, 'L', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(5, 'XL', '2024-08-05 03:48:10', '2024-08-05 03:48:10'),
(6, 'XXL', '2024-08-05 03:48:10', '2024-08-05 03:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1: Active, 2: Inactive, 3: Trashed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`, `role`) VALUES
(0, 'Admin', 'admin@gmail.com', '70 Đại Lộ 2, P. Phước Bình, Quận 9, Ho Chi Minh City, Vietnam', NULL, '$2y$12$AVYHnjXlRbZMiE.EW0pY8OvCP78DvxIl6vwxD9Edfy0.OPsNGHDG6', NULL, 1, '2024-08-05 23:21:21', '2024-08-05 23:21:21', 'admin'),
(2, 'Mai Duong', 'duongkhongkich@gmail.com', '70 Đại Lộ 2, P. Phước Bình, Quận 9, Ho Chi Minh City, Vietnam', NULL, '$2y$12$AVYHnjXlRbZMiE.EW0pY8OvCP78DvxIl6vwxD9Edfy0.OPsNGHDG6', NULL, 1, '2024-08-05 23:21:21', '2024-08-05 23:31:45', 'user'),
(3, 'Mai Duc Duong', 'du@gmail.com', '70 Đại Lộ 2, P. Phước Bình, Quận 9, Ho Chi Minh City, Vietnam', NULL, '$2y$12$HdQdGh5yLmtoV04Ei2ekGO4PUdu/D4D5wxnPaO.Zx6ROOjntiAALe', NULL, 1, '2024-08-06 03:28:44', '2024-08-06 03:28:44', 'user'),
(4, 'admin', 'admin1@gmail.com', '', NULL, '0984045768', NULL, 1, NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_user_id_foreign` (`user_id`),
  ADD KEY `bills_bill_detail_id_foreign` (`bill_detail_id`);

--
-- Indexes for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_product_id_foreign` (`product_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `image_libraries`
--
ALTER TABLE `image_libraries`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`),
  ADD KEY `product_variants_color_id_foreign` (`color_id`),
  ADD KEY `product_variants_size_id_foreign` (`size_id`);

--
-- Indexes for table `product_variant_image_library`
--
ALTER TABLE `product_variant_image_library`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_image_library_product_variant_id_foreign` (`product_variant_id`),
  ADD KEY `product_variant_image_library_image_library_id_foreign` (`image_library_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_details`
--
ALTER TABLE `bill_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_libraries`
--
ALTER TABLE `image_libraries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `product_variant_image_library`
--
ALTER TABLE `product_variant_image_library`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_bill_detail_id_foreign` FOREIGN KEY (`bill_detail_id`) REFERENCES `bill_details` (`id`),
  ADD CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_variants_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `product_variant_image_library`
--
ALTER TABLE `product_variant_image_library`
  ADD CONSTRAINT `product_variant_image_library_image_library_id_foreign` FOREIGN KEY (`image_library_id`) REFERENCES `image_libraries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_image_library_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
