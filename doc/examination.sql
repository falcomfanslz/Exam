/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : examinationtest

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-04-10 07:55:46
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
-- Records of exam_arrangement
-- ----------------------------
INSERT INTO `exam_arrangement` VALUES ('1', '11111', '123456', '软件12-2', '20', '2', '26', '2015-04-06 10:15:03');

-- ----------------------------
-- Table structure for exam_bank
-- ----------------------------
DROP TABLE IF EXISTS `exam_bank`;
CREATE TABLE `exam_bank` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '题库编号',
  `savename` char(30) NOT NULL COMMENT '储存名',
  `tid` char(8) NOT NULL COMMENT '出题教师编号',
  `cid` char(10) NOT NULL COMMENT '课程编号',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '状态',
  `updatetime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_bank
-- ----------------------------
INSERT INTO `exam_bank` VALUES ('23', '55238f066d24c.pdf', '11111', '123456', '0', '2015-04-07 16:02:14');
INSERT INTO `exam_bank` VALUES ('24', '55238f0e60679.pdf', '11111', '123456', '0', '2015-04-07 16:02:22');
INSERT INTO `exam_bank` VALUES ('25', '552394317e673.pdf', '11111', '123456', '4', '2015-04-07 16:24:17');
INSERT INTO `exam_bank` VALUES ('26', '55239d9a9b17a.pdf', '11111', '123456', '5', '2015-04-07 17:04:26');
INSERT INTO `exam_bank` VALUES ('27', '55239db1f393d.pdf', '11111', '123456', '1', '2015-04-07 17:04:49');

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
INSERT INTO `exam_course` VALUES ('123456', 'C语言', '1', '2015-03-17 13:40:32');

-- ----------------------------
-- Table structure for exam_status
-- ----------------------------
DROP TABLE IF EXISTS `exam_status`;
CREATE TABLE `exam_status` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `usertype` varchar(255) NOT NULL COMMENT '用户种类',
  `classname` varchar(255) NOT NULL COMMENT '类名',
  `actionname` varchar(255) NOT NULL COMMENT '方法名',
  `statusid` int(2) NOT NULL COMMENT '状态编号',
  `istrue` tinyint(1) NOT NULL COMMENT '是否为真',
  `updatetime` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_status
-- ----------------------------
INSERT INTO `exam_status` VALUES ('4', 'Admin', 'Course', 'index', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `exam_status` VALUES ('5', 'Admin', 'Course', 'add', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `exam_status` VALUES ('6', 'Admin', 'Course', 'delete', '0', '1', '0000-00-00 00:00:00');

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
INSERT INTO `exam_system` VALUES ('0', '管理员', '2015-03-17 13:35:24');
INSERT INTO `exam_system` VALUES ('0003', '打印社', '0000-00-00 00:00:00');
INSERT INTO `exam_system` VALUES ('1', '软件工程系', '2015-03-17 13:33:10');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_user
-- ----------------------------
INSERT INTO `exam_user` VALUES ('11111', '教师1', '123456', '2', '1', '2015-03-24 12:58:33');
INSERT INTO `exam_user` VALUES ('11112', '教师2', '123456', '2', '1', '2015-04-09 14:28:39');
INSERT INTO `exam_user` VALUES ('123456', '管理员', '123456', '0', '0', '2015-03-17 13:26:13');
INSERT INTO `exam_user` VALUES ('22222', '系主任1', '123456', '1', '1', '2015-04-09 14:28:41');
INSERT INTO `exam_user` VALUES ('33333', '打印社', '123456', '3', '0003', '2015-04-09 14:28:29');

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
exam_arrangement.updatetime,
exam_system.id AS sid
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
INNER JOIN exam_system ON exam_system.id = exam_course.sid ; ;

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
INNER JOIN exam_system ON exam_system.id = exam_course.sid ; ;

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
exam_arrangement.cid ; ;

-- ----------------------------
-- View structure for exam_needview
-- ----------------------------
DROP VIEW IF EXISTS `exam_needview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `exam_needview` AS SELECT
this_arrangement.id,
this_arrangement.tid,
this_arrangement.cid,
this_arrangement.bid,
exam_user.`name` AS teachername,
exam_system.`name` AS systemname,
this_arrangement.classname,
(SELECT count(*) FROM exam_bank WHERE exam_bank.cid = this_arrangement.cid AND exam_bank.tid = this_arrangement.tid AND (exam_bank.`status`=4 OR exam_bank.`status`=5)) AS examnumber,
(SELECT count(*)*2 FROM exam_arrangement WHERE exam_arrangement.cid = this_arrangement.cid) AS neednumber,
exam_course.`name` AS coursename,
exam_system.id AS sid
FROM
exam_arrangement AS this_arrangement
INNER JOIN exam_course ON this_arrangement.cid = exam_course.id
INNER JOIN exam_user ON this_arrangement.tid = exam_user.id
INNER JOIN exam_system ON exam_user.sid = exam_system.id ;

-- ----------------------------
-- View structure for exam_needviewtest
-- ----------------------------
DROP VIEW IF EXISTS `exam_needviewtest`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `exam_needviewtest` AS SELECT
exam_user.`name` AS teachername,
exam_course.`name` AS coursename,
exam_system.`name` AS systemname,
GROUP_CONCAT(exam_arrangement.classname) AS classname,
Sum(exam_arrangement.classnumber) AS classnumber,
exam_bank.savename,
exam_bank.id AS bankid
FROM
exam_bank
INNER JOIN exam_arrangement ON exam_bank.id = exam_arrangement.bid
INNER JOIN exam_course ON exam_arrangement.cid = exam_course.id
INNER JOIN exam_system ON exam_system.id = exam_course.sid
INNER JOIN exam_user ON exam_arrangement.tid = exam_user.id AND exam_user.id = exam_bank.tid ; ;

-- ----------------------------
-- View structure for exam_teacherview
-- ----------------------------
DROP VIEW IF EXISTS `exam_teacherview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `exam_teacherview` AS SELECT
exam_user.`name` AS teachername,
(SELECT COUNT(*) FROM exam_bank WHERE tid=exam_arrangement.tid AND (status=3 or status=4)) AS examnumber,
exam_user.id AS tid,
exam_arrangement.cid
FROM
exam_arrangement
INNER JOIN exam_user ON exam_arrangement.tid = exam_user.id ;

-- ----------------------------
-- View structure for exam_userview
-- ----------------------------
DROP VIEW IF EXISTS `exam_userview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `exam_userview` AS SELECT
exam_user.id,
exam_user.`name` AS Username,
exam_user.type,
exam_user.updatetime,
exam_system.`name`
FROM
exam_user
INNER JOIN exam_system ON exam_user.sid = exam_system.id ;
