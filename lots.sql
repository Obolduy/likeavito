-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 03 2021 г., 16:43
-- Версия сервера: 8.0.19
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lots`
--

CREATE TABLE `lots` (
  `id` int NOT NULL,
  `owner_id` int DEFAULT NULL,
  `category_id` int NOT NULL,
  `title` varchar(256) NOT NULL,
  `price` int NOT NULL,
  `description` text NOT NULL,
  `photo` text NOT NULL,
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `lots`
--

INSERT INTO `lots` (`id`, `owner_id`, `category_id`, `title`, `price`, `description`, `photo`, `add_time`, `update_time`) VALUES
(1, 1, 1, 'НАЗВАНИЕ1', 500, 'ОПИСАНИЕ1', 'ФОТО1', '2020-12-30 08:00:48', '2020-12-31 12:41:08'),
(4, 0, 4, 'НАЗВАНИЕ4', 50440, 'ОПИСАНИЕ4', 'ФОТО4', '2020-12-30 12:11:48', '2020-12-31 12:41:28'),
(6, 0, 5, 'НАЗВАНИЕ6', 50000, 'ОПИСАНИЕ6', 'ФОТО6', '2020-12-30 22:11:48', '2020-12-31 12:41:44'),
(7, 0, 5, 'dcdsvsd', 14, '', 'dsdc', '2020-12-30 22:16:59', '2020-12-31 12:41:47'),
(8, NULL, 6, 'fvd', 222, '', 'fdgfg', '2020-12-31 13:44:48', '2020-12-31 13:44:48'),
(9, NULL, 7, 'dwef', 3232313, '', 'dsffasdsfd', '2020-12-31 20:02:37', '2020-12-31 20:02:37'),
(10, 12, 2, 'fqefe', 342, '', 'dsfa', '2020-12-31 20:03:56', '2020-12-31 20:03:56'),
(13, 7, 1, 'ОДИН', 100000, '', 'ТРИИИИ', '2021-01-02 14:33:52', '2021-01-02 14:33:52'),
(14, 7, 1, 'НАЗВАНИЕ3', 14, 'defe', 'ФОТО3', '2021-01-02 14:36:05', '2021-01-02 14:52:46'),
(15, 7, 3, 'we', 74, 'dfsfsfffdf', 'sc', '2021-01-02 14:40:58', '2021-01-02 14:40:58'),
(16, 7, 3, 'НАЗВАНИЕ300', 14, 'grgwr', 'ФОТО34', '2021-01-02 15:13:23', '2021-01-02 15:13:23'),
(17, 7, 2, 'НАЗВАНИЕ3747', 857, 'tyhrhytyhxcx', 'yjyr', '2021-01-02 15:13:59', '2021-01-02 16:39:54'),
(18, 7, 8, 'efef', 474, 'hnhn', '.', '2021-01-02 16:11:02', '2021-01-02 16:11:02'),
(19, 17, 3, 'FFHFHF', 145, 'fwefewfefrw', 'SAM_0320.jpg', '2021-01-03 14:00:22', '2021-01-03 14:00:22');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lots`
--
ALTER TABLE `lots`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
