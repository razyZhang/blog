-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-09-01 02:00:03
-- 服务器版本： 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.2.3-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestead`
--

-- --------------------------------------------------------

--
-- 表的结构 `backend_admins`
--

CREATE TABLE `backend_admins` (
  `id` int(20) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 NOT NULL,
  `power` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 转存表中的数据 `backend_admins`
--

INSERT INTO `backend_admins` (`id`, `name`, `password`, `power`, `created_at`, `updated_at`) VALUES
(2, 'admin', '$2y$10$HBtmktrH55fUdTtvMZMShOMuJlYysRe7xjacc5g5pw4ZgxXbRn7E6', NULL, '2018-07-19 05:58:45', '2018-07-19 05:58:45'),
(4, 'razy', '$2y$10$cvueQg27YkS0gt0H5lfMcO8CnXz5Fs92tmXXpsU9b8VyEgTO.rJGK', NULL, '2018-08-03 10:41:55', '2018-08-03 10:41:55');

-- --------------------------------------------------------

--
-- 表的结构 `backend_article`
--

CREATE TABLE `backend_article` (
  `id` int(100) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `abstract` varchar(200) CHARACTER SET utf8 NOT NULL,
  `banner` varchar(100) CHARACTER SET utf8 NOT NULL,
  `author` varchar(20) CHARACTER SET utf8 NOT NULL,
  `content` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `pubdate` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `publish` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 转存表中的数据 `backend_article`
--

INSERT INTO `backend_article` (`id`, `title`, `abstract`, `banner`, `author`, `content`, `created_at`, `pubdate`, `updated_at`, `publish`) VALUES
(1, 'T1', 'A1', '/storage/banner/banner_20180811_1731.png', 'razy', '/storage/draft/html_f33853ca05b3.txt', '2018-08-11 01:52:25', NULL, '2018-08-11 01:52:25', 'false'),
(2, '我是一个比较长的标题', 'A2', '/storage/banner/banner_20180811_1654.png', 'razy', '/storage/draft/html_0ca6460ae757.txt', '2018-08-11 17:14:52', NULL, '2018-08-11 17:14:52', 'false'),
(3, 'T3', 'A3', '/storage/banner/banner_20180811_2314.png', 'razy', '/storage/draft/html_b9d52a7608c6.txt', '2018-08-11 19:36:33', NULL, '2018-08-11 19:36:33', 'false'),
(4, 'T4', 'A4', '/storage/banner/banner_20180812_7780.png', 'razy', '/storage/draft/html_2c633ee5ea58.txt', '2018-08-12 17:53:58', NULL, '2018-08-12 17:53:58', 'false'),
(5, '炭', 'TANTAN12345678931235465132138546413153', '/storage/banner/banner_20180812_5680.png', 'razy', '/storage/draft/html_13d85b43c793.txt', '2018-08-12 17:57:21', NULL, '2018-08-12 17:57:21', 'false'),
(6, 'T5', 'A5', '/storage/banner/banner_20180812_1834.png', 'razy', '/storage/draft/html_0353b8aee7d4.txt', '2018-08-12 23:01:48', NULL, '2018-08-12 23:01:48', 'false'),
(7, 't6', 'A6', '/storage/banner/banner_20180812_7447.png', 'razy', '/storage/draft/html_43912592f3a2.txt', '2018-08-12 23:02:31', NULL, '2018-08-12 23:02:31', 'false'),
(8, 'T7', 'A7', '/storage/banner/banner_20180812_1768.png', 'razy', '/storage/draft/html_4ccc0919bffc.txt', '2018-08-12 23:02:54', NULL, '2018-08-12 23:02:54', 'false'),
(9, 'T8', 'A8', '/storage/banner/banner_20180812_9157.png', 'razy', '/storage/draft/html_c5242f8cdf22.txt', '2018-08-12 23:23:25', NULL, '2018-08-12 23:23:25', 'false'),
(10, 'T9', 'A9', '/storage/banner/banner_20180812_2229.png', 'razy', '/storage/draft/html_40bfcda4ac95.txt', '2018-08-12 23:23:56', NULL, '2018-08-14 14:44:52', 'false'),
(11, 'T10', 'A10', '/storage/banner/banner_20180812_8458.png', 'razy', '/storage/draft/html_6b1e682d292e.txt', '2018-08-12 23:24:56', NULL, '2018-08-12 23:24:56', 'false'),
(12, 'T11', 'A11', '/storage/banner/banner_20180812_4001.png', 'razy', '/storage/draft/html_9f8c9fde4d1c.txt', '2018-08-12 23:25:33', NULL, '2018-08-12 23:25:33', 'false'),
(13, 'T12', 'A12', '/storage/banner/banner_20180812_9692.png', 'razy', '/storage/draft/html_4d6c4f809316.txt', '2018-08-12 23:26:06', NULL, '2018-08-12 23:26:06', 'false'),
(14, 'T13', 'A13', '/storage/banner/banner_20180813_2613.png', 'razy', '/storage/draft/html_a196f48bf1aa.txt', '2018-08-13 02:43:34', NULL, '2018-08-13 02:43:34', 'false'),
(15, 'T14中英文test标题', 'aravel 内置的 Eloquent ORM 提供了一个美观、简单的与数据库打交道的 ActiveRecord 实现，每张数据表都对应一个与该表进行交互的模型（Model），通过模型类，你可以对数据表进行查询、插入、更新、删除等操作。', '/storage/banner/banner_20180813_2671.png', 'razy', '/storage/draft/html_0d51f3eb77ba.txt', '2018-08-13 02:43:56', NULL, '2018-08-31 16:31:57', 'false');

-- --------------------------------------------------------

--
-- 表的结构 `backend_invite_code`
--

CREATE TABLE `backend_invite_code` (
  `id` int(100) NOT NULL,
  `host` varchar(100) CHARACTER SET utf8 NOT NULL,
  `code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- 表的结构 `backend_signs`
