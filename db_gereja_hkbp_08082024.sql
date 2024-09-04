/*
 Navicat Premium Data Transfer

 Source Server         : mysql_local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_gereja_hkbp

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 08/08/2024 16:51:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bank
-- ----------------------------
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank`  (
  `id_bank` int NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_bank`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bank
-- ----------------------------

-- ----------------------------
-- Table structure for bank_gereja
-- ----------------------------
DROP TABLE IF EXISTS `bank_gereja`;
CREATE TABLE `bank_gereja`  (
  `id_bank_gereja` int NOT NULL AUTO_INCREMENT,
  `id_gereja` int NOT NULL,
  `id_bank` int NOT NULL,
  `nama_pemilik` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nomor_rekening` int NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_bank_gereja`) USING BTREE,
  INDEX `bank_id_bank_gereja`(`id_bank` ASC) USING BTREE,
  INDEX `gereja_id_bank_gereja`(`id_gereja` ASC) USING BTREE,
  CONSTRAINT `fk_id_bank_bank_gereja` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id_bank`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_gereja_bank_gereja` FOREIGN KEY (`id_gereja`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bank_gereja
-- ----------------------------

-- ----------------------------
-- Table structure for baptis
-- ----------------------------
DROP TABLE IF EXISTS `baptis`;
CREATE TABLE `baptis`  (
  `id_baptis` int NOT NULL AUTO_INCREMENT,
  `id_registrasi_baptis` int NOT NULL,
  `id_jemaat` int NOT NULL,
  `tgl_baptis` date NOT NULL,
  `no_surat_baptis` int NOT NULL,
  `isHKBP` int NOT NULL DEFAULT 0,
  `id_gereja_baptis` int NOT NULL,
  `nama_gereja_non_HKBP` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_pendeta_baptis` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `file_surat_baptis` bigint NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_status` int NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_baptis`) USING BTREE,
  INDEX `gereja_id_baptis`(`id_registrasi_baptis` ASC) USING BTREE,
  INDEX `jemaat_id_baptis`(`id_jemaat` ASC) USING BTREE,
  INDEX `gereja_baptis_id_baptis`(`id_gereja_baptis` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_baptis` FOREIGN KEY (`id_gereja_baptis`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_baptis` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_registrasi_baptis_baptis` FOREIGN KEY (`id_registrasi_baptis`) REFERENCES `registrasi_baptis` (`id_registrasi_baptis`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of baptis
-- ----------------------------

-- ----------------------------
-- Table structure for bidang_pendidikan
-- ----------------------------
DROP TABLE IF EXISTS `bidang_pendidikan`;
CREATE TABLE `bidang_pendidikan`  (
  `id_bidang_pendidikan` int NOT NULL AUTO_INCREMENT,
  `nama_bidang_pendidikan` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_bidang_pendidikan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 134 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bidang_pendidikan
-- ----------------------------
INSERT INTO `bidang_pendidikan` VALUES (1, 'Pendidikan Dasar', NULL, '2023-06-05 22:09:28', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (2, 'Pendidikan Menengah', NULL, '2023-06-05 22:10:07', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (3, 'Pendididkan Tinggi', NULL, '2023-06-05 22:10:22', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (4, 'Pendidikan Vokasional', NULL, '2023-06-05 22:11:06', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (5, 'Pendidikan Khusus', NULL, '2023-06-05 22:11:18', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (6, 'Pendidikan Nonformal', NULL, '2023-06-05 22:11:40', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (7, 'Pendidikan Dalam Jaringan', NULL, '2023-06-05 22:11:53', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (8, 'Pendidikan Kejuruan', NULL, '2023-06-05 22:12:06', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (9, 'Pendidikan Sains dan Teknologi', NULL, '2023-06-05 22:12:23', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (10, 'Pendidikan Seni dan Budaya', NULL, '2023-06-05 22:12:36', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (121, 'Bidang Pendidikan 01 update', 'Bidang Pendidikan 01 update', '2024-04-01 10:02:43', '2024-04-01 11:09:00', 0);
INSERT INTO `bidang_pendidikan` VALUES (122, 'Bidang Pendidikan 02', 'Bidang Pendidikan 02', '2024-04-01 10:10:15', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (123, 'Bidang Pendidikan 03', 'Bidang Pendidikan 03', '2024-04-01 10:11:41', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (124, 'Bidang Pendidikan 04', 'Bidang Pendidikan 04', '2024-04-01 10:18:40', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (125, 'Bidang Pendidikan 05', 'Bidang Pendidikan 05', '2024-04-01 10:26:07', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (126, 'Bidang Pendidikan 06', 'Bidang Pendidikan 06', '2024-04-01 10:28:04', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (127, 'Bidang Pendidikan 07', 'Bidang Pendidikan 07', '2024-04-01 10:29:48', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (128, 'Bidang Pendidikan 08', 'Bidang Pendidikan 08', '2024-04-01 10:31:26', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (129, 'Bidang Pendidikan 09', 'Bidang Pendidikan 09', '2024-04-01 10:33:36', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (130, 'Bidang Pendidikan 10', 'Bidang Pendidikan 10', '2024-04-01 10:36:05', NULL, 0);
INSERT INTO `bidang_pendidikan` VALUES (131, 'Bidang Pendidikan 11 update', 'Bidang Pendidikan 11 update', '2024-04-01 10:37:29', '2024-04-01 11:10:48', 1);
INSERT INTO `bidang_pendidikan` VALUES (132, 'test98929', 'test98929', '2024-04-01 11:46:29', '2024-04-03 09:39:46', 1);
INSERT INTO `bidang_pendidikan` VALUES (133, 'null', '0102', '2024-04-01 11:52:52', NULL, 0);

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city`  (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_code` int NOT NULL,
  `province_id` int NOT NULL,
  `province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `city_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `postal_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`city_id`) USING BTREE,
  INDEX `fk_province_id_city`(`province_id` ASC) USING BTREE,
  CONSTRAINT `fk_province_id_city` FOREIGN KEY (`province_id`) REFERENCES `province` (`province_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES (1, 15, 34, 'Sumatera Utara', 'Kabupaten', 'Asahan', '21214', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (2, 52, 34, 'Sumatera Utara', 'Kabupaten', 'Batu Bara', '21655', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (3, 70, 34, 'Sumatera Utara', 'Kota', 'Binjai', '20712', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (4, 110, 34, 'Sumatera Utara', 'Kabupaten', 'Dairi', '22211', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (5, 112, 34, 'Sumatera Utara', 'Kabupaten', 'Deli Serdang', '20511', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (6, 137, 34, 'Sumatera Utara', 'Kota', 'Gunungsitoli', '22813', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (7, 146, 34, 'Sumatera Utara', 'Kabupaten', 'Humbang Hasundutan', '22457', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (8, 173, 34, 'Sumatera Utara', 'Kabupaten', 'Karo', '22119', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (9, 217, 34, 'Sumatera Utara', 'Kabupaten', 'Labuhan Batu', '21412', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (10, 218, 34, 'Sumatera Utara', 'Kabupaten', 'Labuhan Batu Selatan', '21511', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (11, 219, 34, 'Sumatera Utara', 'Kabupaten', 'Labuhan Batu Utara', '21711', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (12, 229, 34, 'Sumatera Utara', 'Kabupaten', 'Langkat', '20811', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (13, 268, 34, 'Sumatera Utara', 'Kabupaten', 'Mandailing Natal', '22916', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (14, 278, 34, 'Sumatera Utara', 'Kota', 'Medan', '20228', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (15, 307, 34, 'Sumatera Utara', 'Kabupaten', 'Nias', '22876', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (16, 308, 34, 'Sumatera Utara', 'Kabupaten', 'Nias Barat', '22895', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (17, 309, 34, 'Sumatera Utara', 'Kabupaten', 'Nias Selatan', '22865', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (18, 310, 34, 'Sumatera Utara', 'Kabupaten', 'Nias Utara', '22856', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (19, 319, 34, 'Sumatera Utara', 'Kabupaten', 'Padang Lawas', '22763', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (20, 320, 34, 'Sumatera Utara', 'Kabupaten', 'Padang Lawas Utara', '22753', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (21, 323, 34, 'Sumatera Utara', 'Kota', 'Padang Sidempuan', '22727', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (22, 325, 34, 'Sumatera Utara', 'Kabupaten', 'Pakpak Bharat', '22272', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (23, 353, 34, 'Sumatera Utara', 'Kota', 'Pematang Siantar', '21126', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (24, 389, 34, 'Sumatera Utara', 'Kabupaten', 'Samosir', '22392', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (25, 404, 34, 'Sumatera Utara', 'Kabupaten', 'Serdang Bedagai', '20915', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (26, 407, 34, 'Sumatera Utara', 'Kota', 'Sibolga', '22522', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (27, 413, 34, 'Sumatera Utara', 'Kabupaten', 'Simalungun', '21162', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (28, 459, 34, 'Sumatera Utara', 'Kota', 'Tanjung Balai', '21321', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (29, 463, 34, 'Sumatera Utara', 'Kabupaten', 'Tapanuli Selatan', '22742', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (30, 464, 34, 'Sumatera Utara', 'Kabupaten', 'Tapanuli Tengah', '22611', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (31, 465, 34, 'Sumatera Utara', 'Kabupaten', 'Tapanuli Utara', '22414', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (32, 470, 34, 'Sumatera Utara', 'Kota', 'Tebing Tinggi', '20632', '2023-05-03 16:09:28', NULL, 0);
INSERT INTO `city` VALUES (33, 481, 34, 'Sumatera Utara', 'Kabupaten', 'Toba Samosir', '22316', '2023-05-03 16:09:28', NULL, 0);

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country`  (
  `country_id` int NOT NULL AUTO_INCREMENT,
  `country_code` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `country_name` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `code` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`country_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 251 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES (1, 'AFG', 'Afghanistan', 'AF', NULL, NULL, 0);
INSERT INTO `country` VALUES (2, 'ALA', 'Åland', 'AX', NULL, NULL, 0);
INSERT INTO `country` VALUES (3, 'ALB', 'Albania', 'AL', NULL, NULL, 0);
INSERT INTO `country` VALUES (4, 'DZA', 'Algeria', 'DZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (5, 'ASM', 'American Samoa', 'AS', NULL, NULL, 0);
INSERT INTO `country` VALUES (6, 'AND', 'Andorra', 'AD', NULL, NULL, 0);
INSERT INTO `country` VALUES (7, 'AGO', 'Angola', 'AO', NULL, NULL, 0);
INSERT INTO `country` VALUES (8, 'AIA', 'Anguilla', 'AI', NULL, NULL, 0);
INSERT INTO `country` VALUES (9, 'ATA', 'Antarctica', 'AQ', NULL, NULL, 0);
INSERT INTO `country` VALUES (10, 'ATG', 'Antigua and Barbuda', 'AG', NULL, NULL, 0);
INSERT INTO `country` VALUES (11, 'ARG', 'Argentina', 'AR', NULL, NULL, 0);
INSERT INTO `country` VALUES (12, 'ARM', 'Armenia', 'AM', NULL, NULL, 0);
INSERT INTO `country` VALUES (13, 'ABW', 'Aruba', 'AW', NULL, NULL, 0);
INSERT INTO `country` VALUES (14, 'AUS', 'Australia', 'AU', NULL, NULL, 0);
INSERT INTO `country` VALUES (15, 'AUT', 'Austria', 'AT', NULL, NULL, 0);
INSERT INTO `country` VALUES (16, 'AZE', 'Azerbaijan', 'AZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (17, 'BHS', 'Bahamas', 'BS', NULL, NULL, 0);
INSERT INTO `country` VALUES (18, 'BHR', 'Bahrain', 'BH', NULL, NULL, 0);
INSERT INTO `country` VALUES (19, 'BGD', 'Bangladesh', 'BD', NULL, NULL, 0);
INSERT INTO `country` VALUES (20, 'BRB', 'Barbados', 'BB', NULL, NULL, 0);
INSERT INTO `country` VALUES (21, 'BLR', 'Belarus', 'BY', NULL, NULL, 0);
INSERT INTO `country` VALUES (22, 'BEL', 'Belgium', 'BE', NULL, NULL, 0);
INSERT INTO `country` VALUES (23, 'BLZ', 'Belize', 'BZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (24, 'BEN', 'Benin', 'BJ', NULL, NULL, 0);
INSERT INTO `country` VALUES (25, 'BMU', 'Bermuda', 'BM', NULL, NULL, 0);
INSERT INTO `country` VALUES (26, 'BTN', 'Bhutan', 'BT', NULL, NULL, 0);
INSERT INTO `country` VALUES (27, 'BOL', 'Bolivia', 'BO', NULL, NULL, 0);
INSERT INTO `country` VALUES (28, 'BES', 'Bonaire', 'BQ', NULL, NULL, 0);
INSERT INTO `country` VALUES (29, 'BIH', 'Bosnia and Herzegovina', 'BA', NULL, NULL, 0);
INSERT INTO `country` VALUES (30, 'BWA', 'Botswana', 'BW', NULL, NULL, 0);
INSERT INTO `country` VALUES (31, 'BVT', 'Bouvet Island', 'BV', NULL, NULL, 0);
INSERT INTO `country` VALUES (32, 'BRA', 'Brazil', 'BR', NULL, NULL, 0);
INSERT INTO `country` VALUES (33, 'IOT', 'British Indian Ocean Territory', 'IO', NULL, NULL, 0);
INSERT INTO `country` VALUES (34, 'VGB', 'British Virgin Islands', 'VG', NULL, NULL, 0);
INSERT INTO `country` VALUES (35, 'BRN', 'Brunei', 'BN', NULL, NULL, 0);
INSERT INTO `country` VALUES (36, 'BGR', 'Bulgaria', 'BG', NULL, NULL, 0);
INSERT INTO `country` VALUES (37, 'BFA', 'Burkina Faso', 'BF', NULL, NULL, 0);
INSERT INTO `country` VALUES (38, 'BDI', 'Burundi', 'BI', NULL, NULL, 0);
INSERT INTO `country` VALUES (39, 'KHM', 'Cambodia', 'KH', NULL, NULL, 0);
INSERT INTO `country` VALUES (40, 'CMR', 'Cameroon', 'CM', NULL, NULL, 0);
INSERT INTO `country` VALUES (41, 'CAN', 'Canada', 'CA', NULL, NULL, 0);
INSERT INTO `country` VALUES (42, 'CPV', 'Cape Verde', 'CV', NULL, NULL, 0);
INSERT INTO `country` VALUES (43, 'CYM', 'Cayman Islands', 'KY', NULL, NULL, 0);
INSERT INTO `country` VALUES (44, 'CAF', 'Central African Republic', 'CF', NULL, NULL, 0);
INSERT INTO `country` VALUES (45, 'TCD', 'Chad', 'TD', NULL, NULL, 0);
INSERT INTO `country` VALUES (46, 'CHL', 'Chile', 'CL', NULL, NULL, 0);
INSERT INTO `country` VALUES (47, 'CHN', 'China', 'CN', NULL, NULL, 0);
INSERT INTO `country` VALUES (48, 'CXR', 'Christmas Island', 'CX', NULL, NULL, 0);
INSERT INTO `country` VALUES (49, 'CCK', 'Cocos [Keeling] Islands', 'CC', NULL, NULL, 0);
INSERT INTO `country` VALUES (50, 'COL', 'Colombia', 'CO', NULL, NULL, 0);
INSERT INTO `country` VALUES (51, 'COM', 'Comoros', 'KM', NULL, NULL, 0);
INSERT INTO `country` VALUES (52, 'COK', 'Cook Islands', 'CK', NULL, NULL, 0);
INSERT INTO `country` VALUES (53, 'CRI', 'Costa Rica', 'CR', NULL, NULL, 0);
INSERT INTO `country` VALUES (54, 'HRV', 'Croatia', 'HR', NULL, NULL, 0);
INSERT INTO `country` VALUES (55, 'CUB', 'Cuba', 'CU', NULL, NULL, 0);
INSERT INTO `country` VALUES (56, 'CUW', 'Curacao', 'CW', NULL, NULL, 0);
INSERT INTO `country` VALUES (57, 'CYP', 'Cyprus', 'CY', NULL, NULL, 0);
INSERT INTO `country` VALUES (58, 'CZE', 'Czech Republic', 'CZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (59, 'COD', 'Democratic Republic of the Congo', 'CD', NULL, NULL, 0);
INSERT INTO `country` VALUES (60, 'DNK', 'Denmark', 'DK', NULL, NULL, 0);
INSERT INTO `country` VALUES (61, 'DJI', 'Djibouti', 'DJ', NULL, NULL, 0);
INSERT INTO `country` VALUES (62, 'DMA', 'Dominica', 'DM', NULL, NULL, 0);
INSERT INTO `country` VALUES (63, 'DOM', 'Dominican Republic', 'DO', NULL, NULL, 0);
INSERT INTO `country` VALUES (64, 'TLS', 'East Timor', 'TL', NULL, NULL, 0);
INSERT INTO `country` VALUES (65, 'ECU', 'Ecuador', 'EC', NULL, NULL, 0);
INSERT INTO `country` VALUES (66, 'EGY', 'Egypt', 'EG', NULL, NULL, 0);
INSERT INTO `country` VALUES (67, 'SLV', 'El Salvador', 'SV', NULL, NULL, 0);
INSERT INTO `country` VALUES (68, 'GNQ', 'Equatorial Guinea', 'GQ', NULL, NULL, 0);
INSERT INTO `country` VALUES (69, 'ERI', 'Eritrea', 'ER', NULL, NULL, 0);
INSERT INTO `country` VALUES (70, 'EST', 'Estonia', 'EE', NULL, NULL, 0);
INSERT INTO `country` VALUES (71, 'ETH', 'Ethiopia', 'ET', NULL, NULL, 0);
INSERT INTO `country` VALUES (72, 'FLK', 'Falkland Islands', 'FK', NULL, NULL, 0);
INSERT INTO `country` VALUES (73, 'FRO', 'Faroe Islands', 'FO', NULL, NULL, 0);
INSERT INTO `country` VALUES (74, 'FJI', 'Fiji', 'FJ', NULL, NULL, 0);
INSERT INTO `country` VALUES (75, 'FIN', 'Finland', 'FI', NULL, NULL, 0);
INSERT INTO `country` VALUES (76, 'FRA', 'France', 'FR', NULL, NULL, 0);
INSERT INTO `country` VALUES (77, 'GUF', 'French Guiana', 'GF', NULL, NULL, 0);
INSERT INTO `country` VALUES (78, 'PYF', 'French Polynesia', 'PF', NULL, NULL, 0);
INSERT INTO `country` VALUES (79, 'ATF', 'French Southern Territories', 'TF', NULL, NULL, 0);
INSERT INTO `country` VALUES (80, 'GAB', 'Gabon', 'GA', NULL, NULL, 0);
INSERT INTO `country` VALUES (81, 'GMB', 'Gambia', 'GM', NULL, NULL, 0);
INSERT INTO `country` VALUES (82, 'GEO', 'Georgia', 'GE', NULL, NULL, 0);
INSERT INTO `country` VALUES (83, 'DEU', 'Germany', 'DE', NULL, NULL, 0);
INSERT INTO `country` VALUES (84, 'GHA', 'Ghana', 'GH', NULL, NULL, 0);
INSERT INTO `country` VALUES (85, 'GIB', 'Gibraltar', 'GI', NULL, NULL, 0);
INSERT INTO `country` VALUES (86, 'GRC', 'Greece', 'GR', NULL, NULL, 0);
INSERT INTO `country` VALUES (87, 'GRL', 'Greenland', 'GL', NULL, NULL, 0);
INSERT INTO `country` VALUES (88, 'GRD', 'Grenada', 'GD', NULL, NULL, 0);
INSERT INTO `country` VALUES (89, 'GLP', 'Guadeloupe', 'GP', NULL, NULL, 0);
INSERT INTO `country` VALUES (90, 'GUM', 'Guam', 'GU', NULL, NULL, 0);
INSERT INTO `country` VALUES (91, 'GTM', 'Guatemala', 'GT', NULL, NULL, 0);
INSERT INTO `country` VALUES (92, 'GGY', 'Guernsey', 'GG', NULL, NULL, 0);
INSERT INTO `country` VALUES (93, 'GIN', 'Guinea', 'GN', NULL, NULL, 0);
INSERT INTO `country` VALUES (94, 'GNB', 'Guinea-Bissau', 'GW', NULL, NULL, 0);
INSERT INTO `country` VALUES (95, 'GUY', 'Guyana', 'GY', NULL, NULL, 0);
INSERT INTO `country` VALUES (96, 'HTI', 'Haiti', 'HT', NULL, NULL, 0);
INSERT INTO `country` VALUES (97, 'HMD', 'Heard Island and McDonald Islands', 'HM', NULL, NULL, 0);
INSERT INTO `country` VALUES (98, 'HND', 'Honduras', 'HN', NULL, NULL, 0);
INSERT INTO `country` VALUES (99, 'HKG', 'Hong Kong', 'HK', NULL, NULL, 0);
INSERT INTO `country` VALUES (100, 'HUN', 'Hungary', 'HU', NULL, NULL, 0);
INSERT INTO `country` VALUES (101, 'ISL', 'Iceland', 'IS', NULL, NULL, 0);
INSERT INTO `country` VALUES (102, 'IND', 'India', 'IN', NULL, NULL, 0);
INSERT INTO `country` VALUES (103, 'IDN', 'Indonesia', 'ID', NULL, NULL, 0);
INSERT INTO `country` VALUES (104, 'IRN', 'Iran', 'IR', NULL, NULL, 0);
INSERT INTO `country` VALUES (105, 'IRQ', 'Iraq', 'IQ', NULL, NULL, 0);
INSERT INTO `country` VALUES (106, 'IRL', 'Ireland', 'IE', NULL, NULL, 0);
INSERT INTO `country` VALUES (107, 'IMN', 'Isle of Man', 'IM', NULL, NULL, 0);
INSERT INTO `country` VALUES (108, 'ISR', 'Israel', 'IL', NULL, NULL, 0);
INSERT INTO `country` VALUES (109, 'ITA', 'Italy', 'IT', NULL, NULL, 0);
INSERT INTO `country` VALUES (110, 'CIV', 'Ivory Coast', 'CI', NULL, NULL, 0);
INSERT INTO `country` VALUES (111, 'JAM', 'Jamaica', 'JM', NULL, NULL, 0);
INSERT INTO `country` VALUES (112, 'JPN', 'Japan', 'JP', NULL, NULL, 0);
INSERT INTO `country` VALUES (113, 'JEY', 'Jersey', 'JE', NULL, NULL, 0);
INSERT INTO `country` VALUES (114, 'JOR', 'Jordan', 'JO', NULL, NULL, 0);
INSERT INTO `country` VALUES (115, 'KAZ', 'Kazakhstan', 'KZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (116, 'KEN', 'Kenya', 'KE', NULL, NULL, 0);
INSERT INTO `country` VALUES (117, 'KIR', 'Kiribati', 'KI', NULL, NULL, 0);
INSERT INTO `country` VALUES (118, 'XKX', 'Kosovo', 'XK', NULL, NULL, 0);
INSERT INTO `country` VALUES (119, 'KWT', 'Kuwait', 'KW', NULL, NULL, 0);
INSERT INTO `country` VALUES (120, 'KGZ', 'Kyrgyzstan', 'KG', NULL, NULL, 0);
INSERT INTO `country` VALUES (121, 'LAO', 'Laos', 'LA', NULL, NULL, 0);
INSERT INTO `country` VALUES (122, 'LVA', 'Latvia', 'LV', NULL, NULL, 0);
INSERT INTO `country` VALUES (123, 'LBN', 'Lebanon', 'LB', NULL, NULL, 0);
INSERT INTO `country` VALUES (124, 'LSO', 'Lesotho', 'LS', NULL, NULL, 0);
INSERT INTO `country` VALUES (125, 'LBR', 'Liberia', 'LR', NULL, NULL, 0);
INSERT INTO `country` VALUES (126, 'LBY', 'Libya', 'LY', NULL, NULL, 0);
INSERT INTO `country` VALUES (127, 'LIE', 'Liechtenstein', 'LI', NULL, NULL, 0);
INSERT INTO `country` VALUES (128, 'LTU', 'Lithuania', 'LT', NULL, NULL, 0);
INSERT INTO `country` VALUES (129, 'LUX', 'Luxembourg', 'LU', NULL, NULL, 0);
INSERT INTO `country` VALUES (130, 'MAC', 'Macao', 'MO', NULL, NULL, 0);
INSERT INTO `country` VALUES (131, 'MKD', 'Macedonia', 'MK', NULL, NULL, 0);
INSERT INTO `country` VALUES (132, 'MDG', 'Madagascar', 'MG', NULL, NULL, 0);
INSERT INTO `country` VALUES (133, 'MWI', 'Malawi', 'MW', NULL, NULL, 0);
INSERT INTO `country` VALUES (134, 'MYS', 'Malaysia', 'MY', NULL, NULL, 0);
INSERT INTO `country` VALUES (135, 'MDV', 'Maldives', 'MV', NULL, NULL, 0);
INSERT INTO `country` VALUES (136, 'MLI', 'Mali', 'ML', NULL, NULL, 0);
INSERT INTO `country` VALUES (137, 'MLT', 'Malta', 'MT', NULL, NULL, 0);
INSERT INTO `country` VALUES (138, 'MHL', 'Marshall Islands', 'MH', NULL, NULL, 0);
INSERT INTO `country` VALUES (139, 'MTQ', 'Martinique', 'MQ', NULL, NULL, 0);
INSERT INTO `country` VALUES (140, 'MRT', 'Mauritania', 'MR', NULL, NULL, 0);
INSERT INTO `country` VALUES (141, 'MUS', 'Mauritius', 'MU', NULL, NULL, 0);
INSERT INTO `country` VALUES (142, 'MYT', 'Mayotte', 'YT', NULL, NULL, 0);
INSERT INTO `country` VALUES (143, 'MEX', 'Mexico', 'MX', NULL, NULL, 0);
INSERT INTO `country` VALUES (144, 'FSM', 'Micronesia', 'FM', NULL, NULL, 0);
INSERT INTO `country` VALUES (145, 'MDA', 'Moldova', 'MD', NULL, NULL, 0);
INSERT INTO `country` VALUES (146, 'MCO', 'Monaco', 'MC', NULL, NULL, 0);
INSERT INTO `country` VALUES (147, 'MNG', 'Mongolia', 'MN', NULL, NULL, 0);
INSERT INTO `country` VALUES (148, 'MNE', 'Montenegro', 'ME', NULL, NULL, 0);
INSERT INTO `country` VALUES (149, 'MSR', 'Montserrat', 'MS', NULL, NULL, 0);
INSERT INTO `country` VALUES (150, 'MAR', 'Morocco', 'MA', NULL, NULL, 0);
INSERT INTO `country` VALUES (151, 'MOZ', 'Mozambique', 'MZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (152, 'MMR', 'Myanmar [Burma]', 'MM', NULL, NULL, 0);
INSERT INTO `country` VALUES (153, 'NAM', 'Namibia', 'NA', NULL, NULL, 0);
INSERT INTO `country` VALUES (154, 'NRU', 'Nauru', 'NR', NULL, NULL, 0);
INSERT INTO `country` VALUES (155, 'NPL', 'Nepal', 'NP', NULL, NULL, 0);
INSERT INTO `country` VALUES (156, 'NLD', 'Netherlands', 'NL', NULL, NULL, 0);
INSERT INTO `country` VALUES (157, 'NCL', 'New Caledonia', 'NC', NULL, NULL, 0);
INSERT INTO `country` VALUES (158, 'NZL', 'New Zealand', 'NZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (159, 'NIC', 'Nicaragua', 'NI', NULL, NULL, 0);
INSERT INTO `country` VALUES (160, 'NER', 'Niger', 'NE', NULL, NULL, 0);
INSERT INTO `country` VALUES (161, 'NGA', 'Nigeria', 'NG', NULL, NULL, 0);
INSERT INTO `country` VALUES (162, 'NIU', 'Niue', 'NU', NULL, NULL, 0);
INSERT INTO `country` VALUES (163, 'NFK', 'Norfolk Island', 'NF', NULL, NULL, 0);
INSERT INTO `country` VALUES (164, 'PRK', 'North Korea', 'KP', NULL, NULL, 0);
INSERT INTO `country` VALUES (165, 'MNP', 'Northern Mariana Islands', 'MP', NULL, NULL, 0);
INSERT INTO `country` VALUES (166, 'NOR', 'Norway', 'NO', NULL, NULL, 0);
INSERT INTO `country` VALUES (167, 'OMN', 'Oman', 'OM', NULL, NULL, 0);
INSERT INTO `country` VALUES (168, 'PAK', 'Pakistan', 'PK', NULL, NULL, 0);
INSERT INTO `country` VALUES (169, 'PLW', 'Palau', 'PW', NULL, NULL, 0);
INSERT INTO `country` VALUES (170, 'PSE', 'Palestine', 'PS', NULL, NULL, 0);
INSERT INTO `country` VALUES (171, 'PAN', 'Panama', 'PA', NULL, NULL, 0);
INSERT INTO `country` VALUES (172, 'PNG', 'Papua New Guinea', 'PG', NULL, NULL, 0);
INSERT INTO `country` VALUES (173, 'PRY', 'Paraguay', 'PY', NULL, NULL, 0);
INSERT INTO `country` VALUES (174, 'PER', 'Peru', 'PE', NULL, NULL, 0);
INSERT INTO `country` VALUES (175, 'PHL', 'Philippines', 'PH', NULL, NULL, 0);
INSERT INTO `country` VALUES (176, 'PCN', 'Pitcairn Islands', 'PN', NULL, NULL, 0);
INSERT INTO `country` VALUES (177, 'POL', 'Poland', 'PL', NULL, NULL, 0);
INSERT INTO `country` VALUES (178, 'PRT', 'Portugal', 'PT', NULL, NULL, 0);
INSERT INTO `country` VALUES (179, 'PRI', 'Puerto Rico', 'PR', NULL, NULL, 0);
INSERT INTO `country` VALUES (180, 'QAT', 'Qatar', 'QA', NULL, NULL, 0);
INSERT INTO `country` VALUES (181, 'COG', 'Republic of the Congo', 'CG', NULL, NULL, 0);
INSERT INTO `country` VALUES (182, 'REU', 'Réunion', 'RE', NULL, NULL, 0);
INSERT INTO `country` VALUES (183, 'ROU', 'Romania', 'RO', NULL, NULL, 0);
INSERT INTO `country` VALUES (184, 'RUS', 'Russia', 'RU', NULL, NULL, 0);
INSERT INTO `country` VALUES (185, 'RWA', 'Rwanda', 'RW', NULL, NULL, 0);
INSERT INTO `country` VALUES (186, 'BLM', 'Saint Barthélemy', 'BL', NULL, NULL, 0);
INSERT INTO `country` VALUES (187, 'SHN', 'Saint Helena', 'SH', NULL, NULL, 0);
INSERT INTO `country` VALUES (188, 'KNA', 'Saint Kitts and Nevis', 'KN', NULL, NULL, 0);
INSERT INTO `country` VALUES (189, 'LCA', 'Saint Lucia', 'LC', NULL, NULL, 0);
INSERT INTO `country` VALUES (190, 'MAF', 'Saint Martin', 'MF', NULL, NULL, 0);
INSERT INTO `country` VALUES (191, 'SPM', 'Saint Pierre and Miquelon', 'PM', NULL, NULL, 0);
INSERT INTO `country` VALUES (192, 'VCT', 'Saint Vincent and the Grenadines', 'VC', NULL, NULL, 0);
INSERT INTO `country` VALUES (193, 'WSM', 'Samoa', 'WS', NULL, NULL, 0);
INSERT INTO `country` VALUES (194, 'SMR', 'San Marino', 'SM', NULL, NULL, 0);
INSERT INTO `country` VALUES (195, 'STP', 'São Tomé and Príncipe', 'ST', NULL, NULL, 0);
INSERT INTO `country` VALUES (196, 'SAU', 'Saudi Arabia', 'SA', NULL, NULL, 0);
INSERT INTO `country` VALUES (197, 'SEN', 'Senegal', 'SN', NULL, NULL, 0);
INSERT INTO `country` VALUES (198, 'SRB', 'Serbia', 'RS', NULL, NULL, 0);
INSERT INTO `country` VALUES (199, 'SYC', 'Seychelles', 'SC', NULL, NULL, 0);
INSERT INTO `country` VALUES (200, 'SLE', 'Sierra Leone', 'SL', NULL, NULL, 0);
INSERT INTO `country` VALUES (201, 'SGP', 'Singapore', 'SG', NULL, NULL, 0);
INSERT INTO `country` VALUES (202, 'SXM', 'Sint Maarten', 'SX', NULL, NULL, 0);
INSERT INTO `country` VALUES (203, 'SVK', 'Slovakia', 'SK', NULL, NULL, 0);
INSERT INTO `country` VALUES (204, 'SVN', 'Slovenia', 'SI', NULL, NULL, 0);
INSERT INTO `country` VALUES (205, 'SLB', 'Solomon Islands', 'SB', NULL, NULL, 0);
INSERT INTO `country` VALUES (206, 'SOM', 'Somalia', 'SO', NULL, NULL, 0);
INSERT INTO `country` VALUES (207, 'ZAF', 'South Africa', 'ZA', NULL, NULL, 0);
INSERT INTO `country` VALUES (208, 'SGS', 'South Georgia and the South Sandwich Islands', 'GS', NULL, NULL, 0);
INSERT INTO `country` VALUES (209, 'KOR', 'South Korea', 'KR', NULL, NULL, 0);
INSERT INTO `country` VALUES (210, 'SSD', 'South Sudan', 'SS', NULL, NULL, 0);
INSERT INTO `country` VALUES (211, 'ESP', 'Spain', 'ES', NULL, NULL, 0);
INSERT INTO `country` VALUES (212, 'LKA', 'Sri Lanka', 'LK', NULL, NULL, 0);
INSERT INTO `country` VALUES (213, 'SDN', 'Sudan', 'SD', NULL, NULL, 0);
INSERT INTO `country` VALUES (214, 'SUR', 'Suriname', 'SR', NULL, NULL, 0);
INSERT INTO `country` VALUES (215, 'SJM', 'Svalbard and Jan Mayen', 'SJ', NULL, NULL, 0);
INSERT INTO `country` VALUES (216, 'SWZ', 'Swaziland', 'SZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (217, 'SWE', 'Sweden', 'SE', NULL, NULL, 0);
INSERT INTO `country` VALUES (218, 'CHE', 'Switzerland', 'CH', NULL, NULL, 0);
INSERT INTO `country` VALUES (219, 'SYR', 'Syria', 'SY', NULL, NULL, 0);
INSERT INTO `country` VALUES (220, 'TWN', 'Taiwan', 'TW', NULL, NULL, 0);
INSERT INTO `country` VALUES (221, 'TJK', 'Tajikistan', 'TJ', NULL, NULL, 0);
INSERT INTO `country` VALUES (222, 'TZA', 'Tanzania', 'TZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (223, 'THA', 'Thailand', 'TH', NULL, NULL, 0);
INSERT INTO `country` VALUES (224, 'TGO', 'Togo', 'TG', NULL, NULL, 0);
INSERT INTO `country` VALUES (225, 'TKL', 'Tokelau', 'TK', NULL, NULL, 0);
INSERT INTO `country` VALUES (226, 'TON', 'Tonga', 'TO', NULL, NULL, 0);
INSERT INTO `country` VALUES (227, 'TTO', 'Trinidad and Tobago', 'TT', NULL, NULL, 0);
INSERT INTO `country` VALUES (228, 'TUN', 'Tunisia', 'TN', NULL, NULL, 0);
INSERT INTO `country` VALUES (229, 'TUR', 'Turkey', 'TR', NULL, NULL, 0);
INSERT INTO `country` VALUES (230, 'TKM', 'Turkmenistan', 'TM', NULL, NULL, 0);
INSERT INTO `country` VALUES (231, 'TCA', 'Turks and Caicos Islands', 'TC', NULL, NULL, 0);
INSERT INTO `country` VALUES (232, 'TUV', 'Tuvalu', 'TV', NULL, NULL, 0);
INSERT INTO `country` VALUES (233, 'UMI', 'U.S. Minor Outlying Islands', 'UM', NULL, NULL, 0);
INSERT INTO `country` VALUES (234, 'VIR', 'U.S. Virgin Islands', 'VI', NULL, NULL, 0);
INSERT INTO `country` VALUES (235, 'UGA', 'Uganda', 'UG', NULL, NULL, 0);
INSERT INTO `country` VALUES (236, 'UKR', 'Ukraine', 'UA', NULL, NULL, 0);
INSERT INTO `country` VALUES (237, 'ARE', 'United Arab Emirates', 'AE', NULL, NULL, 0);
INSERT INTO `country` VALUES (238, 'GBR', 'United Kingdom', 'GB', NULL, NULL, 0);
INSERT INTO `country` VALUES (239, 'USA', 'United States', 'US', NULL, NULL, 0);
INSERT INTO `country` VALUES (240, 'URY', 'Uruguay', 'UY', NULL, NULL, 0);
INSERT INTO `country` VALUES (241, 'UZB', 'Uzbekistan', 'UZ', NULL, NULL, 0);
INSERT INTO `country` VALUES (242, 'VUT', 'Vanuatu', 'VU', NULL, NULL, 0);
INSERT INTO `country` VALUES (243, 'VAT', 'Vatican City', 'VA', NULL, NULL, 0);
INSERT INTO `country` VALUES (244, 'VEN', 'Venezuela', 'VE', NULL, NULL, 0);
INSERT INTO `country` VALUES (245, 'VNM', 'Vietnam', 'VN', NULL, NULL, 0);
INSERT INTO `country` VALUES (246, 'WLF', 'Wallis and Futuna', 'WF', NULL, NULL, 0);
INSERT INTO `country` VALUES (247, 'ESH', 'Western Sahara', 'EH', NULL, NULL, 0);
INSERT INTO `country` VALUES (248, 'YEM', 'Yemen', 'YE', NULL, NULL, 0);
INSERT INTO `country` VALUES (249, 'ZMB', 'Zambia', 'ZM', NULL, NULL, 0);
INSERT INTO `country` VALUES (250, 'ZWE', 'Zimbabwe', 'ZW', NULL, NULL, 0);

-- ----------------------------
-- Table structure for det_registrasi_jemaat
-- ----------------------------
DROP TABLE IF EXISTS `det_registrasi_jemaat`;
CREATE TABLE `det_registrasi_jemaat`  (
  `id_det_registrasi` int NOT NULL AUTO_INCREMENT,
  `id_registrasi` int NOT NULL COMMENT ' ',
  `id_jemaat` int NOT NULL,
  `id_status` int NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_det_registrasi`) USING BTREE,
  INDEX `jemaat_id_det_registrasi_jemaat`(`id_jemaat` ASC) USING BTREE,
  INDEX `status_id_det_registrasi_jemaat`(`id_status` ASC) USING BTREE,
  INDEX `fk_id_registrasi_det_registrasi_jemaat`(`id_registrasi` ASC) USING BTREE,
  CONSTRAINT `fk_id_jemaat_det_registrasi_jemaat` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_registrasi_det_registrasi_jemaat` FOREIGN KEY (`id_registrasi`) REFERENCES `registrasi_jemaat` (`id_registrasi`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_status_det_registrasi_jemaat` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of det_registrasi_jemaat
-- ----------------------------

-- ----------------------------
-- Table structure for detail_pindah
-- ----------------------------
DROP TABLE IF EXISTS `detail_pindah`;
CREATE TABLE `detail_pindah`  (
  `id_det_reg_pindah` int NOT NULL,
  `id_jemaat` int NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  INDEX `jemaat_id_pindah`(`id_jemaat` ASC) USING BTREE,
  CONSTRAINT `fk_id_jemaat_pindah` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detail_pindah
-- ----------------------------

-- ----------------------------
-- Table structure for detail_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE `detail_transaksi`  (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_mata_anggaran` int NOT NULL,
  `jumlah_sentralisasi` double NOT NULL DEFAULT 0,
  `jumlah_gereja` double NOT NULL DEFAULT 0,
  `bulan_awal` int NOT NULL,
  `bulan_akhir` int NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_transaksi`) USING BTREE,
  INDEX `fk_id_mata_anggaran_detail_transaksi`(`id_mata_anggaran` ASC) USING BTREE,
  CONSTRAINT `fk_id_mata_anggaran_detail_transaksi` FOREIGN KEY (`id_mata_anggaran`) REFERENCES `mata_anggaran` (`id_mata_anggaran`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detail_transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for distrik
-- ----------------------------
DROP TABLE IF EXISTS `distrik`;
CREATE TABLE `distrik`  (
  `id_distrik` int NOT NULL AUTO_INCREMENT,
  `kode_distrik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_distrik` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kelurahan_desa` int NOT NULL,
  `nama_pareses` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_distrik`) USING BTREE,
  INDEX `fk_id_kota_distrik`(`id_kelurahan_desa` ASC) USING BTREE,
  CONSTRAINT `fk_id_kota_distrik` FOREIGN KEY (`id_kelurahan_desa`) REFERENCES `city` (`city_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of distrik
-- ----------------------------
INSERT INTO `distrik` VALUES (1, '02', 'Silindung', 'Tapanuli Utara', 31, 'Pdt. Hasudungan Manalu', '2023-05-08 11:53:00', NULL, 0);

-- ----------------------------
-- Table structure for gereja
-- ----------------------------
DROP TABLE IF EXISTS `gereja`;
CREATE TABLE `gereja`  (
  `id_gereja` int NOT NULL AUTO_INCREMENT,
  `id_ressort` int NOT NULL,
  `id_jenis_gereja` int NOT NULL,
  `kode_gereja` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_gereja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kelurahan_desa` int NOT NULL,
  `nama_pendeta` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_berdiri` date NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_gereja`) USING BTREE,
  INDEX `ressort_id_gereja`(`id_ressort` ASC) USING BTREE,
  INDEX `jenis_gereja_id_gereja`(`id_jenis_gereja` ASC) USING BTREE,
  INDEX `fk_id_kota_gereja`(`id_kelurahan_desa` ASC) USING BTREE,
  CONSTRAINT `fk_id_jenis_gereja_gereja` FOREIGN KEY (`id_jenis_gereja`) REFERENCES `jenis_gereja` (`id_jenis_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_kota_gereja` FOREIGN KEY (`id_kelurahan_desa`) REFERENCES `city` (`city_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_ressort_gereja` FOREIGN KEY (`id_ressort`) REFERENCES `ressort` (`id_ressort`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of gereja
-- ----------------------------
INSERT INTO `gereja` VALUES (1, 1, 1, '0243', 'HKBP Palmarum', 'Stadion Tarutung, Hutatoruan VI, Kec. Tarutung, Kabupaten Tapanuli Utara, Sumatera Utara', 31, 'Pdt. Martin Gultom. SSi. Teol', '1999-06-20', '2023-05-09 15:34:18', NULL, 0);

-- ----------------------------
-- Table structure for head_pindah
-- ----------------------------
DROP TABLE IF EXISTS `head_pindah`;
CREATE TABLE `head_pindah`  (
  `id_head_reg_pindah` int NOT NULL AUTO_INCREMENT,
  `id_registrasi` int NOT NULL,
  `id_jemaat` int NULL DEFAULT NULL,
  `id_gereja` int NOT NULL DEFAULT 1,
  `no_surat_pindah` int NULL DEFAULT NULL,
  `tgl_pindah` date NOT NULL,
  `tgl_warta` date NULL DEFAULT NULL,
  `id_jenis_registrasi` int NULL DEFAULT 2,
  `id_gereja_tujuan` int NULL DEFAULT NULL,
  `nama_gereja_no_hkbp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `file_surat_pindah` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_head_reg_pindah`) USING BTREE,
  INDEX `registrasi_id_head_pindah`(`id_registrasi` ASC) USING BTREE,
  INDEX `gereja_id_head_pindah`(`id_gereja` ASC) USING BTREE,
  INDEX `jenis_registrasi_id_head_pindah`(`id_jenis_registrasi` ASC) USING BTREE,
  INDEX `fk_id_jemaat_head_pindah`(`id_jemaat` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_head_pindah` FOREIGN KEY (`id_gereja`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_head_pindah` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jenis_registrasi_head_pindah` FOREIGN KEY (`id_jenis_registrasi`) REFERENCES `jenis_registrasi` (`id_jenis_registrasi`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_registrasi_head_pindah` FOREIGN KEY (`id_registrasi`) REFERENCES `registrasi_jemaat` (`id_registrasi`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of head_pindah
-- ----------------------------
INSERT INTO `head_pindah` VALUES (2, 107, 2, 1, NULL, '2023-06-04', NULL, 2, NULL, 'Parso', NULL, 'melayaa', '2023-06-06 11:14:54', NULL, 0);
INSERT INTO `head_pindah` VALUES (3, 55, 2, 1, NULL, '2023-05-28', NULL, 2, NULL, 'Parso', NULL, 'asdfg', '2023-06-06 11:26:27', NULL, 0);
INSERT INTO `head_pindah` VALUES (4, 1, 1, 1, NULL, '2023-05-28', NULL, 2, NULL, 'adsad', NULL, 'wwewe', '2023-06-06 11:27:00', NULL, 0);

-- ----------------------------
-- Table structure for head_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `head_transaksi`;
CREATE TABLE `head_transaksi`  (
  `id_transaksi` int NOT NULL,
  `nama_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `jenis_transaksi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_transaksi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `tahun_anggaran` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_warta` date NOT NULL,
  `is_Jemaat` tinyint(1) NOT NULL DEFAULT 0,
  `id_jemaat` int NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_transaksi`) USING BTREE,
  INDEX `fk_id_jemaat_head_transaksi`(`id_jemaat` ASC) USING BTREE,
  CONSTRAINT `fk_id_jemaat_head_transaksi` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of head_transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for hubungan_keluarga
-- ----------------------------
DROP TABLE IF EXISTS `hubungan_keluarga`;
CREATE TABLE `hubungan_keluarga`  (
  `id_hub_keluarga` int NOT NULL AUTO_INCREMENT,
  `nama_hub_keluarga` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_hub_keluarga`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of hubungan_keluarga
-- ----------------------------
INSERT INTO `hubungan_keluarga` VALUES (1, 'Kepala Keluarga', '', '2023-05-10 15:48:26', NULL, 0);
INSERT INTO `hubungan_keluarga` VALUES (2, 'Istri', '', '2023-05-10 15:48:36', NULL, 0);
INSERT INTO `hubungan_keluarga` VALUES (3, 'Anak', '', '2023-05-10 15:48:41', NULL, 0);
INSERT INTO `hubungan_keluarga` VALUES (4, 'Tanggungan', '', '2023-05-10 15:48:46', NULL, 0);

-- ----------------------------
-- Table structure for jemaat
-- ----------------------------
DROP TABLE IF EXISTS `jemaat`;
CREATE TABLE `jemaat`  (
  `id_jemaat` int NOT NULL AUTO_INCREMENT,
  `nama_depan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_belakang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gelar_depan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `gelar_belakang` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `tempat_lahir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_hub_keluarga` int NULL DEFAULT NULL,
  `id_status_pernikahan` int NULL DEFAULT 3,
  `id_status_ama_ina` int NULL DEFAULT NULL,
  `id_status_anak` int NULL DEFAULT NULL,
  `id_pendidikan` int NULL DEFAULT NULL,
  `id_bidang_pendidikan` int NULL DEFAULT NULL,
  `bidang_pendidikan_lain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_pekerjaan` int NULL DEFAULT NULL,
  `nama_pekerjaan_lain` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `gol_darah` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_kelurahan_desa` int NULL DEFAULT 31,
  `no_telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `no_ponsel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `foto_jemaat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `isBaptis` tinyint(1) NULL DEFAULT 1,
  `isSidi` tinyint(1) NULL DEFAULT 1,
  `isMenikah` tinyint(1) NULL DEFAULT NULL,
  `isMeninggal` tinyint(1) NULL DEFAULT 0,
  `isRPP` tinyint(1) NULL DEFAULT 0,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_jemaat`) USING BTREE,
  INDEX `hub_keluarga_id_jemaat`(`id_hub_keluarga` ASC) USING BTREE,
  INDEX `status_pernikahan_id_jemaat`(`id_status_pernikahan` ASC) USING BTREE,
  INDEX `pendidikan_id_jemaat`(`id_pendidikan` ASC) USING BTREE,
  INDEX `bidnag_pendidikan_id_jemaat`(`id_bidang_pendidikan` ASC) USING BTREE,
  INDEX `pekerjaan_id_jemaat`(`id_pekerjaan` ASC) USING BTREE,
  INDEX `fk_id_kota_jemaat`(`id_kelurahan_desa` ASC) USING BTREE,
  CONSTRAINT `fk_id_bidang_pendidikan_jemaat` FOREIGN KEY (`id_bidang_pendidikan`) REFERENCES `bidang_pendidikan` (`id_bidang_pendidikan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_hub_keluarga_jemaat` FOREIGN KEY (`id_hub_keluarga`) REFERENCES `hubungan_keluarga` (`id_hub_keluarga`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_pekerjaan_jemaat` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id_pekerjaan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_pendidikan_jemaat` FOREIGN KEY (`id_pendidikan`) REFERENCES `pendidikan` (`id_pendidikan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jemaat
-- ----------------------------

-- ----------------------------
-- Table structure for jemaat_hadir
-- ----------------------------
DROP TABLE IF EXISTS `jemaat_hadir`;
CREATE TABLE `jemaat_hadir`  (
  `id_jemaat_hadir` int NOT NULL AUTO_INCREMENT,
  `id_jadwal_ibadah` int NOT NULL,
  `bapak` int NOT NULL,
  `ibu` int NOT NULL,
  `naposo_laki` int NOT NULL,
  `naposo_perempuan` int NOT NULL,
  `remaja_laki` int NOT NULL,
  `remaja_perempuan` int NOT NULL,
  `sekolah_minggu_laki` int NOT NULL,
  `sekolah_minggu_perempuan` int NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jemaat_hadir`) USING BTREE,
  INDEX `jadwal_ibadah_id_jemaat_hadir`(`id_jadwal_ibadah` ASC) USING BTREE,
  CONSTRAINT `fk_id_jadwal_ibadah_jemaat_hadir` FOREIGN KEY (`id_jadwal_ibadah`) REFERENCES `jadwal_ibadah` (`id_jadwal_ibadah`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jemaat_hadir
-- ----------------------------

-- ----------------------------
-- Table structure for jenis_gereja
-- ----------------------------
DROP TABLE IF EXISTS `jenis_gereja`;
CREATE TABLE `jenis_gereja`  (
  `id_jenis_gereja` int NOT NULL AUTO_INCREMENT,
  `jenis_gereja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_gereja`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_gereja
-- ----------------------------
INSERT INTO `jenis_gereja` VALUES (1, 'HKBP', 'Gereja Batak Protestan', '2023-04-23 15:10:31', NULL, 0);

-- ----------------------------
-- Table structure for jenis_kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `jenis_kegiatan`;
CREATE TABLE `jenis_kegiatan`  (
  `id_jenis_kegiatan` int NOT NULL AUTO_INCREMENT,
  `nama_jenis_kegiatan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_kegiatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_kegiatan
-- ----------------------------
INSERT INTO `jenis_kegiatan` VALUES (1, 'Pesta Huria', 'Melaksanakan Acara Lelang', '2023-06-07 10:57:00', '2023-06-12 01:34:53', 1);
INSERT INTO `jenis_kegiatan` VALUES (2, 'Lelang', 'Lelang Tahunan', '2023-06-07 11:09:10', NULL, 0);
INSERT INTO `jenis_kegiatan` VALUES (3, 'kegiatan bersama', 'testing', '2023-06-12 02:09:01', '2023-06-12 03:01:11', 1);
INSERT INTO `jenis_kegiatan` VALUES (4, 'yang lain dulu la lagi', 'yg baru', '2023-06-12 02:12:54', '2023-06-12 03:13:50', 1);
INSERT INTO `jenis_kegiatan` VALUES (5, 'kegiatan bersama lagi', 'awkoawkow', '2023-06-12 02:53:07', '2023-06-12 02:59:28', 1);
INSERT INTO `jenis_kegiatan` VALUES (6, 'kegiatan bersama lagi', 'hahaha', '2023-06-12 03:02:14', '2023-06-12 03:02:17', 1);
INSERT INTO `jenis_kegiatan` VALUES (7, 'kegiatan bersama lagi', 'Pembunuhan Berencana', '2023-06-12 03:04:12', '2023-06-12 03:04:14', 1);
INSERT INTO `jenis_kegiatan` VALUES (8, 'yang lain dulu la lagi', 'yg baru', '2023-06-12 03:12:05', '2023-06-12 03:14:56', 0);
INSERT INTO `jenis_kegiatan` VALUES (9, 'ini lagi la ya', 'heheheh', '2023-06-12 03:49:03', NULL, 0);

-- ----------------------------
-- Table structure for jenis_minggu
-- ----------------------------
DROP TABLE IF EXISTS `jenis_minggu`;
CREATE TABLE `jenis_minggu`  (
  `id_jenis_minggu` int NOT NULL AUTO_INCREMENT,
  `nama_jenis_minggu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT NULL,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_minggu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_minggu
-- ----------------------------
INSERT INTO `jenis_minggu` VALUES (1, 'Minggu Trinitatis', NULL, NULL, NULL, 0);

-- ----------------------------
-- Table structure for jenis_registrasi
-- ----------------------------
DROP TABLE IF EXISTS `jenis_registrasi`;
CREATE TABLE `jenis_registrasi`  (
  `id_jenis_registrasi` int NOT NULL AUTO_INCREMENT,
  `nama_jenis_registrasi` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `sub_jenis_registrasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `idDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_registrasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_registrasi
-- ----------------------------
INSERT INTO `jenis_registrasi` VALUES (1, 'Registrasi Jemaat Baru', 'Registrasi Jemaat', 'Digunakan Sebagai Jenis Registrasi dari Jemaat', '2023-05-08 16:08:00', NULL, 0);
INSERT INTO `jenis_registrasi` VALUES (2, 'Registrasi Jemaat Pindah', 'Registrasi Jemaat', 'Digunakan Sebagai Jenis Registrasi dari Jemaat', '2023-05-08 16:08:23', NULL, 0);

-- ----------------------------
-- Table structure for jenis_rpp
-- ----------------------------
DROP TABLE IF EXISTS `jenis_rpp`;
CREATE TABLE `jenis_rpp`  (
  `id_jenis_rpp` int NOT NULL AUTO_INCREMENT,
  `jenis_rpp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_rpp`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_rpp
-- ----------------------------
INSERT INTO `jenis_rpp` VALUES (1, 'Membunuh', 'Pelanggaran Berat', '2023-05-23 22:13:44', NULL, 0);

-- ----------------------------
-- Table structure for jenis_status
-- ----------------------------
DROP TABLE IF EXISTS `jenis_status`;
CREATE TABLE `jenis_status`  (
  `id_jenis_status` int NOT NULL AUTO_INCREMENT,
  `jenis_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createA` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_status
-- ----------------------------
INSERT INTO `jenis_status` VALUES (1, 'Registrasi', 'Jenis Status Ini Digunakan Untuk Status Registrasi', '2023-04-23 09:25:38', NULL, 0);
INSERT INTO `jenis_status` VALUES (2, 'Pernikahan', 'Untuk Status Pernikahan', '2023-05-10 15:49:58', '2024-02-05 14:36:29', 1);
INSERT INTO `jenis_status` VALUES (3, 'Status Jemaat Aktif', '', '2023-05-17 10:27:59', NULL, 0);
INSERT INTO `jenis_status` VALUES (4, 'Status Jemaat Meninggal', '', '2023-05-17 10:27:59', NULL, 0);
INSERT INTO `jenis_status` VALUES (5, 'Status Jemaat Pindah', '', '2023-05-17 10:27:59', NULL, 0);
INSERT INTO `jenis_status` VALUES (6, 'Status Jemaat Rpp', '', '2023-05-17 10:27:59', NULL, 0);
INSERT INTO `jenis_status` VALUES (7, 'Status Majelis Aktif', '', '2023-05-17 10:27:59', NULL, 0);
INSERT INTO `jenis_status` VALUES (8, 'Jenis Status 0102', '0102', '2023-12-07 17:52:52', '2023-12-08 11:17:34', 0);
INSERT INTO `jenis_status` VALUES (17, 'jenis Status Terakhir', 'null', '2024-04-01 16:32:48', NULL, 0);
INSERT INTO `jenis_status` VALUES (18, 'Jenis status yang Paling Terakhir', 'null', '2024-04-01 16:34:07', NULL, 0);
INSERT INTO `jenis_status` VALUES (19, 'adssff', 'null', '2024-04-02 09:16:36', NULL, 0);
INSERT INTO `jenis_status` VALUES (20, '487555', '685555', '2024-04-02 09:20:43', NULL, 0);
INSERT INTO `jenis_status` VALUES (21, 'Jenis status yang Paling Terakhir Lagi', 'Jenis status yang Paling Terakhir Lagi', '2024-04-02 09:24:01', NULL, 0);
INSERT INTO `jenis_status` VALUES (22, 'Jenis status yang Paling Terakhir 02', 'Jenis status yang Paling Terakhir 02', '2024-04-02 09:28:21', NULL, 0);
INSERT INTO `jenis_status` VALUES (23, 'Jenis status yang Paling Terakhir 03', 'Jenis status yang Paling Terakhir 03', '2024-04-02 09:29:43', NULL, 0);
INSERT INTO `jenis_status` VALUES (24, 'Jenis status yang Paling Terakhir 04', 'Jenis status yang Paling Terakhir 04', '2024-04-02 09:31:15', NULL, 0);
INSERT INTO `jenis_status` VALUES (25, 'Jenis Status Selanjutnya', 'Oke', '2024-06-18 13:42:12', NULL, 0);

-- ----------------------------
-- Table structure for kategori_mata_anggaran
-- ----------------------------
DROP TABLE IF EXISTS `kategori_mata_anggaran`;
CREATE TABLE `kategori_mata_anggaran`  (
  `id_kategori_anggaran` int NOT NULL AUTO_INCREMENT,
  `induk_kategori_anggaran` int NULL DEFAULT NULL,
  `kode_kategori_anggaran` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_kategori_Anggaran` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_kategori_anggaran`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kategori_mata_anggaran
-- ----------------------------

-- ----------------------------
-- Table structure for kategori_pemasukan
-- ----------------------------
DROP TABLE IF EXISTS `kategori_pemasukan`;
CREATE TABLE `kategori_pemasukan`  (
  `id_kategori_pemasukan` int NOT NULL AUTO_INCREMENT,
  `kategori_pemasukan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_kategori_pemasukan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kategori_pemasukan
-- ----------------------------

-- ----------------------------
-- Table structure for kategori_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `kategori_pengeluaran`;
CREATE TABLE `kategori_pengeluaran`  (
  `id_kategori_pengeluaran` int NOT NULL AUTO_INCREMENT,
  `kategori_pengeluaran` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_kategori_pengeluaran`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kategori_pengeluaran
-- ----------------------------

-- ----------------------------
-- Table structure for kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `kegiatan`;
CREATE TABLE `kegiatan`  (
  `id_kegiatan` int NOT NULL AUTO_INCREMENT,
  `id_jenis_kegiatan` int NOT NULL,
  `id_gereja_mengadakan` int NOT NULL,
  `tema_kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `waktu_kegiatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lokasi_kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_kegiatan`) USING BTREE,
  INDEX `gereja_id_jam_kegiatan`(`id_gereja_mengadakan` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_jam_kegiatan` FOREIGN KEY (`id_gereja_mengadakan`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jam_kegiatan_jenis_kegiatan` FOREIGN KEY (`id_kegiatan`) REFERENCES `jenis_kegiatan` (`id_jenis_kegiatan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kegiatan
-- ----------------------------

-- ----------------------------
-- Table structure for majelis
-- ----------------------------
DROP TABLE IF EXISTS `majelis`;
CREATE TABLE `majelis`  (
  `id_majelis` int NOT NULL AUTO_INCREMENT,
  `id_jemaat` int NOT NULL,
  `id_pelayan` int NOT NULL,
  `id_gereja` int NOT NULL DEFAULT 1,
  `tgl_tahbis` date NOT NULL,
  `tgl_akhir_jawatan` date NOT NULL,
  `id_status_pelayanan` int NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_majelis`) USING BTREE,
  INDEX `gereja_id_majelis`(`id_gereja` ASC) USING BTREE,
  INDEX `jemaat_id_majelis`(`id_jemaat` ASC) USING BTREE,
  INDEX `pelayan_id_majelis`(`id_pelayan` ASC) USING BTREE,
  INDEX `status_pelayanan_id_majelis`(`id_status_pelayanan` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_majelis` FOREIGN KEY (`id_gereja`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_majelis` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_pelayan_majelis` FOREIGN KEY (`id_pelayan`) REFERENCES `pelayan_gereja` (`id_pelayan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_status_pelayanan_majelis` FOREIGN KEY (`id_status_pelayanan`) REFERENCES `status` (`id_status`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of majelis
-- ----------------------------

-- ----------------------------
-- Table structure for mata_anggaran
-- ----------------------------
DROP TABLE IF EXISTS `mata_anggaran`;
CREATE TABLE `mata_anggaran`  (
  `id_mata_anggaran` int NOT NULL AUTO_INCREMENT,
  `id_kategori_anggaran` int NOT NULL,
  `kode_mata_anggaran` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_mata_anggaran` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_anggaran` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isSentralisasi` tinyint(1) NOT NULL DEFAULT 0,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_mata_anggaran`) USING BTREE,
  INDEX `fk_kategori_anggaran_mata_anggaran`(`id_kategori_anggaran` ASC) USING BTREE,
  CONSTRAINT `fk_kategori_anggaran_mata_anggaran` FOREIGN KEY (`id_kategori_anggaran`) REFERENCES `kategori_mata_anggaran` (`id_kategori_anggaran`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mata_anggaran
-- ----------------------------

-- ----------------------------
-- Table structure for mejelis_lingkungan
-- ----------------------------
DROP TABLE IF EXISTS `mejelis_lingkungan`;
CREATE TABLE `mejelis_lingkungan`  (
  `id_majelis` int NOT NULL AUTO_INCREMENT,
  `id_wijk` int NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDelete` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_majelis`, `id_wijk`) USING BTREE,
  INDEX `wijk_id_majelis_lingkungan`(`id_wijk` ASC) USING BTREE,
  CONSTRAINT `fk_id_majelis_majelis_lingkungan` FOREIGN KEY (`id_majelis`) REFERENCES `majelis` (`id_majelis`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_wijk_majelis_lingkungan` FOREIGN KEY (`id_wijk`) REFERENCES `wijk` (`id_wijk`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mejelis_lingkungan
-- ----------------------------

-- ----------------------------
-- Table structure for meninggal
-- ----------------------------
DROP TABLE IF EXISTS `meninggal`;
CREATE TABLE `meninggal`  (
  `id_meninggal` int NOT NULL AUTO_INCREMENT,
  `id_gereja` int NOT NULL,
  `id_jemaat` int NOT NULL,
  `tgl_meninggal` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `tempat_pemakaman` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_pendeta_melayani` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_status` int NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_meninggal`) USING BTREE,
  INDEX `gereja_id_meninggal`(`id_gereja` ASC) USING BTREE,
  INDEX `jemaat_id__meninggal`(`id_jemaat` ASC) USING BTREE,
  INDEX `status_id_meninggal`(`id_status` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_meninggal` FOREIGN KEY (`id_gereja`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_meninggal` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_status_meninggal` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of meninggal
-- ----------------------------

-- ----------------------------
-- Table structure for pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `pekerjaan`;
CREATE TABLE `pekerjaan`  (
  `id_pekerjaan` int NOT NULL AUTO_INCREMENT,
  `pekerjaan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pekerjaan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pekerjaan
-- ----------------------------
INSERT INTO `pekerjaan` VALUES (1, 'Pegawai Ne', NULL, '2023-05-10 17:43:29', NULL, 0);
INSERT INTO `pekerjaan` VALUES (2, 'Wiraswasta', NULL, '2023-05-10 17:43:51', NULL, 0);
INSERT INTO `pekerjaan` VALUES (3, 'Dokter', NULL, '2023-06-05 23:11:48', NULL, 0);
INSERT INTO `pekerjaan` VALUES (4, 'Polisi', NULL, '2023-06-05 23:12:08', NULL, 0);
INSERT INTO `pekerjaan` VALUES (5, 'Tentara', NULL, '2023-06-05 23:12:20', NULL, 0);
INSERT INTO `pekerjaan` VALUES (6, 'Perawat', NULL, '2023-06-05 23:12:27', NULL, 0);
INSERT INTO `pekerjaan` VALUES (7, 'Bidan', NULL, '2023-06-05 23:12:48', NULL, 0);
INSERT INTO `pekerjaan` VALUES (8, 'Programmer', NULL, '2023-06-05 23:13:04', NULL, 0);
INSERT INTO `pekerjaan` VALUES (9, 'Ahli Hukum', NULL, '2023-06-05 23:13:20', NULL, 0);
INSERT INTO `pekerjaan` VALUES (10, 'Petani', NULL, '2023-06-05 23:13:28', NULL, 0);

-- ----------------------------
-- Table structure for pelayan_gereja
-- ----------------------------
DROP TABLE IF EXISTS `pelayan_gereja`;
CREATE TABLE `pelayan_gereja`  (
  `id_pelayan` int NOT NULL AUTO_INCREMENT,
  `nama_pelayan` int NOT NULL,
  `isTahbisan` date NOT NULL,
  `keterangan` date NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pelayan`) USING BTREE,
  INDEX `fk_id_jemaat_pelayan_gereja`(`nama_pelayan` ASC) USING BTREE,
  CONSTRAINT `fk_id_jemaat_pelayan_gereja` FOREIGN KEY (`nama_pelayan`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pelayan_gereja
-- ----------------------------

-- ----------------------------
-- Table structure for pelayan_ibadah
-- ----------------------------
DROP TABLE IF EXISTS `pelayan_ibadah`;
CREATE TABLE `pelayan_ibadah`  (
  `id_jadwal_ibadah` int NOT NULL,
  `id_pelayanan_ibadah` int NOT NULL,
  `id_det_jam_kegiatan` int NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  INDEX `pelayanan_ibadah_id_pelayanan_ibadah`(`id_pelayanan_ibadah` ASC) USING BTREE,
  CONSTRAINT `fk_id_pelayanan_ibadah_pelayanan_ibadah` FOREIGN KEY (`id_pelayanan_ibadah`) REFERENCES `pelayanan_ibadah` (`id_pelayanan_ibadah`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pelayan_ibadah
-- ----------------------------

-- ----------------------------
-- Table structure for pelayanan_ibadah
-- ----------------------------
DROP TABLE IF EXISTS `pelayanan_ibadah`;
CREATE TABLE `pelayanan_ibadah`  (
  `id_pelayanan_ibadah` int NOT NULL AUTO_INCREMENT,
  `nama_pelayanan_ibadah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pelayanan_ibadah`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pelayanan_ibadah
-- ----------------------------

-- ----------------------------
-- Table structure for pemasukan
-- ----------------------------
DROP TABLE IF EXISTS `pemasukan`;
CREATE TABLE `pemasukan`  (
  `id_pemasukan` int NOT NULL AUTO_INCREMENT,
  `nama_kategori_pemasukan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_pemasukan` date NOT NULL,
  `total_pemasukan` int NOT NULL,
  `lingkungan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bentuk_pemasukan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kategori_pemasukan` int NULL DEFAULT NULL,
  `bukti_pemasukan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_jemaat` int NULL DEFAULT NULL,
  `id_bank` int NULL DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pemasukan`) USING BTREE,
  INDEX `jemaat_id_pemasukan`(`id_jemaat` ASC) USING BTREE,
  INDEX `bank_id_pemasukan`(`id_bank` ASC) USING BTREE,
  INDEX `fk_id_kategori_pemasukan_pemasukan`(`id_kategori_pemasukan` ASC) USING BTREE,
  CONSTRAINT `fk_id_bank_pemasukan` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id_bank`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_pemasukan` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_kategori_pemasukan_pemasukan` FOREIGN KEY (`id_kategori_pemasukan`) REFERENCES `kategori_pemasukan` (`id_kategori_pemasukan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pemasukan
-- ----------------------------

-- ----------------------------
-- Table structure for pendidikan
-- ----------------------------
DROP TABLE IF EXISTS `pendidikan`;
CREATE TABLE `pendidikan`  (
  `id_pendidikan` int NOT NULL AUTO_INCREMENT,
  `pendidikan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pendidikan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pendidikan
-- ----------------------------
INSERT INTO `pendidikan` VALUES (1, 'TK', '', '2023-05-10 15:46:37', NULL, 0);
INSERT INTO `pendidikan` VALUES (2, 'SD', '', '2023-05-10 15:46:41', NULL, 0);
INSERT INTO `pendidikan` VALUES (3, 'SMP', '', '2023-05-10 15:46:46', NULL, 0);
INSERT INTO `pendidikan` VALUES (4, 'SMA', '', '2023-05-10 15:46:51', NULL, 0);
INSERT INTO `pendidikan` VALUES (5, 'Perguruan Tinggi', '', '2023-05-10 15:47:00', NULL, 0);

-- ----------------------------
-- Table structure for pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE `pengeluaran`  (
  `id_pengeluaran` int NOT NULL AUTO_INCREMENT,
  `nama_kategori_pengelaran` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah_pengeluaran` int NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `keterangan_pengeluaran` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kategori_pengeluaran` int NULL DEFAULT NULL,
  `id_bank` int NULL DEFAULT NULL,
  `bukti_pengeluaran` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pengeluaran`) USING BTREE,
  INDEX `fk_id_bank_pengeluaran`(`id_bank` ASC) USING BTREE,
  INDEX `fk_id_kategori_pengeluaran`(`id_kategori_pengeluaran` ASC) USING BTREE,
  CONSTRAINT `fk_id_bank_pengeluaran` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id_bank`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_kategori_pengeluaran` FOREIGN KEY (`id_kategori_pengeluaran`) REFERENCES `kategori_pengeluaran` (`id_kategori_pengeluaran`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pengeluaran
-- ----------------------------

-- ----------------------------
-- Table structure for pernikahan
-- ----------------------------
DROP TABLE IF EXISTS `pernikahan`;
CREATE TABLE `pernikahan`  (
  `id_pernikahan` int NOT NULL AUTO_INCREMENT,
  `id_registrasi_pernikahan` int NOT NULL,
  `id_gereja` int NULL DEFAULT NULL,
  `tgl_pernikahan` date NOT NULL,
  `nats_pernikahan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isHKBP` int NOT NULL DEFAULT 0,
  `id_gereja_nikah` int NULL DEFAULT NULL,
  `nama_gereja_non_HKBP` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_pendeta` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_status` int NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pernikahan`) USING BTREE,
  INDEX `gereja_id_pernikahan`(`id_gereja` ASC) USING BTREE,
  INDEX `gereja_nikah_id_pernikahan`(`id_gereja_nikah` ASC) USING BTREE,
  INDEX `status_id_pernikahan`(`id_status` ASC) USING BTREE,
  INDEX `fk_registrasi_nikah_pernikahan`(`id_registrasi_pernikahan` ASC) USING BTREE,
  CONSTRAINT `fk_registrasi_nikah_pernikahan` FOREIGN KEY (`id_registrasi_pernikahan`) REFERENCES `registrasi_pernikahan` (`id_registrasi_nikah`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `gereja_id_pernikahan` FOREIGN KEY (`id_gereja`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `gereja_nikah_id_pernikahan` FOREIGN KEY (`id_gereja_nikah`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `status_id_pernikahan` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pernikahan
-- ----------------------------

-- ----------------------------
-- Table structure for pernikahan_jemaat
-- ----------------------------
DROP TABLE IF EXISTS `pernikahan_jemaat`;
CREATE TABLE `pernikahan_jemaat`  (
  `id_pernikahan` int NOT NULL,
  `id_jemaat_laki` int NOT NULL,
  `id_jemaat_perempuan` int NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NULL DEFAULT 0,
  INDEX `pernikahan_id_pernikahan_jemaat`(`id_pernikahan` ASC) USING BTREE,
  INDEX `jemaat_laki_id_pernikahan_jemaat`(`id_jemaat_laki` ASC) USING BTREE,
  INDEX `fk_id_jemaat_perempuan_pernikahan_jemaat`(`id_jemaat_perempuan` ASC) USING BTREE,
  CONSTRAINT `fk_id_jemaat_laki_pernikahan_jemaat` FOREIGN KEY (`id_jemaat_laki`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_perempuan_pernikahan_jemaat` FOREIGN KEY (`id_jemaat_perempuan`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_pernikahan_pernikahan_jemaat` FOREIGN KEY (`id_pernikahan`) REFERENCES `pernikahan` (`id_pernikahan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pernikahan_jemaat
-- ----------------------------

-- ----------------------------
-- Table structure for province
-- ----------------------------
DROP TABLE IF EXISTS `province`;
CREATE TABLE `province`  (
  `province_id` int NOT NULL,
  `country_id` int NOT NULL DEFAULT 103,
  `province_name` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`province_id`) USING BTREE,
  INDEX `fk_id_country_province`(`country_id` ASC) USING BTREE,
  CONSTRAINT `fk_id_country_province` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of province
-- ----------------------------
INSERT INTO `province` VALUES (1, 103, 'Bali', NULL, NULL, 0);
INSERT INTO `province` VALUES (2, 103, 'Bangka Belitung', NULL, NULL, 0);
INSERT INTO `province` VALUES (3, 103, 'Banten', NULL, NULL, 0);
INSERT INTO `province` VALUES (4, 103, 'Bengkulu', NULL, NULL, 0);
INSERT INTO `province` VALUES (5, 103, 'DI Yogyakarta', NULL, NULL, 0);
INSERT INTO `province` VALUES (6, 103, 'DKI Jakarta', NULL, NULL, 0);
INSERT INTO `province` VALUES (7, 103, 'Gorontalo', NULL, NULL, 0);
INSERT INTO `province` VALUES (8, 103, 'Jambi', NULL, NULL, 0);
INSERT INTO `province` VALUES (9, 103, 'Jawa Barat', NULL, NULL, 0);
INSERT INTO `province` VALUES (10, 103, 'Jawa Tengah', NULL, NULL, 0);
INSERT INTO `province` VALUES (11, 103, 'Jawa Timur', NULL, NULL, 0);
INSERT INTO `province` VALUES (12, 103, 'Kalimantan Barat', NULL, NULL, 0);
INSERT INTO `province` VALUES (13, 103, 'Kalimantan Selatan', NULL, NULL, 0);
INSERT INTO `province` VALUES (14, 103, 'Kalimantan Tengah', NULL, NULL, 0);
INSERT INTO `province` VALUES (15, 103, 'Kalimantan Timur', NULL, NULL, 0);
INSERT INTO `province` VALUES (16, 103, 'Kalimantan Utara', NULL, NULL, 0);
INSERT INTO `province` VALUES (17, 103, 'Kepulauan Riau', NULL, NULL, 0);
INSERT INTO `province` VALUES (18, 103, 'Lampung', NULL, NULL, 0);
INSERT INTO `province` VALUES (19, 103, 'Maluku', NULL, NULL, 0);
INSERT INTO `province` VALUES (20, 103, 'Maluku Utara', NULL, NULL, 0);
INSERT INTO `province` VALUES (21, 103, 'Nanggroe Aceh Darussalam (NAD)', NULL, NULL, 0);
INSERT INTO `province` VALUES (22, 103, 'Nusa Tenggara Barat (NTB)', NULL, NULL, 0);
INSERT INTO `province` VALUES (23, 103, 'Nusa Tenggara Timur (NTT)', NULL, NULL, 0);
INSERT INTO `province` VALUES (24, 103, 'Papua', NULL, NULL, 0);
INSERT INTO `province` VALUES (25, 103, 'Papua Barat', NULL, NULL, 0);
INSERT INTO `province` VALUES (26, 103, 'Riau', NULL, NULL, 0);
INSERT INTO `province` VALUES (27, 103, 'Sulawesi Barat', NULL, NULL, 0);
INSERT INTO `province` VALUES (28, 103, 'Sulawesi Selatan', NULL, NULL, 0);
INSERT INTO `province` VALUES (29, 103, 'Sulawesi Tengah', NULL, NULL, 0);
INSERT INTO `province` VALUES (30, 103, 'Sulawesi Tenggara', NULL, NULL, 0);
INSERT INTO `province` VALUES (31, 103, 'Sulawesi Utara', NULL, NULL, 0);
INSERT INTO `province` VALUES (32, 103, 'Sumatera Barat', NULL, NULL, 0);
INSERT INTO `province` VALUES (33, 103, 'Sumatera Selatan', NULL, NULL, 0);
INSERT INTO `province` VALUES (34, 103, 'Sumatera Utara', NULL, NULL, 0);

-- ----------------------------
-- Table structure for registrasi_baptis
-- ----------------------------
DROP TABLE IF EXISTS `registrasi_baptis`;
CREATE TABLE `registrasi_baptis`  (
  `id_registrasi_baptis` int NOT NULL AUTO_INCREMENT,
  `isJemaat` tinyint(1) NULL DEFAULT 1,
  `idJemaat` int NULL DEFAULT NULL,
  `nama_ayah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_ibu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_lahir` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT '0',
  `id_kelurahan_kota` int NULL DEFAULT NULL,
  `id_hub_keluarga` int NULL DEFAULT 3,
  `is_HKBP` tinyint(1) NOT NULL DEFAULT 1,
  `id_gereja_baptis` int NULL DEFAULT 1,
  `nama_gereja_non_hkbp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tanggal_baptis` date NULL DEFAULT NULL,
  `no_surat_baptis` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_pendeta_baptis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `file_surat_baptis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_status` int NULL DEFAULT 1,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_registrasi_baptis`) USING BTREE,
  INDEX `fk_id_status_registrasi_baptis`(`id_status` ASC) USING BTREE,
  INDEX `fk_id_hub_keluarga_registrasi_baptis`(`id_hub_keluarga` ASC) USING BTREE,
  INDEX `fk_id_gereja_baptis_registrasi_baptis`(`id_gereja_baptis` ASC) USING BTREE,
  INDEX `fk_id_pendeta_registrasi_baptis`(`nama_pendeta_baptis` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_baptis_registrasi_baptis` FOREIGN KEY (`id_gereja_baptis`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_hub_keluarga_registrasi_baptis` FOREIGN KEY (`id_hub_keluarga`) REFERENCES `hubungan_keluarga` (`id_hub_keluarga`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_status_registrasi_baptis` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of registrasi_baptis
-- ----------------------------
INSERT INTO `registrasi_baptis` VALUES (1, 1, NULL, 'kld', 'dsa', 'sahat', 'dsad', '2022-09-03', 'laki-laki', '0', NULL, 3, 1, 1, NULL, NULL, 'sdad', '4', NULL, 'sdadada', 1, '2023-06-06 00:45:56', NULL, 0);
INSERT INTO `registrasi_baptis` VALUES (2, 1, NULL, 'kld', 'dsa', 'sahat', 'dsad', '2022-09-03', 'laki-laki', '0', NULL, 3, 1, 1, NULL, NULL, 'sdad', '4', NULL, 'sdada', 1, '2023-06-06 00:47:08', NULL, 0);
INSERT INTO `registrasi_baptis` VALUES (3, 1, NULL, 'sas', 'sddsd', 'mahal', 'Laguboti', '2023-06-04', 'Laki-laki', '0', NULL, 3, 1, 1, NULL, NULL, 'sdsdsdf', '4', NULL, 'mwehehehe', 1, '2023-06-06 00:49:39', NULL, 0);
INSERT INTO `registrasi_baptis` VALUES (4, 1, NULL, 'Bakso', 'sddsd', 'Josep', 'Laguboti', '2023-05-28', 'Laki-laki', '1', NULL, 3, 1, 1, NULL, NULL, 'Laguboti', '4', NULL, 'asdfghj', 1, '2023-06-06 00:50:17', NULL, 0);
INSERT INTO `registrasi_baptis` VALUES (5, 1, NULL, 'figarland', 'imu', 'shanks', 'mariejoa', '2003-06-09', 'laki-laki', '1', NULL, 3, 1, 1, NULL, '2004-06-09', 'marijoa', '4', NULL, 'red haired shanks', 1, '2023-06-07 00:08:49', '2023-06-09 12:01:31', 0);
INSERT INTO `registrasi_baptis` VALUES (6, 1, NULL, 'sas', 'sddsd', 'Mhara', 'Parsoburan', '2023-06-20', 'Laki-laki', '0', NULL, 3, 1, 1, NULL, NULL, 'medan', '4', NULL, 'asdfg', 1, '2023-06-07 00:17:21', '2023-06-09 11:50:48', 1);
INSERT INTO `registrasi_baptis` VALUES (7, 1, NULL, 'dragon', 'crocodile', 'luffy', 'west blue', '2023-06-09', 'laki-laki', '1', NULL, 3, 1, 1, NULL, '2023-08-09', 'egg head', '4', NULL, 'pirate king', 1, '2023-06-09 11:46:10', NULL, 0);

-- ----------------------------
-- Table structure for registrasi_calon_mempelai
-- ----------------------------
DROP TABLE IF EXISTS `registrasi_calon_mempelai`;
CREATE TABLE `registrasi_calon_mempelai`  (
  `id_registrasi_calon` int NOT NULL AUTO_INCREMENT,
  `id_registrasi_nikah` int NULL DEFAULT NULL,
  `isHKBP_laki` tinyint(1) NOT NULL DEFAULT 0,
  `id_gereja_laki` int NULL DEFAULT NULL,
  `nama_gereja_laki` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isJemaat_laki` tinyint(1) NOT NULL DEFAULT 0,
  `id_jemaat_laki` int NOT NULL,
  `nama_ayah_laki` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_ibu_laki` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `isHKBP_perempuan` tinyint(1) NOT NULL DEFAULT 0,
  `id_gereja_perempuan` int NULL DEFAULT NULL,
  `nama_gereja_perempuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isJemaat_perempuan` tinyint(1) NOT NULL DEFAULT 0,
  `id_jemaat_perempuan` int NOT NULL,
  `nama_ayah_perempuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_ibu_perempuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_registrasi_calon`) USING BTREE,
  INDEX `fk_registrasi_nikah_registrasi_calon_mempelai`(`id_registrasi_nikah` ASC) USING BTREE,
  INDEX `fk_id_gereja_laki_registrasi_calon_mempelai`(`id_gereja_laki` ASC) USING BTREE,
  INDEX `fk_id_jemaat_laki_registrasi_calon_mempelai`(`id_jemaat_laki` ASC) USING BTREE,
  INDEX `fk_id_gereja_perempuan_registrasi_calon_mempelai`(`id_gereja_perempuan` ASC) USING BTREE,
  INDEX `fk_id_jemaat_perempuan_registrasi_calon_mempelai`(`id_jemaat_perempuan` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_laki_registrasi_calon_mempelai` FOREIGN KEY (`id_gereja_laki`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_gereja_perempuan_registrasi_calon_mempelai` FOREIGN KEY (`id_gereja_perempuan`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_laki_registrasi_calon_mempelai` FOREIGN KEY (`id_jemaat_laki`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_perempuan_registrasi_calon_mempelai` FOREIGN KEY (`id_jemaat_perempuan`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_registrasi_nikah_registrasi_calon_mempelai` FOREIGN KEY (`id_registrasi_nikah`) REFERENCES `registrasi_pernikahan` (`id_registrasi_nikah`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of registrasi_calon_mempelai
-- ----------------------------
INSERT INTO `registrasi_calon_mempelai` VALUES (1, NULL, 0, NULL, 'Palamrum', 0, 12, 'Jaki', 'There', 0, NULL, 'Sarimatrondang', 0, 2, 'Sahat', 'Kiki', 'asdfg', '2023-06-06 09:59:11', NULL, 0);
INSERT INTO `registrasi_calon_mempelai` VALUES (2, NULL, 0, NULL, 'Palmarum', 0, 18, 'Mahar', 'Mama', 0, NULL, 'Parso', 0, 9, 'Sahat', 'Turnip', 'mwehehehe', '2023-06-06 10:09:26', NULL, 0);
INSERT INTO `registrasi_calon_mempelai` VALUES (3, NULL, 0, NULL, 'Palmarum', 0, 3, 'Santo', 'Mama', 0, NULL, 'Parso', 0, 11, 'Sahat', 'Turnip', 'asdfghj', '2023-06-06 10:10:55', NULL, 0);

-- ----------------------------
-- Table structure for registrasi_jemaat
-- ----------------------------
DROP TABLE IF EXISTS `registrasi_jemaat`;
CREATE TABLE `registrasi_jemaat`  (
  `id_registrasi` int NOT NULL AUTO_INCREMENT,
  `no_registrasi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_registrasi` date NULL DEFAULT NULL,
  `id_wijk` int NOT NULL,
  `id_jenis_register` int NOT NULL,
  `id_gereja` int NOT NULL,
  `nama_gereja_nonHKBP` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `no_register_sebelumnya` int NULL DEFAULT NULL,
  `tgl_warta` date NULL DEFAULT NULL,
  `id_status_registrasi` int NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_registrasi`) USING BTREE,
  INDEX `wijk_id_registrasi_jemaat`(`id_wijk` ASC) USING BTREE,
  INDEX `jenis_register_id_registrasi_jemaat`(`id_jenis_register` ASC) USING BTREE,
  INDEX `gereja_id_registrasi_jemaat`(`id_gereja` ASC) USING BTREE,
  INDEX `fk_id_status_registrasi_registrasi_jemaat`(`id_status_registrasi` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_registrasi_jemaat` FOREIGN KEY (`id_gereja`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jenis_register_registrasi_jemaat` FOREIGN KEY (`id_jenis_register`) REFERENCES `jenis_registrasi` (`id_jenis_registrasi`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_status_registrasi_registrasi_jemaat` FOREIGN KEY (`id_status_registrasi`) REFERENCES `status` (`id_status`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_wijk_registrasi_jemaat` FOREIGN KEY (`id_wijk`) REFERENCES `wijk` (`id_wijk`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 126 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of registrasi_jemaat
-- ----------------------------
INSERT INTO `registrasi_jemaat` VALUES (1, '024303', '2020-09-14', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 15:41:23', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (2, '024306', '2020-09-14', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 15:46:35', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (3, '0243001', '2020-09-17', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 15:51:05', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (4, '0243002', '2020-09-14', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 15:51:41', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (5, '0243004', '2020-10-25', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 15:52:09', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (6, '0243005', '2020-09-25', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 15:53:11', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (7, '0243007', NULL, 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:10:22', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (8, '0243009', '2020-11-20', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:11:42', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (9, '0243010', '2020-09-14', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:12:05', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (10, '0243011', '2020-09-14', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:12:23', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (11, '0243012', NULL, 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:12:31', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (12, '0243013', '2020-09-23', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:12:46', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (13, '0243014', '2020-10-06', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:13:02', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (14, '0243015', '2020-10-25', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:13:16', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (15, '0243016', '2020-09-14', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:13:29', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (16, '0243017', '2020-10-06', 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:17:20', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (17, '0243136', NULL, 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:17:40', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (18, '0243138', NULL, 1, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:18:04', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (19, '0243018', '2020-09-16', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:18:21', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (20, '0243019', '2020-09-25', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:18:58', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (21, '0243020', '2020-09-28', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 16:19:14', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (22, '0243021', '2020-09-14', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:49:36', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (23, '0243023', '2020-09-23', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:50:10', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (24, '0243024', '2020-09-25', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:53:37', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (25, '0243025', '2020-09-23', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:53:57', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (26, '0243026', NULL, 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:54:04', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (27, '0243027', '2020-09-16', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:54:23', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (28, '0243028', '2020-09-25', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:54:40', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (29, '0243029', '2020-09-28', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:55:02', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (30, '0243126', '2021-02-04', 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:55:16', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (31, '0243141', NULL, 2, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:55:29', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (32, '024336', '2020-10-06', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:58:38', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (33, '0243030', '2020-09-28', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 17:59:50', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (34, '0243031', '2020-09-14', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:00:04', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (35, '0243032', '2020-09-28', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:00:19', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (36, '0243033', '2020-09-28', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:00:40', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (37, '0243034', '2020-11-20', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:00:58', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (38, '0243039', NULL, 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:01:07', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (39, '0243040', NULL, 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:01:20', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (40, '0243042', '2020-09-25', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:01:42', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (41, '0243043', '2020-11-20', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:02:00', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (42, '0243044', '2020-09-14', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:02:14', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (43, '0243045', '2020-09-28', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:02:42', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (44, '0243046', '2020-10-25', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:02:57', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (45, '0243048', '2020-11-20', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:03:11', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (46, '0243049', '2020-10-25', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:03:24', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (47, '0243050', '2020-11-20', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:03:42', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (48, '0243051', '2020-11-20', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:04:19', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (49, '0243052', '2020-09-29', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:04:36', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (50, '0243054', '2020-09-14', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:04:55', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (51, '0243058', '2020-09-14', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:05:14', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (52, '0243061', '2020-10-25', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:05:27', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (53, '0243124', NULL, 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:05:33', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (54, '0243125', '2020-11-20', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:05:49', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (55, '0243128', NULL, 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:05:57', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (56, '0243132', NULL, 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:06:09', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (57, '0243135', '2022-04-10', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:06:32', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (58, '0243137', '2022-02-20', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:06:50', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (59, '0243139', '2022-02-20', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:06:57', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (60, '0243142', '2022-03-27', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:07:12', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (61, '0243053', '2020-10-06', 3, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:09:20', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (62, '0243062', '2020-10-06', 4, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:14:31', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (63, '0243063', '2020-09-23', 4, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:14:41', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (64, '0243064', '2020-09-23', 4, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:14:58', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (65, '0243065', '2020-09-14', 4, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:15:12', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (66, '0243066', '2020-10-06', 4, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:15:26', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (67, '0243067', '2020-10-06', 4, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:16:33', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (68, '0243068', '2020-10-06', 4, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:16:46', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (69, '0243145', '2022-12-25', 4, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:17:01', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (70, '0243070', '2020-10-25', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:17:27', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (71, '0243071', '2020-11-20', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:17:39', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (72, '0243073', '2020-09-28', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:17:50', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (73, '0243074', '2020-09-28', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:18:05', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (74, '0243075', '2020-10-25', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:18:16', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (75, '0243076', '2020-09-28', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:18:30', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (76, '0243077', '2020-09-28', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:18:42', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (77, '0243079', '2020-09-28', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:19:04', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (78, '0243129', '2021-03-14', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:19:19', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (79, '0243069', '2020-09-25', 5, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:22:24', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (80, '024383', '2020-10-06', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:22:37', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (81, '0243080', '2020-09-25', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:22:48', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (82, '0243081', '2020-09-29', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:23:00', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (83, '0243082', NULL, 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:23:14', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (84, '0243084', '2020-09-25', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:28:38', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (85, '0243085', '2020-09-25', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:28:50', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (86, '0243086', '2020-09-25', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:29:04', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (87, '0243087', '2020-09-29', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:29:15', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (88, '0243088', NULL, 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:29:21', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (89, '0243089', '2020-09-14', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:29:36', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (90, '0243090', '2020-10-06', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:30:01', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (91, '0243091', '2020-09-29', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:30:14', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (92, '0243092', '2020-09-09', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:30:27', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (93, '0243130', '2021-08-29', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:30:43', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (94, '0243131', '2022-01-30', 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:30:56', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (95, '0243143', NULL, 6, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:31:02', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (96, '0243093', '2020-09-15', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:31:39', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (97, '0243094', NULL, 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:31:47', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (98, '0243095', '2020-09-29', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:31:57', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (99, '0243096', '2020-10-25', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:32:08', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (100, '0243097', '2020-09-14', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:32:20', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (101, '0243098', NULL, 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:32:29', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (102, '0243099', '2020-10-06', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:32:42', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (103, '0243100', '2020-09-17', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:32:57', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (104, '0243101', '2020-09-14', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:33:13', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (105, '0243103', '2020-09-14', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:36:07', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (106, '0243104', '2020-09-25', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:36:19', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (107, '0243106', '2020-09-17', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:36:34', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (108, '0243108', '2020-09-29', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:36:47', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (109, '0243109', '2020-09-25', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:37:03', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (110, '0243133', '2020-06-26', 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:37:17', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (111, '0243140', NULL, 7, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:37:23', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (112, '0243112', '2020-09-14', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:37:58', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (113, '0243114', NULL, 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:38:08', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (114, '0243115', '2020-09-14', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:38:22', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (115, '0243116', '2020-09-14', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:38:35', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (116, '0243117', '2020-09-14', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:38:58', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (117, '0243118', '2020-10-06', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:39:10', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (118, '0243119', '2020-09-14', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:39:22', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (119, '0243120', '2020-10-06', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:39:38', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (120, '0243121', '2020-09-14', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:41:43', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (121, '0243122', '2020-09-14', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:41:55', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (122, '0243123', '2020-09-14', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:42:08', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (123, '0243127', NULL, 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:42:15', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (124, '0243134', '2022-03-27', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:42:29', NULL, 0);
INSERT INTO `registrasi_jemaat` VALUES (125, '0243144', '2022-12-10', 8, 1, 1, NULL, NULL, NULL, 2, '2023-05-09 18:42:40', NULL, 0);

-- ----------------------------
-- Table structure for registrasi_pernikahan
-- ----------------------------
DROP TABLE IF EXISTS `registrasi_pernikahan`;
CREATE TABLE `registrasi_pernikahan`  (
  `id_registrasi_nikah` int NOT NULL AUTO_INCREMENT,
  `id_gereja` int NULL DEFAULT NULL,
  `tgl_martumpol` date NULL DEFAULT NULL,
  `tgl_warta_martumpol` date NULL DEFAULT NULL,
  `isHKBP_martumpol` int NULL DEFAULT NULL,
  `id_gereja_martumpol` int NULL DEFAULT NULL,
  `nama_gereja_martumpol` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nomor_surat_martumpol` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_pendeta_martumpol` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `file_surat_martumpol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tgl_pemberkatan` date NULL DEFAULT NULL,
  `tgl_warta_pemberkatan` date NULL DEFAULT NULL,
  `isHKBP_pemeberkatan` int NULL DEFAULT NULL,
  `id_gereja_pemberkatan` int NULL DEFAULT NULL,
  `nama_gereja_pemberkatan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nomor_surat_pemberkatan` int NULL DEFAULT NULL,
  `nama_pendeta_pemberkatan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `file_surat_pemberkatan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` int NULL DEFAULT 0,
  PRIMARY KEY (`id_registrasi_nikah`) USING BTREE,
  INDEX `gereja_id_registrasi_pernikahan`(`id_gereja` ASC) USING BTREE,
  INDEX `gereja_martumpol_id_registrasi_pernikahan`(`id_gereja_martumpol` ASC) USING BTREE,
  INDEX `gereja_pemberkatan_id_registrasi_pernikahan`(`id_gereja_pemberkatan` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of registrasi_pernikahan
-- ----------------------------

-- ----------------------------
-- Table structure for registrasi_sidi
-- ----------------------------
DROP TABLE IF EXISTS `registrasi_sidi`;
CREATE TABLE `registrasi_sidi`  (
  `id_registrasi_sidi` int NOT NULL AUTO_INCREMENT,
  `is_jemaat` tinyint(1) NULL DEFAULT 0,
  `id_jemaat` int NULL DEFAULT NULL,
  `nama_ayah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_ibu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_lahir` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT '0',
  `id_hub_keluarga` int NOT NULL DEFAULT 3,
  `is_HKBP` tinyint(1) NOT NULL DEFAULT 0,
  `id_gereja_sidi` int NOT NULL DEFAULT 1,
  `nama_gereja_non_HKBP` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tanggal_sidi` date NULL DEFAULT NULL,
  `nats_sidi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_pendeta_sidi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `file_surat_baptis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_status` int NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_registrasi_sidi`) USING BTREE,
  INDEX `fk_id_jemaat_registrasi_sidi`(`id_jemaat` ASC) USING BTREE,
  INDEX `fk_id_hub_keluarga_registrasi_sidi`(`id_hub_keluarga` ASC) USING BTREE,
  INDEX `fk_id_gereja_sidi_registrasi_sidi`(`id_gereja_sidi` ASC) USING BTREE,
  INDEX `fk_id_status_registrasi_sidi`(`id_status` ASC) USING BTREE,
  INDEX `fk_pendeta_sidi`(`nama_pendeta_sidi` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_sidi_registrasi_sidi` FOREIGN KEY (`id_gereja_sidi`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_hub_keluarga_registrasi_sidi` FOREIGN KEY (`id_hub_keluarga`) REFERENCES `hubungan_keluarga` (`id_hub_keluarga`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_registrasi_sidi` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_status_registrasi_sidi` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of registrasi_sidi
-- ----------------------------
INSERT INTO `registrasi_sidi` VALUES (1, 0, NULL, 'maja', 'mija', 'Josep', 'Parso', '2003-07-09', '1', 3, 0, 1, 'HKBP Palmarum', NULL, NULL, '', NULL, 'adasdsa', NULL, '2023-06-06 11:42:19', NULL, 0);
INSERT INTO `registrasi_sidi` VALUES (2, 0, NULL, 'sas', 'sddsd', 'Sahat', 'Parsoburan', '2023-05-28', '0', 3, 0, 1, 'medan jaya', NULL, NULL, NULL, NULL, 'wwewe', NULL, '2023-06-06 11:57:40', NULL, 0);
INSERT INTO `registrasi_sidi` VALUES (3, 0, NULL, 'RINNI', 'SUSU', 'Josep', 'Parsoburan', '2023-05-28', '1', 3, 0, 1, 'medan jaya', NULL, NULL, NULL, NULL, 'asdfg', NULL, '2023-06-07 12:04:46', NULL, 0);
INSERT INTO `registrasi_sidi` VALUES (4, 0, NULL, 'qwe', 'er', 'qwe', 'rt', '2023-05-29', '0', 3, 0, 1, 'sdfg', NULL, NULL, NULL, NULL, 'gfgf', NULL, '2023-06-07 15:03:35', NULL, 0);

-- ----------------------------
-- Table structure for ressort
-- ----------------------------
DROP TABLE IF EXISTS `ressort`;
CREATE TABLE `ressort`  (
  `id_ressort` int NOT NULL AUTO_INCREMENT,
  `id_distrik` int NOT NULL,
  `kode_ressort` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_ressort` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kelurahan_desa` int NOT NULL,
  `pendeta_ressort` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_berdiri` date NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_ressort`) USING BTREE,
  INDEX `distrik_id_ressort`(`id_distrik` ASC) USING BTREE,
  INDEX `fk_id_kota_ressort`(`id_kelurahan_desa` ASC) USING BTREE,
  CONSTRAINT `fk_id_distrik_ressort` FOREIGN KEY (`id_distrik`) REFERENCES `distrik` (`id_distrik`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_kota_ressort` FOREIGN KEY (`id_kelurahan_desa`) REFERENCES `city` (`city_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ressort
-- ----------------------------
INSERT INTO `ressort` VALUES (1, 1, '0243', 'Ressort Palmarum', 'Stadion Tarutung, Hutatoruan VI, Kec. Tarutung, Kabupaten Tapanuli Utara, Sumatera Utara', 31, 'Pdt. Martin Gultom. SSi. Teol', '1999-07-20', '2023-05-08 15:58:18', NULL, 0);

-- ----------------------------
-- Table structure for rpp
-- ----------------------------
DROP TABLE IF EXISTS `rpp`;
CREATE TABLE `rpp`  (
  `id_rpp` int NOT NULL AUTO_INCREMENT,
  `id_gereja` int NOT NULL DEFAULT 1,
  `id_jemaat` int NOT NULL,
  `tgl_warta_rpp` date NOT NULL,
  `id_jenis_rpp` int NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_status` int NOT NULL DEFAULT 6,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_rpp`) USING BTREE,
  INDEX `gereja_id_rpp`(`id_gereja` ASC) USING BTREE,
  INDEX `jemaat_id_rpp`(`id_jemaat` ASC) USING BTREE,
  INDEX `status_id_rpp`(`id_status` ASC) USING BTREE,
  INDEX `fk_id_jenis_rpp_rpp`(`id_jenis_rpp` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_rpp` FOREIGN KEY (`id_gereja`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_rpp` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jenis_rpp_rpp` FOREIGN KEY (`id_jenis_rpp`) REFERENCES `jenis_rpp` (`id_jenis_rpp`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_status_rpp` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rpp
-- ----------------------------
INSERT INTO `rpp` VALUES (1, 1, 2, '2023-04-06', 1, 'Pembunuhan Tidak Terencana lagi', 6, '2023-05-24 17:52:28', '2023-05-24 22:47:59', 1);
INSERT INTO `rpp` VALUES (2, 1, 1, '2020-09-20', 1, 'Pembunuhan', 6, '2023-05-25 00:04:57', '2023-05-25 00:08:11', 1);
INSERT INTO `rpp` VALUES (3, 1, 3, '2023-05-24', 1, 'Pembunuhan Berencana', 6, '2023-05-25 00:05:27', '2023-05-25 00:08:12', 1);
INSERT INTO `rpp` VALUES (4, 1, 1, '2023-05-19', 1, 'Pembunuhan Berencana', 6, '2023-05-25 00:08:29', '2023-05-25 00:09:24', 1);
INSERT INTO `rpp` VALUES (5, 1, 1, '2020-05-20', 1, 'Pembunuhan Berencana', 6, '2023-05-25 00:11:25', '2023-05-25 01:35:23', 1);
INSERT INTO `rpp` VALUES (6, 1, 1, '2023-05-05', 1, 'pembunuhan', 6, '2023-05-25 10:30:39', '2023-05-26 02:01:55', 1);
INSERT INTO `rpp` VALUES (7, 1, 3, '2023-05-13', 1, 'bunu', 6, '2023-05-26 02:00:55', '2023-05-26 02:01:53', 1);
INSERT INTO `rpp` VALUES (8, 1, 1, '2023-05-13', 1, 'hadjsad1', 6, '2023-05-27 21:08:31', '2023-06-12 00:34:21', 0);

-- ----------------------------
-- Table structure for set_sentralisasi
-- ----------------------------
DROP TABLE IF EXISTS `set_sentralisasi`;
CREATE TABLE `set_sentralisasi`  (
  `id_sentralisasi` int NOT NULL,
  `persentasi_sentralisasi` int NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_sentralisasi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of set_sentralisasi
-- ----------------------------

-- ----------------------------
-- Table structure for sidi
-- ----------------------------
DROP TABLE IF EXISTS `sidi`;
CREATE TABLE `sidi`  (
  `id_sidi` int NOT NULL AUTO_INCREMENT,
  `id_registrasi_sidi` int NOT NULL,
  `id_jemaat` int NOT NULL,
  `tgl_sidi` date NOT NULL,
  `no_surat_sidi` int NOT NULL,
  `nats_sidi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isHKBP` tinyint(1) NOT NULL DEFAULT 0,
  `id_gereja_sidi` int NOT NULL,
  `nama_gereja_non_hkbp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_pendeta_sidi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `file_surat_sidi` bigint NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_status` int NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_sidi`) USING BTREE,
  INDEX `jemaat_id_sidi`(`id_jemaat` ASC) USING BTREE,
  INDEX `gereja_sidi_id_sidi`(`id_registrasi_sidi` ASC) USING BTREE,
  INDEX `status_id_sidi`(`id_status` ASC) USING BTREE,
  INDEX `fk_id_gereja_sidi_sidi`(`id_gereja_sidi` ASC) USING BTREE,
  CONSTRAINT `fk_id_gereja_sidi_sidi` FOREIGN KEY (`id_gereja_sidi`) REFERENCES `gereja` (`id_gereja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_jemaat_sidi` FOREIGN KEY (`id_jemaat`) REFERENCES `jemaat` (`id_jemaat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_status_sidi` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_registrasi_sidi_sidi` FOREIGN KEY (`id_registrasi_sidi`) REFERENCES `registrasi_sidi` (`id_registrasi_sidi`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sidi
-- ----------------------------

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_jenis_status` int NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_status`) USING BTREE,
  INDEX `jenis_status_id_status`(`id_jenis_status` ASC) USING BTREE,
  CONSTRAINT `fk_id_jenis_status_status` FOREIGN KEY (`id_jenis_status`) REFERENCES `jenis_status` (`id_jenis_status`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, '0', 1, 'Not Approved', '2023-04-23 09:29:45', NULL, 0);
INSERT INTO `status` VALUES (2, '1', 1, 'Approved', '2023-04-23 09:30:12', NULL, 0);
INSERT INTO `status` VALUES (3, '0', 2, 'Belum Menikah', '2023-05-10 15:51:25', NULL, 0);
INSERT INTO `status` VALUES (4, '1', 2, 'Sudah Menikah', '2023-05-10 15:51:34', NULL, 0);
INSERT INTO `status` VALUES (5, '0', 3, 'Jemaat Tidak Aktif', '2023-05-17 10:33:21', NULL, 0);
INSERT INTO `status` VALUES (6, '1', 3, 'Jemaat Aktif', '2023-05-17 10:33:21', NULL, 0);
INSERT INTO `status` VALUES (7, '1', 4, 'Jemaat Meninggal', '2023-05-17 10:33:21', NULL, 0);
INSERT INTO `status` VALUES (8, '1', 5, 'Jemaat Pindah', '2023-05-17 10:33:21', NULL, 0);
INSERT INTO `status` VALUES (9, '1', 6, 'Jemaat Rpp', '2023-05-17 10:33:21', NULL, 0);
INSERT INTO `status` VALUES (10, '0', 7, 'Majelis Tidak Aktif', '2023-05-17 10:33:21', NULL, 0);
INSERT INTO `status` VALUES (11, '1', 7, 'Majelis Aktif', '2023-05-17 10:33:21', NULL, 0);
INSERT INTO `status` VALUES (12, '0102', 8, '0102', '2024-04-01 11:56:23', NULL, 0);
INSERT INTO `status` VALUES (13, '0103', 8, '0103', '2024-04-01 12:02:54', NULL, 0);
INSERT INTO `status` VALUES (14, '0104', 8, '0104', '2024-04-01 12:04:48', '2024-04-03 09:46:04', 1);
INSERT INTO `status` VALUES (15, '010506', 21, '010506', '2024-04-01 16:35:04', '2024-04-03 09:45:02', 1);

-- ----------------------------
-- Table structure for wijk
-- ----------------------------
DROP TABLE IF EXISTS `wijk`;
CREATE TABLE `wijk`  (
  `id_wijk` int NOT NULL AUTO_INCREMENT,
  `nama_wijk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_wijk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of wijk
-- ----------------------------
INSERT INTO `wijk` VALUES (1, 'Wijk-1', 'Wijk Pertama', '2023-05-08 20:55:50', NULL, 0);
INSERT INTO `wijk` VALUES (2, 'Wijk-2', 'Wijk Kedua', '2023-05-09 17:36:39', NULL, 0);
INSERT INTO `wijk` VALUES (3, 'Wijk-3', 'Wijk Ketiga', '2023-05-09 17:36:48', NULL, 0);
INSERT INTO `wijk` VALUES (4, 'Wijk-4', 'Wijk Keempat', '2023-05-09 17:37:07', NULL, 0);
INSERT INTO `wijk` VALUES (5, 'Wijk-5', 'Wijk Kelima', '2023-05-09 17:37:14', NULL, 0);
INSERT INTO `wijk` VALUES (6, 'Wijk-6', 'Wijk Keenam', '2023-05-09 17:37:25', NULL, 0);
INSERT INTO `wijk` VALUES (7, 'Wijk-7', 'Wijk Ketujuh', '2023-05-09 17:38:25', NULL, 0);
INSERT INTO `wijk` VALUES (8, 'Wijk-8', 'Wijk Kedelapan', '2023-05-09 17:38:38', NULL, 0);

-- ----------------------------
-- Procedure structure for cbo_JenisStatus
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_JenisStatus`;
delimiter ;;
CREATE PROCEDURE `cbo_JenisStatus`()
BEGIN
	#Routine body goes here...
	SELECT
		jenis_status.id_jenis_status, 
		jenis_status.jenis_status
	FROM
		jenis_status
	WHERE
		jenis_status.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_bidangPendidikan
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_bidangPendidikan`;
delimiter ;;
CREATE PROCEDURE `delete_bidangPendidikan`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE bidang_pendidikan SET bidang_pendidikan.isDeleted = 1, bidang_pendidikan.updateAt = NOW()
	WHERE bidang_pendidikan.id_bidang_pendidikan = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jenisStatus
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jenisStatus`;
delimiter ;;
CREATE PROCEDURE `delete_jenisStatus`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE jenis_status SET jenis_status.isDeleted = 1, jenis_status.updateAt = NOW()
	WHERE jenis_status.id_jenis_status = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_status
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_status`;
delimiter ;;
CREATE PROCEDURE `delete_status`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE `status` SET `status`.isDeleted = 1, `status`.updateAt=NOW()
	WHERE `status`.id_status=id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_bidangPendidikan
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_bidangPendidikan`;
delimiter ;;
CREATE PROCEDURE `insert_bidangPendidikan`(IN `dataBidangPendidikan` JSON)
BEGIN
	#Routine body goes here...
	SET @bidangPendidikan= JSON_UNQUOTE(JSON_EXTRACT(dataBidangPendidikan,'$.BidangPendidikan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataBidangPendidikan,'$.Keterangan'));

	INSERT INTO bidang_pendidikan(bidang_pendidikan.nama_bidang_pendidikan, bidang_pendidikan.keterangan)
	VALUES(@bidangPendidikan, @keterangan);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jenisStatus
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jenisStatus`;
delimiter ;;
CREATE PROCEDURE `insert_jenisStatus`(IN `dataJenisStatus` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisStatus = JSON_UNQUOTE(JSON_EXTRACT(dataJenisStatus,'$.JenisStatus'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisStatus,'$.Keterangan'));

	INSERT INTO jenis_status(jenis_status.jenis_status, jenis_status.keterangan)
	VALUES(@jenisStatus, @keterangan);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_status
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_status`;
delimiter ;;
CREATE PROCEDURE `insert_status`(IN `dataStatus` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisStatus = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.JenisStatus'));
	SET @namaStatus = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.Status'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.Keterangan'));
	
	INSERT INTO `status`(`status`.`status`, `status`.id_jenis_status, `status`.keterangan)
	VALUES(@namaStatus, @jenisStatus, @keterangan);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_bidangPendidikan
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_bidangPendidikan`;
delimiter ;;
CREATE PROCEDURE `update_bidangPendidikan`(IN `dataBidangPendidikan` JSON)
BEGIN
	#Routine body goes here...
	SET @idBidangPendidikan= JSON_UNQUOTE(JSON_EXTRACT(dataBidangPendidikan,'$.IdBidangPendidikan'));
	SET @bidangPendidikan= JSON_UNQUOTE(JSON_EXTRACT(dataBidangPendidikan,'$.BidangPendidikan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataBidangPendidikan,'$.Keterangan'));

	UPDATE bidang_pendidikan SET nama_bidang_pendidikan = @bidangPendidikan, bidang_pendidikan.keterangan = @keterangan, bidang_pendidikan.updateAt=NOW()
	WHERE id_bidang_pendidikan = @idBidangPendidikan;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jenisStatus
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jenisStatus`;
delimiter ;;
CREATE PROCEDURE `update_jenisStatus`(IN `dataJenisStatus` JSON)
BEGIN
	#Routine body goes here...
	SET @idJenisStatus= JSON_UNQUOTE(JSON_EXTRACT(dataJenisStatus,'$.IdJenisStatus'));
	SET @jenisStatus= JSON_UNQUOTE(JSON_EXTRACT(dataJenisStatus,'$.JenisStatus'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisStatus,'$.Keterangan'));

	UPDATE jenis_status SET jenis_status.jenis_status = @jenisStatus, jenis_status.keterangan = @keterangan, jenis_status.updateAt = NOW()
	WHERE jenis_status.id_jenis_status = @idJenisStatus;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_status
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_status`;
delimiter ;;
CREATE PROCEDURE `update_status`(IN `dataStatus` JSON)
BEGIN
	#Routine body goes here...
	SET @idStatus = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.IdStatus'));
	SET @jenisStatus = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.JenisStatus'));
	SET @namaStatus = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.Status'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.Keterangan'));
	
	UPDATE `status` SET `status`.`status`=@namaStatus, `status`.id_jenis_status=@jenisStatus, `status`.keterangan=@keterangan, `status`.updateAt=NOW()
	WHERE `status`.id_status=@idStatus;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_BidangPendidikan
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_BidangPendidikan`;
delimiter ;;
CREATE PROCEDURE `viewAll_BidangPendidikan`()
BEGIN
	#Routine body goes here...
SELECT
	bidang_pendidikan.id_bidang_pendidikan, 
	bidang_pendidikan.nama_bidang_pendidikan, 
	bidang_pendidikan.keterangan
FROM
	bidang_pendidikan
WHERE
	bidang_pendidikan.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_JenisStatus
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_JenisStatus`;
delimiter ;;
CREATE PROCEDURE `viewAll_JenisStatus`()
BEGIN
	#Routine body goes here...
SELECT
	jenis_status.id_jenis_status, 
	jenis_status.jenis_status, 
	jenis_status.keterangan
FROM
	jenis_status
WHERE
	jenis_status.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_Pendidikan
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_Pendidikan`;
delimiter ;;
CREATE PROCEDURE `viewAll_Pendidikan`()
BEGIN
	#Routine body goes here...
	SELECT
		pendidikan.id_pendidikan, 
		pendidikan.pendidikan, 
		pendidikan.keterangan
	FROM
		pendidikan
	WHERE
		pendidikan.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_status
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_status`;
delimiter ;;
CREATE PROCEDURE `viewAll_status`()
BEGIN
	#Routine body goes here...
SELECT
	`status`.id_status, 
	jenis_status.jenis_status, 
	`status`.`status`, 
	`status`.keterangan
FROM
	jenis_status
	INNER JOIN
	`status`
	ON 
		jenis_status.id_jenis_status = `status`.id_jenis_status
WHERE
	`status`.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_BidangPendidikan_byId
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_BidangPendidikan_byId`;
delimiter ;;
CREATE PROCEDURE `view_BidangPendidikan_byId`(IN id INT)
BEGIN
	#Routine body goes here...
SELECT
	bidang_pendidikan.id_bidang_pendidikan, 
	bidang_pendidikan.nama_bidang_pendidikan, 
	bidang_pendidikan.keterangan
FROM
	bidang_pendidikan
WHERE
	bidang_pendidikan.id_bidang_pendidikan = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jenisStatusById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jenisStatusById`;
delimiter ;;
CREATE PROCEDURE `view_jenisStatusById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jenis_status.id_jenis_status, 
	jenis_status.jenis_status, 
	jenis_status.keterangan
FROM
	jenis_status
WHERE
	jenis_status.id_jenis_status = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_statusById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_statusById`;
delimiter ;;
CREATE PROCEDURE `view_statusById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	`status`.id_status, 
	`status`.`status`, 
	`status`.id_jenis_status, 
	jenis_status.jenis_status, 
	`status`.keterangan
FROM
	`status`
	INNER JOIN
	jenis_status
	ON 
		`status`.id_jenis_status = jenis_status.id_jenis_status
WHERE
	`status`.id_status = id;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
