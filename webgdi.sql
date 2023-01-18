/*
 Navicat Premium Data Transfer

 Source Server         : mysqlOffline
 Source Server Type    : MySQL
 Source Server Version : 50740
 Source Host           : localhost:3306
 Source Schema         : webgdi

 Target Server Type    : MySQL
 Target Server Version : 50740
 File Encoding         : 65001

 Date: 18/01/2023 21:26:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banks
-- ----------------------------
DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` enum('bank','emoney') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` enum('A','NA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banks
-- ----------------------------
INSERT INTO `banks` VALUES (1, 'bank', 'BSI (Bank Syariah Indonesia)', '711 411 4116', 'Yayasan Graha Dhuafa Indonesia', NULL, '2023-01-18 02:04:38', '2023-01-18 02:04:38', NULL, 'A');
INSERT INTO `banks` VALUES (2, 'bank', 'BCA', '639 596 9793', 'Yayasan Graha Dhuafa Indonesia', NULL, '2023-01-18 02:05:22', '2023-01-18 02:05:22', NULL, 'A');
INSERT INTO `banks` VALUES (3, 'bank', 'Bank Muamalat', '318 000 8411', 'Yayasan Graha Dhuafa Indonesia', NULL, '2023-01-18 02:05:55', '2023-01-18 02:05:55', NULL, 'A');
INSERT INTO `banks` VALUES (4, 'bank', 'BRI', '1107 01 000326 56 0', 'Yayasan Graha Dhuafa Indonesia', NULL, '2023-01-18 02:06:35', '2023-01-18 02:06:35', NULL, 'A');
INSERT INTO `banks` VALUES (5, 'emoney', 'QRIS', '-', 'Yayasan Graha Dhuafa Indonesia', 'images/code\\qris.png', '2023-01-18 02:08:24', '2023-01-18 02:10:48', NULL, 'A');

-- ----------------------------
-- Table structure for blogs
-- ----------------------------
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `page_type` enum('page','url') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `featured_img` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('draft','publish') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date_publish` timestamp NULL DEFAULT NULL,
  `hashtag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `user_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blogs
-- ----------------------------
INSERT INTO `blogs` VALUES (1, 'Ultrices eros in cursus turpis massa tincidunt', 'page', NULL, 'ultrices-eros-in-cursus-turpis-massa-tincidunt', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet mattis vulputate enim nulla aliquet. Velit aliquet sagittis id consectetur purus ut faucibus. Nec feugiat nisl pretium fusce id velit. Ultrices vitae auctor eu augue ut lectus. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus aenean. Tempus urna et pharetra pharetra massa massa. Dolor sit amet consectetur adipiscing. Faucibus interdum posuere lorem ipsum dolor. Faucibus purus in massa tempor. Massa placerat duis ultricies lacus sed. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Fermentum leo vel orci porta non pulvinar. Ultricies integer quis auctor elit.</p>\r\n<p>Ultrices eros in cursus turpis massa tincidunt. Senectus et netus et malesuada. Nunc pulvinar sapien et ligula. Augue eget arcu dictum varius duis at consectetur lorem. Vivamus at augue eget arcu dictum varius. Erat nam at lectus urna duis convallis. Eu ultrices vitae auctor eu augue ut lectus arcu bibendum. In mollis nunc sed id semper risus. Sit amet massa vitae tortor condimentum lacinia. Turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ligula ullamcorper malesuada proin libero nunc. Elit eget gravida cum sociis natoque penatibus et. Dolor sit amet consectetur adipiscing elit ut aliquam purus.</p>\r\n<p>Libero volutpat sed cras ornare arcu dui vivamus. Luctus venenatis lectus magna fringilla. Pharetra magna ac placerat vestibulum. Sit amet risus nullam eget felis eget. Diam quis enim lobortis scelerisque fermentum dui faucibus in ornare. Vitae auctor eu augue ut. Risus quis varius quam quisque id diam vel quam elementum. Orci ac auctor augue mauris augue neque. Nec ultrices dui sapien eget mi. Elit eget gravida cum sociis natoque penatibus et magnis. Urna cursus eget nunc scelerisque viverra mauris in aliquam. Enim eu turpis egestas pretium aenean. Tincidunt augue interdum velit euismod in pellentesque massa placerat. Facilisis sed odio morbi quis commodo odio aenean. Ultrices mi tempus imperdiet nulla malesuada pellentesque elit. Turpis in eu mi bibendum. Nunc faucibus a pellentesque sit amet porttitor eget. Ullamcorper dignissim cras tincidunt lobortis feugiat.</p>\r\n<p>Egestas quis ipsum suspendisse ultrices gravida. Hendrerit dolor magna eget est. In fermentum et sollicitudin ac orci. Enim lobortis scelerisque fermentum dui. Faucibus pulvinar elementum integer enim neque volutpat ac tincidunt vitae. Gravida neque convallis a cras semper auctor neque vitae. Amet mattis vulputate enim nulla aliquet porttitor lacus. Penatibus et magnis dis parturient montes nascetur ridiculus mus. Sit amet nulla facilisi morbi. Nunc scelerisque viverra mauris in aliquam. Diam in arcu cursus euismod.</p>\r\n<p>Nec feugiat in fermentum posuere urna nec tincidunt praesent semper. Sit amet nisl purus in mollis nunc. Varius quam quisque id diam vel quam elementum. Egestas purus viverra accumsan in nisl nisi scelerisque eu ultrices. Laoreet id donec ultrices tincidunt arcu non sodales. Vel pretium lectus quam id leo. A lacus vestibulum sed arcu non. Risus viverra adipiscing at in tellus integer. Nisi lacus sed viverra tellus. Ipsum dolor sit amet consectetur adipiscing elit. Nam aliquam sem et tortor consequat id.</p>', 'images/blog\\8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg', 'Sample Category', 'publish', 'Administrator', '2023-01-18 02:29:48', NULL, NULL, '2023-01-18 02:29:48', '2023-01-18 02:29:48', NULL);
INSERT INTO `blogs` VALUES (2, 'Vehicula ipsum a arcu cursus vitae congue mauris rhoncus aenean', 'page', NULL, 'vehicula-ipsum-a-arcu-cursus-vitae-congue-mauris-rhoncus-aenean', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet mattis vulputate enim nulla aliquet. Velit aliquet sagittis id consectetur purus ut faucibus. Nec feugiat nisl pretium fusce id velit. Ultrices vitae auctor eu augue ut lectus. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus aenean. Tempus urna et pharetra pharetra massa massa. Dolor sit amet consectetur adipiscing. Faucibus interdum posuere lorem ipsum dolor. Faucibus purus in massa tempor. Massa placerat duis ultricies lacus sed. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Fermentum leo vel orci porta non pulvinar. Ultricies integer quis auctor elit.</p>\r\n<p>Ultrices eros in cursus turpis massa tincidunt. Senectus et netus et malesuada. Nunc pulvinar sapien et ligula. Augue eget arcu dictum varius duis at consectetur lorem. Vivamus at augue eget arcu dictum varius. Erat nam at lectus urna duis convallis. Eu ultrices vitae auctor eu augue ut lectus arcu bibendum. In mollis nunc sed id semper risus. Sit amet massa vitae tortor condimentum lacinia. Turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ligula ullamcorper malesuada proin libero nunc. Elit eget gravida cum sociis natoque penatibus et. Dolor sit amet consectetur adipiscing elit ut aliquam purus.</p>\r\n<p>Libero volutpat sed cras ornare arcu dui vivamus. Luctus venenatis lectus magna fringilla. Pharetra magna ac placerat vestibulum. Sit amet risus nullam eget felis eget. Diam quis enim lobortis scelerisque fermentum dui faucibus in ornare. Vitae auctor eu augue ut. Risus quis varius quam quisque id diam vel quam elementum. Orci ac auctor augue mauris augue neque. Nec ultrices dui sapien eget mi. Elit eget gravida cum sociis natoque penatibus et magnis. Urna cursus eget nunc scelerisque viverra mauris in aliquam. Enim eu turpis egestas pretium aenean. Tincidunt augue interdum velit euismod in pellentesque massa placerat. Facilisis sed odio morbi quis commodo odio aenean. Ultrices mi tempus imperdiet nulla malesuada pellentesque elit. Turpis in eu mi bibendum. Nunc faucibus a pellentesque sit amet porttitor eget. Ullamcorper dignissim cras tincidunt lobortis feugiat.</p>\r\n<p>Egestas quis ipsum suspendisse ultrices gravida. Hendrerit dolor magna eget est. In fermentum et sollicitudin ac orci. Enim lobortis scelerisque fermentum dui. Faucibus pulvinar elementum integer enim neque volutpat ac tincidunt vitae. Gravida neque convallis a cras semper auctor neque vitae. Amet mattis vulputate enim nulla aliquet porttitor lacus. Penatibus et magnis dis parturient montes nascetur ridiculus mus. Sit amet nulla facilisi morbi. Nunc scelerisque viverra mauris in aliquam. Diam in arcu cursus euismod.</p>\r\n<p>Nec feugiat in fermentum posuere urna nec tincidunt praesent semper. Sit amet nisl purus in mollis nunc. Varius quam quisque id diam vel quam elementum. Egestas purus viverra accumsan in nisl nisi scelerisque eu ultrices. Laoreet id donec ultrices tincidunt arcu non sodales. Vel pretium lectus quam id leo. A lacus vestibulum sed arcu non. Risus viverra adipiscing at in tellus integer. Nisi lacus sed viverra tellus. Ipsum dolor sit amet consectetur adipiscing elit. Nam aliquam sem et tortor consequat id.</p>', 'images/blog\\2e10e7a278d7e5b7b0bf939a2399f97a.jpg', 'Fundraising', 'publish', 'Administrator', '2023-01-18 09:52:53', NULL, NULL, '2023-01-18 09:52:53', '2023-01-18 09:52:53', NULL);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_type` enum('page','url') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_type` enum('general','contact','blog_list','program_list','gallery','homepage') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `order` int(11) NULL DEFAULT NULL,
  `status_display` enum('draft','publish') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `footer_display` enum('A','NA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `user_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Program', 0, 'page', 'program_list', NULL, 'program', NULL, 'publish', NULL, 'A', NULL, NULL, '2023-01-15 04:46:29', '2023-01-15 15:24:50', NULL);
INSERT INTO `menus` VALUES (2, 'Blog', 0, 'page', 'blog_list', NULL, 'blog', NULL, 'publish', NULL, 'A', NULL, NULL, '2023-01-15 04:46:56', '2023-01-15 15:25:45', NULL);
INSERT INTO `menus` VALUES (3, 'Galeri', 0, 'page', 'gallery', NULL, 'galeri', NULL, 'publish', NULL, 'A', NULL, NULL, '2023-01-15 15:26:07', '2023-01-15 15:26:07', NULL);
INSERT INTO `menus` VALUES (4, 'Tentang Yayasan', 0, 'page', 'general', '<h2>\r\n    <b>LATAR BELAKANG</b>\r\n</h2>\r\n<p>\r\n    Saat ini kondisi lingkungan indonesia yang masih tinggi tingkat kesenjangan sosial, pergaulan bebas, angka kematian ibu dan bayi, serta berbagai fenomena negatif lainnya, menunjukan bahwa tingkat kesejahteraan masyarakat indonesia masih rendah. Hal ini disebabkan oleh beberapa faktor diantaranya yaitu rendahnya ilmu, iman, ekonomi dan lainnya.\r\n</p>\r\n<p>\r\n    Masyarakat yang berkekurangan di bidang ilmu, iman, ekonomi, sosial dan lain-lain termasuk dalam kategori dhuafa. Berdasarkan pada UU no 11 Tahun 2009 tentang kesejahteraan sosial dan Sila ke 5 keadilan sosial bagi seluruh rakyat Indonesia, maka kami peduli dan terdorong untuk membangun kesejahteraan Masyarakat Indonesia dengan memberikan motivasi, wawasan, serta skill yang menunjukan pengembangan SDM dan kemajuan Bangsa melalui program-program yang diselenggarakan oleh Graha Dhuafa Indonesia.\r\n</p>\r\n<p></p>\r\n<p>\r\n    VISI\r\n</p>\r\n<div class=\"about-one__quote\">\r\n<p>\r\n    Menjadi lembaga global yang profesional untuk peduli menjaga generasi mandiri dan unggul\r\n</p>\r\n</div>', 'tentang-yayasan', NULL, 'publish', NULL, 'A', NULL, NULL, '2023-01-15 15:29:27', '2023-01-15 15:29:27', NULL);
INSERT INTO `menus` VALUES (5, 'Kontak', 0, 'page', 'contact', NULL, 'kontak', NULL, 'publish', NULL, 'A', NULL, NULL, '2023-01-15 15:30:02', '2023-01-15 16:56:24', NULL);

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `date_send` timestamp NULL DEFAULT NULL,
  `status` enum('new','read') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES (1, 'Floriananda Rosa', 'rosafloriananda@gmail.com', 'Sample message', 'sample message', '2023-01-18 11:28:27', 'new', NULL, '2023-01-18 11:28:27', '2023-01-18 11:28:27', NULL, NULL);
INSERT INTO `messages` VALUES (2, 'Floriananda Rosa', 'rosafloriananda@gmail.com', 'Sample message', 'sample message', '2023-01-18 11:29:36', 'new', NULL, '2023-01-18 11:29:36', '2023-01-18 11:29:36', NULL, NULL);
INSERT INTO `messages` VALUES (3, 'Floriananda Rosa', 'rosafloriananda@gmail.com', 'Sample message', 'sample message', '2023-01-18 11:29:50', 'new', NULL, '2023-01-18 11:29:50', '2023-01-18 11:29:50', NULL, NULL);
INSERT INTO `messages` VALUES (4, 'Floriananda Rosa', 'rosafloriananda@gmail.com', 'Sample message', 'sample message', '2023-01-18 11:30:07', 'new', NULL, '2023-01-18 11:30:07', '2023-01-18 11:30:07', NULL, NULL);
INSERT INTO `messages` VALUES (5, 'Ocha Iskandar', 'ochaiskandar@gmail.com', 'Sample message dua', 'sample lagi', '2023-01-18 11:34:00', 'new', NULL, '2023-01-18 11:34:00', '2023-01-18 11:34:00', NULL, NULL);
INSERT INTO `messages` VALUES (6, 'Ocha Iskandar', 'ochaiskandar@gmail.com', 'Sample message dua', 'sample lagi', '2023-01-18 11:34:30', 'read', NULL, '2023-01-18 11:34:30', '2023-01-18 11:47:57', NULL, NULL);

-- ----------------------------
-- Table structure for metas
-- ----------------------------
DROP TABLE IF EXISTS `metas`;
CREATE TABLE `metas`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `var` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('A','NA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of metas
-- ----------------------------
INSERT INTO `metas` VALUES (1, 'INST_LOGO', 'images/meta\\1.LOGO GDI NEW.png', NULL, 'A', NULL, NULL, '2023-01-18 10:57:32', NULL);
INSERT INTO `metas` VALUES (2, 'INST_NAME', 'Yayasan Graha Dhuafa Indonesia', NULL, 'A', NULL, NULL, '2023-01-18 10:57:32', NULL);
INSERT INTO `metas` VALUES (3, 'INST_TELP', '(022) 8730 4000', NULL, 'A', NULL, NULL, '2023-01-18 10:57:32', NULL);
INSERT INTO `metas` VALUES (4, 'INST_ADDR', 'Jl. Cijawura Girang II No 24 Kel. Sekejati Kec. Buah Batu', NULL, 'A', NULL, NULL, '2023-01-18 10:57:32', NULL);
INSERT INTO `metas` VALUES (5, 'INST_EMAIL', 'grahadhuafa@email.com', NULL, 'A', NULL, NULL, '2023-01-18 10:57:32', NULL);
INSERT INTO `metas` VALUES (6, 'GOO_APP_CKEY', NULL, NULL, 'A', NULL, NULL, NULL, NULL);
INSERT INTO `metas` VALUES (7, 'GOO_APP_SKEY', NULL, NULL, 'A', NULL, NULL, NULL, NULL);
INSERT INTO `metas` VALUES (8, 'EM_USER', NULL, NULL, 'A', NULL, NULL, NULL, NULL);
INSERT INTO `metas` VALUES (9, 'EM_PASS', NULL, NULL, 'A', NULL, NULL, NULL, NULL);
INSERT INTO `metas` VALUES (10, 'EM_SMTP', NULL, NULL, 'A', NULL, NULL, NULL, NULL);
INSERT INTO `metas` VALUES (11, 'EM_PORT', NULL, NULL, 'A', NULL, NULL, NULL, NULL);
INSERT INTO `metas` VALUES (12, 'GOO_MAP', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5441681326197!2d107.64609591431734!3d-6.944950169916611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e81f43dbf93f%3A0x37b97eb42a676781!2sYayasan%20Graha%20Dhuafa%20Indonesia!5e0!3m2!1sen!2sid!4v1674039374950!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', NULL, 'A', NULL, NULL, '2023-01-18 10:57:32', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (7, '2022_12_26_014210_create_programs_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_12_24_115523_create_blogs_table', 2);
INSERT INTO `migrations` VALUES (9, '2022_12_24_084240_create_messages_table', 3);
INSERT INTO `migrations` VALUES (10, '2022_12_24_021517_create_metas_table', 4);
INSERT INTO `migrations` VALUES (11, '2022_12_19_131326_create_widgets_table', 5);
INSERT INTO `migrations` VALUES (12, '2022_12_18_135850_website_menu', 6);
INSERT INTO `migrations` VALUES (13, '2022_12_29_161113_create_program_realisasis_table', 7);
INSERT INTO `migrations` VALUES (14, '2023_01_14_162859_create_program_donasis_table', 8);
INSERT INTO `migrations` VALUES (15, '2023_01_18_013038_create_banks_table', 9);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for program_donasis
-- ----------------------------
DROP TABLE IF EXISTS `program_donasis`;
CREATE TABLE `program_donasis`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `donatur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nominal` double(20, 5) NULL DEFAULT NULL,
  `date_donasi` datetime NULL DEFAULT NULL,
  `media_transfer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_nominal` double(20, 5) NULL DEFAULT NULL,
  `status` enum('success','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_donasis
-- ----------------------------
INSERT INTO `program_donasis` VALUES (1, 1, NULL, 'ocha', 1500000.00000, '2023-01-15 01:23:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `program_donasis` VALUES (2, 1, NULL, 'dwi', 2000000.00000, '2023-01-15 15:52:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `program_donasis` VALUES (3, 2, NULL, 'taqya', 20000.00000, '2023-01-14 15:52:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for program_realisasis
-- ----------------------------
DROP TABLE IF EXISTS `program_realisasis`;
CREATE TABLE `program_realisasis`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `pelaksana` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date_realisasi` date NULL DEFAULT NULL,
  `date_publish` date NULL DEFAULT NULL,
  `status` enum('draft','publish') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_realisasis
-- ----------------------------
INSERT INTO `program_realisasis` VALUES (1, 1, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco', '<p>laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'Tim Yayasan', '2023-10-10', '2023-01-14', 'publish', NULL, '2023-01-14 16:09:53', '2023-01-14 16:20:09', NULL);
INSERT INTO `program_realisasis` VALUES (2, 1, 'Zakat Infaq Shodaqoh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<figure><img src=\"http://localhost:8000/images/general\\2e10e7a278d7e5b7b0bf939a2399f97a.jpg\" id=\"2e10e7a278d7e5b7b0bf939a2399f97a.jpg\" data-image=\"2e10e7a278d7e5b7b0bf939a2399f97a.jpg\"></figure>', 'Tim Yayasan', '2023-10-10', '2023-01-16', 'publish', NULL, '2023-01-16 03:29:45', '2023-01-16 03:31:37', NULL);

-- ----------------------------
-- Table structure for programs
-- ----------------------------
DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `image_upload` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `date_publish` timestamp NULL DEFAULT NULL,
  `status` enum('draft','publish') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `target_nominal` double(20, 2) NULL DEFAULT NULL,
  `date_start` date NULL DEFAULT NULL,
  `date_end` date NULL DEFAULT NULL,
  `pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `program_type` enum('donation','non-donation') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `short_desc` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of programs
-- ----------------------------
INSERT INTO `programs` VALUES (1, 'KaDo Fest (Ledakan Donasi 2023)', 'kado-fest-ledakan-donasi-2023', '<p>consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<figure><img src=\"http://localhost:8000/images/general\\8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg\" id=\"8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg\" data-image=\"8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg\"></figure><p>consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'images/program\\WhatsApp Image 2022-12-13 at 12.29.22 (1).jpeg', '2023-01-16 02:54:20', 'publish', 10000000.00, '2022-01-01', '2022-12-10', 'Sample kontak', '0878-8930-9999', 'Donasi', NULL, '2022-12-29 15:36:20', '2023-01-16 02:54:20', NULL, 'donation', NULL);
INSERT INTO `programs` VALUES (2, 'Zakat Infaq Shodaqoh', 'zakat-infaq-shodaqoh', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>\r\n<figure><img src=\"http://localhost:8000/images/general\\WhatsApp Image 2022-12-13 at 12.29.24.jpeg\" id=\"WhatsApp Image 2022-12-13 at 12.29.24.jpeg\" data-image=\"WhatsApp Image 2022-12-13 at 12.29.24.jpeg\"></figure>\r\n<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>', 'images/program\\WhatsApp Image 2022-12-13 at 12.29.22.jpeg', '2023-01-18 01:26:20', 'publish', 20000000.00, '2023-01-01', '2023-02-28', 'Contoh Pelaksana', '0878-8930-9999', 'ZIS', NULL, '2023-01-15 04:01:10', '2023-01-18 01:26:20', NULL, 'non-donation', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna hkjashdsa daksjdkas alsdk fdlkfjlds fsjda sdadfh dflakdsjf aldfja dlfkadf laksf alks');
INSERT INTO `programs` VALUES (3, 'Sekolah Darurat', 'sekolah-darurat', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<figure><img src=\"http://localhost:8000/images/general\\2e10e7a278d7e5b7b0bf939a2399f97a.jpg\" id=\"2e10e7a278d7e5b7b0bf939a2399f97a.jpg\" data-image=\"2e10e7a278d7e5b7b0bf939a2399f97a.jpg\"></figure>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'images/program\\WhatsApp Image 2022-12-13 at 12.29.17.jpeg', '2023-01-16 03:18:11', 'publish', 20000000.00, '2023-01-01', '2023-02-28', 'Contoh Pelaksana', '0878-8930-9999', 'Fundraising', NULL, '2023-01-16 03:15:30', '2023-01-16 03:18:11', NULL, 'donation', NULL);

-- ----------------------------
-- Table structure for social_media
-- ----------------------------
DROP TABLE IF EXISTS `social_media`;
CREATE TABLE `social_media`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `var` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `classname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','NA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of social_media
-- ----------------------------
INSERT INTO `social_media` VALUES (1, 'FB', 'Facebook', 'bi-facebook', 'fab fa-facebook', 'https://facebook.com/gdi', 'A', NULL, NULL, '2023-01-16 02:59:20', NULL);
INSERT INTO `social_media` VALUES (2, 'IG', 'Instagram', 'bi-instagram', 'fab fa-instagram', 'https://instagram.com', 'A', NULL, NULL, NULL, NULL);
INSERT INTO `social_media` VALUES (3, 'WA', 'Whatsapp', 'bi-whatsapp', 'fab fa-whatsapp', 'https://whatsapp.com', 'A', NULL, NULL, NULL, NULL);
INSERT INTO `social_media` VALUES (4, 'YT', 'Youtube', 'bi-youtube', 'fab fa-youtube', 'https://youtube.com', 'A', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL,
  `status` enum('A','NA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Administrator', 'admin@gmail.com', 'admin', 1, 'A', '2023-01-18 09:51:51', NULL, '$2y$10$hy.IiL1/F0fsdklfv0sUqeDSeL628f7jZ/agdj/NuZeAjFxEldlPy', NULL, NULL, '2023-01-18 09:51:51', NULL);
INSERT INTO `users` VALUES (2, 'Ocha Iskandar', 'ochaiskandar@gmail.com', 'ocha', 2, 'A', NULL, NULL, '$2y$10$CcLioEQp2cXsvXwRpenL3.nZCaUoOmBJRxPsAwLJdSt4fqtdzJYO6', NULL, '2022-12-18 13:33:51', '2022-12-18 13:33:51', NULL);
INSERT INTO `users` VALUES (3, 'Floriananda Rosa', 'ochaiskandar@gmail.com', 'tehocha', 2, 'NA', NULL, NULL, '$2y$10$L/REeDKd.9yJ9zH7EkWCk.IAtGolk4shTKbpZqGxkJZvOBLkrnsWq', NULL, '2022-12-18 13:34:35', '2022-12-18 13:46:59', NULL);

-- ----------------------------
-- Table structure for widgets
-- ----------------------------
DROP TABLE IF EXISTS `widgets`;
CREATE TABLE `widgets`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `image_upload` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `image_position` enum('right','left','none') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` enum('slider','ads','general','about') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `button` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` enum('A','NA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of widgets
-- ----------------------------
INSERT INTO `widgets` VALUES (1, 'Bangun Peradaban Berakhlak dan Berkarya', 'Yayasan Graha Dhuafa Indonesia', NULL, 'images/slider\\6.jpg', NULL, 'slider', NULL, '[{\"text\":\"Donasi Sekarang\",\"url\":\"\\/program\\/donasi\",\"classname\":null}]', 'A', NULL, '2023-01-18 11:55:53', '2023-01-18 11:59:49', NULL);
INSERT INTO `widgets` VALUES (2, 'Sedekah Anak Yatim Dhuafa Mandiri', 'Yayasan Graha Dhuafa Indonesia', NULL, 'images/slider\\5.jpg', NULL, 'slider', NULL, '[{\"text\":\"Donasi Sekarang\",\"url\":\"\\/program\\/donasi\",\"classname\":null}]', 'A', NULL, '2023-01-18 11:56:38', '2023-01-18 12:00:08', NULL);
INSERT INTO `widgets` VALUES (3, 'Siapkah diri Anda untuk menjadi volunteer selanjutnya?', 'Yayasan Graha Dhuafa Indonesia', NULL, 'images/slider\\4.jpg', NULL, 'slider', NULL, NULL, 'A', NULL, '2023-01-18 11:57:18', '2023-01-18 11:58:49', NULL);
INSERT INTO `widgets` VALUES (4, 'Zakat Infaq Shodaqoh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt', NULL, 'images/ads\\banner_ads.jpg', NULL, 'ads', NULL, '[{\"text\":\"Tunaikan\",\"url\":\"\\/program\\/zakat-infaq-shodaqoh\",\"classname\":null}]', 'A', NULL, '2023-01-18 13:16:27', '2023-01-18 13:27:57', NULL);
INSERT INTO `widgets` VALUES (5, 'Zakat Infaq Shodaqoh', 'Quis nostrud exercitation ullamco laboris nisi', '<p>Sed ullamcorper morbi tincidunt. Vitae congue mauris rhoncus aenean vel elit. Erat nam at lectus urna duis convallis convallis tellus. In iaculis nunc sed augue lacus. Pharetra convallis posuere morbi leo. Maecenas ultricies mi eget mauris pharetra.&nbsp;</p>\r\n<p>Tellus elementum sagittis vitae et leo duis ut diam. Arcu felis bibendum ut tristique et egestas quis ipsum suspendisse. Volutpat odio facilisis mauris sit </p>', 'images/widget\\5.jpg', NULL, 'general', NULL, '[{\"text\":\"Info Selanjutnya\",\"url\":null,\"classname\":null}]', 'A', NULL, '2023-01-18 13:29:38', '2023-01-18 13:38:41', NULL);
INSERT INTO `widgets` VALUES (6, 'Yayasan Graha Dhuafa Indonesia', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt.&nbsp;</p>\r\n<div class=\"about-one__quote\">\r\n<p>\r\n    Menjadi lembaga global yang profesional untuk peduli menjaga generasi mandiri dan unggul\r\n</p>\r\n</div>', '[{\"id\":\"1\",\"path\":\"images\\/about\\/3f73479facb5693968865c35a5c00880.jpg\"},{\"id\":\"2\",\"path\":\"images\\/about\\/391118724f60be7ad4d5d990070c9e89.jpg\"}]', NULL, 'about', NULL, NULL, 'A', NULL, '2023-01-18 14:02:34', '2023-01-18 14:12:40', NULL);

SET FOREIGN_KEY_CHECKS = 1;
