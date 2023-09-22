-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2023 at 09:55 AM
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
-- Database: `laravel_tumas_pos_v_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'test_category', 'test_category', 1, '2023-02-27 00:46:29', '2023-02-27 00:46:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `remarks`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 'Walking Customer', 'test@test.com', '01676058955', 'test', 'test', 1, '2023-02-07 06:59:42', '2023-02-07 06:59:42', NULL),
(29, 'Olympia Bender', NULL, '11112222', 'test_cus', NULL, 1, '2023-02-28 23:06:31', '2023-02-28 23:06:31', NULL),
(30, 'test', NULL, '333333377', 'fff', NULL, 1, '2023-02-28 23:44:41', '2023-02-28 23:44:41', NULL),
(31, 'heel', NULL, '89888888888', 'hh', NULL, 1, '2023-03-01 12:31:14', '2023-03-01 12:31:14', NULL),
(32, 'unit1', NULL, '99999990', NULL, NULL, 1, '2023-03-01 12:34:05', '2023-03-01 12:34:05', NULL),
(33, 'OMI', NULL, '01717853741', 'NEWMARKET RAJSHAHI', NULL, 1, '2023-03-31 03:15:36', '2023-03-31 03:15:36', NULL),
(35, 'fdfd', NULL, '555', NULL, NULL, 1, '2023-04-04 12:01:46', '2023-04-04 12:01:56', '2023-04-04 12:01:56'),
(36, 'Steven Mcpherson', 'zykitasuz@mailinator.com', '56565656565', 'Quia excepteur proid', 'Aut pariatur Distin', 1, '2023-04-05 04:20:46', '2023-04-05 04:20:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment_details`
--

CREATE TABLE `customer_payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paid_amount` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_payment_details`
--

INSERT INTO `customer_payment_details` (`id`, `sale_order_id`, `customer_id`, `paid_amount`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(10, 404, 30, NULL, 1, NULL, '2023-03-20 08:51:45', '2023-03-20 08:51:45'),
(11, 405, 30, NULL, 1, NULL, '2023-03-20 08:52:20', '2023-03-20 08:52:20'),
(12, 406, 30, 7000, 1, NULL, '2023-03-20 08:52:56', '2023-03-20 08:52:56'),
(15, 405, 30, 15000, 1, NULL, '2023-03-21 07:38:18', '2023-03-21 11:22:47'),
(16, 406, 30, 1000, 1, NULL, '2023-03-21 07:39:06', '2023-03-21 07:39:06'),
(17, 404, 30, 1000, 0, NULL, '2023-03-21 11:42:32', '2023-03-21 11:42:32'),
(18, 405, 30, 3000, 1, NULL, '2023-03-21 11:43:08', '2023-03-21 11:43:08'),
(19, 405, 30, 5000, 1, NULL, '2023-03-31 03:32:39', '2023-03-31 03:32:39'),
(20, 408, 29, 30, 1, NULL, '2023-04-06 13:03:02', '2023-04-06 13:03:02'),
(21, 409, 31, NULL, 1, NULL, '2023-04-06 13:08:33', '2023-04-06 13:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_category_name` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_category_name`, `remarks`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'employee_salary', 'salary', 1, '2023-03-24 18:57:09', '2023-03-24 18:57:09', NULL),
(5, 'VAN VARA', NULL, 1, '2023-03-31 03:36:58', '2023-03-31 03:36:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_records`
--

CREATE TABLE `expense_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_records`
--

