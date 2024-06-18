-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-01-15 08:53:27
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mydb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `depart`
--

CREATE TABLE `depart` (
  `depart_name` char(4) NOT NULL,
  `depart_num` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `depart`
--

INSERT INTO `depart` (`depart_name`, `depart_num`) VALUES
('出貨部門', 'D01'),
('廠務部門', 'D02'),
('採購部門', 'D03');

-- --------------------------------------------------------

--
-- 資料表結構 `incoming`
--

CREATE TABLE `incoming` (
  `incoming_ID` char(6) NOT NULL,
  `incoming_amount` int(11) NOT NULL,
  `incoming_class` char(1) NOT NULL,
  `incoming_check` tinyint(1) NOT NULL,
  `inventory_num` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `incoming`
--

INSERT INTO `incoming` (`incoming_ID`, `incoming_amount`, `incoming_class`, `incoming_check`, `inventory_num`) VALUES
('000001', 100, '', 0, 'S000-000000001'),
('000002', 100, '', 0, 'S000-000000002'),
('000003', 200, '', 0, 'S000-000000003'),
('000004', 10, '', 0, 'S000-000000004'),
('000005', 10, '', 0, 'S000-000000005'),
('000006', 18, '', 0, 'S000-000000006'),
('000007', 250, '', 0, 'S000-000000007'),
('000008', 100, '', 0, 'S000-000000001'),
('000009', 100, '', 0, 'S000-000000001'),
('000010', 50, '', 0, 'S000-000000001'),
('000011', 300, '', 0, 'S000-000000008');

-- --------------------------------------------------------

--
-- 資料表結構 `inventory`
--

CREATE TABLE `inventory` (
  `inventory_name` char(20) NOT NULL,
  `inventory_num` char(14) NOT NULL,
  `standard` char(11) NOT NULL,
  `unit` char(5) NOT NULL,
  `inventory_amount` int(11) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `inventory`
--

INSERT INTO `inventory` (`inventory_name`, `inventory_num`, `standard`, `unit`, `inventory_amount`, `max`) VALUES
('PETG銀色塑膠吹瓶PL-200A', 'S000-000000001', '5*5*10', '瓶', 100, 0),
('AB-50真空瓶', 'S000-000000002', '5*5*10', '瓶', 100, 0),
('玻璃化妝水瓶L-0154', 'S000-000000003', '5*5*10', '瓶', 200, 0),
('紫外線 屏蔽粉 體', 'S000-000000004', '60*60*100', '桶', 10, 0),
('魔幻變色粒子WTDB', 'S000-000000005', '60*60*100', '桶', 10, 0),
('環保EPE板', 'S000-000000006', '58*40*1', '張', 18, 0),
('80磅素面牛皮包裝紙', 'S000-000000007', '89*119', '張', 250, 0),
('單色眼影SE05(灰)', 'S000-000000008', '4*4*1', 'pcs', 300, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `receive_amount`
--

CREATE TABLE `receive_amount` (
  `receipt_number` char(9) NOT NULL,
  `inventory_num` char(14) NOT NULL,
  `receive_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `receive_order`
--

CREATE TABLE `receive_order` (
  `receipt_ID` char(9) NOT NULL,
  `date` date NOT NULL,
  `depart_num` char(3) NOT NULL,
  `check_receive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `space`
--

CREATE TABLE `space` (
  `space_ID` char(5) NOT NULL,
  `space_class` char(1) NOT NULL,
  `space_num` char(2) NOT NULL,
  `state` int(1) NOT NULL,
  `inventory_num` char(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `space`
--

INSERT INTO `space` (`space_ID`, `space_class`, `space_num`, `state`, `inventory_num`) VALUES
('WH001', 'A', '01', 0, NULL),
('WH002', 'A', '02', 0, NULL),
('WH003', 'A', '03', 0, NULL),
('WH004', 'A', '04', 0, NULL),
('WH005', 'A', '05', 0, NULL),
('WH006', 'A', '06', 0, NULL),
('WH007', 'A', '07', 0, NULL),
('WH008', 'A', '08', 0, NULL),
('WH009', 'A', '09', 0, NULL),
('WH010', 'A', '10', 0, NULL),
('WH011', 'B', '01', 0, NULL),
('WH012', 'B', '02', 0, NULL),
('WH013', 'B', '03', 0, NULL),
('WH014', 'B', '04', 0, NULL),
('WH015', 'B', '05', 0, NULL),
('WH016', 'B', '06', 0, NULL),
('WH017', 'B', '07', 0, NULL),
('WH018', 'B', '08', 0, NULL),
('WH019', 'B', '09', 0, NULL),
('WH020', 'B', '10', 0, NULL),
('WH021', 'C', '01', 0, NULL),
('WH022', 'C', '02', 0, NULL),
('WH023', 'C', '03', 0, NULL),
('WH024', 'C', '04', 0, NULL),
('WH025', 'C', '05', 0, NULL),
('WH026', 'C', '06', 0, NULL),
('WH027', 'C', '07', 0, NULL),
('WH028', 'C', '08', 0, NULL),
('WH029', 'C', '09', 0, NULL),
('WH030', 'C', '10', 0, NULL),
('WH031', 'D', '01', 0, NULL),
('WH032', 'D', '02', 0, NULL),
('WH033', 'D', '03', 0, NULL),
('WH034', 'D', '04', 0, NULL),
('WH035', 'D', '05', 0, NULL),
('WH036', 'D', '06', 0, NULL),
('WH037', 'D', '07', 0, NULL),
('WH038', 'D', '08', 0, NULL),
('WH039', 'D', '09', 0, NULL),
('WH040', 'D', '10', 0, NULL),
('WH041', 'E', '01', 0, NULL),
('WH042', 'E', '02', 0, NULL),
('WH043', 'E', '03', 0, NULL),
('WH044', 'E', '04', 0, NULL),
('WH045', 'E', '05', 0, NULL),
('WH046', 'E', '06', 0, NULL),
('WH047', 'E', '07', 0, NULL),
('WH048', 'E', '08', 0, NULL),
('WH049', 'E', '09', 0, NULL),
('WH050', 'E', '10', 0, NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `depart`
--
ALTER TABLE `depart`
  ADD PRIMARY KEY (`depart_num`);

--
-- 資料表索引 `incoming`
--
ALTER TABLE `incoming`
  ADD PRIMARY KEY (`incoming_ID`),
  ADD KEY `invent_num` (`inventory_num`);

--
-- 資料表索引 `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_num`);

--
-- 資料表索引 `receive_amount`
--
ALTER TABLE `receive_amount`
  ADD PRIMARY KEY (`receipt_number`,`inventory_num`),
  ADD KEY `invent_num_3` (`inventory_num`);

--
-- 資料表索引 `receive_order`
--
ALTER TABLE `receive_order`
  ADD PRIMARY KEY (`receipt_ID`),
  ADD KEY `depart_num_fk` (`depart_num`);

--
-- 資料表索引 `space`
--
ALTER TABLE `space`
  ADD PRIMARY KEY (`space_ID`),
  ADD KEY `invent_num_2` (`inventory_num`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `incoming`
--
ALTER TABLE `incoming`
  ADD CONSTRAINT `invent_num` FOREIGN KEY (`inventory_num`) REFERENCES `inventory` (`inventory_num`);

--
-- 資料表的限制式 `receive_amount`
--
ALTER TABLE `receive_amount`
  ADD CONSTRAINT `invent_num_3` FOREIGN KEY (`inventory_num`) REFERENCES `inventory` (`inventory_num`),
  ADD CONSTRAINT `receive_amount_ibfk_1` FOREIGN KEY (`receipt_number`) REFERENCES `receive_order` (`receipt_ID`);

--
-- 資料表的限制式 `receive_order`
--
ALTER TABLE `receive_order`
  ADD CONSTRAINT `depart_num_fk` FOREIGN KEY (`depart_num`) REFERENCES `depart` (`depart_num`);

--
-- 資料表的限制式 `space`
--
ALTER TABLE `space`
  ADD CONSTRAINT `invent_num_2` FOREIGN KEY (`inventory_num`) REFERENCES `inventory` (`inventory_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
