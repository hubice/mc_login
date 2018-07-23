/*
Navicat MySQL Data Transfer

Source Server         : www_pan233_com
Source Server Version : 50719
Source Host           : 118.25.50.31:3306
Source Database       : www_pan233_com

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-07-23 21:19:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mc_user
-- ----------------------------
DROP TABLE IF EXISTS `mc_user`;
CREATE TABLE `mc_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户授权id',
  `uuid` varchar(100) NOT NULL DEFAULT '',
  `sort` tinyint(4) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `properties` text COMMENT '属性json',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 ok',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for mc_user_auth
-- ----------------------------
DROP TABLE IF EXISTS `mc_user_auth`;
CREATE TABLE `mc_user_auth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(100) NOT NULL DEFAULT '' COMMENT 'UUID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `client_token` varchar(100) NOT NULL DEFAULT '' COMMENT '客户端token',
  `access_token` varchar(100) NOT NULL DEFAULT '' COMMENT '服务的token',
  `access_token_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间',
  `properties` varchar(255) NOT NULL DEFAULT '' COMMENT '用户元数据',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 ok',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
