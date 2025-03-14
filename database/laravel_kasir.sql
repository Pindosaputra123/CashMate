-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2025 at 06:53 AM
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
-- Database: `laravel_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kode`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, '001', 'Beras', 12000, '2025-03-01 21:32:49', '2025-03-01 21:32:49'),
(2, '003', 'Terigu', 7000, '2025-03-01 21:33:17', '2025-03-01 21:33:17'),
(3, '004', 'Mie Instant', 3000, '2025-03-01 21:33:31', '2025-03-01 21:33:31'),
(4, '005', 'Telur', 28000, '2025-03-01 21:33:48', '2025-03-01 21:40:12'),
(5, '006', 'Kopi', 2500, '2025-03-01 21:34:21', '2025-03-01 21:34:21'),
(6, '007', 'Sabun', 3000, '2025-03-01 21:34:46', '2025-03-01 21:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `code`, `name`, `telepon`, `created_at`, `updated_at`) VALUES
(1, '0001', 'Pindo Saputra', 81234567890, '2025-03-01 21:39:10', '2025-03-01 21:39:10'),
(2, '0002', 'Muhammad Bayu', 81234567890, '2025-03-01 21:48:32', '2025-03-01 21:48:32'),
(3, '0003', 'Frans Christiopan', 81234567890, '2025-03-01 21:48:56', '2025-03-01 21:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2024_08_01_063518_create_customers_table', 1),
(4, '2024_08_01_063632_create_barangs_table', 1),
(5, '2024_08_01_063651_create_sales_table', 1),
(6, '2024_08_01_063659_create_sale_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `cust_id` int NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `diskon` decimal(8,2) NOT NULL,
  `ongkir` decimal(8,2) NOT NULL,
  `total_bayar` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `code`, `tanggal`, `cust_id`, `subtotal`, `diskon`, `ongkir`, `total_bayar`, `created_at`, `updated_at`) VALUES
(1, '0001/TRANS/SINERGY/III/2025', '2025-03-02', 2, '44000.00', '0.00', '0.00', '44000.00', '2025-03-01 21:41:09', '2025-03-01 21:41:09'),
(2, '0002/TRANS/SINERGY/III/2025', '2025-03-01', 4, '5000.00', '0.00', '0.00', '5000.00', '2025-03-01 21:49:28', '2025-03-01 21:49:28'),
(5, '0003/TRANS/SINERGY/III/2025', '2025-02-28', 3, '24000.00', '0.00', '0.00', '24000.00', '2025-03-01 21:52:17', '2025-03-01 21:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint UNSIGNED NOT NULL,
  `sales_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga_bandrol` decimal(8,2) NOT NULL,
  `qty` int NOT NULL,
  `diskon_pct` decimal(8,2) NOT NULL,
  `diskon_nilai` decimal(8,2) NOT NULL,
  `harga_diskon` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sales_id`, `barang_id`, `harga_bandrol`, `qty`, `diskon_pct`, `diskon_nilai`, `harga_diskon`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '5000.00', 1, '0.00', '0.00', '5000.00', '5000.00', '2024-12-28 17:11:46', '2024-12-28 17:11:46'),
(2, 1, 2, '10000.00', 2, '10.00', '1000.00', '9000.00', '18000.00', '2024-12-28 17:11:46', '2024-12-28 17:11:46'),
(3, 2, 4, '16000.00', 1, '0.00', '0.00', '16000.00', '16000.00', '2025-03-01 21:41:09', '2025-03-01 21:41:09'),
(4, 2, 7, '28000.00', 1, '0.00', '0.00', '28000.00', '28000.00', '2025-03-01 21:41:09', '2025-03-01 21:41:09'),
(5, 3, 8, '2500.00', 2, '0.00', '0.00', '2500.00', '5000.00', '2025-03-01 21:49:28', '2025-03-01 21:49:28'),
(6, 4, 3, '12000.00', 3, '0.00', '0.00', '12000.00', '36000.00', '2025-03-01 21:50:00', '2025-03-01 21:50:00'),
(7, 5, 3, '12000.00', 2, '0.00', '0.00', '12000.00', '24000.00', '2025-03-01 21:52:17', '2025-03-01 21:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', '$2y$12$uPsg564l/I8p8NUXniJoqOB5YV33LXUBJ2XK1P7qVSPkPoQre3Rgm', '08123456789', '2024-12-28 17:06:55', '2024-12-28 17:17:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
