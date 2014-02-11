/*
Navicat MySQL Data Transfer

Source Server         : localshot
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : sjt

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-02-11 17:49:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `about`
-- ----------------------------
DROP TABLE IF EXISTS `about`;
CREATE TABLE `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of about
-- ----------------------------
INSERT INTO `about` VALUES ('1', '<p>asdfasdfasdfasdfsadfasdfasdf121212121212121212121212121212121212121212</p>', '2014-02-11 17:36:31');

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
  `match_time` datetime DEFAULT NULL,
  `match_address` varchar(20) DEFAULT NULL,
  `ticket_cost` int(11) DEFAULT NULL,
  `car_cost` int(11) DEFAULT NULL,
  `match_op` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of booktickets
-- ----------------------------
INSERT INTO `booktickets` VALUES ('12', 'xxxxxxxxxxxxx', '', '0', '0', '2014-02-11 11:58:08', '2014-02-11 11:58:02', 'xxsdfsdf', '11', '11', 'aaaaaaaa');

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
  `status` smallint(2) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('13', '信不信你我削你MBA', '<p><span style=\"font-size: 36px;\"><strong>大哥別啊</strong></span></p>', '深圳-影帝', '2014-01-22 17:24:11', '1', '3');
INSERT INTO `news` VALUES ('17', '是不是要緊到費嘛', '<p>上去做作業</p>', '深圳-影帝', '2014-01-22 18:07:39', '0', '0');
INSERT INTO `news` VALUES ('30', '穆妮奇已經決定離開廣州恒大，遠赴西亞', '<p>oh my god</p>', '深圳-影帝', '2014-01-29 14:33:07', '1', '6');

-- ----------------------------
-- Table structure for `party`
-- ----------------------------
DROP TABLE IF EXISTS `party`;
CREATE TABLE `party` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `status` smallint(6) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of party
-- ----------------------------
INSERT INTO `party` VALUES ('1', '龙泉酒店聚会看球', '是打发士大夫啊是的', '1', '2014-02-12 00:00:00');
INSERT INTO `party` VALUES ('3', '香蜜湖聚會開球', 'fafafd', '1', '2014-02-10 22:27:10');
INSERT INTO `party` VALUES ('4', '布吉貴族酒吧看球活動', '喝酒把妹  打灰機哦   哈哈哈', '1', '2014-02-10 22:30:57');

-- ----------------------------
-- Table structure for `party_logs`
-- ----------------------------
DROP TABLE IF EXISTS `party_logs`;
CREATE TABLE `party_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `nums` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of party_logs
-- ----------------------------
INSERT INTO `party_logs` VALUES ('3', '1', '123', 'cookie', '11', '2014-02-08 00:00:00');

-- ----------------------------
-- Table structure for `ticket_logs`
-- ----------------------------
DROP TABLE IF EXISTS `ticket_logs`;
CREATE TABLE `ticket_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `ticket_nums` int(11) NOT NULL,
  `car_nums` int(11) unsigned NOT NULL,
  `watch_nums` int(11) NOT NULL,
  `style` int(11) NOT NULL,
  `goadd` varchar(20) NOT NULL,
  `isPay` smallint(6) NOT NULL,
  `remark` int(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket_logs
-- ----------------------------
INSERT INTO `ticket_logs` VALUES ('2', '12', '123', '文工團', '9', '2', '4', '0', '不跟車', '0', '0', '2014-02-11 12:35:30');

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
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userinfo
-- ----------------------------
INSERT INTO `userinfo` VALUES ('1', '大哥', 'yongge@163.com', 'e10adc3949ba59abbe56e057f20f883e', '18318873015', '1', '1', '1', '0', '2013-12-03 04:14:18', '2014-02-11 10:39:39', '127.0.0.1', '1');
INSERT INTO `userinfo` VALUES ('2', '文工團', 'by@163.com', 'e10adc3949ba59abbe56e057f20f883e', '', '0', '0', '0', '0', '2014-02-11 12:30:53', '2014-02-11 12:30:53', '127.0.0.1', '1');
