-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Agu 2020 pada 20.16
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
  `alat_kode` varchar(10) NOT NULL,
  `alat_jenis` int(11) NOT NULL,
  `alat_merk` int(11) NOT NULL,
  `alat_tipe` varchar(25) NOT NULL,
  `alat_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_sewa`
--

CREATE TABLE `detail_sewa` (
  `detail_sewa_alat_kode` varchar(10) NOT NULL,
  `detail_sewa_nosewa` varchar(10) NOT NULL,
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
  `gambar_file` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_sewa`
--

CREATE TABLE `jenis_sewa` (
  `jenis_id` int(11) NOT NULL,
  `jenis_nama` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_alat`
--

CREATE TABLE `kondisi_alat` (
  `kondisi_id` int(11) NOT NULL,
  `kondisi_keterangan` varchar(20) NOT NULL,
  `kondisi_dendarusak` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `pengembalian_nosewa` varchar(10) NOT NULL,
  `pengembalian_kodealat` varchar(10) NOT NULL,
  `pengembalian_kondisi` int(11) NOT NULL,
  `pengembalian_totalalat` int(11) NOT NULL,
  `pengembalian_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pengembalian_dendaterlambat` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `sewa_no` varchar(10) NOT NULL,
  `sewa_jenis` int(11) NOT NULL,
  `sewa_status` int(11) NOT NULL,
  `sewa_user` varchar(20) NOT NULL,
  `sewa_tglsewa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sewa_tglbayar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sewa_tglkembali` date NOT NULL,
  `sewa_buktitf` varchar(10) DEFAULT NULL,
  `sewa_offnama` varchar(20) DEFAULT NULL,
  `sewa_offphone` varchar(15) DEFAULT NULL,
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
(2, 'Penyewa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_sewa`
--

CREATE TABLE `status_sewa` (
  `status_id` int(11) NOT NULL,
  `status_detail` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_nama` varchar(30) NOT NULL,
  `user_mail` varchar(25) NOT NULL,
  `user_alamat` varchar(100) NOT NULL,
  `user_job` varchar(25) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_role`, `user_nama`, `user_mail`, `user_alamat`, `user_job`, `user_phone`, `user_password`, `created_at`, `updated_at`) VALUES
('rialga', 1, 'Muhamad Febri lgani', 'febrialgani@gmail.com', 'Aspol alai Padang blok d no 10', 'Mahasiswa', '085374556747', '$2y$10$ltC8biBPsTPM9gxkM3ZM7OJuQ2ULS/cGGU3hT1y8db4BIvcyEK4OO', '2020-06-28 22:03:38', NULL),
('sewa', 2, 'Nama Saya Penyewa', 'a@a.com', 'Padang Semesta', 'Mahasiswa', '081374449292 ', '$2y$10$ltC8biBPsTPM9gxkM3ZM7OJuQ2ULS/cGGU3hT1y8db4BIvcyEK4OO', '2020-06-28 22:04:04', NULL);

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
-- Indeks untuk tabel `jenis_sewa`
--
ALTER TABLE `jenis_sewa`
  ADD PRIMARY KEY (`jenis_id`);

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
  ADD KEY `sewa_jenis` (`sewa_jenis`),
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
  ADD KEY `user_role` (`user_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gambar_alat`
--
ALTER TABLE `gambar_alat`
  MODIFY `gambar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_alat`
--
ALTER TABLE `jenis_alat`
  MODIFY `jenis_alat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jenis_sewa`
--
ALTER TABLE `jenis_sewa`
  MODIFY `jenis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kondisi_alat`
--
ALTER TABLE `kondisi_alat`
  MODIFY `kondisi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `merk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status_sewa`
--
ALTER TABLE `status_sewa`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `penyewaan_ibfk_1` FOREIGN KEY (`sewa_jenis`) REFERENCES `jenis_sewa` (`jenis_id`),
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
