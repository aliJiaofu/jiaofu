-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 03 月 18 日 09:33
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jf_system`
--

-- --------------------------------------------------------

--
-- 表的结构 `jf_checkroll_from`
--

CREATE TABLE IF NOT EXISTS `jf_checkroll_from` (
  `checkroll_fr_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `check_date` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  PRIMARY KEY (`checkroll_fr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_checkroll_reply`
--

CREATE TABLE IF NOT EXISTS `jf_checkroll_reply` (
  `checkroll_re_id` int(11) NOT NULL AUTO_INCREMENT,
  `checkroll_fr_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `check_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`checkroll_re_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_clquestion_answer`
--

CREATE TABLE IF NOT EXISTS `jf_clquestion_answer` (
  `clquestion_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `clquestion_fr_id` int(11) NOT NULL,
  `score` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`clquestion_answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_clquestion_from`
--

CREATE TABLE IF NOT EXISTS `jf_clquestion_from` (
  `clquestion_fr_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`clquestion_fr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_course`
--

CREATE TABLE IF NOT EXISTS `jf_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `time_solt_id` int(11) NOT NULL,
  `course_num` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '课程号',
  `cor_address` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `student_num` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_department`
--

CREATE TABLE IF NOT EXISTS `jf_department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `dept_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dept_id`,`school_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_homework_from`
--

CREATE TABLE IF NOT EXISTS `jf_homework_from` (
  `homework_fr_id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `homework_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `homework_time` int(11) NOT NULL,
  `homework_deadline` int(11) NOT NULL,
  PRIMARY KEY (`homework_fr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_homework_submit`
--

CREATE TABLE IF NOT EXISTS `jf_homework_submit` (
  `homework_sb_id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_fr_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `score` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`homework_sb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_instructor`
--

CREATE TABLE IF NOT EXISTS `jf_instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `real_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL,
  `ins_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `password` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_school`
--

CREATE TABLE IF NOT EXISTS `jf_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_share_file`
--

CREATE TABLE IF NOT EXISTS `jf_share_file` (
  `share_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `share_file_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`share_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_student`
--

CREATE TABLE IF NOT EXISTS `jf_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `major_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `grade` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL,
  `stu_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jf_stu_default`
--

CREATE TABLE IF NOT EXISTS `jf_stu_default` (
  `student_id` int(11) NOT NULL,
  `course_num` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `jf_takes`
--

CREATE TABLE IF NOT EXISTS `jf_takes` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `jf_teaches`
--

CREATE TABLE IF NOT EXISTS `jf_teaches` (
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `jf_time_solt`
--

CREATE TABLE IF NOT EXISTS `jf_time_solt` (
  `time_solt_id` int(11) NOT NULL AUTO_INCREMENT,
  `semester` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  PRIMARY KEY (`time_solt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
