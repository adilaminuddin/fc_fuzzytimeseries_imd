-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02 Mar 2016 pada 05.19
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bandwidth`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE IF NOT EXISTS `bulan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`id`, `nama`) VALUES
(1, 'januari'),
(2, 'februari'),
(3, 'maret'),
(4, 'april'),
(5, 'mei'),
(6, 'juni'),
(7, 'juli'),
(8, 'agustus'),
(9, 'september'),
(10, 'oktober'),
(11, 'november'),
(12, 'desember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kebutuhan_bandwidth`
--

CREATE TABLE IF NOT EXISTS `kebutuhan_bandwidth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `kebutuhan_bandwidth`
--

INSERT INTO `kebutuhan_bandwidth` (`id`, `bulan`, `tahun`, `jumlah`) VALUES
(1, 2, 2012, 12203),
(2, 3, 2012, 10516),
(3, 4, 2012, 10389),
(4, 5, 2012, 10795),
(5, 6, 2012, 13646),
(6, 7, 2012, 11249),
(7, 8, 2012, 11566),
(8, 9, 2012, 12776),
(9, 10, 2012, 11050),
(10, 11, 2012, 11234),
(11, 12, 2012, 11932),
(12, 1, 2013, 11833),
(13, 2, 2013, 12480),
(14, 3, 2013, 10965),
(15, 4, 2013, 12389),
(16, 5, 2013, 14815),
(17, 6, 2013, 14635),
(18, 7, 2013, 11463),
(19, 8, 2013, 12784),
(20, 9, 2013, 16104),
(21, 10, 2013, 15002),
(22, 11, 2013, 12281),
(23, 12, 2013, 14380),
(24, 1, 2014, 18335);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`) VALUES
(1, 'admin', 'admin', 'Administor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
