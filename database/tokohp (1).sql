-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Bulan Mei 2025 pada 19.08
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

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id_activity`, `id_user`, `username`, `aksi`, `timestamp`, `ip_address`) VALUES
(216, 1, 'Derius', 'User melihat Logs', '2025-05-14 03:21:32', '::1'),
(217, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-14 03:24:24', '::1'),
(218, 1, 'Derius', 'User melihat Logs', '2025-05-14 03:25:15', '::1'),
(219, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-15 17:50:30', '::1'),
(220, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-16 02:02:58', '::1'),
(221, 1, 'Derius', 'User mengakses menu HP', '2025-05-16 02:17:52', '::1'),
(222, 1, 'Derius', 'User mengakses form tambah hp', '2025-05-16 02:20:16', '::1'),
(223, 1, 'Derius', 'User mengakses menu HP', '2025-05-16 02:22:10', '::1'),
(224, 1, 'Derius', 'User mengakses form tambah hp', '2025-05-16 02:22:33', '::1'),
(225, 1, 'Derius', 'User mengakses menu HP', '2025-05-16 02:23:10', '::1'),
(226, 1, 'Derius', 'User mengakses form tambah hp', '2025-05-16 02:24:12', '::1'),
(227, 1, 'Derius', 'User mengakses menu HP', '2025-05-16 02:24:55', '::1'),
(228, 1, 'Derius', 'User mengakses form tambah hp', '2025-05-16 02:26:45', '::1'),
(229, 1, 'Derius', 'User mengakses menu HP', '2025-05-16 02:27:25', '::1'),
(230, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-16 02:38:58', '::1'),
(231, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-16 02:39:12', '::1'),
(232, 1, 'Derius', 'User mengakses menu HP', '2025-05-16 02:39:20', '::1'),
(233, 1, 'Derius', 'User memesan Hp nomor 5', '2025-05-16 02:39:28', '::1'),
(234, 1, 'Derius', 'User mengakses menu HP', '2025-05-16 02:39:31', '::1'),
(235, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-16 02:39:39', '::1'),
(236, 1, 'Derius', 'User mengakses menu HP', '2025-05-16 02:40:06', '::1'),
(237, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-16 02:40:15', '::1'),
(238, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-16 02:40:23', '::1'),
(239, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-16 02:40:48', '::1'),
(240, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-16 02:41:29', '::1'),
(241, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-16 02:42:33', '::1'),
(242, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-16 02:43:01', '::1'),
(243, 1, 'Derius', 'User melihat Logs', '2025-05-16 02:43:16', '::1'),
(244, 1, 'Derius', 'User mengakses tabel user', '2025-05-16 02:43:23', '::1'),
(245, 1, 'Derius', 'User mengakses tabel user', '2025-05-16 02:44:20', '::1'),
(246, 1, 'Derius', 'User mengakses tabel user', '2025-05-16 02:44:35', '::1'),
(247, 1, 'Derius', 'User menginput data user', '2025-05-16 02:44:50', '::1'),
(248, 1, 'Derius', 'User menginput data user', '2025-05-16 02:48:48', '::1'),
(249, 1, 'Derius', 'User mengakses tabel user', '2025-05-16 02:49:55', '::1'),
(250, 1, 'Derius', 'User mengakses halaman edit user', '2025-05-16 02:50:35', '::1'),
(251, 1, 'Derius', 'Admin mengedit data user dengan ID 17', '2025-05-16 02:51:33', '::1'),
(252, 1, 'Derius', 'User mengakses tabel user', '2025-05-16 02:51:37', '::1'),
(253, 1, 'Derius', 'User mengakses tabel user yang kena delete', '2025-05-16 02:51:49', '::1'),
(254, 1, 'Derius', 'User mengakses tabel user', '2025-05-16 02:52:03', '::1'),
(255, 1, 'Derius', 'User melihat Logs', '2025-05-16 02:52:34', '::1'),
(256, 1, 'Derius', 'User melihat Logs', '2025-05-16 02:53:22', '::1'),
(257, 19, 'Feira_UT', 'User mengakses menu keranjang', '2025-05-16 03:04:57', '::1'),
(258, 19, 'Feira_UT', 'User mengakses tabel Transaksi', '2025-05-16 03:05:04', '::1'),
(259, 19, 'Feira_UT', 'User mengakses menu HP', '2025-05-16 03:05:14', '::1'),
(260, 1, 'Derius', 'User mengakses Pengaturan', '2025-05-16 03:40:57', '::1'),
(261, 1, 'Derius', 'User melakukan login', '2025-05-16 21:36:11', '::1'),
(262, 1, 'Derius', 'User melakukan login', '2025-05-16 21:38:50', '::1'),
(263, 1, 'Derius', 'User melakukan login', '2025-05-16 22:04:13', '::1'),
(264, 1, 'Derius', 'User melakukan login', '2025-05-16 23:17:08', '::1'),
(265, 1, 'Derius', 'User melakukan login', '2025-05-16 23:17:31', '::1'),
(266, 1, 'Derius', 'User melakukan login', '2025-05-17 06:31:21', '::1'),
(267, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:39:34', '::1'),
(268, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:40:54', '::1'),
(269, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:40:56', '::1'),
(270, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:40:59', '::1'),
(271, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:00', '::1'),
(272, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:04', '::1'),
(273, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:07', '::1'),
(274, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:10', '::1'),
(275, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:13', '::1'),
(276, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:16', '::1'),
(277, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:18', '::1'),
(278, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:20', '::1'),
(279, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:23', '::1'),
(280, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:41:25', '::1'),
(281, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:42:11', '::1'),
(282, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:44:26', '::1'),
(283, 1, 'Derius', 'User melakukan login', '2025-05-17 06:45:04', '::1'),
(284, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 06:45:15', '::1'),
(285, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 07:01:51', '::1'),
(286, 1, 'Derius', 'User melakukan login', '2025-05-17 07:06:23', '::1'),
(287, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 07:06:32', '::1'),
(288, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 07:12:17', '::1'),
(289, 1, 'Derius', 'User menghapus hp nomor 6', '2025-05-17 07:32:24', '::1'),
(290, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 07:32:26', '::1'),
(291, 1, 'Derius', 'User menghapus hp nomor 5', '2025-05-17 07:34:15', '::1'),
(292, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 07:34:24', '::1'),
(293, 1, 'Derius', 'User mengakses form tambah hp', '2025-05-17 07:34:40', '::1'),
(294, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 07:35:10', '::1'),
(295, 1, 'Derius', 'User memesan Hp nomor 7', '2025-05-17 07:35:34', '::1'),
(296, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 07:35:35', '::1'),
(297, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 07:38:38', '::1'),
(298, 1, 'Derius', 'User memesan Hp nomor 7', '2025-05-17 07:45:15', '::1'),
(299, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 07:45:17', '::1'),
(300, 1, 'Derius', 'User memesan Hp nomor 7', '2025-05-17 07:45:57', '::1'),
(301, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 07:46:37', '::1'),
(302, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 07:47:16', '::1'),
(303, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 07:47:25', '::1'),
(304, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 07:50:56', '::1'),
(305, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 07:52:08', '::1'),
(306, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 07:52:57', '::1'),
(307, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 07:53:00', '::1'),
(308, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 07:53:08', '::1'),
(309, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 07:53:39', '::1'),
(310, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 07:53:46', '::1'),
(311, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 07:54:14', '::1'),
(312, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 07:56:03', '::1'),
(313, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 07:58:08', '::1'),
(314, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 07:58:13', '::1'),
(315, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 07:59:58', '::1'),
(316, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 08:00:05', '::1'),
(317, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 08:00:12', '::1'),
(318, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 08:00:19', '::1'),
(319, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 08:00:28', '::1'),
(320, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 08:00:41', '::1'),
(321, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 08:02:42', '::1'),
(322, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 08:04:32', '::1'),
(323, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 08:04:42', '::1'),
(324, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 08:05:01', '::1'),
(325, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 08:05:12', '::1'),
(326, 1, 'Derius', 'User mengakses status transaksi nomor 28', '2025-05-17 08:05:44', '::1'),
(327, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 08:05:45', '::1'),
(328, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 08:06:58', '::1'),
(329, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 08:07:04', '::1'),
(330, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:07:15', '::1'),
(331, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 08:07:20', '::1'),
(332, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 08:08:32', '::1'),
(333, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:38', '::1'),
(334, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:39', '::1'),
(335, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:42', '::1'),
(336, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:44', '::1'),
(337, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:46', '::1'),
(338, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:49', '::1'),
(339, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:51', '::1'),
(340, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:52', '::1'),
(341, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:54', '::1'),
(342, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:55', '::1'),
(343, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:57', '::1'),
(344, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:08:59', '::1'),
(345, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 08:10:09', '::1'),
(346, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:14', '::1'),
(347, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:17', '::1'),
(348, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:19', '::1'),
(349, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:20', '::1'),
(350, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:24', '::1'),
(351, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:27', '::1'),
(352, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:30', '::1'),
(353, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:34', '::1'),
(354, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:36', '::1'),
(355, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:39', '::1'),
(356, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:41', '::1'),
(357, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:43', '::1'),
(358, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:45', '::1'),
(359, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:48', '::1'),
(360, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:50', '::1'),
(361, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:52', '::1'),
(362, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:55', '::1'),
(363, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:57', '::1'),
(364, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:10:59', '::1'),
(365, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:01', '::1'),
(366, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:04', '::1'),
(367, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:07', '::1'),
(368, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:09', '::1'),
(369, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:12', '::1'),
(370, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:14', '::1'),
(371, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:18', '::1'),
(372, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:20', '::1'),
(373, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:23', '::1'),
(374, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:25', '::1'),
(375, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:27', '::1'),
(376, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:29', '::1'),
(377, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:31', '::1'),
(378, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:32', '::1'),
(379, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:34', '::1'),
(380, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:35', '::1'),
(381, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:37', '::1'),
(382, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:38', '::1'),
(383, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:40', '::1'),
(384, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:41', '::1'),
(385, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:11:43', '::1'),
(386, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 08:12:21', '::1'),
(387, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 08:12:26', '::1'),
(388, 1, 'Derius', 'User mengakses form edit hp', '2025-05-17 17:07:07', '::1'),
(389, 1, 'Derius', 'User memesan Hp nomor 7', '2025-05-17 17:07:14', '::1'),
(390, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 17:07:20', '::1'),
(391, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 17:07:29', '::1'),
(392, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 17:07:40', '::1'),
(393, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 17:14:05', '::1'),
(394, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 17:28:46', '::1'),
(395, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 17:28:50', '::1'),
(396, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 17:28:55', '::1'),
(397, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 17:29:03', '::1'),
(398, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 17:29:08', '::1'),
(399, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 17:29:12', '::1'),
(400, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 17:29:22', '::1'),
(401, 1, 'Derius', 'User mengakses status transaksi nomor 27', '2025-05-17 17:29:27', '::1'),
(402, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 17:29:28', '::1'),
(403, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 17:30:02', '::1'),
(404, 1, 'Derius', 'User mengakses form tambah hp', '2025-05-17 17:30:06', '::1'),
(405, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 17:30:31', '::1'),
(406, 1, 'Derius', 'User melihat Logs', '2025-05-17 17:33:20', '::1'),
(407, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 20:40:29', '::1'),
(408, 1, 'Derius', 'User melihat Logs', '2025-05-17 20:55:29', '::1'),
(409, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 21:07:03', '::1'),
(410, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 21:08:13', '::1'),
(411, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 21:09:11', '::1'),
(412, 1, 'Derius', 'User memesan Hp nomor 8', '2025-05-17 21:09:17', '::1'),
(413, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 21:09:39', '::1'),
(414, 1, 'Derius', 'User memesan Hp nomor 7', '2025-05-17 21:09:45', '::1'),
(415, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 21:09:52', '::1'),
(416, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 21:10:35', '::1'),
(417, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 21:16:57', '::1'),
(418, 1, 'Derius', 'User memesan Hp nomor 8', '2025-05-17 21:17:11', '::1'),
(419, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 21:17:12', '::1'),
(420, 1, 'Derius', 'User mengakses menu HP', '2025-05-17 21:17:28', '::1'),
(421, 1, 'Derius', 'User memesan Hp nomor 8', '2025-05-17 21:17:36', '::1'),
(422, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-17 21:17:38', '::1'),
(423, 20, 'Derius', 'User mengakses menu HP', '2025-05-17 21:34:30', '::1'),
(424, 20, 'Derius', 'User memesan Hp nomor 7', '2025-05-17 21:34:57', '::1'),
(425, 20, 'Derius', 'User mengakses menu keranjang', '2025-05-17 21:35:00', '::1'),
(426, 20, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 21:35:13', '::1'),
(427, 20, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 21:36:15', '::1'),
(428, 20, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 21:38:55', '::1'),
(429, 20, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 21:39:35', '::1'),
(430, 20, 'Derius', 'User melihat Logs', '2025-05-17 21:40:06', '::1'),
(431, 20, 'Derius', 'User mengakses menu HP', '2025-05-17 21:42:10', '::1'),
(432, 20, 'Derius', 'User mengakses menu HP', '2025-05-17 21:42:35', '::1'),
(433, 20, 'Derius', 'User memesan Hp nomor 7', '2025-05-17 21:42:43', '::1'),
(434, 20, 'Derius', 'User mengakses menu keranjang', '2025-05-17 21:42:46', '::1'),
(435, 20, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 21:42:54', '::1'),
(436, 20, 'Derius', 'User mengakses forum pembayaran', '2025-05-17 21:43:10', '::1'),
(437, 20, 'Derius', 'User mengakses tabel Transaksi', '2025-05-17 21:50:02', '::1'),
(438, 20, 'Derius', 'User melihat Logs', '2025-05-17 21:50:21', '::1'),
(439, 1, 'Derius', 'User mengakses tabel user', '2025-05-18 02:15:57', '::1'),
(440, 20, 'Derius', 'User mengakses menu keranjang', '2025-05-18 02:59:45', '::1'),
(441, 20, 'Derius', 'User mengakses menu HP', '2025-05-18 02:59:54', '::1'),
(442, 20, 'Derius', 'User mengakses tabel Transaksi', '2025-05-18 03:00:07', '::1'),
(443, 20, 'Derius', 'User melihat Logs', '2025-05-18 03:00:22', '::1'),
(444, 20, 'Derius', 'User mengakses tabel Transaksi', '2025-05-18 03:23:31', '::1'),
(445, 20, 'Derius', 'User mengakses menu HP', '2025-05-18 03:23:39', '::1'),
(446, 20, 'Derius', 'User memesan Hp nomor 7', '2025-05-18 03:23:57', '::1'),
(447, 20, 'Derius', 'User mengakses menu keranjang', '2025-05-18 03:24:02', '::1'),
(448, 20, 'Derius', 'User mengakses forum pembayaran', '2025-05-18 03:24:12', '::1'),
(449, 20, 'Derius', 'User mengakses tabel Transaksi', '2025-05-18 03:24:30', '::1'),
(450, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-18 03:26:20', '::1'),
(451, 1, 'Derius', 'User mengakses status transaksi nomor 31', '2025-05-18 03:26:58', '::1'),
(452, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-18 03:27:01', '::1'),
(453, 1, 'Derius', 'User mengakses status transaksi nomor 30', '2025-05-18 03:28:09', '::1'),
(454, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-18 03:28:11', '::1'),
(455, 1, 'Derius', 'User mengakses menu HP', '2025-05-18 04:31:05', '::1'),
(456, 1, 'Derius', 'User mengakses form tambah hp', '2025-05-18 04:31:28', '::1'),
(457, 1, 'Derius', 'User mengakses menu HP', '2025-05-18 04:32:35', '::1'),
(458, 1, 'Derius', 'User mengakses form edit hp', '2025-05-18 04:32:57', '::1'),
(459, 1, 'Derius', 'User mengakses menu HP', '2025-05-18 04:33:26', '::1'),
(460, 1, 'Derius', 'User menghapus hp nomor 9', '2025-05-18 04:33:48', '::1'),
(461, 1, 'Derius', 'User mengakses menu HP', '2025-05-18 04:33:54', '::1'),
(462, 1, 'Derius', 'User memesan Hp nomor 7', '2025-05-18 04:34:15', '::1'),
(463, 1, 'Derius', 'User mengakses menu keranjang', '2025-05-18 04:34:20', '::1'),
(464, 1, 'Derius', 'User mengakses forum pembayaran', '2025-05-18 04:34:52', '::1'),
(465, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-18 04:35:14', '::1'),
(466, 1, 'Derius', 'User mengakses status transaksi nomor 32', '2025-05-18 04:35:58', '::1'),
(467, 1, 'Derius', 'User mengakses tabel Transaksi', '2025-05-18 04:36:03', '::1'),
(468, 1, 'Derius', 'User melihat Logs', '2025-05-18 04:37:31', '::1'),
(469, 1, 'Derius', 'User mengakses tabel user', '2025-05-18 04:38:05', '::1'),
(470, 1, 'Derius', 'User mengakses tabel user', '2025-05-18 04:38:23', '::1'),
(471, 1, 'Derius', 'User menginput data user', '2025-05-18 04:39:02', '::1'),
(472, 1, 'Derius', 'User mengakses tabel user', '2025-05-18 04:39:53', '::1'),
(473, 1, 'Derius', 'User mengakses halaman edit user', '2025-05-18 04:40:13', '::1');

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
  `deskripsi` text DEFAULT NULL,
  `foto_hp` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hp`
