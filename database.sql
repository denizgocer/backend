-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2021 at 07:49 AM
-- Server version: 5.5.65-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livestream_empty`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_image` text,
  `unique_key` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `email`, `password`, `profile_image`, `unique_key`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '123456', '1980774116987675292slash.jpg', 'janu123', '2021-01-15 04:05:48', NULL),
(3, 'test_admin', 'testadmin@gmail.com', '123456', '1980774116987675292slash.jpg', 'janu123', '2021-01-15 09:35:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branding_image`
--

CREATE TABLE IF NOT EXISTS `tbl_branding_image` (
  `branding_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_branding_image`
--

INSERT INTO `tbl_branding_image` (`branding_id`, `image`, `created_at`, `updated_at`) VALUES
(2, '1398911844asset_2.jpg', '2021-01-20 14:21:32', NULL),
(3, '1096158571asset_1.jpg', '2021-01-20 14:21:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_campaign`
--

CREATE TABLE IF NOT EXISTS `tbl_campaign` (
  `campaign_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `button_text` varchar(100) NOT NULL,
  `device_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for andriod,2 for ios, 3 for both',
  `link` text NOT NULL,
  `icon` text NOT NULL,
  `description` text NOT NULL,
  `banner_image` text NOT NULL,
  `interestial_image` text NOT NULL,
  `rewarded_video` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 for off/1 for on',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_campaign_analytics`
--

CREATE TABLE IF NOT EXISTS `tbl_campaign_analytics` (
  `id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `device_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for andriod/2 for ios',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat_message`
--

CREATE TABLE IF NOT EXISTS `tbl_chat_message` (
  `message_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-image,2-voice,3-text',
  `message_file_text` text NOT NULL,
  `content` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_chat_message`
--

INSERT INTO `tbl_chat_message` (`message_id`, `type`, `message_file_text`, `content`, `created_at`, `updated_at`) VALUES
(3, 2, '1306900114pal-pal-dil-ke-paas-51195.mp3', 'Voice Msg', '2021-01-25 06:03:15', NULL),
(12, 1, '1590585339mgirl23.jpg', 'can we meet ?', '2021-03-24 15:35:13', '2021-03-31 10:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_chat_profile` (
  `profile_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `bio` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_chat_profile`
--

INSERT INTO `tbl_chat_profile` (`profile_id`, `name`, `image`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Jeff Zukerberg', '898720274A_83701_US3.jpg', 'Mighty Dev..', '2021-01-25 06:02:19', '2021-03-24 04:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coin_package`
--

CREATE TABLE IF NOT EXISTS `tbl_coin_package` (
  `coin_pkg_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `coin_amount` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `playstore_product_id` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_coin_package`
--

INSERT INTO `tbl_coin_package` (`coin_pkg_id`, `image`, `coin_amount`, `price`, `playstore_product_id`, `created_at`, `updated_at`) VALUES
(1, '1431214385RetryTech-0122091047.png', 500, '100', 'android.test.purchased', '2021-01-25 06:04:13', '2021-03-02 05:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coin_pkg_offer`
--

CREATE TABLE IF NOT EXISTS `tbl_coin_pkg_offer` (
  `offer_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `coin_amount` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `playstore_product_id` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_coin_pkg_offer`
--

INSERT INTO `tbl_coin_pkg_offer` (`offer_id`, `image`, `coin_amount`, `price`, `playstore_product_id`, `created_at`, `updated_at`) VALUES
(1, '1800458802swipe-left.png', 500, '50', 'ddddd', '2021-01-25 06:06:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `comment`, `country_id`, `created_at`, `updated_at`) VALUES
(2, 'test 4545', 3, '2021-01-15 05:38:40', '2021-02-20 06:12:31'),
(4, 'hello', 3, '2021-01-15 05:38:40', '2021-01-15 05:40:57'),
(5, 'hello', 1, '2021-01-18 04:39:46', NULL),
(7, ' how are you', 1, '2021-01-18 04:39:46', NULL),
(8, 'Hey', 1, '2021-01-27 07:01:13', NULL),
(9, 'hii babes!!', 3, '2021-02-20 18:11:14', '2021-02-20 06:12:38'),
(10, 'you are so hot', 2, '2021-02-20 18:11:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE IF NOT EXISTS `tbl_country` (
  `country_id` int(11) NOT NULL,
  `country` varchar(150) NOT NULL,
  `country_media` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`country_id`, `country`, `country_media`, `created_at`, `updated_at`) VALUES
(1, 'India', '143806341Flag-India.jpg', '2021-01-15 04:37:21', '2021-01-27 04:32:20'),
(2, 'USA', '85424332154435448-united-states-flag-usa-flag-american-symbol.jpg', '2021-01-15 04:38:55', '2021-01-27 04:32:03'),
(3, 'UK', '1741803979584177_0.png', '2021-01-15 04:39:08', '2021-01-27 04:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gift`
--

CREATE TABLE IF NOT EXISTS `tbl_gift` (
  `gift_id` int(11) NOT NULL,
  `gift_media` text NOT NULL,
  `coins` int(11) NOT NULL,
  `gift_cat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gift`
--

INSERT INTO `tbl_gift` (`gift_id`, `gift_media`, `coins`, `gift_cat_id`, `created_at`, `updated_at`) VALUES
(1, '2107033306800px_COLOURBOX4200269.jpg', 12, 1, '2021-01-25 06:35:40', '2021-01-25 06:35:59'),
(2, '1855886533in-love.png', 25, 2, '2021-01-25 06:38:12', NULL),
(3, '1891138446mario_PNG53.png', 23, 2, '2021-01-25 07:43:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gift_category`
--

CREATE TABLE IF NOT EXISTS `tbl_gift_category` (
  `gift_cat_id` int(11) NOT NULL,
  `gift_cat_name` varchar(150) NOT NULL,
  `gift_cat_media` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gift_category`
--

INSERT INTO `tbl_gift_category` (`gift_cat_id`, `gift_cat_name`, `gift_cat_media`, `created_at`, `updated_at`) VALUES
(1, 'Hearts', '12748889005c5014acdd102a6c36b506ad_1548752044003.jpg', '2021-01-25 06:35:31', '2021-01-25 06:35:53'),
(2, 'Emoji', '1119770440sad.png', '2021-01-25 06:37:55', '2021-01-27 04:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int(11) NOT NULL,
  `admob_publisher_id` varchar(100) NOT NULL,
  `admob_banner_id` varchar(100) NOT NULL,
  `admob_interestial_id` varchar(100) NOT NULL,
  `admob_rewarded_id` varchar(100) NOT NULL,
  `admob_native_id` text NOT NULL,
  `fb_banner_id` varchar(100) NOT NULL,
  `fb_interestial_id` varchar(100) NOT NULL,
  `fb_rewarded_id` varchar(100) NOT NULL,
  `fb_native_id` text NOT NULL,
  `video_ad_bonus` varchar(100) NOT NULL,
  `log_in_bonus` varchar(100) NOT NULL,
  `refer_friend_bonus` varchar(100) NOT NULL,
  `seconds_for_ad` varchar(100) NOT NULL,
  `seconds_for_call` varchar(100) NOT NULL,
  `razorpay_key_id` varchar(100) NOT NULL,
  `razorpay_key_secret` varchar(100) NOT NULL,
  `google_play_key` text NOT NULL,
  `more_apps_url` varchar(100) NOT NULL,
  `privacy_policy` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `admob_publisher_id`, `admob_banner_id`, `admob_interestial_id`, `admob_rewarded_id`, `admob_native_id`, `fb_banner_id`, `fb_interestial_id`, `fb_rewarded_id`, `fb_native_id`, `video_ad_bonus`, `log_in_bonus`, `refer_friend_bonus`, `seconds_for_ad`, `seconds_for_call`, `razorpay_key_id`, `razorpay_key_secret`, `google_play_key`, `more_apps_url`, `privacy_policy`, `created_at`, `updated_at`) VALUES
(1, 'ZX12313', 'ca-app-pub-3940256099942544/6300978111', 'ca-app-pub-3940256099942544/1033173712', 'ca-app-pub-3940256099942544/5224354917', 'ca-app-pub-3940256099942544/2247696110', 'IMG_16_9_APP_INSTALL#YOUR_PLACEMENT_ID', 'IMG_16_9_APP_INSTALL#YOUR_PLACEMENT_ID', 'CAROUSEL_IMG_SQUARE_APP_INSTALL#YOUR_PLACEMENT_ID', 'IMG_16_9_APP_INSTALL#YOUR_PLACEMENT_ID', 'sada', 'asd', 'asd', 'asdas', 'dasd', 'rzp_test_NL6XS4I2l7Z5yP', 'sada', '', 'asd', 'asdas', '2021-01-25 06:01:27', '2021-03-30 05:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_profile` varchar(200) NOT NULL,
  `login_type` varchar(20) NOT NULL COMMENT 'facebook OR google',
  `identity` text NOT NULL,
  `device_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for andriod , 2 for ios',
  `device_token` longtext NOT NULL,
  `token` longtext NOT NULL,
  `my_wallet` int(11) NOT NULL,
  `fb_url` text NOT NULL,
  `insta_url` text NOT NULL,
  `youtube_url` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE IF NOT EXISTS `tbl_video` (
  `video_id` int(11) NOT NULL,
  `video` text NOT NULL,
  `thumb_img` text NOT NULL,
  `name` varchar(200) NOT NULL,
  `country_id` int(11) NOT NULL,
  `bio` text NOT NULL,
  `rate` int(11) NOT NULL,
  `image_gallery` text NOT NULL,
  `video_gallery` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`video_id`, `video`, `thumb_img`, `name`, `country_id`, `bio`, `rate`, `image_gallery`, `video_gallery`, `created_at`, `updated_at`) VALUES
(7, '1722214992DoveGirlILiveInstagram8.mp4', '270034199vlcsnap-2021-02-21-12h53m12s141.png', 'Jenny', 3, 'I love boys', 90, '', '', '2021-02-21 07:24:13', NULL),
(8, '2133468477KenishaAwasthiILiveInstagram20.mp4', '1744813460vlcsnap-2021-02-21-12h53m29s477.png', 'Radha', 1, 'I am Radha', 90, '', '', '2021-02-21 07:32:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_branding_image`
--
ALTER TABLE `tbl_branding_image`
  ADD PRIMARY KEY (`branding_id`);

--
-- Indexes for table `tbl_campaign`
--
ALTER TABLE `tbl_campaign`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `tbl_campaign_analytics`
--
ALTER TABLE `tbl_campaign_analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_chat_message`
--
ALTER TABLE `tbl_chat_message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_chat_profile`
--
ALTER TABLE `tbl_chat_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `tbl_coin_package`
--
ALTER TABLE `tbl_coin_package`
  ADD PRIMARY KEY (`coin_pkg_id`);

--
-- Indexes for table `tbl_coin_pkg_offer`
--
ALTER TABLE `tbl_coin_pkg_offer`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tbl_gift`
--
ALTER TABLE `tbl_gift`
  ADD PRIMARY KEY (`gift_id`);

--
-- Indexes for table `tbl_gift_category`
--
ALTER TABLE `tbl_gift_category`
  ADD PRIMARY KEY (`gift_cat_id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_branding_image`
--
ALTER TABLE `tbl_branding_image`
  MODIFY `branding_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_campaign`
--
ALTER TABLE `tbl_campaign`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_campaign_analytics`
--
ALTER TABLE `tbl_campaign_analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_chat_message`
--
ALTER TABLE `tbl_chat_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_chat_profile`
--
ALTER TABLE `tbl_chat_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_coin_package`
--
ALTER TABLE `tbl_coin_package`
  MODIFY `coin_pkg_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_coin_pkg_offer`
--
ALTER TABLE `tbl_coin_pkg_offer`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_gift`
--
ALTER TABLE `tbl_gift`
  MODIFY `gift_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_gift_category`
--
ALTER TABLE `tbl_gift_category`
  MODIFY `gift_cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
