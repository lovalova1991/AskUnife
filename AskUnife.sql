-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Nov 24, 2015 alle 17:11
-- Versione del server: 5.6.26
-- Versione PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `AskUnife`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`email`, `nome`, `cognome`, `password`) VALUES
('daniele@mail.it', 'Daniele', 'Lovato', '123456');

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_cat` bigint(20) unsigned NOT NULL,
  `nome_cat` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`id_cat`, `nome_cat`) VALUES
(10, 'Altro..'),
(2, 'Architettura'),
(7, 'Filosofia'),
(9, 'Generale'),
(4, 'Informatica'),
(1, 'Ingegneria'),
(5, 'Lettere'),
(8, 'Matematica'),
(6, 'Medicina');

-- --------------------------------------------------------

--
-- Struttura della tabella `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `q_id` bigint(20) unsigned NOT NULL,
  `id_cat` int(11) NOT NULL,
  `q_title` varchar(255) NOT NULL,
  `q_text` text NOT NULL,
  `q_utente` varchar(255) NOT NULL,
  `TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `questions`
--

INSERT INTO `questions` (`q_id`, `id_cat`, `q_title`, `q_text`, `q_utente`, `TIME`) VALUES
(16, 1, 'studio Analisi 2', 'si studio', 'luigi@mail.it', '2015-10-17 09:38:44'),
(17, 1, 'aiuto query sql', 'ciao a tutti, come posso effettuare una ricerca su una tabella utenti e ordinare per nome il risultato?', 'luigi@mail.it', '2015-10-09 16:10:47'),
(18, 9, 'hi i am erasmus!', 'Hello, where I should go to get help?', 'steve@mail.it', '2015-10-09 16:14:56'),
(19, 6, 'Info esame Anatomia', 'ciao, sono uno studente del primo anno, come si affronta lo studio di anatomia?', 'larry@mail.it', '2015-10-09 16:17:07'),
(20, 7, 'Il superuranio', 'Ciao ragazzi, avete qualche dispensa di Platone? Grazie!', 'jhon@mail.it', '2015-10-09 19:39:15');

-- --------------------------------------------------------

--
-- Struttura della tabella `q_answers`
--

CREATE TABLE IF NOT EXISTS `q_answers` (
  `id` bigint(20) unsigned NOT NULL,
  `a_id` int(11) NOT NULL,
  `a_title` varchar(255) NOT NULL,
  `a_text` text CHARACTER SET utf8 NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `a_utente` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `q_answers`
--

INSERT INTO `q_answers` (`id`, `a_id`, `a_title`, `a_text`, `time`, `a_utente`) VALUES
(17, 18, 'Hey!', 'You have to go to Segreteria Studenti in Via Savonarola 9', '2015-10-09 16:18:23', 'larry@mail.it'),
(18, 18, 'thanks', 'thank you mate! see you around!', '2015-10-09 16:21:50', 'steve@mail.it'),
(19, 18, 'alternative solution', 'otherwise you can send an email to segreteria@unife.it', '2015-10-09 16:24:15', 'larry@mail.it'),
(20, 20, 'ciao', 'ciao', '2015-10-17 09:37:58', 'luigi@mail.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`email`, `nome`, `cognome`, `password`, `birth`) VALUES
('jhon@mail.it', 'Jhon', 'Appleseed', '12345', '1989-01-30'),
('larry@mail.it', 'Larry', 'Page', '12345', '1995-10-05'),
('luigi@mail.it', 'Luigi', 'Bianchi', '12345', '1970-05-02'),
('mario@mail.it', 'Mario', 'Rossi', '12345', '1966-12-30'),
('steve@mail.it', 'Steve', 'Ballmer', '12345', '1958-06-02');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`),
  ADD UNIQUE KEY `id_cat` (`id_cat`),
  ADD UNIQUE KEY `nome_cat` (`nome_cat`);

--
-- Indici per le tabelle `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`),
  ADD UNIQUE KEY `q_id` (`q_id`),
  ADD KEY `q_utente` (`q_utente`);

--
-- Indici per le tabelle `q_answers`
--
ALTER TABLE `q_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `a_utente` (`a_utente`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT per la tabella `q_answers`
--
ALTER TABLE `q_answers`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `drop` FOREIGN KEY (`q_utente`) REFERENCES `utenti` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `q_answers`
--
ALTER TABLE `q_answers`
  ADD CONSTRAINT `canc_from_question` FOREIGN KEY (`a_utente`) REFERENCES `questions` (`q_utente`) ON DELETE CASCADE,
  ADD CONSTRAINT `drop_answer` FOREIGN KEY (`a_utente`) REFERENCES `utenti` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
