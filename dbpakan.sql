-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jul 2021 pada 13.28
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpakan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kd_kriteria` varchar(6) NOT NULL,
  `nm_kriteria` varchar(20) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kd_kriteria`, `nm_kriteria`, `tipe`, `bobot`) VALUES
('C1', 'Protein', 'Benefit', 30),
('C2', 'Laju Pertumbuhan', 'Benefit', 15),
('C3', 'Kemudahan Pemberian', 'Benefit', 10),
('C4', 'Kandungan Air', 'Benefit', 25),
('C5', 'Harga', 'Cost', 10),
('C6', 'Umur Ikan', 'Benefit', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakan`
--

CREATE TABLE `pakan` (
  `kd_pakan` varchar(6) NOT NULL,
  `nm_pakan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pakan`
--

INSERT INTO `pakan` (`kd_pakan`, `nm_pakan`) VALUES
('A01', 'Cacing Sutra'),
('A02', 'Cacing Tanah'),
('A03 ', 'Artemia'),
('A04 ', 'Daphnia SP / Kutu Air'),
('A05', 'Ikan Rucah'),
('A06', 'Kepala Udang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `iduser` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(30) NOT NULL,
  `alamat_email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`iduser`, `nama_lengkap`, `jenis_kelamin`, `alamat_email`, `username`, `password`, `level`) VALUES
(20, 'Agus Maulana', 'Laki-Laki', 'agusmaulana@gmail.com', 'agus', '123', 2),
(21, 'Aris Dwi Nugroho', 'Laki-Laki', 'arisdwinugroho@gmail.com', 'aris', '123', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(6) NOT NULL,
  `kd_pakan` varchar(6) NOT NULL,
  `kd_kriteria` varchar(6) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id`, `kd_pakan`, `kd_kriteria`, `nilai`) VALUES
(165, 'A02', 'C1', 5),
(166, 'A02', 'C2', 5),
(167, 'A02', 'C3', 5),
(168, 'A02', 'C4', 5),
(169, 'A02', 'C5', 4),
(170, 'A02', 'C6', 4),
(177, 'A04 ', 'C1', 3),
(178, 'A04 ', 'C2', 5),
(179, 'A04 ', 'C3', 5),
(180, 'A04 ', 'C4', 4),
(181, 'A04 ', 'C5', 4),
(182, 'A04 ', 'C6', 3),
(183, 'A05', 'C1', 3),
(184, 'A05', 'C2', 4),
(185, 'A05', 'C3', 3),
(186, 'A05', 'C4', 3),
(187, 'A05', 'C5', 3),
(188, 'A05', 'C6', 4),
(207, 'A01', 'C1', 5),
(208, 'A01', 'C2', 4),
(209, 'A01', 'C3', 5),
(210, 'A01', 'C4', 5),
(211, 'A01', 'C5', 4),
(212, 'A01', 'C6', 5),
(225, 'A03 ', 'C1', 5),
(226, 'A03 ', 'C2', 4),
(227, 'A03 ', 'C3', 5),
(228, 'A03 ', 'C4', 5),
(229, 'A03 ', 'C5', 4),
(230, 'A03 ', 'C6', 5),
(231, 'A06', 'C1', 3),
(232, 'A06', 'C2', 3),
(233, 'A06', 'C3', 3),
(234, 'A06', 'C4', 3),
(235, 'A06', 'C5', 4),
(236, 'A06', 'C6', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kd_kriteria`) USING BTREE;

--
-- Indeks untuk tabel `pakan`
--
ALTER TABLE `pakan`
  ADD PRIMARY KEY (`kd_pakan`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`iduser`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
