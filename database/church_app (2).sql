-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2022 at 09:10 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `church_app`
--

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
(1, '2020_08_26_130133_create_sms_units_table', 1),
(2, '2020_08_31_074922_create_mpesa_callbacks_table', 2),
(3, '2020_08_31_093436_create_sms_topups_table', 2),
(4, '2020_08_31_093939_create_sms_rates_table', 2),
(5, '2020_08_31_100340_modify_sms_units_table', 2),
(6, '2020_09_01_231642_create_networks_table', 3),
(7, '2020_09_01_235512_add_cost_to_tbl_sms_log_table', 4),
(11, '2020_09_02_000617_change_units_column_type_to_sms_units_table', 5),
(12, '2020_09_04_080613_add_national_id_to_members_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0046f225cd099e25b2d3fca115395f5658803ae3a1fdbdaca5150b8f4faaf3f7bea744791437a812', 24, 1, 'authToken', '[]', 0, '2020-08-19 06:50:27', '2020-08-19 06:50:27', '2021-08-19 06:50:27'),
('17c5fd66c46be51d1816e84f2f2b33db6ca95a1592bdaf9936e4cdb9f94370005392ab20740a2855', 13, 1, 'authToken', '[]', 0, '2020-08-19 06:50:59', '2020-08-19 06:50:59', '2021-08-19 06:50:59'),
('18c3dc57761202976708a9ae17ed6e329a022a292268fb3c870402d683b613d8d2f721c96d88e452', 13, 2, NULL, '[]', 0, '2020-07-30 08:15:37', '2020-07-30 08:15:37', '2021-07-30 08:15:37'),
('1b9ff461fda93f89ffb7965df29019af1506bc99c991b168c56977c43298ad0313b86aad352aedd5', 7, 1, 'authToken', '[]', 0, '2020-08-03 19:27:09', '2020-08-03 19:27:09', '2021-08-03 19:27:09'),
('1f3f6874d378a63db7e04404622e23b9580f36d37c7abff14634e4c7e5682af872298326bc8698bf', 6, 1, 'authToken', '[]', 0, '2020-07-31 13:47:51', '2020-07-31 13:47:51', '2021-07-31 13:47:51'),
('2ab7eca5573b580c3ac86eee4467b069c142283d2efa31562985ee25b1c944082a56e41efb39b9d8', 23, 2, NULL, '[]', 0, '2020-08-07 09:18:28', '2020-08-07 09:18:28', '2021-08-07 09:18:28'),
('2ef180f8f33c339b5dd7e6d8a8bb4889c7b8ec8bd63622408509375dd991a74d35c84d533a0a92f7', 14, 2, NULL, '[]', 0, '2020-07-30 10:03:33', '2020-07-30 10:03:33', '2021-07-30 10:03:33'),
('2fa6c306ed462746715fd4186de72e5f3523ee8a4eab9b2681301b16e1046aed5950cde9ce4484a3', 21, 2, NULL, '[]', 0, '2020-08-04 19:56:48', '2020-08-04 19:56:48', '2021-08-04 19:56:48'),
('38cd64f06b673caf81918e93d905f06eb5db7c29086911cdf62d8a171bff1d79ef445fc331d2a271', 7, 1, 'authToken', '[]', 0, '2020-07-30 08:15:14', '2020-07-30 08:15:14', '2021-07-30 08:15:14'),
('4ca95194990fff1c86ebfb55a71c6419cf5fbc40de724639fbb44ba69750e0208fca6c17a4da51a0', 13, 1, 'authToken', '[]', 0, '2020-07-30 08:15:37', '2020-07-30 08:15:37', '2021-07-30 08:15:37'),
('57ceb0117220f1f3303926f98edd4b709f65a039557d596744bb9306a0ca1144396f0ba307bb7267', 23, 1, 'authToken', '[]', 0, '2020-08-07 09:19:15', '2020-08-07 09:19:15', '2021-08-07 09:19:15'),
('66e405e41cceb5d4f78ccd8109c71961dcf420578e07dc225d0f52f6f54b27e37fc31469bddaac6c', 23, 1, 'authToken', '[]', 0, '2020-08-07 09:23:14', '2020-08-07 09:23:14', '2021-08-07 09:23:14'),
('76f8aa38652c8e8771b87e31e28b48f6e4483f4355c4313cb110a866a678812508ae1806b80f12f9', 7, 1, 'authToken', '[]', 0, '2020-07-30 10:02:24', '2020-07-30 10:02:24', '2021-07-30 10:02:24'),
('81724ecd1c1dbcab3acf8a3cf6c3eebc6e64315f52e2a8fb06dd397dcc8b2d5964cf7835e63b4866', 5, 1, 'authToken', '[]', 0, '2020-07-31 11:23:39', '2020-07-31 11:23:39', '2021-07-31 11:23:39'),
('88ec48cd7d306df30dcb92916d203fc7ffbeec6815e2c2cf16cde6c61bcd947a8d2d0c7536b2cb32', 15, 1, 'authToken', '[]', 0, '2020-07-31 13:51:50', '2020-07-31 13:51:50', '2021-07-31 13:51:50'),
('98fad9514e3fb0f38d9257b4d5cdee6a360e811e8aebdcd9d1a42ec0352d733e0a37c413e4c8c5bd', 7, 1, 'authToken', '[]', 0, '2020-07-30 08:15:14', '2020-07-30 08:15:14', '2021-07-30 08:15:14'),
('b63033b3257b6d1c45f6fd88940ed71aecb781717bae54f490370b1dd7b7474d7079400522b6fd71', 15, 1, 'authToken', '[]', 0, '2020-07-31 13:52:24', '2020-07-31 13:52:24', '2021-07-31 13:52:24'),
('b864ff6570e4c4dd1e26cf728d0110a9d9f14f7296d1ceddc560cf0b3a73e8092bad7cf3d0751f8c', 24, 2, NULL, '[]', 0, '2020-08-19 06:50:27', '2020-08-19 06:50:27', '2021-08-19 06:50:27'),
('ba61e1469bebd65daf3e58c04a89e33981b33557843f6c4fb03c92f0cf79101f1b393f20101159ff', 6, 1, 'authToken', '[]', 0, '2020-07-30 13:35:55', '2020-07-30 13:35:55', '2021-07-30 13:35:55'),
('bf6185fb62aff735900e14077dc69f1b036785520ea5c7c0cf21a9b1574e5e8d82c040127d0042df', 7, 1, 'authToken', '[]', 0, '2020-07-30 08:14:24', '2020-07-30 08:14:24', '2021-07-30 08:14:24'),
('c4652336ad39a1275e5c5a0bd5d2f31793a318a46b0fa81099fdfe4eddcf43647eaf4cf5f6e728ff', 7, 1, 'authToken', '[]', 0, '2020-07-30 08:08:39', '2020-07-30 08:08:39', '2021-07-30 08:08:39'),
('c894363474f4193e596439f59823686ba83266bcd8fcad8eea750b90c199d072c704bd9ae48dc0c0', 14, 1, 'authToken', '[]', 0, '2020-07-30 10:05:04', '2020-07-30 10:05:04', '2021-07-30 10:05:04'),
('c8d9e3f20809c03933dad14e2255e3fab04b4356133a854137d979ac18e65e5cff5dcea412a0415d', 21, 1, 'authToken', '[]', 0, '2020-08-04 19:56:49', '2020-08-04 19:56:49', '2021-08-04 19:56:49'),
('d3f328681b75f2bb8e8d846d72d9e865cb071c19b7459fccad0d35c4f25166372063758809ad9ae3', 7, 1, 'authToken', '[]', 0, '2020-07-30 10:06:25', '2020-07-30 10:06:25', '2021-07-30 10:06:25'),
('e1d58efd41b2f0cd69da46aa38fd2d888d0b97269215890900e49cdb3d2d0590d4f64c7b27caf3fc', 7, 1, 'authToken', '[]', 0, '2020-07-30 09:50:51', '2020-07-30 09:50:51', '2021-07-30 09:50:51'),
('eb48e3027cc28f10c52dc1aecb8f2118c8160a9e97bb9e26a51b661ab3e9128c38f43277199b5c1b', 14, 1, 'authToken', '[]', 0, '2020-07-30 10:03:33', '2020-07-30 10:03:33', '2021-07-30 10:03:33'),
('fdb24905e889f81eb67f946f6566d44cbb0d621b96eef6c7f0809c0c3cc1fb9d5e8894fbdc680128', 23, 1, 'authToken', '[]', 0, '2020-08-07 09:18:28', '2020-08-07 09:18:28', '2021-08-07 09:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'bNNy2eGLn6GH4AuCJCakImcgBAw3XN6A5S0NL704', 'http://localhost', 1, 0, 0, '2020-07-30 08:07:47', '2020-07-30 08:07:47'),
(2, NULL, 'Laravel Password Grant Client', '6YeujTQfHDrJyMn4SMPgnWl4Es4uZntAtvmk80nh', 'http://localhost', 0, 1, 0, '2020-07-30 08:07:47', '2020-07-30 08:07:47'),
(3, NULL, 'Laravel Personal Access Client', 'WKwRIFegUIDsWGngBBBYtTkwOxQ34qMhrVpn8O02', 'http://localhost', 1, 0, 0, '2021-06-23 10:51:31', '2021-06-23 10:51:31'),
(4, NULL, 'Laravel Password Grant Client', 'v85dcSsIQISnZDrW57DZYd1VuG53axQNK4moOvVF', 'http://localhost', 0, 1, 0, '2021-06-23 10:51:33', '2021-06-23 10:51:33'),
(5, NULL, 'Laravel Personal Access Client', '4bQOwwfgZzTaFmwwzA7hSCmm7QnT5qrnTh4y05uA', 'http://localhost', 1, 0, 0, '2021-06-25 05:00:33', '2021-06-25 05:00:33'),
(6, NULL, 'Laravel Password Grant Client', '4UiOc7BH3veQwBIBN3Dwm04hADSy3WMrT0uqeDJp', 'http://localhost', 0, 1, 0, '2021-06-25 05:00:35', '2021-06-25 05:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-07-30 08:07:47', '2020-07-30 08:07:47'),
(2, 3, '2021-06-23 10:51:32', '2021-06-23 10:51:32'),
(3, 5, '2021-06-25 05:00:34', '2021-06-25 05:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('6c7721d3e4c07eaf0ae826a03de532144dd4031ad339ac52b16abd718ca932486170a2007bfeb72c', '2fa6c306ed462746715fd4186de72e5f3523ee8a4eab9b2681301b16e1046aed5950cde9ce4484a3', 0, '2021-08-04 19:56:48'),
('703301a37c7d1fb7bb65ac9b1359aeba745414707f8701e330f06c0b253445ceda9e68509fe80d52', '18c3dc57761202976708a9ae17ed6e329a022a292268fb3c870402d683b613d8d2f721c96d88e452', 0, '2021-07-30 08:15:37'),
('846f304b8c4cef35809beb825660fa9cfefaa5d05bb480df98257aadc2b94a332857807a07224d36', '2ab7eca5573b580c3ac86eee4467b069c142283d2efa31562985ee25b1c944082a56e41efb39b9d8', 0, '2021-08-07 09:18:28'),
('9dca807c65046e8f62384b4c1008aea443759935ab2eda174abd6a6cf5b7a2dd20c3244c6eee67ae', 'b864ff6570e4c4dd1e26cf728d0110a9d9f14f7296d1ceddc560cf0b3a73e8092bad7cf3d0751f8c', 0, '2021-08-19 06:50:27'),
('cdbe1431187b23a8c3cfc57f024c5211ffbf13d9f33098f9fcd77321a45a83d036cdf02d44eb5120', '2ef180f8f33c339b5dd7e6d8a8bb4889c7b8ec8bd63622408509375dd991a74d35c84d533a0a92f7', 0, '2021-07-30 10:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `resets`
--

CREATE TABLE `resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `expires_in` int(11) NOT NULL DEFAULT 30,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resets`
--

INSERT INTO `resets` (`id`, `member_id`, `code`, `expires_in`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 6899373, 30, 'Active', '2020-07-29 19:32:21', '2020-07-29 19:32:21'),
(2, 5, 8427889, 30, 'Active', '2020-07-29 19:35:27', '2020-07-29 19:35:27'),
(3, 6, 8963012, 30, 'Active', '2020-07-29 19:43:54', '2020-07-29 19:43:54'),
(4, 7, 7897013, 30, 'Active', '2020-07-30 07:23:23', '2020-07-30 07:23:23'),
(5, 8, 2879524, 30, 'Active', '2020-07-30 07:26:06', '2020-07-30 07:26:06'),
(6, 9, 8772135, 30, 'Active', '2020-07-30 07:29:47', '2020-07-30 07:29:47'),
(7, 10, 7359419, 30, 'Active', '2020-07-30 07:31:23', '2020-07-30 07:31:23'),
(8, 11, 6008195, 30, 'Active', '2020-07-30 07:32:05', '2020-07-30 07:32:05'),
(9, 12, 4176655, 30, 'Active', '2020-07-30 07:48:08', '2020-07-30 07:48:08'),
(10, 7, 6163101, 30, 'Inactive', '2020-07-30 08:09:06', '2020-07-30 08:09:21'),
(11, 7, 1395651, 30, 'Inactive', '2020-07-30 08:13:19', '2020-07-30 08:13:46'),
(12, 13, 5799683, 30, 'Inactive', '2020-07-30 08:15:36', '2020-07-30 08:16:45'),
(13, 7, 2454517, 30, 'Active', '2020-07-30 08:56:33', '2020-07-30 08:56:33'),
(14, 7, 4622767, 30, 'Active', '2020-07-30 09:11:45', '2020-07-30 09:11:45'),
(15, 7, 1515782, 30, 'Active', '2020-07-30 09:12:55', '2020-07-30 09:12:55'),
(16, 7, 6799766, 30, 'Active', '2020-07-30 09:31:27', '2020-07-30 09:31:27'),
(17, 7, 3207743, 30, 'Active', '2020-07-30 09:32:42', '2020-07-30 09:32:42'),
(18, 7, 8424737, 30, 'Active', '2020-07-30 09:33:42', '2020-07-30 09:33:42'),
(19, 7, 3945380, 30, 'Active', '2020-07-30 09:34:59', '2020-07-30 09:34:59'),
(20, 7, 3358376, 30, 'Active', '2020-07-30 09:35:39', '2020-07-30 09:35:39'),
(21, 7, 6375452, 30, 'Active', '2020-07-30 09:54:27', '2020-07-30 09:54:27'),
(22, 7, 1671076, 30, 'Active', '2020-07-30 09:55:42', '2020-07-30 09:55:42'),
(23, 7, 5040892, 30, 'Active', '2020-07-30 09:58:47', '2020-07-30 09:58:47'),
(24, 7, 2743036, 30, 'Inactive', '2020-07-30 09:59:25', '2020-07-30 09:59:42'),
(25, 14, 5238593, 30, 'Active', '2020-07-30 10:03:32', '2020-07-30 10:03:32'),
(26, 14, 7252617, 30, 'Inactive', '2020-07-30 10:03:50', '2020-07-30 10:04:16'),
(27, 15, 1917, 30, 'Active', '2020-07-31 13:50:09', '2020-07-31 13:50:09'),
(28, 16, 3909, 30, 'Active', '2020-08-02 17:16:08', '2020-08-02 17:16:08'),
(29, 17, 1250, 30, 'Active', '2020-08-03 19:18:37', '2020-08-03 19:18:37'),
(30, 18, 5879, 30, 'Active', '2020-08-04 10:49:59', '2020-08-04 10:49:59'),
(31, 19, 8971, 30, 'Active', '2020-08-04 18:37:59', '2020-08-04 18:37:59'),
(32, 20, 2711, 30, 'Active', '2020-08-04 19:37:25', '2020-08-04 19:37:25'),
(33, 21, 8733, 30, 'Inactive', '2020-08-04 19:56:48', '2020-08-04 19:57:10'),
(34, 23, 6958, 30, 'Active', '2020-08-07 09:18:28', '2020-08-07 09:18:28'),
(35, 23, 3551, 30, 'Inactive', '2020-08-07 09:24:27', '2020-08-07 09:25:12'),
(36, 24, 7233, 30, 'Active', '2020-08-19 06:50:26', '2020-08-19 06:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `sms_topups`
--

CREATE TABLE `sms_topups` (
  `id` int(10) UNSIGNED NOT NULL,
  `church_id` int(11) NOT NULL,
  `checkout_request_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_topups`
--

INSERT INTO `sms_topups` (`id`, `church_id`, `checkout_request_id`, `amount`, `units`, `created_at`, `updated_at`) VALUES
(1, 2, 'ws_CO_300820201259330534', 10, 5, '2020-08-31 21:00:00', '2020-08-31 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sms_units`
--

CREATE TABLE `sms_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `church_id` int(11) NOT NULL,
  `units` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_units`
--

INSERT INTO `sms_units` (`id`, `church_id`, `units`, `created_at`, `updated_at`) VALUES
(1, 2, 57, '2020-08-26 10:09:01', '2020-09-01 21:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `church_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `changetime` datetime DEFAULT NULL,
  `changeby` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `church_id`, `schedule_id`, `member_id`, `status`, `changetime`, `changeby`, `created_at`) VALUES
(1, 2, 1, 13, 'Attended', '2020-08-31 09:41:56', 2, '2020-07-30 08:16:53'),
(2, 2, 1, 7, 'Cancelled', '2020-08-31 09:42:02', 2, '2020-07-30 08:54:10'),
(3, 2, 2, 7, 'Attended', '2020-08-01 15:45:42', 2, '2020-07-30 08:55:00'),
(4, 3, 7, 5, 'Booked', NULL, NULL, '2020-07-31 11:23:49'),
(5, 2, 1, 6, 'Attended', '2020-07-31 16:48:52', 2, '2020-07-31 13:46:49'),
(6, 2, 2, 15, 'Attended', '2020-08-01 15:45:47', 2, '2020-07-31 13:52:28'),
(7, 2, 3, 21, 'Booked', NULL, NULL, '2020-08-04 19:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_churches`
--

CREATE TABLE `tbl_churches` (
  `id` int(11) NOT NULL,
  `church_name` varchar(60) NOT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `email_address` varchar(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_churches`
--

INSERT INTO `tbl_churches` (`id`, `church_name`, `phone_number`, `email_address`, `created_at`, `updated_at`, `password`, `remember_token`) VALUES
(2, 'ACK GOOD SAMARITAN CIIKO', '0700000000', 'info@solutech.co.ke', '2020-07-29 18:56:35', '2020-07-29 18:56:35', NULL, NULL),
(3, 'ACK St Gertrude Parish Clay City', '0711111111', 'info@ackstgertrudeparish.co.ke', '2020-07-29 19:22:19', '2020-07-29 19:22:19', NULL, NULL),
(4, 'ben INC', '0786624895', 'benzoic09@gmail.com', '2020-08-05 12:41:28', '2020-08-05 12:41:28', NULL, NULL),
(42, 'AIC', '0787651229', 'kimeujim254@gmail.com', '2021-07-14 05:18:14', '2021-07-14 05:18:14', NULL, NULL),
(44, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 10:27:56', '2021-07-15 10:27:56', NULL, NULL),
(45, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:03:38', '2021-07-15 11:03:38', NULL, NULL),
(46, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:04:15', '2021-07-15 11:04:15', NULL, NULL),
(47, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:04:52', '2021-07-15 11:04:52', NULL, NULL),
(48, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:05:34', '2021-07-15 11:05:34', NULL, NULL),
(49, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:06:00', '2021-07-15 11:06:00', NULL, NULL),
(50, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:07:06', '2021-07-15 11:07:06', NULL, NULL),
(51, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:08:11', '2021-07-15 11:08:11', NULL, NULL),
(52, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:09:29', '2021-07-15 11:09:29', NULL, NULL),
(53, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:10:15', '2021-07-15 11:10:15', NULL, NULL),
(54, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:11:15', '2021-07-15 11:11:15', NULL, NULL),
(55, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:11:45', '2021-07-15 11:11:45', NULL, NULL),
(56, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:11:59', '2021-07-15 11:11:59', NULL, NULL),
(57, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:15:31', '2021-07-15 11:15:31', NULL, NULL),
(58, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:16:00', '2021-07-15 11:16:00', NULL, NULL),
(59, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:16:16', '2021-07-15 11:16:16', NULL, NULL),
(60, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:16:57', '2021-07-15 11:16:57', NULL, NULL),
(61, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:17:36', '2021-07-15 11:17:36', NULL, NULL),
(62, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:17:47', '2021-07-15 11:17:47', NULL, NULL),
(63, 'chun ministries', '078760000', 'wertyui@fghjk.com', '2021-07-15 11:20:12', '2021-07-15 11:20:12', NULL, NULL),
(64, 'building', '07876541234', 'kkk@kkkkk.com', '2021-07-15 11:42:34', '2021-07-15 11:42:34', NULL, NULL),
(65, 'Vocan', '0712345555', 'kjim254@gmail.com', '2021-07-16 02:27:29', '2021-07-16 02:27:29', NULL, NULL),
(66, 'Vocan', '0787654320', 'k254@gmail.com', '2021-07-16 02:29:02', '2021-07-16 02:29:02', NULL, NULL),
(67, 'ABC', '0734567812', 'jkl@kk.com', '2021-07-19 07:16:17', '2021-07-19 07:16:17', NULL, NULL),
(68, 'WWW', '09876543', 'info@kk.com', '2021-07-19 07:18:32', '2021-07-19 07:18:32', NULL, NULL),
(69, 'ABCD', '0797497300', 'info@solu.co.ke', '2021-07-26 11:03:05', '2021-07-26 11:03:05', NULL, NULL),
(70, 'ABCDEFGH', '098763452', 'jelo@jlo.com', '2021-07-29 06:01:17', '2021-07-29 06:01:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_us`
--

CREATE TABLE `tbl_contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contributions`
--

CREATE TABLE `tbl_contributions` (
  `id` bigint(20) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `project_name_id` int(11) NOT NULL,
  `member` varchar(255) DEFAULT NULL,
  `names` varchar(255) DEFAULT NULL,
  `phone_number` int(255) DEFAULT NULL,
  `contribution_date` date NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `code` varchar(300) DEFAULT NULL,
  `amount_contributed` bigint(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_contributions`
--

INSERT INTO `tbl_contributions` (`id`, `church_id`, `project_name_id`, `member`, `names`, `phone_number`, `contribution_date`, `payment_mode`, `code`, `amount_contributed`, `created_at`, `updated_at`) VALUES
(26, 2, 29, '8', '', NULL, '2020-12-23', 'MPesa', 'grftgyujhk', 3500, '2021-07-15 09:57:27', '2021-07-15 09:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE `tbl_expenses` (
  `id` bigint(20) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `expense_type_id` int(11) NOT NULL,
  `expense_detail` varchar(255) NOT NULL,
  `date_received` date NOT NULL,
  `amount` bigint(255) NOT NULL,
  `confirmed` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_expenses`
--

INSERT INTO `tbl_expenses` (`id`, `church_id`, `expense_type_id`, `expense_detail`, `date_received`, `amount`, `confirmed`, `status`, `updated_at`, `created_at`) VALUES
(17, 2, 1, 'Building', '2021-06-03', 10000, 'Yes', 'Active', '2021-07-30 04:26:30', '2021-06-29 02:39:36'),
(18, 2, 2, 'Cleaning and mantainance', '2021-06-29', 12000, 'Yes', 'Active', '2021-06-30 10:39:20', '2021-06-29 04:15:49'),
(19, 2, 4, 'Social outreach', '2021-06-30', 13000, 'Yes', 'Active', '2021-06-30 10:37:02', '2021-06-30 10:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_types`
--

CREATE TABLE `tbl_expense_types` (
  `id` bigint(255) NOT NULL,
  `expense_type` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_expense_types`
--

INSERT INTO `tbl_expense_types` (`id`, `expense_type`, `status`, `updated_at`, `created_at`, `church_id`) VALUES
(1, 'Salaries&Wages', 'Active', '2021-06-25 05:53:17', '2021-06-25 05:50:16', 2),
(2, 'Contract Labor', 'Active', '2021-06-25 05:50:32', '2021-06-25 05:50:32', 2),
(3, 'Office Supplies', 'Active', '2021-06-25 05:50:42', '2021-06-25 05:50:42', 2),
(4, 'Mission&Outreach', 'Active', '2021-06-25 05:51:06', '2021-06-25 05:51:06', 2),
(5, 'Utilities&Websites', 'Active', '2021-07-21 03:22:33', '2021-06-25 05:51:17', 2),
(6, 'Ministry', 'Active', '2021-06-25 05:51:34', '2021-06-25 05:51:34', 2),
(7, 'Events', 'Active', '2021-06-25 05:51:42', '2021-06-25 05:51:42', 2),
(8, 'Auto expense', 'Active', '2021-06-30 10:42:45', '2021-06-25 05:51:50', 2),
(9, 'Mileage', 'Active', '2021-06-25 05:51:59', '2021-06-25 05:51:59', 2),
(10, 'Projects', 'Active', '2021-06-25 05:52:07', '2021-06-25 05:52:07', 2),
(11, 'Rent&Mortgages', 'Active', '2021-06-28 14:13:44', '2021-06-25 05:52:15', 2),
(12, 'Payroll Taxes', 'Active', '2021-06-25 05:52:23', '2021-06-25 05:52:23', 2),
(15, 'Camping', 'Active', '2021-06-30 10:43:30', '2021-06-30 10:43:30', 2),
(16, 'Salaries&Wages', 'Active', '2021-07-15 05:16:37', '2021-07-15 05:16:37', 42);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups`
--

CREATE TABLE `tbl_groups` (
  `id` int(11) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_groups`
--

INSERT INTO `tbl_groups` (`id`, `church_id`, `name`, `description`, `added_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Wadau', NULL, NULL, 'Active', '2020-08-21 08:48:31', '2021-06-30 14:20:10'),
(2, 2, 'Wakanai', '', NULL, 'Active', '2020-08-21 08:48:31', '2020-08-21 08:48:31'),
(3, 2, 'Wrong rende', 'Avoid those people', NULL, 'Inactive', '2021-06-28 16:13:18', '2021-07-15 09:47:36'),
(4, 2, 'Mbwakni', 'Utalala mteja', NULL, 'Inactive', '2021-07-08 09:20:36', '2021-07-08 10:13:11'),
(5, 42, 'Odi Love', NULL, NULL, 'Active', '2021-07-14 10:02:37', '2021-07-14 10:02:37'),
(6, 42, 'Brooklyne boys', 'Kwani ni kesho', NULL, 'Active', '2021-07-15 05:52:00', '2021-07-15 05:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_members`
--

CREATE TABLE `tbl_group_members` (
  `id` int(11) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_group_members`
--

INSERT INTO `tbl_group_members` (`id`, `church_id`, `member_id`, `group_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 25, 1, 'checked', '2020-08-21 11:48:56', NULL),
(3, 2, 37, 2, 'checked', '2020-09-04 05:44:23', '2020-09-04 05:44:23'),
(4, 2, 38, 2, '', '2020-09-04 06:08:58', '2020-09-04 06:08:58'),
(5, 2, 25, 2, 'checked', '2021-06-30 13:50:55', NULL),
(6, 2, 2, 1, 'checked', '2021-07-01 06:02:42', NULL),
(7, 2, 2, 2, 'checked', '2021-07-01 06:02:42', NULL),
(8, 2, 2, 3, 'checked', '2021-07-01 06:02:42', NULL),
(9, 2, 24, 2, '', '2021-07-06 06:14:08', NULL),
(10, 2, 6, 3, 'checked', '2021-07-06 06:21:59', NULL),
(11, 2, 21, 4, 'checked', '2021-07-08 12:21:03', NULL),
(12, 2, 25, 4, 'checked', '2021-07-08 12:23:27', NULL),
(13, NULL, 17, 0, 'checked', '2021-07-08 12:29:41', NULL),
(14, NULL, 24, 0, 'checked', '2021-07-08 17:48:51', NULL),
(15, NULL, 38, 0, 'checked', '2021-07-08 17:49:13', NULL),
(16, NULL, 57, 1, 'checked', '2021-07-14 12:19:43', NULL),
(18, 42, 60, 5, 'checked', '2021-07-14 13:02:50', NULL),
(19, 42, 61, 5, 'checked', '2021-07-15 08:52:26', NULL),
(20, 42, 61, 6, 'checked', '2021-07-15 08:52:26', NULL),
(21, 2, 46, 1, 'checked', '2021-07-16 05:40:15', NULL),
(22, 2, 46, 2, 'checked', '2021-07-16 05:40:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incomes`
--

CREATE TABLE `tbl_incomes` (
  `id` bigint(255) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `member` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `income_detail` varchar(255) NOT NULL,
  `date_received` date NOT NULL,
  `payment_mode` enum('MPesa','Cash','Credit card','Debit card','Cheque') NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `amount` bigint(255) NOT NULL,
  `confirmed` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `income_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_incomes`
--

INSERT INTO `tbl_incomes` (`id`, `church_id`, `member`, `service`, `income_detail`, `date_received`, `payment_mode`, `code`, `amount`, `confirmed`, `status`, `updated_at`, `created_at`, `income_type_id`) VALUES
(31, 2, NULL, NULL, 'Youth camp', '2021-06-10', 'Cash', NULL, 50000, 'Yes', 'Active', '2021-06-30 10:39:46', '2021-06-29 02:43:51', 1),
(32, 2, NULL, NULL, 'Estate', '2021-06-16', 'Cheque', NULL, 20000, 'Yes', 'Active', '2021-06-30 10:41:54', '2021-06-29 04:53:14', 4),
(37, 2, NULL, '1', 'sadaka', '2021-07-15', 'Cash', NULL, 100000, 'Yes', 'Active', '2021-07-29 05:58:10', '2021-07-16 04:32:13', 13),
(38, 2, NULL, NULL, 'sadaka', '2021-07-10', 'Cash', NULL, 1, 'Yes', 'Active', '2021-07-16 04:33:15', '2021-07-16 04:33:15', 1),
(39, 2, NULL, NULL, 'unicef', '2021-07-07', 'Cash', NULL, 11000, 'Yes', 'Active', '2021-07-29 05:59:19', '2021-07-16 07:49:29', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income_types`
--

CREATE TABLE `tbl_income_types` (
  `id` bigint(255) NOT NULL,
  `income_type` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_income_types`
--

INSERT INTO `tbl_income_types` (`id`, `income_type`, `status`, `updated_at`, `created_at`, `church_id`) VALUES
(1, 'Fundraising', 'Active', '2021-06-25 05:36:17', '2021-06-25 05:36:17', 2),
(2, 'Donation', 'Active', '2021-06-30 10:44:00', '2021-06-25 05:36:28', 2),
(3, 'Sponsorship', 'Active', '2021-06-28 14:14:02', '2021-06-25 05:36:42', 2),
(4, 'Investment capital', 'Active', '2021-06-25 05:36:50', '2021-06-25 05:36:50', 2),
(5, 'Mileages', 'Active', '2021-06-25 08:44:42', '2021-06-25 08:44:26', 2),
(10, 'Real estate', 'Active', '2021-06-30 10:45:02', '2021-06-30 10:45:02', 2),
(13, 'Offering', 'Active', '2021-07-16 04:30:14', '2021-07-16 04:30:14', 2),
(14, 'Tithes', 'Active', '2021-07-21 03:22:05', '2021-07-16 04:30:26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `id` int(11) NOT NULL,
  `log_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `id` int(11) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `membership_number` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `married_in_church` varchar(5) DEFAULT NULL,
  `residence_zone` int(11) DEFAULT NULL,
  `former_church` varchar(30) DEFAULT NULL,
  `baptized` varchar(5) DEFAULT NULL,
  `confirmed` varchar(5) DEFAULT NULL,
  `spouse` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `password` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `sms_code` int(11) DEFAULT NULL,
  `sms_code_verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `national_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`id`, `church_id`, `membership_number`, `name`, `gender`, `phone_number`, `email`, `marital_status`, `married_in_church`, `residence_zone`, `former_church`, `baptized`, `confirmed`, `spouse`, `status`, `password`, `remember_token`, `sms_code`, `sms_code_verified`, `created_at`, `updated_at`, `national_id`) VALUES
(5, 3, '', 'Daniel Juma', NULL, '0725104569', 'damajumas@gmail.com', NULL, NULL, 5, NULL, NULL, NULL, NULL, 'Active', '$2y$10$/HoG1vni3y7FIAswo.0WDe9OM6Yw941d4rCoOpdq2zmx.RT4K/2TG', NULL, NULL, 1, '2020-07-29 19:35:27', '2020-07-29 19:35:27', 0),
(2, 2, 'M001', 'ACK GOOD SAMARITAN CIIKO', 'Male', '0726738394', 'info@solutech.co.ke', 'Married', 'Yes', NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$gdd4w8mPFSOd3SoPPhrUUOoHWMHPIKaOWoxumKWXrijaW8gsfCX7O', 'fxeaO2KygHE0GJc8m3svQkMIXwZbhiDjxq5yOKv2UsiRhCGTk2ECTInBOatH', NULL, 0, '2020-07-29 18:56:35', '2021-07-16 02:38:00', 71725405),
(3, 3, '', 'ACK St Gertrude Parish Clay City', NULL, '0711111111', 'info@ackstgertrudeparish.co.ke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$ZHFhGCiJKD7sV8W7MBSMb.aeCyEMvMrDwsjqR4kE1xzhuquMHPm7a', NULL, NULL, 0, '2020-07-29 19:22:19', '2020-07-29 19:22:19', 0),
(6, 2, '', 'Alexander Odhiambo', NULL, '0718640103', 'alexander.aluoch@gmail.com', NULL, NULL, 2, NULL, NULL, NULL, NULL, 'Active', '$2y$10$hBUJ5qmmcHR2xRflHlVxeuX9u3i0sxH1tKq3B4LySL7ULQlNRd3rO', NULL, NULL, 1, '2020-07-29 19:43:54', '2020-07-29 19:43:54', 0),
(7, 2, '', 'Brian Mutinda', NULL, '0703748544', 'me@test.com', NULL, NULL, 2, NULL, NULL, NULL, NULL, 'Active', '$2y$10$z3f1NZcphJWuLKr5Q91Gvu6jl0wGtq6fBWX9lCgDXWc0V/ZQYbohe', NULL, NULL, 1, '2020-07-30 07:23:23', '2020-07-30 08:14:10', 0),
(8, 2, '', 'Brian Mutinda', NULL, '0703748540', 'test@test.com', NULL, NULL, 2, NULL, NULL, NULL, NULL, 'Active', '$2y$10$lvCvBzRtUaJuFyEWzd96wedxkSJy7LHCOtwHh25d0iq3wsM8MRqhG', NULL, NULL, 0, '2020-07-30 07:26:06', '2020-07-30 07:26:06', 0),
(9, 2, '', 'Brian Mutinda', NULL, '0703748541', 'test1@test.com', NULL, NULL, 2, NULL, NULL, NULL, NULL, 'Active', '$2y$10$bMrj4FQ41K.JhqttRzndReLGeD8ghhLZP9Hw1pVt0MJGsMJXKcfye', NULL, NULL, 0, '2020-07-30 07:29:47', '2020-07-30 07:29:47', 0),
(10, 2, '', 'Test', NULL, '0703748542', 'test2@test.com', NULL, NULL, 2, NULL, NULL, NULL, NULL, 'Active', '$2y$10$OvigZMhuXtI8G1t1NyY4T.fGHRMzy0tklx8akRVch4zso1kktAqmW', NULL, NULL, 0, '2020-07-30 07:31:23', '2020-07-30 07:31:23', 0),
(11, 2, '', 'Test', NULL, '0703748543', 'test3@test.com', NULL, NULL, 2, NULL, NULL, NULL, NULL, 'Active', '$2y$10$IOr6DrpS.Iy40hDVtSpkQui/azcre0TjQcIWNR458uwhoeWACgjAS', NULL, NULL, 0, '2020-07-30 07:32:05', '2020-07-30 07:32:05', 0),
(12, 2, '', 'Test', NULL, '0703748500', 'me@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Active', '$2y$10$HX1gvQZoINT4qhIBCg6rruepY22ShMvOw1EC2.KF2qhnXJIOBrO1q', NULL, NULL, 0, '2020-07-30 07:48:08', '2021-07-26 03:42:47', 0),
(13, 2, '', 'Otieno Okaya', NULL, '0711536733', 'derykowaynx@gmail.com', NULL, NULL, 4, NULL, NULL, NULL, NULL, 'Active', '$2y$10$UF90EgGZeMrakvRxa6hW/u8ET9vXSy35M3mnu2vG28ukiqoKIudoq', NULL, NULL, 1, '2020-07-30 08:15:36', '2020-07-30 08:16:45', 0),
(14, 2, '', 'Test', NULL, '0703748566', 'test@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Active', '$2y$10$kEa1o9RN5gWeuF76CvzMP.EUP.GzJB7T8llb/xT8md4Lou0Lm1ua6', NULL, NULL, 1, '2020-07-30 10:03:32', '2020-07-30 10:04:16', 0),
(15, 2, '', 'Janet odhiambo', NULL, '0722432423', 'jaeyjanet@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Active', '$2y$10$heCcvi17V/YSeqn/t.MnyOGpmLGf0SAm7.turXRWiryeBv/y6mOvi', NULL, NULL, 1, '2020-07-31 13:50:09', '2020-07-31 13:50:09', 0),
(16, 2, '', 'Kevin Onyando', NULL, '0729676259', 'Onyando.kevin@gmail.com', NULL, NULL, 2, NULL, NULL, NULL, NULL, 'Active', '$2y$10$gyRMJqRazieM84PHI14v2.5g8ulYG/.bdX0GaC2ymGbEGWMQmlb3C', NULL, NULL, 0, '2020-08-02 17:16:08', '2020-08-02 17:16:08', 0),
(17, 2, '', 'Test 4', NULL, '0703748590', 'mei@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Active', '$2y$10$JanonF8S/rsJ/th9fhSVCuyeTeT8fc3cy1mFxZIgNcPSohGA3sll.', NULL, NULL, 0, '2020-08-03 19:18:37', '2020-08-03 19:18:37', 0),
(18, 1, '', 'john doe', NULL, '070374855', 'test2@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Active', '$2y$10$v/Cc3dTW9tExnn8ATqeVaOc3uKg2erqTZWw9Sgo2TzhQG5h2Wh./u', NULL, NULL, 0, '2020-08-04 10:49:59', '2020-08-04 10:49:59', 0),
(19, 1, '', 'john doe', NULL, '070374866', 'test3@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Active', '$2y$10$LgMgTuW146we54MfNqHQlejweYIryfTReLjntWbVlT4oAx.ZP1qh2', NULL, NULL, 0, '2020-08-04 18:37:59', '2020-08-04 18:37:59', 0),
(21, 2, '', 'Lydia Wambui', NULL, '0795428817', 'lydiawambo@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Active', '$2y$10$NyU6B0iH53nQtu1bM96.ZeybPAmhGVfCI5s1Bklp8aKYN1HKTQm1O', NULL, NULL, 1, '2020-08-04 19:56:48', '2020-08-04 19:57:10', 0),
(22, 4, '', 'ben INC', NULL, '0786624895', 'benzoic09@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$bJC0zw92rCdwxdCwJHntNOgzP6M.vylOeLOr4Oc5w3jh6vpFbxt/C', NULL, NULL, 0, '2020-08-05 12:41:28', '2020-08-05 12:41:28', 0),
(23, 4, '', 'Solomon mdogo', 'Male', '0729808389', 'ben@gmail.com', 'Married', 'No', 11, NULL, 'Yes', 'No', NULL, 'Active', '$2y$10$wsfJzSJN6.rlVhI4jp.0YuMIVMG7eRCOg7wakhKhHFxtfuyxb2tr2', NULL, NULL, 1, '2020-08-07 09:18:28', '2020-08-07 09:27:04', 0),
(24, 2, '', 'alex mwakindeu', NULL, '0711536700', 'dery4kowaynx@gmail.com', NULL, NULL, 2, NULL, NULL, NULL, NULL, 'Active', '$2y$10$GelE7C40FNtYZb12v8RVFOGm7xgw2VOd/pk5J/Y3eECxFXf0f9k2G', NULL, NULL, 0, '2020-08-19 06:50:26', '2020-08-19 06:50:26', 0),
(25, 2, '', 'Kelvin', 'Male', '0726738394', 'kelvinkibugi@gmail.com', 'Single', 'Yes', 4, NULL, 'Yes', 'No', NULL, 'Active', NULL, NULL, NULL, 0, '2020-08-21 07:08:49', '2020-08-21 07:08:49', 0),
(36, 2, 'M001', 'Kelvin Waithira', 'Male', '772591591', 'og@import.com', 'Single', 'No', 4, NULL, 'Yes', 'Yes', 21, 'Active', '$2y$10$hlwz3bYpEAJvCo8xg3Dwke2nKecnODoIBB2SM3g2UPvwpK.X4poc.', NULL, NULL, 0, '2020-08-31 03:28:08', '2020-08-31 03:28:08', 0),
(37, 2, 'M002', 'Kelvin Kibugi', 'Male', '726738394', 'kelvinkibugi@gmail.com', 'Single', 'No', 3, NULL, 'No', 'No', NULL, 'Active', '$2y$10$mVj1oq8/HOqeiS5Irms.de9iQ3naYz2E7Hmf5MihkNZk/Pxzcg3sy', NULL, NULL, 0, '2020-09-04 05:30:41', '2020-09-04 05:44:23', 30260885),
(38, 2, 'M003', 'Janet Mbugua', 'Female', '772591591', 'janet@test.com', 'Married', 'Yes', 4, NULL, 'Yes', 'Yes', 30260885, 'Active', '$2y$10$u8rY1oQqfjQh46xV/mlf9./yNvKVXTS6nFthGEwxZVX81kFQ.9lCW', NULL, NULL, 0, '2020-09-04 06:08:58', '2020-09-04 06:08:58', 77336689),
(45, 2, 'M026', 'jj', 'Male', '0787654321', 'vdsvh@ghh.com', 'Single', 'Yes', 12, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-06 09:02:09', '2021-07-14 06:43:28', 75673489),
(46, 2, 'M027', 'kkkk', 'Male', '34567890', 'kkk@kk.com', 'Single', 'Yes', 1, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-06 09:05:44', '2021-07-15 09:42:38', 456789),
(64, 63, 'M002', 'jack', 'Male', '0712345677', '254@gmail.com', 'Married', 'Yes', NULL, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-15 11:26:46', '2021-07-15 11:26:46', 71725400),
(61, 42, 'M003', 'jack', 'Female', '0712345897', 'k@gmail.com', 'Married', 'No', 14, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-15 05:48:15', '2021-07-15 05:48:15', 45678977),
(60, 42, 'M002', 'jeral', 'Female', '0787654111', 'wertyuuui@fghjk.com', 'Married', 'Yes', 14, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-14 08:25:06', '2021-07-14 08:25:06', 45678912),
(57, 42, NULL, 'AIC', 'Male', '0787651229', 'kimeujim254@gmail.com', 'Married', 'Yes', 13, NULL, 'Yes', 'Yes', NULL, 'Active', '$2y$10$od9FO288aso1GSVCWtxl.emvYQR48uQQQcQKOkTXFIAUbO7aU5aUW', 'BThkVBYoo73yssmU5cS9yQ7unDRlGzYOnsyBGcDSnX4JiflVi5mltJahMfcl', NULL, 0, '2021-07-14 05:18:15', '2021-07-15 05:50:41', 71725401),
(63, 63, 'M003', 'chun ministries', NULL, '078760000', 'wertyui@fghjk.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$w4KKKhd8j7UtqxDfbACna.4cfq3j9NrTkLvojbpY2tksDFaT2EHCO', 'tImM8L5rJwlfNhUxZWtVTWtnerbVWm0RBxSZGPj9m5jRfFAkbbr0dcddg1pT', NULL, 0, '2021-07-15 11:20:13', '2021-07-15 11:25:08', 73725711),
(65, 63, 'M003', 'pain', 'Female', '0712345666', 'wertyui@f.com', 'Widow', 'Yes', NULL, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-15 11:27:46', '2021-07-15 11:27:46', 717254),
(66, 64, 'M001', 'building', NULL, '07876541234', 'kkk@kkkkk.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$ShUIZWpVGFeEIpDXNuxsWejCwpL2955IYYVjlr8fXT1juz8ipVr3O', NULL, NULL, 0, '2021-07-15 11:42:35', '2021-07-15 11:42:35', 71712543),
(67, 64, 'M002', 'jj', 'Male', '078765432178', 'i@solut.co.ke', 'Single', 'Yes', NULL, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-15 11:45:30', '2021-07-15 11:45:30', 737257),
(68, 64, 'M003', 'painting', 'Female', '0797497308', 'jim254@gmail.com', 'Single', 'Yes', NULL, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-15 11:46:01', '2021-07-15 11:46:01', 71725405),
(69, 65, NULL, 'Vocan', NULL, '0712345555', 'kjim254@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$Dpq0wMlgPsjCUpOmWDx5veBiFp3KtYrD7WKwGfIr5rEbGoBi.w50a', NULL, NULL, 0, '2021-07-16 02:27:30', '2021-07-16 02:27:30', 6785356),
(70, 66, 'M001', 'Vocan', NULL, '0787654320', 'k254@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$wG5RVkVdvzMLuk8ik9EKI.Ywk1Jfc5DxAtbuk6n6ZYBmsOc6mlDrW', 'BvavUIvWCqHUocZddfdkOEn5STgUWiO1Yo1ctcVsgv9tAvzkMvBMP9sOf8it', NULL, 0, '2021-07-16 02:29:03', '2021-07-16 02:29:05', 73725701),
(71, 66, 'M002', 'jacob', 'Male', '0787654321', 'weui@fghjk.com', 'Married', 'No', NULL, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-16 02:35:30', '2021-07-16 02:35:30', 73725705),
(72, 66, 'M003', 'jacob', 'Male', '0787654321', 'weui@fghjk.com', 'Married', 'No', NULL, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-16 02:35:31', '2021-07-16 02:35:31', 73725705),
(73, 67, 'M001', 'ABC', NULL, '0734567812', 'jkl@kk.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$yOMh.dPYPGH6gQzdWHJjkuvCgAjLnpB4AtfV7KoAQkRwa8ehcf3u2', '04ILqIMKKAedv1AV00On2WJtopOcdUSytOhJHowaP42MPuFT1NbVlVqHdHWS', NULL, 0, '2021-07-19 07:16:18', '2021-07-19 07:16:20', 41345768),
(74, 68, 'M001', 'WWW', NULL, '09876543', 'info@kk.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$fud5DfsJxEitSG5H5ktCK.zY7tIJciL8Ur2zoO.BvljTLrsyALc1q', 'HMM2s20xBot9hruCmLpBGhqebOn5IdckU9P9AMiDBBG7UeWVwfHSe7GoakAe', NULL, 0, '2021-07-19 07:18:32', '2021-07-19 07:18:32', 98765432),
(75, 2, 'M022', 'AICK GOOD SAMARITAN CIIKO niiikooo', 'Female', '0787654321', 'weui@fghjk.com', 'Married', 'Yes', 12, NULL, 'Yes', 'Yes', NULL, 'Active', NULL, NULL, NULL, 0, '2021-07-21 09:59:49', '2021-07-21 09:59:49', 73725703),
(76, 69, 'M001', 'ABCD', NULL, '0797497300', 'info@solu.co.ke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$MnqHZbTS60stOBwu7ZLBeeVrgiK0beo3i1Dc9W2c3LWiOdoR6oaEi', NULL, NULL, 0, '2021-07-26 11:03:06', '2021-07-26 11:03:06', 73725700),
(77, 70, 'M001', 'ABCDEFGH', NULL, '098763452', 'jelo@jlo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '$2y$10$IYdQ3txfuVPaBqj6Z22.qeaEUiNdvhYqSUybA1bZeIEuvetm1L3nC', 'SQfiTuFRqWOBTLWbwue0vImrqCE9eZowjS00Pu8UopToEpNLwkxWy6JePemJ', NULL, 0, '2021-07-29 06:01:17', '2021-07-29 06:01:18', 47652765);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `id` int(11) NOT NULL,
  `message_type` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `church_id` int(11) NOT NULL,
  `message_content` varchar(500) NOT NULL,
  `send_at` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `message_type`, `added_by`, `church_id`, `message_content`, `send_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Notification', 2, 2, 'Hi there, testing message.', NULL, 'New Message', '2020-08-21 07:06:38', '2020-08-21 07:06:38'),
(2, 'Notification', 2, 2, 'Hi test message.', NULL, 'New Message', '2020-08-21 07:09:12', '2020-08-21 07:09:12'),
(6, 'General Communication', 2, 2, 'Hi Kelvin', '2020-08-21 13:19:40', '1', '2020-08-21 10:19:40', '2020-08-21 10:19:40'),
(7, 'General Communication', 2, 2, 'Hi Jerusalem Members', '2020-08-21 13:19:57', '1', '2020-08-21 10:19:57', '2020-08-21 10:19:57'),
(8, 'General Communication', 2, 2, 'Hi Jerusalem Members', '2020-08-21 13:21:49', '1', '2020-08-21 10:21:49', '2020-08-21 10:21:49'),
(9, 'General Communication', 2, 2, 'Hi Kelvin', '2020-08-21 14:34:09', '1', '2020-08-21 11:34:09', '2020-08-21 11:34:09'),
(10, 'General Communication', 2, 2, '1!Hi Guys from Jerusalem Group!', '2020-08-21 14:34:30', '1', '2020-08-21 11:34:30', '2020-08-21 11:34:30'),
(11, 'General Communication', 2, 2, 'kllllllld', '2020-08-21 14:35:21', '1', '2020-08-21 11:35:21', '2020-08-21 11:35:21'),
(12, 'General Communication', 2, 2, 'hahaha', '2020-08-21 14:35:43', '1', '2020-08-21 11:35:43', '2020-08-21 11:35:43'),
(13, 'General Communication', 2, 2, 'Hi testing church message.', '2020-08-21 15:06:52', '1', '2020-08-21 12:06:52', '2020-08-21 12:06:52'),
(14, 'General Communication', 2, 2, 'Hello there!', '2020-08-21 15:40:55', '1', '2020-08-21 12:40:55', '2020-08-21 12:40:55'),
(15, 'General Communication', 2, 2, 'Hello', '2020-08-22 00:00:00', '1', '2020-08-21 12:44:29', '2020-08-21 12:44:29'),
(16, 'General Communication', 2, 2, 'Hi there, this is testing.', '2020-08-22 00:00:00', '1', '2020-08-21 12:53:07', '2020-08-21 12:53:07'),
(17, 'General Communication', 2, 2, 'Hi  {name}, we are testing custom properties.', '2020-08-22 23:15:39', '1', '2020-08-22 20:15:39', '2020-08-22 20:15:39'),
(18, 'General Communication', 2, 2, 'Hi {name}! Custom Properties Church app.', '2020-08-22 23:23:54', '1', '2020-08-22 20:23:54', '2020-08-22 20:23:54'),
(19, 'General Communication', 2, 2, 'Hi  {name}, You are a Jerusalem Member.', '2020-08-24 00:00:00', '1', '2020-08-22 20:36:34', '2020-08-22 20:36:34'),
(20, 'General Communication', 2, 2, 'Hello  {name}, your email address is :  {email} and your phone number is  {phone_number}. Thank you.', '2020-08-23 00:39:00', '1', '2020-08-22 21:39:00', '2020-08-22 21:39:00'),
(21, 'General Communication', 2, 2, 'Hi  {name}, your email address is  {email} and phone is :  {phone_number}. Thank you.', '2020-08-23 00:42:32', '1', '2020-08-22 21:42:32', '2020-08-22 21:42:32'),
(22, '1', 2, 2, 'Hi  {name}, !', '2020-08-23 06:31:46', '1', '2020-08-23 03:31:46', '2020-08-23 03:31:46'),
(23, '1', 2, 2, 'Hi {name}', '2020-08-28 00:00:00', '1', '2020-08-25 18:49:19', '2020-08-25 18:49:19'),
(24, '1', 2, 2, 'Hi  {name}', '2020-08-27 00:00:00', '1', '2020-08-25 18:50:11', '2020-08-25 18:50:11'),
(25, '1', 2, 2, 'Hi  {name}', '2020-08-27 00:00:00', '1', '2020-08-25 18:55:03', '2020-08-25 18:55:03'),
(26, '1', 2, 2, 'Hi  {name}', '2020-08-29 00:00:00', '1', '2020-08-25 18:55:39', '2020-08-25 18:55:39'),
(27, '1', 2, 2, 'Hi  {name}', '2020-08-25 21:57:13', '1', '2020-08-25 18:57:13', '2020-08-25 18:57:13'),
(28, '1', 2, 2, 'Hi  {name}', '2020-08-29 00:00:00', '1', '2020-08-25 19:01:05', '2020-08-25 19:01:05'),
(29, '1', 2, 2, 'Hi', '2020-08-29 00:00:00', '1', '2020-08-25 19:03:43', '2020-08-25 19:03:43'),
(30, '1', 2, 2, 'Hi', '2020-08-29 00:00:00', '1', '2020-08-25 19:08:00', '2020-08-25 19:08:00'),
(31, '1', 2, 2, 'Hi', '2020-08-28 00:00:00', '1', '2020-08-25 19:10:20', '2020-08-25 19:10:20'),
(32, '1', 2, 2, 'kkkk', '2020-08-29 00:00:00', '1', '2020-08-25 19:13:32', '2020-08-25 19:13:32'),
(33, '1', 2, 2, 'Hi', '2020-08-28 00:00:00', '1', '2020-08-25 19:17:00', '2020-08-25 19:17:00'),
(34, '1', 2, 2, 'Hahah', '2020-08-25 22:19:37', '1', '2020-08-25 19:19:37', '2020-08-25 19:19:37'),
(35, '1', 2, 2, 'Hi', '2020-08-28 00:00:00', '1', '2020-08-25 19:20:05', '2020-08-25 19:20:05'),
(36, '1', 2, 2, 'Hello  {name}, this is general communication!', '2020-08-28 00:00:00', '1', '2020-08-25 19:21:42', '2020-08-25 19:21:42'),
(37, '1', 2, 2, 'Hello  {name}, how are you doing?', '2020-08-28 00:00:00', '1', '2020-08-26 05:00:23', '2020-08-26 05:00:23'),
(38, '1', 2, 2, 'Hi  {name}, you are a Jerusalem Member.', '2020-08-26 08:44:03', '1', '2020-08-26 05:44:03', '2020-08-26 05:44:03'),
(39, '1', 2, 2, 'Hi  {name}, you are a Jerusalem Member!', '2020-08-28 00:00:00', '1', '2020-08-26 05:46:05', '2020-08-26 05:46:05'),
(40, '1', 2, 2, 'Hi  {name}, testing units deduction.', '2020-08-26 13:14:28', '1', '2020-08-26 10:14:28', '2020-08-26 10:14:28'),
(41, '1', 2, 2, 'Hi  {name}, testing cost.', '2020-09-01 23:58:14', '1', '2020-09-01 20:58:14', '2020-09-01 20:58:14'),
(42, '1', 2, 2, 'Testing message with more than 160 characters so that we can calculate the total cost of the message based on rate, and splitting the message based on characters.', '2020-09-02 00:01:51', '1', '2020-09-01 21:01:51', '2020-09-01 21:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_recepient`
--

CREATE TABLE `tbl_message_recepient` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `message_content` varchar(300) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `scheduled_at` datetime NOT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_recipients`
--

CREATE TABLE `tbl_message_recipients` (
  `id` int(11) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mpesa_callbacks`
--

CREATE TABLE `tbl_mpesa_callbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `checkout_request_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout_request_body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_mpesa_callbacks`
--

INSERT INTO `tbl_mpesa_callbacks` (`id`, `checkout_request_id`, `checkout_request_body`, `created_at`, `updated_at`) VALUES
(1, 'ws_CO_300820201259330534', '{\"Body\":{\"stkCallback\":{\"MerchantRequestID\":\"11125-87851963-1\",\"CheckoutRequestID\":\"ws_CO_300820201259330534\",\"ResultCode\":0,\"ResultDesc\":\"The service request is processed successfully.\",\"CallbackMetadata\":{\"Item\":[{\"Name\":\"Amount\",\"Value\":1},{\"Name\":\"MpesaReceiptNumber\",\"Value\":\"OHU837MBFA\"},{\"Name\":\"Balance\"},{\"Name\":\"TransactionDate\",\"Value\":20200830125944},{\"Name\":\"PhoneNumber\",\"Value\":254726738394}]}}}}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_networks`
--

CREATE TABLE `tbl_networks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_networks`
--

INSERT INTO `tbl_networks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Safaricom', NULL, NULL),
(2, 'Airtel', NULL, NULL),
(3, 'Telkom', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_non_members`
--

CREATE TABLE `tbl_non_members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(300) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE `tbl_projects` (
  `id` bigint(255) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `project_name` varchar(255) NOT NULL,
  `completion_date_target` date NOT NULL,
  `target_amount` bigint(255) NOT NULL,
  `amount_raised` bigint(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `project_stage_id` int(191) NOT NULL,
  `status` varchar(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`id`, `church_id`, `project_name`, `completion_date_target`, `target_amount`, `amount_raised`, `start_date`, `project_stage_id`, `status`, `updated_at`, `created_at`) VALUES
(29, 2, 'Church painting', '2021-01-01', 10500, NULL, '2020-12-01', 1, 'Active', '2021-07-15 09:56:35', '2021-07-15 09:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_stages`
--

CREATE TABLE `tbl_project_stages` (
  `id` int(11) NOT NULL,
  `project_stage` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_project_stages`
--

INSERT INTO `tbl_project_stages` (`id`, `project_stage`, `updated_at`, `created_at`, `church_id`) VALUES
(1, 'Complete', '2021-07-08 13:49:10', '2021-07-08 13:49:10', 2),
(2, 'Incomplete', '2021-07-08 13:49:31', '2021-07-08 13:49:31', 2),
(3, 'Haulted', '2021-07-08 13:50:05', '2021-07-08 13:50:05', 2),
(4, 'Haulted', '2021-07-14 05:36:42', '2021-07-14 05:36:42', 42);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_residential_zones`
--

CREATE TABLE `tbl_residential_zones` (
  `id` int(11) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `zone_name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_residential_zones`
--

INSERT INTO `tbl_residential_zones` (`id`, `church_id`, `zone_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'JUDEA', 'Active', '2020-07-29 18:57:13', '2021-07-15 09:48:05'),
(2, 2, 'NAZARETH', 'Active', '2020-07-29 18:57:21', '2020-07-29 18:57:21'),
(3, 2, 'BETHLEHEM', 'Active', '2020-07-29 18:57:34', '2021-06-24 02:53:04'),
(4, 2, 'JERUSALEM', 'Active', '2020-07-29 18:58:33', '2021-06-29 04:28:04'),
(5, 3, 'ESTHERS', 'Active', '2020-07-29 19:23:12', '2020-07-29 19:23:12'),
(6, 3, 'HANNAS', 'Active', '2020-07-29 19:23:35', '2020-07-29 19:23:35'),
(7, 3, 'DEBORAH', 'Active', '2020-07-29 19:23:46', '2020-07-29 19:23:46'),
(8, 3, 'MARYS', 'Active', '2020-07-29 19:24:32', '2020-07-29 19:24:32'),
(9, 3, 'SARAH', 'Active', '2020-07-29 19:24:40', '2020-07-29 19:24:40'),
(10, 3, 'TABITHA', 'Active', '2020-07-29 19:24:51', '2020-07-29 19:24:51'),
(11, 4, 'Nairobi 1', 'Active', '2020-08-07 09:13:12', '2020-08-07 09:13:12'),
(12, 2, 'GOLGOTHA', 'Active', '2021-07-06 10:46:17', '2021-07-14 06:42:52'),
(13, 42, 'Kasina', 'Active', '2021-07-14 05:37:40', '2021-07-14 05:37:40'),
(14, 42, 'Gossip', 'Active', '2021-07-14 05:37:50', '2021-07-14 05:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedules`
--

CREATE TABLE `tbl_schedules` (
  `id` int(11) NOT NULL,
  `church_id` int(11) NOT NULL,
  `event_name` varchar(30) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `servicedate` date NOT NULL,
  `start_time` varchar(10) DEFAULT NULL,
  `end_time` varchar(10) DEFAULT NULL,
  `maxmembers` int(11) DEFAULT NULL,
  `event_status` varchar(20) DEFAULT NULL,
  `addedby` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_schedules`
--

INSERT INTO `tbl_schedules` (`id`, `church_id`, `event_name`, `service_id`, `servicedate`, `start_time`, `end_time`, `maxmembers`, `event_status`, `addedby`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 2, 'Youth Service', NULL, '2020-08-02', '7:00 AM', '8:00 AM', 100, 'Active', 2, '2020-07-29 19:01:06', '2020-07-29 19:01:06', NULL),
(2, 2, 'Bethlehem Service', NULL, '2020-08-02', '9:40 AM', '10:40 AM', 100, 'Active', 2, '2020-07-29 19:02:08', '2021-06-28 14:15:26', NULL),
(3, 2, 'Jerusalem Service', NULL, '2020-08-02', '11:00 AM', '12:00 PM', 100, 'Active', 2, '2020-07-29 19:02:56', '2020-07-29 19:02:56', NULL),
(4, 2, 'Judea & Nazareth', NULL, '2020-08-02', '8:20 AM', '9:20 AM', 100, 'Active', 2, '2020-07-29 19:03:54', '2020-07-29 19:05:12', NULL),
(5, 2, 'Teens Service', NULL, '2020-08-02', '9:00 AM', '10:00 AM', 100, 'Active', 2, '2020-07-29 19:04:30', '2020-07-29 19:04:56', NULL),
(6, 3, 'SUNDAY SERVICE 1', NULL, '2020-08-02', '8:30 AM', '9:30 AM', 100, 'Active', 3, '2020-07-29 19:28:24', '2020-07-29 19:28:24', NULL),
(7, 3, 'SUNDAY SERVICE 2', NULL, '2020-08-02', '10:00 AM', '11:00 AM', 100, 'Active', 3, '2020-07-29 19:29:16', '2020-07-29 19:29:16', NULL),
(8, 2, 'Sunday school', NULL, '2021-07-04', '10:00 AM', '12:30 PM', 70, 'Active', 2, '2021-06-28 13:56:41', '2021-06-28 13:56:41', NULL),
(9, 2, 'Sunday school', NULL, '2021-07-21', '4:15 AM', '4:15 PM', 100, 'Active', 2, '2021-07-08 10:06:41', '2021-07-08 10:06:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_serviceschedules`
--

CREATE TABLE `tbl_serviceschedules` (
  `id` int(11) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `maxmembers` int(11) DEFAULT NULL,
  `start_time` varchar(11) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `addedby` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_serviceschedules`
--

INSERT INTO `tbl_serviceschedules` (`id`, `church_id`, `name`, `maxmembers`, `start_time`, `end_time`, `description`, `status`, `addedby`, `created_at`, `updated_at`) VALUES
(1, 2, 'Youth Service', NULL, '8:30 AM', '8:30 AM', '1st service', 'Active', 22, '2020-08-07 09:14:10', '2021-07-16 03:46:08'),
(2, 2, 'English Service', NULL, '10:30 AM', '10:30 AM', '2nd service', 'Active', 22, '2020-08-07 09:27:56', '2021-07-16 03:45:39'),
(3, 2, 'Swahili Service', NULL, '12:30 PM', '12:30 PM', '3rd Service', 'Active', 2, '2021-06-29 05:31:56', '2021-07-16 03:45:52'),
(4, 2, 'Afternoon Service', NULL, '4:00 PM', '4:00 PM', '4th Service', 'Active', 2, '2021-06-29 14:27:45', '2021-07-16 03:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_log`
--

CREATE TABLE `tbl_sms_log` (
  `id` int(11) NOT NULL,
  `church_id` int(11) DEFAULT NULL,
  `sender` varchar(40) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `sent_to` varchar(15) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `network_id` int(11) DEFAULT NULL,
  `response_code` int(11) DEFAULT NULL,
  `response_desc` varchar(100) DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cost` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sms_log`
--

INSERT INTO `tbl_sms_log` (`id`, `church_id`, `sender`, `message`, `sent_to`, `message_id`, `category`, `network_id`, `response_code`, `response_desc`, `sent_at`, `created_at`, `updated_at`, `deleted_at`, `cost`) VALUES
(1, 2, '1', 'Hi there', '0726738394', 1, 'Test', 1, 200, 'Success', '2020-08-21 14:12:55', '2020-08-21 11:13:28', NULL, NULL, 0.00),
(2, NULL, 'SOLUTECH', 'hahaha', '0726738394', 153315069, NULL, 1, 200, 'Success', '2020-08-21 14:12:55', '2020-08-21 14:36:02', NULL, NULL, 0.00),
(3, 2, 'SOLUTECH', 'Hi testing church message.', '0718640103', 153324138, NULL, 1, 200, 'Success', '2020-08-21 14:12:55', '2020-08-21 15:07:02', NULL, NULL, 0.00),
(4, 2, 'SOLUTECH', 'Hi testing church message.', '0726738394', 153324141, NULL, 1, 200, 'Success', '2020-08-21 14:12:55', '2020-08-21 15:07:03', NULL, NULL, 0.00),
(5, 2, 'SOLUTECH', 'Hello there!', '0718640103', 153328363, NULL, 1, 200, 'Success', '2020-08-21 15:41:04', '2020-08-21 15:41:04', NULL, NULL, 0.00),
(6, 2, 'SOLUTECH', 'Hello there!', '0726738394', 153328366, NULL, 1, 200, 'Success', '2020-08-21 15:41:05', '2020-08-21 15:41:05', NULL, NULL, 0.00),
(7, 2, 'SOLUTECH', 'Hello', '0718640103', 154273131, NULL, 1, 200, 'Success', '2020-08-22 22:51:02', '2020-08-22 22:51:02', NULL, NULL, 0.00),
(8, 2, 'SOLUTECH', 'Hello', '0726738394', 154273132, NULL, 1, 200, 'Success', '2020-08-22 22:51:03', '2020-08-22 22:51:03', NULL, NULL, 0.00),
(9, 2, 'SOLUTECH', 'Hi there, this is testing.', '0718640103', 154273133, NULL, 1, 200, 'Success', '2020-08-22 22:51:03', '2020-08-22 22:51:03', NULL, NULL, 0.00),
(10, 2, 'SOLUTECH', 'Hi there, this is testing.', '0726738394', 154273134, NULL, 1, 200, 'Success', '2020-08-22 22:51:04', '2020-08-22 22:51:04', NULL, NULL, 0.00),
(12, 2, 'SOLUTECH', 'Hi Kelvin! Custom Properties Church app.', '0726738394', 154273337, NULL, 1, 200, 'Success', '2020-08-22 23:24:02', '2020-08-22 23:24:02', NULL, NULL, 0.00),
(13, 2, 'SOLUTECH', 'Hello  Kelvin, your email address is :  kelvinkibugi@gmail.com and your phone number is  0726738394. Thank you.', '0726738394', 154273754, NULL, 1, 200, 'Success', '2020-08-23 00:39:03', '2020-08-23 00:39:03', NULL, NULL, 0.00),
(14, 2, 'SOLUTECH', 'Hi  Kelvin, your email address is  kelvinkibugi@gmail.com and phone is :  0726738394. Thank you.', '0726738394', 154273784, NULL, 1, 200, 'Success', '2020-08-23 00:47:14', '2020-08-23 00:47:14', NULL, NULL, 0.00),
(15, 2, 'SOLUTECH', 'Hi  Kelvin, !', '0726738394', 154297185, NULL, 1, 200, 'Success', '2020-08-23 06:32:03', '2020-08-23 06:32:03', NULL, NULL, 0.00),
(16, 2, 'SOLUTECH', 'Hi  Kelvin, You are a Jerusalem Member.', '0726738394', 154710361, NULL, 1, 200, 'Success', '2020-08-24 08:26:03', '2020-08-24 08:26:03', NULL, NULL, 0.00),
(17, 2, 'SOLUTECH', 'Hi  Kelvin', '0726738394', 155167069, NULL, 1, 200, 'Success', '2020-08-25 21:58:03', '2020-08-25 21:58:03', NULL, NULL, 0.00),
(18, 2, 'SOLUTECH', 'Hi  Kelvin, testing units deduction.', '0726738394', 155318034, NULL, 1, 200, 'Success', '2020-08-26 13:15:02', '2020-08-26 13:15:02', NULL, NULL, 0.00),
(19, 2, 'SOLUTECH', 'Hi  Kelvin, testing cost.', '0726738394', 157203242, NULL, 1, 200, 'Success', '2020-09-01 23:59:02', '2020-09-01 23:59:02', NULL, NULL, 1.00),
(20, 2, 'SOLUTECH', 'Testing message with more than 160 characters so that we can calculate the total cost of the message based on rate, and splitting the message based on characters.', '0726738394', 157203277, NULL, 1, 200, 'Success', '2020-09-02 00:02:02', '2020-09-02 00:02:02', NULL, NULL, 1.74);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_rates`
--

CREATE TABLE `tbl_sms_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `church_id` int(11) NOT NULL,
  `rate` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_sms_rates`
--

INSERT INTO `tbl_sms_rates` (`id`, `church_id`, `rate`, `created_at`, `updated_at`) VALUES
(1, 2, 0.87, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `resets`
--
ALTER TABLE `resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_topups`
--
ALTER TABLE `sms_topups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_units`
--
ALTER TABLE `sms_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_churches`
--
ALTER TABLE `tbl_churches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contributions`
--
ALTER TABLE `tbl_contributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_expense_types`
--
ALTER TABLE `tbl_expense_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group_members`
--
ALTER TABLE `tbl_group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_incomes`
--
ALTER TABLE `tbl_incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_income_types`
--
ALTER TABLE `tbl_income_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_message_recepient`
--
ALTER TABLE `tbl_message_recepient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_message_recipients`
--
ALTER TABLE `tbl_message_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mpesa_callbacks`
--
ALTER TABLE `tbl_mpesa_callbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_networks`
--
ALTER TABLE `tbl_networks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_non_members`
--
ALTER TABLE `tbl_non_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_project_stages`
--
ALTER TABLE `tbl_project_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_residential_zones`
--
ALTER TABLE `tbl_residential_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_serviceschedules`
--
ALTER TABLE `tbl_serviceschedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sms_log`
--
ALTER TABLE `tbl_sms_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sms_rates`
--
ALTER TABLE `tbl_sms_rates`
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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resets`
--
ALTER TABLE `resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sms_topups`
--
ALTER TABLE `sms_topups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_units`
--
ALTER TABLE `sms_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_churches`
--
ALTER TABLE `tbl_churches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_contributions`
--
ALTER TABLE `tbl_contributions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_expense_types`
--
ALTER TABLE `tbl_expense_types`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_group_members`
--
ALTER TABLE `tbl_group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_incomes`
--
ALTER TABLE `tbl_incomes`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_income_types`
--
ALTER TABLE `tbl_income_types`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_message_recepient`
--
ALTER TABLE `tbl_message_recepient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_message_recipients`
--
ALTER TABLE `tbl_message_recipients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_mpesa_callbacks`
--
ALTER TABLE `tbl_mpesa_callbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_networks`
--
ALTER TABLE `tbl_networks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_non_members`
--
ALTER TABLE `tbl_non_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_project_stages`
--
ALTER TABLE `tbl_project_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_residential_zones`
--
ALTER TABLE `tbl_residential_zones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_serviceschedules`
--
ALTER TABLE `tbl_serviceschedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_sms_log`
--
ALTER TABLE `tbl_sms_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_sms_rates`
--
ALTER TABLE `tbl_sms_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
