/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : upliftk12db

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 31/07/2020 14:40:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for invites
-- ----------------------------
DROP TABLE IF EXISTS `invites`;
CREATE TABLE `invites`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NULL DEFAULT NULL,
  `students` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of invites
-- ----------------------------
INSERT INTO `invites` VALUES (1, 1, '{\"0\":\"25\",\"2\":\"30\",\"3\":\"37\"}', '2020-07-30 14:21:09', '2020-07-31 06:22:19');
INSERT INTO `invites` VALUES (2, 4, '[\"48\"]', '2020-07-30 18:35:39', '2020-07-30 18:35:39');

SET FOREIGN_KEY_CHECKS = 1;
