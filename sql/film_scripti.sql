-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 18 Ara 2019, 09:42:47
-- Sunucu sürümü: 10.4.6-MariaDB
-- PHP Sürümü: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `film_scripti`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_paneli`
--

CREATE TABLE `admin_paneli` (
  `admin_id` int(11) NOT NULL,
  `admin_rütbe` int(11) NOT NULL,
  `admin_last_login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `admin_paneli`
--

INSERT INTO `admin_paneli` (`admin_id`, `admin_rütbe`, `admin_last_login`) VALUES
(1, 1, '2019-12-04 13:25:57'),
(2, 1, '2019-09-04 10:13:44');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cast`
--

CREATE TABLE `cast` (
  `id` int(11) NOT NULL,
  `cast_id` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `cast_imdb_id` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `cast_job` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `cast_name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `cast_birth_day` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cast_death_day` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cast_birth_place` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cast_biography` longtext COLLATE utf8_turkish_ci DEFAULT NULL,
  `cast_image` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `popularity` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `diziler`
--

CREATE TABLE `diziler` (
  `id` int(11) NOT NULL,
  `dizi_id` varchar(255) NOT NULL,
  `dizi_imdb_id` varchar(255) DEFAULT NULL,
  `dizi_ad` varchar(255) NOT NULL,
  `dizi_türü` varchar(255) NOT NULL,
  `dizi_sezon_sayisi` int(11) NOT NULL,
  `dizi_puanı` double NOT NULL,
  `dizi_şirketi` varchar(255) DEFAULT NULL,
  `dizi_keywords` varchar(255) DEFAULT NULL,
  `dizi_cast` longtext DEFAULT NULL,
  `dizi_durumu` varchar(255) NOT NULL,
  `dizi_release_date` varchar(255) NOT NULL,
  `dizi_finished_date` varchar(255) NOT NULL,
  `dizi_describe` text NOT NULL,
  `dizi_image` varchar(255) NOT NULL,
  `dizi_kapak_image` varchar(255) NOT NULL,
  `dizi_trailer` varchar(255) DEFAULT NULL,
  `dizi_facebook` varchar(255) DEFAULT NULL,
  `dizi_twitter` varchar(255) DEFAULT NULL,
  `dizi_instagram` varchar(255) DEFAULT NULL,
  `dizi_add_date` varchar(255) NOT NULL,
  `dizi_sef_link` varchar(255) NOT NULL,
  `total_views` int(11) NOT NULL,
  `week_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dizi_bölümleri`
--

CREATE TABLE `dizi_bölümleri` (
  `id` int(11) NOT NULL,
  `episode_id` varchar(255) NOT NULL,
  `dizi_id` int(11) NOT NULL,
  `season_number` int(11) NOT NULL,
  `episode_number` int(11) NOT NULL,
  `episode_name` varchar(255) NOT NULL,
  `episode_puan` double NOT NULL,
  `episode_süre` int(11) NOT NULL,
  `episode_describe` mediumtext NOT NULL,
  `episode_image` varchar(255) NOT NULL,
  `episode_sef_link` varchar(255) NOT NULL,
  `episode_release_date` varchar(255) NOT NULL,
  `episode_durum` varchar(255) NOT NULL,
  `episode_add_date` varchar(255) NOT NULL,
  `total_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favoriler`
--

CREATE TABLE `favoriler` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `uye_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `filmler`
--

