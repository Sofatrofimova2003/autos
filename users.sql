-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 19 2024 г., 18:53
-- Версия сервера: 5.7.40
-- Версия PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `regis`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, '11', '11@yandex.ru', '$2y$10$O5tesWfdE4M8e.Pc96Nl/OiBnBm.TEsWQSSNxlVrHcRgemjjmaK0O'),
(2, '22', '22@yandex.ru', '$2y$10$yI8UZmkueFOTF6Qf/GGJ8.01.2Gjwq2FeKf6CAaJN0cCmXFjpReUO'),
(3, 'Ð¢Ñ€Ð¾Ñ„Ð¸Ð¼Ð¾Ð²Ð° Ð¡Ð¾Ñ„ÑŒÑ', 'Sofa11@yandex.ru', '$2y$10$sJNrgZt0n06GTMfoI.hEuuYzkx7d/4ZwtvS1zKNXepy5ChGfo3P3W');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