--

CREATE TABLE `backend_signs` (
  `id` int(100) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `rsa_private_key` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `rsa_public_key` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `hash_key` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 转存表中的数据 `backend_signs`
--

INSERT INTO `backend_signs` (`id`, `name`, `rsa_private_key`, `rsa_public_key`, `hash_key`, `created_at`, `updated_at`) VALUES
(3, 'razy', 'signature/9d3aec631fa3.pem', 'signature/c6ff27373f98.pem', '$2y$10$Qbce4tgQ2F7x70qLCbdFyOjr65DuPIhrIRVQKYXMzsbI3R5as/mkm', '2018-08-20 00:43:06', '2018-08-20 00:43:06'),
(4, 'haha', 'signature/6deb804738f6.pem', 'signature/02666e1ef16e.pem', '919196', '2018-08-20 02:26:17', '2018-08-20 02:26:17');

-- --------------------------------------------------------

--
-- 表的结构 `backend_users`
--

CREATE TABLE `backend_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invitor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `backend_users`
--

INSERT INTO `backend_users` (`id`, `name`, `avatar`, `email`, `invitor`, `password`, `nickname`, `intro`, `label`, `experience`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'razy', '/storage/avatar/avatar_20180803_9817.png', '15626215326@163.com', '18538845196', '$2y$10$UMc/JyrZHtDp4MyY/UbQ5ONXE2XH.UeeQq0y6OgCEXXyX2eB1jcqC', 'DevilGenius', '一天一夜不睡觉你是魔鬼么？！', 'PHP爱好者', '写一段话随便测试一下关于我们的功能设置，这是一段测试，一段测试。', 'UTMRdzjqXVuuA8B9Gb9ZtMXdG4SQTMOFxtQaX2ryruwgD8k4hNKtcuLACZtV', '2018-08-03 10:41:55', '2018-08-31 17:45:35'),
(4, 'haha', '/storage/avatar/avatar_20180820_9148.png', '690724768@qq.com', 'razy', '$2y$10$pt/4hwayKFSkGXjnYfdUB.dvvVFZNnOlV0T5d2ktaldwRNjJqTkBy', '', '', '测试人员', 'Bootstrap 提供了两种形式的压缩包，在下载下来的压缩包内可以看到以下目录和文件，这些文件按照类别放到了不同的目录内，并且提供了压缩与未压缩两种版本。', 'X7S8ZoqvKghRo3rE3GEbBFUQ4MdfeD5WQjovs8wUtBH0y9558zZndKEWtCha', '2018-08-20 02:26:17', '2018-08-20 02:26:17');

-- --------------------------------------------------------

--
-- 表的结构 `pit_attachments`
--

CREATE TABLE `pit_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `hash1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `md5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipaddress` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `pit_categorys`
--

CREATE TABLE `pit_categorys` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_parent` int(11) NOT NULL DEFAULT '0',
  `category_flag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipaddress` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `pit_categorys`
--

INSERT INTO `pit_categorys` (`id`, `category_name`, `category_parent`, `category_flag`, `category_description`, `ipaddress`, `created_at`, `updated_at`) VALUES
(1, 'PHP', 0, 'php', '', '127.0.0.1', '2017-03-31 03:26:06', '2017-03-31 03:26:06'),
(2, 'Laravel', 0, 'laravel', '', '127.0.0.1', '2017-03-31 03:26:15', '2017-03-31 03:26:15'),
(3, 'Linux', 0, 'linux', '', '127.0.0.1', '2017-03-31 03:26:23', '2017-03-31 03:26:23'),
(4, 'MySQL', 0, 'database', '', '127.0.0.1', '2017-03-31 03:26:33', '2017-03-31 03:26:33');

-- --------------------------------------------------------

--
-- 表的结构 `pit_comments`
--

CREATE TABLE `pit_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `posts_id` int(11) DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci,
  `markdown` text COLLATE utf8mb4_unicode_ci,
  `ipaddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0.0.0.0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `pit_links`
--

CREATE TABLE `pit_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `ipaddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0.0.0.0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `pit_migrations`
--

CREATE TABLE `pit_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `pit_migrations`
--

INSERT INTO `pit_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2017_02_03_022101_create_posts_table', 1),
(9, '2017_02_03_022111_create_links_table', 1),
(10, '2017_02_03_022130_create_comments_table', 1),
(11, '2017_02_03_022153_create_navications_table', 1),
(12, '2017_02_04_075028_create_tags_table', 1),
(13, '2017_02_04_075515_create_attachments_table', 1),
(14, '2017_02_04_075515_create_categorys_table', 1),
(15, '2017_02_16_025119_create_options_table', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pit_navications`
--

CREATE TABLE `pit_navications` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `pit_oauth_access_tokens`
--

CREATE TABLE `pit_oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backend_admins`
--
ALTER TABLE `backend_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backend_article`
--
ALTER TABLE `backend_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backend_invite_code`
--
ALTER TABLE `backend_invite_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backend_signs`
--
ALTER TABLE `backend_signs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backend_users`
--
ALTER TABLE `backend_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `pit_attachments`
--
ALTER TABLE `pit_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pit_categorys`
--
ALTER TABLE `pit_categorys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorys_category_flag_unique` (`category_flag`);

--
-- Indexes for table `pit_comments`
--
ALTER TABLE `pit_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pit_links`
--
ALTER TABLE `pit_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pit_migrations`
--
ALTER TABLE `pit_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pit_navications`
--
ALTER TABLE `pit_navications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pit_oauth_access_tokens`
--
ALTER TABLE `pit_oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `backend_admins`
--
ALTER TABLE `backend_admins`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `backend_article`
--
ALTER TABLE `backend_article`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `backend_invite_code`
--
ALTER TABLE `backend_invite_code`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `backend_signs`
--
ALTER TABLE `backend_signs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `backend_users`
--
ALTER TABLE `backend_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `pit_attachments`
--
ALTER TABLE `pit_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pit_categorys`
--
ALTER TABLE `pit_categorys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `pit_comments`
--
ALTER TABLE `pit_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pit_links`
--
ALTER TABLE `pit_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pit_migrations`
--
ALTER TABLE `pit_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `pit_navications`
--
ALTER TABLE `pit_navications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
