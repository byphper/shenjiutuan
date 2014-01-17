/*
Navicat MySQL Data Transfer

Source Server         : localshot
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : sjt

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-01-17 18:49:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `booktickets`
-- ----------------------------
DROP TABLE IF EXISTS `booktickets`;
CREATE TABLE `booktickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `maxnums` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of booktickets
-- ----------------------------

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `user` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `status` smallint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('11', '金馬影帝得住', '<p><img src=\"http://localhost/shenjiutuan/sjt/ueditor/php/upload1//20140117/1389951394659591.jpg\"/></p>', '深圳-影帝', '2014-01-17 17:45:44', '0');
INSERT INTO `news` VALUES ('12', '我不足歐大哥豪賭您', '<p><img src=\"http://localhost/shenjiutuan/sjt/ueditor/php/upload1//20140117/1389951394659591.jpg\"/></p>', '深圳-影帝', '2014-01-17 18:34:08', '0');

-- ----------------------------
-- Table structure for `ticket_logs`
-- ----------------------------
DROP TABLE IF EXISTS `ticket_logs`;
CREATE TABLE `ticket_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `nums` int(11) NOT NULL,
  `style` int(11) NOT NULL,
  `goadd` varchar(20) NOT NULL,
  `isPay` smallint(6) NOT NULL,
  `remark` int(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket_logs
-- ----------------------------

-- ----------------------------
-- Table structure for `userinfo`
-- ----------------------------
DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `pwd` char(32) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `isVip` smallint(6) NOT NULL,
  `isYear` smallint(6) NOT NULL,
  `isAdmin` smallint(6) NOT NULL,
  `address` int(32) NOT NULL,
  `joindate` datetime NOT NULL,
  `last_date` datetime NOT NULL,
  `last_ip` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userinfo
-- ----------------------------
INSERT INTO `userinfo` VALUES ('1', '深圳-影帝', '123@163.com', 'd792f730bfb29f19918c1f6935ff1790', '18318873015', '1', '1', '1', '0', '2013-12-03 04:14:18', '2014-01-17 17:44:05', '127.0.0.1');
