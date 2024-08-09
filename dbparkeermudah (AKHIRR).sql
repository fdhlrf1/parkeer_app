-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2024 pada 06.32
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpengendara_masuk`
--

CREATE TABLE `tbpengendara_masuk` (
  `id_parkir` varchar(40) NOT NULL,
  `No_Polisi` varchar(40) NOT NULL,
  `Merk` varchar(40) NOT NULL,
  `Jenis` varchar(40) NOT NULL,
  `Blok` enum('A','B','C','D','E') NOT NULL,
  `Jam_Masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Petugas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, 'Fadhil Rafi Fauzan', 'fadhilrafi10', '$2y$10$ca3yJAHgtQSLU1bdQAkPreuT5WiGE07RHv017jLQXJjjlQ5sqUFo6', 'Petugas');

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
-- AUTO_INCREMENT untuk tabel `tbpengguna`
--
ALTER TABLE `tbpengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbrekapan_masuk`
--
ALTER TABLE `tbrekapan_masuk`
  MODIFY `id_rekapan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbtarif_parkir`
--
ALTER TABLE `tbtarif_parkir`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
