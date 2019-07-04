/*
Navicat MySQL Data Transfer

Source Server         : 本地网络
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : k3

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-12 16:20:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `caipiao_admingroup`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_admingroup`;
CREATE TABLE `caipiao_admingroup` (
  `groupid` smallint(6) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(30) NOT NULL,
  `level` smallint(6) NOT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_admingroup
-- ----------------------------
INSERT INTO `caipiao_admingroup` VALUES ('1', '超级管理员', '1');
INSERT INTO `caipiao_admingroup` VALUES ('2', '普通管理员', '2');

-- ----------------------------
-- Table structure for `caipiao_adminlog`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_adminlog`;
CREATE TABLE `caipiao_adminlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `username` char(60) NOT NULL,
  `type` char(20) NOT NULL COMMENT 'login 登入，logout 登出，act 操作',
  `info` varchar(60) NOT NULL,
  `ip` char(20) NOT NULL,
  `iparea` varchar(60) NOT NULL COMMENT 'ip地区',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=235 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_adminlog
-- ----------------------------
INSERT INTO `caipiao_adminlog` VALUES ('1', '1', 'administrator', 'login', '登陆成功', '115.164.221.173', '马来西亚', '1488524613');
INSERT INTO `caipiao_adminlog` VALUES ('2', '1', 'administrator', 'login', '登陆成功', '115.164.221.173', '马来西亚', '1488529807');
INSERT INTO `caipiao_adminlog` VALUES ('3', '1', 'administrator', 'login', '登陆成功', '115.164.221.173', '马来西亚', '1488539052');
INSERT INTO `caipiao_adminlog` VALUES ('4', '1', 'administrator', 'login', '登陆成功', '115.164.221.173', '马来西亚', '1488539460');
INSERT INTO `caipiao_adminlog` VALUES ('5', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1493175249');
INSERT INTO `caipiao_adminlog` VALUES ('6', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1493189939');
INSERT INTO `caipiao_adminlog` VALUES ('7', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号URU1704261458247879,会员：hjjfukfu', '127.0.0.1', '本机地址', '1493189979');
INSERT INTO `caipiao_adminlog` VALUES ('8', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1493194723');
INSERT INTO `caipiao_adminlog` VALUES ('9', '1', 'administrator', 'logout', '退出登陆', '127.0.0.1', '本机地址', '1493197120');
INSERT INTO `caipiao_adminlog` VALUES ('10', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1493197126');
INSERT INTO `caipiao_adminlog` VALUES ('11', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1493197496');
INSERT INTO `caipiao_adminlog` VALUES ('12', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1493200386');
INSERT INTO `caipiao_adminlog` VALUES ('13', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494297593');
INSERT INTO `caipiao_adminlog` VALUES ('14', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494298240');
INSERT INTO `caipiao_adminlog` VALUES ('15', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494299671');
INSERT INTO `caipiao_adminlog` VALUES ('16', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494299753');
INSERT INTO `caipiao_adminlog` VALUES ('17', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494313930');
INSERT INTO `caipiao_adminlog` VALUES ('18', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494376357');
INSERT INTO `caipiao_adminlog` VALUES ('19', '1', 'administrator', 'login', '登陆成功', '192.168.0.104', '局域网', '1494377909');
INSERT INTO `caipiao_adminlog` VALUES ('20', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494378336');
INSERT INTO `caipiao_adminlog` VALUES ('21', '1', 'administrator', 'logout', '退出登陆', '0.0.0.0', 'IANA保留地址', '1494378376');
INSERT INTO `caipiao_adminlog` VALUES ('22', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494378386');
INSERT INTO `caipiao_adminlog` VALUES ('23', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号LZV1705100904532680,会员：zggcdyz', '127.0.0.1', '本机地址', '1494378715');
INSERT INTO `caipiao_adminlog` VALUES ('24', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号XYA1705100926022004,会员：zggcdyz', '127.0.0.1', '本机地址', '1494379594');
INSERT INTO `caipiao_adminlog` VALUES ('25', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494380265');
INSERT INTO `caipiao_adminlog` VALUES ('26', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494397695');
INSERT INTO `caipiao_adminlog` VALUES ('27', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494406747');
INSERT INTO `caipiao_adminlog` VALUES ('28', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494465946');
INSERT INTO `caipiao_adminlog` VALUES ('29', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号NMG1705111051103377,会员：zggcdyz', '127.0.0.1', '本机地址', '1494471124');
INSERT INTO `caipiao_adminlog` VALUES ('30', '1', 'administrator', 'logout', '退出登陆', '127.0.0.1', '本机地址', '1494472066');
INSERT INTO `caipiao_adminlog` VALUES ('31', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494472072');
INSERT INTO `caipiao_adminlog` VALUES ('32', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号IRC1705111106584791,会员：zggcdyz', '127.0.0.1', '本机地址', '1494472132');
INSERT INTO `caipiao_adminlog` VALUES ('33', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号OMW1705111115246737,会员：zggcdyz', '127.0.0.1', '本机地址', '1494472574');
INSERT INTO `caipiao_adminlog` VALUES ('34', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号IJN1705111117346096,会员：zggcdyz', '127.0.0.1', '本机地址', '1494472679');
INSERT INTO `caipiao_adminlog` VALUES ('35', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号QGA1705111125517487,会员：zggcdyz', '127.0.0.1', '本机地址', '1494473176');
INSERT INTO `caipiao_adminlog` VALUES ('36', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494491173');
INSERT INTO `caipiao_adminlog` VALUES ('37', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494550114');
INSERT INTO `caipiao_adminlog` VALUES ('38', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494559111');
INSERT INTO `caipiao_adminlog` VALUES ('39', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494570409');
INSERT INTO `caipiao_adminlog` VALUES ('40', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494593451');
INSERT INTO `caipiao_adminlog` VALUES ('41', '1', 'administrator', 'withdrawstate', '提款订单审核-退回，订单号UIX1705122105594806,会员：zggcdyz', '127.0.0.1', '本机地址', '1494594428');
INSERT INTO `caipiao_adminlog` VALUES ('42', '1', 'administrator', 'withdrawstate', '提款订单审核-通过，订单号HQH1705122105205917,会员：zggcdyz', '127.0.0.1', '本机地址', '1494594534');
INSERT INTO `caipiao_adminlog` VALUES ('43', '1', 'administrator', 'withdrawstate', '提款订单审核-通过，订单号WPW1705122104588305,会员：zggcdyz', '127.0.0.1', '本机地址', '1494594544');
INSERT INTO `caipiao_adminlog` VALUES ('44', '1', 'administrator', 'withdrawstate', '提款订单审核-通过，订单号KGN1705122104118504,会员：zggcdyz', '127.0.0.1', '本机地址', '1494594553');
INSERT INTO `caipiao_adminlog` VALUES ('45', '1', 'administrator', 'withdrawstate', '提款订单审核-退回，订单号AGD1705122112305679,会员：zggcdyz', '127.0.0.1', '本机地址', '1494594778');
INSERT INTO `caipiao_adminlog` VALUES ('46', '1', 'administrator', 'login', '登陆成功', '192.168.0.104', '局域网', '1494638968');
INSERT INTO `caipiao_adminlog` VALUES ('47', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号SAT1705130932302921,会员：y123456', '192.168.0.104', '局域网', '1494639213');
INSERT INTO `caipiao_adminlog` VALUES ('48', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494640285');
INSERT INTO `caipiao_adminlog` VALUES ('49', '1', 'administrator', 'logout', '退出登陆', '127.0.0.1', '本机地址', '1494640644');
INSERT INTO `caipiao_adminlog` VALUES ('50', '1', 'administrator', 'login', '登陆成功', '192.168.0.104', '局域网', '1494640661');
INSERT INTO `caipiao_adminlog` VALUES ('51', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494642307');
INSERT INTO `caipiao_adminlog` VALUES ('52', '1', 'administrator', 'login', '登陆成功', '192.168.0.104', '局域网', '1494645735');
INSERT INTO `caipiao_adminlog` VALUES ('53', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494645852');
INSERT INTO `caipiao_adminlog` VALUES ('54', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1494656177');
INSERT INTO `caipiao_adminlog` VALUES ('55', '1', 'administrator', 'jinjishenhe', '会员晋级审核-通过,会员：zggcdyz', '127.0.0.1', '本机地址', '1494661279');
INSERT INTO `caipiao_adminlog` VALUES ('56', '1', 'administrator', 'jinjishenhe', '会员晋级审核-通过,会员：zggcdyz', '127.0.0.1', '本机地址', '1494661551');
INSERT INTO `caipiao_adminlog` VALUES ('57', '1', 'administrator', 'jinjishenhe', '会员晋级审核-通过,会员：zggcdyz', '127.0.0.1', '本机地址', '1494662249');
INSERT INTO `caipiao_adminlog` VALUES ('58', '1', 'administrator', 'jinjishenhe', '会员晋级审核-通过,会员：zggcdyz', '127.0.0.1', '本机地址', '1494662358');
INSERT INTO `caipiao_adminlog` VALUES ('59', '1', 'administrator', 'fanshui', '反水审核-通过,会员：zggcdyz', '127.0.0.1', '本机地址', '1494666124');
INSERT INTO `caipiao_adminlog` VALUES ('60', '1', 'administrator', 'fanshui', '反水审核-通过,会员：zggcdyz', '127.0.0.1', '本机地址', '1494666406');
INSERT INTO `caipiao_adminlog` VALUES ('61', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494724506');
INSERT INTO `caipiao_adminlog` VALUES ('62', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494725382');
INSERT INTO `caipiao_adminlog` VALUES ('63', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494811742');
INSERT INTO `caipiao_adminlog` VALUES ('64', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494828615');
INSERT INTO `caipiao_adminlog` VALUES ('65', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494901994');
INSERT INTO `caipiao_adminlog` VALUES ('66', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1494989264');
INSERT INTO `caipiao_adminlog` VALUES ('67', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495009020');
INSERT INTO `caipiao_adminlog` VALUES ('68', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495071446');
INSERT INTO `caipiao_adminlog` VALUES ('69', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号XJB1705181117227985,会员：a111', '0.0.0.0', 'IANA保留地址', '1495077464');
INSERT INTO `caipiao_adminlog` VALUES ('70', '1', 'administrator', 'jinjishenhe', '晋级审核-通过,会员：a111', '0.0.0.0', 'IANA保留地址', '1495077544');
INSERT INTO `caipiao_adminlog` VALUES ('71', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号VRN1705181139034589,会员：abc123t1', '0.0.0.0', 'IANA保留地址', '1495078766');
INSERT INTO `caipiao_adminlog` VALUES ('72', '1', 'administrator', 'jinjishenhe', '晋级审核-通过,会员：abc123t1', '0.0.0.0', 'IANA保留地址', '1495078811');
INSERT INTO `caipiao_adminlog` VALUES ('73', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495175472');
INSERT INTO `caipiao_adminlog` VALUES ('74', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495096903');
INSERT INTO `caipiao_adminlog` VALUES ('75', '1', 'administrator', 'logout', '退出登陆', '0.0.0.0', 'IANA保留地址', '1495098072');
INSERT INTO `caipiao_adminlog` VALUES ('76', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495098122');
INSERT INTO `caipiao_adminlog` VALUES ('77', '1', 'administrator', 'logout', '退出登陆', '0.0.0.0', 'IANA保留地址', '1495098401');
INSERT INTO `caipiao_adminlog` VALUES ('78', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495098663');
INSERT INTO `caipiao_adminlog` VALUES ('79', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495109318');
INSERT INTO `caipiao_adminlog` VALUES ('80', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495109767');
INSERT INTO `caipiao_adminlog` VALUES ('81', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495157366');
INSERT INTO `caipiao_adminlog` VALUES ('82', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495162717');
INSERT INTO `caipiao_adminlog` VALUES ('83', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495166103');
INSERT INTO `caipiao_adminlog` VALUES ('84', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1495176497');
INSERT INTO `caipiao_adminlog` VALUES ('85', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495241787');
INSERT INTO `caipiao_adminlog` VALUES ('86', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495261451');
INSERT INTO `caipiao_adminlog` VALUES ('87', '1', 'administrator', 'login', '登陆失败，密码错误', '0.0.0.0', 'IANA保留地址', '1495264663');
INSERT INTO `caipiao_adminlog` VALUES ('88', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495264672');
INSERT INTO `caipiao_adminlog` VALUES ('89', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1495264685');
INSERT INTO `caipiao_adminlog` VALUES ('90', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495264721');
INSERT INTO `caipiao_adminlog` VALUES ('91', '1', 'administrator', 'logout', '退出登陆', '0.0.0.0', 'IANA保留地址', '1495264913');
INSERT INTO `caipiao_adminlog` VALUES ('92', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495265017');
INSERT INTO `caipiao_adminlog` VALUES ('93', '1', 'administrator', 'login', '登陆成功', '192.168.0.100', '局域网', '1495267682');
INSERT INTO `caipiao_adminlog` VALUES ('94', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495268254');
INSERT INTO `caipiao_adminlog` VALUES ('95', '1', 'administrator', 'logout', '退出登陆', '0.0.0.0', 'IANA保留地址', '1495268374');
INSERT INTO `caipiao_adminlog` VALUES ('96', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495268490');
INSERT INTO `caipiao_adminlog` VALUES ('97', '1', 'administrator', 'logout', '退出登陆', '0.0.0.0', 'IANA保留地址', '1495268495');
INSERT INTO `caipiao_adminlog` VALUES ('98', '1', 'administrator', 'login', '登陆成功', '192.168.0.100', '局域网', '1495268553');
INSERT INTO `caipiao_adminlog` VALUES ('99', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495269209');
INSERT INTO `caipiao_adminlog` VALUES ('100', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495270754');
INSERT INTO `caipiao_adminlog` VALUES ('101', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495332085');
INSERT INTO `caipiao_adminlog` VALUES ('102', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495336963');
INSERT INTO `caipiao_adminlog` VALUES ('103', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495375303');
INSERT INTO `caipiao_adminlog` VALUES ('104', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495422209');
INSERT INTO `caipiao_adminlog` VALUES ('105', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1495444132');
INSERT INTO `caipiao_adminlog` VALUES ('106', '1', 'administrator', 'login', '登陆成功', '192.168.0.103', '局域网', '1495503772');
INSERT INTO `caipiao_adminlog` VALUES ('107', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495508849');
INSERT INTO `caipiao_adminlog` VALUES ('108', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495520452');
INSERT INTO `caipiao_adminlog` VALUES ('109', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495593872');
INSERT INTO `caipiao_adminlog` VALUES ('110', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号M1705241044077147,会员：abc123', '0.0.0.0', 'IANA保留地址', '1495593883');
INSERT INTO `caipiao_adminlog` VALUES ('111', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495616770');
INSERT INTO `caipiao_adminlog` VALUES ('112', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1495680232');
INSERT INTO `caipiao_adminlog` VALUES ('113', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496368427');
INSERT INTO `caipiao_adminlog` VALUES ('114', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号J1706021043122811,会员：y123456', '0.0.0.0', 'IANA保留地址', '1496371415');
INSERT INTO `caipiao_adminlog` VALUES ('115', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号N1706021042400339,会员：abc123', '0.0.0.0', 'IANA保留地址', '1496371443');
INSERT INTO `caipiao_adminlog` VALUES ('116', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496383973');
INSERT INTO `caipiao_adminlog` VALUES ('117', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496474713');
INSERT INTO `caipiao_adminlog` VALUES ('118', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496548036');
INSERT INTO `caipiao_adminlog` VALUES ('119', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496569036');
INSERT INTO `caipiao_adminlog` VALUES ('120', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号C1706041736350305,会员：abc123', '0.0.0.0', 'IANA保留地址', '1496569075');
INSERT INTO `caipiao_adminlog` VALUES ('121', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号G1706041739027798,会员：abc123', '0.0.0.0', 'IANA保留地址', '1496569288');
INSERT INTO `caipiao_adminlog` VALUES ('122', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号X1706041741043017,会员：abc123', '0.0.0.0', 'IANA保留地址', '1496569315');
INSERT INTO `caipiao_adminlog` VALUES ('123', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496631582');
INSERT INTO `caipiao_adminlog` VALUES ('124', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496633035');
INSERT INTO `caipiao_adminlog` VALUES ('125', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496721298');
INSERT INTO `caipiao_adminlog` VALUES ('126', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496737151');
INSERT INTO `caipiao_adminlog` VALUES ('127', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496738632');
INSERT INTO `caipiao_adminlog` VALUES ('128', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496739085');
INSERT INTO `caipiao_adminlog` VALUES ('129', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496794646');
INSERT INTO `caipiao_adminlog` VALUES ('130', '5', 'zggcdyz', 'login', '登陆成功', '127.0.0.1', '本机地址', '1496798789');
INSERT INTO `caipiao_adminlog` VALUES ('131', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496892663');
INSERT INTO `caipiao_adminlog` VALUES ('132', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496909107');
INSERT INTO `caipiao_adminlog` VALUES ('133', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1496994942');
INSERT INTO `caipiao_adminlog` VALUES ('134', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497065316');
INSERT INTO `caipiao_adminlog` VALUES ('135', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497094479');
INSERT INTO `caipiao_adminlog` VALUES ('136', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497099359');
INSERT INTO `caipiao_adminlog` VALUES ('137', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497141244');
INSERT INTO `caipiao_adminlog` VALUES ('138', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497172140');
INSERT INTO `caipiao_adminlog` VALUES ('139', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497261104');
INSERT INTO `caipiao_adminlog` VALUES ('140', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497323233');
INSERT INTO `caipiao_adminlog` VALUES ('141', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497337700');
INSERT INTO `caipiao_adminlog` VALUES ('142', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497403744');
INSERT INTO `caipiao_adminlog` VALUES ('143', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497404016');
INSERT INTO `caipiao_adminlog` VALUES ('144', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497489013');
INSERT INTO `caipiao_adminlog` VALUES ('145', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497576924');
INSERT INTO `caipiao_adminlog` VALUES ('146', '1', 'administrator', 'logout', '退出登陆', '0.0.0.0', 'IANA保留地址', '1497577257');
INSERT INTO `caipiao_adminlog` VALUES ('147', '1', 'administrator', 'login', '登陆失败，密码错误', '0.0.0.0', 'IANA保留地址', '1497685767');
INSERT INTO `caipiao_adminlog` VALUES ('148', '1', 'administrator', 'login', '登陆失败，密码错误', '0.0.0.0', 'IANA保留地址', '1497685782');
INSERT INTO `caipiao_adminlog` VALUES ('149', '1', 'administrator', 'login', '登陆失败，密码错误', '0.0.0.0', 'IANA保留地址', '1497685792');
INSERT INTO `caipiao_adminlog` VALUES ('150', '1', 'administrator', 'login', '登陆失败，密码错误', '0.0.0.0', 'IANA保留地址', '1497685814');
INSERT INTO `caipiao_adminlog` VALUES ('151', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497685841');
INSERT INTO `caipiao_adminlog` VALUES ('152', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497698699');
INSERT INTO `caipiao_adminlog` VALUES ('153', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497707666');
INSERT INTO `caipiao_adminlog` VALUES ('154', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497803104');
INSERT INTO `caipiao_adminlog` VALUES ('155', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号V1706180051401850,会员：zggcdyz', '0.0.0.0', 'IANA保留地址', '1497718329');
INSERT INTO `caipiao_adminlog` VALUES ('156', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497777111');
INSERT INTO `caipiao_adminlog` VALUES ('157', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497794751');
INSERT INTO `caipiao_adminlog` VALUES ('158', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1497795145');
INSERT INTO `caipiao_adminlog` VALUES ('159', '1', 'administrator', 'login', '登陆成功', '0.0.0.0', 'IANA保留地址', '1498062010');
INSERT INTO `caipiao_adminlog` VALUES ('160', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498615007');
INSERT INTO `caipiao_adminlog` VALUES ('161', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号H1706280956000113,会员：abc123t2', '127.0.0.1', '本机地址', '1498615019');
INSERT INTO `caipiao_adminlog` VALUES ('162', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498716418');
INSERT INTO `caipiao_adminlog` VALUES ('163', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号B1706291406362384,会员：abc123', '127.0.0.1', '本机地址', '1498716515');
INSERT INTO `caipiao_adminlog` VALUES ('164', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号O1706291409423307,会员：abc123', '127.0.0.1', '本机地址', '1498716601');
INSERT INTO `caipiao_adminlog` VALUES ('165', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号O1706291500461456,会员：abc123t2', '127.0.0.1', '本机地址', '1498719660');
INSERT INTO `caipiao_adminlog` VALUES ('166', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号L1706291502389956,会员：abc123t2', '127.0.0.1', '本机地址', '1498719786');
INSERT INTO `caipiao_adminlog` VALUES ('167', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498814190');
INSERT INTO `caipiao_adminlog` VALUES ('168', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号M1706301716102912,会员：abc123t1', '127.0.0.1', '本机地址', '1498814201');
INSERT INTO `caipiao_adminlog` VALUES ('169', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498814770');
INSERT INTO `caipiao_adminlog` VALUES ('170', '1', 'administrator', 'rechargstate', '手动充值增加金额，订单号,会员：我是某某3', '127.0.0.1', '本机地址', '1498814800');
INSERT INTO `caipiao_adminlog` VALUES ('171', '1', 'administrator', 'rechargstate', '手动充值增加金额，订单号,会员：abc123t1', '127.0.0.1', '本机地址', '1498815160');
INSERT INTO `caipiao_adminlog` VALUES ('172', '1', 'administrator', 'rechargstate', '手动充值增加金额，订单号,会员：abc123t1', '127.0.0.1', '本机地址', '1498815200');
INSERT INTO `caipiao_adminlog` VALUES ('173', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号F1706301742543594,会员：abc123t1', '127.0.0.1', '本机地址', '1498815791');
INSERT INTO `caipiao_adminlog` VALUES ('174', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号B1706301744229735,会员：abc123t1', '127.0.0.1', '本机地址', '1498815877');
INSERT INTO `caipiao_adminlog` VALUES ('175', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498793729');
INSERT INTO `caipiao_adminlog` VALUES ('176', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498802111');
INSERT INTO `caipiao_adminlog` VALUES ('177', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498821644');
INSERT INTO `caipiao_adminlog` VALUES ('178', '1', 'administrator', 'withdrawstate', '提款订单审核-通过，订单号X1706301933383607,会员：abc123t1', '127.0.0.1', '本机地址', '1498822809');
INSERT INTO `caipiao_adminlog` VALUES ('179', '1', 'administrator', 'withdrawstate', '提款订单审核-通过，订单号Z1706301934022136,会员：abc123t1', '127.0.0.1', '本机地址', '1498822835');
INSERT INTO `caipiao_adminlog` VALUES ('180', '1', 'administrator', 'withdrawstate', '提款订单审核-通过，订单号U1706302000131758,会员：abc123t1', '127.0.0.1', '本机地址', '1498824566');
INSERT INTO `caipiao_adminlog` VALUES ('181', '1', 'administrator', 'rechargstate', '充值订单取消，订单号Y1706302033400143,会员：abc123t1', '127.0.0.1', '本机地址', '1498826047');
INSERT INTO `caipiao_adminlog` VALUES ('182', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号M1706302033343594,会员：abc123t1', '127.0.0.1', '本机地址', '1498826055');
INSERT INTO `caipiao_adminlog` VALUES ('183', '1', 'administrator', 'withdrawstate', '提款订单审核-退回，订单号S1706302006580792,会员：abc123t1', '127.0.0.1', '本机地址', '1498829287');
INSERT INTO `caipiao_adminlog` VALUES ('184', '1', 'administrator', 'withdrawstate', '提款订单审核-退回，订单号S1706302127253188,会员：abc123t1', '127.0.0.1', '本机地址', '1498829327');
INSERT INTO `caipiao_adminlog` VALUES ('185', '1', 'administrator', 'withdrawstate', '提款订单审核-退回，订单号S1706302127253188,会员：abc123t1', '127.0.0.1', '本机地址', '1498829711');
INSERT INTO `caipiao_adminlog` VALUES ('186', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498873990');
INSERT INTO `caipiao_adminlog` VALUES ('187', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号P1706302033158260,会员：abc123t1', '127.0.0.1', '本机地址', '1498874547');
INSERT INTO `caipiao_adminlog` VALUES ('188', '1', 'administrator', 'rechargstate', '充值订单取消，订单号J1707011001452948,会员：abc123t1', '127.0.0.1', '本机地址', '1498874581');
INSERT INTO `caipiao_adminlog` VALUES ('189', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498874708');
INSERT INTO `caipiao_adminlog` VALUES ('190', '1', 'administrator', 'rechargstate', '手动充值增加金额，订单号,会员：abc123t1', '127.0.0.1', '本机地址', '1498879028');
INSERT INTO `caipiao_adminlog` VALUES ('191', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498888530');
INSERT INTO `caipiao_adminlog` VALUES ('192', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498894747');
INSERT INTO `caipiao_adminlog` VALUES ('193', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498894841');
INSERT INTO `caipiao_adminlog` VALUES ('194', '1', 'administrator', 'logout', '退出登陆', '127.0.0.1', '本机地址', '1498894946');
INSERT INTO `caipiao_adminlog` VALUES ('195', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498894965');
INSERT INTO `caipiao_adminlog` VALUES ('196', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498895724');
INSERT INTO `caipiao_adminlog` VALUES ('197', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498895906');
INSERT INTO `caipiao_adminlog` VALUES ('198', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498900193');
INSERT INTO `caipiao_adminlog` VALUES ('199', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498900541');
INSERT INTO `caipiao_adminlog` VALUES ('200', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498900616');
INSERT INTO `caipiao_adminlog` VALUES ('201', '1', 'administrator', 'login', '登陆失败，密码错误', '127.0.0.1', '本机地址', '1498900642');
INSERT INTO `caipiao_adminlog` VALUES ('202', '1', 'administrator', 'login', '登陆失败，密码错误', '127.0.0.1', '本机地址', '1498900659');
INSERT INTO `caipiao_adminlog` VALUES ('203', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498900683');
INSERT INTO `caipiao_adminlog` VALUES ('204', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498900706');
INSERT INTO `caipiao_adminlog` VALUES ('205', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498900869');
INSERT INTO `caipiao_adminlog` VALUES ('206', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1498960327');
INSERT INTO `caipiao_adminlog` VALUES ('207', '1', 'administrator', 'rechargstate', '手动充值增加金额，订单号,会员：abc123', '127.0.0.1', '本机地址', '1498987145');
INSERT INTO `caipiao_adminlog` VALUES ('208', '1', 'administrator', 'rechargstate', '手动充值增加金额，订单号,会员：abc123', '127.0.0.1', '本机地址', '1498987183');
INSERT INTO `caipiao_adminlog` VALUES ('209', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499076298');
INSERT INTO `caipiao_adminlog` VALUES ('210', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499132208');
INSERT INTO `caipiao_adminlog` VALUES ('211', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499179696');
INSERT INTO `caipiao_adminlog` VALUES ('212', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499218809');
INSERT INTO `caipiao_adminlog` VALUES ('213', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号W1707050939499928,会员：abc123', '127.0.0.1', '本机地址', '1499218829');
INSERT INTO `caipiao_adminlog` VALUES ('214', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号L1707041802282680,会员：abc123', '127.0.0.1', '本机地址', '1499219217');
INSERT INTO `caipiao_adminlog` VALUES ('215', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号B1707041744400942,会员：abc123', '127.0.0.1', '本机地址', '1499219281');
INSERT INTO `caipiao_adminlog` VALUES ('216', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499220150');
INSERT INTO `caipiao_adminlog` VALUES ('217', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号W1707051002120552,会员：abc123t1', '127.0.0.1', '本机地址', '1499220172');
INSERT INTO `caipiao_adminlog` VALUES ('218', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号F1707051004138394,会员：abc123t1', '127.0.0.1', '本机地址', '1499220402');
INSERT INTO `caipiao_adminlog` VALUES ('219', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号E1707051017211629,会员：abc123t1', '127.0.0.1', '本机地址', '1499221055');
INSERT INTO `caipiao_adminlog` VALUES ('220', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号E1707051018086193,会员：abc123t1', '127.0.0.1', '本机地址', '1499221123');
INSERT INTO `caipiao_adminlog` VALUES ('221', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号M1707051021498922,会员：abc123t1', '127.0.0.1', '本机地址', '1499221325');
INSERT INTO `caipiao_adminlog` VALUES ('222', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499229571');
INSERT INTO `caipiao_adminlog` VALUES ('223', '1', 'administrator', 'rechargstate', '充值订单审核通过，订单号Z1707051239195494,会员：abc123t1', '127.0.0.1', '本机地址', '1499229613');
INSERT INTO `caipiao_adminlog` VALUES ('224', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499265205');
INSERT INTO `caipiao_adminlog` VALUES ('225', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499311316');
INSERT INTO `caipiao_adminlog` VALUES ('226', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499322876');
INSERT INTO `caipiao_adminlog` VALUES ('227', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499389365');
INSERT INTO `caipiao_adminlog` VALUES ('228', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499408381');
INSERT INTO `caipiao_adminlog` VALUES ('229', '1', 'administrator', 'rechargstate', '手动充值增加金额，订单号,会员：abc123', '127.0.0.1', '本机地址', '1499431364');
INSERT INTO `caipiao_adminlog` VALUES ('230', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499478149');
INSERT INTO `caipiao_adminlog` VALUES ('231', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499483492');
INSERT INTO `caipiao_adminlog` VALUES ('232', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499486735');
INSERT INTO `caipiao_adminlog` VALUES ('233', '1', 'administrator', 'login', '登陆成功', '127.0.0.1', '本机地址', '1499490184');
INSERT INTO `caipiao_adminlog` VALUES ('234', '1', 'administrator', 'rechargstate', '手动充值增加金额，订单号,会员：abc123t01', '127.0.0.1', '本机地址', '1499490201');

-- ----------------------------
-- Table structure for `caipiao_adminloginerror`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_adminloginerror`;
CREATE TABLE `caipiao_adminloginerror` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(30) NOT NULL,
  `ip` char(20) NOT NULL,
  `time` int(11) NOT NULL,
  `errornum` smallint(6) NOT NULL,
  `locktime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_adminloginerror
-- ----------------------------

-- ----------------------------
-- Table structure for `caipiao_adminmember`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_adminmember`;
CREATE TABLE `caipiao_adminmember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` smallint(6) NOT NULL,
  `username` char(60) NOT NULL,
  `email` char(60) NOT NULL,
  `password` char(32) NOT NULL,
  `safecode` mediumint(9) NOT NULL DEFAULT '1234',
  `loginip` char(20) NOT NULL,
  `iparea` char(20) NOT NULL,
  `logintime` int(11) NOT NULL,
  `islock` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_adminmember
-- ----------------------------
INSERT INTO `caipiao_adminmember` VALUES ('1', '1', 'administrator', '', 'd93a5def7511da3d0f2d171d9c344e91', '1234', '127.0.0.1', '本机地址', '1499490184', '0');
INSERT INTO `caipiao_adminmember` VALUES ('2', '1', 'adminweihu', '', 'd93a5def7511da3d0f2d171d9c344e91', '1234', '', '', '0', '1');
INSERT INTO `caipiao_adminmember` VALUES ('4', '1', 'globaladmin', '', 'f529b9209263efc99b6a923a7ff66e14', '1234', '127.0.0.1', '本机地址', '1484553562', '0');
INSERT INTO `caipiao_adminmember` VALUES ('5', '1', 'zggcdyz', '', 'd93a5def7511da3d0f2d171d9c344e91', '1234', '127.0.0.1', '本机地址', '1496798789', '0');

-- ----------------------------
-- Table structure for `caipiao_adminsession`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_adminsession`;
CREATE TABLE `caipiao_adminsession` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `username` char(60) NOT NULL,
  `sessionid` char(32) NOT NULL,
  `ip` char(20) NOT NULL COMMENT '登录ip',
  `time` int(11) NOT NULL COMMENT '登录时间',
  PRIMARY KEY (`sid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_adminsession
-- ----------------------------
INSERT INTO `caipiao_adminsession` VALUES ('1', '1', 'administrator', 'a9fbeee50561abaf0703089d2b21fb75', '127.0.0.1', '1499490184');
INSERT INTO `caipiao_adminsession` VALUES ('2', '4', 'globaladmin', 'a62c30e8ebae91a6efc6f2f162ded7e8', '127.0.0.1', '1484553562');
INSERT INTO `caipiao_adminsession` VALUES ('3', '5', 'zggcdyz', 'e9ffc9d6bd4ae3a90b8e36aa7660a8cf', '127.0.0.1', '1496798789');

-- ----------------------------
-- Table structure for `caipiao_agentlink`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_agentlink`;
CREATE TABLE `caipiao_agentlink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` char(60) NOT NULL,
  `proxy` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1代理 0玩家',
  `tpltype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '模版类型 0默认',
  `usenum` int(11) NOT NULL COMMENT '使用次数',
  `okusenum` int(11) NOT NULL COMMENT '已经使用的次数',
  `fandian` decimal(6,1) NOT NULL,
  `oddtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_agentlink
-- ----------------------------
INSERT INTO `caipiao_agentlink` VALUES ('7', '8021', 'abc123', '0', '0', '100', '0', '9.9', '1499244393');
INSERT INTO `caipiao_agentlink` VALUES ('8', '8021', 'abc123', '1', '0', '100', '4', '11.3', '1499244497');

-- ----------------------------
-- Table structure for `caipiao_banklist`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_banklist`;
CREATE TABLE `caipiao_banklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `username` char(30) NOT NULL COMMENT '会员昵称',
  `bankaddress` varchar(80) NOT NULL COMMENT '开户行地址',
  `bankname` varchar(60) NOT NULL COMMENT '开户银行',
  `bankcode` char(20) NOT NULL,
  `bankbranch` varchar(80) NOT NULL COMMENT '开户网点',
  `accountname` varchar(30) NOT NULL COMMENT '开户姓名',
  `banknumber` varchar(22) NOT NULL COMMENT '银行卡号',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1默认',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0审核中 1默认 2驳回',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='会员银行绑定表';

-- ----------------------------
-- Records of caipiao_banklist
-- ----------------------------
INSERT INTO `caipiao_banklist` VALUES ('2', '8002', 'hjjfukfu', '江西省-九江', '工商银行', '00018', '', '李大嘴', '4200019201003041056', '0', '0', '2016-08-24 10:17:28');
INSERT INTO `caipiao_banklist` VALUES ('3', '8002', 'hjjfukfu', '广东省-潮州', '农业银行', '00017', '', '李大嘴', '4200019201003043456', '0', '0', '2016-02-09 21:17:46');
INSERT INTO `caipiao_banklist` VALUES ('4', '8002', 'hjjfukfu', '四川省-甘孜', '中国银行', '00083', '', '李大嘴', '4200019201003045678', '0', '0', '2017-02-16 15:18:07');
INSERT INTO `caipiao_banklist` VALUES ('6', '8020', 'zggcdyz', '河北省-张家口市', '农业银行', '00017', 'gfgdfgdfg', 'xxx', '123123123123123123', '0', '1', '2017-01-20 14:18:26');
INSERT INTO `caipiao_banklist` VALUES ('7', '8017', 'y123456', '重庆市-重庆市', '农业银行', '00017', '史蒂夫', '史蒂夫', '1234567890123456', '0', '1', '2017-04-12 13:18:43');
INSERT INTO `caipiao_banklist` VALUES ('11', '8020', 'zggcdyz', '山西省-临汾市', '中国银行', '00083', 'kjhjghjfgh', 'xxx', '6217257000001586789', '1', '1', '2017-05-11 10:45:23');
INSERT INTO `caipiao_banklist` VALUES ('14', '8020', 'zggcdyz', '湖北省-宜昌市', '建设银行', '00015', 'dfgsdfg', 'xxx', '1231545345345438', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `caipiao_banklist` VALUES ('12', '8017', 'y123456', '河北省-保定市', '建设银行', '00015', '阿斯蒂芬', '史蒂夫', '1234567890123456', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `caipiao_banklist` VALUES ('16', '8037', 'a1123', '内蒙古-鄂尔多斯市', '南京银行', '00055', 'xxxx', '李大锺', '12345678901234567', '1', '1', '2017-06-17 23:49:17');
INSERT INTO `caipiao_banklist` VALUES ('17', '8022', 'abc123t1', '浙江省-绍兴市', '平安银行', '00087', 'xxxxx', '王五', '1234567890123456789', '1', '1', '2017-06-30 19:31:29');
INSERT INTO `caipiao_banklist` VALUES ('28', '8023', 'abc123t2', '安徽省-宿州市', '工商银行', '00018', '士大夫', '牛逼', '12345678901234567', '1', '1', '2017-07-01 10:35:59');

-- ----------------------------
-- Table structure for `caipiao_caipiao`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_caipiao`;
CREATE TABLE `caipiao_caipiao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` char(20) NOT NULL COMMENT '彩票分类（ssc、k3）',
  `title` varchar(80) NOT NULL COMMENT '彩种名称',
  `ftitle` varchar(180) NOT NULL COMMENT '彩种简介',
  `firsttime` char(8) DEFAULT NULL,
  `endtime` char(8) DEFAULT NULL,
  `qishu` tinyint(4) NOT NULL,
  `name` char(30) NOT NULL COMMENT '彩种标示（唯一）',
  `ftime` smallint(6) NOT NULL DEFAULT '120' COMMENT '停止投注间隔',
  `isopen` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启',
  `issys` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0第三方彩票 1系统彩票',
  `closetime1` time NOT NULL DEFAULT '00:00:00',
  `closetime2` time NOT NULL DEFAULT '00:00:00',
  `expecttime` smallint(6) NOT NULL DEFAULT '1' COMMENT '多久1期 最少1分钟',
  `iswh` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1维护',
  `allsort` smallint(6) NOT NULL,
  `listorder` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `typeid` (`typeid`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_caipiao
-- ----------------------------
INSERT INTO `caipiao_caipiao` VALUES ('53', 'k3', '河北快三', '返奖高，出款快', '8:30', '22:30', '81', 'hebk3', '120', '1', '0', '00:00:00', '00:00:00', '0', '0', '12', '6');
INSERT INTO `caipiao_caipiao` VALUES ('16', 'k3', '北京快3', '单双大小易中奖', null, null, '0', 'bjk3', '120', '1', '0', '00:00:00', '00:00:00', '0', '0', '11', '12');
INSERT INTO `caipiao_caipiao` VALUES ('17', 'k3', '江苏快3', '老快三，最热门', null, null, '0', 'jsk3', '120', '1', '0', '00:00:00', '00:00:00', '0', '0', '4', '11');
INSERT INTO `caipiao_caipiao` VALUES ('18', 'k3', '湖北快3', '高赔率，易中奖', null, null, '0', 'hubk3', '120', '1', '0', '00:00:00', '00:00:00', '0', '0', '9', '10');
INSERT INTO `caipiao_caipiao` VALUES ('19', 'k3', '广西快3', '新快三，高赔率', null, null, '0', 'gxk3', '120', '1', '0', '00:00:00', '00:00:00', '0', '0', '14', '9');
INSERT INTO `caipiao_caipiao` VALUES ('20', 'k3', '安徽快3', '返奖高，出款快', null, null, '0', 'ahk3', '120', '1', '0', '00:00:00', '00:00:00', '0', '0', '7', '8');
INSERT INTO `caipiao_caipiao` VALUES ('21', 'k3', '上海快三', '返奖高，开奖快', null, null, '0', 'shk3', '120', '1', '0', '00:00:00', '00:00:00', '0', '0', '13', '7');
INSERT INTO `caipiao_caipiao` VALUES ('84', 'k3', '江西快3', '返奖高，出款快', null, null, '0', 'jxk3', '120', '1', '0', '00:00:00', '00:00:00', '0', '0', '12', '4');
INSERT INTO `caipiao_caipiao` VALUES ('91', 'k3', '大发快3', '3分钟开奖,快捷', null, null, '0', 'f1k3', '10', '1', '1', '00:00:00', '23:30:00', '1', '0', '15', '3');
INSERT INTO `caipiao_caipiao` VALUES ('82', 'k3', '内蒙古快三', '返奖高，出款快', null, null, '0', 'nmgk3', '120', '0', '0', '00:00:00', '00:00:00', '0', '1', '13', '5');
INSERT INTO `caipiao_caipiao` VALUES ('92', 'k3', '幸运快3', '好运5分钟', null, null, '0', 'f5k3', '5', '1', '1', '00:00:00', '23:30:00', '1', '0', '14', '2');
INSERT INTO `caipiao_caipiao` VALUES ('97', 'ssc', '大发时时彩', '大发时时彩', '00:02:00', '00:00:00', '127', 'dfssc', '10', '1', '1', '08:30:00', '23:30:00', '1', '0', '16', '4');
INSERT INTO `caipiao_caipiao` VALUES ('98', 'ssc', '天津时时彩', '天津时时彩', '09:09:36', '22:59:36', '84', 'tjssc', '120', '1', '0', '00:00:00', '00:00:00', '1', '0', '6', '3');
INSERT INTO `caipiao_caipiao` VALUES ('99', 'ssc', '新疆时时彩', '新疆时时彩', '10:10:34', '02:00:34', '96', 'xjssc', '120', '1', '0', '00:00:00', '00:00:00', '1', '0', '17', '2');
INSERT INTO `caipiao_caipiao` VALUES ('100', 'ssc', '重庆时时彩', '重庆时时彩', '00:05:00', '00:00:00', '120', 'cqssc', '120', '1', '0', '00:00:00', '00:00:00', '1', '0', '18', '1');
INSERT INTO `caipiao_caipiao` VALUES ('93', 'k3', '吉林快3', '吉林快3', null, null, '0', 'jlk3', '120', '1', '0', '00:00:00', '00:00:00', '0', '0', '2', '1');
INSERT INTO `caipiao_caipiao` VALUES ('102', 'pk10', '北京PK10', '每5分钟一期,全天179期', '09:06:00', '23:56:00', '127', 'bjpk10', '60', '1', '0', '00:00:00', '00:00:00', '1', '0', '10', '0');
INSERT INTO `caipiao_caipiao` VALUES ('103', 'keno', '北京快乐8', '每5分钟一期,全天179期', '09:05:05', '23:55:05', '127', 'bjkeno', '60', '1', '0', '00:00:00', '00:00:00', '1', '0', '19', '0');
INSERT INTO `caipiao_caipiao` VALUES ('104', 'x5', '广东11选5', '每10分钟一期,全天84期', '09:11:00', '23:01:00', '84', 'gd11x5', '120', '1', '0', '00:00:00', '00:00:00', '1', '0', '1', '1');
INSERT INTO `caipiao_caipiao` VALUES ('105', 'x5', '上海11选5', '每10分钟一期,全天90期', '08:59:00', '23:49:00', '90', 'sh11x5', '120', '1', '0', '00:00:00', '00:00:00', '1', '0', '3', '2');
INSERT INTO `caipiao_caipiao` VALUES ('106', 'x5', '山东11选5', '每10分钟一期,全天87期', '08:35:00', '22:55:00', '87', 'sd11x5', '120', '1', '0', '00:00:00', '00:00:00', '1', '0', '5', '3');
INSERT INTO `caipiao_caipiao` VALUES ('107', 'x5', '江西11选5', '每10分钟一期,全天84期', '09:10:00', ' 23:00:0', '84', 'jx11x5', '120', '1', '0', '00:00:00', '00:00:00', '1', '0', '8', '4');
INSERT INTO `caipiao_caipiao` VALUES ('108', 'dpc', '福彩三D', '每天一期', '21:15:00', '21:15:00', '1', 'fc3d', '600', '1', '0', '00:00:00', '00:00:00', '1', '0', '23', '0');
INSERT INTO `caipiao_caipiao` VALUES ('109', 'dpc', '排列三', '每天一期', '20:30:00', '20:30:00', '1', 'pl3', '600', '1', '0', '00:00:00', '00:00:00', '1', '0', '24', '0');
INSERT INTO `caipiao_caipiao` VALUES ('110', 'k3', '分分快三', '分分快三', null, null, '0', 'ffk3', '10', '1', '1', '08:00:00', '23:00:00', '1', '0', '0', '110');
INSERT INTO `caipiao_caipiao` VALUES ('111', 'x5', '大发11选5', '大发11选5', null, null, '0', 'df11x5', '10', '1', '1', '00:01:00', '23:30:00', '1', '0', '0', '111');

-- ----------------------------
-- Table structure for `caipiao_caipiaotimes`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_caipiaotimes`;
CREATE TABLE `caipiao_caipiaotimes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `expect` int(11) NOT NULL,
  `starttime` time NOT NULL,
  `stoptime` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `expect` (`expect`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_caipiaotimes
-- ----------------------------

-- ----------------------------
-- Table structure for `caipiao_category`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_category`;
CREATE TABLE `caipiao_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL,
  `catname` varchar(120) NOT NULL COMMENT '栏目名称',
  `listorder` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='栏目管理';

-- ----------------------------
-- Records of caipiao_category
-- ----------------------------
INSERT INTO `caipiao_category` VALUES ('29', '0', '帮助中心', '1');
INSERT INTO `caipiao_category` VALUES ('30', '0', '网站介绍', '100');
INSERT INTO `caipiao_category` VALUES ('33', '29', '帮助指南', '1');
INSERT INTO `caipiao_category` VALUES ('34', '29', '安全问题', '2');
INSERT INTO `caipiao_category` VALUES ('35', '29', '充值问题', '3');
INSERT INTO `caipiao_category` VALUES ('36', '29', '购彩问题', '4');
INSERT INTO `caipiao_category` VALUES ('37', '29', '提现问题', '5');
INSERT INTO `caipiao_category` VALUES ('38', '29', '账户安全', '6');
INSERT INTO `caipiao_category` VALUES ('39', '29', '玩法限制规则', '7');
INSERT INTO `caipiao_category` VALUES ('40', '29', '快三技巧攻略', '8');
INSERT INTO `caipiao_category` VALUES ('41', '0', '优惠活动', '200');
INSERT INTO `caipiao_category` VALUES ('46', '29', '代理合作', '42');

-- ----------------------------
-- Table structure for `caipiao_czddh`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_czddh`;
CREATE TABLE `caipiao_czddh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paytype` char(20) NOT NULL COMMENT '支付宝 alipay QQ钱包 tenpay 微信：weixin',
  `uid` int(11) NOT NULL,
  `username` char(60) NOT NULL,
  `trano` char(60) NOT NULL,
  `threetrano` char(255) NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `oddtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `trano` (`trano`),
  KEY `threetrano` (`threetrano`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='平台充值订单与第三方订单关系表';

-- ----------------------------
-- Records of caipiao_czddh
-- ----------------------------

-- ----------------------------
-- Table structure for `caipiao_dailifenhong`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_dailifenhong`;
CREATE TABLE `caipiao_dailifenhong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trano` char(60) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` char(20) NOT NULL,
  `tzsumamount` decimal(14,4) NOT NULL,
  `fjsumamount` decimal(14,4) NOT NULL,
  `yingkui` decimal(14,4) NOT NULL,
  `fanwei` char(60) NOT NULL,
  `bili` char(10) NOT NULL,
  `amount` decimal(14,4) NOT NULL,
  `oddtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `trano` (`trano`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_dailifenhong
-- ----------------------------

-- ----------------------------
-- Table structure for `caipiao_dailiyongjin`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_dailiyongjin`;
CREATE TABLE `caipiao_dailiyongjin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listorder` smallint(6) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `addtime` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `username` char(30) NOT NULL COMMENT '会员昵称',
  `touzhuedu` decimal(10,2) NOT NULL COMMENT '下线流水',
  `yongjinfw` char(30) NOT NULL COMMENT '佣金范围',
  `amount` decimal(10,2) NOT NULL COMMENT '佣金金额',
  `yjtype` char(10) NOT NULL COMMENT '佣金类型',
  `oddtime` int(11) NOT NULL COMMENT '领取时间',
  `shenhe` tinyint(4) NOT NULL COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_dailiyongjin
-- ----------------------------
INSERT INTO `caipiao_dailiyongjin` VALUES ('2', '0', '1', '0', '8021', 'abc123', '169.00', '100-2000|0.8', '1.35', 'ri', '1495096783', '0');
INSERT INTO `caipiao_dailiyongjin` VALUES ('3', '0', '1', '0', '8021', 'abc123', '169.00', '100-2000|0.8', '1.35', 'yue', '1495096793', '0');

-- ----------------------------
-- Table structure for `caipiao_fanshui`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_fanshui`;
CREATE TABLE `caipiao_fanshui` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trano` char(60) NOT NULL,
  `listorder` smallint(6) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `addtime` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `username` char(30) NOT NULL COMMENT '会员昵称',
  `groupname` char(30) NOT NULL COMMENT '领取反水时会员等级',
  `bili` char(10) NOT NULL COMMENT '反水比例',
  `touzhuedu` decimal(20,2) NOT NULL COMMENT '流水额度',
  `amount` decimal(20,2) NOT NULL COMMENT '反水金额',
  `oddtime` int(11) NOT NULL COMMENT '领取时间',
  `shenhe` tinyint(4) NOT NULL COMMENT '审核状态',
  `yongjinfw` char(80) NOT NULL COMMENT '反水范围',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_fanshui
-- ----------------------------
INSERT INTO `caipiao_fanshui` VALUES ('12', 'D1706190040505078', '0', '1', '0', '8020', 'zggcdyz', 'VIP5', '0.5%', '1673.00', '8.37', '1497804050', '1', '100-2000|0.5');
INSERT INTO `caipiao_fanshui` VALUES ('15', 'U1706301548499518', '0', '1', '0', '8023', 'abc123t2', 'VIP5', '0.5%', '455.00', '2.28', '1498808929', '1', '100-2000|0.5');

-- ----------------------------
-- Table structure for `caipiao_fields`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_fields`;
CREATE TABLE `caipiao_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `tbname` char(30) NOT NULL,
  `name` char(30) NOT NULL,
  `fieldtype` char(20) NOT NULL COMMENT '字段类型',
  `length` smallint(6) NOT NULL COMMENT '字段长度',
  `istitle` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否标题字段',
  `islist` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否列表显示',
  `remark` varchar(60) NOT NULL COMMENT '备注',
  `setting` text NOT NULL,
  `listorder` smallint(6) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_fields
-- ----------------------------

-- ----------------------------
-- Table structure for `caipiao_fuddetail`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_fuddetail`;
CREATE TABLE `caipiao_fuddetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trano` char(20) NOT NULL COMMENT '单号',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `username` char(30) NOT NULL COMMENT '会员昵称',
  `type` char(30) NOT NULL COMMENT 'order代购 cancel撤单 reward返奖 commission返点 activity活动 transferPlatform平台转帐 backwater百家乐返水 backpoint百家乐返点 rollback后台撤单 editcommission修正手续费 editrecharge修正充值 editwithdraw修正提款 editactivity修正活动 downrecharge下级充值 upwithdraw上级提款 withdrawFailure提款失败',
  `typename` varchar(60) NOT NULL COMMENT '类型名称',
  `amount` decimal(14,2) NOT NULL COMMENT '金额',
  `amountbefor` decimal(14,2) NOT NULL COMMENT '账变前金额',
  `amountafter` decimal(14,2) NOT NULL COMMENT '账变后金额',
  `oddtime` int(11) NOT NULL COMMENT '时间',
  `remark` varchar(180) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`type`),
  KEY `trano` (`trano`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=1417 DEFAULT CHARSET=utf8 COMMENT='账户明细';

-- ----------------------------
-- Records of caipiao_fuddetail
-- ----------------------------
INSERT INTO `caipiao_fuddetail` VALUES ('917', 'T1706180005439', '8020', 'zggcdyz', 'order', '代购', '111.00', '59049.86', '58938.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('918', 'A1706180005436', '8020', 'zggcdyz', 'order', '代购', '111.00', '58938.86', '58827.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('919', 'C1706180005437', '8020', 'zggcdyz', 'order', '代购', '111.00', '58827.86', '58716.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('1205', 'P1707022249013', '8021', 'abc123', 'reward', '返奖', '160.05', '753708.60', '753868.65', '1499007138', '大发11选5第20170702686期-前三组选胆拖');
INSERT INTO `caipiao_fuddetail` VALUES ('1204', 'P1707022249013', '8021', 'abc123', 'order', '代购', '18.00', '753726.60', '753708.60', '1499006941', '投注扣费，彩种:大发11选5,20170702686');
INSERT INTO `caipiao_fuddetail` VALUES ('1203', 'D1707022248293', '8021', 'abc123', 'order', '代购', '90.00', '753816.60', '753726.60', '1499006909', '投注扣费，彩种:大发11选5,20170702686');
INSERT INTO `caipiao_fuddetail` VALUES ('1202', 'L1707022248165', '8021', 'abc123', 'order', '代购', '18.00', '753834.60', '753816.60', '1499006896', '投注扣费，彩种:大发11选5,20170702686');
INSERT INTO `caipiao_fuddetail` VALUES ('1201', 'L1707022241358', '8021', 'abc123', 'reward', '返奖', '106.70', '753727.90', '753834.60', '1499006642', '大发11选5第20170702682期-前二直选复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1200', 'E1707022241181', '8021', 'abc123', 'point', '积分', '220.00', '8852850.00', '8852630.00', '1499006502', '撤单扣回赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1199', 'E1707022241181', '8021', 'abc123', 'xima', '洗码', '220.00', '7011725.00', '7011945.00', '1499006502', '撤单退回洗码账户');
INSERT INTO `caipiao_fuddetail` VALUES ('1198', 'E1707022241181', '8021', 'abc123', 'cancel', '撤单', '220.00', '753507.90', '753727.90', '1499006502', '撤单退回');
INSERT INTO `caipiao_fuddetail` VALUES ('1197', 'L1707022241358', '8021', 'abc123', 'order', '代购', '220.00', '753727.90', '753507.90', '1499006495', '投注扣费，彩种:大发11选5,20170702682');
INSERT INTO `caipiao_fuddetail` VALUES ('1196', 'E1707022241181', '8021', 'abc123', 'order', '代购', '220.00', '753947.90', '753727.90', '1499006478', '投注扣费，彩种:大发11选5,20170702682');
INSERT INTO `caipiao_fuddetail` VALUES ('1195', 'A1707022233385', '8021', 'abc123', 'reward', '返奖', '160.05', '753787.85', '753947.90', '1499006163', '大发11选5第20170702678期-前三组选胆拖');
INSERT INTO `caipiao_fuddetail` VALUES ('1194', 'W1707022231049', '8021', 'abc123', 'reward', '返奖', '160.05', '753627.80', '753787.85', '1499006041', '大发11选5第20170702677期-前三组选复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1193', 'A1707022233385', '8021', 'abc123', 'order', '代购', '90.00', '753717.80', '753627.80', '1499006018', '投注扣费，彩种:大发11选5,20170702678');
INSERT INTO `caipiao_fuddetail` VALUES ('1192', 'I1707022233210', '8021', 'abc123', 'order', '代购', '10.00', '753727.80', '753717.80', '1499006001', '投注扣费，彩种:大发11选5,20170702678');
INSERT INTO `caipiao_fuddetail` VALUES ('1191', 'W1707022231049', '8021', 'abc123', 'order', '代购', '330.00', '754057.80', '753727.80', '1499005864', '投注扣费，彩种:大发11选5,20170702677');
INSERT INTO `caipiao_fuddetail` VALUES ('1190', 'M1707021906332', '8021', 'abc123', 'order', '代购', '10.00', '754067.80', '754057.80', '1498993593', '投注扣费，彩种:大发11选5,20170702335');
INSERT INTO `caipiao_fuddetail` VALUES ('1189', 'X1707021853395', '8021', 'abc123', 'reward', '返奖', '960.30', '753107.50', '754067.80', '1498993496', '大发11选5第20170702328期-前三直选复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1188', 'X1707021853395', '8021', 'abc123', 'order', '代购', '1980.00', '755087.50', '753107.50', '1498992819', '投注扣费，彩种:大发11选5,20170702328');
INSERT INTO `caipiao_fuddetail` VALUES ('1187', 'RLA1707021719437063', '8021', 'abc123', 'activity_cz', '充值活动', '700000.00', '55087.50', '755087.50', '1498987183', '手动充值增加');
INSERT INTO `caipiao_fuddetail` VALUES ('1186', 'ADE1707021719058265', '8021', 'abc123', 'activity_cz', '充值活动', '10000.00', '45087.50', '55087.50', '1498987145', '手动充值增加');
INSERT INTO `caipiao_fuddetail` VALUES ('1185', 'N1707021249279', '8021', 'abc123', 'order', '代购', '90.00', '45177.50', '45087.50', '1498970967', '投注扣费，彩种:广东11选5,20170702023');
INSERT INTO `caipiao_fuddetail` VALUES ('1184', 'G1707021242297', '8021', 'abc123', 'order', '代购', '20.00', '45197.50', '45177.50', '1498970549', '投注扣费，彩种:广东11选5,20170702023');
INSERT INTO `caipiao_fuddetail` VALUES ('1183', 'Z1707021232288', '8021', 'abc123', 'order', '代购', '6.00', '45203.50', '45197.50', '1498969948', '投注扣费，彩种:广东11选5,20170702022');
INSERT INTO `caipiao_fuddetail` VALUES ('1182', 'R1707021225134', '8021', 'abc123', 'order', '代购', '8.00', '45211.50', '45203.50', '1498969513', '投注扣费，彩种:广东11选5,20170702021');
INSERT INTO `caipiao_fuddetail` VALUES ('1181', 'J1707021224541', '8021', 'abc123', 'order', '代购', '22.00', '45233.50', '45211.50', '1498969494', '投注扣费，彩种:广东11选5,20170702021');
INSERT INTO `caipiao_fuddetail` VALUES ('1180', 'M1707021223160', '8021', 'abc123', 'order', '代购', '14.00', '45247.50', '45233.50', '1498969396', '投注扣费，彩种:广东11选5,20170702021');
INSERT INTO `caipiao_fuddetail` VALUES ('1179', 'G1707021220123', '8021', 'abc123', 'order', '代购', '8.00', '45255.50', '45247.50', '1498969212', '投注扣费，彩种:广东11选5,20170702020');
INSERT INTO `caipiao_fuddetail` VALUES ('1178', 'W1707021213357', '8021', 'abc123', 'order', '代购', '14.00', '45269.50', '45255.50', '1498968815', '投注扣费，彩种:广东11选5,20170702020');
INSERT INTO `caipiao_fuddetail` VALUES ('1177', 'N1707021210586', '8021', 'abc123', 'order', '代购', '12.00', '45281.50', '45269.50', '1498968658', '投注扣费，彩种:广东11选5,20170702020');
INSERT INTO `caipiao_fuddetail` VALUES ('1176', 'T1707021208217', '8021', 'abc123', 'order', '代购', '16.00', '45297.50', '45281.50', '1498968501', '投注扣费，彩种:广东11选5,20170702019');
INSERT INTO `caipiao_fuddetail` VALUES ('1175', 'H1707021204531', '8021', 'abc123', 'order', '代购', '10.00', '45307.50', '45297.50', '1498968293', '投注扣费，彩种:广东11选5,20170702019');
INSERT INTO `caipiao_fuddetail` VALUES ('1174', 'I1707021202008', '8021', 'abc123', 'order', '代购', '22.00', '45329.50', '45307.50', '1498968120', '投注扣费，彩种:广东11选5,20170702019');
INSERT INTO `caipiao_fuddetail` VALUES ('1173', 'M1707021044083', '8021', 'abc123', 'order', '代购', '110.00', '45439.50', '45329.50', '1498963448', '投注扣费，彩种:广东11选5,20170702011');
INSERT INTO `caipiao_fuddetail` VALUES ('1172', 'N1707021036344', '8021', 'abc123', 'order', '代购', '22.00', '45461.50', '45439.50', '1498962994', '投注扣费，彩种:广东11选5,20170702010');
INSERT INTO `caipiao_fuddetail` VALUES ('1171', 'M1707021024340', '8021', 'abc123', 'order', '代购', '14.00', '45475.50', '45461.50', '1498962274', '投注扣费，彩种:广东11选5,20170702009');
INSERT INTO `caipiao_fuddetail` VALUES ('1170', 'K1707021009328', '8021', 'abc123', 'order', '代购', '12.00', '45487.50', '45475.50', '1498961372', '投注扣费，彩种:广东11选5,20170702007');
INSERT INTO `caipiao_fuddetail` VALUES ('1169', 'L1707021003026', '8021', 'abc123', 'order', '代购', '66.00', '45553.50', '45487.50', '1498960982', '投注扣费，彩种:广东11选5,20170702007');
INSERT INTO `caipiao_fuddetail` VALUES ('1168', 'D1707020957362', '8021', 'abc123', 'order', '代购', '1980.00', '47533.50', '45553.50', '1498960656', '投注扣费，彩种:广东11选5,20170702006');
INSERT INTO `caipiao_fuddetail` VALUES ('1167', 'P1707012351196', '8021', 'abc123', 'order', '代购', '22.00', '47555.50', '47533.50', '1498924279', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1166', 'Y1707012351010', '8021', 'abc123', 'order', '代购', '4.00', '47559.50', '47555.50', '1498924261', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1165', 'Y1707012343548', '8021', 'abc123', 'order', '代购', '8.00', '47567.50', '47559.50', '1498923834', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1164', 'L1707012339397', '8021', 'abc123', 'order', '代购', '8.00', '47575.50', '47567.50', '1498923579', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1163', 'B1707012337479', '8021', 'abc123', 'order', '代购', '8.00', '47583.50', '47575.50', '1498923467', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1162', 'G1707012336235', '8021', 'abc123', 'order', '代购', '18.00', '47601.50', '47583.50', '1498923383', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1161', 'S1707012335395', '8021', 'abc123', 'order', '代购', '18.00', '47619.50', '47601.50', '1498923339', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1160', 'W1707012333314', '8021', 'abc123', 'order', '代购', '2.00', '47621.50', '47619.50', '1498923211', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1159', 'T1707012332303', '8021', 'abc123', 'order', '代购', '242.00', '47863.50', '47621.50', '1498923150', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1158', 'M1707012331537', '8021', 'abc123', 'order', '代购', '242.00', '48105.50', '47863.50', '1498923113', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1157', 'A1707012331120', '8021', 'abc123', 'order', '代购', '242.00', '48347.50', '48105.50', '1498923072', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1156', 'O1707012328317', '8021', 'abc123', 'order', '代购', '242.00', '48589.50', '48347.50', '1498922911', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1155', 'X1707012314382', '8021', 'abc123', 'order', '代购', '200.00', '48789.50', '48589.50', '1498922078', '投注扣费，彩种:广东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1154', 'Y1707012256180', '8021', 'abc123', 'order', '代购', '50.00', '48839.50', '48789.50', '1498920978', '投注扣费，彩种:山东11选5,20170702001');
INSERT INTO `caipiao_fuddetail` VALUES ('1153', 'F1707012236070', '8021', 'abc123', 'order', '代购', '6050.00', '54889.50', '48839.50', '1498919767', '投注扣费，彩种:山东11选5,20170701086');
INSERT INTO `caipiao_fuddetail` VALUES ('1152', 'C1707012234315', '8021', 'abc123', 'order', '代购', '24200.00', '79089.50', '54889.50', '1498919671', '投注扣费，彩种:山东11选5,20170701085');
INSERT INTO `caipiao_fuddetail` VALUES ('1151', 'D1707012228231', '8021', 'abc123', 'order', '代购', '162.00', '79251.50', '79089.50', '1498919303', '投注扣费，彩种:山东11选5,20170701085');
INSERT INTO `caipiao_fuddetail` VALUES ('1150', 'X1707012207273', '8021', 'abc123', 'order', '代购', '18.00', '79269.50', '79251.50', '1498918047', '投注扣费，彩种:山东11选5,20170701083');
INSERT INTO `caipiao_fuddetail` VALUES ('1149', 'W1707012111381', '8021', 'abc123', 'order', '代购', '54450.00', '133719.50', '79269.50', '1498914698', '投注扣费，彩种:广东11选5,20170701074');
INSERT INTO `caipiao_fuddetail` VALUES ('1148', 'A1707012107456', '8021', 'abc123', 'order', '代购', '32.00', '133751.50', '133719.50', '1498914465', '投注扣费，彩种:上海11选5,20170701074');
INSERT INTO `caipiao_fuddetail` VALUES ('1147', 'C1707012101109', '8021', 'abc123', 'order', '代购', '45000.00', '178751.50', '133751.50', '1498914070', '投注扣费，彩种:广东11选5,20170701073');
INSERT INTO `caipiao_fuddetail` VALUES ('1146', 'W1707012100063', '8021', 'abc123', 'order', '代购', '32.00', '178783.50', '178751.50', '1498914006', '投注扣费，彩种:广东11选5,20170701072');
INSERT INTO `caipiao_fuddetail` VALUES ('1145', 'W1707012051262', '8021', 'abc123', 'point', '积分', '1960200.00', '10103050.00', '8142850.00', '1498913801', '撤单扣回赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1144', 'W1707012051262', '8021', 'abc123', 'xima', '洗码', '1960200.00', '5051525.00', '7011725.00', '1498913801', '撤单退回洗码账户');
INSERT INTO `caipiao_fuddetail` VALUES ('1143', 'W1707012051262', '8021', 'abc123', 'cancel', '撤单', '1960200.00', '-1781416.50', '178783.50', '1498913801', '撤单退回');
INSERT INTO `caipiao_fuddetail` VALUES ('1142', 'W1707012051262', '8021', 'abc123', 'order', '代购', '1960200.00', '178783.50', '-1781416.50', '1498913486', '投注扣费，彩种:广东11选5,20170701072');
INSERT INTO `caipiao_fuddetail` VALUES ('1141', 'P1707012008016', '8021', 'abc123', 'order', '代购', '8.00', '178791.50', '178783.50', '1498910881', '投注扣费，彩种:上海11选5,20170701068');
INSERT INTO `caipiao_fuddetail` VALUES ('1140', 'Y1707012007000', '8021', 'abc123', 'order', '代购', '32.00', '178823.50', '178791.50', '1498910820', '投注扣费，彩种:上海11选5,20170701068');
INSERT INTO `caipiao_fuddetail` VALUES ('1139', 'G1707011953247', '8021', 'abc123', 'order', '代购', '2.00', '178825.50', '178823.50', '1498910004', '投注扣费，彩种:上海11选5,20170701067');
INSERT INTO `caipiao_fuddetail` VALUES ('1138', 'R1707011953065', '8021', 'abc123', 'order', '代购', '2.00', '178827.50', '178825.50', '1498909986', '投注扣费，彩种:上海11选5,20170701067');
INSERT INTO `caipiao_fuddetail` VALUES ('1137', 'E1707011952455', '8021', 'abc123', 'order', '代购', '2.00', '178829.50', '178827.50', '1498909965', '投注扣费，彩种:重庆时时彩,20170701084');
INSERT INTO `caipiao_fuddetail` VALUES ('1136', 'WLR1707011117080750', '8022', 'abc123t1', 'activity_cz', '充值活动', '1000.00', '13582.00', '14582.00', '1498879028', '手动充值增加');
INSERT INTO `caipiao_fuddetail` VALUES ('1135', 'G1707011035592325', '8023', 'abc123t2', 'activity_bindcard', '绑定银行赠送活动', '5.00', '21041.34', '21046.34', '1498876559', '绑定银行赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('1134', 'P1706302033158260', '8022', 'abc123t1', 'xima', '洗码', '50.00', '6115.00', '6165.00', '1498874547', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1133', 'P1706302033158260', '8022', 'abc123t1', 'activity_cz', '充值活动', '100.00', '13482.00', '13582.00', '1498874547', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1132', 'S1706302127253188', '8022', 'abc123t1', 'withdraw', '提款退回', '100.00', '13382.00', '13482.00', '1498829711', '提款退回');
INSERT INTO `caipiao_fuddetail` VALUES ('1131', 'S1706302127253188', '8022', 'abc123t1', 'withdraw', '提款退回', '100.00', '13282.00', '13382.00', '1498829327', '提款退回');
INSERT INTO `caipiao_fuddetail` VALUES ('1130', 'S1706302006580792', '8022', 'abc123t1', 'withdraw', '提款退回', '100.00', '13182.00', '13282.00', '1498829287', '提款退回');
INSERT INTO `caipiao_fuddetail` VALUES ('1129', 'E1706302127322187', '8022', 'abc123t1', 'withdraw', '提款', '130.00', '13312.00', '13182.00', '1498829252', 'PC端 提款');
INSERT INTO `caipiao_fuddetail` VALUES ('1128', 'S1706302127253188', '8022', 'abc123t1', 'withdraw', '提款', '100.00', '13412.00', '13312.00', '1498829245', 'PC端 提款');
INSERT INTO `caipiao_fuddetail` VALUES ('1127', 'M1706302033343594', '8022', 'abc123t1', 'xima', '洗码', '65.00', '6050.00', '6115.00', '1498826056', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1126', 'M1706302033343594', '8022', 'abc123t1', 'activity_cz', '充值活动', '130.00', '13282.00', '13412.00', '1498826056', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1125', 'U1706302000131758', '8022', 'abc123t1', 'withdraw', '提款审核通过', '100.00', '13482.00', '13382.00', '1498824566', '提款审核通过');
INSERT INTO `caipiao_fuddetail` VALUES ('1124', 'S1706302006580792', '8022', 'abc123t1', 'withdraw', '提款', '100.00', '13382.00', '13282.00', '1498824418', 'PC端 提款');
INSERT INTO `caipiao_fuddetail` VALUES ('1123', 'U1706302000131758', '8022', 'abc123t1', 'withdraw', '提款', '100.00', '13482.00', '13382.00', '1498824013', 'PC端 提款');
INSERT INTO `caipiao_fuddetail` VALUES ('1122', 'Z1706301934022136', '8022', 'abc123t1', 'withdraw', '提款审核通过', '100.00', '13582.00', '13482.00', '1498822835', '提款审核通过');
INSERT INTO `caipiao_fuddetail` VALUES ('1121', 'X1706301933383607', '8022', 'abc123t1', 'withdraw', '提款审核通过', '100.00', '13682.00', '13582.00', '1498822809', '提款审核通过');
INSERT INTO `caipiao_fuddetail` VALUES ('1120', 'Z1706301934022136', '8022', 'abc123t1', 'withdraw', '提款', '100.00', '13582.00', '13482.00', '1498822442', 'PC端 提款');
INSERT INTO `caipiao_fuddetail` VALUES ('1119', 'X1706301933383607', '8022', 'abc123t1', 'withdraw', '提款', '100.00', '13682.00', '13582.00', '1498822417', 'PC端 提款');
INSERT INTO `caipiao_fuddetail` VALUES ('498', 'A1706011031416', '8021', 'abc123', 'order', '代购', '1.00', '993.00', '992.00', '1496284301', '投注扣费，彩种:江苏快3,20170601013');
INSERT INTO `caipiao_fuddetail` VALUES ('499', 'Z1706011031417', '8021', 'abc123', 'order', '代购', '1.00', '992.00', '991.00', '1496284301', '投注扣费，彩种:江苏快3,20170601013');
INSERT INTO `caipiao_fuddetail` VALUES ('500', 'C1706011031416', '8021', 'abc123', 'order', '代购', '1.00', '991.00', '990.00', '1496284301', '投注扣费，彩种:江苏快3,20170601013');
INSERT INTO `caipiao_fuddetail` VALUES ('501', 'F1706011031413', '8021', 'abc123', 'order', '代购', '1.00', '990.00', '989.00', '1496284301', '投注扣费，彩种:江苏快3,20170601013');
INSERT INTO `caipiao_fuddetail` VALUES ('502', 'M1706011032206', '8021', 'abc123', 'order', '代购', '1.00', '989.00', '988.00', '1496284340', '投注扣费，彩种:湖北快3,20170601010');
INSERT INTO `caipiao_fuddetail` VALUES ('503', 'F1706011032207', '8021', 'abc123', 'order', '代购', '1.00', '988.00', '987.00', '1496284340', '投注扣费，彩种:湖北快3,20170601010');
INSERT INTO `caipiao_fuddetail` VALUES ('504', 'J1706011032208', '8021', 'abc123', 'order', '代购', '1.00', '987.00', '986.00', '1496284340', '投注扣费，彩种:湖北快3,20170601010');
INSERT INTO `caipiao_fuddetail` VALUES ('505', 'O1706011032212', '8021', 'abc123', 'order', '代购', '1.00', '986.00', '985.00', '1496284340', '投注扣费，彩种:湖北快3,20170601010');
INSERT INTO `caipiao_fuddetail` VALUES ('506', 'Y1706011122129', '8021', 'abc123', 'order', '代购', '1.00', '985.00', '984.00', '1496287332', '投注扣费，彩种:湖北快3,20170601015');
INSERT INTO `caipiao_fuddetail` VALUES ('507', 'A1706011122126', '8021', 'abc123', 'order', '代购', '1.00', '984.00', '983.00', '1496287332', '投注扣费，彩种:湖北快3,20170601015');
INSERT INTO `caipiao_fuddetail` VALUES ('508', 'L1706011122121', '8021', 'abc123', 'order', '代购', '1.00', '983.00', '982.00', '1496287332', '投注扣费，彩种:湖北快3,20170601015');
INSERT INTO `caipiao_fuddetail` VALUES ('509', 'R1706011122380', '8021', 'abc123', 'order', '代购', '1.00', '982.00', '981.00', '1496287358', '投注扣费，彩种:安徽快3,20170601017');
INSERT INTO `caipiao_fuddetail` VALUES ('510', 'N1706011122383', '8021', 'abc123', 'order', '代购', '1.00', '981.00', '980.00', '1496287358', '投注扣费，彩种:安徽快3,20170601017');
INSERT INTO `caipiao_fuddetail` VALUES ('511', 'T1706011123073', '8021', 'abc123', 'order', '代购', '1.00', '980.00', '979.00', '1496287387', '投注扣费，彩种:江苏快3,20170601018');
INSERT INTO `caipiao_fuddetail` VALUES ('512', 'T1706011123079', '8021', 'abc123', 'order', '代购', '1.00', '979.00', '978.00', '1496287387', '投注扣费，彩种:江苏快3,20170601018');
INSERT INTO `caipiao_fuddetail` VALUES ('513', 'B1706011123075', '8021', 'abc123', 'order', '代购', '1.00', '978.00', '977.00', '1496287387', '投注扣费，彩种:江苏快3,20170601018');
INSERT INTO `caipiao_fuddetail` VALUES ('514', 'N1706011123390', '8021', 'abc123', 'order', '代购', '1.00', '977.00', '976.00', '1496287419', '投注扣费，彩种:吉林快3,20170601021');
INSERT INTO `caipiao_fuddetail` VALUES ('515', 'Y1706011123399', '8021', 'abc123', 'order', '代购', '1.00', '976.00', '975.00', '1496287419', '投注扣费，彩种:吉林快3,20170601021');
INSERT INTO `caipiao_fuddetail` VALUES ('516', 'J1706011123392', '8021', 'abc123', 'order', '代购', '1.00', '975.00', '974.00', '1496287419', '投注扣费，彩种:吉林快3,20170601021');
INSERT INTO `caipiao_fuddetail` VALUES ('517', 'V1706011124105', '8021', 'abc123', 'order', '代购', '1.00', '974.00', '973.00', '1496287450', '投注扣费，彩种:上海快三,20170601016');
INSERT INTO `caipiao_fuddetail` VALUES ('518', 'M1706011124105', '8021', 'abc123', 'order', '代购', '1.00', '973.00', '972.00', '1496287450', '投注扣费，彩种:上海快三,20170601016');
INSERT INTO `caipiao_fuddetail` VALUES ('519', 'D1706011124107', '8021', 'abc123', 'order', '代购', '1.00', '972.00', '971.00', '1496287450', '投注扣费，彩种:上海快三,20170601016');
INSERT INTO `caipiao_fuddetail` VALUES ('520', 'P1706011511418', '8021', 'abc123', 'order', '代购', '1.00', '971.00', '970.00', '1496301101', '投注扣费，彩种:江苏快3,20170601041');
INSERT INTO `caipiao_fuddetail` VALUES ('521', 'T1706011524509', '8021', 'abc123', 'order', '代购', '1.00', '970.00', '969.00', '1496301890', '投注扣费，彩种:江苏快3,20170601042');
INSERT INTO `caipiao_fuddetail` VALUES ('522', 'K1706020916535', '8017', 'y123456', 'order', '代购', '5.00', '48.10', '43.10', '1496366213', '投注扣费，彩种:北京快3,79110');
INSERT INTO `caipiao_fuddetail` VALUES ('523', 'H1706020933366', '8021', 'abc123', 'order', '代购', '1.00', '969.00', '968.00', '1496367216', '投注扣费，彩种:江苏快3,20170602007');
INSERT INTO `caipiao_fuddetail` VALUES ('524', 'Q1706020933368', '8021', 'abc123', 'order', '代购', '1.00', '968.00', '967.00', '1496367216', '投注扣费，彩种:江苏快3,20170602007');
INSERT INTO `caipiao_fuddetail` VALUES ('525', 'Q1706020933366', '8021', 'abc123', 'order', '代购', '1.00', '967.00', '966.00', '1496367216', '投注扣费，彩种:江苏快3,20170602007');
INSERT INTO `caipiao_fuddetail` VALUES ('526', 'Q1706020955417', '8017', 'y123456', 'order', '代购', '1.00', '43.10', '42.10', '1496368541', '投注扣费，彩种:北京快3,79114');
INSERT INTO `caipiao_fuddetail` VALUES ('527', 'Z1706021016356', '8021', 'abc123', 'order', '代购', '1.00', '966.00', '965.00', '1496369795', '投注扣费，彩种:江苏快3,20170602011');
INSERT INTO `caipiao_fuddetail` VALUES ('528', 'J1706021043122811', '8017', 'y123456', 'activity_cz', '充值活动', '10000.00', '42.10', '10042.10', '1496371416', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('529', 'J1706021043122811', '8017', 'y123456', 'xima', '洗码', '5000.00', '490.00', '5490.00', '1496371416', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('530', 'N1706021042400339', '8021', 'abc123', 'activity_cz', '充值活动', '1000.00', '965.00', '1965.00', '1496371443', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('531', 'N1706021042400339', '8021', 'abc123', 'xima', '洗码', '500.00', '500.00', '1000.00', '1496371443', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('532', 'J1706021049468', '8021', 'abc123', 'order', '代购', '5.00', '1965.00', '1960.00', '1496371786', '投注扣费，彩种:江苏快3,20170602015');
INSERT INTO `caipiao_fuddetail` VALUES ('533', 'R1706021050449', '8021', 'abc123', 'order', '代购', '13.00', '1960.00', '1947.00', '1496371844', '投注扣费，彩种:江苏快3,20170602015');
INSERT INTO `caipiao_fuddetail` VALUES ('534', 'O1706021055016', '8021', 'abc123', 'order', '代购', '1.00', '1947.00', '1946.00', '1496372101', '投注扣费，彩种:江苏快3,20170602015');
INSERT INTO `caipiao_fuddetail` VALUES ('535', 'Q1706021055017', '8021', 'abc123', 'order', '代购', '1.00', '1946.00', '1945.00', '1496372101', '投注扣费，彩种:江苏快3,20170602015');
INSERT INTO `caipiao_fuddetail` VALUES ('536', 'R1706021057514', '8021', 'abc123', 'order', '代购', '2.00', '1945.00', '1943.00', '1496372271', '投注扣费，彩种:江苏快3,20170602015');
INSERT INTO `caipiao_fuddetail` VALUES ('537', 'E1706021107492', '8017', 'y123456', 'order', '代购', '4.00', '10042.10', '10038.10', '1496372869', '投注扣费，彩种:上海快三,20170602015');
INSERT INTO `caipiao_fuddetail` VALUES ('538', 'C1706021113503', '8017', 'y123456', 'order', '代购', '4.00', '10038.10', '10034.10', '1496373230', '投注扣费，彩种:上海快三,20170602015');
INSERT INTO `caipiao_fuddetail` VALUES ('539', 'K1706021114363', '8017', 'y123456', 'order', '代购', '4.00', '10034.10', '10030.10', '1496373276', '投注扣费，彩种:上海快三,20170602015');
INSERT INTO `caipiao_fuddetail` VALUES ('540', 'N1706021135561', '8017', 'y123456', 'order', '代购', '10.00', '10030.10', '10020.10', '1496374556', '投注扣费，彩种:上海快三,20170602017');
INSERT INTO `caipiao_fuddetail` VALUES ('541', 'F1706021135574', '8017', 'y123456', 'order', '代购', '1.00', '10020.10', '10019.10', '1496374556', '投注扣费，彩种:上海快三,20170602017');
INSERT INTO `caipiao_fuddetail` VALUES ('542', 'P1706021135575', '8017', 'y123456', 'order', '代购', '1.00', '10019.10', '10018.10', '1496374556', '投注扣费，彩种:上海快三,20170602017');
INSERT INTO `caipiao_fuddetail` VALUES ('543', 'D1706021136566', '8017', 'y123456', 'order', '代购', '4.00', '10018.10', '10014.10', '1496374616', '投注扣费，彩种:上海快三,20170602018');
INSERT INTO `caipiao_fuddetail` VALUES ('544', 'K1706021137287', '8017', 'y123456', 'order', '代购', '3.00', '10014.10', '10011.10', '1496374648', '投注扣费，彩种:上海快三,20170602018');
INSERT INTO `caipiao_fuddetail` VALUES ('545', 'F1706021552517', '8017', 'y123456', 'order', '代购', '2.00', '10011.10', '10009.10', '1496389971', '投注扣费，彩种:天津时时彩,20170602042');
INSERT INTO `caipiao_fuddetail` VALUES ('546', 'C1706021553254', '8017', 'y123456', 'order', '代购', '4.00', '10009.10', '10005.10', '1496390005', '投注扣费，彩种:天津时时彩,20170602042');
INSERT INTO `caipiao_fuddetail` VALUES ('547', 'P1706021654267', '8017', 'y123456', 'order', '代购', '2.00', '10005.10', '10003.10', '1496393666', '投注扣费，彩种:天津时时彩,20170602048');
INSERT INTO `caipiao_fuddetail` VALUES ('548', 'V1706041109003', '8021', 'abc123', 'order', '代购', '1.00', '1943.00', '1942.00', '1496545740', '投注扣费，彩种:江苏快3,20170604017');
INSERT INTO `caipiao_fuddetail` VALUES ('549', 'E1706041115058', '8021', 'abc123', 'order', '代购', '2.00', '1942.00', '1940.00', '1496546105', '投注扣费，彩种:天津时时彩,20170604014');
INSERT INTO `caipiao_fuddetail` VALUES ('550', 'Y1706041115597', '8021', 'abc123', 'order', '代购', '2.00', '1940.00', '1938.00', '1496546159', '投注扣费，彩种:天津时时彩,20170604014');
INSERT INTO `caipiao_fuddetail` VALUES ('551', 'J1706041121413', '8021', 'abc123', 'order', '代购', '16.00', '1938.00', '1922.00', '1496546501', '投注扣费，彩种:天津时时彩,20170604015');
INSERT INTO `caipiao_fuddetail` VALUES ('552', 'H1706041122243', '8021', 'abc123', 'order', '代购', '1.00', '1922.00', '1921.00', '1496546544', '投注扣费，彩种:江苏快3,20170604018');
INSERT INTO `caipiao_fuddetail` VALUES ('553', 'T1706041124123', '8021', 'abc123', 'order', '代购', '16.00', '1921.00', '1905.00', '1496546652', '投注扣费，彩种:天津时时彩,20170604015');
INSERT INTO `caipiao_fuddetail` VALUES ('554', 'D1706041125002', '8021', 'abc123', 'order', '代购', '1.00', '1905.00', '1904.00', '1496546700', '投注扣费，彩种:江苏快3,20170604018');
INSERT INTO `caipiao_fuddetail` VALUES ('555', 'C1706041736350305', '8021', 'abc123', 'activity_cz', '充值活动', '50000.00', '1904.00', '51904.00', '1496569075', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('556', 'C1706041736350305', '8021', 'abc123', 'xima', '洗码', '25000.00', '1000.00', '26000.00', '1496569075', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('557', 'G1706041739027798', '8021', 'abc123', 'activity_cz', '充值活动', '50000.00', '51904.00', '101904.00', '1496569288', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('558', 'G1706041739027798', '8021', 'abc123', 'xima', '洗码', '25000.00', '26000.00', '51000.00', '1496569288', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('559', 'X1706041741043017', '8021', 'abc123', 'activity_cz', '充值活动', '10000000.00', '101904.00', '10101904.00', '1496569315', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('560', 'X1706041741043017', '8021', 'abc123', 'xima', '洗码', '5000000.00', '51000.00', '5051000.00', '1496569315', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('561', 'Q1706051024593', '8021', 'abc123', 'order', '代购', '5.00', '10101904.00', '10101899.00', '1496629499', '投注扣费，彩种:江苏快3,20170605012');
INSERT INTO `caipiao_fuddetail` VALUES ('562', 'M1706051051448', '8021', 'abc123', 'order', '代购', '1.00', '10101899.00', '10101898.00', '1496631104', '投注扣费，彩种:江苏快3,20170605015');
INSERT INTO `caipiao_fuddetail` VALUES ('563', 'F1706051052302', '8021', 'abc123', 'order', '代购', '1.00', '10101898.00', '10101897.00', '1496631150', '投注扣费，彩种:江苏快3,20170605015');
INSERT INTO `caipiao_fuddetail` VALUES ('564', 'K1706051052303', '8021', 'abc123', 'order', '代购', '1.00', '10101897.00', '10101896.00', '1496631150', '投注扣费，彩种:江苏快3,20170605015');
INSERT INTO `caipiao_fuddetail` VALUES ('565', 'G1706051052309', '8021', 'abc123', 'order', '代购', '1.00', '10101896.00', '10101895.00', '1496631150', '投注扣费，彩种:江苏快3,20170605015');
INSERT INTO `caipiao_fuddetail` VALUES ('566', 'C1706051052304', '8021', 'abc123', 'order', '代购', '1.00', '10101895.00', '10101894.00', '1496631150', '投注扣费，彩种:江苏快3,20170605015');
INSERT INTO `caipiao_fuddetail` VALUES ('567', 'R1706051052301', '8021', 'abc123', 'order', '代购', '1.00', '10101894.00', '10101893.00', '1496631150', '投注扣费，彩种:江苏快3,20170605015');
INSERT INTO `caipiao_fuddetail` VALUES ('568', 'K1706051052302', '8021', 'abc123', 'order', '代购', '1.00', '10101893.00', '10101892.00', '1496631150', '投注扣费，彩种:江苏快3,20170605015');
INSERT INTO `caipiao_fuddetail` VALUES ('569', 'M1706051602196', '8021', 'abc123', 'order', '代购', '40500000.00', '10101892.00', '-30398108.00', '1496649739', '投注扣费，彩种:天津时时彩,20170605043');
INSERT INTO `caipiao_fuddetail` VALUES ('570', 'A1706051623000', '8021', 'abc123', 'order', '代购', '108.00', '30398108.00', '30398000.00', '1496650980', '投注扣费，彩种:天津时时彩,20170605045');
INSERT INTO `caipiao_fuddetail` VALUES ('571', 'Y1706051635334', '8021', 'abc123', 'order', '代购', '2560.00', '30398000.00', '30395440.00', '1496651733', '投注扣费，彩种:天津时时彩,20170605046');
INSERT INTO `caipiao_fuddetail` VALUES ('572', 'O1706051640157', '8021', 'abc123', 'order', '代购', '1.00', '30395440.00', '30395439.00', '1496652015', '投注扣费，彩种:上海快三,20170605048');
INSERT INTO `caipiao_fuddetail` VALUES ('573', 'E1706051640155', '8021', 'abc123', 'order', '代购', '1.00', '30395439.00', '30395438.00', '1496652015', '投注扣费，彩种:上海快三,20170605048');
INSERT INTO `caipiao_fuddetail` VALUES ('574', 'G1706051640156', '8021', 'abc123', 'order', '代购', '1.00', '30395438.00', '30395437.00', '1496652015', '投注扣费，彩种:上海快三,20170605048');
INSERT INTO `caipiao_fuddetail` VALUES ('575', 'T1706051640154', '8021', 'abc123', 'order', '代购', '1.00', '30395437.00', '30395436.00', '1496652015', '投注扣费，彩种:上海快三,20170605048');
INSERT INTO `caipiao_fuddetail` VALUES ('576', 'M1706051602196', '8021', 'abc123', 'reward', '返奖', '8536888.89', '30395436.00', '38932324.89', '1496652354', '天津时时彩第20170605043期-五星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('577', 'N1706051710140', '8021', 'abc123', 'order', '代购', '1440.00', '38932324.89', '38930884.89', '1496653814', '投注扣费，彩种:天津时时彩,20170605050');
INSERT INTO `caipiao_fuddetail` VALUES ('578', 'R1706051710501', '8021', 'abc123', 'order', '代购', '486.00', '38930884.89', '38930398.89', '1496653850', '投注扣费，彩种:重庆时时彩,20170605068');
INSERT INTO `caipiao_fuddetail` VALUES ('579', 'X1706051711248', '8021', 'abc123', 'order', '代购', '486.00', '38930398.89', '38929912.89', '1496653884', '投注扣费，彩种:重庆时时彩,20170605068');
INSERT INTO `caipiao_fuddetail` VALUES ('580', 'G1706051712082', '8021', 'abc123', 'order', '代购', '6250.00', '38929912.89', '38923662.89', '1496653928', '投注扣费，彩种:重庆时时彩,20170605068');
INSERT INTO `caipiao_fuddetail` VALUES ('581', 'R1706051729211', '8021', 'abc123', 'order', '代购', '4800.00', '38923662.89', '38918862.89', '1496654961', '投注扣费，彩种:重庆时时彩,20170605069');
INSERT INTO `caipiao_fuddetail` VALUES ('582', 'M1706051731311', '8021', 'abc123', 'order', '代购', '1080.00', '38918862.89', '38917782.89', '1496655091', '投注扣费，彩种:重庆时时彩,20170605070');
INSERT INTO `caipiao_fuddetail` VALUES ('583', 'W1706051743435', '8021', 'abc123', 'order', '代购', '6250.00', '38917782.89', '38911532.89', '1496655823', '投注扣费，彩种:重庆时时彩,20170605071');
INSERT INTO `caipiao_fuddetail` VALUES ('584', 'N1706051744433', '8021', 'abc123', 'order', '代购', '1.00', '38911532.89', '38911531.89', '1496655883', '投注扣费，彩种:上海快三,20170605054');
INSERT INTO `caipiao_fuddetail` VALUES ('585', 'V1706051744435', '8021', 'abc123', 'order', '代购', '10.00', '38911531.89', '38911521.89', '1496655883', '投注扣费，彩种:上海快三,20170605054');
INSERT INTO `caipiao_fuddetail` VALUES ('586', 'U1706051744439', '8021', 'abc123', 'order', '代购', '10.00', '38911521.89', '38911511.89', '1496655883', '投注扣费，彩种:上海快三,20170605054');
INSERT INTO `caipiao_fuddetail` VALUES ('587', 'Y1706051744430', '8021', 'abc123', 'order', '代购', '1.00', '38911511.89', '38911510.89', '1496655883', '投注扣费，彩种:上海快三,20170605054');
INSERT INTO `caipiao_fuddetail` VALUES ('588', 'I1706051744435', '8021', 'abc123', 'order', '代购', '1.00', '38911510.89', '38911509.89', '1496655883', '投注扣费，彩种:上海快三,20170605054');
INSERT INTO `caipiao_fuddetail` VALUES ('589', 'O1706051744432', '8021', 'abc123', 'order', '代购', '1.00', '38911509.89', '38911508.89', '1496655883', '投注扣费，彩种:上海快三,20170605054');
INSERT INTO `caipiao_fuddetail` VALUES ('590', 'X1706051757084', '8021', 'abc123', 'order', '代购', '6250.00', '38911508.89', '38905258.89', '1496656628', '投注扣费，彩种:重庆时时彩,20170605072');
INSERT INTO `caipiao_fuddetail` VALUES ('591', 'Z1706052330522', '8021', 'abc123', 'order', '代购', '6250.00', '38905258.89', '38899008.89', '1496676652', '投注扣费，彩种:新疆时时彩,20170605082');
INSERT INTO `caipiao_fuddetail` VALUES ('592', 'X1706052332492', '8021', 'abc123', 'order', '代购', '6250.00', '38899008.89', '38892758.89', '1496676769', '投注扣费，彩种:重庆时时彩,20170605115');
INSERT INTO `caipiao_fuddetail` VALUES ('593', 'C1706052335502', '8021', 'abc123', 'order', '代购', '6250.00', '38892758.89', '38886508.89', '1496676950', '投注扣费，彩种:重庆时时彩,20170605116');
INSERT INTO `caipiao_fuddetail` VALUES ('594', 'K1706052342429', '8021', 'abc123', 'order', '代购', '6250.00', '38886508.89', '38880258.89', '1496677362', '投注扣费，彩种:重庆时时彩,20170605117');
INSERT INTO `caipiao_fuddetail` VALUES ('595', 'R1706052347244', '8021', 'abc123', 'order', '代购', '6250.00', '38880258.89', '38874008.89', '1496677644', '投注扣费，彩种:重庆时时彩,20170605118');
INSERT INTO `caipiao_fuddetail` VALUES ('596', 'T1706052351054', '8021', 'abc123', 'order', '代购', '6250.00', '38874008.89', '38867758.89', '1496677865', '投注扣费，彩种:重庆时时彩,20170605119');
INSERT INTO `caipiao_fuddetail` VALUES ('597', 'R1706052355274', '8021', 'abc123', 'order', '代购', '6250.00', '38867758.89', '38861508.89', '1496678127', '投注扣费，彩种:重庆时时彩,20170605120');
INSERT INTO `caipiao_fuddetail` VALUES ('598', 'Y1706060036073', '8021', 'abc123', 'order', '代购', '6250.00', '38861508.89', '38855258.89', '1496680567', '投注扣费，彩种:重庆时时彩,20170606008');
INSERT INTO `caipiao_fuddetail` VALUES ('599', 'C1706060054439', '8021', 'abc123', 'order', '代购', '6250.00', '38855258.89', '38849008.89', '1496681683', '投注扣费，彩种:重庆时时彩,20170606011');
INSERT INTO `caipiao_fuddetail` VALUES ('600', 'I1706060857535', '8021', 'abc123', 'order', '代购', '6250.00', '38849008.89', '38842758.89', '1496710673', '投注扣费，彩种:天津时时彩,20170606001');
INSERT INTO `caipiao_fuddetail` VALUES ('601', 'X1706060919334', '8021', 'abc123', 'order', '代购', '6250.00', '38842758.89', '38836508.89', '1496711973', '投注扣费，彩种:天津时时彩,20170606003');
INSERT INTO `caipiao_fuddetail` VALUES ('602', 'H1706060932241', '8021', 'abc123', 'order', '代购', '6250.00', '38836508.89', '38830258.89', '1496712744', '投注扣费，彩种:天津时时彩,20170606004');
INSERT INTO `caipiao_fuddetail` VALUES ('603', 'D1706060937417', '8021', 'abc123', 'order', '代购', '6250.00', '38830258.89', '38824008.89', '1496713061', '投注扣费，彩种:天津时时彩,20170606004');
INSERT INTO `caipiao_fuddetail` VALUES ('604', 'E1706061008081', '8021', 'abc123', 'order', '代购', '6250.00', '38824008.89', '38817758.89', '1496714888', '投注扣费，彩种:重庆时时彩,20170606025');
INSERT INTO `caipiao_fuddetail` VALUES ('605', 'K1706061008406', '8021', 'abc123', 'order', '代购', '6250.00', '38817758.89', '38811508.89', '1496714920', '投注扣费，彩种:新疆时时彩,20170606001');
INSERT INTO `caipiao_fuddetail` VALUES ('606', 'H1706061009224', '8021', 'abc123', 'order', '代购', '6250.00', '38811508.89', '38805258.89', '1496714962', '投注扣费，彩种:天津时时彩,20170606007');
INSERT INTO `caipiao_fuddetail` VALUES ('607', 'D1706061009526', '8021', 'abc123', 'order', '代购', '6250.00', '38805258.89', '38799008.89', '1496714992', '投注扣费，彩种:新疆时时彩,20170606001');
INSERT INTO `caipiao_fuddetail` VALUES ('608', 'P1706061010217', '8021', 'abc123', 'order', '代购', '6250.00', '38799008.89', '38792758.89', '1496715021', '投注扣费，彩种:重庆时时彩,20170606026');
INSERT INTO `caipiao_fuddetail` VALUES ('609', 'M1706061021435', '8021', 'abc123', 'order', '代购', '2.00', '38792758.89', '38792756.89', '1496715703', '投注扣费，彩种:天津时时彩,20170606009');
INSERT INTO `caipiao_fuddetail` VALUES ('610', 'J1706061022079', '8021', 'abc123', 'order', '代购', '2.00', '38792756.89', '38792754.89', '1496715727', '投注扣费，彩种:新疆时时彩,20170606003');
INSERT INTO `caipiao_fuddetail` VALUES ('611', 'X1706061022437', '8021', 'abc123', 'order', '代购', '2.00', '38792754.89', '38792752.89', '1496715763', '投注扣费，彩种:重庆时时彩,20170606027');
INSERT INTO `caipiao_fuddetail` VALUES ('612', 'X1706061022437', '8021', 'abc123', 'reward', '返奖', '196000.00', '38792752.89', '38988752.89', '1496717798', '重庆时时彩第20170606027期-五星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('613', 'M1706061021435', '8021', 'abc123', 'reward', '返奖', '196000.00', '38988752.89', '39184752.89', '1496717798', '天津时时彩第20170606009期-五星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('614', 'S1706061108395', '8021', 'abc123', 'order', '代购', '2.00', '39184752.89', '39184750.89', '1496718519', '投注扣费，彩种:重庆时时彩,20170606031');
INSERT INTO `caipiao_fuddetail` VALUES ('615', 'K1706061108584', '8021', 'abc123', 'order', '代购', '2.00', '39184750.89', '39184748.89', '1496718538', '投注扣费，彩种:新疆时时彩,20170606007');
INSERT INTO `caipiao_fuddetail` VALUES ('616', 'J1706061109471', '8021', 'abc123', 'order', '代购', '2.00', '39184748.89', '39184746.89', '1496718587', '投注扣费，彩种:天津时时彩,20170606014');
INSERT INTO `caipiao_fuddetail` VALUES ('617', 'J1706061109471', '8021', 'abc123', 'reward', '返奖', '196000.00', '39184746.89', '39380746.89', '1496719777', '天津时时彩第20170606014期-五星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('618', 'S1706061108395', '8021', 'abc123', 'reward', '返奖', '196000.00', '39380746.89', '39576746.89', '1496719777', '重庆时时彩第20170606031期-五星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('619', 'E1706061145472', '8021', 'abc123', 'order', '代购', '10.00', '39576746.89', '39576736.89', '1496720747', '投注扣费，彩种:江苏快3,20170606020');
INSERT INTO `caipiao_fuddetail` VALUES ('620', 'D1706061145477', '8021', 'abc123', 'order', '代购', '1.00', '39576736.89', '39576735.89', '1496720747', '投注扣费，彩种:江苏快3,20170606020');
INSERT INTO `caipiao_fuddetail` VALUES ('621', 'P1706061145476', '8021', 'abc123', 'order', '代购', '10.00', '39576735.89', '39576725.89', '1496720747', '投注扣费，彩种:江苏快3,20170606020');
INSERT INTO `caipiao_fuddetail` VALUES ('622', 'L1706061145470', '8021', 'abc123', 'order', '代购', '10.00', '39576725.89', '39576715.89', '1496720747', '投注扣费，彩种:江苏快3,20170606020');
INSERT INTO `caipiao_fuddetail` VALUES ('623', 'A1706061145470', '8021', 'abc123', 'order', '代购', '1.00', '39576715.89', '39576714.89', '1496720747', '投注扣费，彩种:江苏快3,20170606020');
INSERT INTO `caipiao_fuddetail` VALUES ('624', 'J1706061145470', '8021', 'abc123', 'order', '代购', '1.00', '39576714.89', '39576713.89', '1496720747', '投注扣费，彩种:江苏快3,20170606020');
INSERT INTO `caipiao_fuddetail` VALUES ('625', 'L1706061145476', '8021', 'abc123', 'order', '代购', '1.00', '39576713.89', '39576712.89', '1496720747', '投注扣费，彩种:江苏快3,20170606020');
INSERT INTO `caipiao_fuddetail` VALUES ('626', 'L1706061145470', '8021', 'abc123', 'reward', '返奖', '19.50', '39576712.89', '39576732.39', '1496721035', '江苏快3第20170606020期-和值单');
INSERT INTO `caipiao_fuddetail` VALUES ('627', 'P1706061145476', '8021', 'abc123', 'reward', '返奖', '19.50', '39576732.39', '39576751.89', '1496721035', '江苏快3第20170606020期-和值小');
INSERT INTO `caipiao_fuddetail` VALUES ('628', 'I1706061713068', '8021', 'abc123', 'order', '代购', '6250.00', '39576751.89', '39570501.89', '1496740386', '投注扣费，彩种:大发时时彩,20170606263');
INSERT INTO `caipiao_fuddetail` VALUES ('629', 'V1706061713305', '8021', 'abc123', 'order', '代购', '216.00', '39570501.89', '39570285.89', '1496740410', '投注扣费，彩种:大发时时彩,20170606263');
INSERT INTO `caipiao_fuddetail` VALUES ('630', 'I1706061714008', '8021', 'abc123', 'order', '代购', '6250.00', '39570285.89', '39564035.89', '1496740440', '投注扣费，彩种:大发时时彩,20170606264');
INSERT INTO `caipiao_fuddetail` VALUES ('631', 'V1706061714433', '8021', 'abc123', 'order', '代购', '6250.00', '39564035.89', '39557785.89', '1496740483', '投注扣费，彩种:大发时时彩,20170606264');
INSERT INTO `caipiao_fuddetail` VALUES ('632', 'H1706061714587', '8021', 'abc123', 'order', '代购', '6250.00', '39557785.89', '39551535.89', '1496740498', '投注扣费，彩种:大发时时彩,20170606264');
INSERT INTO `caipiao_fuddetail` VALUES ('633', 'Y1706061720101', '8021', 'abc123', 'order', '代购', '2.00', '10000.00', '9998.00', '1496740810', '投注扣费，彩种:大发时时彩,20170606267');
INSERT INTO `caipiao_fuddetail` VALUES ('634', 'D1706061720365', '8021', 'abc123', 'order', '代购', '6.00', '9998.00', '9992.00', '1496740836', '投注扣费，彩种:大发时时彩,20170606267');
INSERT INTO `caipiao_fuddetail` VALUES ('635', 'J1706061721053', '8021', 'abc123', 'order', '代购', '504.00', '9992.00', '9488.00', '1496740865', '投注扣费，彩种:大发时时彩,20170606267');
INSERT INTO `caipiao_fuddetail` VALUES ('636', 'R1706061721273', '8021', 'abc123', 'order', '代购', '1680.00', '9488.00', '7808.00', '1496740887', '投注扣费，彩种:大发时时彩,20170606267');
INSERT INTO `caipiao_fuddetail` VALUES ('637', 'Q1706061721470', '8021', 'abc123', 'order', '代购', '720.00', '7808.00', '7088.00', '1496740907', '投注扣费，彩种:大发时时彩,20170606267');
INSERT INTO `caipiao_fuddetail` VALUES ('638', 'Y1706061722074', '8021', 'abc123', 'order', '代购', '720.00', '7088.00', '6368.00', '1496740927', '投注扣费，彩种:大发时时彩,20170606268');
INSERT INTO `caipiao_fuddetail` VALUES ('639', 'Y1706061723255', '8021', 'abc123', 'order', '代购', '180.00', '6368.00', '6188.00', '1496741005', '投注扣费，彩种:大发时时彩,20170606268');
INSERT INTO `caipiao_fuddetail` VALUES ('640', 'G1706061723371', '8021', 'abc123', 'order', '代购', '180.00', '6188.00', '6008.00', '1496741017', '投注扣费，彩种:大发时时彩,20170606268');
INSERT INTO `caipiao_fuddetail` VALUES ('641', 'J1706061721053', '8021', 'abc123', 'reward', '返奖', '1541.00', '6008.00', '7549.00', '1496741710', '大发时时彩第20170606267期-组选120');
INSERT INTO `caipiao_fuddetail` VALUES ('642', 'D1706061720365', '8021', 'abc123', 'reward', '返奖', '196000.00', '7549.00', '203549.00', '1496742715', '大发时时彩第20170606267期-五星单式');
INSERT INTO `caipiao_fuddetail` VALUES ('643', 'D1706061720365', '8021', 'abc123', 'reward', '返奖', '588000.00', '10000.00', '598000.00', '1496742839', '大发时时彩第20170606267期-五星单式');
INSERT INTO `caipiao_fuddetail` VALUES ('644', 'J1706061721053', '8021', 'abc123', 'reward', '返奖', '1541.00', '10000.00', '11541.00', '1496742926', '大发时时彩第20170606267期-组选120');
INSERT INTO `caipiao_fuddetail` VALUES ('645', 'R1706061721273', '8021', 'abc123', 'reward', '返奖', '3270.00', '10000.00', '13270.00', '1496745748', '大发时时彩第20170606267期-组选60');
INSERT INTO `caipiao_fuddetail` VALUES ('646', 'Q1706061721470', '8021', 'abc123', 'reward', '返奖', '6540.00', '10000.00', '16540.00', '1496745889', '大发时时彩第20170606267期-组选30');
INSERT INTO `caipiao_fuddetail` VALUES ('647', 'C1706061848380', '8021', 'abc123', 'order', '代购', '2.00', '10000.00', '9998.00', '1496746118', '投注扣费，彩种:大发时时彩,20170606311');
INSERT INTO `caipiao_fuddetail` VALUES ('648', 'Y1706061722074', '8021', 'abc123', 'reward', '返奖', '9810.00', '9998.00', '19808.00', '1496748156', '大发时时彩第20170606268期-组选20');
INSERT INTO `caipiao_fuddetail` VALUES ('649', 'R1706061721273', '8021', 'abc123', 'reward', '返奖', '3270.00', '19808.00', '23078.00', '1496749076', '大发时时彩第20170606267期-组选60');
INSERT INTO `caipiao_fuddetail` VALUES ('650', 'Q1706061721470', '8021', 'abc123', 'reward', '返奖', '6540.00', '23078.00', '29618.00', '1496749237', '大发时时彩第20170606267期-组选30');
INSERT INTO `caipiao_fuddetail` VALUES ('651', 'Q1706061721470', '8021', 'abc123', 'reward', '返奖', '6540.00', '29618.00', '36158.00', '1496750347', '大发时时彩第20170606267期-组选30');
INSERT INTO `caipiao_fuddetail` VALUES ('652', 'Q1706061721470', '8021', 'abc123', 'reward', '返奖', '6540.00', '36158.00', '42698.00', '1496750453', '大发时时彩第20170606267期-组选30');
INSERT INTO `caipiao_fuddetail` VALUES ('653', 'R1706061721273', '8021', 'abc123', 'reward', '返奖', '3270.00', '42698.00', '45968.00', '1496750978', '大发时时彩第20170606267期-组选60');
INSERT INTO `caipiao_fuddetail` VALUES ('654', 'Q1706061721470', '8021', 'abc123', 'reward', '返奖', '6540.00', '45968.00', '52508.00', '1496751273', '大发时时彩第20170606267期-组选30');
INSERT INTO `caipiao_fuddetail` VALUES ('655', 'E1706081114542', '8017', 'y123456', 'order', '代购', '10.00', '10003.10', '9993.10', '1496891694', '投注扣费，彩种:大发时时彩,20170608338');
INSERT INTO `caipiao_fuddetail` VALUES ('656', 'T1706081117594', '8021', 'abc123', 'order', '代购', '6250.00', '52508.00', '46258.00', '1496891879', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('657', 'F1706081118143', '8017', 'y123456', 'order', '代购', '4.00', '9993.10', '9989.10', '1496891894', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('658', 'T1706081118213', '8021', 'abc123', 'order', '代购', '4.00', '46258.00', '46254.00', '1496891901', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('659', 'S1706081118266', '8017', 'y123456', 'order', '代购', '4.00', '9989.10', '9985.10', '1496891906', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('660', 'T1706081118479', '8021', 'abc123', 'order', '代购', '4.00', '46254.00', '46250.00', '1496891927', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('661', 'O1706081118496', '8017', 'y123456', 'order', '代购', '16.00', '9985.10', '9969.10', '1496891929', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('662', 'B1706081119035', '8021', 'abc123', 'order', '代购', '504.00', '46250.00', '45746.00', '1496891943', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('663', 'F1706081119097', '8017', 'y123456', 'order', '代购', '12.00', '9969.10', '9957.10', '1496891949', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('664', 'R1706081119191', '8017', 'y123456', 'order', '代购', '4.00', '9957.10', '9953.10', '1496891959', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('665', 'P1706081119335', '8017', 'y123456', 'order', '代购', '12.00', '9953.10', '9941.10', '1496891973', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('666', 'I1706081119341', '8021', 'abc123', 'order', '代购', '2.00', '45746.00', '45744.00', '1496891974', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('667', 'R1706081119421', '8017', 'y123456', 'order', '代购', '12.00', '9941.10', '9929.10', '1496891982', '投注扣费，彩种:大发时时彩,20170608340');
INSERT INTO `caipiao_fuddetail` VALUES ('668', 'Y1706081120077', '8021', 'abc123', 'order', '代购', '2.00', '45744.00', '45742.00', '1496892007', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('669', 'N1706081120102', '8017', 'y123456', 'order', '代购', '6.00', '9929.10', '9923.10', '1496892010', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('670', 'L1706081120350', '8017', 'y123456', 'order', '代购', '10.00', '9923.10', '9913.10', '1496892035', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('671', 'C1706081120410', '8021', 'abc123', 'order', '代购', '4.00', '45742.00', '45738.00', '1496892041', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('672', 'L1706081120435', '8017', 'y123456', 'order', '代购', '6.00', '9913.10', '9907.10', '1496892043', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('673', 'W1706081120531', '8017', 'y123456', 'order', '代购', '12.00', '9907.10', '9895.10', '1496892053', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('674', 'N1706081121023', '8017', 'y123456', 'order', '代购', '20.00', '9895.10', '9875.10', '1496892062', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('675', 'N1706081121150', '8017', 'y123456', 'order', '代购', '8.00', '9875.10', '9867.10', '1496892075', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('676', 'W1706081121249', '8017', 'y123456', 'order', '代购', '10.00', '9867.10', '9857.10', '1496892084', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('677', 'A1706081121330', '8017', 'y123456', 'order', '代购', '8.00', '9857.10', '9849.10', '1496892093', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('678', 'B1706081121423', '8017', 'y123456', 'order', '代购', '6.00', '9849.10', '9843.10', '1496892102', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('679', 'A1706081121440', '8021', 'abc123', 'order', '代购', '4.00', '45738.00', '45734.00', '1496892104', '投注扣费，彩种:大发时时彩,20170608341');
INSERT INTO `caipiao_fuddetail` VALUES ('680', 'U1706081121568', '8017', 'y123456', 'order', '代购', '8.00', '9843.10', '9835.10', '1496892116', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('681', 'X1706081122003', '8021', 'abc123', 'order', '代购', '4.00', '45734.00', '45730.00', '1496892120', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('682', 'E1706081122158', '8017', 'y123456', 'order', '代购', '6.00', '9835.10', '9829.10', '1496892135', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('683', 'W1706081122322', '8017', 'y123456', 'order', '代购', '2.00', '9829.10', '9827.10', '1496892152', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('684', 'E1706081122424', '8017', 'y123456', 'order', '代购', '6.00', '9827.10', '9821.10', '1496892162', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('685', 'F1706081122481', '8021', 'abc123', 'order', '代购', '2.00', '45730.00', '45728.00', '1496892168', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('686', 'I1706081123013', '8017', 'y123456', 'order', '代购', '90.00', '9821.10', '9731.10', '1496892181', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('687', 'L1706081123039', '8021', 'abc123', 'order', '代购', '2.00', '45728.00', '45726.00', '1496892183', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('688', 'Z1706081123118', '8017', 'y123456', 'order', '代购', '10.00', '9731.10', '9721.10', '1496892191', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('689', 'B1706081123196', '8021', 'abc123', 'order', '代购', '2.00', '45726.00', '45724.00', '1496892199', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('690', 'U1706081123206', '8017', 'y123456', 'order', '代购', '6.00', '9721.10', '9715.10', '1496892200', '投注扣费，彩种:大发时时彩,20170608342');
INSERT INTO `caipiao_fuddetail` VALUES ('691', 'D1706081124029', '8021', 'abc123', 'order', '代购', '2.00', '45724.00', '45722.00', '1496892242', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('692', 'W1706081124151', '8021', 'abc123', 'order', '代购', '2.00', '45722.00', '45720.00', '1496892255', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('693', 'P1706081124304', '8017', 'y123456', 'order', '代购', '4.00', '9715.10', '9711.10', '1496892270', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('694', 'E1706081124312', '8021', 'abc123', 'order', '代购', '2.00', '45720.00', '45718.00', '1496892271', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('695', 'I1706081124404', '8021', 'abc123', 'order', '代购', '20.00', '45718.00', '45698.00', '1496892280', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('696', 'O1706081124519', '8021', 'abc123', 'order', '代购', '2.00', '45698.00', '45696.00', '1496892291', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('697', 'A1706081124563', '8017', 'y123456', 'order', '代购', '8.00', '9711.10', '9703.10', '1496892296', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('698', 'F1706081125009', '8021', 'abc123', 'order', '代购', '90.00', '45696.00', '45606.00', '1496892300', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('699', 'I1706081125090', '8021', 'abc123', 'order', '代购', '2.00', '45606.00', '45604.00', '1496892309', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('700', 'T1706081125160', '8021', 'abc123', 'order', '代购', '240.00', '45604.00', '45364.00', '1496892316', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('701', 'R1706081125313', '8021', 'abc123', 'order', '代购', '20.00', '45364.00', '45344.00', '1496892331', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('702', 'P1706081125382', '8017', 'y123456', 'order', '代购', '2000.00', '9703.10', '7703.10', '1496892338', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('703', 'Y1706081125417', '8021', 'abc123', 'order', '代购', '4.00', '45344.00', '45340.00', '1496892341', '投注扣费，彩种:大发时时彩,20170608343');
INSERT INTO `caipiao_fuddetail` VALUES ('704', 'H1706081125579', '8021', 'abc123', 'order', '代购', '20.00', '45340.00', '45320.00', '1496892357', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('705', 'P1706081126043', '8017', 'y123456', 'order', '代购', '180.00', '7703.10', '7523.10', '1496892364', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('706', 'G1706081126085', '8021', 'abc123', 'order', '代购', '6.00', '45320.00', '45314.00', '1496892368', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('707', 'U1706081126127', '8017', 'y123456', 'order', '代购', '240.00', '7523.10', '7283.10', '1496892372', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('708', 'P1706081126144', '8021', 'abc123', 'order', '代购', '10.00', '45314.00', '45304.00', '1496892374', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('709', 'X1706081126215', '8021', 'abc123', 'order', '代购', '20.00', '45304.00', '45284.00', '1496892381', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('710', 'H1706081126436', '8021', 'abc123', 'order', '代购', '6.00', '45284.00', '45278.00', '1496892403', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('711', 'M1706081126509', '8021', 'abc123', 'order', '代购', '20.00', '45278.00', '45258.00', '1496892410', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('712', 'V1706081127105', '8017', 'y123456', 'order', '代购', '200.00', '7283.10', '7083.10', '1496892430', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('713', 'N1706081127190', '8021', 'abc123', 'order', '代购', '1250.00', '45258.00', '44008.00', '1496892439', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('714', 'K1706081127345', '8021', 'abc123', 'order', '代购', '4.00', '44008.00', '44004.00', '1496892454', '投注扣费，彩种:大发时时彩,20170608344');
INSERT INTO `caipiao_fuddetail` VALUES ('715', 'W1706081128290', '8021', 'abc123', 'order', '代购', '4.00', '44004.00', '44000.00', '1496892509', '投注扣费，彩种:大发时时彩,20170608345');
INSERT INTO `caipiao_fuddetail` VALUES ('716', 'H1706081128471', '8021', 'abc123', 'order', '代购', '420.00', '44000.00', '43580.00', '1496892527', '投注扣费，彩种:大发时时彩,20170608345');
INSERT INTO `caipiao_fuddetail` VALUES ('717', 'I1706081129079', '8021', 'abc123', 'order', '代购', '2.00', '43580.00', '43578.00', '1496892547', '投注扣费，彩种:大发时时彩,20170608345');
INSERT INTO `caipiao_fuddetail` VALUES ('718', 'Y1706081129195', '8021', 'abc123', 'order', '代购', '720.00', '43578.00', '42858.00', '1496892559', '投注扣费，彩种:大发时时彩,20170608345');
INSERT INTO `caipiao_fuddetail` VALUES ('719', 'O1706081129429', '8021', 'abc123', 'order', '代购', '12.00', '42858.00', '42846.00', '1496892582', '投注扣费，彩种:大发时时彩,20170608345');
INSERT INTO `caipiao_fuddetail` VALUES ('720', 'F1706081129492', '8021', 'abc123', 'order', '代购', '90.00', '42846.00', '42756.00', '1496892589', '投注扣费，彩种:大发时时彩,20170608345');
INSERT INTO `caipiao_fuddetail` VALUES ('721', 'L1706081130033', '8021', 'abc123', 'order', '代购', '2.00', '42756.00', '42754.00', '1496892603', '投注扣费，彩种:大发时时彩,20170608346');
INSERT INTO `caipiao_fuddetail` VALUES ('722', 'M1706081130109', '8021', 'abc123', 'order', '代购', '180.00', '42754.00', '42574.00', '1496892610', '投注扣费，彩种:大发时时彩,20170608346');
INSERT INTO `caipiao_fuddetail` VALUES ('723', 'S1706081130231', '8021', 'abc123', 'order', '代购', '6.00', '42574.00', '42568.00', '1496892623', '投注扣费，彩种:大发时时彩,20170608346');
INSERT INTO `caipiao_fuddetail` VALUES ('724', 'F1706081130336', '8021', 'abc123', 'order', '代购', '20.00', '42568.00', '42548.00', '1496892633', '投注扣费，彩种:大发时时彩,20170608346');
INSERT INTO `caipiao_fuddetail` VALUES ('725', 'E1706081132287', '8021', 'abc123', 'order', '代购', '90.00', '42548.00', '42458.00', '1496892748', '投注扣费，彩种:大发时时彩,20170608347');
INSERT INTO `caipiao_fuddetail` VALUES ('726', 'T1706081133084', '8021', 'abc123', 'order', '代购', '2000.00', '42458.00', '40458.00', '1496892788', '投注扣费，彩种:大发时时彩,20170608347');
INSERT INTO `caipiao_fuddetail` VALUES ('727', 'L1706081133416', '8021', 'abc123', 'order', '代购', '6.00', '40458.00', '40452.00', '1496892821', '投注扣费，彩种:大发时时彩,20170608347');
INSERT INTO `caipiao_fuddetail` VALUES ('728', 'Y1706081134028', '8021', 'abc123', 'order', '代购', '150.00', '40452.00', '40302.00', '1496892842', '投注扣费，彩种:大发时时彩,20170608348');
INSERT INTO `caipiao_fuddetail` VALUES ('729', 'O1706081147296', '8021', 'abc123', 'order', '代购', '2000.00', '40302.00', '38302.00', '1496893649', '投注扣费，彩种:大发时时彩,20170608354');
INSERT INTO `caipiao_fuddetail` VALUES ('730', 'A1706081147455', '8021', 'abc123', 'order', '代购', '2000.00', '38302.00', '36302.00', '1496893665', '投注扣费，彩种:大发时时彩,20170608354');
INSERT INTO `caipiao_fuddetail` VALUES ('731', 'E1706081149496', '8021', 'abc123', 'order', '代购', '420.00', '36302.00', '35882.00', '1496893789', '投注扣费，彩种:大发时时彩,20170608355');
INSERT INTO `caipiao_fuddetail` VALUES ('732', 'M1706081149595', '8021', 'abc123', 'order', '代购', '180.00', '35882.00', '35702.00', '1496893799', '投注扣费，彩种:大发时时彩,20170608356');
INSERT INTO `caipiao_fuddetail` VALUES ('733', 'H1706081150086', '8021', 'abc123', 'order', '代购', '240.00', '35702.00', '35462.00', '1496893808', '投注扣费，彩种:大发时时彩,20170608356');
INSERT INTO `caipiao_fuddetail` VALUES ('734', 'P1706081151385', '8021', 'abc123', 'order', '代购', '14.00', '35462.00', '35448.00', '1496893898', '投注扣费，彩种:大发时时彩,20170608356');
INSERT INTO `caipiao_fuddetail` VALUES ('735', 'D1706081153009', '8021', 'abc123', 'order', '代购', '20.00', '35448.00', '35428.00', '1496893980', '投注扣费，彩种:大发时时彩,20170608357');
INSERT INTO `caipiao_fuddetail` VALUES ('736', 'E1706081155110', '8021', 'abc123', 'order', '代购', '108.00', '35428.00', '35320.00', '1496894111', '投注扣费，彩种:大发时时彩,20170608358');
INSERT INTO `caipiao_fuddetail` VALUES ('737', 'I1706081155208', '8021', 'abc123', 'order', '代购', '90.00', '35320.00', '35230.00', '1496894120', '投注扣费，彩种:大发时时彩,20170608358');
INSERT INTO `caipiao_fuddetail` VALUES ('738', 'K1706081155342', '8021', 'abc123', 'order', '代购', '2000.00', '35230.00', '33230.00', '1496894134', '投注扣费，彩种:大发时时彩,20170608358');
INSERT INTO `caipiao_fuddetail` VALUES ('739', 'K1706081155597', '8021', 'abc123', 'order', '代购', '14.00', '33230.00', '33216.00', '1496894159', '投注扣费，彩种:大发时时彩,20170608359');
INSERT INTO `caipiao_fuddetail` VALUES ('740', 'W1706081202405', '8021', 'abc123', 'order', '代购', '420.00', '33216.00', '32796.00', '1496894560', '投注扣费，彩种:大发时时彩,20170608362');
INSERT INTO `caipiao_fuddetail` VALUES ('741', 'U1706081202528', '8021', 'abc123', 'order', '代购', '180.00', '32796.00', '32616.00', '1496894572', '投注扣费，彩种:大发时时彩,20170608362');
INSERT INTO `caipiao_fuddetail` VALUES ('742', 'I1706081203255', '8021', 'abc123', 'order', '代购', '240.00', '32616.00', '32376.00', '1496894605', '投注扣费，彩种:大发时时彩,20170608362');
INSERT INTO `caipiao_fuddetail` VALUES ('743', 'D1706081203368', '8021', 'abc123', 'order', '代购', '2000.00', '32376.00', '30376.00', '1496894616', '投注扣费，彩种:大发时时彩,20170608362');
INSERT INTO `caipiao_fuddetail` VALUES ('744', 'M1706081203543', '8021', 'abc123', 'order', '代购', '8.00', '30376.00', '30368.00', '1496894634', '投注扣费，彩种:大发时时彩,20170608363');
INSERT INTO `caipiao_fuddetail` VALUES ('745', 'Z1706081204430', '8021', 'abc123', 'order', '代购', '108.00', '30368.00', '30260.00', '1496894683', '投注扣费，彩种:大发时时彩,20170608363');
INSERT INTO `caipiao_fuddetail` VALUES ('746', 'Q1706081207478', '8021', 'abc123', 'order', '代购', '108.00', '30260.00', '30152.00', '1496894867', '投注扣费，彩种:大发时时彩,20170608364');
INSERT INTO `caipiao_fuddetail` VALUES ('747', 'E1706081223017', '8021', 'abc123', 'order', '代购', '2.00', '30152.00', '30150.00', '1496895781', '投注扣费，彩种:大发时时彩,20170608372');
INSERT INTO `caipiao_fuddetail` VALUES ('748', 'C1706081223118', '8021', 'abc123', 'order', '代购', '2.00', '30150.00', '30148.00', '1496895791', '投注扣费，彩种:大发时时彩,20170608372');
INSERT INTO `caipiao_fuddetail` VALUES ('749', 'N1706081223328', '8021', 'abc123', 'order', '代购', '2000.00', '30148.00', '28148.00', '1496895812', '投注扣费，彩种:大发时时彩,20170608372');
INSERT INTO `caipiao_fuddetail` VALUES ('750', 'R1706081223495', '8021', 'abc123', 'order', '代购', '10.00', '28148.00', '28138.00', '1496895829', '投注扣费，彩种:大发时时彩,20170608372');
INSERT INTO `caipiao_fuddetail` VALUES ('751', 'I1706081223595', '8021', 'abc123', 'order', '代购', '2000.00', '28138.00', '26138.00', '1496895839', '投注扣费，彩种:大发时时彩,20170608373');
INSERT INTO `caipiao_fuddetail` VALUES ('752', 'A1706081224109', '8021', 'abc123', 'order', '代购', '2000.00', '26138.00', '24138.00', '1496895850', '投注扣费，彩种:大发时时彩,20170608373');
INSERT INTO `caipiao_fuddetail` VALUES ('753', 'L1706081224205', '8021', 'abc123', 'order', '代购', '420.00', '24138.00', '23718.00', '1496895860', '投注扣费，彩种:大发时时彩,20170608373');
INSERT INTO `caipiao_fuddetail` VALUES ('754', 'U1706081224305', '8021', 'abc123', 'order', '代购', '180.00', '23718.00', '23538.00', '1496895870', '投注扣费，彩种:大发时时彩,20170608373');
INSERT INTO `caipiao_fuddetail` VALUES ('755', 'Z1706081224384', '8021', 'abc123', 'order', '代购', '240.00', '23538.00', '23298.00', '1496895878', '投注扣费，彩种:大发时时彩,20170608373');
INSERT INTO `caipiao_fuddetail` VALUES ('756', 'X1706081224547', '8021', 'abc123', 'order', '代购', '10.00', '23298.00', '23288.00', '1496895894', '投注扣费，彩种:大发时时彩,20170608373');
INSERT INTO `caipiao_fuddetail` VALUES ('757', 'W1706081225018', '8021', 'abc123', 'order', '代购', '108.00', '23288.00', '23180.00', '1496895901', '投注扣费，彩种:大发时时彩,20170608373');
INSERT INTO `caipiao_fuddetail` VALUES ('758', 'R1706081225151', '8021', 'abc123', 'order', '代购', '20.00', '23180.00', '23160.00', '1496895915', '投注扣费，彩种:大发时时彩,20170608373');
INSERT INTO `caipiao_fuddetail` VALUES ('759', 'E1706081228074', '8021', 'abc123', 'order', '代购', '90.00', '23160.00', '23070.00', '1496896087', '投注扣费，彩种:大发时时彩,20170608375');
INSERT INTO `caipiao_fuddetail` VALUES ('760', 'K1706081228165', '8021', 'abc123', 'order', '代购', '90.00', '23070.00', '22980.00', '1496896096', '投注扣费，彩种:大发时时彩,20170608375');
INSERT INTO `caipiao_fuddetail` VALUES ('761', 'E1706081229248', '8021', 'abc123', 'order', '代购', '8.00', '22980.00', '22972.00', '1496896164', '投注扣费，彩种:大发时时彩,20170608375');
INSERT INTO `caipiao_fuddetail` VALUES ('762', 'H1706081230101', '8021', 'abc123', 'order', '代购', '200.00', '22972.00', '22772.00', '1496896210', '投注扣费，彩种:大发时时彩,20170608376');
INSERT INTO `caipiao_fuddetail` VALUES ('763', 'Y1706081230231', '8021', 'abc123', 'order', '代购', '200.00', '22772.00', '22572.00', '1496896223', '投注扣费，彩种:大发时时彩,20170608376');
INSERT INTO `caipiao_fuddetail` VALUES ('764', 'F1706081230342', '8021', 'abc123', 'order', '代购', '90.00', '22572.00', '22482.00', '1496896234', '投注扣费，彩种:大发时时彩,20170608376');
INSERT INTO `caipiao_fuddetail` VALUES ('765', 'A1706081230540', '8021', 'abc123', 'order', '代购', '14.00', '22482.00', '22468.00', '1496896254', '投注扣费，彩种:大发时时彩,20170608376');
INSERT INTO `caipiao_fuddetail` VALUES ('766', 'X1706081231035', '8021', 'abc123', 'order', '代购', '90.00', '22468.00', '22378.00', '1496896263', '投注扣费，彩种:大发时时彩,20170608376');
INSERT INTO `caipiao_fuddetail` VALUES ('767', 'Q1706081231121', '8021', 'abc123', 'order', '代购', '18.00', '22378.00', '22360.00', '1496896272', '投注扣费，彩种:大发时时彩,20170608376');
INSERT INTO `caipiao_fuddetail` VALUES ('768', 'V1706081232032', '8021', 'abc123', 'order', '代购', '200.00', '22360.00', '22160.00', '1496896323', '投注扣费，彩种:大发时时彩,20170608377');
INSERT INTO `caipiao_fuddetail` VALUES ('769', 'G1706081233441', '8021', 'abc123', 'order', '代购', '200.00', '22160.00', '21960.00', '1496896424', '投注扣费，彩种:大发时时彩,20170608377');
INSERT INTO `caipiao_fuddetail` VALUES ('770', 'V1706081234010', '8021', 'abc123', 'order', '代购', '200.00', '21960.00', '21760.00', '1496896441', '投注扣费，彩种:大发时时彩,20170608378');
INSERT INTO `caipiao_fuddetail` VALUES ('771', 'B1706081234107', '8021', 'abc123', 'order', '代购', '90.00', '21760.00', '21670.00', '1496896450', '投注扣费，彩种:大发时时彩,20170608378');
INSERT INTO `caipiao_fuddetail` VALUES ('772', 'K1706081234263', '8021', 'abc123', 'order', '代购', '10.00', '21670.00', '21660.00', '1496896466', '投注扣费，彩种:大发时时彩,20170608378');
INSERT INTO `caipiao_fuddetail` VALUES ('773', 'H1706081234463', '8021', 'abc123', 'order', '代购', '18.00', '21660.00', '21642.00', '1496896486', '投注扣费，彩种:大发时时彩,20170608378');
INSERT INTO `caipiao_fuddetail` VALUES ('774', 'A1706081236283', '8021', 'abc123', 'order', '代购', '200.00', '21642.00', '21442.00', '1496896588', '投注扣费，彩种:大发时时彩,20170608379');
INSERT INTO `caipiao_fuddetail` VALUES ('775', 'G1706081236409', '8021', 'abc123', 'order', '代购', '90.00', '21442.00', '21352.00', '1496896600', '投注扣费，彩种:大发时时彩,20170608379');
INSERT INTO `caipiao_fuddetail` VALUES ('776', 'I1706081238185', '8021', 'abc123', 'order', '代购', '100.00', '21352.00', '21252.00', '1496896698', '投注扣费，彩种:大发时时彩,20170608380');
INSERT INTO `caipiao_fuddetail` VALUES ('777', 'N1706081240478', '8021', 'abc123', 'order', '代购', '32.00', '21252.00', '21220.00', '1496896847', '投注扣费，彩种:大发时时彩,20170608381');
INSERT INTO `caipiao_fuddetail` VALUES ('778', 'M1706081240571', '8021', 'abc123', 'order', '代购', '32.00', '21220.00', '21188.00', '1496896857', '投注扣费，彩种:大发时时彩,20170608381');
INSERT INTO `caipiao_fuddetail` VALUES ('779', 'U1706081241162', '8021', 'abc123', 'order', '代购', '128.00', '21188.00', '21060.00', '1496896876', '投注扣费，彩种:大发时时彩,20170608381');
INSERT INTO `caipiao_fuddetail` VALUES ('780', 'V1706081241318', '8021', 'abc123', 'order', '代购', '128.00', '21060.00', '20932.00', '1496896891', '投注扣费，彩种:大发时时彩,20170608381');
INSERT INTO `caipiao_fuddetail` VALUES ('781', 'U1706081412353', '8021', 'abc123', 'order', '代购', '6250.00', '20932.00', '14682.00', '1496902355', '投注扣费，彩种:大发时时彩,20170608427');
INSERT INTO `caipiao_fuddetail` VALUES ('782', 'A1706081413017', '8021', 'abc123', 'order', '代购', '10.00', '14682.00', '14672.00', '1496902381', '投注扣费，彩种:大发时时彩,20170608427');
INSERT INTO `caipiao_fuddetail` VALUES ('783', 'C1706081413154', '8021', 'abc123', 'order', '代购', '504.00', '14672.00', '14168.00', '1496902395', '投注扣费，彩种:大发时时彩,20170608427');
INSERT INTO `caipiao_fuddetail` VALUES ('784', 'W1706081413258', '8021', 'abc123', 'order', '代购', '1680.00', '14168.00', '12488.00', '1496902405', '投注扣费，彩种:大发时时彩,20170608427');
INSERT INTO `caipiao_fuddetail` VALUES ('785', 'I1706081413363', '8021', 'abc123', 'order', '代购', '720.00', '12488.00', '11768.00', '1496902416', '投注扣费，彩种:大发时时彩,20170608427');
INSERT INTO `caipiao_fuddetail` VALUES ('786', 'X1706081413464', '8021', 'abc123', 'order', '代购', '720.00', '11768.00', '11048.00', '1496902426', '投注扣费，彩种:大发时时彩,20170608427');
INSERT INTO `caipiao_fuddetail` VALUES ('787', 'K1706081413597', '8021', 'abc123', 'order', '代购', '180.00', '11048.00', '10868.00', '1496902439', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('788', 'R1706081414100', '8021', 'abc123', 'order', '代购', '180.00', '10868.00', '10688.00', '1496902450', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('789', 'R1706081414190', '8021', 'abc123', 'order', '代购', '20.00', '10688.00', '10668.00', '1496902459', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('790', 'R1706081414306', '8021', 'abc123', 'order', '代购', '90.00', '10668.00', '10578.00', '1496902470', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('791', 'E1706081414381', '8021', 'abc123', 'order', '代购', '240.00', '10578.00', '10338.00', '1496902478', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('792', 'T1706081414478', '8021', 'abc123', 'order', '代购', '20.00', '10338.00', '10318.00', '1496902487', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('793', 'M1706081414575', '8021', 'abc123', 'order', '代购', '20.00', '10318.00', '10298.00', '1496902497', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('794', 'H1706081415094', '8021', 'abc123', 'order', '代购', '20.00', '10298.00', '10278.00', '1496902509', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('795', 'L1706081415161', '8021', 'abc123', 'order', '代购', '20.00', '10278.00', '10258.00', '1496902516', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('796', 'N1706081415359', '8021', 'abc123', 'order', '代购', '1250.00', '10258.00', '9008.00', '1496902535', '投注扣费，彩种:大发时时彩,20170608428');
INSERT INTO `caipiao_fuddetail` VALUES ('797', 'G1706081416084', '8021', 'abc123', 'order', '代购', '18.00', '9008.00', '8990.00', '1496902568', '投注扣费，彩种:大发时时彩,20170608429');
INSERT INTO `caipiao_fuddetail` VALUES ('798', 'B1706081416251', '8021', 'abc123', 'order', '代购', '420.00', '8990.00', '8570.00', '1496902585', '投注扣费，彩种:大发时时彩,20170608429');
INSERT INTO `caipiao_fuddetail` VALUES ('799', 'Y1706081416349', '8021', 'abc123', 'order', '代购', '720.00', '8570.00', '7850.00', '1496902594', '投注扣费，彩种:大发时时彩,20170608429');
INSERT INTO `caipiao_fuddetail` VALUES ('800', 'F1706081416432', '8021', 'abc123', 'order', '代购', '90.00', '7850.00', '7760.00', '1496902603', '投注扣费，彩种:大发时时彩,20170608429');
INSERT INTO `caipiao_fuddetail` VALUES ('801', 'D1706081416556', '8021', 'abc123', 'order', '代购', '180.00', '7760.00', '7580.00', '1496902615', '投注扣费，彩种:大发时时彩,20170608429');
INSERT INTO `caipiao_fuddetail` VALUES ('802', 'J1706081417050', '8021', 'abc123', 'order', '代购', '20.00', '7580.00', '7560.00', '1496902625', '投注扣费，彩种:大发时时彩,20170608429');
INSERT INTO `caipiao_fuddetail` VALUES ('803', 'J1706081417139', '8021', 'abc123', 'order', '代购', '90.00', '7560.00', '7470.00', '1496902633', '投注扣费，彩种:大发时时彩,20170608429');
INSERT INTO `caipiao_fuddetail` VALUES ('804', 'J1706081417302', '8021', 'abc123', 'order', '代购', '2000.00', '7470.00', '5470.00', '1496902650', '投注扣费，彩种:大发时时彩,20170608429');
INSERT INTO `caipiao_fuddetail` VALUES ('805', 'M1706081418017', '8021', 'abc123', 'order', '代购', '14.00', '5470.00', '5456.00', '1496902681', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('806', 'E1706081418117', '8021', 'abc123', 'order', '代购', '2000.00', '5456.00', '3456.00', '1496902691', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('807', 'D1706081418204', '8021', 'abc123', 'order', '代购', '420.00', '3456.00', '3036.00', '1496902700', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('808', 'A1706081418294', '8021', 'abc123', 'order', '代购', '180.00', '3036.00', '2856.00', '1496902709', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('809', 'U1706081418371', '8021', 'abc123', 'order', '代购', '240.00', '2856.00', '2616.00', '1496902717', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('810', 'R1706081419074', '8021', 'abc123', 'order', '代购', '18.00', '2616.00', '2598.00', '1496902747', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('811', 'A1706081419150', '8021', 'abc123', 'order', '代购', '108.00', '2598.00', '2490.00', '1496902755', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('812', 'M1706081419252', '8021', 'abc123', 'order', '代购', '20.00', '2490.00', '2470.00', '1496902765', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('813', 'E1706081419323', '8021', 'abc123', 'order', '代购', '90.00', '2470.00', '2380.00', '1496902772', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('814', 'Q1706081419448', '8021', 'abc123', 'order', '代购', '2000.00', '2380.00', '380.00', '1496902784', '投注扣费，彩种:大发时时彩,20170608430');
INSERT INTO `caipiao_fuddetail` VALUES ('815', 'V1706081420165', '8021', 'abc123', 'order', '代购', '20.00', '380.00', '360.00', '1496902816', '投注扣费，彩种:大发时时彩,20170608431');
INSERT INTO `caipiao_fuddetail` VALUES ('816', 'J1706081421420', '8021', 'abc123', 'order', '代购', '2000.00', '33360.00', '31360.00', '1496902902', '投注扣费，彩种:大发时时彩,20170608431');
INSERT INTO `caipiao_fuddetail` VALUES ('817', 'C1706081421565', '8021', 'abc123', 'order', '代购', '2000.00', '31360.00', '29360.00', '1496902916', '投注扣费，彩种:大发时时彩,20170608432');
INSERT INTO `caipiao_fuddetail` VALUES ('818', 'J1706081422052', '8021', 'abc123', 'order', '代购', '420.00', '29360.00', '28940.00', '1496902925', '投注扣费，彩种:大发时时彩,20170608432');
INSERT INTO `caipiao_fuddetail` VALUES ('819', 'P1706081422148', '8021', 'abc123', 'order', '代购', '180.00', '28940.00', '28760.00', '1496902934', '投注扣费，彩种:大发时时彩,20170608432');
INSERT INTO `caipiao_fuddetail` VALUES ('820', 'F1706081422245', '8021', 'abc123', 'order', '代购', '240.00', '28760.00', '28520.00', '1496902944', '投注扣费，彩种:大发时时彩,20170608432');
INSERT INTO `caipiao_fuddetail` VALUES ('821', 'H1706081425177', '8021', 'abc123', 'order', '代购', '18.00', '28520.00', '28502.00', '1496903117', '投注扣费，彩种:大发时时彩,20170608433');
INSERT INTO `caipiao_fuddetail` VALUES ('822', 'O1706081426007', '8021', 'abc123', 'order', '代购', '108.00', '28502.00', '28394.00', '1496903160', '投注扣费，彩种:大发时时彩,20170608434');
INSERT INTO `caipiao_fuddetail` VALUES ('823', 'N1706081426098', '8021', 'abc123', 'order', '代购', '20.00', '28394.00', '28374.00', '1496903169', '投注扣费，彩种:大发时时彩,20170608434');
INSERT INTO `caipiao_fuddetail` VALUES ('824', 'W1706081426194', '8021', 'abc123', 'order', '代购', '90.00', '28374.00', '28284.00', '1496903179', '投注扣费，彩种:大发时时彩,20170608434');
INSERT INTO `caipiao_fuddetail` VALUES ('825', 'O1706081426468', '8021', 'abc123', 'order', '代购', '2000.00', '28284.00', '26284.00', '1496903206', '投注扣费，彩种:大发时时彩,20170608434');
INSERT INTO `caipiao_fuddetail` VALUES ('826', 'J1706081427140', '8021', 'abc123', 'order', '代购', '20.00', '26284.00', '26264.00', '1496903234', '投注扣费，彩种:大发时时彩,20170608434');
INSERT INTO `caipiao_fuddetail` VALUES ('827', 'Y1706081428022', '8021', 'abc123', 'order', '代购', '2000.00', '26264.00', '24264.00', '1496903282', '投注扣费，彩种:大发时时彩,20170608435');
INSERT INTO `caipiao_fuddetail` VALUES ('828', 'S1706081428108', '8021', 'abc123', 'order', '代购', '2000.00', '24264.00', '22264.00', '1496903290', '投注扣费，彩种:大发时时彩,20170608435');
INSERT INTO `caipiao_fuddetail` VALUES ('829', 'C1706081428220', '8021', 'abc123', 'order', '代购', '420.00', '22264.00', '21844.00', '1496903302', '投注扣费，彩种:大发时时彩,20170608435');
INSERT INTO `caipiao_fuddetail` VALUES ('830', 'K1706081428317', '8021', 'abc123', 'order', '代购', '180.00', '21844.00', '21664.00', '1496903311', '投注扣费，彩种:大发时时彩,20170608435');
INSERT INTO `caipiao_fuddetail` VALUES ('831', 'S1706081428396', '8021', 'abc123', 'order', '代购', '240.00', '21664.00', '21424.00', '1496903319', '投注扣费，彩种:大发时时彩,20170608435');
INSERT INTO `caipiao_fuddetail` VALUES ('832', 'G1706081429070', '8021', 'abc123', 'order', '代购', '20.00', '21424.00', '21404.00', '1496903347', '投注扣费，彩种:大发时时彩,20170608435');
INSERT INTO `caipiao_fuddetail` VALUES ('833', 'V1706081429155', '8021', 'abc123', 'order', '代购', '108.00', '21404.00', '21296.00', '1496903355', '投注扣费，彩种:大发时时彩,20170608435');
INSERT INTO `caipiao_fuddetail` VALUES ('834', 'E1706081429251', '8021', 'abc123', 'order', '代购', '20.00', '21296.00', '21276.00', '1496903365', '投注扣费，彩种:大发时时彩,20170608435');
INSERT INTO `caipiao_fuddetail` VALUES ('835', 'N1706081430040', '8021', 'abc123', 'order', '代购', '90.00', '21276.00', '21186.00', '1496903404', '投注扣费，彩种:大发时时彩,20170608436');
INSERT INTO `caipiao_fuddetail` VALUES ('836', 'R1706081431019', '8021', 'abc123', 'order', '代购', '90.00', '21186.00', '21096.00', '1496903461', '投注扣费，彩种:大发时时彩,20170608436');
INSERT INTO `caipiao_fuddetail` VALUES ('837', 'X1706081431115', '8021', 'abc123', 'order', '代购', '200.00', '21096.00', '20896.00', '1496903471', '投注扣费，彩种:大发时时彩,20170608436');
INSERT INTO `caipiao_fuddetail` VALUES ('838', 'U1706081431383', '8021', 'abc123', 'order', '代购', '20.00', '20896.00', '20876.00', '1496903498', '投注扣费，彩种:大发时时彩,20170608436');
INSERT INTO `caipiao_fuddetail` VALUES ('839', 'B1706081431454', '8021', 'abc123', 'order', '代购', '200.00', '20876.00', '20676.00', '1496903505', '投注扣费，彩种:大发时时彩,20170608436');
INSERT INTO `caipiao_fuddetail` VALUES ('840', 'G1706081431572', '8021', 'abc123', 'order', '代购', '200.00', '20676.00', '20476.00', '1496903517', '投注扣费，彩种:大发时时彩,20170608437');
INSERT INTO `caipiao_fuddetail` VALUES ('841', 'M1706081432066', '8021', 'abc123', 'order', '代购', '90.00', '20476.00', '20386.00', '1496903526', '投注扣费，彩种:大发时时彩,20170608437');
INSERT INTO `caipiao_fuddetail` VALUES ('842', 'G1706081433068', '8021', 'abc123', 'order', '代购', '20.00', '20386.00', '20366.00', '1496903586', '投注扣费，彩种:大发时时彩,20170608437');
INSERT INTO `caipiao_fuddetail` VALUES ('843', 'W1706081433157', '8021', 'abc123', 'order', '代购', '90.00', '20366.00', '20276.00', '1496903595', '投注扣费，彩种:大发时时彩,20170608437');
INSERT INTO `caipiao_fuddetail` VALUES ('844', 'M1706081433258', '8021', 'abc123', 'order', '代购', '18.00', '20276.00', '20258.00', '1496903605', '投注扣费，彩种:大发时时彩,20170608437');
INSERT INTO `caipiao_fuddetail` VALUES ('845', 'L1706081433349', '8021', 'abc123', 'order', '代购', '200.00', '20258.00', '20058.00', '1496903614', '投注扣费，彩种:大发时时彩,20170608437');
INSERT INTO `caipiao_fuddetail` VALUES ('846', 'T1706081434005', '8021', 'abc123', 'order', '代购', '20.00', '20058.00', '20038.00', '1496903640', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('847', 'M1706081434081', '8021', 'abc123', 'order', '代购', '200.00', '20038.00', '19838.00', '1496903648', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('848', 'B1706081434157', '8021', 'abc123', 'order', '代购', '200.00', '19838.00', '19638.00', '1496903655', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('849', 'M1706081434249', '8021', 'abc123', 'order', '代购', '90.00', '19638.00', '19548.00', '1496903664', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('850', 'P1706081434423', '8021', 'abc123', 'order', '代购', '20.00', '19548.00', '19528.00', '1496903682', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('851', 'P1706081434516', '8021', 'abc123', 'order', '代购', '90.00', '19528.00', '19438.00', '1496903691', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('852', 'U1706081434585', '8021', 'abc123', 'order', '代购', '18.00', '19438.00', '19420.00', '1496903698', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('853', 'M1706081435096', '8021', 'abc123', 'order', '代购', '100.00', '19420.00', '19320.00', '1496903709', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('854', 'P1706081435268', '8021', 'abc123', 'order', '代购', '32.00', '19320.00', '19288.00', '1496903726', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('855', 'K1706081435374', '8021', 'abc123', 'order', '代购', '32.00', '19288.00', '19256.00', '1496903737', '投注扣费，彩种:大发时时彩,20170608438');
INSERT INTO `caipiao_fuddetail` VALUES ('856', 'M1706081435527', '8021', 'abc123', 'order', '代购', '128.00', '19256.00', '19128.00', '1496903752', '投注扣费，彩种:大发时时彩,20170608439');
INSERT INTO `caipiao_fuddetail` VALUES ('857', 'U1706081436072', '8021', 'abc123', 'order', '代购', '128.00', '19128.00', '19000.00', '1496903767', '投注扣费，彩种:大发时时彩,20170608439');
INSERT INTO `caipiao_fuddetail` VALUES ('858', 'M1706081435096', '8021', 'abc123', 'reward', '返奖', '98.00', '19000.00', '19098.00', '1496903799', '大发时时彩第20170608438期-一星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('859', 'B1706081434157', '8021', 'abc123', 'reward', '返奖', '196.00', '19098.00', '19294.00', '1496903799', '大发时时彩第20170608438期-后二跨度');
INSERT INTO `caipiao_fuddetail` VALUES ('860', 'M1706081434081', '8021', 'abc123', 'reward', '返奖', '1930.00', '19294.00', '21224.00', '1496903799', '大发时时彩第20170608438期-后二直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('861', 'L1706081433349', '8021', 'abc123', 'reward', '返奖', '196.00', '21224.00', '21420.00', '1496903801', '大发时时彩第20170608437期-后二直选复式');
INSERT INTO `caipiao_fuddetail` VALUES ('862', 'G1706081431572', '8021', 'abc123', 'reward', '返奖', '196.00', '21420.00', '21616.00', '1496903801', '大发时时彩第20170608437期-前二跨度');
INSERT INTO `caipiao_fuddetail` VALUES ('863', 'B1706081431454', '8021', 'abc123', 'reward', '返奖', '1930.00', '21616.00', '23546.00', '1496903801', '大发时时彩第20170608436期-前二直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('864', 'X1706081431115', '8021', 'abc123', 'reward', '返奖', '196.00', '23546.00', '23742.00', '1496903801', '大发时时彩第20170608436期-前二直选复式');
INSERT INTO `caipiao_fuddetail` VALUES ('865', 'E1706081429251', '8021', 'abc123', 'reward', '返奖', '20.40', '23742.00', '23762.40', '1496903803', '大发时时彩第20170608435期-后三不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('866', 'S1706081428396', '8021', 'abc123', 'reward', '返奖', '1960.00', '23762.40', '25722.40', '1496903803', '大发时时彩第20170608435期-后三组六');
INSERT INTO `caipiao_fuddetail` VALUES ('867', 'C1706081428220', '8021', 'abc123', 'reward', '返奖', '1930.00', '25722.40', '27652.40', '1496903803', '大发时时彩第20170608435期-后三组选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('868', 'S1706081428108', '8021', 'abc123', 'reward', '返奖', '1960.00', '27652.40', '29612.40', '1496903803', '大发时时彩第20170608435期-后三跨度');
INSERT INTO `caipiao_fuddetail` VALUES ('869', 'Y1706081428022', '8021', 'abc123', 'reward', '返奖', '1930.00', '29612.40', '31542.40', '1496903803', '大发时时彩第20170608435期-后三直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('870', 'O1706081426468', '8021', 'abc123', 'reward', '返奖', '1960.00', '31542.40', '33502.40', '1496903805', '大发时时彩第20170608434期-后三复式');
INSERT INTO `caipiao_fuddetail` VALUES ('871', 'N1706081426098', '8021', 'abc123', 'reward', '返奖', '13.60', '33502.40', '33516.00', '1496903805', '大发时时彩第20170608434期-中三不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('872', 'F1706081422245', '8021', 'abc123', 'reward', '返奖', '327.00', '33516.00', '33843.00', '1496903805', '大发时时彩第20170608432期-中三组六');
INSERT INTO `caipiao_fuddetail` VALUES ('873', 'J1706081422052', '8021', 'abc123', 'reward', '返奖', '1930.00', '33843.00', '35773.00', '1496903805', '大发时时彩第20170608432期-中三组选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('874', 'C1706081421565', '8021', 'abc123', 'reward', '返奖', '1960.00', '35773.00', '37733.00', '1496903805', '大发时时彩第20170608432期-中三跨度');
INSERT INTO `caipiao_fuddetail` VALUES ('875', 'J1706081421420', '8021', 'abc123', 'reward', '返奖', '1930.00', '37733.00', '39663.00', '1496903805', '大发时时彩第20170608431期-中三直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('876', 'Q1706081419448', '8021', 'abc123', 'reward', '返奖', '1930.00', '39663.00', '41593.00', '1496903807', '大发时时彩第20170608430期-中三复式');
INSERT INTO `caipiao_fuddetail` VALUES ('877', 'M1706081419252', '8021', 'abc123', 'reward', '返奖', '20.40', '41593.00', '41613.40', '1496903807', '大发时时彩第20170608430期-前三不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('878', 'U1706081418371', '8021', 'abc123', 'reward', '返奖', '327.00', '41613.40', '41940.40', '1496903807', '大发时时彩第20170608430期-前三组六');
INSERT INTO `caipiao_fuddetail` VALUES ('879', 'D1706081418204', '8021', 'abc123', 'reward', '返奖', '1930.00', '41940.40', '43870.40', '1496903807', '大发时时彩第20170608430期-前三组选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('880', 'E1706081418117', '8021', 'abc123', 'reward', '返奖', '1930.00', '43870.40', '45800.40', '1496903807', '大发时时彩第20170608430期-前三直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('881', 'J1706081417302', '8021', 'abc123', 'reward', '返奖', '1930.00', '45800.40', '47730.40', '1496903809', '大发时时彩第20170608429期-前三复式');
INSERT INTO `caipiao_fuddetail` VALUES ('882', 'Y1706081416349', '8021', 'abc123', 'reward', '返奖', '1335.00', '47730.40', '49065.40', '1496903809', '大发时时彩第20170608429期-后四组选12');
INSERT INTO `caipiao_fuddetail` VALUES ('883', 'B1706081416251', '8021', 'abc123', 'reward', '返奖', '817.00', '49065.40', '49882.40', '1496903809', '大发时时彩第20170608429期-后四组选24');
INSERT INTO `caipiao_fuddetail` VALUES ('884', 'T1706081414478', '8021', 'abc123', 'reward', '返奖', '96.50', '49882.40', '49978.90', '1496903811', '大发时时彩第20170608428期-一帆风顺');
INSERT INTO `caipiao_fuddetail` VALUES ('885', 'E1706081414381', '8021', 'abc123', 'reward', '返奖', '446.50', '49978.90', '50425.40', '1496903811', '大发时时彩第20170608428期-五星三码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('886', 'R1706081414306', '8021', 'abc123', 'reward', '返奖', '130.00', '50425.40', '50555.40', '1496903811', '大发时时彩第20170608428期-五星二码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('887', 'R1706081414190', '8021', 'abc123', 'reward', '返奖', '17.00', '50555.40', '50572.40', '1496903811', '大发时时彩第20170608428期-五星一码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('888', 'W1706081413258', '8021', 'abc123', 'reward', '返奖', '3270.00', '50572.40', '53842.40', '1496903813', '大发时时彩第20170608427期-组选60');
INSERT INTO `caipiao_fuddetail` VALUES ('889', 'C1706081413154', '8021', 'abc123', 'reward', '返奖', '1541.00', '53842.40', '55383.40', '1496903813', '大发时时彩第20170608427期-组选120');
INSERT INTO `caipiao_fuddetail` VALUES ('890', 'U1706081412353', '8021', 'abc123', 'reward', '返奖', '193000.00', '55383.40', '248383.40', '1496903813', '大发时时彩第20170608427期-五星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('891', 'E1706091604050', '8021', 'abc123', 'order', '代购', '14.00', '248383.40', '248369.40', '1496995445', '投注扣费，彩种:大发时时彩,20170609483');
INSERT INTO `caipiao_fuddetail` VALUES ('892', 'L1706091605047', '8021', 'abc123', 'order', '代购', '14.00', '248369.40', '248355.40', '1496995504', '投注扣费，彩种:大发时时彩,20170609483');
INSERT INTO `caipiao_fuddetail` VALUES ('893', 'E1706091605317', '8021', 'abc123', 'order', '代购', '18.00', '248355.40', '248337.40', '1496995531', '投注扣费，彩种:大发时时彩,20170609483');
INSERT INTO `caipiao_fuddetail` VALUES ('894', 'R1706091605559', '8021', 'abc123', 'order', '代购', '14.00', '248337.40', '248323.40', '1496995555', '投注扣费，彩种:大发时时彩,20170609484');
INSERT INTO `caipiao_fuddetail` VALUES ('895', 'U1706091606391', '8021', 'abc123', 'order', '代购', '12.00', '248323.40', '248311.40', '1496995599', '投注扣费，彩种:大发时时彩,20170609484');
INSERT INTO `caipiao_fuddetail` VALUES ('896', 'C1706091607280', '8021', 'abc123', 'order', '代购', '6.00', '248311.40', '248305.40', '1496995648', '投注扣费，彩种:大发时时彩,20170609484');
INSERT INTO `caipiao_fuddetail` VALUES ('897', 'M1706101602460', '8021', 'abc123', 'order', '代购', '200.00', '248305.40', '248105.40', '1497081766', '投注扣费，彩种:北京PK10,622613');
INSERT INTO `caipiao_fuddetail` VALUES ('898', 'V1706101603508', '8021', 'abc123', 'order', '代购', '60480.00', '248105.40', '187625.40', '1497081830', '投注扣费，彩种:北京PK10,622613');
INSERT INTO `caipiao_fuddetail` VALUES ('899', 'J1706101605018', '8021', 'abc123', 'order', '代购', '6.00', '187625.40', '187619.40', '1497081901', '投注扣费，彩种:北京PK10,622613');
INSERT INTO `caipiao_fuddetail` VALUES ('900', 'Z1706101605280', '8021', 'abc123', 'order', '代购', '10080.00', '187619.40', '177539.40', '1497081928', '投注扣费，彩种:北京PK10,622613');
INSERT INTO `caipiao_fuddetail` VALUES ('901', 'K1706101606384', '8021', 'abc123', 'order', '代购', '6.00', '177539.40', '177533.40', '1497081998', '投注扣费，彩种:北京PK10,622614');
INSERT INTO `caipiao_fuddetail` VALUES ('902', 'X1706101606531', '8021', 'abc123', 'order', '代购', '1440.00', '177533.40', '176093.40', '1497082013', '投注扣费，彩种:北京PK10,622614');
INSERT INTO `caipiao_fuddetail` VALUES ('903', 'W1706101607202', '8021', 'abc123', 'order', '代购', '6.00', '176093.40', '176087.40', '1497082040', '投注扣费，彩种:北京PK10,622614');
INSERT INTO `caipiao_fuddetail` VALUES ('904', 'U1706101607330', '8021', 'abc123', 'order', '代购', '180.00', '176087.40', '175907.40', '1497082053', '投注扣费，彩种:北京PK10,622614');
INSERT INTO `caipiao_fuddetail` VALUES ('905', 'U1706101608098', '8021', 'abc123', 'order', '代购', '20.00', '175907.40', '175887.40', '1497082089', '投注扣费，彩种:北京PK10,622614');
INSERT INTO `caipiao_fuddetail` VALUES ('906', 'D1706101610428', '8021', 'abc123', 'order', '代购', '8.00', '175887.40', '175879.40', '1497082242', '投注扣费，彩种:北京PK10,622614');
INSERT INTO `caipiao_fuddetail` VALUES ('907', 'Z1706101605280', '8021', 'abc123', 'reward', '返奖', '655.20', '175879.40', '176534.60', '1497082663', '北京PK10第622613期-前四复式');
INSERT INTO `caipiao_fuddetail` VALUES ('908', 'V1706101603508', '8021', 'abc123', 'reward', '返奖', '403.20', '176534.60', '176937.80', '1497082663', '北京PK10第622613期-前五复式');
INSERT INTO `caipiao_fuddetail` VALUES ('909', 'M1706101602460', '8021', 'abc123', 'reward', '返奖', '88.00', '176937.80', '177025.80', '1497082663', '北京PK10第622613期-定位胆');
INSERT INTO `caipiao_fuddetail` VALUES ('910', 'U1706101608098', '8021', 'abc123', 'reward', '返奖', '5.90', '177025.80', '177031.70', '1497082708', '北京PK10第622614期-前一复式');
INSERT INTO `caipiao_fuddetail` VALUES ('911', 'U1706101607330', '8021', 'abc123', 'reward', '返奖', '87.30', '177031.70', '177119.00', '1497082708', '北京PK10第622614期-前二复式');
INSERT INTO `caipiao_fuddetail` VALUES ('912', 'X1706101606531', '8021', 'abc123', 'reward', '返奖', '698.40', '177119.00', '177817.40', '1497082708', '北京PK10第622614期-前三复式');
INSERT INTO `caipiao_fuddetail` VALUES ('913', 'U1706161145201', '8021', 'abc123', 'order', '代购', '2.00', '177817.40', '177815.40', '1497584720', '投注扣费，彩种:重庆时时彩,20170616035');
INSERT INTO `caipiao_fuddetail` VALUES ('914', 'Q1706161145565', '8021', 'abc123', 'order', '代购', '4.00', '177815.40', '177811.40', '1497584756', '投注扣费，彩种:重庆时时彩,20170616035');
INSERT INTO `caipiao_fuddetail` VALUES ('915', 'R1706161146494', '8021', 'abc123', 'order', '代购', '2.00', '177811.40', '177809.40', '1497584809', '投注扣费，彩种:排列三,17160');
INSERT INTO `caipiao_fuddetail` VALUES ('916', 'LHQ1706171925274679', '8021', 'abc123', 'activity_bindcard', '绑定银行赠送活动', '0.10', '177809.40', '177809.50', '1497698727', '绑定银行赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('920', 'Y1706180005438', '8020', 'zggcdyz', 'order', '代购', '116.00', '58716.86', '58600.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('921', 'W1706180005437', '8020', 'zggcdyz', 'order', '代购', '116.00', '58600.86', '58484.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('922', 'N1706180005432', '8020', 'zggcdyz', 'order', '代购', '116.00', '58484.86', '58368.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('923', 'L1706180005435', '8020', 'zggcdyz', 'order', '代购', '116.00', '58368.86', '58252.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('924', 'C1706180005447', '8020', 'zggcdyz', 'order', '代购', '16.00', '58252.86', '58236.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('925', 'J1706180005442', '8020', 'zggcdyz', 'order', '代购', '16.00', '58236.86', '58220.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('926', 'E1706180005443', '8020', 'zggcdyz', 'order', '代购', '12.00', '58220.86', '58208.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('927', 'H1706180005440', '8020', 'zggcdyz', 'order', '代购', '12.00', '58208.86', '58196.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('928', 'R1706180005449', '8020', 'zggcdyz', 'order', '代购', '16.00', '58196.86', '58180.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('929', 'G1706180005449', '8020', 'zggcdyz', 'order', '代购', '15.00', '58180.86', '58165.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('930', 'P1706180005444', '8020', 'zggcdyz', 'order', '代购', '16.00', '58165.86', '58149.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('931', 'O1706180005442', '8020', 'zggcdyz', 'order', '代购', '112.00', '58149.86', '58037.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('932', 'N1706180005443', '8020', 'zggcdyz', 'order', '代购', '112.00', '58037.86', '57925.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('933', 'B1706180005449', '8020', 'zggcdyz', 'order', '代购', '116.00', '57925.86', '57809.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('934', 'A1706180005445', '8020', 'zggcdyz', 'order', '代购', '151.00', '57809.86', '57658.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('935', 'P1706180005441', '8020', 'zggcdyz', 'order', '代购', '141.00', '57658.86', '57517.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('936', 'C1706180005442', '8020', 'zggcdyz', 'order', '代购', '141.00', '57517.86', '57376.86', '1497715543', '投注扣费，彩种:极速快3,201706180006');
INSERT INTO `caipiao_fuddetail` VALUES ('937', 'R1706180005449', '8020', 'zggcdyz', 'reward', '返奖', '120.00', '57376.86', '57496.86', '1497715579', '极速快3第201706180006期-和值11');
INSERT INTO `caipiao_fuddetail` VALUES ('938', 'Y1706180005438', '8020', 'zggcdyz', 'reward', '返奖', '226.20', '57496.86', '57723.06', '1497715581', '极速快3第201706180006期-和值大');
INSERT INTO `caipiao_fuddetail` VALUES ('939', 'A1706180005436', '8020', 'zggcdyz', 'reward', '返奖', '216.45', '57723.06', '57939.51', '1497715581', '极速快3第201706180006期-和值单');
INSERT INTO `caipiao_fuddetail` VALUES ('942', 'D1706190040505078', '8020', 'zggcdyz', 'fanshui', '每日加奖', '8.37', '57956.25', '57964.62', '1497804049', '每日加奖通过');
INSERT INTO `caipiao_fuddetail` VALUES ('943', 'V1706180051401850', '8020', 'zggcdyz', 'activity_cz', '充值活动', '20000.00', '57964.62', '77964.62', '1497718330', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('944', 'V1706180051401850', '8020', 'zggcdyz', 'xima', '洗码', '10000.00', '25398.00', '35398.00', '1497718330', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('946', 'C1706180100255809', '8020', 'zggcdyz', 'jinjishenhe', '晋级审核通过', '318.00', '78282.62', '78600.62', '1497718824', '晋级审核通过');
INSERT INTO `caipiao_fuddetail` VALUES ('947', 'T1706181334424', '8021', 'abc123', 'order', '代购', '3.00', '177809.50', '177806.50', '1497764082', '投注扣费，彩种:吉林快3,20170618035');
INSERT INTO `caipiao_fuddetail` VALUES ('948', 'J1706181334425', '8021', 'abc123', 'order', '代购', '3.00', '177806.50', '177803.50', '1497764082', '投注扣费，彩种:吉林快3,20170618035');
INSERT INTO `caipiao_fuddetail` VALUES ('949', 'Q1706181405334', '8021', 'abc123', 'order', '代购', '1.00', '177803.50', '177802.50', '1497765933', '投注扣费，彩种:吉林快3,20170618039');
INSERT INTO `caipiao_fuddetail` VALUES ('950', 'Y1706181405334', '8021', 'abc123', 'order', '代购', '1.00', '177802.50', '177801.50', '1497765933', '投注扣费，彩种:吉林快3,20170618039');
INSERT INTO `caipiao_fuddetail` VALUES ('951', 'S1706181405330', '8021', 'abc123', 'order', '代购', '1.00', '177801.50', '177800.50', '1497765933', '投注扣费，彩种:吉林快3,20170618039');
INSERT INTO `caipiao_fuddetail` VALUES ('952', 'A1706181405330', '8021', 'abc123', 'order', '代购', '1.00', '177800.50', '177799.50', '1497765933', '投注扣费，彩种:吉林快3,20170618039');
INSERT INTO `caipiao_fuddetail` VALUES ('953', 'I1706181408459', '8021', 'abc123', 'order', '代购', '1.00', '177799.50', '177798.50', '1497766125', '投注扣费，彩种:吉林快3,20170618039');
INSERT INTO `caipiao_fuddetail` VALUES ('954', 'Q1706181408457', '8021', 'abc123', 'order', '代购', '1.00', '177798.50', '177797.50', '1497766125', '投注扣费，彩种:吉林快3,20170618039');
INSERT INTO `caipiao_fuddetail` VALUES ('955', 'U1706181409150', '8021', 'abc123', 'order', '代购', '1.00', '177797.50', '177796.50', '1497766155', '投注扣费，彩种:吉林快3,20170618039');
INSERT INTO `caipiao_fuddetail` VALUES ('956', 'P1706181409158', '8021', 'abc123', 'order', '代购', '1.00', '177796.50', '177795.50', '1497766155', '投注扣费，彩种:吉林快3,20170618039');
INSERT INTO `caipiao_fuddetail` VALUES ('957', 'D1706181419097', '8021', 'abc123', 'order', '代购', '1.00', '177795.50', '177794.50', '1497766749', '投注扣费，彩种:吉林快3,20170618040');
INSERT INTO `caipiao_fuddetail` VALUES ('958', 'E1706181419093', '8021', 'abc123', 'order', '代购', '1.00', '177794.50', '177793.50', '1497766749', '投注扣费，彩种:吉林快3,20170618040');
INSERT INTO `caipiao_fuddetail` VALUES ('959', 'V1706181623011', '8021', 'abc123', 'order', '代购', '2.00', '177793.50', '177791.50', '1497774181', '投注扣费，彩种:极速快3,201706180984');
INSERT INTO `caipiao_fuddetail` VALUES ('960', 'F1706181623010', '8021', 'abc123', 'order', '代购', '1.00', '177791.50', '177790.50', '1497774181', '投注扣费，彩种:极速快3,201706180984');
INSERT INTO `caipiao_fuddetail` VALUES ('961', 'U1706181625458', '8021', 'abc123', 'order', '代购', '1.00', '177790.50', '177789.50', '1497774345', '投注扣费，彩种:极速快3,201706180986');
INSERT INTO `caipiao_fuddetail` VALUES ('962', 'Z1706181629387', '8021', 'abc123', 'order', '代购', '1.00', '177789.50', '177788.50', '1497774578', '投注扣费，彩种:极速快3,201706180990');
INSERT INTO `caipiao_fuddetail` VALUES ('963', 'X1706181631138', '8021', 'abc123', 'order', '代购', '1.00', '177788.50', '177787.50', '1497774673', '投注扣费，彩种:极速快3,201706180992');
INSERT INTO `caipiao_fuddetail` VALUES ('964', 'Z1706181632040', '8021', 'abc123', 'order', '代购', '1.00', '177787.50', '177786.50', '1497774724', '投注扣费，彩种:极速快3,201706180993');
INSERT INTO `caipiao_fuddetail` VALUES ('965', 'Z1706181632476', '8021', 'abc123', 'order', '代购', '1.00', '177786.50', '177785.50', '1497774767', '投注扣费，彩种:极速快3,201706180993');
INSERT INTO `caipiao_fuddetail` VALUES ('966', 'O1706181635006', '8021', 'abc123', 'order', '代购', '1.00', '177785.50', '177784.50', '1497774900', '投注扣费，彩种:极速快3,201706180996');
INSERT INTO `caipiao_fuddetail` VALUES ('967', 'M1706181635398', '8021', 'abc123', 'order', '代购', '1.00', '177784.50', '177783.50', '1497774939', '投注扣费，彩种:极速快3,201706180996');
INSERT INTO `caipiao_fuddetail` VALUES ('968', 'N1706181659070', '8021', 'abc123', 'order', '代购', '1.00', '177783.50', '177782.50', '1497776347', '投注扣费，彩种:极速快3,201706181020');
INSERT INTO `caipiao_fuddetail` VALUES ('969', 'S1706181701011', '8021', 'abc123', 'order', '代购', '1.00', '177782.50', '177781.50', '1497776461', '投注扣费，彩种:极速快3,201706181022');
INSERT INTO `caipiao_fuddetail` VALUES ('970', 'U1706182135380', '8021', 'abc123', 'order', '代购', '1.00', '177781.50', '177780.50', '1497792938', '投注扣费，彩种:极速快3,201706181296');
INSERT INTO `caipiao_fuddetail` VALUES ('971', 'B1706182135389', '8021', 'abc123', 'order', '代购', '1.00', '177780.50', '177779.50', '1497792938', '投注扣费，彩种:极速快3,201706181296');
INSERT INTO `caipiao_fuddetail` VALUES ('972', 'DIU1706182221594261', '8020', 'zggcdyz', 'point', '积分', '61125.00', '61125.00', '0.00', '1497795719', '61125积分兑换61.13元');
INSERT INTO `caipiao_fuddetail` VALUES ('973', 'DIU1706182221594261', '8020', 'zggcdyz', 'pointexchange', '积分兑换', '61.13', '78600.62', '78661.75', '1497795719', '61125积分兑换61.13元');
INSERT INTO `caipiao_fuddetail` VALUES ('974', 'LKV1706182224349508', '8020', 'zggcdyz', 'order', '代购', '4444.00', '78661.75', '74217.75', '1497795874', '投注扣费，彩种:极速快3,201706181345');
INSERT INTO `caipiao_fuddetail` VALUES ('975', 'LKV1706182224349508', '8020', 'zggcdyz', 'xima', '洗码', '4444.00', '35398.00', '30954.00', '1497795874', '投注减，彩种:极速快3,201706181345');
INSERT INTO `caipiao_fuddetail` VALUES ('976', 'LKV1706182224349508', '8020', 'zggcdyz', 'point', '积分', '4444.00', '0.00', '4444.00', '1497795874', '投注送积分，彩种:极速快3,201706181345');
INSERT INTO `caipiao_fuddetail` VALUES ('977', 'H1706280953089', '8022', 'abc123t1', 'order', '代购', '10.00', '10002.00', '9992.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('978', 'U1706280953083', '8022', 'abc123t1', 'order', '代购', '10.00', '9992.00', '9982.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('979', 'W1706280953082', '8022', 'abc123t1', 'order', '代购', '10.00', '9982.00', '9972.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('980', 'G1706280953087', '8022', 'abc123t1', 'order', '代购', '10.00', '9972.00', '9962.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('981', 'C1706280953081', '8022', 'abc123t1', 'order', '代购', '10.00', '9962.00', '9952.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('982', 'K1706280953081', '8022', 'abc123t1', 'order', '代购', '10.00', '9952.00', '9942.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('983', 'W1706280953084', '8022', 'abc123t1', 'order', '代购', '10.00', '9942.00', '9932.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('984', 'N1706280953089', '8022', 'abc123t1', 'order', '代购', '10.00', '9932.00', '9922.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('985', 'P1706280953088', '8022', 'abc123t1', 'order', '代购', '10.00', '9922.00', '9912.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('986', 'A1706280953081', '8022', 'abc123t1', 'order', '代购', '10.00', '9912.00', '9902.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('987', 'K1706280953088', '8022', 'abc123t1', 'order', '代购', '10.00', '9902.00', '9892.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('988', 'P1706280953083', '8022', 'abc123t1', 'order', '代购', '10.00', '9892.00', '9882.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('989', 'M1706280953083', '8022', 'abc123t1', 'order', '代购', '10.00', '9882.00', '9872.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('990', 'Z1706280953087', '8022', 'abc123t1', 'order', '代购', '10.00', '9872.00', '9862.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('991', 'A1706280953080', '8022', 'abc123t1', 'order', '代购', '10.00', '9862.00', '9852.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('992', 'O1706280953086', '8022', 'abc123t1', 'order', '代购', '10.00', '9852.00', '9842.00', '1498614788', '投注扣费，彩种:吉林快3,20170628011');
INSERT INTO `caipiao_fuddetail` VALUES ('993', 'J1706280953434', '8022', 'abc123t1', 'order', '代购', '5.00', '9842.00', '9837.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('994', 'H1706280953439', '8022', 'abc123t1', 'order', '代购', '5.00', '9837.00', '9832.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('995', 'S1706280953435', '8022', 'abc123t1', 'order', '代购', '5.00', '9832.00', '9827.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('996', 'J1706280953430', '8022', 'abc123t1', 'order', '代购', '5.00', '9827.00', '9822.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('997', 'O1706280953438', '8022', 'abc123t1', 'order', '代购', '5.00', '9822.00', '9817.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('998', 'P1706280953433', '8022', 'abc123t1', 'order', '代购', '5.00', '9817.00', '9812.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('999', 'X1706280953439', '8022', 'abc123t1', 'order', '代购', '5.00', '9812.00', '9807.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('1000', 'U1706280953438', '8022', 'abc123t1', 'order', '代购', '5.00', '9807.00', '9802.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('1001', 'G1706280953438', '8022', 'abc123t1', 'order', '代购', '5.00', '9802.00', '9797.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('1002', 'M1706280953444', '8022', 'abc123t1', 'order', '代购', '5.00', '9797.00', '9792.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('1003', 'K1706280953446', '8022', 'abc123t1', 'order', '代购', '5.00', '9792.00', '9787.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('1004', 'S1706280953448', '8022', 'abc123t1', 'order', '代购', '5.00', '9787.00', '9782.00', '1498614823', '投注扣费，彩种:极速快3,201706280594');
INSERT INTO `caipiao_fuddetail` VALUES ('1005', 'P1706280954031', '8022', 'abc123t1', 'order', '代购', '5.00', '9782.00', '9777.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1006', 'D1706280954034', '8022', 'abc123t1', 'order', '代购', '5.00', '9777.00', '9772.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1007', 'Y1706280954036', '8022', 'abc123t1', 'order', '代购', '5.00', '9772.00', '9767.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1008', 'H1706280954032', '8022', 'abc123t1', 'order', '代购', '5.00', '9767.00', '9762.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1009', 'B1706280954032', '8022', 'abc123t1', 'order', '代购', '5.00', '9762.00', '9757.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1010', 'U1706280954033', '8022', 'abc123t1', 'order', '代购', '5.00', '9757.00', '9752.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1011', 'B1706280954037', '8022', 'abc123t1', 'order', '代购', '5.00', '9752.00', '9747.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1012', 'D1706280954030', '8022', 'abc123t1', 'order', '代购', '5.00', '9747.00', '9742.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1013', 'E1706280954032', '8022', 'abc123t1', 'order', '代购', '5.00', '9742.00', '9737.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1014', 'V1706280954036', '8022', 'abc123t1', 'order', '代购', '5.00', '9737.00', '9732.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1015', 'C1706280954037', '8022', 'abc123t1', 'order', '代购', '5.00', '9732.00', '9727.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1016', 'Z1706280954037', '8022', 'abc123t1', 'order', '代购', '5.00', '9727.00', '9722.00', '1498614843', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1017', 'O1706280954160', '8022', 'abc123t1', 'order', '代购', '10.00', '9722.00', '9712.00', '1498614856', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1018', 'J1706280954177', '8022', 'abc123t1', 'order', '代购', '10.00', '9712.00', '9702.00', '1498614856', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1019', 'U1706280954170', '8022', 'abc123t1', 'order', '代购', '10.00', '9702.00', '9692.00', '1498614856', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1020', 'Y1706280954179', '8022', 'abc123t1', 'order', '代购', '10.00', '9692.00', '9682.00', '1498614856', '投注扣费，彩种:北京快3,81428');
INSERT INTO `caipiao_fuddetail` VALUES ('1021', 'Q1706280954411', '8022', 'abc123t1', 'order', '代购', '5.00', '9682.00', '9677.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1022', 'R1706280954415', '8022', 'abc123t1', 'order', '代购', '5.00', '9677.00', '9672.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1023', 'U1706280954416', '8022', 'abc123t1', 'order', '代购', '5.00', '9672.00', '9667.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1024', 'J1706280954417', '8022', 'abc123t1', 'order', '代购', '5.00', '9667.00', '9662.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1025', 'Q1706280954418', '8022', 'abc123t1', 'order', '代购', '5.00', '9662.00', '9657.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1026', 'O1706280954415', '8022', 'abc123t1', 'order', '代购', '5.00', '9657.00', '9652.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1027', 'D1706280954413', '8022', 'abc123t1', 'order', '代购', '5.00', '9652.00', '9647.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1028', 'Y1706280954412', '8022', 'abc123t1', 'order', '代购', '5.00', '9647.00', '9642.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1029', 'P1706280954419', '8022', 'abc123t1', 'order', '代购', '5.00', '9642.00', '9637.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1030', 'I1706280954412', '8022', 'abc123t1', 'order', '代购', '5.00', '9637.00', '9632.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1031', 'N1706280954413', '8022', 'abc123t1', 'order', '代购', '5.00', '9632.00', '9627.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1032', 'F1706280954419', '8022', 'abc123t1', 'order', '代购', '5.00', '9627.00', '9622.00', '1498614881', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1033', 'B1706280954470', '8022', 'abc123t1', 'order', '代购', '10.00', '9622.00', '9612.00', '1498614887', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1034', 'K1706280954476', '8022', 'abc123t1', 'order', '代购', '10.00', '9612.00', '9602.00', '1498614887', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1035', 'K1706280954478', '8022', 'abc123t1', 'order', '代购', '10.00', '9602.00', '9592.00', '1498614887', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1036', 'W1706280954478', '8022', 'abc123t1', 'order', '代购', '10.00', '9592.00', '9582.00', '1498614887', '投注扣费，彩种:湖北快3,20170628006');
INSERT INTO `caipiao_fuddetail` VALUES ('1037', 'H1706280956000113', '8023', 'abc123t2', 'activity_cz', '充值活动', '10000.00', '0.00', '10000.00', '1498615019', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1038', 'H1706280956000113', '8023', 'abc123t2', 'xima', '洗码', '5000.00', '0.00', '5000.00', '1498615019', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1039', 'B1706291406362384', '8021', 'abc123', 'activity_cz', '充值活动', '50.00', '177779.50', '177829.50', '1498716515', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1040', 'B1706291406362384', '8021', 'abc123', 'xima', '洗码', '25.00', '5051000.00', '5051025.00', '1498716515', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1041', 'O1706291409423307', '8021', 'abc123', 'activity_cz', '充值活动', '1000.00', '177829.50', '178829.50', '1498716601', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1042', 'O1706291409423307', '8021', 'abc123', 'xima', '洗码', '500.00', '5051025.00', '5051525.00', '1498716601', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1043', 'O1706291500461456', '8023', 'abc123t2', 'activity_cz', '充值活动', '1000.00', '10000.00', '11000.00', '1498719660', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1044', 'O1706291500461456', '8023', 'abc123t2', 'xima', '洗码', '500.00', '5000.00', '5500.00', '1498719660', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1045', 'L1706291502389956', '8023', 'abc123t2', 'activity_cz', '充值活动', '10000.00', '11000.00', '21000.00', '1498719786', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1046', 'L1706291502389956', '8023', 'abc123t2', 'xima', '洗码', '5000.00', '5500.00', '10500.00', '1498719786', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1047', 'Z1706291503382', '8023', 'abc123t2', 'order', '代购', '10.00', '21000.00', '20990.00', '1498719818', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1048', 'N1706291503384', '8023', 'abc123t2', 'order', '代购', '10.00', '20990.00', '20980.00', '1498719818', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1049', 'X1706291503383', '8023', 'abc123t2', 'order', '代购', '10.00', '20980.00', '20970.00', '1498719818', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1050', 'K1706291503384', '8023', 'abc123t2', 'order', '代购', '10.00', '20970.00', '20960.00', '1498719818', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1051', 'G1706291504230', '8023', 'abc123t2', 'order', '代购', '5.00', '20960.00', '20955.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1052', 'D1706291504238', '8023', 'abc123t2', 'order', '代购', '5.00', '20955.00', '20950.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1053', 'W1706291504237', '8023', 'abc123t2', 'order', '代购', '5.00', '20950.00', '20945.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1054', 'T1706291504237', '8023', 'abc123t2', 'order', '代购', '5.00', '20945.00', '20940.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1055', 'X1706291504230', '8023', 'abc123t2', 'order', '代购', '5.00', '20940.00', '20935.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1056', 'H1706291504238', '8023', 'abc123t2', 'order', '代购', '5.00', '20935.00', '20930.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1057', 'Q1706291504237', '8023', 'abc123t2', 'order', '代购', '5.00', '20930.00', '20925.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1058', 'L1706291504239', '8023', 'abc123t2', 'order', '代购', '5.00', '20925.00', '20920.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1059', 'B1706291504236', '8023', 'abc123t2', 'order', '代购', '5.00', '20920.00', '20915.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1060', 'P1706291504236', '8023', 'abc123t2', 'order', '代购', '5.00', '20915.00', '20910.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1061', 'V1706291504233', '8023', 'abc123t2', 'order', '代购', '5.00', '20910.00', '20905.00', '1498719863', '投注扣费，彩种:湖北快3,20170629037');
INSERT INTO `caipiao_fuddetail` VALUES ('1062', 'F1706291505513', '8023', 'abc123t2', 'order', '代购', '10.00', '20905.00', '20895.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1063', 'K1706291505516', '8023', 'abc123t2', 'order', '代购', '10.00', '20895.00', '20885.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1064', 'R1706291505517', '8023', 'abc123t2', 'order', '代购', '10.00', '20885.00', '20875.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1065', 'Z1706291505514', '8023', 'abc123t2', 'order', '代购', '10.00', '20875.00', '20865.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1066', 'G1706291505516', '8023', 'abc123t2', 'order', '代购', '10.00', '20865.00', '20855.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1067', 'B1706291505517', '8023', 'abc123t2', 'order', '代购', '10.00', '20855.00', '20845.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1068', 'C1706291505518', '8023', 'abc123t2', 'order', '代购', '10.00', '20845.00', '20835.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1069', 'Y1706291505512', '8023', 'abc123t2', 'order', '代购', '10.00', '20835.00', '20825.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1070', 'Z1706291505513', '8023', 'abc123t2', 'order', '代购', '10.00', '20825.00', '20815.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1071', 'N1706291505519', '8023', 'abc123t2', 'order', '代购', '10.00', '20815.00', '20805.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1072', 'K1706291505511', '8023', 'abc123t2', 'order', '代购', '10.00', '20805.00', '20795.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1073', 'Z1706291505514', '8023', 'abc123t2', 'order', '代购', '10.00', '20795.00', '20785.00', '1498719951', '投注扣费，彩种:江西快3,20170629038');
INSERT INTO `caipiao_fuddetail` VALUES ('1074', 'R1706291506113', '8023', 'abc123t2', 'order', '代购', '10.00', '20785.00', '20775.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1075', 'T1706291506111', '8023', 'abc123t2', 'order', '代购', '10.00', '20775.00', '20765.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1076', 'G1706291506117', '8023', 'abc123t2', 'order', '代购', '10.00', '20765.00', '20755.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1077', 'Q1706291506119', '8023', 'abc123t2', 'order', '代购', '10.00', '20755.00', '20745.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1078', 'I1706291506118', '8023', 'abc123t2', 'order', '代购', '10.00', '20745.00', '20735.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1079', 'S1706291506117', '8023', 'abc123t2', 'order', '代购', '10.00', '20735.00', '20725.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1080', 'V1706291506112', '8023', 'abc123t2', 'order', '代购', '10.00', '20725.00', '20715.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1081', 'E1706291506115', '8023', 'abc123t2', 'order', '代购', '10.00', '20715.00', '20705.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1082', 'J1706291506112', '8023', 'abc123t2', 'order', '代购', '10.00', '20705.00', '20695.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1083', 'Y1706291506119', '8023', 'abc123t2', 'order', '代购', '10.00', '20695.00', '20685.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1084', 'W1706291506111', '8023', 'abc123t2', 'order', '代购', '10.00', '20685.00', '20675.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1085', 'L1706291506113', '8023', 'abc123t2', 'order', '代购', '10.00', '20675.00', '20665.00', '1498719971', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1086', 'R1706291507103', '8023', 'abc123t2', 'order', '代购', '10.00', '20665.00', '20655.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1087', 'U1706291507108', '8023', 'abc123t2', 'order', '代购', '10.00', '20655.00', '20645.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1088', 'Y1706291507109', '8023', 'abc123t2', 'order', '代购', '10.00', '20645.00', '20635.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1089', 'M1706291507103', '8023', 'abc123t2', 'order', '代购', '10.00', '20635.00', '20625.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1090', 'G1706291507104', '8023', 'abc123t2', 'order', '代购', '10.00', '20625.00', '20615.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1091', 'F1706291507103', '8023', 'abc123t2', 'order', '代购', '10.00', '20615.00', '20605.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1092', 'W1706291507103', '8023', 'abc123t2', 'order', '代购', '10.00', '20605.00', '20595.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1093', 'Z1706291507108', '8023', 'abc123t2', 'order', '代购', '10.00', '20595.00', '20585.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1094', 'B1706291507105', '8023', 'abc123t2', 'order', '代购', '10.00', '20585.00', '20575.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1095', 'G1706291507101', '8023', 'abc123t2', 'order', '代购', '10.00', '20575.00', '20565.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1096', 'M1706291507105', '8023', 'abc123t2', 'order', '代购', '10.00', '20565.00', '20555.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1097', 'C1706291507105', '8023', 'abc123t2', 'order', '代购', '10.00', '20555.00', '20545.00', '1498720030', '投注扣费，彩种:广西快3,20170629035');
INSERT INTO `caipiao_fuddetail` VALUES ('1098', 'D1706291504238', '8023', 'abc123t2', 'reward', '返奖', '42.50', '20545.00', '20587.50', '1498720341', '湖北快3第20170629037期-和值12');
INSERT INTO `caipiao_fuddetail` VALUES ('1099', 'K1706291503384', '8023', 'abc123t2', 'reward', '返奖', '19.50', '20587.50', '20607.00', '1498720343', '湖北快3第20170629037期-和值大');
INSERT INTO `caipiao_fuddetail` VALUES ('1100', 'Z1706291503382', '8023', 'abc123t2', 'reward', '返奖', '19.50', '20607.00', '20626.50', '1498720343', '湖北快3第20170629037期-和值双');
INSERT INTO `caipiao_fuddetail` VALUES ('1101', 'F1706291505513', '8023', 'abc123t2', 'reward', '返奖', '125.00', '20626.50', '20751.50', '1498720595', '江西快3第20170629038期-和值14');
INSERT INTO `caipiao_fuddetail` VALUES ('1102', 'F1706291507103', '8023', 'abc123t2', 'reward', '返奖', '85.00', '20751.50', '20836.50', '1498720870', '广西快3第20170629035期-和值9');
INSERT INTO `caipiao_fuddetail` VALUES ('1103', 'L1706291506113', '8023', 'abc123t2', 'reward', '返奖', '19.50', '20836.50', '20856.00', '1498720872', '广西快3第20170629035期-和值小');
INSERT INTO `caipiao_fuddetail` VALUES ('1104', 'W1706291506111', '8023', 'abc123t2', 'reward', '返奖', '19.50', '20856.00', '20875.50', '1498720872', '广西快3第20170629035期-和值单');
INSERT INTO `caipiao_fuddetail` VALUES ('1105', 'I1706291506118', '8023', 'abc123t2', 'reward', '返奖', '85.00', '20875.50', '20960.50', '1498720872', '广西快3第20170629035期-和值9');
INSERT INTO `caipiao_fuddetail` VALUES ('1106', 'A1706291540015037', '8023', 'abc123t2', 'jinjishenhe', '晋级审核通过', '74.00', '20960.50', '21034.50', '1498722001', '晋级审核通过');
INSERT INTO `caipiao_fuddetail` VALUES ('1107', 'X1706301546343646', '8023', 'abc123t2', 'fanshui', '每日加奖', '2.28', '21034.50', '21036.78', '1498808794', '每日加奖通过');
INSERT INTO `caipiao_fuddetail` VALUES ('1108', 'V1706301547507193', '8023', 'abc123t2', 'fanshui', '每日加奖', '2.28', '21036.78', '21039.06', '1498808870', '每日加奖通过');
INSERT INTO `caipiao_fuddetail` VALUES ('1109', 'U1706301548499518', '8023', 'abc123t2', 'fanshui', '每日加奖', '2.28', '21039.06', '21041.34', '1498808929', '每日加奖通过');
INSERT INTO `caipiao_fuddetail` VALUES ('1110', 'M1706301716102912', '8022', 'abc123t1', 'activity_cz', '充值活动', '1000.00', '9582.00', '10582.00', '1498814201', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1111', 'M1706301716102912', '8022', 'abc123t1', 'xima', '洗码', '500.00', '5000.00', '5500.00', '1498814201', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1112', 'HWW1706301726404800', '8044', '我是某某3', 'activity_cz', '充值活动', '100.00', '0.00', '100.00', '1498814800', '手动充值增加');
INSERT INTO `caipiao_fuddetail` VALUES ('1113', 'ERF1706301732405793', '8022', 'abc123t1', 'activity_cz', '充值活动', '1000.00', '10582.00', '11582.00', '1498815160', '手动充值增加');
INSERT INTO `caipiao_fuddetail` VALUES ('1114', 'HFP1706301733209173', '8022', 'abc123t1', 'activity_cz', '充值活动', '1000.00', '11582.00', '12582.00', '1498815200', '手动充值增加');
INSERT INTO `caipiao_fuddetail` VALUES ('1115', 'F1706301742543594', '8022', 'abc123t1', 'activity_cz', '充值活动', '100.00', '12582.00', '12682.00', '1498815791', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1116', 'F1706301742543594', '8022', 'abc123t1', 'xima', '洗码', '50.00', '5500.00', '5550.00', '1498815791', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1117', 'B1706301744229735', '8022', 'abc123t1', 'activity_cz', '充值活动', '1000.00', '12682.00', '13682.00', '1498815877', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1118', 'B1706301744229735', '8022', 'abc123t1', 'xima', '洗码', '500.00', '5550.00', '6050.00', '1498815877', '账户充值增加洗码额度');
INSERT INTO `caipiao_fuddetail` VALUES ('1206', 'I1707041322387', '8022', 'abc123t1', 'order', '代购', '10.00', '14582.00', '14572.00', '1499145758', '投注扣费，彩种:河北快三,20170704030');
INSERT INTO `caipiao_fuddetail` VALUES ('1207', 'W1707041322382', '8022', 'abc123t1', 'order', '代购', '10.00', '14572.00', '14562.00', '1499145758', '投注扣费，彩种:河北快三,20170704030');
INSERT INTO `caipiao_fuddetail` VALUES ('1208', 'L1707041322383', '8022', 'abc123t1', 'order', '代购', '10.00', '14562.00', '14552.00', '1499145758', '投注扣费，彩种:河北快三,20170704030');
INSERT INTO `caipiao_fuddetail` VALUES ('1209', 'W1707050939499928', '8021', 'abc123', 'activity_cz', '充值活动', '1000.00', '753868.65', '754868.65', '1499218830', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1210', 'W1707050939499928', '8021', 'abc123', 'point', '积分', '1000.00', '753868.65', '754868.65', '1499218830', '账户充值赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1211', 'W1707050939499928', '8021', 'abc123', 'activity_cz', '充值活动', '100.00', '754868.65', '754968.65', '1499218830', '单次充值满赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('1212', 'L1707041802282680', '8021', 'abc123', 'activity_cz', '充值活动', '2342.00', '754968.65', '757310.65', '1499219218', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1213', 'L1707041802282680', '8021', 'abc123', 'point', '积分', '2342.00', '754968.65', '757310.65', '1499219218', '账户充值赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1214', 'L1707041802282680', '8021', 'abc123', 'activity_cz', '充值活动', '468.40', '757310.65', '757779.05', '1499219218', '单次充值满赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('1215', 'B1707041744400942', '8021', 'abc123', 'activity_cz', '充值活动', '100.00', '757779.05', '757879.05', '1499219282', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1216', 'B1707041744400942', '8021', 'abc123', 'point', '积分', '100.00', '757779.05', '757879.05', '1499219282', '账户充值赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1217', 'B1707041744400942', '8021', 'abc123', 'activity_cz', '充值活动', '10.00', '757879.05', '757889.05', '1499219282', '单次充值满赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('1218', 'W1707051002120552', '8022', 'abc123t1', 'activity_cz', '充值活动', '1000.00', '14552.00', '15552.00', '1499220172', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1219', 'W1707051002120552', '8022', 'abc123t1', 'point', '积分', '1000.00', '14552.00', '15552.00', '1499220172', '账户充值赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1220', 'W1707051002120552', '8022', 'abc123t1', 'activity_cz', '充值活动', '100.00', '15552.00', '15652.00', '1499220172', '单次充值满赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('1221', 'F1707051004138394', '8022', 'abc123t1', 'activity_cz', '充值活动', '1000.00', '15652.00', '16652.00', '1499220402', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1222', 'F1707051004138394', '8022', 'abc123t1', 'point', '积分', '1000.00', '15652.00', '16652.00', '1499220402', '账户充值赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1223', 'F1707051004138394', '8022', 'abc123t1', 'activity_cz', '充值活动', '100.00', '16652.00', '16752.00', '1499220402', '单次充值满赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('1224', 'E1707051017211629', '8022', 'abc123t1', 'activity_cz', '充值活动', '1000.00', '16752.00', '17752.00', '1499221055', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1225', 'E1707051017211629', '8022', 'abc123t1', 'point', '积分', '1000.00', '16752.00', '17752.00', '1499221055', '账户充值赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1226', 'E1707051017211629', '8022', 'abc123t1', 'activity_cz', '充值活动', '100.00', '17752.00', '17852.00', '1499221055', '单次充值满赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('1227', 'E1707051018086193', '8022', 'abc123t1', 'activity_cz', '充值活动', '1000.00', '17852.00', '18852.00', '1499221123', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1228', 'E1707051018086193', '8022', 'abc123t1', 'point', '积分', '1000.00', '17852.00', '18852.00', '1499221123', '账户充值赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1229', 'E1707051018086193', '8022', 'abc123t1', 'activity_cz', '充值活动', '100.00', '18852.00', '18952.00', '1499221123', '单次充值满赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('1230', 'M1707051021498922', '8022', 'abc123t1', 'activity_cz', '充值', '1000.00', '18952.00', '19952.00', '1499221325', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1231', 'M1707051021498922', '8022', 'abc123t1', 'point', '积分', '1000.00', '18952.00', '19952.00', '1499221325', '账户充值赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1232', 'M1707051021498922', '8022', 'abc123t1', 'activity_cz', '充值活动', '100.00', '19952.00', '20052.00', '1499221325', '单次充值满赠送');
INSERT INTO `caipiao_fuddetail` VALUES ('1233', 'Z1707051239195494', '8022', 'abc123t1', 'activity_cz', '充值', '50000.00', '20052.00', '70052.00', '1499229613', '账户充值');
INSERT INTO `caipiao_fuddetail` VALUES ('1234', 'Z1707051239195494', '8022', 'abc123t1', 'point', '积分', '50000.00', '20052.00', '70052.00', '1499229613', '账户充值赠送积分');
INSERT INTO `caipiao_fuddetail` VALUES ('1235', 'O1707061134144', '8021', 'abc123', 'order', '代购', '200000.00', '757889.05', '557889.05', '1499312054', '投注扣费，彩种:大发时时彩,20170706349');
INSERT INTO `caipiao_fuddetail` VALUES ('1236', 'O1707061134144', '8021', 'abc123', 'reward', '返奖', '192000.00', '557889.05', '749889.05', '1499312467', '大发时时彩第20170706349期-五星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1237', 'D1707061146592', '8021', 'abc123', 'order', '代购', '14.00', '749889.05', '749875.05', '1499312819', '投注扣费，彩种:重庆时时彩,20170706035');
INSERT INTO `caipiao_fuddetail` VALUES ('1238', 'L1707061150030', '8021', 'abc123', 'order', '代购', '504.00', '749875.05', '749371.05', '1499313003', '投注扣费，彩种:重庆时时彩,20170706036');
INSERT INTO `caipiao_fuddetail` VALUES ('1239', 'A1707061310111', '8021', 'abc123', 'order', '代购', '1680.00', '749371.05', '747691.05', '1499317811', '投注扣费，彩种:大发时时彩,20170706397');
INSERT INTO `caipiao_fuddetail` VALUES ('1240', 'O1707061337353', '8021', 'abc123', 'order', '代购', '2.00', '747691.05', '747689.05', '1499319455', '投注扣费，彩种:大发时时彩,20170706410');
INSERT INTO `caipiao_fuddetail` VALUES ('1241', 'D1707061448514', '8021', 'abc123', 'order', '代购', '20000.00', '747689.05', '727689.05', '1499323731', '投注扣费，彩种:大发时时彩,20170706446');
INSERT INTO `caipiao_fuddetail` VALUES ('1242', 'O1707061458321', '8021', 'abc123', 'order', '代购', '10.00', '727689.05', '727679.05', '1499324312', '投注扣费，彩种:大发时时彩,20170706451');
INSERT INTO `caipiao_fuddetail` VALUES ('1243', 'V1707061513146', '8021', 'abc123', 'order', '代购', '10.00', '727679.05', '727669.05', '1499325194', '投注扣费，彩种:大发时时彩,20170706458');
INSERT INTO `caipiao_fuddetail` VALUES ('1244', 'W1707061515562', '8021', 'abc123', 'order', '代购', '420.00', '727669.05', '727249.05', '1499325356', '投注扣费，彩种:大发时时彩,20170706460');
INSERT INTO `caipiao_fuddetail` VALUES ('1245', 'E1707061547293', '8021', 'abc123', 'order', '代购', '720.00', '727249.05', '726529.05', '1499327249', '投注扣费，彩种:大发时时彩,20170706475');
INSERT INTO `caipiao_fuddetail` VALUES ('1246', 'R1707061552313', '8021', 'abc123', 'order', '代购', '2000.00', '726529.05', '724529.05', '1499327551', '投注扣费，彩种:大发时时彩,20170706478');
INSERT INTO `caipiao_fuddetail` VALUES ('1247', 'T1707061555450', '8021', 'abc123', 'order', '代购', '10.00', '724529.05', '724519.05', '1499327745', '投注扣费，彩种:大发时时彩,20170706479');
INSERT INTO `caipiao_fuddetail` VALUES ('1248', 'U1707061602417', '8021', 'abc123', 'order', '代购', '180.00', '724519.05', '724339.05', '1499328161', '投注扣费，彩种:大发时时彩,20170706483');
INSERT INTO `caipiao_fuddetail` VALUES ('1249', 'D1707061635115', '8021', 'abc123', 'order', '代购', '240.00', '724339.05', '724099.05', '1499330111', '投注扣费，彩种:大发时时彩,20170706499');
INSERT INTO `caipiao_fuddetail` VALUES ('1250', 'M1707061640432', '8021', 'abc123', 'order', '代购', '16.00', '724099.05', '724083.05', '1499330443', '投注扣费，彩种:大发时时彩,20170706502');
INSERT INTO `caipiao_fuddetail` VALUES ('1251', 'Z1707061658430', '8021', 'abc123', 'order', '代购', '8.00', '724083.05', '724075.05', '1499331523', '投注扣费，彩种:大发时时彩,20170706511');
INSERT INTO `caipiao_fuddetail` VALUES ('1252', 'V1707061701233', '8021', 'abc123', 'order', '代购', '108.00', '724075.05', '723967.05', '1499331683', '投注扣费，彩种:大发时时彩,20170706512');
INSERT INTO `caipiao_fuddetail` VALUES ('1253', 'H1707061707073', '8021', 'abc123', 'order', '代购', '2000.00', '723967.05', '721967.05', '1499332027', '投注扣费，彩种:大发时时彩,20170706515');
INSERT INTO `caipiao_fuddetail` VALUES ('1254', 'U1707061710086', '8021', 'abc123', 'order', '代购', '10.00', '721967.05', '721957.05', '1499332208', '投注扣费，彩种:大发时时彩,20170706517');
INSERT INTO `caipiao_fuddetail` VALUES ('1255', 'I1707061714430', '8021', 'abc123', 'order', '代购', '180.00', '721957.05', '721777.05', '1499332483', '投注扣费，彩种:大发时时彩,20170706519');
INSERT INTO `caipiao_fuddetail` VALUES ('1256', 'H1707061716194', '8021', 'abc123', 'order', '代购', '240.00', '721777.05', '721537.05', '1499332579', '投注扣费，彩种:大发时时彩,20170706520');
INSERT INTO `caipiao_fuddetail` VALUES ('1257', 'E1707061727442', '8021', 'abc123', 'order', '代购', '12.00', '721537.05', '721525.05', '1499333264', '投注扣费，彩种:大发时时彩,20170706525');
INSERT INTO `caipiao_fuddetail` VALUES ('1258', 'U1707061732199', '8021', 'abc123', 'order', '代购', '14.00', '721525.05', '721511.05', '1499333539', '投注扣费，彩种:大发时时彩,20170706528');
INSERT INTO `caipiao_fuddetail` VALUES ('1259', 'Y1707061957120', '8021', 'abc123', 'order', '代购', '2.00', '721511.05', '721509.05', '1499342232', '投注扣费，彩种:大发时时彩,20170706600');
INSERT INTO `caipiao_fuddetail` VALUES ('1260', 'E1707062000112', '8021', 'abc123', 'order', '代购', '8.00', '721509.05', '721501.05', '1499342411', '投注扣费，彩种:大发时时彩,20170706602');
INSERT INTO `caipiao_fuddetail` VALUES ('1261', 'D1707062008207', '8021', 'abc123', 'order', '代购', '4.00', '721501.05', '721497.05', '1499342900', '投注扣费，彩种:大发时时彩,20170706606');
INSERT INTO `caipiao_fuddetail` VALUES ('1262', 'D1707062038033', '8021', 'abc123', 'order', '代购', '14.00', '721497.05', '721483.05', '1499344683', '投注扣费，彩种:大发时时彩,20170706621');
INSERT INTO `caipiao_fuddetail` VALUES ('1263', 'Y1707062045048', '8021', 'abc123', 'order', '代购', '2000.00', '721483.05', '719483.05', '1499345104', '投注扣费，彩种:大发时时彩,20170706624');
INSERT INTO `caipiao_fuddetail` VALUES ('1264', 'O1707062046067', '8021', 'abc123', 'order', '代购', '12.00', '719483.05', '719471.05', '1499345166', '投注扣费，彩种:大发时时彩,20170706625');
INSERT INTO `caipiao_fuddetail` VALUES ('1265', 'L1707062054052', '8021', 'abc123', 'order', '代购', '12.00', '719471.05', '719459.05', '1499345645', '投注扣费，彩种:大发时时彩,20170706629');
INSERT INTO `caipiao_fuddetail` VALUES ('1266', 'V1707062207224', '8021', 'abc123', 'order', '代购', '240.00', '719459.05', '719219.05', '1499350042', '投注扣费，彩种:大发时时彩,20170706665');
INSERT INTO `caipiao_fuddetail` VALUES ('1267', 'C1707062210194', '8021', 'abc123', 'order', '代购', '16.00', '719219.05', '719203.05', '1499350219', '投注扣费，彩种:大发时时彩,20170706667');
INSERT INTO `caipiao_fuddetail` VALUES ('1268', 'T1707062217478', '8021', 'abc123', 'order', '代购', '200.00', '719203.05', '719003.05', '1499350667', '投注扣费，彩种:大发时时彩,20170706670');
INSERT INTO `caipiao_fuddetail` VALUES ('1269', 'V1707062220462', '8021', 'abc123', 'order', '代购', '14.00', '719003.05', '718989.05', '1499350846', '投注扣费，彩种:大发时时彩,20170706672');
INSERT INTO `caipiao_fuddetail` VALUES ('1270', 'S1707062224412', '8021', 'abc123', 'order', '代购', '18.00', '718989.05', '718971.05', '1499351081', '投注扣费，彩种:大发时时彩,20170706674');
INSERT INTO `caipiao_fuddetail` VALUES ('1271', 'H1707062234398', '8021', 'abc123', 'order', '代购', '200.00', '718971.05', '718771.05', '1499351679', '投注扣费，彩种:大发时时彩,20170706679');
INSERT INTO `caipiao_fuddetail` VALUES ('1272', 'R1707062237376', '8021', 'abc123', 'order', '代购', '90.00', '718771.05', '718681.05', '1499351857', '投注扣费，彩种:大发时时彩,20170706680');
INSERT INTO `caipiao_fuddetail` VALUES ('1273', 'O1707062251019', '8021', 'abc123', 'order', '代购', '18.00', '718681.05', '718663.05', '1499352661', '投注扣费，彩种:大发时时彩,20170706687');
INSERT INTO `caipiao_fuddetail` VALUES ('1274', 'S1707062253136', '8021', 'abc123', 'order', '代购', '12.00', '718663.05', '718651.05', '1499352793', '投注扣费，彩种:大发时时彩,20170706688');
INSERT INTO `caipiao_fuddetail` VALUES ('1275', 'P1707062300022', '8021', 'abc123', 'order', '代购', '18.00', '718651.05', '718633.05', '1499353202', '投注扣费，彩种:大发时时彩,20170706692');
INSERT INTO `caipiao_fuddetail` VALUES ('1276', 'S1707062303239', '8021', 'abc123', 'order', '代购', '90.00', '718633.05', '718543.05', '1499353403', '投注扣费，彩种:大发时时彩,20170706693');
INSERT INTO `caipiao_fuddetail` VALUES ('1277', 'G1707062311122', '8021', 'abc123', 'order', '代购', '20.00', '718543.05', '718523.05', '1499353872', '投注扣费，彩种:大发时时彩,20170706697');
INSERT INTO `caipiao_fuddetail` VALUES ('1278', 'T1707062316490', '8021', 'abc123', 'order', '代购', '90.00', '718523.05', '718433.05', '1499354209', '投注扣费，彩种:大发时时彩,20170706700');
INSERT INTO `caipiao_fuddetail` VALUES ('1279', 'K1707062327314', '8021', 'abc123', 'order', '代购', '20.00', '718433.05', '718413.05', '1499354851', '投注扣费，彩种:大发时时彩,20170706705');
INSERT INTO `caipiao_fuddetail` VALUES ('1280', 'G1707062329023', '8021', 'abc123', 'order', '代购', '20.00', '718413.05', '718393.05', '1499354942', '投注扣费，彩种:大发时时彩,20170706706');
INSERT INTO `caipiao_fuddetail` VALUES ('1281', 'O1707070848069', '8021', 'abc123', 'order', '代购', '2000.00', '718393.05', '716393.05', '1499388486', '投注扣费，彩种:大发时时彩,20170707266');
INSERT INTO `caipiao_fuddetail` VALUES ('1282', 'H1707070901583', '8021', 'abc123', 'order', '代购', '32.00', '716393.05', '716361.05', '1499389318', '投注扣费，彩种:大发时时彩,20170707273');
INSERT INTO `caipiao_fuddetail` VALUES ('1283', 'B1707070942562', '8021', 'abc123', 'order', '代购', '128.00', '716361.05', '716233.05', '1499391776', '投注扣费，彩种:大发时时彩,20170707293');
INSERT INTO `caipiao_fuddetail` VALUES ('1284', 'B1707070946373', '8021', 'abc123', 'order', '代购', '2000.00', '716233.05', '714233.05', '1499391997', '投注扣费，彩种:大发时时彩,20170707295');
INSERT INTO `caipiao_fuddetail` VALUES ('1285', 'W1707070959207', '8021', 'abc123', 'order', '代购', '420.00', '714233.05', '713813.05', '1499392760', '投注扣费，彩种:大发时时彩,20170707301');
INSERT INTO `caipiao_fuddetail` VALUES ('1286', 'W1707071036292', '8021', 'abc123', 'order', '代购', '100.00', '713813.05', '713713.05', '1499394989', '投注扣费，彩种:大发时时彩,20170707320');
INSERT INTO `caipiao_fuddetail` VALUES ('1287', 'V1707071041108', '8021', 'abc123', 'order', '代购', '200000.00', '713713.05', '513713.05', '1499395270', '投注扣费，彩种:大发时时彩,20170707322');
INSERT INTO `caipiao_fuddetail` VALUES ('1288', 'V1707071041493', '8021', 'abc123', 'order', '代购', '6.00', '513713.05', '513707.05', '1499395309', '投注扣费，彩种:大发时时彩,20170707322');
INSERT INTO `caipiao_fuddetail` VALUES ('1289', 'T1707071042019', '8021', 'abc123', 'order', '代购', '504.00', '513707.05', '513203.05', '1499395321', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1290', 'P1707071042119', '8021', 'abc123', 'order', '代购', '1680.00', '513203.05', '511523.05', '1499395331', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1291', 'D1707071042199', '8021', 'abc123', 'order', '代购', '720.00', '511523.05', '510803.05', '1499395339', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1292', 'O1707071042322', '8021', 'abc123', 'order', '代购', '720.00', '510803.05', '510083.05', '1499395352', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1293', 'E1707071042411', '8021', 'abc123', 'order', '代购', '180.00', '510083.05', '509903.05', '1499395361', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1294', 'E1707071042501', '8021', 'abc123', 'order', '代购', '180.00', '509903.05', '509723.05', '1499395370', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1295', 'L1707071042596', '8021', 'abc123', 'order', '代购', '20.00', '509723.05', '509703.05', '1499395379', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1296', 'R1707071043129', '8021', 'abc123', 'order', '代购', '90.00', '509703.05', '509613.05', '1499395392', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1297', 'Y1707071043206', '8021', 'abc123', 'order', '代购', '240.00', '509613.05', '509373.05', '1499395400', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1298', 'Y1707071043286', '8021', 'abc123', 'order', '代购', '20.00', '509373.05', '509353.05', '1499395408', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1299', 'M1707071043465', '8021', 'abc123', 'order', '代购', '20.00', '509353.05', '509333.05', '1499395426', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1300', 'T1707071043465', '8021', 'abc123', 'order', '代购', '20.00', '509333.05', '509313.05', '1499395426', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1301', 'R1707071043465', '8021', 'abc123', 'order', '代购', '20.00', '509313.05', '509293.05', '1499395426', '投注扣费，彩种:大发时时彩,20170707323');
INSERT INTO `caipiao_fuddetail` VALUES ('1302', 'V1707071041108', '8021', 'abc123', 'reward', '返奖', '192000.00', '509293.05', '701293.05', '1499395478', '大发时时彩第20170707322期-五星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1303', 'Y1707071043286', '8021', 'abc123', 'reward', '返奖', '23.40', '701293.05', '701316.45', '1499395560', '大发时时彩第20170707323期-一帆风顺');
INSERT INTO `caipiao_fuddetail` VALUES ('1304', 'Y1707071043206', '8021', 'abc123', 'reward', '返奖', '446.50', '701316.45', '701762.95', '1499395560', '大发时时彩第20170707323期-五星三码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1305', 'R1707071043129', '8021', 'abc123', 'reward', '返奖', '130.00', '701762.95', '701892.95', '1499395560', '大发时时彩第20170707323期-五星二码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1306', 'L1707071042596', '8021', 'abc123', 'reward', '返奖', '17.00', '701892.95', '701909.95', '1499395560', '大发时时彩第20170707323期-五星一码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1307', 'T1707071042019', '8021', 'abc123', 'reward', '返奖', '1541.00', '701909.95', '703450.95', '1499395563', '大发时时彩第20170707323期-组选120');
INSERT INTO `caipiao_fuddetail` VALUES ('1308', 'S1707071047531', '8021', 'abc123', 'order', '代购', '20000.00', '703450.95', '683450.95', '1499395673', '投注扣费，彩种:大发时时彩,20170707326');
INSERT INTO `caipiao_fuddetail` VALUES ('1309', 'Z1707071048326', '8021', 'abc123', 'order', '代购', '16.00', '683450.95', '683434.95', '1499395712', '投注扣费，彩种:大发时时彩,20170707326');
INSERT INTO `caipiao_fuddetail` VALUES ('1310', 'D1707071049086', '8021', 'abc123', 'order', '代购', '420.00', '683434.95', '683014.95', '1499395748', '投注扣费，彩种:大发时时彩,20170707326');
INSERT INTO `caipiao_fuddetail` VALUES ('1311', 'O1707071049082', '8021', 'abc123', 'order', '代购', '720.00', '683014.95', '682294.95', '1499395748', '投注扣费，彩种:大发时时彩,20170707326');
INSERT INTO `caipiao_fuddetail` VALUES ('1312', 'F1707071049087', '8021', 'abc123', 'order', '代购', '90.00', '682294.95', '682204.95', '1499395748', '投注扣费，彩种:大发时时彩,20170707326');
INSERT INTO `caipiao_fuddetail` VALUES ('1313', 'E1707071049085', '8021', 'abc123', 'order', '代购', '180.00', '682204.95', '682024.95', '1499395748', '投注扣费，彩种:大发时时彩,20170707326');
INSERT INTO `caipiao_fuddetail` VALUES ('1314', 'V1707071049086', '8021', 'abc123', 'order', '代购', '20.00', '682024.95', '682004.95', '1499395748', '投注扣费，彩种:大发时时彩,20170707326');
INSERT INTO `caipiao_fuddetail` VALUES ('1315', 'Z1707071049081', '8021', 'abc123', 'order', '代购', '90.00', '682004.95', '681914.95', '1499395748', '投注扣费，彩种:大发时时彩,20170707326');
INSERT INTO `caipiao_fuddetail` VALUES ('1316', 'Z1707071050339', '8021', 'abc123', 'order', '代购', '2000.00', '681914.95', '679914.95', '1499395833', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1317', 'Z1707071050337', '8021', 'abc123', 'order', '代购', '2000.00', '679914.95', '677914.95', '1499395833', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1318', 'M1707071050331', '8021', 'abc123', 'order', '代购', '2000.00', '677914.95', '675914.95', '1499395833', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1319', 'N1707071050330', '8021', 'abc123', 'order', '代购', '420.00', '675914.95', '675494.95', '1499395833', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1320', 'K1707071050335', '8021', 'abc123', 'order', '代购', '180.00', '675494.95', '675314.95', '1499395833', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1321', 'A1707071050330', '8021', 'abc123', 'order', '代购', '240.00', '675314.95', '675074.95', '1499395833', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1322', 'Y1707071050333', '8021', 'abc123', 'order', '代购', '108.00', '675074.95', '674966.95', '1499395833', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1323', 'Z1707071050335', '8021', 'abc123', 'order', '代购', '20.00', '674966.95', '674946.95', '1499395833', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1324', 'Z1707071050336', '8021', 'abc123', 'order', '代购', '90.00', '674946.95', '674856.95', '1499395833', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1325', 'H1707071051322', '8021', 'abc123', 'order', '代购', '16.00', '674856.95', '674840.95', '1499395892', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1326', 'R1707071051321', '8021', 'abc123', 'order', '代购', '14.00', '674840.95', '674826.95', '1499395892', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1327', 'E1707071051328', '8021', 'abc123', 'order', '代购', '16.00', '674826.95', '674810.95', '1499395892', '投注扣费，彩种:大发时时彩,20170707327');
INSERT INTO `caipiao_fuddetail` VALUES ('1328', 'Z1707071049081', '8021', 'abc123', 'reward', '返奖', '59.13', '674810.95', '674870.08', '1499395922', '大发时时彩第20170707326期-四星二码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1329', 'V1707071049086', '8021', 'abc123', 'reward', '返奖', '16.74', '674870.08', '674886.82', '1499395922', '大发时时彩第20170707326期-四星一码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1330', 'O1707071049082', '8021', 'abc123', 'reward', '返奖', '1335.00', '674886.82', '676221.82', '1499395922', '大发时时彩第20170707326期-后四组选12');
INSERT INTO `caipiao_fuddetail` VALUES ('1331', 'S1707071047531', '8021', 'abc123', 'reward', '返奖', '19300.00', '676221.82', '695521.82', '1499395922', '大发时时彩第20170707326期-后四复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1332', 'Z1707071050336', '8021', 'abc123', 'reward', '返奖', '106.65', '695521.82', '695628.47', '1499396043', '大发时时彩第20170707327期-前三二码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1333', 'Z1707071050335', '8021', 'abc123', 'reward', '返奖', '20.40', '695628.47', '695648.87', '1499396043', '大发时时彩第20170707327期-前三不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1334', 'A1707071050330', '8021', 'abc123', 'reward', '返奖', '320.00', '695648.87', '695968.87', '1499396043', '大发时时彩第20170707327期-前三组六');
INSERT INTO `caipiao_fuddetail` VALUES ('1335', 'N1707071050330', '8021', 'abc123', 'reward', '返奖', '1930.00', '695968.87', '697898.87', '1499396043', '大发时时彩第20170707327期-前三组选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1336', 'M1707071050331', '8021', 'abc123', 'reward', '返奖', '1920.00', '697898.87', '699818.87', '1499396043', '大发时时彩第20170707327期-前三跨度');
INSERT INTO `caipiao_fuddetail` VALUES ('1337', 'Z1707071050337', '8021', 'abc123', 'reward', '返奖', '1920.00', '699818.87', '701738.87', '1499396045', '大发时时彩第20170707327期-前三直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1338', 'Z1707071050339', '8021', 'abc123', 'reward', '返奖', '1920.00', '701738.87', '703658.87', '1499396045', '大发时时彩第20170707327期-前三复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1339', 'S1707071059175', '8021', 'abc123', 'order', '代购', '2000.00', '703658.87', '701658.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1340', 'I1707071059173', '8021', 'abc123', 'order', '代购', '2000.00', '701658.87', '699658.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1341', 'Z1707071059179', '8021', 'abc123', 'order', '代购', '2000.00', '699658.87', '697658.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1342', 'M1707071059179', '8021', 'abc123', 'order', '代购', '420.00', '697658.87', '697238.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1343', 'O1707071059173', '8021', 'abc123', 'order', '代购', '180.00', '697238.87', '697058.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1344', 'X1707071059176', '8021', 'abc123', 'order', '代购', '240.00', '697058.87', '696818.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1345', 'T1707071059173', '8021', 'abc123', 'order', '代购', '108.00', '696818.87', '696710.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1346', 'U1707071059172', '8021', 'abc123', 'order', '代购', '20.00', '696710.87', '696690.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1347', 'T1707071059178', '8021', 'abc123', 'order', '代购', '90.00', '696690.87', '696600.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1348', 'W1707071059174', '8021', 'abc123', 'order', '代购', '18.00', '696600.87', '696582.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1349', 'J1707071059173', '8021', 'abc123', 'order', '代购', '12.00', '696582.87', '696570.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1350', 'U1707071059174', '8021', 'abc123', 'order', '代购', '16.00', '696570.87', '696554.87', '1499396357', '投注扣费，彩种:大发时时彩,20170707331');
INSERT INTO `caipiao_fuddetail` VALUES ('1351', 'D1707071101037', '8021', 'abc123', 'order', '代购', '2000.00', '696554.87', '694554.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1352', 'T1707071101031', '8021', 'abc123', 'order', '代购', '2000.00', '694554.87', '692554.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1353', 'D1707071101034', '8021', 'abc123', 'order', '代购', '2000.00', '692554.87', '690554.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1354', 'Q1707071101034', '8021', 'abc123', 'order', '代购', '420.00', '690554.87', '690134.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1355', 'F1707071101031', '8021', 'abc123', 'order', '代购', '180.00', '690134.87', '689954.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1356', 'L1707071101038', '8021', 'abc123', 'order', '代购', '240.00', '689954.87', '689714.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1357', 'J1707071101032', '8021', 'abc123', 'order', '代购', '18.00', '689714.87', '689696.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1358', 'L1707071101037', '8021', 'abc123', 'order', '代购', '18.00', '689696.87', '689678.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1359', 'Q1707071101031', '8021', 'abc123', 'order', '代购', '16.00', '689678.87', '689662.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1360', 'G1707071101038', '8021', 'abc123', 'order', '代购', '20.00', '689662.87', '689642.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1361', 'A1707071101037', '8021', 'abc123', 'order', '代购', '90.00', '689642.87', '689552.87', '1499396463', '投注扣费，彩种:大发时时彩,20170707332');
INSERT INTO `caipiao_fuddetail` VALUES ('1362', 'T1707071059178', '8021', 'abc123', 'reward', '返奖', '106.65', '689552.87', '689659.52', '1499396523', '大发时时彩第20170707331期-中三二码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1363', 'U1707071059172', '8021', 'abc123', 'reward', '返奖', '20.40', '689659.52', '689679.92', '1499396523', '大发时时彩第20170707331期-中三不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1364', 'T1707071059173', '8021', 'abc123', 'reward', '返奖', '640.00', '689679.92', '690319.92', '1499396523', '大发时时彩第20170707331期-中三组选包胆');
INSERT INTO `caipiao_fuddetail` VALUES ('1365', 'X1707071059176', '8021', 'abc123', 'reward', '返奖', '320.00', '690319.92', '690639.92', '1499396523', '大发时时彩第20170707331期-中三组六');
INSERT INTO `caipiao_fuddetail` VALUES ('1366', 'M1707071059179', '8021', 'abc123', 'reward', '返奖', '1930.00', '690639.92', '692569.92', '1499396523', '大发时时彩第20170707331期-中三组选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1367', 'Z1707071059179', '8021', 'abc123', 'reward', '返奖', '1920.00', '692569.92', '694489.92', '1499396523', '大发时时彩第20170707331期-中三跨度');
INSERT INTO `caipiao_fuddetail` VALUES ('1368', 'I1707071059173', '8021', 'abc123', 'reward', '返奖', '1920.00', '694489.92', '696409.92', '1499396525', '大发时时彩第20170707331期-中三直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1369', 'S1707071059175', '8021', 'abc123', 'reward', '返奖', '1920.00', '696409.92', '698329.92', '1499396525', '大发时时彩第20170707331期-中三复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1370', 'Q1707071102212', '8021', 'abc123', 'order', '代购', '200.00', '698329.92', '698129.92', '1499396541', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1371', 'I1707071102217', '8021', 'abc123', 'order', '代购', '18.00', '698129.92', '698111.92', '1499396541', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1372', 'P1707071102210', '8021', 'abc123', 'order', '代购', '200.00', '698111.92', '697911.92', '1499396541', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1373', 'P1707071102210', '8021', 'abc123', 'order', '代购', '200.00', '697911.92', '697711.92', '1499396541', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1374', 'N1707071102216', '8021', 'abc123', 'order', '代购', '180.00', '697711.92', '697531.92', '1499396541', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1375', 'N1707071102216', '8021', 'abc123', 'order', '代购', '18.00', '697531.92', '697513.92', '1499396541', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1376', 'U1707071102215', '8021', 'abc123', 'order', '代购', '90.00', '697513.92', '697423.92', '1499396541', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1377', 'B1707071102215', '8021', 'abc123', 'order', '代购', '18.00', '697423.92', '697405.92', '1499396541', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1378', 'Y1707071103220', '8021', 'abc123', 'order', '代购', '200.00', '697405.92', '697205.92', '1499396602', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1379', 'G1707071103229', '8021', 'abc123', 'order', '代购', '16.00', '697205.92', '697189.92', '1499396602', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1380', 'F1707071103226', '8021', 'abc123', 'order', '代购', '200.00', '697189.92', '696989.92', '1499396602', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1381', 'F1707071103220', '8021', 'abc123', 'order', '代购', '200.00', '696989.92', '696789.92', '1499396602', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1382', 'U1707071103221', '8021', 'abc123', 'order', '代购', '90.00', '696789.92', '696699.92', '1499396602', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1383', 'Y1707071103227', '8021', 'abc123', 'order', '代购', '16.00', '696699.92', '696683.92', '1499396602', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1384', 'Z1707071103225', '8021', 'abc123', 'order', '代购', '90.00', '696683.92', '696593.92', '1499396602', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1385', 'L1707071103220', '8021', 'abc123', 'order', '代购', '18.00', '696593.92', '696575.92', '1499396602', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1386', 'T1707071103468', '8021', 'abc123', 'order', '代购', '100.00', '696575.92', '696475.92', '1499396626', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1387', 'M1707071103467', '8021', 'abc123', 'order', '代购', '32.00', '696475.92', '696443.92', '1499396626', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1388', 'E1707071103468', '8021', 'abc123', 'order', '代购', '32.00', '696443.92', '696411.92', '1499396626', '投注扣费，彩种:大发时时彩,20170707333');
INSERT INTO `caipiao_fuddetail` VALUES ('1389', 'A1707071101037', '8021', 'abc123', 'reward', '返奖', '106.65', '696411.92', '696518.57', '1499396643', '大发时时彩第20170707332期-后三二码不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1390', 'G1707071101038', '8021', 'abc123', 'reward', '返奖', '20.40', '696518.57', '696538.97', '1499396643', '大发时时彩第20170707332期-后三不定位');
INSERT INTO `caipiao_fuddetail` VALUES ('1391', 'Q1707071101031', '8021', 'abc123', 'reward', '返奖', '320.00', '696538.97', '696858.97', '1499396643', '大发时时彩第20170707332期-后三组六单式');
INSERT INTO `caipiao_fuddetail` VALUES ('1392', 'L1707071101038', '8021', 'abc123', 'reward', '返奖', '320.00', '696858.97', '697178.97', '1499396643', '大发时时彩第20170707332期-后三组六');
INSERT INTO `caipiao_fuddetail` VALUES ('1393', 'Q1707071101034', '8021', 'abc123', 'reward', '返奖', '1930.00', '697178.97', '699108.97', '1499396643', '大发时时彩第20170707332期-后三组选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1394', 'D1707071101034', '8021', 'abc123', 'reward', '返奖', '1920.00', '699108.97', '701028.97', '1499396643', '大发时时彩第20170707332期-后三跨度');
INSERT INTO `caipiao_fuddetail` VALUES ('1395', 'T1707071101031', '8021', 'abc123', 'reward', '返奖', '1920.00', '701028.97', '702948.97', '1499396643', '大发时时彩第20170707332期-后三直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1396', 'X1707071104057', '8021', 'abc123', 'order', '代购', '128.00', '702948.97', '702820.97', '1499396645', '投注扣费，彩种:大发时时彩,20170707334');
INSERT INTO `caipiao_fuddetail` VALUES ('1397', 'D1707071101037', '8021', 'abc123', 'reward', '返奖', '1920.00', '702820.97', '704740.97', '1499396645', '大发时时彩第20170707332期-后三复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1398', 'W1707071104279', '8021', 'abc123', 'order', '代购', '128.00', '704740.97', '704612.97', '1499396667', '投注扣费，彩种:大发时时彩,20170707334');
INSERT INTO `caipiao_fuddetail` VALUES ('1399', 'E1707071103468', '8021', 'abc123', 'reward', '返奖', '30.72', '704612.97', '704643.69', '1499396765', '大发时时彩第20170707333期-后二大小单双');
INSERT INTO `caipiao_fuddetail` VALUES ('1400', 'M1707071103467', '8021', 'abc123', 'reward', '返奖', '30.72', '704643.69', '704674.41', '1499396765', '大发时时彩第20170707333期-前二大小单双');
INSERT INTO `caipiao_fuddetail` VALUES ('1401', 'T1707071103468', '8021', 'abc123', 'reward', '返奖', '98.00', '704674.41', '704772.41', '1499396765', '大发时时彩第20170707333期-一星复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1402', 'L1707071103220', '8021', 'abc123', 'reward', '返奖', '96.00', '704772.41', '704868.41', '1499396765', '大发时时彩第20170707333期-后二组选包胆');
INSERT INTO `caipiao_fuddetail` VALUES ('1403', 'Z1707071103225', '8021', 'abc123', 'reward', '返奖', '96.00', '704868.41', '704964.41', '1499396765', '大发时时彩第20170707333期-后二组选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1404', 'U1707071103221', '8021', 'abc123', 'reward', '返奖', '88.10', '704964.41', '705052.51', '1499396765', '大发时时彩第20170707333期-后二组选复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1405', 'F1707071103220', '8021', 'abc123', 'reward', '返奖', '192.00', '705052.51', '705244.51', '1499396765', '大发时时彩第20170707333期-后二跨度');
INSERT INTO `caipiao_fuddetail` VALUES ('1406', 'F1707071103226', '8021', 'abc123', 'reward', '返奖', '192.00', '705244.51', '705436.51', '1499396765', '大发时时彩第20170707333期-后二直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1407', 'Y1707071103220', '8021', 'abc123', 'reward', '返奖', '192.00', '705436.51', '705628.51', '1499396767', '大发时时彩第20170707333期-后二直选复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1408', 'U1707071102215', '8021', 'abc123', 'reward', '返奖', '96.00', '705628.51', '705724.51', '1499396767', '大发时时彩第20170707333期-前二组选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1409', 'N1707071102216', '8021', 'abc123', 'reward', '返奖', '88.10', '705724.51', '705812.61', '1499396767', '大发时时彩第20170707333期-前二组选复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1410', 'P1707071102210', '8021', 'abc123', 'reward', '返奖', '196.00', '705812.61', '706008.61', '1499396767', '大发时时彩第20170707333期-前二跨度');
INSERT INTO `caipiao_fuddetail` VALUES ('1411', 'P1707071102210', '8021', 'abc123', 'reward', '返奖', '192.00', '706008.61', '706200.61', '1499396767', '大发时时彩第20170707333期-前二直选和值');
INSERT INTO `caipiao_fuddetail` VALUES ('1412', 'Q1707071102212', '8021', 'abc123', 'reward', '返奖', '192.00', '706200.61', '706392.61', '1499396767', '大发时时彩第20170707333期-前二直选复式');
INSERT INTO `caipiao_fuddetail` VALUES ('1413', 'LZF1707072042457964', '8067', 'abc123', 'activity_cz', '充值活动', '50000000.00', '0.00', '50000000.00', '1499431365', '手动充值增加');
INSERT INTO `caipiao_fuddetail` VALUES ('1414', 'O1707072043076', '8067', 'abc123', 'order', '代购', '200000.00', '50000000.00', '49800000.00', '1499431387', '投注扣费，彩种:重庆时时彩,20170707089');
INSERT INTO `caipiao_fuddetail` VALUES ('1415', 'DHG1707081303212793', '8070', 'abc123t01', 'activity_cz', '充值活动', '50000000.00', '0.00', '50000000.00', '1499490201', '手动充值增加');
INSERT INTO `caipiao_fuddetail` VALUES ('1416', 'R1707081303448', '8070', 'abc123t01', 'order', '代购', '200000.00', '50000000.00', '49800000.00', '1499490224', '投注扣费，彩种:重庆时时彩,20170708045');

-- ----------------------------
-- Table structure for `caipiao_gonggao`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_gonggao`;
CREATE TABLE `caipiao_gonggao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `oddtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_gonggao
-- ----------------------------
INSERT INTO `caipiao_gonggao` VALUES ('2', '最新资讯--充值多样化入款回馈中', '<span class=\"c-red\"></span>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\">福彩快三网&nbsp; 拥有多元化充值接口&nbsp; 每天首冲--》》》充值赠送中！！！</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<br />\r\n<span style=\"font-size:16px;\"> 快3网支持 第三方在线充值，微信快捷支付，公司入款，支付宝支付等，福彩中心持有银联支付宝微信等合法执照，会员均可放心支付！</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\">一.【第三方支付】 第三方在线支付，会员只需网上自己操作完成，充值完成账户自动到帐。</span><br />\r\n<span style=\"font-size:16px;\"> </span><br />\r\n<span style=\"font-size:16px;\"> 1.【充值未到账】会员充值1-3分钟未到账，请您点击在线客服进行咨询！</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\"> </span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\">二.【微信快捷支付】 微信支付，需要客户添加官方微信，通过转账方式进行充值。</span><br />\r\n<span style=\"font-size:16px;\"> </span><br />\r\n<span style=\"font-size:16px;\"> 1.【微信备注】:会员每次通过微信转账之前请务必核对微信账户是否变动，如果会员没有核对微信帐号进行支付，支付不到账等福彩中心一律无法为您更新额度！</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\"> 2.会员充值1-3分钟未到账，请您点击在线客服进行咨询！</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\"> </span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\">三.【公司入款】 会员在入款之前务必核对入款账户及开户详细信息，支付同时记得（附言信息复制到支付信息栏中).附言类如（98587）。信息填写完整以便客服第一时间为您添加额度！</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\"> 1.会员充值1-3分钟未到账，请您点击在线客服进行咨询！</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\"> </span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\">四.【支付宝支付】 会员通过支付宝进行支付的订单，每次会员支付之前务必进行支付宝帐号核对，公司不定时更改支付宝收款账户。以便您的支付及时到帐！</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\"> 1.会员充值1-3分钟未到账，请您点击在线客服进行咨询！</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\"> </span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\">五.每天首冲优惠活动声明: 福彩快3网为了感谢新老客户的支持，特此推出每天第一笔充值赠送活动，赠送相对比例可到赠送优惠活动中查看详情。</span> \r\n</p>\r\n<p style=\"color:#333333;\">\r\n	<span style=\"font-size:16px;\"> 1.备注:首冲赠送需要会员自己到首冲优惠中领取，当天有效，超过时间视为自动放弃！</span> \r\n</p>', '1480803677');

-- ----------------------------
-- Table structure for `caipiao_jinjijiangli`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_jinjijiangli`;
CREATE TABLE `caipiao_jinjijiangli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trano` char(60) NOT NULL COMMENT '//流水号',
  `listorder` smallint(6) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `addtime` int(11) NOT NULL,
  `uid` mediumtext NOT NULL COMMENT '会员ID',
  `username` char(20) NOT NULL COMMENT '会员名称',
  `groupid` mediumtext NOT NULL COMMENT '会员组ID',
  `beforegroupname` varchar(20) DEFAULT NULL COMMENT '//晋级前等级',
  `groupname` varchar(20) NOT NULL COMMENT '会员组名称',
  `jlje` decimal(10,0) NOT NULL COMMENT '晋级奖励金额',
  `point` float NOT NULL COMMENT '积晋级时积分',
  `oddtime` int(11) NOT NULL COMMENT '奖励时间',
  `shenhe` tinyint(4) NOT NULL COMMENT '审核',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_jinjijiangli
-- ----------------------------
INSERT INTO `caipiao_jinjijiangli` VALUES ('19', 'A1706291540015037', '0', '1', '0', '8023', 'abc123t2', '5', 'VIP1', 'VIP5', '74', '21000', '1498722001', '1');
INSERT INTO `caipiao_jinjijiangli` VALUES ('14', 'C1706180100255809', '0', '1', '0', '8020', 'zggcdyz', '6', '青铜会员', 'VIP6', '318', '61125', '1497718825', '1');

-- ----------------------------
-- Table structure for `caipiao_kaijiang`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_kaijiang`;
CREATE TABLE `caipiao_kaijiang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addtime` int(11) NOT NULL,
  `name` char(30) NOT NULL COMMENT '彩票标识',
  `title` varchar(30) NOT NULL COMMENT '彩票名称',
  `opencode` char(180) NOT NULL COMMENT '开奖号码',
  `sourcecode` char(255) NOT NULL,
  `remarks` char(255) NOT NULL COMMENT '第三方快乐彩结果',
  `expect` char(60) NOT NULL COMMENT '期号',
  `opentime` int(11) NOT NULL COMMENT '开奖时间',
  `isdraw` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未开奖 1开奖',
  `source` varchar(30) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `isdraw` (`isdraw`),
  KEY `expect` (`expect`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='开奖管理';

-- ----------------------------
-- Records of caipiao_kaijiang
-- ----------------------------
INSERT INTO `caipiao_kaijiang` VALUES ('1', '1499412115', 'dfssc', '大发时时彩', '0,1,4,7,8', '', '', '20170707392', '1499410920', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('2', '1499412115', 'dfssc', '大发时时彩', '2,3,6,7,9', '', '', '20170707393', '1499410980', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('3', '1499412115', 'dfssc', '大发时时彩', '3,5,5,5,9', '', '', '20170707394', '1499411040', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('4', '1499412115', 'dfssc', '大发时时彩', '0,2,7,7,8', '', '', '20170707395', '1499411100', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('5', '1499412115', 'dfssc', '大发时时彩', '1,2,3,7,8', '', '', '20170707396', '1499411160', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('6', '1499412115', 'dfssc', '大发时时彩', '1,2,3,6,8', '', '', '20170707397', '1499411220', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('7', '1499412115', 'dfssc', '大发时时彩', '0,1,3,6,8', '', '', '20170707398', '1499411280', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('8', '1499412115', 'dfssc', '大发时时彩', '0,1,3,4,6', '', '', '20170707399', '1499411340', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('9', '1499412115', 'dfssc', '大发时时彩', '4,4,5,9,9', '', '', '20170707400', '1499411400', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('10', '1499412115', 'dfssc', '大发时时彩', '1,5,5,6,9', '', '', '20170707401', '1499411460', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('11', '1499412115', 'dfssc', '大发时时彩', '1,3,3,6,9', '', '', '20170707402', '1499411520', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('12', '1499412115', 'dfssc', '大发时时彩', '1,3,3,5,5', '', '', '20170707403', '1499411580', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('13', '1499412115', 'dfssc', '大发时时彩', '2,7,9,9,9', '', '', '20170707404', '1499411640', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('14', '1499412115', 'dfssc', '大发时时彩', '0,0,1,3,4', '', '', '20170707405', '1499411700', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('15', '1499412115', 'dfssc', '大发时时彩', '1,1,2,8,9', '', '', '20170707406', '1499411760', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('16', '1499412115', 'dfssc', '大发时时彩', '0,1,3,3,6', '', '', '20170707407', '1499411820', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('17', '1499412115', 'dfssc', '大发时时彩', '0,3,5,8,9', '', '', '20170707408', '1499411880', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('18', '1499412115', 'dfssc', '大发时时彩', '2,2,4,7,9', '', '', '20170707409', '1499411940', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('19', '1499412115', 'dfssc', '大发时时彩', '0,8,8,9,9', '', '', '20170707410', '1499412000', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('20', '1499412115', 'dfssc', '大发时时彩', '0,5,5,7,9', '', '', '20170707411', '1499412060', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('21', '1499412122', 'dfssc', '大发时时彩', '0,1,5,6,7', '', '', '20170707412', '1499412120', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('22', '1499412182', 'dfssc', '大发时时彩', '3,4,4,7,8', '', '', '20170707413', '1499412180', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('23', '1499412242', 'dfssc', '大发时时彩', '3,5,6,8,8', '', '', '20170707414', '1499412240', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('24', '1499412302', 'dfssc', '大发时时彩', '0,2,2,7,8', '', '', '20170707415', '1499412300', '0', '系统彩');
INSERT INTO `caipiao_kaijiang` VALUES ('25', '1499412362', 'dfssc', '大发时时彩', '1,6,7,7,8', '', '', '20170707416', '1499412360', '0', '系统彩');

-- ----------------------------
-- Table structure for `caipiao_kenolimitred`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_kenolimitred`;
CREATE TABLE `caipiao_kenolimitred` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `mixmoney` int(11) NOT NULL,
  `maxmoney` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_kenolimitred
-- ----------------------------

-- ----------------------------
-- Table structure for `caipiao_linebanklist`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_linebanklist`;
CREATE TABLE `caipiao_linebanklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bankname` varchar(60) NOT NULL COMMENT '银行名称',
  `accountname` varchar(30) NOT NULL COMMENT '开户姓名',
  `banknumber` char(22) NOT NULL COMMENT '开户卡号',
  `banklogo` char(120) NOT NULL COMMENT '银行logo',
  `listorder` smallint(6) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1开启 0关闭',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_linebanklist
-- ----------------------------
INSERT INTO `caipiao_linebanklist` VALUES ('1', '中国银行', '陈诚', '1234567891234567', 'jianshe.gif', '1', '1');
INSERT INTO `caipiao_linebanklist` VALUES ('2', '工商银行', '我想辞职算了', '1234567891234567', 'gongshang.gif', '2', '1');

-- ----------------------------
-- Table structure for `caipiao_member`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_member`;
CREATE TABLE `caipiao_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0' COMMENT '上线会员ID',
  `groupid` smallint(6) NOT NULL DEFAULT '1',
  `username` char(60) NOT NULL,
  `nickname` varchar(20) NOT NULL COMMENT '昵称',
  `proxy` tinyint(4) NOT NULL COMMENT '1代理 0普通',
  `isnb` tinyint(4) NOT NULL COMMENT '1内部会员 0正常',
  `email` char(60) NOT NULL,
  `phone` char(12) NOT NULL COMMENT '手机号码',
  `userbankname` varchar(30) NOT NULL COMMENT '银行真实姓名',
  `password` char(32) NOT NULL,
  `tradepassword` char(32) NOT NULL COMMENT '资金密码',
  `sex` tinyint(3) DEFAULT '1' COMMENT '//性别',
  `balance` decimal(14,2) NOT NULL COMMENT '金额',
  `point` int(14) NOT NULL DEFAULT '0' COMMENT '积分',
  `xima` decimal(14,2) NOT NULL COMMENT '洗码余额 0可提现',
  `fandian` decimal(6,1) NOT NULL DEFAULT '12.0' COMMENT '会员通用返点',
  `tel` char(20) NOT NULL,
  `face` varchar(255) DEFAULT NULL,
  `qq` char(20) NOT NULL,
  `loginip` char(20) NOT NULL,
  `iparea` char(20) NOT NULL,
  `regtime` int(11) NOT NULL COMMENT '注册时间',
  `regip` char(20) NOT NULL COMMENT '注册IP',
  `source` varchar(30) NOT NULL COMMENT '注册来源',
  `logintime` int(11) NOT NULL,
  `loginsource` char(20) NOT NULL COMMENT 'pc,mobile',
  `onlinetime` int(11) NOT NULL COMMENT '最后在线时间',
  `islock` tinyint(1) NOT NULL DEFAULT '0',
  `birthday` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`),
  KEY `onlinetime` (`onlinetime`),
  KEY `isnb` (`isnb`),
  KEY `proxy` (`proxy`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=8071 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_member
-- ----------------------------
INSERT INTO `caipiao_member` VALUES ('8000', '0', '6', 'admin', '', '1', '1', '', '', '', 'e313736de2d8623a4abcfd97785a8ea6', 'e313736de2d8623a4abcfd97785a8ea6', '1', '0.00', '0', '0.00', '12.0', '', null, '', '', '', '1488520773', '', '', '0', '', '0', '0', '0000-00-00');
INSERT INTO `caipiao_member` VALUES ('8067', '0', '10', 'abc123', '', '1', '0', '', '', '', 'd93a5def7511da3d0f2d171d9c344e91', 'bdd7aa3440c5d4bb95127588721f7bad', '1', '49800000.00', '50000000', '0.00', '7.5', '', '/resources/images/face/4.jpg', '', '127.0.0.1', '本机地址', '1499430833', '', '', '1499846384', 'pc', '1499847624', '0', '0000-00-00');
INSERT INTO `caipiao_member` VALUES ('8068', '8067', '10', 'abc123t1', '', '1', '0', '', '', '', 'd93a5def7511da3d0f2d171d9c344e91', 'bdd7aa3440c5d4bb95127588721f7bad', '1', '0.00', '0', '0.00', '7.4', '', '/resources/images/face/2.jpg', '', '127.0.0.1', '本机地址', '1499430900', '127.0.0.1', '代理开户', '1499733406', 'pc', '1499745837', '0', '0000-00-00');
INSERT INTO `caipiao_member` VALUES ('8069', '8067', '10', 'abc123t2', '', '1', '0', '', '', '', 'd93a5def7511da3d0f2d171d9c344e91', '', '1', '0.00', '0', '0.00', '7.4', '', '/resources/images/face/19.jpg', '', '', '', '1499430952', '127.0.0.1', '代理开户', '0', '', '0', '0', '0000-00-00');
INSERT INTO `caipiao_member` VALUES ('8070', '8068', '1', 'abc123t01', '', '0', '0', '', '', '', 'd93a5def7511da3d0f2d171d9c344e91', 'bdd7aa3440c5d4bb95127588721f7bad', '1', '49800000.00', '50000000', '0.00', '0.0', '', '/resources/images/face/11.jpg', '123456', '127.0.0.1', '本机地址', '1499489767', '127.0.0.1', '代理开户', '1499831391', 'pc', '1499831413', '0', '0000-00-00');

-- ----------------------------
-- Table structure for `caipiao_membergroup`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_membergroup`;
CREATE TABLE `caipiao_membergroup` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `listorder` smallint(6) NOT NULL,
  `groupstatus` tinyint(4) NOT NULL DEFAULT '1',
  `addtime` int(11) NOT NULL,
  `groupname` char(80) NOT NULL,
  `isagent` tinyint(4) NOT NULL COMMENT '是否代理',
  `isdefautreg` tinyint(4) NOT NULL COMMENT '注册默认',
  `lowest` smallint(6) NOT NULL DEFAULT '2' COMMENT '最低投注',
  `highest` int(11) NOT NULL COMMENT '最高投注',
  `fanshui` char(255) NOT NULL COMMENT '0.1 ==返水0.1%',
  `touhan` char(20) NOT NULL COMMENT '头衔',
  `shengjiedu` char(30) NOT NULL COMMENT '输额度 | 隔开',
  `rifanyonglv` char(255) NOT NULL COMMENT '日返佣：今天领昨天的；下线会员打码总额：10000-100000|1%； 多个记录使用 "#" 隔开',
  `yuefanyonglv` char(255) NOT NULL COMMENT '月返佣：当月领上月的；下线会员打码总额：10000-100000|1%； 多个记录使用 "#" 隔开',
  `jjje` float NOT NULL COMMENT '晋级金额',
  `tiaoji` float NOT NULL COMMENT '跳级奖励',
  `configs` longtext NOT NULL,
  `level` smallint(6) NOT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_membergroup
-- ----------------------------
INSERT INTO `caipiao_membergroup` VALUES ('1', '0', '1', '1456912144', 'VIP1', '0', '1', '2', '10000', '100-2000|0.1;2000-10000|0.2;10000-200000|0.3', '农民', '0', '0', '', '0', '0', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('4', '3', '1', '1456974912', 'VIP4', '0', '0', '2', '0', '100-2000|0.4;2000-10000|0.5;10000-200000|0.6', '通判', '1000', '0', '', '10', '16', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('7', '6', '1', '1469113035', 'VIP7', '0', '0', '2', '0', '100-2000|0.7;2000-10000|0.8;10000-200000|0.9', '巡抚', '250000', '0', '', '1688', '2080', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('9', '8', '1', '1469113237', 'VIP9', '0', '0', '2', '0', '100-2000|1.1;2000-10000|1.2;10000-200000|1.3', '帝王', '5000000', '0', '', '38888', '47856', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('10', '9', '1', '1469113531', '普通代理', '1', '1', '2', '0', '100-2000|1;2000-10000|2;10000-200000|3', '', '申请', '100-2000|0.8;2000-10000|1.2;10000-100000|1.5', '100-2000|0.8;2000-10000|1.2;100-100000|1.5', '0', '0', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('11', '10', '1', '1469113550', '普通代理', '1', '0', '2', '0', '100-2000|1;2000-10000|2;10000-200000|3', '', '申请', '100-2000|1;2000-10000|1.4;10000-100000|1.8', '100-2000|1;2000-10000|1.4;100-100000|1.8', '0', '0', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('2', '1', '1', '1492393617', 'VIP2', '0', '0', '2', '0', '100-2000|0.2;2000-10000|0.3;10000-200000|0.4', '地主', '10', '0', '', '1', '1', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('3', '2', '1', '1492393701', 'VIP3', '0', '0', '2', '0', '100-2000|0.3;2000-10000|0.4;10000-200000|0.5', '知县', '200', '0', '', '5', '6', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('8', '7', '1', '1492394070', 'VIP8', '0', '0', '2', '0', '100-2000|0.8;2000-10000|0.9;10000-200000|1', '丞相', '1000000', '0', '', '6888', '8968', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('5', '4', '1', '1492395106', 'VIP5', '0', '0', '2', '0', '100-2000|0.5;2000-10000|0.6;10000-200000|0.7', '知府', '10000', '0', '', '58', '74', '', '0');
INSERT INTO `caipiao_membergroup` VALUES ('6', '5', '1', '1492395119', 'VIP6', '0', '0', '2', '0', '100-2000|0.6;2000-10000|0.7;10000-200000|0.8', '总督', '50000', '0', '', '318', '392', '', '0');

-- ----------------------------
-- Table structure for `caipiao_memberlog`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_memberlog`;
CREATE TABLE `caipiao_memberlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `username` char(60) NOT NULL,
  `type` char(20) NOT NULL COMMENT 'login 登入，logout 登出，withdraw提款',
  `info` varchar(60) NOT NULL,
  `ip` char(20) NOT NULL,
  `iparea` varchar(60) NOT NULL COMMENT 'ip地区',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=605 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_memberlog
-- ----------------------------
INSERT INTO `caipiao_memberlog` VALUES ('1', '8001', 'cesshi111', 'login', '注册/登陆', '115.164.221.173', '马来西亚', '1488538435');
INSERT INTO `caipiao_memberlog` VALUES ('2', '8002', 'hjjfukfu', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1493174672');
INSERT INTO `caipiao_memberlog` VALUES ('3', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1493175066');
INSERT INTO `caipiao_memberlog` VALUES ('4', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1493175087');
INSERT INTO `caipiao_memberlog` VALUES ('5', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1493176822');
INSERT INTO `caipiao_memberlog` VALUES ('6', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1493178714');
INSERT INTO `caipiao_memberlog` VALUES ('7', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1493178922');
INSERT INTO `caipiao_memberlog` VALUES ('8', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1493186728');
INSERT INTO `caipiao_memberlog` VALUES ('9', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1493187125');
INSERT INTO `caipiao_memberlog` VALUES ('10', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1493187812');
INSERT INTO `caipiao_memberlog` VALUES ('11', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1493189078');
INSERT INTO `caipiao_memberlog` VALUES ('12', '8003', 'zggcdyz', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1493192640');
INSERT INTO `caipiao_memberlog` VALUES ('13', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1493194604');
INSERT INTO `caipiao_memberlog` VALUES ('14', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1493194971');
INSERT INTO `caipiao_memberlog` VALUES ('15', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1493195582');
INSERT INTO `caipiao_memberlog` VALUES ('16', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1493195956');
INSERT INTO `caipiao_memberlog` VALUES ('17', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494237569');
INSERT INTO `caipiao_memberlog` VALUES ('18', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494237931');
INSERT INTO `caipiao_memberlog` VALUES ('19', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494238003');
INSERT INTO `caipiao_memberlog` VALUES ('20', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494238036');
INSERT INTO `caipiao_memberlog` VALUES ('21', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494238174');
INSERT INTO `caipiao_memberlog` VALUES ('22', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494238927');
INSERT INTO `caipiao_memberlog` VALUES ('23', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494246568');
INSERT INTO `caipiao_memberlog` VALUES ('24', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494290834');
INSERT INTO `caipiao_memberlog` VALUES ('25', '8012', 'zggcdyz3', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1494291370');
INSERT INTO `caipiao_memberlog` VALUES ('26', '8013', 'zggcdyz4', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1494291672');
INSERT INTO `caipiao_memberlog` VALUES ('27', '8014', 'y123456', 'login', '注册/登陆', '192.168.0.105', '局域网', '1494291903');
INSERT INTO `caipiao_memberlog` VALUES ('28', '8015', 's2343', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1494292275');
INSERT INTO `caipiao_memberlog` VALUES ('29', '8016', 's4123', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1494292369');
INSERT INTO `caipiao_memberlog` VALUES ('30', '8017', 'y123456', 'login', '注册/登陆', '192.168.0.105', '局域网', '1494292485');
INSERT INTO `caipiao_memberlog` VALUES ('31', '8018', 's123456', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1494292517');
INSERT INTO `caipiao_memberlog` VALUES ('32', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494292914');
INSERT INTO `caipiao_memberlog` VALUES ('33', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494295813');
INSERT INTO `caipiao_memberlog` VALUES ('34', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494299365');
INSERT INTO `caipiao_memberlog` VALUES ('35', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494302005');
INSERT INTO `caipiao_memberlog` VALUES ('36', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494302706');
INSERT INTO `caipiao_memberlog` VALUES ('37', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494310032');
INSERT INTO `caipiao_memberlog` VALUES ('38', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494310187');
INSERT INTO `caipiao_memberlog` VALUES ('39', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494310274');
INSERT INTO `caipiao_memberlog` VALUES ('40', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1494316298');
INSERT INTO `caipiao_memberlog` VALUES ('41', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494322377');
INSERT INTO `caipiao_memberlog` VALUES ('42', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494322667');
INSERT INTO `caipiao_memberlog` VALUES ('43', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494324268');
INSERT INTO `caipiao_memberlog` VALUES ('44', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494324569');
INSERT INTO `caipiao_memberlog` VALUES ('45', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1494328321');
INSERT INTO `caipiao_memberlog` VALUES ('46', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1494328423');
INSERT INTO `caipiao_memberlog` VALUES ('47', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494328816');
INSERT INTO `caipiao_memberlog` VALUES ('48', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494328865');
INSERT INTO `caipiao_memberlog` VALUES ('49', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494375535');
INSERT INTO `caipiao_memberlog` VALUES ('50', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494376110');
INSERT INTO `caipiao_memberlog` VALUES ('51', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494376737');
INSERT INTO `caipiao_memberlog` VALUES ('52', '8019', 'zggcdyz', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1494378264');
INSERT INTO `caipiao_memberlog` VALUES ('53', '8020', 'zggcdyz', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1494379509');
INSERT INTO `caipiao_memberlog` VALUES ('54', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494380061');
INSERT INTO `caipiao_memberlog` VALUES ('55', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494380216');
INSERT INTO `caipiao_memberlog` VALUES ('56', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494380236');
INSERT INTO `caipiao_memberlog` VALUES ('57', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494380517');
INSERT INTO `caipiao_memberlog` VALUES ('58', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494382955');
INSERT INTO `caipiao_memberlog` VALUES ('59', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494396200');
INSERT INTO `caipiao_memberlog` VALUES ('60', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494396707');
INSERT INTO `caipiao_memberlog` VALUES ('61', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494404299');
INSERT INTO `caipiao_memberlog` VALUES ('62', '8002', 'hjjfukfu', 'login', '登录成功', '127.0.0.1', '本机地址', '1494409843');
INSERT INTO `caipiao_memberlog` VALUES ('63', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494409974');
INSERT INTO `caipiao_memberlog` VALUES ('64', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494461436');
INSERT INTO `caipiao_memberlog` VALUES ('65', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494462960');
INSERT INTO `caipiao_memberlog` VALUES ('66', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494463194');
INSERT INTO `caipiao_memberlog` VALUES ('67', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494464346');
INSERT INTO `caipiao_memberlog` VALUES ('68', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494465129');
INSERT INTO `caipiao_memberlog` VALUES ('69', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494467473');
INSERT INTO `caipiao_memberlog` VALUES ('70', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494467474');
INSERT INTO `caipiao_memberlog` VALUES ('71', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494467474');
INSERT INTO `caipiao_memberlog` VALUES ('72', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494469994');
INSERT INTO `caipiao_memberlog` VALUES ('73', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494470915');
INSERT INTO `caipiao_memberlog` VALUES ('74', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494472107');
INSERT INTO `caipiao_memberlog` VALUES ('75', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494473797');
INSERT INTO `caipiao_memberlog` VALUES ('76', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494482892');
INSERT INTO `caipiao_memberlog` VALUES ('77', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494550783');
INSERT INTO `caipiao_memberlog` VALUES ('78', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494550823');
INSERT INTO `caipiao_memberlog` VALUES ('79', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494559009');
INSERT INTO `caipiao_memberlog` VALUES ('80', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494568403');
INSERT INTO `caipiao_memberlog` VALUES ('81', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494580498');
INSERT INTO `caipiao_memberlog` VALUES ('82', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1494581553');
INSERT INTO `caipiao_memberlog` VALUES ('83', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494591991');
INSERT INTO `caipiao_memberlog` VALUES ('84', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494593354');
INSERT INTO `caipiao_memberlog` VALUES ('85', '0', 'zggcdyz', 'withdraw', 'PC端 提款操作，金额:100,提款单号:AGD1705122112305679', '127.0.0.1', '本机地址', '1494594750');
INSERT INTO `caipiao_memberlog` VALUES ('86', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494636541');
INSERT INTO `caipiao_memberlog` VALUES ('87', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494636770');
INSERT INTO `caipiao_memberlog` VALUES ('88', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1494638859');
INSERT INTO `caipiao_memberlog` VALUES ('89', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494639196');
INSERT INTO `caipiao_memberlog` VALUES ('90', '0', 'y123456', 'withdraw', 'PC端 提款操作，金额:100,提款单号:XER1705130934002758', '192.168.0.104', '局域网', '1494639240');
INSERT INTO `caipiao_memberlog` VALUES ('91', '0', 'y123456', 'withdraw', 'PC端 提款操作，金额:100,提款单号:VUG1705130934394261', '192.168.0.104', '局域网', '1494639279');
INSERT INTO `caipiao_memberlog` VALUES ('92', '0', 'y123456', 'withdraw', 'PC端 提款操作，金额:100,提款单号:UGT1705130934470009', '192.168.0.104', '局域网', '1494639287');
INSERT INTO `caipiao_memberlog` VALUES ('93', '0', 'y123456', 'withdraw', 'PC端 提款操作，金额:100,提款单号:ISD1705130936545990', '192.168.0.104', '局域网', '1494639414');
INSERT INTO `caipiao_memberlog` VALUES ('94', '0', 'y123456', 'withdraw', 'PC端 提款操作，金额:100,提款单号:ETR1705130939250981', '192.168.0.104', '局域网', '1494639565');
INSERT INTO `caipiao_memberlog` VALUES ('95', '0', 'y123456', 'withdraw', 'PC端 提款操作，金额:100,提款单号:MGH1705130939385751', '192.168.0.104', '局域网', '1494639578');
INSERT INTO `caipiao_memberlog` VALUES ('96', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494642058');
INSERT INTO `caipiao_memberlog` VALUES ('97', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494645365');
INSERT INTO `caipiao_memberlog` VALUES ('98', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494647815');
INSERT INTO `caipiao_memberlog` VALUES ('99', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494655349');
INSERT INTO `caipiao_memberlog` VALUES ('100', '8017', 'y123456', 'login', '登录成功', '192.168.0.100', '局域网', '1494655414');
INSERT INTO `caipiao_memberlog` VALUES ('101', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494658591');
INSERT INTO `caipiao_memberlog` VALUES ('102', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494660050');
INSERT INTO `caipiao_memberlog` VALUES ('103', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494661304');
INSERT INTO `caipiao_memberlog` VALUES ('104', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494724653');
INSERT INTO `caipiao_memberlog` VALUES ('105', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494724749');
INSERT INTO `caipiao_memberlog` VALUES ('106', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494746047');
INSERT INTO `caipiao_memberlog` VALUES ('107', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494750630');
INSERT INTO `caipiao_memberlog` VALUES ('108', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1494809913');
INSERT INTO `caipiao_memberlog` VALUES ('109', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494828421');
INSERT INTO `caipiao_memberlog` VALUES ('110', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494829759');
INSERT INTO `caipiao_memberlog` VALUES ('111', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494830433');
INSERT INTO `caipiao_memberlog` VALUES ('112', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494830536');
INSERT INTO `caipiao_memberlog` VALUES ('113', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494830631');
INSERT INTO `caipiao_memberlog` VALUES ('114', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494830679');
INSERT INTO `caipiao_memberlog` VALUES ('115', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494830752');
INSERT INTO `caipiao_memberlog` VALUES ('116', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1494830825');
INSERT INTO `caipiao_memberlog` VALUES ('117', '8025', 'abc111', 'login', '登录成功', '127.0.0.1', '本机地址', '1494830986');
INSERT INTO `caipiao_memberlog` VALUES ('118', '8025', 'abc111', 'login', '登录成功', '127.0.0.1', '本机地址', '1494832413');
INSERT INTO `caipiao_memberlog` VALUES ('119', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1494832550');
INSERT INTO `caipiao_memberlog` VALUES ('120', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1494832714');
INSERT INTO `caipiao_memberlog` VALUES ('121', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1494833395');
INSERT INTO `caipiao_memberlog` VALUES ('122', '8028', 'a111', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1494921633');
INSERT INTO `caipiao_memberlog` VALUES ('123', '8029', 'a112', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1494921672');
INSERT INTO `caipiao_memberlog` VALUES ('124', '8030', 'a113', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1494922039');
INSERT INTO `caipiao_memberlog` VALUES ('125', '8031', 'a1114', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1494923028');
INSERT INTO `caipiao_memberlog` VALUES ('126', '8032', 'a115', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1494923105');
INSERT INTO `caipiao_memberlog` VALUES ('127', '8033', 'a116', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1494923158');
INSERT INTO `caipiao_memberlog` VALUES ('128', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494926841');
INSERT INTO `caipiao_memberlog` VALUES ('129', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494927661');
INSERT INTO `caipiao_memberlog` VALUES ('130', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494940429');
INSERT INTO `caipiao_memberlog` VALUES ('131', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1494941545');
INSERT INTO `caipiao_memberlog` VALUES ('132', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494982608');
INSERT INTO `caipiao_memberlog` VALUES ('133', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494985889');
INSERT INTO `caipiao_memberlog` VALUES ('134', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494987210');
INSERT INTO `caipiao_memberlog` VALUES ('135', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1494988516');
INSERT INTO `caipiao_memberlog` VALUES ('136', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1494990926');
INSERT INTO `caipiao_memberlog` VALUES ('137', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1494991125');
INSERT INTO `caipiao_memberlog` VALUES ('138', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1494991183');
INSERT INTO `caipiao_memberlog` VALUES ('139', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1494993421');
INSERT INTO `caipiao_memberlog` VALUES ('140', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1495001173');
INSERT INTO `caipiao_memberlog` VALUES ('141', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495001483');
INSERT INTO `caipiao_memberlog` VALUES ('142', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495004909');
INSERT INTO `caipiao_memberlog` VALUES ('143', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1495005148');
INSERT INTO `caipiao_memberlog` VALUES ('144', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1495005187');
INSERT INTO `caipiao_memberlog` VALUES ('145', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1495005242');
INSERT INTO `caipiao_memberlog` VALUES ('146', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495005270');
INSERT INTO `caipiao_memberlog` VALUES ('147', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1495005347');
INSERT INTO `caipiao_memberlog` VALUES ('148', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495005351');
INSERT INTO `caipiao_memberlog` VALUES ('149', '8020', 'zggcdyz', 'login', '登录成功', '192.168.0.105', '局域网', '1495005441');
INSERT INTO `caipiao_memberlog` VALUES ('150', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1495005488');
INSERT INTO `caipiao_memberlog` VALUES ('151', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495005671');
INSERT INTO `caipiao_memberlog` VALUES ('152', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1495006138');
INSERT INTO `caipiao_memberlog` VALUES ('153', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495006727');
INSERT INTO `caipiao_memberlog` VALUES ('154', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495007242');
INSERT INTO `caipiao_memberlog` VALUES ('155', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495007330');
INSERT INTO `caipiao_memberlog` VALUES ('156', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495007452');
INSERT INTO `caipiao_memberlog` VALUES ('157', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495007562');
INSERT INTO `caipiao_memberlog` VALUES ('158', '0', 'zggcdyz', 'withdraw', 'PC端 提款操作，金额:100,提款单号:JVE1705171604215836', '127.0.0.1', '本机地址', '1495008261');
INSERT INTO `caipiao_memberlog` VALUES ('159', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1495011451');
INSERT INTO `caipiao_memberlog` VALUES ('160', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495012040');
INSERT INTO `caipiao_memberlog` VALUES ('161', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495012213');
INSERT INTO `caipiao_memberlog` VALUES ('162', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495014845');
INSERT INTO `caipiao_memberlog` VALUES ('163', '8017', 'y123456', 'login', '登录成功', '192.168.0.105', '局域网', '1495014847');
INSERT INTO `caipiao_memberlog` VALUES ('164', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495070313');
INSERT INTO `caipiao_memberlog` VALUES ('165', '8017', 'y123456', 'login', '登录成功', '192.168.0.106', '局域网', '1495070464');
INSERT INTO `caipiao_memberlog` VALUES ('166', '8017', 'y123456', 'login', '登录成功', '192.168.0.106', '局域网', '1495070465');
INSERT INTO `caipiao_memberlog` VALUES ('167', '8017', 'y123456', 'login', '登录成功', '192.168.0.107', '局域网', '1495072193');
INSERT INTO `caipiao_memberlog` VALUES ('168', '8017', 'y123456', 'login', '登录成功', '192.168.0.106', '局域网', '1495072629');
INSERT INTO `caipiao_memberlog` VALUES ('169', '8017', 'y123456', 'login', '登录成功', '192.168.0.107', '局域网', '1495072990');
INSERT INTO `caipiao_memberlog` VALUES ('170', '8020', 'zggcdyz', 'login', '登录成功', '192.168.0.104', '局域网', '1495073213');
INSERT INTO `caipiao_memberlog` VALUES ('171', '8017', 'y123456', 'login', '登录成功', '192.168.0.106', '局域网', '1495073252');
INSERT INTO `caipiao_memberlog` VALUES ('172', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495073481');
INSERT INTO `caipiao_memberlog` VALUES ('173', '8025', 'abc111', 'login', '登录成功', '127.0.0.1', '本机地址', '1495077324');
INSERT INTO `caipiao_memberlog` VALUES ('174', '8028', 'a111', 'login', '登录成功', '127.0.0.1', '本机地址', '1495077405');
INSERT INTO `caipiao_memberlog` VALUES ('175', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495078703');
INSERT INTO `caipiao_memberlog` VALUES ('176', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495165428');
INSERT INTO `caipiao_memberlog` VALUES ('177', '8017', 'y123456', 'login', '登录成功', '192.168.0.106', '局域网', '1495165443');
INSERT INTO `caipiao_memberlog` VALUES ('178', '8017', 'y123456', 'login', '登录成功', '192.168.0.106', '局域网', '1495173836');
INSERT INTO `caipiao_memberlog` VALUES ('179', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495174427');
INSERT INTO `caipiao_memberlog` VALUES ('180', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495175029');
INSERT INTO `caipiao_memberlog` VALUES ('181', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495175866');
INSERT INTO `caipiao_memberlog` VALUES ('182', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495175975');
INSERT INTO `caipiao_memberlog` VALUES ('183', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495209516');
INSERT INTO `caipiao_memberlog` VALUES ('184', '8017', 'y123456', 'login', '登录成功', '192.168.0.106', '局域网', '1495209997');
INSERT INTO `caipiao_memberlog` VALUES ('185', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495384907');
INSERT INTO `caipiao_memberlog` VALUES ('186', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495098024');
INSERT INTO `caipiao_memberlog` VALUES ('187', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495099028');
INSERT INTO `caipiao_memberlog` VALUES ('188', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495099177');
INSERT INTO `caipiao_memberlog` VALUES ('189', '8020', 'zggcdyz', 'login', '登录成功', '127.0.0.1', '本机地址', '1495107620');
INSERT INTO `caipiao_memberlog` VALUES ('190', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495109376');
INSERT INTO `caipiao_memberlog` VALUES ('191', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495111268');
INSERT INTO `caipiao_memberlog` VALUES ('192', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495156612');
INSERT INTO `caipiao_memberlog` VALUES ('193', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495157733');
INSERT INTO `caipiao_memberlog` VALUES ('194', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495160195');
INSERT INTO `caipiao_memberlog` VALUES ('195', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495162657');
INSERT INTO `caipiao_memberlog` VALUES ('196', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495164343');
INSERT INTO `caipiao_memberlog` VALUES ('197', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495186409');
INSERT INTO `caipiao_memberlog` VALUES ('198', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495244350');
INSERT INTO `caipiao_memberlog` VALUES ('199', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495244394');
INSERT INTO `caipiao_memberlog` VALUES ('200', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495244496');
INSERT INTO `caipiao_memberlog` VALUES ('201', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1495245168');
INSERT INTO `caipiao_memberlog` VALUES ('202', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495245768');
INSERT INTO `caipiao_memberlog` VALUES ('203', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495245825');
INSERT INTO `caipiao_memberlog` VALUES ('204', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495246205');
INSERT INTO `caipiao_memberlog` VALUES ('205', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495246229');
INSERT INTO `caipiao_memberlog` VALUES ('206', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495247265');
INSERT INTO `caipiao_memberlog` VALUES ('207', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495247523');
INSERT INTO `caipiao_memberlog` VALUES ('208', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495247544');
INSERT INTO `caipiao_memberlog` VALUES ('209', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495247920');
INSERT INTO `caipiao_memberlog` VALUES ('210', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495247957');
INSERT INTO `caipiao_memberlog` VALUES ('211', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495247963');
INSERT INTO `caipiao_memberlog` VALUES ('212', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495248715');
INSERT INTO `caipiao_memberlog` VALUES ('213', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495248799');
INSERT INTO `caipiao_memberlog` VALUES ('214', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495248870');
INSERT INTO `caipiao_memberlog` VALUES ('215', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495248889');
INSERT INTO `caipiao_memberlog` VALUES ('216', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495248911');
INSERT INTO `caipiao_memberlog` VALUES ('217', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495248931');
INSERT INTO `caipiao_memberlog` VALUES ('218', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495248937');
INSERT INTO `caipiao_memberlog` VALUES ('219', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495248938');
INSERT INTO `caipiao_memberlog` VALUES ('220', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249267');
INSERT INTO `caipiao_memberlog` VALUES ('221', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249271');
INSERT INTO `caipiao_memberlog` VALUES ('222', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495249362');
INSERT INTO `caipiao_memberlog` VALUES ('223', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249378');
INSERT INTO `caipiao_memberlog` VALUES ('224', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249380');
INSERT INTO `caipiao_memberlog` VALUES ('225', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495249482');
INSERT INTO `caipiao_memberlog` VALUES ('226', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249494');
INSERT INTO `caipiao_memberlog` VALUES ('227', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249498');
INSERT INTO `caipiao_memberlog` VALUES ('228', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249501');
INSERT INTO `caipiao_memberlog` VALUES ('229', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495249573');
INSERT INTO `caipiao_memberlog` VALUES ('230', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249596');
INSERT INTO `caipiao_memberlog` VALUES ('231', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249600');
INSERT INTO `caipiao_memberlog` VALUES ('232', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495249744');
INSERT INTO `caipiao_memberlog` VALUES ('233', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249849');
INSERT INTO `caipiao_memberlog` VALUES ('234', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249852');
INSERT INTO `caipiao_memberlog` VALUES ('235', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495249887');
INSERT INTO `caipiao_memberlog` VALUES ('236', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249909');
INSERT INTO `caipiao_memberlog` VALUES ('237', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495249913');
INSERT INTO `caipiao_memberlog` VALUES ('238', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495250169');
INSERT INTO `caipiao_memberlog` VALUES ('239', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495250179');
INSERT INTO `caipiao_memberlog` VALUES ('240', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495250181');
INSERT INTO `caipiao_memberlog` VALUES ('241', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495250205');
INSERT INTO `caipiao_memberlog` VALUES ('242', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495250219');
INSERT INTO `caipiao_memberlog` VALUES ('243', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495250228');
INSERT INTO `caipiao_memberlog` VALUES ('244', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495252709');
INSERT INTO `caipiao_memberlog` VALUES ('245', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495252718');
INSERT INTO `caipiao_memberlog` VALUES ('246', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495252719');
INSERT INTO `caipiao_memberlog` VALUES ('247', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495252741');
INSERT INTO `caipiao_memberlog` VALUES ('248', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495252755');
INSERT INTO `caipiao_memberlog` VALUES ('249', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495252763');
INSERT INTO `caipiao_memberlog` VALUES ('250', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495252809');
INSERT INTO `caipiao_memberlog` VALUES ('251', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495252842');
INSERT INTO `caipiao_memberlog` VALUES ('252', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495252855');
INSERT INTO `caipiao_memberlog` VALUES ('253', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495252865');
INSERT INTO `caipiao_memberlog` VALUES ('254', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495252887');
INSERT INTO `caipiao_memberlog` VALUES ('255', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495261158');
INSERT INTO `caipiao_memberlog` VALUES ('256', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495261184');
INSERT INTO `caipiao_memberlog` VALUES ('257', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495261193');
INSERT INTO `caipiao_memberlog` VALUES ('258', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495261960');
INSERT INTO `caipiao_memberlog` VALUES ('259', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495262401');
INSERT INTO `caipiao_memberlog` VALUES ('260', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495262545');
INSERT INTO `caipiao_memberlog` VALUES ('261', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495262549');
INSERT INTO `caipiao_memberlog` VALUES ('262', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495262621');
INSERT INTO `caipiao_memberlog` VALUES ('263', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495262626');
INSERT INTO `caipiao_memberlog` VALUES ('264', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495262633');
INSERT INTO `caipiao_memberlog` VALUES ('265', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495262635');
INSERT INTO `caipiao_memberlog` VALUES ('266', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495262682');
INSERT INTO `caipiao_memberlog` VALUES ('267', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495262688');
INSERT INTO `caipiao_memberlog` VALUES ('268', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495262812');
INSERT INTO `caipiao_memberlog` VALUES ('269', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495262813');
INSERT INTO `caipiao_memberlog` VALUES ('270', '8017', 'y123456', 'login', '登录成功', '192.168.0.100', '局域网', '1495263222');
INSERT INTO `caipiao_memberlog` VALUES ('271', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263508');
INSERT INTO `caipiao_memberlog` VALUES ('272', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263521');
INSERT INTO `caipiao_memberlog` VALUES ('273', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263624');
INSERT INTO `caipiao_memberlog` VALUES ('274', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263625');
INSERT INTO `caipiao_memberlog` VALUES ('275', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263660');
INSERT INTO `caipiao_memberlog` VALUES ('276', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263663');
INSERT INTO `caipiao_memberlog` VALUES ('277', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263684');
INSERT INTO `caipiao_memberlog` VALUES ('278', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263698');
INSERT INTO `caipiao_memberlog` VALUES ('279', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263780');
INSERT INTO `caipiao_memberlog` VALUES ('280', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495263782');
INSERT INTO `caipiao_memberlog` VALUES ('281', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495264115');
INSERT INTO `caipiao_memberlog` VALUES ('282', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495264118');
INSERT INTO `caipiao_memberlog` VALUES ('283', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495264585');
INSERT INTO `caipiao_memberlog` VALUES ('284', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495265766');
INSERT INTO `caipiao_memberlog` VALUES ('285', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495265767');
INSERT INTO `caipiao_memberlog` VALUES ('286', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495266463');
INSERT INTO `caipiao_memberlog` VALUES ('287', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495267996');
INSERT INTO `caipiao_memberlog` VALUES ('288', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495268784');
INSERT INTO `caipiao_memberlog` VALUES ('289', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1495268786');
INSERT INTO `caipiao_memberlog` VALUES ('290', '8034', 'sdfsdf', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1495269086');
INSERT INTO `caipiao_memberlog` VALUES ('291', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495269175');
INSERT INTO `caipiao_memberlog` VALUES ('292', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495269176');
INSERT INTO `caipiao_memberlog` VALUES ('293', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495272289');
INSERT INTO `caipiao_memberlog` VALUES ('294', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495331955');
INSERT INTO `caipiao_memberlog` VALUES ('295', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495337642');
INSERT INTO `caipiao_memberlog` VALUES ('296', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495338636');
INSERT INTO `caipiao_memberlog` VALUES ('297', '8035', 'abc001', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1495373947');
INSERT INTO `caipiao_memberlog` VALUES ('298', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495374357');
INSERT INTO `caipiao_memberlog` VALUES ('299', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495374428');
INSERT INTO `caipiao_memberlog` VALUES ('300', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495375430');
INSERT INTO `caipiao_memberlog` VALUES ('301', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495375431');
INSERT INTO `caipiao_memberlog` VALUES ('302', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495379860');
INSERT INTO `caipiao_memberlog` VALUES ('303', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495379992');
INSERT INTO `caipiao_memberlog` VALUES ('304', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380067');
INSERT INTO `caipiao_memberlog` VALUES ('305', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380069');
INSERT INTO `caipiao_memberlog` VALUES ('306', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380202');
INSERT INTO `caipiao_memberlog` VALUES ('307', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380213');
INSERT INTO `caipiao_memberlog` VALUES ('308', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380216');
INSERT INTO `caipiao_memberlog` VALUES ('309', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380227');
INSERT INTO `caipiao_memberlog` VALUES ('310', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380239');
INSERT INTO `caipiao_memberlog` VALUES ('311', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380241');
INSERT INTO `caipiao_memberlog` VALUES ('312', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380266');
INSERT INTO `caipiao_memberlog` VALUES ('313', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380267');
INSERT INTO `caipiao_memberlog` VALUES ('314', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380314');
INSERT INTO `caipiao_memberlog` VALUES ('315', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495380317');
INSERT INTO `caipiao_memberlog` VALUES ('316', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495380359');
INSERT INTO `caipiao_memberlog` VALUES ('317', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495380369');
INSERT INTO `caipiao_memberlog` VALUES ('318', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495380451');
INSERT INTO `caipiao_memberlog` VALUES ('319', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495380478');
INSERT INTO `caipiao_memberlog` VALUES ('320', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495380554');
INSERT INTO `caipiao_memberlog` VALUES ('321', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495380580');
INSERT INTO `caipiao_memberlog` VALUES ('322', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495380588');
INSERT INTO `caipiao_memberlog` VALUES ('323', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495380654');
INSERT INTO `caipiao_memberlog` VALUES ('324', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495380655');
INSERT INTO `caipiao_memberlog` VALUES ('325', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495381015');
INSERT INTO `caipiao_memberlog` VALUES ('326', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495381225');
INSERT INTO `caipiao_memberlog` VALUES ('327', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495381611');
INSERT INTO `caipiao_memberlog` VALUES ('328', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495381670');
INSERT INTO `caipiao_memberlog` VALUES ('329', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495381816');
INSERT INTO `caipiao_memberlog` VALUES ('330', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495382080');
INSERT INTO `caipiao_memberlog` VALUES ('331', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495382623');
INSERT INTO `caipiao_memberlog` VALUES ('332', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495382767');
INSERT INTO `caipiao_memberlog` VALUES ('333', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495382768');
INSERT INTO `caipiao_memberlog` VALUES ('334', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495382819');
INSERT INTO `caipiao_memberlog` VALUES ('335', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495384432');
INSERT INTO `caipiao_memberlog` VALUES ('336', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495384454');
INSERT INTO `caipiao_memberlog` VALUES ('337', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495384455');
INSERT INTO `caipiao_memberlog` VALUES ('338', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495385856');
INSERT INTO `caipiao_memberlog` VALUES ('339', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495385857');
INSERT INTO `caipiao_memberlog` VALUES ('340', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495385862');
INSERT INTO `caipiao_memberlog` VALUES ('341', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495423285');
INSERT INTO `caipiao_memberlog` VALUES ('342', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495424137');
INSERT INTO `caipiao_memberlog` VALUES ('343', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495424139');
INSERT INTO `caipiao_memberlog` VALUES ('344', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495433534');
INSERT INTO `caipiao_memberlog` VALUES ('345', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495435534');
INSERT INTO `caipiao_memberlog` VALUES ('346', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495435535');
INSERT INTO `caipiao_memberlog` VALUES ('347', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495435624');
INSERT INTO `caipiao_memberlog` VALUES ('348', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1495437078');
INSERT INTO `caipiao_memberlog` VALUES ('349', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495441143');
INSERT INTO `caipiao_memberlog` VALUES ('350', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495443960');
INSERT INTO `caipiao_memberlog` VALUES ('351', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495443961');
INSERT INTO `caipiao_memberlog` VALUES ('352', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495445364');
INSERT INTO `caipiao_memberlog` VALUES ('353', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1495445365');
INSERT INTO `caipiao_memberlog` VALUES ('354', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1495446344');
INSERT INTO `caipiao_memberlog` VALUES ('355', '8017', 'y123456', 'login', '登录成功', '192.168.0.103', '局域网', '1495501286');
INSERT INTO `caipiao_memberlog` VALUES ('356', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495502137');
INSERT INTO `caipiao_memberlog` VALUES ('357', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495502138');
INSERT INTO `caipiao_memberlog` VALUES ('358', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495502141');
INSERT INTO `caipiao_memberlog` VALUES ('359', '8017', 'y123456', 'login', '登录成功', '192.168.0.103', '局域网', '1495508620');
INSERT INTO `caipiao_memberlog` VALUES ('360', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495509401');
INSERT INTO `caipiao_memberlog` VALUES ('361', '8002', 'hjjfukfu', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495509533');
INSERT INTO `caipiao_memberlog` VALUES ('362', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495509635');
INSERT INTO `caipiao_memberlog` VALUES ('363', '8017', 'y123456', 'login', '登录成功', '192.168.0.103', '局域网', '1495510807');
INSERT INTO `caipiao_memberlog` VALUES ('364', '8017', 'y123456', 'login', '登录成功', '192.168.0.103', '局域网', '1495510810');
INSERT INTO `caipiao_memberlog` VALUES ('365', '8017', 'y123456', 'login', '登录成功', '192.168.0.103', '局域网', '1495519483');
INSERT INTO `caipiao_memberlog` VALUES ('366', '8022', 'abc123t1', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495520035');
INSERT INTO `caipiao_memberlog` VALUES ('367', '8017', 'y123456', 'login', '登录成功', '192.168.0.103', '局域网', '1495521055');
INSERT INTO `caipiao_memberlog` VALUES ('368', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1495591197');
INSERT INTO `caipiao_memberlog` VALUES ('369', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496274315');
INSERT INTO `caipiao_memberlog` VALUES ('370', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1496284190');
INSERT INTO `caipiao_memberlog` VALUES ('371', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1496284215');
INSERT INTO `caipiao_memberlog` VALUES ('372', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1496284217');
INSERT INTO `caipiao_memberlog` VALUES ('373', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1496301084');
INSERT INTO `caipiao_memberlog` VALUES ('374', '8017', 'y123456', 'login', '登录成功', '192.168.0.104', '局域网', '1496366188');
INSERT INTO `caipiao_memberlog` VALUES ('375', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1496367170');
INSERT INTO `caipiao_memberlog` VALUES ('376', '8017', 'y123456', 'login', '登录成功', '192.168.0.103', '局域网', '1496389904');
INSERT INTO `caipiao_memberlog` VALUES ('377', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1496396121');
INSERT INTO `caipiao_memberlog` VALUES ('378', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496481356');
INSERT INTO `caipiao_memberlog` VALUES ('379', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496482650');
INSERT INTO `caipiao_memberlog` VALUES ('380', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1496545706');
INSERT INTO `caipiao_memberlog` VALUES ('381', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1496568898');
INSERT INTO `caipiao_memberlog` VALUES ('382', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496594268');
INSERT INTO `caipiao_memberlog` VALUES ('383', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496594273');
INSERT INTO `caipiao_memberlog` VALUES ('384', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496594275');
INSERT INTO `caipiao_memberlog` VALUES ('385', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496594282');
INSERT INTO `caipiao_memberlog` VALUES ('386', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496594296');
INSERT INTO `caipiao_memberlog` VALUES ('387', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496594297');
INSERT INTO `caipiao_memberlog` VALUES ('388', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496594298');
INSERT INTO `caipiao_memberlog` VALUES ('389', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496629309');
INSERT INTO `caipiao_memberlog` VALUES ('390', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496648376');
INSERT INTO `caipiao_memberlog` VALUES ('391', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496676540');
INSERT INTO `caipiao_memberlog` VALUES ('392', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496705929');
INSERT INTO `caipiao_memberlog` VALUES ('393', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496710622');
INSERT INTO `caipiao_memberlog` VALUES ('394', '8017', 'y123456', 'login', '登录成功', '192.168.43.97', '局域网', '1496887655');
INSERT INTO `caipiao_memberlog` VALUES ('395', '8017', 'y123456', 'login', '登录成功', '192.168.43.97', '局域网', '1496887656');
INSERT INTO `caipiao_memberlog` VALUES ('396', '8017', 'y123456', 'login', '登录成功', '192.168.43.97', '局域网', '1496887662');
INSERT INTO `caipiao_memberlog` VALUES ('397', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496891835');
INSERT INTO `caipiao_memberlog` VALUES ('398', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496901966');
INSERT INTO `caipiao_memberlog` VALUES ('399', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1496995404');
INSERT INTO `caipiao_memberlog` VALUES ('400', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497080238');
INSERT INTO `caipiao_memberlog` VALUES ('401', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497175517');
INSERT INTO `caipiao_memberlog` VALUES ('402', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497583888');
INSERT INTO `caipiao_memberlog` VALUES ('403', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497584449');
INSERT INTO `caipiao_memberlog` VALUES ('404', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497584452');
INSERT INTO `caipiao_memberlog` VALUES ('405', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497594825');
INSERT INTO `caipiao_memberlog` VALUES ('406', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497689627');
INSERT INTO `caipiao_memberlog` VALUES ('407', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497689674');
INSERT INTO `caipiao_memberlog` VALUES ('408', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497689677');
INSERT INTO `caipiao_memberlog` VALUES ('409', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497690426');
INSERT INTO `caipiao_memberlog` VALUES ('410', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497690429');
INSERT INTO `caipiao_memberlog` VALUES ('411', '8036', 'a111222', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497698037');
INSERT INTO `caipiao_memberlog` VALUES ('412', '8037', 'a1123', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497712852');
INSERT INTO `caipiao_memberlog` VALUES ('413', '8037', 'a1123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497714389');
INSERT INTO `caipiao_memberlog` VALUES ('414', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497714692');
INSERT INTO `caipiao_memberlog` VALUES ('415', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497715401');
INSERT INTO `caipiao_memberlog` VALUES ('416', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497715404');
INSERT INTO `caipiao_memberlog` VALUES ('417', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497803024');
INSERT INTO `caipiao_memberlog` VALUES ('418', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497803245');
INSERT INTO `caipiao_memberlog` VALUES ('419', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497803247');
INSERT INTO `caipiao_memberlog` VALUES ('420', '8038', 'a1122', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497719783');
INSERT INTO `caipiao_memberlog` VALUES ('421', '8039', 'a12123', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497762212');
INSERT INTO `caipiao_memberlog` VALUES ('422', '8040', 'aa12345', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497762262');
INSERT INTO `caipiao_memberlog` VALUES ('423', '8041', 'aa12232', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497762473');
INSERT INTO `caipiao_memberlog` VALUES ('424', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497763695');
INSERT INTO `caipiao_memberlog` VALUES ('425', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497765162');
INSERT INTO `caipiao_memberlog` VALUES ('426', '8042', '我是某某', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497769621');
INSERT INTO `caipiao_memberlog` VALUES ('427', '8043', '我是某某2!~', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497769748');
INSERT INTO `caipiao_memberlog` VALUES ('428', '8044', '我是某某3', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497770201');
INSERT INTO `caipiao_memberlog` VALUES ('429', '8045', '我是某某~~!!!!', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497770245');
INSERT INTO `caipiao_memberlog` VALUES ('430', '8046', '我是某某4', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497770695');
INSERT INTO `caipiao_memberlog` VALUES ('431', '8047', '我是【某某】', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497770951');
INSERT INTO `caipiao_memberlog` VALUES ('432', '8048', '我是某某6!!@#', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497771581');
INSERT INTO `caipiao_memberlog` VALUES ('433', '8049', '我是某某!@##@#', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497772037');
INSERT INTO `caipiao_memberlog` VALUES ('434', '8050', '我是某某7', 'login', '注册/登陆', '0.0.0.0', 'IANA保留地址', '1497774075');
INSERT INTO `caipiao_memberlog` VALUES ('435', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497774124');
INSERT INTO `caipiao_memberlog` VALUES ('436', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497792905');
INSERT INTO `caipiao_memberlog` VALUES ('437', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497792906');
INSERT INTO `caipiao_memberlog` VALUES ('438', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497792909');
INSERT INTO `caipiao_memberlog` VALUES ('439', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497795018');
INSERT INTO `caipiao_memberlog` VALUES ('440', '8020', 'zggcdyz', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497795067');
INSERT INTO `caipiao_memberlog` VALUES ('441', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497796247');
INSERT INTO `caipiao_memberlog` VALUES ('442', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497796249');
INSERT INTO `caipiao_memberlog` VALUES ('443', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497801258');
INSERT INTO `caipiao_memberlog` VALUES ('444', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497802004');
INSERT INTO `caipiao_memberlog` VALUES ('445', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1497973252');
INSERT INTO `caipiao_memberlog` VALUES ('446', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1498008178');
INSERT INTO `caipiao_memberlog` VALUES ('447', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1498014136');
INSERT INTO `caipiao_memberlog` VALUES ('448', '8021', 'abc123', 'login', '登录成功', '0.0.0.0', 'IANA保留地址', '1498014138');
INSERT INTO `caipiao_memberlog` VALUES ('449', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498612640');
INSERT INTO `caipiao_memberlog` VALUES ('450', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498613153');
INSERT INTO `caipiao_memberlog` VALUES ('451', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498613156');
INSERT INTO `caipiao_memberlog` VALUES ('452', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498614743');
INSERT INTO `caipiao_memberlog` VALUES ('453', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498614917');
INSERT INTO `caipiao_memberlog` VALUES ('454', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498635860');
INSERT INTO `caipiao_memberlog` VALUES ('455', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498659297');
INSERT INTO `caipiao_memberlog` VALUES ('456', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498698271');
INSERT INTO `caipiao_memberlog` VALUES ('457', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498715201');
INSERT INTO `caipiao_memberlog` VALUES ('458', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498715807');
INSERT INTO `caipiao_memberlog` VALUES ('459', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498715808');
INSERT INTO `caipiao_memberlog` VALUES ('460', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498719075');
INSERT INTO `caipiao_memberlog` VALUES ('461', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498808776');
INSERT INTO `caipiao_memberlog` VALUES ('462', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498808984');
INSERT INTO `caipiao_memberlog` VALUES ('463', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498809200');
INSERT INTO `caipiao_memberlog` VALUES ('464', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498809202');
INSERT INTO `caipiao_memberlog` VALUES ('465', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498809314');
INSERT INTO `caipiao_memberlog` VALUES ('466', '8024', 'abc123t3', 'login', '登录成功', '127.0.0.1', '本机地址', '1498809920');
INSERT INTO `caipiao_memberlog` VALUES ('467', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498810435');
INSERT INTO `caipiao_memberlog` VALUES ('468', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498810895');
INSERT INTO `caipiao_memberlog` VALUES ('469', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498810897');
INSERT INTO `caipiao_memberlog` VALUES ('470', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498811058');
INSERT INTO `caipiao_memberlog` VALUES ('471', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498811693');
INSERT INTO `caipiao_memberlog` VALUES ('472', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498811694');
INSERT INTO `caipiao_memberlog` VALUES ('473', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498811740');
INSERT INTO `caipiao_memberlog` VALUES ('474', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498812291');
INSERT INTO `caipiao_memberlog` VALUES ('475', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498812292');
INSERT INTO `caipiao_memberlog` VALUES ('476', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498812668');
INSERT INTO `caipiao_memberlog` VALUES ('477', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498812669');
INSERT INTO `caipiao_memberlog` VALUES ('478', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498812780');
INSERT INTO `caipiao_memberlog` VALUES ('479', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498812781');
INSERT INTO `caipiao_memberlog` VALUES ('480', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498813407');
INSERT INTO `caipiao_memberlog` VALUES ('481', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498813408');
INSERT INTO `caipiao_memberlog` VALUES ('482', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498815094');
INSERT INTO `caipiao_memberlog` VALUES ('483', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498815095');
INSERT INTO `caipiao_memberlog` VALUES ('484', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498815234');
INSERT INTO `caipiao_memberlog` VALUES ('485', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498816464');
INSERT INTO `caipiao_memberlog` VALUES ('486', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498816465');
INSERT INTO `caipiao_memberlog` VALUES ('487', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498870811');
INSERT INTO `caipiao_memberlog` VALUES ('488', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498870842');
INSERT INTO `caipiao_memberlog` VALUES ('489', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498870921');
INSERT INTO `caipiao_memberlog` VALUES ('490', '8024', 'abc123t3', 'login', '登录成功', '127.0.0.1', '本机地址', '1498870989');
INSERT INTO `caipiao_memberlog` VALUES ('491', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498806889');
INSERT INTO `caipiao_memberlog` VALUES ('492', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498806891');
INSERT INTO `caipiao_memberlog` VALUES ('493', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498811059');
INSERT INTO `caipiao_memberlog` VALUES ('494', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498815989');
INSERT INTO `caipiao_memberlog` VALUES ('495', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498815991');
INSERT INTO `caipiao_memberlog` VALUES ('496', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498816188');
INSERT INTO `caipiao_memberlog` VALUES ('497', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498816189');
INSERT INTO `caipiao_memberlog` VALUES ('498', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498816333');
INSERT INTO `caipiao_memberlog` VALUES ('499', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498816334');
INSERT INTO `caipiao_memberlog` VALUES ('500', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498816594');
INSERT INTO `caipiao_memberlog` VALUES ('501', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498822161');
INSERT INTO `caipiao_memberlog` VALUES ('502', '0', 'abc123t1', 'withdraw', 'PC端 提款操作，金额:100,提款单号:X1706301933383607', '127.0.0.1', '本机地址', '1498822418');
INSERT INTO `caipiao_memberlog` VALUES ('503', '0', 'abc123t1', 'withdraw', 'PC端 提款操作，金额:100,提款单号:Z1706301934022136', '127.0.0.1', '本机地址', '1498822442');
INSERT INTO `caipiao_memberlog` VALUES ('504', '0', 'abc123t1', 'withdraw', 'PC端 提款操作，金额:100,提款单号:U1706302000131758', '127.0.0.1', '本机地址', '1498824013');
INSERT INTO `caipiao_memberlog` VALUES ('505', '0', 'abc123t1', 'withdraw', 'PC端 提款操作，金额:100,提款单号:S1706302006580792', '127.0.0.1', '本机地址', '1498824418');
INSERT INTO `caipiao_memberlog` VALUES ('506', '0', 'abc123t1', 'withdraw', 'PC端 提款操作，金额:100,提款单号:S1706302127253188', '127.0.0.1', '本机地址', '1498829245');
INSERT INTO `caipiao_memberlog` VALUES ('507', '0', 'abc123t1', 'withdraw', 'PC端 提款操作，金额:130,提款单号:E1706302127322187', '127.0.0.1', '本机地址', '1498829252');
INSERT INTO `caipiao_memberlog` VALUES ('508', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498830596');
INSERT INTO `caipiao_memberlog` VALUES ('509', '8024', 'abc123t3', 'login', '登录成功', '127.0.0.1', '本机地址', '1498830697');
INSERT INTO `caipiao_memberlog` VALUES ('510', '8024', 'abc123t3', 'login', '登录成功', '127.0.0.1', '本机地址', '1498830704');
INSERT INTO `caipiao_memberlog` VALUES ('511', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498830793');
INSERT INTO `caipiao_memberlog` VALUES ('512', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498830905');
INSERT INTO `caipiao_memberlog` VALUES ('513', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498874410');
INSERT INTO `caipiao_memberlog` VALUES ('514', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498874610');
INSERT INTO `caipiao_memberlog` VALUES ('515', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1498879051');
INSERT INTO `caipiao_memberlog` VALUES ('516', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498888423');
INSERT INTO `caipiao_memberlog` VALUES ('517', '8051', 'abc123t4', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1498894643');
INSERT INTO `caipiao_memberlog` VALUES ('518', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1498959939');
INSERT INTO `caipiao_memberlog` VALUES ('519', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498988786');
INSERT INTO `caipiao_memberlog` VALUES ('520', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1498994024');
INSERT INTO `caipiao_memberlog` VALUES ('521', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1499002502');
INSERT INTO `caipiao_memberlog` VALUES ('522', '8021', 'abc123', 'login', '登录成功', '192.168.0.100', '局域网', '1499051962');
INSERT INTO `caipiao_memberlog` VALUES ('523', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499059123');
INSERT INTO `caipiao_memberlog` VALUES ('524', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499059149');
INSERT INTO `caipiao_memberlog` VALUES ('525', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499059150');
INSERT INTO `caipiao_memberlog` VALUES ('526', '8021', 'abc123', 'login', '登录成功', '192.168.0.100', '局域网', '1499059231');
INSERT INTO `caipiao_memberlog` VALUES ('527', '8021', 'abc123', 'login', '登录成功', '192.168.0.100', '局域网', '1499059232');
INSERT INTO `caipiao_memberlog` VALUES ('528', '8021', 'abc123', 'login', '登录成功', '192.168.0.100', '局域网', '1499086031');
INSERT INTO `caipiao_memberlog` VALUES ('529', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499133331');
INSERT INTO `caipiao_memberlog` VALUES ('530', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499139459');
INSERT INTO `caipiao_memberlog` VALUES ('531', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499139461');
INSERT INTO `caipiao_memberlog` VALUES ('532', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499142778');
INSERT INTO `caipiao_memberlog` VALUES ('533', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1499148104');
INSERT INTO `caipiao_memberlog` VALUES ('534', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1499149804');
INSERT INTO `caipiao_memberlog` VALUES ('535', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1499149805');
INSERT INTO `caipiao_memberlog` VALUES ('536', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499157488');
INSERT INTO `caipiao_memberlog` VALUES ('537', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499157944');
INSERT INTO `caipiao_memberlog` VALUES ('538', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499157945');
INSERT INTO `caipiao_memberlog` VALUES ('539', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499164248');
INSERT INTO `caipiao_memberlog` VALUES ('540', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499164249');
INSERT INTO `caipiao_memberlog` VALUES ('541', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499164461');
INSERT INTO `caipiao_memberlog` VALUES ('542', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499164463');
INSERT INTO `caipiao_memberlog` VALUES ('543', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499165101');
INSERT INTO `caipiao_memberlog` VALUES ('544', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499173922');
INSERT INTO `caipiao_memberlog` VALUES ('545', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499174831');
INSERT INTO `caipiao_memberlog` VALUES ('546', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499174923');
INSERT INTO `caipiao_memberlog` VALUES ('547', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499175771');
INSERT INTO `caipiao_memberlog` VALUES ('548', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499176089');
INSERT INTO `caipiao_memberlog` VALUES ('549', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1499178023');
INSERT INTO `caipiao_memberlog` VALUES ('550', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499180620');
INSERT INTO `caipiao_memberlog` VALUES ('551', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499217525');
INSERT INTO `caipiao_memberlog` VALUES ('552', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499220114');
INSERT INTO `caipiao_memberlog` VALUES ('553', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499221652');
INSERT INTO `caipiao_memberlog` VALUES ('554', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499226647');
INSERT INTO `caipiao_memberlog` VALUES ('555', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499234110');
INSERT INTO `caipiao_memberlog` VALUES ('556', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499239557');
INSERT INTO `caipiao_memberlog` VALUES ('557', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499239558');
INSERT INTO `caipiao_memberlog` VALUES ('558', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499241976');
INSERT INTO `caipiao_memberlog` VALUES ('559', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499244966');
INSERT INTO `caipiao_memberlog` VALUES ('560', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499245068');
INSERT INTO `caipiao_memberlog` VALUES ('561', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499245070');
INSERT INTO `caipiao_memberlog` VALUES ('562', '8055', 'aa', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499245120');
INSERT INTO `caipiao_memberlog` VALUES ('563', '8056', 'aa1112', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499245854');
INSERT INTO `caipiao_memberlog` VALUES ('564', '8057', 'aaa1222', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499246353');
INSERT INTO `caipiao_memberlog` VALUES ('565', '8058', 'asdf', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499246568');
INSERT INTO `caipiao_memberlog` VALUES ('566', '8059', 'aa12323', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499247932');
INSERT INTO `caipiao_memberlog` VALUES ('567', '8060', 'aa43434', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499247941');
INSERT INTO `caipiao_memberlog` VALUES ('568', '8061', 'a12312', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499248242');
INSERT INTO `caipiao_memberlog` VALUES ('569', '8062', 'a23423', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499248497');
INSERT INTO `caipiao_memberlog` VALUES ('570', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499248593');
INSERT INTO `caipiao_memberlog` VALUES ('571', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499260187');
INSERT INTO `caipiao_memberlog` VALUES ('572', '8064', 'sdfsdf', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499263476');
INSERT INTO `caipiao_memberlog` VALUES ('573', '8065', 'gfgdfg', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499263711');
INSERT INTO `caipiao_memberlog` VALUES ('574', '8066', 'gdfgsdf', 'login', '注册/登陆', '127.0.0.1', '本机地址', '1499263776');
INSERT INTO `caipiao_memberlog` VALUES ('575', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499311944');
INSERT INTO `caipiao_memberlog` VALUES ('576', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499317746');
INSERT INTO `caipiao_memberlog` VALUES ('577', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499388279');
INSERT INTO `caipiao_memberlog` VALUES ('578', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499399983');
INSERT INTO `caipiao_memberlog` VALUES ('579', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499399984');
INSERT INTO `caipiao_memberlog` VALUES ('580', '8022', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499406448');
INSERT INTO `caipiao_memberlog` VALUES ('581', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499407659');
INSERT INTO `caipiao_memberlog` VALUES ('582', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499407666');
INSERT INTO `caipiao_memberlog` VALUES ('583', '8023', 'abc123t2', 'login', '登录成功', '127.0.0.1', '本机地址', '1499407717');
INSERT INTO `caipiao_memberlog` VALUES ('584', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499442736');
INSERT INTO `caipiao_memberlog` VALUES ('585', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499412388');
INSERT INTO `caipiao_memberlog` VALUES ('586', '8021', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499412392');
INSERT INTO `caipiao_memberlog` VALUES ('587', '8065', 'gfgdfg', 'login', '登录成功', '127.0.0.1', '本机地址', '1499429086');
INSERT INTO `caipiao_memberlog` VALUES ('588', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499430870');
INSERT INTO `caipiao_memberlog` VALUES ('589', '8068', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499430986');
INSERT INTO `caipiao_memberlog` VALUES ('590', '8068', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499477966');
INSERT INTO `caipiao_memberlog` VALUES ('591', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499481878');
INSERT INTO `caipiao_memberlog` VALUES ('592', '8068', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499484002');
INSERT INTO `caipiao_memberlog` VALUES ('593', '8068', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499485011');
INSERT INTO `caipiao_memberlog` VALUES ('594', '8070', 'abc123t01', 'login', '登录成功', '127.0.0.1', '本机地址', '1499489777');
INSERT INTO `caipiao_memberlog` VALUES ('595', '8068', 'abc123t1', 'login', '登录成功', '127.0.0.1', '本机地址', '1499733406');
INSERT INTO `caipiao_memberlog` VALUES ('596', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499757927');
INSERT INTO `caipiao_memberlog` VALUES ('597', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499760839');
INSERT INTO `caipiao_memberlog` VALUES ('598', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499824606');
INSERT INTO `caipiao_memberlog` VALUES ('599', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499827699');
INSERT INTO `caipiao_memberlog` VALUES ('600', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499827745');
INSERT INTO `caipiao_memberlog` VALUES ('601', '8070', 'abc123t01', 'login', '登录成功', '127.0.0.1', '本机地址', '1499831391');
INSERT INTO `caipiao_memberlog` VALUES ('602', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499831421');
INSERT INTO `caipiao_memberlog` VALUES ('603', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499839898');
INSERT INTO `caipiao_memberlog` VALUES ('604', '8067', 'abc123', 'login', '登录成功', '127.0.0.1', '本机地址', '1499846384');

-- ----------------------------
-- Table structure for `caipiao_memberloginerror`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_memberloginerror`;
CREATE TABLE `caipiao_memberloginerror` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(30) NOT NULL,
  `ip` char(20) NOT NULL,
  `time` int(11) NOT NULL,
  `errornum` smallint(6) NOT NULL,
  `locktime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_memberloginerror
-- ----------------------------

-- ----------------------------
-- Table structure for `caipiao_membersession`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_membersession`;
CREATE TABLE `caipiao_membersession` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `username` char(60) NOT NULL,
  `sessionid` char(32) NOT NULL,
  `ip` char(20) NOT NULL COMMENT '登录ip',
  `time` int(11) NOT NULL COMMENT '登录时间',
  PRIMARY KEY (`sid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_membersession
-- ----------------------------
INSERT INTO `caipiao_membersession` VALUES ('42', '8035', 'abc001', '1914bbff15fa8f41a7e03982e65d72f0', '0.0.0.0', '1495374320');
INSERT INTO `caipiao_membersession` VALUES ('2', '8001', 'cesshi111', 'f0043fccf9338c1ec073960017d6c9c9', '115.164.221.173', '1488539745');
INSERT INTO `caipiao_membersession` VALUES ('3', '8002', 'hjjfukfu', 'b5fa4f8db8622a96701507a2925f3356', '0.0.0.0', '1495509609');
INSERT INTO `caipiao_membersession` VALUES ('4', '8003', 'zggcdyz', '54706344c519e9b048c0e9f9e9df5cd8', '0.0.0.0', '1493373876');
INSERT INTO `caipiao_membersession` VALUES ('5', '8005', 'zggcdyz3', '07f621bee76710056b81a645bb58a23f', '127.0.0.1', '1494231274');
INSERT INTO `caipiao_membersession` VALUES ('6', '8006', 'zggcdyz4', 'd4ed8112aba4fef1b87564eea0b77266', '127.0.0.1', '1494231274');
INSERT INTO `caipiao_membersession` VALUES ('7', '8007', 'zggcdyz2', '0bc0caec2b142bd28a6bbfd7308f6382', '127.0.0.1', '1494231485');
INSERT INTO `caipiao_membersession` VALUES ('8', '8008', 'zggcdyz3', 'eff1aa922bbc74e872e8fbdafbfc3c0a', '127.0.0.1', '1494231550');
INSERT INTO `caipiao_membersession` VALUES ('9', '8009', 'zggcdyz4', 'd5d07a80542bc223370c23123aa44d83', '127.0.0.1', '1494231568');
INSERT INTO `caipiao_membersession` VALUES ('10', '8010', 'zggcdyz5', '7e4f9a1b448fa2bf8ca09d6b271e45db', '127.0.0.1', '1494231580');
INSERT INTO `caipiao_membersession` VALUES ('11', '8011', 'zggcdyx2', '50583d37b17308fca391d4b40f38a922', '127.0.0.1', '1494231654');
INSERT INTO `caipiao_membersession` VALUES ('12', '8012', 'zggcdyz3', '558790a1f715d56fc8192b54b05ed78a', '127.0.0.1', '1494291613');
INSERT INTO `caipiao_membersession` VALUES ('13', '8013', 'zggcdyz4', '50bda8403c63cb36019493b847ddf81b', '127.0.0.1', '1494292197');
INSERT INTO `caipiao_membersession` VALUES ('14', '8014', 'y123456', 'c9167535751bc5d597283c198dbe969b', '192.168.0.105', '1494292353');
INSERT INTO `caipiao_membersession` VALUES ('15', '8015', 's2343', '7ba949497da6a59690fafd14efe80653', '127.0.0.1', '1494292298');
INSERT INTO `caipiao_membersession` VALUES ('16', '8016', 's4123', 'f112be7e1ba8b449c0d963ffb1a77652', '127.0.0.1', '1494292369');
INSERT INTO `caipiao_membersession` VALUES ('17', '8017', 'y123456', '0aeae266b8695722e5a5662e5bee5347', '192.168.43.97', '1496893181');
INSERT INTO `caipiao_membersession` VALUES ('18', '8018', 's123456', 'a85be30482804372416abb8cfeaa34fc', '127.0.0.1', '1494295152');
INSERT INTO `caipiao_membersession` VALUES ('19', '8019', 'zggcdyz', 'c766f009997f13a8d69bda3eab9ecbee', '127.0.0.1', '1494379468');
INSERT INTO `caipiao_membersession` VALUES ('66', '8041', 'aa12232', 'ced545612c7ffac73a696c14ffedf16f', '0.0.0.0', '1497762473');
INSERT INTO `caipiao_membersession` VALUES ('93', '8051', 'abc123t4', 'ae889e6d8b60015dc947e34ae467edf0', '127.0.0.1', '1498913719');
INSERT INTO `caipiao_membersession` VALUES ('108', '8058', 'asdf', 'dc9d73d8fd6a124eee2381ea9f0aa8d2', '127.0.0.1', '1499246568');
INSERT INTO `caipiao_membersession` VALUES ('23', '8025', 'abc111', 'da3f61de626e16bcad5907467d421502', '127.0.0.1', '1495077363');
INSERT INTO `caipiao_membersession` VALUES ('24', '8028', 'a111', '8fa0775554898d3fad27325cd55c712e', '127.0.0.1', '1495078659');
INSERT INTO `caipiao_membersession` VALUES ('25', '8029', 'a112', 'bff9c8e49c10b6b4f4a37f24f5de14e0', '0.0.0.0', '1494922029');
INSERT INTO `caipiao_membersession` VALUES ('26', '8030', 'a113', '672aa6480ee00b35b71abc22dc8833a0', '0.0.0.0', '1494923028');
INSERT INTO `caipiao_membersession` VALUES ('27', '8031', 'a1114', '31ae161854b9a470ff04dbfd5c7db205', '0.0.0.0', '1494925013');
INSERT INTO `caipiao_membersession` VALUES ('28', '8032', 'a115', '3afc54373bed25b835af14591fa89bc5', '127.0.0.1', '1494923158');
INSERT INTO `caipiao_membersession` VALUES ('29', '8033', 'a116', 'c4e33475733033b2e2b671443e85e33e', '127.0.0.1', '1494923931');
INSERT INTO `caipiao_membersession` VALUES ('41', '8034', 'sdfsdf', 'e87925dbcd4991f365c7fb5bc41279fe', '127.0.0.1', '1495272572');
INSERT INTO `caipiao_membersession` VALUES ('117', '8023', 'abc123t2', '4c03fc8d4f24fa5c61f5159d7c10cdd3', '127.0.0.1', '1499410307');
INSERT INTO `caipiao_membersession` VALUES ('113', '8021', 'abc123', 'bc26bc8927b3a21288e3e7cda7d28fca', '127.0.0.1', '1499429276');
INSERT INTO `caipiao_membersession` VALUES ('109', '8059', 'aa12323', 'f437b241a58a987e361b3b3b2ac83c4a', '127.0.0.1', '1499247932');
INSERT INTO `caipiao_membersession` VALUES ('110', '8060', 'aa43434', 'a1282bb8acfd70f791a177838b7bff99', '127.0.0.1', '1499247941');
INSERT INTO `caipiao_membersession` VALUES ('114', '8064', 'sdfsdf', '0dafef24ade16338863611122e3a9e39', '127.0.0.1', '1499263476');
INSERT INTO `caipiao_membersession` VALUES ('116', '8066', 'gdfgsdf', '036350117de2ce7e6cf9d9d9734061d1', '127.0.0.1', '1499265170');
INSERT INTO `caipiao_membersession` VALUES ('118', '8065', 'gfgdfg', '173e01891f7a72e0cd2f9d3544208f3b', '127.0.0.1', '1499429274');
INSERT INTO `caipiao_membersession` VALUES ('129', '8067', 'abc123', 'df523e0420e3db48f36d642bed347166', '127.0.0.1', '1499847624');
INSERT INTO `caipiao_membersession` VALUES ('124', '8068', 'abc123t1', '8fcb2289ad8175a781fbcbdc91ce9509', '127.0.0.1', '1499745837');

-- ----------------------------
-- Table structure for `caipiao_message`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_message`;
CREATE TABLE `caipiao_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sentid` int(11) NOT NULL COMMENT '发送人id 系统：system',
  `sentname` char(20) NOT NULL COMMENT '发送人昵称 系统：system',
  `senttitle` varchar(255) NOT NULL,
  `sentcontext` text NOT NULL COMMENT '信件内容',
  `receid` int(11) NOT NULL COMMENT '收件人id 系统：system',
  `recename` char(20) NOT NULL COMMENT '收件人昵称 系统：system',
  `senttime` int(11) NOT NULL COMMENT '发送时间',
  `readtime` int(11) NOT NULL COMMENT '读取时间',
  `sentdel` tinyint(4) NOT NULL DEFAULT '0',
  `recdel` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sentid` (`sentid`),
  KEY `sentname` (`sentname`),
  KEY `receid` (`receid`),
  KEY `recename` (`recename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_message
-- ----------------------------

-- ----------------------------
-- Table structure for `caipiao_module`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_module`;
CREATE TABLE `caipiao_module` (
  `moduleid` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `name` char(60) NOT NULL,
  `remark` varchar(120) NOT NULL,
  `listorder` smallint(6) NOT NULL,
  PRIMARY KEY (`moduleid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_module
-- ----------------------------

-- ----------------------------
-- Table structure for `caipiao_news`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_news`;
CREATE TABLE `caipiao_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` smallint(6) NOT NULL,
  `catname` varchar(160) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `oddtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_news
-- ----------------------------
INSERT INTO `caipiao_news` VALUES ('57', '30', '网站介绍', '商务合作', '<p style=\"font-size:14px;color:#666666;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;font-size:12px;\"><span style=\"color:#333333;\">内容合作</span></span>\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\">\r\n	如果您拥有精彩或原创的与彩票玩法彩票技巧等相关的内容或其他资源,欢迎您与我们取得联系！\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<span style=\"font-weight:bolder;font-family:\'Microsoft YaHei\';color:#666666;line-height:24px;background-color:#FFFFFF;\"><span style=\"color:#333333;\">广告合作</span></span><br />\r\n<p style=\"font-size:14px;color:#666666;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\">\r\n	通过对网站广告位的互换及其他自由组合形式的广告资源置换来扩大宣传、增加多样化服务入口，最终以提升网站用户能获取更多附加价值为目的。如果您有相应的资源，非常欢迎您和我们取得联系。\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;font-size:12px;\"><span style=\"color:#333333;\">媒体合作</span></span><br />\r\n<span style=\"font-size:12px;\">如果您拥有互联网、微信、微博等各类传统与新媒体的丰富资源欢迎您与我们取得联系,让我们通过双方的友好合作来共同提高彼此的影响力！</span>\r\n</p>', '1495072030');
INSERT INTO `caipiao_news` VALUES ('58', '30', '网站介绍', '法律声明', '<span style=\"color:#666666;font-family:\'Microsoft YaHei\';font-size:14px;line-height:24px;background-color:#FFFFFF;\">本网站提供的任何内容（包括但不限于数据、文字、图表、图象、声音或录象等）的版权均属于本网站或相关权利人。未经本网站或相关权利人事先的书面许可，您不得以任何方式擅自复制、再造、传播、出版、转帖、改编或陈列本网站的内容。同时，未经本网站书面许可，对于本网站上的任何内容，任何人不得在非本网站所属的服务器上做镜像。任何未经授权使用本网站的行为都将违反《中华人民共和国著作权法》和其他法律法规以及有关国际公约的规定。</span>', '1495072059');
INSERT INTO `caipiao_news` VALUES ('3', '30', '网站介绍', '关于我们', '<p>\r\n	“彩票，是指国家为筹集社会公益资金，促进社会公益事业发展而特许发行、依法销售，自然人自愿购买，并按照特定规则获得中奖机会的凭证。”<br />\r\n目前特许发行的彩票有中国福利彩票和中国体育彩票，分别归口民政部和体育总局系统发行销售。<br />\r\n以中国福利彩票的拳头产品快三彩票为例，彩票销售收入的构成比例为：75%返还奖金，1%销售调节基金，5%发行费用，19%公益金。<br />\r\n其中公益金的用途对于福利彩票而言，主要投入到福利、慈善事业；对于彩票而言，主要投入到群众健身设施、奥运项目等等。<br />\r\n买彩票的目的\r\n</p>\r\n<p>\r\n	买彩票是支持中国公益事业的善举，买一注彩票2元钱不多，但表达的爱心无限。<br />\r\n客户买彩票目的，应该立足于爱心、娱乐、可承受。不应该为了侥幸中得大奖而铤而走险，动用不该动用的资金。<br />\r\n快三彩票团队\r\n</p>\r\n<p>\r\n	快三彩票目前拥有员工250余人，是一支充满朝气的年轻团队，正处于快速扩张时期。<br />\r\n我们的管理理念是为大家提供尽量宽松舒适的工作环境，充分尊重每个人的价值。管理虽然仍有不少欠缺，但是我们一直在努力做到阳光、健康、规范。<br />\r\n快三网敞开人才引进之门，为有志之士提供足够的发展空间、提供优厚的薪酬福利待遇。<br />\r\n遵循共同分享的理念，以建设激情澎湃的共同创业团队为目的，我们准备了数量不菲的红股、期权奖励给所有为公司做出贡献的员工。\r\n</p>', '1480805970');
INSERT INTO `caipiao_news` VALUES ('56', '30', '网站介绍', '联系我们', '<p style=\"font-size:14px;color:#666666;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\">\r\n	<span style=\"font-size:12px;\">幸运彩票暂时仅提供在线咨询服务，点击网站右上角＂在线客服</span><span style=\"font-size:12px;\">＂即可进行在线咨询；或者添加客服QQ：232323232</span>\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\">\r\n	<span style=\"font-size:12px;\"><span>我们提供早上9点夜间12点全天15小时在线咨询服务，全年无休；</span>专业的客服团队，15小时为您解答所有疑问；</span>\r\n</p>', '1495071988');
INSERT INTO `caipiao_news` VALUES ('11', '41', '优惠活动', '单次充值赠送活动', '单次充值赠送活动<strong></strong> 具体优惠返还金额联系客服咨询<br />', '1480815430');
INSERT INTO `caipiao_news` VALUES ('39', '41', '优惠活动', '每日消费赠送活动', '每日消费赠送活动', '1480966323');
INSERT INTO `caipiao_news` VALUES ('45', '33', '帮助指南', '平台的充值方式有哪些？', '<p style=\"font-family:微软雅黑, &quot;font-size:14px;background-color:#FFFFFF;color:#666666;\">\r\n	<span style=\"font-family:Tahoma;\">本站暂时提供四种充值方式，即“网银汇款、快捷充值、微信充值和支付宝充值”。</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;background-color:#FFFFFF;color:#666666;\">\r\n	<span style=\"font-family:Tahoma;\">网银汇款：指通过网上银行、银行存款等方式打款到本站提供的银行账户；</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;background-color:#FFFFFF;color:#666666;\">\r\n	<span style=\"font-family:Tahoma;\">快捷充值：指通过第三方进行支付，方便快捷；</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;background-color:#FFFFFF;color:#666666;\">\r\n	<span style=\"font-family:Tahoma;\">支付宝充值：指通过支付宝转账到本站提供的支付宝账户。</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;background-color:#FFFFFF;color:#666666;\">\r\n	<span style=\"font-family:Tahoma;\">微信充值：指通过微信转账到本站提供的微信账户。</span>\r\n</p>', '1494640796');
INSERT INTO `caipiao_news` VALUES ('10', '34', '安全问题', '参与游戏是否安全？', '<p>\r\n	<span style=\"font-size:16px;\">快3网承若： </span>\r\n</p>\r\n<p>\r\n	<span style=\"font-size:16px;\">1、快3网采用128位SSL加密技术和严格的安全管理体系，确保客户安全得到最完善的保障。 </span>\r\n</p>\r\n<p>\r\n	<span style=\"font-size:16px;\"> 2、客户的所有投注都是在极其严密的情况下进行，我们绝对不会向任何第三方透露客户资料。 </span>\r\n</p>\r\n<p>\r\n	<span style=\"font-size:16px;\"> 3、我们会对每一项交易均采取严格的保密和防盗防诈措施，保证玩家帐户的真实合法性并同时保证玩家交易和支付的安全性。</span>\r\n</p>\r\n<p>\r\n	<span style=\"font-size:16px;\"> 4、快3网安全性业内第一，还请放心游戏。</span>\r\n</p>', '1480812017');
INSERT INTO `caipiao_news` VALUES ('15', '34', '安全问题', '注册之后信息是否会泄露？', '<strong>在您注册成为我们的会员时，客户可能需要填写一些个人信息，如姓名、地址、电子邮箱、电话号码和银行帐号，以便我们更加及时方便的为您提供全方位的服务，在此我们相向您郑重承诺，我们会对会员的隐私进行保护，本平台在任何情况下都不会泄露客户资料！</strong>', '1480965354');
INSERT INTO `caipiao_news` VALUES ('44', '33', '帮助指南', '在线客服服务时间', '<span style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\"><span style=\"font-weight:bolder;font-family:&quot;font-size:12px;\">平台在线客服在上午</span></span><span style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\"><span style=\"font-weight:bolder;font-family:&quot;font-size:12px;\">08:30-夜间24:00为您提供最优质专业的服务，</span></span><span style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\"><span style=\"font-weight:bolder;font-family:&quot;font-size:12px;\">其他时间段请您留下您的联系方式，问题，我们会尽快帮您联系处理</span></span><span style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\"><span style=\"font-weight:bolder;font-family:&quot;font-size:12px;\">。平台的服务宗旨：我专业，您放心，我敬业，您省心。</span></span>', '1494640774');
INSERT INTO `caipiao_news` VALUES ('14', '34', '安全问题', ' 快3网简介', '快3网是由中国福彩中心推出的全国唯一的大型垂直类彩票平台，涵盖国内所有的快3玩法，致力于推动快3游戏在中国的发展。快3目前是国内最受欢迎的快开类游戏，已经成功在国内覆盖了13个省份，有近千万彩民参与并购买过快3游戏，成功完成了几百亿的销售额。\r\n<p class=\"p2\">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;快3网的推出是为了让快3彩民可以更简单、快捷的获取各个省份快3的开奖数据，预测分析，提供专业的走势、遗漏数据，让彩民可以玩的更加专业，中得更多奖金。不仅如此，快3网还联合了几个省份，开通彩票在线投注。这极大的方便了彩民用户，实现可以随时随地的购买快3彩票。同时快3网还推出手机端，联合微信、支付宝，让彩民享受移动互联网的便利。\r\n</p>\r\n<p class=\"p3\">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;快3网希望跟随中国福彩事业的发展，坚持以彩民利益为先，坚持提供安全、稳定、可靠的彩票数据，致力打造中国领先的彩票服务平台！&nbsp;\r\n</p>', '1480965304');
INSERT INTO `caipiao_news` VALUES ('16', '34', '安全问题', '安全中心的设置和介绍', '<p>\r\n	本平台采用独有的手机和邮箱的双重认证体制，塑造全新的验证通道。\r\n</p>\r\n<p>\r\n	使其达到最安全的用户体验。\r\n        建议完备下列安全信息，使您账户的安全级别更高，资金更安全。\r\n</p>\r\n<p>\r\n	问题1、什么是手机和邮箱的实时验证码？\r\n</p>\r\n<p>\r\n	首次登陆要根据引导进行邮箱和手机的绑定操作，绑定后，以后的任何操作都要经过验证码的验证保护。\r\n</p>\r\n<p>\r\n	问题2、什么是安全问题？\r\n</p>\r\n<p>\r\n	安全问题用于找回您的平台账号资料，绑定后可以通过安全问题找回。\r\n</p>\r\n<p>\r\n	问题3、绑定邮箱的作用？\r\n</p>\r\n<p>\r\n	绑定邮箱可增加账号安全级别，也可以确保在邮箱正常的情况下取回实时验证码。\r\n</p>', '1480965410');
INSERT INTO `caipiao_news` VALUES ('17', '35', '充值问题', '网银汇款须知', '<ul class=\"ul_help\" id=\"ul_help_s\">\r\n	<li style=\"background-color:#fff;\">\r\n		<div class=\"hc_cont\">\r\n			<strong><span style=\"color:#333333;font-family:\'Microsoft Yahei\', \'Hiragino Sans GB\', \'Helvetica Neue\', Helvetica, tahoma, arial, Verdana, sans-serif, \'WenQuanYi Micro Hei\', 宋体;font-size:14px;line-height:24px;background-color:#FFFFFF;\">由于网银汇款暂时只提供：工商银行和建设银行，没有这两个银行卡的会员，需要使用其他银行进行跨行转账；</span> \r\n			<p style=\"color:#666666;font-family:\'Microsoft Yahei\', \'Hiragino Sans GB\', \'Helvetica Neue\', Helvetica, tahoma, arial, Verdana, sans-serif, \'WenQuanYi Micro Hei\', 宋体;font-size:14px;background-color:#FFFFFF;\">\r\n				为了您的充值能过及时到账，在使用跨行转账时，请尽量使用<strong>“加急汇款”</strong> \r\n			</p>\r\n			<p style=\"color:#666666;font-family:\'Microsoft Yahei\', \'Hiragino Sans GB\', \'Helvetica Neue\', Helvetica, tahoma, arial, Verdana, sans-serif, \'WenQuanYi Micro Hei\', 宋体;font-size:14px;background-color:#FFFFFF;\">\r\n				使用“加急汇款”功能的时间为周一至周五的09:00～16:30，其余时间和假日没有加急选项功能，建议您于可以在加急的时间段内进行充值，使用加急功能进行充值可以快速到账。\r\n			</p>\r\n</strong>\r\n		</div>\r\n	</li>\r\n</ul>', '1480965470');
INSERT INTO `caipiao_news` VALUES ('18', '35', '充值问题', '工行转账充值流程', '<p>\r\n	<strong>第一步：点击首页“会员中心-资金管理-我要充值-网银汇款”按钮，选择“工商银行\"输入金额，点击“下一步”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang1.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第二步：获取充值信息，并请务必使用”复制”功能</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang2.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第三步：点击“登录网上银行付款”，进入工行银行点击上方菜单栏位的“转账汇款”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang3.jpg\" /> \r\n</p>\r\n<p>\r\n	<strong>第四步：点击页面左侧的“境内汇款”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang4.jpg\" /> \r\n</p>\r\n<p>\r\n	<strong>第五步：使用“复制”功能，在网银对应栏内粘贴“收款人姓名、收款账号或者收款E-mail、附言”等必填信息（注：请复制申请充值信息的“附言”，粘贴入网银页面“给收款人附言”一栏)</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang5.jpg\" /> \r\n</p>\r\n<p>\r\n	<strong>第六步：点击“提交”提示交易成功</strong> \r\n</p>', '1480965488');
INSERT INTO `caipiao_news` VALUES ('19', '35', '充值问题', '建行转账充值流程', '<p>\r\n	<strong>第一步：点击首页“会员中心-资金管理-我要充值-网银汇款”按钮，选择“工商银行\"输入金额，点击“下一步”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/jianhang1.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第二步：获取充值信息</strong> \r\n</p>\r\n<p>\r\n	<strong><img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/jianhang2.png\" /></strong> \r\n</p>\r\n<p>\r\n	<strong>第三步：点击“转账汇款”,然后点击“活期转账汇款”,跳转跨行转账页面</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/jianhang3.jpg\" /> \r\n</p>\r\n<p>\r\n	<strong>第四步：使用复制功能，在网银对应栏内粘贴“收款账户名、收款账号、附言”等必填信息。（注：复制正确的附言，张贴到附言一栏）</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/jianhang4.jpg\" /> \r\n</p>\r\n<p>\r\n	<strong>第五步：跳转至确认转账信息页面后并点击“确认”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/jianhang5.jpg\" /> \r\n</p>\r\n<p>\r\n	<b>第六步：输入建行“网银盾密码”进行支付</b> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/jianhang6.jpg\" /> \r\n</p>\r\n<p>\r\n	<b>第七步：支付信息确认后,跳转至“转账交易成功”页面 </b> \r\n</p>', '1480965506');
INSERT INTO `caipiao_news` VALUES ('20', '35', '充值问题', '农行转工商充值流程', '<p>\r\n	<strong>第一步：点击首页“会员中心-资金管理-我要充值-网银汇款”按钮，选择“工商银行\"输入金额，点击“下一步”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang1.png\" /> \r\n</p>\r\n<p>\r\n	<b>第二步：获取充值信息</b> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang2.png\" /> \r\n</p>\r\n<p>\r\n	<b>第三步：点击“登录网上银行汇款\'后，点击”单笔转账“</b> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/nonghang3.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第四步：添加”新增收款方“</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/nonghang4.png\" /> \r\n</p>\r\n<p>\r\n	<b>第五步：使用复制功能，在网银对应栏内粘贴“账号、账户名、开户网点”等信息</b> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/nonghang5.png\" /> \r\n</p>\r\n<p>\r\n	<b>第六步：复制平台“附言”信息，粘贴入“转账用途”</b> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/nonghang6.png\" /> \r\n</p>\r\n<p>\r\n	<b>第七步：输入\"支付密码“点击“提交” 第八步：支付信息确认后，跳转至“转账交易成功”页面</b> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/nonghang7.png\" /> \r\n</p>\r\n<b>第八步：支付信息确认后，跳转至“转账交易成功”页面</b>', '1480965525');
INSERT INTO `caipiao_news` VALUES ('21', '35', '充值问题', '民生转工商充值流程', '<p>\r\n	<strong>第一步：点击首页“会员中心-资金管理-我要充值-网银汇款”按钮，选择“工商银行\"输入金额，点击“下一步”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang1.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第二步：获取充值信息</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang2.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第三步：登录网银页面，点击“转账汇款”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/minsheng3.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第四步：选择“跨行转账”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/minsheng4.jpg\" /> \r\n</p>\r\n<p>\r\n	<strong>第五步：使用复制功能，在网银对应栏内粘贴“收款账户名称、收款账户、附言”等信息（注：请复制申请充值信息的“附言”，粘贴入网银页面“用途”一栏)</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/minsheng5.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第六步：确认充值信息，点击“提交” </strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/minsheng6.jpg\" /> \r\n</p>\r\n<p>\r\n	<strong>第七步：交易成功页面</strong> \r\n</p>', '1480965545');
INSERT INTO `caipiao_news` VALUES ('22', '35', '充值问题', '招商转工商充值流程', '<p>\r\n	<strong>第一步：点击首页“会员中心-资金管理-我要充值-网银汇款”按钮，选择“工商银行\"输入金额，点击“下一步”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang1.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第二步：获取充值信息</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang2.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第三步：登录招商网银页面，点击“转账汇款”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/zhaohang3.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第四步:选择</strong><strong>“跨行转账”，	并使用复制功能，在网银对应栏内粘贴“收款方户名、收款方账号、开户网点”等信息（注：请复制申请充值信息的“附言”，粘贴入网银页面“附言”一栏) </strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/zhaohang4.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第五步：确认转账信息</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/zhaohang5.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第六步：充值成功信息</strong> \r\n</p>', '1480965569');
INSERT INTO `caipiao_news` VALUES ('23', '35', '充值问题', '交通转工商充值流程', '<p>\r\n	<strong>第一步：点击首页“会员中心-资金管理-我要充值-网银汇款”按钮，选择“工商银行\"输入金额，点击“下一步”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang1.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第二步：获取充值信息</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/gongshang2.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第三步：登录网银，选择\"转账\"项下的\"转其他银行\"，点击\"汇款\"</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/jiaotong3.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第四步：复制平台申请充值信息，粘贴入网银页面“收款人卡号、收款人户名、收款人开户银行、附言”等信息（注：请复制申请充值信息的“附言”，粘贴入网银页面“汇款附言”一栏)</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/jiaotong4.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第五步：核对信息后，输入“转入账户校验码”，点击“确定”，输入“usbkey密码”。</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/jiaotong5.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第六步：转账成功</strong> \r\n</p>', '1480965588');
INSERT INTO `caipiao_news` VALUES ('24', '35', '充值问题', '快捷充值', '<ul class=\"ul_help\" id=\"ul_help_s\">\r\n	<li style=\"background-color:#fff;\">\r\n		<div class=\"hc_cont\">\r\n			<ul class=\"ul_help\" id=\"ul_help_s\">\r\n				<li style=\"background-color:#FFFFFF;\">\r\n					<div class=\"hc_cont\">\r\n						<p>\r\n							<strong>为了保障会员的权益，保证资金的安全。</strong> \r\n						</p>\r\n						<p>\r\n							<strong>1，我平台合作的第三方有支付宝，易宝，环迅，微信，全部获得银联会支付牌照。</strong> \r\n						</p>\r\n						<p>\r\n							<strong>2，点击充值，选择快捷支付功能，根据选择填写充值金额。</strong> \r\n						</p>\r\n						<p>\r\n							<strong>3，登陆网银付款。</strong> \r\n						</p>\r\n						<p>\r\n							<strong>4，充值成功。</strong> \r\n						</p>\r\n					</div>\r\n				</li>\r\n			</ul>\r\n		</div>\r\n	</li>\r\n</ul>', '1480965605');
INSERT INTO `caipiao_news` VALUES ('25', '35', '充值问题', '支付宝充值', '<p>\r\n	<strong>第一步：点击首页“会员中心-资金管理-我要充值-快捷支付”按钮，选择“支付宝\"输入金额，点击“下一步”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/zfb1.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第二步：获取充值信息</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/zfb2.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第三步：点击“去支付宝充值”登录到支付宝页面</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/zfb3.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第四步：进入转账付款页面，在“收款人”一行，粘贴从平台复制的“收款支付宝账号”和“校验姓名”，“输入充值金额”（注：请复制申请充值信息的“附言”，粘贴入“付款说明”一栏)</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/zfb4.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第五步：点击“付款”后，输入“支付密码”</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/zfb5.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第六步：充值付款成功</strong> \r\n</p>', '1480965624');
INSERT INTO `caipiao_news` VALUES ('26', '36', '购彩问题', '购彩流程', '<p>\r\n	<strong>第一步：</strong><strong>登录进入平台，选择您需要投注的彩种(如江苏快3...）</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/goucai1.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第二步：进入投注页面，选择自己喜欢的玩法（如 大小、单双），选择号码后输入”金额“</strong> <strong>点击”立即投注“</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/goucai2.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第三步：请再次检查是否正确，便可点击【确定】</strong> \r\n</p>\r\n<p>\r\n	<strong><img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/goucai3.png\" /></strong> \r\n</p>\r\n<p>\r\n	<strong>第四步： 投注成功后，点击【投注记录】即可查询投注记录</strong> \r\n</p>', '1480965647');
INSERT INTO `caipiao_news` VALUES ('27', '37', '提现问题', '平台提款安全吗？', '<strong>通过提交提款申请确保只能由用户自己提款；通过将用户提交的提款银行卡信息与用户注册时提交的身份认证信息进行核对，确保用户只能提款到本人银行卡，任何人都无法盗取用户的资金，保证提款的绝对安全。</strong>', '1480965672');
INSERT INTO `caipiao_news` VALUES ('28', '37', '提现问题', '提现须知', '<ul class=\"ul_help\" id=\"ul_help_s\">\r\n	<li style=\"background-color:#fff;\">\r\n		<div class=\"hc_cont\">\r\n			<ul class=\"ul_help\" id=\"ul_help_s\">\r\n				<li style=\"background-color:#FFFFFF;\">\r\n					<div class=\"hc_cont\">\r\n						<strong>1. 提款前请先绑定\"邮箱\"或\"手机\"，并且绑定好银行卡。&nbsp;</strong> \r\n						<p>\r\n							<strong>2. 提款金额必须在可提现额度范围以内。&nbsp;</strong> \r\n						</p>\r\n						<p>\r\n							<strong>3. 当发起提款申请成功后，提款10分钟内到账，如因网银系统问题或其他不可抗力因素影响，到账时间将会延迟，您有任何关于提款问题也可以咨询在线客服。</strong> \r\n						</p>\r\n					</div>\r\n				</li>\r\n			</ul>\r\n		</div>\r\n	</li>\r\n</ul>', '1480965692');
INSERT INTO `caipiao_news` VALUES ('29', '37', '提现问题', ' 如何提款？', '<p>\r\n	<strong>进入平台首页点击“会员中心--资金管理--我要取款”，选择您需要提款的银行卡后，输入您的\"验证码\"提交即可，首次注册账号的用户请您务必绑定好您的\"邮箱\"和\"或手机\"并且\"绑定银行卡\"。</strong> \r\n</p>\r\n<p>\r\n	<strong><img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/qk1.png\" /></strong> \r\n</p>', '1480965710');
INSERT INTO `caipiao_news` VALUES ('30', '38', '账户安全', '如何修改登录密码？', '<ul class=\"ul_help\" id=\"ul_help_s\">\r\n	<li style=\"background-color:#fff;\">\r\n		<div class=\"hc_cont\">\r\n			<ul class=\"ul_help\" id=\"ul_help_s\">\r\n				<li style=\"background-color:#FFFFFF;\">\r\n					<div class=\"hc_cont\">\r\n						<strong>请您进入【平台安全中心--密码管理】，通过输入“旧密码”来修改您的登录密码。</strong> \r\n					</div>\r\n				</li>\r\n			</ul>\r\n		</div>\r\n	</li>\r\n</ul>', '1480965738');
INSERT INTO `caipiao_news` VALUES ('31', '38', '账户安全', '忘记账户名怎么办？', '<ul class=\"ul_help\" id=\"ul_help_s\">\r\n	<li style=\"background-color:#fff;\">\r\n		<div class=\"hc_cont\">\r\n			<ul class=\"ul_help\" id=\"ul_help_s\">\r\n				<li style=\"background-color:#FFFFFF;\">\r\n					<div class=\"hc_cont\">\r\n						<p>\r\n							<strong>忘记平台账户名（用户名</strong><strong>），请您联系平台客服提供相关资料帮助找回。</strong> \r\n						</p>\r\n					</div>\r\n				</li>\r\n			</ul>\r\n		</div>\r\n	</li>\r\n</ul>', '1480965763');
INSERT INTO `caipiao_news` VALUES ('32', '38', '账户安全', '忘记登录密码怎么办？', '<p>\r\n	&nbsp;<strong>第一步：进入平台登录页面，点击登录页面的“忘记密码”</strong> \r\n</p>\r\n<p>\r\n	&nbsp;<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/wjmm1.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第二步：第二步：输入您需要登录密码的账户名和验证码后点击“下一步” </strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/wjmm2.png\" /> \r\n</p>\r\n<p>\r\n	<strong>第三步：选择您需要找回登录密码的方式，共有以下3种方式可以找回。</strong> \r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://www.k399.com/templates/SSC/images/bzzx/wjmm3.png\" /> \r\n</p>\r\n<p>\r\n	<strong>如果</strong><strong>以上方式都不可用？您还可以通过在线客服人工申诉找回登录密码</strong>。\r\n</p>', '1480965940');
INSERT INTO `caipiao_news` VALUES ('33', '39', '玩法限制规则', '玩法注数限制及最高奖金设置说明', '<ul class=\"ul_help\" id=\"ul_help_s\">\r\n	<li style=\"background-color:#fff;\">\r\n		<div class=\"hc_cont\">\r\n			<ul class=\"ul_help\" id=\"ul_help_s\">\r\n				<li style=\"background-color:#FFFFFF;\">\r\n					<div class=\"hc_cont\">\r\n						<p>\r\n							<strong>本平台玩法限制，禁止一切刷佣金行为，对此平台将实时监控。</strong> \r\n						</p>\r\n						<p>\r\n							<strong>玩法限制：5星大于80000注，4星大于8000注，3星大于800注，2星大于80注，定位胆大于8码的一律按作弊处理，严重者给予封号处理。&nbsp;</strong> \r\n						</p>\r\n						<p>\r\n							<strong>每单最高奖金限额200000.00元，超出按200000.00元计算</strong><strong>超出的奖金清0；</strong> \r\n						</p>\r\n						<p>\r\n							<strong>五星直选1024注以内，四星直选81注、三星直选8注，二星直选4注以内，组三2注，组六4注及以下均列为单挑模式，单挑模式每期最高奖金10000.00元，超过将按10000.00元返还，请务必知悉</strong> \r\n						</p>\r\n					</div>\r\n				</li>\r\n			</ul>\r\n		</div>\r\n	</li>\r\n</ul>', '1480965965');
INSERT INTO `caipiao_news` VALUES ('34', '40', '快三技巧攻略', '快3投注技巧与实战攻略分享：出球轨迹追踪法', '新快3 独门秘籍分享 出球轨迹追踪法&nbsp;&nbsp; \r\n出球轨迹追踪法主要参考“快3原始装球顺序图”，快3中奖号码在装球顺序图中呈纵向、横向、三角形、斜向趣味分布。按该三要素走势，挑出“百位数号码摆\r\n放”“十位数号码摆放”“个位数号码摆放”中具有明显特征的号码，给予特别关注。<br />\r\n出球轨迹追踪法”以“球摆放”为立足点进行研究，角度新颖，不同于我们日常所参照的“试机号”与“机球号”等，较精确。球摆放即是指摇奖机中球的摆放位置，没有固定的顺序。<br />\r\n除“出球轨迹追踪法”外，本报特约彩评师李玉群的另一研究成果即“前三期有无号分布图”，即本期奖号在前三期中含有几个，三期有无号在分布图中呈有规\r\n律地分布。如果彩民能准确地断定当期号码在前三期会含有几个，那么投注范围将会缩小很多。该分布图被本报采纳后，在彩民中产生了较大反响，新彩民可细心留\r\n意。', '1480965984');
INSERT INTO `caipiao_news` VALUES ('35', '40', '快三技巧攻略', '快3投注技巧推荐：教您从公式中找选号玄机', '在投注站里，有几个彩民扰着自己的头在想投注号码该选哪个，有的抬头看站里的走势图，有的人对着屏幕看开奖号，而这些人都是快3的爱好者，10分钟一期的快3游戏，让他们爱不释手。彩站的战主看到大家对选号头痛的样子，于是凑上前去告诉大家自己知道的一些小技巧。<br />\r\n&nbsp;<br />\r\n“快3”里，如果不分位置，同一个号码连续出现3或4期就是极限了，当某个号码连续出现4期(不分位置)，下期相信没人会再选它了。但是这种杀码的机会又不多，一年也没有几次连续出现4期的时候，于是大家就在寻找这种极限机会。“公式法”就是这样产生的，它一出现就受到了彩民的欢迎与追捧。<br />\r\n&nbsp;<br />\r\n公式一：<br />\r\n&nbsp;<br />\r\n“快3”中的“杀号公式”是这样的：当期开奖号码第3位×2+4，结果除以10取余数，余数即为“下期”很可能出的号码!<br />\r\n&nbsp;<br />\r\n公式二：<br />\r\n&nbsp;<br />\r\n当期开奖号码：第3位×3+3牞结果除以10取余数，余数即为“下期”很可能出的号码!', '1480966010');
INSERT INTO `caipiao_news` VALUES ('36', '40', '快三技巧攻略', '快3投注技巧与实战攻略分享：和值投注三原则', '实践出真知，在彩民们运用了大量的方法来投注快3时，最后得出一个结论，运用和数值投注“快3”，是中奖率提高的重要手段之一。为了让中奖率进一步提高，总结出了准确选择排列三和数值的“三原则”：<br />\r\n原则一：相邻和数值是否开出。倘若我们选择13的和数值投注，就要先看一看与13相邻的和数值，即12和14的和数值是否曾开出。如果开出，就可考虑投注。如果12和14的和数值已经开出，下一期说不定就有可能出12和14的中间号，即13的和数值。否则，就应放弃。<br />\r\n原则三：同尾和数值是否开出。倘若我们选择13的和数值投注，就要看一看13的同尾和数值，即3或23的和数值是否开出。如果开出，就可考虑投注。在这 \r\n里，我们可以把已经开出的3或23的和数值视为和数值13的“前奏曲”，下一期，说不定就可能开出和数值13这个“协助曲”。否则，就应放弃。此“三原 \r\n则”，综合运用，才能收到明显效果，切忌不可单打独奏，拆开运用。<br />\r\n原则三：平均间隔期是否达到。以和数值13为例，从“快3”正式单 \r\n独开奖以来，截至到05018期，和数值13共出现过14次，其间隔的期数依次为：8、11、2、13、2、2、17、12、18、3、20、0、26、\r\n 1。间隔的总期数为135期，平均间隔期约为10期。我们在确定运用和数值投注时，就要看一看13的和数值是否已出现10期以上。倘若达到，就可考虑投\r\n 注;倘若没有达到，就应放弃。', '1480966029');
INSERT INTO `caipiao_news` VALUES ('37', '40', '快三技巧攻略', '快3技巧攻略详解：心态很重要 切勿忘三心', '快3做为一种快开型彩票，即开即奖的特点让彩民们享受了不少购彩的乐趣，但无论中与不中，购买快3都需要不断调整心态，控制好购买的力度，这样无论结果如何，都是一次成功的购彩经历。那该怎样调整心态呢?小编觉得有“三心”很重要!<br />\r\n“玩”心：平常心对彩票的发行和长期购买应有一种健康心态。能冷静沉着地看待“风采”，情绪保持正常，无大波动。做到以买彩为游戏，不做冒险投赌，以“玩”为主，寻求乐趣，增加生活内容;投注多少量力而行，绝不影响生活。中彩与否在情绪上无大波动，中大奖不大喜，狂喜，防止乐极生悲;频投落空，不悔不怨，当做献“爱心”。<br />\r\n“恒”心：恒心购买彩票，期期紧跟，无特殊原因绝不间断，不学有些彩民兴来即投，失中即停，半途而废;也不因中小奖就加大注数，更不因频频失中便哀声叹气，以至中断买彩。要把买彩票看做锻炼毅力的好机会，持之以恒，细水长流，从长期玩彩中找乐趣，撞财运。<br />\r\n“学”心：选号要有“学”心，要学习别人投注的各种方法和技巧，在钻研过程中享受乐趣，丰富人生内涵，更重要的是总结个人投注的得失，从无规律中找窍门，寻求较好的投注方法。而老年彩民更要\"学\"，通过\"学\"玩彩促进脑细胞的新陈代谢，灵活脑力，达到延年益寿的目的。彩票世界，也是百态人生。', '1480966047');
INSERT INTO `caipiao_news` VALUES ('38', '40', '快三技巧攻略', '快3投注技巧：如何玩转三同号 高手为您来支招', '三同号投注包含三同号通选和三同号单选两种玩法。其中三同号通选玩法相对比较简单，只用2元就可全包豹子(111、222、333、444、555、666)进行投注，开奖号码中，只要开出任意豹子即中奖;三同号单选投注，是指从所有相同的三个号码(111、222、333、444、555、666)中任意选择一组号码进行投注，该种玩法相对较难，但是相应的奖金也是比较较高。<br />\r\n下面总结出了高手彩民玩快3常用的几种技巧，希望对大家有所帮助。<br />\r\n一、遗漏追号<br />\r\n一个三同号的遗漏周期相对较大，目前最大遗漏是111组合的1260期，虽然三同号单选奖金较多，但风险大。因此，要根据时机来追三同号。可以根据最近的走势，假如前30期未开出，那么就可以通过56个号码分布图对比一下6个三同号在一个月内开出的次数，去掉最冷的和开的次数最多的，还有开的次数最少的三个三同号，剩下三个三同号做40期追号计划，根据自身条件设计合理的利润，在很多时候会有所收获。<br />\r\n如果你觉得选三同号太难，怕即使开出三同号也未必是你选择的那几个，那么选择追三同号通选就比较保险，只要在你追号的周期内开出，你就可以盈利。当然小编也要提醒大家，在最近连续开出21天三同号的情况下追三同号通选也是存在风险的，因为一个号热久了会有冷的一天。您也可以选择在三同号冷后的第三天开始利用这个方法来设计追三同号单选或者三同号通选，以此来提高命中率。<br />\r\n二、利用和值选号<br />\r\n在快3中，包含三同号组合的和值分别有：3(111)、6(222)、9(333)12(444)、15(555)、18(666)，其中9和12的出现频率较高，而3和18的奖金最高，但开出概率较低。因此，可以重点关注几个高频率的中间和值来进行选号，投注三同号单选。<br />\r\n三、重号热号结合<br />\r\n观察最近10期的开奖号码，可利用热号和重号结合来选号投注三同号单选。从图中可以看出，热号1在连续开出了3期后，第72期便开出了三同号111。<br />\r\n三同号通选的理论遗漏为1/36，在三同号通选的遗漏期数达到理论遗漏的2倍左右，就可以结合近两天三同号的出号情况做一个追号计划。值得注意的是，三同号通选的历史最大遗漏为317期。', '1480966068');
INSERT INTO `caipiao_news` VALUES ('40', '41', '优惠活动', '每月消费赠送活动', '每月消费赠送活动', '1480966339');
INSERT INTO `caipiao_news` VALUES ('41', '41', '优惠活动', '每日亏损赠送活动', '每日亏损赠送活动', '1480966355');
INSERT INTO `caipiao_news` VALUES ('42', '41', '优惠活动', '每月亏损赠送活动', '每月亏损赠送活动', '1480966370');
INSERT INTO `caipiao_news` VALUES ('43', '33', '帮助指南', '如何注册', '<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	<span style=\"font-size:12px;\">点击网站右上角＂用户注册＂按钮，就可以进入用户注册页面；</span>\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	按照提示，填写注册信息，即可完成<span style=\"font-size:12px;\">注册</span>；\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	账号为4-15位字符，支持数字和字母，禁止以0开头；\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	密码为6-16位字符，支持数字、字母、符号；\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	注册完成后，系统将随机分配一张头像，进入＂我的账户＂＂个人信息＂可以修改头像和设置昵称；\r\n</p>', '1494640149');
INSERT INTO `caipiao_news` VALUES ('46', '33', '帮助指南', '如何购彩', '<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:&quot;font-size:12px;\">购彩前需要先进行充值，账户有余额才可以进行购彩投注；</span>\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	充值完成后，可进入＂购彩大厅＂选择您喜欢的彩票进行投注；\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	彩票投注页面，提供了＂玩法说明＂＂走势图＂，可以帮您更快了解＂玩法规则＂和＂开奖走势＂\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	投注完成后，可以进入＂我的账户＂＂投注记录＂，查看您的投注明细，查看是否中奖；\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	投注完成后，需等开奖后，才能查看是否中奖；\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	投注成功后，系统将自动从您的账户余额扣除对应的投注金额，如果中奖，奖金会自动添加到您的账户余额；\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:&quot;font-size:12px;\">可以进入＂我的账户＂＂交易记录＂，查看您的账户交易明细；</span>\r\n</p>', '1494640853');
INSERT INTO `caipiao_news` VALUES ('47', '33', '帮助指南', '如何提现', '<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:&quot;font-size:12px;\">中奖后如何提现？点击网站右上角＂提现＂按钮，就可以进入提现页面；</span>\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	选择您绑定的银行卡，填写您要提现的金额，并输入＂安全密码＂；\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	提现订单提交后，3-5分钟左右即可到账，可登陆银行查看银行账户余额；\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	点击＂我的账户＂＂交易记录＂可查看每日的交易明细；\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:&quot;font-size:12px;\">提现之前需先设置</span><span style=\"font-family:&quot;font-size:12px;\">＂安全密码</span><span style=\"font-family:&quot;font-size:12px;\">＂和绑定您要用来提现的银行卡；</span>\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	提现金额不能大于可提现金额；\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	为了提供更好的服务体验，降低广大用户提现订单的处理时间，每日最多只允许提现5次，建议用户合理安排每日的提现时间和次数；\r\n</p>', '1494640874');
INSERT INTO `caipiao_news` VALUES ('48', '33', '帮助指南', '手机如何购彩', '<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:&quot;font-size:12px;\">直接在手机浏览器输入网址，即可登录手机版，无需下载；</span>\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	手机版<span style=\"font-family:&quot;font-size:12px;\">随时随地可以进行投注，</span>更加便捷，建议广大用户使用手机版进行投注；\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	建议使用＂谷歌＂＂苹果＂＂UC＂浏览器，操作体验更佳；\r\n</p>', '1494640891');
INSERT INTO `caipiao_news` VALUES ('49', '33', '帮助指南', '账户安全', '<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	为了广大用户的账户安全，网站的＂安全中心＂提供了多项提升账户安全系数的功能；\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	新用户注册完成后，请及时进入＂安全中心＂绑定＂密保手机＂<span style=\"font-size:12px;\">＂</span>密保问题＂＂密保邮箱＂；\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	用户忘记密码时，可通过以上功能，找回密码；\r\n</p>', '1494640907');
INSERT INTO `caipiao_news` VALUES ('50', '33', '帮助指南', '网上购彩常见骗术', '<span style=\"font-family:Tahoma;font-size:14px;color:#E53333;background-color:#FFFFFF;\"><span style=\"font-weight:bolder;font-family:&quot;font-size:12px;\">骗术一、步步为营 巧立名目，不断要求用户缴费</span></span><span style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\"></span><span style=\"color:#666666;font-family:&quot;background-color:#FFFFFF;\"></span>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;\">用户注册后要求用户缴纳会员费、资料费、保证金、押金、开通费等多种名目的费用，步步紧逼，将用户带向缴费的无底洞，当用户恍然觉醒，后悔晚矣！</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;font-family:&quot;\">骗术二、高额回报 收取号码预测费，不中退款</span></span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;\">提供号码预测有偿服务，吹嘘高命中率和高回报率，并承诺不中退款甚至给予赔偿，利用用户想中大奖的心理骗取号码预测费，一旦号码预测错误，便溜之大吉。</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;font-family:&quot;\">骗术三、收费骗局 收取费用后不提供服务也不退款</span></span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;\">某些网站收取用户的费用后，不提供事先承诺的服务，当用户要求退款时，也不退款，用户最终是投诉无门，退款无望，最终不了了之。</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;font-family:&quot;\">骗术四、故计重施 骗完一批人，改头换面继续行骗</span></span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;\">某些网站骗了一批用户后，使用新的网站名称、域名以及客服电话，对网站内容稍加改动或干脆不改动继续行骗，使一批批用户不断上当。</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;font-family:&quot;\">骗术五、官方旗号 借用彩票中心名义行骗</span></span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;\">假借福利彩票发行中心或体育彩票管理中心等官方机构的名义，增加网站的公信力，当用户放松警惕后，便要求用户缴纳各种费用。</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;font-family:&quot;\">骗术六、无中生有 编造子虚乌有的机构行骗</span></span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;\">编造双色球管理局、3D管理局等子虚乌有的机构欺骗用户，使用户误以为网站有官方背景，继而对用户行骗。</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;\"></span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;font-family:&quot;\">骗术七、私自主动加你好友%99是骗子</span></span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-family:Tahoma;font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;font-family:&quot;\"></span></span>\r\n</p>\r\n<p style=\"font-family:微软雅黑, &quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;font-family:&quot;font-size:12px;\"><span style=\"font-family:Tahoma;\">编造各种好处诱惑您上当，大家谨防受骗</span></span>\r\n</p>', '1494640927');
INSERT INTO `caipiao_news` VALUES ('51', '33', '帮助指南', '如何绑定银行卡', '<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	<span style=\"font-size:12px;\">进入</span><span style=\"font-size:12px;\">＂我的账户＂</span><span style=\"font-size:12px;\">＂银行卡管理＂可以绑定您要用来提现的银行卡；</span>\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	<span style=\"font-size:12px;\">绑定银行卡前，需先设置安全密码；</span>\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	银行卡最多只允许绑定5张；\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	银行卡绑定支持所有主流银行；\r\n</p>\r\n<p style=\"font-size:14px;color:#666666;background-color:#FFFFFF;font-family:&quot;\">\r\n	为了用户资金安全，已成功提现的银行卡将自动锁定，无法删除和修改；如想弃用银行卡，可联系在线客服禁用该银行卡；\r\n</p>', '1494640956');
INSERT INTO `caipiao_news` VALUES ('52', '33', '帮助指南', '平台提款时间段', '<span style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\"><span style=\"font-weight:bolder;font-family:&quot;color:#666666;background-color:#FFFFFF;\"><span style=\"font-family:SimSun;font-size:18px;\">提款时间段为每天上午10:00---夜间24:00，其他时间提交统一等上午10点准时出款</span></span></span>', '1494641014');
INSERT INTO `caipiao_news` VALUES ('53', '33', '帮助指南', '游戏规则', '<p style=\"font-family:微软雅黑;font-size:12px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;font-family:;\"><span style=\"font-size:14px;color:#000000;\">本平台快3开奖结果是根据江苏快3、广西快3、吉林快3、湖北快3、河北快3、安徽快3开奖为依据的。另外会员可以下注单、双、大、小。详细规则如下：</span></span> \r\n</p>\r\n<p style=\"font-family:微软雅黑;font-size:12px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;\"><br />\r\n</span>\r\n</p>\r\n<p style=\"font-family:微软雅黑;font-size:12px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;\">第一条 &nbsp;快3游戏投注是指以三个号码组合为一注进行单式投注，每个投注号码为1-6共六个自然数中的任意一个，一组三个号码的组合称为一注。。购买者可对其选定的投注号码进行多注投注。单注彩票的投注金额最高无上限。</span>\r\n</p>\r\n<h3 style=\"font-family:微软雅黑;font-size:12px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;font-family:;\"> 第二条 &nbsp;购买者在网上投注。投注号码记录为江苏开奖凭证，开奖时将自动结算到帐户。</span>\r\n</h3>\r\n<h3 style=\"font-family:微软雅黑;font-size:12px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;font-family:;\"> 第三条 &nbsp;快3游戏根据号码组合共分为“和值”、“三同号”、“二同号”、“三不同号”、“二不同号”、“三连号通选（即全包）”投注方式，具体规定如下：<br />\r\n（一）、和值投注：是指对三个号码的和值进行投注，包括“和值3”至“和值18”投注。<br />\r\n（二）、三同号投注：是指对三个相同的号码进行投注，具体分为：<br />\r\n1、三同号通选（即全包）：是指对所有相同的三个号码（111、222、…、666）进行投注；<br />\r\n2、三同号单选：是指从所有相同的三个号码（111、222、…、666）中任意选择一组号码进行投注。<br />\r\n（三）二同号投注：是指对两个指定的相同号码进行投注，具体分为：<br />\r\n1、二同号复选：是指对三个号码中两个指定的相同号码和一个任意号码进行投注；<br />\r\n2、二同号单选：是指对三个号码中两个指定的相同号码和一个指定的不同号码进行投注。<br />\r\n（四）三不同号投注：是指对三个各不相同的号码进行投注。<br />\r\n（五）二不同号投注：是指对三个号码中两个指定的不同号码和一个任意号码进行投注。<br />\r\n（六）三连号通选投注（即全包）：是指对所有三个相连的号码（仅限：123、234、345、456）进行投注。</span> \r\n</h3>\r\n<h3 style=\"font-family:微软雅黑;font-size:12px;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;font-family:;\"><span style=\"font-size:14px;color:#000000;\"></span></span> \r\n</h3>\r\n<h1 style=\"font-size:12px;font-family:微软雅黑;color:#333333;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;font-family:;\"><span style=\"font-size:14px;color:#E53333;\">以上如不清楚请您与客服联系！谢谢合作！</span></span> \r\n</h1>\r\n<br />\r\n<p>\r\n	<br />\r\n</p>', '1494641056');
INSERT INTO `caipiao_news` VALUES ('54', '33', '帮助指南', '什么是可提现金额', '<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-size:12px;\">为防止洗黑钱等行为；每一笔充值，至少需要投注充值金额的50%才可以全额提现；</span>\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	<span style=\"font-weight:bolder;font-size:12px;\"><span style=\"color:#333333;\">可提现金额计算方式如下：</span></span>\r\n</p>\r\n<ul style=\"font-family:&quot;color:#666666;background-color:#FFFFFF;\">\r\n	<li>\r\n		<span>可提现金额 = 有效投注金额×2（此项需要投注金额达到充值金额的30%才计入）+ 所有奖金派送 + 活动所得礼金；</span>\r\n	</li>\r\n</ul>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;\">\r\n	有效投注金额指所有有效投注的金额，撤单的投注金额将不计算在内；\r\n</p>\r\n<div>\r\n	<br />\r\n</div>', '1494641072');
INSERT INTO `caipiao_news` VALUES ('55', '33', '帮助指南', '二维码支付管理', '<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;text-align:center;\">\r\n	<span style=\"font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;\">手机用户：请保存或者截图此二维码，然后再退出页面，打开您的手机支付宝钱包，点击扫一扫，从相册提取刚才保存的这张二维码扫码，点击转账之前提交订单的金额。进行转账！转账成功后自动入款。如有遇到没到账的，请联系客服QQ：</span></span>\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;text-align:center;\">\r\n	<br />\r\n</p>\r\n<p style=\"font-family:&quot;font-size:14px;color:#666666;background-color:#FFFFFF;text-align:center;\">\r\n	<span style=\"font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;\">电脑用户：请直接打开您的手机支付宝钱包，点击扫一扫，直接对准二维码扫描，</span></span><span style=\"font-size:12px;color:#E53333;\"><span style=\"font-weight:bolder;\">点击转账之前提交订单的金额。进行转账！转账成功后自动入款。如有遇到没到账的，请联系客服QQ：</span></span>\r\n</p>', '1494641114');
INSERT INTO `caipiao_news` VALUES ('59', '30', '网站介绍', '隐私声明', '<p style=\"font-size:14px;color:#666666;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\">\r\n	在登陆时向我们提供您的个人信息是基于对我们的信任，我们会以专业、谨慎和负责的态度对待您的个人信息。我们认为隐私权是您的重要权利，我们尊重您的隐私权，您提供的信息只能用于帮助我们为您提供更好的服务，因此，我们制定了个人信息保密制度以保护您的个人信息。凡以任何方式登陆本网站或直接、间接使用本网站资料者，视为自愿接受本网站声明的约束。我们的隐私权保护条款如下：\r\n</p>\r\n<span style=\"line-height:24px;color:#333333;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\"><span style=\"font-weight:bolder;\">个人信息的收集</span></span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">在您注册、使用本网站服务时，经您的同意，我们收集与个人身份有关的信息。如果您无法提供相应信息，可能会不能使用对应服务。我们也会基于优化用户体验的目的，收集其他有关的信息，以便优化我们的网站服务。</span><br />\r\n<span style=\"font-weight:bolder;font-family:\'Microsoft YaHei\';color:#666666;line-height:24px;background-color:#FFFFFF;\"><span style=\"color:#333333;\">隐私的保护</span></span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">保护用户隐私是本网站的一项基本政策。本网站不会公布或传播您在本网站注册的任何资料，但下列情况除外：</span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">1）事先获得用户的明确授权；</span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">2）用户对自身信息保密不当原因，导致用户非公开信息泄露；</span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">3）由于网络线路、黑客攻击、计算机病毒、政府管制等原因造成的资料泄露、丢失、被盗用或被篡改等；</span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">4）根据有关法律法规的要求；&nbsp;</span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">5）依据法院或仲裁机构的裁判或裁决，以及其他司法程序的要求；</span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">6）按照相关政府主管部门的要求；</span><br />\r\n<span style=\"line-height:24px;color:#333333;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\"><span style=\"font-weight:bolder;\">自我更新与信息公开</span></span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">我们鼓励您自我更新和修改个人信息以使其安全和有效。您能在任何时候非常容易地获取并修改您的个人信息，您可以随时自行决定修改、删除您在网站上的相关资料。您是唯一对您的账号和密码信息负有保密责任的人，任何情况下，请小心妥善保管。</span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">无论何时您自愿在公开场合披露个人信息， 此种信息可能被他人收集及使用，因此造成您的个人信息泄露，网站不承担责任。</span><br />\r\n<span style=\"line-height:24px;color:#333333;font-family:\'Microsoft YaHei\' !important;background-color:#FFFFFF;\"><span style=\"font-weight:bolder;\">提示</span></span><br />\r\n<span style=\"font-family:\'Microsoft YaHei\', SimSun, Arial;color:#666666;line-height:24px;background-color:#FFFFFF;\">我们可能会不时修改我们的隐私政策，这些修改会反映在本声明中，我们的任何修改都会将您的权益和满意度置於首位，我们希望您在每次访问我们的网页时都查阅我们的隐私声明，用户继续享用服务，则视为接受服务条款的变动。</span>', '1495072080');
INSERT INTO `caipiao_news` VALUES ('61', '46', '代理合作', '代理合作', '<div>\r\n	&nbsp;大发彩票网拥有多元化的产品，使用最公平、公正、公开的系统，在市场上的众多博彩网站中，我们自豪的提供会员最优惠的回馈，给予合作伙伴最优势的营利回报!&nbsp;无论&nbsp;拥有的是网络资源，或是人脉资源，都欢迎您来加入必发彩票网合作伙伴的行列，无须负担任何费用，就可以开始无上限的收入。&nbsp;选择大发彩票网，绝对是您最聪明的选择!<br />\r\n代理条件：<br />\r\na.具有便利的计算机上网设备。<br />\r\nb.有一定的人脉资源、网络资源或自己的广告网站。<br />\r\nc.每期都要有2个实际有效投注的会员以上，如达不到就累积到下期计算佣金。<br />\r\n代理独立平台：<br />\r\n我们为您提供单独的代理后台，您可以在后台不受限制的开出下线，并且实时了解下线会员输赢，存款，取款情况。代理后台有一个您的专属链接，您可以直接将您的专属链接链接在网站、论坛、博客等等可链接的网络页面，也可在群里面发送您的专属链接，只要通过您的专属链接注册的会员都算是您的下线。推广方式简单方便，推广渠道多种多样。<br />\r\n有效会员：<br />\r\n月结区间内进行过最少五次有效下注且投注总额不低于500RMB的会员！如联盟体系当月未达（月最低有效会员）最低门坎5人，则该月无法领取佣金回馈。联盟体系当月营利达到标准，而（月最低有效会员）人数未达相应最低门坎，则该月佣金比例依照﹛月最低有效会员﹜人数所达门坎相应的百分比进行退佣。<br />\r\n代理收入：<br />\r\nA：比如您本月的代理账号内有赢利的情况下，就可拥有以下收入:<br />\r\n1.一个月内公司在您的代理账号内纯赢利达到1000元-50000元，可享受其中15%的佣金。<br />\r\n2.一个月内公司在您的代理账号内纯赢利达到50001元-100000元，可享受其中20%的佣金。<br />\r\n3.一个月内公司在您的代理账号内纯赢利达到100001元-200000元，可享受其中25%的佣金。<br />\r\n4.一个月内公司在您的代理账号内纯赢利达到200001元-500000元，可享受其中30%的佣金。<br />\r\n5.一个月内公司在您的代理账号内纯赢利达到500001元以上，可享受其中35%的佣金。<br />\r\n请注意：<br />\r\n每位加入合营商的客户，如果您在第一个月的有效会员未达到公司要求，但有产生佣金，您的佣金将累计到下个月。<br />\r\n禁止代理商私自开设会员帐号进行非法投注套利。任何使用不诚实方法骗取代理佣金或下线会员与代理商同IP的我们视为代理商自己开设会员游戏，将取消代理资格并永久冻结账户，佣金一律不予发放。同IP出现多个会员的话，将被视为无效会员，不得计算在内。&nbsp;敬请联系在线客服QQ：69236869详细洽谈。<br />\r\n</div>', '1497686604');

-- ----------------------------
-- Table structure for `caipiao_page`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_page`;
CREATE TABLE `caipiao_page` (
  `catid` smallint(6) NOT NULL,
  `title` varchar(180) NOT NULL,
  `content` longtext NOT NULL,
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_page
-- ----------------------------
INSERT INTO `caipiao_page` VALUES ('19', '公司简介公司简介公司简介公司简介公司简介', '公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介');

-- ----------------------------
-- Table structure for `caipiao_payset`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_payset`;
CREATE TABLE `caipiao_payset` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `paytype` char(20) NOT NULL,
  `paytypetitle` varchar(30) NOT NULL,
  `ftitle` varchar(160) NOT NULL COMMENT '副标题',
  `minmoney` decimal(10,2) NOT NULL DEFAULT '50.00',
  `maxmoney` decimal(10,2) NOT NULL DEFAULT '50000.00',
  `remark` text NOT NULL COMMENT '支付说明',
  `configs` text NOT NULL COMMENT '配置',
  `isonline` tinyint(4) NOT NULL DEFAULT '-1' COMMENT '1线上支付 -1线下支付',
  `listorder` smallint(6) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1开启 -1关闭',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_payset
-- ----------------------------
INSERT INTO `caipiao_payset` VALUES ('1', 'alipay', '支付宝自动到账', '软件辅助自动到账', '1.00', '50000.00', '支付宝扫码支付', 'a:3:{s:8:\"bankname\";s:0:\"\";s:8:\"bankcode\";s:0:\"\";s:6:\"ewmurl\";s:37:\"/Uploads/2017-05-09/5911b1b343e67.png\";}', '-1', '1', '1');
INSERT INTO `caipiao_payset` VALUES ('6', 'weixin', '微信扫码自动到账', '扫码自动到账', '1.00', '50000.00', '', 'a:4:{s:8:\"bankname\";s:0:\"\";s:8:\"bankcode\";s:0:\"\";s:5:\"isewm\";s:1:\"1\";s:6:\"ewmurl\";s:37:\"/Uploads/2017-05-09/5911c7569d370.png\";}', '-1', '6', '0');
INSERT INTO `caipiao_payset` VALUES ('19', 'r1payweixin', '融e付微信', '融e付微信', '1.00', '5000.00', '', 'a:6:{s:10:\"merchantid\";s:6:\"123456\";s:12:\"merchantkey1\";s:6:\"123456\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:1:\"#\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:0:\"\";}', '1', '22', '0');
INSERT INTO `caipiao_payset` VALUES ('20', 'mobaoalipay', '墨宝支付宝', '墨宝支付宝', '1.00', '5000.00', '', 'a:6:{s:10:\"merchantid\";s:9:\"123456789\";s:12:\"merchantkey1\";s:9:\"123456789\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:1:\"#\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:0:\"\";}', '1', '19', '0');
INSERT INTO `caipiao_payset` VALUES ('21', 'mobaoweixin', '墨宝微信', '墨宝微信', '1.00', '5000.00', '', 'a:6:{s:10:\"merchantid\";s:9:\"123456789\";s:12:\"merchantkey1\";s:9:\"123456789\";s:12:\"merchantkey2\";s:1:\"#\";s:11:\"redirecturl\";s:0:\"\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:0:\"\";}', '1', '20', '0');
INSERT INTO `caipiao_payset` VALUES ('8', 'dinpay', '多得宝网银在线', '智付网银自动到账', '50.00', '50000.00', '', 'a:6:{s:10:\"merchantid\";s:10:\"1000210688\";s:12:\"merchantkey1\";s:0:\"\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:22:\"http://pay.hbsf32t.com\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:22:\"http://pay.hbsf32t.com\";}', '1', '8', '1');
INSERT INTO `caipiao_payset` VALUES ('9', 'dinpayweixin', '智付微信', '智付微信自动到账', '50.00', '50000.00', '', 'a:6:{s:10:\"merchantid\";s:10:\"1000210688\";s:12:\"merchantkey1\";s:0:\"\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:22:\"http://pay.hbsf32t.com\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:22:\"http://pay.hbsf32t.com\";}', '1', '9', '1');
INSERT INTO `caipiao_payset` VALUES ('10', 'mobaobank', '墨宝网银支付', '墨宝支付自动到账', '1.00', '50000.00', '', 'a:6:{s:10:\"merchantid\";s:15:\"210001110015420\";s:12:\"merchantkey1\";s:32:\"607f9daad26889c79c3663445fd722f9\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:1:\"#\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:0:\"\";}', '1', '18', '0');
INSERT INTO `caipiao_payset` VALUES ('13', 'alipayvpay', '银宝支付宝在线支付', '银宝接口', '100.00', '10000.00', '', 'a:6:{s:10:\"merchantid\";s:5:\"19377\";s:12:\"merchantkey1\";s:32:\"964ac2c399460f26442480b8ef1bd8e7\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:18:\"http://127.0.0.57/\";s:11:\"hrefbackurl\";s:21:\"http://www.k3695.com/\";s:13:\"returnbackurl\";s:21:\"http://www.k3695.com/\";}', '1', '13', '1');
INSERT INTO `caipiao_payset` VALUES ('12', 'xlb', '迅联宝在线支付', '', '1.00', '50000.00', '', 'a:6:{s:10:\"merchantid\";s:15:\"210000110010339\";s:12:\"merchantkey1\";s:32:\"59906de4d7e9275f0f44189db1d42221\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:18:\"http://127.0.0.57/\";s:11:\"hrefbackurl\";s:24:\"http://pay2.bjhozyt.top/\";s:13:\"returnbackurl\";s:24:\"http://pay2.bjhozyt.top/\";}', '1', '11', '0');
INSERT INTO `caipiao_payset` VALUES ('14', 'weixinvpay', '银宝微信在线支付', '银宝接口', '100.00', '10000.00', '', 'a:6:{s:10:\"merchantid\";s:5:\"19377\";s:12:\"merchantkey1\";s:32:\"964ac2c399460f26442480b8ef1bd8e7\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:18:\"http://127.0.0.57/\";s:11:\"hrefbackurl\";s:18:\"http://127.0.0.57/\";s:13:\"returnbackurl\";s:18:\"http://127.0.0.57/\";}', '1', '14', '0');
INSERT INTO `caipiao_payset` VALUES ('18', 'r1payalipay', '融e付支付宝', '融e付支付宝', '1.00', '5000.00', '', 'a:6:{s:10:\"merchantid\";s:6:\"123456\";s:12:\"merchantkey1\";s:6:\"123456\";s:12:\"merchantkey2\";s:1:\"#\";s:11:\"redirecturl\";s:0:\"\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:0:\"\";}', '1', '21', '0');
INSERT INTO `caipiao_payset` VALUES ('22', 'ipaybank', '环迅网银支付', '环迅网银支付', '1.00', '5000.00', '', 'a:6:{s:10:\"merchantid\";s:6:\"184026\";s:12:\"merchantkey1\";s:128:\"g22Fq3FlcdEQ3kc3qA72mmGPVWvHSRv3TWqZwFlu0P9VxBupNqefjdguukQbeHVEvsrCDXrRhZRAa7o3H5Rv58GJNUaJoz7ajbxXUoTRYcZ9Hshcvk0VoCPAuvDHLCNv\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:1:\"#\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:0:\"\";}', '1', '22', '0');
INSERT INTO `caipiao_payset` VALUES ('23', 'creditcard', '行用卡充值', '行用卡充值', '1.00', '5000.00', '', 'a:3:{s:8:\"bankname\";s:0:\"\";s:8:\"bankcode\";s:0:\"\";s:5:\"isewm\";s:1:\"1\";}', '-1', '23', '0');
INSERT INTO `caipiao_payset` VALUES ('24', 'epay', '墨宝证书版', '墨宝证书版', '1.00', '5000.00', '', 'a:6:{s:10:\"merchantid\";s:15:\"210001440013076\";s:12:\"merchantkey1\";s:32:\"ea315e7af41187b498bbe8139bd8a3b3\";s:12:\"merchantkey2\";s:0:\"\";s:11:\"redirecturl\";s:18:\"http://127.0.0.56/\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:18:\"http://127.0.0.56/\";}', '1', '24', '0');
INSERT INTO `caipiao_payset` VALUES ('25', 'ipayalipay', '环迅支付宝支付', '环迅支付宝支付', '1.00', '5000.00', '', 'a:6:{s:10:\"merchantid\";s:6:\"193065\";s:12:\"merchantkey1\";s:128:\"T7bfs4ZMophFAOPM5uAYSncRxoSxxezeWb235eWusur1aveuzAoLq3YxczPYg2uc1PQuRoWlDBxwYtB6ZXbCZyrTaGTky9f4VFbX638110M7TmYuYhz9rgsOmz3PhHKb\";s:12:\"merchantkey2\";s:10:\"1930650013\";s:11:\"redirecturl\";s:18:\"http://127.0.0.56/\";s:11:\"hrefbackurl\";s:0:\"\";s:13:\"returnbackurl\";s:18:\"http://127.0.0.56/\";}', '1', '25', '0');
INSERT INTO `caipiao_payset` VALUES ('26', 'linepay', '银行转账', '中国工商银行', '100.00', '50000.00', '<div style=\"border:1px solid #ddd;font-size:18px;padding:15px;\">\r\n	<p>\r\n		尊敬的客户您好，请根据以下银行信息进行转账汇款\r\n	</p>\r\n	<table class=\"linebankcardlist\" style=\"background:#cccccc;\" bgcolor=\"#CCCCCC\" cellpadding=\"1\" cellspacing=\"1\">\r\n		<tbody>\r\n			<tr>\r\n				<td bgcolor=\"#FFFFFF\" height=\"40\">\r\n					<span style=\"font-size:18px;\">工商银行</span> \r\n				</td>\r\n				<td bgcolor=\"#FFFFFF\">\r\n					<span style=\"font-size:18px;\">开户姓名:陈成</span> \r\n				</td>\r\n				<td bgcolor=\"#FFFFFF\">\r\n					<span style=\"font-size:18px;\">银行账号:1234567891234567</span> \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td bgcolor=\"#FFFFFF\">\r\n					<span style=\"font-size:18px;\">建设银行</span> \r\n				</td>\r\n				<td bgcolor=\"#FFFFFF\">\r\n					<span style=\"font-size:18px;\">开户姓名:陈成</span> \r\n				</td>\r\n				<td bgcolor=\"#FFFFFF\">\r\n					<span style=\"font-size:18px;\">银行账号:1234567891234567</span> \r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</div>', 'a:4:{s:8:\"bankname\";s:6:\"陈成\";s:8:\"bankcode\";s:12:\"123456656456\";s:5:\"isewm\";s:2:\"-1\";s:6:\"ewmurl\";s:0:\"\";}', '-1', '26', '1');
INSERT INTO `caipiao_payset` VALUES ('28', 'fourinone', '四合一（在线充值）', '四合一在线充值（微信，支付宝，QQ钱包，花呗）', '50.00', '5000.00', '<div>\r\n	四合一在线充值（微信，支付宝，QQ钱包，花呗）\r\n</div>', 'a:4:{s:8:\"bankname\";s:0:\"\";s:8:\"bankcode\";s:0:\"\";s:5:\"isewm\";s:1:\"1\";s:6:\"ewmurl\";s:37:\"/Uploads/2017-07-04/595b549411cab.png\";}', '-1', '27', '1');

-- ----------------------------
-- Table structure for `caipiao_question`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_question`;
CREATE TABLE `caipiao_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` char(20) NOT NULL,
  `questionone` varchar(120) NOT NULL,
  `answerone` varchar(120) NOT NULL,
  `questiontwo` varchar(120) NOT NULL,
  `answertwo` varchar(120) NOT NULL,
  `questionthree` varchar(120) NOT NULL,
  `answerthree` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_question
-- ----------------------------
INSERT INTO `caipiao_question` VALUES ('1', '8002', 'hjjfukfu', '您小学班主任的名字是?', 'fd3d02985ebb2bd8f937924fa431e510', '您中学班主任的名字是?', '65123dd3cbcc71e3f2134aefaa1956b9', '您高中班主任的名字是?', '9a289f5c3953a84d4532ae615f263b16');
INSERT INTO `caipiao_question` VALUES ('13', '8020', 'zggcdyz', '您小学班主任的名字是?', '7055eced15538bfb7c07f8a5b28fc5d0', '您母亲的姓名是?', 'dca1117a4a9933499a4a870b4190065a', '您最喜欢的运动是?', 'a36abd601b784b2ece294786ee83e834');
INSERT INTO `caipiao_question` VALUES ('14', '8021', 'abc123', '您的出生地是?', '7055eced15538bfb7c07f8a5b28fc5d0', '您中学班主任的名字是?', 'dca1117a4a9933499a4a870b4190065a', '您高中班主任的名字是?', 'a36abd601b784b2ece294786ee83e834');
INSERT INTO `caipiao_question` VALUES ('15', '8022', 'abc123t1', '您的出生地是?', '7055eced15538bfb7c07f8a5b28fc5d0', '您高中班主任的名字是?', 'dca1117a4a9933499a4a870b4190065a', '您大学班主任的名字是?', 'a36abd601b784b2ece294786ee83e834');
INSERT INTO `caipiao_question` VALUES ('16', '8017', 'y123456', '您的出生地是?', '7055eced15538bfb7c07f8a5b28fc5d0', '您中学班主任的名字是?', '174a9535b7fd93ceecbe1fc0392fa0f2', '您小学班主任的名字是?', '6116afedcb0bc31083935c1c262ff4c9');

-- ----------------------------
-- Table structure for `caipiao_recharge`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_recharge`;
CREATE TABLE `caipiao_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` char(30) NOT NULL,
  `paytype` char(20) NOT NULL COMMENT '存款方式标识',
  `paytypetitle` varchar(60) NOT NULL COMMENT '存款方式名称',
  `trano` char(60) NOT NULL COMMENT '单号',
  `threetrano` char(255) NOT NULL COMMENT '第三方订单号',
  `amount` decimal(12,2) NOT NULL COMMENT '金额',
  `fee` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `actualamount` decimal(12,2) NOT NULL COMMENT '实际金额',
  `actualfee` decimal(12,2) NOT NULL COMMENT '实际手续费',
  `oldaccountmoney` decimal(12,2) NOT NULL COMMENT '变更前金额',
  `newaccountmoney` decimal(12,2) NOT NULL COMMENT '变更后金额',
  `remark` varchar(155) NOT NULL COMMENT '备注',
  `payname` varchar(255) NOT NULL COMMENT '支付账号或线下存款银行',
  `fuyanma` int(11) NOT NULL COMMENT '附言码',
  `isauto` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 自动 2手动充',
  `sdtype` tinyint(4) NOT NULL DEFAULT '0' COMMENT '手动充值类型1增加 -1减少',
  `state` tinyint(4) NOT NULL COMMENT '0未审核 1审核通过 -1取消订单',
  `oddtime` int(11) NOT NULL COMMENT '订单时间',
  `stateadmin` char(30) NOT NULL COMMENT '审核管理员',
  PRIMARY KEY (`id`),
  KEY `trano` (`trano`),
  KEY `username` (`username`),
  KEY `uid` (`uid`),
  KEY `isauto` (`isauto`),
  KEY `oddtime` (`oddtime`),
  KEY `paytype` (`paytype`),
  KEY `sdtype` (`sdtype`)
) ENGINE=MyISAM AUTO_INCREMENT=281 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of caipiao_recharge
-- ----------------------------
INSERT INTO `caipiao_recharge` VALUES ('210', '8021', 'abc123', 'dinpay', '智付网银在线', 'N1706021042400339', '', '1000.00', '0.00', '1000.00', '0.00', '965.00', '1965.00', '', '', '0', '1', '0', '1', '1496371360', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('211', '8017', 'y123456', 'weixinvpay', '银宝微信在线支付', 'Y1706021042549730', '', '10000.00', '0.00', '10000.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1496371374', '');
INSERT INTO `caipiao_recharge` VALUES ('212', '8017', 'y123456', 'alipay', '支付宝自动到账', 'J1706021043122811', '', '10000.00', '0.00', '10000.00', '0.00', '42.10', '10042.10', '', '123456', '0', '1', '0', '1', '1496371392', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('213', '8021', 'abc123', 'dinpay', '智付网银在线', 'C1706041736350305', '', '50000.00', '0.00', '50000.00', '0.00', '1904.00', '51904.00', '', '', '0', '1', '0', '1', '1496568995', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('214', '8021', 'abc123', 'dinpay', '智付网银在线', 'G1706041739027798', '', '50000.00', '0.00', '50000.00', '0.00', '51904.00', '101904.00', '', '', '0', '1', '0', '1', '1496569143', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('215', '8021', 'abc123', 'dinpay', '智付网银在线', 'X1706041741043017', '', '10000000.00', '0.00', '10000000.00', '0.00', '101904.00', '10101904.00', '', '', '0', '1', '0', '1', '1496569264', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('216', '8020', 'zggcdyz', 'dinpay', '智付网银在线', 'V1706180051401850', '', '20000.00', '0.00', '20000.00', '0.00', '57964.62', '77964.62', '', '', '0', '1', '0', '1', '1497718300', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('217', '8021', 'abc123', 'dinpay', '智付网银在线', 'C1706182253542849', '', '1000.00', '0.00', '1000.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497797634', '');
INSERT INTO `caipiao_recharge` VALUES ('218', '8020', 'zggcdyz', 'dinpay', '智付网银在线', 'E1706182302484524', '', '1000.00', '0.00', '1000.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497798168', '');
INSERT INTO `caipiao_recharge` VALUES ('219', '8020', 'zggcdyz', 'dinpay', '智付网银在线', 'D1706182305320229', '', '122.00', '0.00', '122.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497798332', '');
INSERT INTO `caipiao_recharge` VALUES ('220', '8020', 'zggcdyz', 'dinpay', '智付网银在线', 'V1706182313182832', '', '122.00', '0.00', '122.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497798798', '');
INSERT INTO `caipiao_recharge` VALUES ('221', '8020', 'zggcdyz', 'dinpay', '智付网银在线', 'T1706182315202689', '', '122.00', '0.00', '122.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497798920', '');
INSERT INTO `caipiao_recharge` VALUES ('222', '8020', 'zggcdyz', 'alipayvpay', '银宝支付宝在线支付', 'G1706182315419759', '', '1000.00', '0.00', '1000.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497798941', '');
INSERT INTO `caipiao_recharge` VALUES ('223', '8020', 'zggcdyz', 'dinpay', '智付网银在线', 'P1706182316157136', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497798975', '');
INSERT INTO `caipiao_recharge` VALUES ('224', '8020', 'zggcdyz', 'dinpay', '多得宝网银在线', 'W1706182331550395', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497799915', '');
INSERT INTO `caipiao_recharge` VALUES ('225', '8020', 'zggcdyz', 'dinpay', '多得宝网银在线', 'E1706182333392567', '', '1000.00', '0.00', '1000.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497800019', '');
INSERT INTO `caipiao_recharge` VALUES ('226', '8020', 'zggcdyz', 'dinpay', '多得宝网银在线', 'B1706182335334231', '', '1000.00', '0.00', '1000.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497800133', '');
INSERT INTO `caipiao_recharge` VALUES ('227', '8020', 'zggcdyz', 'dinpay', '多得宝网银在线', 'Q1706182343523048', '', '1000.00', '0.00', '1000.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497800632', '');
INSERT INTO `caipiao_recharge` VALUES ('248', '8022', 'abc123t1', 'dinpay', '多得宝网银在线', 'P1706302033158260', '', '100.00', '0.00', '100.00', '0.00', '13482.00', '13582.00', '', '', '0', '1', '0', '1', '1498825995', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('229', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'C1706190024110582', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497803051', '');
INSERT INTO `caipiao_recharge` VALUES ('230', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'B1706190024486283', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497803088', '');
INSERT INTO `caipiao_recharge` VALUES ('231', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'Q1706190025144965', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497803114', '');
INSERT INTO `caipiao_recharge` VALUES ('232', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'Q1706190025452574', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497803145', '');
INSERT INTO `caipiao_recharge` VALUES ('233', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'I1706190026250922', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497803185', '');
INSERT INTO `caipiao_recharge` VALUES ('234', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'X1706190032472295', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497803567', '');
INSERT INTO `caipiao_recharge` VALUES ('235', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'A1706190043273209', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497804207', '');
INSERT INTO `caipiao_recharge` VALUES ('236', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'MCB1706202341265981', '', '50.00', '0.00', '50.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1497973286', '');
INSERT INTO `caipiao_recharge` VALUES ('237', '8023', 'abc123t2', 'dinpay', '多得宝网银在线', 'H1706280956000113', '', '10000.00', '0.00', '10000.00', '0.00', '0.00', '10000.00', '', '', '0', '1', '0', '1', '1498614960', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('249', '8022', 'abc123t1', 'dinpayweixin', '智付微信', 'W1706302033232789', '', '120.00', '0.00', '120.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1498826003', '');
INSERT INTO `caipiao_recharge` VALUES ('250', '8022', 'abc123t1', 'alipay', '支付宝自动到账', 'M1706302033343594', '', '130.00', '0.00', '130.00', '0.00', '13282.00', '13412.00', '', '1232', '0', '1', '0', '1', '1498826014', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('251', '8022', 'abc123t1', 'alipayvpay', '银宝支付宝在线支付', 'Y1706302033400143', '', '150.00', '0.00', '150.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1498826020', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('252', '8022', 'abc123t1', 'dinpay', '多得宝网银在线', 'J1707011001452948', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1498874505', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('253', '8023', 'abc123t2', 'dinpay', '多得宝网银在线', 'C1707011039116789', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1498876751', '');
INSERT INTO `caipiao_recharge` VALUES ('254', '8022', 'abc123t1', '', '', 'WLR1707011117080750', '', '1000.00', '0.00', '0.00', '0.00', '13582.00', '14582.00', '1000', '', '0', '2', '1', '1', '1498879028', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('255', '8021', 'abc123', '', '', 'ADE1707021719058265', '', '10000.00', '0.00', '0.00', '0.00', '45087.50', '55087.50', '手动充值增加', '', '0', '2', '1', '1', '1498987145', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('256', '8021', 'abc123', '', '', 'RLA1707021719437063', '', '700000.00', '0.00', '0.00', '0.00', '55087.50', '755087.50', '手动充值增加', '', '0', '2', '1', '1', '1498987183', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('257', '8023', 'abc123t2', 'alipay', '支付宝自动到账', 'K1707041404126953', '', '1000.00', '0.00', '1000.00', '0.00', '0.00', '0.00', '', '234234', '0', '1', '0', '-1', '1499148252', '');
INSERT INTO `caipiao_recharge` VALUES ('258', '8023', 'abc123t2', 'fourinone', '四合一（在线充值）', 'J1707041405042125', '', '1000.00', '0.00', '1000.00', '0.00', '0.00', '0.00', '', 'sadfasd', '0', '1', '0', '-1', '1499148304', '');
INSERT INTO `caipiao_recharge` VALUES ('259', '8021', 'abc123', 'fourinone', '四合一（在线充值）', 'F1707041638191989', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '12345', '0', '1', '0', '-1', '1499157499', '');
INSERT INTO `caipiao_recharge` VALUES ('260', '8021', 'abc123', 'fourinone', '四合一（在线充值）', 'H1707041641066916', '', '222.00', '0.00', '222.00', '0.00', '0.00', '0.00', '', 'sdfsdf', '0', '1', '0', '-1', '1499157666', '');
INSERT INTO `caipiao_recharge` VALUES ('261', '8021', 'abc123', 'fourinone', '四合一（在线充值）', 'Y1707041642209495', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '234234', '0', '1', '0', '-1', '1499157740', '');
INSERT INTO `caipiao_recharge` VALUES ('262', '8021', 'abc123', 'fourinone', '四合一（在线充值）', 'Q1707041642528968', '', '2344.00', '0.00', '2344.00', '0.00', '0.00', '0.00', '', '123', '0', '1', '0', '-1', '1499157772', '');
INSERT INTO `caipiao_recharge` VALUES ('263', '8021', 'abc123', 'fourinone', '四合一（在线充值）', 'Z1707041657520646', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', 'ssdf', '0', '1', '0', '-1', '1499158672', '');
INSERT INTO `caipiao_recharge` VALUES ('264', '8021', 'abc123', 'fourinone', '四合一（在线充值）', 'C1707041658365039', '', '500.00', '0.00', '500.00', '0.00', '0.00', '0.00', '', '12323', '0', '1', '0', '-1', '1499158716', '');
INSERT INTO `caipiao_recharge` VALUES ('265', '8021', 'abc123', 'alipay', '支付宝自动到账', 'I1707041659065116', '', '2342.00', '0.00', '2342.00', '0.00', '0.00', '0.00', '', '123123', '0', '1', '0', '-1', '1499158746', '');
INSERT INTO `caipiao_recharge` VALUES ('266', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'E1707041719279115', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '', '0', '1', '0', '-1', '1499159967', '');
INSERT INTO `caipiao_recharge` VALUES ('267', '8021', 'abc123', 'fourinone', '四合一（在线充值）', 'Y1707041719539456', '', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '', '12345', '0', '1', '0', '-1', '1499159993', '');
INSERT INTO `caipiao_recharge` VALUES ('268', '8021', 'abc123', 'fourinone', '四合一（在线充值）', 'X1707041733531644', '', '50.00', '0.00', '50.00', '0.00', '0.00', '0.00', '', '1231', '0', '1', '0', '-1', '1499160833', '');
INSERT INTO `caipiao_recharge` VALUES ('269', '8021', 'abc123', 'alipay', '支付宝自动到账', 'D1707041734281978', '', '1000.00', '0.00', '1000.00', '0.00', '0.00', '0.00', '', '123', '0', '1', '0', '-1', '1499160868', '');
INSERT INTO `caipiao_recharge` VALUES ('270', '8021', 'abc123', 'alipay', '支付宝自动到账', 'B1707041744400942', '', '100.00', '0.00', '100.00', '0.00', '757779.05', '757879.05', '', '11', '0', '1', '0', '1', '1499161480', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('271', '8021', 'abc123', 'alipay', '支付宝自动到账', 'L1707041802282680', '', '2342.00', '0.00', '2342.00', '0.00', '754968.65', '757310.65', '', '123', '0', '1', '0', '1', '1499162548', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('272', '8021', 'abc123', 'dinpay', '多得宝网银在线', 'W1707050939499928', '', '1000.00', '0.00', '1000.00', '0.00', '753868.65', '754868.65', '', '', '0', '1', '0', '1', '1499218789', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('273', '8022', 'abc123t1', 'dinpay', '多得宝网银在线', 'W1707051002120552', '', '1000.00', '0.00', '1000.00', '0.00', '14552.00', '15552.00', '', '', '0', '1', '0', '1', '1499220132', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('274', '8022', 'abc123t1', 'dinpay', '多得宝网银在线', 'F1707051004138394', '', '1000.00', '0.00', '1000.00', '0.00', '15652.00', '16652.00', '', '', '0', '1', '0', '1', '1499220253', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('275', '8022', 'abc123t1', 'dinpay', '多得宝网银在线', 'E1707051017211629', '', '1000.00', '0.00', '1000.00', '0.00', '16752.00', '17752.00', '', '', '0', '1', '0', '1', '1499221041', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('276', '8022', 'abc123t1', 'fourinone', '四合一（在线充值）', 'E1707051018086193', '', '1000.00', '0.00', '1000.00', '0.00', '17852.00', '18852.00', '', '123123', '0', '1', '0', '1', '1499221088', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('277', '8022', 'abc123t1', 'dinpay', '多得宝网银在线', 'M1707051021498922', '', '1000.00', '0.00', '1000.00', '0.00', '18952.00', '19952.00', '', '', '0', '1', '0', '1', '1499221309', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('278', '8022', 'abc123t1', 'dinpay', '多得宝网银在线', 'Z1707051239195494', '', '50000.00', '0.00', '50000.00', '0.00', '20052.00', '70052.00', '', '', '0', '1', '0', '1', '1499229559', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('279', '8067', 'abc123', '', '', 'LZF1707072042457964', '', '50000000.00', '0.00', '0.00', '0.00', '0.00', '50000000.00', '手动充值增加', '', '0', '2', '1', '1', '1499431365', 'administrator');
INSERT INTO `caipiao_recharge` VALUES ('280', '8070', 'abc123t01', '', '', 'DHG1707081303212793', '', '50000000.00', '0.00', '0.00', '0.00', '0.00', '50000000.00', '手动充值增加', '', '0', '2', '1', '1', '1499490201', 'administrator');

-- ----------------------------
-- Table structure for `caipiao_setting`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_setting`;
CREATE TABLE `caipiao_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_setting
-- ----------------------------
INSERT INTO `caipiao_setting` VALUES ('1', 'webtitle', '彩票平台1');
INSERT INTO `caipiao_setting` VALUES ('2', 'keywords', '彩票娱乐平台');
INSERT INTO `caipiao_setting` VALUES ('3', 'description', '彩票娱乐平台');
INSERT INTO `caipiao_setting` VALUES ('4', 'iskillorder', '1');
INSERT INTO `caipiao_setting` VALUES ('5', 'sysBankMaxNum', '5');
INSERT INTO `caipiao_setting` VALUES ('6', 'damaliang', '50');
INSERT INTO `caipiao_setting` VALUES ('7', 'tikuanMin', '100');
INSERT INTO `caipiao_setting` VALUES ('8', 'tikuanMax', '50000');
INSERT INTO `caipiao_setting` VALUES ('9', 'ritikuanxiane', '1000000');
INSERT INTO `caipiao_setting` VALUES ('10', 'tikuanstart', '18:00');
INSERT INTO `caipiao_setting` VALUES ('11', 'tikuanend', '23:55');
INSERT INTO `caipiao_setting` VALUES ('12', 'tikuannum', '2');
INSERT INTO `caipiao_setting` VALUES ('13', 'tikuannumoverbilv', '20');
INSERT INTO `caipiao_setting` VALUES ('14', 'tikuannumovermin', '10');
INSERT INTO `caipiao_setting` VALUES ('15', 'tikuannumovermax', '100');
INSERT INTO `caipiao_setting` VALUES ('16', 'paiduinum', '5');
INSERT INTO `caipiao_setting` VALUES ('17', 'pointchongzhi', '1');
INSERT INTO `caipiao_setting` VALUES ('18', 'pointchongzhiadd', '1');
INSERT INTO `caipiao_setting` VALUES ('19', 'pointtouzhu', '1');
INSERT INTO `caipiao_setting` VALUES ('20', 'pointtouzhuadd', '1');
INSERT INTO `caipiao_setting` VALUES ('21', 'pointhuisun', '1');
INSERT INTO `caipiao_setting` VALUES ('22', 'pointhuisunadd', '1');
INSERT INTO `caipiao_setting` VALUES ('23', 'kefuthree', 'http://wpa.qq.com/msgrd?v=3&uin=123456&site=qq&menu=yes');
INSERT INTO `caipiao_setting` VALUES ('24', 'bindcardamount', '5');
INSERT INTO `caipiao_setting` VALUES ('25', 'newmemberrecharge', '1000');
INSERT INTO `caipiao_setting` VALUES ('26', 'newmemberrechargeamount', '0');
INSERT INTO `caipiao_setting` VALUES ('27', 'activity_cz0_money', '1~1000');
INSERT INTO `caipiao_setting` VALUES ('28', 'activity_cz0_zsmoney', '10');
INSERT INTO `caipiao_setting` VALUES ('29', 'activity_cz1_money', '1000~10000');
INSERT INTO `caipiao_setting` VALUES ('30', 'activity_cz1_zsmoney', '20');
INSERT INTO `caipiao_setting` VALUES ('31', 'activity_cz2_money', '10000~100000');
INSERT INTO `caipiao_setting` VALUES ('32', 'activity_cz2_zsmoney', '0');
INSERT INTO `caipiao_setting` VALUES ('33', 'riCommissionBase0_0', '100~1000');
INSERT INTO `caipiao_setting` VALUES ('34', 'riCommissionBase0_1', '0.09');
INSERT INTO `caipiao_setting` VALUES ('35', 'riCommissionBase0_2', '0.05');
INSERT INTO `caipiao_setting` VALUES ('36', 'riCommissionBase1_0', '1000~10000');
INSERT INTO `caipiao_setting` VALUES ('37', 'riCommissionBase1_1', '0.09');
INSERT INTO `caipiao_setting` VALUES ('38', 'riCommissionBase1_2', '0.06');
INSERT INTO `caipiao_setting` VALUES ('39', 'riCommissionBase2_0', '10000~100000');
INSERT INTO `caipiao_setting` VALUES ('40', 'riCommissionBase2_1', '0.15');
INSERT INTO `caipiao_setting` VALUES ('41', 'riCommissionBase2_2', '0.1');
INSERT INTO `caipiao_setting` VALUES ('42', 'yueCommissionBase0_0', '1000~10000');
INSERT INTO `caipiao_setting` VALUES ('43', 'yueCommissionBase0_1', '0.8');
INSERT INTO `caipiao_setting` VALUES ('44', 'yueCommissionBase0_2', '0.05');
INSERT INTO `caipiao_setting` VALUES ('45', 'yueCommissionBase1_0', '10000~100000');
INSERT INTO `caipiao_setting` VALUES ('46', 'yueCommissionBase1_1', '0.09');
INSERT INTO `caipiao_setting` VALUES ('47', 'yueCommissionBase1_2', '0.06');
INSERT INTO `caipiao_setting` VALUES ('48', 'yueCommissionBase2_0', '100000~1000000');
INSERT INTO `caipiao_setting` VALUES ('49', 'yueCommissionBase2_1', '0.15');
INSERT INTO `caipiao_setting` VALUES ('50', 'yueCommissionBase2_2', '0.1');
INSERT INTO `caipiao_setting` VALUES ('51', 'riKuisunBase0_0', '100~1000');
INSERT INTO `caipiao_setting` VALUES ('52', 'riKuisunBase0_1', '0.08');
INSERT INTO `caipiao_setting` VALUES ('53', 'riKuisunBase0_2', '0.05');
INSERT INTO `caipiao_setting` VALUES ('54', 'riKuisunBase1_0', '1000~10000');
INSERT INTO `caipiao_setting` VALUES ('55', 'riKuisunBase1_1', '0.09');
INSERT INTO `caipiao_setting` VALUES ('56', 'riKuisunBase1_2', '0.06');
INSERT INTO `caipiao_setting` VALUES ('57', 'riKuisunBase2_0', '10000~100000');
INSERT INTO `caipiao_setting` VALUES ('58', 'riKuisunBase2_1', '0.15');
INSERT INTO `caipiao_setting` VALUES ('59', 'riKuisunBase2_2', '0.1');
INSERT INTO `caipiao_setting` VALUES ('60', 'yueKuisunBase0_0', '100~10000');
INSERT INTO `caipiao_setting` VALUES ('61', 'yueKuisunBase0_1', '0.08');
INSERT INTO `caipiao_setting` VALUES ('62', 'yueKuisunBase0_2', '0.05');
INSERT INTO `caipiao_setting` VALUES ('63', 'yueKuisunBase1_0', '10000~100000');
INSERT INTO `caipiao_setting` VALUES ('64', 'yueKuisunBase1_1', '0.09');
INSERT INTO `caipiao_setting` VALUES ('65', 'yueKuisunBase1_2', '0.06');
INSERT INTO `caipiao_setting` VALUES ('66', 'yueKuisunBase2_0', '100000~1000000');
INSERT INTO `caipiao_setting` VALUES ('67', 'yueKuisunBase2_1', '0.16');
INSERT INTO `caipiao_setting` VALUES ('68', 'yueKuisunBase2_2', '0.1');
INSERT INTO `caipiao_setting` VALUES ('69', 'agentBonusBase0_0', '100~10000');
INSERT INTO `caipiao_setting` VALUES ('70', 'agentBonusBase0_1', '0.1');
INSERT INTO `caipiao_setting` VALUES ('71', 'agentBonusBase1_0', '10000~10000');
INSERT INTO `caipiao_setting` VALUES ('72', 'agentBonusBase1_1', '0.2');
INSERT INTO `caipiao_setting` VALUES ('73', 'agentBonusBase2_0', '10000~100000');
INSERT INTO `caipiao_setting` VALUES ('74', 'agentBonusBase2_1', '0.3');
INSERT INTO `caipiao_setting` VALUES ('75', 'agentBonusBase3_0', '100000~1000000');
INSERT INTO `caipiao_setting` VALUES ('76', 'agentBonusBase3_1', '0.5');
INSERT INTO `caipiao_setting` VALUES ('77', 'loginerrornum', '3');
INSERT INTO `caipiao_setting` VALUES ('78', 'loginerrorclosetime', '1');
INSERT INTO `caipiao_setting` VALUES ('79', 'islogincode', '0');
INSERT INTO `caipiao_setting` VALUES ('80', 'isemailcode', '0');
INSERT INTO `caipiao_setting` VALUES ('81', 'adminemailcodetime', '180');
INSERT INTO `caipiao_setting` VALUES ('82', 'getemailcode', '123456@qq.com');
INSERT INTO `caipiao_setting` VALUES ('83', 'loginerrornum_q', '6');
INSERT INTO `caipiao_setting` VALUES ('84', 'loginerrorclosetime_q', '24');
INSERT INTO `caipiao_setting` VALUES ('85', 'SMTP_HOST', 'smtp.163.com');
INSERT INTO `caipiao_setting` VALUES ('86', 'SMTP_SSL', '1');
INSERT INTO `caipiao_setting` VALUES ('87', 'SMTP_PORT', '25');
INSERT INTO `caipiao_setting` VALUES ('88', 'FROM_EMAIL', '15015170856@163.com');
INSERT INTO `caipiao_setting` VALUES ('89', 'SMTP_USER', '15015170856@163.com');
INSERT INTO `caipiao_setting` VALUES ('90', 'FROM_NAME', '幸运彩');
INSERT INTO `caipiao_setting` VALUES ('91', 'REPLY_EMAIL', '15015170856@163.com');
INSERT INTO `caipiao_setting` VALUES ('92', 'REPLY_NAME', '幸运彩');
INSERT INTO `caipiao_setting` VALUES ('93', 'SMTP_PASS', 'zggcdyz123456');
INSERT INTO `caipiao_setting` VALUES ('94', 'dbnizationapiurl', 'http://127.0.0.58/');
INSERT INTO `caipiao_setting` VALUES ('95', 'dbnizationips', '');
INSERT INTO `caipiao_setting` VALUES ('96', 'caijieapiurl', 'http://zzcj.com');
INSERT INTO `caipiao_setting` VALUES ('97', 'weballowips', '');
INSERT INTO `caipiao_setting` VALUES ('98', 'caijiset', 'a:26:{s:5:\"cqssc\";s:1:\"1\";s:5:\"xjssc\";s:1:\"1\";s:5:\"tjssc\";s:1:\"1\";s:5:\"dfssc\";s:1:\"1\";s:4:\"jlk3\";s:1:\"1\";s:4:\"f5k3\";s:1:\"1\";s:4:\"f1k3\";s:1:\"1\";s:4:\"jxk3\";s:1:\"1\";s:5:\"nmgk3\";s:1:\"1\";s:5:\"hebk3\";s:1:\"1\";s:4:\"shk3\";s:1:\"1\";s:4:\"ahk3\";s:1:\"1\";s:4:\"gxk3\";s:1:\"1\";s:5:\"hubk3\";s:1:\"1\";s:4:\"jsk3\";s:1:\"1\";s:4:\"bjk3\";s:1:\"1\";s:4:\"ffk3\";s:1:\"1\";s:6:\"gd11x5\";s:1:\"1\";s:6:\"sh11x5\";s:1:\"1\";s:6:\"sd11x5\";s:1:\"1\";s:6:\"jx11x5\";s:1:\"1\";s:6:\"df11x5\";s:1:\"1\";s:6:\"bjkeno\";s:1:\"1\";s:6:\"bjpk10\";s:1:\"1\";s:4:\"fc3d\";s:1:\"1\";s:3:\"pl3\";s:1:\"1\";}');
INSERT INTO `caipiao_setting` VALUES ('99', 'ipblackisopen', '0');
INSERT INTO `caipiao_setting` VALUES ('100', 'ipblacklist', '127.0.0.1,127.0.0.2');
INSERT INTO `caipiao_setting` VALUES ('101', 'ipwhiteisopen', '0');
INSERT INTO `caipiao_setting` VALUES ('102', 'ipwhitelist', '');
INSERT INTO `caipiao_setting` VALUES ('103', 'jihua_rixiaofei_shi', '0');
INSERT INTO `caipiao_setting` VALUES ('104', 'jihua_rixiaofei_fen', '1');
INSERT INTO `caipiao_setting` VALUES ('105', 'jihua_rikuisun_shi', '0');
INSERT INTO `caipiao_setting` VALUES ('106', 'jihua_rikuisun_fen', '1');
INSERT INTO `caipiao_setting` VALUES ('107', 'jihua_yuexiaofei_shi', '0');
INSERT INTO `caipiao_setting` VALUES ('108', 'jihua_yuexiaofei_fen', '1');
INSERT INTO `caipiao_setting` VALUES ('109', 'jihua_yuekuisun_shi', '0');
INSERT INTO `caipiao_setting` VALUES ('110', 'jihua_yuekuisun_fen', '1');
INSERT INTO `caipiao_setting` VALUES ('111', 'jihua_dailifandian_shi', '0');
INSERT INTO `caipiao_setting` VALUES ('112', 'jihua_dailifandian_fen', '1');
INSERT INTO `caipiao_setting` VALUES ('113', 'jihua_kaijiang_days', '1');
INSERT INTO `caipiao_setting` VALUES ('114', 'jihua_touzhu_days', '45');
INSERT INTO `caipiao_setting` VALUES ('115', 'jihua_fuddetail_days', '45');
INSERT INTO `caipiao_setting` VALUES ('116', 'jihua_memlog_days', '7');
INSERT INTO `caipiao_setting` VALUES ('117', 'jihua_adminlog_days', '7');
INSERT INTO `caipiao_setting` VALUES ('118', 'pointexchangeamount', '1000');
INSERT INTO `caipiao_setting` VALUES ('119', 'kefuqq', '123456123');
INSERT INTO `caipiao_setting` VALUES ('120', 'newmemberrecharge1', '1~1000');
INSERT INTO `caipiao_setting` VALUES ('121', 'newmemberrechargeamount1', '1');
INSERT INTO `caipiao_setting` VALUES ('122', 'newmemberrecharge2', '1000~10000');
INSERT INTO `caipiao_setting` VALUES ('123', 'newmemberrechargeamount2', '2');
INSERT INTO `caipiao_setting` VALUES ('124', 'newmemberrecharge3', '10000~100000');
INSERT INTO `caipiao_setting` VALUES ('125', 'newmemberrechargeamount3', '3');
INSERT INTO `caipiao_setting` VALUES ('126', 'defaulttjcode', '8000');
INSERT INTO `caipiao_setting` VALUES ('127', 'newmemberrecharge4', '100000~1000000');
INSERT INTO `caipiao_setting` VALUES ('128', 'newmemberrechargeamount4', '4');
INSERT INTO `caipiao_setting` VALUES ('129', 'newmemberrecharge5', '1000000~10000000');
INSERT INTO `caipiao_setting` VALUES ('130', 'newmemberrechargeamount5', '5');
INSERT INTO `caipiao_setting` VALUES ('131', 'activity_cz3_money', '100000~1000000');
INSERT INTO `caipiao_setting` VALUES ('132', 'activity_cz3_zsmoney', '40');
INSERT INTO `caipiao_setting` VALUES ('133', 'activity_cz4_money', '1000000~10000000');
INSERT INTO `caipiao_setting` VALUES ('134', 'activity_cz4_zsmoney', '50');
INSERT INTO `caipiao_setting` VALUES ('135', 'czaudioplay', '1');
INSERT INTO `caipiao_setting` VALUES ('136', 'czaudioplaytime', '10');
INSERT INTO `caipiao_setting` VALUES ('137', 'czaudioqxtime', '1440');
INSERT INTO `caipiao_setting` VALUES ('138', 'tkaudioplay', '1');
INSERT INTO `caipiao_setting` VALUES ('139', 'tkaudioplaytime', '5');
INSERT INTO `caipiao_setting` VALUES ('140', 'cardaudioplay', '1');
INSERT INTO `caipiao_setting` VALUES ('141', 'cardaudioplaytime', '12');
INSERT INTO `caipiao_setting` VALUES ('142', 'riCommissionBase3_0', '');
INSERT INTO `caipiao_setting` VALUES ('143', 'riCommissionBase3_1', '0');
INSERT INTO `caipiao_setting` VALUES ('144', 'riCommissionBase3_2', '0');
INSERT INTO `caipiao_setting` VALUES ('145', 'riCommissionBase4_0', '');
INSERT INTO `caipiao_setting` VALUES ('146', 'riCommissionBase4_1', '0');
INSERT INTO `caipiao_setting` VALUES ('147', 'riCommissionBase4_2', '0');
INSERT INTO `caipiao_setting` VALUES ('148', 'chongzhiMin', '100');
INSERT INTO `caipiao_setting` VALUES ('149', 'chongzhiMax', '50000');
INSERT INTO `caipiao_setting` VALUES ('150', 'caijiset', 'a:26:{s:5:\"cqssc\";s:1:\"1\";s:5:\"xjssc\";s:1:\"1\";s:5:\"tjssc\";s:1:\"1\";s:5:\"dfssc\";s:1:\"1\";s:4:\"jlk3\";s:1:\"1\";s:4:\"f5k3\";s:1:\"1\";s:4:\"f1k3\";s:1:\"1\";s:4:\"jxk3\";s:1:\"1\";s:5:\"nmgk3\";s:1:\"1\";s:5:\"hebk3\";s:1:\"1\";s:4:\"shk3\";s:1:\"1\";s:4:\"ahk3\";s:1:\"1\";s:4:\"gxk3\";s:1:\"1\";s:5:\"hubk3\";s:1:\"1\";s:4:\"jsk3\";s:1:\"1\";s:4:\"bjk3\";s:1:\"1\";s:4:\"ffk3\";s:1:\"1\";s:6:\"gd11x5\";s:1:\"1\";s:6:\"sh11x5\";s:1:\"1\";s:6:\"sd11x5\";s:1:\"1\";s:6:\"jx11x5\";s:1:\"1\";s:6:\"df11x5\";s:1:\"1\";s:6:\"bjkeno\";s:1:\"1\";s:6:\"bjpk10\";s:1:\"1\";s:4:\"fc3d\";s:1:\"1\";s:3:\"pl3\";s:1:\"1\";}');
INSERT INTO `caipiao_setting` VALUES ('151', 'fanDianMax', '7.5');
INSERT INTO `caipiao_setting` VALUES ('152', 'fanDianMin', '0.0');
INSERT INTO `caipiao_setting` VALUES ('153', 'webisopen', '0');
INSERT INTO `caipiao_setting` VALUES ('154', 'webcloseinfo', '网站维护...');

-- ----------------------------
-- Table structure for `caipiao_sysbank`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_sysbank`;
CREATE TABLE `caipiao_sysbank` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `bankcode` char(15) NOT NULL COMMENT '银行代码',
  `bankname` varchar(60) NOT NULL COMMENT '银行名称',
  `banklogo` char(120) NOT NULL COMMENT '银行LOGO',
  `state` tinyint(4) NOT NULL DEFAULT '1',
  `listorder` smallint(6) NOT NULL,
  `imgbg` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_sysbank
-- ----------------------------
INSERT INTO `caipiao_sysbank` VALUES ('1', '00015', '建设银行', 'jianshe.gif', '1', '1', 'CBC');
INSERT INTO `caipiao_sysbank` VALUES ('2', '00016', '兴业银行', 'xingye.gif', '1', '2', 'CIB');
INSERT INTO `caipiao_sysbank` VALUES ('3', '00017', '农业银行', 'nongye.gif', '1', '3', 'ABOC');
INSERT INTO `caipiao_sysbank` VALUES ('4', '00018', '工商银行', 'gongshang.gif', '1', '4', 'ICBC');
INSERT INTO `caipiao_sysbank` VALUES ('5', '00041', '华夏银行', 'huaxia.gif', '1', '5', null);
INSERT INTO `caipiao_sysbank` VALUES ('6', '00050', '北京银行', 'beijing.gif', '1', '6', null);
INSERT INTO `caipiao_sysbank` VALUES ('7', '00051', '中国邮政', 'youzheng.gif', '1', '7', 'CP');
INSERT INTO `caipiao_sysbank` VALUES ('8', '00054', '中信银行', 'zhongxin.gif', '1', '8', 'CCB');
INSERT INTO `caipiao_sysbank` VALUES ('9', '00055', '南京银行', 'nanjing.gif', '1', '9', null);
INSERT INTO `caipiao_sysbank` VALUES ('10', '00083', '中国银行', 'zhongguo.gif', '1', '10', 'BC');
INSERT INTO `caipiao_sysbank` VALUES ('11', '00084', '上海银行', 'shanghaibank.gif', '1', '11', null);
INSERT INTO `caipiao_sysbank` VALUES ('12', '00085', '宁波银行', 'ningbo.gif', '1', '12', null);
INSERT INTO `caipiao_sysbank` VALUES ('13', '00086', '浙商银行', 'zheshang.gif', '1', '13', null);
INSERT INTO `caipiao_sysbank` VALUES ('14', '00087', '平安银行', 'pingan.gif', '1', '14', 'PING');
INSERT INTO `caipiao_sysbank` VALUES ('15', '00095', '渤海银行', 'bohai.gif', '1', '15', null);
INSERT INTO `caipiao_sysbank` VALUES ('16', '00032', '上海浦东发展银行', 'shangpufa.gif', '1', '16', null);
INSERT INTO `caipiao_sysbank` VALUES ('17', '00056', '北京农村商业银行', 'bjrcbnet.gif', '1', '17', null);
INSERT INTO `caipiao_sysbank` VALUES ('18', '00052', '广东发展银行', 'guangfa.gif', '1', '18', null);
INSERT INTO `caipiao_sysbank` VALUES ('19', '00000', '招商银行', 'zhaoshang-logo.gif', '1', '19', 'CMBC');
INSERT INTO `caipiao_sysbank` VALUES ('20', '00005', '交通银行', 'jiaotong.gif', '1', '20', 'JIAO');
INSERT INTO `caipiao_sysbank` VALUES ('21', '00013', '民生银行', 'minsheng.gif', '1', '21', 'CMSB');
INSERT INTO `caipiao_sysbank` VALUES ('22', '90002', '微信支付', 'weixin.gif', '1', '22', null);
INSERT INTO `caipiao_sysbank` VALUES ('23', '90002', '支付宝', 'alipay.gif', '1', '23', null);

-- ----------------------------
-- Table structure for `caipiao_touzhu`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_touzhu`;
CREATE TABLE `caipiao_touzhu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isdraw` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未开 1中 -1未中 -2撤单',
  `trano` char(60) NOT NULL COMMENT '单号',
  `yjf` char(10) NOT NULL COMMENT '1元 0.1 角 0.01分 0.001厘',
  `typeid` char(20) NOT NULL COMMENT '彩票种类',
  `playid` char(30) NOT NULL COMMENT '玩法标识',
  `playtitle` varchar(60) NOT NULL COMMENT '玩法名称',
  `cptitle` varchar(30) NOT NULL COMMENT '彩票标题',
  `cpname` varchar(60) NOT NULL COMMENT '彩票名称',
  `expect` char(25) NOT NULL COMMENT '期号',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `username` char(60) NOT NULL COMMENT '会员昵称',
  `itemcount` int(11) NOT NULL COMMENT '投注注数',
  `beishu` smallint(6) NOT NULL DEFAULT '1' COMMENT '倍数',
  `tzcode` longtext NOT NULL COMMENT '投注号码',
  `repoint` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '返点比例',
  `repointamout` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '返点金额',
  `mode` decimal(10,2) NOT NULL COMMENT '奖金',
  `amount` decimal(20,2) NOT NULL COMMENT '投注金额',
  `amountbefor` decimal(14,4) NOT NULL COMMENT '投注前金额',
  `amountafter` decimal(14,4) NOT NULL COMMENT '投注后金额',
  `okamount` decimal(20,2) NOT NULL COMMENT '可盈金额',
  `okcount` smallint(6) NOT NULL COMMENT '中奖注数',
  `Chase` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1追号 0不是',
  `stopChase` tinyint(4) NOT NULL COMMENT '是否中奖停止追号 1是',
  `oddtime` int(11) NOT NULL COMMENT '投注时间',
  `opencode` char(20) NOT NULL COMMENT '开奖号码',
  `source` char(20) NOT NULL COMMENT 'pc,mobile',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `username` (`username`),
  KEY `trano` (`trano`),
  KEY `isdraw` (`isdraw`),
  KEY `typeid` (`typeid`),
  KEY `playid` (`playid`),
  KEY `cpname` (`cpname`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='投注管理';

-- ----------------------------
-- Records of caipiao_touzhu
-- ----------------------------
INSERT INTO `caipiao_touzhu` VALUES ('1', '0', 'R1707081303448', '1', 'ssc', 'wxzhixfs', '五星复式', '重庆时时彩', 'cqssc', '20170708045', '8070', 'abc123t01', '100000', '1', '0,1,2,3,4,5,6,7,8,9|0,1,2,3,4,5,6,7,8,9|0,1,2,3,4,5,6,7,8,9|0,1,2,3,4,5,6,7,8,9|0,1,2,3,4,5,6,7,8,9', '0.00', '0.00', '180000.00', '200000.00', '50000000.0000', '49800000.0000', '0.00', '0', '0', '0', '1499490224', '', 'pc');

-- ----------------------------
-- Table structure for `caipiao_wanfa`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_wanfa`;
CREATE TABLE `caipiao_wanfa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `typeid` char(30) NOT NULL,
  `playid` char(30) NOT NULL,
  `totalzs` int(11) NOT NULL COMMENT '总注数',
  `maxjj` decimal(10,2) NOT NULL COMMENT '最高奖金',
  `minjj` decimal(10,2) NOT NULL COMMENT '最低奖金',
  `rate` decimal(12,2) NOT NULL COMMENT '赔率',
  `maxzs` int(6) NOT NULL DEFAULT '0' COMMENT '最高注数',
  `minxf` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '最低消费',
  `maxxf` decimal(10,2) NOT NULL DEFAULT '10000.00' COMMENT '最大投注金额',
  `maxprize` decimal(12,2) NOT NULL,
  `remark` text NOT NULL,
  `isopen` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1开启 0关闭',
  PRIMARY KEY (`id`),
  KEY `typeid` (`typeid`),
  KEY `playid` (`playid`)
) ENGINE=MyISAM AUTO_INCREMENT=3504 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of caipiao_wanfa
-- ----------------------------
INSERT INTO `caipiao_wanfa` VALUES ('1', '五星复式', 'ssc', 'wxzhixfs', '100000', '195000.00', '180000.00', '0.00', '100000', '1.00', '200000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('2', '五星单式', 'ssc', 'wxzhixds', '100000', '195000.00', '180000.00', '0.00', '100000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('3', '组选120', 'ssc', 'wxzxyel', '252', '1625.00', '1500.00', '0.00', '252', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('4', '龙虎十个', 'ssc', 'lhsg', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('5', '龙虎百个', 'ssc', 'lhbg', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('6', '龙虎百十', 'ssc', 'lhbs', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('7', '龙虎千个', 'ssc', 'lhqg', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('8', '龙虎千十', 'ssc', 'lhqs', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('9', '龙虎千百', 'ssc', 'lhqb', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('10', '龙虎万个', 'ssc', 'lhwg', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('11', '龙虎万十', 'ssc', 'lhws', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('12', '龙虎万百', 'ssc', 'lhwb', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('13', '龙虎万千', 'ssc', 'lhwq', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('14', '四季发财', 'ssc', 'qwsjfc', '10', '4239.13', '3913.04', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('15', '三星报喜', 'ssc', 'qwsxbx', '10', '227.80', '210.28', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('16', '好事成双', 'ssc', 'qwhscs', '10', '23.93', '22.09', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('17', '一帆风顺', 'ssc', 'qwyffs', '10', '4.76', '4.39', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('18', '后三和尾', 'ssc', 'hzwshs', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('19', '中三和尾', 'ssc', 'hzwszs', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('20', '前三和尾', 'ssc', 'hzwsqs', '0', '1930.00', '1700.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('21', '后三组选和值', 'ssc', 'zuxhzhs', '210', '324.99', '300.00', '0.00', '210', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('22', '中三组选和值', 'ssc', 'zuxhzzs', '210', '324.99', '300.00', '0.00', '210', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('23', '前三组选和值', 'ssc', 'zuxhzqs', '210', '324.99', '300.00', '0.00', '210', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('24', '后二直选和值', 'ssc', 'zhixhzhe', '100', '195.00', '180.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('25', '前二直选和值', 'ssc', 'zhixhzqe', '100', '195.00', '180.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('26', '后三直选和值', 'ssc', 'zhixhzhs', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('27', '中三直选和值', 'ssc', 'zhixhzzs', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('28', '前三直选和值', 'ssc', 'zhixhzqs', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('29', '后二大小单双', 'ssc', 'dxdshe', '16', '7.80', '7.20', '0.00', '16', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('30', '前二大小单双', 'ssc', 'dxdsqe', '16', '7.80', '7.20', '0.00', '16', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('31', '任二组选', 'ssc', 'rx2zx', '100', '196.00', '170.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('32', '任二单式', 'ssc', 'rx2ds', '100', '0.00', '0.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('33', '任二复式', 'ssc', 'rx2fs', '100', '196.00', '170.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('34', '任三混合', 'ssc', 'rx3zxhh', '100', '196.00', '170.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('35', '任三组六', 'ssc', 'rx3z6', '100', '196.00', '170.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('36', '任三组三', 'ssc', 'rx3z3', '100', '196.00', '170.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('37', '任三单式', 'ssc', 'rx3ds', '170', '196.00', '170.00', '0.00', '170', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('38', '任三复式', 'ssc', 'rx3fs', '0', '0.00', '0.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('39', '任四单式', 'ssc', 'rx4ds', '0', '0.00', '0.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('40', '任四复式', 'ssc', 'rx4fs', '0', '0.00', '0.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('41', '后二跨度', 'ssc', 'kuaduhe', '100', '195.00', '180.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('42', '前二跨度', 'ssc', 'kuaduqe', '100', '195.00', '180.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('43', '后三跨度', 'ssc', 'kuaduhs', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('44', '中三跨度', 'ssc', 'kuaduzs', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('45', '前三跨度', 'ssc', 'kuaduqs', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('46', '三码计重', 'ssc', 'bdw3mjc', '10', '3.30', '3.30', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('47', '二码计重', 'ssc', 'bdw2mjc', '10', '3.30', '3.30', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('48', '五星三码不定位', 'ssc', 'bdw5x3m', '120', '44.82', '41.37', '0.00', '120', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('49', '五星二码不定位', 'ssc', 'bdw5x2m', '45', '13.29', '12.26', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('50', '五星一码不定位', 'ssc', 'bdw5x1m', '10', '4.76', '4.39', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('51', '后三不定位', 'ssc', 'bdwhs', '10', '7.19', '6.64', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('52', '中三不定位', 'ssc', 'bdwzs', '10', '7.19', '6.64', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('53', '前三不定位', 'ssc', 'bdwqs', '10', '7.19', '6.64', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('54', '一星复式', 'ssc', 'dweid', '50', '19.50', '18.00', '0.00', '50', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('55', '后二组选单式', 'ssc', 'exzuxdsh', '45', '97.50', '90.00', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('56', '后二组选复式', 'ssc', 'exzuxfsh', '45', '97.50', '90.00', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('57', '前二组选单式', 'ssc', 'exzuxdsq', '45', '97.50', '90.00', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('58', '前二组选复式', 'ssc', 'exzuxfsq', '45', '97.50', '90.00', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('59', '后二直选单式', 'ssc', 'exzhixdsh', '100', '195.00', '180.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('60', '后二直选复式', 'ssc', 'exzhixfsh', '100', '195.00', '180.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('61', '前二直选单式', 'ssc', 'exzhixdsq', '100', '195.00', '180.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('62', '前二直选复式', 'ssc', 'exzhixfsq', '100', '195.00', '180.00', '0.00', '100', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('63', '后三混合组选', 'ssc', 'sxhhzxh', '1000', '324.99', '300.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('64', '后三组六胆拖', 'ssc', 'sxzuxzldth', '1000', '1960.00', '1700.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('65', '后三组六', 'ssc', 'sxzuxzlh', '120', '324.99', '300.00', '0.00', '120', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('66', '组三胆拖', 'ssc', 'sxzuxzsdth', '1000', '1960.00', '1700.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('67', '后三组三', 'ssc', 'sxzuxzsh', '90', '649.99', '600.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('68', '后三单式', 'ssc', 'sxzhixdsh', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('69', '后三复式', 'ssc', 'sxzhixfsh', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('70', '混合组选', 'ssc', 'sxhhzxz', '120', '324.99', '300.00', '0.00', '120', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('71', '组六胆拖', 'ssc', 'sxzuxzldtz', '1000', '1930.00', '1700.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('72', '中三组六', 'ssc', 'sxzuxzlz', '120', '324.99', '300.00', '0.00', '120', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('73', '组三胆拖', 'ssc', 'sxzuxzsdtz', '1000', '1930.00', '1700.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('74', '中三组三', 'ssc', 'sxzuxzsz', '90', '649.99', '600.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('75', '中三单式', 'ssc', 'sxzhixdsz', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('76', '中三复式', 'ssc', 'sxzhixfsz', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('77', '混合组选', 'ssc', 'sxhhzxq', '120', '324.99', '300.00', '0.00', '120', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('78', '前三组六胆拖', 'ssc', 'sxzuxzldtq', '0', '0.00', '0.00', '0.00', '0', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('79', '前三胆拖', 'ssc', 'sxzuxzsdtq', '1000', '190.00', '170.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('80', '前三组六', 'ssc', 'sxzuxzlq', '120', '324.99', '300.00', '0.00', '120', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('81', '前三组三', 'ssc', 'sxzuxzsq', '90', '649.99', '600.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('82', '前三单式', 'ssc', 'sxzhixdsq', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('83', '前三复式', 'ssc', 'sxzhixfsq', '1000', '1950.00', '1800.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('84', '后四组选4', 'ssc', 'hsizxs', '90', '4875.00', '4500.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('85', '后四组选6', 'ssc', 'hsizxl', '45', '3250.00', '3000.00', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('86', '后四组选12', 'ssc', 'hsizxye', '360', '1625.00', '1500.00', '0.00', '360', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('87', '后四组选24', 'ssc', 'hsizxes', '210', '812.50', '750.00', '0.00', '210', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('88', '后四单式', 'ssc', 'sixzhixdsh', '10000', '19500.00', '18000.00', '0.00', '10000', '1.00', '20000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('89', '后四复式', 'ssc', 'sixzhixfsh', '10000', '19500.00', '18000.00', '0.00', '10000', '1.00', '20000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('90', '前四组选4', 'ssc', 'qsizxs', '90', '4800.00', '4625.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('91', '前四组选6', 'ssc', 'qsizxl', '45', '3200.00', '3083.00', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('92', '前四组选12', 'ssc', 'qsizxye', '360', '1335.00', '1141.00', '0.00', '360', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('93', '前四组选24', 'ssc', 'qsizxes', '210', '800.00', '770.00', '0.00', '210', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('94', '前四单式', 'ssc', 'sixzhixdsq', '10000', '19300.00', '17000.00', '0.00', '10000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('95', '前四复式', 'ssc', 'sixzhixfsq', '10000', '19200.00', '17000.00', '0.00', '10000', '1.00', '20000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('96', '组选5', 'ssc', 'wxzxw', '90', '39000.00', '36000.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('97', '组选10', 'ssc', 'wxzxyl', '90', '19500.00', '18000.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('98', '组选20', 'ssc', 'wxzxel', '360', '9750.00', '9000.00', '0.00', '360', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('99', '组选30', 'ssc', 'wxzxsl', '360', '6500.00', '6000.00', '0.00', '360', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('100', '组选60', 'ssc', 'wxzxls', '840', '3250.00', '3000.00', '0.00', '840', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('101', '前三复式', 'ssc', 'x5_3x_q3zxfs', '0', '212.50', '200.80', '0.00', '111', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('102', '', 'ssc', 'big', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('103', '', 'ssc', 'bigsmahe', '1', '0.00', '0.00', '4.30', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('104', '', 'ssc', 'sma', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('105', '', 'ssc', 'up', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('106', '', 'ssc', 'mid', '1', '0.00', '0.00', '4.30', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('107', '', 'ssc', 'tu', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('108', '', 'ssc', 'ji', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('109', '', 'ssc', 'jiouhe', '1', '0.00', '0.00', '4.30', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('110', '', 'ssc', 'ou', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('111', '', 'ssc', 'sin', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('112', '', 'ssc', 'cou', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('204', '中三组选复式', 'x5', 'x5zszx', '165', '323.40', '280.50', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('203', '前三组选复式', 'x5', 'x5qszx', '165', '323.40', '280.50', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('151', '金', 'keno', 'jin', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('202', '后三直选单式', 'x5', 'x5hsds', '990', '1940.40', '1683.00', '0.00', '990', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('201', '后三直选复式', 'x5', 'x5hsfs', '990', '1940.40', '1683.00', '0.00', '990', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('200', '中三直选单式', 'x5', 'x5zsds', '990', '1940.40', '1683.00', '0.00', '990', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('199', '中三直选复式', 'x5', 'x5zsfs', '990', '1940.40', '1683.00', '0.00', '990', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('198', '前三直选单式', 'x5', 'x5qsds', '990', '1940.40', '1683.00', '0.00', '990', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('197', '前三直选复式', 'x5', 'x5qsfs', '990', '1940.40', '1683.00', '0.00', '990', '1.00', '20000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('129', '任选一', 'keno', 'bjkl8rx1', '80', '7.80', '0.00', '0.00', '8', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('130', '任选二', 'keno', 'bjkl8rx2', '80', '32.43', '0.00', '0.00', '8', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('131', '任选三', 'keno', 'bjkl8rx3', '80', '70.20', '0.00', '0.00', '8', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('132', '任选四', 'keno', 'bjkl8rx4', '80', '212.18', '0.00', '0.00', '8', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('133', '任选五', 'keno', 'bjkl8rx5', '80', '1007.86', '0.00', '0.00', '8', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('134', '任选六', 'keno', 'bjkl8rx6', '80', '3779.51', '0.00', '0.00', '8', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('135', '任选七', 'keno', 'bjkl8rx7', '80', '15981.53', '0.00', '0.00', '8', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('136', '大', 'keno', 'big', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('137', '和', 'keno', 'bigsmahe', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('138', '小', 'keno', 'sma', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('139', '上', 'keno', 'up', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('140', '中', 'keno', 'mid', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('141', '下', 'keno', 'down', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('142', '奇', 'keno', 'ji', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('143', '和', 'keno', 'jiouhe', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('144', '偶', 'keno', 'ou', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('145', '单', 'keno', 'sin', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('146', '双', 'keno', 'cou', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('147', '大单', 'keno', 'bigsin', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('148', '小单', 'keno', 'smasin', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('149', '大双', 'keno', 'bigcou', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('150', '小双', 'keno', 'smacou', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('152', '木', 'keno', 'mu', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('153', '水', 'keno', 'shui', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('154', '火', 'keno', 'huo', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('155', '土', 'keno', 'tu', '1', '0.00', '0.00', '0.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('156', '二同号复选', 'k3', 'k3ethfx', '6', '0.00', '0.00', '11.50', '6', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('157', '二不同号标准', 'k3', 'k3ebthbz', '15', '0.00', '0.00', '6.50', '15', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('158', '二不同号胆拖', 'k3', 'k3ebthdt', '5', '0.00', '0.00', '6.50', '5', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('159', '三同号单选', 'k3', 'k3sthdx', '6', '0.00', '0.00', '180.00', '6', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('160', '三同号通选', 'k3', 'k3sthtx', '1', '0.00', '0.00', '30.00', '1', '10.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('161', '三不同号标准', 'k3', 'k3sbthbz', '20', '0.00', '0.00', '32.50', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('162', '三不同号胆拖', 'k3', 'k3sbthdt', '10', '0.00', '0.00', '32.50', '10', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('163', '三连号通选', 'k3', 'k3slhtx', '1', '0.00', '0.00', '8.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('164', '三连号单选', 'k3', 'k3slhdx', '4', '0.00', '0.00', '8.50', '4', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('165', '和值3', 'k3', 'k3hz3', '1', '0.00', '0.00', '149.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('166', '和值4', 'k3', 'k3hz4', '1', '0.00', '0.00', '60.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('167', '和值5', 'k3', 'k3hz5', '1', '0.00', '0.00', '32.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('168', '和值6', 'k3', 'k3hz6', '1', '0.00', '0.00', '20.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('169', '和值7', 'k3', 'k3hz7', '1', '0.00', '0.00', '12.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('170', '和值8', 'k3', 'k3hz8', '1', '0.00', '0.00', '9.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('171', '和值9', 'k3', 'k3hz9', '1', '0.00', '0.00', '8.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('172', '和值10', 'k3', 'k3hz10', '1', '0.00', '0.00', '7.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('173', '和值11', 'k3', 'k3hz11', '1', '0.00', '0.00', '7.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('174', '和值12', 'k3', 'k3hz12', '1', '0.00', '0.00', '8.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('175', '和值13', 'k3', 'k3hz13', '1', '0.00', '0.00', '9.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('176', '和值14', 'k3', 'k3hz14', '1', '0.00', '0.00', '12.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('177', '和值15', 'k3', 'k3hz15', '1', '0.00', '0.00', '20.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('178', '和值16', 'k3', 'k3hz16', '1', '0.00', '0.00', '32.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('179', '和值17', 'k3', 'k3hz17', '1', '0.00', '0.00', '60.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('180', '和值18', 'k3', 'k3hz18', '1', '0.00', '0.00', '180.00', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('181', '二同号单选', 'k3', 'k3ethdx', '9', '0.00', '0.00', '60.00', '9', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('182', '大小第一名', 'pk10', 'bjpk10dxdy', '2', '3.92', '3.40', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('183', '大小第二名', 'pk10', 'bjpk10dxde', '2', '3.92', '3.40', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('184', '大小第三名', 'pk10', 'bjpk10dxds', '2', '3.92', '3.40', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('185', '单双第一名', 'pk10', 'bjpk10dsdy', '2', '3.92', '3.40', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('186', '单双第二名', 'pk10', 'bjpk10dsde', '2', '3.92', '3.40', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('187', '单双第三名', 'pk10', 'bjpk10dsds', '2', '3.92', '3.40', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('188', '龙虎第一名', 'pk10', 'bjpk10lhdy', '2', '3.92', '3.40', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('189', '龙虎第二名', 'pk10', 'bjpk10lhde', '2', '3.92', '3.40', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('190', '龙虎第三名', 'pk10', 'bjpk10lhds', '2', '3.92', '3.40', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('191', '定位胆', 'pk10', 'bjpk10dwd', '100', '19.60', '17.00', '0.00', '100', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('192', '前一复式', 'pk10', 'bjpk10qian1', '10', '12.00', '17.00', '0.00', '10', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('193', '前二复式', 'pk10', 'bjpk10qian2', '90', '176.40', '153.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('194', '前二单式', 'pk10', 'bjpk10qian2ds', '90', '176.40', '153.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('195', '前三复式', 'pk10', 'bjpk10qian3', '720', '1411.20', '1224.00', '0.00', '720', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('196', '前三单式', 'pk10', 'bjpk10qian3ds', '720', '1411.20', '1224.00', '0.00', '720', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('205', '后三组选复式', 'x5', 'x5hszx', '165', '323.40', '280.50', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('206', '后三组选胆拖', 'x5', 'x5hsdt', '165', '323.40', '280.50', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('207', '中三组选胆拖', 'x5', 'x5zsdt', '165', '323.40', '280.50', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('208', '前三组选胆拖', 'x5', 'x5qsdt', '165', '323.40', '280.50', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('209', '后二直选复式', 'x5', 'x5hefs', '110', '215.60', '187.00', '0.00', '110', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('210', '前二直选复式', 'x5', 'x5qefs', '110', '215.60', '187.00', '0.00', '110', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('211', '后二直选单式', 'x5', 'x5heds', '110', '215.60', '187.00', '0.00', '110', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('212', '前二直选单式', 'x5', 'x5qeds', '110', '215.60', '187.00', '0.00', '110', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('213', '前二组选复式', 'x5', 'x5qezx', '55', '107.80', '93.50', '0.00', '55', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('214', '后二组选复式', 'x5', 'x5hezx', '55', '107.80', '93.50', '0.00', '55', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('215', '前二组选胆拖', 'x5', 'x5qedt', '55', '107.80', '93.50', '0.00', '55', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('216', '后二组选胆拖', 'x5', 'x5hedt', '55', '107.80', '93.50', '0.00', '55', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('217', '后三不定位', 'x5', 'x5bdwhs', '11', '21.45', '18.70', '0.00', '11', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('218', '中三不定位', 'x5', 'x5bdwzs', '11', '21.45', '18.70', '0.00', '11', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('219', '前三不定位', 'x5', 'x5bdwqs', '11', '7.15', '18.70', '0.00', '11', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('220', '定位胆', 'x5', 'x5dwd', '33', '21.45', '18.70', '0.00', '33', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('221', '任选复式一中一', 'x5', 'x5rx1z1', '11', '4.20', '3.74', '0.00', '11', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('222', '任选复式二中二', 'x5', 'x5rx2z2', '55', '10.60', '8.00', '0.00', '55', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('223', '任选复式三中三', 'x5', 'x5rx3z3', '165', '32.40', '28.00', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('224', '任选复式四中四', 'x5', 'x5rx4z4', '330', '129.70', '120.88', '0.00', '330', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('225', '猜中位', 'x5', 'x5czw', '7', '34.00', '28.00', '0.00', '7', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('226', '定单双', 'x5', 'x5dds', '6', '150.00', '132.00', '0.00', '6', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('227', '胆拖八中五', 'x5', 'x5dt8z5', '120', '17.00', '14.00', '0.00', '120', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('228', '胆拖七中五', 'x5', 'x5dt7z5', '210', '26.50', '37.50', '0.00', '210', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('229', '任选单式八中五', 'x5', 'x5rxds8z5', '165', '16.35', '13.00', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('230', '任选单式七中五', 'x5', 'x5rxds7z5', '165', '43.30', '35.55', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('231', '任选单式六中五', 'x5', 'x5rxds6z5', '330', '151.60', '120.88', '0.00', '330', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('232', '任选单式五中五', 'x5', 'x5rxds5z5', '462', '910.00', '788.00', '0.00', '462', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('233', '任选单式四中四', 'x5', 'x5rxds4z4', '330', '129.70', '110.00', '0.00', '330', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('234', '任选单式三中三', 'x5', 'x5rxds3z3', '165', '32.17', '28.00', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('235', '任选单式二中二', 'x5', 'x5rxds2z2', '55', '10.87', '8.00', '0.00', '55', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('236', '任选单式一中一', 'x5', 'x5rxds1z1', '11', '4.32', '3.60', '0.00', '11', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('237', '任选复式八中五', 'x5', 'x5rx8z5', '165', '16.35', '13.00', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('238', '任选复式七中五', 'x5', 'x5rx7z5', '165', '43.30', '35.50', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('239', '任选复式六中五', 'x5', 'x5rx6z5', '330', '151.60', '120.88', '0.00', '330', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('240', '任选复式五中五', 'x5', 'x5rx5z5', '462', '910.00', '788.00', '0.00', '462', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('241', '胆拖二中二', 'x5', 'x5dt2z2', '10', '10.72', '13.00', '0.00', '10', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('242', '胆拖三中三', 'x5', 'x5dt3z3', '45', '32.17', '28.00', '0.00', '45', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('243', '胆拖四中四', 'x5', 'x5dt4z4', '120', '59.50', '10.40', '0.00', '120', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('244', '胆拖五中五', 'x5', 'x5dt5z5', '210', '400.00', '788.00', '0.00', '210', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('245', '胆拖六中五', 'x5', 'x5dt6z5', '210', '147.50', '128.00', '0.00', '210', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('246', '前三直选', 'kl10f', 'kl10qszxfs', '6840', '13406.40', '11628.00', '0.00', '6840', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('247', '后三直选', 'kl10f', 'kl10hszxfs', '6840', '13406.40', '11628.00', '0.00', '6840', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('248', '前三组选', 'kl10f', 'kl10qszux', '6840', '13406.40', '11628.00', '0.00', '6840', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('249', '后三组选', 'kl10f', 'kl10hszux', '6840', '13406.40', '11628.00', '0.00', '6840', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('250', '二星连直', 'kl10f', 'kl10elzx', '380', '744.80', '646.00', '0.00', '380', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('251', '二星组选', 'kl10f', 'kl10elzux', '190', '372.40', '323.00', '0.00', '190', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('252', '胆拖五中五', 'kl10f', 'kl10dt5z5', '0', '30.00', '18.00', '0.00', '0', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('253', '胆拖四中四', 'kl10f', 'kl10dt4z4', '0', '30.00', '18.00', '0.00', '0', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('254', '胆拖三中三', 'kl10f', 'kl10dt3z3', '0', '30.00', '18.00', '0.00', '0', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('255', '胆拖二中二', 'kl10f', 'kl10dt2z2', '0', '30.00', '18.00', '0.00', '0', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('256', '任选五中五', 'kl10f', 'kl10rx5z5', '20', '30.00', '18.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('257', '任选四中四', 'kl10f', 'kl10rx4z4', '20', '30.00', '18.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('258', '任选三中三', 'kl10f', 'kl10rx3z3', '20', '30.00', '18.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('259', '任选二中二', 'kl10f', 'kl10rx2z2', '20', '9.88', '6.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('260', '任选一中一', 'kl10f', 'kl10rx1z1', '20', '2.88', '1.50', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('261', '第八位', 'kl10f', 'kl10dwd8', '20', '39.20', '34.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('262', '第七位', 'kl10f', 'kl10dwd7', '20', '39.20', '34.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('263', '第六位', 'kl10f', 'kl10dwd6', '20', '39.20', '34.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('264', '第五位', 'kl10f', 'kl10dwd5', '20', '39.20', '34.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('265', '第四位', 'kl10f', 'kl10dwd4', '20', '39.20', '34.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('266', '第三位', 'kl10f', 'kl10dwd3', '20', '39.20', '34.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('267', '第二位', 'kl10f', 'kl10dwd2', '20', '39.20', '34.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('268', '第一位', 'kl10f', 'kl10dwd1', '20', '39.20', '34.00', '0.00', '20', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('269', '极小', 'xy28', 'xy28_hunhe_ji_small', '1', '0.00', '0.00', '9.80', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('270', '极大', 'xy28', 'xy28_hunhe_ji_big', '1', '0.00', '0.00', '9.80', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('271', '小双', 'xy28', 'xy28_hunhe_small_even', '1', '0.00', '0.00', '4.10', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('272', '大双', 'xy28', 'xy28_hunhe_big_even', '1', '0.00', '0.00', '4.10', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('273', '小单', 'xy28', 'xy28_hunhe_small_odd', '1', '0.00', '0.00', '4.10', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('274', '大单', 'xy28', 'xy28_hunhe_big_odd', '1', '0.00', '0.00', '4.10', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('275', '双', 'xy28', 'xy28_hunhe_even', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('276', '单', 'xy28', 'xy28_hunhe_odd', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('277', '小', 'xy28', 'xy28_hunhe_small', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('278', '大', 'xy28', 'xy28_hunhe_big', '1', '0.00', '0.00', '1.95', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('279', '特码27', 'xy28', 'xy28_tm_27', '1', '0.00', '0.00', '974.81', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('280', '特码26', 'xy28', 'xy28_tm_26', '1', '0.00', '0.00', '328.55', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('281', '特码25', 'xy28', 'xy28_tm_25', '1', '0.00', '0.00', '162.38', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('282', '特码24', 'xy28', 'xy28_tm_24', '1', '0.00', '0.00', '98.61', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('283', '特码23', 'xy28', 'xy28_tm_23', '1', '0.00', '0.00', '64.94', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('284', '特码22', 'xy28', 'xy28_tm_22', '1', '0.00', '0.00', '47.07', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('285', '特码21', 'xy28', 'xy28_tm_21', '1', '0.00', '0.00', '34.88', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('286', '特码20', 'xy28', 'xy28_tm_20', '1', '0.00', '0.00', '27.55', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('287', '特码19', 'xy28', 'xy28_tm_19', '1', '0.00', '0.00', '21.64', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('288', '特码18', 'xy28', 'xy28_tm_18', '1', '0.00', '0.00', '17.99', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('289', '特码17', 'xy28', 'xy28_tm_17', '1', '0.00', '0.00', '15.44', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('290', '特码16', 'xy28', 'xy28_tm_16', '1', '0.00', '0.00', '14.27', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('291', '特码15', 'xy28', 'xy28_tm_15', '1', '0.00', '0.00', '13.29', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('292', '特码14', 'xy28', 'xy28_tm_14', '1', '0.00', '0.00', '13.14', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('293', '特码13', 'xy28', 'xy28_tm_13', '1', '0.00', '0.00', '13.01', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('294', '特码12', 'xy28', 'xy28_tm_12', '1', '0.00', '0.00', '13.49', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('295', '特码11', 'xy28', 'xy28_tm_11', '1', '0.00', '0.00', '14.06', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('296', '特码10', 'xy28', 'xy28_tm_10', '1', '0.00', '0.00', '15.64', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('297', '特码9', 'xy28', 'xy28_tm_09', '1', '0.00', '0.00', '17.70', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('298', '特码8', 'xy28', 'xy28_tm_08', '1', '0.00', '0.00', '21.91', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('299', '特码7', 'xy28', 'xy28_tm_07', '1', '0.00', '0.00', '27.12', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('300', '特码6', 'xy28', 'xy28_tm_06', '1', '0.00', '0.00', '35.42', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('301', '特码5', 'xy28', 'xy28_tm_05', '1', '0.00', '0.00', '46.50', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('302', '特码4', 'xy28', 'xy28_tm_04', '1', '0.00', '0.00', '65.73', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('303', '特码3', 'xy28', 'xy28_tm_03', '1', '0.00', '0.00', '97.41', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('304', '特码2', 'xy28', 'xy28_tm_02', '1', '0.00', '0.00', '164.34', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('305', '特码1', 'xy28', 'xy28_tm_01', '1', '0.00', '0.00', '324.75', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('306', '特码0', 'xy28', 'xy28_tm_00', '1', '0.00', '0.00', '959.18', '1', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('307', '前二和尾', 'ssc', 'hzwsqe', '10', '19.30', '17.00', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('308', '后二和尾', 'ssc', 'hzwshe', '10', '19.30', '17.00', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('309', '和', 'ssc', 'lhwqhe', '1', '9.90', '8.50', '0.00', '1', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('310', '虎', 'ssc', 'lhwqhu', '1', '2.20', '1.87', '0.00', '1', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('311', '龙', 'ssc', 'lhwql', '1', '2.20', '1.87', '0.00', '1', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('312', '三星直选复式', 'dpc', 'pl3zxfs', '1000', '1960.00', '1700.00', '0.00', '1000', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('313', '三星直选单式', 'dpc', 'pl3zxds', '1000', '1960.00', '1700.00', '0.00', '1000', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('314', '三星组三', 'dpc', 'pl3zux3', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('315', '趣味拖拉机', 'dpc', 'pl3qwtlj', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('316', '趣味奇偶', 'dpc', 'pl3qwjo', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('317', '和值大小', 'dpc', 'pl3hzdx', '2', '1.95', '1.95', '0.00', '2', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('318', '和值组六', 'dpc', 'pl3hzzux6', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('319', '和值组三', 'dpc', 'pl3hzzux3', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('320', '三星直选和值', 'dpc', 'pl3hzzx', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('321', '定位胆后一', 'dpc', 'pl3dwd1h', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('322', '定位胆中一', 'dpc', 'pl3dwd1z', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('323', '定位胆前一', 'dpc', 'pl3dwd1q', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('324', '不定位', 'dpc', 'pl3bdw', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('325', '后二直选单式', 'dpc', 'pl3hx2ds', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('326', '后二直选复式', 'dpc', 'pl3hx2fs', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('327', '前二直选单式', 'dpc', 'pl3qx2ds', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('328', '前二直选复式', 'dpc', 'pl3qx2fs', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('329', '三星组六拖胆', 'dpc', 'pl3zux6dt', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('330', '三星组三拖胆', 'dpc', 'pl3zux3dt', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('331', '三星混合', 'dpc', 'pl3zuxhh', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('332', '三星组六', 'dpc', 'pl3zux6', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('333', '和值双', 'k3', 'k3hzeven', '1', '0.00', '0.00', '1.95', '1', '10.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('334', '和值单', 'k3', 'k3hzodd', '1', '0.00', '0.00', '1.95', '1', '10.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('335', '和值小', 'k3', 'k3hzsmall', '1', '0.00', '0.00', '1.95', '1', '10.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('336', '和值大', 'k3', 'k3hzbig', '1', '0.00', '0.00', '1.95', '1', '10.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('338', '四星一码不定位', 'ssc', 'bdw4x1m', '10', '5.67', '5.23', '0.00', '10', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('339', '四星二码不定位', 'ssc', 'bdw4x2m', '45', '20.02', '18.48', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('340', '前三二码不定位', 'ssc', 'bdwqs2m', '45', '36.11', '33.33', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('341', '中三二码不定位', 'ssc', 'bdwzs2m', '45', '36.11', '33.33', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('342', '后三二码不定位', 'ssc', 'bdwhs2m', '45', '36.11', '33.33', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('343', '前二组选和值', 'ssc', 'zuxhzqe', '45', '97.50', '90.00', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('344', '后二组选和值', 'ssc', 'zuxhzhe', '45', '97.50', '90.00', '0.00', '45', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('345', '前三组选包胆', 'ssc', 'zuxcsbd', '54', '324.99', '300.00', '0.00', '54', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('346', '中三组选包胆', 'ssc', 'zuxzsbd', '54', '324.99', '300.00', '0.00', '54', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('348', '前二组选包胆', 'ssc', 'zuxcebd', '9', '97.50', '90.00', '0.00', '9', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('347', '后三组选包胆', 'ssc', 'zuxhsbd', '54', '324.99', '300.00', '0.00', '54', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('349', '后二组选包胆', 'ssc', 'zuxhebd', '9', '97.50', '90.00', '0.00', '9', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('350', '前三大小单双', 'ssc', 'dxdsqs', '64', '15.60', '14.40', '0.00', '64', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('351', '后三大小单双', 'ssc', 'dxdshs', '64', '15.60', '14.40', '0.00', '64', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('352', '前三组三单式', 'ssc', 'qszsds', '90', '649.99', '600.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('353', '前三组六单式', 'ssc', 'qszlds', '120', '324.99', '300.00', '0.00', '120', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('354', '后三组三单式', 'ssc', 'hszsds', '90', '649.99', '600.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('355', '后三组六单式', 'ssc', 'hszlds', '120', '324.99', '300.00', '0.00', '120', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('356', '中三组三单式', 'ssc', 'zszsds', '90', '649.99', '600.00', '0.00', '90', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('357', '中三组六单式', 'ssc', 'zszlds', '120', '324.99', '300.00', '0.00', '1000', '1.00', '10000.00', '300000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('358', '前四复式', 'pk10', 'bjpk10qian4', '5040', '1411.20', '1224.00', '0.00', '5040', '1.00', '10080.00', '1411.20', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('359', '前四单式', 'pk10', 'bjpk10qian4ds', '5040', '1411.20', '1224.00', '0.00', '5040', '1.00', '10080.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('360', '前五复式', 'pk10', 'bjpk10qian5', '30240', '1411.20', '1224.00', '0.00', '30240', '1.00', '60480.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('361', '前五单式', 'pk10', 'bjpk10qian5ds', '30240', '1411.20', '1224.00', '0.00', '30240', '1.00', '60480.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('362', '三星组六', 'dpc', 'pl3zux6', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('363', '三星组选包胆', 'dpc', 'pl3zuxbd', '90', '350.00', '282.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('364', '三星组三单式', 'dpc', 'pl3zsds', '90', '650.00', '0.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('365', '三星组六单式', 'dpc', 'pl3zlds', '90', '325.00', '0.00', '0.00', '90', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('366', '前二组选复式', 'dpc', 'pl3q2zxfs', '45', '97.50', '0.00', '0.00', '45', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('367', '前二组选单式', 'dpc', 'pl3q2zxds', '45', '97.50', '0.00', '0.00', '45', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('368', '前二组选包胆', 'dpc', 'pl3q2zxbd', '9', '97.50', '0.00', '0.00', '9', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('369', '后二组选复式', 'dpc', 'pl3h2zxfs', '45', '97.50', '0.00', '0.00', '45', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('370', '后二组选单式', 'dpc', 'pl3h2zxds', '45', '97.50', '0.00', '0.00', '45', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('371', '后二组选包胆', 'dpc', 'pl3h2zxbd', '9', '97.50', '0.00', '0.00', '9', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('372', '三星一码不定位', 'dpc', 'pl3ymbdw', '10', '7.19', '0.00', '0.00', '10', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('373', '后二组选复式', 'dpc', 'pl3rmbdw', '45', '97.50', '0.00', '0.00', '45', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('374', '后二组选单式', 'dpc', 'pl3kd', '45', '97.50', '0.00', '0.00', '45', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('375', '后二组选包胆', 'dpc', 'pl3q2kd', '9', '97.50', '0.00', '0.00', '9', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('376', '后二跨度', 'dpc', 'pl3h2kd', '100', '195.00', '0.00', '0.00', '100', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('377', '复式', 'dpc', 'pl3dwdfs', '30', '19.50', '0.00', '0.00', '30', '1.00', '10000.00', '19.50', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('378', '三星组选和值', 'dpc', 'pl3zuxhz', '210', '650.00', '0.00', '0.00', '210', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('379', '三星一码不定位', 'dpc', 'pl3q2zxhz', '10', '7.19', '0.00', '0.00', '10', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('380', '三星二码不定位', 'dpc', 'pl3q2zuxhz', '45', '36.11', '0.00', '0.00', '45', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('381', '三星跨度', 'dpc', 'pl3h2zxhz', '1000', '1950.00', '0.00', '0.00', '1000', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('382', '前二跨度', 'dpc', 'pl3h2zuxhz', '100', '195.00', '0.00', '0.00', '100', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('383', '后二跨度', 'dpc', 'dxdsq2', '100', '195.00', '282.00', '0.00', '100', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('384', '复式', 'dpc', 'dxdsh2', '30', '19.50', '282.00', '0.00', '30', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('385', '前三组选单式', 'x5', 'x5qszxds', '165', '323.40', '0.00', '0.00', '165', '1.00', '10000.00', '30000.00', '', '1');
INSERT INTO `caipiao_wanfa` VALUES ('386', '前二组选单式', 'x5', 'x5qezxds', '55', '107.80', '0.00', '0.00', '55', '1.00', '10000.00', '30000.00', '', '1');

-- ----------------------------
-- Table structure for `caipiao_withdraw`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_withdraw`;
CREATE TABLE `caipiao_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` char(30) NOT NULL,
  `trano` char(60) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `actualamount` decimal(12,2) NOT NULL COMMENT '实到金额',
  `oldaccountmoney` decimal(12,2) NOT NULL COMMENT '提款前金额',
  `newaccountmoney` decimal(12,2) NOT NULL COMMENT '提款后金额',
  `fee` decimal(12,2) NOT NULL COMMENT '手续费',
  `accountname` varchar(30) NOT NULL COMMENT '银行真实姓名',
  `bankname` varchar(30) NOT NULL COMMENT '银行名称',
  `bankbranch` varchar(40) NOT NULL COMMENT '开户网点',
  `banknumber` char(30) NOT NULL COMMENT '银行账号',
  `remark` varchar(155) NOT NULL,
  `oddtime` int(11) NOT NULL,
  `state` tinyint(4) NOT NULL COMMENT '0未审核 1已审核 -1退回取消',
  `stateadmin` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `username` (`username`),
  KEY `trano` (`trano`),
  KEY `state` (`state`),
  KEY `oddtime` (`oddtime`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of caipiao_withdraw
-- ----------------------------
INSERT INTO `caipiao_withdraw` VALUES ('23', '8022', 'abc123t1', 'U1706302000131758', '100.00', '100.00', '13482.00', '13382.00', '0.00', '王五', '平安银行', 'xxxxx', '1234567890123456789', '', '1498824013', '1', 'administrator');
INSERT INTO `caipiao_withdraw` VALUES ('14', '8022', 'abc123t1', 'Z1706301934022136', '100.00', '100.00', '13582.00', '13482.00', '0.00', '王五', '平安银行', 'xxxxx', '1234567890123456789', '', '1498822442', '1', 'administrator');
INSERT INTO `caipiao_withdraw` VALUES ('26', '8022', 'abc123t1', 'E1706302127322187', '130.00', '104.00', '13312.00', '13182.00', '26.00', '王五', '平安银行', 'xxxxx', '1234567890123456789', '', '1498829252', '0', '');
INSERT INTO `caipiao_withdraw` VALUES ('25', '8022', 'abc123t1', 'S1706302127253188', '100.00', '80.00', '13412.00', '13312.00', '20.00', '王五', '平安银行', 'xxxxx', '1234567890123456789', '', '1498829245', '-1', 'administrator');
INSERT INTO `caipiao_withdraw` VALUES ('24', '8022', 'abc123t1', 'S1706302006580792', '100.00', '80.00', '13382.00', '13282.00', '20.00', '王五', '平安银行', 'xxxxx', '1234567890123456789', '', '1498824418', '-1', 'administrator');

-- ----------------------------
-- Table structure for `caipiao_yukaijiang`
-- ----------------------------
DROP TABLE IF EXISTS `caipiao_yukaijiang`;
CREATE TABLE `caipiao_yukaijiang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL COMMENT '彩票标识',
  `opencode` char(180) NOT NULL COMMENT '开奖号码',
  `expect` char(60) NOT NULL COMMENT '期号',
  `opentime` int(11) NOT NULL COMMENT '开奖时间',
  `hid` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `expect` (`expect`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='预开奖管理';

-- ----------------------------
-- Records of caipiao_yukaijiang
-- ----------------------------
