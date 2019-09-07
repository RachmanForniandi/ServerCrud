-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Sep 2019 pada 11.16
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_crud`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gambar`
--

CREATE TABLE `tbl_gambar` (
  `id_gambar` int(11) NOT NULL,
  `file_gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_gambar`
--

INSERT INTO `tbl_gambar` (`id_gambar`, `file_gambar`) VALUES
(21, 'ca56e79539604be4b9c3a85f3c0907eb.png'),
(22, 'f210f5a58cf706fac7e8374a5a1c48ab.png'),
(23, '5f20e6b4f57dd1b6ca6780a6f8626c2c.jpg'),
(24, '8beaa40baab1bed2f841bb8c8f01d596.jpg'),
(25, 'f2a9c7a16e34f7c5c6bb197271c7d3fb.jpg'),
(26, ''),
(27, 'f862b891574b6950c3728dacc6938c46.jpg'),
(28, ''),
(29, ''),
(30, ''),
(31, 'f6dea7804dab29a1f89de9f3d9427fb3.png'),
(32, ''),
(33, ''),
(34, ''),
(35, ''),
(36, ''),
(37, ''),
(38, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(132) NOT NULL,
  `email_user` varchar(132) NOT NULL,
  `no_hp_user` varchar(132) NOT NULL,
  `alamat` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email_user`, `no_hp_user`, `alamat`) VALUES
(1, 'Rudiantoro', 'rudiantoro@gmail.com', '085377213138', 'kwdhjwhwohr'),
(2, 'Rachman Ridwan', 'rachmanridwan@gmail.com', '0857343654654', 'Jl Flamingo IV Blok Jc 13 no 4 Bintaro Jaya sektor IX Tangsel Banten'),
(3, 'Baron Rafaello', 'baronrafaello@gmail.com', '087724677447', 'Jl. Elang no 3'),
(9, 'syahrul', 'syahrul@gmail.com', '085377213138', 'kwdhjwhwohr');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_gambar`
--
ALTER TABLE `tbl_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_gambar`
--
ALTER TABLE `tbl_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