INSERT INTO `expense_records` (`id`, `amount`, `type`, `status`, `remarks`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(7, 30000, 1, 1, 'hmm', '2023-03-24 19:32:57', '2023-03-24 19:32:57', NULL, 4),
(8, 13, 1, 1, 'Eos dignissimos dolo', '2023-03-24 22:08:13', '2023-03-24 22:08:13', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `expense_record_details`
--

CREATE TABLE `expense_record_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expense_record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_record_details`
--

INSERT INTO `expense_record_details` (`id`, `expense_id`, `expense_record_id`, `amount`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 4, 7, 15000, 1, '2023-03-24 19:32:57', '2023-03-24 19:32:57', NULL),
(14, 4, 7, 15000, 1, '2023-03-24 19:32:57', '2023-03-24 19:32:57', NULL),
(15, 4, 8, 13, 1, '2023-03-24 22:08:13', '2023-03-24 22:08:13', NULL);

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
(5, '2023_01_27_095600_create_roles_table', 1),
(6, '2023_01_27_095755_create_categories_table', 1),
(7, '2023_01_27_095819_create_sub_categories_table', 1),
(8, '2023_01_27_095915_create_products_table', 1),
(9, '2023_01_27_095933_create_suppliers_table', 1),
(10, '2023_01_30_065125_remove_sphone2_company_name_address_from_suppliers_table', 2),
(11, '2023_01_31_072208_create_units_table', 3),
(12, '2023_01_31_110759_create_purchase_orders_table', 4),
(13, '2023_01_31_110859_create_purchase_order_details_table', 4),
(16, '2023_02_02_131023_create_stocks_table', 5),
(17, '2023_02_04_110225_add_purchase_order_id_supplier_id_to_stock_table', 6),
(18, '2023_02_07_045451_create_customers_table', 7),
(20, '2023_02_07_082502_create_sales_table', 8),
(22, '2023_02_07_105928_create_sale_order_details_table', 9),
(23, '2023_02_12_072110_create_stock_counts_table', 10),
(24, '2023_02_13_064214_create_expenses_table', 11),
(25, '2023_02_13_064405_create_expense_records_table', 11),
(26, '2023_02_13_102754_create_expense_record_details_table', 12),
(30, '2023_02_15_073231_add_extra_charge_discount_on_purchase_order_details', 13),
(31, '2023_02_15_073133_add_extra_charge_discount_on_sale_orders', 14),
(32, '2023_02_16_071713_add_softdelete_to_customers', 15),
(33, '2023_02_16_084555_add_softdelete_to_categories', 16),
(34, '2023_02_16_085646_add_softdelete_to_products', 17),
(35, '2023_02_16_090612_add_softdelete_to_roles', 18),
(36, '2023_02_16_091636_add_softdelete_to_suppliers', 19),
(37, '2023_02_16_094316_add_softdelete_to_subcategories', 20),
(38, '2023_02_16_095148_add_softdelete_to_units', 21),
(39, '2023_02_16_095745_add_softdelete_to_users', 22),
(40, '2023_02_17_051427_add_softdelete_to_expenses', 23),
(41, '2023_02_17_055043_add_softdelete_to_expense_records', 24),
(42, '2023_02_17_055443_add_softdelete_to_expense_record_details', 24),
(43, '2023_02_24_051510_change_column_type_sale_order', 25),
(44, '2023_02_24_051622_change_column_type_sale_order_details', 25),
(45, '2023_02_24_051652_change_column_type_purchase_order_details', 25),
(46, '2023_02_24_051718_change_column_type_purchase_orders', 25),
(47, '2023_02_24_051949_change_column_type_stocks', 25),
(48, '2023_02_24_052026_change_column_type_stock_counts', 25),
(49, '2023_02_18_114711_add_role_id_to_user', 26),
(52, '2023_02_18_041523_add_unit_id_purchase_selling_price_quantity_to_products', 27),
(53, '2023_02_18_043156_add_quantity_to_products', 28),
(54, '2023_02_18_041521_remove_subcategory_id_from_stock_counts', 29),
(55, '2023_02_18_041520_remove_subcategory_id_from_stock_counts', 30),
(56, '2023_02_18_041521_add_subcategory_id_to_stock_counts', 30),
(57, '2023_02_17_055444_add_soft_delete_to_stock_counts', 31),
(58, '2023_02_18_041519_create_vouchers_table', 32),
(59, '2023_02_18_041520_create_voucher_details_table', 32),
(60, '2023_02_18_041517_add_subtotal_voucher_details_table', 33),
(61, '2023_02_18_041517_create_role_permissions_table', 34),
(62, '2023_02_18_041515_create_supplier_payment_details_table', 35),
(63, '2023_02_18_041516_create_customer_payment_details_table', 35),
(64, '2023_02_13_102755_ add_user_id_to_expense_records', 36);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_price` bigint(20) DEFAULT NULL,
  `selling_price` bigint(20) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `subcategory_id`, `product_name`, `product_description`, `status`, `created_at`, `updated_at`, `deleted_at`, `unit_id`, `purchase_price`, `selling_price`, `quantity`) VALUES
(28, 5, 'pipe', NULL, 1, '2023-03-07 06:42:15', '2023-03-24 19:09:40', NULL, 13, 50, 65, 3398),
(29, 6, 'cement', NULL, 1, '2023-03-07 06:42:50', '2023-03-24 19:45:31', NULL, 12, 400, 450, 3260),
(30, 5, '1 THRED PIPE GAZI', NULL, 1, '2023-03-31 03:14:20', '2023-04-06 13:08:33', NULL, 13, 29, 31, 470),
(31, 5, '1 GI TEE AG', NULL, 1, '2023-04-03 01:55:57', '2023-04-03 01:55:57', NULL, 12, 65, 95, 125),
(32, 5, '1 GI ELBO AG', NULL, 1, '2023-04-03 01:57:18', '2023-04-03 01:57:18', NULL, 12, 60, 90, 150),
(33, 5, '1 GI NIPPLE SON', NULL, 1, '2023-04-03 01:58:29', '2023-04-03 01:58:29', NULL, 12, 45, 85, 154),
(34, 5, '1 GI UNUON AG', NULL, 1, '2023-04-03 02:00:02', '2023-04-03 02:00:02', NULL, 12, 126, 145, 180),
(35, 5, '1 GI UNION CHINA', NULL, 1, '2023-04-03 02:01:02', '2023-04-03 02:01:02', NULL, 12, 115, 145, 100),
(36, 5, '1 GI PLUG CHINA', NULL, 1, '2023-04-03 02:03:07', '2023-04-03 02:03:07', NULL, 12, 17, 27, 150),
(37, 5, '1 GI SOKET AG', NULL, 1, '2023-04-03 02:04:11', '2023-04-03 02:04:11', NULL, 12, 45, 65, 140),
(38, 5, '1 GI CROSS TEE', NULL, 1, '2023-04-03 02:05:34', '2023-04-03 02:05:34', NULL, 12, 85, 115, 150),
(39, 5, '1X1/2 GI TEE AG', NULL, 1, '2023-04-03 02:08:23', '2023-04-03 02:08:23', NULL, 12, 70, 95, 165),
(40, 5, '1X1/2 GI ELBO AG', NULL, 1, '2023-04-03 02:09:29', '2023-04-03 02:09:29', NULL, 12, 60, 90, 120),
(41, 5, '1X1/2 GI R SOKET AG', NULL, 1, '2023-04-03 02:10:42', '2023-04-03 02:10:42', NULL, 12, 45, 70, 82),
(42, 5, '1.1/2 GI TEE AG', NULL, 1, '2023-04-03 02:12:36', '2023-04-03 02:31:35', NULL, 12, 133, 185, 45),
(43, 5, '1.1/2 BALL VALBE RFL PVC', NULL, 1, '2023-04-03 02:16:10', '2023-04-03 02:16:10', NULL, 12, 270, 380, 26),
(44, 5, '1.1/2 CHAK VALBE SUNNY', NULL, 1, '2023-04-03 02:17:10', '2023-04-03 02:17:10', NULL, 12, 395, 890, 13),
(45, 5, '1.1/2 GI ELBO AG', NULL, 1, '2023-04-03 02:18:13', '2023-04-03 02:18:13', NULL, 12, 105, 170, 35),
(46, 5, '1.1/2 GI JONSON AG', NULL, 1, '2023-04-03 02:19:39', '2023-04-03 02:19:39', NULL, 12, 140, 175, 30),
(47, 5, '1.1/2 LOTA PIPE', NULL, 1, '2023-04-03 02:21:00', '2023-04-03 02:21:00', NULL, 13, 10, 16, 400),
(48, 5, '1.1/2 GI NIPPLE AG', NULL, 1, '2023-04-03 02:22:06', '2023-04-03 02:22:06', NULL, 12, 85, 125, 40),
(49, 5, '1.1/2 GI PLUG CHINA', NULL, 1, '2023-04-03 02:22:57', '2023-04-03 02:22:57', NULL, 12, 37, 65, 30),
(50, 5, '1.1/2 PVC ELBO', NULL, 1, '2023-04-03 02:24:01', '2023-04-03 02:24:01', NULL, 12, 19, 45, 45),
(51, 5, '1.1/2 PVC TEE', NULL, 1, '2023-04-03 02:24:35', '2023-04-03 02:24:35', NULL, 12, 25, 49, 45),
(52, 5, '1.1/2 GI SOKET AG', NULL, 1, '2023-04-03 02:25:42', '2023-04-03 02:25:42', NULL, 12, 73, 95, 45),
(53, 5, '1.1/2 GI TANKI CONNECTION', NULL, 1, '2023-04-03 02:26:48', '2023-04-03 02:26:48', NULL, 12, 75, 150, 16),
(54, 5, '1.1/2 U CLUM', NULL, 1, '2023-04-03 02:28:17', '2023-04-03 02:28:17', NULL, 12, 9, 16, 35),
(55, 5, '1.1/2 GI UNION AG', NULL, 1, '2023-04-03 02:30:05', '2023-04-03 02:30:05', NULL, 12, 165, 215, 30),
(56, 5, '1.1/2X1GI BUSH', NULL, 1, '2023-04-03 02:32:50', '2023-04-03 02:32:50', NULL, 12, 48, 85, 25),
(57, 5, '1.1/2X1 GI ELBO AG', NULL, 1, '2023-04-03 02:33:42', '2023-04-03 02:33:42', NULL, 12, 85, 130, 70),
(58, 5, '1.1/2X1 R SOKET', NULL, 1, '2023-04-03 02:37:36', '2023-04-03 02:37:36', NULL, 12, 62, 110, 100),
(59, 5, '1.12X1 TEE AG', NULL, 1, '2023-04-03 02:40:22', '2023-04-03 02:40:22', NULL, 12, 110, 160, 130),
(60, 5, '1 1/2 BALL VALVE PVC N', NULL, 1, '2023-04-03 02:42:02', '2023-04-03 02:42:02', NULL, 12, 75, 130, 10),
(61, 5, '1.1/2 GI BUSH', NULL, 1, '2023-04-03 02:48:18', '2023-04-03 02:48:18', NULL, 12, 30, 50, 50),
(62, 5, '1.1/2 CLUM P', NULL, 1, '2023-04-03 02:51:07', '2023-04-03 02:51:07', NULL, 12, 20, 40, 30),
(63, 5, '1 AL BARAKA CONSIL COK', NULL, 1, '2023-04-03 02:52:41', '2023-04-03 02:52:41', NULL, 12, 70, 900, 4),
(64, 5, '1 BALL COK', NULL, 1, '2023-04-03 02:57:12', '2023-04-03 02:57:12', NULL, 12, 360, 520, 10),
(65, 5, '1 BALL VALVE SUNNY/SON', NULL, 1, '2023-04-03 03:37:55', '2023-04-03 03:37:55', NULL, 12, 280, 510, 80),
(66, 5, '1 BALL VALBE N', NULL, 1, '2023-04-03 03:39:06', '2023-04-03 03:39:06', NULL, 12, 40, 100, 15),
(67, 5, '1 BRUSH RONG', NULL, 1, '2023-04-03 03:41:09', '2023-04-03 03:41:09', NULL, 12, 25, 40, 15),
(68, 5, '1 CONSIL COK CASIO', NULL, 1, '2023-04-03 03:42:34', '2023-04-03 03:42:34', NULL, 12, 650, 850, 1),
(69, 5, '1 CHAK VALBE KHAJA', NULL, 1, '2023-04-03 03:43:27', '2023-04-03 03:43:27', NULL, 12, 190, 410, 9),
(70, 5, '1 CLUM PACH', NULL, 1, '2023-04-03 03:44:54', '2023-04-03 03:44:54', NULL, 12, 10, 25, 25),
(71, 5, '1.1/2 CLAM PACH', NULL, 1, '2023-04-03 03:45:35', '2023-04-03 03:45:35', NULL, 12, 10, 45, 25),
(72, 5, '1 HUK CLAM', NULL, 1, '2023-04-03 03:46:54', '2023-04-03 03:46:54', NULL, 12, 3, 5, 450),
(73, 5, '1 CONSIL COK SATTER', NULL, 1, '2023-04-03 03:48:47', '2023-04-03 03:48:47', NULL, 12, 1290, 1750, 33),
(74, 5, '1 CONSIL COK SUZAN', NULL, 1, '2023-04-03 03:49:40', '2023-04-03 03:49:40', NULL, 12, 1400, 1800, 2),
(75, 5, '1 CONSIL COK TANVIR', NULL, 1, '2023-04-03 03:50:37', '2023-04-03 03:50:37', NULL, 12, 1300, 1850, 6),
(76, 5, '1 TANKI CONNECTION', NULL, 1, '2023-04-03 03:51:38', '2023-04-03 03:51:38', NULL, 12, 45, 110, 25),
(77, 5, '1 CONSIL COK ASTRA', NULL, 1, '2023-04-03 03:54:30', '2023-04-03 03:54:30', NULL, 12, 1150, 1650, 8),
(78, 5, '1 SS SCREW CHINA', NULL, 1, '2023-04-03 03:57:12', '2023-04-03 03:57:12', NULL, 12, 1, 2, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `billing_amount` bigint(20) DEFAULT NULL,
  `paid_amount` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `extra_charge` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `supplier_id`, `user_id`, `billing_amount`, `paid_amount`, `status`, `created_at`, `updated_at`, `extra_charge`, `discount`) VALUES
(192, 7, 4, 11100, 11100, 0, '2023-03-21 11:52:15', '2023-03-21 11:52:15', '200', '100'),
(198, 7, 4, 30000, 1000, 1, '2023-03-22 01:02:59', '2023-03-22 01:02:59', NULL, NULL),
(199, 7, 4, 95000, 4500, 1, '2023-03-22 01:04:53', '2023-03-22 06:06:10', NULL, NULL),
(200, 6, 4, 95000, 10000, 1, '2023-03-22 01:04:58', '2023-03-22 01:04:58', NULL, NULL),
(201, 6, 4, 95000, 10000, 1, '2023-03-22 01:04:59', '2023-03-22 01:04:59', NULL, NULL),
(202, 7, 4, 16000, 8000, 1, '2023-03-24 19:45:31', '2023-03-24 19:45:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_details`
--

CREATE TABLE `purchase_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_amount` bigint(20) DEFAULT NULL,
  `selling_amount` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `extra_charge` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_details`
--

INSERT INTO `purchase_order_details` (`id`, `supplier_id`, `purchase_order_id`, `user_id`, `product_id`, `unit_id`, `purchase_amount`, `selling_amount`, `status`, `created_at`, `updated_at`, `quantity`, `extra_charge`, `discount`) VALUES
(488, 7, 192, 4, 29, 12, 550, 600, 1, '2023-03-21 11:52:15', '2023-03-21 11:52:15', 20, '0', '0'),
(490, 7, 198, 4, 28, 13, 50, 60, 1, '2023-03-22 01:02:59', '2023-03-22 01:02:59', 600, '0', '0'),
(491, 7, 199, 4, 29, 12, 300, 350, 1, '2023-03-22 01:04:53', '2023-03-22 01:04:53', 300, '0', '0'),
(492, 7, 199, 4, 28, 13, 50, 65, 1, '2023-03-22 01:04:53', '2023-03-22 01:04:53', 100, '0', '0'),
(493, 6, 200, 4, 29, 12, 300, 350, 1, '2023-03-22 01:04:58', '2023-03-22 01:04:58', 300, '0', '0'),
(494, 6, 200, 4, 28, 13, 50, 65, 1, '2023-03-22 01:04:58', '2023-03-22 01:04:58', 100, '0', '0'),
(495, 6, 201, 4, 29, 12, 300, 350, 1, '2023-03-22 01:04:59', '2023-03-22 01:04:59', 300, '0', '0'),
(496, 6, 201, 4, 28, 13, 50, 65, 1, '2023-03-22 01:04:59', '2023-03-22 01:04:59', 100, '0', '0'),
(497, 7, 202, 4, 29, 12, 400, 450, 1, '2023-03-24 19:45:31', '2023-03-24 19:45:31', 40, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `role_description` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'admin', 'Admin', 1, '2023-03-17 11:05:51', '2023-03-17 11:05:51', NULL),
(5, 'employee', 'employee', 1, '2023-03-17 11:06:04', '2023-03-17 11:06:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `permission_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_url`, `created_at`, `updated_at`) VALUES
(655, 4, 'users.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(656, 4, 'users.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(657, 4, 'users.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(658, 4, 'users.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(659, 4, 'users.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(660, 4, 'users.show', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(661, 4, 'users.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(662, 4, 'users.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(663, 4, 'users.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(664, 4, 'suppliers.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(665, 4, 'suppliers.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(666, 4, 'suppliers.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(667, 4, 'suppliers.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(668, 4, 'suppliers.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(669, 4, 'suppliers.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(670, 4, 'suppliers.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(671, 4, 'suppliers.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(672, 4, 'roles.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(673, 4, 'roles.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(674, 4, 'roles.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(675, 4, 'roles.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(676, 4, 'roles.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(677, 4, 'roles.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(678, 4, 'roles.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(679, 4, 'roles.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(680, 4, 'customers.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(681, 4, 'customers.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(682, 4, 'customers.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(683, 4, 'customers.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(684, 4, 'customers.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(685, 4, 'customers.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(686, 4, 'customers.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(687, 4, 'customers.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(688, 4, 'categories.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(689, 4, 'categories.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(690, 4, 'categories.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(691, 4, 'categories.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(692, 4, 'categories.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(693, 4, 'categories.show', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(694, 4, 'categories.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(695, 4, 'categories.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(696, 4, 'categories.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(697, 4, 'subcategories.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(698, 4, 'subcategories.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(699, 4, 'subcategories.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(700, 4, 'subcategories.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(701, 4, 'subcategories.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(702, 4, 'subcategories.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(703, 4, 'subcategories.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(704, 4, 'subcategories.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(705, 4, 'units.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(706, 4, 'units.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(707, 4, 'units.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(708, 4, 'units.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(709, 4, 'units.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(710, 4, 'units.show', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(711, 4, 'units.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(712, 4, 'units.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(713, 4, 'units.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(714, 4, 'products.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(715, 4, 'products.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(716, 4, 'products.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(717, 4, 'products.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(718, 4, 'products.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(719, 4, 'products.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(720, 4, 'products.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(721, 4, 'products.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(722, 4, 'products.get_unit_ajax', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(723, 4, 'expense_record.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(724, 4, 'expense_record.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(725, 4, 'expense_record.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(726, 4, 'expense_record.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(727, 4, 'expense_record.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(728, 4, 'expense_record.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(729, 4, 'expense_record.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(730, 4, 'expense_record.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(731, 4, 'expenses.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(732, 4, 'expenses.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(733, 4, 'expenses.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(734, 4, 'expenses.force_delete', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(735, 4, 'expenses.restore', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(736, 4, 'expenses.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(737, 4, 'expenses.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(738, 4, 'expenses.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(739, 4, 'expenses.show', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(740, 4, 'voucher.voucher_index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(741, 4, 'voucher.add_customer_voucher', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(742, 4, ' voucher.all_voucher_customer_ajax', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(743, 4, 'voucher.all_voucher_product_price_ajax', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(744, 4, 'voucher.create_voucher', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(745, 4, 'voucher.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(746, 4, 'voucher.print_voucher', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(747, 4, 'voucher.voucher_selected_customer', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(748, 4, 'voucher.voucher_store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(749, 4, 'purchase.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(750, 4, 'purchase.add_new_unit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(751, 4, 'purchase.add_new_supplier', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(752, 4, 'purchase.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(753, 4, 'purchase.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(754, 4, 'purchase.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(755, 4, 'purchase.ajax_all_supplier', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(756, 4, 'purchase.get_units_all_ajax', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(757, 4, 'purchase.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(758, 4, 'purchase.supplier_details', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(759, 4, 'purchase.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(760, 4, 'sales.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(761, 4, 'sales.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(762, 4, 'sales.add_new_customer', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(763, 4, 'sales.available_stock_price_ajax', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(764, 4, 'sales.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(765, 4, 'sales.customer_details', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(766, 4, 'sales.ajax_all_customer', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(767, 4, 'sales.print_sale_invoice', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(768, 4, 'sales.destroy', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(769, 4, 'sales.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(770, 4, 'sales.show', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(771, 4, 'sales.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(772, 4, 'dashboard', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(773, 4, 'logout', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(774, 5, 'suppliers.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(775, 5, 'suppliers.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(776, 5, 'suppliers.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(777, 5, 'suppliers.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(778, 5, 'suppliers.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(779, 5, 'customers.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(780, 5, 'customers.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(781, 5, 'customers.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(782, 5, 'customers.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(783, 5, 'customers.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(784, 5, 'units.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(785, 5, 'units.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(786, 5, 'units.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(787, 5, 'units.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(788, 5, 'units.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(789, 5, 'products.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(790, 5, 'products.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(791, 5, 'products.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(792, 5, 'products.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(793, 5, 'products.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(794, 5, 'products.get_unit_ajax', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(795, 5, 'expense_record.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(796, 5, 'expense_record.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(797, 5, 'expense_record.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(798, 5, 'expense_record.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(799, 5, 'expense_record.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(800, 5, 'expenses.store', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(801, 5, 'expenses.index', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(802, 5, 'expenses.create', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(803, 5, 'expenses.update', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(804, 5, 'expenses.edit', '2023-03-19 12:03:05', '2023-03-19 12:03:05'),
(805, 5, 'expenses.show', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(806, 5, 'voucher.voucher_index', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(807, 5, 'voucher.add_customer_voucher', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(808, 5, ' voucher.all_voucher_customer_ajax', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(809, 5, 'voucher.all_voucher_product_price_ajax', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(810, 5, 'voucher.create_voucher', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(811, 5, 'voucher.print_voucher', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(812, 5, 'voucher.voucher_selected_customer', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(813, 5, 'voucher.voucher_store', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(814, 5, 'purchase.index', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(815, 5, 'purchase.add_new_unit', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(816, 5, 'purchase.add_new_supplier', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(817, 5, 'purchase.create', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(818, 5, 'purchase.edit', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(819, 5, 'purchase.ajax_all_supplier', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(820, 5, 'purchase.get_units_all_ajax', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(821, 5, 'purchase.store', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(822, 5, 'purchase.supplier_details', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(823, 5, 'purchase.update', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(824, 5, 'sales.index', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(825, 5, 'sales.store', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(826, 5, 'sales.add_new_customer', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(827, 5, 'sales.available_stock_price_ajax', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(828, 5, 'sales.create', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(829, 5, 'sales.customer_details', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(830, 5, 'sales.ajax_all_customer', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(831, 5, 'sales.print_sale_invoice', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(832, 5, 'sales.update', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(833, 5, 'sales.show', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(834, 5, 'sales.edit', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(835, 5, 'dashboard', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(836, 5, 'logout', '2023-03-19 12:03:06', '2023-03-19 12:03:06'),
(837, 4, 'customers.customer_payment_index', '2023-03-20 03:05:51', '2023-03-20 03:05:51'),
(838, 4, 'customers.due_customer_billing_list', '2023-03-21 06:11:53', '2023-03-21 06:11:53'),
(839, 4, 'customers.customer_payment_create', '2023-03-21 07:00:31', '2023-03-21 07:00:31'),
(840, 4, 'customers.customer_payment_store', '2023-03-21 07:18:23', '2023-03-21 07:18:23'),
(841, 4, 'customers.customer_payment_edit_list', '2023-03-21 10:25:19', '2023-03-21 10:25:19'),
(842, 4, 'customers.customer_payment_edit_payment', '2023-03-21 10:39:54', '2023-03-21 10:39:54'),
(843, 4, 'customers.customer_payment_update', '2023-03-21 10:49:20', '2023-03-21 10:49:20'),
(844, 4, 'suppliers.due_supplier_list_index', '2023-03-21 23:53:12', '2023-03-21 23:53:12'),
(846, 4, 'suppliers.due_supplier_billing_list', '2023-03-22 04:33:04', '2023-03-22 04:33:04'),
(847, 4, 'suppliers.due_supplier_payment_create', '2023-03-22 04:56:55', '2023-03-22 04:56:55'),
(848, 4, 'suppliers.due_supplier_payment_store', '2023-03-22 05:17:18', '2023-03-22 05:17:18'),
(849, 4, 'suppliers.due_supplier_payment_edit_list', '2023-03-22 05:30:23', '2023-03-22 05:30:23'),
(850, 4, 'suppliers.due_supplier_payment_edit_page', '2023-03-22 05:41:37', '2023-03-22 05:41:37'),
(851, 4, 'suppliers.due_supplier_payment_update', '2023-03-22 06:02:51', '2023-03-22 06:02:51'),
(852, 4, 'purchase.print_purchase_invoice', '2023-03-22 07:30:02', '2023-03-22 07:30:02'),
(853, 4, 'users.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(854, 4, 'users.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(855, 4, 'users.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(856, 4, 'users.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(857, 4, 'users.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(858, 4, 'users.show', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(859, 4, 'users.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(860, 4, 'users.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(861, 4, 'users.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(862, 4, 'suppliers.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(863, 4, 'suppliers.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(864, 4, 'suppliers.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(865, 4, 'suppliers.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(866, 4, 'suppliers.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(867, 4, 'suppliers.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(868, 4, 'suppliers.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(869, 4, 'suppliers.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(870, 4, 'roles.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(871, 4, 'roles.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(872, 4, 'roles.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(873, 4, 'roles.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(874, 4, 'roles.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(875, 4, 'roles.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(876, 4, 'roles.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(877, 4, 'roles.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(878, 4, 'customers.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(879, 4, 'customers.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(880, 4, 'customers.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(881, 4, 'customers.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(882, 4, 'customers.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(883, 4, 'customers.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(884, 4, 'customers.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(885, 4, 'customers.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(886, 4, 'categories.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(887, 4, 'categories.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(888, 4, 'categories.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(889, 4, 'categories.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(890, 4, 'categories.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(891, 4, 'categories.show', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(892, 4, 'categories.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(893, 4, 'categories.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(894, 4, 'categories.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(895, 4, 'subcategories.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(896, 4, 'subcategories.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(897, 4, 'subcategories.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(898, 4, 'subcategories.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(899, 4, 'subcategories.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(900, 4, 'subcategories.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(901, 4, 'subcategories.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(902, 4, 'subcategories.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(903, 4, 'units.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(904, 4, 'units.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(905, 4, 'units.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(906, 4, 'units.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(907, 4, 'units.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(908, 4, 'units.show', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(909, 4, 'units.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(910, 4, 'units.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(911, 4, 'units.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(912, 4, 'products.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(913, 4, 'products.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(914, 4, 'products.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(915, 4, 'products.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(916, 4, 'products.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(917, 4, 'products.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(918, 4, 'products.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(919, 4, 'products.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(920, 4, 'products.get_unit_ajax', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(921, 4, 'expense_record.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(922, 4, 'expense_record.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(923, 4, 'expense_record.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(924, 4, 'expense_record.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(925, 4, 'expense_record.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(926, 4, 'expense_record.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(927, 4, 'expense_record.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(928, 4, 'expense_record.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(929, 4, 'expenses.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(930, 4, 'expenses.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(931, 4, 'expenses.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(932, 4, 'expenses.force_delete', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(933, 4, 'expenses.restore', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(934, 4, 'expenses.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(935, 4, 'expenses.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(936, 4, 'expenses.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(937, 4, 'expenses.show', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(938, 4, 'voucher.voucher_index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(939, 4, 'voucher.add_customer_voucher', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(940, 4, ' voucher.all_voucher_customer_ajax', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(941, 4, 'voucher.all_voucher_product_price_ajax', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(942, 4, 'voucher.create_voucher', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(943, 4, 'voucher.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(944, 4, 'voucher.print_voucher', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(945, 4, 'voucher.voucher_selected_customer', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(946, 4, 'voucher.voucher_store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(947, 4, 'purchase.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(948, 4, 'purchase.add_new_unit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(949, 4, 'purchase.add_new_supplier', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(950, 4, 'purchase.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(951, 4, 'purchase.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(952, 4, 'purchase.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(953, 4, 'purchase.ajax_all_supplier', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(954, 4, 'purchase.get_units_all_ajax', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(955, 4, 'purchase.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(956, 4, 'purchase.supplier_details', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(957, 4, 'purchase.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(958, 4, 'sales.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(959, 4, 'sales.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(960, 4, 'sales.add_new_customer', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(961, 4, 'sales.available_stock_price_ajax', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(962, 4, 'sales.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(963, 4, 'sales.customer_details', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(964, 4, 'sales.ajax_all_customer', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(965, 4, 'sales.print_sale_invoice', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(966, 4, 'sales.destroy', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(967, 4, 'sales.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(968, 4, 'sales.show', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(969, 4, 'sales.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(970, 4, 'dashboard', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(971, 4, 'logout', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(972, 4, 'purchase.print_purchase_invoice', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(973, 4, 'suppliers.due_supplier_list_index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(974, 4, 'suppliers.due_supplier_billing_list', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(975, 4, 'suppliers.due_supplier_payment_create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(976, 4, 'suppliers.due_supplier_payment_store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(977, 4, 'suppliers.due_supplier_payment_edit_list', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(978, 4, 'suppliers.due_supplier_payment_edit_page', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(979, 4, 'suppliers.due_supplier_payment_update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(980, 4, 'customers.customer_payment_index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(981, 4, 'customers.customer_payment_create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(982, 4, 'customers.customer_payment_store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(983, 4, 'customers.due_customer_billing_list', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(984, 4, 'customers.customer_payment_edit_list', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(985, 4, 'customers.customer_payment_edit_payment', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(986, 4, 'customers.customer_payment_update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(987, 4, 'report_index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(988, 4, 'stock_report_index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(989, 4, 'sales_voucher_report_index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(990, 4, 'sales_voucher_details_list', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(991, 4, 'sales_voucher_weekly_report', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(992, 4, 'sales_voucher_daily_report', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(993, 4, 'sales_voucher_weekly_report', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(994, 4, 'sales_voucher_monthly_report', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(995, 4, 'sales_voucher_yearly_report', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(996, 4, 'expense_record_daily_report', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(997, 4, 'expense_record_weekly_report', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(998, 4, 'expense_record_monthly_report', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(999, 4, 'expense_record_yearly_report', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1000, 4, 'gross_profit_index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1001, 4, 'gross_profit_daily', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1002, 4, 'gross_profit_weekly', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1003, 4, 'gross_profit_monthly', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1004, 4, 'gross_profit_yearly', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1005, 4, 'net_profit_index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1006, 4, 'net_profit_daily', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1007, 4, 'net_profit_weekly', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1008, 4, 'net_profit_monthly', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1009, 4, 'net_profit_yearly', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1010, 5, 'suppliers.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1011, 5, 'suppliers.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1012, 5, 'suppliers.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1013, 5, 'suppliers.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1014, 5, 'suppliers.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1015, 5, 'customers.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1016, 5, 'customers.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1017, 5, 'customers.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1018, 5, 'customers.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1019, 5, 'customers.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1020, 5, 'units.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1021, 5, 'units.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1022, 5, 'units.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1023, 5, 'units.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1024, 5, 'units.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1025, 5, 'products.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1026, 5, 'products.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1027, 5, 'products.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1028, 5, 'products.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1029, 5, 'products.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1030, 5, 'products.get_unit_ajax', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1031, 5, 'expense_record.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1032, 5, 'expense_record.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1033, 5, 'expense_record.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1034, 5, 'expense_record.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1035, 5, 'expense_record.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1036, 5, 'expenses.store', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1037, 5, 'expenses.index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1038, 5, 'expenses.create', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1039, 5, 'expenses.update', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1040, 5, 'expenses.edit', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1041, 5, 'expenses.show', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1042, 5, 'voucher.voucher_index', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1043, 5, 'voucher.add_customer_voucher', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1044, 5, ' voucher.all_voucher_customer_ajax', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1045, 5, 'voucher.all_voucher_product_price_ajax', '2023-06-13 01:50:56', '2023-06-13 01:50:56'),
(1046, 5, 'voucher.create_voucher', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1047, 5, 'voucher.print_voucher', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1048, 5, 'voucher.voucher_selected_customer', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1049, 5, 'voucher.voucher_store', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1050, 5, 'purchase.index', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1051, 5, 'purchase.add_new_unit', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1052, 5, 'purchase.add_new_supplier', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1053, 5, 'purchase.create', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1054, 5, 'purchase.edit', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1055, 5, 'purchase.ajax_all_supplier', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1056, 5, 'purchase.get_units_all_ajax', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1057, 5, 'purchase.store', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1058, 5, 'purchase.supplier_details', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1059, 5, 'purchase.update', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1060, 5, 'sales.index', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1061, 5, 'sales.store', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1062, 5, 'sales.add_new_customer', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1063, 5, 'sales.available_stock_price_ajax', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1064, 5, 'sales.create', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1065, 5, 'sales.customer_details', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1066, 5, 'sales.ajax_all_customer', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1067, 5, 'sales.print_sale_invoice', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1068, 5, 'sales.update', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1069, 5, 'sales.show', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1070, 5, 'sales.edit', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1071, 5, 'dashboard', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1072, 5, 'logout', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1073, 5, 'purchase.print_purchase_invoice', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1074, 5, 'suppliers.due_supplier_list_index', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1075, 5, 'suppliers.due_supplier_billing_list', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1076, 5, 'suppliers.due_supplier_payment_create', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1077, 5, 'suppliers.due_supplier_payment_store', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1078, 5, 'suppliers.due_supplier_payment_edit_list', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1079, 5, 'suppliers.due_supplier_payment_edit_page', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1080, 5, 'suppliers.due_supplier_payment_update', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1081, 5, 'customers.customer_payment_index', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1082, 5, 'customers.customer_payment_create', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1083, 5, 'customers.customer_payment_store', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1084, 5, 'customers.due_customer_billing_list', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1085, 5, 'customers.customer_payment_edit_list', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1086, 5, 'customers.customer_payment_edit_payment', '2023-06-13 01:50:57', '2023-06-13 01:50:57'),
(1087, 5, 'customers.customer_payment_update', '2023-06-13 01:50:57', '2023-06-13 01:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `billing_amount` bigint(20) DEFAULT NULL,
  `paid_amount` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `extra_charge` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `customer_id`, `user_id`, `billing_amount`, `paid_amount`, `status`, `created_at`, `updated_at`, `extra_charge`, `discount`) VALUES
(404, 30, 4, 1000, 1000, 1, '2023-03-20 08:51:45', '2023-03-21 11:42:32', NULL, NULL),
(405, 30, 4, 30000, 23000, 1, '2023-03-20 08:52:20', '2023-03-31 03:32:39', NULL, NULL),
(406, 30, 4, 10000, 8000, 1, '2023-03-20 08:52:56', '2023-03-21 07:39:06', NULL, NULL),
(407, 11, 4, 130, 130, 0, '2023-03-24 19:09:40', '2023-03-24 19:09:40', NULL, NULL),
(408, 29, 4, 310, 30, 1, '2023-04-06 13:03:02', '2023-04-06 13:03:02', NULL, NULL),
(409, 31, 4, 620, NULL, 1, '2023-04-06 13:08:33', '2023-04-06 13:08:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_details`
--

CREATE TABLE `sale_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_selling_price` bigint(20) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `extra_charge` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_order_details`
--

INSERT INTO `sale_order_details` (`id`, `customer_id`, `sale_order_id`, `user_id`, `product_id`, `unit_id`, `product_selling_price`, `quantity`, `discount`, `status`, `extra_charge`, `created_at`, `updated_at`) VALUES
(521, 30, 404, 4, 28, 13, 200, 5, 0.00, 1, 0.00, '2023-03-20 08:51:45', '2023-03-20 08:51:45'),
(522, 30, 405, 4, 29, 12, 600, 50, 0.00, 1, 0.00, '2023-03-20 08:52:20', '2023-03-20 08:52:20'),
(523, 30, 406, 4, 28, 13, 200, 50, 0.00, 1, 0.00, '2023-03-20 08:52:56', '2023-03-20 08:52:56'),
(524, 11, 407, 4, 28, 13, 65, 2, 0.00, 0, 0.00, '2023-03-24 19:09:40', '2023-03-24 19:09:40'),
(525, 29, 408, 4, 30, 13, 31, 10, 0.00, 1, 0.00, '2023-04-06 13:03:02', '2023-04-06 13:03:02'),
(526, 31, 409, 4, 30, 13, 31, 4, 0.00, 1, 0.00, '2023-04-06 13:08:33', '2023-04-06 13:08:33'),
(527, 31, 409, 4, 30, 13, 31, 4, 0.00, 1, 0.00, '2023-04-06 13:08:33', '2023-04-06 13:08:33'),
(528, 31, 409, 4, 30, 13, 31, 4, 0.00, 1, 0.00, '2023-04-06 13:08:33', '2023-04-06 13:08:33'),
(529, 31, 409, 4, 30, 13, 31, 4, 0.00, 1, 0.00, '2023-04-06 13:08:33', '2023-04-06 13:08:33'),
(530, 31, 409, 4, 30, 13, 31, 4, 0.00, 1, 0.00, '2023-04-06 13:08:33', '2023-04-06 13:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `purchase_amount` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `selling_amount` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `unit_id`, `quantity`, `purchase_amount`, `created_at`, `updated_at`, `supplier_id`, `purchase_order_id`, `selling_amount`) VALUES
(455, 29, 12, 20, 550, '2023-03-21 11:52:15', '2023-03-21 11:52:15', 7, 192, 600),
(457, 28, 13, 598, 50, '2023-03-22 01:02:59', '2023-03-24 19:09:40', 7, 198, 60),
(458, 29, 12, 300, 300, '2023-03-22 01:04:53', '2023-03-22 01:04:53', 7, 199, 350),
(459, 28, 13, 100, 50, '2023-03-22 01:04:53', '2023-03-22 01:04:53', 7, 199, 65),
(460, 29, 12, 300, 300, '2023-03-22 01:04:58', '2023-03-22 01:04:58', 6, 200, 350),
(461, 28, 13, 100, 50, '2023-03-22 01:04:58', '2023-03-22 01:04:58', 6, 200, 65),
(462, 29, 12, 300, 300, '2023-03-22 01:04:59', '2023-03-22 01:04:59', 6, 201, 350),
(463, 28, 13, 100, 50, '2023-03-22 01:04:59', '2023-03-22 01:04:59', 6, 201, 65),
(464, 29, 12, 40, 400, '2023-03-24 19:45:31', '2023-03-24 19:45:31', 7, 202, 450);

-- --------------------------------------------------------

--
-- Table structure for table `stock_counts`
--

CREATE TABLE `stock_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_quantity` bigint(20) DEFAULT NULL,
  `currently_product_selling_price` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currently_product_purchase_price` bigint(20) DEFAULT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_counts`
--

INSERT INTO `stock_counts` (`id`, `product_id`, `unit_id`, `user_id`, `total_quantity`, `currently_product_selling_price`, `status`, `created_at`, `updated_at`, `currently_product_purchase_price`, `subcategory_id`, `deleted_at`) VALUES
(29, 28, 13, 4, 3398, 65, 1, '2023-03-07 06:42:15', '2023-03-24 19:09:40', 50, 5, NULL),
(30, 29, 12, 4, 3260, 450, 1, '2023-03-07 06:42:50', '2023-03-24 19:45:31', 400, 6, NULL),
(31, 28, 12, 4, 0, 200, 1, '2023-03-24 19:46:35', '2023-03-30 22:36:02', 100, NULL, NULL),
(32, 30, 13, 4, 470, 31, 1, '2023-03-31 03:14:20', '2023-04-06 13:08:33', 29, 5, NULL),
(33, 31, 12, 4, 125, 95, 1, '2023-04-03 01:55:57', '2023-04-03 01:55:57', 65, 5, NULL),
(34, 32, 12, 4, 150, 90, 1, '2023-04-03 01:57:18', '2023-04-03 01:57:18', 60, 5, NULL),
(35, 33, 12, 4, 154, 85, 1, '2023-04-03 01:58:29', '2023-04-03 01:58:29', 45, 5, NULL),
(36, 34, 12, 4, 180, 145, 1, '2023-04-03 02:00:02', '2023-04-03 02:00:02', 126, 5, NULL),
(37, 35, 12, 4, 100, 145, 1, '2023-04-03 02:01:02', '2023-04-03 02:01:02', 115, 5, NULL),
(38, 36, 12, 4, 150, 27, 1, '2023-04-03 02:03:07', '2023-04-03 02:03:07', 17, 5, NULL),
(39, 37, 12, 4, 140, 65, 1, '2023-04-03 02:04:11', '2023-04-03 02:04:11', 45, 5, NULL),
(40, 38, 12, 4, 150, 115, 1, '2023-04-03 02:05:34', '2023-04-03 02:05:34', 85, 5, NULL),
(41, 39, 12, 4, 165, 95, 1, '2023-04-03 02:08:23', '2023-04-03 02:08:23', 70, 5, NULL),
(42, 40, 12, 4, 120, 90, 1, '2023-04-03 02:09:29', '2023-04-03 02:09:29', 60, 5, NULL),
(43, 41, 12, 4, 82, 70, 1, '2023-04-03 02:10:42', '2023-04-03 02:10:42', 45, 5, NULL),
(44, 42, 12, 4, 45, 185, 1, '2023-04-03 02:12:36', '2023-04-03 02:31:35', 133, 5, NULL),
(45, 43, 12, 4, 26, 380, 1, '2023-04-03 02:16:10', '2023-04-03 02:16:10', 270, 5, NULL),
(46, 44, 12, 4, 13, 890, 1, '2023-04-03 02:17:10', '2023-04-03 02:17:10', 395, 5, NULL),
(47, 45, 12, 4, 35, 170, 1, '2023-04-03 02:18:13', '2023-04-03 02:18:13', 105, 5, NULL),
(48, 46, 12, 4, 30, 175, 1, '2023-04-03 02:19:39', '2023-04-03 02:19:39', 140, 5, NULL),
(49, 47, 13, 4, 400, 16, 1, '2023-04-03 02:21:00', '2023-04-03 02:21:00', 10, 5, NULL),
(50, 48, 12, 4, 40, 125, 1, '2023-04-03 02:22:06', '2023-04-03 02:22:06', 85, 5, NULL),
(51, 49, 12, 4, 30, 65, 1, '2023-04-03 02:22:57', '2023-04-03 02:22:57', 37, 5, NULL),
(52, 50, 12, 4, 45, 45, 1, '2023-04-03 02:24:01', '2023-04-03 02:24:01', 19, 5, NULL),
(53, 51, 12, 4, 45, 49, 1, '2023-04-03 02:24:35', '2023-04-03 02:24:35', 25, 5, NULL),
(54, 52, 12, 4, 45, 95, 1, '2023-04-03 02:25:42', '2023-04-03 02:25:42', 73, 5, NULL),
(55, 53, 12, 4, 16, 150, 1, '2023-04-03 02:26:48', '2023-04-03 02:26:48', 75, 5, NULL),
(56, 54, 12, 4, 35, 16, 1, '2023-04-03 02:28:17', '2023-04-03 02:28:17', 9, 5, NULL),
(57, 55, 12, 4, 30, 215, 1, '2023-04-03 02:30:05', '2023-04-03 02:30:05', 165, 5, NULL),
(58, 56, 12, 4, 25, 85, 1, '2023-04-03 02:32:50', '2023-04-03 02:32:50', 48, 5, NULL),
(59, 57, 12, 4, 70, 130, 1, '2023-04-03 02:33:42', '2023-04-03 02:33:42', 85, 5, NULL),
(60, 58, 12, 4, 100, 110, 1, '2023-04-03 02:37:36', '2023-04-03 02:37:36', 62, 5, NULL),
(61, 59, 12, 4, 130, 160, 1, '2023-04-03 02:40:22', '2023-04-03 02:40:22', 110, 5, NULL),
(62, 60, 12, 4, 10, 130, 1, '2023-04-03 02:42:02', '2023-04-03 02:42:02', 75, 5, NULL),
(63, 61, 12, 4, 50, 50, 1, '2023-04-03 02:48:18', '2023-04-03 02:48:18', 30, 5, NULL),
(64, 62, 12, 4, 30, 40, 1, '2023-04-03 02:51:07', '2023-04-03 02:51:07', 20, 5, NULL),
(65, 63, 12, 4, 4, 900, 1, '2023-04-03 02:52:41', '2023-04-03 02:52:41', 70, 5, NULL),
(66, 64, 12, 4, 10, 520, 1, '2023-04-03 02:57:12', '2023-04-03 02:57:12', 360, 5, NULL),
(67, 65, 12, 4, 80, 510, 1, '2023-04-03 03:37:55', '2023-04-03 03:37:55', 280, 5, NULL),
(68, 66, 12, 4, 15, 100, 1, '2023-04-03 03:39:06', '2023-04-03 03:39:06', 40, 5, NULL),
(69, 67, 12, 4, 15, 40, 1, '2023-04-03 03:41:09', '2023-04-03 03:41:09', 25, 5, NULL),
(70, 68, 12, 4, 1, 850, 1, '2023-04-03 03:42:34', '2023-04-03 03:42:34', 650, 5, NULL),
(71, 69, 12, 4, 9, 410, 1, '2023-04-03 03:43:27', '2023-04-03 03:43:27', 190, 5, NULL),
(72, 70, 12, 4, 25, 25, 1, '2023-04-03 03:44:54', '2023-04-03 03:44:54', 10, 5, NULL),
(73, 71, 12, 4, 25, 45, 1, '2023-04-03 03:45:35', '2023-04-03 03:45:35', 10, 5, NULL),
(74, 72, 12, 4, 450, 5, 1, '2023-04-03 03:46:54', '2023-04-03 03:46:54', 3, 5, NULL),
(75, 73, 12, 4, 33, 1750, 1, '2023-04-03 03:48:47', '2023-04-03 03:48:47', 1290, 5, NULL),
(76, 74, 12, 4, 2, 1800, 1, '2023-04-03 03:49:40', '2023-04-03 03:49:40', 1400, 5, NULL),
(77, 75, 12, 4, 6, 1850, 1, '2023-04-03 03:50:37', '2023-04-03 03:50:37', 1300, 5, NULL),
(78, 76, 12, 4, 25, 110, 1, '2023-04-03 03:51:38', '2023-04-03 03:51:38', 45, 5, NULL),
(79, 77, 12, 4, 8, 1650, 1, '2023-04-03 03:54:30', '2023-04-03 03:54:30', 1150, 5, NULL),
(80, 78, 12, 4, 1200, 2, 1, '2023-04-03 03:57:12', '2023-04-03 03:57:12', 1, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) DEFAULT NULL,
  `subcategory_description` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `subcategory_name`, `subcategory_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 6, 'test_subcategory', 'test_subcategory', 1, '2023-02-27 00:47:03', '2023-02-27 00:47:03', NULL),
(6, 6, 'test_subcategory_2', 'test_2', 1, '2023-02-27 04:08:22', '2023-02-27 04:08:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `phone_1` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `phone_1`, `address`, `status`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'demo_supplier', '01716994848', 'demo_supplier', 1, 'Please Dont delete this supplier', '2023-03-05 22:23:32', '2023-03-07 05:56:55', NULL),
(7, 'Hayley Ryan', '01676058950', 'Provident omnis nat', 0, 'Velit rem fugit id', '2023-03-19 04:09:36', '2023-03-19 04:09:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payment_details`
--

CREATE TABLE `supplier_payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paid_amount` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_payment_details`
--

INSERT INTO `supplier_payment_details` (`id`, `purchase_order_id`, `supplier_id`, `paid_amount`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(2, 198, 7, 1000, 1, NULL, '2023-03-22 01:02:59', '2023-03-22 01:02:59'),
(3, 199, 7, 10000, 1, NULL, '2023-03-22 01:04:53', '2023-03-22 01:04:53'),
(4, 200, 6, 10000, 1, NULL, '2023-03-22 01:04:58', '2023-03-22 01:04:58'),
(5, 201, 6, 10000, 1, NULL, '2023-03-22 01:04:59', '2023-03-22 01:04:59'),
(7, 199, 7, 4500, 1, NULL, '2023-03-22 05:24:53', '2023-03-22 06:06:10'),
(8, 202, 7, 8000, 1, NULL, '2023-03-24 19:45:31', '2023-03-24 19:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `unit_description` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `unit_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'pcs', 'piece', 1, '2023-02-27 00:45:18', '2023-02-27 00:45:18', NULL),
(13, 'feet', 'test_feet', 1, '2023-02-27 04:08:55', '2023-02-27 04:08:55', NULL),
(14, 'inch', 'inch', 1, '2023-03-01 12:03:42', '2023-03-01 12:03:42', NULL),
(19, 'KG', NULL, 1, '2023-04-03 03:59:58', '2023-04-03 03:59:58', NULL),
(20, 'KG', NULL, 1, '2023-04-03 03:59:59', '2023-04-03 03:59:59', NULL),
(21, 'KG', 'KILOGRAM', 1, '2023-04-03 04:00:09', '2023-04-03 04:00:09', NULL),
(22, 'KG', 'KILOGRAM', 1, '2023-04-03 04:00:10', '2023-04-03 04:00:10', NULL),
(23, 'LITER', NULL, 1, '2023-04-03 04:00:55', '2023-04-03 04:00:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `role_id`) VALUES
(4, 'admin', 'admin@gmail.com', '9999999', 'hhhh', NULL, '$2y$10$feLJ5DbaM7cjL5hLzB5fZupRgdnYKaUsoYwZUXYEHIknjd10QyEvi', 1, NULL, '2023-02-24 04:12:18', '2023-03-18 02:29:58', NULL, 4),
(5, 'Employee', 'employee@gmail.com', '01676058944', 'N/A', NULL, '$2y$10$IS9Utq9Y8WTh2CV7Wll3Pe3TEOtk8lJjNi7AsTFSWzSciGhgCWuWO', 1, NULL, '2023-03-18 02:24:41', '2023-03-18 02:29:47', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `billing_amount` bigint(20) DEFAULT NULL,
  `discount` bigint(20) DEFAULT NULL,
  `extra_charge` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `customer_id`, `billing_amount`, `discount`, `extra_charge`, `created_at`, `updated_at`,`deleted_at`) VALUES
(6, 11, 4000, 0, 0, '2023-03-17 11:50:02', '2023-03-17 11:50:02',NULL),
(7, 11, 930, 0, 0, '2023-03-31 03:25:36', '2023-03-31 03:25:36',NULL),
(8, 11, 930, 0, 0, '2023-04-05 04:21:36', '2023-04-05 04:21:36',NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_details`
--

CREATE TABLE `voucher_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `voucher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_price` bigint(20) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subtotal` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voucher_details`
--

INSERT INTO `voucher_details` (`id`, `product_id`, `voucher_id`, `unit_id`, `product_price`, `quantity`, `created_at`, `updated_at`, `subtotal`) VALUES
(10, 28, 6, 13, 200, 5, '2023-03-17 11:50:02', '2023-03-17 11:50:02', 1000),
(11, 29, 6, 12, 600, 5, '2023-03-17 11:50:02', '2023-03-17 11:50:02', 3000),
(12, 30, 7, 13, 31, 30, '2023-03-31 03:25:36', '2023-03-31 03:25:36', 930),
(13, 30, 8, 13, 31, 30, '2023-04-05 04:21:36', '2023-04-05 04:21:36', 930);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

--
-- Indexes for table `customer_payment_details`
--
ALTER TABLE `customer_payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_payment_details_sale_order_id_foreign` (`sale_order_id`),
  ADD KEY `customer_payment_details_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_records`
--
ALTER TABLE `expense_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_records_user_id_foreign` (`user_id`);

--
-- Indexes for table `expense_record_details`
--
ALTER TABLE `expense_record_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_record_details_expense_id_foreign` (`expense_id`),
  ADD KEY `expense_record_details_expense_record_id_foreign` (`expense_record_id`);

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
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_orders_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchase_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_details_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchase_order_details_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `purchase_order_details_user_id_foreign` (`user_id`),
  ADD KEY `purchase_order_details_product_id_foreign` (`product_id`),
  ADD KEY `purchase_order_details_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `sale_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `sale_order_details`
--
ALTER TABLE `sale_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_order_details_customer_id_foreign` (`customer_id`),
  ADD KEY `sale_order_details_sale_order_id_foreign` (`sale_order_id`),
  ADD KEY `sale_order_details_user_id_foreign` (`user_id`),
  ADD KEY `sale_order_details_product_id_foreign` (`product_id`),
  ADD KEY `sale_order_details_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`),
  ADD KEY `stocks_unit_id_foreign` (`unit_id`),
  ADD KEY `stocks_supplier_id_foreign` (`supplier_id`),
  ADD KEY `stocks_purchase_order_id_foreign` (`purchase_order_id`);

--
-- Indexes for table `stock_counts`
--
ALTER TABLE `stock_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_counts_user_id_foreign` (`user_id`),
  ADD KEY `stock_counts_product_id_foreign` (`product_id`),
  ADD KEY `stock_counts_unit_id_foreign` (`unit_id`),
  ADD KEY `stock_counts_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_phone_1_unique` (`phone_1`);

--
-- Indexes for table `supplier_payment_details`
--
ALTER TABLE `supplier_payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_payment_details_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `supplier_payment_details_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vouchers_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `voucher_details`
--
ALTER TABLE `voucher_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_details_product_id_foreign` (`product_id`),
  ADD KEY `voucher_details_unit_id_foreign` (`unit_id`),
  ADD KEY `voucher_details_voucher_id_foreign` (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `customer_payment_details`
--
ALTER TABLE `customer_payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense_records`
--
ALTER TABLE `expense_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expense_record_details`
--
ALTER TABLE `expense_record_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1088;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=410;

--
-- AUTO_INCREMENT for table `sale_order_details`
--
ALTER TABLE `sale_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=531;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT for table `stock_counts`
--
ALTER TABLE `stock_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier_payment_details`
--
ALTER TABLE `supplier_payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `voucher_details`
--
ALTER TABLE `voucher_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_payment_details`
--
ALTER TABLE `customer_payment_details`
  ADD CONSTRAINT `customer_payment_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_payment_details_sale_order_id_foreign` FOREIGN KEY (`sale_order_id`) REFERENCES `sale_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expense_records`
--
ALTER TABLE `expense_records`
  ADD CONSTRAINT `expense_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expense_record_details`
--
ALTER TABLE `expense_record_details`
  ADD CONSTRAINT `expense_record_details_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expense_record_details_expense_record_id_foreign` FOREIGN KEY (`expense_record_id`) REFERENCES `expense_records` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD CONSTRAINT `purchase_order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_details_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_details_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_details_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD CONSTRAINT `sale_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_order_details`
--
ALTER TABLE `sale_order_details`
  ADD CONSTRAINT `sale_order_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_order_details_sale_order_id_foreign` FOREIGN KEY (`sale_order_id`) REFERENCES `sale_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_order_details_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_order_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_counts`
--
ALTER TABLE `stock_counts`
  ADD CONSTRAINT `stock_counts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_counts_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_counts_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_counts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplier_payment_details`
--
ALTER TABLE `supplier_payment_details`
  ADD CONSTRAINT `supplier_payment_details_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplier_payment_details_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `voucher_details`
--
ALTER TABLE `voucher_details`
  ADD CONSTRAINT `voucher_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `voucher_details_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `voucher_details_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
