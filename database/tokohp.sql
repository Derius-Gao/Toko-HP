-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Bulan Mei 2025 pada 19.02
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokohp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id_activity` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hp`
--

CREATE TABLE `hp` (
  `id_hp` int(11) NOT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `tahun` date DEFAULT NULL,
  `kondisi` enum('baru','bekas') DEFAULT 'baru',
  `harga` decimal(15,2) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `foto_hp` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hp`
--

INSERT INTO `hp` (`id_hp`, `merk`, `tahun`, `kondisi`, `harga`, `stok`, `deskripsi`, `foto_hp`, `created_at`) VALUES
(5, 'realme', '2025-05-15', 'baru', '2100000.00', 1, 'hp ini awet', '1747067559_61bf44225f5351ce0669.jpeg', '2025-05-12 23:32:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hp` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_hp`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, '2025-05-12 16:59:36', '2025-05-12 16:59:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan_app`
--

CREATE TABLE `pengaturan_app` (
  `id_pengaturan` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_web` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaturan_app`
--

INSERT INTO `pengaturan_app` (`id_pengaturan`, `judul`, `logo`, `logo_web`, `created_at`, `updated_at`) VALUES
(1, 'TokoHp', '1745246983_0e6c1f7e63a518f713b5.png', '1745081251_fd6de9082e3ff91bbe60.png', '2025-04-19 04:47:31', '2025-05-12 04:23:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_hp` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_total` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_harga` double NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` enum('pending','Lunas','Batal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tukar_tambah`
--

CREATE TABLE `tukar_tambah` (
  `id_tukar` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `hp_lama_merk` varchar(50) DEFAULT NULL,
  `hp_lama_tipe` varchar(50) DEFAULT NULL,
  `kondisi_hp_lama` enum('rusak','layak pakai','baik') DEFAULT NULL,
  `estimasi_nilai` decimal(15,2) DEFAULT NULL,
  `id_hp_baru` int(11) DEFAULT NULL,
  `selisih_harga` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` enum('admin','operator','superadmin','pasangan') DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama_user`, `email`, `level`, `password`, `delete_status`, `reset_token`, `reset_token_expiry`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'Derius', 'Derpyus', 'tanderius05@gmail.com', 'superadmin', 'derius123', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
(15, 'Chelsica', 'Chel', 'chel@gmail.com', 'pasangan', 'chelsi123', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
(16, 'hendro', 'aea', 'kevin@em.sch.id', 'operator', '123', 0, NULL, NULL, 1, '2025-04-21 11:34:37', 0, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id_activity`);

--
-- Indeks untuk tabel `hp`
--
ALTER TABLE `hp`
  ADD PRIMARY KEY (`id_hp`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tukar_tambah`
--
ALTER TABLE `tukar_tambah`
  ADD PRIMARY KEY (`id_tukar`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id_activity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT untuk tabel `hp`
--
ALTER TABLE `hp`
  MODIFY `id_hp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tukar_tambah`
--
ALTER TABLE `tukar_tambah`
  MODIFY `id_tukar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
