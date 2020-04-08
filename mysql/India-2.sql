-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-04-07 08:02:46
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `India-2`
--

-- --------------------------------------------------------

--
-- 表的结构 `ln_aboutus`
--

CREATE TABLE `ln_aboutus` (
  `aboutus_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_aboutus`
--

INSERT INTO `ln_aboutus` (`aboutus_id`, `username`, `content`) VALUES
(1, '12312', '312312312');

-- --------------------------------------------------------

--
-- 表的结构 `ln_admin`
--

CREATE TABLE `ln_admin` (
  `admin_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(42) COLLATE utf8_unicode_ci NOT NULL,
  `encrypt` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tei` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL DEFAULT '1',
  `disable` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_admin`
--

INSERT INTO `ln_admin` (`admin_id`, `role_id`, `username`, `password`, `encrypt`, `create_time`, `update_time`, `name`, `mail`, `tei`, `img`, `sex`, `disable`) VALUES
(6, 1, 'dakun', '16ceb678d13b7bc6671fe00365b391c9', 'DnO2wzJM', 1583711228, 1586218301, '吴坤盛', '1275263021@qq.com', '13760740438', '20200309/6e0df350663de91338a89929748ef4ae.gif', 2, 1),
(25, 1, 'kf', '2806f6c8a30217e931565ab6c49e3983', 'cXbC7g9f', 1586170671, 1586170962, 'd222', '', '', '20200406/4dfe65be9f61b74765e13bce3a78d319.jpg', 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ln_adminrecord`
--

CREATE TABLE `ln_adminrecord` (
  `adminrecord_id` int(20) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `ip` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ipaddr` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bro` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `os` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_adminrecord`
--

INSERT INTO `ln_adminrecord` (`adminrecord_id`, `admin_id`, `ip`, `ipaddr`, `bro`, `os`, `record_time`) VALUES
(9, 6, '2130706433', '本地局网地址', 'Chrome', 'mac', 1586176369),
(10, 6, '2130706433', '本地局网地址', 'Chrome', 'mac', 1586176399),
(11, 6, '3232235525', '局域网 对方和您在同一内部网', 'Chrome', 'mac', 1586177656),
(12, 6, '2130706433', '本地局网地址', 'Safari', 'mac', 1586218143),
(13, 6, '2130706433', '本地局网地址', 'Safari', 'iphone', 1586218278),
(14, 6, '2130706433', '本地局网地址', 'Chrome', 'mac', 1586218354),
(15, 6, '2130706433', '本地局网地址', 'Chrome', 'mac', 1586226080),
(16, 6, '2130706433', '本地局网地址', 'Chrome', 'mac', 1586228203);

-- --------------------------------------------------------

--
-- 表的结构 `ln_classify`
--

CREATE TABLE `ln_classify` (
  `classify_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `ln_contactus`
--

CREATE TABLE `ln_contactus` (
  `contactus_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_contactus`
--

INSERT INTO `ln_contactus` (`contactus_id`, `username`, `content`) VALUES
(1, '2131', '1231');

-- --------------------------------------------------------

--
-- 表的结构 `ln_faq`
--

CREATE TABLE `ln_faq` (
  `faq_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_faq`
--

INSERT INTO `ln_faq` (`faq_id`, `username`, `content`) VALUES
(1, '1231', '123123');

-- --------------------------------------------------------

--
-- 表的结构 `ln_flowdate`
--

CREATE TABLE `ln_flowdate` (
  `flowdate_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `pv` int(32) NOT NULL,
  `uv` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_flowdate`
--

INSERT INTO `ln_flowdate` (`flowdate_id`, `date`, `pv`, `uv`) VALUES
(2, 1586102400, 23, 2);

-- --------------------------------------------------------

--
-- 表的结构 `ln_power`
--

CREATE TABLE `ln_power` (
  `power_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `whether` int(11) NOT NULL DEFAULT '1',
  `grade` int(11) NOT NULL,
  `level` int(11) DEFAULT '0',
  `controller` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `method` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `url` varchar(150) COLLATE utf8_unicode_ci DEFAULT '0',
  `sort` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_power`
--

INSERT INTO `ln_power` (`power_id`, `username`, `whether`, `grade`, `level`, `controller`, `method`, `url`, `sort`, `create_time`, `update_time`) VALUES
(12, '系统用户列表', 1, 1, 0, '', '', '0', 10, 1583464554, 1583603225),
(13, '权限列表', 1, 2, 12, 'Power', 'index', 'Power/index', 100, 1583464597, 1583603089),
(14, '添加', 2, 3, 13, 'Power', 'add', 'Power/add', 10, 1583464613, 1583603086),
(15, '修改', 2, 3, 13, 'Power', 'edit', 'Power/edit', 9, 1583464633, 1583603082),
(16, '删除', 2, 3, 13, 'Power', 'del', 'Power/del', 8, 1583464651, 1583603079),
(17, '首页', 1, 1, 0, 'Index', 'home', 'Index/home', 100, 1583601867, 1583603319),
(18, '角色列表', 1, 2, 12, 'Role', 'index', 'Role/index', 99, 1583636801, 1583636801),
(19, '添加', 2, 3, 18, 'Role', 'add', 'Role/add', 10, 1583636849, 1583636849),
(20, '修改', 2, 3, 18, 'Role', 'edit', 'Role/edit', 9, 1583636870, 1583636870),
(21, '删除', 2, 3, 18, 'Role', 'del', 'Role/del', 8, 1583636886, 1583636886),
(22, '管理员列表', 1, 2, 12, 'Admin', 'index', 'Admin/index', 98, 1583672755, 1583672755),
(23, '添加', 2, 3, 22, 'Admin', 'add', 'Admin/add', 10, 1583672872, 1583672872),
(24, '修改', 2, 3, 22, 'Admin', 'edit', 'Admin/edit', 9, 1583672905, 1583672905),
(25, '删除', 2, 3, 22, 'Admin', 'del', 'Admin/del', 8, 1583672926, 1583672926),
(37, '修改', 2, 3, 35, 'Hot', 'edit', 'Hot/edit', 10, 1584323049, 1584323049),
(38, '删除', 2, 3, 35, 'Hot', 'del', 'Hot/del', 10, 1584323062, 1584323062),
(39, '网站信息记录', 1, 1, 0, '', '', '0', 10, 1584440019, 1584440019),
(40, '管理员登陆记录', 1, 2, 39, 'Adminrecord', 'index', 'Adminrecord/index', 10, 1584440048, 1584440048),
(41, '删除', 2, 3, 40, 'Adminrecord', 'del', 'Adminrecord/del', 10, 1584603605, 1584603605),
(111, '流量统计', 1, 1, 0, '', '', '0', 10, 1585567627, 1585567627),
(112, 'pv', 1, 2, 111, 'Flowdate', 'index', 'Flowdate/index', 10, 1585567658, 1585567658),
(113, '查看详情', 2, 3, 112, 'Flowdate', 'pv', 'Flowdate/pv', 10, 1585583490, 1585583490),
(114, 'Uv', 1, 2, 111, 'Flowdate', 'uvindex', 'Flowdate/uvindex', 10, 1585583502, 1585583502),
(115, '查看详情', 2, 3, 114, 'Flowdate', 'uv', 'Flowdate/uv', 10, 1585583523, 1585583523),
(116, '网站设置', 1, 1, 0, '', '', '0', 20, 1586179086, 1586179086),
(117, '网站相关设置', 1, 2, 116, 'Web', 'index', 'Web/index', 10, 1586225240, 1586225240),
(118, '修改', 2, 3, 117, 'Web', 'edit', 'Web/edit', 10, 1586225255, 1586225255),
(119, '产品列表', 1, 1, 0, '', '', '0', 60, 1586235400, 1586235400),
(120, '产品归类', 1, 2, 119, 'Classify', 'index', 'Classify/index', 10, 1586235428, 1586235428);

-- --------------------------------------------------------

--
-- 表的结构 `ln_privacypolicy`
--

CREATE TABLE `ln_privacypolicy` (
  `privacypolicy_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_privacypolicy`
--

INSERT INTO `ln_privacypolicy` (`privacypolicy_id`, `username`, `content`) VALUES
(1, '123', '123');

-- --------------------------------------------------------

--
-- 表的结构 `ln_pv`
--

CREATE TABLE `ln_pv` (
  `pv_id` int(11) NOT NULL,
  `flowdate_id` int(11) NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ipadder` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `addtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_pv`
--

INSERT INTO `ln_pv` (`pv_id`, `flowdate_id`, `url`, `ip`, `ipadder`, `num`, `addtime`) VALUES
(2, 2, '/lmgadmin//index/index.html', '2130706433', '本地局网地址', 9, 1586177543),
(3, 2, '/lmgadmin//index/index.html', '3232235525', '局域网 对方和您在同一内部网', 14, 1586177647);

-- --------------------------------------------------------

--
-- 表的结构 `ln_returnpolicy`
--

CREATE TABLE `ln_returnpolicy` (
  `returnpolicy_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_returnpolicy`
--

INSERT INTO `ln_returnpolicy` (`returnpolicy_id`, `username`, `content`) VALUES
(1, '12312', '111');

-- --------------------------------------------------------

--
-- 表的结构 `ln_role`
--

CREATE TABLE `ln_role` (
  `role_id` int(11) NOT NULL,
  `username` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '2',
  `power_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_role`
--

INSERT INTO `ln_role` (`role_id`, `username`, `admin`, `power_id`, `create_time`, `update_time`) VALUES
(1, '超级管理员', 1, '17,12,13,14,15,16,18,19,20,21,22,23,24,25', 1583661449, 1583708661),
(5, '普通管理员', 2, '17,12,18,19,20,21,22,23,24,25', 1583669617, 1583708676),
(6, '客服', 2, '17', 1583825035, 1583825035);

-- --------------------------------------------------------

--
-- 表的结构 `ln_shippinginfo`
--

CREATE TABLE `ln_shippinginfo` (
  `shippinginfo_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_shippinginfo`
--

INSERT INTO `ln_shippinginfo` (`shippinginfo_id`, `username`, `content`) VALUES
(1, '23123', '123213');

-- --------------------------------------------------------

--
-- 表的结构 `ln_termsconditions`
--

CREATE TABLE `ln_termsconditions` (
  `termsconditions_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_termsconditions`
--

INSERT INTO `ln_termsconditions` (`termsconditions_id`, `username`, `content`) VALUES
(1, '231', '111');

-- --------------------------------------------------------

--
-- 表的结构 `ln_uv`
--

CREATE TABLE `ln_uv` (
  `uv_id` int(11) NOT NULL,
  `flowdate_id` int(11) NOT NULL,
  `ip` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ipadder` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `addtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_uv`
--

INSERT INTO `ln_uv` (`uv_id`, `flowdate_id`, `ip`, `ipadder`, `addtime`) VALUES
(2, 2, '2130706433', '本地局网地址', 1586177543),
(3, 2, '3232235525', '局域网 对方和您在同一内部网', 1586177647);

-- --------------------------------------------------------

--
-- 表的结构 `ln_web`
--

CREATE TABLE `ln_web` (
  `web_id` int(11) NOT NULL,
  `username` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `seo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `seointroduction` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ico` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ln_web`
--

INSERT INTO `ln_web` (`web_id`, `username`, `seo`, `seointroduction`, `logo`, `ico`) VALUES
(1, 're', 'seo', 'qwe', 'logo.png', 'favicon.ico');

--
-- 转储表的索引
--

--
-- 表的索引 `ln_aboutus`
--
ALTER TABLE `ln_aboutus`
  ADD PRIMARY KEY (`aboutus_id`);

--
-- 表的索引 `ln_admin`
--
ALTER TABLE `ln_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `role_id` (`role_id`);

--
-- 表的索引 `ln_adminrecord`
--
ALTER TABLE `ln_adminrecord`
  ADD PRIMARY KEY (`adminrecord_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- 表的索引 `ln_classify`
--
ALTER TABLE `ln_classify`
  ADD PRIMARY KEY (`classify_id`);

--
-- 表的索引 `ln_contactus`
--
ALTER TABLE `ln_contactus`
  ADD PRIMARY KEY (`contactus_id`);

--
-- 表的索引 `ln_faq`
--
ALTER TABLE `ln_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- 表的索引 `ln_flowdate`
--
ALTER TABLE `ln_flowdate`
  ADD PRIMARY KEY (`flowdate_id`);

--
-- 表的索引 `ln_power`
--
ALTER TABLE `ln_power`
  ADD PRIMARY KEY (`power_id`);

--
-- 表的索引 `ln_privacypolicy`
--
ALTER TABLE `ln_privacypolicy`
  ADD PRIMARY KEY (`privacypolicy_id`);

--
-- 表的索引 `ln_pv`
--
ALTER TABLE `ln_pv`
  ADD PRIMARY KEY (`pv_id`),
  ADD KEY `flowdate_id` (`flowdate_id`);

--
-- 表的索引 `ln_returnpolicy`
--
ALTER TABLE `ln_returnpolicy`
  ADD PRIMARY KEY (`returnpolicy_id`);

--
-- 表的索引 `ln_role`
--
ALTER TABLE `ln_role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `power_id` (`power_id`);

--
-- 表的索引 `ln_shippinginfo`
--
ALTER TABLE `ln_shippinginfo`
  ADD PRIMARY KEY (`shippinginfo_id`);

--
-- 表的索引 `ln_termsconditions`
--
ALTER TABLE `ln_termsconditions`
  ADD PRIMARY KEY (`termsconditions_id`);

--
-- 表的索引 `ln_uv`
--
ALTER TABLE `ln_uv`
  ADD PRIMARY KEY (`uv_id`),
  ADD KEY `flowdate_id` (`flowdate_id`);

--
-- 表的索引 `ln_web`
--
ALTER TABLE `ln_web`
  ADD PRIMARY KEY (`web_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ln_aboutus`
--
ALTER TABLE `ln_aboutus`
  MODIFY `aboutus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ln_admin`
--
ALTER TABLE `ln_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用表AUTO_INCREMENT `ln_adminrecord`
--
ALTER TABLE `ln_adminrecord`
  MODIFY `adminrecord_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `ln_classify`
--
ALTER TABLE `ln_classify`
  MODIFY `classify_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `ln_contactus`
--
ALTER TABLE `ln_contactus`
  MODIFY `contactus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ln_faq`
--
ALTER TABLE `ln_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ln_flowdate`
--
ALTER TABLE `ln_flowdate`
  MODIFY `flowdate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `ln_power`
--
ALTER TABLE `ln_power`
  MODIFY `power_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- 使用表AUTO_INCREMENT `ln_privacypolicy`
--
ALTER TABLE `ln_privacypolicy`
  MODIFY `privacypolicy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ln_pv`
--
ALTER TABLE `ln_pv`
  MODIFY `pv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `ln_returnpolicy`
--
ALTER TABLE `ln_returnpolicy`
  MODIFY `returnpolicy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ln_role`
--
ALTER TABLE `ln_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `ln_shippinginfo`
--
ALTER TABLE `ln_shippinginfo`
  MODIFY `shippinginfo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ln_termsconditions`
--
ALTER TABLE `ln_termsconditions`
  MODIFY `termsconditions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ln_uv`
--
ALTER TABLE `ln_uv`
  MODIFY `uv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `ln_web`
--
ALTER TABLE `ln_web`
  MODIFY `web_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
