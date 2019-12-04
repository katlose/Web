-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Dez 2019 um 12:02
-- Server-Version: 10.4.8-MariaDB
-- PHP-Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `patientendb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `healthdata`
--

CREATE TABLE `healthdata` (
  `hdid` int(11) NOT NULL,
  `date` date NOT NULL,
  `blutdruck` varchar(15) NOT NULL,
  `puls` varchar(7) NOT NULL,
  `groesse` double NOT NULL,
  `gewicht` double NOT NULL,
  `befinden` varchar(30) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `patientdata`
--

CREATE TABLE `patientdata` (
  `vorname` varchar(25) NOT NULL,
  `nachname` varchar(25) NOT NULL,
  `geburtsdatum` date NOT NULL,
  `strasse` varchar(25) NOT NULL,
  `hnummer` varchar(5) NOT NULL,
  `plz` varchar(5) NOT NULL,
  `ort` varchar(30) NOT NULL,
  `telefonnummer` varchar(20) NOT NULL,
  `mobilnummer` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` enum('arzt','patient','assistent','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'melissa', '123', 'arzt'),
(2, 'katrin', '123', 'patient'),
(3, 'kathrin', '123', 'assistent');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `healthdata`
--
ALTER TABLE `healthdata`
  ADD PRIMARY KEY (`hdid`);

--
-- Indizes für die Tabelle `patientdata`
--
ALTER TABLE `patientdata`
  ADD PRIMARY KEY (`vorname`,`nachname`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `healthdata`
--
ALTER TABLE `healthdata`
  MODIFY `hdid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
