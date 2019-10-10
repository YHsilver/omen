-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-10-10 12:33:40
-- 服务器版本： 10.1.39-MariaDB
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
  `orderTime` datetime DEFAULT NULL,
  `fetchTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `orderTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `returnTime` datetime DEFAULT NULL,
  `operatorID` int(11) NOT NULL,
  `rentTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `inCart` int(1) NOT NULL DEFAULT '0',
  `rentTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `clientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `customorder`
--
ALTER TABLE `customorder`
  MODIFY `customID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `operator`
--
ALTER TABLE `operator`
  MODIFY `operatorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `rentorder`
--
ALTER TABLE `rentorder`
  MODIFY `rentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `suit`
--
ALTER TABLE `suit`
  MODIFY `suitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
