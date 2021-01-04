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
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `city_id` int NOT NULL,
  `status_id` int NOT NULL,
  `ban_status` int NOT NULL,
  `reg_time` datetime NOT NULL,
  `login` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `city_id`, `status_id`, `ban_status`, `reg_time`, `login`) VALUES
(1, 'Валерий Альбертович', 'sfff', 1, 2, 0, '2020-12-28 20:05:13', 'sdds'),
(2, 'Додик', 'ffsa', 8, 2, 0, '2020-12-28 20:05:15', 'cdvd'),
(3, 'Хахах', '252541', 1, 2, 0, '2020-12-28 20:41:43', 'dsas'),
(4, 'dsfde', '111111', 5, 2, 0, '2020-12-29 19:27:18', 'User1sd'),
(5, 'ewewewefw', '111111', 14, 2, 0, '2020-12-30 12:23:14', 'rfewferfrf'),
(6, 'grewgc', '111111', 21, 2, 0, '2020-12-30 12:25:10', 'user2feweqf'),
(7, 'Александр Иванович', '111111', 9, 2, 0, '2020-12-30 12:56:35', 'User01'),
(8, 'wewedfss', '111111', 16, 2, 0, '2020-12-30 12:57:36', 'ssvdvwd'),
(9, 'wewedsaav', '111111', 17, 2, 0, '2020-12-30 12:59:00', 'dadvdvd'),
(10, 'vrewfgrgr', '111111', 4, 2, 0, '2020-12-30 21:34:56', 'dwfdffdf'),
(11, 'wewefsdfd', '1111111', 12, 2, 0, '2020-12-31 13:45:24', 'User1dfdgd'),
(12, 'fdfwdfwewf', '111111', 10, 2, 0, '2020-12-31 20:03:49', 'werfefqwf'),
(13, 'dfefefwff', '111111', 1, 2, 0, '2021-01-02 13:16:20', 'User0185'),
(14, 'вцуауауца', '111111', 7, 2, 0, '2021-01-02 13:16:57', 'User01774'),
(15, 'efeqfqfe', '$2y$10$zuhnxbEw46vFJ.NR8FbV3OWuUEUD4N//LQykU78lE1DdeJEOWDfUK', 12, 2, 0, '2021-01-02 21:41:57', 'fefwfefw'),
(16, 'cffefe', '$2y$10$eLUVrQBEgnZjahASJZS6kus70kVe6fLVAyBlWS2u0CsSPAcxzY0.e', 1, 2, 0, '2021-01-02 22:12:35', 'User11'),
(17, 'dcwfef', '$2y$10$KZ6lggUDEtoW.CHvhknJr..baL8vKa0U91mjNVgTZ1gj7r5E23aaC', 1, 2, 0, '2021-01-03 13:56:10', 'fefwfefwd');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
