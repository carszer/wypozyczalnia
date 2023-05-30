-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: mysql5:3306
-- Czas generowania: 30 Maj 2023, 18:17
-- Wersja serwera: 10.5.17-MariaDB
-- Wersja PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `carszer_carszer`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `car`
--

CREATE TABLE `car` (
  `idcar` int(11) NOT NULL,
  `nrrejestracyjny` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `marka` text COLLATE utf8mb4_polish_ci NOT NULL,
  `model` varchar(11) COLLATE utf8mb4_polish_ci NOT NULL,
  `cena` float NOT NULL,
  `pojemnosc` int(11) NOT NULL,
  `moc_km` int(11) NOT NULL,
  `moment` int(11) NOT NULL,
  `opis` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `img` text COLLATE utf8mb4_polish_ci NOT NULL,
  `visible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `car`
--

INSERT INTO `car` (`idcar`, `nrrejestracyjny`, `marka`, `model`, `cena`, `pojemnosc`, `moc_km`, `moment`, `opis`, `img`, `visible`) VALUES
(3, 'NLI-85SW', 'dełu', 'matiz', 90, 798, 30, 0, 'wspaniały autobus na rodzinne wyprawy', 'img/matiz.jpg', 1),
(5, 'NSZ-44PW', 'audi', 'quattro', 2137, 4900, 350, 450, 'fajna zabawka na zimę 3.8 do 100/hm', 'img/audi4.jpg', 1),
(6, 'NOS-99FG', 'bugatti', 'bolide', 10000, 8000, 1850, 1850, 'luksus fest z kurpiów', 'img/bugati.jpg', 1),
(29, 'NE-9K472', 'vw', 'golf', 2137, 1324, 35, 156, 'Gulfior', 'img/IMG-6465767025d6b8.56617548.jpg', 1),
(33, 'NLI-3214P', 'Toyota', 'Yaris', 3, 3221, 434, 432, 'Jeździ skręca hamuje', 'img/IMG-64657c71c91fc0.21459121.jpg', 1),
(36, 'GWE-2671', 'Skoda', 'Fabia', 2400, 1600, 98, 2400, 'Dobry samochod kupilem', 'img/IMG-6465f70a259920.90538867.jpg', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservation`
--

CREATE TABLE `reservation` (
  `idreservation` int(3) NOT NULL,
  `data_start` date NOT NULL,
  `data_koniec` date NOT NULL,
  `ile_dni` varchar(5) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `potwierdzone` tinyint(1) DEFAULT NULL,
  `idcar` int(3) NOT NULL,
  `iduser` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `reservation`
--

INSERT INTO `reservation` (`idreservation`, `data_start`, `data_koniec`, `ile_dni`, `potwierdzone`, `idcar`, `iduser`) VALUES
(25, '2023-01-30', '2023-01-31', '2', NULL, 6, 11),
(129, '2023-05-20', '2023-05-23', '4', NULL, 29, 18),
(130, '2023-05-18', '2023-05-21', '4', NULL, 6, 18),
(132, '2023-05-19', '2023-05-23', '5', NULL, 33, 18),
(133, '2023-05-19', '2023-05-27', '9', NULL, 29, 18),
(134, '2023-05-22', '2023-05-25', '4', NULL, 6, 19),
(135, '2023-05-29', '2023-05-30', '2', NULL, 29, 4),
(136, '2023-05-30', '2023-05-30', '1', NULL, 3, 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `kod` int(11) NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `imie` text COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8mb4_polish_ci NOT NULL,
  `nrtelefon` text COLLATE utf8mb4_polish_ci NOT NULL,
  `miasto` text COLLATE utf8mb4_polish_ci NOT NULL,
  `ulica` text COLLATE utf8mb4_polish_ci NOT NULL,
  `lokal` text COLLATE utf8mb4_polish_ci NOT NULL,
  `nrprawojazdy` text COLLATE utf8mb4_polish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`iduser`, `kod`, `email`, `password`, `imie`, `nazwisko`, `nrtelefon`, `miasto`, `ulica`, `lokal`, `nrprawojazdy`, `status`) VALUES
(1, 0, 'dwadaw', 'dwawadawdawd', 'Szym', '', '', '', '', '0', '', 0),
(2, 0, 'pytr97@gmail.com', 'xdxd', 'Szym', 'Ostrowski', '123456789', 'Gdynia', 'sfsdfsd1', '5', 'afd3421', 0),
(3, 0, 'piostreet97@gmail.com', 'xdxdx', 'Szym', '', '', '', '', '0', '', 0),
(4, 699669, '1@wp.pl', 'zaq1@WSX', 'Mareczek', 'Operator', '662605300', 'miasto', 'dasd', '12', '42222/12/0118', 1),
(5, 0, 'testowe@wp.pl', 'testowe', 'Szym', 'Kamiński', '666666666', '123', '1123', '231', '1231', 0),
(6, 998550, 'superspiwor@gmail.com', 'zaq1@WSX', 'Szym', 'pawlak', '662605300', 'gdynia', 'akademia', '1', '42143242', 1),
(7, 0, 'mobbyn@baza.pl', 'kubiakchuj', 'Szym', '', '', '', '', '0', '', 0),
(8, 0, '7@wp.pl', 'qwerty', 'Szym', 'Romek ', '999999999', 'Gdynia', 'Qwe', '1', '123344', 0),
(9, 0, '6@wp.pl', '123456', 'Mareczek', 'Operator', '662605300', 'Gdynia', 'Śmidowicza', '10B/12', '42222/12/0118', 0),
(10, 255740, 'pawost2000@wp.pl', 'Jebalciepies!1', 'Szym', 'Ostrowski', '123456781', 'Gdynia', 'blaboabla', '5', 'a chuj cie to', 0),
(11, 0, '123@wp.pl', '12345678', 'Szym', 'eeeeeeee', '111111111', '222222', '12222221', '122212121', '22121212121', 0),
(12, 0, 'dupsko@wp.pl', 'Dupa1234', 'Szym', 'as', '123123123', 'asd', 'asd', '0', 'sdasd', 0),
(13, 0, 'hayog45668@kaudat.com', '123456', 'Szym', '', '', '', '', '0', '', 0),
(14, 0, '1@wppl', '123456', 'Szym', '', '', '', '', '0', '', 0),
(15, 0, 'papiez@gmail.umar', 'papiezniezyje.pl', 'Szym', '', '', '', '', '0', '', 0),
(16, 0, 'poyztywizm996r@gmail.com', 'jdsiemanko2137', 'chuj', 'Cie to', '997997997', 'Szczecin', 'tak', '1', '213721372137', 0),
(18, 0, 'przerwatech@gmail.com', 'zaq1@WSX', 'przerwa', 'techniczna', '123456789', 'przerwa', 'przerwa', '69', '12345678901', 0),
(19, 0, 'gosik123-01@wp.pl', 'Kupadupa', 'Kupa', 'Dupa', '123456789', 'Wejherowo', 'Gówniana', '69', '12345/12/6969', 0),
(20, 0, 'eee@wp.pl', '123456', 'wwww', 'wwww', '123456789', 'eee', 'eee', '10', '12345/12/1234', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`idcar`),
  ADD UNIQUE KEY `rejestracja` (`nrrejestracyjny`) USING HASH;

--
-- Indeksy dla tabeli `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idreservation`),
  ADD KEY `idcar` (`idcar`),
  ADD KEY `iduser` (`iduser`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `car`
--
ALTER TABLE `car`
  MODIFY `idcar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT dla tabeli `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idreservation` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idcar`) REFERENCES `car` (`idcar`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
