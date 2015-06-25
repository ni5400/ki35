-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-06-25 09:06:12
-- 服务器版本： 5.6.17
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- 表的结构 `think_auth_group`
--

CREATE TABLE IF NOT EXISTS `think_auth_group` (
`id` mediumint(8) unsigned NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) NOT NULL COMMENT '1是系统管理组',
  `rules` char(80) NOT NULL DEFAULT ''
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `think_auth_group`
--

INSERT INTO `think_auth_group` (`id`, `title`, `status`, `type`, `rules`) VALUES
(1, '网站创始员', 1, 1, ''),
(2, '管理员', 0, 0, ''),
(3, '超级管理员', 1, 0, ''),
(4, '网站编辑', 1, 0, ''),
(5, '广告专员', 1, 0, ''),
(6, '游客身份', 0, 0, ''),
(7, 'admin', 1, 0, ''),
(8, 'admin2', 1, 0, ''),
(12, 'admin3', 1, 0, ''),
(13, 'admin4', 1, 0, ''),
(17, 'admin5', 1, 0, ''),
(19, 'admin9', 1, 0, ''),
(18, 'admin6', 1, 0, ''),
(20, 'admin20', 1, 0, ''),
(21, 'admin222', 1, 0, ''),
(22, 'admin333', 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `think_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `think_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `think_auth_rule`
--

CREATE TABLE IF NOT EXISTS `think_auth_rule` (
`id` mediumint(8) unsigned NOT NULL COMMENT 'id',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1为url',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  `pid` int(4) NOT NULL COMMENT '从属id',
  `level` tinyint(1) NOT NULL COMMENT '级别1为一级2为二级',
  `remark` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_navigation`
--

CREATE TABLE IF NOT EXISTS `think_navigation` (
`id` int(10) NOT NULL COMMENT 'id',
  `title` char(10) NOT NULL COMMENT '标题',
  `url` varchar(20) NOT NULL COMMENT 'url地址',
  `ico` varchar(30) NOT NULL COMMENT 'ico图标',
  `type` int(1) NOT NULL COMMENT '所属类型',
  `pid` int(10) NOT NULL COMMENT '所属id,若为0则为根'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `think_navigation`
--

INSERT INTO `think_navigation` (`id`, `title`, `url`, `ico`, `type`, `pid`) VALUES
(1, '菜单1', 'index/index', '', 1, 0),
(2, '菜单2', 'index/index', '', 1, 0),
(3, '菜单3', 'index/index', '', 1, 0),
(4, '菜单4', 'index/index', '', 1, 0),
(5, '菜单1-1', 'index/index', '', 1, 1),
(6, '菜单1-1', 'index/index', '', 1, 1),
(7, '菜单1-1', 'index/index', '', 1, 1),
(8, '菜单1-1', 'index/index', '', 1, 1),
(9, '菜单1-1', 'index/index', '', 1, 1),
(10, '菜单1-1', 'index/index', '', 1, 2),
(11, '菜单1-1', 'index/index', '', 1, 2),
(12, '菜单1-1', 'index/index', '', 1, 2),
(13, '菜单1-1', 'index/index', '', 1, 2),
(14, '菜单1-1', 'index/index', '', 1, 2),
(15, '菜单1-1', 'index/index', '', 1, 3),
(16, '菜单1-1', 'index/index', '', 1, 3),
(17, '菜单1-1', 'index/index', '', 1, 4),
(18, '菜单1-1', 'index/index', '', 1, 4),
(19, '菜单1-1', 'index/index', '', 1, 4);

-- --------------------------------------------------------

--
-- 表的结构 `think_user`
--

CREATE TABLE IF NOT EXISTS `think_user` (
`id` int(10) NOT NULL COMMENT '会员id',
  `user_name` char(20) NOT NULL COMMENT '会员名',
  `password` char(40) NOT NULL COMMENT '密码',
  `user_byname` varchar(20) NOT NULL COMMENT '别名',
  `regtime` int(10) NOT NULL COMMENT '注册时间',
  `regip` int(10) NOT NULL COMMENT '注册ip',
  `login_ip` int(10) NOT NULL COMMENT '登陆ip',
  `login_time` int(10) NOT NULL COMMENT '登陆时间',
  `login_count` int(10) NOT NULL COMMENT '登陆次数',
  `role_id` int(10) NOT NULL COMMENT '角色组',
  `uniq_id` varchar(40) NOT NULL COMMENT '识别码',
  `status` int(1) NOT NULL COMMENT '状态'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `think_user`
--

INSERT INTO `think_user` (`id`, `user_name`, `password`, `user_byname`, `regtime`, `regip`, `login_ip`, `login_time`, `login_count`, `role_id`, `uniq_id`, `status`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '支波', 111111, 11111, 2130706433, 1435220652, 4, 0, '1', 1),
(2, 'admin1', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 111, 111, 2130706433, 1435220652, 4, 1, '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `think_user_log`
--

CREATE TABLE IF NOT EXISTS `think_user_log` (
`id` int(20) NOT NULL COMMENT 'id',
  `user_id` int(10) NOT NULL COMMENT '用户名',
  `creat_url` varchar(200) NOT NULL COMMENT '操作网址',
  `creat_time` int(10) NOT NULL COMMENT '操作时间',
  `creat_ip` int(10) NOT NULL COMMENT '操作ip',
  `type` int(2) NOT NULL COMMENT '类型',
  `status` int(1) NOT NULL COMMENT '状态',
  `title` varchar(40) NOT NULL COMMENT '标题',
  `content` varchar(400) DEFAULT NULL COMMENT '操作说明'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_user_login`
--

CREATE TABLE IF NOT EXISTS `think_user_login` (
`id` int(10) NOT NULL COMMENT 'id',
  `user_name` char(30) NOT NULL COMMENT '用户名',
  `login_ip` int(10) NOT NULL COMMENT '登陆ip',
  `login_time` int(10) NOT NULL COMMENT '登陆时间',
  `error_content` varchar(50) NOT NULL COMMENT '日志'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `think_user_login`
--

INSERT INTO `think_user_login` (`id`, `user_name`, `login_ip`, `login_time`, `error_content`) VALUES
(1, 'admfin', 2130706433, 1434530846, '密码长度不合法！'),
(2, 'aaa', 2130706433, 1434531154, '密码长度不合法！'),
(3, 'ad', 2130706433, 1434531548, '用户名长度5-20位！'),
(4, 'admin', 2130706433, 1434532290, '帐号名称已经存在！'),
(5, 'admina', 2130706433, 1434532566, '密码长度不合法！'),
(6, 'admina', 2130706433, 1434533025, '用户名和密码不一致'),
(7, 'admin', 2130706433, 1434533057, '帐号名称已经存在！'),
(8, 'admina', 2130706433, 1434534093, '用户名和密码不一致'),
(9, 'admina', 2130706433, 0, '密码长度不合法！'),
(10, 'afff', 2130706433, 0, '用户名长度5-20位！'),
(11, 'admin', 2130706433, 1434637992, '密码错误'),
(12, 'admin', 2130706433, 1434638092, '登陆成功'),
(13, 'admin', 2130706433, 1434638164, '登陆成功'),
(14, '1', 2130706433, 1434638168, '用户注销'),
(15, 'admin', 2130706433, 1434639905, '登陆成功'),
(16, 'admin', 2130706433, 1434640896, '用户注销'),
(17, 'admin', 2130706433, 1434640904, '登陆成功'),
(18, 'admin', 2130706433, 1434640947, '用户注销'),
(19, 'admin', 2130706433, 1434640979, '登陆成功'),
(20, 'admin', 2130706433, 1434641520, '用户注销'),
(21, 'admin', 2130706433, 1434641958, '密码错误'),
(22, 'admin', 2130706433, 1434641967, '登陆成功'),
(23, 'admin', 2130706433, 1434642853, '用户注销'),
(24, 'admin', 2130706433, 1434642869, '登陆成功'),
(25, 'admin', 2130706433, 1434643142, '用户注销'),
(26, 'admin', 2130706433, 1434643807, '登陆成功'),
(27, 'admin', 2130706433, 1434692413, '用户注销'),
(28, 'admin', 2130706433, 1434692453, '登陆成功'),
(29, 'admin', 2130706433, 1434945234, '用户注销'),
(30, 'admin', 2130706433, 1434945248, '登陆成功'),
(31, 'admin', 2130706433, 1434961360, '用户注销'),
(32, 'admin', 2130706433, 1434961450, '登陆成功'),
(33, 'admin', 2130706433, 1434961557, '用户注销'),
(34, 'admin', 2130706433, 1434961583, '登陆成功'),
(35, 'admin', 2130706433, 1434963473, '用户注销'),
(36, 'admin', 2130706433, 1434963492, '登陆成功'),
(37, 'admin', 2130706433, 1435065730, '登陆成功'),
(38, 'admin', 2130706433, 1435066417, '登陆成功'),
(39, 'admin', 2130706433, 1435075059, '用户注销'),
(40, 'admin', 2130706433, 1435076661, '登陆成功'),
(41, 'admin', 2130706433, 1435202510, '用户注销'),
(42, 'admin', 2130706433, 1435202526, '登陆成功'),
(43, 'admin', 2130706433, 1435203007, '用户注销'),
(44, 'admin1', 2130706433, 1435203062, '登陆成功'),
(45, 'admin1', 2130706433, 1435205118, '用户注销'),
(46, 'admin', 2130706433, 1435205131, '登陆成功'),
(47, 'admin', 2130706433, 1435220652, '登陆成功');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `think_auth_group`
--
ALTER TABLE `think_auth_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_auth_group_access`
--
ALTER TABLE `think_auth_group_access`
 ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`), ADD KEY `uid` (`uid`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `think_auth_rule`
--
ALTER TABLE `think_auth_rule`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `think_navigation`
--
ALTER TABLE `think_navigation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_user`
--
ALTER TABLE `think_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`user_name`);

--
-- Indexes for table `think_user_log`
--
ALTER TABLE `think_user_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_user_login`
--
ALTER TABLE `think_user_login`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `think_auth_group`
--
ALTER TABLE `think_auth_group`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `think_auth_rule`
--
ALTER TABLE `think_auth_rule`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `think_navigation`
--
ALTER TABLE `think_navigation`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `think_user`
--
ALTER TABLE `think_user`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '会员id',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `think_user_log`
--
ALTER TABLE `think_user_log`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `think_user_login`
--
ALTER TABLE `think_user_login`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
