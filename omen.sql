-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-10-13 08:30:47
-- 服务器版本： 10.1.40-MariaDB
-- PHP 版本： 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `omen`
--

-- --------------------------------------------------------

--
-- 表的结构 `clients`
--

CREATE TABLE `clients` (
  `clientID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `weChat` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `clients`
--

INSERT INTO `clients` (`clientID`, `name`, `weChat`, `source`) VALUES
(1, 'client01', 'we001', 'å¾®ä¿¡æœ‹å‹åœˆ'),
(2, 'client02', 'we002', 'å¾®ä¿¡æœ‹å‹åœˆ'),
(3, 'client03', 'we003', 'å¾®ä¿¡æœ‹å‹åœˆ'),
(4, 'client04', 'we004', 'å¾®ä¿¡æœ‹å‹åœˆ'),
(5, 'client05', 'we005', 'å¾®ä¿¡æœ‹å‹åœˆ'),
(6, 'client06', 'we006', 'å¾®ä¿¡æœ‹å‹åœˆ'),
(7, 'çŽ‹äº”', 'we007', 'å¾®ä¿¡æœ‹å‹åœˆ'),
(8, 'äºŒè™Žå­', 'we_erhuzi', 'æœ‹å‹æŽ¨è'),
(10, 'æŽè›‹', 'we_lidan', 'å¾®ä¿¡æœ‹å‹åœˆ');

-- --------------------------------------------------------

--
-- 表的结构 `customorder`
--

CREATE TABLE `customorder` (
  `customID` int(11) NOT NULL,
  `orderID` varchar(255) NOT NULL,
  `operatorID` int(11) NOT NULL,
  `operatorName` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'on',
  `client` varchar(255) NOT NULL,
  `weChat` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `note` text,
  `orderTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fetchTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `customorder`
--

INSERT INTO `customorder` (`customID`, `orderID`, `operatorID`, `operatorName`, `status`, `client`, `weChat`, `price`, `note`, `orderTime`, `fetchTime`) VALUES
(8, 'CU20191013123025', 7, 'çŽ‹äºŒè™Ž', 'off', 'æŽè›‹', 'we_lidan', 2000, 'æ— ', '2019-10-13 12:30:25', '2019-10-13 12:31:32'),
(9, 'CU20191013131016', 7, 'çŽ‹äºŒè™Ž', 'off', 'æŽè›‹', 'we_lidan', 2000, 'æ— ', '2019-10-13 13:10:16', '2019-10-13 13:10:26');

-- --------------------------------------------------------

--
-- 表的结构 `operator`
--

CREATE TABLE `operator` (
  `operatorID` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sale` double NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `operator`
--

INSERT INTO `operator` (`operatorID`, `account`, `name`, `password`, `sale`, `time`) VALUES
(1, 'master', 'Okuzumi Mai ', '12345678', 0, '2019-09-26 14:49:29'),
(7, 'wangerhu', 'çŽ‹äºŒè™Ž', '123456', 6000, '2019-10-13 04:18:06');

-- --------------------------------------------------------

--
-- 表的结构 `rentorder`
--

CREATE TABLE `rentorder` (
  `rentID` int(11) NOT NULL,
  `orderID` varchar(255) NOT NULL,
  `suitModel` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'on',
  `operatorName` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `client` varchar(255) NOT NULL,
  `weChat` varchar(255) NOT NULL,
  `orderTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `returnTime` datetime DEFAULT NULL,
  `operatorID` int(11) NOT NULL,
  `rentTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `rentorder`
--

INSERT INTO `rentorder` (`rentID`, `orderID`, `suitModel`, `status`, `operatorName`, `price`, `client`, `weChat`, `orderTime`, `returnTime`, `operatorID`, `rentTime`) VALUES
(25, 'RE20191013122254', '0x001', 'off', ' çŽ‹äºŒè™Ž', 1000, 'æŽè›‹', 'we_lidan', '2019-10-13 12:22:54', '2019-10-13 12:23:47', 7, '2019-10-10 17:00:00'),
(26, 'RE20191013130615', '0x001', 'off', ' çŽ‹äºŒè™Ž', 1000, 'æŽè›‹', 'we_lidan', '2019-10-13 13:06:15', '2019-10-13 01:06:34', 7, '2019-10-12 12:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `suit`
--

CREATE TABLE `suit` (
  `suitID` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `imageFileName` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `rentTime` datetime DEFAULT NULL,
  `inCart` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `suit`
--

INSERT INTO `suit` (`suitID`, `type`, `model`, `imageFileName`, `status`, `rentTime`, `inCart`) VALUES
(8, 'ä¸Šè¡£', '0x001', 'wangerhuUploadedAt20191013122044.jpeg', 'on', '2019-10-12 12:00:00', 0);

--
-- 转储表的索引
--

--
-- 表的索引 `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientID`);

--
-- 表的索引 `customorder`
--
ALTER TABLE `customorder`
  ADD PRIMARY KEY (`customID`),
  ADD UNIQUE KEY `orderID` (`orderID`);

--
-- 表的索引 `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`operatorID`),
  ADD UNIQUE KEY `acount` (`account`);

--
-- 表的索引 `rentorder`
--
ALTER TABLE `rentorder`
  ADD PRIMARY KEY (`rentID`),
  ADD UNIQUE KEY `orderID` (`orderID`);

--
-- 表的索引 `suit`
--
ALTER TABLE `suit`
  ADD PRIMARY KEY (`suitID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `clients`
--
ALTER TABLE `clients`
  MODIFY `clientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `customorder`
--
ALTER TABLE `customorder`
  MODIFY `customID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `operator`
--
ALTER TABLE `operator`
  MODIFY `operatorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `rentorder`
--
ALTER TABLE `rentorder`
  MODIFY `rentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `suit`
--
ALTER TABLE `suit`
  MODIFY `suitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
