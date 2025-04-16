/*
 Navicat Premium Data Transfer

 Source Server         : local_mysql8.0
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_tapatupa

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 29/03/2025 20:44:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jenisuser
-- ----------------------------
DROP TABLE IF EXISTS `jenisuser`;
CREATE TABLE `jenisuser`  (
  `idJenisUser` int NOT NULL AUTO_INCREMENT,
  `jenisUser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT '',
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`idJenisUser`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenisuser
-- ----------------------------
INSERT INTO `jenisuser` VALUES (1, 'Pegawai', 'User untuk pegawai Pemerintah Daerah', '2024-09-25 03:41:27', NULL, 0);
INSERT INTO `jenisuser` VALUES (2, 'Wajib Retribusi', 'User untuk wajib retribusi', '2024-09-25 03:42:17', NULL, 0);

SET FOREIGN_KEY_CHECKS = 1;
