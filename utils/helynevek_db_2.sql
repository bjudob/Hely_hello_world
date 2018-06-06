-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2017 at 01:44 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helynevek_db_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `helyfajta`
--

CREATE TABLE `helyfajta` (
  `ID` int(11) NOT NULL,
  `Nev` varchar(255) NOT NULL,
  `Kod` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `helyfajta`
--

INSERT INTO `helyfajta` (`ID`, `Nev`, `Kod`) VALUES
(21, 'Víznév', '1'),
(23, 'Folyóvíz', '1.1'),
(24, 'Állóvíz', '1.2'),
(25, 'Álló- és Folyóvízrész', '1.3'),
(26, 'Forrás, Kút', '1.4'),
(27, 'Vízparti hely', '2'),
(28, 'Vízpart, Partszakasz', '2.1'),
(29, 'Félsziget, Víztörő', '2.2'),
(30, 'Sziget, Szirt, Zátony', '2.3'),
(31, 'Mocsár, Láp', '2.4'),
(32, 'Domborzati név', '3'),
(33, 'Hegy, Domb', '3.1'),
(34, 'Völgy', '3.2'),
(35, 'Hegy- és Völgyrész', '3.3'),
(36, 'Egyenes felszínű terület', '3.4'),
(37, 'Egyenetlen felszínű terület', '3.5'),
(38, 'Tájnév', '4'),
(39, 'Határnév', '5'),
(40, 'Szántóföld', '5.1'),
(41, 'Kert', '5.2'),
(42, 'Gyümölcsös', '5.3'),
(43, 'Szőlős', '5.4'),
(44, 'Rét, Kaszáló', '5.5'),
(45, 'Legelő', '5.6'),
(46, 'Erdő, Liget, Bokros', '5.7'),
(47, 'Lakott terület', '6'),
(48, 'Közigazgatási név', '6.1'),
(49, 'Helységnév', '6.2'),
(50, 'Településrész', '6.3'),
(51, 'Utcanév', '6.4'),
(52, 'Tanyanév', '6.5'),
(53, 'Építmény', '7'),
(54, 'Lakóház', '7.1'),
(55, 'Középület', '7.2'),
(56, 'Kocsma', '7.3'),
(57, 'Gazdasági épület', '7.4'),
(58, 'Állomás', '7.5'),
(59, 'Út', '7.6'),
(60, 'Híd', '7.7'),
(61, 'Kisebb építmény', '7.8'),
(62, 'Bánya', '7.9'),
(63, 'Határvonal', '7.10');

-- --------------------------------------------------------

--
-- Table structure for table `helynev`
--

CREATE TABLE `helynev` (
  `ID` int(11) NOT NULL,
  `Standard` varchar(255) NOT NULL,
  `Ejtes` varchar(255) DEFAULT NULL,
  `Helyfajta` int(11) DEFAULT NULL,
  `Terkepszam` int(11) DEFAULT NULL,
  `Ragos_Alak` varchar(511) DEFAULT NULL,
  `Nyelv` int(11) NOT NULL,
  `Forras_Adat` varchar(255) DEFAULT NULL,
  `Forras_Tipus` varchar(255) DEFAULT NULL,
  `Objektum_Info` varchar(1000) DEFAULT NULL,
  `Nev_Info` varchar(1000) DEFAULT NULL,
  `Nevvarians` varchar(511) DEFAULT NULL,
  `Nevfajta` int(11) DEFAULT NULL,
  `Szerkezet` varchar(511) DEFAULT NULL,
  `Nevresz` varchar(255) DEFAULT NULL,
  `Nevelem` varchar(255) DEFAULT NULL,
  `Szabaly` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `megye`
--

CREATE TABLE `megye` (
  `ID` int(11) NOT NULL,
  `Nev` varchar(255) NOT NULL,
  `Is_Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `megye`
--

INSERT INTO `megye` (`ID`, `Nev`, `Is_Active`) VALUES
(1, 'Hargita', 1),
(2, 'Kovászna', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nyelv`
--

CREATE TABLE `nyelv` (
  `ID` int(11) NOT NULL,
  `Nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nyelv`
--

INSERT INTO `nyelv` (`ID`, `Nev`) VALUES
(1, 'magyar'),
(2, 'román'),
(3, 'cigány'),
(4, 'szász'),
(5, 'székely'),
(6, 'csángó');

-- --------------------------------------------------------

--
-- Table structure for table `szabaly`
--

CREATE TABLE `szabaly` (
  `ID` int(11) NOT NULL,
  `Nev` varchar(511) NOT NULL,
  `Kod` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tajegyseg`
--

CREATE TABLE `tajegyseg` (
  `ID` int(11) NOT NULL,
  `Nev` varchar(255) NOT NULL,
  `Is_Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tajegyseg`
--

INSERT INTO `tajegyseg` (`ID`, `Nev`, `Is_Active`) VALUES
(1, 'Csík', 1),
(2, 'Gyergyó', 1);

-- --------------------------------------------------------

--
-- Table structure for table `telepules`
--

CREATE TABLE `telepules` (
  `ID` int(11) NOT NULL,
  `Nev` varchar(255) NOT NULL,
  `Megye` int(11) DEFAULT NULL,
  `Tajegyseg` int(11) DEFAULT NULL,
  `Telepules_Tipus` int(11) DEFAULT NULL,
  `Nyelv` int(3) DEFAULT '1',
  `Is_Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `telepules`
--

INSERT INTO `telepules` (`ID`, `Nev`, `Megye`, `Tajegyseg`, `Telepules_Tipus`, `Nyelv`, `Is_Active`) VALUES
(2, 'Csíkszereda', 1, 1, 1, 1, 1),
(3, 'Csíksomlyó', 1, 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `telepulestipus`
--

CREATE TABLE `telepulestipus` (
  `ID` int(11) NOT NULL,
  `Nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `telepulestipus`
--

INSERT INTO `telepulestipus` (`ID`, `Nev`) VALUES
(1, 'Város'),
(2, 'Falu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'boti', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `helyfajta`
--
ALTER TABLE `helyfajta`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `helynev`
--
ALTER TABLE `helynev`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `megye`
--
ALTER TABLE `megye`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `nyelv`
--
ALTER TABLE `nyelv`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `szabaly`
--
ALTER TABLE `szabaly`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tajegyseg`
--
ALTER TABLE `tajegyseg`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `telepules`
--
ALTER TABLE `telepules`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Megye` (`Megye`),
  ADD KEY `Tajegyseg` (`Tajegyseg`),
  ADD KEY `Telepules_Tipus` (`Telepules_Tipus`),
  ADD KEY `Nyelv` (`Nyelv`);

--
-- Indexes for table `telepulestipus`
--
ALTER TABLE `telepulestipus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `helyfajta`
--
ALTER TABLE `helyfajta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `helynev`
--
ALTER TABLE `helynev`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `megye`
--
ALTER TABLE `megye`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `nyelv`
--
ALTER TABLE `nyelv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `szabaly`
--
ALTER TABLE `szabaly`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tajegyseg`
--
ALTER TABLE `tajegyseg`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `telepules`
--
ALTER TABLE `telepules`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `telepulestipus`
--
ALTER TABLE `telepulestipus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `telepules`
--
ALTER TABLE `telepules`
  ADD CONSTRAINT `telepules_megye_FK` FOREIGN KEY (`Megye`) REFERENCES `megye` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `telepules_nyelv_FK` FOREIGN KEY (`Nyelv`) REFERENCES `nyelv` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `telepules_tajegyseg_FK` FOREIGN KEY (`Tajegyseg`) REFERENCES `tajegyseg` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `telepules_telepulestipus_FK` FOREIGN KEY (`Telepules_Tipus`) REFERENCES `telepulestipus` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
