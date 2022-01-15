-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2022. Jan 15. 20:10
-- Kiszolgáló verziója: 5.7.31
-- PHP verzió: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `14sl_berecz_ildiko`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `autok`
--

DROP TABLE IF EXISTS `autok`;
CREATE TABLE IF NOT EXISTS `autok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marka` varchar(30) CHARACTER SET utf8 NOT NULL,
  `tipus` varchar(30) CHARACTER SET utf8 NOT NULL,
  `uzemanyag` varchar(30) CHARACTER SET utf8 NOT NULL,
  `gyartasi_ev` varchar(4) CHARACTER SET utf8 NOT NULL,
  `eladasi_ar` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `kep` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `leiras` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `autok`
--

INSERT INTO `autok` (`id`, `marka`, `tipus`, `uzemanyag`, `gyartasi_ev`, `eladasi_ar`, `kep`, `leiras`) VALUES
(45, 'Renault', 'Clio Sport', 'benzin', '2019', '4 500 000 Ft', 'uploads//renault-clio.jpg20220115061022.jpg', NULL),
(46, 'Renault', 'Clio', 'benzin', '2004', '400 000 Ft', 'uploads//Renault_clio.jpg20220115063444.jpg', ''),
(47, 'Nizzan', 'Micra', 'dizel', '2017', '1 200 000 Ft', 'uploads//nissan_micra.jpg20220115064406.jpg', 'kiváló állapotú, karbantartott, szerví­zkönyves'),
(48, 'Opel', 'Corsa', 'benzin', '2009', '2 420 000 Ft', 'uploads//Opel_corsa.jpg20220115075926.jpg', 'friss műszakival, szerví­zkönyvvel, téli abroncsokkal'),
(49, 'Mercedes', 'E220', 'benzin', '2010', '2 800 000 Ft', 'uploads//Mercedes_E220_2003.jfif20220115080609.jfif', 'sÃ©rÃ¼lÃ©s mentes, vizsgÃ¡ra vÃ¡r');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

DROP TABLE IF EXISTS `felhasznalo`;
CREATE TABLE IF NOT EXISTS `felhasznalo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `felhasznalo_nev` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `felhasznalo_nev` (`felhasznalo_nev`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `felhasznalo_nev`, `email`, `password`, `phone`) VALUES
(138, 'Berecz Ildikó', 'igazi@hu.hu', '$2y$10$kXhqT6WSqNTRzXiWjPynn.oyVUhE0b4737t778O.qu8ui5VOYGz9C', '06500123456'),
(139, 'Berecz Ádám', 'igazi@hu.hu', '$2y$10$uvZYXtEJCoVBQlmZCEHwZ./qqvq/tC9Dcb.tUbi5uUKiZo1WZB6kK', '06500123457');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
