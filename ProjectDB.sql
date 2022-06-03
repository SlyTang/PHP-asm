-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-07-16 15:27:48
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `projectdb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `consignmentstore`
--

CREATE TABLE `consignmentstore` (
  `consignmentStoreID` int(10) NOT NULL,
  `tenantID` varchar(50) NOT NULL,
  `ConsignmentStoreName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `consignmentstore`
--

INSERT INTO `consignmentstore` (`consignmentStoreID`, `tenantID`, `ConsignmentStoreName`) VALUES
(1, 'marcus888', 'Marucs ConsignmentStore');

-- --------------------------------------------------------

--
-- 資料表結構 `consignmentstore_shop`
--

CREATE TABLE `consignmentstore_shop` (
  `consignmentStoreID` int(10) NOT NULL,
  `shopID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `consignmentstore_shop`
--

INSERT INTO `consignmentstore_shop` (`consignmentStoreID`, `shopID`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `customerEmail` varchar(50) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phoneNumber` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`customerEmail`, `firstName`, `lastName`, `password`, `phoneNumber`) VALUES
('taiMan@gmail.com', 'Tai Man', 'Chan', 'marcus123', '52839183');

-- --------------------------------------------------------

--
-- 資料表結構 `goods`
--

CREATE TABLE `goods` (
  `goodsNumber` int(10) NOT NULL,
  `consignmentStoreID` int(10) NOT NULL,
  `goodsName` varchar(255) NOT NULL,
  `stockPrice` decimal(10,1) NOT NULL,
  `remainingStock` int(7) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL COMMENT 'The goods should include 2 stock status:  \n1. “Available”: Show only the available goods.  \n2. “Unavailable”: The goods has been discontinued or not already for sell.  '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `goods`
--

INSERT INTO `goods` (`goodsNumber`, `consignmentStoreID`, `goodsName`, `stockPrice`, `remainingStock`, `status`) VALUES
(1, 1, 'Bracelet', '99.5', 9, 1),
(2, 1, 'Anklet', '200.0', 30, 1),
(5, 1, 'text', '50.0', 0, 2),
(7, 1, 'teest1', '1.0', 10, 1),
(8, 1, 'toy123', '10.0', 5, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `orderitem`
--

CREATE TABLE `orderitem` (
  `orderID` int(10) NOT NULL,
  `goodsNumber` int(10) NOT NULL,
  `quantity` int(7) NOT NULL,
  `sellingPrice` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `orderitem`
--

INSERT INTO `orderitem` (`orderID`, `goodsNumber`, `quantity`, `sellingPrice`) VALUES
(1, 1, 3, '99.5'),
(1, 2, 1, '200.0'),
(2, 1, 1, '99.5');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `orderID` int(10) NOT NULL,
  `customerEmail` varchar(50) NOT NULL,
  `consignmentStoreID` int(10) NOT NULL,
  `shopID` int(6) NOT NULL,
  `orderDateTime` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT 'The orders should include 3 statuses:  \n1.     “Delivery”: The parts are delivering to shop  \n2.     “Awaiting”: Goods are ready for pick up  \n3.     “Completed”: The goods has been picked up from customer  ',
  `totalPrice` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`orderID`, `customerEmail`, `consignmentStoreID`, `shopID`, `orderDateTime`, `status`, `totalPrice`) VALUES
(1, 'taiMan@gmail.com', 1, 1, '2020-05-14 07:34:29', 3, '498.5'),
(2, 'taiMan@gmail.com', 1, 2, '2020-06-22 08:25:13', 2, '99.5'),
(15, 'taiMan@gmail.com', 1, 1, '0000-00-00 00:00:00', 3, '99.5');

-- --------------------------------------------------------

--
-- 資料表結構 `shop`
--

CREATE TABLE `shop` (
  `shopID` int(6) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `shop`
--

INSERT INTO `shop` (`shopID`, `address`) VALUES
(1, 'No. 18, 1 / F, Trendy Zone, 580A Nathan Road, Mong Kok'),
(2, 'No. 1047, 10/F, Nan Fung Centre, 264-298 Castle Peak Road, Tsuen Wan');

-- --------------------------------------------------------

--
-- 資料表結構 `tenant`
--

CREATE TABLE `tenant` (
  `tenantID` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `tenant`
--

INSERT INTO `tenant` (`tenantID`, `name`, `password`) VALUES
('marcus888', 'Marcus', 'it888');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `consignmentstore`
--
ALTER TABLE `consignmentstore`
  ADD PRIMARY KEY (`consignmentStoreID`),
  ADD KEY `FKConsignmen625115` (`tenantID`);

--
-- 資料表索引 `consignmentstore_shop`
--
ALTER TABLE `consignmentstore_shop`
  ADD PRIMARY KEY (`consignmentStoreID`,`shopID`),
  ADD KEY `FKConsignmen537135` (`consignmentStoreID`),
  ADD KEY `FKConsignmen824630` (`shopID`);

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerEmail`);

--
-- 資料表索引 `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goodsNumber`),
  ADD KEY `FKGoods866951` (`consignmentStoreID`);

--
-- 資料表索引 `orderitem`
--
ALTER TABLE `orderitem`
  ADD KEY `FKOrderItem915607` (`orderID`),
  ADD KEY `FKOrderItem82428` (`goodsNumber`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `FKOrders837071` (`customerEmail`),
  ADD KEY `FKOrders959018` (`consignmentStoreID`,`shopID`);

--
-- 資料表索引 `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shopID`);

--
-- 資料表索引 `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenantID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `consignmentstore`
--
ALTER TABLE `consignmentstore`
  MODIFY `consignmentStoreID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `goods`
--
ALTER TABLE `goods`
  MODIFY `goodsNumber` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shop`
--
ALTER TABLE `shop`
  MODIFY `shopID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `consignmentstore`
--
ALTER TABLE `consignmentstore`
  ADD CONSTRAINT `FKConsignmen625115` FOREIGN KEY (`tenantID`) REFERENCES `tenant` (`tenantID`);

--
-- 資料表的限制式 `consignmentstore_shop`
--
ALTER TABLE `consignmentstore_shop`
  ADD CONSTRAINT `FKConsignmen537135` FOREIGN KEY (`consignmentStoreID`) REFERENCES `consignmentstore` (`consignmentStoreID`),
  ADD CONSTRAINT `FKConsignmen824630` FOREIGN KEY (`shopID`) REFERENCES `shop` (`shopID`);

--
-- 資料表的限制式 `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `FKGoods866951` FOREIGN KEY (`consignmentStoreID`) REFERENCES `consignmentstore` (`consignmentStoreID`);

--
-- 資料表的限制式 `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `FKOrderItem82428` FOREIGN KEY (`goodsNumber`) REFERENCES `goods` (`goodsNumber`),
  ADD CONSTRAINT `FKOrderItem915607` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`);

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKOrders837071` FOREIGN KEY (`customerEmail`) REFERENCES `customer` (`customerEmail`),
  ADD CONSTRAINT `FKOrders959018` FOREIGN KEY (`consignmentStoreID`,`shopID`) REFERENCES `consignmentstore_shop` (`consignmentStoreID`, `shopID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
