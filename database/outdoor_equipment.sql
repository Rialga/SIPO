-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Nov 2020 pada 16.25
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `outdoor_equipment`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `alat_kode` varchar(15) NOT NULL,
  `alat_jenis` int(11) NOT NULL,
  `alat_merk` int(11) NOT NULL,
  `alat_tipe` varchar(25) NOT NULL,
  `alat_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`alat_kode`, `alat_jenis`, `alat_merk`, `alat_tipe`, `alat_total`, `created_at`, `updated_at`) VALUES
('C60-C-B', 19, 5, 'Bering', 3, '2020-11-03 17:00:26', '2020-01-06 01:06:10'),
('C60-E-Rh', 19, 3, 'Rhinos', 2, '2020-11-03 16:59:52', '2020-11-03 16:59:52'),
('C80-C-G', 20, 5, 'Galapagos', 1, '2020-11-03 16:51:20', '2020-11-18 10:19:03'),
('C80-R-L', 20, 10, 'Lamandu', 1, '2020-11-03 16:52:32', '2020-11-18 10:19:03'),
('F-C-WP', 16, 5, 'WF-Sheet', 3, '2020-11-03 16:39:31', '2020-01-06 01:06:10'),
('H-TNF-S', 17, 9, 'singel UltraLight', 5, '2020-11-03 17:07:49', '2020-11-06 13:01:18'),
('HL-C-XG', 12, 5, 'XG-8511B', 1, '2020-11-03 15:59:22', '2020-11-16 00:49:14'),
('HL-E-AP', 12, 3, 'Axle Pro', 1, '2020-11-03 15:55:55', '2020-11-18 10:19:03'),
('K-M-KP', 13, 12, 'KP8302', 11, '2020-11-03 16:05:47', '2020-01-06 01:06:10'),
('M-C-SP', 11, 5, 'Spons', 20, '2020-11-03 15:48:51', '2020-01-06 01:06:10'),
('M-E-SP', 11, 3, 'Spons', 10, '2020-11-03 15:49:18', '2020-11-03 15:49:18'),
('N-M-SP', 14, 12, 'Saucepan', 5, '2020-11-03 16:16:00', '2020-01-30 01:15:43'),
('S-S-D', 18, 14, 'Dive MT', 8, '2020-11-03 17:15:54', '2020-11-03 17:15:54'),
('SB-MO-A', 15, 13, 'Alpsdream 400', 2, '2020-11-03 16:28:17', '2020-01-06 01:06:10'),
('SB-TNF-P', 15, 9, 'Polar', 3, '2020-11-03 16:28:51', '2020-11-03 16:28:51'),
('T2-C-ST', 7, 5, 'Summer Time', 2, '2020-11-03 14:43:40', '2020-01-30 01:15:43'),
('T2-R-GB', 7, 10, 'Ground Breaker', 1, '2020-11-03 14:40:02', '2020-11-03 14:40:02'),
('T2-R-QD', 7, 10, 'Quarter Dome SL', 2, '2020-11-02 19:47:07', '2020-01-17 01:13:58'),
('T2-TNF-ET', 7, 9, 'Exo Trail', 1, '2020-11-02 19:51:12', '2020-01-17 01:13:58'),
('T4-C-KHT', 8, 5, 'Khatmandu', 2, '2020-11-03 15:00:22', '2020-01-30 01:15:43'),
('T4-C-MGN', 8, 5, 'Magnum', 1, '2020-11-03 15:28:44', '2020-01-11 01:12:17'),
('T4-F-ALCH', 8, 11, 'Alchemist', 2, '2020-11-03 15:20:34', '2020-11-16 00:49:14'),
('T4-F-DNDL', 8, 11, 'Dandelion', 2, '2020-11-03 15:15:32', '2020-01-17 01:13:58'),
('T4-R-EL', 8, 10, 'Eliot', 5, '2020-11-03 14:48:41', '2020-01-11 01:12:17'),
('T6-R-BC', 9, 10, 'Base Camp', 2, '2020-11-03 15:38:53', '2020-01-11 01:12:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_sewa`
--

