/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : examination

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-24 11:18:07
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
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `bid` int(10) DEFAULT NULL COMMENT '题库编号',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `cid` (`cid`),
  CONSTRAINT `cid` FOREIGN KEY (`cid`) REFERENCES `exam_course` (`id`),
  CONSTRAINT `tid` FOREIGN KEY (`tid`) REFERENCES `exam_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

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
-- Table structure for exam_user
-- ----------------------------
DROP TABLE IF EXISTS `exam_user`;
CREATE TABLE `exam_user` (
  `id` char(8) NOT NULL COMMENT '用户编号',
  `name` varchar(12) NOT NULL COMMENT '用户姓名',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `type` tinyint(1) NOT NULL COMMENT '用户类型',
  `sid` char(8) NOT NULL DEFAULT '0' COMMENT '对应系部',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`),
  CONSTRAINT `sid` FOREIGN KEY (`sid`) REFERENCES `exam_system` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- View structure for exam_arrangementview
-- ----------------------------
DROP VIEW IF EXISTS `exam_arrangementview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `exam_arrangementview` AS SELECT
exam_arrangement.id,
exam_arrangement.tid,
exam_arrangement.cid,
exam_arrangement.classname,
exam_arrangement.classnumber,
exam_user.`name` AS teachername,
exam_system.`name` AS systemname,
exam_course.`name` AS coursename,
exam_arrangement.updatetime
FROM
exam_arrangement
INNER JOIN exam_course ON exam_course.id = exam_arrangement.cid
INNER JOIN exam_system ON exam_system.id = exam_course.sid
INNER JOIN exam_user ON exam_user.id = exam_arrangement.tid ;

-- ----------------------------
-- View structure for exam_bankview
-- ----------------------------
DROP VIEW IF EXISTS `exam_bankview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `exam_bankview` AS SELECT
exam_bank.id,
exam_bank.savename,
exam_bank.tid,
exam_bank.cid,
exam_bank.`status`,
exam_bank.updatetime,
exam_user.`name` AS teachername,
exam_course.`name` AS coursename,
exam_course.sid,
exam_system.`name` AS systemname
FROM
exam_bank
INNER JOIN exam_user ON exam_user.id = exam_bank.tid
INNER JOIN exam_course ON exam_bank.cid = exam_course.id
INNER JOIN exam_system ON exam_system.id = exam_course.sid ;

-- ----------------------------
-- View structure for exam_courseview
-- ----------------------------
DROP VIEW IF EXISTS `exam_courseview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `exam_courseview` AS SELECT
exam_course.id,
exam_course.`name`,
exam_system.`name` AS systemname,
exam_course.updatetime
FROM
exam_course
INNER JOIN exam_system ON exam_system.id = exam_course.sid ;

-- ----------------------------
-- View structure for exam_examview
-- ----------------------------
DROP VIEW IF EXISTS `exam_examview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `exam_examview` AS SELECT
exam_arrangement.cid,
exam_course.`name` AS coursename,
exam_course.sid,
exam_system.`name` AS systemname,
(SELECT `name` FROM exam_user WHERE sid = exam_course.sid AND type = 1) AS deanname,
GROUP_CONCAT(exam_arrangement.classname) AS classname,
Sum(exam_arrangement.classnumber) AS classnumber,
exam_arrangement.`status`,
exam_arrangement.bid,
exam_bank.savename,
exam_bank.tid,
exam_user.`name` AS teachername,
exam_arrangement.updatetime,
GROUP_CONCAT(exam_arrangement.tid) AS tidlist,
GROUP_CONCAT(exam_teacher.`name`) AS teachernamelist
FROM
exam_arrangement
INNER JOIN exam_course ON exam_course.id = exam_arrangement.cid
INNER JOIN exam_system ON exam_system.id = exam_course.sid
LEFT JOIN exam_bank ON exam_bank.id = exam_arrangement.bid
LEFT JOIN exam_user ON exam_user.id = exam_bank.tid
INNER JOIN exam_user AS exam_teacher ON exam_teacher.id = exam_arrangement.tid
GROUP BY
exam_arrangement.cid ;

-- ----------------------------
-- View structure for exam_needview
-- ----------------------------
DROP VIEW IF EXISTS `exam_needview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `exam_needview` AS SELECT
exam_arrangement.id,
exam_arrangement.tid,
exam_arrangement.cid,
exam_user.`name` AS teachername,
exam_system.`name` AS systemname,
GROUP_CONCAT(exam_arrangement.classname) AS classname,
Sum(exam_arrangement.classnumber) AS classnumber,
exam_bank.savename,
exam_bank.id AS bankid,
exam_bank.`status`,
exam_course.`name` AS coursename,
exam_arrangement.bid,
exam_bank.updatetime,
exam_course.sid
FROM
exam_arrangement
INNER JOIN exam_course ON exam_arrangement.cid = exam_course.id
INNER JOIN exam_user ON exam_arrangement.tid = exam_user.id
INNER JOIN exam_system ON exam_user.sid = exam_system.id
LEFT JOIN exam_bank ON exam_bank.tid = exam_user.id
GROUP BY
exam_bank.id ;
