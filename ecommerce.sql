-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Nov 2025 pada 13.58
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
-- Database: `buku_tamu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukutamu`
--

CREATE TABLE `bukutamu` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bukutamu`
--

INSERT INTO `bukutamu` (`id`, `nama`, `email`, `pesan`, `created_at`) VALUES
(1, 'sep', 'sep@gmail.com', 'asdasdsaas', '2025-09-20 19:55:30'),
(13, 'arjuna', 'arjuna@gmail.com', 'sadasdsadsad', '2025-09-24 10:37:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'asep', '$2y$10$38.fxULKRC54hZK8KBDtHubV9VPuODGTmvjX9ca5.DN868fFeD1R.', 'asep@gmail.com', '2025-10-12 13:37:09'),
(2, 'Nella', '$2y$10$PquZmVnmUMdF5L0/BNMRN.0UYpG.zpBpfq2t1vNFnloMp/SmfR9zK', 'Nella@gmail.com', '2025-10-27 10:23:25'),
(3, 'Rey', '$2y$10$eMTWO3Kmh1NMTImcolO72.imdK9/LDl/D7MgupyseNwrfwDc48M3C', 'rey@gmail.com', '2025-11-06 14:15:18'),
(4, 'pale', '$2y$10$2hFkJbOXjdfWmqQxthAuGOq5UTgYbQ78Uukb.BcRtiZUBERL5xlTO', 'pale@gmail.com', '2025-11-06 14:17:50'),
(5, 'mus', '$2y$10$IqY9BYN.6CaKRcPdL5NkFOQH6i8mrfkf9YVX1vVUmcMd9NgbHzGl6', 'mus@gmail.com', '2025-11-06 14:21:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