--

INSERT INTO `hp` (`id_hp`, `merk`, `tahun`, `kondisi`, `harga`, `deskripsi`, `foto_hp`, `created_at`) VALUES
(7, 'Poco f1', '2025-05-22', 'baru', '1200000.00', 'Hp Ini baik', '1747510508_f4eb5993643908dd565c.png', '2025-05-18 02:35:08'),
(8, 'Poco', '2025-04-19', 'baru', '13000000.00', 'adadadad', '1747546229_32e3c4aa57d3d3c6f700.jpg', '2025-05-18 12:30:29');

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
(7, 1, 8, 1, '2025-05-18 09:09:17', '2025-05-18 16:34:44');

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
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_harga` double NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tanggal`, `total_harga`, `metode_pembayaran`, `bukti_pembayaran`, `status_pembayaran`) VALUES
(26, 1, '2025-05-14 10:04:48', 2100000, 'Transfer Bank', '1747235087_1afccd49fe89398aaee6.png', 'sukses'),
(27, 1, '2025-05-16 09:41:23', 2100000, 'E-Wallet', '1747406483_df53ca973db391a6e055.jpg', 'sukses'),
(28, 1, '2025-05-17 15:05:10', 1200000, 'Transfer Bank', '1747512310_6a0811fceeed9f8a7094.png', 'sukses'),
(29, 1, '2025-05-18 00:29:20', 2400000, 'Transfer Bank', '1747546160_a091d6f573de071ce84e.png', 'menunggu verifikasi'),
(30, 20, '2025-05-18 04:36:11', 1200000, 'Transfer Bank', '1747560971_c60cde4010c791944447.png', 'batal'),
(31, 20, '2025-05-18 10:24:25', 2400000, 'E-Wallet', '1747581865_c7381d68e0e3f9ded20a.png', 'sukses'),
(32, 1, '2025-05-18 11:35:09', 1200000, 'E-Wallet', '1747586109_7c8ccd4e2c694af83fc6.png', 'sukses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` enum('admin','superadmin','pembeli') DEFAULT NULL,
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
(1, 'Derius', 'Derpyus', 'tanderius05@gmail.com', 'superadmin', '371eeb2da9de1a50e797aa016519ac2f', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
(17, 'admin', 'Chel', 'der@gmail.com', 'pembeli', '123', 0, NULL, NULL, 1, '2025-05-16 09:49:51', 0, '2025-05-16 09:51:32', 0, NULL),
(18, 'admin', 'Sera', 'boboy@gmail.com', 'pembeli', '123awda', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
(19, 'Feira_UT', 'Chelsica', 'boboy@gmail.com', 'pembeli', '371eeb2da9de1a50e797aa016519ac2f', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
(21, 'Derius', 'Chelsica', 'boboy@gmail.com', 'pembeli', '28d810b20c4a13e2dec9d2713f7e4764', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
(22, 'roni', 'aea', 'kevin@em.sch.id', 'pembeli', '28d810b20c4a13e2dec9d2713f7e4764', 0, NULL, NULL, 1, '2025-05-18 11:39:48', 0, NULL, 0, NULL),
(23, 'ada', 'ada', 'tanderius05@gmail.com', 'pembeli', '694aa03e9f23451b054fb7b7eb2271b9', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL);

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
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

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
  MODIFY `id_activity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;

--
-- AUTO_INCREMENT untuk tabel `hp`
--
ALTER TABLE `hp`
  MODIFY `id_hp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
