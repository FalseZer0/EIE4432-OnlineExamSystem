-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3325
-- Время создания: Дек 16 2020 г., 12:40
-- Версия сервера: 10.4.14-MariaDB
-- Версия PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `onlineexam`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `qID` bigint(64) NOT NULL,
  `examID` bigint(64) NOT NULL,
  `tID` varchar(8) NOT NULL,
  `uAnswer` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `exam`
--

CREATE TABLE `exam` (
  `examID` bigint(64) NOT NULL,
  `tID` varchar(8) NOT NULL,
  `checked` varchar(10) DEFAULT NULL,
  `submitTime` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `exammain`
--

CREATE TABLE `exammain` (
  `examID` bigint(64) NOT NULL,
  `examTitle` varchar(64) NOT NULL,
  `examDate` varchar(64) NOT NULL,
  `startTime` varchar(64) NOT NULL,
  `endTime` varchar(64) NOT NULL,
  `questionNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `mark`
--

CREATE TABLE `mark` (
  `tID` varchar(8) NOT NULL,
  `examID` bigint(64) NOT NULL,
  `grade` varchar(8) DEFAULT NULL,
  `maxscore` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `qID` bigint(64) NOT NULL,
  `examID` bigint(64) NOT NULL,
  `QBody` varchar(164) NOT NULL,
  `Qtype` varchar(10) NOT NULL,
  `Qanswer` varchar(32) NOT NULL,
  `points` int(11) NOT NULL,
  `opt1` varchar(164) DEFAULT NULL,
  `opt2` varchar(164) DEFAULT NULL,
  `opt3` varchar(164) DEFAULT NULL,
  `opt4` varchar(164) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `tID` varchar(8) NOT NULL,
  `fName` varchar(15) NOT NULL,
  `lName` varchar(15) NOT NULL,
  `job` varchar(8) NOT NULL,
  `email` varchar(20) NOT NULL,
  `courseID` varchar(10) DEFAULT NULL,
  `imagePath` varchar(164) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `magicN` int(5) NOT NULL,
  `gender` varchar(64) DEFAULT NULL,
  `bday` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`tID`, `fName`, `lName`, `job`, `email`, `courseID`, `imagePath`, `pwd`, `magicN`, `gender`, `bday`) VALUES
('11111111', 'Nikita', 'Usenko', 'student', 'kairat.seksembaev@gm', NULL, 'r_2320300_8CgA3.jpg', 'qwerty', 32121, 'male', '2020-09-01'),
('12345678', 'Kairat', 'Seksembayev', 'teacher', 'mik@gmail.com', '4432', 'Chris-Husbands.jpg', 'qwe', 12345, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`qID`,`examID`,`tID`),
  ADD KEY `tID` (`tID`),
  ADD KEY `answers_ibfk_2` (`examID`);

--
-- Индексы таблицы `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`examID`,`tID`),
  ADD KEY `tID` (`tID`);

--
-- Индексы таблицы `exammain`
--
ALTER TABLE `exammain`
  ADD PRIMARY KEY (`examID`);

--
-- Индексы таблицы `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`tID`,`examID`),
  ADD KEY `mark_ibfk_1` (`examID`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qID`,`examID`),
  ADD KEY `questions_ibfk_1` (`examID`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`tID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `exammain`
--
ALTER TABLE `exammain`
  MODIFY `examID` bigint(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `qID` bigint(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`qID`) REFERENCES `questions` (`qID`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`examID`) REFERENCES `questions` (`examID`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_3` FOREIGN KEY (`tID`) REFERENCES `user` (`tID`);

--
-- Ограничения внешнего ключа таблицы `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`tID`) REFERENCES `user` (`tID`),
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`examID`) REFERENCES `exammain` (`examID`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `mark`
--
ALTER TABLE `mark`
  ADD CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`examID`) REFERENCES `exam` (`examID`) ON DELETE CASCADE,
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`tID`) REFERENCES `user` (`tID`);

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`examID`) REFERENCES `exam` (`examID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
