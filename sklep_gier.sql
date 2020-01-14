-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Sty 2020, 20:16
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep_gier`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `ID_Adres` int(5) NOT NULL,
  `Miasto` varchar(50) NOT NULL,
  `Ulica` varchar(150) NOT NULL,
  `Nr_Domu` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `adres`
--

INSERT INTO `adres` (`ID_Adres`, `Miasto`, `Ulica`, `Nr_Domu`) VALUES
(1, 'Łódż', 'Politechniki', '9A');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gatunek`
--

CREATE TABLE `gatunek` (
  `id` int(5) UNSIGNED NOT NULL,
  `opis_gatunek` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `gatunek`
--

INSERT INTO `gatunek` (`id`, `opis_gatunek`) VALUES
(1, 'Horror'),
(2, 'RPG'),
(3, 'Stealth');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gra`
--

CREATE TABLE `gra` (
  `id` int(5) NOT NULL,
  `tytul` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `id_producent` int(5) NOT NULL,
  `id_platforma` int(5) NOT NULL,
  `id_gatunek` int(5) NOT NULL,
  `cena` int(5) NOT NULL,
  `dostepnosc` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `gra`
--

INSERT INTO `gra` (`id`, `tytul`, `image`, `id_producent`, `id_platforma`, `id_gatunek`, `cena`, `dostepnosc`) VALUES
(1, 'GTA 5', 'product-images/gta5.jpg', 1, 1, 1, 300, 2),
(26, 'Borderlands 3', 'product-images/borderlands3.jpg', 1, 2, 3, 210, 5),
(27, 'Overwatch', 'product-images/overwatch.jpg', 3, 3, 2, 175, 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `ID_Klient` int(5) NOT NULL,
  `Imię` varchar(50) NOT NULL,
  `Nazwisko` varchar(50) NOT NULL,
  `Dowod_Osobisty` varchar(50) NOT NULL,
  `ID_Adres` int(5) NOT NULL,
  `ID_Kontakt` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `klient`
--

INSERT INTO `klient` (`ID_Klient`, `Imię`, `Nazwisko`, `Dowod_Osobisty`, `ID_Adres`, `ID_Kontakt`) VALUES
(1, 'Oleksii', 'Prykhodko', 'FBxxxxxx', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakt`
--

CREATE TABLE `kontakt` (
  `ID_Kontakt` int(5) NOT NULL,
  `Kod_Pocztowy` varchar(6) NOT NULL,
  `Telefon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kontakt`
--

INSERT INTO `kontakt` (`ID_Kontakt`, `Kod_Pocztowy`, `Telefon`) VALUES
(1, '93-590', '+48 733-408-722');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `ID_Koszyk` int(5) NOT NULL,
  `ID_Klient` int(5) NOT NULL,
  `ID_Gra` int(5) NOT NULL,
  `Ilosc` int(5) NOT NULL,
  `DataZamowienia` datetime NOT NULL,
  `ID_StatusZamowienia` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`ID_Koszyk`, `ID_Klient`, `ID_Gra`, `Ilosc`, `DataZamowienia`, `ID_StatusZamowienia`) VALUES
(1, 1, 1, 1, '2019-11-06 04:22:21', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `platforma`
--

CREATE TABLE `platforma` (
  `id` int(5) UNSIGNED NOT NULL,
  `opis_platforma` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `platforma`
--

INSERT INTO `platforma` (`id`, `opis_platforma`) VALUES
(1, 'PS4'),
(2, 'PC'),
(3, 'XOne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `producent`
--

CREATE TABLE `producent` (
  `id` int(11) UNSIGNED NOT NULL,
  `opis_producent` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `producent`
--

INSERT INTO `producent` (`id`, `opis_producent`) VALUES
(1, 'BioWare'),
(2, 'Nintendo'),
(3, 'Blizzard');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statuszamowienia`
--

CREATE TABLE `statuszamowienia` (
  `ID_StatusZamowienia` int(5) NOT NULL,
  `Status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `statuszamowienia`
--

INSERT INTO `statuszamowienia` (`ID_StatusZamowienia`, `Status`) VALUES
(1, 'Oczekuje'),
(2, 'W drodze'),
(3, 'Doreczono');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `_email`, `_password`) VALUES
(5, 'Rondy1', 'rondy1@mail.ru', '$2y$10$HwBYd8.T4GXXrZc8vzHTQ.8eaAYPwBTDjKeLw/wajwD1IWFcPu2vq'),
(6, 'Rondy2', 'rondy2@mail.ru', '$2y$10$meEf9e139WTnL4nKK7vI3uKElKnv3aUiPRSmmPsPV42p9aLgIw/tS'),
(7, 'Rondy3', 'rondy3@mail.ru', '$2y$10$kV6A4iRHOtE5EINldWJdHODAj1PQUw9/UNbqHeudujoqgHc9lKxtK'),
(8, 'Rondy5', 'rondy5@mail.ru', '$2y$10$UwjYZC4FXQHyuQfkUCJ.2e34NaTWO2kNNtX0/5hWEPlabhXnUXeY6'),
(9, 'Test1', 'Test1@gmail.com', '$2y$10$QGjuWDlyVPgxnfAvWCXaou7WXjFxutdzpDt6wF0kHa230toebXbum'),
(10, 'Rondy123', 'Rondy123@mail.ru', '$2y$10$PsfbruIrVy0i1/RKsWQpPuEWuGa4EImE4V6RrUtQJBVPcxLps9q/6'),
(11, 'Rondy666', 'Rondy666@mail.ru', '$2y$10$.a83/A.LeaIN4ErOZzHb/OtL5dFPH0pKZA9HshttSmlx7F6XpjJbK');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`ID_Adres`);

--
-- Indeksy dla tabeli `gatunek`
--
ALTER TABLE `gatunek`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `gra`
--
ALTER TABLE `gra`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`ID_Klient`);

--
-- Indeksy dla tabeli `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`ID_Kontakt`);

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`ID_Koszyk`);

--
-- Indeksy dla tabeli `platforma`
--
ALTER TABLE `platforma`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `producent`
--
ALTER TABLE `producent`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `statuszamowienia`
--
ALTER TABLE `statuszamowienia`
  ADD PRIMARY KEY (`ID_StatusZamowienia`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `adres`
--
ALTER TABLE `adres`
  MODIFY `ID_Adres` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `gatunek`
--
ALTER TABLE `gatunek`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `gra`
--
ALTER TABLE `gra`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT dla tabeli `klient`
--
ALTER TABLE `klient`
  MODIFY `ID_Klient` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `ID_Kontakt` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `ID_Koszyk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `platforma`
--
ALTER TABLE `platforma`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `producent`
--
ALTER TABLE `producent`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `statuszamowienia`
--
ALTER TABLE `statuszamowienia`
  MODIFY `ID_StatusZamowienia` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
