-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2026 at 12:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kopi_paul`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `nama_menu` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `id_pesanan`, `id_menu`, `nama_menu`, `harga`, `qty`, `subtotal`) VALUES
(1, 1, 1, 'Es Kopi PAUL (Es Kopi Gula Aren)', 18900, 2, 37800),
(2, 2, 1, 'Es Kopi PAUL (Es Kopi Gula Aren)', 18900, 1, 18900),
(3, 3, 2, 'Espresso (Panas)', 14700, 3, 44100),
(4, 4, 2, 'Espresso (Panas)', 14700, 1, 14700),
(5, 5, 3, 'Es Coklat PAUL', 17900, 1, 17900),
(6, 6, 9, 'kwetiau sedap', 13000, 1, 13000),
(7, 7, 1, 'Es Kopi PAUL (Gula Aren)', 18900, 1, 18900),
(8, 8, 9, 'kwetiau sedap', 13000, 1, 13000),
(9, 8, 4, 'Croffle (2 Pcs) Original', 14900, 1, 14900),
(10, 9, 9, 'kwetiau sedap', 13000, 1, 13000),
(11, 9, 3, 'Es Coklat PAUL', 17900, 1, 17900),
(12, 10, 26, 'Se- liter kopi rasa(no ice)', 69900, 1, 69900),
(13, 11, 25, 'es kopi butterscoth', 20500, 1, 20500),
(14, 12, 25, 'es kopi butterscoth', 20500, 1, 20500),
(15, 13, 16, 'espresso (panas)', 14700, 1, 14700),
(16, 14, 16, 'espresso (panas)', 14700, 1, 14700),
(17, 15, 25, 'es kopi butterscoth', 20500, 1, 20500);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `kategori` enum('espresso','non-coffee','pastry') NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT 'img/default.jpg',
  `deskripsi` text DEFAULT NULL,
  `status` enum('tersedia','habis') DEFAULT 'tersedia',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `kategori`, `harga`, `gambar`, `deskripsi`, `status`, `created_at`) VALUES
(1, 'Es Kopi PAUL (Gula Aren)', 'espresso', 18900, 'img/es-kopi-paul.jpeg', 'Kopi espresso + fresh milk + gula aren asli.', 'tersedia', '2026-10-13 02:30:17'),
(2, 'Espresso (Panas)', 'espresso', 14700, 'img/espresso-panas.jpeg', 'Ekstrak Kopi Kental Tanpa Gula.', 'tersedia', '2026-10-13 02:30:17'),
(3, 'Es Coklat PAUL', 'non-coffee', 17900, 'img/es-coklat-paul.jpeg', 'Minuman cokelat khas Toko Kopi Paul.', 'tersedia', '2026-10-13 02:30:17'),
(4, 'Croffle (2 Pcs) Original', 'pastry', 14900, 'img/croffle-original.jpeg', 'Croffle renyah isi 2 pcs original.', 'tersedia', '2026-10-13 02:30:17'),
(11, 'Kwetiau Goreng Paul', 'pastry', 19500, 'img/1791956837_6acf1765addef.jpeg', 'isian telur,bakso,sosis dan sayuran', 'tersedia', '2026-10-14 05:47:17'),
(12, 'Family Croffle', 'pastry', 38500, 'img/1791957004_6acf180c5a565.jpeg', '5 pcs Croffle+Gula Halus+Selai coklat dan stawberry, cocok untuk sekeluarga', 'tersedia', '2026-10-14 05:50:04'),
(13, 'Paket Dimsum Mentai + es teh manis', 'pastry', 32000, 'img/1791957085_6acf185d3ee57.jpeg', '1 dimsum saos mentai (isi 4 pcs)+1 es teh manis', 'tersedia', '2026-10-14 05:51:25'),
(14, 'Paket Nasi goreng paul + es teh manis', 'pastry', 28000, 'img/1791957284_6acf1924ea0fc.jpeg', '1 Nasi Goreng  Paul+ 1 es teh manis', 'tersedia', '2026-10-14 05:54:44'),
(15, 'Se liter Kopi paul (no ice)', 'espresso', 66900, 'img/1791957361_6acf19719a045.jpeg', '1 liter es kopi gula aren', 'tersedia', '2026-10-14 05:56:01'),
(16, 'espresso (panas)', 'espresso', 14700, 'img/1791957538_6acf1a22eef5f.jpeg', 'ekstra kopi kental tanpa gula', 'tersedia', '2026-10-14 05:58:58'),
(17, 'es americano ( tanpa gula)', 'espresso', 16700, 'img/1791958637_6acf1e6dc507c.jpeg', 'campuran espresso + air ( tanpa gula)', 'tersedia', '2026-10-14 06:17:17'),
(18, 'es cappucino', 'espresso', 18900, 'img/1791958743_6acf1ed7a0dd8.jpeg', 'campuran espresso dan susu', 'tersedia', '2026-10-14 06:19:03'),
(19, 'es caffe latte', 'espresso', 18900, 'img/1791958919_6acf1f879e82a.jpeg', 'kopi espresso + fresh milk /uht + etc (plain/tawar)no/sugar! tanpa gula/pemanis', 'tersedia', '2026-10-14 06:21:59'),
(20, 'es kopi caramel', 'espresso', 20500, 'img/1791959060_6acf201402393.jpeg', 'Kopi espresso + fresh milk/uht+sirup caramel.cup 14oz', 'tersedia', '2026-10-14 06:24:20'),
(21, 'es kopi vanilla', 'espresso', 20500, 'img/1791959544_6acf21f8c4e5c.jpeg', 'kopi espresso + fresh milk/uht+sirup vanilla. cup 12oz', 'tersedia', '2026-10-14 06:32:24'),
(22, 'es kopi hazelnut', 'espresso', 20500, 'img/1791959764_6acf22d47fda1.jpeg', 'kopi espresso + fresh milk/uht + sirup hazelnut . cup 120z', 'tersedia', '2026-10-14 06:36:04'),
(23, 'es kopi bandan', 'espresso', 20500, 'img/1791959889_6acf23517df99.jpeg', 'kopi espresso  + fresh milk/uht + sirup bandan. cup 12oz', 'tersedia', '2026-10-14 06:38:09'),
(24, 'es salted caramel', 'espresso', 20500, 'img/1791960569_6acf25f9ca72a.jpeg', 'pahitnya kopi beradu dengan gurih manisnya saklted caramel', 'tersedia', '2026-10-14 06:49:29'),
(25, 'es kopi butterscoth', 'espresso', 20500, 'img/1791960830_6acf26fe0aad7.jpeg', '', 'tersedia', '2026-10-14 06:53:50'),
(26, 'Se- liter kopi rasa(no ice)', 'espresso', 69900, 'img/1791961197_6acf286d38b1e.jpeg', 'terdapat varian salted caramel , hazelnut,caramel,vanilla,pandan', 'tersedia', '2026-10-14 06:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `whatsapp`, `email`, `alamat`, `created_at`) VALUES
(1, 'ade lagi', '', '', '', '2026-10-14 03:20:29'),
(7, 'jawir', '08222222222', '', 'jl cibinong', '2026-10-14 03:54:21'),
(8, 'jono', '032329393', 'adaa@gmail.com', 'Depok', '2026-10-14 03:57:15'),
(9, 'nene', '082222222221111', 'na@gmail.com', 'jl langgar no 11 kramat jati', '2026-10-14 04:07:05'),
(10, 'dodi', '082222222232', 'a@gmail.con', 'jl. palbatu no 12', '2026-10-14 05:37:17'),
(11, 'mulyono', '0822121212', '', 'solo', '2026-10-15 03:30:44'),
(12, 'jack', '0822666', 'jack@gmail.com', 'solo', '2026-10-15 03:47:56'),
(13, 'jkw', '666', '', 'solo', '2026-10-15 03:57:06'),
(14, 'jokowi', '08666', 'jack@solo.com', 'solo', '2026-10-15 04:04:45'),
(15, 'prabowo', '0876435321', 'sawit@gmail.com', 'kertanegara', '2026-10-15 10:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL DEFAULT 1,
  `nama_toko` varchar(100) DEFAULT 'Toko Kopi Paul',
  `telepon_wa` varchar(20) DEFAULT '081234567890',
  `biaya_delivery` int(11) DEFAULT 5000,
  `jam_operasional` varchar(100) DEFAULT '10.00 - 22.00 WIB',
  `alamat_toko` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_toko`, `telepon_wa`, `biaya_delivery`, `jam_operasional`, `alamat_toko`) VALUES
