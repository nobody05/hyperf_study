/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 08/09/2020 10:34:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '昵称',
  `mobile` varchar(255) NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT '' COMMENT '所在国家',
  `province` varchar(255) NOT NULL DEFAULT '' COMMENT '所在省',
  `city` varchar(255) NOT NULL DEFAULT '' COMMENT '所在城市',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `mobile` (`mobile`),
  KEY `nickname` (`nickname`(191))
) ENGINE=InnoDB AUTO_INCREMENT=1565555 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
