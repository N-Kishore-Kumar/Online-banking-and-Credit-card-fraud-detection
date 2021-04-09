-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2021 at 04:30 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `acbal`
--

CREATE TABLE `acbal` (
  `fro` varchar(20) NOT NULL,
  `ton` varchar(20) NOT NULL,
  `dat` varchar(30) NOT NULL,
  `amt` int(11) NOT NULL,
  `balan` int(11) NOT NULL,
  `balanto` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acbal`
--

INSERT INTO `acbal` (`fro`, `ton`, `dat`, `amt`, `balan`, `balanto`) VALUES
('500010010000001', '500010010000002', '13/10/2020 07:09:19pm', 100, 345, 12126),
('500010010000001', '500010010000002', '27/10/2020 08:30:23am', 100, 245, 12226);

-- --------------------------------------------------------

--
-- Table structure for table `acntdetails`
--

CREATE TABLE `acntdetails` (
  `user_id` int(10) NOT NULL,
  `branchcode` varchar(6) NOT NULL,
  `Account_no` varchar(15) NOT NULL,
  `Currency_type` text NOT NULL,
  `Opening_date` date NOT NULL,
  `Aadhar_card` varchar(14) NOT NULL,
  `Pan_no` varchar(10) NOT NULL,
  `balance` double DEFAULT NULL,
  `cardn` bigint(20) NOT NULL,
  `pin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acntdetails`
--

INSERT INTO `acntdetails` (`user_id`, `branchcode`, `Account_no`, `Currency_type`, `Opening_date`, `Aadhar_card`, `Pan_no`, `balance`, `cardn`, `pin`) VALUES
(1, '000001', '500010010000001', 'INR', '2015-04-11', '4212 3328 9354', 'ABCD49139P', 245.23, 1111222233334444, 1712),
(2, '000001', '500010010000002', 'INR', '2020-08-25', '441683932431', '2131231', 12225.56, 3333444455556666, 1122);

-- --------------------------------------------------------

--
-- Table structure for table `bankdetails`
--

CREATE TABLE `bankdetails` (
  `branchcode` varchar(6) NOT NULL,
  `IFSCcode` varchar(11) NOT NULL,
  `branchname` text NOT NULL,
  `address` text NOT NULL,
  `district` tinytext DEFAULT NULL,
  `country` tinytext DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `state` tinytext DEFAULT NULL,
  `bankname` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bankdetails`
--

INSERT INTO `bankdetails` (`branchcode`, `IFSCcode`, `branchname`, `address`, `district`, `country`, `pincode`, `phone_no`, `email`, `state`, `bankname`) VALUES
('000001', 'KVRA0000001', 'Anna Nagar', 'KVR Bank, Thirumangalam, Anna Nagar West, Anna Nagar', 'Chennai', 'India', '600040', '04426460680', 'kvrangr01@gmail.com', 'Tamil Nadu', 'KVRA');

-- --------------------------------------------------------

--
-- Table structure for table `creditcardinfo`
--

CREATE TABLE `creditcardinfo` (
  `user_id` int(10) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `creditcardinfo`
--

INSERT INTO `creditcardinfo` (`user_id`, `name`, `username`, `password`, `email`, `phone_no`, `dob`) VALUES
(1, 'test', 'test12', 'Test@123', 'test@gmail.com', '9873621383', '1995-08-17'),
(2, 'Vibhav Aakash', 'projectdefence', 'dvsfcv fcv', 'koushalvibhav@gmail.com', '9030651794', '2020-08-13'),
(3, 'Kishore', 'kishore237', 'Php@123', 'nkishorekumar237@gmail.com', '9345871716', '2000-12-17'),
(12, 'dfbfbd', 'rsv', 'dvsdvdaxS123@', 'koushalvibav@gmail.com', '9030653794', '2020-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `dob` date NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `district` text NOT NULL,
  `state` text NOT NULL,
  `phone_no` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pincode` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `user_id`, `dob`, `gender`, `address`, `district`, `state`, `phone_no`, `email`, `pincode`) VALUES
(1, 1, '1983-11-06', 'Male', '243, Prabhat Indl Estate, Sarita, W E Highway, Dahisar', 'Mumbai', 'Maharashtra', '9118971632', 'test@gmail.com', 400068);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `branchcode` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`, `branchcode`) VALUES
(1, 'test', '1a52e17fa899cf40fb04cfc42e6352f1', 'Bot', '000001'),
(2, 'admin', '4e38e1cb7c299923f23e26a6c52ab05e', 'admin', '000001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acntdetails`
--
ALTER TABLE `acntdetails`
  ADD PRIMARY KEY (`Account_no`),
  ADD UNIQUE KEY `aacard` (`Aadhar_card`),
  ADD UNIQUE KEY `pacar` (`Pan_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `branchcode` (`branchcode`);

--
-- Indexes for table `bankdetails`
--
ALTER TABLE `bankdetails`
  ADD PRIMARY KEY (`branchcode`);

--
-- Indexes for table `creditcardinfo`
--
ALTER TABLE `creditcardinfo`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uni` (`username`),
  ADD UNIQUE KEY `uni2` (`password`),
  ADD UNIQUE KEY `uni3` (`email`),
  ADD UNIQUE KEY `uni4` (`phone_no`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `branchcode` (`branchcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creditcardinfo`
--
ALTER TABLE `creditcardinfo`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`branchcode`) REFERENCES `bankdetails` (`branchcode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
