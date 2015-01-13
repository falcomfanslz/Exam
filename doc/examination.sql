/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : examination

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-13 15:35:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for exam_arrangement
-- ----------------------------
DROP TABLE IF EXISTS `exam_arrangement`;
CREATE TABLE `exam_arrangement` (
  `id` int(10) NOT NULL COMMENT '编号',
  `tid` char(8) NOT NULL COMMENT '教师编号',
  `cid` char(10) NOT NULL COMMENT '课程编号',
  `classname` varchar(30) NOT NULL COMMENT '班级名称',
  `classnumber` int(3) NOT NULL COMMENT '班级人数',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_arrangement
-- ----------------------------
INSERT INTO `exam_arrangement` VALUES ('1', '123456', '2', '软件12-1', '20', '2015-01-13 15:27:49');
INSERT INTO `exam_arrangement` VALUES ('2', '123456', '2', '软件12-2', '35', '2015-01-13 15:27:49');

-- ----------------------------
-- Table structure for exam_bank
-- ----------------------------
DROP TABLE IF EXISTS `exam_bank`;
CREATE TABLE `exam_bank` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '题库编号',
  `savename` char(30) NOT NULL COMMENT '储存名',
  `tid` char(8) NOT NULL COMMENT '出题教师编号',
  `cid` char(10) NOT NULL COMMENT '课程编号',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_bank
-- ----------------------------

-- ----------------------------
-- Table structure for exam_course
-- ----------------------------
DROP TABLE IF EXISTS `exam_course`;
CREATE TABLE `exam_course` (
  `id` char(10) NOT NULL COMMENT '课程编号',
  `name` varchar(30) NOT NULL COMMENT '课程名称',
  `sid` char(8) NOT NULL COMMENT '对应系部',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_course
-- ----------------------------
INSERT INTO `exam_course` VALUES ('2', 'JSP程序设计', '1', '2015-01-13 14:26:24');

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
-- Records of exam_exam
-- ----------------------------

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
-- Records of exam_system
-- ----------------------------
INSERT INTO `exam_system` VALUES ('1', '软件工程系', '2015-01-12 15:29:23');
INSERT INTO `exam_system` VALUES ('2', '基础部', '2015-01-12 15:30:58');

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
-- Records of exam_us
-- ----------------------------

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

-- ----------------------------
-- Records of exam_user
-- ----------------------------
INSERT INTO `exam_user` VALUES ('123456', '李老师', '123456', '2', '2015-01-13 14:27:06');

-- ----------------------------
-- View structure for exam_arrangementview
-- ----------------------------
DROP VIEW IF EXISTS `exam_arrangementview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `exam_arrangementview` AS SELECT
exam_arrangement.tid,
exam_arrangement.cid,
exam_arrangement.classname,
exam_arrangement.classnumber,
exam_arrangement.updatetime,
exam_user.`name` AS teachername,
exam_system.`name` AS systemname,
exam_course.`name` AS coursename,
exam_arrangement.id
FROM
exam_arrangement
INNER JOIN exam_course ON exam_course.id = exam_arrangement.cid
INNER JOIN exam_system ON exam_system.id = exam_course.sid
INNER JOIN exam_user ON exam_user.id = exam_arrangement.tid ;

-- ----------------------------
-- View structure for exam_courseview
-- ----------------------------
DROP VIEW IF EXISTS `exam_courseview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `exam_courseview` AS SELECT
exam_course.id,
exam_course.`name`,
exam_system.`name` AS SystemName,
exam_course.updatetime
FROM
exam_course
INNER JOIN exam_system ON exam_system.id = exam_course.sid ;