CREATE TABLE `filmler` (
  `id` int(11) NOT NULL,
  `film_id` varchar(255) NOT NULL,
  `film_imdb_id` varchar(255) NOT NULL,
  `film_ad` varchar(255) NOT NULL,
  `film_türü` varchar(255) NOT NULL,
  `film_süresi` int(11) NOT NULL,
  `film_puanı` double NOT NULL,
  `film_bütçesi` varchar(255) NOT NULL,
  `film_şirketi` varchar(255) DEFAULT NULL,
  `film_keywords` longtext DEFAULT NULL,
  `film_ekibi` longtext DEFAULT NULL,
  `film_release_date` varchar(255) NOT NULL,
  `film_describe` text NOT NULL,
  `film_image` varchar(255) NOT NULL,
  `film_kapak_image` varchar(255) NOT NULL,
  `film_trailer` varchar(255) DEFAULT NULL,
  `film_facebook` varchar(255) DEFAULT NULL,
  `film_twitter` varchar(255) DEFAULT NULL,
  `film_instagram` varchar(255) DEFAULT NULL,
  `film_add_date` varchar(255) NOT NULL,
  `film_sef_link` varchar(255) NOT NULL,
  `total_views` int(11) NOT NULL,
  `week_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kaynak_linkleri`
--

CREATE TABLE `kaynak_linkleri` (
  `id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `dizi_id` int(11) NOT NULL,
  `bölüm_id` int(11) NOT NULL,
  `kaynak_türü` varchar(255) NOT NULL,
  `kaynak_ismi` varchar(255) NOT NULL,
  `kaynak_kalite` varchar(255) NOT NULL,
  `kaynak_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resimler`
--

CREATE TABLE `resimler` (
  `id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `dizi_id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `türler`
--

CREATE TABLE `türler` (
  `id` int(11) NOT NULL,
  `tür` varchar(255) NOT NULL,
  `tip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `türler`
--

INSERT INTO `türler` (`id`, `tür`, `tip`) VALUES
(1, 'Aksiyon', 'film'),
(2, 'Macera', 'film'),
(3, 'Animasyon', 'film'),
(4, 'Komedi', 'film'),
(5, 'Suç', 'film'),
(6, 'Belgesel', 'film'),
(7, 'Dram', 'film'),
(8, 'Aile', 'film'),
(9, 'Fantastik', 'film'),
(10, 'Tarih', 'film'),
(11, 'Korku', 'film'),
(12, 'Müzik', 'film'),
(13, 'Gizem', 'film'),
(14, 'Romantik', 'film'),
(15, 'Bilim-Kurgu', 'film'),
(16, 'TV film', 'film'),
(17, 'Gerilim', 'film'),
(18, 'Savaş', 'film'),
(19, 'Vahşi Batı', 'film'),
(20, 'Aksiyon & Macera', 'dizi'),
(21, 'Animasyon', 'dizi'),
(22, 'Komedi', 'dizi'),
(23, 'Suç', 'dizi'),
(24, 'Belgesel', 'dizi'),
(25, 'Dram', 'dizi'),
(26, 'Aile', 'dizi'),
(27, 'Çocuklar', 'dizi'),
(28, 'Gizem', 'dizi'),
(29, 'Haber', 'dizi'),
(30, 'Gerçeklik', 'dizi'),
(31, 'Bilim Kurgu & Fantazi', 'dizi'),
(32, 'Pembe Dizi', 'dizi'),
(33, 'Talk', 'dizi'),
(34, 'Savaş & Politik', 'dizi'),
(35, 'Vahşi Batı', 'dizi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `uye_id` int(11) NOT NULL,
  `uye_nickname` varchar(50) NOT NULL,
  `uye_ad` varchar(255) NOT NULL,
  `uye_soyad` varchar(255) NOT NULL,
  `uye_email` varchar(50) NOT NULL,
  `uye_sifre` varchar(250) NOT NULL,
  `uye_avatar` varchar(250) NOT NULL,
  `uye_aktif` tinyint(1) NOT NULL,
  `uye_kayit_tarihi` varchar(255) NOT NULL,
  `uyelik_türü` varchar(50) NOT NULL,
  `uye_facebook_url` varchar(255) NOT NULL,
  `uye_twitter_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`uye_id`, `uye_nickname`, `uye_ad`, `uye_soyad`, `uye_email`, `uye_sifre`, `uye_avatar`, `uye_aktif`, `uye_kayit_tarihi`, `uyelik_türü`, `uye_facebook_url`, `uye_twitter_url`) VALUES
(1, 'blackdewil987', 'Caner', 'Sülüşoğlu', 'be.caner@hotmail.com', '07201fa07b3627b90fcb02655a4a0b61', '1.png', 1, '2019-08-23 19:12:10', 'normal', '', ''),
(8, 'fb:caner-sulusoglu', 'Caner', 'Sülüşoğlu', 'be.caner@outlook.com', 'fa2fc03909f0c6d6baa68a94f9598085', 'http://graph.facebook.com/2800477749965595/picture', 1, '2019-09-26 09:37:02', 'facebook', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `videolar`
--

CREATE TABLE `videolar` (
  `id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `dizi_id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `video_name` varchar(255) NOT NULL,
  `video_site` varchar(255) NOT NULL,
  `video_size` varchar(255) NOT NULL,
  `video_type` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorum_id` int(11) NOT NULL,
  `comment_type` varchar(255) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `uye_id` int(11) NOT NULL,
  `comment_title` varchar(255) NOT NULL,
  `comment` longtext NOT NULL,
  `comment_rate` double NOT NULL,
  `sended_date` varchar(255) NOT NULL,
  `comment_onay` tinyint(1) NOT NULL,
  `comment_spoiler` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `şirketler`
--

CREATE TABLE `şirketler` (
  `id` int(11) NOT NULL,
  `company_id` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_country` varchar(255) NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_paneli`
--
ALTER TABLE `admin_paneli`
  ADD PRIMARY KEY (`admin_id`);

--
-- Tablo için indeksler `cast`
--
ALTER TABLE `cast`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `diziler`
--
ALTER TABLE `diziler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `dizi_bölümleri`
--
ALTER TABLE `dizi_bölümleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `favoriler`
--
ALTER TABLE `favoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `filmler`
--
ALTER TABLE `filmler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kaynak_linkleri`
--
ALTER TABLE `kaynak_linkleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `resimler`
--
ALTER TABLE `resimler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `türler`
--
ALTER TABLE `türler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`uye_id`);

--
-- Tablo için indeksler `videolar`
--
ALTER TABLE `videolar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorum_id`),
  ADD UNIQUE KEY `id` (`yorum_id`);

--
-- Tablo için indeksler `şirketler`
--
ALTER TABLE `şirketler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_paneli`
--
ALTER TABLE `admin_paneli`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1910;

--
-- Tablo için AUTO_INCREMENT değeri `cast`
--
ALTER TABLE `cast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `diziler`
--
ALTER TABLE `diziler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `dizi_bölümleri`
--
ALTER TABLE `dizi_bölümleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `favoriler`
--
ALTER TABLE `favoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `filmler`
--
ALTER TABLE `filmler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kaynak_linkleri`
--
ALTER TABLE `kaynak_linkleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `resimler`
--
ALTER TABLE `resimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `türler`
--
ALTER TABLE `türler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `uye_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `videolar`
--
ALTER TABLE `videolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorum_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `şirketler`
--
ALTER TABLE `şirketler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

DELIMITER $$
--
-- Olaylar
--
CREATE DEFINER=`root`@`localhost` EVENT `Haftalık Film Görüntüleme Sayısı Sıfırlama` ON SCHEDULE EVERY 1 WEEK STARTS '2019-09-08 09:21:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE filmler SET week_views = 0$$

CREATE DEFINER=`root`@`localhost` EVENT `Haftalık Dizi Görüntüleme Sayısı Sıfırlama` ON SCHEDULE EVERY 1 WEEK STARTS '2019-09-25 09:21:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE diziler SET week_views = 0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
