-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 09 2019 г., 20:18
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `froum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name_author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `img`, `views`) VALUES
(1, 'Cinema', '/img/56986902.jpg', 181),
(2, 'Game', '/img/justin.jpg', 105),
(3, 'Fight', '/img/artist2.PNG', 506),
(4, 'Comics', '/img/левый_чел.jpg', 1026),
(5, 'IT Computer', '/img/artist3.PNG', 6669),
(6, 'Video', '/img/ужас.jpg', 88);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_single` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `text`, `date`, `id_single`) VALUES
(2, '27', 'КАК ЖЕ ЭТО КРУТО', '2019-02-08 21:40:53', 6),
(5, '1', 'asf', '2019-02-12 21:52:33', 4),
(6, '1', 'Тут очень хороший текст', '2019-02-13 13:44:43', 3),
(7, '28', 'ПОЧЕМУ', '2019-02-13 13:53:01', 1),
(17, '28', 'Каждый день каждое утро', '2019-02-20 12:38:02', 2),
(37, '1', 'Крутой комментарий', '2019-03-02 22:13:12', 1),
(38, '31', 'Хорош\r\n\r\n', '2019-03-09 16:28:32', 21);

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_single` int(11) UNSIGNED DEFAULT NULL,
  `id_user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `id_single`, `id_user_id`, `date`) VALUES
(1, 1, 27, '2019-02-08 21:39:33'),
(2, 6, 27, '2019-02-08 21:40:39'),
(3, 3, 27, '2019-02-08 21:50:11'),
(4, 2, 27, '2019-02-08 21:50:21'),
(5, 5, 27, '2019-02-08 21:51:33'),
(6, 8, 27, '2019-02-09 18:53:47'),
(7, 9, 27, '2019-02-09 18:54:22'),
(8, 10, 1, '2019-02-13 16:14:42'),
(9, 4, 1, '2019-02-13 16:21:48'),
(10, 7, 1, '2019-02-13 16:21:57'),
(11, 1, 28, '2019-02-13 20:18:52'),
(15, 2, 28, '2019-02-13 20:21:05'),
(108, 4, 28, '2019-02-15 22:18:09'),
(109, 3, 28, '2019-02-15 22:18:16'),
(110, 6, 28, '2019-02-15 22:21:12'),
(111, 9, 28, '2019-02-15 22:21:24'),
(112, 11, 28, '2019-02-15 22:22:26'),
(113, 8, 28, '2019-02-15 22:23:19'),
(114, 11, 1, '2019-02-15 22:24:45'),
(115, 9, 1, '2019-02-15 22:26:31'),
(117, 2, 1, '2019-02-15 22:30:02'),
(118, 14, 1, '2019-02-15 23:45:58'),
(119, 6, 1, '2019-02-15 23:46:24'),
(133, 1, 1, '2019-03-02 21:55:35'),
(134, 8, 1, '2019-03-02 22:53:21'),
(135, 5, 1, '2019-03-02 22:53:36'),
(136, 1, 31, '2019-03-02 22:58:41'),
(137, 1, 1, '2019-03-03 21:23:41'),
(138, 1, 33, '2019-03-03 21:26:22'),
(139, 1, 34, '2019-03-03 21:35:35'),
(140, 12, 1, '2019-03-06 22:53:21'),
(142, 2, 31, '2019-03-09 16:19:37'),
(143, 21, 31, '2019-03-09 18:06:10'),
(144, 10, 31, '2019-03-09 18:07:08');

-- --------------------------------------------------------

--
-- Структура таблицы `singles`
--