(1, 'Toko Kopi Paul', '081234567890', 5000, '10.00 - 22.00 WIB', 'Jl. Raya Cikuda - Parung Panjang, Bogor');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `kode_pesanan` varchar(20) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `metode_layanan` enum('dine_in','delivery') NOT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `catatan` text DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `biaya_ongkir` int(11) DEFAULT 0,
  `total_bayar` int(11) NOT NULL,
  `status` enum('Pending','Diproses','Selesai','Dibatalkan') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `kode_pesanan`, `id_pelanggan`, `nama_pemesan`, `metode_layanan`, `whatsapp`, `email`, `alamat`, `metode_pembayaran`, `catatan`, `subtotal`, `biaya_ongkir`, `total_bayar`, `status`, `created_at`) VALUES
(1, 'PAUL-20261013-818', NULL, 'nana', 'dine_in', '', '', '', 'Tunai / Cash', '', 37800, 0, 37800, 'Selesai', '2026-10-13 04:30:36'),
(2, 'PAUL-20261013-764', NULL, 'ade', 'dine_in', '', '', '', 'Tunai / Cash', '', 18900, 0, 18900, 'Selesai', '2026-10-13 04:33:34'),
(3, 'PAUL-20261013-287', NULL, 'dede', 'dine_in', '', '', '', 'Tunai / Cash', 'gula dikit', 44100, 0, 44100, 'Selesai', '2026-10-13 10:21:53'),
(4, 'PAUL-20261014-253', NULL, 'jamal', 'dine_in', '', '', '', 'Tunai / Cash', '', 14700, 0, 14700, 'Selesai', '2026-10-14 02:43:10'),
(5, 'ORD-20261014-128', 1, 'ade lagi', 'dine_in', '', '', '', 'Tunai / Cash', '', 17900, 0, 17900, 'Pending', '2026-10-14 03:20:29'),
(6, 'ORD-20261014-758', 7, 'budi', 'dine_in', '08222222222', '', 'depok', 'Tunai / Cash', '', 13000, 0, 13000, 'Pending', '2026-10-14 03:54:21'),
(7, 'ORD-20261014-249', 8, 'jono', 'delivery', '032329393', 'adaa@gmail.com', 'Depok', 'Tunai / Cash', '', 18900, 5000, 23900, 'Pending', '2026-10-14 03:57:15'),
(8, 'ORD-20261014-287', 9, 'nene', 'delivery', '082222222221111', 'na@gmail.com', 'jl langgar no 11 kramat jati', 'Transfer Bank', '', 27900, 5000, 32900, 'Pending', '2026-10-14 04:07:05'),
(9, 'ORD-20261014-360', 10, 'dodi', 'delivery', '082222222232', 'a@gmail.con', 'jl. palbatu no 12', 'Transfer Bank', 'jangan lama', 30900, 5000, 35900, 'Selesai', '2026-10-14 05:37:17'),
(10, 'ORD-20261015-992', 11, 'mulyono', 'dine_in', '0822121212', '', 'solo', 'Tunai / Cash', '', 69900, 0, 69900, 'Pending', '2026-10-15 03:30:44'),
(11, 'ORD-20261015-913', 12, 'jack', 'delivery', '0822666', 'jack@gmail.com', 'solo', 'Transfer Bank', '', 20500, 5000, 25500, 'Pending', '2026-10-15 03:47:56'),
(12, 'ORD-20261015-460', 13, 'jkw', 'delivery', '666', '', 'solo', 'Transfer Bank', '', 20500, 5000, 25500, 'Pending', '2026-10-15 03:57:06'),
(13, 'ORD-20261015-149', 14, 'jokowi', 'delivery', '08666', 'jack@solo.com', 'solo', 'Transfer Bank', '', 14700, 5000, 19700, 'Selesai', '2026-10-15 04:04:45'),
(14, 'ORD-20261015-490', 15, 'prabowo', 'delivery', '0876435321', 'sawit@gmail.com', 'kertanegara', 'Tunai / Cash', 'gulanya satu skop', 14700, 5000, 19700, 'Dibatalkan', '2026-10-15 10:31:23'),
(15, 'ORD-20261015-356', 7, 'jawir', 'delivery', '08222222222', '', 'jl cibinong', 'Tunai / Cash', 'es ny bnykin', 20500, 5000, 25500, 'Selesai', '2026-10-15 10:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `stok_bahan`
--

CREATE TABLE `stok_bahan` (
  `id` int(11) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `minimal_stok` int(11) DEFAULT 5,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_bahan`
--

INSERT INTO `stok_bahan` (`id`, `nama_bahan`, `stok`, `satuan`, `minimal_stok`, `updated_at`) VALUES
(1, 'Biji Kopi Espresso Blend', 5000, 'Gram', 1000, '2026-10-13 02:30:17'),
(2, 'Susu Fresh Milk (UHT)', 25, 'Liter', 5, '2026-10-13 02:30:17'),
(3, 'Sirup Gula Aren', 10, 'Liter', 2, '2026-10-13 02:30:17'),
(4, 'Cup Plastic 12oz', 150, 'Pcs', 30, '2026-10-13 02:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `users_admin`
--

CREATE TABLE `users_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_admin`
--

INSERT INTO `users_admin` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'Admin Paul', 'admin@tokokopipaul.com', '$2y$10$cy8nJppaAzrZyULyIPslTef6vhytdlq1qV0QvTCJjI/73qNcU7DKq', 'admin', '2026-10-13 03:09:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `whatsapp` (`whatsapp`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pesanan` (`kode_pesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `stok_bahan`
--
ALTER TABLE `stok_bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_admin`
--
ALTER TABLE `users_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stok_bahan`
--
ALTER TABLE `stok_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_admin`
--
ALTER TABLE `users_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
