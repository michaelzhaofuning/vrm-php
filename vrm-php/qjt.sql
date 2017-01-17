-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 10 月 24 日 10:30
-- 服务器版本: 5.0.90
-- PHP 版本: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `qjt`
--

-- --------------------------------------------------------

--
-- 表的结构 `pano_admin`
--

CREATE TABLE IF NOT EXISTS `pano_admin` (
  `id` smallint(5) NOT NULL auto_increment,
  `account` varchar(64) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码',
  `nickname` varchar(50) NOT NULL COMMENT '用户名',
  `group_id` int(11) NOT NULL,
  `last_login_time` int(11) NOT NULL default '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(30) NOT NULL COMMENT '最后登录IP',
  `create_time` int(11) NOT NULL default '0' COMMENT '创建帐号时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pano_admin`
--

INSERT INTO `pano_admin` (`id`, `account`, `password`, `nickname`, `group_id`, `last_login_time`, `last_login_ip`, `create_time`) VALUES
(1, 'admin', 'f297a57a5a743894a0e4', 'admin', 10, 1477296788, '127.0.0.1', 1465958191);

-- --------------------------------------------------------

--
-- 表的结构 `pano_admin_group`
--

CREATE TABLE IF NOT EXISTS `pano_admin_group` (
  `id` int(11) NOT NULL auto_increment,
  `groupname` varchar(60) NOT NULL COMMENT '组别名称',
  `grouppower` text NOT NULL COMMENT '组内权限',
  `creat_time` int(11) NOT NULL,
  `updata_time` int(11) NOT NULL,
  `groupinfo` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `pano_admin_group`
--

INSERT INTO `pano_admin_group` (`id`, `groupname`, `grouppower`, `creat_time`, `updata_time`, `groupinfo`) VALUES
(10, '超级管理员', 'All_power', 1397445943, 1397446711, '所有权限');

-- --------------------------------------------------------

--
-- 表的结构 `pano_admin_login`
--

CREATE TABLE IF NOT EXISTS `pano_admin_login` (
  `id` int(11) NOT NULL auto_increment,
  `user_account` varchar(100) NOT NULL,
  `user_pwd` varchar(120) NOT NULL,
  `key` varchar(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `pano_admin_login`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_background`
--

CREATE TABLE IF NOT EXISTS `pano_background` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `bgimg` varchar(120) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `pano_background`
--

INSERT INTO `pano_background` (`id`, `member_id`, `bgimg`) VALUES
(1, 1, '5.jpg'),
(2, 2, '1.jpg'),
(3, 3, '1.jpg'),
(4, 4, '1.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `pano_comment`
--

CREATE TABLE IF NOT EXISTS `pano_comment` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `wxuserid` int(11) unsigned NOT NULL default '0',
  `pano_id` int(11) unsigned NOT NULL default '0',
  `member_id` mediumint(8) unsigned NOT NULL,
  `fvName` varchar(50) NOT NULL default '',
  `ath` char(50) NOT NULL default '',
  `atv` char(50) NOT NULL default '',
  `avatar` varchar(255) NOT NULL default '',
  `text` varchar(35) NOT NULL default '',
  `status` tinyint(3) unsigned NOT NULL default '1',
  `time` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `pano_comment`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_cursor`
--

CREATE TABLE IF NOT EXISTS `pano_cursor` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `type` varchar(60) NOT NULL default 'system',
  `mode` varchar(60) NOT NULL,
  `file` varchar(120) NOT NULL,
  `w` int(11) NOT NULL default '0',
  `h` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `pano_cursor`
--

INSERT INTO `pano_cursor` (`id`, `member_id`, `type`, `mode`, `file`, `w`, `h`) VALUES
(1, 0, 'system', 'drag', 'cursor1', 32, 32),
(2, 0, 'system', '4way', 'cursor2', 28, 28),
(3, 0, 'system', '8way', 'cursor3', 16, 16),
(4, 0, 'system', '8way', 'cursor4', 16, 16);

-- --------------------------------------------------------

--
-- 表的结构 `pano_hitscount`
--

CREATE TABLE IF NOT EXISTS `pano_hitscount` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `pano_id` int(11) unsigned NOT NULL default '0',
  `member_id` mediumint(8) unsigned NOT NULL,
  `hits` int(11) unsigned NOT NULL default '0',
  `zan` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `pano_hitscount`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_imagestore`
--

CREATE TABLE IF NOT EXISTS `pano_imagestore` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `type` varchar(60) NOT NULL,
  `from_id` int(11) NOT NULL,
  `imagename` varchar(100) NOT NULL,
  `imageurl` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_imagestore`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_member`
--

CREATE TABLE IF NOT EXISTS `pano_member` (
  `id` smallint(5) NOT NULL auto_increment,
  `account` varchar(64) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码',
  `nickname` varchar(50) NOT NULL COMMENT '用户名',
  `group_id` int(11) NOT NULL,
  `last_login_time` int(11) NOT NULL default '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(30) NOT NULL COMMENT '最后登录IP',
  `create_time` int(11) NOT NULL default '0' COMMENT '创建帐号时间',
  `phone` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `headimg` varchar(128) NOT NULL default '' COMMENT '头像',
  `qq` varchar(30) NOT NULL default '' COMMENT 'qq',
  `intro` varchar(255) NOT NULL default '' COMMENT '100字左右自我介绍',
  `pano_count` mediumint(8) unsigned NOT NULL default '0' COMMENT '项目数量',
  `status` tinyint(3) unsigned NOT NULL default '1' COMMENT '审核1是0否',
  `company` varchar(255) NOT NULL default '',
  `company_url` varchar(255) NOT NULL default '',
  `company_logo` varchar(255) NOT NULL default '',
  `pano_limit` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `pano_member`
--

INSERT INTO `pano_member` (`id`, `account`, `password`, `nickname`, `group_id`, `last_login_time`, `last_login_ip`, `create_time`, `phone`, `email`, `headimg`, `qq`, `intro`, `pano_count`, `status`, `company`, `company_url`, `company_logo`, `pano_limit`) VALUES
(1, 'admin', 'f297a57a5a743894a0e4', '源码出售', 0, 1477292584, '222.210.165.108', 1399257425, '', '540924692@qq.com', '/uploads/avatar/c4//1472262250AA70.jpg', '540924692', '', 0, 1, '', '', '', 5000);

-- --------------------------------------------------------

--
-- 表的结构 `pano_member_group`
--

CREATE TABLE IF NOT EXISTS `pano_member_group` (
  `id` int(11) NOT NULL auto_increment,
  `groupname` varchar(60) NOT NULL COMMENT '组别名称',
  `grouppower` text NOT NULL COMMENT '组内权限',
  `creat_time` int(11) NOT NULL,
  `updata_time` int(11) NOT NULL,
  `groupinfo` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_member_group`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_music`
--

CREATE TABLE IF NOT EXISTS `pano_music` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `file` varchar(120) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `pano_music`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_navbg`
--

CREATE TABLE IF NOT EXISTS `pano_navbg` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `bgname` varchar(30) NOT NULL default '',
  `member_id` mediumint(9) unsigned NOT NULL default '0',
  `mode` varchar(30) NOT NULL default 'self',
  `file` varchar(255) default NULL,
  `width` smallint(5) unsigned NOT NULL default '0',
  `height` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `pano_navbg`
--

INSERT INTO `pano_navbg` (`id`, `bgname`, `member_id`, `mode`, `file`, `width`, `height`) VALUES
(1, '系统导航', 0, 'system', '/Public/pano/navbg/1.png', 121, 132),
(2, '系统导航', 0, 'system', '/Public/pano/navbg/2.png', 108, 74),
(3, '系统导航', 0, 'system', '/Public/pano/navbg/3.png', 134, 90),
(4, '系统导航', 0, 'system', '/Public/pano/navbg/4.png', 117, 80),
(5, '系统导航', 0, 'system', '/Public/pano/navbg/5.png', 115, 132),
(6, '系统导航', 0, 'system', '/Public/pano/navbg/6.png', 126, 96),
(7, '系统导航', 0, 'system', '/Public/pano/navbg/7.png', 120, 86),
(8, '系统导航', 0, 'system', '/Public/pano/navbg/8.png', 176, 96),
(9, '系统导航', 0, 'system', '/Public/pano/navbg/9.png', 133, 102),
(10, '系统导航', 0, 'system', '/Public/pano/navbg/10.png', 133, 104),
(11, '系统导航', 0, 'system', '/Public/pano/navbg/11.png', 129, 92),
(12, '系统导航', 0, 'system', '/Public/pano/navbg/12.png', 121, 132),
(13, '系统导航', 0, 'system', '/Public/pano/navbg/13.png', 108, 108),
(14, '系统导航', 0, 'system', '/Public/pano/navbg/14.png', 151, 86),
(15, '系统导航', 0, 'system', '/Public/pano/navbg/15.png', 132, 94),
(16, '系统导航', 0, 'system', '/Public/pano/navbg/16.png', 130, 68),
(17, '系统导航', 0, 'system', '/Public/pano/navbg/17.png', 122, 92),
(18, '系统导航', 0, 'system', '/Public/pano/navbg/18.png', 122, 100),
(19, '系统导航', 0, 'system', '/Public/pano/navbg/19.png', 101, 74),
(20, '系统导航', 0, 'system', '/Public/pano/navbg/20.png', 128, 90),
(21, '系统导航', 0, 'system', '/Public/pano/navbg/21.png', 136, 92),
(22, '系统导航', 0, 'system', '/Public/pano/navbg/22.png', 121, 112),
(23, '系统导航', 0, 'system', '/Public/pano/navbg/23.png', 137, 92),
(24, '系统导航', 0, 'system', '/Public/pano/navbg/24.png', 114, 94),
(25, '系统导航', 0, 'system', '/Public/pano/navbg/25.png', 143, 74),
(26, '系统导航', 0, 'system', '/Public/pano/navbg/26.png', 117, 64),
(27, '系统导航', 0, 'system', '/Public/pano/navbg/27.png', 118, 92),
(28, '系统导航', 0, 'system', '/Public/pano/navbg/28.png', 117, 80),
(29, '系统导航', 0, 'system', '/Public/pano/navbg/29.png', 108, 116),
(30, '系统导航', 0, 'system', '/Public/pano/navbg/30.png', 127, 138),
(31, '系统导航', 0, 'system', '/Public/pano/navbg/31.png', 104, 66),
(32, '系统导航', 0, 'system', '/Public/pano/navbg/32.png', 120, 82),
(33, '系统导航', 0, 'system', '/Public/pano/navbg/33.png', 122, 76),
(34, '系统导航', 0, 'system', '/Public/pano/navbg/34.png', 101, 112),
(35, '系统导航', 0, 'system', '/Public/pano/navbg/35.png', 112, 146),
(36, '系统导航', 0, 'system', '/Public/pano/navbg/36.png', 99, 74),
(37, '系统导航', 0, 'system', '/Public/pano/navbg/37.png', 107, 74),
(38, '系统导航', 0, 'system', '/Public/pano/navbg/38.png', 101, 78),
(39, '系统导航', 0, 'system', '/Public/pano/navbg/39.png', 116, 124),
(40, '系统导航', 0, 'system', '/Public/pano/navbg/40.png', 105, 102);

-- --------------------------------------------------------

--
-- 表的结构 `pano_pano`
--

CREATE TABLE IF NOT EXISTS `pano_pano` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `is_ipad_view` int(11) NOT NULL default '0',
  `cursor_open` int(11) NOT NULL default '0',
  `cursor_id` int(11) NOT NULL default '1',
  `creat_time` int(11) NOT NULL,
  `open_music` int(11) NOT NULL default '0',
  `music_id` int(11) NOT NULL default '0',
  `openautorate` int(11) NOT NULL default '0',
  `autoratespeed` double NOT NULL default '3',
  `autoratewaittime` double NOT NULL default '5',
  `autorateaccel` double NOT NULL default '1',
  `openautonext` int(11) NOT NULL default '0',
  `autonextpass` double NOT NULL default '20',
  `open_musicbtn` int(11) NOT NULL default '0',
  `alpha` double NOT NULL default '0.5',
  `hoveralpha` double NOT NULL default '1',
  `mpos_x` double NOT NULL default '10',
  `mpos_y` double NOT NULL default '10',
  `musicposto` varchar(20) NOT NULL default 'leftbottom',
  `musicpic` varchar(120) NOT NULL default '/Public/pano/store/soundon.png',
  `musichoverpic` varchar(120) NOT NULL default '/Public/pano/store/soundoff.png',
  `thumbwidth` double NOT NULL default '120',
  `thumbheight` double NOT NULL default '90',
  `is_littleplanet_view` tinyint(3) unsigned NOT NULL default '1',
  `website` varchar(255) NOT NULL,
  `linkphone` varchar(50) NOT NULL,
  `map_x` varchar(30) NOT NULL,
  `map_y` varchar(30) NOT NULL,
  `gundongzimu` text NOT NULL,
  `pano_logo` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `openauthor` tinyint(3) NOT NULL default '0',
  `welcome` varchar(255) NOT NULL default '',
  `openwelcome` tinyint(3) unsigned NOT NULL default '0',
  `openpanologo` tinyint(3) unsigned NOT NULL default '0',
  `opennews` tinyint(3) unsigned NOT NULL default '0',
  `opentel` tinyint(3) unsigned NOT NULL default '0',
  `openhttp` tinyint(3) unsigned NOT NULL default '0',
  `openwechat` tinyint(3) unsigned NOT NULL default '1',
  `opentongji` tinyint(3) unsigned NOT NULL default '1',
  `openzan` tinyint(3) unsigned NOT NULL default '1',
  `openshare` tinyint(3) unsigned NOT NULL default '1',
  `opendaohang` tinyint(3) unsigned NOT NULL default '0',
  `opennav` tinyint(3) unsigned NOT NULL default '0',
  `opencard` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- 转存表中的数据 `pano_pano`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_ban`
--

CREATE TABLE IF NOT EXISTS `pano_pano_ban` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `title` varchar(90) NOT NULL,
  `type` varchar(60) NOT NULL default 'none',
  `link` varchar(120) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pano_pano_ban`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_bottomlogo`
--

CREATE TABLE IF NOT EXISTS `pano_pano_bottomlogo` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `open` int(11) NOT NULL,
  `scale` double NOT NULL,
  `image` varchar(120) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pano_pano_bottomlogo`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_card`
--

CREATE TABLE IF NOT EXISTS `pano_pano_card` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `pano_id` mediumint(8) unsigned NOT NULL default '0',
  `c_name` varchar(128) default NULL,
  `c_phone` varchar(50) default NULL,
  `c_email` varchar(50) default NULL,
  `c_address` varchar(255) default NULL,
  `c_wechat` varchar(50) default NULL,
  `c_qq` varchar(30) default NULL,
  `c_remarks` varchar(255) default NULL,
  `c_weixinimg` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pano_pano_card`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_cube`
--

CREATE TABLE IF NOT EXISTS `pano_pano_cube` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `spot_type` int(11) NOT NULL default '1',
  `spot_url` varchar(120) NOT NULL,
  `spot_scale` int(11) NOT NULL default '100',
  `spot_edge` varchar(40) NOT NULL default 'center',
  `spot_x` double NOT NULL,
  `spot_y` double NOT NULL,
  `spot_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `otherdirc` int(11) NOT NULL,
  `bg_color` varchar(10) NOT NULL,
  `is_auto` int(11) NOT NULL,
  `is_myself` int(11) NOT NULL,
  `is_hover` int(11) NOT NULL default '1',
  `is_html5` int(11) NOT NULL default '1',
  `is_flash` int(11) NOT NULL default '1',
  `spoturl` varchar(120) NOT NULL,
  `rx` double NOT NULL default '0',
  `ry` double NOT NULL default '0',
  `rz` double NOT NULL default '0',
  `rotate` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_pano_cube`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_cube_store`
--

CREATE TABLE IF NOT EXISTS `pano_pano_cube_store` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `file` varchar(120) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `imagetype` varchar(20) NOT NULL,
  `len` int(11) NOT NULL,
  `is_ok` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_pano_cube_store`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_fenzu`
--

CREATE TABLE IF NOT EXISTS `pano_pano_fenzu` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `pano_id` int(11) unsigned NOT NULL default '0',
  `name` varchar(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pano_pano_fenzu`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_hotploy`
--

CREATE TABLE IF NOT EXISTS `pano_pano_hotploy` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `ploydata` text NOT NULL,
  `borderwidth` double NOT NULL,
  `borderalpha` double NOT NULL,
  `bordercolor` varchar(12) NOT NULL,
  `borderwidthhover` double NOT NULL,
  `borderalphahover` double NOT NULL,
  `bordercolorhover` varchar(12) NOT NULL,
  `fillcolor` varchar(12) NOT NULL,
  `fillcolorhover` varchar(12) NOT NULL,
  `fillalpha` double NOT NULL,
  `fillalphahover` double NOT NULL,
  `action_type` int(11) NOT NULL,
  `scene_id` int(11) default NULL,
  `photo1` varchar(255) default NULL,
  `photo2` varchar(255) default NULL,
  `text2` text,
  `textbox_width` int(11) NOT NULL,
  `textbox_height` int(11) NOT NULL,
  `photobox_width` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=395 ;

--
-- 转存表中的数据 `pano_pano_hotploy`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_intro`
--

CREATE TABLE IF NOT EXISTS `pano_pano_intro` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `open` int(11) NOT NULL default '0',
  `image` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `pano_pano_intro`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_lensflare`
--

CREATE TABLE IF NOT EXISTS `pano_pano_lensflare` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `ath` double NOT NULL default '0',
  `atv` double NOT NULL default '0',
  `size` double NOT NULL default '0',
  `blind` double NOT NULL default '0',
  `blindcurve` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_pano_lensflare`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_link`
--

CREATE TABLE IF NOT EXISTS `pano_pano_link` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(60) default NULL,
  `spot_type` int(11) NOT NULL default '1',
  `spot_url` varchar(120) default NULL,
  `spot_scale` int(11) NOT NULL default '100',
  `spot_edge` varchar(40) default 'center',
  `spot_x` double NOT NULL,
  `spot_y` double NOT NULL,
  `spot_id` int(11) NOT NULL,
  `is_hover` int(11) NOT NULL default '1',
  `is_html5` int(11) NOT NULL default '1',
  `is_flash` int(11) NOT NULL default '1',
  `spoturl` varchar(120) default NULL,
  `rx` double NOT NULL default '0',
  `ry` double NOT NULL default '0',
  `rz` double NOT NULL default '0',
  `rotate` double NOT NULL default '0',
  `linkurl` varchar(255) default NULL,
  `linktype` int(11) default '1',
  `opentype` tinyint(3) unsigned NOT NULL default '1',
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `pano_pano_link`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_luopan`
--

CREATE TABLE IF NOT EXISTS `pano_pano_luopan` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `view_id` int(11) unsigned NOT NULL default '0',
  `pano_id` int(11) unsigned NOT NULL default '0',
  `member_id` int(11) unsigned NOT NULL default '0',
  `open` tinyint(3) unsigned NOT NULL default '0',
  `image` varchar(255) default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `pano_pano_luopan`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_map`
--

CREATE TABLE IF NOT EXISTS `pano_pano_map` (
  `id` int(11) NOT NULL auto_increment,
  `pano_id` int(11) default NULL,
  `member_id` int(11) default NULL,
  `title` varchar(60) default NULL,
  `map_url` varchar(60) default NULL,
  `align` varchar(30) default 'center',
  `x` varchar(30) default NULL,
  `y` varchar(30) default NULL,
  `scale` double(3,2) default NULL,
  `alpha` double(3,2) default NULL,
  `radar_scale` double(3,2) default NULL,
  `radar_fillcolor` varchar(10) default NULL,
  `radar_fillalpha` double(3,2) default NULL,
  `radar_linecolor` varchar(10) default NULL,
  `radar_linealpha` double(3,2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_pano_map`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_map_node`
--

CREATE TABLE IF NOT EXISTS `pano_pano_map_node` (
  `id` int(11) NOT NULL auto_increment,
  `map_id` int(11) default NULL,
  `view_id` int(11) default NULL,
  `open` tinyint(4) default NULL,
  `node_url` varchar(60) default NULL,
  `scale` double(3,2) default NULL,
  `alpha` double(3,2) default NULL,
  `x` varchar(30) default NULL,
  `y` varchar(30) default NULL,
  `heading` double(5,2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_pano_map_node`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_msglist`
--

CREATE TABLE IF NOT EXISTS `pano_pano_msglist` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `pano_id` mediumint(8) unsigned NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `qq` varchar(30) default NULL,
  `email` varchar(30) default NULL,
  `phone` varchar(30) NOT NULL default '0',
  `content` varchar(255) default '1',
  `addtime` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_pano_msglist`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_nav`
--

CREATE TABLE IF NOT EXISTS `pano_pano_nav` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `navname` varchar(30) NOT NULL default '',
  `color` varchar(30) default NULL,
  `overcolor` varchar(30) default NULL,
  `pano_id` mediumint(8) unsigned NOT NULL default '0',
  `navbgid` mediumint(8) unsigned NOT NULL default '0',
  `opentype` tinyint(3) unsigned default '1',
  `linkurl` varchar(255) default NULL,
  `listorder` smallint(6) unsigned NOT NULL default '0',
  `content` text,
  `ox` smallint(6) NOT NULL default '0',
  `oy` smallint(5) NOT NULL default '0',
  `iframewidth` smallint(6) unsigned NOT NULL default '820',
  `iframeheight` smallint(5) unsigned NOT NULL default '540',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `pano_pano_nav`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_photo`
--

CREATE TABLE IF NOT EXISTS `pano_pano_photo` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `spot_type` int(11) NOT NULL default '1',
  `spot_url` varchar(120) NOT NULL,
  `spot_scale` int(11) NOT NULL default '100',
  `spot_edge` varchar(40) NOT NULL default 'center',
  `spot_x` double NOT NULL,
  `spot_y` double NOT NULL,
  `spot_id` int(11) NOT NULL,
  `is_auto` int(11) NOT NULL,
  `is_myself` int(11) NOT NULL,
  `is_hover` int(11) NOT NULL default '1',
  `is_html5` int(11) NOT NULL default '1',
  `is_flash` int(11) NOT NULL default '1',
  `pdir` varchar(120) NOT NULL,
  `ptitle` varchar(80) NOT NULL,
  `spoturl` varchar(120) NOT NULL,
  `rx` double NOT NULL default '0',
  `ry` double NOT NULL default '0',
  `rz` double NOT NULL default '0',
  `rotate` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `pano_pano_photo`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_photo_store`
--

CREATE TABLE IF NOT EXISTS `pano_pano_photo_store` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `file` varchar(120) NOT NULL,
  `sord` int(11) NOT NULL,
  `phototitle` varchar(120) NOT NULL,
  `photoinfo` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `pano_pano_photo_store`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_ployvideo`
--

CREATE TABLE IF NOT EXISTS `pano_pano_ployvideo` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `ploydata` text NOT NULL,
  `borderwidth` double NOT NULL,
  `borderalpha` double NOT NULL,
  `bordercolor` varchar(12) NOT NULL,
  `borderwidthhover` double NOT NULL,
  `borderalphahover` double NOT NULL,
  `bordercolorhover` varchar(12) NOT NULL,
  `fillcolor` varchar(12) NOT NULL,
  `fillcolorhover` varchar(12) NOT NULL,
  `fillalpha` double NOT NULL,
  `fillalphahover` double NOT NULL,
  `file` varchar(150) default NULL,
  `open_apple` int(11) NOT NULL default '0',
  `applefile` varchar(150) default NULL,
  `appleimg` varchar(150) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pano_pano_ployvideo`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_putout`
--

CREATE TABLE IF NOT EXISTS `pano_pano_putout` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `fileurl` varchar(120) NOT NULL,
  `buildtime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

--
-- 转存表中的数据 `pano_pano_putout`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_roam`
--

CREATE TABLE IF NOT EXISTS `pano_pano_roam` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `spot_type` int(11) NOT NULL default '1',
  `spot_url` varchar(120) NOT NULL,
  `spot_scale` int(11) NOT NULL default '100',
  `spot_edge` varchar(40) NOT NULL default 'center',
  `spot_x` double NOT NULL,
  `spot_y` double NOT NULL,
  `spot_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `target_x` double NOT NULL,
  `target_y` double NOT NULL,
  `is_hover` int(11) NOT NULL default '1',
  `is_html5` int(11) NOT NULL default '1',
  `is_flash` int(11) NOT NULL default '1',
  `changetype` int(11) NOT NULL default '1',
  `spoturl` varchar(120) NOT NULL,
  `rx` double NOT NULL default '0',
  `ry` double NOT NULL default '0',
  `rz` double NOT NULL default '0',
  `rotate` double NOT NULL default '0',
  `is_showtext` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=393 ;

--
-- 转存表中的数据 `pano_pano_roam`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_toolbox_map`
--

CREATE TABLE IF NOT EXISTS `pano_pano_toolbox_map` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `open` int(11) NOT NULL default '0',
  `mapimg` varchar(120) NOT NULL,
  `pointimg` varchar(120) NOT NULL default '/Public/member/images/pano/mappoint.png',
  `thepointimg` varchar(120) NOT NULL default '/Public/member/images/pano/mappointactive.png',
  `radersize` double NOT NULL default '0.8',
  `radercolor` varchar(7) NOT NULL default '#FFFFFF',
  `raderalpha` double NOT NULL default '0.5',
  `raderlinewidth` int(11) NOT NULL default '1',
  `radarlinecolor` varchar(7) NOT NULL default '#FF0000',
  `raderlinealpha` double NOT NULL default '0',
  `openmapimg` varchar(120) NOT NULL default '/Public/member/images/pano/mapbtn.png',
  `hidemapimg` varchar(120) NOT NULL default '/Public/member/images/pano/mapbtnoff.png',
  `conrtolmap_x` double NOT NULL default '0',
  `conrtolmap_y` double NOT NULL default '0',
  `conrtolmap_center` varchar(20) NOT NULL default 'center',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pano_pano_toolbox_map`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_toolbox_maps`
--

CREATE TABLE IF NOT EXISTS `pano_pano_toolbox_maps` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `open` int(11) NOT NULL default '0',
  `mapimg` varchar(120) NOT NULL,
  `pointimg` varchar(120) NOT NULL default '/Public/member/images/pano/mappoint.png',
  `thepointimg` varchar(120) NOT NULL default '/Public/member/images/pano/mappointactive.png',
  `radersize` double NOT NULL default '0.8',
  `radercolor` varchar(7) NOT NULL default '#FFFFFF',
  `raderalpha` double NOT NULL default '0.5',
  `raderlinewidth` int(11) NOT NULL default '1',
  `radarlinecolor` varchar(7) NOT NULL default '#FF0000',
  `raderlinealpha` double NOT NULL default '0',
  `openmapimg` varchar(120) NOT NULL,
  `hidemapimg` varchar(120) NOT NULL,
  `conrtolmap_x` double NOT NULL default '0',
  `conrtolmap_y` double NOT NULL default '0',
  `conrtolmap_center` varchar(20) NOT NULL default 'center',
  `map_w` double NOT NULL default '300',
  `map_h` double NOT NULL default '250',
  `map_align` varchar(20) NOT NULL default 'lefttop',
  `map_x` double NOT NULL default '0',
  `map_y` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pano_pano_toolbox_maps`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_toolbox_maps_map`
--

CREATE TABLE IF NOT EXISTS `pano_pano_toolbox_maps_map` (
  `id` int(11) NOT NULL auto_increment,
  `pano_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `mapname` varchar(60) NOT NULL,
  `mapurl` varchar(120) NOT NULL,
  `sort` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pano_pano_toolbox_maps_map`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_toolbox_maps_point`
--

CREATE TABLE IF NOT EXISTS `pano_pano_toolbox_maps_point` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `maps_id` int(11) NOT NULL,
  `open` int(11) NOT NULL default '0',
  `map_x` double NOT NULL default '0',
  `map_y` double NOT NULL default '0',
  `heading` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `pano_pano_toolbox_maps_point`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_toolbox_map_point`
--

CREATE TABLE IF NOT EXISTS `pano_pano_toolbox_map_point` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `open` int(11) NOT NULL default '0',
  `map_x` double NOT NULL default '0',
  `map_y` double NOT NULL default '0',
  `heading` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `pano_pano_toolbox_map_point`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_ui`
--

CREATE TABLE IF NOT EXISTS `pano_pano_ui` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `utp` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- 转存表中的数据 `pano_pano_ui`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_uimobie`
--

CREATE TABLE IF NOT EXISTS `pano_pano_uimobie` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `utp` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_pano_uimobie`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_ui_action`
--

CREATE TABLE IF NOT EXISTS `pano_pano_ui_action` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `action_type` varchar(60) NOT NULL,
  `action_info` varchar(120) NOT NULL,
  `eventchu` varchar(30) NOT NULL,
  `eventname` varchar(60) NOT NULL,
  `data1` varchar(120) NOT NULL,
  `data2` varchar(120) NOT NULL,
  `data3` varchar(120) NOT NULL,
  `data4` varchar(120) NOT NULL,
  `actiondo` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_pano_ui_action`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_ui_paths`
--

CREATE TABLE IF NOT EXISTS `pano_pano_ui_paths` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `devices` varchar(40) NOT NULL default 'flash',
  `uitype` varchar(60) NOT NULL,
  `url` varchar(120) NOT NULL,
  `crop` varchar(30) NOT NULL default '0|0|0|0',
  `hovercrop` varchar(30) NOT NULL default '0|0|0|0',
  `downcrop` varchar(30) NOT NULL default '0|0|0|0',
  `parent` int(40) NOT NULL default '0',
  `align` varchar(20) NOT NULL default 'center',
  `edge` varchar(30) NOT NULL default 'center',
  `x` varchar(30) NOT NULL default '0',
  `y` varchar(30) NOT NULL default '0',
  `scale` double NOT NULL default '1',
  `alpha` double NOT NULL default '1',
  `rotate` int(11) NOT NULL default '0',
  `zorder` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_pano_ui_paths`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_view`
--

CREATE TABLE IF NOT EXISTS `pano_pano_view` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `filedir` varchar(60) NOT NULL,
  `thumb` varchar(120) NOT NULL,
  `pano_path` varchar(120) NOT NULL,
  `front` varchar(120) NOT NULL,
  `back` varchar(120) NOT NULL,
  `left` varchar(120) NOT NULL,
  `right` varchar(120) NOT NULL,
  `up` varchar(120) NOT NULL,
  `down` varchar(120) NOT NULL,
  `sort` int(11) NOT NULL default '1',
  `effect_mod` varchar(60) NOT NULL default 'noeffect',
  `effect_name` varchar(60) NOT NULL default '无',
  `star_open` int(11) NOT NULL default '0',
  `star_time` double NOT NULL default '2',
  `first_read` int(11) NOT NULL default '0',
  `hlookat` double NOT NULL,
  `vlookat` double NOT NULL,
  `fov` int(11) NOT NULL,
  `openmusic` int(11) NOT NULL default '0',
  `musicfile` varchar(120) NOT NULL,
  `musictimes` int(11) NOT NULL default '0',
  `musicvolume` double NOT NULL default '1',
  `fovmax` double NOT NULL default '150',
  `fovmin` double NOT NULL default '60',
  `open_limit` int(11) NOT NULL default '0',
  `limitview` varchar(60) NOT NULL default 'lookat',
  `hlookatmin` double NOT NULL default '0',
  `hlookatmax` double NOT NULL default '0',
  `vlookatmin` double NOT NULL default '-90',
  `vlookatmax` double NOT NULL default '90',
  `fenzuid` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=372 ;

--
-- 转存表中的数据 `pano_pano_view`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_vpoint`
--

CREATE TABLE IF NOT EXISTS `pano_pano_vpoint` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(60) default NULL,
  `spot_type` int(11) NOT NULL default '1',
  `spot_url` varchar(120) default NULL,
  `spot_scale` int(11) NOT NULL default '100',
  `spot_edge` varchar(40) default 'center',
  `spot_x` double NOT NULL,
  `spot_y` double NOT NULL,
  `spot_id` int(11) NOT NULL,
  `is_hover` int(11) NOT NULL default '1',
  `is_html5` int(11) NOT NULL default '1',
  `is_flash` int(11) NOT NULL default '1',
  `spoturl` varchar(120) default NULL,
  `rx` double NOT NULL default '0',
  `ry` double NOT NULL default '0',
  `rz` double NOT NULL default '0',
  `rotate` double NOT NULL default '0',
  `file` varchar(150) default NULL,
  `applefile` varchar(150) default NULL,
  `appleimg` varchar(150) default NULL,
  `open_apple` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pano_pano_vpoint`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_vspot`
--

CREATE TABLE IF NOT EXISTS `pano_pano_vspot` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(60) default NULL,
  `file` varchar(150) default NULL,
  `open_apple` int(11) NOT NULL default '0',
  `applefile` varchar(150) default NULL,
  `appleimg` varchar(150) default NULL,
  `ath` double NOT NULL default '0',
  `atv` double NOT NULL default '0',
  `rx` double NOT NULL default '0',
  `ry` double NOT NULL default '0',
  `rz` double NOT NULL default '0',
  `scale` double NOT NULL default '1',
  `action` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `pano_pano_vspot`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_zhu`
--

CREATE TABLE IF NOT EXISTS `pano_pano_zhu` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `title` varchar(60) default NULL,
  `spot_type` int(11) NOT NULL default '1',
  `spot_url` varchar(120) default NULL,
  `spot_scale` int(11) NOT NULL default '100',
  `spot_edge` varchar(40) default 'center',
  `spot_x` double NOT NULL,
  `spot_y` double NOT NULL,
  `spot_id` int(11) NOT NULL,
  `is_hover` int(11) NOT NULL default '1',
  `is_html5` int(11) NOT NULL default '1',
  `is_flash` int(11) NOT NULL default '1',
  `spoturl` varchar(120) default NULL,
  `rx` double NOT NULL default '0',
  `ry` double NOT NULL default '0',
  `rz` double NOT NULL default '0',
  `rotate` double NOT NULL default '0',
  `text` varchar(255) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `pano_pano_zhu`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_pano_zhuchiren`
--

CREATE TABLE IF NOT EXISTS `pano_pano_zhuchiren` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `pano_id` int(11) NOT NULL,
  `open` int(11) NOT NULL default '0',
  `file` varchar(150) NOT NULL default '',
  `position` varchar(10) NOT NULL default '',
  `width` varchar(10) NOT NULL default '500',
  `height` varchar(10) NOT NULL default '500',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `pano_pano_zhuchiren`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_spot`
--

CREATE TABLE IF NOT EXISTS `pano_spot` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `mode` varchar(60) NOT NULL default 'system',
  `type` varchar(60) NOT NULL default 'spot',
  `title` varchar(60) NOT NULL,
  `file` varchar(120) NOT NULL,
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `len` int(11) NOT NULL default '0',
  `speed` int(11) NOT NULL default '5',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- 转存表中的数据 `pano_spot`
--

INSERT INTO `pano_spot` (`id`, `member_id`, `mode`, `type`, `title`, `file`, `width`, `height`, `len`, `speed`) VALUES
(1, 0, 'system', 'spot', '前', '/Public/material/system/spot/spot1.png', 60, 40, 0, 5),
(2, 0, 'system', 'spot', '左', '/Public/material/system/spot/spot2.png', 60, 40, 0, 5),
(3, 0, 'system', 'spot', '右', '/Public/material/system/spot/spot3.png', 60, 40, 0, 5),
(4, 0, 'system', 'spot', '标记（绿）', '/Public/material/system/spot/spot4.png', 33, 50, 0, 5),
(5, 0, 'system', 'spot', '标记（蓝）', '/Public/material/system/spot/spot5.png', 33, 50, 0, 5),
(10, 0, 'system', 'movespot', '金色箭头', '/Public/material/system/movespot/1.png', 50, 50, 100, 10),
(11, 0, 'system', 'movespot', '齿轮', '/Public/material/self/movespot/1/2.png', 40, 40, 50, 30),
(12, 0, 'system', 'movespot', '双箭头向前', '/Public/material/system/movespot/2.png', 128, 128, 25, 30),
(13, 0, 'system', 'spot', '双箭头向前', '/Public/material/system/spot/spot6.png', 33, 50, 0, 5),
(14, 0, 'system', 'spot', '向左', '/Public/material/system/spot/spot7.png', 33, 50, 0, 5),
(15, 0, 'system', 'spot', '向右', '/Public/material/system/spot/spot8.png', 33, 50, 0, 5),
(16, 0, 'system', 'spot', '坐上', '/Public/material/system/spot/spot9.png', 33, 50, 0, 5),
(17, 0, 'system', 'spot', '右上', '/Public/material/system/spot/spot10.png', 33, 50, 0, 5),
(18, 0, 'system', 'spot', '圆点1', '/Public/material/system/spot/spot11.png', 33, 50, 0, 5),
(19, 0, 'system', 'spot', '圆点2', '/Public/material/system/spot/spot12.png', 33, 50, 0, 5),
(20, 0, 'system', 'spot', '手势', '/Public/material/system/spot/spot13.png', 33, 50, 0, 5),
(21, 0, 'system', 'spot', '放大镜', '/Public/material/system/spot/spot14.png', 33, 50, 0, 5),
(22, 0, 'system', 'spot', '加号', '/Public/material/system/spot/spot15.png', 33, 50, 0, 5),
(23, 0, 'system', 'spot', '航空', '/Public/material/system/spot/spot16.png', 33, 50, 0, 5),
(24, 0, 'system', 'spot', '提示', '/Public/material/system/spot/spot17.png', 33, 50, 0, 5),
(26, 0, 'system', 'movespot', '向右', '/Public/material/system/movespot/4.png', 128, 128, 25, 30),
(27, 0, 'system', 'movespot', '左上', '/Public/material/system/movespot/5.png', 128, 128, 25, 30),
(28, 0, 'system', 'movespot', '右上', '/Public/material/system/movespot/6.png', 128, 128, 25, 30),
(29, 0, 'system', 'movespot', '圆点1', '/Public/material/system/movespot/7.png', 128, 128, 25, 30),
(30, 0, 'system', 'movespot', '圆点2', '/Public/material/system/movespot/8.png', 128, 128, 25, 30),
(31, 0, 'system', 'movespot', '手势', '/Public/material/system/movespot/9.png', 128, 128, 25, 30),
(32, 0, 'system', 'movespot', '放大镜', '/Public/material/system/movespot/10.png', 128, 128, 25, 30),
(33, 0, 'system', 'movespot', '加号', '/Public/material/system/movespot/11.png', 128, 128, 25, 30),
(34, 0, 'system', 'movespot', '航空', '/Public/material/system/movespot/12.png', 128, 128, 25, 30),
(35, 0, 'system', 'movespot', '提示', '/Public/material/system/movespot/13.png', 128, 128, 25, 30),
(36, 0, 'system', 'movespot', '航空2', '/Public/material/system/movespot/14.png', 128, 128, 10, 30),
(37, 0, 'system', 'movespot', '圆点3', '/Public/material/system/movespot/15.png', 128, 128, 10, 30),
(38, 0, 'system', 'movespot', '白底箭头', '/Public/material/system/movespot/16.png', 128, 128, 10, 30),
(39, 0, 'system', 'movespot', '圆点4', '/Public/material/system/movespot/17.png', 128, 128, 10, 30),
(40, 0, 'system', 'movespot', '下箭头', '/Public/material/system/movespot/18.png', 128, 128, 10, 30),
(25, 0, 'system', 'movespot', '向左', '/Public/material/system/movespot/3.png', 128, 128, 25, 30);

-- --------------------------------------------------------

--
-- 表的结构 `pano_sysconfig`
--

CREATE TABLE IF NOT EXISTS `pano_sysconfig` (
  `id` int(11) NOT NULL auto_increment,
  `varname` varchar(20) NOT NULL default '',
  `info` varchar(100) NOT NULL default '',
  `groupid` smallint(6) NOT NULL default '1',
  `type` varchar(10) NOT NULL default 'string',
  `value` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `pano_sysconfig`
--

INSERT INTO `pano_sysconfig` (`id`, `varname`, `info`, `groupid`, `type`, `value`) VALUES
(1, 'web_name', '站点名称', 1, 'string', '360vr全景通'),
(2, 'upload_type_all', '上传全部类型限制（多个请用 | 隔开）', 2, 'string', 'jpg|jpeg|gif|png|bmp|mp3|wma|flv|swf|mp4|m4v|zip|php'),
(3, 'upload_type_image', '上传图片类型限制（多个请用 | 隔开）', 2, 'string', 'jpg|jpeg|gif|png'),
(4, 'upload_type_audio', '上传音频类型限制（多个请用 | 隔开）', 2, 'string', 'mp3|wma'),
(5, 'upload_type_video', '上传视频类型限制（多个请用 | 隔开）', 2, 'string', 'wma|flv|swf|mp4|m4v'),
(7, 'upload_size', '上传大小限制（MB）', 2, 'string', '40');

-- --------------------------------------------------------

--
-- 表的结构 `pano_sysui`
--

CREATE TABLE IF NOT EXISTS `pano_sysui` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(120) NOT NULL,
  `devices` varchar(60) NOT NULL default 'flash',
  `info` text NOT NULL,
  `path` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `pano_sysui`
--

INSERT INTO `pano_sysui` (`id`, `title`, `devices`, `info`, `path`) VALUES
(1, '水晶玻璃风格类型', 'flash/手机', '一个很不错的样式，适合多种平台的用法。', 'ui_001'),
(2, 'ui_002', 'flash/手机', '一个很不错的样式，适合多种平台的用法。', 'ui_002'),
(3, 'ui_003', 'flash/手机', '一个很不错的样式，适合多种平台的用法。', 'ui_003'),
(4, 'ui_004', 'flash/手机', '一个很不错的样式，适合多种平台的用法。', 'ui_004'),
(5, 'ui_005', 'flash/手机', '一个很不错的样式，适合多种平台的用法。', 'ui_005'),
(6, 'ui_006', 'flash/手机', '一个很不错的样式，适合多种平台的用法。', 'ui_006'),
(7, '系统风格1', 'flash/手机', '支持VR，去了右键版本信息显示。', 'ui_007'),
(8, '系统风格2', 'flash/手机', '支持VR，去了右键版本信息显示。', 'ui_008'),
(9, '系统风格3', 'flash/手机', '支持VR，去了右键版本信息显示。', 'ui_009'),
(10, '系统风格4', 'flash/手机', '支持VR，去了右键版本信息显示。', 'ui_010'),
(11, '系统风格5', 'flash/手机', '支持VR，去了右键版本信息显示。', 'ui_011'),
(12, '系统风格6', 'flash/手机', '支持VR，去了右键版本信息显示。', 'ui_012');

-- --------------------------------------------------------

--
-- 表的结构 `pano_ui`
--

CREATE TABLE IF NOT EXISTS `pano_ui` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `devices` varchar(30) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pano_ui`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_ui_action`
--

CREATE TABLE IF NOT EXISTS `pano_ui_action` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `action_type` varchar(60) NOT NULL,
  `action_info` varchar(120) NOT NULL,
  `eventchu` varchar(30) NOT NULL,
  `eventname` varchar(60) NOT NULL,
  `data1` varchar(120) NOT NULL,
  `data2` varchar(120) NOT NULL,
  `data3` varchar(120) NOT NULL,
  `data4` varchar(120) NOT NULL,
  `actiondo` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_ui_action`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_ui_child`
--

CREATE TABLE IF NOT EXISTS `pano_ui_child` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `uitype` varchar(60) NOT NULL,
  `url` varchar(120) NOT NULL,
  `visible` int(11) NOT NULL default '1',
  `crop` varchar(30) NOT NULL default '0|0|0|0',
  `hovercrop` varchar(30) NOT NULL default '0|0|0|0',
  `downcrop` varchar(30) NOT NULL default '0|0|0|0',
  `parent` int(11) NOT NULL,
  `align` varchar(20) NOT NULL default 'center',
  `edge` varchar(30) NOT NULL default 'center',
  `x` varchar(30) NOT NULL default '0',
  `y` varchar(30) NOT NULL default '0',
  `scale` double NOT NULL default '1',
  `alpha` double NOT NULL default '1',
  `rotate` int(11) NOT NULL default '0',
  `zorder` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pano_ui_child`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_wxconfig`
--

CREATE TABLE IF NOT EXISTS `pano_wxconfig` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `appid` varchar(128) NOT NULL default '',
  `appsecret` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pano_wxconfig`
--

INSERT INTO `pano_wxconfig` (`id`, `appid`, `appsecret`) VALUES
(1, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `pano_wxuser`
--

CREATE TABLE IF NOT EXISTS `pano_wxuser` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `openid` varchar(128) NOT NULL default '',
  `nickname` varchar(50) NOT NULL default '',
  `headimgurl` varchar(255) NOT NULL default '',
  `time` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pano_wxuser`
--


-- --------------------------------------------------------

--
-- 表的结构 `pano_zanip`
--

CREATE TABLE IF NOT EXISTS `pano_zanip` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `pano_id` mediumint(8) unsigned NOT NULL default '0',
  `ip` varchar(30) default NULL,
  `addtime` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `pano_zanip`
--

