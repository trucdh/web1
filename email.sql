-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 04 月 27 日 01:50
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `email`
--
CREATE DATABASE IF NOT EXISTS `email` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `email`;

-- --------------------------------------------------------

--
-- 表的结构 `em_admin`
--

CREATE TABLE IF NOT EXISTS `em_admin` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `lastIp` varchar(15) NOT NULL DEFAULT '' COMMENT '上次登陆ip',
  `lastTime` int(11) NOT NULL DEFAULT '0' COMMENT '上次登陆时间',
  `email` varchar(40) NOT NULL DEFAULT '' COMMENT '邮箱',
  `realName` varchar(50) NOT NULL DEFAULT '' COMMENT '真实姓名',
  PRIMARY KEY (`user_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `em_admin`
--

INSERT INTO `em_admin` (`user_id`, `username`, `password`, `lastIp`, `lastTime`, `email`, `realName`) VALUES
(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '127.0.0.1', 1398560025, 'test@163.com', '超级管理员');

-- --------------------------------------------------------

--
-- 表的结构 `em_email_template`
--

CREATE TABLE IF NOT EXISTS `em_email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(100) DEFAULT NULL COMMENT '模板标题',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型',
  `content` text COMMENT '模板内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='邮件模板表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `em_sendemail`
--

CREATE TABLE IF NOT EXISTS `em_sendemail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `status` tinyint(2) DEFAULT '0' COMMENT '发送状态0 未发送1成功2失败',
  `title` varchar(250) DEFAULT NULL COMMENT '邮件标题',
  `type` varchar(50) DEFAULT NULL COMMENT '类型',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `send_email` varchar(50) DEFAULT NULL COMMENT '发送邮箱',
  `content` text COMMENT '内容',
  `timing` int(11) NOT NULL DEFAULT '0' COMMENT '定时发送时间',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `add_ip` varchar(50) DEFAULT NULL COMMENT '添加ip',
  `return` text COMMENT '返回值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
