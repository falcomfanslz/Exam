/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : examination

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-12 12:54:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for exam_arrangement
-- ----------------------------
DROP TABLE IF EXISTS `exam_arrangement`;
CREATE TABLE `exam_arrangement` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `tid` char(8) NOT NULL COMMENT '教师编号',
  `cid` char(10) NOT NULL COMMENT '课程编号',
  `classname` varchar(30) NOT NULL COMMENT '班级名称',
  `classnumber` int(3) NOT NULL COMMENT '班级人数',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exam_bank
-- ----------------------------
DROP TABLE IF EXISTS `exam_bank`;
CREATE TABLE `exam_bank` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '题库编号',
  `tid` char(8) NOT NULL COMMENT '出题教师编号',
  `cid` char(10) NOT NULL COMMENT '课程编号',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exam_course
-- ----------------------------
DROP TABLE IF EXISTS `exam_course`;
CREATE TABLE `exam_course` (
  `id` char(10) NOT NULL COMMENT '课程编号',
  `name` varchar(30) NOT NULL COMMENT '课程名称',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exam_exam
-- ----------------------------
DROP TABLE IF EXISTS `exam_exam`;
CREATE TABLE `exam_exam` (
  `cid` char(10) NOT NULL COMMENT '课程编号',
  `type` tinyint(1) NOT NULL COMMENT '考试性质',
  `status` tinyint(1) NOT NULL COMMENT '考试状态',
  `bid` int(10) NOT NULL COMMENT '题库编号',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exam_system
-- ----------------------------
DROP TABLE IF EXISTS `exam_system`;
CREATE TABLE `exam_system` (
  `id` char(8) NOT NULL COMMENT '系部编号',
  `name` varchar(30) NOT NULL COMMENT '系部名称',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exam_us
-- ----------------------------
DROP TABLE IF EXISTS `exam_us`;
CREATE TABLE `exam_us` (
  `uid` char(8) NOT NULL COMMENT '用户编号',
  `sid` char(8) NOT NULL COMMENT '系部编号',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`uid`,`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exam_user
-- ----------------------------
DROP TABLE IF EXISTS `exam_user`;
CREATE TABLE `exam_user` (
  `id` char(8) NOT NULL COMMENT '用户编号',
  `name` varchar(12) NOT NULL COMMENT '用户姓名',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `type` tinyint(1) NOT NULL COMMENT '用户类型',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
