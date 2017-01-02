-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2013 at 08:44 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bliwatch`
--

-- --------------------------------------------------------

--
-- Table structure for table `twitter_api`
--

CREATE TABLE IF NOT EXISTS `twitter_api` (
  `id` varchar(10) NOT NULL,
  `apikey` varchar(100) NOT NULL,
  `s_apikey` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `twitter_api`
--

INSERT INTO `twitter_api` (`id`, `apikey`, `s_apikey`, `file_name`) VALUES
('111', '', '', 'users.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `landline` varchar(10) NOT NULL,
  `key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`username`, `password`, `name`, `age`, `gender`, `address`, `email`, `mobile`, `landline`, `key`) VALUES
('assa', 'bkjbkjbnk', 'nkjnkjn', 76, 'female', 'nbk,nkjn', 'nkjnk', 'bkbjk', 'bkjb', ''),
('Dijil', 'dijil', 'Dijil', 12, 'male', 'Manis Nagar,\r\n', '', '9894985156', '0422233233', ''),
('ddd', 'ddd', 'ddd', 0, 'male', 'ddd', '', 'ddd', 'ddd', ''),
('aaa', 'aaa', 'aaajjj', 23, 'female', 'Manis Nagar', 'dijil@gmail.com', '6373736444', '0422', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
