/*
Navicat MySQL Data Transfer

Source Server         : localshot
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : sjt

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-01-29 17:38:53
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
  `status` smallint(2) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('13', '信不信你我削你MBA', '<p><span style=\"font-size: 36px;\"><strong>大哥別啊</strong></span></p>', '深圳-影帝', '2014-01-22 17:24:11', '1', '0');
INSERT INTO `news` VALUES ('15', '你這不是坑人嗎', '<p>就坑你，咋啦</p>', '深圳-影帝', '2014-01-22 17:55:19', '0', '0');
INSERT INTO `news` VALUES ('16', '哦喲，你不得了', '<p>該你吃為<br/></p>', '深圳-影帝', '2014-01-22 17:58:50', '1', '0');
INSERT INTO `news` VALUES ('17', '是不是要緊到費嘛', '<p>上去做作業</p>', '深圳-影帝', '2014-01-22 18:07:39', '0', '0');
INSERT INTO `news` VALUES ('26', '好野啊', '<p>哦了哦了哦了哦了<br/></p>', '深圳-影帝', '2014-01-22 18:52:25', '1', '0');
INSERT INTO `news` VALUES ('27', '有種再說一次喃', '<p><strong>今天下午放學等到</strong><br/></p>', '深圳-影帝', '2014-01-28 11:07:15', '1', '0');
INSERT INTO `news` VALUES ('28', '我願意為你', '<p><span style=\"text-decoration: underline;\"><em><strong>忘記我姓名</strong></em></span></p>', '深圳-影帝', '2014-01-28 11:08:00', '1', '0');
INSERT INTO `news` VALUES ('29', '今夜你會不會來哦', '<p>那是必須的撒</p>', '深圳-影帝', '2014-01-29 14:32:17', '1', '0');
INSERT INTO `news` VALUES ('30', '穆妮奇已經決定離開廣州恒大，遠赴西亞', '<p>oh my god</p>', '深圳-影帝', '2014-01-29 14:33:07', '1', '0');

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
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userinfo
-- ----------------------------
INSERT INTO `userinfo` VALUES ('1', '深圳-影帝', '123@163.com', 'e10adc3949ba59abbe56e057f20f883e', '18318873015', '1', '1', '1', '0', '2013-12-03 04:14:18', '2014-01-29 14:13:57', '127.0.0.1', '1');
