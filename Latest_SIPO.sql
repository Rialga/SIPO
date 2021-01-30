-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2021 pada 18.42
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
-- Database: `sipo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `alat_kode` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alat_jenis` bigint(20) UNSIGNED NOT NULL,
  `alat_merk` bigint(20) UNSIGNED NOT NULL,
  `alat_tipe` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alat_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`alat_kode`, `alat_jenis`, `alat_merk`, `alat_tipe`, `alat_total`, `created_at`, `updated_at`) VALUES
('C60-C-B', 19, 5, 'Bering', 4, '2020-11-03 10:00:26', '2020-11-25 16:03:32'),
('C60-E-Rh', 19, 3, 'Rhinos', 3, '2020-11-03 09:59:52', '2020-11-26 10:05:54'),
('C80-C-G', 20, 5, 'Galapagos', 3, '2020-11-03 09:51:20', '2021-01-06 18:44:44'),
('C80-R-L', 20, 10, 'Lamandu', 4, '2020-11-03 09:52:32', '2021-01-07 00:28:29'),
('F-C-WP', 16, 5, 'WF-Sheet', 4, '2020-11-03 09:39:31', '2020-12-31 19:28:08'),
('H-TNF-S', 17, 9, 'singel UltraLight', 5, '2020-11-03 10:07:49', '2020-12-03 06:49:45'),
('HL-C-XG', 12, 5, 'XG-8511B', 2, '2020-11-03 08:59:22', '2020-12-13 15:29:21'),
('HL-E-AP', 12, 3, 'Axle Pro', 2, '2020-11-03 08:55:55', '2021-01-07 00:28:29'),
('K-M-KP', 13, 12, 'KP8302', 11, '2020-11-03 09:05:47', '2020-12-13 15:29:22'),
('M-C-SP', 11, 5, 'Spons', 21, '2020-11-03 08:48:51', '2021-01-07 07:06:02'),
('M-E-SP', 11, 3, 'Spons', 4, '2020-11-03 08:49:18', '2020-12-22 11:59:16'),
('N-M-SP', 14, 12, 'Saucepan', 5, '2020-11-03 09:16:00', '2020-12-08 19:51:11'),
('S-S-D', 18, 14, 'Dive MT', 6, '2020-11-03 10:15:54', '2021-01-07 00:30:49'),
('SB-MO-A', 15, 13, 'Alpsdream 400', 2, '2020-11-03 09:28:17', '2020-12-08 19:51:11'),
('SB-TNF-P', 15, 9, 'Polar', 3, '2020-11-03 09:28:51', '2020-11-03 09:28:51'),
('T2-C-ST', 7, 5, 'Summer Time', 2, '2020-11-03 07:43:40', '2020-12-08 19:51:11'),
('T2-R-GB', 7, 10, 'Ground Breaker', 1, '2020-11-03 07:40:02', '2020-12-03 18:50:03'),
('T2-R-QD', 7, 10, 'Quarter Dome SL', 1, '2020-11-02 12:47:07', '2021-01-07 07:06:02'),
('T4-F-ALCH', 8, 11, 'Alchemist', 2, '2020-11-03 08:20:34', '2020-11-15 17:49:14'),
('T4-F-DNDL', 8, 11, 'Dandelion', 2, '2020-11-03 08:15:32', '2020-01-16 18:13:58'),
('T4-R-EL', 8, 10, 'Eliot', 5, '2020-11-03 07:48:41', '2020-12-31 18:09:36'),
('T6-R-BC', 9, 10, 'Base Camp', 1, '2020-11-03 08:38:53', '2021-01-07 00:30:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_sewa`
--

CREATE TABLE `detail_sewa` (
  `detail_sewa_nosewa` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_sewa_alat_kode` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_alat` int(11) NOT NULL,
  `harga_sewa1` int(11) NOT NULL,
  `harga_sewa2` int(11) NOT NULL,
  `harga_sewa3` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_sewa`
--

INSERT INTO `detail_sewa` (`detail_sewa_nosewa`, `detail_sewa_alat_kode`, `total_alat`, `harga_sewa1`, `harga_sewa2`, `harga_sewa3`, `created_at`, `updated_at`) VALUES
('INVC/II/20201209/003930', 'K-M-KP', 1, 15000, 25000, 35000, '2020-12-08 17:39:31', '2020-12-08 17:39:31'),
('INVC/II/20201209/003930', 'M-E-SP', 3, 5000, 10000, 15000, '2020-12-08 17:39:31', '2020-12-08 17:39:31'),
('INVC/II/20201209/003930', 'N-M-SP', 1, 15000, 25000, 35000, '2020-12-08 17:39:31', '2020-12-08 17:39:31'),
('INVC/II/20201209/003930', 'SB-MO-A', 1, 15000, 25000, 35000, '2020-12-08 17:39:31', '2020-12-08 17:39:31'),
('INVC/II/20201209/003930', 'T2-C-ST', 1, 30000, 55000, 70000, '2020-12-08 17:39:31', '2020-12-08 17:39:31'),
('INVC/II/20201210/012124', 'F-C-WP', 1, 15000, 25000, 35000, '2020-12-09 18:21:24', '2020-12-09 18:21:24'),
('INVC/II/20201210/012124', 'HL-C-XG', 1, 5000, 10000, 15000, '2020-12-09 18:21:24', '2020-12-09 18:21:24'),
('INVC/II/20201210/012124', 'K-M-KP', 1, 15000, 25000, 35000, '2020-12-09 18:21:24', '2020-12-09 18:21:24'),
('INVC/II/20201213/222953', 'M-E-SP', 3, 5000, 10000, 15000, '2020-12-13 15:29:54', '2020-12-13 15:29:54'),
('INVC/II/20201222/185812', 'T4-R-EL', 1, 35000, 70000, 90000, '2020-12-22 11:58:12', '2020-12-22 11:58:12'),
('INVC/II/20201228/155831', 'C60-E-Rh', 1, 30000, 55000, 70000, '2020-12-28 08:58:31', '2020-12-28 08:58:31'),
('INVC/II/20201229/000703', 'C80-C-G', 1, 30000, 55000, 70000, '2020-12-28 17:07:03', '2020-12-28 17:07:03'),
('INVC/II/20201229/000703', 'C80-R-L', 1, 30000, 55000, 70000, '2020-12-28 17:07:03', '2020-12-28 17:07:03'),
('INVC/II/20210101/022720', 'F-C-WP', 2, 15000, 25000, 35000, '2020-12-31 19:27:20', '2020-12-31 19:27:20'),
('INVC/II/20210103/071015', 'C80-R-L', 1, 30000, 55000, 70000, '2021-01-03 00:10:15', '2021-01-03 00:10:15'),
('INVC/II/20210103/071015', 'HL-E-AP', 1, 5000, 10000, 15000, '2021-01-03 00:10:15', '2021-01-03 00:10:15'),
('INVC/II/20210106/211850', 'C80-C-G', 1, 30000, 55000, 70000, '2021-01-06 14:18:50', '2021-01-06 14:18:50'),
('INVC/II/20210106/215543', 'C80-C-G', 1, 30000, 55000, 70000, '2021-01-06 14:55:43', '2021-01-06 14:55:43'),
('INVC/II/20210106/215543', 'C80-R-L', 1, 30000, 55000, 70000, '2021-01-06 14:55:43', '2021-01-06 14:55:43'),
('INVC/II/20210107/020316', 'C80-R-L', 1, 30000, 55000, 70000, '2021-01-06 19:03:16', '2021-01-06 19:03:16'),
('INVC/II/20210107/020316', 'HL-E-AP', 2, 5000, 10000, 15000, '2021-01-06 19:03:16', '2021-01-06 19:03:16'),
('INVC/II/20210107/073016', 'S-S-D', 2, 15000, 30000, 40000, '2021-01-07 00:30:16', '2021-01-07 00:30:16'),
('INVC/II/20210107/073016', 'T6-R-BC', 1, 40000, 75000, 100000, '2021-01-07 00:30:16', '2021-01-07 00:30:16'),
('INVC/II/20210107/074000', 'M-C-SP', 2, 5000, 10000, 15000, '2021-01-07 00:40:00', '2021-01-07 00:40:00'),
('INVC/II/20210107/074000', 'M-E-SP', 1, 5000, 10000, 15000, '2021-01-07 00:40:00', '2021-01-07 00:40:00'),
('INVC/II/20210107/140450', 'M-C-SP', 2, 5000, 10000, 15000, '2021-01-07 07:04:50', '2021-01-07 07:04:50'),
('INVC/II/20210107/140450', 'T2-R-QD', 1, 30000, 55000, 70000, '2021-01-07 07:04:50', '2021-01-07 07:04:50'),
('INVC/II/20210107/144506', 'C80-C-G', 1, 30000, 55000, 70000, '2021-01-07 07:45:06', '2021-01-07 07:45:06'),
('INVC/II/20210107/145850', 'C80-C-G', 2, 30000, 55000, 70000, '2021-01-07 07:58:50', '2021-01-07 07:58:50'),
('INVC/II/20210107/150044', 'C80-C-G', 3, 30000, 55000, 70000, '2021-01-07 08:00:44', '2021-01-07 08:00:44'),
('INVC/II/20210107/150044', 'H-TNF-S', 1, 15000, 30000, 40000, '2021-01-07 08:00:44', '2021-01-07 08:00:44'),
('INVC/II/20210107/150346', 'C80-C-G', 3, 30000, 55000, 70000, '2021-01-07 08:03:46', '2021-01-07 08:03:46'),
('INVC/II/20210107/150346', 'H-TNF-S', 1, 15000, 30000, 40000, '2021-01-07 08:03:46', '2021-01-07 08:03:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_alat`
--

CREATE TABLE `gambar_alat` (
  `gambar_id` bigint(20) UNSIGNED NOT NULL,
  `gambar_kodealat` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_file` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gambar_alat`
--

INSERT INTO `gambar_alat` (`gambar_id`, `gambar_kodealat`, `gambar_file`, `created_at`, `updated_at`) VALUES
(34, 'T2-R-QD', 'T2-R-QD0BC1S.jpg', '2020-11-02 12:47:07', '2020-11-02 12:47:07'),
(36, 'T2-R-QD', 'T2-R-QDzjX4C.jpg', '2020-11-03 00:03:34', '2020-11-03 00:03:34'),
(37, 'T2-R-QD', 'T2-R-QDRu7Gm.jpg', '2020-11-03 00:03:35', '2020-11-03 00:03:35'),
(38, 'T2-R-GB', 'T2-R-GBDz1FT.jpg', '2020-11-03 07:40:02', '2020-11-03 07:40:02'),
(39, 'T2-C-ST', 'T2-C-STdgUmP.jpg', '2020-11-03 07:43:40', '2020-11-03 07:43:40'),
(40, 'T4-R-EL', 'T4-R-ELaR3no.jpg', '2020-11-03 07:48:41', '2020-11-03 07:48:41'),
(41, 'T4-R-EL', 'T4-R-ELkPJcS.jpg', '2020-11-03 07:48:42', '2020-11-03 07:48:42'),
(42, 'T4-R-EL', 'T4-R-ELFkjPQ.jpg', '2020-11-03 07:48:42', '2020-11-03 07:48:42'),
(43, 'T4-R-EL', 'T4-R-EL7LH0H.jpg', '2020-11-03 07:48:42', '2020-11-03 07:48:42'),
(48, 'T4-F-DNDL', 'T4-F-DNDLuJOA6.jpg', '2020-11-03 08:15:32', '2020-11-03 08:15:32'),
(49, 'T4-F-DNDL', 'T4-F-DNDLXYZCV.jpg', '2020-11-03 08:15:32', '2020-11-03 08:15:32'),
(50, 'T4-F-ALCH', 'T4-F-ALCH02H2C.jpg', '2020-11-03 08:20:34', '2020-11-03 08:20:34'),
(51, 'T4-F-ALCH', 'T4-F-ALCHWxLMc.jpg', '2020-11-03 08:20:35', '2020-11-03 08:20:35'),
(53, 'T6-R-BC', 'T6-R-BCeeygI.jpg', '2020-11-03 08:38:53', '2020-11-03 08:38:53'),
(54, 'T6-R-BC', 'T6-R-BCQOVLn.jpg', '2020-11-03 08:38:53', '2020-11-03 08:38:53'),
(55, 'M-C-SP', 'M-C-SPBFeYC.jpg', '2020-11-03 08:48:51', '2020-11-03 08:48:51'),
(56, 'M-E-SP', 'M-E-SPqn95T.jpg', '2020-11-03 08:49:18', '2020-11-03 08:49:18'),
(57, 'HL-E-AP', 'HL-E-APnTC7f.jpg', '2020-11-03 08:55:55', '2020-11-03 08:55:55'),
(58, 'HL-E-AP', 'HL-E-APwpqFf.jpg', '2020-11-03 08:55:55', '2020-11-03 08:55:55'),
(59, 'HL-E-AP', 'HL-E-APDQjGI.jpg', '2020-11-03 08:55:55', '2020-11-03 08:55:55'),
(60, 'HL-C-XG', 'HL-C-XG76ZV6.jpg', '2020-11-03 08:59:22', '2020-11-03 08:59:22'),
(61, 'K-M-KP', 'K-M-KPkMcbh.jpg', '2020-11-03 09:05:48', '2020-11-03 09:05:48'),
(62, 'K-M-KP', 'K-M-KPX6WSV.jpg', '2020-11-03 09:05:48', '2020-11-03 09:05:48'),
(63, 'K-M-KP', 'K-M-KPG7TOv.jpg', '2020-11-03 09:05:48', '2020-11-03 09:05:48'),
(64, 'N-M-SP', 'N-M-SPtL158.jpg', '2020-11-03 09:16:00', '2020-11-03 09:16:00'),
(65, 'N-M-SP', 'N-M-SP5R7FL.jpg', '2020-11-03 09:16:00', '2020-11-03 09:16:00'),
(66, 'SB-MO-A', 'SB-MO-AM3eBs.jpg', '2020-11-03 09:28:17', '2020-11-03 09:28:17'),
(67, 'SB-TNF-P', 'SB-TNF-P7cKVa.jpg', '2020-11-03 09:28:51', '2020-11-03 09:28:51'),
(68, 'SB-TNF-P', 'SB-TNF-PDgsgt.jpg', '2020-11-03 09:28:51', '2020-11-03 09:28:51'),
(69, 'F-C-WP', 'F-C-WP7Gh0m.jpg', '2020-11-03 09:39:31', '2020-11-03 09:39:31'),
(70, 'F-C-WP', 'F-C-WPv8JPp.jpg', '2020-11-03 09:39:31', '2020-11-03 09:39:31'),
(71, 'C80-C-G', 'C80-C-Guh6BE.jpg', '2020-11-03 09:51:20', '2020-11-03 09:51:20'),
(72, 'C80-C-G', 'C80-C-GGUGer.jpg', '2020-11-03 09:51:20', '2020-11-03 09:51:20'),
(73, 'C80-R-L', 'C80-R-LsO3y2.jpg', '2020-11-03 09:52:32', '2020-11-03 09:52:32'),
(74, 'C80-R-L', 'C80-R-Lpoeak.jpg', '2020-11-03 09:52:32', '2020-11-03 09:52:32'),
(75, 'C60-E-Rh', 'C60-E-RhJtZQK.jpg', '2020-11-03 09:59:52', '2020-11-03 09:59:52'),
(76, 'C60-E-Rh', 'C60-E-Rhk2SDp.jpg', '2020-11-03 09:59:53', '2020-11-03 09:59:53'),
(77, 'C60-E-Rh', 'C60-E-RhY1CFm.jpg', '2020-11-03 09:59:53', '2020-11-03 09:59:53'),
(78, 'C60-C-B', 'C60-C-BSz0jg.jpg', '2020-11-03 10:00:26', '2020-11-03 10:00:26'),
(79, 'H-TNF-S', 'H-TNF-SpFUF4.jpg', '2020-11-03 10:08:28', '2020-11-03 10:08:28'),
(80, 'S-S-D', 'S-S-DkKVN8.jpg', '2020-11-03 10:15:55', '2020-11-03 10:15:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_alat`
--

CREATE TABLE `jenis_alat` (
  `jenis_alat_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_alat_nama` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_alat_harga1` int(11) NOT NULL,
  `jenis_alat_harga2` int(11) NOT NULL,
  `jenis_alat_harga3` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_alat`
--

INSERT INTO `jenis_alat` (`jenis_alat_id`, `jenis_alat_nama`, `jenis_alat_harga1`, `jenis_alat_harga2`, `jenis_alat_harga3`, `created_at`, `updated_at`) VALUES
(7, 'Tenda Isi 2', 30000, 55000, 70000, '2020-11-02 11:20:13', '2020-12-08 14:24:31'),
(8, 'Tenda Isi 4', 35000, 70000, 90000, '2020-11-02 11:20:30', '2020-12-08 14:24:52'),
(9, 'Tenda Isi 6', 40000, 75000, 100000, '2020-11-02 11:20:42', '2020-12-08 14:57:14'),
(11, 'Matras', 5000, 10000, 15000, '2020-11-02 11:21:38', '2020-12-08 14:57:26'),
(12, 'HeadLamp', 5000, 10000, 15000, '2020-11-02 11:22:09', '2020-12-08 14:57:38'),
(13, 'Kompor', 15000, 25000, 35000, '2020-11-02 11:22:26', '2020-12-08 14:57:54'),
(14, 'Nesting', 15000, 25000, 35000, '2020-11-02 11:22:35', '2020-12-08 14:58:11'),
(15, 'Sleeping Bag', 15000, 25000, 35000, '2020-11-02 11:23:47', '2020-12-08 14:59:00'),
(16, 'Fly Sheet', 15000, 25000, 35000, '2020-11-02 11:24:10', '2020-12-08 14:59:21'),
(17, 'Hammock', 15000, 30000, 40000, '2020-11-02 11:24:22', '2020-12-08 14:59:40'),
(18, 'Snorkel', 15000, 30000, 40000, '2020-11-02 11:24:41', '2020-12-08 14:59:55'),
(19, 'Carrier 60 L', 30000, 55000, 70000, '2020-11-02 11:25:37', '2020-12-08 15:00:15'),
(20, 'Carrier 80 L', 30000, 55000, 70000, '2020-11-02 11:25:53', '2020-12-08 15:00:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_alat`
--

CREATE TABLE `kondisi_alat` (
  `kondisi_id` bigint(20) UNSIGNED NOT NULL,
  `kondisi_keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_dendarusak` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kondisi_alat`
--

INSERT INTO `kondisi_alat` (`kondisi_id`, `kondisi_keterangan`, `kondisi_dendarusak`, `created_at`, `updated_at`) VALUES
(1, 'good', 0, '2020-11-22 16:46:44', '2020-11-22 16:46:44'),
(2, 'Frame Patah', 50000, '2020-11-25 15:39:20', '2020-11-25 15:39:20'),
(3, 'Tali hilang', 2000, '2020-11-25 15:39:37', '2020-11-25 15:39:37'),
(5, 'Sobek', 25000, '2020-11-25 15:40:46', '2020-12-27 15:37:30'),
(6, 'Bolong', 30000, '2020-11-25 15:41:08', '2020-12-27 15:37:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk`
--

CREATE TABLE `merk` (
  `merk_id` bigint(20) UNSIGNED NOT NULL,
  `merk_nama` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`merk_id`, `merk_nama`, `created_at`, `updated_at`) VALUES
(3, 'Eiger', '2020-08-30 08:54:15', '2020-08-30 08:54:15'),
(4, 'Tracker', '2020-08-30 09:16:29', '2020-08-30 09:16:29'),
(5, 'Consina', '2020-08-31 11:04:53', '2020-08-31 11:04:53'),
(9, 'The North Face', '2020-09-09 06:49:08', '2020-09-09 06:49:08'),
(10, 'Rei Co-op', '2020-11-02 11:27:41', '2020-11-03 08:33:37'),
(11, 'Foreister', '2020-11-03 08:15:32', '2020-11-03 08:15:32'),
(12, 'Matogui', '2020-11-03 09:05:47', '2020-11-03 09:05:47'),
(13, 'Makalu Outdoor', '2020-11-03 09:28:17', '2020-11-03 09:28:17'),
(14, 'Speeds', '2020-11-03 10:15:54', '2020-11-03 10:15:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_11_21_130922_role', 1),
(2, '2020_11_21_131105_status_sewa', 1),
(3, '2020_11_21_131126_admin_rekening', 1),
(4, '2020_11_21_131154_kondisi_alat', 1),
(5, '2020_11_21_131311_jenis_alat', 1),
(6, '2020_11_21_131321_merk', 1),
(7, '2020_11_21_131342_alat', 1),
(8, '2020_11_21_131358_gambar_alat', 1),
(9, '2020_11_21_131414_user', 1),
(10, '2020_11_21_131426_penyewaan', 1),
(11, '2020_11_21_131439_detail_sewa', 1),
(12, '2020_11_21_131449_pengembalian', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `sewa_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alat_kode` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_id` bigint(20) UNSIGNED NOT NULL,
  `total_kerusakan` int(11) NOT NULL,
  `biaya_denda` int(11) NOT NULL,
  `pengembalian_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`sewa_no`, `alat_kode`, `kondisi_id`, `total_kerusakan`, `biaya_denda`, `pengembalian_waktu`, `created_at`, `updated_at`) VALUES
('INVC/II/20201209/003930', 'K-M-KP', 1, 1, 0, '2020-12-08 19:03:55', '2020-12-08 19:03:55', '2020-12-08 19:03:55'),
('INVC/II/20201209/003930', 'M-E-SP', 1, 1, 0, '2020-12-08 19:03:55', '2020-12-08 19:03:55', '2020-12-08 19:03:55'),
('INVC/II/20201209/003930', 'M-E-SP', 5, 4, 25000, '2020-12-08 19:03:55', '2020-12-08 19:03:55', '2020-12-08 19:03:55'),
('INVC/II/20201209/003930', 'N-M-SP', 1, 1, 0, '2020-12-08 19:03:55', '2020-12-08 19:03:55', '2020-12-08 19:03:55'),
('INVC/II/20201209/003930', 'SB-MO-A', 6, 4, 30000, '2020-12-08 19:03:56', '2020-12-08 19:03:56', '2020-12-08 19:03:56'),
('INVC/II/20201209/003930', 'T2-C-ST', 2, 3, 50000, '2020-12-08 19:03:56', '2020-12-08 19:03:56', '2020-12-08 19:03:56'),
('INVC/II/20201209/003930', 'T2-C-ST', 3, 2, 2000, '2020-12-08 19:03:56', '2020-12-08 19:03:56', '2020-12-08 19:03:56'),
('INVC/II/20201210/012124', 'F-C-WP', 3, 2, 2000, '2020-12-12 20:14:45', '2020-12-12 20:14:45', '2020-12-12 20:14:45'),
('INVC/II/20201210/012124', 'HL-C-XG', 1, 1, 0, '2020-12-12 20:14:46', '2020-12-12 20:14:46', '2020-12-12 20:14:46'),
('INVC/II/20201210/012124', 'HL-C-XG', 2, 2, 50000, '2020-12-12 20:14:45', '2020-12-12 20:14:45', '2020-12-12 20:14:45'),
('INVC/II/20201210/012124', 'K-M-KP', 3, 1, 2000, '2020-12-12 20:14:46', '2020-12-12 20:14:46', '2020-12-12 20:14:46'),
('INVC/II/20201213/222953', 'M-E-SP', 1, 1, 0, '2020-12-22 11:59:12', '2020-12-22 11:59:12', '2020-12-22 11:59:12'),
('INVC/II/20201222/185812', 'T4-R-EL', 1, 1, 0, '2020-12-31 18:09:33', '2020-12-31 18:09:33', '2020-12-31 18:09:33'),
('INVC/II/20201229/000703', 'C80-C-G', 1, 1, 0, '2020-12-28 18:23:06', '2020-12-28 18:23:06', '2020-12-28 18:23:06'),
('INVC/II/20201229/000703', 'C80-C-G', 2, 1, 50000, '2020-12-28 18:23:06', '2020-12-28 18:23:06', '2020-12-28 18:23:06'),
('INVC/II/20201229/000703', 'C80-R-L', 1, 1, 0, '2020-12-28 18:23:06', '2020-12-28 18:23:06', '2020-12-28 18:23:06'),
('INVC/II/20201229/000703', 'C80-R-L', 5, 1, 25000, '2020-12-28 18:23:06', '2020-12-28 18:23:06', '2020-12-28 18:23:06'),
('INVC/II/20210101/022720', 'F-C-WP', 1, 1, 0, '2020-12-31 19:28:05', '2020-12-31 19:28:05', '2020-12-31 19:28:05'),
('INVC/II/20210103/071015', 'C80-R-L', 1, 1, 0, '2021-01-06 14:27:22', '2021-01-06 14:27:22', '2021-01-06 14:27:22'),
('INVC/II/20210103/071015', 'HL-E-AP', 1, 1, 0, '2021-01-06 14:27:22', '2021-01-06 14:27:22', '2021-01-06 14:27:22'),
('INVC/II/20210106/211850', 'C80-C-G', 5, 1, 25000, '2021-01-06 18:20:47', '2021-01-06 18:20:47', '2021-01-06 18:20:47'),
('INVC/II/20210106/211850', 'C80-C-G', 6, 2, 30000, '2021-01-06 18:20:47', '2021-01-06 18:20:47', '2021-01-06 18:20:47'),
('INVC/II/20210106/215543', 'C80-C-G', 5, 1, 25000, '2021-01-06 18:15:45', '2021-01-06 18:15:45', '2021-01-06 18:15:45'),
('INVC/II/20210106/215543', 'C80-R-L', 1, 1, 0, '2021-01-06 18:15:45', '2021-01-06 18:15:45', '2021-01-06 18:15:45'),
('INVC/II/20210107/020316', 'C80-R-L', 5, 1, 25000, '2021-01-07 00:28:25', '2021-01-07 00:28:25', '2021-01-07 00:28:25'),
('INVC/II/20210107/020316', 'HL-E-AP', 1, 2, 0, '2021-01-07 00:28:25', '2021-01-07 00:28:25', '2021-01-07 00:28:25'),
('INVC/II/20210107/140450', 'M-C-SP', 5, 1, 25000, '2021-01-07 07:07:37', '2021-01-07 07:07:37', '2021-01-07 07:07:37'),
('INVC/II/20210107/140450', 'M-C-SP', 6, 1, 30000, '2021-01-07 07:07:37', '2021-01-07 07:07:37', '2021-01-07 07:07:37'),
('INVC/II/20210107/140450', 'T2-R-QD', 1, 1, 0, '2021-01-07 07:07:37', '2021-01-07 07:07:37', '2021-01-07 07:07:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `sewa_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sewa_status` int(11) NOT NULL,
  `sewa_user` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sewa_tglsewa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sewa_tglbayar` timestamp NULL DEFAULT NULL,
  `sewa_tglkembali` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sewa_tujuan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sewa_buktitf` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penyewaan`
--

INSERT INTO `penyewaan` (`sewa_no`, `sewa_status`, `sewa_user`, `sewa_tglsewa`, `sewa_tglbayar`, `sewa_tglkembali`, `sewa_tujuan`, `sewa_buktitf`, `created_at`, `updated_at`) VALUES
('INVC/II/20201209/003930', 6, 'M-201122105614', '2020-12-08 17:00:00', '2020-12-08 17:51:41', '2020-12-12 17:00:00', 'gunung Kerinci', 'febri_09-12-20.jpg', '2020-12-08 17:39:30', '2020-12-08 19:51:11'),
('INVC/II/20201210/012124', 6, 'M-201122105614', '2020-12-09 17:00:00', '2020-12-12 20:10:38', '2020-12-10 17:00:00', 'Pantai Tiram', 'febri_13-12-20Jm2.jpg', '2020-12-09 18:21:24', '2020-12-13 15:29:22'),
('INVC/II/20201213/222953', 6, 'M-201122105614', '2020-12-13 17:00:00', '2020-12-13 15:30:04', '2020-12-14 17:00:00', 'Gunung Singgalang', 'febri_13-12-20xKK.jpg', '2020-12-13 15:29:53', '2020-12-22 11:59:16'),
('INVC/II/20201222/185812', 6, 'M-201122105614', '2020-12-22 17:00:00', '2020-12-22 11:58:51', '2020-12-23 17:00:00', 'Pantai Carocok', 'febri_22-12-20DbC.jpg', '2020-12-22 11:58:12', '2020-12-31 18:09:36'),
('INVC/II/20201228/155831', 0, 'M-201122105614', '2020-12-28 17:00:00', NULL, '2020-12-29 17:00:00', 'Berkemha Di Gunung', 'belum bayar', '2020-12-28 08:58:31', '2020-12-28 17:06:32'),
('INVC/II/20201229/000703', 6, 'M-201122105614', '2020-12-29 17:00:00', '2020-12-28 17:07:13', '2020-12-30 17:00:00', 'Pantai', 'febri_29-12-20XFb.jpg', '2020-12-28 17:07:03', '2020-12-28 18:23:19'),
('INVC/II/20210101/022720', 6, 'M-201123225431', '2021-01-01 17:00:00', '2020-12-31 19:27:30', '2021-01-02 17:00:00', 'Gunung Singgalang', 'sewa2_01-01-21C91.jpg', '2020-12-31 19:27:20', '2020-12-31 19:28:09'),
('INVC/II/20210103/071015', 6, 'M-201122105614', '2021-01-04 17:00:00', '2021-01-04 00:10:25', '2021-01-05 17:00:00', 'Pinjam', 'febri_03-01-21Rle.jpg', '2021-01-03 00:10:15', '2021-01-06 14:27:26'),
('INVC/II/20210106/211850', 6, 'M-201122105614', '2021-01-04 17:00:00', '2021-01-01 18:17:39', '2021-01-06 17:00:00', 'Gunung Singgalang', 'febri_07-01-21gBi.jpg', '2021-01-01 14:18:50', '2021-01-06 18:21:01'),
('INVC/II/20210106/215543', 6, 'M-201122105614', '2021-01-05 17:00:00', '2021-01-06 14:56:01', '2021-01-06 17:00:00', 'Pulau sirandah', 'febri_06-01-218jI.jpg', '2021-01-06 14:55:43', '2021-01-06 18:15:58'),
('INVC/II/20210107/020316', 6, 'M-201122105614', '2021-01-05 17:00:00', '2021-01-01 19:03:27', '2021-01-06 17:00:00', 'gunung Tandikat', 'febri_07-01-21Nga.jpg', '2020-12-31 19:03:16', '2021-01-07 00:28:29'),
('INVC/II/20210107/073016', 5, 'M-201122105614', '2021-01-06 17:00:00', '2021-01-07 00:30:26', '2021-01-07 17:00:00', 'Pulau Sikuai', 'febri_07-01-21kUj.jpg', '2021-01-07 00:30:16', '2021-01-06 17:00:00'),
('INVC/II/20210107/074000', 3, 'M-201123225431', '2021-01-21 17:00:00', '2021-01-07 00:40:12', '2021-01-22 17:00:00', 'Pantai gondoria', 'sewa2_07-01-21SMy.jpg', '2021-01-07 00:40:00', '2021-01-07 00:40:26'),
('INVC/II/20210107/140450', 5, 'M-201122105614', '2021-01-04 17:00:00', '2021-01-07 07:05:21', '2021-01-05 17:00:00', 'Gunugn singgalang', 'febri_07-01-21Rzu.jpg', '2021-01-07 07:04:50', '2021-01-07 07:06:09'),
('INVC/II/20210107/144506', 1, 'M-201122105614', '2021-01-07 17:00:00', NULL, '2021-01-08 17:00:00', 'Pantai', 'belum bayar', '2021-01-07 07:45:06', '2021-01-07 07:45:06'),
('INVC/II/20210107/145850', 1, 'M-201122105614', '2021-01-07 17:00:00', NULL, '2021-01-09 17:00:00', 'Pantai', 'belum bayar', '2021-01-07 07:58:50', '2021-01-07 07:58:50'),
('INVC/II/20210107/150044', 2, 'M-201122105614', '2021-01-10 17:00:00', '2021-01-07 08:01:14', '2021-01-11 17:00:00', 'Gunung Singgalang', 'febri_07-01-21SLy.jpg', '2021-01-07 08:00:44', '2021-01-07 08:01:14'),
('INVC/II/20210107/150346', 2, 'M-201123225431', '2021-01-11 17:00:00', '2021-01-07 08:04:05', '2021-01-12 17:00:00', 'Pantai gondoria', 'sewa2_07-01-21YL1.jpg', '2021-01-07 08:03:46', '2021-01-07 08:04:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `rekening_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rekening_bank` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rekening_an` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`rekening_no`, `rekening_bank`, `rekening_an`, `created_at`, `updated_at`) VALUES
('123123123', 'Mandiri Syariah', 'Tn.Alexandra', '2020-11-23 10:39:49', '2020-11-23 10:39:49'),
('3809220', 'BNI', 'Sdr.Alexandra', '2020-11-23 10:35:15', '2020-11-23 10:35:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_nama` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role_nama`) VALUES
(1, 'Admin'),
(2, 'Petugas'),
(3, 'Penyewa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_sewa`
--

CREATE TABLE `status_sewa` (
  `status_id` int(11) NOT NULL,
  `status_detail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_sewa`
--

INSERT INTO `status_sewa` (`status_id`, `status_detail`) VALUES
(0, 'Dibatalkan'),
(1, 'Checkout'),
(2, 'Mengunggu Konfirmasi'),
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
  `user_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` bigint(20) UNSIGNED NOT NULL,
  `user_nick` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_mail` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_job` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_role`, `user_nick`, `user_nama`, `user_mail`, `user_alamat`, `user_job`, `user_phone`, `user_password`, `created_at`, `updated_at`) VALUES
('A-201121153229', 1, 'rialga', 'Muhamad Febri Algani', 'febrialgani@gmail.com', 'aspopl alai blok d no 10 padang', 'pengelola', '085374556745', '$2y$10$ep5zthD4CRfbVZ1K2TNqhOl8teDXCmZGYMsXAfPzzm1rNCm60H0R.', '2020-11-21 08:32:29', '2020-12-09 17:05:31'),
('M-201122105614', 3, 'febri', 'febri penyewas', 'febrialganios@gmail.com', 'Andalas Unevrsity Limau Manis', 'Mahasiswa di Unand', '085374556747', '$2y$10$w.8uLnNiXNObvUIQB08UOe9Icm7vhLHgr5lLb5WZBpNgcZlnJj60e', '2020-11-22 03:56:14', '2020-12-09 17:06:01'),
('M-201123225431', 3, 'sewa2', 'Vaselin Perodak', 'sewa@gmail.com', 'Jati Rimbo Kaluang', 'Sekolah', '085374556737', '$2y$10$YorDsc6ZE6TtjP.swpRKZuJAaWC/xalSNZPvr3mjtjLClBCyDJYuS', '2020-11-23 15:54:32', '2020-11-23 15:54:32'),
('M-201229001426', 3, 'tes', '123123', '2@2.com12', '123123', '33333', '123123123', '$2y$10$asYF7t5UgLec4bzdZZuyaeT67uFGfnP3hjflTt8Pi6ZCOvoxlGMSa', '2020-12-28 17:14:26', '2020-12-28 17:14:26'),
('P-201122213826', 2, 'minato', 'Minato MItsuha', 'petugas@gmail.com', 'jati baru padang utara', 'Petugas Sumbar Montain Advanture', '085374556711', '$2y$10$YN0Hl2kFHMrr7ASEbs5xpemBtbG.SuxIaJJe8opsAcTC/PsEXCz22', '2020-11-22 14:38:26', '2020-11-22 14:38:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`alat_kode`),
  ADD KEY `alat_alat_jenis_foreign` (`alat_jenis`),
  ADD KEY `alat_alat_merk_foreign` (`alat_merk`);

--
-- Indeks untuk tabel `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD PRIMARY KEY (`detail_sewa_nosewa`,`detail_sewa_alat_kode`),
  ADD KEY `detail_sewa_detail_sewa_alat_kode_foreign` (`detail_sewa_alat_kode`);

--
-- Indeks untuk tabel `gambar_alat`
--
ALTER TABLE `gambar_alat`
  ADD PRIMARY KEY (`gambar_id`),
  ADD KEY `gambar_alat_gambar_kodealat_foreign` (`gambar_kodealat`);

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
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`sewa_no`,`alat_kode`,`kondisi_id`),
  ADD KEY `pengembalian_alat_kode_foreign` (`alat_kode`),
  ADD KEY `pengembalian_kondisi_id_foreign` (`kondisi_id`);

--
-- Indeks untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`sewa_no`),
  ADD KEY `penyewaan_sewa_status_foreign` (`sewa_status`),
  ADD KEY `penyewaan_sewa_user_foreign` (`sewa_user`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`rekening_no`);

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
  ADD UNIQUE KEY `user_user_nick_unique` (`user_nick`),
  ADD UNIQUE KEY `user_user_mail_unique` (`user_mail`),
  ADD UNIQUE KEY `user_user_phone_unique` (`user_phone`),
  ADD KEY `user_user_role_foreign` (`user_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gambar_alat`
--
ALTER TABLE `gambar_alat`
  MODIFY `gambar_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `jenis_alat`
--
ALTER TABLE `jenis_alat`
  MODIFY `jenis_alat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kondisi_alat`
--
ALTER TABLE `kondisi_alat`
  MODIFY `kondisi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `merk_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `alat_alat_jenis_foreign` FOREIGN KEY (`alat_jenis`) REFERENCES `jenis_alat` (`jenis_alat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alat_alat_merk_foreign` FOREIGN KEY (`alat_merk`) REFERENCES `merk` (`merk_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD CONSTRAINT `detail_sewa_detail_sewa_alat_kode_foreign` FOREIGN KEY (`detail_sewa_alat_kode`) REFERENCES `alat` (`alat_kode`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_sewa_detail_sewa_no_sewa_foreign` FOREIGN KEY (`detail_sewa_nosewa`) REFERENCES `penyewaan` (`sewa_no`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gambar_alat`
--
ALTER TABLE `gambar_alat`
  ADD CONSTRAINT `gambar_alat_gambar_kodealat_foreign` FOREIGN KEY (`gambar_kodealat`) REFERENCES `alat` (`alat_kode`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_alat_kode_foreign` FOREIGN KEY (`alat_kode`) REFERENCES `alat` (`alat_kode`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengembalian_kondisi_id_foreign` FOREIGN KEY (`kondisi_id`) REFERENCES `kondisi_alat` (`kondisi_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengembalian_sewa_no_foreign` FOREIGN KEY (`sewa_no`) REFERENCES `penyewaan` (`sewa_no`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_sewa_status_foreign` FOREIGN KEY (`sewa_status`) REFERENCES `status_sewa` (`status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penyewaan_sewa_user_foreign` FOREIGN KEY (`sewa_user`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_user_role_foreign` FOREIGN KEY (`user_role`) REFERENCES `role` (`role_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
