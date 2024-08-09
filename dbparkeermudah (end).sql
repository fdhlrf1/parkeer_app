-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2024 pada 03.01
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbparkeermudah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbblok_parkir`
--

CREATE TABLE `tbblok_parkir` (
  `id_blok` int(11) NOT NULL,
  `Blok` char(1) NOT NULL,
  `Total_Tempat` int(11) NOT NULL,
  `Terisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbblok_parkir`
--

INSERT INTO `tbblok_parkir` (`id_blok`, `Blok`, `Total_Tempat`, `Terisi`) VALUES
(1, 'A', 28, 2),
(2, 'B', 29, 1),
(3, 'C', 39, 1),
(4, 'D', 30, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpengendara_keluar`
--

CREATE TABLE `tbpengendara_keluar` (
  `No_Laporan` varchar(40) NOT NULL,
  `id_parkir` varchar(40) NOT NULL,
  `No_Polisi` varchar(40) NOT NULL,
  `Merk` varchar(40) NOT NULL,
  `Jenis` varchar(40) NOT NULL,
  `Blok` varchar(20) NOT NULL,
  `Jam_Masuk` varchar(20) NOT NULL,
  `Jam_Keluar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Tarif` int(11) NOT NULL,
  `Tagihan` int(11) NOT NULL,
  `Petugas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbpengendara_keluar`
--

INSERT INTO `tbpengendara_keluar` (`No_Laporan`, `id_parkir`, `No_Polisi`, `Merk`, `Jenis`, `Blok`, `Jam_Masuk`, `Jam_Keluar`, `Tarif`, `Tagihan`, `Petugas`) VALUES
('RPT001', 'PRK001', 'D 1933 BDG', 'Honda', 'Motor', 'B', '2024-06-03 10:35:25', '2024-06-03 03:35:52', 2000, 2000, 'Super Petugas'),
('RPT002', 'PRK001', 'D 4343 HHG', 'KIA', 'Mobil', 'B', '2024-06-03 10:50:02', '2024-06-03 03:59:08', 5000, 5000, 'Super Admin'),
('RPT003', 'PRK002', 'B 0899 RER', 'Kawasaki', 'Motor', 'E', '2024-06-03 10:57:21', '2024-06-03 04:01:09', 2000, 2000, 'Super Petugas'),
('RPT004', 'PRK002', 'B 0899 RER', 'Kawasaki', 'Motor', 'E', '2024-06-03 10:57:21', '2024-06-03 04:01:09', 2000, 2000, 'Super Petugas'),
('RPT005', 'PRK003', 'T 4545 JUJ', 'Chevrolet', 'Mobil', 'C', '2024-06-03 11:02:15', '2024-06-03 04:03:08', 5000, 5000, 'Super Petugas'),
('RPT006', 'PRK002', 'AB 5656 JJU', 'Toyota', 'Mobil', 'C', '2024-06-03 11:02:01', '2024-06-03 04:03:27', 5000, 5000, 'Super Petugas'),
('RPT007', 'PRK001', 'B 5454 NHN', 'Kawasaki', 'Motor', 'C', '2024-06-03 11:01:46', '2024-06-03 04:03:42', 2000, 2000, 'Super Petugas'),
('RPT008', 'PRK002', 'B 4343 GFG', 'Hyundai', 'Mobil', 'S', '2024-06-03 17:56:23', '2024-06-03 11:19:36', 5000, 5000, 'Super Petugas'),
('RPT009', 'PRK001', 'D 5555 HHH', 'Honda', 'Motor', 'C', '2024-06-05 08:00:18', '2024-06-05 01:04:56', 2000, 2000, 'Super Petugas'),
('RPT010', 'PRK002', 'B 7777 JKU', 'Jeep', 'Mobil', 'B', '2024-06-05 08:04:28', '2024-06-05 01:05:46', 5000, 5000, 'Super Petugas'),
('RPT011', 'PRK003', 'F 7777 KKK', 'Kawasaki', 'Motor', 'B', '2024-06-05 08:15:05', '2024-06-05 01:15:24', 2000, 2000, 'Super Petugas'),
('RPT012', 'PRK001', 'D 4444 GGG', 'Honda', 'Motor', 'B', '2024-06-05 08:13:41', '2024-06-05 01:15:37', 2000, 2000, 'Super Petugas'),
('RPT013', 'PRK002', 'H 6666 HHH', 'Honda', 'Motor', 'B', '2024-06-05 08:14:29', '2024-06-05 01:15:46', 2000, 2000, 'Super Petugas'),
('RPT014', 'PRK001', 'B 9999 LLL', 'Honda', 'Motor', 'C', '2024-06-05 08:16:38', '2024-06-05 01:18:16', 2000, 2000, 'Super Petugas'),
('RPT015', 'PRK002', 'K 6666 III', 'Honda', 'Motor', 'C', '2024-06-05 08:17:09', '2024-06-05 01:18:42', 2000, 2000, 'Super Petugas'),
('RPT016', 'PRK003', 'AB 2222 GGG', 'Honda', 'Motor', 'B', '2024-06-05 08:17:31', '2024-06-05 01:19:05', 2000, 2000, 'Super Petugas'),
('RPT017', 'PRK004', 'AB 2222 TTT', 'Honda', 'Motor', 'C', '2024-06-05 08:17:58', '2024-06-05 01:19:24', 2000, 2000, 'Super Petugas'),
('RPT018', 'PRK001', 'AB 8888 GGG', 'Honda', 'Motor', 'A', '2024-06-05 08:24:24', '2024-06-05 01:25:13', 2000, 2000, 'Super Petugas'),
('RPT019', 'PRK004', 'D 2322 DDS', 'Mazda', 'Mobil', 'C', '2024-06-05 10:30:38', '2024-06-05 03:31:18', 5000, 5000, 'Super Admin'),
('RPT020', 'PRK005', 'F 4234 HGH', 'Honda', 'Motor', 'F', '2024-06-07 19:09:04', '2024-06-07 12:09:50', 2000, 2000, 'Super Petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpengendara_masuk`
--

CREATE TABLE `tbpengendara_masuk` (
  `id_parkir` varchar(40) NOT NULL,
  `No_Polisi` varchar(40) NOT NULL,
  `Merk` varchar(40) NOT NULL,
  `Jenis` varchar(40) NOT NULL,
  `Blok` varchar(40) NOT NULL,
  `Jam_Masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Petugas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbpengendara_masuk`
--

INSERT INTO `tbpengendara_masuk` (`id_parkir`, `No_Polisi`, `Merk`, `Jenis`, `Blok`, `Jam_Masuk`, `Petugas`) VALUES
('PRK001', 'A 5535 TGT', 'Honda', 'Motor', 'A', '2024-06-05 03:23:16', 'Super Petugas'),
('PRK002', 'D 8888 JUU', 'Mazda', 'Mobil', 'A', '2024-06-05 03:24:09', 'Super Petugas'),
('PRK003', 'D 8787 GHG', 'Toyota', 'Mobil', 'B', '2024-06-05 03:28:20', 'Super Petugas'),
('PRK004', 'AB 3123 UAB', 'Isuzu', 'Mobil', 'C', '2024-06-07 11:39:12', 'Super Petugas');

--
-- Trigger `tbpengendara_masuk`
--
DELIMITER $$
CREATE TRIGGER `before_pengendara_keluar` BEFORE DELETE ON `tbpengendara_masuk` FOR EACH ROW INSERT INTO tbrekapan_masuk (
        id_parkir, No_Polisi, Merk, Jenis, Blok, Jam_Masuk, Petugas
    ) VALUES (
        OLD.id_parkir, OLD.No_Polisi, OLD.Merk, OLD.Jenis, OLD.Blok, OLD.Jam_Masuk, OLD.Petugas
    )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpengguna`
--

CREATE TABLE `tbpengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbpengguna`
--

INSERT INTO `tbpengguna` (`id`, `nama`, `username`, `password`, `hak_akses`) VALUES
(1, 'Super Admin', 'admin', '$2y$10$1tfmkQ2t/JUUat5JdnMtLOIyA.7/qQzd4IpShazEGNojdiGgc/02O', 'Admin'),
(2, 'Super Petugas', 'petugas', '$2y$10$1fRdk8CmK.138zfEHaAZ/O5vIwMmauDsUmExVtr37EV9f1o7WVfVK', 'Petugas'),
(5, 'FadhilRafiFauzan', 'fadhil', '$2y$10$n06oM6SOTJNaISRmLMdALey6GF20BPzBa.otVVJa5F/NU9pngAxOi', 'Petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbrekapan_masuk`
--

CREATE TABLE `tbrekapan_masuk` (
  `id_rekapan` int(11) NOT NULL,
  `id_parkir` varchar(40) DEFAULT NULL,
  `No_Polisi` varchar(15) DEFAULT NULL,
  `Merk` varchar(50) DEFAULT NULL,
  `Jenis` varchar(50) DEFAULT NULL,
  `Blok` varchar(5) DEFAULT NULL,
  `Jam_Masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Petugas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbrekapan_masuk`
--

INSERT INTO `tbrekapan_masuk` (`id_rekapan`, `id_parkir`, `No_Polisi`, `Merk`, `Jenis`, `Blok`, `Jam_Masuk`, `Petugas`) VALUES
(1, 'PRK001', 'D 1933 BDG', 'Honda', 'Motor', 'A', '2024-06-03 03:35:25', 'Super Petugas'),
(2, 'PRK001', 'D 4343 HHG', 'KIA', 'Mobil', 'B', '2024-06-03 03:50:02', 'Super Petugas'),
(3, 'PRK002', 'B 0899 RER', 'Kawasaki', 'Motor', 'E', '2024-06-03 03:57:21', 'Super Petugas'),
(4, 'PRK003', 'T 4545 JUJ', 'Chevrolet', 'Mobil', 'C', '2024-06-03 04:02:15', 'Super Petugas'),
(5, 'PRK002', 'AB 5656 JJU', 'Toyota', 'Mobil', 'C', '2024-06-03 04:02:01', 'Super Petugas'),
(6, 'PRK001', 'B 5454 NHN', 'Kawasaki', 'Motor', 'C', '2024-06-03 04:01:46', 'Super Petugas'),
(7, 'PRK002', 'B 4343 GFG', 'Hyundai', 'Mobil', 'S', '2024-06-03 10:56:23', 'Super Admin'),
(8, 'PRK001', 'D 5555 HHH', 'Honda', 'Motor', 'C', '2024-06-05 01:00:18', 'Super Petugas'),
(9, 'PRK002', 'B 7777 JKU', 'Jeep', 'Mobil', 'C', '2024-06-05 01:04:28', 'Super Petugas'),
(10, 'PRK003', 'F 7777 KKK', 'Kawasaki', 'Motor', 'B', '2024-06-05 01:15:05', 'Super Petugas'),
(11, 'PRK001', 'D 4444 GGG', 'Honda', 'Motor', 'B', '2024-06-05 01:13:41', 'Super Petugas'),
(12, 'PRK002', 'H 6666 HHH', 'Honda', 'Motor', 'B', '2024-06-05 01:14:29', 'Super Petugas'),
(13, 'PRK001', 'B 9999 LLL', 'Honda', 'Motor', 'C', '2024-06-05 01:16:38', 'Super Petugas'),
(14, 'PRK002', 'K 6666 III', 'Honda', 'Motor', 'C', '2024-06-05 01:17:09', 'Super Petugas'),
(15, 'PRK003', 'AB 2222 GGG', 'Honda', 'Motor', 'B', '2024-06-05 01:17:31', 'Super Petugas'),
(16, 'PRK004', 'AB 2222 TTT', 'Honda', 'Motor', 'C', '2024-06-05 01:17:58', 'Super Petugas'),
(17, 'PRK001', 'AB 8888 GGG', 'Honda', 'Motor', 'A', '2024-06-05 01:24:24', 'Super Petugas'),
(18, 'PRK004', 'D 2322 DDS', 'Mazda', 'Mobil', 'C', '2024-06-05 03:30:38', 'Super Admin'),
(19, 'PRK005', 'F 4234 HGH', 'Honda', 'Motor', 'F', '2024-06-07 12:09:04', 'Super Petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbtarif_parkir`
--

CREATE TABLE `tbtarif_parkir` (
  `id_tarif` int(11) NOT NULL,
  `Jenis` varchar(40) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbtarif_parkir`
--

INSERT INTO `tbtarif_parkir` (`id_tarif`, `Jenis`, `tarif`) VALUES
(1, 'Motor', 2000),
(2, 'Mobil', 5000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbblok_parkir`
--
ALTER TABLE `tbblok_parkir`
  ADD PRIMARY KEY (`id_blok`);

--
-- Indeks untuk tabel `tbpengendara_keluar`
--
ALTER TABLE `tbpengendara_keluar`
  ADD PRIMARY KEY (`No_Laporan`),
  ADD KEY `id_parkir` (`id_parkir`) USING BTREE;

--
-- Indeks untuk tabel `tbpengendara_masuk`
--
ALTER TABLE `tbpengendara_masuk`
  ADD PRIMARY KEY (`id_parkir`);

--
-- Indeks untuk tabel `tbpengguna`
--
ALTER TABLE `tbpengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `tbrekapan_masuk`
--
ALTER TABLE `tbrekapan_masuk`
  ADD PRIMARY KEY (`id_rekapan`),
  ADD KEY `id_parkir` (`id_parkir`);

--
-- Indeks untuk tabel `tbtarif_parkir`
--
ALTER TABLE `tbtarif_parkir`
  ADD PRIMARY KEY (`id_tarif`),
  ADD KEY `Jenis` (`Jenis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbblok_parkir`
--
ALTER TABLE `tbblok_parkir`
  MODIFY `id_blok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbpengguna`
--
ALTER TABLE `tbpengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbrekapan_masuk`
--
ALTER TABLE `tbrekapan_masuk`
  MODIFY `id_rekapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbtarif_parkir`
--
ALTER TABLE `tbtarif_parkir`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
