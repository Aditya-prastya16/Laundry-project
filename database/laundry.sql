-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2024 at 11:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
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
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_paket`, `qty`, `keterangan`) VALUES
(1, 1, 1, 2, 'semprot'),
(2, 4, 1, 3, 'semprot');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(1, 'Nadine', 'Jln. Semangka', 'P', '086575583923');

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
(1, 'PT.Teknologi Canggih', 'Jalan Nanas', '09382356474475');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `jenis` enum('kiloan','selimut','bed_cover','kaos','lain') NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
(1, 1, 'kiloan', 'a', 5000);

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
(1, 1, 'INV/2024/02/24/1', 1, '2024-02-24 18:06:38', '2024-02-27 18:06:38', '0000-00-00 00:00:00', 2000, 0, 0, 'baru', 'belum_dibayar', 8),
(2, 1, 'INV/2024/02/24/2', 1, '2024-02-24 18:07:48', '2024-02-27 18:07:48', '0000-00-00 00:00:00', 0, 0, 0.007499999832361937, 'baru', 'belum_dibayar', 8),
(3, 1, 'INV/2024/02/24/3', 1, '2024-02-24 18:34:18', '2024-02-27 18:34:18', '0000-00-00 00:00:00', 0, 0, 0.007499999832361937, 'baru', 'belum_dibayar', 7),
(4, 1, 'INV/2024/02/24/4', 1, '2024-02-24 18:43:54', '2024-02-27 18:43:54', '0000-00-00 00:00:00', 4000, 10, 0.0075, 'baru', 'belum_dibayar', 7);

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
  `role` enum('admin','kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `id_outlet`, `role`) VALUES
(5, 'Kasir', 'Kasir', '$2y$10$lrhXQGqJsSfV1Fh/89LG.Om2lsiWLcGJQzT63UR.ZyHHs1rd4mjMa', 1, 'kasir'),
(6, 'Owner', 'Owner', '$2y$10$W3/HcgVBbJhvyJQvkEeH5O7FbCiEBbPdmNTxDWFaQC8agPI/NNakO', 1, 'owner'),
(7, 'User', 'Admin', '$2y$10$oskUEo95UTiOP.1xnggML.bp.InU7quGpK/jIFpVf89F9ai/Mgt0O', 1, 'admin'),
(8, 'a', 'a', '$2y$10$C97F/wq1pvQFT/zqi2s.U.8Ejw5XX8wFJGAwAEqEWhBc2A6i5.BVK', 1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `FK_TRANSAKSI` (`id_transaksi`),
  ADD KEY `FK_PAKET` (`id_paket`);

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
  ADD KEY `FK_OUTLET2` (`id_outlet`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `FK_OUTLET3` (`id_outlet`),
  ADD KEY `FK_MEMBER` (`id_member`),
  ADD KEY `FK_USER` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_OUTLET1` (`id_outlet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD CONSTRAINT `FK_PAKET` FOREIGN KEY (`id_paket`) REFERENCES `tb_paket` (`id_paket`),
  ADD CONSTRAINT `FK_TRANSAKSI` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`);

--
-- Constraints for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD CONSTRAINT `FK_OUTLET2` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `FK_MEMBER` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id_member`),
  ADD CONSTRAINT `FK_OUTLET3` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`),
  ADD CONSTRAINT `FK_USER` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `FK_OUTLET1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id_outlet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
