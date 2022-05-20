-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Mag 20, 2022 alle 03:01
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_tecnologie_web`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `cod_carrello` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `notifiche`
--

CREATE TABLE `notifiche` (
  `cod_notifica` int(20) NOT NULL,
  `titolo_not` varchar(150) NOT NULL,
  `descrizione_not` varchar(300) NOT NULL,
  `data_not` varchar(40) NOT NULL,
  `visto` varchar(20) NOT NULL,
  `id_utente_N` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `cod_ordine` int(11) NOT NULL,
  `data_ord` varchar(20) NOT NULL,
  `recapito_ord` varchar(200) NOT NULL,
  `indirizzo_sped` varchar(150) NOT NULL,
  `città_ord` varchar(20) NOT NULL,
  `cap_ord` varchar(10) NOT NULL,
  `cod_carrello_O` int(11) NOT NULL,
  `id_utente_O` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine_nel_carrello`
--

CREATE TABLE `ordine_nel_carrello` (
  `cod_car_con_prod` int(11) NOT NULL,
  `cod_prod_car` int(11) NOT NULL,
  `quantità_prod_car` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `cod_prod` int(11) NOT NULL,
  `nome_prod` varchar(100) NOT NULL,
  `desc_prod` varchar(2000) NOT NULL,
  `img_prod` varchar(100) NOT NULL,
  `prezzo_unitario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`cod_prod`, `nome_prod`, `desc_prod`, `img_prod`, `prezzo_unitario`) VALUES
(1, 'Pizza margherita', 'pizza con polpa di pomodoro, origano,mozzarella', 'Pizza margherita.jpg', 9),
(2, 'Pizza con La Zizzona', 'Pizza con pomodori freschi,basilico fresco e origano', 'Pizza con la zizzona.jpg', 10),
(3, 'Pizza con asparagi bacon e uova', 'pizza con polpa di pomodoro, mozzarella, tuorli sodi ,fette di bacon, asparagi freschi e origano', 'Pizza con asparagi bacon e uova.jpg', 11),
(4, 'Pizza alla polpa di granchio e gorgonzola', 'pizza con mozzarella, gorgonzola ,polpa di granchio ,prezzemolo fresco e limone', 'Pizza alla polpa di granchio e gorgonzola.jpg', 12),
(5, 'Pizza con salsiccia e scamorza', 'Pizza con di polpa di pomodoro, origano ,olio extravergine d’oliva, origano, scamorza affumicata e salsiccia', 'Pizza con salsiccia e scamorza.jpg', 10),
(6, 'Pizza alla napoletana con aglio', 'pizza con  polpa di pomodoro, olio extravergine d’oliva, aglio, capperi, acciughe eorigano', 'Pizza alla napoletana con aglio.jpg', 11),
(7, 'Pizza con carne di cavallo', 'mozzarella, di carne di cavallo, polpa di pomodoro, olio extravergine d’oliva ,prezzemolo fresco e origano', 'pizza con carne di cavallo.jpg', 12),
(8, 'Pizza bianca con mortadella e pistacchi', 'pizza con mozzarella, olio extravergine d’oliva, mortadella, pistacchi non salati ,pepe a piacere', 'Pizza bianca con mortadella e pistacchi.jpg', 11),
(9, 'Pizza con mozzarella di bufala pesto e pomodorini', 'pizza con Corona di  Paestum, polpa di pomodoro, pesto al basilico, pomodorini piccadilly, olio extravergine d’oliva, origano, badilico fresco (se stagione)', 'Pizza con mozzarella di bufala pesto e pomodorini.jpg', 12),
(10, 'Pizza con polpo', 'Pizza con polpo cotto, polpa di pomodoro, mozzarella, spicchio d’aglio, prezzemolo fresco, origano e\r\nolio extravergine d’oliva', 'Pizza con polpo.jpg', 10),
(11, 'Pizza con bottarga e pecorino', 'pizza con polpa di pomodoro,olio extravergine d’oliva,origano,mozzarella,bottarga di muggine,pecorino semi stagionato', 'Pizza con bottarga e pecorino.jpg', 12),
(12, 'Pizza bianca con mortadella e pistacchi', 'pizza con mozzarella, olio extravergine d’oliva, mortadella, pistacchi non salati ,pepe a piacere', 'Pizza bianca con mortadella e pistacchi.jpg', 10),
(13, 'Pizza soffice', 'pizza con polpa di pomodoro, mozzarella,origano e olio extravergine d’oliva', 'Pizza soffice.jpg', 10),
(14, 'Pizza tricolore', 'pizza con salsa di pomodoro\r\nolio extravergine d’oliva origano\r\nbasilico fresco, pomodori,mozzarella di bufala\r\nrucola', 'Pizza tricolore.jpg', 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `stato`
--

CREATE TABLE `stato` (
  `stato_spedizione` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `stato`
--

INSERT INTO `stato` (`stato_spedizione`) VALUES
('in consegna'),
('in preparazione'),
('ordinato');

-- --------------------------------------------------------

--
-- Struttura della tabella `stato_ordine`
--

CREATE TABLE `stato_ordine` (
  `stato` varchar(20) NOT NULL,
  `num_ordine` int(11) NOT NULL,
  `data_stato` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id_utente` int(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `cod_car_U` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id_utente`, `nome`, `cognome`, `email`, `password`, `tipo`, `cod_car_U`) VALUES
(6, 'pizzayolo', 'pizzayolo', 'pizzayolo@gmail.com', 'pizzayolo', 'amministratore', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`cod_carrello`);

--
-- Indici per le tabelle `notifiche`
--
ALTER TABLE `notifiche`
  ADD PRIMARY KEY (`cod_notifica`),
  ADD KEY `id_utente` (`id_utente_N`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`cod_ordine`),
  ADD KEY `cod_carrello` (`cod_carrello_O`,`id_utente_O`),
  ADD KEY `id_utente_O` (`id_utente_O`);

--
-- Indici per le tabelle `ordine_nel_carrello`
--
ALTER TABLE `ordine_nel_carrello`
  ADD PRIMARY KEY (`cod_car_con_prod`,`cod_prod_car`),
  ADD KEY `cod_prod_car` (`cod_prod_car`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`cod_prod`);

--
-- Indici per le tabelle `stato`
--
ALTER TABLE `stato`
  ADD PRIMARY KEY (`stato_spedizione`);

--
-- Indici per le tabelle `stato_ordine`
--
ALTER TABLE `stato_ordine`
  ADD PRIMARY KEY (`stato`,`num_ordine`),
  ADD KEY `nom_ordine` (`num_ordine`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id_utente`),
  ADD KEY `cod_car_U` (`cod_car_U`),
  ADD KEY `cod_car_U_2` (`cod_car_U`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `notifiche`
--
ALTER TABLE `notifiche`
  MODIFY `cod_notifica` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `cod_ordine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `cod_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id_utente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
