-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-01-29 09:03:18
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
-- 資料表結構 `itemlist`
--

CREATE TABLE `itemlist` (
  `num` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `itemlist`
--

INSERT INTO `itemlist` (`num`, `name`, `price`) VALUES
('z9', '潤羽るしあ 生日紀念套組', '4490'),
('z5', 'Hololive 百鬼あやめ 生日紀念 原創連帽外套 帽T', '1800'),
('z1', 'Hololive兔田佩克拉 生日套組', '5180'),
('z2', 'Gawr Gura衣服', '1499'),
('z3', 'Hololive 雪花菈米 3D化記念商品', '5280'),
('z4', 'Hololive 桐生可可 週年紀念套組', '5480'),
('z6', 'hololive 潤羽露西婭 T恤', '990'),
('z7', 'Hololive 姫森ルーナ 姬森璐娜 週年紀念套組', '3999'),
('z8', 'hololive 兔田佩克拉 T恤', '1000'),
('z9', '潤羽るしあ 生日紀念套組', '4490'),
('z5', 'Hololive 百鬼あやめ 生日紀念 原創連帽外套 帽T', '1800'),
('z1', 'Hololive兔田佩克拉 生日套組', '5180'),
('z2', 'Gawr Gura衣服', '1499'),
('z3', 'Hololive 雪花菈米 3D化記念商品', '5280'),
('z4', 'Hololive 桐生可可 週年紀念套組', '5480'),
('z6', 'hololive 潤羽露西婭 T恤', '990'),
('z7', 'Hololive 姫森ルーナ 姬森璐娜 週年紀念套組', '3999'),
('z8', 'hololive 兔田佩克拉 T恤', '1000');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
