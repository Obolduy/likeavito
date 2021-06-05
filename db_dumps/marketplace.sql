-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 05 2021 г., 22:37
-- Версия сервера: 8.0.19
-- Версия PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `marketplace`
--

-- --------------------------------------------------------

--
-- Структура таблицы `api_user_tokens`
--

CREATE TABLE `api_user_tokens` (
  `id` int NOT NULL,
  `token` varchar(64) NOT NULL,
  `user_id` int NOT NULL,
  `actual_from` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `api_user_tokens`
--

INSERT INTO `api_user_tokens` (`id`, `token`, `user_id`, `actual_from`) VALUES
(1, 'fmdfmdddddddsaf8884', 45, '2021-05-11'),
(2, '3c5d30acfe44904c5e76d4836d6c490e', 46, '2021-05-11'),
(3, '59a23e5452ce22374195fe741950b171', 21, '2021-05-11');

-- --------------------------------------------------------

--
-- Структура таблицы `chats_list`
--

CREATE TABLE `chats_list` (
  `id` int NOT NULL,
  `chat` varchar(256) NOT NULL,
  `user1_id` int NOT NULL,
  `user2_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `chats_list`
--

INSERT INTO `chats_list` (`id`, `chat`, `user1_id`, `user2_id`) VALUES
(1, 'chat_55544', 555, 44),
(2, 'chat_4243', 42, 43),
(3, 'chat_49_38', 49, 38),
(5, 'chat_6a969987d95675e2caf4e00d8453c1ef', 49, 2),
(6, 'chat_7b097ef194d72cb9b3264c4ff252d78a', 49, 1),
(7, 'chat_5cd6a063c51df65aa0d61bbfd9882874', 1, 10),
(8, 'chat_821588896b793f28e7b607f4f43ee80b', 1, 17),
(9, 'chat_7177ff6aafad58b0656fca6e31b41601', 1, 15),
(10, 'chat_18fadeb3abce5f4e7e0900dae55b7a05', 5, 28),
(11, 'chat_53200e57c4ccd64378017b367b5d3b4e', 1, 20),
(12, 'chat_d3aaa443a89bd4841aa021a44583a56b', 4, 38),
(13, 'chat_613d3d5df83eba8845a8211a48fdd3dd', 8, 11),
(14, 'chat_ec18e4b5b552fe56d3b88fcc746ceea1', 7, 12),
(15, 'chat_8d9ed36bfaa70b8e8fb691b326e1a0dd', 9, 13),
(16, 'chat_b548521f5c2763bb46c98923ce8cb7c8', 10, 14),
(17, 'chat_613d3d5df83eba8845a8211a48fdd3dd', 8, 11),
(18, 'chat_ec18e4b5b552fe56d3b88fcc746ceea1', 7, 12),
(19, 'chat_8d9ed36bfaa70b8e8fb691b326e1a0dd', 9, 13),
(20, 'chat_b548521f5c2763bb46c98923ce8cb7c8', 10, 14),
(21, 'chat_613d3d5df83eba8845a8211a48fdd3dd', 8, 11),
(22, 'chat_ec18e4b5b552fe56d3b88fcc746ceea1', 7, 12),
(23, 'chat_8d9ed36bfaa70b8e8fb691b326e1a0dd', 9, 13),
(24, 'chat_b548521f5c2763bb46c98923ce8cb7c8', 10, 14);

-- --------------------------------------------------------

--
-- Структура таблицы `chat_7b097ef194d72cb9b3264c4ff252d78a`
--

CREATE TABLE `chat_7b097ef194d72cb9b3264c4ff252d78a` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `chat_7b097ef194d72cb9b3264c4ff252d78a`
--

INSERT INTO `chat_7b097ef194d72cb9b3264c4ff252d78a` (`id`, `message`, `user_id`, `date`) VALUES
(1, 'fdsdfdfs', 49, '2021-06-03 10:28:34'),
(2, 'fsdfdf', 49, '2021-06-03 14:01:05'),
(3, 'fsd', 1, '2021-06-03 14:03:32'),
(5, 'v', 1, '2021-06-03 14:05:44'),
(6, 'fsd', 1, '2021-06-03 14:08:06'),
(14, 'cxz', 1, '2021-06-03 15:27:33'),
(15, 'fffggf', 1, '2021-06-03 16:26:47'),
(16, 'vdvd', 1, '2021-06-03 16:26:50'),
(17, 'gfghg', 1, '2021-06-03 16:26:55'),
(18, 'Новый текст', 49, '2021-06-03 16:27:27'),
(20, 'ff[ff[f[f[f[', 1, '2021-06-03 16:30:50'),
(21, 'Еще новое', 1, '2021-06-03 16:35:28'),
(22, 'dcddsvdvvdfvvvvfv', 1, '2021-06-03 16:57:32'),
(23, 'dfsdfdsfsdfdf', 1, '2021-06-03 16:59:09'),
(24, 'cvxcvxcc', 1, '2021-06-03 17:00:31'),
(25, 'ahahhah', 1, '2021-06-03 17:02:53'),
(26, 'vdvdvd', 1, '2021-06-03 17:03:04'),
(27, 'fsdf', 1, '2021-06-03 17:08:11'),
(28, 'мввчм', 1, '2021-06-03 17:13:20'),
(29, 'Xnj nfrjt', 49, '2021-06-05 15:00:44'),
(30, 'Что такое', 49, '2021-06-05 15:00:48'),
(31, 'vfvfd', 49, '2021-06-05 15:57:44'),
(32, 'a?', 49, '2021-06-05 15:57:48'),
(33, 'dd', 49, '2021-06-05 15:57:51'),
(34, 'Вот текст', 49, '2021-06-05 15:58:36'),
(35, '', 49, '2021-06-05 15:58:38'),
(36, 'Последнее', 49, '2021-06-05 15:59:27'),
(37, 'ахахах', 49, '2021-06-05 15:59:31'),
(38, 'dds', 49, '2021-06-05 16:06:18'),
(39, 'Ластван', 49, '2021-06-05 16:08:05'),
(40, 'НАМАААААААААААААААНА', 1, '2021-06-05 16:10:45'),
(41, 'Данила ты что крези', 49, '2021-06-05 16:12:37'),
(42, '[t[', 49, '2021-06-05 16:18:51'),
(43, 'Дrtrtr', 1, '2021-06-05 16:19:16'),
(44, 'xssssss', 1, '2021-06-05 16:54:18'),
(45, '', 1, '2021-06-05 17:15:50'),
(46, '', 1, '2021-06-05 17:16:25'),
(47, '', 1, '2021-06-05 17:17:41'),
(48, 'Vot forma', 1, '2021-06-05 17:17:58'),
(49, 'fsd', 49, '2021-06-05 17:31:35'),
(50, 'ss', 49, '2021-06-05 17:32:49'),
(51, 'dfgergerg', 49, '2021-06-05 17:33:05'),
(52, 'fdsfd', 49, '2021-06-05 17:35:35'),
(53, 'fdsf', 49, '2021-06-05 17:36:03'),
(54, 'ss', 49, '2021-06-05 17:36:18'),
(55, 'fds', 49, '2021-06-05 17:37:35'),
(56, 'dffe', 49, '2021-06-05 17:37:39'),
(57, 'cvbvbvbb', 49, '2021-06-05 17:38:06');

-- --------------------------------------------------------

--
-- Структура таблицы `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd`
--

CREATE TABLE `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd`
--

INSERT INTO `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd` (`id`, `message`, `user_id`, `date`) VALUES
(1, 'Test Message2', 9, '2021-06-05 17:47:03'),
(2, 'Test Message2', 9, '2021-06-05 17:47:45');

-- --------------------------------------------------------

--
-- Структура таблицы `chat_18fadeb3abce5f4e7e0900dae55b7a05`
--

CREATE TABLE `chat_18fadeb3abce5f4e7e0900dae55b7a05` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `chat_613d3d5df83eba8845a8211a48fdd3dd`
--

CREATE TABLE `chat_613d3d5df83eba8845a8211a48fdd3dd` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `chat_613d3d5df83eba8845a8211a48fdd3dd`
--

INSERT INTO `chat_613d3d5df83eba8845a8211a48fdd3dd` (`id`, `message`, `user_id`, `date`) VALUES
(1, 'Новое сообщение4', 11, '2021-06-05 17:47:03'),
(2, 'Новое сообщение4', 11, '2021-06-05 17:47:46');

-- --------------------------------------------------------

--
-- Структура таблицы `chat_53200e57c4ccd64378017b367b5d3b4e`
--

CREATE TABLE `chat_53200e57c4ccd64378017b367b5d3b4e` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `chat_b548521f5c2763bb46c98923ce8cb7c8`
--

CREATE TABLE `chat_b548521f5c2763bb46c98923ce8cb7c8` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `chat_b548521f5c2763bb46c98923ce8cb7c8`
--

INSERT INTO `chat_b548521f5c2763bb46c98923ce8cb7c8` (`id`, `message`, `user_id`, `date`) VALUES
(1, 'TestMessage1', 1, '2021-06-05 17:47:03'),
(2, 'TestMessage1', 1, '2021-06-05 17:47:44');

-- --------------------------------------------------------

--
-- Структура таблицы `chat_d3aaa443a89bd4841aa021a44583a56b`
--

CREATE TABLE `chat_d3aaa443a89bd4841aa021a44583a56b` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `chat_ec18e4b5b552fe56d3b88fcc746ceea1`
--

CREATE TABLE `chat_ec18e4b5b552fe56d3b88fcc746ceea1` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `chat_ec18e4b5b552fe56d3b88fcc746ceea1`
--

INSERT INTO `chat_ec18e4b5b552fe56d3b88fcc746ceea1` (`id`, `message`, `user_id`, `date`) VALUES
(1, 'Новоесообщение3', 12, '2021-06-05 17:47:03'),
(2, 'Новоесообщение3', 12, '2021-06-05 17:47:45');

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int NOT NULL,
  `city` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `city`) VALUES
(1, 'Санкт-Петербург'),
(2, 'Москва'),
(3, 'Новосибирск'),
(4, 'Казань'),
(5, 'Сочи'),
(6, 'Уфа'),
(7, 'Екатеринбург'),
(8, 'Киев'),
(9, 'Одесса'),
(10, 'Минск'),
(11, 'Витебск'),
(12, 'Астана'),
(13, 'Алматы'),
(14, 'Таллин'),
(15, 'Вильнюс '),
(16, 'Рига'),
(17, 'Кишенёв'),
(18, 'Душанбе'),
(19, 'Ташкент'),
(20, 'Бишкек'),
(21, 'Ашхабад'),
(22, 'Бордо');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `lot_id` int NOT NULL,
  `description` text NOT NULL,
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `lot_id`, `description`, `add_time`, `update_time`) VALUES
(10, 1, 2, 'vfdvfdfdffbdbfbsbfdb', '2021-05-16 12:05:40', '2021-05-16 12:05:40'),
(11, 1, 2, '', '2021-05-16 12:05:55', '2021-05-16 12:05:55'),
(12, 1, 2, 'dsffsfd', '2021-05-16 12:06:03', '2021-05-16 12:06:03'),
(13, 1, 2, '', '2021-05-16 12:06:57', '2021-05-16 12:06:57'),
(14, 1, 8, 'bbngndn', '2021-05-16 12:07:24', '2021-05-16 12:07:24'),
(15, 1, 8, 'sdffbf', '2021-05-16 12:07:42', '2021-05-16 12:07:42'),
(16, 1, 8, 'cdvdfbfdb<br> bdfsdf<br>', '2021-05-16 12:07:58', '2021-05-16 12:07:58'),
(17, 1, 28, 'dfdfdf', '2021-05-16 12:11:42', '2021-05-16 12:11:42'),
(18, 1, 28, 'dfsfsdfsd', '2021-05-16 12:12:37', '2021-05-16 12:12:37');

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
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `lots`
--

INSERT INTO `lots` (`id`, `owner_id`, `category_id`, `title`, `price`, `description`, `add_time`, `update_time`) VALUES
(8, 48, 6, 'Русский титул', 10, 'Описание ван  dddту три', '2020-12-31 13:44:48', '2021-05-16 11:44:15'),
(30, 10, 2, 'newAdd5', 434, 'fdfs5fdfdfd', '2021-04-29 19:01:59', NULL),
(32, NULL, 2, 'newAdd6', 757858, 'fddfdffdfd', '2021-04-29 19:33:38', NULL),
(33, NULL, 2, 'newAdd7', 5355, 'newAdd88', '2021-04-29 19:33:38', NULL),
(34, NULL, 2, 'newAdd8', 757858, 'fddfdffdfd', '2021-04-29 19:34:37', NULL),
(35, NULL, 2, 'newAdd9', 5355, 'newAdd88', '2021-04-29 19:34:37', NULL),
(36, NULL, 2, 'newAdd10', 5355, 'newAdd88', '2021-04-29 19:34:37', NULL),
(37, NULL, 2, 'newAdd11', 5355, 'newAdd88', '2021-04-29 19:34:37', NULL),
(38, NULL, 2, 'fdfdfd', 5355, 'fdfsdfdfd', '2021-04-29 19:34:37', '2021-05-14 16:00:10'),
(39, 49, 1, 'fdsfsdf', 3213, 'ffdsdf', '2021-06-04 18:39:27', '2021-06-04 18:39:27'),
(40, 49, 1, 'fdsf', 312312, 'wds', '2021-06-04 18:59:01', '2021-06-04 18:59:01'),
(41, 49, 1, 'fgdfgdfg', 432, 'fdfdsf', '2021-06-04 19:01:39', '2021-06-04 19:01:39'),
(42, 49, 1, 'Новый лотик))', 23, 'вавычс', '2021-06-04 19:03:08', '2021-06-04 19:03:08');

-- --------------------------------------------------------

--
-- Структура таблицы `lots_category`
--

CREATE TABLE `lots_category` (
  `id` int NOT NULL,
  `category` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `lots_category`
--

INSERT INTO `lots_category` (`id`, `category`) VALUES
(1, 'Фототехника'),
(2, 'Одежда'),
(3, 'Хобби'),
(4, 'Различная электроника'),
(5, 'Шоколадные орешки'),
(6, 'Товары для рисования'),
(7, 'Другое'),
(8, 'Услуги');

-- --------------------------------------------------------

--
-- Структура таблицы `lots_pictures`
--

CREATE TABLE `lots_pictures` (
  `id` int NOT NULL,
  `lot_id` int NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `lots_pictures`
--

INSERT INTO `lots_pictures` (`id`, `lot_id`, `picture`) VALUES
(5, 8, 'dd7536794b63bf90eccfd37f9b147d7f'),
(6, 8, 'd41d8cd98f00b204e9800998ecf8427e'),
(7, 8, 'dd7536794b63bf90eccfd37f9b147d7f'),
(8, 8, 'd41d8cd98f00b204e9800998ecf8427e'),
(9, 8, 'dd7536794b63bf90eccfd37f9b147d7f'),
(10, 8, '69691c7bdcc3ce6d5d8a1361f22d04ac'),
(11, 8, 'dfcf28d0734569a6a693bc8194de62bf'),
(12, 8, 'b14a7b8059d9c055954c92674ce60032'),
(13, 8, 'c81e728d9d4c2f636f067f89cc14862c'),
(14, 8, 'c81e728d9d4c2f636f067f89cc14862c'),
(15, 8, 'dd7536794b63bf90eccfd37f9b147d7f'),
(16, 8, '69691c7bdcc3ce6d5d8a1361f22d04ac'),
(17, 8, 'dfcf28d0734569a6a693bc8194de62bf'),
(18, 8, 'b14a7b8059d9c055954c92674ce60032'),
(19, 8, 'c81e728d9d4c2f636f067f89cc14862c'),
(20, 8, 'c81e728d9d4c2f636f067f89cc14862c'),
(21, 8, '075bba0bb9e2903daf8fadde0381b048.JPG'),
(22, 8, 'd2d1e55b40749c9290af4008706958ab.JPG'),
(23, 8, '1f45e9f3795e5a75b52285947b747417.JPG'),
(24, 8, '7620b8c321a6b6c018fa3535a42a2cef.JPG'),
(25, 8, 'd41d8cd98f00b204e9800998ecf8427e'),
(26, 30, '075bba0bb9e2903daf8fadde0381b048.JPG'),
(27, 30, 'd2d1e55b40749c9290af4008706958ab.JPG'),
(28, 30, '1f45e9f3795e5a75b52285947b747417.JPG'),
(29, 30, '7620b8c321a6b6c018fa3535a42a2cef.JPG');

-- --------------------------------------------------------

--
-- Структура таблицы `names`
--

CREATE TABLE `names` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `names`
--

INSERT INTO `names` (`id`, `user_id`, `name`) VALUES
(1, 1, ''),
(2, 2, 'Name'),
(7, 7, 'fewffwq'),
(8, 8, 'gerg'),
(9, 9, 'fddfg'),
(10, 10, 'fddfgew'),
(11, 11, 'Cbbthrht'),
(12, 12, 'fgthnbb'),
(13, 13, 'tyturofkv'),
(14, 14, 'sfdggds'),
(15, 15, 'sfdggdsf'),
(16, 16, 'dffdfd'),
(17, 17, 'Name'),
(18, 18, 'Name'),
(19, 19, 'Name'),
(20, 20, 'Name'),
(25, 21, 'newname1'),
(28, 24, 'newname4'),
(29, 33, 'TestLogin1'),
(30, 34, 'TestLogin2'),
(31, 35, 'TestLogin3'),
(32, 36, 'TestLogin4'),
(34, 22, 'newname2'),
(35, 23, 'newname3'),
(41, 37, 'Вадик'),
(42, 38, 'dddfsdf'),
(43, 39, 'dsds'),
(44, 40, 'Евлампий'),
(45, 41, 'newname4'),
(46, 42, 'newname3'),
(47, 43, 'newname2'),
(52, 48, 'newname1'),
(53, 49, 'erferefwer');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int NOT NULL,
  `email` char(64) NOT NULL,
  `token` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `token`) VALUES
(11, 'test@mail.ru', '3698adc43147669189f145846afa856e'),
(12, 'newemail@iss.ru', 'c12a055be7b262511ba9724d64307ea6'),
(13, 'fern@yande.ru', 'a18791e03c44cd7ea363a79032d7e1bf'),
(14, 'Emewail@wadw.ru', 'bde94bc129a30e64f6199fd3e458a727'),
(15, 'test@mail.ru', '22b4b631db5140ad47fe92ad5888cd76'),
(16, 'newemail@iss.ru', '48fca347e85c32f43be1060729535325'),
(17, 'fern@yande.ru', '860a2a9f7adea58cc9cdb00b72073491'),
(18, 'Emewail@wadw.ru', '39704320582f088288fe12994e40a2f9'),
(19, 'test@mail.ru', '51496174e516cfd79755f4047bc1df1d'),
(20, 'newemail@iss.ru', '484830a0e6d45ea0a83c2c3bbefd62ee'),
(21, 'fern@yande.ru', '758ebee4c9934df30a21318c2dc6b6a6'),
(22, 'Emewail@wadw.ru', '21cf2b39466f37bd1999663b1538154c'),
(23, 'test@mail.ru', '515a23f68d198657dec267c98ef29fb4'),
(24, 'newemail@iss.ru', '4558c2e2783c0673392c59499c9caf1d'),
(25, 'fern@yande.ru', '93adb1ac2e6ed77ec27bfabc36dc5e07'),
(26, 'Emewail@wadw.ru', '6136d586195aa259a33cc997777a1bab'),
(27, 'test@mail.ru', 'fa9a247876ad39038c371a5dd0087d24'),
(28, 'newemail@iss.ru', 'f9d337fc3f7fc210fddd29ce16147bc3'),
(29, 'fern@yande.ru', '55d2f54299161629de9e2f60d05c0356'),
(30, 'Emewail@wadw.ru', '42836b0e98fd9db2891bf2ca7e0875e5'),
(31, 'test@mail.ru', 'c31f2a849f35702dec29d24e64259d6b'),
(32, 'newemail@iss.ru', '12e26cfc467e7911f5abb1c3026278da'),
(33, 'fern@yande.ru', 'fbf976a45cd04ef23142516e3b480363'),
(34, 'Emewail@wadw.ru', 'c7e3294f7a7c1a5cb9cdce32ac7ba507'),
(35, 'test@mail.ru', 'a4019dfa0bb712df209cc0fe9ae77d1b'),
(36, 'newemail@iss.ru', '9f4c42f119279eb5333700c2de4b94fb'),
(37, 'fern@yande.ru', '455d7f6e48ce62f00edb81dd87bd0580'),
(38, 'Emewail@wadw.ru', '78e3ceadaf7cea8fd30553f171bed7f6'),
(39, 'test@mail.ru', '496b5e5458ba8d84f5a5ff1cb98a1f3c'),
(40, 'newemail@iss.ru', 'bec57ed16dc853066549a9d1b70c6c67'),
(41, 'fern@yande.ru', 'ef48d8f06cf33bc6ba619337110921c5'),
(42, 'Emewail@wadw.ru', '59ed91885fde022604e2ae0a540cfdc5'),
(43, 'test@mail.ru', '66a72c942da4b3f69ff83505a7e8b63b'),
(44, 'newemail@iss.ru', '34bb9c877c896d434d074be3fe562a21'),
(45, 'fern@yande.ru', '9317fcd50f34f4646606eaaf70248fb9'),
(46, 'Emewail@wadw.ru', '8b47135ba9f4e1be0ab0118ae161a9d9'),
(47, 'test@mail.ru', 'aa4cabfe5ff349ba9f51dfda1aee012e'),
(48, 'newemail@iss.ru', '3b96b5220d1127dc493003e00881da02'),
(49, 'fern@yande.ru', 'ec77c791a76640a100a51a2be38c696a'),
(50, 'Emewail@wadw.ru', 'd90decfa883c5e8a3230f007dbc2ffa7'),
(51, 'test@mail.ru', '910c7b956abc8cbd80e446001e2368c2'),
(52, 'newemail@iss.ru', 'e366c16315324da2a3eaf82cd2577229'),
(53, 'fern@yande.ru', '54b4bb8e0308ae4a93c51d1c55d57850'),
(54, 'Emewail@wadw.ru', '1d77f413098e414575162025cd8a2d0e'),
(55, 'test@mail.ru', 'e335bf677c005161cd5156ada323ff97'),
(56, 'newemail@iss.ru', 'd2a15c3630e7418e0aea9c4d9401df79'),
(57, 'fern@yande.ru', 'fdd8451fb8b828407c90eb90961d023a'),
(58, 'Emewail@wadw.ru', 'a90939488841fa4262dfff6e887ce9ba'),
(59, 'test@mail.ru', '5d075f2085497009c5078ae3271b7d22'),
(60, 'newemail@iss.ru', 'bea2892df5350239d87e226195f0f466'),
(61, 'fern@yande.ru', 'cc392160adcfa8659027ab3ee6fcc5bc'),
(62, 'Emewail@wadw.ru', 'd53bf595e4d6f9032cb08853c5b7cec2');

-- --------------------------------------------------------

--
-- Структура таблицы `surnames`
--

CREATE TABLE `surnames` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `surname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `surnames`
--

INSERT INTO `surnames` (`id`, `user_id`, `surname`) VALUES
(1, 1, ''),
(2, 2, 'Surname'),
(7, 7, 'sdfdsaf'),
(8, 8, 'grwegerg'),
(9, 9, 'cvx'),
(10, 10, 'cvxw'),
(11, 11, 'Druoredf'),
(12, 12, 'gvccrrfg'),
(13, 13, 'vbmpohlh'),
(14, 14, 'yjuyjujy'),
(15, 15, 'yjuyjujye'),
(16, 16, 'ssdfdfs'),
(17, 17, 'Surname'),
(18, 18, 'Surname'),
(19, 19, 'Surname'),
(20, 20, 'Surname'),
(21, 21, 'newsurname1'),
(22, 22, 'newsurname2'),
(23, 23, 'newsurname3'),
(24, 24, 'newsurname4'),
(29, 33, '12345678'),
(30, 34, '12345678'),
(31, 35, '12345678'),
(32, 36, '12345678'),
(41, 37, 'Витальев'),
(42, 38, 'ddsdsds'),
(43, 39, 'c'),
(44, 40, 'Акакьевич'),
(45, 41, 'newsurname4'),
(46, 42, 'newsurname3'),
(47, 43, 'newsurname2'),
(52, 48, 'newsurname1'),
(53, 49, 'dsfdsafasf');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` text,
  `avatar` text,
  `password` text NOT NULL,
  `city_id` int NOT NULL,
  `status_id` int NOT NULL,
  `ban_status` int NOT NULL,
  `active` int NOT NULL DEFAULT '0',
  `registration_time` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `login` varchar(32) NOT NULL,
  `remember_token` varchar(64) DEFAULT NULL,
  `surname_id` int DEFAULT NULL,
  `name_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `avatar`, `password`, `city_id`, `status_id`, `ban_status`, `active`, `registration_time`, `updated_at`, `login`, `remember_token`, `surname_id`, `name_id`) VALUES
(1, 'test@mail.ru', NULL, '$2y$10$6jUi/DT3RJknkQommkt4sO7/NwHhNPoQQI4sCIvTs3XGz8KWgl7GC', 10, 2, 1, 1, '2021-03-26 20:30:30', '2021-05-15 17:53:16', 'testlogin', '41e4b7abc4d82ec15379cd173d4fc798', 1, 1),
(7, 'fefergergewg', NULL, '$2y$10$xfhJTtkANGFfL3EQvGgWS.DWYz7WXVCXeNv9IE80kOWQTz9R4sYZ2', 2, 1, 0, 0, '2021-03-28 18:50:59', NULL, 'wrwrewrsfd', NULL, NULL, NULL),
(8, 'rgbfbvb', NULL, '$2y$10$LZJXB1bnZ8.0l1JzxWJlxe/cXbQtzjLbO4P8WmIy1jHLR8o28wM1C', 2, 1, 0, 0, '2021-03-28 19:58:28', NULL, 'fgergwreg', NULL, NULL, NULL),
(9, 'dgfger3r', NULL, '$2y$10$Bt0vy9Vc72tPHGmEdX125OR3P4Zfx832fMrA8P6LOlWOl6.RAyvAC', 2, 1, 0, 0, '2021-03-28 20:36:11', NULL, 'guerngwrjg8', NULL, NULL, NULL),
(10, 'dgfger3rd', NULL, '$2y$10$AGTnaZDkU.8C3ZYdsxgKFuAXuoYGA2EGqodSFJFe2sNrrhBgN1C7a', 2, 1, 0, 0, '2021-03-28 20:37:07', NULL, 'guerngwrjg8s', NULL, NULL, NULL),
(11, 'rgregegrg', NULL, '$2y$10$0qWMTwidDOq3NURjWIoyVeVXjg4mKN1QVMLNff2AGgEt9z8SN816S', 2, 1, 0, 0, '2021-03-28 20:44:29', NULL, 'etjutyjyh', NULL, 11, 11),
(12, 'newemail@iss.ru', NULL, '$2y$10$IH/3pKZw8/msh9gn3S5X4OJjEMWnx22JiCAnQAXUDYK0Vy.AZ.sYW', 2, 1, 0, 0, '2021-04-06 19:06:47', '2021-05-15 17:53:17', 'newlogin111', NULL, NULL, NULL),
(13, 'efefr@efe.ru', NULL, '$2y$10$0aEpNPWNGb6eYvYg4MdeuuG6IZQQxXORVwAdW5YakYfwn6kKh3bBm', 2, 1, 0, 0, '2021-04-06 19:08:48', NULL, 'tuyiuionbv', NULL, 13, 13),
(14, 'fegreg@grgr.ti', NULL, '$2y$10$JY1EdtZTYSogJQZrO.msKeoSlW8Pl7ttJ3LQIGhKeBqJnLtPN3y4y', 2, 1, 0, 0, '2021-04-06 19:09:54', NULL, 'mjhgggttt', NULL, 14, 14),
(15, 'fegreg@grgr.ts', NULL, '$2y$10$7DwGbU55.PUsGLKc2tcmzuHU9l5E.qPEV0ces6bwlxi7BVA4ZeZs.', 2, 1, 0, 0, '2021-04-06 19:12:20', NULL, 'mjhgggtt', NULL, 15, 15),
(16, 'vbvngfndf@eff.ru', NULL, '$2y$10$GQhrKLGx9dhJkDuetGjbY.RvnawEaXqkKUMHbrS0B.yMHmIWxP0QK', 2, 1, 0, 0, '2021-04-06 19:15:19', NULL, 'eregrrhfds', NULL, 16, 16),
(17, 'Email@wadw.ru', NULL, '$2y$10$QShyBQerGdD9FpuiRpCj0uTmuYB8VCfsu5FEPshvQFRY2McQjbTwm', 2, 1, 0, 0, '2021-04-12 19:34:42', NULL, 'newlogin', NULL, 17, 17),
(18, 'Emewail@wadw.ru', NULL, '$2y$10$IVzvch5iSC80DtanEme.eeaTHn1wi4sE86kpl6.D.JApJtObn64JK', 2, 1, 0, 0, '2021-04-12 19:35:38', '2021-05-15 17:53:18', 'nxewlogin', NULL, 18, 18),
(19, 'El@wadw.ru', NULL, '$2y$10$o3nfl755esDVtdAzbuXDzOkgYJjO0FqT0aNKlVXDpLOauPlDrNWaO', 2, 1, 0, 0, '2021-04-12 19:38:12', NULL, 'nxewwwlogin', NULL, 19, 19),
(20, 'Elewaaaa@wadw.ru', NULL, '$2y$10$MlsOuoLnGakY.dU1f1DUneJ6f83iXZhxrNmIHW8Ya22wwVW.7ANlO', 2, 1, 0, 0, '2021-04-12 19:39:07', NULL, 'nxtewwwlogin', NULL, 20, 20),
(21, 'email1@com.ru', NULL, '$2y$10$rlmvfTJkuIbld8vWnP1Un.xXJBhn3UorbsEVN9KHvUOI0idAO2RqO', 1, 1, 0, 0, '2021-04-15 18:56:47', '2021-04-19 19:13:57', 'newlogin1', NULL, 37, 37),
(22, 'email2@com.ru', NULL, '$2y$10$7mhN3gg/xgetZ1./M2ApjOpwXJNJRIjYZcwKz2EtqL5EuTA9sHdbu', 4, 1, 0, 0, '2021-04-15 18:56:47', '2021-04-19 19:13:57', 'newlogin2', NULL, 38, 38),
(23, 'email3@com.ru', NULL, '$2y$10$xJP3/iaIB0zjl113xxILQOxbtlDdLwX5zT3SE1ytJOCf9MJTDee8.', 6, 1, 0, 0, '2021-04-15 18:56:48', '2021-04-19 19:13:58', 'newlogin3', NULL, 39, 39),
(24, 'email4@com.ru', NULL, '$2y$10$1LkNqeX2F9qLP/lTddNlceQyyN6FOGSH2EFVKcS6ctn/wPG/0hWDa', 5, 1, 0, 0, '2021-04-15 18:56:48', '2021-04-19 19:13:58', 'newlogin4', NULL, 40, 40),
(37, 'email@nagfdn.ru', NULL, '$2y$10$QDySLNgsl4328Q79hP8hjOgDOqHVWvZNfEDf73HkMXE3lOdLNo87S', 1, 1, 0, 0, '2021-04-23 18:22:45', NULL, 'newlogin111e', NULL, 41, 41),
(38, 'rgtrgw@eff.ru', NULL, '$2y$10$VhLY9t5Fk1egMJNKZwlcs.yNkV8OAkyIAEgsmOaf4Rp4K00N6Xohm', 11, 1, 1, 0, '2021-04-23 18:25:02', NULL, 'bgnrynrh', NULL, 42, 42),
(39, 'emfddsdail@nan.ru', NULL, '$2y$10$BmI0KwOhDz.xUQ1HgeYrd.PzrT2Dmbris/kcZkykTCfybzfhZu.Ba', 7, 1, 1, 0, '2021-04-26 17:06:05', '2021-04-28 16:58:51', 'testlogin58', 'b5a37fb7e8133ed722ca846a9c4bf3f6', 43, 43),
(40, 'fgergg@feje.cum', NULL, '$2y$10$8wxTWWb6S9rJHyM1WHPa2.ujvPg71yZsk1zFC5X3PMadiShWEG8t6', 7, 2, 0, 0, '2021-04-28 20:50:07', NULL, 'gutrnueto', '3058dceb0daeb6d7873f27d60ba17f4e', 44, 44),
(41, 'newadminmail4@mail.ru', NULL, '$2y$10$kASmQH0eHzz8flpN088Sxe5MYxMAoLwjQf1.QXVzjeQFRnTYYPHzC', 5, 1, 0, 0, '2021-05-07 15:50:45', '2021-05-21 21:00:47', 'login00004', NULL, 45, 45),
(42, 'newadminmail3@mail.ru', '5c244a97a4e972606e4e039be26a31a7.png', '$2y$10$WZja.bhHF0kh3oeBuqeK9eBPfD2.CKTK/OAS0iPRYDVId5Ls1gX8S', 4, 1, 1, 1, '2021-05-07 16:08:38', '2021-05-21 21:00:47', 'login00003', NULL, 46, 46),
(43, 'newadminmail2@mail.ru', NULL, '$2y$10$BYWZd.dqsbV/xtdN5T5tvOQekOUzobkPEO09WmyueOl0B4Qiulsfi', 3, 1, 1, 0, '2021-05-07 19:43:39', '2021-05-21 21:00:47', 'login00002', NULL, 47, 47),
(48, 'newadminmail1@mail.ru', '5c244a97a4e972606e4e039be26a31a7.png', '$2y$10$6cM6H9C8cxmbmidyVN450eNt6Rtuo4bwGITGwVQ/hg8Fz1Wtuh4s6', 2, 1, 0, 0, '2021-05-07 20:44:07', '2021-05-21 21:00:47', 'login00001', NULL, 52, 52),
(49, 'durakdurak85@mail.ru', '156005c5baf40ff51a327f1c34f2975b.jpg', '$2y$10$6jUi/DT3RJknkQommkt4sO7/NwHhNPoQQI4sCIvTs3XGz8KWgl7GC', 4, 1, 0, 1, '2021-05-29 15:28:52', '2021-05-29 15:30:01', 'Durachok', '237b2a9b63009a326c64c390d2abd1e4', 53, 53);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `api_user_tokens`
--
ALTER TABLE `api_user_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chats_list`
--
ALTER TABLE `chats_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_7b097ef194d72cb9b3264c4ff252d78a`
--
ALTER TABLE `chat_7b097ef194d72cb9b3264c4ff252d78a`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd`
--
ALTER TABLE `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_18fadeb3abce5f4e7e0900dae55b7a05`
--
ALTER TABLE `chat_18fadeb3abce5f4e7e0900dae55b7a05`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_613d3d5df83eba8845a8211a48fdd3dd`
--
ALTER TABLE `chat_613d3d5df83eba8845a8211a48fdd3dd`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_53200e57c4ccd64378017b367b5d3b4e`
--
ALTER TABLE `chat_53200e57c4ccd64378017b367b5d3b4e`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_b548521f5c2763bb46c98923ce8cb7c8`
--
ALTER TABLE `chat_b548521f5c2763bb46c98923ce8cb7c8`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_d3aaa443a89bd4841aa021a44583a56b`
--
ALTER TABLE `chat_d3aaa443a89bd4841aa021a44583a56b`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_ec18e4b5b552fe56d3b88fcc746ceea1`
--
ALTER TABLE `chat_ec18e4b5b552fe56d3b88fcc746ceea1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lots_category`
--
ALTER TABLE `lots_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lots_pictures`
--
ALTER TABLE `lots_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `names`
--
ALTER TABLE `names`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `surnames`
--
ALTER TABLE `surnames`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `api_user_tokens`
--
ALTER TABLE `api_user_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `chats_list`
--
ALTER TABLE `chats_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `chat_7b097ef194d72cb9b3264c4ff252d78a`
--
ALTER TABLE `chat_7b097ef194d72cb9b3264c4ff252d78a`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT для таблицы `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd`
--
ALTER TABLE `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `chat_18fadeb3abce5f4e7e0900dae55b7a05`
--
ALTER TABLE `chat_18fadeb3abce5f4e7e0900dae55b7a05`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `chat_613d3d5df83eba8845a8211a48fdd3dd`
--
ALTER TABLE `chat_613d3d5df83eba8845a8211a48fdd3dd`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `chat_53200e57c4ccd64378017b367b5d3b4e`
--
ALTER TABLE `chat_53200e57c4ccd64378017b367b5d3b4e`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `chat_b548521f5c2763bb46c98923ce8cb7c8`
--
ALTER TABLE `chat_b548521f5c2763bb46c98923ce8cb7c8`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `chat_d3aaa443a89bd4841aa021a44583a56b`
--
ALTER TABLE `chat_d3aaa443a89bd4841aa021a44583a56b`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `chat_ec18e4b5b552fe56d3b88fcc746ceea1`
--
ALTER TABLE `chat_ec18e4b5b552fe56d3b88fcc746ceea1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `lots`
--
ALTER TABLE `lots`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `lots_category`
--
ALTER TABLE `lots_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `lots_pictures`
--
ALTER TABLE `lots_pictures`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `names`
--
ALTER TABLE `names`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT для таблицы `surnames`
--
ALTER TABLE `surnames`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