CREATE TABLE `singles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL DEFAULT '0',
  `comments` int(11) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `img_preview` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `singles`
--

INSERT INTO `singles` (`id`, `title`, `text`, `date`, `views`, `comments`, `likes`, `id_category`, `id_user`, `img_preview`) VALUES
(1, 'Тут первая статья', 'Тут хороший текст для первой статьи. <br><img src=\"/img/young_kakashi.gif\"><br> Новый супер текст', '2019-02-08 18:59:22', 2600298, 4, 7, 1, 1, '/img/mm.jpg'),
(2, 'Тут вторая статья', 'Тут хороший текст для второй статьи', '2019-02-08 18:59:39', 226, 1, 4, 2, 27, ''),
(3, 'Тут третья статья', 'Тут такой же хороший текст для третьей статьи', '2019-02-08 19:00:01', 96, 1, 2, 3, 1, ''),
(4, 'Тут четвертая статья', 'Туть тоже очень хороший текст)', '2019-02-08 19:00:19', 59, 1, 2, 4, 27, ''),
(5, 'А тут пятая статья', 'Тут короч пятая статья', '2019-02-08 20:10:36', 25, 0, 2, 4, 18, ''),
(6, 'Ты прикинь тут шестая статья', 'Скорее всего тут текст для шестой статьи', '2019-02-08 20:10:59', 46, 1, 3, 2, 18, ''),
(7, 'Пуская это будет седьмая статья', 'ТекстТЕкстТекст для седьмой статьи', '2019-02-08 20:54:38', 140038, 0, 1, 3, 27, ''),
(8, 'Тут восьмая статья', 'О да, это же текст для воьсмой статьи', '2019-02-08 20:55:23', 41, 0, 3, 1, 27, ''),
(9, 'Как же я рад что это девятая статья', 'Наверное это текст для девятой статьи', '2019-02-08 20:59:28', 41, 0, 3, 4, 27, ''),
(10, 'Название десятой статьи', 'Какой же это хороший текст десятой статьи', '2019-02-13 13:44:09', 65, 0, 2, 2, 1, '/img/young_kakashi.gif'),
(11, '11 статья', 'Текст 11 статья', '2019-02-13 13:58:20', 25, 0, 2, 1, 28, ''),
(12, '12 статья', 'Да-да текст 12 статьяи', '2019-02-15 23:37:12', 4, 0, 1, 2, 1, ''),
(13, 'Окей 13 статья', 'Я на самом деле уже устал придумывать новые текста для статей.', '2019-02-15 23:39:45', 4, 0, 0, 4, 1, ''),
(14, 'Попытка номер 14', 'Текст 14 Текст 14 Текст 14 Текст 14 Текст 14 Текст 14 Текст 14 Текст 14 Текст 14 ', '2019-02-15 23:42:21', 10, 0, 1, 1, 1, ''),
(15, 'Ровно 15 статья', '15 статей назад было 1 статья', '2019-02-16 14:20:29', 0, 0, 0, 4, 1, ''),
(16, '16 статей. Я устал', 'Тест текст статья 16', '2019-02-16 14:30:55', 4, 0, 0, 3, 1, ''),
(20, 'Название 17 статьи', 'Тут текст наверное точно сто процентов', '2019-03-09 14:48:04', 2, 0, 0, 6, 31, '/img/mm.jpg'),
(21, 'статья под номером 18', 'Тут тестовый текст для 18 статьи <br><img src=\"/img/eat_girl.gif\"><br> Сорян но по другому никак', '2019-03-09 15:00:46', 58, 0, 1, 6, 31, '/img/nerf.gif');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img/img-user.jpg',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privilege` int(11) NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `img`, `date`, `ip`, `privilege`, `status`) VALUES
(1, 'mastak', '$2y$10$xfKCMSJFKLDtUErsSFDEIec8OOHLvKjZH4IAq4JxdMpTK2IWJ8rF.', 'farkhat.bakiev@mail.ru', '/img/kakashi.gif', '2019-01-31 13:27:40', NULL, 3, 'Разве я похож на программиста?'),
(24, 'login', 'login', 'login', '/img/img-user.jpg', '2019-01-31 23:39:02', NULL, 1, ''),
(26, '666', '$2y$10$rey4gBslOOGd59XcnDCDqO7ndbAQpFkvLC0tbdem3uZx/V5HRErsm', '666', '/img/img-user.jpg', '2019-01-31 23:40:02', NULL, 1, ''),
(27, 'admin', '$2y$10$fWn.nxBfLYuTvTZJ2VmFruFoGPmV5Qxv2Q4dd0ig2mMjRFcgak9IK', 'admin', '/img/artist3.png', '2019-02-08 18:45:03', '127.0.0.1', 3, ''),
(28, 'callme', '$2y$10$603XU.Xkxi9DmoICV5opyOhZBVhhM/0.DVyvUtmhRhG2uSB7QriR.', 'callme', '/img/4234.PNG', '2019-02-13 13:51:24', '127.0.0.1', 1, ''),
(30, '123', '$2y$10$2cF3YHd2uquC8sSIUPc/IuAWIoQHOC5TZq0nm6/FjN9V.oW.RztAy', '123', '/img/img-user.jpg', '2019-02-26 19:10:43', '127.0.0.1', 1, ''),
(31, 'proud', '$2y$10$2uxSerXC/IOV7FbQr/Z.JesQ4OorYD3XJvTmuF.gw2TU1KJDjnNmy', 'proud', '/img/смоки.jpg', '2019-02-26 19:12:08', '127.0.0.1', 2, 'Да-да я прауд'),
(32, 'bagg', '$2y$10$NCcziul36JD8KZ3ff/amb.Iew9tQEUuDOYc.3ohz.nlgIAV4OOEZ6', 'bagg', '/img/img-user.jpg', '2019-02-26 19:20:00', '127.0.0.1', 1, ''),
(33, '505', '$2y$10$S05UO72KLVtRmudVcCg0JOblhXna95ZlRtZ0nz7njSzDbeZbhXQqW', '505', '/img/img-user.jpg', '2019-03-02 23:01:15', '127.0.0.1', 2, ''),
(34, 'ok_it_is_test', '$2y$10$TJU9t9OCWEX9WZ.fhVBB8eK6PWvXxmgPyU9KVlyoONElmiKuCIJnK', 'ok_it_is_test', '/img/img-user.jpg', '2019-03-03 21:29:56', '127.0.0.1', 1, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_likes_id_user` (`id_user_id`);

--
-- Индексы таблицы `singles`
--
ALTER TABLE `singles`
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
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT для таблицы `singles`
--
ALTER TABLE `singles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `c_fk_likes_id_user_id` FOREIGN KEY (`id_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
