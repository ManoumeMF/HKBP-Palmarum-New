/*
 Navicat Premium Data Transfer

 Source Server         : mysql_hostingerNew
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : 157.173.218.181:3306
 Source Schema         : db_tapatupa

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 19/09/2024 10:30:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_09_19_030806_create_permission_tables', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `idJenisUser` int NOT NULL,
  `idPersonal` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Procedure structure for cbo_bidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_bidang`;
delimiter ;;
CREATE PROCEDURE `cbo_bidang`()
BEGIN
    SELECT
        bidang.idBidang, 
        bidang.namaBidang
    FROM
        bidang
    WHERE
        bidang.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_cities
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_cities`;
delimiter ;;
CREATE PROCEDURE `cbo_cities`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	cities.city_id, 
	cities.city_name
FROM
	cities
WHERE
	cities.prov_id = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_departemen
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_departemen`;
delimiter ;;
CREATE PROCEDURE `cbo_departemen`()
BEGIN
	#Routine body goes here...
SELECT
	departemen.idDepartemen, 
	departemen.namaDepartmen
FROM
	departemen
WHERE
	departemen.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_districts
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_districts`;
delimiter ;;
CREATE PROCEDURE `cbo_districts`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	districts.dis_id, 
	districts.dis_name
FROM
	districts
WHERE
	districts.city_id = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_dokumenKelengkapan
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_dokumenKelengkapan`;
delimiter ;;
CREATE PROCEDURE `cbo_dokumenKelengkapan`(IN `id` int)
BEGIN
	#Routine body goes here...
	SELECT
	dokumenkelengkapan.idDokumenKelengkapan, 
	dokumenkelengkapan.dokumenKelengkapan
FROM
	dokumenkelengkapan
WHERE
	dokumenkelengkapan.idJenisDokumen = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_golonganPangkat
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_golonganPangkat`;
delimiter ;;
CREATE PROCEDURE `cbo_golonganPangkat`()
BEGIN
	#Routine body goes here...
	SELECT
	golonganPangkat.idGolonganPangkat, 
	golonganPangkat.golongan, 
	golonganPangkat.pangkat
FROM
	golonganPangkat
WHERE
	golonganPangkat.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_jabatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_jabatan`;
delimiter ;;
CREATE PROCEDURE `cbo_jabatan`()
BEGIN
    SELECT
        jabatan.idJabatan, 
        jabatan.jabatan
    FROM
        jabatan
    WHERE
        jabatan.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_jabatanBidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_jabatanBidang`;
delimiter ;;
CREATE PROCEDURE `cbo_jabatanBidang`()
BEGIN
	#Routine body goes here...
SELECT
	jabatanBidang.idJabatanBidang, 
	jabatanBidang.namaJabatanBidang
FROM
	jabatanBidang
WHERE
	jabatanBidang.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_jangkaWaktu
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_jangkaWaktu`;
delimiter ;;
CREATE PROCEDURE `cbo_jangkaWaktu`()
BEGIN
	#Routine body goes here...
	SELECT
	jangkawaktusewa.idJangkaWaktuSewa, 
	jangkawaktusewa.jangkaWaktu
FROM
	jangkawaktusewa
WHERE
	jangkawaktusewa.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_jenisDokumen
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_jenisDokumen`;
delimiter ;;
CREATE PROCEDURE `cbo_jenisDokumen`()
BEGIN
    -- Routine body goes here...
    SELECT
        jenisdokumen.idJenisDokumen,
        jenisdokumen.jenisDokumen
    FROM
        jenisdokumen
    WHERE
        jenisdokumen.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_jenisJangkaWaktu
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_jenisJangkaWaktu`;
delimiter ;;
CREATE PROCEDURE `cbo_jenisJangkaWaktu`()
BEGIN
	#Routine body goes here...
	SELECT
		jenisjangkawaktu.idjenisJangkaWaktu,
		jenisjangkawaktu.jenisJangkaWaktu
	FROM
		jenisjangkawaktu
	WHERE
		jenisjangkawaktu.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_jenisKegiatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_jenisKegiatan`;
delimiter ;;
CREATE PROCEDURE `cbo_jenisKegiatan`()
BEGIN
	#Routine body goes here...
	SELECT
		jeniskegiatan.idjenisKegiatan,
		jeniskegiatan.jenisKegiatan
	FROM
		jeniskegiatan
	WHERE
		jeniskegiatan.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_jenisObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_jenisObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `cbo_jenisObjekRetribusi`()
BEGIN
	#Routine body goes here...
	SELECT
		jenisobjekretribusi.idJenisObjekRetribusi,
		jenisobjekretribusi.jenisObjekRetribusi
	FROM
		jenisobjekretribusi
	WHERE
		jenisobjekretribusi.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_jenisPermohonan
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_jenisPermohonan`;
delimiter ;;
CREATE PROCEDURE `cbo_jenisPermohonan`()
BEGIN
SELECT
	jenispermohonan.idJenisPermohonan, 
	jenispermohonan.jenisPermohonan
FROM
	jenispermohonan
WHERE
	jenispermohonan.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_JenisStatus
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_JenisStatus`;
delimiter ;;
CREATE PROCEDURE `cbo_JenisStatus`()
BEGIN
	#Routine body goes here...
	SELECT
		jenisstatus.idJenisStatus,
		jenisstatus.jenisStatus
	FROM
		jenisstatus
	WHERE
		jenisstatus.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_jenisUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_jenisUser`;
delimiter ;;
CREATE PROCEDURE `cbo_jenisUser`()
BEGIN
	#Routine body goes here...
SELECT
	jenisUser.idJenisUser, 
	jenisUser.jenisUser
FROM
	jenisUser
WHERE
	jenisUser.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_JenisWajibRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_JenisWajibRetribusi`;
delimiter ;;
CREATE PROCEDURE `cbo_JenisWajibRetribusi`()
BEGIN
	#Routine body goes here...
	SELECT
	jenisWajibRetribusi.idJenisWajibRetribusi, 
	jenisWajibRetribusi.namaJenisWajibRetribusi
FROM
	jenisWajibRetribusi
WHERE
	jenisWajibRetribusi.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_lokasiObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_lokasiObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `cbo_lokasiObjekRetribusi`()
BEGIN
	#Routine body goes here...
SELECT
		lokasiobjekretribusi.idLokasiObjekRetribusi,
		lokasiobjekretribusi.lokasiobjekretribusi
	FROM
		lokasiobjekretribusi
	WHERE
		lokasiobjekretribusi.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_objekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_objekRetribusi`;
delimiter ;;
CREATE PROCEDURE `cbo_objekRetribusi`()
BEGIN
	#Routine body goes here...
	SELECT
	objekretribusi.idObjekRetribusi, 
	objekretribusi.kodeObjekRetribusi, 
	objekretribusi.objekRetribusi
FROM
	objekretribusi
WHERE
	objekretribusi.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_objekRetribusiTarif
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_objekRetribusiTarif`;
delimiter ;;
CREATE PROCEDURE `cbo_objekRetribusiTarif`()
BEGIN
	#Routine body goes here...
	SELECT
	objekretribusi.idObjekRetribusi, 
	objekretribusi.kodeObjekRetribusi, 
	objekretribusi.objekRetribusi
FROM
	objekretribusi
WHERE
	objekretribusi.idObjekRetribusi NOT IN (SELECT tarifobjekretribusi.idObjekRetribusi FROM tarifobjekretribusi) AND objekretribusi.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_pegawai
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_pegawai`;
delimiter ;;
CREATE PROCEDURE `cbo_pegawai`()
BEGIN
	#Routine body goes here...
SELECT
	pegawai.idPegawai, 
	jabatanBidang.namaJabatanBidang, 
	pegawai.namaPegawai
FROM
	pegawai
	INNER JOIN
	jabatanBidang
	ON 
		pegawai.idJabatanBidang = jabatanBidang.idJabatanBidang;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_pekerjaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_pekerjaan`;
delimiter ;;
CREATE PROCEDURE `cbo_pekerjaan`()
BEGIN
	#Routine body goes here...
SELECT
	pekerjaan.idPekerjaan, 
	pekerjaan.namaPekerjaan
FROM
	pekerjaan
WHERE
	pekerjaan.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_permohonanPerjanjianSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_permohonanPerjanjianSewa`;
delimiter ;;
CREATE PROCEDURE `cbo_permohonanPerjanjianSewa`()
BEGIN
	#Routine body goes here...
SELECT
	permohonansewa.idPermohonanSewa, 
	permohonansewa.nomorSuratPermohonan, 
	objekretribusi.objekRetribusi
FROM
	permohonansewa
	INNER JOIN
	objekretribusi
	ON 
		permohonansewa.idObjekRetribusi = objekretribusi.idObjekRetribusi
WHERE
	permohonansewa.idPermohonanSewa NOT IN (SELECT perjanjianSewa.idPermohonan FROM perjanjianSewa) AND permohonansewa.idStatus=4;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_peruntukanSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_peruntukanSewa`;
delimiter ;;
CREATE PROCEDURE `cbo_peruntukanSewa`()
BEGIN
	#Routine body goes here...
	SELECT
	peruntukansewa.idperuntukanSewa, 
	peruntukansewa.peruntukanSewa
FROM
	peruntukansewa
WHERE
	peruntukansewa.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_province
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_province`;
delimiter ;;
CREATE PROCEDURE `cbo_province`()
BEGIN
	#Routine body goes here...
SELECT
	provinces.prov_id, 
	provinces.prov_name
FROM
	provinces;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_satuan
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_satuan`;
delimiter ;;
CREATE PROCEDURE `cbo_satuan`(IN `idJenis` int)
BEGIN
	#Routine body goes here...
SELECT
	satuan.idSatuan, 
	satuan.namaSatuan
FROM
	satuan
WHERE
	satuan.idJenisSatuan = idJenis AND
	satuan.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_subdistricts
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_subdistricts`;
delimiter ;;
CREATE PROCEDURE `cbo_subdistricts`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	subdistricts.subdis_id, 
	subdistricts.subdis_name
FROM
	subdistricts
WHERE
	subdistricts.dis_id = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_userRole
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_userRole`;
delimiter ;;
CREATE PROCEDURE `cbo_userRole`()
BEGIN
	#Routine body goes here...
SELECT
	userRole.idUserRole, 
	userRole.userRole
FROM
	userRole
WHERE
	userRole.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for cbo_wajibRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `cbo_wajibRetribusi`;
delimiter ;;
CREATE PROCEDURE `cbo_wajibRetribusi`()
BEGIN
	#Routine body goes here...
	SELECT
	wajibretribusi.idWajibRetribusi, 
	wajibretribusi.namaWajibRetribusi
FROM
	wajibretribusi
WHERE
	wajibretribusi.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_bidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_bidang`;
delimiter ;;
CREATE PROCEDURE `delete_bidang`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE bidang SET bidang.isDeleted = 1, bidang.updateAt = NOW()
	WHERE bidang.idBidang = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_departemen
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_departemen`;
delimiter ;;
CREATE PROCEDURE `delete_departemen`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE departemen SET departemen.isDeleted = 1, departemen.updateAt = NOW()
	WHERE departemen.idDepartemen = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_dokumenKelengkapan
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_dokumenKelengkapan`;
delimiter ;;
CREATE PROCEDURE `delete_dokumenKelengkapan`(IN `id` INT)
BEGIN
	UPDATE dokumenkelengkapan 
	SET dokumenkelengkapan.isDeleted = 1, dokumenkelengkapan.updateAt = NOW()
	WHERE dokumenkelengkapan.idDokumenKelengkapan = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jabatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jabatan`;
delimiter ;;
CREATE PROCEDURE `delete_jabatan`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE jabatan SET jabatan.isDeleted = 1, jabatan.updateAt = NOW()
	WHERE jabatan.idJabatan = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jabatanBidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jabatanBidang`;
delimiter ;;
CREATE PROCEDURE `delete_jabatanBidang`(IN `id` int)
BEGIN
    UPDATE jabatanBidang 
    SET 
        jabatanBidang.isDeleted = 1, 
        jabatanBidang.updateAt = NOW()
    WHERE 
        jabatanBidang.idJabatanBidang = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jangkaWaktuSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jangkaWaktuSewa`;
delimiter ;;
CREATE PROCEDURE `delete_jangkaWaktuSewa`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE jangkawaktusewa SET jangkawaktusewa.isDeleted = 1, jangkawaktusewa.updateAt = NOW()
	WHERE jangkawaktusewa.idJangkaWaktuSewa = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jenisDokumen
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jenisDokumen`;
delimiter ;;
CREATE PROCEDURE `delete_jenisDokumen`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE jenisdokumen SET jenisdokumen.isDeleted = 1, jenisdokumen.updateAt = NOW()
	WHERE jenisdokumen.idJenisDokumen = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jenisJangkaWaktu
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jenisJangkaWaktu`;
delimiter ;;
CREATE PROCEDURE `delete_jenisJangkaWaktu`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE jenisjangkawaktu SET jenisjangkawaktu.isDeleted = 1, jenisjangkawaktu.updateAt = NOW()
	WHERE jenisjangkawaktu.idJenisJangkaWaktu = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jenisKegiatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jenisKegiatan`;
delimiter ;;
CREATE PROCEDURE `delete_jenisKegiatan`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE jeniskegiatan SET jeniskegiatan.isDeleted = 1, jeniskegiatan.updateAt = NOW()
	WHERE jeniskegiatan.idjenisKegiatan = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jenisObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jenisObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `delete_jenisObjekRetribusi`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE jenisobjekretribusi SET jenisobjekretribusi.isDeleted = 1, jenisobjekretribusi.updateAt = NOW()
	WHERE jenisobjekretribusi.idJenisObjekRetribusi = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jenisPermohonan
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jenisPermohonan`;
delimiter ;;
CREATE PROCEDURE `delete_jenisPermohonan`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE jenispermohonan SET jenispermohonan.isDeleted = 1, jenispermohonan.updateAt = NOW()
	WHERE jenispermohonan.idJenisPermohonan = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jenisRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jenisRetribusi`;
delimiter ;;
CREATE PROCEDURE `delete_jenisRetribusi`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE JenisRetribusi SET JenisRetribusi.isDeleted = 1, JenisRetribusi.updateAt = NOW()
	WHERE JenisRetribusi.idJenisRetribusi = id;

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
	UPDATE jenisstatus SET jenisstatus.isDeleted = 1, jenisstatus.updateAt = NOW()
	WHERE jenisstatus.idJenisStatus = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_jenisUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_jenisUser`;
delimiter ;;
CREATE PROCEDURE `delete_jenisUser`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE jenisUser SET jenisUser.isDeleted = 1, jenisUser.updateAt = NOW()
	WHERE jenisUser.idJenisUser = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_lokasiObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_lokasiObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `delete_lokasiObjekRetribusi`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE lokasiobjekretribusi SET lokasiobjekretribusi.isDeleted = 1, lokasiobjekretribusi.updateAt = NOW()
	WHERE lokasiobjekretribusi.idLokasiObjekRetribusi = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_objekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_objekRetribusi`;
delimiter ;;
CREATE PROCEDURE `delete_objekRetribusi`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE objekretribusi SET objekretribusi.isDeleted = 1, objekretribusi.updateAt = NOW()
	WHERE objekretribusi.idObjekRetribusi = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_pegawai
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_pegawai`;
delimiter ;;
CREATE PROCEDURE `delete_pegawai`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE pegawai SET pegawai.isDeleted = 1, pegawai.updateAt = NOW()
	WHERE pegawai.idPegawai = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_pekerjaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_pekerjaan`;
delimiter ;;
CREATE PROCEDURE `delete_pekerjaan`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE pekerjaan SET pekerjaan.isDeleted = 1, pekerjaan.updateAt = NOW()
	WHERE pekerjaan.idPekerjaan = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_peruntukanSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_peruntukanSewa`;
delimiter ;;
CREATE PROCEDURE `delete_peruntukanSewa`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE peruntukansewa SET peruntukansewa.isDeleted = 1, peruntukansewa.updateAt = NOW()
	WHERE peruntukansewa.idperuntukanSewa = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_photoObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_photoObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `delete_photoObjekRetribusi`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE photoobjekretribusi SET photoobjekretribusi.isDeleted = 1, photoobjekretribusi.updateAt = NOW()
	WHERE photoobjekretribusi.idObjekRetribusi = id;

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
	WHERE `status`.idStatus=id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_tarifObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_tarifObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `delete_tarifObjekRetribusi`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE tarifobjekretribusi SET tarifobjekretribusi.isDeleted = 1, tarifobjekretribusi.updateAt = NOW()
	WHERE tarifobjekretribusi.idTarifObjekRetribusi = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_user`;
delimiter ;;
CREATE PROCEDURE `delete_user`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE `user` SET `user`.isDeleted = 1, `user`.updateAt = NOW()
	WHERE `user`.userId = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_wajibRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_wajibRetribusi`;
delimiter ;;
CREATE PROCEDURE `delete_wajibRetribusi`(IN `id` int)
BEGIN
	#Routine body goes here...
	UPDATE wajibretribusi SET wajibretribusi.isDeleted = 1, wajibretribusi.updateAt = NOW()
	WHERE wajibretribusi.idWajibRetribusi = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_bidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_bidang`;
delimiter ;;
CREATE PROCEDURE `insert_bidang`(IN `dataBidang` JSON)
BEGIN
	#Routine body goes here...
	SET @departemen = JSON_UNQUOTE(JSON_EXTRACT(dataBidang,'$.IdDepartemen'));
	SET @parentBidang = JSON_UNQUOTE(JSON_EXTRACT(dataBidang,'$.ParentBidang'));
	SET @namaBidang = JSON_UNQUOTE(JSON_EXTRACT(dataBidang,'$.NamaBidang'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataBidang,'$.Keterangan'));

	INSERT INTO bidang(bidang.idDepartemen, bidang.parentBidang, bidang.namaBidang, bidang.keterangan)
	VALUES(@departemen, @parentBidang,@namaBidang, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_departemen
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_departemen`;
delimiter ;;
CREATE PROCEDURE `insert_departemen`(IN `dataDepartemen` JSON)
BEGIN
	#Routine body goes here...
	SET @namaDepartmen = JSON_UNQUOTE(JSON_EXTRACT(dataDepartemen,'$.NamaDepartmen'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataDepartemen,'$.Keterangan'));

	INSERT INTO departemen(departemen.namaDepartmen, departemen.keterangan)
	VALUES(@namaDepartmen, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_dokumenKelengkapan
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_dokumenKelengkapan`;
delimiter ;;
CREATE PROCEDURE `insert_dokumenKelengkapan`(IN `dataDokumenKelengkapan` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisdokumen = JSON_UNQUOTE(JSON_EXTRACT(dataDokumenKelengkapan,'$.JenisDokumen'));
	SET @dokumenkelengkapan = JSON_UNQUOTE(JSON_EXTRACT(dataDokumenKelengkapan,'$.DokumenKelengkapan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataDokumenKelengkapan,'$.Keterangan'));

	INSERT INTO dokumenkelengkapan(dokumenkelengkapan.idJenisDokumen, dokumenkelengkapan.dokumenKelengkapan, dokumenkelengkapan.keterangan)
	VALUES(@jenisDokumen, @dokumenkelengkapan, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jabatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jabatan`;
delimiter ;;
CREATE PROCEDURE `insert_jabatan`(IN `dataJabatan` JSON)
BEGIN
	#Routine body goes here...
	SET @jabatan = JSON_UNQUOTE(JSON_EXTRACT(dataJabatan,'$.Jabatan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJabatan,'$.Keterangan'));

	INSERT INTO jabatan(jabatan.jabatan, jabatan.keterangan)
	VALUES(@jabatan, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jabatanBidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jabatanBidang`;
delimiter ;;
CREATE PROCEDURE `insert_jabatanBidang`(IN `dataJabatanBidang` JSON)
BEGIN
    # Mengambil data dari JSON input
    SET @jabatan = JSON_UNQUOTE(JSON_EXTRACT(dataJabatanBidang,'$.IdJabatan'));
    SET @bidang = JSON_UNQUOTE(JSON_EXTRACT(dataJabatanBidang,'$.IdBidang'));
    SET @namaJabatanBidang = JSON_UNQUOTE(JSON_EXTRACT(dataJabatanBidang,'$.NamaJabatanBidang'));
    SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJabatanBidang,'$.Keterangan'));

    # Melakukan insert ke tabel jabatanBidang
    INSERT INTO jabatanBidang(jabatanBidang.idJabatan, jabatanBidang.idBidang, jabatanBidang.namaJabatanBidang, jabatanBidang.keterangan)
    VALUES(@jabatan, @bidang, @namaJabatanBidang, @keterangan);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jangkaWaktuSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jangkaWaktuSewa`;
delimiter ;;
CREATE PROCEDURE `insert_jangkaWaktuSewa`(IN `dataJangkaWaktuSewa` JSON)
BEGIN
	#Routine body goes here...
	SET @JenisJangkaWaktu = JSON_UNQUOTE(JSON_EXTRACT(dataJangkaWaktuSewa,'$.JenisJangkaWaktu'));
	SET @jangkaWaktu = JSON_UNQUOTE(JSON_EXTRACT(dataJangkaWaktuSewa,'$.JangkaWaktu'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJangkaWaktuSewa,'$.Keterangan'));

	INSERT INTO jangkawaktusewa(jangkawaktusewa.idJenisJangkaWaktu, jangkawaktusewa.jangkaWaktu, jangkawaktusewa.keterangan)
	VALUES(@JenisJangkaWaktu, @jangkaWaktu, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jenisDokumen
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jenisDokumen`;
delimiter ;;
CREATE PROCEDURE `insert_jenisDokumen`(IN `dataJenisDokumen` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisDokumen = JSON_UNQUOTE(JSON_EXTRACT(dataJenisDokumen,'$.JenisDokumen'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisDokumen,'$.Keterangan'));

	INSERT INTO jenisdokumen(jenisdokumen.jenisDokumen, jenisdokumen.keterangan)
	VALUES(@jenisDokumen, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jenisJangkaWaktu
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jenisJangkaWaktu`;
delimiter ;;
CREATE PROCEDURE `insert_jenisJangkaWaktu`(IN `dataJenisJangkaWaktu` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisJangkaWaktu = JSON_UNQUOTE(JSON_EXTRACT(dataJenisJangkaWaktu,'$.JenisJangkaWaktu'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisJangkaWaktu,'$.Keterangan'));

	INSERT INTO jenisjangkawaktu(jenisjangkawaktu.jenisJangkaWaktu, jenisjangkawaktu.keterangan)
	VALUES(@jenisJangkaWaktu, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jenisKegiatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jenisKegiatan`;
delimiter ;;
CREATE PROCEDURE `insert_jenisKegiatan`(IN `dataJenisKegiatan` JSON)
BEGIN
	#Routine body goes here...
	SET @jeniskegiatan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisKegiatan,'$.JenisKegiatan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisKegiatan,'$.Keterangan'));

	INSERT INTO jeniskegiatan(jeniskegiatan.jenisKegiatan, jeniskegiatan.keterangan)
	VALUES(@jeniskegiatan, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jenisObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jenisObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `insert_jenisObjekRetribusi`(IN `dataJenisObjekRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataJenisObjekRetribusi,'$.jenisObjekRetribusi'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisObjekRetribusi,'$.keterangan'));

	INSERT INTO jenisobjekretribusi(jenisobjekretribusi.jenisObjekRetribusi, jenisobjekretribusi.keterangan)
	VALUES(@jenisObjekRetribusi, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jenisPermohonan
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jenisPermohonan`;
delimiter ;;
CREATE PROCEDURE `insert_jenisPermohonan`(IN `dataJenisPermohonan` JSON)
BEGIN
	#Routine body goes here...
	SET @parentId = JSON_UNQUOTE(JSON_EXTRACT(dataJenisPermohonan,'$.ParentId'));
	SET @jenisPermohonan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisPermohonan,'$.JenisPermohonan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisPermohonan,'$.Keterangan'));

	INSERT INTO jenispermohonan(jenispermohonan.parentId, jenispermohonan.jenisPermohonan, jenispermohonan.keterangan)
	VALUES(@parentId, @jenisPermohonan, @keterangan);
	

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jenisRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jenisRetribusi`;
delimiter ;;
CREATE PROCEDURE `insert_jenisRetribusi`(IN `dataJenisRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataJenisRetribusi,'$.JenisRetribusi'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisRetribusi,'$.Keterangan'));

	INSERT INTO JenisRetribusi(JenisRetribusi.JenisRetribusi, JenisRetribusi.Keterangan)
	VALUES(@jenisRetribusi, @Keterangan);

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

	INSERT INTO jenisstatus(jenisstatus.jenisStatus, jenisstatus.keterangan)
	VALUES(@jenisStatus, @keterangan);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_jenisUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_jenisUser`;
delimiter ;;
CREATE PROCEDURE `insert_jenisUser`(IN `dataJenisUser` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisUser = JSON_UNQUOTE(JSON_EXTRACT(dataJenisUser,'$.JenisUser'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisUser,'$.Keterangan'));

	INSERT INTO jenisUser(jenisUser.jenisUser, jenisUser.keterangan)
	VALUES(@jenisUser, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_lokasiObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_lokasiObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `insert_lokasiObjekRetribusi`(IN `dataLokasiObjekRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @lokasiObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataLokasiObjekRetribusi,'$.LokasiObjekRetribusi'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataLokasiObjekRetribusi,'$.Keterangan'));

	INSERT INTO lokasiobjekretribusi(lokasiobjekretribusi.lokasiObjekRetribusi, lokasiobjekretribusi.keterangan)
	VALUES(@lokasiObjekRetribusi, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_objekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_objekRetribusi`;
delimiter ;;
CREATE PROCEDURE `insert_objekRetribusi`(IN `dataObjekRetribusi` JSON)
BEGIN
	DECLARE i INT DEFAULT 0;
	
	#Routine body goes here...
	SET @kodeObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.KodeObjekRetribusi'));
	SET @noBangunan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.NoBangunan'));
	SET @objekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.ObjekRetribusi'));
	SET @lokasiObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.IdLokasiObjekRetribusi'));
	SET @jenisObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.IdJenisObjekRetribusi'));
	SET @panjangTanah = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.PanjangTanah'));
	SET @lebarTanah = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.LebarTanah'));
	SET @luasTanah = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.LuasTanah'));
	SET @panjangBangunan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.PanjangBangunan'));
	SET @lebarBangunan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.LebarBangunan'));
	SET @luasBangunan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.LuasBangunan'));
	SET @subdis = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Subdis_Id'));
	SET @alamat = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Alamat'));
	SET @latitute = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Latitute'));
	SET @longitude = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Longitude'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Keterangan'));
	SET @jumlahLantai = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.JumlahLantai'));
	SET @kapasitas = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Kapasitas'));
	SET @batasUtara = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.BatasUtara'));
	SET @batasSelatan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.BatasSelatan'));
	SET @batasTimur = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.BatasTimur'));
	SET @batasBarat = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.BatasBarat'));
	SET @gambarDenahTanah = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.GambarDenahTanah'));
	SET @fotoObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.FotoObjekRetribusi'));
	
	INSERT INTO objekretribusi (objekretribusi.kodeObjekRetribusi, objekretribusi.noBangunan, objekretribusi.objekRetribusi, 
	objekretribusi.idLokasiObjekRetribusi, objekretribusi.idJenisObjekRetribusi, objekretribusi.panjangTanah, objekretribusi.lebarTanah, 
	objekretribusi.luasTanah, objekretribusi.panjangBangunan, objekretribusi.lebarBangunan, objekretribusi.luasBangunan, objekretribusi.subdis_id, 
	objekretribusi.alamat, objekretribusi.latitute, objekretribusi.longitude, objekretribusi.keterangan, objekretribusi.jumlahLantai, objekretribusi.kapasitas, 
	objekretribusi.batasUtara, objekretribusi.batasSelatan, objekretribusi.batasTimur, objekretribusi.batasBarat, objekretribusi.gambarDenahTanah)
	VALUES(@kodeObjekRetribusi, @noBangunan, @objekRetribusi, @lokasiObjekRetribusi, @jenisObjekRetribusi, @panjangTanah, @lebarTanah, @luasTanah, @panjangBangunan, 
	@lebarBangunan, @luasBangunan, @subdis, @alamat, @latitute, @longitude, @keterangan, @jumlahLantai, @kapasitas, @batasUtara, @batasSelatan, @batasTimur, @batasBarat, @gambarDenahTanah);
	
	-- Retrieve inserted id to reuse it in objek retribusi detail
  SET @last_id = LAST_INSERT_ID();
	
	-- Get fotoObjekRetribusi length for the loop
  SET @fotoObjekRetribusi_length = JSON_LENGTH(@fotoObjekRetribusi);
	
	-- Execute loop over tags length
  WHILE i < @fotoObjekRetribusi_length DO
	
		-- Retrieve current foto Objek Retribusi from fotoObjekRetribusi array
		
		SET @namaPhotoObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi, CONCAT('$.FotoObjekRetribusi[',i,'].NamaFoto')));
		SET @photoObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi, CONCAT('$.FotoObjekRetribusi[',i,'].FileFoto')));
		SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi, CONCAT('$.FotoObjekRetribusi[',i,'].KeteranganFoto')));

		INSERT INTO photoobjekretribusi(photoobjekretribusi.idObjekRetribusi, photoobjekretribusi.namaPhotoObjekRetribusi, photoobjekretribusi.photoObjekRetribusi, photoobjekretribusi.keterangan)
		VALUES(@last_id, @namaPhotoObjekRetribusi, @photoObjekRetribusi, @keterangan);

		SELECT i + 1 INTO i;
  END WHILE;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_pegawai
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_pegawai`;
delimiter ;;
CREATE PROCEDURE `insert_pegawai`(IN `dataPegawai` JSON)
BEGIN
	#Routine body goes here...
	SET @nip = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.NIP'));
	SET @namaPegawai = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.NamaPegawai'));
	SET @golonganPangkat = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.GolonganPangkat'));
	SET @jabatanBidang = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.IdJabatanBidang'));
	SET @subdis = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.SubdisId'));
	SET @alamat = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.Alamat'));
	SET @nomorPonsel = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.NomorPonsel'));
	SET @nomorWhatsapp = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.NomorWhatsapp'));
	SET @fileFoto = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.FileFoto'));

	INSERT INTO pegawai(pegawai.nip, pegawai.namaPegawai, pegawai.idGolonganPangkat, pegawai.idJabatanBidang, pegawai.subdis_id, pegawai.alamat, 
	pegawai.nomorPonsel, pegawai.nomorWhatsapp, pegawai.fileFoto)
	VALUES(@nip, @namaPegawai, @golonganPangkat, @jabatanBidang, @subdis, @alamat, @nomorPonsel, @nomorWhatsapp, @fileFoto);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_pekerjaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_pekerjaan`;
delimiter ;;
CREATE PROCEDURE `insert_pekerjaan`(IN `dataPekerjaan` JSON)
BEGIN
	#Routine body goes here...
	SET @namaPekerjaan = JSON_UNQUOTE(JSON_EXTRACT(dataPekerjaan,'$.NamaPekerjaan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataPekerjaan,'$.Keterangan'));

	INSERT INTO pekerjaan(pekerjaan.namaPekerjaan, pekerjaan.keterangan)
	VALUES(@namaPekerjaan, @keterangan);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_perjanjianSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_perjanjianSewa`;
delimiter ;;
CREATE PROCEDURE `insert_perjanjianSewa`(IN `dataPerjanjianSewa` JSON)
BEGIN
	#Routine body goes here...
	DECLARE i INT DEFAULT 0;
	
	#Routine body goes here...
	SET @idPermohonan = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.IdPermohonan'));
	SET @noSuratPerjanjian = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.NoSuratPerjanjian'));
	SET @tanggalDisahkan = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.TanggalDisahkan'));
	SET @tanggalAwal = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.TanggalAwal'));
	SET @tanggalAkhir = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.TanggalAkhir'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.Keterangan'));
	SET @disahkanOleh = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.DisahkanOleh'));
	SET @fileSuratPerjanjian = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.FileSuratPerjanjian'));
	SET @stat = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.Status'));
	SET @createBy = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.CreateBy'));
	SET @saksiPerjanjianSewa = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa,'$.SaksiPerjanjianSewa'));
	
	INSERT INTO perjanjianSewa(perjanjianSewa.idPermohonan, perjanjianSewa.nomorSuratPerjanjian, perjanjianSewa.tanggalDisahkan, perjanjianSewa.tanggalAwalBerlaku,
	perjanjianSewa.tanggalAkhirBerlaku, perjanjianSewa.keterangan, perjanjianSewa.disahkanOleh, perjanjianSewa.fileSuratPerjanjian, perjanjianSewa.idStatus, perjanjianSewa.createBy)
	VALUES(@idPermohonan, @noSuratPerjanjian, STR_TO_DATE(@tanggalDisahkan, '%m/%d/%Y'), STR_TO_DATE(@tanggalAwal, '%m/%d/%Y'), STR_TO_DATE(@tanggalAkhir, '%m/%d/%Y'), @keterangan, @disahkanOleh, @fileSuratPerjanjian, @stat, @createBy);
	
	-- Retrieve inserted id to reuse it in objek retribusi detail
  SET @last_id = LAST_INSERT_ID();
	
	-- Get SaksiPerjanjian length for the loop
  SET @saksiPerjnajian_length = JSON_LENGTH(@saksiPerjanjianSewa);
	
	-- Execute loop over tags length
  WHILE i < @saksiPerjnajian_length DO
	
		-- Retrieve current saksi perjanjian sewa from saksiPerjanjianSewa array
		
		SET @nik = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa, CONCAT('$.SaksiPerjanjianSewa[',i,'].NIK')));
		SET @namaSaksi = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa, CONCAT('$.SaksiPerjanjianSewa[',i,'].NamaSaksi')));
		SET @keteranganSaksi = JSON_UNQUOTE(JSON_EXTRACT(dataPerjanjianSewa, CONCAT('$.SaksiPerjanjianSewa[',i,'].KeteranganSaksi')));

		INSERT INTO saksiPerjanjianSewa(saksiPerjanjianSewa.idPerjanjianSewa, saksiPerjanjianSewa.nik, saksiPerjanjianSewa.namaSaksi, saksiPerjanjianSewa.keterangan)
		VALUES(@last_id, @nik, @namaSaksi, @keteranganSaksi);

		SELECT i + 1 INTO i;
  END WHILE;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_permohonanSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_permohonanSewa`;
delimiter ;;
CREATE PROCEDURE `insert_permohonanSewa`(IN `dataPermohonan` JSON)
BEGIN
	DECLARE i INT DEFAULT 0;
	
	#Routine body goes here...
	SET @jenisPermohonan = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.JenisPermohonan'));
	SET @noSuratPermohonan = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.NoSuratPermohonan'));
	SET @wajibRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.WajibRetribusi'));
	SET @objekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.ObjekRetribusi'));
	SET @jenisJangkaWaktu = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.JenisJangkaWaktu'));
	SET @peruntukanSewa = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.PeruntukanSewa'));
	SET @lamaSewa = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.LamaSewa'));
	SET @satuan = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.Satuan'));
	SET @stat = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.Status'));
	SET @catatan = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.Catatan'));
	SET @dibuatOleh = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.DibuatOleh'));
	SET @dokumenKelengkapan = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan,'$.DokumenKelengkapan'));
	
	INSERT INTO permohonansewa(permohonansewa.idJenisPermohonan, permohonansewa.nomorSuratPermohonan, permohonansewa.idWajibRetribusi, 
	permohonansewa.idObjekRetribusi, permohonansewa.idjenisJangkaWaktu, permohonansewa.idPeruntukanSewa, permohonansewa.lamaSewa,
	permohonansewa.idSatuan, permohonansewa.idStatus, permohonansewa.catatan, permohonansewa.createBy)
	VALUES(@jenisPermohonan, @noSuratPermohonan, @wajibRetribusi, @objekRetribusi, @jenisJangkaWaktu, @peruntukanSewa, @lamaSewa, 
	@satuan, @stat, @catatan, @dibuatOleh);
	
	-- Retrieve inserted id to reuse it in objek retribusi detail
  SET @last_id = LAST_INSERT_ID();
	
	-- Get DokumenKelengkapan length for the loop
  SET @dokumenKelengkapan_length = JSON_LENGTH(@dokumenKelengkapan);
	
	-- Execute loop over tags length
  WHILE i < @dokumenKelengkapan_length DO
	
		-- Retrieve current foto Objek Retribusi from fotoObjekRetribusi array
		
		SET @jenisDokumen = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan, CONCAT('$.DokumenKelengkapan[',i,'].JenisDokumen')));
		SET @fileDokumen = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan, CONCAT('$.DokumenKelengkapan[',i,'].FileDokumen')));
		SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataPermohonan, CONCAT('$.DokumenKelengkapan[',i,'].KeteranganDokumen')));

		INSERT INTO dokumenpermohonansewa(dokumenpermohonansewa.idPermohonanSewa, dokumenpermohonansewa.idDokumenKelengkapan, 
		dokumenpermohonansewa.namaFileDokumen, dokumenpermohonansewa.keterangan)
		VALUES(@last_id, @jenisDokumen, @fileDokumen, @keterangan);

		SELECT i + 1 INTO i;
  END WHILE;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_peruntukanSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_peruntukanSewa`;
delimiter ;;
CREATE PROCEDURE `insert_peruntukanSewa`(IN `dataPeruntukanSewa` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisKegiatan = JSON_UNQUOTE(JSON_EXTRACT(dataPeruntukanSewa,'$.JenisKegiatan'));
	SET @peruntukanSewa = JSON_UNQUOTE(JSON_EXTRACT(dataPeruntukanSewa,'$.PeruntukanSewa'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataPeruntukanSewa,'$.Keterangan'));

	INSERT INTO peruntukansewa(peruntukansewa.idjenisKegiatan, peruntukansewa.peruntukanSewa, peruntukansewa.keterangan)
	VALUES(@jenisKegiatan, @peruntukanSewa, @keterangan);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_photoObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_photoObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `insert_photoObjekRetribusi`(IN `dataPhotoObjekRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @namaPhotoObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataPhotoObjekRetribusi,'$.NamaPhotoObjekRetribusi'));
	SET @photoObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataPhotoObjekRetribusi,'$.PhotoObjekRetribusi'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataPhotoObjekRetribusi,'$.Keterangan'));

	INSERT INTO photoobjekretribusi(photoobjekretribusi.namaPhotoObjekRetribusi, photoobjekretribusi.photoObjekRetribusi, photoobjekretribusi.keterangan)
	VALUES(@namaPhotoObjekRetribusi, @photoObjekRetribusi, @keterangan);

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
	
	INSERT INTO `status`(`status`.namaStatus, `status`.idJenisStatus, `status`.keterangan)
	VALUES(@namaStatus, @jenisStatus, @keterangan);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_tarifObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_tarifObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `insert_tarifObjekRetribusi`(IN `dataTarifObjekRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @idObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataTarifObjekRetribusi,'$.IdObjekRetribusi'));
	SET @idJenisJangkaWaktu = JSON_UNQUOTE(JSON_EXTRACT(dataTarifObjekRetribusi,'$.IdJenisJangkaWaktu'));
	SET @tanggalDinilai = JSON_UNQUOTE(JSON_EXTRACT(dataTarifObjekRetribusi,'$.TanggalDinilai '));
	SET @isDinilai = JSON_UNQUOTE(JSON_EXTRACT(dataTarifObjekRetribusi,'$.IsDinilai '));
	SET @namaPenilai = JSON_UNQUOTE(JSON_EXTRACT(dataTarifObjekRetribusi,'$.NamaPenilai'));
	SET @nominalTarif = JSON_UNQUOTE(JSON_EXTRACT(dataTarifObjekRetribusi,'$.NominalTarif'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataTarifObjekRetribusi,'$.Keterangan'));
	SET @fileHasilPenilaian = JSON_UNQUOTE(JSON_EXTRACT(dataTarifObjekRetribusi,'$.FileHasilPenilaian'));
	
	IF @tanggalDinilai THEN
		INSERT INTO tarifobjekretribusi(tarifobjekretribusi.idObjekRetribusi, tarifobjekretribusi.idJenisJangkaWaktu, tarifobjekretribusi.tanggalDinilai, tarifobjekretribusi.isDinilai,
		tarifobjekretribusi.namaPenilai, tarifobjekretribusi.nominalTarif, tarifobjekretribusi.keterangan, tarifobjekretribusi.fileHasilPenilaian)
		VALUES(@idObjekRetribusi, @idJenisJangkaWaktu, STR_TO_DATE(@tanggalDinilai, '%m/%d/%Y'), @isDinilai, @namaPenilai, @nominalTarif, @keterangan, @fileHasilPenilaian);
	ELSE
		INSERT INTO tarifobjekretribusi(tarifobjekretribusi.idObjekRetribusi, tarifobjekretribusi.idJenisJangkaWaktu,
		tarifobjekretribusi.namaPenilai, tarifobjekretribusi.nominalTarif, tarifobjekretribusi.keterangan, tarifobjekretribusi.fileHasilPenilaian)
		VALUES(@idObjekRetribusi, @idJenisJangkaWaktu, @namaPenilai, @nominalTarif, @keterangan, @fileHasilPenilaian);
	END IF;
	

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_user`;
delimiter ;;
CREATE PROCEDURE `insert_user`(IN `dataUser` JSON)
BEGIN
	#Routine body goes here...
	SET @jenisUser = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.JenisUser'));
	SET @userRole = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.UserRole'));
	SET @idPersonal = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Personal'));
	SET @username = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Username'));
	SET @password = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Password'));
	SET @token = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Token'));
	SET @email = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Email'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Keterangan'));
	
	INSERT INTO `user`(`user`.idJenisUser, `user`.idUserRole, `user`.idPersonal, `user`.username, `user`.`password`, `user`.token, `user`.email, `user`.keterangan)
	VALUES(@jenisUser, @userRole, @idPersonal, @username, @password, @token, @email, @keterangan );

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_wajibRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_wajibRetribusi`;
delimiter ;;
CREATE PROCEDURE `insert_wajibRetribusi`(IN `dataWajibRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @nik = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.Nik'));
	SET @idJenisWajibRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.IdJenisWajibRetribusi'));
	SET @namaWajibRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.NamaWajibRetribusi'));
	SET @namaPekerjaan = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.NamaPekerjaan'));
	SET @subdis_name = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.SubdisName'));
	SET @alamat = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.Alamat'));
	SET @nomorPonsel = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.NomorPonsel'));
	SET @nomorWhatsapp = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.NomorWhatsapp'));
	SET @email = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.Email'));
	SET @jenisRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.JenisRetribusi'));
	SET @fotoWajibRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.FotoWajibRetribusi'));

	INSERT INTO wajibretribusi(wajibretribusi.nik, wajibretribusi.idJenisWajibRetribusi, wajibretribusi.namaWajibRetribusi, wajibretribusi.idPekerjaan, 
	wajibretribusi.subdis_id, wajibretribusi.alamat, wajibretribusi.nomorPonsel, wajibretribusi.nomorWhatsapp, wajibretribusi.email, 
	wajibretribusi.idJenisRetribusi, wajibretribusi.fotoWajibRetribusi)
	VALUES(@nik, @idJenisWajibRetribusi, @namaWajibRetribusi, @namaPekerjaan, @subdis_name, @alamat, @nomorPonsel, @nomorWhatsapp, @email, 
	@jenisRetribusi, @fotoWajibRetribusi);

END
;;
delimiter ;

-- ----------------------------
-- Function structure for ucfirst
-- ----------------------------
DROP FUNCTION IF EXISTS `ucfirst`;
delimiter ;;
CREATE FUNCTION `ucfirst`(`inString` varchar(250))
 RETURNS varchar(250) CHARSET utf8mb4
  DETERMINISTIC
BEGIN
	DECLARE Strlen INT(8);
  DECLARE i INT(8);
 
    SET Strlen   = CHAR_LENGTH(inString);
    SET inString = LOWER(inString);
    SET i = 0;
 
    WHILE (i < Strlen) DO
        IF (MID(inString,i,1) = ' ' OR i = 0) THEN
            IF (i < Strlen) THEN
                SET inString = CONCAT(
                    LEFT(inString,i),
                    UPPER(MID(inString,i + 1,1)),
                    RIGHT(inString,Strlen - i - 1)
                );
            END IF;
        END IF;
        SET i = i + 1;
    END WHILE;
 
    RETURN inString;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_bidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_bidang`;
delimiter ;;
CREATE PROCEDURE `update_bidang`(IN `dataBidang` JSON)
BEGIN
	#Routine body goes here...
	SET @idBidang = JSON_UNQUOTE(JSON_EXTRACT(dataBidang,'$.IdBidang'));
	SET @departemen = JSON_UNQUOTE(JSON_EXTRACT(dataBidang,'$.IdDepartemen'));
	SET @parentBidang = JSON_UNQUOTE(JSON_EXTRACT(dataBidang,'$.ParentBidang'));
	SET @namaBidang = JSON_UNQUOTE(JSON_EXTRACT(dataBidang,'$.NamaBidang'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataBidang,'$.Keterangan'));
	
	UPDATE bidang SET bidang.idDepartemen = @departemen, bidang.parentBidang = @parentBidang, bidang.namaBidang = @namaBidang, bidang.keterangan = @keterangan, bidang.updateAt = NOW()
	WHERE bidang.idBidang = @idBidang;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_departemen
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_departemen`;
delimiter ;;
CREATE PROCEDURE `update_departemen`(IN `dataDepartemen` JSON)
BEGIN
	#Routine body goes here...
	SET @idDepartemen = JSON_UNQUOTE(JSON_EXTRACT(dataDepartemen,'$.IdDepartemen'));
	SET @namaDepartmen = JSON_UNQUOTE(JSON_EXTRACT(dataDepartemen,'$.NamaDepartmen'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataDepartemen,'$.Keterangan'));
	
	UPDATE departemen SET departemen.namaDepartmen = @namaDepartmen, departemen.keterangan = @keterangan, departemen.updateAt = NOW()
	WHERE departemen.idDepartemen = @idDepartemen;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_dokumenKelengkapan
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_dokumenKelengkapan`;
delimiter ;;
CREATE PROCEDURE `update_dokumenKelengkapan`(IN `dataDokumenKelengkapan` JSON)
BEGIN
    -- Mengambil data dari JSON input
    SET @idDokumenKelengkapan = JSON_UNQUOTE(JSON_EXTRACT(dataDokumenKelengkapan, '$.IdDokumenKelengkapan'));
    SET @idJenisDokumen = JSON_UNQUOTE(JSON_EXTRACT(dataDokumenKelengkapan, '$.IdJenisDokumen'));
    SET @dokumenKelengkapan = JSON_UNQUOTE(JSON_EXTRACT(dataDokumenKelengkapan, '$.DokumenKelengkapan'));
    SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataDokumenKelengkapan, '$.Keterangan'));

    -- Melakukan update pada tabel dokumenkelengkapan
    UPDATE dokumenkelengkapan 
    SET 
        dokumenkelengkapan.idJenisDokumen = @idJenisDokumen,
        dokumenkelengkapan.dokumenKelengkapan = @dokumenKelengkapan,
        dokumenkelengkapan.keterangan = @keterangan,
        dokumenkelengkapan.updateAt = NOW()
    WHERE 
        dokumenkelengkapan.idDokumenKelengkapan = @idDokumenKelengkapan;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jabatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jabatan`;
delimiter ;;
CREATE PROCEDURE `update_jabatan`(IN `dataJabatan` JSON)
BEGIN
	#Routine body goes here...
	SET @idJabatan = JSON_UNQUOTE(JSON_EXTRACT(dataJabatan,'$.IdJabatan'));
	SET @jabatan = JSON_UNQUOTE(JSON_EXTRACT(dataJabatan,'$.Jabatan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJabatan,'$.Keterangan'));
	
	UPDATE jabatan SET jabatan.jabatan = @jabatan, jabatan.keterangan = @keterangan, jabatan.updateAt = NOW()
	WHERE jabatan.idJabatan = @idJabatan;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jabatanBidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jabatanBidang`;
delimiter ;;
CREATE PROCEDURE `update_jabatanBidang`(IN `dataJabatanBidang` JSON)
BEGIN
	#Routine body goes here...
	SET @idJabatanBidang = JSON_UNQUOTE(JSON_EXTRACT(dataJabatanBidang,'$.IdJabatanBidang'));
	SET @jabatan = JSON_UNQUOTE(JSON_EXTRACT(dataJabatanBidang,'$.IdJabatan'));
  SET @bidang = JSON_UNQUOTE(JSON_EXTRACT(dataJabatanBidang,'$.IdBidang'));
  SET @namaJabatanBidang = JSON_UNQUOTE(JSON_EXTRACT(dataJabatanBidang,'$.NamaJabatanBidang'));
  SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJabatanBidang,'$.Keterangan'));
	
	UPDATE jabatanBidang SET jabatanBidang.idJabatan = @jabatan, jabatanBidang.idBidang = @bidang, jabatanBidang.namaJabatanBidang =@namaJabatanBidang, jabatanBidang.keterangan = @keterangan, jabatanBidang.updateAt = NOW()
	WHERE jabatanBidang.idJabatanBidang=@idJabatanBidang;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jangkaWaktuSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jangkaWaktuSewa`;
delimiter ;;
CREATE PROCEDURE `update_jangkaWaktuSewa`(IN `dataJangkaWaktuSewa` JSON)
BEGIN
    SET @idJangkaWaktuSewa = JSON_UNQUOTE(JSON_EXTRACT(dataJangkaWaktuSewa, '$.IdJenisStatus'));
    SET @jenisJangkaWaktu = JSON_UNQUOTE(JSON_EXTRACT(dataJangkaWaktuSewa, '$.IdJenisJangkaWaktu'));
    SET @jangkaWaktu = JSON_UNQUOTE(JSON_EXTRACT(dataJangkaWaktuSewa, '$.JangkaWaktu'));
    SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJangkaWaktuSewa, '$.Keterangan'));

    UPDATE jangkawaktusewa
    SET jangkawaktusewa.idJenisJangkaWaktu = @jenisJangkaWaktu,
        jangkawaktusewa.jangkaWaktu = @jangkaWaktu,
        jangkawaktusewa.keterangan = @keterangan,
        jangkawaktusewa.updateAt = NOW()
    WHERE jangkawaktusewa.idJangkaWaktuSewa = @idJangkaWaktuSewa;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jenisDokumen
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jenisDokumen`;
delimiter ;;
CREATE PROCEDURE `update_jenisDokumen`(IN `dataJenisDokumen` JSON)
BEGIN
	#Routine body goes here...
	SET @idJenisDokumen= JSON_UNQUOTE(JSON_EXTRACT(dataJenisDokumen,'$.IdJenisDokumen'));
	SET @jenisDokumen= JSON_UNQUOTE(JSON_EXTRACT(dataJenisDokumen,'$.JenisDokumen'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisDokumen,'$.Keterangan'));

	UPDATE jenisdokumen SET jenisdokumen.jenisDokumen = @jenisDokumen, jenisdokumen.keterangan = @keterangan, jenisdokumen.updateAt = NOW()
	WHERE jenisdokumen.idJenisDokumen = @idJenisDokumen;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jenisJangkaWaktu
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jenisJangkaWaktu`;
delimiter ;;
CREATE PROCEDURE `update_jenisJangkaWaktu`(IN `dataJenisJangkaWaktu` JSON)
BEGIN
    SET @idJenisJangkaWaktu = JSON_UNQUOTE(JSON_EXTRACT(dataJenisJangkaWaktu, '$.IdJenisJangkaWaktu'));
    SET @JenisJangkaWaktu = JSON_UNQUOTE(JSON_EXTRACT(dataJenisJangkaWaktu, '$.JenisJangkaWaktu'));
    SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisJangkaWaktu, '$.Keterangan'));

    UPDATE jenisjangkawaktu 
    SET 
        jenisjangkawaktu.jenisJangkaWaktu = @JenisJangkaWaktu,
        jenisjangkawaktu.keterangan = @keterangan,
        jenisjangkawaktu.updateAt = NOW()
    WHERE 
        jenisjangkawaktu.idJenisJangkaWaktu = @idJenisJangkaWaktu;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jenisKegiatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jenisKegiatan`;
delimiter ;;
CREATE PROCEDURE `update_jenisKegiatan`(IN `dataJenisKegiatan` JSON)
BEGIN
	#Routine body goes here...
	SET @idjenisKegiatan= JSON_UNQUOTE(JSON_EXTRACT(dataJenisKegiatan,'$.IdJenisKegiatan'));
	SET @jeniskegiatan= JSON_UNQUOTE(JSON_EXTRACT(dataJenisKegiatan,'$.JenisKegiatan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisKegiatan,'$.Keterangan'));

	UPDATE jeniskegiatan SET jeniskegiatan.jenisKegiatan = @jenisKegiatan, jeniskegiatan.keterangan = @keterangan, jeniskegiatan.updateAt = NOW()
	WHERE jeniskegiatan.idjenisKegiatan = @idjenisKegiatan;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jenisObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jenisObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `update_jenisObjekRetribusi`(IN `dataJenisObjekRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @idJenisObjekRetribusi= JSON_UNQUOTE(JSON_EXTRACT(dataJenisObjekRetribusi,'$.IdJenisObjekRetribusi'));
	SET @jenisObjekRetribusi= JSON_UNQUOTE(JSON_EXTRACT(dataJenisObjekRetribusi,'$.JenisObjekRetribusi'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisObjekRetribusi,'$.Keterangan'));

	UPDATE jenisobjekretribusi SET jenisObjekRetribusi.jenisObjekRetribusi = @jenisObjekRetribusi, jenisobjekretribusi.keterangan = @keterangan, jenisobjekretribusi.updateAt = NOW()
	WHERE jenisobjekretribusi.idJenisObjekRetribusi = @idJenisObjekRetribusi;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jenisPermohonan
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jenisPermohonan`;
delimiter ;;
CREATE PROCEDURE `update_jenisPermohonan`(IN `dataJenisPermohonan` JSON)
BEGIN
    SET @idJenisPermohonan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisPermohonan,'$.idJenisPermohonan'));
    SET @parentId = JSON_UNQUOTE(JSON_EXTRACT(dataJenisPermohonan,'$.ParentId'));
    SET @jenisPermohonan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisPermohonan,'$.JenisPermohonan'));
    SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisPermohonan,'$.Keterangan'));
    
    UPDATE jenispermohonan 
    SET 
        parentId = @parentId, 
        jenisPermohonan = @jenisPermohonan, 
        keterangan = @keterangan, 
        updateAt = NOW()
    WHERE 
        idJenisPermohonan = @idJenisPermohonan; -- Menggunakan idJenisPermohonan yang benar
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jenisRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jenisRetribusi`;
delimiter ;;
CREATE PROCEDURE `update_jenisRetribusi`(IN `dataJenisRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @idJenisRetribusi= JSON_UNQUOTE(JSON_EXTRACT(dataJenisRetribusi,'$.IdJenisRetribusi'));
	SET @JenisRetribusi= JSON_UNQUOTE(JSON_EXTRACT(dataJenisStatus,'$.JenisRetribusi'));
	SET @Keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisRetribusi,'$.Keterangan'));

	UPDATE JenisRetribusi SET JenisRetribusi.JenisRetribusi = @JenisRetribusi, JenisRetribusi.Keterangan = @Keterangan, JenisRetribusi.updateAt = NOW()
	WHERE JenisRetribusi.idJenisRetribusi = @idJenisRetribusi;

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

	UPDATE jenisstatus SET jenisstatus.jenisStatus = @jenisStatus, jenisstatus.keterangan = @keterangan, jenisstatus.updateAt = NOW()
	WHERE jenisstatus.idJenisStatus = @idJenisStatus;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_jenisUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_jenisUser`;
delimiter ;;
CREATE PROCEDURE `update_jenisUser`(IN `dataJenisUser` JSON)
BEGIN
	#Routine body goes here...
	SET @idJenisUser = JSON_UNQUOTE(JSON_EXTRACT(dataJenisUser,'$.IdJenisUser'));
	SET @jenisUser = JSON_UNQUOTE(JSON_EXTRACT(dataJenisUser,'$.JenisUser'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataJenisUser,'$.Keterangan'));
	
	UPDATE jenisUser SET jenisUser.jenisUser = @jenisUser, jenisUser.keterangan = @keterangan, jenisUser.updateAt = NOW()
	WHERE jenisUser.idJenisUser = @idJenisUser;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_lokasiObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_lokasiObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `update_lokasiObjekRetribusi`(IN `dataLokasiObjekRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @idLokasiObjekRetribusi= JSON_UNQUOTE(JSON_EXTRACT(dataLokasiObjekRetribusi,'$.idLokasiObjekRetribusi'));
	SET @lokasiObjekRetribusi= JSON_UNQUOTE(JSON_EXTRACT(dataLokasiObjekRetribusi,'$.LokasiObjekRetribusi'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataLokasiObjekRetribusi,'$.Keterangan'));

	UPDATE lokasiobjekretribusi SET lokasiobjekretribusi.lokasiObjekRetribusi = @lokasiObjekRetribusi, lokasiobjekretribusi.keterangan = @keterangan, lokasiobjekretribusi.updateAt = NOW()
	WHERE lokasiobjekretribusi.idLokasiObjekRetribusi = @idLokasiObjekRetribusi;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_objekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_objekRetribusi`;
delimiter ;;
CREATE PROCEDURE `update_objekRetribusi`(IN `dataObjekRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @idObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.IdObjekRetribusi'));
	SET @kodeObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.KodeObjekRetribusi'));
	SET @noBangunan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.NoBangunan'));
	SET @objekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.ObjekRetribusi'));
	SET @lokasiObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.IdLokasiObjekRetribusi'));
	SET @jenisObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.IdJenisObjekRetribusi'));
	SET @panjangTanah = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.PanjangTanah'));
	SET @lebarTanah = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.LebarTanah'));
	SET @luasTanah = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.LuasTanah'));
	SET @panjangBangunan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.PanjangBangunan'));
	SET @lebarBangunan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.LebarBangunan'));
	SET @luasBangunan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.LuasBangunan'));
	SET @subdis = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Subdis_Id'));
	SET @alamat = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Alamat'));
	SET @latitute = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Latitute'));
	SET @longitude = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Longitude'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.Keterangan'));
	SET @gambarDenahTanah = JSON_UNQUOTE(JSON_EXTRACT(dataObjekRetribusi,'$.GambarDenahTanah'));
	
	UPDATE objekretribusi SET objekretribusi.kodeObjekRetribusi = @kodeObjekRetribusi, objekretribusi.noBangunan = @noBangunan, objekretribusi.objekRetribusi = @objekRetribusi, objekretribusi.idLokasiObjekRetribusi = @lokasiObjekRetribusi, objekretribusi.idJenisObjekRetribusi = @jenisObjekRetribusi, objekretribusi.panjangTanah = @panjangTanah, objekretribusi.lebarTanah = @lebarTanah, objekretribusi.luasTanah = @luasTanah, objekretribusi.panjangBangunan = @panjangBangunan, objekretribusi.lebarBangunan = @lebarBangunan, objekretribusi.luasBangunan = @luasBangunan, objekretribusi.subdis_id = @subdis, objekretribusi.alamat = @alamat, objekretribusi.latitute = @latitute, objekretribusi.longitude = @longitude, objekretribusi.keterangan = @keterangan, objekretribusi.gambarDenahTanah = @gambarDenahTanah, objekRetribusi.updateAt = NOW()
	WHERE objekretribusi.idObjekRetribusi = @idObjekRetribusi;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_pegawai
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_pegawai`;
delimiter ;;
CREATE PROCEDURE `update_pegawai`(IN `dataPegawai` JSON)
BEGIN
	#Routine body goes here...
	SET @idPegawai = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.IdPegawai'));
	SET @nip = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.NIP'));
	SET @namaPegawai = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.NamaPegawai'));
	SET @golongan = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.Golongan'));
	SET @jabatanBidang = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.IdJabatanBidang'));
	SET @subdis = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.Subdis_Id'));
	SET @alamat = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.Alamat'));
	SET @nomorPonsel = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.NomorPonsel'));
	SET @nomorWhatsapp = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.NomorWhatsapp'));
	SET @fileFoto = JSON_UNQUOTE(JSON_EXTRACT(dataPegawai,'$.FileFoto'));
	
	UPDATE pegawai SET pegawai.nip = @nip, pegawai.namaPegawai = @namaPegawai, pegawai.golongan = @golongan, pegawai.idJabatanBidang = @jabatanBidang, pegawai.subdis_id = @subdis, pegawai.alamat = @alamat, pegawai.nomorPonsel = @nomorPonsel, pegawai.nomorWhatsapp = @nomorWhatsapp, pegawai.fileFoto = @fileFoto, pegawai.updateAt = NOW()
	WHERE pegawai.idPegawai = @idPegawai;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_pekerjaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_pekerjaan`;
delimiter ;;
CREATE PROCEDURE `update_pekerjaan`(IN `dataPekerjaan` JSON)
BEGIN
	#Routine body goes here...
	SET @idPekerjaan= JSON_UNQUOTE(JSON_EXTRACT(dataPekerjaan,'$.idPekerjaan'));
	SET @namaPekerjaan= JSON_UNQUOTE(JSON_EXTRACT(dataPekerjaan,'$.namaPekerjaan'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataPekerjaan,'$.keterangan'));

	UPDATE pekerjaan SET pekerjaan.namaPekerjaan = @namaPekerjaan, pekerjaan.keterangan = @keterangan, pekerjaan.updateAt = NOW()
	WHERE pekerjaan.idPekerjaan = @idPekerjaan;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_peruntukanSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_peruntukanSewa`;
delimiter ;;
CREATE PROCEDURE `update_peruntukanSewa`(IN `dataPeruntukanSewa` JSON)
BEGIN
	#Routine body goes here...
	SET @idperuntukanSewa = JSON_UNQUOTE(JSON_EXTRACT(dataPeruntukanSewa,'$.IdPeruntukanSewa'));
	SET @jenisKegiatan = JSON_UNQUOTE(JSON_EXTRACT(dataPeruntukanSewa,'$.IdJenisKegiatan'));
	SET @peruntukanSewa = JSON_UNQUOTE(JSON_EXTRACT(dataPeruntukanSewa,'$.PeruntukanSewa'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataPeruntukanSewa,'$.Keterangan'));
	
	UPDATE `peruntukansewa` SET `peruntukansewa`.idjenisKegiatan=@jenisKegiatan, `peruntukansewa`.peruntukanSewa=@peruntukanSewa, `peruntukansewa`.keterangan=@keterangan, `peruntukansewa`.updateAt=NOW()
	WHERE `peruntukansewa`.idperuntukanSewa=@idperuntukanSewa;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_photoObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_photoObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `update_photoObjekRetribusi`(IN `dataPhotoObjekRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @idObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataPhotoObjekRetribusi,'$.IdObjekRetribusi'));
	SET @namaPhotoObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataPhotoObjekRetribusi,'$.NamaPhotoObjekRetribusi'));
	SET @photoObjekRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataPhotoObjekRetribusi,'$.PhotoObjekRetribusi'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataPhotoObjekRetribusi,'$.Keterangan'));
	
	UPDATE photoobjekretribusi SET photoobjekretribusi.namaPhotoObjekRetribusi = @namaPhotoObjekRetribusi, photoobjekretribusi.photoObjekRetribusi = @photoObjekRetribusi, photoobjekretribusi.keterangan = @keterangan, photoobjekretribusi.updateAt = NOW()
	WHERE photoobjekretribusi.idObjekRetribusi = @idObjekRetribusi;

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
	SET @jenisStatus = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.IdJenisStatus'));
	SET @namaStatus = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.Status'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataStatus,'$.Keterangan'));
	
	UPDATE `status` SET `status`.namaStatus=@namaStatus, `status`.idJenisStatus=@jenisStatus, `status`.keterangan=@keterangan, `status`.updateAt=NOW()
	WHERE `status`.idStatus=@idStatus;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_user`;
delimiter ;;
CREATE PROCEDURE `update_user`(IN `dataUser` JSON)
BEGIN
	#Routine body goes here...
	SET @userId = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.UserId'));
	SET @jenisUser = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.JenisUser'));
	SET @userRole = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.UserRole'));
	SET @idPersonal = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Personal'));
	SET @username = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Username'));
	SET @password = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Password'));
	SET @token = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Token'));
	SET @email = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Email'));
	SET @keterangan = JSON_UNQUOTE(JSON_EXTRACT(dataUser,'$.Keterangan'));
	
	UPDATE `user` SET `user`.idJenisUser = @jenisUser, `user`.idUserRole = @userRole, `user`.idPersonal = @idPersonal, `user`.username = @username, `user`.`password` = @password, `user`.token = @token, `user`.email = @email, `user`.keterangan = @keterangan, `user`.updateAt = NOW()
	WHERE `user`.userId = @userId;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_wajibRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_wajibRetribusi`;
delimiter ;;
CREATE PROCEDURE `update_wajibRetribusi`(IN `dataWajibRetribusi` JSON)
BEGIN
	#Routine body goes here...
	SET @idWajibRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.IdWajibRetribusi'));
	SET @namaWajibRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.NamaWajibRetribusi'));
	SET @nik = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.Nik'));
	SET @namaPekerjaan = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.NamaPekerjaan'));
	SET @subdis_name = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.SubdisName'));
	SET @alamat = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.Alamat'));
	SET @nomorPonsel = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.NomorPonsel'));
	SET @nomorWhatsapp = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.NomorWhatsapp'));
	SET @email = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.Email'));
	SET @jenisRetribusi = JSON_UNQUOTE(JSON_EXTRACT(dataWajibRetribusi,'$.JenisRetribusi'));
	
	UPDATE wajibretribusi SET wajibretribusi.namaWajibRetribusi =  @namaWajibRetribusi, wajibretribusi.nik = @nik, wajibretribusi.idPekerjaan = @namaPekerjaan, wajibretribusi.subdis_id = @subdis_name, wajibretribusi.alamat = @alamat, wajibretribusi.nomorPonsel = @nomorPonsel, wajibretribusi.nomorWhatsapp = @nomorWhatsapp, wajibretribusi.email = @email, wajibretribusi.idJenisRetribusi = @jenisRetribusi, wajibretribusi.updateAt = NOW()
	WHERE wajibretribusi.idWajibRetribusi = @idWajibRetribusi;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_bidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_bidang`;
delimiter ;;
CREATE PROCEDURE `viewAll_bidang`()
BEGIN
	#Routine body goes here...
SELECT
	bidang.idBidang, 
	departemen.idDepartemen, 
	bidang.parentBidang, 
	bidang.namaBidang, 
	bidang.keterangan
FROM
	bidang
	INNER JOIN
	departemen
	ON 
		bidang.idDepartemen = departemen.idDepartemen
WHERE
	bidang.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_departemen
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_departemen`;
delimiter ;;
CREATE PROCEDURE `viewAll_departemen`()
BEGIN
	#Routine body goes here...
SELECT
	departemen.idDepartemen, 
	departemen.namaDepartmen, 
	departemen.keterangan
FROM
	departemen
WHERE
	departemen.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_dokumenKelengkapan
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_dokumenKelengkapan`;
delimiter ;;
CREATE PROCEDURE `viewAll_dokumenKelengkapan`()
BEGIN
	#Routine body goes here...
SELECT
	dokumenkelengkapan.idDokumenKelengkapan, 
	dokumenkelengkapan.idJenisDokumen,
	jenisdokumen.jenisDokumen, 
	dokumenkelengkapan.dokumenKelengkapan, 
	dokumenkelengkapan.keterangan
FROM
	dokumenkelengkapan
	INNER JOIN
	jenisdokumen
	ON 
		dokumenkelengkapan.idJenisDokumen = jenisdokumen.idJenisDokumen
WHERE
	dokumenkelengkapan.isDeleted = 0;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jabatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jabatan`;
delimiter ;;
CREATE PROCEDURE `viewAll_jabatan`()
BEGIN
	#Routine body goes here...
SELECT
	jabatan.idJabatan, 
	jabatan.jabatan, 
	jabatan.keterangan
FROM
	jabatan
WHERE
	jabatan.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jabatanBidang
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jabatanBidang`;
delimiter ;;
CREATE PROCEDURE `viewAll_jabatanBidang`()
BEGIN
    SELECT
        jabatanBidang.idJabatanBidang,
        jabatanBidang.idJabatan,
        jabatan.Jabatan,
        jabatanBidang.idBidang,
        bidang.namaBidang,
        jabatanBidang.namaJabatanBidang,
        jabatanBidang.keterangan,
        jabatanBidang.createAt,
        jabatanBidang.updateAt
    FROM
        jabatanBidang
    INNER JOIN
        jabatan ON jabatan.idJabatan = jabatanBidang.idJabatan
    INNER JOIN
        bidang ON bidang.idBidang = jabatanBidang.idBidang
    WHERE
        jabatanBidang.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jangkaWaktuSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jangkaWaktuSewa`;
delimiter ;;
CREATE PROCEDURE `viewAll_jangkaWaktuSewa`()
BEGIN
    SELECT
        jangkawaktusewa.idJangkaWaktuSewa, 
        jangkawaktusewa.idJenisJangkaWaktu, 
        jenisjangkawaktu.jenisJangkaWaktu, 
        jangkawaktusewa.jangkaWaktu,
        jangkawaktusewa.keterangan
    FROM
        jangkawaktusewa
    INNER JOIN
        jenisjangkawaktu
    ON 
        jenisjangkawaktu.idJenisJangkaWaktu = jangkawaktusewa.idJenisJangkaWaktu
    WHERE
        jangkawaktusewa.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jenisDokumen
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jenisDokumen`;
delimiter ;;
CREATE PROCEDURE `viewAll_jenisDokumen`()
BEGIN
	#Routine body goes here...
SELECT
	jenisdokumen.idJenisDokumen, 
	jenisdokumen.jenisDokumen, 
	jenisdokumen.keterangan
FROM
	jenisdokumen
WHERE
	jenisdokumen.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jenisJangkaWaktu
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jenisJangkaWaktu`;
delimiter ;;
CREATE PROCEDURE `viewAll_jenisJangkaWaktu`()
BEGIN
	#Routine body goes here...
SELECT
	jenisjangkawaktu.idjenisJangkaWaktu, 
	jenisjangkawaktu.jenisJangkaWaktu, 
	jenisjangkawaktu.keterangan
FROM
	jenisjangkawaktu
WHERE
	jenisjangkawaktu.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jenisKegiatan
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jenisKegiatan`;
delimiter ;;
CREATE PROCEDURE `viewAll_jenisKegiatan`()
BEGIN
	#Routine body goes here...
SELECT
	jeniskegiatan.idjenisKegiatan, 
	jeniskegiatan.jenisKegiatan, 
	jeniskegiatan.keterangan
FROM
	jeniskegiatan
WHERE
	jeniskegiatan.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jenisObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jenisObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `viewAll_jenisObjekRetribusi`()
BEGIN
	#Routine body goes here...
SELECT
	jenisobjekretribusi.idJenisObjekRetribusi, 
	jenisobjekretribusi.jenisObjekRetribusi, 
	jenisobjekretribusi.keterangan
FROM
	jenisobjekretribusi
WHERE
	jenisobjekretribusi.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jenisPermohonan
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jenisPermohonan`;
delimiter ;;
CREATE PROCEDURE `viewAll_jenisPermohonan`()
BEGIN
	#Routine body goes here...
SELECT
	jenispermohonan.idJenisPermohonan, 
	jenispermohonan.parentId, 
	jenispermohonan.jenisPermohonan,
	jenispermohonan.keterangan
FROM
	jenispermohonan
WHERE
	jenispermohonan.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jenisRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jenisRetribusi`;
delimiter ;;
CREATE PROCEDURE `viewAll_jenisRetribusi`()
BEGIN
	#Routine body goes here...
SELECT
	JenisRetribusi.idJenisRetribusi, 
	JenisRetribusi.JenisRetribusi, 
	JenisRetribusi.Keterangan
FROM
	JenisRetribusi
WHERE
	JenisRetribusi.isDeleted = 0;

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
	jenisstatus.idJenisStatus, 
	jenisstatus.jenisStatus, 
	jenisstatus.keterangan
FROM
	jenisstatus
WHERE
	jenisstatus.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_jenisUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_jenisUser`;
delimiter ;;
CREATE PROCEDURE `viewAll_jenisUser`()
BEGIN
	#Routine body goes here...
SELECT
	jenisUser.idJenisUser, 
	jenisUser.jenisUser, 
	jenisUser.keterangan
FROM
	jenisUser
WHERE
	jenisUser.idJenisUser = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_lokasiObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_lokasiObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `viewAll_lokasiObjekRetribusi`()
BEGIN
	#Routine body goes here...
SELECT
	lokasiobjekretribusi.idLokasiObjekRetribusi, 
	lokasiobjekretribusi.lokasiObjekRetribusi, 
	lokasiobjekretribusi.keterangan
FROM
	lokasiobjekretribusi
WHERE
	lokasiobjekretribusi.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_objekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_objekRetribusi`;
delimiter ;;
CREATE PROCEDURE `viewAll_objekRetribusi`()
BEGIN
	#Routine body goes here...
SELECT
	objekretribusi.idObjekRetribusi, 
	lokasiobjekretribusi.lokasiObjekRetribusi, 
	jenisobjekretribusi.jenisObjekRetribusi, 
	objekretribusi.kodeObjekRetribusi, 
	objekretribusi.objekRetribusi, 
	objekretribusi.panjangTanah, 
	objekretribusi.lebarTanah, 
	objekretribusi.luasTanah, 
	objekretribusi.panjangBangunan, 
	objekretribusi.lebarBangunan, 
	objekretribusi.luasBangunan, 
	subdistricts.subdis_id, 
	objekretribusi.alamat, 
	objekretribusi.latitute, 
	objekretribusi.longitude, 
	objekretribusi.keterangan, 
	objekretribusi.gambarDenahTanah, 
	objekretribusi.noBangunan
FROM
	objekretribusi
	INNER JOIN
	lokasiobjekretribusi
	ON 
		objekretribusi.idLokasiObjekRetribusi = lokasiobjekretribusi.idLokasiObjekRetribusi
	INNER JOIN
	jenisobjekretribusi
	ON 
		objekretribusi.idJenisObjekRetribusi = jenisobjekretribusi.idJenisObjekRetribusi
	INNER JOIN
	subdistricts
	ON 
		objekretribusi.subdis_id = subdistricts.subdis_id
WHERE
	objekretribusi.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_pegawai
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_pegawai`;
delimiter ;;
CREATE PROCEDURE `viewAll_pegawai`()
BEGIN
	#Routine body goes here...
SELECT
	pegawai.idPegawai, 
	pegawai.nip, 
	pegawai.namaPegawai, 
	CONCAT(golonganPangkat.golongan, ' - ' ,golonganPangkat.pangkat) as golonganPangkat,
	jabatanBidang.namaJabatanBidang, 
	CONCAT(pegawai.alamat, ', ', (SELECT ucfirst (subdistricts.subdis_name)), ', ',(SELECT ucfirst (districts.dis_name)), ', ',(SELECT ucfirst (cities.city_name)), ', ',(SELECT ucfirst (provinces.prov_name))) as alamatLengkap,
	pegawai.fileFoto,
	bidang.namaBidang, 
	departemen.namaDepartmen
FROM
	pegawai
	INNER JOIN
	jabatanBidang
	ON 
		pegawai.idJabatanBidang = jabatanBidang.idJabatanBidang
	INNER JOIN
	golonganPangkat
	ON 
		pegawai.idGolonganPangkat = golonganPangkat.idGolonganPangkat
	INNER JOIN
	subdistricts
	ON 
		pegawai.subdis_id = subdistricts.subdis_id
	INNER JOIN
	districts
	ON 
		subdistricts.dis_id = districts.dis_id
	INNER JOIN
	cities
	ON 
		districts.city_id = cities.city_id
	INNER JOIN
	provinces
	ON 
		cities.prov_id = provinces.prov_id
	INNER JOIN
	bidang
	ON 
		jabatanBidang.idBidang = bidang.idBidang
	INNER JOIN
	departemen
	ON 
		bidang.idDepartemen = departemen.idDepartemen
WHERE
	pegawai.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_pekerjaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_pekerjaan`;
delimiter ;;
CREATE PROCEDURE `viewAll_pekerjaan`()
BEGIN
	#Routine body goes here...
SELECT
	pekerjaan.idPekerjaan, 
	pekerjaan.namaPekerjaan, 
	pekerjaan.keterangan
FROM
	pekerjaan
WHERE
	pekerjaan.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_perjanjianSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_perjanjianSewa`;
delimiter ;;
CREATE PROCEDURE `viewAll_perjanjianSewa`()
BEGIN
	#Routine body goes here...
SELECT
	db_tapatupa.perjanjianSewa.nomorSuratPerjanjian, 
	db_tapatupa.perjanjianSewa.idPerjanjianSewa, 
	db_tapatupa.perjanjianSewa.tanggalDisahkan, 
	db_tapatupa.perjanjianSewa.idStatus, 
	db_tapatupa.wajibretribusi.nik, 
	db_tapatupa.wajibretribusi.namaWajibRetribusi, 
	db_tapatupa.objekretribusi.objekRetribusi, 
	db_tapatupa.jenisjangkawaktu.jenisJangkaWaktu, 
	db_tapatupa.wajibretribusi.fotoWajibRetribusi
FROM
	db_tapatupa.perjanjianSewa
	INNER JOIN
	db_tapatupa.permohonansewa
	ON 
		db_tapatupa.perjanjianSewa.idPermohonan = db_tapatupa.permohonansewa.idPermohonanSewa
	INNER JOIN
	db_tapatupa.wajibretribusi
	ON 
		db_tapatupa.permohonansewa.idWajibRetribusi = db_tapatupa.wajibretribusi.idWajibRetribusi
	INNER JOIN
	db_tapatupa.objekretribusi
	ON 
		db_tapatupa.permohonansewa.idObjekRetribusi = db_tapatupa.objekretribusi.idObjekRetribusi
	INNER JOIN
	db_tapatupa.jenisjangkawaktu
	ON 
		db_tapatupa.permohonansewa.idjenisJangkaWaktu = db_tapatupa.jenisjangkawaktu.idJenisJangkaWaktu
WHERE
	db_tapatupa.perjanjianSewa.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_permohonanSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_permohonanSewa`;
delimiter ;;
CREATE PROCEDURE `viewAll_permohonanSewa`()
BEGIN
	#Routine body goes here...
	SELECT
	permohonansewa.idPermohonanSewa, 
	jenispermohonan.jenisPermohonan, 
	permohonansewa.nomorSuratPermohonan, 
	wajibretribusi.nik, 
	wajibretribusi.namaWajibRetribusi, 
	objekretribusi.kodeObjekRetribusi, 
	objekretribusi.objekRetribusi, 
	CONCAT(permohonansewa.lamaSewa, ' ', satuan.namaSatuan) as LamaSewa,
	wajibretribusi.fotoWajibRetribusi,
	permohonansewa.createAt, 
	`status`.namaStatus
FROM
	permohonansewa
	INNER JOIN
	jenispermohonan
	ON 
		permohonansewa.idJenisPermohonan = jenispermohonan.idJenisPermohonan
	INNER JOIN
	wajibretribusi
	ON 
		permohonansewa.idWajibRetribusi = wajibretribusi.idWajibRetribusi
	INNER JOIN
	objekretribusi
	ON 
		permohonansewa.idObjekRetribusi = objekretribusi.idObjekRetribusi
	INNER JOIN
	satuan
	ON 
		permohonansewa.idSatuan = satuan.idSatuan
	INNER JOIN
	`status`
	ON 
		permohonansewa.idStatus = `status`.idStatus
WHERE
	permohonansewa.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_peruntukanSewa
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_peruntukanSewa`;
delimiter ;;
CREATE PROCEDURE `viewAll_peruntukanSewa`()
BEGIN
    SELECT
        peruntukansewa.idperuntukanSewa, 
        peruntukansewa.idjenisKegiatan, 
        jeniskegiatan.jenisKegiatan,
        peruntukansewa.peruntukanSewa,
        peruntukansewa.keterangan
    FROM
        peruntukansewa
    INNER JOIN
        jeniskegiatan
    ON 
        peruntukansewa.idjenisKegiatan = jeniskegiatan.idjenisKegiatan
    WHERE
        peruntukansewa.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_photoObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_photoObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `viewAll_photoObjekRetribusi`()
BEGIN
	#Routine body goes here...
SELECT
	objekretribusi.idObjekRetribusi, 
	photoobjekretribusi.namaPhotoObjekRetribusi, 
	photoobjekretribusi.photoObjekRetribusi, 
	photoobjekretribusi.keterangan
FROM
	photoobjekretribusi,
	objekretribusi
WHERE
	photoobjekretribusi.isDeleted = 0;
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
	`status`.idStatus,
	`status`.namaStatus, 
	jenisstatus.jenisStatus, 
	`status`.keterangan
FROM
	jenisstatus
	INNER JOIN
	`status`
	ON 
		jenisstatus.idJenisStatus = `status`.idJenisStatus
WHERE
	`status`.isDeleted = 0;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_tarifObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_tarifObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `viewAll_tarifObjekRetribusi`()
BEGIN
	#Routine body goes here...
	SELECT
	tarifobjekretribusi.idTarifObjekRetribusi, 
	objekretribusi.kodeObjekRetribusi, 
	objekretribusi.objekRetribusi, 
	objekretribusi.noBangunan, 
	jenisjangkawaktu.jenisJangkaWaktu, 
	tarifobjekretribusi.nominalTarif,
	tarifobjekretribusi.keterangan
FROM
	tarifobjekretribusi
	INNER JOIN
	objekretribusi
	ON 
		tarifobjekretribusi.idObjekRetribusi = objekretribusi.idObjekRetribusi
	INNER JOIN
	jenisjangkawaktu
	ON 
		tarifobjekretribusi.idJenisJangkaWaktu = jenisjangkawaktu.idJenisJangkaWaktu
WHERE
	tarifobjekretribusi.isDeleted = 0 AND
	tarifobjekretribusi.isDefault = 1;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_user`;
delimiter ;;
CREATE PROCEDURE `viewAll_user`()
BEGIN
	#Routine body goes here...
SELECT
	`user`.userId, 
	jenisUser.idJenisUser, 
	userRole.idUserRole, 
	`user`.idPersonal, 
	`user`.username, 
	`user`.`password`, 
	`user`.token, 
	`user`.email, 
	`user`.keterangan
FROM
	`user`
	INNER JOIN
	jenisUser
	ON 
		`user`.idJenisUser = jenisUser.idJenisUser
	INNER JOIN
	userRole
	ON 
		`user`.idUserRole = userRole.idUserRole
WHERE
	`user`.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for viewAll_wajibRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `viewAll_wajibRetribusi`;
delimiter ;;
CREATE PROCEDURE `viewAll_wajibRetribusi`()
BEGIN
	#Routine body goes here...
SELECT
	wajibretribusi.idWajibRetribusi, 
	wajibretribusi.namaWajibRetribusi, 
	CONCAT(wajibretribusi.alamat, ', ', (SELECT ucfirst (subdistricts.subdis_name)), ', ',(SELECT ucfirst (districts.dis_name)), ', ',(SELECT ucfirst (cities.city_name)), ', ',(SELECT ucfirst (provinces.prov_name))) as alamatLengkap,
	wajibretribusi.nomorPonsel, 
	wajibretribusi.nomorWhatsapp, 
	wajibretribusi.email, 
	wajibretribusi.nik, 
	wajibretribusi.fotoWajibRetribusi
FROM
	wajibretribusi
	INNER JOIN
	subdistricts
	ON 
		wajibretribusi.subdis_id = subdistricts.subdis_id
	INNER JOIN
	districts
	ON 
		subdistricts.dis_id = districts.dis_id
	INNER JOIN
	cities
	ON 
		districts.city_id = cities.city_id
	INNER JOIN
	provinces
	ON 
		cities.prov_id = provinces.prov_id
WHERE
	wajibretribusi.isDeleted = 0;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_bidangById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_bidangById`;
delimiter ;;
CREATE PROCEDURE `view_bidangById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	bidang.idBidang, 
	departemen.idDepartemen, 
	bidang.parentBidang, 
	bidang.namaBidang, 
	bidang.keterangan
FROM
	bidang
	INNER JOIN
	departemen
	ON 
		bidang.idDepartemen = departemen.idDepartemen
WHERE
	bidang.idBidang = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_departemenById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_departemenById`;
delimiter ;;
CREATE PROCEDURE `view_departemenById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	departemen.idDepartemen, 
	departemen.namaDepartmen, 
	departemen.keterangan
FROM
	departemen
WHERE
	departemen.idDepartemen = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_detailPermohonanToPerjanjianById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_detailPermohonanToPerjanjianById`;
delimiter ;;
CREATE PROCEDURE `view_detailPermohonanToPerjanjianById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT DISTINCT
	permohonansewa.idPermohonanSewa, 
	jenispermohonan.jenisPermohonan, 
	permohonansewa.nomorSuratPermohonan, 
	permohonansewa.idJenisPermohonan, 
	permohonansewa.idWajibRetribusi, 
	wajibretribusi.namaWajibRetribusi, 
	CONCAT(wajibretribusi.alamat, ', ', (SELECT ucfirst (subdistricts.subdis_name)), ', ',(SELECT ucfirst (districts.dis_name)), ', ',(SELECT ucfirst (cities.city_name)), ', ',(SELECT ucfirst (provinces.prov_name))) AS alamatWajibRetribusi, 
	permohonansewa.idObjekRetribusi, 
	objekretribusi.kodeObjekRetribusi, 
	objekretribusi.objekRetribusi, 
	objekretribusi.noBangunan, 
	CONCAT(objekretribusi.alamat, ', ', (SELECT ucfirst (subdistricts.subdis_name)), ', ',(SELECT ucfirst (districts.dis_name)), ', ',(SELECT ucfirst (cities.city_name)), ', ',(SELECT ucfirst (provinces.prov_name))) AS alamatObjekRetribusi, 
	permohonansewa.idPeruntukanSewa, 
	peruntukansewa.peruntukanSewa, 
	permohonansewa.idjenisJangkaWaktu, 
	jenisjangkawaktu.jenisJangkaWaktu, 
	permohonansewa.lamaSewa, 
	permohonansewa.idSatuan, 
	satuan.namaSatuan
FROM
	permohonansewa
	INNER JOIN
	jenispermohonan
	ON 
		permohonansewa.idJenisPermohonan = jenispermohonan.idJenisPermohonan
	INNER JOIN
	wajibretribusi
	ON 
		permohonansewa.idWajibRetribusi = wajibretribusi.idWajibRetribusi
	INNER JOIN
	objekretribusi
	ON 
		permohonansewa.idObjekRetribusi = objekretribusi.idObjekRetribusi
	INNER JOIN
	peruntukansewa
	ON 
		permohonansewa.idPeruntukanSewa = peruntukansewa.idperuntukanSewa
	INNER JOIN
	jenisjangkawaktu
	ON 
		permohonansewa.idjenisJangkaWaktu = jenisjangkawaktu.idJenisJangkaWaktu
	INNER JOIN
	satuan
	ON 
		permohonansewa.idSatuan = satuan.idSatuan
	INNER JOIN
	subdistricts
	ON 
		objekretribusi.subdis_id = subdistricts.subdis_id
	INNER JOIN
	provinces
	INNER JOIN
	cities
	ON 
		provinces.prov_id = cities.prov_id
	INNER JOIN
	districts
	ON 
		cities.city_id = districts.city_id AND
		subdistricts.dis_id = districts.dis_id
	WHERE permohonansewa.idPermohonanSewa=id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_dokumenKelengkapanById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_dokumenKelengkapanById`;
delimiter ;;
CREATE PROCEDURE `view_dokumenKelengkapanById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	`dokumenkelengkapan`.idDokumenKelengkapan,
	`dokumenkelengkapan`.idJenisDokumen,
	`jenisdokumen`.`jenisDokumen`, 
	`dokumenkelengkapan`.dokumenKelengkapan, 
	`dokumenkelengkapan`.keterangan
FROM
	`dokumenkelengkapan`
	INNER JOIN
	jenisdokumen
	ON 
		`dokumenkelengkapan`.idJenisDokumen = jenisdokumen.idJenisDokumen
WHERE
	`dokumenkelengkapan`.idDokumenKelengkapan = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jabatanBidangById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jabatanBidangById`;
delimiter ;;
CREATE PROCEDURE `view_jabatanBidangById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jabatanBidang.idJabatanBidang, 
	jabatan.idJabatan, 
	jabatan.Jabatan,
	bidang.idBidang, 
	bidang.namaBidang,
	jabatanBidang.namaJabatanBidang, 
	jabatanBidang.keterangan
FROM
	jabatanBidang
	INNER JOIN
	jabatan
	ON 
		jabatanBidang.idJabatan = jabatan.idJabatan
	INNER JOIN
	bidang
	ON 
		jabatanBidang.idBidang = bidang.idBidang
WHERE
	jabatanBidang.idJabatanBidang = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jabatanById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jabatanById`;
delimiter ;;
CREATE PROCEDURE `view_jabatanById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jabatan.idJabatan, 
	jabatan.jabatan, 
	jabatan.keterangan
FROM
	jabatan
WHERE
	jabatan.idJabatan = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jangkaWaktuSewaById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jangkaWaktuSewaById`;
delimiter ;;
CREATE PROCEDURE `view_jangkaWaktuSewaById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jangkawaktusewa.idJangkaWaktuSewa, 
	jangkawaktusewa.idJenisJangkaWaktu, 
	jenisjangkawaktu.jenisJangkaWaktu,
	jangkawaktusewa.jangkaWaktu,
	jangkawaktusewa.keterangan
FROM
	jangkawaktusewa
	INNER JOIN
	jenisjangkawaktu
	ON 
		jenisjangkawaktu.idJenisJangkaWaktu = jangkawaktusewa.idJenisJangkaWaktu
WHERE
	jangkawaktusewa.idJangkaWaktuSewa = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jenisDokumenById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jenisDokumenById`;
delimiter ;;
CREATE PROCEDURE `view_jenisDokumenById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jenisdokumen.idJenisDokumen, 
	jenisdokumen.jenisDokumen, 
	jenisdokumen.keterangan
FROM
	jenisdokumen
WHERE
	jenisdokumen.idJenisDokumen = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jenisJangkaWaktuById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jenisJangkaWaktuById`;
delimiter ;;
CREATE PROCEDURE `view_jenisJangkaWaktuById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jenisjangkawaktu.idJenisJangkaWaktu, 
	jenisjangkawaktu.jenisJangkaWaktu, 
	jenisjangkawaktu.keterangan
FROM
	jenisjangkawaktu
WHERE
	jenisjangkawaktu.idJenisJangkaWaktu = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jenisKegiatanById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jenisKegiatanById`;
delimiter ;;
CREATE PROCEDURE `view_jenisKegiatanById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jeniskegiatan.idjenisKegiatan, 
	jeniskegiatan.jenisKegiatan, 
	jeniskegiatan.keterangan
FROM
	jeniskegiatan
WHERE
	jeniskegiatan.idjenisKegiatan = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jenisObjekRetribusi
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jenisObjekRetribusi`;
delimiter ;;
CREATE PROCEDURE `view_jenisObjekRetribusi`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jenisobjekretribusi.idJenisObjekRetribusi, 
	jenisobjekretribusi.jenisObjekRetribusi, 
	jenisobjekretribusi.keterangan
FROM
	jenisobjekretribusi
WHERE
	jenisobjekretribusi.idJenisObjekRetribusi = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jenisPermohonanById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jenisPermohonanById`;
delimiter ;;
CREATE PROCEDURE `view_jenisPermohonanById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jenispermohonan.idJenisPermohonan, 
	jenispermohonan.parentId, 
	jenispermohonan.jenisPermohonan,
	jenispermohonan.keterangan
FROM
	jenispermohonan
WHERE
	jenispermohonan.idJenisPermohonan = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jenisRetribusiById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jenisRetribusiById`;
delimiter ;;
CREATE PROCEDURE `view_jenisRetribusiById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	JenisRetribusi.idJenisRetribusi, 
	JenisRetribusi.JenisRetribusi, 
	JenisRetribusi.Keterangan
FROM
	JenisRetribusi
WHERE
	JenisRetribusi.idJenisRetribusi = id;

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
	jenisstatus.idJenisStatus, 
	jenisstatus.jenisStatus, 
	jenisstatus.keterangan
FROM
	jenisstatus
WHERE
	jenisstatus.idJenisStatus = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_jenisUserById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_jenisUserById`;
delimiter ;;
CREATE PROCEDURE `view_jenisUserById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	jenisUser.idJenisUser, 
	jenisUser.jenisUser, 
	jenisUser.keterangan
FROM
	jenisUser
WHERE
	jenisUser.idJenisUser = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_lokasiObjekRetribusiById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_lokasiObjekRetribusiById`;
delimiter ;;
CREATE PROCEDURE `view_lokasiObjekRetribusiById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	lokasiobjekretribusi.idLokasiObjekRetribusi, 
	lokasiobjekretribusi.lokasiObjekRetribusi, 
	lokasiobjekretribusi.keterangan
FROM
	lokasiobjekretribusi
WHERE
	lokasiobjekretribusi.idLokasiObjekRetribusi = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_objekRetribusiById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_objekRetribusiById`;
delimiter ;;
CREATE PROCEDURE `view_objekRetribusiById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	objekretribusi.idObjekRetribusi, 
	lokasiobjekretribusi.lokasiObjekRetribusi, 
	jenisobjekretribusi.jenisObjekRetribusi, 
	objekretribusi.kodeObjekRetribusi, 
	objekretribusi.objekRetribusi, 
	objekretribusi.panjangTanah, 
	objekretribusi.lebarTanah, 
	objekretribusi.luasTanah, 
	objekretribusi.panjangBangunan, 
	objekretribusi.lebarBangunan, 
	objekretribusi.luasBangunan, 
	CONCAT(objekretribusi.alamat, ', ', (SELECT ucfirst (subdistricts.subdis_name)), ', ',(SELECT ucfirst (districts.dis_name)), ', ',(SELECT ucfirst (cities.city_name)), ', ',(SELECT ucfirst (provinces.prov_name))) as alamatLengkap,
	objekretribusi.latitute, 
	objekretribusi.longitude, 
	objekretribusi.keterangan, 
	objekretribusi.gambarDenahTanah, 
	objekretribusi.noBangunan, 
	objekretribusi.jumlahLantai, 
	objekretribusi.kapasitas, 
	objekretribusi.batasUtara, 
	objekretribusi.batasSelatan, 
	objekretribusi.batasTimur, 
	objekretribusi.batasBarat, 
	objekretribusi.idLokasiObjekRetribusi, 
	objekretribusi.idJenisObjekRetribusi, 
	provinces.prov_id, 
	cities.city_id, 
	districts.dis_id, 
	objekretribusi.subdis_id
FROM
	objekretribusi
	INNER JOIN
	lokasiobjekretribusi
	ON 
		objekretribusi.idLokasiObjekRetribusi = lokasiobjekretribusi.idLokasiObjekRetribusi
	INNER JOIN
	jenisobjekretribusi
	ON 
		objekretribusi.idJenisObjekRetribusi = jenisobjekretribusi.idJenisObjekRetribusi
	INNER JOIN
	subdistricts
	ON 
		objekretribusi.subdis_id = subdistricts.subdis_id
	INNER JOIN
	districts
	ON 
		subdistricts.dis_id = districts.dis_id
	INNER JOIN
	cities
	ON 
		districts.city_id = cities.city_id
	INNER JOIN
	provinces
	ON 
		cities.prov_id = provinces.prov_id
WHERE
	objekretribusi.idObjekRetribusi = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_pegawaiById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_pegawaiById`;
delimiter ;;
CREATE PROCEDURE `view_pegawaiById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	pegawai.idPegawai, 
	pegawai.nip, 
	pegawai.namaPegawai, 
	pegawai.idGolonganPangkat, 
	CONCAT(golonganPangkat.golongan, ' - ' ,golonganPangkat.pangkat) as golonganPangkat,
	pegawai.idJabatanBidang, 
	jabatanBidang.namaJabatanBidang, 
	provinces.prov_id,
	cities.city_id,
	districts.dis_id,
	pegawai.subdis_id, 
	pegawai.alamat,
	CONCAT(pegawai.alamat, ', ', (SELECT ucfirst (subdistricts.subdis_name)), ', ',(SELECT ucfirst (districts.dis_name)), ', ',(SELECT ucfirst (cities.city_name)), ', ',(SELECT ucfirst (provinces.prov_name))) as alamatLengkap,
	pegawai.fileFoto,
	bidang.namaBidang, 
	departemen.namaDepartmen,
	pegawai.nomorPonsel, 
	pegawai.nomorWhatsapp, 
	pegawai.fileFoto,
	(substring_index(pegawai.fileFoto,'/',-1)) as fileName
FROM
	pegawai
	INNER JOIN
	jabatanBidang
	ON 
		pegawai.idJabatanBidang = jabatanBidang.idJabatanBidang
	INNER JOIN
	golonganPangkat
	ON 
		pegawai.idGolonganPangkat = golonganPangkat.idGolonganPangkat
	INNER JOIN
	subdistricts
	ON 
		pegawai.subdis_id = subdistricts.subdis_id
	INNER JOIN
	districts
	ON 
		subdistricts.dis_id = districts.dis_id
	INNER JOIN
	cities
	ON 
		districts.city_id = cities.city_id
	INNER JOIN
	provinces
	ON 
		cities.prov_id = provinces.prov_id
	INNER JOIN
	bidang
	ON 
		jabatanBidang.idBidang = bidang.idBidang
	INNER JOIN
	departemen
	ON 
		bidang.idDepartemen = departemen.idDepartemen
WHERE
	pegawai.idPegawai = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_pekerjaanById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_pekerjaanById`;
delimiter ;;
CREATE PROCEDURE `view_pekerjaanById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	pekerjaan.idPekerjaan, 
	pekerjaan.namaPekerjaan, 
	pekerjaan.keterangan
FROM
	pekerjaan
WHERE
	pekerjaan.idPekerjaan = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_peruntukanSewaById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_peruntukanSewaById`;
delimiter ;;
CREATE PROCEDURE `view_peruntukanSewaById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	peruntukansewa.idperuntukanSewa, 
	peruntukansewa.idjenisKegiatan,
	jeniskegiatan.jenisKegiatan,
	peruntukansewa.peruntukanSewa,
	peruntukansewa.keterangan
FROM
	peruntukansewa
	INNER JOIN
	jeniskegiatan
	ON 
		`peruntukansewa`.idjenisKegiatan = jeniskegiatan.idjenisKegiatan
WHERE
	peruntukansewa.idperuntukanSewa = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_photoObjekRetribusiById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_photoObjekRetribusiById`;
delimiter ;;
CREATE PROCEDURE `view_photoObjekRetribusiById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	photoobjekretribusi.namaPhotoObjekRetribusi, 
	photoobjekretribusi.photoObjekRetribusi, 
	photoobjekretribusi.keterangan
FROM
	photoobjekretribusi
WHERE
	photoobjekretribusi.idObjekRetribusi = id;

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
	`status`.idStatus, 
	`status`.`namaStatus`, 
	`status`.idJenisStatus, 
	jenisstatus.jenisStatus, 
	`status`.keterangan
FROM
	`status`
	INNER JOIN
	jenisstatus
	ON 
		`status`.idJenisStatus = jenisstatus.idJenisStatus
WHERE
	`status`.idStatus = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_TarifObjekRetribusiById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_TarifObjekRetribusiById`;
delimiter ;;
CREATE PROCEDURE `view_TarifObjekRetribusiById`(IN `id` int)
BEGIN
	#Routine body goes here...
	SELECT
	tarifobjekretribusi.idTarifObjekRetribusi, 
	objekretribusi.idObjekRetribusi, 
	objekretribusi.kodeObjekRetribusi, 
	objekretribusi.objekRetribusi, 
	objekretribusi.noBangunan, 
	jenisobjekretribusi.jenisObjekRetribusi, 
	lokasiobjekretribusi.lokasiObjekRetribusi, 
	objekretribusi.idLokasiObjekRetribusi, 
	objekretribusi.idJenisObjekRetribusi, 
	objekretribusi.subdis_id, 
	objekretribusi.panjangTanah, 
	objekretribusi.lebarTanah, 
	objekretribusi.luasTanah, 
	objekretribusi.panjangBangunan, 
	objekretribusi.lebarBangunan, 
	objekretribusi.luasBangunan, 
	CONCAT(objekretribusi.alamat, ', ', (SELECT ucfirst (subdistricts.subdis_name)), ', ',(SELECT ucfirst (districts.dis_name)), ', ',(SELECT ucfirst (cities.city_name)), ', ',(SELECT ucfirst (provinces.prov_name))) as alamatLengkap,
	objekretribusi.jumlahLantai, 
	objekretribusi.kapasitas, 
	tarifobjekretribusi.idJenisJangkaWaktu, 
	jenisjangkawaktu.jenisJangkaWaktu, 
	tarifobjekretribusi.tanggalDinilai, 
	tarifobjekretribusi.namaPenilai, 
	tarifobjekretribusi.nominalTarif, 
	tarifobjekretribusi.keterangan, 
	tarifobjekretribusi.fileHasilPenilaian, 
	(substring_index(tarifobjekretribusi.fileHasilPenilaian,'/',-1)) as fileName
FROM
	objekretribusi
	INNER JOIN
	tarifobjekretribusi
	ON 
		objekretribusi.idObjekRetribusi = tarifobjekretribusi.idObjekRetribusi
	INNER JOIN
	jenisobjekretribusi
	ON 
		objekretribusi.idJenisObjekRetribusi = jenisobjekretribusi.idJenisObjekRetribusi
	INNER JOIN
	lokasiobjekretribusi
	ON 
		objekretribusi.idLokasiObjekRetribusi = lokasiobjekretribusi.idLokasiObjekRetribusi
	INNER JOIN
	subdistricts
	ON 
		objekretribusi.subdis_id = subdistricts.subdis_id
	INNER JOIN
	districts
	ON 
		subdistricts.dis_id = districts.dis_id
	INNER JOIN
	cities
	ON 
		districts.city_id = cities.city_id
	INNER JOIN
	provinces
	ON 
		cities.prov_id = provinces.prov_id
	INNER JOIN
	jenisjangkawaktu
	ON 
		tarifobjekretribusi.idJenisJangkaWaktu = jenisjangkawaktu.idJenisJangkaWaktu
WHERE
	tarifobjekretribusi.idTarifObjekRetribusi = id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_userById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_userById`;
delimiter ;;
CREATE PROCEDURE `view_userById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	`user`.userId, 
	jenisUser.idJenisUser, 
	userRole.idUserRole, 
	`user`.idPersonal, 
	`user`.username, 
	`user`.`password`, 
	`user`.token, 
	`user`.email, 
	`user`.keterangan
FROM
	`user`
	INNER JOIN
	jenisUser
	ON 
		`user`.idJenisUser = jenisUser.idJenisUser
	INNER JOIN
	userRole
	ON 
		`user`.idUserRole = userRole.idUserRole
WHERE
	`user`.userId = id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for view_WajibRetribusiById
-- ----------------------------
DROP PROCEDURE IF EXISTS `view_WajibRetribusiById`;
delimiter ;;
CREATE PROCEDURE `view_WajibRetribusiById`(IN `id` int)
BEGIN
	#Routine body goes here...
SELECT
	wajibretribusi.idWajibRetribusi, 
	wajibretribusi.nik, 
	wajibretribusi.idJenisWajibRetribusi, 
	jenisWajibRetribusi.namaJenisWajibRetribusi, 
	wajibretribusi.namaWajibRetribusi, 
	wajibretribusi.idPekerjaan, 
	pekerjaan.namaPekerjaan, 
	wajibretribusi.subdis_id,
	CONCAT(wajibretribusi.alamat, ', ', (SELECT ucfirst (subdistricts.subdis_name)), ', ',(SELECT ucfirst (districts.dis_name)), ', ',(SELECT ucfirst (cities.city_name)), ', ',(SELECT ucfirst (provinces.prov_name))) as alamatLengkap, 
	wajibretribusi.nomorPonsel, 
	wajibretribusi.nomorWhatsapp, 
	wajibretribusi.email, 
	wajibretribusi.fotoWajibRetribusi
FROM
	wajibretribusi
	INNER JOIN
	jenisWajibRetribusi
	ON 
		wajibretribusi.idJenisWajibRetribusi = jenisWajibRetribusi.idJenisWajibRetribusi
	INNER JOIN
	pekerjaan
	ON 
		wajibretribusi.idPekerjaan = pekerjaan.idPekerjaan
	INNER JOIN
	subdistricts
	ON 
		wajibretribusi.subdis_id = subdistricts.subdis_id
	INNER JOIN
	districts
	ON 
		subdistricts.dis_id = districts.dis_id
	INNER JOIN
	cities
	ON 
		districts.city_id = cities.city_id
	INNER JOIN
	provinces
	ON 
		cities.prov_id = provinces.prov_id
WHERE
	wajibretribusi.idWajibRetribusi = id;

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
