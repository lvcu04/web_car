-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 06:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `carshop`

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `location_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_address`) VALUES
(1, 'Hồ Chí Minh', '123 Nguyễn Trung Trực, P.12, Q.12, TP.HCM');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `color` enum('vàng','xanh','đỏ','đen','trắng') NOT NULL,
  `dimensions` varchar(50) DEFAULT NULL,
  `battery_capacity` decimal(10,2) DEFAULT NULL,
  `wheel_type` varchar(50) DEFAULT NULL,
  `fuel_consumption` varchar(50) NOT NULL,
  `seat_count` int(11) DEFAULT NULL,
  `fast_charge_time` varchar(50) DEFAULT NULL,
  `airbags` int(11) DEFAULT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_number` int(11) DEFAULT NULL,
  `status` enum('còn','hết') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `color`, `dimensions`, `battery_capacity`, `wheel_type`, `fuel_consumption`, `seat_count`, `fast_charge_time`, `airbags`, `product_price`, `product_number`, `status`) VALUES
('VF01', 'VF3', 'vàng', '3.190 x 1.679 x 1.622', 18.00, '64', '9 kWh/100 km', 4, '36 phút (10% - 70%)', 1, 322000000, 0, 'còn');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `deposit` decimal(10,0) NOT NULL,
  `transaction_number` int(11) NOT NULL,
  `payment_method` enum('Tiền mặt','Chuyển khoản','Trả góp') NOT NULL,
  `transaction_status` enum('Hoàn thành','Đã cọc','Hủy bỏ') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `product_id`, `customer_id`, `transaction_date`, `deposit`, `transaction_number`, `payment_method`, `transaction_status`) VALUES
(1, 'VF01', 1, '2024-07-01', 15000000, 3, 'Chuyển khoản', 'Đã cọc'),
(2, 'VF01', 1, '2024-07-02', 15000000, 2, 'Chuyển khoản', 'Đã cọc');

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `trg_transactions_insert` 
AFTER INSERT ON `transactions` 
FOR EACH ROW 
BEGIN
    DECLARE remain_number INT;

    -- Lấy số lượng sản phẩm từ bảng `product`
    SELECT product_number INTO remain_number 
    FROM product 
    WHERE product_id = NEW.product_id;

    -- Nếu sản phẩm không tồn tại
    IF remain_number IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Sản phẩm không tồn tại!';
    -- Nếu số lượng sản phẩm còn lại đủ
    ELSEIF remain_number >= NEW.transaction_number THEN
        UPDATE product 
        SET product_number = product_number - NEW.transaction_number 
        WHERE product_id = NEW.product_id;
    -- Nếu số lượng sản phẩm không đủ
    ELSE 
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Số lượng sản phẩm không đủ!';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product` AFTER UPDATE ON `transactions` 
FOR EACH ROW BEGIN
  if OLD.transaction_number <> NEW.transaction_number then
    if NEW.transaction_number < 0 then SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = 'so ....';
    else 
    UPDATE product
    set product_number = product_number -(NEW.transaction_number - OLD.transaction_number)
    where product_id = NEW.product_id;


      if(SELECT product_number from product where product_id = NEW.product_id) < 0 then
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Số lượng xe không thể nhỏ hơn 0.';
        end IF;
    END if;
  END IF;

END
$$
DELIMITER ;


DELIMITER $$

CREATE TRIGGER `trg_transactions_delete` 
AFTER DELETE ON `transactions`
FOR EACH ROW
BEGIN
  --Khai bao bien luu tru thong tin bi xoa
  DECLARE v_product_id varchar(10);
  DECLARE v_transaction_number int;

    --Lay thong tin bang bi xoa
  SET v_product_id = OLD.product_id;
  SET v_transaction_number = OLD.transaction_number;


  UPDATE `product`
  SET product_number = product_number + v_transaction_number
  WHERE product_id = v_product_id;
END$$

DELIMITER ;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `usertype` enum('admin','user') NOT NULL,
  `password` varchar(50) NOT NULL,
  `pob` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Dumping data for table `locations`

<<<<<<< HEAD
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `birthday`, `usertype`, `password`, `pob`) VALUES
(1, 'Lê Văn Cừ', 'levancu976@gmail.com', '0366796412', '2004-07-09', 'user', '123', 'Hồ Chí Minh'),
(2, 'Đặng Đức Tĩnh', 'dangductinh1105@gmail.com', '0912412515', '2024-07-10', 'admin', '456', 'Ninh Thuận');
=======
-- INSERT INTO `locations` (`location_id`, `location_name`, `location_address`) VALUES
-- (1, 'Hồ Chí Minh', '123 Nguyễn Trung Trực, P.12, Q.12, TP.HCM');
>>>>>>> e6d015700399f50c37851aac9b16a853f79dde7e

-- -- --------------------------------------------------------

-- -- Table structure for table `product`

