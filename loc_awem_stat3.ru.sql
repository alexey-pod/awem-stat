-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 31 2016 г., 00:17
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `loc_awem_stat3.ru`
--

-- --------------------------------------------------------

--
-- Структура таблицы `day_data`
--

CREATE TABLE IF NOT EXISTS `day_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `day_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `datetime` int(10) NOT NULL,
  `device_id` varchar(64) NOT NULL,
  `platform` enum('ipad','iphone') NOT NULL,
  `data` varchar(500) NOT NULL COMMENT 'присланные данные разделитель,',
  PRIMARY KEY (`id`),
  KEY `day_id` (`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='стат данные происходящие в течении дня' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
