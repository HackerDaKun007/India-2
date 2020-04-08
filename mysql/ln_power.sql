/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : india-2

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 08/04/2020 09:51:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ln_power
-- ----------------------------
DROP TABLE IF EXISTS `ln_power`;
CREATE TABLE `ln_power`  (
  `power_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `whether` int(11) NOT NULL DEFAULT 1,
  `grade` int(11) NOT NULL,
  `level` int(11) NULL DEFAULT 0,
  `controller` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '0',
  `method` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '0',
  `url` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`power_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 129 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ln_power
-- ----------------------------
INSERT INTO `ln_power` VALUES (12, '系统用户列表', 1, 1, 0, '', '', '0', 10, 1583464554, 1583603225);
INSERT INTO `ln_power` VALUES (13, '权限列表', 1, 2, 12, 'Power', 'index', 'Power/index', 100, 1583464597, 1583603089);
INSERT INTO `ln_power` VALUES (14, '添加', 2, 3, 13, 'Power', 'add', 'Power/add', 10, 1583464613, 1583603086);
INSERT INTO `ln_power` VALUES (15, '修改', 2, 3, 13, 'Power', 'edit', 'Power/edit', 9, 1583464633, 1583603082);
INSERT INTO `ln_power` VALUES (16, '删除', 2, 3, 13, 'Power', 'del', 'Power/del', 8, 1583464651, 1583603079);
INSERT INTO `ln_power` VALUES (17, '首页', 1, 1, 0, 'Index', 'home', 'Index/home', 100, 1583601867, 1583603319);
INSERT INTO `ln_power` VALUES (18, '角色列表', 1, 2, 12, 'Role', 'index', 'Role/index', 99, 1583636801, 1583636801);
INSERT INTO `ln_power` VALUES (19, '添加', 2, 3, 18, 'Role', 'add', 'Role/add', 10, 1583636849, 1583636849);
INSERT INTO `ln_power` VALUES (20, '修改', 2, 3, 18, 'Role', 'edit', 'Role/edit', 9, 1583636870, 1583636870);
INSERT INTO `ln_power` VALUES (21, '删除', 2, 3, 18, 'Role', 'del', 'Role/del', 8, 1583636886, 1583636886);
INSERT INTO `ln_power` VALUES (22, '管理员列表', 1, 2, 12, 'Admin', 'index', 'Admin/index', 98, 1583672755, 1583672755);
INSERT INTO `ln_power` VALUES (23, '添加', 2, 3, 22, 'Admin', 'add', 'Admin/add', 10, 1583672872, 1583672872);
INSERT INTO `ln_power` VALUES (24, '修改', 2, 3, 22, 'Admin', 'edit', 'Admin/edit', 9, 1583672905, 1583672905);
INSERT INTO `ln_power` VALUES (25, '删除', 2, 3, 22, 'Admin', 'del', 'Admin/del', 8, 1583672926, 1583672926);
INSERT INTO `ln_power` VALUES (37, '修改', 2, 3, 35, 'Hot', 'edit', 'Hot/edit', 10, 1584323049, 1584323049);
INSERT INTO `ln_power` VALUES (38, '删除', 2, 3, 35, 'Hot', 'del', 'Hot/del', 10, 1584323062, 1584323062);
INSERT INTO `ln_power` VALUES (39, '网站信息记录', 1, 1, 0, '', '', '0', 10, 1584440019, 1584440019);
INSERT INTO `ln_power` VALUES (40, '管理员登陆记录', 1, 2, 39, 'Adminrecord', 'index', 'Adminrecord/index', 10, 1584440048, 1584440048);
INSERT INTO `ln_power` VALUES (41, '删除', 2, 3, 40, 'Adminrecord', 'del', 'Adminrecord/del', 10, 1584603605, 1584603605);
INSERT INTO `ln_power` VALUES (111, '流量统计', 1, 1, 0, '', '', '0', 10, 1585567627, 1585567627);
INSERT INTO `ln_power` VALUES (112, 'pv', 1, 2, 111, 'Flowdate', 'index', 'Flowdate/index', 10, 1585567658, 1585567658);
INSERT INTO `ln_power` VALUES (113, '查看详情', 2, 3, 112, 'Flowdate', 'pv', 'Flowdate/pv', 10, 1585583490, 1585583490);
INSERT INTO `ln_power` VALUES (114, 'Uv', 1, 2, 111, 'Flowdate', 'uvindex', 'Flowdate/uvindex', 10, 1585583502, 1585583502);
INSERT INTO `ln_power` VALUES (115, '查看详情', 2, 3, 114, 'Flowdate', 'uv', 'Flowdate/uv', 10, 1585583523, 1585583523);
INSERT INTO `ln_power` VALUES (116, '网站设置', 1, 1, 0, '', '', '0', 20, 1586179086, 1586179086);
INSERT INTO `ln_power` VALUES (117, '网站相关设置', 1, 2, 116, 'Web', 'index', 'Web/index', 10, 1586225240, 1586225240);
INSERT INTO `ln_power` VALUES (118, '修改', 2, 3, 117, 'Web', 'edit', 'Web/edit', 10, 1586225255, 1586225255);
INSERT INTO `ln_power` VALUES (119, '产品列表', 1, 1, 0, '', '', '0', 60, 1586235400, 1586235400);
INSERT INTO `ln_power` VALUES (120, '产品归类', 1, 2, 119, 'Classify', 'index', 'Classify/index', 10, 1586235428, 1586235428);
INSERT INTO `ln_power` VALUES (121, '网站相关页面', 1, 1, 0, '', '', '0', 30, 1586240187, 1586240187);
INSERT INTO `ln_power` VALUES (122, '关于我们', 1, 2, 121, 'Aboutus', 'index', 'Aboutus/index', 10, 1586242244, 1586242244);
INSERT INTO `ln_power` VALUES (123, '货运信息', 1, 2, 121, 'Shippinginfo', 'index', 'Shippinginfo/index', 10, 1586251753, 1586251753);
INSERT INTO `ln_power` VALUES (124, '常问问题', 1, 2, 121, 'Faq', 'index', 'Faq/index', 10, 1586269599, 1586270924);
INSERT INTO `ln_power` VALUES (125, '联系我们', 1, 2, 121, 'Contactus', 'index', 'Contactus/index', 10, 1586274222, 1586274222);
INSERT INTO `ln_power` VALUES (126, '退货政策', 1, 2, 121, 'Returnpolicy', 'index', 'Returnpolicy/index', 10, 1586277513, 1586277513);
INSERT INTO `ln_power` VALUES (127, '条款条件', 1, 2, 121, 'Termsconditions', 'index', 'Termsconditions/index', 10, 1586279490, 1586279490);
INSERT INTO `ln_power` VALUES (128, '隐私政策', 1, 2, 121, 'Privacypolicy', 'index', 'Privacypolicy/index', 10, 1586281100, 1586281100);

SET FOREIGN_KEY_CHECKS = 1;
