-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2019 at 10:30 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikels`
--

CREATE TABLE `artikels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_promises`
--

CREATE TABLE `detail_promises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promise_id` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_promises`
--

INSERT INTO `detail_promises` (`id`, `promise_id`, `deskripsi`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>Pemerintahan Joko Widodo-Jusuf Kalla menjanjikan Indonesia sebagai poros maritim dunia. Salah satunya bisa dilihat dalam janji di ranah hubungan internasional, di mana Jokowi-JK berkomitmen mengedepankan identitas Indonesia sebagai negara kepulauan dalam pelaksanaan diplomasi internasional.&nbsp;</p>\r\n\r\n<p>Salah satu agenda aksi dalam menifesto janji 2014 adalah untuk mempercepat penyelesaian permasalahan perbatasan Indonesia, termasuk perbatasan darat, dengan 10 negara tetangga: Australia, Filipina, India, Malaysia, Palau, Papua Nugini, Singapura, Thailand, Timor Leste, dan Vietnam.</p>\r\n\r\n<p>Ada tiga jenis batas maritim yang diatur dalam Konvensi Perserikatan Bangsa-Bangsa tentang Hukum Laut (UNCLOS) 1982, yakni laut teritorial, landas kontinen, dan zona ekonomi ekslusif (ZEE). Negara berhak mengklaim laut teritorial selebar 12 mil laut dari garis pangkal. Selain itu, negara juga berhak mengklaim teritori selebar 200 mil laut dari garis pangkal, yang meliputi permukaan laut (ZEE) dan dasar laut (landas kontinen).</p>\r\n\r\n<p>Wilayah laut teritorial selebar 12 mil laut dari garis pangkal yang berhak diklaim Indonesia tumpang tindih dengan empat negara yang sama-sama berhak atas wilayah itu, mereka adalah Malaysia, Singapura, Papua Nugini, dan Timor Leste. Untuk wilayah ZEE dan landas kontinen yang selebar 200 mil laut dari garis pangkal yang berhak diklaim Indonesia sementara itu berbenturan dengan klaim sembilan negara tetangga, yakni Australia, Filipina, India, Malaysia, Palau, Papua Nugini, Thailand, Timor Leste, dan Vietnam.</p>\r\n\r\n<p>Pada 1969, Indonesia menyelesaikan 18 perjanjian perbatasan dengan delapan negara tetangga. Selengkapnya bisa dilihat dari infografis Direktorat Hukum dan Perjanjian Internasional Kementerian Luar Negeri (Januari 2019) sebagai berikut:</p>\r\n\r\n<p><img alt=\"\" src=\"http://localhost:8000/photos/1/abu.png\" style=\"height:180px; width:320px\" /></p>\r\n\r\n<p>Tahun 2018, menurut data Laporan Kinerja Kementerian Luar Negeri Tahun 2018 [insert link: https://kemlu.go.id/download/L3NpdGVzL3B1c2F0L0RvY3VtZW50cy9MS0pfS2VtZW5sdV8yMDE4LnBkZg%3D%3D], perundingan batas maritim telah dilaksanakan dengan 7 (tujuh) negara yaitu Malaysia, Vietnam, India, Palau, Filipina, Thailand, dan Timor Leste.&nbsp;</p>\r\n\r\n<p>Data Kementerian Luar Negeri RI &nbsp;hingga Januari 2019, masih ada 55,88 persen dari seluruh panjang batas laut teritorial Indonesia yang belum terselesaikan. Ada pula 45,35 persen panjang batas ZEE dan 29,22 persen panjang batas landas kontinen yang belum tuntas.</p>', 'Gagal', 'Publish', '2019-08-12 07:58:40', '2019-08-12 08:17:10'),
(2, 2, '<p>Kementerian Ketenagakerjaan merevisi Undang-Undang Nomor 39 Tahun 2004 tentang Penempatan Dan Perlindungan Tenaga Kerja Indonesia di Luar Negeri menjadi Undang-Undang Nomor 18 Tahun 2017 tentang Perlindungan Pekerja Migran Indonesia (PPMI) pada 22 November 2017. [insert link: https://jdih.kemnaker.go.id/penelusuran-2500000-Undang-undang.html]</p>\r\n\r\n<p>Meski begitu, per Juli 2019, peraturan turunan dari UU 18/2017 itu belum selesai. Rencananya, 9 pasal dari UU 18/2017 akan diturunkan menjadi 3 Peraturan Pemerintah, 3 Perpres, 5 Permenaker, dan 3 Peraturan Kepala Badan. UU 18/2017 mengamanatkan penyusunan aturan turunan UU PPMI selesai pada November 2019. [insert link: https://www.suara.com/news/2019/07/23/125403/kemnaker-terus-selesaikan-aturan-turunan-uu-pelindungan-pekerja-migran]</p>', 'Dalam Proses', 'Publish', '2019-08-12 08:01:14', '2019-08-12 08:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `masters`
--

CREATE TABLE `masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masters`
--

INSERT INTO `masters` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Terpenuhi', 'status', '2019-08-12 07:51:35', '2019-08-12 07:51:35'),
(2, 'Dalam Proses', 'status', '2019-08-12 07:51:47', '2019-08-12 07:51:47'),
(3, 'Tidak Ada Bukti', 'status', '2019-08-12 07:51:59', '2019-08-12 07:51:59'),
(4, 'Gagal', 'status', '2019-08-12 07:52:03', '2019-08-12 07:52:03'),
(5, 'Periode 1', 'periode', '2019-08-12 07:52:20', '2019-08-12 07:52:20'),
(6, 'Periode 2', 'periode', '2019-08-12 07:52:27', '2019-08-12 07:52:27'),
(7, 'Ekonomi', 'topik', '2019-08-12 07:52:37', '2019-08-12 07:52:37'),
(8, 'Budaya', 'topik', '2019-08-12 07:52:43', '2019-08-12 07:52:43'),
(9, 'Pendidikan', 'topik', '2019-08-12 07:52:50', '2019-08-12 07:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_07_22_050427_create_table_promises', 1),
(3, '2019_07_22_050504_create_table_detail_promises', 1),
(4, '2019_07_22_050546_create_table_artikels', 1),
(5, '2019_07_22_074113_create_masters_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promises`
--

CREATE TABLE `promises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promises`
--

INSERT INTO `promises` (`id`, `judul`, `topik`, `status`, `periode`, `slug`, `keterangan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Diplomasi maritim dengan 10 negara tetangga', 'Ekonomi', 'Gagal', 'Periode 1', 'diplomasi-maritim-dengan-10-negara-tetangga', 'Publish', NULL, '2019-08-12 07:58:40', '2019-08-12 08:03:19'),
(2, 'Perlindungan Tenaga Kerja Indonesia', 'Budaya', 'Dalam Proses', 'Periode 1', 'perlindungan-tenaga-kerja-indonesia', 'Publish', NULL, '2019-08-12 08:01:14', '2019-08-12 08:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `divisi`, `role`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Media Lab', 'Admin', 'admin@admin.com', '$2y$10$keUMKGyjmEBhOaVPaDD/HOPkArPbMa9j2roFh8HLnGCOO6Izi2gQS', '1996-09-28 14:17:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_promises`
--
ALTER TABLE `detail_promises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masters`
--
ALTER TABLE `masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promises`
--
ALTER TABLE `promises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_promises`
--
ALTER TABLE `detail_promises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masters`
--
ALTER TABLE `masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promises`
--
ALTER TABLE `promises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
