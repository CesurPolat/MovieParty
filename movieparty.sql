-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Mar 2021, 23:35:22
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `movieparty`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rooms`
--

CREATE TABLE `rooms` (
  `Room_id` int(11) NOT NULL,
  `Video_data` text COLLATE utf8_turkish_ci NOT NULL,
  `Participants` text COLLATE utf8_turkish_ci NOT NULL,
  `Chat` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `rooms`
--

INSERT INTO `rooms` (`Room_id`, `Video_data`, `Participants`, `Chat`) VALUES
(679205, 'https://www.w3schools.com/html/mov_bbb.mp4;play;1.030437;35', '', ''),
(211909, 'https://storage.googleapis.com/flash-realm-305713/8XNJKTZQG3L/22a_1615050926154095.mp4;pause;1342.875535;146', '', ''),
(607058, 'https://www.youtube.com/watch?v=urhswIDbREg;pause;0;95', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
