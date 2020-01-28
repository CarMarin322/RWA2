-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 02:32 PM
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
-- Database: `webshop_baza`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user` varchar(20) NOT NULL,
  `password` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user`, `password`) VALUES
('root', 0);

-- --------------------------------------------------------

--
-- Table structure for table `artikl`
--

CREATE TABLE `artikl` (
  `artikl_id` int(11) NOT NULL,
  `artikl_naziv` varchar(255) NOT NULL,
  `artikl_cijena` double(11,0) NOT NULL,
  `artikl_kategorija` int(255) NOT NULL,
  `slika` varchar(256) NOT NULL,
  `opis` varchar(256) NOT NULL,
  `popust` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikl`
--

INSERT INTO `artikl` (`artikl_id`, `artikl_naziv`, `artikl_cijena`, `artikl_kategorija`, `slika`, `opis`, `popust`) VALUES
(3, 'HP Omen 17 7SB06EA', 9539, 1, 'slike/HP Omen 17 7SB06EA.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has sur', 50),
(6, 'ACER Predator Helios 300', 9974, 1, 'slike/generic_computer.svg', '', NULL),
(11, 'HP Pavilion 5KR58EA', 4749, 2, 'slike/generic_computer.svg', '', NULL),
(12, 'Acer Aspire C22-865', 4369, 2, 'slike/generic_computer.svg', '', NULL),
(13, 'Acer Veriton DT.VQXEX.081', 3500, 2, 'slike/generic_computer.svg', '', NULL),
(14, 'LENOVO V530', 4750, 2, 'slike/generic_computer.svg', '', NULL),
(20, 'Radeon RX 5700 XT', 3990, 3, 'slike/generic_computer.svg', '', NULL),
(21, 'KINGSTON 16 GB', 835, 3, 'slike/generic_computer.svg', '', NULL),
(22, 'SROCK B450 Gaming', 759, 3, 'slike/generic_computer.svg', '', NULL),
(27, 'ACER V226HQ', 664, 4, 'slike/generic_computer.svg', '', NULL),
(28, 'AOC 22B1H', 664, 4, 'slike/generic_computer.svg', '', NULL),
(30, 'SAMSUNG LS27R7', 2759, 4, 'slike/generic_computer.svg', '', NULL),
(35, 'LOGITECH Z906', 2599, 5, 'slike/generic_computer.svg', '', NULL),
(36, 'GAMDIAS HERMES P2', 399, 5, 'slike/generic_computer.svg', '', NULL),
(37, 'REDRAGON Cobra', 189, 5, 'slike/generic_computer.svg', '', NULL),
(38, 'HP DeskJet 2130', 199, 5, 'slike/generic_computer.svg', '', NULL),
(49, 'DELOCK HDMI', 50, 6, 'slike/generic_computer.svg', '', NULL),
(50, 'DELOCK audio jack 3.5mm', 21, 6, 'slike/generic_computer.svg', '', NULL),
(63, 'hehe', 100, 2, 'slike/generic_computer.svg', '', NULL),
(67, 'komp', 2000, 5, 'slike/generic_computer.svg', 'fkwefkljewlk', 20),
(68, 'RAZER Blade 17 Pro ', 19250, 1, 'slike/generic_computer.svg', 'hgkghkj', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kartica`
--

CREATE TABLE `kartica` (
  `karticaId` int(10) NOT NULL,
  `broj` int(30) NOT NULL,
  `istek` date NOT NULL,
  `cvv` int(4) NOT NULL,
  `kupacId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kartica`
--

INSERT INTO `kartica` (`karticaId`, `broj`, `istek`, `cvv`, `kupacId`) VALUES
(1, 362136, '0000-00-00', 1234, 7);

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
(1, 'Prijenosna računala\r\n'),
(2, 'Računala'),
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
  `postanski` int(11) NOT NULL,
  `grad` varchar(255) NOT NULL,
  `zemlja` varchar(255) NOT NULL,
  `telefon` int(11) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `rođenje` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kupac`
--

INSERT INTO `kupac` (`kupac_id`, `kupac_ime`, `kupac_prezime`, `kupac_mail`, `rod`, `ulica`, `postanski`, `grad`, `zemlja`, `telefon`, `lozinka`, `rođenje`) VALUES
(7, 'Valentina', 'Ecimovi', 'valentina20202@gmail.com', '', 'I.G.Kovačića 200', 52314, 'Ravna Gora', 'Hrvatska', 957372883, '2', '2020-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `narudzba`
--

CREATE TABLE `narudzba` (
  `narudzba_id` int(11) NOT NULL,
  `kupac_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `dostava` varchar(100) NOT NULL,
  `napomena` varchar(200) DEFAULT NULL,
  `placanje` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `narudzba`
--

INSERT INTO `narudzba` (`narudzba_id`, `kupac_id`, `status`, `datum`, `dostava`, `napomena`, `placanje`) VALUES
(15, 7, 'naruceno', '2020-01-24', 'dostava', '', 'gotovina'),
(26, 7, 'naruceno', '2020-01-24', '', '', 'gotovina'),
(27, 7, 'naruceno', '2020-01-24', 'dostava', '', 'gotovina'),
(28, 7, 'naruceno', '2020-01-24', '', '', 'kartica'),
(29, 7, 'naruceno', '2020-01-24', 'dostava', '', 'kartica');

-- --------------------------------------------------------

--
-- Table structure for table `na_artikl`
--

CREATE TABLE `na_artikl` (
  `narudzba_id` int(11) NOT NULL,
  `stavka_id` int(11) NOT NULL DEFAULT current_timestamp(),
  `artikl_id` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `popust` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `na_artikl`
--

INSERT INTO `na_artikl` (`narudzba_id`, `stavka_id`, `artikl_id`, `kolicina`, `popust`) VALUES
(15, 3, 3, 1, '0'),
(15, 6, 6, 1, '0'),
(27, 3, 3, 1, '0'),
(27, 6, 6, 1, '0'),
(29, 3, 3, 1, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user`),
  ADD UNIQUE KEY `id` (`user`);

--
-- Indexes for table `artikl`
--
ALTER TABLE `artikl`
  ADD PRIMARY KEY (`artikl_id`),
  ADD KEY `artikl_kategorija` (`artikl_kategorija`);

--
-- Indexes for table `kartica`
--
ALTER TABLE `kartica`
  ADD PRIMARY KEY (`karticaId`),
  ADD UNIQUE KEY `kupacId` (`kupacId`);

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
  MODIFY `artikl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `kartica`
--
ALTER TABLE `kartica`
  MODIFY `karticaId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `kategorija_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kupac`
--
ALTER TABLE `kupac`
  MODIFY `kupac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `narudzba`
--
ALTER TABLE `narudzba`
  MODIFY `narudzba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kartica`
--
ALTER TABLE `kartica`
  ADD CONSTRAINT `kartica_ibfk_1` FOREIGN KEY (`kupacId`) REFERENCES `kupac` (`kupac_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD CONSTRAINT `kategorija_ibfk_1` FOREIGN KEY (`kategorija_id`) REFERENCES `artikl` (`artikl_kategorija`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
