-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 29, 2023 alle 17:50
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_learning`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attestato`
--

CREATE TABLE `attestato` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_iscrizione` int(11) UNSIGNED NOT NULL,
  `titolo` varchar(20) NOT NULL,
  `file` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `audio`
--

CREATE TABLE `audio` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_materiale` int(11) UNSIGNED NOT NULL,
  `titolo` varchar(20) NOT NULL,
  `file` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_responsabile` int(11) UNSIGNED NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_istruttore` int(11) UNSIGNED NOT NULL,
  `ID_categoria` int(11) UNSIGNED NOT NULL,
  `nome` varchar(30) NOT NULL,
  `prezzo` float NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `domanda`
--

CREATE TABLE `domanda` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_esercitazione` int(11) UNSIGNED NOT NULL,
  `corpo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `esercitazione`
--

CREATE TABLE `esercitazione` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_corso` int(11) UNSIGNED NOT NULL,
  `numero` int(11) NOT NULL,
  `punteggio_totale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

CREATE TABLE `immagine` (
  `ID` int(10) UNSIGNED NOT NULL,
  `titolo` varchar(30) NOT NULL,
  `file` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `istruttore`
--

CREATE TABLE `istruttore` (
  `ID` int(10) UNSIGNED NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `data` date NOT NULL,
  `citta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `lezione`
--

CREATE TABLE `lezione` (
  `ID` int(10) UNSIGNED NOT NULL,
  `numero` int(11) NOT NULL,
  `titolo` varchar(20) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `materiale`
--

CREATE TABLE `materiale` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_lezione` int(11) UNSIGNED NOT NULL,
  `ID_corso` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_utente` int(10) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `ora` time NOT NULL,
  `oggetto` text NOT NULL,
  `corpo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `recensione`
--

CREATE TABLE `recensione` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_iscrizione` int(11) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `ora` time NOT NULL,
  `corpo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `responsabile`
--

CREATE TABLE `responsabile` (
  `ID` int(10) UNSIGNED NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `risposta`
--

CREATE TABLE `risposta` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_domanda` int(11) UNSIGNED NOT NULL,
  `corpo` int(11) NOT NULL,
  `stato` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `storico_esercitazioni_corso`
--

CREATE TABLE `storico_esercitazioni_corso` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_iscrizione` int(11) UNSIGNED NOT NULL,
  `ID_esercitazione` int(11) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `punteggio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `storico_iscrizioni_corso`
--

CREATE TABLE `storico_iscrizioni_corso` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_utente` int(10) UNSIGNED NOT NULL,
  `ID_corso` int(11) UNSIGNED NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `storico_lezioni_corso`
--

CREATE TABLE `storico_lezioni_corso` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_lezione` int(11) UNSIGNED NOT NULL,
  `ID_iscrizione` int(11) UNSIGNED NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(10) UNSIGNED NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(40) NOT NULL,
  `data` date NOT NULL,
  `citta` varchar(40) NOT NULL,
  `codice_fiscale` char(16) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `video`
--

CREATE TABLE `video` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_materiale` int(11) UNSIGNED NOT NULL,
  `titolo` varchar(20) NOT NULL,
  `file` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `attestato`
--
ALTER TABLE `attestato`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `iscrizione_attestato` (`ID_iscrizione`);

--
-- Indici per le tabelle `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `materiale_for_audio` (`ID_materiale`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `responsabile_for_categoria` (`ID_responsabile`);

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `categoria_for_corso` (`ID_categoria`),
  ADD KEY `istruttore_for_corso` (`ID_istruttore`);

--
-- Indici per le tabelle `domanda`
--
ALTER TABLE `domanda`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `esercitazione_for_domanda` (`ID_esercitazione`);

--
-- Indici per le tabelle `esercitazione`
--
ALTER TABLE `esercitazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `corso_for_esercitazione` (`ID_corso`);

--
-- Indici per le tabelle `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `istruttore`
--
ALTER TABLE `istruttore`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `materiale`
--
ALTER TABLE `materiale`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `corso_for_materiale` (`ID_corso`),
  ADD KEY `lezione_for_materiale` (`ID_lezione`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `utente_for_notifica` (`ID_utente`);

--
-- Indici per le tabelle `recensione`
--
ALTER TABLE `recensione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `iscrizione_for_recensione` (`ID_iscrizione`);

--
-- Indici per le tabelle `responsabile`
--
ALTER TABLE `responsabile`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `risposta`
--
ALTER TABLE `risposta`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `domanda_for_risposta` (`ID_domanda`);

--
-- Indici per le tabelle `storico_esercitazioni_corso`
--
ALTER TABLE `storico_esercitazioni_corso`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `esercitazione_for_storico_esercitazioni` (`ID_esercitazione`),
  ADD KEY `iscrizione_for_storico_esercitazioni` (`ID_iscrizione`);

--
-- Indici per le tabelle `storico_iscrizioni_corso`
--
ALTER TABLE `storico_iscrizioni_corso`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `corso_for_storico_iscrizioni` (`ID_corso`),
  ADD KEY `utente_for_storico_iscrizioni` (`ID_utente`);

--
-- Indici per le tabelle `storico_lezioni_corso`
--
ALTER TABLE `storico_lezioni_corso`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `iscrizione_for_storico_lezioni` (`ID_iscrizione`),
  ADD KEY `lezione_for_storico_lezioni` (`ID_lezione`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `materiale_for_video` (`ID_materiale`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `attestato`
--
ALTER TABLE `attestato`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `audio`
--
ALTER TABLE `audio`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `domanda`
--
ALTER TABLE `domanda`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `esercitazione`
--
ALTER TABLE `esercitazione`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `istruttore`
--
ALTER TABLE `istruttore`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `lezione`
--
ALTER TABLE `lezione`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `materiale`
--
ALTER TABLE `materiale`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `notifica`
--
ALTER TABLE `notifica`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `recensione`
--
ALTER TABLE `recensione`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `responsabile`
--
ALTER TABLE `responsabile`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `risposta`
--
ALTER TABLE `risposta`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `storico_esercitazioni_corso`
--
ALTER TABLE `storico_esercitazioni_corso`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `storico_iscrizioni_corso`
--
ALTER TABLE `storico_iscrizioni_corso`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `storico_lezioni_corso`
--
ALTER TABLE `storico_lezioni_corso`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `video`
--
ALTER TABLE `video`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `attestato`
--
ALTER TABLE `attestato`
  ADD CONSTRAINT `iscrizione_attestato` FOREIGN KEY (`ID_iscrizione`) REFERENCES `storico_iscrizioni_corso` (`ID`);

--
-- Limiti per la tabella `audio`
--
ALTER TABLE `audio`
  ADD CONSTRAINT `materiale_for_audio` FOREIGN KEY (`ID_materiale`) REFERENCES `materiale` (`ID`);

--
-- Limiti per la tabella `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `responsabile_for_categoria` FOREIGN KEY (`ID_responsabile`) REFERENCES `responsabile` (`ID`);

--
-- Limiti per la tabella `corso`
--
ALTER TABLE `corso`
  ADD CONSTRAINT `categoria_for_corso` FOREIGN KEY (`ID_categoria`) REFERENCES `categoria` (`ID`),
  ADD CONSTRAINT `istruttore_for_corso` FOREIGN KEY (`ID_istruttore`) REFERENCES `istruttore` (`ID`);

--
-- Limiti per la tabella `domanda`
--
ALTER TABLE `domanda`
  ADD CONSTRAINT `esercitazione_for_domanda` FOREIGN KEY (`ID_esercitazione`) REFERENCES `esercitazione` (`ID`);

--
-- Limiti per la tabella `esercitazione`
--
ALTER TABLE `esercitazione`
  ADD CONSTRAINT `corso_for_esercitazione` FOREIGN KEY (`ID_corso`) REFERENCES `corso` (`ID`);

--
-- Limiti per la tabella `materiale`
--
ALTER TABLE `materiale`
  ADD CONSTRAINT `corso_for_materiale` FOREIGN KEY (`ID_corso`) REFERENCES `corso` (`ID`),
  ADD CONSTRAINT `lezione_for_materiale` FOREIGN KEY (`ID_lezione`) REFERENCES `lezione` (`ID`);

--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `utente_for_notifica` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `recensione`
--
ALTER TABLE `recensione`
  ADD CONSTRAINT `iscrizione_for_recensione` FOREIGN KEY (`ID_iscrizione`) REFERENCES `storico_iscrizioni_corso` (`ID`);

--
-- Limiti per la tabella `risposta`
--
ALTER TABLE `risposta`
  ADD CONSTRAINT `domanda_for_risposta` FOREIGN KEY (`ID_domanda`) REFERENCES `domanda` (`ID`);

--
-- Limiti per la tabella `storico_esercitazioni_corso`
--
ALTER TABLE `storico_esercitazioni_corso`
  ADD CONSTRAINT `esercitazione_for_storico_esercitazioni` FOREIGN KEY (`ID_esercitazione`) REFERENCES `storico_iscrizioni_corso` (`ID`),
  ADD CONSTRAINT `iscrizione_for_storico_esercitazioni` FOREIGN KEY (`ID_iscrizione`) REFERENCES `storico_iscrizioni_corso` (`ID`);

--
-- Limiti per la tabella `storico_iscrizioni_corso`
--
ALTER TABLE `storico_iscrizioni_corso`
  ADD CONSTRAINT `corso_for_storico_iscrizioni` FOREIGN KEY (`ID_corso`) REFERENCES `corso` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utente_for_storico_iscrizioni` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `storico_lezioni_corso`
--
ALTER TABLE `storico_lezioni_corso`
  ADD CONSTRAINT `iscrizione_for_storico_lezioni` FOREIGN KEY (`ID_iscrizione`) REFERENCES `storico_iscrizioni_corso` (`ID`),
  ADD CONSTRAINT `lezione_for_storico_lezioni` FOREIGN KEY (`ID_lezione`) REFERENCES `lezione` (`ID`);

--
-- Limiti per la tabella `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `materiale_for_video` FOREIGN KEY (`ID_materiale`) REFERENCES `materiale` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
