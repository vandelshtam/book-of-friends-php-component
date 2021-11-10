-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Ноя 09 2021 г., 16:59
-- Версия сервера: 5.7.32
-- Версия PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `app3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(2) UNSIGNED NOT NULL DEFAULT '0',
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `resettable` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `roles_mask` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `registered` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_login` int(10) UNSIGNED DEFAULT NULL,
  `force_logout` mediumint(7) UNSIGNED DEFAULT NULL,
  `city` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vk` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar-m.png',
  `c` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `search` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`, `c`, `search`, `role`) VALUES
(1, 'otto@mail.ru', '$2y$10$5gzuqZOb0EkQZq4.sIbiBuqCWd058uN4/MvhdCgqmVaCvM.3yGyN.', 'Otto', 2, 1, 1, 262401, 1627725390, 1636469649, 1, 'Moscow', 'Moscow', '236327237', 'Moscow', 'Moscow', 'Director', 'avatar-m.png', 'c_1', 'otto', 1),
(2, 'vlad@mail.ru', '$2y$10$L8G2pjiftYbSf6Hczuy3seMQj66k1auHykRg0NQebiqc0k4GGNnbq', 'Vlad', 0, 1, 1, 1, 1627727701, 1632762906, 0, 'Antaliya', 'Vlad', '90353738', 'Vlad', 'Vlad', 'Manager', 'avatar-m.png', 'c_2', 'vlad', 1),
(3, 'ivan@gmail.com', '$2y$10$cbA6WfA1k1MM9ApmVN6...WUxWiT3p3d/j1an09xjsBgDwfZadZj6', 'Ivan', 1, 1, 1, 1, 1628273761, 1628677549, 0, 'NewYork', 'Ivan', '8888888', 'Ivan', 'Ivan', 'Web developer', 'avatar-m.png', 'c_4', 'ivan', 1),
(4, 'vlada@gmail.com', '$2y$10$L8G2pjiftYbSf6Hczuy3seMQj66k1auHykRg0NQebiqc0k4GGNnbq', 'Vlada', 0, 1, 1, 0, 1627727701, 1627728387, 0, 'Antaliya', 'Antalya', '90353738', 'Antalya', 'Antalya', 'Manager', 'avatar-m.png', 'c_6', 'vlada', NULL),
(5, 'vandel@gmail.com', '$2y$10$L8G2pjiftYbSf6Hczuy3seMQj66k1auHykRg0NQebiqc0k4GGNnbq', 'Vandel', 0, 1, 1, 1, 1627727701, 1627728387, 0, 'Antaliya', 'Vandel', '90353738', 'Vandel', 'Vandel', 'Manager', 'avatar-m.png', 'c_8', 'vandel', NULL),
(6, 'slava@gmail.com', '$2y$10$BPkjfeMGTHeKLAf.qYDtXOQmO5cakMAe/IlSSRfHRwZVmctT9ZDIq', 'Slava', 0, 1, 1, 0, 1628687249, 1628694470, NULL, 'Praga', 'praga', '555555', 'praga', 'praga', 'Web developer', 'avatar-m.png', 'c_13', 'slava', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