CREATE TABLE `detail_sewa` (
  `detail_sewa_nosewa` varchar(30) NOT NULL,
  `detail_sewa_alat_kode` varchar(15) NOT NULL,
  `detail_sewa_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_sewa`
--

INSERT INTO `detail_sewa` (`detail_sewa_nosewa`, `detail_sewa_alat_kode`, `detail_sewa_total`, `created_at`, `updated_at`) VALUES
('INVC/II/20201106/193712', 'T2-R-QD', 1, '2020-11-06 12:37:12', '2020-11-06 12:37:12'),
('INVC/II/20201106/193712', 'H-TNF-S', 1, '2020-11-06 12:37:12', '2020-11-06 12:37:12'),
('INVC/II/20201106/193712', 'SB-MO-A', 1, '2020-11-06 12:37:12', '2020-11-06 12:37:12'),
('INVC/II/20201108/222227', 'T4-F-DNDL', 1, '2020-11-08 15:22:27', '2020-11-08 15:22:27'),
('INVC/II/20201108/222227', 'T4-F-ALCH', 1, '2020-11-08 15:22:27', '2020-11-08 15:22:27'),
('INVC/II/20201108/222227', 'HL-C-XG', 1, '2020-11-08 15:22:27', '2020-11-08 15:22:27'),
('INVC/II/20201111/111106', 'M-E-SP', 1, '2020-11-11 04:11:06', '2020-11-11 04:11:06'),
('INVC/II/20201111/111106', 'M-C-SP', 1, '2020-11-11 04:11:06', '2020-11-11 04:11:06'),
('INVC/II/20201113/222346', 'T4-F-ALCH', 1, '2020-11-13 15:23:47', '2020-11-13 15:23:47'),
('INVC/II/20201113/222346', 'T4-F-DNDL', 1, '2020-11-13 15:23:47', '2020-11-13 15:23:47'),
('INVC/II/20201113/222346', 'T4-C-MGN', 1, '2020-11-13 15:23:47', '2020-11-13 15:23:47'),
('INVC/II/20201113/222346', 'M-C-SP', 5, '2020-11-13 15:23:47', '2020-11-13 15:23:47'),
('INVC/II/20201113/222346', 'K-M-KP', 1, '2020-11-13 15:23:47', '2020-11-13 15:23:47'),
('INVC/II/20201113/222346', 'S-S-D', 1, '2020-11-13 15:23:47', '2020-11-13 15:23:47'),
('INVC/II/20201115/024716', 'C80-C-G', 1, '2020-11-14 19:47:16', '2020-11-14 19:47:16'),
('INVC/II/20201115/024716', 'H-TNF-S', 1, '2020-11-14 19:47:16', '2020-11-14 19:47:16'),
('INVC/II/20201115/024716', 'K-M-KP', 1, '2020-11-14 19:47:16', '2020-11-14 19:47:16'),
('INVC/II/20201115/024716', 'T2-C-ST', 2, '2020-11-14 19:47:16', '2020-11-14 19:47:16'),
('INVC/II/20200101/075256', 'HL-E-AP', 1, '2020-01-01 00:52:57', '2020-01-01 00:52:57'),
('INVC/II/20200101/075256', 'C60-C-B', 2, '2020-01-01 00:52:57', '2020-01-01 00:52:57'),
('INVC/II/20200101/075256', 'F-C-WP', 1, '2020-01-01 00:52:57', '2020-01-01 00:52:57'),
('INVC/II/20200101/075256', 'K-M-KP', 3, '2020-01-01 00:52:57', '2020-01-01 00:52:57'),
('INVC/II/20200101/075256', 'M-C-SP', 2, '2020-01-01 00:52:57', '2020-01-01 00:52:57'),
('INVC/II/20200101/075256', 'SB-MO-A', 1, '2020-01-01 00:52:57', '2020-01-01 00:52:57'),
('INVC/II/20200101/075715', 'T2-TNF-ET', 1, '2020-01-01 00:57:15', '2020-01-01 00:57:15'),
('INVC/II/20200101/075715', 'T2-R-QD', 2, '2020-01-01 00:57:15', '2020-01-01 00:57:15'),
('INVC/II/20200101/075715', 'T4-F-DNDL', 1, '2020-01-01 00:57:15', '2020-01-01 00:57:15'),
('INVC/II/20200106/080321', 'T6-R-BC', 1, '2020-01-06 01:03:22', '2020-01-06 01:03:22'),
('INVC/II/20200106/080321', 'T4-R-EL', 1, '2020-01-06 01:03:22', '2020-01-06 01:03:22'),
('INVC/II/20200106/080321', 'T4-C-MGN', 1, '2020-01-06 01:03:22', '2020-01-06 01:03:22'),
('INVC/II/20200106/080321', 'T4-C-KHT', 1, '2020-01-06 01:03:22', '2020-01-06 01:03:22'),
('INVC/II/20200106/080923', 'N-M-SP', 1, '2020-01-06 01:09:23', '2020-01-06 01:09:23'),
('INVC/II/20200106/080923', 'T2-C-ST', 1, '2020-01-06 01:09:23', '2020-01-06 01:09:23'),
('INVC/II/20200106/080923', 'T4-C-KHT', 1, '2020-01-06 01:09:23', '2020-01-06 01:09:23'),
('INVC/II/20201116/154547', 'C80-C-G', 1, '2020-11-16 08:45:47', '2020-11-16 08:45:47'),
('INVC/II/20201117/023500', 'C80-R-L', 1, '2020-11-16 19:35:00', '2020-11-16 19:35:00'),
('INVC/II/20201117/023500', 'HL-E-AP', 1, '2020-11-16 19:35:01', '2020-11-16 19:35:01'),
('INVC/II/20201117/023500', 'M-E-SP', 1, '2020-11-16 19:35:01', '2020-11-16 19:35:01'),
('INVC/II/20201118/170912', 'C80-C-G', 1, '2020-11-18 10:09:12', '2020-11-18 10:09:12'),
('INVC/II/20201118/170912', 'C80-R-L', 1, '2020-11-18 10:09:13', '2020-11-18 10:09:13'),
('INVC/II/20201118/170912', 'HL-E-AP', 1, '2020-11-18 10:09:13', '2020-11-18 10:09:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_alat`
--

CREATE TABLE `gambar_alat` (
  `gambar_id` int(11) NOT NULL,
  `gambar_kodealat` varchar(10) NOT NULL,
  `gambar_file` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gambar_alat`
--

INSERT INTO `gambar_alat` (`gambar_id`, `gambar_kodealat`, `gambar_file`, `created_at`, `updated_at`) VALUES
(34, 'T2-R-QD', 'T2-R-QD0BC1S.jpg', '2020-11-02 19:47:07', '2020-11-02 19:47:07'),
(35, 'T2-TNF-ET', 'T2-TNF-ETeE2Eg.jpg', '2020-11-02 19:51:12', '2020-11-02 19:51:12'),
(36, 'T2-R-QD', 'T2-R-QDzjX4C.jpg', '2020-11-03 07:03:34', '2020-11-03 07:03:34'),
(37, 'T2-R-QD', 'T2-R-QDRu7Gm.jpg', '2020-11-03 07:03:35', '2020-11-03 07:03:35'),
(38, 'T2-R-GB', 'T2-R-GBDz1FT.jpg', '2020-11-03 14:40:02', '2020-11-03 14:40:02'),
(39, 'T2-C-ST', 'T2-C-STdgUmP.jpg', '2020-11-03 14:43:40', '2020-11-03 14:43:40'),
(40, 'T4-R-EL', 'T4-R-ELaR3no.jpg', '2020-11-03 14:48:41', '2020-11-03 14:48:41'),
(41, 'T4-R-EL', 'T4-R-ELkPJcS.jpg', '2020-11-03 14:48:42', '2020-11-03 14:48:42'),
(42, 'T4-R-EL', 'T4-R-ELFkjPQ.jpg', '2020-11-03 14:48:42', '2020-11-03 14:48:42'),
(43, 'T4-R-EL', 'T4-R-EL7LH0H.jpg', '2020-11-03 14:48:42', '2020-11-03 14:48:42'),
(45, 'T4-C-KHT', 'T4-C-KHTYkEKb.jpg', '2020-11-03 15:00:22', '2020-11-03 15:00:22'),
(46, 'T4-C-KHT', 'T4-C-KHTeCMip.jpg', '2020-11-03 15:00:22', '2020-11-03 15:00:22'),
(47, 'T4-C-KHT', 'T4-C-KHTAkAtq.jpg', '2020-11-03 15:01:00', '2020-11-03 15:01:00'),
(48, 'T4-F-DNDL', 'T4-F-DNDLuJOA6.jpg', '2020-11-03 15:15:32', '2020-11-03 15:15:32'),
(49, 'T4-F-DNDL', 'T4-F-DNDLXYZCV.jpg', '2020-11-03 15:15:32', '2020-11-03 15:15:32'),
(50, 'T4-F-ALCH', 'T4-F-ALCH02H2C.jpg', '2020-11-03 15:20:34', '2020-11-03 15:20:34'),
(51, 'T4-F-ALCH', 'T4-F-ALCHWxLMc.jpg', '2020-11-03 15:20:35', '2020-11-03 15:20:35'),
(52, 'T4-C-MGN', 'T4-C-MGNzTG6D.jpg', '2020-11-03 15:28:44', '2020-11-03 15:28:44'),
(53, 'T6-R-BC', 'T6-R-BCeeygI.jpg', '2020-11-03 15:38:53', '2020-11-03 15:38:53'),
(54, 'T6-R-BC', 'T6-R-BCQOVLn.jpg', '2020-11-03 15:38:53', '2020-11-03 15:38:53'),
(55, 'M-C-SP', 'M-C-SPBFeYC.jpg', '2020-11-03 15:48:51', '2020-11-03 15:48:51'),
(56, 'M-E-SP', 'M-E-SPqn95T.jpg', '2020-11-03 15:49:18', '2020-11-03 15:49:18'),
(57, 'HL-E-AP', 'HL-E-APnTC7f.jpg', '2020-11-03 15:55:55', '2020-11-03 15:55:55'),
(58, 'HL-E-AP', 'HL-E-APwpqFf.jpg', '2020-11-03 15:55:55', '2020-11-03 15:55:55'),
(59, 'HL-E-AP', 'HL-E-APDQjGI.jpg', '2020-11-03 15:55:55', '2020-11-03 15:55:55'),
(60, 'HL-C-XG', 'HL-C-XG76ZV6.jpg', '2020-11-03 15:59:22', '2020-11-03 15:59:22'),
(61, 'K-M-KP', 'K-M-KPkMcbh.jpg', '2020-11-03 16:05:48', '2020-11-03 16:05:48'),
(62, 'K-M-KP', 'K-M-KPX6WSV.jpg', '2020-11-03 16:05:48', '2020-11-03 16:05:48'),
(63, 'K-M-KP', 'K-M-KPG7TOv.jpg', '2020-11-03 16:05:48', '2020-11-03 16:05:48'),
(64, 'N-M-SP', 'N-M-SPtL158.jpg', '2020-11-03 16:16:00', '2020-11-03 16:16:00'),
(65, 'N-M-SP', 'N-M-SP5R7FL.jpg', '2020-11-03 16:16:00', '2020-11-03 16:16:00'),
(66, 'SB-MO-A', 'SB-MO-AM3eBs.jpg', '2020-11-03 16:28:17', '2020-11-03 16:28:17'),
(67, 'SB-TNF-P', 'SB-TNF-P7cKVa.jpg', '2020-11-03 16:28:51', '2020-11-03 16:28:51'),
(68, 'SB-TNF-P', 'SB-TNF-PDgsgt.jpg', '2020-11-03 16:28:51', '2020-11-03 16:28:51'),
(69, 'F-C-WP', 'F-C-WP7Gh0m.jpg', '2020-11-03 16:39:31', '2020-11-03 16:39:31'),
(70, 'F-C-WP', 'F-C-WPv8JPp.jpg', '2020-11-03 16:39:31', '2020-11-03 16:39:31'),
(71, 'C80-C-G', 'C80-C-Guh6BE.jpg', '2020-11-03 16:51:20', '2020-11-03 16:51:20'),
(72, 'C80-C-G', 'C80-C-GGUGer.jpg', '2020-11-03 16:51:20', '2020-11-03 16:51:20'),
(73, 'C80-R-L', 'C80-R-LsO3y2.jpg', '2020-11-03 16:52:32', '2020-11-03 16:52:32'),
(74, 'C80-R-L', 'C80-R-Lpoeak.jpg', '2020-11-03 16:52:32', '2020-11-03 16:52:32'),
(75, 'C60-E-Rh', 'C60-E-RhJtZQK.jpg', '2020-11-03 16:59:52', '2020-11-03 16:59:52'),
(76, 'C60-E-Rh', 'C60-E-Rhk2SDp.jpg', '2020-11-03 16:59:53', '2020-11-03 16:59:53'),
(77, 'C60-E-Rh', 'C60-E-RhY1CFm.jpg', '2020-11-03 16:59:53', '2020-11-03 16:59:53'),
(78, 'C60-C-B', 'C60-C-BSz0jg.jpg', '2020-11-03 17:00:26', '2020-11-03 17:00:26'),
(79, 'H-TNF-S', 'H-TNF-SpFUF4.jpg', '2020-11-03 17:08:28', '2020-11-03 17:08:28'),
(80, 'S-S-D', 'S-S-DkKVN8.jpg', '2020-11-03 17:15:55', '2020-11-03 17:15:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_alat`
--

CREATE TABLE `jenis_alat` (
  `jenis_alat_id` int(11) NOT NULL,
  `jenis_alat_nama` varchar(15) NOT NULL,
  `jenis_alat_harga` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_alat`
--

INSERT INTO `jenis_alat` (`jenis_alat_id`, `jenis_alat_nama`, `jenis_alat_harga`, `created_at`, `updated_at`) VALUES
(7, 'Tenda Isi 2', 30000, '2020-11-02 18:20:13', '2020-11-02 18:20:13'),
(8, 'Tenda Isi 4', 35000, '2020-11-02 18:20:30', '2020-11-02 18:20:30'),
(9, 'Tenda Isi 6', 40000, '2020-11-02 18:20:42', '2020-11-02 18:20:42'),
(11, 'Matras', 5000, '2020-11-02 18:21:38', '2020-11-02 18:21:38'),
(12, 'HeadLamp', 5000, '2020-11-02 18:22:09', '2020-11-02 18:22:09'),
(13, 'Kompor', 15000, '2020-11-02 18:22:26', '2020-11-02 18:22:26'),
(14, 'Nesting', 15000, '2020-11-02 18:22:35', '2020-11-02 18:22:35'),
(15, 'Sleeping Bag', 15000, '2020-11-02 18:23:47', '2020-11-02 18:23:47'),
(16, 'Fly Sheet', 15000, '2020-11-02 18:24:10', '2020-11-02 18:24:10'),
(17, 'Hammock', 15000, '2020-11-02 18:24:22', '2020-11-02 18:24:22'),
(18, 'Snorkel', 15000, '2020-11-02 18:24:41', '2020-11-02 18:24:41'),
(19, 'Carrier 60 L', 30000, '2020-11-02 18:25:37', '2020-11-02 18:25:37'),
(20, 'Carrier 80 L', 30000, '2020-11-02 18:25:53', '2020-11-02 18:25:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_alat`
--

CREATE TABLE `kondisi_alat` (
  `kondisi_id` int(11) NOT NULL,
  `kondisi_keterangan` varchar(100) NOT NULL,
  `kondisi_dendarusak` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kondisi_alat`
--

INSERT INTO `kondisi_alat` (`kondisi_id`, `kondisi_keterangan`, `kondisi_dendarusak`, `created_at`, `updated_at`) VALUES
(2, 'Good', 0, '2020-09-02 17:32:37', '2020-09-09 16:08:38'),
(3, 'Frame Tenda Patah /  Pecah', 20000, '2020-09-09 16:26:00', '2020-09-09 16:26:00'),
(4, 'Pasak Hilang', 5000, '2020-09-09 16:26:42', '2020-09-09 16:26:42'),
(5, 'Tenda Bolong', 35000, '2020-09-09 16:28:26', '2020-09-09 16:28:26'),
(6, 'Tenda Sobek (per 5 cm)', 25000, '2020-09-09 16:30:19', '2020-09-09 16:30:19'),
(7, 'Carrier Sobek', 50000, '2020-09-09 16:30:50', '2020-09-09 16:34:30'),
(8, 'Sleeping Bag berlubang', 20000, '2020-09-09 16:32:19', '2020-09-09 16:32:19'),
(9, 'Sleeping bag sobek (per 5 cm)', 20000, '2020-09-09 16:33:57', '2020-09-09 16:33:57'),
(10, 'Flyng Sheet Berlobang', 40000, '2020-09-09 16:36:27', '2020-09-09 16:37:04'),
(11, 'Flying Sheet Robek', 50000, '2020-09-09 16:36:46', '2020-09-09 16:36:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk`
--

CREATE TABLE `merk` (
  `merk_id` int(11) NOT NULL,
  `merk_nama` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`merk_id`, `merk_nama`, `created_at`, `updated_at`) VALUES
(3, 'Eiger', '2020-08-30 15:54:15', '2020-08-30 15:54:15'),
(4, 'Tracker', '2020-08-30 16:16:29', '2020-08-30 16:16:29'),
(5, 'Consina', '2020-08-31 18:04:53', '2020-08-31 18:04:53'),
(9, 'The North Face', '2020-09-09 13:49:08', '2020-09-09 13:49:08'),
(10, 'Rei Co-op', '2020-11-02 18:27:41', '2020-11-03 15:33:37'),
(11, 'Foreister', '2020-11-03 15:15:32', '2020-11-03 15:15:32'),
(12, 'Matogui', '2020-11-03 16:05:47', '2020-11-03 16:05:47'),
(13, 'Makalu Outdoor', '2020-11-03 16:28:17', '2020-11-03 16:28:17'),
(14, 'Speeds', '2020-11-03 17:15:54', '2020-11-03 17:15:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `pengembalian_nosewa` varchar(30) NOT NULL,
  `pengembalian_kodealat` varchar(15) NOT NULL,
  `pengembalian_kondisi` int(11) NOT NULL,
  `pengembalian_totalrusak` int(11) NOT NULL,
  `pengembalian_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`pengembalian_nosewa`, `pengembalian_kodealat`, `pengembalian_kondisi`, `pengembalian_totalrusak`, `pengembalian_waktu`, `created_at`, `updated_at`) VALUES
('INVC/II/20201106/193712', 'T2-R-QD', 2, 1, '2020-11-06 13:01:07', '2020-11-06 13:01:07', '2020-11-06 13:01:07'),
('INVC/II/20201106/193712', 'H-TNF-S', 6, 1, '2020-11-06 13:01:07', '2020-11-06 13:01:07', '2020-11-06 13:01:07'),
('INVC/II/20201106/193712', 'H-TNF-S', 3, 2, '2020-11-06 13:01:07', '2020-11-06 13:01:07', '2020-11-06 13:01:07'),
('INVC/II/20201106/193712', 'SB-MO-A', 6, 2, '2020-11-06 13:01:07', '2020-11-06 13:01:07', '2020-11-06 13:01:07'),
('INVC/II/20201106/193712', 'SB-MO-A', 9, 1, '2020-11-06 13:01:07', '2020-11-06 13:01:07', '2020-11-06 13:01:07'),
('INVC/II/20201108/222227', 'T4-F-DNDL', 2, 1, '2020-11-14 19:09:30', '2020-11-14 19:09:30', '2020-11-14 19:09:30'),
('INVC/II/20201108/222227', 'T4-F-ALCH', 6, 2, '2020-11-14 19:09:30', '2020-11-14 19:09:30', '2020-11-14 19:09:30'),
('INVC/II/20201108/222227', 'HL-C-XG', 6, 1, '2020-11-14 19:09:30', '2020-11-14 19:09:30', '2020-11-14 19:09:30'),
('INVC/II/20201108/222227', 'HL-C-XG', 9, 1, '2020-11-14 19:09:30', '2020-11-14 19:09:30', '2020-11-14 19:09:30'),
('INVC/II/20201108/222227', 'HL-C-XG', 8, 2, '2020-11-14 19:09:30', '2020-11-14 19:09:30', '2020-11-14 19:09:30'),
('INVC/II/20200101/075256', 'HL-E-AP', 2, 1, '2020-01-06 01:06:02', '2020-01-06 01:06:02', '2020-01-06 01:06:02'),
('INVC/II/20200101/075256', 'C60-C-B', 2, 2, '2020-01-06 01:06:02', '2020-01-06 01:06:02', '2020-01-06 01:06:02'),
('INVC/II/20200101/075256', 'F-C-WP', 2, 1, '2020-01-06 01:06:02', '2020-01-06 01:06:02', '2020-01-06 01:06:02'),
('INVC/II/20200101/075256', 'K-M-KP', 2, 3, '2020-01-06 01:06:02', '2020-01-06 01:06:02', '2020-01-06 01:06:02'),
('INVC/II/20200101/075256', 'M-C-SP', 5, 2, '2020-01-06 01:06:02', '2020-01-06 01:06:02', '2020-01-06 01:06:02'),
('INVC/II/20200101/075256', 'SB-MO-A', 3, 1, '2020-01-06 01:06:02', '2020-01-06 01:06:02', '2020-01-06 01:06:02'),
('INVC/II/20200101/075256', 'SB-MO-A', 9, 1, '2020-01-06 01:06:02', '2020-01-06 01:06:02', '2020-01-06 01:06:02'),
('INVC/II/20200101/075256', 'SB-MO-A', 8, 3, '2020-01-06 01:06:02', '2020-01-06 01:06:02', '2020-01-06 01:06:02'),
('INVC/II/20200106/080321', 'T6-R-BC', 3, 2, '2020-01-11 01:12:01', '2020-01-11 01:12:01', '2020-01-11 01:12:01'),
('INVC/II/20200106/080321', 'T6-R-BC', 5, 1, '2020-01-11 01:12:01', '2020-01-11 01:12:01', '2020-01-11 01:12:01'),
('INVC/II/20200106/080321', 'T4-R-EL', 2, 1, '2020-01-11 01:12:01', '2020-01-11 01:12:01', '2020-01-11 01:12:01'),
('INVC/II/20200106/080321', 'T4-C-MGN', 2, 1, '2020-01-11 01:12:01', '2020-01-11 01:12:01', '2020-01-11 01:12:01'),
('INVC/II/20200106/080321', 'T4-C-KHT', 5, 2, '2020-01-11 01:12:01', '2020-01-11 01:12:01', '2020-01-11 01:12:01'),
('INVC/II/20200106/080321', 'T4-C-KHT', 6, 1, '2020-01-11 01:12:01', '2020-01-11 01:12:01', '2020-01-11 01:12:01'),
('INVC/II/20200101/075715', 'T2-TNF-ET', 2, 1, '2020-01-17 01:13:55', '2020-01-17 01:13:55', '2020-01-17 01:13:55'),
('INVC/II/20200101/075715', 'T2-R-QD', 2, 2, '2020-01-17 01:13:55', '2020-01-17 01:13:55', '2020-01-17 01:13:55'),
('INVC/II/20200101/075715', 'T4-F-DNDL', 2, 1, '2020-01-17 01:13:55', '2020-01-17 01:13:55', '2020-01-17 01:13:55'),
('INVC/II/20200106/080923', 'N-M-SP', 2, 1, '2020-01-30 01:15:41', '2020-01-30 01:15:41', '2020-01-30 01:15:41'),
('INVC/II/20200106/080923', 'T2-C-ST', 2, 1, '2020-01-30 01:15:41', '2020-01-30 01:15:41', '2020-01-30 01:15:41'),
('INVC/II/20200106/080923', 'T4-C-KHT', 2, 1, '2020-01-30 01:15:41', '2020-01-30 01:15:41', '2020-01-30 01:15:41'),
('INVC/II/20201118/170912', 'C80-C-G', 2, 1, '2020-11-18 10:17:37', '2020-11-18 10:17:37', '2020-11-18 10:17:37'),
('INVC/II/20201118/170912', 'C80-R-L', 3, 1, '2020-11-18 10:17:37', '2020-11-18 10:17:37', '2020-11-18 10:17:37'),
('INVC/II/20201118/170912', 'C80-R-L', 9, 2, '2020-11-18 10:17:37', '2020-11-18 10:17:37', '2020-11-18 10:17:37'),
('INVC/II/20201118/170912', 'HL-E-AP', 7, 1, '2020-11-18 10:17:37', '2020-11-18 10:17:37', '2020-11-18 10:17:37'),
('INVC/II/20201118/170912', 'HL-E-AP', 5, 2, '2020-11-18 10:17:37', '2020-11-18 10:17:37', '2020-11-18 10:17:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `sewa_no` varchar(30) NOT NULL,
  `sewa_status` int(11) NOT NULL,
  `sewa_user` varchar(25) DEFAULT NULL,
  `sewa_tglsewa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sewa_tglbayar` timestamp NULL DEFAULT NULL,
  `sewa_tglkembali` date DEFAULT NULL,
  `sewa_tujuan` varchar(100) NOT NULL,
  `sewa_buktitf` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penyewaan`
--

INSERT INTO `penyewaan` (`sewa_no`, `sewa_status`, `sewa_user`, `sewa_tglsewa`, `sewa_tglbayar`, `sewa_tglkembali`, `sewa_tujuan`, `sewa_buktitf`, `created_at`, `updated_at`) VALUES
('INVC/II/20200101/075256', 6, 'M-201001151343', '2020-01-02 17:00:00', '2020-01-01 00:52:56', '2020-01-06', 'Pulau Sikuai', 'Burhan_01-01-20.jpg', '2020-01-01 00:52:56', '2020-01-06 01:06:10'),
('INVC/II/20200101/075715', 6, 'M-200101075542', '2020-01-14 17:00:00', '2020-01-01 00:57:15', '2020-01-17', 'Gunung Singgalang', 'Ariana_01-01-20.jpg', '2020-01-01 00:57:15', '2020-01-17 01:13:58'),
('INVC/II/20200106/080321', 6, 'M-200930003429', '2020-01-07 17:00:00', '2020-01-06 01:03:21', '2020-01-11', 'Pulau Pamutusan', 'Member_1_06-01-20.jpg', '2020-01-06 01:03:21', '2020-01-11 01:12:17'),
('INVC/II/20200106/080923', 6, 'M-201007162949', '2020-01-29 17:00:00', '2020-01-06 01:09:23', '2020-01-31', 'Gunung Merapi', 'Rialga88rising_06-01-20.jpg', '2020-01-06 01:09:23', '2020-01-30 01:15:43'),
('INVC/II/20201106/193712', 6, 'M-200930003429', '2020-11-08 17:00:00', '2020-11-06 12:37:12', '2020-11-10', 'talua sikuo', 'Member_1_06-11-20.jpg', '2020-11-06 12:37:12', '2020-11-06 13:01:18'),
('INVC/II/20201108/222227', 6, 'M-200930003429', '2020-11-09 17:00:00', '2020-11-08 15:22:27', '2020-11-11', 'Gunung Singgalang', 'Member_1_11-11-20.jpg', '2020-11-08 15:22:27', '2020-11-16 00:49:14'),
('INVC/II/20201111/111106', 1, 'M-200930003429', '2020-11-11 17:00:00', '2020-11-11 04:11:06', '2020-11-13', '12222', 'belum bayar', '2020-11-11 04:11:06', '2020-11-11 04:11:06'),
('INVC/II/20201113/222346', 3, 'M-200930003429', '2020-11-17 17:00:00', '2020-11-13 15:23:46', '2020-11-20', 'Pulau Pamutusan', 'Member_1_13-11-20.jpg', '2020-11-13 15:23:46', '2020-11-13 15:25:09'),
('INVC/II/20201115/024716', 7, 'M-200930003429', '2020-11-14 17:00:00', '2020-11-14 19:47:16', '2020-11-16', 'luar negri', 'Member_1_15-11-20.jpg', '2020-11-14 19:47:16', '2020-11-14 19:57:28'),
('INVC/II/20201116/154547', 7, 'M-200930003429', '2020-11-17 17:00:00', '2020-11-16 08:45:47', '2020-11-20', 'tes', 'Member_1_16-11-20.jpg', '2020-11-16 08:45:47', '2020-11-16 08:46:43'),
('INVC/II/20201117/023500', 1, 'M-201007162949', '2020-11-18 17:00:00', '2020-11-16 19:35:00', '2020-11-21', 'Pantai', 'belum bayar', '2020-11-16 19:35:00', '2020-11-16 19:35:00'),
('INVC/II/20201118/170912', 6, 'M-200930003429', '2020-11-18 17:00:00', '2020-11-18 10:09:12', '2020-11-20', 'Gunung Singgalang', 'Member_1_18-11-20.jpg', '2020-11-18 10:09:12', '2020-11-18 10:19:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_nama` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role_nama`) VALUES
(1, 'Admin'),
(2, 'Petugas'),
(3, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_sewa`
--

CREATE TABLE `status_sewa` (
  `status_id` int(11) NOT NULL,
  `status_detail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_sewa`
--

INSERT INTO `status_sewa` (`status_id`, `status_detail`) VALUES
(0, 'Dibatalkan'),
(1, 'Checkout'),
(2, 'Menunggu Konfirmasi'),
(3, 'Pembayaran Terkonfirmasi'),
(4, 'Perlengkapan Siap Untuk Diambil'),
(5, 'Perlengkapan Telah Diambil'),
(6, 'Dikembalikan'),
(7, 'Ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` varchar(25) NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_nick` varchar(15) NOT NULL,
  `user_nama` varchar(30) NOT NULL,
  `user_mail` varchar(40) NOT NULL,
  `user_alamat` varchar(100) NOT NULL,
  `user_job` varchar(35) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_role`, `user_nick`, `user_nama`, `user_mail`, `user_alamat`, `user_job`, `user_phone`, `user_password`, `created_at`, `updated_at`) VALUES
('M-200101075542', 3, 'Ariana', 'Ariana Lestari', 'ariana@gmail.com', 'Pondok Padang ', 'Mahasiswa ISI', '08528301823', '$2y$10$UUx08StirKzfa2WiFwrONOgsQ3A4hCw56392yLGw0bIBxlaw58rIG', '2020-01-01 00:55:42', '2020-01-01 00:55:42'),
('M-200930002649', 1, 'Rialga', 'Muhamad Febri ALgani', 'febrialgani@gmail.com', 'Aspol Alai Blok D no 10 Padang', 'Mahasiswa', '0895374556747', '$2y$10$9RFEyRno9M1PhV2mewDR1.Rrd7fg1iQItNfiB5OrncQyYSllA7qzu', '2020-09-29 17:26:49', '2020-10-26 17:18:57'),
('M-200930003155', 2, 'NonAdmin', 'Harry Cane Di Ascaban', 'rialgane@gmail.com', 'Jawabnya ada di ujung langit padang', 'Pegawai Sumbar Mountain Adventure', '085374556740', '$2y$10$zMKYfD4OsLz2tawDa/djYO95p5cDYsquoC3GX64/3KrG9h1xWuxIG', '2020-09-29 17:31:55', '2020-09-29 17:43:50'),
('M-200930003429', 3, 'Member_1', 'ReMember 1', 'febrialganios@gmail.com', 'di rumah dari selatan', 'Karyawan BUMN', '08168238', '$2y$10$edYTM./GaV8uim6T/4fgMeZgZWEZatcf1dJ1pgzdwuEjbU2zp3T8u', '2020-09-29 17:34:30', '2020-10-02 10:54:28'),
('M-201001151343', 3, 'Burhan', 'Burhan narkoboy', 'b@a.com', 'olo Padang', 'Mahasiswa UPI', '1412512', '$2y$10$yAvvcmTquzVXHDgmiBVaW.xs5YVh3McKARyi.6BZ0hB5i0P8XQiLq', '2020-10-01 08:13:43', '2020-10-01 08:13:43'),
('M-201007162949', 3, 'Rialga88rising', 'Joji Kusuma', '2@2.com', 'Asrama 88 rising', 'densus 88 rising', '085374556747', '$2y$10$cu4vVXWn85L/EP41AtojQeUgeqyLI/qFqHWK/u2Zg4Soijfotazn2', '2020-10-07 09:29:49', '2020-10-07 09:29:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`alat_kode`),
  ADD KEY `alat_merk` (`alat_merk`),
  ADD KEY `alat_jenis` (`alat_jenis`);

--
-- Indeks untuk tabel `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD KEY `detail_sewa_nosewa` (`detail_sewa_nosewa`),
  ADD KEY `detail_sewa_alat_kode` (`detail_sewa_alat_kode`);

--
-- Indeks untuk tabel `gambar_alat`
--
ALTER TABLE `gambar_alat`
  ADD PRIMARY KEY (`gambar_id`),
  ADD KEY `gambar_kodealat` (`gambar_kodealat`);

--
-- Indeks untuk tabel `jenis_alat`
--
ALTER TABLE `jenis_alat`
  ADD PRIMARY KEY (`jenis_alat_id`);

--
-- Indeks untuk tabel `kondisi_alat`
--
ALTER TABLE `kondisi_alat`
  ADD PRIMARY KEY (`kondisi_id`);

--
-- Indeks untuk tabel `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`merk_id`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD KEY `pengembalian_nosewa` (`pengembalian_nosewa`),
  ADD KEY `pengembalian_kodealat` (`pengembalian_kodealat`),
  ADD KEY `pengembalian_kondisi` (`pengembalian_kondisi`);

--
-- Indeks untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`sewa_no`),
  ADD KEY `sewa_status` (`sewa_status`),
  ADD KEY `sewa_user` (`sewa_user`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `status_sewa`
--
ALTER TABLE `status_sewa`
  ADD PRIMARY KEY (`status_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_phone` (`user_phone`),
  ADD UNIQUE KEY `user_mail` (`user_mail`),
  ADD UNIQUE KEY `user_nick` (`user_nick`),
  ADD KEY `user_role` (`user_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gambar_alat`
--
ALTER TABLE `gambar_alat`
  MODIFY `gambar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `jenis_alat`
--
ALTER TABLE `jenis_alat`
  MODIFY `jenis_alat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kondisi_alat`
--
ALTER TABLE `kondisi_alat`
  MODIFY `kondisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `merk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `status_sewa`
--
ALTER TABLE `status_sewa`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `alat_ibfk_1` FOREIGN KEY (`alat_merk`) REFERENCES `merk` (`merk_id`),
  ADD CONSTRAINT `alat_ibfk_2` FOREIGN KEY (`alat_jenis`) REFERENCES `jenis_alat` (`jenis_alat_id`);

--
-- Ketidakleluasaan untuk tabel `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD CONSTRAINT `detail_sewa_ibfk_1` FOREIGN KEY (`detail_sewa_nosewa`) REFERENCES `penyewaan` (`sewa_no`),
  ADD CONSTRAINT `detail_sewa_ibfk_2` FOREIGN KEY (`detail_sewa_alat_kode`) REFERENCES `alat` (`alat_kode`);

--
-- Ketidakleluasaan untuk tabel `gambar_alat`
--
ALTER TABLE `gambar_alat`
  ADD CONSTRAINT `gambar_alat_ibfk_1` FOREIGN KEY (`gambar_kodealat`) REFERENCES `alat` (`alat_kode`);

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`pengembalian_nosewa`) REFERENCES `penyewaan` (`sewa_no`),
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`pengembalian_kodealat`) REFERENCES `alat` (`alat_kode`),
  ADD CONSTRAINT `pengembalian_ibfk_3` FOREIGN KEY (`pengembalian_kondisi`) REFERENCES `kondisi_alat` (`kondisi_id`);

--
-- Ketidakleluasaan untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_ibfk_2` FOREIGN KEY (`sewa_status`) REFERENCES `status_sewa` (`status_id`),
  ADD CONSTRAINT `penyewaan_ibfk_3` FOREIGN KEY (`sewa_user`) REFERENCES `user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
