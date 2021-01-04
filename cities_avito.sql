-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 03 2021 г., 16:42
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
-- Структура таблицы `cities_avito`
--

CREATE TABLE `cities_avito` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `county_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cities_avito`
--

INSERT INTO `cities_avito` (`id`, `name`, `county_id`) VALUES
(1, 'Санкт-Петербург', 1),
(2, 'Москва', 1),
(3, 'Новосибирск', 1),
(4, 'Казань', 1),
(5, 'Сочи', 1),
(6, 'Уфа', 1),
(7, 'Екатеринбург', 1),
(8, 'Киев', 2),
(9, 'Одесса', 2),
(10, 'Минск', 3),
(11, 'Витебск', 3),
(12, 'Астана', 4),
(13, 'Алматы', 4),
(14, 'Таллин', 5),
(15, 'Вильнюс ', 6),
(16, 'Рига', 7),
(17, 'Кишенёв', 8),
(18, 'Душанбе', 9),
(19, 'Ташкент', 10),
(20, 'Бишкек', 11),
(21, 'Ашхабад', 12),
(22, 'Бордо', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cities_avito`
--
ALTER TABLE `cities_avito`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cities_avito`
--
ALTER TABLE `cities_avito`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
