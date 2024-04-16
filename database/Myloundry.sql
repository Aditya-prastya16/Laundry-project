-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2024 at 08:26 AM
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
-- Database: `Myloundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `qty` double NOT NULL,
  `keterangan` text NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `total_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_paket`, `qty`, `keterangan`, `harga_paket`, `total_harga`) VALUES
(47, 34, 12, 2, '', 10000, 20000),
(48, 34, 3, 1, 'Semprot parfum', 20000, 20000),
(49, 35, 12, 3, '', 10000, 30000),
(50, 36, 12, 1, '', 10000, 10000),
(51, 37, 15, 1, 'Kering Kilat', 12000, 12000),
(53, 37, 12, 2, '\r\n', 10000, 20000),
(54, 38, 12, 2, 'cepat kering', 10000, 20000),
(56, 39, 13, 1, '', 7000, 7000),
(57, 40, 13, 1, '', 7000, 7000),
(59, 42, 13, 1, '', 7000, 7000),
(60, 41, 13, 3, '', 7000, 21000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P','') NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(40, 'Jhon Doe', 'Jalan Roti 7 g', 'L', '089526367224'),
(41, 'Agus ', 'Jalan pulau singkep', 'L', '0863423434553'),
(42, 'Maria', 'Jalan gunung salak 10c', 'P', '08564521347'),
(44, 'Damar', 'Jalan Dukuh Sari 6 D', 'L', '08123675276');

-- --------------------------------------------------------

--
-- Table structure for table `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id_outlet` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_outlet`
--

INSERT INTO `tb_outlet` (`id_outlet`, `nama`, `alamat`, `tlp`) VALUES
(1, 'Moyo Outlet', 'Jalan pulau moyo no 5', '62810034'),
(12, 'My Outlet', 'Jalan Pulau Bungin no 7h', '081247862234'),
(14, 'outlet2', 'jalan2 gang 1', '1414321431434');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `jenis` enum('kiloan','selimut','bed_cover','kaos','lain') NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
(3, 1, 'kiloan', 'paket kilo', 20000),
(9, 14, 'selimut', 'paket selimut', 5000),
(12, 1, 'bed_cover', 'paket bed', 10000),
(13, 12, 'kaos', 'paket clothes', 7000),
(15, 1, 'bed_cover', 'paket bed', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `kode_invoice` varchar(100) NOT NULL,
  `id_member` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `batas_waktu` datetime NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `biaya_tambahan` int(11) NOT NULL,
  `diskon` double NOT NULL,
  `pajak` double NOT NULL,
  `status` enum('baru','proses','selesai','diambil') NOT NULL,
  `dibayar` enum('dibayar','belum_dibayar') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_outlet`, `kode_invoice`, `id_member`, `tgl`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `status`, `dibayar`, `id_user`) VALUES
(34, 1, 'INV/2024/03/28/1', 41, '2024-03-28 20:23:34', '2024-03-31 20:23:34', '0000-00-00 00:00:00', 1500, 0, 0.0075, 'proses', 'belum_dibayar', 1),
(35, 1, 'INV/2024/03/28/2', 42, '2024-03-28 20:24:35', '2024-03-31 20:24:35', '2024-03-28 20:24:53', 0, 0, 0.0075, 'selesai', 'dibayar', 1),
(36, 1, 'INV/2024/03/28/3', 40, '2024-03-28 20:25:04', '2024-03-31 20:25:04', '2024-03-28 20:25:27', 0, 0, 0.0075, 'diambil', 'dibayar', 1),
(37, 1, 'INV/2024/03/28/4', 40, '2024-02-28 20:26:37', '2024-03-31 20:26:37', '0000-00-00 00:00:00', 9000, 0, 0.0075, 'proses', 'belum_dibayar', 1),
(38, 1, 'INV/2024/04/02/1', 41, '2024-04-02 08:45:50', '2024-04-05 08:45:50', '2024-04-02 08:46:39', 12000, 0, 0.0075, 'selesai', 'dibayar', 1),
(39, 12, 'INV/2024/04/03/2', 44, '2024-04-03 22:10:20', '2024-04-06 22:10:20', '0000-00-00 00:00:00', 0, 0, 0.0075, 'baru', 'belum_dibayar', 26),
(40, 12, 'INV/2024/04/03/3', 44, '2024-04-03 22:21:07', '2024-04-06 22:21:07', '2024-04-03 22:24:59', 0, 0, 0.0075, 'proses', 'dibayar', 26),
(41, 12, 'INV/2024/04/14/4', 44, '2024-04-14 21:30:18', '2024-04-17 21:30:18', '2024-04-14 21:37:10', 5000, 0, 0.0075, 'selesai', 'dibayar', 26),
(42, 12, 'INV/2024/04/14/5', 42, '2024-04-14 21:34:40', '2024-04-17 21:34:40', '2024-04-14 21:34:55', 0, 0, 0.0075, 'diambil', 'dibayar', 26);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `role` enum('admin','kasir','owner','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `id_outlet`, `role`) VALUES
(1, 'admin', 'admin', '$2y$10$HlqxM.I8zdlLtXY1EYItIuvncWcE8o1MR/k2Pv3RhKiSydecKc5aW', 1, 'admin'),
(26, 'kasir', 'kasir', '$2y$10$tHEMVS876rjDLPSqi/FmZ.FoUZ778znn4nkFXwuZD0wKVTyB/uki2', 12, 'kasir'),
(27, 'owner', 'owner', '$2y$10$1ixNS0xpDSUOg.rbCWl07.0O5UPMrPrPIhZL3RH6VBP/RvaIxP2Ca', 14, 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `tb_detail_transaksi_ibfk_1` (`id_paket`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `tb_paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD CONSTRAINT `tb_paket_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
