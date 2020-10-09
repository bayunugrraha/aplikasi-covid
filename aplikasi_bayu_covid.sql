SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_admin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin`  (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_admin
-- ----------------------------
INSERT INTO `tbl_admin` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `tbl_admin` VALUES (2, 'bayu', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `tbl_admin` VALUES (4, 'test', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO `tbl_admin` VALUES (5, 'test123', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for tbl_covid_province
-- ----------------------------
DROP TABLE IF EXISTS `tbl_covid_province`;
CREATE TABLE `tbl_covid_province`  (
  `covid_province_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_province` int(11) NULL DEFAULT NULL,
  `kasus` int(11) NULL DEFAULT NULL,
  `akumulasi_meninggal` int(11) NULL DEFAULT NULL,
  `akumulasi_sembuh` int(11) NULL DEFAULT NULL,
  `rawat_isolasi` int(11) NULL DEFAULT NULL,
  `tanggal` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `akumulasi_kasus` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`covid_province_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_covid_province
-- ----------------------------
INSERT INTO `tbl_covid_province` VALUES (1, 21, 10, 2, 20, 27, '2020-06-21', 49);
INSERT INTO `tbl_covid_province` VALUES (2, 1, 37, 7, 596, 438, '2020-06-21', 1041);
INSERT INTO `tbl_covid_province` VALUES (3, 2, 1, 2, 107, 39, '2020-06-21', 148);
INSERT INTO `tbl_covid_province` VALUES (4, 3, 8, 78, 570, 649, '2020-06-21', 1297);
INSERT INTO `tbl_covid_province` VALUES (5, 4, 9, 8, 71, 37, '2020-06-21', 116);
INSERT INTO `tbl_covid_province` VALUES (6, 6, 146, 566, 5015, 3895, '2020-06-21', 9476);
INSERT INTO `tbl_covid_province` VALUES (7, 7, 7, 8, 138, 81, '2020-06-21', 227);
INSERT INTO `tbl_covid_province` VALUES (8, 8, 3, 0, 46, 65, '2020-06-21', 111);
INSERT INTO `tbl_covid_province` VALUES (9, 9, 21, 166, 1259, 1423, '2020-06-21', 2848);
INSERT INTO `tbl_covid_province` VALUES (10, 10, 99, 135, 935, 1587, '2020-06-21', 2657);
INSERT INTO `tbl_covid_province` VALUES (11, 12, 2, 2, 194, 99, '2020-06-21', 295);
INSERT INTO `tbl_covid_province` VALUES (12, 13, 94, 165, 395, 2008, '2020-06-21', 2568);
INSERT INTO `tbl_covid_province` VALUES (13, 14, 26, 45, 254, 461, '2020-06-21', 760);
INSERT INTO `tbl_covid_province` VALUES (14, 15, 11, 5, 320, 106, '2020-06-21', 431);
INSERT INTO `tbl_covid_province` VALUES (15, 16, 1, 2, 149, 25, '2020-06-21', 176);
INSERT INTO `tbl_covid_province` VALUES (16, 17, 15, 15, 180, 79, '2020-06-21', 274);
INSERT INTO `tbl_covid_province` VALUES (17, 18, 1, 12, 121, 47, '2020-06-21', 180);
INSERT INTO `tbl_covid_province` VALUES (18, 19, 22, 13, 160, 430, '2020-06-21', 603);
INSERT INTO `tbl_covid_province` VALUES (19, 20, 11, 23, 56, 332, '2020-06-21', 411);
INSERT INTO `tbl_covid_province` VALUES (20, 22, 5, 44, 721, 289, '2020-06-21', 1054);
INSERT INTO `tbl_covid_province` VALUES (21, 23, 3, 1, 40, 70, '2020-06-21', 111);
INSERT INTO `tbl_covid_province` VALUES (22, 24, 49, 7, 297, 1124, '2020-06-21', 1428);
INSERT INTO `tbl_covid_province` VALUES (23, 25, 2, 2, 128, 94, '2020-06-21', 224);
INSERT INTO `tbl_covid_province` VALUES (24, 26, 8, 8, 114, 19, '2020-06-21', 141);
INSERT INTO `tbl_covid_province` VALUES (25, 27, 5, 2, 76, 26, '2020-06-21', 104);
INSERT INTO `tbl_covid_province` VALUES (26, 28, 112, 137, 1282, 2377, '2020-06-21', 3796);
INSERT INTO `tbl_covid_province` VALUES (27, 29, 1, 4, 130, 39, '2020-06-21', 173);
INSERT INTO `tbl_covid_province` VALUES (28, 30, 3, 5, 214, 113, '2020-06-21', 332);
INSERT INTO `tbl_covid_province` VALUES (29, 31, 45, 67, 142, 642, '2020-06-21', 851);
INSERT INTO `tbl_covid_province` VALUES (30, 32, 4, 30, 503, 174, '2020-06-21', 707);
INSERT INTO `tbl_covid_province` VALUES (31, 33, 58, 67, 751, 960, '2020-06-21', 1778);
INSERT INTO `tbl_covid_province` VALUES (32, 34, 13, 70, 259, 759, '2020-06-21', 1088);
INSERT INTO `tbl_covid_province` VALUES (33, 5, 3, 8, 231, 34, '2020-06-21', 273);
INSERT INTO `tbl_covid_province` VALUES (34, 11, 101, 714, 2777, 6002, '2020-06-21', 9493);

