-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-01-29 09:03:05
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `holomember`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ltemlast`
--

CREATE TABLE `ltemlast` (
  `surname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `price` varchar(30) NOT NULL,
  `account` varchar(30) NOT NULL,
  `itemlist` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ltemlast`
--

INSERT INTO `ltemlast` (`surname`, `name`, `phone`, `address`, `email`, `price`, `account`, `itemlist`) VALUES
('Gawr', 'gura', '0227712171', '台北市大安區忠孝東路三段1號', 'wiwisam325@yahoo.com.tw', '12638', 'wiwi', 'z3,z2,z5,z7'),
('', '', '', '', '', '', '', ''),
('趙', '祖威', '0906998766', '新北市泰山區', '123@gmail.com', '6230', 'aaa', 'z1,z6'),
('F', 'Uck', '0987987987', '火葬場', 'a0979819384@gmail.com', '12019', 'Iot08', 'z1,z2,z3'),
('111', '1222', '09325156532', '0000000', 'ntut.109b.02@gmail.com', '3549', 'guest', 'z2,z6,z8'),
('趙', '祖威', '0906998766', '新北市泰山區', '123@gmail.com', '6230', 'guest', 'z6,z1'),
('趙', '祖威', '090675557555', '新北市泰山區', 'samwiwi325@gmail.com', '6230', 'wiwi', 'z6,z1'),
('趙', '祖威', '09069987666', '新北市泰山區', 'samwiwi325@gmail.com', '7729', '567', 'z6,z1,z2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
