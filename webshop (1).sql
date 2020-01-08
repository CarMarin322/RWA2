-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2020 at 07:06 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikl`
--

CREATE TABLE `artikl` (
  `artikl_id` int(11) NOT NULL,
  `artikl_naziv` varchar(255) NOT NULL,
  `artikl_cijena` int(11) NOT NULL,
  `artikl_kategorija` int(255) NOT NULL,
  `slika` varchar(256) NOT NULL,
  `opis` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikl`
--

INSERT INTO `artikl` (`artikl_id`, `artikl_naziv`, `artikl_cijena`, `artikl_kategorija`, `slika`, `opis`) VALUES
(1, 'APPLE MacBook Air 13,3\"', 9499, 1, '', ''),
(2, 'LENOVO IdeaPad L340', 5224, 1, '', ''),
(3, 'HP Omen 17 7SB06EA ', 9539, 1, '', ''),
(6, 'ACER Predator Helios 300', 9974, 1, '', ''),
(11, 'HP Pavilion 5KR58EA', 4749, 2, '', ''),
(12, 'Acer Aspire C22-865', 4369, 2, '', ''),
(13, 'Acer Veriton DT.VQXEX.081', 3500, 2, '', ''),
(14, 'LENOVO V530', 4750, 2, '', ''),
(19, 'AMD Ryzen 5 3600X', 2279, 3, '', ''),
(20, 'Radeon RX 5700 XT', 3990, 3, '', ''),
(21, 'KINGSTON 16 GB', 835, 3, '', ''),
(22, 'SROCK B450 Gaming', 759, 3, '', ''),
(27, 'ACER V226HQ', 664, 4, '', ''),
(28, 'AOC 22B1H', 664, 4, '', ''),
(29, 'ACER Nitro RG240Yb', 1134, 4, '', ''),
(30, 'SAMSUNG LS27R7', 2759, 4, '', ''),
(35, 'LOGITECH Z906', 2599, 5, '', ''),
(36, 'GAMDIAS HERMES P2', 399, 5, '', ''),
(37, 'REDRAGON Cobra', 189, 5, '', ''),
(38, 'HP DeskJet 2130', 199, 5, '', ''),
(47, 'APPLE HDMI to DVI', 300, 6, '', ''),
(48, 'BELKIN Pro Series', 38, 6, '', ''),
(49, 'DELOCK HDMI', 50, 6, '', ''),
(50, 'DELOCK audio jack 3.5mm', 21, 6, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `kategorija_id` int(11) NOT NULL,
  `kategorija_ime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`kategorija_id`, `kategorija_ime`) VALUES
(1, 'Prijenosna racunala\r\n'),
(2, 'Racunala'),
(3, 'Komponente'),
(4, 'Monitori'),
(5, 'Periferija'),
(6, 'Adapteri i kablovi');

-- --------------------------------------------------------

--
-- Table structure for table `kupac`
--

CREATE TABLE `kupac` (
  `kupac_id` int(11) NOT NULL,
  `kupac_ime` varchar(255) NOT NULL,
  `kupac_prezime` varchar(255) NOT NULL,
  `kupac_mail` varchar(255) NOT NULL,
  `rod` varchar(256) NOT NULL,
  `ulica` varchar(255) NOT NULL,
  `kbr` varchar(255) NOT NULL,
  `postanski` int(11) NOT NULL,
  `grad` varchar(255) NOT NULL,
  `zemlja` varchar(255) NOT NULL,
  `telefon` int(11) NOT NULL,
  `lozinka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `narudzba`
--

CREATE TABLE `narudzba` (
  `narudzba_id` int(11) NOT NULL,
  `kupac_id` int(11) NOT NULL,
  `narudzba_status` varchar(255) NOT NULL,
  `narudzba_datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `na_artikl`
--

CREATE TABLE `na_artikl` (
  `narudzba_id` int(11) NOT NULL,
  `stavka_id` int(11) NOT NULL,
  `artikl_id` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `cijena` int(11) NOT NULL,
  `popust` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikl`
--
ALTER TABLE `artikl`
  ADD PRIMARY KEY (`artikl_id`),
  ADD KEY `artikl_kategorija` (`artikl_kategorija`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`kategorija_id`);

--
-- Indexes for table `kupac`
--
ALTER TABLE `kupac`
  ADD PRIMARY KEY (`kupac_id`),
  ADD UNIQUE KEY `kupac_id` (`kupac_id`),
  ADD KEY `kupac_id_2` (`kupac_id`);

--
-- Indexes for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD PRIMARY KEY (`narudzba_id`),
  ADD UNIQUE KEY `narudzba_id` (`narudzba_id`),
  ADD KEY `narudzba_id_2` (`narudzba_id`),
  ADD KEY `kupac_id` (`kupac_id`);

--
-- Indexes for table `na_artikl`
--
ALTER TABLE `na_artikl`
  ADD PRIMARY KEY (`narudzba_id`,`stavka_id`),
  ADD KEY `artikl_id` (`artikl_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikl`
--
ALTER TABLE `artikl`
  MODIFY `artikl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `kategorija_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kupac`
--
ALTER TABLE `kupac`
  MODIFY `kupac_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `narudzba`
--
ALTER TABLE `narudzba`
  MODIFY `narudzba_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikl`
--
ALTER TABLE `artikl`
  ADD CONSTRAINT `artikl_ibfk_1` FOREIGN KEY (`artikl_id`) REFERENCES `na_artikl` (`artikl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD CONSTRAINT `kategorija_ibfk_1` FOREIGN KEY (`kategorija_id`) REFERENCES `artikl` (`artikl_kategorija`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD CONSTRAINT `narudzba_ibfk_1` FOREIGN KEY (`kupac_id`) REFERENCES `kupac` (`kupac_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `na_artikl`
--
ALTER TABLE `na_artikl`
  ADD CONSTRAINT `na_artikl_ibfk_1` FOREIGN KEY (`narudzba_id`) REFERENCES `narudzba` (`narudzba_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