-- ----------------------------
-- Table structure for tbl_province
-- ----------------------------
DROP TABLE IF EXISTS `tbl_province`;
CREATE TABLE `tbl_province`  (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `prov_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`prov_auto_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_province
-- ----------------------------
INSERT INTO `tbl_province` VALUES (1, 'Bali', 1);
INSERT INTO `tbl_province` VALUES (2, 'Bangka Belitung', 2);
INSERT INTO `tbl_province` VALUES (3, 'Banten', 3);
INSERT INTO `tbl_province` VALUES (4, 'Bengkulu', 4);
INSERT INTO `tbl_province` VALUES (5, 'DI Yogyakarta', 5);
INSERT INTO `tbl_province` VALUES (6, 'DKI Jakarta', 6);
INSERT INTO `tbl_province` VALUES (7, 'Gorontalo', 7);
INSERT INTO `tbl_province` VALUES (8, 'Jambi', 8);
INSERT INTO `tbl_province` VALUES (9, 'Jawa Barat', 9);
INSERT INTO `tbl_province` VALUES (10, 'Jawa Tengah', 10);
INSERT INTO `tbl_province` VALUES (11, 'Jawa Timur', 11);
INSERT INTO `tbl_province` VALUES (12, 'Kalimantan Barat', 12);
INSERT INTO `tbl_province` VALUES (13, 'Kalimantan Selatan', 13);
INSERT INTO `tbl_province` VALUES (14, 'Kalimantan Tengah', 14);
INSERT INTO `tbl_province` VALUES (15, 'Kalimantan Timur', 15);
INSERT INTO `tbl_province` VALUES (16, 'Kalimantan Utara', 16);
INSERT INTO `tbl_province` VALUES (17, 'Kepulauan Riau', 17);
INSERT INTO `tbl_province` VALUES (18, 'Lampung', 18);
INSERT INTO `tbl_province` VALUES (19, 'Maluku', 19);
INSERT INTO `tbl_province` VALUES (20, 'Maluku Utara', 20);
INSERT INTO `tbl_province` VALUES (21, 'Nanggroe Aceh Darussalam (NAD)', 21);
INSERT INTO `tbl_province` VALUES (22, 'Nusa Tenggara Barat (NTB)', 22);
INSERT INTO `tbl_province` VALUES (23, 'Nusa Tenggara Timur (NTT)', 23);
INSERT INTO `tbl_province` VALUES (24, 'Papua', 24);
INSERT INTO `tbl_province` VALUES (25, 'Papua Barat', 25);
INSERT INTO `tbl_province` VALUES (26, 'Riau', 26);
INSERT INTO `tbl_province` VALUES (27, 'Sulawesi Barat', 27);
INSERT INTO `tbl_province` VALUES (28, 'Sulawesi Selatan', 28);
INSERT INTO `tbl_province` VALUES (29, 'Sulawesi Tengah', 29);
INSERT INTO `tbl_province` VALUES (30, 'Sulawesi Tenggara', 30);
INSERT INTO `tbl_province` VALUES (31, 'Sulawesi Utara', 31);
INSERT INTO `tbl_province` VALUES (32, 'Sumatera Barat', 32);
INSERT INTO `tbl_province` VALUES (33, 'Sumatera Selatan', 33);
INSERT INTO `tbl_province` VALUES (34, 'Sumatera Utara', 34);

SET FOREIGN_KEY_CHECKS = 1;
