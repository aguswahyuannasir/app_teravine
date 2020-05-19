/*
 Navicat Premium Data Transfer

 Source Server         : mysql_localhost
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : db_teravine

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 19/05/2020 11:15:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_alamat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_alamat`;
CREATE TABLE `tbl_alamat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `us_id` int(11) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_alamat
-- ----------------------------
BEGIN;
INSERT INTO `tbl_alamat` VALUES (7, 18, 'alamat test3 2');
INSERT INTO `tbl_alamat` VALUES (8, 18, 'alamat test3 3');
INSERT INTO `tbl_alamat` VALUES (9, 18, 'alamat test3 4');
INSERT INTO `tbl_alamat` VALUES (10, 19, 'test 4 B');
COMMIT;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text,
  `alamat_1` text,
  `alamat_2` text,
  `alamat_3` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
BEGIN;
INSERT INTO `tbl_user` VALUES (16, 'Test 1', 81, 'test1@test.com', 'test 1', NULL, NULL, NULL);
INSERT INTO `tbl_user` VALUES (17, 'Test 2', 82, 'test2@test.com', 'test 2', NULL, NULL, NULL);
INSERT INTO `tbl_user` VALUES (18, 'Test 3', 83, 'test3@test.com', 'alamat test3 1', NULL, NULL, NULL);
INSERT INTO `tbl_user` VALUES (19, 'Test 4', 84, 'test4@test.com', 'test 4 A', NULL, NULL, NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
