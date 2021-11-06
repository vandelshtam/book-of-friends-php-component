-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Авг 12 2021 г., 15:58
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
-- Создание: Авг 10 2021 г., 13:57
-- Последнее обновление: Авг 12 2021 г., 14:45
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
  `phone` int(32) DEFAULT NULL,
  `telegram` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(7, 'otto@mail.ru', '$2y$10$lMy.wIvkSKSb7mkyCl.RUecHPqUji87WFMdSZYekRRClNScnPGXkS', 'Otto', 1, 1, 1, 1, 1627725390, 1628697464, 0, 'Moscow', 'Moscow', 236327237, 'Moscow', 'Moscow', 'Director', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/avatar-admin-lg.png');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(8, 'vlad@mail.ru', '$2y$10$L8G2pjiftYbSf6Hczuy3seMQj66k1auHykRg0NQebiqc0k4GGNnbq', 'Vlad', 0, 1, 1, 1, 1627727701, 1627728387, 0, 'Antaliya', 'Vlad', 90353738, 'Vlad', 'Vlad', 'Manager', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/avatar-a.png');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(9, 'ivan@gmail.com', '$2y$10$cbA6WfA1k1MM9ApmVN6...WUxWiT3p3d/j1an09xjsBgDwfZadZj6', 'Ivan', 1, 1, 1, 1, 1628273761, 1628677549, 0, 'NewYork', 'Ivan', 8888888, 'Ivan', 'Ivan', 'Web developer', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/plane_demo.png');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(29, 'e@mail.ru', '$2y$10$l2LCdWpCTTasTBgZvNRrpOgfRV3sCcttIs7hKVnTYmIxSh3FVaknG', 'e', 0, 1, 1, 0, 1628779512, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(10, 'vlada@gmail.com', '$2y$10$L8G2pjiftYbSf6Hczuy3seMQj66k1auHykRg0NQebiqc0k4GGNnbq', 'Vlada', 0, 1, 1, 0, 1627727701, 1627728387, 0, 'Antaliya', 'Antalya', 90353738, 'Antalya', 'Antalya', 'Manager', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/avatar-a.png');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(11, 'mark@gmail.com', '$2y$10$lMy.wIvkSKSb7mkyCl.RUecHPqUji87WFMdSZYekRRClNScnPGXkS', 'Mark', 0, 1, 1, 0, 1627725390, NULL, 0, 'Moscow', 'Mark', 236327237, 'Mark', 'Mark', 'Director', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/avatar-b.png');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(12, 'vandel@gmail.com', '$2y$10$L8G2pjiftYbSf6Hczuy3seMQj66k1auHykRg0NQebiqc0k4GGNnbq', 'Vandel', 0, 1, 1, 1, 1627727701, 1627728387, 0, 'Antaliya', 'Vandel', 90353738, 'Vandel', 'Vandel', 'Manager', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/avatar-a.png');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(18, 'sylvester@gmail.com', '$2y$10$qydP1veuDBQ8jOJANtdg5.FTVUL5IO30gKqiQ93QNluF5Mb/0UOSW', 'Sylvester', 2, 0, 1, 16641, 0, NULL, NULL, 'Antalya', 'Sylvester', 8976, 'Sylvester', 'Sylvester', 'Web developer', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/avatar-e.png');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(19, 'branco@gmail.com', '$2y$10$DWxs5FhxsATdtrB6WBGQyOJbem5Y9LuNrcYHXn5zInXsoryVreEsS', 'Branco', 2, 0, 1, 0, 0, NULL, NULL, 'Paris', 'Branco', 4444444, 'Branco', 'Branco', 'Branco', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/IMG_3297 SE2 test 1.JPG');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(26, 'filipo@gmail.com', '$2y$10$JtwZrlqIEiofMxnhPz/ah.fLqCuKR4gGhiUuTPLHMBhLskV/x8Gby', 'Filipo', 0, 1, 1, 0, 1628763227, NULL, NULL, 'Rome', 'filipo', 3333333, 'filipo', 'filipo', 'Web developer ', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/avatar-g.png');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(22, 'michael@gmail.com', '$2y$10$SvW.Lm34ptLQh1.c5CQYZesbxg5foZ3Amkwi1h9/p/0yptjNrJVT2', 'Michael', 0, 0, 1, 0, 0, NULL, NULL, 'Berlin', 'Michael', 3758658, 'Michael', 'Michael', 'Web developer -Junior', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/IMG_3301 se2 test 2.JPG');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(25, 'slava@gmail.com', '$2y$10$BPkjfeMGTHeKLAf.qYDtXOQmO5cakMAe/IlSSRfHRwZVmctT9ZDIq', 'Slava', 0, 1, 1, 0, 1628687249, 1628694470, NULL, 'Praga', 'praga', 555555, 'praga', 'praga', 'Web developer', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/plane_demo.png');
INSERT DELAYED INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `city`, `vk`, `phone`, `telegram`, `instagram`, `occupation`, `avatar`) VALUES(24, 'john@gmail.com', '$2y$10$VB/WGEWVuwxJ62GTjorAi.710NDXPnaQdYkTUqgPG3WmZYoq2esoi', 'John', 0, 1, 1, 0, 1628605117, NULL, NULL, 'London', 'John', 375865887, 'John', 'John', 'IT-ingener', '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/kuksh_1200.webp');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;