-- CREATE TABLE `product` (
--   `product_id` varchar(50) NOT NULL,
--   `product_name` varchar(50) NOT NULL,
--   `color` enum('vàng','xanh','đỏ','đen','trắng') NOT NULL,
--   `dimensions` varchar(50) DEFAULT NULL,
--   `battery_capacity` decimal(10,2) DEFAULT NULL,
--   `wheel_type` varchar(50) DEFAULT NULL,
--   `fuel_consumption` varchar(50) NOT NULL,
--   `seat_count` int(11) DEFAULT NULL,
--   `fast_charge_time` varchar(50) DEFAULT NULL,
--   `airbags` int(11) DEFAULT NULL,
--   `product_price` decimal(10,2) NOT NULL,
--   `product_number` int(11) DEFAULT NULL,
--   `status` enum('còn','hết') NOT NULL,
--   PRIMARY KEY (`product_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Dumping data for table `product`

-- INSERT INTO `product` (`product_id`, `product_name`, `color`, `dimensions`, `battery_capacity`, `wheel_type`, `fuel_consumption`, `seat_count`, `fast_charge_time`, `airbags`, `product_price`, `product_number`, `status`) VALUES
-- ('VF01', 'VF3', 'vàng', '3.190 x 1.679 x 1.622', 18.00, '64', '9 kWh/100 km', 4, '36 phút (10% - 70%)', 1, 99999999.99, 5, 'còn');

-- -- --------------------------------------------------------

-- -- Table structure for table `transactions`

-- CREATE TABLE `transactions` (
--   `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
--   `product_id` varchar(50) NOT NULL,
--   `customer_id` int(11) NOT NULL,
--   `transaction_date` date NOT NULL,
--   `sale_price` decimal(10,2) NOT NULL,
--   `deposit` decimal(10,2) NOT NULL,
--   `transaction_number` int(11) NOT NULL,
--   `payment_method` enum('Tiền mặt','Chuyển khoản','Trả góp') NOT NULL,
--   `transaction_status` enum('Hoàn thành','Đã cọc','Hủy bỏ') NOT NULL,
--   PRIMARY KEY (`transaction_id`),
--   KEY `product_id` (`product_id`),
--   KEY `customer_id` (`customer_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Dumping data for table `transactions`

-- INSERT INTO `transactions` (`transaction_id`, `product_id`, `customer_id`, `transaction_date`, `sale_price`, `deposit`, `transaction_number`, `payment_method`, `transaction_status`) VALUES
-- (1, 'VF01', 1, '2024-07-27', 99999999.99, 50000000.00, 1, 'Chuyển khoản', 'Hoàn thành');

-- -- --------------------------------------------------------

-- -- Table structure for table `users`

-- CREATE TABLE `users` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `name` varchar(50) NOT NULL,
--   `email` varchar(50) NOT NULL,
--   `phone` varchar(15) DEFAULT NULL,
--   `birthday` date DEFAULT NULL,
--   `usertype` enum('admin','user') NOT NULL,
--   `password` varchar(50) NOT NULL,
--   `pob` varchar(50) DEFAULT NULL,
--   PRIMARY KEY (`id`),
--   UNIQUE KEY `email` (`email`),
--   KEY `pob_index` (`pob`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Dumping data for table `users`

-- INSERT INTO `users` (`id`, `name`, `email`, `phone`, `birthday`, `usertype`, `password`, `pob`) VALUES
-- (1, 'Lê Văn Cừ', 'levancu976@gmail.com', '0366796412', '2004-07-09', 'user', '123', 'Hồ Chí Minh'),
-- (2, 'Đặng Đức Tĩnh', 'dangductinh1105@gmail.com', '0912412515', '2024-07-10', 'admin', '456', 'Ninh Thuận');

-- -- --------------------------------------------------------

-- -- Constraints for dumped tables

-- -- Constraints for table `locations`
-- ALTER TABLE `locations`
--   ADD CONSTRAINT `locations_fk` FOREIGN KEY (`location_name`) REFERENCES `users` (`pob`);

-- -- Constraints for table `transactions`
-- ALTER TABLE `transactions`
--   ADD CONSTRAINT `transactions_fk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
--   ADD CONSTRAINT `transactions_fk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

-- Trigger
-- DELIMITER $$
-- CREATE TRIGGER `trg_transactions_insert` 
-- AFTER INSERT ON `transactions`
-- FOR EACH ROW 
-- BEGIN
--     DECLARE remain_number INT;

--     -- Lấy số lượng sản phẩm từ bảng `product`
--     SELECT product_number INTO remain_number 
--     FROM product 
--     WHERE product_id = NEW.product_id;

--     -- Nếu sản phẩm không tồn tại
--     IF remain_number IS NULL THEN
--         SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Sản phẩm không tồn tại!';
--     -- Nếu số lượng sản phẩm còn lại đủ
--     ELSEIF remain_number >= NEW.transaction_number THEN
--         UPDATE product 
--         SET product_number = product_number - NEW.transaction_number 
--         WHERE product_id = NEW.product_id;
--     -- Nếu số lượng sản phẩm không đủ
--     ELSE 
--         SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Số lượng sản phẩm không đủ!';
--     END IF;
-- END$$
-- DELIMITER ;

-- DELIMITER $$
-- CREATE Trigger trg_transactions_update_soluong
-- afTER UPDATE on transactions
-- for EACH ROW
-- BEGIN
--   if OLD.transaction_number <> NEW.transaction_number then
--     if NEW.transaction_number < 0 then SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = 'so ....';
--     else UPDATE product
--     set product_number = product_number -(NEW.transaction_number - OLD.transaction_number)
--     where product_id = NEW.product_id;


--       if(SELECT product_number from product where product_id = NEW.product_id) < 0 then
--         SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Số lượng xe không thể nhỏ hơn 0.';
--         end IF;
--     END if;
--   END IF;

-- END
-- $$
-- DELIMITER ;

-- COMMIT;

<<<<<<< HEAD
--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `locations_fk` (`location_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `pob_index` (`pob`);
=======
>>>>>>> e6d015700399f50c37851aac9b16a853f79dde7e


<<<<<<< HEAD
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_fk` FOREIGN KEY (`location_name`) REFERENCES `users` (`pob`) ON DELETE CASCADE ;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE,
COMMIT;
=======
>>>>>>> e6d015700399f50c37851aac9b16a853f79dde7e

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


