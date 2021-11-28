-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Lis 2021, 13:32
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `social_media`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `author` text NOT NULL,
  `receiver` text NOT NULL,
  `date` datetime NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `body`, `author`, `receiver`, `date`, `post_id`) VALUES
(1, 'Dobrze, a u ciebie rodzina zdrowa?', 'AgataPiotrowska', '', '2021-11-28 13:17:47', 1),
(2, 'ciekawa informacja nie wiedziałem o tym', 'JanKowalski', '', '2021-11-28 13:28:07', 3),
(3, 'super ciekawostka!', 'MałgorzataWójcik', '', '2021-11-28 13:29:57', 2),
(4, 'wszystko dobrze, miło z twojej strony że pytasz', 'MałgorzataWójcik', '', '2021-11-28 13:30:19', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `friends_requests`
--

CREATE TABLE `friends_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(40) NOT NULL,
  `user_from` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(1, 'JanKowalski', 1),
(2, 'AgataPiotrowska', 2),
(3, 'AgataPiotrowska', 1),
(4, 'AgataPiotrowska', 3),
(5, 'JanKowalski', 3),
(6, 'JanKowalski', 2),
(7, 'MałgorzataWójcik', 3),
(8, 'MałgorzataWójcik', 2),
(9, 'MałgorzataWójcik', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `body`, `author`, `receiver`, `date`, `likes`) VALUES
(1, 'Co tam u was, wszystko dobrze?', 'JanKowalski', '', '2021-11-28 13:08:02', 3),
(2, 'Wiedzieliście że Polska jest jedynym krajem w którym je się pizze z ketchupem?', 'JanKowalski', '', '2021-11-28 13:11:03', 3),
(3, 'Produkcja surimi pochłania 2% światowego przemysłu rybnego \r\n', 'AgataPiotrowska', '', '2021-11-28 13:25:52', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `likes` int(11) NOT NULL,
  `posts` int(11) NOT NULL,
  `username` text NOT NULL,
  `friendArr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `likes`, `posts`, `username`, `friendArr`) VALUES
(1, 'Jan', 'Kowalski', 'jankowalski@gmail.com', '$2y$10$pN1lvlYujK/7Pw1M7PG8peoEpqdp05Ed7fh/ctYR3BMBPFHY.eTWe', 3, 2, 'JanKowalski', ',AgataPiotrowska,MałgorzataWójcik,'),
(2, 'Agata', 'Piotrowska', 'agatapiotrowska@gmail.com', '$2y$10$UquSbR/6gTKpgyunQEtSz.OhsSO7otGdAIOVZYQB7wILnUWU0QxXG', 3, 1, 'AgataPiotrowska', ',JanKowalski,MałgorzataWójcik,'),
(3, 'Małgorzata', 'Wójcik', 'malgorzatawojcik@gmail.com', '$2y$10$GQYJNhIr4gCzIf.abSa/7O8nL/7Pa6s6HXkjpe6G20kIuyTHd/owq', 3, 0, 'MałgorzataWójcik', ',JanKowalski,AgataPiotrowska,');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `friends_requests`
--
ALTER TABLE `friends_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `friends_requests`
--
ALTER TABLE `friends_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
