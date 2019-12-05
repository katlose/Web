-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Dez 2019 um 10:10
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

--
-- Daten für Tabelle `patientdata`
--

INSERT INTO `patientdata` (`vorname`, `nachname`, `geburtsdatum`, `strasse`, `hnummer`, `plz`, `ort`, `telefonnummer`, `mobilnummer`, `email`, `uid`) VALUES
('Anton', 'Sonne', '1965-12-23', 'veilchenallee', '78', '89254', 'Grüningen', '02738390', '015273834', 'anton@mail.com', 4),
('Hugo', 'Zimmer', '1987-04-05', 'Kirschstrasse', '77', '82537', 'Jungingen', '082947499', '013748599', 'hugo@mail.com', 5),
('Katrin', 'Losert', '1997-01-15', 'Blumenstraße', '7', '89567', 'Gartenburg', '0837698638', '01519374950', 'katrin.losert@mail.com', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `role` enum('arzt','patient','assistent','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'melissa', '123', 'melissa.haas@mail.com', 'arzt'),
(2, 'katrin', '123', 'katrin.losert@mail.com', 'patient'),
(3, 'kathrin', '123', 'kathrin.bertsch@mail.com', 'assistent'),
(4, 'anton.sonne', '123', 'anton@mail.com', 'patient'),
(5, 'hugo.zimmer', '123', 'hugo@mail.com', 'patient');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `healthdata`
--
ALTER TABLE `healthdata`
  ADD PRIMARY KEY (`hdid`),
  ADD KEY `fk_health` (`uid`);

--
-- Indizes für die Tabelle `patientdata`
--
ALTER TABLE `patientdata`
  ADD PRIMARY KEY (`vorname`,`nachname`),
  ADD KEY `fk_patient` (`uid`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `healthdata`
--
ALTER TABLE `healthdata`
  ADD CONSTRAINT `fk_health` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `patientdata`
--
ALTER TABLE `patientdata`
  ADD CONSTRAINT `fk_patient` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
