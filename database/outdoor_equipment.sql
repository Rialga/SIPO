-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Sep 2020 pada 19.49
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
('Coin-120', 4, 3, 'Silverfang', 9, '2020-08-30 16:21:35', '2020-09-09 17:23:14'),
('ICE-CREAM', 5, 4, 'Teflon2000', 8, '2020-08-30 16:16:29', '2020-09-09 17:23:14'),
('MTR-TNT', 6, 9, 'MTRS NTF', 30, '2020-09-09 13:55:57', '2020-09-09 13:55:57'),
('renageede', 4, 4, 'sss', 21, '2020-08-30 16:19:25', '2020-08-30 16:19:25');

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
(26, 'ICE-CREAM', 'ICE-CREAMNg3H8.jpg', '2020-08-30 16:16:29', '2020-08-30 16:16:29'),
(27, 'ICE-CREAM', 'ICE-CREAM0LRlo.jpg', '2020-08-30 16:16:30', '2020-08-30 16:16:30'),
(29, 'renageede', 'renageedesIuo7.jpg', '2020-08-30 16:19:25', '2020-08-30 16:19:25'),
(30, 'renageede', 'renageedeI1j6k.jpg', '2020-08-30 16:19:25', '2020-08-30 16:19:25'),
(31, 'Coin-120', 'Coin-120JvMWs.jpg', '2020-08-30 16:21:35', '2020-08-30 16:21:35'),
(32, 'Coin-120', 'Coin-120csliZ.jpg', '2020-08-30 16:21:35', '2020-08-30 16:21:35'),
(33, 'MTR-TNT', 'MTR-TNTDpo44.jpg', '2020-09-09 13:55:57', '2020-09-09 13:55:57');

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
(4, 'Carier 90 L', 20000, '2020-08-30 15:54:15', '2020-08-31 17:44:12'),
(5, 'Nesting', 1000, '2020-08-30 16:16:29', '2020-08-30 16:16:29'),
(6, 'Matras', 5000, '2020-09-09 13:48:18', '2020-09-09 13:48:18');

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
(9, 'The North Face', '2020-09-09 13:49:08', '2020-09-09 13:49:08');

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
  `sewa_buktitf` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status_detail` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_sewa`
--

INSERT INTO `status_sewa` (`status_id`, `status_detail`) VALUES
(0, 'Canceled'),
(1, 'Checkout'),
(2, 'Paid'),
(3, 'Confirmed'),
(4, 'Ready to Pick'),
(5, 'Already Picked Up'),
(6, 'Returned'),
(7, 'Refused');

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
('M-200930002649', 1, 'Rialga', 'Muhamad Febri ALgani', 'febrialgani@gmail.com', 'Aspol Alai Blok D no 10 Padang', 'Mahasiswa', '0895374556747', '$2y$10$9RFEyRno9M1PhV2mewDR1.Rrd7fg1iQItNfiB5OrncQyYSllA7qzu', '2020-09-29 17:26:49', '2020-09-29 17:26:49'),
('M-200930003155', 2, 'NonAdmin', 'Harry Cane Di Ascaban', 'rialgane@gmail.com', 'Jawabnya ada di ujung langit padang', 'Pegawai Sumbar Mountain Adventure', '085374556740', '$2y$10$zMKYfD4OsLz2tawDa/djYO95p5cDYsquoC3GX64/3KrG9h1xWuxIG', '2020-09-29 17:31:55', '2020-09-29 17:43:50'),
('M-200930003429', 3, 'Member_1', 'ReMember 1', 'febrialganios@gmail.com', 'di rumah dari selatan', 'Karyawan BUMN', '085374556747', '$2y$10$edYTM./GaV8uim6T/4fgMeZgZWEZatcf1dJ1pgzdwuEjbU2zp3T8u', '2020-09-29 17:34:30', '2020-09-29 17:34:30');

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
  MODIFY `gambar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `jenis_alat`
--
ALTER TABLE `jenis_alat`
  MODIFY `jenis_alat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kondisi_alat`
--
ALTER TABLE `kondisi_alat`
  MODIFY `kondisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `merk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
